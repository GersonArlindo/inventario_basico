-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2022 at 02:18 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2_basico`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('MasterRol', '1', 1646099809),
('UsuarioRol', '2', 1646099817);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/categorias/*', 2, NULL, NULL, NULL, 1646099417, 1646099417),
('/debug/*', 2, NULL, NULL, NULL, 1646099442, 1646099442),
('/gii/*', 2, NULL, NULL, NULL, 1646099450, 1646099450),
('/gridview/*', 2, NULL, NULL, NULL, 1646099465, 1646099465),
('/inicio/*', 2, NULL, NULL, NULL, 1646099380, 1646099380),
('/inicio/index', 2, NULL, NULL, NULL, 1646100390, 1646100390),
('/inicio/resta', 2, NULL, NULL, NULL, 1646100390, 1646100390),
('/inicio/suma', 2, NULL, NULL, NULL, 1646100390, 1646100390),
('/productos/*', 2, NULL, NULL, NULL, 1646099423, 1646099423),
('/rbac/*', 2, NULL, NULL, NULL, 1646099493, 1646099493),
('/site/*', 2, NULL, NULL, NULL, 1646099406, 1646099406),
('/usuarios/*', 2, NULL, NULL, NULL, 1646099428, 1646099428),
('/usuarios/update', 2, NULL, NULL, NULL, 1646100607, 1646100607),
('/usuarios/view', 2, NULL, NULL, NULL, 1646100568, 1646100568),
('MasterAccess', 2, 'Permiso para acceder a todas las rutas del sistema como SuperAdmin', NULL, NULL, 1646099558, 1646099558),
('MasterRol', 1, 'Rol Master', NULL, NULL, 1646099694, 1646099771),
('UsuarioAccess', 2, 'Acceso limitado de usuario a productos y categorias', NULL, NULL, 1646099606, 1646099750),
('UsuarioRol', 1, 'Rol de usuario', NULL, NULL, 1646099726, 1646099777);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('MasterAccess', '/categorias/*'),
('UsuarioAccess', '/categorias/*'),
('MasterAccess', '/debug/*'),
('MasterAccess', '/gii/*'),
('MasterAccess', '/gridview/*'),
('MasterAccess', '/inicio/*'),
('UsuarioAccess', '/inicio/suma'),
('MasterAccess', '/productos/*'),
('UsuarioAccess', '/productos/*'),
('MasterAccess', '/rbac/*'),
('MasterAccess', '/site/*'),
('UsuarioAccess', '/site/*'),
('MasterAccess', '/usuarios/*'),
('UsuarioAccess', '/usuarios/update'),
('UsuarioAccess', '/usuarios/view'),
('MasterRol', 'MasterAccess'),
('UsuarioRol', 'UsuarioAccess');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1644760080),
('m130524_201442_init', 1644760082),
('m140506_102106_rbac_init', 1646099002),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1646099002),
('m180523_151638_rbac_updates_indexes_without_prefix', 1646099002),
('m200409_110543_rbac_update_mssql_trigger', 1646099002);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_ing` datetime NOT NULL,
  `fecha_mod` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`id_categoria`, `nombre`, `fecha_ing`, `fecha_mod`, `id_usuario`, `estado`) VALUES
(1, 'VideoJuegos', '2022-02-20 15:00:10', '2022-02-20 09:15:38', 1, 1),
(2, 'Juegos de Mesa', '2022-02-20 15:00:33', '2022-02-20 15:00:33', 1, 1),
(3, 'Cocina', '2022-02-20 15:02:22', '2022-02-20 15:02:22', 10, 1),
(4, 'Jardin', '2022-02-20 15:06:26', '2022-02-20 09:42:23', 1, 0),
(5, 'Consolas', '2022-02-20 15:08:35', '2022-02-20 15:08:35', 1, 1),
(6, 'Audio', '2022-02-20 09:11:08', '2022-02-20 09:40:23', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_ing` datetime NOT NULL,
  `fecha_mod` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `campo_extra` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_productos`
--

INSERT INTO `tbl_productos` (`id_producto`, `id_categoria`, `nombre`, `descripcion`, `imagen`, `fecha_ing`, `fecha_mod`, `id_usuario`, `estado`, `campo_extra`) VALUES
(2, 5, 'PS4', 'Role-based access control (RBAC) and attribute-based access control (ABAC) are two ways of controlling the authentication process and authorizing users. The primary difference between RBAC and ABAC is RBAC provides access to resources or information based on user roles, while ABAC provides access rights based on user, environment, or resource attributes. Essentially, when considering RBAC vs. ABAC, RBAC controls broad access across an organization, while ABAC takes a fine-grain approach.', '', '2022-02-20 10:16:07', '2022-02-20 10:16:07', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `username`, `nombre`, `apellido`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `imagen`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'Admin', 'Admin', 'tEuYL0epr10-PDJDdZ3dAmQs9nCU2gfl', '$2y$13$Hkpi4vzKpl.0cT1P7T.wVOJZRMBjvR6PHkJYrBmn/pO6z7d7wnPyi', NULL, 'admin@admin.com', '/avatars/dBC4_WA9QZx9sk7sYn3f8vrVcvQpqV-k.gif', 1, 1646012409, 1646012409, NULL),
(2, 'test', 'Test', 'test', 'YKKwSFAZSkRBp21O-nYSLvfh8-36Uu8Z', '$2y$13$Tdx5beo/phev7v4CLad.i.AYH7zKOZ.DUQDKtrGRc5lqHjFWOyroW', NULL, 'test@test.com', '/avatars/default.png', 1, 1646012577, 1646012577, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `tbl_productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
