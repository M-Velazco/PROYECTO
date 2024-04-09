-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-03-2024 a las 20:28:44
-- Versión del servidor: 5.7.40
-- Versión de PHP: 8.0.26

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
  `idActividades` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_act` varchar(60) DEFAULT NULL,
  `Asignatura` varchar(100) NOT NULL,
  `Docente` int(11) DEFAULT NULL,
  `Archivo` varchar(450) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') DEFAULT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `FechaEntrega` date NOT NULL,
  `FechaPublicacion` date NOT NULL,
  PRIMARY KEY (`idActividades`),
  KEY `Docente_nom_docente` (`Docente`),
  KEY `Asignaturas_Materias` (`Asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividades`, `Nombre_act`, `Asignatura`, `Docente`, `Archivo`, `Estado`, `Descripcion`, `FechaEntrega`, `FechaPublicacion`) VALUES
(35, 'taller circuitos', 'Calculo', 142223657, 'Taller Circuitos Basicos.docx', 'Activo', 'taller de circuitos y resistencias favor completar para mañana', '2024-03-14', '2024-03-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas_realizadas`
--

DROP TABLE IF EXISTS `citas_realizadas`;
CREATE TABLE IF NOT EXISTS `citas_realizadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinador`
--

DROP TABLE IF EXISTS `coordinador`;
CREATE TABLE IF NOT EXISTS `coordinador` (
  `idCoordinador` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `Nombre_curso`, `Estado`, `Jornada`) VALUES
(1, 1103, 'Activo', 'Mañana'),
(2, 1102, 'Activo', 'Tarde');
COMMIT;

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
  `Materia` int DEFAULT NULL,
  `Jornada` enum('Mañana','Tarde') NOT NULL,
  `Certificacion` varchar(800) DEFAULT NULL,
  `Desc_prof` varchar(800) DEFAULT NULL,
  PRIMARY KEY (`idDocente`) USING BTREE,
  KEY `Materia_idMateria` (`Materia`),
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

INSERT INTO `docente` (`idDocente`, `Nombres`, `Apellidos`, `Email`, `Pasword`, `Curso`, `Materia`, `Jornada`, `Certificacion`, `Desc_prof`) VALUES
(142223657, 'Didier', 'Orozco', 'Orozco09@gmail.com', '598d8591e55346928b3a3a0a01da9ee5', 1, 2, 'Tarde', './files/Paz y Salvo.pdf', 'doctorado en artes y etica ciudadana con ma de 10 años de experiencia en estudios academicos'),
(1054115102, 'Vilma ', 'Barrios Gomez', 'EldiabloAndante@gmail.com', '93d7abad7bbf270154ff3270fe46f4d3', 1, 2, 'Tarde', './files/814402318257-9315909749-entrada.pdf', 'doctora en artes y etica ciudadana con ma de 10 años de experiencia en estudios academicos'),
(1101343174, 'juan david', 'julio rodriguez', 'draxjulio13@gmail.com', 'dfdc20cbab482c8d159f42d3250d1f7c', 1, 2, 'Mañana', './files/Paz y Salvo.pdf', '');
COMMIT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
CREATE TABLE IF NOT EXISTS `estudiante` (
  `idEstudiante` int(11) NOT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Pasword` varchar(45) DEFAULT NULL,
  `Curso` int(11) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`idEstudiante`),
  KEY `curso_cursoid` (`Curso`),
  KEY `NombreEst_Nombre` (`Nombres`),
  KEY `ApellidoEst_Apellido` (`Apellidos`),
  KEY `EmailEst_Email` (`Email`),
  KEY `PasswordEst_password` (`Pasword`),
  KEY `Estado_Est_Usr` (`Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idEstudiante`, `Nombres`, `Apellidos`, `Email`, `Pasword`, `Curso`, `Estado`) VALUES
(100030256, 'Santiago', 'Orjuela', 'orjtailand@gmail.com', '12157a63af655888c72bcb10bfbf0cc7', NULL, 'Activo'),
(1000162100, 'johan stiven', 'oliveros silva', 'oliverosilvajohan@gmail.com', 'c5d7790b7bd682f9b2aef12aa94eb8bb', 1, 'Activo');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `foros`
--

INSERT INTO `foros` (`idForos`, `Titulo`, `Contenido`, `Fecha_Hora`, `archivo`, `idusuario`, `respuesta`, `Estado`) VALUES
(14, 'Prueba', 'Esta es una prueba de funcionalidad', '2024-03-07 19:44:00', 'archivos/Frima.png', 1081394327, 'xd\nhola\n', 'inactivo'),
(15, 'Prueba dos', 'Validacion de funcionamiento', '2024-03-07 19:58:00', 'archivos/OIP (1).jpg', 1030537206, 'messi\nmessi\naeiou\nhola\naa\n', 'inactivo'),
(16, 'futbol', 'messi', '2024-03-23 19:10:00', 'archivos/avatar.jpg', 1000162100, 'eee\nww\nww\n', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `idMaterias` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Materia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMaterias`),
  KEY `Nombre_Materia` (`Nombre_Materia`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idMaterias`, `Nombre_Materia`) VALUES
(3, 'Calculo'),
(2, 'Español'),
(1, 'Ingles');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ;

--
-- Volcado de datos para la tabla `boletines`
--
 
--
-- Estructura de tabla para la tabla `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `Idmensaje` int(11) NOT NULL AUTO_INCREMENT,
  `Mensaje_entrante` int(11) DEFAULT NULL,
  `Mensaje_saliente` int(11) DEFAULT NULL,
  `Mensaje` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Idmensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres_Apellidos` varchar(200) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Opinion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iDpadres` (`Nombres_Apellidos`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`id`, `Nombres_Apellidos`, `Email`, `Opinion`) VALUES
(8, 'Magdy Velazco', 'mvelazco17@gmail.com', 'excelente'),
(9, 'Johan Santiago', 'loca@gmail.com', 'Que buen aplicativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padre_familia`
--

DROP TABLE IF EXISTS `padre_familia`;
CREATE TABLE IF NOT EXISTS `padre_familia` (
  `idPadre_Familia` int(11) NOT NULL,
  `Estado_representante` int(11) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPadre_Familia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`idPublicaciones`, `Archivo`, `Descripcion`, `usuario`) VALUES
(2, '../img/testimonial-4.jpg', 'Prueba de insercion en publicaciones2', 1030537206),
(3, '../img/testimonial-4.jpg', 'Prueba de insercion en publicaciones2', 1030537206),
(6, 'publicUploads/publicacion_66061fd8289bc.pdf', 'prueba para de,ostracion', 2147483647);



--
-- Estructura de tabla para la tabla `reset_password_tokens`
--

DROP TABLE IF EXISTS `reset_password_tokens`;
CREATE TABLE IF NOT EXISTS `reset_password_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry_timestamp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(10000, 'Jimmy', 'Avila', 'Jimmy2020@gmail.com', 3241742555, '5a1dfc0934d7a2fe6b9d1c41e2913dca', 'img/testimonial-4.jpg', 'Coordinador', 'Activo', 'Disponible', NULL),
(1000162100, 'johan stiven', 'oliveros silva', 'oliverosilvajohan@gmail.com', 1234574125, '162a5e4e9c548e5f0c786702b27d7705', 'img/img_660f04b0e7246_avatar.jpg', 'Estudiante', 'Inactivo', ''),
(1030537206, 'johan santiago', 'villanueva roa', 'villabilons@gmail.com', 3234167037, '2d95666e2649fcfc6e3af75e09f5adb9', 'img/img_65ea376a3a058_OIP (1).jpg', 'Padre_familia', 'Activo', 'Offline now'),
(1081394327, 'magdy', 'velazco', 'mvelazcovelasco17@gmail.com', 3142093310, '06a9d63a716592aafc74e37c4326e2db', 'img/img_65ea21409343f_avatar.jpg', 'Coordinador', 'Activo', 'Offline now'),
(1101343174, 'juan david', 'julio rodriguez', 'draxjulio13@gmail.com', 3145896225, 'dfdc20cbab482c8d159f42d3250d1f7c', 'img/img_65ea251924323_OIP.jpg', 'Docente', 'Activo', 'Offline now'),
(2000005978, 'prueba de restriccion', 'padres', 'dfgfdg@gmail.com', 3234177037, '202cb962ac59075b964b07152d234b70', 'img/img_660b6d10cb26e_1652660564avatar.png', 'Estudiante', 'Activo', NULL),
(2147483647, 'ADMIN', 'VELAZCO VELASCO', 'digiworm04@gmail.com', 3143996415, '7e4c3655c26cfcb029535a6253120dcb', 'img/img_660ad460dbc16_LOGO.png', 'administrador', 'Activo', '');

--
-- Restricciones para tablas volcadas
--


--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `Usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
-- --------------------------------------------------------
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
