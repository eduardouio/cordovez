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
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "id_pedido", array()), "html", null, true);
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
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
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
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "regimen", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "regimen", array()), "html", null, true);
        echo "</option>
               ";
        // line 24
        if (($this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "regimen", array()) == "70")) {
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
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "pais_origen", array()), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "pais_origen", array()), "html", null, true);
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
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "ciudad_origen", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "ciudad_origen", array()), "html", null, true);
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
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "incoterm", array()), "html", null, true);
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
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "nro_refrendo", array()), "html", null, true);
        echo "\" 
               >
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Seguro <span class=\"label label-info\">SENAE</span></label>
            <input 
               class=\"form-control\" 
               type=\"number\"
               step=\"0.01\" 
               placeholder=\"0.00\" 
               required=\"true\"
               name=\"seguro_aduana\"
               value=\"";
        // line 89
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "seguro_aduana", array()), "html", null, true);
        echo "\" 
               >
         </div>
      </div>      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Flete <span class=\"label label-info\">SENAE</span></label>
            <input 
               class=\"form-control\" 
               type=\"number\"
               required=\"true\"
               step=\"0.01\" 
               placeholder=\"0.00\" 
               name=\"flete_aduana\"
               value=\"";
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "flete_aduana", array()), "html", null, true);
        echo "\" 
               >
         </div>
      </div>
      <div class=\"col-md-3\">
         <label>Fecha Arribo <span class=\"label label-info\">BODEGA</span></label>
         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_arribo\" 
               required=\"required\" 
               name=\"fecha_arribo\" 
               class=\"bootstrap-datepicker\" 
               value=\"";
        // line 116
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "fecha_arribo", array()), "html", null, true);
        echo "\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
      </div>
      <div class=\"col-md-5\">
         <div class=\"form-group\">
            <label>Comentarios</label>
            <textarea 
               rows=\"2\" 
               maxlength=\"250\" 
               class=\"form-control\"
               id=\"comentarios\"
               name=\"comentarios\"
               >";
        // line 132
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "comentarios", array()), "html", null, true);
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
        // line 143
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Volver
         </a>
      </div>
      </form>
   </div>
   <script type=\"text/javascript\">
      var incotermsDb = ";
        // line 151
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
        return array (  224 => 151,  211 => 143,  197 => 132,  178 => 116,  161 => 102,  145 => 89,  126 => 73,  111 => 61,  95 => 50,  79 => 39,  67 => 29,  63 => 27,  59 => 25,  57 => 24,  51 => 23,  36 => 11,  24 => 2,  19 => 1,);
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
   <input type=\"hidden\" name=\"id_pedido\" value=\"{{order[0].id_pedido}}\">
   <div class=\"row\">
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Nro Pedido</label>
            <input 
               readonly=\"\" 
               name=\"nro_pedido\" 
               class=\"form-control\" 
               value=\"{{order[0].nro_pedido}}\" 
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
               <option value=\"{{order[0].regimen}}\">{{order[0].regimen}}</option>
               {% if order[0].regimen == '70' %}
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
            <option value=\"{{order[0].pais_origen}}\" >{{order[0].pais_origen}}</option>
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
               <option value=\"{{order[0].ciudad_origen}}\">{{order[0].ciudad_origen}}</option>
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
            <option>{{order[0].incoterm}}<option>
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
               value=\"{{order[0].nro_refrendo}}\" 
               >
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Seguro <span class=\"label label-info\">SENAE</span></label>
            <input 
               class=\"form-control\" 
               type=\"number\"
               step=\"0.01\" 
               placeholder=\"0.00\" 
               required=\"true\"
               name=\"seguro_aduana\"
               value=\"{{order[0].seguro_aduana}}\" 
               >
         </div>
      </div>      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Flete <span class=\"label label-info\">SENAE</span></label>
            <input 
               class=\"form-control\" 
               type=\"number\"
               required=\"true\"
               step=\"0.01\" 
               placeholder=\"0.00\" 
               name=\"flete_aduana\"
               value=\"{{order[0].flete_aduana}}\" 
               >
         </div>
      </div>
      <div class=\"col-md-3\">
         <label>Fecha Arribo <span class=\"label label-info\">BODEGA</span></label>
         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_arribo\" 
               required=\"required\" 
               name=\"fecha_arribo\" 
               class=\"bootstrap-datepicker\" 
               value=\"{{order[0].fecha_arribo}}\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
      </div>
      <div class=\"col-md-5\">
         <div class=\"form-group\">
            <label>Comentarios</label>
            <textarea 
               rows=\"2\" 
               maxlength=\"250\" 
               class=\"form-control\"
               id=\"comentarios\"
               name=\"comentarios\"
               >{{order[0].comentarios}}</textarea>
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
      <a href=\"{{rute_url}}pedido/presentar/{{order[0].nro_pedido}}\" class=\"btn btn-sm btn-default\">
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
