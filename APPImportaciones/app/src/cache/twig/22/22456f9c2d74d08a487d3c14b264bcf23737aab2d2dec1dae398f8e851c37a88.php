<?php

/* /pages/pageProveedor.html.twig */
class __TwigTemplate_303f03313615935b06d329fa806cb2801ece898f646a742ebab8f525d2ec6383 extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pageProveedor.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pageProveedor.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pageProveedor.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pageProveedor.html.twig", 4)->display($context);
        // line 5
        echo "
";
        // line 6
        if ((($context["show"] ?? null) == true)) {
            // line 7
            echo "\t";
            $this->loadTemplate("base/sections/mostrar-proveedor.html.twig", "/pages/pageProveedor.html.twig", 7)->display($context);
            echo "\t
";
        }
        // line 9
        echo "
";
        // line 10
        if ((($context["list"] ?? null) == true)) {
            // line 11
            echo "\t";
            $this->loadTemplate("base/sections/listar-proveedor.html.twig", "/pages/pageProveedor.html.twig", 11)->display($context);
            echo "\t
";
        }
        // line 13
        echo "
";
        // line 14
        if ((($context["create"] ?? null) == true)) {
            // line 15
            echo "\t";
            $this->loadTemplate("forms/frm_proveedor.html.twig", "/pages/pageProveedor.html.twig", 15)->display($context);
            echo "\t
";
        }
        // line 17
        echo "
";
        // line 18
        if ((($context["edit"] ?? null) == true)) {
            // line 19
            echo "\t";
            $this->loadTemplate("forms/frm_proveedor_edit.html.twig", "/pages/pageProveedor.html.twig", 19)->display($context);
            echo "\t
";
        }
        // line 21
        echo "

";
        // line 23
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 24
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 25
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<br><br>
\t\t<p>
\t\t\t";
            // line 28
            if ((($context["deleted"] ?? null) == true)) {
                echo " 
\t\t\t\t\t\t<a href=\"";
                // line 29
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "proveedor/listar/\"> 
\t\t\t\t<button>
\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\tVer
\t\t\t\t</button>
\t\t\t\t</a>
\t\t\t";
            } else {
                // line 35
                echo "  
\t\t\t\t<a href=\"";
                // line 36
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "proveedor/presentar/";
                echo twig_escape_filter($this->env, ($context["id_supplier"] ?? null), "html", null, true);
                echo "\">
\t\t<button>
\t\t\t<span class=\"fa fa-eye\"></span>
\t\t\tVer
\t\t</button>
\t\t</a>
\t\t\t";
            }
            // line 43
            echo "\t\t
\t\t</p>
\t</div>
";
        }
        // line 47
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageProveedor.html.twig", 47)->display($context);
        // line 48
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageProveedor.html.twig", 48)->display($context);
        // line 49
        $this->loadTemplate("base/footer.html.twig", "/pages/pageProveedor.html.twig", 49)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pageProveedor.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 49,  123 => 48,  121 => 47,  115 => 43,  103 => 36,  100 => 35,  90 => 29,  86 => 28,  80 => 25,  77 => 24,  75 => 23,  71 => 21,  65 => 19,  63 => 18,  60 => 17,  54 => 15,  52 => 14,  49 => 13,  43 => 11,  41 => 10,  38 => 9,  32 => 7,  30 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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
\t{% include 'base/sections/mostrar-proveedor.html.twig' %}\t
{% endif %}

{% if list == true %}
\t{% include 'base/sections/listar-proveedor.html.twig' %}\t
{% endif %}

{% if create == true %}
\t{% include 'forms/frm_proveedor.html.twig' %}\t
{% endif %}

{% if edit == true %}
\t{% include 'forms/frm_proveedor_edit.html.twig' %}\t
{% endif %}


{% if viewMessage == true %}
\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t{{message}} </h3>
\t\t<br><br>
\t\t<p>
\t\t\t{% if deleted == true %} 
\t\t\t\t\t\t<a href=\"{{rute_url}}proveedor/listar/\"> 
\t\t\t\t<button>
\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\tVer
\t\t\t\t</button>
\t\t\t\t</a>
\t\t\t{% else %}  
\t\t\t\t<a href=\"{{rute_url}}proveedor/presentar/{{id_supplier}}\">
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
{% include 'base/footer.html.twig' %}", "/pages/pageProveedor.html.twig", "/var/www/html/app/src/views/pages/pageProveedor.html.twig");
    }
}
