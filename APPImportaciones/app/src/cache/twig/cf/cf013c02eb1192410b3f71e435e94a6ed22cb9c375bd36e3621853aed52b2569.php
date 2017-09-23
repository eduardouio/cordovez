<?php

/* base/footer.html.twig */
class __TwigTemplate_7f6d024a128335cb1f8c72fb9b05cbacd8fccca4f248098f26604ab56fce60ed extends Twig_Template
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
        echo "        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>

<script type=\"text/javascript\">
  
  var host = '";
        // line 9
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

\tfunction reloadPage(argument) {
\t\tlocation.reload();
\t}

</script>

<!-- NG APP cordovezApp-->
<script src=\"";
        // line 48
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/lib/angular.min.js\"></script>
<script src=\"";
        // line 49
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/lib/angular-route.min.js\"></script>
<script src=\"";
        // line 50
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/lib/angular-touch.min.js\"></script>
<script src=\"";
        // line 51
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/app.js\"></script>
<script src=\"";
        // line 52
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/routes/";
        echo twig_escape_filter($this->env, ($context["controller"] ?? null), "html", null, true);
        echo "Routes.js\"></script>
<script src=\"";
        // line 53
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/directives/autocompleteDirective.js\"></script>
<script src=\"";
        // line 54
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/factories/";
        echo twig_escape_filter($this->env, ($context["controller"] ?? null), "html", null, true);
        echo "Factory.js\"></script>
<script src=\"";
        // line 55
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/factories/incotermsFactory.js\"></script>
<script src=\"";
        // line 56
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/controllers/";
        echo twig_escape_filter($this->env, ($context["controller"] ?? null), "html", null, true);
        echo "Controller.js\"></script>
            <!-- jQuery -->
            <script src=\"";
        // line 58
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/jquery/jquery.min.js\"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/bootstrap/js/bootstrap.min.js\"></script>
            <!-- Metis Menu Plugin JavaScript -->
            <script src=\"";
        // line 62
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/metisMenu/metisMenu.min.js\"></script>
            <!-- Custom Theme JavaScript -->
            <script src=\"";
        // line 64
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "dist/js/sb-admin-2.js\"></script>

            <script type=\"text/javascript\">
  \$('#myModal').on('shown.bs.modal', function () {
  \$('#myInput').focus()
})

</script>
</html>
";
    }

    public function getTemplateName()
    {
        return "base/footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 64,  124 => 62,  119 => 60,  114 => 58,  107 => 56,  103 => 55,  97 => 54,  93 => 53,  87 => 52,  83 => 51,  79 => 50,  75 => 49,  71 => 48,  29 => 9,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>

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

\tfunction reloadPage(argument) {
\t\tlocation.reload();
\t}

</script>

<!-- NG APP cordovezApp-->
<script src=\"{{base_url}}js/lib/angular.min.js\"></script>
<script src=\"{{base_url}}js/lib/angular-route.min.js\"></script>
<script src=\"{{base_url}}js/lib/angular-touch.min.js\"></script>
<script src=\"{{base_url}}js/app/app.js\"></script>
<script src=\"{{base_url}}js/app/routes/{{controller}}Routes.js\"></script>
<script src=\"{{base_url}}js/app/directives/autocompleteDirective.js\"></script>
<script src=\"{{base_url}}js/app/factories/{{controller}}Factory.js\"></script>
<script src=\"{{base_url}}js/app/factories/incotermsFactory.js\"></script>
<script src=\"{{base_url}}js/app/controllers/{{controller}}Controller.js\"></script>
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
", "base/footer.html.twig", "/var/www/html/app/src/views/base/footer.html.twig");
    }
}
