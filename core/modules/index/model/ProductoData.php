<?php

class ProductoData
{

    public static function getAllProductos()
    {
      try {
        $sql = "SELECT * FROM tab_productos p, tab_marcas m, tab_categorias c 
                    WHERE p.catego_id=c.catego_id
                    AND p.marca_id=m.marca_id
                    ORDER BY pro_descripcion";
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
    
    public static function getProductoById($idbusca)
    {
      try {
        $sql = "SELECT * FROM tab_productos
              WHERE pro_id=:ppro_id";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":ppro_id", $idbusca);
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
    
    public static function insertProducto(
      $pro_id,
      $pro_descripcion,
      $pro_precio_c,
      $pro_precio_v,
      $pro_stock,
      $pro_fecha_elab,
      $pro_nivel_azucar,
      $pro_aplica_iva,
      $pro_especifica,
      $pro_imagen,
      $marca_id,
      $catego_id
    ) {
      try {
        $sql = "INSERT INTO tab_productos (pro_id,pro_descripcion,pro_precio_c,pro_precio_v,pro_stock,pro_fecha_elab,pro_nivel_azucar,pro_aplica_iva,pro_especifica,pro_imagen,marca_id,catego_id)
        VALUES(:ppro_id,:ppro_descripcion,:ppro_precio_c,:ppro_precio_v,
        :ppro_stock,:ppro_fecha_elab,:ppro_nivel_azucar,:ppro_aplica_iva,
        :ppro_especifica,:ppro_imagen,:pmarca_id,:pcatego_id)";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":ppro_id", $pro_id);
        $stmt->bindparam(":ppro_descripcion", $pro_descripcion);
        $stmt->bindparam(":ppro_precio_c", $pro_precio_c);
        $stmt->bindparam(":ppro_precio_v", $pro_precio_v);
        $stmt->bindparam(":ppro_stock", $pro_stock);
        $stmt->bindparam(":ppro_fecha_elab", $pro_fecha_elab);
        $stmt->bindparam(":ppro_nivel_azucar", $pro_nivel_azucar);
        $stmt->bindparam(":ppro_aplica_iva", $pro_aplica_iva);
        $stmt->bindparam(":ppro_especifica", $pro_especifica);
        $stmt->bindparam(":ppro_imagen", $pro_imagen);
        $stmt->bindparam(":pmarca_id", $marca_id);
        $stmt->bindparam(":pcatego_id", $catego_id);
        $stmt->execute();
        return true; //OPCIONAL
      } catch (PDOException $e) {
        echo $e->getMessage();
        return false; //OPCIONAL
      }
    }
    
    public static function updateProducto(
      $pro_id, $pro_descripcion, $pro_precio_c,
      $pro_precio_v, $pro_stock,  $pro_fecha_elab,
      $pro_nivel_azucar,  $pro_aplica_iva,  $pro_especifica,
      $pro_imagen,  $marca_id,  $catego_id
    ) {
      try {
        $sql = "UPDATE tab_productos SET 
               pro_descripcion=:ppro_descripcion,
               pro_precio_c=:ppro_precio_c,
               pro_precio_v=:ppro_precio_v,
               pro_stock=:ppro_stock,
               pro_fecha_elab=:ppro_fecha_elab,
               pro_nivel_azucar=:ppro_nivel_azucar,
               pro_aplica_iva=:ppro_aplica_iva,
               pro_especifica=:ppro_especifica,
               pro_imagen=:ppro_imagen,
               marca_id=:pmarca_id,
               catego_id=:pcatego_id 
               WHERE pro_id=:ppro_id";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":ppro_id", $pro_id);
        $stmt->bindparam(":ppro_descripcion", $pro_descripcion);
        $stmt->bindparam(":ppro_precio_c", $pro_precio_c);
        $stmt->bindparam(":ppro_precio_v", $pro_precio_v);
        $stmt->bindparam(":ppro_stock", $pro_stock);
        $stmt->bindparam(":ppro_fecha_elab", $pro_fecha_elab);
        $stmt->bindparam(":ppro_nivel_azucar", $pro_nivel_azucar);
        $stmt->bindparam(":ppro_aplica_iva", $pro_aplica_iva);
        $stmt->bindparam(":ppro_especifica", $pro_especifica);
        $stmt->bindparam(":ppro_imagen", $pro_imagen);
        $stmt->bindparam(":pmarca_id", $marca_id);
        $stmt->bindparam(":pcatego_id", $catego_id);
        $stmt->execute();
        return true; //OPCIONAL
      } catch (PDOException $e) {
        echo $e->getMessage();
        return false; //OPCIONAL
      }
    }
    
    public static function deleteProducto($pro_id) {
      try {
        $sql ="DELETE FROM tab_productos WHERE pro_id=:ppro_id";
        $conexion = Database::getCon();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":ppro_id", $pro_id);
        $stmt->execute();
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
    


}
