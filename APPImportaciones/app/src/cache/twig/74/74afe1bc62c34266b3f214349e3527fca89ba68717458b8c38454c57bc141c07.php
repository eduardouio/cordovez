<?php

/* base/navbarleft.html.twig */
class __TwigTemplate_4300deadf334952c73cef42b5ed5c89bb8b02a5345304865ca8333f42769c57f extends Twig_Template
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
        echo "            <div class=\"navbar-default sidebar\" role=\"navigation\">
                <div class=\"sidebar-nav navbar-collapse\">
                    <ul class=\"nav\" id=\"side-menu\">
                        <li class=\"sidebar-search\">
                            <div class=\"input-group custom-search-form\">
                                <input type=\"text\" class=\"form-control\" placeholder=\"Search...\">
                                <span class=\"input-group-btn\">
                                <button class=\"btn btn-default\" type=\"button\">
                                    <i class=\"fa fa-search\"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href=\"index.html\"><i class=\"fa fa-dashboard fa-fw\"></i> Inicio</a>
                        </li>
                        <li>
                            <a href=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/listar/\"><i class=\"fa fa-cubes fa-fw\"></i> Pedidos</a>
                        </li>
                        <li>
                            <a href=\"";
        // line 22
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/listar/\"><i class=\"fa fa-users fa-fw\"></i> Proveedores</a>
                        </li>
                        <li>
                            <a href=\"";
        // line 25
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/nacionalizacion/listar/\"><i class=\"fa fa-list fa-fw\"></i>Nacionalizaciones</a>
                        </li>
                        <li>
                            <a href=\"";
        // line 28
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/config\"><i class=\"fa fa-gears fa-fw\"></i>Opciones</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- ./Navigation -->";
    }

    public function getTemplateName()
    {
        return "base/navbarleft.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 28,  51 => 25,  45 => 22,  39 => 19,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("            <div class=\"navbar-default sidebar\" role=\"navigation\">
                <div class=\"sidebar-nav navbar-collapse\">
                    <ul class=\"nav\" id=\"side-menu\">
                        <li class=\"sidebar-search\">
                            <div class=\"input-group custom-search-form\">
                                <input type=\"text\" class=\"form-control\" placeholder=\"Search...\">
                                <span class=\"input-group-btn\">
                                <button class=\"btn btn-default\" type=\"button\">
                                    <i class=\"fa fa-search\"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href=\"index.html\"><i class=\"fa fa-dashboard fa-fw\"></i> Inicio</a>
                        </li>
                        <li>
                            <a href=\"{{rute_url}}pedido/listar/\"><i class=\"fa fa-cubes fa-fw\"></i> Pedidos</a>
                        </li>
                        <li>
                            <a href=\"{{rute_url}}proveedor/listar/\"><i class=\"fa fa-users fa-fw\"></i> Proveedores</a>
                        </li>
                        <li>
                            <a href=\"{{rute_url}}/nacionalizacion/listar/\"><i class=\"fa fa-list fa-fw\"></i>Nacionalizaciones</a>
                        </li>
                        <li>
                            <a href=\"{{rute_url}}/config\"><i class=\"fa fa-gears fa-fw\"></i>Opciones</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- ./Navigation -->", "base/navbarleft.html.twig", "/var/www/html/app/src/views/base/navbarleft.html.twig");
    }
}
