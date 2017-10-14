<?php

/* /pages/pageGasto-incial.html.twig */
class __TwigTemplate_a9d53e0a1b7a78dcf158fa2161d4187ce30c58bec526096abe6577a2a565ecaf extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pageGasto-incial.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pageGasto-incial.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pageGasto-incial.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pageGasto-incial.html.twig", 4)->display($context);
        // line 5
        echo "
";
        // line 6
        if ((($context["show_invoices"] ?? null) == true)) {
            // line 7
            echo "\t";
            $this->loadTemplate("base/sections/show-pedido-factura.html.twig", "/pages/pageGasto-incial.html.twig", 7)->display($context);
            echo "    
";
        }
        // line 9
        echo "

";
        // line 11
        if ((($context["create_invoice"] ?? null) == true)) {
            // line 12
            echo "\t";
            $this->loadTemplate("forms/frm-pedido-factura.html.twig", "/pages/pageGasto-incial.html.twig", 12)->display($context);
            echo "    
";
        }
        // line 14
        echo "
";
        // line 15
        if ((($context["edit_invoice"] ?? null) == true)) {
            // line 16
            echo "\t";
            $this->loadTemplate("forms/frm-pedido-factura-edit.html.twig", "/pages/pageGasto-incial.html.twig", 16)->display($context);
            echo "    
";
        }
        // line 18
        echo "

";
        // line 20
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 21
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 22
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<br><br>
\t\t<p>
\t\t\t";
            // line 25
            if ((($context["deleted"] ?? null) == true)) {
                echo " 
\t\t\t\t\t\t<a href=\"";
                // line 26
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/presentar/";
                echo twig_escape_filter($this->env, ($context["order"] ?? null), "html", null, true);
                echo "\">
\t\t\t\t<button>
\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\tVer
\t\t\t\t</button>
\t\t\t\t</a>
\t\t\t";
            } else {
                // line 32
                echo "  
\t\t\t\t<a href=\"";
                // line 33
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/presentar/";
                echo twig_escape_filter($this->env, ($context["order"] ?? null), "html", null, true);
                echo "\">
\t\t<button>
\t\t\t<span class=\"fa fa-eye\"></span>
\t\t\tVer
\t\t</button>
\t\t</a>
\t\t\t";
            }
            // line 40
            echo "\t\t
\t\t</p>
\t</div>
";
        }
        // line 44
        echo "
";
        // line 45
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageGasto-incial.html.twig", 45)->display($context);
        // line 46
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageGasto-incial.html.twig", 46)->display($context);
        // line 47
        $this->loadTemplate("base/footer.html.twig", "/pages/pageGasto-incial.html.twig", 47)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pageGasto-incial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 47,  118 => 46,  116 => 45,  113 => 44,  107 => 40,  95 => 33,  92 => 32,  80 => 26,  76 => 25,  70 => 22,  67 => 21,  65 => 20,  61 => 18,  55 => 16,  53 => 15,  50 => 14,  44 => 12,  42 => 11,  38 => 9,  32 => 7,  30 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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

{% if show_invoices == true %}
\t{% include 'base/sections/show-pedido-factura.html.twig' %}    
{% endif %}


{% if create_invoice == true %}
\t{% include 'forms/frm-pedido-factura.html.twig' %}    
{% endif %}

{% if edit_invoice == true %}
\t{% include 'forms/frm-pedido-factura-edit.html.twig' %}    
{% endif %}


{% if viewMessage == true %}
\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t{{message}} </h3>
\t\t<br><br>
\t\t<p>
\t\t\t{% if deleted == true %} 
\t\t\t\t\t\t<a href=\"{{rute_url}}pedido/presentar/{{order}}\">
\t\t\t\t<button>
\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\tVer
\t\t\t\t</button>
\t\t\t\t</a>
\t\t\t{% else %}  
\t\t\t\t<a href=\"{{rute_url}}pedido/presentar/{{order}}\">
\t\t<button>
\t\t\t<span class=\"fa fa-eye\"></span>
\t\t\tVer
\t\t</button>
\t\t</a>
\t\t\t{% endif %}
\t\t
\t\t</p>
\t</div>
{% endif %}

{% include 'base/content_close.html.twig' %}
{% include 'base/signaturefoot.html.twig' %}
{% include 'base/footer.html.twig' %}", "/pages/pageGasto-incial.html.twig", "/var/www/html/app/src/views/pages/pageGasto-incial.html.twig");
    }
}
