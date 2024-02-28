-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-02-2024 a las 20:35:02
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
  `idActividades` int NOT NULL AUTO_INCREMENT,
  `Nombre_act` varchar(60) DEFAULT NULL,
  `Asignatura` varchar(100) NOT NULL,
  `Docente` int DEFAULT NULL,
  `Archivo` varchar(45) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`idActividades`),
  KEY `Docente_nom_docente` (`Docente`),
  KEY `Asignaturas_Materias` (`Asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividades`, `Nombre_act`, `Asignatura`, `Docente`, `Archivo`, `Estado`) VALUES
(8, 'quimica basica', 'Calculo', 1054115102, NULL, 'Activo'),
(9, 'quimica basica', 'Calculo', 1054115102, NULL, 'Activo'),
(24, 'biomedica', 'Calculo', 142223657, 'mapa mental johan (2) (1).pdf', 'Activo');

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
  `Pasword` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Jornada` enum('Mañana','Tarde') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
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
(1563298, 'leydi ', 'Roa', 'Coordinadora@gmail.com', '7b9c0a9b357cd7c707742562f82add2c', 'Mañana'),
(144789442, 'Carlos', 'Ñampira', 'ñampira@gmail.com', '766d6265e98dd6f396ef768ed988036f', 'Tarde'),
(1023537206, 'Jeison', 'Villanueva', 'jei555555@gmail.com', '7c4c5a96ac34d000f49e9ecefad47722', 'Tarde'),
(1037589660, 'johan saintana', 'hurtado', 'johnhurt2305@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Tarde');

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
  `Pasword` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Curso` int DEFAULT NULL,
  `Materia` int DEFAULT NULL,
  PRIMARY KEY (`idDocente`) USING BTREE,
  KEY `Materia_idMateria` (`Materia`),
  KEY `Curso_idCurso` (`Curso`),
  KEY `NombreDoc_Nombres` (`Nombres`),
  KEY `ApellidoDoc_Apellidos` (`Apellidos`),
  KEY `EmailDoc_Email` (`Email`),
  KEY `Password` (`Pasword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`idDocente`, `Nombres`, `Apellidos`, `Email`, `Pasword`, `Curso`, `Materia`) VALUES
(142223657, 'Didier', 'Orozco', 'Orozco09@gmail.com', '598d8591e55346928b3a3a0a01da9ee5', 1, NULL),
(1025538177, 'Aurelio', 'Rivas Renteria', 'Aurelio2023@gmail.com', '8223b621da582c18a06f35b39efcdbed', 1, NULL),
(1054115102, 'Vilma ', 'Barrios Gomez', 'EldiabloAndante@gmail.com', '93d7abad7bbf270154ff3270fe46f4d3', 1, NULL),
(1059643579, 'Luz Jenny', 'Romero', 'Luzdetusojos@gmail.com', '5da2297bad6924526e48e00dbfc3c27a', 1, NULL),
(2147483647, 'luis ', 'fernando', 'jeapnieto1@soy.sena.edu.co', 'e10adc3949ba59abbe56e057f20f883e', 1, 3);

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
  `Pasword` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
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
(15479320, 'Bladimir', 'Perez', 'BladimirPerez@gmail.com', 'ad05f53f6bc2c9525e016c8d2415dbe8', NULL, 'Activo'),
(100030256, 'Santiago', 'Orjuela', 'orjtailand@gmail.com', '12157a63af655888c72bcb10bfbf0cc7', NULL, 'Activo'),
(1030521423, 'Alejandra', 'Andrade', 'jennyandrade1302@gmail.com', '3c9f06a12a72aa72674e57e05a7a56f0', NULL, 'Activo');

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
(4, 10000, 1059643579, 'hola mkon'),
(5, 1059643579, 10000, 'hola pendeja'),
(6, 1030521423, 1101443174, 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

DROP TABLE IF EXISTS `opiniones`;
CREATE TABLE IF NOT EXISTS `opiniones` (
  `iDopinion` int NOT NULL AUTO_INCREMENT,
  `Nombres_Apellidos` varchar(200) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Opinion` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`iDopinion`),
  KEY `iDpadres` (`Nombres_Apellidos`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`iDopinion`, `Nombres_Apellidos`, `Email`, `Opinion`) VALUES
(1, 'Juan David Julio Rodriguez', 'draxjulio13@gmail.com', 'Es un desarrollo bastante fructífero y bastante versátil y sencillo para el fácil manejo de el mismo'),
(2, 'Dilan Romero', 'DilanRom@gmail.com', '¡¡Me gusta!!'),
(3, 'johan santiago villanueva roa', 'villabilons@gmail.com', 'Me parece super la pagina'),
(4, 'Juan David Julio Rodríguez', 'draxjulio13@gmail.com', 'es super importante la educacion hoy en dia siendo que asi guiamos a la persona del mañana para poder tener un futuro mejor'),
(5, 'magdy velazco', 'magdy17@gmail.com', 'este es un buen aplicativo por que fue elaborado por nosotros hajajajja'),
(6, 'stiven oliveros', 'oliverossilvajohan@gmail.com', 'sobelo .com');

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
  `Pasword` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `Rol` enum('Docente','Coordinador','Estudiante','Padre de familia') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(255) NOT NULL,
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
(10000, 'Jimmy', 'Avila', 'Jimmy2020@gmail.com', 3241742555, '5a1dfc0934d7a2fe6b9d1c41e2913dca', '1652660564avatar.png', 'Coordinador', 'Activo', 'Offline now'),
(1563298, 'leydi ', 'Roa', 'Coordinadora@gmail.com', 3152363254, '7b9c0a9b357cd7c707742562f82add2c', '1652660564avatar.png', 'Coordinador', 'Activo', ''),
(10000568, 'Johan Santiagooo', 'Villanueva Roa', 'villabilons@gmail.com', 3234167037, '0f81efae2d3ada62b2208b530c89a820', '1652660564avatar.png', 'Estudiante', 'Activo', ''),
(15479320, 'Bladimir', 'Perez', 'BladimirPerez@gmail.com', 3114574875, 'ad05f53f6bc2c9525e016c8d2415dbe8', '1652660564avatar.png', 'Estudiante', 'Activo', ''),
(100030256, 'Santiago', 'Orjuela', 'orjtailand@gmail.com', 3154897654, '12157a63af655888c72bcb10bfbf0cc7', '1652660564avatar.png', 'Estudiante', 'Activo', ''),
(142223657, 'Didier', 'Orozco', 'Orozco09@gmail.com', 3215642585, '598d8591e55346928b3a3a0a01da9ee5', '1652660564avatar.png', 'Docente', 'Activo', ''),
(144789442, 'Carlos', 'Ñampira', 'ñampira@gmail.com', 3212652555, '766d6265e98dd6f396ef768ed988036f', '1652660564avatar.png', 'Coordinador', 'Activo', ''),
(1023537206, 'Jeison', 'Villanueva', 'jei555555@gmail.com', 3144787155, '7c4c5a96ac34d000f49e9ecefad47722', '1652660564avatar.png', 'Coordinador', 'Activo', ''),
(1025538177, 'Aurelio', 'Rivas Renteria', 'Aurelio2023@gmail.com', 3172548978, '8223b621da582c18a06f35b39efcdbed', '1652660564avatar.png', 'Docente', 'Activo', ''),
(1030521423, 'Alejandra', 'Andrade', 'jennyandrade1302@gmail.com', 3198792555, '3c9f06a12a72aa72674e57e05a7a56f0', '1652660564avatar.png', 'Estudiante', 'Activo', 'Offline now'),
(1037589660, 'johan saintana', 'hurtado', 'johnhurt2305@gmail.com', 3555897987, 'e10adc3949ba59abbe56e057f20f883e', '1652660564avatar.png', 'Coordinador', 'Activo', ''),
(1054115102, 'Vilma ', 'Barrios Gomez', 'EldiabloAndante@gmail.com', 3241742555, '93d7abad7bbf270154ff3270fe46f4d3', '1652660564avatar.png', 'Docente', 'Activo', ''),
(1059643579, 'Luz Jenny', 'Romero', 'Luzdetusojos@gmail.com', 3241242155, '5da2297bad6924526e48e00dbfc3c27a', '1652660564avatar.png', 'Docente', 'Activo', 'Offline now'),
(1101443174, 'Juan David', 'Julio Rodríguez ', 'draxjulio13@gmail.com', 3136065261, '3882a7d8c99e7f13c7b4debae42cbb91', NULL, 'Estudiante', 'Activo', 'Offline now'),
(2147483647, 'luis ', 'fernando', 'jeapnieto1@soy.sena.edu.co', 12035310, 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Docente', 'Activo', '');

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
-- Filtros para la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD CONSTRAINT `EmailCoordinador_Email` FOREIGN KEY (`Email`) REFERENCES `usuarios` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idcoordinador_usuarios` FOREIGN KEY (`idCoordinador`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `Curso_idCurso` FOREIGN KEY (`Curso`) REFERENCES `curso` (`idCurso`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `EmailDoc_Email` FOREIGN KEY (`Email`) REFERENCES `usuarios` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idddocente_usuarios` FOREIGN KEY (`idDocente`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Materia_idMateria` FOREIGN KEY (`Materia`) REFERENCES `materias` (`idMaterias`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `Curso_idCurse` FOREIGN KEY (`Curso`) REFERENCES `curso` (`idCurso`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `EmailEst_Email` FOREIGN KEY (`Email`) REFERENCES `usuarios` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idEstudiante_usuarios` FOREIGN KEY (`idEstudiante`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `foros`
--
ALTER TABLE `foros`
  ADD CONSTRAINT `idUsuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`Idusuarios`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
