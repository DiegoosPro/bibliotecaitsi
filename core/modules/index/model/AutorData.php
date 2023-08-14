<?php
class AutorData {

  public static function getAllAutores()
  {
    try {
      $sql = "SELECT a.*, p.pais_nombre FROM tab_autores a
              INNER JOIN tab_paises p ON a.pais_id = p.paies_id
              ORDER BY a.NOMBRE_AUTOR";
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

  public static function getAutorById($autor_id)
  {
    try {
      $sql = "SELECT a.*, p.pais_nombre FROM tab_autores a
              INNER JOIN tab_paises p ON a.pais_id = p.paies_id
              WHERE a.ID_AUTOR = :pautor_id";
      $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindValue(":pautor_id", $autor_id, PDO::PARAM_INT);
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

  public static function insertAutor(
      $nombre_autor,
      $pais_id
    ) {
      try {
        $sql = "INSERT INTO tab_autores (NOMBRE_AUTOR, pais_id)
        VALUES(:pnombre_autor, :ppais_id)";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":pnombre_autor", $nombre_autor, PDO::PARAM_STR);
        $stmt->bindValue(":ppais_id", $pais_id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }
    }

  public static function updateAutor(
      $autor_id,
      $nombre_autor,
      $pais_id
    ) {
      try {
        $sql = "UPDATE tab_autores SET 
               NOMBRE_AUTOR=:pnombre_autor,
               pais_id=:ppais_id
               WHERE ID_AUTOR=:pautor_id";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(":pautor_id", $autor_id, PDO::PARAM_INT);
        $stmt->bindValue(":pnombre_autor", $nombre_autor, PDO::PARAM_STR);
        $stmt->bindValue(":ppais_id", $pais_id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }
    }

  public static function deleteAutor($autor_id) {
    try {
      $sql ="DELETE FROM tab_autores WHERE ID_AUTOR=:pautor_id";
      $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindValue(":pautor_id", $autor_id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public static function getNombreAutorById($autor_id)
  {
    try {
      $sql = "SELECT NOMBRE_AUTOR FROM tab_autores
              WHERE ID_AUTOR=:pautor_id";
      $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindValue(":pautor_id", $autor_id, PDO::PARAM_INT);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        return $registro['NOMBRE_AUTOR'];
      } else {
        return null;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }
}
?>
