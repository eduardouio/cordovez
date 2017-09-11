<?php

/* base/navbarheader.html.twig */
class __TwigTemplate_8a1c68b9ca3bd2ec99c021d16d432c968600b368e22f2432cc2222b9f5007082 extends Twig_Template
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
        echo "            <!-- Navigation -->
            <nav class=\"navbar navbar-default navbar-static-top\" role=\"navigation\" style=\"margin-bottom: 0\">
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                        <span class=\"sr-only\">Toggle navigation</span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </button>
                    <a class=\"navbar-brand\" style=\"color:#333;\" href=\"index.html\"> <i class=\"glyphicon glyphicon-globe\"></i> &nbsp;Cordovez APP Import </a>

                </div>
                <!-- /.navbar-header -->

                <ul class=\"nav navbar-top-links navbar-right\">
                         <li class=\"dropdown\">
                        <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                            <i class=\"fa fa-warning fa-fw\"></i> <i class=\"fa fa-caret-down\"></i>
                        </a>
                        <ul class=\"dropdown-menu dropdown-danger\">
                            <li><a href=\"#\"><i class=\"fa fa-warning fa-fw\"></i> ";
        // line 21
        echo twig_escape_filter($this->env, ($context["Alertas"] ?? null), "html", null, true);
        echo "</a>
                            </li>
                        </ul>
                    </li>
                    <li class=\"dropdown\">
                        <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                            <i class=\"fa fa-user fa-fw\"></i> <i class=\"fa fa-caret-down\"></i>
                        </a>
                        <ul class=\"dropdown-menu dropdown-user\">
                            <li><a href=\"#\"><i class=\"fa fa-user fa-fw\"></i> Perfil de Usuario</a>
                            </li>
                            <li><a href=\"#\"><i class=\"fa fa-gear fa-fw\"></i> Configuraciones</a>
                            </li>
                            <li class=\"divider\"></li>
                            <li><a href=\"login.html\"><i class=\"fa  fa-power-off fa-fw\"></i> Salir</a>
                            </li>
                        </ul>
                    </li>
                </ul>
";
    }

    public function getTemplateName()
    {
        return "base/navbarheader.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 21,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("            <!-- Navigation -->
            <nav class=\"navbar navbar-default navbar-static-top\" role=\"navigation\" style=\"margin-bottom: 0\">
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                        <span class=\"sr-only\">Toggle navigation</span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </button>
                    <a class=\"navbar-brand\" style=\"color:#333;\" href=\"index.html\"> <i class=\"glyphicon glyphicon-globe\"></i> &nbsp;Cordovez APP Import </a>

                </div>
                <!-- /.navbar-header -->

                <ul class=\"nav navbar-top-links navbar-right\">
                         <li class=\"dropdown\">
                        <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                            <i class=\"fa fa-warning fa-fw\"></i> <i class=\"fa fa-caret-down\"></i>
                        </a>
                        <ul class=\"dropdown-menu dropdown-danger\">
                            <li><a href=\"#\"><i class=\"fa fa-warning fa-fw\"></i> {{Alertas}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class=\"dropdown\">
                        <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                            <i class=\"fa fa-user fa-fw\"></i> <i class=\"fa fa-caret-down\"></i>
                        </a>
                        <ul class=\"dropdown-menu dropdown-user\">
                            <li><a href=\"#\"><i class=\"fa fa-user fa-fw\"></i> Perfil de Usuario</a>
                            </li>
                            <li><a href=\"#\"><i class=\"fa fa-gear fa-fw\"></i> Configuraciones</a>
                            </li>
                            <li class=\"divider\"></li>
                            <li><a href=\"login.html\"><i class=\"fa  fa-power-off fa-fw\"></i> Salir</a>
                            </li>
                        </ul>
                    </li>
                </ul>
", "base/navbarheader.html.twig", "/var/www/html/app/src/views/base/navbarheader.html.twig");
    }
}
