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
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "bg_isclosed", array()) == "0")) {
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
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">DIAS LIBRES</span>
                  <span class=\"form-control\" > ";
        // line 159
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "dias_libres", array()), "html", null, true);
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
        // line 168
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "comentarios", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
               <hr>
            <div class=\"col-md-6\">
               <a href=\"";
        // line 175
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"text-primary\">
               <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar Pedido 
               </button></a>
               &nbsp;&nbsp;&nbsp;
               <a href=\"";
        // line 179
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/eliminar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button class=\"btn btn-sm btn-default\"> <span class=\"fa fa-trash fa-fw\"></span>Elimnar Pedido 
               </button></a>
            </div>
            <div class=\"col-sm-3\">
               <a href=\"";
        // line 184
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/validOrder/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
               <span class=\"fa fa-gear\"></span>
               Generar Gastos Iniciales
               </button>
               </a>
            </div>
            <div class=\"col-sm-3\">
               <a href=\"";
        // line 192
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "nacionalizacion/validOrder/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
               <span class=\"fa fa-gear\"></span>
               Nacionalizar Total/Parcial
               </button>
               </a>
            </div>
         </div>
         <!-- /tabPedido-->
      </div>
      <!-- /tabFacturas-->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturas\">
         <div class=\"row\">
            <div class=\"col-sm-6\">
               <a href=\"";
        // line 206
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
        // line 215
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()), 0, ".", ","), "html", null, true);
        echo " 
                  </span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Cajas Nacionalizadas: </small> 
                  <span id=\"suma\"> ";
        // line 221
        echo ($context["simbolo"] ?? null);
        echo " 
                  ";
        // line 222
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()), 0, ".", ","), "html", null, true);
        echo "</span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-danger\"> <small>Cajas Stock: </small> 
                  <span id=\"suma\">
                  ";
        // line 228
        $context["stock"] = ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()) - $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()));
        // line 229
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
        // line 253
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
            // line 254
            echo "                     <tr>
                        <td>";
            // line 255
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           <a href=\"";
            // line 257
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                           ";
            // line 258
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>
                           <a href=\"";
            // line 262
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 263
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "nombre", array()), "html", null, true);
            echo "                     
                           </a>
                        </td>
                        <td>";
            // line 266
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 267
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "vencimiento_pago", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 268
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "moneda", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 269
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>
                        <td>";
            // line 270
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>
                        <td>";
            // line 271
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
            // line 280
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
            // line 286
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Factura 
                                    <span class=\"label label-success\"> ";
            // line 289
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 292
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Factura 
                                    <span class=\"label label-danger\">
                                    ";
            // line 296
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
        // line 305
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
        // line 318
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
        // line 325
        $context["cantidad"] = 0;
        // line 326
        echo "            ";
        $context["provisionado"] = 0;
        // line 327
        echo "            ";
        $context["convalidado"] = 0;
        // line 328
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "initialExpenses", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["initialExpense"]) {
            // line 329
            echo "            ";
            $context["cantidad"] = (($context["cantidad"] ?? null) + 1);
            // line 330
            echo "            ";
            $context["provisionado"] = (($context["provisionado"] ?? null) + $this->getAttribute($context["initialExpense"], "valor_provisionado", array()));
            // line 331
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initialExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 332
        echo "            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Cantidad: </small> <span id=\"suma\"> ";
        // line 333
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["cantidad"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Provisionado: </small> <span id=\"suma\"> \$ ";
        // line 336
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["provisionado"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Convalidado: </small> <span id=\"suma\"> \$ ";
        // line 339
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
        // line 358
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
            // line 359
            echo "                     <tr>
                        <td>";
            // line 360
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           <a href=\"";
            // line 362
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                           ";
            // line 363
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "concepto", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>
                           <a href=\"";
            // line 367
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 368
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "nombre", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>";
            // line 371
            echo $this->getAttribute($context["initialExpense"], "comentarios", array());
            echo "</td>
                        <td>";
            // line 372
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["initialExpense"], "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>
                        <td>";
            // line 373
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
            // line 382
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
            // line 388
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Gasto Inicial
                                    <span class=\"label label-success\"> ";
            // line 391
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 394
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Gasto Inicial
                                    <span class=\"label label-danger\">
                                    ";
            // line 398
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
        // line 407
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
        // line 418
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "regimen", array()) == 70)) {
            // line 419
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
        // line 427
        echo "            </div>
            
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Parciales: </small>
                <span id=\"suma\"> ";
        // line 431
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Sumas: </small> <span id=\"suma\"> 
                        \$ ";
        // line 435
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
        echo "</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Saldo:</small> 
                  <span id=\"suma\"> \$ ";
        // line 439
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
        // line 457
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
            // line 458
            echo "                     <tr>
                        <td>";
            // line 459
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           ";
            // line 461
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "nro_factura_informativa", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                           <a href=\"";
            // line 464
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 465
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "identificacion_proveedor", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>";
            // line 468
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>
                        <td>";
            // line 469
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
            // line 478
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
            // line 484
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
            // line 490
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Factura 
                                    <span class=\"label label-success\"> ";
            // line 493
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 496
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Factura 
                                    <span class=\"label label-danger\">
                                    ";
            // line 500
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
        // line 509
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
        return array (  962 => 509,  939 => 500,  930 => 496,  924 => 493,  916 => 490,  905 => 484,  894 => 478,  882 => 469,  878 => 468,  872 => 465,  866 => 464,  860 => 461,  855 => 459,  852 => 458,  835 => 457,  814 => 439,  807 => 435,  800 => 431,  794 => 427,  780 => 419,  778 => 418,  765 => 407,  742 => 398,  733 => 394,  727 => 391,  719 => 388,  708 => 382,  696 => 373,  692 => 372,  688 => 371,  682 => 368,  676 => 367,  669 => 363,  663 => 362,  658 => 360,  655 => 359,  638 => 358,  616 => 339,  610 => 336,  604 => 333,  601 => 332,  595 => 331,  592 => 330,  589 => 329,  584 => 328,  581 => 327,  578 => 326,  576 => 325,  564 => 318,  549 => 305,  526 => 296,  517 => 292,  511 => 289,  503 => 286,  492 => 280,  480 => 271,  476 => 270,  472 => 269,  468 => 268,  464 => 267,  460 => 266,  454 => 263,  448 => 262,  441 => 258,  435 => 257,  430 => 255,  427 => 254,  410 => 253,  382 => 229,  380 => 228,  371 => 222,  367 => 221,  358 => 215,  344 => 206,  325 => 192,  312 => 184,  302 => 179,  293 => 175,  283 => 168,  271 => 159,  262 => 153,  253 => 147,  244 => 141,  232 => 132,  223 => 126,  214 => 120,  205 => 114,  196 => 108,  178 => 92,  174 => 90,  170 => 88,  168 => 87,  157 => 79,  149 => 75,  147 => 74,  138 => 68,  129 => 62,  122 => 57,  116 => 55,  114 => 54,  109 => 53,  107 => 52,  102 => 51,  99 => 50,  96 => 49,  94 => 48,  85 => 42,  78 => 37,  72 => 35,  68 => 33,  66 => 32,  55 => 23,  51 => 21,  45 => 19,  43 => 18,  31 => 9,  23 => 3,  21 => 2,  19 => 1,);
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
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">DIAS LIBRES</span>
                  <span class=\"form-control\" > {{viewData.order.dias_libres}}  </span>
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
               <hr>
            <div class=\"col-md-6\">
               <a href=\"{{rute_url}}/pedido/editar/{{viewData.order.nro_pedido}}\" class=\"text-primary\">
               <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar Pedido 
               </button></a>
               &nbsp;&nbsp;&nbsp;
               <a href=\"{{rute_url}}/pedido/eliminar/{{viewData.order.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\"> <span class=\"fa fa-trash fa-fw\"></span>Elimnar Pedido 
               </button></a>
            </div>
            <div class=\"col-sm-3\">
               <a href=\"{{rute_url}}gstinicial/validOrder/{{viewData.order.nro_pedido}}\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
               <span class=\"fa fa-gear\"></span>
               Generar Gastos Iniciales
               </button>
               </a>
            </div>
            <div class=\"col-sm-3\">
               <a href=\"{{rute_url}}nacionalizacion/validOrder/{{viewData.order.nro_pedido}}\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
               <span class=\"fa fa-gear\"></span>
               Nacionalizar Total/Parcial
               </button>
               </a>
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
<!--/tabs-->

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
