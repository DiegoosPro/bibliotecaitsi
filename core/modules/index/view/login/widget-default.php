
<div class="row">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h5>Acceso al sistema</h5>
    </div>
    <div class="card-body">
    <?php
if (isset($_SESSION['USER_ERROR']) && $_SESSION['USER_ERROR'] != null) {
    ?>
    <div class="alert alert-danger">
        <i class="fa fa-warning"></i>
        &nbsp; <?php echo $_SESSION['USER_ERROR']; ?> !
    </div>
    <?php
    $_SESSION['USER_ERROR'] = null;
}
?>


      <form action="./?action=processlogin" method="post">
        <div class="input-group mb-3">
            <label>Usuario:</label>
          <input type="text" class="form-control" name="txtUsuario" placeholder="usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <label>Contraseña:</label>
          <input type="password" class="form-control" name="txtContra" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="btnIngresar" class="btn btn-success btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



      <p class="mb-1">
        <a href="forgot-password.html">Olvide mi contraseña</a>
      </p>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
</div>