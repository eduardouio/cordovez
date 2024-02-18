<?php
/**
 * TEST PARCIAL FOB
 */

require_once '/var/www/html/cordovezapp/app/src/test/mocks/MockParcialTributesCalc.php';

use PHPUnit\Framework\TestCase;
use src\test\mocks\moskParcialTributesCalc;

class TestParcialTributesCalc extends TestCase
{
    private $tributesCalc;
    private $mock;
    
    function __construct(){
        parent::__construct();
    }
    
    function setUp() {
        $mock = new moskParcialTributesCalc();       
        $this->mock = $mock->getMockOrderFOB();
        $this->tributesCalc = new TributesCalc(
            $this->mock['order'],
            $this->mock['partial'],
            $this->mock['invoice'],
            $this->mock['invoice_detail'],
            $this->mock['param_taxes'],
            $this->mock['products_data'],
            $this->mock['apportionment'],
            $this->mock['is_order']
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
    
}

