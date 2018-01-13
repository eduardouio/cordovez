INSERT INTO`tarifa_incoterm`
(`tipo`,
`pais`,
`incoterms`,
`ciudad`,
`tarifa`,
`comentarios`,
`id_user`)
VALUES
('GASTO ORIGEN','ALEMANIA','FOB','HAMBURGO','773.14',NULL,1),
('FLETE','ALEMANIA','FOB','HAMBURGO','0.00',NULL,1),
('GASTO ORIGEN','ALEMANIA','FOB','HAMBURGO','773.14',NULL,1),
('FLETE','ALEMANIA','FOB','HAMBURGO','0.00',NULL,1),
('GASTO ORIGEN','ALEMANIA','FOB','HAMBURGO','773.14',NULL,1),
('FLETE','ALEMANIA','FOB','HAMBURGO','0.00',NULL,1),
('GASTO ORIGEN','ALEMANIA','FOB','HAMBURGO','773.14',NULL,1),
('FLETE','ALEMANIA','FOB','HAMBURGO','0.00',NULL,1),
('GASTO ORIGEN','ARGENTINA','EXW','MENDOZA','2110.00',NULL,1),
('FLETE','ARGENTINA','EXW','MENDOZA','200.00',NULL,1),
('GASTO ORIGEN','ARGENTINA','FCA','MENDOZA','2110.00',NULL,1),
('FLETE','ARGENTINA','FCA','MENDOZA','200.00',NULL,1),
('GASTO ORIGEN','CHILE','FOB','SANANTONIO','0.00',NULL,1),
('FLETE','CHILE','FOB','SANANTONIO','200.00',NULL,1),
('GASTO ORIGEN','CHINA','FOB','SHANGAY','2300.21',NULL,1),
('FLETE','CHINA','FOB','SHANGAY','2300.21',NULL,1),
('GASTO ORIGEN','CUBA','FOB','LAHAVANA','0.00','VALORES NO DEFINIDOS',1),
('FLETE','CUBA','FOB','LAHAVANA','0.00','VALORES NO DEFINIDOS',1),
('GASTO ORIGEN','ESPAÑA','FOB','ALGECIRAS','0.00',NULL,1),
('FLETE','ESPAÑA','FOB','ALGECIRAS','886.84',NULL,1),
('GASTO ORIGEN','ESPAÑA','FOB','BARCELONA','0.00',NULL,1),
('FLETE','ESPAÑA','FOB','BARCELONA','886.84',NULL,1),
('GASTO ORIGEN','ESPAÑA','FOB','BILVAO','0.00','VALORES NO DEFINIDOS',1),
('FLETE','ESPAÑA','FOB','BILVAO','0.00','VALORES NO DEFINIDOS',1),
('GASTO ORIGEN','ESPAÑA','FOB','MADRID','886.84',NULL,1),
('FLETE','ESPAÑA','FOB','MADRID','0.00',NULL,1),
('GASTO ORIGEN','EUROPA','CFR','TILBURI','0.00',NULL,1),
('FLETE','EUROPA','CFR','TILBURI','1630.00',NULL,1),
('GASTO ORIGEN','ITALIA','FCA','GENOVA','0.00','VALORES NO DEFINIDOS',1),
('FLETE','ITALIA','FCA','GENOVA','0.00','VALORES NO DEFINIDOS',1),
('GASTO ORIGEN','MEXICO','EXW','MANZANILLO','0.00','VALORES NO DEFINIDOS',1),
('FLETE','MEXICO','EXW','MANZANILLO','0.00','VALORES NO DEFINIDOS',1),
('CERO','PCERO','CERO','CCERO','0.00',NULL,1),
('GASTO ORIGEN','PERU','FOB','LIMA','0.00','VALORES NO DEFINIDOS',1),
('FLETE','PERU','FOB','LIMA','0.00','VALORES NO DEFINIDOS',1),
('GASTO ORIGEN','PORTUGAL','EXW','PORTO','657.41',NULL,1),
('FLETE','PORTUGAL','EXW','PORTO','1070.00',NULL,1);

-- -------------------------------------------------------------------
-- TarifaGastos
-- -------------------------------------------------------------------


INSERTINTO`tarifa_gastos`
(`identificacion_proveedor`,
`regimen`,
`tipo_gasto`,
`concepto`,
`valor`,
`estado`,
`pais_origen`,
`porcentaje`,
`comentarios`,
`id_user`)
VALUES

('0','TODOS','GASTO INICIAL','AGENTE INICIAL FISICO','249.60',1,'ECUADOR','0.0000','AGENTE INICIAL AFORO FISICO',1),
('0','TODOS','GASTO INICIAL','AGENTE INICIAL DOCUMENTAL','234.60',1,'ECUADOR','0.0000','AGENTE INICIAL AFORODO CUMENTAL',1),
('0','R70','GASTO INICIAL','ALMACENAJE INICIAL','0.00',1,'ECUADOR','0.0000',NULL,1),
('0','R70','GASTO INICIAL','ALMACENAJE ALMAGRO','0.00',1,'ECUADOR','0.0000',NULL,1),
('0','R70','GASTO INICIAL','CANDADO SATELITAL','45.00',1,'ECUADOR','0.0000',NULL,1),
('0','R70','GASTO INICIAL','CANDADO SATELITAL EMERGENTE','70.00',1,'ECUADOR','0.0000',NULL,1),
('0','TODOS','GASTO INICIAL','DEMORAJE','0.00',1,'ECUADOR','0.0000',NULL,1),
('0','R70','GASTO INICIAL','DESCARGA ALMAGRO','55.00',1,'ECUADOR','0.0000',NULL,1),
('0','TODOS','GASTO INICIAL','ISD','0.00',1,'ECUADOR','0.0500',NULL,1),
('0','TODOS','GASTO INICIAL','FLETE','0.00',1,'ECUADOR','0.0500',NULL,1),
('0','TODOS','GASTO INICIAL','OTROS GASTOS NAVIEROS','0.00',1,'ECUADOR','0.0000',NULL,1),
('0','TODOS','GASTO INICIAL','SEGURO','0.00',1,'ECUADOR','0.0018','((FLETE+FOB)*220)0.18',1),
('0','R70','GASTO INICIAL','TASA ADUANERA','55.00',1,'ECUADOR','0.0000',NULL,1),
('0','TODOS','GASTO INICIAL','GASTOS LOCALES','195.00',1,'EUROPA''0.0000','TODA EUROPA',1),
('0','TODOS','GASTO INICIAL','GASTOS LOCALES','310.00',1,'ARGENTINA','0.0000','DESDE ARGENTINA',1),
('0','TODOS','GASTO INICIAL','MANO OBRA ETIQUETADO','55.00',1,'ECUADOR','0.0000','SERVICIO DE PEGADO DE ETIEUTAS EN LA BODEGA',1),
('0','TODOS','GASTO INICIAL','GASTOS LOCALES','310.00',1,'ECUADOR','0.0000','ARGENTINA Y CHILE',1),
('0','TODOS','GASTO INICIAL','THC','155.00',1,'ECUADOR','0.0000','COSTO DE THC CON HAMBURGSUD',1),
('0','TODOS','GASTO INICIAL','THC','165.00',1,'ECUADOR','0.0000',NULL,1),
('0','TODOS','GASTO INICIAL','CUSTODIA ARMADA','490.00',1,'ECUADOR','0.0000','EL DOBLE PARA LOS WHISKY',1),
('0','TODOS','GASTO INICIAL','TRANSPORTE INTERNO EXTRAPESADOUIO-GYE','750.00',1,'ECUADOR','0.0000','SERVICIO DE TRANSPORTE INTERNO',1),
('0','TODOS','GASTO INICIAL','TRANSPORTE INTERNO NORMALUIO-GYE','660.00',1,'ECUADOR','0.0000','SERVICIO DE TRANSPORTE INTERNO',1);


-- ------------------------------------------------------------------
-- Usuarios del sistema
-- -------------------------------------------------------------------
INSERT INTO `usuario` 
(`id_user`, 
`nombres`, 
`email`, 
`cargo`, 
`username`, 
`password`, 
`usertype`, 
`last_login`, 
`date_create`, 
`last_update`)
VALUES
(1, 'ADMINISTRADOR', 'usuario@gmail.com', 'STAFF', 'cordovez', 'jR0TWnF/TS81Xr7h9LASq4yRY/sLR9dAUwC+EwI9mE0=', 'L1', '2017-11-14 14:26:21', '2017-09-07 09:46:27', NULL),
(2, 'RUTH ANDRADE', 'Randrade@vinesa.com.ec', 'STAFF', 'randrade', 'JePsVRpJhak3empGrs0CaTOyJ0we47EEjzMaj0v3new=', 'L1', '2017-10-17 05:34:25', '2017-10-17 09:19:41', NULL),
(3, 'ADRIAN CARDENAS', 'info@vinesa.com.ec', 'STAFF', 'acardenas', 'wahlp6v48H/KWHQd+pNhcC2qSf3b3OfJ867fRjtD61M=', 'L1', '2017-11-14 04:41:15', '2017-10-17 09:33:06', NULL),
(4, 'ALEXANDRA LEON', 'info6@vinesa.com.ec', 'STAFF', 'aleon', 'wahlp6v48H/KWHQd+pNhcC2qSf3b3OfJ867fRjtD61M=', 'L1', NULL, '2017-10-17 09:33:06', NULL),
(5, 'ALEXANDRA VARGAS', 'info7@vinesa.com.ec', 'STAFF', 'avargas', 'wahlp6v48H/KWHQd+pNhcC2qSf3b3OfJ867fRjtD61M=', 'L1', NULL, '2017-10-17 09:33:06', NULL),
(6, 'CECILIA FELIX', 'info3@vinesa.com.ec', 'STAFF', 'cfelix', 'wahlp6v48H/KWHQd+pNhcC2qSf3b3OfJ867fRjtD61M=', 'L1', NULL, '2017-10-17 09:33:06', NULL),
(7, 'DAVID PEREZ', 'info5@vinesa.com.ec', 'STAFF', 'dperez', 'wahlp6v48H/KWHQd+pNhcC2qSf3b3OfJ867fRjtD61M=', 'L1', NULL, '2017-10-17 09:33:06', NULL),
(8, 'GABRIELA ALARCON', 'info4@vinesa.com.ec', 'STAFF', 'galarcon', 'wahlp6v48H/KWHQd+pNhcC2qSf3b3OfJ867fRjtD61M=', 'L1', NULL, '2017-10-17 09:33:06', NULL),
(9, 'JEANNETH CARRILLO', 'jcarrillo@vinesa.com.ec', 'STAFF', 'jcarrillo', '6rbBEcnvv/xN7lufGVHMhcJOWcWrU7GUE8m0A6ag0vc=', 'L1', NULL, '2017-10-17 09:33:06', NULL),
(10, 'JORGE CHULDE', 'jchulde@vinesa.com.ec ', 'STAFF', 'jchulde', '2eIW1tkS99tlBMogb/dj2r7jnTk94+tnDScuj2Qowng=', 'L1', NULL, '2017-10-17 09:33:06', NULL),
(11, 'MARIA ELENA SANTI', 'info1@vinesa.com.ec', 'STAFF', 'msanti', 'wahlp6v48H/KWHQd+pNhcC2qSf3b3OfJ867fRjtD61M=', 'L1', NULL, '2017-10-17 09:33:06', NULL),
(12, 'MARIA ELENA TERAN', 'mteran@vinesa.com.ec', 'STAFF', 'mteran', 'jMOFWX5OKvAjiiYeK3afv4nLoVvqYFU/jpo/UAQRssY=', 'L1', NULL, '2017-10-17 09:33:06', NULL),
(13, 'VERONICA PONCE', 'info2@vinesa.com.ec', 'STAFF', 'vponce', 'wahlp6v48H/KWHQd+pNhcC2qSf3b3OfJ867fRjtD61M=', 'L1', NULL, '2017-10-17 09:33:06', NULL);



-- -------------------------------------------------------------------
-- Pedidos
-- -------------------------------------------------------------------
INSERT INTO `pedido`
(`id_pedido`, 
`nro_pedido`, 
`regimen`, 
`incoterm`, 
`pais_origen`, 
`ciudad_origen`, 
`fecha_arribo`, 
`dias_libres`, 
`comentarios`, 
`nro_refrendo`, 
`last_update`, 
`date_create`, 
`id_user`, 
`bg_isclosed`, 
`bg_islocked`, 
`bg_haveExpenses`) 
VALUES 
(0,'000000','R10','0000','0','0',NULL,'0','REGISTRO CERO','0',)


-- -------------------------------------------------------------------
-- Factura Informativa
-- -------------------------------------------------------------------
INSERT INTO `factura_informativa`(
`id_factura_informativa`, 
`nro_factura_informativa`, 
`nro_pedido`, 
`identificacion_proveedor`, 
`fecha`, 
`fele_aduana`, 
`seguro_aduana`, 
`valor`, 
`nro_refrendo`, 
`id_user`) 
VALUES 
(0,'0','0',0,'2017-12-31',0,0,0,0,1);

