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
    <div class=\"col-sm-8\">
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
    <div class=\"col-sm-4\">
      <form action=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/busquedas/\" 
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
       class=\"btn\" >
        &nbsp;&nbsp;&nbsp;
       <span class=\"fa fa-search fa-fw\"></span>
       &nbsp;&nbsp;&nbsp;
     </button>
      </form>
  
    </div>
  </div>
  <br>
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
            <th>FOB</th>
            <th>Nacionalizado</th>
            <th>Saldo FOB</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          ";
        // line 53
        $context["init"] = ((($context["current_page"] ?? null) * ($context["perPage"] ?? null)) - ($context["perPage"] ?? null));
        // line 54
        echo "          ";
        $context["item"] = (($context["init"] ?? null) + 1);
        // line 55
        echo "
          ";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            echo "         
          <tr>
            <td>";
            // line 58
            echo twig_escape_filter($this->env, ($context["item"] ?? null), "html", null, true);
            echo "</td>
            <td> <a href=\"";
            // line 59
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "</a>
              ";
            // line 60
            if (($this->getAttribute($context["order"], "estado", array()) == "ABIERTO")) {
                // line 61
                echo "                <span class=\"label label-success pull-right\">
                  ";
                // line 62
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "estado", array()), "html", null, true);
                echo "
                 </span>
              ";
            } else {
                // line 65
                echo "                <span class=\"label label-died pull-right\">
                  ";
                // line 66
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "estado", array()), "html", null, true);
                echo "
                 </span>
              ";
            }
            // line 69
            echo "            </td>
            <td class=\"text-right\">";
            // line 70
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "regimen", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "incoterm", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 72
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "pais_origen", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 73
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "fecha_arribo", array()), "html", null, true);
            echo " 
              ";
            // line 74
            $context["meses"] = ($this->getAttribute($context["order"], "dias", array()) / 30);
            // line 75
            echo "              ";
            $context["anos"] = ($this->getAttribute($context["order"], "dias", array()) / 365);
            // line 76
            echo "              ";
            if (($this->getAttribute($context["order"], "dias", array()) < 30)) {
                // line 77
                echo "              <label class=\"label label-info pull-right\">
                ";
                // line 78
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["order"], "dias", array()), 1, ".", ","), "html", null, true);
                echo " <small>días</small>  
              ";
            } elseif ((($this->getAttribute(            // line 79
$context["order"], "dias", array()) > 29) && ($this->getAttribute($context["order"], "dias", array()) < 300))) {
                // line 80
                echo "              <label class=\"label label-warning pull-right\">
                ";
                // line 81
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["meses"] ?? null), 2, ".", ","), "html", null, true);
                echo " <small>Meses</small>  
              ";
            } elseif ((($this->getAttribute(            // line 82
$context["order"], "dias", array()) > 300) && ($this->getAttribute($context["order"], "dias", array()) < 364))) {
                // line 83
                echo "              <label class=\"label label-danger pull-right\">
                  ";
                // line 84
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["anos"] ?? null), 2, ".", ","), "html", null, true);
                echo " <small>años</small>
              ";
            } elseif (($this->getAttribute(            // line 85
$context["order"], "dias", array()) > 365)) {
                // line 86
                echo "              <label class=\"label label-died pull-right\">
                  ";
                // line 87
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["anos"] ?? null), 0, ".", ","), "html", null, true);
                echo " <small>años</small>
              ";
            }
            // line 89
            echo "              
              </label>
            </td>
            <td class=\"text-right\">\$ 
              ";
            // line 93
            $context["fob"] = ($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "valInvoices", array()) + ($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "initExpenses", array()) * $this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "mutiple", array())));
            // line 94
            echo "              ";
            $context["saldo"] = (($context["fob"] ?? null) - $this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "infoInvoices", array()));
            // line 95
            echo "            ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
            echo "
          </td>
            <td class=\"text-right\">\$ 
              ";
            // line 98
            if (($this->getAttribute($context["order"], "regimen", array()) == 10)) {
                // line 99
                echo "                  ";
                if (($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "regimen10", array()) == true)) {
                    // line 100
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
                    echo "
                  ";
                } else {
                    // line 102
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
                    echo "
                  ";
                }
                // line 103
                echo "  
              ";
            } else {
                // line 105
                echo "                  ";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "infoInvoices", array()), 2, ".", ","), "html", null, true);
                echo "
              ";
            }
            // line 106
            echo "                                      
          </td>          
          ";
            // line 108
            if ((($context["saldo"] ?? null) == 0)) {
                // line 109
                echo "          ";
                $context["text_class"] = "text-success";
                // line 110
                echo "          ";
            } else {
                // line 111
                echo "            ";
                $context["text_class"] = "text-primary";
                // line 112
                echo "          ";
            }
            // line 113
            echo "          
            <td class=\"text-right ";
            // line 114
            echo twig_escape_filter($this->env, ($context["text_class"] ?? null), "html", null, true);
            echo "\" >\$ 
              ";
            // line 115
            if (($this->getAttribute($context["order"], "regimen", array()) == 10)) {
                // line 116
                echo "                  ";
                if (($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "regimen10", array()) == true)) {
                    // line 117
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
                    echo "
                  ";
                } else {
                    // line 119
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
                    echo "
                  ";
                }
                // line 120
                echo "  
              ";
            } else {
                // line 122
                echo "                  ";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["saldo"] ?? null), 2, ".", ","), "html", null, true);
                echo "
              ";
            }
            // line 123
            echo "                                      

          </td>
            <td>
              <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"";
            // line 133
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\"> <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Pedido </a>  
                  </li>
                  <li> 
                    ";
            // line 137
            if (($this->getAttribute($context["order"], "estado", array()) == "ABIERTO")) {
                // line 138
                echo "                    <a href=\"";
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedidofactura/nuevo/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                echo "\">
                    <span class=\"fa fa-eye fa-fw\"></span>
                    Agregar Productos</a> 
                  </li>
                  <li> <a href=\"";
                // line 142
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/editar/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Pedido</a> 
                  </li>
                    ";
                // line 146
                if ((($context["fob"] ?? null) == 0)) {
                    // line 147
                    echo "                  <li> 
                    <a href=\"";
                    // line 148
                    echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                    echo "pedido/eliminar/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                    echo "\"
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Pedido</a> 
                  </li>
                  ";
                }
                // line 153
                echo "                  
                  ";
            }
            // line 155
            echo "                </ul>
              </div>
            </td>
          </tr>
          ";
            // line 159
            $context["item"] = (($context["item"] ?? null) + 1);
            // line 160
            echo "          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 161
        echo "        </tbody>
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
        return array (  360 => 161,  354 => 160,  352 => 159,  346 => 155,  342 => 153,  332 => 148,  329 => 147,  327 => 146,  318 => 142,  308 => 138,  306 => 137,  297 => 133,  285 => 123,  279 => 122,  275 => 120,  269 => 119,  263 => 117,  260 => 116,  258 => 115,  254 => 114,  251 => 113,  248 => 112,  245 => 111,  242 => 110,  239 => 109,  237 => 108,  233 => 106,  227 => 105,  223 => 103,  217 => 102,  211 => 100,  208 => 99,  206 => 98,  199 => 95,  196 => 94,  194 => 93,  188 => 89,  183 => 87,  180 => 86,  178 => 85,  174 => 84,  171 => 83,  169 => 82,  165 => 81,  162 => 80,  160 => 79,  156 => 78,  153 => 77,  150 => 76,  147 => 75,  145 => 74,  141 => 73,  137 => 72,  133 => 71,  129 => 70,  126 => 69,  120 => 66,  117 => 65,  111 => 62,  108 => 61,  106 => 60,  98 => 59,  94 => 58,  87 => 56,  84 => 55,  81 => 54,  79 => 53,  36 => 13,  25 => 5,  19 => 1,);
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
    <div class=\"col-sm-8\">
      <a href=\"{{ rute_url }}pedido/nuevo/\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Nuevo Pedido
        </button>
      </a>
    </div>
    <div class=\"col-sm-4\">
      <form action=\"{{rute_url}}pedido/busquedas/\" 
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
       class=\"btn\" >
        &nbsp;&nbsp;&nbsp;
       <span class=\"fa fa-search fa-fw\"></span>
       &nbsp;&nbsp;&nbsp;
     </button>
      </form>
  
    </div>
  </div>
  <br>
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
            <td> <a href=\"{{ rute_url }}pedido/presentar/{{order.nro_pedido}}\">{{order.nro_pedido}}</a>
              {% if order.estado == 'ABIERTO' %}
                <span class=\"label label-success pull-right\">
                  {{order.estado}}
                 </span>
              {% else %}
                <span class=\"label label-died pull-right\">
                  {{order.estado}}
                 </span>
              {% endif %}
            </td>
            <td class=\"text-right\">{{order.regimen}}</td>
            <td>{{order.incoterm}}</td>
            <td>{{order.pais_origen}}</td>
            <td>{{order.fecha_arribo}} 
              {% set meses = (order.dias / 30) %}
              {% set anos = (order.dias / 365)  %}
              {% if order.dias < 30 %}
              <label class=\"label label-info pull-right\">
                {{order.dias | number_format(1, '.', ',') }} <small>días</small>  
              {% elseif (order.dias > 29) and (order.dias < 300) %}
              <label class=\"label label-warning pull-right\">
                {{meses | number_format(2, '.', ',')}} <small>Meses</small>  
              {% elseif (order.dias > 300) and (order.dias < 364)  %}
              <label class=\"label label-danger pull-right\">
                  {{ anos | number_format(2, '.', ',')}} <small>años</small>
              {% elseif order.dias > 365 %}
              <label class=\"label label-died pull-right\">
                  {{ anos | number_format(0, '.', ',')}} <small>años</small>
              {% endif %}
              
              </label>
            </td>
            <td class=\"text-right\">\$ 
              {%  set fob = order.resumValues.valInvoices + (order.resumValues.initExpenses * order.resumValues.mutiple ) %}
              {% set saldo =  fob - order.resumValues.infoInvoices %}
            {{ fob | number_format(2, '.', ',')}}
          </td>
            <td class=\"text-right\">\$ 
              {% if order.regimen == 10 %}
                  {% if order.resumValues.regimen10 == true %}
                    {{ fob  | number_format(2, '.', ',')}}
                  {% else %}
                    {{   0 | number_format(2, '.', ',')}}
                  {% endif %}  
              {% else %}
                  {{ order.resumValues.infoInvoices | number_format(2, '.', ',') }}
              {% endif %}                                      
          </td>          
          {% if saldo == 0.0 %}
          {% set text_class = 'text-success' %}
          {% else %}
            {% set text_class = 'text-primary' %}
          {% endif %}
          
            <td class=\"text-right {{text_class}}\" >\$ 
              {% if order.regimen == 10 %}
                  {% if order.resumValues.regimen10 == true %}
                    {{ 0  | number_format(2, '.', ',')}}
                  {% else %}
                    {{ fob   | number_format(2, '.', ',')}}
                  {% endif %}  
              {% else %}
                  {{ saldo | number_format(2, '.', ',') }}
              {% endif %}                                      

          </td>
            <td>
              <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"{{rute_url}}pedido/presentar/{{order.nro_pedido}}\"> <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Pedido </a>  
                  </li>
                  <li> 
                    {% if order.estado == 'ABIERTO' %}
                    <a href=\"{{rute_url}}pedidofactura/nuevo/{{order.nro_pedido}}\">
                    <span class=\"fa fa-eye fa-fw\"></span>
                    Agregar Productos</a> 
                  </li>
                  <li> <a href=\"{{rute_url}}pedido/editar/{{order.nro_pedido}}\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Pedido</a> 
                  </li>
                    {% if fob == 0 %}
                  <li> 
                    <a href=\"{{rute_url}}pedido/eliminar/{{order.nro_pedido}}\"
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
