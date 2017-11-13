<?php

/* sections/validar-pedido.html.twig */
class __TwigTemplate_67a632b72a7009ba8eb04a1752f5844743257d020f6a6cf78aa7b17b9f9daab7 extends Twig_Template
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
      <div class=\"col-sm-3\">
         <strong>Valor FOB Total:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <strong class=\"text-primary\">
         ";
        // line 7
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["fob"] ?? null), 2, ".", ","), "html", null, true);
        echo "      
         </strong>  
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Nro Pedido:</strong> 
         <span class=\"text-primary\">
         ";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Regimen:</strong> 
         <span class=\"text-primary\">
         <strong class=\"text-primary\">
         ";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "regimen", array()), "html", null, true);
        echo "
         </strong>   
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Fecha Registro:</strong> 
         <span class=\"text-primary\">
         ";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "date_create", array()), "html", null, true);
        echo "            
         </span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Tiempo Bodega:</strong> 
      </div>
      <div class=\"col-sm-2\">
         <strong>P. Origen:</strong> 
         <span class=\"text-primary\">
         ";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "pais_origen", array()), "html", null, true);
        echo "
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>C Origen:</strong> 
         <span class=\"text-primary\">
         ";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "ciudad_origen", array()), "html", null, true);
        echo "            
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Incoterm:</strong> 
         <span class=\"text-primary\">
         ";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "incoterm", array()), "html", null, true);
        echo "
         </span>         
      </div>
      <div class=\"col-sm-2\">
         <strong>Creado Por:</strong> 
         <span>";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["createBy"] ?? null), 0, array(), "array"), "nombres", array(), "array"), "html", null, true);
        echo "
         </span>
      </div>
   </div>
</div>
<div class=\"row\">
   <div class=\"col-md-2\">&nbsp;</div>
   <div class=\"col-md-8\">
      ";
        // line 66
        $context["invoicesStatus"] = true;
        // line 67
        echo "      <table  class=\"table table-hover table-condensed table-striped table-bordered\">
         <thead>
            <tr style=\"background-color: #333; color: #fff;\">
               <th colspan=\"3\" class=\"text-center\">
                  RESUMEN DE ESTADO GASTOS INICIALES PEDIDO 
                  [";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "]
               </th>
            </tr>
         </thead>
         <tbody>
            <tr style=\"background-color: #fff;\">
               <th class=\"text-center\">CONCEPTO</th>
               <th class=\"text-center\">VALOR</th>
               <th class=\"text-center\">ESTADO</th>
            </tr>
            <tr>
               <td>Gastos Origen</td>
               ";
        // line 84
        if (($this->getAttribute(($context["minimal"] ?? null), "have_gasto_origen", array()) == true)) {
            // line 85
            echo "               ";
            if (($this->getAttribute(($context["minimal"] ?? null), "gasto_origen", array()) == false)) {
                // line 86
                echo "               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"";
                // line 88
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "gstinicial/nuevo/";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
                echo "\">
                  Registrar                        
                  </a>
               </td>
               ";
            } else {
                // line 93
                echo "               <td>";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "gasto_origen", array()), 2, ",", "."), "html", null, true);
                echo "</td>
               <td class=\"success\" >OK</td>
               ";
            }
            // line 95
            echo "               
               </td>   
               ";
        } else {
            // line 98
            echo "               <td class=\"success\" >No requerido</td>
               <td class=\"success\" >OK</td>
               ";
        }
        // line 101
        echo "            </tr>
            <tr>
               <td>Felte Internacional</td>
               ";
        // line 104
        if (($this->getAttribute(($context["minimal"] ?? null), "have_flete", array()) == true)) {
            // line 105
            echo "               ";
            if (($this->getAttribute(($context["minimal"] ?? null), "flete", array()) == false)) {
                // line 106
                echo "               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"";
                // line 108
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "gstinicial/nuevo/";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
                echo "\">
                  Registrar                        
                  </a>
               </td>
               ";
            } else {
                // line 113
                echo "               <td>";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "flete", array()), 2, ",", "."), "html", null, true);
                echo "</td>
               <td class=\"success\"> OK </td>
               ";
            }
            // line 116
            echo "               ";
        } else {
            // line 117
            echo "               <td>No requerido</td>
               <td class=\"success\" >OK</td>
               ";
        }
        // line 120
        echo "            </tr>
            <tr>
               <td>Facturas Producto  <strong>";
        // line 122
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "</strong> Proveedor Internacional</td>
               ";
        // line 123
        if ((($context["invoicesOrder"] ?? null) == false)) {
            // line 124
            echo "               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"";
            // line 126
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedidofactura/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "/\">
                  Registrar 
                  </a>
               </td>
               ";
        } else {
            // line 131
            echo "               ";
            if (($this->getAttribute(($context["minimal"] ?? null), "total_pedido", array()) == false)) {
                // line 132
                echo "               <td>Inconsistencias</td>   
               <td class=\"danger\">
                  <a href=\"";
                // line 134
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedido/presentar/";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
                echo "\">
                     Validar                     
                  </a>
                  </td>
               ";
            } else {
                // line 139
                echo "               <td>";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "total_pedido", array()), 2, ",", "."), "html", null, true);
                echo "</td>   
               <td class=\"success\">OK</td>
               ";
            }
            // line 142
            echo "               ";
        }
        // line 143
        echo "            </tr>
            <tr>
               <td>Fecha Arribo</td>
               ";
        // line 146
        if (($this->getAttribute(($context["minimal"] ?? null), "fecha_arribo", array()) == false)) {
            // line 147
            echo "               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"";
            // line 149
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "\">
                     Registrar                     
                  </a>
                  </td>
               ";
        } else {
            // line 154
            echo "               <td>
               ";
            // line 155
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "fecha_arribo", array()), "html", null, true);
            echo "
            </td>
               <td class=\"success\">OK</td>
               ";
        }
        // line 159
        echo "            </tr>
            <tr>
               <td>Días Libres Demoraje </td>
               ";
        // line 162
        if (($this->getAttribute(($context["minimal"] ?? null), "dias_libres", array()) == false)) {
            // line 163
            echo "               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"";
            // line 165
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "pedido/editar/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "\">
                     Registrar                     
                  </a>
                  </td>
               ";
        } else {
            // line 170
            echo "               <td> ";
            echo $this->getAttribute(($context["minimal"] ?? null), "dias_libres", array());
            echo "</td>
               <td class=\"success\">OK</td>
               ";
        }
        // line 173
        echo "            </tr>
            <tr>
               <td>Almacenaje Inicial</td>
               ";
        // line 176
        if (($this->getAttribute(($context["minimal"] ?? null), "almacenaje_inicial", array()) == false)) {
            // line 177
            echo "                  <td>No Registrado</td>
                  <td class=\"danger\"> Registrar</td>
               ";
        } else {
            // line 180
            echo "                  <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "almacenaje_inicial", array()), "html", null, true);
            echo "</td>
                  <td class=\"success\">OK</td>
               ";
        }
        // line 183
        echo "            </tr>
            <tr>
               <td>Agente Inicial</td>
                  ";
        // line 186
        if (($this->getAttribute(($context["minimal"] ?? null), "agente_inicial", array()) == false)) {
            // line 187
            echo "                     <td>No Registrado</td>
                     <td class=\"danger\"> Registrar</td>
                  ";
        } else {
            // line 190
            echo "                     <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "agente_inicial", array()), "html", null, true);
            echo "</td>
                     <td class=\"success\">OK</td>
                  ";
        }
        // line 193
        echo "
            </tr>
             <tr>
               <td>Almacenaje Inicial</td>
               ";
        // line 197
        if (($this->getAttribute(($context["minimal"] ?? null), "almacenaje_inicial", array()) == false)) {
            // line 198
            echo "               <td>No Registrado</td>
               <td class=\"danger\"> Registrar</td>
               ";
        } else {
            // line 201
            echo "               <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "almacenaje_inicial", array()), "html", null, true);
            echo "</td>
               <td class=\"success\">OK</td>
               ";
        }
        // line 204
        echo "            </tr>
         <tr>
            <td>Candado Satelital</td>
            ";
        // line 207
        if (($this->getAttribute(($context["minimal"] ?? null), "candado_satelital", array()) == false)) {
            // line 208
            echo "            <td>No Registrado</td>
            <td class=\"danger\">Registdar</td>
            ";
        } else {
            // line 211
            echo "               <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "candado_satelital", array()), "html", null, true);
            echo "</td>
               <td class=\"success\"> OK </td>
            ";
        }
        // line 214
        echo "         </tr>
         <tr>
            <td>Demoraje</td>
            ";
        // line 217
        if (($context["condition"] ?? null)) {
            // line 218
            echo "            <td>No Registrado</td>
            <td class=\"danger\">Registrar</td>
            ";
        } else {
            // line 221
            echo "            <td> ";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "demoraje", array()), "html", null, true);
            echo "</td>
            <td class=\"success\"> OK </td>
            ";
        }
        // line 224
        echo "         </tr>
         <tr>
               <td>Custodia Armada</td>
               ";
        // line 227
        if (($this->getAttribute(($context["minimal"] ?? null), "custodia_armada", array()) == false)) {
            // line 228
            echo "                  <td>No Registrado</td>
                   <td class=\"danger\"> Registrar</td>
               ";
        } else {
            // line 231
            echo "                  <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "custodia_armada", array()), "html", null, true);
            echo "</td>
                  <td class=\"success\">OK</td>
               ";
        }
        // line 234
        echo "            </tr>
            <tr>
               <td>Gastos Locales</td>
               ";
        // line 237
        if (($this->getAttribute(($context["minimal"] ?? null), "gastos_locales", array()) == false)) {
            // line 238
            echo "               <td>No Registrado</td>
               <td class=\"danger\"> Registrar</td>
               ";
        } else {
            // line 241
            echo "               <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "gastos_locales", array()), "html", null, true);
            echo "</td>
               <td class=\"success\">OK</td>
               ";
        }
        // line 244
        echo "            </tr>
         <tr>
               <td>Descarga</td>
               ";
        // line 247
        if (($this->getAttribute(($context["minimal"] ?? null), "descarga", array()) == false)) {
            // line 248
            echo "               <td>No Registrado</td>
               <td class=\"danger\"> Registrar</td>
               ";
        } else {
            // line 251
            echo "               <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "descarga", array()), "html", null, true);
            echo "</td>
               <td class=\"success\">OK</td>
               ";
        }
        // line 254
        echo "            </tr>
            <tr>
               <td>ISD</td>
               ";
        // line 257
        if (($this->getAttribute(($context["minimal"] ?? null), "isd", array()) == false)) {
            // line 258
            echo "                  <td>No Registrado</td>
                  <td class=\"danger\">Registrar</td>   
               ";
        } else {
            // line 261
            echo "                  <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "isd", array()), "html", null, true);
            echo "</td>
                  <td class=\"success\">OK</td>
               ";
        }
        // line 264
        echo "            </tr>
                        <tr>
               <td>Mano de Obra</td>
               ";
        // line 267
        if (($this->getAttribute(($context["minimal"] ?? null), "mano_obra", array()) == false)) {
            // line 268
            echo "                  <td>No Registrado</td>
                  <td class=\"danger\">Registrar</td>   
               ";
        } else {
            // line 271
            echo "                  <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "mano_obra", array()), "html", null, true);
            echo "</td>
                  <td class=\"success\">OK</td>
               ";
        }
        // line 274
        echo "            </tr>
            <tr>
               <td>Seguro</td>
               ";
        // line 277
        if (($this->getAttribute(($context["minimal"] ?? null), "seguro", array()) == false)) {
            // line 278
            echo "               <td>No Registrado</td>
               <td class=\"danger\">Registrar</td>   
               ";
        } else {
            // line 281
            echo "               <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "seguro", array()), "html", null, true);
            echo "</td>
               <td class=\"success\">Ok</td>
               ";
        }
        // line 284
        echo "            </tr>
            <tr>
               <td>Transporte Interno</td>
               ";
        // line 287
        if (($this->getAttribute(($context["minimal"] ?? null), "transporte_interno", array()) == false)) {
            // line 288
            echo "               <td>No Registrado</td>
               <td class=\"danger\"> Registrar</td>
               ";
        } else {
            // line 291
            echo "                  <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "transporte_interno", array()), "html", null, true);
            echo "</td>
                  <td class=\"success\">OK</td>
               ";
        }
        // line 294
        echo "            </tr>
            <tr>
               <td>THC</td>
               ";
        // line 297
        if (($this->getAttribute(($context["minimal"] ?? null), "thc", array()) == false)) {
            // line 298
            echo "               <td>No Registrado</td>
               <td class=\"danger\">Registrar</td>
               ";
        } else {
            // line 301
            echo "                  <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "thc", array()), "html", null, true);
            echo "</td>
                  <td class=\"success\">OK</td>
               ";
        }
        // line 304
        echo "               
            </tr>
         <tr>
            <td>Tasa Aduanera</td>
            ";
        // line 308
        if (($this->getAttribute(($context["minimal"] ?? null), "tasa_aduanera", array()) == false)) {
            // line 309
            echo "            <td> No Registrado</td>
            <td class=\"danger\">Registrar</td>
            ";
        } else {
            // line 312
            echo "            <td>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["minimal"] ?? null), "tasa_aduanera", array()), "html", null, true);
            echo "</td>
            <td class=\"success\">OK</td>
            ";
        }
        // line 315
        echo "         </tr>
         </tbody>
      </table>
     
   </div>
   <div class=\"col-md-2\">
&nbsp;
   </div>
</div>
";
        // line 324
        if (($this->getAttribute(($context["minimal"] ?? null), "complete", array()) == true)) {
            // line 325
            echo "
<div class=\"row\">
   <div class=\"col-md-2\">&nbsp;</div>
   <div class=\"col-md-8\">
      <a href=\"";
            // line 329
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "factinformativa/nuevo/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "\" class=\" btn btn-sm btn-primary\" style=\"width: 100%;\">
        <span class=\"fa fa-file fa-fw\"></span>  Nueva factura Informativa
      </a>
   </div>
   <div class=\"col-md-2\">&nbsp;</div>
</div>
<br>
";
        }
        // line 337
        echo "<div id=\"detalles\">
   <div class=\"row\">
      <div class=\"col-md-12\">
         <div class=\"panel-group\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
            <div class=\"panel panel-default\">
               <div class=\"panel-heading\" role=\"tab\" id=\"headingne\">
                  <h4 class=\"panel-title\">
                     <a role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\" aria-expanded=\"true\" aria-controls=\"collapseOne\">
                     Gastos Iniciales Registrados
                     </a>
                  </h4>
               </div>
               <div id=\"collapseOne\" class=\"panel-collapse collapse in\" role=\"tabpanel\" aria-labelledby=\"headingOne\">
                  <div class=\"panel-body\">
                     ";
        // line 351
        if (($this->getAttribute(($context["order"] ?? null), "bg_haveExpenses", array()) == 0)) {
            // line 352
            echo "                     ";
            if ((($context["initExpenses"] ?? null) == false)) {
                // line 353
                echo "                     <div class=\"text-danger\">
                        Debe Registrar Al Menos Estas Proviciones
                        <ul>
                           <li>Flete</li>
                           <li>Gastos En Origen</li>
                        </ul>
                        <br>
                        Para realizar el registro vaya a la sección (última sección)
                        <strong>
                        Tarifas Que Pueden ser aplicadas a este Pedido
                        </strong>
                     </div>
                     <div class=\"panel-body\">
                        ";
            } else {
                // line 367
                echo "                        <div class=\"panel-heading\">
                           <b>Provisiones Iniciales Registradas </b>
                        </div>
                        <div class=\"panel-body\">
                           ";
            }
            // line 371
            echo " 
                           <table class=\"table table-hover table-condensed table-striped\">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Concepto</th>
                                    <th>Proveedor</th>
                                    <th>Comentarios</th>
                                    <th>Fecha</th>
                                    <th>Valor</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 ";
            // line 384
            $context["sumInitialExpenses"] = 0;
            // line 385
            echo "                                 ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["initExpenses"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["initExpense"]) {
                echo "            
                                 ";
                // line 386
                $context["sumInitialExpenses"] = (($context["sumInitialExpenses"] ?? null) + $this->getAttribute($context["initExpense"], "valor_provisionado", array()));
                // line 387
                echo "                                 <tr>
                                    <td>";
                // line 388
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "</td>
                                    <td>
                                       <a href=\"";
                // line 390
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "gstinicial/presentar/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "id_gastos_nacionalizacion", array()), "html", null, true);
                echo "\">
                                       ";
                // line 391
                echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "concepto", array()), "html", null, true);
                echo "
                                       </a>
                                    </td>
                                    <td>";
                // line 394
                echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "nombre", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 395
                echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "comentarios", array()), "html", null, true);
                echo "</td>
                                    <td>";
                // line 396
                echo twig_escape_filter($this->env, $this->getAttribute($context["initExpense"], "fecha", array()), "html", null, true);
                echo "</td>
                                    <td class=\"text-right\">\$ ";
                // line 397
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["initExpense"], "valor_provisionado", array()), 2, ".", ","), "html", null, true);
                echo "</td>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['initExpense'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 400
            echo "                                 <tr class=\"total-row\">
                                    <td colspan=\"4\">
                                       <strong>
                                       Total Provisiones Gastos Iniciales:
                                       </strong>
                                    </td>
                                    <td colspan=\"2\" class=\"text-center\">
                                       <strong> \$ 
                                       ";
            // line 408
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["sumInitialExpenses"] ?? null), 2, ".", ","), "html", null, true);
            echo "
                                       </strong>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               
                  
               
               <div class=\"panel panel-default\">
                  <div class=\"panel-heading\" role=\"tab\" id=\"headingTwo\">
                     <h4 class=\"panel-title\">
                        <a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTwo\" aria-expanded=\"false\" aria-controls=\"collapseTwo\">
                        Ordenes De Compra Registradas
                        <small>Facturas Proveedor(es) Extranjero(s)</small>
                        </a>
                     </h4>
                  </div>
                  <div id=\"collapseTwo\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingTwo\">
                     ";
            // line 431
            if ((($context["invoicesOrder"] ?? null) == false)) {
                // line 432
                echo "                     <div class=\"panel-body\">
                        <div>
                           <p class=\"text-danger\">
                              Debe Al Menos Registrar Una Factura De Produtos
                           </p>
                           <br>
                           <p>
                              <br>
                              <a href=\"";
                // line 440
                echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                echo "pedidofactura/nuevo/";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
                echo "\">
                              <button class=\"btn btn-sm btn-default\">
                              <span class=\"fa fa-plus fa-fw\"> </span>
                              Agregar Factura Productos
                              </button>
                        </div>
                        </a>
                        </p>
                     </div>
                     ";
            }
            // line 450
            echo "                     <div class=\"panel-body\">
                        <hr>
                        <small class=\"text-primary\">
                        FACTURAS EN DÓLARES
                        </small>
                        <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Proveedor</th>
                                 <th>Fecha</th>
                                 <th>Cajas</th>
                                 <th>Valor Reg</th>
                                 <th>Valor Fac</th>
                                 <th>Estado</th>
                              </tr>
                           </thead>
                           <tbody>
                              ";
            // line 468
            $context["sumOrderExpenses"] = 0;
            // line 469
            echo "                              ";
            $context["sumOrderExpensesSum"] = 0;
            // line 470
            echo "                              ";
            $context["totalboxes"] = 0;
            // line 471
            echo "                              ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["invoicesOrder"] ?? null));
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
                // line 472
                echo "                              ";
                if (($this->getAttribute($context["invoice"], "moneda", array()) != "EUROS")) {
                    // line 473
                    echo "                              ";
                    $context["sumOrderExpenses"] = (($context["sumOrderExpenses"] ?? null) + $this->getAttribute($context["invoice"], "valor", array()));
                    // line 474
                    echo "                              <tr>
                                 <td>";
                    // line 475
                    echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                    echo "</td>
                                 <td>
                                    <a href=\"";
                    // line 477
                    echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                    echo "pedidofactura/presentar/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_pedido_factura", array()), "html", null, true);
                    echo "\">
                                    ";
                    // line 478
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["invoice"], "supplier", array()), "nombre", array()), "html", null, true);
                    echo "
                                    </a>
                                 </td>
                                 <td>";
                    // line 481
                    echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "fecha_emision", array()), "html", null, true);
                    echo "</td>

                                 <td>";
                    // line 483
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "countBoxesProduct", array()), 0, ",", "."), "html", null, true);
                    echo "</td>

                                 ";
                    // line 485
                    $context["totalboxes"] = (($context["totalboxes"] ?? null) + $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "countBoxesProduct", array()));
                    // line 486
                    echo "                                 ";
                    $context["valRegister"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array());
                    // line 487
                    echo "                                 
                                 <td class=\"text-right\">\$ ";
                    // line 488
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array()), 2, ",", "."), "html", null, true);
                    echo "</td>
                                 <td class=\"text-right\" >\$ ";
                    // line 489
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["invoice"], "valor", array()), 2, ",", "."), "html", null, true);
                    echo "</td>
                                 ";
                    // line 490
                    if ((($context["valRegister"] ?? null) == $this->getAttribute($context["invoice"], "valor", array()))) {
                        // line 491
                        echo "                                    <td class=\"success text-right\"> 
                                       Completa
                                    </td>
                                    ";
                    } else {
                        // line 495
                        echo "                                       <td class=\"danger text-right\"> 
                                          <a href=\"";
                        // line 496
                        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                        echo "pedidofactura/presentar/";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_pedido_factura", array()), "html", null, true);
                        echo "\">
                                       Revisar
                                          </a>
                                    </td>
                                 ";
                    }
                    // line 501
                    echo "                              </tr>
                              ";
                }
                // line 503
                echo "                              ";
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
            // line 504
            echo "                              <tr class=\"total-row\">
                                 <td colspan=\"3\">
                                    <strong>
                                    Total Facturas Producto CAJAS/(DOLARES):
                                    </strong>
                                 </td>
                                 <td>
                                    <strong>
                                    ";
            // line 512
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["totalboxes"] ?? null), 0, ",", "."), "html", null, true);
            echo "
                                    </strong>
                                 </td>
                                 <td class=\"text-right\">
                                    &nbsp;
                                 </td>
                                 <td  class=\"text-right\">
                                    <strong> \$ 
                                    ";
            // line 520
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["sumOrderExpenses"] ?? null), 2, ".", ","), "html", null, true);
            echo "
                                    </strong>
                                 </td>
                                 <td>
                                    &nbsp;
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <hr>
                        <small class=\"text-primary\">
                        FACTURAS EN EUROS
                        </small>
                         <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Proveedor</th>
                                 <th>Fecha</th>
                                 <th>Cajas</th>
                                 <th>Valor Reg</th>
                                 <th>Valor Fac</th>
                                 <th>Estado</th>
                              </tr>
                           </thead>
                          <tbody>
                              ";
            // line 546
            $context["sumOrderExpenses"] = 0;
            // line 547
            echo "                              ";
            $context["sumOrderExpensesSum"] = 0;
            // line 548
            echo "                              ";
            $context["totalboxes"] = 0;
            // line 549
            echo "                              ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["invoicesOrder"] ?? null));
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
                // line 550
                echo "                              ";
                if (($this->getAttribute($context["invoice"], "moneda", array()) == "EUROS")) {
                    // line 551
                    echo "                              ";
                    $context["sumOrderExpenses"] = (($context["sumOrderExpenses"] ?? null) + $this->getAttribute($context["invoice"], "valor", array()));
                    // line 552
                    echo "                              <tr>
                                 <td>";
                    // line 553
                    echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                    echo "</td>
                                 <td>
                                    <a href=\"";
                    // line 555
                    echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                    echo "pedidofactura/presentar/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_pedido_factura", array()), "html", null, true);
                    echo "\">
                                    ";
                    // line 556
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["invoice"], "supplier", array()), "nombre", array()), "html", null, true);
                    echo "
                                    </a>
                                 </td>
                                 <td>";
                    // line 559
                    echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "fecha_emision", array()), "html", null, true);
                    echo "</td>

                                 <td>";
                    // line 561
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "countBoxesProduct", array()), 0, ",", "."), "html", null, true);
                    echo "</td>

                                 ";
                    // line 563
                    $context["totalboxes"] = (($context["totalboxes"] ?? null) + $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "countBoxesProduct", array()));
                    // line 564
                    echo "                                 ";
                    $context["valRegister"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array());
                    // line 565
                    echo "                                 
                                 <td class=\"text-right\">&euro; ";
                    // line 566
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["invoice"], "detailInvoice", array()), "sums", array()), "valueItems", array()), 2, ",", "."), "html", null, true);
                    echo "</td>
                                 <td class=\"text-right\" >&euro; ";
                    // line 567
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["invoice"], "valor", array()), 2, ",", "."), "html", null, true);
                    echo "</td>
                                 ";
                    // line 568
                    if ((($context["valRegister"] ?? null) == $this->getAttribute($context["invoice"], "valor", array()))) {
                        // line 569
                        echo "                                    <td class=\"success text-right\"> 
                                       Completa
                                    </td>
                                    ";
                    } else {
                        // line 573
                        echo "                                       <td class=\"danger text-right\"> 
                                          <a href=\"";
                        // line 574
                        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
                        echo "pedidofactura/presentar/";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "id_pedido_factura", array()), "html", null, true);
                        echo "\">
                                       Revisar
                                          </a>
                                    </td>
                                 ";
                    }
                    // line 579
                    echo "                              </tr>
                              ";
                }
                // line 581
                echo "                              ";
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
            // line 582
            echo "                              <tr class=\"total-row\">
                                 <td colspan=\"3\">
                                    <strong>
                                    Total Facturas Producto CAJAS/(EUROS):
                                    </strong>
                                 </td>
                                 <td>
                                    <strong>
                                    ";
            // line 590
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["totalboxes"] ?? null), 0, ",", "."), "html", null, true);
            echo "
                                    </strong>
                                 </td>
                                 <td class=\"text-right\">
                                    &nbsp;
                                 </td>
                                 <td  class=\"text-right\">
                                    <strong> &euro; 
                                    ";
            // line 598
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["sumOrderExpenses"] ?? null), 2, ".", ","), "html", null, true);
            echo "
                                    </strong>
                                 </td>
                                 <td>
                                    &nbsp;
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"panel panel-default\">
            <div class=\"panel-heading\" role=\"tab\" id=\"headingThree\">
               <h4 class=\"panel-title\">
                  <a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseThree\" aria-expanded=\"false\" aria-controls=\"collapseThree\">
                  Tarifas Que Pueden ser aplicadas a este Pedido
                  </a>
               </h4>
            </div>
            <div id=\"collapseThree\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingThree\">
               <div class=\"panel-body\">
                  <div class=\"panel panel-default\">
                     <div class=\"panel-heading\" style=\"background-color: #efefef;\">
                        Incoterms Aplicables
                     </div>
                     <div class=\"panel-body\">
                        <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Incoterm</th>
                                 <th>Pais Origen</th>
                                 <th>Ciudad Origen</th>
                                 <th>Concepto</th>
                                 <th>Comentarios</th>
                                 <th>Valor</th>
                              </tr>
                           </thead>
                           <tbody>
                              ";
            // line 640
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["incoterms"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["incoterm"]) {
                // line 641
                echo "                              <tr>
                                 <td>";
                // line 642
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "</td>
                                 <td>";
                // line 643
                echo twig_escape_filter($this->env, $this->getAttribute($context["incoterm"], "incoterms", array()), "html", null, true);
                echo "</td>
                                 <td>";
                // line 644
                echo twig_escape_filter($this->env, $this->getAttribute($context["incoterm"], "pais", array()), "html", null, true);
                echo "</td>
                                 <td>";
                // line 645
                echo twig_escape_filter($this->env, $this->getAttribute($context["incoterm"], "ciudad", array()), "html", null, true);
                echo "</td>
                                 <td>";
                // line 646
                echo twig_escape_filter($this->env, $this->getAttribute($context["incoterm"], "tipo", array()), "html", null, true);
                echo "</td>
                                 <td>";
                // line 647
                echo twig_escape_filter($this->env, $this->getAttribute($context["incoterm"], "comentarios", array()), "html", null, true);
                echo "</td>
                                 <td class=\"text-right\">\$ ";
                // line 648
                echo twig_escape_filter($this->env, $this->getAttribute($context["incoterm"], "tarifa", array()), "html", null, true);
                echo "</td>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['incoterm'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 651
            echo "                           </tbody>
                        </table>
                        <br>
                        <div class=\"row\">
                           <div class=\"col-sm-3\">
                              <a href=\"";
            // line 656
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/replaceIncoterms/";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "\" class=\"btn btn-default btn-sm\">
                              <span class=\"fa fa-warning fa-fw text-danger\"> </span>
                              Aplicar Provisiones Incoterms
                              </a>           
                           </div>
                           <div class=\"col-sm-8\">
                              <span class=\"text-danger\"> 
                              <span class=\"fa fa-warning fa-fw\"> </span>
                              Los valores correspondientes al <strong>FLETE</strong> y <strong>GASTOS EN ORIGEN</strong> serán actualizados acordes a los valores mostrados
                              en la presente tabla, de existir valores anteriores, serán reemplazados.
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class=\"panel panel-default\">
                     <div class=\"panel-heading\" style=\"background-color: #efefef;\">
                        Gastos Iniciales Aplicables
                     </div>
                     <div class=\"panel-body\">
                        <form action=\"";
            // line 676
            echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
            echo "gstinicial/putInitialExpenses/\" method=\"post\">
                           <input type=\"hidden\" name=\"nro_pedido\" value=\"";
            // line 677
            echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
            echo "\">
                        <table class=\"table  table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Concepto</th>
                                 <th>Proveedor</th>
                                 <th>Valor</th>
                                 <th>Prcentaje</th>
                                 <th>Seleccionar</th>
                              </tr>
                           </thead>
                           <tbody>
                              ";
            // line 690
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["rateExpenses"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["rateExpense"]) {
                // line 691
                echo "                              ";
                if (($this->getAttribute($context["rateExpense"], "concepto", array()) != "ISD")) {
                    // line 692
                    echo "                              ";
                    if (($this->getAttribute($context["rateExpense"], "concepto", array()) != "SEGURO")) {
                        // line 693
                        echo "                              
                              <tr>
                                 <td>";
                        // line 695
                        echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                        echo "</td>
                                 <td>";
                        // line 696
                        echo twig_escape_filter($this->env, $this->getAttribute($context["rateExpense"], "concepto", array()), "html", null, true);
                        echo "</td>
                                 <td>";
                        // line 697
                        echo twig_escape_filter($this->env, $this->getAttribute($context["rateExpense"], "nombre", array()), "html", null, true);
                        echo "</td>
                                 <td>";
                        // line 698
                        echo twig_escape_filter($this->env, $this->getAttribute($context["rateExpense"], "valor", array()), "html", null, true);
                        echo "</td>
                                 <td>";
                        // line 699
                        echo twig_escape_filter($this->env, $this->getAttribute($context["rateExpense"], "porcentaje", array()), "html", null, true);
                        echo "</td>
                                 <td class=\"text-center\">
                                    <input
                                    type=\"radio\" 
                                    name=\"";
                        // line 703
                        echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute($context["rateExpense"], "concepto", array()), array(" " => "")), "html", null, true);
                        echo "\" 
                                    value=\"";
                        // line 704
                        echo twig_escape_filter($this->env, $this->getAttribute($context["rateExpense"], "id_tarifa_gastos", array()), "html", null, true);
                        echo "\"
                                    class=\"form-control\" 
                                    >
                                    
                                 </td>
                              </tr>
                                    ";
                    }
                    // line 711
                    echo "                                    ";
                }
                // line 712
                echo "                              ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rateExpense'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 713
            echo "                           </tbody>
                        </table>
                        <div class=\"row\">
                           <div class=\"col-md-4\">
                              <span class=\"fa fa-warnign fa-fw\"></span>
                              <button
                                    type= \"submit\"
                                    class=\"btn btn-default btn-sm\"
                                    >
                                    <span class=\"fa fa-warning fa-fw\"></span>
                                    Aplicar Gastos Iniciales
                                    </button>
                              </a>
                           </div>
                           <div class=\"col-sm-8\">
              &nbsp;
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
";
        } else {
            // line 742
            echo "<div class=\"row\">
   <div class=\"col-sm-1\">&nbsp;</div>
   <div class=\"col-sm-3\">
      <span class=\"fa fa-warning fa-fw fa-5x\"></span>    
   </div>
   <div class=\"col-sm-8\">
      <p class=\"text-success\">
         <b>NO SE PUEDE REALIZAR CAMBIOS</b>
         <br>
         ESTE PEDIDO TIENE LAS PROVICIONES INICIALES FINALIZADAS Y CERRADAS.
      </p>
      <p>
         <small>
         En Caso de requerir realizar cambios en este registro por favor comuníquese con el departamento de sistemas 
         <br>
         <strong>
         Tipo Solicitud:
         </strong>
         Gastos Iniciales  <strong>Código:</strong> 
         <span class=\"text-primary\">bg_haveExpenses</span>
         </small>
      </p>
   </div>
</div>
";
        }
        // line 767
        echo "<div class=\"row\">
   <div class=\"col-sm-12\">
      <br>
      <p>
         <a href=\"";
        // line 771
        echo twig_escape_filter($this->env, ($context["rute_url"] ?? null), "html", null, true);
        echo "pedido/presentar/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "\" class=\"btn btn-default btn-sm\">
         <span class=\"fa fa-arrow-left fa-fw\"></span>
         Volver Al Pedido [";
        // line 773
        echo twig_escape_filter($this->env, $this->getAttribute(($context["order"] ?? null), "nro_pedido", array()), "html", null, true);
        echo "]
         </a>
      </p>
   </div>
</div>";
    }

    public function getTemplateName()
    {
        return "sections/validar-pedido.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1449 => 773,  1442 => 771,  1436 => 767,  1409 => 742,  1378 => 713,  1364 => 712,  1361 => 711,  1351 => 704,  1347 => 703,  1340 => 699,  1336 => 698,  1332 => 697,  1328 => 696,  1324 => 695,  1320 => 693,  1317 => 692,  1314 => 691,  1297 => 690,  1281 => 677,  1277 => 676,  1252 => 656,  1245 => 651,  1228 => 648,  1224 => 647,  1220 => 646,  1216 => 645,  1212 => 644,  1208 => 643,  1204 => 642,  1201 => 641,  1184 => 640,  1139 => 598,  1128 => 590,  1118 => 582,  1104 => 581,  1100 => 579,  1090 => 574,  1087 => 573,  1081 => 569,  1079 => 568,  1075 => 567,  1071 => 566,  1068 => 565,  1065 => 564,  1063 => 563,  1058 => 561,  1053 => 559,  1047 => 556,  1041 => 555,  1036 => 553,  1033 => 552,  1030 => 551,  1027 => 550,  1009 => 549,  1006 => 548,  1003 => 547,  1001 => 546,  972 => 520,  961 => 512,  951 => 504,  937 => 503,  933 => 501,  923 => 496,  920 => 495,  914 => 491,  912 => 490,  908 => 489,  904 => 488,  901 => 487,  898 => 486,  896 => 485,  891 => 483,  886 => 481,  880 => 478,  874 => 477,  869 => 475,  866 => 474,  863 => 473,  860 => 472,  842 => 471,  839 => 470,  836 => 469,  834 => 468,  814 => 450,  799 => 440,  789 => 432,  787 => 431,  761 => 408,  751 => 400,  734 => 397,  730 => 396,  726 => 395,  722 => 394,  716 => 391,  710 => 390,  705 => 388,  702 => 387,  700 => 386,  680 => 385,  678 => 384,  663 => 371,  656 => 367,  640 => 353,  637 => 352,  635 => 351,  619 => 337,  606 => 329,  600 => 325,  598 => 324,  587 => 315,  580 => 312,  575 => 309,  573 => 308,  567 => 304,  560 => 301,  555 => 298,  553 => 297,  548 => 294,  541 => 291,  536 => 288,  534 => 287,  529 => 284,  522 => 281,  517 => 278,  515 => 277,  510 => 274,  503 => 271,  498 => 268,  496 => 267,  491 => 264,  484 => 261,  479 => 258,  477 => 257,  472 => 254,  465 => 251,  460 => 248,  458 => 247,  453 => 244,  446 => 241,  441 => 238,  439 => 237,  434 => 234,  427 => 231,  422 => 228,  420 => 227,  415 => 224,  408 => 221,  403 => 218,  401 => 217,  396 => 214,  389 => 211,  384 => 208,  382 => 207,  377 => 204,  370 => 201,  365 => 198,  363 => 197,  357 => 193,  350 => 190,  345 => 187,  343 => 186,  338 => 183,  331 => 180,  326 => 177,  324 => 176,  319 => 173,  312 => 170,  302 => 165,  298 => 163,  296 => 162,  291 => 159,  284 => 155,  281 => 154,  271 => 149,  267 => 147,  265 => 146,  260 => 143,  257 => 142,  250 => 139,  240 => 134,  236 => 132,  233 => 131,  223 => 126,  219 => 124,  217 => 123,  213 => 122,  209 => 120,  204 => 117,  201 => 116,  194 => 113,  184 => 108,  180 => 106,  177 => 105,  175 => 104,  170 => 101,  165 => 98,  160 => 95,  153 => 93,  143 => 88,  139 => 86,  136 => 85,  134 => 84,  119 => 72,  112 => 67,  110 => 66,  99 => 58,  91 => 53,  82 => 47,  73 => 41,  59 => 30,  48 => 22,  37 => 14,  27 => 7,  19 => 1,);
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
      <div class=\"col-sm-3\">
         <strong>Valor FOB Total:</strong> 
         <span class=\"fa fa-usd\">/</span>
         <strong class=\"text-primary\">
         {{fob | number_format(2, '.', ',') }}      
         </strong>  
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Nro Pedido:</strong> 
         <span class=\"text-primary\">
         {{ order.nro_pedido }}
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Regimen:</strong> 
         <span class=\"text-primary\">
         <strong class=\"text-primary\">
         {{ order.regimen  }}
         </strong>   
         </span>
      </div>
      <div class=\"col-sm-3\">
         <strong>
         Fecha Registro:</strong> 
         <span class=\"text-primary\">
         {{ order.date_create }}            
         </span>
      </div>
   </div>
   <div class=\"row\">
      <div class=\"col-sm-3\">
         <strong>Tiempo Bodega:</strong> 
      </div>
      <div class=\"col-sm-2\">
         <strong>P. Origen:</strong> 
         <span class=\"text-primary\">
         {{ order.pais_origen }}
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>C Origen:</strong> 
         <span class=\"text-primary\">
         {{ order.ciudad_origen  }}            
         </span>
      </div>
      <div class=\"col-sm-2\">
         <strong>Incoterm:</strong> 
         <span class=\"text-primary\">
         {{order.incoterm}}
         </span>         
      </div>
      <div class=\"col-sm-2\">
         <strong>Creado Por:</strong> 
         <span>{{createBy[0]['nombres']}}
         </span>
      </div>
   </div>
</div>
<div class=\"row\">
   <div class=\"col-md-2\">&nbsp;</div>
   <div class=\"col-md-8\">
      {% set invoicesStatus = true %}
      <table  class=\"table table-hover table-condensed table-striped table-bordered\">
         <thead>
            <tr style=\"background-color: #333; color: #fff;\">
               <th colspan=\"3\" class=\"text-center\">
                  RESUMEN DE ESTADO GASTOS INICIALES PEDIDO 
                  [{{order.nro_pedido}}]
               </th>
            </tr>
         </thead>
         <tbody>
            <tr style=\"background-color: #fff;\">
               <th class=\"text-center\">CONCEPTO</th>
               <th class=\"text-center\">VALOR</th>
               <th class=\"text-center\">ESTADO</th>
            </tr>
            <tr>
               <td>Gastos Origen</td>
               {% if minimal.have_gasto_origen == true %}
               {% if minimal.gasto_origen == false %}
               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"{{rute_url}}gstinicial/nuevo/{{order.nro_pedido}}\">
                  Registrar                        
                  </a>
               </td>
               {% else %}
               <td>{{minimal.gasto_origen | number_format(2,',','.')}}</td>
               <td class=\"success\" >OK</td>
               {% endif %}               
               </td>   
               {% else %}
               <td class=\"success\" >No requerido</td>
               <td class=\"success\" >OK</td>
               {% endif %}
            </tr>
            <tr>
               <td>Felte Internacional</td>
               {% if minimal.have_flete == true %}
               {% if minimal.flete == false %}
               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"{{rute_url}}gstinicial/nuevo/{{order.nro_pedido}}\">
                  Registrar                        
                  </a>
               </td>
               {% else %}
               <td>{{ minimal.flete | number_format(2,',','.') }}</td>
               <td class=\"success\"> OK </td>
               {% endif %}
               {% else %}
               <td>No requerido</td>
               <td class=\"success\" >OK</td>
               {% endif %}
            </tr>
            <tr>
               <td>Facturas Producto  <strong>{{order.nro_pedido}}</strong> Proveedor Internacional</td>
               {% if invoicesOrder == false %}
               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"{{rute_url}}pedidofactura/nuevo/{{order.nro_pedido}}/\">
                  Registrar 
                  </a>
               </td>
               {% else %}
               {% if minimal.total_pedido == false %}
               <td>Inconsistencias</td>   
               <td class=\"danger\">
                  <a href=\"{{rute_url}}pedido/presentar/{{order.nro_pedido}}\">
                     Validar                     
                  </a>
                  </td>
               {% else %}
               <td>{{ minimal.total_pedido | number_format(2,',','.') }}</td>   
               <td class=\"success\">OK</td>
               {% endif %}
               {% endif %}
            </tr>
            <tr>
               <td>Fecha Arribo</td>
               {% if minimal.fecha_arribo == false %}
               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"{{rute_url}}pedido/editar/{{order.nro_pedido}}\">
                     Registrar                     
                  </a>
                  </td>
               {% else %}
               <td>
               {{minimal.fecha_arribo}}
            </td>
               <td class=\"success\">OK</td>
               {% endif %}
            </tr>
            <tr>
               <td>Días Libres Demoraje </td>
               {% if minimal.dias_libres == false %}
               <td>No Registrado</td>
               <td class=\"danger\">
                  <a href=\"{{rute_url}}pedido/editar/{{order.nro_pedido}}\">
                     Registrar                     
                  </a>
                  </td>
               {% else %}
               <td> {{minimal.dias_libres | raw}}</td>
               <td class=\"success\">OK</td>
               {% endif %}
            </tr>
            <tr>
               <td>Almacenaje Inicial</td>
               {% if minimal.almacenaje_inicial == false %}
                  <td>No Registrado</td>
                  <td class=\"danger\"> Registrar</td>
               {% else %}
                  <td>{{ minimal.almacenaje_inicial }}</td>
                  <td class=\"success\">OK</td>
               {% endif %}
            </tr>
            <tr>
               <td>Agente Inicial</td>
                  {% if minimal.agente_inicial == false %}
                     <td>No Registrado</td>
                     <td class=\"danger\"> Registrar</td>
                  {% else %}
                     <td>{{minimal.agente_inicial}}</td>
                     <td class=\"success\">OK</td>
                  {% endif %}

            </tr>
             <tr>
               <td>Almacenaje Inicial</td>
               {% if minimal.almacenaje_inicial == false %}
               <td>No Registrado</td>
               <td class=\"danger\"> Registrar</td>
               {% else %}
               <td>{{minimal.almacenaje_inicial}}</td>
               <td class=\"success\">OK</td>
               {% endif %}
            </tr>
         <tr>
            <td>Candado Satelital</td>
            {% if minimal.candado_satelital == false %}
            <td>No Registrado</td>
            <td class=\"danger\">Registdar</td>
            {% else %}
               <td>{{ minimal.candado_satelital }}</td>
               <td class=\"success\"> OK </td>
            {% endif %}
         </tr>
         <tr>
            <td>Demoraje</td>
            {% if condition %}
            <td>No Registrado</td>
            <td class=\"danger\">Registrar</td>
            {% else %}
            <td> {{minimal.demoraje}}</td>
            <td class=\"success\"> OK </td>
            {% endif %}
         </tr>
         <tr>
               <td>Custodia Armada</td>
               {% if  minimal.custodia_armada == false %}
                  <td>No Registrado</td>
                   <td class=\"danger\"> Registrar</td>
               {% else %}
                  <td>{{minimal.custodia_armada}}</td>
                  <td class=\"success\">OK</td>
               {% endif %}
            </tr>
            <tr>
               <td>Gastos Locales</td>
               {% if minimal.gastos_locales == false %}
               <td>No Registrado</td>
               <td class=\"danger\"> Registrar</td>
               {% else %}
               <td>{{minimal.gastos_locales}}</td>
               <td class=\"success\">OK</td>
               {% endif %}
            </tr>
         <tr>
               <td>Descarga</td>
               {% if minimal.descarga == false %}
               <td>No Registrado</td>
               <td class=\"danger\"> Registrar</td>
               {% else %}
               <td>{{minimal.descarga}}</td>
               <td class=\"success\">OK</td>
               {% endif %}
            </tr>
            <tr>
               <td>ISD</td>
               {% if minimal.isd == false %}
                  <td>No Registrado</td>
                  <td class=\"danger\">Registrar</td>   
               {% else %}
                  <td>{{ minimal.isd }}</td>
                  <td class=\"success\">OK</td>
               {% endif %}
            </tr>
                        <tr>
               <td>Mano de Obra</td>
               {% if minimal.mano_obra == false %}
                  <td>No Registrado</td>
                  <td class=\"danger\">Registrar</td>   
               {% else %}
                  <td>{{ minimal.mano_obra }}</td>
                  <td class=\"success\">OK</td>
               {% endif %}
            </tr>
            <tr>
               <td>Seguro</td>
               {% if minimal.seguro ==false %}
               <td>No Registrado</td>
               <td class=\"danger\">Registrar</td>   
               {% else %}
               <td>{{minimal.seguro}}</td>
               <td class=\"success\">Ok</td>
               {% endif %}
            </tr>
            <tr>
               <td>Transporte Interno</td>
               {% if minimal.transporte_interno == false%}
               <td>No Registrado</td>
               <td class=\"danger\"> Registrar</td>
               {% else %}
                  <td>{{minimal.transporte_interno}}</td>
                  <td class=\"success\">OK</td>
               {% endif %}
            </tr>
            <tr>
               <td>THC</td>
               {% if minimal.thc == false %}
               <td>No Registrado</td>
               <td class=\"danger\">Registrar</td>
               {% else %}
                  <td>{{ minimal.thc }}</td>
                  <td class=\"success\">OK</td>
               {% endif %}
               
            </tr>
         <tr>
            <td>Tasa Aduanera</td>
            {% if minimal.tasa_aduanera == false %}
            <td> No Registrado</td>
            <td class=\"danger\">Registrar</td>
            {% else %}
            <td>{{ minimal. tasa_aduanera}}</td>
            <td class=\"success\">OK</td>
            {% endif %}
         </tr>
         </tbody>
      </table>
     
   </div>
   <div class=\"col-md-2\">
&nbsp;
   </div>
</div>
{% if minimal.complete == true %}

<div class=\"row\">
   <div class=\"col-md-2\">&nbsp;</div>
   <div class=\"col-md-8\">
      <a href=\"{{rute_url}}factinformativa/nuevo/{{order.nro_pedido}}\" class=\" btn btn-sm btn-primary\" style=\"width: 100%;\">
        <span class=\"fa fa-file fa-fw\"></span>  Nueva factura Informativa
      </a>
   </div>
   <div class=\"col-md-2\">&nbsp;</div>
</div>
<br>
{% endif %}
<div id=\"detalles\">
   <div class=\"row\">
      <div class=\"col-md-12\">
         <div class=\"panel-group\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
            <div class=\"panel panel-default\">
               <div class=\"panel-heading\" role=\"tab\" id=\"headingne\">
                  <h4 class=\"panel-title\">
                     <a role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\" aria-expanded=\"true\" aria-controls=\"collapseOne\">
                     Gastos Iniciales Registrados
                     </a>
                  </h4>
               </div>
               <div id=\"collapseOne\" class=\"panel-collapse collapse in\" role=\"tabpanel\" aria-labelledby=\"headingOne\">
                  <div class=\"panel-body\">
                     {% if order.bg_haveExpenses == 0 %}
                     {% if initExpenses == false %}
                     <div class=\"text-danger\">
                        Debe Registrar Al Menos Estas Proviciones
                        <ul>
                           <li>Flete</li>
                           <li>Gastos En Origen</li>
                        </ul>
                        <br>
                        Para realizar el registro vaya a la sección (última sección)
                        <strong>
                        Tarifas Que Pueden ser aplicadas a este Pedido
                        </strong>
                     </div>
                     <div class=\"panel-body\">
                        {% else %}
                        <div class=\"panel-heading\">
                           <b>Provisiones Iniciales Registradas </b>
                        </div>
                        <div class=\"panel-body\">
                           {% endif %} 
                           <table class=\"table table-hover table-condensed table-striped\">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Concepto</th>
                                    <th>Proveedor</th>
                                    <th>Comentarios</th>
                                    <th>Fecha</th>
                                    <th>Valor</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 {% set sumInitialExpenses = 0.0 %}
                                 {% for initExpense in initExpenses %}            
                                 {% set sumInitialExpenses = (sumInitialExpenses +  initExpense.valor_provisionado  ) %}
                                 <tr>
                                    <td>{{loop.index}}</td>
                                    <td>
                                       <a href=\"{{rute_url}}gstinicial/presentar/{{initExpense.id_gastos_nacionalizacion}}\">
                                       {{ initExpense.concepto }}
                                       </a>
                                    </td>
                                    <td>{{ initExpense.nombre }}</td>
                                    <td>{{ initExpense.comentarios }}</td>
                                    <td>{{ initExpense.fecha }}</td>
                                    <td class=\"text-right\">\$ {{ initExpense.valor_provisionado  |number_format(2, '.', ',')  }}</td>
                                 </tr>
                                 {% endfor %}
                                 <tr class=\"total-row\">
                                    <td colspan=\"4\">
                                       <strong>
                                       Total Provisiones Gastos Iniciales:
                                       </strong>
                                    </td>
                                    <td colspan=\"2\" class=\"text-center\">
                                       <strong> \$ 
                                       {{ sumInitialExpenses |number_format(2, '.', ',') }}
                                       </strong>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               
                  
               
               <div class=\"panel panel-default\">
                  <div class=\"panel-heading\" role=\"tab\" id=\"headingTwo\">
                     <h4 class=\"panel-title\">
                        <a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTwo\" aria-expanded=\"false\" aria-controls=\"collapseTwo\">
                        Ordenes De Compra Registradas
                        <small>Facturas Proveedor(es) Extranjero(s)</small>
                        </a>
                     </h4>
                  </div>
                  <div id=\"collapseTwo\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingTwo\">
                     {% if invoicesOrder == false %}
                     <div class=\"panel-body\">
                        <div>
                           <p class=\"text-danger\">
                              Debe Al Menos Registrar Una Factura De Produtos
                           </p>
                           <br>
                           <p>
                              <br>
                              <a href=\"{{rute_url}}pedidofactura/nuevo/{{order.nro_pedido}}\">
                              <button class=\"btn btn-sm btn-default\">
                              <span class=\"fa fa-plus fa-fw\"> </span>
                              Agregar Factura Productos
                              </button>
                        </div>
                        </a>
                        </p>
                     </div>
                     {% endif %}
                     <div class=\"panel-body\">
                        <hr>
                        <small class=\"text-primary\">
                        FACTURAS EN DÓLARES
                        </small>
                        <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Proveedor</th>
                                 <th>Fecha</th>
                                 <th>Cajas</th>
                                 <th>Valor Reg</th>
                                 <th>Valor Fac</th>
                                 <th>Estado</th>
                              </tr>
                           </thead>
                           <tbody>
                              {% set sumOrderExpenses = 0 %}
                              {% set sumOrderExpensesSum = 0 %}
                              {% set totalboxes = 0 %}
                              {% for invoice in invoicesOrder %}
                              {% if invoice.moneda != 'EUROS' %}
                              {% set sumOrderExpenses = sumOrderExpenses +  invoice.valor %}
                              <tr>
                                 <td>{{loop.index}}</td>
                                 <td>
                                    <a href=\"{{rute_url}}pedidofactura/presentar/{{invoice.id_pedido_factura}}\">
                                    {{invoice.supplier.nombre}}
                                    </a>
                                 </td>
                                 <td>{{invoice.fecha_emision}}</td>

                                 <td>{{invoice.detailInvoice.sums.countBoxesProduct | number_format(0,',','.') }}</td>

                                 {% set totalboxes = totalboxes +  invoice.detailInvoice.sums.countBoxesProduct %}
                                 {% set valRegister = invoice.detailInvoice.sums.valueItems %}
                                 
                                 <td class=\"text-right\">\$ {{invoice.detailInvoice.sums.valueItems | number_format(2,',','.') }}</td>
                                 <td class=\"text-right\" >\$ {{invoice.valor  | number_format(2,',','.') }}</td>
                                 {% if valRegister ==  invoice.valor%}
                                    <td class=\"success text-right\"> 
                                       Completa
                                    </td>
                                    {% else %}
                                       <td class=\"danger text-right\"> 
                                          <a href=\"{{rute_url}}pedidofactura/presentar/{{invoice.id_pedido_factura}}\">
                                       Revisar
                                          </a>
                                    </td>
                                 {% endif %}
                              </tr>
                              {% endif %}
                              {% endfor %}
                              <tr class=\"total-row\">
                                 <td colspan=\"3\">
                                    <strong>
                                    Total Facturas Producto CAJAS/(DOLARES):
                                    </strong>
                                 </td>
                                 <td>
                                    <strong>
                                    {{ totalboxes | number_format(0,',','.')}}
                                    </strong>
                                 </td>
                                 <td class=\"text-right\">
                                    &nbsp;
                                 </td>
                                 <td  class=\"text-right\">
                                    <strong> \$ 
                                    {{ sumOrderExpenses | number_format(2, '.', ',') }}
                                    </strong>
                                 </td>
                                 <td>
                                    &nbsp;
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <hr>
                        <small class=\"text-primary\">
                        FACTURAS EN EUROS
                        </small>
                         <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Proveedor</th>
                                 <th>Fecha</th>
                                 <th>Cajas</th>
                                 <th>Valor Reg</th>
                                 <th>Valor Fac</th>
                                 <th>Estado</th>
                              </tr>
                           </thead>
                          <tbody>
                              {% set sumOrderExpenses = 0 %}
                              {% set sumOrderExpensesSum = 0 %}
                              {% set totalboxes = 0 %}
                              {% for invoice in invoicesOrder %}
                              {% if invoice.moneda == 'EUROS' %}
                              {% set sumOrderExpenses = sumOrderExpenses +  invoice.valor %}
                              <tr>
                                 <td>{{loop.index}}</td>
                                 <td>
                                    <a href=\"{{rute_url}}pedidofactura/presentar/{{invoice.id_pedido_factura}}\">
                                    {{invoice.supplier.nombre}}
                                    </a>
                                 </td>
                                 <td>{{invoice.fecha_emision}}</td>

                                 <td>{{invoice.detailInvoice.sums.countBoxesProduct | number_format(0,',','.') }}</td>

                                 {% set totalboxes = totalboxes +  invoice.detailInvoice.sums.countBoxesProduct %}
                                 {% set valRegister = invoice.detailInvoice.sums.valueItems %}
                                 
                                 <td class=\"text-right\">&euro; {{invoice.detailInvoice.sums.valueItems | number_format(2,',','.') }}</td>
                                 <td class=\"text-right\" >&euro; {{invoice.valor  | number_format(2,',','.') }}</td>
                                 {% if valRegister ==  invoice.valor%}
                                    <td class=\"success text-right\"> 
                                       Completa
                                    </td>
                                    {% else %}
                                       <td class=\"danger text-right\"> 
                                          <a href=\"{{rute_url}}pedidofactura/presentar/{{invoice.id_pedido_factura}}\">
                                       Revisar
                                          </a>
                                    </td>
                                 {% endif %}
                              </tr>
                              {% endif %}
                              {% endfor %}
                              <tr class=\"total-row\">
                                 <td colspan=\"3\">
                                    <strong>
                                    Total Facturas Producto CAJAS/(EUROS):
                                    </strong>
                                 </td>
                                 <td>
                                    <strong>
                                    {{ totalboxes | number_format(0,',','.')}}
                                    </strong>
                                 </td>
                                 <td class=\"text-right\">
                                    &nbsp;
                                 </td>
                                 <td  class=\"text-right\">
                                    <strong> &euro; 
                                    {{ sumOrderExpenses | number_format(2, '.', ',') }}
                                    </strong>
                                 </td>
                                 <td>
                                    &nbsp;
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"panel panel-default\">
            <div class=\"panel-heading\" role=\"tab\" id=\"headingThree\">
               <h4 class=\"panel-title\">
                  <a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseThree\" aria-expanded=\"false\" aria-controls=\"collapseThree\">
                  Tarifas Que Pueden ser aplicadas a este Pedido
                  </a>
               </h4>
            </div>
            <div id=\"collapseThree\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingThree\">
               <div class=\"panel-body\">
                  <div class=\"panel panel-default\">
                     <div class=\"panel-heading\" style=\"background-color: #efefef;\">
                        Incoterms Aplicables
                     </div>
                     <div class=\"panel-body\">
                        <table class=\"table table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Incoterm</th>
                                 <th>Pais Origen</th>
                                 <th>Ciudad Origen</th>
                                 <th>Concepto</th>
                                 <th>Comentarios</th>
                                 <th>Valor</th>
                              </tr>
                           </thead>
                           <tbody>
                              {% for incoterm in incoterms %}
                              <tr>
                                 <td>{{loop.index}}</td>
                                 <td>{{incoterm.incoterms}}</td>
                                 <td>{{incoterm.pais}}</td>
                                 <td>{{incoterm.ciudad}}</td>
                                 <td>{{incoterm.tipo}}</td>
                                 <td>{{incoterm.comentarios}}</td>
                                 <td class=\"text-right\">\$ {{incoterm.tarifa}}</td>
                              </tr>
                              {% endfor %}
                           </tbody>
                        </table>
                        <br>
                        <div class=\"row\">
                           <div class=\"col-sm-3\">
                              <a href=\"{{rute_url}}gstinicial/replaceIncoterms/{{order.nro_pedido}}\" class=\"btn btn-default btn-sm\">
                              <span class=\"fa fa-warning fa-fw text-danger\"> </span>
                              Aplicar Provisiones Incoterms
                              </a>           
                           </div>
                           <div class=\"col-sm-8\">
                              <span class=\"text-danger\"> 
                              <span class=\"fa fa-warning fa-fw\"> </span>
                              Los valores correspondientes al <strong>FLETE</strong> y <strong>GASTOS EN ORIGEN</strong> serán actualizados acordes a los valores mostrados
                              en la presente tabla, de existir valores anteriores, serán reemplazados.
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class=\"panel panel-default\">
                     <div class=\"panel-heading\" style=\"background-color: #efefef;\">
                        Gastos Iniciales Aplicables
                     </div>
                     <div class=\"panel-body\">
                        <form action=\"{{rute_url}}gstinicial/putInitialExpenses/\" method=\"post\">
                           <input type=\"hidden\" name=\"nro_pedido\" value=\"{{order.nro_pedido}}\">
                        <table class=\"table  table-hover table-condensed table-striped\">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Concepto</th>
                                 <th>Proveedor</th>
                                 <th>Valor</th>
                                 <th>Prcentaje</th>
                                 <th>Seleccionar</th>
                              </tr>
                           </thead>
                           <tbody>
                              {% for rateExpense in rateExpenses %}
                              {% if (rateExpense.concepto != 'ISD') %}
                              {% if (rateExpense.concepto != 'SEGURO') %}
                              
                              <tr>
                                 <td>{{loop.index}}</td>
                                 <td>{{rateExpense.concepto}}</td>
                                 <td>{{rateExpense.nombre}}</td>
                                 <td>{{rateExpense.valor}}</td>
                                 <td>{{rateExpense.porcentaje}}</td>
                                 <td class=\"text-center\">
                                    <input
                                    type=\"radio\" 
                                    name=\"{{ rateExpense.concepto | replace({' ':''})}}\" 
                                    value=\"{{rateExpense.id_tarifa_gastos}}\"
                                    class=\"form-control\" 
                                    >
                                    
                                 </td>
                              </tr>
                                    {% endif %}
                                    {% endif %}
                              {% endfor %}
                           </tbody>
                        </table>
                        <div class=\"row\">
                           <div class=\"col-md-4\">
                              <span class=\"fa fa-warnign fa-fw\"></span>
                              <button
                                    type= \"submit\"
                                    class=\"btn btn-default btn-sm\"
                                    >
                                    <span class=\"fa fa-warning fa-fw\"></span>
                                    Aplicar Gastos Iniciales
                                    </button>
                              </a>
                           </div>
                           <div class=\"col-sm-8\">
              &nbsp;
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
{% else %}
<div class=\"row\">
   <div class=\"col-sm-1\">&nbsp;</div>
   <div class=\"col-sm-3\">
      <span class=\"fa fa-warning fa-fw fa-5x\"></span>    
   </div>
   <div class=\"col-sm-8\">
      <p class=\"text-success\">
         <b>NO SE PUEDE REALIZAR CAMBIOS</b>
         <br>
         ESTE PEDIDO TIENE LAS PROVICIONES INICIALES FINALIZADAS Y CERRADAS.
      </p>
      <p>
         <small>
         En Caso de requerir realizar cambios en este registro por favor comuníquese con el departamento de sistemas 
         <br>
         <strong>
         Tipo Solicitud:
         </strong>
         Gastos Iniciales  <strong>Código:</strong> 
         <span class=\"text-primary\">bg_haveExpenses</span>
         </small>
      </p>
   </div>
</div>
{% endif %}
<div class=\"row\">
   <div class=\"col-sm-12\">
      <br>
      <p>
         <a href=\"{{rute_url}}pedido/presentar/{{order.nro_pedido}}\" class=\"btn btn-default btn-sm\">
         <span class=\"fa fa-arrow-left fa-fw\"></span>
         Volver Al Pedido [{{order.nro_pedido}}]
         </a>
      </p>
   </div>
</div>", "sections/validar-pedido.html.twig", "/var/www/html/app/src/views/sections/validar-pedido.html.twig");
    }
}
