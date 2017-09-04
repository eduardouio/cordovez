
detalle_pedido_factura
+------------------------+--------------+------+-----+-------------------+----------------+
| Field                  | Type         | Null | Key | Default           | Extra          |
+------------------------+--------------+------+-----+-------------------+----------------+
| detalle_pedido_factura | mediumint(9) | NO   | UNI | NULL              | auto_increment |
| id_pedido_factura      | mediumint(9) | NO   | PRI | NULL              |                |
| cod_contable           | char(20)     | NO   | PRI | NULL              |                |
| nro_cajas              | smallint(6)  | NO   |     | NULL              |                |
| costo_und              | decimal(6,3) | NO   |     | NULL              |                |
| date_create            | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update            | datetime     | YES  |     | NULL              |                |
| id_user                | smallint(6)  | NO   |     | NULL              |                |
+------------------------+--------------+------+-----+-------------------+----------------+


factura_informativa
+--------------------------+--------------+------+-----+-------------------+----------------+
| Field                    | Type         | Null | Key | Default           | Extra          |
+--------------------------+--------------+------+-----+-------------------+----------------+
| id_factura_informativa   | mediumint(9) | NO   | UNI | NULL              | auto_increment |
| nro_factura_informativa  | char(8)      | NO   | PRI | NULL              |                |
| nro_pedido               | char(6)      | NO   | PRI | NULL              |                |
| identificacion_proveedor | varchar(16)  | NO   | MUL | NULL              |                |
| fele_aduana              | decimal(6,3) | NO   |     | NULL              |                |
| seguro_aduana            | decimal(6,3) | NO   |     | NULL              |                |
| moneda                   | varchar(45)  | NO   |     | NULL              |                |
| tipo_cambio              | decimal(4,3) | NO   |     | 1.000             |                |
| date_create              | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update              | datetime     | YES  |     | NULL              |                |
| id_user                  | smallint(6)  | NO   |     | NULL              |                |
+--------------------------+--------------+------+-----+-------------------+----------------+


factura_informativa_detalle
+-----------------------------+--------------+------+-----+-------------------+----------------+
| Field                       | Type         | Null | Key | Default           | Extra          |
+-----------------------------+--------------+------+-----+-------------------+----------------+
| factura_informativa_detalle | mediumint(9) | NO   | UNI | NULL              | auto_increment |
| nro_factura_informativa     | char(8)      | NO   | PRI | NULL              |                |
| cod_contable                | char(20)     | NO   | PRI | NULL              |                |
| nro_cajas                   | smallint(6)  | NO   |     | NULL              |                |
| date_create                 | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update                 | datetime     | YES  |     | NULL              |                |
| id_user                     | smallint(6)  | NO   |     | NULL              |                |
+-----------------------------+--------------+------+-----+-------------------+----------------+

factura_pagos
+--------------------------+--------------+------+-----+-------------------+----------------+
| Field                    | Type         | Null | Key | Default           | Extra          |
+--------------------------+--------------+------+-----+-------------------+----------------+
| id_factura_pagos         | smallint(6)  | NO   | UNI | NULL              | auto_increment |
| identificacion_proveedor | varchar(16)  | NO   | PRI | NULL              |                |
| nro_factura              | char(10)     | NO   | PRI | NULL              |                |
| fecha_emision            | date         | NO   |     | NULL              |                |
| valor                    | decimal(6,3) | NO   |     | NULL              |                |
| saldo                    | decimal(6,0) | NO   |     | NULL              |                |
| comentarios              | varchar(250) | NO   |     | NULL              |                |
| date_create              | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update              | datetime     | YES  |     | NULL              |                |
| id_user                  | smallint(6)  | NO   |     | NULL              |                |
+--------------------------+--------------+------+-----+-------------------+----------------+


factura_pagos_pedido
+------------------+--------------+------+-----+-------------------+-------+
| Field            | Type         | Null | Key | Default           | Extra |
+------------------+--------------+------+-----+-------------------+-------+
| nro_pedido       | char(6)      | NO   | PRI | NULL              |       |
| id_factura_pagos | smallint(6)  | NO   | PRI | NULL              |       |
| valor            | decimal(6,3) | NO   |     | NULL              |       |
| concepto         | varchar(50)  | NO   | PRI | NULL              |       |
| fecha_inicio     | date         | YES  |     | NULL              |       |
| fecha_fin        | date         | YES  |     | NULL              |       |
| date_create      | timestamp    | NO   |     | CURRENT_TIMESTAMP |       |
| last_update      | datetime     | YES  |     | NULL              |       |
| id_user          | smallint(6)  | NO   |     | NULL              |       |
+------------------+--------------+------+-----+-------------------+-------+


factura_pagos_pedido_gasto_inicial_r70
+---------------------------------------+--------------+------+-----+-------------------+-------+
| Field                                 | Type         | Null | Key | Default           | Extra |
+---------------------------------------+--------------+------+-----+-------------------+-------+
| id_factura_pagos_pedido_gasto_inicial | smallint(6)  | NO   | UNI | NULL              |       |
| id_gastos_iniciales                   | mediumint(9) | NO   | PRI | NULL              |       |
| id_factura_pagos                      | smallint(6)  | NO   | PRI | NULL              |       |
| valor                                 | decimal(6,3) | NO   |     | 0.000             |       |
| date_create                           | timestamp    | NO   |     | CURRENT_TIMESTAMP |       |
| last_update                           | datetime     | YES  |     | NULL              |       |
| id_user                               | smallint(6)  | NO   |     | NULL              |       |
+---------------------------------------+--------------+------+-----+-------------------+-------+


factura_pagos_pedido_gasto_nacionalizacion
+-----------------------------------------------+--------------+------+-----+-------------------+
| Field                                         | Type         | Null | Key | Default           |
+-----------------------------------------------+--------------+------+-----+-------------------+
| id_factura_pagos_pedido_gasto_nacionalizacion | smallint(6)  | NO   | UNI | NULL              |
| id_gastos_iniciales                           | mediumint(9) | NO   | PRI | NULL              |
| id_factura_pagos                              | smallint(6)  | NO   | PRI | NULL              |
| valor                                         | decimal(6,3) | NO   |     | 0.000             |
| date_create                                   | timestamp    | NO   |     | CURRENT_TIMESTAMP |
| last_update                                   | datetime     | YES  |     | NULL              |
| id_user                                       | smallint(6)  | NO   |     | NULL              |
+-----------------------------------------------+--------------+------+-----+-------------------+

gastos_iniciales_r70
+---------------------+--------------+------+-----+-------------------+----------------+
| Field               | Type         | Null | Key | Default           | Extra          |
+---------------------+--------------+------+-----+-------------------+----------------+
| id_gastos_iniciales | mediumint(9) | NO   | UNI | NULL              | auto_increment |
| nro_pedido          | char(6)      | NO   | PRI | NULL              |                |
| concepto            | varchar(45)  | NO   | PRI | NULL              |                |
| valor_provisionado  | decimal(6,3) | NO   |     | NULL              |                |
| comentarios         | varchar(250) | YES  |     | NULL              |                |
| date_create         | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update         | datetime     | YES  |     | NULL              |                |
| id_user             | smallint(6)  | NO   |     | NULL              |                |
+---------------------+--------------+------+-----+-------------------+----------------+


gastos_nacionalizacion
+---------------------------+--------------+------+-----+-------------------+----------------+
| Field                     | Type         | Null | Key | Default           | Extra          |
+---------------------------+--------------+------+-----+-------------------+----------------+
| id_gastos_nacionalizacion | mediumint(9) | NO   | UNI | NULL              | auto_increment |
| codigo_nacionalizacion    | char(9)      | NO   | PRI | NULL              |                |
| concepto                  | varchar(45)  | NO   | PRI | NULL              |                |
| nro_factura               | varchar(20)  | NO   |     | NULL              |                |
| valor_provisionado        | decimal(6,3) | NO   |     | NULL              |                |
| comentarios               | varchar(250) | YES  |     | NULL              |                |
| date_create               | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update               | datetime     | YES  |     | NULL              |                |
| id_user                   | smallint(6)  | NO   |     | NULL              |                |
+---------------------------+--------------+------+-----+-------------------+----------------+

impuestos_nacionalizacion
+--------------------+--------------+------+-----+-------------------+----------------+
| Field              | Type         | Null | Key | Default           | Extra          |
+--------------------+--------------+------+-----+-------------------+----------------+
| id_impuestos       | smallint(6)  | NO   | UNI | NULL              | auto_increment |
| id_nacionalizacion | smallint(6)  | NO   | PRI | NULL              |                |
| concepto           | decimal(9,3) | NO   | PRI | NULL              |                |
| valor_provisionado | decimal(9,3) | NO   |     | NULL              |                |
| comentarios        | varchar(250) | YES  |     | NULL              |                |
| date_create        | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update        | datetime     | YES  |     | NULL              |                |
| id_user            | smallint(6)  | NO   |     | NULL              |                |
+--------------------+--------------+------+-----+-------------------+----------------+


incoterm_provicion_internacional
+-------------+-------------------------------+------+-----+-------------------+----------------+
| Field       | Type                          | Null | Key | Default           | Extra          |
+-------------+-------------------------------+------+-----+-------------------+----------------+
| id_incoterm | mediumint(9)                  | NO   | UNI | NULL              | auto_increment |
| tipo        | enum('GASTO','FLETE')         | NO   | PRI | NULL              |                |
| pais        | varchar(45)                   | NO   | PRI | NULL              |                |
| incoterms   | enum('EXW','FCA','FOB','CFR') | NO   | PRI | NULL              |                |
| ciudad      | varchar(45)                   | NO   | PRI | NULL              |                |
| tarifa      | float                         | NO   |     | NULL              |                |
| comentarios | varchar(250)                  | YES  |     | NULL              |                |
| date_create | timestamp                     | NO   |     | CURRENT_TIMESTAMP |                |
| last_update | datetime                      | YES  |     | NULL              |                |
| id_user     | smallint(6)                   | NO   |     | NULL              |                |
+-------------+-------------------------------+------+-----+-------------------+----------------+

liquidacion_impuestos
+-----------------------+--------------+------+-----+-------------------+----------------+
| Field                 | Type         | Null | Key | Default           | Extra          |
+-----------------------+--------------+------+-----+-------------------+----------------+
| liquidacion_impuestos | smallint(6)  | NO   | UNI | NULL              | auto_increment |
| id_impuestos          | smallint(6)  | NO   | PRI | NULL              |                |
| nro_documento         | varchar(18)  | NO   | PRI | NULL              |                |
| valor                 | decimal(6,3) | NO   |     | NULL              |                |
| date_create           | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update           | datetime     | YES  |     | NULL              |                |
| id_user               | smallint(6)  | NO   |     | NULL              |                |
+-----------------------+--------------+------+-----+-------------------+----------------+

nacionalizacion

+-------------------------+--------------+------+-----+-------------------+----------------+
| Field                   | Type         | Null | Key | Default           | Extra          |
+-------------------------+--------------+------+-----+-------------------+----------------+
| id_nacionalizacion      | smallint(6)  | NO   | UNI | NULL              | auto_increment |
| codigo_nacionalizacion  | char(9)      | NO   | UNI | NULL              |                |
| nro_pedido              | char(6)      | NO   | PRI | NULL              |                |
| nro_factura_informativa | char(8)      | NO   | PRI | NULL              |                |
| moneda                  | varchar(45)  | NO   |     | NULL              |                |
| tipo_cambio             | decimal(4,3) | NO   |     | 1.000             |                |
| date_create             | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update             | datetime     | YES  |     | NULL              |                |
| id_user                 | smallint(6)  | NO   |     | NULL              |                |
+-------------------------+--------------+------+-----+-------------------+----------------+

pedido
+---------------+---------------------------+------+-----+----------------------+----------------+
| Field         | Type                      | Null | Key | Default              | Extra          |
+---------------+---------------------------+------+-----+----------------------+----------------+
| id_pedido     | mediumint(9)              | NO   | UNI | NULL                 | auto_increment |
| nro_pedido    | char(6)                   | NO   | PRI | NULL                 |                |
| regimen       | enum('70','10')           | NO   |     | NULL                 |                |
| nro_referendo | char(20)                  | NO   | UNI | 000-0000-00-00000000 |                |
| id_incoterm   | mediumint(9)              | NO   |     | NULL                 |                |
| fele_aduana   | decimal(6,3)              | NO   |     | 0.000                |                |
| seguro_aduana | decimal(6,3)              | NO   |     | 0.000                |                |
| estado_pedido | enum('ABIERTO','CERRADO') | YES  |     | ABIERTO              |                |
| comentarios   | varchar(250)              | YES  |     | NULL                 |                |
| date_create   | timestamp                 | NO   |     | CURRENT_TIMESTAMP    |                |
| last_update   | datetime                  | YES  |     | NULL                 |                |
| id_user       | smallint(6)               | NO   |     | NULL                 |                |
+---------------+---------------------------+------+-----+----------------------+----------------+


pedido_factura
+--------------------------+--------------+------+-----+-------------------+----------------+
| Field                    | Type         | Null | Key | Default           | Extra          |
+--------------------------+--------------+------+-----+-------------------+----------------+
| id_pedido_factura        | mediumint(9) | NO   | UNI | NULL              | auto_increment |
| nro_pedido               | char(6)      | NO   | MUL | NULL              |                |
| id_factura_proveedor     | char(8)      | NO   | PRI | NULL              |                |
| identificacion_proveedor | varchar(16)  | NO   | PRI | NULL              |                |
| fecha_emision            | date         | NO   |     | NULL              |                |
| valor                    | decimal(6,3) | YES  |     | 0.000             |                |
| moneda                   | varchar(45)  | NO   |     | NULL              |                |
| tipo_cambio              | decimal(4,3) | NO   |     | 1.000             |                |
| vencimiento_pago         | date         | YES  |     | NULL              |                |
| date_create              | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update              | datetime     | YES  |     | NULL              |                |
| id_user                  | smallint(6)  | NO   |     | NULL              |                |
+--------------------------+--------------+------+-----+-------------------+----------------+

producto
+--------------------------+--------------+------+-----+-------------------+----------------+
| Field                    | Type         | Null | Key | Default           | Extra          |
+--------------------------+--------------+------+-----+-------------------+----------------+
| id_producto              | mediumint(9) | NO   | UNI | NULL              | auto_increment |
| cod_contable             | char(20)     | NO   | PRI | NULL              |                |
| identificacion_proveedor | varchar(16)  | NO   | MUL | NULL              |                |
| cod_ice                  | char(39)     | NO   |     | NULL              |                |
| nombre                   | varchar(70)  | NO   | UNI | NULL              |                |
| capacidad_ml             | smallint(6)  | NO   |     | NULL              |                |
| cantidad_x_caja          | smallint(6)  | NO   |     | NULL              |                |
| grado_alcoholico         | float        | NO   |     | NULL              |                |
| costo_unidad             | decimal(6,3) | NO   |     | 0.000             |                |
| estado                   | tinyint(1)   | NO   |     | 1                 |                |
| custodia_doble           | tinyint(1)   | NO   |     | 0                 |                |
| comentarios              | varchar(250) | YES  |     | NULL              |                |
| date_create              | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
| last_update              | datetime     | YES  |     | NULL              |                |
| id_user                  | smallint(6)  | NO   |     | NULL              |                |
+--------------------------+--------------+------+-----+-------------------+----------------+


proveedor
+--------------------------+----------------------------------+------+-----+-------------------+----------------+
| Field                    | Type                             | Null | Key | Default           | Extra          |
+--------------------------+----------------------------------+------+-----+-------------------+----------------+
| id_proveedor             | int(11)                          | NO   | UNI | NULL              | auto_increment |
| nombre                   | varchar(60)                      | NO   | UNI | NULL              |                |
| tipo_provedor            | enum('NACIONAL','INTERNACIONAL') | NO   |     | NULL              |                |
| categoria                | varchar(60)                      | NO   |     | NULL              |                |
| identificacion_proveedor | varchar(16)                      | NO   | PRI | NULL              |                |
| comentarios              | varchar(250)                     | YES  |     | NULL              |                |
| date_create              | timestamp                        | NO   |     | CURRENT_TIMESTAMP |                |
| last_update              | datetime                         | YES  |     | NULL              |                |
| id_user                  | smallint(6)                      | NO   |     | NULL              |                |
+--------------------------+----------------------------------+------+-----+-------------------+----------------+

seguimiento
+----------------+-------------------------+------+-----+-------------------+----------------+
| Field          | Type                    | Null | Key | Default           | Extra          |
+----------------+-------------------------+------+-----+-------------------+----------------+
| id_seguimiento | mediumint(9)            | NO   | PRI | NULL              | auto_increment |
| tabla          | varchar(45)             | NO   |     | NULL              |                |
| accion         | enum('UPDATE','DELETE') | NO   |     | UPDATE            |                |
| datos          | varchar(1000)           | YES  |     | NULL              |                |
| id_user        | smallint(6)             | NO   |     | NULL              |                |
| date_create    | timestamp               | NO   |     | CURRENT_TIMESTAMP |                |
+----------------+-------------------------+------+-----+-------------------+----------------+

tarifa_provicion_nacional
+--------------------------+-----------------------------------------------+------+-----+-------------------+----------------+
| Field                    | Type                                          | Null | Key | Default           | Extra          |
+--------------------------+-----------------------------------------------+------+-----+-------------------+----------------+
| id_tarifa                | mediumint(9)                                  | NO   | UNI | NULL              | auto_increment |
| identificacion_proveedor | varchar(16)                                   | NO   | PRI | NULL              |                |
| regimen                  | enum('R70','R10','TODOS')                     | NO   |     | NULL              |                |
| tipo_provicion           | enum('GASTO INICIAL','GASTO NACIONALIZACION') | NO   |     | NULL              |                |
| concepto                 | varchar(45)                                   | NO   | PRI | NULL              |                |
| valor                    | decimal(6,3)                                  | NO   |     | NULL              |                |
| porcentaje               | decimal(3,2)                                  | NO   |     | 0.00              |                |
| comentarios              | varchar(250)                                  | YES  |     | NULL              |                |
| date_create              | timestamp                                     | NO   |     | CURRENT_TIMESTAMP |                |
| last_update              | datetime                                      | YES  |     | NULL              |                |
| id_user                  | smallint(6)                                   | NO   |     | NULL              |                |
+--------------------------+-----------------------------------------------+------+-----+-------------------+----------------+


tarifas_impuestos
+----------------------+---------------------------+------+-----+-------------------+----------------+
| Field                | Type                      | Null | Key | Default           | Extra          |
+----------------------+---------------------------+------+-----+-------------------+----------------+
| id_tarifas_impuestos | smallint(6)               | NO   | PRI | NULL              | auto_increment |
| concepto             | varchar(45)               | NO   | UNI | NULL              |                |
| regimen              | enum('R10','R70','TODOS') | NO   |     | NULL              |                |
| porcentaje           | decimal(9,3)              | NO   |     | NULL              |                |
| date_create          | timestamp                 | NO   |     | CURRENT_TIMESTAMP |                |
| last_update          | datetime                  | YES  |     | NULL              |                |
| estado               | enum('ACTIVO','INACTIVO') | NO   |     | ACTIVO            |                |
| comentarios          | varchar(250)              | YES  |     | NULL              |                |
| id_user              | smallint(6)               | NO   |     | NULL              |                |
| valor                | decimal(4,3)              | NO   |     | 0.000             |                |
+----------------------+---------------------------+------+-----+-------------------+----------------+

usuario

+-------------+----------------------+------+-----+-------------------+----------------+
| Field       | Type                 | Null | Key | Default           | Extra          |
+-------------+----------------------+------+-----+-------------------+----------------+
| id_user     | smallint(6)          | NO   | UNI | NULL              | auto_increment |
| nombres     | varchar(45)          | NO   | UNI | NULL              |                |
| email       | varchar(45)          | NO   | UNI | NULL              |                |
| cargo       | varchar(45)          | NO   |     | NULL              |                |
| username    | varchar(45)          | NO   | PRI | NULL              |                |
| password    | varchar(120)         | NO   |     | NULL              |                |
| usertype    | enum('L1','L2','L3') | NO   |     | NULL              |                |
| last_login  | datetime             | YES  |     | NULL              |                |
| date_create | timestamp            | NO   |     | CURRENT_TIMESTAMP |                |
| last_update | datetime             | YES  |     | NULL              |                |
+-------------+----------------------+------+-----+-------------------+----------------+