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
         <strong>Saldo:</strong> <span class=\"text-success\">  ";
        // line 4
        echo 119150.1;
        echo " </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Parciales:</strong> <span class=\"text-danger\">";
        // line 7
        echo 2541.08;
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Compra:</strong> <span class=\"text-info\">";
        // line 10
        echo 119150.1;
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Moneda:</strong> <span>EUROS</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Tipo de Cambio:</strong> <span>";
        // line 20
        echo 1.42;
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>provisiones:</strong> <span class=\"text-danger\">";
        // line 23
        echo 2541.08;
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>";
        // line 26
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
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">RÉGIMEN</span>
                  <span class=\"form-control\">";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "regimen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">INCOTERM</span>
                  <span class=\"form-control\">";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "incoterm", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">PAIS</span>
                  <span class=\"form-control\"> ";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "pais_origen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">CIUDAD</span>
                  <span class=\"form-control\">";
        // line 72
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
        // line 81
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "seguro_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">FLETE SENAE</span>
                  <span class=\"form-control\" > ";
        // line 87
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "flete_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">ARRIBO</span>
                  <span class=\"form-control\" > ";
        // line 93
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
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "comentarios", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
            <div class=\"col-md-6\">
               <hr>
               <a href=\"";
        // line 109
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"text-primary\">
                  <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar</button></a>
               <a href=\"";
        // line 111
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
        // line 121
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
        // line 165
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
            // line 166
            echo "            <tr>
               <td>";
            // line 167
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
                  <a href=\"";
            // line 169
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
               ";
            // line 170
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
            </a>
            </td>               
               <td>
                  <a href=\"";
            // line 174
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_proveedor", array()), "html", null, true);
            echo "\">
               ";
            // line 175
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "nombre", array()), "html", null, true);
            echo "                     
                  </a>
               </td>               
               <td>";
            // line 178
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 179
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "vencimiento_pago", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 180
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "moneda", array()), "html", null, true);
            echo "</td>               
               <td>";
            // line 181
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>                         
               <td>";
            // line 182
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>                         
               <td>";
            // line 183
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
            // line 192
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
            // line 198
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> ";
            // line 201
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 204
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             ";
            // line 208
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
        // line 217
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
        // line 230
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/nuevo/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), 0, array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agrefar Gasto Inicial <span class=\"label label-warning\">provisionado</span>
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
               ";
            // line 274
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "concepto", array()), "html", null, true);
            echo "
            </td>               
               <td>
                  <a href=\"";
            // line 277
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_proveedor", array()), "html", null, true);
            echo "\">
                     ";
            // line 278
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "nombre", array()), "html", null, true);
            echo "
                  </a>
               </td>               
               <td>";
            // line 281
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["initialExpense"], "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>               
               <td>";
            // line 282
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["initialExpense"], "valor", array()), 2, ".", ","), "html", null, true);
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
            // line 291
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"fa fa-eye fa-fw\"></span>
                              Ver Productos
                           </a> 
                           </li>
                            <li> 
                              <a href=\"";
            // line 297
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/agregarProducto/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-plus fa-fw\"></span>
                              Agregar Producto
                           </a> 
                           </li>
                            <li> 
                              <a href=\"";
            // line 303
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> ";
            // line 306
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 309
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             ";
            // line 313
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_factura_proveedor", array()), "html", null, true);
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
        // line 322
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
        // line 345
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
            // line 346
            echo "            <tr>
               <td>";
            // line 347
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
               <td>
               ";
            // line 349
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "nro_factura_informativa", array()), "html", null, true);
            echo "
            </td>               
               <td>
                  <a href=\"";
            // line 352
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
                     ";
            // line 353
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "identificacion_proveedor", array()), "html", null, true);
            echo "
                  </a>
               </td>               
               <td>";
            // line 356
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>               
               <td>";
            // line 357
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
            // line 366
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
            // line 372
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
            // line 378
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                 <span class=\"fa fa-pencil fa-fw\"></span>
                                 Editar Factura 
                              <span class=\"label label-success\"> ";
            // line 381
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                           </li>
                            <li>
                             <a href=\"";
            // line 384
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                              <span class=\"text-danger fa fa-trash fa-fw\"></span>
                              Elminar Factura 
                              <span class=\"label label-danger\">
                             ";
            // line 388
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
        // line 397
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
        return array (  723 => 397,  700 => 388,  691 => 384,  685 => 381,  677 => 378,  666 => 372,  655 => 366,  643 => 357,  639 => 356,  633 => 353,  627 => 352,  621 => 349,  616 => 347,  613 => 346,  596 => 345,  571 => 322,  548 => 313,  539 => 309,  533 => 306,  525 => 303,  514 => 297,  503 => 291,  491 => 282,  487 => 281,  481 => 278,  475 => 277,  469 => 274,  464 => 272,  461 => 271,  444 => 270,  399 => 230,  384 => 217,  361 => 208,  352 => 204,  346 => 201,  338 => 198,  327 => 192,  315 => 183,  311 => 182,  307 => 181,  303 => 180,  299 => 179,  295 => 178,  289 => 175,  283 => 174,  276 => 170,  270 => 169,  265 => 167,  262 => 166,  245 => 165,  196 => 121,  181 => 111,  174 => 109,  164 => 102,  152 => 93,  143 => 87,  134 => 81,  122 => 72,  113 => 66,  104 => 60,  95 => 54,  86 => 48,  61 => 26,  55 => 23,  49 => 20,  36 => 10,  30 => 7,  24 => 4,  19 => 1,);
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
         <strong>Saldo:</strong> <span class=\"text-success\">  {{119150.10}} </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Parciales:</strong> <span class=\"text-danger\">{{2541.08}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Compra:</strong> <span class=\"text-info\">{{119150.10 }}</span>
      </div>
      <div class=\"col-sm-3\">
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Moneda:</strong> <span>EUROS</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Tipo de Cambio:</strong> <span>{{1.42}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>provisiones:</strong> <span class=\"text-danger\">{{2541.08}}</span>
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
               Agrefar Gasto Inicial <span class=\"label label-warning\">provisionado</span>
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
               {{initialExpense.concepto}}
            </td>               
               <td>
                  <a href=\"{{rute_url}}proveedor/presentar/{{initialExpense.id_proveedor}}\">
                     {{initialExpense.nombre}}
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
                              <a href=\"{{rute_url}}pedidofactura/agregarProducto/{{initialExpense.id_pedido_factura}}\">
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
