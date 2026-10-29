-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2026 a las 17:07:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `creotec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ana_compras`
--

CREATE TABLE `ana_compras` (
  `id_compra` int(11) NOT NULL,
  `items` varchar(150) NOT NULL,
  `id_insumo` varchar(20) NOT NULL,
  `unidad_insumo` varchar(20) NOT NULL,
  `comprado_total` decimal(10,2) NOT NULL,
  `peso_envase` decimal(10,2) NOT NULL,
  `comprado_contenido` decimal(10,2) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_ultimo_registro` date DEFAULT NULL,
  `cantidad_actual` decimal(10,2) NOT NULL,
  `stock` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ana_compras`
--

INSERT INTO `ana_compras` (`id_compra`, `items`, `id_insumo`, `unidad_insumo`, `comprado_total`, `peso_envase`, `comprado_contenido`, `precio_total`, `precio_unitario`, `fecha_compra`, `fecha_ultimo_registro`, `cantidad_actual`, `stock`) VALUES
(1, 'Alginato', '1', 'g', 4357.00, 0.00, 4357.00, 535.30, 0.12, '2026-08-03', NULL, 0.00, 0.00),
(2, 'Yeso piedra Amarillo', '2', 'g', 23.00, 5.00, 18.00, 15.00, 0.83, '2026-08-04', NULL, 0.00, 0.00),
(3, 'Yeso piedra Amarillo', '2', 'g', 23.00, 23.00, 0.00, 15.00, 0.00, '2026-08-05', NULL, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ana_insumos`
--

CREATE TABLE `ana_insumos` (
  `id_insumo` varchar(20) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `nombre_item` varchar(150) NOT NULL,
  `unidad_medida` varchar(20) NOT NULL,
  `stock_minimo` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ana_insumos`
--

INSERT INTO `ana_insumos` (`id_insumo`, `prioridad`, `nombre_item`, `unidad_medida`, `stock_minimo`, `descripcion`) VALUES
('1', 2, 'Alginato', 'g', 1359.00, 'Chino, Bolsa rosada'),
('10', 1, 'Silicona Dragon skin 20 A', 'g', 250.00, ''),
('11', 1, 'Silicona Dragon skin 20 B', 'g', 250.00, ''),
('12', 1, 'Silicona Dragon skin 30 A', 'g', 250.00, ''),
('13', 1, 'Silicona Dragon skin 30 B', 'g', 250.00, ''),
('14', 3, 'Espuma Foam-IT Rigido A', 'g', 0.00, ''),
('15', 3, 'Espuma Foam-IT Rigido B', 'g', 0.00, ''),
('16', 3, 'Silicona reserva B', 'g', 0.00, ''),
('17', 1, 'Jeringas 50 ml', 'u', 6.00, '50 ml con  graduacion de 1ml'),
('18', 2, 'Jeringas 20 ml', 'u', 6.00, '20 ml con  graduacion de 1ml'),
('19', 3, 'Jeringas 10 ml', 'u', 6.00, '10 ml con  graduacion de 1ml'),
('2', 1, 'Yeso piedra Amarillo', 'g', 1500.00, 'Amarillo clase III'),
('20', 3, 'Jeringas 5 ml', 'u', 3.00, '5 ml con  graduacion de 1ml'),
('21', 3, 'Jeringas 1 ml', 'u', 1.00, '1 ml con  graduacion de 1ml'),
('22', 2, 'Medias Nilon', 'g', 50.00, ''),
('23', 2, 'Yeso', 'g', 2000.00, 'Blanco tipo paris'),
('24', 2, 'Yeso Gasa', 'g', 200.00, ''),
('25', 1, 'Pañitos humedos', 'u', 25.00, 'Marca Bebe'),
('26', 1, 'Alcohol caiman', 'g', 250.00, 'Marca Caiman'),
('27', 1, 'Alcohol isopropilico', 'g', 250.00, 'Marca Solquifar'),
('28', 1, 'Plasticera Verde', 'g', 500.00, 'Artesanal'),
('29', 1, 'Plasticera Marron', 'g', 500.00, ''),
('3', 3, 'Yeso piedra Celeste', 'g', 0.00, ''),
('30', 1, 'Uñas de plastico', 'u', 500.00, ''),
('31', 2, 'Vasos des. 90 ml', 'u', 10.00, '90 ml Transparentes, flexibles'),
('32', 2, 'Vasos des. 120 ml', 'u', 10.00, '120 ml Transparentes, flexibles'),
('33', 3, 'Tapas desechable 120 ml', 'u', 10.00, ''),
('34', 3, 'Tapas desechable 50 ml', 'u', 10.00, ''),
('35', 2, 'Vasos des. 50 ml', 'u', 10.00, '50 ml Transparentes, flexibles'),
('36', 1, 'Papel higienico', 'rollo', 1.00, 'Para cocina'),
('37', 1, 'Cera', 'g', 250.00, 'Cera mas parafina'),
('38', 1, 'Novocs Mate', 'g', 100.00, ''),
('39', 1, 'Novocs Brillo', 'g', 100.00, ''),
('4', 1, 'Resina dental Fill Magic A2', 'g', 15.00, ''),
('40', 3, 'Novocs Reserva', 'g', 0.00, ''),
('41', 1, 'Crema', 'g', 50.00, ''),
('42', 1, 'Vaselina', 'g', 50.00, ''),
('43', 1, 'Sil-Poxy', 'g', 20.00, ''),
('44', 1, 'Pegamento capilar protesis', 'g', 4.00, ''),
('45', 1, 'Alcohol para quemar', 'g', 250.00, ''),
('46', 3, 'Gasa flexible', 'g', 0.00, ''),
('47', 2, 'Encendedor', 'u', 3.00, ''),
('48', 1, 'Bisturi', 'u', 3.00, ''),
('49', 3, 'Bolsa Zipper 150x200 (mm)', 'u', 10.00, ''),
('5', 1, 'Resina dental Fill Magic A3', 'g', 15.00, ''),
('50', 3, 'Bolsa Zipper 180x250 (mm)', 'u', 10.00, ''),
('51', 3, 'Psycho paint A', 'g', 0.00, ''),
('52', 3, 'Psycho paint B', 'g', 0.00, ''),
('53', 3, 'Bolsa Zipper 230x330 (mm)', 'u', 10.00, ''),
('54', 3, 'Bolsa Zipper 80x120 (mm)', 'u', 10.00, ''),
('55', 1, 'Plastico film', 'g', 10.00, ''),
('6', 1, 'Silicona ecoflex 0050 A', 'g', 251.00, ''),
('7', 1, 'Silicona ecoflex 0050 B', 'g', 250.00, ''),
('8', 1, 'Silicona Dragon skin 10 A', 'g', 250.00, ''),
('9', 1, 'Silicona Dragon skin 10 B', 'g', 250.00, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ana_moldes`
--

CREATE TABLE `ana_moldes` (
  `id` int(10) NOT NULL,
  `codigo_molde` varchar(50) NOT NULL,
  `tipo_protesis` varchar(50) DEFAULT NULL,
  `tipo_registro` varchar(50) DEFAULT NULL,
  `nombre_paciente` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `residencia` varchar(150) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `lado` varchar(20) DEFAULT NULL,
  `longitud` varchar(20) DEFAULT NULL,
  `grosor` varchar(20) DEFAULT NULL,
  `textura` varchar(20) DEFAULT NULL,
  `palma_largo` decimal(10,2) DEFAULT NULL,
  `palma_ancho` decimal(10,2) DEFAULT NULL,
  `palma_perimetro` decimal(10,2) DEFAULT NULL,
  `palma_largo_ab` decimal(10,2) DEFAULT NULL,
  `palma_perimetro_ab` decimal(10,2) DEFAULT NULL,
  `menique_largo` decimal(10,2) DEFAULT NULL,
  `menique_perimetro` decimal(10,2) DEFAULT NULL,
  `menique_alto` decimal(10,2) DEFAULT NULL,
  `menique_ancho` decimal(10,2) DEFAULT NULL,
  `menique_tipo` varchar(20) DEFAULT NULL,
  `anular_largo` decimal(10,2) DEFAULT NULL,
  `anular_perimetro` decimal(10,2) DEFAULT NULL,
  `anular_alto` decimal(10,2) DEFAULT NULL,
  `anular_ancho` decimal(10,2) DEFAULT NULL,
  `anular_tipo` varchar(20) DEFAULT NULL,
  `medio_largo` decimal(10,2) DEFAULT NULL,
  `medio_perimetro` decimal(10,2) DEFAULT NULL,
  `medio_alto` decimal(10,2) DEFAULT NULL,
  `medio_ancho` decimal(10,2) DEFAULT NULL,
  `medio_tipo` varchar(20) DEFAULT NULL,
  `indice_largo` decimal(10,2) DEFAULT NULL,
  `indice_perimetro` decimal(10,2) DEFAULT NULL,
  `indice_alto` decimal(10,2) DEFAULT NULL,
  `indice_ancho` decimal(10,2) DEFAULT NULL,
  `indice_tipo` varchar(20) DEFAULT NULL,
  `pulgar_largo` decimal(10,2) DEFAULT NULL,
  `pulgar_perimetro` decimal(10,2) DEFAULT NULL,
  `pulgar_alto` decimal(10,2) DEFAULT NULL,
  `pulgar_ancho` decimal(10,2) DEFAULT NULL,
  `pulgar_tipo` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ana_moldes`
--

INSERT INTO `ana_moldes` (`id`, `codigo_molde`, `tipo_protesis`, `tipo_registro`, `nombre_paciente`, `edad`, `celular`, `residencia`, `fecha`, `lado`, `longitud`, `grosor`, `textura`, `palma_largo`, `palma_ancho`, `palma_perimetro`, `palma_largo_ab`, `palma_perimetro_ab`, `menique_largo`, `menique_perimetro`, `menique_alto`, `menique_ancho`, `menique_tipo`, `anular_largo`, `anular_perimetro`, `anular_alto`, `anular_ancho`, `anular_tipo`, `medio_largo`, `medio_perimetro`, `medio_alto`, `medio_ancho`, `medio_tipo`, `indice_largo`, `indice_perimetro`, `indice_alto`, `indice_ancho`, `indice_tipo`, `pulgar_largo`, `pulgar_perimetro`, `pulgar_alto`, `pulgar_ancho`, `pulgar_tipo`, `fecha_registro`) VALUES
(35, '1', 'MANO', 'MOLDE', '', 0, '', '', '2026-02-23', 'DERECHA', 'LARGO', 'GRUESO', 'LISO', 10.60, 10.30, 10.10, 23.10, 0.00, 5.50, 6.60, 1.10, 1.20, 'R', 6.50, 7.00, 1.20, 1.30, 'R', 7.00, 7.80, 1.30, 1.40, 'R', 6.20, 7.50, 1.40, 1.20, 'R', 5.00, 7.70, 1.60, 1.10, 'CA', '2026-08-06 03:01:31'),
(36, '2', 'MANO', 'MOLDE', 'Dana Pasante', 0, '', '', '2026-02-24', 'DERECHA', 'LARGO', 'GRUESO', 'LISO', 8.20, 8.20, 16.30, 8.00, 17.70, 4.20, 5.00, 0.70, 0.90, 'L', 6.80, 6.40, 1.00, 1.00, 'L', 7.00, 66.60, 0.90, 1.10, 'R', 5.20, 6.40, 0.90, 1.10, 'R', 5.30, 6.50, 1.10, 1.20, 'L', '2026-08-06 03:04:21'),
(37, '3', 'MANO', 'MOLDE', 'Jhoselin', 0, '', '', '2026-02-24', 'IZQUIERDA', 'LARGO', 'DELGADO', 'LISO', 9.10, 8.40, 16.50, 8.00, 18.20, 4.60, 5.30, 0.90, 0.70, 'L', 6.40, 6.10, 1.10, 0.90, 'L', 6.80, 6.30, 1.20, 1.10, 'L', 7.00, 6.20, 1.20, 1.00, 'L', 4.30, 6.80, 1.30, 1.50, 'L', '2026-08-06 03:08:02'),
(38, '4', 'MANO', 'MOLDE', 'Cristian Pasante', 0, '', '', '2026-02-24', 'DERECHA', 'LARGO', 'GRUESO', 'LISO', 10.40, 9.30, 18.00, 8.00, 20.50, 5.70, 5.80, 1.10, 1.00, 'L', 6.80, 5.90, 1.20, 1.20, 'L', 7.20, 6.70, 1.40, 1.40, 'L', 6.30, 6.40, 1.20, 1.20, 'L', 4.30, 6.90, 1.60, 1.60, 'L', '2026-08-06 03:10:09'),
(39, '5', 'MANO', 'MOLDE', '', 0, '', '', '2026-02-24', 'DERECHA', 'LARGO', 'DELGADO', 'LISO', 9.00, 7.80, 15.20, 8.00, 17.10, 4.80, 5.00, 0.90, 8.00, 'L', 6.20, 5.60, 1.10, 1.00, 'L', 6.40, 6.10, 1.20, 1.00, 'L', 6.10, 5.90, 1.20, 0.90, 'L', 4.40, 6.10, 1.40, 1.30, 'L', '2026-08-06 03:13:43'),
(40, '6', 'MANO', 'MOLDE', '', 0, '', '', '2026-02-24', 'DERECHA', 'LARGO', 'DELGADO', 'LISO', 9.80, 8.50, 16.30, 8.00, 18.10, 5.10, 4.40, 1.00, 0.90, 'L', 7.10, 5.80, 1.10, 1.00, 'L', 7.20, 5.90, 1.20, 1.10, 'L', 6.10, 5.70, 1.10, 1.00, 'L', 5.10, 6.10, 1.10, 1.30, 'L', '2026-08-06 03:15:26'),
(41, '7', 'MANO', 'MOLDE', '', 0, '', '', '2026-02-24', 'DERECHA', 'CORTO', 'DELGADO', 'LISO', 8.80, 7.80, 15.60, 8.00, 16.60, 4.77, 5.00, 0.80, 0.80, 'L', 5.80, 5.50, 0.90, 0.90, 'L', 6.20, 5.80, 1.00, 1.00, 'L', 5.30, 5.70, 0.90, 0.90, 'CO', 4.50, 6.00, 1.10, 1.30, 'L', '2026-08-06 03:17:05'),
(42, '8', 'MANO', 'MOLDE', '', 0, '', '', '2026-02-24', 'IZQUIERDA', 'CORTO', 'DELGADO', 'LISO', 9.50, 8.00, 16.20, 8.00, 17.50, 5.10, 5.10, 0.80, 0.90, 'R', 6.40, 5.70, 0.90, 0.90, 'L', 6.50, 6.30, 1.20, 1.10, 'L', 6.00, 6.40, 1.10, 1.00, 'L', 4.70, 6.80, 1.10, 1.50, 'L', '2026-08-06 03:18:42'),
(44, '9', 'MANO', 'MOLDE', 'Estefania Dronte', 0, '', '', '2026-02-24', 'IZQUIERDA', 'CORTO', 'DELGADO', 'ARRUGADO', 9.50, 8.30, 16.50, 8.00, 17.50, 4.70, 5.40, 0.80, 0.90, 'R', 0.00, 0.00, 0.00, 0.00, '', 6.30, 6.50, 0.90, 1.20, 'L', 5.60, 6.50, 1.00, 1.20, 'L', 4.30, 6.70, 1.30, 1.30, 'L', '2026-08-06 03:20:24'),
(46, '10', 'MANO', 'MOLDE', '', 0, '', '', '2026-02-24', 'IZQUIERDA', 'CORTO', 'DELGADO', 'ARRUGADO', 9.00, 7.80, 15.70, 8.00, 17.00, 4.60, 5.10, 0.90, 0.80, 'L', 6.50, 5.70, 1.10, 1.00, 'L', 6.60, 5.90, 1.00, 1.00, 'L', 5.60, 5.60, 0.90, 1.00, 'L', 4.40, 6.10, 1.00, 1.10, 'L', '2026-08-06 03:23:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ana_registros`
--

CREATE TABLE `ana_registros` (
  `id_registro` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `items` varchar(150) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `comprado_total_contenido` decimal(10,2) NOT NULL,
  `cantidad_anterior_registrada` decimal(10,2) DEFAULT NULL,
  `fecha_anterior_registro` date DEFAULT NULL,
  `cantidad_registrada_mas_envase` decimal(10,2) NOT NULL,
  `cantidad_registrada_menos_envase` decimal(10,2) NOT NULL,
  `consumo_total` decimal(10,2) NOT NULL,
  `consumo_actual` decimal(10,2) NOT NULL,
  `gastos` decimal(10,2) NOT NULL,
  `stock` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `nombre_area`) VALUES
(1, 'Administración'),
(2, 'Anaplastología'),
(3, 'Comercial'),
(4, 'Manufactura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_compras`
--

CREATE TABLE `com_compras` (
  `id_compra` int(11) NOT NULL,
  `items` varchar(150) NOT NULL,
  `id_insumo` varchar(20) NOT NULL,
  `unidad_insumo` varchar(20) NOT NULL,
  `comprado_total` decimal(10,2) NOT NULL,
  `peso_envase` decimal(10,2) NOT NULL,
  `comprado_contenido` decimal(10,2) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_ultimo_registro` date DEFAULT NULL,
  `cantidad_actual` decimal(10,2) NOT NULL,
  `stock` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_insumos`
--

CREATE TABLE `com_insumos` (
  `id_insumo` varchar(20) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `nombre_item` varchar(150) NOT NULL,
  `unidad_medida` varchar(20) NOT NULL,
  `stock_minimo` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_registros`
--

CREATE TABLE `com_registros` (
  `id_registro` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `items` varchar(150) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `comprado_total_contenido` decimal(10,2) NOT NULL,
  `cantidad_anterior_registrada` decimal(10,2) DEFAULT NULL,
  `fecha_anterior_registro` date DEFAULT NULL,
  `cantidad_registrada_mas_envase` decimal(10,2) NOT NULL,
  `cantidad_registrada_menos_envase` decimal(10,2) NOT NULL,
  `consumo_total` decimal(10,2) NOT NULL,
  `consumo_actual` decimal(10,2) NOT NULL,
  `gastos` decimal(10,2) NOT NULL,
  `stock` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `man_compras`
--

CREATE TABLE `man_compras` (
  `id_compra` int(11) NOT NULL,
  `items` varchar(150) NOT NULL,
  `id_insumo` varchar(20) NOT NULL,
  `unidad_insumo` varchar(20) NOT NULL,
  `comprado_total` decimal(10,2) NOT NULL,
  `peso_envase` decimal(10,2) NOT NULL,
  `comprado_contenido` decimal(10,2) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_ultimo_registro` date DEFAULT NULL,
  `cantidad_actual` decimal(10,2) NOT NULL,
  `stock` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `man_insumos`
--

CREATE TABLE `man_insumos` (
  `id_insumo` varchar(20) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `nombre_item` varchar(150) NOT NULL,
  `unidad_medida` varchar(20) NOT NULL,
  `stock_minimo` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `man_registros`
--

CREATE TABLE `man_registros` (
  `id_registro` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `items` varchar(150) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `comprado_total_contenido` decimal(10,2) NOT NULL,
  `cantidad_anterior_registrada` decimal(10,2) DEFAULT NULL,
  `fecha_anterior_registro` date DEFAULT NULL,
  `cantidad_registrada_mas_envase` decimal(10,2) NOT NULL,
  `cantidad_registrada_menos_envase` decimal(10,2) NOT NULL,
  `consumo_total` decimal(10,2) NOT NULL,
  `consumo_actual` decimal(10,2) NOT NULL,
  `gastos` decimal(10,2) NOT NULL,
  `stock` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_personal` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `ci` varchar(20) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `nombres`, `apellidos`, `ci`, `id_area`, `id_tipo`) VALUES
(1, 'Admin', 'Principal', '0000000', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_catalogo`
--

CREATE TABLE `procesos_catalogo` (
  `id_proceso` int(11) NOT NULL,
  `proceso_principal` varchar(150) NOT NULL,
  `nombre_subproceso` varchar(150) NOT NULL,
  `tiempo_esperado_minutos` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesos_catalogo`
--

INSERT INTO `procesos_catalogo` (`id_proceso`, `proceso_principal`, `nombre_subproceso`, `tiempo_esperado_minutos`, `fecha_creacion`) VALUES
(16, 'dedo', 'lijar', 10, '2026-07-14 02:59:01'),
(17, 'dedo', 'limpieza', 4, '2026-07-14 02:59:01'),
(18, 'mano', 'medidas', 5, '2026-07-14 21:52:51'),
(19, 'mano', 'vacio', 20, '2026-07-14 21:52:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_rendimiento`
--

CREATE TABLE `registro_rendimiento` (
  `id_registro` int(11) NOT NULL,
  `id_trabajador` varchar(50) NOT NULL,
  `nombre_paciente` varchar(150) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `tiempo_invertido_segundos` int(11) NOT NULL,
  `estado_final` varchar(20) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_rendimiento`
--

INSERT INTO `registro_rendimiento` (`id_registro`, `id_trabajador`, `nombre_paciente`, `id_proceso`, `tiempo_invertido_segundos`, `estado_final`, `observaciones`, `fecha_actualizacion`) VALUES
(4, '', 'alam', 17, 3, 'completado', '', '2026-07-14 02:59:30'),
(5, '', 'alam', 19, 11, 'completado', '', '2026-07-14 21:53:35'),
(6, '', '', 17, 1, 'completado', '', '2026-07-24 04:38:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_empleado`
--

CREATE TABLE `tipos_empleado` (
  `id_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_empleado`
--

INSERT INTO `tipos_empleado` (`id_tipo`, `nombre_tipo`) VALUES
(1, 'Administrador'),
(3, 'Pasante'),
(2, 'Trabajador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_personal`, `usuario`, `password`, `estado`) VALUES
(1, 1, 'admin', '123', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ana_compras`
--
ALTER TABLE `ana_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_insumo` (`id_insumo`);

--
-- Indices de la tabla `ana_insumos`
--
ALTER TABLE `ana_insumos`
  ADD PRIMARY KEY (`id_insumo`);

--
-- Indices de la tabla `ana_moldes`
--
ALTER TABLE `ana_moldes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_molde` (`codigo_molde`);

--
-- Indices de la tabla `ana_registros`
--
ALTER TABLE `ana_registros`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`),
  ADD UNIQUE KEY `nombre_area` (`nombre_area`);

--
-- Indices de la tabla `com_compras`
--
ALTER TABLE `com_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_insumo` (`id_insumo`);

--
-- Indices de la tabla `com_insumos`
--
ALTER TABLE `com_insumos`
  ADD PRIMARY KEY (`id_insumo`);

--
-- Indices de la tabla `com_registros`
--
ALTER TABLE `com_registros`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `man_compras`
--
ALTER TABLE `man_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_insumo` (`id_insumo`);

--
-- Indices de la tabla `man_insumos`
--
ALTER TABLE `man_insumos`
  ADD PRIMARY KEY (`id_insumo`);

--
-- Indices de la tabla `man_registros`
--
ALTER TABLE `man_registros`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_personal`),
  ADD UNIQUE KEY `ci` (`ci`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `procesos_catalogo`
--
ALTER TABLE `procesos_catalogo`
  ADD PRIMARY KEY (`id_proceso`);

--
-- Indices de la tabla `registro_rendimiento`
--
ALTER TABLE `registro_rendimiento`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indices de la tabla `tipos_empleado`
--
ALTER TABLE `tipos_empleado`
  ADD PRIMARY KEY (`id_tipo`),
  ADD UNIQUE KEY `nombre_tipo` (`nombre_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_personal` (`id_personal`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ana_compras`
--
ALTER TABLE `ana_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ana_moldes`
--
ALTER TABLE `ana_moldes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `ana_registros`
--
ALTER TABLE `ana_registros`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `com_compras`
--
ALTER TABLE `com_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `com_registros`
--
ALTER TABLE `com_registros`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `man_compras`
--
ALTER TABLE `man_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `man_registros`
--
ALTER TABLE `man_registros`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `procesos_catalogo`
--
ALTER TABLE `procesos_catalogo`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `registro_rendimiento`
--
ALTER TABLE `registro_rendimiento`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipos_empleado`
--
ALTER TABLE `tipos_empleado`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ana_compras`
--
ALTER TABLE `ana_compras`
  ADD CONSTRAINT `ana_compras_ibfk_1` FOREIGN KEY (`id_insumo`) REFERENCES `ana_insumos` (`id_insumo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ana_registros`
--
ALTER TABLE `ana_registros`
  ADD CONSTRAINT `ana_registros_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `ana_compras` (`id_compra`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `com_compras`
--
ALTER TABLE `com_compras`
  ADD CONSTRAINT `com_compras_ibfk_1` FOREIGN KEY (`id_insumo`) REFERENCES `com_insumos` (`id_insumo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `com_registros`
--
ALTER TABLE `com_registros`
  ADD CONSTRAINT `com_registros_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `com_compras` (`id_compra`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `man_compras`
--
ALTER TABLE `man_compras`
  ADD CONSTRAINT `man_compras_ibfk_1` FOREIGN KEY (`id_insumo`) REFERENCES `man_insumos` (`id_insumo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `man_registros`
--
ALTER TABLE `man_registros`
  ADD CONSTRAINT `man_registros_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `man_compras` (`id_compra`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`) ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipos_empleado` (`id_tipo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
