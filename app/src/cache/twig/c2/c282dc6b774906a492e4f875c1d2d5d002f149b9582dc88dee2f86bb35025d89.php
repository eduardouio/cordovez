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
               <h4 class=\"text-primary\"> <small>Pedidos Activos: </small> <span id=\"suma\"> 
                  ";
        // line 14
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 22, 0, ".", ","), "html", null, true);
        echo " 
                  </span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Pedidos Cerrados: </small> 
                  <span id=\"suma\"> ";
        // line 20
        echo ($context["simbolo"] ?? null);
        echo " 
                  ";
        // line 21
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 1, 0, ".", ","), "html", null, true);
        echo "</span>
               </h4>
            </div>
            <div class=\"col-sm-3\">
               <h4 class=\"text-danger\"> <small>Por Regimen 10/70: </small> 
                  <span id=\"suma\">
                  ";
        // line 27
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 1, 0, ".", ","), "html", null, true);
        echo " / ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 1, 0, ".", ","), "html", null, true);
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
        // line 50
        $context["init"] = ((($context["current_page"] ?? null) * ($context["perPage"] ?? null)) - ($context["perPage"] ?? null));
        // line 51
        echo "          ";
        $context["item"] = (($context["init"] ?? null) + 1);
        // line 52
        echo "
          ";
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            echo "         
          <tr>
            <td>";
            // line 55
            echo twig_escape_filter($this->env, ($context["item"] ?? null), "html", null, true);
            echo "</td>
            <td> <a href=\"";
            // line 56
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "</a>
              ";
            // line 57
            if (($this->getAttribute($context["order"], "bg_islocked", array()) == "0")) {
                // line 58
                echo "                <span class=\"label label-success pull-right\">
                  Activo
                 </span>
              ";
            } else {
                // line 62
                echo "                <span class=\"label label-died pull-right\">
                  Cerrado
                 </span>
              ";
            }
            // line 66
            echo "            </td>
            <td class=\"text-right\">";
            // line 67
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "regimen", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 68
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "incoterm", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "pais_origen", array()), "html", null, true);
            echo "</td>
            <td>
              ";
            // line 71
            if (($this->getAttribute($context["order"], "fecha_arribo", array()) == null)) {
                // line 72
                echo "                <strong>
                Arribo Pendiente
                </strong>
              ";
            } else {
                // line 76
                echo "              ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "fecha_arribo", array()), "html", null, true);
                echo " 
              ";
                // line 77
                $context["meses"] = ($this->getAttribute($context["order"], "dias", array()) / 30);
                // line 78
                echo "              ";
                $context["anos"] = ($this->getAttribute($context["order"], "dias", array()) / 365);
                // line 79
                echo "              ";
                if (($this->getAttribute($context["order"], "dias", array()) < 30)) {
                    // line 80
                    echo "              <label class=\"label label-info pull-right\">
                ";
                    // line 81
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["order"], "dias", array()), 1, ".", ","), "html", null, true);
                    echo " <small>días</small>  
              ";
                } elseif ((($this->getAttribute(                // line 82
$context["order"], "dias", array()) > 29) && ($this->getAttribute($context["order"], "dias", array()) < 300))) {
                    // line 83
                    echo "              <label class=\"label label-warning pull-right\">
                ";
                    // line 84
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["meses"] ?? null), 2, ".", ","), "html", null, true);
                    echo " <small>Meses</small>  
              </label>
              ";
                } elseif ((($this->getAttribute(                // line 86
$context["order"], "dias", array()) > 300) && ($this->getAttribute($context["order"], "dias", array()) < 364))) {
                    // line 87
                    echo "              <label class=\"label label-danger pull-right\">
                  ";
                    // line 88
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["anos"] ?? null), 2, ".", ","), "html", null, true);
                    echo " <small>años</small>
              </label>
              ";
                } elseif (($this->getAttribute(                // line 90
$context["order"], "dias", array()) > 365)) {
                    // line 91
                    echo "              <label class=\"label label-died pull-right\">
                  ";
                    // line 92
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["anos"] ?? null), 0, ".", ","), "html", null, true);
                    echo " <small>años</small>
              </label>
              ";
                }
                // line 95
                echo "            ";
            }
            // line 96
            echo "            </td>
            <td class=\"text-right\">";
            // line 97
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "dias_libres", array()), "html", null, true);
            echo " días</td>
            <td class=\"text-right\">\$ 
              ";
            // line 99
            $context["fob"] = ($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "valInvoices", array()) + ($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "initExpenses", array()) * $this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "mutiple", array())));
            // line 100
            echo "              ";
            $context["saldo"] = (($context["fob"] ?? null) - $this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "infoInvoices", array()));
            // line 101
            echo "            ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
            echo "
          </td>
            <td class=\"text-right\">\$ 
              ";
            // line 104
            if (($this->getAttribute($context["order"], "regimen", array()) == 10)) {
                // line 105
                echo "                  ";
                if (($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "regimen10", array()) == true)) {
                    // line 106
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
                    echo "
                  ";
                } else {
                    // line 108
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
                    echo "
                  ";
                }
                // line 109
                echo "  
              ";
            } else {
                // line 111
                echo "                  ";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "infoInvoices", array()), 2, ".", ","), "html", null, true);
                echo "
              ";
            }
            // line 112
            echo "                                      
          </td>          
          ";
            // line 114
            if ((($context["saldo"] ?? null) == 0)) {
                // line 115
                echo "          ";
                $context["text_class"] = "text-success";
                // line 116
                echo "          ";
            } else {
                // line 117
                echo "            ";
                $context["text_class"] = "text-primary";
                // line 118
                echo "          ";
            }
            // line 119
            echo "          
            <td class=\"text-right ";
            // line 120
            echo twig_escape_filter($this->env, ($context["text_class"] ?? null), "html", null, true);
            echo "\" >\$ 
              ";
            // line 121
            if (($this->getAttribute($context["order"], "regimen", array()) == 10)) {
                // line 122
                echo "                  ";
                if (($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "regimen10", array()) == true)) {
                    // line 123
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
                    echo "
                  ";
                } else {
                    // line 125
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
                    echo "
                  ";
                }
                // line 126
                echo "  
              ";
            } else {
                // line 128
                echo "                  ";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["saldo"] ?? null), 2, ".", ","), "html", null, true);
                echo "
              ";
            }
            // line 129
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
            // line 139
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\"> <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Pedido </a>  
                  </li>
                  <li> 
                    ";
            // line 143
            if (($this->getAttribute($context["order"], "bg_isclosed", array()) != "1")) {
                // line 144
                echo "                    <a href=\"";
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedidofactura/nuevo/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                echo "\">
                    <span class=\"fa fa-eye fa-fw\"></span>
                    Agregar Productos</a> 
                  </li>
                  <li> <a href=\"";
                // line 148
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/editar/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Pedido</a> 
                  </li>
                    ";
                // line 152
                if ((($context["fob"] ?? null) == 0)) {
                    // line 153
                    echo "                  <li> 
                    <a href=\"";
                    // line 154
                    echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                    echo "pedido/eliminar/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                    echo "\"
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Pedido</a> 
                  </li>
                  ";
                }
                // line 159
                echo "                  
                  ";
            }
            // line 161
            echo "                </ul>
              </div>
            </td>
          </tr>
          ";
            // line 165
            $context["item"] = (($context["item"] ?? null) + 1);
            // line 166
            echo "          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 167
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
        return array (  380 => 167,  374 => 166,  372 => 165,  366 => 161,  362 => 159,  352 => 154,  349 => 153,  347 => 152,  338 => 148,  328 => 144,  326 => 143,  317 => 139,  305 => 129,  299 => 128,  295 => 126,  289 => 125,  283 => 123,  280 => 122,  278 => 121,  274 => 120,  271 => 119,  268 => 118,  265 => 117,  262 => 116,  259 => 115,  257 => 114,  253 => 112,  247 => 111,  243 => 109,  237 => 108,  231 => 106,  228 => 105,  226 => 104,  219 => 101,  216 => 100,  214 => 99,  209 => 97,  206 => 96,  203 => 95,  197 => 92,  194 => 91,  192 => 90,  187 => 88,  184 => 87,  182 => 86,  177 => 84,  174 => 83,  172 => 82,  168 => 81,  165 => 80,  162 => 79,  159 => 78,  157 => 77,  152 => 76,  146 => 72,  144 => 71,  139 => 69,  135 => 68,  131 => 67,  128 => 66,  122 => 62,  116 => 58,  114 => 57,  106 => 56,  102 => 55,  95 => 53,  92 => 52,  89 => 51,  87 => 50,  59 => 27,  50 => 21,  46 => 20,  37 => 14,  25 => 5,  19 => 1,);
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
               <h4 class=\"text-primary\"> <small>Pedidos Activos: </small> <span id=\"suma\"> 
                  {{ 22 | number_format(0, '.', ',') }} 
                  </span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Pedidos Cerrados: </small> 
                  <span id=\"suma\"> {{ simbolo | raw}} 
                  {{ 1  | number_format(0, '.', ',')}}</span>
               </h4>
            </div>
            <div class=\"col-sm-3\">
               <h4 class=\"text-danger\"> <small>Por Regimen 10/70: </small> 
                  <span id=\"suma\">
                  {{ 1  | number_format(0, '.', ',')}} / {{ 1  | number_format(0, '.', ',')}}
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
            <td> <a href=\"{{ rute_url }}pedido/presentar/{{order.nro_pedido}}\">{{order.nro_pedido}}</a>
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
            <td class=\"text-right\">{{order.regimen}}</td>
            <td>{{order.incoterm}}</td>
            <td>{{order.pais_origen}}</td>
            <td>
              {% if order.fecha_arribo == NULL %}
                <strong>
                Arribo Pendiente
                </strong>
              {% else %}
              {{order.fecha_arribo}} 
              {% set meses = (order.dias / 30) %}
              {% set anos = (order.dias / 365)  %}
              {% if order.dias < 30 %}
              <label class=\"label label-info pull-right\">
                {{order.dias | number_format(1, '.', ',') }} <small>días</small>  
              {% elseif (order.dias > 29) and (order.dias < 300) %}
              <label class=\"label label-warning pull-right\">
                {{meses | number_format(2, '.', ',')}} <small>Meses</small>  
              </label>
              {% elseif (order.dias > 300) and (order.dias < 364)  %}
              <label class=\"label label-danger pull-right\">
                  {{ anos | number_format(2, '.', ',')}} <small>años</small>
              </label>
              {% elseif order.dias > 365 %}
              <label class=\"label label-died pull-right\">
                  {{ anos | number_format(0, '.', ',')}} <small>años</small>
              </label>
              {% endif %}
            {% endif %}
            </td>
            <td class=\"text-right\">{{ order.dias_libres }} días</td>
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
                    {% if order.bg_isclosed != '1' %}
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
