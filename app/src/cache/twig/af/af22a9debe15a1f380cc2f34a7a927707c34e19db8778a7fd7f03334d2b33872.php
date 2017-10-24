<?php

/* base/sections/pedidos.html.twig */
class __TwigTemplate_7f592dea7b565879f5fec38770c3924ad45d2a435fa3eb5121beec113e9a3754 extends Twig_Template
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
    <div class=\"col-sm-9\">
      <button 
        >
      <span class=\"fa fa-plus-circle fa-fw\"></span>
      Agregar Pedido
      </button>
    </div>
    <div class=\"col-sm-3\">
      <input 
        class=\"form-control\" 
        type=\"text\" 
        style=\"width: 100%\" 
        placeholder=\"Buscar Registro\"
        >
    </div>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"table-responsive\">
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Pedido</th>
            <th>Regimen</th>
            <th>Incoterm</th>
            <th>Origen</th>
            <th>Arribo</th>
            <th>FOB</th>
            <th>Nacionalizado</th>
            <th>Saldo FOB</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
            ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 40
            echo "          <tr>
              <td>";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
              <td> <a href=\"";
            // line 42
            echo twig_escape_filter($this->env, ($context["content_url"] ?? null), "html", null, true);
            echo "presentar-pedido/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "</a></td>
              <td>";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "regimen", array()), "html", null, true);
            echo "</td>
              <td>";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "incoterm", array()), "html", null, true);
            echo "</td>
              <td>";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "pais_origen", array()), "html", null, true);
            echo "</td>
              <td>";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "fecha_arribo", array()), "html", null, true);
            echo " <label></label></td>
              <td>";
            // line 47
            echo 2541.25;
            echo "</td>
              <td>";
            // line 48
            echo 54112.24;
            echo "</td>
              <td>";
            // line 49
            echo 541.24;
            echo "</td>
              <td>
               <div class=\"dropdown\">
                           <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                            <span class=\"fa fa-chevron-down\" ></span>
                            Seleccione
                          </button>
                          <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                            <li> <a href=\"";
            // line 57
            echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
            echo "presentar-pedido/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\"> <span class=\"fa fa-eye fa-fw\"></span>
                            Ver Pedido </a>  </li>
                            <li> <a href=\"/facturas-pedido/";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">
                                                                                  <span class=\"fa fa-eye fa-fw\"></span>
                            Ver Productos</a> </li>
                            <li> <a href=\"#/editar-pedido/";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "id_pedido", array()), "html", null, true);
            echo "\">
                                                                                  <span class=\"fa fa-pencil fa-fw\"></span>
                            Editar Pedido</a> </li>
                            <li> <a href=\"#/eliminar-pedido/";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "id_pedido", array()), "html", null, true);
            echo "\">
                                                                                  <span class=\"fa fa-trash fa-fw\"></span>
                            Elminar Pedido</a> </li>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        echo "        </tbody>
      </table>
    </div>
  </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "base/sections/pedidos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  168 => 74,  145 => 65,  139 => 62,  133 => 59,  126 => 57,  115 => 49,  111 => 48,  107 => 47,  103 => 46,  99 => 45,  95 => 44,  91 => 43,  83 => 42,  79 => 41,  76 => 40,  59 => 39,  19 => 1,);
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
    <div class=\"col-sm-9\">
      <button 
        >
      <span class=\"fa fa-plus-circle fa-fw\"></span>
      Agregar Pedido
      </button>
    </div>
    <div class=\"col-sm-3\">
      <input 
        class=\"form-control\" 
        type=\"text\" 
        style=\"width: 100%\" 
        placeholder=\"Buscar Registro\"
        >
    </div>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"table-responsive\">
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Pedido</th>
            <th>Regimen</th>
            <th>Incoterm</th>
            <th>Origen</th>
            <th>Arribo</th>
            <th>FOB</th>
            <th>Nacionalizado</th>
            <th>Saldo FOB</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
            {% for order in orders %}
          <tr>
              <td>{{loop.index}}</td>
              <td> <a href=\"{{content_url}}presentar-pedido/{{order.nro_pedido}}\">{{order.nro_pedido}}</a></td>
              <td>{{order.regimen}}</td>
              <td>{{order.incoterm}}</td>
              <td>{{order.pais_origen}}</td>
              <td>{{order.fecha_arribo}} <label></label></td>
              <td>{{2541.25}}</td>
              <td>{{54112.24}}</td>
              <td>{{541.24}}</td>
              <td>
               <div class=\"dropdown\">
                           <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                            <span class=\"fa fa-chevron-down\" ></span>
                            Seleccione
                          </button>
                          <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                            <li> <a href=\"{{base_url}}presentar-pedido/{{order.nro_pedido}}\"> <span class=\"fa fa-eye fa-fw\"></span>
                            Ver Pedido </a>  </li>
                            <li> <a href=\"/facturas-pedido/{{order.nro_pedido}}\">
                                                                                  <span class=\"fa fa-eye fa-fw\"></span>
                            Ver Productos</a> </li>
                            <li> <a href=\"#/editar-pedido/{{order.id_pedido}}\">
                                                                                  <span class=\"fa fa-pencil fa-fw\"></span>
                            Editar Pedido</a> </li>
                            <li> <a href=\"#/eliminar-pedido/{{order.id_pedido}}\">
                                                                                  <span class=\"fa fa-trash fa-fw\"></span>
                            Elminar Pedido</a> </li>
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
<!--tabPedido-->", "base/sections/pedidos.html.twig", "/var/www/html/app/src/views/base/sections/pedidos.html.twig");
    }
}
