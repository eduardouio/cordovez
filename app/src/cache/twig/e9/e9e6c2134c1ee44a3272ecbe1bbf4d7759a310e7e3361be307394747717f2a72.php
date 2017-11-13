<?php

/* base/sections/mostrar-factura-gasto.html.twig */
class __TwigTemplate_aa7698b60fcef76818b55809dc26600d6afaaeb067e23e1862e594bdaf1cddce extends Twig_Template
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
        echo "<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-6\">
         <strong>Proveedor:</strong> <span class=\"text-success\">  ";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "nombre", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Valor:</strong> \$ ";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "valor", array()), "html", null, true);
        echo "
      </div>
      <div class=\"col-sm-2\">
         <strong>Factura:</strong> <span class=\"text-danger\"># ";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "nro_factura", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Fecha:</strong> <span class=\"text-info\">
         ";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "fecha_emision", array()), "html", null, true);
        echo "
      </span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-4\">
         <strong>Categoria Proveedor:</strong> <span>
            ";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "categoria", array()), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Saldo:</strong> <span>";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "saldo", array()), "html", null, true);
        echo "</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Fecha Registro:</strong> ";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute(($context["invoice"] ?? null), "date_create", array()), "html", null, true);
        echo "
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute(($context["userdata"] ?? null), "nombres", array()), "html", null, true);
        echo "</span>
      </div>
   </div>
</div>
<div class=\"row\">
   <div class=\"col-sm-6\">
      <a href=\"\" class=\"btn btn-sm btn-default\">
         <span class=\"\"></span>
         Agregar Detalle
      </a>
   </div>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
</div>
<div class=\"form-in-line\">
   <div class=\"row\">
         <form action=\"";
        // line 47
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/\" method=\"POST\">
      <div class=\"col-sm-5\">
         <div class=\"form-group\">
               <label for=\"concepto\">Concepto</label>
               <input 
               type=\"text\" 
               maxlength=\"50\" 
               required=\"required\" 
               name=\"concepto\" 
               class=\"form-control\"
               placeholder=\"Descripción\"
               >
            </div>
         </div>
         <div class=\"col-sm-2\">
            <div class=\"form-group\">
               <label>Valor</label>
               <input 
               class=\"form-control\" 
               type=\"number\" 
               name=\"valor\"
               required=\"required\" 
               step=\"0.01\"                
               >
            </div>
         </div>
         <div class=\"col-sm-2\">
            <div class=\"form-group\">
               <label>Pedido Nro</label>
            <select
            class = \"form-control\"
            name =\"nro_pedido\"
            id = \"nro_pedido\"
            required = \"required\"            
            >
            <option selected=\"\" disabled=\"\">Seleccione</option>               
            </select>
            </div>
         </div>
         <div class=\"col-sm-2\">
            <div class=\"form-group\">
               <label>Fecha Inicio</label>
            </div>
         </div>
         </form>
   </div>
   </div>
   <br>
   <div class=\"row\">
      <div class=\"col-sm-12\">
         <table class=\"table table-striped table-hover table-bordered\">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Cocepto</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Valor</th>
                  <th>Saldo</th>
                  <th>Pedido</th>
                  <th>Acciones</th>
               </tr>
            </thead>
            <tbody>
               ";
        // line 111
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["detailsInvoice"] ?? null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["detail"]) {
            // line 112
            echo "                  <tr>
                     <td>";
            // line 113
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 114
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "concepto", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 115
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "fecha_inicio", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 116
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "fecha_fin", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 117
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "valor", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 118
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "saldo", array()), "html", null, true);
            echo "</td>
                  <td>";
            // line 119
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "pedido", array()), "html", null, true);
            echo "</td>
                  <td>hola</td>
               </tr>
               ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 123
        echo "            </tbody>
         </table>
      </div>   
   </div>
";
    }

    public function getTemplateName()
    {
        return "base/sections/mostrar-factura-gasto.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  220 => 123,  202 => 119,  198 => 118,  194 => 117,  190 => 116,  186 => 115,  182 => 114,  178 => 113,  175 => 112,  158 => 111,  91 => 47,  72 => 31,  66 => 28,  60 => 25,  53 => 21,  43 => 14,  36 => 10,  30 => 7,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"well well-sm\">
   <div class=\"row\">
      <div class=\"col-sm-6\">
         <strong>Proveedor:</strong> <span class=\"text-success\">  {{ supplier.nombre }}</span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Valor:</strong> \$ {{ invoice.valor }}
      </div>
      <div class=\"col-sm-2\">
         <strong>Factura:</strong> <span class=\"text-danger\"># {{ invoice.nro_factura  }}</span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Fecha:</strong> <span class=\"text-info\">
         {{ invoice.fecha_emision }}
      </span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-4\">
         <strong>Categoria Proveedor:</strong> <span>
            {{ supplier.categoria }}
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Saldo:</strong> <span>{{invoice.saldo}}</span>
      </div>
      <div class=\"col-sm-3\">
         <strong>Fecha Registro:</strong> {{ invoice.date_create }}
      </div>
      <div class=\"col-sm-3\">
         <strong>Creado Por:</strong> <span>{{ userdata.nombres }}</span>
      </div>
   </div>
</div>
<div class=\"row\">
   <div class=\"col-sm-6\">
      <a href=\"\" class=\"btn btn-sm btn-default\">
         <span class=\"\"></span>
         Agregar Detalle
      </a>
   </div>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
</div>
<div class=\"form-in-line\">
   <div class=\"row\">
         <form action=\"{{rute_url}}/\" method=\"POST\">
      <div class=\"col-sm-5\">
         <div class=\"form-group\">
               <label for=\"concepto\">Concepto</label>
               <input 
               type=\"text\" 
               maxlength=\"50\" 
               required=\"required\" 
               name=\"concepto\" 
               class=\"form-control\"
               placeholder=\"Descripción\"
               >
            </div>
         </div>
         <div class=\"col-sm-2\">
            <div class=\"form-group\">
               <label>Valor</label>
               <input 
               class=\"form-control\" 
               type=\"number\" 
               name=\"valor\"
               required=\"required\" 
               step=\"0.01\"                
               >
            </div>
         </div>
         <div class=\"col-sm-2\">
            <div class=\"form-group\">
               <label>Pedido Nro</label>
            <select
            class = \"form-control\"
            name =\"nro_pedido\"
            id = \"nro_pedido\"
            required = \"required\"            
            >
            <option selected=\"\" disabled=\"\">Seleccione</option>               
            </select>
            </div>
         </div>
         <div class=\"col-sm-2\">
            <div class=\"form-group\">
               <label>Fecha Inicio</label>
            </div>
         </div>
         </form>
   </div>
   </div>
   <br>
   <div class=\"row\">
      <div class=\"col-sm-12\">
         <table class=\"table table-striped table-hover table-bordered\">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Cocepto</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Valor</th>
                  <th>Saldo</th>
                  <th>Pedido</th>
                  <th>Acciones</th>
               </tr>
            </thead>
            <tbody>
               {% for detail in detailsInvoice %}
                  <tr>
                     <td>{{loop.index}}</td>
                  <td>{{detail.concepto}}</td>
                  <td>{{detail.fecha_inicio}}</td>
                  <td>{{detail.fecha_fin}}</td>
                  <td>{{detail.valor}}</td>
                  <td>{{detail.saldo}}</td>
                  <td>{{detail.pedido}}</td>
                  <td>hola</td>
               </tr>
               {% endfor %}
            </tbody>
         </table>
      </div>   
   </div>
", "base/sections/mostrar-factura-gasto.html.twig", "/var/www/html/app/src/views/base/sections/mostrar-factura-gasto.html.twig");
    }
}
