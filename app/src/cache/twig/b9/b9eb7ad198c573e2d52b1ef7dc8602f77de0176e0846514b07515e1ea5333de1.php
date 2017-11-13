<?php

/* sections/listar-producto.html.twig */
class __TwigTemplate_78398e29069cdd866bb149db6cfefd7b4a2a08511d224017b64ad0c0fbb7d4b3 extends Twig_Template
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
        $context["countActives"] = 0;
        // line 2
        $context["countInactives"] = 0;
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 4
            if (($this->getAttribute($context["product"], "estado", array()) == 1)) {
                // line 5
                $context["countActives"] = (($context["countActives"] ?? null) + 1);
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "<div class=\"producto\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <a href=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "producto/nuevo/\">
         <button class=\"btn btn-sm btn-default\">
         <span class=\"fa fa-plus fa-fw\"></span>
         Nuevo Producto
         </button>
         </a>
      </div>
      <div class=\"col-sm-2\">
         <h5 class=\"text-primary\"> <small>Total: </small> <span id=\"suma\"> ";
        // line 19
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["count"] ?? null), 0, ".", ","), "html", null, true);
        echo " Productos </span></h5>
      </div>
      <div class=\"col-sm-2\">
         <h5 class=\"text-primary\"> <small>Activos: </small> <span id=\"suma\"> ";
        // line 22
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["countActives"] ?? null), 0, ".", ","), "html", null, true);
        echo "</span></h5>
      </div>
      <div class=\"col-sm-2\">
         <h5 class=\"text-danger\"> <small>Inactivos: </small> <span id=\"suma\">  ";
        // line 25
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["countInactives"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
      </div>
      <div class=\"col-sm-3\">
         <form action=\"";
        // line 28
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "Producto/busquedas/\" 
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
                  <th>Cod Producto</th>
                  <th>Nombre</th>
                  <th>Proveedor</th>
                  <th>Capacidad</th>
                  <th>Grd Alco</th>
                  <th>Cant Caja</th>
                  <th>Valor U</th>
                  <th>Valor T</th>
                  <th>Acciones</th>
               </tr>
            </thead>
            <tbody>
               ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 69
            echo "               <tr>
                  <td>";
            // line 70
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "cod_contable", array()), "html", null, true);
            echo "</td>
                  <td>
                     <a href=\"";
            // line 73
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "producto/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "cod_contable", array()), "html", null, true);
            echo "\">
                     ";
            // line 74
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "nombre", array()), "html", null, true);
            echo "
                     </a>
                  </td>
                  <td>
                     <a href=\"";
            // line 78
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "identificacion_proveedor", array()), "html", null, true);
            echo "\">
                        ";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "proveedor", array()), "html", null, true);
            echo "
                     </a>
                  </td>
                  <td>";
            // line 82
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "capacidad_ml", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 83
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "grado_alcoholico", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 84
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "cantidad_x_caja", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 85
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "costo_unidad", array()), "html", null, true);
            echo "</td>
                  ";
            // line 86
            $context["costo_caja"] = ($this->getAttribute($context["product"], "costo_unidad", array()) * $this->getAttribute($context["product"], "cantidad_x_caja", array()));
            // line 87
            echo "                  <td> costo_caja</td>
                  <td>
                     <div class=\"dropdown\">
                        <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                        <span class=\"fa fa-chevron-down\" ></span>
                        Seleccione
                        </button>
                        <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                           <li> <a href=\"";
            // line 95
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "Producto/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "id_producto", array()), "html", null, true);
            echo "\"> <span class=\"fa fa-eye fa-fw\"></span>
                              Ver Producto </a>  
                           </li>
                           <!--
                              <li> <a href=\"";
            // line 99
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "Producto/nuevo/\">
                                <span class=\"fa fa-eye fa-fw\"></span>
                                Agregar Producto</a> 
                              </li>
                              <li> <a href=\"";
            // line 103
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "Producto/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "id_Producto", array()), "html", null, true);
            echo "\">
                                <span class=\"fa fa-pencil fa-fw\"></span>
                                Editar Producto</a> 
                              </li>
                              <li> <a href=\"";
            // line 107
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "Producto/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "id_Producto", array()), "html", null, true);
            echo "\">
                                <span class=\"fa fa-trash fa-fw\"></span>
                                Elminar Producto</a> 
                              </li>
                              -->
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        echo "            </tbody>
         </table>
      </div>
   </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "sections/listar-producto.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  246 => 117,  220 => 107,  211 => 103,  204 => 99,  195 => 95,  185 => 87,  183 => 86,  179 => 85,  175 => 84,  171 => 83,  167 => 82,  161 => 79,  155 => 78,  148 => 74,  142 => 73,  137 => 71,  133 => 70,  130 => 69,  113 => 68,  70 => 28,  64 => 25,  58 => 22,  52 => 19,  41 => 11,  36 => 8,  29 => 5,  27 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set countActives = 0 %}
{% set countInactives = 0 %}
{% for product in products %}
{% if product.estado == 1 %}
{% set countActives = (countActives + 1) %}
{% endif %}
{% endfor %}
<div class=\"producto\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <a href=\"{{ rute_url }}producto/nuevo/\">
         <button class=\"btn btn-sm btn-default\">
         <span class=\"fa fa-plus fa-fw\"></span>
         Nuevo Producto
         </button>
         </a>
      </div>
      <div class=\"col-sm-2\">
         <h5 class=\"text-primary\"> <small>Total: </small> <span id=\"suma\"> {{ count | number_format(0, '.', ',') }} Productos </span></h5>
      </div>
      <div class=\"col-sm-2\">
         <h5 class=\"text-primary\"> <small>Activos: </small> <span id=\"suma\"> {{ countActives | number_format(0, '.', ',')}}</span></h5>
      </div>
      <div class=\"col-sm-2\">
         <h5 class=\"text-danger\"> <small>Inactivos: </small> <span id=\"suma\">  {{ countInactives | number_format(0, '.', ',') }} </span></h5>
      </div>
      <div class=\"col-sm-3\">
         <form action=\"{{rute_url}}Producto/busquedas/\" 
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
                  <th>Cod Producto</th>
                  <th>Nombre</th>
                  <th>Proveedor</th>
                  <th>Capacidad</th>
                  <th>Grd Alco</th>
                  <th>Cant Caja</th>
                  <th>Valor U</th>
                  <th>Valor T</th>
                  <th>Acciones</th>
               </tr>
            </thead>
            <tbody>
               {% for product in products %}
               <tr>
                  <td>{{loop.index}}</td>
                  <td>{{product.cod_contable}}</td>
                  <td>
                     <a href=\"{{ rute_url }}producto/presentar/{{product.cod_contable}}\">
                     {{product.nombre}}
                     </a>
                  </td>
                  <td>
                     <a href=\"{{ rute_url }}proveedor/presentar/{{product.identificacion_proveedor}}\">
                        {{product.proveedor}}
                     </a>
                  </td>
                  <td>{{product.capacidad_ml}}</td>
                  <td>{{product.grado_alcoholico}}</td>
                  <td>{{product.cantidad_x_caja}}</td>
                  <td>{{product.costo_unidad}}</td>
                  {% set costo_caja = (product.costo_unidad) * product.cantidad_x_caja %}
                  <td> costo_caja</td>
                  <td>
                     <div class=\"dropdown\">
                        <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                        <span class=\"fa fa-chevron-down\" ></span>
                        Seleccione
                        </button>
                        <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                           <li> <a href=\"{{rute_url}}Producto/presentar/{{product.id_producto}}\"> <span class=\"fa fa-eye fa-fw\"></span>
                              Ver Producto </a>  
                           </li>
                           <!--
                              <li> <a href=\"{{rute_url}}Producto/nuevo/\">
                                <span class=\"fa fa-eye fa-fw\"></span>
                                Agregar Producto</a> 
                              </li>
                              <li> <a href=\"{{rute_url}}Producto/editar/{{product.id_Producto}}\">
                                <span class=\"fa fa-pencil fa-fw\"></span>
                                Editar Producto</a> 
                              </li>
                              <li> <a href=\"{{rute_url}}Producto/eliminar/{{product.id_Producto}}\">
                                <span class=\"fa fa-trash fa-fw\"></span>
                                Elminar Producto</a> 
                              </li>
                              -->
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
<!--tabPedido-->", "sections/listar-producto.html.twig", "/var/www/html/app/src/views/sections/listar-producto.html.twig");
    }
}
