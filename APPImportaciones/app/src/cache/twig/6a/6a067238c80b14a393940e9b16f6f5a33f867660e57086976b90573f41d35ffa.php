<?php

/* /pages/pagePedido.html.twig */
class __TwigTemplate_ba17bb7cef801e71af5f0e66bf7b514ab9aa086f37ac57455aa0bc8a91ccde3f extends Twig_Template
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
        $this->loadTemplate("base/titlecontent.html.twig", "/pages/pagePedido.html.twig", 4)->display($context);
        // line 5
        $this->loadTemplate("base/contentopen.html.twig", "/pages/pagePedido.html.twig", 5)->display($context);
        // line 6
        $this->loadTemplate("base/appjs.html.twig", "/pages/pagePedido.html.twig", 6)->display($context);
        // line 7
        $this->loadTemplate("base/contentclose.html.twig", "/pages/pagePedido.html.twig", 7)->display($context);
        // line 8
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pagePedido.html.twig", 8)->display($context);
        // line 9
        $this->loadTemplate("base/footer.html.twig", "/pages/pagePedido.html.twig", 9)->display($context);
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
        return new Twig_Source("", "/pages/pagePedido.html.twig", "/var/www/html/app/src/views/pages/pagePedido.html.twig");
    }
}
