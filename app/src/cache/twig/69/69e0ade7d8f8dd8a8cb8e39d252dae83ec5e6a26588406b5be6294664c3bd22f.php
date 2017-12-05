<?php

/* sections/mostrar-factura-pago.html.twig */
class __TwigTemplate_8af8fb806f136f659bc15a65cc66f1746f699f082d10bfce414d124b260c3d6f extends Twig_Template
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
        $context["saldoFactura"] = ($this->getAttribute(($context["document"] ?? null), "valor", array()) - $this->getAttribute($this->getAttribute(($context["document"] ?? null), "invoiceDetails", array()), "sums", array()));
        // line 2
        echo "<div class=\"well well-sm\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Proveedor:</strong> <span>";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["document"] ?? null), "supplier", array()), "nombre", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Ruc:</strong> <span>";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["document"] ?? null), "supplier", array()), "identificacion_proveedor", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Fecha:</strong> <span>";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "fecha_emision", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-5\">
\t\t\t<strong>Comentarios:</strong> <span>";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "comentarios", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Valor \$:</strong> <span class=\"text-primary\">";
        // line 19
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["document"] ?? null), "valor", array()), 2, ",", "."), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Justificado \$:</strong> <span class=\"text-success\"> \$
\t\t\t\t";
        // line 23
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["document"] ?? null), "invoiceDetails", array()), "sums", array()), 0, ",", "."), "html", null, true);
        echo "
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Pendiente \$:</strong> <span class=\"text-danger\"> \$ ";
        // line 27
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["saldoFactura"] ?? null), 0, ",", "."), "html", null, true);
        echo "
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Creado Por :</strong> <span>";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "nombres", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<span>";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "date_create", array()), "html", null, true);
        echo "</span>
\t\t</div>
\t</div>
</div>
<br>
<div class=\"row\">
\t<div class=\"col-md-6\">
\t\t";
        // line 41
        if ((($context["saldoFactura"] ?? null) > 0)) {
            // line 42
            echo "\t\t    &nbsp;
    <small class=\"text-danger\"> <span class=\"fa fa-warning\"></span> Completar El Detalle De La Factura
    </small>
    <br>
    <br>
\t\t<a
\t\t\thref=\"";
            // line 48
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallefacpago/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "id_documento_pago", array()), "html", null, true);
            echo "\"
\t\t\tclass=\"btn btn-default btn-sm\"> <span class=\"fa fa-file\"></span>
\t\t\tAgregar Detalle
\t\t</a> \t\t\t
\t\t";
        }
        // line 53
        echo "\t\t";
        if ((($context["saldoFactura"] ?? null) < 0)) {
            // line 54
            echo "\t\t<h4 class=\"text-danger\" ><span class=\"fa fa-warning\"></span> Factura Inválida, VALORES EXCEDIDOS</h4>  
\t\t";
        }
        // line 56
        echo "\t\t";
        if ((($context["saldoFactura"] ?? null) == 0)) {
            // line 57
            echo "\t\t<h4 class=\"text-succes\" ><span class=\"fa fa-check\"></span> Factura Completa</h4>  
\t\t";
        }
        // line 59
        echo "\t\t<br>
\t\t<br>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-primary\">
\t\t\t<small>Val Factura: \$</small> <span> ";
        // line 64
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["document"] ?? null), "valor", array()), 2, ",", "."), "html", null, true);
        echo "</span>
\t\t</h4>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-success\">
\t\t\t<small>Val Justificado: \$</small> <span> ";
        // line 69
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute(($context["document"] ?? null), "invoiceDetails", array()), "sums", array()), 2, ",", "."), "html", null, true);
        echo "</span>
\t\t</h4>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 
\t\t";
        // line 74
        if ((($context["saldoFactura"] ?? null) > 0)) {
            // line 75
            echo "\t\t\tclass=\"text-success\"
\t\t";
        }
        // line 77
        echo "\t\t";
        if ((($context["saldoFactura"] ?? null) < 0)) {
            // line 78
            echo "\t\t\tclass =\"text-danger\"
\t\t";
        }
        // line 80
        echo "\t\t";
        if ((($context["saldoFactura"] ?? null) == 0)) {
            // line 81
            echo "\t\tclass =\"text-success\"
\t\t";
        }
        // line 83
        echo "\t\tclass=\"text-defult\"
\t\t>
\t\t\t<small>Val Pendiente: \$</small> <span> ";
        // line 85
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["saldoFactura"] ?? null), 2, ",", "."), "html", null, true);
        echo "</span>
\t\t</h4>
\t</div>
</div>
<div class=\"row\">
\t<div class=\"col-md-12\">
\t\t<table class=\"table table-hover table-bordered table-striped\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>#</th>
\t\t\t\t\t<th>Concepto</th>
\t\t\t\t\t<th>Pedido</th>
\t\t\t\t\t<th>Provisión</th>
\t\t\t\t\t<th>Valor</th>
\t\t\t\t\t<th>Saldo</th>
\t\t\t\t\t<th>Desde</th>
\t\t\t\t\t<th>Hasta</th>
\t\t\t\t\t<th>Acciones</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t";
        // line 106
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["document"] ?? null), "invoiceDetails", array()), "details", array()));
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
            echo "\t\t
\t\t\t";
            // line 107
            $context["saldo"] = ($this->getAttribute($this->getAttribute($context["detail"], "expense", array()), "valor_provisionado", array()) - $this->getAttribute($context["detail"], "valor", array()));
            // line 108
            echo "\t\t\t<tr>
\t\t\t<td>";
            // line 109
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</td>
\t\t\t<td> <a href=\"";
            // line 110
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallefacpago/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "id_detalle_documento_pago", array()), "html", null, true);
            echo "\">
\t\t\t";
            // line 111
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detail"], "expense", array()), "concepto", array()), "html", null, true);
            echo "
\t\t\t</a>
\t\t</td>
\t\t\t<td>
\t\t\t\t<a href=\"";
            // line 115
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detail"], "expense", array()), "nro_pedido", array()), "html", null, true);
            echo "\">
\t\t\t\t";
            // line 116
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detail"], "expense", array()), "nro_pedido", array()), "html", null, true);
            echo "
\t\t\t</a>
\t\t\t</td>
\t\t\t<td>";
            // line 119
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["detail"], "expense", array()), "valor_provisionado", array()), 2, ",", "."), "html", null, true);
            echo "</td>
\t\t\t<td>";
            // line 120
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "valor", array()), "html", null, true);
            echo "</td>
\t\t\t<td 
\t\t\t";
            // line 122
            if ((($context["saldo"] ?? null) > 0)) {
                // line 123
                echo "\t\t\t\tclass=\"text-warning\"
\t\t\t";
            }
            // line 125
            echo "\t\t\t";
            if ((($context["saldo"] ?? null) < 0)) {
                // line 126
                echo "\t\t\tclass=\"text-danger\"
\t\t\t";
            }
            // line 128
            echo "\t\t\t";
            if ((($context["saldo"] ?? null) == 0)) {
                // line 129
                echo "\t\t\tclass = \"text-success\"
\t\t\t";
            }
            // line 131
            echo "\t\t\t> 
\t\t\t";
            // line 132
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["saldo"] ?? null), 2, ",", "."), "html", null, true);
            echo " 
\t\t\t</td>
\t\t\t<td>";
            // line 134
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detail"], "expense", array()), "fecha", array()), "html", null, true);
            echo "</td>
\t\t\t<td>";
            // line 135
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detail"], "expense", array()), "fecha_fin", array()), "html", null, true);
            echo "</td>
\t\t\t<td>
\t\t\t\t <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"";
            // line 143
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallefacpago/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "id_detalle_documento_pago", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Justificacion</a> 
                  </li>
                  <li> <a href=\"";
            // line 147
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/presentar/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["detail"], "expense", array()), "id_gastos_nacionalizacion", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Provisión</a> 
                  </li>
                  <li> <a href=\"";
            // line 151
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallefacpago/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "id_detalle_documento_pago", array()), "html", null, true);
            echo "\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Justificacion</a> 
                  </li>
                  <li> <a href=\"";
            // line 155
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "detallefacpago/eliminar/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["detail"], "id_detalle_documento_pago", array()), "html", null, true);
            echo "\" class=\"text-danger\">
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Eliminar Justificacion</a> 
                  </li>
                </ul>
              </div>
\t\t\t</td>
\t\t\t</tr>
\t\t\t";
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
        // line 164
        echo "\t\t\t</tbody>
\t\t</table>
\t</div>
</div>
<div class=\"row\">
\t<div class=\"col-md-2\">
\t\t<a href=\"";
        // line 170
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "/facturapagos/listar/\"><i class=\"fa fa-arrow-left\"></i> Regresar a La Lista De Facturas</a>
\t</div>
\t<div class=\"col-md-offset-10\">
\t<a href=\"";
        // line 173
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "facturapagos/editar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["document"] ?? null), "id_documento_pago", array()), "html", null, true);
        echo "\" class=\"btn btn-info btn-sm\"> 
\tEditar Cabeceras Facura
\t</a>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "sections/mostrar-factura-pago.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  365 => 173,  359 => 170,  351 => 164,  326 => 155,  317 => 151,  308 => 147,  299 => 143,  288 => 135,  284 => 134,  279 => 132,  276 => 131,  272 => 129,  269 => 128,  265 => 126,  262 => 125,  258 => 123,  256 => 122,  251 => 120,  247 => 119,  241 => 116,  235 => 115,  228 => 111,  222 => 110,  218 => 109,  215 => 108,  213 => 107,  194 => 106,  170 => 85,  166 => 83,  162 => 81,  159 => 80,  155 => 78,  152 => 77,  148 => 75,  146 => 74,  138 => 69,  130 => 64,  123 => 59,  119 => 57,  116 => 56,  112 => 54,  109 => 53,  99 => 48,  91 => 42,  89 => 41,  79 => 34,  73 => 31,  66 => 27,  59 => 23,  52 => 19,  44 => 14,  38 => 11,  32 => 8,  26 => 5,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set saldoFactura  = (document.valor-document.invoiceDetails.sums) %}
<div class=\"well well-sm\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Proveedor:</strong> <span>{{ document.supplier.nombre }}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Ruc:</strong> <span>{{ document.supplier.identificacion_proveedor }}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Fecha:</strong> <span>{{ document.fecha_emision  }}</span>
\t\t</div>
\t\t<div class=\"col-md-5\">
\t\t\t<strong>Comentarios:</strong> <span>{{ document.comentarios }}</span>
\t\t</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Valor \$:</strong> <span class=\"text-primary\">{{ document.valor | number_format(2,',','.')}}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Justificado \$:</strong> <span class=\"text-success\"> \$
\t\t\t\t{{ document.invoiceDetails.sums | number_format(0,',','.') }}
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<strong>Pendiente \$:</strong> <span class=\"text-danger\"> \$ {{ saldoFactura | number_format(0,',','.') }}
\t\t\t</span>
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<strong>Creado Por :</strong> <span>{{ user.nombres }}</span>
\t\t</div>
\t\t<div class=\"col-md-2\">
\t\t\t<span>{{ document.date_create }}</span>
\t\t</div>
\t</div>
</div>
<br>
<div class=\"row\">
\t<div class=\"col-md-6\">
\t\t{% if saldoFactura > 0 %}
\t\t    &nbsp;
    <small class=\"text-danger\"> <span class=\"fa fa-warning\"></span> Completar El Detalle De La Factura
    </small>
    <br>
    <br>
\t\t<a
\t\t\thref=\"{{ rute_url }}detallefacpago/nuevo/{{ document.id_documento_pago }}\"
\t\t\tclass=\"btn btn-default btn-sm\"> <span class=\"fa fa-file\"></span>
\t\t\tAgregar Detalle
\t\t</a> \t\t\t
\t\t{% endif %}
\t\t{% if saldoFactura < 0 %}
\t\t<h4 class=\"text-danger\" ><span class=\"fa fa-warning\"></span> Factura Inválida, VALORES EXCEDIDOS</h4>  
\t\t{% endif %}
\t\t{% if saldoFactura == 0 %}
\t\t<h4 class=\"text-succes\" ><span class=\"fa fa-check\"></span> Factura Completa</h4>  
\t\t{% endif %}
\t\t<br>
\t\t<br>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-primary\">
\t\t\t<small>Val Factura: \$</small> <span> {{ document.valor | number_format(2,',','.')}}</span>
\t\t</h4>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 class=\"text-success\">
\t\t\t<small>Val Justificado: \$</small> <span> {{ document.invoiceDetails.sums | number_format(2,',','.') }}</span>
\t\t</h4>
\t</div>
\t<div class=\"col-md-2\">
\t\t<h4 
\t\t{% if saldoFactura > 0 %}
\t\t\tclass=\"text-success\"
\t\t{% endif %}
\t\t{% if saldoFactura < 0 %}
\t\t\tclass =\"text-danger\"
\t\t{% endif %}
\t\t{% if saldoFactura == 0 %}
\t\tclass =\"text-success\"
\t\t{% endif %}
\t\tclass=\"text-defult\"
\t\t>
\t\t\t<small>Val Pendiente: \$</small> <span> {{ saldoFactura | number_format(2,',','.') }}</span>
\t\t</h4>
\t</div>
</div>
<div class=\"row\">
\t<div class=\"col-md-12\">
\t\t<table class=\"table table-hover table-bordered table-striped\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>#</th>
\t\t\t\t\t<th>Concepto</th>
\t\t\t\t\t<th>Pedido</th>
\t\t\t\t\t<th>Provisión</th>
\t\t\t\t\t<th>Valor</th>
\t\t\t\t\t<th>Saldo</th>
\t\t\t\t\t<th>Desde</th>
\t\t\t\t\t<th>Hasta</th>
\t\t\t\t\t<th>Acciones</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t{%  for detail in document.invoiceDetails.details %}\t\t
\t\t\t{% set saldo =  ( detail.expense.valor_provisionado - detail.valor) %}
\t\t\t<tr>
\t\t\t<td>{{loop.index}}</td>
\t\t\t<td> <a href=\"{{rute_url}}detallefacpago/presentar/{{detail.id_detalle_documento_pago}}\">
\t\t\t{{ detail.expense.concepto  }}
\t\t\t</a>
\t\t</td>
\t\t\t<td>
\t\t\t\t<a href=\"{{rute_url}}pedido/presentar/{{ detail.expense.nro_pedido  }}\">
\t\t\t\t{{ detail.expense.nro_pedido  }}
\t\t\t</a>
\t\t\t</td>
\t\t\t<td>{{ detail.expense.valor_provisionado  | number_format(2,',','.') }}</td>
\t\t\t<td>{{ detail.valor }}</td>
\t\t\t<td 
\t\t\t{% if saldo > 0  %}
\t\t\t\tclass=\"text-warning\"
\t\t\t{% endif %}
\t\t\t{% if saldo < 0 %}
\t\t\tclass=\"text-danger\"
\t\t\t{% endif %}
\t\t\t{% if saldo == 0 %}
\t\t\tclass = \"text-success\"
\t\t\t{% endif %}
\t\t\t> 
\t\t\t{{ saldo | number_format(2,',','.') }} 
\t\t\t</td>
\t\t\t<td>{{ detail.expense.fecha }}</td>
\t\t\t<td>{{ detail.expense.fecha_fin  }}</td>
\t\t\t<td>
\t\t\t\t <div class=\"dropdown\">
                <button id=\"dLabel\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"btn btn-sm btn-default\">
                <span class=\"fa fa-chevron-down\" ></span>
                Seleccione
                </button>
                <ul class=\"dropdown-menu\" aria-labelledby=\"dLabel\">
                  <li> <a href=\"{{rute_url}}detallefacpago/presentar/{{detail.id_detalle_documento_pago}}\">
                    <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Justificacion</a> 
                  </li>
                  <li> <a href=\"{{rute_url}}gstinicial/presentar/{{detail.expense.id_gastos_nacionalizacion}}\">
                    <span class=\"fa fa-eye fa-fw\"></span>
                    Ver Provisión</a> 
                  </li>
                  <li> <a href=\"{{rute_url}}detallefacpago/editar/{{detail.id_detalle_documento_pago}}\">
                    <span class=\"fa fa-pencil fa-fw\"></span>
                    Editar Justificacion</a> 
                  </li>
                  <li> <a href=\"{{rute_url}}detallefacpago/eliminar/{{detail.id_detalle_documento_pago}}\" class=\"text-danger\">
                    <span class=\"fa fa-trash fa-fw\"></span>
                    Eliminar Justificacion</a> 
                  </li>
                </ul>
              </div>
\t\t\t</td>
\t\t\t</tr>
\t\t\t{%  endfor %}
\t\t\t</tbody>
\t\t</table>
\t</div>
</div>
<div class=\"row\">
\t<div class=\"col-md-2\">
\t\t<a href=\"{{rute_url}}/facturapagos/listar/\"><i class=\"fa fa-arrow-left\"></i> Regresar a La Lista De Facturas</a>
\t</div>
\t<div class=\"col-md-offset-10\">
\t<a href=\"{{rute_url}}facturapagos/editar/{{document.id_documento_pago}}\" class=\"btn btn-info btn-sm\"> 
\tEditar Cabeceras Facura
\t</a>
\t</div>
</div>", "sections/mostrar-factura-pago.html.twig", "/var/www/html/app/src/views/sections/mostrar-factura-pago.html.twig");
    }
}
