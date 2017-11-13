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
        echo "<body>
<!-- ./header -->    
    <div id=\"wrapper\">
        <!-- Navigation -->
        <nav class=\"navbar navbar-default navbar-static-top\" role=\"navigation\" style=\"margin-bottom: 0\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                  <a class=\"navbar-brand\" style=\"color:#333;\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "\"> <i class=\"glyphicon glyphicon-globe\"></i> &nbsp;Cordovez APP Import </a>
            </div>
            <!-- /.navbar-header -->

            <ul class=\"nav navbar-top-links navbar-right\">
                <li>
                    <a href=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/nuevo/\">
                     <i class=\"fa fa-cubes fa-fw\"></i> 
                     <small>Nuevo Pedido</small>
                     </a>
                </li>
                <li>
                    <a href=\"";
        // line 25
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "facturapagos/nuevo/\">
                        <i class=\"fa fa-file-text-o fa-fw\"></i>
                        <small>Nueva Factura</small>
                    </a>
                </li>
                <li>
                    <a href=\"";
        // line 31
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "proveedor/nuevo/\">
                     <i class=\"fa fa-users fa-fw\"></i> 
                     <small>Nuevo Proveedor</small>
                     </a>
                </li>
                <li>
                    <a href=\"";
        // line 37
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "producto/nuevo/\">
                     <i class=\"fa fa-cube fa-fw\"></i> 
                     <small>Nuevo Producto</small>
                     </a>
                </li>
                         <!-- /.dropdown -->
                <li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                        <i class=\"fa fa-gear fa-fw\"></i> <i class=\"fa fa-caret-down\"></i>
                    </a>
                    <ul class=\"dropdown-menu dropdown-user\">
                        <li><a href=\"#\"><i class=\"fa fa-user fa-fw\"></i> User Profile</a>
                        </li>
                        <li><a href=\"#\"><i class=\"fa fa-gear fa-fw\"></i> Settings</a>
                        </li>
                        <li class=\"divider\"></li>
                        <li><a href=\"";
        // line 53
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "index.php/login/cerrarSesion\"><i class=\"fa fa-sign-out fa-fw\"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
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
        return array (  88 => 53,  69 => 37,  60 => 31,  51 => 25,  42 => 19,  33 => 13,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<body>
<!-- ./header -->    
    <div id=\"wrapper\">
        <!-- Navigation -->
        <nav class=\"navbar navbar-default navbar-static-top\" role=\"navigation\" style=\"margin-bottom: 0\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                  <a class=\"navbar-brand\" style=\"color:#333;\" href=\"{{base_url}}\"> <i class=\"glyphicon glyphicon-globe\"></i> &nbsp;Cordovez APP Import </a>
            </div>
            <!-- /.navbar-header -->

            <ul class=\"nav navbar-top-links navbar-right\">
                <li>
                    <a href=\"{{rute_url}}pedido/nuevo/\">
                     <i class=\"fa fa-cubes fa-fw\"></i> 
                     <small>Nuevo Pedido</small>
                     </a>
                </li>
                <li>
                    <a href=\"{{rute_url}}facturapagos/nuevo/\">
                        <i class=\"fa fa-file-text-o fa-fw\"></i>
                        <small>Nueva Factura</small>
                    </a>
                </li>
                <li>
                    <a href=\"{{rute_url}}proveedor/nuevo/\">
                     <i class=\"fa fa-users fa-fw\"></i> 
                     <small>Nuevo Proveedor</small>
                     </a>
                </li>
                <li>
                    <a href=\"{{rute_url}}producto/nuevo/\">
                     <i class=\"fa fa-cube fa-fw\"></i> 
                     <small>Nuevo Producto</small>
                     </a>
                </li>
                         <!-- /.dropdown -->
                <li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                        <i class=\"fa fa-gear fa-fw\"></i> <i class=\"fa fa-caret-down\"></i>
                    </a>
                    <ul class=\"dropdown-menu dropdown-user\">
                        <li><a href=\"#\"><i class=\"fa fa-user fa-fw\"></i> User Profile</a>
                        </li>
                        <li><a href=\"#\"><i class=\"fa fa-gear fa-fw\"></i> Settings</a>
                        </li>
                        <li class=\"divider\"></li>
                        <li><a href=\"{{base_url}}index.php/login/cerrarSesion\"><i class=\"fa fa-sign-out fa-fw\"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
            </ul>
            ", "base/navbarheader.html.twig", "/var/www/html/app/src/views/base/navbarheader.html.twig");
    }
}
