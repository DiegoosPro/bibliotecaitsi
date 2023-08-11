-- Insertar datos en la tabla TAB_AUTORES
INSERT INTO TAB_AUTORES ( NOMBRE_AUTOR) VALUES
    ( 'Juan Pérez'),
    ( 'María Gómez'),
    ( 'Carlos Rodríguez');

-- Insertar datos en la tabla TAB_EDITORIAL
INSERT INTO TAB_EDITORIAL (NOMBRE_EDITORIAL, DIRECCION, TELEFONO_EDITORIAL) VALUES
    ('Editorial ABC', 'Calle Principal 123', '123-456-7890'),
    ('Editorial XYZ', 'Avenida Central 456', '987-654-3210');

-- Insertar datos en la tabla TAB_GENEROS
INSERT INTO TAB_GENEROS (NOMBRE_GENERO) VALUES
    ('Programación'),
    ('Ciencia Ficción'),
    ('Tecnología');

-- Insertar datos en la tabla TAB_MATERIAS
INSERT INTO TAB_MATERIAS (NOMBRE_MATERIA) VALUES
    ('Ingeniería de Software'),
    ('Bases de Datos'),
    ('Inteligencia Artificial');

-- Insertar datos en la tabla TAB_LIBROS
INSERT INTO TAB_LIBROS (ID_EDITORIAL, ID_GENERO, ID_MATERIAS, ID_AUTOR, TITULO, ANIO_PUBLICACION, DISPONIBILIDAD, IMAGEN) VALUES
    (1, 1, 1, 1, 'Desarrollo Ágil de Software', '2020-01-01', 1, 'agile.jpg'),
    (2, 2, 2, 2, 'Viaje a las Estrellas', '2018-05-15', 1, 'star_trek.jpg'),
    (1, 3, 3, 3, 'Introducción a la Inteligencia Artificial', '2019-09-20', 1, 'ai_intro.jpg');

-- Insertar datos en la tabla TAB_PERFIL
INSERT INTO TAB_PERFIL (PER_NOMBRE) VALUES
    ('Administrador'),
    ('Bibliotecario'),
    ('Estudiante');

-- Insertar datos en la tabla TAB_USERS
INSERT INTO TAB_USERS (PER_ID, USER_USUARIO, USER_CONTRA, USER_NOMBRE, USER_ACTIVO, USER_CREATE_AT) VALUES
    (1, 'admin', 'admin', 'DIEGO CACUANGO', 1, NOW()),
    (2, 'pepe', '123', 'ALEX FLORES', 1, NOW());
    
