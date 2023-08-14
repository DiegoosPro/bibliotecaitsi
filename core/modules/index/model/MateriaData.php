<?php 
class MateriaData {

  public static function getAllMaterias()
  {
    try {
      $sql = "SELECT * FROM tab_materias 
              ORDER BY NOMBRE_MATERIA";
      $conexion = Database::getCon();
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

  public static function getMateriaById($materia_id)
  {
    try {
      $sql = "SELECT * FROM tab_materias
              WHERE ID_MATERIAS = :pmateria_id";
      $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindparam(":pmateria_id", $materia_id);
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

  public static function insertMateria(
      $nombre_materia
    ) {
      try {
        $sql = "INSERT INTO tab_materias (NOMBRE_MATERIA)
        VALUES(:pnombre_materia)";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":pnombre_materia", $nombre_materia);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }
    }

  public static function updateMateria(
      $materia_id,
      $nombre_materia
    ) {
      try {
        $sql = "UPDATE tab_materias SET 
               NOMBRE_MATERIA=:pnombre_materia
               WHERE ID_MATERIAS=:pmateria_id";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":pmateria_id", $materia_id);
        $stmt->bindparam(":pnombre_materia", $nombre_materia);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }
    }

  public static function deleteMateria($materia_id) {
    try {
      $sql ="DELETE FROM tab_materias WHERE ID_MATERIAS=:pmateria_id";
      $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindparam(":pmateria_id", $materia_id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

}
 ?>
