<?php

/* forms/frm-gasto-inicial-edit.html.twig */
class __TwigTemplate_9497fa7932e2b52985d20c254691f9011bbbf8b04e2f12cffdf34696254bec54 extends Twig_Template
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
\t<input type=\"hidden\" name=\"id_gastos_nacionalizacion\" value=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "id_gastos_nacionalizacion", array()), "html", null, true);
        echo "\">
<div class=\"row\">
\t<div class=\"col-sm-1\">
\t\t<div class=\"form-group\">
\t\t\t<label>Pedido</label>
\t\t\t<input 
\t\t\ttype=\"text\" 
\t\t\tclass=\"form-control\" 
\t\t\tname=\"nro_pedido\"
\t\t\tvalue=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
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
\t\t\t\t<option value=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "identificacion_proveedor", array()), "html", null, true);
        echo "\"> ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "nombre", array()), "html", null, true);
        echo " </option>
\t\t\t\t";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["suppliers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["supplier"]) {
            // line 26
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
        // line 28
        echo "\t\t\t</select>
\t\t</div>
\t</div>

\t<div class=\"col-sm-4\">
\t\t<div class=\"form-group\">
\t\t\t<label>Concepto</label>
\t\t\t<input 
\t\t\ttype=\"text\" 
\t\t\tclass=\"form-control\" 
\t\t\tname=\"concepto\"
\t\t\tid=\"concepto\"
\t\t\tmaxlength=\"45\"
\t\t\tvalue=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "concepto", array()), "html", null, true);
        echo "\" 
\t\t\treadonly=\"true\" 
\t\t\t>
\t\t</div>
\t</div>
<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Fecha</label>
\t\t\t         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha\" 
               required=\"required\" 
               name=\"fecha\" 
               class=\"bootstrap-datepicker\" 
               value=\"";
        // line 57
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "fecha", array()), "d/m/Y"), "html", null, true);
        echo "\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
\t\t</div>
\t</div>\t
</div>

<div class=\"row\">
\t<div id=\"hasta\" style=\"display: none;\">\t</div>
\t<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Provisión (USD)</label>
\t\t\t<input 
\t\t\tclass=\"form-control\" 
\t\t\ttype=\"number\" 
\t\t\tstep=\"0.01\" 
\t\t\tname=\"valor_provisionado\"
\t\t\tvalue=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "valor_provisionado", array()), "html", null, true);
        echo "\" 
\t\t\t>
\t\t</div>
\t</div>

\t<div class=\"col-sm-8\">
\t\t<div class=\"form-group\">
\t\t\t<label>Comentarios</label>
\t\t\t<textarea 
\t\t\tname=\"comentarios\" 
\t\t\trows=\"1\" 
\t\t\tid=\"comentarios\" 
\t\t\tclass=\"form-control\"
\t\t\tmaxlength=\"250\">";
        // line 90
        echo $this->getAttribute(($context["initExpense"] ?? null), "comentarios", array());
        echo "</textarea>
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
        // line 101
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Regresar Pedido <b>(";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo ") </b>
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">

\t\$('#comentarios').keyup(function(){
\t\tthis.value = this.value.toUpperCase();
\t});

\tvar newInput = `<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Fecha (Hasta)</label>
\t\t\t <div class=\"input-group\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_fin\" 
               required=\"required\" 
               name=\"fecha_fin\" 
               value=\"";
        // line 124
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["initExpense"] ?? null), "fecha_fin", array()), "m/d/Y"), "html", null, true);
        echo "\"
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
\t\t</div>
\t</div>
\t`;

\tcheckDates();

\tfunction checkDates() {
\t\tvar concepto = \$('#concepto').val();

\t\tif (( concepto === 'ALMACENAJE INICIAL') ||
\t\t\t   ( concepto === 'ALMACENAJE ALMAGRO') ||
\t\t\t   ( concepto === 'DEMORAJE')
\t\t\t  ){

\t\t\t\$('#hasta').append(newInput).fadeIn('slow');
\t\t\t\$('#fecha_fin').datepicker({
    \t\t\tlanguage: \"es\",
    \t\t\tdaysOfWeekHighlighted: \"1\"
\t\t\t\t\t});
\t\t}};
</script>";
    }

    public function getTemplateName()
    {
        return "forms/frm-gasto-inicial-edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  191 => 124,  167 => 103,  160 => 101,  146 => 90,  130 => 77,  107 => 57,  88 => 41,  73 => 28,  62 => 26,  58 => 25,  52 => 24,  36 => 11,  24 => 2,  19 => 1,);
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
\t<input type=\"hidden\" name=\"id_gastos_nacionalizacion\" value=\"{{initExpense.id_gastos_nacionalizacion}}\">
<div class=\"row\">
\t<div class=\"col-sm-1\">
\t\t<div class=\"form-group\">
\t\t\t<label>Pedido</label>
\t\t\t<input 
\t\t\ttype=\"text\" 
\t\t\tclass=\"form-control\" 
\t\t\tname=\"nro_pedido\"
\t\t\tvalue=\"{{order.nro_pedido}}\" 
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
\t\t\t\t<option value=\"{{supplier.identificacion_proveedor}}\"> {{supplier.nombre}} </option>
\t\t\t\t{% for supplier in suppliers %}
\t\t\t\t\t<option value = \"{{ supplier.identificacion_proveedor }}\"> {{supplier.nombre}}</option>
\t\t\t\t{% endfor %}
\t\t\t</select>
\t\t</div>
\t</div>

\t<div class=\"col-sm-4\">
\t\t<div class=\"form-group\">
\t\t\t<label>Concepto</label>
\t\t\t<input 
\t\t\ttype=\"text\" 
\t\t\tclass=\"form-control\" 
\t\t\tname=\"concepto\"
\t\t\tid=\"concepto\"
\t\t\tmaxlength=\"45\"
\t\t\tvalue=\"{{ initExpense.concepto }}\" 
\t\t\treadonly=\"true\" 
\t\t\t>
\t\t</div>
\t</div>
<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Fecha</label>
\t\t\t         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha\" 
               required=\"required\" 
               name=\"fecha\" 
               class=\"bootstrap-datepicker\" 
               value=\"{{ initExpense.fecha | date ('d/m/Y')}}\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
\t\t</div>
\t</div>\t
</div>

<div class=\"row\">
\t<div id=\"hasta\" style=\"display: none;\">\t</div>
\t<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Provisión (USD)</label>
\t\t\t<input 
\t\t\tclass=\"form-control\" 
\t\t\ttype=\"number\" 
\t\t\tstep=\"0.01\" 
\t\t\tname=\"valor_provisionado\"
\t\t\tvalue=\"{{ initExpense.valor_provisionado }}\" 
\t\t\t>
\t\t</div>
\t</div>

\t<div class=\"col-sm-8\">
\t\t<div class=\"form-group\">
\t\t\t<label>Comentarios</label>
\t\t\t<textarea 
\t\t\tname=\"comentarios\" 
\t\t\trows=\"1\" 
\t\t\tid=\"comentarios\" 
\t\t\tclass=\"form-control\"
\t\t\tmaxlength=\"250\">{{initExpense.comentarios | raw}}</textarea>
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
      <a href=\"{{rute_url}}pedido/presentar/{{order.nro_pedido}}\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Regresar Pedido <b>({{order.nro_pedido}}) </b>
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">

\t\$('#comentarios').keyup(function(){
\t\tthis.value = this.value.toUpperCase();
\t});

\tvar newInput = `<div class=\"col-sm-2\">
\t\t<div class=\"form-group\">
\t\t\t<label>Fecha (Hasta)</label>
\t\t\t <div class=\"input-group\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_fin\" 
               required=\"required\" 
               name=\"fecha_fin\" 
               value=\"{{ initExpense.fecha_fin | date ('m/d/Y')}}\"
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
\t\t</div>
\t</div>
\t`;

\tcheckDates();

\tfunction checkDates() {
\t\tvar concepto = \$('#concepto').val();

\t\tif (( concepto === 'ALMACENAJE INICIAL') ||
\t\t\t   ( concepto === 'ALMACENAJE ALMAGRO') ||
\t\t\t   ( concepto === 'DEMORAJE')
\t\t\t  ){

\t\t\t\$('#hasta').append(newInput).fadeIn('slow');
\t\t\t\$('#fecha_fin').datepicker({
    \t\t\tlanguage: \"es\",
    \t\t\tdaysOfWeekHighlighted: \"1\"
\t\t\t\t\t});
\t\t}};
</script>", "forms/frm-gasto-inicial-edit.html.twig", "/var/www/html/app/src/views/forms/frm-gasto-inicial-edit.html.twig");
    }
}
