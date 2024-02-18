<?php

class PedidosLlegadosAlmagro extends MY_Controller
{
    
    private $modelOrder;
    private $modelOrderInvoice;
    private $modelBase;
    
    function __construct(){
        parent::__construct();
        $this->load->model('Modelorder');
        $this->load->model('Modelorderinvoice');
        $this->load->model('ModelBase');
        $this->modelOrder = new Modelorder();
        $this->modelBase = new ModelBase();
        $this->modelOrderInvoice = new Modelorderinvoice();
    }
    
    public function index(){
        $orders =  $this->modelOrder->getArrivedCellarByDate('2018', '10', True);        
        $reports = [];
        
        foreach ($orders as $k => $order){
            $order_invoice = $this->modelOrderInvoice->getCompleteInvoiceByOrder($order['nro_pedido']);
            foreach ($order_invoice['detail'] as $k => $product){                
                array_push( $reports, [
                    'numero' => $order['nro_pedido'],
                    'nombre_del_producto' => $product['product'],
                    'codigo_del_producto' => $product['cod_ice'] ,
                    'fecha_de_desaduanizacion' => $order['fecha_ingreso_almacenera'],
                    'pais' => $order['pais_origen'],
                    'cantidad_importada' => ($product['nro_cajas']),
                    'unidades' => $product['cantidad_x_caja'] * $product['nro_cajas'],
                    'fob_costo' => ($product['nro_cajas'] * $product['costo_caja'] * $order_invoice['tipo_cambio']),
                    'total_sin_ice' => 0,
                    'capacidad_ml' => $product['capacidad_ml'],
                    'grado_alcohólico' => $product['grado_alcoholico'],
                    'ex_aduana' => 0,
                    'ice_especifico' => 0,
                    'ice_advalorem' => 0,
                    'ice_unitario' => 0,
                    'ice_total' => 0,
                    'costo_total_ice_total' => 0,
                    'inventario' => 0,
                    'diferencia' => 0,
                    'costo_unitario' => 0,
                    'refrendo_type' => substr($order['nro_refrendo'],0,3),
                    'refrendo_year' => substr($order['nro_refrendo'],4,4),
                    'refrendo_reg' => substr($order['nro_refrendo'],9,2),
                    'refrendo_secu' => substr($order['nro_refrendo'],12,9),
                ]);
            }
        }
            
            print '<table border="1">';
            foreach ($reports as $k => $der){
                print '<tr>';
                print '<td>' . $der['numero'] . '</td>';
                print '<td>' . $der['nombre_del_producto'] . '</td>';
                print '<td>' . $der['codigo_del_producto'] . '</td>';
                print '<td>' . $der['fecha_de_desaduanizacion'] . '</td>';
                print '<td>' . $der['pais'] . '</td>';
                print '<td>' . $der['cantidad_importada'] . '</td>';
                print '<td>' . $der['unidades'] . '</td>';
                print '<td>' . $der['fob_costo'] . '</td>';
                print '<td>' . $der['total_sin_ice'] . '</td>';
                print '<td>' . $der['capacidad_ml'] . '</td>';
                print '<td>' . $der['grado_alcohólico'] . '</td>';
                print '<td>' . $der['ex_aduana'] . '</td>';
                print '<td>' . $der['ice_especifico'] . '</td>';
                print '<td>' . $der['ice_advalorem'] . '</td>';
                print '<td>' . $der['ice_unitario'] . '</td>';
                print '<td>' . $der['ice_total'] . '</td>';
                print '<td>' . $der['costo_total_ice_total'] . '</td>';
                print '<td>' . $der['inventario'] . '</td>';
                print '<td>' . $der['diferencia'] . '</td>';
                print '<td>' . $der['costo_unitario'] . '</td>';
                print '<td>' . $der['refrendo_type'] . '</td>';
                print '<td>' . $der['refrendo_year'] . '</td>';
                print '<td>' . $der['refrendo_reg'] . '</td>';
                print '<td>' . $der['refrendo_secu'] . '</td>';
                print '</tr>';
            }
            print '<table>';
        }
        
        
        public  function ice(){
            $query = [
                '11VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE';",
                '2CHAMPAGNE C Y T DEMISEC CAJA6' => "select nombre, cod_ice from producto where nombre ='CHAMPAGNE C Y T DEMISEC CAJA6';",
                '3VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE';",
                '4VINO RESERVADO MERLOT' => "select nombre, cod_ice from producto where nombre ='VINO RESERVADO MERLOT';",
                '5WHISKY SOMETHING SPECIAL' => "select nombre, cod_ice from producto where nombre ='WHISKY SOMETHING SPECIAL';",
                '6WHISKY SOMETHING SPECIAL' => "select nombre, cod_ice from producto where nombre ='WHISKY SOMETHING SPECIAL';",
                '7VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE';",
                '8WHISKY SOMETHING SPECIAL' => "select nombre, cod_ice from producto where nombre ='WHISKY SOMETHING SPECIAL';",
                '9VINO RESERVADO MERLOT' => "select nombre, cod_ice from producto where nombre ='VINO RESERVADO MERLOT';",
                '10VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE';",
                '11VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE';",
                '12VINO BLANCO EXPORTACION SELECTO SAUVIGNON BLANC' => "select nombre, cod_ice from producto where nombre ='VINO BLANCO EXPORTACION SELECTO SAUVIGNON BLANC';",
                '13VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE';",
                '14VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE';",
                '15RON HAVANA CLUB AÑEJO ESPECIAL' => "select nombre, cod_ice from producto where nombre ='RON HAVANA CLUB AÑEJO ESPECIAL';",
                '16VINO CLOS DE PIRQUE BLANCO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE BLANCO';",
                '17VINO CLOS DE PIRQUE TINTO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE TINTO';",
                '18VINO CLOS DE PIRQUE TINTO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE TINTO';",
                '19VINO RESERVADO CABERNET' => "select nombre, cod_ice from producto where nombre ='VINO RESERVADO CABERNET';",
                '20VINO CLOS DE PIRQUE TINTO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE TINTO';",
                '21VINO CLOS DE PIRQUE BLANCO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE BLANCO';",
                '22VINO CLOS DE PIRQUE TINTO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE TINTO';",
                '23VINO CLOS DE PIRQUE TINTO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE TINTO';",
                '24VINO CLOS DE PIRQUE TINTO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE TINTO';",
                '25VINO CLOS DE PIRQUE BLANCO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE BLANCO';",
                '26VINO CLOS DE PIRQUE BLANCO' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE BLANCO';",
                '27WHISKY CHIVAS REGAL 12 AÑOS' => "select nombre, cod_ice from producto where nombre ='WHISKY CHIVAS REGAL 12 AÑOS';",
                '28WHISKY SOMETHING SPECIAL' => "select nombre, cod_ice from producto where nombre ='WHISKY SOMETHING SPECIAL';",
                '29WHISKY BALLANTINES FINEST' => "select nombre, cod_ice from producto where nombre ='WHISKY BALLANTINES FINEST';",
                '30VINO CASILLERO MERLOT' => "select nombre, cod_ice from producto where nombre ='VINO CASILLERO MERLOT';",
                '31VINO RESERVADO CABERNET' => "select nombre, cod_ice from producto where nombre ='VINO RESERVADO CABERNET';",
                '32VINO RESERVADO CABERNET' => "select nombre, cod_ice from producto where nombre ='VINO RESERVADO CABERNET';",
                '33VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE';",
                '34WHISKY CHIVAS REGAL EXTRA' => "select nombre, cod_ice from producto where nombre ='WHISKY CHIVAS REGAL EXTRA';",
                '35VINO MAIPO CABER SAUV' => "select nombre, cod_ice from producto where nombre ='VINO MAIPO CABER SAUV';",
                '36VINO CLOS DE PIRQUE MERLOT' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE MERLOT';",
                '37VINO CLOS DE PIRQUE MERLOT' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE MERLOT';",
                '38VINO CLOS DE PIRQUE MERLOT' => "select nombre, cod_ice from producto where nombre ='VINO CLOS DE PIRQUE MERLOT';",
                '39WHISKY CHIVAS REGAL 12 AÑOS' => "select nombre, cod_ice from producto where nombre ='WHISKY CHIVAS REGAL 12 AÑOS';",
                '40WHISKY BALLANTINES FINEST' => "select nombre, cod_ice from producto where nombre ='WHISKY BALLANTINES FINEST';",
                '41JEREZ ALFONSO OLOROSO SECO' => "select nombre, cod_ice from producto where nombre ='JEREZ ALFONSO OLOROSO SECO';",
                '42JEREZ NECTAR DULCE' => "select nombre, cod_ice from producto where nombre ='JEREZ NECTAR DULCE';",
                '43BRANDY SOLERA SOBERANO' => "select nombre, cod_ice from producto where nombre ='BRANDY SOLERA SOBERANO';",
                '44BRANDY DE JEREZ SOLERA GRAN RESERVA LEPANTO' => "select nombre, cod_ice from producto where nombre ='BRANDY DE JEREZ SOLERA GRAN RESERVA LEPANTO';",
                '45VERMOUTH LA COPA' => "select nombre, cod_ice from producto where nombre ='VERMOUTH LA COPA';",
                '46WHISKY CHIVAS 18 AÑOS' => "select nombre, cod_ice from producto where nombre ='WHISKY CHIVAS 18 AÑOS';",
                '47VINO ESPUMOSO BRUT CAVA DOM POTIER' => "select nombre, cod_ice from producto where nombre ='VINO ESPUMOSO BRUT CAVA DOM POTIER';",
                '48VINO ESPUMOSO DEMI SEC CAVA DOM POTIER' => "select nombre, cod_ice from producto where nombre ='VINO ESPUMOSO DEMI SEC CAVA DOM POTIER';",
                '49WHISKY SOMETHING SPECIAL' => "select nombre, cod_ice from producto where nombre ='WHISKY SOMETHING SPECIAL';",
                '50WHISKY SOMETHING SPECIAL' => "select nombre, cod_ice from producto where nombre ='WHISKY SOMETHING SPECIAL';",
                '51VODKA WYBOROWA' => "select nombre, cod_ice from producto where nombre ='VODKA WYBOROWA';",
                '52VINO CASILLERO CABERNET' => "select nombre, cod_ice from producto where nombre ='VINO CASILLERO CABERNET';",
                '53GIN BEEFEATER 24' => "select nombre, cod_ice from producto where nombre ='GIN BEEFEATER 24';",
                '54WHISKY CHIVAS REGAL 12 AÑOS' => "select nombre, cod_ice from producto where nombre ='WHISKY CHIVAS REGAL 12 AÑOS';",
                '55WHISKY CHIVAS REGAL 12 AÑOS' => "select nombre, cod_ice from producto where nombre ='WHISKY CHIVAS REGAL 12 AÑOS';",
                '56VINO BERONIA CRIANZA' => "select nombre, cod_ice from producto where nombre ='VINO BERONIA CRIANZA';",
                '57VINO MARQUES CABERNET' => "select nombre, cod_ice from producto where nombre ='VINO MARQUES CABERNET';",
                '58VINO FRONTERA CABER SAUV' => "select nombre, cod_ice from producto where nombre ='VINO FRONTERA CABER SAUV';",
                '59VINO BLANCO EXPORTACION SELECTO SAUVIGNON BLANC' => "select nombre, cod_ice from producto where nombre ='VINO BLANCO EXPORTACION SELECTO SAUVIGNON BLANC';",
                '60VINO TINTO DARK RED DIABLO' => "select nombre, cod_ice from producto where nombre ='VINO TINTO DARK RED DIABLO';",
                '61VINO TINTO RED BLEND CASILLERO DEL DIABLO' => "select nombre, cod_ice from producto where nombre ='VINO TINTO RED BLEND CASILLERO DEL DIABLO';",
                '62VINO RESERVADO CABERNET' => "select nombre, cod_ice from producto where nombre ='VINO RESERVADO CABERNET';",
                '63VINO CASILLERO CHARDONNAY' => "select nombre, cod_ice from producto where nombre ='VINO CASILLERO CHARDONNAY';",
                '64VINO CASILLERO CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO CASILLERO CARMENERE';",
                '65VINO MARQUES MERLOT' => "select nombre, cod_ice from producto where nombre ='VINO MARQUES MERLOT';",
                '66VINO MARQUES CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO MARQUES CARMENERE';",
                "67VINO CASILLERO DEL DIABLO DEVIL'S COLLECTION BLANCO" => "select nombre, cod_ice from producto where nombre ='VINO CASILLERO DEL DIABLO DEVIL\'S COLLECTION BLANCO';",
                '68VINO CASILLERO RESERVA PRIVADA' => "select nombre, cod_ice from producto where nombre ='VINO CASILLERO RESERVA PRIVADA';",
                '69VINO SUNRISE SAUV. BLANC.' => "select nombre, cod_ice from producto where nombre ='VINO SUNRISE SAUV. BLANC.';",
                '70VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE' => "select nombre, cod_ice from producto where nombre ='VINO TINTO EXPORTACION SELECTO CABERNET SAUVIGNON CARMENERE';",
                '71VINO CASILLERO CABERNET' => "select nombre, cod_ice from producto where nombre ='VINO CASILLERO CABERNET';",
                '72WHISKY SOMETHING SPECIAL' => "select nombre, cod_ice from producto where nombre ='WHISKY SOMETHING SPECIAL';",
                '73WHISKY CHIVAS REGAL EXTRA' => "select nombre, cod_ice from producto where nombre ='WHISKY CHIVAS REGAL EXTRA';",
                '74VINO MUGA FERMENTADO EN BARRICA' => "select nombre, cod_ice from producto where nombre ='VINO MUGA FERMENTADO EN BARRICA';",
                '75VINO TINTO MUGA RESERVA COSECHA' => "select nombre, cod_ice from producto where nombre ='VINO TINTO MUGA RESERVA COSECHA';",
                '76VINO MUGA GRAND SERVA PRADO ENEA' => "select nombre, cod_ice from producto where nombre ='VINO MUGA GRAND SERVA PRADO ENEA';",
                '77CHAMPAGNE MUMM CORDON ROUGE' => "select nombre, cod_ice from producto where nombre ='CHAMPAGNE MUMM CORDON ROUGE';",
                '78CHAMPAGNE HENKELL BRUT VINTAGE' => "select nombre, cod_ice from producto where nombre ='CHAMPAGNE HENKELL BRUT VINTAGE';",
                '79CHAMPAGNE HENKELL TROKEN DRY' => "select nombre, cod_ice from producto where nombre ='CHAMPAGNE HENKELL TROKEN DRY';",
                '80CHAMPAGNE HENKELL PICCOLO DRY' => "select nombre, cod_ice from producto where nombre ='CHAMPAGNE HENKELL PICCOLO DRY';",
                '81CHAMPAGNE HENKELL BLANC DE BLA' => "select nombre, cod_ice from producto where nombre ='CHAMPAGNE HENKELL BLANC DE BLA';",
                '82CHAMPAGNE HENKELL ROSE' => "select nombre, cod_ice from producto where nombre ='CHAMPAGNE HENKELL ROSE';",
                '83CHAMPAGNE HENKELL BRUT VINTAGE' => "select nombre, cod_ice from producto where nombre ='CHAMPAGNE HENKELL BRUT VINTAGE';",
                '84CHAMPAGNE HENKELL TROKEN DRY' => "select nombre, cod_ice from producto where nombre ='CHAMPAGNE HENKELL TROKEN DRY';",
                '85VINO MARQUES CHARDONNAY' => "select nombre, cod_ice from producto where nombre ='VINO MARQUES CHARDONNAY';",
                '86VINO TINTO RESERVADO MALBEC ' => "select nombre, cod_ice from producto where nombre ='VINO TINTO RESERVADO MALBEC ';",
                '87CHAMP PERRIER JOUET GRAND BRUT' => "select nombre, cod_ice from producto where nombre ='CHAMP PERRIER JOUET GRAND BRUT';",
                '88WHISKY SOMETHING SPECIAL' => "select nombre, cod_ice from producto where nombre ='WHISKY SOMETHING SPECIAL';",
            ];
            
            $x = 0;
            foreach ($query as $product => $query) {
                $x++;
                print '<table border="1">';
                print '<tr>';
                print '<td>' . $product . '</td>';
                print '<td>';
                $result = $this->modelBase->runQuery($query);
                $cod_ice = 'Completar';
                
                if($result){
                    $cod_ice = $result[0]['cod_ice'];
                }
                
                print $cod_ice;
                print '</td>';
                print '</tr>';
                print '</table>';                
            }
        }
        
}



