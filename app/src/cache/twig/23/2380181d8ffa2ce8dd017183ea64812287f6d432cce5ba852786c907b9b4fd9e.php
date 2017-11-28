<?php

/* sections/subsections/tab-gastos-iniciales.html.twig */
class __TwigTemplate_565498becef3c3269d035466ac508d55b11b3eec187fd81810cae941249799a8 extends Twig_Template
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
        echo "         <div class=\"row\">
            <div class=\"col-sm-6\">
               <a href=\"";
        // line 3
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/nuevo/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Nacional <span class=\"label label-warning\">provisionado</span>
               </button>
               </a>
            </div>
            ";
        // line 10
        $context["cantidad"] = 0;
        // line 11
        echo "            ";
        $context["provisionado"] = 0;
        // line 12
        echo "            ";
        $context["convalidado"] = 0;
        // line 13
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "initialExpenses", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["initialExpense"]) {
            // line 14
            echo "            ";
            $context["cantidad"] = (($context["cantidad"] ?? null) + 1);
            // line 15
            echo "            ";
            $context["provisionado"] = (($context["provisionado"] ?? null) + $this->getAttribute($context["initialExpense"], "valor_provisionado", array()));
            // line 16
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initialExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Cantidad: </small> <span id=\"suma\"> ";
        // line 18
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["cantidad"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Provisionado: </small> <span id=\"suma\"> \$ ";
        // line 21
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["provisionado"] ?? null), 2, ".", ","), "html", null, true);
        echo "</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Convalidado: </small> <span id=\"suma\"> \$ ";
        // line 24
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["Convalidado"] ?? null), 2, ".", ","), "html", null, true);
        echo " </span></h5>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-sm-12\">
               <table class=\"table table-hover table-bordered table-striped\">
                  <thead>
                     <tr style=\"background-color: #c1c1c1;\">
                        <th>#</th>
                        <th>Concepto</th>
                        <th>Proveedor</th>
                        <th>Comentarios</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Acciones</th>
                     </tr>
                  </thead>
                  <tbody>
                     ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["viewData"] ?? null), "initialExpenses", array()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["initialExpense"]) {
            // line 44
            echo "                     <tr>
                        <td>";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                        <td>
                           <a href=\"";
            // line 47
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                           ";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "concepto", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>
                           <a href=\"";
            // line 52
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_proveedor", array()), "html", null, true);
            echo "\">
                           ";
            // line 53
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "nombre", array()), "html", null, true);
            echo "
                           </a>
                        </td>
                        <td>";
            // line 56
            echo $this->getAttribute($context["initialExpense"], "comentarios", array());
            echo "</td>
                        <td>";
            // line 57
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["initialExpense"], "fecha", array()), "m/d/Y"), "html", null, true);
            echo "</td>
                        <td>";
            // line 58
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["initialExpense"], "valor_provisionado", array()), 2, ".", ","), "html", null, true);
            echo "</td>
                        <td>
                           <div class=\"dropdown\">
                              <button class=\"btn btn-sm btn-default\" id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                              Acciones <span class=\"fa fa-list fa-fw\" ></span>
                              <span class=\"caret\"></span>
                              </button>
                              <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                                 <li> 
                                    <a href=\"";
            // line 67
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-eye fa-fw\"></span>
                                    Detalle Gasto Inicial
                                    </a> 
                                 </li>
                                 <li> 
                                    <a href=\"";
            // line 73
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Gasto Inicial
                                    <span class=\"label label-success\"> ";
            // line 76
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"";
            // line 79
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Gasto Inicial
                                    <span class=\"label label-danger\">
                                    ";
            // line 83
            echo twig_escape_filter($this->env, $this->getAttribute($context["initialExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "
                                    </span>
                                    </a>   
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initialExpense'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        echo "                  </tbody>
               </table>
            </div>
         </div>
         <div class=\"row\">
            <div class=\"com-md-9\">
               &nbsp;
            </div>
            <div class=\"col-md-3\">
               <a href=\"";
        // line 101
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/validargi/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
                  <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
                     <span class=\"fa fa-gear\"></span>
                     Generar Gastos Iniciales
                  </button>
               </a>
            </div>
         </div>";
    }

    public function getTemplateName()
    {
        return "sections/subsections/tab-gastos-iniciales.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  235 => 101,  224 => 92,  201 => 83,  192 => 79,  186 => 76,  178 => 73,  167 => 67,  155 => 58,  151 => 57,  147 => 56,  141 => 53,  135 => 52,  128 => 48,  122 => 47,  117 => 45,  114 => 44,  97 => 43,  75 => 24,  69 => 21,  63 => 18,  60 => 17,  54 => 16,  51 => 15,  48 => 14,  43 => 13,  40 => 12,  37 => 11,  35 => 10,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("         <div class=\"row\">
            <div class=\"col-sm-6\">
               <a href=\"{{rute_url}}gstinicial/nuevo/{{viewData.order.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\">
               <span class=\"fa fa-plus fa-fw\"> </span>
               Agregar Gasto Nacional <span class=\"label label-warning\">provisionado</span>
               </button>
               </a>
            </div>
            {% set cantidad = 0 %}
            {% set provisionado = 0.0 %}
            {% set convalidado = 0.00 %}
            {% for initialExpense in viewData.initialExpenses %}
            {% set cantidad = cantidad + 1 %}
            {% set provisionado = provisionado + initialExpense.valor_provisionado %}
            {% endfor %}
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Cantidad: </small> <span id=\"suma\"> {{ cantidad | number_format(0, '.', ',') }} </span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-primary\"> <small>Provisionado: </small> <span id=\"suma\"> \$ {{ provisionado | number_format(2, '.', ',')}}</span></h5>
            </div>
            <div class=\"col-sm-2\">
               <h5 class=\"text-danger\"> <small>Convalidado: </small> <span id=\"suma\"> \$ {{ Convalidado | number_format(2, '.', ',') }} </span></h5>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-sm-12\">
               <table class=\"table table-hover table-bordered table-striped\">
                  <thead>
                     <tr style=\"background-color: #c1c1c1;\">
                        <th>#</th>
                        <th>Concepto</th>
                        <th>Proveedor</th>
                        <th>Comentarios</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Acciones</th>
                     </tr>
                  </thead>
                  <tbody>
                     {% for initialExpense in viewData.initialExpenses %}
                     <tr>
                        <td>{{loop.index}}</td>
                        <td>
                           <a href=\"{{rute_url}}gstinicial/presentar/{{initialExpense.id_gastos_nacionalizacion}}\">
                           {{initialExpense.concepto}}
                           </a>
                        </td>
                        <td>
                           <a href=\"{{rute_url}}proveedor/presentar/{{initialExpense.id_proveedor}}\">
                           {{initialExpense.nombre}}
                           </a>
                        </td>
                        <td>{{initialExpense.comentarios |raw }}</td>
                        <td>{{initialExpense.fecha | date(\"m/d/Y\") }}</td>
                        <td>{{initialExpense.valor_provisionado | number_format(2, '.', ',')}}</td>
                        <td>
                           <div class=\"dropdown\">
                              <button class=\"btn btn-sm btn-default\" id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                              Acciones <span class=\"fa fa-list fa-fw\" ></span>
                              <span class=\"caret\"></span>
                              </button>
                              <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                                 <li> 
                                    <a href=\"{{rute_url}}gstinicial/presentar/{{initialExpense.id_gastos_nacionalizacion}}\">
                                    <span class=\"fa fa-eye fa-fw\"></span>
                                    Detalle Gasto Inicial
                                    </a> 
                                 </li>
                                 <li> 
                                    <a href=\"{{rute_url}}gstinicial/editar/{{initialExpense.id_gastos_nacionalizacion}}\">
                                    <span class=\"fa fa-pencil fa-fw\"></span>
                                    Editar Gasto Inicial
                                    <span class=\"label label-success\"> {{initialExpense.id_gastos_nacionalizacion}}</span></a> 
                                 </li>
                                 <li>
                                    <a href=\"{{rute_url}}gstinicial/eliminar/{{initialExpense.id_gastos_nacionalizacion}}\">
                                    <span class=\"text-danger fa fa-trash fa-fw\"></span>
                                    Elminar Gasto Inicial
                                    <span class=\"label label-danger\">
                                    {{initialExpense.id_gastos_nacionalizacion}}
                                    </span>
                                    </a>   
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
         <div class=\"row\">
            <div class=\"com-md-9\">
               &nbsp;
            </div>
            <div class=\"col-md-3\">
               <a href=\"{{rute_url}}gstinicial/validargi/{{viewData.order.nro_pedido}}\">
                  <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
                     <span class=\"fa fa-gear\"></span>
                     Generar Gastos Iniciales
                  </button>
               </a>
            </div>
         </div>", "sections/subsections/tab-gastos-iniciales.html.twig", "/var/www/html/app/src/views/sections/subsections/tab-gastos-iniciales.html.twig");
    }
}
