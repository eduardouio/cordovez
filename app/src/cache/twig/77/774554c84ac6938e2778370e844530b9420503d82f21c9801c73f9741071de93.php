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
        if ((($context["incompleteForm"] ?? null) == true)) {
            // line 6
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 7
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<ul>
\t\t\t";
            // line 9
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["errors"] ?? null), "columns", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 10
                echo "\t\t\t\t<li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo " </li>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "\t\t</ul>
\t</div>
";
        }
        // line 15
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 16
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 17
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<br><br>
\t\t<p>
            ";
            // line 20
            if ((($context["deleted"] ?? null) == true)) {
                // line 21
                echo "\t\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "facturapagos/listar/\">
\t\t\t\t\t<button>
\t\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\t\tVer
\t\t\t\t\t</button>
\t\t\t\t</a>
            ";
            } else {
                // line 28
                echo "\t\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "facturapagos/presentar/";
                echo twig_escape_filter($this->env, ($context["idRow"] ?? null), "html", null, true);
                echo "\">
\t\t\t\t\t<button>
\t\t\t\t\t\t<span class=\"fa fa-eye\"></span>
\t\t\t\t\t\tVer
\t\t\t\t\t</button>
\t\t\t\t</a>
            ";
            }
            // line 35
            echo "
\t\t</p>
\t</div>
";
        }
        // line 39
        if ((($context["show"] ?? null) == true)) {
            // line 40
            echo "\t";
            $this->loadTemplate("sections/mostrar-factura-pago.html.twig", "/pages/pageFacturas.html.twig", 40)->display($context);
        }
        // line 42
        echo "
";
        // line 43
        if ((($context["list"] ?? null) == true)) {
            // line 44
            echo "\t";
            $this->loadTemplate("sections/listar-factura-pago.html.twig", "/pages/pageFacturas.html.twig", 44)->display($context);
        }
        // line 46
        echo "

";
        // line 48
        if ((($context["create"] ?? null) == true)) {
            // line 49
            $this->loadTemplate("forms/frm-factura-pagos.html.twig", "/pages/pageFacturas.html.twig", 49)->display($context);
        }
        // line 51
        echo "
";
        // line 52
        if ((($context["update"] ?? null) == true)) {
            // line 53
            $this->loadTemplate("forms/frm-factura-pagos-edit.html.twig", "/pages/pageFacturas.html.twig", 53)->display($context);
        }
        // line 55
        echo "
";
        // line 56
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageFacturas.html.twig", 56)->display($context);
        // line 57
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageFacturas.html.twig", 57)->display($context);
        // line 58
        $this->loadTemplate("base/footer.html.twig", "/pages/pageFacturas.html.twig", 58)->display($context);
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
        return array (  137 => 58,  135 => 57,  133 => 56,  130 => 55,  127 => 53,  125 => 52,  122 => 51,  119 => 49,  117 => 48,  113 => 46,  109 => 44,  107 => 43,  104 => 42,  100 => 40,  98 => 39,  92 => 35,  79 => 28,  68 => 21,  66 => 20,  60 => 17,  57 => 16,  55 => 15,  50 => 12,  41 => 10,  37 => 9,  32 => 7,  29 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
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
{% if incompleteForm == true %}
\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t{{message}} </h3>
\t\t<ul>
\t\t\t{%  for error in errors.columns %}
\t\t\t\t<li>{{ error }} </li>
\t\t\t{% endfor %}
\t\t</ul>
\t</div>
{% endif %}
{% if viewMessage == true %}
\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t{{message}} </h3>
\t\t<br><br>
\t\t<p>
            {% if deleted == true %}
\t\t\t\t<a href=\"{{rute_url}}facturapagos/listar/\">
\t\t\t\t\t<button>
\t\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\t\tVer
\t\t\t\t\t</button>
\t\t\t\t</a>
            {% else %}
\t\t\t\t<a href=\"{{rute_url}}facturapagos/presentar/{{idRow}}\">
\t\t\t\t\t<button>
\t\t\t\t\t\t<span class=\"fa fa-eye\"></span>
\t\t\t\t\t\tVer
\t\t\t\t\t</button>
\t\t\t\t</a>
            {% endif %}

\t\t</p>
\t</div>
{% endif %}
{% if show == true %}
\t{% include 'sections/mostrar-factura-pago.html.twig' %}
{% endif %}

{% if list == true %}
\t{% include 'sections/listar-factura-pago.html.twig' %}
{% endif %}


{% if create == true %}
{% include 'forms/frm-factura-pagos.html.twig' %}
{% endif %}

{% if  update == true %}
{% include 'forms/frm-factura-pagos-edit.html.twig' %}
{% endif %}

{% include 'base/content_close.html.twig' %}
{% include 'base/signaturefoot.html.twig' %}
{% include 'base/footer.html.twig' %}", "/pages/pageFacturas.html.twig", "/var/www/html/app/src/views/pages/pageFacturas.html.twig");
    }
}
