<?php

/* sections/mostrar-pedido.html.twig */
class __TwigTemplate_8b7fee42f1b88f713d17ca4a32a6108eabadc10a8f86852b9aa0911bfd7874de extends Twig_Template
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
            echo " <small>días</small>  
         ";
        } elseif ((($this->getAttribute($this->getAttribute(        // line 52
($context["viewData"] ?? null), "order", array()), "dias", array()) > 29) && ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "dias", array()) < 300))) {
            // line 53
            echo "         ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["meses"] ?? null), 2, ".", ","), "html", null, true);
            echo " <small><b>Meses</b></small>  
         ";
        } elseif (($this->getAttribute($this->getAttribute(        // line 54
($context["viewData"] ?? null), "order", array()), "dias", array()) > 300)) {
            // line 55
            echo "         ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["anos"] ?? null), 3, ".", ","), "html", null, true);
            echo " <small>años</small>
         ";
        }
        // line 57
        echo "         </label>
      </div>
      <div class=\"col-sm-2\">
         <strong>Provisiones:</strong> 
         <span class=\"text-warning\">
         ";
        // line 62
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["viewData"] ?? null), "provisions", array()), 0, ".", ","), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Consolidado:</strong> 
         <span class=\"text-primary\">
         ";
        // line 68
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["viewData"] ?? null), "consolided", array()), 0, ".", ","), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Saldo:</strong> 
         <span class=\"text-primary\">
         ";
        // line 74
        $context["saldo"] = ($this->getAttribute(($context["viewData"] ?? null), "provisions", array()) - $this->getAttribute(($context["viewData"] ?? null), "consolided", array()));
        // line 75
        echo "         ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["saldo"] ?? null), 0, ".", ","), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>";
        // line 79
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
        // line 87
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "estado", array()) == "ABIERTO")) {
            // line 88
            echo "         <span class=\"label label-success\">Abierto</span>
         ";
        } else {
            // line 90
            echo "         <span class=\"label label-died\">Cerrado</span>
         ";
        }
        // line 92
        echo "         </a>
      </li>
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
        // line 108
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">RÉGIMEN</span>
                  <span class=\"form-control\">";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "regimen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">INCOTERM</span>
                  <span class=\"form-control\">";
        // line 120
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "incoterm", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">PAIS</span>
                  <span class=\"form-control\"> ";
        // line 126
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "pais_origen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">CIUDAD</span>
                  <span class=\"form-control\">";
        // line 132
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "ciudad_origen", array()), "html", null, true);
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
        // line 141
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "seguro_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">FLETE SENAE</span>
                  <span class=\"form-control\" > ";
        // line 147
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "flete_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">ARRIBO</span>
                  <span class=\"form-control\" > ";
        // line 153
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "fecha_arribo", array()), "html", null, true);
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
        // line 162
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "comentarios", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
            <div class=\"col-md-6\">
               <hr>
               <a href=\"";
        // line 169
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"text-primary\">
               <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar</button></a>
               <a href=\"";
        // line 171
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/eliminar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
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
        // line 181
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
        // line 190
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()), 0, ".", ","), "html", null, true);
        echo " 
                  </span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Cajas Nacionalizadas: </small> 
                  <span id=\"suma\"> ";
        // line 196
        echo ($context["simbolo"] ?? null);
        echo " 
                  ";
        // line 197
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()), 0, ".", ","), "html", null, true);
        echo "</span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-danger\"> <small>Cajas Stock: </small> 
                  <span id=\"suma\">
                  ";
        // line 203
        $context["stock"] = ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()) - $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()));
        // line 204
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
        // line 228
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
            // line 229
            echo "                     <tr>
                        <td>";
            // line 230
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           <a href=\"";
            // line 232
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                           ";
            // line 233
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>
                           <a href=\"";
            // line 237
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 238
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "nombre", array()), "html", null, true);
            echo "                     
                           </a>
                        </td>
                        <td>";
            // line 241
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 242
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "vencimiento_pago", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 243
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "moneda", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 244
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 245
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 246
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
            // line 255
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
            // line 261
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Factura 
                                    <span class=\"label label-success\"> ";
            // line 264
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 267
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Factura 
                                    <span class=\"label label-danger\">
                                    ";
            // line 271
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
        // line 280
        echo "                  </tbody>
               </table>
            </div>
         </div>
         <div class=\"row\">
            <div class=\"col-sm-3\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#myModal\">
               <span class=\"fa fa-gear\"></span>
               Generar Gastos Iniciales
               </button>
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
        // line 301
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "regimen", array()) == 70)) {
            // line 302
            echo "               <a href=\"";
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
            echo "\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Nacional <span class=\"label label-warning\">provisionado</span>
               </button>
               </a>
               ";
        } else {
            // line 309
            echo "               <h5 class=\"text-primary\">GASTOS INICIALES RÉGIMEN 10</h5>
               ";
        }
        // line 311
        echo "            </div>
            ";
        // line 312
        $context["cantidad"] = 0;
        // line 313
        echo "            ";
        $context["provisionado"] = 0;
        // line 314
        echo "            ";
        $context["convalidado"] = 0;
        // line 315
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "initialExpenses", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["initialExpense"]) {
            // line 316
            echo "            ";
            $context["cantidad"] = (($context["cantidad"] ?? null) + 1);
            // line 317
            echo "            ";
            $context["provisionado"] = (($context["provisionado"] ?? null) + $this->getAttribute($context["initialExpense"], "valor_provisionado", array()));
            // line 318
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initialExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 319
        echo "            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Cantidad: </small> <span id=\"suma\"> ";
        // line 320
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["cantidad"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Provisionado: </small> <span id=\"suma\"> \$ ";
        // line 323
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["provisionado"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Convalidado: </small> <span id=\"suma\"> \$ ";
        // line 326
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
        // line 345
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
            // line 346
            echo "                     <tr>
                        <td>";
            // line 347
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           <a href=\"";
            // line 349
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                           ";
            // line 350
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "concepto", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>
                           <a href=\"";
            // line 354
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 355
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "nombre", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>";
            // line 358
            echo $this->getAttribute($context["initialExpense"], "comentarios", array());
            echo "</td>
                        <td>";
            // line 359
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["initialExpense"], "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>
                        <td>";
            // line 360
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
            // line 369
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
            // line 375
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Gasto Inicial
                                    <span class=\"label label-success\"> ";
            // line 378
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 381
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Gasto Inicial
                                    <span class=\"label label-danger\">
                                    ";
            // line 385
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
        // line 394
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
        // line 404
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "regimen", array()) == 70)) {
            // line 405
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
        // line 413
        echo "            </div>
            
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Parciales: </small>
                <span id=\"suma\"> ";
        // line 417
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Sumas: </small> <span id=\"suma\"> 
                        \$ ";
        // line 421
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
        echo "</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Saldo:</small> 
                  <span id=\"suma\"> \$ ";
        // line 425
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
        // line 443
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
            // line 444
            echo "                     <tr>
                        <td>";
            // line 445
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           ";
            // line 447
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "nro_factura_informativa", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                           <a href=\"";
            // line 450
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 451
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "identificacion_proveedor", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>";
            // line 454
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>
                        <td>";
            // line 455
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
            // line 464
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
            // line 470
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
            // line 476
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Factura 
                                    <span class=\"label label-success\"> ";
            // line 479
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 482
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Factura 
                                    <span class=\"label label-danger\">
                                    ";
            // line 486
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
        // line 495
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
<!--/tabs-->
<!-- Modal -->
<div class=\"modal fade bs-example-modal-sm\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
   <div class=\"modal-dialog\" role=\"document\">
      <div class=\"modal-content\">
         <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
            <h4 class=\"modal-title\" id=\"myModalLabel\">
               Generador Gastos Iniciales Pedido: 
               <span class=\"text-danger\">";
        // line 518
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "</span>
            </h4>
         </div>
         <div class=\"modal-body\">
            <p>
               Esta acción Generará los gastos iniciales del pedido, recuerde que si hace cambios en los valores de las facturas del pedido
               ";
        // line 524
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo " se deben volver a generar los gastos inciales, debido a que el cálculo de algunos rubros dependen de los valores de las facturas.
            </p>
         </div>
         <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-default btn-sm\" data-dismiss=\"modal\">Cancelar</button>
            <a 
            href=\"";
        // line 530
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/calcularGI/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
            <button type=\"button\" class=\"btn btn-primary btn-sm\">
            <span class=\"fa fa-warning\"></span>
            Generar Gastos Iniciales 
            </button>
            </a>
         </div>
      </div>
   </div>
</div>
<script type=\"text/javascript\">
// Javascript to enable link to tab
var hash = document.location.hash;
var prefix = \"tab_\";
if (hash) {
    \$('.nav-tabs a[href=\"'+hash.replace(prefix,\"\")+'\"]').tab('show');
} 

// Change hash for page-reload
\$('.nav-tabs a').on('shown', function (e) {
    window.location.hash = e.target.hash.replace(\"#\", \"#\" + prefix);
});
</script>";
    }

    public function getTemplateName()
    {
        return "sections/mostrar-pedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  984 => 530,  975 => 524,  966 => 518,  941 => 495,  918 => 486,  909 => 482,  903 => 479,  895 => 476,  884 => 470,  873 => 464,  861 => 455,  857 => 454,  851 => 451,  845 => 450,  839 => 447,  834 => 445,  831 => 444,  814 => 443,  793 => 425,  786 => 421,  779 => 417,  773 => 413,  759 => 405,  757 => 404,  745 => 394,  722 => 385,  713 => 381,  707 => 378,  699 => 375,  688 => 369,  676 => 360,  672 => 359,  668 => 358,  662 => 355,  656 => 354,  649 => 350,  643 => 349,  638 => 347,  635 => 346,  618 => 345,  596 => 326,  590 => 323,  584 => 320,  581 => 319,  575 => 318,  572 => 317,  569 => 316,  564 => 315,  561 => 314,  558 => 313,  556 => 312,  553 => 311,  549 => 309,  536 => 302,  534 => 301,  511 => 280,  488 => 271,  479 => 267,  473 => 264,  465 => 261,  454 => 255,  442 => 246,  438 => 245,  434 => 244,  430 => 243,  426 => 242,  422 => 241,  416 => 238,  410 => 237,  403 => 233,  397 => 232,  392 => 230,  389 => 229,  372 => 228,  344 => 204,  342 => 203,  333 => 197,  329 => 196,  320 => 190,  306 => 181,  291 => 171,  284 => 169,  274 => 162,  262 => 153,  253 => 147,  244 => 141,  232 => 132,  223 => 126,  214 => 120,  205 => 114,  196 => 108,  178 => 92,  174 => 90,  170 => 88,  168 => 87,  157 => 79,  149 => 75,  147 => 74,  138 => 68,  129 => 62,  122 => 57,  116 => 55,  114 => 54,  109 => 53,  107 => 52,  102 => 51,  99 => 50,  96 => 49,  94 => 48,  85 => 42,  78 => 37,  72 => 35,  68 => 33,  66 => 32,  55 => 23,  51 => 21,  45 => 19,  43 => 18,  31 => 9,  23 => 3,  21 => 2,  19 => 1,);
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
         {{viewData.order.dias | number_format(1, '.', ',') }} <small>días</small>  
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
         {% if viewData.order.estado == 'ABIERTO' %}
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
   <br>
   <div class=\"tab-content\">
      <div role=\"tabpanel\" class=\"tab-pane active\" id=\"pedido\">
         <div class=\"row\">
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" >PEDIDO</span>
                  <span class=\"form-control\">{{viewData.order.nro_pedido}} </span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">RÉGIMEN</span>
                  <span class=\"form-control\">{{viewData.order.regimen }}</span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">INCOTERM</span>
                  <span class=\"form-control\">{{viewData.order.incoterm}} </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">PAIS</span>
                  <span class=\"form-control\"> {{viewData.order.pais_origen}}</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">CIUDAD</span>
                  <span class=\"form-control\">{{viewData.order.ciudad_origen}}</span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">SEGURO SENAE</span>
                  <span class=\"form-control\"> {{viewData.order.seguro_aduana }}</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">FLETE SENAE</span>
                  <span class=\"form-control\" > {{viewData.order.flete_aduana  }}</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">ARRIBO</span>
                  <span class=\"form-control\" > {{viewData.order.fecha_arribo}}  </span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-12\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" id=\"basic-addon3\">COMENTARIOS</span>
                  <span type=\"text\" class=\"form-control\">{{viewData.order.comentarios}} </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
            <div class=\"col-md-6\">
               <hr>
               <a href=\"{{rute_url}}/pedido/editar/{{viewData.order.nro_pedido}}\" class=\"text-primary\">
               <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar</button></a>
               <a href=\"{{rute_url}}/pedido/eliminar/{{viewData.order.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\"> <span class=\"fa fa-trash fa-fw\"></span>Elimnar</button></a>
            </div>
         </div>
         <!-- /tabPedido-->
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
         <div class=\"row\">
            <div class=\"col-sm-3\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#myModal\">
               <span class=\"fa fa-gear\"></span>
               Generar Gastos Iniciales
               </button>
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
               {% if viewData.order.regimen == 70 %}
               <a href=\"{{rute_url}}gstinicial/nuevo/{{viewData.order.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Nacional <span class=\"label label-warning\">provisionado</span>
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
<!--/tabs-->
<!-- Modal -->
<div class=\"modal fade bs-example-modal-sm\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
   <div class=\"modal-dialog\" role=\"document\">
      <div class=\"modal-content\">
         <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
            <h4 class=\"modal-title\" id=\"myModalLabel\">
               Generador Gastos Iniciales Pedido: 
               <span class=\"text-danger\">{{ viewData.order.nro_pedido }}</span>
            </h4>
         </div>
         <div class=\"modal-body\">
            <p>
               Esta acción Generará los gastos iniciales del pedido, recuerde que si hace cambios en los valores de las facturas del pedido
               {{ viewData.order.nro_pedido }} se deben volver a generar los gastos inciales, debido a que el cálculo de algunos rubros dependen de los valores de las facturas.
            </p>
         </div>
         <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-default btn-sm\" data-dismiss=\"modal\">Cancelar</button>
            <a 
            href=\"{{rute_url}}pedido/calcularGI/{{viewData.order.nro_pedido}}\">
            <button type=\"button\" class=\"btn btn-primary btn-sm\">
            <span class=\"fa fa-warning\"></span>
            Generar Gastos Iniciales 
            </button>
            </a>
         </div>
      </div>
   </div>
</div>
<script type=\"text/javascript\">
// Javascript to enable link to tab
var hash = document.location.hash;
var prefix = \"tab_\";
if (hash) {
    \$('.nav-tabs a[href=\"'+hash.replace(prefix,\"\")+'\"]').tab('show');
} 

// Change hash for page-reload
\$('.nav-tabs a').on('shown', function (e) {
    window.location.hash = e.target.hash.replace(\"#\", \"#\" + prefix);
});
</script>", "sections/mostrar-pedido.html.twig", "/var/www/html/app/src/views/sections/mostrar-pedido.html.twig");
    }
}
