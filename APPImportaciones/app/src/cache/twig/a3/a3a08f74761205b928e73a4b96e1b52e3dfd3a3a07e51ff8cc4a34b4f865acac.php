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
            <div class=\"col-sm-9\">
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
            <div class=\"col-sm-3\">
               <form action=\"buscar.php\" method=\"POST\" class=\"form-inline\" role=\"form\">
                  <input 
                     class=\"form-control\" 
                     type=\"text\" 
                     name=\"query\" 
                     placeholder=\"Buscar Registro\"
                     >
                  <input 
                     type=\"hidden\" 
                     name=\"orderInvoices\"
                     >
                  <button class=\"btn btn-sm btn-default\" type=\"submit\" class =\"btn\"> 
                  <span class=\"fa fa-search fa-fw\">  </span>
                  </button>
               </form>
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
        // line 166
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
            // line 167
            echo "            <tr>
               <td>";
            // line 168
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
                  <a href=\"";
            // line 170
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
               ";
            // line 171
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
            </a>
            </td>               
               <td>
                  <a href=\"";
            // line 175
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_proveedor", array()), "html", null, true);
            echo "\">
               ";
            // line 176
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "nombre", array()), "html", null, true);
            echo "                     
                  </a>
               </td>               
               <td>";
            // line 179
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 180
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "vencimiento_pago", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 181
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "moneda", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 182
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>                         
               <td>";
            // line 183
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>                         
               <td>";
            // line 184
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
            // line 193
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
            // line 199
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> ";
            // line 202
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 205
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             ";
            // line 209
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
        // line 218
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
            <div class=\"col-sm-9\">
               <a href=\"";
        // line 231
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/nuevo/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Inicial <span class=\"label label-warning\">provisionado</span>
               </button>
               </a>
            </div>
            <div class=\"col-sm-3\">
               <form action=\"buscar.php\" method=\"POST\" class=\"form-inline\" role=\"form\">
                  <input 
                     class=\"form-control\" 
                     type=\"text\" 
                     name=\"query\" 
                     placeholder=\"Buscar Registro\"
                     >
                  <input 
                     type=\"hidden\" 
                     name=\"gasto_inicial\"
                     >
                  <button class=\"btn btn-sm btn-default\" type=\"submit\" class =\"btn\"> 
                  <span class=\"fa fa-search fa-fw\">  </span>
                  </button>
               </form>
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
        // line 272
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
            // line 273
            echo "            <tr>
               <td>";
            // line 274
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
               <a href=\"";
            // line 276
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
               ";
            // line 277
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "concepto", array()), "html", null, true);
            echo "
               </a>
            </td>               
               <td>
                  <a href=\"";
            // line 281
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_proveedor", array()), "html", null, true);
            echo "\">
                     ";
            // line 282
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "nombre", array()), "html", null, true);
            echo "
                  </a>
               </td>  
               <td>";
            // line 285
            echo $this->getAttribute($context["initialExpense"], "comentarios", array());
            echo "</td>            
               <td>";
            // line 286
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["initialExpense"], "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>               
               <td>";
            // line 287
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
            // line 296
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
            // line 302
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Gasto Inicial
                              <span class=\"label label-success\"> ";
            // line 305
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 308
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_iniciales", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Gasto Inicial
                              <span class=\"label label-danger\">
                             ";
            // line 312
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
        // line 321
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
        // line 344
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
            // line 345
            echo "            <tr>
               <td>";
            // line 346
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
               ";
            // line 348
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "nro_factura_informativa", array()), "html", null, true);
            echo "
            </td>               
               <td>
                  <a href=\"";
            // line 351
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
                     ";
            // line 352
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "identificacion_proveedor", array()), "html", null, true);
            echo "
                  </a>
               </td>               
               <td>";
            // line 355
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>               
               <td>";
            // line 356
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
            // line 365
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
            // line 371
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
            // line 377
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> ";
            // line 380
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 383
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             ";
            // line 387
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
        // line 396
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
        return array (  719 => 396,  696 => 387,  687 => 383,  681 => 380,  673 => 377,  662 => 371,  651 => 365,  639 => 356,  635 => 355,  629 => 352,  623 => 351,  617 => 348,  612 => 346,  609 => 345,  592 => 344,  567 => 321,  544 => 312,  535 => 308,  529 => 305,  521 => 302,  510 => 296,  498 => 287,  494 => 286,  490 => 285,  484 => 282,  478 => 281,  471 => 277,  465 => 276,  460 => 274,  457 => 273,  440 => 272,  394 => 231,  379 => 218,  356 => 209,  347 => 205,  341 => 202,  333 => 199,  322 => 193,  310 => 184,  306 => 183,  302 => 182,  298 => 181,  294 => 180,  290 => 179,  284 => 176,  278 => 175,  271 => 171,  265 => 170,  260 => 168,  257 => 167,  240 => 166,  191 => 122,  176 => 112,  169 => 110,  159 => 103,  147 => 94,  138 => 88,  129 => 82,  117 => 73,  108 => 67,  99 => 61,  90 => 55,  81 => 49,  56 => 27,  50 => 24,  44 => 21,  33 => 13,  19 => 1,);
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
            <div class=\"col-sm-9\">
               <a href=\"{{rute_url}}pedidofactura/nuevo/{{viewData.order.0.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Factura Productos
               </button>
               </a>
            </div>
            <div class=\"col-sm-3\">
               <form action=\"buscar.php\" method=\"POST\" class=\"form-inline\" role=\"form\">
                  <input 
                     class=\"form-control\" 
                     type=\"text\" 
                     name=\"query\" 
                     placeholder=\"Buscar Registro\"
                     >
                  <input 
                     type=\"hidden\" 
                     name=\"orderInvoices\"
                     >
                  <button class=\"btn btn-sm btn-default\" type=\"submit\" class =\"btn\"> 
                  <span class=\"fa fa-search fa-fw\">  </span>
                  </button>
               </form>
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
            <div class=\"col-sm-9\">
               <a href=\"{{rute_url}}gstinicial/nuevo/{{viewData.order.0.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Inicial <span class=\"label label-warning\">provisionado</span>
               </button>
               </a>
            </div>
            <div class=\"col-sm-3\">
               <form action=\"buscar.php\" method=\"POST\" class=\"form-inline\" role=\"form\">
                  <input 
                     class=\"form-control\" 
                     type=\"text\" 
                     name=\"query\" 
                     placeholder=\"Buscar Registro\"
                     >
                  <input 
                     type=\"hidden\" 
                     name=\"gasto_inicial\"
                     >
                  <button class=\"btn btn-sm btn-default\" type=\"submit\" class =\"btn\"> 
                  <span class=\"fa fa-search fa-fw\">  </span>
                  </button>
               </form>
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
