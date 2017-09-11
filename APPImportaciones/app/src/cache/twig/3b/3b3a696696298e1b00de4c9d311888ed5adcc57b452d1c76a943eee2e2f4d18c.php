<?php

/* /pages/pageProveedor.html.twig */
class __TwigTemplate_eef839716834b6585e122b4c7702c36326d567f3e388d0fc89e1b6d9cbf6fb22 extends Twig_Template
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
        $this->loadTemplate("base/titlecontent.html.twig", "/pages/pageProveedor.html.twig", 4)->display($context);
        // line 5
        $this->loadTemplate("base/contentopen.html.twig", "/pages/pageProveedor.html.twig", 5)->display($context);
        // line 6
        $this->loadTemplate("forms/frm_proveedor.html.twig", "/pages/pageProveedor.html.twig", 6)->display($context);
        // line 7
        $this->loadTemplate("base/contentclose.html.twig", "/pages/pageProveedor.html.twig", 7)->display($context);
        // line 8
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageProveedor.html.twig", 8)->display($context);
        // line 9
        $this->loadTemplate("base/footer.html.twig", "/pages/pageProveedor.html.twig", 9)->display($context);
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
        return array (  35 => 9,  33 => 8,  31 => 7,  29 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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
{% include 'base/titlecontent.html.twig' %}
{% include 'base/contentopen.html.twig' %}
{% include 'forms/frm_proveedor.html.twig' %}
{% include 'base/contentclose.html.twig' %}
{% include 'base/signaturefoot.html.twig' %}
{% include 'base/footer.html.twig' %}", "/pages/pageProveedor.html.twig", "/var/www/html/app/app/views/pages/pageProveedor.html.twig");
    }
}
