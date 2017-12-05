<?php

/* /pages/pageFacturasDetalles.html.twig */
class __TwigTemplate_7ce0ea0df63fbdb5f7d642ec9a0ecb07a4b646c3c7d075b2cc7505c24dd4883f extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pageFacturasDetalles.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pageFacturasDetalles.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pageFacturasDetalles.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pageFacturasDetalles.html.twig", 4)->display($context);
        // line 5
        echo "

";
        // line 7
        if ((($context["create"] ?? null) == true)) {
            // line 8
            echo "\t";
            $this->loadTemplate("forms/frm-facturas-detalle.html.twig", "/pages/pageFacturasDetalles.html.twig", 8)->display($context);
            echo "    
";
        }
        // line 10
        echo "
";
        // line 11
        if ((($context["edit"] ?? null) == true)) {
            // line 12
            $this->loadTemplate("forms/frm-facturas-detalle-edit.html.twig", "/pages/pageFacturasDetalles.html.twig", 12)->display($context);
            echo "    
";
        }
        // line 14
        echo "
";
        // line 15
        if ((($context["show"] ?? null) == true)) {
            // line 16
            $this->loadTemplate("sections/mostrar-facturas-detalle.html.twig", "/pages/pageFacturasDetalles.html.twig", 16)->display($context);
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
                echo "facturapagos/presentar/";
                echo twig_escape_filter($this->env, ($context["idRow"] ?? null), "html", null, true);
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
                echo "facturapagos/presentar/";
                echo twig_escape_filter($this->env, ($context["idRow"] ?? null), "html", null, true);
                echo "\">
\t\t<button>
\t\t\t<span class=\"fa fa-eye\"></span>
\t\t\tVer
\t\t</button>
\t\t</a>
\t\t\t";
            }
            // line 40
            echo "\t\t</p>
\t</div>
";
        }
        // line 43
        echo "
";
        // line 44
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageFacturasDetalles.html.twig", 44)->display($context);
        // line 45
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageFacturasDetalles.html.twig", 45)->display($context);
        // line 46
        $this->loadTemplate("base/footer.html.twig", "/pages/pageFacturasDetalles.html.twig", 46)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pageFacturasDetalles.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 46,  115 => 45,  113 => 44,  110 => 43,  105 => 40,  93 => 33,  90 => 32,  78 => 26,  74 => 25,  68 => 22,  65 => 21,  63 => 20,  59 => 18,  54 => 16,  52 => 15,  49 => 14,  44 => 12,  42 => 11,  39 => 10,  33 => 8,  31 => 7,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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


{% if create == true %}
\t{% include 'forms/frm-facturas-detalle.html.twig' %}    
{% endif %}

{% if edit == true %}
{% include 'forms/frm-facturas-detalle-edit.html.twig' %}    
{% endif %}

{% if show == true %}
{% include 'sections/mostrar-facturas-detalle.html.twig' %}    
{% endif %}


{% if viewMessage == true %}
\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t{{message}} </h3>
\t\t<br><br>
\t\t<p>
\t\t\t{% if deleted == true %} 
\t\t\t\t\t\t<a href=\"{{rute_url}}facturapagos/presentar/{{idRow}}\"> 
\t\t\t\t<button>
\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\tVer
\t\t\t\t</button>
\t\t\t\t</a>
\t\t\t{% else %}  
\t\t\t\t<a href=\"{{rute_url}}facturapagos/presentar/{{idRow}}\">
\t\t<button>
\t\t\t<span class=\"fa fa-eye\"></span>
\t\t\tVer
\t\t</button>
\t\t</a>
\t\t\t{% endif %}
\t\t</p>
\t</div>
{% endif %}

{% include 'base/content_close.html.twig' %}
{% include 'base/signaturefoot.html.twig' %}
{% include 'base/footer.html.twig' %}", "/pages/pageFacturasDetalles.html.twig", "/var/www/html/app/src/views/pages/pageFacturasDetalles.html.twig");
    }
}
