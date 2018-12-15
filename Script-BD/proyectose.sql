-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2018 a las 04:21:33
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

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

--
-- Volcado de datos para la tabla `detalleenfsin`
--

INSERT INTO `detalleenfsin` (`id_detalleenfsin`, `des_grado`, `des_observacion`, `id_sintoma`, `id_enfermedad`) VALUES
(1, '1', 'SINT', 1, 4),
(2, '2', 'SINT', 2, 4),
(3, '2', 'SINT', 3, 4),
(4, '1', 'SINT', 4, 4),
(5, '1', 'SINT', 1, 5),
(6, '1', 'SINT', 2, 5),
(7, '2', 'SINT', 3, 5),
(8, '2', 'SINT', 5, 5),
(9, '2', 'SINT', 10, 5),
(10, '1', 'SINT', 6, 6),
(11, '2', 'SINT', 7, 6),
(12, '2', 'SINT', 8, 6),
(13, '2', 'SINT', 9, 6);

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
(3, 100, 3, 1),
(4, 0, 3, 4),
(5, 100, 4, 1),
(6, 0, 4, 4),
(7, 100, 5, 1),
(8, 0, 5, 4),
(9, 100, 6, 1),
(10, 0, 6, 4),
(11, 100, 7, 1),
(12, 0, 7, 4),
(13, 100, 8, 1),
(14, 0, 8, 4),
(15, 100, 9, 1),
(16, 0, 9, 4),
(17, 100, 10, 1),
(18, 0, 10, 4),
(19, 100, 11, 1),
(20, 0, 11, 4),
(21, 100, 12, 1),
(22, 0, 12, 4),
(23, 100, 13, 1),
(24, 0, 13, 4),
(25, 100, 14, 1),
(26, 0, 14, 4),
(27, 100, 15, 1),
(28, 0, 15, 4),
(29, 100, 16, 1),
(30, 0, 16, 4),
(31, 50, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesinpre`
--

CREATE TABLE `detallesinpre` (
  `id_detallesinpre` int(11) NOT NULL,
  `id_sintoma` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallesinpre`
--

INSERT INTO `detallesinpre` (`id_detallesinpre`, `id_sintoma`, `id_pregunta`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 1, 5),
(4, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `id_diagnostico` int(11) NOT NULL,
  `dia_porcentaje` double NOT NULL,
  `dia_enfermedad` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticofinal`
--

CREATE TABLE `diagnosticofinal` (
  `id_diagnosticofinal` int(11) NOT NULL,
  `dif_nombre` varchar(50) NOT NULL,
  `dif_enfermedad` varchar(50) NOT NULL,
  `dif_porcentaje` double NOT NULL,
  `dif_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `diagnosticofinal`
--

INSERT INTO `diagnosticofinal` (`id_diagnosticofinal`, `dif_nombre`, `dif_enfermedad`, `dif_porcentaje`, `dif_fecha`) VALUES
(8, 'Alejandro', 'ASTIGMATISMO', 3, '2018-12-12');

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

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`id_enfermedad`, `enf_nombre`, `enf_descripcion`, `enf_fecha`, `enf_estado`) VALUES
(4, 'ASTIGMATISMO', 'AnomalÃ­a o defecto del ojo que consiste en una curvatura irregular de la cÃ³rnea, lo que provoca que se vean algo deformadas las imÃ¡genes y poco claro el contorno de las cosas.', '2018-11-22', 1),
(5, 'MIOPÃA', 'Es un tipo de error de refracciÃ³n comÃºn en que los objetos cercanos se ven con claridad pero los objetos lejanos se ven borrosos.', '2018-11-22', 1),
(6, 'CONJUNTIVITIS', 'La conjuntivitis es una irritaciÃ³n o inflamaciÃ³n de la conjuntiva que cubre la parte blanca del globo ocular.', '2018-11-22', 1);

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
(1, 'SI', 'afirmaciÃ³n', '2018-11-18', 1),
(4, 'NO', 'negaciÃ³n', '2018-11-22', 1),
(5, 'MEDIO', 'Desc.', '2018-12-06', 1);

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
(3, 'LOGRA VER TODAS LAS LINEAS IGUALMENTE DEFINIDAS', '1. Sitúese a un metro de la pantalla, aproximadamente.\r\n2. La prueba se realizarÃ¡ monocularmente, primero la realizaremos para un ojo y despuÃ©s para el otro, tapando siempre el ojo no examinado.\r\n3', 'http://subirimagen.me/uploads/20181122010558.png', '2018-11-22', 1, 10),
(4, '¿TIENE LA SENSACIÓN QUE VE DOBLE?', 'Sensacion de ver doble una imagen o texto.\r\n', 'http://subirimagen.me/uploads/20181122184915.jpg', '2018-11-22', 1, 10),
(5, '¿SE ACERCA MUCHO AL PAPEL CUANDO LEE O ESCRIBE?', 'Acercamiento excesivo al redactar o escribir \r\n,', 'http://subirimagen.me/uploads/20181122191134.jpg', '2018-11-22', 1, 10),
(6, '¿DESPUES DE TENER UNA LECTURA PRESENTA MOLESTIA?', 'Molestias despues de una lectura', 'http://subirimagen.me/uploads/20181122191312.jpg', '2018-11-22', 1, 10),
(7, '¿TIENE DIFICULTAD PARA VER DE NOCHE?', 'dificultad de vision en lugares con poca luz', 'http://subirimagen.me/uploads/20181122191603.gif', '2018-11-22', 1, 10),
(8, '¿EN OCASIONES SUFRE DOLORES DE CABEZA?', 'Dolores ', 'http://subirimagen.me/uploads/20181122191919.jpg', '2018-11-22', 1, 10),
(9, '¿VE MAL DE LEJOS?', 'dificultad para ver objetos o palabras de lejos', 'http://subirimagen.me/uploads/20181122192206.jpg', '2018-11-22', 1, 10),
(10, '¿GUIÑA LOS OJOS?', 'parpadeo constante', 'http://subirimagen.me/uploads/20181122192346.jpg', '2018-11-22', 1, 10),
(11, '¿LE GUSTA LEER PERO NO PERCIBE LA FALTA DE ILUMIN', 'dificultad de leer con poca luz', 'http://subirimagen.me/uploads/20181122192526.jpg', '2018-11-22', 1, 10),
(12, 'LOGRA VER CORRECTAMENTE TODAS LAS LETRAS DE LA IMA', '1. SitÃºate a 1,5 metros de distancia de la pantalla.\r\n2. Realiza la prueba primero con un ojo (visiÃ³n monocular), con el otro tapado, y posteriormente al revÃ©s.\r\n3. El objetivo del test es distingu', 'http://subirimagen.me/uploads/20181122010939.jpeg', '2018-11-22', 1, 10),
(13, '¿PRESENTA ENROJECIMIENTO EN UN OJO O EN AMBOS?', 'cambio de color en la parte blanca del ojo', 'http://subirimagen.me/uploads/20181122192636.jpg', '2018-11-22', 1, 10),
(14, '¿TIENE SENSACION DE ARDOR O DE TENER POLVO EN EL', 'sensacion de molestia', 'http://subirimagen.me/uploads/20181122184656.jpg', '2018-11-22', 1, 10),
(15, '¿PRESENTA SENSIBILIDAD A LA LUZ?', 'sensacion de molestia', 'http://subirimagen.me/uploads/20181122192741.jpg', '2018-11-22', 1, 10),
(16, '¿PRESENTA LAGAÑAS AMARILLAS EN LOS OJOS?', 'secresion', 'http://subirimagen.me/uploads/20181122192838.jpg', '2018-11-22', 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje`
--

CREATE TABLE `puntaje` (
  `id_puntaje` int(11) NOT NULL,
  `pun_enfermedad` varchar(50) NOT NULL,
  `pun_valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'ÃREA DE VISIÃ“N DISTORSIONADA ', 'dificultad de visiÃ³n en todos los Ã¡ngulos', '2018-11-18', 1),
(2, 'CANSANCIO VISUAL', 'molestias que manifiesta el ojo ante cualquier actividad visual', '2018-11-22', 1),
(3, 'DOLOR DE CABEZA', 'molestias causadas por el uso excesivo de la vista', '2018-11-22', 1),
(4, 'DIFICULTAD DE VISIÃ“N EN LAS NOCHES', 'Dificultad anormal en Ã¡reas con poca luz', '2018-11-22', 1),
(5, 'ACCIÃ“N DE PARPADEO  PARA VER', 'parpadeo constante a causa de molestias', '2018-11-22', 1),
(6, 'LAGRIMEO CONSTANTE', 'exceso de producciÃ³n de lagrima', '2018-11-22', 1),
(7, 'ENROJECIMIENTO DEL OJO', 'Cambio de color en la parte blanca del ojo', '2018-11-22', 1),
(8, 'SENSACIÃ“N DE PEGADO DE PARPADOS', 'se debe a la secreciÃ³n del ojo', '2018-11-22', 1),
(9, 'PICAZÃ“N, IRRITACIÃ“N O ARDOR EN LOS OJOS.', 'sensacion producida a causa de diferentes factores', '2018-11-22', 1),
(10, 'FROTARSE LOS OJOS CON FRECUENCIA', 'sensaciÃ³n de limpiar al hacer esta acciÃ³n', '2018-11-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal`
--

CREATE TABLE `temporal` (
  `id_temporal` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `dpo_puntaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `usu_fecha` date NOT NULL,
  `usu_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usu_nombres`, `usu_apellidos`, `usu_rol`, `usu_usuario`, `usu_password`, `usu_fecha`, `usu_estado`) VALUES
(1, 'Alejandro', 'Quijandria', 'Administrador', 'admin', '123', '2018-01-01', 1);

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
-- Indices de la tabla `detallesinpre`
--
ALTER TABLE `detallesinpre`
  ADD PRIMARY KEY (`id_detallesinpre`),
  ADD KEY `ix_tmp_autoinc` (`id_detallesinpre`),
  ADD KEY `fk_detallesinpre_pregunta` (`id_pregunta`),
  ADD KEY `fk_detallesinpre_sintoma` (`id_sintoma`);

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`id_diagnostico`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `diagnosticofinal`
--
ALTER TABLE `diagnosticofinal`
  ADD PRIMARY KEY (`id_diagnosticofinal`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`id_enfermedad`);

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
-- Indices de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD PRIMARY KEY (`id_puntaje`);

--
-- Indices de la tabla `sintoma`
--
ALTER TABLE `sintoma`
  ADD PRIMARY KEY (`id_sintoma`),
  ADD KEY `ix_tmp_autoinc` (`id_sintoma`);

--
-- Indices de la tabla `temporal`
--
ALTER TABLE `temporal`
  ADD PRIMARY KEY (`id_temporal`);

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
  MODIFY `id_detalleenfsin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detallepreopc`
--
ALTER TABLE `detallepreopc`
  MODIFY `id_detallepreopc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `detallesinpre`
--
ALTER TABLE `detallesinpre`
  MODIFY `id_detallesinpre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT de la tabla `diagnosticofinal`
--
ALTER TABLE `diagnosticofinal`
  MODIFY `id_diagnosticofinal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `id_enfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `opcion`
--
ALTER TABLE `opcion`
  MODIFY `id_opcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  MODIFY `id_puntaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `sintoma`
--
ALTER TABLE `sintoma`
  MODIFY `id_sintoma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `temporal`
--
ALTER TABLE `temporal`
  MODIFY `id_temporal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

--
-- Filtros para la tabla `detallesinpre`
--
ALTER TABLE `detallesinpre`
  ADD CONSTRAINT `fk_detallesinpre_pregunta` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`),
  ADD CONSTRAINT `fk_detallesinpre_sintoma` FOREIGN KEY (`id_sintoma`) REFERENCES `sintoma` (`id_sintoma`);

--
-- Filtros para la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `diagnostico_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
