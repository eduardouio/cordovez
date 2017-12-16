<?php

class Modelorderinvoice extends CI_Model
{   
    private $table = 'detalle_pedido_factura';
    private $modelBase;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->modelBase = new ModelBase();
    }
    
    
    /**
     * recupera los productos de una factura de productos
     * @param int $idOrderInvoice identificador de la tabla
     * @return array | boolean
     */
    public function getProducts(int $idOrderInvoice)
    {
        $products = $this->modelBase->get_table([
            'table' => $this->table,
            'where' =>[
                'id_pedido_factura' => $idOrderInvoice,
            ],
        ]);
        
        if ($products == false){
            return false;
        }
        return $products;
    }
}

