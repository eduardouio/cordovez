<?php

/* forms/frm-gasto-inicial.html.twig */
class __TwigTemplate_81df2b0625591481da16a2966e825c9ae4d163d5a11291f993ce1141f39b4672 extends Twig_Template
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
        echo "<form action=\"";
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "gstinicial/validar\" method=\"post\">
<div class=\"row\">
\t<div class=\"col-sm-1\">
\t\t<div class=\"form-group\">
\t\t\t<label>Pedido</label>
\t\t\t<input 
\t\t\ttype=\"text\" 
\t\t\tclass=\"form-control\" 
\t\t\tname=\"nro_pedido\"
\t\t\tvalue=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo "\" 
\t\t\treadonly=\"true\" 
\t\t\t>
\t\t</div>
\t</div>

\t<div class=\"col-sm-5\">
\t\t<div class=\"form-group\">
\t\t\t<label>Proveedor</label>
\t\t\t<select
\t\t\tname = \"identificacion_proveedor\"
\t\t\tclass = \"form-control\"
\t\t\t>
\t\t\t\t<option selected=\"\" disabled=\"\">Seleccione...</option>
\t\t\t\t";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["suppliers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["supplier"]) {
            // line 25
            echo "\t\t\t\t\t<option value = \"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "identificacion_proveedor", array()), "html", null, true);
            echo "\"> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "nombre", array()), "html", null, true);
            echo "</option>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['supplier'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "\t\t\t</select>
\t\t</div>
\t</div>

\t<div class=\"col-sm-4\">
\t\t<div class=\"form-group\">
\t\t\t<label>Concepto</label>
\t\t\t<select
\t\t\ttype=\"text\" 
\t\t\tclass=\"form-control\" 
\t\t\tid=\"concepto\"
\t\t\tname=\"concepto\"
\t\t\t>
\t\t\t<option disabled=\"\" selected=\"\">Seleccione...</option>
\t\t\t<option value=\"FLETE\">FLETE</option>
\t\t\t<option value=\"GASTO ORIGEN\">GASTO ORIGEN</option>
\t\t\t<option value=\"ISD\">ISD</option>
\t\t\t<option value=\"OTROS GASTOS NAVIEROS\">OTROS GASTOS NAVIEROS</option>
\t\t\t<option value=\"ALMACENAJE  INICIAL\">ALMACENAJE  INICIAL</option>
\t\t\t<option value=\"CUSTODIA\">CUSTODIA</option>
\t\t\t<option value=\"TRANSPORTE INTERNO \">TRANSPORTE INTERNO </option>
\t\t\t<option value=\"AGENTE \">AGENTE </option>
\t\t\t<option value=\"DESCARGA\">DESCARGA</option>
\t\t\t<option value=\"TASA DE CONTROL AEROPORTUARIA\">TASA DE CONTROL AEROPORTUARIA</option>
\t\t\t<option value=\"CANDADO SATELITAL\">CANDADO SATELITAL</option>
\t\t\t<option value=\"DEMORAJE\">DEMORAJE</option>
\t\t\t<option value=\"OTROS\">OTROS</option>
\t\t</select>
\t\t</div>
\t</div>
<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Fecha (Desde)</label>
\t\t\t         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha\" 
               required=\"required\" 
               name=\"fecha\" 
               class=\"bootstrap-datepicker\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
\t\t</div>
\t</div>\t
</div>

<div class=\"row\">

\t<div id=\"hasta\" style=\"display: none;\">
\t\t
\t</div>

\t<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Provisión (USD)</label>
\t\t\t<input 
\t\t\tclass=\"form-control\" 
\t\t\ttype=\"number\" 
\t\t\tstep=\"0.01\" 
\t\t\tname=\"valor_provisionado\"
\t\t\t>
\t\t</div>
\t</div>

\t<div class=\"col-sm-8\">
\t\t<div class=\"form-group\">
\t\t\t<label>Comentarios</label>
\t\t\t<textarea 
\t\t\tname=\"comentarios\" 
\t\t\tid=\"comentarios\" 
\t\t\tclass=\"form-control\"
\t\t\trows=\"1\" 
\t\t\tmaxlength=\"250\"></textarea>
\t\t</div>
\t</div>
</div>
   <div class=\"row\">
      <div class=\"col-md-12\">
         <hr>
         <button type=\"submit\" class=\"btn btn-sm btn-default\" >
            <span class=\"fa fa-save fa-fw\"></span>
            Guardar Registro
         </button>
      <a href=\"";
        // line 114
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Regresar Pedido <b>(";
        // line 116
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["order"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo ") </b>
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">

\t\$('#comentarios').keyup(function(){
\t\tthis.value = this.value.toUpperCase();
\t});

\tvar newInput = `<div class=\"col-sm-2\" id=\"date_end\">
\t\t<div class=\"form-group\">
\t\t\t<label>Fecha (Hasta)</label>
\t\t\t <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_fin\" 
               required=\"required\" 
               name=\"fecha_fin\" 
               class=\"bootstrap-datepicker\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
\t\t</div>
\t</div>`
\t
\t\tvar usedExpenses = ";
        // line 146
        echo ($context["used_expenses"] ?? null);
        echo " ;\t\t

\t\t\$.each(usedExpenses, function(key, value){
\t\t\tif(\$(\"#concepto option[value='\" + value.concepto + \"'\").val() != 'ALMACENAJE  INICIAL'){
\t\t\t\t\$(\"#concepto option[value='\" + value.concepto + \"'\").remove();
\t\t\t}
\t\t});

\t\$('#concepto').change(function(){
\t\tif ( \$(this).val() === 'ALMACENAJE  INICIAL'){
\t\t\t\$('#hasta').append(newInput).fadeIn('slow');
\t\t}else{
\t\t\t\$('#date_end').remove().fadeIn('slow');
\t\t}\t});

</script>

";
    }

    public function getTemplateName()
    {
        return "forms/frm-gasto-inicial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 146,  160 => 116,  153 => 114,  64 => 27,  53 => 25,  49 => 24,  32 => 10,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form action=\"{{rute_url}}gstinicial/validar\" method=\"post\">
<div class=\"row\">
\t<div class=\"col-sm-1\">
\t\t<div class=\"form-group\">
\t\t\t<label>Pedido</label>
\t\t\t<input 
\t\t\ttype=\"text\" 
\t\t\tclass=\"form-control\" 
\t\t\tname=\"nro_pedido\"
\t\t\tvalue=\"{{order[0].nro_pedido}}\" 
\t\t\treadonly=\"true\" 
\t\t\t>
\t\t</div>
\t</div>

\t<div class=\"col-sm-5\">
\t\t<div class=\"form-group\">
\t\t\t<label>Proveedor</label>
\t\t\t<select
\t\t\tname = \"identificacion_proveedor\"
\t\t\tclass = \"form-control\"
\t\t\t>
\t\t\t\t<option selected=\"\" disabled=\"\">Seleccione...</option>
\t\t\t\t{% for supplier in suppliers %}
\t\t\t\t\t<option value = \"{{ supplier.identificacion_proveedor }}\"> {{supplier.nombre}}</option>
\t\t\t\t{% endfor %}
\t\t\t</select>
\t\t</div>
\t</div>

\t<div class=\"col-sm-4\">
\t\t<div class=\"form-group\">
\t\t\t<label>Concepto</label>
\t\t\t<select
\t\t\ttype=\"text\" 
\t\t\tclass=\"form-control\" 
\t\t\tid=\"concepto\"
\t\t\tname=\"concepto\"
\t\t\t>
\t\t\t<option disabled=\"\" selected=\"\">Seleccione...</option>
\t\t\t<option value=\"FLETE\">FLETE</option>
\t\t\t<option value=\"GASTO ORIGEN\">GASTO ORIGEN</option>
\t\t\t<option value=\"ISD\">ISD</option>
\t\t\t<option value=\"OTROS GASTOS NAVIEROS\">OTROS GASTOS NAVIEROS</option>
\t\t\t<option value=\"ALMACENAJE  INICIAL\">ALMACENAJE  INICIAL</option>
\t\t\t<option value=\"CUSTODIA\">CUSTODIA</option>
\t\t\t<option value=\"TRANSPORTE INTERNO \">TRANSPORTE INTERNO </option>
\t\t\t<option value=\"AGENTE \">AGENTE </option>
\t\t\t<option value=\"DESCARGA\">DESCARGA</option>
\t\t\t<option value=\"TASA DE CONTROL AEROPORTUARIA\">TASA DE CONTROL AEROPORTUARIA</option>
\t\t\t<option value=\"CANDADO SATELITAL\">CANDADO SATELITAL</option>
\t\t\t<option value=\"DEMORAJE\">DEMORAJE</option>
\t\t\t<option value=\"OTROS\">OTROS</option>
\t\t</select>
\t\t</div>
\t</div>
<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Fecha (Desde)</label>
\t\t\t         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha\" 
               required=\"required\" 
               name=\"fecha\" 
               class=\"bootstrap-datepicker\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
\t\t</div>
\t</div>\t
</div>

<div class=\"row\">

\t<div id=\"hasta\" style=\"display: none;\">
\t\t
\t</div>

\t<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Provisión (USD)</label>
\t\t\t<input 
\t\t\tclass=\"form-control\" 
\t\t\ttype=\"number\" 
\t\t\tstep=\"0.01\" 
\t\t\tname=\"valor_provisionado\"
\t\t\t>
\t\t</div>
\t</div>

\t<div class=\"col-sm-8\">
\t\t<div class=\"form-group\">
\t\t\t<label>Comentarios</label>
\t\t\t<textarea 
\t\t\tname=\"comentarios\" 
\t\t\tid=\"comentarios\" 
\t\t\tclass=\"form-control\"
\t\t\trows=\"1\" 
\t\t\tmaxlength=\"250\"></textarea>
\t\t</div>
\t</div>
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
            Regresar Pedido <b>({{order[0].nro_pedido}}) </b>
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">

\t\$('#comentarios').keyup(function(){
\t\tthis.value = this.value.toUpperCase();
\t});

\tvar newInput = `<div class=\"col-sm-2\" id=\"date_end\">
\t\t<div class=\"form-group\">
\t\t\t<label>Fecha (Hasta)</label>
\t\t\t <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_fin\" 
               required=\"required\" 
               name=\"fecha_fin\" 
               class=\"bootstrap-datepicker\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
\t\t</div>
\t</div>`
\t
\t\tvar usedExpenses = {{ used_expenses | raw }} ;\t\t

\t\t\$.each(usedExpenses, function(key, value){
\t\t\tif(\$(\"#concepto option[value='\" + value.concepto + \"'\").val() != 'ALMACENAJE  INICIAL'){
\t\t\t\t\$(\"#concepto option[value='\" + value.concepto + \"'\").remove();
\t\t\t}
\t\t});

\t\$('#concepto').change(function(){
\t\tif ( \$(this).val() === 'ALMACENAJE  INICIAL'){
\t\t\t\$('#hasta').append(newInput).fadeIn('slow');
\t\t}else{
\t\t\t\$('#date_end').remove().fadeIn('slow');
\t\t}\t});

</script>

", "forms/frm-gasto-inicial.html.twig", "/var/www/html/app/src/views/forms/frm-gasto-inicial.html.twig");
    }
}
