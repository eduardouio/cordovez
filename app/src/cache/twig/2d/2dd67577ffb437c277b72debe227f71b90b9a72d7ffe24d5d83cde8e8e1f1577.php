<?php

/* sections/subsections/tab-nacionalizaciones.html.twig */
class __TwigTemplate_5e3706c54d2f1eed4cfc6014956609293653d1b09331555b5147498f973b58fe extends Twig_Template
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
    <div class=\"col-sm-3\">
        ";
        // line 3
        if (($this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "regimen", array()) == 70)) {
            // line 4
            echo "            <a href=\"";
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/validargi/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
            echo "\">
                <button type=\"button\" class=\"btn btn-primary btn-sm\"
                        style=\"width: 100%\">
                    <span class=\"fa fa-gear\"></span>
                    Generar Gastos Iniciales
                </button>
            </a>
            <br>
            <br>
        ";
        }
        // line 14
        echo "    </div>
    <div class=\"col-sm-3\">&nbsp;</div>
    <div class=\"col-sm-2\">
        <h5 class=\"text-primary\">
            <small>Parciales:</small>
            <span id=\"suma\"> ";
        // line 19
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
    <div class=\"col-sm-2\">
        <h5 class=\"text-primary\">
            <small>Sumas:</small>
            <span id=\"suma\">
                        \$ ";
        // line 25
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
        echo "</span></h5>
    </div>
    <div class=\"col-sm-2\">
        <h5 class=\"text-danger\">
            <small>Saldo:</small>
            <span id=\"suma\"> \$ ";
        // line 30
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
                <th>Moneda</th>
                <th>Tipo Cambio</th>
                <th>Valor</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 51
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "invoicesInfo", array()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 52
            echo "                <tr>
                    <td>";
            // line 53
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 54
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "nro_factura_informativa", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["invoice"], "supplier", array()), "nombre", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "moneda", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "tipo_cambio", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "valor", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 60
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($this->getAttribute($context["invoice"], "tipo_cambio", array()) * $this->getAttribute($context["invoice"], "valor", array())), 2, ",", "."), "html", null, true);
            echo " </td>
                    <td>
                        <div class=\"dropdown\">
                            <button id=\"dLabel\" type=\"button\"
                                    data-toggle=\"dropdown\" aria-haspopup=\"true\"
                                    aria-expanded=\"true\"
                                    class=\"btn btn-sm btn-default\">
                                <span class=\"fa fa-chevron-down\"></span>
                                Acciones <span class=\"fa fa-list\"></span>
                            </button>
                            <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                                <li>
                                    <a href=\"";
            // line 72
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "facinformativa/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Ver Factura Informativa </a>
                                </li>
                                <li>
                                    <a href=\"";
            // line 77
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "facinfdetalle/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_factura_informativa", array()), "html", null, true);
            echo "\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Agregar Productos</a>
                                </li>
                                <li>
                                    <a href=\"";
            // line 82
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "facinformativa/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_factura_informativa", array()), "html", null, true);
            echo "\">
                                        <span class=\"fa fa-pencil fa-fw\"></span>
                                        Editar Factura Informativa</a>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 91
        echo "            </tbody>
        </table>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "sections/subsections/tab-nacionalizaciones.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  197 => 91,  172 => 82,  162 => 77,  152 => 72,  137 => 60,  133 => 59,  129 => 58,  125 => 57,  121 => 56,  117 => 55,  113 => 54,  109 => 53,  106 => 52,  89 => 51,  65 => 30,  57 => 25,  48 => 19,  41 => 14,  25 => 4,  23 => 3,  19 => 1,);
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
    <div class=\"col-sm-3\">
        {% if viewData.order.regimen == 70 %}
            <a href=\"{{ rute_url }}gstinicial/validargi/{{ viewData.order.nro_pedido }}\">
                <button type=\"button\" class=\"btn btn-primary btn-sm\"
                        style=\"width: 100%\">
                    <span class=\"fa fa-gear\"></span>
                    Generar Gastos Iniciales
                </button>
            </a>
            <br>
            <br>
        {% endif %}
    </div>
    <div class=\"col-sm-3\">&nbsp;</div>
    <div class=\"col-sm-2\">
        <h5 class=\"text-primary\">
            <small>Parciales:</small>
            <span id=\"suma\"> {{ 0 | number_format(0, '.', ',') }} </span></h5>
    </div>
    <div class=\"col-sm-2\">
        <h5 class=\"text-primary\">
            <small>Sumas:</small>
            <span id=\"suma\">
                        \$ {{ 0 | number_format(2, '.', ',') }}</span></h5>
    </div>
    <div class=\"col-sm-2\">
        <h5 class=\"text-danger\">
            <small>Saldo:</small>
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
                <th>Moneda</th>
                <th>Tipo Cambio</th>
                <th>Valor</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            {% for invoice in viewData.invoicesInfo %}
                <tr>
                    <td>{{ loop.index }}</td>
                    <td>{{ invoice.nro_factura_informativa }}</td>
                    <td>{{ invoice.supplier.nombre }}</td>
                    <td>{{ invoice.fecha_emision }}</td>
                    <td>{{ invoice.moneda }}</td>
                    <td>{{ invoice.tipo_cambio }}</td>
                    <td>{{ invoice.valor }}</td>
                    <td>{{ (invoice.tipo_cambio * invoice.valor) | number_format(2,',','.') }} </td>
                    <td>
                        <div class=\"dropdown\">
                            <button id=\"dLabel\" type=\"button\"
                                    data-toggle=\"dropdown\" aria-haspopup=\"true\"
                                    aria-expanded=\"true\"
                                    class=\"btn btn-sm btn-default\">
                                <span class=\"fa fa-chevron-down\"></span>
                                Acciones <span class=\"fa fa-list\"></span>
                            </button>
                            <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                                <li>
                                    <a href=\"{{ rute_url }}facinformativa/presentar/{{ order.nro_pedido }}\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Ver Factura Informativa </a>
                                </li>
                                <li>
                                    <a href=\"{{ rute_url }}facinfdetalle/nuevo/{{ invoice.id_factura_informativa }}\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Agregar Productos</a>
                                </li>
                                <li>
                                    <a href=\"{{ rute_url }}facinformativa/editar/{{ invoice.id_factura_informativa }}\">
                                        <span class=\"fa fa-pencil fa-fw\"></span>
                                        Editar Factura Informativa</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </div>
</div>", "sections/subsections/tab-nacionalizaciones.html.twig", "/var/www/html/app/src/views/sections/subsections/tab-nacionalizaciones.html.twig");
    }
}
