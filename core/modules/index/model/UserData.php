<?php
date_default_timezone_set("America/Bogota");
class UserData
{


    public static function getLogin($usuario, $contra)
{
    try {
        $sql = "SELECT * FROM tab_users u, tab_perfil p 
                   WHERE p.PER_ID=u.PER_ID
                   AND u.USER_USUARIO=:pusuario";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":pusuario", $usuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($contra == $userRow['USER_CONTRA']) {
                if ($userRow['USER_ACTIVO'] == 1) {
                    if (!isset($_SESSION)) {
                        session_destroy();
                        session_start();
                    }

                    $_SESSION['USER_ID'] = $userRow['USER_ID'];
                    $_SESSION['USER_NOMBRE'] = $userRow['USER_NOMBRE']; 
                    $_SESSION['USER_PERFIL'] = $userRow['PER_NOMBRE']; 
                    $_SESSION['USER_ERROR'] = null;
                    $_SESSION['LAST_TIME'] = time();

                    //******************* AUXILIARES ************************************

                    $_SESSION['MENSAJE'] = null;

                    return true;
                } else {
                    $_SESSION['USER_ERROR'] = "Estimado usuario, usted NO tiene autorización para utilizar el sistema, consulte al Administrador";
                    return false;
                }
            } else {
                $_SESSION['USER_ERROR'] = "Usuario y/o Contraseña incorrectas..!!!";
                return false;
            }
        } else {
            $_SESSION['USER_ERROR'] = "Usuario y/o Contraseña incorrectas, intente de nuevo..!!!";
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


public static function verificaSession()
{
    if (!session_id()) session_start();
    if (isset($_SESSION['USER_ID']) && $_SESSION['USER_NOMBRE'] != null) {
        if ((time() - $_SESSION['LAST_TIME']) < 300) {
            $_SESSION['LAST_TIME'] = time();
        } else {
            Core::redir("./?view=logout");
        }
    } else {
        Core::redir("./?view=logout");
    }
}



    public static function redirect($url)
    {
        View::load("login");
    }
}
