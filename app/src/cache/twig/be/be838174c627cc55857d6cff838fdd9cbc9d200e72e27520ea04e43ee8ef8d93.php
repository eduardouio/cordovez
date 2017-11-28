<?php

/* sections/subsections/tab-facturas-productos-pedido.html.twig */
class __TwigTemplate_10d2e05f188b763baa85f3ee19d8e1e200c91db375d892907f743b1931b78208 extends Twig_Template
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
        echo "<div class=\"row\">
<div class=\"col-sm-6\">
   <a href=\"";
        // line 3
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
        // line 12
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()), 0, ".", ","), "html", null, true);
        echo " 
      </span>
   </h4>
</div>
<div class=\"col-sm-2\">
   <h4 class=\"text-primary\"> <small>Cajas Nacionalizadas: </small> 
      <span id=\"suma\"> ";
        // line 18
        echo ($context["simbolo"] ?? null);
        echo " 
      ";
        // line 19
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()), 0, ".", ","), "html", null, true);
        echo "</span>
   </h4>
</div>
<div class=\"col-sm-2\">
   <h4 class=\"text-danger\"> <small>Cajas Stock: </small> 
      <span id=\"suma\">
      ";
        // line 25
        $context["stock"] = ($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesImported", array()) - $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "boxesOrder", array()), "boxesNationalized", array()));
        // line 26
        echo "      ";
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
        // line 50
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
            // line 51
            echo "         <tr>
            <td>";
            // line 52
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
            <td>
               <a href=\"";
            // line 54
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
               ";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "
               </a>
            </td>
            <td>
               <a href=\"";
            // line 59
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_proveedor", array()), "html", null, true);
            echo "\">
               ";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "nombre", array()), "html", null, true);
            echo "                     
               </a>
            </td>
            <td>";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "vencimiento_pago", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "moneda", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 66
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td>";
            // line 67
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderInvoice"], "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td>";
            // line 68
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
            // line 77
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
            // line 83
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                        <span class=\"fa fa-pencil fa-fw\"></span>
                        Editar Factura 
                        <span class=\"label label-success\"> ";
            // line 86
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_factura_proveedor", array()), "html", null, true);
            echo "</span></a> 
                     </li>
                     <li>
                        <a href=\"";
            // line 89
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderInvoice"], "id_pedido_factura", array()), "html", null, true);
            echo "\">
                        <span class=\"text-danger fa fa-trash fa-fw\"></span>
                        Elminar Factura 
                        <span class=\"label label-danger\">
                        ";
            // line 93
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
        // line 102
        echo "      </tbody>
   </table>
</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "sections/subsections/tab-facturas-productos-pedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  228 => 102,  205 => 93,  196 => 89,  190 => 86,  182 => 83,  171 => 77,  159 => 68,  155 => 67,  151 => 66,  147 => 65,  143 => 64,  139 => 63,  133 => 60,  127 => 59,  120 => 55,  114 => 54,  109 => 52,  106 => 51,  89 => 50,  61 => 26,  59 => 25,  50 => 19,  46 => 18,  37 => 12,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"row\">
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
", "sections/subsections/tab-facturas-productos-pedido.html.twig", "/var/www/html/app/src/views/sections/subsections/tab-facturas-productos-pedido.html.twig");
    }
}
