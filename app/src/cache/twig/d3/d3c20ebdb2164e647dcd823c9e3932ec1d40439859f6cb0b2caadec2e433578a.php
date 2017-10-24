<?php

/* forms/frm-pedido-factura-edit.html.twig */
class __TwigTemplate_b3a0d33ef4e7f8f2e64e00dcdf7a51266a33042f627341c36ddc5aeba623c9bb extends Twig_Template
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
  <input type=\"hidden\" name=\"id_pedido_factura\" value=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "id_pedido_factura", array()), "html", null, true);
        echo "\">
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
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
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
    <option value=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["supplier"] ?? null), 0, array(), "array"), "identificacion_proveedor", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["supplier"] ?? null), 0, array(), "array"), "nombre", array()), "html", null, true);
        echo "</option>
    ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["suppliers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["supplier"]) {
            // line 26
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
        // line 28
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
               value=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "fecha_emision", array()), "html", null, true);
        echo "\" 
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
               value=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "vencimiento_pago", array()), "html", null, true);
        echo "\" 
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
        required = \"required\"
        class=\"form-control\"
        > 
          <option value=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "moneda", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "moneda", array()), "html", null, true);
        echo "</option>
          ";
        // line 77
        if (($this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "moneda", array()) == "DOLARES")) {
            // line 78
            echo "            <option value=\"EUROS\">EUROS</option>
          ";
        } else {
            // line 80
            echo "            <option value=\"DOLARES\">DOLARES</option>
          ";
        }
        // line 82
        echo "        </select>
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
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "tipo_cambio", array()), "html", null, true);
        echo "\" 
        required=\"required\" 
        readonly='true'
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
        value=\"";
        // line 111
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "id_factura_proveedor", array()), "html", null, true);
        echo "\" 
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
        value=\"";
        // line 124
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "valor", array()), "html", null, true);
        echo "\" 
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
        // line 147
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Volver al Pedido <b>(";
        // line 149
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "nro_pedido", array()), "html", null, true);
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
  
</script>
";
    }

    public function getTemplateName()
    {
        return "forms/frm-pedido-factura-edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  228 => 149,  221 => 147,  195 => 124,  179 => 111,  159 => 94,  145 => 82,  141 => 80,  137 => 78,  135 => 77,  129 => 76,  110 => 60,  89 => 42,  73 => 28,  62 => 26,  58 => 25,  52 => 24,  37 => 12,  24 => 2,  19 => 1,);
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
  <input type=\"hidden\" name=\"id_pedido_factura\" value=\"{{invoice[0].id_pedido_factura}}\">
  <div class=\"row\">
    <div class=\"col-md-1\">
       <div class=\"form-group\">
      <label>Pedido</label>
      <input 
      readonly=\"\" 
      type=\"text\" 
      name=\"nro_pedido\"
      class=\"form-control\" 
      value=\"{{invoice[0].nro_pedido}}\" 
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
    <option value=\"{{supplier[0].identificacion_proveedor}}\">{{supplier[0].nombre}}</option>
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
               value=\"{{invoice[0].fecha_emision}}\" 
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
               value=\"{{invoice[0].vencimiento_pago}}\" 
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
        required = \"required\"
        class=\"form-control\"
        > 
          <option value=\"{{invoice[0].moneda}}\">{{invoice[0].moneda}}</option>
          {% if invoice[0].moneda == 'DOLARES' %}
            <option value=\"EUROS\">EUROS</option>
          {% else %}
            <option value=\"DOLARES\">DOLARES</option>
          {% endif %}
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
        value=\"{{invoice[0].tipo_cambio}}\" 
        required=\"required\" 
        readonly='true'
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
        value=\"{{invoice[0].id_factura_proveedor}}\" 
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
        value=\"{{invoice[0].valor}}\" 
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
      <a href=\"{{rute_url}}pedido/presentar/{{invoice[0].nro_pedido}}\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Volver al Pedido <b>({{invoice[0].nro_pedido}})</b>
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
  
</script>
", "forms/frm-pedido-factura-edit.html.twig", "/var/www/html/app/src/views/forms/frm-pedido-factura-edit.html.twig");
    }
}
