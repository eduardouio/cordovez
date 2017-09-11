<?php

/* /pages/pageProveedores.html.twig */
class __TwigTemplate_8f94abd747a81847c2ed1bd58475525abec3da132391f87e8f969e0ef5bbc177 extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pageProveedores.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pageProveedores.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pageProveedores.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/titlecontent.html.twig", "/pages/pageProveedores.html.twig", 4)->display($context);
        // line 5
        $this->loadTemplate("base/contentopen.html.twig", "/pages/pageProveedores.html.twig", 5)->display($context);
        // line 6
        $this->loadTemplate("forms/frm_proveedor.html.twig", "/pages/pageProveedores.html.twig", 6)->display($context);
        // line 7
        $this->loadTemplate("base/contentclose.html.twig", "/pages/pageProveedores.html.twig", 7)->display($context);
        // line 8
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageProveedores.html.twig", 8)->display($context);
        // line 9
        $this->loadTemplate("base/footer.html.twig", "/pages/pageProveedores.html.twig", 9)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pageProveedores.html.twig";
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
{% include 'base/footer.html.twig' %}", "/pages/pageProveedores.html.twig", "/var/www/html/app/app/views/pages/pageProveedores.html.twig");
    }
}
