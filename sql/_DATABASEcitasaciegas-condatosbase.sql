-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2025 a las 03:18:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citasaciegas`
--
CREATE DATABASE IF NOT EXISTS `citasaciegas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `citasaciegas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citaideal`
--
-- Creación: 06-11-2025 a las 13:10:15
--

CREATE TABLE `citaideal` (
  `id_cita_ideal` int(11) NOT NULL,
  `cita_ideal` varchar(255) DEFAULT NULL,
  `posible_respuesta` varchar(200) DEFAULT NULL,
  `adj_sugeridos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `citaideal`:
--

--
-- Volcado de datos para la tabla `citaideal`
--

INSERT INTO `citaideal` (`id_cita_ideal`, `cita_ideal`, `posible_respuesta`, `adj_sugeridos`) VALUES
(1, 'relajada y simple', 'algo simple y relajado, como tomar algo o caminar sin apuro.', 'sencillo/a, reservado/a, previsible'),
(2, 'tener una experiencia nueva', 'una actividad diferente: visitar algun sitio como un museo, alguna reserva natural… estoy abierto/a a propuestas novedosas', 'curioso/a, inquieto/a, impulsivo/a'),
(3, 'hacer alguna actividad física', 'algo mas activo, como salir a andar en bici, patinar, caminar.', 'energetico/a, competitivo/a, intenso/a'),
(4, 'nervios iniciales', 'algo tranquilo, porque las primeras citas me ponen un poco nervioso/a.', 'inseguro/a, tímido/a, cauto/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--
-- Creación: 06-11-2025 a las 13:10:16
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `perfil1` int(11) NOT NULL,
  `perfil2` int(11) NOT NULL,
  `fechayhora` datetime DEFAULT NULL,
  `latitud` varchar(100) NOT NULL,
  `longitud` varchar(100) NOT NULL,
  `detalle` varchar(255) DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  `devolucion2` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `citas`:
--   `id_estado`
--       `estados` -> `id_estado`
--   `perfil2`
--       `usuarios` -> `idusuario`
--   `perfil1`
--       `usuarios` -> `idusuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--
-- Creación: 06-11-2025 a las 13:10:16
--

CREATE TABLE `departamentos` (
  `iddepa` int(11) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `departamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `departamentos`:
--   `idprovincia`
--       `provincias` -> `idprovincia`
--

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`iddepa`, `idprovincia`, `departamento`) VALUES
(1, 1, 'capital'),
(2, 1, '25 de mayo'),
(3, 1, 'apostoles'),
(4, 1, 'calendaria'),
(5, 1, 'cainguas'),
(6, 1, 'concepcion'),
(7, 1, 'general manuel belgrano'),
(8, 1, 'eldorado'),
(9, 1, 'libertador general san martin'),
(10, 1, 'san javier'),
(11, 1, 'iguazu'),
(12, 1, 'guarani'),
(13, 1, 'san pedro'),
(14, 1, 'leandro n. alem'),
(15, 1, 'san ignacio'),
(16, 1, 'obera'),
(17, 1, 'montecarlo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--
-- Creación: 06-11-2025 a las 13:10:15
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `estados`:
--

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'suspendido'),
(2, 'habilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilosdevida`
--
-- Creación: 06-11-2025 a las 13:10:15
--

CREATE TABLE `estilosdevida` (
  `id_estilo` int(11) NOT NULL,
  `estilo_de_vida` varchar(255) DEFAULT NULL,
  `posible_respuesta` varchar(200) DEFAULT NULL,
  `adj_sugeridos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `estilosdevida`:
--

--
-- Volcado de datos para la tabla `estilosdevida`
--

INSERT INTO `estilosdevida` (`id_estilo`, `estilo_de_vida`, `posible_respuesta`, `adj_sugeridos`) VALUES
(1, 'estructurado', 'bastante estructurado: me gusta planificar y mantener mis rutinas', 'ordenado/a, rígido/a, controlador/a'),
(2, 'activo/a', 'activo/a: me gusta moverme, hacer deporte o mantenerme en movimiento', 'dinamico/a, ansioso/a, inquieto/a'),
(3, 'cambiante', 'cambiante: no me gusta hacer siempre lo mismo, necesito variedad', 'versatil, inestable, impaciente'),
(4, 'desorganizado', 'algo desorganizado; intento llevar el ritmo pero a veces me cuesta mantenerlo', 'caotico/a, desordenado/a, desmotivado/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--
-- Creación: 06-11-2025 a las 13:10:15
--

CREATE TABLE `generos` (
  `idgenero` int(11) NOT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `generos`:
--

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`idgenero`, `genero`, `descripcion`) VALUES
(1, 'cisgenero', 'personas cuya identidad de genero coincide con el sexo que se les asignó al nacer'),
(2, 'mujer trans y/o travesti', 'personas que fueron asignadas varon al nacer y se identifican como mujeres.\r\n'),
(3, 'varon trans', 'personas que fueron asignadas mujer al nacer y se identifican como varones'),
(4, 'no binario', 'personas cuya identidad de género no es exclusivamente masculina ni femenina'),
(5, 'genero fluido', 'personas cuya identidad de genero cambia con el tiempo'),
(6, 'otro', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivacionesdeldia`
--
-- Creación: 07-11-2025 a las 01:22:03
--

CREATE TABLE `motivacionesdeldia` (
  `id_motivacion` int(11) NOT NULL,
  `motivacion_del_dia` varchar(100) DEFAULT NULL,
  `posible_respuesta` varchar(200) DEFAULT NULL,
  `adj_sugeridos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `motivacionesdeldia`:
--

--
-- Volcado de datos para la tabla `motivacionesdeldia`
--

INSERT INTO `motivacionesdeldia` (`id_motivacion`, `motivacion_del_dia`, `posible_respuesta`, `adj_sugeridos`) VALUES
(1, 'vinculos personales', 'las personas y los vinculos que construyo.', 'afectivo/a, dependiente, sociable'),
(2, 'expresion creativa', 'expresarme y crear, sea con arte, ideas o proyectos personales', 'creativo/a, idealista, volatil'),
(3, 'aprendizaje', 'aprender, descubrir y vivir experiencias nuevas.', 'curioso/a, ambicioso/a, disperso/a'),
(4, 'aprendizaje', 'aprender, descubrir y vivir experiencias nuevas', 'curioso/a, ambicioso/a, disperso/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orientacionessexuales`
--
-- Creación: 06-11-2025 a las 13:10:15
--

CREATE TABLE `orientacionessexuales` (
  `idorientacion` int(10) NOT NULL,
  `orientacionsexual` varchar(100) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `orientacionessexuales`:
--

--
-- Volcado de datos para la tabla `orientacionessexuales`
--

INSERT INTO `orientacionessexuales` (`idorientacion`, `orientacionsexual`, `descripcion`) VALUES
(1, 'heterosexual', 'atraccion afectiva o sexual hacia personas del genero opuesto'),
(2, 'homosexual', 'atraccion afectiva o sexual hacia personas del mismo genero.\r\n'),
(3, 'bisexual', 'atraccion afectiva o sexual hacia personas de mas de un genero'),
(4, 'pansexual', 'atraccion afectiva o sexual hacia personas sin que el género sea un factor determinante'),
(5, 'asexual', 'ausencia total o parcial de atraccion sexual hacia otras personas\r\n'),
(6, 'demisexual', 'atraccion sexual hacia una persona que solo se desarrolla despues de haber establecido un vinculo emocional fuerte y significativo con ella'),
(7, 'otro', 'existen diversas formas validas de experimentar y expresar la atraccion, reflejando la diversidad natural de las identidades humanas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--
-- Creación: 08-11-2025 a las 02:16:57
-- Última actualización: 08-11-2025 a las 02:16:57
--

CREATE TABLE `perfiles` (
  `idperfil` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `idprovincia` int(11) NOT NULL,
  `iddepa` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idsexo` int(11) NOT NULL,
  `idgenero` int(11) NOT NULL,
  `idorientacion` int(10) NOT NULL,
  `id_tiempo_libre` int(11) DEFAULT NULL,
  `id_cita_ideal` int(11) DEFAULT NULL,
  `id_relacion` int(11) DEFAULT NULL,
  `id_estilo` int(11) DEFAULT NULL,
  `id_motivacion` int(11) DEFAULT NULL,
  `libredescripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `perfiles`:
--   `id_cita_ideal`
--       `citaideal` -> `id_cita_ideal`
--   `idprovincia`
--       `departamentos` -> `iddepa`
--   `iddepa`
--       `departamentos` -> `idprovincia`
--   `id_estilo`
--       `estilosdevida` -> `id_estilo`
--   `idgenero`
--       `generos` -> `idgenero`
--   `id_motivacion`
--       `motivacionesdeldia` -> `id_motivacion`
--   `idorientacion`
--       `orientacionessexuales` -> `idorientacion`
--   `id_relacion`
--       `relacionespersonales` -> `id_relacion`
--   `idsexo`
--       `sexos` -> `idsexo`
--   `id_tiempo_libre`
--       `tiempolibre` -> `id_tiempo_libre`
--   `idusuario`
--       `usuarios` -> `idusuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--
-- Creación: 06-11-2025 a las 13:10:15
--

CREATE TABLE `provincias` (
  `idprovincia` int(11) NOT NULL,
  `provincia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `provincias`:
--

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`idprovincia`, `provincia`) VALUES
(1, 'misiones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionespersonales`
--
-- Creación: 06-11-2025 a las 13:10:15
--

CREATE TABLE `relacionespersonales` (
  `id_relacion` int(11) NOT NULL,
  `descripcion_relacion` varchar(255) DEFAULT NULL,
  `posible_respuesta` varchar(200) DEFAULT NULL,
  `adj_sugeridos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `relacionespersonales`:
--

--
-- Volcado de datos para la tabla `relacionespersonales`
--

INSERT INTO `relacionespersonales` (`id_relacion`, `descripcion_relacion`, `posible_respuesta`, `adj_sugeridos`) VALUES
(1, 'comunicación sincera', 'la conexion emocional y la comunicacion sincera.', 'emocional, sensible, dependiente'),
(2, 'apoyo mutuo', 'el apoyo mutuo, el respeto y sentirse en equipo.', 'firme, solidario/a, estructurado/a'),
(3, 'diversion compartida', 'compartir experiencias y mantener la diverson.', 'entusiasta, inmaduro/a, impulsivo/a'),
(4, 'evitar conflictos', 'la estabilidad y evitar conflictos, aunque a veces eso signifique callar ciertas cosas.', 'evitativo/a, pasivo/a, conformista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexos`
--
-- Creación: 06-11-2025 a las 13:10:16
--

CREATE TABLE `sexos` (
  `idsexo` int(11) NOT NULL,
  `sex` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `sexos`:
--

--
-- Volcado de datos para la tabla `sexos`
--

INSERT INTO `sexos` (`idsexo`, `sex`) VALUES
(1, 'femenino'),
(2, 'masculino'),
(3, 'prefiero no decirlo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiempolibre`
--
-- Creación: 06-11-2025 a las 13:10:16
--

CREATE TABLE `tiempolibre` (
  `id_tiempo_libre` int(11) NOT NULL,
  `actividad` varchar(255) DEFAULT NULL,
  `posible_respuesta` varchar(200) DEFAULT NULL,
  `adj_sugeridos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `tiempolibre`:
--

--
-- Volcado de datos para la tabla `tiempolibre`
--

INSERT INTO `tiempolibre` (`id_tiempo_libre`, `actividad`, `posible_respuesta`, `adj_sugeridos`) VALUES
(1, 'quedarme en casa', 'quedarme en casa descansando, mirando algo o cocinando tranquilo/a.\r\n\r\n', 'casero/a, introvertido/a, tranquilo/a'),
(2, 'salir y socializar', 'salir a ver gente, hacer planes o probar lugares nuevos.', 'extrovertido/a, movido/a, dependiente del entorno\r\n\r\n'),
(3, 'realizar actividad fisica', 'me gusta hacer alguna actividad fisica, practicar algun deporte o entrenar', 'activo/a, disciplinado/a, autoexigente'),
(4, 'desconectarme', 'no tengo muchas ganas de hacer nada; prefiero desconectarme y no pensar demasiado.', 'apatico/a, desganado/a, evitativo/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
-- Creación: 06-11-2025 a las 13:10:16
-- Última actualización: 08-11-2025 a las 02:17:14
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `primer_intento_fallido` datetime DEFAULT NULL,
  `intentos_fallidos` int(11) DEFAULT NULL,
  `estado_usuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `usuarios`:
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citaideal`
--
ALTER TABLE `citaideal`
  ADD PRIMARY KEY (`id_cita_ideal`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`,`perfil1`,`perfil2`),
  ADD KEY `Ref17` (`perfil2`),
  ADD KEY `Ref18` (`perfil1`),
  ADD KEY `Ref1523` (`id_estado`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`iddepa`,`idprovincia`),
  ADD KEY `Ref415` (`idprovincia`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `estilosdevida`
--
ALTER TABLE `estilosdevida`
  ADD PRIMARY KEY (`id_estilo`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`idgenero`);

--
-- Indices de la tabla `motivacionesdeldia`
--
ALTER TABLE `motivacionesdeldia`
  ADD PRIMARY KEY (`id_motivacion`);

--
-- Indices de la tabla `orientacionessexuales`
--
ALTER TABLE `orientacionessexuales`
  ADD PRIMARY KEY (`idorientacion`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`idperfil`),
  ADD KEY `Ref11` (`idusuario`),
  ADD KEY `Ref712` (`idsexo`),
  ADD KEY `Ref813` (`idgenero`),
  ADD KEY `Ref914` (`idorientacion`),
  ADD KEY `Ref1018` (`id_tiempo_libre`),
  ADD KEY `Ref1119` (`id_cita_ideal`),
  ADD KEY `Ref1220` (`id_relacion`),
  ADD KEY `Ref1321` (`id_estilo`),
  ADD KEY `Ref1422` (`id_motivacion`),
  ADD KEY `Ref625` (`idprovincia`,`iddepa`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`idprovincia`);

--
-- Indices de la tabla `relacionespersonales`
--
ALTER TABLE `relacionespersonales`
  ADD PRIMARY KEY (`id_relacion`);

--
-- Indices de la tabla `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`idsexo`);

--
-- Indices de la tabla `tiempolibre`
--
ALTER TABLE `tiempolibre`
  ADD PRIMARY KEY (`id_tiempo_libre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citaideal`
--
ALTER TABLE `citaideal`
  MODIFY `id_cita_ideal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `iddepa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estilosdevida`
--
ALTER TABLE `estilosdevida`
  MODIFY `id_estilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `idgenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `motivacionesdeldia`
--
ALTER TABLE `motivacionesdeldia`
  MODIFY `id_motivacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orientacionessexuales`
--
ALTER TABLE `orientacionessexuales`
  MODIFY `idorientacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `idperfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `idprovincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `relacionespersonales`
--
ALTER TABLE `relacionespersonales`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sexos`
--
ALTER TABLE `sexos`
  MODIFY `idsexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tiempolibre`
--
ALTER TABLE `tiempolibre`
  MODIFY `id_tiempo_libre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `Refestados23` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`),
  ADD CONSTRAINT `Refusuarios7` FOREIGN KEY (`perfil2`) REFERENCES `usuarios` (`idusuario`),
  ADD CONSTRAINT `Refusuarios8` FOREIGN KEY (`perfil1`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `Refprovincias15` FOREIGN KEY (`idprovincia`) REFERENCES `provincias` (`idprovincia`);

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD CONSTRAINT `Refcitaideal19` FOREIGN KEY (`id_cita_ideal`) REFERENCES `citaideal` (`id_cita_ideal`),
  ADD CONSTRAINT `Refdepartamentos25` FOREIGN KEY (`idprovincia`,`iddepa`) REFERENCES `departamentos` (`iddepa`, `idprovincia`),
  ADD CONSTRAINT `Refestilosdevida21` FOREIGN KEY (`id_estilo`) REFERENCES `estilosdevida` (`id_estilo`),
  ADD CONSTRAINT `Refgeneros13` FOREIGN KEY (`idgenero`) REFERENCES `generos` (`idgenero`),
  ADD CONSTRAINT `Refmotivacionesdeldia22` FOREIGN KEY (`id_motivacion`) REFERENCES `motivacionesdeldia` (`id_motivacion`),
  ADD CONSTRAINT `Reforientacionessexuales14` FOREIGN KEY (`idorientacion`) REFERENCES `orientacionessexuales` (`idorientacion`),
  ADD CONSTRAINT `Refrelacionespersonales20` FOREIGN KEY (`id_relacion`) REFERENCES `relacionespersonales` (`id_relacion`),
  ADD CONSTRAINT `Refsexos12` FOREIGN KEY (`idsexo`) REFERENCES `sexos` (`idsexo`),
  ADD CONSTRAINT `Reftiempolibre18` FOREIGN KEY (`id_tiempo_libre`) REFERENCES `tiempolibre` (`id_tiempo_libre`),
  ADD CONSTRAINT `Refusuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
