<?php

/* forms/frm-pedido-factura-detalle-edit.html.twig */
class __TwigTemplate_8973728669aeba582e7989c648072f53846e9ca33613cfbd6193509a9898b9d5 extends Twig_Template
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
        echo "detallepedido/validar\">
   <input type=\"hidden\" name=\"detalle_pedido_factura\" value=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["detail"] ?? null), 0, array(), "array"), "detalle_pedido_factura", array()), "html", null, true);
        echo "\">
   <input type=\"hidden\" name=\"id_pedido_factura\" value=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["detail"] ?? null), 0, array(), "array"), "id_pedido_factura", array()), "html", null, true);
        echo "\">
   <input type=\"hidden\" name=\"cod_contable\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["detail"] ?? null), 0, array(), "array"), "cod_contable", array()), "html", null, true);
        echo "\">
   <div class=\"row\">
      <div class=\"col-md-6\">
         <div class=\"form-group\">
            <label>Producto</label>
            <input 
            type=\"text\" 
            class=\"form-control\" 
            name=\"nombre\" 
            id=\"nombre\" 
            readonly=\"\" 
            disabled=\"\" 
            value=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["nombre"] ?? null), "html", null, true);
        echo "\" 
            >  
         </div>
      </div>
            <div class=\"col-md-2\">
         <label>Cajas</label>
         <input 
         type=\"number\" 
         class=\"form-control\" 
         name=\"nro_cajas\"
         id=\"nro_cajas\"
         required=\"true\" 
         step=\"1\" 
         value=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["detail"] ?? null), 0, array(), "array"), "nro_cajas", array()), "html", null, true);
        echo "\" 
         >
      </div>

      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Grado Alcoholico</label>
            <input 
            class=\"form-control\" 
            type=\"number\" 
            step=\"0.01\" 
            name=\"grado_alcoholico\"
            required=\"true\" 
            id=\"grado_alcoholico\" 
            maxlength=\"4\" 
            value=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["detail"] ?? null), 0, array(), "array"), "grado_alcoholico", array()), "html", null, true);
        echo "\" 
            >
         </div>
      </div>


      <div class=\"col-md-2\">
         <label>Costo Unidad</label>
         <input 
         type=\"number\" 
         class=\"form-control\" 
         name=\"costo_und\"
         id=\"costo_und\"
         required=\"true\" 
         step=\"0.01\" 
         value=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["detail"] ?? null), 0, array(), "array"), "costo_und", array()), "html", null, true);
        echo "\" 
         >

   </div>
</div>   
   <div class=\"row\">
      <div class=\"col-md-12\">
         <hr>
         <button type=\"submit\" class=\"btn btn-sm btn-default\" >
            <span class=\"fa fa-save fa-fw\"></span>
            Guardar Producto
         </button>
      <a href=\"";
        // line 71
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedidofactura/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "id_pedido_factura", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Regresar Factura
         </a>
      </div>
   </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "forms/frm-pedido-factura-detalle-edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 71,  99 => 59,  81 => 44,  63 => 29,  47 => 16,  32 => 4,  28 => 3,  24 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form method=\"post\" action=\"{{rute_url}}detallepedido/validar\">
   <input type=\"hidden\" name=\"detalle_pedido_factura\" value=\"{{detail[0].detalle_pedido_factura}}\">
   <input type=\"hidden\" name=\"id_pedido_factura\" value=\"{{detail[0].id_pedido_factura}}\">
   <input type=\"hidden\" name=\"cod_contable\" value=\"{{detail[0].cod_contable}}\">
   <div class=\"row\">
      <div class=\"col-md-6\">
         <div class=\"form-group\">
            <label>Producto</label>
            <input 
            type=\"text\" 
            class=\"form-control\" 
            name=\"nombre\" 
            id=\"nombre\" 
            readonly=\"\" 
            disabled=\"\" 
            value=\"{{ nombre }}\" 
            >  
         </div>
      </div>
            <div class=\"col-md-2\">
         <label>Cajas</label>
         <input 
         type=\"number\" 
         class=\"form-control\" 
         name=\"nro_cajas\"
         id=\"nro_cajas\"
         required=\"true\" 
         step=\"1\" 
         value=\"{{ detail[0].nro_cajas }}\" 
         >
      </div>

      <div class=\"col-md-2\">
         <div class=\"form-group\">
            <label>Grado Alcoholico</label>
            <input 
            class=\"form-control\" 
            type=\"number\" 
            step=\"0.01\" 
            name=\"grado_alcoholico\"
            required=\"true\" 
            id=\"grado_alcoholico\" 
            maxlength=\"4\" 
            value=\"{{ detail[0].grado_alcoholico }}\" 
            >
         </div>
      </div>


      <div class=\"col-md-2\">
         <label>Costo Unidad</label>
         <input 
         type=\"number\" 
         class=\"form-control\" 
         name=\"costo_und\"
         id=\"costo_und\"
         required=\"true\" 
         step=\"0.01\" 
         value=\"{{ detail[0].costo_und }}\" 
         >

   </div>
</div>   
   <div class=\"row\">
      <div class=\"col-md-12\">
         <hr>
         <button type=\"submit\" class=\"btn btn-sm btn-default\" >
            <span class=\"fa fa-save fa-fw\"></span>
            Guardar Producto
         </button>
      <a href=\"{{rute_url}}pedidofactura/presentar/{{invoice[0].id_pedido_factura}}\" class=\"btn btn-sm btn-default\">
            <span class=\"fa fa-arrow-left fa-fw\"></span>
            Regresar Factura
         </a>
      </div>
   </div>
</form>
", "forms/frm-pedido-factura-detalle-edit.html.twig", "/var/www/html/app/src/views/forms/frm-pedido-factura-detalle-edit.html.twig");
    }
}
