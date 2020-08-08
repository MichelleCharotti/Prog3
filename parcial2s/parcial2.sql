-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2020 a las 23:32:54
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parcial2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `usuario`, `fecha`, `descripcion`) VALUES
(1, 1, 270720, 'evento1'),
(2, 1, 270920, 'evento2'),
(3, 1, 200920, 'evento2'),
(4, 3, 200920, 'evento3'),
(5, 3, 210920, 'evento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `nombre`, `clave`, `tipo`) VALUES
(1, 'mail@hotmail.com', 'jose', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.WyIxMjM0Il0.yLlM75Rsj84g3-S-WwTJv84p_tOoGmX3DWyqe1fMAVE', 1),
(2, 'mail1@hotmail.com', 'maria', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.WyIxMjM0NSJd.d5XJ-aP3moK2mybAnrv-mUONeh30B4vxjVoWrfNfE50', 2),
(3, 'mail2@hotmail.com', 'mariajose', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.WyIxMjM0NTYiXQ.uGP5-iNBZjcrur0dgvX4ZGl8vCji6RtokL-zCFLCry4', 1),
(20, 'mail3@hotmail.com', 'mariajo', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.WyIxMjM0NTZcblxuMSJd.4Vep3fcBclnWXEUkfsNG7n9esnm5RLtVx9Ns7awupcY', 1),
(21, 'mail9@hotmail.com', 'jose', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.WyIxMjM0XG5cbjEiXQ.EBh5u5CCxVHbgFTDgEN-6LBZJ9Dr9WUrV60Ti4Z6Gxc', 2),
(22, 'mail5@hotmail.com', 'mario', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.WyIxMjM0Il0.yLlM75Rsj84g3-S-WwTJv84p_tOoGmX3DWyqe1fMAVE', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
