-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-03-2024 a las 19:43:56
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
  `Archivo` varchar(45) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') DEFAULT NULL,
  PRIMARY KEY (`idActividades`),
  KEY `Docente_nom_docente` (`Docente`),
  KEY `Asignaturas_Materias` (`Asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividades`, `Nombre_act`, `Asignatura`, `Docente`, `Archivo`, `Estado`) VALUES
(9, 'quimica basica', 'Calculo', 1054115102, NULL, 'Activo');

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
(1563298, 'leydi ', 'Roa', 'Coordinadora@gmail.com', '7b9c0a9b357cd7c707742562f82add2c', 'Mañana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_curso` varchar(45) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') DEFAULT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `Nombre_curso`, `Estado`) VALUES
(1, '1103', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE IF NOT EXISTS `docente` (
  `idDocente` int(11) NOT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Pasword` varchar(45) DEFAULT NULL,
  `Curso` int(11) DEFAULT NULL,
  `Materia` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDocente`) USING BTREE,
  KEY `Materia_idMateria` (`Materia`),
  KEY `Curso_idCurso` (`Curso`),
  KEY `NombreDoc_Nombres` (`Nombres`),
  KEY `ApellidoDoc_Apellidos` (`Apellidos`),
  KEY `EmailDoc_Email` (`Email`),
  KEY `Password` (`Pasword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`idDocente`, `Nombres`, `Apellidos`, `Email`, `Pasword`, `Curso`, `Materia`) VALUES
(142223657, 'Didier', 'Orozco', 'Orozco09@gmail.com', '598d8591e55346928b3a3a0a01da9ee5', 1, NULL),
(1054115102, 'Vilma ', 'Barrios Gomez', 'EldiabloAndante@gmail.com', '93d7abad7bbf270154ff3270fe46f4d3', 1, NULL);

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
(100030256, 'Santiago', 'Orjuela', 'orjtailand@gmail.com', '12157a63af655888c72bcb10bfbf0cc7', NULL, 'Activo');

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
  `respuesta` varchar(500) NOT NULL,
  PRIMARY KEY (`idForos`),
  KEY `idUsuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;


--
-- Volcado de datos para la tabla `foros`
--



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
  `idPublicaciones` int(11) NOT NULL,
  `Archivo` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPublicaciones`),
  KEY `usuario_usuarioId` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `Idusuarios` int(11) NOT NULL,
  `Nombres` varchar(60) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Telefono` bigint(20) DEFAULT NULL,
  `Pasword` varchar(45) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `Rol` enum('Docente','Coordinador','Estudiante','Padre de familia') DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`Idusuarios`),
  UNIQUE KEY `Email` (`Email`) USING BTREE,
  KEY `Nombres` (`Nombres`) USING BTREE,
  KEY `Apellidos` (`Apellidos`),
  KEY `Password` (`Pasword`),
  KEY `Estado` (`Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Idusuarios`, `Nombres`, `Apellidos`, `Email`, `Telefono`, `Pasword`, `img`, `Rol`, `Estado`, `status`) VALUES
(10000, 'Jimmy', 'Avila', 'Jimmy2020@gmail.com', 3241742555, '5a1dfc0934d7a2fe6b9d1c41e2913dca', 'img/testimonial-4.jpg', 'Coordinador', 'Activo', 'Disponible'),
(1563298, 'leydi ', 'Roa', 'Coordinadora@gmail.com', 3152363254, '7b9c0a9b357cd7c707742562f82add2c', '1652660564avatar.png', 'Coordinador', 'Activo', '');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
