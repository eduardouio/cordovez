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
        echo "<div id=\"page-wrapper\">
<div class=\"row\" style=\"
    height: 72px;
\">
<br>
<nav class=\"navbar navbar-default title-";
        // line 6
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
         <a class=\"navbar-brand\">
         ";
        // line 16
        echo ($context["titleContent"] ?? null);
        echo "
         <span class=\"fa ";
        // line 17
        echo twig_escape_filter($this->env, ($context["iconTitle"] ?? null), "html", null, true);
        echo " fa-fw pull-left\"></span>
      </a>
      </div>
      <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
      </div>
</nav>
</div>
<!-- /.row -->
<div class=\"row\">
<div class=\"col-lg-12\">
<div class=\"panel panel-default\">
<div class=\"panel-body\">";
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
        return array (  43 => 17,  39 => 16,  26 => 6,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"page-wrapper\">
<div class=\"row\" style=\"
    height: 72px;
\">
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
         <a class=\"navbar-brand\">
         {{ titleContent | raw }}
         <span class=\"fa {{iconTitle}} fa-fw pull-left\"></span>
      </a>
      </div>
      <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
      </div>
</nav>
</div>
<!-- /.row -->
<div class=\"row\">
<div class=\"col-lg-12\">
<div class=\"panel panel-default\">
<div class=\"panel-body\">", "base/content.html.twig", "/var/www/html/app/src/views/base/content.html.twig");
    }
}
