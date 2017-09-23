<?php

/* base/titlecontent.html.twig */
class __TwigTemplate_40762419d499a411a15394759f3ebad0b7c395362bba7208a57223dc4827677b extends Twig_Template
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
        echo "<br>
<nav class=\"navbar navbar-default title-";
        // line 2
        echo twig_escape_filter($this->env, ($context["controller"] ?? null), "html", null, true);
        echo "\">
  <div class=\"container-fluid\">
    <div class=\"navbar-header\">
      <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </button>
      <a class=\"navbar-brand\" href=\"#\">";
        // line 11
        echo twig_escape_filter($this->env, ($context["titleContent"] ?? null), "html", null, true);
        echo " <span class=\"fa ";
        echo twig_escape_filter($this->env, ($context["iconTitle"] ?? null), "html", null, true);
        echo " fa-fw pull-right\"></span></a>
    </div>
    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
      <ul class=\"nav navbar-nav\" style=\"color: #fff\">
        <li class=\"active\"><a href=\"#\"><span class=\"fa fa-list fa-fw\"></span> Listar Pedidos <span class=\"sr-only\">(current)</span></a></li>
        <li><a href=\"#\"><span class=\"fa fa-file fa-fw\"></span> Nuevo Pedido</a></li>
        <li><a href=\"#\"><span class=\"fa fa-money fa-fw\"></span> Registrar Gasto</a></li>
      </ul>
    </div>
  </div>
</nav>
";
    }

    public function getTemplateName()
    {
        return "base/titlecontent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 11,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<br>
<nav class=\"navbar navbar-default title-{{controller}}\">
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
        <li class=\"active\"><a href=\"#\"><span class=\"fa fa-list fa-fw\"></span> Listar Pedidos <span class=\"sr-only\">(current)</span></a></li>
        <li><a href=\"#\"><span class=\"fa fa-file fa-fw\"></span> Nuevo Pedido</a></li>
        <li><a href=\"#\"><span class=\"fa fa-money fa-fw\"></span> Registrar Gasto</a></li>
      </ul>
    </div>
  </div>
</nav>
", "base/titlecontent.html.twig", "/var/www/html/app/app/views/base/titlecontent.html.twig");
    }
}
