<?php

/* forms/frm_producto.html.twig */
class __TwigTemplate_4c8bd25b829d96cd5d9d1bfc23c52f57055fe73b4332e0f2da3d8f7e2c88e25c extends Twig_Template
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
        echo "producto/validar/\" method=\"post\">
   <div class=\"row\">
      <div class=\"col-lg-5\">
         <div class=\"form-group\">
            <label>Nombre</label>
            <input
               class=\"form-control\" 
               type=\"text\"
               required=\"true\"
               maxlength=\"70\"
               name=\"nombre\"
               id=\"nombre\"
               autofocus=\"true\"
               >
         </div>
      </div>
      <div class=\"col-lg-3\">
         <div class=\"form-group\">
            <label>Cod Contable</label>
            <input
               class=\"form-control\"
               placeholder=\"00000000000000000000\"
               type=\"text\"
               required=\"true\"
               maxlength=\"20\"
               name=\"cod_contable\"
               >
         </div>
      </div>
      <div class=\"col-lg-4\">
         <div class=\"form-group\">
            <label>Cod ICE</label>
            <input
               class=\"form-control\"
               type=\"text\"
               placeholder=\"0000-00-000000-000-000000-00-000-000000\"
               required=\"true\"
               maxlength=\"39\"
               name=\"cod_ice\"
               id=\"cod_ice\"
               >
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Proveedor</label>
            <select
               name=\"identificacion_proveedor\"
               required = \"true\"
               class=\"form-control\"
               required=\"true\"
               >
               <option selected=\"true\" disabled =\"true\" >Seleccione...</option>
               ";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["suppliers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["supplier"]) {
            // line 57
            echo "                  <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "identificacion_proveedor", array()), "html", null, true);
            echo "\" >
                     ";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($context["supplier"], "nombre", array()), "html", null, true);
            echo "
                   </option>
               ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['supplier'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "            </select>
         </div>
      </div>
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Unds (x Caja)</label>
            <input
               class=\"form-control\"
               type=\"number\"
               step=\"1\"
               required=\"true\"
               name=\"cantidad_x_caja\"
               >
         </div>
      </div>
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Capacidad (ml)</label>
            <input
               class=\"form-control\"
               required=\"true\"
               type=\"number\"
               step=\"1\"
               name=\"capacidad_ml\"
               >
         </div>
      </div>
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Grado Alcohólico ()</label>
            <input
               class=\"form-control\"
               required=\"true\"
               type=\"number\"
               step=\"0.01\"
               name=\"grado_alcoholico\">
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Estado</label>
            <select
               class=\"form-control\"
               required=\"true\"
               name=\"estado\"
               >
               <option value=\"1\">ACTIVO</option>
               <option value=\"0\">INACTIVO</option>
            </select>
         </div>
      </div>
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Tipo Custodia</label>
            <select
               class=\"form-control\"
               name=\"custodia_doble\"
               >
               <option value=\"0\">NORMAL</option>
               <option value=\"1\">DOBLE</option>
            </select>
         </div>
      </div>
      <div class=\"col-lg-2\">
      \t<div class=\"form-group\">
      \t\t<label>Valor Unitario</label>
      \t\t<input 
            type=\"number\" 
            step=\"0.001\" 
      \t\tname=\"costo_unidad\"
      \t\trequired=\"true\" 
            class=\"form-control\"
      \t\t>
      \t</div>
      </div>
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Comentarios</label>
            <textarea
               class=\"form-control\"
               maxlength=\"120\"
               name= \"comentarios\"
               id= \"comentarios\"
               rows=\"2\"></textarea>
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-12\">
         <button type=\"submit\" class=\"btn btn-default btn-sm\">
         <span class=\"fa fa-save fa-fw\"></span>
         Guardar Registro</button>
         <a href=\"";
        // line 155
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "producto/listar\" class=\"btn btn-default btn-sm\"> 
               <span class=\"fa fa-arrow-left fa-fw\"></span>
            Volver Lista Productos
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">
   \$('#nombre').keyup(function(){
   \tthis.value = this.value.toUpperCase();
   })
   
   \$('#comentarios').keyup(function(){
   this.value = this.value.toUpperCase();
   });
   
</script>";
    }

    public function getTemplateName()
    {
        return "forms/frm_producto.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  192 => 155,  96 => 61,  87 => 58,  82 => 57,  78 => 56,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form action=\"{{ rute_url }}producto/validar/\" method=\"post\">
   <div class=\"row\">
      <div class=\"col-lg-5\">
         <div class=\"form-group\">
            <label>Nombre</label>
            <input
               class=\"form-control\" 
               type=\"text\"
               required=\"true\"
               maxlength=\"70\"
               name=\"nombre\"
               id=\"nombre\"
               autofocus=\"true\"
               >
         </div>
      </div>
      <div class=\"col-lg-3\">
         <div class=\"form-group\">
            <label>Cod Contable</label>
            <input
               class=\"form-control\"
               placeholder=\"00000000000000000000\"
               type=\"text\"
               required=\"true\"
               maxlength=\"20\"
               name=\"cod_contable\"
               >
         </div>
      </div>
      <div class=\"col-lg-4\">
         <div class=\"form-group\">
            <label>Cod ICE</label>
            <input
               class=\"form-control\"
               type=\"text\"
               placeholder=\"0000-00-000000-000-000000-00-000-000000\"
               required=\"true\"
               maxlength=\"39\"
               name=\"cod_ice\"
               id=\"cod_ice\"
               >
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Proveedor</label>
            <select
               name=\"identificacion_proveedor\"
               required = \"true\"
               class=\"form-control\"
               required=\"true\"
               >
               <option selected=\"true\" disabled =\"true\" >Seleccione...</option>
               {% for supplier in suppliers %}
                  <option value=\"{{supplier.identificacion_proveedor}}\" >
                     {{ supplier.nombre }}
                   </option>
               {% endfor %}
            </select>
         </div>
      </div>
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Unds (x Caja)</label>
            <input
               class=\"form-control\"
               type=\"number\"
               step=\"1\"
               required=\"true\"
               name=\"cantidad_x_caja\"
               >
         </div>
      </div>
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Capacidad (ml)</label>
            <input
               class=\"form-control\"
               required=\"true\"
               type=\"number\"
               step=\"1\"
               name=\"capacidad_ml\"
               >
         </div>
      </div>
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Grado Alcohólico ()</label>
            <input
               class=\"form-control\"
               required=\"true\"
               type=\"number\"
               step=\"0.01\"
               name=\"grado_alcoholico\">
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Estado</label>
            <select
               class=\"form-control\"
               required=\"true\"
               name=\"estado\"
               >
               <option value=\"1\">ACTIVO</option>
               <option value=\"0\">INACTIVO</option>
            </select>
         </div>
      </div>
      <div class=\"col-lg-2\">
         <div class=\"form-group\">
            <label>Tipo Custodia</label>
            <select
               class=\"form-control\"
               name=\"custodia_doble\"
               >
               <option value=\"0\">NORMAL</option>
               <option value=\"1\">DOBLE</option>
            </select>
         </div>
      </div>
      <div class=\"col-lg-2\">
      \t<div class=\"form-group\">
      \t\t<label>Valor Unitario</label>
      \t\t<input 
            type=\"number\" 
            step=\"0.001\" 
      \t\tname=\"costo_unidad\"
      \t\trequired=\"true\" 
            class=\"form-control\"
      \t\t>
      \t</div>
      </div>
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Comentarios</label>
            <textarea
               class=\"form-control\"
               maxlength=\"120\"
               name= \"comentarios\"
               id= \"comentarios\"
               rows=\"2\"></textarea>
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-12\">
         <button type=\"submit\" class=\"btn btn-default btn-sm\">
         <span class=\"fa fa-save fa-fw\"></span>
         Guardar Registro</button>
         <a href=\"{{rute_url}}producto/listar\" class=\"btn btn-default btn-sm\"> 
               <span class=\"fa fa-arrow-left fa-fw\"></span>
            Volver Lista Productos
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">
   \$('#nombre').keyup(function(){
   \tthis.value = this.value.toUpperCase();
   })
   
   \$('#comentarios').keyup(function(){
   this.value = this.value.toUpperCase();
   });
   
</script>", "forms/frm_producto.html.twig", "/var/www/html/app/src/views/forms/frm_producto.html.twig");
    }
}
