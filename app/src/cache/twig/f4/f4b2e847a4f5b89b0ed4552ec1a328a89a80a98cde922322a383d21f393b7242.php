<?php

/* forms/frm-facturas-detalle.html.twig */
class __TwigTemplate_afce542c082949daca9e28e9d8d216cdce8ebf593784f9a6b8667cde1d68e0d8 extends Twig_Template
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
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Proveedor:</strong> <span>";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["document"] ?? null), "supplier", array()), "nombre", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Ruc:</strong> <span>";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["document"] ?? null), "supplier", array()), "identificacion_proveedor", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Fecha:</strong> <span>";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "fecha_emision", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-5\">
\t\t\t<strong>Comentarios:</strong> <span>";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "comentarios", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Valor \$:</strong> <span class=\"text-primary\">";
        // line 18
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["document"] ?? null), "valor", array()), 2, ",", "."), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Justificado \$:</strong> <span class=\"text-success\"> \$
\t\t\t\t";
        // line 22
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ",", "."), "html", null, true);
        echo "
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Pendiente \$:</strong> <span class=\"text-danger\"> \$ ";
        // line 26
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ",", "."), "html", null, true);
        echo "
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Creado Por :</strong> <span>";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "nombres", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<span>";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "date_create", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t</div>
</div>
<br>
<div class=\"alert alert-info alert-dismissable\">
\t<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
\t\t<span class=\"fa fa-warning\"></span> Seleccione un pedido y una
\t\tprovision a justificar, se puede justificar de forma parcial o
\t\tcompletamente el valor de una provisión. 
</div>

<form action\"";
        // line 45
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/detallefacpago/nuevo/\" method=\"post\">
<div class=\"row\">
<div class=\"col-md-2\">
<div class=\"form-group\">
<label>Nro Pedido</label>
<select class=\"form-control\">
<option selected=\"\">Seleccione..</option>
";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 53
            echo "<option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo " </option>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "</select>
</div>
</div>
<div class=\"col-md-6\">
<div class=\"form-group\">
<label> Concepto: </label>
<select class=\"form-control\">
<option selected=\"\">Seleccione...</option>
";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 64
            echo "\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["order"], "expenses", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["expense"]) {
                // line 65
                echo "\t\t<option>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["expense"], "concepto", array()), "html", null, true);
                echo "</option>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['expense'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            echo "\t
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo " 
</select>\t
</div>
</div>
</div>
</form>
<script type=\"text/javascript\">
var orders = ";
        // line 74
        echo ($context["orders"] ?? null);
        echo ";

</script>";
    }

    public function getTemplateName()
    {
        return "forms/frm-facturas-detalle.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 74,  152 => 67,  145 => 66,  136 => 65,  131 => 64,  127 => 63,  117 => 55,  106 => 53,  102 => 52,  92 => 45,  77 => 33,  71 => 30,  64 => 26,  57 => 22,  50 => 18,  42 => 13,  36 => 10,  30 => 7,  24 => 4,  19 => 1,);
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
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Proveedor:</strong> <span>{{ document.supplier.nombre }}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Ruc:</strong> <span>{{ document.supplier.identificacion_proveedor }}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Fecha:</strong> <span>{{ document.fecha_emision  }}</span>
\t\t</div>
\t\t<div class=\"col-md-5\">
\t\t\t<strong>Comentarios:</strong> <span>{{ document.comentarios }}</span>
\t\t</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Valor \$:</strong> <span class=\"text-primary\">{{ document.valor | number_format(2,',','.')}}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Justificado \$:</strong> <span class=\"text-success\"> \$
\t\t\t\t{{ 0 | number_format(0,',','.') }}
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Pendiente \$:</strong> <span class=\"text-danger\"> \$ {{ 0 | number_format(0,',','.') }}
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Creado Por :</strong> <span>{{ user.nombres }}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<span>{{ document.date_create }}</span>
\t\t</div>
\t</div>
</div>
<br>
<div class=\"alert alert-info alert-dismissable\">
\t<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
\t\t<span class=\"fa fa-warning\"></span> Seleccione un pedido y una
\t\tprovision a justificar, se puede justificar de forma parcial o
\t\tcompletamente el valor de una provisión. 
</div>

<form action\"{{ rute_url }}/detallefacpago/nuevo/\" method=\"post\">
<div class=\"row\">
<div class=\"col-md-2\">
<div class=\"form-group\">
<label>Nro Pedido</label>
<select class=\"form-control\">
<option selected=\"\">Seleccione..</option>
{% for order in orders %}
<option value=\"{{ order.nro_pedido }}\">{{ order.nro_pedido }} </option>
{% endfor %}
</select>
</div>
</div>
<div class=\"col-md-6\">
<div class=\"form-group\">
<label> Concepto: </label>
<select class=\"form-control\">
<option selected=\"\">Seleccione...</option>
{% for order in orders  %}
\t{% for expense in order.expenses %}
\t\t<option>{{ expense.concepto }}</option>
    {% endfor %}\t
{% endfor %} 
</select>\t
</div>
</div>
</div>
</form>
<script type=\"text/javascript\">
var orders = {{orders |raw }};

</script>", "forms/frm-facturas-detalle.html.twig", "/var/www/html/app/src/views/forms/frm-facturas-detalle.html.twig");
    }
}
