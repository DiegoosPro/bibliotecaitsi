<?php 
class LibroData
{
    public static function getAllLibros()
    {
        try {
            $sql = "SELECT * FROM tab_libros l
                    INNER JOIN tab_editorial e ON l.ID_EDITORIAL = e.ID_EDITORIAL
                    INNER JOIN tab_generos g ON l.ID_GENERO = g.ID_GENERO
                    INNER JOIN tab_materias m ON l.ID_MATERIAS = m.ID_MATERIAS
                    INNER JOIN tab_autores a ON l.ID_AUTOR = a.ID_AUTOR
                    ORDER BY TITULO";
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
    
    public static function getLibroById($idbusca)
    {
        try {
            $sql = "SELECT * FROM tab_libros WHERE ID_LIBRO = :plibro_id";
            $conexion = Database::getCon();
            $stmt = $conexion->prepare($sql);
            $stmt->bindparam(":plibro_id", $idbusca);
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
    
    public static function insertLibro(
      $editorial_id,
      $genero_id,
      $materia_id,
      $autor_id,
      $titulo,
      $anio_publicacion,
      $disponibilidad,
      $imagen
    ) {
        try {
            $sql = "INSERT INTO tab_libros (ID_EDITORIAL, ID_GENERO, ID_MATERIAS, ID_AUTOR, TITULO, ANIO_PUBLICACION, DISPONIBILIDAD, IMAGEN)
                    VALUES (:peditorial_id, :pgenero_id, :pmateria_id, :pautor_id, :ptitulo, :panio_publicacion, :pdisponibilidad, :pimagen)";
            $conexion = Database::getCon();
            $stmt = $conexion->prepare($sql);
            $stmt->bindparam(":peditorial_id", $editorial_id);
            $stmt->bindparam(":pgenero_id", $genero_id);
            $stmt->bindparam(":pmateria_id", $materia_id);
            $stmt->bindparam(":pautor_id", $autor_id);
            $stmt->bindparam(":ptitulo", $titulo);
            $stmt->bindparam(":panio_publicacion", $anio_publicacion);
            $stmt->bindparam(":pdisponibilidad", $disponibilidad);
            $stmt->bindparam(":pimagen", $imagen);
            $stmt->execute();
            return true; // Opcional
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false; // Opcional
        }
    }

    public static function updateLibro(
      $libro_id,
      $editorial_id,
      $genero_id,
      $materia_id,
      $autor_id,
      $titulo,
      $anio_publicacion,
      $disponibilidad,
      $imagen
    ) {
        try {
            $sql = "UPDATE tab_libros SET 
                    ID_EDITORIAL = :peditorial_id,
                    ID_GENERO = :pgenero_id,
                    ID_MATERIAS = :pmateria_id,
                    ID_AUTOR = :pautor_id,
                    TITULO = :ptitulo,
                    ANIO_PUBLICACION = :panio_publicacion,
                    DISPONIBILIDAD = :pdisponibilidad,
                    IMAGEN = :pimagen
                    WHERE ID_LIBRO = :plibro_id";
            $conexion = Database::getCon();
            $stmt = $conexion->prepare($sql);
            $stmt->bindparam(":plibro_id", $libro_id);
            $stmt->bindparam(":peditorial_id", $editorial_id);
            $stmt->bindparam(":pgenero_id", $genero_id);
            $stmt->bindparam(":pmateria_id", $materia_id);
            $stmt->bindparam(":pautor_id", $autor_id);
            $stmt->bindparam(":ptitulo", $titulo);
            $stmt->bindparam(":panio_publicacion", $anio_publicacion);
            $stmt->bindparam(":pdisponibilidad", $disponibilidad);
            $stmt->bindparam(":pimagen", $imagen);
            $stmt->execute();
            return true; // Opcional
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false; // Opcional
        }
    }

    public static function deleteLibro($libro_id) {
        try {
            $sql = "DELETE FROM tab_libros WHERE ID_LIBRO = :plibro_id";
            $conexion = Database::getCon();
            $stmt = $conexion->prepare($sql);
            $stmt->bindparam(":plibro_id", $libro_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}



 ?>