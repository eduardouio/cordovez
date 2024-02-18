<?php
/**
 * TEST ORDER FOB
 */

require_once '/var/www/html/cordovezapp/app/src/libraries/TributesCalc.php';
require_once '/var/www/html/cordovezapp/app/src/test/mocks/mockOrderTributesCalc.php';

use PHPUnit\Framework\TestCase;
use src\test\mocks\mockOrderTributesCalc;

class TestOrderTributesCalc extends TestCase
{
    private $tributesCalc;
    private $moock;
    
    
    function __construct(){
        parent::__construct();
    }
     
    
    function setUp(){
        
        $this->moock = new mockOrderTributesCalc();
        
        $mock =  $this->moock->getMockOrderFOB();
        $this->moock = $mock;
        
        $this->tributesCalc = new TributesCalc(
            $mock['order'],
            $mock['partial'],
            $mock['invoice'],
            $mock['invoice_detail'],
            $mock['param_taxes'],
            $mock['products_data'],
            $mock['apportionment'],
            $mock['is_order'],
            [],
            []
            );
    }
    
    
    function test_TotalFob(){
        $this->assertEquals(
            $this->tributesCalc->total_fob,
            15960.00
            );
    }
    
    function test_typeCange(){
        $this->assertEquals(
            $this->tributesCalc->type_change,
            1.15985
            );
    }
    
    function test_have_tasa(){
            $this->assertTrue($this->tributesCalc->have_tasa);
    }
    
    function test_exoneracion_aranceles(){
        $this->assertEquals($this->tributesCalc->exoneracion_arancel, 100);
    }
    
    
    function test_getProductData(){
        $product = [
         0 =>   [
                'cod_contable' => '01022110330101020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400, 
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3912.000,
                'valor_item' => 5280.00
            ],
          1 =>
            [
                'cod_contable' => '01022110330102020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY DEMI SEC CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3888.000,
                'valor_item' => 5280.00
            ],
           2=>
            [
                'cod_contable' => '01022110330103020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT ROSE CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.5000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11.5,
                'porcentaje' => 0.338,
                'peso' => 3864.000,
                'valor_item' => 5400.00
            ],
            
        ];
            
        $total_percent = 0;
        
        foreach ($this->moock['invoice_detail'] as $k => $detail){
            $product_base = $this->tributesCalc->getProductData($detail);
            $total_percent += $product_base['porcentaje'];
            $this->assertEquals( $product_base,$product[$k]);            
        }
        
        $this->assertEquals($total_percent, 1.0);
       
    }
    

    
    function test_getTaxesParams(){
        $this->assertEquals(
            $this->tributesCalc->getTaxesParams('ARANCEL ESPECIFICO') ,
            0.2500
            );
        
        $this->assertEquals(
            $this->tributesCalc->getTaxesParams('ARANCE'),
            0
            );
    }
    
    
    function test_getProrrateo(){
        $product = [
            0 =>   [
                'cod_contable' => '01022110330101020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3912.000,
                'valor_item' => 5280.00,               
            ],
            1 =>
            [
                'cod_contable' => '01022110330102020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY DEMI SEC CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3888.000,
                'valor_item' => 5280.00,
            ],
            2=>
            [
                'cod_contable' => '01022110330103020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT ROSE CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.5000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11.5,
                'porcentaje' => 0.338,
                'peso' => 3864.000,
                'valor_item' => 5400.00,               
            ],
            
        ];
        
        $new_product = [
            0 =>   [
                'cod_contable' => '01022110330101020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3912.000,
                'valor_item' => 5280.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 195.60000,
                'etiquetas_fiscales' => 312.00,
                'fob' => 6124.008,
                'seguro_aduana' => 28.81024,
                'flete_aduana' => 258.18000,
                'cif' => 6410.99824,
                
            ],
            1 =>
            [
                'cod_contable' => '01022110330102020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY DEMI SEC CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3888.000,
                'valor_item' => 5280.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 194.40000,
                'etiquetas_fiscales' => 312.0,
                'fob' => 6124.008,
                'seguro_aduana' => 28.81024,
                'flete_aduana' => 258.18000,
                'cif' => 6410.99824,
            ],
            2=>
            [
                'cod_contable' => '01022110330103020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT ROSE CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.5000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11.5,
                'porcentaje' => 0.338,
                'peso' => 3864.000,
                'valor_item' => 5400.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 193.20000,
                'etiquetas_fiscales' => 312.00,
                'fob' => 6263.19000,
                'seguro_aduana' => 29.41952,
                'flete_aduana' => 263.64000,
                'cif' => 6556.24952,
            ],
            
        ];
        
        foreach ($product as $k => $detail){
            $product_base = $this->tributesCalc->getProrrateo($detail);
            $this->assertEquals( $product_base,$new_product[$k]);
        }       
        
    }
    
    
    function test_taxesPoduct(){
        $product = [
            0 =>   [
                'cod_contable' => '01022110330101020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3912.000,
                'valor_item' => 5280.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 195.60000,
                'etiquetas_fiscales' => 312.00,
                'fob' => 6124.008,
                'seguro_aduana' => 28.81024,
                'flete_aduana' => 258.18000,
                'cif' => 6410.99824,
                
            ],
            1 =>
            [
                'cod_contable' => '01022110330102020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY DEMI SEC CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3888.000,
                'valor_item' => 5280.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 194.40000,
                'etiquetas_fiscales' => 312.0,
                'fob' => 6124.008,
                'seguro_aduana' => 28.81024,
                'flete_aduana' => 258.18000,
                'cif' => 6410.99824,
            ],
            2=>
            [
                'cod_contable' => '01022110330103020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT ROSE CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.5000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11.5,
                'porcentaje' => 0.338,
                'peso' => 3864.000,
                'valor_item' => 5400.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 193.20000,
                'etiquetas_fiscales' => 312.00,
                'fob' => 6263.19000,
                'seguro_aduana' => 29.41952,
                'flete_aduana' => 263.64000,
                'cif' => 6556.24952,
            ],
            
        ];
        
        $new_product = [
            0 =>   [
                'cod_contable' => '01022110330101020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3912.000,
                'valor_item' => 5280.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 195.60000,
                'etiquetas_fiscales' => 312.00,
                'fob' => 6124.008,
                'seguro_aduana' => 28.81024,
                'flete_aduana' => 258.18000,
                'cif' => 6410.99824,
                'fodinfa' => 32.05499,
                'arancel_advalorem' => 64.10998,
                'arancel_advalorem_liberado' => 64.10998,
                'arancel_advalorem_pagar' => 0.0,
                'arancel_especifico' => 4950.00,
                'arancel_especifico_liberado' => 4950.00,
                'arancel_especifico_pagar' => 0.0,
                'ice_especifico' => 1429.56,
                'base_advalorem' => 3.24,
                'exaduana_unitario' => 2.75275,
                'ice_advalorem' => 0.0,
                'total_ice' => 1429.56,
                'iva' => 1569.87879,
                'iva_liberado' => 601.6932,
                'iva_pagar' => 968.18559,
            ],
            1 =>
            [
                'cod_contable' => '01022110330102020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY DEMI SEC CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3888.000,
                'valor_item' => 5280.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 194.40000,
                'etiquetas_fiscales' => 312.0,
                'fob' => 6124.008,
                'seguro_aduana' => 28.81024,
                'flete_aduana' => 258.18000,
                'cif' => 6410.99824,
                'fodinfa' => 32.05499,
                'arancel_advalorem' => 64.10998,
                'arancel_advalorem_liberado' => 64.10998,
                'arancel_advalorem_pagar' => 0.0,
                'arancel_especifico' => 4950.00,
                'arancel_especifico_liberado' => 4950.00,
                'arancel_especifico_pagar' => 0.0,
                'ice_especifico' => 1429.56,
                'base_advalorem' => 3.24,
                'exaduana_unitario' =>2.75225,                
                'ice_advalorem' => 0.0,
                'total_ice' => 1429.56,
                'iva' => 1569.73479,
                'iva_liberado' => 601.69320,
                'iva_pagar' => 968.04159,
            ],
            2=>
            [
                'cod_contable' => '01022110330103020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT ROSE CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.5000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11.5,
                'porcentaje' => 0.338,
                'peso' => 3864.000,
                'valor_item' => 5400.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 193.20000,
                'etiquetas_fiscales' => 312.00,
                'fob' => 6263.19000,
                'seguro_aduana' => 29.41952,
                'flete_aduana' => 263.64000,
                'cif' => 6556.24952,
                'fodinfa' => 32.78125,
                'arancel_advalorem' => 65.56250,
                'arancel_advalorem_liberado' => 65.56250,
                'arancel_advalorem_pagar' => 0.0,
                'arancel_especifico' => 5175.00,
                'arancel_especifico_liberado' => 5175.00,
                'arancel_especifico_pagar' => 0.0,
                'ice_especifico' => 1494.54,
                'ice_advalorem' => 0.0,
                'base_advalorem' => 3.24,
                'exaduana_unitario' => 2.81227,
                'total_ice' => 1494.54,
                'iva' => 1622.07999,
                'iva_liberado' => 628.86750,
                'iva_pagar' => 993.21249,
            ],
            
        ];
        
        foreach ($product as $k => $detail){
            $product_base = $this->tributesCalc->getTaxesProduct($detail);
            $this->assertEquals( $product_base,$new_product[$k]);
        }   
    }
    
    
    function test_getTaxes(){
        
        $taxes['taxes'] = [
            0 =>   [
                'cod_contable' => '01022110330101020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3912.000,
                'valor_item' => 5280.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 195.60000,
                'etiquetas_fiscales' => 312.00,
                'fob' => 6124.008,
                'seguro_aduana' => 28.81024,
                'flete_aduana' => 258.18000,
                'cif' => 6410.99824,
                'fodinfa' => 32.05499,
                'arancel_advalorem' => 64.10998,
                'arancel_advalorem_liberado' => 64.10998,
                'arancel_advalorem_pagar' => 0.0,
                'arancel_especifico' => 4950.00,
                'arancel_especifico_liberado' => 4950.00,
                'arancel_especifico_pagar' => 0.0,
                'ice_especifico' => 1429.56,
                'base_advalorem' => 3.24,
                'exaduana_unitario' => 2.75275,
                'ice_advalorem' => 0.0,
                'total_ice' => 1429.56,
                'iva' => 1569.87879,
                'iva_liberado' => 601.6932,
                'iva_pagar' => 968.18559,
            ],
            1 =>
            [
                'cod_contable' => '01022110330102020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY DEMI SEC CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.2000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11,
                'porcentaje' => 0.331,
                'peso' => 3888.000,
                'valor_item' => 5280.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 194.40000,
                'etiquetas_fiscales' => 312.0,
                'fob' => 6124.008,
                'seguro_aduana' => 28.81024,
                'flete_aduana' => 258.18000,
                'cif' => 6410.99824,
                'fodinfa' => 32.05499,
                'arancel_advalorem' => 64.10998,
                'arancel_advalorem_liberado' => 64.10998,
                'arancel_advalorem_pagar' => 0.0,
                'arancel_especifico' => 4950.00,
                'arancel_especifico_liberado' => 4950.00,
                'arancel_especifico_pagar' => 0.0,
                'ice_especifico' => 1429.56,
                'base_advalorem' => 3.24,
                'exaduana_unitario' =>2.75225,
                'ice_advalorem' => 0.0,
                'total_ice' => 1429.56,
                'iva' => 1569.73479,
                'iva_liberado' => 601.69320,
                'iva_pagar' => 968.04159,
            ],
            2=>
            [
                'cod_contable' => '01022110330103020750',
                'nombre' => 'VINO ESPUMANTE VEUVE DU VERNAY BRUT ROSE CAJA 6',
                'cantidad_x_caja' => 6,
                'nro_cajas' => 400,
                'cajas_importadas' => 400,
                'unidades' => 2400,
                'costo_caja' => 13.5000000000,
                'capacidad_ml' => 750,
                'grado_alcoholico' => 11.5,
                'porcentaje' => 0.338,
                'peso' => 3864.000,
                'valor_item' => 5400.00,
                'gasto_origen' => 0.0,
                'tasa_control' => 193.20000,
                'etiquetas_fiscales' => 312.00,
                'fob' => 6263.19000,
                'seguro_aduana' => 29.41952,
                'flete_aduana' => 263.64000,
                'cif' => 6556.24952,
                'fodinfa' => 32.78125,
                'arancel_advalorem' => 65.56250,
                'arancel_advalorem_liberado' => 65.56250,
                'arancel_advalorem_pagar' => 0.0,
                'arancel_especifico' => 5175.00,
                'arancel_especifico_liberado' => 5175.00,
                'arancel_especifico_pagar' => 0.0,
                'ice_especifico' => 1494.54,
                'ice_advalorem' => 0.0,
                'base_advalorem' => 3.24,
                'exaduana_unitario' => 2.81227,
                'total_ice' => 1494.54,
                'iva' => 1622.07999,
                'iva_liberado' => 628.86750,
                'iva_pagar' => 993.21249,
            ],
            
        ];
        
        $taxes['sums'] = 
        [
            'cod_contable' => 0.0,
            'nombre' => 0.0,
            'cantidad_x_caja' => 18.0,
            'nro_cajas' => 1200.0,
            'cajas_importadas' => 1200.0,
            'unidades' => 7200.0,
            'costo_caja' => 39.90,
            'capacidad_ml' => 2250.0,
            'grado_alcoholico' => 33.5,
            'porcentaje' => 1.0,
            'peso' => 3912.00,
            'valor_item' => 15960.00,
            'gasto_origen' => 0.0,
            'tasa_control' => 583.20,
            'etiquetas_fiscales' => 936.00,
            'fob' => 18511.206,
            'seguro_aduana' => 87.03999999999999,
            'flete_aduana' => 780.00,
            'cif' => 19378.246,
            'fodinfa' => 96.89123,
            'arancel_advalorem' => 193.78246,
            'arancel_advalorem_liberado' => 193.78246,
            'arancel_advalorem_pagar' => 0.0,
            'arancel_especifico' => 15075.0,
            'arancel_especifico_liberado' => 15075.0,
            'arancel_especifico_pagar' => 0.0,
            'ice_especifico' => 4353.66,
            'ice_advalorem' => 0.0,
            'base_advalorem' => 9.72,
            'exaduana_unitario' => 8.31727,
            'total_ice' => 4353.66,
            'iva' => 4761.69357,
            'iva_liberado' => 1832.2539000000002,
            'iva_pagar' => 2929.43967
        ];             
        
        $this->assertEquals($this->tributesCalc->getTaxes(), $taxes );    
    }    
     
}
