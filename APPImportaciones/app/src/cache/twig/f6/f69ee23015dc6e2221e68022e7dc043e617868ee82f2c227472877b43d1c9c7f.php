<?php

/* forms/frm-pedido-factura-detalle.html.twig */
class __TwigTemplate_bc0df0c074ebb0174e541b7c91e74d67e9ce071082478eefec87666848bf0776 extends Twig_Template
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
   <input type=\"hidden\" name=\"id_pedido_factura\" value=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["invoice"] ?? null), 0, array(), "array"), "id_pedido_factura", array()), "html", null, true);
        echo "\">
   <div class=\"row\">
      <div class=\"col-md-6\">
         <div class=\"form-group\">
            <label>Producto</label>
            <select 
            class=\"form-control\" 
            name=\"cod_contable\" 
            id=\"cod_contable\" 
            required=\"true\" 
            >  
               <option selected=\"\" disabled=\"\">Seleccione ... </option>
               ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 15
            echo "               <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "cod_contable", array()), "html", null, true);
            echo "\"> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "nombre", array()), "html", null, true);
            echo "</option>
               ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "            </select>
         </div>
      </div>
            <div class=\"col-md-1\">
         <label>Cajas</label>
         <input 
         type=\"number\" 
         class=\"form-control\" 
         name=\"nro_cajas\"
         id=\"nro_cajas\"
         required=\"true\" 
         step=\"1\" 
         >
      </div>
      <div class=\"col-md-1\">
         <label>Modificar</label>
         <input 
         type=\"checkbox\" 
         class=\"form-control\"
         id=\"chage_params\" 
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
            readonly=\"true\" 
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
         readonly=\"true\" 
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
        // line 77
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

<script type=\"text/javascript\">
   var products = ";
        // line 86
        echo ($context["productsarray"] ?? null);
        echo ";

   \$('#cod_contable').change(function(){
      var e = \$(this).val();
      \$.each(products, function(key, value){
         if(e === value.cod_contable){
            \$('#grado_alcoholico').val('');
            \$('#costo_und').val('');
            \$('#grado_alcoholico').val(value.grado_alcoholico);
            \$('#costo_und').val(value.costo_unidad);
         }
      });

      
   });

</script>


<script type=\"text/javascript\">
   \$('#chage_params').click(function(){
      if( \$('#chage_params').is(':checked') ){
         \$('#grado_alcoholico').removeAttr('readonly');
         \$('#costo_und').removeAttr('readonly');
         \$('#grado_alcoholico').focus();
      }else{
         \$('#grado_alcoholico').attr('readonly', true);
         \$('#costo_und').attr('readonly', true);
      }
   });
</script>";
    }

    public function getTemplateName()
    {
        return "forms/frm-pedido-factura-detalle.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 86,  116 => 77,  54 => 17,  43 => 15,  39 => 14,  24 => 2,  19 => 1,);
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
   <input type=\"hidden\" name=\"id_pedido_factura\" value=\"{{invoice[0].id_pedido_factura}}\">
   <div class=\"row\">
      <div class=\"col-md-6\">
         <div class=\"form-group\">
            <label>Producto</label>
            <select 
            class=\"form-control\" 
            name=\"cod_contable\" 
            id=\"cod_contable\" 
            required=\"true\" 
            >  
               <option selected=\"\" disabled=\"\">Seleccione ... </option>
               {% for product in products %}
               <option value=\"{{product.cod_contable}}\"> {{ product.nombre }}</option>
               {% endfor %}
            </select>
         </div>
      </div>
            <div class=\"col-md-1\">
         <label>Cajas</label>
         <input 
         type=\"number\" 
         class=\"form-control\" 
         name=\"nro_cajas\"
         id=\"nro_cajas\"
         required=\"true\" 
         step=\"1\" 
         >
      </div>
      <div class=\"col-md-1\">
         <label>Modificar</label>
         <input 
         type=\"checkbox\" 
         class=\"form-control\"
         id=\"chage_params\" 
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
            readonly=\"true\" 
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
         readonly=\"true\" 
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

<script type=\"text/javascript\">
   var products = {{ productsarray | raw }};

   \$('#cod_contable').change(function(){
      var e = \$(this).val();
      \$.each(products, function(key, value){
         if(e === value.cod_contable){
            \$('#grado_alcoholico').val('');
            \$('#costo_und').val('');
            \$('#grado_alcoholico').val(value.grado_alcoholico);
            \$('#costo_und').val(value.costo_unidad);
         }
      });

      
   });

</script>


<script type=\"text/javascript\">
   \$('#chage_params').click(function(){
      if( \$('#chage_params').is(':checked') ){
         \$('#grado_alcoholico').removeAttr('readonly');
         \$('#costo_und').removeAttr('readonly');
         \$('#grado_alcoholico').focus();
      }else{
         \$('#grado_alcoholico').attr('readonly', true);
         \$('#costo_und').attr('readonly', true);
      }
   });
</script>", "forms/frm-pedido-factura-detalle.html.twig", "/var/www/html/app/src/views/forms/frm-pedido-factura-detalle.html.twig");
    }
}
