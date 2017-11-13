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
<html lang=\"es\" ng-app=\"cordovezApp\" ng-controller=\"loginController\">
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
         background: url('";
        // line 28
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/img/appbackground.jpg') no-repeat center center fixed; 
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
      <style>
         .ng-enter {
         transition: 0.75s;
         }
         .ng-enter-stagger{
         transition-delay: 0.1s;
         }
         .ng-leave-stagger{
         transition-delay: 0.1s;
         }
         .ng-enter-active{
         opacity: 1;
         }
         .ng-leave{
         transition: 0.75s;
         opacity: 1;
         }
         .ng-leave-active{
         opacity: 0;
         }
         }
      </style>
   </head>
   <body>
      <div class=\"container\">
         <div class=\"row\">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
         </div>
         <div class=\"row\">
            <div class=\"col-sm-5 text-center\" >
               <img src=\"";
        // line 71
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "img/cordovez.png\" style=\"width: 70%; height: auto\">
               <br>
               <h3 class=\"text-primary\">MODULO DE IMPORTACIONES 
                  <b>CORDOVEZ S.A.</b>
               </h3>
            </div>
            <div class=\"text-danger\">
               ";
        // line 78
        echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
        echo "
            </div>
            <div class=\"col-md-4 col-md-offset-2\">
               <div class=\"panel panel-default\">
                  <div class=\"panel-heading\">
                     <span class=\"glyphicon glyphicon-lock\"></span> Inicio de Sesion
                  </div>
                  <div class=\"panel-body\">
                     <form 
                        class=\"form-horizontal\" 
                        role=\"form\" 
                        method=\"post\" 
                        action=\"";
        // line 90
        echo twig_escape_filter($this->env, ($context["actionFrm"] ?? null), "html", null, true);
        echo "\">
                        <div class=\"form-group\">
                           <label for=\"userName\" class=\"col-sm-3 control-label\">
                           Usuario</label>
                           <div class=\"col-sm-9\">
                              <input 
                                 type=\"text\" 
                                 class=\"form-control\" 
                                 name=\"username\" 
                                 placeholder=\"Usuario\" 
                                 required = \"required\"
                                 autofocus=\"true\"
                                 >
                           </div>
                        </div>
                        <div class=\"form-group\">
                           <label for=\"inputPassword3\" class=\"col-sm-3 control-label\">
                           Contraseña</label>
                           <div class=\"col-sm-9\">
                              <input 
                                 type=\"password\" 
                                 class=\"form-control\" 
                                 placeholder=\"Password\" 
                                 name=\"password\" 
                                 required = \"required\"
                                 >
                           </div>
                        </div>
                        <div class=\"form-group\">
                           <div class=\"col-sm-offset-3 col-sm-9\">
                              <div class=\"checkbox\">
                                 <label>
                                 <input type=\"checkbox\"/>
                                 Recordarme
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class=\"form-group last\">
                           <div class=\"col-sm-offset-3 col-sm-9\">
                              <button
                                 type=\"submit\">
                                 Iniciar Sesión
                              </button>
                              <button 
                                 type=\"reset\" >
                              Limpiar</button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class=\"panel-footer\">
                     No tiene una cuenta? 
                     <a href=\"mailto:eduardouio7@gmail.com\">Solicite una Cuenta</a>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"row\">
            &nbsp;
         </div>
         <div class=\"row\">
            &nbsp;
         </div>
         <div class=\"row\">
            &nbsp;
         </div>
         <div class=\"row\">
            &nbsp;
         </div>
         <div class=\"row\">
            <div class=\"col-sm-5\">
               <small> &copy; Todos los Derechos reservados Importadora Cordovez 2017 <br>
               Desarrollado por Eduardo Villota <a href=\"mailto:eduardouio7@gmail.com\">eduardouio7@gmail.com 
               </a></small>
            </div>
         </div>
      </div>
      <script type=\"text/javascript\">
         var host = '";
        // line 169
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
      <!-- NG APP cordovezApp-->
      <!-- jQuery -->
      <script src=\"";
        // line 199
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/jquery/jquery.min.js\"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src=\"";
        // line 201
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/bootstrap/js/bootstrap.min.js\"></script>
      <!-- Metis Menu Plugin JavaScript -->
      <script src=\"";
        // line 203
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/metisMenu/metisMenu.min.js\"></script>
      <!-- Custom Theme JavaScript -->
      <script src=\"";
        // line 205
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "dist/js/sb-admin-2.js\"></script>
</body>
</html>
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
        return array (  267 => 205,  262 => 203,  257 => 201,  252 => 199,  219 => 169,  137 => 90,  122 => 78,  112 => 71,  66 => 28,  54 => 19,  49 => 17,  44 => 15,  39 => 13,  34 => 11,  29 => 9,  19 => 1,);
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
<html lang=\"es\" ng-app=\"cordovezApp\" ng-controller=\"loginController\">
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
         background: url('{{base_url}}/img/appbackground.jpg') no-repeat center center fixed; 
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
      <style>
         .ng-enter {
         transition: 0.75s;
         }
         .ng-enter-stagger{
         transition-delay: 0.1s;
         }
         .ng-leave-stagger{
         transition-delay: 0.1s;
         }
         .ng-enter-active{
         opacity: 1;
         }
         .ng-leave{
         transition: 0.75s;
         opacity: 1;
         }
         .ng-leave-active{
         opacity: 0;
         }
         }
      </style>
   </head>
   <body>
      <div class=\"container\">
         <div class=\"row\">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
         </div>
         <div class=\"row\">
            <div class=\"col-sm-5 text-center\" >
               <img src=\"{{base_url}}img/cordovez.png\" style=\"width: 70%; height: auto\">
               <br>
               <h3 class=\"text-primary\">MODULO DE IMPORTACIONES 
                  <b>CORDOVEZ S.A.</b>
               </h3>
            </div>
            <div class=\"text-danger\">
               {{message}}
            </div>
            <div class=\"col-md-4 col-md-offset-2\">
               <div class=\"panel panel-default\">
                  <div class=\"panel-heading\">
                     <span class=\"glyphicon glyphicon-lock\"></span> Inicio de Sesion
                  </div>
                  <div class=\"panel-body\">
                     <form 
                        class=\"form-horizontal\" 
                        role=\"form\" 
                        method=\"post\" 
                        action=\"{{actionFrm}}\">
                        <div class=\"form-group\">
                           <label for=\"userName\" class=\"col-sm-3 control-label\">
                           Usuario</label>
                           <div class=\"col-sm-9\">
                              <input 
                                 type=\"text\" 
                                 class=\"form-control\" 
                                 name=\"username\" 
                                 placeholder=\"Usuario\" 
                                 required = \"required\"
                                 autofocus=\"true\"
                                 >
                           </div>
                        </div>
                        <div class=\"form-group\">
                           <label for=\"inputPassword3\" class=\"col-sm-3 control-label\">
                           Contraseña</label>
                           <div class=\"col-sm-9\">
                              <input 
                                 type=\"password\" 
                                 class=\"form-control\" 
                                 placeholder=\"Password\" 
                                 name=\"password\" 
                                 required = \"required\"
                                 >
                           </div>
                        </div>
                        <div class=\"form-group\">
                           <div class=\"col-sm-offset-3 col-sm-9\">
                              <div class=\"checkbox\">
                                 <label>
                                 <input type=\"checkbox\"/>
                                 Recordarme
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class=\"form-group last\">
                           <div class=\"col-sm-offset-3 col-sm-9\">
                              <button
                                 type=\"submit\">
                                 Iniciar Sesión
                              </button>
                              <button 
                                 type=\"reset\" >
                              Limpiar</button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class=\"panel-footer\">
                     No tiene una cuenta? 
                     <a href=\"mailto:eduardouio7@gmail.com\">Solicite una Cuenta</a>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"row\">
            &nbsp;
         </div>
         <div class=\"row\">
            &nbsp;
         </div>
         <div class=\"row\">
            &nbsp;
         </div>
         <div class=\"row\">
            &nbsp;
         </div>
         <div class=\"row\">
            <div class=\"col-sm-5\">
               <small> &copy; Todos los Derechos reservados Importadora Cordovez 2017 <br>
               Desarrollado por Eduardo Villota <a href=\"mailto:eduardouio7@gmail.com\">eduardouio7@gmail.com 
               </a></small>
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
      <!-- NG APP cordovezApp-->
      <!-- jQuery -->
      <script src=\"{{base_url}}vendor/jquery/jquery.min.js\"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src=\"{{base_url}}vendor/bootstrap/js/bootstrap.min.js\"></script>
      <!-- Metis Menu Plugin JavaScript -->
      <script src=\"{{base_url}}vendor/metisMenu/metisMenu.min.js\"></script>
      <!-- Custom Theme JavaScript -->
      <script src=\"{{base_url}}dist/js/sb-admin-2.js\"></script>
</body>
</html>
", "/pages/pageLogin.html.twig", "/var/www/html/app/src/views/pages/pageLogin.html.twig");
    }
}
