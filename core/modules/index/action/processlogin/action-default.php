<?php
if (!session_id()) session_start();
if (isset($_POST['btnIngresar'])) {
    $usuario = $_POST['txtUsuario'];
    $contra = $_POST['txtContra'];

    if (UserData::getLogin($usuario, $contra)) {
        print "<script>window.location='./'</script>";

    } else {
         print "<script>window.location='./'</script>";
        $error = "Acceso fallido !";
    }
}


?>