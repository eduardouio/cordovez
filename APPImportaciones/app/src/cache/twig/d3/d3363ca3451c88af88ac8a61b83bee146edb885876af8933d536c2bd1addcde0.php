<?php

/* forms/frm_pedido.html.twig */
class __TwigTemplate_17bb47e4683eb3853188d303c9cde5e4d8bb6b588ce7877d5c765dedd09dd2bd extends Twig_Template
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
        echo "<form action=\"recibe.php\">
\t<div class=\"row\">
\t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Nro Pedido</label>
\t\t\t\t<input 
\t\t\t\tclass=\"form-control\" 
\t\t\t\ttype=\"text\"
\t\t\t\trequired=\"true\"
\t\t\t\tname=\"pedido.nro_pedido\"
\t\t\t\tng-model =\"pedido.nro_pedido\"
\t\t\t\t>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Régimen</label>
\t\t\t\t<select
\t\t\t\tclass=\"form-control\" 
\t\t\t\trequired=\"true\" 
\t\t\t\tname=\"pedido.regimen\"
\t\t\t\tng-model=\"pedido.regimen\"
\t\t\t\t>
\t\t\t\t<option value=\"\" disabled selected>Seleccione ...</option>
\t\t\t\t<option value=\"70\">Régimen 70</option>
\t\t\t\t<option value=\"10\">Régimen 10</option>
\t\t\t\t</select>
\t\t\t</div>
\t\t</div>
\t<div class=\"col-lg-2\">
      <div class=\"form-group\">
         <label >Incoterm</label>
         <select
            class = \"form-control\"
            name = \"ipedido.id_incoterm\"
            required=\"true\" 
            ng-model= \"ipedido.id_incoterm\"
            >
            <option value=\"\" disabled selected>Seleccione ...</option>
            <option value=\"CFR\">CFR</option>
            <option value=\"FCA\">FCA</option>
            <option value=\"FOB\">FOB</option>
            <option value=\"EXW\">EXW</option>
         </select>
      </div>
   </div>
   \t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Gastos Org\t (USD)</label>
\t\t\t\t<input 
\t\t\t\tclass=\"form-control\" 
\t\t\t\ttype=\"text\"
\t\t\t\trequired=\"true\"
\t\t\t\tname=\"pedido.tarifa_antes_fob\"
\t\t\t\tng-model =\"pedido.tarifa_antes_fob\"
\t\t\t\t>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Flete Intern (USD)</label>
\t\t\t\t<input 
\t\t\t\tclass=\"form-control\" 
\t\t\t\ttype=\"text\"
\t\t\t\trequired=\"true\"
\t\t\t\tname=\"pedido.nro_pedido\"
\t\t\t\tng-model =\"pedido.nro_pedido\"
\t\t\t\t>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>BL</label>
\t\t\t\t<input 
\t\t\t\tclass=\"form-control\" 
\t\t\t\ttype=\"text\"
\t\t\t\trequired=\"true\"
\t\t\t\tname=\"pedido.nro_pedido\"
\t\t\t\tng-model =\"pedido.nro_pedido\"
\t\t\t\t>
\t\t\t</div>
\t\t</div>
</div>

<input 
         type=\"hidden\" 
         name=\"pedido.id_user\"
         ng-model=\"pedido.id_user\"
         value=\"{[pedido.id_user]}\">
   <input 
         type=\"hidden\" 
         name=\"pedido.last_update\"
         ng-model=\"pedido.last_update\"
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
</form>
pedido.nro_referendo
pedido.costo_pedido
pedido.fele_aduana
pedido.seguro_aduana
pedido.fele_prepagado
pedido.estado_pedido
pedido.enviado_comtabilidad
pedido.fecha_envio
pedido.notas
pedido.date_create
pedido.peso_kgs";
    }

    public function getTemplateName()
    {
        return "forms/frm_pedido.html.twig";
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
        return new Twig_Source("<form action=\"recibe.php\">
\t<div class=\"row\">
\t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Nro Pedido</label>
\t\t\t\t<input 
\t\t\t\tclass=\"form-control\" 
\t\t\t\ttype=\"text\"
\t\t\t\trequired=\"true\"
\t\t\t\tname=\"pedido.nro_pedido\"
\t\t\t\tng-model =\"pedido.nro_pedido\"
\t\t\t\t>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Régimen</label>
\t\t\t\t<select
\t\t\t\tclass=\"form-control\" 
\t\t\t\trequired=\"true\" 
\t\t\t\tname=\"pedido.regimen\"
\t\t\t\tng-model=\"pedido.regimen\"
\t\t\t\t>
\t\t\t\t<option value=\"\" disabled selected>Seleccione ...</option>
\t\t\t\t<option value=\"70\">Régimen 70</option>
\t\t\t\t<option value=\"10\">Régimen 10</option>
\t\t\t\t</select>
\t\t\t</div>
\t\t</div>
\t<div class=\"col-lg-2\">
      <div class=\"form-group\">
         <label >Incoterm</label>
         <select
            class = \"form-control\"
            name = \"ipedido.id_incoterm\"
            required=\"true\" 
            ng-model= \"ipedido.id_incoterm\"
            >
            <option value=\"\" disabled selected>Seleccione ...</option>
            <option value=\"CFR\">CFR</option>
            <option value=\"FCA\">FCA</option>
            <option value=\"FOB\">FOB</option>
            <option value=\"EXW\">EXW</option>
         </select>
      </div>
   </div>
   \t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Gastos Org\t (USD)</label>
\t\t\t\t<input 
\t\t\t\tclass=\"form-control\" 
\t\t\t\ttype=\"text\"
\t\t\t\trequired=\"true\"
\t\t\t\tname=\"pedido.tarifa_antes_fob\"
\t\t\t\tng-model =\"pedido.tarifa_antes_fob\"
\t\t\t\t>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Flete Intern (USD)</label>
\t\t\t\t<input 
\t\t\t\tclass=\"form-control\" 
\t\t\t\ttype=\"text\"
\t\t\t\trequired=\"true\"
\t\t\t\tname=\"pedido.nro_pedido\"
\t\t\t\tng-model =\"pedido.nro_pedido\"
\t\t\t\t>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>BL</label>
\t\t\t\t<input 
\t\t\t\tclass=\"form-control\" 
\t\t\t\ttype=\"text\"
\t\t\t\trequired=\"true\"
\t\t\t\tname=\"pedido.nro_pedido\"
\t\t\t\tng-model =\"pedido.nro_pedido\"
\t\t\t\t>
\t\t\t</div>
\t\t</div>
</div>

<input 
         type=\"hidden\" 
         name=\"pedido.id_user\"
         ng-model=\"pedido.id_user\"
         value=\"{[pedido.id_user]}\">
   <input 
         type=\"hidden\" 
         name=\"pedido.last_update\"
         ng-model=\"pedido.last_update\"
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
</form>
pedido.nro_referendo
pedido.costo_pedido
pedido.fele_aduana
pedido.seguro_aduana
pedido.fele_prepagado
pedido.estado_pedido
pedido.enviado_comtabilidad
pedido.fecha_envio
pedido.notas
pedido.date_create
pedido.peso_kgs", "forms/frm_pedido.html.twig", "/var/www/html/app/app/views/forms/frm_pedido.html.twig");
    }
}
