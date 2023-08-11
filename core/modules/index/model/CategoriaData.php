<?php
class CategoriaData{

  public static function getAllCategorias()
  {
    try {
      $sql = "SELECT * FROM tab_categorias 
                  ORDER BY catego_descripcion";
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
  
  public static function getNombreCategoriaById($catego_id)
  {
    try {
      $sql = "SELECT catego_descripcion FROM tab_categorias
                WHERE catego_id=:pcatego_id";
       $conexion = Database::getCon();
      $stmt = $conexion->prepare($sql);
      $stmt->bindparam(":pcatego_id", $catego_id);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        return $registro['catego_descripcion'];
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