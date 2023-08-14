<?php
class PaisData{

  public static function getAllPaises()
  {
    try {
      $sql = "SELECT * FROM tab_paises 
              ORDER BY pais_nombre";
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

  public static function getNombrePaisById($pais_id)
  {
    try {
      $sql = "SELECT pais_nombre FROM tab_paises
              WHERE pais_id=:ppais_id";
      $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindparam(":ppais_id", $pais_id);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        return $registro['pais_nombre'];
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
