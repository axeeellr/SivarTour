-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2023 a las 06:05:01
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sivartour`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `collections`
--

INSERT INTO `collections` (`id`, `id_user`, `name`) VALUES
(1, 1, 'Bosques'),
(2, 32, 'donde llevaré a mi mujer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collections_places`
--

CREATE TABLE `collections_places` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_collection` int(11) NOT NULL,
  `id_place` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `collections_places`
--

INSERT INTO `collections_places` (`id`, `id_user`, `id_collection`, `id_place`) VALUES
(1, 1, 1, 3),
(2, 32, 2, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_place` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `id_place`, `comment`) VALUES
(1, 1, 4, 'Extraño ir de excursión ahí ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `direction` varchar(600) NOT NULL,
  `location` varchar(600) NOT NULL,
  `img1` varchar(200) NOT NULL,
  `img2` varchar(200) NOT NULL,
  `img3` varchar(200) NOT NULL,
  `department` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `public` varchar(100) NOT NULL,
  `rating` double NOT NULL,
  `rating_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `places`
--

INSERT INTO `places` (`id`, `name`, `description`, `direction`, `location`, `img1`, `img2`, `img3`, `department`, `type`, `public`, `rating`, `rating_count`) VALUES
(1, 'Lago de Coatepeque', 'Hermoso lago de origen volcánico rodeado de montañas y perfecto para actividades acuáticas.', 'Lago de Coatepeque, El Salvador', 'Lago de Coatepeque, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Coatepeque/Lago-de-coatepeque-013.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Coatepeque/lago-de-coatepeque.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Coatepeque/Coatepeque_Vista1.jpg', 'Santa Ana', 'Lago', 'Todo público', 2, 6),
(2, 'Playa El Tunco', 'Playa popular para practicar surf, con una vibrante vida nocturna y hermosas puestas de sol.', 'Playa El Tunco, El Salvador', 'Playa El Tunco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Tunco/35caaf3ca730c9347957838a20c989c2-1-e1605919240957.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Tunco/59.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Tunco/Eqmcs2eXcAIBV9c.jpg', 'La Libertad', 'Playa', 'Todo público', 2, 4),
(3, 'Parque Nacional Montecristo', 'Reserva natural con una gran diversidad de flora y fauna, ideal para el ecoturismo.', 'Parque Nacional Montecristo Trifinio, El Panal, El Salvador', '9JM8+P55, El Panal, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Montecristo/Montecristo-16-07-2021.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Montecristo/montecristo-2.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Montecristo/PARQUE-NACIONAL-MONTECRISTO-Parques-Nacionales-de-El-Salvador.jpg', 'Santa Ana', 'Bosque', 'Todo público', 1, 3),
(4, 'Tazumal', 'Sitio arqueológico maya con pirámides y ruinas antiguas.', 'Tazumal, Calle Tazumal, Chalchuapa, El Salvador', 'C. Tazumal, Chalchuapa, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Tazumal/SantaAna.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Tazumal/El-Tazumal5.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Tazumal/el_tazumal-700x350-1.jpg', 'Santa Ana', 'Sitio Arqueológico', 'Todo público', 1, 3),
(5, 'El Boquerón', 'Volcán con un cráter impresionante y senderos para disfrutar de la naturaleza.', 'Parque Nacional El Boquerón, Santa Tecla, El Salvador', 'PPMC+J62, Santa Tecla, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/El%20Boquer%C3%B3n/el-boqueron-2.png', 'https://s3.us-east-2.amazonaws.com/sivartour/El%20Boquer%C3%B3n/sjhht.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/El%20Boquer%C3%B3n/a6.jpg', 'San Salvador', 'Montaña', 'Todo público', 1, 2),
(6, 'Parque Nacional Walter Thilo Deininger', 'Área protegida con manglares, playas y una gran variedad de aves.', 'Parque de Aventuras Surf City Walter Thilo Deininger, CA-2, El Salvador', 'CA-2, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Walter%20Thilo%20Deininger/WTD04-1024x768.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Walter%20Thilo%20Deininger/maxresdefault%20%283%29.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Walter%20Thilo%20Deininger/WTD-10032022-ISTU-3.jpg', 'La Libertad', 'Parque', 'Todo público', 1, 1),
(7, 'La Palma', 'Pueblo famoso por su arte y artesanía, especialmente sus pinturas en miniatura.', 'La Palma, El Salvador', 'La Palma, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Palma/la-ciudad-de-la-palma.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Palma/hotel-la-palma.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Palma/maxresdefault%20%284%29.jpg', 'Chalatenango', 'Otro', 'Todo público', 0, 0),
(8, 'Laguna de Alegria', 'Laguna de origen volcánico con aguas termales y vistas impresionantes.', 'Laguna de Alegria, El Salvador', 'Laguna de Alegria, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Alegria/Laguna-de-Alegri%CC%81a-edicio%CC%81n-chris.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Alegria/fsep182019fmalegria5870ca.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Alegria/Laguna-de-alegria.jpg', 'Usulután', 'Lago', 'Todo público', 0, 0),
(9, 'Jardín Botánico La Laguna ', 'Hermoso jardín botánico con una gran variedad de especies de plantas y flores', 'Jardín Botánico Plan de la Laguna, Urb Ind Plan de La Laguna Antgo Cusc, El Salvador', 'Urb Ind Plan de La Laguna Antgo Cusc, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Jard%C3%ADn%20Bot%C3%A1nico%20La%20Laguna%20/20180104_112413-01%20%281%29.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Jard%C3%ADn%20Bot%C3%A1nico%20La%20Laguna%20/20190223_105726-1133x850.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Jard%C3%ADn%20Bot%C3%A1nico%20La%20Laguna%20/43007641891_a40a58b186_b.jpg', 'La Libertad', 'Parque', 'Todo público', 0, 0),
(10, 'Museo de la Revolución', 'Museo que narra la historia de la guerra civil en El Salvador y el movimiento revolucionario.', 'Museo de la Revolución Salvadoreña, Perquín, El Salvador', 'XR5P+FG4, Perquín, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Museo%20de%20la%20Revoluci%C3%B3n/armas-museo-de-la-revolucion-salvadorena.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Museo%20de%20la%20Revoluci%C3%B3n/museo-revolucion-El-Salvador-Avanza.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Museo%20de%20la%20Revoluci%C3%B3n/null-142.jpeg', 'Morazán', 'Otro', 'Todo público', 0, 0),
(11, 'Catedral de Santa Ana', 'Impresionante catedral con una arquitectura colonial destacada.', 'Catedral de Nuestra Señora Santa Ana, 1a Avenida Sur, Santa Ana, El Salvador', '1a Avenida Sur, Santa Ana, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Santa%20Ana/DSC00007.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Santa%20Ana/Santa_Ana_Catedral_Nuestra_Se%C3%B1ora_de_Santa_Ana_2.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Santa%20Ana/4-Catedral-Santa-Ana.jpg', 'Santa Ana', 'Otro', 'Todo público', 0, 0),
(12, 'Parque Nacional Cerro Verde', 'Área protegida con senderos para caminatas y vistas panorámicas de los volcanes circundantes', 'Parque Nacional Cerro Verde, El Salvador', 'R9GG+84V, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Cerro%20Verde/ver-centroamerica-el-salvador-parque-nacional-cerro-verde-01.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Cerro%20Verde/DestinationCerroVerde03.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Cerro%20Verde/ver-centroamerica-cerro-verde-el-salvador-08.jpg', 'Santa Ana', 'Volcán', 'Todo público', 0, 0),
(13, 'Tamanique', 'Pueblo pintoresco con hermosas vistas al océano y actividades como el parapente.', 'Tamanique, El Salvador', 'Tamanique, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Tamanique/CASCADA.jpeg', 'https://s3.us-east-2.amazonaws.com/sivartour/Tamanique/cascadas-tamanique.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Tamanique/cascadas-de-tamanique-la-libertad-1133x850.jpg', 'La Libertad', 'Otro', 'Todo público', 0, 0),
(14, 'Parque Nacional El Pital', 'Área natural protegida que incluye el punto más alto de El Salvador y ofrece senderos para caminatas', 'El Pital, El Salvador', 'El Pital, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Pital/el-pital.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Pital/cerro-el-pital-1.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Pital/deac76d2050000f90e0ef95db95e81fao.jpg', 'Chalatenango', 'Montaña', 'Todo público', 0, 0),
(15, 'Playa El Sunzal', 'Playa famosa por sus olas, ideal para el surf y con hermosos atardeceres.', 'Playa El Sunzal, El Salvador', 'Playa El Sunzal, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Sunzal/ZUNZAL-1-scaled.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Sunzal/photo3jpg.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Sunzal/Conchal%E0%B8%81o-Alejandro-Martinez-scaled.jpg', 'La Libertad', 'Playa', 'Todo público', 0, 0),
(16, 'Suchitoto', 'Encantador pueblo colonial con calles empedradas, iglesias y vista al lago Suchitlán', 'Suchitoto, El Salvador', 'Suchitoto, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Suchitoto/f0.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Suchitoto/Suchitoto-4-1.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Suchitoto/cropped-Casa-de-la-Abuela-Suchitoto-.jpg', 'Cuscatlán', 'Otro', 'Todo público', 0, 0),
(17, 'Playa Costa del Sol', 'Playa popular y animada con resorts, restaurantes y actividades acuáticas.', 'Playa Costa del Sol, El Salvador', 'Playa Costa del Sol, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20Costa%20del%20Sol/Costa-del-Sol.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20Costa%20del%20Sol/photo0jpg.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20Costa%20del%20Sol/las-hojas-resort-club.jpg', 'La Paz', 'Playa', 'Todo público', 0, 0),
(18, 'Palacio Nacional', 'Imponente estructura de estilo neoclásico que alberga las oficinas del gobierno y es sede del Poder', 'Palacio Nacional de El Salvador, 4a Calle Poniente, San Salvador, El Salvador', 'Palacio Nacional de El Salvador, 4a Calle Poniente, San Salvador, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Palacio%20Nacional/palacio-nacional-01.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Palacio%20Nacional/Centro-Historico-de-San-Salvador-18.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Palacio%20Nacional/Palacio_Nacional_de_El_Salvador_Centro_Historico.jpg', 'San Salvador', 'Otro', 'Todo público', 0, 0),
(19, 'Ataco', 'Pueblo pintoresco en la Ruta de las Flores, conocido por sus murales coloridos, cafés y artesanías', 'Concepción de Ataco, El Salvador', 'Concepción de Ataco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Ataco/82006317_3146154935399564_3578059773087580160_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Ataco/Murales-representativos-Ataco-672x372.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Ataco/ataco-3.jpg', 'Ahuachapán', 'Otro', 'Todo público', 1, 1),
(20, 'La Gran Vía', 'Conocida por su vibrante ambiente y una amplia variedad de tiendas, restaurantes, cafés y centros co', 'La Gran Vía, Ciudad Merliot, El Salvador', 'Carretera Panamericana y Calle Chiltiupan Antiguo Cuscatlán, La Libertad Centroamérica, Cd Merliot, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Gran%20V%C3%ADa/120735237_4915450255161972_4515030060911127662_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Gran%20V%C3%ADa/4640943426_688dd5b4ba_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Gran%20V%C3%ADa/LGV%281%29.jpg', 'La Libertad', 'Centro Comercial', 'Todo público', 0, 0),
(21, 'Lago de Ilopango ', 'Conocido por su belleza escénica y su importancia histórica y natural.', 'Lago de Ilopango, El Salvador', 'Lago de Ilopango, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Ilopango%20/GUANACOS-APULO-LAGO-DE-ILOPANGO-1024x768.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Ilopango%20/20210130_135810-1.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Ilopango%20/LAGO-DE-ILOPANGO-Lagos-de-El-Salvador.jpg', 'San Salvador', 'Lago', 'Todo público', 1, 1),
(22, 'La Puerta del Diablo ', 'Mirador natural que ofrece vistas panorámicas espectaculares de los alrededores', 'Puerta del Diablo, Panchimalco, El Salvador', 'JRF5+F4Q, Panchimalco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Puerta%20del%20Diablo%20/220395280_10159384381557618_5922345747777805271_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Puerta%20del%20Diablo%20/GUANACOS-LA-PUERTA-DEL-DIABLO-1024x512.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Puerta%20del%20Diablo%20/La-Puerta-del-Diablo.jpg', 'San Salvador', 'Montaña', 'Todo público', 1, 1),
(23, 'Parque Nacional El Imposible ', 'Reserva natural con exuberante vegetación, cascadas y senderos para practicar senderismo.', 'Parque Nacional El Imposible, Caserío El Coco, El Salvador', 'Caserío El Coco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Imposible%20/10012021-El-Imposible-APPEX-5.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Imposible%20/Mirador_Reserva_Natural_El_Imposible%20%281%29.jpeg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Imposible%20/maxresdefault%20%285%29.jpg', 'Ahuachapán', 'Montaña', 'Todo público', 0, 0),
(24, 'Parque El Principito', 'Parque para disfrutar en familia y aprender más sobre esta hermosa historia.', 'Parque El Principito, Bulevar Merliot, Santa Tecla, El Salvador', 'Blvr. Merliot, Santa Tecla, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20El%20Principito/5a5f46d54b10e9535ed0ca6214e3875a.png', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20El%20Principito/FiSE0zdWIBIaXOm.jpeg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20El%20Principito/DNA2Tl8XcAIK718.jpg', 'La Libertad', 'Parque', 'Todo público', 0, 0),
(25, 'Multiplaza', 'Centro Comercial con gran cantidad de tiendas para cualquier necesidad personal.', 'Multiplaza, San Salvador, El Salvador', 'Carr. Panamericana, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Multiplaza/mobile_Fachada_2.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Multiplaza/dsc09596.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Multiplaza/201709041312120.multiplaza2.jpg', 'La Libertad', 'Centro Comercial', 'Todo público', 0, 0),
(26, 'Paseo El Carmen', 'Calles coloridas, llamativas y con buen ambiente nocturno para disfrutar en familia o con los amigos', 'Paseo El Carmen, 6 Avenida Norte, Santa Tecla, El Salvador', '6 Avenida Norte 4-4 C, Santa Tecla, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Paseo%20El%20Carmen/E-OFCFyXIAEHdEm.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Paseo%20El%20Carmen/paseo-el-carmen.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Paseo%20El%20Carmen/4994600_orig.png', 'La Libertad', 'Otro', 'Todo público', 0, 0),
(27, 'Playa San Diego', 'Linda playa con arena en buen estado, buenas vistas y ambiente agradable', 'Playa San Diego, El Salvador', 'Playa San Diego, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Diego/La_Playa_de_El_Salvador.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Diego/Puestas-de-Sol-en-Playa-San-Diego.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Diego/San-Diego-en-La-Libertad.jpg', 'La Libertad', 'Playa', 'Todo público', 0, 0),
(28, 'Mirador Planes de Renderos', 'Hermosas vistas hacia todo San Salvador desde las alturas, aparte de su excelente y riquísima gastro', 'Mirador de Los Planes de Renderos, Los Planes de Renderos, El Salvador', 'JRV8+P8R, Los Planes de Renderos, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Mirador%20Planes%20de%20Renderos/48184757287_d9c38eff3a_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Mirador%20Planes%20de%20Renderos/54_big.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Mirador%20Planes%20de%20Renderos/6311530.jpg', 'San Salvador', 'Otro', 'Todo público', 0, 0),
(29, 'Metrocentro San Salvador', 'Centro comercial con variedad de tiendas y restaurantes para cumplir con tus antojos y necesidades.', 'Metrocentro San Salvador, Calle Los Sisimiles, San Salvador, El Salvador', 'C. Los Sisimiles, San Salvador, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Metrocentro%20San%20Salvador/Metrocentro-San-Salvador.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Metrocentro%20San%20Salvador/4835832922_116b11fe6e_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Metrocentro%20San%20Salvador/4835795357_45d203204e_b.jpg', 'San Salvador', 'Centro Comercial', 'Todo público', 0, 0),
(30, 'Playa San Blas', 'Playa tranquila, ideal para relajarse de la ciudad y mantener un ambiente de calma con unas increíbl', 'Playa San Blas, El Salvador', 'Playa San Blas, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Blas/46835415902_a12aca4155_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Blas/san-juan-playa-el-escambron.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Blas/IMG-20201224-WA0013-1024x528.jpg', 'La Libertad', 'Playa', 'Todo público', 0, 0),
(31, 'Plaza Mundo Soyapango', 'Centro comercial ideal para hacer tus compras, comer algo o comprar lo que necesites', 'Plaza Mundo, Bulevar del Ejercito Nacional, Soyapango, El Salvador', 'Blvr. del Ejercito Nacional, Soyapango CP 1116, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Plaza%20Mundo%20Soyapango/FMcvA4MWQAkQ7E-%20%281%29.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Plaza%20Mundo%20Soyapango/img.jpeg', 'https://s3.us-east-2.amazonaws.com/sivartour/Plaza%20Mundo%20Soyapango/Plaza-mundo.jpg', 'San Salvador', 'Centro Comercial', 'Todo público', 0, 0),
(32, 'Furesa', 'Zoológico con diversidad de flora y fauna, para aprender un poco acerca de la vida silvestre y la na', 'Furesa, Carretera a Jayaque, Minas, El Salvador', 'MHQ2+784, Carr. a Jayaque, Minas, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Furesa/papo_blanci.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Furesa/Oso-Furesa-Jayaque-La-Libertad.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Furesa/4353738_orig.jpg', 'La Libertad', 'Parque', 'Todo público', 0, 0),
(33, 'Catedral Nuestra Señora de La Paz', 'Catedral con impresionante arquitectura e historia, una atracción de San Miguel', 'Catedral Basílica Nuestra Señora de la Paz, San Miguel, El Salvador', 'FRMG+53P, San Miguel, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20Nuestra%20Se%C3%B1ora%20de%20La%20Paz/fb-img-1501086382958.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20Nuestra%20Se%C3%B1ora%20de%20La%20Paz/307327976_5891560677554786_8828361716992265134_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20Nuestra%20Se%C3%B1ora%20de%20La%20Paz/altar-mayor-de-la-catedral.jpg', 'San Miguel', 'Otro', 'Todo público', 0, 0),
(34, 'Termales de Santa Teresa', 'Atracción Turística para disfrutar en familia y darse un buen chapuzón', 'Termales de Santa Teresa, Ahuachapán, El Salvador', 'Ahuachapán, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Termales%20de%20Santa%20Teresa/wellness-salvador-termales-santa-teresa_0001_Foto-3.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Termales%20de%20Santa%20Teresa/another-view-of-the-yellow.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Termales%20de%20Santa%20Teresa/guest-with-caolin-facial.jpg', 'Ahuachapán', 'Otro', 'Todo público', 0, 0),
(35, 'La Casa de La Hacienda', 'Parque con diversidad en flora, fauna y muchas cosas más para pasar un momento entretenido.', 'La Casa de La Hacienda, Ilobasco, El Salvador', 'Ilobasco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Casa%20de%20La%20Hacienda/78392216_3628139840531188_5734916057634701312_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Casa%20de%20La%20Hacienda/5775968727_2a5a7dd974_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Casa%20de%20La%20Hacienda/fsup20032019erhacienda209.jpg_1102185208.jpg', 'Cabañas', 'Parque', 'Todo público', 0, 0),
(36, 'Parque Acuático Amapulapa', 'Piscinas y muchos lugares para relajarse, bañarse y olvidarse del estrés de la ciudad.', 'Parque Acuático Amapulapa, San Vicente, El Salvador', 'J6HF+CM9, San Vicente, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Acu%C3%A1tico%20Amapulapa/Amapulapa03-min-scaled.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Acu%C3%A1tico%20Amapulapa/Amapulapa01-min-768x512.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Acu%C3%A1tico%20Amapulapa/Amapulapa2.jpg', 'San Vicente', 'Otro', 'Todo público', 0, 0),
(37, 'Catedral de Sonsonate', 'Catedral con arquitectura memorable, reliquia religiosa y una historia hermosa.', 'Catedral de Sonsonate, Calle Obispo Marroquin, Sonsonate, El Salvador', 'Avenida Morazan &, C. Obispo Marroquin, Sonsonate, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Sonsonate/FstlA-7WAAAoLq_%20%281%29.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Sonsonate/16327545967_75d34bd098_z.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Sonsonate/catedral-de-sonsonate.jpg', 'Sonsonate', 'Otro', 'Todo público', 0, 0),
(38, 'Apaneca', 'Un bonito lugar para visitar', 'Apaneca, El Salvador', 'Apaneca, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Apaneca/apaneca-el-salvador.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Apaneca/apaneca.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Apaneca/Laguna-Verde-Apaneca6E9A4388.jpg', 'Chalatenango', 'Otro', 'Todo público', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `id_place` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `code` int(5) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img`, `token`, `age`, `sex`, `number`, `address`, `instagram`, `whatsapp`, `twitter`, `code`, `verified`) VALUES
(1, 'Axel Ramirez', 'axelramireezz@gmail.com', '', 'https://lh3.googleusercontent.com/a/AAcHTtdwud2oM0DUII2C1rQ4AKXbGFTtOOml7orFN75cJ1c6=s96-c', '107045247008393752346', 0, '', 0, '', '', '', '', 39282, 1),
(7, 'Miguel', 'miguelchapiza@gmail.com', '123456', '', '200847516297541235460', 0, '', 0, '', '', '', '', 0, 0),
(16, 'pedro', 'pedro@gmail.com', '123456', '', '935344646815697831581', 0, '', 0, '', '', '', '', 0, 0),
(17, 'Erick', 'erick@gmail.com', '12345', '', '513047413789549182903', 0, '', 0, '', '', '', '', 0, 0),
(19, 'Zion', 'zion@gmail.com', '123456', '', '641149978582221463075', 17, 'Masculino', 0, 'Soyapango', '', '', '', 10716, 0),
(21, 'axel2', 'axelby36@gmail.com', '123456', '', '982491014817580337460', 0, '', 0, '', '', '', '', 67195, 1),
(22, 'chepe pablo', 'chepepablo@gmail.com', '123456', '', '079580131204947342256', 0, '', 0, '', '', '', '', 85776, 1),
(23, 'assdas', 'sydney.augsburg@gmail.com', '12345', '', '156325971053408932178', 20, '', 0, '', '', '', '', 41720, 1),
(31, 'misho', 'mish@gmail.com', '123456', '', '530546128693905722497', 0, '', 0, '', '', '', '', 0, 0),
(32, 'rels b', 'rels@gmail.com', '123456', '', '685106377067039424512', 0, '', 0, '', '', '', '', 94896, 0),
(33, 'Amilcar', 'amilcar@gmail.com', '123456', '', '753060311270499618245', 25, '', 0, '', '', '', '', 43946, 1),
(34, 'Axel Enrique Aguilar Ramírez', 'estudiante20120161@cdb.edu.sv', '', 'https://lh3.googleusercontent.com/a/AAcHTtdqMNc7bWhNG5VV3mVAqFmjjnYCXtq19ouakXSfloOCAA=s96-c', '115753393956445900696', 0, '', 0, '', '', '', '', 0, 0),
(35, 'ter stegen', 'ter@gmail.com', '123456', '', '224750210866096847513', 0, '', 0, '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_ratings`
--

CREATE TABLE `user_ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_ratings`
--

INSERT INTO `user_ratings` (`id`, `user_id`, `place_id`, `rating`) VALUES
(10, 1, 2, 1),
(11, 1, 1, 1),
(12, 19, 1, 1),
(13, 19, 3, 1),
(14, 19, 5, 1),
(15, 0, 1, 1),
(16, 0, 2, 1),
(17, 32, 21, 1),
(18, 33, 4, 1),
(19, 33, 38, 1),
(20, 0, 6, 1),
(21, 0, 19, 1),
(22, 1, 22, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `collections_places`
--
ALTER TABLE `collections_places`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_rating` (`user_id`,`place_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `collections_places`
--
ALTER TABLE `collections_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
