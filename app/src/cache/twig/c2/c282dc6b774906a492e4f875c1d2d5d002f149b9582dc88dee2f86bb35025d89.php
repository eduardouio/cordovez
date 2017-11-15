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
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["infoBase"] ?? null), "activeOrders", array()), 0, ".", ","), "html", null, true);
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
        $context["colsedOrders"] = ($this->getAttribute(($context["infoBase"] ?? null), "totalOrders", array()) - $this->getAttribute(($context["infoBase"] ?? null), "activeOrders", array()));
        // line 22
        echo "                  ";
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
        // line 33
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["infoBase"] ?? null), "consumeOrders", array()), 0, ".", ","), "html", null, true);
        echo "
              </span>
                   <span class=\"text-default\"> / </span>
              <span class=\"text-primary\">
              ";
        // line 37
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
        // line 60
        $context["init"] = ((($context["current_page"] ?? null) * ($context["perPage"] ?? null)) - ($context["perPage"] ?? null));
        // line 61
        echo "          ";
        $context["item"] = (($context["init"] ?? null) + 1);
        // line 62
        echo "          ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            echo "         
          <tr>
            <td>";
            // line 64
            echo twig_escape_filter($this->env, ($context["item"] ?? null), "html", null, true);
            echo "</td>
            <td> <a href=\"";
            // line 65
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "</a>
              ";
            // line 66
            if (($this->getAttribute($context["order"], "bg_islocked", array()) == "0")) {
                // line 67
                echo "                <span class=\"label label-success pull-right\">
                  Activo
                 </span>
              ";
            } else {
                // line 71
                echo "                <span class=\"label label-died pull-right\">
                  Cerrado
                 </span>
              ";
            }
            // line 75
            echo "            </td>
            <td class=\"text-right\">";
            // line 76
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "regimen", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 77
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "incoterm", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 78
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "pais_origen", array()), "html", null, true);
            echo "</td>
            <td>
              ";
            // line 80
            if (($this->getAttribute($context["order"], "fecha_arribo", array()) == null)) {
                // line 81
                echo "                <strong>
                Arribo Pendiente
                </strong>
              ";
            } else {
                // line 85
                echo "              ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "fecha_arribo", array()), "html", null, true);
                echo " 
              ";
                // line 86
                $context["meses"] = ($this->getAttribute($context["order"], "dias", array()) / 30);
                // line 87
                echo "              ";
                $context["anos"] = ($this->getAttribute($context["order"], "dias", array()) / 365);
                // line 88
                echo "              ";
                if (($this->getAttribute($context["order"], "dias", array()) < 30)) {
                    // line 89
                    echo "              <label class=\"label label-info pull-right\">
                ";
                    // line 90
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["order"], "dias", array()), 1, ".", ","), "html", null, true);
                    echo " <small>días</small>  
              ";
                } elseif ((($this->getAttribute(                // line 91
$context["order"], "dias", array()) > 29) && ($this->getAttribute($context["order"], "dias", array()) < 300))) {
                    // line 92
                    echo "              <label class=\"label label-warning pull-right\">
                ";
                    // line 93
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["meses"] ?? null), 2, ".", ","), "html", null, true);
                    echo " <small>Meses</small>  
              </label>
              ";
                } elseif ((($this->getAttribute(                // line 95
$context["order"], "dias", array()) > 300) && ($this->getAttribute($context["order"], "dias", array()) < 364))) {
                    // line 96
                    echo "              <label class=\"label label-danger pull-right\">
                  ";
                    // line 97
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["anos"] ?? null), 2, ".", ","), "html", null, true);
                    echo " <small>años</small>
              </label>
              ";
                } elseif (($this->getAttribute(                // line 99
$context["order"], "dias", array()) > 365)) {
                    // line 100
                    echo "              <label class=\"label label-died pull-right\">
                  ";
                    // line 101
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["anos"] ?? null), 0, ".", ","), "html", null, true);
                    echo " <small>años</small>
              </label>
              ";
                }
                // line 104
                echo "            ";
            }
            // line 105
            echo "            </td>
            <td class=\"text-right\">";
            // line 106
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "dias_libres", array()), "html", null, true);
            echo " días</td>
            <td class=\"text-right\">\$ 
              ";
            // line 108
            $context["fob"] = ($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "valInvoices", array()) + ($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "initExpenses", array()) * $this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "mutiple", array())));
            // line 109
            echo "              ";
            $context["saldo"] = (($context["fob"] ?? null) - $this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "infoInvoices", array()));
            // line 110
            echo "            ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
            echo "
          </td>
            <td class=\"text-right\">\$ 
              ";
            // line 113
            if (($this->getAttribute($context["order"], "regimen", array()) == 10)) {
                // line 114
                echo "                  ";
                if (($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "regimen10", array()) == true)) {
                    // line 115
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
                    echo "
                  ";
                } else {
                    // line 117
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
                    echo "
                  ";
                }
                // line 118
                echo "  
              ";
            } else {
                // line 120
                echo "                  ";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "infoInvoices", array()), 2, ".", ","), "html", null, true);
                echo "
              ";
            }
            // line 121
            echo "                                      
          </td>          
          ";
            // line 123
            if ((($context["saldo"] ?? null) == 0)) {
                // line 124
                echo "          ";
                $context["text_class"] = "text-success";
                // line 125
                echo "          ";
            } else {
                // line 126
                echo "            ";
                $context["text_class"] = "text-primary";
                // line 127
                echo "          ";
            }
            // line 128
            echo "          
            <td class=\"text-right ";
            // line 129
            echo twig_escape_filter($this->env, ($context["text_class"] ?? null), "html", null, true);
            echo "\" >\$ 
              ";
            // line 130
            if (($this->getAttribute($context["order"], "regimen", array()) == 10)) {
                // line 131
                echo "                  ";
                if (($this->getAttribute($this->getAttribute($context["order"], "resumValues", array()), "regimen10", array()) == true)) {
                    // line 132
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
                    echo "
                  ";
                } else {
                    // line 134
                    echo "                    ";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
                    echo "
                  ";
                }
                // line 135
                echo "  
              ";
            } else {
                // line 137
                echo "                  ";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["saldo"] ?? null), 2, ".", ","), "html", null, true);
                echo "
              ";
            }
            // line 138
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
            // line 148
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\"> <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Pedido </a>  
                  </li>
                  <li> 
                    ";
            // line 152
            if (($this->getAttribute($context["order"], "bg_isclosed", array()) != "1")) {
                // line 153
                echo "                    <a href=\"";
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedidofactura/nuevo/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                echo "\">
                    <span class=\"fa fa-eye fa-fw\"></span>
                    Agregar Productos</a> 
                  </li>
                  <li> <a href=\"";
                // line 157
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/editar/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Pedido</a> 
                  </li>
                    ";
                // line 161
                if ((($context["fob"] ?? null) == 0)) {
                    // line 162
                    echo "                  <li> 
                    <a href=\"";
                    // line 163
                    echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                    echo "pedido/eliminar/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
                    echo "\"
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Pedido</a> 
                  </li>
                  ";
                }
                // line 168
                echo "                  
                  ";
            }
            // line 170
            echo "                </ul>
              </div>
            </td>
          </tr>
          ";
            // line 174
            $context["item"] = (($context["item"] ?? null) + 1);
            // line 175
            echo "          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 176
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
        return array (  391 => 176,  385 => 175,  383 => 174,  377 => 170,  373 => 168,  363 => 163,  360 => 162,  358 => 161,  349 => 157,  339 => 153,  337 => 152,  328 => 148,  316 => 138,  310 => 137,  306 => 135,  300 => 134,  294 => 132,  291 => 131,  289 => 130,  285 => 129,  282 => 128,  279 => 127,  276 => 126,  273 => 125,  270 => 124,  268 => 123,  264 => 121,  258 => 120,  254 => 118,  248 => 117,  242 => 115,  239 => 114,  237 => 113,  230 => 110,  227 => 109,  225 => 108,  220 => 106,  217 => 105,  214 => 104,  208 => 101,  205 => 100,  203 => 99,  198 => 97,  195 => 96,  193 => 95,  188 => 93,  185 => 92,  183 => 91,  179 => 90,  176 => 89,  173 => 88,  170 => 87,  168 => 86,  163 => 85,  157 => 81,  155 => 80,  150 => 78,  146 => 77,  142 => 76,  139 => 75,  133 => 71,  127 => 67,  125 => 66,  117 => 65,  113 => 64,  105 => 62,  102 => 61,  100 => 60,  74 => 37,  67 => 33,  52 => 22,  50 => 21,  46 => 20,  37 => 14,  25 => 5,  19 => 1,);
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
                  {{ infoBase.activeOrders | number_format(0, '.', ',') }} 
                  </span>
               </h4>
            </div>
            <div class=\"col-sm-2\">
               <h4 class=\"text-primary\"> <small>Pedidos Cerrados: </small> 
                  <span id=\"suma\"> {{ simbolo | raw}} 
                    {% set colsedOrders = infoBase.totalOrders -infoBase.activeOrders %}
                  {{  colsedOrders | number_format(0, '.', ',')}}</span>
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
                  {{ infoBase.consumeOrders  | number_format(0, '.', ',')}}
              </span>
                   <span class=\"text-default\"> / </span>
              <span class=\"text-primary\">
              {{ infoBase.partialsOrders  | number_format(0, '.', ',')}}
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
