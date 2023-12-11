-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-12-2023 a las 12:27:44
-- Versión del servidor: 8.0.33
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `digiworm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

DROP TABLE IF EXISTS `actividades`;
CREATE TABLE IF NOT EXISTS `actividades` (
  `idactividades` int NOT NULL,
  `Nom_act` varchar(50) NOT NULL,
  `Materia_act` int NOT NULL,
  `Docente` int NOT NULL,
  `Archivo` varchar(50) NOT NULL,
  PRIMARY KEY (`idactividades`),
  KEY `fk_docentes_has_actividades_actividades1` (`Docente`),
  KEY `fk_materia_has_actividades_actividades1` (`Materia_act`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `act_subida`
--

DROP TABLE IF EXISTS `act_subida`;
CREATE TABLE IF NOT EXISTS `act_subida` (
  `idestudiante` int NOT NULL,
  `idactividad` int NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Archivo` varchar(45) NOT NULL,
  `calificacion` int NOT NULL,
  PRIMARY KEY (`idestudiante`,`idactividad`),
  KEY `fk_estudiante_has_actividades_actividades1_idx` (`idactividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinador`
--

DROP TABLE IF EXISTS `coordinador`;
CREATE TABLE IF NOT EXISTS `coordinador` (
  `idcoordinador` int NOT NULL,
  `Nombre_apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Jornada` varchar(45) NOT NULL,
  PRIMARY KEY (`idcoordinador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `coordinador`
--

INSERT INTO `coordinador` (`idcoordinador`, `Nombre_apellido`, `Correo`, `Contraseña`, `Jornada`) VALUES
(1000000, 'Jimmy Avila', 'Jimmy2020@gmail.com', 'jjaahh', 'Mañana'),
(1563298, 'Leydi Roa', 'Coordinadora@gmail.com', '5555', 'Tarde'),
(144789642, 'ñampiraloca@gmail.com', 'ñamporaloca@gmail.com', 'koko', 'Tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idcurso` int NOT NULL,
  `nom_curso` varchar(50) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idcurso`, `nom_curso`, `estado`) VALUES
(1, 'Pre jardín-1', 'Activo'),
(2, '1102', 'Activo'),
(3, '1103', 'Activo'),
(4, '801', 'Activo'),
(5, '903', 'Activo'),
(6, '702', 'Activo'),
(7, '501', 'Activo'),
(8, '602', 'Activo'),
(9, '403', 'Activo'),
(802, 'octavo-1', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE IF NOT EXISTS `docente` (
  `iddocente` int NOT NULL,
  `Nombre_apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Curso_pr` int NOT NULL,
  `Materia` int NOT NULL,
  PRIMARY KEY (`iddocente`),
  KEY `nomm_idx` (`Materia`),
  KEY `Curso_pr_idx` (`Curso_pr`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`iddocente`, `Nombre_apellido`, `Correo`, `Contraseña`, `Curso_pr`, `Materia`) VALUES
(103256849, 'Pedro Picapiedra', 'pedrop@gmail.com', 'e35cf7b66449df565f93c607d5a81d09', 8, 8),
(142223657, 'Didier Orozco', 'Orozco09@gmail.com', '05a5cf06982ba7892ed2a6d38fe832d6', 6, 8),
(1023537206, 'Jeison villanueva', 'Jei555@gmail.com', '8992d0722236210b7bd3aea5f0cbf93b', 3, 7),
(1025538177, 'Aurelio Rivas Renteria', 'Aurelio2023@gmail.com', '5531a5834816222280f20d1ef9e95f69', 1, 2),
(1054115102, 'Vilma Barrios Gomez', 'Eldiabloandante@gmail.com', 'dbab2adc8f9d078009ee3fa810bea142', 2, 6),
(1059643579, 'Luz Jenny Romero', 'Luzdetusojos@gmail.com', '84ddfb34126fc3a48ee38d7044e87276', 1, 1),
(1546328945, 'Pedro Picapiedra', 'pedrop@gmail.com', '68053af2923e00204c3ca7c6a3150cf7', 8, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
CREATE TABLE IF NOT EXISTS `estudiante` (
  `idestudiante` int NOT NULL,
  `Nombre_apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Curso` int NOT NULL,
  PRIMARY KEY (`idestudiante`),
  KEY `curso` (`Curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idestudiante`, `Nombre_apellido`, `Correo`, `Contraseña`, `Curso`) VALUES
(15479320, 'Bladimir Perez', 'Bladiperez@gmail.com', '0000', 6),
(1333547921, 'Alejandra Andrade', 'Andrade2023@gmail.com', '1596', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

DROP TABLE IF EXISTS `foros`;
CREATE TABLE IF NOT EXISTS `foros` (
  `idforos` int NOT NULL,
  `tema` varchar(45) NOT NULL,
  `Contenido` varchar(500) NOT NULL,
  `idusuario` int NOT NULL,
  PRIMARY KEY (`idforos`),
  KEY `fk_user_has_foros_foros1` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `foros`
--

INSERT INTO `foros` (`idforos`, `tema`, `Contenido`, `idusuario`) VALUES
(1, 'La mantecologia', 'El día de hoy observaremos este tema.', 1059643579),
(5, 'Quimica', 'No permitas que otros te digan lo que debes hacer.', 1068732649),
(6, 'Cuento', 'Piensa, cree e imagina que todo a tu alrededor es fantástico, aun cuando no lo sea.', 100030256),
(7, 'No dios mio', 'No vivas en el pasado, hoy es el momento de actuar.', 1054115102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `idmaterias` int NOT NULL,
  `nom_materia` varchar(45) NOT NULL,
  PRIMARY KEY (`idmaterias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idmaterias`, `nom_materia`) VALUES
(1, 'ingles'),
(2, 'Química'),
(3, 'Fisica'),
(4, 'Calculo'),
(5, 'Educación Física'),
(6, 'Filosofia'),
(7, 'Religión'),
(8, 'Informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
CREATE TABLE IF NOT EXISTS `matriculas` (
  `idMatriculas` int NOT NULL,
  `Proceso` varchar(45) NOT NULL,
  `Documentos` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idMatriculas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`idMatriculas`, `Proceso`, `Documentos`, `Estado`) VALUES
(1230, 'En proceso', '109432739', 'Activo'),
(1231, 'En proceso', '1081394328', 'Inactivo'),
(1232, 'Seleccion', '10005631', 'Activo'),
(1233, 'Solicitud', '15896325', 'Inactivo'),
(1234, 'En proceso', '12223654', 'Inactivo'),
(1235, 'En proceso', '1547896', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(8, 1255215777, 1159744947, 'hola magdy'),
(9, 1159744947, 1255215777, 'hola johan'),
(10, 1159744947, 1255215777, 'como esta el dia de hoy'),
(11, 1255215777, 1159744947, 'bien gracias'),
(12, 1159744947, 112750199, 'hola johan como estas?'),
(13, 1255215777, 197133937, 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padre_de_familia`
--

DROP TABLE IF EXISTS `padre_de_familia`;
CREATE TABLE IF NOT EXISTS `padre_de_familia` (
  `idpadre_de_familia` int NOT NULL,
  `est_rep` int NOT NULL,
  `estado_matr` int NOT NULL,
  PRIMARY KEY (`idpadre_de_familia`),
  KEY `est_rep_idx` (`est_rep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `padre_de_familia`
--

INSERT INTO `padre_de_familia` (`idpadre_de_familia`, `est_rep`, `estado_matr`) VALUES
(0, 1030537206, 0),
(1, 1333547921, 1230),
(2, 1081394328, 1231),
(3, 15479320, 1236),
(4, 1030537206, 1233),
(5, 1025478952, 1234);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

DROP TABLE IF EXISTS `publicaciones`;
CREATE TABLE IF NOT EXISTS `publicaciones` (
  `idpublicaciones` int NOT NULL,
  `Archivo` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Usuario` int NOT NULL,
  PRIMARY KEY (`idpublicaciones`),
  KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`idpublicaciones`, `Archivo`, `Descripcion`, `Usuario`) VALUES
(1, NULL, 'Si quieres ser feliz, entonces enfócate en qu', 1333547921),
(2, NULL, 'No sigas a otros, busca tu propio camino.', 1025538177),
(3, NULL, 'No permitas que nada ni nadie te detenga en e', 104456652),
(4, NULL, 'Hay que salir de la zona de confort para logr', 1000000),
(5, NULL, 'La vida está hecha de dificultades.', 144789642),
(6, NULL, 'No temas sufrir, eso te hace más fuerte.', 1057030024);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talleres`
--

DROP TABLE IF EXISTS `talleres`;
CREATE TABLE IF NOT EXISTS `talleres` (
  `idtalleres` int NOT NULL,
  `Nom_taller` varchar(50) NOT NULL,
  `Materia_taller` varchar(50) NOT NULL,
  `Docente` varchar(50) NOT NULL,
  `Archivo` varchar(300) NOT NULL,
  PRIMARY KEY (`idtalleres`),
  KEY `fk_docentes_has_talleres_talleres1` (`Docente`),
  KEY `fk_materia_has_talleres_talleres` (`Materia_taller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taller_subida`
--

DROP TABLE IF EXISTS `taller_subida`;
CREATE TABLE IF NOT EXISTS `taller_subida` (
  `idestudiante` int NOT NULL,
  `idtalleres` int NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Archivo` varchar(45) NOT NULL,
  `calificacion` int NOT NULL,
  PRIMARY KEY (`idestudiante`,`idtalleres`),
  KEY `fk_estudiante_has_talleres_talleres1_idx` (`idtalleres`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `unique_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(5, 1159744947, 'Johan', 'Villanueva', 'jhoan25@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '16951976091652660564avatar.png', 'Offline now'),
(6, 112750199, 'Johan Stiven', 'Oliveros', 'oliveros@gmail.com', '202cb962ac59075b964b07152d234b70', '16952287551652660638staff-avatar.png', 'Offline now'),
(7, 197133937, 'Daniel', 'Perez', 'daniel@gmail.com', '8d5e957f297893487bd98fa830fa6413', '16952335561652660564avatar.png', 'Offline now');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `Idusuarios` int NOT NULL,
  `Nombre_apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Telefono` int NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Rol` enum('Docente','Estudiante','Coordinador','Acudiente') NOT NULL,
  PRIMARY KEY (`Idusuarios`),
  UNIQUE KEY `Contraseña` (`Contraseña`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Idusuarios`, `Nombre_apellido`, `Correo`, `Telefono`, `Contraseña`, `Rol`) VALUES
(1000000, 'Jimmy Avila', 'Jimmy2020@gmail.com', 0, '546313a757db42d16919dc29c31faef9', 'Coordinador'),
(1563298, 'Leydi Roa', 'Coordinadora@gmail.com', 0, 'f899139df5e1059396431415e770c6dd', 'Coordinador'),
(15479320, 'Bladimir Perez', 'Bladiperez@gmail.com', 0, '4a7d1ed414474e4033ac29ccb8653d9b', 'Estudiante'),
(100030256, 'Santiago', 'santi874@gmail.com', 0, 'd47268e9db2e9aa3827bba3afb7ff94a', 'Estudiante'),
(103256849, 'Pedro Picapiedra', 'pedrop@gmail.com', 32549612, 'e35cf7b66449df565f93c607d5a81d09', 'Docente'),
(142223657, 'Didier Orozco', 'Orozco09@gmail.com', 0, '05a5cf06982ba7892ed2a6d38fe832d6', 'Docente'),
(144789642, 'Carlos ñampira', 'ñampira@gmail.com', 0, '37f525e2b6fc3cb4abd882f708ab80eb', 'Coordinador'),
(1023537206, 'Jeison villanueva', 'Jei555@gmail.com', 2147483647, '8992d0722236210b7bd3aea5f0cbf93b', 'Coordinador'),
(1025538177, 'Aurelio Rivas Renteria', 'Aurelio2023@gmail.com', 0, '5531a5834816222280f20d1ef9e95f69', 'Docente'),
(1054115102, 'Vilma Barrios Gomez', 'Eldiabloandante@gmail.com', 0, 'dbab2adc8f9d078009ee3fa810bea142', 'Docente'),
(1059643579, 'Luz Jenny Romero', 'Luzdetusojos@gmail.com', 0, '578c3b59e13b6c8ab97a9151bb3a82cb', 'Docente'),
(1068732649, 'Juan David Julio', 'drax4514@gmail.com', 0, 'a4050abeb896fd1706b1b0ad28f40fe1', 'Estudiante'),
(1333547921, 'Alejandra Andrade', 'Andrade2023@gmail.com', 0, '309fee4e541e51de2e41f21bebb342aa', 'Estudiante'),
(1546328945, 'Eduardo Andres', 'andres01@gmail.com', 102395486, '68053af2923e00204c3ca7c6a3150cf7', 'Estudiante');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `fk_docentes_has_actividades_actividades1` FOREIGN KEY (`Docente`) REFERENCES `docente` (`iddocente`),
  ADD CONSTRAINT `fk_materia_has_actividades_actividades1` FOREIGN KEY (`Materia_act`) REFERENCES `materias` (`idmaterias`);

--
-- Filtros para la tabla `act_subida`
--
ALTER TABLE `act_subida`
  ADD CONSTRAINT `fk_estudiante_has_actividades_actividades1` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`idactividades`),
  ADD CONSTRAINT `fk_estudiante_has_actividades_estudiante1` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idestudiante`);

--
-- Filtros para la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD CONSTRAINT `idcoordinador` FOREIGN KEY (`idcoordinador`) REFERENCES `usuarios` (`Idusuarios`);

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `curso_pr` FOREIGN KEY (`Curso_pr`) REFERENCES `curso` (`idcurso`),
  ADD CONSTRAINT `Curso_pr_idx` FOREIGN KEY (`Curso_pr`) REFERENCES `curso` (`idcurso`),
  ADD CONSTRAINT `iddocente` FOREIGN KEY (`iddocente`) REFERENCES `usuarios` (`Idusuarios`),
  ADD CONSTRAINT `Materia` FOREIGN KEY (`Materia`) REFERENCES `materias` (`idmaterias`),
  ADD CONSTRAINT `nomm_idx` FOREIGN KEY (`Materia`) REFERENCES `materias` (`idmaterias`);

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `curso` FOREIGN KEY (`Curso`) REFERENCES `curso` (`idcurso`),
  ADD CONSTRAINT `idestudiante` FOREIGN KEY (`idestudiante`) REFERENCES `usuarios` (`Idusuarios`);

--
-- Filtros para la tabla `foros`
--
ALTER TABLE `foros`
  ADD CONSTRAINT `fk_user_has_foros_foros1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`Idusuarios`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
