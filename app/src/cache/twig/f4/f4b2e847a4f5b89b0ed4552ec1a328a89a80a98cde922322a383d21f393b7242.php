<?php

/* forms/frm-facturas-detalle.html.twig */
class __TwigTemplate_afce542c082949daca9e28e9d8d216cdce8ebf593784f9a6b8667cde1d68e0d8 extends Twig_Template
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
        echo "<div class=\"well well-sm\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Proveedor:</strong> <span>";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["document"] ?? null), "supplier", array()), "nombre", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Ruc:</strong> <span>";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["document"] ?? null), "supplier", array()), "identificacion_proveedor", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Fecha:</strong> <span>";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "fecha_emision", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-5\">
\t\t\t<strong>Comentarios:</strong> <span>";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "comentarios", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Valor \$:</strong> <span class=\"text-primary\">";
        // line 18
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["document"] ?? null), "valor", array()), 2, ",", "."), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Justificado \$:</strong> <span class=\"text-success\"> \$
\t\t\t\t";
        // line 22
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ",", "."), "html", null, true);
        echo "
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Pendiente \$:</strong> <span class=\"text-danger\"> \$ ";
        // line 26
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 0, ",", "."), "html", null, true);
        echo "
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Creado Por :</strong> <span>";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "nombres", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<span>";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "date_create", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t</div>
</div>
<br>
<div class=\"alert alert-info alert-dismissable\">
\t<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
\t<span class=\"fa fa-warning\"></span> Seleccione un pedido, luego en la
\tlista de <strong>Concepto</strong> una provision a justificar, se puede
\tjustificar de forma parcial o completamente el valor de una provisión.
</div>
<form action = \"";
        // line 44
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "detallefacpago/validar/\" method=\"post\">
\t<input type=\"hidden\" name=\"id_documento_pago\" value=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "id_documento_pago", array()), "html", null, true);
        echo "\">
\t<div class=\"row\">
\t\t<div class=\"col-md-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Nro Pedido</label> <select
\t\t\t\t\tclass=\"form-control\" id=\"nro_pedido\" autofocus=\"autofocus\">
\t\t\t\t\t<option selected=\"\" disabled=\"disabled\">Seleccione..</option>
\t\t\t\t\t";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["activeOrders"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 53
            echo "\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "\">
\t\t\t\t\t\t";
            // line 54
            echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "nro_pedido", array()), "html", null, true);
            echo "
\t\t\t\t\t</option>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        echo "\t\t\t\t</select>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-6\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label> Concepto: </label> <select class=\"form-control\"
\t\t\t\t\tname=\"id_gastos_nacionalizacion\" id=\"id_provision\">
\t\t\t\t\t<option selected=\"selected\" disabled=\"disabled\">Seleccione...</option>
\t\t\t\t</select>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label> Valor a Justificar USD </label> <input type=\"number\" name=\"valor\"
\t\t\t\t\tid=\"valor\" step=\"0.01\" required=\"required\" class=\"form-control\">
\t\t\t</div>
\t\t</div>

\t</div>
\t<div class=\"row\">
\t\t<div id=\"detalle_provision\">
\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-4 col-md-offset-8\">
\t\t\t<a
\t\t\t\thref=\"";
        // line 84
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "facturapagos/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "id_documento_pago", array()), "html", null, true);
        echo "\"
\t\t\t\tclass=\"btn btn-sm btn-default \"> <span class=\"fa fa-arrow-left\"></span>Volver
\t\t\t\ta la Factura [";
        // line 86
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "nro_factura", array()), "html", null, true);
        echo "]
\t\t\t</a>
\t\t\t&nbsp;&nbsp;&nbsp;
\t\t\t<button class=\"btn btn-sm btn-default\" type=\"submit\">
\t\t\t\t<span class=\"fa fa-save\"></span> Registrar Justificación
\t\t\t</button>
\t\t</div>
\t\t<br>
\t\t<br>

</form>
<br>
<script type=\"text/javascript\">

var orders = ";
        // line 100
        echo ($context["orders"] ?? null);
        echo ";
var list = {};
var provision = {};
var template = '';
var valor_provisionado = 0.0;
var valor_justificado = 0.0;
var por_justificar = 0.0;
var valor = 0;
var success = `<h3 class=\"text-success\">
\t\t\t\t\t<span class=\"fa fa-check\"></span>Provisión Justificada
\t\t\t\t</h3>`;
var pending = `<h3 class=\"text-danger\">
\t\t\t\t\t<span class=\"fa fa-warning\"></span> Provisión Incompleta
\t\t\t\t</h3>`;
var exceeded = `<h3 class=\"text-danger\">
\t\t\t\t\t<span class=\"fa fa-warning\"></span> Provisión Excedida.
\t\t\t\t</h3>`;


/**
 * Anade las provisiones a la lista del select
 */
function addExpenses(nroOrder){
\tlist = orders[nroOrder];

    \$('#id_provision').append(
                '<option selected=\"selected\" disabled=\"disabled\">Seleccione...</option> ');    
    \$.each(list, function(val, key){
        \$('#id_provision').append('<option value= \"' + key.id_gastos_nacionalizacion + '\"> ' + key.concepto +
        \t'   -->   \$ ' + key.valor_provisionado + '</option>');
    });
}

/**
* Muestra un div con el detalle de la provision
* @param int idProvision 
*/
function getProvision(idProvision){
\t\$.each(list, function(val, key){
\t\tif (key.id_gastos_nacionalizacion === idProvision){
\t\t\tshowProvision(key);
\t\t}
\t});
}

/**
* Muestra u oculpa una provision en la pantalla
* @param obj provision
*/
function showProvision(provision){
\tvalor_provisionado = parseFloat(provision.valor_provisionado);
\tvalor_justificado = 0.0;
\tpor_justificar = 0.0;

\tif(provision.justification === false ){
\t\tpor_justificar = (valor_provisionado);\t
\t}else{
\t\tvalor_justificado = parseFloat(provision.justification.sums);
\t\tpor_justificar = (valor_provisionado - valor_justificado);\t
\t}

\t
\ttemplate = `
<div class=\"col-md-6\">
\t\t\t<br>
\t\t\t\t<div class=\"text-tittle\">
\t\t\t\t\t<strong>DETALLE DE LA PROVISIÓN 
\t\t\t\t\t\t\t&nbsp;&nbsp;` + provision.id_gastos_nacionalizacion  +`</strong>
\t\t\t\t</div>
\t\t\t\t<table class=\"table table-hover table-striped table-condensed\">
\t\t\t\t\t<thead>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th>Detalle:</th>
\t\t\t\t\t\t\t<th>Valor:</th>
\t\t\t\t\t\t</tr>
\t\t\t\t\t</thead>
\t\t\t\t\t<tbody>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Id Registro&nbsp;</strong></td>
\t\t\t\t\t\t\t<td>` + provision.id_gastos_nacionalizacion + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Nro Pedido &nbsp;</strong></td>
\t\t\t\t\t\t\t<td> ` + provision.nro_pedido + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Concepto&nbsp;</strong></td>
\t\t\t\t\t\t\t<td class=\"success\">` + provision.concepto + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Valor
\t\t\t\t\t\t\t\t\tProvisionado&nbsp;</strong></td>
\t\t\t\t\t\t\t<td>\$ ` + provision.valor_provisionado + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Comentarios &nbsp;</strong></td>
\t\t\t\t\t\t\t<td>` + provision.comentarios +  `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Fecha &nbsp;</strong></td>
\t\t\t\t\t\t\t<td>`+  provision.fecha + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Fecha Hasta &nbsp;</strong></td>
\t\t\t\t\t\t\t<td>` + provision.fecha_fin + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Creado Por &nbsp;</strong></td>
\t\t\t\t\t\t\t<td> ` + provision.user.nombres +` </td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Fecha/Hora Registro
\t\t\t\t\t\t\t\t\t&nbsp;</strong></td>
\t\t\t\t\t\t\t<td>`+ provision.date_create  + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Ultima Actualización
\t\t\t\t\t\t\t\t\t&nbsp;</strong></td>
\t\t\t\t\t\t\t<td>`+ provision.last_update  + `</td>
\t\t\t\t\t\t</tr>\t\t\t\t\t</tbody>
\t\t\t\t</table>
\t\t\t</div>
\t\t<div class=\"col-md-6\">
\t\t\t<div class=\"text-center\">
\t\t\t\t<br>
\t\t\t\t<h1>
\t\t\t\t\tSaldo \$ <span id=\"saldo\">` +  por_justificar  +  `</span>
\t\t\t\t</h1>
\t\t\t\t<div id=\"status\">
\t\t\t\t</div>
\t\t\t\t<br>
\t\t\t\t<br>
\t\t\t\t<br>
\t\t\t\t<div class=\"row\" style=\"font-size:16px;\">
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t <strong> Provision: </strong> ` + 
\t\t\t\t\t provision.valor_provisionado + `
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t <strong> Justificado: </strong> ` + 
\t\t\t\t\t   valor_justificado  +`
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<strong> Por Justificar: </strong> ` +
\t\t\t\t\t  por_justificar + `
\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t`;
\t\$('#detalle_provision').append(template);
\t\$('#valor_provisionado').val(provision.valor_provisionado);
\t\$('#saldo').append(pending);
}

/**
* Comprueba el saldo de la justificacion
*/
\$('#valor').keyup(function(){
\tif (this.value === ''){
\t\tvalor = 0;
\t}else{
\t\tvalor = parseFloat(this.value);
\t}
\tvar saldo = Math.round((por_justificar - valor) *100)/100;
\t\$('#status').empty();
\t\$('#saldo').text(saldo.toString());
\tif (saldo < 0){
\t\t\$('#status').append(exceeded);
\t\t\$('#valor').val('0');
\t}
\tif (saldo === 0){
\t\t\$('#status').append(success);\t\t
\t}else{
\t\t\$('#status').append(pending);\t\t
\t}
})

/**
* Cambia el texto de saldo cuando se cambia una provision
*/
\$('#id_provision').change(function(){
\t\$('#detalle_provision').empty();
\tgetProvision(this.value);
});

\$('#nro_pedido').change(function(){
\t\$('#id_provision option').remove();
\t\$('#detalle_provision').empty();
\taddExpenses(this.value);
});

</script>

";
    }

    public function getTemplateName()
    {
        return "forms/frm-facturas-detalle.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 100,  159 => 86,  152 => 84,  123 => 57,  114 => 54,  109 => 53,  105 => 52,  95 => 45,  91 => 44,  77 => 33,  71 => 30,  64 => 26,  57 => 22,  50 => 18,  42 => 13,  36 => 10,  30 => 7,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"well well-sm\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Proveedor:</strong> <span>{{ document.supplier.nombre }}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Ruc:</strong> <span>{{ document.supplier.identificacion_proveedor }}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Fecha:</strong> <span>{{ document.fecha_emision  }}</span>
\t\t</div>
\t\t<div class=\"col-md-5\">
\t\t\t<strong>Comentarios:</strong> <span>{{ document.comentarios }}</span>
\t\t</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Valor \$:</strong> <span class=\"text-primary\">{{ document.valor | number_format(2,',','.')}}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Justificado \$:</strong> <span class=\"text-success\"> \$
\t\t\t\t{{ 0 | number_format(0,',','.') }}
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Pendiente \$:</strong> <span class=\"text-danger\"> \$ {{ 0 | number_format(0,',','.') }}
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Creado Por :</strong> <span>{{ user.nombres }}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<span>{{ document.date_create }}</span>
\t\t</div>
\t</div>
</div>
<br>
<div class=\"alert alert-info alert-dismissable\">
\t<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
\t<span class=\"fa fa-warning\"></span> Seleccione un pedido, luego en la
\tlista de <strong>Concepto</strong> una provision a justificar, se puede
\tjustificar de forma parcial o completamente el valor de una provisión.
</div>
<form action = \"{{ rute_url }}detallefacpago/validar/\" method=\"post\">
\t<input type=\"hidden\" name=\"id_documento_pago\" value=\"{{document.id_documento_pago}}\">
\t<div class=\"row\">
\t\t<div class=\"col-md-2\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label>Nro Pedido</label> <select
\t\t\t\t\tclass=\"form-control\" id=\"nro_pedido\" autofocus=\"autofocus\">
\t\t\t\t\t<option selected=\"\" disabled=\"disabled\">Seleccione..</option>
\t\t\t\t\t{% for order in activeOrders %}
\t\t\t\t\t<option value=\"{{ order.nro_pedido }}\">
\t\t\t\t\t\t{{ order.nro_pedido }}
\t\t\t\t\t</option>
\t\t\t\t\t{% endfor %}
\t\t\t\t</select>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-6\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label> Concepto: </label> <select class=\"form-control\"
\t\t\t\t\tname=\"id_gastos_nacionalizacion\" id=\"id_provision\">
\t\t\t\t\t<option selected=\"selected\" disabled=\"disabled\">Seleccione...</option>
\t\t\t\t</select>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<div class=\"form-group\">
\t\t\t\t<label> Valor a Justificar USD </label> <input type=\"number\" name=\"valor\"
\t\t\t\t\tid=\"valor\" step=\"0.01\" required=\"required\" class=\"form-control\">
\t\t\t</div>
\t\t</div>

\t</div>
\t<div class=\"row\">
\t\t<div id=\"detalle_provision\">
\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-4 col-md-offset-8\">
\t\t\t<a
\t\t\t\thref=\"{{rute_url}}facturapagos/presentar/{{document.id_documento_pago}}\"
\t\t\t\tclass=\"btn btn-sm btn-default \"> <span class=\"fa fa-arrow-left\"></span>Volver
\t\t\t\ta la Factura [{{document.nro_factura}}]
\t\t\t</a>
\t\t\t&nbsp;&nbsp;&nbsp;
\t\t\t<button class=\"btn btn-sm btn-default\" type=\"submit\">
\t\t\t\t<span class=\"fa fa-save\"></span> Registrar Justificación
\t\t\t</button>
\t\t</div>
\t\t<br>
\t\t<br>

</form>
<br>
<script type=\"text/javascript\">

var orders = {{orders |raw }};
var list = {};
var provision = {};
var template = '';
var valor_provisionado = 0.0;
var valor_justificado = 0.0;
var por_justificar = 0.0;
var valor = 0;
var success = `<h3 class=\"text-success\">
\t\t\t\t\t<span class=\"fa fa-check\"></span>Provisión Justificada
\t\t\t\t</h3>`;
var pending = `<h3 class=\"text-danger\">
\t\t\t\t\t<span class=\"fa fa-warning\"></span> Provisión Incompleta
\t\t\t\t</h3>`;
var exceeded = `<h3 class=\"text-danger\">
\t\t\t\t\t<span class=\"fa fa-warning\"></span> Provisión Excedida.
\t\t\t\t</h3>`;


/**
 * Anade las provisiones a la lista del select
 */
function addExpenses(nroOrder){
\tlist = orders[nroOrder];

    \$('#id_provision').append(
                '<option selected=\"selected\" disabled=\"disabled\">Seleccione...</option> ');    
    \$.each(list, function(val, key){
        \$('#id_provision').append('<option value= \"' + key.id_gastos_nacionalizacion + '\"> ' + key.concepto +
        \t'   -->   \$ ' + key.valor_provisionado + '</option>');
    });
}

/**
* Muestra un div con el detalle de la provision
* @param int idProvision 
*/
function getProvision(idProvision){
\t\$.each(list, function(val, key){
\t\tif (key.id_gastos_nacionalizacion === idProvision){
\t\t\tshowProvision(key);
\t\t}
\t});
}

/**
* Muestra u oculpa una provision en la pantalla
* @param obj provision
*/
function showProvision(provision){
\tvalor_provisionado = parseFloat(provision.valor_provisionado);
\tvalor_justificado = 0.0;
\tpor_justificar = 0.0;

\tif(provision.justification === false ){
\t\tpor_justificar = (valor_provisionado);\t
\t}else{
\t\tvalor_justificado = parseFloat(provision.justification.sums);
\t\tpor_justificar = (valor_provisionado - valor_justificado);\t
\t}

\t
\ttemplate = `
<div class=\"col-md-6\">
\t\t\t<br>
\t\t\t\t<div class=\"text-tittle\">
\t\t\t\t\t<strong>DETALLE DE LA PROVISIÓN 
\t\t\t\t\t\t\t&nbsp;&nbsp;` + provision.id_gastos_nacionalizacion  +`</strong>
\t\t\t\t</div>
\t\t\t\t<table class=\"table table-hover table-striped table-condensed\">
\t\t\t\t\t<thead>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th>Detalle:</th>
\t\t\t\t\t\t\t<th>Valor:</th>
\t\t\t\t\t\t</tr>
\t\t\t\t\t</thead>
\t\t\t\t\t<tbody>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Id Registro&nbsp;</strong></td>
\t\t\t\t\t\t\t<td>` + provision.id_gastos_nacionalizacion + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Nro Pedido &nbsp;</strong></td>
\t\t\t\t\t\t\t<td> ` + provision.nro_pedido + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Concepto&nbsp;</strong></td>
\t\t\t\t\t\t\t<td class=\"success\">` + provision.concepto + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Valor
\t\t\t\t\t\t\t\t\tProvisionado&nbsp;</strong></td>
\t\t\t\t\t\t\t<td>\$ ` + provision.valor_provisionado + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Comentarios &nbsp;</strong></td>
\t\t\t\t\t\t\t<td>` + provision.comentarios +  `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Fecha &nbsp;</strong></td>
\t\t\t\t\t\t\t<td>`+  provision.fecha + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Fecha Hasta &nbsp;</strong></td>
\t\t\t\t\t\t\t<td>` + provision.fecha_fin + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Creado Por &nbsp;</strong></td>
\t\t\t\t\t\t\t<td> ` + provision.user.nombres +` </td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Fecha/Hora Registro
\t\t\t\t\t\t\t\t\t&nbsp;</strong></td>
\t\t\t\t\t\t\t<td>`+ provision.date_create  + `</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td class=\"text-right\"><strong>Ultima Actualización
\t\t\t\t\t\t\t\t\t&nbsp;</strong></td>
\t\t\t\t\t\t\t<td>`+ provision.last_update  + `</td>
\t\t\t\t\t\t</tr>\t\t\t\t\t</tbody>
\t\t\t\t</table>
\t\t\t</div>
\t\t<div class=\"col-md-6\">
\t\t\t<div class=\"text-center\">
\t\t\t\t<br>
\t\t\t\t<h1>
\t\t\t\t\tSaldo \$ <span id=\"saldo\">` +  por_justificar  +  `</span>
\t\t\t\t</h1>
\t\t\t\t<div id=\"status\">
\t\t\t\t</div>
\t\t\t\t<br>
\t\t\t\t<br>
\t\t\t\t<br>
\t\t\t\t<div class=\"row\" style=\"font-size:16px;\">
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t <strong> Provision: </strong> ` + 
\t\t\t\t\t provision.valor_provisionado + `
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t <strong> Justificado: </strong> ` + 
\t\t\t\t\t   valor_justificado  +`
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<strong> Por Justificar: </strong> ` +
\t\t\t\t\t  por_justificar + `
\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t`;
\t\$('#detalle_provision').append(template);
\t\$('#valor_provisionado').val(provision.valor_provisionado);
\t\$('#saldo').append(pending);
}

/**
* Comprueba el saldo de la justificacion
*/
\$('#valor').keyup(function(){
\tif (this.value === ''){
\t\tvalor = 0;
\t}else{
\t\tvalor = parseFloat(this.value);
\t}
\tvar saldo = Math.round((por_justificar - valor) *100)/100;
\t\$('#status').empty();
\t\$('#saldo').text(saldo.toString());
\tif (saldo < 0){
\t\t\$('#status').append(exceeded);
\t\t\$('#valor').val('0');
\t}
\tif (saldo === 0){
\t\t\$('#status').append(success);\t\t
\t}else{
\t\t\$('#status').append(pending);\t\t
\t}
})

/**
* Cambia el texto de saldo cuando se cambia una provision
*/
\$('#id_provision').change(function(){
\t\$('#detalle_provision').empty();
\tgetProvision(this.value);
});

\$('#nro_pedido').change(function(){
\t\$('#id_provision option').remove();
\t\$('#detalle_provision').empty();
\taddExpenses(this.value);
});

</script>

", "forms/frm-facturas-detalle.html.twig", "/var/www/html/app/src/views/forms/frm-facturas-detalle.html.twig");
    }
}
