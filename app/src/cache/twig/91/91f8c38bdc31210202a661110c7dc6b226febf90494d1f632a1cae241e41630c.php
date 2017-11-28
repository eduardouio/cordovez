<?php

/* sections/validar-pedido.html.twig */
class __TwigTemplate_67a632b72a7009ba8eb04a1752f5844743257d020f6a6cf78aa7b17b9f9daab7 extends Twig_Template
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
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Valor FOB Total:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <strong class=\"text-primary\">
         ";
        // line 7
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
        echo "      
         </strong>  
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Nro Pedido:</strong> 
         <span class=\"text-primary\">
         ";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Regimen:</strong> 
         <span class=\"text-primary\">
         <strong class=\"text-primary\">
         ";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "regimen", array()), "html", null, true);
        echo "
         </strong>   
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Fecha Registro:</strong> 
         <span class=\"text-primary\">
         ";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "date_create", array()), "html", null, true);
        echo "            
         </span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Tiempo Bodega:</strong> 
      </div>
      <div class=\"col-sm-2\">
         <strong>P. Origen:</strong> 
         <span class=\"text-primary\">
         ";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "pais_origen", array()), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>C Origen:</strong> 
         <span class=\"text-primary\">
         ";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "ciudad_origen", array()), "html", null, true);
        echo "            
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Incoterm:</strong> 
         <span class=\"text-primary\">
         ";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "incoterm", array()), "html", null, true);
        echo "
         </span>         
      </div>
      <div class=\"col-sm-2\">
         <strong>Creado Por:</strong> 
         <span>";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["createBy"] ?? null), 0, array(), "array"), "nombres", array(), "array"), "html", null, true);
        echo "
         </span>
      </div>
   </div>
</div>

<div id=\"detalles\">
   <div class=\"row\">
      <div class=\"col-sm-7 div-bordered\">
               <table  class=\"table table-hover table-condensed table-striped\">
         <thead>
            <tr style=\"background-color: #333; color: #fff;\">
               <div class=\"text-tittle\">
                  RESUMEN DE ESTADO GASTOS INICIALES PEDIDO 
                  [";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "]
               </div>
            </tr>
         </thead>
         <tbody>
            <tr style=\"background-color: #fff;\">
               <th class=\"text-center\">CONCEPTO</th>
               <th class=\"text-center\">VALOR</th>
               <th class=\"text-center\">ESTADO</th>
            </tr>            
            <tr>
               <td>Facturas Producto  <strong>";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "</strong> Proveedor Internacional</td>
               ";
        // line 84
        if ((($context["invoicesOrder"] ?? null) == false)) {
            // line 85
            echo "               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"";
            // line 87
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "/\">
                  Registrar 
                  </a>
               </td>
               ";
        } else {
            // line 92
            echo "               ";
            if (($this->getAttribute($this->getAttribute(($context["minimal"] ?? null), "valuesOrder", array()), "statusInvoices", array()) == false)) {
                // line 93
                echo "               <td>Inconsistencias</td>   
               <td class=\"danger\">
                  <a href=\"";
                // line 95
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/presentar/";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
                echo "\">
                     Validar                     
                  </a>
                  </td>
               ";
            } else {
                // line 100
                echo "               <td>";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["minimal"] ?? null), "valuesOrder", array()), "totalInvoices", array()), 2, ",", "."), "html", null, true);
                echo "</td>   
               <td class=\"success\">OK</td>
               ";
            }
            // line 103
            echo "               ";
        }
        // line 104
        echo "            </tr>
            <tr>
            <td>Fecha Arribo</td>
               ";
        // line 107
        if (($this->getAttribute(($context["order"] ?? null), "fecha_arribo", array()) == null)) {
            // line 108
            echo "               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"";
            // line 110
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "\">
               Registrar
               </a>
               </td>
               ";
        } else {
            // line 115
            echo "                  <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "fecha_arribo", array()), "html", null, true);
            echo " </td>
                  <td class=\"success\">OK</td>
               ";
        }
        // line 118
        echo "                                             
            </tr>
            <tr>
               <td>Días Libres Demoraje </td>
               ";
        // line 122
        if (($this->getAttribute(($context["order"] ?? null), "dias_libres", array()) == 0)) {
            // line 123
            echo "               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"";
            // line 125
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "\">
               Registrar
               </a>
               </td>
               ";
        } else {
            // line 130
            echo "                  <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "dias_libres", array()), "html", null, true);
            echo " </td>
                  <td class=\"success\">OK</td>
               ";
        }
        // line 133
        echo "               
            </tr>
            ";
        // line 135
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["minimal"] ?? null), "initExpenses", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["expense"]) {
            // line 136
            echo "            <tr>
               <td>";
            // line 137
            echo twig_escape_filter($this->env, $this->getAttribute($context["expense"], "concepto", array()), "html", null, true);
            echo "</td>
               ";
            // line 138
            if (($this->getAttribute($context["expense"], "concepto", array()) == "GASTO ORIGEN")) {
                // line 139
                echo "                  ";
                if (($this->getAttribute($this->getAttribute(($context["minimal"] ?? null), "statusOrder", array()), "have_gasto_origen", array()) != false)) {
                    // line 140
                    echo "                     <td>
                        ";
                    // line 141
                    echo twig_escape_filter($this->env, $this->getAttribute($context["expense"], "valor_provisionado", array()), "html", null, true);
                    echo "
                     </td>
                     ";
                    // line 143
                    if (($this->getAttribute($context["expense"], "valor_provisionado", array()) > 0)) {
                        // line 144
                        echo "                        <td class=\"success\">OK</td>
                        ";
                    } else {
                        // line 146
                        echo "                        <a href=\"";
                        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                        echo "gstinicial/editar/";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["expense"], "id_gastos_nacionalizacion", array()), "html", null, true);
                        echo "\">
                     Registrar                           
                        </a>
                     ";
                    }
                    // line 150
                    echo "                  ";
                } else {
                    // line 151
                    echo "                     <td>No Requerido</td>
                     <td class=\"success\">OK</td>
                  ";
                }
                // line 154
                echo "               ";
            } else {
                // line 155
                echo "                  <td>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["expense"], "valor_provisionado", array()), "html", null, true);
                echo "</td>
                  ";
                // line 156
                if (($this->getAttribute($context["expense"], "valor_provisionado", array()) > 0)) {
                    // line 157
                    echo "                     <td class=\"success\">OK</td>
                  ";
                } else {
                    // line 159
                    echo "                     <td class=\"danger\">
                        <a href=\"";
                    // line 160
                    echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                    echo "gstinicial/editar/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["expense"], "id_gastos_nacionalizacion", array()), "html", null, true);
                    echo "\">
                     Registrar                           
                        </a>
                  </td>
                  ";
                }
                // line 165
                echo "                  
               ";
            }
            // line 167
            echo "            </tr>

            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['expense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 170
        echo "         </tbody>
      </table>
         ";
        // line 172
        $this->loadTemplate("sections/subsections/table-order-info.html.twig", "sections/validar-pedido.html.twig", 172)->display($context);
        echo "   
         <br><br><br><br><p>
         <a href=\"";
        // line 174
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-default btn-sm\">
         <span class=\"fa fa-arrow-left fa-fw\"></span>
         Volver Al Pedido [";
        // line 176
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "]
         </a>
         ";
        // line 178
        if ((($context["isOk"] ?? null) == true)) {
            // line 179
            echo "         
         ";
            // line 180
            if (($this->getAttribute(($context["order"] ?? null), "regimen", array()) == "70")) {
                // line 181
                echo "         <a href=\"";
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "facinformativa/nuevo/";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
                echo "\" class=\"btn btn-primary btn-sm pull-right\">
         <span class=\"fa fa-file fa-fw\"></span>
         Generar Factura Informativa [";
                // line 183
                echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
                echo "]
         </a>
         ";
            } else {
                // line 186
                echo "            <a href=\"";
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "nacionalizacion/nuevo/";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
                echo "\" class=\"btn btn-success btn-sm pull-right\">
         <span class=\"fa fa-file fa-fw\"></span>
         Nacionalizar Pedido [";
                // line 188
                echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
                echo "]
         </a>
         ";
            }
            // line 191
            echo "         ";
        }
        // line 192
        echo "      </p>
      </div>
      <div class=\"col-sm-5 div-bordered\">
         ";
        // line 195
        $this->loadTemplate("sections/subsections/table-rates.html.twig", "sections/validar-pedido.html.twig", 195)->display($context);
        echo "            
      </div>
   </div>  

   ";
    }

    public function getTemplateName()
    {
        return "sections/validar-pedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  389 => 195,  384 => 192,  381 => 191,  375 => 188,  367 => 186,  361 => 183,  353 => 181,  351 => 180,  348 => 179,  346 => 178,  341 => 176,  334 => 174,  329 => 172,  325 => 170,  317 => 167,  313 => 165,  303 => 160,  300 => 159,  296 => 157,  294 => 156,  289 => 155,  286 => 154,  281 => 151,  278 => 150,  268 => 146,  264 => 144,  262 => 143,  257 => 141,  254 => 140,  251 => 139,  249 => 138,  245 => 137,  242 => 136,  238 => 135,  234 => 133,  227 => 130,  217 => 125,  213 => 123,  211 => 122,  205 => 118,  198 => 115,  188 => 110,  184 => 108,  182 => 107,  177 => 104,  174 => 103,  167 => 100,  157 => 95,  153 => 93,  150 => 92,  140 => 87,  136 => 85,  134 => 84,  130 => 83,  116 => 72,  99 => 58,  91 => 53,  82 => 47,  73 => 41,  59 => 30,  48 => 22,  37 => 14,  27 => 7,  19 => 1,);
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
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Valor FOB Total:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <strong class=\"text-primary\">
         {{fob | number_format(2, '.', ',') }}      
         </strong>  
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Nro Pedido:</strong> 
         <span class=\"text-primary\">
         {{ order.nro_pedido }}
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Regimen:</strong> 
         <span class=\"text-primary\">
         <strong class=\"text-primary\">
         {{ order.regimen  }}
         </strong>   
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Fecha Registro:</strong> 
         <span class=\"text-primary\">
         {{ order.date_create }}            
         </span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Tiempo Bodega:</strong> 
      </div>
      <div class=\"col-sm-2\">
         <strong>P. Origen:</strong> 
         <span class=\"text-primary\">
         {{ order.pais_origen }}
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>C Origen:</strong> 
         <span class=\"text-primary\">
         {{ order.ciudad_origen  }}            
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Incoterm:</strong> 
         <span class=\"text-primary\">
         {{order.incoterm}}
         </span>         
      </div>
      <div class=\"col-sm-2\">
         <strong>Creado Por:</strong> 
         <span>{{createBy[0]['nombres']}}
         </span>
      </div>
   </div>
</div>

<div id=\"detalles\">
   <div class=\"row\">
      <div class=\"col-sm-7 div-bordered\">
               <table  class=\"table table-hover table-condensed table-striped\">
         <thead>
            <tr style=\"background-color: #333; color: #fff;\">
               <div class=\"text-tittle\">
                  RESUMEN DE ESTADO GASTOS INICIALES PEDIDO 
                  [{{order.nro_pedido}}]
               </div>
            </tr>
         </thead>
         <tbody>
            <tr style=\"background-color: #fff;\">
               <th class=\"text-center\">CONCEPTO</th>
               <th class=\"text-center\">VALOR</th>
               <th class=\"text-center\">ESTADO</th>
            </tr>            
            <tr>
               <td>Facturas Producto  <strong>{{order.nro_pedido}}</strong> Proveedor Internacional</td>
               {% if invoicesOrder == false %}
               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"{{rute_url}}pedidofactura/nuevo/{{order.nro_pedido}}/\">
                  Registrar 
                  </a>
               </td>
               {% else %}
               {% if minimal.valuesOrder.statusInvoices == false %}
               <td>Inconsistencias</td>   
               <td class=\"danger\">
                  <a href=\"{{rute_url}}pedido/presentar/{{order.nro_pedido}}\">
                     Validar                     
                  </a>
                  </td>
               {% else %}
               <td>{{ minimal.valuesOrder.totalInvoices | number_format(2,',','.') }}</td>   
               <td class=\"success\">OK</td>
               {% endif %}
               {% endif %}
            </tr>
            <tr>
            <td>Fecha Arribo</td>
               {% if order.fecha_arribo == NULL %}
               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"{{rute_url}}pedido/editar/{{order.nro_pedido}}\">
               Registrar
               </a>
               </td>
               {% else %}
                  <td>{{ order.fecha_arribo }} </td>
                  <td class=\"success\">OK</td>
               {% endif %}
                                             
            </tr>
            <tr>
               <td>Días Libres Demoraje </td>
               {% if order.dias_libres == 0 %}
               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"{{rute_url}}pedido/editar/{{order.nro_pedido}}\">
               Registrar
               </a>
               </td>
               {% else %}
                  <td>{{ order.dias_libres }} </td>
                  <td class=\"success\">OK</td>
               {% endif %}
               
            </tr>
            {% for expense in minimal.initExpenses %}
            <tr>
               <td>{{expense.concepto }}</td>
               {% if expense.concepto == 'GASTO ORIGEN' %}
                  {% if minimal.statusOrder.have_gasto_origen != false %}
                     <td>
                        {{expense.valor_provisionado}}
                     </td>
                     {% if expense.valor_provisionado > 0 %}
                        <td class=\"success\">OK</td>
                        {% else %}
                        <a href=\"{{rute_url}}gstinicial/editar/{{expense.id_gastos_nacionalizacion}}\">
                     Registrar                           
                        </a>
                     {% endif %}
                  {% else %}
                     <td>No Requerido</td>
                     <td class=\"success\">OK</td>
                  {% endif %}
               {% else %}
                  <td>{{expense.valor_provisionado}}</td>
                  {% if expense.valor_provisionado > 0 %}
                     <td class=\"success\">OK</td>
                  {% else %}
                     <td class=\"danger\">
                        <a href=\"{{rute_url}}gstinicial/editar/{{expense.id_gastos_nacionalizacion}}\">
                     Registrar                           
                        </a>
                  </td>
                  {% endif %}
                  
               {% endif %}
            </tr>

            {% endfor %}
         </tbody>
      </table>
         {% include 'sections/subsections/table-order-info.html.twig' %}   
         <br><br><br><br><p>
         <a href=\"{{rute_url}}pedido/presentar/{{order.nro_pedido}}\" class=\"btn btn-default btn-sm\">
         <span class=\"fa fa-arrow-left fa-fw\"></span>
         Volver Al Pedido [{{order.nro_pedido}}]
         </a>
         {% if isOk == true %}
         
         {% if order.regimen == '70' %}
         <a href=\"{{rute_url}}facinformativa/nuevo/{{order.nro_pedido}}\" class=\"btn btn-primary btn-sm pull-right\">
         <span class=\"fa fa-file fa-fw\"></span>
         Generar Factura Informativa [{{order.nro_pedido}}]
         </a>
         {% else %}
            <a href=\"{{rute_url}}nacionalizacion/nuevo/{{order.nro_pedido}}\" class=\"btn btn-success btn-sm pull-right\">
         <span class=\"fa fa-file fa-fw\"></span>
         Nacionalizar Pedido [{{order.nro_pedido}}]
         </a>
         {% endif %}
         {% endif %}
      </p>
      </div>
      <div class=\"col-sm-5 div-bordered\">
         {% include 'sections/subsections/table-rates.html.twig' %}            
      </div>
   </div>  

   ", "sections/validar-pedido.html.twig", "/var/www/html/app/src/views/sections/validar-pedido.html.twig");
    }
}
