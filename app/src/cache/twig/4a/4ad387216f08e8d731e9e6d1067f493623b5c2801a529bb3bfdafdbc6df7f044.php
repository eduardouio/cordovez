<?php

/* sections/seleccionar-gi-provisiones.html.twig */
class __TwigTemplate_8ee4777eaea3c0f446e300a78391d9ec6ee0cdeccb7dd72c43f48ff3ba747413 extends Twig_Template
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
        echo "<form method=\"post\" action=\"";
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/validExpenses/\">
<div class=\"row\">
\t<div class=\"col-sm-12\">
\t\t<table class=\"table table-bordered table-hover table-striped\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>#</th>
\t\t\t\t\t<th>Concepto</th>
\t\t\t\t\t<th>Proveedor</th>
\t\t\t\t\t<th>Valor Provision</th>
\t\t\t\t\t<th>Seleccione</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t\t";
        // line 15
        $context["nroOrder"] = "";
        // line 16
        echo "\t\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_sort_filter(($context["initialExpenses"] ?? null)));
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
        foreach ($context['_seq'] as $context["_key"] => $context["initExpense"]) {
            echo "\t\t\t\t
\t\t\t\t<tr>
\t\t\t\t\t";
            // line 18
            $context["nroOrder"] = $this->getAttribute($context["initExpense"], "nro_pedido", array());
            // line 19
            echo "\t\t\t\t\t<td>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
\t\t\t\t\t<td> <strong>";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "concepto", array()), "html", null, true);
            echo "</strong></td>
\t\t\t\t\t<td>";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["initExpense"], "supplier", array()), "nombre", array()), "html", null, true);
            echo "</td>
\t\t\t\t\t<td class=\"text-right\">\$";
            // line 22
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["initExpense"], "valor_provisionado", array()), 2, ".", ","), "html", null, true);
            echo "</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<input 
\t\t\t\t\t\ttype=\"checkbox\" 
\t\t\t\t\t\tclass=\"form-control\" 
\t\t\t\t\t\tname=\"";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" 
\t\t\t\t\t\tvalue=\"";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "nro_pedido", array()), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "id_nacionalizacion", array()), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "identificacion_proveedor", array()), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "concepto", array()), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "valor_provisionado", array()), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "comentarios", array()), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "id_user", array()), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "fecha", array()), "html", null, true);
            echo "\"
\t\t\t\t\t\t>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "\t\t\t</tbody>
\t\t</table>
\t</div>
</div>
<br>
<div class=\"row\">
\t<div class=\"col-sm-6\">
\t\t<button type=\"submit\" class=\"btn btn-default btn-sm\">
\t\t\t\t<span class=\"fa fa-save\"></span> Guardar Seleccionadas
\t\t</button> 
\t\t<a href=\"";
        // line 43
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, ($context["nroOrder"] ?? null), "html", null, true);
        echo "\" class=\"btn btn-default btn-sm\">
\t\t<span class=\"fa fa-arrow-left\"></span> Cancelar y Volver <strong>";
        // line 44
        echo twig_escape_filter($this->env, ($context["nroOrder"] ?? null), "html", null, true);
        echo "</strong>
\t\t</a>
\t</div>
</div>

</form>";
    }

    public function getTemplateName()
    {
        return "sections/seleccionar-gi-provisiones.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 44,  132 => 43,  120 => 33,  87 => 28,  83 => 27,  75 => 22,  71 => 21,  67 => 20,  62 => 19,  60 => 18,  39 => 16,  37 => 15,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form method=\"post\" action=\"{{rute_url}}pedido/validExpenses/\">
<div class=\"row\">
\t<div class=\"col-sm-12\">
\t\t<table class=\"table table-bordered table-hover table-striped\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>#</th>
\t\t\t\t\t<th>Concepto</th>
\t\t\t\t\t<th>Proveedor</th>
\t\t\t\t\t<th>Valor Provision</th>
\t\t\t\t\t<th>Seleccione</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t\t{% set nroOrder = '' %}
\t\t\t\t{% for initExpense in initialExpenses | sort %}\t\t\t\t
\t\t\t\t<tr>
\t\t\t\t\t{% set nroOrder = initExpense.nro_pedido %}
\t\t\t\t\t<td>{{loop.index}}</td>
\t\t\t\t\t<td> <strong>{{initExpense.concepto}}</strong></td>
\t\t\t\t\t<td>{{initExpense.supplier.nombre}}</td>
\t\t\t\t\t<td class=\"text-right\">\${{initExpense.valor_provisionado | number_format(2, '.', ',') }}</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<input 
\t\t\t\t\t\ttype=\"checkbox\" 
\t\t\t\t\t\tclass=\"form-control\" 
\t\t\t\t\t\tname=\"{{loop.index}}\" 
\t\t\t\t\t\tvalue=\"{{ initExpense.nro_pedido }},{{ initExpense.id_nacionalizacion }},{{ initExpense.identificacion_proveedor }},{{ initExpense.concepto }},{{ initExpense.valor_provisionado }},{{ initExpense.comentarios }},{{initExpense.id_user }},{{ initExpense.fecha }}\"
\t\t\t\t\t\t>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t{% endfor %}
\t\t\t</tbody>
\t\t</table>
\t</div>
</div>
<br>
<div class=\"row\">
\t<div class=\"col-sm-6\">
\t\t<button type=\"submit\" class=\"btn btn-default btn-sm\">
\t\t\t\t<span class=\"fa fa-save\"></span> Guardar Seleccionadas
\t\t</button> 
\t\t<a href=\"{{rute_url}}pedido/presentar/{{nroOrder}}\" class=\"btn btn-default btn-sm\">
\t\t<span class=\"fa fa-arrow-left\"></span> Cancelar y Volver <strong>{{nroOrder}}</strong>
\t\t</a>
\t</div>
</div>

</form>", "sections/seleccionar-gi-provisiones.html.twig", "/var/www/html/app/src/views/sections/seleccionar-gi-provisiones.html.twig");
    }
}
