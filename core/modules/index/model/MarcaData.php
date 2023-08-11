<?php
class MarcaData{

  public static function getAllMarcas()
{
  try {
    $sql = "SELECT * FROM tab_marcas 
                ORDER BY marca_descripcion";
     $conexion = Database::getCon();
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $lista;
    } else
      return null;
  } catch (PDOException $e) {
    echo $e->getMessage();
    return null;
  }
}

public static function getNombeMarcaById($marca_id)
{
  try {
    $sql = "SELECT marca_descripcion FROM tab_marcas
              WHERE marca_id=:pmarca_id";
     $conexion = Database::getCon();
    $stmt = $conexion->prepare($sql);
    $stmt->bindparam(":pmarca_id", $marca_id);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $registro = $stmt->fetch(PDO::FETCH_ASSOC);
      return $registro['marca_descripcion'];
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