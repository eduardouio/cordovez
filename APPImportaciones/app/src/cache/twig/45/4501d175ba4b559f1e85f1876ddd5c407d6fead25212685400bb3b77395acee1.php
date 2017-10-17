<?php

/* base/sections/mostrar-producto.html.twig */
class __TwigTemplate_b9d741fab152e6650f62af1c934e27fe5f8f03a6454c5ad940859d430904e474 extends Twig_Template
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
<div class=\"producto\">
  <br>
  <div class=\"row\">
    <div class=\"table-responsive\">
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>Nombre</th>
            <th>Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class=\"text-right\"> <b>ID:</b></td>
            <td>";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "id_producto", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"><b>Código Contable:</b></td>
            <td>";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "cod_contable", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Código ICE:</b></td>
            <td> ";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "cod_ice", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>           
            <td class=\"text-right\"><b>Nombre:</b></td>
            <td>";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "nombre", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Proveedor:</b></td>
            <td>";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "nombre", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Capacidad ML:</b></td>
            <td> ";
        // line 36
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["product"] ?? null), "capacidad", array()), 2, ".", ","), "html", null, true);
        echo " ml</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Grado Alcohólico:</b></td>
            <td> ";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "grado_alcoholico", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Cantidad por Caja:</b></td>
            <td> ";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "cantidad_x_caja", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Costo Unidad:</b></td>
            <td> ";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "costo_unidad", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Estado:</b></td>
            ";
        // line 52
        if (($this->getAttribute(($context["product"] ?? null), "estado", array()) == 1)) {
            // line 53
            echo "              <td> <span class=\"label label-success\">Activo</span> </td>
              ";
        } else {
            // line 55
            echo "                <td> <span class=\"label label-success\">No se Importa</span> </td>
            ";
        }
        // line 57
        echo "            <td> ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "estado", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Custodia Doble:</b></td>
            ";
        // line 61
        if (($this->getAttribute(($context["product"] ?? null), "custodia_doble", array()) == 1)) {
            // line 62
            echo "              <td> <span class=\"label label-warning\">Si Tiene</span> </td>
              ";
        } else {
            // line 64
            echo "                <td> <span class=\"label label-success\">No Tiene</span> </td>
            ";
        }
        // line 66
        echo "            
            
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Comentarios:</b></td>
            <td> ";
        // line 71
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "comentarios", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado El:</b></td>
            <td> ";
        // line 75
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "date_create", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Ultima Actualización:</b></td>
            <td> ";
        // line 79
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "last_update", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado Por:</b></td>
            <td> ";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute(($context["createBy"] ?? null), "nombres", array()), "html", null, true);
        echo " </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "base/sections/mostrar-producto.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  155 => 83,  148 => 79,  141 => 75,  134 => 71,  127 => 66,  123 => 64,  119 => 62,  117 => 61,  109 => 57,  105 => 55,  101 => 53,  99 => 52,  92 => 48,  85 => 44,  78 => 40,  71 => 36,  64 => 32,  57 => 28,  50 => 24,  43 => 20,  36 => 16,  19 => 1,);
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
<div class=\"producto\">
  <br>
  <div class=\"row\">
    <div class=\"table-responsive\">
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>Nombre</th>
            <th>Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class=\"text-right\"> <b>ID:</b></td>
            <td>{{ product.id_producto }}</td>
          </tr>
          <tr>
            <td class=\"text-right\"><b>Código Contable:</b></td>
            <td>{{ product.cod_contable }}</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Código ICE:</b></td>
            <td> {{product.cod_ice}} </td>
          </tr>
          <tr>           
            <td class=\"text-right\"><b>Nombre:</b></td>
            <td>{{product.nombre}}</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Proveedor:</b></td>
            <td>{{ supplier.nombre }}</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Capacidad ML:</b></td>
            <td> {{ product.capacidad | number_format(2, '.', ',') }} ml</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Grado Alcohólico:</b></td>
            <td> {{ product.grado_alcoholico }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Cantidad por Caja:</b></td>
            <td> {{ product.cantidad_x_caja }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Costo Unidad:</b></td>
            <td> {{ product.costo_unidad}} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Estado:</b></td>
            {% if product.estado == 1 %}
              <td> <span class=\"label label-success\">Activo</span> </td>
              {% else %}
                <td> <span class=\"label label-success\">No se Importa</span> </td>
            {% endif %}
            <td> {{ product.estado}} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Custodia Doble:</b></td>
            {% if product.custodia_doble == 1 %}
              <td> <span class=\"label label-warning\">Si Tiene</span> </td>
              {% else %}
                <td> <span class=\"label label-success\">No Tiene</span> </td>
            {% endif %}
            
            
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Comentarios:</b></td>
            <td> {{ product.comentarios}} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado El:</b></td>
            <td> {{ product.date_create }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Ultima Actualización:</b></td>
            <td> {{ product.last_update }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado Por:</b></td>
            <td> {{ createBy.nombres }} </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!--tabPedido-->", "base/sections/mostrar-producto.html.twig", "/var/www/html/app/src/views/base/sections/mostrar-producto.html.twig");
    }
}
