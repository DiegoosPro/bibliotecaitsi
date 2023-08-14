
<?php
$datos = LibroData::getAllLibros();
if (isset($_POST['btnGrabar'])) {
    $libro_id = $_POST['txtCodigo'];
    $editorial_id = $_POST['cboEditorial'];
    $genero_id = $_POST['cboGenero'];
    $materia_id = $_POST['cboMaterias'];
    $autor_id = $_POST['cboAutores'];
    $titulo = $_POST['txtTitulo'];
    $anio_publicacion = $_POST['txtAnioPublicacion'];
    $disponibilidad = $_POST['cboDisponibilidad'];
    
    $imgFile = $_FILES['imguser']['name'];
    $tmp_dir = $_FILES['imguser']['tmp_name'];
    $imgSize = $_FILES['imguser']['size'];
    $upload_dir = 'imagenes/';
    
    if (empty($imgFile)) {
        $imagen = "sinimagen.jpeg";
        move_uploaded_file($tmp_dir, $upload_dir . $pro_imagen);
    } else {
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'gif');
        
        $numero = rand(1000, 9999);
        $imagen =  $numero . "." . $imgExt;
        
        if (in_array($imgExt, $valid_extensions)) {
            if ($imgSize < 1000000) {
                move_uploaded_file($tmp_dir, $upload_dir . $pro_imagen);
            } else {
                $error[] = "Atención, su archivo es muy grande, debe ser menor a 100 KB";
            }
        } else {
            $error[] = "Lo siento, JPG, JPEG, PNG & GIF formatos de archivo permitidos";
        }
    }

if (LibroData::insertLibro(
    $libro_id,
    $editorial_id,
    $genero_id,
    $materia_id,
    $autor_id,
    $titulo,
    $anio_publicacion,
    $disponibilidad,
    $imagen
) == true) {
    echo "DATOS DEL LIBRO GRABADOS CORRECTAMENTE";
} else {
    echo "**** NO SE PUDO GRABAR, REVISE LOS DATOS O EL CÓDIGO ****";
}
}

if (isset($_POST['btnUpdate'])) {
    $libro_id = $_POST['txtCodigo'];
    $editorial_id = $_POST['cboEditorial'];
    $genero_id = $_POST['cboGenero'];
    $materia_id = $_POST['cboMaterias'];
    $autor_id = $_POST['cboAutores'];
    $titulo = $_POST['txtTitulo'];
    $anio_publicacion = $_POST['txtAnioPublicacion'];
    $disponibilidad = $_POST['cboDisponibilidad'];

    $fotoanterior = $_POST['txtFotoAnterior'];
    $imgFile = $_FILES['imguser']['name'];
    $tmp_dir = $_FILES['imguser']['tmp_name'];
    $imgSize = $_FILES['imguser']['size'];
    $upload_dir = 'imagenes/';

    if ($imgFile) {
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
    $nombrearchivo = "foto_" . $libro_id;
    $imagen = $nombrearchivo . "." . $imgExt;

    if (in_array($imgExt, $valid_extensions)) {
        if ($fotoanterior != 'sinimagen.jpeg') {
            unlink($upload_dir . $fotoanterior);
        }
        move_uploaded_file($tmp_dir, $upload_dir . $imagen);
    } else {
        $imgerror = "Lo siento, JPG, JPEG, PNG & GIF formatos de archivo permitidos";
    }
} else {
    $imagen = $fotoanterior; //antigua imagen
}

    if (LibroData::updateLibro(
    $libro_id,
    $editorial_id,
    $genero_id,
    $materia_id,
    $autor_id,
    $titulo,
    $anio_publicacion,
    $disponibilidad,
    $imagen // No estoy seguro si necesitas este campo aquí, asegúrate de que esté definido correctamente
) == true) {
    echo "DATOS DEL LIBRO ACTUALIZADOS CORRECTAMENTE";
} else {
    echo "**** NO SE PUDO ACTUALIZAR, REVISE LOS DATOS O EL CÓDIGO ****";
}
}

if (isset($_POST['btnDelete'])) {
    $libro_id = $_POST['txtLibroId'];
    LibroData::deleteLibro($libro_id);
}
?>




<!-- Botón para agregar nueva materia -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalNuevo">
    Nuevo libro
</button>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">PAGINA LIBROS</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                                        <th scope="col">Título</th>
                                        <th scope="col">Año Publicación</th>
                                        <th scope="col">Editorial</th>                                  
                                        <th scope="col">Materias</th>
                                        <th scope="col">Autor</th>
                                        <th scope="col">Disponibilidad</th>
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($datos != null) {
                  foreach ($datos as $indice => $row) {
                    ?>
                    <tr>
                      <th scope="row">
                                            <?php echo $row['ID_LIBRO']; ?>
                                        </th>
                                        <td>
                                            <?php echo $row['TITULO']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['ANIO_PUBLICACION']; ?>
                                        </td>
                                        <td>
                                            <?php echo ($row['NOMBRE_EDITORIAL']); ?>
                                        </td>
                                        <td>
                                            <?php echo ($row['NOMBRE_MATERIA']); ?>
                                        </td>
                                        <td>
                                            <?php echo ($row['NOMBRE_AUTOR']); ?>
                                        </td>
                                        
                                        <td>
                                            <?php
                                            if ($row['DISPONIBILIDAD'] == 1)
                                              echo "SI";
                                            else
                                              echo "NO";
                                            ?>
                                        </td>
                                        <td>
                                            <img src="imagenes/<?php echo $row['IMAGEN']; ?>" width="60" height="60">
                                        </td>
                      <td>
                        
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEditar<?php echo $row['ID_LIBRO']; ?>">
                          Editar
                        </button>
                        <!-- Modal Editar -->
<div class="modal fade" id="ModalEditar<?php echo $row['ID_LIBRO']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Actualización de datos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $datosLibro = LibroData::getLibroById($row['ID_LIBRO']);
        ?>
        <form method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-6">
              <div class="card card-primary">
                <div class="card-body">
                  <input type="hidden" name="txtFotoAnterior" value="<?php echo $datosLibro['IMAGEN']; ?>">
                  <label>ID :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtCodigo" id="txtCodigoId" value="<?php echo $datosLibro['ID_LIBRO']; ?>" readonly class="form-control" placeholder="Código">
                  </div>

                  <label>Título :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtTitulo" value="<?php echo $datosLibro['TITULO']; ?>" class="form-control" placeholder="Título">
                  </div>

                  <label>Año de Publicación :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="date" name="txtAnioPublicacion" value="<?php echo $datosLibro['ANIO_PUBLICACION']; ?>" class="form-control" placeholder="Año de Publicación">
                  </div>

                    <?php
                    $editorial = EditorialData::getAllEditoriales();
                    ?>
                    <label>Editorial: </label>
                    <div class="input-group mb-3">
                    <select class="form-select" name="cboEditorial" required>
                      <option value="<?php echo $datosLibro['ID_EDITORIAL']; ?>"><?php echo EditorialData::getNombreEditorialById($datosLibro['ID_EDITORIAL']); ?></option>
                      <?php
                      if ($editorial != null) {
                        foreach ($editorial as $indice => $rowm) {
                          if ($datosLibro['ID_EDITORIAL'] != $rowm['ID_EDITORIAL']) {
                      ?>
                            <option value="<?php echo $rowm['ID_EDITORIAL']; ?>"><?php echo $rowm['NOMBRE_EDITORIAL']; ?></option>
                      <?php
                          }
                        }
                      }
                      ?>
                  </select>
                  </div>

<?php
$materias = MateriaData::getAllMaterias();
?>
<label>Materia :</label>
<div class="input-group mb-3">
<select class="form-select" name="cboMaterias" required>
  <option value="<?php echo $datosLibro['ID_MATERIAS']; ?>"><?php echo MateriaData::getNombreMateriaById($datosLibro['ID_MATERIAS']); ?></option>
  <?php
  if ($materias != null) {
    foreach ($materias as $indice => $rowm) {
      if ($datosLibro['ID_MATERIAS'] != $rowm['ID_MATERIAS']) {
  ?>
        <option value="<?php echo $rowm['ID_MATERIAS']; ?>"><?php echo $rowm['NOMBRE_MATERIA']; ?></option>
  <?php
      }
    }
  }
  ?>
</select>
</div>



                  <?php
                  $autores = AutorData::getAllAutores();
                  ?>
                  <label>Autor : </label>
                  <div class="input-group mb-3">
                  <select class="form-select" name="cboAutores" required>
                    <option value="<?php echo $datosLibro['ID_AUTOR']; ?>"><?php echo AutorData::getNombreAutorById($datosLibro['ID_AUTOR']); ?></option>
                    <?php
                    if ($autores != null) {
                      foreach ($autores as $indice => $rowa) {
                        if ($datosLibro['ID_AUTOR'] != $rowa['ID_AUTOR']) {
                    ?>
                          <option value="<?php echo $rowa['ID_AUTOR']; ?>"><?php echo $rowa['NOMBRE_AUTOR']; ?></option>
                    <?php
                        }
                      }
                    }
                    ?>
                  </select>
                                    </div>

<!-- ... (otros campos) ... -->

                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="card card-primary">
                <div class="card-body">
                  <h5>ESTOY EN LADO DERECHO</h5>
                  <label>Disponibilidad :</label>
                  <select class="form-select" name="cboDisponibilidad" required>
                    <option value="1" <?php if ($datosLibro['DISPONIBILIDAD'] == 1) echo "selected"; ?>>SI</option>
                    <option value="0" <?php if ($datosLibro['DISPONIBILIDAD'] == 0) echo "selected"; ?>>NO</option>
                  </select>

                  <!-- Imagen -->
                  <div class="input-group">
                    <p>
                      <img src="imagenes/<?php echo $datosLibro['IMAGEN']; ?>" id="imguserId" class="img-circle" height="150" width="150" />
                      <input class="input-group" type="file" name="imguser" id="fotoId" onchange="previewFoto()" accept="image/*">
                      <label for="ejemplo_archivo_1">Imagen (Tamaño máximo archivo 1 MB)</label>
                    </p>
                  </div>

                  

                  <button type="submit" name="btnUpdate" class="btn btn-primary btn-sm mt-2">Grabar cambios</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Editar -->


                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalEliminar<?php echo $row['ID_LIBRO']; ?>">
                          Eliminar
                        </button>
                        <div class="modal fade" id="ModalEliminar<?php echo $row['ID_LIBRO']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <!-- Aquí va el código del modal de eliminación -->
                        </div>
                      </td>
                    </tr>
                <?php
                  } //foreach
                } //if
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
