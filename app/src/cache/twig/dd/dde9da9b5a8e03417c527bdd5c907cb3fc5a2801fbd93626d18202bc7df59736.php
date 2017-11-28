<?php

/* base/header.html.twig */
class __TwigTemplate_45d44c1cb2b4a7962c1f6c29bfb45318cde76a9459f5a6f72d0dea3a58cf9342 extends Twig_Template
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
<!-- header -->    
<html lang=\"es\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"Aplicacion de Manejo de importaciones\">
    <meta name=\"author\" content=\"Eduardo Villota eduardouio7@gmail.com\">
    <title>";
        // line 10
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</title>
    <!-- Jauery Autocomplete CSS -->   

    <!-- Bootstrap Core CSS -->
    <link href=\"";
        // line 14
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
   
   <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/datepicker/css/bootstrap-datepicker.min.css\">
    <!-- MetisMenu CSS -->
    <link href=\"";
        // line 18
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/metisMenu/metisMenu.min.css\" rel=\"stylesheet\">
    <!-- Custom CSS -->
    <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "css/sb-admin-2.css\" rel=\"stylesheet\">
    <!-- Custom Fonts -->
    <link href=\"";
        // line 22
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- Custom Styles -->
    <link href=\"";
        // line 24
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "css/cordovez.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- jQuery -->
    <script src=\"";
        // line 26
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/jquery/jquery.min.js\"></script>
    <script src=\"";
        // line 27
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/jquery/jqueryui.min.js\"></script>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/jquery/jqueryui-min.css\"> 
    <script src=\"";
        // line 29
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/datepicker/js/bootstrap-datepicker.min.js\"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\">
        </script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\">
        </script>
        <![endif]-->
</head>";
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
        return array (  79 => 29,  75 => 28,  71 => 27,  67 => 26,  62 => 24,  57 => 22,  52 => 20,  47 => 18,  42 => 16,  37 => 14,  30 => 10,  19 => 1,);
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
<!-- header -->    
<html lang=\"es\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"Aplicacion de Manejo de importaciones\">
    <meta name=\"author\" content=\"Eduardo Villota eduardouio7@gmail.com\">
    <title>{{title}}</title>
    <!-- Jauery Autocomplete CSS -->   

    <!-- Bootstrap Core CSS -->
    <link href=\"{{base_url}}vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
   
   <link rel=\"stylesheet\" type=\"text/css\" href=\"{{base_url}}vendor/datepicker/css/bootstrap-datepicker.min.css\">
    <!-- MetisMenu CSS -->
    <link href=\"{{base_url}}vendor/metisMenu/metisMenu.min.css\" rel=\"stylesheet\">
    <!-- Custom CSS -->
    <link href=\"{{base_url}}css/sb-admin-2.css\" rel=\"stylesheet\">
    <!-- Custom Fonts -->
    <link href=\"{{base_url}}vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- Custom Styles -->
    <link href=\"{{base_url}}css/cordovez.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- jQuery -->
    <script src=\"{{base_url}}vendor/jquery/jquery.min.js\"></script>
    <script src=\"{{base_url}}vendor/jquery/jqueryui.min.js\"></script>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{base_url}}vendor/jquery/jqueryui-min.css\"> 
    <script src=\"{{base_url}}vendor/datepicker/js/bootstrap-datepicker.min.js\"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\">
        </script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\">
        </script>
        <![endif]-->
</head>", "base/header.html.twig", "/var/www/html/app/src/views/base/header.html.twig");
    }
}
