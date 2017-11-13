<?php

/* sections/mostrar-pedido-factura.html.twig */
class __TwigTemplate_c489b04b2e26eceeb1bcee6c914c2ce3b99f1120a92b4a8bab7a7651bca0d2cd extends Twig_Template
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
        echo "
    ";
        // line 2
        $context["simbolo"] = "\$";
        // line 3
        echo "    ";
        if (($this->getAttribute(($context["invoice"] ?? null), "moneda", array()) == "EUROS")) {
            // line 4
            echo "    ";
            $context["simbolo"] = "&euro;";
            // line 5
            echo "    ";
        }
        // line 6
        echo "
    ";
        // line 7
        $context["suma"] = 0;
        // line 8
        echo "    ";
        $context["unidades"] = 0;
        // line 9
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoiceDetail"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["detail"]) {
            echo " 
    ";
            // line 10
            $context["unidades"] = (($context["unidades"] ?? null) + $this->getAttribute($context["detail"], "nro_cajas", array()));
            // line 11
            echo "    ";
            $context["suma"] = (($context["suma"] ?? null) + $this->getAttribute($context["detail"], "total_item", array()));
            // line 12
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "    ";
        $context["diferencia"] = ($this->getAttribute(($context["invoice"] ?? null), "valor", array()) - ($context["suma"] ?? null));
        // line 14
        echo "
<h4 class=\"text-info\">";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["supplier"] ?? null), 0, array(), "array"), "nombre", array()), "html", null, true);
        echo "
  ";
        // line 16
        if ((($context["diferencia"] ?? null) != 0)) {
            // line 17
            echo "    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <small class=\"text-danger\"> <span class=\"fa fa-warning\"></span> Completar El Detalle De La Factura</small>
  ";
        }
        // line 24
        echo "</h4>
<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Pedido:</strong> <span class=\"text-success\">  ";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "nro_pedido", array()), "html", null, true);
        echo " </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Nro Factura:</strong> <span class=\"text-danger\">";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "id_factura_proveedor", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Fecha Emisión:</strong> <span class=\"text-info\">";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Vencimiento:</strong> <span>";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "vencimiento_pago", array()), "html", null, true);
        echo "</span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Moneda:</strong> <span>";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "moneda", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Tipo Cambio:</strong> <span>";
        // line 45
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "tipo_cambio", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Valor:</strong> <span class=\"text-danger\">
          ";
        // line 49
        echo ($context["simbolo"] ?? null);
        echo "
         ";
        // line 50
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "valor", array()), 2, ",", "."), "html", null, true);
        echo "
       </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "nombres", array()), "html", null, true);
        echo "</span>
      </div>
   </div>
</div>

<!--tabPedido-->
<div class=\"pedido\">
  <div class=\"row\">
<div class=\"col-sm-2\">
";
        // line 63
        if ((($context["diferencia"] ?? null) == 0)) {
            // line 64
            echo "    <h4 class=\"text-success\"><span class=\"fa fa-check\"></span>Factura Completa!</h4>

";
        } elseif ((        // line 66
($context["diferencia"] ?? null) < 0)) {
            // line 67
            echo "    <h4 class=\"text-danger\" ><span class=\"fa fa-warning\"></span> Factura Inválida, VALORES EXCEDIDOS</h4>  
";
        } else {
            // line 69
            echo "      <a href=\"";
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallepedido/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "id_pedido_factura", array()), "html", null, true);
            echo "\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Agregar Producto
        </button>
      </a>
";
        }
        // line 76
        echo "    </div>
  
    <div class=\"col-sm-4\">
      &nbsp;
    </div>

    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Nro Cajas: </small> <span id=\"suma\"> ";
        // line 83
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["unidades"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Valor Reg: </small> <span id=\"suma\"> ";
        // line 86
        echo ($context["simbolo"] ?? null);
        echo " ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["suma"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Diferencia: </small> <span id=\"suma\"> ";
        // line 89
        echo ($context["simbolo"] ?? null);
        echo " ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["diferencia"] ?? null), 2, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"col-sm-12\">
      <table class=\"table table-hover table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Nombre</th>
            <th>Grado A</th>
            <th>Nro Cajas</th>
            <th>Costo Caja</th>
            <th>Cant X Caja</th>
            <th>Unidades</th>
            <th>Costo Und</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          ";
        // line 111
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoiceDetail"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["detail"]) {
            // line 112
            echo "          <tr>
            <td>";
            // line 113
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
            <td> <a href=\"";
            // line 114
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "producto/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "cod_contable", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "nombre", array()), "html", null, true);
            echo "</a></td>
            <td class=\"text-right\">";
            // line 115
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "grado_alcoholico", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 116
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "nro_cajas", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 117
            echo ($context["simbolo"] ?? null);
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "costo_caja", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 118
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "cantidad_x_caja", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 119
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "unidades", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 120
            echo ($context["simbolo"] ?? null);
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "costo_unidad", array()), 3, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 121
            echo ($context["simbolo"] ?? null);
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "total_item", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td>
              <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"";
            // line 129
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallepedido/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "detalle_pedido_factura", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Producto</a> 
                  </li>
                  <li> <a href=\"";
            // line 133
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallepedido/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "detalle_pedido_factura", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Producto</a> 
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 142
        echo "        </tbody>
      </table>
  </div>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"col-sm-9\">
      <a href=\"";
        // line 149
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-default btn-sm\">
        <span class=\"fa fa-arrow-left\"></span>
        Volver al Pedido <b>[";
        // line 151
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "]</b>
      </a>
    </div>
    <div class=\"col-ms-3\">
      <a href=\"";
        // line 155
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedidofactura/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "id_pedido_factura", array()), "html", null, true);
        echo "\" class=\"btn btn-primary btn-sm\">
        <span class=\"fa fa-file-text-o fa-fw\"></span>
        Editar Cabecera Factura <b>[";
        // line 157
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "id_factura_proveedor", array()), "html", null, true);
        echo "]</b>
      </a>
    </div>
  </div>
 ";
    }

    public function getTemplateName()
    {
        return "sections/mostrar-pedido-factura.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  360 => 157,  353 => 155,  346 => 151,  339 => 149,  330 => 142,  305 => 133,  296 => 129,  283 => 121,  277 => 120,  273 => 119,  269 => 118,  263 => 117,  259 => 116,  255 => 115,  247 => 114,  243 => 113,  240 => 112,  223 => 111,  196 => 89,  188 => 86,  182 => 83,  173 => 76,  160 => 69,  156 => 67,  154 => 66,  150 => 64,  148 => 63,  136 => 54,  129 => 50,  125 => 49,  118 => 45,  112 => 42,  104 => 37,  98 => 34,  92 => 31,  86 => 28,  80 => 24,  71 => 17,  69 => 16,  65 => 15,  62 => 14,  59 => 13,  53 => 12,  50 => 11,  48 => 10,  41 => 9,  38 => 8,  36 => 7,  33 => 6,  30 => 5,  27 => 4,  24 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("
    {% set simbolo = '\$' %}
    {% if invoice.moneda == 'EUROS' %}
    {% set simbolo = '&euro;' %}
    {% endif %}

    {% set suma = 0 %}
    {% set unidades = 0 %}
    {% for detail in invoiceDetail %} 
    {% set unidades = unidades + detail.nro_cajas %}
    {% set suma = suma +  detail.total_item %}
    {% endfor %}
    {% set diferencia =  invoice.valor - suma %}

<h4 class=\"text-info\">{{ supplier[0].nombre }}
  {% if diferencia != 0 %}
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <small class=\"text-danger\"> <span class=\"fa fa-warning\"></span> Completar El Detalle De La Factura</small>
  {% endif %}
</h4>
<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Pedido:</strong> <span class=\"text-success\">  {{invoice.nro_pedido}} </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Nro Factura:</strong> <span class=\"text-danger\">{{invoice.id_factura_proveedor}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Fecha Emisión:</strong> <span class=\"text-info\">{{invoice.nro_pedido }}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Vencimiento:</strong> <span>{{invoice.vencimiento_pago}}</span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Moneda:</strong> <span>{{invoice.moneda}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Tipo Cambio:</strong> <span>{{invoice.tipo_cambio}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Valor:</strong> <span class=\"text-danger\">
          {{ simbolo | raw}}
         {{invoice.valor | number_format(2,',','.')}}
       </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>{{user.nombres}}</span>
      </div>
   </div>
</div>

<!--tabPedido-->
<div class=\"pedido\">
  <div class=\"row\">
<div class=\"col-sm-2\">
{% if diferencia == 0 %}
    <h4 class=\"text-success\"><span class=\"fa fa-check\"></span>Factura Completa!</h4>

{% elseif diferencia < 0 %}
    <h4 class=\"text-danger\" ><span class=\"fa fa-warning\"></span> Factura Inválida, VALORES EXCEDIDOS</h4>  
{% else %}
      <a href=\"{{ rute_url }}detallepedido/nuevo/{{invoice.id_pedido_factura}}\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Agregar Producto
        </button>
      </a>
{% endif %}
    </div>
  
    <div class=\"col-sm-4\">
      &nbsp;
    </div>

    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Nro Cajas: </small> <span id=\"suma\"> {{ unidades | number_format(0, '.', ',') }} </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Valor Reg: </small> <span id=\"suma\"> {{ simbolo | raw}} {{ suma | number_format(2, '.', ',')}}</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Diferencia: </small> <span id=\"suma\"> {{ simbolo | raw}} {{ diferencia | number_format(2, '.', ',') }} </span></h5>
    </div>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"col-sm-12\">
      <table class=\"table table-hover table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Nombre</th>
            <th>Grado A</th>
            <th>Nro Cajas</th>
            <th>Costo Caja</th>
            <th>Cant X Caja</th>
            <th>Unidades</th>
            <th>Costo Und</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {% for detail in invoiceDetail %}
          <tr>
            <td>{{ loop.index }}</td>
            <td> <a href=\"{{ rute_url }}producto/presentar/{{ detail.cod_contable }}\">{{ detail.nombre }}</a></td>
            <td class=\"text-right\">{{ detail.grado_alcoholico }}</td>
            <td class=\"text-right\">{{ detail.nro_cajas }}</td>
            <td class=\"text-right\">{{ simbolo | raw}} {{ detail.costo_caja | number_format(2, '.', ',')}}</td>
            <td class=\"text-right\">{{ detail.cantidad_x_caja | number_format(2, '.', ',')}}</td>
            <td class=\"text-right\">{{ detail.unidades }}</td>
            <td class=\"text-right\">{{ simbolo | raw}} {{ detail.costo_unidad | number_format(3, '.', ',') }}</td>
            <td class=\"text-right\">{{ simbolo | raw}} {{ detail.total_item | number_format(2, '.', ',') }}</td>
            <td>
              <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"{{rute_url}}detallepedido/editar/{{detail.detalle_pedido_factura}}\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Producto</a> 
                  </li>
                  <li> <a href=\"{{rute_url}}detallepedido/eliminar/{{detail.detalle_pedido_factura}}\">
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Producto</a> 
                  </li>
                </ul>
              </div>
            </td>
          </tr>
          {% endfor %}
        </tbody>
      </table>
  </div>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"col-sm-9\">
      <a href=\"{{ rute_url }}pedido/presentar/{{invoice.nro_pedido}}\" class=\"btn btn-default btn-sm\">
        <span class=\"fa fa-arrow-left\"></span>
        Volver al Pedido <b>[{{invoice.nro_pedido}}]</b>
      </a>
    </div>
    <div class=\"col-ms-3\">
      <a href=\"{{ rute_url }}pedidofactura/editar/{{invoice.id_pedido_factura}}\" class=\"btn btn-primary btn-sm\">
        <span class=\"fa fa-file-text-o fa-fw\"></span>
        Editar Cabecera Factura <b>[{{invoice.id_factura_proveedor}}]</b>
      </a>
    </div>
  </div>
 ", "sections/mostrar-pedido-factura.html.twig", "/var/www/html/app/src/views/sections/mostrar-pedido-factura.html.twig");
    }
}
