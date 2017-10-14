<?php

/* /pages/pageGasto-inicial.html.twig */
class __TwigTemplate_c8b22148e41078505aa17dcdbfd1e65266fb56ad2d090bc0ddb68fa695769789 extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pageGasto-inicial.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pageGasto-inicial.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pageGasto-inicial.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pageGasto-inicial.html.twig", 4)->display($context);
        // line 5
        echo "


";
        // line 8
        if ((($context["create"] ?? null) == true)) {
            // line 9
            echo "\t";
            $this->loadTemplate("forms/frm-gasto-inicial.html.twig", "/pages/pageGasto-inicial.html.twig", 9)->display($context);
            echo "    
";
        }
        // line 11
        echo "
";
        // line 12
        if ((($context["edit"] ?? null) == true)) {
            // line 13
            echo "\t";
            $this->loadTemplate("forms/frm-gasto-inicial-edit.html.twig", "/pages/pageGasto-inicial.html.twig", 13)->display($context);
            echo "    
";
        }
        // line 15
        echo "

";
        // line 17
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 18
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 19
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<br><br>
\t\t<p>
\t\t\t";
            // line 22
            if ((($context["deleted"] ?? null) == true)) {
                echo " 
\t\t\t\t\t\t<a href=\"";
                // line 23
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
                // line 29
                echo "  
\t\t\t\t<a href=\"";
                // line 30
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
            // line 37
            echo "\t\t
\t\t</p>
\t</div>
";
        }
        // line 41
        echo "
";
        // line 42
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageGasto-inicial.html.twig", 42)->display($context);
        // line 43
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageGasto-inicial.html.twig", 43)->display($context);
        // line 44
        $this->loadTemplate("base/footer.html.twig", "/pages/pageGasto-inicial.html.twig", 44)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pageGasto-inicial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 44,  108 => 43,  106 => 42,  103 => 41,  97 => 37,  85 => 30,  82 => 29,  70 => 23,  66 => 22,  60 => 19,  57 => 18,  55 => 17,  51 => 15,  45 => 13,  43 => 12,  40 => 11,  34 => 9,  32 => 8,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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
\t{% include 'forms/frm-gasto-inicial.html.twig' %}    
{% endif %}

{% if edit == true %}
\t{% include 'forms/frm-gasto-inicial-edit.html.twig' %}    
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
{% include 'base/footer.html.twig' %}", "/pages/pageGasto-inicial.html.twig", "/var/www/html/app/src/views/pages/pageGasto-inicial.html.twig");
    }
}
