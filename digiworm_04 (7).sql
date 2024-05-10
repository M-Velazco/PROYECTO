-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-05-2024 a las 20:13:24
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `digiworm_04`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `MoverCitasRealizadas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `MoverCitasRealizadas` ()   BEGIN
    -- Declara variables para la fecha y hora actual
    DECLARE fecha_actual DATE;
    DECLARE hora_actual TIME;
    SET fecha_actual = CURDATE();
    SET hora_actual = CURTIME();

    -- Mueve los registros de citas a citas_realizadas si la fecha y hora de la cita son anteriores a la fecha y hora actual
    INSERT INTO citas_realizadas (nombre, email, fecha, hora)
    SELECT nombre, email, fecha, hora
    FROM citas
    WHERE fecha < fecha_actual OR (fecha = fecha_actual AND hora < hora_actual);

    -- Elimina los registros de citas que se han movido a citas_realizadas
    DELETE FROM citas
    WHERE fecha < fecha_actual OR (fecha = fecha_actual AND hora < hora_actual);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

DROP TABLE IF EXISTS `actividades`;
CREATE TABLE IF NOT EXISTS `actividades` (
  `idActividades` int NOT NULL AUTO_INCREMENT,
  `Nombre_act` varchar(60) DEFAULT NULL,
  `Asignatura` varchar(100) NOT NULL,
  `Docente` int DEFAULT NULL,
  `Archivo` varchar(450) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') DEFAULT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `FechaEntrega` date NOT NULL,
  `FechaPublicacion` date NOT NULL,
  PRIMARY KEY (`idActividades`),
  KEY `Docente_nom_docente` (`Docente`),
  KEY `Asignaturas_Materias` (`Asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividades`, `Nombre_act`, `Asignatura`, `Docente`, `Archivo`, `Estado`, `Descripcion`, `FechaEntrega`, `FechaPublicacion`) VALUES
(38, 'prueba', 'Calculo', 142223657, 'Taller Circuitos Basicos.docx', 'Activo', 'prueba re conexion', '2024-04-11', '2024-04-10'),
(39, 'Prueba', 'Calculo', 0, '014128085378.pdf', 'Activo', 'Hola', '2024-04-13', '2024-04-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletines`
--

DROP TABLE IF EXISTS `boletines`;
CREATE TABLE IF NOT EXISTS `boletines` (
  `idBoletin` int NOT NULL AUTO_INCREMENT,
  `idEstudiante` int NOT NULL,
  `idDocente` int NOT NULL,
  `direccionArchivo` varchar(255) NOT NULL,
  `fechaCreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idBoletin`),
  KEY `idEstudiante` (`idEstudiante`),
  KEY `idDocente` (`idDocente`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `boletines`
--

INSERT INTO `boletines` (`idBoletin`, `idEstudiante`, `idDocente`, `direccionArchivo`, `fechaCreacion`) VALUES
(1, 1000162100, 0, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/Boletines/Validacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:31:07'),
(2, 1000162100, 0, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/Boletines/Validacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:33:00'),
(3, 1000162100, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/Boletines/Validacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:33:48'),
(4, 1000162100, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/Boletines/Validacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:34:21'),
(5, 100030256, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/Boletines/Validacion/boletines_estudiantes/boletin_100030256.pdf', '2024-04-02 13:35:07'),
(6, 1000162100, 1101343174, 'C:wamp64/www/PROYECTO/DIGIWORM..04/Boletines/Validacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:43:51'),
(7, 1000162100, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/Boletines/Validacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:47:33'),
(8, 1000162100, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/Boletines/Validacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:47:46'),
(9, 1000162100, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/Boletines/Validacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:51:47'),
(10, 1000162100, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/Boletines/Validacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:52:18'),
(11, 1000162100, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:54:22'),
(12, 1000162100, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:54:32'),
(13, 1000162100, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/boletines_estudiantes/boletin_1000162100.pdf', '2024-04-02 13:56:28'),
(14, 2000005978, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/boletines_estudiantes/boletin_2000005978.pdf', '2024-04-02 13:56:53'),
(15, 2000005978, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/boletines_estudiantes/boletin_2000005978_1.pdf', '2024-04-02 13:59:16'),
(16, 2000005978, 1101343174, 'C:wamp64wwwPROYECTODIGIWORM..04BoletinesValidacion/boletines_estudiantes/boletin_2000005978_2.pdf', '2024-04-02 14:00:04'),
(17, 100030256, 2147483647, 'boletin_100030256_3.pdf', '2024-04-10 02:41:58'),
(18, 100030256, 1101343174, 'boletin_100030256_4.pdf', '2024-04-13 02:40:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `nombre`, `email`, `fecha`, `hora`, `creado_en`) VALUES
(18, 'johan stiven', 'villabilons@gmail.com', '2024-04-12', '12:06:00', '2024-04-12 17:06:58'),
(19, 'Jenny ', 'jennyale1302@hotmail.com', '2024-04-15', '21:28:00', '2024-04-13 02:28:52'),
(20, 'Jenny ', 'roajennyalejandra1302@gmail.com', '2024-04-15', '21:28:00', '2024-04-13 02:30:41'),
(21, 'Juan Sierra', 'hernandezsierrajuan54@gmail.com', '2024-04-16', '08:49:00', '2024-04-15 13:53:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas_realizadas`
--

DROP TABLE IF EXISTS `citas_realizadas`;
CREATE TABLE IF NOT EXISTS `citas_realizadas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinador`
--

DROP TABLE IF EXISTS `coordinador`;
CREATE TABLE IF NOT EXISTS `coordinador` (
  `idCoordinador` int NOT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Pasword` varchar(45) DEFAULT NULL,
  `Jornada` enum('Mañana','Tarde') DEFAULT NULL,
  PRIMARY KEY (`idCoordinador`),
  KEY `NombreCoordinador_Nombres` (`Nombres`),
  KEY `ApellidoCoordinador_Apellido` (`Apellidos`),
  KEY `EmailCoordinador_Email` (`Email`),
  KEY `Password` (`Pasword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `coordinador`
--

INSERT INTO `coordinador` (`idCoordinador`, `Nombres`, `Apellidos`, `Email`, `Pasword`, `Jornada`) VALUES
(10000, 'Jimmy', 'Avila', 'Jimmy2020@gmail.com', '5a1dfc0934d7a2fe6b9d1c41e2913dca', 'Mañana'),
(1081394327, 'magdy', 'velazco', 'mvelazcovelasco17@gmail.com', '06a9d63a716592aafc74e37c4326e2db', 'Tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int NOT NULL AUTO_INCREMENT,
  `Nombre_curso` int DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') DEFAULT NULL,
  `Jornada` enum('Mañana','Tarde') NOT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `Jornada` (`Jornada`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `Nombre_curso`, `Estado`, `Jornada`) VALUES
(1, 1103, 'Activo', 'Mañana'),
(2, 1102, 'Activo', 'Mañana'),
(5, 1103, 'Activo', 'Tarde'),
(6, 1101, 'Activo', 'Mañana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE IF NOT EXISTS `docente` (
  `idDocente` int NOT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Pasword` varchar(45) DEFAULT NULL,
  `Curso` int DEFAULT NULL,
  `Jornada` enum('Mañana','Tarde') NOT NULL,
  `Certificacion` varchar(800) DEFAULT NULL,
  `Desc_prof` varchar(800) DEFAULT NULL,
  PRIMARY KEY (`idDocente`) USING BTREE,
  KEY `Curso_idCurso` (`Curso`),
  KEY `NombreDoc_Nombres` (`Nombres`),
  KEY `ApellidoDoc_Apellidos` (`Apellidos`),
  KEY `EmailDoc_Email` (`Email`),
  KEY `Password` (`Pasword`),
  KEY `Jornada` (`Jornada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`idDocente`, `Nombres`, `Apellidos`, `Email`, `Pasword`, `Curso`, `Jornada`, `Certificacion`, `Desc_prof`) VALUES
(0, 'Didierr', 'Orozco', 'Orozco09@gmail.com', '', 1, 'Mañana', NULL, 'doctorado en artes y etica ciudadana con ma de 10 años de experiencia en estudios academicos'),
(142223657, 'Didierr', 'Orozco', 'Orozco09@gmail.com', '', 1, 'Mañana', './files/Paz y Salvo.pdf', 'doctorado en artes y etica ciudadana con ma de 10 años de experiencia en estudios academicos'),
(1025678985, 'pruebaD', 'docente', 'docente@gmail.com', '1d7f7abc18fcb43975065399b0d1e48e', 0, 'Mañana', NULL, NULL),
(1054115102, 'Vilma ', 'Barrios Gomez', 'EldiabloAndante@gmail.com', '93d7abad7bbf270154ff3270fe46f4d3', 1, 'Tarde', './files/814402318257-9315909749-entrada.pdf', 'doctora en artes y etica ciudadana con ma de 10 años de experiencia en estudios academicos'),
(1101343174, 'juan david', 'julio rodriguez', 'draxjulio13@gmail.com', 'dfdc20cbab482c8d159f42d3250d1f7c', 1, 'Mañana', 'Docentes/files/814402318257-9315909749-entrada.pdf', ''),
(2000598691, 'testerjuan', 'tRodri', 'combxpedagogo+568532@gmail.com', 'eaeaae77dd04b1e2ba6d67f3e3834b23', 0, 'Mañana', NULL, NULL),
(2000598692, 'testerjuan', 'tRodri', 'combxpedagog+568532@gmail.com', 'eaeaae77dd04b1e2ba6d67f3e3834b23', 0, 'Mañana', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_materia`
--

DROP TABLE IF EXISTS `docente_materia`;
CREATE TABLE IF NOT EXISTS `docente_materia` (
  `idDocente` int NOT NULL,
  `idMateria` int NOT NULL,
  PRIMARY KEY (`idDocente`,`idMateria`),
  KEY `idMateria` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `docente_materia`
--

INSERT INTO `docente_materia` (`idDocente`, `idMateria`) VALUES
(0, 1),
(0, 2),
(0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
CREATE TABLE IF NOT EXISTS `estudiante` (
  `idEstudiante` int NOT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Pasword` varchar(45) DEFAULT NULL,
  `Curso` int DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`idEstudiante`),
  KEY `curso_cursoid` (`Curso`),
  KEY `NombreEst_Nombre` (`Nombres`),
  KEY `ApellidoEst_Apellido` (`Apellidos`),
  KEY `EmailEst_Email` (`Email`),
  KEY `PasswordEst_password` (`Pasword`),
  KEY `Estado_Est_Usr` (`Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idEstudiante`, `Nombres`, `Apellidos`, `Email`, `Pasword`, `Curso`, `Estado`) VALUES
(124, 'Johan Santiago', 'Villanueva Roa', 'villablilons@gmail.com', '117f6456278025caef09ab127b92c880', 0, 'Activo'),
(100030256, 'Santiago', 'Orjuela', 'orjtailand@gmail.com', '12157a63af655888c72bcb10bfbf0cc7', 2, 'Inactivo'),
(1000162100, 'johan stiven', 'oliveros silva', 'oliverosilvajohan@gmail.com', 'c5d7790b7bd682f9b2aef12aa94eb8bb', 2, 'Inactivo'),
(2000005978, 'prueba de restriccion', 'padres', 'dfgfdg@gmail.com', '202cb962ac59075b964b07152d234b70', 2, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

DROP TABLE IF EXISTS `foros`;
CREATE TABLE IF NOT EXISTS `foros` (
  `idForos` int NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(60) DEFAULT NULL,
  `Contenido` varchar(700) DEFAULT NULL,
  `Fecha_Hora` datetime NOT NULL,
  `archivo` varchar(500) NOT NULL,
  `idusuario` int DEFAULT NULL,
  `respuesta` varchar(500) DEFAULT NULL,
  `Estado` varchar(500) NOT NULL,
  PRIMARY KEY (`idForos`),
  KEY `idUsuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `foros`
--

INSERT INTO `foros` (`idForos`, `Titulo`, `Contenido`, `Fecha_Hora`, `archivo`, `idusuario`, `respuesta`, `Estado`) VALUES
(14, 'Prueba', 'Esta es una prueba de funcionalidad', '2024-03-07 19:44:00', 'archivos/Frima.png', 1081394327, 'xd\nhola\n', 'activo'),
(15, 'Prueba dos', 'Validacion de funcionamiento', '2024-03-07 19:58:00', 'archivos/OIP (1).jpg', 1030537206, 'messi\nmessi\naeiou\nhola\naa\n', 'inactivo'),
(16, 'futbol', 'messi', '2024-03-23 19:10:00', 'archivos/avatar.jpg', 1000162100, 'eee\nww\nww\n', 'activo'),
(17, 'lalala', 'cfgjufu', '2024-04-05 15:31:00', 'archivos/cara2.jpg', 1101343174, NULL, ''),
(18, 'lalala', 'cfghfghfgh', '2024-04-10 21:48:00', 'archivos/boletin_100030256_3.pdf', 2147483647, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `idMaterias` int NOT NULL AUTO_INCREMENT,
  `Nombre_Materia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMaterias`),
  KEY `Nombre_Materia` (`Nombre_Materia`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idMaterias`, `Nombre_Materia`) VALUES
(3, 'Calculo'),
(2, 'Español'),
(1, 'Ingles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `Idmensaje` int NOT NULL AUTO_INCREMENT,
  `Mensaje_entrante` int DEFAULT NULL,
  `Mensaje_saliente` int DEFAULT NULL,
  `Mensaje` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Idmensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`Idmensaje`, `Mensaje_entrante`, `Mensaje_saliente`, `Mensaje`) VALUES
(1, 1068732649, 1030521423, 'r5y6rty'),
(2, 1059643579, 1030521423, 'hola'),
(3, 1030521423, 1059643579, 'como estas'),
(6, 1030521423, 1101443174, 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

DROP TABLE IF EXISTS `opiniones`;
CREATE TABLE IF NOT EXISTS `opiniones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nombres_Apellidos` varchar(200) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Opinion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iDpadres` (`Nombres_Apellidos`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`id`, `Nombres_Apellidos`, `Email`, `Opinion`) VALUES
(8, 'Magdy Velazco', 'mvelazco17@gmail.com', 'excelente'),
(9, 'Johan Santiago', 'loca@gmail.com', 'Que buen aplicativo'),
(10, 'Perfecto ', 'villabilons@gmail.com', 'Me parece una gran app');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padre_familia`
--

DROP TABLE IF EXISTS `padre_familia`;
CREATE TABLE IF NOT EXISTS `padre_familia` (
  `idPadre_Familia` int NOT NULL,
  `Estado_representante` int DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPadre_Familia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

DROP TABLE IF EXISTS `publicaciones`;
CREATE TABLE IF NOT EXISTS `publicaciones` (
  `idPublicaciones` int NOT NULL AUTO_INCREMENT,
  `Archivo` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `usuario` int DEFAULT NULL,
  PRIMARY KEY (`idPublicaciones`),
  KEY `usuario_usuarioId` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`idPublicaciones`, `Archivo`, `Descripcion`, `usuario`) VALUES
(2, '../img/testimonial-4.jpg', 'Prueba de insercion en publicaciones2', 1030537206),
(3, '../img/testimonial-4.jpg', 'Prueba de insercion en publicaciones2', 1030537206),
(6, 'publicUploads/publicacion_66061fd8289bc.pdf', 'prueba para de,ostracion', 2147483647),
(7, 'publicUploads/publicacion_660f1188996cd.docx', 'sdsetr', 1101343174),
(8, 'publicUploads/publicacion_660f12056b5a3.jpg', 'fghfgh', 1101343174),
(9, 'publicUploads/publicacion_6615fc4474e21.docx', 'hola', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reset_password_tokens`
--

DROP TABLE IF EXISTS `reset_password_tokens`;
CREATE TABLE IF NOT EXISTS `reset_password_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry_timestamp` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reset_password_tokens`
--

INSERT INTO `reset_password_tokens` (`id`, `user_id`, `token`, `expiry_timestamp`, `created_at`) VALUES
(1, 1030537206, 'dfa596c30c71c3fc48772a69a358d668', 1712945249, '2024-04-12 17:07:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `Idusuarios` int NOT NULL,
  `Nombres` varchar(60) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Telefono` bigint DEFAULT NULL,
  `Pasword` varchar(45) DEFAULT NULL,
  `img` varchar(500) DEFAULT NULL,
  `Rol` enum('Docente','Coordinador','Estudiante','Padre_familia','administrador') DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Idusuarios`),
  UNIQUE KEY `Email` (`Email`) USING BTREE,
  KEY `Nombres` (`Nombres`) USING BTREE,
  KEY `Apellidos` (`Apellidos`),
  KEY `Password` (`Pasword`),
  KEY `Estado` (`Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Idusuarios`, `Nombres`, `Apellidos`, `Email`, `Telefono`, `Pasword`, `img`, `Rol`, `Estado`, `status`) VALUES
(124, 'Johan Santiago', 'Villanueva Roa', 'villablilons@gmail.com', 9223372036854775807, '117f6456278025caef09ab127b92c880', 'img/img_660f1fdb5b5f8_ingles whats hapenned.jpg', 'Estudiante', 'Activo', NULL),
(10000, 'Jimmy', 'Avila', 'Jimmy2020@gmail.com', 3241742555, '5a1dfc0934d7a2fe6b9d1c41e2913dca', 'img/testimonial-4.jpg', 'Coordinador', 'Activo', 'Disponible'),
(1000162100, 'johan stiven', 'oliveros silva', 'oliverosilvajohan@gmail.com', 1234574125, '202cb962ac59075b964b07152d234b70', 'img/img_660f04b0e7246_avatar.jpg', 'Estudiante', 'Activo', ''),
(1025678985, 'pruebaD', 'docente', 'docente@gmail.com', 3234167703, '1d7f7abc18fcb43975065399b0d1e48e', 'img/img_6614b7979115d_c89f135f391170c34a8599024277be5d.jpg', 'Docente', 'Activo', NULL),
(1030537206, 'johan santiago', 'villanueva roa', 'villabilons@gmail.com', 3234167037, '2d95666e2649fcfc6e3af75e09f5adb9', 'img/img_65ea376a3a058_OIP (1).jpg', 'Padre_familia', 'Activo', 'Offline now'),
(1081394327, 'magdy', 'velazco', 'mvelazcovelasco17@gmail.com', 3142093310, '06a9d63a716592aafc74e37c4326e2db', 'img/img_65ea21409343f_avatar.jpg', 'Coordinador', 'Activo', 'Offline now'),
(1101343174, 'juan david', 'julio rodriguez', 'draxjulio13@gmail.com', 3145896225, 'dfdc20cbab482c8d159f42d3250d1f7c', 'img/img_6614b7979115d_c89f135f391170c34a8599024277be5d.jpg', 'Docente', 'Activo', 'Offline now'),
(2000005978, 'prueba de restriccion', 'padres', 'dfgfdg@gmail.com', 3234177037, '202cb962ac59075b964b07152d234b70', 'img/img_660b6d10cb26e_1652660564avatar.png', 'Estudiante', 'Activo', NULL),
(2000598691, 'testerjuan', 'tRodri', 'combxpedagogo+568532@gmail.com', 3234167703, 'eaeaae77dd04b1e2ba6d67f3e3834b23', 'img/img_6634fbcf042e6_goku.jpg', 'Docente', 'Activo', NULL),
(2000598692, 'testerjuan', 'tRodri', 'combxpedagog+568532@gmail.com', 3234167703, 'eaeaae77dd04b1e2ba6d67f3e3834b23', 'img/img_6634fcc05defd_img_660c7ddbc6927_goku.jpg', 'Docente', 'Activo', NULL),
(2147483647, 'ADMIN', 'VELAZCO VELASCO', 'digiworm04@gmail.com', 3143996415, '4d3bd6b319887ff8c7314551d1b5dd64', 'img/img_661573bd214e5_avatar.jpg', 'administrador', 'Activo', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `Asignaturas_Materias` FOREIGN KEY (`Asignatura`) REFERENCES `materias` (`Nombre_Materia`),
  ADD CONSTRAINT `Docente_nom_docente` FOREIGN KEY (`Docente`) REFERENCES `docente` (`idDocente`);

--
-- Filtros para la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD CONSTRAINT `EmailCoordinador_Email` FOREIGN KEY (`Email`) REFERENCES `usuarios` (`Email`),
  ADD CONSTRAINT `idcoordinador_usuarios` FOREIGN KEY (`idCoordinador`) REFERENCES `usuarios` (`Idusuarios`);

--
-- Filtros para la tabla `docente_materia`
--
ALTER TABLE `docente_materia`
  ADD CONSTRAINT `docente_materia_ibfk_1` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`),
  ADD CONSTRAINT `docente_materia_ibfk_2` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`idMaterias`);

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `Usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
