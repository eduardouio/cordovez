#! /usr/bin/python
# encoding=utf8

'''
Modelo encargado de eliminar un pedido completo
@package CordovezApp
@author Eduardo Villota <eduardouio7@gmail.com>
@copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
@license Derechos reservados Agencias y Representaciones Cordovez S.A.
@link https://gitlab.com/eduardo/APPImportaciones
@since Version 1.0.0
@filesource
'''
import pyodbc
import json
from decimal import Decimal

class SAPConector(object):
    '''
    Objeto de coneccion a la base de datos
    '''
    def __init__(self, year):
        server = '192.168.0.189'
        database = 'DB_CORDOVEZ_PROD'
        username = 'appimpor'
        password = 'vinesa.2018'
        cnxn = pyodbc.connect('DRIVER=/opt/microsoft/msodbcsql/lib64/libmsodbcsql-13.1.so.9.2;SERVER='+server+';DATABASE='+database+';UID='+username+';PWD='+ password)
        self.year = year
        self.cursor = cnxn.cursor()
            

    def run_query(self, query):    
        self.cursor.execute(query)
        return self.cursor.fetchall()


    def getAll(self):   	
        orders = self.get_orders()
        return orders


    #obtiene el listado de todos los pedidos    
    def get_orders(self):
        orders_array = []        
        query = '''
                SELECT 
                    DocNum, DocEntry, CardCode, CardName, NumAtCard, 
                    DocCur, U_CORDO_REF_IMP, U_CORDO_PTO_EMB,U_CORDO_TIPO_NEG, 
                    U_NUM_AUTOR, DocRate, DocTotal, U_CORDO_FLETE, U_CORDO_SEGURO, 
                    Max1099,Comments  
                FROM opor
                WHERE  U_CORDO_REF_IMP LIKE '%/18'
                '''
        #tranformamos a a arreglo para poder trabajar
        orders = self.run_query(query)
        for row in orders:                      
            new_row  = {
                'DocNum' : row[0] ,
                'DocEntry' : row[1],
                'CardCode' : row[2],
                'CardName' : row[3].decode(encoding='UTF-8'),
                'NumAtCard' : row[4],
                'DocCur' : row[5],
                'U_CORDO_REF_IMP' : row[6],
                'U_CORDO_PTO_EMB' : row[7],
                'U_CORDO_TIPO_NEG' : row[8],
                'U_NUM_AUTOR' : row[9],
                'DocRate' : str(row[10]),
                'DocTotal' : str(row[11]),
                'U_CORDO_FLETE' : str(row[12]),
                'U_CORDO_SEGURO' : str(row[13]),
                'Max1099' : str(row[14]),
                'Comments' : row[15],
                'OrderItems' : self.get_order_items(row[1]),
                #'Supplier' : self.get_supplier(row[2]),
            }                
            
            orders_array.append(new_row)

        return orders_array


    def get_order_items(self, doc_entry):
        query = '''
            SELECT  DocEntry,ItemCode, Dscription, Price, Currency, Quantity, 
                    LineTotal, PriceBefDi,PriceAfVAT,INMPrice,GTotal,DocDate,
                    BaseCard, TotalSumSy, unitMsr, NumPerMsr, InvQty 
            FROM por1 
            WHERE DocEntry = 'doc_entry'
        '''   
        items_array = [];    
        items_order = self.run_query(query.replace('doc_entry', str(doc_entry)))
        for row in items_order:
            new_row  = {
                'DocEntry' : row[0],
                'ItemCode' : row[1], 
                'Dscription' : row[2].decode(encoding='UTF-8'), 
                'Price' : str(row[3]), 
                'Currency' : row[4], 
                'Quantity' : str(row[5]), 
                'LineTotal' : str(row[6]), 
                'PriceBefDi' : str(row[7]),
                'PriceAfVAT' : str(row[8]),
                'INMPrice' : str(row[9]),
                'GTotal' : str(row[10]),
                'DocDate' : row[11].strftime("%Y-%m-%d %H:%M:%S"),
                'BaseCard' : row[12], 
                'TotalSumSy' : str(row[13]), 
                'unitMsr' : row[14], 
                'NumPerMsr' : str(row[15]), 
                'InvQty' : str(row[16]),
                'ProductInfo' : self.get_product_data(row[1])
            }        
        return items_array
        
    
    def get_product_data(self, item_code):
        if item_code is None:
            return []
        query = '''
        SELECT  ItemCode, ItemName, U_COD_ICE_PRODUC, 
                U_CAPACIDAD, U_GRADO_ALC
        FROM oitm
        WHERE ItemCode = 'item_code'
        '''        
        product_array = [];            
        product = self.run_query(query.replace('item_code', str(item_code)))
        for row in product:            
            new_row  = {
                'ItemCode' : row[0], 
                'ItemName' : row[1].decode(encoding='UTF-8'),                 
                'U_COD_ICE_PRODUC' : row[2], 
                'U_CAPACIDAD' : row[3], 
                'U_GRADO_ALC' : row[4], 
            }                    
            product_array.append(new_row)  
        return product_array


    def get_supplier(self, card_code):
        query = '''
        SELECT  CardCode, CardName, CardType, Address, Phone1, Phone2, Notes, 
                City, Country, E_mail  FROM OCRD 
        WHERE  CardCode = 'card_code'
        '''
        supplier_array = [];            
        supplier = self.run_query(query.replace('card_code', str(card_code)))

        for row in supplier:
            for column in row:
                if(isinstance(column, Decimal)):
                    column = str(column)
            new_row  = {
                'CardCode' : row[0], 
                'CardName' : row[1], 
                'CardType' : row[2], 
                'Address' : row[3], 
                'Phone1' : row[4], 
                'Phone2' : row[5], 
                'Notes' : row[6], 
                'City' : row[7], 
                'Country' : row[8], 
                'E_mail' : row[9]  
            }             
            supplier_array.append(new_row)        
        
        #print json.dumps(supplier_array)
        return supplier_array


# llamada a la clase principal
if __name__ == '__main__':
    import sys, json
    year = sys.argv[2]
    reload(sys)
    sys.setdefaultencoding('utf8')
    sap_conector = SAPConector(year)
    
    orders = sap_conector.getAll()
    print orders