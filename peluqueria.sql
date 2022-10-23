-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2021 a las 13:20:52
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peluqueria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `cliente_data_id` int(11) NOT NULL,
  `personal_data_id` int(11) NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `servicio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `cliente_data_id`, `personal_data_id`, `hora`, `fecha`, `servicio_id`) VALUES
(1, 5, 10, '10:00:00', '2021-10-28', 35),
(2, 5, 10, '10:00:00', '2021-10-25', 35),
(3, 5, 15, '10:00:00', '2021-10-25', 36),
(4, 50, 15, '12:00:00', '2021-11-12', 36),
(5, 51, 14, '10:00:00', '2021-11-20', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_data`
--

CREATE TABLE `cliente_data` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente_data`
--

INSERT INTO `cliente_data` (`id`) VALUES
(2),
(3),
(4),
(5),
(9),
(10),
(11),
(12),
(14),
(18),
(19),
(22),
(23),
(24),
(25),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(47),
(48),
(49),
(50),
(51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_data`
--

CREATE TABLE `personal_data` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_data`
--

INSERT INTO `personal_data` (`id`) VALUES
(10),
(11),
(14),
(15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_data_servicios`
--

CREATE TABLE `personal_data_servicios` (
  `personal_data_id` int(11) NOT NULL,
  `servicios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_data_servicios`
--

INSERT INTO `personal_data_servicios` (`personal_data_id`, `servicios_id`) VALUES
(10, 35),
(11, 40),
(14, 41),
(15, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `servicio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `servicio`, `costo`) VALUES
(35, 'Corte de cabello', '10.000'),
(36, 'Lifting de pestañas', '25.000'),
(37, 'Corte de dama', '12.000'),
(38, 'Corte de cabello con barba', '17.000'),
(39, 'Maquillaje social de día', '45.000'),
(40, 'Maquillaje social de noche', '60.000'),
(41, 'Manicure con esmaltado tradicional', '12.000'),
(42, 'Pedicure', '15.000'),
(43, 'Maquillaje de novia', '105.000'),
(44, 'Planchado y cepilllado, cabello corto', '20.000'),
(45, 'Planchado y cepilllado, cabello largo', '30.000'),
(46, 'Depilación de cejas (con cera)', '8.000'),
(47, 'Cejas semipermanentes (diseño completo)', '15.000'),
(48, 'Peinados de niñas', '25.000'),
(49, 'Peinados para cualquier ocasión', '40.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `cliente_data_id` int(11) DEFAULT NULL,
  `personal_data_id` int(11) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `cliente_data_id`, `personal_data_id`, `email`, `password`, `rol`, `name`, `telefono`) VALUES
(12, NULL, NULL, 'admin@gmail.com', 'admin', 'Admin', 'Admin', '02763477558'),
(14, NULL, 10, 'belkysvivas@gmail.com', 'belkys', 'Personal', 'Belkys', '4247010382'),
(15, NULL, 11, 'luisa@gmail.com', 'luisa', 'Personal', 'Luisa', '04247567234'),
(18, 4, NULL, 'carlos@gmail.com', '123', 'Cliente', 'Carlos', '04247011040'),
(19, 5, NULL, 'wirssy@gmail.com', '12', 'Cliente', 'daniel', '0424751900h'),
(23, 9, NULL, 'gcrisleytahiry@gmail.com', '12', 'Cliente', 'gcrisleytahiry@gmail.com', 'wqdwqdwqdwq'),
(24, 10, NULL, 'gcrisleythiry@gmail.com', '12', 'Cliente', 'crisley', '12323232323'),
(25, 11, NULL, 'gcrisleyahiry@gmail.com', '12345', 'Cliente', 'gcrisleytahiry@gmail.com', '04247320235'),
(26, 12, NULL, 'an@gmail.com', '12', 'Cliente', 'gcris', '04247320235'),
(28, 14, NULL, 'adin@gmail.com', '1', 'Cliente', 'gcrisleytahiry@gmail.com', '12313123123'),
(32, 18, NULL, 'ain@gmail.com', '123456', 'Cliente', 'gcri', '04247320235'),
(33, 19, NULL, 'gcrislehiry@yahoo.com', '12345', 'Cliente', 'gc', '12123123122'),
(36, 22, NULL, 'wy@gmail.com', '12345', 'Cliente', 'gcrisle', '04247320235'),
(50, 34, NULL, 'josePukkkktio@gmail.com', '12345', 'Cliente', 'gcrisleytahiry@gmail.com', '0444444'),
(51, 35, NULL, 'gcrisleyyyyyytahiry@gmail.com', '12345', 'Cliente', 'gcrisleytahiry@gmail.com', '0455'),
(52, 36, NULL, 'gcrisleygggggtahiry@gmail.com', '12345', 'Cliente', 'gcrisleytahiry@gmail.com', '04247320235'),
(53, 37, NULL, 'gcrisleytajjjjjjhiry@gmail.com', '11111', 'Cliente', 'gcrisleytahiry@gmail.com', '042473202358'),
(54, 38, NULL, 'admillllln@gmail.com', '333333', 'Cliente', 'gcrisleytahiry@gmail.com', '0424732023544'),
(55, 39, NULL, 'admilllln@gmail.com', '12345', 'Cliente', 'gcrisleytahiry@gmail.com', '042473202399999'),
(56, 40, NULL, 'admilln@gmail.com', '333333', 'Cliente', 'gcrisleytahiry@gmail.com', '33333333333'),
(57, 41, NULL, 'gcrisleytahiry444@gmail.com', '44444', 'Cliente', 'gcrisleytahiry@gmail.com', '04444444444'),
(58, 42, NULL, 'gcrisleyjjjjtahiry@gmail.com', '222222', 'Cliente', 'gcrisleytahiry@gmail.com', '04777777777'),
(59, 43, NULL, 'gcfffrisleytahiry@gmail.com', '33333', 'Cliente', 'gcrisleytahiry@gmail.com', '04247320235'),
(60, NULL, 14, 'yusvivas@gmail.com', 'yusvi', 'Personal', 'Yusneidy', '04247320235'),
(61, NULL, 15, 'astrii@gmail.com', 'astri', 'Personal', 'Astri', '04147393819'),
(62, 44, NULL, 'prueba@gmail.com', '12345', 'Cliente', 'gcrisleytahiry@gmail.com', '4247320235'),
(65, 47, NULL, 'prueba2@gmail.com', '12345', 'Cliente', 'prueba2', '04247320235'),
(66, 48, NULL, 'adminjjjj@gmail.com', '12345', 'Cliente', 'Daniel', '04247320235'),
(67, 49, NULL, 'wirssyy@gmail.com', '44444', 'Cliente', 'daniel', '4247320235'),
(68, 50, NULL, 'yoiferjosemoncadagalviz6@gmail.com', '12345', 'Cliente', 'YOIFER', '4247061577'),
(69, 51, NULL, 'keilyn0402@gmail.com', '1234', 'Cliente', 'Vanessa Ramirez', '4140762601');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B88CF8E5D6443AC8` (`cliente_data_id`),
  ADD KEY `IDX_B88CF8E5B4D2A817` (`personal_data_id`),
  ADD KEY `IDX_B88CF8E571CAA3E7` (`servicio_id`);

--
-- Indices de la tabla `cliente_data`
--
ALTER TABLE `cliente_data`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_data`
--
ALTER TABLE `personal_data`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_data_servicios`
--
ALTER TABLE `personal_data_servicios`
  ADD PRIMARY KEY (`personal_data_id`,`servicios_id`),
  ADD KEY `IDX_29691676B4D2A817` (`personal_data_id`),
  ADD KEY `IDX_29691676D96E005D` (`servicios_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_2265B05DD6443AC8` (`cliente_data_id`),
  ADD UNIQUE KEY `UNIQ_2265B05DB4D2A817` (`personal_data_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente_data`
--
ALTER TABLE `cliente_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `personal_data`
--
ALTER TABLE `personal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `FK_B88CF8E571CAA3E7` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`),
  ADD CONSTRAINT `FK_B88CF8E5B4D2A817` FOREIGN KEY (`personal_data_id`) REFERENCES `personal_data` (`id`),
  ADD CONSTRAINT `FK_B88CF8E5D6443AC8` FOREIGN KEY (`cliente_data_id`) REFERENCES `cliente_data` (`id`);

--
-- Filtros para la tabla `personal_data_servicios`
--
ALTER TABLE `personal_data_servicios`
  ADD CONSTRAINT `FK_29691676B4D2A817` FOREIGN KEY (`personal_data_id`) REFERENCES `personal_data` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_29691676D96E005D` FOREIGN KEY (`servicios_id`) REFERENCES `servicios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_2265B05DB4D2A817` FOREIGN KEY (`personal_data_id`) REFERENCES `personal_data` (`id`),
  ADD CONSTRAINT `FK_2265B05DD6443AC8` FOREIGN KEY (`cliente_data_id`) REFERENCES `cliente_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
