<?php

/* sections/listar-pedidos.html.twig */
class __TwigTemplate_b4211397c398a1e1eb4fa6953e6af5c3f3e4863e392e36cab832501921718945 extends Twig_Template
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
        echo "<!--tabPedido-->
<div class=\"pedido\">
    <div class=\"row\">
        <div class=\"col-sm-5\">
            <a href=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/nuevo/\">
                <button class=\"btn btn-sm btn-default\">
                    <span class=\"fa fa-plus fa-fw\"></span>
                    Nuevo Pedido
                </button>
            </a>
        </div>
        <div class=\"col-sm-2\">
            <h4 class=\"text-primary\">
                <small>Pedidos Activos:</small>
                <span id=\"suma\">
";
        // line 16
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["infoBase"] ?? null), "activeOrders", array()), 0, ".", ","), "html", null, true);
        echo "
</span>
            </h4>
        </div>
        <div class=\"col-sm-2\">
            <h4 class=\"text-primary\">
                <small>Pedidos Cerrados:</small>
                <span id=\"suma\"> ";
        // line 23
        echo ($context["simbolo"] ?? null);
        echo "
                    ";
        // line 24
        $context["colsedOrders"] = ($this->getAttribute(($context["infoBase"] ?? null), "totalOrders", array()) - $this->getAttribute(($context["infoBase"] ?? null), "activeOrders", array()));
        // line 25
        echo "                    ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["colsedOrders"] ?? null), 0, ".", ","), "html", null, true);
        echo "</span>
            </h4>
        </div>
        <div class=\"col-sm-3\">
            <h4 class=\"text-danger\">
                <small>Por Regimen
                    <span class=\"text-danger\">10</span>
                    <span class=\"text-default\"> / </span>
                    <span class=\"text-primary\">70</span>:
                </small>
                <span class=\"text-danger\">
";
        // line 36
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["infoBase"] ?? null), "consumeOrders", array()), 0, ".", ","), "html", null, true);
        echo "
</span>
                <span class=\"text-default\"> / </span>
                <span class=\"text-primary\">
";
        // line 40
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["infoBase"] ?? null), "partialsOrders", array()), 0, ".", ","), "html", null, true);
        echo "
</span>
            </h4>
        </div>
    </div>
    <div class=\"row\">
        <table class=\"table table-hover table-bordered table-striped\">
            <thead>
            <tr style=\"background-color: #c1c1c1;\">
                <th>#</th>
                <th>Pedido</th>
                <th>Regimen</th>
                <th>Incoterm</th>
                <th>Origen</th>
                <th>Arribo</th>
                <th>D Libres</th>
                <th>FOB</th>
                <th>Nacionalizado</th>
                <th>Saldo FOB</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 63
        $context["init"] = ((($context["current_page"] ?? null) * ($context["perPage"] ?? null)) - ($context["perPage"] ?? null));
        // line 64
        echo "            ";
        $context["item"] = (($context["init"] ?? null) + 1);
        // line 65
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 66
            echo "                <tr>
                    <td>";
            // line 67
            echo twig_escape_filter($this->env, ($context["item"] ?? null), "html", null, true);
            echo "</td>
                    <td>
                        <a href=\"";
            // line 69
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "</a>
                        ";
            // line 70
            if (($this->getAttribute($context["order"], "bg_islocked", array()) == "0")) {
                // line 71
                echo "                            <span class=\"label label-success pull-right\">
Activo
</span>
                        ";
            } else {
                // line 75
                echo "                            <span class=\"label label-died pull-right\">
Cerrado
</span>
                        ";
            }
            // line 79
            echo "                    </td>
                    <td class=\"text-right\">";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "regimen", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 81
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "incoterm", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 82
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "pais_origen", array()), "html", null, true);
            echo "</td>
                    <td>
                        ";
            // line 84
            if (($this->getAttribute($context["order"], "fecha_arribo", array()) == null)) {
                // line 85
                echo "                            <strong>
                                Arribo Pendiente
                            </strong>
                        ";
            } else {
                // line 89
                echo "
                            ";
                // line 90
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "fecha_arribo", array()), "html", null, true);
                echo "
                        ";
            }
            // line 92
            echo "                    </td>
                    <td class=\"text-right\">";
            // line 93
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "dias_libres", array()), "html", null, true);
            echo " días
                        ";
            // line 94
            $context["class"] = "label label-danger";
            // line 95
            echo "                        ";
            if (($this->getAttribute($context["order"], "dias_libres", array()) > $this->getAttribute($this->getAttribute($context["order"], "warehouseDays", array()), "days", array()))) {
                // line 96
                echo "                            ";
                $context["class"] = "label label-success";
                // line 97
                echo "                        ";
            }
            // line 98
            echo "                        ";
            if (($this->getAttribute($context["order"], "fecha_arribo", array()) != null)) {
                // line 99
                echo "                            <label class=\"";
                echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
                echo "\">
                                ";
                // line 100
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($context["order"], "warehouseDays", array()), "days", array()) - $this->getAttribute($context["order"], "dias_libres", array())), "html", null, true);
                echo "
                            </label>
                        ";
            }
            // line 103
            echo "                    </td>
                    <td class=\"text-right\">\$
                        ";
            // line 105
            $context["fob"] = 0;
            // line 106
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["order"], "invoices", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
                // line 107
                echo "                            ";
                $context["fob"] = (($context["fob"] ?? null) + ($this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array()) * $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "tasa_change", array())));
                // line 108
                echo "                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 109
            echo "                        ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
            echo "
                    </td>
                    <td class=\"text-right\">\$
                        ";
            // line 112
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["order"], "nationalized", array()), 2, ".", ","), "html", null, true);
            echo "
                    <td class=\"text-right ";
            // line 113
            echo twig_escape_filter($this->env, ($context["text_class"] ?? null), "html", null, true);
            echo "\">\$
                        ";
            // line 114
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (($context["fob"] ?? null) - $this->getAttribute($context["order"], "nationalized", array())), 2, ".", ","), "html", null, true);
            echo "
                    </td>
                    <td>
                        <div class=\"dropdown\">
                            <button id=\"dLabel\" type=\"button\"
                                    data-toggle=\"dropdown\" aria-haspopup=\"true\"
                                    aria-expanded=\"false\"
                                    class=\"btn btn-sm btn-default\">
                                <span class=\"fa fa-chevron-down\"></span>
                                Seleccione
                            </button>
                            <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                                <li>
                                    <a href=\"";
            // line 127
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Ver Pedido </a>
                                </li>
                                <li>
                                    ";
            // line 132
            if (($this->getAttribute($context["order"], "bg_isclosed", array()) != "1")) {
                // line 133
                echo "                                    <a href=\"";
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedidofactura/nuevo/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                echo "\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Agregar Productos</a>
                                </li>
                                <li>
                                    <a href=\"";
                // line 138
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/editar/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                echo "\">
                                        <span class=\"fa fa-pencil fa-fw\"></span>
                                        Editar Pedido</a>
                                </li>
                                ";
                // line 142
                if ((($context["fob"] ?? null) == 0)) {
                    // line 143
                    echo "                                    <li>
                                        <a href=\"";
                    // line 144
                    echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                    echo "pedido/eliminar/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                    echo "\"
                                        <span class=\"fa fa-trash fa-fw\"></span>
                                        Elminar Pedido</a>
                                    </li>
                                ";
                }
                // line 149
                echo "                                ";
            }
            // line 150
            echo "                            </ul>
                        </div>
                    </td>
                </tr>
                ";
            // line 154
            $context["item"] = (($context["item"] ?? null) + 1);
            // line 155
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 156
        echo "            </tbody>
        </table>
    </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "sections/listar-pedidos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  322 => 156,  316 => 155,  314 => 154,  308 => 150,  305 => 149,  295 => 144,  292 => 143,  290 => 142,  281 => 138,  270 => 133,  268 => 132,  258 => 127,  242 => 114,  238 => 113,  234 => 112,  227 => 109,  221 => 108,  218 => 107,  213 => 106,  211 => 105,  207 => 103,  201 => 100,  196 => 99,  193 => 98,  190 => 97,  187 => 96,  184 => 95,  182 => 94,  178 => 93,  175 => 92,  170 => 90,  167 => 89,  161 => 85,  159 => 84,  154 => 82,  150 => 81,  146 => 80,  143 => 79,  137 => 75,  131 => 71,  129 => 70,  121 => 69,  116 => 67,  113 => 66,  108 => 65,  105 => 64,  103 => 63,  77 => 40,  70 => 36,  55 => 25,  53 => 24,  49 => 23,  39 => 16,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!--tabPedido-->
<div class=\"pedido\">
    <div class=\"row\">
        <div class=\"col-sm-5\">
            <a href=\"{{ rute_url }}pedido/nuevo/\">
                <button class=\"btn btn-sm btn-default\">
                    <span class=\"fa fa-plus fa-fw\"></span>
                    Nuevo Pedido
                </button>
            </a>
        </div>
        <div class=\"col-sm-2\">
            <h4 class=\"text-primary\">
                <small>Pedidos Activos:</small>
                <span id=\"suma\">
{{ infoBase.activeOrders | number_format(0, '.', ',') }}
</span>
            </h4>
        </div>
        <div class=\"col-sm-2\">
            <h4 class=\"text-primary\">
                <small>Pedidos Cerrados:</small>
                <span id=\"suma\"> {{ simbolo | raw }}
                    {% set colsedOrders = infoBase.totalOrders -infoBase.activeOrders %}
                    {{ colsedOrders | number_format(0, '.', ',') }}</span>
            </h4>
        </div>
        <div class=\"col-sm-3\">
            <h4 class=\"text-danger\">
                <small>Por Regimen
                    <span class=\"text-danger\">10</span>
                    <span class=\"text-default\"> / </span>
                    <span class=\"text-primary\">70</span>:
                </small>
                <span class=\"text-danger\">
{{ infoBase.consumeOrders  | number_format(0, '.', ',') }}
</span>
                <span class=\"text-default\"> / </span>
                <span class=\"text-primary\">
{{ infoBase.partialsOrders  | number_format(0, '.', ',') }}
</span>
            </h4>
        </div>
    </div>
    <div class=\"row\">
        <table class=\"table table-hover table-bordered table-striped\">
            <thead>
            <tr style=\"background-color: #c1c1c1;\">
                <th>#</th>
                <th>Pedido</th>
                <th>Regimen</th>
                <th>Incoterm</th>
                <th>Origen</th>
                <th>Arribo</th>
                <th>D Libres</th>
                <th>FOB</th>
                <th>Nacionalizado</th>
                <th>Saldo FOB</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            {% set init = ( (current_page * perPage) - perPage ) %}
            {% set item = ( init + 1 ) %}
            {% for order in orders %}
                <tr>
                    <td>{{ item }}</td>
                    <td>
                        <a href=\"{{ rute_url }}pedido/presentar/{{ order.nro_pedido }}\">{{ order.nro_pedido }}</a>
                        {% if order.bg_islocked == '0' %}
                            <span class=\"label label-success pull-right\">
Activo
</span>
                        {% else %}
                            <span class=\"label label-died pull-right\">
Cerrado
</span>
                        {% endif %}
                    </td>
                    <td class=\"text-right\">{{ order.regimen }}</td>
                    <td>{{ order.incoterm }}</td>
                    <td>{{ order.pais_origen }}</td>
                    <td>
                        {% if order.fecha_arribo == NULL %}
                            <strong>
                                Arribo Pendiente
                            </strong>
                        {% else %}

                            {{ order.fecha_arribo }}
                        {% endif %}
                    </td>
                    <td class=\"text-right\">{{ order.dias_libres }} días
                        {% set class = 'label label-danger' %}
                        {% if order.dias_libres > order.warehouseDays.days %}
                            {% set class = 'label label-success' %}
                        {% endif %}
                        {% if order.fecha_arribo != NULL %}
                            <label class=\"{{ class }}\">
                                {{ order.warehouseDays.days - order.dias_libres }}
                            </label>
                        {% endif %}
                    </td>
                    <td class=\"text-right\">\$
                        {% set fob = 0.0 %}
                        {% for invoice in order.invoices  %}
                            {% set fob  = fob +  (invoice.detailInvoice.sums.valueItems * invoice.detailInvoice.sums.tasa_change) %}
                        {% endfor %}
                        {{ fob | number_format(2, '.', ',') }}
                    </td>
                    <td class=\"text-right\">\$
                        {{ order.nationalized | number_format(2, '.', ',')}}
                    <td class=\"text-right {{ text_class }}\">\$
                        {{ (fob - order.nationalized) | number_format(2, '.', ',')}}
                    </td>
                    <td>
                        <div class=\"dropdown\">
                            <button id=\"dLabel\" type=\"button\"
                                    data-toggle=\"dropdown\" aria-haspopup=\"true\"
                                    aria-expanded=\"false\"
                                    class=\"btn btn-sm btn-default\">
                                <span class=\"fa fa-chevron-down\"></span>
                                Seleccione
                            </button>
                            <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                                <li>
                                    <a href=\"{{ rute_url }}pedido/presentar/{{ order.nro_pedido }}\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Ver Pedido </a>
                                </li>
                                <li>
                                    {% if order.bg_isclosed != '1' %}
                                    <a href=\"{{ rute_url }}pedidofactura/nuevo/{{ order.nro_pedido }}\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Agregar Productos</a>
                                </li>
                                <li>
                                    <a href=\"{{ rute_url }}pedido/editar/{{ order.nro_pedido }}\">
                                        <span class=\"fa fa-pencil fa-fw\"></span>
                                        Editar Pedido</a>
                                </li>
                                {% if fob == 0 %}
                                    <li>
                                        <a href=\"{{ rute_url }}pedido/eliminar/{{ order.nro_pedido }}\"
                                        <span class=\"fa fa-trash fa-fw\"></span>
                                        Elminar Pedido</a>
                                    </li>
                                {% endif %}
                                {% endif %}
                            </ul>
                        </div>
                    </td>
                </tr>
                {% set item = item + 1 %}
            {% endfor %}
            </tbody>
        </table>
    </div>
</div>
<!--tabPedido-->", "sections/listar-pedidos.html.twig", "/var/www/html/app/src/views/sections/listar-pedidos.html.twig");
    }
}
