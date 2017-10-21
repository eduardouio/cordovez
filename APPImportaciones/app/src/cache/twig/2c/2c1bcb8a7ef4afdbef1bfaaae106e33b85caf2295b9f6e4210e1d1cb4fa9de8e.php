<?php

/* forms/frm_proveedor_edit.html.twig */
class __TwigTemplate_0b1f19e346dc60536c0fe33d367d0e98353cc94f8c174934f9399246a08a8335 extends Twig_Template
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
        $context["categorias"] = twig_split_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "categoria", array()), ";");
        echo " 
    ";
        // line 2
        $context["data"] = twig_jsonencode_filter(($context["categorias"] ?? null));
        echo ";
<form method=\"post\" action=\"";
        // line 3
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/validar\">
  <input type=\"hidden\" name=\"id_proveedor\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "id_proveedor", array()), "html", null, true);
        echo "\">
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
               value=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "identificacion_proveedor", array()), "html", null, true);
        echo "\"
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
               <option value=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "tipo_provedor", array()), "html", null, true);
        echo "\" selected=\"true\">
                  ";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "tipo_provedor", array()), "html", null, true);
        echo "
               </option>
               ";
        // line 29
        if (($this->getAttribute(($context["supplier"] ?? null), "tipo_provedor", array()) == "NACIONAL")) {
            // line 30
            echo "               <option value=\"INTERNACIONAL\">INTERNACIONAL</option>
               ";
        } else {
            // line 32
            echo "               <option value=\"NACIONAL\">NACIONAL</option>
               ";
        }
        // line 34
        echo "            </select>
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
               name=\"nombre\"
               value=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "nombre", array()), "html", null, true);
        echo "\">
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>SELECCIONE LA CATEGORIA O CATEGORIAS A LA QUE PERTENECE</label>
          <!-- inicio -->
            <div class=\"control-group text-info\" id=\"categoria\">
               <label class=\"control control-checkbox\">
                  ADUANA DEL ECUADOR
                  <input type=\"checkbox\" 
                  value=\"ADUANA\" 
                  id=\"ADUANA\" 
                  name=\"categoria_1\"/>
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  AGENTE DE ADUANAS
                  <input type=\"checkbox\"  
                  value=\"AGENTE DE ADUANAS\" 
                  id=\"AGENTEDEADUANAS\" 
                  name=\"categoria_2\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  ALMACENAJE
                  <input type=\"checkbox\"  
                  value=\"ALMACENAJE\" 
                  id=\"ALMACENAJE\" 
                  name=\"categoria_3\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  BODEGAJE
                  <input type=\"checkbox\"  
                  value=\"BODEGAJE\" 
                  id=\"BODEGAJE\" 
                  name=\"categoria_4\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  CANDADO SATELITAL
                  <input type=\"checkbox\"  
                  value=\"CANDADO SATELITAL\" 
                  id=\"CANDADOSATELITAL\" 
                  name=\"categoria_5\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  CUSTODIA ARMADA
                  <input type=\"checkbox\"  
                  value=\"CUSTODIA ARMADA\" 
                  id=\"CUSTODIAARMADA\" 
                  name=\"categoria_6\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  PROVEEDOR DE LICORES
                  <input type=\"checkbox\"  
                  value=\"PROVEEDOR DE LICORES\" 
                  id=\"PROVEEDORDELICORES\" 
                  name=\"categoria_7\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  TRANSPORTE INTERNACIONAL
                  <input type=\"checkbox\"  
                  value=\"TRANSPORTE INTERNACIONAL\" 
                  id=\"TRANSPORTEINTERNACIONAL\" 
                  name=\"categoria_8\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  TRANSPORTE INTERNO (NACIONAL)
                  <input type=\"checkbox\"  
                  value=\"TRANSPORTE INTERNO\" 
                  id=\"TRANSPORTEINTERNO\" 
                  name=\"categoria_9\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  OTROS SERVICIOS
                  <input type=\"checkbox\" 
                  value=\"OTROS SERVICIOS\" 
                  id=\"OTROSSERVICIOS\" 
                  name=\"categoria_10\">             
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
               rows=\"3\">";
        // line 148
        echo $this->getAttribute(($context["supplier"] ?? null), "comentarios", array());
        echo "</textarea>
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
        // line 158
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/listar/\" class=\"btn btn-default btn-sm\"> 
         <span class=\"fa fa-arrow-left fa-fw\"></span>
         Volver Lista Proveedores
         </a>
      </div>
   </div>
</form>
<script type=\"text/javascript\">
      
    checkboxList(";
        // line 167
        echo ($context["data"] ?? null);
        echo ");
    //da chequed con jquery
   function checkboxList(categorias){
    \$.each(categorias, function(key, value){
      value = value.replace(/ /gi, '');
      \$('#'+ value ).prop('checked', true);
    });
   }

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
        return "forms/frm_proveedor_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  222 => 167,  210 => 158,  197 => 148,  93 => 47,  78 => 34,  74 => 32,  70 => 30,  68 => 29,  63 => 27,  59 => 26,  45 => 15,  31 => 4,  27 => 3,  23 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set categorias  = supplier.categoria | split(';') %} 
    {% set data = categorias | json_encode() %};
<form method=\"post\" action=\"{{rute_url}}proveedor/validar\">
  <input type=\"hidden\" name=\"id_proveedor\" value=\"{{supplier.id_proveedor}}\">
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
               value=\"{{supplier.identificacion_proveedor}}\"
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
               <option value=\"{{supplier.tipo_provedor}}\" selected=\"true\">
                  {{supplier.tipo_provedor}}
               </option>
               {% if supplier.tipo_provedor == 'NACIONAL' %}
               <option value=\"INTERNACIONAL\">INTERNACIONAL</option>
               {% else %}
               <option value=\"NACIONAL\">NACIONAL</option>
               {% endif %}
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
               name=\"nombre\"
               value=\"{{supplier.nombre}}\">
         </div>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-lg-6\">
         <div class=\"form-group\">
            <label>SELECCIONE LA CATEGORIA O CATEGORIAS A LA QUE PERTENECE</label>
          <!-- inicio -->
            <div class=\"control-group text-info\" id=\"categoria\">
               <label class=\"control control-checkbox\">
                  ADUANA DEL ECUADOR
                  <input type=\"checkbox\" 
                  value=\"ADUANA\" 
                  id=\"ADUANA\" 
                  name=\"categoria_1\"/>
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  AGENTE DE ADUANAS
                  <input type=\"checkbox\"  
                  value=\"AGENTE DE ADUANAS\" 
                  id=\"AGENTEDEADUANAS\" 
                  name=\"categoria_2\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  ALMACENAJE
                  <input type=\"checkbox\"  
                  value=\"ALMACENAJE\" 
                  id=\"ALMACENAJE\" 
                  name=\"categoria_3\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  BODEGAJE
                  <input type=\"checkbox\"  
                  value=\"BODEGAJE\" 
                  id=\"BODEGAJE\" 
                  name=\"categoria_4\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  CANDADO SATELITAL
                  <input type=\"checkbox\"  
                  value=\"CANDADO SATELITAL\" 
                  id=\"CANDADOSATELITAL\" 
                  name=\"categoria_5\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  CUSTODIA ARMADA
                  <input type=\"checkbox\"  
                  value=\"CUSTODIA ARMADA\" 
                  id=\"CUSTODIAARMADA\" 
                  name=\"categoria_6\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  PROVEEDOR DE LICORES
                  <input type=\"checkbox\"  
                  value=\"PROVEEDOR DE LICORES\" 
                  id=\"PROVEEDORDELICORES\" 
                  name=\"categoria_7\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  TRANSPORTE INTERNACIONAL
                  <input type=\"checkbox\"  
                  value=\"TRANSPORTE INTERNACIONAL\" 
                  id=\"TRANSPORTEINTERNACIONAL\" 
                  name=\"categoria_8\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  TRANSPORTE INTERNO (NACIONAL)
                  <input type=\"checkbox\"  
                  value=\"TRANSPORTE INTERNO\" 
                  id=\"TRANSPORTEINTERNO\" 
                  name=\"categoria_9\">             
                  <div class=\"control_indicator\"></div>
               </label>
               <label class=\"control control-checkbox\">
                  OTROS SERVICIOS
                  <input type=\"checkbox\" 
                  value=\"OTROS SERVICIOS\" 
                  id=\"OTROSSERVICIOS\" 
                  name=\"categoria_10\">             
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
               rows=\"3\">{{ supplier.comentarios | raw }}</textarea>
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
      
    checkboxList({{ data | raw}});
    //da chequed con jquery
   function checkboxList(categorias){
    \$.each(categorias, function(key, value){
      value = value.replace(/ /gi, '');
      \$('#'+ value ).prop('checked', true);
    });
   }

   \$('#nombre_proveedor').keyup(function(){
      this.value = this.value.toUpperCase();
   });
   
   \$('#comentarios').keyup(function(){
      this.value = this.value.toUpperCase();
   });
</script>", "forms/frm_proveedor_edit.html.twig", "/var/www/html/app/src/views/forms/frm_proveedor_edit.html.twig");
    }
}
