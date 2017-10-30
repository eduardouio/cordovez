<?php

/* sections/mostrar-gasto-inicial.html.twig */
class __TwigTemplate_1212ae9ee47a3c277b23beb86469701a90c50f16d36ffa9485198bce59286dd5 extends Twig_Template
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
<div class=\"proveedor\">
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
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "id_gastos_nacionalizacion", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"><b>ID Proveedor:</b></td>
            <td>";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "identificacion_proveedor", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>           
            <td class=\"text-right\"><b>Nombre Proveedor:</b></td>
            <td>";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "nombre", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Tipo Proveedor:</b></td>
            <td> ";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "tipo_provedor", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Fecha:</b></td>
            <td>";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "fecha", array()), "html", null, true);
        echo "</td>
          </tr>
          ";
        // line 34
        if (($this->getAttribute(($context["initExpense"] ?? null), "concepto", array()) == "ALMACENAJE  INICIAL")) {
            // line 35
            echo "          <tr>
            <td class=\"text-right\"> <b>Fecha Fin:</b></td>
            <td>";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "fecha_fin", array()), "html", null, true);
            echo "</td>
          </tr>
          ";
        }
        // line 40
        echo "          
          <tr>
            <td class=\"text-right\"> <b>Concepto:</b></td>
            <td> ";
        // line 43
        echo $this->getAttribute(($context["initExpense"] ?? null), "concepto", array());
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Valor Provisionado:</b></td>
            <td> ";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "valor_provisionado", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Comentarios:</b></td>
            <td> ";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "comentarios", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado El:</b></td>
            <td> ";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "date_create", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Ultima Actualización:</b></td>
            <td> ";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "last_update", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado Por:</b></td>
            <td> ";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute(($context["createBy"] ?? null), "nombres", array()), "html", null, true);
        echo " </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class=\"row\">
    <div class=\"col-sm-6\">
      <a href=\"";
        // line 71
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-default btn-sm\">
      <span class=\"fa fa-arrow-left fa-fw\"></span>  Volver al Pedido ";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "
    </a>
      <a href=\"";
        // line 74
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "id_gastos_nacionalizacion", array()), "html", null, true);
        echo "\" class=\"btn btn-default btn-sm\">
      <span class=\"fa fa-pencil fa-fw\"></span>  Editar Gasto Inicial
    </a>
    </div>
  </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "sections/mostrar-gasto-inicial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 74,  138 => 72,  132 => 71,  121 => 63,  114 => 59,  107 => 55,  100 => 51,  93 => 47,  86 => 43,  81 => 40,  75 => 37,  71 => 35,  69 => 34,  64 => 32,  57 => 28,  50 => 24,  43 => 20,  36 => 16,  19 => 1,);
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
<div class=\"proveedor\">
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
            <td>{{ initExpense.id_gastos_nacionalizacion }}</td>
          </tr>
          <tr>
            <td class=\"text-right\"><b>ID Proveedor:</b></td>
            <td>{{ supplier.identificacion_proveedor }}</td>
          </tr>
          <tr>           
            <td class=\"text-right\"><b>Nombre Proveedor:</b></td>
            <td>{{supplier.nombre}}</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Tipo Proveedor:</b></td>
            <td> {{supplier.tipo_provedor}} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Fecha:</b></td>
            <td>{{ initExpense.fecha }}</td>
          </tr>
          {% if initExpense.concepto == 'ALMACENAJE  INICIAL' %}
          <tr>
            <td class=\"text-right\"> <b>Fecha Fin:</b></td>
            <td>{{ initExpense.fecha_fin }}</td>
          </tr>
          {% endif %}
          
          <tr>
            <td class=\"text-right\"> <b>Concepto:</b></td>
            <td> {{ initExpense.concepto | raw }}</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Valor Provisionado:</b></td>
            <td> {{ initExpense.valor_provisionado }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Comentarios:</b></td>
            <td> {{ initExpense.comentarios }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado El:</b></td>
            <td> {{ initExpense.date_create }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Ultima Actualización:</b></td>
            <td> {{ initExpense.last_update }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado Por:</b></td>
            <td> {{ createBy.nombres }} </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class=\"row\">
    <div class=\"col-sm-6\">
      <a href=\"{{rute_url}}pedido/presentar/{{order.nro_pedido}}\" class=\"btn btn-default btn-sm\">
      <span class=\"fa fa-arrow-left fa-fw\"></span>  Volver al Pedido {{order.nro_pedido}}
    </a>
      <a href=\"{{rute_url}}gstinicial/editar/{{initExpense.id_gastos_nacionalizacion}}\" class=\"btn btn-default btn-sm\">
      <span class=\"fa fa-pencil fa-fw\"></span>  Editar Gasto Inicial
    </a>
    </div>
  </div>
</div>
<!--tabPedido-->", "sections/mostrar-gasto-inicial.html.twig", "/var/www/html/app/src/views/sections/mostrar-gasto-inicial.html.twig");
    }
}
