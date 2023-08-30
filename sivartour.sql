-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2023 a las 06:04:02
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
  `name` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `collections`
--

INSERT INTO `collections` (`id`, `id_user`, `name`, `type`, `url`) VALUES
(2, 32, 'donde llevaré a mi mujer', 1, ''),
(7, 38, 'Playas', 2, ''),
(14, 1, 'Playitas', 2, 'http://localhost/sivartour/join_collection.php?collection=27e06beeac&p=1'),
(15, 47, 'Pueblitos', 2, 'http://localhost/sivartour/join_collection.php?collection=43618616a5&p=47');

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
(2, 32, 2, 31),
(8, 1, 10, 20),
(9, 1, 10, 29),
(10, 1, 14, 27),
(11, 1, 14, 17),
(12, 47, 15, 16),
(13, 47, 15, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collections_share`
--

CREATE TABLE `collections_share` (
  `id` int(11) NOT NULL,
  `id_collection` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `collections_share`
--

INSERT INTO `collections_share` (`id`, `id_collection`, `id_user`, `owner`) VALUES
(9, 14, 1, 1),
(10, 14, 44, 0),
(11, 14, 43, 0),
(12, 15, 47, 1);

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
(1, 1, 4, 'Extraño ir de excursión ahí '),
(2, 1, 1, 'Que lago tan bonito'),
(3, 1, 2, 'Muchas piedras hay'),
(4, 1, 15, 'Bonita playa para hacer surf'),
(5, 1, 11, 'Que catedral mas bonita'),
(6, 1, 17, 'Me gusta esa playa'),
(7, 41, 20, 'bonito centro comercial'),
(8, 1, 30, 'linda playa'),
(9, 1, 37, 'me gustaaa'),
(10, 47, 16, 'Amazing place to make tourism!!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
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
  `rating_count` int(11) DEFAULT 0,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `places`
--

INSERT INTO `places` (`id`, `id_user`, `name`, `description`, `direction`, `location`, `img1`, `img2`, `img3`, `department`, `type`, `public`, `rating`, `rating_count`, `status`) VALUES
(1, 1, 'Lago de Coatepeque', 'Hermoso lago de origen volcánico rodeado de montañas y perfecto para actividades acuáticas.', 'Lago de Coatepeque, El Salvador', 'Lago de Coatepeque, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Coatepeque/Lago-de-coatepeque-013.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Coatepeque/lago-de-coatepeque.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Coatepeque/Coatepeque_Vista1.jpg', 'Santa Ana', 'Lago', 'Todo público', 2, 6, 1),
(2, 1, 'Playa El Tunco', 'Playa popular para practicar surf, con una vibrante vida nocturna y hermosas puestas de sol.', 'Playa El Tunco, El Salvador', 'Playa El Tunco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Tunco/35caaf3ca730c9347957838a20c989c2-1-e1605919240957.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Tunco/59.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Tunco/Eqmcs2eXcAIBV9c.jpg', 'La Libertad', 'Playa', 'Todo público', 2, 4, 1),
(3, 1, 'Parque Nacional Montecristo', 'Reserva natural con una gran diversidad de flora y fauna, ideal para el ecoturismo.', 'Parque Nacional Montecristo Trifinio, El Panal, El Salvador', '9JM8+P55, El Panal, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Montecristo/Montecristo-16-07-2021.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Montecristo/montecristo-2.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Montecristo/PARQUE-NACIONAL-MONTECRISTO-Parques-Nacionales-de-El-Salvador.jpg', 'Santa Ana', 'Bosque', 'Todo público', 1, 3, 1),
(4, 1, 'Tazumal', 'Sitio arqueológico maya con pirámides y ruinas antiguas.', 'Tazumal, Calle Tazumal, Chalchuapa, El Salvador', 'C. Tazumal, Chalchuapa, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Tazumal/SantaAna.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Tazumal/El-Tazumal5.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Tazumal/el_tazumal-700x350-1.jpg', 'Santa Ana', 'Sitio Arqueológico', 'Todo público', 1, 3, 1),
(5, 1, 'El Boquerón', 'Volcán con un cráter impresionante y senderos para disfrutar de la naturaleza.', 'Parque Nacional El Boquerón, Santa Tecla, El Salvador', 'PPMC+J62, Santa Tecla, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/El%20Boquer%C3%B3n/el-boqueron-2.png', 'https://s3.us-east-2.amazonaws.com/sivartour/El%20Boquer%C3%B3n/sjhht.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/El%20Boquer%C3%B3n/a6.jpg', 'San Salvador', 'Montaña', 'Todo público', 1, 2, 1),
(6, 1, 'Parque Nacional Walter Thilo Deininger', 'Área protegida con manglares, playas y una gran variedad de aves.', 'Parque de Aventuras Surf City Walter Thilo Deininger, CA-2, El Salvador', 'CA-2, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Walter%20Thilo%20Deininger/WTD04-1024x768.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Walter%20Thilo%20Deininger/maxresdefault%20%283%29.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Walter%20Thilo%20Deininger/WTD-10032022-ISTU-3.jpg', 'La Libertad', 'Parque', 'Todo público', 1, 1, 1),
(7, 1, 'La Palma', 'Pueblo famoso por su arte y artesanía, especialmente sus pinturas en miniatura.', 'La Palma, El Salvador', 'La Palma, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Palma/la-ciudad-de-la-palma.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Palma/hotel-la-palma.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Palma/maxresdefault%20%284%29.jpg', 'Chalatenango', 'Otro', 'Todo público', 0, 0, 1),
(8, 1, 'Laguna de Alegria', 'Laguna de origen volcánico con aguas termales y vistas impresionantes.', 'Laguna de Alegria, El Salvador', 'Laguna de Alegria, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Alegria/Laguna-de-Alegri%CC%81a-edicio%CC%81n-chris.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Alegria/fsep182019fmalegria5870ca.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Alegria/Laguna-de-alegria.jpg', 'Usulután', 'Lago', 'Todo público', 0, 0, 1),
(9, 1, 'Jardín Botánico La Laguna ', 'Hermoso jardín botánico con una gran variedad de especies de plantas y flores', 'Jardín Botánico Plan de la Laguna, Urb Ind Plan de La Laguna Antgo Cusc, El Salvador', 'Urb Ind Plan de La Laguna Antgo Cusc, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Jard%C3%ADn%20Bot%C3%A1nico%20La%20Laguna%20/20180104_112413-01%20%281%29.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Jard%C3%ADn%20Bot%C3%A1nico%20La%20Laguna%20/20190223_105726-1133x850.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Jard%C3%ADn%20Bot%C3%A1nico%20La%20Laguna%20/43007641891_a40a58b186_b.jpg', 'La Libertad', 'Parque', 'Todo público', 0, 0, 1),
(10, 1, 'Museo de la Revolución', 'Museo que narra la historia de la guerra civil en El Salvador y el movimiento revolucionario.', 'Museo de la Revolución Salvadoreña, Perquín, El Salvador', 'XR5P+FG4, Perquín, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Museo%20de%20la%20Revoluci%C3%B3n/armas-museo-de-la-revolucion-salvadorena.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Museo%20de%20la%20Revoluci%C3%B3n/museo-revolucion-El-Salvador-Avanza.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Museo%20de%20la%20Revoluci%C3%B3n/null-142.jpeg', 'Morazán', 'Otro', 'Todo público', 0, 0, 1),
(11, 1, 'Catedral de Santa Ana', 'Impresionante catedral con una arquitectura colonial destacada.', 'Catedral de Nuestra Señora Santa Ana, 1a Avenida Sur, Santa Ana, El Salvador', '1a Avenida Sur, Santa Ana, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Santa%20Ana/DSC00007.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Santa%20Ana/Santa_Ana_Catedral_Nuestra_Se%C3%B1ora_de_Santa_Ana_2.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Santa%20Ana/4-Catedral-Santa-Ana.jpg', 'Santa Ana', 'Otro', 'Todo público', 1, 1, 1),
(12, 1, 'Parque Nacional Cerro Verde', 'Área protegida con senderos para caminatas y vistas panorámicas de los volcanes circundantes', 'Parque Nacional Cerro Verde, El Salvador', 'R9GG+84V, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Cerro%20Verde/ver-centroamerica-el-salvador-parque-nacional-cerro-verde-01.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Cerro%20Verde/DestinationCerroVerde03.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Cerro%20Verde/ver-centroamerica-cerro-verde-el-salvador-08.jpg', 'Santa Ana', 'Volcán', 'Todo público', 0, 0, 1),
(13, 1, 'Tamanique', 'Pueblo pintoresco con hermosas vistas al océano y actividades como el parapente.', 'Tamanique, El Salvador', 'Tamanique, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Tamanique/CASCADA.jpeg', 'https://s3.us-east-2.amazonaws.com/sivartour/Tamanique/cascadas-tamanique.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Tamanique/cascadas-de-tamanique-la-libertad-1133x850.jpg', 'La Libertad', 'Otro', 'Todo público', 0, 0, 1),
(14, 1, 'Parque Nacional El Pital', 'Área natural protegida que incluye el punto más alto de El Salvador y ofrece senderos para caminatas', 'El Pital, El Salvador', 'El Pital, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Pital/el-pital.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Pital/cerro-el-pital-1.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Pital/deac76d2050000f90e0ef95db95e81fao.jpg', 'Chalatenango', 'Montaña', 'Todo público', 0, 0, 1),
(15, 1, 'Playa El Sunzal', 'Playa famosa por sus olas, ideal para el surf y con hermosos atardeceres.', 'Playa El Sunzal, El Salvador', 'Playa El Sunzal, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Sunzal/ZUNZAL-1-scaled.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Sunzal/photo3jpg.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Sunzal/Conchal%E0%B8%81o-Alejandro-Martinez-scaled.jpg', 'La Libertad', 'Playa', 'Todo público', 1, 1, 1),
(16, 1, 'Suchitoto', 'Encantador pueblo colonial con calles empedradas, iglesias y vista al lago Suchitlán', 'Suchitoto, El Salvador', 'Suchitoto, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Suchitoto/f0.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Suchitoto/Suchitoto-4-1.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Suchitoto/cropped-Casa-de-la-Abuela-Suchitoto-.jpg', 'Cuscatlán', 'Otro', 'Todo público', 1, 2, 1),
(17, 1, 'Playa Costa del Sol', 'Playa popular y animada con resorts, restaurantes y actividades acuáticas.', 'Playa Costa del Sol, El Salvador', 'Playa Costa del Sol, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20Costa%20del%20Sol/Costa-del-Sol.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20Costa%20del%20Sol/photo0jpg.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20Costa%20del%20Sol/las-hojas-resort-club.jpg', 'La Paz', 'Playa', 'Todo público', 1, 1, 1),
(18, 1, 'Palacio Nacional', 'Imponente estructura de estilo neoclásico que alberga las oficinas del gobierno y es sede del Poder', 'Palacio Nacional de El Salvador, 4a Calle Poniente, San Salvador, El Salvador', 'Palacio Nacional de El Salvador, 4a Calle Poniente, San Salvador, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Palacio%20Nacional/palacio-nacional-01.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Palacio%20Nacional/Centro-Historico-de-San-Salvador-18.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Palacio%20Nacional/Palacio_Nacional_de_El_Salvador_Centro_Historico.jpg', 'San Salvador', 'Otro', 'Todo público', 0, 0, 1),
(19, 1, 'Ataco', 'Pueblo pintoresco en la Ruta de las Flores, conocido por sus murales coloridos, cafés y artesanías', 'Concepción de Ataco, El Salvador', 'Concepción de Ataco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Ataco/82006317_3146154935399564_3578059773087580160_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Ataco/Murales-representativos-Ataco-672x372.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Ataco/ataco-3.jpg', 'Ahuachapán', 'Otro', 'Todo público', 1, 1, 1),
(20, 1, 'La Gran Vía', 'Conocida por su vibrante ambiente y una amplia variedad de tiendas, restaurantes, cafés y centros co', 'La Gran Vía, Ciudad Merliot, El Salvador', 'Carretera Panamericana y Calle Chiltiupan Antiguo Cuscatlán, La Libertad Centroamérica, Cd Merliot, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Gran%20V%C3%ADa/120735237_4915450255161972_4515030060911127662_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Gran%20V%C3%ADa/4640943426_688dd5b4ba_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Gran%20V%C3%ADa/LGV%281%29.jpg', 'La Libertad', 'Centro Comercial', 'Todo público', 0, 0, 1),
(21, 1, 'Lago de Ilopango ', 'Conocido por su belleza escénica y su importancia histórica y natural.', 'Lago de Ilopango, El Salvador', 'Lago de Ilopango, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Ilopango%20/GUANACOS-APULO-LAGO-DE-ILOPANGO-1024x768.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Ilopango%20/20210130_135810-1.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Ilopango%20/LAGO-DE-ILOPANGO-Lagos-de-El-Salvador.jpg', 'San Salvador', 'Lago', 'Todo público', 1, 1, 1),
(22, 1, 'La Puerta del Diablo ', 'Mirador natural que ofrece vistas panorámicas espectaculares de los alrededores', 'Puerta del Diablo, Panchimalco, El Salvador', 'JRF5+F4Q, Panchimalco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Puerta%20del%20Diablo%20/220395280_10159384381557618_5922345747777805271_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Puerta%20del%20Diablo%20/GUANACOS-LA-PUERTA-DEL-DIABLO-1024x512.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Puerta%20del%20Diablo%20/La-Puerta-del-Diablo.jpg', 'San Salvador', 'Montaña', 'Todo público', 1, 1, 1),
(23, 1, 'Parque Nacional El Imposible ', 'Reserva natural con exuberante vegetación, cascadas y senderos para practicar senderismo.', 'Parque Nacional El Imposible, Caserío El Coco, El Salvador', 'Caserío El Coco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Imposible%20/10012021-El-Imposible-APPEX-5.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Imposible%20/Mirador_Reserva_Natural_El_Imposible%20%281%29.jpeg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Imposible%20/maxresdefault%20%285%29.jpg', 'Ahuachapán', 'Montaña', 'Todo público', 0, 0, 1),
(24, 1, 'Parque El Principito', 'Parque para disfrutar en familia y aprender más sobre esta hermosa historia.', 'Parque El Principito, Bulevar Merliot, Santa Tecla, El Salvador', 'Blvr. Merliot, Santa Tecla, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20El%20Principito/5a5f46d54b10e9535ed0ca6214e3875a.png', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20El%20Principito/FiSE0zdWIBIaXOm.jpeg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20El%20Principito/DNA2Tl8XcAIK718.jpg', 'La Libertad', 'Parque', 'Todo público', 1, 1, 1),
(25, 1, 'Multiplaza', 'Centro Comercial con gran cantidad de tiendas para cualquier necesidad personal.', 'Multiplaza, San Salvador, El Salvador', 'Carr. Panamericana, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Multiplaza/mobile_Fachada_2.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Multiplaza/dsc09596.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Multiplaza/201709041312120.multiplaza2.jpg', 'La Libertad', 'Centro Comercial', 'Todo público', 0, 0, 1),
(26, 1, 'Paseo El Carmen', 'Calles coloridas, llamativas y con buen ambiente nocturno para disfrutar en familia o con los amigos', 'Paseo El Carmen, 6 Avenida Norte, Santa Tecla, El Salvador', '6 Avenida Norte 4-4 C, Santa Tecla, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Paseo%20El%20Carmen/E-OFCFyXIAEHdEm.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Paseo%20El%20Carmen/paseo-el-carmen.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Paseo%20El%20Carmen/4994600_orig.png', 'La Libertad', 'Otro', 'Todo público', 0, 0, 1),
(27, 1, 'Playa San Diego', 'Linda playa con arena en buen estado, buenas vistas y ambiente agradable', 'Playa San Diego, El Salvador', 'Playa San Diego, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Diego/La_Playa_de_El_Salvador.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Diego/Puestas-de-Sol-en-Playa-San-Diego.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Diego/San-Diego-en-La-Libertad.jpg', 'La Libertad', 'Playa', 'Todo público', 0, 0, 1),
(28, 1, 'Mirador Planes de Renderos', 'Hermosas vistas hacia todo San Salvador desde las alturas, aparte de su excelente y riquísima gastro', 'Mirador de Los Planes de Renderos, Los Planes de Renderos, El Salvador', 'JRV8+P8R, Los Planes de Renderos, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Mirador%20Planes%20de%20Renderos/48184757287_d9c38eff3a_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Mirador%20Planes%20de%20Renderos/54_big.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Mirador%20Planes%20de%20Renderos/6311530.jpg', 'San Salvador', 'Otro', 'Todo público', 1, 1, 1),
(29, 1, 'Metrocentro San Salvador', 'Centro comercial con variedad de tiendas y restaurantes para cumplir con tus antojos y necesidades.', 'Metrocentro San Salvador, Calle Los Sisimiles, San Salvador, El Salvador', 'C. Los Sisimiles, San Salvador, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Metrocentro%20San%20Salvador/Metrocentro-San-Salvador.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Metrocentro%20San%20Salvador/4835832922_116b11fe6e_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Metrocentro%20San%20Salvador/4835795357_45d203204e_b.jpg', 'San Salvador', 'Centro Comercial', 'Todo público', 0, 0, 1),
(30, 1, 'Playa San Blas', 'Playa tranquila, ideal para relajarse de la ciudad y mantener un ambiente de calma con unas increíbl', 'Playa San Blas, El Salvador', 'Playa San Blas, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Blas/46835415902_a12aca4155_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Blas/san-juan-playa-el-escambron.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20San%20Blas/IMG-20201224-WA0013-1024x528.jpg', 'La Libertad', 'Playa', 'Todo público', 1, 1, 1),
(31, 1, 'Plaza Mundo Soyapango', 'Centro comercial ideal para hacer tus compras, comer algo o comprar lo que necesites', 'Plaza Mundo, Bulevar del Ejercito Nacional, Soyapango, El Salvador', 'Blvr. del Ejercito Nacional, Soyapango CP 1116, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Plaza%20Mundo%20Soyapango/FMcvA4MWQAkQ7E-%20%281%29.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Plaza%20Mundo%20Soyapango/img.jpeg', 'https://s3.us-east-2.amazonaws.com/sivartour/Plaza%20Mundo%20Soyapango/Plaza-mundo.jpg', 'San Salvador', 'Centro Comercial', 'Todo público', 0, 0, 1),
(32, 1, 'Furesa', 'Zoológico con diversidad de flora y fauna, para aprender un poco acerca de la vida silvestre y la na', 'Furesa, Carretera a Jayaque, Minas, El Salvador', 'MHQ2+784, Carr. a Jayaque, Minas, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Furesa/papo_blanci.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Furesa/Oso-Furesa-Jayaque-La-Libertad.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Furesa/4353738_orig.jpg', 'La Libertad', 'Parque', 'Todo público', 0, 0, 1),
(33, 1, 'Catedral Nuestra Señora de La Paz', 'Catedral con impresionante arquitectura e historia, una atracción de San Miguel', 'Catedral Basílica Nuestra Señora de la Paz, San Miguel, El Salvador', 'FRMG+53P, San Miguel, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20Nuestra%20Se%C3%B1ora%20de%20La%20Paz/fb-img-1501086382958.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20Nuestra%20Se%C3%B1ora%20de%20La%20Paz/307327976_5891560677554786_8828361716992265134_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20Nuestra%20Se%C3%B1ora%20de%20La%20Paz/altar-mayor-de-la-catedral.jpg', 'San Miguel', 'Otro', 'Todo público', 1, 1, 1),
(34, 1, 'Termales de Santa Teresa', 'Atracción Turística para disfrutar en familia y darse un buen chapuzón', 'Termales de Santa Teresa, Ahuachapán, El Salvador', 'Ahuachapán, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Termales%20de%20Santa%20Teresa/wellness-salvador-termales-santa-teresa_0001_Foto-3.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Termales%20de%20Santa%20Teresa/another-view-of-the-yellow.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Termales%20de%20Santa%20Teresa/guest-with-caolin-facial.jpg', 'Ahuachapán', 'Otro', 'Todo público', 1, 1, 1),
(35, 1, 'La Casa de La Hacienda', 'Parque con diversidad en flora, fauna y muchas cosas más para pasar un momento entretenido.', 'La Casa de La Hacienda, Ilobasco, El Salvador', 'Ilobasco, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Casa%20de%20La%20Hacienda/78392216_3628139840531188_5734916057634701312_n.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Casa%20de%20La%20Hacienda/5775968727_2a5a7dd974_b.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Casa%20de%20La%20Hacienda/fsup20032019erhacienda209.jpg_1102185208.jpg', 'Cabañas', 'Parque', 'Todo público', 0, 0, 1),
(36, 1, 'Parque Acuático Amapulapa', 'Piscinas y muchos lugares para relajarse, bañarse y olvidarse del estrés de la ciudad.', 'Parque Acuático Amapulapa, San Vicente, El Salvador', 'J6HF+CM9, San Vicente, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Acu%C3%A1tico%20Amapulapa/Amapulapa03-min-scaled.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Acu%C3%A1tico%20Amapulapa/Amapulapa01-min-768x512.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Acu%C3%A1tico%20Amapulapa/Amapulapa2.jpg', 'San Vicente', 'Otro', 'Todo público', 0, 0, 1),
(37, 1, 'Catedral de Sonsonate', 'Catedral con arquitectura memorable, reliquia religiosa y una historia hermosa.', 'Catedral de Sonsonate, Calle Obispo Marroquin, Sonsonate, El Salvador', 'Avenida Morazan &, C. Obispo Marroquin, Sonsonate, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Sonsonate/FstlA-7WAAAoLq_%20%281%29.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Sonsonate/16327545967_75d34bd098_z.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Sonsonate/catedral-de-sonsonate.jpg', 'Sonsonate', 'Otro', 'Todo público', 0, 0, 1),
(41, 1, 'Laguna de Apastepeque', 'Linda y curiosa laguna, poco conocida pero con una vista hermosa que ofrecer', 'Laguna de Apastepeque, El Salvador', 'Laguna de Apastepeque, El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Apastepeque/Apastepeque3.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Apastepeque/DestinationApastepeque.jpg', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Apastepeque/fdpt02112019mvlaguna01.jpg_279327997.jpg', 'San Vicente', 'Lago', 'Todo público', 0, 0, 1);

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

--
-- Volcado de datos para la tabla `restaurants`
--

INSERT INTO `restaurants` (`id`, `id_place`, `name`, `img`) VALUES
(1, 1, 'La Pampa', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Coatepeque/una-vista-privilegiada.jpg'),
(2, 1, 'La Octava Maravilla', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Coatepeque/photo1jpg.jpg'),
(3, 1, 'El Gran Mirador', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Coatepeque/caption.jpg'),
(4, 2, 'Beto´s', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Tunco/terrace.jpg'),
(5, 2, 'Coyote', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Tunco/nuestro-restaurante.jpg'),
(6, 2, 'Pelícanos Restaurante', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Tunco/puesta-del-sol-2.jpg'),
(7, 3, 'Quinta Montecristo', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Montecristo/2022-08-21.jpg'),
(8, 3, 'Panes Mayra', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Montecristo/20220507_163413.jpg'),
(9, 3, 'Café Montecristo', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Montecristo/2018-03-31.jpg'),
(10, 4, 'El Portal', 'https://s3.us-east-2.amazonaws.com/sivartour/Tazumal/you-must-go.jpg'),
(11, 4, 'Fraga Specialty Coffee', 'https://s3.us-east-2.amazonaws.com/sivartour/Tazumal/el-mejor-cafe-del-occidente.jpg'),
(12, 4, 'Town House', 'https://s3.us-east-2.amazonaws.com/sivartour/Tazumal/el-sheriff.jpg'),
(13, 5, 'Plaza Volcán', 'https://s3.us-east-2.amazonaws.com/sivartour/El%20Boquer%C3%B3n/restaurant-views.jpg'),
(14, 5, 'Hunan Restaurant', 'https://s3.us-east-2.amazonaws.com/sivartour/El%20Boquer%C3%B3n/hunan-restaurant.jpg'),
(15, 5, 'El Rinconcito Delicioso de el Boqueron', 'https://s3.us-east-2.amazonaws.com/sivartour/El%20Boquer%C3%B3n/2021-09-24.jpg'),
(16, 6, 'Hacienda Real El Salvador', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Walter%20Thilo%20Deininger/hacienda-real-outdoor.jpg'),
(17, 6, 'La Pampa Argentina', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Walter%20Thilo%20Deininger/la-pampa-argentina.jpg'),
(18, 6, 'Perse Eat Different', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Walter%20Thilo%20Deininger/excellent-choice-of-beef.jpg'),
(19, 7, 'Villa Café', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Palma/ambiente-sensasional.jpg'),
(20, 7, 'La Cafeta', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Palma/interior-de-nuestro-negocio.jpg'),
(21, 7, 'La Placita Restaurant', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Palma/nuestra-terraza.jpg'),
(22, 8, 'Casa Rauda', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Alegria/20221002_162006.jpg'),
(23, 8, 'La Fonda de Alegría', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Alegria/2023-01-06.jpg'),
(24, 8, 'Finca San Rafael', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Alegria/20180515_140208.jpg'),
(25, 9, 'La Marquesa', 'https://s3.us-east-2.amazonaws.com/sivartour/Jard%C3%ADn%20Bot%C3%A1nico%20La%20Laguna%20/2023-01-29.jpg'),
(26, 9, 'Restaurante Choice', 'https://s3.us-east-2.amazonaws.com/sivartour/Jard%C3%ADn%20Bot%C3%A1nico%20La%20Laguna%20/2017-08-26.jpg'),
(27, 9, 'Carnivore', 'https://s3.us-east-2.amazonaws.com/sivartour/Jard%C3%ADn%20Bot%C3%A1nico%20La%20Laguna%20/2022-06-26.jpg'),
(28, 10, 'Restaurante Sarita', 'https://s3.us-east-2.amazonaws.com/sivartour/Museo%20de%20la%20Revoluci%C3%B3n/2023-04-13.png'),
(29, 10, 'La Cocina de la Abuela', 'https://s3.us-east-2.amazonaws.com/sivartour/Museo%20de%20la%20Revoluci%C3%B3n/2017-04-11.jpg'),
(30, 10, 'Cocina Lenca', 'https://s3.us-east-2.amazonaws.com/sivartour/Museo%20de%20la%20Revoluci%C3%B3n/2019-02-18.jpg'),
(31, 11, 'Artisant', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Santa%20Ana/2022-06-24.jpg'),
(32, 11, 'Simmer Down', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Santa%20Ana/20230422_115807.jpg'),
(33, 12, 'Hostal y Restaurante Las Lomas', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Cerro%20Verde/2022-04-01.jpg'),
(34, 11, 'Keka´s Place 1950', 'https://s3.us-east-2.amazonaws.com/sivartour/Catedral%20de%20Santa%20Ana/WhatsApp%20Image%202020-09-07%20at%209.14.28%20AM.jpeg'),
(35, 12, 'Los Volcanes Bistro Café', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Cerro%20Verde/IMG_20220424_105032.jpg'),
(36, 12, '400´s Cerros Restaurante', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20Cerro%20Verde/2022-04-12.jpg'),
(37, 13, 'Los Tres Farolitos', 'https://s3.us-east-2.amazonaws.com/sivartour/Tamanique/IMG_20210613_101906.jpg'),
(38, 13, 'Pelícanos Restaurante', 'https://s3.us-east-2.amazonaws.com/sivartour/Tamanique/2021-11-11.jpg'),
(39, 13, 'Restaurante Lo Nuestro', 'https://s3.us-east-2.amazonaws.com/sivartour/Tamanique/2023-07-25.jpg'),
(40, 14, 'Entre Nubes', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Pital/Captura%20de%20pantalla%202023-08-14%20170828.png'),
(41, 14, 'La Pampa', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Pital/52124710333_99ee74f421_b.jpg'),
(42, 14, 'El Jardín de Celeste', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Pital/IMG_4636.jpg'),
(43, 15, 'Kayu Restaurant & Bar', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Sunzal/2020-10-28.jpg'),
(44, 15, 'Café Sunzal', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Sunzal/2022-12-25.jpg'),
(45, 15, 'Rancho Gladimar', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20El%20Sunzal/2023-05-27.jpg'),
(46, 16, 'Casa 1800', 'https://s3.us-east-2.amazonaws.com/sivartour/Suchitoto/2022-10-15.jpg'),
(47, 16, 'Donde Charlie', 'https://s3.us-east-2.amazonaws.com/sivartour/Suchitoto/2023-02-17.jpg'),
(48, 16, 'Suchimex', 'https://s3.us-east-2.amazonaws.com/sivartour/Suchitoto/IMG_20221027_122631.jpg'),
(49, 17, 'Restaurante Acajutla', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20Costa%20del%20Sol/2021-09-10.jpg'),
(50, 17, 'Restaurante Yesenia', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20Costa%20del%20Sol/unnamed%20%281%29.jpg'),
(51, 17, 'La Hola Beto´s', 'https://s3.us-east-2.amazonaws.com/sivartour/Playa%20Costa%20del%20Sol/IMG_20171209_133146.jpg'),
(52, 18, 'Pipiris Nais', 'https://s3.us-east-2.amazonaws.com/sivartour/Palacio%20Nacional/2021-06-20.jpg'),
(53, 18, 'Le Café', 'https://s3.us-east-2.amazonaws.com/sivartour/Palacio%20Nacional/2018-09-28.jpg'),
(54, 18, 'Catedral Café', 'https://s3.us-east-2.amazonaws.com/sivartour/Palacio%20Nacional/2019-05-14.jpg'),
(55, 19, 'El Brasero', 'https://s3.us-east-2.amazonaws.com/sivartour/Ataco/2023-07-04.jpg'),
(56, 19, 'Portland Grill and Bar', 'https://s3.us-east-2.amazonaws.com/sivartour/Ataco/Ataco%20Portland-10.jpg'),
(57, 19, 'Restaurante Sibaritas', 'https://s3.us-east-2.amazonaws.com/sivartour/Ataco/IMG_20210102_115124.jpg'),
(58, 20, 'Tacos Hermanos', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Gran%20V%C3%ADa/2oLusAvShGAvupZVGs1pq384AC1uKqMpy6mdA8k2.png'),
(59, 20, 'Olive Garden', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Gran%20V%C3%ADa/GbMLyIcdG9yLFASt5Ljd74CJCdeUcnQnFaa3zXlS.jpeg'),
(60, 20, 'BENNIGAN´S', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Gran%20V%C3%ADa/gAk31lvPuYO3Wedll7qwLFl92MLNBOyq1h08AcMq.jpeg'),
(61, 21, 'Las Tres Piedras', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Ilopango%20/30012021-_DSC1629.jpg'),
(62, 21, 'Kiosko San Francisco', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Ilopango%20/2023-07-12.jpg'),
(63, 21, 'Coffee Lake', 'https://s3.us-east-2.amazonaws.com/sivartour/Lago%20de%20Ilopango%20/2023-01-15.jpg'),
(64, 22, 'Mil Cumbres', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Puerta%20del%20Diablo%20/2023-02-24.jpg'),
(65, 22, 'Quinta Los Gabos', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Puerta%20del%20Diablo%20/FB_IMG_1676259258259.jpg'),
(66, 22, 'Restaurante La Puerta del Sol', 'https://s3.us-east-2.amazonaws.com/sivartour/La%20Puerta%20del%20Diablo%20/2019-11-25.jpg'),
(67, 23, 'El Guaquito', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Imposible%20/2022-04-09.jpg'),
(68, 23, 'Mixta´s', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20Nacional%20El%20Imposible%20/2023-02-21.jpg'),
(69, 24, 'Don Lomito', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20El%20Principito/2022-03-13.jpg'),
(70, 24, 'La Espetada', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20El%20Principito/2023-05-31.jpg'),
(75, 24, 'Restaurante y Panadería San Martín', 'https://s3.us-east-2.amazonaws.com/sivartour/Parque%20El%20Principito/2022-07-28.jpg'),
(76, 41, 'El Faro Clareño', 'https://s3.us-east-2.amazonaws.com/sivartour/Laguna%20de%20Apastepeque/19.jpg');

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
  `verified` int(11) NOT NULL DEFAULT 0,
  `banned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img`, `token`, `age`, `sex`, `number`, `address`, `instagram`, `whatsapp`, `twitter`, `code`, `verified`, `banned`) VALUES
(1, 'Axel Ramirez', 'axelramireezz@gmail.com', '', 'https://lh3.googleusercontent.com/a/AAcHTtdwud2oM0DUII2C1rQ4AKXbGFTtOOml7orFN75cJ1c6=s96-c', '107045247008393752346', 0, '', 0, '', 'axeellr', '79188652', 'axellmwyy', 39282, 1, 0),
(41, 'pedro', 'pedro@gmail.com', '123456', 'img/man2.png', '929608642180784375367', 0, '', 0, '', '', '', '', 0, 0, 0),
(42, 'pablo', 'pablo@gmail.com', '123456', 'img/man2.png', '820018716679425695344', 0, '', 0, '', '', '', '', 0, 0, 0),
(43, 'el ferxxo mor', 'ferxxo@gmail.com', '123456', 'img/man1.png', '340314320154769686082', 0, '', 0, '', '', '', '', 0, 0, 0),
(44, 'sael', 'sael@gmail.com', '123456', 'img/man1.png', '959c49b50bbd05ae326d', 0, '', 0, '', '', '', '', 0, 0, 0),
(45, 'mionca al bloquee', 'mionca@gmail.com', '1234567', 'img/man1.png', '28d6ef260e2d30837026', 0, '', 0, '', '', '', '', 0, 0, 0),
(46, 'alicia', 'alicia@gmail.com', '123456', 'img/woman2.png', '2b3b4584dd2756099873', 0, '', 0, '', '', '', '', 0, 0, 0),
(47, 'Cristhoper', 'cristhoper@gmail.com', '123456', 'img/man1.png', '5b2388b49e59f0f4bbb7', 0, '', 0, '', '', '', '', 0, 0, 0),
(48, 'chepe', 'chepe@gmail.com', '123456', 'img/man1.png', '5501511819987f16278d', 0, '', 0, '', '', '', '', 0, 0, 0);

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
(22, 1, 22, 1),
(23, 37, 34, 1),
(24, 1, 24, 1),
(25, 1, 16, 1),
(26, 38, 33, 1),
(27, 1, 15, 1),
(28, 1, 11, 1),
(29, 1, 17, 1),
(30, 1, 30, 1),
(31, 1, 28, 1),
(32, 47, 16, 1);

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
-- Indices de la tabla `collections_share`
--
ALTER TABLE `collections_share`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
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
  ADD UNIQUE KEY `unique_rating` (`user_id`,`place_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `collections_places`
--
ALTER TABLE `collections_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `collections_share`
--
ALTER TABLE `collections_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
