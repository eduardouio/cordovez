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
<html lang=\"es\" ng-app=\"cordovezApp\" ng-controller = \"loginController\">
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
     body { 
  background: url(";
        // line 29
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/img/importaciones-comercio.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.panel-default {
opacity: 0.9;
margin-top:30px;
}
.form-group.last { margin-bottom:0px; }
   </style>
</head>

<body>
<h1>";
        // line 45
        echo twig_escape_filter($this->env, ($context["userName"] ?? null), "html", null, true);
        echo "</h1>
<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-4 col-md-offset-7\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">
                    <span class=\"glyphicon glyphicon-lock\"></span> Inicio de Sesion</div>
                <div class=\"panel-body\">
                    <form class=\"form-horizontal\" role=\"form\">
                    <div class=\"form-group\">
                        <label for=\"userName\" class=\"col-sm-3 control-label\">
                            Email</label>
                        <div class=\"col-sm-9\">
                            <input 
                            type=\"text\" 
                            class=\"form-control\" 
                            name=\"userName\" 
                            ng-model=\"userName\" 
                            placeholder=\"Usuario\" 
                            required = \"true\">
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label for=\"inputPassword3\" class=\"col-sm-3 control-label\">
                            Password</label>
                        <div class=\"col-sm-9\">
                            <input type=\"password\" class=\"form-control\" id=\"inputPassword3\" placeholder=\"Password\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-sm-offset-3 col-sm-9\">
                            <div class=\"checkbox\">
                                <label>
                                    <input type=\"checkbox\"/>
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class=\"form-group last\">
                        <div class=\"col-sm-offset-3 col-sm-9\">
                            <button type=\"submit\" class=\"btn btn-success btn-sm\">
                                Sign in</button>
                                 <button type=\"reset\" class=\"btn btn-default btn-sm\">
                                Reset</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class=\"panel-footer\">
                    No tiene una cuenta? <a href=\"mailto:eduardouio7@gmail.com\">Solicitar Cuenta</a></div>
            </div>
        </div>
    </div>
</div>

<script type=\"text/javascript\">
  
  var host = '";
        // line 103
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "';
  var httpResult = {};
// Funciones Auxiliares
// Retorna la cantidad de metodos y propiedades de un objeto
    function inspeccionar(obj)
{
  var msg = '';
  for (var property in obj)
  {
    if (typeof obj[property] == 'function')
    {
      var inicio = obj[property].toString().indexOf('function');
      var fin = obj[property].toString().indexOf(')')+1;
      var propertyValue=obj[property].toString().substring(inicio,fin);
      msg +=(typeof obj[property])+' '+property+' : '+propertyValue+' ;\\n';
    }
    else if (typeof obj[property] == 'unknown')
    {
      msg += 'unknown '+property+' : unknown ;\\n';
    }
    else
    {
      msg +=(typeof obj[property])+' '+property+' : '+obj[property]+' ;\\n';
    }
  }
  return msg;
}
</script>

<script type=\"text/javascript\">
  setTimeout(function(){ reloadPage() }, 600000);

    function reloadPage(argument) {
        location.reload();
    }

</script>

<!-- NG APP cordovezApp-->
<script src=\"";
        // line 142
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/lib/angular.min.js\"></script>
<script src=\"";
        // line 143
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/lib/angular-route.min.js\"></script>
<script src=\"";
        // line 144
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/app.js\"></script>
<script src=\"";
        // line 145
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/login/loginApp.js\"></script>
<script src=\"";
        // line 146
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/login/controllers.js\"></script>



            <!-- jQuery -->
            <script src=\"";
        // line 151
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/jquery/jquery.min.js\"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src=\"";
        // line 153
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/bootstrap/js/bootstrap.min.js\"></script>
            <!-- Metis Menu Plugin JavaScript -->
            <script src=\"";
        // line 155
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/metisMenu/metisMenu.min.js\"></script>
            <!-- Custom Theme JavaScript -->
            <script src=\"";
        // line 157
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "dist/js/sb-admin-2.js\"></script>

            <script type=\"text/javascript\">
  \$('#myModal').on('shown.bs.modal', function () {
  \$('#myInput').focus()
})

</script>
</html>

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
        return array (  228 => 157,  223 => 155,  218 => 153,  213 => 151,  205 => 146,  201 => 145,  197 => 144,  193 => 143,  189 => 142,  147 => 103,  86 => 45,  67 => 29,  54 => 19,  49 => 17,  44 => 15,  39 => 13,  34 => 11,  29 => 9,  19 => 1,);
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
<html lang=\"es\" ng-app=\"cordovezApp\" ng-controller = \"loginController\">
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
     body { 
  background: url({{base_url}}/img/importaciones-comercio.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.panel-default {
opacity: 0.9;
margin-top:30px;
}
.form-group.last { margin-bottom:0px; }
   </style>
</head>

<body>
<h1>{{userName}}</h1>
<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-4 col-md-offset-7\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">
                    <span class=\"glyphicon glyphicon-lock\"></span> Inicio de Sesion</div>
                <div class=\"panel-body\">
                    <form class=\"form-horizontal\" role=\"form\">
                    <div class=\"form-group\">
                        <label for=\"userName\" class=\"col-sm-3 control-label\">
                            Email</label>
                        <div class=\"col-sm-9\">
                            <input 
                            type=\"text\" 
                            class=\"form-control\" 
                            name=\"userName\" 
                            ng-model=\"userName\" 
                            placeholder=\"Usuario\" 
                            required = \"true\">
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label for=\"inputPassword3\" class=\"col-sm-3 control-label\">
                            Password</label>
                        <div class=\"col-sm-9\">
                            <input type=\"password\" class=\"form-control\" id=\"inputPassword3\" placeholder=\"Password\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-sm-offset-3 col-sm-9\">
                            <div class=\"checkbox\">
                                <label>
                                    <input type=\"checkbox\"/>
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class=\"form-group last\">
                        <div class=\"col-sm-offset-3 col-sm-9\">
                            <button type=\"submit\" class=\"btn btn-success btn-sm\">
                                Sign in</button>
                                 <button type=\"reset\" class=\"btn btn-default btn-sm\">
                                Reset</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class=\"panel-footer\">
                    No tiene una cuenta? <a href=\"mailto:eduardouio7@gmail.com\">Solicitar Cuenta</a></div>
            </div>
        </div>
    </div>
</div>

<script type=\"text/javascript\">
  
  var host = '{{base_url}}';
  var httpResult = {};
// Funciones Auxiliares
// Retorna la cantidad de metodos y propiedades de un objeto
    function inspeccionar(obj)
{
  var msg = '';
  for (var property in obj)
  {
    if (typeof obj[property] == 'function')
    {
      var inicio = obj[property].toString().indexOf('function');
      var fin = obj[property].toString().indexOf(')')+1;
      var propertyValue=obj[property].toString().substring(inicio,fin);
      msg +=(typeof obj[property])+' '+property+' : '+propertyValue+' ;\\n';
    }
    else if (typeof obj[property] == 'unknown')
    {
      msg += 'unknown '+property+' : unknown ;\\n';
    }
    else
    {
      msg +=(typeof obj[property])+' '+property+' : '+obj[property]+' ;\\n';
    }
  }
  return msg;
}
</script>

<script type=\"text/javascript\">
  setTimeout(function(){ reloadPage() }, 600000);

    function reloadPage(argument) {
        location.reload();
    }

</script>

<!-- NG APP cordovezApp-->
<script src=\"{{base_url}}js/lib/angular.min.js\"></script>
<script src=\"{{base_url}}js/lib/angular-route.min.js\"></script>
<script src=\"{{base_url}}js/app/app.js\"></script>
<script src=\"{{base_url}}js/app/login/loginApp.js\"></script>
<script src=\"{{base_url}}js/app/login/controllers.js\"></script>



            <!-- jQuery -->
            <script src=\"{{base_url}}vendor/jquery/jquery.min.js\"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src=\"{{base_url}}vendor/bootstrap/js/bootstrap.min.js\"></script>
            <!-- Metis Menu Plugin JavaScript -->
            <script src=\"{{base_url}}vendor/metisMenu/metisMenu.min.js\"></script>
            <!-- Custom Theme JavaScript -->
            <script src=\"{{base_url}}dist/js/sb-admin-2.js\"></script>

            <script type=\"text/javascript\">
  \$('#myModal').on('shown.bs.modal', function () {
  \$('#myInput').focus()
})

</script>
</html>

</body>
", "/pages/pageLogin.html.twig", "/var/www/html/app/src/views/pages/pageLogin.html.twig");
    }
}
