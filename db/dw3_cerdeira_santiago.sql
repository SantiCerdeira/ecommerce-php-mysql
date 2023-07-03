-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-08-2022 a las 02:50:59
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw3_cerdeira_santiago`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_compras`
--

CREATE TABLE `articulos_compras` (
  `articulo_compra_id` mediumint(8) UNSIGNED NOT NULL,
  `compra_fk` mediumint(8) UNSIGNED NOT NULL,
  `articulo_id` mediumint(8) UNSIGNED NOT NULL,
  `cantidad` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camisetas`
--

CREATE TABLE `camisetas` (
  `camiseta_id` mediumint(8) UNSIGNED NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `equipo` varchar(100) DEFAULT NULL,
  `usuario_fk` mediumint(8) UNSIGNED NOT NULL,
  `continente_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `camisetas`
--

INSERT INTO `camisetas` (`camiseta_id`, `descripcion`, `precio`, `imagen`, `titulo`, `pais`, `equipo`, `usuario_fk`, `continente_fk`) VALUES
(10, 'Camiseta retro de Argentina, la mítica albiceleste del 86, testigo de grandes momentos de la historia del fútbol. Entre otros el mejor gol del siglo XX marcado por Diego Armando Maradona, el gol de la Mano de Dios y de la victoria Argentina en el Mundial de 1986.', 14999, 'remeraArgentina.png', 'Camiseta de Argentina 1986', 'Argentina', NULL, 1, 1),
(11, 'La camiseta retro de Brasil del Mundial de México 70. La Selección brasileña considerada a día de hoy la mejor de todos los tiempos y Campeona del Mundo por tercera vez para retener la copa Jules Rimet. La selección de Carlos Alberto, Jairzinho, Tostao, Gerson, Rivelino y, sin duda alguna, O Rey Pelè. Los Mundiales del 70 fueron el punto más alto de esta generación. En la primera fase de grupos, tres victorias de tres para Brasil (despachada también la Inglaterra campeona por 1-0) con Pelé y Jairzinho goleadores.', 12999, 'remeraBrasil.png', 'Camiseta de Brasil 1970', 'Brasil', NULL, 1, 1),
(12, 'Camiseta retro de Francia, la histórica camiseta con la que la selección francesa fue a jugar su sexto mundial en la historia y quedó recordado como uno de los mundiales más oscuros de su historia. La selección francesa quedó eliminada en fase de grupos luego de perder sus primeros dos partidos ante Inglaterra y Uruguay y empatar el tercero ante México. A pesar del oscuro episodio, esta camiseta quedó como una de las que marcó la historia del fútbol frances.', 10999, 'remeraFrancia.png', 'Camiseta de Francia 1966', 'Francia', NULL, 1, 2),
(13, 'Camiseta de la selección holandesa en el mundial 1974, en el que la selección holandesa llegó a la final luego de hacer un mundial excelente junto a un Cruyff que estaba muy afilado. La selección holandesa consiguió aplastar a Brasil en la semifinal pero luego perdió la final frente a la Alemania Federal.', 11999, 'remeraHolanda.png', 'Camiseta de Holanda 1974', 'Holanda', NULL, 1, 2),
(14, 'Camiseta de Italia en el mundial del 1982 en el que la selección italiana se consagró campeona luego de hacer una muy floja fase de grupos en la que milagrosamente consiguió pasar a octavos con tan solo tres empates. Luego, obtuvo un mejor desempeño en la fase eliminatoria y consiguió consagrarse campeona luego de 44 años ganándole a la Alemania Occidental.', 9999, 'remeraItalia.png', 'Camiseta de Italia 1982', 'Italia', NULL, 1, 2),
(15, 'Camiseta con la que la selección alemana jugó la Eurocopa del año 2012. Alemania hizo una buana actuación con su figura que fue el volante Mesut Ozil, que se destacó por sus goles y asistencias. Pero a pesar de eso la selección italiana llegó para terminar con el sueño alemán ganándole en la semifinal.', 17999, 'remeraAlemania.png', 'Camiseta de Alemania 2012', 'Alemania', NULL, 1, 2),
(16, 'Camiseta que utilizó la selección Danesa en su debút histórico en una Eurocopa. Hasta esa década, el fútbol era algo muy poco común para los daneses, y este debút fue el que empezó a introducir a Dinamarca en el futbol internacional. Si bien su actuación no fue muy buena, definitivamente marcó la historia de este país.', 10499, 'remeraDinamarca.png', 'Camiseta de Dinamarca 1960', 'Dinamarca', NULL, 1, 2),
(17, 'Camiseta con la que la selección escocesa jugó en el mundial que se disputó en territorio argentino y quedó en la historia ya que a pesar de haber sido eliminados de forma muy temprana en ese poco tiempo fueron protagonistas de diversos escándalos relacionados al alcohol, drogas y demás. A pesar de ese no muy buen episodio, quedó en la historia ya que fue uno de los pocos mundiales en los que participó la selección escocesa.', 8999, 'remeraEscocia.png', 'Remera de Escocia 1978', 'Escocia', NULL, 1, 2),
(18, 'Camiseta visitante de la selección inglesa de 1998 con la que Inglaterra disputó el mundial de ese año en el que volvió a quedar eliminada esta vez en octavos de final frente a su temida Argentina. Esta camiseta quedó en la historia gracias a la figura inglesa David Beckham.', 11999, 'remeraInglaterra.png', 'Camiseta de Inglaterra 1998', 'Inglaterra', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `compra_id` mediumint(8) UNSIGNED NOT NULL,
  `usuario_fk` mediumint(8) UNSIGNED NOT NULL,
  `total` mediumint(8) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `continentes`
--

CREATE TABLE `continentes` (
  `continente_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `continentes`
--

INSERT INTO `continentes` (`continente_id`, `nombre`) VALUES
(1, 'América'),
(2, 'Europa'),
(3, 'África'),
(4, 'Asia'),
(5, 'Oceanía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperar_passwords`
--

CREATE TABLE `recuperar_passwords` (
  `usuario_fk` mediumint(8) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` mediumint(8) UNSIGNED NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `apellido` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_fk` tinyint(3) UNSIGNED NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `apellido`, `email`, `password`, `rol_fk`) VALUES
(1, 'pepe', 'gomez', 'pepe@gmail.com', '$2y$10$voAJxkfvuTk7oVatwi3gl.ph2PStJUtenVWpgGKmWZkhyra9JqDBC', 1),
(3, 'jose', 'gomez', 'jose@gmail.com', '$2y$10$mDLYTwY6dFph4wtEuPNIu.kW0NT68OToLJ6ypQs6q69BWLLDGpzUC', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos_compras`
--
ALTER TABLE `articulos_compras`
  ADD PRIMARY KEY (`articulo_compra_id`),
  ADD KEY `fk_table1_compras1_idx` (`compra_fk`);

--
-- Indices de la tabla `camisetas`
--
ALTER TABLE `camisetas`
  ADD PRIMARY KEY (`camiseta_id`),
  ADD KEY `fk_camisetas_usuarios_idx` (`usuario_fk`),
  ADD KEY `fk_camisetas_continentes1_idx` (`continente_fk`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`compra_id`),
  ADD KEY `fk_compras_usuarios1_idx` (`usuario_fk`);

--
-- Indices de la tabla `continentes`
--
ALTER TABLE `continentes`
  ADD PRIMARY KEY (`continente_id`);

--
-- Indices de la tabla `recuperar_passwords`
--
ALTER TABLE `recuperar_passwords`
  ADD PRIMARY KEY (`usuario_fk`),
  ADD KEY `fk_recupear_passwords_usuarios1_idx` (`usuario_fk`),
  ADD KEY `token_id` (`token`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_usuarios_roles1_idx` (`rol_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos_compras`
--
ALTER TABLE `articulos_compras`
  MODIFY `articulo_compra_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `camisetas`
--
ALTER TABLE `camisetas`
  MODIFY `camiseta_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `compra_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `continentes`
--
ALTER TABLE `continentes`
  MODIFY `continente_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos_compras`
--
ALTER TABLE `articulos_compras`
  ADD CONSTRAINT `fk_table1_compras1` FOREIGN KEY (`compra_fk`) REFERENCES `compras` (`compra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `camisetas`
--
ALTER TABLE `camisetas`
  ADD CONSTRAINT `fk_camisetas_continentes1` FOREIGN KEY (`continente_fk`) REFERENCES `continentes` (`continente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_camisetas_usuarios` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_usuarios1` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recuperar_passwords`
--
ALTER TABLE `recuperar_passwords`
  ADD CONSTRAINT `fk_recupear_passwords_usuarios1` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`rol_fk`) REFERENCES `roles` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
