-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 10:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurante_exquisite`
--

-- --------------------------------------------------------

--
-- Table structure for table `opiniones`
--

CREATE TABLE `opiniones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `opinion` text NOT NULL,
  `calificacion` int(11) NOT NULL CHECK (`calificacion` between 1 and 10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opiniones`
--

INSERT INTO `opiniones` (`id`, `nombre`, `opinion`, `calificacion`) VALUES
(6, 'Juan Pérez', 'La mejor experiencia culinaria de mi vida. El ambiente del restaurante me transportó a otro mundo, y cada plato estaba perfectamente balanceado. Definitivamente regresaré!', 10),
(7, 'María López', 'Exquisitos platos y excelente servicio. La atención al detalle es impresionante, desde la presentación de los platos hasta la amabilidad del personal.', 10),
(8, 'Carlos Ruiz', 'Una velada inolvidable. Los sabores únicos y la atmósfera acogedora hacen de este lugar mi favorito para ocasiones especiales.', 10);

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `hora_reserva` time DEFAULT NULL,
  `numero_personas` int(11) NOT NULL,
  `solicitudes_especiales` text DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`id`, `nombre_cliente`, `correo_electronico`, `telefono`, `fecha_reserva`, `hora_reserva`, `numero_personas`, `solicitudes_especiales`, `estado`) VALUES
(16, 'Nombre Reserva', 'reserva@gmail.com', '123456789', '2024-04-25', '21:00:00', 2, '', 'Pendiente');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `opiniones`
--
ALTER TABLE `opiniones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `opiniones`
--
ALTER TABLE `opiniones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
