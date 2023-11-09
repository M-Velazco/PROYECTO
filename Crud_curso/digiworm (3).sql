-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2023 a las 01:16:26
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

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

CREATE TABLE `actividades` (
  `idactividades` int(11) NOT NULL,
  `Nom_act` varchar(50) NOT NULL,
  `Materia_act` int(11) NOT NULL,
  `Docente` int(11) NOT NULL,
  `Archivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `act_subida`
--

CREATE TABLE `act_subida` (
  `idestudiante` int(11) NOT NULL,
  `idactividad` int(11) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Archivo` varchar(45) NOT NULL,
  `calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinador`
--

CREATE TABLE `coordinador` (
  `idcoordinador` int(11) NOT NULL,
  `Nombre_apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Jornada` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `nom_curso` varchar(50) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idcurso`, `nom_curso`, `Estado`) VALUES
(802, 'octavo-1', 'Activo'),
(902, 'Noveno ', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `iddocente` int(11) NOT NULL,
  `Nombre_apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Curso_pr` int(11) NOT NULL,
  `Materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`iddocente`, `Nombre_apellido`, `Correo`, `Contraseña`, `Curso_pr`, `Materia`) VALUES
(1025538177, 'Jeison quintero', 'villabilons@gmail.com', '3144787155', 802, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `idestudiante` int(11) NOT NULL,
  `Nombre_apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idestudiante`, `Nombre_apellido`, `Correo`, `Contraseña`, `Curso`) VALUES
(1030537206, 'Johan Santiago Villanueva roa', 'villabilons@gmail.com', '3144787155', 802);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

CREATE TABLE `foros` (
  `idforos` int(11) NOT NULL,
  `tema` varchar(45) NOT NULL,
  `Contenido` varchar(500) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idmaterias` int(11) NOT NULL,
  `nom_materia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idmaterias`, `nom_materia`) VALUES
(1, 'ingles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `idMatriculas` int(11) NOT NULL,
  `Proceso` varchar(45) NOT NULL,
  `Documentos` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padre_de_familia`
--

CREATE TABLE `padre_de_familia` (
  `idpadre_de_familia` int(11) NOT NULL,
  `est_rep` int(11) NOT NULL,
  `estado_matr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `padre_de_familia`
--

INSERT INTO `padre_de_familia` (`idpadre_de_familia`, `est_rep`, `estado_matr`) VALUES
(0, 1030537206, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `idpublicaciones` int(11) NOT NULL,
  `Archivo` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talleres`
--

CREATE TABLE `talleres` (
  `idtalleres` int(11) NOT NULL,
  `Nom_taller` varchar(50) NOT NULL,
  `Materia_taller` int(11) NOT NULL,
  `Docente` int(11) NOT NULL,
  `Archivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taller_subida`
--

CREATE TABLE `taller_subida` (
  `idestudiante` int(11) NOT NULL,
  `idtalleres` int(11) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Archivo` varchar(45) NOT NULL,
  `calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `Nombre_apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `Nombre_apellido`, `Correo`, `Contraseña`, `Rol`) VALUES
(1025538177, 'Jeison Andrés Quintero Roa', 'jeison555555@gmail.com', 'residentevil555555', 'estudiante'),
(1030537206, 'Johan Santiago Villanueva roa', 'villabilons@gmail.com', '3144787155', 'estudiante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`idactividades`),
  ADD KEY `fk_docentes_has_actividades_actividades1` (`Docente`),
  ADD KEY `fk_materia_has_actividades_actividades1` (`Materia_act`);

--
-- Indices de la tabla `act_subida`
--
ALTER TABLE `act_subida`
  ADD PRIMARY KEY (`idestudiante`,`idactividad`),
  ADD KEY `fk_estudiante_has_actividades_actividades1_idx` (`idactividad`);

--
-- Indices de la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD PRIMARY KEY (`idcoordinador`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`iddocente`),
  ADD KEY `Curso_pr_idx` (`Curso_pr`),
  ADD KEY `nomm_idx` (`Materia`),
  ADD KEY `Nombre_apellido` (`Nombre_apellido`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idestudiante`),
  ADD KEY `curso` (`Curso`);

--
-- Indices de la tabla `foros`
--
ALTER TABLE `foros`
  ADD PRIMARY KEY (`idforos`),
  ADD KEY `fk_user_has_foros_foros1` (`idusuario`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idmaterias`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`idMatriculas`);

--
-- Indices de la tabla `padre_de_familia`
--
ALTER TABLE `padre_de_familia`
  ADD PRIMARY KEY (`idpadre_de_familia`),
  ADD KEY `est_rep_idx` (`est_rep`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`idpublicaciones`),
  ADD KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `talleres`
--
ALTER TABLE `talleres`
  ADD PRIMARY KEY (`idtalleres`),
  ADD KEY `fk_docentes_has_talleres_talleres1` (`Docente`),
  ADD KEY `fk_materia_has_talleres_talleres` (`Materia_taller`);

--
-- Indices de la tabla `taller_subida`
--
ALTER TABLE `taller_subida`
  ADD PRIMARY KEY (`idestudiante`,`idtalleres`),
  ADD KEY `fk_estudiante_has_talleres_talleres1_idx` (`idtalleres`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `fk_docentes_has_actividades_actividades1` FOREIGN KEY (`Docente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia_has_actividades_actividades1` FOREIGN KEY (`Materia_act`) REFERENCES `materias` (`idmaterias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `act_subida`
--
ALTER TABLE `act_subida`
  ADD CONSTRAINT `fk_estudiante_has_actividades_actividades1` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`idactividades`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estudiante_has_actividades_estudiante1` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD CONSTRAINT `idcoordinador` FOREIGN KEY (`idcoordinador`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `Curso_pr_idx` FOREIGN KEY (`Curso_pr`) REFERENCES `curso` (`idcurso`),
  ADD CONSTRAINT `Materia` FOREIGN KEY (`Materia`) REFERENCES `materias` (`idmaterias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `curso_pr` FOREIGN KEY (`Curso_pr`) REFERENCES `curso` (`idcurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `iddocente` FOREIGN KEY (`iddocente`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `nomm_idx` FOREIGN KEY (`Materia`) REFERENCES `materias` (`idmaterias`);

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `curso` FOREIGN KEY (`Curso`) REFERENCES `curso` (`idcurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idestudiante` FOREIGN KEY (`idestudiante`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `foros`
--
ALTER TABLE `foros`
  ADD CONSTRAINT `fk_user_has_foros_foros1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `padre_de_familia`
--
ALTER TABLE `padre_de_familia`
  ADD CONSTRAINT `est_rep` FOREIGN KEY (`est_rep`) REFERENCES `estudiante` (`idestudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `usuario_idx` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `talleres`
--
ALTER TABLE `talleres`
  ADD CONSTRAINT `fk_docente_has_talleres_talleres1` FOREIGN KEY (`Docente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `taller_subida`
--
ALTER TABLE `taller_subida`
  ADD CONSTRAINT `estudiante_idx2` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idestudiante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
