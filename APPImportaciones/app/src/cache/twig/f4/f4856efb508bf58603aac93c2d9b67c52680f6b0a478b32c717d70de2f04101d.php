<?php

/* base/header.html.twig */
class __TwigTemplate_9ebc49bcd1b59ad99966a5799673e4ec55985e4d667cb5db2f01998347a9c6cd extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"es\" ng-app=\"cordovezApp\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <title>";
        // line 9
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</title>
    <!-- Bootstrap Core CSS -->
    <link href=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <!-- MetisMenu CSS -->
    <link href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/metisMenu/metisMenu.min.css\" rel=\"stylesheet\">
    <!-- Custom CSS -->
    <link href=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "dist/css/sb-admin-2.css\" rel=\"stylesheet\">
    <!-- Custom Fonts -->
    <link href=\"";
        // line 17
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- Custom Styles -->
    <link href=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/styles/cordovez.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->
</head>
<body>
<div id=\"wrapper\">
";
    }

    public function getTemplateName()
    {
        return "base/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 19,  49 => 17,  44 => 15,  39 => 13,  34 => 11,  29 => 9,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"es\" ng-app=\"cordovezApp\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <title>{{title}}</title>
    <!-- Bootstrap Core CSS -->
    <link href=\"{{base_url}}vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <!-- MetisMenu CSS -->
    <link href=\"{{base_url}}vendor/metisMenu/metisMenu.min.css\" rel=\"stylesheet\">
    <!-- Custom CSS -->
    <link href=\"{{base_url}}dist/css/sb-admin-2.css\" rel=\"stylesheet\">
    <!-- Custom Fonts -->
    <link href=\"{{base_url}}vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- Custom Styles -->
    <link href=\"{{base_url}}vendor/styles/cordovez.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->
</head>
<body>
<div id=\"wrapper\">
", "base/header.html.twig", "/var/www/html/app/app/views/base/header.html.twig");
    }
}
