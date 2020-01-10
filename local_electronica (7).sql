-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2019 a las 05:48:37
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `local_electronica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_items`
--

CREATE TABLE `cart_items` (
  `id_cart` int(10) UNSIGNED NOT NULL,
  `nombre_cart` varchar(50) NOT NULL,
  `precio_cart` decimal(10,2) NOT NULL,
  `cantidad_cart` int(10) UNSIGNED NOT NULL,
  `id_pie_fk` int(10) UNSIGNED NOT NULL,
  `user_id_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cli` int(10) UNSIGNED NOT NULL,
  `pago_cli` tinyint(4) DEFAULT NULL,
  `pais_cli` varchar(2) DEFAULT NULL,
  `nombre_cli` varchar(64) NOT NULL,
  `apellido_cli` varchar(64) NOT NULL,
  `dni_cli` varchar(10) NOT NULL,
  `telefono_cli` varchar(20) NOT NULL,
  `region_cli` varchar(128) DEFAULT NULL,
  `ciudad_cli` varchar(128) DEFAULT NULL,
  `direccion_cli` varchar(128) DEFAULT NULL,
  `postal_cli` int(10) DEFAULT NULL,
  `createdDtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `nro_legajo_emp` int(10) UNSIGNED NOT NULL,
  `estado_civil_emp` varchar(30) NOT NULL,
  `experiencia_emp` tinyint(4) NOT NULL,
  `direccion_emp` varchar(50) NOT NULL,
  `salario_emp` decimal(10,2) NOT NULL,
  `estudios_emp` varchar(50) NOT NULL,
  `horas_sem_emp` int(10) NOT NULL,
  `user_emp_fk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `pagosId` int(10) UNSIGNED NOT NULL,
  `card_num_p` varchar(16) NOT NULL,
  `card_name_p` varchar(42) NOT NULL,
  `card_expiring_date_p` varchar(5) NOT NULL,
  `user_id_fk` int(10) UNSIGNED NOT NULL,
  `createdDtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piezas_categoria`
--

CREATE TABLE `piezas_categoria` (
  `id_cat` int(10) UNSIGNED NOT NULL,
  `nombre_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `piezas_categoria`
--

INSERT INTO `piezas_categoria` (`id_cat`, `nombre_cat`) VALUES
(1, 'Electrónica'),
(2, 'Eléctrica'),
(3, 'Mécanica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piezas_electronicas`
--

CREATE TABLE `piezas_electronicas` (
  `id_pie` int(10) UNSIGNED NOT NULL,
  `nombre_pie` varchar(50) NOT NULL,
  `precio_pie` decimal(10,2) NOT NULL,
  `descripcion_pie` text NOT NULL,
  `cantidad_pie` int(10) NOT NULL,
  `descuento_pie` int(10) NOT NULL,
  `imagen_pie` varchar(50) NOT NULL,
  `creacion_pie` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estaBorrado` tinyint(1) NOT NULL DEFAULT '0',
  `fueObtenido` tinyint(1) NOT NULL DEFAULT '0',
  `id_cat_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `piezas_electronicas`
--

INSERT INTO `piezas_electronicas` (`id_pie`, `nombre_pie`, `precio_pie`, `descripcion_pie`, `cantidad_pie`, `descuento_pie`, `imagen_pie`, `creacion_pie`, `estaBorrado`, `fueObtenido`, `id_cat_fk`) VALUES
(1, 'Auriculares', '3000.00', 'De alta calidad.', 10, 5, 'headphone.jpg', '2019-05-09 16:02:44', 0, 0, 2),
(2, 'iPhone 5s', '6000.00', 'De la renombrada empresa Apple, este producto es de lo mejor que tenemos. ', 5, 10, 'iphone.jpg', '2019-05-09 16:04:40', 0, 0, 2),
(3, 'Cámara Canon', '1000.00', '                                                            Muy bueno.                                                      ', 20, 15, 'speaker.jpg', '2019-05-09 16:54:17', 0, 0, 2),
(4, 'iPad Pro', '5000.00', 'Recomendado.', 15, 20, 'ipad.jpg', '2019-05-09 16:07:23', 0, 0, 2),
(5, 'PlayStation 4', '6000.00', 'Para jugar.', 100, 1, 'play-station.jpg', '2019-05-09 16:08:48', 0, 0, 2),
(6, 'Cámara Nikon', '2000.00', 'Qué más decir.', 16, 6, 'nikon.jpg', '2019-05-09 16:09:51', 0, 0, 2),
(7, 'Macbook Air', '3000.00', 'Good.', 10, 5, 'macbook-air.jpg', '2019-05-09 18:04:39', 0, 0, 2),
(8, 'Macbook Pro', '6000.00', 'Fine.', 6, 4, 'macbook-pro.jpg', '2019-05-09 18:06:01', 0, 0, 1),
(9, 'Pixel', '6000.00', 'Wow.', 4, 6, 'pixel.jpg', '2019-05-09 18:06:37', 0, 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) DEFAULT NULL,
  `userName` varchar(128) DEFAULT NULL,
  `process` varchar(1024) NOT NULL,
  `processFunction` varchar(1024) NOT NULL,
  `userRoleId` bigint(20) DEFAULT NULL,
  `userRoleText` varchar(128) DEFAULT NULL,
  `userIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'Admin'),
(2, 'Gerente'),
(3, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_task`
--

CREATE TABLE `tbl_task` (
  `id` bigint(20) NOT NULL,
  `title` varchar(1024) NOT NULL,
  `comment` varchar(2048) NOT NULL,
  `statusId` int(11) NOT NULL,
  `priorityId` int(11) NOT NULL,
  `permalink` varchar(1024) NOT NULL,
  `createdBy` bigint(20) NOT NULL,
  `endDtm` datetime DEFAULT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tasks_prioritys`
--

CREATE TABLE `tbl_tasks_prioritys` (
  `priorityId` bigint(20) NOT NULL,
  `priority` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tasks_prioritys`
--

INSERT INTO `tbl_tasks_prioritys` (`priorityId`, `priority`) VALUES
(1, 'Urgente'),
(2, 'Medio'),
(3, 'Normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tasks_situations`
--

CREATE TABLE `tbl_tasks_situations` (
  `statusId` bigint(20) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tasks_situations`
--

INSERT INTO `tbl_tasks_situations` (`statusId`, `status`) VALUES
(1, 'Abierto'),
(2, 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isDeleted`, `status`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@ornek.com', '$2y$10$9k16Wc4/et.mj73Ov8bBTuMBvP7hHgAkFAC6XBcNKZAO2kLTiXeiC', 'Administrador', '9890098900', 1, 0, 0, 0, '2015-07-01 18:56:49', 1, '2019-05-01 20:57:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `total_cart`
--

CREATE TABLE `total_cart` (
  `total_cart_id` int(10) UNSIGNED NOT NULL,
  `total` float(10,2) NOT NULL,
  `user_id_fk` int(10) UNSIGNED NOT NULL,
  `createdDtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlog`
--

CREATE TABLE `userlog` (
  `id` int(10) NOT NULL,
  `userIp` varchar(1024) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `pie_fk` (`id_pie_fk`),
  ADD KEY `us_fk` (`user_id_fk`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cli`),
  ADD KEY `user3_fk` (`user_id_fk`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`nro_legajo_emp`),
  ADD KEY `emp_fk` (`user_emp_fk`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`pagosId`),
  ADD KEY `user4_fk` (`user_id_fk`);

--
-- Indices de la tabla `piezas_categoria`
--
ALTER TABLE `piezas_categoria`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `piezas_electronicas`
--
ALTER TABLE `piezas_electronicas`
  ADD PRIMARY KEY (`id_pie`),
  ADD KEY `categoria_fk` (`id_cat_fk`);

--
-- Indices de la tabla `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indices de la tabla `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_tasks_prioritys`
--
ALTER TABLE `tbl_tasks_prioritys`
  ADD PRIMARY KEY (`priorityId`);

--
-- Indices de la tabla `tbl_tasks_situations`
--
ALTER TABLE `tbl_tasks_situations`
  ADD PRIMARY KEY (`statusId`);

--
-- Indices de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indices de la tabla `total_cart`
--
ALTER TABLE `total_cart`
  ADD PRIMARY KEY (`total_cart_id`),
  ADD KEY `user5_fk` (`user_id_fk`);

--
-- Indices de la tabla `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user2_fk` (`user_id_fk`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id_cart` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cli` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `nro_legajo_emp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `pagosId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `piezas_categoria`
--
ALTER TABLE `piezas_categoria`
  MODIFY `id_cat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `piezas_electronicas`
--
ALTER TABLE `piezas_electronicas`
  MODIFY `id_pie` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tasks_prioritys`
--
ALTER TABLE `tbl_tasks_prioritys`
  MODIFY `priorityId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tasks_situations`
--
ALTER TABLE `tbl_tasks_situations`
  MODIFY `statusId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `total_cart`
--
ALTER TABLE `total_cart`
  MODIFY `total_cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `pie_fk` FOREIGN KEY (`id_pie_fk`) REFERENCES `piezas_electronicas` (`id_pie`),
  ADD CONSTRAINT `us_fk` FOREIGN KEY (`user_id_fk`) REFERENCES `usuario` (`user_id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `user3_fk` FOREIGN KEY (`user_id_fk`) REFERENCES `usuario` (`user_id`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `emp_fk` FOREIGN KEY (`user_emp_fk`) REFERENCES `tbl_users` (`userId`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `user4_fk` FOREIGN KEY (`user_id_fk`) REFERENCES `usuario` (`user_id`);

--
-- Filtros para la tabla `piezas_electronicas`
--
ALTER TABLE `piezas_electronicas`
  ADD CONSTRAINT `categoria_fk` FOREIGN KEY (`id_cat_fk`) REFERENCES `piezas_categoria` (`id_cat`);

--
-- Filtros para la tabla `total_cart`
--
ALTER TABLE `total_cart`
  ADD CONSTRAINT `user5_fk` FOREIGN KEY (`user_id_fk`) REFERENCES `usuario` (`user_id`);

--
-- Filtros para la tabla `userlog`
--
ALTER TABLE `userlog`
  ADD CONSTRAINT `user2_fk` FOREIGN KEY (`user_id_fk`) REFERENCES `usuario` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
