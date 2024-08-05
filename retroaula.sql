-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2024 a las 22:45:37
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
-- Base de datos: `retroaula`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `Codigo` varchar(70) NOT NULL,
  `Nombres` varchar(70) NOT NULL,
  `Apellidos` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`Codigo`, `Nombres`, `Apellidos`) VALUES
('AC70970346', 'Cris', 'Romo'),
('AC78488807', 'Moises', 'Romero'),
('AC87720821', 'Administrador', 'Principal'),
('AC979614712', 'Test', 'ATest');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `id` int(7) NOT NULL,
  `Video` text NOT NULL,
  `Fecha` date NOT NULL,
  `Titulo` varchar(535) NOT NULL,
  `Tutor` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `Adjuntos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `Video`, `Fecha`, `Titulo`, `Tutor`, `Descripcion`, `Adjuntos`) VALUES
(1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/VhCaTS7jhAM?si=AKr4dqvg2hGoeEXd\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2024-08-04', 'Test', '', 'test', 'Screenshot_2024-05-19_213922.png'),
(2, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/VhCaTS7jhAM?si=AKr4dqvg2hGoeEXd\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2024-08-04', 'Test 2', '', '<p>Test 2</p>', 'WhatsApp_Image_2024-06-16_at_18.48.41_e5afd4f0.jpg'),
(3, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/VhCaTS7jhAM?si=AKr4dqvg2hGoeEXd\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2024-08-04', 'Test3', '', '<p>Test 3</p>', 'u.jpg'),
(4, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/VhCaTS7jhAM?si=AKr4dqvg2hGoeEXd\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2024-08-04', 'Test 5', 'Crisma Romero', '<p>Test 5</p>', 'Screenshot_2024-05-09_002135.png'),
(5, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/9Bb_bWCjaFk?si=BvK67pARIYZEhgII\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2024-08-04', 'Clase 4', 'Profe ProfeMa', 'Test 4', 'logo.png'),
(6, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/9Bb_bWCjaFk?si=BvK67pARIYZEhgII\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2024-08-04', 'Clase 3', 'Crisma Romero', 'test 3', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idc` int(17) NOT NULL,
  `id` int(7) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Comentario` text NOT NULL,
  `Adjunto` varchar(150) NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `Codigo` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id` int(7) NOT NULL,
  `Privilegio` int(1) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Clave` varchar(535) NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `Genero` varchar(15) NOT NULL,
  `Codigo` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id`, `Privilegio`, `Usuario`, `Clave`, `Tipo`, `Genero`, `Codigo`) VALUES
(1, 1, 'Administrador', 'NXVlQVZFeTRBV3pTL1R5WEFGY2dMdz09', 'Administrador', 'Masculino', 'AC87720821'),
(2, 4, 'moi123', 'NHdjMnhDcXgvQnIzMktCUDlVc0ZGQT09', 'Estudiante', 'Masculino', 'EC13040502'),
(3, 4, 'Moi', 'NHdjMnhDcXgvQnIzMktCUDlVc0ZGQT09', 'Profesor', 'Masculino', 'PR78344213'),
(4, 1, 'marcoro', 'RzdVelJXWHk4anpmbWRDN2t6b3ltUT09', 'Administrador', 'Masculino', 'AC79668974'),
(5, 1, 'marcoro2', 'dGlYRXgySlBQdTlWVjFTekwxQTJBdz09', 'Administrador', 'Masculino', 'AC53608955'),
(6, 1, 'crisro', 'VUowN1h4OThweHNJdk0vd3lkRWZjZz09', 'Administrador', 'Masculino', 'AC70970346'),
(7, 1, 'moiromero12', 'K1E1em5WZHdpVWVQc0IrMnY4bEZFQT09', 'Administrador', 'Masculino', 'AC78488807'),
(8, 4, 'crismaromero', 'TUhQNHExYTdaZHVMc21OUENBRlI0dz09', 'Profesor', 'Masculino', 'PR08994438'),
(9, 4, 'moi123ro', 'VXRmcUZnYnVIYVZHVy84WC9xYjZyUT09', 'Profesor', 'Masculino', 'PR18481679'),
(10, 4, 'moi1234ro', 'cFlzOElPUkVBTnhwU1pFL1NoTmFWUT09', 'Estudiante', 'Masculino', 'EC065107510'),
(11, 4, 'moitest', 'TnJtbnQ0OU1UMEZUQWhmSk42SUZJUT09', 'Estudiante', 'Masculino', 'EC150546611'),
(12, 1, 'test11', 'dWxyR3RudXZ4RFpXUHdTejkxTDdkUT09', 'Administrador', 'Masculino', 'AC979614712'),
(13, 4, 'profema', 'VkZmcVFzdFNrY0tjM09xMWluMDlPQT09', 'Profesor', 'Masculino', 'PR190144013'),
(14, 4, 'estuma', 'M0NPNFRVUTZWMGh3cnhSKzJ0Y1FSUT09', 'Estudiante', 'Masculino', 'EC952633514');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(7) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `Codigo_profesor` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `Nombre`, `Descripcion`, `Codigo_profesor`) VALUES
(7, 'Informatica 2', 'Test 2', 'PR08994438'),
(8, 'Informatica 3', 'Test', 'PR08994438'),
(11, 'Test materia', 'Test', 'PR08994438'),
(12, 'Ingles 4', 'test 4', 'PR190144013');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `Codigo` varchar(70) NOT NULL,
  `Nombres` varchar(70) NOT NULL,
  `Apellidos` varchar(70) NOT NULL,
  `Email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`Codigo`, `Nombres`, `Apellidos`, `Email`) VALUES
('EC065107510', 'Estudiante', 'Test', 'estudiantetest@gmail.com'),
('EC13040502', 'Moises', 'Romero', 'moisesromero123@gmail.com'),
('EC150546611', 'Moises', 'Romero', 'moisesrome@gmail.com'),
('EC952633514', 'Estu', 'EstuMa', 'estuma@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `Codigo` varchar(70) NOT NULL,
  `Nombres` varchar(70) NOT NULL,
  `Apellidos` varchar(70) NOT NULL,
  `Email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`Codigo`, `Nombres`, `Apellidos`, `Email`) VALUES
('PR08994438', 'Crisma', 'Romero', 'crismaromero@gmail.com'),
('PR18481679', 'Moises', 'Romero', 'moises1romero@gmail.com'),
('PR190144013', 'Profe', 'ProfeMa', 'profema@gmail.com'),
('PR78344213', 'Moises', 'Romero', 'moi@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idc`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`Codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idc` int(17) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
