<?php

/* /pages/pagePedido.html.twig */
class __TwigTemplate_f3737f9f4d898e2805bc5fd3fc7a7516dc04dc6cf1a476b76585ec8fb88f152e extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pagePedido.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pagePedido.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pagePedido.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pagePedido.html.twig", 4)->display($context);
        // line 5
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pagePedido.html.twig", 5)->display($context);
        // line 6
        $this->loadTemplate("base/footer.html.twig", "/pages/pagePedido.html.twig", 6)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pagePedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% include 'base/header.html.twig' %}
{% include 'base/navbarheader.html.twig' %}
{% include 'base/navbarleft.html.twig' %}
{% include 'base/content.html.twig' %}
{% include 'base/signaturefoot.html.twig' %}
{% include 'base/footer.html.twig' %}
", "/pages/pagePedido.html.twig", "/var/www/html/app/src/views/pages/pagePedido.html.twig");
    }
}
