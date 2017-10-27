<?php

/* /pages/pageFacturas.html.twig */
class __TwigTemplate_78932d951d81322ff22d6025ef6b2ed790c9fdf0a809946e074f0cfdd21200b0 extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pageFacturas.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pageFacturas.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pageFacturas.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pageFacturas.html.twig", 4)->display($context);
        // line 5
        echo "
";
        // line 6
        if ((($context["show"] ?? null) == true)) {
            // line 7
            echo "\t";
            $this->loadTemplate("base/sections/mostrar-factura-gasto.html.twig", "/pages/pageFacturas.html.twig", 7)->display($context);
        }
        // line 9
        echo "
";
        // line 10
        if ((($context["list"] ?? null) == true)) {
            // line 11
            echo "\t";
            $this->loadTemplate("base/sections/listar-factura-pago.html.twig", "/pages/pageFacturas.html.twig", 11)->display($context);
        }
        // line 13
        echo "

";
        // line 15
        if ((($context["fail"] ?? null) == true)) {
            // line 16
            echo "<div class=\"alert alert-danger\">
\t<strong>\t";
            // line 17
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, ($context["message"] ?? null)), "html", null, true);
            echo " </strong>
\t<ul>
\t";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["fields_error"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                // line 20
                echo "\t\t<li> ";
                echo twig_escape_filter($this->env, $context["field"], "html", null, true);
                echo " </li>\t\t
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "\t</ul>
</div>
";
        }
        // line 25
        echo "
";
        // line 26
        if ((($context["create"] ?? null) == true)) {
            // line 27
            $this->loadTemplate("forms/frm_factura_pagos.html.twig", "/pages/pageFacturas.html.twig", 27)->display($context);
        }
        // line 29
        echo "
";
        // line 30
        if ((($context["update"] ?? null) == true)) {
            // line 31
            $this->loadTemplate("forms/frm_factura_pagos_edit.html.twig", "/pages/pageFacturas.html.twig", 31)->display($context);
        }
        // line 33
        echo "

";
        // line 35
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 36
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 37
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<br><br>
\t\t<p>
\t\t\t";
            // line 40
            if ((($context["deleted"] ?? null) == true)) {
                echo " 
\t\t\t\t\t\t<a href=\"";
                // line 41
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "facturapagos/listar/\">
\t\t\t\t<button>
\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\tVer
\t\t\t\t</button>
\t\t\t\t</a>
\t\t\t";
            } else {
                // line 47
                echo "  
\t\t\t\t<a href=\"";
                // line 48
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
            // line 55
            echo "\t\t
\t\t</p>
\t</div>
";
        }
        // line 59
        echo "
";
        // line 60
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageFacturas.html.twig", 60)->display($context);
        // line 61
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageFacturas.html.twig", 61)->display($context);
        // line 62
        $this->loadTemplate("base/footer.html.twig", "/pages/pageFacturas.html.twig", 62)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pageFacturas.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 62,  148 => 61,  146 => 60,  143 => 59,  137 => 55,  125 => 48,  122 => 47,  112 => 41,  108 => 40,  102 => 37,  99 => 36,  97 => 35,  93 => 33,  90 => 31,  88 => 30,  85 => 29,  82 => 27,  80 => 26,  77 => 25,  72 => 22,  63 => 20,  59 => 19,  54 => 17,  51 => 16,  49 => 15,  45 => 13,  41 => 11,  39 => 10,  36 => 9,  32 => 7,  30 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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
\t{% include 'base/sections/mostrar-factura-gasto.html.twig' %}
{% endif %}

{% if list == true %}
\t{% include 'base/sections/listar-factura-pago.html.twig' %}
{% endif %}


{% if fail == true %}
<div class=\"alert alert-danger\">
\t<strong>\t{{message | upper }} </strong>
\t<ul>
\t{% for field in fields_error %}
\t\t<li> {{field}} </li>\t\t
\t{% endfor %}
\t</ul>
</div>
{% endif %}

{% if create == true %}
{% include 'forms/frm_factura_pagos.html.twig' %}
{% endif %}

{% if  update == true %}
{% include 'forms/frm_factura_pagos_edit.html.twig' %}
{% endif %}


{% if viewMessage == true %}
\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t{{message}} </h3>
\t\t<br><br>
\t\t<p>
\t\t\t{% if deleted == true %} 
\t\t\t\t\t\t<a href=\"{{rute_url}}facturapagos/listar/\">
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
\t\t
\t\t</p>
\t</div>
{% endif %}

{% include 'base/content_close.html.twig' %}
{% include 'base/signaturefoot.html.twig' %}
{% include 'base/footer.html.twig' %}", "/pages/pageFacturas.html.twig", "/var/www/html/app/src/views/pages/pageFacturas.html.twig");
    }
}
