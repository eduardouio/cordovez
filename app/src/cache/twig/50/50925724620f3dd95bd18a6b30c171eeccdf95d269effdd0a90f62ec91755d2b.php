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
        // line 88
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "bg_isclosed", array()) == "0")) {
            // line 89
            echo "         <span class=\"label label-success\">Abierto</span>
         ";
        } else {
            // line 91
            echo "         <span class=\"label label-died\">Cerrado</span>
         ";
        }
        // line 93
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
        // line 109
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">RÉGIMEN</span>
                  <span class=\"form-control\">";
        // line 115
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "regimen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">INCOTERM</span>
                  <span class=\"form-control\">";
        // line 121
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "incoterm", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">PAIS</span>
                  <span class=\"form-control\"> ";
        // line 127
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "pais_origen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">CIUDAD</span>
                  <span class=\"form-control\">";
        // line 133
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
        // line 142
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "seguro_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">FLETE SENAE</span>
                  <span class=\"form-control\" > ";
        // line 148
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "flete_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">ARRIBO</span>
                  <span class=\"form-control\" > ";
        // line 154
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "fecha_arribo", array()), "html", null, true);
        echo "  </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">DIAS LIBRES</span>
                  <span class=\"form-control\" > ";
        // line 160
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
        // line 169
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "comentarios", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
               <hr>
            <div class=\"col-md-6\">
               <a href=\"";
        // line 176
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"text-primary\">
               <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar Pedido 
               </button></a>
               &nbsp;&nbsp;&nbsp;
               <a href=\"";
        // line 180
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/eliminar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button class=\"btn btn-sm btn-default\"> <span class=\"fa fa-trash fa-fw\"></span>Elimnar Pedido 
               </button></a>
            </div>
            <div class=\"col-sm-3\">
               <a href=\"";
        // line 185
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
        // line 193
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
        // line 207
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
        // line 216
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()), 0, ".", ","), "html", null, true);
        echo " 
                  </span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Cajas Nacionalizadas: </small> 
                  <span id=\"suma\"> ";
        // line 222
        echo ($context["simbolo"] ?? null);
        echo " 
                  ";
        // line 223
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()), 0, ".", ","), "html", null, true);
        echo "</span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-danger\"> <small>Cajas Stock: </small> 
                  <span id=\"suma\">
                  ";
        // line 229
        $context["stock"] = ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()) - $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()));
        // line 230
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
        // line 254
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
            // line 255
            echo "                     <tr>
                        <td>";
            // line 256
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           <a href=\"";
            // line 258
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                           ";
            // line 259
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>
                           <a href=\"";
            // line 263
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 264
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "nombre", array()), "html", null, true);
            echo "                     
                           </a>
                        </td>
                        <td>";
            // line 267
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 268
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "vencimiento_pago", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 269
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "moneda", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 270
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>
                        <td>";
            // line 271
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>
                        <td>";
            // line 272
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
            // line 281
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
            // line 287
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Factura 
                                    <span class=\"label label-success\"> ";
            // line 290
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 293
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Factura 
                                    <span class=\"label label-danger\">
                                    ";
            // line 297
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
        // line 306
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
        // line 319
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
        // line 326
        $context["cantidad"] = 0;
        // line 327
        echo "            ";
        $context["provisionado"] = 0;
        // line 328
        echo "            ";
        $context["convalidado"] = 0;
        // line 329
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "initialExpenses", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["initialExpense"]) {
            // line 330
            echo "            ";
            $context["cantidad"] = (($context["cantidad"] ?? null) + 1);
            // line 331
            echo "            ";
            $context["provisionado"] = (($context["provisionado"] ?? null) + $this->getAttribute($context["initialExpense"], "valor_provisionado", array()));
            // line 332
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initialExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 333
        echo "            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Cantidad: </small> <span id=\"suma\"> ";
        // line 334
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["cantidad"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Provisionado: </small> <span id=\"suma\"> \$ ";
        // line 337
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["provisionado"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Convalidado: </small> <span id=\"suma\"> \$ ";
        // line 340
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
        // line 359
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
            // line 360
            echo "                     <tr>
                        <td>";
            // line 361
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           <a href=\"";
            // line 363
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                           ";
            // line 364
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "concepto", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>
                           <a href=\"";
            // line 368
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 369
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "nombre", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>";
            // line 372
            echo $this->getAttribute($context["initialExpense"], "comentarios", array());
            echo "</td>
                        <td>";
            // line 373
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["initialExpense"], "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>
                        <td>";
            // line 374
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
            // line 383
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
            // line 389
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Gasto Inicial
                                    <span class=\"label label-success\"> ";
            // line 392
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 395
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Gasto Inicial
                                    <span class=\"label label-danger\">
                                    ";
            // line 399
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
        // line 408
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
        // line 419
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "regimen", array()) == 70)) {
            // line 420
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
        // line 428
        echo "            </div>
            
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Parciales: </small>
                <span id=\"suma\"> ";
        // line 432
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Sumas: </small> <span id=\"suma\"> 
                        \$ ";
        // line 436
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
        echo "</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Saldo:</small> 
                  <span id=\"suma\"> \$ ";
        // line 440
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
        // line 458
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
            // line 459
            echo "                     <tr>
                        <td>";
            // line 460
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           ";
            // line 462
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "nro_factura_informativa", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                           <a href=\"";
            // line 465
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 466
            echo twig_escape_filter($this->env, $this->getAttribute($context["nationalization"], "identificacion_proveedor", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>";
            // line 469
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>
                        <td>";
            // line 470
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
            // line 479
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
            // line 485
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
            // line 491
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Factura 
                                    <span class=\"label label-success\"> ";
            // line 494
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 497
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initialExpense"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Factura 
                                    <span class=\"label label-danger\">
                                    ";
            // line 501
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
        // line 510
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
        return array (  963 => 510,  940 => 501,  931 => 497,  925 => 494,  917 => 491,  906 => 485,  895 => 479,  883 => 470,  879 => 469,  873 => 466,  867 => 465,  861 => 462,  856 => 460,  853 => 459,  836 => 458,  815 => 440,  808 => 436,  801 => 432,  795 => 428,  781 => 420,  779 => 419,  766 => 408,  743 => 399,  734 => 395,  728 => 392,  720 => 389,  709 => 383,  697 => 374,  693 => 373,  689 => 372,  683 => 369,  677 => 368,  670 => 364,  664 => 363,  659 => 361,  656 => 360,  639 => 359,  617 => 340,  611 => 337,  605 => 334,  602 => 333,  596 => 332,  593 => 331,  590 => 330,  585 => 329,  582 => 328,  579 => 327,  577 => 326,  565 => 319,  550 => 306,  527 => 297,  518 => 293,  512 => 290,  504 => 287,  493 => 281,  481 => 272,  477 => 271,  473 => 270,  469 => 269,  465 => 268,  461 => 267,  455 => 264,  449 => 263,  442 => 259,  436 => 258,  431 => 256,  428 => 255,  411 => 254,  383 => 230,  381 => 229,  372 => 223,  368 => 222,  359 => 216,  345 => 207,  326 => 193,  313 => 185,  303 => 180,  294 => 176,  284 => 169,  272 => 160,  263 => 154,  254 => 148,  245 => 142,  233 => 133,  224 => 127,  215 => 121,  206 => 115,  197 => 109,  179 => 93,  175 => 91,  171 => 89,  169 => 88,  158 => 80,  150 => 76,  148 => 75,  139 => 69,  130 => 63,  123 => 58,  117 => 56,  115 => 55,  110 => 54,  108 => 53,  102 => 51,  99 => 50,  96 => 49,  94 => 48,  85 => 42,  78 => 37,  72 => 35,  68 => 33,  66 => 32,  55 => 23,  51 => 21,  45 => 19,  43 => 18,  31 => 9,  23 => 3,  21 => 2,  19 => 1,);
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
