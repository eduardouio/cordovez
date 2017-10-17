<?php

/* base/content_close.html.twig */
class __TwigTemplate_857cc01edededcca774babc6b7460d7c485da37b9000e7edac034c3c191b997a extends Twig_Template
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
        echo "</div>
<!-- /.panel-body -->
";
        // line 3
        if ((($context["pagination"] ?? null) == true)) {
            // line 4
            echo "<div class=\"panel-footer text-right\">
<ul class=\"pagination\">
\t<li><a href=\"";
            // line 6
            echo twig_escape_filter($this->env, ($context["pagination_url"] ?? null), "html", null, true);
            echo "\">Primera</a></li>
  ";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, ($context["pagination_pages"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 8
                echo "  \t";
                if ((($context["current_page"] ?? null) == $context["item"])) {
                    // line 9
                    echo "  \t\t<li class=\"active\"><a href=\"";
                    echo twig_escape_filter($this->env, ($context["pagination_url"] ?? null), "html", null, true);
                    echo twig_escape_filter($this->env, ($context["page"] ?? null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["item"], "html", null, true);
                    echo "</a></li>
\t\t";
                } else {
                    // line 11
                    echo "  \t\t<li><a href=\"";
                    echo twig_escape_filter($this->env, ($context["pagination_url"] ?? null), "html", null, true);
                    echo twig_escape_filter($this->env, ($context["page"] ?? null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["item"], "html", null, true);
                    echo "</a></li>\t\t
  \t";
                }
                // line 12
                echo "  \t
  \t";
                // line 13
                $context["page"] = (($context["page"] ?? null) + 10);
                // line 14
                echo "  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "  <li><a href=\"";
            echo twig_escape_filter($this->env, ($context["pagination_url"] ?? null), "html", null, true);
            echo twig_escape_filter($this->env, ($context["last_page"] ?? null), "html", null, true);
            echo "\">Última</a></li>
</ul>
</div>
";
        }
        // line 19
        echo "
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->";
    }

    public function getTemplateName()
    {
        return "base/content_close.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 19,  69 => 15,  63 => 14,  61 => 13,  58 => 12,  49 => 11,  40 => 9,  37 => 8,  33 => 7,  29 => 6,  25 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("</div>
<!-- /.panel-body -->
{% if pagination == true %}
<div class=\"panel-footer text-right\">
<ul class=\"pagination\">
\t<li><a href=\"{{pagination_url}}\">Primera</a></li>
  {% for item in 1 .. pagination_pages  %}
  \t{% if current_page == item %}
  \t\t<li class=\"active\"><a href=\"{{ pagination_url }}{{page}}\">{{ item }}</a></li>
\t\t{% else %}
  \t\t<li><a href=\"{{ pagination_url }}{{page}}\">{{ item }}</a></li>\t\t
  \t{% endif %}  \t
  \t{% set page = page + 10 %}
  {% endfor %}
  <li><a href=\"{{pagination_url}}{{ last_page }}\">Última</a></li>
</ul>
</div>
{% endif %}

</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->", "base/content_close.html.twig", "/var/www/html/app/src/views/base/content_close.html.twig");
    }
}
