<?php

/* sections/show-pedido.html.twig */
class __TwigTemplate_32429bf2c47fe721bc51fceb6286bc97ce70f51d541a32b9599a77ec100ad461 extends Twig_Template
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
        $context["var"] = ($context["value"] ?? null);
        // line 2
        $context["var"] = ($context["value"] ?? null);
        // line 3
        $context["var"] = ($context["value"] ?? null);
        // line 4
        $context["var"] = ($context["value"] ?? null);
        // line 5
        echo "
<div class=\"well well-sm\">
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
        // line 18
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
        // line 26
        echo 1;
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>provisiones:</strong> <span class=\"text-danger\">";
        // line 29
        echo 0;
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>";
        // line 32
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
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">RÉGIMEN</span>
                  <span class=\"form-control\">";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "regimen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">INCOTERM</span>
                  <span class=\"form-control\">";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "incoterm", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">PAIS</span>
                  <span class=\"form-control\"> ";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "pais_origen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">CIUDAD</span>
                  <span class=\"form-control\">";
        // line 78
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
        // line 87
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "seguro_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">FLETE SENAE</span>
                  <span class=\"form-control\" > ";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "flete_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">ARRIBO</span>
                  <span class=\"form-control\" > ";
        // line 99
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
        // line 108
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "comentarios", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
            <div class=\"col-md-6\">
               <hr>
               <a href=\"";
        // line 115
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"text-primary\">
                  <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar</button></a>
               <a href=\"";
        // line 117
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
        // line 127
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
        // line 135
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["unidades"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Suma: </small> <span id=\"suma\"> ";
        // line 138
        echo ($context["simbolo"] ?? null);
        echo " ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["suma"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Diferencia: </small> <span id=\"suma\"> ";
        // line 141
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
        // line 163
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
            // line 164
            echo "            <tr>
               <td>";
            // line 165
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
                  <a href=\"";
            // line 167
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
               ";
            // line 168
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
            </a>
            </td>               
               <td>
                  <a href=\"";
            // line 172
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_proveedor", array()), "html", null, true);
            echo "\">
               ";
            // line 173
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "nombre", array()), "html", null, true);
            echo "                     
                  </a>
               </td>               
               <td>";
            // line 176
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 177
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "vencimiento_pago", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 178
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "moneda", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 179
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>                         
               <td>";
            // line 180
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>                         
               <td>";
            // line 181
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
            // line 190
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
            // line 196
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> ";
            // line 199
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 202
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             ";
            // line 206
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
        // line 215
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
        // line 228
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "regimen", array()) == 70)) {
            // line 229
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
            // line 236
            echo "                  <h5 class=\"text-primary\">GASTOS INICIALES RÉGIMEN 10</h5>
               ";
        }
        // line 238
        echo "            </div>

            ";
        // line 240
        $context["cantidad"] = 0;
        // line 241
        echo "            ";
        $context["provisionado"] = 0;
        // line 242
        echo "            ";
        $context["convalidado"] = 0;
        // line 243
        echo "
            ";
        // line 244
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "initialExpenses", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["initialExpense"]) {
            // line 245
            echo "               ";
            $context["cantidad"] = (($context["cantidad"] ?? null) + 1);
            // line 246
            echo "               ";
            $context["provisionado"] = (($context["provisionado"] ?? null) + $this->getAttribute($context["initialExpense"], "valor_provisionado", array()));
            // line 247
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initialExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 248
        echo "
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Cantidad: </small> <span id=\"suma\"> ";
        // line 250
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["cantidad"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Provisionado: </small> <span id=\"suma\"> \$ ";
        // line 253
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["provisionado"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Convalidado: </small> <span id=\"suma\"> \$ ";
        // line 256
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
        // line 275
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
            // line 276
            echo "            <tr>
               <td>";
            // line 277
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
               <a href=\"";
            // line 279
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
               ";
            // line 280
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "concepto", array()), "html", null, true);
            echo "
               </a>
            </td>               
               <td>
                  <a href=\"";
            // line 284
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_proveedor", array()), "html", null, true);
            echo "\">
                     ";
            // line 285
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "nombre", array()), "html", null, true);
            echo "
                  </a>
               </td>  
               <td>";
            // line 288
            echo $this->getAttribute($context["initialExpense"], "comentarios", array());
            echo "</td>            
               <td>";
            // line 289
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["initialExpense"], "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>               
               <td>";
            // line 290
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
            // line 299
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
            // line 305
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Gasto Inicial
                              <span class=\"label label-success\"> ";
            // line 308
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 311
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Gasto Inicial
                              <span class=\"label label-danger\">
                             ";
            // line 315
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
        // line 324
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
        // line 347
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
            // line 348
            echo "            <tr>
               <td>";
            // line 349
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
               ";
            // line 351
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "nro_factura_informativa", array()), "html", null, true);
            echo "
            </td>               
               <td>
                  <a href=\"";
            // line 354
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
                     ";
            // line 355
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "identificacion_proveedor", array()), "html", null, true);
            echo "
                  </a>
               </td>               
               <td>";
            // line 358
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>               
               <td>";
            // line 359
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
            // line 368
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
            // line 374
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
            // line 380
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> ";
            // line 383
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 386
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             ";
            // line 390
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
        // line 399
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
        return "sections/show-pedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  775 => 399,  752 => 390,  743 => 386,  737 => 383,  729 => 380,  718 => 374,  707 => 368,  695 => 359,  691 => 358,  685 => 355,  679 => 354,  673 => 351,  668 => 349,  665 => 348,  648 => 347,  623 => 324,  600 => 315,  591 => 311,  585 => 308,  577 => 305,  566 => 299,  554 => 290,  550 => 289,  546 => 288,  540 => 285,  534 => 284,  527 => 280,  521 => 279,  516 => 277,  513 => 276,  496 => 275,  474 => 256,  468 => 253,  462 => 250,  458 => 248,  452 => 247,  449 => 246,  446 => 245,  442 => 244,  439 => 243,  436 => 242,  433 => 241,  431 => 240,  427 => 238,  423 => 236,  410 => 229,  408 => 228,  393 => 215,  370 => 206,  361 => 202,  355 => 199,  347 => 196,  336 => 190,  324 => 181,  320 => 180,  316 => 179,  312 => 178,  308 => 177,  304 => 176,  298 => 173,  292 => 172,  285 => 168,  279 => 167,  274 => 165,  271 => 164,  254 => 163,  227 => 141,  219 => 138,  213 => 135,  200 => 127,  185 => 117,  178 => 115,  168 => 108,  156 => 99,  147 => 93,  138 => 87,  126 => 78,  117 => 72,  108 => 66,  99 => 60,  90 => 54,  65 => 32,  59 => 29,  53 => 26,  42 => 18,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set var = value %}
{% set var = value %}
{% set var = value %}
{% set var = value %}

<div class=\"well well-sm\">
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

", "sections/show-pedido.html.twig", "/var/www/html/app/src/views/sections/show-pedido.html.twig");
    }
}
