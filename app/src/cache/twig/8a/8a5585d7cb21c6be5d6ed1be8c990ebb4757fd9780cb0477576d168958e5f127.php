<?php

/* sections/subsections/table-order-info.html.twig */
class __TwigTemplate_18a20b1361268d9921126b7bebb4cb0eb4e3f4885e57dcb9277279380a0631a7 extends Twig_Template
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
        echo "                        <div class=\"text-tittle\">Detalle de Facturas del Pedido</div>
                         <small class=\"text-primary\">
                        FACTURAS EN DÓLARES
                        </small>
                        <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Proveedor</th>
                                 <th>Fecha</th>
                                 <th>Cajas</th>
                                 <th>Valor Reg</th>
                                 <th>Valor Fac</th>
                                 <th>Estado</th>
                              </tr>
                           </thead>
                           <tbody>
                              ";
        // line 18
        $context["sumOrderExpenses"] = 0;
        // line 19
        echo "                              ";
        $context["sumOrderExpensesSum"] = 0;
        // line 20
        echo "                              ";
        $context["totalboxes"] = 0;
        // line 21
        echo "                              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoicesOrder"] ?? null));
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
            // line 22
            echo "                              ";
            if (($this->getAttribute($context["invoice"], "moneda", array()) != "EUROS")) {
                // line 23
                echo "                              ";
                $context["sumOrderExpenses"] = (($context["sumOrderExpenses"] ?? null) + $this->getAttribute($context["invoice"], "valor", array()));
                // line 24
                echo "                              <tr>
                                 <td>";
                // line 25
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "</td>
                                 <td>
                                    <a href=\"";
                // line 27
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedidofactura/presentar/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_pedido_factura", array()), "html", null, true);
                echo "\">
                                    ";
                // line 28
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["invoice"], "supplier", array()), "nombre", array()), "html", null, true);
                echo "
                                    </a>
                                 </td>
                                 <td>";
                // line 31
                echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "fecha_emision", array()), "html", null, true);
                echo "</td>

                                 <td>";
                // line 33
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "countBoxesProduct", array()), 0, ",", "."), "html", null, true);
                echo "</td>

                                 ";
                // line 35
                $context["totalboxes"] = (($context["totalboxes"] ?? null) + $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "countBoxesProduct", array()));
                // line 36
                echo "                                 ";
                $context["valRegister"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array());
                // line 37
                echo "                                 
                                 <td class=\"text-right\">\$ ";
                // line 38
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array()), 2, ",", "."), "html", null, true);
                echo "</td>
                                 <td class=\"text-right\" >\$ ";
                // line 39
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["invoice"], "valor", array()), 2, ",", "."), "html", null, true);
                echo "</td>
                                 ";
                // line 40
                if ((($context["valRegister"] ?? null) == $this->getAttribute($context["invoice"], "valor", array()))) {
                    // line 41
                    echo "                                    <td class=\"success text-right\"> 
                                       Completa
                                    </td>
                                    ";
                } else {
                    // line 45
                    echo "                                       <td class=\"danger text-right\"> 
                                          <a href=\"";
                    // line 46
                    echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                    echo "pedidofactura/presentar/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_pedido_factura", array()), "html", null, true);
                    echo "\">
                                       Revisar
                                          </a>
                                    </td>
                                 ";
                }
                // line 51
                echo "                              </tr>
                              ";
            }
            // line 53
            echo "                              ";
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
        // line 54
        echo "                              <tr class=\"total-row\">
                                 <td colspan=\"3\">
                                    <strong>
                                    Total Facturas Producto CAJAS/(DOLARES):
                                    </strong>
                                 </td>
                                 <td>
                                    <strong>
                                    ";
        // line 62
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["totalboxes"] ?? null), 0, ",", "."), "html", null, true);
        echo "
                                    </strong>
                                 </td>
                                 <td class=\"text-right\">
                                    &nbsp;
                                 </td>
                                 <td  class=\"text-right\">
                                    <strong> \$ 
                                    ";
        // line 70
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["sumOrderExpenses"] ?? null), 2, ".", ","), "html", null, true);
        echo "
                                    </strong>
                                 </td>
                                 <td>
                                    &nbsp;
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <hr>
                        <small class=\"text-primary\">
                        FACTURAS EN EUROS
                        </small>
                         <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Proveedor</th>
                                 <th>Fecha</th>
                                 <th>Cajas</th>
                                 <th>Valor Reg</th>
                                 <th>Valor Fac</th>
                                 <th>Estado</th>
                              </tr>
                           </thead>
                          <tbody>
                              ";
        // line 96
        $context["sumOrderExpenses"] = 0;
        // line 97
        echo "                              ";
        $context["sumOrderExpensesSum"] = 0;
        // line 98
        echo "                              ";
        $context["totalboxes"] = 0;
        // line 99
        echo "                              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoicesOrder"] ?? null));
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
            // line 100
            echo "                              ";
            if (($this->getAttribute($context["invoice"], "moneda", array()) == "EUROS")) {
                // line 101
                echo "                              ";
                $context["sumOrderExpenses"] = (($context["sumOrderExpenses"] ?? null) + $this->getAttribute($context["invoice"], "valor", array()));
                // line 102
                echo "                              <tr>
                                 <td>";
                // line 103
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "</td>
                                 <td>
                                    <a href=\"";
                // line 105
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedidofactura/presentar/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_pedido_factura", array()), "html", null, true);
                echo "\">
                                    ";
                // line 106
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["invoice"], "supplier", array()), "nombre", array()), "html", null, true);
                echo "
                                    </a>
                                 </td>
                                 <td>";
                // line 109
                echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "fecha_emision", array()), "html", null, true);
                echo "</td>

                                 <td>";
                // line 111
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "countBoxesProduct", array()), 0, ",", "."), "html", null, true);
                echo "</td>

                                 ";
                // line 113
                $context["totalboxes"] = (($context["totalboxes"] ?? null) + $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "countBoxesProduct", array()));
                // line 114
                echo "                                 ";
                $context["valRegister"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array());
                // line 115
                echo "                                 
                                 <td class=\"text-right\">&euro; ";
                // line 116
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array()), 2, ",", "."), "html", null, true);
                echo "</td>
                                 <td class=\"text-right\" >&euro; ";
                // line 117
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["invoice"], "valor", array()), 2, ",", "."), "html", null, true);
                echo "</td>
                                 ";
                // line 118
                if ((($context["valRegister"] ?? null) == $this->getAttribute($context["invoice"], "valor", array()))) {
                    // line 119
                    echo "                                    <td class=\"success text-right\"> 
                                       Completa
                                    </td>
                                    ";
                } else {
                    // line 123
                    echo "                                       <td class=\"danger text-right\"> 
                                          <a href=\"";
                    // line 124
                    echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                    echo "pedidofactura/presentar/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_pedido_factura", array()), "html", null, true);
                    echo "\">
                                       Revisar
                                          </a>
                                    </td>
                                 ";
                }
                // line 129
                echo "                              </tr>
                              ";
            }
            // line 131
            echo "                              ";
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
        // line 132
        echo "                              <tr class=\"total-row\">
                                 <td colspan=\"3\">
                                    <strong>
                                    Total Facturas Producto CAJAS/(EUROS):
                                    </strong>
                                 </td>
                                 <td>
                                    <strong>
                                    ";
        // line 140
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["totalboxes"] ?? null), 0, ",", "."), "html", null, true);
        echo "
                                    </strong>
                                 </td>
                                 <td class=\"text-right\">
                                    &nbsp;
                                 </td>
                                 <td  class=\"text-right\">
                                    <strong> &euro; 
                                    ";
        // line 148
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["sumOrderExpenses"] ?? null), 2, ".", ","), "html", null, true);
        echo "
                                    </strong>
                                 </td>
                                 <td>
                                    &nbsp;
                                 </td>
                              </tr>
                           </tbody>
                        </table>";
    }

    public function getTemplateName()
    {
        return "sections/subsections/table-order-info.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  343 => 148,  332 => 140,  322 => 132,  308 => 131,  304 => 129,  294 => 124,  291 => 123,  285 => 119,  283 => 118,  279 => 117,  275 => 116,  272 => 115,  269 => 114,  267 => 113,  262 => 111,  257 => 109,  251 => 106,  245 => 105,  240 => 103,  237 => 102,  234 => 101,  231 => 100,  213 => 99,  210 => 98,  207 => 97,  205 => 96,  176 => 70,  165 => 62,  155 => 54,  141 => 53,  137 => 51,  127 => 46,  124 => 45,  118 => 41,  116 => 40,  112 => 39,  108 => 38,  105 => 37,  102 => 36,  100 => 35,  95 => 33,  90 => 31,  84 => 28,  78 => 27,  73 => 25,  70 => 24,  67 => 23,  64 => 22,  46 => 21,  43 => 20,  40 => 19,  38 => 18,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("                        <div class=\"text-tittle\">Detalle de Facturas del Pedido</div>
                         <small class=\"text-primary\">
                        FACTURAS EN DÓLARES
                        </small>
                        <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Proveedor</th>
                                 <th>Fecha</th>
                                 <th>Cajas</th>
                                 <th>Valor Reg</th>
                                 <th>Valor Fac</th>
                                 <th>Estado</th>
                              </tr>
                           </thead>
                           <tbody>
                              {% set sumOrderExpenses = 0 %}
                              {% set sumOrderExpensesSum = 0 %}
                              {% set totalboxes = 0 %}
                              {% for invoice in invoicesOrder %}
                              {% if invoice.moneda != 'EUROS' %}
                              {% set sumOrderExpenses = sumOrderExpenses +  invoice.valor %}
                              <tr>
                                 <td>{{loop.index}}</td>
                                 <td>
                                    <a href=\"{{rute_url}}pedidofactura/presentar/{{invoice.id_pedido_factura}}\">
                                    {{invoice.supplier.nombre}}
                                    </a>
                                 </td>
                                 <td>{{invoice.fecha_emision}}</td>

                                 <td>{{invoice.detailInvoice.sums.countBoxesProduct | number_format(0,',','.') }}</td>

                                 {% set totalboxes = totalboxes +  invoice.detailInvoice.sums.countBoxesProduct %}
                                 {% set valRegister = invoice.detailInvoice.sums.valueItems %}
                                 
                                 <td class=\"text-right\">\$ {{invoice.detailInvoice.sums.valueItems | number_format(2,',','.') }}</td>
                                 <td class=\"text-right\" >\$ {{invoice.valor  | number_format(2,',','.') }}</td>
                                 {% if valRegister ==  invoice.valor%}
                                    <td class=\"success text-right\"> 
                                       Completa
                                    </td>
                                    {% else %}
                                       <td class=\"danger text-right\"> 
                                          <a href=\"{{rute_url}}pedidofactura/presentar/{{invoice.id_pedido_factura}}\">
                                       Revisar
                                          </a>
                                    </td>
                                 {% endif %}
                              </tr>
                              {% endif %}
                              {% endfor %}
                              <tr class=\"total-row\">
                                 <td colspan=\"3\">
                                    <strong>
                                    Total Facturas Producto CAJAS/(DOLARES):
                                    </strong>
                                 </td>
                                 <td>
                                    <strong>
                                    {{ totalboxes | number_format(0,',','.')}}
                                    </strong>
                                 </td>
                                 <td class=\"text-right\">
                                    &nbsp;
                                 </td>
                                 <td  class=\"text-right\">
                                    <strong> \$ 
                                    {{ sumOrderExpenses | number_format(2, '.', ',') }}
                                    </strong>
                                 </td>
                                 <td>
                                    &nbsp;
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <hr>
                        <small class=\"text-primary\">
                        FACTURAS EN EUROS
                        </small>
                         <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Proveedor</th>
                                 <th>Fecha</th>
                                 <th>Cajas</th>
                                 <th>Valor Reg</th>
                                 <th>Valor Fac</th>
                                 <th>Estado</th>
                              </tr>
                           </thead>
                          <tbody>
                              {% set sumOrderExpenses = 0 %}
                              {% set sumOrderExpensesSum = 0 %}
                              {% set totalboxes = 0 %}
                              {% for invoice in invoicesOrder %}
                              {% if invoice.moneda == 'EUROS' %}
                              {% set sumOrderExpenses = sumOrderExpenses +  invoice.valor %}
                              <tr>
                                 <td>{{loop.index}}</td>
                                 <td>
                                    <a href=\"{{rute_url}}pedidofactura/presentar/{{invoice.id_pedido_factura}}\">
                                    {{invoice.supplier.nombre}}
                                    </a>
                                 </td>
                                 <td>{{invoice.fecha_emision}}</td>

                                 <td>{{invoice.detailInvoice.sums.countBoxesProduct | number_format(0,',','.') }}</td>

                                 {% set totalboxes = totalboxes +  invoice.detailInvoice.sums.countBoxesProduct %}
                                 {% set valRegister = invoice.detailInvoice.sums.valueItems %}
                                 
                                 <td class=\"text-right\">&euro; {{invoice.detailInvoice.sums.valueItems | number_format(2,',','.') }}</td>
                                 <td class=\"text-right\" >&euro; {{invoice.valor  | number_format(2,',','.') }}</td>
                                 {% if valRegister ==  invoice.valor%}
                                    <td class=\"success text-right\"> 
                                       Completa
                                    </td>
                                    {% else %}
                                       <td class=\"danger text-right\"> 
                                          <a href=\"{{rute_url}}pedidofactura/presentar/{{invoice.id_pedido_factura}}\">
                                       Revisar
                                          </a>
                                    </td>
                                 {% endif %}
                              </tr>
                              {% endif %}
                              {% endfor %}
                              <tr class=\"total-row\">
                                 <td colspan=\"3\">
                                    <strong>
                                    Total Facturas Producto CAJAS/(EUROS):
                                    </strong>
                                 </td>
                                 <td>
                                    <strong>
                                    {{ totalboxes | number_format(0,',','.')}}
                                    </strong>
                                 </td>
                                 <td class=\"text-right\">
                                    &nbsp;
                                 </td>
                                 <td  class=\"text-right\">
                                    <strong> &euro; 
                                    {{ sumOrderExpenses | number_format(2, '.', ',') }}
                                    </strong>
                                 </td>
                                 <td>
                                    &nbsp;
                                 </td>
                              </tr>
                           </tbody>
                        </table>", "sections/subsections/table-order-info.html.twig", "/var/www/html/app/src/views/sections/subsections/table-order-info.html.twig");
    }
}
