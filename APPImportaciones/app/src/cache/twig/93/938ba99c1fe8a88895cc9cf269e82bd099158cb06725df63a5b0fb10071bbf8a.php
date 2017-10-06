<?php

/* base/content.html.twig */
class __TwigTemplate_0441768f18b4b85298f268ae9e67e6cac61b9bba8a36e9eeaf18b2a3138124df extends Twig_Template
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
        <div id=\"page-wrapper\">
            <div class=\"row\">
                <br>
                        <nav class=\"navbar navbar-default title-";
        // line 5
        echo twig_escape_filter($this->env, ($context["controller"] ?? null), "html", null, true);
        echo "\" container>
  <div class=\"container-fluid\">
    <div class=\"navbar-header\">
      <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </button>
      <a class=\"navbar-brand\" href=\"#\">";
        // line 14
        echo twig_escape_filter($this->env, ($context["titleContent"] ?? null), "html", null, true);
        echo " <span class=\"fa ";
        echo twig_escape_filter($this->env, ($context["iconTitle"] ?? null), "html", null, true);
        echo " fa-fw pull-right\"></span></a>
    </div>
    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
      <ul class=\"nav navbar-nav\" style=\"color: #fff\">
        <li class=\"active\"><a href=\"\"><span class=\"fa fa-list fa-fw\"></span> Listar Pedidos <span class=\"sr-only\">(current)</span></a></li>
        <li><a href=\"#/nuevo-pedido\"><span class=\"fa fa-file fa-fw\"></span> Nuevo Pedido</a></li>
        <li><a href=\"\"><span class=\"fa fa-money fa-fw\"></span> Registrar Gasto</a></li>
      </ul>
    </div>
  </nav>
                
            </div>
            <!-- /.row -->
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"panel panel-default \">

                        <div class=\"panel-body\">
                            <div ng-view class=\"\">
                                
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->";
    }

    public function getTemplateName()
    {
        return "base/content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 14,  25 => 5,  19 => 1,);
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
        <div id=\"page-wrapper\">
            <div class=\"row\">
                <br>
                        <nav class=\"navbar navbar-default title-{{controller}}\" container>
  <div class=\"container-fluid\">
    <div class=\"navbar-header\">
      <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </button>
      <a class=\"navbar-brand\" href=\"#\">{{titleContent}} <span class=\"fa {{iconTitle}} fa-fw pull-right\"></span></a>
    </div>
    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
      <ul class=\"nav navbar-nav\" style=\"color: #fff\">
        <li class=\"active\"><a href=\"\"><span class=\"fa fa-list fa-fw\"></span> Listar Pedidos <span class=\"sr-only\">(current)</span></a></li>
        <li><a href=\"#/nuevo-pedido\"><span class=\"fa fa-file fa-fw\"></span> Nuevo Pedido</a></li>
        <li><a href=\"\"><span class=\"fa fa-money fa-fw\"></span> Registrar Gasto</a></li>
      </ul>
    </div>
  </nav>
                
            </div>
            <!-- /.row -->
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"panel panel-default \">

                        <div class=\"panel-body\">
                            <div ng-view class=\"\">
                                
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->", "base/content.html.twig", "/var/www/html/app/src/views/base/content.html.twig");
    }
}
