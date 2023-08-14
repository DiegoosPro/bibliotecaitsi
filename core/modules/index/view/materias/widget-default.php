<?php

$datos = MateriaData::getAllMaterias();

if (isset($_POST['btnGrabar'])) {
  $nombre_materia = $_POST['txtNombreMateria'];

  if (MateriaData::insertMateria(
    $nombre_materia
  )) {
    echo '<script>
      Swal.fire({
        title: "¡Éxito!",
        text: "Datos de la materia grabados correctamente",
        icon: "success",
        confirmButtonText: "Cerrar"
      }).then(function(result) {
        if (result.value) {
          window.location = "?view=materias"; // Cambiar a la ruta deseada
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
          window.location = "?view=materias"; // Cambiar a la ruta deseada
        }
      });
    </script>';
  }
}

if (isset($_POST['btnUpdate'])) {
  $materia_id = $_POST['txtCodigo'];
  $nombre_materia = $_POST['txtNombreMateria'];

  if (MateriaData::updateMateria(
    $materia_id,
    $nombre_materia
  )) {
    echo '<script>
      Swal.fire({
        title: "¡Éxito!",
        text: "Datos de la materia actualizados correctamente",
        icon: "success",
        confirmButtonText: "Cerrar"
      }).then(function(result) {
        if (result.value) {
          window.location = "?view=materias"; // Cambiar a la dirección correcta
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
          window.location = "?view=materias"; // Cambiar a la dirección correcta
        }
      });
    </script>';
  }
}

if (isset($_POST['btnDelete'])) {
  $materia_id = $_POST['txtMateriaId'];
  MateriaData::deleteMateria($materia_id);
  
  echo '<script>
    Swal.fire({
      title: "¡Eliminado!",
      text: "Materia eliminada correctamente",
      icon: "success",
      confirmButtonText: "Cerrar"
    }).then(function(result) {
      if (result.value) {
        window.location = "?view=materias"; // Recargar la página actual
      }
    });
  </script>';
}

?>


<!-- Button trigger modal -->
<!-- Botón para agregar nueva materia -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalNuevo">
    Agregar Nueva Materia
</button>

<br>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">PAGINA MATERIAS</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre Materia</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($datos != null) {
                  foreach ($datos as $indice => $row) {
                    ?>
                    <tr>
                      <th scope="row"><?php echo $row['ID_MATERIAS']; ?></th>
                      <td><?php echo $row['NOMBRE_MATERIA']; ?></td>
                      <td>
                        <a href="#" class="btn btn-sm btn-info">Ver</a>

                        <!-- Modal Editar -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEditar<?php echo $row['ID_MATERIAS']; ?>">
                          Editar
                        </button>
                        <!-- Fin Modal Editar -->

                        <!-- Modal  EDITAR-->
                        <div class="modal fade" id="ModalEditar<?php echo $row['ID_MATERIAS']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                $datosMateria = MateriaData::getMateriaById($row['ID_MATERIAS']);
                                ?>
                                <form method="post" enctype="multipart/form-data">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="card card-primary">
                                        <div class="card-body">
                                          <label>ID :</label>
                                          <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                            <input type="text" name="txtCodigo" id="txtCodigoId" value="<?php echo $datosMateria['ID_MATERIAS']; ?>" readonly class="form-control" placeholder="ID">
                                          </div>
                                          <label>Nombre Materia :</label>
                                          <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                            <input type="text" name="txtNombreMateria" value="<?php echo $datosMateria['NOMBRE_MATERIA']; ?>" class="form-control" placeholder="Nombre Materia">
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
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalEliminar<?php echo $row['ID_MATERIAS']; ?>">
                          Eliminar
                        </button>
                        <div class="modal fade" id="ModalEliminar<?php echo $row['ID_MATERIAS']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Eliminar Materia</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="post">
                                  <h4>¿Está seguro?</h4>
                                  <input type="hidden" name="txtMateriaId" value="<?php echo $row['ID_MATERIAS']; ?>">
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
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Nueva Materia</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-body">
                  <label>Nombre Materia:</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtNombreMateria" class="form-control" placeholder="Nombre Materia">
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
