<?php

/* base/navbarleft.html.twig */
class __TwigTemplate_8b7df51605ddbae17c1925e43addc0f7a6c011cb032a0ce658101d891ccf9cae extends Twig_Template
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
                            <a href=\"index.html\"><i class=\"fa fa-dashboard fa-fw\"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href=\"tables.html\"><i class=\"fa fa-cubes fa-fw\"></i> Pedidos</a>
                        </li>
                        <li>
                            <a href=\"forms.html\"><i class=\"fa fa-users fa-fw\"></i> Proveedores</a>
                        </li>
                        <li>
                            <a href=\"forms.html\"><i class=\"fa fa-list fa-fw\"></i>Nacionalizaciones</a>
                        </li>
                        <li>
                            <a href=\"forms.html\"><i class=\"fa fa-gears fa-fw\"></i>Opciones</a>
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
        return new Twig_Source("", "base/navbarleft.html.twig", "/var/www/html/app/src/views/base/navbarleft.html.twig");
    }
}
