<?php

/* forms/frm-pedido.html.twig */
class __TwigTemplate_8b5c2b1dfffa7e14321d4266ba85b81dcf99fa76f559db581b9294cee591b3fb extends Twig_Template
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
   <div class=\"row\">
      <div class=\"col-md-1\">
         <div class=\"form-group\">
            <label>Nro</label>
            <input 
               class=\"form-control\" 
               type=\"text\"
               required=\"true\"
               name=\"n_pedido\"
               placeholder=\"000\" 
               maxlength=\"3\" 
               minlength=\"1\" 
               >
         </div>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Año</label>
            <select
               class=\"form-control\"
               name=\"y_pedido\"
               required = \"required\"
               >
               <option value=\"17\">2017</option>
               <option value=\"16\">2016</option>
               <option value=\"15\">2015</option>
               <option value=\"15\">2014</option>
            </select>
         </div>
      </div>
      <div class=\"col-md-1\">
         <div class=\"form-group\">
            <label>Régimen</label>
            <select
               class=\"form-control\" 
               required=\"true\" 
               name=\"regimen\"
               >
               <option value=\"\" disabled selected>...</option>
               <option value=\"70\">70</option>
               <option value=\"10\">10</option>
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
            <option disabled selected=\"\">Seleccione...</option>
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
               <option disabled selected=\"\">Seleccione...</option>
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
            <option disabled selected=\"\">Seleccione...</option>
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
               maxlength=\"17\" 
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
               >
         </div>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Flete <span class=\"label label-info\">SENAE</span></label>
            <input 
               class=\"form-control\" 
               type=\"number\"
               required=\"true\"
               step=\"0.01\" 
               placeholder=\"0.00\" 
               name=\"flete_aduana\"
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
               ></textarea>
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
        // line 154
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/listar/\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Regresar Lista
         </a>
      </div>
   </div>
</form>

   <script type=\"text/javascript\">
      var incotermsDb = ";
        // line 163
        echo ($context["incoterms"] ?? null);
        echo " ;
   </script>";
    }

    public function getTemplateName()
    {
        return "forms/frm-pedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  188 => 163,  176 => 154,  19 => 1,);
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
   <div class=\"row\">
      <div class=\"col-md-1\">
         <div class=\"form-group\">
            <label>Nro</label>
            <input 
               class=\"form-control\" 
               type=\"text\"
               required=\"true\"
               name=\"n_pedido\"
               placeholder=\"000\" 
               maxlength=\"3\" 
               minlength=\"1\" 
               >
         </div>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Año</label>
            <select
               class=\"form-control\"
               name=\"y_pedido\"
               required = \"required\"
               >
               <option value=\"17\">2017</option>
               <option value=\"16\">2016</option>
               <option value=\"15\">2015</option>
               <option value=\"15\">2014</option>
            </select>
         </div>
      </div>
      <div class=\"col-md-1\">
         <div class=\"form-group\">
            <label>Régimen</label>
            <select
               class=\"form-control\" 
               required=\"true\" 
               name=\"regimen\"
               >
               <option value=\"\" disabled selected>...</option>
               <option value=\"70\">70</option>
               <option value=\"10\">10</option>
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
            <option disabled selected=\"\">Seleccione...</option>
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
               <option disabled selected=\"\">Seleccione...</option>
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
            <option disabled selected=\"\">Seleccione...</option>
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
               maxlength=\"17\" 
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
               >
         </div>
      </div>
      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Flete <span class=\"label label-info\">SENAE</span></label>
            <input 
               class=\"form-control\" 
               type=\"number\"
               required=\"true\"
               step=\"0.01\" 
               placeholder=\"0.00\" 
               name=\"flete_aduana\"
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
               ></textarea>
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
      <a href=\"{{rute_url}}pedido/listar/\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Regresar Lista
         </a>
      </div>
   </div>
</form>

   <script type=\"text/javascript\">
      var incotermsDb = {{ incoterms | raw }} ;
   </script>", "forms/frm-pedido.html.twig", "/var/www/html/app/src/views/forms/frm-pedido.html.twig");
    }
}
