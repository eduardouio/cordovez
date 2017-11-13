<?php

/* forms/frm_proveedor.html.twig */
class __TwigTemplate_f3a7745afc95eeba514c8a21cc6a8fc09a7d49feb466a506d75062c03986d438 extends Twig_Template
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
        echo "proveedor/validar\">
   <div class=\"row\">
      <div class=\"col-lg-3\">
         <div class=\"form-group\">
            <label>Identificacion Proveedor: </label>
            <input
               class=\"form-control\"
               required=\"true\"
               type=\"text\"
               maxlength=\"16\"
               name=\"identificacion_proveedor\"
               />
         </div>
      </div>
      <div class=\"col-lg-3\">
         <div class=\"form-group\">
            <label>Tipo de Proveedor:</label>
            <select
               class = \"form-control\"
               name = \"tipo_provedor\"
               >
               <option disabled selected>Seleccione ...</option>
               <option value=\"NACIONAL\">NACIONAL</option>
               <option value=\"INTERNACIONAL\">INTERNACIONAL</option>
            </select>
         </div>
      </div>
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Nombre:</label>
            <input
               class=\"form-control\"
               required=\"required\"
               type=\"text\"
               maxlength=\"60\"
               id=\"nombre_proveedor\"
               name=\"nombre\">
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Seleccione La Categoria O Categorias A La Que Pertenece</label>
            <!-- inicio -->
            <div class=\"control-group text-info\">
               <label class=\"control control-checkbox\">
                  ADUANA DEL ECUADOR
                  <input type=\"checkbox\" value=\"ADUANA DEL ECUADOR\" name=\"categoria_1\"/>
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  AGENTE DE ADUANAS
                  <input type=\"checkbox\"  value=\"AGENTE DE ADUANAS\" name=\"categoria_2\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  ALMACENAJE
                  <input type=\"checkbox\"  value=\"ALMACENAJE\" name=\"categoria_3\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  BODEGAJE
                  <input type=\"checkbox\"  value=\"BODEGAJE\" name=\"categoria_4\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  CANDADO SATELITAL
                  <input type=\"checkbox\"  value=\"CANDADO SATELITAL\" name=\"categoria_5\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  CUSTODIA ARMADA
                  <input type=\"checkbox\"  value=\"CUSTODIA ARMADA\" name=\"categoria_6\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  ESTIBAJE
                  <input type=\"checkbox\"  value=\"ESTIBAJE\" name=\"categoria_9\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  ESPACIO ETIQUETADO
                  <input type=\"checkbox\"  value=\"ESPACIO ETIQUETADO\" name=\"categoria_16\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  THC
                  <input type=\"checkbox\"  value=\"THC\" name=\"categoria_17\">
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  FORMULARIOS
                  <input type=\"checkbox\"  value=\"FORMULARIOS\" name=\"categoria_11\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  GASTOS LOCALES
                  <input type=\"checkbox\"  value=\"GASTOS LOCALES\" name=\"categoria_12\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  HORAS EXTRAS
                  <input type=\"checkbox\"  value=\"HORAS EXTRAS\" name=\"categoria_13\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  PROVEEDOR DE LICORES
                  <input type=\"checkbox\"  value=\"PROVEEDOR DE LICORES\" name=\"categoria_14\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  TRANSPORTE INTERNACIONAL
                  <input type=\"checkbox\"  value=\"TRANSPORTE INTERNACIONAL\" name=\"categoria_8\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  TRANSPORTE INTERNO (NACIONAL)
                  <input type=\"checkbox\"  value=\"TRANSPORTE INTERNO\" name=\"categoria_15\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  OTROS SERVICIOS
                  <input type=\"checkbox\"  value=\"OTROS SERVICIOS\" name=\"categoria_10\">             
                  <div class=\"control_indicator\"></div>
               </label>
            </div>
            <!-- Final -->
         </div>
      </div>
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Comentarios</label>
            <textarea
               class=\"form-control\"
               name= \"comentarios\"
               id= \"comentarios\"
               rows=\"3\"></textarea>
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-6\">
         <hr>
         <button type=\"submit\" class=\"btn btn-default btn-sm\">
         <span class=\"fa fa-save fa-fw\"></span>
         Guardar Registro</button>
         <a href=\"";
        // line 148
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/listar/\" class=\"btn btn-default btn-sm\"> 
         <span class=\"fa fa-arrow-left fa-fw\"></span>
         Volver Lista Proveedores
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">
   \$('#nombre_proveedor').keyup(function(){
      this.value = this.value.toUpperCase();
   });
   
   \$('#comentarios').keyup(function(){
      this.value = this.value.toUpperCase();
   });
</script>";
    }

    public function getTemplateName()
    {
        return "forms/frm_proveedor.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 148,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form method=\"post\" action=\"{{rute_url}}proveedor/validar\">
   <div class=\"row\">
      <div class=\"col-lg-3\">
         <div class=\"form-group\">
            <label>Identificacion Proveedor: </label>
            <input
               class=\"form-control\"
               required=\"true\"
               type=\"text\"
               maxlength=\"16\"
               name=\"identificacion_proveedor\"
               />
         </div>
      </div>
      <div class=\"col-lg-3\">
         <div class=\"form-group\">
            <label>Tipo de Proveedor:</label>
            <select
               class = \"form-control\"
               name = \"tipo_provedor\"
               >
               <option disabled selected>Seleccione ...</option>
               <option value=\"NACIONAL\">NACIONAL</option>
               <option value=\"INTERNACIONAL\">INTERNACIONAL</option>
            </select>
         </div>
      </div>
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Nombre:</label>
            <input
               class=\"form-control\"
               required=\"required\"
               type=\"text\"
               maxlength=\"60\"
               id=\"nombre_proveedor\"
               name=\"nombre\">
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Seleccione La Categoria O Categorias A La Que Pertenece</label>
            <!-- inicio -->
            <div class=\"control-group text-info\">
               <label class=\"control control-checkbox\">
                  ADUANA DEL ECUADOR
                  <input type=\"checkbox\" value=\"ADUANA DEL ECUADOR\" name=\"categoria_1\"/>
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  AGENTE DE ADUANAS
                  <input type=\"checkbox\"  value=\"AGENTE DE ADUANAS\" name=\"categoria_2\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  ALMACENAJE
                  <input type=\"checkbox\"  value=\"ALMACENAJE\" name=\"categoria_3\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  BODEGAJE
                  <input type=\"checkbox\"  value=\"BODEGAJE\" name=\"categoria_4\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  CANDADO SATELITAL
                  <input type=\"checkbox\"  value=\"CANDADO SATELITAL\" name=\"categoria_5\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  CUSTODIA ARMADA
                  <input type=\"checkbox\"  value=\"CUSTODIA ARMADA\" name=\"categoria_6\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  ESTIBAJE
                  <input type=\"checkbox\"  value=\"ESTIBAJE\" name=\"categoria_9\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  ESPACIO ETIQUETADO
                  <input type=\"checkbox\"  value=\"ESPACIO ETIQUETADO\" name=\"categoria_16\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  THC
                  <input type=\"checkbox\"  value=\"THC\" name=\"categoria_17\">
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  FORMULARIOS
                  <input type=\"checkbox\"  value=\"FORMULARIOS\" name=\"categoria_11\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  GASTOS LOCALES
                  <input type=\"checkbox\"  value=\"GASTOS LOCALES\" name=\"categoria_12\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  HORAS EXTRAS
                  <input type=\"checkbox\"  value=\"HORAS EXTRAS\" name=\"categoria_13\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  PROVEEDOR DE LICORES
                  <input type=\"checkbox\"  value=\"PROVEEDOR DE LICORES\" name=\"categoria_14\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  TRANSPORTE INTERNACIONAL
                  <input type=\"checkbox\"  value=\"TRANSPORTE INTERNACIONAL\" name=\"categoria_8\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  TRANSPORTE INTERNO (NACIONAL)
                  <input type=\"checkbox\"  value=\"TRANSPORTE INTERNO\" name=\"categoria_15\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  OTROS SERVICIOS
                  <input type=\"checkbox\"  value=\"OTROS SERVICIOS\" name=\"categoria_10\">             
                  <div class=\"control_indicator\"></div>
               </label>
            </div>
            <!-- Final -->
         </div>
      </div>
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>Comentarios</label>
            <textarea
               class=\"form-control\"
               name= \"comentarios\"
               id= \"comentarios\"
               rows=\"3\"></textarea>
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-6\">
         <hr>
         <button type=\"submit\" class=\"btn btn-default btn-sm\">
         <span class=\"fa fa-save fa-fw\"></span>
         Guardar Registro</button>
         <a href=\"{{rute_url}}proveedor/listar/\" class=\"btn btn-default btn-sm\"> 
         <span class=\"fa fa-arrow-left fa-fw\"></span>
         Volver Lista Proveedores
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">
   \$('#nombre_proveedor').keyup(function(){
      this.value = this.value.toUpperCase();
   });
   
   \$('#comentarios').keyup(function(){
      this.value = this.value.toUpperCase();
   });
</script>", "forms/frm_proveedor.html.twig", "/var/www/html/app/src/views/forms/frm_proveedor.html.twig");
    }
}
