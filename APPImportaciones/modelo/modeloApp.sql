-- -----------------------------------------------------------------------------
-- Base de datos Cordovez APP
-- -----------------------------------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `appImport` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;

USE `appImport` ;

-- -----------------------------------------------------------------------------
-- TABLA PROVEEDOR
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `appImport`.`proveedor` (
  `id_proveedor` INT NOT NULL UNIQUE AUTO_INCREMENT,
  `nombre` VARCHAR(60) NOT NULL UNIQUE,
  `tipo_provedor` ENUM('NACIONAL', 'INTERNACIONAL') NOT NULL,
  `categoria` VARCHAR(60) NOT NULL,
  `identificacion_proveedor` CHAR(13) NOT NULL  COMMENT 'ES UNA IDENTIFICADOR INTERNACIONALES',
  `notas` VARCHAR(250) DEFAULT NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
    
    PRIMARY KEY (`identificacion_proveedor`)
    )
ENGINE = InnoDb
COMMENT = 'Listado de los proveedores, nacionales e internacionales';


-- -----------------------------------------------------------------------------
-- TABLA PRODUCTOS
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `appImport`.`producto` (
  `id_producto` MEDIUMINT NULL AUTO_INCREMENT UNIQUE,
  `cod_contable` CHAR(20) NOT NULL COMMENT 'contenido en mililitros de la bebida\n el codigo no tiene espacios ni guiones solo numeros \n ejemplo 01011010040117020750',
  `identificacion_proveedor` CHAR(13) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `cod_ice` CHAR(39) NOT NULL COMMENT 'ejemplo 3031-53-001982-013-000750-66-101-000029',
  `nombre` VARCHAR(60) NOT NULL UNIQUE,
  `contenidoml` SMALLINT NOT NULL,
  `unidad` VARCHAR(45) NOT NULL COMMENT 'como biene el producto, generalmente por caja',
  `cantidad_unidad` VARCHAR(45) NOT NULL COMMENT 'las unidades que trae la caja',
  `grado_alcoholico` DECIMAL(3,2) NOT NULL,
  `pais_origen` VARCHAR(45) NULL,
  `custodia_doble` ENUM('ACTIVO','INACTIVO') NOT NULL COMMENT 'Indica si el producto se importa o no',
  `estado` VARCHAR(45) NULL COMMENT 'si se importa o ya se ha dejado de importar\n',
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  
  PRIMARY KEY (`cod_contable`),

  CONSTRAINT `FK_PRODUCTO_PROVEEDOR`
  FOREIGN KEY (`identificacion_proveedor`) REFERENCES `appImport`.`proveedor`(`identificacion_proveedor`)
  ON UPDATE CASCADE  
  ON DELETE RESTRICT  
  )
ENGINE = InnoDB
COMMENT = 'listado de productos que  se compran en los pedidos';


-- -----------------------------------------------------------------------------
-- TABLA INCOTERMS <TABLA INDEPENDIENTE>
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `appImport`.`incoterm` (
  `id_incoterm` MEDIUMINT NOT NULL UNIQUE AUTO_INCREMENT,
  `tipo` ENUM('GASTO','FLETE') NOT NULL,
  `pais` VARCHAR(45) NOT NULL,
  `incoterms` ENUM('EW','FCA','FOB','CFR') NOT NULL,
  `ciudad` VARCHAR(45) NOT NULL,
  `tarifa` DECIMAL(6,3) NOT NULL COMMENT 'costo en USD de las tarifas',
  `notas` VARCHAR(45) NULL DEFAULT NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',

  PRIMARY KEY (`pais`, `ciudad`, `incoterms`,`tipo`)
  )
ENGINE = InnoDB
COMMENT = 'tabla de tarifas de incoterms negociaciones en el exterior';



-- -----------------------------------------------------------------------------
-- TABLA PEDIDOS
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `appImport`.`pedido` (
  `id_pedido` MEDIUMINT NOT NULL UNIQUE AUTO_INCREMENT,
  `nro_pedido` CHAR(8) NOT NULL COMMENT '000-0000  0001-2017 se reinicia el contador inicial cada anio',
  `regimen` ENUM('70', '10') NOT NULL COMMENT 'Se selecciona un codigo de regimen \n10 no tiene gastos inciales\n70 tiene gastos inciales\n',
  `nro_referendo` CHAR(20) NOT NULL UNIQUE DEFAULT '000-0000-00-00000000',
  `id_incoterm` MEDIUMINT NOT NULL,
  `guia_bl` VARCHAR(45) NOT NULL DEFAULT 'PENDIENTE',
  `costo_pedido` DECIMAL(6,3) DEFAULT 0.0 COMMENT 'NO SE INGRESA SE LO VERIFICA SUMANDO FACTURAS',
  `fele_aduana` DECIMAL(6,3) NOT NULL DEFAULT 0.0,
  `seguro_aduana` DECIMAL(6,3) NOT NULL DEFAULT 0.0,
  `fele_prepagado` TINYINT(1) DEFAULT 0,
  `estado_pedido` ENUM('ABIERTO', 'CERRADO') DEFAULT 'ABIERTO',
  `tarifa_antes_fob` DECIMAL(6,3) DEFAULT NULL COMMENT 'SI EXISTE ESTE GASTO EL FOB \n 
                                                         = (seguro_aduana + flete_aduana + gastos_antes_FOB)',
  `enviado_comtabilidad` TINYINT(1) NOT NULL DEFAULT 0,
  `fecha_envio` DATETIME DEFAULT NULL,
  `notas` VARCHAR(45) NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',

  PRIMARY KEY(`nro_pedido`)

  )
ENGINE = InnoDB
COMMENT = 'Tabla que registra un pedido usando las tablas de \nfactura\nproveedor\ntarifa\nincoterms\nproducto\n';

-- -----------------------------------------------------------------------------
-- TABLA DETALLE PEDIDO FACTURA PROVEEDOR
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `appImport`.`pedido_factura` (
  `id_pedido_factura` MEDIUMINT NOT NULL AUTO_INCREMENT UNIQUE,
  `nro_pedido` CHAR(8) NOT NULL,
  `id_factura_proveedor` CHAR(8) NOT NULL,
  `identificacion_proveedor` CHAR(13) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `fecha_emision` DATE NOT NULL,
  `valor` DECIMAL(6,3) DEFAULT 0.0 COMMENT 'NO SE INGRESA SE LO VERIFICA SUMANDO DETALLE FACTURA',
  `moneda` VARCHAR(45) NOT NULL,
  `tipo_cambio` DECIMAL(4,3) NOT NULL DEFAULT 1,
  `enviado_comtabilidad` TINYINT(1) NOT NULL DEFAULT 0,
  `fecha_envio` DATETIME DEFAULT NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  PRIMARY KEY (`identificacion_proveedor`, `id_factura_proveedor`),
  
  CONSTRAINT `FK_PEDIDO_FACTURA_`
  FOREIGN KEY (`identificacion_proveedor`) REFERENCES `appImport`.`proveedor`(`identificacion_proveedor`)
  ON UPDATE CASCADE ON DELETE RESTRICT
     )
ENGINE = InnoDB
COMMENT = 'listado de facturas de producto que se importa';

-- -----------------------------------------------------------------------------
-- TABLA DETALLE PEDIDO FACTURA
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `appImport`.`detalle_pedido_factura` (
  `detalle_pedido_factura` MEDIUMINT NOT NULL AUTO_INCREMENT UNIQUE,
  `id_pedido_factura` MEDIUMINT NOT NULL,
  `cod_contable` CHAR(20) NOT NULL COMMENT 'REFERENCIA A PRODUCTOS',
  `nro_cajas` SMALLINT NOT NULL,
  `costo_und` DECIMAL(6,3) NOT NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  PRIMARY KEY(`id_pedido_factura`, `cod_contable`),
  CONSTRAINT `FK_DETALLE_PEDIDO_FACTURA_PEDIDO_FACTURA`
  FOREIGN KEY (`id_pedido_factura`) REFERENCES `appImport`.`pedido_factura`(`id_pedido_factura`)
  ON UPDATE CASCADE ON DELETE RESTRICT,  
  CONSTRAINT `FK_DETALLE_PEDIDO_FACTURA_PRODUCTO`
  FOREIGN KEY (`cod_contable`) REFERENCES `appImport`.`producto`(`cod_contable`)
  ON UPDATE CASCADE ON DELETE RESTRICT
   )
ENGINE = InnoDB
COMMENT = 'Deatalle de los productos que trae un pedido, se registran los detalles de las facturas de compra de producto';


-- -----------------------------------------------------------------------------
-- TARIFAS DE COSTOS
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `appImport`.`tarifas` (
  `id_tarifa` MEDIUMINT NOT NULL AUTO_INCREMENT UNIQUE,
  `identificacion_proveedor` CHAR(13) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
  `concepto` VARCHAR(45) NOT NULL COMMENT 'flete_internacional, flete_internacional, ECT',
  `tipo` ENUM('GASTOS INICIALES', 'GASTOS NACIONALIZACION '),
  `valor` DECIMAL(6,3) NOT NULL COMMENT 'VALOR DEL SERVICIO',
  `notas` VARCHAR(45) NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  PRIMARY KEY (`identificacion_proveedor`, `concepto`),
  
    CONSTRAINT `FK_TARIFAS_PROVEEDOR`
    FOREIGN KEY (`identificacion_proveedor`) REFERENCES `appImport`.`proveedor`(`identificacion_proveedor`)
    ON UPDATE CASCADE ON DELETE RESTRICT
  )
ENGINE = InnoDB
COMMENT = 'Se registran todas las tarifas y costos acordados con los proveedores nacionales';




-- -----------------------------------------------------------------------------
-- TARIFAS DE DETALLE DE LA NACIONALIZACION DETALLE DEL PARCIAL
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `appImport`.`factura_informativa` (
  `id_factura_informativa` MEDIUMINT NOT NULL AUTO_INCREMENT UNIQUE,
  `nro_factura_informativa` CHAR(8) NOT NULL COMMENT '00000000  02014403 el numero es en un solo formato',
  `nro_pedido` CHAR(8) NOT NULL COMMENT '000-0000  0001-2017 se reinicia el contador inicial cada anio',
  `fecha_emision` DATE NOT NULL,
  `identificacion_proveedor` CHAR(13) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',  
  `fele_aduana` DECIMAL(6,3) NOT NULL,
  `seguro_aduana` DECIMAL(6,3) NOT NULL,
  `moneda` VARCHAR(45) NOT NULL,
  `tipo_cambio` DECIMAL(4,3) NOT NULL DEFAULT 1,
  `enviado_comtabilidad` TINYINT(1) NOT NULL DEFAULT 0,
  `fecha_envio` DATETIME DEFAULT NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',

  PRIMARY KEY (`nro_factura_informativa`, `nro_pedido`),

  CONSTRAINT `FK_FACTURA_INFORMATIVA_PEDIDO`
  FOREIGN KEY (`nro_pedido`) REFERENCES `appImport`.`pedido`(`nro_pedido`)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  
  CONSTRAINT `FK_FACTURA_INFORMATIVA_PROVEEDOR`
  FOREIGN KEY (`identificacion_proveedor`) REFERENCES `appImport`.`proveedor`(`identificacion_proveedor`)
  ON UPDATE CASCADE ON DELETE RESTRICT
  )
  ENGINE = InnoDB
COMMENT = 'Se registran los valores de los productos que se va a nacionalizar, aqui se registra
la factura informativa de la bodega publica';


-- -----------------------------------------------------------------------------
-- TARIFAS DE DETALLE DE LOS PRODUCTOS QUE SE NACIONALIZAN R70
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `appImport`.`factura_informativa_detalle` (
  `factura_informativa_detalle` MEDIUMINT NOT NULL AUTO_INCREMENT UNIQUE,
  `nro_factura_informativa` CHAR(8) NOT NULL COMMENT '00000000  02014403 el numero es en un solo formato',
  `cod_contable` CHAR(20) NOT NULL COMMENT 'REFERENCIA A PRODUCTOS',
  `nro_cajas` SMALLINT NOT NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',

  PRIMARY KEY(`nro_factura_informativa`, `cod_contable`),

  CONSTRAINT `FK_FACTURA_INFO_DETALLE_FAC_INFORMATIVA`
  FOREIGN KEY (`nro_factura_informativa`) REFERENCES `appImport`.`factura_informativa`(`nro_factura_informativa`)
  ON UPDATE CASCADE ON DELETE RESTRICT,  

  CONSTRAINT `FK_FAC_INFO_DETALLE_PRODUCTO`
  FOREIGN KEY (`cod_contable`) REFERENCES `appImport`.`producto`(`cod_contable`)
  ON UPDATE CASCADE ON DELETE RESTRICT

  )
  ENGINE = InnoDB
COMMENT = 'Se registran los valores de los productos que se va a nacionalizar';



-- -----------------------------------------------------------------------------
-- nacionalizacion las facturas que se nacionalizan
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `appImport`.`nacionalizacion` (
  `id_nacionalizacion` SMALLINT NOT NULL AUTO_INCREMENT UNIQUE,
  `codigo_nacionalizacion` CHAR(9) NOT NULL COMMENT 'N01-2017' UNIQUE,
  `nro_pedido` CHAR(8) NOT NULL COMMENT '000-0000  0001-2017 se reinicia el contador inicial cada anio',
  `nro_factura_informativa` CHAR(8) NOT NULL COMMENT '00000000  02014403 el numero es en un solo formato',
  `moneda` VARCHAR(45) NOT NULL COMMENT 'solo para regimen 10',
  `tipo_cambio` DECIMAL(4,3) NOT NULL DEFAULT 1 COMMENT 'solo para regimen 10',
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  
  PRIMARY KEY (`nro_pedido`, `nro_factura_informativa` ),

  CONSTRAINT `FK_NACIONALIZACION_PEDIDO` 
  FOREIGN KEY (`nro_pedido`) REFERENCES `appImport`.`pedido`(`nro_pedido`)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  
  CONSTRAINT `FK_NACIONALIZACION_FACTURA_INFORMATIVA`
  FOREIGN KEY (`nro_factura_informativa`) REFERENCES `appImport`.`factura_informativa`(`nro_factura_informativa`)
  ON UPDATE CASCADE ON DELETE RESTRICT
)
  ENGINE = InnoDB
COMMENT = 'detalle de las facturas o pedidos a nacionalizar, se crea un registro en cero en cada 
tabla padre para que hacer el cruce cuando se haga un regimen 10 o 70 ';


-- -----------------------------------------------------------------------------
-- TABLA DE GASTOS DEL PARCIAL
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `appImport`.`gastos_nacionalizacion` (
    `id_gastos_nacionalizacion` MEDIUMINT NOT NULL AUTO_INCREMENT UNIQUE,
    `codigo_nacionalizacion` CHAR(9) NOT NULL,
    `identificacion_proveedor` CHAR(13) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
    `concepto` VARCHAR(45) NOT NULL,
    `nro_factura` VARCHAR(20) NOT NULL,
    `fecha_emision` DATE NOT NULL,
    `fecha_inicio` DATE DEFAULT NULL,
    `fecha_fin` DATE DEFAULT NULL,
    `valor` DECIMAL(6,3) NOT NULL,
    `enviado_comtabilidad` TINYINT(1) NOT NULL DEFAULT 0,
    `fecha_envio` DATETIME DEFAULT NULL,
    `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_update` DATETIME NOT NULL,
    `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
    PRIMARY KEY(`nro_factura`, `identificacion_proveedor`),

    CONSTRAINT `FK_GASTOS_NACIONALIZACIO_PROVEEDOR`
    FOREIGN KEY (`identificacion_proveedor`) REFERENCES `appImport`.`proveedor`(`identificacion_proveedor`)
    ON UPDATE CASCADE ON DELETE RESTRICT,

    CONSTRAINT `FK_GASTOS_NACIONALIZACION_NACIONNALIZACION`
    FOREIGN KEY(`codigo_nacionalizacion`) REFERENCES `appImport`.`nacionalizacion`(`codigo_nacionalizacion`)
    ON UPDATE CASCADE ON DELETE RESTRICT

  )
  ENGINE = InnoDB
COMMENT = 'LISTADO DE FACTURAS RECIBIDAS POR SERVICIOS DE IMPORTACION TANTO LOS GASTOS INICIALES COMO LOS 
PARCIALES';



-- -----------------------------------------------------------------------------
-- TABLA DE GASTOS INICIALES
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `appImport`.`gastos_iniciales` (
    `id_gastos_iniciales` MEDIUMINT NOT NULL AUTO_INCREMENT UNIQUE,
    `nro_pedido` CHAR(8) NOT NULL,
    `identificacion_proveedor` CHAR(13) NOT NULL COMMENT 'IDENTIFICADOR DE PROVEEDOR ENTREGADO POR VINESA PARA MENORES PONER CEROS ANTES',
    `concepto` VARCHAR(45) NOT NULL,
    `nro_factura` VARCHAR(20) NOT NULL,
    `fecha_emision` DATE NOT NULL,
    `fecha_inicio` DATE DEFAULT NULL,
    `fecha_fin` DATE DEFAULT NULL,
    `valor` DECIMAL(6,3) NOT NULL,
    `enviado_comtabilidad` TINYINT(1) NOT NULL DEFAULT 0,
    `fecha_envio` DATETIME DEFAULT NULL,
    `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_update` DATETIME NOT NULL,
    `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
    PRIMARY KEY(`nro_factura`, `identificacion_proveedor`),

    CONSTRAINT `FK_GASTOS_INICIALES_PEDIDO`
    FOREIGN KEY (`nro_pedido`) REFERENCES `appImport`.`pedido`(`nro_pedido`)
    ON UPDATE CASCADE ON DELETE RESTRICT,

    CONSTRAINT `FK_GASTOS_INCIALES_PROVEEDOR`
    FOREIGN KEY (`identificacion_proveedor`) REFERENCES `appImport`.`proveedor`(`identificacion_proveedor`)
    ON UPDATE CASCADE ON DELETE RESTRICT

  )
  ENGINE = InnoDB
COMMENT = 'LISTADO DE FACTURAS RECIBIDAS POR SERVICIOS DE IMPORTACION TANTO LOS GASTOS INICIALES COMO LOS 
PARCIALES';


-- -----------------------------------------------------------------------------
-- detalle de impuestos Pagados
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `appImport`.`impuestos` (
  `id_impuestos` SMALLINT NOT NULL AUTO_INCREMENT UNIQUE,
  `id_nacionalizacion` SMALLINT NOT NULL,
  `concepto` DECIMAL(9,3) NOT NULL,
  `valor` DECIMAL(9,3) NOT NULL,
  `nro_documento` VARCHAR (45) NOT NULL,
  `fecha_emision` VARCHAR (45) NOT NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
    
  PRIMARY KEY (`id_nacionalizacion`, `concepto` ),

  CONSTRAINT `FK_IMPUESTOS_NACIONALIZACION`
  FOREIGN KEY (`id_nacionalizacion`) REFERENCES `appImport`.`nacionalizacion`(`id_nacionalizacion`)
  ON UPDATE CASCADE ON DELETE RESTRICT
  
)
  ENGINE = InnoDB
COMMENT = 'Se registran todos los impuestos que existen en una nacionalizacion, solo impuestos de la SENAE';


-- -----------------------------------------------------------------------------
-- TABLA DE PARAMETROS IMPUESTOS SENAE
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `appImport`.`tarifas_impuestos` (
  `id_tarifas_impuestos` SMALLINT NOT NULL AUTO_INCREMENT UNIQUE,
  `concepto` VARCHAR(45) NOT NULL UNIQUE,
  `regimen` ENUM('10', '70') ,
  `porcentaje` DECIMAL(9,3) NOT NULL,
  `fecha_emision` VARCHAR (45) NOT NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
    
  PRIMARY KEY (`id_tarifas_impuestos`)
  
)
  ENGINE = InnoDB
COMMENT = 'Se registran los porcentajes y los impuestos que existen  o se pagan';



-- -----------------------------------------------------------------------------
-- TABLA DE  USUARIOS
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `appImport`.`usuario` (
  `id_user` SMALLINT NOT NULL AUTO_INCREMENT UNIQUE,
  `nombres` VARCHAR(45) NOT NULL UNIQUE,
  `email` VARCHAR(45) NOT NULL UNIQUE,
  `cargo` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL UNIQUE,
  `password` VARCHAR(120) NOT NULL,
  `usertype` ENUM('L1','L2','L3') NOT NULL COMMENT 'L1 Administrador; L2 Ingreso Data; L3 Visualizacion',
  `last_login` DATETIME DEFAULT NULL,
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` DATETIME NOT NULL,
    
  PRIMARY KEY (`username`)
  
)
  ENGINE = InnoDB
COMMENT = 'Se registran todos los impuestos que existen en una nacionalizacion, solo impuestos de la SENAE';


-- -----------------------------------------------------------------------------
-- TABLA DE  SEGUIMEINTO
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `appImport`.`seguimiento` (
  `id_seguimiento` MEDIUMINT NOT NULL AUTO_INCREMENT UNIQUE,
  `tabla` VARCHAR(45) NOT NULL UNIQUE,
  `old_data` VARCHAR(450) NOT NULL,
  `new_data` VARCHAR(450) NOT NULL,
  `id_user` SMALLINT NOT NULL COMMENT 'NOMBRE APP USER QUE GUARDA EL REGISTRO',
  `date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,   
  PRIMARY KEY (`id_seguimiento`)
  
)
  ENGINE = InnoDB
COMMENT = 'Se registran los cambios en las tablas solo las columnas que cambian';
