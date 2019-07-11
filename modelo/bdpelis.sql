-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2019 a las 21:04:45
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdpelis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `descripcion`, `user_id`, `estado`) VALUES
(1, 'Terror', 1, 1),
(2, ' Comedia', 1, 1),
(3, 'Romance', 1, 1),
(4, ' Drama', 1, 1),
(5, 'Sci-Fi', 1, 1),
(6, 'Suspenso', 2, 1),
(7, 'Thriller', 2, 1),
(8, 'Fantasia', 2, 1),
(9, '', 2, 1),
(10, 'Documental', 2, 1),
(11, 'Musical', 2, 1),
(12, 'Historical', 2, 1),
(13, 'Infantil', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `comentario_id` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `foro_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`comentario_id`, `description`, `fecha`, `user_id`, `foro_id`, `estado`) VALUES
(1, 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', '2018-09-08', 3, 1, 1),
(2, ' aaaaaaaaaaaaaaaaaaaaaaaaaaa bbbbb', '2018-09-08', 4, 1, 1),
(3, 'qhhhhhhhhhhhhhhhh', '2018-09-08', 5, 1, 1),
(4, 'rhfh6trhdtdy7tjdfyjyf', '2018-09-08', 6, 1, 1),
(5, 'Apgnhgjujgh', '2018-09-08', 7, 1, 1),
(6, ' holaaaadgtfgtfhfy', '2018-09-24', 2, 1, 1),
(7, 'xd xd xd xd a', '2018-09-24', 2, 1, 1),
(8, 'yupi', '2018-10-23', 2, 1, 0),
(9, 'yyy', '0000-00-00', 2, 1, 1),
(10, 'ggg', '2018-10-29', 2, 1, 1),
(11, 'fddfd', '2018-10-28', 2, 1, 1),
(12, 'ffff', '2018-10-28', 2, 1, 1),
(13, 'ddd', '2018-10-28', 2, 1, 1),
(14, 'Dark es la mejor porque tiene una muy buena historia', '2019-05-01', 3, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criticas_peliculas`
--

CREATE TABLE `criticas_peliculas` (
  `critica_id` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `criticas_peliculas`
--

INSERT INTO `criticas_peliculas` (`critica_id`, `description`, `fecha`, `user_id`, `movie_id`, `estado`) VALUES
(1, 'fdfdffddddddddddd', '2019-05-01', 2, 1, 0),
(2, 'fffffffffffffff', '2019-05-01', 2, 0, 1),
(3, 'ssss', '2019-05-02', 2, 2, 1),
(4, 'buena peli', '2019-05-02', 2, 1, 1),
(5, 'fffff', '2019-05-02', 2, 3, 1),
(6, 'excelente', '2019-05-02', 2, 4, 1),
(7, 'ddddd', '2019-05-02', 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criticas_series`
--

CREATE TABLE `criticas_series` (
  `critica_id` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `criticas_series`
--

INSERT INTO `criticas_series` (`critica_id`, `description`, `fecha`, `user_id`, `serie_id`, `estado`) VALUES
(1, 'lllllllllghhh', '2019-05-01', 2, 1, 0),
(2, 'gggg', '2019-05-02', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `foro_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `respuestas` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`foro_id`, `title`, `fecha`, `respuestas`, `user_id`, `estado`) VALUES
(1, 'Expectativas para EbdGame- 0 SPOILERS', '2019-04-08 00:00:00', 13, 2, 1),
(2, 'Alguna recomendación ', '2019-04-05 00:00:00', 0, 2, 1),
(6, 'Les gustaría que se añada animes?', '2019-03-08 00:00:00', 0, 2, 1),
(7, 'La mejor plataforma de streaming?', '2019-05-01 20:30:04', 0, 2, 1),
(8, 'Serie favorita y porque', '2019-05-01 20:32:03', 3, 2, 1),
(12, 'Mejpr serie ', '2019-06-06 16:05:34', 3, 2, 1),
(13, 'Ya vieron john wick 03', '2019-06-06 16:05:54', 3, 2, 1),
(14, 'Segunda temporada de The Rain que les pareció?', '2019-06-06 16:54:42', 0, 2, 1),
(15, 'prueba', '2019-06-11 14:57:17', 0, 3, 1),
(16, 'prueba2', '2019-06-11 15:00:35', 0, 3, 1),
(17, 'ZAP', '2019-06-20 13:43:18', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like_unlike`
--

CREATE TABLE `like_unlike` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `like_unlike`
--

INSERT INTO `like_unlike` (`id`, `type`, `user_id`, `comentario_id`) VALUES
(1, 1, 2, 7),
(9, 0, 3, 7),
(10, 0, 3, 6),
(11, 1, 2, 14),
(12, 1, 3, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like_unlike_crit_peli`
--

CREATE TABLE `like_unlike_crit_peli` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `critica_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `like_unlike_crit_peli`
--

INSERT INTO `like_unlike_crit_peli` (`id`, `type`, `user_id`, `critica_id`) VALUES
(1, 1, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like_unlike_crit_serie`
--

CREATE TABLE `like_unlike_crit_serie` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `critica_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `like_unlike_crit_serie`
--

INSERT INTO `like_unlike_crit_serie` (`id`, `type`, `user_id`, `critica_id`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like_unlike_movies`
--

CREATE TABLE `like_unlike_movies` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `like_unlike_movies`
--

INSERT INTO `like_unlike_movies` (`id`, `type`, `user_id`, `movie_id`) VALUES
(1, 0, 2, 1),
(2, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like_unlike_series`
--

CREATE TABLE `like_unlike_series` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `director` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `puntuacion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `trailer` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `criticas` int(11) NOT NULL,
  `id_tematica1` int(11) NOT NULL,
  `Registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `duration`, `director`, `puntuacion`, `description`, `image`, `trailer`, `categoria_id`, `estado`, `criticas`, `id_tematica1`, `Registered`) VALUES
(1, 'La Pasion de Cristo', '127min', 'Mel Gibson', '4.1', 'Condenado a morir crucificado, Jesús de Nazaret experimenta y soporta la agonía de sus últimas doce horas.', 'pasion.jpg', 'https://www.youtube.com/watch?v=kuXtslsLrKQ', 4, 1, 18, 3, '2019-04-26'),
(2, 'Iron Man', '126min', 'Jon Favreau', '6.6', ' Un empresario millonario construye un traje blindado y lo usa para combatir el crimen y el terrorismo.', 'ironman.jpg', 'https://www.youtube.com/watch?v=8hYlB38asDY', 5, 1, 8, 2, '2019-05-15'),
(3, 'Dumbo', '112min', 'Tim Burton', '6.3', 'El dueño de un circo en aprietos contrata a un hombre y sus dos hijos para cuidar de un elefante recién nacido que puede volar, que pronto se convierte en la atracción principal que revitaliza al circ', 'dumbo.jpg', 'https://www.youtube.com/watch?v=CTuGTLx2iEI', 13, 1, 3, 5, '2019-05-22'),
(4, 'It', '135min', 'Andrés Muschietti', '7.4', ' Varios niños de una pequeña ciudad del estado de Maine se alían para combatir a una entidad diabólica que adopta la forma de un payaso y desde hace mucho tiempo emerge cada 27 años para saciarse de s', 'it.jpg', 'https://www.youtube.com/watch?v=FnCdOQsX5kc', 6, 1, 1, 4, '2019-06-04'),
(5, 'Constantine', '121min', 'Francis Lawrence', '7', ' Un hombre que puede ver demonios ayuda a una mujer policía escéptica a investigar la misteriosa muerte de su hermana gemela.', 'constantine.jpg', 'https://www.youtube.com/watch?v=M8APRgAXguc', 6, 1, 1, 6, '2019-06-06'),
(6, '12 años de exclavitud', '126min', 'Steve McQueen', '6.6', ' Antes de la Guerra Civil en Estados Unidos, Solomon Northup, un hombre negro y libre de Saratoga Springs, Nueva York, es secuestrado y vendido como esclavo a un malévolo dueño sureño.', 'got.jpg', 'https://www.youtube.com/watch?v=qU4SlnVtMJc', 4, 1, 1, 7, '2019-05-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `new_id` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `noticia` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`new_id`, `titulo`, `noticia`, `image`, `estado`) VALUES
(5, ' grtgbrthdfgfdfdfff', ' ', 'capitana.jpg', 1),
(6, ' ', ' hfhhfhfhfhf', 'dejavu.jpg', 1),
(8, 'tfhtyhy', '', 'dumbo.jpg', 1),
(9, 'tfhtyhy', '', 'dumbo.jpg', 1),
(10, 'tfhtyhy', '', 'dumbo.jpg', 1),
(11, 'tfgtgtfg', '', 'dumbo.jpg', 1),
(12, 'kkkkkkkk', ' iiiuytrytretfghjgfds', 'lacasadepapel.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `serie_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `director` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `episodes` int(11) NOT NULL,
  `seasons` int(11) NOT NULL,
  `trailer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `criticas` int(11) NOT NULL,
  `id_tematica1` int(11) NOT NULL,
  `Registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`serie_id`, `title`, `description`, `director`, `episodes`, `seasons`, `trailer`, `image`, `categoria_id`, `estado`, `criticas`, `id_tematica1`, `Registered`) VALUES
(1, 'El exorcista', 'Tomás Ortega ha llegado a una pequeña comunidad en los suburbios de Chicago como el nuevo sacerdote. Su vida cambia por completo cuando se enfrenta a una posesión demoníaca.', 'Jason Ensler, Michael Nankin', 20, 2, 'https://www.youtube.com/watch?v=5NH3ffAp9aA', 'exorcista.jpg', 1, 1, 2, 4, '2019-04-23'),
(2, 'Friends', 'Las aventuras de seis jóvenes neoyorquinos unidos por una divertida amistad. Entre el amor, el trabajo y la familia, comparten sus alegrías y preocupaciones en el Central Perk, su café favorito.', 'David Schwimmer', 236, 10, 'https://www.youtube.com/watch?v=SHvzX2pl2ec', 'friends.jpg', 2, 1, 2, 1, '2019-04-25'),
(3, 'Stranger Things', 'Cuando un niño desaparece, sus amigos, la familia y la policía se ven envueltos en una serie de eventos misteriosos al tratar de encontrarlo. Su ausencia coincide con el avistamiento de una criatura t', ' Matt Duffer; Ross Duffer; Shawn Levy', 43, 3, 'https://www.youtube.com/watch?v=x7Yq9MJUqjY', 'stranger.jpg', 8, 1, 7, 2, '2019-05-15'),
(4, 'The Rain', ' Seis años después de que un agresivo virus propagado por la lluvia acabara con casi todos los habitantes de Escandinavia, dos hermanos salen de la comodidad de su bunker para regresar a una civilizac', ' Jannik Tai Mosholt, Esben Toft Jacobsen y Christian Potalivo', 8, 1, 'https://www.youtube.com/watch?v=HMGapZwZO_I', 'therain.jpg', 5, 1, 0, 4, '2019-06-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tematicas`
--

CREATE TABLE `tematicas` (
  `id` int(11) NOT NULL,
  `tematica` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tematicas`
--

INSERT INTO `tematicas` (`id`, `tematica`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(1, 'Día de la Madre', '2019-05-11', '2019-05-12', 1),
(2, 'Día del Padre', '2019-06-15', '2019-06-16', 1),
(3, 'Semana Santa', '2019-04-14', '2019-04-20', 1),
(4, 'Halloween', '2019-10-30', '2019-10-31', 1),
(5, 'Dia del Niño', '2019-04-11', '2019-04-12', 1),
(6, 'Dia Mundial sin Tabaco', '2019-06-23', '2019-06-30', 1),
(7, 'Semana de Solidaridad con los Pueblos de Africa', '2019-05-23', '2019-05-31', 1),
(8, 'dia prueba', '2019-06-21', '2019-05-24', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `cellphone` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `cellphone`, `photo`, `type_id`, `estado`) VALUES
(1, 'Daniel', 'Mendoza', 'yourself08@gmail.com', '12121212', '990481030', 'persona8.jpg', 2, 1),
(2, 'Danitza', 'Llanos', 'danitzallanost@gmail.com', '123456', '979983348', 'persona9.jpg', 1, 1),
(3, 'Anghelo', 'Neira', 'anghelor@gmail.com', '1234567', '948416025', 'persona7.jpg', 2, 1),
(4, 'Juan', 'Gomez', 'virgotlv_42@hotmail.com', '123456789', '999999997', 'user.png', 2, 1),
(6, 'Luis', 'Llanos', 'tz3ro@hotmail.com', '12345678', '976939292', 'user.png', 2, 1),
(7, 'esf', 'fesfsarf', 'danitzallanos@hotmail.com', '12345678', '111111111', 'user.png', 2, 1),
(8, 'Danitza', 'ramirez', 'danitzallanosk@hotmail.com', '12345678', '222222222', 'user.png', 2, 1),
(9, 'Danitza', 'Gomez', 'danitzallanosh@hotmail.com', '123456789', '111', 'user.png', 2, 1),
(10, 'Danitza', 'Gomez', 'danitzallanosg@hotmail.com', '12345678', '999999999', 'user.png', 2, 1),
(11, 'Danitza', 'fesfsarf', 'danitzallanost@hotmail.com', '12345678', '999', 'user.png', 2, 1),
(12, 'Danitza', 'rftdgtg', 'danitzallanoso@hotmail.com', '12345678', '999999887', 'user.png', 2, 1),
(13, 'user', 'sample', 'sample@gmail.com', '12345678', '999999999', 'user.png', 2, 1),
(14, 'samples', 'fesfsarf', 'sample1@gmail.com', '12345678', '777777765', 'user.png', 2, 1),
(15, 'saample', 'sampless', 'sample123@gmail.com', '12345678', '555555555', 'user.png', 2, 1),
(16, 'Teresa', 'Torres', 'teresatorres19@gmail.com', '12345678', '', 'user.png', 2, 1),
(17, 'ZAP', 'ZAP', 'foo-bar@example.com', 'ZAP', 'ZAP', 'user.png', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_types`
--

CREATE TABLE `user_types` (
  `type_id` int(11) NOT NULL,
  `usertype` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_types`
--

INSERT INTO `user_types` (`type_id`, `usertype`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`comentario_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `foro_id` (`foro_id`);

--
-- Indices de la tabla `criticas_peliculas`
--
ALTER TABLE `criticas_peliculas`
  ADD PRIMARY KEY (`critica_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`) USING BTREE;

--
-- Indices de la tabla `criticas_series`
--
ALTER TABLE `criticas_series`
  ADD PRIMARY KEY (`critica_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `serie_id` (`serie_id`) USING BTREE;

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`foro_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `like_unlike`
--
ALTER TABLE `like_unlike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comentario_id` (`comentario_id`);

--
-- Indices de la tabla `like_unlike_crit_peli`
--
ALTER TABLE `like_unlike_crit_peli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `critica_id` (`critica_id`) USING BTREE;

--
-- Indices de la tabla `like_unlike_crit_serie`
--
ALTER TABLE `like_unlike_crit_serie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `critica_id` (`critica_id`) USING BTREE;

--
-- Indices de la tabla `like_unlike_movies`
--
ALTER TABLE `like_unlike_movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`) USING BTREE;

--
-- Indices de la tabla `like_unlike_series`
--
ALTER TABLE `like_unlike_series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `serie_id` (`serie_id`) USING BTREE;

--
-- Indices de la tabla `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`new_id`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`serie_id`);

--
-- Indices de la tabla `tematicas`
--
ALTER TABLE `tematicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `comentario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `criticas_peliculas`
--
ALTER TABLE `criticas_peliculas`
  MODIFY `critica_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `criticas_series`
--
ALTER TABLE `criticas_series`
  MODIFY `critica_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `foro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `like_unlike`
--
ALTER TABLE `like_unlike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `like_unlike_crit_peli`
--
ALTER TABLE `like_unlike_crit_peli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `like_unlike_crit_serie`
--
ALTER TABLE `like_unlike_crit_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `like_unlike_movies`
--
ALTER TABLE `like_unlike_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `like_unlike_series`
--
ALTER TABLE `like_unlike_series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `serie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tematicas`
--
ALTER TABLE `tematicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `user_types`
--
ALTER TABLE `user_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
