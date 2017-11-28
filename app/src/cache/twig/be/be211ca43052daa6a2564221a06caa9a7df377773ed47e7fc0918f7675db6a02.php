<?php

/* forms/frm_factura_pagos.html.twig */
class __TwigTemplate_f198aceac6e8712a11690f61193d02c13a194a94fbcb6c2edffdfe716f8d7a71 extends Twig_Template
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
        echo "facturapagos/validar/\">
  <div class=\"row\">
    <div class=\"col-sm-6\">
      <div class=\"form-group\">
        <label>Proveedor</label>
        <select 
        name=\"identificacion_proveedor\"
        autofocus = 'autofocus'
        required=\"true\" 
        class=\"form-control\">
        ";
        // line 11
        if ((($context["fail"] ?? null) == true)) {
            // line 12
            echo "        <option selected=\"true\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
        ";
            // line 13
            echo twig_escape_filter($this->env, ($context["supplierName"] ?? null), "html", null, true);
            echo " </option>
        ";
        } else {
            // line 15
            echo "        <option disabled=\"\" selected=\"\" >Seleccione... </option>
        ";
        }
        // line 17
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["suppliers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["supplier"]) {
            // line 18
            echo "          <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "identificacion_proveedor", array()), "html", null, true);
            echo "\"> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "nombre", array()), "html", null, true);
            echo " </option>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['supplier'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "        </select>
      </div>
    </div>
    <div class=\"col-sm-2\">
      <div class=\"form-group\">
      <label>Nro Documento</label>
        <input 
        type=\"text\" 
        class=\"form-control\" 
        maxlength=\"20\"
        name=\"nro_factura\"
        required=\"true\" 
        value=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "nro_factura", array()), "html", null, true);
        echo "\" 
        >
      </div>
    </div>
    <div class=\"col-sm-2\">
      <div class=\"form-group\">
        <label>Fecha Emisi&oacute;n</label>
         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_emision\" 
               required=\"required\" 
               name=\"fecha_emision\" 
               class=\"bootstrap-datepicker\" 
               value=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "fecha_emision", array()), "html", null, true);
        echo "\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
      </div>
      </div>
      <div class=\"col-sm-2\">
        <div class=\"form-group\">
          <label>Valor <span class=\"label label-warning\" >Sin IVA</span></label>
          <input 
          type=\"number\" 
          class=\"form-control\" 
          step=\"0.01\" 
          maxlength=\"8\" 
          name=\"valor\"
          value=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "valor", array()), "html", null, true);
        echo "\" 
          >
        </div>
      </div>
    </div>
    <div class=\"row\">
      <div class=\"col-sm-6\">
        <div class=\"form-group\">
          <label>Comentarios</label>
          <textarea 
          name=\"comentarios\"
          id =\"comentarios\"
          maxlength=\"250\" 
          class=\"form-control\"
          >";
        // line 78
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "comentarios", array()), "html", null, true);
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
        // line 89
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "facturapagos/\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Regresar Lista
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">
    \$('#comentarios').keyup(function(){
        this.value = this.value.toUpperCase();
    })
</script>";
    }

    public function getTemplateName()
    {
        return "forms/frm_factura_pagos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  148 => 89,  134 => 78,  117 => 64,  97 => 47,  79 => 32,  65 => 20,  54 => 18,  49 => 17,  45 => 15,  40 => 13,  35 => 12,  33 => 11,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form method=\"post\" action=\"{{rute_url}}facturapagos/validar/\">
  <div class=\"row\">
    <div class=\"col-sm-6\">
      <div class=\"form-group\">
        <label>Proveedor</label>
        <select 
        name=\"identificacion_proveedor\"
        autofocus = 'autofocus'
        required=\"true\" 
        class=\"form-control\">
        {% if fail == true %}
        <option selected=\"true\" value=\"{{invoice.identificacion_proveedor}}\">
        {{supplierName}} </option>
        {% else %}
        <option disabled=\"\" selected=\"\" >Seleccione... </option>
        {% endif %}
        {% for supplier in suppliers %}
          <option value=\"{{supplier.identificacion_proveedor}}\"> {{supplier.nombre}} </option>
          {% endfor %}
        </select>
      </div>
    </div>
    <div class=\"col-sm-2\">
      <div class=\"form-group\">
      <label>Nro Documento</label>
        <input 
        type=\"text\" 
        class=\"form-control\" 
        maxlength=\"20\"
        name=\"nro_factura\"
        required=\"true\" 
        value=\"{{ invoice.nro_factura }}\" 
        >
      </div>
    </div>
    <div class=\"col-sm-2\">
      <div class=\"form-group\">
        <label>Fecha Emisi&oacute;n</label>
         <div class=\"input-group date\" data-provide=\"datepicker\">
            <input 
               type=\"text\" 
               class=\"form-control\" 
               id=\"fecha_emision\" 
               required=\"required\" 
               name=\"fecha_emision\" 
               class=\"bootstrap-datepicker\" 
               value=\"{{ invoice.fecha_emision }}\" 
               >
            <div class=\"input-group-addon\">
               <span class=\"glyphicon glyphicon-th\"></span>
            </div>
         </div>
      </div>
      </div>
      <div class=\"col-sm-2\">
        <div class=\"form-group\">
          <label>Valor <span class=\"label label-warning\" >Sin IVA</span></label>
          <input 
          type=\"number\" 
          class=\"form-control\" 
          step=\"0.01\" 
          maxlength=\"8\" 
          name=\"valor\"
          value=\"{{ invoice.valor }}\" 
          >
        </div>
      </div>
    </div>
    <div class=\"row\">
      <div class=\"col-sm-6\">
        <div class=\"form-group\">
          <label>Comentarios</label>
          <textarea 
          name=\"comentarios\"
          id =\"comentarios\"
          maxlength=\"250\" 
          class=\"form-control\"
          >{{invoice.comentarios}}</textarea>
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
      <a href=\"{{rute_url}}facturapagos/\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Regresar Lista
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">
    \$('#comentarios').keyup(function(){
        this.value = this.value.toUpperCase();
    })
</script>", "forms/frm_factura_pagos.html.twig", "/var/www/html/app/src/views/forms/frm_factura_pagos.html.twig");
    }
}
