-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-09-2017 a las 23:36:27
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
  `cod_contable` char(20) NOT NULL COMMENT 'REFERENCIA A PRODUCTOS',
  `nro_cajas` smallint(6) NOT NULL COMMENT 'CAJAS QUE CONFORMAN EL PEDIDO, DE UN SOLO PRODUCTO',
  `costo_und` decimal(6,3) NOT NULL COMMENT 'COSTO POR BOTELLA DE PRODUCTO',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Deatalle de los productos que trae un pedido, se registran los detalles de las facturas de compra de producto';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_informativa`
--

CREATE TABLE `factura_informativa` (
  `id_factura_informativa` mediumint(9) NOT NULL,
  `nro_factura_informativa` char(8) NOT NULL COMMENT '00000000  EL NUMERO DE LA FACTURA PUEDE TENER HASTA 8 DIGITOS',
  `nro_pedido` char(6) NOT NULL COMMENT '000/00 FORMATO NRO DE PEDIDO Y DOS DIGITO ANIO',
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `fele_aduana` decimal(6,3) NOT NULL COMMENT 'ES CALCULADA POR FORMULA',
  `seguro_aduana` decimal(6,3) NOT NULL COMMENT 'ES CALCULADA POR FORMULA',
  `moneda` varchar(45) NOT NULL COMMENT 'MONEDA CON LA QUE SE HIZO LA COMPRA, EL TIPO DE CAMBIO SOLO AFECTA AL CALCULO DE LOS IMPUESTOS, EL TIPO DE CAMBIO INICIAL ES EL FOB A LIQUIDAR',
  `tipo_cambio` decimal(4,3) NOT NULL DEFAULT '1.000' COMMENT 'TIPO DE CAMBIO DE LA MONEDA EN LA EMISION DE LA FACTURA INFORMATIVA',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Se registran los valores de los productos que se va a nacionalizar, aqui se registra\r\nla factura informativa de la bodega publica';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_informativa_detalle`
--

CREATE TABLE `factura_informativa_detalle` (
  `factura_informativa_detalle` mediumint(9) NOT NULL,
  `nro_factura_informativa` char(8) NOT NULL COMMENT '00000000 EL NUMERO DE LA FACTURA PUEDE TENER HASTA 8 DIGITOS',
  `cod_contable` char(20) NOT NULL COMMENT 'REFERENCIA A PRODUCTOS',
  `nro_cajas` smallint(6) NOT NULL COMMENT 'CANTIDAD DE CAJAS A DESADUANIZAR DE UN PRODUCTO',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Se registran los valores de los productos que se va a nacionalizar';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_pagos`
--

CREATE TABLE `factura_pagos` (
  `id_factura_pagos` smallint(6) NOT NULL,
  `identificacion_proveedor` varchar(16) NOT NULL,
  `nro_factura` char(10) NOT NULL,
  `fecha_emision` date NOT NULL,
  `valor` decimal(6,3) NOT NULL,
  `saldo` decimal(6,0) NOT NULL,
  `comentarios` varchar(250) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_pagos_pedido`
--

CREATE TABLE `factura_pagos_pedido` (
  `nro_pedido` char(6) NOT NULL,
  `id_factura_pagos` smallint(6) NOT NULL,
  `valor` decimal(6,3) NOT NULL,
  `concepto` varchar(50) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_pagos_pedido_gasto_inicial_r70`
--

CREATE TABLE `factura_pagos_pedido_gasto_inicial_r70` (
  `id_factura_pagos_pedido_gasto_inicial` smallint(6) NOT NULL,
  `id_gastos_iniciales` mediumint(9) NOT NULL,
  `id_factura_pagos` smallint(6) NOT NULL,
  `valor` decimal(6,3) NOT NULL DEFAULT '0.000',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_pagos_pedido_gasto_nacionalizacion`
--

CREATE TABLE `factura_pagos_pedido_gasto_nacionalizacion` (
  `id_factura_pagos_pedido_gasto_nacionalizacion` smallint(6) NOT NULL,
  `id_gastos_iniciales` mediumint(9) NOT NULL,
  `id_factura_pagos` smallint(6) NOT NULL,
  `valor` decimal(6,3) NOT NULL DEFAULT '0.000',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_iniciales_r70`
--

CREATE TABLE `gastos_iniciales_r70` (
  `id_gastos_iniciales` mediumint(9) NOT NULL,
  `nro_pedido` char(6) NOT NULL,
  `concepto` varchar(45) NOT NULL,
  `valor_provisionado` decimal(6,3) NOT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='LISTADO DE FACTURAS RECIBIDAS POR SERVICIOS DE IMPORTACION TANTO LOS GASTOS INICIALES COMO LOS \r\nPARCIALES';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_nacionalizacion`
--

CREATE TABLE `gastos_nacionalizacion` (
  `id_gastos_nacionalizacion` mediumint(9) NOT NULL,
  `codigo_nacionalizacion` char(9) NOT NULL,
  `concepto` varchar(45) NOT NULL,
  `nro_factura` varchar(20) NOT NULL,
  `valor_provisionado` decimal(6,3) NOT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='LISTADO DE FACTURAS RECIBIDAS POR SERVICIOS DE IMPORTACION TANTO LOS GASTOS INICIALES COMO LOS \r\nPARCIALES';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos_nacionalizacion`
--

CREATE TABLE `impuestos_nacionalizacion` (
  `id_impuestos` smallint(6) NOT NULL,
  `id_nacionalizacion` smallint(6) NOT NULL,
  `concepto` decimal(9,3) NOT NULL,
  `valor_provisionado` decimal(9,3) NOT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Se registran todos los impuestos que existen en una nacionalizacion, solo impuestos de la SENAE';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incoterm_provicion_internacional`
--

CREATE TABLE `incoterm_provicion_internacional` (
  `id_incoterm` mediumint(9) NOT NULL,
  `tipo` enum('GASTO','FLETE') NOT NULL COMMENT 'TIPO DE TARIFA GASTO SE USA PARA GASTOS EN ORIGEN Y FLETE PARA COSTO DE TRANSPORTE INTERNACIONAL',
  `pais` varchar(45) NOT NULL,
  `incoterms` enum('EXW','FCA','FOB','CFR') NOT NULL COMMENT 'TIPO DE INCOTERM QUE SE APLICA',
  `ciudad` varchar(45) NOT NULL,
  `tarifa` float NOT NULL COMMENT 'COSTO DE LAS TARIFAS EN DOLARES',
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de tarifas de incoterms negociaciones en el exterior';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquidacion_impuestos`
--

CREATE TABLE `liquidacion_impuestos` (
  `liquidacion_impuestos` smallint(6) NOT NULL,
  `id_impuestos` smallint(6) NOT NULL,
  `nro_documento` varchar(18) NOT NULL,
  `valor` decimal(6,3) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalizacion`
--

CREATE TABLE `nacionalizacion` (
  `id_nacionalizacion` smallint(6) NOT NULL,
  `codigo_nacionalizacion` char(9) NOT NULL COMMENT 'NRO DE NACIONALIZACION EJEM N001-17',
  `nro_pedido` char(6) NOT NULL COMMENT 'REFERENCIA A PEDIDO',
  `nro_factura_informativa` char(8) NOT NULL COMMENT '00000000  02014403 el numero es en un solo formato',
  `moneda` varchar(45) NOT NULL COMMENT 'ESTE CAMPO SOLO SE USA EN EL REGISTRO DE REGIMEN 10 YA QUE EL 70 LO TRAE EN LA FACTURA INFORMATIVA',
  `tipo_cambio` decimal(4,3) NOT NULL DEFAULT '1.000' COMMENT '	ESTE CAMPO SOLO SE USA EN EL REGISTRO DE REGIMEN 10 YA QUE EL 70 LO TRAE EN LA FACTURA INFORMATIVA',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='detalle de las facturas o pedidos a nacionalizar, se crea un registro en cero en cada \r\ntabla padre para que hacer el cruce cuando se haga un regimen 10 o 70 ';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` mediumint(9) NOT NULL,
  `nro_pedido` char(6) NOT NULL COMMENT '000/00 FORMATO NRO DE PEDIDO Y DOS DIGITO ANIO',
  `regimen` enum('70','10') NOT NULL COMMENT 'REGIMENES DE IMPORTACION R10 NO TIENEN GASTOS INICIALES R70 SI LOS TIENE SOL LOS GASTOS GENERADOS DE PASAR LA MERCADERIA DEL PUERTO A LA AMACENERA TEMPORAL "ALMAGRO"',
  `nro_referendo` char(20) NOT NULL DEFAULT '000-0000-00-00000000',
  `id_incoterm` mediumint(9) NOT NULL,
  `fele_aduana` decimal(6,3) NOT NULL DEFAULT '0.000' COMMENT 'VALOR CALCULADO POR FORMULA DEBE PODERSE EDITAR',
  `seguro_aduana` decimal(6,3) NOT NULL DEFAULT '0.000' COMMENT 'VALOR CALCULADO POR FORMULA DEBE PODERSE EDITAR',
  `estado_pedido` enum('ABIERTO','CERRADO') DEFAULT 'ABIERTO' COMMENT 'INDICA DI EL PEDIDO ESTA CERRADO O NO',
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla que registra un pedido usando las tablas de \nfactura\nproveedor\ntarifa\nincoterms\nproducto\n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_factura`
--

CREATE TABLE `pedido_factura` (
  `id_pedido_factura` mediumint(9) NOT NULL,
  `nro_pedido` char(6) NOT NULL,
  `id_factura_proveedor` char(8) NOT NULL COMMENT 'REFERENCIA A PROVEEDOR',
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `fecha_emision` date NOT NULL COMMENT 'FECHA DE EMISION DE LA FACTURA DE PROVEEDOR',
  `valor` decimal(6,3) DEFAULT '0.000' COMMENT 'NO SE INGRESA SE LO VERIFICA SUMANDO DETALLE FACTURA',
  `moneda` varchar(45) NOT NULL COMMENT 'MONEDA CON LA QUE SE HIZO LA COMPRA, EL TIPO DE CAMBIO SE CONJELA HASTA LIQUIDAR EL FOB',
  `tipo_cambio` decimal(4,3) NOT NULL DEFAULT '1.000' COMMENT 'EL TIPO DE CAMBIO SE CONGELA HASTA LIQUIDAR EL FOB EN DOLARES',
  `vencimiento_pago` date DEFAULT NULL COMMENT 'PLAZO PARA EL PAGO DE LA FACTURA AL PRIVEEDOR INTERNAICONAL',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='listado de facturas de producto que se importa';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` mediumint(9) NOT NULL,
  `cod_contable` char(20) NOT NULL COMMENT 'CODIDO CONTABLEENTREGADO POR SAP 00000000000000000000 20 DIGITOS SOLO NUMEROS',
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `cod_ice` char(39) NOT NULL COMMENT 'ejemplo 3031-53-001982-013-000750-66-101-000029',
  `nombre` varchar(70) NOT NULL,
  `capacidad_ml` smallint(6) NOT NULL COMMENT 'CONTENIDO EN ML DE CADA UNIDAD',
  `cantidad_x_caja` smallint(6) NOT NULL COMMENT 'ES EL NUMERO DE UNIDADES QUE TRAE LA CAJA',
  `grado_alcoholico` float NOT NULL,
  `costo_unidad` decimal(6,3) NOT NULL DEFAULT '0.000' COMMENT 'COSTO DEL PRODUCTO, PARA QUE SIRVA DE REFERENCIA EN LAS TABLAS DE PEDIDOS DERTALLES',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'EL ESTADO INDICA SI SE IMPORTA O NO EL PRODUCTO 1 = SI 0 = NO ',
  `custodia_doble` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'si se importa o ya se ha dejado de importar\n',
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='listado de productos que  se compran en los pedidos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `tipo_provedor` enum('NACIONAL','INTERNACIONAL') NOT NULL COMMENT 'SE REFIERE A NACIONAL O INTERNACIONAL',
  `categoria` varchar(60) NOT NULL,
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'ES UNA IDENTIFICADOR INTERNACIONALES',
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Listado de los proveedores, nacionales e internacionales';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `id_seguimiento` mediumint(9) NOT NULL,
  `tabla` varchar(45) NOT NULL,
  `accion` enum('UPDATE','DELETE') NOT NULL DEFAULT 'UPDATE' COMMENT 'INDICA CUANDO SE REALIZA EL REGISTRO SI AL BORRAR O EDITAR UN REGISTR',
  `datos` varchar(1000) DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Se registran los cambios en las tablas solo las columnas que cambian';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas_impuestos`
--

CREATE TABLE `tarifas_impuestos` (
  `id_tarifas_impuestos` smallint(6) NOT NULL,
  `concepto` varchar(45) NOT NULL,
  `regimen` enum('R10','R70','TODOS') NOT NULL,
  `porcentaje` decimal(9,3) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  `comentarios` varchar(250) DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `valor` decimal(4,3) NOT NULL DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Se registran los porcentajes y los impuestos que existen  o se pagan';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa_provicion_nacional`
--

CREATE TABLE `tarifa_provicion_nacional` (
  `id_tarifa` mediumint(9) NOT NULL,
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `regimen` enum('R70','R10','TODOS') NOT NULL,
  `tipo_provicion` enum('GASTO INICIAL','GASTO NACIONALIZACION') NOT NULL COMMENT 'DEFINE A QUE TIPO DE GASTO SE APLICA LA TARIFA DEL GASTO PROVICIONADO',
  `concepto` varchar(45) NOT NULL COMMENT 'flete_internacional, flete_internacional, ECT',
  `valor` decimal(6,3) NOT NULL COMMENT 'VALOR DEL SERVICIO',
  `porcentaje` decimal(3,2) NOT NULL DEFAULT '0.00',
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Se registran todas las tarifas y costos acordados con los proveedores nacionales';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` smallint(6) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cargo` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(120) NOT NULL,
  `usertype` enum('L1','L2','L3') NOT NULL COMMENT 'L1 Administrador; L2 Ingreso Data; L3 Visualizacion',
  `last_login` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Se registran todos los impuestos que existen en una nacionalizacion, solo impuestos de la SENAE';

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
-- Indices de la tabla `factura_pagos`
--
ALTER TABLE `factura_pagos`
  ADD PRIMARY KEY (`identificacion_proveedor`,`nro_factura`),
  ADD UNIQUE KEY `id_factura_pagos` (`id_factura_pagos`);

--
-- Indices de la tabla `factura_pagos_pedido`
--
ALTER TABLE `factura_pagos_pedido`
  ADD PRIMARY KEY (`nro_pedido`,`id_factura_pagos`,`concepto`),
  ADD KEY `fk_factura_pagos_pedido_1_idx` (`id_factura_pagos`);

--
-- Indices de la tabla `factura_pagos_pedido_gasto_inicial_r70`
--
ALTER TABLE `factura_pagos_pedido_gasto_inicial_r70`
  ADD PRIMARY KEY (`id_gastos_iniciales`,`id_factura_pagos`),
  ADD UNIQUE KEY `id_factura_pagos_pedido_gasto_inicial` (`id_factura_pagos_pedido_gasto_inicial`);

--
-- Indices de la tabla `factura_pagos_pedido_gasto_nacionalizacion`
--
ALTER TABLE `factura_pagos_pedido_gasto_nacionalizacion`
  ADD PRIMARY KEY (`id_gastos_iniciales`,`id_factura_pagos`),
  ADD UNIQUE KEY `id_factura_pagos_pedido_gasto_nacionalizacion` (`id_factura_pagos_pedido_gasto_nacionalizacion`);

--
-- Indices de la tabla `gastos_iniciales_r70`
--
ALTER TABLE `gastos_iniciales_r70`
  ADD PRIMARY KEY (`nro_pedido`,`concepto`),
  ADD UNIQUE KEY `id_gastos_iniciales` (`id_gastos_iniciales`),
  ADD KEY `FK_GASTOS_INICIALES_PEDIDO` (`nro_pedido`);

--
-- Indices de la tabla `gastos_nacionalizacion`
--
ALTER TABLE `gastos_nacionalizacion`
  ADD PRIMARY KEY (`codigo_nacionalizacion`,`concepto`),
  ADD UNIQUE KEY `id_gastos_nacionalizacion` (`id_gastos_nacionalizacion`),
  ADD KEY `FK_GASTOS_NACIONALIZACION_NACIONNALIZACION` (`codigo_nacionalizacion`);

--
-- Indices de la tabla `impuestos_nacionalizacion`
--
ALTER TABLE `impuestos_nacionalizacion`
  ADD PRIMARY KEY (`id_nacionalizacion`,`concepto`),
  ADD UNIQUE KEY `id_impuestos` (`id_impuestos`);

--
-- Indices de la tabla `incoterm_provicion_internacional`
--
ALTER TABLE `incoterm_provicion_internacional`
  ADD PRIMARY KEY (`pais`,`ciudad`,`incoterms`,`tipo`),
  ADD UNIQUE KEY `id_incoterm` (`id_incoterm`);

--
-- Indices de la tabla `liquidacion_impuestos`
--
ALTER TABLE `liquidacion_impuestos`
  ADD PRIMARY KEY (`id_impuestos`,`nro_documento`),
  ADD UNIQUE KEY `liquidacion_impuestos` (`liquidacion_impuestos`);

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
  ADD UNIQUE KEY `id_pedido_factura` (`id_pedido_factura`),
  ADD KEY `FK_PEDIDO_FACTURA_PEDIDO` (`nro_pedido`);

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
  ADD UNIQUE KEY `id_seguimiento` (`id_seguimiento`);

--
-- Indices de la tabla `tarifas_impuestos`
--
ALTER TABLE `tarifas_impuestos`
  ADD PRIMARY KEY (`id_tarifas_impuestos`),
  ADD UNIQUE KEY `id_tarifas_impuestos` (`id_tarifas_impuestos`),
  ADD UNIQUE KEY `concepto` (`concepto`);

--
-- Indices de la tabla `tarifa_provicion_nacional`
--
ALTER TABLE `tarifa_provicion_nacional`
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
-- AUTO_INCREMENT de la tabla `factura_pagos`
--
ALTER TABLE `factura_pagos`
  MODIFY `id_factura_pagos` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gastos_iniciales_r70`
--
ALTER TABLE `gastos_iniciales_r70`
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
-- AUTO_INCREMENT de la tabla `incoterm_provicion_internacional`
--
ALTER TABLE `incoterm_provicion_internacional`
  MODIFY `id_incoterm` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `liquidacion_impuestos`
--
ALTER TABLE `liquidacion_impuestos`
  MODIFY `liquidacion_impuestos` smallint(6) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id_producto` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `id_seguimiento` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `tarifas_impuestos`
--
ALTER TABLE `tarifas_impuestos`
  MODIFY `id_tarifas_impuestos` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `tarifa_provicion_nacional`
--
ALTER TABLE `tarifa_provicion_nacional`
  MODIFY `id_tarifa` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- Filtros para la tabla `factura_pagos`
--
ALTER TABLE `factura_pagos`
  ADD CONSTRAINT `FK_FACTURA_PAGOS_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_pagos_pedido`
--
ALTER TABLE `factura_pagos_pedido`
  ADD CONSTRAINT `FK_FACTURA_PAGOS_PEDIDO_FACTUpAGOS` FOREIGN KEY (`id_factura_pagos`) REFERENCES `factura_pagos` (`id_factura_pagos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_FACT_PAGOS_PEDIDO_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_pagos_pedido_gasto_inicial_r70`
--
ALTER TABLE `factura_pagos_pedido_gasto_inicial_r70`
  ADD CONSTRAINT `FK_PAGOS_PEDIDO_FACTURAG_INI_GASTOS_R70` FOREIGN KEY (`id_gastos_iniciales`) REFERENCES `gastos_iniciales_r70` (`id_gastos_iniciales`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_pagos_pedido_gasto_nacionalizacion`
--
ALTER TABLE `factura_pagos_pedido_gasto_nacionalizacion`
  ADD CONSTRAINT `FK_PAGOS_PEDIDO_FACTURAG_INI_GASTOS_NAC` FOREIGN KEY (`id_gastos_iniciales`) REFERENCES `gastos_iniciales_r70` (`id_gastos_iniciales`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos_iniciales_r70`
--
ALTER TABLE `gastos_iniciales_r70`
  ADD CONSTRAINT `FK_GASTOS_INICIALES_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos_nacionalizacion`
--
ALTER TABLE `gastos_nacionalizacion`
  ADD CONSTRAINT `FK_GASTOS_NACIONALIZACION_NACIONNALIZACION` FOREIGN KEY (`codigo_nacionalizacion`) REFERENCES `nacionalizacion` (`codigo_nacionalizacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `impuestos_nacionalizacion`
--
ALTER TABLE `impuestos_nacionalizacion`
  ADD CONSTRAINT `FK_IMPUESTOS_NACIONALIZACION` FOREIGN KEY (`id_nacionalizacion`) REFERENCES `nacionalizacion` (`id_nacionalizacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `liquidacion_impuestos`
--
ALTER TABLE `liquidacion_impuestos`
  ADD CONSTRAINT `FK_LIQUIDACION_IMPUESTOS_IMPUESTOS_NACIO` FOREIGN KEY (`id_impuestos`) REFERENCES `impuestos_nacionalizacion` (`id_impuestos`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_PEDIDO_FACTURA_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PEDIDO_FACTURA_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_PRODUCTO_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tarifa_provicion_nacional`
--
ALTER TABLE `tarifa_provicion_nacional`
  ADD CONSTRAINT `FK_TARIFAS_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
