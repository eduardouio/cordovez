<?php

/* /pages/pageFactutaInformativa.html.twig */
class __TwigTemplate_24c1be9abb03e1d5fedc352e7431e529a7ff27d6e0a31d1ee3f3a7ef45925a5b extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pageFactutaInformativa.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pageFactutaInformativa.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pageFactutaInformativa.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pageFactutaInformativa.html.twig", 4)->display($context);
        // line 5
        echo "
";
        // line 6
        if ((($context["show_invoices"] ?? null) == true)) {
            // line 7
            echo "\t";
            $this->loadTemplate("sections/mostrar-pedido-factura.html.twig", "/pages/pageFactutaInformativa.html.twig", 7)->display($context);
        }
        // line 9
        echo "
";
        // line 10
        if ((($context["create_invoice"] ?? null) == true)) {
            // line 11
            echo "\t";
            $this->loadTemplate("forms/frm-factura-informativa.html.twig", "/pages/pageFactutaInformativa.html.twig", 11)->display($context);
            echo "  
";
        }
        // line 13
        echo "
";
        // line 14
        if ((($context["edit_invoice"] ?? null) == true)) {
            // line 15
            echo "\t";
            $this->loadTemplate("forms/frm-pedido-factura-edit.html.twig", "/pages/pageFactutaInformativa.html.twig", 15)->display($context);
            echo "    
";
        }
        // line 17
        echo "

";
        // line 19
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 20
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 21
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<br><br>
\t\t<ul>
\t\t";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["input"]) {
                // line 25
                echo "\t\t\t<li>";
                echo twig_escape_filter($this->env, $context["input"], "html", null, true);
                echo "</li>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['input'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "\t\t</ul>
\t\t<p>
\t\t\t";
            // line 29
            if ((($context["deleted"] ?? null) == true)) {
                echo " 
\t\t\t\t\t\t<a href=\"";
                // line 30
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
                // line 36
                echo "  
\t\t\t\t<a href=\"";
                // line 37
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
            // line 44
            echo "\t\t
\t\t</p>
\t</div>
";
        }
        // line 48
        echo "
";
        // line 49
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageFactutaInformativa.html.twig", 49)->display($context);
        // line 50
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageFactutaInformativa.html.twig", 50)->display($context);
        // line 51
        $this->loadTemplate("base/footer.html.twig", "/pages/pageFactutaInformativa.html.twig", 51)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pageFactutaInformativa.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 51,  132 => 50,  130 => 49,  127 => 48,  121 => 44,  109 => 37,  106 => 36,  94 => 30,  90 => 29,  86 => 27,  77 => 25,  73 => 24,  67 => 21,  64 => 20,  62 => 19,  58 => 17,  52 => 15,  50 => 14,  47 => 13,  41 => 11,  39 => 10,  36 => 9,  32 => 7,  30 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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
\t{% include 'sections/mostrar-pedido-factura.html.twig' %}
{% endif %}

{% if create_invoice == true %}
\t{% include 'forms/frm-factura-informativa.html.twig' %}  
{% endif %}

{% if edit_invoice == true %}
\t{% include 'forms/frm-pedido-factura-edit.html.twig' %}    
{% endif %}


{% if viewMessage == true %}
\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t{{message}} </h3>
\t\t<br><br>
\t\t<ul>
\t\t{% for input in data %}
\t\t\t<li>{{input}}</li>
\t\t{% endfor %}
\t\t</ul>
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
{% include 'base/footer.html.twig' %}", "/pages/pageFactutaInformativa.html.twig", "/var/www/html/app/src/views/pages/pageFactutaInformativa.html.twig");
    }
}
