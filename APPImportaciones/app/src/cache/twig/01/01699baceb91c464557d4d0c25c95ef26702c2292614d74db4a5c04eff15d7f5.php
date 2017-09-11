<?php

/* base/appjs.html.twig */
class __TwigTemplate_73c1c4721800b15008830863732c3bfd1cbc1c9483812fbce8c75b64c136ba90 extends Twig_Template
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
", "base/appjs.html.twig", "/var/www/html/app/src/views/base/appjs.html.twig");
    }
}
