<?php
class GeneroData {

  public static function getAllGeneros()
  {
    try {
      $sql = "SELECT * FROM tab_generos 
              ORDER BY NOMBRE_GENERO";
      $conexion = Database::getCon(); // Asumiendo que tienes una clase Database con el método getCon()
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

  public static function getNombreGeneroById($genero_id)
  {
    try {
      $sql = "SELECT NOMBRE_GENERO FROM tab_generos
              WHERE ID_GENERO=:pgenero_id";
      $conexion = Database::getCon(); // Asumiendo que tienes una clase Database con el método getCon()
      $stmt = $conexion->prepare($sql);
      $stmt->bindparam(":pgenero_id", $genero_id);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        return $registro['NOMBRE_GENERO'];
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
