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
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "nombres", array(), "array"), "html", null, true);
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
      <!-- tabPedidoDetalle-->
      <div role=\"tabpanel\" class=\"tab-pane active\" id=\"pedido\">
         ";
        // line 106
        $this->loadTemplate("sections/subsections/tab-detalle-pedido.html.twig", "sections/mostrar-pedido.html.twig", 106)->display($context);
        // line 107
        echo "      </div>
      <!-- /tabPedidoDetalle-->
      <!-- tabFacturas-->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturas\">
         ";
        // line 111
        $this->loadTemplate("sections/subsections/tab-facturas-productos-pedido.html.twig", "sections/mostrar-pedido.html.twig", 111)->display($context);
        echo "            
      </div>
      <!-- /Tab Facturas-->
      <!-- Gastos iniciales -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"gastos\">
         ";
        // line 116
        $this->loadTemplate("sections/subsections/tab-gastos-iniciales.html.twig", "sections/mostrar-pedido.html.twig", 116)->display($context);
        echo "            
      </div>
      <!-- /Gastos iniciales -->
      <!-- factura Nacionalizaciones -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"nacionalizaciones\">
         ";
        // line 121
        $this->loadTemplate("sections/subsections/tab-nacionalizaciones.html.twig", "sections/mostrar-pedido.html.twig", 121)->display($context);
        echo "            
      </div>
      <!-- /factura Nacionalizaciones -->
      <!-- Tab Impuestos -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"impuestos\">
         ";
        // line 126
        $this->loadTemplate("sections/subsections/tab-impuestos.html.twig", "sections/mostrar-pedido.html.twig", 126)->display($context);
        echo "            
      </div>
      <!-- /Tab Impuestos -->
      <!-- Tab Facturas Servicios -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturasServicios\">
         ";
        // line 131
        $this->loadTemplate("sections/subsections/tab-facturas-servicios.html.twig", "sections/mostrar-pedido.html.twig", 131)->display($context);
        echo "            
      </div>
      <!-- /Tab Facturas Servicios -->
   </div>
</div>
<!--/tabs-->";
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
        return array (  234 => 131,  226 => 126,  218 => 121,  210 => 116,  202 => 111,  196 => 107,  194 => 106,  180 => 94,  176 => 92,  172 => 90,  170 => 89,  158 => 80,  150 => 76,  148 => 75,  139 => 69,  130 => 63,  123 => 58,  117 => 56,  115 => 55,  110 => 54,  108 => 53,  102 => 51,  99 => 50,  96 => 49,  94 => 48,  85 => 42,  78 => 37,  72 => 35,  68 => 33,  66 => 32,  55 => 23,  51 => 21,  45 => 19,  43 => 18,  31 => 9,  23 => 3,  21 => 2,  19 => 1,);
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
         <strong>Creado Por:</strong> <span>{{user['nombres']}}</span>
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
      <!-- tabPedidoDetalle-->
      <div role=\"tabpanel\" class=\"tab-pane active\" id=\"pedido\">
         {% include 'sections/subsections/tab-detalle-pedido.html.twig' %}
      </div>
      <!-- /tabPedidoDetalle-->
      <!-- tabFacturas-->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturas\">
         {% include 'sections/subsections/tab-facturas-productos-pedido.html.twig' %}            
      </div>
      <!-- /Tab Facturas-->
      <!-- Gastos iniciales -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"gastos\">
         {% include 'sections/subsections/tab-gastos-iniciales.html.twig' %}            
      </div>
      <!-- /Gastos iniciales -->
      <!-- factura Nacionalizaciones -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"nacionalizaciones\">
         {% include 'sections/subsections/tab-nacionalizaciones.html.twig' %}            
      </div>
      <!-- /factura Nacionalizaciones -->
      <!-- Tab Impuestos -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"impuestos\">
         {% include 'sections/subsections/tab-impuestos.html.twig' %}            
      </div>
      <!-- /Tab Impuestos -->
      <!-- Tab Facturas Servicios -->
      <div role=\"tabpanel\" class=\"tab-pane\" id=\"facturasServicios\">
         {% include 'sections/subsections/tab-facturas-servicios.html.twig' %}            
      </div>
      <!-- /Tab Facturas Servicios -->
   </div>
</div>
<!--/tabs-->", "sections/mostrar-pedido.html.twig", "/var/www/html/app/src/views/sections/mostrar-pedido.html.twig");
    }
}
