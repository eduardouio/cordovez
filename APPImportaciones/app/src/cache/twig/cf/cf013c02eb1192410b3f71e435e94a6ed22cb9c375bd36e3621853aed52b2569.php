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
</body>

<script type=\"text/javascript\">
  setTimeout(function(){ reloadPage() }, 6000000);

\tfunction reloadPage(argument) {
\t\tlocation.reload();
\t}

</script>
<!--autocomplete-->
<!-- Metis Menu Plugin JavaScript -->
<script src=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/metisMenu/metisMenu.min.js\"></script>
<!-- Custom Theme JavaScript -->
<script src=\"";
        // line 18
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "dist/js/sb-admin-2.js\"></script>
<script src=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/datepicker/js/bootstrap-datepicker.min.js\"></script>
<!-- Bootstrap Core JavaScript -->
<script src=\"";
        // line 21
        echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
        echo "vendor/bootstrap/js/bootstrap.min.js\">
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
        return array (  50 => 21,  45 => 19,  41 => 18,  36 => 16,  19 => 1,);
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
</body>

<script type=\"text/javascript\">
  setTimeout(function(){ reloadPage() }, 6000000);

\tfunction reloadPage(argument) {
\t\tlocation.reload();
\t}

</script>
<!--autocomplete-->
<!-- Metis Menu Plugin JavaScript -->
<script src=\"{{base_url}}vendor/metisMenu/metisMenu.min.js\"></script>
<!-- Custom Theme JavaScript -->
<script src=\"{{base_url}}dist/js/sb-admin-2.js\"></script>
<script src=\"{{base_url}}vendor/datepicker/js/bootstrap-datepicker.min.js\"></script>
<!-- Bootstrap Core JavaScript -->
<script src=\"{{base_url}}vendor/bootstrap/js/bootstrap.min.js\">
</script>
</html>", "base/footer.html.twig", "/var/www/html/app/src/views/base/footer.html.twig");
    }
}
