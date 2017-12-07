<?php

/* forms/frm-factura-pagos.html.twig */
class __TwigTemplate_ff27bb2d00eb70b475fb8f89dc0787590c6b4e91ad15c7606e23b44dae7fb73d extends Twig_Template
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
        echo "<br>
<form method=\"post\" action=\"";
        // line 2
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
        // line 12
        if ((($context["fail"] ?? null) == true)) {
            // line 13
            echo "        <option selected=\"true\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "identificacion_proveedor", array()), "html", null, true);
            echo "\">
        ";
            // line 14
            echo twig_escape_filter($this->env, ($context["supplierName"] ?? null), "html", null, true);
            echo " </option>
        ";
        } else {
            // line 16
            echo "        <option disabled=\"\" selected=\"\" >Seleccione... </option>
        ";
        }
        // line 18
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["suppliers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["supplier"]) {
            // line 19
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
        // line 21
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
        // line 33
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
        // line 48
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
        // line 65
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
        // line 79
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
        // line 90
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
        return "forms/frm-factura-pagos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 90,  136 => 79,  119 => 65,  99 => 48,  81 => 33,  67 => 21,  56 => 19,  51 => 18,  47 => 16,  42 => 14,  37 => 13,  35 => 12,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<br>
<form method=\"post\" action=\"{{rute_url}}facturapagos/validar/\">
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
</script>", "forms/frm-factura-pagos.html.twig", "/var/www/html/app/src/views/forms/frm-factura-pagos.html.twig");
    }
}
