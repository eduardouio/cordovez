<?php

/* sections/block-order-detail.html.twig */
class __TwigTemplate_7bfbc790c6dd6cf43da89f41a67899def4ab78d56849ab3e1abd84f3a3d9bd09 extends Twig_Template
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
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" >PEDIDO</span>
                  <span class=\"form-control\">";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">RÉGIMEN</span>
                  <span class=\"form-control\">";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "regimen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">INCOTERM</span>
                  <span class=\"form-control\">";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "incoterm", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">PAIS</span>
                  <span class=\"form-control\"> ";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "pais_origen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">CIUDAD</span>
                  <span class=\"form-control\">";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "ciudad_origen", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">SEGURO SENAE</span>
                  <span class=\"form-control\"> ";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "seguro_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">FLETE SENAE</span>
                  <span class=\"form-control\" > ";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "flete_aduana", array()), "html", null, true);
        echo "</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">ARRIBO</span>
                  <span class=\"form-control\" > ";
        // line 50
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "fecha_arribo", array()), "html", null, true);
        echo "  </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">DIAS LIBRES</span>
                  <span class=\"form-control\" > ";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "dias_libres", array()), "html", null, true);
        echo "  </span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-12\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" id=\"basic-addon3\">COMENTARIOS</span>
                  <span type=\"text\" class=\"form-control\">";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "comentarios", array()), "html", null, true);
        echo " </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
               <hr>
            <div class=\"col-md-6\">
               <a href=\"";
        // line 72
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"text-primary\">
               <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar Pedido 
               </button></a>
               &nbsp;&nbsp;&nbsp;
               <a href=\"";
        // line 76
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/pedido/eliminar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button class=\"btn btn-sm btn-default\"> <span class=\"fa fa-trash fa-fw\"></span>Elimnar Pedido 
               </button></a>
            </div>
            <div class=\"col-sm-3\">
               <a href=\"";
        // line 81
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/validOrder/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
               <span class=\"fa fa-gear\"></span>
               Generar Gastos Iniciales
               </button>
               </a>
            </div>
            <div class=\"col-sm-3\">
               <a href=\"";
        // line 89
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "nacionalizacion/validOrder/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["viewData"] ?? null), "order", array()), "nro_pedido", array()), "html", null, true);
        echo "\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
               <span class=\"fa fa-gear\"></span>
               Nacionalizar Total/Parcial
               </button>
               </a>
            </div>
         </div>";
    }

    public function getTemplateName()
    {
        return "sections/block-order-detail.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 89,  141 => 81,  131 => 76,  122 => 72,  112 => 65,  100 => 56,  91 => 50,  82 => 44,  73 => 38,  61 => 29,  52 => 23,  43 => 17,  34 => 11,  25 => 5,  19 => 1,);
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
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" >PEDIDO</span>
                  <span class=\"form-control\">{{viewData.order.nro_pedido}} </span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">RÉGIMEN</span>
                  <span class=\"form-control\">{{viewData.order.regimen }}</span>
               </div>
            </div>
            <div class=\"col-md-2\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">INCOTERM</span>
                  <span class=\"form-control\">{{viewData.order.incoterm}} </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">PAIS</span>
                  <span class=\"form-control\"> {{viewData.order.pais_origen}}</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">CIUDAD</span>
                  <span class=\"form-control\">{{viewData.order.ciudad_origen}}</span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">SEGURO SENAE</span>
                  <span class=\"form-control\"> {{viewData.order.seguro_aduana }}</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">FLETE SENAE</span>
                  <span class=\"form-control\" > {{viewData.order.flete_aduana  }}</span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">ARRIBO</span>
                  <span class=\"form-control\" > {{viewData.order.fecha_arribo}}  </span>
               </div>
            </div>
            <div class=\"col-md-3\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\">DIAS LIBRES</span>
                  <span class=\"form-control\" > {{viewData.order.dias_libres}}  </span>
               </div>
            </div>
         </div>
         <br>
         <div class=\"row\">
            <div class=\"col-md-12\">
               <div class=\"input-group\">
                  <span class=\"input-group-addon\" id=\"basic-addon3\">COMENTARIOS</span>
                  <span type=\"text\" class=\"form-control\">{{viewData.order.comentarios}} </span>
               </div>
            </div>
         </div>
         <div class=\"row\">
               <hr>
            <div class=\"col-md-6\">
               <a href=\"{{rute_url}}/pedido/editar/{{viewData.order.nro_pedido}}\" class=\"text-primary\">
               <button class=\"btn btn-sm btn-default\"><span class=\"fa fa-pencil fa-fw\"></span>Ediar Pedido 
               </button></a>
               &nbsp;&nbsp;&nbsp;
               <a href=\"{{rute_url}}/pedido/eliminar/{{viewData.order.nro_pedido}}\">
               <button class=\"btn btn-sm btn-default\"> <span class=\"fa fa-trash fa-fw\"></span>Elimnar Pedido 
               </button></a>
            </div>
            <div class=\"col-sm-3\">
               <a href=\"{{rute_url}}gstinicial/validOrder/{{viewData.order.nro_pedido}}\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
               <span class=\"fa fa-gear\"></span>
               Generar Gastos Iniciales
               </button>
               </a>
            </div>
            <div class=\"col-sm-3\">
               <a href=\"{{rute_url}}nacionalizacion/validOrder/{{viewData.order.nro_pedido}}\">
               <button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width: 100%\">
               <span class=\"fa fa-gear\"></span>
               Nacionalizar Total/Parcial
               </button>
               </a>
            </div>
         </div>", "sections/block-order-detail.html.twig", "/var/www/html/app/src/views/sections/block-order-detail.html.twig");
    }
}
