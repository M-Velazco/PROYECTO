-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-02-2024 a las 02:28:58
-- Versión del servidor: 8.0.31
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

DROP TABLE IF EXISTS `actividades`;
CREATE TABLE IF NOT EXISTS `actividades` (
  `idActividades` int NOT NULL,
  `Nombre_act` varchar(60) DEFAULT NULL,
  `Asignatura` varchar(100) NOT NULL,
  `Docente` int DEFAULT NULL,
  `Archivo` varchar(45) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`idActividades`),
  KEY `Docente_nom_docente` (`Docente`),
  KEY `Asignaturas_Materias` (`Asignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_subidas`
--

DROP TABLE IF EXISTS `actividades_subidas`;
CREATE TABLE IF NOT EXISTS `actividades_subidas` (
  `idestudiante` int NOT NULL,
  `idactividad` int DEFAULT NULL,
  `Archivo` varchar(45) DEFAULT NULL,
  `Calificacion` int DEFAULT NULL,
  PRIMARY KEY (`idestudiante`),
  KEY `IdActividad_Actividad` (`idactividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `Password` varchar(45) DEFAULT NULL,
  `Jornada` enum('Mañana','Tarde') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`idCoordinador`),
  KEY `NombreCoordinador_Nombres` (`Nombres`),
  KEY `ApellidoCoordinador_Apellido` (`Apellidos`),
  KEY `EmailCoordinador_Email` (`Email`),
  KEY `Password` (`Password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `coordinador`
--

INSERT INTO `coordinador` (`idCoordinador`, `Nombres`, `Apellidos`, `Email`, `Password`, `Jornada`) VALUES
(10000, 'Jimmy', 'Avila', 'Jimmy2020@gmail.com', '5a1dfc0934d7a2fe6b9d1c41e2913dca', 'Mañana'),
(1563298, 'leydi ', 'Roa', 'Coordinadora@gmail.com', '7b9c0a9b357cd7c707742562f82add2c', 'Mañana'),
(144789442, 'Carlos', 'Ñampira', 'ñampira@gmail.com', '766d6265e98dd6f396ef768ed988036f', 'Tarde'),
(1023537206, 'Jeison', 'Villanueva', 'jei555555@gmail.com', '7c4c5a96ac34d000f49e9ecefad47722', 'Tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int NOT NULL AUTO_INCREMENT,
  `Nombre_curso` varchar(45) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

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
  `idDocente` int NOT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Curso` int DEFAULT NULL,
  `Materia` int DEFAULT NULL,
  PRIMARY KEY (`idDocente`) USING BTREE,
  KEY `Materia_idMateria` (`Materia`),
  KEY `Curso_idCurso` (`Curso`),
  KEY `NombreDoc_Nombres` (`Nombres`),
  KEY `ApellidoDoc_Apellidos` (`Apellidos`),
  KEY `EmailDoc_Email` (`Email`),
  KEY `Password` (`Password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`idDocente`, `Nombres`, `Apellidos`, `Email`, `Password`, `Curso`, `Materia`) VALUES
(103256849, 'Pedro', 'Picapiedra', 'pedrop@gmail.com', '25f9e794323b453885f5181f1b624d0b', 1, NULL),
(142223657, 'Didier', 'Orozco', 'Orozco09@gmail.com', '598d8591e55346928b3a3a0a01da9ee5', 1, NULL),
(1025538177, 'Aurelio', 'Rivas Renteria', 'Aurelio2023@gmail.com', '8223b621da582c18a06f35b39efcdbed', 1, NULL),
(1030537206, 'Johan Santiago ', 'Villanueva Roa', 'villabilons@gmail.com', '123', 1, 3),
(1054115102, 'Vilma ', 'Barrios Gomez', 'EldiabloAndante@gmail.com', '93d7abad7bbf270154ff3270fe46f4d3', 1, NULL),
(1059643579, 'Luz Jenny', 'Romero', 'Luzdetusojos@gmail.com', '5da2297bad6924526e48e00dbfc3c27a', 1, NULL);

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
  `Password` varchar(45) DEFAULT NULL,
  `Curso` int DEFAULT NULL,
  PRIMARY KEY (`idEstudiante`),
  KEY `curso_cursoid` (`Curso`),
  KEY `NombreEst_Nombre` (`Nombres`),
  KEY `ApellidoEst_Apellido` (`Apellidos`),
  KEY `EmailEst_Email` (`Email`),
  KEY `PasswordEst_password` (`Password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idEstudiante`, `Nombres`, `Apellidos`, `Email`, `Password`, `Curso`) VALUES
(15479320, 'Bladimir', 'Perez', 'BladimirPerez@gmail.com', 'ad05f53f6bc2c9525e016c8d2415dbe8', NULL),
(100030256, 'Santiago', 'Orjuela', 'orjtailand@gmail.com', '12157a63af655888c72bcb10bfbf0cc7', NULL),
(1030521423, 'Alejandra', 'Andrade', 'jennyandrade1302@gmail.com', '3c9f06a12a72aa72674e57e05a7a56f0', NULL),
(1068732649, 'Juan David', 'Julio Rodriguez', 'drax4544@gmail.com', 'c2ad0505b278b44c423fd08fd8a85d72', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

DROP TABLE IF EXISTS `foros`;
CREATE TABLE IF NOT EXISTS `foros` (
  `idForos` int NOT NULL,
  `tema` varchar(45) DEFAULT NULL,
  `Contenido` varchar(700) DEFAULT NULL,
  `idusuario` int DEFAULT NULL,
  PRIMARY KEY (`idForos`),
  KEY `idUsuarios` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `idMaterias` int NOT NULL AUTO_INCREMENT,
  `Nombre_Materia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMaterias`),
  KEY `Nombre_Materia` (`Nombre_Materia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idMaterias`, `Nombre_Materia`) VALUES
(3, 'calculo'),
(2, 'español'),
(1, 'ingles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `Idmensaje` int NOT NULL,
  `Mensaje_entrante` int DEFAULT NULL,
  `Mensaje_saliente` int DEFAULT NULL,
  `Mensaje` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Idmensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `idPublicaciones` int NOT NULL,
  `Archivo` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `usuario` int DEFAULT NULL,
  PRIMARY KEY (`idPublicaciones`),
  KEY `usuario_usuarioId` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `Password` varchar(45) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `Rol` enum('Docente','Coordinador','Estudiante','Padre de familia') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`Idusuarios`),
  KEY `Nombres` (`Nombres`) USING BTREE,
  KEY `Apellidos` (`Apellidos`),
  KEY `Email` (`Email`),
  KEY `Password` (`Password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Idusuarios`, `Nombres`, `Apellidos`, `Email`, `Telefono`, `Password`, `img`, `Rol`, `Estado`) VALUES
(10000, 'Jimmy', 'Avila', 'Jimmy2020@gmail.com', 3241742555, '5a1dfc0934d7a2fe6b9d1c41e2913dca', 'perfil1.jpg', 'Coordinador', 'Activo'),
(1563298, 'leydi ', 'Roa', 'Coordinadora@gmail.com', 3152363254, '7b9c0a9b357cd7c707742562f82add2c', 'perfil2.jpg', 'Coordinador', 'Activo'),
(15479320, 'Bladimir', 'Perez', 'BladimirPerez@gmail.com', 3114574875, 'ad05f53f6bc2c9525e016c8d2415dbe8', 'perfil3.jpg', 'Estudiante', 'Activo'),
(100030256, 'Santiago', 'Orjuela', 'orjtailand@gmail.com', 3154897654, '12157a63af655888c72bcb10bfbf0cc7', 'perfil5.jpg', 'Estudiante', 'Activo'),
(103256849, 'Pedro', 'Picapiedra', 'pedrop@gmail.com', 3252555987, '25f9e794323b453885f5181f1b624d0b', 'perfil6.jpg', 'Docente', 'Activo'),
(142223657, 'Didier', 'Orozco', 'Orozco09@gmail.com', 3215642585, '598d8591e55346928b3a3a0a01da9ee5', 'perfil9.jpg', 'Docente', 'Activo'),
(144789442, 'Carlos', 'Ñampira', 'ñampira@gmail.com', 3212652555, '766d6265e98dd6f396ef768ed988036f', 'perfil10.jpg', 'Coordinador', 'Activo'),
(1023537206, 'Jeison', 'Villanueva', 'jei555555@gmail.com', 3144787155, '7c4c5a96ac34d000f49e9ecefad47722', 'perfil11.jpg', 'Coordinador', 'Activo'),
(1025538177, 'Aurelio', 'Rivas Renteria', 'Aurelio2023@gmail.com', 3172548978, '8223b621da582c18a06f35b39efcdbed', 'perfil12.jpg', 'Docente', 'Activo'),
(1030521423, 'Alejandra', 'Andrade', 'jennyandrade1302@gmail.com', 3198792555, '3c9f06a12a72aa72674e57e05a7a56f0', 'perfil16.jpg', 'Estudiante', 'Activo'),
(1030537206, 'Johan Santiago ', 'Villanueva Roa', 'villabilons@gmail.com', NULL, '123', 'hola.jpg', 'Docente', 'Activo'),
(1054115102, 'Vilma ', 'Barrios Gomez', 'EldiabloAndante@gmail.com', 3241742555, '93d7abad7bbf270154ff3270fe46f4d3', 'perfil13.jpg', 'Docente', 'Activo'),
(1059643579, 'Luz Jenny', 'Romero', 'Luzdetusojos@gmail.com', 3241242155, '5da2297bad6924526e48e00dbfc3c27a', 'perfil14.jpg', 'Docente', 'Activo'),
(1068732649, 'Juan David', 'Julio Rodriguez', 'drax4544@gmail.com', 3211211121, 'c2ad0505b278b44c423fd08fd8a85d72', 'perfil15.jpg', 'Estudiante', 'Activo');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `Asignaturas_Materias` FOREIGN KEY (`Asignatura`) REFERENCES `materias` (`Nombre_Materia`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Docente_nom_docente` FOREIGN KEY (`Docente`) REFERENCES `docente` (`idDocente`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `actividades_subidas`
--
ALTER TABLE `actividades_subidas`
  ADD CONSTRAINT `IdActividad_Actividad` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`idActividades`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `IdEstudiante_ACTSUB_Estudiante` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idEstudiante`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD CONSTRAINT `ApellidoCoordinador_Apellido` FOREIGN KEY (`Apellidos`) REFERENCES `usuarios` (`Apellidos`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `EmailCoordinador_Email` FOREIGN KEY (`Email`) REFERENCES `usuarios` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idcoordinador_usuarios` FOREIGN KEY (`idCoordinador`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `NombreCoordinador_Nombres` FOREIGN KEY (`Nombres`) REFERENCES `usuarios` (`Nombres`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `passwordCord_pasword` FOREIGN KEY (`Password`) REFERENCES `usuarios` (`Password`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `ApellidoDoc_Apellidos` FOREIGN KEY (`Apellidos`) REFERENCES `usuarios` (`Apellidos`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Curso_idCurso` FOREIGN KEY (`Curso`) REFERENCES `curso` (`idCurso`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `EmailDoc_Email` FOREIGN KEY (`Email`) REFERENCES `usuarios` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idddocente_usuarios` FOREIGN KEY (`idDocente`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Materia_idMateria` FOREIGN KEY (`Materia`) REFERENCES `materias` (`idMaterias`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `NombreDoc_Nombres` FOREIGN KEY (`Nombres`) REFERENCES `usuarios` (`Nombres`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `PasswordEst_Pasword` FOREIGN KEY (`Password`) REFERENCES `usuarios` (`Password`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `ApellidoEst_Apellido` FOREIGN KEY (`Apellidos`) REFERENCES `usuarios` (`Apellidos`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `EmailEst_Email` FOREIGN KEY (`Email`) REFERENCES `usuarios` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idEstudiante_usuarios` FOREIGN KEY (`idEstudiante`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `NombreEst_Nombre` FOREIGN KEY (`Nombres`) REFERENCES `usuarios` (`Nombres`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `PasswordEst_password` FOREIGN KEY (`Password`) REFERENCES `usuarios` (`Password`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `foros`
--
ALTER TABLE `foros`
  ADD CONSTRAINT `idUsuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `idmensaje_usuarioid` FOREIGN KEY (`Idmensaje`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `padre_familia`
--
ALTER TABLE `padre_familia`
  ADD CONSTRAINT `idPadre_usuarios` FOREIGN KEY (`idPadre_Familia`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `usuario_usuarioId` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
