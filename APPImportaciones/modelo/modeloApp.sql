/*******************************************************************************
  Copyright 2017 cordovez S.A.
  @autor: Eduardo Villota
  @date: 22-08-2017
  @version 1.0
 
 Introduccion: Datos de prueba modelo inicial

/******************************************************************************/


CREATE SCHEMA `appImport`;
USE `appImport`;
-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-08-2017 a las 18:59:14
-- Versión del servidor: 5.7.19-0ubuntu0.17.04.1
-- Versión de PHP: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appImport`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido_factura`
--

CREATE TABLE `detalle_pedido_factura` (
  `detalle_pedido_factura` mediumint(9) NOT NULL,
  `id_pedido_factura` mediumint(9) NOT NULL,
  `cod_contable` char(20) COLLATE utf8_bin NOT NULL COMMENT 'REFERENCIA A PRODUCTOS',
  `nro_cajas` smallint(6) NOT NULL,
  `costo_und` decimal(6,3) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Deatalle de los productos que trae un pedido, se registran los detalles de las facturas de compra de producto';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_informativa`
--

CREATE TABLE `factura_informativa` (
  `id_factura_informativa` mediumint(9) NOT NULL,
  `nro_factura_informativa` char(8) COLLATE utf8_bin NOT NULL COMMENT '00000000  02014403 el numero es en un solo formato',
  `nro_pedido` char(8) COLLATE utf8_bin NOT NULL COMMENT '000-0000  0001-2017 se reinicia el contador inicial cada anio',
  `fecha_emision` date NOT NULL,
  `identificacion_proveedor` char(13) COLLATE utf8_bin NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `fele_aduana` decimal(6,3) NOT NULL,
  `seguro_aduana` decimal(6,3) NOT NULL,
  `moneda` varchar(45) COLLATE utf8_bin NOT NULL,
  `tipo_cambio` decimal(4,3) NOT NULL DEFAULT '1.000',
  `enviado_comtabilidad` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_envio` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Se registran los valores de los productos que se va a nacionalizar, aqui se registra\r\nla factura informativa de la bodega publica';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_informativa_detalle`
--

CREATE TABLE `factura_informativa_detalle` (
  `factura_informativa_detalle` mediumint(9) NOT NULL,
  `nro_factura_informativa` char(8) COLLATE utf8_bin NOT NULL COMMENT '00000000  02014403 el numero es en un solo formato',
  `cod_contable` char(20) COLLATE utf8_bin NOT NULL COMMENT 'REFERENCIA A PRODUCTOS',
  `nro_cajas` smallint(6) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Se registran los valores de los productos que se va a nacionalizar';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_iniciales`
--

CREATE TABLE `gastos_iniciales` (
  `id_gastos_iniciales` mediumint(9) NOT NULL,
  `nro_pedido` char(8) COLLATE utf8_bin NOT NULL,
  `identificacion_proveedor` char(13) COLLATE utf8_bin NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `concepto` varchar(45) COLLATE utf8_bin NOT NULL,
  `nro_factura` varchar(20) COLLATE utf8_bin NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `valor` decimal(6,3) NOT NULL,
  `enviado_comtabilidad` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_envio` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='LISTADO DE FACTURAS RECIBIDAS POR SERVICIOS DE IMPORTACION TANTO LOS GASTOS INICIALES COMO LOS \r\nPARCIALES';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_nacionalizacion`
--

CREATE TABLE `gastos_nacionalizacion` (
  `id_gastos_nacionalizacion` mediumint(9) NOT NULL,
  `codigo_nacionalizacion` char(9) COLLATE utf8_bin NOT NULL,
  `identificacion_proveedor` char(13) COLLATE utf8_bin NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `concepto` varchar(45) COLLATE utf8_bin NOT NULL,
  `nro_factura` varchar(20) COLLATE utf8_bin NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `valor` decimal(6,3) NOT NULL,
  `enviado_comtabilidad` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_envio` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='LISTADO DE FACTURAS RECIBIDAS POR SERVICIOS DE IMPORTACION TANTO LOS GASTOS INICIALES COMO LOS \r\nPARCIALES';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos_nacionalizacion`
--

CREATE TABLE `impuestos_nacionalizacion` (
  `id_impuestos` smallint(6) NOT NULL,
  `id_nacionalizacion` smallint(6) NOT NULL,
  `concepto` decimal(9,3) NOT NULL,
  `valor` decimal(9,3) NOT NULL,
  `nro_documento` varchar(45) COLLATE utf8_bin NOT NULL,
  `fecha_emision` varchar(45) COLLATE utf8_bin NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Se registran todos los impuestos que existen en una nacionalizacion, solo impuestos de la SENAE';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incoterm`
--

CREATE TABLE `incoterm` (
  `id_incoterm` mediumint(9) NOT NULL,
  `tipo` enum('GASTO','FLETE') COLLATE utf8_bin NOT NULL,
  `pais` varchar(45) COLLATE utf8_bin NOT NULL,
  `incoterms` enum('EXW','FCA','FOB','CFR') CHARACTER SET utf8 NOT NULL,
  `ciudad` varchar(45) COLLATE utf8_bin NOT NULL,
  `tarifa` float NOT NULL COMMENT 'costo en USD de las tarifas',
  `notas` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='tabla de tarifas de incoterms negociaciones en el exterior';


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalizacion`
--

CREATE TABLE `nacionalizacion` (
  `id_nacionalizacion` smallint(6) NOT NULL,
  `codigo_nacionalizacion` char(9) COLLATE utf8_bin NOT NULL COMMENT 'N01-2017',
  `nro_pedido` char(8) COLLATE utf8_bin NOT NULL COMMENT '000-0000  0001-2017 se reinicia el contador inicial cada anio',
  `nro_factura_informativa` char(8) COLLATE utf8_bin NOT NULL COMMENT '00000000  02014403 el numero es en un solo formato',
  `moneda` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'solo para regimen 10',
  `tipo_cambio` decimal(4,3) NOT NULL DEFAULT '1.000' COMMENT 'solo para regimen 10',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='detalle de las facturas o pedidos a nacionalizar, se crea un registro en cero en cada \r\ntabla padre para que hacer el cruce cuando se haga un regimen 10 o 70 ';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` mediumint(9) NOT NULL,
  `nro_pedido` char(8) COLLATE utf8_bin NOT NULL COMMENT '000-0000  0001-2017 se reinicia el contador inicial cada anio',
  `regimen` enum('70','10') COLLATE utf8_bin NOT NULL COMMENT 'Se selecciona un codigo de regimen \n10 no tiene gastos inciales\n70 tiene gastos inciales\n',
  `nro_referendo` char(20) COLLATE utf8_bin NOT NULL DEFAULT '000-0000-00-00000000',
  `id_incoterm` mediumint(9) NOT NULL,
  `guia_bl` varchar(45) COLLATE utf8_bin NOT NULL DEFAULT 'PENDIENTE',
  `peso_kgs` smallint(6) NOT NULL DEFAULT '0',
  `costo_pedido` decimal(6,3) DEFAULT '0.000' COMMENT 'NO SE INGRESA SE LO VERIFICA SUMANDO FACTURAS',
  `fele_aduana` decimal(6,3) NOT NULL DEFAULT '0.000',
  `seguro_aduana` decimal(6,3) NOT NULL DEFAULT '0.000',
  `fele_prepagado` tinyint(1) DEFAULT '0',
  `estado_pedido` enum('ABIERTO','CERRADO') COLLATE utf8_bin DEFAULT 'ABIERTO',
  `tarifa_antes_fob` decimal(6,3) DEFAULT NULL COMMENT 'SI EXISTE ESTE GASTO EL FOB \n \r\n                                                         = (seguro_aduana + flete_aduana + gastos_antes_FOB)',
  `enviado_comtabilidad` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_envio` datetime DEFAULT NULL,
  `notas` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla que registra un pedido usando las tablas de \nfactura\nproveedor\ntarifa\nincoterms\nproducto\n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_factura`
--

CREATE TABLE `pedido_factura` (
  `id_pedido_factura` mediumint(9) NOT NULL,
  `nro_pedido` char(8) COLLATE utf8_bin NOT NULL,
  `id_factura_proveedor` char(8) COLLATE utf8_bin NOT NULL,
  `identificacion_proveedor` char(13) COLLATE utf8_bin NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `fecha_emision` date NOT NULL,
  `valor` decimal(6,3) DEFAULT '0.000' COMMENT 'NO SE INGRESA SE LO VERIFICA SUMANDO DETALLE FACTURA',
  `moneda` varchar(45) COLLATE utf8_bin NOT NULL,
  `tipo_cambio` decimal(4,3) NOT NULL DEFAULT '1.000',
  `enviado_comtabilidad` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_envio` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='listado de facturas de producto que se importa';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` mediumint(9) NOT NULL,
  `cod_contable` char(20) COLLATE utf8_bin NOT NULL COMMENT 'contenido en mililitros de la bebida\n el codigo no tiene espacios ni guiones solo numeros \n ejemplo 01011010040117020750',
  `identificacion_proveedor` char(13) COLLATE utf8_bin NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `cod_ice` char(39) COLLATE utf8_bin NOT NULL COMMENT 'ejemplo 3031-53-001982-013-000750-66-101-000029',
  `nombre` varchar(70) CHARACTER SET utf8 NOT NULL,
  `contenidoml` smallint(6) NOT NULL,
  `unidad` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'como biene el producto, generalmente por caja',
  `cantidad_unidad` smallint(6) NOT NULL COMMENT 'las unidades que trae la caja',
  `grado_alcoholico` float NOT NULL,
  `pais_origen` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Indica si el producto se importa o no',
  `custodia_doble` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'si se importa o ya se ha dejado de importar\n',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='listado de productos que  se compran en los pedidos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_bin NOT NULL,
  `tipo_provedor` enum('NACIONAL','INTERNACIONAL') COLLATE utf8_bin NOT NULL,
  `categoria` varchar(60) COLLATE utf8_bin NOT NULL,
  `identificacion_proveedor` char(13) COLLATE utf8_bin NOT NULL COMMENT 'ES UNA IDENTIFICADOR INTERNACIONALES',
  `notas` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Listado de los proveedores, nacionales e internacionales';


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `id_seguimiento` mediumint(9) NOT NULL,
  `tabla` varchar(45) COLLATE utf8_bin NOT NULL,
  `old_data` varchar(450) COLLATE utf8_bin NOT NULL,
  `new_data` varchar(450) COLLATE utf8_bin NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Se registran los cambios en las tablas solo las columnas que cambian';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas_impuestos`
--

CREATE TABLE `tarifas_impuestos` (
  `id_tarifas_impuestos` smallint(6) NOT NULL,
  `concepto` varchar(45) COLLATE utf8_bin NOT NULL,
  `regimen` enum('R10','R70','TODOS') CHARACTER SET utf8 NOT NULL,
  `porcentaje` decimal(9,3) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8 NOT NULL DEFAULT 'ACTIVO',
  `notas` varchar(240) CHARACTER SET utf8 DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `valor` decimal(4,3) NOT NULL DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Se registran los porcentajes y los impuestos que existen  o se pagan';


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa_nacional`
--

CREATE TABLE `tarifa_nacional` (
  `id_tarifa` mediumint(9) NOT NULL,
  `identificacion_proveedor` char(13) COLLATE utf8_bin NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `regimen` enum('R70','R10','TODOS') COLLATE utf8_bin NOT NULL,
  `concepto` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'flete_internacional, flete_internacional, ECT',
  `valor` decimal(6,3) NOT NULL COMMENT 'VALOR DEL SERVICIO',
  `porcentaje` decimal(3,2) NOT NULL DEFAULT '0.00',
  `notas` varchar(90) COLLATE utf8_bin DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Se registran todas las tarifas y costos acordados con los proveedores nacionales';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` smallint(6) NOT NULL,
  `nombres` varchar(45) COLLATE utf8_bin NOT NULL,
  `email` varchar(45) COLLATE utf8_bin NOT NULL,
  `cargo` varchar(45) COLLATE utf8_bin NOT NULL,
  `username` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(120) COLLATE utf8_bin NOT NULL,
  `usertype` enum('L1','L2','L3') COLLATE utf8_bin NOT NULL COMMENT 'L1 Administrador; L2 Ingreso Data; L3 Visualizacion',
  `last_login` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Se registran todos los impuestos que existen en una nacionalizacion, solo impuestos de la SENAE';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `nombres`, `email`, `cargo`, `username`, `password`, `usertype`, `last_login`, `date_create`, `last_update`) VALUES
(1, 'Eduardo Villota', 'eduardouio7@gmail.com', 'Desarrollador', 'eduardo', 'erdYyo1ERYzIcgXJsjM6bRkmFq5JecqAhJzPmFqMPa8=', 'L1', NULL, '2017-08-23 10:32:39', '2017-08-23 05:32:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedido_factura`
--
ALTER TABLE `detalle_pedido_factura`
  ADD PRIMARY KEY (`id_pedido_factura`,`cod_contable`),
  ADD UNIQUE KEY `detalle_pedido_factura` (`detalle_pedido_factura`),
  ADD KEY `FK_DETALLE_PEDIDO_FACTURA_PRODUCTO` (`cod_contable`);

--
-- Indices de la tabla `factura_informativa`
--
ALTER TABLE `factura_informativa`
  ADD PRIMARY KEY (`nro_factura_informativa`,`nro_pedido`),
  ADD UNIQUE KEY `id_factura_informativa` (`id_factura_informativa`),
  ADD KEY `FK_FACTURA_INFORMATIVA_PEDIDO` (`nro_pedido`),
  ADD KEY `FK_FACTURA_INFORMATIVA_PROVEEDOR` (`identificacion_proveedor`);

--
-- Indices de la tabla `factura_informativa_detalle`
--
ALTER TABLE `factura_informativa_detalle`
  ADD PRIMARY KEY (`nro_factura_informativa`,`cod_contable`),
  ADD UNIQUE KEY `factura_informativa_detalle` (`factura_informativa_detalle`),
  ADD KEY `FK_FAC_INFO_DETALLE_PRODUCTO` (`cod_contable`);

--
-- Indices de la tabla `gastos_iniciales`
--
ALTER TABLE `gastos_iniciales`
  ADD PRIMARY KEY (`nro_factura`,`identificacion_proveedor`),
  ADD UNIQUE KEY `id_gastos_iniciales` (`id_gastos_iniciales`),
  ADD KEY `FK_GASTOS_INICIALES_PEDIDO` (`nro_pedido`),
  ADD KEY `FK_GASTOS_INCIALES_PROVEEDOR` (`identificacion_proveedor`);

--
-- Indices de la tabla `gastos_nacionalizacion`
--
ALTER TABLE `gastos_nacionalizacion`
  ADD PRIMARY KEY (`nro_factura`,`identificacion_proveedor`),
  ADD UNIQUE KEY `id_gastos_nacionalizacion` (`id_gastos_nacionalizacion`),
  ADD KEY `FK_GASTOS_NACIONALIZACIO_PROVEEDOR` (`identificacion_proveedor`),
  ADD KEY `FK_GASTOS_NACIONALIZACION_NACIONNALIZACION` (`codigo_nacionalizacion`);

--
-- Indices de la tabla `impuestos_nacionalizacion`
--
ALTER TABLE `impuestos_nacionalizacion`
  ADD PRIMARY KEY (`id_nacionalizacion`,`concepto`),
  ADD UNIQUE KEY `id_impuestos` (`id_impuestos`);

--
-- Indices de la tabla `incoterm`
--
ALTER TABLE `incoterm`
  ADD PRIMARY KEY (`pais`,`ciudad`,`incoterms`,`tipo`),
  ADD UNIQUE KEY `id_incoterm` (`id_incoterm`);

--
-- Indices de la tabla `nacionalizacion`
--
ALTER TABLE `nacionalizacion`
  ADD PRIMARY KEY (`nro_pedido`,`nro_factura_informativa`),
  ADD UNIQUE KEY `id_nacionalizacion` (`id_nacionalizacion`),
  ADD UNIQUE KEY `codigo_nacionalizacion` (`codigo_nacionalizacion`),
  ADD KEY `FK_NACIONALIZACION_FACTURA_INFORMATIVA` (`nro_factura_informativa`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`nro_pedido`),
  ADD UNIQUE KEY `id_pedido` (`id_pedido`),
  ADD UNIQUE KEY `nro_referendo` (`nro_referendo`);

--
-- Indices de la tabla `pedido_factura`
--
ALTER TABLE `pedido_factura`
  ADD PRIMARY KEY (`identificacion_proveedor`,`id_factura_proveedor`),
  ADD UNIQUE KEY `id_pedido_factura` (`id_pedido_factura`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`cod_contable`),
  ADD UNIQUE KEY `id_producto` (`id_producto`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `FK_PRODUCTO_PROVEEDOR` (`identificacion_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`identificacion_proveedor`),
  ADD UNIQUE KEY `id_proveedor` (`id_proveedor`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD UNIQUE KEY `id_seguimiento` (`id_seguimiento`),
  ADD UNIQUE KEY `tabla` (`tabla`);

--
-- Indices de la tabla `tarifas_impuestos`
--
ALTER TABLE `tarifas_impuestos`
  ADD PRIMARY KEY (`id_tarifas_impuestos`),
  ADD UNIQUE KEY `id_tarifas_impuestos` (`id_tarifas_impuestos`),
  ADD UNIQUE KEY `concepto` (`concepto`);

--
-- Indices de la tabla `tarifa_nacional`
--
ALTER TABLE `tarifa_nacional`
  ADD PRIMARY KEY (`identificacion_proveedor`,`concepto`),
  ADD UNIQUE KEY `id_tarifa` (`id_tarifa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `nombres` (`nombres`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedido_factura`
--
ALTER TABLE `detalle_pedido_factura`
  MODIFY `detalle_pedido_factura` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura_informativa`
--
ALTER TABLE `factura_informativa`
  MODIFY `id_factura_informativa` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura_informativa_detalle`
--
ALTER TABLE `factura_informativa_detalle`
  MODIFY `factura_informativa_detalle` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gastos_iniciales`
--
ALTER TABLE `gastos_iniciales`
  MODIFY `id_gastos_iniciales` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gastos_nacionalizacion`
--
ALTER TABLE `gastos_nacionalizacion`
  MODIFY `id_gastos_nacionalizacion` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `impuestos_nacionalizacion`
--
ALTER TABLE `impuestos_nacionalizacion`
  MODIFY `id_impuestos` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `incoterm`
--
ALTER TABLE `incoterm`
  MODIFY `id_incoterm` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT de la tabla `nacionalizacion`
--
ALTER TABLE `nacionalizacion`
  MODIFY `id_nacionalizacion` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedido_factura`
--
ALTER TABLE `pedido_factura`
  MODIFY `id_pedido_factura` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `id_seguimiento` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tarifas_impuestos`
--
ALTER TABLE `tarifas_impuestos`
  MODIFY `id_tarifas_impuestos` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT de la tabla `tarifa_nacional`
--
ALTER TABLE `tarifa_nacional`
  MODIFY `id_tarifa` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido_factura`
--
ALTER TABLE `detalle_pedido_factura`
  ADD CONSTRAINT `FK_DETALLE_PEDIDO_FACTURA_PEDIDO_FACTURA` FOREIGN KEY (`id_pedido_factura`) REFERENCES `pedido_factura` (`id_pedido_factura`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DETALLE_PEDIDO_FACTURA_PRODUCTO` FOREIGN KEY (`cod_contable`) REFERENCES `producto` (`cod_contable`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_informativa`
--
ALTER TABLE `factura_informativa`
  ADD CONSTRAINT `FK_FACTURA_INFORMATIVA_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_FACTURA_INFORMATIVA_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_informativa_detalle`
--
ALTER TABLE `factura_informativa_detalle`
  ADD CONSTRAINT `FK_FACTURA_INFO_DETALLE_FAC_INFORMATIVA` FOREIGN KEY (`nro_factura_informativa`) REFERENCES `factura_informativa` (`nro_factura_informativa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_FAC_INFO_DETALLE_PRODUCTO` FOREIGN KEY (`cod_contable`) REFERENCES `producto` (`cod_contable`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos_iniciales`
--
ALTER TABLE `gastos_iniciales`
  ADD CONSTRAINT `FK_GASTOS_INCIALES_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_GASTOS_INICIALES_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos_nacionalizacion`
--
ALTER TABLE `gastos_nacionalizacion`
  ADD CONSTRAINT `FK_GASTOS_NACIONALIZACION_NACIONNALIZACION` FOREIGN KEY (`codigo_nacionalizacion`) REFERENCES `nacionalizacion` (`codigo_nacionalizacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_GASTOS_NACIONALIZACIO_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `impuestos_nacionalizacion`
--
ALTER TABLE `impuestos_nacionalizacion`
  ADD CONSTRAINT `FK_IMPUESTOS_NACIONALIZACION` FOREIGN KEY (`id_nacionalizacion`) REFERENCES `nacionalizacion` (`id_nacionalizacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `nacionalizacion`
--
ALTER TABLE `nacionalizacion`
  ADD CONSTRAINT `FK_NACIONALIZACION_FACTURA_INFORMATIVA` FOREIGN KEY (`nro_factura_informativa`) REFERENCES `factura_informativa` (`nro_factura_informativa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NACIONALIZACION_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_factura`
--
ALTER TABLE `pedido_factura`
  ADD CONSTRAINT `FK_PEDIDO_FACTURA_` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_PRODUCTO_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tarifa_nacional`
--
ALTER TABLE `tarifa_nacional`
  ADD CONSTRAINT `FK_TARIFAS_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
