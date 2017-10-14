<?php

/* base/sections/show-pedido-factura.html.twig */
class __TwigTemplate_510ebf3f4cb3e68bfcf7a66fbe2e5029ba389a452d092ab9b73db3fd394d760f extends Twig_Template
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
        echo "<h4 class=\"text-info\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["supplier"] ?? null), 0, array(), "array"), "nombre", array()), "html", null, true);
        echo "</h4>
<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Pedido:</strong> <span class=\"text-success\">  ";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo " </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Nro Factura:</strong> <span class=\"text-danger\">";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "id_factura_proveedor", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Fecha Emisión:</strong> <span class=\"text-info\">";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Vencimiento:</strong> <span>";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "vencimiento_pago", array()), "html", null, true);
        echo "</span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Moneda:</strong> <span>";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "moneda", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Tipo Cambio:</strong> <span>";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "tipo_cambio", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Valor:</strong> <span class=\"text-danger\">";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "valor", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "nombres", array(), "array"), "html", null, true);
        echo "</span>
      </div>
   </div>
</div>

<!--tabPedido-->
<div class=\"pedido\">
  <div class=\"row\">
    <div class=\"col-sm-2\">
      <a href=\"";
        // line 37
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "detallepedido/nuevo/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "id_pedido_factura", array()), "html", null, true);
        echo "\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Agregar Producto
        </button>
      </a>
    </div>
    <div class=\"col-sm-2\">
      <a href=\"";
        // line 45
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-default btn-sm\">
        <span class=\"fa fa-arrow-left\"></span>
        Volver al Pedido <b>(";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo ")</b>
      </a>
    </div>
    <div class=\"col-sm-3\">
      &nbsp;
    </div>
    ";
        // line 53
        $context["suma"] = 0;
        // line 54
        echo "    ";
        $context["unidades"] = 0;
        // line 55
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoiceDetail"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["detail"]) {
            echo " 
    ";
            // line 56
            $context["suma"] = (($context["suma"] ?? null) + $this->getAttribute($context["detail"], "costo_total", array()));
            // line 57
            echo "    ";
            $context["unidades"] = (($context["unidades"] ?? null) + $this->getAttribute($context["detail"], "unidades", array()));
            // line 58
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        echo "    <div class=\"col-sm-2\">
      <h4 class=\"text-primary\"> <small>Unidades: </small> <span id=\"suma\"> ";
        // line 60
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["unidades"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h4>
    </div>
    <div class=\"col-sm-3\">
      <h4 class=\"text-primary\"> <small>Suma: </small> <span id=\"suma\">\$ ";
        // line 63
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["suma"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h4>
    </div>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"table-responsive\">
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Nombre</th>
            <th>Nro Cajas</th>
            <th>Grado A</th>
            <th>Unidades</th>
            <th>C Unidad</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          ";
        // line 83
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
            // line 84
            echo "          <tr>
            <td>";
            // line 85
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
            <td> <a href=\"";
            // line 86
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "producto/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "cod_contable", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "nombre", array()), "html", null, true);
            echo "</a></td>
            <td class=\"text-right\">";
            // line 87
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "nro_cajas", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 88
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "grado_alcoholico", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 89
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "unidades", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">\$ ";
            // line 90
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "costo_und", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">\$ ";
            // line 91
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
            // line 99
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallepedido/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "detalle_pedido_factura", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Producto</a> 
                  </li>
                  <li> <a href=\"";
            // line 103
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
        // line 112
        echo "        </tbody>
      </table>
    </div>
  </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "base/sections/show-pedido-factura.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  260 => 112,  235 => 103,  226 => 99,  215 => 91,  211 => 90,  207 => 89,  203 => 88,  199 => 87,  191 => 86,  187 => 85,  184 => 84,  167 => 83,  144 => 63,  138 => 60,  135 => 59,  129 => 58,  126 => 57,  124 => 56,  117 => 55,  114 => 54,  112 => 53,  103 => 47,  96 => 45,  83 => 37,  71 => 28,  65 => 25,  59 => 22,  53 => 19,  45 => 14,  39 => 11,  33 => 8,  27 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<h4 class=\"text-info\">{{ supplier[0].nombre }}</h4>
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
         <strong>Valor:</strong> <span class=\"text-danger\">{{invoice[0].valor}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>{{user['nombres']}}</span>
      </div>
   </div>
</div>

<!--tabPedido-->
<div class=\"pedido\">
  <div class=\"row\">
    <div class=\"col-sm-2\">
      <a href=\"{{ rute_url }}detallepedido/nuevo/{{invoice[0].id_pedido_factura}}\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Agregar Producto
        </button>
      </a>
    </div>
    <div class=\"col-sm-2\">
      <a href=\"{{ rute_url }}pedido/presentar/{{invoice[0].nro_pedido}}\" class=\"btn btn-default btn-sm\">
        <span class=\"fa fa-arrow-left\"></span>
        Volver al Pedido <b>({{invoice[0].nro_pedido}})</b>
      </a>
    </div>
    <div class=\"col-sm-3\">
      &nbsp;
    </div>
    {% set suma = 0 %}
    {% set unidades = 0 %}
    {% for detail in invoiceDetail %} 
    {% set suma = suma + detail.costo_total %}
    {% set unidades = unidades + detail.unidades %}
    {% endfor %}
    <div class=\"col-sm-2\">
      <h4 class=\"text-primary\"> <small>Unidades: </small> <span id=\"suma\"> {{ unidades | number_format(0, '.', ',') }} </span></h4>
    </div>
    <div class=\"col-sm-3\">
      <h4 class=\"text-primary\"> <small>Suma: </small> <span id=\"suma\">\$ {{ suma | number_format(2, '.', ',')}}</span></h4>
    </div>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"table-responsive\">
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Nombre</th>
            <th>Nro Cajas</th>
            <th>Grado A</th>
            <th>Unidades</th>
            <th>C Unidad</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {% for detail in invoiceDetail %}
          <tr>
            <td>{{ loop.index }}</td>
            <td> <a href=\"{{ rute_url }}producto/presentar/{{ detail.cod_contable }}\">{{ detail.nombre }}</a></td>
            <td class=\"text-right\">{{ detail.nro_cajas }}</td>
            <td class=\"text-right\">{{ detail.grado_alcoholico }}</td>
            <td class=\"text-right\">{{ detail.unidades }}</td>
            <td class=\"text-right\">\$ {{ detail.costo_und | number_format(2, '.', ',') }}</td>
            <td class=\"text-right\">\$ {{ detail.costo_total | number_format(2, '.', ',') }}</td>
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
</div>
<!--tabPedido-->", "base/sections/show-pedido-factura.html.twig", "/var/www/html/app/src/views/base/sections/show-pedido-factura.html.twig");
    }
}
