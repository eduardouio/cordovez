<?php

/* /twig/header.html.twig */
class __TwigTemplate_215a4610c94ea778b5398e944f0845c69e246a8e06a09984dedf460fef9c221c extends Twig_Template
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
<html lang=\"en\">
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
    <link href=\"../vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <!-- MetisMenu CSS -->
    <link href=\"../vendor/metisMenu/metisMenu.min.css\" rel=\"stylesheet\">
    <!-- Custom CSS -->
    <link href=\"../dist/css/sb-admin-2.css\" rel=\"stylesheet\">
    <!-- Custom Fonts -->
    <link href=\"../vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->
    </head>
    <body>";
    }

    public function getTemplateName()
    {
        return "/twig/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 9,  19 => 1,);
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
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <title>{{title}}</title>
    <!-- Bootstrap Core CSS -->
    <link href=\"../vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <!-- MetisMenu CSS -->
    <link href=\"../vendor/metisMenu/metisMenu.min.css\" rel=\"stylesheet\">
    <!-- Custom CSS -->
    <link href=\"../dist/css/sb-admin-2.css\" rel=\"stylesheet\">
    <!-- Custom Fonts -->
    <link href=\"../vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->
    </head>
    <body>", "/twig/header.html.twig", "/var/www/html/app/app/views/twig/header.html.twig");
    }
}
