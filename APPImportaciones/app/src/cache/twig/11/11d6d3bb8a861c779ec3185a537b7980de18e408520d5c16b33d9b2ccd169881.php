<?php

/* base/appjs.html.twig */
class __TwigTemplate_80bc46aaff78bb30d377fe533d6f12db129cdf65248df8d81064157bd52fff40 extends Twig_Template
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
        echo "<main>
  <div ng-view class=\"container\">
    ";
        // line 3
        echo twig_escape_filter($this->env, (2 + 5), "html", null, true);
        echo " * ";
        echo twig_escape_filter($this->env, (5 + 43), "html", null, true);
        echo " = 99
  </div>
</main>
";
    }

    public function getTemplateName()
    {
        return "base/appjs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<main>
  <div ng-view class=\"container\">
    {{2+5}} * {{5+43}} = 99
  </div>
</main>
", "base/appjs.html.twig", "/var/www/html/app/app/views/base/appjs.html.twig");
    }
}
