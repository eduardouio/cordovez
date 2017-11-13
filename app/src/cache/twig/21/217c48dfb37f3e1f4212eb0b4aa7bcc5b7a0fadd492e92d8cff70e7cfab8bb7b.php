<?php

/* base/sections/listar-pedidos.html.twig */
class __TwigTemplate_c123e83e34a3faa72aa46529443a9d39dddfb16eae1286d2c505beb134e7e46c extends Twig_Template
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
    <div class=\"col-sm-8\">
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
    <div class=\"col-sm-4\">
      <form action=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/busquedas/\" 
      method=\"POST\" 
      class=\"form-inline\" 
      role=\"form\">
        <div class=\"form-group\">
          <input 
          type=\"text\" 
          class=\"form-control\" 
          placeholder=\"Buscar\"
          >
        </div>
       <button 
       type=\"submit\"
       class=\"btn\" >
        &nbsp;&nbsp;&nbsp;
       <span class=\"fa fa-search fa-fw\"></span>
       &nbsp;&nbsp;&nbsp;
     </button>
      </form>
  
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
        // line 54
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
            // line 55
            echo "          <tr>
            <td>";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
            <td> <a href=\"";
            // line 57
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "</a></td>
            <td class=\"text-right\">";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "regimen", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "incoterm", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "pais_origen", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "fecha_arribo", array()), "html", null, true);
            echo " 
              <label class=\"label label-info pull-right\">
              ";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "dias", array()), "html", null, true);
            echo " <small>días</small>
              </label>
            </td>
            <td class=\"text-right\">";
            // line 66
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 2541.25, 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 67
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 54112.24, 2, ".", ","), "html", null, true);
            echo "</td>
            <td class=\"text-right\">";
            // line 68
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 541.24, 2, ".", ","), "html", null, true);
            echo "</td>
            <td>
              <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"";
            // line 76
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\"> <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Pedido </a>  
                  </li>
                  <li> <a href=\"";
            // line 79
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-eye fa-fw\"></span>
                    Agregar Productos</a> 
                  </li>
                  <li> <a href=\"";
            // line 83
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Pedido</a> 
                  </li>
                  <li> <a href=\"";
            // line 87
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Pedido</a> 
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "        </tbody>
      </table>
    </div>
  </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "base/sections/listar-pedidos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 96,  180 => 87,  171 => 83,  162 => 79,  154 => 76,  143 => 68,  139 => 67,  135 => 66,  129 => 63,  124 => 61,  120 => 60,  116 => 59,  112 => 58,  104 => 57,  100 => 56,  97 => 55,  80 => 54,  36 => 13,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base/sections/listar-pedidos.html.twig", "/var/www/html/app/src/views/base/sections/listar-pedidos.html.twig");
    }
}
