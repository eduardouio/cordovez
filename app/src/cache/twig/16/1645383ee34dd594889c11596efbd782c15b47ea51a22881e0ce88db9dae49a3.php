<?php

/* forms/frm-pedido-factura.html.twig */
class __TwigTemplate_8e4cad823133fdd54827617a7ba4433534a8c81cb3bf2824c72c98d38150d823 extends Twig_Template
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
        echo "pedidofactura/validar/\">
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
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" 
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
    <option selected disabled >Seleccione...</option>
    ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["suppliers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["supplier"]) {
            // line 25
            echo "      <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "identificacion_proveedor", array()), "html", null, true);
            echo "\"> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "nombre", array()), "html", null, true);
            echo " </option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['supplier'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "    </select>
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
        <label>Vencimiento Pago</label>
          <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               required=\"required\" 
               name=\"vencimiento_pago\" 
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
        <label>Moneda</label>
        <select
        name=\"moneda\"
        id=\"moneda\"
        required = \"required\"
        class=\"form-control\"
        >
          <option value=\"DOLARES\">DOLARES</option>
          <option value=\"EUROS\">EUROS</option>
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
        value=\"1\" 
        required=\"required\" 
        readonly = \"true\"
        >
      </div>
    </div>
  </div>
  <div class=\"row\">
        <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Nro de Factura</label>
        <input 
        class=\"form-control\" 
        type=\"text\" 
        name=\"id_factura_proveedor\"
        maxlength=\"8\"
        required=\"required\" 
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

  </div>
     <div class=\"row\">
      <div class=\"col-md-12\">
         <hr>
         <button type=\"submit\" class=\"btn btn-sm btn-default\" >
            <span class=\"fa fa-save fa-fw\"></span>
            Guardar Registro
         </button>
      <a href=\"";
        // line 142
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Volver al Pedido <b>(";
        // line 144
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo ")</b>
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
        return "forms/frm-pedido-factura.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  188 => 144,  181 => 142,  64 => 27,  53 => 25,  49 => 24,  33 => 11,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form method=\"post\" action=\"{{rute_url}}pedidofactura/validar/\">
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
    <div class=\"col-md-3\">
      <div class=\"form-group\">
      <label>Proveedor</label>
    <select
    name=\"identificacion_proveedor\"
    class=\"form-control\"
    required = \"required\"
    > 
    <option selected disabled >Seleccione...</option>
    {% for supplier in suppliers %}
      <option value=\"{{supplier.identificacion_proveedor}}\"> {{supplier.nombre}} </option>
    {% endfor %}
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
        <label>Vencimiento Pago</label>
          <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               required=\"required\" 
               name=\"vencimiento_pago\" 
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
        <label>Moneda</label>
        <select
        name=\"moneda\"
        id=\"moneda\"
        required = \"required\"
        class=\"form-control\"
        >
          <option value=\"DOLARES\">DOLARES</option>
          <option value=\"EUROS\">EUROS</option>
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
        value=\"1\" 
        required=\"required\" 
        readonly = \"true\"
        >
      </div>
    </div>
  </div>
  <div class=\"row\">
        <div class=\"col-md-2\">
      <div class=\"form-group\">
        <label>Nro de Factura</label>
        <input 
        class=\"form-control\" 
        type=\"text\" 
        name=\"id_factura_proveedor\"
        maxlength=\"8\"
        required=\"required\" 
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
            Volver al Pedido <b>({{order.nro_pedido}})</b>
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
</script>", "forms/frm-pedido-factura.html.twig", "/var/www/html/app/src/views/forms/frm-pedido-factura.html.twig");
    }
}
