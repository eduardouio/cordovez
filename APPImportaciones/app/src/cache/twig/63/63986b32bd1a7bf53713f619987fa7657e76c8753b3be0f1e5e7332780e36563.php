<?php

/* forms/frm_incoterms.html.twig */
class __TwigTemplate_3f38692332bc433c7d8a493c8d4d5129bd0f9b3a2dfb509af3a648c32e374663 extends Twig_Template
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
        echo "<form role=\"form\" action=\"";
        echo twig_escape_filter($this->env, ($context["actionFrm"] ?? null), "html", null, true);
        echo "\">
<div class=\"row\">
   <div class=\"col-lg-4\">
      <div class=\"form-group\">
         <label>Tipo</label>
         <select
            class = \"form-control\"
            name = \"incoterm.tipo\"
            required=\"true\" 
            ng-model= \"incoterm.tipo\"
            >
            <option value=\"\" disabled selected>Seleccione ...</option>
            <option value=\"FLETE\">FLETE</option>
            <option value=\"GASTO\">GASTO</option>
         </select>
      </div>
   </div>
   <div class=\"col-lg-4\">
      <div class=\"form-group\">
         <label>Pais </label>
         <input 
            type=\"text\"
            maxlength=\"45\" 
            required=\"true\" 
            class = \"form-control\"
            name = \"incoterm.pais\"
            ng-model= \"incoterm.pais\"
            />
      </div>
   </div>
   <div class=\"col-lg-4\">
      <div class=\"form-group\">
         <label>Ciudad</label>
         <input 
            type=\"text\"
            maxlength=\"45\" 
            required=\"true\" 
            class = \"form-control\"
            name = \"incoterm.ciudad\"
            ng-model= \"incoterm.ciudad\"
            />
      </div>
   </div>

</div>
<div class=\"row\">
   <div class=\"col-lg-4\">
      <div class=\"form-group\">
         <label >Incoterm</label>
         <select
            class = \"form-control\"
            name = \"incoterm.incoterms\"
            required=\"true\" 
            ng-model= \"incoterm.incoterms\"
            >
            <option value=\"\" disabled selected>Seleccione ...</option>
            <option value=\"CFR\">CFR</option>
            <option value=\"FCA\">FCA</option>
            <option value=\"FOB\">FOB</option>
            <option value=\"EXW\">EXW</option>
         </select>
      </div>
   </div>
   <div class=\"col-lg-3\">
      <div class=\"form-group\">
         <label>Tarifa (USD)</label>
         <input 
         class=\"form-control\"
         type=\"number\"
         step=\"0.001\"
         required=\"true\" 
         name= \"incoterm.tarifa\" 
         ng-model= \"incoterm.tarifa\" 
         />
      </div>
   </div>   

   <div class=\"col-lg-5\">
<div class=\"form-group\">
            <label>Notas</label>
            <textarea 
            class=\"form-control\"
            maxlength=\"120\" 
            name= \"incoterm.notas\" 
            ng-model= \"incoterm.notas\" 
            rows=\"2\"></textarea>
         </div>
   </div> 
</div>
   <input 
         type=\"hidden\" 
         name=\"incoterm.id_user\"
         ng-model=\"incoterm.id_user\"
         value=\"{[incoterm.id_user]}\">
   <input 
         type=\"hidden\" 
         name=\"incoterm.last_update\"
         ng-model=\"incoterm.last_update\"
         value=\"0000-00-00 00:00:00\">
   <div class=\"row\">
      <div class=\"col-lg-12\">
         <button type=\"submit\" class=\"btn btn-default\">
         <span class=\"fa fa-save fa-fw\"></span>
         Guardar Registro</button>
         <button type=\"reset\" class=\"btn btn-default\">
         <span class=\"fa fa-refresh fa-fw\"></span>
         Limpiar Formulario</button>
         <a class=\"btn btn-info pull-right\">
         <span class=\"fa fa-warning fa-fw\"></span>
         Cancelar </a>
      </div>
   </div>
</form>";
    }

    public function getTemplateName()
    {
        return "forms/frm_incoterms.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form role=\"form\" action=\"{{actionFrm}}\">
<div class=\"row\">
   <div class=\"col-lg-4\">
      <div class=\"form-group\">
         <label>Tipo</label>
         <select
            class = \"form-control\"
            name = \"incoterm.tipo\"
            required=\"true\" 
            ng-model= \"incoterm.tipo\"
            >
            <option value=\"\" disabled selected>Seleccione ...</option>
            <option value=\"FLETE\">FLETE</option>
            <option value=\"GASTO\">GASTO</option>
         </select>
      </div>
   </div>
   <div class=\"col-lg-4\">
      <div class=\"form-group\">
         <label>Pais </label>
         <input 
            type=\"text\"
            maxlength=\"45\" 
            required=\"true\" 
            class = \"form-control\"
            name = \"incoterm.pais\"
            ng-model= \"incoterm.pais\"
            />
      </div>
   </div>
   <div class=\"col-lg-4\">
      <div class=\"form-group\">
         <label>Ciudad</label>
         <input 
            type=\"text\"
            maxlength=\"45\" 
            required=\"true\" 
            class = \"form-control\"
            name = \"incoterm.ciudad\"
            ng-model= \"incoterm.ciudad\"
            />
      </div>
   </div>

</div>
<div class=\"row\">
   <div class=\"col-lg-4\">
      <div class=\"form-group\">
         <label >Incoterm</label>
         <select
            class = \"form-control\"
            name = \"incoterm.incoterms\"
            required=\"true\" 
            ng-model= \"incoterm.incoterms\"
            >
            <option value=\"\" disabled selected>Seleccione ...</option>
            <option value=\"CFR\">CFR</option>
            <option value=\"FCA\">FCA</option>
            <option value=\"FOB\">FOB</option>
            <option value=\"EXW\">EXW</option>
         </select>
      </div>
   </div>
   <div class=\"col-lg-3\">
      <div class=\"form-group\">
         <label>Tarifa (USD)</label>
         <input 
         class=\"form-control\"
         type=\"number\"
         step=\"0.001\"
         required=\"true\" 
         name= \"incoterm.tarifa\" 
         ng-model= \"incoterm.tarifa\" 
         />
      </div>
   </div>   

   <div class=\"col-lg-5\">
<div class=\"form-group\">
            <label>Notas</label>
            <textarea 
            class=\"form-control\"
            maxlength=\"120\" 
            name= \"incoterm.notas\" 
            ng-model= \"incoterm.notas\" 
            rows=\"2\"></textarea>
         </div>
   </div> 
</div>
   <input 
         type=\"hidden\" 
         name=\"incoterm.id_user\"
         ng-model=\"incoterm.id_user\"
         value=\"{[incoterm.id_user]}\">
   <input 
         type=\"hidden\" 
         name=\"incoterm.last_update\"
         ng-model=\"incoterm.last_update\"
         value=\"0000-00-00 00:00:00\">
   <div class=\"row\">
      <div class=\"col-lg-12\">
         <button type=\"submit\" class=\"btn btn-default\">
         <span class=\"fa fa-save fa-fw\"></span>
         Guardar Registro</button>
         <button type=\"reset\" class=\"btn btn-default\">
         <span class=\"fa fa-refresh fa-fw\"></span>
         Limpiar Formulario</button>
         <a class=\"btn btn-info pull-right\">
         <span class=\"fa fa-warning fa-fw\"></span>
         Cancelar </a>
      </div>
   </div>
</form>", "forms/frm_incoterms.html.twig", "/var/www/html/app/app/views/forms/frm_incoterms.html.twig");
    }
}
