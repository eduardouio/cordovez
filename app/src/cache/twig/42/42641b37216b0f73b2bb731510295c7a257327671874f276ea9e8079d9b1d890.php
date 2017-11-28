<?php

/* /pages/pageGastoInicial.html.twig */
class __TwigTemplate_ba9de1efddf985d44af30599947ecf3720d4488377107738330072e79948f976 extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pageGastoInicial.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pageGastoInicial.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pageGastoInicial.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pageGastoInicial.html.twig", 4)->display($context);
        // line 5
        echo "



";
        // line 9
        if ((($context["validateExpenses"] ?? null) == true)) {
            // line 10
            echo "\t";
            $this->loadTemplate("sections/validar-pedido.html.twig", "/pages/pageGastoInicial.html.twig", 10)->display($context);
        }
        // line 12
        echo "
";
        // line 13
        if ((($context["show"] ?? null) == true)) {
            // line 14
            echo "\t";
            $this->loadTemplate("sections/mostrar-gasto-inicial.html.twig", "/pages/pageGastoInicial.html.twig", 14)->display($context);
        }
        // line 16
        echo "

";
        // line 18
        if ((($context["create"] ?? null) == true)) {
            // line 19
            echo "\t";
            $this->loadTemplate("forms/frm-gasto-inicial.html.twig", "/pages/pageGastoInicial.html.twig", 19)->display($context);
            echo "    
";
        }
        // line 21
        echo "
";
        // line 22
        if ((($context["edit"] ?? null) == true)) {
            // line 23
            echo "\t";
            $this->loadTemplate("forms/frm-gasto-inicial-edit.html.twig", "/pages/pageGastoInicial.html.twig", 23)->display($context);
            echo "    
";
        }
        // line 25
        echo "

";
        // line 27
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 28
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 29
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<br><br>
\t\t<p>
\t\t\t";
            // line 32
            if ((($context["deleted"] ?? null) == true)) {
                echo " 
\t\t\t\t\t\t<a href=\"";
                // line 33
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
                // line 39
                echo "  
\t\t\t\t<a href=\"";
                // line 40
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
            // line 47
            echo "\t\t
\t\t</p>
\t</div>
";
        }
        // line 51
        echo "
";
        // line 52
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageGastoInicial.html.twig", 52)->display($context);
        // line 53
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageGastoInicial.html.twig", 53)->display($context);
        // line 54
        $this->loadTemplate("base/footer.html.twig", "/pages/pageGastoInicial.html.twig", 54)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pageGastoInicial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 54,  128 => 53,  126 => 52,  123 => 51,  117 => 47,  105 => 40,  102 => 39,  90 => 33,  86 => 32,  80 => 29,  77 => 28,  75 => 27,  71 => 25,  65 => 23,  63 => 22,  60 => 21,  54 => 19,  52 => 18,  48 => 16,  44 => 14,  42 => 13,  39 => 12,  35 => 10,  33 => 9,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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




{% if validateExpenses == true %}
\t{% include 'sections/validar-pedido.html.twig' %}
{% endif %}

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
{% include 'base/footer.html.twig' %}", "/pages/pageGastoInicial.html.twig", "/var/www/html/app/src/views/pages/pageGastoInicial.html.twig");
    }
}
