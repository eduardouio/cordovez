<?php

/* base/content.html.twig */
class __TwigTemplate_0441768f18b4b85298f268ae9e67e6cac61b9bba8a36e9eeaf18b2a3138124df extends Twig_Template
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
        echo "<div id=\"page-wrapper\">
<div class=\"row\">
<br>
<nav class=\"navbar navbar-default title-";
        // line 4
        echo twig_escape_filter($this->env, ($context["controller"] ?? null), "html", null, true);
        echo "\" container>
   <div class=\"container-fluid\">
      <div class=\"navbar-header\">
         <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
         <span class=\"sr-only\">Toggle navigation</span>
         <span class=\"icon-bar\"></span>
         <span class=\"icon-bar\"></span>
         <span class=\"icon-bar\"></span>
         </button>
         <a class=\"navbar-brand\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/\">
         ";
        // line 14
        echo twig_escape_filter($this->env, ($context["titleContent"] ?? null), "html", null, true);
        echo " 
         <span class=\"fa ";
        // line 15
        echo twig_escape_filter($this->env, ($context["iconTitle"] ?? null), "html", null, true);
        echo " fa-fw pull-right\"></span>
         </a>
      </div>
      <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
         <ul class=\"nav navbar-nav\" style=\"color: #fff\">
            <li ";
        // line 20
        echo ($context["list_active"] ?? null);
        echo " >
               <a href=\"";
        // line 21
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/listar/\">
               <span class=\"fa fa-list fa-fw\"></span> 
               <span class=\"sr-only\">(current)</span>
               Listar Pedidos 
               </a>
            </li>
            <li ";
        // line 27
        echo ($context["new_active"] ?? null);
        echo ">
               <a href=\"";
        // line 28
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/nuevo\">
               <span class=\"fa fa-file fa-fw\"></span> 
               Nuevo Pedido
               </a>
            </li>
         </ul>
      </div>
</nav>
</div>
<!-- /.row -->
<div class=\"row\">
<div class=\"col-lg-12\">
<div class=\"panel panel-default \">
<div class=\"panel-body\">";
    }

    public function getTemplateName()
    {
        return "base/content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 28,  65 => 27,  56 => 21,  52 => 20,  44 => 15,  40 => 14,  36 => 13,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"page-wrapper\">
<div class=\"row\">
<br>
<nav class=\"navbar navbar-default title-{{controller}}\" container>
   <div class=\"container-fluid\">
      <div class=\"navbar-header\">
         <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
         <span class=\"sr-only\">Toggle navigation</span>
         <span class=\"icon-bar\"></span>
         <span class=\"icon-bar\"></span>
         <span class=\"icon-bar\"></span>
         </button>
         <a class=\"navbar-brand\" href=\"{{rute_url}}pedido/\">
         {{titleContent}} 
         <span class=\"fa {{iconTitle}} fa-fw pull-right\"></span>
         </a>
      </div>
      <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
         <ul class=\"nav navbar-nav\" style=\"color: #fff\">
            <li {{ list_active | raw }} >
               <a href=\"{{rute_url}}pedido/listar/\">
               <span class=\"fa fa-list fa-fw\"></span> 
               <span class=\"sr-only\">(current)</span>
               Listar Pedidos 
               </a>
            </li>
            <li {{ new_active | raw }}>
               <a href=\"{{rute_url}}pedido/nuevo\">
               <span class=\"fa fa-file fa-fw\"></span> 
               Nuevo Pedido
               </a>
            </li>
         </ul>
      </div>
</nav>
</div>
<!-- /.row -->
<div class=\"row\">
<div class=\"col-lg-12\">
<div class=\"panel panel-default \">
<div class=\"panel-body\">", "base/content.html.twig", "/var/www/html/app/src/views/base/content.html.twig");
    }
}
