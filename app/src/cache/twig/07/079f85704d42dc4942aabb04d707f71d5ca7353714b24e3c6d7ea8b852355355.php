<?php

/* sections/base-mostrar-pedido.html.twig */
class __TwigTemplate_73fb6906a64c8490f6845d2a9fcfe16c2734f62192c005009bf1005b934eaa5e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'orderDetail' => array($this, 'block_orderDetail'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["fob"] = ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "valuesSums", array()), "valInvoices", array()) + ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "valuesSums", array()), "initExpenses", array()) * $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "valuesSums", array()), "mutiple", array())));
        // line 2
        $context["saldo"] = (($context["fob"] ?? null) - $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "valuesSums", array()), "infoInvoices", array()));
        // line 3
        echo "<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Valor FOB Total:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <strong>
         ";
        // line 9
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
        echo "      
         </strong>  
      </div>
      <div class=\"col-sm-3\">
         <strong>
         FOB Nacionalizado:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <span class=\"text-primary\">
         <strong>
         ";
        // line 18
        if (($this->getAttribute(($context["valuesSums"] ?? null), "regimen10", array()) == true)) {
            // line 19
            echo "         ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
            echo "      
         ";
        } else {
            // line 21
            echo "         0.00
         ";
        }
        // line 23
        echo "         </strong>
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Valor FOB Saldo:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <span class=\"text-primary\">
         <strong>
         ";
        // line 32
        if (($this->getAttribute(($context["valuesSums"] ?? null), "regimen10", array()) == true)) {
            // line 33
            echo "         0.00
         ";
        } else {
            // line 35
            echo "         ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
            echo "      
         ";
        }
        // line 37
        echo "         </strong>
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Fecha Registro:</strong> ";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "date_create", array()), "html", null, true);
        echo "
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Tiempo Bodega:</strong> 
         ";
        // line 48
        $context["meses"] = ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "dias", array()) / 30);
        // line 49
        echo "         ";
        $context["anos"] = ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "dias", array()) / 365);
        // line 50
        echo "         ";
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "dias", array()) < 30)) {
            // line 51
            echo "         ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "dias", array()), 1, ".", ","), "html", null, true);
            echo " 
         <small>días</small>  
         ";
        } elseif ((($this->getAttribute($this->getAttribute(        // line 53
($context["viewData"] ?? null), "order", array()), "dias", array()) > 29) && ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "dias", array()) < 300))) {
            // line 54
            echo "         ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["meses"] ?? null), 2, ".", ","), "html", null, true);
            echo " <small><b>Meses</b></small>  
         ";
        } elseif (($this->getAttribute($this->getAttribute(        // line 55
($context["viewData"] ?? null), "order", array()), "dias", array()) > 300)) {
            // line 56
            echo "         ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["anos"] ?? null), 3, ".", ","), "html", null, true);
            echo " <small>años</small>
         ";
        }
        // line 58
        echo "         </label>
      </div>
      <div class=\"col-sm-2\">
         <strong>Provisiones:</strong> 
         <span class=\"text-warning\">
         ";
        // line 63
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["viewData"] ?? null), "provisions", array()), 0, ".", ","), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Consolidado:</strong> 
         <span class=\"text-primary\">
         ";
        // line 69
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["viewData"] ?? null), "consolided", array()), 0, ".", ","), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Saldo:</strong> 
         <span class=\"text-primary\">
         ";
        // line 75
        $context["saldo"] = ($this->getAttribute(($context["viewData"] ?? null), "provisions", array()) - $this->getAttribute(($context["viewData"] ?? null), "consolided", array()));
        // line 76
        echo "         ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["saldo"] ?? null), 0, ".", ","), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>";
        // line 80
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["createBy"] ?? null), 0, array(), "array"), "nombres", array(), "array"), "html", null, true);
        echo "</span>
      </div>
   </div>
</div>

<!-- Tabs -->
<div>
   <ul class=\"nav nav-tabs\" role=\"tablist\">
      <li role=\"presentation\" class=\"active\"><a href=\"#pedido\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"pedido\">Detalle Pedido &nbsp;
         ";
        // line 89
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "bg_isclosed", array()) == "0")) {
            // line 90
            echo "         <span class=\"label label-success\">Abierto</span>
         ";
        } else {
            // line 92
            echo "         <span class=\"label label-died\">Cerrado</span>
         ";
        }
        // line 94
        echo "         </a>
      </li>
      <li role=\"presentation\"><a href=\"#facturas\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"facturas\">Facturas Productos</a></li>
      <li role=\"presentation\"><a href=\"#gastos\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"gastos\">Gastos Iniciales</a></li>
      <li role=\"presentation\"><a href=\"#nacionalizaciones\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"nacionalizaciones\">Nacionalizaciones</a></li>
      <li role=\"presentation\"><a href=\"#impuestos\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"impuestos\">Impuestos</a></li>
      <li role=\"presentation\"><a href=\"#facturasServicios\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"facturasfacturasServicios\">Facturas Servicios</a></li>
   </ul>
   <br>
   <div class=\"tab-content\">
      <div role=\"tabpanel\" class=\"tab-pane active\" id=\"pedido\">
         ";
        // line 105
        $this->displayBlock('orderDetail', $context, $blocks);
        // line 107
        echo "      </div>

      <!-- /tabFacturas-->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturas\">
         <div class=\"row\">
            <div class=\"col-sm-6\">
               <a href=\"";
        // line 113
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedidofactura/nuevo/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Factura Productos
               </button>
               </a>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Cajas Pedido: </small> <span id=\"suma\"> 
                  ";
        // line 122
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()), 0, ".", ","), "html", null, true);
        echo " 
                  </span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Cajas Nacionalizadas: </small> 
                  <span id=\"suma\"> ";
        // line 128
        echo ($context["simbolo"] ?? null);
        echo " 
                  ";
        // line 129
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()), 0, ".", ","), "html", null, true);
        echo "</span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-danger\"> <small>Cajas Stock: </small> 
                  <span id=\"suma\">
                  ";
        // line 135
        $context["stock"] = ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()) - $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()));
        // line 136
        echo "                  ";
        echo twig_escape_filter($this->env, ($context["stock"] ?? null), "html", null, true);
        echo "
                  </span>
               </h4>
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
        // line 160
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
            // line 161
            echo "                     <tr>
                        <td>";
            // line 162
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           <a href=\"";
            // line 164
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                           ";
            // line 165
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>
                           <a href=\"";
            // line 169
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 170
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "nombre", array()), "html", null, true);
            echo "                     
                           </a>
                        </td>
                        <td>";
            // line 173
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 174
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "vencimiento_pago", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 175
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "moneda", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 176
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>
                        <td>";
            // line 177
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>
                        <td>";
            // line 178
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), 2, ".", ","), "html", null, true);
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
            // line 187
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
            // line 193
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Factura 
                                    <span class=\"label label-success\"> ";
            // line 196
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 199
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Factura 
                                    <span class=\"label label-danger\">
                                    ";
            // line 203
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
        // line 212
        echo "                  </tbody>
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
               <a href=\"";
        // line 225
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/nuevo/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Nacional <span class=\"label label-warning\">provisionado</span>
               </button>
               </a>
            </div>
            ";
        // line 232
        $context["cantidad"] = 0;
        // line 233
        echo "            ";
        $context["provisionado"] = 0;
        // line 234
        echo "            ";
        $context["convalidado"] = 0;
        // line 235
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "initialExpenses", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["initialExpense"]) {
            // line 236
            echo "            ";
            $context["cantidad"] = (($context["cantidad"] ?? null) + 1);
            // line 237
            echo "            ";
            $context["provisionado"] = (($context["provisionado"] ?? null) + $this->getAttribute($context["initialExpense"], "valor_provisionado", array()));
            // line 238
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initialExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 239
        echo "            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Cantidad: </small> <span id=\"suma\"> ";
        // line 240
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["cantidad"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Provisionado: </small> <span id=\"suma\"> \$ ";
        // line 243
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["provisionado"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Convalidado: </small> <span id=\"suma\"> \$ ";
        // line 246
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
        // line 265
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
            // line 266
            echo "                     <tr>
                        <td>";
            // line 267
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           <a href=\"";
            // line 269
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                           ";
            // line 270
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "concepto", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>
                           <a href=\"";
            // line 274
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 275
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "nombre", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>";
            // line 278
            echo $this->getAttribute($context["initialExpense"], "comentarios", array());
            echo "</td>
                        <td>";
            // line 279
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["initialExpense"], "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>
                        <td>";
            // line 280
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
            // line 289
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-eye fa-fw\"></span>
                                    Detalle Gasto Inicial
                                    </a> 
                                 </li>
                                 <li> 
                                    <a href=\"";
            // line 295
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Gasto Inicial
                                    <span class=\"label label-success\"> ";
            // line 298
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 301
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Gasto Inicial
                                    <span class=\"label label-danger\">
                                    ";
            // line 305
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
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
        // line 314
        echo "                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <!-- /Gastos iniciales -->
      <!-- factura Nacionalizaciones -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"nacionalizaciones\">
         <div class=\"row\">
            <div class=\"col-sm-6\">
               ";
        // line 325
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "regimen", array()) == 70)) {
            // line 326
            echo "               <a href=\"";
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
            echo "\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Factura Informativa <span class=\"label label-primary\">
               Parcial</span>
               </button>
               </a>
               ";
        }
        // line 334
        echo "            </div>
            
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Parciales: </small>
                <span id=\"suma\"> ";
        // line 338
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Sumas: </small> <span id=\"suma\"> 
                        \$ ";
        // line 342
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
        echo "</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Saldo:</small> 
                  <span id=\"suma\"> \$ ";
        // line 346
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["saldo"] ?? null), 2, ".", ","), "html", null, true);
        echo " 
                  </span></h5>
            </div>
         </div>
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
        // line 364
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
            // line 365
            echo "                     <tr>
                        <td>";
            // line 366
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           ";
            // line 368
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "nro_factura_informativa", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                           <a href=\"";
            // line 371
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 372
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "identificacion_proveedor", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>";
            // line 375
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>
                        <td>";
            // line 376
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
            // line 385
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
            // line 391
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
            // line 397
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Factura 
                                    <span class=\"label label-success\"> ";
            // line 400
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 403
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Factura 
                                    <span class=\"label label-danger\">
                                    ";
            // line 407
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
        // line 416
        echo "                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- /factura Nacionalizaciones -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"impuestos\">
         Proximamente
      </div>
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturasServicios\">
         Proximamente
      </div>
   </div>
</div>
<!--/tabs-->";
    }

    // line 105
    public function block_orderDetail($context, array $blocks = array())
    {
        // line 106
        echo "         ";
    }

    public function getTemplateName()
    {
        return "sections/base-mostrar-pedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  843 => 106,  840 => 105,  822 => 416,  799 => 407,  790 => 403,  784 => 400,  776 => 397,  765 => 391,  754 => 385,  742 => 376,  738 => 375,  732 => 372,  726 => 371,  720 => 368,  715 => 366,  712 => 365,  695 => 364,  674 => 346,  667 => 342,  660 => 338,  654 => 334,  640 => 326,  638 => 325,  625 => 314,  602 => 305,  593 => 301,  587 => 298,  579 => 295,  568 => 289,  556 => 280,  552 => 279,  548 => 278,  542 => 275,  536 => 274,  529 => 270,  523 => 269,  518 => 267,  515 => 266,  498 => 265,  476 => 246,  470 => 243,  464 => 240,  461 => 239,  455 => 238,  452 => 237,  449 => 236,  444 => 235,  441 => 234,  438 => 233,  436 => 232,  424 => 225,  409 => 212,  386 => 203,  377 => 199,  371 => 196,  363 => 193,  352 => 187,  340 => 178,  336 => 177,  332 => 176,  328 => 175,  324 => 174,  320 => 173,  314 => 170,  308 => 169,  301 => 165,  295 => 164,  290 => 162,  287 => 161,  270 => 160,  242 => 136,  240 => 135,  231 => 129,  227 => 128,  218 => 122,  204 => 113,  196 => 107,  194 => 105,  181 => 94,  177 => 92,  173 => 90,  171 => 89,  159 => 80,  151 => 76,  149 => 75,  140 => 69,  131 => 63,  124 => 58,  118 => 56,  116 => 55,  111 => 54,  109 => 53,  103 => 51,  100 => 50,  97 => 49,  95 => 48,  86 => 42,  79 => 37,  73 => 35,  69 => 33,  67 => 32,  56 => 23,  52 => 21,  46 => 19,  44 => 18,  32 => 9,  24 => 3,  22 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{%  set fob = viewData.valuesSums.valInvoices + (viewData.valuesSums.initExpenses * viewData.valuesSums.mutiple ) %}
{% set saldo =  fob - viewData.valuesSums.infoInvoices %}
<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Valor FOB Total:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <strong>
         {{fob | number_format(2, '.', ',') }}      
         </strong>  
      </div>
      <div class=\"col-sm-3\">
         <strong>
         FOB Nacionalizado:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <span class=\"text-primary\">
         <strong>
         {% if valuesSums.regimen10 == true %}
         {{fob | number_format(2, '.', ',') }}      
         {% else %}
         0.00
         {% endif %}
         </strong>
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Valor FOB Saldo:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <span class=\"text-primary\">
         <strong>
         {% if valuesSums.regimen10 == true %}
         0.00
         {% else %}
         {{fob | number_format(2, '.', ',') }}      
         {% endif %}
         </strong>
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Fecha Registro:</strong> {{ viewData.order.date_create }}
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Tiempo Bodega:</strong> 
         {% set meses = (viewData.order.dias / 30) %}
         {% set anos = (viewData.order.dias / 365)  %}
         {% if viewData.order.dias < 30 %}
         {{viewData.order.dias | number_format(1, '.', ',') }} 
         <small>días</small>  
         {% elseif (viewData.order.dias > 29) and (viewData.order.dias < 300) %}
         {{meses | number_format(2, '.', ',')}} <small><b>Meses</b></small>  
         {% elseif viewData.order.dias > 300 %}
         {{ anos | number_format(3, '.', ',')}} <small>años</small>
         {% endif %}
         </label>
      </div>
      <div class=\"col-sm-2\">
         <strong>Provisiones:</strong> 
         <span class=\"text-warning\">
         {{ viewData.provisions | number_format(0, '.', ',') }}
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Consolidado:</strong> 
         <span class=\"text-primary\">
         {{ viewData.consolided | number_format(0, '.', ',') }}
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Saldo:</strong> 
         <span class=\"text-primary\">
         {% set saldo = (viewData.provisions - viewData.consolided) %}
         {{ saldo | number_format(0, '.', ',') }}
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>{{createBy[0]['nombres']}}</span>
      </div>
   </div>
</div>

<!-- Tabs -->
<div>
   <ul class=\"nav nav-tabs\" role=\"tablist\">
      <li role=\"presentation\" class=\"active\"><a href=\"#pedido\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"pedido\">Detalle Pedido &nbsp;
         {% if viewData.order.bg_isclosed == '0' %}
         <span class=\"label label-success\">Abierto</span>
         {% else %}
         <span class=\"label label-died\">Cerrado</span>
         {% endif %}
         </a>
      </li>
      <li role=\"presentation\"><a href=\"#facturas\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"facturas\">Facturas Productos</a></li>
      <li role=\"presentation\"><a href=\"#gastos\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"gastos\">Gastos Iniciales</a></li>
      <li role=\"presentation\"><a href=\"#nacionalizaciones\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"nacionalizaciones\">Nacionalizaciones</a></li>
      <li role=\"presentation\"><a href=\"#impuestos\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"impuestos\">Impuestos</a></li>
      <li role=\"presentation\"><a href=\"#facturasServicios\" role=\"tab\" data-toggle=\"tab\" aria-controls=\"facturasfacturasServicios\">Facturas Servicios</a></li>
   </ul>
   <br>
   <div class=\"tab-content\">
      <div role=\"tabpanel\" class=\"tab-pane active\" id=\"pedido\">
         {% block orderDetail %}
         {% endblock %}
      </div>

      <!-- /tabFacturas-->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturas\">
         <div class=\"row\">
            <div class=\"col-sm-6\">
               <a href=\"{{rute_url}}pedidofactura/nuevo/{{viewData.order.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Factura Productos
               </button>
               </a>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Cajas Pedido: </small> <span id=\"suma\"> 
                  {{ viewData.boxesOrder.boxesImported | number_format(0, '.', ',') }} 
                  </span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Cajas Nacionalizadas: </small> 
                  <span id=\"suma\"> {{ simbolo | raw}} 
                  {{ viewData.boxesOrder.boxesNationalized  | number_format(0, '.', ',')}}</span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-danger\"> <small>Cajas Stock: </small> 
                  <span id=\"suma\">
                  {% set stock = viewData.boxesOrder.boxesImported - viewData.boxesOrder.boxesNationalized %}
                  {{ stock }}
                  </span>
               </h4>
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
                        <td>{{orderInvoice.valor | number_format(2, '.', ',') }}</td>
                        <td>{{orderInvoice.valor | number_format(2, '.', ',') }}</td>
                        <td>{{orderInvoice.valor | number_format(2, '.', ',') }}</td>
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
               <a href=\"{{rute_url}}gstinicial/nuevo/{{viewData.order.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Nacional <span class=\"label label-warning\">provisionado</span>
               </button>
               </a>
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
                           <a href=\"{{rute_url}}gstinicial/presentar/{{initialExpense.id_gastos_nacionalizacion}}\">
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
                                    <a href=\"{{rute_url}}gstinicial/presentar/{{initialExpense.id_gastos_nacionalizacion}}\">
                                    <span class=\"fa fa-eye fa-fw\"></span>
                                    Detalle Gasto Inicial
                                    </a> 
                                 </li>
                                 <li> 
                                    <a href=\"{{rute_url}}gstinicial/editar/{{initialExpense.id_gastos_nacionalizacion}}\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Gasto Inicial
                                    <span class=\"label label-success\"> {{initialExpense.id_gastos_nacionalizacion}}</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"{{rute_url}}gstinicial/eliminar/{{initialExpense.id_gastos_nacionalizacion}}\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Gasto Inicial
                                    <span class=\"label label-danger\">
                                    {{initialExpense.id_gastos_nacionalizacion}}
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
         <div class=\"row\">
            <div class=\"col-sm-6\">
               {% if viewData.order.regimen == 70 %}
               <a href=\"{{rute_url}}gstinicial/nuevo/{{viewData.order.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Factura Informativa <span class=\"label label-primary\">
               Parcial</span>
               </button>
               </a>
               {% endif %}
            </div>
            
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Parciales: </small>
                <span id=\"suma\"> {{ 0 | number_format(0, '.', ',') }} </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Sumas: </small> <span id=\"suma\"> 
                        \$ {{ 0 | number_format(2, '.', ',')}}</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Saldo:</small> 
                  <span id=\"suma\"> \$ {{ saldo | number_format(2, '.', ',') }} 
                  </span></h5>
            </div>
         </div>
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
         Proximamente
      </div>
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturasServicios\">
         Proximamente
      </div>
   </div>
</div>
<!--/tabs-->", "sections/base-mostrar-pedido.html.twig", "/var/www/html/app/src/views/sections/base-mostrar-pedido.html.twig");
    }
}
