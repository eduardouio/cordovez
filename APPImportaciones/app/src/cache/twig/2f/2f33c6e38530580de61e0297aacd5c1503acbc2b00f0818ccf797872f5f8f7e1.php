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
        echo twig_escape_filter($this->env, ($context["actionFrom"] ?? null), "html", null, true);
        echo "\">
<div class=\"row\">
<div class=\"col-lg-5\">
\t\t<div class=\"form-group\"> 
\t\t<label>Nombre</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\ttype=\"text\" 
\t\trequired=\"true\" 
\t\tmaxlength=\"70\" 
\t\tname=\"producto.nombre\" 
\t\tng-model = \"producto.nombre\"
\t\t>
\t\t</div>
\t</div>
\t<div class=\"col-lg-3\">
\t\t<div class=\"form-group\">
         <label>Cod Contable</label>
         <input 
         class=\"form-control\" 
         placeholder=\"00000000000000000000\" 
         type=\"text\" 
         required=\"true\" 
         maxlength=\"20\" 
         name=\"producto.cod_contable\" 
         ng-model=\"producto.cod_contable\"
         >
      </div>\t\t
\t</div>
\t<div class=\"col-lg-4\">
\t\t<div class=\"form-group\">
         <label>Cod ICE</label>
         <input 
         class=\"form-control\" 
         type=\"text\" 
         placeholder=\"0000-00-000000-000-000000-00-000-000000\" 
         required=\"true\" 
         maxlength=\"39\" 
         name=\"producto.cod_ice\" 
         ng-model=\"producto.cod_ice\"
         >
      </div>\t\t
\t</div>
</div>
<div class=\"row\">
\t<div class=\"col-lg-5\">
\t<div class=\"form-group\">
\t\t<label>Proveedor</label>
\t\t<input
\t\tclass=\"form-control\" 
\t\ttype=\"text\"
\t\trequired=\"true\" 
\t\tname=\"producto.proveedor\"
\t\tng-model=\"producto.proveedor\"
\t\t>
\t</div>
\t</div>
\t<div class=\"col-lg-3\">
\t<div class=\"form-group\">
\t\t<label>ID Proveedor</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\tdisabled=\"true\" 
\t\ttype=\"text\" 
\t\tname=\"producto.identificacion_proveedor\"
\t\tng-model=\"producto.identificacion_proveedor\"
\t\tvalue=\"{[producto.identificacion_proveedor]}\" 
\t\t>
\t</div>
\t</div>
\t<div class=\"col-lg-4\">
\t<div class=\"form-group\">
\t\t<label>Pais de Origen</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\ttype=\"text\" 
\t\trequired=\"true\" 
\t\tname=\"producto.pais_origen\"
\t\tng-model=\"producto.pais_origen\"
\t\t>
\t</div>
\t</div>
</div>
<div class=\"row\">
<div class=\"col-lg-2\">
\t<div class=\"form-group\">
\t\t<label>Unds (x Caja)</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\ttype=\"number\"
\t\tstep=\"1\"
\t\trequired=\"true\" 
\t\tname=\"producto.cantidad_unidad\"
\t\tng-model=\"producto.cantidad_unidad\">
\t\t
\t</div>
</div>
<div class=\"col-lg-2\">
\t<div class=\"form-group\">
\t\t<label>Capacidad (ml)</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\trequired=\"true\" 
\t\ttype=\"number\"
\t\tstep=\"1\" 
\t\tname=\"producto.contenidoml\"
\t\tng-model=\"producto.contenidoml\">
\t</div>
</div>
<div class=\"col-lg-2\">
\t<div class=\"form-group\">
\t\t<label>Grado Alcohólico</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\trequired=\"true\" 
\t\ttype=\"number\"
\t\tstep=\"0.01\" 
\t\tname=\"producto.grado_alcoholico\"
\t\tng-model=\"producto.grado_alcoholico\">
\t</div>
</div>
<div class=\"col-lg-3\">
\t<div class=\"form-group\">
\t\t<label>Estado</label>
\t\t<select
\t\tclass=\"form-control\" 
\t\trequired=\"true\" 
\t\tname=\"producto.estado\"
\t\tng-model=\"producto.estado\"
\t\t>
\t\t<option>
\t\t\t<option value=\"\" disabled selected>Seleccione ...</option>
\t\t\t<option value=\"1\">ACTIVO</option>
\t\t\t<option value=\"0\">INACTIVO</option>
\t\t</option>
\t\t</select>
\t</div>
</div>
<div class=\"col-lg-3\">
\t<div class=\"form-group\">
\t\t<label>Tipo Custodia</label>
\t\t<select
\t\tclass=\"form-control\" 
\t\tname=\"\"
\t\tng-model=\"\">
\t\t<option value=\"\" disabled selected>Seleccione ...</option>
\t\t<option value=\"0\">NORMAL</option>
\t\t<option value=\"1\">DOBLE</option>
\t\t</select>
\t</div>
</div>
</div>
<div class=\"row\">
\t   <div class=\"col-lg-8\">
<div class=\"form-group\">
            <label>Notas</label>
            <textarea 
            class=\"form-control\"
            maxlength=\"120\" 
            name= \"producto.notas\" 
            ng-model= \"producto.notas\" 
            rows=\"2\"></textarea>
         </div>
   </div> 
</div>
<div class=\"row\">
      <div class=\"col-lg-12\">
       <input 
         type=\"hidden\" 
         name=\"producto.id_user\"
         ng-model=\"producto.id_user\"
         value=\"{[producto.id_user]}\">
   <input 
         type=\"hidden\" 
         name=\"producto.last_update\"
         ng-model=\"producto.last_update\"
         value=\"0000-00-00 00:00:00\">

         <button type=\"submit\" class=\"btn btn-default\">
         <span class=\"fa fa-save fa-fw\"></span>
         Guardar Registro</button>
         <button type=\"reset\" class=\"btn btn-default\">
         <span class=\"fa fa-refresh fa-fw\"></span>
         Limpiar Formulario</button>
         <a class=\"btn btn-info pull-right\">
         <span class=\"fa fa-warning fa-fw\"></span>
         Cancelar </a>
      </div>
</div>
\t
</form>";
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
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form action=\"{{actionFrom}}\">
<div class=\"row\">
<div class=\"col-lg-5\">
\t\t<div class=\"form-group\"> 
\t\t<label>Nombre</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\ttype=\"text\" 
\t\trequired=\"true\" 
\t\tmaxlength=\"70\" 
\t\tname=\"producto.nombre\" 
\t\tng-model = \"producto.nombre\"
\t\t>
\t\t</div>
\t</div>
\t<div class=\"col-lg-3\">
\t\t<div class=\"form-group\">
         <label>Cod Contable</label>
         <input 
         class=\"form-control\" 
         placeholder=\"00000000000000000000\" 
         type=\"text\" 
         required=\"true\" 
         maxlength=\"20\" 
         name=\"producto.cod_contable\" 
         ng-model=\"producto.cod_contable\"
         >
      </div>\t\t
\t</div>
\t<div class=\"col-lg-4\">
\t\t<div class=\"form-group\">
         <label>Cod ICE</label>
         <input 
         class=\"form-control\" 
         type=\"text\" 
         placeholder=\"0000-00-000000-000-000000-00-000-000000\" 
         required=\"true\" 
         maxlength=\"39\" 
         name=\"producto.cod_ice\" 
         ng-model=\"producto.cod_ice\"
         >
      </div>\t\t
\t</div>
</div>
<div class=\"row\">
\t<div class=\"col-lg-5\">
\t<div class=\"form-group\">
\t\t<label>Proveedor</label>
\t\t<input
\t\tclass=\"form-control\" 
\t\ttype=\"text\"
\t\trequired=\"true\" 
\t\tname=\"producto.proveedor\"
\t\tng-model=\"producto.proveedor\"
\t\t>
\t</div>
\t</div>
\t<div class=\"col-lg-3\">
\t<div class=\"form-group\">
\t\t<label>ID Proveedor</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\tdisabled=\"true\" 
\t\ttype=\"text\" 
\t\tname=\"producto.identificacion_proveedor\"
\t\tng-model=\"producto.identificacion_proveedor\"
\t\tvalue=\"{[producto.identificacion_proveedor]}\" 
\t\t>
\t</div>
\t</div>
\t<div class=\"col-lg-4\">
\t<div class=\"form-group\">
\t\t<label>Pais de Origen</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\ttype=\"text\" 
\t\trequired=\"true\" 
\t\tname=\"producto.pais_origen\"
\t\tng-model=\"producto.pais_origen\"
\t\t>
\t</div>
\t</div>
</div>
<div class=\"row\">
<div class=\"col-lg-2\">
\t<div class=\"form-group\">
\t\t<label>Unds (x Caja)</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\ttype=\"number\"
\t\tstep=\"1\"
\t\trequired=\"true\" 
\t\tname=\"producto.cantidad_unidad\"
\t\tng-model=\"producto.cantidad_unidad\">
\t\t
\t</div>
</div>
<div class=\"col-lg-2\">
\t<div class=\"form-group\">
\t\t<label>Capacidad (ml)</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\trequired=\"true\" 
\t\ttype=\"number\"
\t\tstep=\"1\" 
\t\tname=\"producto.contenidoml\"
\t\tng-model=\"producto.contenidoml\">
\t</div>
</div>
<div class=\"col-lg-2\">
\t<div class=\"form-group\">
\t\t<label>Grado Alcohólico</label>
\t\t<input 
\t\tclass=\"form-control\" 
\t\trequired=\"true\" 
\t\ttype=\"number\"
\t\tstep=\"0.01\" 
\t\tname=\"producto.grado_alcoholico\"
\t\tng-model=\"producto.grado_alcoholico\">
\t</div>
</div>
<div class=\"col-lg-3\">
\t<div class=\"form-group\">
\t\t<label>Estado</label>
\t\t<select
\t\tclass=\"form-control\" 
\t\trequired=\"true\" 
\t\tname=\"producto.estado\"
\t\tng-model=\"producto.estado\"
\t\t>
\t\t<option>
\t\t\t<option value=\"\" disabled selected>Seleccione ...</option>
\t\t\t<option value=\"1\">ACTIVO</option>
\t\t\t<option value=\"0\">INACTIVO</option>
\t\t</option>
\t\t</select>
\t</div>
</div>
<div class=\"col-lg-3\">
\t<div class=\"form-group\">
\t\t<label>Tipo Custodia</label>
\t\t<select
\t\tclass=\"form-control\" 
\t\tname=\"\"
\t\tng-model=\"\">
\t\t<option value=\"\" disabled selected>Seleccione ...</option>
\t\t<option value=\"0\">NORMAL</option>
\t\t<option value=\"1\">DOBLE</option>
\t\t</select>
\t</div>
</div>
</div>
<div class=\"row\">
\t   <div class=\"col-lg-8\">
<div class=\"form-group\">
            <label>Notas</label>
            <textarea 
            class=\"form-control\"
            maxlength=\"120\" 
            name= \"producto.notas\" 
            ng-model= \"producto.notas\" 
            rows=\"2\"></textarea>
         </div>
   </div> 
</div>
<div class=\"row\">
      <div class=\"col-lg-12\">
       <input 
         type=\"hidden\" 
         name=\"producto.id_user\"
         ng-model=\"producto.id_user\"
         value=\"{[producto.id_user]}\">
   <input 
         type=\"hidden\" 
         name=\"producto.last_update\"
         ng-model=\"producto.last_update\"
         value=\"0000-00-00 00:00:00\">

         <button type=\"submit\" class=\"btn btn-default\">
         <span class=\"fa fa-save fa-fw\"></span>
         Guardar Registro</button>
         <button type=\"reset\" class=\"btn btn-default\">
         <span class=\"fa fa-refresh fa-fw\"></span>
         Limpiar Formulario</button>
         <a class=\"btn btn-info pull-right\">
         <span class=\"fa fa-warning fa-fw\"></span>
         Cancelar </a>
      </div>
</div>
\t
</form>", "forms/frm_producto.html.twig", "/var/www/html/app/src/views/forms/frm_producto.html.twig");
    }
}
