<?php

if (!session_id()) session_start();

// -- eliminamos el usuario
if (isset($_SESSION['USER_ID'])) {
    //UserData::updateEnLinea($_SESSION['sisgauser_cedula']);
    unset($_SESSION['USER_ID']);
}
session_destroy();
print "<script>window.location='index.php';</script>";
?>

