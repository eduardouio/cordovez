<?php

/* base/sections/listar-factura-pago.html.twig */
class __TwigTemplate_93bff079b087eeff6c171174f78c51aa6610145865bb973381ea24be3f5bd41a extends Twig_Template
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
        echo "<div class=\"factura-pago\">
  <div class=\"row\">
    <div class=\"col-sm-3\">
      <a href=\"";
        // line 4
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "facturapagos/nuevo/\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Nuevo Factura o Comprobate
        </button>
      </a>
    </div>
        <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Total: </small> <span id=\"suma\"> ";
        // line 12
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["count"] ?? null), 0, ".", ","), "html", null, true);
        echo " Facturas </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Internacionales: </small> <span id=\"suma\"> ";
        // line 15
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["countInter"] ?? null), 0, ".", ","), "html", null, true);
        echo "</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Nacionales: </small> <span id=\"suma\">  ";
        // line 18
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["countNat"] ?? null), 0, ".", ","), "html", null, true);
        echo " </span></h5>
    </div>
    <div class=\"col-sm-3\">
      <form action=\"";
        // line 21
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "facturapagos/busquedas/\" 
      method=\"POST\" 
      class=\"form-inline\" 
      role=\"form\">
        <div class=\"form-group\">
          <input 
          type=\"text\" 
          class=\"form-control\" 
          placeholder=\"Buscar\"
          >
        </div>
       <button 
       type=\"submit\"
       class=\"btn\" >
        &nbsp;&nbsp;&nbsp;
       <span class=\"fa fa-search fa-fw\"></span>
       &nbsp;&nbsp;&nbsp;
     </button>
      </form>
    </div>
  </div>
  <br>
  <div class=\"row\">
    <form action=\"\" method=\"POST\" role=\"form\">
   <div class=\"col-sm-3\">
      <div class=\"form-group\">
    <label for=\"\">label</label>
    <input type=\"text\" class=\"form-control\" id=\"\" placeholder=\"Input field\">
  </div>    
   </div>   
  

  <button type=\"submit\" class=\"btn btn-default btn-sm\">Submit</button>
  </form>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"table-responsive\">
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Proveedor</th>
            <th>Nro Documento</th>
            <th>Fecha</th>
            <th>Valor</th>
            <th>Saldo</th>
            <th>Pedido(s)</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          ";
        // line 73
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoices"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 74
            echo "          <tr>
            <td>";
            // line 75
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
            <td>
              <a href=\"";
            // line 77
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "facturapagos/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_factura_pagos", array()), "html", null, true);
            echo "\">
                ";
            // line 78
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "nro_factura", array()), "html", null, true);
            echo "
              </a>
            </td>
            <td>";
            // line 81
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "identificacion_proveedor", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 82
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "fecha_emision", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 83
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["invoice"], "valor", array()), 0, ".", ","), "html", null, true);
            echo "</td>
            <td>";
            // line 84
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["invoice"], "saldo", array()), 0, ".", ","), "html", null, true);
            echo "</td>
            <td>completar</td>
            <td>
              <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"";
            // line 93
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "id_proveedor", array()), "html", null, true);
            echo "\"> <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Proveedor </a>  
                  </li>
                  <li> <a href=\"";
            // line 96
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "id_proveedor", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Proveedor</a> 
                  </li>
                  <li> <a href=\"";
            // line 100
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "proveedor/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["supplier"] ?? null), "id_proveedor", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Proveedor</a> 
                  </li>
                </ul>
              </div>
            </td>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 109
        echo "        </tbody>
      </table>
    </div>
  </div>
</div>
<!--tabPedido-->";
    }

    public function getTemplateName()
    {
        return "base/sections/listar-factura-pago.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  211 => 109,  186 => 100,  177 => 96,  169 => 93,  157 => 84,  153 => 83,  149 => 82,  145 => 81,  139 => 78,  133 => 77,  128 => 75,  125 => 74,  108 => 73,  53 => 21,  47 => 18,  41 => 15,  35 => 12,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"factura-pago\">
  <div class=\"row\">
    <div class=\"col-sm-3\">
      <a href=\"{{ rute_url }}facturapagos/nuevo/\">
        <button class=\"btn btn-sm btn-default\">
          <span class=\"fa fa-plus fa-fw\"></span>
          Nuevo Factura o Comprobate
        </button>
      </a>
    </div>
        <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Total: </small> <span id=\"suma\"> {{ count | number_format(0, '.', ',') }} Facturas </span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-primary\"> <small>Internacionales: </small> <span id=\"suma\"> {{ countInter | number_format(0, '.', ',')}}</span></h5>
    </div>
    <div class=\"col-sm-2\">
      <h5 class=\"text-danger\"> <small>Nacionales: </small> <span id=\"suma\">  {{ countNat | number_format(0, '.', ',') }} </span></h5>
    </div>
    <div class=\"col-sm-3\">
      <form action=\"{{rute_url}}facturapagos/busquedas/\" 
      method=\"POST\" 
      class=\"form-inline\" 
      role=\"form\">
        <div class=\"form-group\">
          <input 
          type=\"text\" 
          class=\"form-control\" 
          placeholder=\"Buscar\"
          >
        </div>
       <button 
       type=\"submit\"
       class=\"btn\" >
        &nbsp;&nbsp;&nbsp;
       <span class=\"fa fa-search fa-fw\"></span>
       &nbsp;&nbsp;&nbsp;
     </button>
      </form>
    </div>
  </div>
  <br>
  <div class=\"row\">
    <form action=\"\" method=\"POST\" role=\"form\">
   <div class=\"col-sm-3\">
      <div class=\"form-group\">
    <label for=\"\">label</label>
    <input type=\"text\" class=\"form-control\" id=\"\" placeholder=\"Input field\">
  </div>    
   </div>   
  

  <button type=\"submit\" class=\"btn btn-default btn-sm\">Submit</button>
  </form>
  </div>
  <br>
  <div class=\"row\">
    <div class=\"table-responsive\">
      <table class=\"table table-hover table-bordered table-striped\">
        <thead>
          <tr style=\"background-color: #c1c1c1;\">
            <th>#</th>
            <th>Proveedor</th>
            <th>Nro Documento</th>
            <th>Fecha</th>
            <th>Valor</th>
            <th>Saldo</th>
            <th>Pedido(s)</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {% for invoice in invoices %}
          <tr>
            <td>{{loop.index}}</td>
            <td>
              <a href=\"{{rute_url}}facturapagos/presentar/{{invoice.id_factura_pagos}}\">
                {{invoice.nro_factura}}
              </a>
            </td>
            <td>{{invoice.identificacion_proveedor}}</td>
            <td>{{invoice.fecha_emision}}</td>
            <td>{{invoice.valor | number_format(0, '.', ',')}}</td>
            <td>{{invoice.saldo | number_format(0, '.', ',')}}</td>
            <td>completar</td>
            <td>
              <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"{{rute_url}}proveedor/presentar/{{supplier.id_proveedor}}\"> <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Proveedor </a>  
                  </li>
                  <li> <a href=\"{{rute_url}}proveedor/editar/{{supplier.id_proveedor}}\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Proveedor</a> 
                  </li>
                  <li> <a href=\"{{rute_url}}proveedor/eliminar/{{supplier.id_proveedor}}\">
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Elminar Proveedor</a> 
                  </li>
                </ul>
              </div>
            </td>
          </tr>
          {% endfor %}
        </tbody>
      </table>
    </div>
  </div>
</div>
<!--tabPedido-->", "base/sections/listar-factura-pago.html.twig", "/var/www/html/app/src/views/base/sections/listar-factura-pago.html.twig");
    }
}
