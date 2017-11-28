<?php

/* sections/mostrar-factura-pago.html.twig */
class __TwigTemplate_8af8fb806f136f659bc15a65cc66f1746f699f082d10bfce414d124b260c3d6f extends Twig_Template
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
<div class=\"row\">
\t<div class=\"col-md-6\">
\t\t<a
\t\t\thref=\"";
        // line 41
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "detallefacpago/nuevo/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "id_documento_pago", array()), "html", null, true);
        echo "\"
\t\t\tclass=\"btn btn-default btn-sm\"> <span class=\"fa fa-file\"></span>
\t\t\tAgregar Detalle
\t\t</a> <br>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-primary\">
\t\t\t<small>Val Factura: \$</small> <span> ";
        // line 48
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["document"] ?? null), "valor", array()), 2, ",", "."), "html", null, true);
        echo "</span>
\t\t</h4>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-primary\">
\t\t\t<small>Val Justificado: \$</small> <span> ";
        // line 53
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ",", "."), "html", null, true);
        echo "</span>
\t\t</h4>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-primary\">
\t\t\t<small>Val Pendiente: \$</small> <span> ";
        // line 58
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ",", "."), "html", null, true);
        echo "</span>
\t\t</h4>
\t</div>
</div>
<div class=\"row\">
\t<div class=\"col-md-12\">
\t\t<table class=\"table table-hover table-bordered  table-striped\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>#</th>
\t\t\t\t\t<th>Concepto</th>
\t\t\t\t\t<th>Pedido</th>
\t\t\t\t\t<th>Valor</th>
\t\t\t\t\t<th>Desde</th>
\t\t\t\t\t<th>Hasta</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t";
        // line 76
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["document"] ?? null), "invoiceDetails", array()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["detail"]) {
            // line 77
            echo "\t\t\t<tr>
\t\t\t<td>";
            // line 78
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
\t\t\t<td>";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "concepto", array()), "html", null, true);
            echo "</td>
\t\t\t<td>";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "pedido", array()), "html", null, true);
            echo "</td>
\t\t\t<td>";
            // line 81
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "valor", array()), "html", null, true);
            echo "</td>
\t\t\t<td>";
            // line 82
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "fecha_inicio", array()), "html", null, true);
            echo "</td>
\t\t\t<td>";
            // line 83
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "fecha_fin", array()), "html", null, true);
            echo "</td>
\t\t\t</tr>
\t\t\t";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        echo "\t\t\t</tbody>
\t\t</table>
\t</div>
</div>













";
    }

    public function getTemplateName()
    {
        return "sections/mostrar-factura-pago.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  194 => 86,  177 => 83,  173 => 82,  169 => 81,  165 => 80,  161 => 79,  157 => 78,  154 => 77,  137 => 76,  116 => 58,  108 => 53,  100 => 48,  88 => 41,  77 => 33,  71 => 30,  64 => 26,  57 => 22,  50 => 18,  42 => 13,  36 => 10,  30 => 7,  24 => 4,  19 => 1,);
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
<div class=\"row\">
\t<div class=\"col-md-6\">
\t\t<a
\t\t\thref=\"{{ rute_url }}detallefacpago/nuevo/{{ document.id_documento_pago }}\"
\t\t\tclass=\"btn btn-default btn-sm\"> <span class=\"fa fa-file\"></span>
\t\t\tAgregar Detalle
\t\t</a> <br>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-primary\">
\t\t\t<small>Val Factura: \$</small> <span> {{ document.valor | number_format(2,',','.')}}</span>
\t\t</h4>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-primary\">
\t\t\t<small>Val Justificado: \$</small> <span> {{ 0 | number_format(2,',','.') }}</span>
\t\t</h4>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-primary\">
\t\t\t<small>Val Pendiente: \$</small> <span> {{ 0 | number_format(2,',','.') }}</span>
\t\t</h4>
\t</div>
</div>
<div class=\"row\">
\t<div class=\"col-md-12\">
\t\t<table class=\"table table-hover table-bordered  table-striped\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>#</th>
\t\t\t\t\t<th>Concepto</th>
\t\t\t\t\t<th>Pedido</th>
\t\t\t\t\t<th>Valor</th>
\t\t\t\t\t<th>Desde</th>
\t\t\t\t\t<th>Hasta</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t{%  for detail in document.invoiceDetails %}
\t\t\t<tr>
\t\t\t<td>{{loop.index}}</td>
\t\t\t<td>{{ detail.concepto  }}</td>
\t\t\t<td>{{ detail.pedido  }}</td>
\t\t\t<td>{{ detail.valor  }}</td>
\t\t\t<td>{{ detail.fecha_inicio  }}</td>
\t\t\t<td>{{ detail.fecha_fin  }}</td>
\t\t\t</tr>
\t\t\t{%  endfor %}
\t\t\t</tbody>
\t\t</table>
\t</div>
</div>













", "sections/mostrar-factura-pago.html.twig", "/var/www/html/app/src/views/sections/mostrar-factura-pago.html.twig");
    }
}
