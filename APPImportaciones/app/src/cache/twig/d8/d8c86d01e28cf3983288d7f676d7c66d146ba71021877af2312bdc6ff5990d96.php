<?php

/* base/content.html.twig */
class __TwigTemplate_533ef1965710aa661bac1697bf290dd20ae526d660062355ac58d490bfdd76e4 extends Twig_Template
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
        echo "
                <!-- /.row -->
                <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <div class=\"panel panel-default\">
                            <div class=\"panel-heading\">
                                Ingrese La Información del Proveedor
                                <div class=\"panel-body\">
                                    <div class=\"row\">
                                            <form role=\"form\">
                                        <div class=\"col-lg-3\">
                                                <div class=\"form-group\">
                                                    <label>Identificacion Proveedor: </label>
                                                    <input 
                                                        class=\"form-control\" 
                                                        required=\"true\" 
                                                        type=\"text\" 
                                                        maxlength=\"13\" 
                                                        name=\"proveedor.identificacion_proveedor\" 
                                                        ng-model=\"proveedor.identificacion_proveedor\"
                                                    />
                                                </div>
                                        </div>
                                        <div class=\"col-lg-3\">

                                                <div class=\"form-group\">
                                                    <label>Tipo de Proveedor:</label>
                                                    <select
                                                    class = \"form-control\"
                                                    name = \"proveedor.tipo_provedor\"
                                                    ng-model= \"proveedor.tipo_provedor\"
                                                    > 
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
                                                        ng-model=\"proveedor.nombre\" 
                                                        name=\"proveedor.nombre\">
                                                </div>
                                            </div>
                                            <div class=\"row\">
                                            <div class=\"col-lg-6\">
                                                <div class=\"form-group\">
                                                    <label>Seleccione una Categoría</label>
                                                    <select ng-model=\"proveedor.categoria\" class=\"form-control\">
                                                        <option>SELECCIONE ...</option>
                                                        <option value=\"ADUANA\">ADUANA</option>
                                                        <option value=\"AGENTE DE ADUANAS\">AGENTE DE ADUANAS</option>
                                                        <option value=\"ALMACENAJE\">ALMACENAJE</option>
                                                        <option value=\"BODEGAJE GYE\">BODEGAJE GYE</option>
                                                        <option value=\"CANDADO SATELITAL\">CANDADO SATELITAL</option>
                                                        <option value=\"CUSTODIA ARMADA\">CUSTODIA ARMADA</option>
                                                        <option value=\"LICORES\">LICORES</option>
                                                        <option value=\"POLIZAS\">POLIZAS</option>
                                                        <option value=\"TRANSPORTE INTERNACIONAL\">TRANSPORTE INTERNACIONAL</option>
                                                        <option value=\"TRANSPORTE INTERNO\">TRANSPORTE INTERNO</option>
                                                    </select>
                                                </div>
                                                </div>
                                                <div class=\"col-lg-6\">
                                                <div class=\"form-group\">
                                                    <label>Notas</label>
                                                    <textarea class=\"form-control\" rows=\"3\"></textarea>
                                                </div>

                                        </div>
                                        </div>
                                        <div class=\"row\">
                                        <div class=\"col-lg-12\">
                                           <button type=\"submit\" class=\"btn btn-default\">
                                           <span class=\"fa fa-save fa-fw\"></span>
                                            Guardar Proveedor</button>
                                           <button type=\"reset\" class=\"btn btn-default\">
                                           <span class=\"fa fa-refresh fa-fw\"></span>
                                           Limpiar Formulario</button>
                                           
                                            <a class=\"btn btn-info pull-right\">
                                           <span class=\"fa fa-warning fa-fw\"></span>
                                            Cancelar </a>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
 
";
    }

    public function getTemplateName()
    {
        return "base/content.html.twig";
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
        return new Twig_Source("
                <!-- /.row -->
                <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <div class=\"panel panel-default\">
                            <div class=\"panel-heading\">
                                Ingrese La Información del Proveedor
                                <div class=\"panel-body\">
                                    <div class=\"row\">
                                            <form role=\"form\">
                                        <div class=\"col-lg-3\">
                                                <div class=\"form-group\">
                                                    <label>Identificacion Proveedor: </label>
                                                    <input 
                                                        class=\"form-control\" 
                                                        required=\"true\" 
                                                        type=\"text\" 
                                                        maxlength=\"13\" 
                                                        name=\"proveedor.identificacion_proveedor\" 
                                                        ng-model=\"proveedor.identificacion_proveedor\"
                                                    />
                                                </div>
                                        </div>
                                        <div class=\"col-lg-3\">

                                                <div class=\"form-group\">
                                                    <label>Tipo de Proveedor:</label>
                                                    <select
                                                    class = \"form-control\"
                                                    name = \"proveedor.tipo_provedor\"
                                                    ng-model= \"proveedor.tipo_provedor\"
                                                    > 
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
                                                        ng-model=\"proveedor.nombre\" 
                                                        name=\"proveedor.nombre\">
                                                </div>
                                            </div>
                                            <div class=\"row\">
                                            <div class=\"col-lg-6\">
                                                <div class=\"form-group\">
                                                    <label>Seleccione una Categoría</label>
                                                    <select ng-model=\"proveedor.categoria\" class=\"form-control\">
                                                        <option>SELECCIONE ...</option>
                                                        <option value=\"ADUANA\">ADUANA</option>
                                                        <option value=\"AGENTE DE ADUANAS\">AGENTE DE ADUANAS</option>
                                                        <option value=\"ALMACENAJE\">ALMACENAJE</option>
                                                        <option value=\"BODEGAJE GYE\">BODEGAJE GYE</option>
                                                        <option value=\"CANDADO SATELITAL\">CANDADO SATELITAL</option>
                                                        <option value=\"CUSTODIA ARMADA\">CUSTODIA ARMADA</option>
                                                        <option value=\"LICORES\">LICORES</option>
                                                        <option value=\"POLIZAS\">POLIZAS</option>
                                                        <option value=\"TRANSPORTE INTERNACIONAL\">TRANSPORTE INTERNACIONAL</option>
                                                        <option value=\"TRANSPORTE INTERNO\">TRANSPORTE INTERNO</option>
                                                    </select>
                                                </div>
                                                </div>
                                                <div class=\"col-lg-6\">
                                                <div class=\"form-group\">
                                                    <label>Notas</label>
                                                    <textarea class=\"form-control\" rows=\"3\"></textarea>
                                                </div>

                                        </div>
                                        </div>
                                        <div class=\"row\">
                                        <div class=\"col-lg-12\">
                                           <button type=\"submit\" class=\"btn btn-default\">
                                           <span class=\"fa fa-save fa-fw\"></span>
                                            Guardar Proveedor</button>
                                           <button type=\"reset\" class=\"btn btn-default\">
                                           <span class=\"fa fa-refresh fa-fw\"></span>
                                           Limpiar Formulario</button>
                                           
                                            <a class=\"btn btn-info pull-right\">
                                           <span class=\"fa fa-warning fa-fw\"></span>
                                            Cancelar </a>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
 
", "base/content.html.twig", "/var/www/html/app/app/views/base/content.html.twig");
    }
}
