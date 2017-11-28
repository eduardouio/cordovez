<?php

/* forms/frm-factura-informativa.html.twig */
class __TwigTemplate_0130994cf6b0821393108ae62706fef485515a3b25937d01c28e9020649b67ed extends Twig_Template
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
        $context["valFob"] = 0;
        // line 2
        $context["valInformativas"] = 0;
        // line 3
        $context["parcials"] = 0;
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoices"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 5
            echo "    ";
            $context["valFob"] = (($context["valFob"] ?? null) + ($this->getAttribute($this->getAttribute($this->getAttribute(            // line 6
$context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array()) * $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "tasa_change", array())));
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["infoInvoices"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["infoInvoice"]) {
            // line 9
            echo "    ";
            $context["parcials"] = (($context["parcials"] ?? null) + 1);
            // line 10
            echo "    ";
            $context["valInformativas"] = (($context["valInformativas"] ?? null) + ($this->getAttribute(            // line 11
$context["infoInvoice"], "valor", array()) * $this->getAttribute($context["infoInvoice"], "tipo_cambio", array())));
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['infoInvoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "  <div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Saldo FOB:</strong>
         <span class=\"fa fa-usd\"></span>
         <strong class=\"text-primary\">
         ";
        // line 20
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (($context["valFob"] ?? null) - ($context["valInformativas"] ?? null)), 2, ".", ","), "html", null, true);
        echo "
         </strong>  
      </div>
       <div class=\"col-sm-2\">
           <strong>Parciales:</strong>
           <span class=\"text-primary\">
           <strong>";
        // line 26
        echo twig_escape_filter($this->env, ($context["parcials"] ?? null), "html", null, true);
        echo "</strong>
               <span class=\"fa fa-arrow-right\"></span>
               [ \$ ";
        // line 28
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["valInformativas"] ?? null), 2, ",", "."), "html", null, true);
        echo " ]
           </span>
       </div>
      <div class=\"col-sm-2\">
         <strong>
         Nro Pedido:</strong> 
         <span class=\"text-primary\">
         ";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>
         Regimen:</strong> 
         <span class=\"text-primary\">
         <strong class=\"text-primary\">
         ";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "regimen", array()), "html", null, true);
        echo "
         </strong>   
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Fecha Registro:</strong> 
         <span class=\"text-primary\">
         ";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "date_create", array()), "html", null, true);
        echo "            
         </span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Tiempo Bodega:</strong>
          <span class=\"text-primary\">
              ";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute(($context["warehouseDays"] ?? null), "days", array()), "html", null, true);
        echo " dias
          </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>P. Origen:</strong> 
         <span class=\"text-primary\">
         ";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "pais_origen", array()), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>C Origen:</strong> 
         <span class=\"text-primary\">
         ";
        // line 71
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "ciudad_origen", array()), "html", null, true);
        echo "            
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Incoterm:</strong> 
         <span class=\"text-primary\">
         ";
        // line 77
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "incoterm", array()), "html", null, true);
        echo "
         </span>         
      </div>
      <div class=\"col-sm-2\">
         <strong>Creado Por:</strong> 
         <span>";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "nombres", array(), "array"), "html", null, true);
        echo "
         </span>
      </div>
   </div>
</div>
<br>
<br>
<form method=\"post\" action=\"";
        // line 89
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "facinformativa/validar/\">
  <div class=\"row\">
    <div class=\"col-md-1\">
       <div class=\"form-group\">
      <label>Pedido</label>
      <input 
      readonly=\"\" 
      type=\"text\" 
      name=\"nro_pedido\"
      class=\"form-control\" 
      value=\"";
        // line 99
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" 
      >
    </div>
    </div>
    <div class=\"col-md-2\">
    <div class=\"form-group\">
      <label>Nro Factura</label>
      <input 
      type=\"text\" 
      name=\"nro_factura_informativa\"
      class=\"form-control\" 
      autofocus=\"autofocus\" 
      required=\"required\" 
      >
    </div>
    </div>
    <div class=\"col-md-3\">
      <div class=\"form-group\">
      <label>Proveedor</label>
    <select
    name=\"identificacion_proveedor\"
    class=\"form-control\"
    required = \"required\"
    > 
    <option value=\"";
        // line 123
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "identificacion_proveedor", array()), "html", null, true);
        echo "\"> ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "nombre", array()), "html", null, true);
        echo " </option>
    </select>
    </div>
    </div>
        <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Fecha Emisión</label>
        <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_emision\" 
               required=\"required\" 
               name=\"fecha_emision\" 
               class=\"bootstrap-datepicker\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
      </div>
    </div>
    <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Seguro Aduana <small><b>USD</b></small>
        </label>
        <input 
        type=\"number\" 
        name=\"seguro_aduana\"
        class=\"form-control\" 
        step=\"0.01\" 
        required=\"required\" 
        >
      </div>
    </div>
    <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Felte Aduana <small><b>USD</b></small>
        </label>
        <input 
        type=\"number\" 
        name=\"flete_aduana\"
        class=\"form-control\" 
        step=\"0.01\" 
        required=\"required\" 
        >
      </div>
    </div>
  </div>

  <div class=\"row\">
              <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Nro Referendo</label>
            <input 
               type=\"text\" 
               name = \"nro_refrendo\"
               placeholder=\"000-0000-00-000000\"
               class=\"form-control\" 
               maxlength=\"20\" 
               >
         </div>
      </div>
<div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Valor</label>
        <input 
        class=\"form-control\" 
        type=\"number\" 
        name=\"valor\"
        id=\"valor\"
        step=\"0.01\" 
        required=\"required\" 
        >
      </div>
    </div>
    ";
        // line 199
        if (($this->getAttribute(($context["haveEuros"] ?? null), "euros", array()) == true)) {
            // line 200
            echo "    
    <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Moneda</label>
        <select
        name=\"moneda\"
        id=\"moneda\"
        required = \"required\"
        class=\"form-control\"
        >
          <option value=\"EUROS\">EUROS</option>
          <option value=\"DOLARES\">DOLARES</option>
        </select>
      </div>
    </div>
    <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Tipo De Cambio</label>
        <input 
        class=\"form-control\" 
        type=\"number\"
        step=\"0.01\" 
        name=\"tipo_cambio\"
        id=\"tipo_cambio\"
        value=\"";
            // line 224
            echo twig_escape_filter($this->env, $this->getAttribute(($context["haveEuros"] ?? null), "tipo_cambio", array()), "html", null, true);
            echo "\" 
        required=\"required\" 
        >
      </div>
    </div>
        <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Total USD</label>
        <input 
        disabled=\"\"   
        class=\"form-control\"   
        id=\"total\" 
        value=\"0\" 
        style=\"font-weight: bold; font-size: 14px; color:blue\" 
        >
      </div>
    </div>
    ";
        } else {
            // line 242
            echo "      <input type=\"hidden\" name=\"moneda\" value=\"DOLARES\">
      <input type=\"hidden\" name=\"tipo_cambio\" value=\"1\">
";
        }
        // line 245
        echo "  </div>
     <div class=\"row\">
      <div class=\"col-md-12\">
         <hr>
         <button type=\"submit\" class=\"btn btn-sm btn-default\" >
            <span class=\"fa fa-save fa-fw\"></span>
            Guardar Registro
         </button>
      <a href=\"";
        // line 253
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Volver al Pedido <b>[";
        // line 255
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "]</b>
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">   
  \$('#moneda').change(function(){
    if(\$(this).val() === 'EUROS'){
      \$('#tipo_cambio').removeAttr('readonly');
    }else{
      \$('#tipo_cambio').attr('readonly', true);
      \$('#tipo_cambio').val(1);
    }
  });

  \$('#valor').keyup(function(){
    \$('#total').val(\$('#valor').val() * \$('#tipo_cambio').val());  
  })
</script>";
    }

    public function getTemplateName()
    {
        return "forms/frm-factura-informativa.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  354 => 255,  347 => 253,  337 => 245,  332 => 242,  311 => 224,  285 => 200,  283 => 199,  202 => 123,  175 => 99,  162 => 89,  152 => 82,  144 => 77,  135 => 71,  126 => 65,  117 => 59,  106 => 51,  95 => 43,  84 => 35,  74 => 28,  69 => 26,  60 => 20,  52 => 14,  46 => 11,  44 => 10,  41 => 9,  37 => 8,  31 => 6,  29 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set valFob  = 0.0 %}
{% set valInformativas  = 0.0 %}
{% set parcials = 0 %}
{% for invoice in  invoices%}
    {%  set valFob = valFob + (
            invoice.detailInvoice.sums.valueItems * invoice.detailInvoice.sums.tasa_change) %}
{% endfor %}
{% for infoInvoice in infoInvoices  %}
    {% set parcials = parcials + 1 %}
    {% set valInformativas = valInformativas + (
    (infoInvoice.valor) * (infoInvoice.tipo_cambio)
    )%}
{% endfor %}
  <div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Saldo FOB:</strong>
         <span class=\"fa fa-usd\"></span>
         <strong class=\"text-primary\">
         {{(valFob - valInformativas) | number_format(2, '.', ',') }}
         </strong>  
      </div>
       <div class=\"col-sm-2\">
           <strong>Parciales:</strong>
           <span class=\"text-primary\">
           <strong>{{ parcials }}</strong>
               <span class=\"fa fa-arrow-right\"></span>
               [ \$ {{ valInformativas | number_format(2,',','.') }} ]
           </span>
       </div>
      <div class=\"col-sm-2\">
         <strong>
         Nro Pedido:</strong> 
         <span class=\"text-primary\">
         {{ order.nro_pedido }}
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>
         Regimen:</strong> 
         <span class=\"text-primary\">
         <strong class=\"text-primary\">
         {{ order.regimen  }}
         </strong>   
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Fecha Registro:</strong> 
         <span class=\"text-primary\">
         {{ order.date_create }}            
         </span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Tiempo Bodega:</strong>
          <span class=\"text-primary\">
              {{ warehouseDays.days }} dias
          </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>P. Origen:</strong> 
         <span class=\"text-primary\">
         {{ order.pais_origen }}
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>C Origen:</strong> 
         <span class=\"text-primary\">
         {{ order.ciudad_origen  }}            
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Incoterm:</strong> 
         <span class=\"text-primary\">
         {{order.incoterm}}
         </span>         
      </div>
      <div class=\"col-sm-2\">
         <strong>Creado Por:</strong> 
         <span>{{user['nombres']}}
         </span>
      </div>
   </div>
</div>
<br>
<br>
<form method=\"post\" action=\"{{rute_url}}facinformativa/validar/\">
  <div class=\"row\">
    <div class=\"col-md-1\">
       <div class=\"form-group\">
      <label>Pedido</label>
      <input 
      readonly=\"\" 
      type=\"text\" 
      name=\"nro_pedido\"
      class=\"form-control\" 
      value=\"{{order.nro_pedido}}\" 
      >
    </div>
    </div>
    <div class=\"col-md-2\">
    <div class=\"form-group\">
      <label>Nro Factura</label>
      <input 
      type=\"text\" 
      name=\"nro_factura_informativa\"
      class=\"form-control\" 
      autofocus=\"autofocus\" 
      required=\"required\" 
      >
    </div>
    </div>
    <div class=\"col-md-3\">
      <div class=\"form-group\">
      <label>Proveedor</label>
    <select
    name=\"identificacion_proveedor\"
    class=\"form-control\"
    required = \"required\"
    > 
    <option value=\"{{supplier.identificacion_proveedor}}\"> {{supplier.nombre}} </option>
    </select>
    </div>
    </div>
        <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Fecha Emisión</label>
        <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_emision\" 
               required=\"required\" 
               name=\"fecha_emision\" 
               class=\"bootstrap-datepicker\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
      </div>
    </div>
    <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Seguro Aduana <small><b>USD</b></small>
        </label>
        <input 
        type=\"number\" 
        name=\"seguro_aduana\"
        class=\"form-control\" 
        step=\"0.01\" 
        required=\"required\" 
        >
      </div>
    </div>
    <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Felte Aduana <small><b>USD</b></small>
        </label>
        <input 
        type=\"number\" 
        name=\"flete_aduana\"
        class=\"form-control\" 
        step=\"0.01\" 
        required=\"required\" 
        >
      </div>
    </div>
  </div>

  <div class=\"row\">
              <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Nro Referendo</label>
            <input 
               type=\"text\" 
               name = \"nro_refrendo\"
               placeholder=\"000-0000-00-000000\"
               class=\"form-control\" 
               maxlength=\"20\" 
               >
         </div>
      </div>
<div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Valor</label>
        <input 
        class=\"form-control\" 
        type=\"number\" 
        name=\"valor\"
        id=\"valor\"
        step=\"0.01\" 
        required=\"required\" 
        >
      </div>
    </div>
    {% if haveEuros.euros == true %}
    
    <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Moneda</label>
        <select
        name=\"moneda\"
        id=\"moneda\"
        required = \"required\"
        class=\"form-control\"
        >
          <option value=\"EUROS\">EUROS</option>
          <option value=\"DOLARES\">DOLARES</option>
        </select>
      </div>
    </div>
    <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Tipo De Cambio</label>
        <input 
        class=\"form-control\" 
        type=\"number\"
        step=\"0.01\" 
        name=\"tipo_cambio\"
        id=\"tipo_cambio\"
        value=\"{{haveEuros.tipo_cambio}}\" 
        required=\"required\" 
        >
      </div>
    </div>
        <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Total USD</label>
        <input 
        disabled=\"\"   
        class=\"form-control\"   
        id=\"total\" 
        value=\"0\" 
        style=\"font-weight: bold; font-size: 14px; color:blue\" 
        >
      </div>
    </div>
    {% else %}
      <input type=\"hidden\" name=\"moneda\" value=\"DOLARES\">
      <input type=\"hidden\" name=\"tipo_cambio\" value=\"1\">
{% endif %}
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
            Volver al Pedido <b>[{{order.nro_pedido}}]</b>
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">   
  \$('#moneda').change(function(){
    if(\$(this).val() === 'EUROS'){
      \$('#tipo_cambio').removeAttr('readonly');
    }else{
      \$('#tipo_cambio').attr('readonly', true);
      \$('#tipo_cambio').val(1);
    }
  });

  \$('#valor').keyup(function(){
    \$('#total').val(\$('#valor').val() * \$('#tipo_cambio').val());  
  })
</script>", "forms/frm-factura-informativa.html.twig", "/var/www/html/app/src/views/forms/frm-factura-informativa.html.twig");
    }
}
