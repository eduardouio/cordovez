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
    <div id=\"toast\"></div>
</body>

<script type=\"text/javascript\">
  
  var host = '";
        // line 10
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "';
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
  setTimeout(function(){ reloadPage() }, 6000000);

\tfunction reloadPage(argument) {
\t\tlocation.reload();
\t}

</script>

<!-- Libraries Angular-->
<script src=\"";
        // line 49
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/lib/angular-route.min.js\"></script>
<!-- APP Angular -->
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
<!-- Directives-->

<!-- Factories-->
<script src=\"";
        // line 56
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/loginFactory.js\"></script>
<script src=\"";
        // line 57
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/countriesFactory.js\"></script>
<script src=\"";
        // line 58
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/detallepedidoFactory.js\"></script>
<script src=\"";
        // line 59
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/facinformativaFactory.js\"></script>
<script src=\"";
        // line 60
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/facpagospedidoFactory.js\"></script>
<script src=\"";
        // line 61
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/factGastosInicialesFactory.js\"></script>
<script src=\"";
        // line 62
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/factgstnacionalizacionFactory.js\"></script>
<script src=\"";
        // line 63
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/factinfdetalleFactory.js\"></script>
<script src=\"";
        // line 64
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/gastosInicialesFactory.js\"></script>
<script src=\"";
        // line 65
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/gstnacionalizacionFactory.js\"></script>
<script src=\"";
        // line 66
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/proveedorFactory.js\"></script>
<script src=\"";
        // line 67
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/incotermsFactory.js\"></script>
<script src=\"";
        // line 68
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/nacionalizacionFactory.js\"></script>
<script src=\"";
        // line 69
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/pedidoFactory.js\"></script>
<script src=\"";
        // line 70
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/pedidofacturaFactory.js\"></script>
<script src=\"";
        // line 71
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "/js/app/factories/productoFactory.js\"></script>
<script src=\"";
        // line 72
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/controllers/nuevoPedidoController.js\"></script>
<script src=\"";
        // line 73
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/controllers/presentarPedidoController.js\"></script>
<script src=\"";
        // line 74
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/controllers/facturasPedidoController.js\"></script>
<script src=\"";
        // line 75
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "js/app/controllers/listarPedidosController.js\"></script>
<!-- jQuery -->
<script src=\"";
        // line 77
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/jquery/jquery.min.js\"></script>
<script src=\"";
        // line 78
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/jquery-toast/jquery.toast.js\"></script>
<!--autocomplete-->
<!-- Metis Menu Plugin JavaScript -->
<script src=\"";
        // line 81
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/metisMenu/metisMenu.min.js\"></script>
<!-- Custom Theme JavaScript -->
<script src=\"";
        // line 83
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "dist/js/sb-admin-2.js\"></script>
<script src=\"";
        // line 84
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/datepicker/js/bootstrap-datepicker.min.js\"></script>
<!-- Bootstrap Core JavaScript -->
<script src=\"";
        // line 86
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/bootstrap/js/bootstrap.min.js\">
</script>
<script type=\"text/javascript\">
  window.onload = cargar();
  function cargar(){
    \$('.input-group.date').datepicker({
          startView: 2,
          maxViewMode: 2,
          todayBtn: \"linked\",
          clearBtn: true,
          language: \"es\",
          autoClose : true,
    });
  }
</script>

<script type=\"text/javascript\">
  \$('#myModal').on('shown.bs.modal', function () {
  \$('#myInput').focus()
})
</script>
<script type=\"text/javascript\">
  //\$('.dropdown-toggle').dropdown()
</script>
</html>";
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
        return array (  195 => 86,  190 => 84,  186 => 83,  181 => 81,  175 => 78,  171 => 77,  166 => 75,  162 => 74,  158 => 73,  154 => 72,  150 => 71,  146 => 70,  142 => 69,  138 => 68,  134 => 67,  130 => 66,  126 => 65,  122 => 64,  118 => 63,  114 => 62,  110 => 61,  106 => 60,  102 => 59,  98 => 58,  94 => 57,  90 => 56,  81 => 52,  77 => 51,  72 => 49,  30 => 10,  19 => 1,);
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
    <div id=\"toast\"></div>
</body>

<script type=\"text/javascript\">
  
  var host = '{{base_url}}';
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
  setTimeout(function(){ reloadPage() }, 6000000);

\tfunction reloadPage(argument) {
\t\tlocation.reload();
\t}

</script>

<!-- Libraries Angular-->
<script src=\"{{base_url}}js/lib/angular-route.min.js\"></script>
<!-- APP Angular -->
<script src=\"{{base_url}}js/app/app.js\"></script>
<script src=\"{{base_url}}js/app/routes/{{controller}}Routes.js\"></script>
<!-- Directives-->

<!-- Factories-->
<script src=\"{{base_url}}/js/app/factories/loginFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/countriesFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/detallepedidoFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/facinformativaFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/facpagospedidoFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/factGastosInicialesFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/factgstnacionalizacionFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/factinfdetalleFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/gastosInicialesFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/gstnacionalizacionFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/proveedorFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/incotermsFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/nacionalizacionFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/pedidoFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/pedidofacturaFactory.js\"></script>
<script src=\"{{base_url}}/js/app/factories/productoFactory.js\"></script>
<script src=\"{{base_url}}js/app/controllers/nuevoPedidoController.js\"></script>
<script src=\"{{base_url}}js/app/controllers/presentarPedidoController.js\"></script>
<script src=\"{{base_url}}js/app/controllers/facturasPedidoController.js\"></script>
<script src=\"{{base_url}}js/app/controllers/listarPedidosController.js\"></script>
<!-- jQuery -->
<script src=\"{{base_url}}vendor/jquery/jquery.min.js\"></script>
<script src=\"{{base_url}}vendor/jquery-toast/jquery.toast.js\"></script>
<!--autocomplete-->
<!-- Metis Menu Plugin JavaScript -->
<script src=\"{{base_url}}vendor/metisMenu/metisMenu.min.js\"></script>
<!-- Custom Theme JavaScript -->
<script src=\"{{base_url}}dist/js/sb-admin-2.js\"></script>
<script src=\"{{base_url}}vendor/datepicker/js/bootstrap-datepicker.min.js\"></script>
<!-- Bootstrap Core JavaScript -->
<script src=\"{{base_url}}vendor/bootstrap/js/bootstrap.min.js\">
</script>
<script type=\"text/javascript\">
  window.onload = cargar();
  function cargar(){
    \$('.input-group.date').datepicker({
          startView: 2,
          maxViewMode: 2,
          todayBtn: \"linked\",
          clearBtn: true,
          language: \"es\",
          autoClose : true,
    });
  }
</script>

<script type=\"text/javascript\">
  \$('#myModal').on('shown.bs.modal', function () {
  \$('#myInput').focus()
})
</script>
<script type=\"text/javascript\">
  //\$('.dropdown-toggle').dropdown()
</script>
</html>", "base/footer.html.twig", "/var/www/html/app/src/views/base/footer.html.twig");
    }
}
