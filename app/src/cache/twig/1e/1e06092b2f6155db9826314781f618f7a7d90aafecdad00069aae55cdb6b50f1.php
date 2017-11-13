<?php

/* sections/dashboard.html.twig */
class __TwigTemplate_7b173c94df26f6bd1261edc2ac4cd5907d3ad55a7a988f957beb61d9cde65f14 extends Twig_Template
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
        echo "<div class=\"row\">
                <div class=\"col-lg-3 col-md-6\">
                    <div class=\"panel panel-red\">
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-cubes fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">26 <br> Pedidos</div>
                                    <div>Módulo de Pedidos</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/listar/\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Listar Pedidos</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=\"col-lg-3 col-md-6\">
                    <div class=\"panel panel-green\">
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-users fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">12 <br>
                                     Proveedores</div>
                                    <div>Módulo Proveedores</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"";
        // line 38
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/listar/\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Lista de Provedores</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=\"col-lg-3 col-md-6\">
                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-cube fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">124 <br> 
                                    Productos</div>
                                    <div>Módulo de Productos</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"";
        // line 61
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "producto/listar/\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Listar Productos</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=\"col-lg-3 col-md-6\">
                    <div class=\"panel panel-yellow\">
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-usd fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">13 <br> Incoterms</div>
                                    <div>Módulo de Proviciones</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"#\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Listar Provisiones</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>";
    }

    public function getTemplateName()
    {
        return "sections/dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 61,  61 => 38,  35 => 15,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"row\">
                <div class=\"col-lg-3 col-md-6\">
                    <div class=\"panel panel-red\">
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-cubes fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">26 <br> Pedidos</div>
                                    <div>Módulo de Pedidos</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"{{rute_url}}pedido/listar/\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Listar Pedidos</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=\"col-lg-3 col-md-6\">
                    <div class=\"panel panel-green\">
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-users fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">12 <br>
                                     Proveedores</div>
                                    <div>Módulo Proveedores</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"{{rute_url}}proveedor/listar/\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Lista de Provedores</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=\"col-lg-3 col-md-6\">
                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-cube fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">124 <br> 
                                    Productos</div>
                                    <div>Módulo de Productos</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"{{rute_url}}producto/listar/\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Listar Productos</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=\"col-lg-3 col-md-6\">
                    <div class=\"panel panel-yellow\">
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-usd fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">13 <br> Incoterms</div>
                                    <div>Módulo de Proviciones</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"#\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Listar Provisiones</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>", "sections/dashboard.html.twig", "/var/www/html/app/src/views/sections/dashboard.html.twig");
    }
}
