-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-11-2022 a las 01:47:29
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `instituto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `cod_tabla` int(11) NOT NULL AUTO_INCREMENT,
  `cod_admin` int(11) NOT NULL,
  `nom_admin` varchar(20) NOT NULL,
  `ap_paterno` varchar(20) NOT NULL,
  `ap_materno` varchar(20) NOT NULL,
  `cel` int(8) NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`cod_tabla`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`cod_tabla`, `cod_admin`, `nom_admin`, `ap_paterno`, `ap_materno`, `cel`, `email`) VALUES
(1, 1, 'Alex', 'Perez', 'Guzman', 75413222, 'Guzman@gmail.com'),
(2, 2, 'Luis', 'Fernandez', 'Ruiz', 66544554, 'R@gmail.com'),
(3, 3, 'Rosa', 'Claros', 'Reluz', 123, 'Rosa@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `cod_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` text NOT NULL,
  `tutor` text NOT NULL,
  `tel_tutor` int(11) NOT NULL,
  `em_tutor` text NOT NULL,
  PRIMARY KEY (`cod_alumno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7865462 ;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`cod_alumno`, `nombre`, `apellido`, `telefono`, `email`, `tutor`, `tel_tutor`, `em_tutor`) VALUES
(456987, 'david', 'rosas', 75681337, 'david@gmail.com', 'romina', 72731208, ''),
(635418, 'raul', 'cespedes', 69542147, 'raulito@gmail.com', 'jorge', 78546987, ''),
(782526, 'iker', 'montero', 67895142, 'iker4@gmail.com', 'gary', 75798634, ''),
(1254634, 'roberto', 'games', 65897124, 'game@gmail.com', 'patricia', 69328514, ''),
(3645478, 'gloria', 'davila', 75896274, 'davila@gmail.com', 'gustavo', 65987741, ''),
(4569787, 'santiago', 'rodriguez', 78522451, 'elsanti@gmail.com', 'maria', 69874221, ''),
(7865461, 'jaime', 'rios', 63574894, 'jaimito4@gmail.com', 'raul', 72589435, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `cod_carrera` int(30) NOT NULL AUTO_INCREMENT,
  `carrera` text NOT NULL,
  PRIMARY KEY (`cod_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE IF NOT EXISTS `docentes` (
  `cod_ta` int(9) NOT NULL AUTO_INCREMENT,
  `cod_ci` int(8) NOT NULL,
  `nom_doc` text NOT NULL,
  `ape_doc` text NOT NULL,
  `us_doc` varchar(25) NOT NULL,
  `gr_acad` text NOT NULL,
  `di_doc` text NOT NULL,
  `talla` varchar(3) NOT NULL,
  `cel_doc` int(8) NOT NULL,
  `cel_ref` int(8) NOT NULL,
  `nom_ref` text NOT NULL,
  `ed_doc` int(2) NOT NULL,
  `ca_hij` int(2) NOT NULL,
  PRIMARY KEY (`cod_ta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`cod_ta`, `cod_ci`, `nom_doc`, `ape_doc`, `us_doc`, `gr_acad`, `di_doc`, `talla`, `cel_doc`, `cel_ref`, `nom_ref`, `ed_doc`, `ca_hij`) VALUES
(1, 0, 'Luisa', 'Reyes', '', '', '', '', 75454522, 4313133, '', 0, 0),
(2, 789456, 'carlos', 'barrios', 'carlos78', 'administrador de empresas', 'boqueron #34', 'L', 78945612, 74185296, 'rosio', 26, 0),
(3, 963852, 'jorge', 'rios', 'jor96', 'mercadologo', 'melean#45', 'M', 75315978, 75915321, 'evert', 28, 1),
(4, 159783, 'rosio', 'herrera', 'roshe15', 'pedagogia', 'san martin # 125', 'M', 65321477, 65987412, 'gonzalo', 32, 3),
(5, 589413, 'alberto', 'bautista', 'albu58', 'comercial', 'panamericana #15', 'XL', 68951247, 69785237, 'rubi', 35, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE IF NOT EXISTS `gestion` (
  `id` int(6) NOT NULL,
  `nom_per` int(11) NOT NULL,
  `cod_per` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(15) NOT NULL,
  `tur` text NOT NULL,
  `cod_h` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE IF NOT EXISTS `materias` (
  `cod_materia` int(255) NOT NULL AUTO_INCREMENT,
  `materia` text NOT NULL,
  PRIMARY KEY (`cod_materia`),
  UNIQUE KEY `cod_materia` (`cod_materia`),
  KEY `cod_materia_2` (`cod_materia`),
  KEY `cod_materia_3` (`cod_materia`),
  KEY `cod_materia_4` (`cod_materia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`cod_materia`, `materia`) VALUES
(1, 'caligrafia I'),
(2, 'dibujo tecnico I'),
(3, 'gestion de clientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `cod_personal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_per` text NOT NULL,
  `ape_per` text NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` text NOT NULL,
  `familiar` text NOT NULL,
  `tel_familiar` int(11) NOT NULL,
  `em_familiar` text NOT NULL,
  PRIMARY KEY (`cod_personal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
