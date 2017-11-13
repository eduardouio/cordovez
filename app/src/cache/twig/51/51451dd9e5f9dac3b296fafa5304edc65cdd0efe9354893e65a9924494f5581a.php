<?php

/* base/sections/show-pedido-factura.html.twig */
class __TwigTemplate_e7b962443ecc67af6539663bc9e881d7c6ca1a9fd157dd37a0a051808a4ca036 extends Twig_Template
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
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "nombres", array(), "array"), "html", null, true);
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
    <div class=\"table-responsive\">
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
        // line 116
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
            // line 117
            echo "          <tr>
            <td>";
            // line 118
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
            <td> <a href=\"";
            // line 119
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "producto/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "cod_contable", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "nombre", array()), "html", null, true);
            echo "</a></td>
            <td class=\"text-right\">";
            // line 120
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "grado_alcoholico", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 121
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "nro_cajas", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 122
            echo ($context["simbolo"] ?? null);
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "costo_caja", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 123
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "cantidad_x_caja", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 124
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "unidades", array()), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 125
            echo ($context["simbolo"] ?? null);
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["detail"], "costo_und", array()), 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 126
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
            // line 134
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallepedido/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "detalle_pedido_factura", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Producto</a> 
                  </li>
                  <li> <a href=\"";
            // line 138
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
        // line 147
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
        return array (  342 => 147,  317 => 138,  308 => 134,  295 => 126,  289 => 125,  285 => 124,  281 => 123,  275 => 122,  271 => 121,  267 => 120,  259 => 119,  255 => 118,  252 => 117,  235 => 116,  208 => 94,  200 => 91,  194 => 88,  183 => 80,  176 => 78,  171 => 75,  158 => 68,  154 => 66,  152 => 65,  148 => 63,  146 => 62,  134 => 53,  127 => 49,  123 => 48,  116 => 44,  110 => 41,  102 => 36,  96 => 33,  90 => 30,  84 => 27,  78 => 23,  69 => 16,  67 => 15,  63 => 14,  60 => 13,  57 => 12,  51 => 11,  48 => 10,  46 => 9,  39 => 8,  36 => 7,  34 => 6,  31 => 5,  28 => 4,  25 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base/sections/show-pedido-factura.html.twig", "/var/www/html/app/src/views/base/sections/show-pedido-factura.html.twig");
    }
}
