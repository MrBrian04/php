-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 16-05-2025 a las 20:19:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `phpsena_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `pk_id_persona` int(11) NOT NULL,
  `pers_nombre` varchar(40) NOT NULL,
  `pers_telefono` varchar(15) NOT NULL,
  `pers_correo` varchar(50) NOT NULL,
  `pers_clave` varchar(255) NOT NULL,
  `pers_fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `fk_id_rol` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`pk_id_persona`, `pers_nombre`, `pers_telefono`, `pers_correo`, `pers_clave`, `pers_fecha_registro`, `fk_id_rol`) VALUES
(8, 'Germain', '3123456789', 'germain@gmail.com', '$2y$10$Yh9sbSvkob3KcsYBxXuIo./RR8JxxtOi14enZQll69j2Y8o2XtW0y', '2025-05-13 00:08:57', 3),
(11, 'Julian', '326655666', 'julian@gmail.com', '$2y$10$mh6q6DBOQKh6bycWCClX7O9o7T9DRfW5tdxgkJwUG8jxECyL7M80e', '2025-05-15 19:17:28', 3),
(12, 'Danilo', '13422423424', 'danilo@gmail.com', '$2y$10$uuBAlPOVv1WgX2DVeJIEdODeg.oV3x8vwr5DLFYvWIBUmKMQydcjS', '2025-05-15 19:30:42', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `pk_id_iproducto` int(11) NOT NULL,
  `prod_nombre` varchar(20) NOT NULL,
  `prod_cantidad` int(10) NOT NULL,
  `prod_precio` float NOT NULL,
  `prod_fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`pk_id_iproducto`, `prod_nombre`, `prod_cantidad`, `prod_precio`, `prod_fecha_registro`) VALUES
(1, 'Play', 1000, 1000000, '2025-05-05 18:37:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `pk_id_rol` int(11) NOT NULL,
  `rol_nombre` varchar(50) NOT NULL COMMENT 'Ej: administrador, editor, invitado',
  `rol_descripcion` varchar(255) DEFAULT NULL COMMENT 'Breve descripción del rol',
  `rol_estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=activo, 0=inactivo',
  `rol_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rol_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`pk_id_rol`, `rol_nombre`, `rol_descripcion`, `rol_estado`, `rol_created_at`, `rol_updated_at`) VALUES
(1, 'administrador', 'Acceso total', 1, '2025-05-13 07:00:50', '2025-05-13 07:00:50'),
(2, 'editor', 'Puede crear y editar', 1, '2025-05-13 07:00:50', '2025-05-13 07:00:50'),
(3, 'invitado', 'Solo lectura', 1, '2025-05-13 07:00:50', '2025-05-13 07:00:50'),
(6, 'Vendedor', 'Permisos superusuario', 1, '2025-05-15 02:09:41', '2025-05-15 02:09:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`pk_id_persona`),
  ADD KEY `fk_personas_rol` (`fk_id_rol`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`pk_id_iproducto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`pk_id_rol`),
  ADD UNIQUE KEY `nombre` (`rol_nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `pk_id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `pk_id_iproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `pk_id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_personas_rol` FOREIGN KEY (`fk_id_rol`) REFERENCES `roles` (`pk_id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
