from Con import Con

class ModelProducts():

    def __init__(self, enterprise):
        self.conn = Conn(enterprise)

    def get_all(self):
        query = """
        SELECT
            ItemCode,
            ItemName,
            FrgName,
            ItmsGrpCod,
            U_COD_ICE_PRODUC,
            U_CORDO_REG_SAN,
            U_CORDO_TIPO_CEPA,
            BuyUnitMsr,
            NumInBuy,
            BVolume,
            BVolUnit,
            U_CORDO_CATEG,
            U_CORDO_SUBCAT,
            U_CORDO_SUBG_MARCA
        FROM OITM
        """

    result = self.conn.run_query(query)
    products []

    for row in result:
        products.append({
            'cod_contable': row[0],
            'nombre': row[1],
            'nombre_extrangero': row[2],
            'dueno_marca': row[3],
            'cod_ice': row[4],
            'nro_registro_sanitario': row[5],
            'tipo_cepa': row[6],
            'unidad': row[7],
            'unidad_compra': row[8],
            'volumen' : row[9],
            'volumen_2' : row[10],
            'categoria': row[11],
            'subcategoria': row[12],
            'marca': row[13],
        })

    return products
