-- -------------------------------------------------------------------
-- Proveedores Cordovez
-- -------------------------------------------------------------------

INSERT INTO `cordovezApp`.`proveedor`
(`nombre`,
`tipo_provedor`,
`categoria`,
`identificacion_proveedor`,
`id_user`)
VALUES
('PROVEEDOR NO DEFINIDO PARA TARIFAS GENERALES','NACIONAL','NO DEFINIDO PARA TARIFAS GENERALES','0',1),
('ALMACENERA DEL ECUADOR S.A. ALMESA','NACIONAL','ESTIBAJE;FORMULARIOS;ALMACENAJE;HORAS EXTRAS','0990027331001',1),
('HAMBURG SUD ECUADOR S.A.','NACIONAL','TRANSPORTE INTERNACIONAL;GASTOS NACIONALES','0990300925001',1),
('ALMACENERA DEL AGRO S A','NACIONAL','TRANSPORTE INTERNO;ESTIBAJE;FORMULARIOS;ALMACENAJE;ESPACIO PARA ETIQUETADO; HORAS EXTRAS','0990304262001',1),
('KUEHNE + NAGEL S.A.','NACIONAL','FLETE INTERNACIONAL;THC;GASTOS NACIONALES;GASTOS EN ORIGEN','0991321764001',1),
('FERTISA, FERTILIZANTES, TERMINALES I SERVICIOS S.A.','NACIONAL','BODEGAJE GYE','0991352937001',1),
('NETTEL S.A.','NACIONAL','CANDADO SATELITAL','0991413073001',1),
('NAPORTEC S.A.','NACIONAL','BODEGAJE GYE','0992201029001',1),
('INARPI S.A.','NACIONAL','BODEGAJE GYE','0992247932001',1),
('CONTECON GUAYAQUIL S.A.','NACIONAL','BODEGAJE GYE','0992506717001',1),
('SEPROCUSTODIA CIA.LTDA.','NACIONAL','CUSTODIA ARMADA','0992530030001',1),
('PONCE NOLIVOS MARIO FABIAN','NACIONAL','AGENTE DE ADUANAS','1703505030001',1),
('SEGUROS EQUINOCCIAL S.A.','NACIONAL','POLIZAS','1790007502001',1),
('PANATLANTIC LOGISTICS S.A','NACIONAL','AGENTE DE ADUANAS;CANDADO SATELITAL','1790427692001',1),
('OFICINA COMERCIAL ADUANERA CORDERO PROANO CIA. LTD','NACIONAL','AGENTE DE ADUANAS','1790775879001',1),
('INTERCILSA LOGISTICS CIA.','NACIONAL','FLETE INTERNACIONAL;THC;GASTOS NACIONALES;GASTOS EN ORIGEN','1791283600001',1),
('COTECNA DEL ECUADOR S.A.','NACIONAL','CANDADO SATELITAL','1791359496001',1),
('SEPROTRANSPORTE S.A.','NACIONAL','TRANSPORTE INTERNO','1791920961001',1),
('PRATAC S.A.','INTERNACIONAL','LICORES','20532416036',1),
('BODEGAS MUGA S.L.','INTERNACIONAL','LICORES','B26010710',1),
('MARNIER LAPOSTOLLE','INTERNACIONAL','LICORES','27552073371',1),
('LA RURAL VIÑEDOS Y BODEGAS  S.','INTERNACIONAL','LICORES','30527196112',1),
('ACHAVAL FERRER S.A.','INTERNACIONAL','LICORES','30-70086601-3',1),
('TRIVENTO','INTERNACIONAL','LICORES','33-68989817-9',1),
('SOGEVINUS FINE WINES','INTERNACIONAL','LICORES','PT500000026',1),
('VIÑA MAIPO LIMITADA','INTERNACIONAL','LICORES','82.117.400-7',1),
('VIÑA CONCHA Y TORO S.A.','INTERNACIONAL','LICORES','90.227.000-0',1),
('HENKELL & SOHNLEIN','INTERNACIONAL','LICORES','DE213089937',1),
('GONZALEZ BYASS S.A.','INTERNACIONAL','LICORES','ESA11605276',1);
('PORTO BARROS.','INTERNACIONAL','LICORES','1111111111111',1);


-- -------------------------------------------------------------------
-- Productos Cordovez
-- -------------------------------------------------------------------
INSERT INTO `cordovezApp`.`producto`
(`cod_contable`,
`identificacion_proveedor`,
`cod_ice`,
`nombre`,
`capacidad_ml`,
`cantidad_x_caja`,
`grado_alcoholico`,
`costo_caja`,
`estado`,
`custodia_doble`,
`comentarios`,
`id_user`)
VALUES
('01011010040117010750','33-68989817-9','3031-53-001982-013-000750-66-101-000029','VINO TRIVENTO CHARDONAY/CHENIN',750,12,12.5,1,0,1),
('01011010040117020750','33-68989817-9','3031-53-001982-013-000750-66-101-000037','VINO TRIVENTO SYRAH/MALBEC',750,12,13.5,1,0,1),
('01011010040205010750','33-68989817-9','3031-53-001982-013-000750-66-101-000037','VINO TRIVENTO RES. CHARD-BLANC',750,12,13.5,1,0,1),
('01011010040206010750','33-68989817-9','3031-53-001982-013-000750-66-101-000037','VINO TRIVENTO RES. MALBEC',750,12,13.5,1,0,1),
('01011010040217010750','33-68989817-9','3031-53-001982-013-000750-66-101-000037','VINO TRIVENTO RES. CAB.MALBEC',750,12,13.5,1,0,1),
('01011010040306010750','33-68989817-9','3031-53-001982-013-000750-66-101-000037','VINO TRIVENTO TRIBU MALBEC',750,12,13.5,1,0,1),
('01011010040309010750','33-68989817-9','3031-53-001982-013-000750-66-101-000037','VINO TRIVENTO TRIBU SYRAH',750,12,13.5,1,0,1),
('01011010040311010750','33-68989817-9','3031-53-001986-013-000750-66-101-000037','VINO TRIVENTO TRIBU TEMPRANILL',750,12,13.5,1,0,1),
('01011010040312010750','33-68989817-9','3031-53-001987-013-000750-66-101-000037','VINO TRIVENTO TRIBU VIOGNIER',750,12,13.5,1,0,1),
('01011010040404010750','33-68989817-9','3031-53-001982-013-000750-66-101-000033','VINO TRIVENTO COLECCION FINCAS SAUV. BL',750,6,13,1,0,1),
('01011010040406010750','33-68989817-9','3031-53-001982-013-000750-66-101-000041','VINO TRIVENTO COLECCIÓN FINCAS MALBEC',750,6,14,1,0,1),
('01011010040409010750','33-68989817-9','3031-53-001982-013-000750-66-101-000041','VINO TRIVENTO COLECCIÓN FINCAS SYRAH',750,6,14,1,0,1),
('01011010040606010750','33-68989817-9','3031-53-001982-013-000750-66-101-000048','VINO TRIVENTO GOLDEN RES. MALB',750,6,14.8,1,0,1),
('01011010040609010750','33-68989817-9','3031-53-001978-013-000750-66-101-000041','VINO TRIVENTO SYRAH GOLDEN RESERVE',750,6,14,1,0,1),
('01011010040702010750','33-68989817-9','3031-53-001982-013-000750-66-101-000029','VINO TRIVENTO CHAMIZA BLN',750,12,12.5,1,0,1),
('01011010040817010750','33-68989817-9','3031-53-001984-013-000750-66-101-000037','VINO TRIVENTO AMADO SUR',750,6,13.5,1,0,1),
('01011010040906010750','33-68989817-9','3031-53-001978-013-000750-66-101-000029','VINO TRIVENTO MALBEC EOLO',750,6,12.3,1,0,1),
('01011010041017010750','33-68989817-9','3031-53-001978-013-000750-66-101-000029','VINO TRIVENTO CHARDONAY CHENIN AB ORIGINE MIXTUS',750,12,12.5,1,0,1),
('01011010041017020750','33-68989817-9','3031-53-001978-013-000750-66-108-000029','VINO TRIVENTO SHIRAZ MALBEC AB ORIGINE MIXTUS',750,12,12.5,1,0,1),
('01011013040103010750','33-68989817-9','3031-53-013262-013-000750-66-101-000027','VINO TRIVENTO CABERNET SAUVIGNON GRAN ALBARDA',750,12,12,1,0,1),
('01011013040105010750','33-68989817-9','3031-53-013261-013-000750-66-101-000027','VINO TRIVENTO CHARDONNAY GRAN ALBARDA',750,12,12,1,0,1),
('01011013040106010750','33-68989817-9','3031-53-013260-013-000750-66-101-000027','VINO TRIVENTO MALBEC GRAN ALBARDA',750,12,12,1,0,1),
('01011013050106010750','33-68989817-9','3031-53-013263-013-000750-66-101-000027','VINO TRIVENTO MALBEC GRAN LOMO',750,12,12,1,0,1),
('01011010430217010750','30-70086601-3','3031-53-013117-013-000750-66-101-000106','VINO ACHAVAL FERRER QUIMERA',750,6,13.9,1,0,1),
('01011010430306010750','30-70086601-3','3031-53-013118-013-000750-66-101-000037','VINO ACHAVAL MALBEC FINCA ALTAMIRA',750,6,13.5,1,0,1),
('01011010430406010750','30-70086601-3','3031-53-013119-013-000750-66-101-000037','VINO ACHAVAL MALBEC FINCA MIRADOR',750,6,13.5,1,0,1),
('01011010430506010750','30-70086601-3','3031-53-013120-013-000750-66-101-000037','VINO ACHAVAL MALBEC MENDOZA',750,12,13.5,1,0,1),
('01011080010101010750','90.227.000-0','3031-53-000402-013-000750-66-108-000033','VINO CASILLERO DEL DIABLO DEVILS COLLECTION TINTO',750,12,13.5,1,0,1),
('01011080010101020750','90.227.000-0','3031-53-000402-013-000750-66-108-000037','VINO CASILLERO DEL DIABLO DEVILS COLLECTION BLANCO',750,12,13.5,1,0,1),
('01011080010103010375','90.227.000-0','3031-53-000402-013-000375-66-108-000037','VINO CASILLERO CABERNET 1/2',375,24,13.5,1,0,1),
('01011080010103010750','90.227.000-0','3031-53-000402-013-000750-66-108-000037','VINO CASILLERO CABERNET',750,12,13.5,1,0,1),
('01011080010103060750','90.227.000-0','3031-53-000402-013-000750-66-108-000037','VINO CASILLERO VINTAGE GRAN VINO',750,12,13.5,1,0,1),
('01011080010104010375','90.227.000-0','3031-53-000402-013-000375-66-108-000037','VINO CASILLERO SAUVIGNON 1/2',375,24,13.5,1,0,1),
('01011080010104010750','90.227.000-0','3031-53-000402-013-000750-66-108-000033','VINO CASILLERO SAUVIGNON',750,12,13,1,0,1),
('01011080010105010375','90.227.000-0','3031-53-000402-013-000375-66-108-000037','VINO CASILLERO CHARDONNAY 1/2',375,24,13.5,1,0,1),
('01011080010105010750','90.227.000-0','3031-53-000402-013-000750-66-108-000037','VINO CASILLERO CHARDONNAY',750,12,13.5,1,0,1),
('01011080010106010750','90.227.000-0','3031-53-000402-013-000750-66-108-000037','VINO CASILLERO MALBEC',750,12,13.5,1,0,1),
('01011080010107010750','90.227.000-0','3031-53-000402-013-000750-66-108-000037','VINO CASILLERO MERLOT',750,12,13.5,1,0,1),
('01011080010108010375','90.227.000-0','3031-53-000402-013-000375-66-108-000037','VINO CASILLERO CARMENERE 1/2',375,24,13.5,1,0,1),
('01011080010108010750','90.227.000-0','3031-53-000402-013-000750-66-108-000037','VINO CASILLERO CARMENERE',750,12,13.5,1,0,1),
('01011080010109010750','90.227.000-0','3031-53-000402-013-000750-66-108-000037','VINO CASILLERO SYRA',750,12,13.5,1,0,1),
('01011080010110010750','90.227.000-0','3031-53-000402-013-000750-66-108-000041','VINO CASILLERO PINO',750,12,14,1,0,1),
('01011080011517010750','90.227.000-0','3031-53-000402-013-000750-66-108-000046','VINO CASILLERO RESERVA PRIVADA',750,12,14.5,1,0,1),
('01011010010206010750','90.227.000-0','3031-53-013129-013-000750-66-101-000029','VINO RESERVADO MALBEC - ARGENTINA',750,12,12.5,1,0,1),
('01011080010203010750','90.227.000-0','3031-53-000820-013-000750-66-108-000033','VINO RESERVADO CABERNET',750,12,13,1,0,1),
('01011080010204010750','90.227.000-0','3031-53-000820-013-000750-66-108-000029','VINO RESERVADO SAUVIGNON BLANC',750,12,12.5,1,0,1),
('01011080010205010750','90.227.000-0','3031-53-000820-013-000750-66-108-000033','VINO RESERVADO CHARDONNAY',750,12,13,1,0,1),
('01011080010207010750','90.227.000-0','3031-53-000820-013-000750-66-108-000033','VINO RESERVADO MERLOT',750,12,13,1,0,1),
('01011080010213010750','90.227.000-0','3031-53-000820-013-000750-66-108-000029','VINO RESERVADO ROSE',750,12,12.5,1,0,1),
('01011080010213020750','90.227.000-0','3031-53-002260-013-000750-66-108-000027','VINO RESERVADO ROSE SYRAH',750,12,12,1,0,1),
('01011080010215010750','90.227.000-0','3031-53-000540-013-000750-66-108-000029','VINO RESERVADO MOSCATEL SEM BL',750,12,12.5,1,0,1),
('01011080010217010750','90.227.000-0','3031-53-000540-013-000750-66-108-000033','VINO RESERVADO CARMERE CAB.SUB',750,12,13,1,0,1),
('01011080010303010750','90.227.000-0','3031-53-001246-013-000750-66-108-000046','VINO MARQUES CABERNET',750,12,14.5,1,0,1),
('01011080010305010750','90.227.000-0','3031-53-001246-013-000750-66-108-000041','VINO MARQUES CHARDONNAY',750,12,14,1,0,1),
('01011080010307010750','90.227.000-0','3031-53-001246-013-000750-66-108-000046','VINO MARQUES MERLOT',750,12,14.5,1,0,1),
('01011080010308010750','90.227.000-0','3031-53-000540-013-000750-66-108-000046','VINO MARQUES CARMENERE',750,12,14.5,1,0,1),
('01011080010309010750','90.227.000-0','3031-53-001246-013-000750-66-108-000046','VINO MARQUES SYRAH',750,12,14.5,1,0,1),
('01011080010401011000','90.227.000-0','3031-53-000491-031-001000-66-108-000026','VINO CLOS DE PIRQUE TINTO',1000,12,11.5,1,0,1),
('01011080010402011000','90.227.000-0','3031-53-000491-031-001000-66-108-000026','VINO CLOS DE PIRQUE BLANCO',1000,12,11.5,1,0,1),
('01011080010407011000','90.227.000-0','3031-53-000491-031-001000-66-108-000026','VINO CLOS DE PIRQUE MERLOT',1000,12,11.5,1,0,1),
('01011080010503010750','90.227.000-0','3031-53-000820-013-000750-66-108-000029','VINO FRONTERA CABER SAUV',750,12,12.5,1,0,1),
('01011080010505010750','90.227.000-0','3031-53-000820-013-000750-66-108-000029','VINO FRONTERA CHARDONNAY BL',750,12,12.5,1,0,1),
('01011080010507010750','90.227.000-0','3031-53-000820-013-000750-66-108-000027','VINO FRONTERA MERLOT',750,12,12,1,0,1),
('01011080010508010750','90.227.000-0','3031-53-000820-013-000750-66-108-000029','VINO FRONTERA CARMENERE TINTO',750,12,12.5,1,0,1),
('01011080010509010750','90.227.000-0','3031-53-000820-013-000750-66-108-000029','VINO FRONTERA SHIRAZ',750,12,12.5,1,0,1),
('01011080010603010750','90.227.000-0','3031-53-000540-013-000750-66-108-000046','VINO DON MELCHOR CAB. SAUV.',750,6,14.5,1,0,1),
('01011080010803010750','90.227.000-0','3031-53-000540-013-000750-66-108-000033','VINO SUNRISE CAB. SAUV.',750,12,13,1,0,1),
('01011080010804010750','90.227.000-0','3031-53-000540-013-000750-66-108-000029','VINO SUNRISE SAUV. BLANC.',750,12,12.5,1,0,1),
('01011080010805010750','90.227.000-0','3031-53-000540-013-000750-66-108-000033','VINO SUNRISE CHARDONNAY',750,12,13,1,0,1),
('01011080010807010750','90.227.000-0','3031-53-000540-013-000750-66-108-000037','VINO SUNRISE MERLOT',750,12,13.5,1,0,1),
('01011080010808010750','90.227.000-0','3031-53-000540-013-000750-66-108-000037','VINO SUNRISE CARMENERE',750,12,13.5,1,0,1),
('01011080010809010750','90.227.000-0','3031-53-000540-013-000750-66-108-000037','VINO SUNRISE SYRAH',750,12,13.5,1,0,1),
('01011080010810010750','90.227.000-0','3031-53-000540-013-000750-66-108-000037','VINO SUNRISE PINOT NOIR',750,12,13.5,1,0,1),
('01011080011003010750','90.227.000-0','3031-53-001978-013-000750-66-108-000046','VINO TRIO CAB. SAUV.',750,12,14.5,1,0,1),
('01011080011005010750','90.227.000-0','3031-53-001978-013-000750-66-108-000037','VINO TRIO CHARDONNAY',750,12,13.5,1,0,1),
('01011080011007010750','90.227.000-0','3031-53-001978-013-000750-66-108-000046','VINO TRIO MERLOT',750,12,14.5,1,0,1),
('01011080011114010750','90.227.000-0','3031-53-000540-013-000750-66-108-000029','VINO SAN BLAS AÑEJO DULCE',750,12,12.5,1,0,1),
('01011080011205010750','90.227.000-0','3031-53-000068-013-000750-66-108-000041','VINO AMELIA CHARDONNAY',750,6,14,1,0,1),
('01011080011303010750','90.227.000-0','3031-53-000057-013-000750-66-108-000046','VINO ALMAVIVA CAB. SAUV.',750,6,14.5,1,0,1),
('01011080011417010750','90.227.000-0','3031-53-000540-013-000750-66-108-000049','VINO CARMIN DE PEUMO',750,6,15,1,0,1),
('01011080011601010750','90.227.000-0','3031-53-013070-013-000750-66-108-000029','VINO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE',750,6,12.5,1,0,1),
('01011080011604010750','90.227.000-0','3031-53-013069-013-000750-66-108-000029','VINO EXPORTACION SELECTO SAUVIGNON BLANC',750,6,12.5,1,0,1),
('01021080010701030750','90.227.000-0','3031-56-000437-013-000750-66-108-000027','CHAMPAGNE CONCHA Y TORO BRUT CAJA6',750,6,12,1,0,1),
('01021080010702020750','90.227.000-0','3031-56-000437-013-000750-66-108-000027','CHAMPAGNE C Y T DEMISEC CAJA6',750,6,12,1,0,1),
('01011080050302010750','82.117.400-7','3031-53-001200-013-000750-66-108-000029','VINO MAIPO GRAN VINO BLANCO',750,12,12.5,1,0,1),
('01011080050303010750','82.117.400-7','3031-53-001200-013-000750-66-108-000033','VINO MAIPO VARIETAL CAB SAU.',750,12,13,1,0,1),
('01011080050307010750','82.117.400-7','3031-53-001200-013-000750-66-108-000033','VINO MAIPO VARIETAL MERLOT',750,12,13,1,0,1),
('01011080050703010750','82.117.400-7','3031-53-009781-013-000750-66-108-000037','VINO MAIPO VITRAL CAB SAUV',750,12,13.5,1,0,1),
('01011080050704010750','82.117.400-7','3031-53-009784-013-000750-66-108-000033','VINO MAIPO VITRAL SAUV BLANC',750,12,13,1,0,1),
('01011080050705010750','82.117.400-7','3031-53-009782-013-000750-66-108-000037','VINO MAIPO VITRAL CHARD',750,12,13.5,1,0,1),
('01011080050707010750','82.117.400-7','3031-53-009783-013-000750-66-108-000037','VINO MAIPO VITRAL MERLOT',750,12,13.5,1,0,1),
('01011080050709010750','82.117.400-7','3031-53-009785-013-000750-66-108-000037','VINO MAIPO VITRAL RED BLEND',750,12,13.5,1,0,1),
('01011010060205010750','30527196112','3031-53-014301-013-000750-66-101-000037','VINO BLANCO CHARDONNAY RUTINI',750,6,13.5,1,0,1),
('01011010060207010750','30527196112','3031-53-013264-013-000750-66-101-000106','VINO TINTO MERLOT RUTINI',750,6,13.9,1,0,1),
('01011010060217010750','30527196112','3031-53-014299-013-000750-66-101-000106','VINO TINTO CABERNET - MERLOT RUTINI',750,6,13.9,1,0,1),
('01011010060504010750','30527196112','3031-53-000767-013-000750-66-101-000037','VINO PEQUEÑA VASIJA SAUVIGN BLANC',750,6,13.5,1,0,1),
('01011010060506010750','30527196112','3031-53-000767-013-000750-66-101-000037','VINO PEQUEÑA VASIJA MALBEC',750,6,13.5,1,0,1),
('01011010060509010750','30527196112','3031-53-000767-013-000750-66-101-000037','VINO PEQUEÑA VASIJA SYRAH',750,6,13.5,1,0,1),
('01011010060517010750','30527196112','3031-53-000767-013-000750-66-101-000037','VINO PEQUEÑA VASIJA CAB.SAUV.SYRAH',750,6,13.5,1,0,1),
('01011080060117010750','30527196112','3031-53-000767-013-000750-66-108-000037','VINO FELIPE RUTINI',750,6,13.5,1,0,1),
('01011080060206010750','30527196112','3031-53-000522-013-000750-66-108-000033','VINO RUTINI COL. MALBEC',750,6,13,1,0,1),
('01011080060217010750','30527196112','3031-53-000522-013-000750-66-108-000033','VINO RUTINI COL. CAB/MALB',750,6,13,1,0,1),
('01011080060305010750','30527196112','3031-53-000767-013-000750-66-108-000037','VINO SAN FELIPE CHARDONNAY',750,6,13.5,1,0,1),
('01011080060306010750','30527196112','3031-53-000767-013-000750-66-108-000037','VINO SAN FELIPE MALBEC',750,6,13.5,1,0,1),
('01011080060405010750','30527196112','3031-53-002003-013-000750-66-108-000037','VINO TRUMPETER CHARDONNAY',750,6,13.5,1,0,1),
('01011080060406010750','30527196112','3031-53-002004-013-000750-66-108-000037','VINO TRUMPETER MALBEC',750,6,13.5,1,0,1),
('01011080060417010750','30527196112','3031-53-002004-013-000750-66-108-000037','VINO TRUMPETER MALBEC SYRAH',750,6,13.5,1,0,1),
('01012090100117010750','B26010710','3031-53-001357-013-000750-66-209-000037','VINO MUGA FERMENTADO EN BARRIC',750,6,13.5,1,0,1),
('01012090100217010750','B26010710','3031-53-001357-013-000750-66-209-000037','VINO MUGA GRAN RES PRADO ENEA',750,6,13.5,1,0,1),
('01012090100317010750','B26010710','3031-53-001357-013-000750-66-209-000033','VINO MUGA RESERVA COSECHA',750,6,13,1,0,1),
('01012090100317020750','B26010710','3031-53-001357-013-000750-66-209-000037','VINO MUGA RESERVA SELECCIN ES',750,6,13.5,1,0,1),
('01012090100417010750','B26010710','3031-53-001357-013-000750-66-209-000041','VINO MUGA TORRE',750,6,14,1,0,1),
('01012090550111010750','ESA11605276','3031-53-000191-013-000750-66-209-000041','VINO BERONIA TEMPRANILLO',750,6,14,1,0,1),
('01012090550211010750','ESA11605276','3031-53-000190-013-000750-66-209-000041','VINO BERONIA RESERVA',750,12,14,1,0,1),
('01012090550402010750','ESA11605276','3031-53-000186-013-000750-66-209-000037','VINO BERONIA BLANCO',750,12,13.5,1,0,1),
('01012090550411010750','ESA11605276','3031-53-000187-013-000750-66-209-000037','VINO BERONIA CRIANZA',750,12,13.5,1,0,1),
('01022093100102020750','ESA11605276','3031-56-019374-013-000750-66-209-000026','VINO ESPUMOSO DEMI SEC RESERVA CAVA VILARNAU BARCELONA',750,6,11.5,1,0,1),
('01022093100201010750','ESA11605276','3031-56-019375-013-000750-66-209-000026','VINO ESPUMOSO BRUT RESERVA CAVA VILARNAU BARCELONA',750,6,11.5,1,0,1),
('01022093120102010750','ESA11605276','3031-56-019378-013-000750-66-209-000026','VINO ESPUMOSO DEMI SEC CAVA DOM POTIER',750,6,11.5,1,0,1),
('01022093120201020750','ESA11605276','3031-56-019377-013-000750-66-209-000026','VINO ESPUMOSO BRUT CAVA DOM POTIER',750,6,11.5,1,0,1),
('01042093110101010750','ESA11605276','3031-53-019376-013-000750-66-209-000049','VINO DE JEREZ XERES SHERRY FINO MUY SECO PALOMINIO FINO TIO PEPE',750,12,15,1,0,1),
('02052091050304010700','ESA11605276','3031-19-019448-013-000700-66-209-000072','BRANDY DE JEREZ SOLERA GRAN RESERVA LEPANTO',700,6,36,1,0,1),
('02052091050405010700','ESA11605276','3031-19-001836-013-000700-66-209-000072','BRANDY SOLERA SOBERANO',700,6,36,1,0,1),
('02052091050405020700','ESA11605276','3031-19-001836-013-000700-66-209-000072','BRANDY SOLERA SOBERANO GIFT BOX',700,6,36,1,0,1),
('02072133150101010700','ESA11605276','3031-16-019447-013-000700-66-213-000083','ORIGINAL BLUE GIN THE LONDON',700,6,47,1,0,1),
('02082093090104021000','ESA11605276','3031-57-019373-013-001000-66-209-000080','CHINCHON SECO',1000,12,43,1,0,1),
('02082093090204011000','ESA11605276','3031-57-019372-013-001000-66-209-000071','CHINCHON DULCE',1000,12,35,1,0,1),
('01032240140201010750','1111111111111','3031-53-001490-013-000750-66-224-000057','OPORTO RUBY BARROS',750,12,20,1,0,1),
('01012020080321010750','DE213089937','3031-57-013130-013-000750-66-202-000133','VINO DESALCOHOLIZADO HENKELL',750,6,0.5,1,0,1),
('01022020080101010200','DE213089937','3031-53-000975-013-000200-66-202-000026','CHAMPAGNE HENKELL PICCOLO DRY',200,24,11.5,1,0,1),
('01022020080101010375','DE213089937','3031-53-000975-013-000375-66-202-000026','CHAMPAGNE HENKELL MEDIAS',375,12,11.5,1,0,1),
('01022020080101010750','DE213089937','3031-53-000975-013-000750-66-202-000026','CHAMPAGNE HENKELL TROKEN DRY',750,6,11.5,1,0,1),
('01022020080101020750','DE213089937','3031-53-000975-013-000750-66-202-000026','CHAMPAGNE HENKELL BRUT VINTAGE',750,12,11.5,1,0,1),
('01022020080101030750','DE213089937','3031-53-000975-013-000750-66-202-000027','CHAMPAGNE HENKELL BLANC DE BLA',750,6,12,1,0,1),
('01022020080101046000','DE213089937','3031-53-000975-013-006000-66-202-000026','CHAMPAGNE HENKELL TROKEN DRY 6000ML',6000,1,11.5,1,0,1),
('01022020080101053000','DE213089937','3031-53-000975-013-003000-66-202-000026','CHAMPAGNE HENKELL TROKEN DRY 3000ML',3000,1,11.5,1,0,1),
('01022020080101061500','DE213089937','3031-53-000975-013-001500-66-202-000026','CHAMPAGNE HENKELL TROKEN DRY 1500ML',1500,3,11.5,1,0,1),
('01022020080103010750','DE213089937','3031-56-011549-013-000750-66-202-000027','CHAMPAGNE HENKELL ROSE',750,6,12,1,0,1),
('01022190080206010200','DE213089937','3031-56-011550-013-000200-66-219-000024','VINO ESPUMANTE MIONETTO BLANCO',200,24,11,1,0,1),
('01022190080206010750','DE213089937','3031-56-011550-013-000750-66-219-000024','VINO ESPUMANTE MIONETTO BLANCO',750,12,11,1,0,1),
('01022190080206011500','DE213089937','3031-56-011550-013-001500-66-219-000024','VINO ESPUMANTE MIONETTO BLANCO',1500,6,11,1,0,1),
('01021010300201010750','20532416036','3031-53-001359-013-000750-66-101-000027','CHAMPAGNE MUMM CORDON ROUGE',750,6,12,1,0,1),
('01022130290101010750','20532416036','3031-53-001462-013-000750-66-213-000027','CHAMPAGNE PERRIER JOUET BELLE EPOQUE',750,6,12,1,0,1),
('01022130290201010750','20532416036','3031-53-001462-013-000750-66-213-000027','CHAMPAGNE PERRIER JOUET',750,6,12,1,0,1),
('01022130290201020750','20532416036','3031-53-001463-013-000750-66-213-000027','CHAMPAGNE PERRIER JOUET GRAND BRUT',750,6,12,1,0,1),
('02012130020102010750','20532416036','3031-18-000466-013-000750-66-213-000077','CHIVAS REGAL 18 AÑOS GIFT PACK',750,6,40,1,1,1),
('02012130020103010750','20532416036','3031-18-000466-013-000750-66-213-000077','WHISKY CHIVAS REGAL 12 AÑOS',750,12,40,1,1,1),
('02012130020103011000','20532416036','3031-18-000466-013-000750-66-213-000077','WHISKY CHIVAS 12 AÑOS LITRO',750,12,40,1,1,1),
('02012130020103020750','20532416036','3031-18-000466-013-000750-66-213-000077','WHISKY CHIVAS 12 AÑOS TIN BOX',750,12,40,1,1,1),
('02012130020103040750','20532416036','3031-18-000466-013-000750-66-213-000077','WHISKY CHIVAS 12 AÑOS TIN BOX - CAJA 6',750,6,40,1,1,1),
('02012130020104010750','20532416036','3031-18-000466-013-000750-66-213-000077','WHISKY CHIVAS 18 AÑOS',750,6,40,1,1,1),
('02012130020105010700','20532416036','3031-18-000466-013-000700-66-213-000077','WHISKY CHIVAS REGAL 25Y-700',700,3,40,1,1,1),
('02012130020199010750','20532416036','3031-18-000466-013-000750-66-202-000077','WHISKY CHIVAS 12 AÑOS CAMINERA',750,12,40,1,1,1),
('02012130020202010750','20532416036','3031-18-002474-013-000750-66-213-000077','WHISKY SOMETHING SPECIAL',750,12,40,1,1,1),
('02012130020302010750','20532416036','3031-18-000113-013-000750-66-213-000077','WHISKY BALLANTINES FINEST',750,12,40,1,1,1),
('02012130020302020750','20532416036','3031-18-000114-013-000750-66-213-000077','WHISKY BALLANTINES TIN BOX',750,6,40,1,1,1),
('02012130020302030750','20532416036','3031-18-000466-013-000750-66-213-000077','WHISKY BALLANTINES FINEST ZIP PACK',750,6,40,1,1,1),
('02012130020302040750','20532416036','3031-18-000113-013-000750-66-213-000077','WHISKY BALLANTINES FINEST CAJA6',750,6,40,1,1,1),
('02021070070101010750','20532416036','3031-13-000970-013-000750-66-107-000077','RON HAVANA CLUB 7 AÑOS',750,12,40,1,0,1),
('02021070070201010750','20532416036','3031-11-000969-013-000750-66-107-000077','RON HAVANA AÑEJO RESERVA',750,12,40,1,0,1),
('02021070070202010750','20532416036','3031-13-000971-013-000750-66-107-000077','RON HAVANA CLUB AÑEJO ESPECIAL',750,12,40,1,0,1),
('02021070070203010750','20532416036','3031-12-000972-013-000750-66-107-000077','RON HAVANA CLUB AÑEJO BLANCO',750,12,40,1,0,1),
('02021070070204010750','20532416036','3031-11-000754-013-000750-66-107-000077','RON HAVANA CLUB AÑEJO 3 AÑOS',750,12,40,1,0,1),
('02032260030101010750','20532416036','3031-15-002397-013-000750-66-226-000077','VODKA ABSOLUT',750,12,40,1,0,1),
('02072130160101010750','20532416036','3031-16-000178-013-000750-66-213-000077','GIN BEEFEATER',750,12,40,1,0,1),
('02082110130101010750','27552073371','3031-19-000940-013-000750-66-211-000077','LICOR GRAN MARNIER CORDON ROJO',750,12,40,1,0,1),
('02082110130101020750','27552073371','3031-19-000940-013-000750-66-211-000077','LICOR GRAN MARNIER CORDON ROJO PICTO PACK',750,6,40,1,0,1),
('02082110130101030700','27552073371','3031-19-000940-013-000700-66-211-000077','LICOR GRAN MARNIER CORDON ROJO BEL CREA',700,6,40,1,0,1);

-- -------------------------------------------------------------------
-- Incoterms
-- -------------------------------------------------------------------
