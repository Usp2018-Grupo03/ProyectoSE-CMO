-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2018 a las 08:15:05
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectose`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleenfsin`
--

CREATE TABLE `detalleenfsin` (
  `id_detalleenfsin` int(11) NOT NULL,
  `des_grado` varchar(50) CHARACTER SET utf8 NOT NULL,
  `des_observacion` varchar(200) CHARACTER SET utf8 NOT NULL,
  `id_sintoma` int(11) NOT NULL,
  `id_enfermedad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepreopc`
--

CREATE TABLE `detallepreopc` (
  `id_detallepreopc` int(11) NOT NULL,
  `dpo_puntaje` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallepreopc`
--

INSERT INTO `detallepreopc` (`id_detallepreopc`, `dpo_puntaje`, `id_pregunta`, `id_opcion`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE `enfermedad` (
  `id_enfermedad` int(11) NOT NULL,
  `enf_nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `enf_descripcion` varchar(200) CHARACTER SET utf8 NOT NULL,
  `enf_fecha` date NOT NULL,
  `enf_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcion`
--

CREATE TABLE `opcion` (
  `id_opcion` int(11) NOT NULL,
  `opc_titulo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `opc_descripcion` varchar(200) CHARACTER SET utf8 NOT NULL,
  `opc_fecha` date NOT NULL,
  `opc_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `opcion`
--

INSERT INTO `opcion` (`id_opcion`, `opc_titulo`, `opc_descripcion`, `opc_fecha`, `opc_estado`) VALUES
(1, 'AAA', 'aaa', '2018-10-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `pre_titulo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pre_descripcion` varchar(200) CHARACTER SET utf8 NOT NULL,
  `pre_imagen` varchar(200) CHARACTER SET utf8 NOT NULL,
  `pre_fecha` date NOT NULL,
  `pre_estado` tinyint(4) NOT NULL,
  `pre_puntaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `pre_titulo`, `pre_descripcion`, `pre_imagen`, `pre_fecha`, `pre_estado`, `pre_puntaje`) VALUES
(1, 'AA', 'AA', 'AA', '2018-11-06', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sintoma`
--

CREATE TABLE `sintoma` (
  `id_sintoma` int(11) NOT NULL,
  `sin_nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sin_descripcion` varchar(200) CHARACTER SET utf8 NOT NULL,
  `sin_fecha` date NOT NULL,
  `sin_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sintoma`
--

INSERT INTO `sintoma` (`id_sintoma`, `sin_nombre`, `sin_descripcion`, `sin_fecha`, `sin_estado`) VALUES
(7, '2', '2', '2018-10-31', 1),
(8, '3', '3', '2018-10-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usu_nombres` varchar(50) CHARACTER SET utf8 NOT NULL,
  `usu_apellidos` varchar(50) CHARACTER SET utf8 NOT NULL,
  `usu_rol` varchar(50) CHARACTER SET utf8 NOT NULL,
  `usu_usuario` varchar(50) CHARACTER SET utf8 NOT NULL,
  `usu_password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `usu_correo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `usu_direccion` varchar(200) CHARACTER SET utf8 NOT NULL,
  `usu_fecha` date NOT NULL,
  `usu_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usu_nombres`, `usu_apellidos`, `usu_rol`, `usu_usuario`, `usu_password`, `usu_correo`, `usu_direccion`, `usu_fecha`, `usu_estado`) VALUES
(1, 'Alejandro', 'Quijandria', 'Administrador', 'admin', '123', 'admin@gmail,com', 'Calle 123', '2018-01-01', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalleenfsin`
--
ALTER TABLE `detalleenfsin`
  ADD PRIMARY KEY (`id_detalleenfsin`),
  ADD KEY `ix_tmp_autoinc` (`id_detalleenfsin`),
  ADD KEY `fk_detalleenfsin_enfermedad` (`id_enfermedad`),
  ADD KEY `fk_detalleenfsin_sintoma` (`id_sintoma`);

--
-- Indices de la tabla `detallepreopc`
--
ALTER TABLE `detallepreopc`
  ADD PRIMARY KEY (`id_detallepreopc`),
  ADD KEY `ix_tmp_autoinc` (`id_detallepreopc`),
  ADD KEY `fk_detallepreopc_opcion` (`id_opcion`),
  ADD KEY `fk_detallepreopc_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`id_enfermedad`),
  ADD KEY `ix_tmp_autoinc` (`id_enfermedad`);

--
-- Indices de la tabla `opcion`
--
ALTER TABLE `opcion`
  ADD PRIMARY KEY (`id_opcion`),
  ADD KEY `ix_tmp_autoinc` (`id_opcion`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `ix_tmp_autoinc` (`id_pregunta`);

--
-- Indices de la tabla `sintoma`
--
ALTER TABLE `sintoma`
  ADD PRIMARY KEY (`id_sintoma`),
  ADD KEY `ix_tmp_autoinc` (`id_sintoma`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `ix_tmp_autoinc` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalleenfsin`
--
ALTER TABLE `detalleenfsin`
  MODIFY `id_detalleenfsin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallepreopc`
--
ALTER TABLE `detallepreopc`
  MODIFY `id_detallepreopc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `id_enfermedad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opcion`
--
ALTER TABLE `opcion`
  MODIFY `id_opcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sintoma`
--
ALTER TABLE `sintoma`
  MODIFY `id_sintoma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleenfsin`
--
ALTER TABLE `detalleenfsin`
  ADD CONSTRAINT `fk_detalleenfsin_enfermedad` FOREIGN KEY (`id_enfermedad`) REFERENCES `enfermedad` (`id_enfermedad`),
  ADD CONSTRAINT `fk_detalleenfsin_sintoma` FOREIGN KEY (`id_sintoma`) REFERENCES `sintoma` (`id_sintoma`);

--
-- Filtros para la tabla `detallepreopc`
--
ALTER TABLE `detallepreopc`
  ADD CONSTRAINT `fk_detallepreopc_opcion` FOREIGN KEY (`id_opcion`) REFERENCES `opcion` (`id_opcion`),
  ADD CONSTRAINT `fk_detallepreopc_pregunta` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
