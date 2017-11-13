<?php

/* /pages/pageFacturas.html.twig */
class __TwigTemplate_13f6cc784c3ce830c52c92662f8fc194fd46c08148641787dc514a1e77fa0c47 extends Twig_Template
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
        // line 7
        if ((($context["fail"] ?? null) == true)) {
            // line 8
            echo "<div class=\"alert alert-danger\">
\t<strong>\t";
            // line 9
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, ($context["message"] ?? null)), "html", null, true);
            echo " </strong>
\t<ul>
\t";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["fields_error"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                // line 12
                echo "\t\t<li> ";
                echo twig_escape_filter($this->env, $context["field"], "html", null, true);
                echo " </li>\t\t
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 14
            echo "\t</ul>
</div>
";
        }
        // line 17
        echo "

";
        // line 19
        if ((($context["create"] ?? null) == true)) {
            // line 20
            $this->loadTemplate("forms/frm_factura_pagos.html.twig", "/pages/pageFacturas.html.twig", 20)->display($context);
        }
        // line 22
        echo "
";
        // line 23
        if ((($context["update"] ?? null) == true)) {
            // line 24
            $this->loadTemplate("forms/frm_factura_pagos_edit.html.twig", "/pages/pageFacturas.html.twig", 24)->display($context);
        }
        // line 26
        echo "

";
        // line 28
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 29
            echo "\t<div class=\"well\">
\t\t<h3 class=\"text-primary\">\t";
            // line 30
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
\t\t<br><br>
\t\t<p>
\t\t\t";
            // line 33
            if ((($context["deleted"] ?? null) == true)) {
                echo " 
\t\t\t\t\t\t<a href=\"";
                // line 34
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "facturapagos/listar/\">
\t\t\t\t<button>
\t\t\t\t\t<span class=\"fa fa-list\"></span>
\t\t\t\t\tVer
\t\t\t\t</button>
\t\t\t\t</a>
\t\t\t";
            } else {
                // line 40
                echo "  
\t\t\t\t<a href=\"";
                // line 41
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
            // line 48
            echo "\t\t
\t\t</p>
\t</div>
";
        }
        // line 52
        echo "
";
        // line 53
        $this->loadTemplate("base/content_close.html.twig", "/pages/pageFacturas.html.twig", 53)->display($context);
        // line 54
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pageFacturas.html.twig", 54)->display($context);
        // line 55
        $this->loadTemplate("base/footer.html.twig", "/pages/pageFacturas.html.twig", 55)->display($context);
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
        return array (  133 => 55,  131 => 54,  129 => 53,  126 => 52,  120 => 48,  108 => 41,  105 => 40,  95 => 34,  91 => 33,  85 => 30,  82 => 29,  80 => 28,  76 => 26,  73 => 24,  71 => 23,  68 => 22,  65 => 20,  63 => 19,  59 => 17,  54 => 14,  45 => 12,  41 => 11,  36 => 9,  33 => 8,  31 => 7,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/pages/pageFacturas.html.twig", "/var/www/html/app/src/views/pages/pageFacturas.html.twig");
    }
}
