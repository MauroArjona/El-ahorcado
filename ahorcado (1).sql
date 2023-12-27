-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2023 a las 03:17:32
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ahorcado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras`
--

CREATE TABLE `palabras` (
  `palabra` varchar(60) NOT NULL,
  `nivelDificultad` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `palabras`
--

INSERT INTO `palabras` (`palabra`, `nivelDificultad`) VALUES
('acordeon', 'media'),
('agua', 'facil'),
('ahorcado', 'media'),
('aislante', 'media'),
('alarmas', 'media'),
('anticonstitucionalidad', 'dificil'),
('arquitectura', 'dificil'),
('cabezazo', 'media'),
('camion', 'media'),
('cenicero', 'media'),
('circunferencia', 'dificil'),
('columna', 'media'),
('cuadrilatero', 'dificil'),
('dentista', 'media'),
('desoxirribonucleico', 'dificil'),
('electricidad', 'dificil'),
('escalimetro', 'dificil'),
('estabilizador', 'dificil'),
('exploradora', 'dificil'),
('extremidades', 'dificil'),
('jupiter', 'media'),
('juzgar', 'media'),
('koala', 'facil'),
('lavarropa', 'dificil'),
('libelula', 'media'),
('libro', 'facil'),
('luna', 'facil'),
('mercurio', 'media'),
('orca', 'facil'),
('original', 'media'),
('ornitorrinco', 'dificil'),
('panda', 'facil'),
('panel', 'facil'),
('paralelepipedo', 'dificil'),
('perro', 'facil'),
('planeta', 'media'),
('pluton', 'media'),
('reloj', 'facil'),
('sabor', 'facil'),
('sol', 'facil'),
('soñar', 'facil'),
('telescopio', 'dificil'),
('tiza', 'facil'),
('vida', 'facil'),
('zapato', 'media');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `idPartida` int(60) NOT NULL,
  `idUsuario` int(60) NOT NULL,
  `palabra` varchar(60) NOT NULL,
  `tiempo` varchar(5) NOT NULL,
  `cantidadErrores` int(60) NOT NULL,
  `letrasAcertadas` varchar(60) NOT NULL,
  `letrasErradas` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`idPartida`, `idUsuario`, `palabra`, `tiempo`, `cantidadErrores`, `letrasAcertadas`, `letrasErradas`) VALUES
(50, 164, 'sol', '00:07', 2, 'o', 'a,e,'),
(51, 164, 'electricidad', '00:17', 8, 'ctca', 'm,o,s,v,u,x,z,b,'),
(52, 135, 'pluton', '00:10', 6, 'n', 'a,e,f,r,v,j,'),
(53, 160, 'ahorcado', '00:04', 3, '', 'b,e,ñ,'),
(54, 164, 'arquitectura', '01:06', 5, 'aeca', 'b,y,z,o,p,'),
(61, 189, 'dentista', '00:13', 5, 'da', 'f,b,m,ñ,q,'),
(62, 189, 'reloj', '00:03', 2, 'e', 'd,f,'),
(63, 189, 'reloj', '00:01', 0, '', ''),
(64, 192, 'panda', '00:10', 4, 'ada', 'e,c,h,ñ,');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranking`
--

CREATE TABLE `ranking` (
  `idRanking` int(60) NOT NULL,
  `idUsuario` int(60) NOT NULL,
  `palabra` varchar(60) NOT NULL,
  `tiempo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ranking`
--

INSERT INTO `ranking` (`idRanking`, `idUsuario`, `palabra`, `tiempo`) VALUES
(5, 135, 'soñar', '02:57'),
(25, 135, 'cenicero', '00:33'),
(26, 158, 'lavarropa', '01:08'),
(27, 158, 'telescopio', '01:11'),
(28, 160, 'planeta', '00:30'),
(29, 164, 'electricidad', '00:58'),
(30, 164, 'panda', '00:04'),
(32, 164, 'libro', '00:50'),
(33, 164, 'telescopio', '01:58'),
(37, 164, 'planeta', '00:15'),
(38, 160, 'luna', '00:05'),
(39, 160, 'arquitectura', '00:33'),
(45, 164, 'sabor', '01:16'),
(46, 176, 'exploradora', '01:00'),
(47, 176, 'orca', '00:12'),
(48, 189, 'sol', '00:15'),
(49, 189, 'tiza', '00:16'),
(50, 189, 'sabor', '00:11'),
(51, 189, 'reloj', '00:11'),
(52, 192, 'cuadrilatero', '00:30'),
(53, 195, 'luna', '00:22'),
(54, 195, 'lavarropa', '00:19'),
(55, 195, 'planeta', '00:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `contrasena` varchar(300) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `paisResidencia` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `correo`, `contrasena`, `fechaNacimiento`, `paisResidencia`) VALUES
(135, 'agostina', 'agostina@gmail.com', '$2y$10$q.LvUSS35GbNy/W4XDgUKOa7ik7LRTAT0brL2ytjwsiPdOjARoaK2', '1111-12-15', 'africa'),
(158, 'lucianito', 'luciano@gmail.com', '$2y$10$7OFtiGu1/EaqKt.VY3PNKeGY3Fcv4BhRZq0NIJvLIdqOKSeZAcb0q', '2002-11-27', 'argentina'),
(160, 'griselda', 'griLuque@gmail.com', '$2y$10$AcMF5lP48sSOZS4zDXmSqO97NjpDdR7oR7g5i0.r/VR2Voa5u9Axq', '1999-11-11', 'argentina'),
(164, 'MauroArj', 'Ezequielmauro@gmail.com', '$2y$10$j46oEwOJicToXyy6MY4glu.kcE3MQhKrLReBYpkdejPORV/VDbR7a', '2001-12-09', 'Argentina'),
(176, 'mariano123', 'mariano@gmail.com', '$2y$10$MsZEB5ogp9y1hg5BKSx33.uKiKQ/L2uNXMMJUOuB.Jgs0SOoprX0S', '2000-12-04', 'Argentina'),
(183, 'liga1234', 'liga@gmail.com', '$2y$10$P/q8EWvEemRTxVAAU3nFNuvgGeFn14F0U7486yrEo/PAxTW4yUytK', '2001-12-12', 'Argentina'),
(184, 'Mauro777', 'mauri@gmail.com', '$2y$10$y49NQ8aLWOtGSXG2AvJhWeiqlG15AIq.xy9D3WQWj5k3K2AISv2mO', '0000-00-00', 'Argentina'),
(185, 'lobito12', 'lobito@gmail.com', '$2y$10$89hkkuJXIPapFdRW67pJJuNJ1pZLz560MgmlxLUsGhaTNF6VK3j9W', '0000-00-00', 'Argentina'),
(187, 'nahuelito', 'nahuelito@gmail.com', '$2y$10$2hPlyqpsfbvtEp5ojHTZe.MTfcbUyhMo.96ruzkUHV0my17Z.QH2u', '2001-12-31', 'Argentina'),
(189, 'mauritooo', 'maurito@gmail.com', '$2y$10$qaI9sY4ZTgCfxu3y7Aih8exFHa8o3x985WkOl635NmAYkkaryikk6', '2001-12-12', 'Argentina'),
(190, 'luisCaceres', 'luis123@gmail.com', '$2y$10$4RvMfGrz7N49M33JAIn0Ke0bVofVFCj8Eubs0Gt56j12BHVSUGucG', '2001-12-12', 'Argentina'),
(191, 'MauroEzequiel', 'mauroEzequiel@gmail.com', '$2y$10$o.Yxf/WG67TF3VRNy3n0WeM8OUwgEb0JsZuroIqsgJ2V/f0G/is/K', '2002-01-12', 'Argentina'),
(192, 'ThiagoToconas', 'thiaguito@gmail.com', '$2y$10$mKj7XR96kcK3ZA1pVdoVv.6rJPI4TMhWXMua58CMwpUokMTVkaSJa', '2005-02-19', 'Alemania'),
(193, 'salome123', 'salome1212@gmail.com', '$2y$10$jOhgtuUVPJYL77gBnU3dLejZ0dQGX/ZAclMhv/bp4ToF.FNhd12lG', '2007-06-19', 'Mexico'),
(194, 'Nahuel77', 'nahuel@gmail.com', '$2y$10$oIHKhNf27sm4O0VpFO2opeU8PxdgYu0gPvnySOB3OSiygQ0jvKd6.', '2002-12-31', 'Argentina'),
(195, 'maxrocket', 'matias@gmail.com', '$2y$10$xuNWfB7V5mBxBWejb4IRDu..PQDJ3R9TBNlC/sOcj1wa0ou4D9RzC', '2005-12-14', 'Argentina');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `palabras`
--
ALTER TABLE `palabras`
  ADD PRIMARY KEY (`palabra`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`idPartida`),
  ADD UNIQUE KEY `idPartida` (`idPartida`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `palabra` (`palabra`);

--
-- Indices de la tabla `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`idRanking`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `palabra` (`palabra`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `idPartida` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `ranking`
--
ALTER TABLE `ranking`
  MODIFY `idRanking` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `partida_ibfk_2` FOREIGN KEY (`palabra`) REFERENCES `palabras` (`palabra`);

--
-- Filtros para la tabla `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `ranking_ibfk_2` FOREIGN KEY (`palabra`) REFERENCES `palabras` (`palabra`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
