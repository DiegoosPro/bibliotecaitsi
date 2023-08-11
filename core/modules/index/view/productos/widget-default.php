<h1>PAGINA PRODUCTOS</h1>
<?php

$datos = ProductoData::getAllProductos();

if (isset($_POST['btnGrabar'])) {
  $pro_id = $_POST['txtCodigo'];
  $pro_descripcion = $_POST['txtDesc'];
  $pro_precio_c = $_POST['txtPrecioC'];
  $pro_precio_v = $_POST['txtPrecioV'];
  $pro_stock = $_POST['txtStock'];
  $pro_fecha_elab = $_POST['txtFechaElab'];
  $pro_nivel_azucar = $_POST['cboNivelAzucar'];
  $pro_aplica_iva = 0;
  if (isset($_POST["chkPagaIva"])) {
    $pro_aplica_iva = 1;
  }
  $pro_especifica = $_POST['txtEspecifica'];

  //*******************/
  $imgFile = $_FILES['imguser']['name'];
  $tmp_dir = $_FILES['imguser']['tmp_name'];
  $imgSize = $_FILES['imguser']['size'];
  $upload_dir = 'imagenes/';

  if (empty($imgFile)) {
    $pro_imagen = "sinimagen.jpeg";
    move_uploaded_file($tmp_dir, $upload_dir . $pro_imagen);
  } else {
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'gif');

    $numero = rand(1000, 9999);
    $pro_imagen =  $numero . "." . $imgExt;

    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '1MB'
      if ($imgSize < 1000000) {
        move_uploaded_file($tmp_dir, $upload_dir . $pro_imagen);
      } else {
        $error[] = "Atención, su archivo es muy grande, debe ser menor a 100 KB";
      }
    } else {
      $error[] = "Lo siento, JPG, JPEG, PNG & GIF formatos de archivo permitidos";
    }
  }

  //*******************/
  $marca_id = $_POST['cboMarcas'];
  $catego_id = $_POST['cboCategorias'];

  if (ProductoData::insertProducto(
    $pro_id,
    $pro_descripcion,
    $pro_precio_c,
    $pro_precio_v,
    $pro_stock,
    $pro_fecha_elab,
    $pro_nivel_azucar,
    $pro_aplica_iva,
    $pro_especifica,
    $pro_imagen,
    $marca_id,
    $catego_id
  ) == true) {
    echo "DATOS DEL PRODUCTO GRABADO CORRECTAMENTE";
  } else {
    echo "**** NOOO SE PUEDO GRABAR, REVISE LOS DATOS O EL CODIGO ****";
  }
}

if (isset($_POST['btnUpdate'])) {
  $pro_id = $_POST['txtCodigo'];
  $pro_descripcion = $_POST['txtDesc'];
  $pro_precio_c = $_POST['txtPrecioC'];
  $pro_precio_v = $_POST['txtPrecioV'];
  $pro_stock = $_POST['txtStock'];
  $pro_fecha_elab = $_POST['txtFechaElab'];
  $pro_nivel_azucar = $_POST['cboNivelAzucar'];
  $pro_aplica_iva = 0;
  if (isset($_POST["chkPagaIva"])) {
    $pro_aplica_iva = 1;
  }
  $pro_especifica = $_POST['txtEspecifica'];

  //*******************/
  $fotoanterior = $_POST['txtFotoAnterior'];

  $imgFile = $_FILES['imguser']['name'];
  $tmp_dir = $_FILES['imguser']['tmp_name'];
  $imgSize = $_FILES['imguser']['size'];
  $upload_dir = 'imagenes/';


  if ($imgFile) {
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
    $nombrearchivo = "foto_" . $pro_id;
    $pro_imagen = $nombrearchivo . "." . $imgExt;

    if (in_array($imgExt, $valid_extensions)) {
      if ($fotoanterior != 'sinimagen.jpeg') {
        unlink($upload_dir . $fotoanterior);
      }
      move_uploaded_file($tmp_dir, $upload_dir . $pro_imagen);
    } else {
      $imgerror = "Lo siento, JPG, JPEG, PNG & GIF formatos de archivo permitidos";
    }
  } else {
    $pro_imagen = $fotoanterior; //antigua imagen 
  }

  //*******************/
  $marca_id = $_POST['cboMarcas'];
  $catego_id = $_POST['cboCategorias'];

  if (ProductoData::updateProducto(
    $pro_id,
    $pro_descripcion,
    $pro_precio_c,
    $pro_precio_v,
    $pro_stock,
    $pro_fecha_elab,
    $pro_nivel_azucar,
    $pro_aplica_iva,
    $pro_especifica,
    $pro_imagen,
    $marca_id,
    $catego_id
  ) == true) {
    echo "DATOS DEL PRODUCTO ACTUALIZADO CORRECTAMENTE";
  } else {
    echo "**** NOOO SE PUEDO GRABAR, REVISE LOS DATOS O EL CODIGO ****";
  }
}

if (isset($_POST['btnDelete'])) {
  $pro_id = $_POST['txtProId'];
  ProductoData::deleteProducto($pro_id);
}

?>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalNuevo">
  Nuevo producto
</button>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Descripción</th>
      <th scope="col">P. Costo</th>
      <th scope="col">Marca</th>
      <th scope="col">Categoria</th>
      <th scope="col">Azúcar</th>
      <th scope="col">IVA</th>
      <th scope="col">Foto</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($datos != null) {
      foreach ($datos as $indice => $row) {
    ?>
        <tr>
          <th scope="row"><?php echo $row['pro_id']; ?></th>
          <td><?php echo $row['pro_descripcion']; ?></td>
          <td><?php echo $row['pro_precio_c']; ?></td>
          <td><?php echo $row['marca_descripcion']; ?></td>
          <td><?php echo $row['catego_descripcion']; ?></td>
          <td><?php
              switch ($row['pro_nivel_azucar']) {
                case 'M':
                  echo "Medio";
                  break;
                case 'B':
                  echo "Bajo";
                  break;
                case 'A':
                  echo "Alto";
                  break;
                case 'N':
                  echo "Ninguno";
                  break;
              }

              ?>

          </td>
          <td><?php
              if ($row['pro_aplica_iva'] == 1)
                echo "Si";
              else
                echo "No";
              ?>
          </td>
          <td>
            <img src="imagenes/<?php echo $row['pro_imagen']; ?>" width="60" height="60">
          </td>
          <td>
            <a href="#" class="btn btn-sm btn-info">Ver</a>
            <!-- Modal Editar -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEditar<?php echo $row['pro_id']; ?>">
              Editar
            </button>

            <!-- Modal  EDITAR-->
            <div class="modal fade" id="ModalEditar<?php echo $row['pro_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Actualizacion de datos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php
                    $datosPro = ProductoData::getProductoById($row['pro_id']);
                    ?>
                    <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-6">
                          <div class="card card-primary">
                            <div class="card-body">
                              <input type="hidden" name="txtFotoAnterior" value="<?php echo $datosPro['pro_imagen']; ?>">
                              <label>Codigo :</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="text" name="txtCodigo" id="txtCodigoId" value="<?php echo $datosPro['pro_id']; ?>" readonly class="form-control" placeholder="Codigo">
                              </div>

                              <label>Descripcion :</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="text" name="txtDesc" value="<?php echo $datosPro['pro_descripcion']; ?>" class="form-control" placeholder="Codigo">
                              </div>

                              <label>Precio costo :</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">$</span>
                                <input type="number" name="txtPrecioC" value="<?php echo $datosPro['pro_precio_c']; ?>" class="form-control" maxlength="10">
                              </div>

                              <label>Precio venta :</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">$</span>
                                <input type="number" name="txtPrecioV" value="<?php echo $datosPro['pro_precio_v']; ?>" class="form-control">
                              </div>

                              <label>Stock :</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">#</span>
                                <input type="number" name="txtStock" value="<?php echo $datosPro['pro_stock']; ?>" class="form-control">
                              </div>

                              <label>Fecha Elaboración :</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">#</span>
                                <input type="date" name="txtFechaElab" value="<?php echo $datosPro['pro_fecha_elab']; ?>" class="form-control">
                              </div>

                              <label>Nivel de azucar :</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">#</span>
                                <select name="cboNivelAzucar" class="form-select">
                                  <option value="B" <?php if ($datosPro['pro_nivel_azucar'] == "B") {
                                                      echo "selected";
                                                    } ?>>Bajo</option>
                                  <option value="M" <?php if ($datosPro['pro_nivel_azucar'] == "M") {
                                                      echo "selected";
                                                    } ?>>Medio</option>
                                  <option value="A" <?php if ($datosPro['pro_nivel_azucar'] == "A") {
                                                      echo "selected";
                                                    } ?>>Alto</option>
                                  <option value="N" <?php if ($datosPro['pro_nivel_azucar'] == "N") {
                                                      echo "selected";
                                                    } ?>>Ninguno</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="card card-primary">
                            <div class="card-body">
                              <h5>ESTOY EN LADO DERECHO</h5>
                              <div class="form-check">
                                <input name="chkPagaIva" <?php if ($datosPro['pro_aplica_iva'] == 1) echo "checked"; ?> class="form-check-input" type="checkbox">
                                <label class="form-check-label"><strong>Paga Iva</strong></label>
                              </div>

                              <label>Especificaciones :</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">#</span>
                                <textarea name="txtEspecifica" class="form-control"><?php echo $datosPro['pro_especifica']; ?></textarea>
                              </div>
                              <!-- imagen -->
                              <div class="input-group">
                                <p>
                                  <img src="imagenes/<?php echo $datosPro['pro_imagen']; ?>" id="imguserId" class="img-circle" height="150" width="150" />
                                  <input class="input-group" type="file" name="imguser" id="fotoId" onchange="previewFoto()" accept="image/*">
                                  <label for="ejemplo_archivo_1">Imagen (Tam. máximo archivo
                                    1 MB)</label>
                                </p>
                              </div>
                              <!-- fin imagen -->
                              <?php
                              $marcas = MarcaData::getAllMarcas();
                              ?>
                              <label>Marca :</label>
                              <select class="form-select" name="cboMarcas" required>
                                <option value="<?php echo $datosPro['marca_id']; ?>"><?php echo MarcaData::getNombeMarcaById($datosPro['marca_id']); ?></option>
                                <?php
                                if ($marcas != null) {
                                  foreach ($marcas as $indice => $rowm) {
                                    if ($datosPro['marca_id'] != $rowm['marca_id']) {
                                ?>
                                      <option value="<?php echo $rowm['marca_id']; ?>"><?php echo $rowm['marca_descripcion']; ?></option>
                                <?php
                                    }
                                  }
                                }
                                ?>
                              </select>
                              <!--  -->
                              <?php
                              $categorias = CategoriaData::getAllCategorias();
                              ?>
                              <label>Categoría :</label>
                              <select class="form-select" name="cboCategorias" required>
                                <option value="<?php echo $datosPro['catego_id']; ?>"><?php echo CategoriaData::getNombreCategoriaById($datosPro['catego_id']); ?></option>
                                <?php
                                if ($categorias != null) {
                                  foreach ($categorias as $indice => $rowc) {
                                ?>
                                    <option value="<?php echo $rowc['catego_id']; ?>"><?php echo $rowc['catego_descripcion']; ?></option>
                                <?php
                                  }
                                }
                                ?>
                              </select>
                              <!--  -->
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

            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalEliminar<?php echo $row['pro_id']; ?>">
              Eliminar
            </button>

            <!-- Modal  Eliminar-->
            <div class="modal fade" id="ModalEliminar<?php echo $row['pro_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Elimnar producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post">
                      <h4>Esta seguro?</h4>
                      <input type="hidden" name="txtProId" value="<?php echo $row['pro_id']; ?>">
                      <button type="submit" name="btnDelete" class="btn btn-Danger btn-sm mt-2">Eliminar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </td>
        </tr>
    <?php
      } //foreach
    } //if
    ?>
  </tbody>
</table>
<!-- NUEVO MODAL DE ADMINLTE -->
<div class="modal fade" id="ModalNuevo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Default Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-6">
              <div class="card card-primary">
                <div class="card-body">
                  <label>Codigo :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtCodigo" id="txtCodigoId" class="form-control" placeholder="Codigo">
                  </div>

                  <label>Descripcion :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtDesc" class="form-control" placeholder="Codigo">
                  </div>

                  <label>Precio costo :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input type="number" name="txtPrecioC" class="form-control" maxlength="10">
                  </div>

                  <label>Precio venta :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input type="number" name="txtPrecioV" class="form-control">
                  </div>

                  <label>Stock :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">#</span>
                    <input type="number" name="txtStock" class="form-control">
                  </div>

                  <label>Stock :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">#</span>
                    <input type="date" name="txtFechaElab" class="form-control">
                  </div>

                  <label>Nivel de azucar :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">#</span>
                    <select name="cboNivelAzucar" class="form-select">
                      <option value="B">Bajo</option>
                      <option value="M">Medio</option>
                      <option value="A">Alto</option>
                      <option value="N" selected>Ninguno</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="card card-primary">
                <div class="card-body">
                  <h5>ESTOY EN LADO DERECHO</h5>
                  <div class="form-check">
                    <input name="chkPagaIva" class="form-check-input" type="checkbox">
                    <label class="form-check-label"><strong>Paga Iva</strong></label>
                  </div>

                  <label>Especificaciones :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">#</span>
                    <textarea name="txtEspecifica" class="form-control"></textarea>
                  </div>
                  <!-- imagen -->
                  <div class="input-group">
                    <p>
                      <img src="imagenes/sinimagen.jpeg" id="imguserId" class="img-circle" height="150" width="150" />
                      <input class="input-group" type="file" name="imguser" id="fotoId" onchange="previewFoto()" accept="image/*">
                      <label for="ejemplo_archivo_1">Imagen (Tam. máximo archivo
                        1 MB)</label>
                    </p>
                  </div>
                  <!-- fin imagen -->
                  <?php
                  $marcas = MarcaData::getAllMarcas();
                  ?>
                  <label>Marca :</label>
                  <select class="form-select" name="cboMarcas" required>
                    <option value="">-Seleccione Marca-</option>
                    <?php
                    if ($marcas != null) {
                      foreach ($marcas as $indice => $rowm) {
                    ?>
                        <option value="<?php echo $rowm['marca_id']; ?>"><?php echo $rowm['marca_descripcion']; ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <!--  -->
                  <?php
                  $categorias = CategoriaData::getAllCategorias();
                  ?>
                  <label>Categoría :</label>
                  <select class="form-select" name="cboCategorias" required>
                    <option value="">-Seleccione Categoria-</option>
                    <?php
                    if ($categorias != null) {
                      foreach ($categorias as $indice => $rowc) {
                    ?>
                        <option value="<?php echo $rowc['catego_id']; ?>"><?php echo $rowc['catego_descripcion']; ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <!--  -->
                  <button type="submit" name="btnGrabar" class="btn btn-primary btn-sm mt-2">Grabar</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- Fin Modal Nuevo -->
<script>
  function previewFoto() {
    var input = document.getElementById("fotoId");
    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function(event) {
      var img = document.getElementById("imguserId");
      img.src = event.target.result;

    }
  }
</script>