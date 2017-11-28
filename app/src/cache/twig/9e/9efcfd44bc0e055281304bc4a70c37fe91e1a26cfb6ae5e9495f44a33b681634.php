<?php

/* sections/subsections/table-rates.html.twig */
class __TwigTemplate_2d2d4533396c119a748f935e200f8b553251919cab6ebda602455f6874742275 extends Twig_Template
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
        echo "<div class=\"text-tittle\">Provisiones Iniciales Aplicables</div>

                        <form action=\"";
        // line 3
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/putInitialExpenses/\" method=\"post\">
                           <input type=\"hidden\" name=\"nro_pedido\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\">
                        <table class=\"table  table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Concepto</th>
                                 <th>Valor</th>
                                 <th>Seleccionar</th>
                              </tr>
                           </thead>
                           <tbody>
                              ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["unusedExpenses"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["rateExpense"]) {
            // line 16
            echo "                              <tr>
                                 <td>";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                                 <td>";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($context["rateExpense"], "concepto", array()), "html", null, true);
            echo "</td>
                           ";
            // line 19
            if (($this->getAttribute($this->getAttribute(($context["minimal"] ?? null), "valuesOrder", array()), "statusInvoices", array()) == true)) {
                // line 20
                echo "                              ";
                if (($this->getAttribute($context["rateExpense"], "concepto", array()) == "SEGURO")) {
                    // line 21
                    echo "                                    <td class=\"text-success\">
                                       <strong>
                                          ";
                    // line 23
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["minimal"] ?? null), "valuesOrder", array()), "seguro", array()), 2, ".", ","), "html", null, true);
                    echo "
                                       </strong>  
                                    </td>
                              ";
                }
                // line 26
                echo "   
                              ";
                // line 27
                if (($this->getAttribute($context["rateExpense"], "concepto", array()) == "ISD")) {
                    // line 28
                    echo "                                    <td class=\"text-success\">
                                       <strong>
                                          ";
                    // line 30
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["minimal"] ?? null), "valuesOrder", array()), "isd", array()), 2, ".", ","), "html", null, true);
                    echo "
                                       </strong>  
                                    </td>
                              ";
                }
                // line 34
                echo "                              ";
                if (($this->getAttribute($context["rateExpense"], "concepto", array()) != "SEGURO")) {
                    // line 35
                    echo "                              ";
                    if (($this->getAttribute($context["rateExpense"], "concepto", array()) != "ISD")) {
                        // line 36
                        echo "                                 <td>";
                        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["rateExpense"], "valor", array()), 2, ".", ","), "html", null, true);
                        echo "</td>  
                              ";
                    }
                    // line 38
                    echo "                              ";
                }
                // line 39
                echo "                           ";
            } else {
                // line 40
                echo "                             <td>";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["rateExpense"], "valor", array()), 2, ".", ","), "html", null, true);
                echo "</td>        
                           ";
            }
            // line 42
            echo "
                                 <td class=\"text-center\">
                                    <input
                                    type=\"radio\" 
                                    name=\"";
            // line 46
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute($context["rateExpense"], "concepto", array()), array(" " => "")), "html", null, true);
            echo "\" 
                                    value=\"";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($context["rateExpense"], "id_tarifa_gastos", array()), "html", null, true);
            echo "\"
                                    >
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rateExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "                           </tbody>
                        </table>
                              <button
                                    type= \"submit\"
                                    class=\"btn btn-default btn-sm\"
                                    >
                                    <span class=\"fa fa-warning fa-fw\"></span>
                                    Aplicar Gastos Iniciales
                                    </button>
                              </a>
<br>
<br>
                        </form>

";
    }

    public function getTemplateName()
    {
        return "sections/subsections/table-rates.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 52,  135 => 47,  131 => 46,  125 => 42,  119 => 40,  116 => 39,  113 => 38,  107 => 36,  104 => 35,  101 => 34,  94 => 30,  90 => 28,  88 => 27,  85 => 26,  78 => 23,  74 => 21,  71 => 20,  69 => 19,  65 => 18,  61 => 17,  58 => 16,  41 => 15,  27 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"text-tittle\">Provisiones Iniciales Aplicables</div>

                        <form action=\"{{rute_url}}gstinicial/putInitialExpenses/\" method=\"post\">
                           <input type=\"hidden\" name=\"nro_pedido\" value=\"{{order.nro_pedido}}\">
                        <table class=\"table  table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Concepto</th>
                                 <th>Valor</th>
                                 <th>Seleccionar</th>
                              </tr>
                           </thead>
                           <tbody>
                              {% for rateExpense in unusedExpenses %}
                              <tr>
                                 <td>{{loop.index}}</td>
                                 <td>{{rateExpense.concepto}}</td>
                           {% if minimal.valuesOrder.statusInvoices == true %}
                              {% if rateExpense.concepto == 'SEGURO' %}
                                    <td class=\"text-success\">
                                       <strong>
                                          {{minimal.valuesOrder.seguro |number_format(2, '.', ',') }}
                                       </strong>  
                                    </td>
                              {% endif %}   
                              {% if rateExpense.concepto == 'ISD' %}
                                    <td class=\"text-success\">
                                       <strong>
                                          {{minimal.valuesOrder.isd |number_format(2, '.', ',') }}
                                       </strong>  
                                    </td>
                              {% endif %}
                              {% if rateExpense.concepto != 'SEGURO' %}
                              {% if rateExpense.concepto != 'ISD' %}
                                 <td>{{rateExpense.valor |number_format(2, '.', ',') }}</td>  
                              {% endif %}
                              {% endif %}
                           {% else %}
                             <td>{{rateExpense.valor |number_format(2, '.', ',') }}</td>        
                           {% endif %}

                                 <td class=\"text-center\">
                                    <input
                                    type=\"radio\" 
                                    name=\"{{ rateExpense.concepto | replace({' ':''})}}\" 
                                    value=\"{{rateExpense.id_tarifa_gastos}}\"
                                    >
                                 </td>
                              </tr>
                              {% endfor %}
                           </tbody>
                        </table>
                              <button
                                    type= \"submit\"
                                    class=\"btn btn-default btn-sm\"
                                    >
                                    <span class=\"fa fa-warning fa-fw\"></span>
                                    Aplicar Gastos Iniciales
                                    </button>
                              </a>
<br>
<br>
                        </form>

", "sections/subsections/table-rates.html.twig", "/var/www/html/app/src/views/sections/subsections/table-rates.html.twig");
    }
}
