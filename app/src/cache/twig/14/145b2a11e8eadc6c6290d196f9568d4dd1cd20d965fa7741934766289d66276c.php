<?php

/* forms/frm-pedido-edit.html.twig */
class __TwigTemplate_d97f6747eb8b1073902d806b5121434b7aa246eb8bb4f2886f1dd79b7c5e3927 extends Twig_Template
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
        echo "<form method=\"post\" action=\"";
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/validar\">
   <input type=\"hidden\" name=\"id_pedido\" value=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "id_pedido", array()), "html", null, true);
        echo "\">
   <div class=\"row\">
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Nro Pedido</label>
            <input 
               readonly=\"\" 
               name=\"nro_pedido\" 
               class=\"form-control\" 
               value=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" 
               >
         </div>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Régimen</label>
            <select
               class=\"form-control\" 
               required=\"true\" 
               name=\"regimen\"
               >
               <option value=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "regimen", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "regimen", array()), "html", null, true);
        echo "</option>
               ";
        // line 24
        if (($this->getAttribute(($context["order"] ?? null), "regimen", array()) == "70")) {
            // line 25
            echo "                  <option value=\"10\">10</option>   
               ";
        } else {
            // line 27
            echo "                  <option value=\"70\">70</option>
               ";
        }
        // line 29
        echo "            </select>
         </div>
      </div>
      <div class=\"col-md-2\">
         <label>País Origen</label>
         <select
            id = \"pais_origen\"
            name = \"pais_origen\"
            class=\"form-control\"
            >
            <option value=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "pais_origen", array()), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "pais_origen", array()), "html", null, true);
        echo "</option>
         </select>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Ciudad Origen</label>
            <select
               class=\"form-control\"
               id=\"ciudad_origen\"
               name=\"ciudad_origen\"
               >
               <option value=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "ciudad_origen", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "ciudad_origen", array()), "html", null, true);
        echo "</option>
            </select>
         </div>
      </div>
      <div class=\"col-md-2\">
         <label>Incoterm</label>
         <select
            class=\"form-control\"
            name =\"incoterm\"
            id =\"incoterm\"
            >
            <option>";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "incoterm", array()), "html", null, true);
        echo "<option>
         </select>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Referendo</label>
            <input 
               type=\"text\" 
               name = \"nro_refrendo\"
               placeholder=\"000-0000-00-000000\"
               class=\"form-control\" 
               maxlength=\"20\" 
               value=\"";
        // line 73
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_refrendo", array()), "html", null, true);
        echo "\" 
               >
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-md-2\">
         <label>Fecha Arribo <span class=\"label label-info\">BODEGA</span></label>
         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_arribo\" 
               name=\"fecha_arribo\" 
               class=\"bootstrap-datepicker\" 
               value=\"";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "fecha_arribo", array()), "html", null, true);
        echo "\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
      </div>
          <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Días Libres <span class=\"label label-info \">DEMORAJE</span></label>
            <input 
            class=\"form-control\" 
            type=\"number\" 
            step=\"1\" 
            name=\"dias_libres\"
              value=\"";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "dias_libres", array()), "html", null, true);
        echo "\" 
            >
         </div>
      </div>
      <div class=\"col-md-6\">
         <div class=\"form-group\">
            <label>Comentarios</label>
            <textarea 
               rows=\"1\" 
               maxlength=\"250\" 
               class=\"form-control\"
               id=\"comentarios\"
               name=\"comentarios\"
               >";
        // line 116
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "comentarios", array()), "html", null, true);
        echo "</textarea>
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-md-12\">
         <hr>
         <button type=\"submit\" class=\"btn btn-sm btn-default\" >
            <span class=\"fa fa-save fa-fw\"></span>
            Guardar Registro
         </button>
      <a href=\"";
        // line 127
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Volver
         </a>
      </div>
      </form>
   </div>
   <script type=\"text/javascript\">
      var incotermsDb = ";
        // line 135
        echo ($context["incoterms"] ?? null);
        echo " ;
   </script>
";
    }

    public function getTemplateName()
    {
        return "forms/frm-pedido-edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 135,  192 => 127,  178 => 116,  162 => 103,  144 => 88,  126 => 73,  111 => 61,  95 => 50,  79 => 39,  67 => 29,  63 => 27,  59 => 25,  57 => 24,  51 => 23,  36 => 11,  24 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form method=\"post\" action=\"{{rute_url}}pedido/validar\">
   <input type=\"hidden\" name=\"id_pedido\" value=\"{{order.id_pedido}}\">
   <div class=\"row\">
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Nro Pedido</label>
            <input 
               readonly=\"\" 
               name=\"nro_pedido\" 
               class=\"form-control\" 
               value=\"{{order.nro_pedido}}\" 
               >
         </div>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Régimen</label>
            <select
               class=\"form-control\" 
               required=\"true\" 
               name=\"regimen\"
               >
               <option value=\"{{order.regimen}}\">{{order.regimen}}</option>
               {% if order.regimen == '70' %}
                  <option value=\"10\">10</option>   
               {% else %}
                  <option value=\"70\">70</option>
               {% endif %}
            </select>
         </div>
      </div>
      <div class=\"col-md-2\">
         <label>País Origen</label>
         <select
            id = \"pais_origen\"
            name = \"pais_origen\"
            class=\"form-control\"
            >
            <option value=\"{{order.pais_origen}}\" >{{order.pais_origen}}</option>
         </select>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Ciudad Origen</label>
            <select
               class=\"form-control\"
               id=\"ciudad_origen\"
               name=\"ciudad_origen\"
               >
               <option value=\"{{order.ciudad_origen}}\">{{order.ciudad_origen}}</option>
            </select>
         </div>
      </div>
      <div class=\"col-md-2\">
         <label>Incoterm</label>
         <select
            class=\"form-control\"
            name =\"incoterm\"
            id =\"incoterm\"
            >
            <option>{{order.incoterm}}<option>
         </select>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Referendo</label>
            <input 
               type=\"text\" 
               name = \"nro_refrendo\"
               placeholder=\"000-0000-00-000000\"
               class=\"form-control\" 
               maxlength=\"20\" 
               value=\"{{order.nro_refrendo}}\" 
               >
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-md-2\">
         <label>Fecha Arribo <span class=\"label label-info\">BODEGA</span></label>
         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_arribo\" 
               name=\"fecha_arribo\" 
               class=\"bootstrap-datepicker\" 
               value=\"{{order.fecha_arribo}}\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
      </div>
          <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Días Libres <span class=\"label label-info \">DEMORAJE</span></label>
            <input 
            class=\"form-control\" 
            type=\"number\" 
            step=\"1\" 
            name=\"dias_libres\"
              value=\"{{order.dias_libres}}\" 
            >
         </div>
      </div>
      <div class=\"col-md-6\">
         <div class=\"form-group\">
            <label>Comentarios</label>
            <textarea 
               rows=\"1\" 
               maxlength=\"250\" 
               class=\"form-control\"
               id=\"comentarios\"
               name=\"comentarios\"
               >{{order.comentarios}}</textarea>
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-md-12\">
         <hr>
         <button type=\"submit\" class=\"btn btn-sm btn-default\" >
            <span class=\"fa fa-save fa-fw\"></span>
            Guardar Registro
         </button>
      <a href=\"{{rute_url}}pedido/presentar/{{order.nro_pedido}}\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Volver
         </a>
      </div>
      </form>
   </div>
   <script type=\"text/javascript\">
      var incotermsDb = {{ incoterms | raw }} ;
   </script>
", "forms/frm-pedido-edit.html.twig", "/var/www/html/app/src/views/forms/frm-pedido-edit.html.twig");
    }
}
