<?php

/* base/sections/mostrar-proveedor.html.twig */
class __TwigTemplate_1009cdf17b674ae1874c8ef92bf81b1ea9307ec4a6b42418133c44b5ed5e3c1e extends Twig_Template
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
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "id_proveedor", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"><b>Identificación:</b></td>
            <td>";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "identificacion_proveedor", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>           
            <td class=\"text-right\"><b>Nombre:</b></td>
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
            <td class=\"text-right\"> <b>Categoría:</b></td>
            <td>";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "categoria", array()), "html", null, true);
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Comentarios:</b></td>
            <td> ";
        // line 36
        echo $this->getAttribute(($context["supplier"] ?? null), "comentarios", array());
        echo "</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Fecha de Registro:</b></td>
            <td> ";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "date_create", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Ultima Actualización:</b></td>
            <td> ";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "last_update", array()), "html", null, true);
        echo " </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado Por:</b></td>
            <td> ";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["createBy"] ?? null), 0, array(), "array"), "nombres", array()), "html", null, true);
        echo " </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    <div class=\"row\">
    <div class=\"col-sm-6\">
      <a href=\"";
        // line 56
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/listar\" class=\"btn btn-default btn-sm\">
      <span class=\"fa fa-arrow-left fa-fw\"></span>  Listar Proveedores
    </a>
      <a href=\"";
        // line 59
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "id_proveedor", array()), "html", null, true);
        echo "\" class=\"btn btn-default btn-sm\">
      <span class=\"fa fa-pencil fa-fw\"></span>  Editar Proveedor
    </a>

    <a href=\"";
        // line 63
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/eliminar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "id_proveedor", array()), "html", null, true);
        echo "\" class=\"btn btn-danger btn-sm\">
      <span class=\"fa fa-trash fa-fw\"></span> Eliminar Proveedor
    </a>
    </div>
  </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "base/sections/mostrar-proveedor.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 63,  109 => 59,  103 => 56,  92 => 48,  85 => 44,  78 => 40,  71 => 36,  64 => 32,  57 => 28,  50 => 24,  43 => 20,  36 => 16,  19 => 1,);
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
            <td>{{ supplier.id_proveedor }}</td>
          </tr>
          <tr>
            <td class=\"text-right\"><b>Identificación:</b></td>
            <td>{{ supplier.identificacion_proveedor }}</td>
          </tr>
          <tr>           
            <td class=\"text-right\"><b>Nombre:</b></td>
            <td>{{supplier.nombre}}</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Tipo Proveedor:</b></td>
            <td> {{supplier.tipo_provedor}} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Categoría:</b></td>
            <td>{{ supplier.categoria }}</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Comentarios:</b></td>
            <td> {{ supplier.comentarios | raw }}</td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Fecha de Registro:</b></td>
            <td> {{ supplier.date_create }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Ultima Actualización:</b></td>
            <td> {{ supplier.last_update }} </td>
          </tr>
          <tr>
            <td class=\"text-right\"> <b>Creado Por:</b></td>
            <td> {{ createBy[0].nombres }} </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    <div class=\"row\">
    <div class=\"col-sm-6\">
      <a href=\"{{rute_url}}proveedor/listar\" class=\"btn btn-default btn-sm\">
      <span class=\"fa fa-arrow-left fa-fw\"></span>  Listar Proveedores
    </a>
      <a href=\"{{rute_url}}proveedor/editar/{{supplier.id_proveedor}}\" class=\"btn btn-default btn-sm\">
      <span class=\"fa fa-pencil fa-fw\"></span>  Editar Proveedor
    </a>

    <a href=\"{{rute_url}}proveedor/eliminar/{{supplier.id_proveedor}}\" class=\"btn btn-danger btn-sm\">
      <span class=\"fa fa-trash fa-fw\"></span> Eliminar Proveedor
    </a>
    </div>
  </div>
</div>
<!--tabPedido-->", "base/sections/mostrar-proveedor.html.twig", "/var/www/html/app/src/views/base/sections/mostrar-proveedor.html.twig");
    }
}
