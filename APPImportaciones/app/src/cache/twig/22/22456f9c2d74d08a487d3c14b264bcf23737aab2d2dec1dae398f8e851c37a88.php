<?php

/* /pages/pageProveedor.html.twig */
class __TwigTemplate_303f03313615935b06d329fa806cb2801ece898f646a742ebab8f525d2ec6383 extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pageProveedor.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pageProveedor.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pageProveedor.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pageProveedor.html.twig", 4)->display($context);
        // line 5
        echo "
";
        // line 6
        $this->loadTemplate("base/sections/mostrar-proveedor.html.twig", "/pages/pageProveedor.html.twig", 6)->display($context);
        echo "\t

";
        // line 8
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageProveedor.html.twig", 8)->display($context);
        // line 9
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageProveedor.html.twig", 9)->display($context);
        // line 10
        $this->loadTemplate("base/footer.html.twig", "/pages/pageProveedor.html.twig", 10)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pageProveedor.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 10,  37 => 9,  35 => 8,  30 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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

{% include 'base/sections/mostrar-proveedor.html.twig' %}\t

{% include 'base/content_close.html.twig' %}
{% include 'base/signaturefoot.html.twig' %}
{% include 'base/footer.html.twig' %}", "/pages/pageProveedor.html.twig", "/var/www/html/app/src/views/pages/pageProveedor.html.twig");
    }
}
