<?php

/* sections/listar-proveedor.html.twig */
class __TwigTemplate_6282222de192f3936fe1d27131914bcfd6979edebebc8d64b51a91273d58a9ab extends Twig_Template
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
        $context["countNat"] = 0;
        // line 2
        $context["countInter"] = 0;
        // line 3
        echo "
";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["suppliers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["supplier"]) {
            // line 5
            echo "\t";
            if (($this->getAttribute($context["supplier"], "tipo_provedor", array()) == "NACIONAL")) {
                // line 6
                echo "\t\t\t";
                $context["countNat"] = (($context["countNat"] ?? null) + 1);
                // line 7
                echo "\t\t";
            }
            // line 8
            echo "\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['supplier'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 9
        echo "
";
        // line 10
        $context["countInter"] = (($context["count"] ?? null) - ($context["countNat"] ?? null));
        // line 11
        echo "
<div class=\"proveedor\">
  <div class=\"row\">
    <div class=\"col-sm-3\">
      <a href=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/nuevo/\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Nuevo Proveedor
        </button>
      </a>
    </div>

        <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Total: </small> <span id=\"suma\"> ";
        // line 24
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["count"] ?? null), 0, ".", ","), "html", null, true);
        echo " Proveedores </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Internacionales: </small> <span id=\"suma\"> ";
        // line 27
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["countInter"] ?? null), 0, ".", ","), "html", null, true);
        echo "</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Nacionales: </small> <span id=\"suma\">  ";
        // line 30
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["countNat"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
    <div class=\"col-sm-3\">
      <form action=\"";
        // line 33
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/busquedas/\" 
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
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Categoria</th>
            <th>Creado</th>
            <th>Actualizado</th>
            <th>Pedidos</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          ";
        // line 72
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["suppliers"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["supplier"]) {
            // line 73
            echo "          <tr>
            <td>";
            // line 74
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 75
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "identificacion_proveedor", array()), "html", null, true);
            echo "</td>
            <td>
               <a href=\"";
            // line 77
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "id_proveedor", array()), "html", null, true);
            echo "\">
            ";
            // line 78
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "nombre", array()), "html", null, true);
            echo "
          </a>
        </td>
            <td>";
            // line 81
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "tipo_provedor", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 82
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "categoria", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 83
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "date_create", array()), "html", null, true);
            echo " 
            <td>";
            // line 84
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "last_update", array()), "html", null, true);
            echo " 
              
            </td>
            
            <td class=\"text-right\">";
            // line 88
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ".", ","), "html", null, true);
            echo "</td>
            <td>
              <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"";
            // line 96
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "id_proveedor", array()), "html", null, true);
            echo "\"> <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Proveedor </a>  
                  </li>
                  <li> <a href=\"";
            // line 99
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "id_proveedor", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Proveedor</a> 
                  </li>
                  <li> <a href=\"";
            // line 103
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "id_proveedor", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Proveedor</a> 
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['supplier'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 112
        echo "        </tbody>
      </table>
  </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "sections/listar-proveedor.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  241 => 112,  216 => 103,  207 => 99,  199 => 96,  188 => 88,  181 => 84,  177 => 83,  173 => 82,  169 => 81,  163 => 78,  157 => 77,  152 => 75,  148 => 74,  145 => 73,  128 => 72,  86 => 33,  80 => 30,  74 => 27,  68 => 24,  56 => 15,  50 => 11,  48 => 10,  45 => 9,  39 => 8,  36 => 7,  33 => 6,  30 => 5,  26 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set countNat = 0 %}
{% set countInter = 0 %}

{% for supplier in suppliers %}
\t{% if supplier.tipo_provedor == 'NACIONAL' %}
\t\t\t{% set countNat = countNat + 1 %}
\t\t{% endif %}
\t{% endfor %}

{% set countInter = count - countNat %}

<div class=\"proveedor\">
  <div class=\"row\">
    <div class=\"col-sm-3\">
      <a href=\"{{ rute_url }}proveedor/nuevo/\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Nuevo Proveedor
        </button>
      </a>
    </div>

        <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Total: </small> <span id=\"suma\"> {{ count | number_format(0, '.', ',') }} Proveedores </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Internacionales: </small> <span id=\"suma\"> {{ countInter | number_format(0, '.', ',')}}</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Nacionales: </small> <span id=\"suma\">  {{ countNat | number_format(0, '.', ',') }} </span></h5>
    </div>
    <div class=\"col-sm-3\">
      <form action=\"{{rute_url}}proveedor/busquedas/\" 
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
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Categoria</th>
            <th>Creado</th>
            <th>Actualizado</th>
            <th>Pedidos</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {% for supplier in suppliers %}
          <tr>
            <td>{{loop.index}}</td>
            <td>{{supplier.identificacion_proveedor}}</td>
            <td>
               <a href=\"{{ rute_url }}proveedor/presentar/{{supplier.id_proveedor}}\">
            {{supplier.nombre}}
          </a>
        </td>
            <td>{{supplier.tipo_provedor}}</td>
            <td>{{supplier.categoria}}</td>
            <td>{{supplier.date_create}} 
            <td>{{supplier.last_update}} 
              
            </td>
            
            <td class=\"text-right\">{{0    | number_format(0, '.', ',')}}</td>
            <td>
              <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"{{rute_url}}proveedor/presentar/{{supplier.id_proveedor}}\"> <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Proveedor </a>  
                  </li>
                  <li> <a href=\"{{rute_url}}proveedor/editar/{{supplier.id_proveedor}}\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Proveedor</a> 
                  </li>
                  <li> <a href=\"{{rute_url}}proveedor/eliminar/{{supplier.id_proveedor}}\">
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Proveedor</a> 
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
<!--tabPedido-->", "sections/listar-proveedor.html.twig", "/var/www/html/app/src/views/sections/listar-proveedor.html.twig");
    }
}
