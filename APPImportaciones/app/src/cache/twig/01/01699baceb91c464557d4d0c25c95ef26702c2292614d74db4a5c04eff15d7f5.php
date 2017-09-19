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
        echo "  <div ng-view>
    
  </div>

";
    }

    public function getTemplateName()
    {
        return "base/appjs.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("  <div ng-view>
    
  </div>

", "base/appjs.html.twig", "/var/www/html/app/src/views/base/appjs.html.twig");
    }
}
