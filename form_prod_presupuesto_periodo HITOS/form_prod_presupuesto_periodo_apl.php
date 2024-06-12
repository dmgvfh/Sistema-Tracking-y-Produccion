<?php
//
class form_prod_presupuesto_periodo_apl
{
   var $has_where_params = false;
   var $NM_is_redirected = false;
   var $NM_non_ajax_info = false;
   var $formatado = false;
   var $use_100perc_fields = false;
   var $classes_100perc_fields = array();
   var $close_modal_after_insert = false;
   var $NM_ajax_flag    = false;
   var $NM_ajax_opcao   = '';
   var $NM_ajax_retorno = '';
   var $NM_ajax_info    = array('result'            => '',
                                'param'             => array(),
                                'autoComp'          => '',
                                'rsSize'            => '',
                                'msgDisplay'        => '',
                                'errList'           => array(),
                                'fldList'           => array(),
                                'varList'           => array(),
                                'focus'             => '',
                                'navStatus'         => array(),
                                'navSummary'        => array(),
                                'navPage'           => array(),
                                'redir'             => array(),
                                'blockDisplay'      => array(),
                                'fieldDisplay'      => array(),
                                'fieldLabel'        => array(),
                                'readOnly'          => array(),
                                'btnVars'           => array(),
                                'ajaxAlert'         => array(),
                                'ajaxMessage'       => array(),
                                'ajaxJavascript'    => array(),
                                'buttonDisplay'     => array(),
                                'buttonDisplayVert' => array(),
                                'calendarReload'    => false,
                                'quickSearchRes'    => false,
                                'displayMsg'        => false,
                                'displayMsgTxt'     => '',
                                'dyn_search'        => array(),
                                'empty_filter'      => '',
                                'event_field'       => '',
                                'fieldsWithErrors'  => array(),
                               );
   var $NM_ajax_force_values = false;
   var $Nav_permite_ava     = true;
   var $Nav_permite_ret     = true;
   var $Apl_com_erro        = false;
   var $app_is_initializing = false;
   var $Ini;
   var $Erro;
   var $Db;
   var $id;
   var $id_proyecto;
   var $id_proyecto_1;
   var $id_item;
   var $id_item_1;
   var $fecha;
   var $monto_uf;
   var $vigente;
   var $observaciones;
   var $orden;
   var $id_partida;
   var $id_partida_1;
   var $avance;
   var $facturado;
   var $facturado_1;
   var $valor_uf;
   var $factura;
   var $factura_scfile_name;
   var $factura_ul_name;
   var $factura_ul_type;
   var $factura_limpa;
   var $factura_salva;
   var $tipo_moneda;
   var $tipo_moneda_1;
   var $retencion;
   var $reajuste;
   var $multa;
   var $fecha_desde;
   var $fecha_hasta;
   var $dias_desde;
   var $dias_hasta;
   var $factor_produccion;
   var $dias_periodo;
   var $avance_periodo;
   var $avance_periodo_siguiente;
   var $avance_informado;
   var $avance_periodo_anterior;
   var $produccion_total_final;
   var $total_facturado;
   var $total_facturado_ur;
   var $fecha_desde_factura;
   var $fecha_hasta_factura;
   var $avance_informado_con_iva;
   var $produccion_ep;
   var $reajuste_con_iva;
   var $retencion_con_iva;
   var $produccion_neto;
   var $reajuste_acumulado_neto;
   var $reajuste_acumulado_con_iva;
   var $considera_retencion;
   var $considera_retencion_1;
   var $cliente;
   var $cliente_1;
   var $empresa;
   var $empresa_1;
   var $hitos_facturacion;
   var $hitos_facturacion_hidden;
   var $iva;
   var $modificacion_contrato;
   var $monto_contrato;
   var $monto_disponible;
   var $porcentaje_retencion;
   var $retencion_acumulada;
   var $incluye_retencion;
   var $existe_retencion;
   var $observaciones_solicitud;
   var $afecta_iva;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
   var $sc_insert_on;
   var $nmgp_clone;
   var $nmgp_return_img = array();
   var $nmgp_dados_form = array();
   var $nmgp_dados_select = array();
   var $nm_location;
   var $nm_flag_iframe;
   var $nm_flag_saida_novo;
   var $nmgp_botoes = array();
   var $nmgp_url_saida;
   var $nmgp_form_show;
   var $nmgp_form_empty;
   var $nmgp_cmp_readonly = array();
   var $nmgp_cmp_hidden = array();
   var $form_paginacao = 'parcial';
   var $lig_edit_lookup      = false;
   var $lig_edit_lookup_call = false;
   var $lig_edit_lookup_cb   = '';
   var $lig_edit_lookup_row  = '';
   var $is_calendar_app = false;
   var $Embutida_call  = false;
   var $Embutida_ronly = false;
   var $Embutida_proc  = false;
   var $Embutida_form  = false;
   var $Grid_editavel  = false;
   var $url_webhelp = '';
   var $nm_todas_criticas;
   var $Campos_Mens_erro;
   var $nm_new_label = array();
   var $record_insert_ok = false;
   var $record_delete_ok = false;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['afecta_iva']))
          {
              $this->afecta_iva = $this->NM_ajax_info['param']['afecta_iva'];
          }
          if (isset($this->NM_ajax_info['param']['avance_informado_con_iva']))
          {
              $this->avance_informado_con_iva = $this->NM_ajax_info['param']['avance_informado_con_iva'];
          }
          if (isset($this->NM_ajax_info['param']['cliente']))
          {
              $this->cliente = $this->NM_ajax_info['param']['cliente'];
          }
          if (isset($this->NM_ajax_info['param']['considera_retencion']))
          {
              $this->considera_retencion = $this->NM_ajax_info['param']['considera_retencion'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['dias_desde']))
          {
              $this->dias_desde = $this->NM_ajax_info['param']['dias_desde'];
          }
          if (isset($this->NM_ajax_info['param']['dias_hasta']))
          {
              $this->dias_hasta = $this->NM_ajax_info['param']['dias_hasta'];
          }
          if (isset($this->NM_ajax_info['param']['dias_periodo']))
          {
              $this->dias_periodo = $this->NM_ajax_info['param']['dias_periodo'];
          }
          if (isset($this->NM_ajax_info['param']['empresa']))
          {
              $this->empresa = $this->NM_ajax_info['param']['empresa'];
          }
          if (isset($this->NM_ajax_info['param']['existe_retencion']))
          {
              $this->existe_retencion = $this->NM_ajax_info['param']['existe_retencion'];
          }
          if (isset($this->NM_ajax_info['param']['factura']))
          {
              $this->factura = $this->NM_ajax_info['param']['factura'];
          }
          if (isset($this->NM_ajax_info['param']['factura_limpa']))
          {
              $this->factura_limpa = $this->NM_ajax_info['param']['factura_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['factura_salva']))
          {
              $this->factura_salva = $this->NM_ajax_info['param']['factura_salva'];
          }
          if (isset($this->NM_ajax_info['param']['factura_ul_name']))
          {
              $this->factura_ul_name = $this->NM_ajax_info['param']['factura_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['factura_ul_type']))
          {
              $this->factura_ul_type = $this->NM_ajax_info['param']['factura_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['facturado']))
          {
              $this->facturado = $this->NM_ajax_info['param']['facturado'];
          }
          if (isset($this->NM_ajax_info['param']['fecha']))
          {
              $this->fecha = $this->NM_ajax_info['param']['fecha'];
          }
          if (isset($this->NM_ajax_info['param']['fecha_desde']))
          {
              $this->fecha_desde = $this->NM_ajax_info['param']['fecha_desde'];
          }
          if (isset($this->NM_ajax_info['param']['fecha_desde_factura']))
          {
              $this->fecha_desde_factura = $this->NM_ajax_info['param']['fecha_desde_factura'];
          }
          if (isset($this->NM_ajax_info['param']['fecha_hasta']))
          {
              $this->fecha_hasta = $this->NM_ajax_info['param']['fecha_hasta'];
          }
          if (isset($this->NM_ajax_info['param']['fecha_hasta_factura']))
          {
              $this->fecha_hasta_factura = $this->NM_ajax_info['param']['fecha_hasta_factura'];
          }
          if (isset($this->NM_ajax_info['param']['hitos_facturacion']))
          {
              $this->hitos_facturacion = $this->NM_ajax_info['param']['hitos_facturacion'];
          }
          if (isset($this->NM_ajax_info['param']['id']))
          {
              $this->id = $this->NM_ajax_info['param']['id'];
          }
          if (isset($this->NM_ajax_info['param']['id_partida']))
          {
              $this->id_partida = $this->NM_ajax_info['param']['id_partida'];
          }
          if (isset($this->NM_ajax_info['param']['id_proyecto']))
          {
              $this->id_proyecto = $this->NM_ajax_info['param']['id_proyecto'];
          }
          if (isset($this->NM_ajax_info['param']['incluye_retencion']))
          {
              $this->incluye_retencion = $this->NM_ajax_info['param']['incluye_retencion'];
          }
          if (isset($this->NM_ajax_info['param']['iva']))
          {
              $this->iva = $this->NM_ajax_info['param']['iva'];
          }
          if (isset($this->NM_ajax_info['param']['monto_contrato']))
          {
              $this->monto_contrato = $this->NM_ajax_info['param']['monto_contrato'];
          }
          if (isset($this->NM_ajax_info['param']['monto_uf']))
          {
              $this->monto_uf = $this->NM_ajax_info['param']['monto_uf'];
          }
          if (isset($this->NM_ajax_info['param']['multa']))
          {
              $this->multa = $this->NM_ajax_info['param']['multa'];
          }
          if (isset($this->NM_ajax_info['param']['nm_form_submit']))
          {
              $this->nm_form_submit = $this->NM_ajax_info['param']['nm_form_submit'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ancora']))
          {
              $this->nmgp_ancora = $this->NM_ajax_info['param']['nmgp_ancora'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_dyn_search']))
          {
              $this->nmgp_arg_dyn_search = $this->NM_ajax_info['param']['nmgp_arg_dyn_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_fast_search']))
          {
              $this->nmgp_arg_fast_search = $this->NM_ajax_info['param']['nmgp_arg_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_cond_fast_search']))
          {
              $this->nmgp_cond_fast_search = $this->NM_ajax_info['param']['nmgp_cond_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_fast_search']))
          {
              $this->nmgp_fast_search = $this->NM_ajax_info['param']['nmgp_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_num_form']))
          {
              $this->nmgp_num_form = $this->NM_ajax_info['param']['nmgp_num_form'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_opcao']))
          {
              $this->nmgp_opcao = $this->NM_ajax_info['param']['nmgp_opcao'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ordem']))
          {
              $this->nmgp_ordem = $this->NM_ajax_info['param']['nmgp_ordem'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_parms']))
          {
              $this->nmgp_parms = $this->NM_ajax_info['param']['nmgp_parms'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['observaciones']))
          {
              $this->observaciones = $this->NM_ajax_info['param']['observaciones'];
          }
          if (isset($this->NM_ajax_info['param']['observaciones_solicitud']))
          {
              $this->observaciones_solicitud = $this->NM_ajax_info['param']['observaciones_solicitud'];
          }
          if (isset($this->NM_ajax_info['param']['produccion_neto']))
          {
              $this->produccion_neto = $this->NM_ajax_info['param']['produccion_neto'];
          }
          if (isset($this->NM_ajax_info['param']['reajuste_acumulado_con_iva']))
          {
              $this->reajuste_acumulado_con_iva = $this->NM_ajax_info['param']['reajuste_acumulado_con_iva'];
          }
          if (isset($this->NM_ajax_info['param']['reajuste_acumulado_neto']))
          {
              $this->reajuste_acumulado_neto = $this->NM_ajax_info['param']['reajuste_acumulado_neto'];
          }
          if (isset($this->NM_ajax_info['param']['retencion']))
          {
              $this->retencion = $this->NM_ajax_info['param']['retencion'];
          }
          if (isset($this->NM_ajax_info['param']['retencion_acumulada']))
          {
              $this->retencion_acumulada = $this->NM_ajax_info['param']['retencion_acumulada'];
          }
          if (isset($this->NM_ajax_info['param']['retencion_con_iva']))
          {
              $this->retencion_con_iva = $this->NM_ajax_info['param']['retencion_con_iva'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['tipo_moneda']))
          {
              $this->tipo_moneda = $this->NM_ajax_info['param']['tipo_moneda'];
          }
          if (isset($this->NM_ajax_info['param']['total_facturado']))
          {
              $this->total_facturado = $this->NM_ajax_info['param']['total_facturado'];
          }
          if (isset($this->NM_ajax_info['param']['valor_uf']))
          {
              $this->valor_uf = $this->NM_ajax_info['param']['valor_uf'];
          }
          if (isset($this->nmgp_refresh_fields))
          {
              $this->nmgp_refresh_fields = explode('_#fld#_', $this->nmgp_refresh_fields);
              $this->nmgp_opcao          = 'recarga';
          }
          if (!isset($this->nmgp_refresh_row))
          {
              $this->nmgp_refresh_row = '';
          }
      }

      $this->scSajaxReservedWords = array('rs', 'rst', 'rsrnd', 'rsargs');
      $this->sc_conv_var = array();
      if (!empty($_FILES))
      {
          foreach ($_FILES as $nmgp_campo => $nmgp_valores)
          {
               if (!in_array(strtolower($nmgp_campo), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_campo]))
                   {
                       $nmgp_campo = $this->sc_conv_var[$nmgp_campo];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_campo)]))
                   {
                       $nmgp_campo = $this->sc_conv_var[strtolower($nmgp_campo)];
                   }
               }
               $tmp_scfile_name     = $nmgp_campo . "_scfile_name";
               $tmp_scfile_type     = $nmgp_campo . "_scfile_type";
               $this->$nmgp_campo = is_array($nmgp_valores['tmp_name']) ? $nmgp_valores['tmp_name'][0] : $nmgp_valores['tmp_name'];
               $this->$tmp_scfile_type   = is_array($nmgp_valores['type'])     ? $nmgp_valores['type'][0]     : $nmgp_valores['type'];
               $this->$tmp_scfile_name   = is_array($nmgp_valores['name'])     ? $nmgp_valores['name'][0]     : $nmgp_valores['name'];
          }
      }
      $Sc_lig_md5 = false;
      if (!empty($_POST))
      {
          foreach ($_POST as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                      $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (!empty($_GET))
      {
          foreach ($_GET as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                       $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
      {
          $_SESSION['sc_session']['SC_parm_violation'] = true;
      }
      if (isset($nmgp_parms) && $nmgp_parms == "SC_null")
      {
          $nmgp_parms = "";
      }
      if (isset($this->id_proyecto) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['id_proyecto'] = $this->id_proyecto;
      }
      if (isset($this->group_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['group_name'] = $this->group_name;
      }
      if (isset($this->usr_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_name'] = $this->usr_name;
      }
      if (isset($this->usr_group) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_group'] = $this->usr_group;
      }
      if (isset($_POST["id_proyecto"]) && isset($this->id_proyecto)) 
      {
          $_SESSION['id_proyecto'] = $this->id_proyecto;
      }
      if (isset($_POST["group_name"]) && isset($this->group_name)) 
      {
          $_SESSION['group_name'] = $this->group_name;
      }
      if (isset($_POST["usr_name"]) && isset($this->usr_name)) 
      {
          $_SESSION['usr_name'] = $this->usr_name;
      }
      if (isset($_POST["usr_group"]) && isset($this->usr_group)) 
      {
          $_SESSION['usr_group'] = $this->usr_group;
      }
      if (isset($_GET["id_proyecto"]) && isset($this->id_proyecto)) 
      {
          $_SESSION['id_proyecto'] = $this->id_proyecto;
      }
      if (isset($_GET["group_name"]) && isset($this->group_name)) 
      {
          $_SESSION['group_name'] = $this->group_name;
      }
      if (isset($_GET["usr_name"]) && isset($this->usr_name)) 
      {
          $_SESSION['usr_name'] = $this->usr_name;
      }
      if (isset($_GET["usr_group"]) && isset($this->usr_group)) 
      {
          $_SESSION['usr_group'] = $this->usr_group;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['embutida_parms']);
      } 
      if (isset($this->nmgp_parms) && !empty($this->nmgp_parms)) 
      { 
          if (isset($_SESSION['nm_aba_bg_color'])) 
          { 
              unset($_SESSION['nm_aba_bg_color']);
          }   
          $nmgp_parms = str_replace("@aspass@", "'", $this->nmgp_parms);
          $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
          $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
          $todo  = explode("?@?", $todox);
          $ix = 0;
          while (!empty($todo[$ix]))
          {
             $cadapar = explode("?#?", $todo[$ix]);
             if (1 < sizeof($cadapar))
             {
                if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                {
                    $cadapar[0] = substr($cadapar[0], 11);
                    $cadapar[1] = $_SESSION[$cadapar[1]];
                }
                 if (isset($this->sc_conv_var[$cadapar[0]]))
                 {
                     $cadapar[0] = $this->sc_conv_var[$cadapar[0]];
                 }
                 elseif (isset($this->sc_conv_var[strtolower($cadapar[0])]))
                 {
                     $cadapar[0] = $this->sc_conv_var[strtolower($cadapar[0])];
                 }
                 nm_limpa_str_form_prod_presupuesto_periodo($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->id_proyecto)) 
          {
              $_SESSION['id_proyecto'] = $this->id_proyecto;
          }
          if (isset($this->group_name)) 
          {
              $_SESSION['group_name'] = $this->group_name;
          }
          if (isset($this->usr_name)) 
          {
              $_SESSION['usr_name'] = $this->usr_name;
          }
          if (isset($this->usr_group)) 
          {
              $_SESSION['usr_group'] = $this->usr_group;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['sc_redir_insert'] = $this->sc_redir_insert;
          }
          if (isset($this->id_proyecto)) 
          {
              $_SESSION['id_proyecto'] = $this->id_proyecto;
          }
          if (isset($this->group_name)) 
          {
              $_SESSION['group_name'] = $this->group_name;
          }
          if (isset($this->usr_name)) 
          {
              $_SESSION['usr_name'] = $this->usr_name;
          }
          if (isset($this->usr_group)) 
          {
              $_SESSION['usr_group'] = $this->usr_group;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['parms']);
              $todo  = explode("?@?", $todox);
              $ix = 0;
              while (!empty($todo[$ix]))
              {
                 $cadapar = explode("?#?", $todo[$ix]);
                 if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                 {
                     $cadapar[0] = substr($cadapar[0], 11);
                     $cadapar[1] = $_SESSION[$cadapar[1]];
                 }
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 $ix++;
              }
          }
      } 

      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_prod_presupuesto_periodo_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("es");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("es");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['form_prod_presupuesto_periodo']['upload_field_info']['factura'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'form_prod_presupuesto_periodo',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/.+$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'N0',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_prod_presupuesto_periodo']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_prod_presupuesto_periodo'];
          }
          elseif (isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']]))
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']] as $init => $resto)
              {
                  if ($this->Ini->sc_page == $init)
                  {
                      $this->sc_init_menu = $init;
                      break;
                  }
              }
          }
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_prod_presupuesto_periodo']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_prod_presupuesto_periodo']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_prod_presupuesto_periodo') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_prod_presupuesto_periodo']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Partida De Producción";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_prod_presupuesto_periodo")
                  {
                      $achou = true;
                  }
                  elseif ($achou)
                  {
                      unset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu][$apl]);
                      $this->Change_Menu = true;
                  }
              }
          }
      }
      if (!function_exists("nmButtonOutput"))
      {
          include_once($this->Ini->path_lib_php . "nm_gp_config_btn.php");
      }
      include("../_lib/css/" . $this->Ini->str_schema_all . "_form.php");
      $this->Ini->Str_btn_form    = trim($str_button);
      include($this->Ini->path_btn . $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
      $_SESSION['scriptcase']['css_form_help'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form.css";
      $_SESSION['scriptcase']['css_form_help_dir'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->Db = $this->Ini->Db; 
      $this->Ini->str_google_fonts = '';
      $this->Ini->Img_sep_form    = "/" . trim($str_toolbar_separator);
      $this->Ini->Color_bg_ajax   = !isset($str_ajax_bg)         || "" == trim($str_ajax_bg)         ? "#000" : $str_ajax_bg;
      $this->Ini->Border_c_ajax   = !isset($str_ajax_border_c)   || "" == trim($str_ajax_border_c)   ? ""     : $str_ajax_border_c;
      $this->Ini->Border_s_ajax   = !isset($str_ajax_border_s)   || "" == trim($str_ajax_border_s)   ? ""     : $str_ajax_border_s;
      $this->Ini->Border_w_ajax   = !isset($str_ajax_border_w)   || "" == trim($str_ajax_border_w)   ? ""     : $str_ajax_border_w;
      $this->Ini->Block_img_exp   = !isset($str_block_exp)       || "" == trim($str_block_exp)       ? ""     : $str_block_exp;
      $this->Ini->Block_img_col   = !isset($str_block_col)       || "" == trim($str_block_col)       ? ""     : $str_block_col;
      $this->Ini->Msg_ico_title   = !isset($str_msg_ico_title)   || "" == trim($str_msg_ico_title)   ? ""     : $str_msg_ico_title;
      $this->Ini->Msg_ico_body    = !isset($str_msg_ico_body)    || "" == trim($str_msg_ico_body)    ? ""     : $str_msg_ico_body;
      $this->Ini->Err_ico_title   = !isset($str_err_ico_title)   || "" == trim($str_err_ico_title)   ? ""     : $str_err_ico_title;
      $this->Ini->Err_ico_body    = !isset($str_err_ico_body)    || "" == trim($str_err_ico_body)    ? ""     : $str_err_ico_body;
      $this->Ini->Cal_ico_back    = !isset($str_cal_ico_back)    || "" == trim($str_cal_ico_back)    ? ""     : $str_cal_ico_back;
      $this->Ini->Cal_ico_for     = !isset($str_cal_ico_for)     || "" == trim($str_cal_ico_for)     ? ""     : $str_cal_ico_for;
      $this->Ini->Cal_ico_close   = !isset($str_cal_ico_close)   || "" == trim($str_cal_ico_close)   ? ""     : $str_cal_ico_close;
      $this->Ini->Tab_space       = !isset($str_tab_space)       || "" == trim($str_tab_space)       ? ""     : $str_tab_space;
      $this->Ini->Bubble_tail     = !isset($str_bubble_tail)     || "" == trim($str_bubble_tail)     ? ""     : $str_bubble_tail;
      $this->Ini->Label_sort_pos  = !isset($str_label_sort_pos)  || "" == trim($str_label_sort_pos)  ? ""     : $str_label_sort_pos;
      $this->Ini->Label_sort      = !isset($str_label_sort)      || "" == trim($str_label_sort)      ? ""     : $str_label_sort;
      $this->Ini->Label_sort_asc  = !isset($str_label_sort_asc)  || "" == trim($str_label_sort_asc)  ? ""     : $str_label_sort_asc;
      $this->Ini->Label_sort_desc = !isset($str_label_sort_desc) || "" == trim($str_label_sort_desc) ? ""     : $str_label_sort_desc;
      $this->Ini->Img_status_ok       = !isset($str_img_status_ok)  || "" == trim($str_img_status_ok)   ? ""     : $str_img_status_ok;
      $this->Ini->Img_status_err      = !isset($str_img_status_err) || "" == trim($str_img_status_err)  ? ""     : $str_img_status_err;
      $this->Ini->Css_status          = "scFormInputError";
      $this->Ini->Css_status_pwd_box  = "scFormInputErrorPwdBox";
      $this->Ini->Css_status_pwd_text = "scFormInputErrorPwdText";
      $this->Ini->Error_icon_span      = !isset($str_error_icon_span)  || "" == trim($str_error_icon_span)  ? false  : "message" == $str_error_icon_span;
      $this->Ini->Img_qs_search        = !isset($img_qs_search)        || "" == trim($img_qs_search)        ? "scriptcase__NM__qs_lupa.png"  : $img_qs_search;
      $this->Ini->Img_qs_clean         = !isset($img_qs_clean)         || "" == trim($img_qs_clean)         ? "scriptcase__NM__qs_close.png" : $img_qs_clean;
      $this->Ini->Str_qs_image_padding = !isset($str_qs_image_padding) || "" == trim($str_qs_image_padding) ? "0"                            : $str_qs_image_padding;
      $this->Ini->App_div_tree_img_col = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp = trim($app_div_str_tree_exp);
      $this->Ini->form_table_width     = isset($str_form_table_width) && '' != trim($str_form_table_width) ? $str_form_table_width : '';

        $this->classes_100perc_fields['table'] = '';
        $this->classes_100perc_fields['input'] = '';
        $this->classes_100perc_fields['span_input'] = '';
        $this->classes_100perc_fields['span_select'] = '';
        $this->classes_100perc_fields['style_category'] = '';
        $this->classes_100perc_fields['keep_field_size'] = true;



      $_SESSION['scriptcase']['error_icon']['form_prod_presupuesto_periodo']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__icnMensagemAlerta.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_prod_presupuesto_periodo'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['factura_ul_name']) && '' != $this->NM_ajax_info['param']['factura_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_field_ul_name'][$this->factura_ul_name]))
          {
              $this->NM_ajax_info['param']['factura_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_field_ul_name'][$this->factura_ul_name];
          }
          $this->factura = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['factura_ul_name'];
          $this->factura_scfile_name = substr($this->NM_ajax_info['param']['factura_ul_name'], 12);
          $this->factura_scfile_type = $this->NM_ajax_info['param']['factura_ul_type'];
          $this->factura_ul_name = $this->NM_ajax_info['param']['factura_ul_name'];
          $this->factura_ul_type = $this->NM_ajax_info['param']['factura_ul_type'];
      }
      elseif (isset($this->factura_ul_name) && '' != $this->factura_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_field_ul_name'][$this->factura_ul_name]))
          {
              $this->factura_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_field_ul_name'][$this->factura_ul_name];
          }
          $this->factura = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->factura_ul_name;
          $this->factura_scfile_name = substr($this->factura_ul_name, 12);
          $this->factura_scfile_type = $this->factura_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['qsearch'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "on";
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "on";
      $this->nmgp_botoes['navpage'] = "on";
      $this->nmgp_botoes['goto'] = "on";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_prod_presupuesto_periodo']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_prod_presupuesto_periodo'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_prod_presupuesto_periodo'];

              $this->nmgp_botoes['update']     = $tmpDashboardButtons['form_update']    ? 'on' : 'off';
              $this->nmgp_botoes['new']        = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['insert']     = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['delete']     = $tmpDashboardButtons['form_delete']    ? 'on' : 'off';
              $this->nmgp_botoes['copy']       = $tmpDashboardButtons['form_copy']      ? 'on' : 'off';
              $this->nmgp_botoes['first']      = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['back']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['last']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['forward']    = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['navpage']    = $tmpDashboardButtons['form_navpage']   ? 'on' : 'off';
              $this->nmgp_botoes['goto']       = $tmpDashboardButtons['form_goto']      ? 'on' : 'off';
              $this->nmgp_botoes['qtline']     = $tmpDashboardButtons['form_lineqty']   ? 'on' : 'off';
              $this->nmgp_botoes['summary']    = $tmpDashboardButtons['form_summary']   ? 'on' : 'off';
              $this->nmgp_botoes['qsearch']    = $tmpDashboardButtons['form_qsearch']   ? 'on' : 'off';
              $this->nmgp_botoes['dynsearch']  = $tmpDashboardButtons['form_dynsearch'] ? 'on' : 'off';
              $this->nmgp_botoes['reload']     = $tmpDashboardButtons['form_reload']    ? 'on' : 'off';
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dados_form'];
          if (!isset($this->id_item)){$this->id_item = $this->nmgp_dados_form['id_item'];} 
          if (!isset($this->vigente)){$this->vigente = $this->nmgp_dados_form['vigente'];} 
          if (!isset($this->orden)){$this->orden = $this->nmgp_dados_form['orden'];} 
          if (!isset($this->avance)){$this->avance = $this->nmgp_dados_form['avance'];} 
          if (!isset($this->reajuste)){$this->reajuste = $this->nmgp_dados_form['reajuste'];} 
          if (!isset($this->factor_produccion)){$this->factor_produccion = $this->nmgp_dados_form['factor_produccion'];} 
          if (!isset($this->avance_periodo)){$this->avance_periodo = $this->nmgp_dados_form['avance_periodo'];} 
          if (!isset($this->avance_periodo_siguiente)){$this->avance_periodo_siguiente = $this->nmgp_dados_form['avance_periodo_siguiente'];} 
          if (!isset($this->avance_informado)){$this->avance_informado = $this->nmgp_dados_form['avance_informado'];} 
          if (!isset($this->avance_periodo_anterior)){$this->avance_periodo_anterior = $this->nmgp_dados_form['avance_periodo_anterior'];} 
          if (!isset($this->produccion_total_final)){$this->produccion_total_final = $this->nmgp_dados_form['produccion_total_final'];} 
          if (!isset($this->total_facturado_ur)){$this->total_facturado_ur = $this->nmgp_dados_form['total_facturado_ur'];} 
          if (!isset($this->produccion_ep)){$this->produccion_ep = $this->nmgp_dados_form['produccion_ep'];} 
          if (!isset($this->reajuste_con_iva)){$this->reajuste_con_iva = $this->nmgp_dados_form['reajuste_con_iva'];} 
          if (!isset($this->modificacion_contrato)){$this->modificacion_contrato = $this->nmgp_dados_form['modificacion_contrato'];} 
          if (!isset($this->monto_disponible)){$this->monto_disponible = $this->nmgp_dados_form['monto_disponible'];} 
          if (!isset($this->porcentaje_retencion)){$this->porcentaje_retencion = $this->nmgp_dados_form['porcentaje_retencion'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_prod_presupuesto_periodo", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                      $this->Ini->Nm_lang['lang_mnth_janu'],
                                      $this->Ini->Nm_lang['lang_mnth_febr'],
                                      $this->Ini->Nm_lang['lang_mnth_marc'],
                                      $this->Ini->Nm_lang['lang_mnth_apri'],
                                      $this->Ini->Nm_lang['lang_mnth_mayy'],
                                      $this->Ini->Nm_lang['lang_mnth_june'],
                                      $this->Ini->Nm_lang['lang_mnth_july'],
                                      $this->Ini->Nm_lang['lang_mnth_augu'],
                                      $this->Ini->Nm_lang['lang_mnth_sept'],
                                      $this->Ini->Nm_lang['lang_mnth_octo'],
                                      $this->Ini->Nm_lang['lang_mnth_nove'],
                                      $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                      $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                      $this->Ini->Nm_lang['lang_days_sund'],
                                      $this->Ini->Nm_lang['lang_days_mond'],
                                      $this->Ini->Nm_lang['lang_days_tued'],
                                      $this->Ini->Nm_lang['lang_days_wend'],
                                      $this->Ini->Nm_lang['lang_days_thud'],
                                      $this->Ini->Nm_lang['lang_days_frid'],
                                      $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                      $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                      $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                      $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                      $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                      $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                      $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                      $this->Ini->Nm_lang['lang_shrt_days_satd']);
      nm_gc($this->Ini->path_libs);
      $this->Ini->Gd_missing  = true;
      if(function_exists("getProdVersion"))
      {
         $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
         if(function_exists("gd_info"))
         {
            $this->Ini->Gd_missing = false;
         }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 
      if (isset($_GET['nm_cal_display']))
      {
          if ($this->Embutida_proc)
          { 
              include_once($this->Ini->path_embutida . 'form_prod_presupuesto_periodo/form_prod_presupuesto_periodo_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'form_prod_presupuesto_periodo_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'form_prod_presupuesto_periodo_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_prod_presupuesto_periodo_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('form:' == substr($str_link_webhelp, 0, 5))
                  {
                      $arr_link_parts = explode(':', $str_link_webhelp);
                      if ('' != $arr_link_parts[1] && is_file($this->Ini->root . $this->Ini->path_help . $arr_link_parts[1]))
                      {
                          $this->url_webhelp = $this->Ini->path_help . $arr_link_parts[1];
                      }
                  }
              }
          }
      }

      if (is_dir($this->Ini->path_aplicacao . 'img'))
      {
          $Res_dir_img = @opendir($this->Ini->path_aplicacao . 'img');
          if ($Res_dir_img)
          {
              while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
              {
                 if (@is_file($this->Ini->path_aplicacao . 'img/' . $Str_arquivo) && '.' != $Str_arquivo && '..' != $this->Ini->path_aplicacao . 'img/' . $Str_arquivo)
                 {
                     @unlink($this->Ini->path_aplicacao . 'img/' . $Str_arquivo);
                 }
              }
          }
          @closedir($Res_dir_img);
          rmdir($this->Ini->path_aplicacao . 'img');
      }

      if ($this->Embutida_proc)
      { 
          require_once($this->Ini->path_embutida . 'form_prod_presupuesto_periodo/form_prod_presupuesto_periodo_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_prod_presupuesto_periodo_erro.class.php"); 
      }
      $this->Erro      = new form_prod_presupuesto_periodo_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao']))
         { 
             if ($this->id != "" || $this->id_proyecto != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_prod_presupuesto_periodo']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = false;
      $this->sc_evento = $this->nmgp_opcao;
      $this->sc_insert_on = false;
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      $_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off'; 
      }
      if (isset($this->id)) { $this->nm_limpa_alfa($this->id); }
      if (isset($this->id_proyecto)) { $this->nm_limpa_alfa($this->id_proyecto); }
      if (isset($this->monto_uf)) { $this->nm_limpa_alfa($this->monto_uf); }
      if (isset($this->observaciones)) { $this->nm_limpa_alfa($this->observaciones); }
      if (isset($this->id_partida)) { $this->nm_limpa_alfa($this->id_partida); }
      if (isset($this->facturado)) { $this->nm_limpa_alfa($this->facturado); }
      if (isset($this->valor_uf)) { $this->nm_limpa_alfa($this->valor_uf); }
      if (isset($this->tipo_moneda)) { $this->nm_limpa_alfa($this->tipo_moneda); }
      if (isset($this->retencion)) { $this->nm_limpa_alfa($this->retencion); }
      if (isset($this->multa)) { $this->nm_limpa_alfa($this->multa); }
      if (isset($this->dias_desde)) { $this->nm_limpa_alfa($this->dias_desde); }
      if (isset($this->dias_hasta)) { $this->nm_limpa_alfa($this->dias_hasta); }
      if (isset($this->dias_periodo)) { $this->nm_limpa_alfa($this->dias_periodo); }
      if (isset($this->total_facturado)) { $this->nm_limpa_alfa($this->total_facturado); }
      if (isset($this->avance_informado_con_iva)) { $this->nm_limpa_alfa($this->avance_informado_con_iva); }
      if (isset($this->retencion_con_iva)) { $this->nm_limpa_alfa($this->retencion_con_iva); }
      if (isset($this->produccion_neto)) { $this->nm_limpa_alfa($this->produccion_neto); }
      if (isset($this->reajuste_acumulado_neto)) { $this->nm_limpa_alfa($this->reajuste_acumulado_neto); }
      if (isset($this->reajuste_acumulado_con_iva)) { $this->nm_limpa_alfa($this->reajuste_acumulado_con_iva); }
      if (isset($this->considera_retencion)) { $this->nm_limpa_alfa($this->considera_retencion); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- id
      $this->field_config['id']               = array();
      $this->field_config['id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['id']['symbol_dec'] = '';
      $this->field_config['id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- monto_contrato
      $this->field_config['monto_contrato']               = array();
      $this->field_config['monto_contrato']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['monto_contrato']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['monto_contrato']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['monto_contrato']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['monto_contrato']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- fecha_desde
      $this->field_config['fecha_desde']                 = array();
      $this->field_config['fecha_desde']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['fecha_desde']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['fecha_desde']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'fecha_desde');
      //-- fecha_hasta
      $this->field_config['fecha_hasta']                 = array();
      $this->field_config['fecha_hasta']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['fecha_hasta']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['fecha_hasta']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'fecha_hasta');
      //-- dias_desde
      $this->field_config['dias_desde']               = array();
      $this->field_config['dias_desde']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['dias_desde']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['dias_desde']['symbol_dec'] = '';
      $this->field_config['dias_desde']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['dias_desde']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- dias_hasta
      $this->field_config['dias_hasta']               = array();
      $this->field_config['dias_hasta']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['dias_hasta']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['dias_hasta']['symbol_dec'] = '';
      $this->field_config['dias_hasta']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['dias_hasta']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- dias_periodo
      $this->field_config['dias_periodo']               = array();
      $this->field_config['dias_periodo']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['dias_periodo']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['dias_periodo']['symbol_dec'] = '';
      $this->field_config['dias_periodo']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['dias_periodo']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- fecha_desde_factura
      $this->field_config['fecha_desde_factura']                 = array();
      $this->field_config['fecha_desde_factura']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['fecha_desde_factura']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['fecha_desde_factura']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'fecha_desde_factura');
      //-- fecha_hasta_factura
      $this->field_config['fecha_hasta_factura']                 = array();
      $this->field_config['fecha_hasta_factura']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['fecha_hasta_factura']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['fecha_hasta_factura']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'fecha_hasta_factura');
      //-- avance_informado_con_iva
      $this->field_config['avance_informado_con_iva']               = array();
      $this->field_config['avance_informado_con_iva']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['avance_informado_con_iva']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['avance_informado_con_iva']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['avance_informado_con_iva']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['avance_informado_con_iva']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- produccion_neto
      $this->field_config['produccion_neto']               = array();
      $this->field_config['produccion_neto']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['produccion_neto']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['produccion_neto']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['produccion_neto']['symbol_mon'] = '';
      $this->field_config['produccion_neto']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['produccion_neto']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- retencion
      $this->field_config['retencion']               = array();
      $this->field_config['retencion']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['retencion']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['retencion']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['retencion']['symbol_mon'] = '';
      $this->field_config['retencion']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['retencion']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- retencion_con_iva
      $this->field_config['retencion_con_iva']               = array();
      $this->field_config['retencion_con_iva']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['retencion_con_iva']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['retencion_con_iva']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['retencion_con_iva']['symbol_mon'] = '';
      $this->field_config['retencion_con_iva']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['retencion_con_iva']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- retencion_acumulada
      $this->field_config['retencion_acumulada']               = array();
      $this->field_config['retencion_acumulada']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['retencion_acumulada']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['retencion_acumulada']['symbol_dec'] = '';
      $this->field_config['retencion_acumulada']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['retencion_acumulada']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- reajuste_acumulado_con_iva
      $this->field_config['reajuste_acumulado_con_iva']               = array();
      $this->field_config['reajuste_acumulado_con_iva']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['reajuste_acumulado_con_iva']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['reajuste_acumulado_con_iva']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['reajuste_acumulado_con_iva']['symbol_mon'] = '';
      $this->field_config['reajuste_acumulado_con_iva']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['reajuste_acumulado_con_iva']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- reajuste_acumulado_neto
      $this->field_config['reajuste_acumulado_neto']               = array();
      $this->field_config['reajuste_acumulado_neto']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['reajuste_acumulado_neto']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['reajuste_acumulado_neto']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['reajuste_acumulado_neto']['symbol_mon'] = '';
      $this->field_config['reajuste_acumulado_neto']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['reajuste_acumulado_neto']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- multa
      $this->field_config['multa']               = array();
      $this->field_config['multa']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['multa']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['multa']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['multa']['symbol_mon'] = '';
      $this->field_config['multa']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['multa']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- total_facturado
      $this->field_config['total_facturado']               = array();
      $this->field_config['total_facturado']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['total_facturado']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['total_facturado']['symbol_dec'] = '';
      $this->field_config['total_facturado']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['total_facturado']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- iva
      $this->field_config['iva']               = array();
      $this->field_config['iva']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['iva']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['iva']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['iva']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['iva']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- monto_uf
      $this->field_config['monto_uf']               = array();
      $this->field_config['monto_uf']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['monto_uf']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['monto_uf']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['monto_uf']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['monto_uf']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- fecha
      $this->field_config['fecha']                 = array();
      $this->field_config['fecha']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['fecha']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['fecha']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'fecha');
      //-- valor_uf
      $this->field_config['valor_uf']               = array();
      $this->field_config['valor_uf']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['valor_uf']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['valor_uf']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['valor_uf']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['valor_uf']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- vigente
      $this->field_config['vigente']               = array();
      $this->field_config['vigente']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['vigente']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['vigente']['symbol_dec'] = '';
      $this->field_config['vigente']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['vigente']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- orden
      $this->field_config['orden']               = array();
      $this->field_config['orden']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['orden']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['orden']['symbol_dec'] = '';
      $this->field_config['orden']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['orden']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- avance
      $this->field_config['avance']               = array();
      $this->field_config['avance']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['avance']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['avance']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['avance']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['avance']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- reajuste
      $this->field_config['reajuste']               = array();
      $this->field_config['reajuste']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['reajuste']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['reajuste']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['reajuste']['symbol_mon'] = '';
      $this->field_config['reajuste']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['reajuste']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- factor_produccion
      $this->field_config['factor_produccion']               = array();
      $this->field_config['factor_produccion']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['factor_produccion']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['factor_produccion']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['factor_produccion']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['factor_produccion']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- avance_periodo
      $this->field_config['avance_periodo']               = array();
      $this->field_config['avance_periodo']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['avance_periodo']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['avance_periodo']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['avance_periodo']['symbol_mon'] = '';
      $this->field_config['avance_periodo']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['avance_periodo']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- avance_periodo_siguiente
      $this->field_config['avance_periodo_siguiente']               = array();
      $this->field_config['avance_periodo_siguiente']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['avance_periodo_siguiente']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['avance_periodo_siguiente']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['avance_periodo_siguiente']['symbol_mon'] = '';
      $this->field_config['avance_periodo_siguiente']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['avance_periodo_siguiente']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- avance_informado
      $this->field_config['avance_informado']               = array();
      $this->field_config['avance_informado']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['avance_informado']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['avance_informado']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['avance_informado']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['avance_informado']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- avance_periodo_anterior
      $this->field_config['avance_periodo_anterior']               = array();
      $this->field_config['avance_periodo_anterior']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['avance_periodo_anterior']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['avance_periodo_anterior']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['avance_periodo_anterior']['symbol_mon'] = '';
      $this->field_config['avance_periodo_anterior']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['avance_periodo_anterior']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- produccion_total_final
      $this->field_config['produccion_total_final']               = array();
      $this->field_config['produccion_total_final']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['produccion_total_final']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['produccion_total_final']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['produccion_total_final']['symbol_mon'] = '';
      $this->field_config['produccion_total_final']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['produccion_total_final']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- total_facturado_ur
      $this->field_config['total_facturado_ur']               = array();
      $this->field_config['total_facturado_ur']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['total_facturado_ur']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['total_facturado_ur']['symbol_dec'] = '';
      $this->field_config['total_facturado_ur']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['total_facturado_ur']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- produccion_ep
      $this->field_config['produccion_ep']               = array();
      $this->field_config['produccion_ep']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['produccion_ep']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['produccion_ep']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['produccion_ep']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['produccion_ep']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- reajuste_con_iva
      $this->field_config['reajuste_con_iva']               = array();
      $this->field_config['reajuste_con_iva']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['reajuste_con_iva']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['reajuste_con_iva']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['reajuste_con_iva']['symbol_mon'] = '';
      $this->field_config['reajuste_con_iva']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['reajuste_con_iva']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- modificacion_contrato
      $this->field_config['modificacion_contrato']               = array();
      $this->field_config['modificacion_contrato']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['modificacion_contrato']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['modificacion_contrato']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['modificacion_contrato']['symbol_mon'] = '';
      $this->field_config['modificacion_contrato']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['modificacion_contrato']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- monto_disponible
      $this->field_config['monto_disponible']               = array();
      $this->field_config['monto_disponible']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['monto_disponible']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['monto_disponible']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['monto_disponible']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['monto_disponible']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- porcentaje_retencion
      $this->field_config['porcentaje_retencion']               = array();
      $this->field_config['porcentaje_retencion']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['porcentaje_retencion']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['porcentaje_retencion']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['porcentaje_retencion']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['porcentaje_retencion']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();

      if ('' != $_SESSION['scriptcase']['change_regional_old'])
      {
          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_old'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $this->nm_tira_formatacao();

          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_new'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $guarda_formatado = $this->formatado;
          $this->nm_formatar_campos();
          $this->formatado = $guarda_formatado;

          $_SESSION['scriptcase']['change_regional_old'] = '';
          $_SESSION['scriptcase']['change_regional_new'] = '';
      }

      if ($nm_form_submit == 1 && ($this->nmgp_opcao == 'inicio' || $this->nmgp_opcao == 'igual'))
      {
          $this->nm_tira_formatacao();
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
         $this->afecta_iva = "";
         $this->existe_retencion = "";
         $this->incluye_retencion = "";
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'id');
          }
          if ('validate_id_proyecto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'id_proyecto');
          }
          if ('validate_monto_contrato' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'monto_contrato');
          }
          if ('validate_tipo_moneda' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tipo_moneda');
          }
          if ('validate_empresa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'empresa');
          }
          if ('validate_cliente' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cliente');
          }
          if ('validate_id_partida' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'id_partida');
          }
          if ('validate_fecha_desde' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'fecha_desde');
          }
          if ('validate_fecha_hasta' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'fecha_hasta');
          }
          if ('validate_dias_desde' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dias_desde');
          }
          if ('validate_dias_hasta' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dias_hasta');
          }
          if ('validate_dias_periodo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dias_periodo');
          }
          if ('validate_fecha_desde_factura' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'fecha_desde_factura');
          }
          if ('validate_fecha_hasta_factura' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'fecha_hasta_factura');
          }
          if ('validate_avance_informado_con_iva' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'avance_informado_con_iva');
          }
          if ('validate_produccion_neto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'produccion_neto');
          }
          if ('validate_retencion' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'retencion');
          }
          if ('validate_retencion_con_iva' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'retencion_con_iva');
          }
          if ('validate_retencion_acumulada' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'retencion_acumulada');
          }
          if ('validate_reajuste_acumulado_con_iva' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'reajuste_acumulado_con_iva');
          }
          if ('validate_reajuste_acumulado_neto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'reajuste_acumulado_neto');
          }
          if ('validate_multa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'multa');
          }
          if ('validate_total_facturado' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'total_facturado');
          }
          if ('validate_considera_retencion' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'considera_retencion');
          }
          if ('validate_facturado' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'facturado');
          }
          if ('validate_observaciones_solicitud' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'observaciones_solicitud');
          }
          if ('validate_iva' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'iva');
          }
          if ('validate_monto_uf' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'monto_uf');
          }
          if ('validate_fecha' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'fecha');
          }
          if ('validate_valor_uf' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valor_uf');
          }
          if ('validate_observaciones' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'observaciones');
          }
          if ('validate_factura' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'factura');
          }
          if ('validate_hitos_facturacion' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hitos_facturacion');
          }
          form_prod_presupuesto_periodo_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_considera_retencion_onchange' == $this->NM_ajax_opcao)
          {
              $this->considera_retencion_onChange();
          }
          if ('event_fecha_desde_factura_onchange' == $this->NM_ajax_opcao)
          {
              $this->fecha_desde_factura_onChange();
          }
          if ('event_fecha_desde_onchange' == $this->NM_ajax_opcao)
          {
              $this->fecha_desde_onChange();
          }
          if ('event_fecha_hasta_factura_onchange' == $this->NM_ajax_opcao)
          {
              $this->fecha_hasta_factura_onChange();
          }
          if ('event_fecha_hasta_onchange' == $this->NM_ajax_opcao)
          {
              $this->fecha_hasta_onChange();
          }
          if ('event_id_partida_onchange' == $this->NM_ajax_opcao)
          {
              $this->id_partida_onChange();
          }
          if ('event_multa_onchange' == $this->NM_ajax_opcao)
          {
              $this->multa_onChange();
          }
          if ('event_retencion_onchange' == $this->NM_ajax_opcao)
          {
              $this->retencion_onChange();
          }
          form_prod_presupuesto_periodo_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_prod_presupuesto_periodo_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          $this->nm_gera_html();
          $this->NM_close_db(); 
          $this->nmgp_opcao = ""; 
          exit; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_prod_presupuesto_periodo_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro, '', true, true); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir" && $nm_apl_dependente == 1) 
              { 
                  $this->nm_flag_saida_novo = "S";; 
              }
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
      elseif (isset($nm_form_submit) && 1 == $nm_form_submit && $this->nmgp_opcao != "menu_link" && $this->nmgp_opcao != "recarga_mobile")
      {
      }
//
      if ($this->nmgp_opcao != "nada")
      {
          $this->nm_acessa_banco();
      }
      else
      {
           if ($this->nmgp_opc_ant == "incluir") 
           { 
               $this->nm_proc_onload(false);
           }
           else
           { 
              $this->nm_guardar_campos();
           }
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_redir_atualiz'] == "ok")
          {
              if ($this->sc_evento == "update")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
              if ($this->sc_evento == "delete")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
      }
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          form_prod_presupuesto_periodo_pack_ajax_response();
          exit;
      }
      $this->nm_formatar_campos();
      if ($this->NM_ajax_flag)
      {
          $this->NM_ajax_info['result'] = 'OK';
          if ('alterar' == $this->NM_ajax_info['param']['nmgp_opcao'])
          {
              $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmu']);
          }
          form_prod_presupuesto_periodo_pack_ajax_response();
          exit;
      }
      $this->nm_gera_html();
      $this->NM_close_db(); 
      $this->nmgp_opcao = ""; 
      if ($this->Change_Menu)
      {
          $apl_menu  = $_SESSION['scriptcase']['menu_atual'];
          $Arr_rastro = array();
          if (isset($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) && count($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) > 1)
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu] as $menu => $apls)
              {
                 $Arr_rastro[] = "'<a href=\"" . $apls['link'] . "?script_case_init=" . $this->sc_init_menu . "\" target=\"#NMIframe#\">" . $apls['label'] . "</a>'";
              }
              $ult_apl = count($Arr_rastro) - 1;
              unset($Arr_rastro[$ult_apl]);
              $rastro = implode(",", $Arr_rastro);
?>
  <script type="text/javascript">
     link_atual = new Array (<?php echo $rastro ?>);
     parent.writeFastMenu(link_atual);
  </script>
<?php
          }
          else
          {
?>
  <script type="text/javascript">
     parent.clearFastMenu();
  </script>
<?php
          }
      }
   }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_prod_presupuesto_periodo.zip";
          $Arq_htm = $this->Ini->path_imag_temp . "/" . $Zip_name;
          $Arq_zip = $this->Ini->root . $Arq_htm;
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($Arq_base, ' ')) ? " \"" . $Arq_base . "\"" :  $Arq_base;
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Html_password . " " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
           {
                if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                }
                else
                {
                    chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                }
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           if (!empty($str_zip)) {
               exec($str_zip);
           }
           // ----- ZIP log
           $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
           if ($fp)
           {
               @fwrite($fp, $str_zip . "\r\n\r\n");
               @fclose($fp);
           }
           foreach ($this->Ini->Img_export_zip as $cada_img_zip)
           {
               $str_zip      = "";
              $cada_img_zip = '"' . $cada_img_zip . '"';
               if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
               {
                   $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Html_password . " " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               if (!empty($str_zip)) {
                   exec($str_zip);
               }
               // ----- ZIP log
               $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
               if ($fp)
               {
                   @fwrite($fp, $str_zip . "\r\n\r\n");
                   @fclose($fp);
               }
           }
           if (is_file($Arq_zip)) {
               unlink($Arq_base);
           } 
          $path_doc_md5 = md5($Arq_htm);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo'][$path_doc_md5][1] = $Zip_name;
?>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Partida De Producción") ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" /> 
  <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</HEAD>
<BODY class="scExportPage">
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: top">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">PRINT</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
   <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "");?>

    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo  $this->form_encode_input($Arq_htm) ?>" target="_self" style="display: none"> 
</form>
<form name="Fdown" method="get" action="form_prod_presupuesto_periodo_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_prod_presupuesto_periodo"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="./" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nmgp_opcao" value="<?php echo $this->nmgp_opcao ?>"> 
</form> 
         </BODY>
         </HTML>
<?php
          exit;
  }
//
//--------------------------------------------------------------------------------------
   function NM_has_trans()
   {
       return !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access);
   }
//
//--------------------------------------------------------------------------------------
   function NM_commit_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->CommitTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_rollback_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->RollbackTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_close_db()
   {
       if ($this->Db && !$this->Embutida_proc)
       { 
           $this->Db->Close(); 
       } 
   }
//
//--------------------------------------------------------------------------------------
   function Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, $mode = 3) 
   {
       switch ($mode)
       {
           case 1:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 2:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta, true);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 3:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;

           case 4:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros_SweetAlert($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;
       }
   }

   function Formata_Campos_Falta($Campos_Falta, $table = false) 
   {
       $Campos_Falta = array_unique($Campos_Falta);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_reqd'] . ' ' . implode('; ', $Campos_Falta);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Falta);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Falta as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_reqd'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Crit($Campos_Crit, $table = false) 
   {
       $Campos_Crit = array_unique($Campos_Crit);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . implode('; ', $Campos_Crit);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Crit);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Crit as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_flds'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros($Campos_Erros) 
   {
       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= '<tr>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Recupera_Nome_Campo($campo) . ':</td>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', array_unique($erros)) . '</td>';
           $sError .= '</tr>';
       }

       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros_SweetAlert($Campos_Erros) 
   {
       $sError  = '';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= $this->Recupera_Nome_Campo($campo) . ': ' . implode('<br />', array_unique($erros)) . '<br />';
       }

       return $sError;
   }

   function Recupera_Nome_Campo($campo) 
   {
       switch($campo)
       {
           case 'id':
               return "ID";
               break;
           case 'id_proyecto':
               return "Proyecto";
               break;
           case 'monto_contrato':
               return "Presupuesto Del Contrato - BASE";
               break;
           case 'tipo_moneda':
               return "Tipo Moneda";
               break;
           case 'empresa':
               return "Empresa";
               break;
           case 'cliente':
               return "Cliente";
               break;
           case 'id_partida':
               return "Período Asociado";
               break;
           case 'fecha_desde':
               return "Fecha Desde - PERÍODO";
               break;
           case 'fecha_hasta':
               return "Fecha Hasta - PERÍODO";
               break;
           case 'dias_desde':
               return "Dias Mes Actual";
               break;
           case 'dias_hasta':
               return "Dias Mes Siguiente";
               break;
           case 'dias_periodo':
               return "Dias Totales Período";
               break;
           case 'fecha_desde_factura':
               return "Factura Producción Desde";
               break;
           case 'fecha_hasta_factura':
               return "Factura Producción Hasta";
               break;
           case 'avance_informado_con_iva':
               return "Monto Producción Con IVA";
               break;
           case 'produccion_neto':
               return "Monto Producción Neto";
               break;
           case 'retencion':
               return "Retención Período - Neto";
               break;
           case 'retencion_con_iva':
               return "Retencion Período - Con IVA";
               break;
           case 'retencion_acumulada':
               return "Retención Total Acumulada ";
               break;
           case 'reajuste_acumulado_con_iva':
               return "Reajuste Acumulado Con IVA";
               break;
           case 'reajuste_acumulado_neto':
               return "Reajuste Acumulado Neto";
               break;
           case 'multa':
               return "Multas EP Neto";
               break;
           case 'total_facturado':
               return "Total A Facturar EP";
               break;
           case 'afecta_iva':
               return "Afecta a IVA";
               break;
           case 'existe_retencion':
               return "Existe Retención ?";
               break;
           case 'incluye_retencion':
               return "Factura Incluye Retención ?";
               break;
           case 'considera_retencion':
               return "Retención Pertenece Al Período Informado ?";
               break;
           case 'facturado':
               return "Facturado";
               break;
           case 'observaciones_solicitud':
               return "Observaciones Estado Facturación";
               break;
           case 'iva':
               return "Monto A Facturar Con IVA";
               break;
           case 'monto_uf':
               return "Monto Neto A Facturar";
               break;
           case 'fecha':
               return "Fecha Facturación";
               break;
           case 'valor_uf':
               return "Valor Moneda Día";
               break;
           case 'observaciones':
               return "Observaciones";
               break;
           case 'factura':
               return "Documento Factura";
               break;
           case 'hitos_facturacion':
               return "Hitos Relacionados";
               break;
           case 'id_item':
               return "Item";
               break;
           case 'vigente':
               return "Vigente";
               break;
           case 'orden':
               return "Orden";
               break;
           case 'avance':
               return "Producción Total";
               break;
           case 'reajuste':
               return "Reajuste EP Neto";
               break;
           case 'factor_produccion':
               return "Factor Producción";
               break;
           case 'avance_periodo':
               return "Producción Período";
               break;
           case 'avance_periodo_siguiente':
               return "Avance Periodo Siguiente";
               break;
           case 'avance_informado':
               return "Monto Producción Neto";
               break;
           case 'avance_periodo_anterior':
               return "Avance Periodo Anterior";
               break;
           case 'produccion_total_final':
               return "Produccion Total Final";
               break;
           case 'total_facturado_ur':
               return "Total Facturado UR";
               break;
           case 'produccion_ep':
               return "Produccion EP";
               break;
           case 'reajuste_con_iva':
               return "Reajuste EP Con IVA";
               break;
           case 'modificacion_contrato':
               return "Modificación Contrato - Período";
               break;
           case 'monto_disponible':
               return "Monto Disponible";
               break;
           case 'porcentaje_retencion':
               return "Porcentaje Retención";
               break;
       }

       return $campo;
   }

   function dateDefaultFormat()
   {
       if (isset($this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']))
       {
           $sDate = str_replace('yyyy', 'Y', $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']);
           $sDate = str_replace('mm',   'm', $sDate);
           $sDate = str_replace('dd',   'd', $sDate);
           return substr(chunk_split($sDate, 1, $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_sep']), 0, -1);
       }
       elseif ('en_us' == $this->Ini->str_lang)
       {
           return 'm/d/Y';
       }
       else
       {
           return 'd/m/Y';
       }
   } // dateDefaultFormat

//
//--------------------------------------------------------------------------------------
   function Valida_campos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser, $teste_validade;
     if (is_array($filtro) && empty($filtro)) {
         $filtro = '';
     }
//---------------------------------------------------------
     $this->sc_force_zero = array();

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_prod_presupuesto_periodo']) || !is_array($this->NM_ajax_info['errList']['geral_form_prod_presupuesto_periodo']))
              {
                  $this->NM_ajax_info['errList']['geral_form_prod_presupuesto_periodo'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_prod_presupuesto_periodo'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'id' == $filtro)) || (is_array($filtro) && in_array('id', $filtro)))
        $this->ValidateField_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'id_proyecto' == $filtro)) || (is_array($filtro) && in_array('id_proyecto', $filtro)))
        $this->ValidateField_id_proyecto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'monto_contrato' == $filtro)) || (is_array($filtro) && in_array('monto_contrato', $filtro)))
        $this->ValidateField_monto_contrato($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'tipo_moneda' == $filtro)) || (is_array($filtro) && in_array('tipo_moneda', $filtro)))
        $this->ValidateField_tipo_moneda($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'empresa' == $filtro)) || (is_array($filtro) && in_array('empresa', $filtro)))
        $this->ValidateField_empresa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'cliente' == $filtro)) || (is_array($filtro) && in_array('cliente', $filtro)))
        $this->ValidateField_cliente($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'id_partida' == $filtro)) || (is_array($filtro) && in_array('id_partida', $filtro)))
        $this->ValidateField_id_partida($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'fecha_desde' == $filtro)) || (is_array($filtro) && in_array('fecha_desde', $filtro)))
        $this->ValidateField_fecha_desde($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'fecha_hasta' == $filtro)) || (is_array($filtro) && in_array('fecha_hasta', $filtro)))
        $this->ValidateField_fecha_hasta($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'dias_desde' == $filtro)) || (is_array($filtro) && in_array('dias_desde', $filtro)))
        $this->ValidateField_dias_desde($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'dias_hasta' == $filtro)) || (is_array($filtro) && in_array('dias_hasta', $filtro)))
        $this->ValidateField_dias_hasta($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'dias_periodo' == $filtro)) || (is_array($filtro) && in_array('dias_periodo', $filtro)))
        $this->ValidateField_dias_periodo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'fecha_desde_factura' == $filtro)) || (is_array($filtro) && in_array('fecha_desde_factura', $filtro)))
        $this->ValidateField_fecha_desde_factura($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'fecha_hasta_factura' == $filtro)) || (is_array($filtro) && in_array('fecha_hasta_factura', $filtro)))
        $this->ValidateField_fecha_hasta_factura($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'avance_informado_con_iva' == $filtro)) || (is_array($filtro) && in_array('avance_informado_con_iva', $filtro)))
        $this->ValidateField_avance_informado_con_iva($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'produccion_neto' == $filtro)) || (is_array($filtro) && in_array('produccion_neto', $filtro)))
        $this->ValidateField_produccion_neto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'retencion' == $filtro)) || (is_array($filtro) && in_array('retencion', $filtro)))
        $this->ValidateField_retencion($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'retencion_con_iva' == $filtro)) || (is_array($filtro) && in_array('retencion_con_iva', $filtro)))
        $this->ValidateField_retencion_con_iva($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'retencion_acumulada' == $filtro)) || (is_array($filtro) && in_array('retencion_acumulada', $filtro)))
        $this->ValidateField_retencion_acumulada($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'reajuste_acumulado_con_iva' == $filtro)) || (is_array($filtro) && in_array('reajuste_acumulado_con_iva', $filtro)))
        $this->ValidateField_reajuste_acumulado_con_iva($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'reajuste_acumulado_neto' == $filtro)) || (is_array($filtro) && in_array('reajuste_acumulado_neto', $filtro)))
        $this->ValidateField_reajuste_acumulado_neto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'multa' == $filtro)) || (is_array($filtro) && in_array('multa', $filtro)))
        $this->ValidateField_multa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'total_facturado' == $filtro)) || (is_array($filtro) && in_array('total_facturado', $filtro)))
        $this->ValidateField_total_facturado($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'considera_retencion' == $filtro)) || (is_array($filtro) && in_array('considera_retencion', $filtro)))
        $this->ValidateField_considera_retencion($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'facturado' == $filtro)) || (is_array($filtro) && in_array('facturado', $filtro)))
        $this->ValidateField_facturado($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'observaciones_solicitud' == $filtro)) || (is_array($filtro) && in_array('observaciones_solicitud', $filtro)))
        $this->ValidateField_observaciones_solicitud($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'iva' == $filtro)) || (is_array($filtro) && in_array('iva', $filtro)))
        $this->ValidateField_iva($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'monto_uf' == $filtro)) || (is_array($filtro) && in_array('monto_uf', $filtro)))
        $this->ValidateField_monto_uf($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'fecha' == $filtro)) || (is_array($filtro) && in_array('fecha', $filtro)))
        $this->ValidateField_fecha($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valor_uf' == $filtro)) || (is_array($filtro) && in_array('valor_uf', $filtro)))
        $this->ValidateField_valor_uf($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'observaciones' == $filtro)) || (is_array($filtro) && in_array('observaciones', $filtro)))
        $this->ValidateField_observaciones($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'factura' == $filtro)) || (is_array($filtro) && in_array('factura', $filtro)))
        $this->ValidateField_factura($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hitos_facturacion' == $filtro)) || (is_array($filtro) && in_array('hitos_facturacion', $filtro)))
        $this->ValidateField_hitos_facturacion($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
//-- converter datas   
          $this->nm_converte_datas();
//---
      if (!empty($Campos_Crit) || !empty($Campos_Falta) || !empty($this->Campos_Mens_erro))
      {
          if (!empty($this->sc_force_zero))
          {
              foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
              {
                  eval('$this->' . $sc_force_zero_field . ' = "";');
                  unset($this->sc_force_zero[$i_force_zero]);
              }
          }
      }
   }

    function ValidateField_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->id === "" || is_null($this->id))  
      { 
          $this->id = 0;
      } 
      nm_limpa_numero($this->id, $this->field_config['id']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->id != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['id']))
                  {
                      $Campos_Erros['id'] = array();
                  }
                  $Campos_Erros['id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['id']) || !is_array($this->NM_ajax_info['errList']['id']))
                  {
                      $this->NM_ajax_info['errList']['id'] = array();
                  }
                  $this->NM_ajax_info['errList']['id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->id, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID; " ; 
                  if (!isset($Campos_Erros['id']))
                  {
                      $Campos_Erros['id'] = array();
                  }
                  $Campos_Erros['id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['id']) || !is_array($this->NM_ajax_info['errList']['id']))
                  {
                      $this->NM_ajax_info['errList']['id'] = array();
                  }
                  $this->NM_ajax_info['errList']['id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_id

    function ValidateField_id_proyecto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if ($this->nmgp_opcao == "incluir")
   {
      if ($this->id_proyecto == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['id_proyecto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['id_proyecto'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Proyecto" ; 
          if (!isset($Campos_Erros['id_proyecto']))
          {
              $Campos_Erros['id_proyecto'] = array();
          }
          $Campos_Erros['id_proyecto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['id_proyecto']) || !is_array($this->NM_ajax_info['errList']['id_proyecto']))
          {
              $this->NM_ajax_info['errList']['id_proyecto'] = array();
          }
          $this->NM_ajax_info['errList']['id_proyecto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->id_proyecto) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']) && !in_array($this->id_proyecto, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['id_proyecto']))
              {
                  $Campos_Erros['id_proyecto'] = array();
              }
              $Campos_Erros['id_proyecto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['id_proyecto']) || !is_array($this->NM_ajax_info['errList']['id_proyecto']))
              {
                  $this->NM_ajax_info['errList']['id_proyecto'] = array();
              }
              $this->NM_ajax_info['errList']['id_proyecto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
   }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'id_proyecto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_id_proyecto

    function ValidateField_monto_contrato(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->monto_contrato === "" || is_null($this->monto_contrato))  
      { 
          $this->monto_contrato = 0;
          $this->sc_force_zero[] = 'monto_contrato';
      } 
      if (!empty($this->field_config['monto_contrato']['symbol_dec']))
      {
          nm_limpa_valor($this->monto_contrato, $this->field_config['monto_contrato']['symbol_dec'], $this->field_config['monto_contrato']['symbol_grp']) ; 
          if ('.' == substr($this->monto_contrato, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->monto_contrato, 1)))
              {
                  $this->monto_contrato = '';
              }
              else
              {
                  $this->monto_contrato = '0' . $this->monto_contrato;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->monto_contrato != '')  
          { 
              $iTestSize = 21;
              if (strlen($this->monto_contrato) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Presupuesto Del Contrato - BASE: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['monto_contrato']))
                  {
                      $Campos_Erros['monto_contrato'] = array();
                  }
                  $Campos_Erros['monto_contrato'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['monto_contrato']) || !is_array($this->NM_ajax_info['errList']['monto_contrato']))
                  {
                      $this->NM_ajax_info['errList']['monto_contrato'] = array();
                  }
                  $this->NM_ajax_info['errList']['monto_contrato'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->monto_contrato, 18, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Presupuesto Del Contrato - BASE; " ; 
                  if (!isset($Campos_Erros['monto_contrato']))
                  {
                      $Campos_Erros['monto_contrato'] = array();
                  }
                  $Campos_Erros['monto_contrato'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['monto_contrato']) || !is_array($this->NM_ajax_info['errList']['monto_contrato']))
                  {
                      $this->NM_ajax_info['errList']['monto_contrato'] = array();
                  }
                  $this->NM_ajax_info['errList']['monto_contrato'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'monto_contrato';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_monto_contrato

    function ValidateField_tipo_moneda(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->tipo_moneda == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['tipo_moneda']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['tipo_moneda'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Tipo Moneda" ; 
          if (!isset($Campos_Erros['tipo_moneda']))
          {
              $Campos_Erros['tipo_moneda'] = array();
          }
          $Campos_Erros['tipo_moneda'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['tipo_moneda']) || !is_array($this->NM_ajax_info['errList']['tipo_moneda']))
          {
              $this->NM_ajax_info['errList']['tipo_moneda'] = array();
          }
          $this->NM_ajax_info['errList']['tipo_moneda'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->tipo_moneda) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']) && !in_array($this->tipo_moneda, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tipo_moneda']))
              {
                  $Campos_Erros['tipo_moneda'] = array();
              }
              $Campos_Erros['tipo_moneda'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tipo_moneda']) || !is_array($this->NM_ajax_info['errList']['tipo_moneda']))
              {
                  $this->NM_ajax_info['errList']['tipo_moneda'] = array();
              }
              $this->NM_ajax_info['errList']['tipo_moneda'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tipo_moneda';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tipo_moneda

    function ValidateField_empresa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->empresa == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['empresa']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['empresa'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Empresa" ; 
          if (!isset($Campos_Erros['empresa']))
          {
              $Campos_Erros['empresa'] = array();
          }
          $Campos_Erros['empresa'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['empresa']) || !is_array($this->NM_ajax_info['errList']['empresa']))
          {
              $this->NM_ajax_info['errList']['empresa'] = array();
          }
          $this->NM_ajax_info['errList']['empresa'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->empresa) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']) && !in_array($this->empresa, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['empresa']))
              {
                  $Campos_Erros['empresa'] = array();
              }
              $Campos_Erros['empresa'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['empresa']) || !is_array($this->NM_ajax_info['errList']['empresa']))
              {
                  $this->NM_ajax_info['errList']['empresa'] = array();
              }
              $this->NM_ajax_info['errList']['empresa'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'empresa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_empresa

    function ValidateField_cliente(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->cliente == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['cliente']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['cliente'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Cliente" ; 
          if (!isset($Campos_Erros['cliente']))
          {
              $Campos_Erros['cliente'] = array();
          }
          $Campos_Erros['cliente'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['cliente']) || !is_array($this->NM_ajax_info['errList']['cliente']))
          {
              $this->NM_ajax_info['errList']['cliente'] = array();
          }
          $this->NM_ajax_info['errList']['cliente'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->cliente) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']) && !in_array($this->cliente, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['cliente']))
              {
                  $Campos_Erros['cliente'] = array();
              }
              $Campos_Erros['cliente'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['cliente']) || !is_array($this->NM_ajax_info['errList']['cliente']))
              {
                  $this->NM_ajax_info['errList']['cliente'] = array();
              }
              $this->NM_ajax_info['errList']['cliente'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cliente';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cliente

    function ValidateField_id_partida(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if ($this->nmgp_opcao == "incluir")
   {
      if ($this->id_partida == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['id_partida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['id_partida'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Período Asociado" ; 
          if (!isset($Campos_Erros['id_partida']))
          {
              $Campos_Erros['id_partida'] = array();
          }
          $Campos_Erros['id_partida'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['id_partida']) || !is_array($this->NM_ajax_info['errList']['id_partida']))
          {
              $this->NM_ajax_info['errList']['id_partida'] = array();
          }
          $this->NM_ajax_info['errList']['id_partida'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->id_partida) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']) && !in_array($this->id_partida, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['id_partida']))
              {
                  $Campos_Erros['id_partida'] = array();
              }
              $Campos_Erros['id_partida'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['id_partida']) || !is_array($this->NM_ajax_info['errList']['id_partida']))
              {
                  $this->NM_ajax_info['errList']['id_partida'] = array();
              }
              $this->NM_ajax_info['errList']['id_partida'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
   }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'id_partida';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_id_partida

    function ValidateField_fecha_desde(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->fecha_desde, $this->field_config['fecha_desde']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['fecha_desde']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['fecha_desde']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['fecha_desde']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['fecha_desde']['date_sep']) ; 
          if (trim($this->fecha_desde) != "")  
          { 
              if ($teste_validade->Data($this->fecha_desde, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fecha Desde - PERÍODO; " ; 
                  if (!isset($Campos_Erros['fecha_desde']))
                  {
                      $Campos_Erros['fecha_desde'] = array();
                  }
                  $Campos_Erros['fecha_desde'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['fecha_desde']) || !is_array($this->NM_ajax_info['errList']['fecha_desde']))
                  {
                      $this->NM_ajax_info['errList']['fecha_desde'] = array();
                  }
                  $this->NM_ajax_info['errList']['fecha_desde'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['fecha_desde']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['fecha_desde'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Fecha Desde - PERÍODO" ; 
              if (!isset($Campos_Erros['fecha_desde']))
              {
                  $Campos_Erros['fecha_desde'] = array();
              }
              $Campos_Erros['fecha_desde'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['fecha_desde']) || !is_array($this->NM_ajax_info['errList']['fecha_desde']))
                  {
                      $this->NM_ajax_info['errList']['fecha_desde'] = array();
                  }
                  $this->NM_ajax_info['errList']['fecha_desde'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
          $this->field_config['fecha_desde']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'fecha_desde';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_fecha_desde

    function ValidateField_fecha_hasta(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->fecha_hasta, $this->field_config['fecha_hasta']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['fecha_hasta']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['fecha_hasta']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['fecha_hasta']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['fecha_hasta']['date_sep']) ; 
          if (trim($this->fecha_hasta) != "")  
          { 
              if ($teste_validade->Data($this->fecha_hasta, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fecha Hasta - PERÍODO; " ; 
                  if (!isset($Campos_Erros['fecha_hasta']))
                  {
                      $Campos_Erros['fecha_hasta'] = array();
                  }
                  $Campos_Erros['fecha_hasta'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['fecha_hasta']) || !is_array($this->NM_ajax_info['errList']['fecha_hasta']))
                  {
                      $this->NM_ajax_info['errList']['fecha_hasta'] = array();
                  }
                  $this->NM_ajax_info['errList']['fecha_hasta'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['fecha_hasta']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['fecha_hasta'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Fecha Hasta - PERÍODO" ; 
              if (!isset($Campos_Erros['fecha_hasta']))
              {
                  $Campos_Erros['fecha_hasta'] = array();
              }
              $Campos_Erros['fecha_hasta'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['fecha_hasta']) || !is_array($this->NM_ajax_info['errList']['fecha_hasta']))
                  {
                      $this->NM_ajax_info['errList']['fecha_hasta'] = array();
                  }
                  $this->NM_ajax_info['errList']['fecha_hasta'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
          $this->field_config['fecha_hasta']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'fecha_hasta';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_fecha_hasta

    function ValidateField_dias_desde(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->dias_desde === "" || is_null($this->dias_desde))  
      { 
          $this->dias_desde = 0;
          $this->sc_force_zero[] = 'dias_desde';
      } 
      nm_limpa_numero($this->dias_desde, $this->field_config['dias_desde']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->dias_desde != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->dias_desde) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dias Mes Actual: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['dias_desde']))
                  {
                      $Campos_Erros['dias_desde'] = array();
                  }
                  $Campos_Erros['dias_desde'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['dias_desde']) || !is_array($this->NM_ajax_info['errList']['dias_desde']))
                  {
                      $this->NM_ajax_info['errList']['dias_desde'] = array();
                  }
                  $this->NM_ajax_info['errList']['dias_desde'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->dias_desde, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dias Mes Actual; " ; 
                  if (!isset($Campos_Erros['dias_desde']))
                  {
                      $Campos_Erros['dias_desde'] = array();
                  }
                  $Campos_Erros['dias_desde'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dias_desde']) || !is_array($this->NM_ajax_info['errList']['dias_desde']))
                  {
                      $this->NM_ajax_info['errList']['dias_desde'] = array();
                  }
                  $this->NM_ajax_info['errList']['dias_desde'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dias_desde';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dias_desde

    function ValidateField_dias_hasta(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->dias_hasta === "" || is_null($this->dias_hasta))  
      { 
          $this->dias_hasta = 0;
          $this->sc_force_zero[] = 'dias_hasta';
      } 
      nm_limpa_numero($this->dias_hasta, $this->field_config['dias_hasta']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->dias_hasta != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->dias_hasta) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dias Mes Siguiente: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['dias_hasta']))
                  {
                      $Campos_Erros['dias_hasta'] = array();
                  }
                  $Campos_Erros['dias_hasta'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['dias_hasta']) || !is_array($this->NM_ajax_info['errList']['dias_hasta']))
                  {
                      $this->NM_ajax_info['errList']['dias_hasta'] = array();
                  }
                  $this->NM_ajax_info['errList']['dias_hasta'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->dias_hasta, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dias Mes Siguiente; " ; 
                  if (!isset($Campos_Erros['dias_hasta']))
                  {
                      $Campos_Erros['dias_hasta'] = array();
                  }
                  $Campos_Erros['dias_hasta'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dias_hasta']) || !is_array($this->NM_ajax_info['errList']['dias_hasta']))
                  {
                      $this->NM_ajax_info['errList']['dias_hasta'] = array();
                  }
                  $this->NM_ajax_info['errList']['dias_hasta'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dias_hasta';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dias_hasta

    function ValidateField_dias_periodo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->dias_periodo === "" || is_null($this->dias_periodo))  
      { 
          $this->dias_periodo = 0;
          $this->sc_force_zero[] = 'dias_periodo';
      } 
      nm_limpa_numero($this->dias_periodo, $this->field_config['dias_periodo']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->dias_periodo != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->dias_periodo) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dias Totales Período: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['dias_periodo']))
                  {
                      $Campos_Erros['dias_periodo'] = array();
                  }
                  $Campos_Erros['dias_periodo'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['dias_periodo']) || !is_array($this->NM_ajax_info['errList']['dias_periodo']))
                  {
                      $this->NM_ajax_info['errList']['dias_periodo'] = array();
                  }
                  $this->NM_ajax_info['errList']['dias_periodo'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->dias_periodo, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dias Totales Período; " ; 
                  if (!isset($Campos_Erros['dias_periodo']))
                  {
                      $Campos_Erros['dias_periodo'] = array();
                  }
                  $Campos_Erros['dias_periodo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dias_periodo']) || !is_array($this->NM_ajax_info['errList']['dias_periodo']))
                  {
                      $this->NM_ajax_info['errList']['dias_periodo'] = array();
                  }
                  $this->NM_ajax_info['errList']['dias_periodo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dias_periodo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dias_periodo

    function ValidateField_fecha_desde_factura(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->fecha_desde_factura, $this->field_config['fecha_desde_factura']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['fecha_desde_factura']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['fecha_desde_factura']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['fecha_desde_factura']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['fecha_desde_factura']['date_sep']) ; 
          if (trim($this->fecha_desde_factura) != "")  
          { 
              if ($teste_validade->Data($this->fecha_desde_factura, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Factura Producción Desde; " ; 
                  if (!isset($Campos_Erros['fecha_desde_factura']))
                  {
                      $Campos_Erros['fecha_desde_factura'] = array();
                  }
                  $Campos_Erros['fecha_desde_factura'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['fecha_desde_factura']) || !is_array($this->NM_ajax_info['errList']['fecha_desde_factura']))
                  {
                      $this->NM_ajax_info['errList']['fecha_desde_factura'] = array();
                  }
                  $this->NM_ajax_info['errList']['fecha_desde_factura'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['fecha_desde_factura']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'fecha_desde_factura';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_fecha_desde_factura

    function ValidateField_fecha_hasta_factura(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->fecha_hasta_factura, $this->field_config['fecha_hasta_factura']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['fecha_hasta_factura']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['fecha_hasta_factura']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['fecha_hasta_factura']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['fecha_hasta_factura']['date_sep']) ; 
          if (trim($this->fecha_hasta_factura) != "")  
          { 
              if ($teste_validade->Data($this->fecha_hasta_factura, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Factura Producción Hasta; " ; 
                  if (!isset($Campos_Erros['fecha_hasta_factura']))
                  {
                      $Campos_Erros['fecha_hasta_factura'] = array();
                  }
                  $Campos_Erros['fecha_hasta_factura'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['fecha_hasta_factura']) || !is_array($this->NM_ajax_info['errList']['fecha_hasta_factura']))
                  {
                      $this->NM_ajax_info['errList']['fecha_hasta_factura'] = array();
                  }
                  $this->NM_ajax_info['errList']['fecha_hasta_factura'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['fecha_hasta_factura']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'fecha_hasta_factura';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_fecha_hasta_factura

    function ValidateField_avance_informado_con_iva(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->avance_informado_con_iva === "" || is_null($this->avance_informado_con_iva))  
      { 
          $this->avance_informado_con_iva = 0;
          $this->sc_force_zero[] = 'avance_informado_con_iva';
      } 
      if (!empty($this->field_config['avance_informado_con_iva']['symbol_dec']))
      {
          nm_limpa_valor($this->avance_informado_con_iva, $this->field_config['avance_informado_con_iva']['symbol_dec'], $this->field_config['avance_informado_con_iva']['symbol_grp']) ; 
          if ('.' == substr($this->avance_informado_con_iva, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->avance_informado_con_iva, 1)))
              {
                  $this->avance_informado_con_iva = '';
              }
              else
              {
                  $this->avance_informado_con_iva = '0' . $this->avance_informado_con_iva;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->avance_informado_con_iva != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->avance_informado_con_iva) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Monto Producción Con IVA: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['avance_informado_con_iva']))
                  {
                      $Campos_Erros['avance_informado_con_iva'] = array();
                  }
                  $Campos_Erros['avance_informado_con_iva'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['avance_informado_con_iva']) || !is_array($this->NM_ajax_info['errList']['avance_informado_con_iva']))
                  {
                      $this->NM_ajax_info['errList']['avance_informado_con_iva'] = array();
                  }
                  $this->NM_ajax_info['errList']['avance_informado_con_iva'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->avance_informado_con_iva, 10, 1, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Monto Producción Con IVA; " ; 
                  if (!isset($Campos_Erros['avance_informado_con_iva']))
                  {
                      $Campos_Erros['avance_informado_con_iva'] = array();
                  }
                  $Campos_Erros['avance_informado_con_iva'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['avance_informado_con_iva']) || !is_array($this->NM_ajax_info['errList']['avance_informado_con_iva']))
                  {
                      $this->NM_ajax_info['errList']['avance_informado_con_iva'] = array();
                  }
                  $this->NM_ajax_info['errList']['avance_informado_con_iva'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'avance_informado_con_iva';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_avance_informado_con_iva

    function ValidateField_produccion_neto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->produccion_neto === "" || is_null($this->produccion_neto))  
      { 
          $this->produccion_neto = 0;
          $this->sc_force_zero[] = 'produccion_neto';
      } 
      if (!empty($this->field_config['produccion_neto']['symbol_dec']))
      {
          $this->sc_remove_currency($this->produccion_neto, $this->field_config['produccion_neto']['symbol_dec'], $this->field_config['produccion_neto']['symbol_grp'], $this->field_config['produccion_neto']['symbol_mon']); 
          nm_limpa_valor($this->produccion_neto, $this->field_config['produccion_neto']['symbol_dec'], $this->field_config['produccion_neto']['symbol_grp']) ; 
          if ('.' == substr($this->produccion_neto, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->produccion_neto, 1)))
              {
                  $this->produccion_neto = '';
              }
              else
              {
                  $this->produccion_neto = '0' . $this->produccion_neto;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->produccion_neto != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->produccion_neto) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Monto Producción Neto: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['produccion_neto']))
                  {
                      $Campos_Erros['produccion_neto'] = array();
                  }
                  $Campos_Erros['produccion_neto'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['produccion_neto']) || !is_array($this->NM_ajax_info['errList']['produccion_neto']))
                  {
                      $this->NM_ajax_info['errList']['produccion_neto'] = array();
                  }
                  $this->NM_ajax_info['errList']['produccion_neto'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->produccion_neto, 10, 1, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Monto Producción Neto; " ; 
                  if (!isset($Campos_Erros['produccion_neto']))
                  {
                      $Campos_Erros['produccion_neto'] = array();
                  }
                  $Campos_Erros['produccion_neto'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['produccion_neto']) || !is_array($this->NM_ajax_info['errList']['produccion_neto']))
                  {
                      $this->NM_ajax_info['errList']['produccion_neto'] = array();
                  }
                  $this->NM_ajax_info['errList']['produccion_neto'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'produccion_neto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_produccion_neto

    function ValidateField_retencion(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->retencion === "" || is_null($this->retencion))  
      { 
          $this->retencion = 0;
          $this->sc_force_zero[] = 'retencion';
      } 
      if (!empty($this->field_config['retencion']['symbol_dec']))
      {
          $this->sc_remove_currency($this->retencion, $this->field_config['retencion']['symbol_dec'], $this->field_config['retencion']['symbol_grp'], $this->field_config['retencion']['symbol_mon']); 
          nm_limpa_valor($this->retencion, $this->field_config['retencion']['symbol_dec'], $this->field_config['retencion']['symbol_grp']) ; 
          if ('.' == substr($this->retencion, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->retencion, 1)))
              {
                  $this->retencion = '';
              }
              else
              {
                  $this->retencion = '0' . $this->retencion;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->retencion != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->retencion) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Retención Período - Neto: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['retencion']))
                  {
                      $Campos_Erros['retencion'] = array();
                  }
                  $Campos_Erros['retencion'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['retencion']) || !is_array($this->NM_ajax_info['errList']['retencion']))
                  {
                      $this->NM_ajax_info['errList']['retencion'] = array();
                  }
                  $this->NM_ajax_info['errList']['retencion'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->retencion, 10, 1, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Retención Período - Neto; " ; 
                  if (!isset($Campos_Erros['retencion']))
                  {
                      $Campos_Erros['retencion'] = array();
                  }
                  $Campos_Erros['retencion'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['retencion']) || !is_array($this->NM_ajax_info['errList']['retencion']))
                  {
                      $this->NM_ajax_info['errList']['retencion'] = array();
                  }
                  $this->NM_ajax_info['errList']['retencion'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'retencion';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_retencion

    function ValidateField_retencion_con_iva(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->retencion_con_iva === "" || is_null($this->retencion_con_iva))  
      { 
          $this->retencion_con_iva = 0;
          $this->sc_force_zero[] = 'retencion_con_iva';
      } 
      if (!empty($this->field_config['retencion_con_iva']['symbol_dec']))
      {
          $this->sc_remove_currency($this->retencion_con_iva, $this->field_config['retencion_con_iva']['symbol_dec'], $this->field_config['retencion_con_iva']['symbol_grp'], $this->field_config['retencion_con_iva']['symbol_mon']); 
          nm_limpa_valor($this->retencion_con_iva, $this->field_config['retencion_con_iva']['symbol_dec'], $this->field_config['retencion_con_iva']['symbol_grp']) ; 
          if ('.' == substr($this->retencion_con_iva, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->retencion_con_iva, 1)))
              {
                  $this->retencion_con_iva = '';
              }
              else
              {
                  $this->retencion_con_iva = '0' . $this->retencion_con_iva;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->retencion_con_iva != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->retencion_con_iva) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Retencion Período - Con IVA: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['retencion_con_iva']))
                  {
                      $Campos_Erros['retencion_con_iva'] = array();
                  }
                  $Campos_Erros['retencion_con_iva'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['retencion_con_iva']) || !is_array($this->NM_ajax_info['errList']['retencion_con_iva']))
                  {
                      $this->NM_ajax_info['errList']['retencion_con_iva'] = array();
                  }
                  $this->NM_ajax_info['errList']['retencion_con_iva'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->retencion_con_iva, 10, 1, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Retencion Período - Con IVA; " ; 
                  if (!isset($Campos_Erros['retencion_con_iva']))
                  {
                      $Campos_Erros['retencion_con_iva'] = array();
                  }
                  $Campos_Erros['retencion_con_iva'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['retencion_con_iva']) || !is_array($this->NM_ajax_info['errList']['retencion_con_iva']))
                  {
                      $this->NM_ajax_info['errList']['retencion_con_iva'] = array();
                  }
                  $this->NM_ajax_info['errList']['retencion_con_iva'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'retencion_con_iva';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_retencion_con_iva

    function ValidateField_retencion_acumulada(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->retencion_acumulada === "" || is_null($this->retencion_acumulada))  
      { 
          $this->retencion_acumulada = 0;
          $this->sc_force_zero[] = 'retencion_acumulada';
      } 
      nm_limpa_numero($this->retencion_acumulada, $this->field_config['retencion_acumulada']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->retencion_acumulada != '')  
          { 
              $iTestSize = 20;
              if ('-' == substr($this->retencion_acumulada, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->retencion_acumulada, -1))
              {
                  $iTestSize++;
                  $this->retencion_acumulada = '-' . substr($this->retencion_acumulada, 0, -1);
              }
              if (strlen($this->retencion_acumulada) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Retención Total Acumulada : " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['retencion_acumulada']))
                  {
                      $Campos_Erros['retencion_acumulada'] = array();
                  }
                  $Campos_Erros['retencion_acumulada'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['retencion_acumulada']) || !is_array($this->NM_ajax_info['errList']['retencion_acumulada']))
                  {
                      $this->NM_ajax_info['errList']['retencion_acumulada'] = array();
                  }
                  $this->NM_ajax_info['errList']['retencion_acumulada'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->retencion_acumulada, 20, 0, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Retención Total Acumulada ; " ; 
                  if (!isset($Campos_Erros['retencion_acumulada']))
                  {
                      $Campos_Erros['retencion_acumulada'] = array();
                  }
                  $Campos_Erros['retencion_acumulada'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['retencion_acumulada']) || !is_array($this->NM_ajax_info['errList']['retencion_acumulada']))
                  {
                      $this->NM_ajax_info['errList']['retencion_acumulada'] = array();
                  }
                  $this->NM_ajax_info['errList']['retencion_acumulada'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'retencion_acumulada';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_retencion_acumulada

    function ValidateField_reajuste_acumulado_con_iva(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->reajuste_acumulado_con_iva === "" || is_null($this->reajuste_acumulado_con_iva))  
      { 
          $this->reajuste_acumulado_con_iva = 0;
          $this->sc_force_zero[] = 'reajuste_acumulado_con_iva';
      } 
      if (!empty($this->field_config['reajuste_acumulado_con_iva']['symbol_dec']))
      {
          $this->sc_remove_currency($this->reajuste_acumulado_con_iva, $this->field_config['reajuste_acumulado_con_iva']['symbol_dec'], $this->field_config['reajuste_acumulado_con_iva']['symbol_grp'], $this->field_config['reajuste_acumulado_con_iva']['symbol_mon']); 
          nm_limpa_valor($this->reajuste_acumulado_con_iva, $this->field_config['reajuste_acumulado_con_iva']['symbol_dec'], $this->field_config['reajuste_acumulado_con_iva']['symbol_grp']) ; 
          if ('.' == substr($this->reajuste_acumulado_con_iva, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->reajuste_acumulado_con_iva, 1)))
              {
                  $this->reajuste_acumulado_con_iva = '';
              }
              else
              {
                  $this->reajuste_acumulado_con_iva = '0' . $this->reajuste_acumulado_con_iva;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->reajuste_acumulado_con_iva != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->reajuste_acumulado_con_iva) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Reajuste Acumulado Con IVA: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['reajuste_acumulado_con_iva']))
                  {
                      $Campos_Erros['reajuste_acumulado_con_iva'] = array();
                  }
                  $Campos_Erros['reajuste_acumulado_con_iva'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['reajuste_acumulado_con_iva']) || !is_array($this->NM_ajax_info['errList']['reajuste_acumulado_con_iva']))
                  {
                      $this->NM_ajax_info['errList']['reajuste_acumulado_con_iva'] = array();
                  }
                  $this->NM_ajax_info['errList']['reajuste_acumulado_con_iva'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->reajuste_acumulado_con_iva, 10, 1, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Reajuste Acumulado Con IVA; " ; 
                  if (!isset($Campos_Erros['reajuste_acumulado_con_iva']))
                  {
                      $Campos_Erros['reajuste_acumulado_con_iva'] = array();
                  }
                  $Campos_Erros['reajuste_acumulado_con_iva'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['reajuste_acumulado_con_iva']) || !is_array($this->NM_ajax_info['errList']['reajuste_acumulado_con_iva']))
                  {
                      $this->NM_ajax_info['errList']['reajuste_acumulado_con_iva'] = array();
                  }
                  $this->NM_ajax_info['errList']['reajuste_acumulado_con_iva'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'reajuste_acumulado_con_iva';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_reajuste_acumulado_con_iva

    function ValidateField_reajuste_acumulado_neto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->reajuste_acumulado_neto === "" || is_null($this->reajuste_acumulado_neto))  
      { 
          $this->reajuste_acumulado_neto = 0;
          $this->sc_force_zero[] = 'reajuste_acumulado_neto';
      } 
      if (!empty($this->field_config['reajuste_acumulado_neto']['symbol_dec']))
      {
          $this->sc_remove_currency($this->reajuste_acumulado_neto, $this->field_config['reajuste_acumulado_neto']['symbol_dec'], $this->field_config['reajuste_acumulado_neto']['symbol_grp'], $this->field_config['reajuste_acumulado_neto']['symbol_mon']); 
          nm_limpa_valor($this->reajuste_acumulado_neto, $this->field_config['reajuste_acumulado_neto']['symbol_dec'], $this->field_config['reajuste_acumulado_neto']['symbol_grp']) ; 
          if ('.' == substr($this->reajuste_acumulado_neto, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->reajuste_acumulado_neto, 1)))
              {
                  $this->reajuste_acumulado_neto = '';
              }
              else
              {
                  $this->reajuste_acumulado_neto = '0' . $this->reajuste_acumulado_neto;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->reajuste_acumulado_neto != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->reajuste_acumulado_neto) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Reajuste Acumulado Neto: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['reajuste_acumulado_neto']))
                  {
                      $Campos_Erros['reajuste_acumulado_neto'] = array();
                  }
                  $Campos_Erros['reajuste_acumulado_neto'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['reajuste_acumulado_neto']) || !is_array($this->NM_ajax_info['errList']['reajuste_acumulado_neto']))
                  {
                      $this->NM_ajax_info['errList']['reajuste_acumulado_neto'] = array();
                  }
                  $this->NM_ajax_info['errList']['reajuste_acumulado_neto'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->reajuste_acumulado_neto, 10, 1, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Reajuste Acumulado Neto; " ; 
                  if (!isset($Campos_Erros['reajuste_acumulado_neto']))
                  {
                      $Campos_Erros['reajuste_acumulado_neto'] = array();
                  }
                  $Campos_Erros['reajuste_acumulado_neto'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['reajuste_acumulado_neto']) || !is_array($this->NM_ajax_info['errList']['reajuste_acumulado_neto']))
                  {
                      $this->NM_ajax_info['errList']['reajuste_acumulado_neto'] = array();
                  }
                  $this->NM_ajax_info['errList']['reajuste_acumulado_neto'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'reajuste_acumulado_neto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_reajuste_acumulado_neto

    function ValidateField_multa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->multa === "" || is_null($this->multa))  
      { 
          $this->multa = 0;
          $this->sc_force_zero[] = 'multa';
      } 
      if (!empty($this->field_config['multa']['symbol_dec']))
      {
          $this->sc_remove_currency($this->multa, $this->field_config['multa']['symbol_dec'], $this->field_config['multa']['symbol_grp'], $this->field_config['multa']['symbol_mon']); 
          nm_limpa_valor($this->multa, $this->field_config['multa']['symbol_dec'], $this->field_config['multa']['symbol_grp']) ; 
          if ('.' == substr($this->multa, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->multa, 1)))
              {
                  $this->multa = '';
              }
              else
              {
                  $this->multa = '0' . $this->multa;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->multa != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->multa) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Multas EP Neto: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['multa']))
                  {
                      $Campos_Erros['multa'] = array();
                  }
                  $Campos_Erros['multa'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['multa']) || !is_array($this->NM_ajax_info['errList']['multa']))
                  {
                      $this->NM_ajax_info['errList']['multa'] = array();
                  }
                  $this->NM_ajax_info['errList']['multa'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->multa, 9, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Multas EP Neto; " ; 
                  if (!isset($Campos_Erros['multa']))
                  {
                      $Campos_Erros['multa'] = array();
                  }
                  $Campos_Erros['multa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['multa']) || !is_array($this->NM_ajax_info['errList']['multa']))
                  {
                      $this->NM_ajax_info['errList']['multa'] = array();
                  }
                  $this->NM_ajax_info['errList']['multa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'multa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_multa

    function ValidateField_total_facturado(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->total_facturado === "" || is_null($this->total_facturado))  
      { 
          $this->total_facturado = 0;
          $this->sc_force_zero[] = 'total_facturado';
      } 
      nm_limpa_numero($this->total_facturado, $this->field_config['total_facturado']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->total_facturado != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->total_facturado) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Total A Facturar EP: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['total_facturado']))
                  {
                      $Campos_Erros['total_facturado'] = array();
                  }
                  $Campos_Erros['total_facturado'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['total_facturado']) || !is_array($this->NM_ajax_info['errList']['total_facturado']))
                  {
                      $this->NM_ajax_info['errList']['total_facturado'] = array();
                  }
                  $this->NM_ajax_info['errList']['total_facturado'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->total_facturado, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Total A Facturar EP; " ; 
                  if (!isset($Campos_Erros['total_facturado']))
                  {
                      $Campos_Erros['total_facturado'] = array();
                  }
                  $Campos_Erros['total_facturado'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['total_facturado']) || !is_array($this->NM_ajax_info['errList']['total_facturado']))
                  {
                      $this->NM_ajax_info['errList']['total_facturado'] = array();
                  }
                  $this->NM_ajax_info['errList']['total_facturado'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'total_facturado';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_total_facturado

    function ValidateField_considera_retencion(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->considera_retencion == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->considera_retencion === "" || is_null($this->considera_retencion))  
      { 
          $this->considera_retencion = 0;
          $this->sc_force_zero[] = 'considera_retencion';
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'considera_retencion';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_considera_retencion

    function ValidateField_facturado(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
               if (!empty($this->facturado) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']) && !in_array($this->facturado, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['facturado']))
                   {
                       $Campos_Erros['facturado'] = array();
                   }
                   $Campos_Erros['facturado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['facturado']) || !is_array($this->NM_ajax_info['errList']['facturado']))
                   {
                       $this->NM_ajax_info['errList']['facturado'] = array();
                   }
                   $this->NM_ajax_info['errList']['facturado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'facturado';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_facturado

    function ValidateField_observaciones_solicitud(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->observaciones_solicitud) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Observaciones Estado Facturación " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['observaciones_solicitud']))
              {
                  $Campos_Erros['observaciones_solicitud'] = array();
              }
              $Campos_Erros['observaciones_solicitud'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['observaciones_solicitud']) || !is_array($this->NM_ajax_info['errList']['observaciones_solicitud']))
              {
                  $this->NM_ajax_info['errList']['observaciones_solicitud'] = array();
              }
              $this->NM_ajax_info['errList']['observaciones_solicitud'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'observaciones_solicitud';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_observaciones_solicitud

    function ValidateField_iva(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->iva === "" || is_null($this->iva))  
      { 
          $this->iva = 0;
          $this->sc_force_zero[] = 'iva';
      } 
      if (!empty($this->field_config['iva']['symbol_dec']))
      {
          nm_limpa_valor($this->iva, $this->field_config['iva']['symbol_dec'], $this->field_config['iva']['symbol_grp']) ; 
          if ('.' == substr($this->iva, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->iva, 1)))
              {
                  $this->iva = '';
              }
              else
              {
                  $this->iva = '0' . $this->iva;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->iva != '')  
          { 
              $iTestSize = 21;
              if ('-' == substr($this->iva, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->iva, -1))
              {
                  $iTestSize++;
                  $this->iva = '-' . substr($this->iva, 0, -1);
              }
              if (strlen($this->iva) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Monto A Facturar Con IVA: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['iva']))
                  {
                      $Campos_Erros['iva'] = array();
                  }
                  $Campos_Erros['iva'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['iva']) || !is_array($this->NM_ajax_info['errList']['iva']))
                  {
                      $this->NM_ajax_info['errList']['iva'] = array();
                  }
                  $this->NM_ajax_info['errList']['iva'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->iva, 19, 1, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Monto A Facturar Con IVA; " ; 
                  if (!isset($Campos_Erros['iva']))
                  {
                      $Campos_Erros['iva'] = array();
                  }
                  $Campos_Erros['iva'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['iva']) || !is_array($this->NM_ajax_info['errList']['iva']))
                  {
                      $this->NM_ajax_info['errList']['iva'] = array();
                  }
                  $this->NM_ajax_info['errList']['iva'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'iva';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_iva

    function ValidateField_monto_uf(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->monto_uf === "" || is_null($this->monto_uf))  
      { 
          $this->monto_uf = 0;
          $this->sc_force_zero[] = 'monto_uf';
      } 
      if (!empty($this->field_config['monto_uf']['symbol_dec']))
      {
          nm_limpa_valor($this->monto_uf, $this->field_config['monto_uf']['symbol_dec'], $this->field_config['monto_uf']['symbol_grp']) ; 
          if ('.' == substr($this->monto_uf, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->monto_uf, 1)))
              {
                  $this->monto_uf = '';
              }
              else
              {
                  $this->monto_uf = '0' . $this->monto_uf;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->monto_uf != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->monto_uf) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Monto Neto A Facturar: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['monto_uf']))
                  {
                      $Campos_Erros['monto_uf'] = array();
                  }
                  $Campos_Erros['monto_uf'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['monto_uf']) || !is_array($this->NM_ajax_info['errList']['monto_uf']))
                  {
                      $this->NM_ajax_info['errList']['monto_uf'] = array();
                  }
                  $this->NM_ajax_info['errList']['monto_uf'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->monto_uf, 10, 1, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Monto Neto A Facturar; " ; 
                  if (!isset($Campos_Erros['monto_uf']))
                  {
                      $Campos_Erros['monto_uf'] = array();
                  }
                  $Campos_Erros['monto_uf'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['monto_uf']) || !is_array($this->NM_ajax_info['errList']['monto_uf']))
                  {
                      $this->NM_ajax_info['errList']['monto_uf'] = array();
                  }
                  $this->NM_ajax_info['errList']['monto_uf'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'monto_uf';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_monto_uf

    function ValidateField_fecha(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->fecha, $this->field_config['fecha']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['fecha']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['fecha']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['fecha']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['fecha']['date_sep']) ; 
          if (trim($this->fecha) != "")  
          { 
              if ($teste_validade->Data($this->fecha, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fecha Facturación; " ; 
                  if (!isset($Campos_Erros['fecha']))
                  {
                      $Campos_Erros['fecha'] = array();
                  }
                  $Campos_Erros['fecha'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['fecha']) || !is_array($this->NM_ajax_info['errList']['fecha']))
                  {
                      $this->NM_ajax_info['errList']['fecha'] = array();
                  }
                  $this->NM_ajax_info['errList']['fecha'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['fecha']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'fecha';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_fecha

    function ValidateField_valor_uf(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->valor_uf === "" || is_null($this->valor_uf))  
      { 
          $this->valor_uf = 0;
          $this->sc_force_zero[] = 'valor_uf';
      } 
      if (!empty($this->field_config['valor_uf']['symbol_dec']))
      {
          nm_limpa_valor($this->valor_uf, $this->field_config['valor_uf']['symbol_dec'], $this->field_config['valor_uf']['symbol_grp']) ; 
          if ('.' == substr($this->valor_uf, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valor_uf, 1)))
              {
                  $this->valor_uf = '';
              }
              else
              {
                  $this->valor_uf = '0' . $this->valor_uf;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valor_uf != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->valor_uf) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Moneda Día: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valor_uf']))
                  {
                      $Campos_Erros['valor_uf'] = array();
                  }
                  $Campos_Erros['valor_uf'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valor_uf']) || !is_array($this->NM_ajax_info['errList']['valor_uf']))
                  {
                      $this->NM_ajax_info['errList']['valor_uf'] = array();
                  }
                  $this->NM_ajax_info['errList']['valor_uf'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valor_uf, 9, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Moneda Día; " ; 
                  if (!isset($Campos_Erros['valor_uf']))
                  {
                      $Campos_Erros['valor_uf'] = array();
                  }
                  $Campos_Erros['valor_uf'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valor_uf']) || !is_array($this->NM_ajax_info['errList']['valor_uf']))
                  {
                      $this->NM_ajax_info['errList']['valor_uf'] = array();
                  }
                  $this->NM_ajax_info['errList']['valor_uf'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valor_uf';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valor_uf

    function ValidateField_observaciones(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->observaciones) > 2000) 
          { 
              $hasError = true;
              $Campos_Crit .= "Observaciones " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 2000 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['observaciones']))
              {
                  $Campos_Erros['observaciones'] = array();
              }
              $Campos_Erros['observaciones'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 2000 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['observaciones']) || !is_array($this->NM_ajax_info['errList']['observaciones']))
              {
                  $this->NM_ajax_info['errList']['observaciones'] = array();
              }
              $this->NM_ajax_info['errList']['observaciones'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 2000 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'observaciones';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_observaciones

    function ValidateField_factura(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->factura;
            if (!function_exists('sc_upload_unprotect_chars'))
            {
                include_once 'form_prod_presupuesto_periodo_doc_name.php';
            }
            $this->factura = sc_upload_unprotect_chars($this->factura, true);
            $this->factura_scfile_name = sc_upload_unprotect_chars($this->factura_scfile_name, true);
            if ("" != $this->factura && "S" != $this->factura_limpa && !$teste_validade->ArqExtensao($this->factura, array()))
            {
                $hasError = true;
                $Campos_Crit .= "Documento Factura: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['factura']))
                {
                    $Campos_Erros['factura'] = array();
                }
                $Campos_Erros['factura'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['factura']) || !is_array($this->NM_ajax_info['errList']['factura']))
                {
                    $this->NM_ajax_info['errList']['factura'] = array();
                }
                $this->NM_ajax_info['errList']['factura'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'factura';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_factura

    function ValidateField_hitos_facturacion(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if ($this->hitos_facturacion != "")
      {
          $x = 0; 
          $this->hitos_facturacion_1 = explode("@?@", $this->hitos_facturacion);
          $this->hitos_facturacion = ""; 
          if ($this->hitos_facturacion_1 != "") 
          { 
              foreach ($this->hitos_facturacion_1 as $dados_hitos_facturacion_1 ) 
              { 
                       if ($x != 0)
                       { 
                           $this->hitos_facturacion .= "@?@";
                       } 
                       $this->hitos_facturacion .= $dados_hitos_facturacion_1;
                       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_hitos_facturacion']) && !in_array($dados_hitos_facturacion_1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_hitos_facturacion']))
                       {
                           $hasError = true;
                           $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                           if (!isset($Campos_Erros['hitos_facturacion']))
                           {
                               $Campos_Erros['hitos_facturacion'] = array();
                           }
                           $Campos_Erros['hitos_facturacion'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                           if (!isset($this->NM_ajax_info['errList']['hitos_facturacion']) || !is_array($this->NM_ajax_info['errList']['hitos_facturacion']))
                           {
                               $this->NM_ajax_info['errList']['hitos_facturacion'] = array();
                           }
                           $this->NM_ajax_info['errList']['hitos_facturacion'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                           breack;
                       }
                       $x++ ; 
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hitos_facturacion';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hitos_facturacion
//
//--------------------------------------------------------------------------------------
   function upload_img_doc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser;
     if (!empty($Campos_Crit) || !empty($Campos_Falta))
     {
          return;
     }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->factura == "none") 
          { 
              $this->factura = ""; 
          } 
          if ($this->factura != "") 
          { 
              if (!is_file($this->factura) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                  $mbConvertFileName = mb_convert_encoding($this->factura, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  if (is_file($mbConvertFileName)) {
                      $this->factura = $mbConvertFileName;
                  }
              }
              if (is_file($this->factura))  
              { 
                  if ($this->nmgp_opcao == "incluir")
                  { 
                      $this->SC_DOC_factura = $this->factura;
                  } 
                  else 
                  { 
                      $arq_factura = fopen($this->factura, "r") ; 
                      $reg_factura = fread($arq_factura, filesize($this->factura)) ; 
                      fclose($arq_factura) ;  
                  } 
                  $this->NM_size_docs[$this->factura_scfile_name] = $this->sc_file_size($this->factura);
                  $this->factura =  trim($this->factura_scfile_name) ;  
                  $dir_doc = $this->Ini->path_doc . "/" . $this->nm_tira_formatacao_id_proyecto($this->id_proyecto) . "" . $this->nm_tira_formatacao_id_partida($this->id_partida) . "/"; 
                 if ($this->nmgp_opcao != "incluir")
                 { 
                  if (nm_mkdir($dir_doc))  
                  { 
                      $_test_file = $this->fetchUniqueUploadName($this->factura_scfile_name, $dir_doc, "factura");
                      if (trim($this->factura_scfile_name) != $_test_file)
                      {
                          $this->factura_scfile_name = $_test_file;
                          $this->factura = $_test_file;
                      }
                      $arq_factura = fopen($dir_doc . trim($this->factura_scfile_name), "w") ; 
                      fwrite($arq_factura, $reg_factura) ;  
                      fclose($arq_factura) ;  
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Documento Factura: " . $this->Ini->Nm_lang['lang_errm_ivdr']; 
                      if (!isset($Campos_Erros['factura']))
                      {
                          $Campos_Erros['factura'] = array();
                      }
                      $Campos_Erros['factura'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                      if (!isset($this->NM_ajax_info['errList']['factura']) || !is_array($this->NM_ajax_info['errList']['factura']))
                      {
                          $this->NM_ajax_info['errList']['factura'] = array();
                      }
                      $this->NM_ajax_info['errList']['factura'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                  } 
                 } 
              } 
              else 
              { 
                  $Campos_Crit .= "Documento Factura " . $this->Ini->Nm_lang['lang_errm_upld']; 
                  $this->factura = "";
                  if (!isset($Campos_Erros['factura']))
                  {
                      $Campos_Erros['factura'] = array();
                  }
                  $Campos_Erros['factura'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  if (!isset($this->NM_ajax_info['errList']['factura']) || !is_array($this->NM_ajax_info['errList']['factura']))
                  {
                      $this->NM_ajax_info['errList']['factura'] = array();
                  }
                  $this->NM_ajax_info['errList']['factura'][] = $this->Ini->Nm_lang['lang_errm_upld'];
              } 
          } 
          elseif (!empty($this->factura_salva) && $this->factura_limpa != "S")
          {
              $this->factura = $this->factura_salva;
          }
      } 
      elseif (!empty($this->factura_salva) && $this->factura_limpa != "S")
      {
          $this->factura = $this->factura_salva;
      }
   }

    function removeDuplicateDttmError($aErrDate, &$aErrTime)
    {
        if (empty($aErrDate) || empty($aErrTime))
        {
            return;
        }

        foreach ($aErrDate as $sErrDate)
        {
            foreach ($aErrTime as $iErrTime => $sErrTime)
            {
                if ($sErrDate == $sErrTime)
                {
                    unset($aErrTime[$iErrTime]);
                }
            }
        }
    } // removeDuplicateDttmError

   function nm_guardar_campos()
   {
    global
           $sc_seq_vert;
    $this->nmgp_dados_form['id'] = $this->id;
    $this->nmgp_dados_form['id_proyecto'] = $this->id_proyecto;
    $this->nmgp_dados_form['monto_contrato'] = $this->monto_contrato;
    $this->nmgp_dados_form['tipo_moneda'] = $this->tipo_moneda;
    $this->nmgp_dados_form['empresa'] = $this->empresa;
    $this->nmgp_dados_form['cliente'] = $this->cliente;
    $this->nmgp_dados_form['id_partida'] = $this->id_partida;
    $this->nmgp_dados_form['fecha_desde'] = (strlen(trim($this->fecha_desde)) > 19) ? str_replace(".", ":", $this->fecha_desde) : trim($this->fecha_desde);
    $this->nmgp_dados_form['fecha_hasta'] = (strlen(trim($this->fecha_hasta)) > 19) ? str_replace(".", ":", $this->fecha_hasta) : trim($this->fecha_hasta);
    $this->nmgp_dados_form['dias_desde'] = $this->dias_desde;
    $this->nmgp_dados_form['dias_hasta'] = $this->dias_hasta;
    $this->nmgp_dados_form['dias_periodo'] = $this->dias_periodo;
    $this->nmgp_dados_form['fecha_desde_factura'] = (strlen(trim($this->fecha_desde_factura)) > 19) ? str_replace(".", ":", $this->fecha_desde_factura) : trim($this->fecha_desde_factura);
    $this->nmgp_dados_form['fecha_hasta_factura'] = (strlen(trim($this->fecha_hasta_factura)) > 19) ? str_replace(".", ":", $this->fecha_hasta_factura) : trim($this->fecha_hasta_factura);
    $this->nmgp_dados_form['avance_informado_con_iva'] = $this->avance_informado_con_iva;
    $this->nmgp_dados_form['produccion_neto'] = $this->produccion_neto;
    $this->nmgp_dados_form['retencion'] = $this->retencion;
    $this->nmgp_dados_form['retencion_con_iva'] = $this->retencion_con_iva;
    $this->nmgp_dados_form['retencion_acumulada'] = $this->retencion_acumulada;
    $this->nmgp_dados_form['reajuste_acumulado_con_iva'] = $this->reajuste_acumulado_con_iva;
    $this->nmgp_dados_form['reajuste_acumulado_neto'] = $this->reajuste_acumulado_neto;
    $this->nmgp_dados_form['multa'] = $this->multa;
    $this->nmgp_dados_form['total_facturado'] = $this->total_facturado;
    $this->nmgp_dados_form['afecta_iva'] = $this->afecta_iva;
    $this->nmgp_dados_form['existe_retencion'] = $this->existe_retencion;
    $this->nmgp_dados_form['incluye_retencion'] = $this->incluye_retencion;
    $this->nmgp_dados_form['considera_retencion'] = $this->considera_retencion;
    $this->nmgp_dados_form['facturado'] = $this->facturado;
    $this->nmgp_dados_form['observaciones_solicitud'] = $this->observaciones_solicitud;
    $this->nmgp_dados_form['iva'] = $this->iva;
    $this->nmgp_dados_form['monto_uf'] = $this->monto_uf;
    $this->nmgp_dados_form['fecha'] = (strlen(trim($this->fecha)) > 19) ? str_replace(".", ":", $this->fecha) : trim($this->fecha);
    $this->nmgp_dados_form['valor_uf'] = $this->valor_uf;
    $this->nmgp_dados_form['observaciones'] = $this->observaciones;
    if (empty($this->factura))
    {
        $this->factura = $this->nmgp_dados_form['factura'];
    }
    $this->nmgp_dados_form['factura'] = $this->factura;
    $this->nmgp_dados_form['factura_limpa'] = $this->factura_limpa;
    $this->nmgp_dados_form['hitos_facturacion'] = $this->hitos_facturacion;
    $this->nmgp_dados_form['id_item'] = $this->id_item;
    $this->nmgp_dados_form['vigente'] = $this->vigente;
    $this->nmgp_dados_form['orden'] = $this->orden;
    $this->nmgp_dados_form['avance'] = $this->avance;
    $this->nmgp_dados_form['reajuste'] = $this->reajuste;
    $this->nmgp_dados_form['factor_produccion'] = $this->factor_produccion;
    $this->nmgp_dados_form['avance_periodo'] = $this->avance_periodo;
    $this->nmgp_dados_form['avance_periodo_siguiente'] = $this->avance_periodo_siguiente;
    $this->nmgp_dados_form['avance_informado'] = $this->avance_informado;
    $this->nmgp_dados_form['avance_periodo_anterior'] = $this->avance_periodo_anterior;
    $this->nmgp_dados_form['produccion_total_final'] = $this->produccion_total_final;
    $this->nmgp_dados_form['total_facturado_ur'] = $this->total_facturado_ur;
    $this->nmgp_dados_form['produccion_ep'] = $this->produccion_ep;
    $this->nmgp_dados_form['reajuste_con_iva'] = $this->reajuste_con_iva;
    $this->nmgp_dados_form['modificacion_contrato'] = $this->modificacion_contrato;
    $this->nmgp_dados_form['monto_disponible'] = $this->monto_disponible;
    $this->nmgp_dados_form['porcentaje_retencion'] = $this->porcentaje_retencion;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['id'] = $this->id;
      nm_limpa_numero($this->id, $this->field_config['id']['symbol_grp']) ; 
      $this->Before_unformat['monto_contrato'] = $this->monto_contrato;
      if (!empty($this->field_config['monto_contrato']['symbol_dec']))
      {
         nm_limpa_valor($this->monto_contrato, $this->field_config['monto_contrato']['symbol_dec'], $this->field_config['monto_contrato']['symbol_grp']);
      }
      $this->Before_unformat['fecha_desde'] = $this->fecha_desde;
      nm_limpa_data($this->fecha_desde, $this->field_config['fecha_desde']['date_sep']) ; 
      $this->Before_unformat['fecha_hasta'] = $this->fecha_hasta;
      nm_limpa_data($this->fecha_hasta, $this->field_config['fecha_hasta']['date_sep']) ; 
      $this->Before_unformat['dias_desde'] = $this->dias_desde;
      nm_limpa_numero($this->dias_desde, $this->field_config['dias_desde']['symbol_grp']) ; 
      $this->Before_unformat['dias_hasta'] = $this->dias_hasta;
      nm_limpa_numero($this->dias_hasta, $this->field_config['dias_hasta']['symbol_grp']) ; 
      $this->Before_unformat['dias_periodo'] = $this->dias_periodo;
      nm_limpa_numero($this->dias_periodo, $this->field_config['dias_periodo']['symbol_grp']) ; 
      $this->Before_unformat['fecha_desde_factura'] = $this->fecha_desde_factura;
      nm_limpa_data($this->fecha_desde_factura, $this->field_config['fecha_desde_factura']['date_sep']) ; 
      $this->Before_unformat['fecha_hasta_factura'] = $this->fecha_hasta_factura;
      nm_limpa_data($this->fecha_hasta_factura, $this->field_config['fecha_hasta_factura']['date_sep']) ; 
      $this->Before_unformat['avance_informado_con_iva'] = $this->avance_informado_con_iva;
      if (!empty($this->field_config['avance_informado_con_iva']['symbol_dec']))
      {
         nm_limpa_valor($this->avance_informado_con_iva, $this->field_config['avance_informado_con_iva']['symbol_dec'], $this->field_config['avance_informado_con_iva']['symbol_grp']);
      }
      $this->Before_unformat['produccion_neto'] = $this->produccion_neto;
      if (!empty($this->field_config['produccion_neto']['symbol_dec']))
      {
         $this->sc_remove_currency($this->produccion_neto, $this->field_config['produccion_neto']['symbol_dec'], $this->field_config['produccion_neto']['symbol_grp'], $this->field_config['produccion_neto']['symbol_mon']);
         nm_limpa_valor($this->produccion_neto, $this->field_config['produccion_neto']['symbol_dec'], $this->field_config['produccion_neto']['symbol_grp']);
      }
      $this->Before_unformat['retencion'] = $this->retencion;
      if (!empty($this->field_config['retencion']['symbol_dec']))
      {
         $this->sc_remove_currency($this->retencion, $this->field_config['retencion']['symbol_dec'], $this->field_config['retencion']['symbol_grp'], $this->field_config['retencion']['symbol_mon']);
         nm_limpa_valor($this->retencion, $this->field_config['retencion']['symbol_dec'], $this->field_config['retencion']['symbol_grp']);
      }
      $this->Before_unformat['retencion_con_iva'] = $this->retencion_con_iva;
      if (!empty($this->field_config['retencion_con_iva']['symbol_dec']))
      {
         $this->sc_remove_currency($this->retencion_con_iva, $this->field_config['retencion_con_iva']['symbol_dec'], $this->field_config['retencion_con_iva']['symbol_grp'], $this->field_config['retencion_con_iva']['symbol_mon']);
         nm_limpa_valor($this->retencion_con_iva, $this->field_config['retencion_con_iva']['symbol_dec'], $this->field_config['retencion_con_iva']['symbol_grp']);
      }
      $this->Before_unformat['retencion_acumulada'] = $this->retencion_acumulada;
      nm_limpa_numero($this->retencion_acumulada, $this->field_config['retencion_acumulada']['symbol_grp']) ; 
      $this->Before_unformat['reajuste_acumulado_con_iva'] = $this->reajuste_acumulado_con_iva;
      if (!empty($this->field_config['reajuste_acumulado_con_iva']['symbol_dec']))
      {
         $this->sc_remove_currency($this->reajuste_acumulado_con_iva, $this->field_config['reajuste_acumulado_con_iva']['symbol_dec'], $this->field_config['reajuste_acumulado_con_iva']['symbol_grp'], $this->field_config['reajuste_acumulado_con_iva']['symbol_mon']);
         nm_limpa_valor($this->reajuste_acumulado_con_iva, $this->field_config['reajuste_acumulado_con_iva']['symbol_dec'], $this->field_config['reajuste_acumulado_con_iva']['symbol_grp']);
      }
      $this->Before_unformat['reajuste_acumulado_neto'] = $this->reajuste_acumulado_neto;
      if (!empty($this->field_config['reajuste_acumulado_neto']['symbol_dec']))
      {
         $this->sc_remove_currency($this->reajuste_acumulado_neto, $this->field_config['reajuste_acumulado_neto']['symbol_dec'], $this->field_config['reajuste_acumulado_neto']['symbol_grp'], $this->field_config['reajuste_acumulado_neto']['symbol_mon']);
         nm_limpa_valor($this->reajuste_acumulado_neto, $this->field_config['reajuste_acumulado_neto']['symbol_dec'], $this->field_config['reajuste_acumulado_neto']['symbol_grp']);
      }
      $this->Before_unformat['multa'] = $this->multa;
      if (!empty($this->field_config['multa']['symbol_dec']))
      {
         $this->sc_remove_currency($this->multa, $this->field_config['multa']['symbol_dec'], $this->field_config['multa']['symbol_grp'], $this->field_config['multa']['symbol_mon']);
         nm_limpa_valor($this->multa, $this->field_config['multa']['symbol_dec'], $this->field_config['multa']['symbol_grp']);
      }
      $this->Before_unformat['total_facturado'] = $this->total_facturado;
      nm_limpa_numero($this->total_facturado, $this->field_config['total_facturado']['symbol_grp']) ; 
      $this->Before_unformat['iva'] = $this->iva;
      if (!empty($this->field_config['iva']['symbol_dec']))
      {
         nm_limpa_valor($this->iva, $this->field_config['iva']['symbol_dec'], $this->field_config['iva']['symbol_grp']);
      }
      $this->Before_unformat['monto_uf'] = $this->monto_uf;
      if (!empty($this->field_config['monto_uf']['symbol_dec']))
      {
         nm_limpa_valor($this->monto_uf, $this->field_config['monto_uf']['symbol_dec'], $this->field_config['monto_uf']['symbol_grp']);
      }
      $this->Before_unformat['fecha'] = $this->fecha;
      nm_limpa_data($this->fecha, $this->field_config['fecha']['date_sep']) ; 
      $this->Before_unformat['valor_uf'] = $this->valor_uf;
      if (!empty($this->field_config['valor_uf']['symbol_dec']))
      {
         nm_limpa_valor($this->valor_uf, $this->field_config['valor_uf']['symbol_dec'], $this->field_config['valor_uf']['symbol_grp']);
      }
      $this->Before_unformat['vigente'] = $this->vigente;
      nm_limpa_numero($this->vigente, $this->field_config['vigente']['symbol_grp']) ; 
      $this->Before_unformat['orden'] = $this->orden;
      nm_limpa_numero($this->orden, $this->field_config['orden']['symbol_grp']) ; 
      $this->Before_unformat['avance'] = $this->avance;
      if (!empty($this->field_config['avance']['symbol_dec']))
      {
         nm_limpa_valor($this->avance, $this->field_config['avance']['symbol_dec'], $this->field_config['avance']['symbol_grp']);
      }
      $this->Before_unformat['reajuste'] = $this->reajuste;
      if (!empty($this->field_config['reajuste']['symbol_dec']))
      {
         $this->sc_remove_currency($this->reajuste, $this->field_config['reajuste']['symbol_dec'], $this->field_config['reajuste']['symbol_grp'], $this->field_config['reajuste']['symbol_mon']);
         nm_limpa_valor($this->reajuste, $this->field_config['reajuste']['symbol_dec'], $this->field_config['reajuste']['symbol_grp']);
      }
      $this->Before_unformat['factor_produccion'] = $this->factor_produccion;
      if (!empty($this->field_config['factor_produccion']['symbol_dec']))
      {
         nm_limpa_valor($this->factor_produccion, $this->field_config['factor_produccion']['symbol_dec'], $this->field_config['factor_produccion']['symbol_grp']);
      }
      $this->Before_unformat['avance_periodo'] = $this->avance_periodo;
      if (!empty($this->field_config['avance_periodo']['symbol_dec']))
      {
         $this->sc_remove_currency($this->avance_periodo, $this->field_config['avance_periodo']['symbol_dec'], $this->field_config['avance_periodo']['symbol_grp'], $this->field_config['avance_periodo']['symbol_mon']);
         nm_limpa_valor($this->avance_periodo, $this->field_config['avance_periodo']['symbol_dec'], $this->field_config['avance_periodo']['symbol_grp']);
      }
      $this->Before_unformat['avance_periodo_siguiente'] = $this->avance_periodo_siguiente;
      if (!empty($this->field_config['avance_periodo_siguiente']['symbol_dec']))
      {
         $this->sc_remove_currency($this->avance_periodo_siguiente, $this->field_config['avance_periodo_siguiente']['symbol_dec'], $this->field_config['avance_periodo_siguiente']['symbol_grp'], $this->field_config['avance_periodo_siguiente']['symbol_mon']);
         nm_limpa_valor($this->avance_periodo_siguiente, $this->field_config['avance_periodo_siguiente']['symbol_dec'], $this->field_config['avance_periodo_siguiente']['symbol_grp']);
      }
      $this->Before_unformat['avance_informado'] = $this->avance_informado;
      if (!empty($this->field_config['avance_informado']['symbol_dec']))
      {
         nm_limpa_valor($this->avance_informado, $this->field_config['avance_informado']['symbol_dec'], $this->field_config['avance_informado']['symbol_grp']);
      }
      $this->Before_unformat['avance_periodo_anterior'] = $this->avance_periodo_anterior;
      if (!empty($this->field_config['avance_periodo_anterior']['symbol_dec']))
      {
         $this->sc_remove_currency($this->avance_periodo_anterior, $this->field_config['avance_periodo_anterior']['symbol_dec'], $this->field_config['avance_periodo_anterior']['symbol_grp'], $this->field_config['avance_periodo_anterior']['symbol_mon']);
         nm_limpa_valor($this->avance_periodo_anterior, $this->field_config['avance_periodo_anterior']['symbol_dec'], $this->field_config['avance_periodo_anterior']['symbol_grp']);
      }
      $this->Before_unformat['produccion_total_final'] = $this->produccion_total_final;
      if (!empty($this->field_config['produccion_total_final']['symbol_dec']))
      {
         $this->sc_remove_currency($this->produccion_total_final, $this->field_config['produccion_total_final']['symbol_dec'], $this->field_config['produccion_total_final']['symbol_grp'], $this->field_config['produccion_total_final']['symbol_mon']);
         nm_limpa_valor($this->produccion_total_final, $this->field_config['produccion_total_final']['symbol_dec'], $this->field_config['produccion_total_final']['symbol_grp']);
      }
      $this->Before_unformat['total_facturado_ur'] = $this->total_facturado_ur;
      nm_limpa_numero($this->total_facturado_ur, $this->field_config['total_facturado_ur']['symbol_grp']) ; 
      $this->Before_unformat['produccion_ep'] = $this->produccion_ep;
      if (!empty($this->field_config['produccion_ep']['symbol_dec']))
      {
         nm_limpa_valor($this->produccion_ep, $this->field_config['produccion_ep']['symbol_dec'], $this->field_config['produccion_ep']['symbol_grp']);
      }
      $this->Before_unformat['reajuste_con_iva'] = $this->reajuste_con_iva;
      if (!empty($this->field_config['reajuste_con_iva']['symbol_dec']))
      {
         $this->sc_remove_currency($this->reajuste_con_iva, $this->field_config['reajuste_con_iva']['symbol_dec'], $this->field_config['reajuste_con_iva']['symbol_grp'], $this->field_config['reajuste_con_iva']['symbol_mon']);
         nm_limpa_valor($this->reajuste_con_iva, $this->field_config['reajuste_con_iva']['symbol_dec'], $this->field_config['reajuste_con_iva']['symbol_grp']);
      }
      $this->Before_unformat['modificacion_contrato'] = $this->modificacion_contrato;
      if (!empty($this->field_config['modificacion_contrato']['symbol_dec']))
      {
         $this->sc_remove_currency($this->modificacion_contrato, $this->field_config['modificacion_contrato']['symbol_dec'], $this->field_config['modificacion_contrato']['symbol_grp'], $this->field_config['modificacion_contrato']['symbol_mon']);
         nm_limpa_valor($this->modificacion_contrato, $this->field_config['modificacion_contrato']['symbol_dec'], $this->field_config['modificacion_contrato']['symbol_grp']);
      }
      $this->Before_unformat['monto_disponible'] = $this->monto_disponible;
      if (!empty($this->field_config['monto_disponible']['symbol_dec']))
      {
         nm_limpa_valor($this->monto_disponible, $this->field_config['monto_disponible']['symbol_dec'], $this->field_config['monto_disponible']['symbol_grp']);
      }
      $this->Before_unformat['porcentaje_retencion'] = $this->porcentaje_retencion;
      if (!empty($this->field_config['porcentaje_retencion']['symbol_dec']))
      {
         nm_limpa_valor($this->porcentaje_retencion, $this->field_config['porcentaje_retencion']['symbol_dec'], $this->field_config['porcentaje_retencion']['symbol_grp']);
      }
   }
   function nm_tira_formatacao_id_proyecto($Val_in)
   {
      return $Val_in;
   }
   function nm_tira_formatacao_id_partida($Val_in)
   {
      return $Val_in;
   }
   function sc_add_currency(&$value, $symbol, $pos)
   {
       if ('' == $value)
       {
           return;
       }
       $value = (1 == $pos || 3 == $pos) ? $symbol . ' ' . $value : $value . ' ' . $symbol;
   }
   function sc_remove_currency(&$value, $symbol_dec, $symbol_tho, $symbol_mon)
   {
       $value = preg_replace('~&#x0*([0-9a-f]+);~i', '', $value);
       $sNew  = str_replace($symbol_mon, '', $value);
       if ($sNew != $value)
       {
           $value = str_replace(' ', '', $sNew);
           return;
       }
       $aTest = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', $symbol_dec, $symbol_tho);
       $sNew  = '';
       for ($i = 0; $i < strlen($value); $i++)
       {
           if ($this->sc_test_currency_char($value[$i], $aTest))
           {
               $sNew .= $value[$i];
           }
       }
       $value = $sNew;
   }
   function sc_test_currency_char($char, $test)
   {
       $found = false;
       foreach ($test as $test_char)
       {
           if ($char === $test_char)
           {
               $found = true;
           }
       }
       return $found;
   }
   function nm_clear_val($Nome_Campo)
   {
      if ($Nome_Campo == "id")
      {
          nm_limpa_numero($this->id, $this->field_config['id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "monto_contrato")
      {
          if (!empty($this->field_config['monto_contrato']['symbol_dec']))
          {
             nm_limpa_valor($this->monto_contrato, $this->field_config['monto_contrato']['symbol_dec'], $this->field_config['monto_contrato']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "dias_desde")
      {
          nm_limpa_numero($this->dias_desde, $this->field_config['dias_desde']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "dias_hasta")
      {
          nm_limpa_numero($this->dias_hasta, $this->field_config['dias_hasta']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "dias_periodo")
      {
          nm_limpa_numero($this->dias_periodo, $this->field_config['dias_periodo']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "avance_informado_con_iva")
      {
          if (!empty($this->field_config['avance_informado_con_iva']['symbol_dec']))
          {
             nm_limpa_valor($this->avance_informado_con_iva, $this->field_config['avance_informado_con_iva']['symbol_dec'], $this->field_config['avance_informado_con_iva']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "produccion_neto")
      {
          if (!empty($this->field_config['produccion_neto']['symbol_dec']))
          {
             $this->sc_remove_currency($this->produccion_neto, $this->field_config['produccion_neto']['symbol_dec'], $this->field_config['produccion_neto']['symbol_grp'], $this->field_config['produccion_neto']['symbol_mon']);
             nm_limpa_valor($this->produccion_neto, $this->field_config['produccion_neto']['symbol_dec'], $this->field_config['produccion_neto']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "retencion")
      {
          if (!empty($this->field_config['retencion']['symbol_dec']))
          {
             $this->sc_remove_currency($this->retencion, $this->field_config['retencion']['symbol_dec'], $this->field_config['retencion']['symbol_grp'], $this->field_config['retencion']['symbol_mon']);
             nm_limpa_valor($this->retencion, $this->field_config['retencion']['symbol_dec'], $this->field_config['retencion']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "retencion_con_iva")
      {
          if (!empty($this->field_config['retencion_con_iva']['symbol_dec']))
          {
             $this->sc_remove_currency($this->retencion_con_iva, $this->field_config['retencion_con_iva']['symbol_dec'], $this->field_config['retencion_con_iva']['symbol_grp'], $this->field_config['retencion_con_iva']['symbol_mon']);
             nm_limpa_valor($this->retencion_con_iva, $this->field_config['retencion_con_iva']['symbol_dec'], $this->field_config['retencion_con_iva']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "retencion_acumulada")
      {
          nm_limpa_numero($this->retencion_acumulada, $this->field_config['retencion_acumulada']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "reajuste_acumulado_con_iva")
      {
          if (!empty($this->field_config['reajuste_acumulado_con_iva']['symbol_dec']))
          {
             $this->sc_remove_currency($this->reajuste_acumulado_con_iva, $this->field_config['reajuste_acumulado_con_iva']['symbol_dec'], $this->field_config['reajuste_acumulado_con_iva']['symbol_grp'], $this->field_config['reajuste_acumulado_con_iva']['symbol_mon']);
             nm_limpa_valor($this->reajuste_acumulado_con_iva, $this->field_config['reajuste_acumulado_con_iva']['symbol_dec'], $this->field_config['reajuste_acumulado_con_iva']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "reajuste_acumulado_neto")
      {
          if (!empty($this->field_config['reajuste_acumulado_neto']['symbol_dec']))
          {
             $this->sc_remove_currency($this->reajuste_acumulado_neto, $this->field_config['reajuste_acumulado_neto']['symbol_dec'], $this->field_config['reajuste_acumulado_neto']['symbol_grp'], $this->field_config['reajuste_acumulado_neto']['symbol_mon']);
             nm_limpa_valor($this->reajuste_acumulado_neto, $this->field_config['reajuste_acumulado_neto']['symbol_dec'], $this->field_config['reajuste_acumulado_neto']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "multa")
      {
          if (!empty($this->field_config['multa']['symbol_dec']))
          {
             $this->sc_remove_currency($this->multa, $this->field_config['multa']['symbol_dec'], $this->field_config['multa']['symbol_grp'], $this->field_config['multa']['symbol_mon']);
             nm_limpa_valor($this->multa, $this->field_config['multa']['symbol_dec'], $this->field_config['multa']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "total_facturado")
      {
          nm_limpa_numero($this->total_facturado, $this->field_config['total_facturado']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "iva")
      {
          if (!empty($this->field_config['iva']['symbol_dec']))
          {
             nm_limpa_valor($this->iva, $this->field_config['iva']['symbol_dec'], $this->field_config['iva']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "monto_uf")
      {
          if (!empty($this->field_config['monto_uf']['symbol_dec']))
          {
             nm_limpa_valor($this->monto_uf, $this->field_config['monto_uf']['symbol_dec'], $this->field_config['monto_uf']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valor_uf")
      {
          if (!empty($this->field_config['valor_uf']['symbol_dec']))
          {
             nm_limpa_valor($this->valor_uf, $this->field_config['valor_uf']['symbol_dec'], $this->field_config['valor_uf']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "vigente")
      {
          nm_limpa_numero($this->vigente, $this->field_config['vigente']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "orden")
      {
          nm_limpa_numero($this->orden, $this->field_config['orden']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "avance")
      {
          if (!empty($this->field_config['avance']['symbol_dec']))
          {
             nm_limpa_valor($this->avance, $this->field_config['avance']['symbol_dec'], $this->field_config['avance']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "reajuste")
      {
          if (!empty($this->field_config['reajuste']['symbol_dec']))
          {
             $this->sc_remove_currency($this->reajuste, $this->field_config['reajuste']['symbol_dec'], $this->field_config['reajuste']['symbol_grp'], $this->field_config['reajuste']['symbol_mon']);
             nm_limpa_valor($this->reajuste, $this->field_config['reajuste']['symbol_dec'], $this->field_config['reajuste']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "factor_produccion")
      {
          if (!empty($this->field_config['factor_produccion']['symbol_dec']))
          {
             nm_limpa_valor($this->factor_produccion, $this->field_config['factor_produccion']['symbol_dec'], $this->field_config['factor_produccion']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "avance_periodo")
      {
          if (!empty($this->field_config['avance_periodo']['symbol_dec']))
          {
             $this->sc_remove_currency($this->avance_periodo, $this->field_config['avance_periodo']['symbol_dec'], $this->field_config['avance_periodo']['symbol_grp'], $this->field_config['avance_periodo']['symbol_mon']);
             nm_limpa_valor($this->avance_periodo, $this->field_config['avance_periodo']['symbol_dec'], $this->field_config['avance_periodo']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "avance_periodo_siguiente")
      {
          if (!empty($this->field_config['avance_periodo_siguiente']['symbol_dec']))
          {
             $this->sc_remove_currency($this->avance_periodo_siguiente, $this->field_config['avance_periodo_siguiente']['symbol_dec'], $this->field_config['avance_periodo_siguiente']['symbol_grp'], $this->field_config['avance_periodo_siguiente']['symbol_mon']);
             nm_limpa_valor($this->avance_periodo_siguiente, $this->field_config['avance_periodo_siguiente']['symbol_dec'], $this->field_config['avance_periodo_siguiente']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "avance_informado")
      {
          if (!empty($this->field_config['avance_informado']['symbol_dec']))
          {
             nm_limpa_valor($this->avance_informado, $this->field_config['avance_informado']['symbol_dec'], $this->field_config['avance_informado']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "avance_periodo_anterior")
      {
          if (!empty($this->field_config['avance_periodo_anterior']['symbol_dec']))
          {
             $this->sc_remove_currency($this->avance_periodo_anterior, $this->field_config['avance_periodo_anterior']['symbol_dec'], $this->field_config['avance_periodo_anterior']['symbol_grp'], $this->field_config['avance_periodo_anterior']['symbol_mon']);
             nm_limpa_valor($this->avance_periodo_anterior, $this->field_config['avance_periodo_anterior']['symbol_dec'], $this->field_config['avance_periodo_anterior']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "produccion_total_final")
      {
          if (!empty($this->field_config['produccion_total_final']['symbol_dec']))
          {
             $this->sc_remove_currency($this->produccion_total_final, $this->field_config['produccion_total_final']['symbol_dec'], $this->field_config['produccion_total_final']['symbol_grp'], $this->field_config['produccion_total_final']['symbol_mon']);
             nm_limpa_valor($this->produccion_total_final, $this->field_config['produccion_total_final']['symbol_dec'], $this->field_config['produccion_total_final']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "total_facturado_ur")
      {
          nm_limpa_numero($this->total_facturado_ur, $this->field_config['total_facturado_ur']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "produccion_ep")
      {
          if (!empty($this->field_config['produccion_ep']['symbol_dec']))
          {
             nm_limpa_valor($this->produccion_ep, $this->field_config['produccion_ep']['symbol_dec'], $this->field_config['produccion_ep']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "reajuste_con_iva")
      {
          if (!empty($this->field_config['reajuste_con_iva']['symbol_dec']))
          {
             $this->sc_remove_currency($this->reajuste_con_iva, $this->field_config['reajuste_con_iva']['symbol_dec'], $this->field_config['reajuste_con_iva']['symbol_grp'], $this->field_config['reajuste_con_iva']['symbol_mon']);
             nm_limpa_valor($this->reajuste_con_iva, $this->field_config['reajuste_con_iva']['symbol_dec'], $this->field_config['reajuste_con_iva']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "modificacion_contrato")
      {
          if (!empty($this->field_config['modificacion_contrato']['symbol_dec']))
          {
             $this->sc_remove_currency($this->modificacion_contrato, $this->field_config['modificacion_contrato']['symbol_dec'], $this->field_config['modificacion_contrato']['symbol_grp'], $this->field_config['modificacion_contrato']['symbol_mon']);
             nm_limpa_valor($this->modificacion_contrato, $this->field_config['modificacion_contrato']['symbol_dec'], $this->field_config['modificacion_contrato']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "monto_disponible")
      {
          if (!empty($this->field_config['monto_disponible']['symbol_dec']))
          {
             nm_limpa_valor($this->monto_disponible, $this->field_config['monto_disponible']['symbol_dec'], $this->field_config['monto_disponible']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "porcentaje_retencion")
      {
          if (!empty($this->field_config['porcentaje_retencion']['symbol_dec']))
          {
             nm_limpa_valor($this->porcentaje_retencion, $this->field_config['porcentaje_retencion']['symbol_dec'], $this->field_config['porcentaje_retencion']['symbol_grp']);
          }
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
      if ('' !== $this->id || (!empty($format_fields) && isset($format_fields['id'])))
      {
          nmgp_Form_Num_Val($this->id, $this->field_config['id']['symbol_grp'], $this->field_config['id']['symbol_dec'], "0", "S", $this->field_config['id']['format_neg'], "", "", "-", $this->field_config['id']['symbol_fmt']) ; 
      }
      if ('' !== $this->monto_contrato || (!empty($format_fields) && isset($format_fields['monto_contrato'])))
      {
          nmgp_Form_Num_Val($this->monto_contrato, $this->field_config['monto_contrato']['symbol_grp'], $this->field_config['monto_contrato']['symbol_dec'], "2", "S", $this->field_config['monto_contrato']['format_neg'], "", "", "-", $this->field_config['monto_contrato']['symbol_fmt']) ; 
      }
      if ((!empty($this->fecha_desde) && 'null' != $this->fecha_desde) || (!empty($format_fields) && isset($format_fields['fecha_desde'])))
      {
          nm_volta_data($this->fecha_desde, $this->field_config['fecha_desde']['date_format']) ; 
          nmgp_Form_Datas($this->fecha_desde, $this->field_config['fecha_desde']['date_format'], $this->field_config['fecha_desde']['date_sep']) ;  
      }
      elseif ('null' == $this->fecha_desde || '' == $this->fecha_desde)
      {
          $this->fecha_desde = '';
      }
      if ((!empty($this->fecha_hasta) && 'null' != $this->fecha_hasta) || (!empty($format_fields) && isset($format_fields['fecha_hasta'])))
      {
          nm_volta_data($this->fecha_hasta, $this->field_config['fecha_hasta']['date_format']) ; 
          nmgp_Form_Datas($this->fecha_hasta, $this->field_config['fecha_hasta']['date_format'], $this->field_config['fecha_hasta']['date_sep']) ;  
      }
      elseif ('null' == $this->fecha_hasta || '' == $this->fecha_hasta)
      {
          $this->fecha_hasta = '';
      }
      if ('' !== $this->dias_desde || (!empty($format_fields) && isset($format_fields['dias_desde'])))
      {
          nmgp_Form_Num_Val($this->dias_desde, $this->field_config['dias_desde']['symbol_grp'], $this->field_config['dias_desde']['symbol_dec'], "0", "S", $this->field_config['dias_desde']['format_neg'], "", "", "-", $this->field_config['dias_desde']['symbol_fmt']) ; 
      }
      if ('' !== $this->dias_hasta || (!empty($format_fields) && isset($format_fields['dias_hasta'])))
      {
          nmgp_Form_Num_Val($this->dias_hasta, $this->field_config['dias_hasta']['symbol_grp'], $this->field_config['dias_hasta']['symbol_dec'], "0", "S", $this->field_config['dias_hasta']['format_neg'], "", "", "-", $this->field_config['dias_hasta']['symbol_fmt']) ; 
      }
      if ('' !== $this->dias_periodo || (!empty($format_fields) && isset($format_fields['dias_periodo'])))
      {
          nmgp_Form_Num_Val($this->dias_periodo, $this->field_config['dias_periodo']['symbol_grp'], $this->field_config['dias_periodo']['symbol_dec'], "0", "S", $this->field_config['dias_periodo']['format_neg'], "", "", "-", $this->field_config['dias_periodo']['symbol_fmt']) ; 
      }
      if ((!empty($this->fecha_desde_factura) && 'null' != $this->fecha_desde_factura) || (!empty($format_fields) && isset($format_fields['fecha_desde_factura'])))
      {
          nm_volta_data($this->fecha_desde_factura, $this->field_config['fecha_desde_factura']['date_format']) ; 
          nmgp_Form_Datas($this->fecha_desde_factura, $this->field_config['fecha_desde_factura']['date_format'], $this->field_config['fecha_desde_factura']['date_sep']) ;  
      }
      elseif ('null' == $this->fecha_desde_factura || '' == $this->fecha_desde_factura)
      {
          $this->fecha_desde_factura = '';
      }
      if ((!empty($this->fecha_hasta_factura) && 'null' != $this->fecha_hasta_factura) || (!empty($format_fields) && isset($format_fields['fecha_hasta_factura'])))
      {
          nm_volta_data($this->fecha_hasta_factura, $this->field_config['fecha_hasta_factura']['date_format']) ; 
          nmgp_Form_Datas($this->fecha_hasta_factura, $this->field_config['fecha_hasta_factura']['date_format'], $this->field_config['fecha_hasta_factura']['date_sep']) ;  
      }
      elseif ('null' == $this->fecha_hasta_factura || '' == $this->fecha_hasta_factura)
      {
          $this->fecha_hasta_factura = '';
      }
      if ('' !== $this->avance_informado_con_iva || (!empty($format_fields) && isset($format_fields['avance_informado_con_iva'])))
      {
          nmgp_Form_Num_Val($this->avance_informado_con_iva, $this->field_config['avance_informado_con_iva']['symbol_grp'], $this->field_config['avance_informado_con_iva']['symbol_dec'], "1", "S", $this->field_config['avance_informado_con_iva']['format_neg'], "", "", "-", $this->field_config['avance_informado_con_iva']['symbol_fmt']) ; 
      }
      if ('' !== $this->produccion_neto || (!empty($format_fields) && isset($format_fields['produccion_neto'])))
      {
          nmgp_Form_Num_Val($this->produccion_neto, $this->field_config['produccion_neto']['symbol_grp'], $this->field_config['produccion_neto']['symbol_dec'], "1", "S", $this->field_config['produccion_neto']['format_neg'], "", "", "-", $this->field_config['produccion_neto']['symbol_fmt']) ; 
      }
      if ('' !== $this->retencion || (!empty($format_fields) && isset($format_fields['retencion'])))
      {
          nmgp_Form_Num_Val($this->retencion, $this->field_config['retencion']['symbol_grp'], $this->field_config['retencion']['symbol_dec'], "1", "S", $this->field_config['retencion']['format_neg'], "", "", "-", $this->field_config['retencion']['symbol_fmt']) ; 
      }
      if ('' !== $this->retencion_con_iva || (!empty($format_fields) && isset($format_fields['retencion_con_iva'])))
      {
          nmgp_Form_Num_Val($this->retencion_con_iva, $this->field_config['retencion_con_iva']['symbol_grp'], $this->field_config['retencion_con_iva']['symbol_dec'], "1", "S", $this->field_config['retencion_con_iva']['format_neg'], "", "", "-", $this->field_config['retencion_con_iva']['symbol_fmt']) ; 
      }
      if ('' !== $this->retencion_acumulada || (!empty($format_fields) && isset($format_fields['retencion_acumulada'])))
      {
          nmgp_Form_Num_Val($this->retencion_acumulada, $this->field_config['retencion_acumulada']['symbol_grp'], $this->field_config['retencion_acumulada']['symbol_dec'], "0", "S", $this->field_config['retencion_acumulada']['format_neg'], "", "", "-", $this->field_config['retencion_acumulada']['symbol_fmt']) ; 
      }
      if ('' !== $this->reajuste_acumulado_con_iva || (!empty($format_fields) && isset($format_fields['reajuste_acumulado_con_iva'])))
      {
          nmgp_Form_Num_Val($this->reajuste_acumulado_con_iva, $this->field_config['reajuste_acumulado_con_iva']['symbol_grp'], $this->field_config['reajuste_acumulado_con_iva']['symbol_dec'], "1", "S", $this->field_config['reajuste_acumulado_con_iva']['format_neg'], "", "", "-", $this->field_config['reajuste_acumulado_con_iva']['symbol_fmt']) ; 
      }
      if ('' !== $this->reajuste_acumulado_neto || (!empty($format_fields) && isset($format_fields['reajuste_acumulado_neto'])))
      {
          nmgp_Form_Num_Val($this->reajuste_acumulado_neto, $this->field_config['reajuste_acumulado_neto']['symbol_grp'], $this->field_config['reajuste_acumulado_neto']['symbol_dec'], "1", "S", $this->field_config['reajuste_acumulado_neto']['format_neg'], "", "", "-", $this->field_config['reajuste_acumulado_neto']['symbol_fmt']) ; 
      }
      if ('' !== $this->multa || (!empty($format_fields) && isset($format_fields['multa'])))
      {
          nmgp_Form_Num_Val($this->multa, $this->field_config['multa']['symbol_grp'], $this->field_config['multa']['symbol_dec'], "2", "S", $this->field_config['multa']['format_neg'], "", "", "-", $this->field_config['multa']['symbol_fmt']) ; 
      }
      if ('' !== $this->total_facturado || (!empty($format_fields) && isset($format_fields['total_facturado'])))
      {
          nmgp_Form_Num_Val($this->total_facturado, $this->field_config['total_facturado']['symbol_grp'], $this->field_config['total_facturado']['symbol_dec'], "0", "S", $this->field_config['total_facturado']['format_neg'], "", "", "-", $this->field_config['total_facturado']['symbol_fmt']) ; 
      }
      if ('' !== $this->iva || (!empty($format_fields) && isset($format_fields['iva'])))
      {
          nmgp_Form_Num_Val($this->iva, $this->field_config['iva']['symbol_grp'], $this->field_config['iva']['symbol_dec'], "1", "S", $this->field_config['iva']['format_neg'], "", "", "-", $this->field_config['iva']['symbol_fmt']) ; 
      }
      if ('' !== $this->monto_uf || (!empty($format_fields) && isset($format_fields['monto_uf'])))
      {
          nmgp_Form_Num_Val($this->monto_uf, $this->field_config['monto_uf']['symbol_grp'], $this->field_config['monto_uf']['symbol_dec'], "1", "S", $this->field_config['monto_uf']['format_neg'], "", "", "-", $this->field_config['monto_uf']['symbol_fmt']) ; 
      }
      if ((!empty($this->fecha) && 'null' != $this->fecha) || (!empty($format_fields) && isset($format_fields['fecha'])))
      {
          nm_volta_data($this->fecha, $this->field_config['fecha']['date_format']) ; 
          nmgp_Form_Datas($this->fecha, $this->field_config['fecha']['date_format'], $this->field_config['fecha']['date_sep']) ;  
      }
      elseif ('null' == $this->fecha || '' == $this->fecha)
      {
          $this->fecha = '';
      }
      if ('' !== $this->valor_uf || (!empty($format_fields) && isset($format_fields['valor_uf'])))
      {
          nmgp_Form_Num_Val($this->valor_uf, $this->field_config['valor_uf']['symbol_grp'], $this->field_config['valor_uf']['symbol_dec'], "2", "S", $this->field_config['valor_uf']['format_neg'], "", "", "-", $this->field_config['valor_uf']['symbol_fmt']) ; 
      }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $new_campo = '';
          $a_mask_ord  = array();
          $i_mask_size = -1;

          foreach (explode(';', $nm_mask) as $str_mask)
          {
              $a_mask_ord[ $this->nm_conta_mask_chars($str_mask) ] = $str_mask;
          }
          ksort($a_mask_ord);

          foreach ($a_mask_ord as $i_size => $s_mask)
          {
              if (-1 == $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
              elseif (strlen($nm_campo) >= $i_size && strlen($nm_campo) > $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
          }
          $nm_mask = $a_mask_ord[$i_mask_size];

          for ($i = 0; $i < strlen($nm_mask); $i++)
          {
              $test_mask = substr($nm_mask, $i, 1);
              
              if ('9' == $test_mask || 'a' == $test_mask || '*' == $test_mask)
              {
                  $new_campo .= substr($nm_campo, 0, 1);
                  $nm_campo   = substr($nm_campo, 1);
              }
              else
              {
                  $new_campo .= $test_mask;
              }
          }

                  $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont1 < $cont2 && $tam_campo <= $cont2 && $tam_campo > $cont1)
              {
                  $trab_mask = $ver_duas[1];
              }
              elseif ($cont1 > $cont2 && $tam_campo <= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
   function nm_conta_mask_chars($sMask)
   {
       $iLength = 0;

       for ($i = 0; $i < strlen($sMask); $i++)
       {
           if (in_array($sMask[$i], array('9', 'a', '*')))
           {
               $iLength++;
           }
       }

       return $iLength;
   }
   function nm_tira_mask(&$nm_campo, $nm_mask, $nm_chars = '')
   { 
      $mask_dados = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $tam_mask   = strlen($nm_mask);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $raw_campo = $this->sc_clear_mask($nm_campo, $nm_chars);
          $raw_mask  = $this->sc_clear_mask($nm_mask, $nm_chars);
          $new_campo = '';

          $test_mask = substr($raw_mask, 0, 1);
          $raw_mask  = substr($raw_mask, 1);

          while ('' != $raw_campo)
          {
              $test_val  = substr($raw_campo, 0, 1);
              $raw_campo = substr($raw_campo, 1);
              $ord       = ord($test_val);
              $found     = false;

              switch ($test_mask)
              {
                  case '9':
                      if (48 <= $ord && 57 >= $ord)
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case 'a':
                      if ((65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case '*':
                      if ((48 <= $ord && 57 >= $ord) || (65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;
              }

              if ($found)
              {
                  $test_mask = substr($raw_mask, 0, 1);
                  $raw_mask  = substr($raw_mask, 1);
              }
          }

          $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          for ($x=0; $x < strlen($mask_dados); $x++)
          {
              if (is_numeric(substr($mask_dados, $x, 1)))
              {
                  $trab_saida .= substr($mask_dados, $x, 1);
              }
          }
          $nm_campo = $trab_saida;
          return;
      }
      if ($tam_mask > $tam_campo)
      {
         $mask_desfaz = "";
         for ($mask_ind = 0; $tam_mask > $tam_campo; $mask_ind++)
         {
              $mask_char = substr($trab_mask, $mask_ind, 1);
              if ($mask_char == "z")
              {
                  $tam_mask--;
              }
              else
              {
                  $mask_desfaz .= $mask_char;
              }
              if ($mask_ind == $tam_campo)
              {
                  $tam_mask = $tam_campo;
              }
         }
         $trab_mask = $mask_desfaz . substr($trab_mask, $mask_ind);
      }
      $mask_saida = "";
      for ($mask_ind = strlen($trab_mask); $mask_ind > 0; $mask_ind--)
      {
          $mask_char = substr($trab_mask, $mask_ind - 1, 1);
          if ($mask_char == "x" || $mask_char == "z")
          {
              if ($tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
              }
          }
          else
          {
              if ($mask_char != substr($mask_dados, $tam_campo - 1, 1) && $tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
                  $mask_ind--;
              }
          }
          $tam_campo--;
      }
      if ($tam_campo > 0)
      {
         $mask_saida = substr($mask_dados, 0, $tam_campo) . $mask_saida;
      }
      $nm_campo = $mask_saida;
   }

   function sc_clear_mask($value, $chars)
   {
       $new = '';

       for ($i = 0; $i < strlen($value); $i++)
       {
           if (false === strpos($chars, $value[$i]))
           {
               $new .= $value[$i];
           }
       }

       return $new;
   }
//
   function nm_limpa_alfa(&$str)
   {
   }
//
//-- 
   function nm_converte_datas($use_null = true, $bForce = false)
   {
      $guarda_format_hora = $this->field_config['fecha_desde']['date_format'];
      if ($this->fecha_desde != "")  
      { 
          nm_conv_data($this->fecha_desde, $this->field_config['fecha_desde']['date_format']) ; 
          $this->fecha_desde_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->fecha_desde_hora = substr($this->fecha_desde_hora, 0, -4);
          }
      } 
      if ($this->fecha_desde == "" && $use_null)  
      { 
          $this->fecha_desde = "null" ; 
      } 
      $this->field_config['fecha_desde']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['fecha_hasta']['date_format'];
      if ($this->fecha_hasta != "")  
      { 
          nm_conv_data($this->fecha_hasta, $this->field_config['fecha_hasta']['date_format']) ; 
          $this->fecha_hasta_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->fecha_hasta_hora = substr($this->fecha_hasta_hora, 0, -4);
          }
      } 
      if ($this->fecha_hasta == "" && $use_null)  
      { 
          $this->fecha_hasta = "null" ; 
      } 
      $this->field_config['fecha_hasta']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['fecha_desde_factura']['date_format'];
      if ($this->fecha_desde_factura != "")  
      { 
          nm_conv_data($this->fecha_desde_factura, $this->field_config['fecha_desde_factura']['date_format']) ; 
          $this->fecha_desde_factura_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->fecha_desde_factura_hora = substr($this->fecha_desde_factura_hora, 0, -4);
          }
      } 
      if ($this->fecha_desde_factura == "" && $use_null)  
      { 
          $this->fecha_desde_factura = "null" ; 
      } 
      $this->field_config['fecha_desde_factura']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['fecha_hasta_factura']['date_format'];
      if ($this->fecha_hasta_factura != "")  
      { 
          nm_conv_data($this->fecha_hasta_factura, $this->field_config['fecha_hasta_factura']['date_format']) ; 
          $this->fecha_hasta_factura_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->fecha_hasta_factura_hora = substr($this->fecha_hasta_factura_hora, 0, -4);
          }
      } 
      if ($this->fecha_hasta_factura == "" && $use_null)  
      { 
          $this->fecha_hasta_factura = "null" ; 
      } 
      $this->field_config['fecha_hasta_factura']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['fecha']['date_format'];
      if ($this->fecha != "")  
      { 
          nm_conv_data($this->fecha, $this->field_config['fecha']['date_format']) ; 
          $this->fecha_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->fecha_hora = substr($this->fecha_hora, 0, -4);
          }
      } 
      if ($this->fecha == "" && $use_null)  
      { 
          $this->fecha = "null" ; 
      } 
      $this->field_config['fecha']['date_format'] = $guarda_format_hora;
   }
//
   function nm_prep_date_change($cmp_date, $format_dt)
   {
       $vl_return  = "";
       if ($cmp_date != 'null') {
           $vl_return .= (strpos($format_dt, "yy") !== false) ? substr($cmp_date,  0, 4) : "";
           $vl_return .= (strpos($format_dt, "mm") !== false) ? substr($cmp_date,  5, 2) : "";
           $vl_return .= (strpos($format_dt, "dd") !== false) ? substr($cmp_date,  8, 2) : "";
           $vl_return .= (strpos($format_dt, "hh") !== false) ? substr($cmp_date, 11, 2) : "";
           $vl_return .= (strpos($format_dt, "ii") !== false) ? substr($cmp_date, 14, 2) : "";
           $vl_return .= (strpos($format_dt, "ss") !== false) ? substr($cmp_date, 17, 2) : "";
       }
       return $vl_return;
   }
   function nm_conv_data_db($dt_in, $form_in, $form_out, $replaces = array())
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out, $replaces);
           return $dt_out;
       }
   }

   function returnWhere($aCond, $sOp = 'AND')
   {
       $aWhere = array();
       foreach ($aCond as $sCond)
       {
           $this->handleWhereCond($sCond);
           if ('' != $sCond)
           {
               $aWhere[] = $sCond;
           }
       }
       if (empty($aWhere))
       {
           return '';
       }
       else
       {
           return ' WHERE (' . implode(') ' . $sOp . ' (', $aWhere) . ')';
       }
   } // returnWhere

   function handleWhereCond(&$sCond)
   {
       $sCond = trim($sCond);
       if ('where' == strtolower(substr($sCond, 0, 5)))
       {
           $sCond = trim(substr($sCond, 5));
       }
   } // handleWhereCond

   function ajax_return_values()
   {
          $this->ajax_return_values_id();
          $this->ajax_return_values_id_proyecto();
          $this->ajax_return_values_monto_contrato();
          $this->ajax_return_values_tipo_moneda();
          $this->ajax_return_values_empresa();
          $this->ajax_return_values_cliente();
          $this->ajax_return_values_id_partida();
          $this->ajax_return_values_fecha_desde();
          $this->ajax_return_values_fecha_hasta();
          $this->ajax_return_values_dias_desde();
          $this->ajax_return_values_dias_hasta();
          $this->ajax_return_values_dias_periodo();
          $this->ajax_return_values_fecha_desde_factura();
          $this->ajax_return_values_fecha_hasta_factura();
          $this->ajax_return_values_avance_informado_con_iva();
          $this->ajax_return_values_produccion_neto();
          $this->ajax_return_values_retencion();
          $this->ajax_return_values_retencion_con_iva();
          $this->ajax_return_values_retencion_acumulada();
          $this->ajax_return_values_reajuste_acumulado_con_iva();
          $this->ajax_return_values_reajuste_acumulado_neto();
          $this->ajax_return_values_multa();
          $this->ajax_return_values_total_facturado();
          $this->ajax_return_values_afecta_iva();
          $this->ajax_return_values_existe_retencion();
          $this->ajax_return_values_incluye_retencion();
          $this->ajax_return_values_considera_retencion();
          $this->ajax_return_values_facturado();
          $this->ajax_return_values_observaciones_solicitud();
          $this->ajax_return_values_iva();
          $this->ajax_return_values_monto_uf();
          $this->ajax_return_values_fecha();
          $this->ajax_return_values_valor_uf();
          $this->ajax_return_values_observaciones();
          $this->ajax_return_values_factura();
          $this->ajax_return_values_hitos_facturacion();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['id']['keyVal'] = form_prod_presupuesto_periodo_pack_protect_string($this->nmgp_dados_form['id']);
              $this->NM_ajax_info['fldList']['id_proyecto']['keyVal'] = form_prod_presupuesto_periodo_pack_protect_string($this->nmgp_dados_form['id_proyecto']);
          }
   } // ajax_return_values

          //----- id
   function ajax_return_values_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("id", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- id_proyecto
   function ajax_return_values_id_proyecto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id_proyecto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->id_proyecto);
              $aLookup = array();
              $this->_tmp_lookup_id_proyecto = $this->id_proyecto;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT id, nombre_proyecto  FROM proyectos where id=" . $_SESSION['id_proyecto'] . "  ORDER BY nombre_proyecto";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"id_proyecto\"";
          if (isset($this->NM_ajax_info['select_html']['id_proyecto']) && !empty($this->NM_ajax_info['select_html']['id_proyecto']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['id_proyecto']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->id_proyecto == $sValue)
                  {
                      $this->_tmp_lookup_id_proyecto = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("id_proyecto", $this->nmgp_refresh_fields)) ? 'select' : 'text';
          $this->NM_ajax_info['fldList']['id_proyecto'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['id_proyecto']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['id_proyecto']['valList'][$i] = form_prod_presupuesto_periodo_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['id_proyecto']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['id_proyecto']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['id_proyecto']['labList'] = $aLabel;
          }
   }

          //----- monto_contrato
   function ajax_return_values_monto_contrato($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("monto_contrato", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->monto_contrato);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['monto_contrato'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("monto_contrato", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- tipo_moneda
   function ajax_return_values_tipo_moneda($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tipo_moneda", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tipo_moneda);
              $aLookup = array();
              $this->_tmp_lookup_tipo_moneda = $this->tipo_moneda;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    proyectos.tipo_moneda,   prod_monedas.tipo_moneda FROM   proyectos   INNER JOIN prod_monedas ON (proyectos.tipo_moneda = prod_monedas.id) WHERE   proyectos.id =" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"tipo_moneda\"";
          if (isset($this->NM_ajax_info['select_html']['tipo_moneda']) && !empty($this->NM_ajax_info['select_html']['tipo_moneda']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['tipo_moneda']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->tipo_moneda == $sValue)
                  {
                      $this->_tmp_lookup_tipo_moneda = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tipo_moneda'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tipo_moneda']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tipo_moneda']['valList'][$i] = form_prod_presupuesto_periodo_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tipo_moneda']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tipo_moneda']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tipo_moneda']['labList'] = $aLabel;
          }
   }

          //----- empresa
   function ajax_return_values_empresa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("empresa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->empresa);
              $aLookup = array();
              $this->_tmp_lookup_empresa = $this->empresa;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    companias.razon_social,  companias.razon_social FROM   proyectos   INNER JOIN companias ON (proyectos.id_empresa = companias.id) WHERE   proyectos.id =" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"empresa\"";
          if (isset($this->NM_ajax_info['select_html']['empresa']) && !empty($this->NM_ajax_info['select_html']['empresa']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['empresa']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->empresa == $sValue)
                  {
                      $this->_tmp_lookup_empresa = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['empresa'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['empresa']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['empresa']['valList'][$i] = form_prod_presupuesto_periodo_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['empresa']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['empresa']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['empresa']['labList'] = $aLabel;
          }
   }

          //----- cliente
   function ajax_return_values_cliente($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cliente", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cliente);
              $aLookup = array();
              $this->_tmp_lookup_cliente = $this->cliente;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    prod_clientes.nombre,prod_clientes.nombre  FROM   proyectos   INNER JOIN prod_clientes ON (proyectos.id_cliente = prod_clientes.id) WHERE   proyectos.id=" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"cliente\"";
          if (isset($this->NM_ajax_info['select_html']['cliente']) && !empty($this->NM_ajax_info['select_html']['cliente']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['cliente']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->cliente == $sValue)
                  {
                      $this->_tmp_lookup_cliente = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['cliente'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['cliente']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['cliente']['valList'][$i] = form_prod_presupuesto_periodo_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['cliente']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['cliente']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['cliente']['labList'] = $aLabel;
          }
   }

          //----- id_partida
   function ajax_return_values_id_partida($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id_partida", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->id_partida);
              $aLookup = array();
              $this->_tmp_lookup_id_partida = $this->id_partida;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array(); 
}
$aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string('') => str_replace('<', '&lt;',form_prod_presupuesto_periodo_pack_protect_string(' ')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'][] = '';
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT id,concat(month(fecha),'-',year(fecha))   FROM prod_produccion_proyecto  WHERE id_proyecto=" . $_SESSION['id_proyecto'] . "  ORDER BY fecha";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"id_partida\"";
          if (isset($this->NM_ajax_info['select_html']['id_partida']) && !empty($this->NM_ajax_info['select_html']['id_partida']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['id_partida']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->id_partida == $sValue)
                  {
                      $this->_tmp_lookup_id_partida = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("id_partida", $this->nmgp_refresh_fields)) ? 'select' : 'text';
          $this->NM_ajax_info['fldList']['id_partida'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['id_partida']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['id_partida']['valList'][$i] = form_prod_presupuesto_periodo_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['id_partida']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['id_partida']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['id_partida']['labList'] = $aLabel;
          }
   }

          //----- fecha_desde
   function ajax_return_values_fecha_desde($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("fecha_desde", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->fecha_desde);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['fecha_desde'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- fecha_hasta
   function ajax_return_values_fecha_hasta($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("fecha_hasta", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->fecha_hasta);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['fecha_hasta'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- dias_desde
   function ajax_return_values_dias_desde($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dias_desde", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dias_desde);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dias_desde'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("dias_desde", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- dias_hasta
   function ajax_return_values_dias_hasta($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dias_hasta", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dias_hasta);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dias_hasta'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("dias_hasta", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- dias_periodo
   function ajax_return_values_dias_periodo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dias_periodo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dias_periodo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dias_periodo'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("dias_periodo", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- fecha_desde_factura
   function ajax_return_values_fecha_desde_factura($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("fecha_desde_factura", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->fecha_desde_factura);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['fecha_desde_factura'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- fecha_hasta_factura
   function ajax_return_values_fecha_hasta_factura($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("fecha_hasta_factura", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->fecha_hasta_factura);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['fecha_hasta_factura'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- avance_informado_con_iva
   function ajax_return_values_avance_informado_con_iva($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("avance_informado_con_iva", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->avance_informado_con_iva);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['avance_informado_con_iva'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("avance_informado_con_iva", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- produccion_neto
   function ajax_return_values_produccion_neto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("produccion_neto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->produccion_neto);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['produccion_neto'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("produccion_neto", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- retencion
   function ajax_return_values_retencion($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("retencion", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->retencion);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['retencion'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- retencion_con_iva
   function ajax_return_values_retencion_con_iva($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("retencion_con_iva", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->retencion_con_iva);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['retencion_con_iva'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("retencion_con_iva", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- retencion_acumulada
   function ajax_return_values_retencion_acumulada($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("retencion_acumulada", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->retencion_acumulada);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['retencion_acumulada'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("retencion_acumulada", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- reajuste_acumulado_con_iva
   function ajax_return_values_reajuste_acumulado_con_iva($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("reajuste_acumulado_con_iva", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->reajuste_acumulado_con_iva);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['reajuste_acumulado_con_iva'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("reajuste_acumulado_con_iva", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- reajuste_acumulado_neto
   function ajax_return_values_reajuste_acumulado_neto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("reajuste_acumulado_neto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->reajuste_acumulado_neto);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['reajuste_acumulado_neto'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("reajuste_acumulado_neto", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- multa
   function ajax_return_values_multa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("multa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->multa);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['multa'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- total_facturado
   function ajax_return_values_total_facturado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("total_facturado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->total_facturado);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['total_facturado'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("total_facturado", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- afecta_iva
   function ajax_return_values_afecta_iva($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("afecta_iva", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->afecta_iva);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['afecta_iva'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- existe_retencion
   function ajax_return_values_existe_retencion($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("existe_retencion", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->existe_retencion);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['existe_retencion'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- incluye_retencion
   function ajax_return_values_incluye_retencion($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("incluye_retencion", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->incluye_retencion);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['incluye_retencion'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- considera_retencion
   function ajax_return_values_considera_retencion($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("considera_retencion", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->considera_retencion);
              $aLookup = array();
              $this->_tmp_lookup_considera_retencion = $this->considera_retencion;

$aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string('0') => str_replace('<', '&lt;',form_prod_presupuesto_periodo_pack_protect_string("NO")));
$aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string('1') => str_replace('<', '&lt;',form_prod_presupuesto_periodo_pack_protect_string("SI")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_considera_retencion'][] = '0';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_considera_retencion'][] = '1';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"considera_retencion\"";
          if (isset($this->NM_ajax_info['select_html']['considera_retencion']) && !empty($this->NM_ajax_info['select_html']['considera_retencion']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['considera_retencion']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->considera_retencion == $sValue)
                  {
                      $this->_tmp_lookup_considera_retencion = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['considera_retencion'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['considera_retencion']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['considera_retencion']['valList'][$i] = form_prod_presupuesto_periodo_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['considera_retencion']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['considera_retencion']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['considera_retencion']['labList'] = $aLabel;
          }
   }

          //----- facturado
   function ajax_return_values_facturado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("facturado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->facturado);
              $aLookup = array();
              $this->_tmp_lookup_facturado = $this->facturado;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array(); 
}
$aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string('0') => str_replace('<', '&lt;',form_prod_presupuesto_periodo_pack_protect_string(' ')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'][] = '0';
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    prod_estado_facturacion.valor_estado,   prod_estado_facturacion.estado FROM   prod_estado_facturacion WHERE   prod_estado_facturacion.grupo = '" . $_SESSION['group_name'] . "'";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"facturado\"";
          if (isset($this->NM_ajax_info['select_html']['facturado']) && !empty($this->NM_ajax_info['select_html']['facturado']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['facturado']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->facturado == $sValue)
                  {
                      $this->_tmp_lookup_facturado = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['facturado'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['facturado']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['facturado']['valList'][$i] = form_prod_presupuesto_periodo_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['facturado']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['facturado']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['facturado']['labList'] = $aLabel;
          }
   }

          //----- observaciones_solicitud
   function ajax_return_values_observaciones_solicitud($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("observaciones_solicitud", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->observaciones_solicitud);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['observaciones_solicitud'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- iva
   function ajax_return_values_iva($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("iva", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->iva);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['iva'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- monto_uf
   function ajax_return_values_monto_uf($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("monto_uf", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->monto_uf);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['monto_uf'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("monto_uf", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- fecha
   function ajax_return_values_fecha($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("fecha", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->fecha);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['fecha'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- valor_uf
   function ajax_return_values_valor_uf($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valor_uf", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valor_uf);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valor_uf'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- observaciones
   function ajax_return_values_observaciones($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("observaciones", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->observaciones);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['observaciones'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- factura
   function ajax_return_values_factura($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("factura", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->factura);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->factura, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_factura_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['download_filenames'][$sTmpFile] = $this->factura;
              $tmp_file_factura = trim(NM_charset_to_utf8($this->factura));
              $tmp_icon_factura = '';
              if ('' != $tmp_file_factura)
              {
                  $tmp_icon_factura = $this->gera_icone($tmp_file_factura);
              }
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['factura'] = array(
                       'row'    => '',
               'type'    => 'documento',
               'valList' => array($sTmpValue),
               'docLink' => "<a href=\"javascript:nm_mostra_doc('0', '" . $sTmpFile . "', 'form_prod_presupuesto_periodo')\">" . $tmp_file_factura . "</a>",
               'docIcon' => $tmp_icon_factura,
               'docReadonly' => "N",
              );
              if ('navigate_form' == $this->NM_ajax_opcao)
              {
                  $this->NM_ajax_info['fldList']['factura_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
          }
   }

          //----- hitos_facturacion
   function ajax_return_values_hitos_facturacion($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hitos_facturacion", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hitos_facturacion);
              $aLookup = array();
              $this->_tmp_lookup_hitos_facturacion = $this->hitos_facturacion;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_hitos_facturacion']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_hitos_facturacion'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_hitos_facturacion']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_hitos_facturacion'] = array(); 
}
if ($this->id_partida != "")
{ 
   $this->nm_clear_val("id_partida");
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    prod_hitos_proyectos.id_hito, prod_hitos_contractuales.nombre  FROM   prod_hitos_proyectos   INNER JOIN prod_hitos_contractuales ON (prod_hitos_proyectos.id_hito = prod_hitos_contractuales.id)   INNER JOIN prod_hitos_tipo ON (prod_hitos_contractuales.id_tipo_hito = prod_hitos_tipo.id) WHERE   prod_hitos_proyectos.id_partida_presupuesto_periodo =$this->id_partida";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_prod_presupuesto_periodo_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_hitos_facturacion'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
} 
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hitos_facturacion'] = array(
                       'row'    => '',
               'type'    => 'duplosel',
               'valList' => explode((false === strpos($this->hitos_facturacion, '@?@') ? ';' : '@?@'), $sTmpValue),
               'optList' => $aLookup,
               'colNum'  => 7,
              );
              end($this->NM_ajax_info['fldList']['hitos_facturacion']['valList']);
              if ('' == current($this->NM_ajax_info['fldList']['hitos_facturacion']['valList']))
              {
                  array_pop($this->NM_ajax_info['fldList']['hitos_facturacion']['valList']);
              }
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hitos_facturacion']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hitos_facturacion']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hitos_facturacion']['labList'] = $aLabel;
          }
   }

    function fetchUniqueUploadName($originalName, $uploadDir, $fieldName)
    {
        $originalName = trim($originalName);
        if ('' == $originalName)
        {
            return $originalName;
        }
        if (!@is_dir($uploadDir))
        {
            return $originalName;
        }
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['upload_dir'][$fieldName][] = $newName;
            return $newName;
        }
    } // fetchUniqueUploadName

    function fetchFileNextName($uniqueName, $uniqueList)
    {
        $aPathinfo     = pathinfo($uniqueName);
        $fileExtension = $aPathinfo['extension'];
        $fileName      = $aPathinfo['filename'];
        $foundName     = false;
        $nameIt        = 1;
        if ('' != $fileExtension)
        {
            $fileExtension = '.' . $fileExtension;
        }
        while (!$foundName)
        {
            $testName = $fileName . '(' . $nameIt . ')' . $fileExtension;
            if (in_array($testName, $uniqueList))
            {
                $nameIt++;
            }
            else
            {
                $foundName = true;
                return $testName;
            }
        }
    } // fetchFileNextName

   function ajax_add_parameters()
   {
   } // ajax_add_parameters
  function nm_proc_onload($bFormat = true)
  {
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_afecta_iva = $this->afecta_iva;
    $original_avance_informado_con_iva = $this->avance_informado_con_iva;
    $original_existe_retencion = $this->existe_retencion;
    $original_facturado = $this->facturado;
    $original_fecha_desde_factura = $this->fecha_desde_factura;
    $original_fecha_hasta_factura = $this->fecha_hasta_factura;
    $original_id = $this->id;
    $original_id_partida = $this->id_partida;
    $original_incluye_retencion = $this->incluye_retencion;
    $original_iva = $this->iva;
    $original_monto_contrato = $this->monto_contrato;
    $original_monto_uf = $this->monto_uf;
    $original_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
    $original_retencion = $this->retencion;
    $original_retencion_acumulada = $this->retencion_acumulada;
    $original_retencion_con_iva = $this->retencion_con_iva;
}
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
if (!isset($this->sc_temp_group_name)) {$this->sc_temp_group_name = (isset($_SESSION['group_name'])) ? $_SESSION['group_name'] : "";}
if (!isset($this->sc_temp_usr_group)) {$this->sc_temp_usr_group = (isset($_SESSION['usr_group'])) ? $_SESSION['usr_group'] : "";}
  if ($this->facturado =="2" and ($this->sc_temp_usr_group<>"6" and $this->sc_temp_usr_group<>"1"))  
	{	
		echo "<script>alert('El estado de Facturación no permite edición')</script>";
	    echo "<script type=\"text/javascript\">";
echo "setTimeout(function() { window.location = \"" . $this->nmgp_url_saida . "?script_case_init=" . $this->form_encode_input($this->Ini->sc_page) . "\"; }, 500);";
echo "</script>";
if (isset($this->sc_temp_usr_group)) { $_SESSION['usr_group'] = $this->sc_temp_usr_group;}
if (isset($this->sc_temp_group_name)) { $_SESSION['group_name'] = $this->sc_temp_group_name;}
if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
exit;
}

if ($this->facturado =="3" and ($this->sc_temp_usr_group<>"4" and $this->sc_temp_usr_group<>"1"))  
	{	
		echo "<script>alert('El estado de Facturación no permite edición')</script>";
	    echo "<script type=\"text/javascript\">";
echo "setTimeout(function() { window.location = \"" . $this->nmgp_url_saida . "?script_case_init=" . $this->form_encode_input($this->Ini->sc_page) . "\"; }, 500);";
echo "</script>";
if (isset($this->sc_temp_usr_group)) { $_SESSION['usr_group'] = $this->sc_temp_usr_group;}
if (isset($this->sc_temp_group_name)) { $_SESSION['group_name'] = $this->sc_temp_group_name;}
if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
exit;
}

if ($this->facturado =="1" and ($this->sc_temp_usr_group<>"1"))  
	{	
		echo "<script>alert('El estado de Facturación no permite edición')</script>";
	    echo "<script type=\"text/javascript\">";
echo "setTimeout(function() { window.location = \"" . $this->nmgp_url_saida . "?script_case_init=" . $this->form_encode_input($this->Ini->sc_page) . "\"; }, 500);";
echo "</script>";
if (isset($this->sc_temp_usr_group)) { $_SESSION['usr_group'] = $this->sc_temp_usr_group;}
if (isset($this->sc_temp_group_name)) { $_SESSION['group_name'] = $this->sc_temp_group_name;}
if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
exit;
}

if ($this->facturado <>"2" and ($this->sc_temp_usr_group=="6"))  
	{	
		echo "<script>alert('El estado de Facturación no permite edición')</script>";
	    echo "<script type=\"text/javascript\">";
echo "setTimeout(function() { window.location = \"" . $this->nmgp_url_saida . "?script_case_init=" . $this->form_encode_input($this->Ini->sc_page) . "\"; }, 500);";
echo "</script>";
if (isset($this->sc_temp_usr_group)) { $_SESSION['usr_group'] = $this->sc_temp_usr_group;}
if (isset($this->sc_temp_group_name)) { $_SESSION['group_name'] = $this->sc_temp_group_name;}
if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
exit;
}

if ($this->sc_temp_usr_group<>"6" and $this->sc_temp_usr_group<>"1" and $this->sc_temp_usr_group<>"4")  
	{	
		echo "<script>alert('El estado de Facturación no permite edición')</script>";
	    echo "<script type=\"text/javascript\">";
echo "setTimeout(function() { window.location = \"" . $this->nmgp_url_saida . "?script_case_init=" . $this->form_encode_input($this->Ini->sc_page) . "\"; }, 500);";
echo "</script>";
if (isset($this->sc_temp_usr_group)) { $_SESSION['usr_group'] = $this->sc_temp_usr_group;}
if (isset($this->sc_temp_group_name)) { $_SESSION['group_name'] = $this->sc_temp_group_name;}
if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
exit;
}


	  
$this->retencion_acumulada =0;
if ($this->fecha_desde_factura =="" or $this->fecha_hasta_factura =="")
{
	$this->reajuste_con_iva =0;
}

$produccion_facturada=0;

if ($this->facturado ==1 and $this->sc_temp_group_name<>"Administrador")
	{
	$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'off';;
	}

if ($this->id_partida =="")
	{
	$this->id_partida =0;
	}


$check_sql = "SELECT 
  proyectos.incluye_retencion,
  proyectos.existe_retencion,
  proyectos.afecta_iva 
FROM
  proyectos
WHERE
  proyectos.id =".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			if ($this->rs[0][0]==1)
				{
				  $this->incluye_retencion ="SI";
				}
			else
				{
					$this->incluye_retencion ="NO";
				}
		}
		else     
					
		{
			$this->incluye_retencion ="NO";
							
		}
	
	if (isset($this->rs[0][1]))     
		{
			if ($this->rs[0][1]==1)
				{
				  $this->existe_retencion ="SI";
				}
			else
				{
					$this->existe_retencion ="NO";
				}
			
		}
				else     
		{
			$this->existe_retencion ="NO";
					
		}

		if (isset($this->rs[0][2]))     
		{
			if ($this->rs[0][2]==1)
				{
				  $this->afecta_iva ="SI";
				}
			else
				{
					$this->afecta_iva ="NO";
				}
			
		}
				else     
		{
			$this->afecta_iva ="NO";
					
		}
		
if ($this->afecta_iva =="NO")
	{
	  $this->nmgp_cmp_hidden["avance_informado_con_iva"] = 'off'; $this->NM_ajax_info['fieldDisplay']['avance_informado_con_iva'] = 'off';$this->nmgp_cmp_hidden["retencion_con_iva"] = 'off'; $this->NM_ajax_info['fieldDisplay']['retencion_con_iva'] = 'off';$this->nmgp_cmp_hidden["reajuste_acumulado_con_iva"] = 'off'; $this->NM_ajax_info['fieldDisplay']['reajuste_acumulado_con_iva'] = 'off';$this->nmgp_cmp_hidden["iva"] = 'off'; $this->NM_ajax_info['fieldDisplay']['iva'] = 'off';}





$check_sql = "SELECT SUM(prod_presupuesto.monto_uf) as monto_total FROM prod_presupuesto WHERE prod_presupuesto.id_partida_periodo <=".$this->id_partida ." AND prod_presupuesto.id_proyecto = ".$this->sc_temp_id_proyecto;


 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


if (isset($this->rs[0][0]))     
{
    $monto_total= $this->rs[0][0];
   
}
		else     
{
	$monto_total=0;
}

$this->monto_contrato =$monto_total;

if ($this->id >0)
	{
$check_sql = "SELECT correlativo_mes,modificacion_contrato from prod_produccion_proyecto where id=".$this->id_partida ." and id_proyecto = ".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$correlativo = $this->rs[0][0];
			$this->modificacion_contrato =$this->rs[0][1];

		}
				else     
		{
			$correlativo =0;
			$this->modificacion_contrato =0;
		}

$check_sql = "SELECT COUNT(prod_partida_presupuesto_periodo.id_item) AS FIELD_1 FROM  prod_partida_presupuesto_periodo WHERE    prod_partida_presupuesto_periodo.id_presupuesto_periodo =".$this->id ." and prod_partida_presupuesto_periodo.id_proyecto=".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
				$numero_items = $this->rs[0][0];
		}
				else     
		{
			    $numero_items =0;
		}
	
$check_sql = "SELECT COUNT(prod_items_proyecto.id_item) AS FIELD_1 FROM prod_items_proyecto WHERE  prod_items_proyecto.id_proyecto =".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
				$numero_items_base = $this->rs[0][0];
		}
				else     
		{
			    $numero_items_base =0;
		}
$this->iva =$this->monto_uf  * 1.19;

if ($numero_items<$numero_items_base)
	{
	}
}

			if ($this->existe_retencion =="NO")
			 
			  {
				  $this->retencion_con_iva = 0;
				  $this->retencion =0;
			  }

			  if ($this->incluye_retencion =="SI")
			  {
			  	$this->produccion_ep =$this->avance_informado_con_iva  ;
			  } 
			  else
			  {
			  	$this->produccion_ep =$this->avance_informado_con_iva  - $this->retencion_con_iva ;
			  }

$this->sc_field_readonly("iva", 'on');
$this->sc_field_readonly("avance", 'on');
$this->sc_field_readonly("avance_partida", 'on');
$this->sc_field_readonly("monto_contrato", 'on');
if (isset($this->sc_temp_usr_group)) { $_SESSION['usr_group'] = $this->sc_temp_usr_group;}
if (isset($this->sc_temp_group_name)) { $_SESSION['group_name'] = $this->sc_temp_group_name;}
if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_afecta_iva != $this->afecta_iva || (isset($bFlagRead_afecta_iva) && $bFlagRead_afecta_iva)))
    {
        $this->ajax_return_values_afecta_iva(true);
    }
    if (($original_avance_informado_con_iva != $this->avance_informado_con_iva || (isset($bFlagRead_avance_informado_con_iva) && $bFlagRead_avance_informado_con_iva)))
    {
        $this->ajax_return_values_avance_informado_con_iva(true);
    }
    if (($original_existe_retencion != $this->existe_retencion || (isset($bFlagRead_existe_retencion) && $bFlagRead_existe_retencion)))
    {
        $this->ajax_return_values_existe_retencion(true);
    }
    if (($original_facturado != $this->facturado || (isset($bFlagRead_facturado) && $bFlagRead_facturado)))
    {
        $this->ajax_return_values_facturado(true);
    }
    if (($original_fecha_desde_factura != $this->fecha_desde_factura || (isset($bFlagRead_fecha_desde_factura) && $bFlagRead_fecha_desde_factura)))
    {
        $this->ajax_return_values_fecha_desde_factura(true);
    }
    if (($original_fecha_hasta_factura != $this->fecha_hasta_factura || (isset($bFlagRead_fecha_hasta_factura) && $bFlagRead_fecha_hasta_factura)))
    {
        $this->ajax_return_values_fecha_hasta_factura(true);
    }
    if (($original_id != $this->id || (isset($bFlagRead_id) && $bFlagRead_id)))
    {
        $this->ajax_return_values_id(true);
    }
    if (($original_id_partida != $this->id_partida || (isset($bFlagRead_id_partida) && $bFlagRead_id_partida)))
    {
        $this->ajax_return_values_id_partida(true);
    }
    if (($original_incluye_retencion != $this->incluye_retencion || (isset($bFlagRead_incluye_retencion) && $bFlagRead_incluye_retencion)))
    {
        $this->ajax_return_values_incluye_retencion(true);
    }
    if (($original_iva != $this->iva || (isset($bFlagRead_iva) && $bFlagRead_iva)))
    {
        $this->ajax_return_values_iva(true);
    }
    if (($original_monto_contrato != $this->monto_contrato || (isset($bFlagRead_monto_contrato) && $bFlagRead_monto_contrato)))
    {
        $this->ajax_return_values_monto_contrato(true);
    }
    if (($original_monto_uf != $this->monto_uf || (isset($bFlagRead_monto_uf) && $bFlagRead_monto_uf)))
    {
        $this->ajax_return_values_monto_uf(true);
    }
    if (($original_reajuste_acumulado_con_iva != $this->reajuste_acumulado_con_iva || (isset($bFlagRead_reajuste_acumulado_con_iva) && $bFlagRead_reajuste_acumulado_con_iva)))
    {
        $this->ajax_return_values_reajuste_acumulado_con_iva(true);
    }
    if (($original_retencion != $this->retencion || (isset($bFlagRead_retencion) && $bFlagRead_retencion)))
    {
        $this->ajax_return_values_retencion(true);
    }
    if (($original_retencion_acumulada != $this->retencion_acumulada || (isset($bFlagRead_retencion_acumulada) && $bFlagRead_retencion_acumulada)))
    {
        $this->ajax_return_values_retencion_acumulada(true);
    }
    if (($original_retencion_con_iva != $this->retencion_con_iva || (isset($bFlagRead_retencion_con_iva) && $bFlagRead_retencion_con_iva)))
    {
        $this->ajax_return_values_retencion_con_iva(true);
    }
}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off'; 
      }
      $this->nm_guardar_campos();
      if ($bFormat) $this->nm_formatar_campos();
  }
//
//----------------------------------------------------
//-----> 
//----------------------------------------------------
//
   function nm_troca_decimal($sc_parm1, $sc_parm2) 
   { 
      $this->monto_contrato = str_replace($sc_parm1, $sc_parm2, $this->monto_contrato); 
      $this->avance_informado_con_iva = str_replace($sc_parm1, $sc_parm2, $this->avance_informado_con_iva); 
      $this->produccion_neto = str_replace($sc_parm1, $sc_parm2, $this->produccion_neto); 
      $this->retencion = str_replace($sc_parm1, $sc_parm2, $this->retencion); 
      $this->retencion_con_iva = str_replace($sc_parm1, $sc_parm2, $this->retencion_con_iva); 
      $this->reajuste_acumulado_con_iva = str_replace($sc_parm1, $sc_parm2, $this->reajuste_acumulado_con_iva); 
      $this->reajuste_acumulado_neto = str_replace($sc_parm1, $sc_parm2, $this->reajuste_acumulado_neto); 
      $this->multa = str_replace($sc_parm1, $sc_parm2, $this->multa); 
      $this->iva = str_replace($sc_parm1, $sc_parm2, $this->iva); 
      $this->monto_uf = str_replace($sc_parm1, $sc_parm2, $this->monto_uf); 
      $this->valor_uf = str_replace($sc_parm1, $sc_parm2, $this->valor_uf); 
      $this->avance = str_replace($sc_parm1, $sc_parm2, $this->avance); 
      $this->reajuste = str_replace($sc_parm1, $sc_parm2, $this->reajuste); 
      $this->factor_produccion = str_replace($sc_parm1, $sc_parm2, $this->factor_produccion); 
      $this->avance_periodo = str_replace($sc_parm1, $sc_parm2, $this->avance_periodo); 
      $this->avance_periodo_siguiente = str_replace($sc_parm1, $sc_parm2, $this->avance_periodo_siguiente); 
      $this->avance_informado = str_replace($sc_parm1, $sc_parm2, $this->avance_informado); 
      $this->avance_periodo_anterior = str_replace($sc_parm1, $sc_parm2, $this->avance_periodo_anterior); 
      $this->produccion_total_final = str_replace($sc_parm1, $sc_parm2, $this->produccion_total_final); 
      $this->produccion_ep = str_replace($sc_parm1, $sc_parm2, $this->produccion_ep); 
      $this->reajuste_con_iva = str_replace($sc_parm1, $sc_parm2, $this->reajuste_con_iva); 
      $this->modificacion_contrato = str_replace($sc_parm1, $sc_parm2, $this->modificacion_contrato); 
      $this->monto_disponible = str_replace($sc_parm1, $sc_parm2, $this->monto_disponible); 
      $this->porcentaje_retencion = str_replace($sc_parm1, $sc_parm2, $this->porcentaje_retencion); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->monto_contrato = "'" . $this->monto_contrato . "'";
      $this->avance_informado_con_iva = "'" . $this->avance_informado_con_iva . "'";
      $this->produccion_neto = "'" . $this->produccion_neto . "'";
      $this->retencion = "'" . $this->retencion . "'";
      $this->retencion_con_iva = "'" . $this->retencion_con_iva . "'";
      $this->reajuste_acumulado_con_iva = "'" . $this->reajuste_acumulado_con_iva . "'";
      $this->reajuste_acumulado_neto = "'" . $this->reajuste_acumulado_neto . "'";
      $this->multa = "'" . $this->multa . "'";
      $this->iva = "'" . $this->iva . "'";
      $this->monto_uf = "'" . $this->monto_uf . "'";
      $this->valor_uf = "'" . $this->valor_uf . "'";
      $this->avance = "'" . $this->avance . "'";
      $this->reajuste = "'" . $this->reajuste . "'";
      $this->factor_produccion = "'" . $this->factor_produccion . "'";
      $this->avance_periodo = "'" . $this->avance_periodo . "'";
      $this->avance_periodo_siguiente = "'" . $this->avance_periodo_siguiente . "'";
      $this->avance_informado = "'" . $this->avance_informado . "'";
      $this->avance_periodo_anterior = "'" . $this->avance_periodo_anterior . "'";
      $this->produccion_total_final = "'" . $this->produccion_total_final . "'";
      $this->produccion_ep = "'" . $this->produccion_ep . "'";
      $this->reajuste_con_iva = "'" . $this->reajuste_con_iva . "'";
      $this->modificacion_contrato = "'" . $this->modificacion_contrato . "'";
      $this->monto_disponible = "'" . $this->monto_disponible . "'";
      $this->porcentaje_retencion = "'" . $this->porcentaje_retencion . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->monto_contrato = str_replace("'", "", $this->monto_contrato); 
      $this->avance_informado_con_iva = str_replace("'", "", $this->avance_informado_con_iva); 
      $this->produccion_neto = str_replace("'", "", $this->produccion_neto); 
      $this->retencion = str_replace("'", "", $this->retencion); 
      $this->retencion_con_iva = str_replace("'", "", $this->retencion_con_iva); 
      $this->reajuste_acumulado_con_iva = str_replace("'", "", $this->reajuste_acumulado_con_iva); 
      $this->reajuste_acumulado_neto = str_replace("'", "", $this->reajuste_acumulado_neto); 
      $this->multa = str_replace("'", "", $this->multa); 
      $this->iva = str_replace("'", "", $this->iva); 
      $this->monto_uf = str_replace("'", "", $this->monto_uf); 
      $this->valor_uf = str_replace("'", "", $this->valor_uf); 
      $this->avance = str_replace("'", "", $this->avance); 
      $this->reajuste = str_replace("'", "", $this->reajuste); 
      $this->factor_produccion = str_replace("'", "", $this->factor_produccion); 
      $this->avance_periodo = str_replace("'", "", $this->avance_periodo); 
      $this->avance_periodo_siguiente = str_replace("'", "", $this->avance_periodo_siguiente); 
      $this->avance_informado = str_replace("'", "", $this->avance_informado); 
      $this->avance_periodo_anterior = str_replace("'", "", $this->avance_periodo_anterior); 
      $this->produccion_total_final = str_replace("'", "", $this->produccion_total_final); 
      $this->produccion_ep = str_replace("'", "", $this->produccion_ep); 
      $this->reajuste_con_iva = str_replace("'", "", $this->reajuste_con_iva); 
      $this->modificacion_contrato = str_replace("'", "", $this->modificacion_contrato); 
      $this->monto_disponible = str_replace("'", "", $this->monto_disponible); 
      $this->porcentaje_retencion = str_replace("'", "", $this->porcentaje_retencion); 
   } 
//----------- 


   function temRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       if ($rsc === false && !$rsc->EOF)
       {
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
           exit; 
       }
       $iTotal = $rsc->fields[0];
       $rsc->Close();
       return 0 < $iTotal;
   } // temRegistros

   function deletaRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'DELETE FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       $bResult = $rsc;
       $rsc->Close();
       return $bResult == true;
   } // deletaRegistros
    function handleDbErrorMessage(&$dbErrorMessage, $dbErrorCode)
    {
        if (1267 == $dbErrorCode) {
            $dbErrorMessage = $this->Ini->Nm_lang['lang_errm_db_invalid_collation'];
        }
    }


   function nm_acessa_banco() 
   { 
      global  $nm_form_submit, $teste_validade, $sc_where;
 
      $NM_val_null = array();
      $NM_val_form = array();
      $this->sc_erro_insert = "";
      $this->sc_erro_update = "";
      $this->sc_erro_delete = "";
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
    if ("alterar" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
  	
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $this->nmgp_opcao ; 
          if ($this->nmgp_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          else
          { 
              $this->sc_evento = ""; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->NM_rollback_db(); 
          $this->Campos_Mens_erro = ""; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $salva_opcao = $this->nmgp_opcao; 
      if ($this->sc_evento != "novo" && $this->sc_evento != "incluir") 
      { 
          $this->sc_evento = ""; 
      } 
      if ((!isset($this->Ini->nm_bases_access) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) && !$this->Ini->sc_tem_trans_banco && in_array($this->nmgp_opcao, array('excluir', 'incluir', 'alterar')))
      { 
          $this->Ini->sc_tem_trans_banco = $this->Db->BeginTrans(); 
      } 
      if (!isset($this->id_proyecto)){$this->id_proyecto =  $_SESSION['id_proyecto'];}  
      if ('incluir' == $this->nmgp_opcao) { $this->id_proyecto = "" . $_SESSION['id_proyecto'] . ""; } 
      if ('alterar' == $this->nmgp_opcao || 'igual' == $this->nmgp_opcao) { $this->id_proyecto = "" . $_SESSION['id_proyecto'] . ""; } 
      $NM_val_form['id'] = $this->id;
      $NM_val_form['id_proyecto'] = $this->id_proyecto;
      $NM_val_form['monto_contrato'] = $this->monto_contrato;
      $NM_val_form['tipo_moneda'] = $this->tipo_moneda;
      $NM_val_form['empresa'] = $this->empresa;
      $NM_val_form['cliente'] = $this->cliente;
      $NM_val_form['id_partida'] = $this->id_partida;
      $NM_val_form['fecha_desde'] = $this->fecha_desde;
      $NM_val_form['fecha_hasta'] = $this->fecha_hasta;
      $NM_val_form['dias_desde'] = $this->dias_desde;
      $NM_val_form['dias_hasta'] = $this->dias_hasta;
      $NM_val_form['dias_periodo'] = $this->dias_periodo;
      $NM_val_form['fecha_desde_factura'] = $this->fecha_desde_factura;
      $NM_val_form['fecha_hasta_factura'] = $this->fecha_hasta_factura;
      $NM_val_form['avance_informado_con_iva'] = $this->avance_informado_con_iva;
      $NM_val_form['produccion_neto'] = $this->produccion_neto;
      $NM_val_form['retencion'] = $this->retencion;
      $NM_val_form['retencion_con_iva'] = $this->retencion_con_iva;
      $NM_val_form['retencion_acumulada'] = $this->retencion_acumulada;
      $NM_val_form['reajuste_acumulado_con_iva'] = $this->reajuste_acumulado_con_iva;
      $NM_val_form['reajuste_acumulado_neto'] = $this->reajuste_acumulado_neto;
      $NM_val_form['multa'] = $this->multa;
      $NM_val_form['total_facturado'] = $this->total_facturado;
      $NM_val_form['afecta_iva'] = $this->afecta_iva;
      $NM_val_form['existe_retencion'] = $this->existe_retencion;
      $NM_val_form['incluye_retencion'] = $this->incluye_retencion;
      $NM_val_form['considera_retencion'] = $this->considera_retencion;
      $NM_val_form['facturado'] = $this->facturado;
      $NM_val_form['observaciones_solicitud'] = $this->observaciones_solicitud;
      $NM_val_form['iva'] = $this->iva;
      $NM_val_form['monto_uf'] = $this->monto_uf;
      $NM_val_form['fecha'] = $this->fecha;
      $NM_val_form['valor_uf'] = $this->valor_uf;
      $NM_val_form['observaciones'] = $this->observaciones;
      $NM_val_form['factura'] = $this->factura;
      $NM_val_form['hitos_facturacion'] = $this->hitos_facturacion;
      $NM_val_form['id_item'] = $this->id_item;
      $NM_val_form['vigente'] = $this->vigente;
      $NM_val_form['orden'] = $this->orden;
      $NM_val_form['avance'] = $this->avance;
      $NM_val_form['reajuste'] = $this->reajuste;
      $NM_val_form['factor_produccion'] = $this->factor_produccion;
      $NM_val_form['avance_periodo'] = $this->avance_periodo;
      $NM_val_form['avance_periodo_siguiente'] = $this->avance_periodo_siguiente;
      $NM_val_form['avance_informado'] = $this->avance_informado;
      $NM_val_form['avance_periodo_anterior'] = $this->avance_periodo_anterior;
      $NM_val_form['produccion_total_final'] = $this->produccion_total_final;
      $NM_val_form['total_facturado_ur'] = $this->total_facturado_ur;
      $NM_val_form['produccion_ep'] = $this->produccion_ep;
      $NM_val_form['reajuste_con_iva'] = $this->reajuste_con_iva;
      $NM_val_form['modificacion_contrato'] = $this->modificacion_contrato;
      $NM_val_form['monto_disponible'] = $this->monto_disponible;
      $NM_val_form['porcentaje_retencion'] = $this->porcentaje_retencion;
      if ($this->id === "" || is_null($this->id))  
      { 
          $this->id = 0;
      } 
      if ($this->id_proyecto === "" || is_null($this->id_proyecto))  
      { 
          $this->id_proyecto = 0;
      } 
      if ($this->id_item === "" || is_null($this->id_item))  
      { 
          $this->id_item = 0;
          $this->sc_force_zero[] = 'id_item';
      } 
      if ($this->monto_uf === "" || is_null($this->monto_uf))  
      { 
          $this->monto_uf = 0;
          $this->sc_force_zero[] = 'monto_uf';
      } 
      if ($this->vigente === "" || is_null($this->vigente))  
      { 
          $this->vigente = 0;
          $this->sc_force_zero[] = 'vigente';
      } 
      if ($this->orden === "" || is_null($this->orden))  
      { 
          $this->orden = 0;
          $this->sc_force_zero[] = 'orden';
      } 
      if ($this->id_partida === "" || is_null($this->id_partida))  
      { 
          $this->id_partida = 0;
          $this->sc_force_zero[] = 'id_partida';
      } 
      if ($this->avance === "" || is_null($this->avance))  
      { 
          $this->avance = 0;
          $this->sc_force_zero[] = 'avance';
      } 
      if ($this->facturado === "" || is_null($this->facturado))  
      { 
          $this->facturado = 0;
          $this->sc_force_zero[] = 'facturado';
      } 
      if ($this->valor_uf === "" || is_null($this->valor_uf))  
      { 
          $this->valor_uf = 0;
          $this->sc_force_zero[] = 'valor_uf';
      } 
      if ($this->tipo_moneda === "" || is_null($this->tipo_moneda))  
      { 
          $this->tipo_moneda = 0;
          $this->sc_force_zero[] = 'tipo_moneda';
      } 
      if ($this->retencion === "" || is_null($this->retencion))  
      { 
          $this->retencion = 0;
          $this->sc_force_zero[] = 'retencion';
      } 
      if ($this->reajuste === "" || is_null($this->reajuste))  
      { 
          $this->reajuste = 0;
          $this->sc_force_zero[] = 'reajuste';
      } 
      if ($this->multa === "" || is_null($this->multa))  
      { 
          $this->multa = 0;
          $this->sc_force_zero[] = 'multa';
      } 
      if ($this->dias_desde === "" || is_null($this->dias_desde))  
      { 
          $this->dias_desde = 0;
          $this->sc_force_zero[] = 'dias_desde';
      } 
      if ($this->dias_hasta === "" || is_null($this->dias_hasta))  
      { 
          $this->dias_hasta = 0;
          $this->sc_force_zero[] = 'dias_hasta';
      } 
      if ($this->factor_produccion === "" || is_null($this->factor_produccion))  
      { 
          $this->factor_produccion = 0;
          $this->sc_force_zero[] = 'factor_produccion';
      } 
      if ($this->dias_periodo === "" || is_null($this->dias_periodo))  
      { 
          $this->dias_periodo = 0;
          $this->sc_force_zero[] = 'dias_periodo';
      } 
      if ($this->avance_periodo === "" || is_null($this->avance_periodo))  
      { 
          $this->avance_periodo = 0;
          $this->sc_force_zero[] = 'avance_periodo';
      } 
      if ($this->avance_periodo_siguiente === "" || is_null($this->avance_periodo_siguiente))  
      { 
          $this->avance_periodo_siguiente = 0;
          $this->sc_force_zero[] = 'avance_periodo_siguiente';
      } 
      if ($this->avance_informado === "" || is_null($this->avance_informado))  
      { 
          $this->avance_informado = 0;
          $this->sc_force_zero[] = 'avance_informado';
      } 
      if ($this->avance_periodo_anterior === "" || is_null($this->avance_periodo_anterior))  
      { 
          $this->avance_periodo_anterior = 0;
          $this->sc_force_zero[] = 'avance_periodo_anterior';
      } 
      if ($this->produccion_total_final === "" || is_null($this->produccion_total_final))  
      { 
          $this->produccion_total_final = 0;
          $this->sc_force_zero[] = 'produccion_total_final';
      } 
      if ($this->total_facturado === "" || is_null($this->total_facturado))  
      { 
          $this->total_facturado = 0;
          $this->sc_force_zero[] = 'total_facturado';
      } 
      if ($this->total_facturado_ur === "" || is_null($this->total_facturado_ur))  
      { 
          $this->total_facturado_ur = 0;
          $this->sc_force_zero[] = 'total_facturado_ur';
      } 
      if ($this->avance_informado_con_iva === "" || is_null($this->avance_informado_con_iva))  
      { 
          $this->avance_informado_con_iva = 0;
          $this->sc_force_zero[] = 'avance_informado_con_iva';
      } 
      if ($this->produccion_ep === "" || is_null($this->produccion_ep))  
      { 
          $this->produccion_ep = 0;
          $this->sc_force_zero[] = 'produccion_ep';
      } 
      if ($this->reajuste_con_iva === "" || is_null($this->reajuste_con_iva))  
      { 
          $this->reajuste_con_iva = 0;
          $this->sc_force_zero[] = 'reajuste_con_iva';
      } 
      if ($this->retencion_con_iva === "" || is_null($this->retencion_con_iva))  
      { 
          $this->retencion_con_iva = 0;
          $this->sc_force_zero[] = 'retencion_con_iva';
      } 
      if ($this->produccion_neto === "" || is_null($this->produccion_neto))  
      { 
          $this->produccion_neto = 0;
          $this->sc_force_zero[] = 'produccion_neto';
      } 
      if ($this->reajuste_acumulado_neto === "" || is_null($this->reajuste_acumulado_neto))  
      { 
          $this->reajuste_acumulado_neto = 0;
          $this->sc_force_zero[] = 'reajuste_acumulado_neto';
      } 
      if ($this->reajuste_acumulado_con_iva === "" || is_null($this->reajuste_acumulado_con_iva))  
      { 
          $this->reajuste_acumulado_con_iva = 0;
          $this->sc_force_zero[] = 'reajuste_acumulado_con_iva';
      } 
      if ($this->considera_retencion === "" || is_null($this->considera_retencion))  
      { 
          $this->considera_retencion = 0;
          $this->sc_force_zero[] = 'considera_retencion';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_mysql, $this->Ini->nm_bases_sqlite);
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->fecha == "")  
          { 
              $this->fecha = "null"; 
              $NM_val_null[] = "fecha";
          } 
          $this->observaciones_before_qstr = $this->observaciones;
          $this->observaciones = substr($this->Db->qstr($this->observaciones), 1, -1); 
          $this->factura_original_filename = $this->factura; 
          $this->factura_before_qstr = $this->factura;
          $this->factura = substr($this->Db->qstr($this->factura), 1, -1); 
          if ($this->fecha_desde == "")  
          { 
              $this->fecha_desde = "null"; 
              $NM_val_null[] = "fecha_desde";
          } 
          if ($this->fecha_hasta == "")  
          { 
              $this->fecha_hasta = "null"; 
              $NM_val_null[] = "fecha_hasta";
          } 
          if ($this->fecha_desde_factura == "")  
          { 
              $this->fecha_desde_factura = "null"; 
              $NM_val_null[] = "fecha_desde_factura";
          } 
          if ($this->fecha_hasta_factura == "")  
          { 
              $this->fecha_hasta_factura = "null"; 
              $NM_val_null[] = "fecha_hasta_factura";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto = $this->id_proyecto ";
          $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto = $this->id_proyecto "); 
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_prod_presupuesto_periodo_pack_ajax_response();
              }
              exit; 
          }  
          $bUpdateOk = true;
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $bUpdateOk = false;
              $this->sc_evento = 'update';
          } 
          $aUpdateOk = array();
          $bUpdateOk = $bUpdateOk && empty($aUpdateOk);
          if ($bUpdateOk)
          { 
              $rs1->Close(); 
              $aDoNotUpdate = array();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "fecha = " . $this->Ini->date_delim . $this->fecha . $this->Ini->date_delim1 . ", observaciones = '$this->observaciones', facturado = $this->facturado, valor_uf = $this->valor_uf, tipo_moneda = $this->tipo_moneda, retencion = $this->retencion, multa = $this->multa, fecha_desde = " . $this->Ini->date_delim . $this->fecha_desde . $this->Ini->date_delim1 . ", fecha_hasta = " . $this->Ini->date_delim . $this->fecha_hasta . $this->Ini->date_delim1 . ", fecha_desde_factura = " . $this->Ini->date_delim . $this->fecha_desde_factura . $this->Ini->date_delim1 . ", fecha_hasta_factura = " . $this->Ini->date_delim . $this->fecha_hasta_factura . $this->Ini->date_delim1 . ", considera_retencion = $this->considera_retencion"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "fecha = " . $this->Ini->date_delim . $this->fecha . $this->Ini->date_delim1 . ", observaciones = '$this->observaciones', facturado = $this->facturado, valor_uf = $this->valor_uf, tipo_moneda = $this->tipo_moneda, retencion = $this->retencion, multa = $this->multa, fecha_desde = " . $this->Ini->date_delim . $this->fecha_desde . $this->Ini->date_delim1 . ", fecha_hasta = " . $this->Ini->date_delim . $this->fecha_hasta . $this->Ini->date_delim1 . ", fecha_desde_factura = " . $this->Ini->date_delim . $this->fecha_desde_factura . $this->Ini->date_delim1 . ", fecha_hasta_factura = " . $this->Ini->date_delim . $this->fecha_hasta_factura . $this->Ini->date_delim1 . ", considera_retencion = $this->considera_retencion"; 
              } 
              if (isset($NM_val_form['id_item']) && $NM_val_form['id_item'] != $this->nmgp_dados_select['id_item']) 
              { 
                  $SC_fields_update[] = "id_item = $this->id_item"; 
              } 
              if (isset($NM_val_form['monto_uf']) && $NM_val_form['monto_uf'] != $this->nmgp_dados_select['monto_uf']) 
              { 
                  $SC_fields_update[] = "monto_uf = $this->monto_uf"; 
              } 
              if (isset($NM_val_form['vigente']) && $NM_val_form['vigente'] != $this->nmgp_dados_select['vigente']) 
              { 
                  $SC_fields_update[] = "vigente = $this->vigente"; 
              } 
              if (isset($NM_val_form['orden']) && $NM_val_form['orden'] != $this->nmgp_dados_select['orden']) 
              { 
                  $SC_fields_update[] = "orden = $this->orden"; 
              } 
              if (isset($NM_val_form['id_partida']) && $NM_val_form['id_partida'] != $this->nmgp_dados_select['id_partida']) 
              { 
                  $SC_fields_update[] = "id_partida = $this->id_partida"; 
              } 
              if (isset($NM_val_form['avance']) && $NM_val_form['avance'] != $this->nmgp_dados_select['avance']) 
              { 
                  $SC_fields_update[] = "avance = $this->avance"; 
              } 
              if (isset($NM_val_form['reajuste']) && $NM_val_form['reajuste'] != $this->nmgp_dados_select['reajuste']) 
              { 
                  $SC_fields_update[] = "reajuste = $this->reajuste"; 
              } 
              if (isset($NM_val_form['dias_desde']) && $NM_val_form['dias_desde'] != $this->nmgp_dados_select['dias_desde']) 
              { 
                  $SC_fields_update[] = "dias_desde = $this->dias_desde"; 
              } 
              if (isset($NM_val_form['dias_hasta']) && $NM_val_form['dias_hasta'] != $this->nmgp_dados_select['dias_hasta']) 
              { 
                  $SC_fields_update[] = "dias_hasta = $this->dias_hasta"; 
              } 
              if (isset($NM_val_form['factor_produccion']) && $NM_val_form['factor_produccion'] != $this->nmgp_dados_select['factor_produccion']) 
              { 
                  $SC_fields_update[] = "factor_produccion = $this->factor_produccion"; 
              } 
              if (isset($NM_val_form['dias_periodo']) && $NM_val_form['dias_periodo'] != $this->nmgp_dados_select['dias_periodo']) 
              { 
                  $SC_fields_update[] = "dias_periodo = $this->dias_periodo"; 
              } 
              if (isset($NM_val_form['avance_periodo']) && $NM_val_form['avance_periodo'] != $this->nmgp_dados_select['avance_periodo']) 
              { 
                  $SC_fields_update[] = "avance_periodo = $this->avance_periodo"; 
              } 
              if (isset($NM_val_form['avance_periodo_siguiente']) && $NM_val_form['avance_periodo_siguiente'] != $this->nmgp_dados_select['avance_periodo_siguiente']) 
              { 
                  $SC_fields_update[] = "avance_periodo_siguiente = $this->avance_periodo_siguiente"; 
              } 
              if (isset($NM_val_form['avance_informado']) && $NM_val_form['avance_informado'] != $this->nmgp_dados_select['avance_informado']) 
              { 
                  $SC_fields_update[] = "avance_informado = $this->avance_informado"; 
              } 
              if (isset($NM_val_form['avance_periodo_anterior']) && $NM_val_form['avance_periodo_anterior'] != $this->nmgp_dados_select['avance_periodo_anterior']) 
              { 
                  $SC_fields_update[] = "avance_periodo_anterior = $this->avance_periodo_anterior"; 
              } 
              if (isset($NM_val_form['produccion_total_final']) && $NM_val_form['produccion_total_final'] != $this->nmgp_dados_select['produccion_total_final']) 
              { 
                  $SC_fields_update[] = "produccion_total_final = $this->produccion_total_final"; 
              } 
              if (isset($NM_val_form['total_facturado']) && $NM_val_form['total_facturado'] != $this->nmgp_dados_select['total_facturado']) 
              { 
                  $SC_fields_update[] = "total_facturado = $this->total_facturado"; 
              } 
              if (isset($NM_val_form['total_facturado_ur']) && $NM_val_form['total_facturado_ur'] != $this->nmgp_dados_select['total_facturado_ur']) 
              { 
                  $SC_fields_update[] = "total_facturado_ur = $this->total_facturado_ur"; 
              } 
              if (isset($NM_val_form['avance_informado_con_iva']) && $NM_val_form['avance_informado_con_iva'] != $this->nmgp_dados_select['avance_informado_con_iva']) 
              { 
                  $SC_fields_update[] = "avance_informado_con_iva = $this->avance_informado_con_iva"; 
              } 
              if (isset($NM_val_form['produccion_ep']) && $NM_val_form['produccion_ep'] != $this->nmgp_dados_select['produccion_ep']) 
              { 
                  $SC_fields_update[] = "produccion_ep = $this->produccion_ep"; 
              } 
              if (isset($NM_val_form['reajuste_con_iva']) && $NM_val_form['reajuste_con_iva'] != $this->nmgp_dados_select['reajuste_con_iva']) 
              { 
                  $SC_fields_update[] = "reajuste_con_iva = $this->reajuste_con_iva"; 
              } 
              if (isset($NM_val_form['retencion_con_iva']) && $NM_val_form['retencion_con_iva'] != $this->nmgp_dados_select['retencion_con_iva']) 
              { 
                  $SC_fields_update[] = "retencion_con_iva = $this->retencion_con_iva"; 
              } 
              if (isset($NM_val_form['produccion_neto']) && $NM_val_form['produccion_neto'] != $this->nmgp_dados_select['produccion_neto']) 
              { 
                  $SC_fields_update[] = "produccion_neto = $this->produccion_neto"; 
              } 
              if (isset($NM_val_form['reajuste_acumulado_neto']) && $NM_val_form['reajuste_acumulado_neto'] != $this->nmgp_dados_select['reajuste_acumulado_neto']) 
              { 
                  $SC_fields_update[] = "reajuste_acumulado_neto = $this->reajuste_acumulado_neto"; 
              } 
              if (isset($NM_val_form['reajuste_acumulado_con_iva']) && $NM_val_form['reajuste_acumulado_con_iva'] != $this->nmgp_dados_select['reajuste_acumulado_con_iva']) 
              { 
                  $SC_fields_update[] = "reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva"; 
              } 
              $temp_cmd_sql = "";
              if ($this->factura_limpa == "S")
              {
                  if ($this->factura != "null")
                  {
                      $this->factura = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                  }
                  else
                  {
                      $temp_cmd_sql = "factura = '" . $this->factura . "'";
                  }
                  $this->factura = "";
              }
              else
              {
                  if ($this->factura != "none" && $this->factura != "")
                  {
                      $NM_conteudo =  $this->factura;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      }
                      else
                      {
                          $temp_cmd_sql .= " factura = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "factura";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              if ($this->factura_limpa == "S" || ($this->factura != "none" && $this->factura != "" && in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql)) 
                  { 
                      $SC_fields_update[] = "factura = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite)) 
                  { 
                      $SC_fields_update[] = "factura = ''"; 
                  } 
                  else 
                  { 
                      $SC_fields_update[] = "factura = empty_blob()"; 
                  } 
              } 
              $comando .= implode(",", $SC_fields_update);  
              $comando .= " WHERE id = $this->id and id_proyecto = $this->id_proyecto ";  
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              $useUpdateProcedure = false;
              if (!empty($SC_fields_update) || $useUpdateProcedure)
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
                  $rs = $this->Db->Execute($comando);  
                  if ($rs === false) 
                  { 
                      if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                      {
                          $dbErrorMessage = $this->Db->ErrorMsg();
                          $dbErrorCode = $this->Db->ErrorNo();
                          $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $dbErrorMessage, true);
                          if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                          { 
                              $this->sc_erro_update = $dbErrorMessage;
                              $this->NM_rollback_db(); 
                              if ($this->NM_ajax_flag)
                              {
                                  form_prod_presupuesto_periodo_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->observaciones = $this->observaciones_before_qstr;
              $this->factura = $this->factura_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  if ($this->factura_limpa == "S" && (!isset($this->Ini->nm_bases_oracle) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) && (!isset($this->Ini->nm_bases_informix) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))) 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"factura\", \"\",  \"id = $this->id and id_proyecto = $this->id_proyecto\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "factura", "",  "id = $this->id and id_proyecto = $this->id_proyecto"); 
                  } 
                  else 
                  { 
                      if ($this->factura != "none" && $this->factura != "") 
                      { 
                          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"factura\", $this->factura,  \"id = $this->id and id_proyecto = $this->id_proyecto\")"; 
                          $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "factura", $this->factura,  "id = $this->id and id_proyecto = $this->id_proyecto"); 
                      } 
                  } 
                  if ($rs === false) 
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_prod_presupuesto_periodo_pack_ajax_response();
                      }
                      exit;  
                  }   
              }   
              if ($this->factura_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['factura_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
                  $this->NM_ajax_info['fldList']['factura_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }


              if     (isset($NM_val_form) && isset($NM_val_form['id'])) { $this->id = $NM_val_form['id']; }
              elseif (isset($this->id)) { $this->nm_limpa_alfa($this->id); }
              if     (isset($NM_val_form) && isset($NM_val_form['id_proyecto'])) { $this->id_proyecto = $NM_val_form['id_proyecto']; }
              elseif (isset($this->id_proyecto)) { $this->nm_limpa_alfa($this->id_proyecto); }
              if     (isset($NM_val_form) && isset($NM_val_form['monto_uf'])) { $this->monto_uf = $NM_val_form['monto_uf']; }
              elseif (isset($this->monto_uf)) { $this->nm_limpa_alfa($this->monto_uf); }
              if     (isset($NM_val_form) && isset($NM_val_form['observaciones'])) { $this->observaciones = $NM_val_form['observaciones']; }
              elseif (isset($this->observaciones)) { $this->nm_limpa_alfa($this->observaciones); }
              if     (isset($NM_val_form) && isset($NM_val_form['id_partida'])) { $this->id_partida = $NM_val_form['id_partida']; }
              elseif (isset($this->id_partida)) { $this->nm_limpa_alfa($this->id_partida); }
              if     (isset($NM_val_form) && isset($NM_val_form['facturado'])) { $this->facturado = $NM_val_form['facturado']; }
              elseif (isset($this->facturado)) { $this->nm_limpa_alfa($this->facturado); }
              if     (isset($NM_val_form) && isset($NM_val_form['valor_uf'])) { $this->valor_uf = $NM_val_form['valor_uf']; }
              elseif (isset($this->valor_uf)) { $this->nm_limpa_alfa($this->valor_uf); }
              if     (isset($NM_val_form) && isset($NM_val_form['tipo_moneda'])) { $this->tipo_moneda = $NM_val_form['tipo_moneda']; }
              elseif (isset($this->tipo_moneda)) { $this->nm_limpa_alfa($this->tipo_moneda); }
              if     (isset($NM_val_form) && isset($NM_val_form['retencion'])) { $this->retencion = $NM_val_form['retencion']; }
              elseif (isset($this->retencion)) { $this->nm_limpa_alfa($this->retencion); }
              if     (isset($NM_val_form) && isset($NM_val_form['multa'])) { $this->multa = $NM_val_form['multa']; }
              elseif (isset($this->multa)) { $this->nm_limpa_alfa($this->multa); }
              if     (isset($NM_val_form) && isset($NM_val_form['dias_desde'])) { $this->dias_desde = $NM_val_form['dias_desde']; }
              elseif (isset($this->dias_desde)) { $this->nm_limpa_alfa($this->dias_desde); }
              if     (isset($NM_val_form) && isset($NM_val_form['dias_hasta'])) { $this->dias_hasta = $NM_val_form['dias_hasta']; }
              elseif (isset($this->dias_hasta)) { $this->nm_limpa_alfa($this->dias_hasta); }
              if     (isset($NM_val_form) && isset($NM_val_form['dias_periodo'])) { $this->dias_periodo = $NM_val_form['dias_periodo']; }
              elseif (isset($this->dias_periodo)) { $this->nm_limpa_alfa($this->dias_periodo); }
              if     (isset($NM_val_form) && isset($NM_val_form['total_facturado'])) { $this->total_facturado = $NM_val_form['total_facturado']; }
              elseif (isset($this->total_facturado)) { $this->nm_limpa_alfa($this->total_facturado); }
              if     (isset($NM_val_form) && isset($NM_val_form['avance_informado_con_iva'])) { $this->avance_informado_con_iva = $NM_val_form['avance_informado_con_iva']; }
              elseif (isset($this->avance_informado_con_iva)) { $this->nm_limpa_alfa($this->avance_informado_con_iva); }
              if     (isset($NM_val_form) && isset($NM_val_form['retencion_con_iva'])) { $this->retencion_con_iva = $NM_val_form['retencion_con_iva']; }
              elseif (isset($this->retencion_con_iva)) { $this->nm_limpa_alfa($this->retencion_con_iva); }
              if     (isset($NM_val_form) && isset($NM_val_form['produccion_neto'])) { $this->produccion_neto = $NM_val_form['produccion_neto']; }
              elseif (isset($this->produccion_neto)) { $this->nm_limpa_alfa($this->produccion_neto); }
              if     (isset($NM_val_form) && isset($NM_val_form['reajuste_acumulado_neto'])) { $this->reajuste_acumulado_neto = $NM_val_form['reajuste_acumulado_neto']; }
              elseif (isset($this->reajuste_acumulado_neto)) { $this->nm_limpa_alfa($this->reajuste_acumulado_neto); }
              if     (isset($NM_val_form) && isset($NM_val_form['reajuste_acumulado_con_iva'])) { $this->reajuste_acumulado_con_iva = $NM_val_form['reajuste_acumulado_con_iva']; }
              elseif (isset($this->reajuste_acumulado_con_iva)) { $this->nm_limpa_alfa($this->reajuste_acumulado_con_iva); }
              if     (isset($NM_val_form) && isset($NM_val_form['considera_retencion'])) { $this->considera_retencion = $NM_val_form['considera_retencion']; }
              elseif (isset($this->considera_retencion)) { $this->nm_limpa_alfa($this->considera_retencion); }

              $this->nm_formatar_campos();

              $bChange_factura = false;
              if (isset($this->factura_original_filename) && '' != $this->factura_original_filename && $this->factura_original_filename != $this->factura)
              {
                  $sTmpOrig_factura = $this->factura;
                  $this->factura    = $this->factura_original_filename;
                  $bChange_factura  = true;
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('id', 'id_proyecto', 'monto_contrato', 'tipo_moneda', 'empresa', 'cliente', 'id_partida', 'fecha_desde', 'fecha_hasta', 'dias_desde', 'dias_hasta', 'dias_periodo', 'fecha_desde_factura', 'fecha_hasta_factura', 'avance_informado_con_iva', 'produccion_neto', 'retencion', 'retencion_con_iva', 'retencion_acumulada', 'reajuste_acumulado_con_iva', 'reajuste_acumulado_neto', 'multa', 'total_facturado', 'afecta_iva', 'existe_retencion', 'incluye_retencion', 'considera_retencion', 'facturado', 'observaciones_solicitud', 'iva', 'monto_uf', 'fecha', 'valor_uf', 'observaciones', 'factura', 'hitos_facturacion'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              if ($bChange_factura)
              {
                  $this->factura                   = $sTmpOrig_factura;
                  $this->factura_original_filename = '';
              }

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
          $sc_campos_sel_look  = array();
          $sc_campos_form_look = array();
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select id_presupuesto_periodo, id_hito, estado, fecha_hito, adjunto, link_externo from prod_presupuesto_periodo_hitos where id_presupuesto_periodo = $this->id"; 
          $rss = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
          if ($rss === false && !$rss->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $sc_ind = 0; 
          while (!$rss->EOF) 
          { 
              $sc_campos_sel_look[$sc_ind] = array();
              $sc_campos_sel_look[$sc_ind]['id_presupuesto_periodo'] = $rss->fields[0];
              $sc_campos_sel_look[$sc_ind]['id_hito'] = $rss->fields[1];
              $sc_campos_sel_look[$sc_ind]['estado'] = $rss->fields[2];
              $sc_campos_sel_look[$sc_ind]['fecha_hito'] = $rss->fields[3];
              $sc_campos_sel_look[$sc_ind]['adjunto'] = $rss->fields[4];
              $sc_campos_sel_look[$sc_ind]['link_externo'] = $rss->fields[5];
              $sc_ind++; 
              $rss->MoveNext() ; 
          } 
          $rss->Close(); 
          $todo_hitos_facturacion = explode("@?@", $this->hitos_facturacion); 
          if (!empty($todo_hitos_facturacion))  
          { 
              $sc_ind = 0; 
              foreach ($todo_hitos_facturacion as $hitos_facturacionx) 
              {
                  if ($hitos_facturacionx != "")  
                  { 
                      $sc_campos_form_look[$sc_ind] = array();
                      $sc_campos_form_look[$sc_ind]['id'] = $this->id;
                      $sc_campos_form_look[$sc_ind]['hitos_facturacion'] = $hitos_facturacionx;
                      $sc_campos_form_look[$sc_ind]['@nm@null'] = "null";
                      $sc_campos_form_look[$sc_ind]['@nm@null'] = "null";
                      $sc_campos_form_look[$sc_ind]['@nm@null'] = "null";
                      $sc_campos_form_look[$sc_ind]['@nm@null'] = "null";
                 } 
                 $sc_ind++; 
              } 
         } 
         foreach ($sc_campos_form_look as $sc_ind_form => $sc_campos_form) 
         { 
             foreach ($sc_campos_sel_look as $sc_ind_sel => $sc_campos_sel) 
             { 
                 if ($sc_campos_form['id'] == $sc_campos_sel['id_presupuesto_periodo'] && $sc_campos_form['hitos_facturacion'] == $sc_campos_sel['id_hito'])
                 {
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "update prod_presupuesto_periodo_hitos set estado = " . $sc_campos_form['@nm@null'] . ",fecha_hito = " . $sc_campos_form['@nm@null'] . ",adjunto = " . $sc_campos_form['@nm@null'] . ",link_externo = " . $sc_campos_form['@nm@null'] . " where id_presupuesto_periodo = " . $sc_campos_form['id'] . " and id_hito = '" . $sc_campos_form['hitos_facturacion'] . "'";
                      $rsu = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                      if ($rsu === false) 
                      { 
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $this->Db->ErrorMsg()); 
                          $this->Db->RollbackTrans(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_prod_presupuesto_periodo_pack_ajax_response();
                          }
                          exit; 
                      } 
                      $rsu->Close(); 
                     unset($sc_campos_form_look[$sc_ind_form]);
                     unset($sc_campos_sel_look[$sc_ind_sel]);
                     break;
                 }
             }
         }
         foreach ($sc_campos_sel_look as $sc_ind_sel => $sc_campos_sel) 
         { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "delete from prod_presupuesto_periodo_hitos where id_presupuesto_periodo = " . $sc_campos_sel['id_presupuesto_periodo'] . " and id_hito = '" . $sc_campos_sel['id_hito'] . "'"; 
              $rdel = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
              if ($rdel === false) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dele'], $this->Db->ErrorMsg()); 
                  $this->NM_rollback_db(); 
                  if ($this->NM_ajax_flag)
                  {
                      form_prod_presupuesto_periodo_pack_ajax_response();
                  }
                  exit; 
              } 
              $rdel->Close(); 
         }
         foreach ($sc_campos_form_look as $sc_ind_form => $sc_campos_form) 
         { 
             $_SESSION['scriptcase']['sc_sql_ult_comando'] = "insert into prod_presupuesto_periodo_hitos (id_presupuesto_periodo, id_hito, estado, fecha_hito, adjunto, link_externo) values (" . $sc_campos_form['id']. ", '" . $sc_campos_form['hitos_facturacion'] . "', null, null, null, null)"; 
             $_SESSION['scriptcase']['sc_sql_ult_comando'] = str_replace("'null'", "null", $_SESSION['scriptcase']['sc_sql_ult_comando']) ; 
             $_SESSION['scriptcase']['sc_sql_ult_comando'] = str_replace("#null#", "null", $_SESSION['scriptcase']['sc_sql_ult_comando']) ; 
             $rins = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
             if ($rins === false)  
             { 
                 if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                 {
                     $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
                     $this->NM_rollback_db(); 
                     if ($this->NM_ajax_flag)
                     {
                         form_prod_presupuesto_periodo_pack_ajax_response();
                     }
                     exit; 
                 }
             } 
             else { 
                 $rins->Close(); 
             } 
         }
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "id, ";
          } 
          $bInsertOk = true;
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto = $this->id_proyecto "; 
          $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto = $this->id_proyecto "); 
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 0) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_pkey']); 
              $this->nmgp_opcao = "nada"; 
              $GLOBALS["erro_incl"] = 1; 
              $bInsertOk = false;
              $this->sc_evento = 'insert';
          } 
          $rs1->Close(); 
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_prod_presupuesto_periodo_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              $dir_file = $this->Ini->path_doc . "/" . $this->nm_tira_formatacao_id_proyecto($this->id_proyecto) . "" . $this->nm_tira_formatacao_id_partida($this->id_partida) . "/"; 
              $_test_file = $this->fetchUniqueUploadName($this->factura_scfile_name, $dir_file, "factura");
              if (trim($this->factura_scfile_name) != $_test_file)
              {
                  $this->factura_scfile_name = $_test_file;
                  $this->factura = $_test_file;
              }
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "id_proyecto, id_item, fecha, monto_uf, vigente, observaciones, orden, id_partida, avance, facturado, valor_uf, factura, tipo_moneda, retencion, reajuste, multa, fecha_desde, fecha_hasta, dias_desde, dias_hasta, factor_produccion, dias_periodo, avance_periodo, avance_periodo_siguiente, avance_informado, avance_periodo_anterior, produccion_total_final, total_facturado, total_facturado_ur, fecha_desde_factura, fecha_hasta_factura, avance_informado_con_iva, produccion_ep, reajuste_con_iva, retencion_con_iva, produccion_neto, reajuste_acumulado_neto, reajuste_acumulado_con_iva, considera_retencion) VALUES (" . $NM_seq_auto . "$this->id_proyecto, $this->id_item, " . $this->Ini->date_delim . $this->fecha . $this->Ini->date_delim1 . ", $this->monto_uf, $this->vigente, '$this->observaciones', $this->orden, $this->id_partida, $this->avance, $this->facturado, $this->valor_uf, '', $this->tipo_moneda, $this->retencion, $this->reajuste, $this->multa, " . $this->Ini->date_delim . $this->fecha_desde . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->fecha_hasta . $this->Ini->date_delim1 . ", $this->dias_desde, $this->dias_hasta, $this->factor_produccion, $this->dias_periodo, $this->avance_periodo, $this->avance_periodo_siguiente, $this->avance_informado, $this->avance_periodo_anterior, $this->produccion_total_final, $this->total_facturado, $this->total_facturado_ur, " . $this->Ini->date_delim . $this->fecha_desde_factura . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->fecha_hasta_factura . $this->Ini->date_delim1 . ", $this->avance_informado_con_iva, $this->produccion_ep, $this->reajuste_con_iva, $this->retencion_con_iva, $this->produccion_neto, $this->reajuste_acumulado_neto, $this->reajuste_acumulado_con_iva, $this->considera_retencion)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "id_proyecto, id_item, fecha, monto_uf, vigente, observaciones, orden, id_partida, avance, facturado, valor_uf, factura, tipo_moneda, retencion, reajuste, multa, fecha_desde, fecha_hasta, dias_desde, dias_hasta, factor_produccion, dias_periodo, avance_periodo, avance_periodo_siguiente, avance_informado, avance_periodo_anterior, produccion_total_final, total_facturado, total_facturado_ur, fecha_desde_factura, fecha_hasta_factura, avance_informado_con_iva, produccion_ep, reajuste_con_iva, retencion_con_iva, produccion_neto, reajuste_acumulado_neto, reajuste_acumulado_con_iva, considera_retencion) VALUES (" . $NM_seq_auto . "$this->id_proyecto, $this->id_item, " . $this->Ini->date_delim . $this->fecha . $this->Ini->date_delim1 . ", $this->monto_uf, $this->vigente, '$this->observaciones', $this->orden, $this->id_partida, $this->avance, $this->facturado, $this->valor_uf, '', $this->tipo_moneda, $this->retencion, $this->reajuste, $this->multa, " . $this->Ini->date_delim . $this->fecha_desde . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->fecha_hasta . $this->Ini->date_delim1 . ", $this->dias_desde, $this->dias_hasta, $this->factor_produccion, $this->dias_periodo, $this->avance_periodo, $this->avance_periodo_siguiente, $this->avance_informado, $this->avance_periodo_anterior, $this->produccion_total_final, $this->total_facturado, $this->total_facturado_ur, " . $this->Ini->date_delim . $this->fecha_desde_factura . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->fecha_hasta_factura . $this->Ini->date_delim1 . ", $this->avance_informado_con_iva, $this->produccion_ep, $this->reajuste_con_iva, $this->retencion_con_iva, $this->produccion_neto, $this->reajuste_acumulado_neto, $this->reajuste_acumulado_con_iva, $this->considera_retencion)"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "id_proyecto, id_item, fecha, monto_uf, vigente, observaciones, orden, id_partida, avance, facturado, valor_uf, factura, tipo_moneda, retencion, reajuste, multa, fecha_desde, fecha_hasta, dias_desde, dias_hasta, factor_produccion, dias_periodo, avance_periodo, avance_periodo_siguiente, avance_informado, avance_periodo_anterior, produccion_total_final, total_facturado, total_facturado_ur, fecha_desde_factura, fecha_hasta_factura, avance_informado_con_iva, produccion_ep, reajuste_con_iva, retencion_con_iva, produccion_neto, reajuste_acumulado_neto, reajuste_acumulado_con_iva, considera_retencion) VALUES (" . $NM_seq_auto . "$this->id_proyecto, $this->id_item, " . $this->Ini->date_delim . $this->fecha . $this->Ini->date_delim1 . ", $this->monto_uf, $this->vigente, '$this->observaciones', $this->orden, $this->id_partida, $this->avance, $this->facturado, $this->valor_uf, '$this->factura', $this->tipo_moneda, $this->retencion, $this->reajuste, $this->multa, " . $this->Ini->date_delim . $this->fecha_desde . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->fecha_hasta . $this->Ini->date_delim1 . ", $this->dias_desde, $this->dias_hasta, $this->factor_produccion, $this->dias_periodo, $this->avance_periodo, $this->avance_periodo_siguiente, $this->avance_informado, $this->avance_periodo_anterior, $this->produccion_total_final, $this->total_facturado, $this->total_facturado_ur, " . $this->Ini->date_delim . $this->fecha_desde_factura . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->fecha_hasta_factura . $this->Ini->date_delim1 . ", $this->avance_informado_con_iva, $this->produccion_ep, $this->reajuste_con_iva, $this->retencion_con_iva, $this->produccion_neto, $this->reajuste_acumulado_neto, $this->reajuste_acumulado_con_iva, $this->considera_retencion)"; 
              }
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
              $rs = $this->Db->Execute($comando); 
              if ($rs === false)  
              { 
                  if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                  {
                      $dbErrorMessage = $this->Db->ErrorMsg();
                      $dbErrorCode = $this->Db->ErrorNo();
                      $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $dbErrorMessage, true);
                      if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
                      { 
                          $this->sc_erro_insert = $dbErrorMessage;
                          $this->nmgp_opcao     = 'refresh_insert';
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_prod_presupuesto_periodo_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_id()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_rowid()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->observaciones = $this->observaciones_before_qstr;
              $this->factura = $this->factura_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  if (trim($this->factura ) != "") 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ",  factura , $this->factura,  \"id = $this->id and id_proyecto = $this->id_proyecto\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "factura", $this->factura,  "id = $this->id and id_proyecto = $this->id_proyecto"); 
                      if ($rs === false)  
                      { 
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_prod_presupuesto_periodo_pack_ajax_response();
                          }
                          exit; 
                      }  
                  }  
              }  
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total']);
              }

              $dir_doc = $this->Ini->path_doc . "/" . $this->nm_tira_formatacao_id_proyecto($this->id_proyecto) . "" . $this->nm_tira_formatacao_id_partida($this->id_partida) . "/"; 
              if (nm_mkdir($dir_doc))  
              { 
                  $reg_factura = ""; 
                  if (is_file($this->SC_DOC_factura)) { 
                      $arq_factura = fopen($this->SC_DOC_factura, "r") ; 
                      $reg_factura = fread($arq_factura, filesize($this->SC_DOC_factura)) ; 
                      fclose($arq_factura) ;  
                      $arq_factura = fopen($dir_doc . trim($this->factura_scfile_name), "w") ; 
                      fwrite($arq_factura, $reg_factura) ;  
                      fclose($arq_factura) ;  
                  }
              } 
              $this->sc_evento = "insert"; 
              $this->observaciones = $this->observaciones_before_qstr;
              $this->factura = $this->factura_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          $todo_hitos_facturacion = explode("@?@", $this->hitos_facturacion); 
          if ($bInsertOk && !empty($todo_hitos_facturacion))  
          { 
              foreach ($todo_hitos_facturacion as $hitos_facturacionx) 
              {
                  if ($hitos_facturacionx != "")  
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "insert into prod_presupuesto_periodo_hitos (id_presupuesto_periodo, id_hito, estado, fecha_hito, adjunto, link_externo) values ($this->id, '$hitos_facturacionx', null, null, null, null)"; 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = str_replace("'null'", "null", $_SESSION['scriptcase']['sc_sql_ult_comando']) ; 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = str_replace("#null#", "null", $_SESSION['scriptcase']['sc_sql_ult_comando']) ; 
                      $rs = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                      if ($rs === false && !$rs->EOF)  
                      { 
                          if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                          {
                              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
                              $this->NM_rollback_db(); 
                              if ($this->NM_ajax_flag)
                              {
                                  form_prod_presupuesto_periodo_pack_ajax_response();
                              }
                              exit; 
                          } 
                      } 
                      $rs->Close(); 
                  } 
              } 
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->id = substr($this->Db->qstr($this->id), 1, -1); 
          $this->id_proyecto = substr($this->Db->qstr($this->id_proyecto), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto = $this->id_proyecto"; 
          $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto = $this->id_proyecto "); 
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_dele_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $this->sc_evento = 'delete';
          } 
          else 
          { 
              $rs1->Close(); 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "delete from prod_presupuesto_periodo_hitos where id_presupuesto_periodo = $this->id"; 
              $rse = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
              if ($rse === false) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dele'], $this->Db->ErrorMsg()); 
                  $this->NM_rollback_db(); 
                  if ($this->NM_ajax_flag)
                  {
                      form_prod_presupuesto_periodo_pack_ajax_response();
                  }
                  exit; 
              } 
              $rse->Close(); 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto = $this->id_proyecto "; 
              $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto = $this->id_proyecto "); 
              if ($rs === false) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dele'], $this->Db->ErrorMsg(), true); 
                  if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                  { 
                      $this->sc_erro_delete = $this->Db->ErrorMsg();  
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_prod_presupuesto_periodo_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              if (empty($this->sc_erro_delete)) {
                  $this->record_delete_ok = true;
              }
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total']);
              }

              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }
          }

          }
          else
          {
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "igual"; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $sMsgErro); 
          }

      }  
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
      if (!empty($NM_val_null))
      {
          foreach ($NM_val_null as $i_val_null => $sc_val_null_field)
          {
              eval('$this->' . $sc_val_null_field . ' = "";');
          }
      }
    if ("insert" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['decimal_db'] == ",")
        {
            $this->nm_troca_decimal(",", ".");
        }
        $_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_id = $this->id;
}
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
  if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


$check_sql = "SELECT 
  prod_items_base.id_item,
  prod_items_base.item
FROM
  prod_items_proyecto
  INNER JOIN prod_items_base ON (prod_items_proyecto.id_item = prod_items_base.id_item)
WHERE
  prod_items_proyecto.id_proyecto =".$this->sc_temp_id_proyecto." AND 
  prod_items_base.id_item NOT IN
   (SELECT prod_partida_presupuesto_periodo.id_item FROM prod_partida_presupuesto_periodo 
   WHERE prod_partida_presupuesto_periodo.id_proyecto =".$this->sc_temp_id_proyecto." AND prod_partida_presupuesto_periodo.id_presupuesto_periodo =".$this->id .")
    ORDER BY prod_items_base.agrupador1, prod_items_base.item";

 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

$id_item_insert = 0;
if (false == $this->rs)     
{
    
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Error while accessing database.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_prod_presupuesto_periodo';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_prod_presupuesto_periodo';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Error while accessing database.';
 }
;
}
else
{
   while(!$this->rs->EOF)
    {
		$id_item_insert = $this->rs->fields[0];
	    $insert_sql="INSERT INTO `prod_partida_presupuesto_periodo` (`id_presupuesto_periodo`, `id_proyecto`, `id_item`, `monto_uf`, `avance`, `unidades_periodo`, `facturado`) VALUES 
  (".$this->id .",".$this->sc_temp_id_proyecto.",".$id_item_insert.", 0, 0, 0, 0)";
	    
     $nm_select = $insert_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
		$this->rs->MoveNext();
    }
    $this->rs->Close();
}
$this->nm_mens_alert[] = "Se ha generado la itemización de producción para el período ingresado"; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Se ha generado la itemización de producción para el período ingresado"); }
if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_id != $this->id || (isset($bFlagRead_id) && $bFlagRead_id)))
    {
        $this->ajax_return_values_id(true);
    }
}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off'; 
    }
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        $_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_considera_retencion = $this->considera_retencion;
    $original_dias_desde = $this->dias_desde;
    $original_dias_periodo = $this->dias_periodo;
    $original_facturado = $this->facturado;
    $original_fecha_desde = $this->fecha_desde;
    $original_fecha_desde_factura = $this->fecha_desde_factura;
    $original_fecha_hasta = $this->fecha_hasta;
    $original_fecha_hasta_factura = $this->fecha_hasta_factura;
    $original_id = $this->id;
    $original_id_partida = $this->id_partida;
    $original_id_proyecto = $this->id_proyecto;
    $original_monto_contrato = $this->monto_contrato;
    $original_multa = $this->multa;
    $original_observaciones_solicitud = $this->observaciones_solicitud;
    $original_produccion_neto = $this->produccion_neto;
    $original_total_facturado = $this->total_facturado;
}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
  if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

require_once $this->Ini->path_third . '/PHPMailer/PHPMailer.php';
require_once $this->Ini->path_third . '/PHPMailer/SMTP.php';
require_once $this->Ini->path_third . '/PHPMailer/Exception.php';
 
$avance_mes=0;
$produccion_remanente=0;
$produccion_mes=0;
$prod_anterior=0;
$prod_actual=0;
$produccion_periodo=0;
$reajuste_periodo=0;
$retencion_total=0;
$reajuste_total=0;
$partida_siguiente=0;
$factura_total=0;
$factura_total_ur=0;
$produccion_facturada=0;
$prod2=0;
$id_partida_facturacion_acumulada=0;


if ($this->facturado ==0 or $this->facturado ==2)
	{
		$update_sql = "UPDATE prod_partida_presupuesto_periodo set prod_partida_presupuesto_periodo.facturado=0 where prod_partida_presupuesto_periodo.id_periodo_factura =".$this->id ." and id_proyecto=".$this->id_proyecto ;
		
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	}

if ($this->fecha_desde_factura <>"null" and $this->fecha_hasta_factura <>"null")
{
$time=$this->fecha_desde_factura ;
$month=date("m",strtotime($time));
$year=date("Y",strtotime($time));
$day=date("d",strtotime($time));
$fecha_desde_factura_1=$year."-".$month."-".$day;

$time2=$this->fecha_hasta_factura ;
$month2=date("m",strtotime($time2));
$year2=date("Y",strtotime($time2));
$day2=date("d",strtotime($time2));
$fecha_hasta_factura_1=$year2."-".$month2."-".$day2;


		$f1 = new DateTime($fecha_desde_factura_1);
		$f2 = new DateTime($fecha_hasta_factura_1);

		$f2 = $f2->modify( '+1 month' );
		$intervalo = DateInterval::createFromDateString('1 month');
		$periodo = new DatePeriod($f1, $intervalo, $f2);
		$meses = 0;
		$meses_str = [];
		foreach($periodo as $mes) {
			array_push($meses_str,$mes->format("Y/m"));
			$meses++;
		}
	
if ($month==$month2 and $year==$year2)
	{
	$meses=$meses-1;
	}
	
	for ($i = 0; $i < $meses; $i++)
	{
			$check_sql = "SELECT   prod_produccion_proyecto.avance,produccion2,id FROM prod_produccion_proyecto  where CONCAT(year(`prod_produccion_proyecto`.`fecha`),'/',LPAD(MONTH(prod_produccion_proyecto.fecha),2,'0'))='".$meses_str[$i]."' and id_proyecto =".$this->id_proyecto ;	
			 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
			{
				$produccion_facturada=$produccion_facturada + $this->rs[0][0];  
				$prod2=$this->rs[0][1];
			}
			else
			{
				$produccion_facturada=0;
				$prod2=0;
			}

			if ($i==($meses - 1) and $i>0)
			{
				$produccion_facturada=$produccion_facturada - $prod2;
				$id_partida_facturacion_acumulada=$this->rs[0][2];
			}
		
		
		
		if ($id_partida_facturacion_acumulada==0 and $this->facturado ==1)
			{
				$update_sql = "UPDATE prod_partida_presupuesto_periodo set prod_partida_presupuesto_periodo.facturado=1,id_periodo_factura=".$this->id ." where prod_partida_presupuesto_periodo.id_presupuesto_periodo in (SELECT id FROM `prod_presupuesto_periodo` where id_partida =".$this->rs[0][2]."  and id_proyecto=".$this->id_proyecto .")";
				
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
			}
		if ($id_partida_facturacion_acumulada==0 and $this->facturado ==0)
			{
				$update_sql = "UPDATE prod_partida_presupuesto_periodo set prod_partida_presupuesto_periodo.facturado=0,id_periodo_factura=".$this->id ." where prod_partida_presupuesto_periodo.id_presupuesto_periodo in (SELECT id FROM `prod_presupuesto_periodo` where id_partida =".$this->rs[0][2]."  and id_proyecto=".$this->id_proyecto .")";
				
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
			}
	
	}
}
else
	{
	
		$update_sql = "UPDATE prod_partida_presupuesto_periodo set prod_partida_presupuesto_periodo.facturado=0,id_periodo_factura=0  where  id_proyecto=".$this->id_proyecto ." and id_periodo_factura=".$this->id ;
		
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	}


	$j=0;
	
	$check_sql = "SELECT SUM(prod_presupuesto_periodo.reajuste) as reajuste_total FROM prod_presupuesto_periodo where `prod_presupuesto_periodo`.`id_partida`=".$this->id_partida ." and id_proyecto = ".$this->id_proyecto ;
	
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$reajuste_total=$this->rs[0][0];
		}
		else
		{
			$reajuste_total=0;
		}
	
	$check_sql = "SELECT SUM(prod_presupuesto_periodo.reajuste) as reajuste_periodo FROM prod_presupuesto_periodo where `prod_presupuesto_periodo`.id=".$this->id ." and id_proyecto = ".$this->id_proyecto ;
	
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
	
			$reajuste_periodo=$this->rs[0][0];
		}
		else
		{
			$reajuste_periodo=0;
		}

	$check_sql = "SELECT SUM(prod_presupuesto_periodo.retencion) as retencion_total FROM prod_presupuesto_periodo where `prod_presupuesto_periodo`.`id_partida`=".$this->id_partida ." and id_proyecto = ".$this->id_proyecto ;
	
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$retencion_total=$this->rs[0][0];
		}
		else
		{
			$retencion_total=0;
		}
	
	$mod_c=$this->monto_contrato  + $reajuste_periodo; 
	
	

	$check_sql = "SELECT min(prod_produccion_proyecto.id) as min_partida, max(prod_produccion_proyecto.id) as max_partida FROM  prod_produccion_proyecto WHERE prod_produccion_proyecto.id_proyecto =".$this->id_proyecto ;
	
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$min_partida=$this->rs[0][0];
			$max_partida=$this->rs[0][1];
		}
				else     
		{
			$min_partida=0;
			$max_partida=0;
		}
	
	

	$check_sql = "SELECT SUM(prod_partida_presupuesto_periodo.avance) AS  suma_avance,sum(prod_partida_presupuesto_periodo.monto_uf) AS facturacion_mes FROM prod_partida_presupuesto_periodo WHERE   prod_partida_presupuesto_periodo.id_presupuesto_periodo =".$this->id ." and id_proyecto = ".$this->id_proyecto ;

		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$avance_total= $this->rs[0][0];  
			
		}
				else     
		{
			$avance_total=0;
		}

		
		
$check_sql = "SELECT produccion1 from prod_produccion_proyecto where id_proyecto=".$this->id_proyecto ." and prod_produccion_proyecto.id=".$this->id_partida ;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$prod_anterior= $this->rs[0][0];
		}
		else     
		{
			$prod_anterior=0;
		}


	$check_sql = "SELECT  prod_produccion_proyecto.id FROM prod_produccion_proyecto where prod_produccion_proyecto.id_proyecto=".$this->id_proyecto ." and prod_produccion_proyecto.fecha > (select prod_produccion_proyecto.fecha from prod_produccion_proyecto where prod_produccion_proyecto.id=".$this->id_partida ." and prod_produccion_proyecto.id_proyecto = ".$this->id_proyecto .") limit 1";
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$partida_siguiente= $this->rs[0][0];
		}
		else     
		{
			$partida_siguiente=0;
		}

	$factura_total=$this->total_facturado ;
	$factura_total_ur=$this->total_facturado ;	
		

		if ($this->id_partida  == $min_partida)
			{
				$update_sql = "UPDATE prod_produccion_proyecto set considera_retencion=".$this->considera_retencion .",modificacion_contrato=".$mod_c.",reajuste=".$reajuste_total.",retencion=".$retencion_total.",produccion_neto=".$this->produccion_neto .",multa=".$this->multa ."  where prod_produccion_proyecto.id=".$this->id_partida ." and id_proyecto =".$this->id_proyecto ;
    			
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
						
				$produccion_total_periodo=$avance_total; 
				$produccion_anterior=$prod_anterior;
				$produccion_periodo_factor=($produccion_total_periodo/$this->dias_periodo )*$this->dias_desde ; 
				$produccion_remanente=$produccion_total_periodo - $produccion_periodo_factor; 
				$produccion_mes=$prod_anterior + $produccion_periodo_factor;
													
				$update_sql = "UPDATE prod_presupuesto_periodo set avance_informado=".$avance_total.",avance=".$produccion_total_periodo.",avance_periodo=".$produccion_periodo_factor.",avance_periodo_siguiente=".$produccion_remanente.",produccion_total_final=".$produccion_mes.",total_facturado=".$factura_total.",total_facturado_ur=".$factura_total_ur." where id_proyecto=".$this->id_proyecto ." and prod_presupuesto_periodo.id=".$this->id ;
				
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
												
													
				$mon = date("m", strtotime($this->fecha_desde ));
				$mon2 = date("m",strtotime($this->fecha_hasta ));
			
				$update_sql = "UPDATE prod_produccion_proyecto set  produccion1=".$produccion_anterior.",produccion2=".$produccion_periodo_factor.",avance=". $produccion_periodo_factor.",produccion_periodo=".$produccion_total_periodo." where id_proyecto=".$this->id_proyecto ." and prod_produccion_proyecto.id=".$this->id_partida ;
				
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
						
				
				$update_sql = "UPDATE prod_produccion_proyecto set produccion1=".$produccion_remanente." where id_proyecto=".$this->id_proyecto ." and prod_produccion_proyecto.id=".$partida_siguiente;
				
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      					
			}
		else
			{
				$update_sql = "UPDATE prod_produccion_proyecto set considera_retencion=".$this->considera_retencion .",modificacion_contrato=".$reajuste_total.",reajuste=".$reajuste_total.",retencion=".$retencion_total.",produccion_neto=".$this->produccion_neto .",multa=".$this->multa ." where prod_produccion_proyecto.id=".$this->id_partida ." and id_proyecto =".$this->id_proyecto ;
    			
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							
				$produccion_total_periodo=$avance_total; 

								
				$produccion_periodo_factor=($produccion_total_periodo/$this->dias_periodo )*$this->dias_desde ; 
				$produccion_remanente=$produccion_total_periodo - $produccion_periodo_factor; 
				$produccion_mes=$prod_anterior + $produccion_periodo_factor;
								
				$update_sql = "UPDATE prod_presupuesto_periodo set avance_informado=".$avance_total.",avance=".$produccion_total_periodo.",avance_periodo=".$produccion_periodo_factor.",avance_periodo_siguiente=".$produccion_remanente.",produccion_total_final=".$produccion_mes.",total_facturado=".$factura_total.",total_facturado_ur=".$factura_total_ur." where id_proyecto=".$this->id_proyecto ." and prod_presupuesto_periodo.id=".$this->id ;   
				
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
				
													
				$mon = date("m", strtotime($this->fecha_desde ));
				$mon2 = date("m",strtotime($this->fecha_hasta ));
				$update_sql = "UPDATE prod_produccion_proyecto set  produccion1=".$prod_anterior.",produccion2=".$produccion_periodo_factor.",avance=". $produccion_periodo_factor.",produccion_periodo=".$produccion_total_periodo." where id_proyecto=".$this->id_proyecto ." and prod_produccion_proyecto.id=".$this->id_partida ;
						
				
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

										
				$update_sql = "UPDATE prod_produccion_proyecto set produccion1=".$produccion_remanente." where id_proyecto=".$this->id_proyecto ." and prod_produccion_proyecto.id=".$partida_siguiente;
				
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      	

			}

$check_sql = "SELECT prod_produccion_proyecto.id FROM  prod_produccion_proyecto WHERE prod_produccion_proyecto.id_proyecto =".$this->id_proyecto ." order by prod_produccion_proyecto.fecha ASC";

 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs2 = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs2 = false;
          $this->rs2_erro = $this->Db->ErrorMsg();
      } 


$i=0;
$j=0;
if (false == $this->rs2 )     
{
    
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Error while accessing database.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_prod_presupuesto_periodo';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_prod_presupuesto_periodo';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Error while accessing database.';
 }
;
}
else
{
   while(!$this->rs2->EOF)
    {
		$i = $this->rs2->fields[0];
		
		$avance_mes= 0;
		$facturacion_mes=0;
		$ur_anterior=0;
		$ur_periodo_anterior=0;
		$backlog_p_anterior=0;
		$backlog_f_anterior=0;
		$id_partida_prod=0;
		$mod_contrato=0;
		$dias_mes_siguiente;
	
			
		
		$check_sql = "SELECT sum(prod_presupuesto_periodo.`avance`) as avance_mes, sum(prod_presupuesto_periodo.`monto_uf`) as facturacion_mes FROM prod_presupuesto_periodo  where  `prod_presupuesto_periodo`.`id_proyecto` =".$this->id_proyecto ." AND  (`prod_presupuesto_periodo`.`facturado`=1 or `prod_presupuesto_periodo`.`facturado`=2) and prod_presupuesto_periodo.id_partida=".$i;
  
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
				$facturacion_mes=$this->rs[0][1];
		}
				else     
		{
				$facturacion_mes=0;
		}

		
 		if ($i > $min_partida)
		{
			$check_sql = "SELECT prod_produccion_proyecto.ur_real, backlog_p, backlog_f,prod_produccion_proyecto.ur_periodo 		FROM prod_produccion_proyecto where id_proyecto=".$this->id_proyecto ." and id=".$j; 
			
				 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


				if (isset($this->rs[0][0]))     
				{
				 	$ur_anterior = $this->rs[0][0];
					$backlog_p_anterior=$this->rs[0][1];
					$backlog_f_anterior=$this->rs[0][2];
					$ur_periodo_anterior=$this->rs[0][3];
					

				}
						else     
				{
					$ur_anterior = 0;
				    $ur_periodo_anterior=0;
				    $backlog_p_anterior=0;
				    $backlog_f_anterior=0;
				}
			
			
				$check_sql = "SELECT modificacion_contrato,produccion1,produccion2,produccion_periodo from prod_produccion_proyecto  where id_proyecto=".$this->id_proyecto ." and id=".$i; 

				 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


				if (isset($this->rs[0][0]))     
				{
					$mod_contrato = $this->rs[0][0];
					$produccion1=$this->rs[0][1];
					$produccion2=$this->rs[0][2];
					$produccion_periodo_facturacion=$this->rs[0][3];
				}
						else     
				{
				    $mod_contrato=0;
					$produccion1=0;
					$produccion2=0;
					$produccion_periodo_facturacion=0;
				}
			
			
			$avance_mes=$produccion1+$produccion2;
			
			$ur=$ur_anterior + ($avance_mes - $facturacion_mes);
			
			$ur_mes=($avance_mes - $facturacion_mes);
			$ur_periodo_fechas=$ur_periodo_anterior + ($produccion_periodo_facturacion - $facturacion_mes); 
			$backlog_p_actual=$backlog_p_anterior + $mod_contrato - $avance_mes; 
			$backlog_f_actual=$backlog_f_anterior + $mod_contrato - $facturacion_mes; 
		}
		else 
		{
			 $check_sql = "SELECT modificacion_contrato,produccion1,produccion2,produccion_periodo from prod_produccion_proyecto where id_proyecto=".$this->id_proyecto ." and id=".$min_partida; 

			 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


			if (isset($this->rs[0][0]))     
			{
				$mod_contrato = $this->rs[0][0];
				$produccion1=$this->rs[0][1];
				$produccion2=$this->rs[0][2];
				$produccion_periodo_facturacion=$this->rs[0][3];
			}
			else     
			{
				$monto_periodo=0;
				$produccion1=0;
				$produccion2=0;		
				$produccion_periodo_facturacion=0;
			}
			
			$avance_mes=$produccion1+$produccion2;
			
			
			if ($i==$id_partida_facturacion_acumulada)  
			{
				$ur=($produccion_facturada - $facturacion_mes);
				$ur_mes=($produccion_facturada - $facturacion_mes);
				$ur_periodo_fechas=$ur_periodo_anterior + ($produccion_facturada - $facturacion_mes); 
			}
			else
			{
				$ur=($avance_mes-$facturacion_mes);
				$ur_mes=($avance_mes-$facturacion_mes);
				$ur_periodo_fechas=$ur_periodo_anterior + ($produccion_periodo_facturacion - $facturacion_mes); 
			}
			
			$backlog_p_actual=$mod_contrato - $avance_mes; 
			$backlog_f_actual=$mod_contrato - $facturacion_mes; 
		}
			$update_sql = "UPDATE prod_produccion_proyecto set facturacion=".$facturacion_mes.",avance=".$avance_mes.", ur_real=".$ur.",ur_periodo=".$ur_periodo_fechas.",ur_mes=".$ur_mes.",backlog_p=".$backlog_p_actual.",backlog_f=".$backlog_f_actual."  where id_proyecto=".$this->id_proyecto ." and prod_produccion_proyecto.id=".$i;
			
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	$j=$i;
	$this->rs2->MoveNext();
    }
    $this->rs2->Close();
}

if ($this->facturado =="1" or $this->facturado =="2" or $this->facturado =="3")
	{
	
	    $check_sql = "SELECT distinct
  prod_estado_facturacion.estado
FROM
  prod_estado_facturacion
WHERE
  prod_estado_facturacion.valor_estado = ".$this->facturado ; 

			 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


			if (isset($this->rs[0][0]))     
			{
				$estado_facturacion = $this->rs[0][0];
				
			}
			else     
			{
				$estado_facturacion="";
			}
	 
		$insert_sql = "INSERT INTO prod_historia_factura(id_periodo,estado,observaciones,fecha,usuario) VALUES (".$this->id .",'".$estado_facturacion."','".$this->observaciones_solicitud ."',now(),'".$this->sc_temp_usr_name."')";
		
     $nm_select = $insert_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	}

	$this->nm_mens_alert[] = "Se ha actualizado la tabla de datos del período y la tabla de producción"; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Se ha actualizado la tabla de datos del período y la tabla de producción"); }if ($this->facturado =="2" or $this->facturado =="3")
{
	
	$check_sql = "SELECT nombre_proyecto FROM proyectos where id=".$this->id_proyecto ; 

		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$nom_proyecto = $this->rs[0][0];
		}
		else     
		{
			$nom_proyecto="";
		}
	
	$check_sql = "SELECT concat(month(fecha),'-',year(fecha))  FROM prod_produccion_proyecto WHERE id=".$this->id_partida ; 

		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$periodo = $this->rs[0][0];
		}
		else     
		{
			$periodo="";
		}
	
	$check_sql = "SELECT  prod_estado_facturacion.estado FROM  prod_estado_facturacion WHERE   prod_estado_facturacion.valor_estado=".$this->facturado ;
	
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$estado = $this->rs[0][0];
		}
		else     
		{
			$estado="";
		}
	
	$mail = new PHPMailer\PHPMailer\PHPMailer;
	$mail->CharSet = 'UTF-8';
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host    ="smtp.office365.com";        
	$mail->Username ="sgd.vfh@vfaraggi.cl";                  
	$mail->Password = 'DMa1b2Cx100';               
	$mail->Port = 25; 
	$mail->SMTPSecure = 'tls'; 
	$mail->From = "sgd.vfh@vfaraggi.cl";          
		   
 
	$mail->FromName = "sgd.vfh@vfaraggi.cl";
	$mail_subject        = 'Sistema Producción - Notificación de Facturación';            
	$mail_message        = '<font face=arial>Existe una nueva solicitud de facturación en el sistema:'.'<br><br>Proyecto:  '.$nom_proyecto.'<br><br>Estado: '.$estado.'<br><br>Período:</b> '.$periodo.'<br><br>Observaciones: '.nl2br(stripcslashes($this->observaciones_solicitud )).'<br><br><a href=http://tracking.orbeconsultores.cl/produccion>Sistema de Control de Producción - O2</a></font>';
	
$mail->IsHTML(true); 
$mail->Subject = $mail_subject; 

$mail->Body = $mail_message; 

		$mail->AddAddress("danilo.migone@vfh.cl");
	   

$exito=0;

$exito = $mail->Send(); 

if($exito){
	
		$this->nm_mens_alert[] = "Se ha enviado notificación por correo electrónico."; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Se ha enviado notificación por correo electrónico."); }} else 
{
	echo "Hubo un inconveniente al derivar direccion. Contactar a un administrador - ". $mail->ErrorInfo;
}

}

 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('grid_prod_presupuesto_periodo') . "/", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_considera_retencion != $this->considera_retencion || (isset($bFlagRead_considera_retencion) && $bFlagRead_considera_retencion)))
    {
        $this->ajax_return_values_considera_retencion(true);
    }
    if (($original_dias_desde != $this->dias_desde || (isset($bFlagRead_dias_desde) && $bFlagRead_dias_desde)))
    {
        $this->ajax_return_values_dias_desde(true);
    }
    if (($original_dias_periodo != $this->dias_periodo || (isset($bFlagRead_dias_periodo) && $bFlagRead_dias_periodo)))
    {
        $this->ajax_return_values_dias_periodo(true);
    }
    if (($original_facturado != $this->facturado || (isset($bFlagRead_facturado) && $bFlagRead_facturado)))
    {
        $this->ajax_return_values_facturado(true);
    }
    if (($original_fecha_desde != $this->fecha_desde || (isset($bFlagRead_fecha_desde) && $bFlagRead_fecha_desde)))
    {
        $this->ajax_return_values_fecha_desde(true);
    }
    if (($original_fecha_desde_factura != $this->fecha_desde_factura || (isset($bFlagRead_fecha_desde_factura) && $bFlagRead_fecha_desde_factura)))
    {
        $this->ajax_return_values_fecha_desde_factura(true);
    }
    if (($original_fecha_hasta != $this->fecha_hasta || (isset($bFlagRead_fecha_hasta) && $bFlagRead_fecha_hasta)))
    {
        $this->ajax_return_values_fecha_hasta(true);
    }
    if (($original_fecha_hasta_factura != $this->fecha_hasta_factura || (isset($bFlagRead_fecha_hasta_factura) && $bFlagRead_fecha_hasta_factura)))
    {
        $this->ajax_return_values_fecha_hasta_factura(true);
    }
    if (($original_id != $this->id || (isset($bFlagRead_id) && $bFlagRead_id)))
    {
        $this->ajax_return_values_id(true);
    }
    if (($original_id_partida != $this->id_partida || (isset($bFlagRead_id_partida) && $bFlagRead_id_partida)))
    {
        $this->ajax_return_values_id_partida(true);
    }
    if (($original_id_proyecto != $this->id_proyecto || (isset($bFlagRead_id_proyecto) && $bFlagRead_id_proyecto)))
    {
        $this->ajax_return_values_id_proyecto(true);
    }
    if (($original_monto_contrato != $this->monto_contrato || (isset($bFlagRead_monto_contrato) && $bFlagRead_monto_contrato)))
    {
        $this->ajax_return_values_monto_contrato(true);
    }
    if (($original_multa != $this->multa || (isset($bFlagRead_multa) && $bFlagRead_multa)))
    {
        $this->ajax_return_values_multa(true);
    }
    if (($original_observaciones_solicitud != $this->observaciones_solicitud || (isset($bFlagRead_observaciones_solicitud) && $bFlagRead_observaciones_solicitud)))
    {
        $this->ajax_return_values_observaciones_solicitud(true);
    }
    if (($original_produccion_neto != $this->produccion_neto || (isset($bFlagRead_produccion_neto) && $bFlagRead_produccion_neto)))
    {
        $this->ajax_return_values_produccion_neto(true);
    }
    if (($original_total_facturado != $this->total_facturado || (isset($bFlagRead_total_facturado) && $bFlagRead_total_facturado)))
    {
        $this->ajax_return_values_total_facturado(true);
    }
}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off'; 
    }
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      $_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_id = $this->id;
    $original_id_proyecto = $this->id_proyecto;
}
  $delete_sql = 'delete from prod_partida_presupuesto_periodo where id_proyecto='.$this->id_proyecto .' and id_presupuesto_periodo='.$this->id ;

     $nm_select = $delete_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_prod_presupuesto_periodo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_id != $this->id || (isset($bFlagRead_id) && $bFlagRead_id)))
    {
        $this->ajax_return_values_id(true);
    }
    if (($original_id_proyecto != $this->id_proyecto || (isset($bFlagRead_id_proyecto) && $bFlagRead_id_proyecto)))
    {
        $this->ajax_return_values_id_proyecto(true);
    }
}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $salva_opcao ; 
          if ($salva_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->sc_evento = ""; 
          $this->NM_rollback_db(); 
          return; 
      }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['decimal_db'] == ",")
   {
       $this->nm_troca_decimal(".", ",");
   }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['parms'] = "id?#?$this->id?@?id_proyecto?#?$this->id_proyecto?@?"; 
      }
      $this->nmgp_dados_form['factura'] = ""; 
      $this->factura_limpa = ""; 
      $this->factura_salva = ""; 
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->id = null === $this->id ? null : substr($this->Db->qstr($this->id), 1, -1); 
          $this->id_proyecto = null === $this->id_proyecto ? null : substr($this->Db->qstr($this->id_proyecto), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "R")
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['iframe_evento']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->id) && empty($this->id_proyecto)) 
          { 
              $this->nmgp_opcao = "igual"; 
          } 
          else 
          { 
              $this->nmgp_opcao = "igual"; 
          } 
      } 
      if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) 
      { 
          $this->nmgp_opcao = "inicio";
      } 
      if ($this->nmgp_opcao != "nada" && (trim($this->id) == "" || trim($this->id_proyecto) == "")) 
      { 
          if ($this->nmgp_opcao == "avanca")  
          { 
              $this->nmgp_opcao = "final"; 
          } 
          elseif ($this->nmgp_opcao != "novo")
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" && $this->sc_evento == "insert")
      {
          $this->nmgp_opcao = "final";
      }
      $sc_where = trim("");
      if (substr(strtolower($sc_where), 0, 5) == "where")
      {
          $sc_where  = substr($sc_where , 5);
      }
      if (!empty($sc_where))
      {
          $sc_where = " where " . $sc_where . " ";
      }
      if ('' != $sc_where_filter)
      {
          $sc_where = ('' != $sc_where) ? $sc_where . ' and (' . $sc_where_filter . ')' : ' where ' . $sc_where_filter;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_prod_presupuesto_periodo = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total'] = $qt_geral_reg_form_prod_presupuesto_periodo;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->id) && !empty($this->id_proyecto))
          {
              $Reg_OK      = false;
              $Count_start = -1;
              $sc_order_by = "";
              $Sel_Chave = "id, id_proyecto"; 
              $nmgp_select = "SELECT " . $Sel_Chave . " from " . $this->Ini->nm_tabela . $sc_where; 
              $sc_order_by = "id, id_proyecto";
              $sc_order_by = str_replace("order by ", "", $sc_order_by);
              $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
              if (!empty($sc_order_by))
              {
                  $nmgp_select .= " order by $sc_order_by "; 
              }
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rt = $this->Db->Execute($nmgp_select) ; 
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit ; 
              }  
              while (!$rt->EOF && !$Reg_OK)
              { 
                  if ($rt->fields[0] == $this->id && $rt->fields[1] == $this->id_proyecto)
                  { 
                      $Reg_OK = true;
                  }  
                  $Count_start++;
                  $rt->MoveNext();
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] = $Count_start;
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_prod_presupuesto_periodo = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] > $qt_geral_reg_form_prod_presupuesto_periodo)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] = $qt_geral_reg_form_prod_presupuesto_periodo; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] = $qt_geral_reg_form_prod_presupuesto_periodo; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_prod_presupuesto_periodo) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['parms'] = ""; 
          $nmgp_select = "SELECT id, id_proyecto, id_item, fecha, monto_uf, vigente, observaciones, orden, id_partida, avance, facturado, valor_uf, factura, tipo_moneda, retencion, reajuste, multa, fecha_desde, fecha_hasta, dias_desde, dias_hasta, factor_produccion, dias_periodo, avance_periodo, avance_periodo_siguiente, avance_informado, avance_periodo_anterior, produccion_total_final, total_facturado, total_facturado_ur, fecha_desde_factura, fecha_hasta_factura, avance_informado_con_iva, produccion_ep, reajuste_con_iva, retencion_con_iva, produccion_neto, reajuste_acumulado_neto, reajuste_acumulado_con_iva, considera_retencion from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              $aWhere[] = "id = $this->id and id_proyecto = $this->id_proyecto"; 
              if (!empty($sc_where_filter))  
              {
                  $teste_select = $nmgp_select . $this->returnWhere($aWhere);
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $teste_select; 
                  $rs = $this->Db->Execute($teste_select); 
                  if ($rs->EOF)
                  {
                     $aWhere = array($sc_where_filter);
                  }  
                  $rs->Close(); 
              }  
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "id, id_proyecto";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start']) ;  
              } 
          } 
          if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs->EOF) 
          { 
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['empty_filter'] = true;
                  return; 
              }
              if ($this->nmgp_botoes['insert'] != "on")
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
              }
              $this->nmgp_opcao = "novo"; 
              $this->nm_flag_saida_novo = "S"; 
              $rs->Close(); 
              if ($this->aba_iframe)
              {
                  $this->NM_ajax_info['buttonDisplay']['exit'] = $this->nmgp_botoes['exit'] = 'off';
              }
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd_extr']); 
              $this->nmgp_opcao = "novo"; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->id = $rs->fields[0] ; 
              $this->nmgp_dados_select['id'] = $this->id;
              $this->id_proyecto = $rs->fields[1] ; 
              $this->nmgp_dados_select['id_proyecto'] = $this->id_proyecto;
              $this->id_item = $rs->fields[2] ; 
              $this->nmgp_dados_select['id_item'] = $this->id_item;
              $this->fecha = $rs->fields[3] ; 
              $this->nmgp_dados_select['fecha'] = $this->fecha;
              $this->monto_uf = $rs->fields[4] ; 
              $this->nmgp_dados_select['monto_uf'] = $this->monto_uf;
              $this->vigente = $rs->fields[5] ; 
              $this->nmgp_dados_select['vigente'] = $this->vigente;
              $this->observaciones = $rs->fields[6] ; 
              $this->nmgp_dados_select['observaciones'] = $this->observaciones;
              $this->orden = $rs->fields[7] ; 
              $this->nmgp_dados_select['orden'] = $this->orden;
              $this->id_partida = $rs->fields[8] ; 
              $this->nmgp_dados_select['id_partida'] = $this->id_partida;
              $this->avance = $rs->fields[9] ; 
              $this->nmgp_dados_select['avance'] = $this->avance;
              $this->facturado = $rs->fields[10] ; 
              $this->nmgp_dados_select['facturado'] = $this->facturado;
              $this->valor_uf = $rs->fields[11] ; 
              $this->nmgp_dados_select['valor_uf'] = $this->valor_uf;
              $this->factura = $rs->fields[12] ; 
              $this->nmgp_dados_select['factura'] = $this->factura;
              $this->tipo_moneda = $rs->fields[13] ; 
              $this->nmgp_dados_select['tipo_moneda'] = $this->tipo_moneda;
              $this->retencion = $rs->fields[14] ; 
              $this->nmgp_dados_select['retencion'] = $this->retencion;
              $this->reajuste = $rs->fields[15] ; 
              $this->nmgp_dados_select['reajuste'] = $this->reajuste;
              $this->multa = $rs->fields[16] ; 
              $this->nmgp_dados_select['multa'] = $this->multa;
              $this->fecha_desde = $rs->fields[17] ; 
              $this->nmgp_dados_select['fecha_desde'] = $this->fecha_desde;
              $this->fecha_hasta = $rs->fields[18] ; 
              $this->nmgp_dados_select['fecha_hasta'] = $this->fecha_hasta;
              $this->dias_desde = $rs->fields[19] ; 
              $this->nmgp_dados_select['dias_desde'] = $this->dias_desde;
              $this->dias_hasta = $rs->fields[20] ; 
              $this->nmgp_dados_select['dias_hasta'] = $this->dias_hasta;
              $this->factor_produccion = $rs->fields[21] ; 
              $this->nmgp_dados_select['factor_produccion'] = $this->factor_produccion;
              $this->dias_periodo = $rs->fields[22] ; 
              $this->nmgp_dados_select['dias_periodo'] = $this->dias_periodo;
              $this->avance_periodo = $rs->fields[23] ; 
              $this->nmgp_dados_select['avance_periodo'] = $this->avance_periodo;
              $this->avance_periodo_siguiente = $rs->fields[24] ; 
              $this->nmgp_dados_select['avance_periodo_siguiente'] = $this->avance_periodo_siguiente;
              $this->avance_informado = $rs->fields[25] ; 
              $this->nmgp_dados_select['avance_informado'] = $this->avance_informado;
              $this->avance_periodo_anterior = $rs->fields[26] ; 
              $this->nmgp_dados_select['avance_periodo_anterior'] = $this->avance_periodo_anterior;
              $this->produccion_total_final = $rs->fields[27] ; 
              $this->nmgp_dados_select['produccion_total_final'] = $this->produccion_total_final;
              $this->total_facturado = $rs->fields[28] ; 
              $this->nmgp_dados_select['total_facturado'] = $this->total_facturado;
              $this->total_facturado_ur = $rs->fields[29] ; 
              $this->nmgp_dados_select['total_facturado_ur'] = $this->total_facturado_ur;
              $this->fecha_desde_factura = $rs->fields[30] ; 
              $this->nmgp_dados_select['fecha_desde_factura'] = $this->fecha_desde_factura;
              $this->fecha_hasta_factura = $rs->fields[31] ; 
              $this->nmgp_dados_select['fecha_hasta_factura'] = $this->fecha_hasta_factura;
              $this->avance_informado_con_iva = $rs->fields[32] ; 
              $this->nmgp_dados_select['avance_informado_con_iva'] = $this->avance_informado_con_iva;
              $this->produccion_ep = $rs->fields[33] ; 
              $this->nmgp_dados_select['produccion_ep'] = $this->produccion_ep;
              $this->reajuste_con_iva = $rs->fields[34] ; 
              $this->nmgp_dados_select['reajuste_con_iva'] = $this->reajuste_con_iva;
              $this->retencion_con_iva = $rs->fields[35] ; 
              $this->nmgp_dados_select['retencion_con_iva'] = $this->retencion_con_iva;
              $this->produccion_neto = $rs->fields[36] ; 
              $this->nmgp_dados_select['produccion_neto'] = $this->produccion_neto;
              $this->reajuste_acumulado_neto = $rs->fields[37] ; 
              $this->nmgp_dados_select['reajuste_acumulado_neto'] = $this->reajuste_acumulado_neto;
              $this->reajuste_acumulado_con_iva = $rs->fields[38] ; 
              $this->nmgp_dados_select['reajuste_acumulado_con_iva'] = $this->reajuste_acumulado_con_iva;
              $this->considera_retencion = $rs->fields[39] ; 
              $this->nmgp_dados_select['considera_retencion'] = $this->considera_retencion;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->id = (string)$this->id; 
              $this->id_proyecto = (string)$this->id_proyecto; 
              $this->id_item = (string)$this->id_item; 
              $this->monto_uf = (string)$this->monto_uf; 
              $this->vigente = (string)$this->vigente; 
              $this->orden = (string)$this->orden; 
              $this->id_partida = (string)$this->id_partida; 
              $this->avance = (string)$this->avance; 
              $this->facturado = (string)$this->facturado; 
              $this->valor_uf = (string)$this->valor_uf; 
              $this->tipo_moneda = (string)$this->tipo_moneda; 
              $this->retencion = (string)$this->retencion; 
              $this->reajuste = (string)$this->reajuste; 
              $this->multa = (string)$this->multa; 
              $this->dias_desde = (string)$this->dias_desde; 
              $this->dias_hasta = (string)$this->dias_hasta; 
              $this->factor_produccion = (string)$this->factor_produccion; 
              $this->dias_periodo = (string)$this->dias_periodo; 
              $this->avance_periodo = (string)$this->avance_periodo; 
              $this->avance_periodo_siguiente = (string)$this->avance_periodo_siguiente; 
              $this->avance_informado = (string)$this->avance_informado; 
              $this->avance_periodo_anterior = (string)$this->avance_periodo_anterior; 
              $this->produccion_total_final = (string)$this->produccion_total_final; 
              $this->total_facturado = (string)$this->total_facturado; 
              $this->total_facturado_ur = (string)$this->total_facturado_ur; 
              $this->avance_informado_con_iva = (string)$this->avance_informado_con_iva; 
              $this->produccion_ep = (string)$this->produccion_ep; 
              $this->reajuste_con_iva = (string)$this->reajuste_con_iva; 
              $this->retencion_con_iva = (string)$this->retencion_con_iva; 
              $this->produccion_neto = (string)$this->produccion_neto; 
              $this->reajuste_acumulado_neto = (string)$this->reajuste_acumulado_neto; 
              $this->reajuste_acumulado_con_iva = (string)$this->reajuste_acumulado_con_iva; 
              $this->considera_retencion = (string)$this->considera_retencion; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['parms'] = "id?#?$this->id?@?id_proyecto?#?$this->id_proyecto?@?";
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sub_dir'][0]  = "/" . $this->nm_tira_formatacao_id_proyecto($this->id_proyecto) . "" . $this->nm_tira_formatacao_id_partida($this->id_partida);
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] < $qt_geral_reg_form_prod_presupuesto_periodo;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao']   = '';
          }
      } 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada") 
      { 
          $this->hitos_facturacion = "";
          $this->hitos_facturacion_hidden = "";
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select id_presupuesto_periodo, id_hito, estado, fecha_hito, adjunto, link_externo from prod_presupuesto_periodo_hitos where id_presupuesto_periodo = $this->id"; 
          $rss = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
          if ($rss === false && !$rss->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $this->hitos_facturacion = ""; 
          while (!$rss->EOF) 
          { 
                 $this->hitos_facturacion .= $rss->fields[1] . "@?@";
                 $this->hitos_facturacion_hidden .= $rss->fields[1] . "@?@";
                 $rss->MoveNext() ; 
          } 
          $rss->Close(); 
      } 
      if ($this->nmgp_opcao == "novo" || $this->nmgp_opcao == "refresh_insert") 
      { 
          $this->sc_evento_old = $this->sc_evento;
          $this->sc_evento = "novo";
          if ('refresh_insert' == $this->nmgp_opcao)
          {
              $this->nmgp_opcao = 'novo';
          }
          else
          {
              $this->nm_formatar_campos();
              $this->id = "";  
              $this->nmgp_dados_form["id"] = $this->id;
              $this->id_proyecto = "";  
              $this->nmgp_dados_form["id_proyecto"] = $this->id_proyecto;
              $this->id_item = "";  
              $this->nmgp_dados_form["id_item"] = $this->id_item;
              $this->fecha = "";  
              $this->fecha_hora = "" ;  
              $this->nmgp_dados_form["fecha"] = $this->fecha;
              $this->monto_uf = "";  
              $this->nmgp_dados_form["monto_uf"] = $this->monto_uf;
              $this->vigente = "";  
              $this->nmgp_dados_form["vigente"] = $this->vigente;
              $this->observaciones = "";  
              $this->nmgp_dados_form["observaciones"] = $this->observaciones;
              $this->orden = "";  
              $this->nmgp_dados_form["orden"] = $this->orden;
              $this->id_partida = "";  
              $this->nmgp_dados_form["id_partida"] = $this->id_partida;
              $this->avance = "";  
              $this->nmgp_dados_form["avance"] = $this->avance;
              $this->facturado = "";  
              $this->nmgp_dados_form["facturado"] = $this->facturado;
              $this->valor_uf = "";  
              $this->nmgp_dados_form["valor_uf"] = $this->valor_uf;
              $this->factura = "";  
              $this->factura_ul_name = "" ;  
              $this->factura_ul_type = "" ;  
              $this->nmgp_dados_form["factura"] = $this->factura;
              $this->tipo_moneda = "";  
              $this->nmgp_dados_form["tipo_moneda"] = $this->tipo_moneda;
              $this->retencion = "";  
              $this->nmgp_dados_form["retencion"] = $this->retencion;
              $this->reajuste = "";  
              $this->nmgp_dados_form["reajuste"] = $this->reajuste;
              $this->multa = "";  
              $this->nmgp_dados_form["multa"] = $this->multa;
              $this->fecha_desde = "";  
              $this->fecha_desde_hora = "" ;  
              $this->nmgp_dados_form["fecha_desde"] = $this->fecha_desde;
              $this->fecha_hasta = "";  
              $this->fecha_hasta_hora = "" ;  
              $this->nmgp_dados_form["fecha_hasta"] = $this->fecha_hasta;
              $this->dias_desde = "";  
              $this->nmgp_dados_form["dias_desde"] = $this->dias_desde;
              $this->dias_hasta = "";  
              $this->nmgp_dados_form["dias_hasta"] = $this->dias_hasta;
              $this->factor_produccion = "";  
              $this->nmgp_dados_form["factor_produccion"] = $this->factor_produccion;
              $this->dias_periodo = "";  
              $this->nmgp_dados_form["dias_periodo"] = $this->dias_periodo;
              $this->avance_periodo = "";  
              $this->nmgp_dados_form["avance_periodo"] = $this->avance_periodo;
              $this->avance_periodo_siguiente = "";  
              $this->nmgp_dados_form["avance_periodo_siguiente"] = $this->avance_periodo_siguiente;
              $this->avance_informado = "";  
              $this->nmgp_dados_form["avance_informado"] = $this->avance_informado;
              $this->avance_periodo_anterior = "";  
              $this->nmgp_dados_form["avance_periodo_anterior"] = $this->avance_periodo_anterior;
              $this->produccion_total_final = "";  
              $this->nmgp_dados_form["produccion_total_final"] = $this->produccion_total_final;
              $this->total_facturado = "";  
              $this->nmgp_dados_form["total_facturado"] = $this->total_facturado;
              $this->total_facturado_ur = "";  
              $this->nmgp_dados_form["total_facturado_ur"] = $this->total_facturado_ur;
              $this->fecha_desde_factura = "";  
              $this->fecha_desde_factura_hora = "" ;  
              $this->nmgp_dados_form["fecha_desde_factura"] = $this->fecha_desde_factura;
              $this->fecha_hasta_factura = "";  
              $this->fecha_hasta_factura_hora = "" ;  
              $this->nmgp_dados_form["fecha_hasta_factura"] = $this->fecha_hasta_factura;
              $this->avance_informado_con_iva = "";  
              $this->nmgp_dados_form["avance_informado_con_iva"] = $this->avance_informado_con_iva;
              $this->produccion_ep = "";  
              $this->nmgp_dados_form["produccion_ep"] = $this->produccion_ep;
              $this->reajuste_con_iva = "";  
              $this->nmgp_dados_form["reajuste_con_iva"] = $this->reajuste_con_iva;
              $this->retencion_con_iva = "";  
              $this->nmgp_dados_form["retencion_con_iva"] = $this->retencion_con_iva;
              $this->produccion_neto = "";  
              $this->nmgp_dados_form["produccion_neto"] = $this->produccion_neto;
              $this->reajuste_acumulado_neto = "";  
              $this->nmgp_dados_form["reajuste_acumulado_neto"] = $this->reajuste_acumulado_neto;
              $this->reajuste_acumulado_con_iva = "";  
              $this->nmgp_dados_form["reajuste_acumulado_con_iva"] = $this->reajuste_acumulado_con_iva;
              $this->considera_retencion = "";  
              $this->nmgp_dados_form["considera_retencion"] = $this->considera_retencion;
              $this->cliente = "";  
              $this->nmgp_dados_form["cliente"] = $this->cliente;
              $this->empresa = "";  
              $this->nmgp_dados_form["empresa"] = $this->empresa;
              $this->hitos_facturacion = "";  
              $this->nmgp_dados_form["hitos_facturacion"] = $this->hitos_facturacion;
              $this->iva = "";  
              $this->nmgp_dados_form["iva"] = $this->iva;
              $this->modificacion_contrato = "";  
              $this->nmgp_dados_form["modificacion_contrato"] = $this->modificacion_contrato;
              $this->monto_contrato = "";  
              $this->nmgp_dados_form["monto_contrato"] = $this->monto_contrato;
              $this->monto_disponible = "";  
              $this->nmgp_dados_form["monto_disponible"] = $this->monto_disponible;
              $this->porcentaje_retencion = "";  
              $this->nmgp_dados_form["porcentaje_retencion"] = $this->porcentaje_retencion;
              $this->retencion_acumulada = "";  
              $this->nmgp_dados_form["retencion_acumulada"] = $this->retencion_acumulada;
              $this->nmgp_dados_form["incluye_retencion"] = $this->incluye_retencion;
              $this->nmgp_dados_form["existe_retencion"] = $this->existe_retencion;
              $this->observaciones_solicitud = "";  
              $this->nmgp_dados_form["observaciones_solicitud"] = $this->observaciones_solicitud;
              $this->nmgp_dados_form["afecta_iva"] = $this->afecta_iva;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
      }  
//
//
//-- 
      if ($this->nmgp_opcao != "novo") 
      {
      }
      if (!isset($this->nmgp_refresh_fields)) 
      { 
          $this->nm_proc_onload();
      }
  }
// 
//-- 
   function nm_db_retorna($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_proyecto) from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto < $this->id_proyecto" . $str_where_filter; 
     $rs = $this->Db->Execute("select max(id_proyecto) from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto < $this->id_proyecto" . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->id_proyecto = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id) from " . $this->Ini->nm_tabela . " where id < $this->id" . $str_where_filter; 
     $rs = $this->Db->Execute("select max(id) from " . $this->Ini->nm_tabela . " where id < $this->id" . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
     } 
     else 
     { 
        $this->nmgp_opcao = "inicio";  
        $rs->Close();  
        return ; 
     } 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_proyecto) from " . $this->Ini->nm_tabela . " where id = $this->id" . $str_where_filter; 
     $rs = $this->Db->Execute("select max(id_proyecto) from " . $this->Ini->nm_tabela . " where id = $this->id" . $str_where_filter); 
     $this->id_proyecto = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
// 
//-- 
   function nm_db_avanca($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_proyecto) from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto > $this->id_proyecto" . $str_where_filter; 
     $rs = $this->Db->Execute("select min(id_proyecto) from " . $this->Ini->nm_tabela . " where id = $this->id and id_proyecto > $this->id_proyecto" . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->id_proyecto = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id) from " . $this->Ini->nm_tabela . " where id > $this->id" . $str_where_filter; 
     $rs = $this->Db->Execute("select min(id) from " . $this->Ini->nm_tabela . " where id > $this->id" . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
     } 
     else 
     { 
        $this->nmgp_opcao = "final";  
        $rs->Close();  
        return ; 
     } 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_proyecto) from " . $this->Ini->nm_tabela . " where id = $this->id" . $str_where_filter; 
     $rs = $this->Db->Execute("select min(id_proyecto) from " . $this->Ini->nm_tabela . " where id = $this->id" . $str_where_filter); 
     $this->id_proyecto = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
// 
//-- 
   function nm_db_inicio($str_where_param = '') 
   {   
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela; 
     $rs = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela);
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if ($rs->fields[0] == 0) 
     { 
         $this->nmgp_opcao = "novo"; 
         $this->nm_flag_saida_novo = "S"; 
         $rs->Close(); 
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return;
     }
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
     $rs = $this->Db->Execute("select min(id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter']))
         { 
             $rs->Close();  
             return ; 
         } 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id_proyecto) from " . $this->Ini->nm_tabela . "  where id = $this->id" . $str_where_filter; 
     $rs = $this->Db->Execute("select min(id_proyecto) from " . $this->Ini->nm_tabela . "  where id = $this->id" . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     $this->id_proyecto = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
// 
//-- 
   function nm_db_final($str_where_param = '') 
   { 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_proyecto) from " . $this->Ini->nm_tabela . "  where id = $this->id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id_proyecto) from " . $this->Ini->nm_tabela . "  where id = $this->id" . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     $this->id_proyecto = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
   function NM_gera_nav_page() 
   {
       $this->SC_nav_page = "";
       $Arr_result        = array();
       $Ind_result        = 0;
       $Reg_Page   = 1;
       $Max_link   = 5;
       $Mid_link   = ceil($Max_link / 2);
       $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] + 1;
       $rec_fim    = ($rec_fim > $rec_tot) ? $rec_tot : $rec_fim;
       if ($rec_tot == 0)
       {
           return;
       }
       $Qtd_Pages  = ceil($rec_tot / $Reg_Page);
       $Page_Atu   = ceil($rec_fim / $Reg_Page);
       $Link_ini   = 1;
       if ($Page_Atu > $Max_link)
       {
           $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
       }
       elseif ($Page_Atu > $Mid_link)
       {
           $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
       }
       if (($Qtd_Pages - $Link_ini) < $Max_link)
       {
           $Link_ini = ($Qtd_Pages - $Max_link) + 1;
       }
       if ($Link_ini < 1)
       {
           $Link_ini = 1;
       }
       for ($x = 0; $x < $Max_link && $Link_ini <= $Qtd_Pages; $x++)
       {
           $rec = (($Link_ini - 1) * $Reg_Page) + 1;
           if ($Link_ini == $Page_Atu)
           {
               $Arr_result[$Ind_result] = '<span class="scFormToolbarNavOpen" style="vertical-align: middle;">' . $Link_ini . '</span>';
           }
           else
           {
               $Arr_result[$Ind_result] = '<a class="scFormToolbarNav" style="vertical-align: middle;" href="javascript: nm_navpage(' . $rec . ')">' . $Link_ini . '</a>';
           }
           $Link_ini++;
           $Ind_result++;
           if (!isset($this->Ini->Str_toolbarnav_separator))
           {
               $this->Ini->Str_toolbarnav_separator = "";
           }
           if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
           {
               $Arr_result[$Ind_result] = '<img src="' . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . '" align="absmiddle" style="vertical-align: middle;">';
               $Ind_result++;
           }
       }
       if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
       {
           krsort($Arr_result);
       }
       foreach ($Arr_result as $Ind_result => $Lin_result)
       {
           $this->SC_nav_page .= $Lin_result;
       }
   }
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

// 
 function gera_icone($doc) 
 {
    $cam_icone = "";
    $path =  $this->Ini->root . $this->Ini->path_icones . "/";
    if (is_dir($path))
    {
        $nm_icones = nm_list_icon($path); 
        $nm_tipo = strtolower(substr($doc, strrpos($doc, ".") + 1));
        $nm_tipo = str_replace(array('docx', 'xlsx'), array('doc', 'xls'), $nm_tipo);
        if (isset($nm_icones[$nm_tipo]) && !empty($nm_icones[$nm_tipo]))
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones[$nm_tipo];
        }
        else
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones["default"];
        }
    }
    return $cam_icone;
 } 
//
function considera_retencion_onChange()
{
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
  
$original_considera_retencion = $this->considera_retencion;
$original_monto_uf = $this->monto_uf;
$original_retencion = $this->retencion;
$original_iva = $this->iva;
$original_retencion_con_iva = $this->retencion_con_iva;
$original_produccion_neto = $this->produccion_neto;

$check_sql = "SELECT 
  proyectos.incluye_retencion,
  proyectos.existe_retencion
FROM
  proyectos
WHERE
  proyectos.id =".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			if ($this->rs[0][0]==1)
				{
				  $incluye_retencion="SI";
				}
			else
				{
				  $incluye_retencion="NO";
				}
		}
		else     
					
		{
			$incluye_retencion="NO";
							
		}
	
	if (isset($this->rs[0][1]))     
		{
			if ($this->rs[0][1]==1)
				{
				  $existe_retencion="SI";
				}
			else
				{
					$existe_retencion="NO";
				}
			
		}
				else     
		{
			$existe_retencion="NO";
					
		}

if ($existe_retencion=="SI")
	{
	  if ($this->considera_retencion ==1)
		  {
			$this->monto_uf =$this->monto_uf -$this->retencion ; 
			$this->iva =$this->monto_uf *1.19; 
			$this->retencion_con_iva =$this->retencion  * 1.19; 
		  }
	   else
		   {
		   	$this->monto_uf =$this->produccion_neto ;
		   	$this->iva =$this->monto_uf *1.19; 
		   }
	
	}
	else
	{
		$this->retencion_con_iva = 0;
	}



if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off';
$modificado_considera_retencion = $this->considera_retencion;
$modificado_monto_uf = $this->monto_uf;
$modificado_retencion = $this->retencion;
$modificado_iva = $this->iva;
$modificado_retencion_con_iva = $this->retencion_con_iva;
$modificado_produccion_neto = $this->produccion_neto;
$this->nm_formatar_campos('considera_retencion', 'monto_uf', 'retencion', 'iva', 'retencion_con_iva', 'produccion_neto');
if ($original_considera_retencion !== $modificado_considera_retencion || isset($this->nmgp_cmp_readonly['considera_retencion']) || (isset($bFlagRead_considera_retencion) && $bFlagRead_considera_retencion))
{
    $this->ajax_return_values_considera_retencion(true);
}
if ($original_monto_uf !== $modificado_monto_uf || isset($this->nmgp_cmp_readonly['monto_uf']) || (isset($bFlagRead_monto_uf) && $bFlagRead_monto_uf))
{
    $this->ajax_return_values_monto_uf(true);
}
if ($original_retencion !== $modificado_retencion || isset($this->nmgp_cmp_readonly['retencion']) || (isset($bFlagRead_retencion) && $bFlagRead_retencion))
{
    $this->ajax_return_values_retencion(true);
}
if ($original_iva !== $modificado_iva || isset($this->nmgp_cmp_readonly['iva']) || (isset($bFlagRead_iva) && $bFlagRead_iva))
{
    $this->ajax_return_values_iva(true);
}
if ($original_retencion_con_iva !== $modificado_retencion_con_iva || isset($this->nmgp_cmp_readonly['retencion_con_iva']) || (isset($bFlagRead_retencion_con_iva) && $bFlagRead_retencion_con_iva))
{
    $this->ajax_return_values_retencion_con_iva(true);
}
if ($original_produccion_neto !== $modificado_produccion_neto || isset($this->nmgp_cmp_readonly['produccion_neto']) || (isset($bFlagRead_produccion_neto) && $bFlagRead_produccion_neto))
{
    $this->ajax_return_values_produccion_neto(true);
}
$this->NM_ajax_info['event_field'] = 'considera';
form_prod_presupuesto_periodo_pack_ajax_response();
exit;
}
function fecha_desde_factura_onChange()
{
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
  
$original_produccion_neto = $this->produccion_neto;
$original_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
$original_retencion_acumulada = $this->retencion_acumulada;
$original_fecha_desde_factura = $this->fecha_desde_factura;
$original_fecha_hasta_factura = $this->fecha_hasta_factura;
$original_fecha_desde = $this->fecha_desde;
$original_id_proyecto = $this->id_proyecto;
$original_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
$original_avance_informado_con_iva = $this->avance_informado_con_iva;
$original_multa = $this->multa;
$original_retencion_con_iva = $this->retencion_con_iva;
$original_existe_retencion = $this->existe_retencion;
$original_retencion = $this->retencion;
$original_considera_retencion = $this->considera_retencion;
$original_iva = $this->iva;
$original_monto_uf = $this->monto_uf;
$original_total_facturado = $this->total_facturado;

$this->produccion_neto =0;
$this->reajuste_acumulado_neto =0;
$retencion_acumulada=0;
$monto_a_retener =0;
$retencion_periodo=0;

$prod2=0;

$check_sql = "SELECT retencion,porcentaje_retencion from proyectos where id=".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
				$monto_a_retener = $this->rs[0][0];
				$porcentaje_de_retencion=$this->rs[0][1]/100;
		}
				else     
		{
			    $monto_a_retener =0;
				$porcentaje_de_retencion=0;
		}
$check_sql = "SELECT sum(retencion) from prod_produccion_proyecto where id_proyecto=".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
				$retencion_acumulada= $this->rs[0][0];
		}
				else     
		{
			   $this->retencion_acumulada =0;
		}
$this->retencion_acumulada =  $this->retencion_acumulada;

if ($this->fecha_desde_factura <>"null" and $this->fecha_hasta_factura <>"null")
{
$time=$this->fecha_desde_factura ;
$month=date("m",strtotime($time));
$year=date("Y",strtotime($time));
$day=date("d",strtotime($time));
$fecha_desde_factura_1=$year."-".$month."-".$day;

$time2=$this->fecha_hasta_factura ;
$month2=date("m",strtotime($time2));
$year2=date("Y",strtotime($time2));
$day2=date("d",strtotime($time2));
$fecha_hasta_factura_1=$year2."-".$month2."-".$day2;

$time3=$this->fecha_desde ;
$month3=date("m",strtotime($time3));
$year3=date("Y",strtotime($time3));
$day3=date("d",strtotime($time3));

		$f1 = new DateTime($fecha_desde_factura_1);
		$f2 = new DateTime($fecha_hasta_factura_1);

		$f2 = $f2->modify( '+1 month' );
		$intervalo = DateInterval::createFromDateString('1 month');
		$periodo = new DatePeriod($f1, $intervalo, $f2);
		$meses = 0;
		$meses_str = [];
		foreach($periodo as $mes) {
			array_push($meses_str,$mes->format("Y/m"));
			$meses++;
		}
if (($month==$month2 and $year==$year2) or $day3==1)
	{
	$meses=$meses-1;
	}

		for ($i = 0; $i < $meses; $i++)
		{
			$check_sql="SELECT   prod_produccion_proyecto.avance,  prod_produccion_proyecto.produccion2,  prod_produccion_proyecto.id,  prod_produccion_proyecto.reajuste, prod_produccion_proyecto.produccion1 FROM  prod_produccion_proyecto  INNER JOIN prod_presupuesto_periodo ON (prod_produccion_proyecto.id = prod_presupuesto_periodo.id_partida)  AND (prod_produccion_proyecto.id_proyecto = prod_presupuesto_periodo.id_proyecto)  INNER JOIN prod_partida_presupuesto_periodo ON (prod_presupuesto_periodo.id = prod_partida_presupuesto_periodo.id_presupuesto_periodo)  AND (prod_presupuesto_periodo.id_proyecto = prod_partida_presupuesto_periodo.id_proyecto) WHERE   CONCAT(year(prod_produccion_proyecto.fecha), '/', LPAD(MONTH(prod_produccion_proyecto.fecha), 2, '0')) ='".$meses_str[$i]."' AND   prod_partida_presupuesto_periodo.facturado = 0 AND   prod_partida_presupuesto_periodo.id_proyecto =".$this->id_proyecto . " LIMIT 1";
			
			 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

			
			$prod1=$this->rs[0][4];
			$prod2=$this->rs[0][1];
			$this->reajuste_acumulado_neto =$this->reajuste_acumulado_neto + $this->rs[0][3];

			if (isset($this->rs[0][0]))     
				{
					if (($month==$month2 and $year==$year2) or $day3==1)
					{
						$this->produccion_neto = $this->produccion_neto  + $this->rs[0][0];
					}
				   
					if ($i==0 and ($day3<>1)) 
						{
						  $this->produccion_neto =$this->produccion_neto   + $prod2;
						}
				
					if ($i>0 and $i < ($meses-1) and $day3<>1)
				    {
						$this->produccion_neto = $this->produccion_neto  + $this->rs[0][0];
					}	
				
					if (($i==($meses - 1) and $meses>0) and $day3<>1)
				    {
						$this->produccion_neto = $this->produccion_neto + $prod1;
					}	
				}
				else
					{
						$prod1=0;
						$prod2=0;
						$this->produccion_neto = 0;
					}
			
		}
				
		
		
	
			  $this->reajuste_acumulado_con_iva =$this->reajuste_acumulado_neto *1.19;
			  $this->avance_informado_con_iva = $this->produccion_neto  * 1.19; 
              $this->avance_informado_con_iva =$this->avance_informado_con_iva - ($this->multa  * 1.19);
				
				$this->retencion_con_iva =  $this->avance_informado_con_iva  * $porcentaje_de_retencion; 
			  if ($this->existe_retencion ==1)
			  {
			    $this->retencion =$this->retencion_con_iva /1.19; 
	            $retencion_periodo=$this->retencion_con_iva /1.19; 
				  if (($this->retencion_acumulada +  $retencion_periodo) >= $monto_a_retener)
				  {
				  	 $this->retencion_con_iva =  ($monto_a_retener-$this->retencion_acumulada) * 1.19; 
					 $this->retencion =$this->retencion_con_iva /1.19; 
				  }
			  if (($this->retencion_acumulada + $retencion_periodo) < $monto_a_retener)
				  {
				  $this->retencion_con_iva =  $this->avance_informado_con_iva  * $this->porcentaje_retencion; 
					 $this->retencion =$this->retencion_con_iva /1.19; 
				  }
			  }
		      else
			  {
			    $this->retencion =0; 
	            $retencion_periodo=0; 
				 $this->retencion_con_iva =0;
			  }
	
	 		
	         
	
			
				   
			  $this->produccion_ep =$this->avance_informado_con_iva  - $this->retencion_con_iva ; 
	
			  	$this->iva =$this->produccion_ep  + $this->reajuste_acumulado_con_iva ;
			  $this->iva =$this->produccion_ep  ;	
			  $this->monto_uf =$this->iva /1.19;
			  $this->total_facturado =($this->produccion_ep  + $this->reajuste_acumulado_neto );
			
	    	  $this->avance_informado  = $this->produccion_neto ;
		      $this->avance =$this->total_facturado /1.19;
	}
else
	{
              $this->avance_informado_con_iva = 0;
			  $this->retencion_con_iva =  0;
			  $this->retencion =0;
			  $this->produccion_ep =0;
			  $this->iva =0;
			  $this->monto_uf =0;
			  $this->total_facturado =0;
			  $this->reajuste_acumulado_con_iva =0;
	    	  $this->avance_informado  = 0;
		      $this->avance =0;
	}



if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off';
$modificado_produccion_neto = $this->produccion_neto;
$modificado_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
$modificado_retencion_acumulada = $this->retencion_acumulada;
$modificado_fecha_desde_factura = $this->fecha_desde_factura;
$modificado_fecha_hasta_factura = $this->fecha_hasta_factura;
$modificado_fecha_desde = $this->fecha_desde;
$modificado_id_proyecto = $this->id_proyecto;
$modificado_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
$modificado_avance_informado_con_iva = $this->avance_informado_con_iva;
$modificado_multa = $this->multa;
$modificado_retencion_con_iva = $this->retencion_con_iva;
$modificado_existe_retencion = $this->existe_retencion;
$modificado_retencion = $this->retencion;
$modificado_considera_retencion = $this->considera_retencion;
$modificado_iva = $this->iva;
$modificado_monto_uf = $this->monto_uf;
$modificado_total_facturado = $this->total_facturado;
$this->nm_formatar_campos('produccion_neto', 'reajuste_acumulado_neto', 'retencion_acumulada', 'fecha_desde_factura', 'fecha_hasta_factura', 'fecha_desde', 'id_proyecto', 'reajuste_acumulado_con_iva', 'avance_informado_con_iva', 'multa', 'retencion_con_iva', 'existe_retencion', 'retencion', 'considera_retencion', 'iva', 'monto_uf', 'total_facturado');
if ($original_produccion_neto !== $modificado_produccion_neto || isset($this->nmgp_cmp_readonly['produccion_neto']) || (isset($bFlagRead_produccion_neto) && $bFlagRead_produccion_neto))
{
    $this->ajax_return_values_produccion_neto(true);
}
if ($original_reajuste_acumulado_neto !== $modificado_reajuste_acumulado_neto || isset($this->nmgp_cmp_readonly['reajuste_acumulado_neto']) || (isset($bFlagRead_reajuste_acumulado_neto) && $bFlagRead_reajuste_acumulado_neto))
{
    $this->ajax_return_values_reajuste_acumulado_neto(true);
}
if ($original_retencion_acumulada !== $modificado_retencion_acumulada || isset($this->nmgp_cmp_readonly['retencion_acumulada']) || (isset($bFlagRead_retencion_acumulada) && $bFlagRead_retencion_acumulada))
{
    $this->ajax_return_values_retencion_acumulada(true);
}
if ($original_fecha_desde_factura !== $modificado_fecha_desde_factura || isset($this->nmgp_cmp_readonly['fecha_desde_factura']) || (isset($bFlagRead_fecha_desde_factura) && $bFlagRead_fecha_desde_factura))
{
    $this->ajax_return_values_fecha_desde_factura(true);
}
if ($original_fecha_hasta_factura !== $modificado_fecha_hasta_factura || isset($this->nmgp_cmp_readonly['fecha_hasta_factura']) || (isset($bFlagRead_fecha_hasta_factura) && $bFlagRead_fecha_hasta_factura))
{
    $this->ajax_return_values_fecha_hasta_factura(true);
}
if ($original_fecha_desde !== $modificado_fecha_desde || isset($this->nmgp_cmp_readonly['fecha_desde']) || (isset($bFlagRead_fecha_desde) && $bFlagRead_fecha_desde))
{
    $this->ajax_return_values_fecha_desde(true);
}
if ($original_id_proyecto !== $modificado_id_proyecto || isset($this->nmgp_cmp_readonly['id_proyecto']) || (isset($bFlagRead_id_proyecto) && $bFlagRead_id_proyecto))
{
    $this->ajax_return_values_id_proyecto(true);
}
if ($original_reajuste_acumulado_con_iva !== $modificado_reajuste_acumulado_con_iva || isset($this->nmgp_cmp_readonly['reajuste_acumulado_con_iva']) || (isset($bFlagRead_reajuste_acumulado_con_iva) && $bFlagRead_reajuste_acumulado_con_iva))
{
    $this->ajax_return_values_reajuste_acumulado_con_iva(true);
}
if ($original_avance_informado_con_iva !== $modificado_avance_informado_con_iva || isset($this->nmgp_cmp_readonly['avance_informado_con_iva']) || (isset($bFlagRead_avance_informado_con_iva) && $bFlagRead_avance_informado_con_iva))
{
    $this->ajax_return_values_avance_informado_con_iva(true);
}
if ($original_multa !== $modificado_multa || isset($this->nmgp_cmp_readonly['multa']) || (isset($bFlagRead_multa) && $bFlagRead_multa))
{
    $this->ajax_return_values_multa(true);
}
if ($original_retencion_con_iva !== $modificado_retencion_con_iva || isset($this->nmgp_cmp_readonly['retencion_con_iva']) || (isset($bFlagRead_retencion_con_iva) && $bFlagRead_retencion_con_iva))
{
    $this->ajax_return_values_retencion_con_iva(true);
}
if ($original_existe_retencion !== $modificado_existe_retencion || isset($this->nmgp_cmp_readonly['existe_retencion']) || (isset($bFlagRead_existe_retencion) && $bFlagRead_existe_retencion))
{
    $this->ajax_return_values_existe_retencion(true);
}
if ($original_retencion !== $modificado_retencion || isset($this->nmgp_cmp_readonly['retencion']) || (isset($bFlagRead_retencion) && $bFlagRead_retencion))
{
    $this->ajax_return_values_retencion(true);
}
if ($original_considera_retencion !== $modificado_considera_retencion || isset($this->nmgp_cmp_readonly['considera_retencion']) || (isset($bFlagRead_considera_retencion) && $bFlagRead_considera_retencion))
{
    $this->ajax_return_values_considera_retencion(true);
}
if ($original_iva !== $modificado_iva || isset($this->nmgp_cmp_readonly['iva']) || (isset($bFlagRead_iva) && $bFlagRead_iva))
{
    $this->ajax_return_values_iva(true);
}
if ($original_monto_uf !== $modificado_monto_uf || isset($this->nmgp_cmp_readonly['monto_uf']) || (isset($bFlagRead_monto_uf) && $bFlagRead_monto_uf))
{
    $this->ajax_return_values_monto_uf(true);
}
if ($original_total_facturado !== $modificado_total_facturado || isset($this->nmgp_cmp_readonly['total_facturado']) || (isset($bFlagRead_total_facturado) && $bFlagRead_total_facturado))
{
    $this->ajax_return_values_total_facturado(true);
}
$this->NM_ajax_info['event_field'] = 'fecha';
form_prod_presupuesto_periodo_pack_ajax_response();
exit;
}
function fecha_desde_onChange()
{
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
  
$original_fecha_desde = $this->fecha_desde;
$original_dias_desde = $this->dias_desde;
$original_dias_periodo = $this->dias_periodo;
$original_fecha_hasta = $this->fecha_hasta;

 
      $nm_select = "select last_day('$this->fecha_desde')"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

$fin_mes= $this->rs[0][0];
$this->dias_desde =$this->nm_data->Dif_Datas($fin_mes, 'aaaa/mm/dd', $this->fecha_desde , 'aaaa/mm/dd') + 1;
$this->dias_periodo =$this->nm_data->Dif_Datas($this->fecha_hasta , 'aaaa/mm/dd', $this->fecha_desde , 'aaaa/mm/dd') + 1;

$time=$this->fecha_desde ;
$month=date("m",strtotime($time));
$year=date("Y",strtotime($time));

$dias_del_mes= cal_days_in_month(CAL_GREGORIAN, $month, $year); 




$modificado_fecha_desde = $this->fecha_desde;
$modificado_dias_desde = $this->dias_desde;
$modificado_dias_periodo = $this->dias_periodo;
$modificado_fecha_hasta = $this->fecha_hasta;
$this->nm_formatar_campos('fecha_desde', 'dias_desde', 'dias_periodo', 'fecha_hasta');
if ($original_fecha_desde !== $modificado_fecha_desde || isset($this->nmgp_cmp_readonly['fecha_desde']) || (isset($bFlagRead_fecha_desde) && $bFlagRead_fecha_desde))
{
    $this->ajax_return_values_fecha_desde(true);
}
if ($original_dias_desde !== $modificado_dias_desde || isset($this->nmgp_cmp_readonly['dias_desde']) || (isset($bFlagRead_dias_desde) && $bFlagRead_dias_desde))
{
    $this->ajax_return_values_dias_desde(true);
}
if ($original_dias_periodo !== $modificado_dias_periodo || isset($this->nmgp_cmp_readonly['dias_periodo']) || (isset($bFlagRead_dias_periodo) && $bFlagRead_dias_periodo))
{
    $this->ajax_return_values_dias_periodo(true);
}
if ($original_fecha_hasta !== $modificado_fecha_hasta || isset($this->nmgp_cmp_readonly['fecha_hasta']) || (isset($bFlagRead_fecha_hasta) && $bFlagRead_fecha_hasta))
{
    $this->ajax_return_values_fecha_hasta(true);
}
$this->NM_ajax_info['event_field'] = 'fecha';
form_prod_presupuesto_periodo_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off';
}
function fecha_hasta_factura_onChange()
{
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
  
$original_produccion_neto = $this->produccion_neto;
$original_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
$original_retencion_acumulada = $this->retencion_acumulada;
$original_fecha_desde_factura = $this->fecha_desde_factura;
$original_fecha_hasta_factura = $this->fecha_hasta_factura;
$original_fecha_desde = $this->fecha_desde;
$original_id_proyecto = $this->id_proyecto;
$original_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
$original_avance_informado_con_iva = $this->avance_informado_con_iva;
$original_multa = $this->multa;
$original_retencion_con_iva = $this->retencion_con_iva;
$original_existe_retencion = $this->existe_retencion;
$original_retencion = $this->retencion;
$original_considera_retencion = $this->considera_retencion;
$original_iva = $this->iva;
$original_monto_uf = $this->monto_uf;
$original_total_facturado = $this->total_facturado;

$this->produccion_neto =0;
$this->reajuste_acumulado_neto =0;
$retencion_acumulada=0;
$monto_a_retener =0;
$retencion_periodo=0;

$prod2=0;

$check_sql = "SELECT retencion,porcentaje_retencion from proyectos where id=".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
				$monto_a_retener = $this->rs[0][0];
				$porcentaje_de_retencion=$this->rs[0][1]/100;
		}
				else     
		{
			    $monto_a_retener =0;
				$porcentaje_de_retencion=0;
		}
$check_sql = "SELECT sum(retencion) from prod_produccion_proyecto where id_proyecto=".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
				$retencion_acumulada= $this->rs[0][0];
		}
				else     
		{
			   $this->retencion_acumulada =0;
		}
$this->retencion_acumulada =  $this->retencion_acumulada;

if ($this->fecha_desde_factura <>"null" and $this->fecha_hasta_factura <>"null")
{
$time=$this->fecha_desde_factura ;
$month=date("m",strtotime($time));
$year=date("Y",strtotime($time));
$day=date("d",strtotime($time));
$fecha_desde_factura_1=$year."-".$month."-".$day;

$time2=$this->fecha_hasta_factura ;
$month2=date("m",strtotime($time2));
$year2=date("Y",strtotime($time2));
$day2=date("d",strtotime($time2));
$fecha_hasta_factura_1=$year2."-".$month2."-".$day2;

$time3=$this->fecha_desde ;
$month3=date("m",strtotime($time3));
$year3=date("Y",strtotime($time3));
$day3=date("d",strtotime($time3));

		$f1 = new DateTime($fecha_desde_factura_1);
		$f2 = new DateTime($fecha_hasta_factura_1);

		$f2 = $f2->modify( '+1 month' );
		$intervalo = DateInterval::createFromDateString('1 month');
		$periodo = new DatePeriod($f1, $intervalo, $f2);
		$meses = 0;
		$meses_str = [];
		foreach($periodo as $mes) {
			array_push($meses_str,$mes->format("Y/m"));
			$meses++;
		}
if (($month==$month2 and $year==$year2) or $day3==1)
	{
	$meses=$meses-1;
	}

		for ($i = 0; $i < $meses; $i++)
		{
			$check_sql="SELECT   prod_produccion_proyecto.avance,  prod_produccion_proyecto.produccion2,  prod_produccion_proyecto.id,  prod_produccion_proyecto.reajuste, prod_produccion_proyecto.produccion1 FROM  prod_produccion_proyecto  INNER JOIN prod_presupuesto_periodo ON (prod_produccion_proyecto.id = prod_presupuesto_periodo.id_partida)  AND (prod_produccion_proyecto.id_proyecto = prod_presupuesto_periodo.id_proyecto)  INNER JOIN prod_partida_presupuesto_periodo ON (prod_presupuesto_periodo.id = prod_partida_presupuesto_periodo.id_presupuesto_periodo)  AND (prod_presupuesto_periodo.id_proyecto = prod_partida_presupuesto_periodo.id_proyecto) WHERE   CONCAT(year(prod_produccion_proyecto.fecha), '/', LPAD(MONTH(prod_produccion_proyecto.fecha), 2, '0')) ='".$meses_str[$i]."' AND   prod_partida_presupuesto_periodo.facturado = 0 AND   prod_partida_presupuesto_periodo.id_proyecto =".$this->id_proyecto . " LIMIT 1";
			
			 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

			
			$prod1=$this->rs[0][4];
			$prod2=$this->rs[0][1];
			$this->reajuste_acumulado_neto =$this->reajuste_acumulado_neto + $this->rs[0][3];

			if (isset($this->rs[0][0]))     
				{
					if (($month==$month2 and $year==$year2) or $day3==1)
					{
						$this->produccion_neto = $this->produccion_neto  + $this->rs[0][0];
					}
				   
					if ($i==0 and ($day3<>1)) 
						{
						  $this->produccion_neto =$this->produccion_neto   + $prod2;
						}
				
					if ($i>0 and $i < ($meses-1) and $day3<>1)
				    {
						$this->produccion_neto = $this->produccion_neto  + $this->rs[0][0];
					}	
				
					if (($i==($meses - 1) and $meses>0) and $day3<>1)
				    {
						$this->produccion_neto = $this->produccion_neto + $prod1;
					}	
				}
				else
					{
						$prod1=0;
						$prod2=0;
						$this->produccion_neto = 0;
					}
			
		}
				
		
		
	
			  $this->reajuste_acumulado_con_iva =$this->reajuste_acumulado_neto *1.19;
			  $this->avance_informado_con_iva = $this->produccion_neto  * 1.19; 
              $this->avance_informado_con_iva =$this->avance_informado_con_iva - ($this->multa  * 1.19);
				
				$this->retencion_con_iva =  $this->avance_informado_con_iva  * $porcentaje_de_retencion; 
			  if ($this->existe_retencion ==1)
			  {
			    $this->retencion =$this->retencion_con_iva /1.19; 
	            $retencion_periodo=$this->retencion_con_iva /1.19; 
				  if (($this->retencion_acumulada +  $retencion_periodo) >= $monto_a_retener)
				  {
				  	 $this->retencion_con_iva =  ($monto_a_retener-$this->retencion_acumulada) * 1.19; 
					 $this->retencion =$this->retencion_con_iva /1.19; 
				  }
			  if (($this->retencion_acumulada + $retencion_periodo) < $monto_a_retener)
				  {
				  $this->retencion_con_iva =  $this->avance_informado_con_iva  * $this->porcentaje_retencion; 
					 $this->retencion =$this->retencion_con_iva /1.19; 
				  }
			  }
		      else
			  {
			    $this->retencion =0; 
	            $retencion_periodo=0; 
				 $this->retencion_con_iva =0;
			  }
	
	 		
	         
	
			
				   
			  $this->produccion_ep =$this->avance_informado_con_iva  - $this->retencion_con_iva ; 
	
			  	$this->iva =$this->produccion_ep  + $this->reajuste_acumulado_con_iva ;
			  $this->iva =$this->produccion_ep  ;	
			  $this->monto_uf =$this->iva /1.19;
			  $this->total_facturado =($this->produccion_ep  + $this->reajuste_acumulado_neto );
			
	    	  $this->avance_informado  = $this->produccion_neto ;
		      $this->avance =$this->total_facturado /1.19;
	}
else
	{
              $this->avance_informado_con_iva = 0;
			  $this->retencion_con_iva =  0;
			  $this->retencion =0;
			  $this->produccion_ep =0;
			  $this->iva =0;
			  $this->monto_uf =0;
			  $this->total_facturado =0;
			  $this->reajuste_acumulado_con_iva =0;
	    	  $this->avance_informado  = 0;
		      $this->avance =0;
	}



if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off';
$modificado_produccion_neto = $this->produccion_neto;
$modificado_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
$modificado_retencion_acumulada = $this->retencion_acumulada;
$modificado_fecha_desde_factura = $this->fecha_desde_factura;
$modificado_fecha_hasta_factura = $this->fecha_hasta_factura;
$modificado_fecha_desde = $this->fecha_desde;
$modificado_id_proyecto = $this->id_proyecto;
$modificado_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
$modificado_avance_informado_con_iva = $this->avance_informado_con_iva;
$modificado_multa = $this->multa;
$modificado_retencion_con_iva = $this->retencion_con_iva;
$modificado_existe_retencion = $this->existe_retencion;
$modificado_retencion = $this->retencion;
$modificado_considera_retencion = $this->considera_retencion;
$modificado_iva = $this->iva;
$modificado_monto_uf = $this->monto_uf;
$modificado_total_facturado = $this->total_facturado;
$this->nm_formatar_campos('produccion_neto', 'reajuste_acumulado_neto', 'retencion_acumulada', 'fecha_desde_factura', 'fecha_hasta_factura', 'fecha_desde', 'id_proyecto', 'reajuste_acumulado_con_iva', 'avance_informado_con_iva', 'multa', 'retencion_con_iva', 'existe_retencion', 'retencion', 'considera_retencion', 'iva', 'monto_uf', 'total_facturado');
if ($original_produccion_neto !== $modificado_produccion_neto || isset($this->nmgp_cmp_readonly['produccion_neto']) || (isset($bFlagRead_produccion_neto) && $bFlagRead_produccion_neto))
{
    $this->ajax_return_values_produccion_neto(true);
}
if ($original_reajuste_acumulado_neto !== $modificado_reajuste_acumulado_neto || isset($this->nmgp_cmp_readonly['reajuste_acumulado_neto']) || (isset($bFlagRead_reajuste_acumulado_neto) && $bFlagRead_reajuste_acumulado_neto))
{
    $this->ajax_return_values_reajuste_acumulado_neto(true);
}
if ($original_retencion_acumulada !== $modificado_retencion_acumulada || isset($this->nmgp_cmp_readonly['retencion_acumulada']) || (isset($bFlagRead_retencion_acumulada) && $bFlagRead_retencion_acumulada))
{
    $this->ajax_return_values_retencion_acumulada(true);
}
if ($original_fecha_desde_factura !== $modificado_fecha_desde_factura || isset($this->nmgp_cmp_readonly['fecha_desde_factura']) || (isset($bFlagRead_fecha_desde_factura) && $bFlagRead_fecha_desde_factura))
{
    $this->ajax_return_values_fecha_desde_factura(true);
}
if ($original_fecha_hasta_factura !== $modificado_fecha_hasta_factura || isset($this->nmgp_cmp_readonly['fecha_hasta_factura']) || (isset($bFlagRead_fecha_hasta_factura) && $bFlagRead_fecha_hasta_factura))
{
    $this->ajax_return_values_fecha_hasta_factura(true);
}
if ($original_fecha_desde !== $modificado_fecha_desde || isset($this->nmgp_cmp_readonly['fecha_desde']) || (isset($bFlagRead_fecha_desde) && $bFlagRead_fecha_desde))
{
    $this->ajax_return_values_fecha_desde(true);
}
if ($original_id_proyecto !== $modificado_id_proyecto || isset($this->nmgp_cmp_readonly['id_proyecto']) || (isset($bFlagRead_id_proyecto) && $bFlagRead_id_proyecto))
{
    $this->ajax_return_values_id_proyecto(true);
}
if ($original_reajuste_acumulado_con_iva !== $modificado_reajuste_acumulado_con_iva || isset($this->nmgp_cmp_readonly['reajuste_acumulado_con_iva']) || (isset($bFlagRead_reajuste_acumulado_con_iva) && $bFlagRead_reajuste_acumulado_con_iva))
{
    $this->ajax_return_values_reajuste_acumulado_con_iva(true);
}
if ($original_avance_informado_con_iva !== $modificado_avance_informado_con_iva || isset($this->nmgp_cmp_readonly['avance_informado_con_iva']) || (isset($bFlagRead_avance_informado_con_iva) && $bFlagRead_avance_informado_con_iva))
{
    $this->ajax_return_values_avance_informado_con_iva(true);
}
if ($original_multa !== $modificado_multa || isset($this->nmgp_cmp_readonly['multa']) || (isset($bFlagRead_multa) && $bFlagRead_multa))
{
    $this->ajax_return_values_multa(true);
}
if ($original_retencion_con_iva !== $modificado_retencion_con_iva || isset($this->nmgp_cmp_readonly['retencion_con_iva']) || (isset($bFlagRead_retencion_con_iva) && $bFlagRead_retencion_con_iva))
{
    $this->ajax_return_values_retencion_con_iva(true);
}
if ($original_existe_retencion !== $modificado_existe_retencion || isset($this->nmgp_cmp_readonly['existe_retencion']) || (isset($bFlagRead_existe_retencion) && $bFlagRead_existe_retencion))
{
    $this->ajax_return_values_existe_retencion(true);
}
if ($original_retencion !== $modificado_retencion || isset($this->nmgp_cmp_readonly['retencion']) || (isset($bFlagRead_retencion) && $bFlagRead_retencion))
{
    $this->ajax_return_values_retencion(true);
}
if ($original_considera_retencion !== $modificado_considera_retencion || isset($this->nmgp_cmp_readonly['considera_retencion']) || (isset($bFlagRead_considera_retencion) && $bFlagRead_considera_retencion))
{
    $this->ajax_return_values_considera_retencion(true);
}
if ($original_iva !== $modificado_iva || isset($this->nmgp_cmp_readonly['iva']) || (isset($bFlagRead_iva) && $bFlagRead_iva))
{
    $this->ajax_return_values_iva(true);
}
if ($original_monto_uf !== $modificado_monto_uf || isset($this->nmgp_cmp_readonly['monto_uf']) || (isset($bFlagRead_monto_uf) && $bFlagRead_monto_uf))
{
    $this->ajax_return_values_monto_uf(true);
}
if ($original_total_facturado !== $modificado_total_facturado || isset($this->nmgp_cmp_readonly['total_facturado']) || (isset($bFlagRead_total_facturado) && $bFlagRead_total_facturado))
{
    $this->ajax_return_values_total_facturado(true);
}
$this->NM_ajax_info['event_field'] = 'fecha';
form_prod_presupuesto_periodo_pack_ajax_response();
exit;
}
function fecha_hasta_onChange()
{
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
  
$original_fecha_hasta = $this->fecha_hasta;
$original_fecha_desde = $this->fecha_desde;
$original_dias_hasta = $this->dias_hasta;
$original_dias_desde = $this->dias_desde;
$original_dias_periodo = $this->dias_periodo;

 
      $nm_select = "SELECT date_add(date_add(LAST_DAY('$this->fecha_hasta'),interval 1 DAY),interval -1 MONTH) AS first_day;"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

$inicio_mes= $this->rs[0][0];
$mon = date("m", strtotime($this->fecha_desde ));
$mon2 = date("m",strtotime($this->fecha_hasta ));
if ($mon==$mon2)
	{
	$this->dias_hasta =0;
	$this->dias_desde =$this->nm_data->Dif_Datas($this->fecha_hasta , 'aaaa/mm/dd', $this->fecha_desde , 'aaaa/mm/dd') + 1;
	}
else
	{
$this->dias_hasta =$this->nm_data->Dif_Datas($this->fecha_hasta , 'aaaa/mm/dd',$inicio_mes, 'aaaa/mm/dd')+1;
	}
$this->dias_periodo =$this->nm_data->Dif_Datas($this->fecha_hasta , 'aaaa/mm/dd', $this->fecha_desde , 'aaaa/mm/dd') + 1;





$modificado_fecha_hasta = $this->fecha_hasta;
$modificado_fecha_desde = $this->fecha_desde;
$modificado_dias_hasta = $this->dias_hasta;
$modificado_dias_desde = $this->dias_desde;
$modificado_dias_periodo = $this->dias_periodo;
$this->nm_formatar_campos('fecha_hasta', 'fecha_desde', 'dias_hasta', 'dias_desde', 'dias_periodo');
if ($original_fecha_hasta !== $modificado_fecha_hasta || isset($this->nmgp_cmp_readonly['fecha_hasta']) || (isset($bFlagRead_fecha_hasta) && $bFlagRead_fecha_hasta))
{
    $this->ajax_return_values_fecha_hasta(true);
}
if ($original_fecha_desde !== $modificado_fecha_desde || isset($this->nmgp_cmp_readonly['fecha_desde']) || (isset($bFlagRead_fecha_desde) && $bFlagRead_fecha_desde))
{
    $this->ajax_return_values_fecha_desde(true);
}
if ($original_dias_hasta !== $modificado_dias_hasta || isset($this->nmgp_cmp_readonly['dias_hasta']) || (isset($bFlagRead_dias_hasta) && $bFlagRead_dias_hasta))
{
    $this->ajax_return_values_dias_hasta(true);
}
if ($original_dias_desde !== $modificado_dias_desde || isset($this->nmgp_cmp_readonly['dias_desde']) || (isset($bFlagRead_dias_desde) && $bFlagRead_dias_desde))
{
    $this->ajax_return_values_dias_desde(true);
}
if ($original_dias_periodo !== $modificado_dias_periodo || isset($this->nmgp_cmp_readonly['dias_periodo']) || (isset($bFlagRead_dias_periodo) && $bFlagRead_dias_periodo))
{
    $this->ajax_return_values_dias_periodo(true);
}
$this->NM_ajax_info['event_field'] = 'fecha';
form_prod_presupuesto_periodo_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off';
}
function id_partida_onChange()
{
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
  
$original_id_partida = $this->id_partida;
$original_monto_contrato = $this->monto_contrato;
$original_monto_uf = $this->monto_uf;
$original_id_partida = $this->id_partida;

$check_sql = "SELECT 
  SUM(prod_presupuesto.monto_uf) as monto_total
FROM
  prod_presupuesto
WHERE
  prod_presupuesto.id_partida_periodo <=".$this->id_partida ." AND 
  prod_presupuesto.id_proyecto = ".$this->sc_temp_id_proyecto;


 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


if (isset($this->rs[0][0]))     
{
    $monto_total= $this->rs[0][0];
   
}
		else     
{
		   $monto_total=0;
}

$this->monto_contrato =$monto_total;

$check_sql = "SELECT correlativo_mes,modificacion_contrato from prod_produccion_proyecto where id=".$this->id_partida ;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
					$this->modificacion_contrato =$this->rs[0][1];

		}
				else     
		{
			
				 $this->modificacion_contrato =0;
		}



if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off';
$modificado_id_partida = $this->id_partida;
$modificado_monto_contrato = $this->monto_contrato;
$modificado_monto_uf = $this->monto_uf;
$modificado_id_partida = $this->id_partida;
$this->nm_formatar_campos('id_partida', 'monto_contrato', 'monto_uf');
if ($original_id_partida !== $modificado_id_partida || isset($this->nmgp_cmp_readonly['id_partida']) || (isset($bFlagRead_id_partida) && $bFlagRead_id_partida))
{
    $this->ajax_return_values_id_partida(true);
}
if ($original_monto_contrato !== $modificado_monto_contrato || isset($this->nmgp_cmp_readonly['monto_contrato']) || (isset($bFlagRead_monto_contrato) && $bFlagRead_monto_contrato))
{
    $this->ajax_return_values_monto_contrato(true);
}
if ($original_monto_uf !== $modificado_monto_uf || isset($this->nmgp_cmp_readonly['monto_uf']) || (isset($bFlagRead_monto_uf) && $bFlagRead_monto_uf))
{
    $this->ajax_return_values_monto_uf(true);
}
if ($original_id_partida !== $modificado_id_partida || isset($this->nmgp_cmp_readonly['id_partida']) || (isset($bFlagRead_id_partida) && $bFlagRead_id_partida))
{
    $this->ajax_return_values_id_partida(true);
}
$this->NM_ajax_info['event_field'] = 'id';
form_prod_presupuesto_periodo_pack_ajax_response();
exit;
}
function multa_onChange()
{
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
  
$original_produccion_neto = $this->produccion_neto;
$original_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
$original_fecha_desde_factura = $this->fecha_desde_factura;
$original_fecha_hasta_factura = $this->fecha_hasta_factura;
$original_fecha_desde = $this->fecha_desde;
$original_id_proyecto = $this->id_proyecto;
$original_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
$original_avance_informado_con_iva = $this->avance_informado_con_iva;
$original_multa = $this->multa;
$original_retencion_con_iva = $this->retencion_con_iva;
$original_retencion = $this->retencion;
$original_incluye_retencion = $this->incluye_retencion;
$original_iva = $this->iva;
$original_monto_uf = $this->monto_uf;
$original_total_facturado = $this->total_facturado;

$this->produccion_neto =0;
$this->reajuste_acumulado_neto =0;
$prod2=0;

if ($this->fecha_desde_factura <>"null" and $this->fecha_hasta_factura <>"null")
{
	$check_sql = "SELECT porcentaje_retencion from proyectos where id=".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			$porcentaje_de_retencion=$this->rs[0][0]/100;
		}
				else     
		{
			$porcentaje_de_retencion=0;
		}
	
$time=$this->fecha_desde_factura ;
$month=date("m",strtotime($time));
$year=date("Y",strtotime($time));
$day=date("d",strtotime($time));
$fecha_desde_factura_1=$year."-".$month."-".$day;

$time2=$this->fecha_hasta_factura ;
$month2=date("m",strtotime($time2));
$year2=date("Y",strtotime($time2));
$day2=date("d",strtotime($time2));
$fecha_hasta_factura_1=$year2."-".$month2."-".$day2;

$time3=$this->fecha_desde ;
$month3=date("m",strtotime($time3));
$year3=date("Y",strtotime($time3));
$day3=date("d",strtotime($time3));

		$f1 = new DateTime($fecha_desde_factura_1);
		$f2 = new DateTime($fecha_hasta_factura_1);

		$f2 = $f2->modify( '+1 month' );
		$intervalo = DateInterval::createFromDateString('1 month');
		$periodo = new DatePeriod($f1, $intervalo, $f2);
		$meses = 0;
		$meses_str = [];
		foreach($periodo as $mes) {
			array_push($meses_str,$mes->format("Y/m"));
			$meses++;
		}
if (($month==$month2 and $year==$year2) or $day3==1)
	{
	$meses=$meses-1;
	}

		for ($i = 0; $i < $meses; $i++)
		{
			$check_sql="SELECT   prod_produccion_proyecto.avance,  prod_produccion_proyecto.produccion2,  prod_produccion_proyecto.id,  prod_produccion_proyecto.reajuste, prod_produccion_proyecto.produccion1 FROM  prod_produccion_proyecto  INNER JOIN prod_presupuesto_periodo ON (prod_produccion_proyecto.id = prod_presupuesto_periodo.id_partida)  AND (prod_produccion_proyecto.id_proyecto = prod_presupuesto_periodo.id_proyecto)  INNER JOIN prod_partida_presupuesto_periodo ON (prod_presupuesto_periodo.id = prod_partida_presupuesto_periodo.id_presupuesto_periodo)  AND (prod_presupuesto_periodo.id_proyecto = prod_partida_presupuesto_periodo.id_proyecto) WHERE   CONCAT(year(prod_produccion_proyecto.fecha), '/', LPAD(MONTH(prod_produccion_proyecto.fecha), 2, '0')) ='".$meses_str[$i]."' AND   prod_partida_presupuesto_periodo.facturado = 0 AND   prod_partida_presupuesto_periodo.id_proyecto =".$this->id_proyecto . " LIMIT 1";
			
			 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

			
			$prod1=$this->rs[0][4];
			$prod2=$this->rs[0][1];
			$this->reajuste_acumulado_neto =$this->reajuste_acumulado_neto + $this->rs[0][3];

			if (isset($this->rs[0][0]))     
				{
					if (($month==$month2 and $year==$year2) or $day3==1)
					{
						$this->produccion_neto = $this->produccion_neto  + $this->rs[0][0];
					}
				   
					if ($i==0 and ($day3<>1)) 
						{
						  $this->produccion_neto =$this->produccion_neto   + $prod2;
						}
				
					if ($i>0 and $i < ($meses-1) and $day3<>1)
				    {
						$this->produccion_neto = $this->produccion_neto  + $this->rs[0][0];
					}	
				
					if (($i==($meses - 1) and $meses>0) and $day3<>1)
				    {
						$this->produccion_neto = $this->produccion_neto + $prod1;
					}	
				}
				else
					{
						$prod1=0;
						$prod2=0;
						$this->produccion_neto = 0;
					}
			
		}
				
		
		
			  
			  $this->reajuste_acumulado_con_iva =$this->reajuste_acumulado_neto *1.19;
			  $this->avance_informado_con_iva = $this->produccion_neto  * 1.19; 
	          $this->avance_informado_con_iva =$this->avance_informado_con_iva - ($this->multa  * 1.19);
			 $this->retencion_con_iva =  $this->avance_informado_con_iva  * $porcentaje_de_retencion; 
			  $this->retencion =$this->retencion_con_iva /1.19; 
			  if ($this->incluye_retencion ==1)
			  {
			  	$this->produccion_ep =$this->avance_informado_con_iva  ;
			  } 
			  else
			  {
			  	$this->produccion_ep =$this->avance_informado_con_iva  - $this->retencion_con_iva ;
			  }
			  	$this->iva =$this->produccion_ep  + $this->reajuste_acumulado_con_iva ;
			  $this->iva =$this->produccion_ep  ;	
			  $this->monto_uf =$this->iva /1.19;
			  $this->total_facturado =($this->produccion_ep  + $this->reajuste );
			
	    	  $this->avance_informado  = $this->produccion_neto ;
		      $this->avance =$this->total_facturado /1.19;
	}
else
	{
              $this->avance_informado_con_iva = 0;
			  $this->retencion_con_iva =  0;
			  $this->retencion =0;
			  $this->produccion_ep =0;
			  $this->iva =0;
			  $this->monto_uf =0;
			  $this->total_facturado =0;
			  $this->reajuste_acumulado_con_iva =0;
	    	  $this->avance_informado  = 0;
		      $this->avance =0;
	}



if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off';
$modificado_produccion_neto = $this->produccion_neto;
$modificado_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
$modificado_fecha_desde_factura = $this->fecha_desde_factura;
$modificado_fecha_hasta_factura = $this->fecha_hasta_factura;
$modificado_fecha_desde = $this->fecha_desde;
$modificado_id_proyecto = $this->id_proyecto;
$modificado_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
$modificado_avance_informado_con_iva = $this->avance_informado_con_iva;
$modificado_multa = $this->multa;
$modificado_retencion_con_iva = $this->retencion_con_iva;
$modificado_retencion = $this->retencion;
$modificado_incluye_retencion = $this->incluye_retencion;
$modificado_iva = $this->iva;
$modificado_monto_uf = $this->monto_uf;
$modificado_total_facturado = $this->total_facturado;
$this->nm_formatar_campos('produccion_neto', 'reajuste_acumulado_neto', 'fecha_desde_factura', 'fecha_hasta_factura', 'fecha_desde', 'id_proyecto', 'reajuste_acumulado_con_iva', 'avance_informado_con_iva', 'multa', 'retencion_con_iva', 'retencion', 'incluye_retencion', 'iva', 'monto_uf', 'total_facturado');
if ($original_produccion_neto !== $modificado_produccion_neto || isset($this->nmgp_cmp_readonly['produccion_neto']) || (isset($bFlagRead_produccion_neto) && $bFlagRead_produccion_neto))
{
    $this->ajax_return_values_produccion_neto(true);
}
if ($original_reajuste_acumulado_neto !== $modificado_reajuste_acumulado_neto || isset($this->nmgp_cmp_readonly['reajuste_acumulado_neto']) || (isset($bFlagRead_reajuste_acumulado_neto) && $bFlagRead_reajuste_acumulado_neto))
{
    $this->ajax_return_values_reajuste_acumulado_neto(true);
}
if ($original_fecha_desde_factura !== $modificado_fecha_desde_factura || isset($this->nmgp_cmp_readonly['fecha_desde_factura']) || (isset($bFlagRead_fecha_desde_factura) && $bFlagRead_fecha_desde_factura))
{
    $this->ajax_return_values_fecha_desde_factura(true);
}
if ($original_fecha_hasta_factura !== $modificado_fecha_hasta_factura || isset($this->nmgp_cmp_readonly['fecha_hasta_factura']) || (isset($bFlagRead_fecha_hasta_factura) && $bFlagRead_fecha_hasta_factura))
{
    $this->ajax_return_values_fecha_hasta_factura(true);
}
if ($original_fecha_desde !== $modificado_fecha_desde || isset($this->nmgp_cmp_readonly['fecha_desde']) || (isset($bFlagRead_fecha_desde) && $bFlagRead_fecha_desde))
{
    $this->ajax_return_values_fecha_desde(true);
}
if ($original_id_proyecto !== $modificado_id_proyecto || isset($this->nmgp_cmp_readonly['id_proyecto']) || (isset($bFlagRead_id_proyecto) && $bFlagRead_id_proyecto))
{
    $this->ajax_return_values_id_proyecto(true);
}
if ($original_reajuste_acumulado_con_iva !== $modificado_reajuste_acumulado_con_iva || isset($this->nmgp_cmp_readonly['reajuste_acumulado_con_iva']) || (isset($bFlagRead_reajuste_acumulado_con_iva) && $bFlagRead_reajuste_acumulado_con_iva))
{
    $this->ajax_return_values_reajuste_acumulado_con_iva(true);
}
if ($original_avance_informado_con_iva !== $modificado_avance_informado_con_iva || isset($this->nmgp_cmp_readonly['avance_informado_con_iva']) || (isset($bFlagRead_avance_informado_con_iva) && $bFlagRead_avance_informado_con_iva))
{
    $this->ajax_return_values_avance_informado_con_iva(true);
}
if ($original_multa !== $modificado_multa || isset($this->nmgp_cmp_readonly['multa']) || (isset($bFlagRead_multa) && $bFlagRead_multa))
{
    $this->ajax_return_values_multa(true);
}
if ($original_retencion_con_iva !== $modificado_retencion_con_iva || isset($this->nmgp_cmp_readonly['retencion_con_iva']) || (isset($bFlagRead_retencion_con_iva) && $bFlagRead_retencion_con_iva))
{
    $this->ajax_return_values_retencion_con_iva(true);
}
if ($original_retencion !== $modificado_retencion || isset($this->nmgp_cmp_readonly['retencion']) || (isset($bFlagRead_retencion) && $bFlagRead_retencion))
{
    $this->ajax_return_values_retencion(true);
}
if ($original_incluye_retencion !== $modificado_incluye_retencion || isset($this->nmgp_cmp_readonly['incluye_retencion']) || (isset($bFlagRead_incluye_retencion) && $bFlagRead_incluye_retencion))
{
    $this->ajax_return_values_incluye_retencion(true);
}
if ($original_iva !== $modificado_iva || isset($this->nmgp_cmp_readonly['iva']) || (isset($bFlagRead_iva) && $bFlagRead_iva))
{
    $this->ajax_return_values_iva(true);
}
if ($original_monto_uf !== $modificado_monto_uf || isset($this->nmgp_cmp_readonly['monto_uf']) || (isset($bFlagRead_monto_uf) && $bFlagRead_monto_uf))
{
    $this->ajax_return_values_monto_uf(true);
}
if ($original_total_facturado !== $modificado_total_facturado || isset($this->nmgp_cmp_readonly['total_facturado']) || (isset($bFlagRead_total_facturado) && $bFlagRead_total_facturado))
{
    $this->ajax_return_values_total_facturado(true);
}
$this->NM_ajax_info['event_field'] = 'multa';
form_prod_presupuesto_periodo_pack_ajax_response();
exit;
}
function retencion_onChange()
{
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'on';
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
  
$original_monto_uf = $this->monto_uf;
$original_retencion = $this->retencion;
$original_iva = $this->iva;
$original_retencion_con_iva = $this->retencion_con_iva;

$check_sql = "SELECT 
  proyectos.incluye_retencion,
  proyectos.existe_retencion
FROM
  proyectos
WHERE
  proyectos.id =".$this->sc_temp_id_proyecto;
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs[0][0]))     
		{
			if ($this->rs[0][0]==1)
				{
				  $incluye_retencion="SI";
				}
			else
				{
				  $incluye_retencion="NO";
				}
		}
		else     
					
		{
			$incluye_retencion="NO";
							
		}
	
	if (isset($this->rs[0][1]))     
		{
			if ($this->rs[0][1]==1)
				{
				  $existe_retencion="SI";
				}
			else
				{
					$existe_retencion="NO";
				}
			
		}
				else     
		{
			$existe_retencion="NO";
					
		}

if ($existe_retencion=="SI")
	{
		$this->monto_uf =$this->monto_uf -$this->retencion ; 
		$this->iva =$this->monto_uf *1.19; 
		$this->retencion_con_iva =$this->retencion  * 1.19; 
	}
	else
	{
		$this->retencion_con_iva = 0;
	}
	



if (isset($this->sc_temp_id_proyecto)) { $_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
$_SESSION['scriptcase']['form_prod_presupuesto_periodo']['contr_erro'] = 'off';
$modificado_monto_uf = $this->monto_uf;
$modificado_retencion = $this->retencion;
$modificado_iva = $this->iva;
$modificado_retencion_con_iva = $this->retencion_con_iva;
$this->nm_formatar_campos('monto_uf', 'retencion', 'iva', 'retencion_con_iva');
if ($original_monto_uf !== $modificado_monto_uf || isset($this->nmgp_cmp_readonly['monto_uf']) || (isset($bFlagRead_monto_uf) && $bFlagRead_monto_uf))
{
    $this->ajax_return_values_monto_uf(true);
}
if ($original_retencion !== $modificado_retencion || isset($this->nmgp_cmp_readonly['retencion']) || (isset($bFlagRead_retencion) && $bFlagRead_retencion))
{
    $this->ajax_return_values_retencion(true);
}
if ($original_iva !== $modificado_iva || isset($this->nmgp_cmp_readonly['iva']) || (isset($bFlagRead_iva) && $bFlagRead_iva))
{
    $this->ajax_return_values_iva(true);
}
if ($original_retencion_con_iva !== $modificado_retencion_con_iva || isset($this->nmgp_cmp_readonly['retencion_con_iva']) || (isset($bFlagRead_retencion_con_iva) && $bFlagRead_retencion_con_iva))
{
    $this->ajax_return_values_retencion_con_iva(true);
}
$this->NM_ajax_info['event_field'] = 'retencion';
form_prod_presupuesto_periodo_pack_ajax_response();
exit;
}
//
 function nm_gera_html()
 {
    global
           $nm_url_saida, $nmgp_url_saida, $nm_saida_global, $nm_apl_dependente, $glo_subst, $sc_check_excl, $sc_check_incl, $nmgp_num_form, $NM_run_iframe;
     if ($this->Embutida_proc)
     {
         return;
     }
     if ($this->nmgp_form_show == 'off')
     {
         exit;
     }
      if (isset($NM_run_iframe) && $NM_run_iframe == 1)
      {
          $this->nmgp_botoes['exit'] = "off";
      }
     $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opc_ant'] = $this->nmgp_opcao;
     }
     else
     {
         $this->nmgp_opcao = $this->nmgp_opc_ant;
     }
     if (!empty($this->Campos_Mens_erro)) 
     {
         $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
         $this->Campos_Mens_erro = "";
     }
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_prod_presupuesto_periodo_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
//-- 
   if ($this->factura != "" && $this->factura != "none")   
   { 
       $sTmpExtension = pathinfo($this->factura, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_factura = 'sc_factura_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['download_filenames'][$sTmpFile_factura] = $this->factura;
   } 
        $this->initFormPages();
    include_once("form_prod_presupuesto_periodo_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_format_readonly($field, $value)
    {
        $result = $value;

        $this->form_highlight_search($result, $field, $value);

        return $result;
    }

    function form_highlight_search(&$result, $field, $value)
    {
        if ($this->proc_fast_search) {
            $this->form_highlight_search_quicksearch($result, $field, $value);
        }
    }

    function form_highlight_search_quicksearch(&$result, $field, $value)
    {
        $searchOk = false;
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("id", "id_proyecto", "id_item", "fecha", "monto_uf", "vigente", "observaciones", "orden"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array(""))) {
            $searchOk = true;
        }

        if (!$searchOk || '' == $this->nmgp_arg_fast_search) {
            return;
        }

        $htmlIni = '<div class="highlight" style="background-color: #fafaca; display: inline-block">';
        $htmlFim = '</div>';

        if ('qp' == $this->nmgp_cond_fast_search) {
            $keywords = preg_quote($this->nmgp_arg_fast_search, '/');
            $result = preg_replace('/'. $keywords .'/i', $htmlIni . '$0' . $htmlFim, $result);
        } elseif ('eq' == $this->nmgp_cond_fast_search) {
            if (strcasecmp($this->nmgp_arg_fast_search, $value) == 0) {
                $result = $htmlIni. $result .$htmlFim;
            }
        }
    }


    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input

   function jqueryCalendarDtFormat($sFormat, $sSep)
   {
       $sFormat = chunk_split(str_replace('yyyy', 'yy', $sFormat), 2, $sSep);

       if ($sSep == substr($sFormat, -1))
       {
           $sFormat = substr($sFormat, 0, -1);
       }

       return $sFormat;
   } // jqueryCalendarDtFormat

   function jqueryCalendarTimeStart($sFormat)
   {
       $aDateParts = explode(';', $sFormat);

       if (2 == sizeof($aDateParts))
       {
           $sTime = $aDateParts[1];
       }
       else
       {
           $sTime = 'hh:mm:ss';
       }

       return str_replace(array('h', 'm', 'i', 's'), array('0', '0', '0', '0'), $sTime);
   } // jqueryCalendarTimeStart

   function jqueryCalendarWeekInit($sDay)
   {
       switch ($sDay) {
           case 'MO': return 1; break;
           case 'TU': return 2; break;
           case 'WE': return 3; break;
           case 'TH': return 4; break;
           case 'FR': return 5; break;
           case 'SA': return 6; break;
           default  : return 7; break;
       }
   } // jqueryCalendarWeekInit

   function jqueryIconFile($sModule)
   {
       $sImage = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && 'image' == $this->arr_buttons['bcalendario']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalendario']['display'])
           {
               $sImage = $this->arr_buttons['bcalendario']['image'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && 'image' == $this->arr_buttons['bcalculadora']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalculadora']['display'])
           {
               $sImage = $this->arr_buttons['bcalculadora']['image'];
           }
       }

       return '' == $sImage ? '' : $this->Ini->path_icones . '/' . $sImage;
   } // jqueryIconFile

   function jqueryFAFile($sModule)
   {
       $sFA = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
           {
               $sFA = $this->arr_buttons['bcalendario']['fontawesomeicon'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
           {
               $sFA = $this->arr_buttons['bcalculadora']['fontawesomeicon'];
           }
       }

       return '' == $sFA ? '' : "<span class='scButton_fontawesome " . $sFA . "'></span>";
   } // jqueryFAFile

   function jqueryButtonText($sModule)
   {
       $sClass = '';
       $sText  = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalendario']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalendario']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalendario']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i>";
                   }
               }
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalculadora']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalculadora']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalculadora']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> ";
                   }
               }
           }
       }

       return '' == $sText ? array('', '') : array($sText, $sClass);
   } // jqueryButtonText


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['csrf_token'];
    }

    function scCsrfGenerateToken()
    {
        $aSources = array(
            'abcdefghijklmnopqrstuvwxyz',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '1234567890',
            '!@$*()-_[]{},.;:'
        );

        $sRandom = '';

        $aSourcesSizes = array();
        $iSourceSize   = sizeof($aSources) - 1;
        for ($i = 0; $i <= $iSourceSize; $i++)
        {
            $aSourcesSizes[$i] = strlen($aSources[$i]) - 1;
        }

        for ($i = 0; $i < 64; $i++)
        {
            $iSource = $this->scCsrfRandom(0, $iSourceSize);
            $sRandom .= substr($aSources[$iSource], $this->scCsrfRandom(0, $aSourcesSizes[$iSource]), 1);
        }

        return $sRandom;
    }

    function scCsrfRandom($iMin, $iMax)
    {
        return mt_rand($iMin, $iMax);
    }

        function addUrlParam($url, $param, $value) {
                $urlParts  = explode('?', $url);
                $urlParams = isset($urlParts[1]) ? explode('&', $urlParts[1]) : array();
                $objParams = array();
                foreach ($urlParams as $paramInfo) {
                        $paramParts = explode('=', $paramInfo);
                        $objParams[ $paramParts[0] ] = isset($paramParts[1]) ? $paramParts[1] : '';
                }
                $objParams[$param] = $value;
                $urlParams = array();
                foreach ($objParams as $paramName => $paramValue) {
                        $urlParams[] = $paramName . '=' . $paramValue;
                }
                return $urlParts[0] . '?' . implode('&', $urlParams);
        }
 function allowedCharsCharset($charlist)
 {
     if ($_SESSION['scriptcase']['charset'] != 'UTF-8')
     {
         $charlist = NM_conv_charset($charlist, $_SESSION['scriptcase']['charset'], 'UTF-8');
     }
     return str_replace("'", "\'", $charlist);
 }

function sc_file_size($file, $format = false)
{
    if ('' == $file) {
        return '';
    }
    if (!@is_file($file)) {
        return '';
    }
    $fileSize = @filesize($file);
    if ($format) {
        $suffix = '';
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' KB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' MB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' GB';
        }
        $fileSize = $fileSize . $suffix;
    }
    return $fileSize;
}


 function new_date_format($type, $field)
 {
     $new_date_format_out = '';

     if ('DT' == $type)
     {
         $date_format  = $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = $this->field_config[$field]['date_display'];
         $time_format  = '';
         $time_sep     = '';
         $time_display = '';
     }
     elseif ('DH' == $type)
     {
         $date_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , 0, strpos($this->field_config[$field]['date_format'] , ';')) : $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], 0, strpos($this->field_config[$field]['date_display'], ';')) : $this->field_config[$field]['date_display'];
         $time_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , strpos($this->field_config[$field]['date_format'] , ';') + 1) : '';
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], strpos($this->field_config[$field]['date_display'], ';') + 1) : '';
     }
     elseif ('HH' == $type)
     {
         $date_format  = '';
         $date_sep     = '';
         $date_display = '';
         $time_format  = $this->field_config[$field]['date_format'];
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = $this->field_config[$field]['date_display'];
     }

     if ('DT' == $type || 'DH' == $type)
     {
         $date_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_format); $i++)
         {
             $char = strtolower(substr($date_format, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $date_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $date_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $disp_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_display); $i++)
         {
             $char = strtolower(substr($date_display, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $disp_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $disp_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $date_final = array();
         foreach ($date_array as $date_part)
         {
             if (in_array($date_part, $disp_array))
             {
                 $date_final[] = $date_part;
             }
         }

         $date_format = implode($date_sep, $date_final);
     }
     if ('HH' == $type || 'DH' == $type)
     {
         $time_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_format); $i++)
         {
             $char = strtolower(substr($time_format, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $time_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $time_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $disp_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_display); $i++)
         {
             $char = strtolower(substr($time_display, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $disp_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $disp_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $time_final = array();
         foreach ($time_array as $time_part)
         {
             if (in_array($time_part, $disp_array))
             {
                 $time_final[] = $time_part;
             }
         }

         $time_format = implode($time_sep, $time_final);
     }

     if ('DT' == $type)
     {
         $old_date_format = $date_format;
     }
     elseif ('DH' == $type)
     {
         $old_date_format = $date_format . ';' . $time_format;
     }
     elseif ('HH' == $type)
     {
         $old_date_format = $time_format;
     }

     for ($i = 0; $i < strlen($old_date_format); $i++)
     {
         $char = substr($old_date_format, $i, 1);
         if ('/' == $char)
         {
             $new_date_format_out .= $date_sep;
         }
         elseif (':' == $char)
         {
             $new_date_format_out .= $time_sep;
         }
         else
         {
             $new_date_format_out .= $char;
         }
     }

     $this->field_config[$field]['date_format'] = $new_date_format_out;
     if ('DH' == $type)
     {
         $new_date_format_out                                  = explode(';', $new_date_format_out);
         $this->field_config[$field]['date_format_js']        = $new_date_format_out[0];
         $this->field_config[$field . '_hora']['date_format'] = $new_date_format_out[1];
         $this->field_config[$field . '_hora']['time_sep']    = $this->field_config[$field]['time_sep'];
     }
 } // new_date_format

   function Form_lookup_id_proyecto()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT id, nombre_proyecto  FROM proyectos where id=" . $_SESSION['id_proyecto'] . "  ORDER BY nombre_proyecto";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_tipo_moneda()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    proyectos.tipo_moneda,   prod_monedas.tipo_moneda FROM   proyectos   INNER JOIN prod_monedas ON (proyectos.tipo_moneda = prod_monedas.id) WHERE   proyectos.id =" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_empresa()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    companias.razon_social,  companias.razon_social FROM   proyectos   INNER JOIN companias ON (proyectos.id_empresa = companias.id) WHERE   proyectos.id =" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_cliente()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    prod_clientes.nombre,prod_clientes.nombre  FROM   proyectos   INNER JOIN prod_clientes ON (proyectos.id_cliente = prod_clientes.id) WHERE   proyectos.id=" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_id_partida()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT id,concat(month(fecha),'-',year(fecha))   FROM prod_produccion_proyecto  WHERE id_proyecto=" . $_SESSION['id_proyecto'] . "  ORDER BY fecha";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_considera_retencion()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "NO?#?0?#?N?@?";
       $nmgp_def_dados .= "SI?#?1?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_facturado()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_iva = $this->iva;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_reajuste_acumulado_con_iva = $this->reajuste_acumulado_con_iva;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    prod_estado_facturacion.valor_estado,   prod_estado_facturacion.estado FROM   prod_estado_facturacion WHERE   prod_estado_facturacion.grupo = '" . $_SESSION['group_name'] . "'";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->reajuste_acumulado_con_iva = $old_value_reajuste_acumulado_con_iva;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->total_facturado = $old_value_total_facturado;
   $this->iva = $old_value_iva;
   $this->monto_uf = $old_value_monto_uf;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = false;
      if (empty($data_search)) 
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_prod_presupuesto_periodo_pack_ajax_response();
              exit;
          }
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "id", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_id_proyecto($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "id_proyecto", $arg_search, $data_lookup, "INT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_id_item($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "id_item", $arg_search, $data_lookup, "INT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "fecha", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "monto_uf", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "vigente", $arg_search, str_replace(",", ".", $data_search), "TINYINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "observaciones", $arg_search, $data_search, "TEXT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "orden", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter_form'] . " and (" . $comando . ")";
      }
      else
      {
         $sc_where = " where " . $comando;
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_form_prod_presupuesto_periodo = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total'] = $qt_geral_reg_form_prod_presupuesto_periodo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_prod_presupuesto_periodo_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_prod_presupuesto_periodo_pack_ajax_response();
          exit;
      }
   }
   function SC_monta_condicao(&$comando, $nome, $condicao, $campo, $tp_campo="", $tp_unaccent=false)
   {
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $nm_numeric = array();
      $Nm_datas   = array();
      $campo_join = strtolower(str_replace(".", "_", $nome));
      $nm_ini_lower = "";
      $nm_fim_lower = "";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $nm_numeric[] = "id";$nm_numeric[] = "id_proyecto";$nm_numeric[] = "id_item";$nm_numeric[] = "monto_uf";$nm_numeric[] = "vigente";$nm_numeric[] = "orden";$nm_numeric[] = "id_partida";$nm_numeric[] = "avance";$nm_numeric[] = "facturado";$nm_numeric[] = "valor_uf";$nm_numeric[] = "tipo_moneda";$nm_numeric[] = "retencion";$nm_numeric[] = "reajuste";$nm_numeric[] = "multa";$nm_numeric[] = "dias_desde";$nm_numeric[] = "dias_hasta";$nm_numeric[] = "factor_produccion";$nm_numeric[] = "dias_periodo";$nm_numeric[] = "avance_periodo";$nm_numeric[] = "avance_periodo_siguiente";$nm_numeric[] = "avance_informado";$nm_numeric[] = "avance_periodo_anterior";$nm_numeric[] = "produccion_total_final";$nm_numeric[] = "total_facturado";$nm_numeric[] = "total_facturado_ur";$nm_numeric[] = "avance_informado_con_iva";$nm_numeric[] = "produccion_ep";$nm_numeric[] = "reajuste_con_iva";$nm_numeric[] = "retencion_con_iva";$nm_numeric[] = "produccion_neto";$nm_numeric[] = "reajuste_acumulado_neto";$nm_numeric[] = "reajuste_acumulado_con_iva";$nm_numeric[] = "considera_retencion";$nm_numeric[] = "";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['decimal_db'] == ".")
         {
             $nm_aspas  = "";
             $nm_aspas1 = "";
         }
         if (is_array($campo))
         {
             foreach ($campo as $Ind => $Cmp)
             {
                if (!is_numeric($Cmp))
                {
                    return;
                }
                if ($Cmp == "")
                {
                    $campo[$Ind] = 0;
                }
             }
         }
         else
         {
             if (!is_numeric($campo))
             {
                 return;
             }
             if ($campo == "")
             {
                $campo = 0;
             }
         }
      }
      $Nm_datas["fecha"] = "date";$Nm_datas["fecha_desde"] = "date";$Nm_datas["fecha_hasta"] = "date";$Nm_datas["fecha_desde_factura"] = "date";$Nm_datas["fecha_hasta_factura"] = "date";
         if (isset($Nm_datas[$campo_join]))
         {
             for ($x = 0; $x < strlen($campo); $x++)
             {
                 $tst = substr($campo, $x, 1);
                 if (!is_numeric($tst) && ($tst != "-" && $tst != ":" && $tst != " "))
                 {
                     return;
                 }
             }
         }
          if (isset($Nm_datas[$campo_join]))
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['SC_sep_date1'];
              }
          }
      if (isset($Nm_datas[$campo_join]) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP" || strtoupper($condicao) == "DF"))
      {
          if (strtoupper($condicao) == "DF")
          {
              $condicao = "NP";
          }
      }
         $comando .= (!empty($comando) ? " or " : "");
         if (is_array($campo))
         {
             $prep = "";
             foreach ($campo as $Ind => $Cmp)
             {
                 $prep .= (!empty($prep)) ? "," : "";
                 $Cmp   = substr($this->Db->qstr($Cmp), 1, -1);
                 $prep .= $nm_ini_lower . $nm_aspas . $Cmp . $nm_aspas1 . $nm_fim_lower;
             }
             $prep .= (empty($prep)) ? $nm_aspas . $nm_aspas1 : "";
             $comando .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $prep . ")";
             return;
         }
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $cond_tst = strtoupper($condicao);
         if ($cond_tst == "II" || $cond_tst == "QP" || $cond_tst == "NP")
         {
             $op_like = " like ";
         }
         switch ($cond_tst)
         {
            case "EQ":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "II":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
            break;
            case "QP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
            break;
            case "NP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . " not" . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
            break;
            case "DF":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " > " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " >= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " < " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
         }
   }
   function SC_lookup_id_proyecto($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT nombre_proyecto, id FROM proyectos WHERE (#cmp_inombre_proyecto#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (id=" . $_SESSION['id_proyecto'] . ")" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "LIKE '#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "NOT LIKE '%#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", ">= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "< '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           while (!$rx->EOF) 
           { 
               $chave = $rx->fields[1];
               $label = $rx->fields[0];
               if ($condicao == "eq" && $campo == $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
               {
                   $result[] = $chave;
               }
               if ($condicao == "qp" && strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "np" && !strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "df" && $campo != $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "gt" && $label > $campo )
               {
                   $result[] = $chave;
               }
               if ($condicao == "ge" && $label >= $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "lt" && $label < $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "le" && $label <= $campo)
               {
                   $result[] = $chave;
               }
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
   function SC_lookup_id_item($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT item, id_item FROM prod_items_base WHERE (#cmp_iitem#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "LIKE '#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "NOT LIKE '%#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", ">= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "< '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           while (!$rx->EOF) 
           { 
               $chave = $rx->fields[1];
               $label = $rx->fields[0];
               if ($condicao == "eq" && $campo == $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
               {
                   $result[] = $chave;
               }
               if ($condicao == "qp" && strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "np" && !strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "df" && $campo != $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "gt" && $label > $campo )
               {
                   $result[] = $chave;
               }
               if ($condicao == "ge" && $label >= $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "lt" && $label < $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "le" && $label <= $campo)
               {
                   $result[] = $chave;
               }
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
function nmgp_redireciona($tipo=0)
{
   global $nm_apl_dependente;
   if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $_SESSION['scriptcase']['sc_tp_saida'] != "D" && $nm_apl_dependente != 1) 
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['nm_sc_retorno'];
   }
   else
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page];
   }
   if ($tipo == 2)
   {
       $nmgp_saida_form = "form_prod_presupuesto_periodo_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_prod_presupuesto_periodo_fim.php";
   }
   $diretorio = explode("/", $nmgp_saida_form);
   $cont = count($diretorio);
   $apl = $diretorio[$cont - 1];
   $apl = str_replace(".php", "", $apl);
   $pos = strpos($apl, "?");
   if ($pos !== false)
   {
       $apl = substr($apl, 0, $pos);
   }
   if ($tipo != 1 && $tipo != 2)
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page][$apl]['where_orig']);
   }
   if ($this->NM_ajax_flag)
   {
       $sTarget = '_self';
       $this->NM_ajax_info['redir']['metodo']              = 'post';
       $this->NM_ajax_info['redir']['action']              = $nmgp_saida_form;
       $this->NM_ajax_info['redir']['target']              = $sTarget;
       $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       if (0 == $tipo)
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida'] = $this->nm_location;
       }
       form_prod_presupuesto_periodo_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
   {
?>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
   }

?>
    <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
    <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
    <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
    <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
    <META http-equiv="Pragma" content="no-cache"/>
    <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
   </HEAD>
   <BODY>
   <FORM name="form_ok" method="POST" action="<?php echo $this->form_encode_input($nmgp_saida_form); ?>" target="_self">
<?php
   if ($tipo == 0)
   {
?>
     <INPUT type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($this->nm_location); ?>"> 
<?php
   }
?>
     <INPUT type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
   </FORM>
   <SCRIPT type="text/javascript">
      bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
      function scLigEditLookupCall()
      {
<?php
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_modal'])
   {
?>
        parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
   elseif ($this->lig_edit_lookup)
   {
?>
        opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
?>
      }
      if (bLigEditLookupCall)
      {
        scLigEditLookupCall();
      }
<?php
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue']);
?>
}
<?php
    }
}
?>
      document.form_ok.submit();
   </SCRIPT>
   </BODY>
   </HTML>
<?php
  exit;
}
function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $opc="", $alt_modal=430, $larg_modal=630)
{
   if (isset($this->NM_is_redirected) && $this->NM_is_redirected)
   {
       return;
   }
   if (is_array($nm_apl_parms))
   {
       $tmp_parms = "";
       foreach ($nm_apl_parms as $par => $val)
       {
           $par = trim($par);
           $val = trim($val);
           $tmp_parms .= str_replace(".", "_", $par) . "?#?";
           if (substr($val, 0, 1) == "$")
           {
               $tmp_parms .= $$val;
           }
           elseif (substr($val, 0, 1) == "{")
           {
               $val        = substr($val, 1, -1);
               $tmp_parms .= $this->$val;
           }
           elseif (substr($val, 0, 1) == "[")
           {
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo'][substr($val, 1, -1)];
           }
           else
           {
               $tmp_parms .= $val;
           }
           $tmp_parms .= "?@?";
       }
       $nm_apl_parms = $tmp_parms;
   }
   if (empty($opc))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           form_prod_presupuesto_periodo_pack_ajax_response();
           exit;
       }
       echo "<SCRIPT language=\"javascript\">";
       if (strtolower($nm_target) == "_blank")
       {
           echo "window.open ('" . $nm_apl_dest . "');";
           echo "</SCRIPT>";
           return;
       }
       else
       {
           echo "window.location='" . $nm_apl_dest . "';";
           echo "</SCRIPT>";
           $this->NM_close_db();
           exit;
       }
   }
   $dir = explode("/", $nm_apl_dest);
   if (count($dir) == 1)
   {
       $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
       $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
   }
   if ($this->NM_ajax_flag)
   {
       $nm_apl_parms = str_replace("?#?", "*scin", NM_charset_to_utf8($nm_apl_parms));
       $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
       $this->NM_ajax_info['redir']['metodo']     = 'post';
       $this->NM_ajax_info['redir']['action']     = $nm_apl_dest;
       $this->NM_ajax_info['redir']['nmgp_parms'] = $nm_apl_parms;
       $this->NM_ajax_info['redir']['target']     = $nm_target_form;
       $this->NM_ajax_info['redir']['h_modal']    = $alt_modal;
       $this->NM_ajax_info['redir']['w_modal']    = $larg_modal;
       if ($nm_target_form == "_blank")
       {
           $this->NM_ajax_info['redir']['nmgp_outra_jan'] = 'true';
       }
       else
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida']      = $nm_apl_retorno;
           $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       }
       form_prod_presupuesto_periodo_pack_ajax_response();
       exit;
   }
   if ($nm_target == "modal")
   {
       if (!empty($nm_apl_parms))
       {
           $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
           $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
           $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
       }
       $par_modal = "?script_case_init=" . $this->Ini->sc_page . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
       $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') })";
       $this->NM_is_redirected = true;
       return;
   }
   if ($nm_target == "_blank")
   {
?>
<form name="Fredir" method="post" target="_blank" action="<?php echo $nm_apl_dest; ?>">
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
</form>
<script type="text/javascript">
setTimeout(function() { document.Fredir.submit(); }, 250);
</script>
<?php
    return;
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
   {
?>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
   }

?>
    <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
    <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
    <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
    <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
    <META http-equiv="Pragma" content="no-cache"/>
    <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
    <SCRIPT type="text/javascript" src="../_lib/lib/js/jquery-3.6.0.min.js"></SCRIPT>
   </HEAD>
   <BODY>
<?php
   }
?>
<form name="Fredir" method="post" 
                  target="_self"> 
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
<?php
   if ($nm_target_form == "_blank")
   {
?>
  <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
  <input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nm_apl_retorno) ?>">
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
<?php
   }
?>
</form> 
   <SCRIPT type="text/javascript">
<?php
   if ($nm_target_form == "modal")
   {
?>
       $(document).ready(function(){
           tb_show('', '<?php echo $nm_apl_dest ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo $this->form_encode_input($nm_apl_parms); ?>&nmgp_outra_jan=true&TB_iframe=true&height=<?php echo $alt_modal; ?>&width=<?php echo $larg_modal; ?>&modal=true', '');
       });
<?php
   }
   else
   {
?>
    $(function() {
       document.Fredir.target = "<?php echo $nm_target_form ?>"; 
       document.Fredir.action = "<?php echo $nm_apl_dest ?>";
       document.Fredir.submit();
    });
<?php
   }
?>
   </SCRIPT>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
   </BODY>
   </HTML>
<?php
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
       $this->NM_close_db();
       exit;
   }
}
    function sc_ajax_alert($sMessage, $params = array())
    {
        if ($this->NM_ajax_flag)
        {
            $this->NM_ajax_info['ajaxAlert']['message'] = NM_charset_to_utf8($sMessage);
            $this->NM_ajax_info['ajaxAlert']['params']  = $this->sc_ajax_alert_params($params);
        }
    } // sc_ajax_alert

    function sc_ajax_alert_params($params)
    {
        $paramList = array();
        foreach ($params as $paramName => $paramValue)
        {
            if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding', 'position')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('background' == $paramName)
            {
                $paramList[$paramName] = $this->sc_ajax_alert_image(NM_charset_to_utf8($paramValue));
            }
        }
        return $paramList;
    } // sc_ajax_alert_params

    function sc_ajax_alert_image($background)
    {
        $image_param = $background;
        preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $background, $matches, PREG_PATTERN_ORDER);
        if (isset($matches[3])) {
            foreach ($matches[3] as $match) {
                if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                    $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                }
            }
        }
        return $image_param;
    } // sc_ajax_alert_image
    function sc_field_readonly($sField, $sStatus, $iSeq = '')
    {
        if ('on' != $sStatus && 'off' != $sStatus)
        {
            return;
        }

        $sFieldDateTime = '';

        $sFlagVar        = 'bFlagRead_' . $sField;
        $this->$sFlagVar = 'on' == $sStatus;

        $this->nmgp_cmp_readonly[$sField]                = $sStatus;
        $this->NM_ajax_info['readOnly'][$sField . $iSeq] = $sStatus;
        if ('' != $sFieldDateTime)
        {
            $this->NM_ajax_info['readOnly'][$sFieldDateTime . $iSeq] = $sStatus;
        }
    } // sc_field_readonly
    function getButtonIds($buttonName) {
        switch ($buttonName) {
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " Partida De Producción Ejecutada"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Partida De Producción"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"></div>
</div>
    </td></tr>
<?php
    }

    function displayAppFooter()
    {
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R") {
        } else {
            return false;
        }
        return true;
    } // displayAppToolbars

    function displayTopToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayTopToolbar

    function displayBottomToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayBottomToolbar

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['ordem_ord'] == " desc") {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_desc;
                $orderColRule = $sortRule = 'desc';
            } else {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_asc;
                $orderColRule = $sortRule = 'asc';
            }
        }
        return $sortRule;
    }

    function scGetColumnOrderIcon($fieldName, $sortRule)
    {        if ('desc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } elseif ('asc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } elseif ('' != $this->Ini->Label_sort) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } else {
            return '';
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
            case "id":
                return true;
            case "":
                return true;
            case "dias_desde":
                return true;
            case "dias_hasta":
                return true;
            case "dias_periodo":
                return true;
            case "avance_informado_con_iva":
                return true;
            case "produccion_neto":
                return true;
            case "retencion":
                return true;
            case "retencion_con_iva":
                return true;
            case "":
                return true;
            case "reajuste_acumulado_con_iva":
                return true;
            case "reajuste_acumulado_neto":
                return true;
            case "multa":
                return true;
            case "total_facturado":
                return true;
            case "":
                return true;
            case "monto_uf":
                return true;
            case "valor_uf":
                return true;
            case "vigente":
                return true;
            case "orden":
                return true;
            case "avance":
                return true;
            case "reajuste":
                return true;
            case "factor_produccion":
                return true;
            case "avance_periodo":
                return true;
            case "avance_periodo_siguiente":
                return true;
            case "avance_informado":
                return true;
            case "avance_periodo_anterior":
                return true;
            case "produccion_total_final":
                return true;
            case "total_facturado_ur":
                return true;
            case "produccion_ep":
                return true;
            case "reajuste_con_iva":
                return true;
            case "":
                return true;
            case "":
                return true;
            case "":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "id":
                return 'desc';
            case "id_proyecto":
                return 'desc';
            case "tipo_moneda":
                return 'desc';
            case "id_partida":
                return 'desc';
            case "fecha_desde":
                return 'desc';
            case "fecha_hasta":
                return 'desc';
            case "dias_desde":
                return 'desc';
            case "dias_hasta":
                return 'desc';
            case "dias_periodo":
                return 'desc';
            case "fecha_desde_factura":
                return 'desc';
            case "fecha_hasta_factura":
                return 'desc';
            case "avance_informado_con_iva":
                return 'desc';
            case "produccion_neto":
                return 'desc';
            case "retencion":
                return 'desc';
            case "retencion_con_iva":
                return 'desc';
            case "reajuste_acumulado_con_iva":
                return 'desc';
            case "reajuste_acumulado_neto":
                return 'desc';
            case "multa":
                return 'desc';
            case "total_facturado":
                return 'desc';
            case "considera_retencion":
                return 'desc';
            case "facturado":
                return 'desc';
            case "monto_uf":
                return 'desc';
            case "fecha":
                return 'desc';
            case "valor_uf":
                return 'desc';
            case "id_item":
                return 'desc';
            case "vigente":
                return 'desc';
            case "orden":
                return 'desc';
            case "avance":
                return 'desc';
            case "reajuste":
                return 'desc';
            case "factor_produccion":
                return 'desc';
            case "avance_periodo":
                return 'desc';
            case "avance_periodo_siguiente":
                return 'desc';
            case "avance_informado":
                return 'desc';
            case "avance_periodo_anterior":
                return 'desc';
            case "produccion_total_final":
                return 'desc';
            case "total_facturado_ur":
                return 'desc';
            case "produccion_ep":
                return 'desc';
            case "reajuste_con_iva":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }
}
?>
