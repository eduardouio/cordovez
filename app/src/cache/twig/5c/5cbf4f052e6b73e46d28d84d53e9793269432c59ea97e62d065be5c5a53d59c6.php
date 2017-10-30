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
        // line 6
        if ((($context["show"] ?? null) == true)) {
            // line 7
            echo "\t";
            $this->loadTemplate("sections/mostrar-gasto-inicial.html.twig", "/pages/pageGasto-inicial.html.twig", 7)->display($context);
        }
        // line 9
        echo "

";
        // line 11
        if ((($context["create"] ?? null) == true)) {
            // line 12
            echo "\t";
            $this->loadTemplate("forms/frm-gasto-inicial.html.twig", "/pages/pageGasto-inicial.html.twig", 12)->display($context);
            echo "    
";
        }
        // line 14
        echo "
";
        // line 15
        if ((($context["edit"] ?? null) == true)) {
            // line 16
            echo "\t";
            $this->loadTemplate("forms/frm-gasto-inicial-edit.html.twig", "/pages/pageGasto-inicial.html.twig", 16)->display($context);
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
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageGasto-inicial.html.twig", 45)->display($context);
        // line 46
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageGasto-inicial.html.twig", 46)->display($context);
        // line 47
        $this->loadTemplate("base/footer.html.twig", "/pages/pageGasto-inicial.html.twig", 47)->display($context);
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
        return array (  118 => 47,  116 => 46,  114 => 45,  111 => 44,  105 => 40,  93 => 33,  90 => 32,  78 => 26,  74 => 25,  68 => 22,  65 => 21,  63 => 20,  59 => 18,  53 => 16,  51 => 15,  48 => 14,  42 => 12,  40 => 11,  36 => 9,  32 => 7,  30 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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

{% if show == true %}
\t{% include 'sections/mostrar-gasto-inicial.html.twig' %}
{% endif %}


{% if create == true %}
\t{% include 'forms/frm-gasto-inicial.html.twig' %}    
{% endif %}

{% if edit == true %}
\t{% include 'forms/frm-gasto-inicial-edit.html.twig' %}    
{% endif %}


{% if viewMessage == true %}
\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t{{ message }} </h3>
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
