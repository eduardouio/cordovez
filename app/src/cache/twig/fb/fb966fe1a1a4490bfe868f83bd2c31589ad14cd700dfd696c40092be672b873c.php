<?php

/* /pages/pagePedido.html.twig */
class __TwigTemplate_f3737f9f4d898e2805bc5fd3fc7a7516dc04dc6cf1a476b76585ec8fb88f152e extends Twig_Template
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
        $this->loadTemplate("base/header.html.twig", "/pages/pagePedido.html.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("base/navbarheader.html.twig", "/pages/pagePedido.html.twig", 2)->display($context);
        // line 3
        $this->loadTemplate("base/navbarleft.html.twig", "/pages/pagePedido.html.twig", 3)->display($context);
        // line 4
        $this->loadTemplate("base/content.html.twig", "/pages/pagePedido.html.twig", 4)->display($context);
        // line 5
        if ((($context["selected_expenses"] ?? null) == true)) {
            // line 6
            echo "   ";
            $this->loadTemplate("sections/seleccionar-gi-provisiones.html.twig", "/pages/pagePedido.html.twig", 6)->display($context);
        }
        // line 8
        if ((($context["list_orders"] ?? null) == true)) {
            // line 9
            echo "   ";
            $this->loadTemplate("sections/listar-pedidos.html.twig", "/pages/pagePedido.html.twig", 9)->display($context);
        }
        // line 11
        if ((($context["show_order"] ?? null) == true)) {
            // line 12
            echo "   ";
            $this->loadTemplate("sections/mostrar-pedido.html.twig", "/pages/pagePedido.html.twig", 12)->display($context);
            echo "    
";
        }
        // line 14
        echo "   ";
        if ((($context["create_order"] ?? null) == true)) {
            // line 15
            $this->loadTemplate("forms/frm-pedido.html.twig", "/pages/pagePedido.html.twig", 15)->display($context);
            echo "    
<script type=\"text/javascript\" src=\"";
            // line 16
            echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
            echo "js/incoterms.js\"></script>
";
        }
        // line 17
        echo "\t
";
        // line 18
        if ((($context["edit_order"] ?? null) == true)) {
            // line 19
            $this->loadTemplate("forms/frm-pedido-edit.html.twig", "/pages/pagePedido.html.twig", 19)->display($context);
            echo "    
<script type=\"text/javascript\" src=\"";
            // line 20
            echo twig_escape_filter($this->env, ($context["base_url"] ?? null), "html", null, true);
            echo "js/incoterms.js\"></script>
";
        }
        // line 22
        if ((($context["viewMessage"] ?? null) == true)) {
            // line 23
            echo "<div class=\"well\">
   <h3 class=\"text-primary\">\t";
            // line 24
            echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
            echo " </h3>
   <br><br>
   <p>
      ";
            // line 27
            if ((($context["deleted"] ?? null) == true)) {
                echo " 
      <a href=\"";
                // line 28
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/listar/\">
      <button class=\"btn btn-default btn-sm\"><span class=\"fa fa-list\"></span>
      Volver a la lista
      </button>
      </a>
      ";
            } elseif ((            // line 33
($context["fail"] ?? null) == true)) {
                echo "  
      \t\t<a href=\"javascript:history.back(1)\">
      \t\t\t<button class=\"btn btn-default btn-sm\"><span class=\"fa fa-arrow-left\"></span>
      \t\tVolver Atrás
      \t</button>
      \t</a>
      ";
            } else {
                // line 40
                echo "      \t\t<a href=\"";
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/presentar/";
                echo twig_escape_filter($this->env, ($context["order"] ?? null), "html", null, true);
                echo "\">
      \t\t\t<button class=\"btn btn-default btn-sm\"><span class=\"fa fa-eye\"></span>
      \t\tMostrar 
      \t</button>
      \t</a>
      ";
            }
            // line 45
            echo "\t\t\t\t
   </p>
</div>
      ";
        }
        // line 49
        $this->loadTemplate("base/content_close.html.twig", "/pages/pagePedido.html.twig", 49)->display($context);
        // line 50
        $this->loadTemplate("base/signaturefoot.html.twig", "/pages/pagePedido.html.twig", 50)->display($context);
        // line 51
        $this->loadTemplate("base/footer.html.twig", "/pages/pagePedido.html.twig", 51)->display($context);
    }

    public function getTemplateName()
    {
        return "/pages/pagePedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 51,  126 => 50,  124 => 49,  118 => 45,  106 => 40,  96 => 33,  88 => 28,  84 => 27,  78 => 24,  75 => 23,  73 => 22,  68 => 20,  64 => 19,  62 => 18,  59 => 17,  54 => 16,  50 => 15,  47 => 14,  41 => 12,  39 => 11,  35 => 9,  33 => 8,  29 => 6,  27 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% include 'base/header.html.twig' %}
{% include 'base/navbarheader.html.twig' %}
{% include 'base/navbarleft.html.twig' %}
{% include 'base/content.html.twig' %}
{% if selected_expenses == true %}
   {% include 'sections/seleccionar-gi-provisiones.html.twig' %}
{% endif %}
{% if list_orders == true %}
   {% include 'sections/listar-pedidos.html.twig' %}
{% endif %}
{% if show_order == true %}
   {% include 'sections/mostrar-pedido.html.twig' %}    
{% endif %}
   {% if create_order == true %}
{% include 'forms/frm-pedido.html.twig' %}    
<script type=\"text/javascript\" src=\"{{base_url}}js/incoterms.js\"></script>
{% endif %}\t
{% if edit_order == true %}
{% include 'forms/frm-pedido-edit.html.twig' %}    
<script type=\"text/javascript\" src=\"{{base_url}}js/incoterms.js\"></script>
{% endif %}
{% if viewMessage == true %}
<div class=\"well\">
   <h3 class=\"text-primary\">\t{{message}} </h3>
   <br><br>
   <p>
      {% if deleted == true %} 
      <a href=\"{{rute_url}}pedido/listar/\">
      <button class=\"btn btn-default btn-sm\"><span class=\"fa fa-list\"></span>
      Volver a la lista
      </button>
      </a>
      {% elseif fail == true %}  
      \t\t<a href=\"javascript:history.back(1)\">
      \t\t\t<button class=\"btn btn-default btn-sm\"><span class=\"fa fa-arrow-left\"></span>
      \t\tVolver Atrás
      \t</button>
      \t</a>
      {% else %}
      \t\t<a href=\"{{rute_url}}pedido/presentar/{{order}}\">
      \t\t\t<button class=\"btn btn-default btn-sm\"><span class=\"fa fa-eye\"></span>
      \t\tMostrar 
      \t</button>
      \t</a>
      {% endif %}\t\t\t\t
   </p>
</div>
      {% endif %}
{% include 'base/content_close.html.twig' %}
{% include 'base/signaturefoot.html.twig' %}
{% include 'base/footer.html.twig' %}", "/pages/pagePedido.html.twig", "/var/www/html/app/src/views/pages/pagePedido.html.twig");
    }
}
