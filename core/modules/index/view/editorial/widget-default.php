<?php

$datos = EditorialData::getAllEditoriales();

if (isset($_POST['btnGrabar'])) {
  $editorial_id = $_POST['txtCodigo'];
  $nombre_editorial = $_POST['txtNombreEditorial'];
  $direccion = $_POST['txtDireccion'];
  $telefono_editorial = $_POST['txtTelefonoEditorial'];

  if (EditorialData::insertEditorial(
    $editorial_id,
    $nombre_editorial,
    $direccion,
    $telefono_editorial
  ) == true) {
    echo "DATOS DE LA EDITORIAL GRABADOS CORRECTAMENTE";
  } else {
    echo "**** NO SE PUDO GRABAR, REVISE LOS DATOS O EL CÓDIGO ****";
  }
}

if (isset($_POST['btnUpdate'])) {
  $editorial_id = $_POST['txtCodigo'];
  $nombre_editorial = $_POST['txtNombreEditorial'];
  $direccion = $_POST['txtDireccion'];
  $telefono_editorial = $_POST['txtTelefonoEditorial'];

  if (EditorialData::updateEditorial(
    $editorial_id,
    $nombre_editorial,
    $direccion,
    $telefono_editorial
  ) == true) {
    echo "DATOS DE LA EDITORIAL ACTUALIZADOS CORRECTAMENTE";
  } else {
    echo "**** NO SE PUDO ACTUALIZAR, REVISE LOS DATOS O EL CÓDIGO ****";
  }
}

if (isset($_POST['btnDelete'])) {
  $editorial_id = $_POST['txtEditorialId'];
  EditorialData::deleteEditorial($editorial_id);
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
                <h3 class="card-title">PAGINA EDITORIALES</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre Editorial</th>
      <th scope="col">Dirección</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($datos != null) {
      foreach ($datos as $indice => $row) {
    ?>
        <tr>
          <th scope="row"><?php echo $row['ID_EDITORIAL']; ?></th>
          <td><?php echo $row['NOMBRE_EDITORIAL']; ?></td>
          <td><?php echo $row['DIRECCION']; ?></td>
          <td><?php echo $row['TELEFONO_EDITORIAL']; ?></td>
        
          <td>
            <a href="#" class="btn btn-sm btn-info">Ver</a>
            <!-- Modal Editar -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEditar<?php echo $row['ID_EDITORIAL']; ?>">
              Editar
            </button>

            <!-- Modal  EDITAR-->
            <div class="modal fade" id="ModalEditar<?php echo $row['ID_EDITORIAL']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        $datosEditorial = EditorialData::getEditorialById($row['ID_EDITORIAL']);
        ?>
        <form method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-12"> <!-- Cambio aquí -->
              <div class="card card-primary">
                <div class="card-body">
                  <label>Código :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtCodigo" id="txtCodigoId" value="<?php echo $datosEditorial['ID_EDITORIAL']; ?>" readonly class="form-control" placeholder="Código">
                  </div>

                  <label>Nombre Editorial :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtNombreEditorial" value="<?php echo $datosEditorial['NOMBRE_EDITORIAL']; ?>" class="form-control" placeholder="Nombre Editorial">
                  </div>

                  <label>Dirección :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtDireccion" value="<?php echo $datosEditorial['DIRECCION']; ?>" class="form-control" placeholder="Dirección">
                  </div>

                  <label>Teléfono :</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="txtTelefonoEditorial" value="<?php echo $datosEditorial['TELEFONO_EDITORIAL']; ?>" class="form-control" placeholder="Teléfono">
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

            <!-- Fin Modal Editar -->

            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalEliminar<?php echo $row['ID_EDITORIAL']; ?>">
              Eliminar
            </button>

            <!-- Modal  Eliminar-->
            <div class="modal fade" id="ModalEliminar<?php echo $row['ID_EDITORIAL']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Eliminar Editorial</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post">
                      <h4>¿Está seguro?</h4>
                      <input type="hidden" name="txtEditorialId" value="<?php echo $row['ID_EDITORIAL']; ?>">
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
