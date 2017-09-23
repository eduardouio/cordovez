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
        echo "                <div class=\"navbar-default sidebar\" role=\"navigation\">
                    <div class=\"sidebar-nav navbar-collapse\">
                        <ul class=\"nav\" id=\"side-menu\">
                        <br>
                            <li class=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["active_dashboard"] ?? null), "html", null, true);
        echo "\">
                                <a href=\"#/\"><i class=\"fa fa-dashboard fa-fw\"></i> CPanel <span class=\"fa arrow\"></a>
                            </li>

                            <li  class = \"";
        // line 9
        echo twig_escape_filter($this->env, ($context["active_pedidos"] ?? null), "html", null, true);
        echo "\" >
                                <a href=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "index.php/pedido\"><i class=\"fa fa-cubes fa-fw\"></i> Pedidos<span class=\"fa arrow\"></span></a>
                            </li>

                            <li class=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["active_proveedores"] ?? null), "html", null, true);
        echo "\">
                                <a href=\"#/\"><i class=\"fa fa-group fa-fw\"></i> Proveedores<span class=\"fa arrow\"></span></a>
                            </li>
                            <li class=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["active_productos"] ?? null), "html", null, true);
        echo "\">
                                <a href=\"#/\"><i class=\"fa fa-dropbox fa-fw\"></i> Productos<span class=\"fa arrow\"></span></a>
                            </li>

                            <li class=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["active_parciales"] ?? null), "html", null, true);
        echo "\">
                                <a href=\"#/\"><i class=\"fa fa-list-alt fa-fw\"></i> Parciales<span class=\"fa arrow\"></span></a>

                            </li>

                            <li class=\"";
        // line 25
        echo twig_escape_filter($this->env, ($context["active_impuestos"] ?? null), "html", null, true);
        echo "\">
                                <a href=\"#/\"><i class=\"fa fa-gears fa-fw\"></i> Impuestos & Tarifas<span class=\"fa arrow\"></span></a>
                            </li>
                                                        <li class=\"";
        // line 28
        echo twig_escape_filter($this->env, ($context["active_informes"] ?? null), "html", null, true);
        echo "\">
                                <a href=\"#/\"><i class=\"fa fa-file fa-fw\"></i> Informes<span class=\"fa arrow\"></span></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
<div id=\"page-wrapper\">
";
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
        return array (  69 => 28,  63 => 25,  55 => 20,  48 => 16,  42 => 13,  36 => 10,  32 => 9,  25 => 5,  19 => 1,);
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
