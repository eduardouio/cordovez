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
        $this->loadTemplate("base/content.html.twig", "/pages/pagePedido.html.twig", 4)->display($context);
        // line 5
        echo "
";
        // line 6
        if ((($context["list_orders"] ?? null) == true)) {
            // line 7
            echo "\t";
            $this->loadTemplate("base/sections/listar-pedidos.html.twig", "/pages/pagePedido.html.twig", 7)->display($context);
            echo "    
";
        }
        // line 9
        echo "
";
        // line 10
        if ((($context["show_order"] ?? null) == true)) {
            // line 11
            echo "\t";
            $this->loadTemplate("base/sections/show-pedido.html.twig", "/pages/pagePedido.html.twig", 11)->display($context);
            echo "    
";
        }
        // line 13
        echo "
";
        // line 14
        if ((($context["create_order"] ?? null) == true)) {
            // line 15
            echo "\t";
            $this->loadTemplate("forms/frm-pedido.html.twig", "/pages/pagePedido.html.twig", 15)->display($context);
            echo "    
";
        }
        // line 16
        echo "\t

";
        // line 18
        $this->loadTemplate("base/content_close.html.twig", "/pages/pagePedido.html.twig", 18)->display($context);
        // line 19
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pagePedido.html.twig", 19)->display($context);
        // line 20
        $this->loadTemplate("base/footer.html.twig", "/pages/pagePedido.html.twig", 20)->display($context);
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
        return array (  68 => 20,  66 => 19,  64 => 18,  60 => 16,  54 => 15,  52 => 14,  49 => 13,  43 => 11,  41 => 10,  38 => 9,  32 => 7,  30 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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
