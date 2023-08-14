<?php 
class AutorData {

  public static function getAllAutores()
  {
    try {
      $sql = "SELECT * FROM tab_autores 
              ORDER BY NOMBRE_AUTOR";
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
      $sql = "SELECT * FROM tab_autores
              WHERE ID_AUTOR = :pautor_id";
      $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindparam(":pautor_id", $autor_id);
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
      $nacionalidad
    ) {
      try {
        $sql = "INSERT INTO tab_autores (NOMBRE_AUTOR, NACIONALIDAD)
        VALUES(:pnombre_autor, :pnacionalidad)";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":pnombre_autor", $nombre_autor);
        $stmt->bindparam(":pnacionalidad", $nacionalidad);
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
      $nacionalidad
    ) {
      try {
        $sql = "UPDATE tab_autores SET 
               NOMBRE_AUTOR=:pnombre_autor,
               NACIONALIDAD=:pnacionalidad
               WHERE ID_AUTOR=:pautor_id";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":pautor_id", $autor_id);
        $stmt->bindparam(":pnombre_autor", $nombre_autor);
        $stmt->bindparam(":pnacionalidad", $nacionalidad);
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
      $stmt->bindparam(":pautor_id", $autor_id);
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
    $stmt->bindparam(":pautor_id", $autor_id);
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