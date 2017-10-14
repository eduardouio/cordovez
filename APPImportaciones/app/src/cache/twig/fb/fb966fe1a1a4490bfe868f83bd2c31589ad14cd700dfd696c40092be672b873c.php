<?php

/* /pages/pagePedido.html.twig */
class __TwigTemplate_f3737f9f4d898e2805bc5fd3fc7a7516dc04dc6cf1a476b76585ec8fb88f152e extends Twig_Template
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
\t<script type=\"text/javascript\" src=\"";
            // line 16
            echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
            echo "js/incoterms.js\"></script>
";
        }
        // line 17
        echo "\t

";
        // line 19
        if ((($context["edit_order"] ?? null) == true)) {
            // line 20
            echo "\t";
            $this->loadTemplate("forms/frm-pedido-edit.html.twig", "/pages/pagePedido.html.twig", 20)->display($context);
            echo "    
\t<script type=\"text/javascript\" src=\"";
            // line 21
            echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
            echo "js/incoterms.js\"></script>
";
        }
        // line 23
        echo "

";
        // line 25
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 26
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 27
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<br><br>
\t\t<p>
\t\t\t";
            // line 30
            if ((($context["deleted"] ?? null) == true)) {
                echo " 
\t\t\t\t\t\t<a href=\"";
                // line 31
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/listar/\">
\t\t\t\t<button>
\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\tVer
\t\t\t\t</button>
\t\t\t\t</a>
\t\t\t";
            } else {
                // line 37
                echo "  
\t\t\t\t<a href=\"";
                // line 38
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
            // line 45
            echo "\t\t
\t\t</p>
\t</div>
";
        }
        // line 49
        echo "
";
        // line 50
        $this->loadTemplate("base/content_close.html.twig", "/pages/pagePedido.html.twig", 50)->display($context);
        // line 51
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pagePedido.html.twig", 51)->display($context);
        // line 52
        $this->loadTemplate("base/footer.html.twig", "/pages/pagePedido.html.twig", 52)->display($context);
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
        return array (  137 => 52,  135 => 51,  133 => 50,  130 => 49,  124 => 45,  112 => 38,  109 => 37,  99 => 31,  95 => 30,  89 => 27,  86 => 26,  84 => 25,  80 => 23,  75 => 21,  70 => 20,  68 => 19,  64 => 17,  59 => 16,  54 => 15,  52 => 14,  49 => 13,  43 => 11,  41 => 10,  38 => 9,  32 => 7,  30 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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

{% if list_orders == true %}
\t{% include 'base/sections/listar-pedidos.html.twig' %}    
{% endif %}

{% if show_order == true %}
\t{% include 'base/sections/show-pedido.html.twig' %}    
{% endif %}

{% if create_order == true %}
\t{% include 'forms/frm-pedido.html.twig' %}    
\t<script type=\"text/javascript\" src=\"{{base_url}}js/incoterms.js\"></script>
{% endif %}\t

{% if edit_order == true %}
\t{% include 'forms/frm-pedido-edit.html.twig' %}    
\t<script type=\"text/javascript\" src=\"{{base_url}}js/incoterms.js\"></script>
{% endif %}


{% if viewMessage == true %}
\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t{{message}} </h3>
\t\t<br><br>
\t\t<p>
\t\t\t{% if deleted == true %} 
\t\t\t\t\t\t<a href=\"{{rute_url}}pedido/listar/\">
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
{% include 'base/footer.html.twig' %}", "/pages/pagePedido.html.twig", "/var/www/html/app/src/views/pages/pagePedido.html.twig");
    }
}
