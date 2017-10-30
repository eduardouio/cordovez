<?php

/* sections/show-pedido-factura.html.twig */
class __TwigTemplate_7bcebc7150d8312ddcb187c8c2d141aa79a6a91fa1188d8c7091edefae11510d extends Twig_Template
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
        echo "    ";
        $context["simbolo"] = "\$";
        // line 2
        echo "    ";
        if (($this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "moneda", array()) == "EUROS")) {
            // line 3
            echo "    ";
            $context["simbolo"] = "&euro;";
            // line 4
            echo "    ";
        }
        // line 5
        echo "
    ";
        // line 6
        $context["suma"] = 0;
        // line 7
        echo "    ";
        $context["unidades"] = 0;
        // line 8
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoiceDetail"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["detail"]) {
            echo " 
    ";
            // line 9
            $context["suma"] = (($context["suma"] ?? null) + $this->getAttribute($context["detail"], "costo_total", array()));
            // line 10
            echo "    ";
            $context["unidades"] = (($context["unidades"] ?? null) + $this->getAttribute($context["detail"], "unidades", array()));
            // line 11
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "    ";
        $context["diferencia"] = ($this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "valor", array()) - ($context["suma"] ?? null));
        // line 13
        echo "
<h4 class=\"text-info\">";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["supplier"] ?? null), 0, array(), "array"), "nombre", array()), "html", null, true);
        echo "
  ";
        // line 15
        if ((($context["diferencia"] ?? null) != 0)) {
            // line 16
            echo "    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <small class=\"text-danger\"> <span class=\"fa fa-warning\"></span> Completar El Detalle De La Factura</small>
  ";
        }
        // line 23
        echo "</h4>
<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Pedido:</strong> <span class=\"text-success\">  ";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo " </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Nro Factura:</strong> <span class=\"text-danger\">";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "id_factura_proveedor", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Fecha Emisión:</strong> <span class=\"text-info\">";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Vencimiento:</strong> <span>";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "vencimiento_pago", array()), "html", null, true);
        echo "</span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Moneda:</strong> <span>";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "moneda", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Tipo Cambio:</strong> <span>";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "tipo_cambio", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Valor:</strong> <span class=\"text-danger\">
          ";
        // line 48
        echo ($context["simbolo"] ?? null);
        echo "
         ";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "valor", array()), "html", null, true);
        echo "
       </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>";
        // line 53
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
        // line 62
        if ((($context["diferencia"] ?? null) == 0)) {
            // line 63
            echo "    <h4 class=\"text-success\"><span class=\"fa fa-check\"></span>Factura Completa!</h4>

";
        } elseif ((        // line 65
($context["diferencia"] ?? null) < 0)) {
            // line 66
            echo "    <h4 class=\"text-danger\" ><span class=\"fa fa-warning\"></span> Factura Inválida, VALORES EXCEDIDOS</h4>  
";
        } else {
            // line 68
            echo "      <a href=\"";
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallepedido/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "id_pedido_factura", array()), "html", null, true);
            echo "\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Agregar Producto
        </button>
      </a>
";
        }
        // line 75
        echo "    </div>
  
    <div class=\"col-sm-2\">
      <a href=\"";
        // line 78
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-default btn-sm\">
        <span class=\"fa fa-arrow-left\"></span>
        Volver al Pedido <b>(";
        // line 80
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo ")</b>
      </a>
    </div>
    <div class=\"col-sm-2\">
      &nbsp;
    </div>

    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Unidades: </small> <span id=\"suma\"> ";
        // line 88
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["unidades"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Suma: </small> <span id=\"suma\"> ";
        // line 91
        echo ($context["simbolo"] ?? null);
        echo " ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["suma"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Diferencia: </small> <span id=\"suma\"> ";
        // line 94
        echo ($context["simbolo"] ?? null);
        echo " ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["diferencia"] ?? null), 2, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
  </div>
  <br>
  <div class=\"row\">
      <table class=\"table table-hover table-bordered table-striped\">
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
        // line 115
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
            // line 116
            echo "          <tr>
            <td>";
            // line 117
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
            <td> <a href=\"";
            // line 118
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "producto/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "cod_contable", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "nombre", array()), "html", null, true);
            echo "</a></td>
            <td class=\"text-right\">";
            // line 119
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "grado_alcoholico", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 120
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "nro_cajas", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 121
            echo ($context["simbolo"] ?? null);
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "costo_caja", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 122
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "cantidad_x_caja", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 123
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "unidades", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 124
            echo ($context["simbolo"] ?? null);
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "costo_und", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 125
            echo ($context["simbolo"] ?? null);
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "costo_total", array()), 2, ".", ","), "html", null, true);
            echo "</td>
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
            echo "detallepedido/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "detalle_pedido_factura", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Producto</a> 
                  </li>
                  <li> <a href=\"";
            // line 137
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
        // line 146
        echo "        </tbody>
      </table>
  </div>
 ";
    }

    public function getTemplateName()
    {
        return "sections/show-pedido-factura.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  341 => 146,  316 => 137,  307 => 133,  294 => 125,  288 => 124,  284 => 123,  280 => 122,  274 => 121,  270 => 120,  266 => 119,  258 => 118,  254 => 117,  251 => 116,  234 => 115,  208 => 94,  200 => 91,  194 => 88,  183 => 80,  176 => 78,  171 => 75,  158 => 68,  154 => 66,  152 => 65,  148 => 63,  146 => 62,  134 => 53,  127 => 49,  123 => 48,  116 => 44,  110 => 41,  102 => 36,  96 => 33,  90 => 30,  84 => 27,  78 => 23,  69 => 16,  67 => 15,  63 => 14,  60 => 13,  57 => 12,  51 => 11,  48 => 10,  46 => 9,  39 => 8,  36 => 7,  34 => 6,  31 => 5,  28 => 4,  25 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("    {% set simbolo = '\$' %}
    {% if invoice[0].moneda == 'EUROS' %}
    {% set simbolo = '&euro;' %}
    {% endif %}

    {% set suma = 0 %}
    {% set unidades = 0 %}
    {% for detail in invoiceDetail %} 
    {% set suma = suma + detail.costo_total %}
    {% set unidades = unidades + detail.unidades %}
    {% endfor %}
    {% set diferencia =  invoice[0].valor - suma %}

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
         <strong>Pedido:</strong> <span class=\"text-success\">  {{invoice[0].nro_pedido}} </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Nro Factura:</strong> <span class=\"text-danger\">{{invoice[0].id_factura_proveedor}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Fecha Emisión:</strong> <span class=\"text-info\">{{invoice[0].nro_pedido }}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Vencimiento:</strong> <span>{{invoice[0].vencimiento_pago}}</span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Moneda:</strong> <span>{{invoice[0].moneda}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Tipo Cambio:</strong> <span>{{invoice[0].tipo_cambio}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Valor:</strong> <span class=\"text-danger\">
          {{ simbolo | raw}}
         {{invoice[0].valor}}
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
      <a href=\"{{ rute_url }}detallepedido/nuevo/{{invoice[0].id_pedido_factura}}\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Agregar Producto
        </button>
      </a>
{% endif %}
    </div>
  
    <div class=\"col-sm-2\">
      <a href=\"{{ rute_url }}pedido/presentar/{{invoice[0].nro_pedido}}\" class=\"btn btn-default btn-sm\">
        <span class=\"fa fa-arrow-left\"></span>
        Volver al Pedido <b>({{invoice[0].nro_pedido}})</b>
      </a>
    </div>
    <div class=\"col-sm-2\">
      &nbsp;
    </div>

    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Unidades: </small> <span id=\"suma\"> {{ unidades | number_format(0, '.', ',') }} </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Suma: </small> <span id=\"suma\"> {{ simbolo | raw}} {{ suma | number_format(2, '.', ',')}}</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Diferencia: </small> <span id=\"suma\"> {{ simbolo | raw}} {{ diferencia | number_format(2, '.', ',') }} </span></h5>
    </div>
  </div>
  <br>
  <div class=\"row\">
      <table class=\"table table-hover table-bordered table-striped\">
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
            <td class=\"text-right\">{{ simbolo | raw}} {{ detail.costo_und | number_format(2, '.', ',') }}</td>
            <td class=\"text-right\">{{ simbolo | raw}} {{ detail.costo_total | number_format(2, '.', ',') }}</td>
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
 ", "sections/show-pedido-factura.html.twig", "/var/www/html/app/src/views/sections/show-pedido-factura.html.twig");
    }
}
