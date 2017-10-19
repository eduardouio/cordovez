<?php

/* base/sections/show-pedido.html.twig */
class __TwigTemplate_604d75745dea67ef973bd608918bdf5cb44f50f5f9ab5def36707be8576de3ce extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Saldo:</strong> <span class=\"text-success\">  0.00 </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Parciales:</strong> <span class=\"text-danger\">0.00</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Compra:</strong> <span class=\"text-info\">0.00</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Fecha Registro:</strong> ";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "date_create", array()), "html", null, true);
        echo "
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Moneda:</strong> <span></span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Tipo de Cambio:</strong> <span>";
        // line 21
        echo 1;
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>provisiones:</strong> <span class=\"text-danger\">";
        // line 24
        echo 0;
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["createBy"] ?? null), 0, array(), "array"), "nombres", array(), "array"), "html", null, true);
        echo "</span>
      </div>
   </div>
</div>
<!-- Tabs -->
<div>
   <ul class=\"nav nav-tabs\" role=\"tablist\">
      <li role=\"presentation\" class=\"active\"><a href=\"#pedido\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"pedido\">Detalle Pedido &nbsp;<span class=\"label label-success\">Abierto</span></a></li>
      <li role=\"presentation\"><a href=\"#facturas\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"facturas\">Facturas Productos</a></li>
      <li role=\"presentation\"><a href=\"#gastos\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"gastos\">Gastos Iniciales</a></li>
      <li role=\"presentation\"><a href=\"#nacionalizaciones\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"nacionalizaciones\">Nacionalizaciones</a></li>
      <li role=\"presentation\"><a href=\"#impuestos\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"impuestos\">Impuestos</a></li>
      <li role=\"presentation\"><a href=\"#facturasServicios\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"facturasfacturasServicios\">Facturas Servicios</a></li>
   </ul>
   <br>
   <br>
   <div class=\"tab-content\">
      <div role=\"tabpanel\" class=\"tab-pane active\" id=\"pedido\">
         <div class=\"row\">
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" >PEDIDO</span>
                  <span class=\"form-control\">";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">RÉGIMEN</span>
                  <span class=\"form-control\">";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "regimen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">INCOTERM</span>
                  <span class=\"form-control\">";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "incoterm", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">PAIS</span>
                  <span class=\"form-control\"> ";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "pais_origen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">CIUDAD</span>
                  <span class=\"form-control\">";
        // line 73
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "ciudad_origen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">SEGURO SENAE</span>
                  <span class=\"form-control\"> ";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "seguro_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">FLETE SENAE</span>
                  <span class=\"form-control\" > ";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "flete_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">ARRIBO</span>
                  <span class=\"form-control\" > ";
        // line 94
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "fecha_arribo", array()), "m/d/Y"), "html", null, true);
        echo "  </span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-12\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" id=\"basic-addon3\">COMENTARIOS</span>
                  <span type=\"text\" class=\"form-control\">";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "comentarios", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
            <div class=\"col-md-6\">
               <hr>
               <a href=\"";
        // line 110
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"text-primary\">
                  <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar</button></a>
               <a href=\"";
        // line 112
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/eliminar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo "\">
                  <button class=\"btn btn-sm btn-default\"> <span class=\"fa fa-trash fa-fw\"></span>Elimnar</button></a>
            </div>
         </div>
         <!-- /tabPedido-->
      </div>
      <!-- /tabFacturas-->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturas\">
         <div class=\"row\">
            <div class=\"col-sm-6\">
               <a href=\"";
        // line 122
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedidofactura/nuevo/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Factura Productos
               </button>
               </a>
            </div>
                <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Unidades: </small> <span id=\"suma\"> ";
        // line 130
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["unidades"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Suma: </small> <span id=\"suma\"> ";
        // line 133
        echo ($context["simbolo"] ?? null);
        echo " ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["suma"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Diferencia: </small> <span id=\"suma\"> ";
        // line 136
        echo ($context["simbolo"] ?? null);
        echo " ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["diferencia"] ?? null), 2, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-sm-12\">
               <table class=\"table table-hover table-bordered table-striped\">
         <thead>
            <tr style=\"background-color: #c1c1c1;\">
               <th>#</th>
               <th>Nro Factura</th>
               <th>Proveedor</th>
               <th>F Emision</th>
               <th>F Vencimiento</th>
               <th>Moneda</th>
               <th>Valor</th>
               <th>Retirado</th>
               <th>Saldo</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            ";
        // line 158
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "orderInvoices", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["orderInvoice"]) {
            // line 159
            echo "            <tr>
               <td>";
            // line 160
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
                  <a href=\"";
            // line 162
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
               ";
            // line 163
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
            </a>
            </td>               
               <td>
                  <a href=\"";
            // line 167
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_proveedor", array()), "html", null, true);
            echo "\">
               ";
            // line 168
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "nombre", array()), "html", null, true);
            echo "                     
                  </a>
               </td>               
               <td>";
            // line 171
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 172
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "vencimiento_pago", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 173
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "moneda", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 174
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>                         
               <td>";
            // line 175
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>                         
               <td>";
            // line 176
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>                         
               <td> 
                   <div class=\"dropdown\">
                           <button class=\"btn btn-sm btn-default\" id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                           Acciones <span class=\"fa fa-list fa-fw\" ></span>
                            <span class=\"caret\"></span>
                          </button>
                          <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                            <li> 
                              <a href=\"";
            // line 185
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"fa fa-eye fa-fw\"></span>
                              Ver Productos
                           </a> 
                           </li>
                            <li> 
                              <a href=\"";
            // line 191
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> ";
            // line 194
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 197
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             ";
            // line 201
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
                              </span>
                          </a> 
                          </li>
                          </ul>
                        </div>
               </td>               
            </tr>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['orderInvoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 210
        echo "         </tbody>
      </table>
            </div>
         </div>
         <!-- table -- >
            <!-- /table -- >
      </div>
            <!-- /Tab Facturas-->
      </div>
      <!-- Gastos iniciales -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"gastos\">
         <div class=\"row\">
            <div class=\"col-sm-6\">
               ";
        // line 223
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "regimen", array()) == 70)) {
            // line 224
            echo "               <a href=\"";
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
            echo "\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Inicial <span class=\"label label-warning\">provisionado</span>
               </button>
               </a>
               ";
        } else {
            // line 231
            echo "                  <h5 class=\"text-primary\">GASTOS INICIALES RÉGIMEN 10</h5>
               ";
        }
        // line 233
        echo "            </div>

            ";
        // line 235
        $context["cantidad"] = 0;
        // line 236
        echo "            ";
        $context["provisionado"] = 0;
        // line 237
        echo "            ";
        $context["convalidado"] = 0;
        // line 238
        echo "
            ";
        // line 239
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "initialExpenses", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["initialExpense"]) {
            // line 240
            echo "               ";
            $context["cantidad"] = (($context["cantidad"] ?? null) + 1);
            // line 241
            echo "               ";
            $context["provisionado"] = (($context["provisionado"] ?? null) + $this->getAttribute($context["initialExpense"], "valor_provisionado", array()));
            // line 242
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initialExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 243
        echo "
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Cantidad: </small> <span id=\"suma\"> ";
        // line 245
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["cantidad"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Provisionado: </small> <span id=\"suma\"> \$ ";
        // line 248
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["provisionado"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Convalidado: </small> <span id=\"suma\"> \$ ";
        // line 251
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["Convalidado"] ?? null), 2, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-sm-12\">
               <table class=\"table table-hover table-bordered table-striped\">
         <thead>
            <tr style=\"background-color: #c1c1c1;\">
               <th>#</th>
               <th>Concepto</th>
               <th>Proveedor</th>
               <th>Comentarios</th>
               <th>Fecha</th>
               <th>Valor</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            ";
        // line 270
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "initialExpenses", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["initialExpense"]) {
            // line 271
            echo "            <tr>
               <td>";
            // line 272
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
               <a href=\"";
            // line 274
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
               ";
            // line 275
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "concepto", array()), "html", null, true);
            echo "
               </a>
            </td>               
               <td>
                  <a href=\"";
            // line 279
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_proveedor", array()), "html", null, true);
            echo "\">
                     ";
            // line 280
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "nombre", array()), "html", null, true);
            echo "
                  </a>
               </td>  
               <td>";
            // line 283
            echo $this->getAttribute($context["initialExpense"], "comentarios", array());
            echo "</td>            
               <td>";
            // line 284
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["initialExpense"], "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>               
               <td>";
            // line 285
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["initialExpense"], "valor_provisionado", array()), 2, ".", ","), "html", null, true);
            echo "</td>               
               <td> 
                   <div class=\"dropdown\">
                           <button class=\"btn btn-sm btn-default\" id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                           Acciones <span class=\"fa fa-list fa-fw\" ></span>
                            <span class=\"caret\"></span>
                          </button>
                          <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                            <li> 
                              <a href=\"";
            // line 294
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
                              <span class=\"fa fa-eye fa-fw\"></span>
                              Detalle Gasto Inicial
                           </a> 
                           </li>
                            <li> 
                              <a href=\"";
            // line 300
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Gasto Inicial
                              <span class=\"label label-success\"> ";
            // line 303
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 306
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Gasto Inicial
                              <span class=\"label label-danger\">
                             ";
            // line 310
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "
                              </span>
                          </a>   
                          </li>
                          </ul>
                        </div>
               </td>               
            </tr>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initialExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 319
        echo "         </tbody>
      </table>
            </div>
         </div>
      </div>
      <!-- /Gastos iniciales -->
      <!-- factura Nacionalizaciones -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"nacionalizaciones\">
         <br>
         <div class=\"row\">
            <div class=\"col-sm-12\">
               <table class=\"table table-hover table-bordered table-striped\">
         <thead>
            <tr style=\"background-color: #c1c1c1;\">
               <th>#</th>
               <th>Nro Fact</th>
               <th>Proveedor</th>
               <th>Fecha</th>
               <th>Valor</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            ";
        // line 342
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "nationalizations", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["nationalization"]) {
            // line 343
            echo "            <tr>
               <td>";
            // line 344
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
               ";
            // line 346
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "nro_factura_informativa", array()), "html", null, true);
            echo "
            </td>               
               <td>
                  <a href=\"";
            // line 349
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
                     ";
            // line 350
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "identificacion_proveedor", array()), "html", null, true);
            echo "
                  </a>
               </td>               
               <td>";
            // line 353
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>               
               <td>";
            // line 354
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>               
               <td> 
                   <div class=\"dropdown\">
                           <button class=\"btn btn-sm btn-default\" id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                           Acciones <span class=\"fa fa-list fa-fw\" ></span>
                            <span class=\"caret\"></span>
                          </button>
                          <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                            <li> 
                              <a href=\"";
            // line 363
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"fa fa-eye fa-fw\"></span>
                              Ver Productos
                           </a> 
                           </li>
                            <li> 
                              <a href=\"";
            // line 369
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-plus fa-fw\"></span>
                              Agregar Producto
                           </a> 
                           </li>
                            <li> 
                              <a href=\"";
            // line 375
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> ";
            // line 378
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 381
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             ";
            // line 385
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_factura_proveedor", array()), "html", null, true);
            echo "
                              </span>
                          </a>   
                          </li>
                          </ul>
                        </div>
               </td>               
            </tr>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nationalization'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 394
        echo "         </tbody>
      </table>
            </div>
         </div>
      </div>
      <!-- /factura Nacionalizaciones -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"impuestos\">
      </div>
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturasServicios\">
      </div>
   </div>
</div>
<!--/tabs-->
<!-- modal facturas produtos -->

";
    }

    public function getTemplateName()
    {
        return "base/sections/show-pedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  766 => 394,  743 => 385,  734 => 381,  728 => 378,  720 => 375,  709 => 369,  698 => 363,  686 => 354,  682 => 353,  676 => 350,  670 => 349,  664 => 346,  659 => 344,  656 => 343,  639 => 342,  614 => 319,  591 => 310,  582 => 306,  576 => 303,  568 => 300,  557 => 294,  545 => 285,  541 => 284,  537 => 283,  531 => 280,  525 => 279,  518 => 275,  512 => 274,  507 => 272,  504 => 271,  487 => 270,  465 => 251,  459 => 248,  453 => 245,  449 => 243,  443 => 242,  440 => 241,  437 => 240,  433 => 239,  430 => 238,  427 => 237,  424 => 236,  422 => 235,  418 => 233,  414 => 231,  401 => 224,  399 => 223,  384 => 210,  361 => 201,  352 => 197,  346 => 194,  338 => 191,  327 => 185,  315 => 176,  311 => 175,  307 => 174,  303 => 173,  299 => 172,  295 => 171,  289 => 168,  283 => 167,  276 => 163,  270 => 162,  265 => 160,  262 => 159,  245 => 158,  218 => 136,  210 => 133,  204 => 130,  191 => 122,  176 => 112,  169 => 110,  159 => 103,  147 => 94,  138 => 88,  129 => 82,  117 => 73,  108 => 67,  99 => 61,  90 => 55,  81 => 49,  56 => 27,  50 => 24,  44 => 21,  33 => 13,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Saldo:</strong> <span class=\"text-success\">  0.00 </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Parciales:</strong> <span class=\"text-danger\">0.00</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Compra:</strong> <span class=\"text-info\">0.00</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Fecha Registro:</strong> {{ viewData.order.0.date_create }}
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Moneda:</strong> <span></span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Tipo de Cambio:</strong> <span>{{1.00}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>provisiones:</strong> <span class=\"text-danger\">{{0.00}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>{{createBy[0]['nombres']}}</span>
      </div>
   </div>
</div>
<!-- Tabs -->
<div>
   <ul class=\"nav nav-tabs\" role=\"tablist\">
      <li role=\"presentation\" class=\"active\"><a href=\"#pedido\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"pedido\">Detalle Pedido &nbsp;<span class=\"label label-success\">Abierto</span></a></li>
      <li role=\"presentation\"><a href=\"#facturas\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"facturas\">Facturas Productos</a></li>
      <li role=\"presentation\"><a href=\"#gastos\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"gastos\">Gastos Iniciales</a></li>
      <li role=\"presentation\"><a href=\"#nacionalizaciones\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"nacionalizaciones\">Nacionalizaciones</a></li>
      <li role=\"presentation\"><a href=\"#impuestos\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"impuestos\">Impuestos</a></li>
      <li role=\"presentation\"><a href=\"#facturasServicios\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"facturasfacturasServicios\">Facturas Servicios</a></li>
   </ul>
   <br>
   <br>
   <div class=\"tab-content\">
      <div role=\"tabpanel\" class=\"tab-pane active\" id=\"pedido\">
         <div class=\"row\">
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" >PEDIDO</span>
                  <span class=\"form-control\">{{viewData.order.0.nro_pedido}} </span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">RÉGIMEN</span>
                  <span class=\"form-control\">{{viewData.order.0.regimen }}</span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">INCOTERM</span>
                  <span class=\"form-control\">{{viewData.order.0.incoterm}} </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">PAIS</span>
                  <span class=\"form-control\"> {{viewData.order.0.pais_origen}}</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">CIUDAD</span>
                  <span class=\"form-control\">{{viewData.order.0.ciudad_origen}}</span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">SEGURO SENAE</span>
                  <span class=\"form-control\"> {{viewData.order.0.seguro_aduana }}</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">FLETE SENAE</span>
                  <span class=\"form-control\" > {{viewData.order.0.flete_aduana  }}</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">ARRIBO</span>
                  <span class=\"form-control\" > {{viewData.order.0.fecha_arribo | date(\"m/d/Y\") }}  </span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-12\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" id=\"basic-addon3\">COMENTARIOS</span>
                  <span type=\"text\" class=\"form-control\">{{viewData.order.0.comentarios}} </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
            <div class=\"col-md-6\">
               <hr>
               <a href=\"{{rute_url}}/pedido/editar/{{viewData.order.0.nro_pedido}}\" class=\"text-primary\">
                  <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar</button></a>
               <a href=\"{{rute_url}}/pedido/eliminar/{{viewData.order.0.nro_pedido}}\">
                  <button class=\"btn btn-sm btn-default\"> <span class=\"fa fa-trash fa-fw\"></span>Elimnar</button></a>
            </div>
         </div>
         <!-- /tabPedido-->
      </div>
      <!-- /tabFacturas-->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturas\">
         <div class=\"row\">
            <div class=\"col-sm-6\">
               <a href=\"{{rute_url}}pedidofactura/nuevo/{{viewData.order.0.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Factura Productos
               </button>
               </a>
            </div>
                <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Unidades: </small> <span id=\"suma\"> {{ unidades | number_format(0, '.', ',') }} </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Suma: </small> <span id=\"suma\"> {{ simbolo | raw}} {{ suma | number_format(2, '.', ',')}}</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Diferencia: </small> <span id=\"suma\"> {{ simbolo | raw}} {{ diferencia | number_format(2, '.', ',') }} </span></h5>
    </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-sm-12\">
               <table class=\"table table-hover table-bordered table-striped\">
         <thead>
            <tr style=\"background-color: #c1c1c1;\">
               <th>#</th>
               <th>Nro Factura</th>
               <th>Proveedor</th>
               <th>F Emision</th>
               <th>F Vencimiento</th>
               <th>Moneda</th>
               <th>Valor</th>
               <th>Retirado</th>
               <th>Saldo</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            {% for orderInvoice in viewData.orderInvoices %}
            <tr>
               <td>{{loop.index}}</td>
               <td>
                  <a href=\"{{rute_url}}pedidofactura/presentar/{{orderInvoice.id_pedido_factura}}\">
               {{orderInvoice.id_factura_proveedor}}
            </a>
            </td>               
               <td>
                  <a href=\"{{rute_url}}proveedor/presentar/{{orderInvoice.id_proveedor}}\">
               {{orderInvoice.nombre}}                     
                  </a>
               </td>               
               <td>{{orderInvoice.fecha_emision}}</td>               
               <td>{{orderInvoice.vencimiento_pago}}</td>               
               <td>{{orderInvoice.moneda}}</td>               
               <td>{{orderInvoice.valor}}</td>                         
               <td>{{orderInvoice.valor}}</td>                         
               <td>{{orderInvoice.valor}}</td>                         
               <td> 
                   <div class=\"dropdown\">
                           <button class=\"btn btn-sm btn-default\" id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                           Acciones <span class=\"fa fa-list fa-fw\" ></span>
                            <span class=\"caret\"></span>
                          </button>
                          <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                            <li> 
                              <a href=\"{{rute_url}}pedidofactura/presentar/{{orderInvoice.id_pedido_factura}}\">
                              <span class=\"fa fa-eye fa-fw\"></span>
                              Ver Productos
                           </a> 
                           </li>
                            <li> 
                              <a href=\"{{rute_url}}pedidofactura/editar/{{orderInvoice.id_pedido_factura}}\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> {{orderInvoice.id_factura_proveedor}}</span></a> 
                           </li>
                            <li>
                             <a href=\"{{rute_url}}pedidofactura/eliminar/{{orderInvoice.id_pedido_factura}}\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             {{orderInvoice.id_factura_proveedor}}
                              </span>
                          </a> 
                          </li>
                          </ul>
                        </div>
               </td>               
            </tr>
            {% endfor %}
         </tbody>
      </table>
            </div>
         </div>
         <!-- table -- >
            <!-- /table -- >
      </div>
            <!-- /Tab Facturas-->
      </div>
      <!-- Gastos iniciales -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"gastos\">
         <div class=\"row\">
            <div class=\"col-sm-6\">
               {% if viewData.order.0.regimen == 70 %}
               <a href=\"{{rute_url}}gstinicial/nuevo/{{viewData.order.0.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Inicial <span class=\"label label-warning\">provisionado</span>
               </button>
               </a>
               {% else %}
                  <h5 class=\"text-primary\">GASTOS INICIALES RÉGIMEN 10</h5>
               {% endif %}
            </div>

            {% set cantidad = 0 %}
            {% set provisionado = 0.0 %}
            {% set convalidado = 0.00 %}

            {% for initialExpense in viewData.initialExpenses %}
               {% set cantidad = cantidad + 1 %}
               {% set provisionado = provisionado + initialExpense.valor_provisionado %}
            {% endfor %}

    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Cantidad: </small> <span id=\"suma\"> {{ cantidad | number_format(0, '.', ',') }} </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Provisionado: </small> <span id=\"suma\"> \$ {{ provisionado | number_format(2, '.', ',')}}</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Convalidado: </small> <span id=\"suma\"> \$ {{ Convalidado | number_format(2, '.', ',') }} </span></h5>
    </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-sm-12\">
               <table class=\"table table-hover table-bordered table-striped\">
         <thead>
            <tr style=\"background-color: #c1c1c1;\">
               <th>#</th>
               <th>Concepto</th>
               <th>Proveedor</th>
               <th>Comentarios</th>
               <th>Fecha</th>
               <th>Valor</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            {% for initialExpense in viewData.initialExpenses %}
            <tr>
               <td>{{loop.index}}</td>
               <td>
               <a href=\"{{rute_url}}gstinicial/presentar/{{initialExpense.id_gastos_iniciales}}\">
               {{initialExpense.concepto}}
               </a>
            </td>               
               <td>
                  <a href=\"{{rute_url}}proveedor/presentar/{{initialExpense.id_proveedor}}\">
                     {{initialExpense.nombre}}
                  </a>
               </td>  
               <td>{{initialExpense.comentarios |raw }}</td>            
               <td>{{initialExpense.fecha | date(\"m/d/Y\") }}</td>               
               <td>{{initialExpense.valor_provisionado | number_format(2, '.', ',')}}</td>               
               <td> 
                   <div class=\"dropdown\">
                           <button class=\"btn btn-sm btn-default\" id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                           Acciones <span class=\"fa fa-list fa-fw\" ></span>
                            <span class=\"caret\"></span>
                          </button>
                          <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                            <li> 
                              <a href=\"{{rute_url}}gstinicial/presentar/{{initialExpense.id_gastos_iniciales}}\">
                              <span class=\"fa fa-eye fa-fw\"></span>
                              Detalle Gasto Inicial
                           </a> 
                           </li>
                            <li> 
                              <a href=\"{{rute_url}}gstinicial/editar/{{initialExpense.id_gastos_iniciales}}\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Gasto Inicial
                              <span class=\"label label-success\"> {{initialExpense.id_gastos_iniciales}}</span></a> 
                           </li>
                            <li>
                             <a href=\"{{rute_url}}gstinicial/eliminar/{{initialExpense.id_gastos_iniciales}}\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Gasto Inicial
                              <span class=\"label label-danger\">
                             {{initialExpense.id_gastos_iniciales}}
                              </span>
                          </a>   
                          </li>
                          </ul>
                        </div>
               </td>               
            </tr>
            {% endfor %}
         </tbody>
      </table>
            </div>
         </div>
      </div>
      <!-- /Gastos iniciales -->
      <!-- factura Nacionalizaciones -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"nacionalizaciones\">
         <br>
         <div class=\"row\">
            <div class=\"col-sm-12\">
               <table class=\"table table-hover table-bordered table-striped\">
         <thead>
            <tr style=\"background-color: #c1c1c1;\">
               <th>#</th>
               <th>Nro Fact</th>
               <th>Proveedor</th>
               <th>Fecha</th>
               <th>Valor</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            {% for nationalization in viewData.nationalizations %}
            <tr>
               <td>{{loop.index}}</td>
               <td>
               {{nationalization.nro_factura_informativa}}
            </td>               
               <td>
                  <a href=\"{{rute_url}}proveedor/presentar/{{initialExpense.identificacion_proveedor}}\">
                     {{nationalization.identificacion_proveedor}}
                  </a>
               </td>               
               <td>{{initialExpense.fecha | date(\"m/d/Y\") }}</td>               
               <td>{{initialExpense.valor | number_format(2, '.', ',')}}</td>               
               <td> 
                   <div class=\"dropdown\">
                           <button class=\"btn btn-sm btn-default\" id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                           Acciones <span class=\"fa fa-list fa-fw\" ></span>
                            <span class=\"caret\"></span>
                          </button>
                          <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                            <li> 
                              <a href=\"{{rute_url}}pedidofactura/presentar/{{initialExpense.id_pedido_factura}}\">
                              <span class=\"fa fa-eye fa-fw\"></span>
                              Ver Productos
                           </a> 
                           </li>
                            <li> 
                              <a href=\"{{rute_url}}pedidofactura/nuevo/{{initialExpense.id_pedido_factura}}\">
                                 <span class=\"fa fa-plus fa-fw\"></span>
                              Agregar Producto
                           </a> 
                           </li>
                            <li> 
                              <a href=\"{{rute_url}}pedidofactura/editar/{{initialExpense.id_pedido_factura}}\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> {{initialExpense.id_factura_proveedor}}</span></a> 
                           </li>
                            <li>
                             <a href=\"{{rute_url}}pedidofactura/eliminar/{{initialExpense.id_pedido_factura}}\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             {{initialExpense.id_factura_proveedor}}
                              </span>
                          </a>   
                          </li>
                          </ul>
                        </div>
               </td>               
            </tr>
            {% endfor %}
         </tbody>
      </table>
            </div>
         </div>
      </div>
      <!-- /factura Nacionalizaciones -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"impuestos\">
      </div>
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturasServicios\">
      </div>
   </div>
</div>
<!--/tabs-->
<!-- modal facturas produtos -->

", "base/sections/show-pedido.html.twig", "/var/www/html/app/src/views/base/sections/show-pedido.html.twig");
    }
}
