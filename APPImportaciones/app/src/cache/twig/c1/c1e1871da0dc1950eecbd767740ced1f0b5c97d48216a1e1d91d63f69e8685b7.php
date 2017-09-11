<?php

/* /pages/pageLogin.html.twig */
class __TwigTemplate_238d403db5dde966d0d9a8244659b7b1357e7ac298a9bdacf9c10956dd094e03 extends Twig_Template
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
    <style type=\"text/css\">
    @import url(http://fonts.googleapis.com/css?family=Roboto);

    /****** LOGIN MODAL ******/
    .loginmodal-container {
      padding: 30px;
      max-width: 350px;
      width: 100% !important;
      background-color: #F7F7F7;
      margin: 0 auto;
      border-radius: 2px;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      font-family: roboto;
    }

    .loginmodal-container h1 {
      text-align: center;
      font-size: 1.8em;
      font-family: roboto;
    }

    .loginmodal-container input[type=submit] {
      width: 100%;
      display: block;
      margin-bottom: 10px;
      position: relative;
    }

    .loginmodal-container input[type=text], input[type=password] {
      height: 44px;
      font-size: 16px;
      width: 100%;
      margin-bottom: 10px;
      -webkit-appearance: none;
      background: #fff;
      border: 1px solid #d9d9d9;
      border-top: 1px solid #c0c0c0;
      /* border-radius: 2px; */
      padding: 0 8px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .loginmodal-container input[type=text]:hover, input[type=password]:hover {
      border: 1px solid #b9b9b9;
      border-top: 1px solid #a0a0a0;
      -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
      -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    }

    .loginmodal {
      text-align: center;
      font-size: 14px;
      font-family: 'Arial', sans-serif;
      font-weight: 700;
      height: 36px;
      padding: 0 8px;
    /* border-radius: 3px; */
    /* -webkit-user-select: none;
      user-select: none; */
    }

    .loginmodal-submit {
      /* border: 1px solid #3079ed; */
      border: 0px;
      color: #fff;
      text-shadow: 0 1px rgba(0,0,0,0.1);
      background-color: #4d90fe;
      padding: 17px 0px;
      font-family: roboto;
      font-size: 14px;
      /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
    }

    .loginmodal-submit:hover {
      /* border: 1px solid #2f5bb7; */
      border: 0px;
      text-shadow: 0 1px rgba(0,0,0,0.3);
      background-color: #357ae8;
      /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
    }

    .loginmodal-container a {
      text-decoration: none;
      color: #666;
      font-weight: 400;
      text-align: center;
      display: inline-block;
      opacity: 0.6;
      transition: opacity ease 0.5s;
    }

    .login-help{
      font-size: 12px;
    }
    </style>
</head>

<body>

<div class=\"container\">
    \t  <div class=\"modal-dialog\">
\t\t\t\t<div class=\"loginmodal-container\">
\t\t\t\t\t<h1>Login to Your Account</h1><br>
\t\t\t\t  <form method=\"post\" action=\"";
        // line 132
        echo twig_escape_filter($this->env, ($context["actionFrm"] ?? null), "html", null, true);
        echo "\">
\t\t\t\t\t<input type=\"text\" name=\"username\" placeholder=\"Username\">
\t\t\t\t\t<input type=\"password\" name=\"password\" placeholder=\"Password\">
\t\t\t\t\t<input type=\"submit\" name=\"login\" class=\"login loginmodal-submit\" value=\"Login\">
\t\t\t\t  </form>

\t\t\t\t  <div class=\"login-help\">
\t\t\t\t\t<a href=\"#\">Register</a> - <a href=\"#\">Forgot Password</a>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t</div>
\t\t  </div>
</body>
";
    }

    public function getTemplateName()
    {
        return "/pages/pageLogin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 132,  54 => 19,  49 => 17,  44 => 15,  39 => 13,  34 => 11,  29 => 9,  19 => 1,);
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
    <style type=\"text/css\">
    @import url(http://fonts.googleapis.com/css?family=Roboto);

    /****** LOGIN MODAL ******/
    .loginmodal-container {
      padding: 30px;
      max-width: 350px;
      width: 100% !important;
      background-color: #F7F7F7;
      margin: 0 auto;
      border-radius: 2px;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      font-family: roboto;
    }

    .loginmodal-container h1 {
      text-align: center;
      font-size: 1.8em;
      font-family: roboto;
    }

    .loginmodal-container input[type=submit] {
      width: 100%;
      display: block;
      margin-bottom: 10px;
      position: relative;
    }

    .loginmodal-container input[type=text], input[type=password] {
      height: 44px;
      font-size: 16px;
      width: 100%;
      margin-bottom: 10px;
      -webkit-appearance: none;
      background: #fff;
      border: 1px solid #d9d9d9;
      border-top: 1px solid #c0c0c0;
      /* border-radius: 2px; */
      padding: 0 8px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .loginmodal-container input[type=text]:hover, input[type=password]:hover {
      border: 1px solid #b9b9b9;
      border-top: 1px solid #a0a0a0;
      -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
      -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    }

    .loginmodal {
      text-align: center;
      font-size: 14px;
      font-family: 'Arial', sans-serif;
      font-weight: 700;
      height: 36px;
      padding: 0 8px;
    /* border-radius: 3px; */
    /* -webkit-user-select: none;
      user-select: none; */
    }

    .loginmodal-submit {
      /* border: 1px solid #3079ed; */
      border: 0px;
      color: #fff;
      text-shadow: 0 1px rgba(0,0,0,0.1);
      background-color: #4d90fe;
      padding: 17px 0px;
      font-family: roboto;
      font-size: 14px;
      /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
    }

    .loginmodal-submit:hover {
      /* border: 1px solid #2f5bb7; */
      border: 0px;
      text-shadow: 0 1px rgba(0,0,0,0.3);
      background-color: #357ae8;
      /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
    }

    .loginmodal-container a {
      text-decoration: none;
      color: #666;
      font-weight: 400;
      text-align: center;
      display: inline-block;
      opacity: 0.6;
      transition: opacity ease 0.5s;
    }

    .login-help{
      font-size: 12px;
    }
    </style>
</head>

<body>

<div class=\"container\">
    \t  <div class=\"modal-dialog\">
\t\t\t\t<div class=\"loginmodal-container\">
\t\t\t\t\t<h1>Login to Your Account</h1><br>
\t\t\t\t  <form method=\"post\" action=\"{{actionFrm}}\">
\t\t\t\t\t<input type=\"text\" name=\"username\" placeholder=\"Username\">
\t\t\t\t\t<input type=\"password\" name=\"password\" placeholder=\"Password\">
\t\t\t\t\t<input type=\"submit\" name=\"login\" class=\"login loginmodal-submit\" value=\"Login\">
\t\t\t\t  </form>

\t\t\t\t  <div class=\"login-help\">
\t\t\t\t\t<a href=\"#\">Register</a> - <a href=\"#\">Forgot Password</a>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t</div>
\t\t  </div>
</body>
", "/pages/pageLogin.html.twig", "/var/www/html/app/src/views/pages/pageLogin.html.twig");
    }
}
