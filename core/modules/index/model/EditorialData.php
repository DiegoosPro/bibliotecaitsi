<?php 
class EditorialData {

  public static function getAllEditoriales()
  {
    try {
      $sql = "SELECT * FROM tab_editorial 
              ORDER BY NOMBRE_EDITORIAL";
      $conexion = Database::getCon(); // Asumo que tienes una clase Database que maneja la conexión a la base de datos.
      $stmt = $conexion->prepare($sql);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
      } else {
        return null;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }

  public static function getEditorialById($editorial_id)
  {
    try {
      $sql = "SELECT * FROM tab_editorial
              WHERE ID_EDITORIAL = :peditorial_id";
      $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindparam(":peditorial_id", $editorial_id);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        return $registro;
      } else {
        return null;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }

  public static function insertEditorial(
      $editorial_id,
      $nombre_editorial,
      $direccion,
      $telefono_editorial
    ) {
      try {
        $sql = "INSERT INTO tab_editorial (ID_EDITORIAL, NOMBRE_EDITORIAL, DIRECCION, TELEFONO_EDITORIAL)
        VALUES(:peditorial_id, :pnombre_editorial, :pdireccion, :ptelefono_editorial)";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":peditorial_id", $editorial_id);
        $stmt->bindparam(":pnombre_editorial", $nombre_editorial);
        $stmt->bindparam(":pdireccion", $direccion);
        $stmt->bindparam(":ptelefono_editorial", $telefono_editorial);
        $stmt->execute();
        return true; // Opcional
      } catch (PDOException $e) {
        echo $e->getMessage();
        return false; // Opcional
      }
    }

  public static function updateEditorial(
      $editorial_id,
      $nombre_editorial,
      $direccion,
      $telefono_editorial
    ) {
      try {
        $sql = "UPDATE tab_editorial SET 
               NOMBRE_EDITORIAL=:pnombre_editorial,
               DIRECCION=:pdireccion,
               TELEFONO_EDITORIAL=:ptelefono_editorial
               WHERE ID_EDITORIAL=:peditorial_id";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":peditorial_id", $editorial_id);
        $stmt->bindparam(":pnombre_editorial", $nombre_editorial);
        $stmt->bindparam(":pdireccion", $direccion);
        $stmt->bindparam(":ptelefono_editorial", $telefono_editorial);
        $stmt->execute();
        return true; // Opcional
      } catch (PDOException $e) {
        echo $e->getMessage();
        return false; // Opcional
      }
    }

  public static function deleteEditorial($editorial_id) {
    try {
      $sql ="DELETE FROM tab_editorial WHERE ID_EDITORIAL=:peditorial_id";
      $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindparam(":peditorial_id", $editorial_id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

}
 ?>
