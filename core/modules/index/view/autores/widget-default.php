<?php

$datos = AutorData::getAllAutores();

if (isset($_POST['btnGrabar'])) {
  $nombre_autor = $_POST['txtNombreAutor'];
  $nacionalidad = $_POST['txtNacionalidad'];

  if (AutorData::insertAutor(
    $nombre_autor,
    $nacionalidad
  )) {
    echo '<script>
      Swal.fire({
        title: "¡Éxito!",
        text: "Datos del autor grabados correctamente",
        icon: "success",
        confirmButtonText: "Cerrar"
      }).then(function(result) {
        if (result.value) {
          window.location = "/?view=autores"; // Cambiar a la ruta deseada
        }
      });
    </script>';
  } else {
    echo '<script>
      Swal.fire({
        title: "¡Error!",
        text: "No se pudo grabar, revise los datos o el código",
        icon: "error",
        confirmButtonText: "Cerrar"
      }).then(function(result) {
        if (result.value) {
          window.location = "/?view=autores"; // Cambiar a la ruta deseada
        }
      });
    </script>';
  }
}

if (isset($_POST['btnUpdate'])) {
  $autor_id = $_POST['txtCodigo'];
  $nombre_autor = $_POST['txtNombreAutor'];
  $nacionalidad = $_POST['txtNacionalidad'];

  if (AutorData::updateAutor(
    $autor_id,
    $nombre_autor,
    $nacionalidad
  )) {
    echo '<script>
      Swal.fire({
        title: "¡Éxito!",
        text: "Datos del autor actualizados correctamente",
        icon: "success",
        confirmButtonText: "Cerrar"
      }).then(function(result) {
        if (result.value) {
          window.location = "/?view=autores"; // Cambiar a la dirección correcta
        }
      });
    </script>';
  } else {
    echo '<script>
      Swal.fire({
        title: "¡Error!",
        text: "No se pudo actualizar, revise los datos o el código",
        icon: "error",
        confirmButtonText: "Cerrar"
      }).then(function(result) {
        if (result.value) {
          window.location = "/?view=autores"; // Cambiar a la dirección correcta
        }
      });
    </script>';
  }
}

if (isset($_POST['btnDelete'])) {
  $autor_id = $_POST['txtAutorId'];
  AutorData::deleteAutor($autor_id);
  
  echo '<script>
    Swal.fire({
      title: "¡Eliminado!",
      text: "Autor eliminado correctamente",
      icon: "success",
      confirmButtonText: "Cerrar"
    }).then(function(result) {
      if (result.value) {
        window.location = "?view=autores"; // Recargar la página actual
      }
    });
  </script>';
}


?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalNuevo">
    Agregar Nueva Editorial
</button>

<br>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">PAGINA AUTORES</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre Autor</th>
                  <th scope="col">Nacionalidad</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($datos != null) {
                  foreach ($datos as $indice => $row) {
                    ?>
                    <tr>
                      <th scope="row"><?php echo $row['ID_AUTOR']; ?></th>
                      <td><?php echo $row['NOMBRE_AUTOR']; ?></td>
                      <td><?php echo $row['NACIONALIDAD']; ?></td>
                      <td>
                        <a href="#" class="btn btn-sm btn-info">Ver</a>

                        <!-- Modal Editar -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEditar<?php echo $row['ID_AUTOR']; ?>">
                          Editar
                        </button>
                        <!-- Fin Modal Editar -->

                        <!-- Modal  EDITAR-->
                        <div class="modal fade" id="ModalEditar<?php echo $row['ID_AUTOR']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Actualización de datos</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <?php
                                $datosAutor = AutorData::getAutorById($row['ID_AUTOR']);
                                ?>
                                <form method="post" enctype="multipart/form-data">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="card card-primary">
                                        <div class="card-body">
                                          <label>Código :</label>
                                          <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                            <input type="text" name="txtCodigo" id="txtCodigoId" value="<?php echo $datosAutor['ID_AUTOR']; ?>" readonly class="form-control" placeholder="Código">
                                          </div>
                                          <label>Nombre Autor :</label>
                                          <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                            <input type="text" name="txtNombreAutor" value="<?php echo $datosAutor['NOMBRE_AUTOR']; ?>" class="form-control" placeholder="Nombre Autor">
                                          </div>
                                          <label>Nacionalidad :</label>
                                          <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                            <input type="text" name="txtNacionalidad" value="<?php echo $datosAutor['NACIONALIDAD']; ?>" class="form-control" placeholder="Nacionalidad">
                                          </div>
                                          <button type="submit" name="btnUpdate" class="btn btn-primary btn-sm mt-2">Actualizar</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Fin Modal EDITAR -->

                        <!-- Modal Eliminar -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalEliminar<?php echo $row['ID_AUTOR']; ?>">
                          Eliminar
                        </button>
                        <div class="modal fade" id="ModalEliminar<?php echo $row['ID_AUTOR']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Eliminar Autor</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="post">
                                  <h4>¿Está seguro?</h4>
                                  <input type="hidden" name="txtAutorId" value="<?php echo $row['ID_AUTOR']; ?>">
                                  <button type="submit" name="btnDelete" class="btn btn-Danger btn-sm mt-2">Eliminar</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Fin Modal Eliminar -->

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


            

<!-- NUEVO MODAL DE ADMINLTE -->
<div class="modal fade" id="ModalNuevo">
  <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Cambio aquí -->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Nueva Editorial</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Cambio aquí -->
              <div class="card card-primary">
                <div class="card-body">
                  <label>Código :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtCodigo" id="txtCodigoId" class="form-control" placeholder="Código">
                  </div>

                  <label>Nombre Editorial :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtNombreEditorial" class="form-control" placeholder="Nombre Editorial">
                  </div>

                  <label>Dirección :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtDireccion" class="form-control" placeholder="Dirección">
                  </div>

                  <label>Teléfono :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtTelefonoEditorial" class="form-control" placeholder="Teléfono">
                  </div>
                  <button type="submit" name="btnGrabar" class="btn btn-primary btn-sm mt-2">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Fin Modal Nuevo -->
