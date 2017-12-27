-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: cordovezApp
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.17.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tarifa_incoterm`
--

DROP TABLE IF EXISTS `tarifa_incoterm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarifa_incoterm` (
  `id_incoterm` mediumint(9) NOT NULL AUTO_INCREMENT,
  `tipo` enum('GASTO ORIGEN','FLETE','CERO') NOT NULL COMMENT 'TIPO DE TARIFA GASTO SE USA PARA GASTOS EN ORIGEN Y FLETE PARA COSTO DE TRANSPORTE INTERNACIONAL',
  `pais` varchar(45) NOT NULL,
  `incoterms` enum('EXW','FCA','FOB','CFR','CERO') NOT NULL COMMENT 'TIPO DE INCOTERM QUE SE APLICA',
  `ciudad` varchar(45) NOT NULL,
  `tarifa` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT 'COSTO DE LAS TARIFAS EN DOLARES',
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  PRIMARY KEY (`pais`,`ciudad`,`incoterms`,`tipo`),
  UNIQUE KEY `id_incoterm` (`id_incoterm`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='tabla de tarifas de incoterms negociaciones en el exterior';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nacionalizacion`
--

DROP TABLE IF EXISTS `nacionalizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nacionalizacion` (
  `id_nacionalizacion` smallint(6) NOT NULL AUTO_INCREMENT,
  `nro_pedido` char(6) NOT NULL COMMENT 'REFERENCIA A PEDIDO',
  `id_factura_informativa` mediumint(9) NOT NULL COMMENT 'se pone el id de factura informativa',
  `moneda` varchar(45) NOT NULL COMMENT 'ESTE CAMPO SOLO SE USA EN EL REGISTRO DE REGIMEN 10 YA QUE EL 70 LO TRAE EN LA FACTURA INFORMATIVA',
  `tipo_cambio` decimal(8,2) NOT NULL DEFAULT '1.00' COMMENT '	ESTE CAMPO SOLO SE USA EN EL REGISTRO DE REGIMEN 10 YA QUE EL 70 LO TRAE EN LA FACTURA INFORMATIVA',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `fecha` date NOT NULL,
  PRIMARY KEY (`nro_pedido`),
  UNIQUE KEY `id_nacionalizacion` (`id_nacionalizacion`),
  KEY `FK_NACIONALIZACION_FACTURA_INFORMATIVA` (`id_factura_informativa`),
  CONSTRAINT `FK_NACIONALIZACION_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE,
  CONSTRAINT `fk_nacionalizacion_factura_informatia` FOREIGN KEY (`id_factura_informativa`) REFERENCES `factura_informativa` (`id_factura_informativa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='detalle de las facturas o pedidos a nacionalizar, se crea un registro en cero en cada \r\ntabla padre para que hacer el cruce cuando se haga un regimen 10 o 70 ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gastos_nacionalizacion`
--

DROP TABLE IF EXISTS `gastos_nacionalizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos_nacionalizacion` (
  `id_gastos_nacionalizacion` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nro_pedido` char(6) NOT NULL,
  `id_nacionalizacion` smallint(6) NOT NULL DEFAULT '0' COMMENT 'EL IDENTIFICADOR DE NACIONALIZACION SE USA PARA QUE SE IDENTIFIQUE SI ES UN GASTO INICIAL O NO, TODOS LOS GASTOS DERIVADOS DE LAS LIQUIDACIONES SE CONCIDERAN COMO FACTURAS DE GASTOS DE NACIONALIZACION DE IGUAL MANERA CON LOS GASTOS INICIALES',
  `identificacion_proveedor` varchar(16) NOT NULL,
  `concepto` varchar(45) NOT NULL,
  `tipo` enum('INICIAL','NACIONALIZACION','LIQUIDACION') DEFAULT 'INICIAL',
  `valor_provisionado` decimal(8,2) NOT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT '1987-09-01',
  `fecha_fin` date DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `bg_closed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indica cuando una provision ya fue justificada',
  PRIMARY KEY (`nro_pedido`,`id_nacionalizacion`,`concepto`) COMMENT 'Esta compuesta de tres columnas para permitr el control de lo siguiente\nnro pedido =0 \n\ncontrola los gastos iniciales, estos gastos no se pueden repetir por la convinacion de los dos restantes\n\nnro pedido != 0\n\nControla los gastos de esa nacionalicacion y sus liquidaciones\n\nPermite varias nacionalizaciones con todos los gastos una sola vez \n',
  UNIQUE KEY `id_gastos_iniciales` (`id_gastos_nacionalizacion`),
  KEY `FK_GASTOS_INICIALES_PEDIDO` (`nro_pedido`),
  KEY `FK_GASTOS_INICIALES_PROVEEDOR_idx` (`identificacion_proveedor`),
  CONSTRAINT `FK_GASTOS_INICIALES_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE,
  CONSTRAINT `FK_GASTOS_INICIALES_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='LISTADO DE FACTURAS RECIBIDAS POR SERVICIOS DE IMPORTACION TANTO LOS GASTOS INICIALES COMO LOS \r\nPARCIALES';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detalle_documento_pago`
--

DROP TABLE IF EXISTS `detalle_documento_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_documento_pago` (
  `id_detalle_documento_pago` mediumint(9) NOT NULL AUTO_INCREMENT,
  `id_gastos_nacionalizacion` mediumint(9) NOT NULL,
  `id_documento_pago` smallint(6) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL,
  `bg_closed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Este campo aydua a controlar que un item de la factura se encuentre agotado, es decir en cero, en caso de que se cierre la factura y quede un remanente se debe crear una nueva provision que justufique, la provision tienen nombres como remaente factura.',
  PRIMARY KEY (`id_documento_pago`,`id_gastos_nacionalizacion`),
  UNIQUE KEY `id_factura_pagos_pedido_UNIQUE` (`id_detalle_documento_pago`),
  KEY `fk_factura_pagos_pedido_1_idx` (`id_documento_pago`),
  KEY `FK_DETALLE_FAC_PAGOS_PROVISIONES_idx` (`id_gastos_nacionalizacion`),
  CONSTRAINT `FK_DETALLE_FAC_PAGOS_PROVISIONES` FOREIGN KEY (`id_gastos_nacionalizacion`) REFERENCES `gastos_nacionalizacion` (`id_gastos_nacionalizacion`) ON UPDATE CASCADE,
  CONSTRAINT `FK_FACTURA_PAGOS_PEDIDO_FACTUpAGOS` FOREIGN KEY (`id_documento_pago`) REFERENCES `documento_pago` (`id_documento_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `seguimiento`
--

DROP TABLE IF EXISTS `seguimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguimiento` (
  `id_seguimiento` mediumint(9) NOT NULL AUTO_INCREMENT,
  `tabla` varchar(45) NOT NULL,
  `accion` enum('UPDATE','DELETE') NOT NULL DEFAULT 'UPDATE' COMMENT 'INDICA CUANDO SE REALIZA EL REGISTRO SI AL BORRAR O EDITAR UN REGISTR',
  `datos` varchar(1000) DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_seguimiento`),
  UNIQUE KEY `id_seguimiento` (`id_seguimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Se registran los cambios en las tablas solo las columnas que cambian';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `factura_informativa_detalle`
--

DROP TABLE IF EXISTS `factura_informativa_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura_informativa_detalle` (
  `id_factura_informativa_detalle` mediumint(9) NOT NULL AUTO_INCREMENT,
  `id_factura_informativa` mediumint(9) NOT NULL,
  `cod_contable` char(20) NOT NULL COMMENT 'REFERENCIA A PRODUCTOS',
  `grado_alcoholico` float NOT NULL,
  `nro_cajas` smallint(6) NOT NULL COMMENT 'CANTIDAD DE CAJAS A DESADUANIZAR DE UN PRODUCTO',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `costo_caja` decimal(16,10) NOT NULL DEFAULT '0.0000000000',
  PRIMARY KEY (`id_factura_informativa`,`cod_contable`),
  UNIQUE KEY `factura_informativa_detalle` (`id_factura_informativa_detalle`),
  KEY `FK_FAC_INFO_DETALLE_PRODUCTO` (`cod_contable`),
  CONSTRAINT `FK_FACTURA_INFO_DETALLE_FAC_INFORMATIVA` FOREIGN KEY (`id_factura_informativa`) REFERENCES `factura_informativa` (`id_factura_informativa`) ON UPDATE CASCADE,
  CONSTRAINT `FK_FAC_INFO_DETALLE_PRODUCTO` FOREIGN KEY (`cod_contable`) REFERENCES `producto` (`cod_contable`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Se registran los valores de los productos que se va a nacionalizar';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tarifa_gastos`
--

DROP TABLE IF EXISTS `tarifa_gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarifa_gastos` (
  `id_tarifa_gastos` mediumint(9) NOT NULL AUTO_INCREMENT,
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `regimen` enum('R70','R10','TODOS') NOT NULL COMMENT 'regimen en el que se aplica el tipo de gasto inicial',
  `tipo_gasto` enum('GASTO INICIAL','GASTO NACIONALIZACION') NOT NULL COMMENT 'DEFINE EL TIPO DE TARIA SI ES PARA GASTO INICIAL O GASTO NACIONALIZACION',
  `concepto` varchar(120) NOT NULL COMMENT 'flete_internacional, flete_internacional, ECT',
  `valor` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT 'VALOR DEL SERVICIO',
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `pais_origen` varchar(45) NOT NULL DEFAULT 'ECUADOR',
  `porcentaje` decimal(7,4) NOT NULL DEFAULT '0.0000',
  `comentarios` varchar(250) DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`identificacion_proveedor`,`concepto`,`pais_origen`,`valor`),
  UNIQUE KEY `id_tarifa` (`id_tarifa_gastos`),
  CONSTRAINT `FK_TARIFAS_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Se registran todas las tarifas y costos acordados con los proveedores nacionales';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `tipo_provedor` enum('NACIONAL','INTERNACIONAL') NOT NULL COMMENT 'SE REFIERE A NACIONAL O INTERNACIONAL',
  `categoria` varchar(250) NOT NULL COMMENT 'Categoria soporta valores separados por coma, con cada una de las categorias',
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'ES UNA IDENTIFICADOR INTERNACIONALES',
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  PRIMARY KEY (`identificacion_proveedor`),
  UNIQUE KEY `id_proveedor` (`id_proveedor`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Listado de los proveedores, nacionales e internacionales';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documento_pago`
--

DROP TABLE IF EXISTS `documento_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_pago` (
  `id_documento_pago` smallint(6) NOT NULL AUTO_INCREMENT,
  `identificacion_proveedor` varchar(16) NOT NULL,
  `nro_factura` varchar(20) NOT NULL,
  `fecha_emision` date NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `comentarios` varchar(250) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bg_closed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indica que la factura se encuentra justificada en todos sus items',
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL,
  `tipo` enum('SERVICIO','PRODUCTO') NOT NULL DEFAULT 'SERVICIO',
  PRIMARY KEY (`identificacion_proveedor`,`nro_factura`),
  UNIQUE KEY `id_factura_pagos` (`id_documento_pago`),
  CONSTRAINT `FK_FACTURA_PAGOS_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id_producto` mediumint(9) NOT NULL AUTO_INCREMENT,
  `cod_contable` char(20) NOT NULL COMMENT 'CODIDO CONTABLEENTREGADO POR SAP 00000000000000000000 20 DIGITOS SOLO NUMEROS',
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `cod_ice` char(39) NOT NULL COMMENT 'ejemplo 3031-53-001982-013-000750-66-101-000029',
  `nombre` varchar(70) NOT NULL,
  `capacidad_ml` smallint(6) NOT NULL COMMENT 'CONTENIDO EN ML DE CADA UNIDAD',
  `cantidad_x_caja` smallint(6) NOT NULL COMMENT 'ES EL NUMERO DE UNIDADES QUE TRAE LA CAJA',
  `grado_alcoholico` float NOT NULL,
  `costo_caja` decimal(16,10) NOT NULL DEFAULT '0.0000000000' COMMENT 'COSTO DEL PRODUCTO, PARA QUE SIRVA DE REFERENCIA EN LAS TABLAS DE PEDIDOS DERTALLES',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'EL ESTADO INDICA SI SE IMPORTA O NO EL PRODUCTO 1 = SI 0 = NO ',
  `custodia_doble` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'si se importa o ya se ha dejado de importar\n',
  `comentarios` varchar(250) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  PRIMARY KEY (`cod_contable`),
  UNIQUE KEY `id_producto` (`id_producto`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `FK_PRODUCTO_PROVEEDOR` (`identificacion_proveedor`),
  CONSTRAINT `FK_PRODUCTO_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='listado de productos que  se compran en los pedidos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `id_pedido` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nro_pedido` char(6) NOT NULL COMMENT '000/00 FORMATO NRO DE PEDIDO Y DOS DIGITO ANIO',
  `regimen` enum('70','10') NOT NULL COMMENT 'REGIMENES DE IMPORTACION R10 NO TIENEN GASTOS INICIALES R70 SI LOS TIENE SOL LOS GASTOS GENERADOS DE PASAR LA MERCADERIA DEL PUERTO A LA AMACENERA TEMPORAL "ALMAGRO"',
  `incoterm` varchar(4) NOT NULL DEFAULT '0000' COMMENT 'nombre del incoterm que se va a usar',
  `pais_origen` varchar(45) DEFAULT NULL,
  `ciudad_origen` varchar(45) DEFAULT NULL,
  `fecha_arribo` date DEFAULT NULL,
  `fecha_salida_bodega_puerto` date DEFAULT NULL COMMENT 'sirve para el calvulo del demoraje inicial',
  `fecha_ingreso_almacenera` date DEFAULT NULL,
  `fecha_salida_almacenera` date DEFAULT NULL,
  `dias_libres` smallint(6) NOT NULL DEFAULT '0',
  `comentarios` varchar(250) DEFAULT NULL,
  `nro_refrendo` varchar(20) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `bg_isclosed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indica si el pedido ya fue cerrado, si es asi no se pueden hacer cambios en el mismo',
  `bg_haveExpenses` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indica si la tabla tiene ya generados y cerrados\nlos gastos iniciales una vez cerrados los gastos iniciales no se pueden modificar',
  PRIMARY KEY (`nro_pedido`),
  UNIQUE KEY `id_pedido` (`id_pedido`),
  KEY `orderPedido` (`nro_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Tabla que registra un pedido usando las tablas de \nfactura\nproveedor\ntarifa\nincoterms\nproducto\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pedido_factura`
--

DROP TABLE IF EXISTS `pedido_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido_factura` (
  `id_pedido_factura` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nro_pedido` char(6) NOT NULL,
  `id_factura_proveedor` char(16) NOT NULL COMMENT 'NUMERO DE FACTURA EMITIDA POR EL PROVEEDOR',
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `fecha_emision` date NOT NULL COMMENT 'FECHA DE EMISION DE LA FACTURA DE PROVEEDOR',
  `valor` decimal(8,2) DEFAULT '0.00' COMMENT 'NO SE INGRESA SE LO VERIFICA SUMANDO DETALLE FACTURA',
  `moneda` varchar(45) NOT NULL COMMENT 'MONEDA CON LA QUE SE HIZO LA COMPRA, EL TIPO DE CAMBIO SE CONJELA HASTA LIQUIDAR EL FOB',
  `tipo_cambio` decimal(16,12) NOT NULL DEFAULT '1.000000000000' COMMENT 'EL TIPO DE CAMBIO SE CONGELA HASTA LIQUIDAR EL FOB EN DOLARES',
  `vencimiento_pago` date DEFAULT NULL COMMENT 'PLAZO PARA EL PAGO DE LA FACTURA AL PRIVEEDOR INTERNAICONAL',
  `fecha_pago` date DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  PRIMARY KEY (`identificacion_proveedor`,`id_factura_proveedor`),
  UNIQUE KEY `id_pedido_factura` (`id_pedido_factura`),
  KEY `FK_PEDIDO_FACTURA_PEDIDO` (`nro_pedido`),
  CONSTRAINT `FK_PEDIDO_FACTURA_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PEDIDO_FACTURA_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='listado de facturas de producto que se importa';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_user` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cargo` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(120) NOT NULL,
  `usertype` enum('L1','L2','L3') NOT NULL COMMENT 'L1 Administrador; L2 Ingreso Data; L3 Visualizacion',
  `last_login` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `nombres` (`nombres`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Se registran todos los impuestos que existen en una nacionalizacion, solo impuestos de la SENAE';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `factura_informativa`
--

DROP TABLE IF EXISTS `factura_informativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura_informativa` (
  `id_factura_informativa` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nro_factura_informativa` char(8) NOT NULL COMMENT '00000000  EL NUMERO DE LA FACTURA PUEDE TENER HASTA 8 DIGITOS',
  `nro_pedido` char(6) NOT NULL COMMENT '000/00 FORMATO NRO DE PEDIDO Y DOS DIGITO ANIO',
  `identificacion_proveedor` varchar(16) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `fecha_emision` date NOT NULL,
  `flete_aduana` decimal(8,2) NOT NULL COMMENT 'ES CALCULADA POR FORMULA',
  `seguro_aduana` decimal(8,2) NOT NULL COMMENT 'ES CALCULADA POR FORMULA',
  `valor` decimal(8,2) DEFAULT '0.00',
  `moneda` varchar(45) NOT NULL DEFAULT 'DOLARES',
  `nro_refrendo` varchar(17) DEFAULT NULL,
  `tipo_cambio` decimal(16,12) NOT NULL DEFAULT '1.000000000000',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `comentarios` varchar(250) DEFAULT NULL,
  `bg_isclosed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nro_factura_informativa`,`nro_pedido`),
  UNIQUE KEY `id_factura_informativa` (`id_factura_informativa`),
  KEY `FK_FACTURA_INFORMATIVA_PEDIDO` (`nro_pedido`),
  KEY `FK_FACTURA_INFORMATIVA_PROVEEDOR` (`identificacion_proveedor`),
  CONSTRAINT `FK_FACTURA_INFORMATIVA_PEDIDO` FOREIGN KEY (`nro_pedido`) REFERENCES `pedido` (`nro_pedido`) ON UPDATE CASCADE,
  CONSTRAINT `FK_FACTURA_INFORMATIVA_PROVEEDOR` FOREIGN KEY (`identificacion_proveedor`) REFERENCES `proveedor` (`identificacion_proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Se registran los valores de los productos que se va a nacionalizar, aqui se registra\r\nla factura informativa de la bodega publica';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nacionalizacion_factura_informativa`
--

DROP TABLE IF EXISTS `nacionalizacion_factura_informativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nacionalizacion_factura_informativa` (
  `id_nacionalizacion_factura_informativa` smallint(6) NOT NULL,
  `id_factura_informativa` mediumint(6) NOT NULL,
  `id_nacionalizacion` smallint(6) NOT NULL,
  PRIMARY KEY (`id_factura_informativa`,`id_nacionalizacion`),
  UNIQUE KEY `id_nacionalizacion_factura_informativa_UNIQUE` (`id_nacionalizacion_factura_informativa`),
  KEY `fk_nacionalizacion_factura_informativa_1_idx` (`id_nacionalizacion`),
  CONSTRAINT `fk_nacionalizacion_factura_informativa_1` FOREIGN KEY (`id_nacionalizacion`) REFERENCES `nacionalizacion` (`id_nacionalizacion`) ON UPDATE CASCADE,
  CONSTRAINT `fk_nacionalizacion_factura_informativa_2` FOREIGN KEY (`id_factura_informativa`) REFERENCES `factura_informativa` (`id_factura_informativa`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detalle_pedido_factura`
--

DROP TABLE IF EXISTS `detalle_pedido_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_pedido_factura` (
  `detalle_pedido_factura` mediumint(9) NOT NULL AUTO_INCREMENT,
  `id_pedido_factura` mediumint(9) NOT NULL,
  `cod_contable` char(20) NOT NULL COMMENT 'REFERENCIA A PRODUCTOS',
  `grado_alcoholico` float NOT NULL,
  `nro_cajas` smallint(6) NOT NULL COMMENT 'CAJAS QUE CONFORMAN EL PEDIDO, DE UN SOLO PRODUCTO',
  `costo_caja` decimal(16,10) NOT NULL COMMENT 'El costo por cada caja de producto, se cambia del original que lo tiene por produto la depencia a la tabla de producto nos es aceptable',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `id_user` smallint(6) NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  PRIMARY KEY (`id_pedido_factura`,`cod_contable`,`grado_alcoholico`),
  UNIQUE KEY `detalle_pedido_factura` (`detalle_pedido_factura`),
  KEY `FK_DETALLE_PEDIDO_FACTURA_PRODUCTO` (`cod_contable`),
  CONSTRAINT `FK_DETALLE_PEDIDO_FACTURA_PEDIDO_FACTURA` FOREIGN KEY (`id_pedido_factura`) REFERENCES `pedido_factura` (`id_pedido_factura`) ON UPDATE CASCADE,
  CONSTRAINT `FK_DETALLE_PEDIDO_FACTURA_PRODUCTO` FOREIGN KEY (`cod_contable`) REFERENCES `producto` (`cod_contable`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Deatalle de los productos que trae un pedido, se registran los detalles de las facturas de compra de producto';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-20  4:06:15
