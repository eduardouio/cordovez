<?php

/* sections/listar-factura-pago.html.twig */
class __TwigTemplate_e45e1c545f2dbcc5bd2e1c802636eade051dc86d98ef6ed93a4dda45c440c58c extends Twig_Template
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
        echo "<div class=\"factura-pago\">
    <div class=\"row\">
        <div class=\"col-sm-3\">
            <a href=\"";
        // line 4
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "facturapagos/nuevo/\">
                <button class=\"btn btn-sm btn-default\">
                    <span class=\"fa fa-plus fa-fw\"></span>
                    Nuevo Factura o Comprobante
                </button>
            </a>
        </div>
        <div class=\"col-sm-2\">
            <h5 class=\"text-primary\">
                <small>Total:</small>
                <span id=\"suma\"> ";
        // line 14
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["count"] ?? null), 0, ".", ","), "html", null, true);
        echo "
                    Facturas </span></h5>
        </div>
        <div class=\"col-sm-2\">
            <h5 class=\"text-primary\">
                <small>Internacionales:</small>
                <span id=\"suma\"> ";
        // line 20
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["countInter"] ?? null), 0, ".", ","), "html", null, true);
        echo "</span>
            </h5>
        </div>
        <div class=\"col-sm-2\">
            <h5 class=\"text-danger\">
                <small>Nacionales:</small>
                <span id=\"suma\">  ";
        // line 26
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["countNat"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span>
            </h5>
        </div>
        <div class=\"col-sm-3\">
            <form action=\"";
        // line 30
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "facturapagos/busquedas/\"
                  method=\"POST\"
                  class=\"form-inline\"
                  role=\"form\">
                <div class=\"form-group\">
                    <input
                            type=\"text\"
                            class=\"form-control\"
                            placeholder=\"Buscar\"
                    >
                </div>
                <button
                        type=\"submit\"
                        class=\"btn\">
                    <span class=\"fa fa-search fa-fw\"></span>
                </button>
            </form>
        </div>
    </div>
    <br>
</div>
<br>
<div class=\"row\">
        <table class=\"table table-hover table-bordered table-striped\">
            <thead>
            <tr style=\"background-color: #c1c1c1;\">
                <th>#</th>
                <th>Proveedor</th>
                <th>Factura</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Ingresado</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 67
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["documentsPaids"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["document"]) {
            // line 68
            echo "            ";
            $context["saldoItem"] = ($this->getAttribute($context["document"], "valor", array()) - $this->getAttribute($this->getAttribute($this->getAttribute($context["document"], "documentDetail", array()), "invoiceDetails", array()), "sums", array()));
            // line 69
            echo "
                <tr>
                    <td>";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                    <td>
                        <a href=\"";
            // line 73
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "facturapagos/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["document"], "id_documento_pago", array()), "html", null, true);
            echo "\">
                        ";
            // line 74
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["document"], "supplier", array()), "nombre", array()), "html", null, true);
            echo "
                        </a>
                    </td>
                    <td>
                        <a href=\"";
            // line 78
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "facturapagos/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["document"], "id_documento_pago", array()), "html", null, true);
            echo "\">
                            ";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute($context["document"], "nro_factura", array()), "html", null, true);
            echo "
                        </a>
                    </td>
                    <td class=\"text-center\">";
            // line 82
            echo twig_escape_filter($this->env, $this->getAttribute($context["document"], "fecha_emision", array()), "html", null, true);
            echo "</td>
                    <td class=\"text-right\">\$ ";
            // line 83
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["document"], "valor", array()), 2, ".", ","), "html", null, true);
            echo "</td>
                    <td class=\"text-right\">
                        \$ ";
            // line 85
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["document"], "documentDetail", array()), "invoiceDetails", array()), "sums", array()), 2, ".", ","), "html", null, true);
            echo "
                    </td>
                    <td class=\"text-center\">
                        ";
            // line 88
            if ((($context["saldoItem"] ?? null) != 0)) {
                // line 89
                echo "                        <span class=\"text-danger\" >\$ ";
                echo twig_escape_filter($this->env, ($context["saldoItem"] ?? null), "html", null, true);
                echo "</span>
                        ";
            }
            // line 91
            echo "                        ";
            if ((($context["saldoItem"] ?? null) == 0)) {
                // line 92
                echo "                        <span class=\"text-success\" > <span class=\"fa fa-check\"></span> Ok </span>
                        ";
            }
            // line 93
            echo "                        
                    </td>
                    <td>
                        <div class=\"dropdown\">
                            <button id=\"dLabel\" type=\"button\"
                                    data-toggle=\"dropdown\" aria-haspopup=\"true\"
                                    aria-expanded=\"false\"
                                    class=\"btn btn-sm btn-default\">
                                <span class=\"fa fa-chevron-down\"></span>
                                Seleccione..
                            </button>
                            <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                                <li>
                                    <a href=\"";
            // line 106
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "facturapagos/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["document"], "id_documento_pago", array()), "html", null, true);
            echo "\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Ver Detalle  Factura</a>
                                </li>
                                <li>
                                    <a href=\"";
            // line 111
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "facturapagos/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["document"], "id_documento_pago", array()), "html", null, true);
            echo "\">
                                        <span class=\"fa fa-pencil fa-fw\"></span>
                                        Editar Factura</a>
                                </li>
                                <li>
                                    <a href=\"";
            // line 116
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "facturapagos/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["document"], "id_documento_pago", array()), "html", null, true);
            echo "\">
                                        <span class=\"fa fa-trash fa-fw\"></span>
                                        Eliminar Factura</a>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['document'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 125
        echo "            </tbody>
        </table>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "sections/listar-factura-pago.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  246 => 125,  221 => 116,  211 => 111,  201 => 106,  186 => 93,  182 => 92,  179 => 91,  173 => 89,  171 => 88,  165 => 85,  160 => 83,  156 => 82,  150 => 79,  144 => 78,  137 => 74,  131 => 73,  126 => 71,  122 => 69,  119 => 68,  102 => 67,  62 => 30,  55 => 26,  46 => 20,  37 => 14,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"factura-pago\">
    <div class=\"row\">
        <div class=\"col-sm-3\">
            <a href=\"{{ rute_url }}facturapagos/nuevo/\">
                <button class=\"btn btn-sm btn-default\">
                    <span class=\"fa fa-plus fa-fw\"></span>
                    Nuevo Factura o Comprobante
                </button>
            </a>
        </div>
        <div class=\"col-sm-2\">
            <h5 class=\"text-primary\">
                <small>Total:</small>
                <span id=\"suma\"> {{ count | number_format(0, '.', ',') }}
                    Facturas </span></h5>
        </div>
        <div class=\"col-sm-2\">
            <h5 class=\"text-primary\">
                <small>Internacionales:</small>
                <span id=\"suma\"> {{ countInter | number_format(0, '.', ',') }}</span>
            </h5>
        </div>
        <div class=\"col-sm-2\">
            <h5 class=\"text-danger\">
                <small>Nacionales:</small>
                <span id=\"suma\">  {{ countNat | number_format(0, '.', ',') }} </span>
            </h5>
        </div>
        <div class=\"col-sm-3\">
            <form action=\"{{ rute_url }}facturapagos/busquedas/\"
                  method=\"POST\"
                  class=\"form-inline\"
                  role=\"form\">
                <div class=\"form-group\">
                    <input
                            type=\"text\"
                            class=\"form-control\"
                            placeholder=\"Buscar\"
                    >
                </div>
                <button
                        type=\"submit\"
                        class=\"btn\">
                    <span class=\"fa fa-search fa-fw\"></span>
                </button>
            </form>
        </div>
    </div>
    <br>
</div>
<br>
<div class=\"row\">
        <table class=\"table table-hover table-bordered table-striped\">
            <thead>
            <tr style=\"background-color: #c1c1c1;\">
                <th>#</th>
                <th>Proveedor</th>
                <th>Factura</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Ingresado</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            {% for document in documentsPaids %}
            {% set saldoItem  = (document.valor - document.documentDetail.invoiceDetails.sums) %}

                <tr>
                    <td>{{ loop.index }}</td>
                    <td>
                        <a href=\"{{ rute_url }}facturapagos/presentar/{{ document.id_documento_pago}}\">
                        {{ document.supplier.nombre}}
                        </a>
                    </td>
                    <td>
                        <a href=\"{{ rute_url }}facturapagos/presentar/{{ document.id_documento_pago}}\">
                            {{ document.nro_factura }}
                        </a>
                    </td>
                    <td class=\"text-center\">{{ document.fecha_emision }}</td>
                    <td class=\"text-right\">\$ {{ document.valor | number_format(2, '.', ',') }}</td>
                    <td class=\"text-right\">
                        \$ {{ document.documentDetail.invoiceDetails.sums | number_format(2, '.', ',') }}
                    </td>
                    <td class=\"text-center\">
                        {% if saldoItem != 0  %}
                        <span class=\"text-danger\" >\$ {{saldoItem}}</span>
                        {% endif %}
                        {% if saldoItem == 0 %}
                        <span class=\"text-success\" > <span class=\"fa fa-check\"></span> Ok </span>
                        {% endif %}                        
                    </td>
                    <td>
                        <div class=\"dropdown\">
                            <button id=\"dLabel\" type=\"button\"
                                    data-toggle=\"dropdown\" aria-haspopup=\"true\"
                                    aria-expanded=\"false\"
                                    class=\"btn btn-sm btn-default\">
                                <span class=\"fa fa-chevron-down\"></span>
                                Seleccione..
                            </button>
                            <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                                <li>
                                    <a href=\"{{ rute_url }}facturapagos/presentar/{{ document.id_documento_pago}}\">
                                        <span class=\"fa fa-eye fa-fw\"></span>
                                        Ver Detalle  Factura</a>
                                </li>
                                <li>
                                    <a href=\"{{ rute_url }}facturapagos/editar/{{ document.id_documento_pago }}\">
                                        <span class=\"fa fa-pencil fa-fw\"></span>
                                        Editar Factura</a>
                                </li>
                                <li>
                                    <a href=\"{{ rute_url }}facturapagos/eliminar/{{ document.id_documento_pago }}\">
                                        <span class=\"fa fa-trash fa-fw\"></span>
                                        Eliminar Factura</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
</div>
<!--tabPedido-->", "sections/listar-factura-pago.html.twig", "/var/www/html/app/src/views/sections/listar-factura-pago.html.twig");
    }
}
