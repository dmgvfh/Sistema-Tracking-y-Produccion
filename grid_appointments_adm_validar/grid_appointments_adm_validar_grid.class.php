<?php
class grid_appointments_adm_validar_grid
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Tot;
   var $Lin_impressas;
   var $Lin_final;
   var $Rows_span;
   var $NM_colspan;
   var $rs_grid;
   var $nm_grid_ini;
   var $nm_grid_sem_reg;
   var $nm_prim_linha;
   var $Rec_ini;
   var $Rec_fim;
   var $nmgp_reg_start;
   var $nmgp_reg_inicial;
   var $nmgp_reg_final;
   var $SC_seq_register;
   var $SC_seq_page;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $NM_raiz_img; 
   var $NM_opcao; 
   var $NM_flag_antigo; 
   var $nm_campos_cab = array();
   var $NM_cmp_hidden   = array();
   var $nmgp_botoes     = array();
   var $nm_btn_exist    = array();
   var $nm_btn_label    = array(); 
   var $nm_btn_disabled = array();
   var $Cmps_ord_def    = array();
   var $nmgp_label_quebras = array();
   var $nmgp_prim_pag_pdf;
   var $Campos_Mens_erro;
   var $Print_All;
   var $NM_field_over;
   var $NM_field_click;
   var $NM_bg_tot;
   var $NM_bg_sub_tot;
   var $NM_btn_run_show; 
   var $SC_seq_btn_run;
   var $progress_fp;
   var $progress_tot;
   var $progress_now;
   var $progress_lim_tot;
   var $progress_lim_now;
   var $progress_lim_qtd;
   var $progress_grid;
   var $progress_pdf;
   var $progress_res;
   var $progress_graf;
   var $count_ger;
   var $sum_intervalo;
   var $appointment_start_date_Old;
   var $arg_sum_appointment_start_date;
   var $Label_appointment_start_date;
   var $sc_proc_quebra_appointment_start_date;
   var $count_appointment_start_date;
   var $sum_appointment_start_date_intervalo;
   var $id_usuario_Old;
   var $arg_sum_id_usuario;
   var $Label_id_usuario;
   var $sc_proc_quebra_id_usuario;
   var $count_id_usuario;
   var $sum_id_usuario_intervalo;
   var $current_status_id_Old;
   var $arg_sum_current_status_id;
   var $Label_current_status_id;
   var $sc_proc_quebra_current_status_id;
   var $count_current_status_id;
   var $sum_current_status_id_intervalo;
   var $id_proyecto_Old;
   var $arg_sum_id_proyecto;
   var $Label_id_proyecto;
   var $sc_proc_quebra_id_proyecto;
   var $count_id_proyecto;
   var $sum_id_proyecto_intervalo;
   var $id_actividad_Old;
   var $arg_sum_id_actividad;
   var $Label_id_actividad;
   var $sc_proc_quebra_id_actividad;
   var $count_id_actividad;
   var $sum_id_actividad_intervalo;
   var $accion_revertir;
   var $accion_aprobar;
   var $accion_rechazar;
   var $id_proyecto;
   var $id_usuario;
   var $id_actividad;
   var $nombre;
   var $current_status_id;
   var $appointment_start_date;
   var $appointment_start_time;
   var $appointment_end_time;
   var $intervalo;
   var $appointments_id;
   var $grid_appointments_history;
   var $NM_cont_emb_linha;

function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

//--- 
 function monta_grid($linhas = 0)
 {
   global $script_case_init, $nm_saida;
   $GLOBALS["script_case_init"] = $this->Ini->sc_page;

   clearstatcache();
   $this->NM_cor_embutida();
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['grid_pesq'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['grid_pesq'] = array();
   }
   $this->seq_iframe_emb = 0;
   if (!is_file($this->Ini->link_grid_appointments_history_cons_emb))
   {
       $this->NM_cmp_hidden['hisoria'] = "off";
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = true;
       $_SESSION['scriptcase']['grid_appointments_history']['protect_modal'] = $this->Ini->sc_page;
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['exibe_titulos'] = "S";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['exibe_total'] = "S";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['exibe_seq'] = "S";
       include_once ($this->Ini->link_grid_appointments_history_cons_emb);
       $this->grid_appointments_history = new grid_appointments_history_apl ;
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = false;
       unset($_SESSION['scriptcase']['grid_appointments_history']['protect_modal']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       $this->nm_fim_grid();
   } 
   else 
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
       { 
           include_once($this->Ini->path_embutida . "grid_appointments_adm_validar/" . $this->Ini->Apl_resumo); 
       } 
       else 
       { 
           include_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
       } 
       $this->Res         = new grid_appointments_adm_validar_resumo();
       $this->Res->Db     = $this->Db;
       $this->Res->Erro   = $this->Erro;
       $this->Res->Ini    = $this->Ini;
       $this->Res->Lookup = $this->Lookup;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pdf_res'])
       {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert'])
            {
            } 
            else
            {
                $this->cabecalho();
            } 
       } 
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert'])
            {
            } 
            else
            {
       $nm_saida->saida("                  <TR>\r\n");
       $nm_saida->saida("                  <TD id='sc_grid_content' style='padding: 0px;' colspan=3>\r\n");
            } 
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       if (!$this->Proc_link_res && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print')
       { 
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("      <TD id=\"div_refin_search\" class=\"scGridRefinedSearchPadding\" valign='top'>\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $this->html_interativ_search();
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['refresh_interativ']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['refresh_interativ'] == "S") {
                   $this->Ini->Arr_result['setValue'][] = array('field' => 'div_refin_search', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               }
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['refresh_interativ']);
               $tb_disp = (!empty($this->nm_grid_sem_reg) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_int_search']) ? 'none' : '';
               $this->Ini->Arr_result['setDisplay'][] = array('field' => 'TB_Interativ_Search', 'value' => $tb_disp);
           } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_int_search'] = false;
       $nm_saida->saida("      </TD>\r\n");
       $nm_saida->saida("      <TD class=\"scGridRefinedSearchMolduraResult\" valign='top'>\r\n");
       $nm_saida->saida("       <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       } 
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_appointments_adm_validar'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
       } 
       if (!$this->Proc_link_res && $nmgrp_apl_opcao != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print')
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_refresh'] = array();
           $this->html_dynamic_search();
       } 
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['save_grid']))
       {
           $this->refresh_interativ_search();
       }
       unset ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['save_grid']);
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pdf_res'] && (!isset($_GET['flash_graf']) || 'chart' != $_GET['flash_graf']))
       {
           $this->grid();
       }
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_bot();
       } 
       if (!$this->Proc_link_res && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print')
       { 
       $nm_saida->saida("       </table>\r\n");
       $nm_saida->saida("      </TD>\r\n");
       $nm_saida->saida("     </TR>\r\n");
       } 
       $nm_saida->saida("   </table>\r\n");
       $nm_saida->saida("  </TD>\r\n");
       $nm_saida->saida(" </TR>\r\n");
       if (strpos(" " . $this->Ini->SC_module_export, "resume") !== false)
       { 
           $Gera_res = true;
       } 
       else 
       { 
           $Gera_res = false;
       } 
       if (strpos(" " . $this->Ini->SC_module_export, "chart") !== false)
       { 
           $Gera_graf = true;
       } 
       else 
       { 
           $Gera_graf = false;
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['print_all'] && empty($this->nm_grid_sem_reg) && ($Gera_res || $Gera_graf))
       { 
           $this->Res->monta_html_ini_pdf();
           $this->Res->monta_resumo();
           $this->Res->monta_html_fim_pdf();
           if ($Gera_graf)
           {
               $this->grafico_pdf();
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf")
       { 
           if (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
           {
               $this->Res->monta_resumo(true);
               require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
               $this->Graf  = new grid_appointments_adm_validar_grafico();
               $this->Graf->Db     = $this->Db;
               $this->Graf->Erro   = $this->Erro;
               $this->Graf->Ini    = $this->Ini;
               $this->Graf->Lookup = $this->Lookup;
               $this->Graf->monta_grafico();
               exit;
           }
           elseif ($Gera_res || $Gera_graf)
           {
               $this->Res->monta_html_ini_pdf();
               $this->Res->monta_resumo();
               $this->Res->monta_html_fim_pdf();
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['graf_pdf'] == "S")
       { 
           if (isset($_GET['flash_graf']) && 'pdf' == $_GET['flash_graf'] && $Gera_graf)
           {
               $this->grafico_pdf_flash();
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "grid";
           } 
           elseif (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && $Gera_graf)
           { 
               $this->grafico_pdf();
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "grid";
           } 
           else 
           { 
               $this->nm_fim_grid();
           } 
       } 
       else 
       { 
           $flag_apaga_pdf_log = TRUE;
           if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf")
           { 
               $flag_apaga_pdf_log = FALSE;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "igual";
           } 
           $this->nm_fim_grid($flag_apaga_pdf_log);
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'];
 }
 function resume($linhas = 0)
 {
    $this->Lin_impressas = 0;
    $this->Lin_final     = FALSE;
    $this->grid($linhas);
 }
//--- 
 function inicializa()
 {
   global $nm_saida, $NM_run_iframe,
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det,
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['orig_pesq'] = "grid";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Ind_lig_mult'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Ind_lig_mult'] = 0;
   }
   $this->Img_embbed      = false;
   $this->nm_data         = new nm_data("es");
   $this->pdf_label_group = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_pdf']['label_group'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_pdf']['label_group'] : "S";
   $this->pdf_all_cab     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_pdf']['all_cab']))     ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_pdf']['all_cab'] : "N";
   $this->pdf_all_label   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_pdf']['all_label']))   ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_pdf']['all_label'] : "N";
   $this->Fix_bar_top     = false;
   $this->Fix_bar_bottom  = false;
   $this->Grid_body       = 'id="sc_grid_body"';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   {
       $this->Grid_body = "";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['fix_top'])) {
       $this->Fix_bar_top = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['fix_top'] == "S") ? true : false;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['fix_bot'])) {
       $this->Fix_bar_bottom = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['fix_bot'] == "S") ? true : false;
   }
   $this->Css_Cmp = array();
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = explode(",", trim(substr($cada_css, 1, $Pos1 - 1)));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word'])
       { 
           $this->Css_Cmp[$Tag[0]] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag[0]] = "";
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_add']))
   {
       $NM_func_dyn_add = "dynamic_search_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_add']['cmp'];
       $Lin_dyn_add = $this->$NM_func_dyn_add($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_add']['seq'], 'S');
       $this->Arr_result = array();
       $Temp = ob_get_clean();
       if ($Temp !== false && trim($Temp) != "")
       {
           $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
       }
       $this->Arr_result['dyn_add'][] = NM_charset_to_utf8($Lin_dyn_add);
       $oJson = new Services_JSON();
       echo $oJson->encode($this->Arr_result);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_add']);
       exit;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_aut_comp']))
   {
       $NM_func_aut_comp = "lookup_ajax_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_aut_comp']['cmp'];
       $parm = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
       $nmgp_def_dados = $this->$NM_func_aut_comp($parm);
       ob_end_clean();
       $count_aut_comp = 0;
       $resp_aut_comp  = array();
       foreach ($nmgp_def_dados as $Ind => $Lista)
       {
          if (is_array($Lista))
          {
              foreach ($Lista as $Cod => $Valor)
              {
                  if ($_GET['cod_desc'] == "S")
                  {
                      $Valor = $Cod . " - " . $Valor;
                  }
                  $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                  $count_aut_comp++;
              }
          }
          if ($count_aut_comp == $_GET['max_itens'])
          {
              break;
          }
       }
       $oJson = new Services_JSON();
       echo $oJson->encode($resp_aut_comp);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_aut_comp']);
       exit;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] || $this->Ini->Embutida_iframe)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Lig_Md5'] = array();
   }
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['force_toolbar']);
   } 
       $this->Tem_tab_vert = false;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by")
   {
       if (count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']) > 1)
       {
           $this->width_tabula_quebra  = (((count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']) - 1) * 13) + 3) . "px";
           $this->width_tabula_display = "''";
           $this->Tem_tab_vert = true;
       }
       else
       {
           $this->width_tabula_quebra  = "0px";
           $this->width_tabula_display = "none";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status")
   {
       $this->width_tabula_quebra  = "3px";
       $this->width_tabula_display = "none";
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit'] != '')
   {
       if ($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit'] == "on")  {$_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit'] = "S";}
       if ($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit'] == "off") {$_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit'] = "N";}
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['psq_edit'] == 'N'))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['mostra_edit'] = "N";
   }
   $this->NM_cont_emb_linha = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['emb_linha'];
   $this->sc_proc_quebra_appointment_start_date = false;
   $this->sc_proc_quebra_id_usuario = false;
   $this->sc_proc_quebra_current_status_id = false;
   $this->sc_proc_quebra_id_proyecto = false;
   $this->sc_proc_quebra_id_actividad = false;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("grid_appointments_adm_validar", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_2'] = "on";
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_2'] = "on";
   $this->nmgp_botoes['exit'] = "on";
   $this->nmgp_botoes['first'] = "on";
   $this->nmgp_botoes['back'] = "on";
   $this->nmgp_botoes['forward'] = "on";
   $this->nmgp_botoes['last'] = "on";
   $this->nmgp_botoes['filter'] = "on";
   $this->nmgp_botoes['pdf'] = "on";
   $this->nmgp_botoes['xls'] = "on";
   $this->nmgp_botoes['xml'] = "on";
   $this->nmgp_botoes['csv'] = "on";
   $this->nmgp_botoes['rtf'] = "on";
   $this->nmgp_botoes['word'] = "on";
   $this->nmgp_botoes['doc'] = "on";
   $this->nmgp_botoes['export'] = "on";
   $this->nmgp_botoes['print'] = "on";
   $this->nmgp_botoes['html'] = "on";
   $this->nmgp_botoes['qtline'] = "on";
   $this->nmgp_botoes['rows'] = "on";
   $this->nmgp_botoes['summary'] = "on";
   $this->nmgp_botoes['sel_col'] = "on";
   $this->nmgp_botoes['sort_col'] = "on";
   $this->nmgp_botoes['qsearch'] = "on";
   $this->nmgp_botoes['gantt'] = "on";
   $this->nmgp_botoes['groupby'] = "on";
   $this->nmgp_botoes['dynsearch'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->nmgp_botoes['APROBAR'] = "on";
   $this->nmgp_botoes['RECHAZAR'] = "on";
   $this->Cmps_ord_def['id_proyecto'] = " desc";
   $this->Cmps_ord_def['id_usuario'] = " desc";
   $this->Cmps_ord_def['id_actividad'] = " desc";
   $this->Cmps_ord_def['nombre'] = " asc";
   $this->Cmps_ord_def['intervalo'] = " desc";
   $this->Cmps_ord_def['appointments_id'] = " desc";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->Proc_link_res = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'])) 
   { 
       $this->Proc_link_res            = true;
       $this->nmgp_botoes['filter']    = 'off';
       $this->nmgp_botoes['groupby']   = 'off';
       $this->nmgp_botoes['dynsearch'] = 'off';
       $this->nmgp_botoes['qsearch']   = 'off';
       $this->nmgp_botoes['gridsave']  = 'off';
       $this->nmgp_botoes['exit']      = 'off';
   } 
   $this->sc_proc_grid = false; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word'] || $this->Ini->sc_export_ajax_img)
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->current_status_id = (isset($Busca_temp['current_status_id'])) ? $Busca_temp['current_status_id'] : ""; 
       $tmp_pos = (is_string($this->current_status_id)) ? strpos($this->current_status_id, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->current_status_id))
       {
           $this->current_status_id = substr($this->current_status_id, 0, $tmp_pos);
       }
       $this->appointment_start_date = (isset($Busca_temp['appointment_start_date'])) ? $Busca_temp['appointment_start_date'] : ""; 
       $tmp_pos = (is_string($this->appointment_start_date)) ? strpos($this->appointment_start_date, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->appointment_start_date))
       {
           $this->appointment_start_date = substr($this->appointment_start_date, 0, $tmp_pos);
       }
       $appointment_start_date_2 = (isset($Busca_temp['appointment_start_date_input_2'])) ? $Busca_temp['appointment_start_date_input_2'] : ""; 
       $this->appointment_start_date_2 = $appointment_start_date_2; 
   } 
   else 
   { 
       $this->appointment_start_date_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "muda_qt_linhas";
   } 
   $this->New_label['current_status_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . "";
   $this->New_label['appointment_start_date'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . "";
   $this->New_label['appointments_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointments_id'] . "";
   $this->New_label['appointment_end_date'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_end_date'] . "";
   $this->New_label['appointment_recurrent'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_recurrent'] . "";
   $this->New_label['appointment_period'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_period'] . "";
       ob_start(); 
   $_SESSION['scriptcase']['grid_appointments_adm_validar']['contr_erro'] = 'on';
if (!isset($_SESSION['i'])) {$_SESSION['i'] = "";}
if (!isset($this->sc_temp_i)) {$this->sc_temp_i = (isset($_SESSION['i'])) ? $_SESSION['i'] : "";}
if (!isset($_SESSION['total_chked'])) {$_SESSION['total_chked'] = "";}
if (!isset($this->sc_temp_total_chked)) {$this->sc_temp_total_chked = (isset($_SESSION['total_chked'])) ? $_SESSION['total_chked'] : "";}
 
$this->sc_temp_i = 0;
$this->sc_temp_total_chked = array();



if (isset($this->sc_temp_total_chked)) {$_SESSION['total_chked'] = $this->sc_temp_total_chked;}
if (isset($this->sc_temp_i)) {$_SESSION['i'] = $this->sc_temp_i;}
$_SESSION['scriptcase']['grid_appointments_adm_validar']['contr_erro'] = 'off'; 
       $this->SC_Buf_onInit = ob_get_clean();; 

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_appointments_adm_validar'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_appointments_adm_validar'];

           $this->nmgp_botoes['first']     = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['back']      = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['last']      = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['forward']   = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['summary']   = $tmpDashboardButtons['grid_summary']   ? 'on' : 'off';
           $this->nmgp_botoes['qsearch']   = $tmpDashboardButtons['grid_qsearch']   ? 'on' : 'off';
           $this->nmgp_botoes['dynsearch'] = $tmpDashboardButtons['grid_dynsearch'] ? 'on' : 'off';
           $this->nmgp_botoes['filter']    = $tmpDashboardButtons['grid_filter']    ? 'on' : 'off';
           $this->nmgp_botoes['sel_col']   = $tmpDashboardButtons['grid_sel_col']   ? 'on' : 'off';
           $this->nmgp_botoes['sort_col']  = $tmpDashboardButtons['grid_sort_col']  ? 'on' : 'off';
           $this->nmgp_botoes['goto']      = $tmpDashboardButtons['grid_goto']      ? 'on' : 'off';
           $this->nmgp_botoes['qtline']    = $tmpDashboardButtons['grid_lineqty']   ? 'on' : 'off';
           $this->nmgp_botoes['navpage']   = $tmpDashboardButtons['grid_navpage']   ? 'on' : 'off';
           $this->nmgp_botoes['pdf']       = $tmpDashboardButtons['grid_pdf']       ? 'on' : 'off';
           $this->nmgp_botoes['xls']       = $tmpDashboardButtons['grid_xls']       ? 'on' : 'off';
           $this->nmgp_botoes['xml']       = $tmpDashboardButtons['grid_xml']       ? 'on' : 'off';
           $this->nmgp_botoes['json']      = $tmpDashboardButtons['grid_json']      ? 'on' : 'off';
           $this->nmgp_botoes['csv']       = $tmpDashboardButtons['grid_csv']       ? 'on' : 'off';
           $this->nmgp_botoes['rtf']       = $tmpDashboardButtons['grid_rtf']       ? 'on' : 'off';
           $this->nmgp_botoes['word']      = $tmpDashboardButtons['grid_word']      ? 'on' : 'off';
           $this->nmgp_botoes['doc']       = $tmpDashboardButtons['grid_doc']       ? 'on' : 'off';
           $this->nmgp_botoes['print']     = $tmpDashboardButtons['grid_print']     ? 'on' : 'off';
           $this->nmgp_botoes['new']       = $tmpDashboardButtons['grid_new']       ? 'on' : 'off';
           $this->nmgp_botoes['img']       = $tmpDashboardButtons['img']            ? 'on' : 'off';
           $this->nmgp_botoes['html']      = $tmpDashboardButtons['html']           ? 'on' : 'off';
           $this->nmgp_botoes['reload']    = $tmpDashboardButtons['grid_reload']    ? 'on' : 'off';
           if (isset($tmpDashboardButtons['grid_rows'])) {$this->nmgp_botoes['rows'] = $tmpDashboardButtons['grid_rows'] ? 'on' : 'off';}
       }
   }

   if ($this->Ini->Embutida_iframe) {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sub_cons_iframe_btns'] as $BTN => $BTN_opc) {
           $this->nmgp_botoes[$BTN] = $BTN_opc;
       }
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_sql_btn_run'] = array(); 
   $this->NM_btn_run_show = ($this->Ini->SC_Link_View || $this->grid_emb_form || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida']) ? false : true;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq']) 
   { 
      $this->nmgp_botoes['APROBAR'] = "off";
      $this->nmgp_botoes['RECHAZAR'] = "off";
   } 
   if ($this->nmgp_botoes['APROBAR'] != "on" && $this->nmgp_botoes['RECHAZAR'] != "on") 
   { 
      $this->NM_btn_run_show = false;
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf") 
   { 
      $this->NM_btn_run_show = false;
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "grid_appointments_adm_validar/grid_appointments_adm_validar_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "grid_appointments_adm_validar_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] != "pdf")  
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
       } 
       else 
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = "pdf";
       } 
   } 
   else 
   { 
       $this->nm_location = $_SESSION['scriptcase']['contr_link_emb'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new grid_appointments_adm_validar_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_lin_grid'] = 10;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['rows'];  
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']['appointment_start_date'] = 'asc'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']['appointment_start_time'] = 'asc'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']['appointments.id_actividad'] = 'ASC'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']['appointment_start_date'] = 'asc'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']['appointment_start_time'] = 'asc'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']['appointments.id_actividad'] = 'ASC'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_quebra'] = array(); 
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_sql'] as $cmp_var => $resto)
           {
               foreach ($resto as $SC_Sql_col => $SC_Sql_order)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_quebra'][$cmp_var][$SC_Sql_col] = $SC_Sql_order;
               }
           }
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_quebra'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_quebra']['current_status_id']["current_status_id"] = "asc"; 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       $Ordem_tem_quebra = true;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_orig'] = " where (appointments.id_usuario=" . $_SESSION['id_usuario'] . " and   appointments.`appointment_start_date` BETWEEN '" . $_SESSION['fecha'] . "' AND '" . $_SESSION['fecha2'] . "')";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao']       = "igual" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['opcao_print'] = "print" ; 
       if ($this->Ini->sc_export_ajax) 
       { 
           $this->Img_embbed = true;
       } 
   } 
// 
   $this->count_ger = 0;
   $this->sum_intervalo = 0;
   $this->arg_sum_appointment_start_date = "";
   $this->count_appointment_start_date = 0;
   $this->sum_appointment_start_date_intervalo = 0;
   $this->arg_sum_id_usuario = "";
   $this->count_id_usuario = 0;
   $this->sum_id_usuario_intervalo = 0;
   $this->arg_sum_current_status_id = "";
   $this->count_current_status_id = 0;
   $this->sum_current_status_id_intervalo = 0;
   $this->arg_sum_id_proyecto = "";
   $this->count_id_proyecto = 0;
   $this->sum_id_proyecto_intervalo = 0;
   $this->arg_sum_id_actividad = "";
   $this->count_id_actividad = 0;
   $this->sum_id_actividad_intervalo = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][1] ;  
   }
   $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'];
   $this->Tot->$Gb_geral();
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][1];
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_total']);
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['contr_array_resumo']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['contr_array_resumo'] = "NAO";
       } 
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][1];
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by")
       {
       $this->sum_intervalo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][2];
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status")
       {
       $this->sum_intervalo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][2];
       }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'])) 
   { 
       $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
       $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq']; 
       if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'])) 
       { 
           $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']; 
       } 
       else
       { 
           $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'] . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $rt_grid = $this->Db->Execute($nmgp_select) ; 
       if ($rt_grid === false && !$rt_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit ; 
       }  
       $this->count_ger = $rt_grid->fields[0];
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_total'] = $rt_grid->fields[0];  
       
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] = 0 ; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start--; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
   {
       $this->Ini->Qtd_reg_ajax_grid = $this->count_ger;
   }
   else
   {
       $this->Ini->Qtd_reg_ajax_grid = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid'];
   }
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT id_proyecto, id_usuario, id_actividad, nombre, current_status_id, appointment_start_date, appointment_start_time, appointment_end_time, intervalo, appointments_id from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT id_proyecto, id_usuario, id_actividad, nombre, current_status_id, appointment_start_date, appointment_start_time, appointment_end_time, intervalo, appointments_id from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq']; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'])) 
   { 
       if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'])) 
       { 
           $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']; 
       } 
       else
       { 
           $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'] . ")"; 
       } 
   } 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_desc']; 
   } 
   elseif (!empty($campos_order_select)) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $campos_order_select; 
   } 
   elseif (!empty($campos_order)) 
   { 
       $nmgp_order_by = " order by " . $campos_order; 
   } 
   if (empty($nmgp_order_by))
   {
       $nmgp_order_by = " order by id_proyecto";
   }
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
   }  
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->force_toolbar = true;
       $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
   }  
   else 
   { 
       $this->id_proyecto = $this->rs_grid->fields[0] ;  
       $this->id_proyecto = (string)$this->id_proyecto;
       $this->id_usuario = $this->rs_grid->fields[1] ;  
       $this->id_usuario = (string)$this->id_usuario;
       $this->id_actividad = $this->rs_grid->fields[2] ;  
       $this->id_actividad = (string)$this->id_actividad;
       $this->nombre = $this->rs_grid->fields[3] ;  
       $this->current_status_id = $this->rs_grid->fields[4] ;  
       $this->current_status_id = (string)$this->current_status_id;
       $this->appointment_start_date = $this->rs_grid->fields[5] ;  
       $this->appointment_start_time = $this->rs_grid->fields[6] ;  
       $this->appointment_end_time = $this->rs_grid->fields[7] ;  
       $this->intervalo = $this->rs_grid->fields[8] ;  
       $this->intervalo = (string)$this->intervalo;
       $this->appointments_id = $this->rs_grid->fields[9] ;  
       $this->appointments_id = (string)$this->appointments_id;
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig']))
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'] as $Cmp_clone => $Cmp_orig)
           {
               $this->$Cmp_clone = $this->$Cmp_orig;
           }
       }
       if (!isset($this->appointment_start_date)) { $this->appointment_start_date = ""; }
       if (!isset($this->id_usuario)) { $this->id_usuario = ""; }
       if (!isset($this->current_status_id)) { $this->current_status_id = ""; }
       if (!isset($this->id_proyecto)) { $this->id_proyecto = ""; }
       if (!isset($this->id_actividad)) { $this->id_actividad = ""; }
       $GLOBALS["id_usuario"] = $this->rs_grid->fields[1] ;  
       $GLOBALS["id_usuario"] = (string)$GLOBALS["id_usuario"] ;
       $GLOBALS["id_actividad"] = $this->rs_grid->fields[2] ;  
       $GLOBALS["id_actividad"] = (string)$GLOBALS["id_actividad"] ;
       $GLOBALS["current_status_id"] = $this->rs_grid->fields[4] ;  
       $GLOBALS["current_status_id"] = (string)$GLOBALS["current_status_id"] ;
       $this->arg_sum_id_proyecto = ($this->id_proyecto == "") ? " is null " : " = " . $this->id_proyecto;
       $this->arg_sum_id_usuario = ($this->id_usuario == "") ? " is null " : " = " . $this->id_usuario;
       $this->arg_sum_id_actividad = ($this->id_actividad == "") ? " is null " : " = " . $this->id_actividad;
       $this->arg_sum_current_status_id = ($this->current_status_id == "") ? " is null " : " = " . $this->current_status_id;
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by")
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
           {
               $Cmp_orig = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp_gb])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp_gb] : $cmp_gb;
               if ($Cmp_orig == "appointment_start_date")
               {
                   $Str_arg_sum = "arg_sum_" . $cmp_gb;
                   $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp_gb);
                   $TP_Time = (in_array('appointment_start_date', $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
                   $this->$Str_arg_sum = $this->Ini->Get_date_arg_sum($TP_Time . $this->appointment_start_date, $Format_tst, "appointment_start_date");
               }
           }
       }
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $this->SC_sep_quebra = false;
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by") 
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $cmp => $sql)
           {
               $Cmp_orig   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp] : $cmp;
               $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
               $Cmp_Old    = $cmp . '_Old';
               $TP_Time = (in_array($Cmp_orig, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
               $this->$Cmp_Old = $this->Ini->Get_arg_groupby($TP_Time . $this->$Cmp_orig, $Format_tst); 
           }
           $sql_where = "";
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $cmp => $sql)
           {
               $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
               if (!empty($Format_tst))
               {
                   $tmp = $this->$cmp;
                   if (!empty($tmp))
                   {
                       $sql = $this->Ini->Get_sql_date_groupby($sql, $Format_tst);
                   }
               }
               $cmp_qb     = $this->$cmp;
               $tmp        = "arg_sum_" . $cmp;
               $sql_where .= (!empty($sql_where)) ? " and " : "";
               $sql_where .= $sql . $this->$tmp;
               $tmp        = "quebra_" . $cmp . "_sc_free_group_by";
               $this->$tmp($cmp_qb, $sql_where, $cmp);
           }
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status") 
       {
           $this->current_status_id_Old = $this->current_status_id ; 
           $this->quebra_current_status_id_status($this->current_status_id) ; 
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->id_proyecto = $this->rs_grid->fields[0] ;  
           $this->id_usuario = $this->rs_grid->fields[1] ;  
           $this->id_actividad = $this->rs_grid->fields[2] ;  
           $this->nombre = $this->rs_grid->fields[3] ;  
           $this->current_status_id = $this->rs_grid->fields[4] ;  
           $this->appointment_start_date = $this->rs_grid->fields[5] ;  
           $this->appointment_start_time = $this->rs_grid->fields[6] ;  
           $this->appointment_end_time = $this->rs_grid->fields[7] ;  
           $this->intervalo = $this->rs_grid->fields[8] ;  
           $this->appointments_id = $this->rs_grid->fields[9] ;  
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig']))
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'] as $Cmp_clone => $Cmp_orig)
               {
                   $this->$Cmp_clone = $this->$Cmp_orig;
               }
           }
           if (!isset($this->appointment_start_date)) { $this->appointment_start_date = ""; }
           if (!isset($this->id_usuario)) { $this->id_usuario = ""; }
           if (!isset($this->current_status_id)) { $this->current_status_id = ""; }
           if (!isset($this->id_proyecto)) { $this->id_proyecto = ""; }
           if (!isset($this->id_actividad)) { $this->id_actividad = ""; }
       } 
   } 
   $this->NM_hidden_filters = ($this->Ini->Embutida_iframe && !empty($this->nm_grid_sem_reg) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['initialize']) ? true : false;
   $this->nmgp_reg_inicial  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final'] + 1;
   $this->nmgp_reg_final    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid'];
   $this->nmgp_reg_final    = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
       if (!$this->Ini->sc_export_ajax && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Validación de Horas :: PDF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
           if ($_SESSION['scriptcase']['proc_mobile'])
           {
?>
                    <meta name="viewport" content="minimal-ui, width=300, initial-scale=1, maximum-scale=1, user-scalable=no">
                    <meta name="mobile-web-app-capable" content="yes">
                    <meta name="apple-mobile-web-app-capable" content="yes">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="apple-touch-icon"   sizes="57x57" href="">
                    <link rel="apple-touch-icon"   sizes="60x60" href="">
                    <link rel="apple-touch-icon"   sizes="72x72" href="">
                    <link rel="apple-touch-icon"   sizes="76x76" href="">
                    <link rel="apple-touch-icon" sizes="114x114" href="">
                    <link rel="apple-touch-icon" sizes="120x120" href="">
                    <link rel="apple-touch-icon" sizes="144x144" href="">
                    <link rel="apple-touch-icon" sizes="152x152" href="">
                    <link rel="apple-touch-icon" sizes="180x180" href="">
                    <link rel="icon" type="image/png" sizes="192x192" href="">
                    <link rel="icon" type="image/png"   sizes="32x32" href="">
                    <link rel="icon" type="image/png"   sizes="96x96" href="">
                    <link rel="icon" type="image/png"   sizes="16x16" href="">
                    <meta name="msapplication-TileColor" content="#3C4858">
                    <meta name="msapplication-TileImage" content="">
                    <meta name="theme-color" content="#3C4858">
                    <meta name="apple-mobile-web-app-status-bar-style" content="#3C4858">
                    <link rel="shortcut icon" href=""><?php
           }
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php 
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
 { 
 ?> 
 <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
 <?php 
 } 
 ?> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
 <SCRIPT LANGUAGE="Javascript" SRC="<?php echo $this->Ini->path_js; ?>/nm_gauge.js"></SCRIPT>
</HEAD>
<BODY scrolling="no">
<table class="scGridTabela" style="padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;"><tr class="scGridFieldOddVert"><td>
<?php echo $this->Ini->Nm_lang['lang_pdff_gnrt']; ?>...<br>
<?php
           $this->progress_grid    = $this->rs_grid->RecordCount();
           $this->progress_pdf     = 0;
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pivot_charts']) : 0;
           $this->progress_graf    = 0;
           $this->progress_tot     = 0;
           $this->progress_now     = 0;
           $this->progress_lim_tot = 0;
           $this->progress_lim_now = 0;
           if (-1 < $this->progress_grid)
           {
               $this->progress_lim_qtd = (250 < $this->progress_grid) ? 250 : $this->progress_grid;
               $this->progress_lim_tot = floor($this->progress_grid / $this->progress_lim_qtd);
               $this->progress_pdf     = floor($this->progress_grid * 0.25) + 1;
               $this->progress_tot     = $this->progress_grid + $this->progress_pdf + $this->progress_res + $this->progress_graf;
               $str_pbfile             = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
               $this->progress_fp      = fopen($str_pbfile, 'w');
               grid_appointments_adm_validar_pdf_progress_call("PDF\n", $this->Ini->Nm_lang);
               grid_appointments_adm_validar_pdf_progress_call($this->Ini->path_js   . "\n", $this->Ini->Nm_lang);
               grid_appointments_adm_validar_pdf_progress_call($this->Ini->path_prod . "/img/\n", $this->Ini->Nm_lang);
               grid_appointments_adm_validar_pdf_progress_call($this->progress_tot   . "\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "PDF\n");
               fwrite($this->progress_fp, $this->Ini->path_js   . "\n");
               fwrite($this->progress_fp, $this->Ini->path_prod . "/img/\n");
               fwrite($this->progress_fp, $this->progress_tot   . "\n");
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_strt'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               grid_appointments_adm_validar_pdf_progress_call($this->progress_tot . "_#NM#_" . "1_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "1_#NM#_" . $lang_protect . "...\n");
               flush();
           }
       }
       $nm_fundo_pagina = ""; 
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
       $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>Validación de Horas</TITLE>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
$nm_saida->saida("                        <meta name=\"viewport\" content=\"minimal-ui, width=300, initial-scale=1, maximum-scale=1, user-scalable=no\">\r\n");
$nm_saida->saida("                        <meta name=\"mobile-web-app-capable\" content=\"yes\">\r\n");
$nm_saida->saida("                        <meta name=\"apple-mobile-web-app-capable\" content=\"yes\">\r\n");
$nm_saida->saida("                        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"icon\" type=\"image/png\" sizes=\"192x192\"  href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"\">\r\n");
$nm_saida->saida("                        <meta name=\"msapplication-TileColor\" content=\"#3C4858\" >\r\n");
$nm_saida->saida("                        <meta name=\"msapplication-TileImage\" content=\"\">\r\n");
$nm_saida->saida("                        <meta name=\"theme-color\" content=\"#3C4858\">\r\n");
$nm_saida->saida("                        <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"#3C4858\">\r\n");
$nm_saida->saida("                        <link rel=\"shortcut icon\" href=\"\">\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate('D, d M Y H:i:s') . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $this->NM_opcao != "pdf") {
           $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'] && !$this->Ini->sc_export_ajax)
       { 
           $nm_saida->saida("   <form name=\"form_ajax_redir_1\" method=\"post\" style=\"display: none\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $nm_saida->saida("   <form name=\"form_ajax_redir_2\" method=\"post\" style=\"display: none\"> \r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_appointments_adm_validar_jquery-3.6.0.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_appointments_adm_validar_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_appointments_adm_validar_message.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery-3.6.0.min.js\"></script>\r\n");
           $nm_saida->saida("<script type=\"text/javascript\" src=\"../_lib/lib/js/frameControl.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("      if (!window.Promise)\r\n");
           $nm_saida->saida("      {\r\n");
           $nm_saida->saida("          var head = document.getElementsByTagName('head')[0];\r\n");
           $nm_saida->saida("          var js = document.createElement(\"script\");\r\n");
           $nm_saida->saida("          js.src = \"../_lib/lib/js/bluebird.min.js\";\r\n");
           $nm_saida->saida("          head.appendChild(js);\r\n");
           $nm_saida->saida("      }\r\n");
           $nm_saida->saida("      $(\"#TB_iframeContent\").ready(function(){\r\n");
           $nm_saida->saida("         jQuery(document).bind('keydown.thickbox', function(e) {\r\n");
           $nm_saida->saida("            var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("            if (keyPressed == 27) { \r\n");
           $nm_saida->saida("                tb_remove();\r\n");
           $nm_saida->saida("            }\r\n");
           $nm_saida->saida("         })\r\n");
           $nm_saida->saida("      })\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/dropdown_check_list/css/ui.dropdownchecklist.standalone.css\" type=\"text/css\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/dropdown_check_list/js/ui.dropdownchecklist.js\"></script>\r\n");
           $nm_saida->saida("        <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("          var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';\r\n");
           $nm_saida->saida("          var sc_tbLangClose = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("          var sc_tbLangEsc = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("        </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida("<style>\r\n");
           $nm_saida->saida(".scButton_default.sc-actb {\r\n");
           $nm_saida->saida("    padding: 4px 7px;\r\n");
           $nm_saida->saida("    white-space: nowrap;\r\n");
           $nm_saida->saida("    animation-delay: 0s;\r\n");
           $nm_saida->saida("    animation-duration: 0s;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".scButton_default.sc-actb:hover {\r\n");
           $nm_saida->saida("    padding: 4px 7px !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-fa { padding: 5px !important;font-size: 17px !important; }\r\n");
           $nm_saida->saida(".sc-actionbar-fa i {  }\r\n");
           $nm_saida->saida(".sc-actionbar-fa i:hover {  }\r\n");
           $nm_saida->saida(".sc-actionbar-fa i:active {  }\r\n");
           $nm_saida->saida(".sc-actionbar-btn { text-decoration: none !important;padding: 5px !important; }\r\n");
           $nm_saida->saida(".sc-actionbar-img { padding: 5px !important; }\r\n");
           $nm_saida->saida(".sc-actionbar-txt { padding: 5px !important; }\r\n");
           $nm_saida->saida(".sc-actionbar-fa.disabled {\r\n");
           $nm_saida->saida("    cursor: not-allowed !important;\r\n");
           $nm_saida->saida("    opacity: 0.44 !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-btn.disabled .scButton_default.sc-actb {\r\n");
           $nm_saida->saida("    cursor: not-allowed !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-btn.disabled {\r\n");
           $nm_saida->saida("    opacity: 0.44 !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-img.disabled {\r\n");
           $nm_saida->saida("    cursor: not-allowed !important;\r\n");
           $nm_saida->saida("    opacity: 0.44 !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-txt.disabled {\r\n");
           $nm_saida->saida("    cursor: not-allowed !important;\r\n");
           $nm_saida->saida("    opacity: 0.44 !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-button-hidden {\r\n");
           $nm_saida->saida("    display: none;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-txt:hover {  }\r\n");
           $nm_saida->saida(".sc-actionbar-txt:active {  }\r\n");
           $nm_saida->saida("</style>\r\n");
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("function actionBar_displayState(buttonName, buttonState, buttonRow)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    let stateHtml, buttonId, stateHint;\r\n");
           $nm_saida->saida("    stateHint = actionBar_getStateHint(buttonName, buttonState);\r\n");
           $nm_saida->saida("    stateConfirm = actionBar_getStateConfirm(buttonName, buttonState);\r\n");
           $nm_saida->saida("    switch (buttonName) {\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    $(\"#\" + buttonId).html(stateHtml).data(\"actionbarState\", buttonState).data(\"actionbarConfirm\", stateConfirm);\r\n");
           $nm_saida->saida("    if (\"\" == stateHint) {\r\n");
           $nm_saida->saida("        if (\"undefined\" != typeof document.querySelector(\"#\" + buttonId)._tippy) {\r\n");
           $nm_saida->saida("            document.querySelector(\"#\" + buttonId)._tippy.disable();\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    } else {\r\n");
           $nm_saida->saida("        if (\"undefined\" == typeof document.querySelector(\"#\" + buttonId)._tippy) {\r\n");
           $nm_saida->saida("            tippy(\"#\" + buttonId, {\r\n");
           $nm_saida->saida("                content: stateHint,\r\n");
           $nm_saida->saida("                theme: \"light\"\r\n");
           $nm_saida->saida("            });\r\n");
           $nm_saida->saida("        } else {\r\n");
           $nm_saida->saida("            document.querySelector(\"#\" + buttonId)._tippy.enable();\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        document.querySelector(\"#\" + buttonId)._tippy.setContent(stateHint);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_getStateHint(buttonName, buttonState)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    switch (buttonName) {\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_getStateConfirm(buttonName, buttonState)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    switch (buttonName) {\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_disable(buttonName, disableButton, buttonRow)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    if (disableButton) {\r\n");
           $nm_saida->saida("        $(\"#sc-actionbar-actbtn_\" + buttonName + buttonRow).addClass(\"disabled\").on(\"mouseover\", function() { $(this).css(\"cursor\", \"not-allowed\"); });\r\n");
           $nm_saida->saida("    } else {\r\n");
           $nm_saida->saida("        $(\"#sc-actionbar-actbtn_\" + buttonName + buttonRow).removeClass(\"disabled\").on(\"mouseover\", function() { $(this).css(\"cursor\", \"pointer\"); });\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_hide(buttonName, hideButton, buttonRow)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    if (hideButton) {\r\n");
           $nm_saida->saida("        $(\"#sc-actionbar-actbtn_\" + buttonName + buttonRow).hide();\r\n");
           $nm_saida->saida("    } else {\r\n");
           $nm_saida->saida("        $(\"#sc-actionbar-actbtn_\" + buttonName + buttonRow).show();\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_linkSubmit5(link_selector, apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor, confirm)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    if ($(\"#\" + link_selector).hasClass(\"disabled\")) {\r\n");
           $nm_saida->saida("        return;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    if ('' != confirm) {\r\n");
           $nm_saida->saida("        scJs_confirm(confirm, function() { nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor); }, function() {});\r\n");
           $nm_saida->saida("        return;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor);\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_linkSubmit6(link_obj, apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor, confirm)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    if ($(\"#\" + link_selector).hasClass(\"disabled\")) {\r\n");
           $nm_saida->saida("        return;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    if ('' != confirm) {\r\n");
           $nm_saida->saida("        scJs_confirm(confirm, function() { nm_gp_submit6(apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor); }, function() {});\r\n");
           $nm_saida->saida("        return;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    nm_gp_submit6(apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor);\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("</script>\r\n");
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("</script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/scInput.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput2.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/bluebird.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/nm_position.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_filter.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_filter" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
           { 
               $nm_saida->saida("   function sc_session_redir(url_redir)\r\n");
               $nm_saida->saida("   {\r\n");
           $nm_saida->saida("       if (typeof(sc_session_redir_mobile) === typeof(function(){})) { sc_session_redir_mobile(url_redir); }\r\n");
               $nm_saida->saida("       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n");
               $nm_saida->saida("       {\r\n");
               $nm_saida->saida("           window.parent.sc_session_redir(url_redir);\r\n");
               $nm_saida->saida("       }\r\n");
               $nm_saida->saida("       else\r\n");
               $nm_saida->saida("       {\r\n");
               $nm_saida->saida("           if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n");
               $nm_saida->saida("           {\r\n");
               $nm_saida->saida("               window.close();\r\n");
               $nm_saida->saida("               window.opener.sc_session_redir(url_redir);\r\n");
               $nm_saida->saida("           }\r\n");
               $nm_saida->saida("           else\r\n");
               $nm_saida->saida("           {\r\n");
               $nm_saida->saida("               window.location = url_redir;\r\n");
               $nm_saida->saida("           }\r\n");
               $nm_saida->saida("       }\r\n");
               $nm_saida->saida("   }\r\n");
           }
           $nm_saida->saida("   var scBtnGrpStatus = {};\r\n");
           $nm_saida->saida("   var SC_Link_View   = false;\r\n");
           $nm_saida->saida("   var SC_Proc_Mobile = false;\r\n");
           if ($this->Ini->SC_Link_View) {
               $nm_saida->saida("   SC_Link_View = true;\r\n");
           }
           if ($_SESSION['scriptcase']['proc_mobile']) {
               $nm_saida->saida("   SC_Proc_Mobile = true;\r\n");
           }
           $nm_saida->saida("   var Qsearch_ok = true;\r\n");
           if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] != "on")
           {
               $nm_saida->saida("   Qsearch_ok = false;\r\n");
           }
           $nm_saida->saida("   var scQSInit = true;\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid']) . ";\r\n");
           }
           $nm_saida->saida("   var Dyn_Ini   = true;\r\n");
           $nm_saida->saida("   var nmdg_Form = \"Fdyn_search\";\r\n");
           if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
           {
               $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
               foreach ($Tb_err_js as $Lines)
               {
                   if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
                   {
                       $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
                   }
                   echo "   " . $Lines;
               }
           }
           $Msg_Inval = "Inv�lido";
           if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
           {
               $Msg_Inval = sc_convert_encoding($Msg_Inval, $_SESSION['scriptcase']['charset'], "UTF-8");
           }
           echo "   var SC_crit_inv = \"" . $Msg_Inval . "\";\r\n";
           $nm_saida->saida("  function SC_init_jquery(isScrollNav){ \r\n");
           $nm_saida->saida("   \$(function(){ \r\n");
           $nm_saida->saida("     if (Dyn_Ini)\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("         Dyn_Ini = false;\r\n");
           if ($nmgrp_apl_opcao != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['grid_pesq']))
           { 
               $nm_saida->saida("         SC_carga_evt_jquery('all');\r\n");
           } 
           $nm_saida->saida("         scLoadScInput('input:text.sc-js-input');\r\n");
           $nm_saida->saida("     }\r\n");
           if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
           {
               $nm_saida->saida("     \$('#SC_fast_search_top').keyup(function(e) {\r\n");
               $nm_saida->saida("       scQuickSearchKeyUp('top', e);\r\n");
               $nm_saida->saida("     });\r\n");
           }
           $nm_saida->saida("     $('#id_F0_top').keyup(function(e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("          return false; \r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#id_F0_bot').keyup(function(e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("          return false; \r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpText\").mouseover(function() { $(this).addClass(\"scBtnGrpTextOver\"); }).mouseout(function() { $(this).removeClass(\"scBtnGrpTextOver\"); });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpClick\").mouseup(function(event){\r\n");
           $nm_saida->saida("          event.preventDefault();\r\n");
           $nm_saida->saida("          if(event.target !== event.currentTarget) return;\r\n");
           $nm_saida->saida("          if($(this).find(\"a\").prop('href') != '')\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              $(this).find(\"a\").click();\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("          else\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              eval($(this).find(\"a\").prop('onclick'));\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }); \r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  SC_init_jquery(false);\r\n");
           $nm_saida->saida("   \$(window).on('load', function() {\r\n");
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ancor_save']);
           }
           if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
           {
               $nm_saida->saida("     scQuickSearchKeyUp('top', null);\r\n");
           }
           $nm_saida->saida("   });\r\n");
           $nm_saida->saida("   function scQuickSearchSubmit_top() {\r\n");
           $nm_saida->saida("     document.F0_top.nmgp_opcao.value = 'fast_search';\r\n");
           $nm_saida->saida("     document.F0_top.submit();\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scQuickSearchKeyUp(sPos, e) {\r\n");
           $nm_saida->saida("     if (null != e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("         if ('top' == sPos) nm_gp_submit_qsearch('top');\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("       else\r\n");
           $nm_saida->saida("       {\r\n");
           $nm_saida->saida("           $('#SC_fast_search_submit_top').show();\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGroupByShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     if ($(\"#sc_id_groupby_placeholder_\" + sPos).css('display') != 'none') {\r\n");
           if ($_SESSION['scriptcase']['proc_mobile']) { 
               $nm_saida->saida("         //return;\r\n");
           }
           else {
               $nm_saida->saida("         scBtnGroupByHide(sPos);\r\n");
               $nm_saida->saida("         $(\"#sel_groupby_\" + sPos).removeClass(\"selected\");\r\n");
               $nm_saida->saida("         return;\r\n");
           }
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_groupby_placeholder_\" + sPos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGroupByHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     if ($(\"#sc_id_sel_campos_placeholder_\" + sPos).css('display') != 'none') {\r\n");
           if ($_SESSION['scriptcase']['proc_mobile']) { 
               $nm_saida->saida("         //return;\r\n");
           }
           else {
               $nm_saida->saida("         scBtnSelCamposHide(sPos);\r\n");
               $nm_saida->saida("         $(\"#selcmp_\" + sPos).removeClass(\"selected\");\r\n");
               $nm_saida->saida("         return;\r\n");
           }
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_sel_campos_placeholder_\" + sPos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnOrderCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     if ($(\"#sc_id_order_campos_placeholder_\" + sPos).css('display') != 'none') {\r\n");
           if ($_SESSION['scriptcase']['proc_mobile']) { 
               $nm_saida->saida("         //return;\r\n");
           }
           else {
               $nm_saida->saida("         scBtnOrderCamposHide(sPos);\r\n");
               $nm_saida->saida("         $(\"#ordcmp_\" + sPos).removeClass(\"selected\");\r\n");
               $nm_saida->saida("         return;\r\n");
           }
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_order_campos_placeholder_\" + sPos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnOrderCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGrpShow(sGroup) {\r\n");
           $nm_saida->saida("     if (typeof(scBtnGrpShowMobile) === typeof(function(){})) { return scBtnGrpShowMobile(sGroup); };\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).addClass('selected');\r\n");
           $nm_saida->saida("     var btnPos = $('#sc_btgp_btn_' + sGroup).offset();\r\n");
           $nm_saida->saida("     scBtnGrpStatus[sGroup] = 'open';\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).mouseout(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = '';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     }).mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup + ' span a').click(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup).css({\r\n");
           $nm_saida->saida("       'left': '0px'\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseleave(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .show('fast');\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGrpHide(sGroup, bForce) {\r\n");
           $nm_saida->saida("     if (bForce || 'over' != scBtnGrpStatus[sGroup]) {\r\n");
           $nm_saida->saida("       $('#sc_btgp_div_' + sGroup).hide('fast');\r\n");
           $nm_saida->saida("       $('#sc_btgp_btn_' + sGroup).removeClass('selected');\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   </script> \r\n");
       } 
       $nm_saida->saida("<style type=\"text/css\">\r\n");
       $nm_saida->saida(".sc-badge-pill {\r\n");
       $nm_saida->saida("    padding-right: 0.6em;\r\n");
       $nm_saida->saida("    padding-left: 0.6em;\r\n");
       $nm_saida->saida("    border-radius: 10rem;\r\n");
       $nm_saida->saida("    font-size: 85%;\r\n");
       $nm_saida->saida("    font-weight: bold;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-blue {\r\n");
       $nm_saida->saida("	background-color: #dbeafe;\r\n");
       $nm_saida->saida("	color: #1e40af;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-brown {\r\n");
       $nm_saida->saida("    background-color: #ffe4b5;\r\n");
       $nm_saida->saida("    color: #a52a2a;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-cyan {\r\n");
       $nm_saida->saida("    background-color: #afeeee;\r\n");
       $nm_saida->saida("    color: #008b8b;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-gray {\r\n");
       $nm_saida->saida("	background-color: #f3f4f6;\r\n");
       $nm_saida->saida("	color: #1f2937;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-green {\r\n");
       $nm_saida->saida("	background-color: #dcfce7;\r\n");
       $nm_saida->saida("	color: #166534;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-orange {\r\n");
       $nm_saida->saida("	background-color: #ffe5b4;\r\n");
       $nm_saida->saida("	color: #ff8c00;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-pink {\r\n");
       $nm_saida->saida("    background-color: #fddde6;\r\n");
       $nm_saida->saida("    color: #ff1493;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-purple {\r\n");
       $nm_saida->saida("    background-color: #f5e7ff;\r\n");
       $nm_saida->saida("    color: #60289a;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-red {\r\n");
       $nm_saida->saida("	background-color: #fee2e2;\r\n");
       $nm_saida->saida("	color: #991b1b;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-yellow {\r\n");
       $nm_saida->saida("	background-color: #fef9c3;\r\n");
       $nm_saida->saida("	color: #854d0e;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("</style>\r\n");
       $nm_saida->saida("<style type=\"text/css\">\r\n");
       $nm_saida->saida("</style>\r\n");
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'])
       {
           $write_css = true;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_appointments_adm_validar_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
       {
           $this->NM_field_over  = 0;
           $this->NM_field_click = 0;
           $Css_sub_cons = array();
           if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
           { 
               $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
               $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw'])) 
               { 
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw'] as $Apl => $Css_apl)
                   {
                       $Css_sub_cons[] = $Css_apl;
                       $Css_sub_cons[] = str_replace(".css", $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css", $Css_apl);
                   }
               } 
           } 
           else 
           { 
               $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
               $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css'])) 
               { 
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css'] as $Apl => $Css_apl)
                   {
                       $Css_sub_cons[] = $Css_apl;
                       $Css_sub_cons[] = str_replace(".css", $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css", $Css_apl);
                   }
               } 
           } 
           if (is_file($this->Ini->path_css . $NM_css_file))
           {
               $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   if (substr(trim($NM_line_css), 0, 12) == ".scGridTotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 15) == ".scGridSubtotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_sub_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 16) == ".scGridFieldOver" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_over = 1;
                   }
                   if (substr(trim($NM_line_css), 0, 17) == ".scGridFieldClick" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_click = 1;
                   }
                   $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                   if ($write_css) {@fwrite($NM_css, "    " .  $NM_line_css . "\r\n");}
               }
           }
           if (is_file($this->Ini->path_css . $NM_css_dir))
           {
               $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   if (substr(trim($NM_line_css), 0, 12) == ".scGridTotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 15) == ".scGridSubtotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_sub_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 16) == ".scGridFieldOver" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_over = 1;
                   }
                   if (substr(trim($NM_line_css), 0, 17) == ".scGridFieldClick" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_click = 1;
                   }
                   $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                   if ($write_css) {@fwrite($NM_css, "    " .  $NM_line_css . "\r\n");}
               }
           }
           if (!empty($Css_sub_cons))
           {
               $Css_sub_cons = array_unique($Css_sub_cons);
               foreach ($Css_sub_cons as $Cada_css_sub)
               {
                   if (is_file($this->Ini->path_css . $Cada_css_sub))
                   {
                       $compl_css = str_replace(".", "_", $Cada_css_sub);
                       $temp_css  = explode("/", $compl_css);
                       if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
                       $NM_css_attr = file($this->Ini->path_css . $Cada_css_sub);
                       foreach ($NM_css_attr as $NM_line_css)
                       {
                           $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                           if ($write_css) {@fwrite($NM_css, "    ." .  $compl_css . "_" . substr(trim($NM_line_css), 1) . "\r\n");}
                       }
                   }
               }
           }
       }
       if ($write_css) {@fclose($NM_css);}
           $this->NM_css_val_embed .= "win";
           $this->NM_css_ajx_embed .= "ult_set";
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
 { 
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->str_google_fonts . "\" />\r\n");
 } 
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       elseif ($this->NM_opcao == "print" || $this->Print_All)
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_appointments_adm_validar_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['num_css'] . '.css');
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("  </style>\r\n");
       }
       else
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_grid_appointments_adm_validar_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf") {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       } 
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] != "pdf")
       {
           $nm_saida->saida("  .css_iframes   { margin-bottom: 0px; margin-left: 0px;  margin-right: 0px;  margin-top: 0px; }\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
       { 
           $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;color:black;}\r\n");
       } 
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
  if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert'])
  {
   $nm_saida->saida("      thead { display: table-header-group !important; }\r\n");
   $nm_saida->saida("      tfoot { display: table-row-group !important; }\r\n");
   $nm_saida->saida("      table td, table tr, td, tr, table { page-break-inside: avoid !important; }\r\n");
   $nm_saida->saida("      #summary_body > td { padding: 0px !important; }\r\n");
  }
           $nm_saida->saida("  </style>\r\n");
       }
       if (!empty($this->SC_Buf_onInit))
       { 
       $nm_saida->saida("" . $this->SC_Buf_onInit . "\r\n");
       } 
       $nm_saida->saida("  </HEAD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $Pos1 = strpos($cada_css, "{");
           $Pos2 = strpos($cada_css, "}");
           if ($Pos1 !== false && $Pos2 !== false) {
               $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
               $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
               $cada_css = ".grid_appointments_adm_validar_" . substr(trim($Tag[0]), 1);
               if (isset($Tag[1])) {
                   $cada_css .= ", .grid_appointments_adm_validar_" . substr(trim($Tag[1]), 1);
               }
               $cada_css .= $Css;
           }
           else {
               $cada_css = ".grid_appointments_adm_validar_" . substr($cada_css, 1);
           }
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   $this->css_body_embutida = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['css_body_embutida'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['css_body_embutida'] : "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
       if (!$this->Ini->Export_html_zip && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word'] && ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print")) 
       {
           if ($this->Print_All) 
           {
               $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           }
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"-webkit-print-color-adjust: exact;" . $css_body . $this->css_body_embutida . "\">\r\n");
           $nm_saida->saida("   <TABLE id=\"sc_table_print\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $this->Tab_width . ">\r\n");
           $nm_saida->saida("     <TR>\r\n");
           $nm_saida->saida("       <TD>\r\n");
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "prit_web_page()", "prit_web_page()", "Bprint_print", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
           $nm_saida->saida("       </TD>\r\n");
           $nm_saida->saida("     </TR>\r\n");
           $nm_saida->saida("   </TABLE>\r\n");
           $nm_saida->saida("  <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery-3.6.0.min.js\"></script>\r\n");
           $nm_saida->saida("  <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     $(\"#Bprint_print\").addClass(\"disabled\").prop(\"disabled\", true);\r\n");
           $nm_saida->saida("     $(function() {\r\n");
           $nm_saida->saida("         $(\"#Bprint_print\").removeClass(\"disabled\").prop(\"disabled\", false);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     function prit_web_page()\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("        if ($(\"#Bprint_print\").prop(\"disabled\")) {\r\n");
           $nm_saida->saida("            return;\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        document.getElementById('sc_table_print').style.display = 'none';\r\n");
           $nm_saida->saida("        var is_safari = navigator.userAgent.indexOf(\"Safari\") > -1;\r\n");
           $nm_saida->saida("        var is_chrome = navigator.userAgent.indexOf('Chrome') > -1\r\n");
           $nm_saida->saida("        if ((is_chrome) && (is_safari)) {is_safari=false;}\r\n");
           $nm_saida->saida("        window.print();\r\n");
           $nm_saida->saida("        if (is_safari) {setTimeout(\"window.close()\", 1000);} else {window.close();}\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("  </script>\r\n");
       }
       else
       {
          $remove_margin = '';
          $remove_border = '';
          $vertical_center = '';
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"" . $remove_margin . $vertical_center . $css_body . $this->css_body_embutida . "\">\r\n");
       }
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none;\" class='scDebugWindow'><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$this->Print_All)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pdf_res'])
               {
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . "RESUMEN DE HORAS USUARIO" . "</H1></div>\r\n");
               } 
               else
               {
                   $groupByLabel = sprintf("" . $this->Ini->Nm_lang['lang_othr_cons_title_YYYYMM'] . "", "appointment_start_date");
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">{$groupByLabel}</H1></div>\r\n");
               } 
           }
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status")
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pdf_res'])
               {
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . "RESUMEN DE HORAS USUARIO" . "</H1></div>\r\n");
               } 
               else
               {
                   $groupByLabel = sprintf("current_status_id", "current_status_id");
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">{$groupByLabel}</H1></div>\r\n");
               } 
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word'])
       { 
           $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px;color:black;\"></div>\r\n");
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = "";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pdf_res'])
       {
           return;
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['css_body_embutida'])) {
       $remove_border = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['css_body_embutida'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert'])
   {
   }
   else
   {
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\" style=\"" . (isset($remove_border) ? $remove_border : '') . "\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
   }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print") 
       { 
       if (!$_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD  colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_A_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_A_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
       }
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_E_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_E_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <td style=\"padding: 0px;  vertical-align: top;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\"><tr>\r\n");
           $nm_saida->saida("    <TD colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_AL_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_AL_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
        } 
   }  
 }  
 function NM_cor_embutida()
 {  
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['cab_embutida'] = "N";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['SC_herda_css'] = "S"; 
   $compl_css = "";
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   {
       $this->arr_buttons = array_merge($this->arr_buttons, $this->Ini->arr_buttons_usr);
       if (is_file($this->Ini->link_grid_appointments_history_cons_emb)) {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['SC_herda_css'] = "S"; 
           $GLOBALS["script_case_init"] = $this->Ini->sc_page;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = true;
           $_SESSION['scriptcase']['grid_appointments_history']['protect_modal'] = $this->Ini->sc_page;
           include_once ($this->Ini->link_grid_appointments_history_cons_emb);
           $this->grid_appointments_history = new grid_appointments_history_sub_css ;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = false;
           unset($_SESSION['scriptcase']['grid_appointments_history']['protect_modal']);
       }
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_appointments_adm_validar']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_appointments_adm_validar']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_appointments_adm_validar']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_appointments_adm_validar']) . "_";
           } 
       }
   }
   $temp_css  = explode("/", $compl_css);
   if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
   $this->css_scGridPage           = $compl_css . "scGridPage";
   $this->css_scGridPageLink       = $compl_css . "scGridPageLink";
   $this->css_scGridToolbar        = $compl_css . "scGridToolbar";
   $this->css_scGridToolbarPadd    = $compl_css . "scGridToolbarPadding";
   $this->css_css_toolbar_obj      = $compl_css . "css_toolbar_obj";
   $this->css_scGridHeader         = $compl_css . "scGridHeader";
   $this->css_scGridHeaderFont     = $compl_css . "scGridHeaderFont";
   $this->css_scGridFooter         = $compl_css . "scGridFooter";
   $this->css_scGridFooterFont     = $compl_css . "scGridFooterFont";
   $this->css_scGridBlock          = $compl_css . "scGridBlock";
   $this->css_scGridBlockFont      = $compl_css . "scGridBlockFont";
   $this->css_scGridBlockAlign     = $compl_css . "scGridBlockAlign";
   $this->css_scGridTotal          = $compl_css . "scGridTotal";
   $this->css_scGridTotalFont      = $compl_css . "scGridTotalFont";
   $this->css_scGridSubtotal       = $compl_css . "scGridSubtotal";
   $this->css_scGridSubtotalFont   = $compl_css . "scGridSubtotalFont";
   $this->css_scGridFieldEven      = $compl_css . "scGridFieldEven";
   $this->css_scGridFieldEvenFont  = $compl_css . "scGridFieldEvenFont";
   $this->css_scGridFieldEvenVert  = $compl_css . "scGridFieldEvenVert";
   $this->css_scGridFieldEvenLink  = $compl_css . "scGridFieldEvenLink";
   $this->css_scGridFieldOdd       = $compl_css . "scGridFieldOdd";
   $this->css_scGridFieldOddFont   = $compl_css . "scGridFieldOddFont";
   $this->css_scGridFieldOddVert   = $compl_css . "scGridFieldOddVert";
   $this->css_scGridFieldOddLink   = $compl_css . "scGridFieldOddLink";
   $this->css_scGridFieldClick     = $compl_css . "scGridFieldClick";
   $this->css_scGridFieldOver      = $compl_css . "scGridFieldOver";
   $this->css_scGridLabel          = $compl_css . "scGridLabel";
   $this->css_scGridLabelVert      = $compl_css . "scGridLabelVert";
   $this->css_scGridLabelFont      = $compl_css . "scGridLabelFont";
   $this->css_scGridLabelLink      = $compl_css . "scGridLabelLink";
   $this->css_scGroupLabeldOdd     = $compl_css . "scGridLabelOddFont";
   $this->css_scGroupLabelEven     = $compl_css . "scGridLabelEvenFont";
   $this->css_scGridTabela         = $compl_css . "scGridTabela";
   $this->css_scGridTabelaTd       = $compl_css . "scGridTabelaTd";
   $this->css_scGridBlockBg        = $compl_css . "scGridBlockBg";
   $this->css_scGridBlockLineBg    = $compl_css . "scGridBlockLineBg";
   $this->css_scGridBlockSpaceBg   = $compl_css . "scGridBlockSpaceBg";
   $this->css_scGridLabelNowrap    = "";
   $this->css_scAppDivMoldura      = $compl_css . "scAppDivMoldura";
   $this->css_scAppDivHeader       = $compl_css . "scAppDivHeader";
   $this->css_scAppDivHeaderText   = $compl_css . "scAppDivHeaderText";
   $this->css_scAppDivContent      = $compl_css . "scAppDivContent";
   $this->css_scAppDivContentText  = $compl_css . "scAppDivContentText";
   $this->css_scAppDivToolbar      = $compl_css . "scAppDivToolbar";
   $this->css_scAppDivToolbarInput = $compl_css . "scAppDivToolbarInput";
   $this->css_inherit_bg           = "scInheritBg";

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida']) ? "grid_appointments_adm_validar_" : "";
   $this->css_sep = " ";
   $this->css_id_proyecto_label = $compl_css_emb . "css_id_proyecto_label";
   $this->css_id_proyecto_grid_line = $compl_css_emb . "css_id_proyecto_grid_line";
   $this->css_id_usuario_label = $compl_css_emb . "css_id_usuario_label";
   $this->css_id_usuario_grid_line = $compl_css_emb . "css_id_usuario_grid_line";
   $this->css_id_actividad_label = $compl_css_emb . "css_id_actividad_label";
   $this->css_id_actividad_grid_line = $compl_css_emb . "css_id_actividad_grid_line";
   $this->css_nombre_label = $compl_css_emb . "css_nombre_label";
   $this->css_nombre_grid_line = $compl_css_emb . "css_nombre_grid_line";
   $this->css_current_status_id_label = $compl_css_emb . "css_current_status_id_label";
   $this->css_current_status_id_grid_line = $compl_css_emb . "css_current_status_id_grid_line";
   $this->css_appointment_start_date_label = $compl_css_emb . "css_appointment_start_date_label";
   $this->css_appointment_start_date_grid_line = $compl_css_emb . "css_appointment_start_date_grid_line";
   $this->css_appointment_start_time_label = $compl_css_emb . "css_appointment_start_time_label";
   $this->css_appointment_start_time_grid_line = $compl_css_emb . "css_appointment_start_time_grid_line";
   $this->css_appointment_end_time_label = $compl_css_emb . "css_appointment_end_time_label";
   $this->css_appointment_end_time_grid_line = $compl_css_emb . "css_appointment_end_time_grid_line";
   $this->css_intervalo_label = $compl_css_emb . "css_intervalo_label";
   $this->css_intervalo_grid_line = $compl_css_emb . "css_intervalo_grid_line";
   $this->css_accion_revertir_label = $compl_css_emb . "css_accion_revertir_label";
   $this->css_accion_revertir_grid_line = $compl_css_emb . "css_accion_revertir_grid_line";
   $this->css_accion_aprobar_label = $compl_css_emb . "css_accion_aprobar_label";
   $this->css_accion_aprobar_grid_line = $compl_css_emb . "css_accion_aprobar_grid_line";
   $this->css_accion_rechazar_label = $compl_css_emb . "css_accion_rechazar_label";
   $this->css_accion_rechazar_grid_line = $compl_css_emb . "css_accion_rechazar_grid_line";
   $this->css_hisoria_label = $compl_css_emb . "css_hisoria_label";
   $this->css_hisoria_grid_line = $compl_css_emb . "css_hisoria_grid_line";
   $this->css_appointments_id_label = $compl_css_emb . "css_appointments_id_label";
   $this->css_appointments_id_grid_line = $compl_css_emb . "css_appointments_id_grid_line";
 }  
 function cabecalho()
 {
     if($_SESSION['scriptcase']['proc_mobile'] && method_exists($this, 'cabecalho_mobile'))
     {
         $this->cabecalho_mobile();
     }
     else if(method_exists($this, 'cabecalho_normal'))
     {
         $this->cabecalho_normal();
     }
 }
// 
//----- 
 function cabecalho_normal()
 {
   global
          $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['cab']))
   {
       return; 
   }
   if ($this->Ini->Embutida_iframe) {
       return; 
   }
   $nm_cab_filtro   = ""; 
   $nm_cab_filtrobr = ""; 
   $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
   $Lim   = strlen($Str_date);
   $Ult   = "";
   $Arr_D = array();
   for ($I = 0; $I < $Lim; $I++)
   {
       $Char = substr($Str_date, $I, 1);
       if ($Char != $Ult)
       {
           $Arr_D[] = $Char;
       }
       $Ult = $Char;
   }
   $Prim = true;
   $Str  = "";
   foreach ($Arr_D as $Cada_d)
   {
       $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
       $Str .= $Cada_d;
       $Prim = false;
   }
   $Str = str_replace("a", "Y", $Str);
   $Str = str_replace("y", "Y", $Str);
   $nm_data_fixa = date($Str); 
   $this->sc_proc_grid = false; 
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cond_pesq'];
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cond_pesq'], 0, $trab_pos);
       $nm_cab_filtrobr = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and . "<br />", $nm_cab_filtro);
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $nm_cab_filtro;
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       if ($trab_pos === false)
       {
       }
       else  
       {  
          $nm_cab_filtro = substr($nm_cab_filtro, 0, $trab_pos) . " " .  $nm_cond_filtro_or . $nm_cond_filtro_and . substr($nm_cab_filtro, $trab_pos + 5);
          $nm_cab_filtro = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and, $nm_cab_filtro);
       }   
   }   
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS"); 
   $nm_saida->saida(" <TR id=\"sc_grid_head\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" colspan=3 style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) 
     {
         if($this->Tem_tab_vert)
         {
           $nm_saida->saida("   <TD colspan=\"2\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
         }
         else{
           $nm_saida->saida("   <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
         }
     }
     else{
           $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     }
   } 
   $nm_saida->saida("<style>\r\n");
   $nm_saida->saida("    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}\r\n");
   $nm_saida->saida("</style>\r\n");
   $nm_saida->saida("<div class=\"" . $this->css_scGridHeader . "\" style=\"height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;\">\r\n");
   $nm_saida->saida("    <div class=\"" . $this->css_scGridHeaderFont . "\" style=\"float: left; text-transform: uppercase;\">" . "Período Consulta: <font color=\"#008000\"> " . $_SESSION['fecha3'] . " al " . $_SESSION['fecha4'] . " </font>" . "</div>\r\n");
   $nm_saida->saida("    <div class=\"" . $this->css_scGridHeaderFont . "\" style=\"float: right;\">Validación de Horas</div>\r\n");
   $nm_saida->saida("    \r\n");
   $nm_saida->saida("</div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   $nm_saida->saida(" </TR>\r\n");
 }
// 
 function label_grid($linhas = 0)
 {
   global 
           $nm_saida;
   static $nm_seq_titulos   = 0; 
   $contr_embutida = false;
   $salva_htm_emb  = "";
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_label'])
   { 
       $this->New_label['current_status_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . "";
       $this->New_label['appointment_start_date'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . "";
       $this->New_label['appointments_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointments_id'] . "";
       $this->New_label['appointment_end_date'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_end_date'] . "";
       $this->New_label['appointment_recurrent'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_recurrent'] . "";
       $this->New_label['appointment_period'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_period'] . "";
   } 
   $this->SC_contr_ck_grid = (!isset($this->SC_contr_ck_grid)) ? "''" : "none";
   if (1 < $linhas)
   {
      $this->Lin_impressas++;
   }
   $nm_seq_titulos++; 
   $tmp_header_row = $nm_seq_titulos;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['exibe_titulos']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_label'])
      { 
          if (!isset($_SESSION['scriptcase']['saida_var']) || !$_SESSION['scriptcase']['saida_var']) 
          { 
              $_SESSION['scriptcase']['saida_var']  = true;
              $_SESSION['scriptcase']['saida_html'] = "";
              $contr_embutida = true;
          } 
          else 
          { 
              $salva_htm_emb = $_SESSION['scriptcase']['saida_html'];
              $_SESSION['scriptcase']['saida_html'] = "";
          } 
      } 
   $nm_saida->saida("    <TR id=\"tit_grid_appointments_adm_validar__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-grid_appointments_adm_validar-" . $tmp_header_row . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_label']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_appointments_id_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_appointments_id_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if ($this->NM_btn_run_show) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_appointments_id_label'] . "\" ><input type=checkbox id=\"NM_ck_run0\" name=\"NM_ck_grid[]\" value=\"0\" style=\"display:" . $this->SC_contr_ck_grid . "\" onClick=\"nm_marca_check_grid(this)\"></TD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] != "pdf") {
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " sc-col-actionbar-left \"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_appointments_id_label'] . "\" ><style>\r\n");
   $nm_saida->saida("    .sc-col-actionbar-left {  }\r\n");
   $nm_saida->saida("    .sc-col-actionbar-left:hover {  }\r\n");
   $nm_saida->saida("</style>\r\n");
   $nm_saida->saida("<div style=\"display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline\">\r\n");
   $nm_saida->saida("    <div style=\"flex-grow: 1; text-align: center\">&nbsp;</div>\r\n");
   $nm_saida->saida("</div>\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
   } 
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_label'])
     { 
         if (isset($_SESSION['scriptcase']['saida_var']) && $_SESSION['scriptcase']['saida_var'])
         { 
             $Cod_Html = $_SESSION['scriptcase']['saida_html'];
             $pos_tag = strpos($Cod_Html, "<TD ");
             $Cod_Html = substr($Cod_Html, $pos_tag);
             $pos      = 0;
             $pos_tag  = false;
             $pos_tmp  = true; 
             $tmp      = $Cod_Html;
             while ($pos_tmp)
             {
                $pos = strpos($tmp, "</TR>", $pos);
                if ($pos !== false)
                {
                    $pos_tag = $pos;
                    $pos += 4;
                }
                else
                {
                    $pos_tmp = false;
                }
             }
             $Cod_Html = substr($Cod_Html, 0, $pos_tag);
             $Nm_temp = explode("</TD>", $Cod_Html);
             $css_emb = "<style type=\"text/css\">";
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $Pos1 = strpos($cada_css, "{");
                 $Pos2 = strpos($cada_css, "}");
                 if ($Pos1 !== false && $Pos2 !== false) {
                     $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
                     $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
                     $cada_css = ".grid_appointments_adm_validar_" . substr(trim($Tag[0]), 1);
                     if (isset($Tag[1])) {
                         $cada_css .= ", .grid_appointments_adm_validar_" . substr(trim($Tag[1]), 1);
                     }
                     $css_emb .= $cada_css . $Css;
                 }
                 else {
                       $css_emb .= ".grid_appointments_adm_validar_" . substr($cada_css, 1);
                 }
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cols_emb'] = count($Nm_temp) - 1;
             if ($contr_embutida) 
             { 
                 $_SESSION['scriptcase']['saida_var']  = false;
                 $nm_saida->saida($Cod_Html);
             } 
             else 
             { 
                 $_SESSION['scriptcase']['saida_html'] = $salva_htm_emb . $Cod_Html;
             } 
         } 
     } 
     $NM_seq_lab = 1;
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels'] as $NM_cmp => $NM_lab)
     {
         if (empty($NM_lab) || $NM_lab == "&nbsp;")
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels'][$NM_cmp] = "No_Label" . $NM_seq_lab;
             $NM_seq_lab++;
         }
     } 
   } 
 }
 function NM_label_id_proyecto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['id_proyecto'])) ? $this->New_label['id_proyecto'] : "Proyecto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_id_proyecto_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_id_proyecto_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('id_proyecto');
        $fieldSortIcon = $this->scGetColumnOrderIcon('id_proyecto', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_id_proyecto_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_id_proyecto_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('id_proyecto')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_id_usuario()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['id_usuario'])) ? $this->New_label['id_usuario'] : "Usuario";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_id_usuario_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_id_usuario_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('id_usuario');
        $fieldSortIcon = $this->scGetColumnOrderIcon('id_usuario', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_id_usuario_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_id_usuario_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('id_usuario')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_id_actividad()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['id_actividad'])) ? $this->New_label['id_actividad'] : "Tipo Actividad";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_id_actividad_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_id_actividad_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('id_actividad');
        $fieldSortIcon = $this->scGetColumnOrderIcon('id_actividad', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_id_actividad_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_id_actividad_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('id_actividad')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_nombre()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['nombre'])) ? $this->New_label['nombre'] : "Nombre Actividad";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_nombre_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_nombre_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('nombre');
        $fieldSortIcon = $this->scGetColumnOrderIcon('nombre', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_nombre_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_nombre_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('nombre')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_current_status_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['current_status_id'])) ? $this->New_label['current_status_id'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . "";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_current_status_id_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_current_status_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_appointment_start_date()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['appointment_start_date'])) ? $this->New_label['appointment_start_date'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . "";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_appointment_start_date_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_appointment_start_date_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_appointment_start_time()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['appointment_start_time'])) ? $this->New_label['appointment_start_time'] : "Hora Inicio";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_appointment_start_time_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_appointment_start_time_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_appointment_end_time()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['appointment_end_time'])) ? $this->New_label['appointment_end_time'] : "Hora Término";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_appointment_end_time_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_appointment_end_time_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_intervalo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['intervalo'])) ? $this->New_label['intervalo'] : "Duración (horas)";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_intervalo_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_intervalo_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('intervalo');
        $fieldSortIcon = $this->scGetColumnOrderIcon('intervalo', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_intervalo_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_intervalo_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('intervalo')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_accion_revertir()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['accion_revertir'])) ? $this->New_label['accion_revertir'] : "Acción";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_accion_revertir_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_accion_revertir_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = 'left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_accion_aprobar()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['accion_aprobar'])) ? $this->New_label['accion_aprobar'] : "Aprobar";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_accion_aprobar_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_accion_aprobar_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = 'left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_accion_rechazar()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['accion_rechazar'])) ? $this->New_label['accion_rechazar'] : "Rechazar";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_accion_rechazar_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_accion_rechazar_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = 'left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_appointments_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['appointments_id'])) ? $this->New_label['appointments_id'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_appointments_id'] . "";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_appointments_id_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_appointments_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('appointments_id');
        $fieldSortIcon = $this->scGetColumnOrderIcon('appointments_id', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_appointments_id_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_appointments_id_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('appointments_id')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
    function scGetColumnOrderRule($fieldName)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_cmp'] == $fieldName) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ordem_label'] == 'desc') {
                $sortRule = 'desc';
            } else {
                $sortRule = 'asc';
            }
        }
        return $sortRule;
    }

    function scGetColumnOrderIcon($fieldName, $sortRule, $skipUnusedClass = false)
    {
        $unusedClass = $skipUnusedClass ? '' : ' sc-grid-order-icon-unused';        if ('desc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc . "\" />";
        } elseif ('asc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc . "\" />";
        } elseif ('' != $this->Ini->Label_sort) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort . "\" />";
        } else {
            return '';
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
            case "id_proyecto":
                return true;
            case "id_usuario":
                return true;
            case "id_actividad":
                return true;
            case "current_status_id":
                return true;
            case "intervalo":
                return true;
            case "appointments_id":
                return true;
            case "intervalo_seg":
                return true;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "id_proyecto":
                return 'desc';
            case "id_usuario":
                return 'desc';
            case "id_actividad":
                return 'desc';
            case "current_status_id":
                return 'desc';
            case "appointment_start_date":
                return 'desc';
            case "appointment_start_time":
                return 'desc';
            case "appointment_end_time":
                return 'desc';
            case "intervalo":
                return 'desc';
            case "appointments_id":
                return 'desc';
            case "appointment_end_date":
                return 'desc';
            case "intervalo_seg":
                return 'desc';
        }
        return 'asc';
    }

// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida;
   $fecha_tr               = "</tr>";
   $this->Ini->qual_linha  = "par";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ini_cor_grid']);
       }
   }
   static $nm_seq_execucoes = 0; 
   static $nm_seq_titulos   = 0; 
   $this->SC_ancora = "";
   $this->Rows_span = 1;
   $nm_seq_execucoes++; 
   $nm_seq_titulos++; 
   $this->nm_prim_linha  = true; 
   $this->Ini->nm_cont_lin = 0; 
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['id_proyecto'])) ? $this->New_label['id_proyecto'] : "Proyecto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['id_proyecto'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['id_usuario'])) ? $this->New_label['id_usuario'] : "Usuario";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['id_usuario'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['id_actividad'])) ? $this->New_label['id_actividad'] : "Tipo Actividad";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['id_actividad'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['nombre'])) ? $this->New_label['nombre'] : "Nombre Actividad";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['nombre'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['current_status_id'])) ? $this->New_label['current_status_id'] : "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['current_status_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['appointment_start_date'])) ? $this->New_label['appointment_start_date'] : "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['appointment_start_date'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['appointment_start_time'])) ? $this->New_label['appointment_start_time'] : "Hora Inicio";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['appointment_start_time'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['appointment_end_time'])) ? $this->New_label['appointment_end_time'] : "Hora Término";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['appointment_end_time'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['intervalo'])) ? $this->New_label['intervalo'] : "Duración (horas)";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['intervalo'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['accion_revertir'])) ? $this->New_label['accion_revertir'] : "Acción";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['accion_revertir'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['accion_aprobar'])) ? $this->New_label['accion_aprobar'] : "Aprobar";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['accion_aprobar'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['accion_rechazar'])) ? $this->New_label['accion_rechazar'] : "Rechazar";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['accion_rechazar'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['appointments_id'])) ? $this->New_label['appointments_id'] : "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['labels']['appointments_id'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm_validar']['lig_edit'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_refresh'])
   {
       $this->refresh_interativ_search();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_refresh'] = false;
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       $this->NM_btn_run_show = false;
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_grid_appointments_adm_validar#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cab_embutida'] != "S")
               {
                   $this->label_grid($linhas);
               }
               $this->NM_calc_span();
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridFieldOdd . "\"  style=\"padding: 0px; font-size:12px;color:#000000;\" colspan = \"" . $this->NM_colspan . "\" align=\"center\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "\r\n");
               $nm_saida->saida("  </td></tr>\r\n");
               $nm_saida->saida("  </table></td></tr></table>\r\n");
               $this->Lin_final = $this->rs_grid->EOF;
               if ($this->Lin_final)
               {
                   $this->rs_grid->Close();
               }
           }
       }
       else
       {
           $nm_saida->saida(" <TR> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print") 
           { 
           $nm_saida->saida("    <TD>\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_EL_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
           } 
           $nm_saida->saida("  <td " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;" . $this->css_body_embutida . "font-size:12px;color:#000000;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_A_grid_appointments_adm_validar', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_D_grid_appointments_adm_validar', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_E_grid_appointments_adm_validar', 'value' => 'NM_Blank_Page.htm');
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" &&
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print") 
           { 
               $nm_saida->saida("</TABLE></TD>\r\n");
               $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_DL_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
               $nm_saida->saida("</TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               if (!$_SESSION['scriptcase']['proc_mobile']) {
               $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_D_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               }
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    </TR>\r\n");
           } 
       $nm_saida->saida("</TABLE>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_grid_appointments_adm_validar#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'])
{
}
else
{
       $nm_saida->saida("    <TR> \r\n");
}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print") 
       { 
           $nm_saida->saida("    <TD  colspan=3>\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_EL_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
       } 
       $nm_id_aplicacao = " id=\"apl_grid_appointments_adm_validar#?#1\"";
   } 
   $TD_padding = "";
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert'])
{
}
else
{
   $nm_saida->saida("  <TD " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;" . $TD_padding . $this->css_body_embutida . "\">\r\n");
}
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
   if ($this->NM_btn_run_show)
   { 
       $nm_saida->saida("       <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("       <form name=\"FBtn_Run\" method=\"post\" action=\"./\" target=\"_self\">\r\n");
       $nm_saida->saida("        <input type=\"hidden\" name=\"nmgp_opcao\" value=\"formphp\"> \r\n");
       $nm_saida->saida("        <input type=\"hidden\" name=\"rec\" value=\"\"> \r\n");
       $nm_saida->saida("        <input type=\"hidden\" name=\"nm_call_php\" value=\"\"> \r\n");
       $nm_saida->saida("        <input type=\"hidden\" name=\"nm_run_opt_sel\" value=\"\"> \r\n");
       $nm_saida->saida("        <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"> \r\n");
       $nm_saida->saida("       </div> \r\n");
   } 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf']) { 
    if ($this->pdf_all_cab != "S") {
        $this->cabecalho();
    }
    $nm_saida->saida("              <thead>\r\n");
    if ($this->pdf_all_cab == "S") {
        $this->cabecalho();
    }
    if ($this->pdf_all_label == "S") {
        $this->label_grid();
    }
}
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf']) { 
 }else { 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-c75acedb\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
 }
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) { 
    $nm_saida->saida("</thead>\r\n");
 }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] && $this->pdf_all_label != "S" && $this->pdf_label_group != "S") 
   { 
      $this->label_grid($linhas);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $this->nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final'] = 0;
   } 
   $this->nmgp_prim_pag_pdf = true;
   $this->Break_pag_pdf = array();
   $this->Break_pag_prt = array();
   $this->Break_pag_pdf['sc_free_group_by']['appointment_start_date'] = "S";
   $this->Break_pag_prt['sc_free_group_by']['appointment_start_date'] = "N";
   $this->Break_pag_pdf['sc_free_group_by']['id_usuario'] = "N";
   $this->Break_pag_prt['sc_free_group_by']['id_usuario'] = "N";
   $this->Break_pag_pdf['sc_free_group_by']['current_status_id'] = "N";
   $this->Break_pag_prt['sc_free_group_by']['current_status_id'] = "N";
   $this->Break_pag_pdf['sc_free_group_by']['id_proyecto'] = "N";
   $this->Break_pag_prt['sc_free_group_by']['id_proyecto'] = "N";
   $this->Break_pag_pdf['sc_free_group_by']['id_actividad'] = "N";
   $this->Break_pag_prt['sc_free_group_by']['id_actividad'] = "N";
   $this->Break_pag_pdf['status']['current_status_id'] = "S";
   $this->Break_pag_prt['status']['current_status_id'] = "N";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Config_Page_break_PDF'] = "N";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Page_break_PDF']))
   {
       if (isset($this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby']]))
       {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $Cmp_gb => $resto)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Page_break_PDF'][$Cmp_gb] = $this->Break_pag_pdf['sc_free_group_by'][$Cmp_gb];
               }
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Page_break_PDF'] = $this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby']];
           }
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Page_break_PDF'] = array();
       }
   }
   $this->SC_top       = array();
   $this->SC_bot       = array();
   $this->SC_bot[]     = "appointment_start_date"; 
   $this->SC_top[]     = "appointment_start_date"; 
   $this->SC_bot[]     = "id_usuario"; 
   $this->SC_top[]     = "id_usuario"; 
   $this->SC_bot[]     = "current_status_id"; 
   $this->SC_top[]     = "current_status_id"; 
   $this->SC_bot[]     = "id_proyecto"; 
   $this->SC_top[]     = "id_proyecto"; 
   $this->SC_bot[]     = "id_actividad"; 
   $this->SC_top[]     = "id_actividad"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final'] == 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by") 
   {
       $Nivel_gb = 1;
       $this->Tab_Nv_tree = array();
       $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']);
       $this->Ult_qb_free = $this->Nivel_gbBot;
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $cmp => $sql)
       {
           $this->Tab_Nv_tree[$cmp] = $Nivel_gb;
           $Nivel_gb++;
           if (in_array($cmp, $this->SC_top))
           {
               $tmp = "quebra_" . $cmp . "_sc_free_group_by_top";
               $this->$tmp($cmp);
           }
       }
       $this->nmgp_prim_pag_pdf = false;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final'] == 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status") 
   { 
       if (isset($this->current_status_id))
       {
           $this->quebra_current_status_id_status_top(); 
       }
       $this->nmgp_prim_pag_pdf = false;
   } 
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $this->SC_seq_btn_run = 0;
   $nm_prog_barr = 0;
   $PB_tot       = "/" . $this->count_ger;;
   $nm_houve_quebra = "N";
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          $this->NM_cont_emb_linha++;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['emb_linha']++;
          if ($this->Ini->qual_linha == "impar")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['ini_cor_grid'] = "impar";
          }
          //---------- Gauge ----------
          if (!$this->Ini->sc_export_ajax && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && -1 < $this->progress_grid)
          {
              $this->progress_now++;
              if (0 == $this->progress_lim_now)
              {
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_rows'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
                  grid_appointments_adm_validar_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n", $this->Ini->Nm_lang);
                  fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n");
              }
              $this->progress_lim_now++;
              if ($this->progress_lim_tot == $this->progress_lim_now)
              {
                  $this->progress_lim_now = 0;
              }
          }
          $this->Lin_impressas++;
          $this->id_proyecto = $this->rs_grid->fields[0] ;  
          $this->id_proyecto = (string)$this->id_proyecto;
          $this->id_usuario = $this->rs_grid->fields[1] ;  
          $this->id_usuario = (string)$this->id_usuario;
          $this->id_actividad = $this->rs_grid->fields[2] ;  
          $this->id_actividad = (string)$this->id_actividad;
          $this->nombre = $this->rs_grid->fields[3] ;  
          $this->current_status_id = $this->rs_grid->fields[4] ;  
          $this->current_status_id = (string)$this->current_status_id;
          $this->appointment_start_date = $this->rs_grid->fields[5] ;  
          $this->appointment_start_time = $this->rs_grid->fields[6] ;  
          $this->appointment_end_time = $this->rs_grid->fields[7] ;  
          $this->intervalo = $this->rs_grid->fields[8] ;  
          $this->intervalo = (string)$this->intervalo;
          $this->appointments_id = $this->rs_grid->fields[9] ;  
          $this->appointments_id = (string)$this->appointments_id;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'] as $Cmp_clone => $Cmp_orig)
              {
                  $this->$Cmp_clone = $this->$Cmp_orig;
              }
          }
          if (!isset($this->appointment_start_date)) { $this->appointment_start_date = ""; }
          if (!isset($this->id_usuario)) { $this->id_usuario = ""; }
          if (!isset($this->current_status_id)) { $this->current_status_id = ""; }
          if (!isset($this->id_proyecto)) { $this->id_proyecto = ""; }
          if (!isset($this->id_actividad)) { $this->id_actividad = ""; }
          $GLOBALS["id_usuario"] = $this->rs_grid->fields[1] ;  
          $GLOBALS["id_usuario"] = (string)$GLOBALS["id_usuario"];
          $GLOBALS["id_actividad"] = $this->rs_grid->fields[2] ;  
          $GLOBALS["id_actividad"] = (string)$GLOBALS["id_actividad"];
          $GLOBALS["current_status_id"] = $this->rs_grid->fields[4] ;  
          $GLOBALS["current_status_id"] = (string)$GLOBALS["current_status_id"];
          $this->arg_sum_id_proyecto = ($this->id_proyecto == "") ? " is null " : " = " . $this->id_proyecto;
          $this->arg_sum_id_usuario = ($this->id_usuario == "") ? " is null " : " = " . $this->id_usuario;
          $this->arg_sum_id_actividad = ($this->id_actividad == "") ? " is null " : " = " . $this->id_actividad;
          $this->arg_sum_current_status_id = ($this->current_status_id == "") ? " is null " : " = " . $this->current_status_id;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by")
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
              {
                   $Cmp_orig = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp_gb])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp_gb] : $cmp_gb;
                   if ($Cmp_orig == "appointment_start_date")
                   {
                       $Str_arg_sum = "arg_sum_" . $cmp_gb;
                       $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp_gb);
                       $TP_Time = (in_array('appointment_start_date', $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
                       $this->$Str_arg_sum = $this->Ini->Get_date_arg_sum($TP_Time . $this->appointment_start_date, $Format_tst, "appointment_start_date");
                   }
               }
          }
          $this->SC_seq_page++; 
          if ($this->NM_btn_run_show)
          {
              $this->SC_seq_btn_run++;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_sql_btn_run'][$this->SC_seq_btn_run] = $this->rs_grid->fields;
          }
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final'] + 1; 
          $this->SC_sep_quebra = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by") 
          {  
              $SC_arg_Gby = array();
              $SC_arg_Sql = array();
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $cmp => $sql)
              {
                  $Cmp_orig   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp] : $cmp;
                  $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
                  $TP_Time = (in_array($Cmp_orig, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
                  $SC_arg_Gby[$cmp] = $this->Ini->Get_arg_groupby($TP_Time . $this->$Cmp_orig, $Format_tst); 
              }
              $SC_lst_Gby = array();
              $gb_ok      = false;
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $cmp => $sql)
              {
                  $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
                  $SC_arg_Sql[$cmp] = $sql;
                  $Fun_GB  = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp] : $cmp;
                  if (!empty($Format_tst))
                  {
                      $temp = $this->$cmp;
                      if (!empty($temp))
                      {
                          $SC_arg_Sql[$cmp] = $this->Ini->Get_sql_date_groupby($sql, $Format_tst);
                      }
                  }
                  $temp = $cmp . "_Old";
                  if ($SC_arg_Gby[$cmp] != $this->$temp || $gb_ok)
                  {
                      $SC_lst_Gby[] = $cmp;
                      $gb_ok = true;
                  }
              }
              $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']);
              krsort ($SC_lst_Gby);
              foreach ($SC_lst_Gby as $Ind => $cmp)
              {
                  if (in_array($cmp, $this->SC_bot))
                  {
                      $tmp = "quebra_" . $cmp . "_sc_free_group_by_bot";
                      $this->$tmp($cmp);
                      $this->Nivel_gbBot--;
                  }
                  $sql_where = "";
                  $cmp_qb     = $this->$cmp;
                  foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $Col_Gb => $Sql)
                  {
                      $tmp        = "arg_sum_" . $Col_Gb;
                      $sql_where .= (!empty($sql_where)) ? " and " : "";
                      $sql_where .= $SC_arg_Sql[$Col_Gb] . $this->$tmp;
                      if ($Col_Gb == $cmp)
                      {
                          break;
                      }
                  }
                  $tmp  = "quebra_" . $cmp . "_sc_free_group_by";
                  $this->$tmp($cmp_qb, $sql_where, $cmp);
              }
              if (!empty($SC_lst_Gby))
              {
                  $cmp = $SC_lst_Gby[0];
                  if ($this->Print_All && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word'] && $this->Break_pag_prt[$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby']][$cmp] == "S")
                  {
                      $this->nm_quebra_pagina("pagina"); 
                  }
                  elseif (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Page_break_PDF'][$cmp] == "S")
                  {
                      $this->nm_quebra_pagina("pagina"); 
                  }
              }
              $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']);
              ksort ($SC_lst_Gby);
              foreach ($SC_lst_Gby as $Ind => $cmp)
              {
                  if (in_array($cmp, $this->SC_top))
                  {
                      $tmp = "quebra_" . $cmp . "_sc_free_group_by_top";
                      $this->$tmp($cmp);
                  }
              }
              if (!empty($SC_lst_Gby))
              {
                  $nm_houve_quebra = "S";
                  foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $cmp => $sql)
                  {
                      $Cmp_orig   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'][$cmp] : $cmp;
                      $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
                      $Cmp_Old   = $cmp . '_Old';
                      $TP_Time = (in_array($Cmp_orig, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
                      $this->$Cmp_Old = $this->Ini->Get_arg_groupby($TP_Time . $this->$Cmp_orig, $Format_tst); 
                  }
              }
          }  
          if ($this->current_status_id !== $this->current_status_id_Old && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status") 
          {  
              if (isset($this->current_status_id_Old))
              {
                 $this->quebra_current_status_id_status_bot() ; 
              }
              if ($this->Print_All && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word'] && $this->Break_pag_prt[$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby']]['current_status_id'] == "S")
              {
                  $this->nm_quebra_pagina("pagina"); 
              }
              elseif (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Page_break_PDF']['current_status_id'] == "S")
              {
                  $this->nm_quebra_pagina("pagina"); 
              }
              $this->current_status_id_Old = $this->current_status_id ; 
              $this->quebra_current_status_id_status($this->current_status_id) ; 
              if (isset($this->current_status_id_Old))
              {
                 $this->quebra_current_status_id_status_top() ; 
              }
              $nm_houve_quebra = "S";
          } 
          $this->sc_proc_grid = true;
          $_SESSION['scriptcase']['grid_appointments_adm_validar']['contr_erro'] = 'on';
if (!isset($_SESSION['bcolor'])) {$_SESSION['bcolor'] = "";}
if (!isset($this->sc_temp_bcolor)) {$this->sc_temp_bcolor = (isset($_SESSION['bcolor'])) ? $_SESSION['bcolor'] : "";}
 
if ($this->current_status_id ==1)
	{
	   $this->NM_field_style["current_status_id"] = "background-color:#959aaf;";
	}
if ($this->current_status_id ==2)
	{
	    $this->NM_field_style["current_status_id"] = "background-color:#86b404;";
	}
if ($this->current_status_id ==3)
	{
	    $this->NM_field_style["current_status_id"] = "background-color:#ff5733;";
	}
if ($this->current_status_id ==4)
	{
	    $this->NM_field_style["current_status_id"] = "background-color:#8291da;";
	}
if ($this->current_status_id ==5)
	{
	    $this->NM_field_style["current_status_id"] = "background-color:#ffff00;";
	}
if ($this->current_status_id ==6)
	{
	    $this->NM_field_style["current_status_id"] = "background-color:#ffa500;";
	}
$this->accion_revertir ="<input type=button name='revertir' value='Revertir'>";
$this->accion_aprobar ="<input type=button name='aprobar' value='Aprobar' ";
if ($this->current_status_id ==2 or $this->current_status_id ==3) 
	{
		$this->accion_aprobar =$this->accion_aprobar ." disabled ";
	}
$this->accion_aprobar =$this->accion_aprobar .">";
$this->accion_rechazar ="<input type=button name='rechazar' value='Rechazar' ";
if ($this->current_status_id ==3 or $this->current_status_id ==2) 
	{
		$this->accion_rechazar =$this->accion_rechazar ." disabled ";
	}
$this->accion_rechazar =$this->accion_rechazar .">";
/*
if($this->sc_temp_bcolor) //it's just to have the change done only once
{
    echo "<script>changeBackgroundText('#87B406','APROBAR SELECCIONADOS');</script>";
    $this->sc_temp_bcolor = false;
}
*/
if (isset($this->sc_temp_bcolor)) {$_SESSION['bcolor'] = $this->sc_temp_bcolor;}
$_SESSION['scriptcase']['grid_appointments_adm_validar']['contr_erro'] = 'off';
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'])
          {
              if ($nm_houve_quebra == "S" || $this->nm_inicio_pag == 0)
              { 
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
                      $this->label_grid($linhas);
                  } 
                  $nm_houve_quebra = "N";
              } 
          } 
          else
          {
              if ($this->pdf_label_group != "S" && $this->pdf_all_label != "S")
              {
                  if ($this->nm_inicio_pag == 0 && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
                  {
                      $nm_houve_quebra = "N";
                  } 
              } 
              elseif (($nm_houve_quebra == "S" || ($this->nm_inicio_pag == 0)) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
              { 
                 if ($this->pdf_label_group == "S") 
                 {
                     if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
                         $this->label_grid($linhas);
                     } 
                 } 
                  $nm_houve_quebra = "N";
              } 
          } 
          $this->nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['final']; 
          $this->Ini->cor_link_dados = ($this->Ini->cor_link_dados == $this->css_scGridFieldOddLink) ? $this->css_scGridFieldEvenLink : $this->css_scGridFieldOddLink; 
          $this->Ini->qual_linha   = ($this->Ini->qual_linha == "par") ? "impar" : "par";
          if ("impar" == $this->Ini->qual_linha)
          {
              $this->css_line_back = $this->css_scGridFieldOdd;
              $this->css_line_fonf = $this->css_scGridFieldOddFont;
          }
          else
          {
              $this->css_line_back = $this->css_scGridFieldEven;
              $this->css_line_fonf = $this->css_scGridFieldEvenFont;
          }
          $NM_destaque = " onmouseover=\"over_tr(this, '" . $this->css_line_back . "');\" onmouseout=\"out_tr(this, '" . $this->css_line_back . "');\" onclick=\"click_tr(this, '" . $this->css_line_back . "');\"";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
              if ($temp == "appointment_start_date")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "appointment_end_date")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
          }
          $this->SC_ancora = $this->SC_seq_page;
          $nm_saida->saida("    <TR  class=\"" . $this->css_line_back . "\"" . $NM_destaque . " id=\"SC_ancor" . $this->SC_ancora . "\">\r\n");
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->Css_Cmp['css_appointments_id_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">&nbsp;</TD>\r\n");
 }
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_appointments_id_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
 if ($this->NM_btn_run_show){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_appointments_id_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\"> <input type=\"checkbox\" id=\"NM_ck_run" . $this->SC_seq_btn_run . "\" class=\"sc-ui-check-run\" name=\"NM_ck_grid[]\" value=\"" . NM_encode_input($this->SC_seq_btn_run) . "\" style=\"align:left;vertical-align:middle;font-weight:bold;\" /></TD>\r\n");
 } 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['mostra_edit'] != "N"){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
          $nm_saida->saida("<table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" class=\"sc-actionbar-button-container sc-actbtn-group-" . $dataActionbarPos . "_" . $this->SC_seq_page . "\"><tr>\r\n");
          $nm_saida->saida("<td style=\"padding: 0px\"><img id=\"b_open_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:''\" onclick=\"document.getElementById('b_open_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_close_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">\r\n");
          $nm_saida->saida("<img id=\"b_close_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:none\" onclick=\"document.getElementById('b_close_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_open_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">\r\n");
          $nm_saida->saida("</td>\r\n");
          $nm_saida->saida("</tr></table\r\n");
          $nm_saida->saida("></TD>\r\n");
 } 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['mostra_edit'] == "N"){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
          $nm_saida->saida("<table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" class=\"sc-actionbar-button-container sc-actbtn-group-" . $dataActionbarPos . "_" . $this->SC_seq_page . "\"><tr>\r\n");
          $nm_saida->saida("<td style=\"padding: 0px\"><img id=\"b_open_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:''\" onclick=\"document.getElementById('b_open_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_close_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">\r\n");
          $nm_saida->saida("<img id=\"b_close_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:none\" onclick=\"document.getElementById('b_close_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_open_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">\r\n");
          $nm_saida->saida("</td>\r\n");
          $nm_saida->saida("</tr></table>\r\n");
          $nm_saida->saida("</TD>\r\n");
 } 
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] != "pdf"){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\"><img id=\"b_open_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:''\" onclick=\"document.getElementById('b_open_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_close_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">\r\n");
          $nm_saida->saida("<img id=\"b_close_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:none\" onclick=\"document.getElementById('b_close_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_open_emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">\r\n");
          $nm_saida->saida("</TD>\r\n");
 } 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
          } 
              $this->NM_calc_span();
              $nm_saida->saida("</TR>\r\n");
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] != "pdf")
              { 
                  $nm_saida->saida("<TR  class=\"" . $this->css_line_back . "\" id=\"emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "\"  style=\"display:none\">\r\n");
              } 
              else 
              { 
                  $nm_saida->saida("<TR  class=\"" . $this->css_line_back . "\" id=\"emb_grid_appointments_adm_validar_linha_" . $this->NM_cont_emb_linha . "\"  style=\"display:''\">\r\n");
              } 
              $nm_saida->saida("<TD class=\"" . $this->css_line_fonf . "\" colspan=\"" . $this->NM_colspan . "\"><TABLE align=\"left\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
              $this->NM_grid_hisoria();
              $nm_saida->saida("</TR></TABLE></TD>\r\n");
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
      $this->Lin_final = $this->rs_grid->EOF;
      if ($this->Lin_final)
      {
         $this->rs_grid->Close();
      }
   } 
   else
   {
      $this->rs_grid->Close();
   }
   if (isset($this->grid_appointments_history) && method_exists($this->grid_appointments_history, "close_emb")) 
   {
       $this->grid_appointments_history->close_emb();
   }
   if ($this->rs_grid->EOF) 
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by")
       {
           $SC_lst_Gby = array();
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp'] as $cmp => $sql)
           {
               $SC_lst_Gby[] = $cmp;
           }
           $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']);
           krsort ($SC_lst_Gby);
           foreach ($SC_lst_Gby as $Ind => $cmp)
           {
               if (in_array($cmp, $this->SC_bot))
               {
                   $tmp = "quebra_" . $cmp . "_sc_free_group_by_bot";
                   $this->$tmp($cmp);
                   $this->Nivel_gbBot--;
               }
           }
       }
       if (isset($this->current_status_id_Old) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status")
       {
           $this->quebra_current_status_id_status_bot() ; 
       }
  
   }  
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['exibe_total'] == "S")
   { 
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] . "_top";
       $this->$Gb_geral() ;
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] . "_bot";
       $this->$Gb_geral() ;
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($this->NM_btn_run_show)
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && empty($this->nm_grid_sem_reg) && 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print") 
   { 
       $nm_saida->saida("</TABLE></TD>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_DL_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
       $nm_saida->saida("</TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_D_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
           $nm_saida->saida("    </TABLE>\r\n");
           $nm_saida->saida("    </TD>\r\n");
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao']       = "igual" ; 
   } 
 }
 function NM_grid_id_proyecto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->id_proyecto)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->id_proyecto)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_id_proyecto($conteudo , $this->id_proyecto) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_id_proyecto_grid_line . "\"  style=\"" . $this->Css_Cmp['css_id_proyecto_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_id_proyecto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_id_usuario()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->id_usuario)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->id_usuario)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_id_usuario($conteudo , $this->id_usuario) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_id_usuario_grid_line . "\"  style=\"" . $this->Css_Cmp['css_id_usuario_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_id_usuario_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_id_actividad()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->id_actividad)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->id_actividad)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_id_actividad($conteudo , $this->id_actividad) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_id_actividad_grid_line . "\"  style=\"" . $this->Css_Cmp['css_id_actividad_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_id_actividad_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_nombre()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->nombre));
              $conteudo_original = NM_encode_input(sc_strip_script($this->nombre));
          }
          else {
              $conteudo = sc_strip_script($this->nombre); 
              $conteudo_original = sc_strip_script($this->nombre); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_nombre_grid_line . "\"  style=\"" . $this->Css_Cmp['css_nombre_grid_line'] . "\"  align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_nombre_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_current_status_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->current_status_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->current_status_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_current_status_id($conteudo , $this->current_status_id) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
              $Style_current_status_id = "";
          if (isset($this->NM_field_style["current_status_id"]) && !empty($this->NM_field_style["current_status_id"]))
          {
              $Style_current_status_id .= $this->NM_field_style["current_status_id"];
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_current_status_id_grid_line . "\"  style=\"" . $this->Css_Cmp['css_current_status_id_grid_line'] . $Style_current_status_id . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_current_status_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_appointment_start_date()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->appointment_start_date)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->appointment_start_date)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_appointment_start_date_grid_line . "\"  style=\"" . $this->Css_Cmp['css_appointment_start_date_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_appointment_start_date_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_appointment_start_time()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->appointment_start_time)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->appointment_start_time)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
               if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "HH:II:SS");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_appointment_start_time_grid_line . "\"  style=\"" . $this->Css_Cmp['css_appointment_start_time_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_appointment_start_time_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_appointment_end_time()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->appointment_end_time)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->appointment_end_time)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
               if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "HH:II:SS");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_appointment_end_time_grid_line . "\"  style=\"" . $this->Css_Cmp['css_appointment_end_time_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_appointment_end_time_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_intervalo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->intervalo)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->intervalo)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_intervalo_grid_line . "\"  style=\"" . $this->Css_Cmp['css_intervalo_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_intervalo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_accion_revertir()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->accion_revertir));
              $conteudo_original = NM_encode_input(sc_strip_script($this->accion_revertir));
          }
          else {
              $conteudo = sc_strip_script($this->accion_revertir); 
              $conteudo_original = sc_strip_script($this->accion_revertir); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_accion_revertir_grid_line . "\"  style=\"" . $this->Css_Cmp['css_accion_revertir_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"  >\r\n");
 if (!$this->Ini->Proc_print && !$this->Ini->SC_Link_View && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf" && $conteudo != "&nbsp;"){ $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Ind_lig_mult']++;
       $linkTarget = isset($this->Ini->sc_lig_target['C_@scinf_accion_revertir_@scinf_revierte_estado']) ? $this->Ini->sc_lig_target['C_@scinf_accion_revertir_@scinf_revierte_estado'] : (isset($this->Ini->sc_lig_target['C_@scinf_accion_revertir']) ? $this->Ini->sc_lig_target['C_@scinf_accion_revertir'] : null);
       if (isset($this->Ini->sc_lig_md5["revierte_estado"]) && $this->Ini->sc_lig_md5["revierte_estado"] == "S") {
           $Parms_Lig = "nmgp_lig_edit_lapis*scinS*scoutapp_id*scin" . str_replace("'", "@aspass@", $this->appointments_id) . "*scoutestado*scin" . str_replace("'", "@aspass@", $this->current_status_id) . "*scoutNMSC_modal*scinok*scout";
           if ($_SESSION['scriptcase']['proc_mobile']) {
               $Parms_Lig = str_replace("NM_run_iframe?#?1?@?", "", $Parms_Lig);
           }
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard'] && isset($linkTarget))
           {
               if ('' != $Parms_Lig)
               {
                   $Parms_Lig .= '*scout';
               }
               $Parms_Lig .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $linkTarget . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['compact_mode'] ? '1' : '0') . '*scoutremove_margin*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['remove_margin'] ? '1' : '0') . '*scoutremove_border*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['remove_border'] ? '1' : '0');
           }
           $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_appointments_adm_validar@SC_par@" . md5($Parms_Lig);
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
       } else {
           $Md5_Lig = "nmgp_lig_edit_lapis*scinS*scoutapp_id*scin" . str_replace("'", "@aspass@", $this->appointments_id) . "*scoutestado*scin" . str_replace("'", "@aspass@", $this->current_status_id) . "*scoutNMSC_modal*scinok*scout";
       }
   $nm_saida->saida("<a  id=\"id_sc_field_accion_revertir_" . $this->SC_seq_page . "\" href=\"javascript:nm_gp_submit5('" . $this->Ini->link_revierte_estado_blk . "', '$this->nm_location', '$Md5_Lig', '" . (isset($linkTarget) ? $linkTarget : 'modal') . "', '', '70', '630', '', 'revierte_estado', '" . $this->SC_ancora . "')\" onMouseover=\"nm_mostra_hint(this, event, '')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_accion_revertir_grid_line . "\" style=\"" . $this->Css_Cmp['css_accion_revertir_grid_line'] . "\">" . $conteudo . "</a>\r\n");
} else {
   $nm_saida->saida(" <span id=\"id_sc_field_accion_revertir_" . $this->SC_seq_page . "\">$conteudo </span>\r\n");
       } 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_accion_aprobar()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->accion_aprobar));
              $conteudo_original = NM_encode_input(sc_strip_script($this->accion_aprobar));
          }
          else {
              $conteudo = sc_strip_script($this->accion_aprobar); 
              $conteudo_original = sc_strip_script($this->accion_aprobar); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_accion_aprobar_grid_line . "\"  style=\"" . $this->Css_Cmp['css_accion_aprobar_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"  >\r\n");
 if (!$this->Ini->Proc_print && !$this->Ini->SC_Link_View && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf" && $conteudo != "&nbsp;"){ $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Ind_lig_mult']++;
       $linkTarget = isset($this->Ini->sc_lig_target['C_@scinf_accion_aprobar_@scinf_aprobar_estado']) ? $this->Ini->sc_lig_target['C_@scinf_accion_aprobar_@scinf_aprobar_estado'] : (isset($this->Ini->sc_lig_target['C_@scinf_accion_aprobar']) ? $this->Ini->sc_lig_target['C_@scinf_accion_aprobar'] : null);
       if (isset($this->Ini->sc_lig_md5["aprobar_estado"]) && $this->Ini->sc_lig_md5["aprobar_estado"] == "S") {
           $Parms_Lig = "nmgp_lig_edit_lapis*scinS*scoutapp_id*scin" . str_replace("'", "@aspass@", $this->appointments_id) . "*scoutNMSC_modal*scinok*scout";
           if ($_SESSION['scriptcase']['proc_mobile']) {
               $Parms_Lig = str_replace("NM_run_iframe?#?1?@?", "", $Parms_Lig);
           }
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard'] && isset($linkTarget))
           {
               if ('' != $Parms_Lig)
               {
                   $Parms_Lig .= '*scout';
               }
               $Parms_Lig .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $linkTarget . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['compact_mode'] ? '1' : '0') . '*scoutremove_margin*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['remove_margin'] ? '1' : '0') . '*scoutremove_border*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['remove_border'] ? '1' : '0');
           }
           $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_appointments_adm_validar@SC_par@" . md5($Parms_Lig);
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
       } else {
           $Md5_Lig = "nmgp_lig_edit_lapis*scinS*scoutapp_id*scin" . str_replace("'", "@aspass@", $this->appointments_id) . "*scoutNMSC_modal*scinok*scout";
       }
   $nm_saida->saida("<a  id=\"id_sc_field_accion_aprobar_" . $this->SC_seq_page . "\" href=\"javascript:nm_gp_submit5('" . $this->Ini->link_aprobar_estado_blk . "', '$this->nm_location', '$Md5_Lig', '" . (isset($linkTarget) ? $linkTarget : 'modal') . "', '', '70', '630', '', 'aprobar_estado', '" . $this->SC_ancora . "')\" onMouseover=\"nm_mostra_hint(this, event, '')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_accion_aprobar_grid_line . "\" style=\"" . $this->Css_Cmp['css_accion_aprobar_grid_line'] . "\">" . $conteudo . "</a>\r\n");
} else {
   $nm_saida->saida(" <span id=\"id_sc_field_accion_aprobar_" . $this->SC_seq_page . "\">$conteudo </span>\r\n");
       } 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_accion_rechazar()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->accion_rechazar));
              $conteudo_original = NM_encode_input(sc_strip_script($this->accion_rechazar));
          }
          else {
              $conteudo = sc_strip_script($this->accion_rechazar); 
              $conteudo_original = sc_strip_script($this->accion_rechazar); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_accion_rechazar_grid_line . "\"  style=\"" . $this->Css_Cmp['css_accion_rechazar_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"  >\r\n");
 if (!$this->Ini->Proc_print && !$this->Ini->SC_Link_View && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf" && $conteudo != "&nbsp;"){ $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Ind_lig_mult']++;
       $linkTarget = isset($this->Ini->sc_lig_target['C_@scinf_accion_rechazar_@scinf_form_appointments']) ? $this->Ini->sc_lig_target['C_@scinf_accion_rechazar_@scinf_form_appointments'] : (isset($this->Ini->sc_lig_target['C_@scinf_accion_rechazar']) ? $this->Ini->sc_lig_target['C_@scinf_accion_rechazar'] : null);
       if (isset($this->Ini->sc_lig_md5["form_appointments"]) && $this->Ini->sc_lig_md5["form_appointments"] == "S") {
           $Parms_Lig = "nmgp_lig_edit_lapis*scinS*scoutnmgp_opcao*scinigual*scoutappointments_id*scin" . str_replace("'", "@aspass@", $this->appointments_id) . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scoutsc_redir_atualiz*scinok*scoutNMSC_modal*scinok*scout";
           if ($_SESSION['scriptcase']['proc_mobile']) {
               $Parms_Lig = str_replace("NM_run_iframe?#?1?@?", "", $Parms_Lig);
           }
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard'] && isset($linkTarget))
           {
               if ('' != $Parms_Lig)
               {
                   $Parms_Lig .= '*scout';
               }
               $Parms_Lig .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $linkTarget . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['compact_mode'] ? '1' : '0') . '*scoutremove_margin*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['remove_margin'] ? '1' : '0') . '*scoutremove_border*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['remove_border'] ? '1' : '0');
           }
           $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_appointments_adm_validar@SC_par@" . md5($Parms_Lig);
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
       } else {
           $Md5_Lig = "nmgp_lig_edit_lapis*scinS*scoutnmgp_opcao*scinigual*scoutappointments_id*scin" . str_replace("'", "@aspass@", $this->appointments_id) . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scoutsc_redir_atualiz*scinok*scoutNMSC_modal*scinok*scout";
       }
   $nm_saida->saida("<a  id=\"id_sc_field_accion_rechazar_" . $this->SC_seq_page . "\" href=\"javascript:nm_gp_submit5('" . $this->Ini->link_form_appointments_edit . "', '$this->nm_location', '$Md5_Lig', '" . (isset($linkTarget) ? $linkTarget : 'modal') . "', '', '500', '630', '', 'form_appointments', '" . $this->SC_ancora . "')\" onMouseover=\"nm_mostra_hint(this, event, '')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_accion_rechazar_grid_line . "\" style=\"" . $this->Css_Cmp['css_accion_rechazar_grid_line'] . "\">" . $conteudo . "</a>\r\n");
} else {
   $nm_saida->saida(" <span id=\"id_sc_field_accion_rechazar_" . $this->SC_seq_page . "\">$conteudo </span>\r\n");
       } 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_hisoria()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['hisoria']) || $this->NM_cmp_hidden['hisoria'] != "off") { 
          $conteudo = ""; 
          $conteudo_original = ""; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_hisoria_grid_line . "\"  style=\"" . $this->Css_Cmp['css_hisoria_grid_line'] . "\"  align=\"\" valign=\"top\"  >\r\n");
          if (!$this->Ini->Proc_print && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida_treeview'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] != "pdf")
          { 
              $link_div = "";
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['ind_tree']++;
              $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['ind_tree'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['grid_appointments_history'][$this->NM_cont_body][1] = 'top';
              if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp)
              { 
                  $link_div  = "<img id=\"b_open_grid_appointments_history_" . $this->NM_cont_body . "\" style=\"display:''\" onclick=\"document.getElementById('b_open_grid_appointments_history_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_close_grid_appointments_history_" . $this->NM_cont_body . "').style.display = ''; NM_liga_tbody(" . $this->NM_cont_body . ", NM_tab_grid_appointments_history, 'grid_appointments_history'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">";
                  $link_div .= "<img id=\"b_close_grid_appointments_history_" . $this->NM_cont_body . "\" style=\"display:none\" onclick=\"document.getElementById('b_close_grid_appointments_history_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_open_grid_appointments_history_" . $this->NM_cont_body . "').style.display = ''; NM_apaga_tbody(" . $this->NM_cont_body . ", NM_tab_grid_appointments_history, 'grid_appointments_history'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">";
              }
              $nm_saida->saida("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">");
              $nm_saida->saida("<TR> <TD align=\"left\">");
              $nm_saida->saida("<DIV id=\"tbody_grid_appointments_history_" . $this->NM_cont_body . "_top\" style=\"display:''\">");
              $nm_saida->saida($link_div . "</DIV></TD></TR>");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['ind_tree']++;
              $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['ind_tree'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['grid_appointments_history'][$this->NM_cont_body][1] = 'bot';
              $nm_saida->saida("<tr><td>");
              if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp)
              { 
                  $nm_saida->saida("<DIV id=\"tbody_grid_appointments_history_" . $this->NM_cont_body . "_bot\" style=\"display:none\">");
              }
              else
              { 
                  $nm_saida->saida("<DIV id=\"tbody_grid_appointments_history_" . $this->NM_cont_body . "_bot\" style=\"display:''\">");
              }
          }
          $GLOBALS["script_case_init"] = $this->Ini->sc_page;
          $GLOBALS["nmgp_parms"] = "nmgp_lig_edit_lapis?#?S?@?id_horario?#?" . str_replace("'", "@aspass@", $this->appointments_id) . "?@?";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida_opcao'] = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['doc_word']) ? "doc_word" : $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'];
          if (method_exists($this->grid_appointments_history, "controle"))
          {
              $this->grid_appointments_history->controle();
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = false;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['emb_lig_aba']))
          { 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['emb_lig_aba'] = array_merge($this->Ini->Init_apl_lig, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['emb_lig_aba']);
              }
              else 
              { 
                 $this->Ini->Init_apl_lig = array_merge($this->Ini->Init_apl_lig, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['emb_lig_aba']);
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida_treeview'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] != "pdf")
          { 
              $nm_saida->saida("</DIV></td></tr>");
              $nm_saida->saida("</table>");
          }
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_appointments_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->appointments_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->appointments_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_appointments_id_grid_line . "\"  style=\"" . $this->Css_Cmp['css_appointments_id_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_appointments_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 16;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] || $this->NM_btn_run_show)
   {
       $this->NM_colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] == "pdf")
   {
       $this->NM_colspan--;
   } 
   foreach ($this->NM_cmp_hidden as $Cmp => $Hidden)
   {
       if ($Hidden == "off")
       {
           $this->NM_colspan--;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
   {
       $this->NM_colspan--;
   }
 }
 function nm_quebra_pagina($nm_parms)
 {
    global $nm_saida;
    if ($this->nmgp_prim_pag_pdf && $nm_parms == "pagina")
    {
        $this->nmgp_prim_pag_pdf = false;
        return;
    }
    $this->Ini->nm_cont_lin++;
    if (($this->Ini->nm_limite_lin > 0 && $this->Ini->nm_cont_lin > $this->Ini->nm_limite_lin) || $nm_parms == "pagina" || $nm_parms == "resumo" || $nm_parms == "total")
    {
        $nm_saida->saida("</TABLE></TD></TR>\r\n");
        $this->Ini->nm_cont_lin = ($nm_parms == "pagina") ? 0 : 1;
        if ($this->Print_All)
        {
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['print_navigator']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['print_navigator'] == "Netscape")
            {
                $nm_saida->saida("</TABLE><TABLE id=\"main_table_grid\" style=\"page-break-before:always;\" align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
            }
            else
            {
                $nm_saida->saida("</TABLE><TABLE id=\"main_table_grid\" class=\"scGridBorder\" style=\"page-break-before:always;\" align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
            }
        }
        else
        {
            $nm_saida->saida("</table><div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div><table width='100%' cellspacing=0 cellpadding=0>\r\n");
        }
        if ($nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
        {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf']) { 
           }
           else
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) { 
                $nm_saida->saida("     <thead>\r\n");
               }
               $this->cabecalho();
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) { 
                $nm_saida->saida("     </thead>\r\n");
               }
           }
        }
        $nm_saida->saida(" <TR> \r\n");
        $nm_saida->saida("  <TD style=\"padding: 0px; vertical-align: top;\"> \r\n");
        $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] && ($this->pdf_all_cab == "S" || $this->pdf_all_label == "S")) { 
            $nm_saida->saida(" <thead> \r\n");
            if ($this->pdf_all_cab == "S")
            {
                $this->cabecalho();
            }
            if ($this->pdf_all_label == "S" && $nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
            {
                $this->label_grid();
            }
            $nm_saida->saida(" </thead> \r\n");
        }
        if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] && $nm_parms != "resumo" && $nm_parms != "pagina" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
        {
            $this->label_grid();
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] && $this->pdf_label_group != "S" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
        {
            $this->nm_inicio_pag = 0;
        }
    }
 }
 function quebra_appointment_start_date_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global $$Var_name_gb, $Desc_Gb_Ant;
   $this->sc_proc_quebra_id_usuario = false;
   $this->sc_proc_quebra_current_status_id = false;
   $this->sc_proc_quebra_id_proyecto = false;
   $this->sc_proc_quebra_id_actividad = false;
   $this->sc_proc_quebra_appointment_start_date = true; 
   $this->Tot->quebra_appointment_start_date_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name);
   $tot_appointment_start_date = $$Var_name_gb;
   $conteudo = $tot_appointment_start_date[0] ;  
   $this->count_appointment_start_date = $tot_appointment_start_date[1];
   $this->sum_appointment_start_date_intervalo = $tot_appointment_start_date[2];
   $Temp_cmp_quebra = array(); 
   $conteudo = NM_encode_input(sc_strip_script($this->appointment_start_date)); 
   $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $Cmp_Name);
   $Prefix_dat = $this->Ini->Get_Gb_prefix_date_format('sc_free_group_by', $Cmp_Name);
   $TP_Time    = (in_array($Cmp_Name, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
   $conteudo = $this->Ini->GB_date_format($TP_Time . $conteudo, $Format_tst, $Prefix_dat); 
   $Temp_cmp_quebra[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['appointment_start_date']))
   {
       $Temp_cmp_quebra[0]['lab'] = $this->nmgp_label_quebras['appointment_start_date']; 
   }
   else
   {
       $Temp_cmp_quebra[0]['lab'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . ""; 
   }
   $this->$Cmps_Gb_Free = $Temp_cmp_quebra;
   $this->sc_proc_quebra_appointment_start_date = false; 
 } 
 function quebra_id_usuario_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global $$Var_name_gb, $Desc_Gb_Ant;
   $this->sc_proc_quebra_appointment_start_date = false;
   $this->sc_proc_quebra_current_status_id = false;
   $this->sc_proc_quebra_id_proyecto = false;
   $this->sc_proc_quebra_id_actividad = false;
   $this->sc_proc_quebra_id_usuario = true; 
   $this->Tot->quebra_id_usuario_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name);
   $tot_id_usuario = $$Var_name_gb;
   $conteudo = $tot_id_usuario[0] ;  
   $this->count_id_usuario = $tot_id_usuario[1];
   $this->sum_id_usuario_intervalo = $tot_id_usuario[2];
   $Temp_cmp_quebra = array(); 
   $conteudo = NM_encode_input(sc_strip_script($this->id_usuario)); 
   $this->Lookup->lookup_sc_free_group_by_id_usuario($conteudo , $this->id_usuario) ; 
   $Temp_cmp_quebra[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['id_usuario']))
   {
       $Temp_cmp_quebra[0]['lab'] = $this->nmgp_label_quebras['id_usuario']; 
   }
   else
   {
       $Temp_cmp_quebra[0]['lab'] = "Usuario"; 
   }
   $this->$Cmps_Gb_Free = $Temp_cmp_quebra;
   $this->sc_proc_quebra_id_usuario = false; 
 } 
 function quebra_current_status_id_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global $$Var_name_gb, $Desc_Gb_Ant;
   $this->sc_proc_quebra_appointment_start_date = false;
   $this->sc_proc_quebra_id_usuario = false;
   $this->sc_proc_quebra_id_proyecto = false;
   $this->sc_proc_quebra_id_actividad = false;
   $this->sc_proc_quebra_current_status_id = true; 
   $this->Tot->quebra_current_status_id_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name);
   $tot_current_status_id = $$Var_name_gb;
   $conteudo = $tot_current_status_id[0] ;  
   $this->count_current_status_id = $tot_current_status_id[1];
   $this->sum_current_status_id_intervalo = $tot_current_status_id[2];
   $Temp_cmp_quebra = array(); 
   $conteudo = NM_encode_input(sc_strip_script($this->current_status_id)); 
   $this->Lookup->lookup_sc_free_group_by_current_status_id($conteudo , $this->current_status_id) ; 
   $Temp_cmp_quebra[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['current_status_id']))
   {
       $Temp_cmp_quebra[0]['lab'] = $this->nmgp_label_quebras['current_status_id']; 
   }
   else
   {
       $Temp_cmp_quebra[0]['lab'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . ""; 
   }
   $this->$Cmps_Gb_Free = $Temp_cmp_quebra;
   $this->sc_proc_quebra_current_status_id = false; 
 } 
 function quebra_id_proyecto_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global $$Var_name_gb, $Desc_Gb_Ant;
   $this->sc_proc_quebra_appointment_start_date = false;
   $this->sc_proc_quebra_id_usuario = false;
   $this->sc_proc_quebra_current_status_id = false;
   $this->sc_proc_quebra_id_actividad = false;
   $this->sc_proc_quebra_id_proyecto = true; 
   $this->Tot->quebra_id_proyecto_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name);
   $tot_id_proyecto = $$Var_name_gb;
   $conteudo = $tot_id_proyecto[0] ;  
   $this->count_id_proyecto = $tot_id_proyecto[1];
   $this->sum_id_proyecto_intervalo = $tot_id_proyecto[2];
   $Temp_cmp_quebra = array(); 
   $conteudo = NM_encode_input(sc_strip_script($this->id_proyecto)); 
   $this->Lookup->lookup_sc_free_group_by_id_proyecto($conteudo , $this->id_proyecto) ; 
   $Temp_cmp_quebra[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['id_proyecto']))
   {
       $Temp_cmp_quebra[0]['lab'] = $this->nmgp_label_quebras['id_proyecto']; 
   }
   else
   {
       $Temp_cmp_quebra[0]['lab'] = "Proyecto"; 
   }
   $this->$Cmps_Gb_Free = $Temp_cmp_quebra;
   $this->sc_proc_quebra_id_proyecto = false; 
 } 
 function quebra_id_actividad_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global $$Var_name_gb, $Desc_Gb_Ant;
   $this->sc_proc_quebra_appointment_start_date = false;
   $this->sc_proc_quebra_id_usuario = false;
   $this->sc_proc_quebra_current_status_id = false;
   $this->sc_proc_quebra_id_proyecto = false;
   $this->sc_proc_quebra_id_actividad = true; 
   $this->Tot->quebra_id_actividad_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name);
   $tot_id_actividad = $$Var_name_gb;
   $conteudo = $tot_id_actividad[0] ;  
   $this->count_id_actividad = $tot_id_actividad[1];
   $this->sum_id_actividad_intervalo = $tot_id_actividad[2];
   $Temp_cmp_quebra = array(); 
   $conteudo = NM_encode_input(sc_strip_script($this->id_actividad)); 
   $this->Lookup->lookup_sc_free_group_by_id_actividad($conteudo , $this->id_actividad) ; 
   $Temp_cmp_quebra[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['id_actividad']))
   {
       $Temp_cmp_quebra[0]['lab'] = $this->nmgp_label_quebras['id_actividad']; 
   }
   else
   {
       $Temp_cmp_quebra[0]['lab'] = "Tipo Actividad"; 
   }
   $this->$Cmps_Gb_Free = $Temp_cmp_quebra;
   $this->sc_proc_quebra_id_actividad = false; 
 } 
 function quebra_current_status_id_status($current_status_id) 
 {
   global $tot_current_status_id;
   $this->sc_proc_quebra_current_status_id = true; 
   $this->Tot->quebra_current_status_id_status($current_status_id, $this->arg_sum_current_status_id);
   $conteudo = $tot_current_status_id[0] ;  
   $this->count_current_status_id = $tot_current_status_id[1];
   $this->sum_current_status_id_intervalo = $tot_current_status_id[2];
   $this->campos_quebra_current_status_id = array(); 
   $conteudo = NM_encode_input(sc_strip_script($this->current_status_id)); 
   $this->Lookup->lookup_status_current_status_id($conteudo , $this->current_status_id) ; 
   $this->campos_quebra_current_status_id[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['current_status_id']))
   {
       $this->campos_quebra_current_status_id[0]['lab'] = $this->nmgp_label_quebras['current_status_id']; 
   }
   else
   {
   $this->campos_quebra_current_status_id[0]['lab']  = "" . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . ""; 
   }
   $this->sc_proc_quebra_current_status_id = false; 
 } 
 function quebra_appointment_start_date_sc_free_group_by_top($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_appointment_start_date = $$Var_name_gb;
   $this->SC_tab_quebra = (count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']) > 1) ? 10 * $this->Tab_Nv_tree['appointment_start_date'] : 0;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
   static $cont_quebra_appointment_start_date = 0; 
   $cont_quebra_appointment_start_date++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H2 style=\"font-size:0;padding:1px\">" .  $this->$Cmps_Gb_Free[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H2></div>";
   }
   $conteudo = $tot_appointment_start_date[0] ;  
    $thisColspan = 2;
   if ($this->SC_sep_quebra)
   {
       $this->SC_sep_quebra = false;
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) { 
         } else {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_saida->saida("<tr>\r\n");
   $nm_saida->saida("<td class=\"" . $this->css_scGridBlockSpaceBg . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
   $nm_saida->saida("</tr>\r\n");
         }
   }
   $colspan = $this->NM_colspan;
   $this->Label_appointment_start_date = "<table>"; 
   $Cmps_gb = $this->$Cmps_Gb_Free;
   foreach ($Cmps_gb as $cada_campo) 
   { 
       $this->Label_appointment_start_date .= "<tr>"; 
       if ($this->SC_tab_quebra > 0 && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
       {
           $this->Label_appointment_start_date .= "<td class=\"" . $this->css_scGridBlockLineBg . "\" style=\"width: " . $this->SC_tab_quebra . "px;\">&nbsp;</td>"; 
       }
       $this->Label_appointment_start_date .= "<td>" . $cada_campo['lab'] . "</td><td> => </td>";
       $this->Label_appointment_start_date .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_appointment_start_date .= "</tr>"; 
   } 
   $this->Label_appointment_start_date .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_appointment_start_date . $nm_fecha_pdf_old . "</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_appointment_start_date_sc_free_group_by_bot($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global 
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_appointment_start_date = $$Var_name_gb;
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
   $tit_lin_sumariza_atu = "Total Horas Mes / Año";
   $colspan  = 1;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] || $this->NM_btn_run_show)
   {
       $colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] == "pdf")
   {
       $colspan--;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "id_proyecto" && (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_usuario" && (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_actividad" && (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "nombre" && (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "current_status_id" && (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_date" && (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_time" && (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_end_time" && (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "intervalo" && (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo =  $tot_appointment_start_date[2] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . " css_intervalo_sub_tot\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "accion_revertir" && (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_aprobar" && (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_rechazar" && (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointments_id" && (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
       $nm_saida->saida("    </TR>\r\n");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_id_usuario_sc_free_group_by_top($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_id_usuario = $$Var_name_gb;
   $this->SC_tab_quebra = (count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']) > 1) ? 10 * $this->Tab_Nv_tree['id_usuario'] : 0;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
   static $cont_quebra_id_usuario = 0; 
   $cont_quebra_id_usuario++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H3 style=\"font-size:0;padding:1px\">" .  $this->$Cmps_Gb_Free[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H3></div>";
   }
   $conteudo = $tot_id_usuario[0] ;  
    $thisColspan = 2;
   if ($this->SC_sep_quebra)
   {
       $this->SC_sep_quebra = false;
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) { 
         } else {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_saida->saida("<tr>\r\n");
   $nm_saida->saida("<td class=\"" . $this->css_scGridBlockSpaceBg . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
   $nm_saida->saida("</tr>\r\n");
         }
   }
   $colspan = $this->NM_colspan;
   $this->Label_id_usuario = "<table>"; 
   $Cmps_gb = $this->$Cmps_Gb_Free;
   foreach ($Cmps_gb as $cada_campo) 
   { 
       $this->Label_id_usuario .= "<tr>"; 
       if ($this->SC_tab_quebra > 0 && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
       {
           $this->Label_id_usuario .= "<td class=\"" . $this->css_scGridBlockLineBg . "\" style=\"width: " . $this->SC_tab_quebra . "px;\">&nbsp;</td>"; 
       }
       $this->Label_id_usuario .= "<td>" . $cada_campo['lab'] . "</td><td> => </td>";
       $this->Label_id_usuario .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_id_usuario .= "</tr>"; 
   } 
   $this->Label_id_usuario .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_id_usuario . $nm_fecha_pdf_old . "</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_id_usuario_sc_free_group_by_bot($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global 
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_id_usuario = $$Var_name_gb;
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
   $tit_lin_sumariza_atu = "Total Horas Usuario";
   $colspan  = 1;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] || $this->NM_btn_run_show)
   {
       $colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] == "pdf")
   {
       $colspan--;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "id_proyecto" && (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_usuario" && (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_actividad" && (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "nombre" && (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "current_status_id" && (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_date" && (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_time" && (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_end_time" && (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "intervalo" && (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo =  $tot_id_usuario[2] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . " css_intervalo_sub_tot\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "accion_revertir" && (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_aprobar" && (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_rechazar" && (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointments_id" && (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
       $nm_saida->saida("    </TR>\r\n");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_current_status_id_sc_free_group_by_top($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_current_status_id = $$Var_name_gb;
   $this->SC_tab_quebra = (count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']) > 1) ? 10 * $this->Tab_Nv_tree['current_status_id'] : 0;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
   static $cont_quebra_current_status_id = 0; 
   $cont_quebra_current_status_id++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H4 style=\"font-size:0;padding:1px\">" .  $this->$Cmps_Gb_Free[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H4></div>";
   }
   $conteudo = $tot_current_status_id[0] ;  
    $thisColspan = 2;
   if ($this->SC_sep_quebra)
   {
       $this->SC_sep_quebra = false;
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) { 
         } else {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_saida->saida("<tr>\r\n");
   $nm_saida->saida("<td class=\"" . $this->css_scGridBlockSpaceBg . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
   $nm_saida->saida("</tr>\r\n");
         }
   }
   $colspan = $this->NM_colspan;
   $this->Label_current_status_id = "<table>"; 
   $Cmps_gb = $this->$Cmps_Gb_Free;
   foreach ($Cmps_gb as $cada_campo) 
   { 
       $this->Label_current_status_id .= "<tr>"; 
       if ($this->SC_tab_quebra > 0 && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
       {
           $this->Label_current_status_id .= "<td class=\"" . $this->css_scGridBlockLineBg . "\" style=\"width: " . $this->SC_tab_quebra . "px;\">&nbsp;</td>"; 
       }
       $this->Label_current_status_id .= "<td>" . $cada_campo['lab'] . "</td><td> => </td>";
       $this->Label_current_status_id .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_current_status_id .= "</tr>"; 
   } 
   $this->Label_current_status_id .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_current_status_id . $nm_fecha_pdf_old . "</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_current_status_id_sc_free_group_by_bot($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global 
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_current_status_id = $$Var_name_gb;
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
   $tit_lin_sumariza_atu = "Total Horas Estado";
   $colspan  = 1;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] || $this->NM_btn_run_show)
   {
       $colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] == "pdf")
   {
       $colspan--;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "id_proyecto" && (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_usuario" && (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_actividad" && (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "nombre" && (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "current_status_id" && (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_date" && (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_time" && (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_end_time" && (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "intervalo" && (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo =  $tot_current_status_id[2] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . " css_intervalo_sub_tot\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "accion_revertir" && (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_aprobar" && (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_rechazar" && (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointments_id" && (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
       $nm_saida->saida("    </TR>\r\n");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_id_proyecto_sc_free_group_by_top($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_id_proyecto = $$Var_name_gb;
   $this->SC_tab_quebra = (count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']) > 1) ? 10 * $this->Tab_Nv_tree['id_proyecto'] : 0;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
   static $cont_quebra_id_proyecto = 0; 
   $cont_quebra_id_proyecto++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H5 style=\"font-size:0;padding:1px\">" .  $this->$Cmps_Gb_Free[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H5></div>";
   }
   $conteudo = $tot_id_proyecto[0] ;  
    $thisColspan = 2;
   if ($this->SC_sep_quebra)
   {
       $this->SC_sep_quebra = false;
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) { 
         } else {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_saida->saida("<tr>\r\n");
   $nm_saida->saida("<td class=\"" . $this->css_scGridBlockSpaceBg . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
   $nm_saida->saida("</tr>\r\n");
         }
   }
   $colspan = $this->NM_colspan;
   $this->Label_id_proyecto = "<table>"; 
   $Cmps_gb = $this->$Cmps_Gb_Free;
   foreach ($Cmps_gb as $cada_campo) 
   { 
       $this->Label_id_proyecto .= "<tr>"; 
       if ($this->SC_tab_quebra > 0 && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
       {
           $this->Label_id_proyecto .= "<td class=\"" . $this->css_scGridBlockLineBg . "\" style=\"width: " . $this->SC_tab_quebra . "px;\">&nbsp;</td>"; 
       }
       $this->Label_id_proyecto .= "<td>" . $cada_campo['lab'] . "</td><td> => </td>";
       $this->Label_id_proyecto .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_id_proyecto .= "</tr>"; 
   } 
   $this->Label_id_proyecto .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_id_proyecto . $nm_fecha_pdf_old . "</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_id_proyecto_sc_free_group_by_bot($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global 
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_id_proyecto = $$Var_name_gb;
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
   $tit_lin_sumariza_atu = "Total Horas Proyecto";
   $colspan  = 1;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] || $this->NM_btn_run_show)
   {
       $colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] == "pdf")
   {
       $colspan--;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "id_proyecto" && (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_usuario" && (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_actividad" && (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "nombre" && (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "current_status_id" && (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_date" && (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_time" && (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_end_time" && (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "intervalo" && (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo =  $tot_id_proyecto[2] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . " css_intervalo_sub_tot\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "accion_revertir" && (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_aprobar" && (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_rechazar" && (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointments_id" && (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
       $nm_saida->saida("    </TR>\r\n");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_id_actividad_sc_free_group_by_top($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_id_actividad = $$Var_name_gb;
   $this->SC_tab_quebra = (count($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']) > 1) ? 10 * $this->Tab_Nv_tree['id_actividad'] : 0;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
   static $cont_quebra_id_actividad = 0; 
   $cont_quebra_id_actividad++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H6 style=\"font-size:0;padding:1px\">" .  $this->$Cmps_Gb_Free[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H6></div>";
   }
   $conteudo = $tot_id_actividad[0] ;  
    $thisColspan = 2;
   if ($this->SC_sep_quebra)
   {
       $this->SC_sep_quebra = false;
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) { 
         } else {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_saida->saida("<tr>\r\n");
   $nm_saida->saida("<td class=\"" . $this->css_scGridBlockSpaceBg . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
   $nm_saida->saida("</tr>\r\n");
         }
   }
   $colspan = $this->NM_colspan;
   $this->Label_id_actividad = "<table>"; 
   $Cmps_gb = $this->$Cmps_Gb_Free;
   foreach ($Cmps_gb as $cada_campo) 
   { 
       $this->Label_id_actividad .= "<tr>"; 
       if ($this->SC_tab_quebra > 0 && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
       {
           $this->Label_id_actividad .= "<td class=\"" . $this->css_scGridBlockLineBg . "\" style=\"width: " . $this->SC_tab_quebra . "px;\">&nbsp;</td>"; 
       }
       $this->Label_id_actividad .= "<td>" . $cada_campo['lab'] . "</td><td> => </td>";
       $this->Label_id_actividad .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_id_actividad .= "</tr>"; 
   } 
   $this->Label_id_actividad .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_id_actividad . $nm_fecha_pdf_old . "</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_id_actividad_sc_free_group_by_bot($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global 
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_id_actividad = $$Var_name_gb;
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
   $tit_lin_sumariza_atu = "Total Horas Tipo Actividad";
   $colspan  = 1;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] || $this->NM_btn_run_show)
   {
       $colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] == "pdf")
   {
       $colspan--;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "id_proyecto" && (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_usuario" && (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_actividad" && (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "nombre" && (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "current_status_id" && (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_date" && (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_time" && (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_end_time" && (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "intervalo" && (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo =  $tot_id_actividad[2] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . " css_intervalo_sub_tot\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "accion_revertir" && (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_aprobar" && (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_rechazar" && (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointments_id" && (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
       $nm_saida->saida("    </TR>\r\n");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_current_status_id_status_top() 
 { global
          $current_status_id_ant_desc, 
          $nm_saida, $tot_current_status_id;
   $this->SC_tab_quebra = 0;
   $current_status_id_ant_desc = $this->campos_quebra_current_status_id[0]['cmp'];
   static $cont_quebra_current_status_id = 0; 
   $cont_quebra_current_status_id++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H2 style=\"font-size:0;padding:1px\">" .  $this->campos_quebra_current_status_id[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H2></div>";
   }
   $conteudo = $tot_current_status_id[0] ;  
    $thisColspan = 2;
   if ($this->SC_sep_quebra)
   {
       $this->SC_sep_quebra = false;
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert']) { 
         } else {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_saida->saida("<tr>\r\n");
   $nm_saida->saida("<td class=\"" . $this->css_scGridBlockSpaceBg . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
   $nm_saida->saida("</tr>\r\n");
         }
   }
   $colspan = $this->NM_colspan;
   $this->Label_current_status_id = "<table>"; 
   foreach ($this->campos_quebra_current_status_id as $cada_campo) 
   { 
       $this->Label_current_status_id .= "<tr>"; 
       if ($this->SC_tab_quebra > 0 && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'])
       {
           $this->Label_current_status_id .= "<td class=\"" . $this->css_scGridBlockLineBg . "\" style=\"width: " . $this->SC_tab_quebra . "px;\">&nbsp;</td>"; 
       }
       $this->Label_current_status_id .= "<td>" . $cada_campo['lab'] . "</td><td> => </td>";
       $this->Label_current_status_id .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_current_status_id .= "</tr>"; 
   } 
   $this->Label_current_status_id .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_current_status_id . $nm_fecha_pdf_old . "</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_current_status_id_status_bot() 
 { global 
          $current_status_id_ant_desc, 
          $nm_saida, $tot_current_status_id;
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $current_status_id_ant_desc = $this->campos_quebra_current_status_id[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
   $tit_lin_sumariza_atu = "Total Horas Estado";
   $colspan  = 1;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] || $this->NM_btn_run_show)
   {
       $colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] == "pdf")
   {
       $colspan--;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "id_proyecto" && (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_usuario" && (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "id_actividad" && (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "nombre" && (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "current_status_id" && (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_date" && (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_start_time" && (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointment_end_time" && (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "intervalo" && (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo =  $tot_current_status_id[2] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . " css_intervalo_sub_tot\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "accion_revertir" && (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_aprobar" && (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "accion_rechazar" && (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "appointments_id" && (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
       $nm_saida->saida("    </TR>\r\n");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_geral_sc_free_group_by_top() 
 {
   global $nm_saida; 
   $this->NM_calc_span();
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
    $nm_saida->saida("<tr>\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
        $nm_saida->saida("<td class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . "; height: 10px;\">&nbsp;</td>\r\n");
   }
    $nm_saida->saida("<td class=\"" . $this->css_scGridTotal . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
    $nm_saida->saida("</tr>\r\n");
 }
 function quebra_geral_sc_free_group_by_bot() 
 {
   global 
          $nm_saida, $nm_data; 
   $this->Tot->quebra_geral_sc_free_group_by(); 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$this->Print_All)
   {
      $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" .  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][0] . "</H1></div>";
   }
   $tit_lin_sumariza      = $nm_nivel_book_pdf . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][0];
   $tit_lin_sumariza_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][0];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra  . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
   $tit_lin_sumariza_atu = $tit_lin_sumariza;
   $colspan  = 1;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] || $this->NM_btn_run_show)
   {
       $colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] == "pdf")
   {
       $colspan--;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "id_proyecto" && (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "id_usuario" && (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "id_actividad" && (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "nombre" && (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "current_status_id" && (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "appointment_start_date" && (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "appointment_start_time" && (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "appointment_end_time" && (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "intervalo" && (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][2] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_intervalo_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "accion_revertir" && (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "accion_aprobar" && (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "accion_rechazar" && (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "appointments_id" && (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off"))
    {
       $colspan++;
    }
   }
   if ($colspan > 0)
   {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\"   " . "colspan=\"" . $colspan . "\"" . ">&nbsp;</TD>\r\n");
       $nm_saida->saida("    </TR>\r\n");
   }
 } 
 function quebra_geral_status_top() 
 {
   global $nm_saida; 
   $this->NM_calc_span();
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
    $nm_saida->saida("<tr>\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
        $nm_saida->saida("<td class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . "; height: 10px;\">&nbsp;</td>\r\n");
   }
    $nm_saida->saida("<td class=\"" . $this->css_scGridTotal . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
    $nm_saida->saida("</tr>\r\n");
 }
 function quebra_geral_status_bot() 
 {
   global 
          $nm_saida, $nm_data; 
   $this->Tot->quebra_geral_status(); 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" && !$this->Print_All)
   {
      $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" .  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][0] . "</H1></div>";
   }
   $tit_lin_sumariza      = $nm_nivel_book_pdf . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][0];
   $tit_lin_sumariza_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][0];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_grid']) {
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra  . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
   $tit_lin_sumariza_atu = $tit_lin_sumariza;
   $colspan  = 1;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] || $this->NM_btn_run_show)
   {
       $colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_pdf'] == "pdf")
   {
       $colspan--;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "id_proyecto" && (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "id_usuario" && (!isset($this->NM_cmp_hidden['id_usuario']) || $this->NM_cmp_hidden['id_usuario'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "id_actividad" && (!isset($this->NM_cmp_hidden['id_actividad']) || $this->NM_cmp_hidden['id_actividad'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "nombre" && (!isset($this->NM_cmp_hidden['nombre']) || $this->NM_cmp_hidden['nombre'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "current_status_id" && (!isset($this->NM_cmp_hidden['current_status_id']) || $this->NM_cmp_hidden['current_status_id'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "appointment_start_date" && (!isset($this->NM_cmp_hidden['appointment_start_date']) || $this->NM_cmp_hidden['appointment_start_date'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "appointment_start_time" && (!isset($this->NM_cmp_hidden['appointment_start_time']) || $this->NM_cmp_hidden['appointment_start_time'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "appointment_end_time" && (!isset($this->NM_cmp_hidden['appointment_end_time']) || $this->NM_cmp_hidden['appointment_end_time'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "intervalo" && (!isset($this->NM_cmp_hidden['intervalo']) || $this->NM_cmp_hidden['intervalo'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][2] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_intervalo_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "accion_revertir" && (!isset($this->NM_cmp_hidden['accion_revertir']) || $this->NM_cmp_hidden['accion_revertir'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "accion_aprobar" && (!isset($this->NM_cmp_hidden['accion_aprobar']) || $this->NM_cmp_hidden['accion_aprobar'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "accion_rechazar" && (!isset($this->NM_cmp_hidden['accion_rechazar']) || $this->NM_cmp_hidden['accion_rechazar'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "appointments_id" && (!isset($this->NM_cmp_hidden['appointments_id']) || $this->NM_cmp_hidden['appointments_id'] != "off"))
    {
       $colspan++;
    }
   }
   if ($colspan > 0)
   {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\"   " . "colspan=\"" . $colspan . "\"" . ">&nbsp;</TD>\r\n");
       $nm_saida->saida("    </TR>\r\n");
   }
 } 
   function nm_conv_data_db($dt_in, $form_in, $form_out)
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
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function nmgp_barra_top_normal()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn  = false;
      $NM_Gbtn = false;
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_top) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_top {\r\n");
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            top: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 7;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 0px 1px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-top: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        }*/\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr id=\"sc_grid_toobar_top_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
          {
              $this->Ini->Arr_result['setVar'][] = array('var' => 'change_fast_top', 'value' => "");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_cmp))
          {
              $OPC_cmp = NM_conv_charset($OPC_cmp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_arg))
          {
              $OPC_arg = NM_conv_charset($OPC_arg, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_dat))
          {
              $OPC_dat = NM_conv_charset($OPC_dat, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
          $nm_saida->saida("          <input type=\"hidden\"  id=\"fast_search_f0_top\" name=\"nmgp_fast_search\" value=\"SC_all_Cmp\">\r\n");
          $nm_saida->saida("          <select id=\"cond_fast_search_f0_top\" class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;display:none;\" name=\"nmgp_cond_fast_search\" onChange=\"change_fast_top = 'CH';\">\r\n");
          $OPC_sel = " selected='selected'";
          $nm_saida->saida("           <option value=\"qp\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>\r\n");
          $nm_saida->saida("          </select>\r\n");
          $nm_saida->saida("          <span id=\"quicksearchph_top\" class=\"" . $this->css_css_toolbar_obj . "\" style='position: relative; display: inline-block; vertical-align: inherit;'>\r\n");
          $nm_saida->saida("           <span>\r\n");
          $nm_saida->saida("             <input type=\"text\" id=\"SC_fast_search_top\" class=\"" . $this->css_css_toolbar_obj . "_text\" style=\"border-width: 0px;\" name=\"nmgp_arg_fast_search\" value=\"" . NM_encode_input($OPC_dat) . "\" size=\"10\" onChange=\"change_fast_top = 'CH';\" alt=\"{maxLength: 255}\" placeholder=\"" . $this->Ini->Nm_lang['lang_othr_qk_watermark'] . "\">&nbsp;\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconSearch . "\" id=\"SC_fast_search_submit_top\" class='css_toolbar_obj_qs_search_img' src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_search . "\" onclick=\"nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconClose . "\" class='css_toolbar_obj_qs_search_img' id=\"SC_fast_search_close_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "\" onclick=\"document.getElementById('SC_fast_search_top').value = '__Clear_Fast__'; nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("            </span>\r\n");
          $nm_saida->saida("          </span>");
          $NM_btn = true;
      }
      if ($this->nmgp_botoes['dynsearch'] == "on" && !$this->grid_emb_form && !$this->NM_hidden_filters)
      {
              $this->nm_btn_exist['dynsearch'][] = "dynamic_search_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bdynamicsearch", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "dynamic_search_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['APROBAR'] == "on" && !$this->grid_emb_form) 
      { 
          $this->nm_btn_exist['APROBAR'][] = "sc_APROBAR_top";
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "APROBAR", "sc_btn_APROBAR();", "sc_btn_APROBAR();", "sc_APROBAR_top", "", "<font color=red></b>APROBAR REGISTROS SELECCIONADOS</b></font>", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("          $Cod_Btn \r\n");
          $NM_btn = true;
      } 
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['RECHAZAR'] == "on" && !$this->grid_emb_form) 
      { 
          $this->nm_btn_exist['RECHAZAR'][] = "sc_RECHAZAR_top";
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "RECHAZAR", "sc_btn_RECHAZAR();", "sc_btn_RECHAZAR();", "sc_RECHAZAR_top", "", "<font color=red></b>RECHAZAR REGISTROS SELECCIONADOS</b>", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("          $Cod_Btn \r\n");
          $NM_btn = true;
      } 
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_1_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'app', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&sc_ver_93=n&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=es&conf_socor=S&script_case_init=" . $this->Ini->sc_page . "&app_name=grid_appointments_adm_validar&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=AM&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid,resume,chart&password=n&origem=cons&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          $Xls_mod_export = "grid";
          if ($Tem_xls_res == "n")
          {
              $Xls_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0', '$Xls_mod_export');", "nm_gp_move('xls', '0', '$Xls_mod_export');", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          $Xml_mod_export = "grid";
          if ($Tem_xml_res == "n")
          {
              $Xml_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0', '$Xml_mod_export');", "nm_gp_move('xml', '0', '$Xml_mod_export');", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          $Csv_mod_export = "grid";
          if ($Tem_csv_res == "n")
          {
              $Csv_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '0', '$Csv_mod_export');", "nm_gp_move('csv', '0', '$Csv_mod_export');", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_move('rtf', '0');", "nm_gp_move('rtf', '0');", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=es&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid,resume,chart&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'app', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Groupby_hide']))
              {
                  $Q_count++;
                  if ($QB == "sc_free_group_by")
                  {
                      $Q_free = true;
                  }
              }
          }
          if ($Q_count > 1 || $Q_free)
          {
              $this->nm_btn_exist['groupby'][] = "sel_groupby_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "sel_groupby_top", "", "AGRUPAR POR", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
      }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']))
            { }
            else {
              $this->nm_btn_exist['summary'][] = "res_top";
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'])) {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "RESUMEN", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              else { 
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "RESUMEN", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              $nm_saida->saida("           $Cod_Btn \r\n");
                  $NM_btn = true;
            }
          }
          if (is_file("grid_appointments_adm_validar_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_appointments_adm_validar_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_bot_normal()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn  = false;
      $NM_Gbtn = false;
      $this->NM_calc_span();
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_bottom) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot {\r\n");
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            bottom: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 6;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 1px 0px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-bottom: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        } */\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_bot\" name=\"F0_bot\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_bot\" name=\"sc_truta_f0_bot\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_bot\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_bot\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr id=\"sc_grid_toobar_bot_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['qtline'] == "on" && $this->Ini->Apl_paginacao != "FULL")
          {
              $nm_saida->saida("          <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
              $nm_saida->saida("          <select class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" id=\"quant_linhas_f0_bot\" name=\"nmgp_quant_linhas\" onchange=\"sc_ind = document.getElementById('quant_linhas_f0_bot').selectedIndex; nm_gp_submit_ajax('muda_qt_linhas', document.getElementById('quant_linhas_f0_bot').options[sc_ind].value);\"> \r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_lin_grid'] == '10') ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_lin_grid'] == '20') ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['qt_lin_grid'] == '50') ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['first'][] = "first_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['back'][] = "back_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['rows'] == "on" && empty($this->nm_grid_sem_reg))
          {
              $nm_sumario = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
              $nm_sumario = str_replace("?start?", $this->nmgp_reg_inicial, $nm_sumario);
              if ($this->Ini->Apl_paginacao == "FULL")
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->count_ger."</span>", $nm_sumario);
              }
              else
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->nmgp_reg_final."</span>", $nm_sumario);
              }
              $nm_sumario = str_replace("?total?", "<span class='sm_counter_total'>".$this->count_ger."</span>", $nm_sumario);
              $nm_saida->saida("           <span class=\"summary_indicator " . $this->css_css_toolbar_obj . "\" style=\"border:0px;\"><span class='sm_counter'>" . $nm_sumario . "</span></span>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if (is_file("grid_appointments_adm_validar_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_appointments_adm_validar_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_bot', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top_mobile()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn  = false;
      $NM_Gbtn = false;
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_top) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_top {\r\n");
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            top: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 7;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 0px 1px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-top: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        }*/\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr id=\"sc_grid_toobar_top_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
          {
              $this->Ini->Arr_result['setVar'][] = array('var' => 'change_fast_top', 'value' => "");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_cmp))
          {
              $OPC_cmp = NM_conv_charset($OPC_cmp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_arg))
          {
              $OPC_arg = NM_conv_charset($OPC_arg, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_dat))
          {
              $OPC_dat = NM_conv_charset($OPC_dat, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
          $nm_saida->saida("          <input type=\"hidden\"  id=\"fast_search_f0_top\" name=\"nmgp_fast_search\" value=\"SC_all_Cmp\">\r\n");
          $nm_saida->saida("          <select id=\"cond_fast_search_f0_top\" class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;display:none;\" name=\"nmgp_cond_fast_search\" onChange=\"change_fast_top = 'CH';\">\r\n");
          $OPC_sel = " selected='selected'";
          $nm_saida->saida("           <option value=\"qp\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>\r\n");
          $nm_saida->saida("          </select>\r\n");
          $nm_saida->saida("          <span id=\"quicksearchph_top\" class=\"" . $this->css_css_toolbar_obj . "\" style='position: relative; display: inline-block; vertical-align: inherit;'>\r\n");
          $nm_saida->saida("           <span>\r\n");
          $nm_saida->saida("             <input type=\"text\" id=\"SC_fast_search_top\" class=\"" . $this->css_css_toolbar_obj . "_text\" style=\"border-width: 0px;\" name=\"nmgp_arg_fast_search\" value=\"" . NM_encode_input($OPC_dat) . "\" size=\"10\" onChange=\"change_fast_top = 'CH';\" alt=\"{maxLength: 255}\" placeholder=\"" . $this->Ini->Nm_lang['lang_othr_qk_watermark'] . "\">&nbsp;\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconSearch . "\" id=\"SC_fast_search_submit_top\" class='css_toolbar_obj_qs_search_img' src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_search . "\" onclick=\"nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconClose . "\" class='css_toolbar_obj_qs_search_img' id=\"SC_fast_search_close_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "\" onclick=\"document.getElementById('SC_fast_search_top').value = '__Clear_Fast__'; nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("            </span>\r\n");
          $nm_saida->saida("          </span>");
          $NM_btn = true;
      }
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_1_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'app', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&sc_ver_93=n&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=es&conf_socor=S&script_case_init=" . $this->Ini->sc_page . "&app_name=grid_appointments_adm_validar&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=AM&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid,resume,chart&password=n&origem=cons&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          $Xls_mod_export = "grid";
          if ($Tem_xls_res == "n")
          {
              $Xls_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0', '$Xls_mod_export');", "nm_gp_move('xls', '0', '$Xls_mod_export');", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          $Xml_mod_export = "grid";
          if ($Tem_xml_res == "n")
          {
              $Xml_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0', '$Xml_mod_export');", "nm_gp_move('xml', '0', '$Xml_mod_export');", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          $Csv_mod_export = "grid";
          if ($Tem_csv_res == "n")
          {
              $Csv_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '0', '$Csv_mod_export');", "nm_gp_move('csv', '0', '$Csv_mod_export');", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_move('rtf', '0');", "nm_gp_move('rtf', '0');", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=es&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid,resume,chart&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&sc_ver_93=n&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=es&conf_socor=S&script_case_init=" . $this->Ini->sc_page . "&app_name=grid_appointments_adm_validar&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=AM&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid,resume,chart&password=n&origem=cons&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          $Xls_mod_export = "grid";
          if ($Tem_xls_res == "n")
          {
              $Xls_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0', '$Xls_mod_export');", "nm_gp_move('xls', '0', '$Xls_mod_export');", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          $Xml_mod_export = "grid";
          if ($Tem_xml_res == "n")
          {
              $Xml_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0', '$Xml_mod_export');", "nm_gp_move('xml', '0', '$Xml_mod_export');", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          $Csv_mod_export = "grid";
          if ($Tem_csv_res == "n")
          {
              $Csv_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '0', '$Csv_mod_export');", "nm_gp_move('csv', '0', '$Csv_mod_export');", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_move('rtf', '0');", "nm_gp_move('rtf', '0');", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=es&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid,resume,chart&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'app', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if ($this->nmgp_botoes['group_2'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_2_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_2_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_2", "scBtnGrpShow('group_2_top')", "scBtnGrpShow('group_2_top')", "sc_btgp_btn_group_2_top", "", "" . $this->Ini->Nm_lang['lang_btns_settings'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_settings'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 'top', 'app', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['filter'] == "on"  && !$this->grid_emb_form && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_pesq_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
           $this->nm_btn_exist['filter'][] = "pesq_top";
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpesquisa", "", "", "pesq_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar.php?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&nmgp_opcao=busca&nmgp_orig_pesq=grid&KeepThis=true&TB_iframe=true&height=0&width=0&modal=true", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
           $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['dynsearch'] == "on" && !$this->grid_emb_form && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_dynamic_search_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['dynsearch'][] = "dynamic_search_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bdynamicsearch", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "dynamic_search_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_selcmp_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $this->nm_btn_exist['sel_col'][] = "selcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "selcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $UseAlias =  "S";
          $nm_saida->saida("            <div id=\"div_ordcmp_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['sort_col'][] = "ordcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_sel_groupby_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Groupby_hide']))
              {
                  $Q_count++;
                  if ($QB == "sc_free_group_by")
                  {
                      $Q_free = true;
                  }
              }
          }
          if ($Q_count > 1 || $Q_free)
          {
              $this->nm_btn_exist['groupby'][] = "sel_groupby_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "sel_groupby_top", "", "AGRUPAR POR", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
          }
      }
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']))
            { }
            else {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_res_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['summary'][] = "res_top";
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'])) {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "RESUMEN", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              else { 
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "RESUMEN", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
                  $NM_Gbtn = true;
            }
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 'top', 'app', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_2_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_2_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_1_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'app', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&sc_ver_93=n&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=es&conf_socor=S&script_case_init=" . $this->Ini->sc_page . "&app_name=grid_appointments_adm_validar&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=AM&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid,resume,chart&password=n&origem=cons&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          $Xls_mod_export = "grid";
          if ($Tem_xls_res == "n")
          {
              $Xls_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0', '$Xls_mod_export');", "nm_gp_move('xls', '0', '$Xls_mod_export');", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          $Xml_mod_export = "grid";
          if ($Tem_xml_res == "n")
          {
              $Xml_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0', '$Xml_mod_export');", "nm_gp_move('xml', '0', '$Xml_mod_export');", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          $Csv_mod_export = "grid";
          if ($Tem_csv_res == "n")
          {
              $Csv_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '0', '$Csv_mod_export');", "nm_gp_move('csv', '0', '$Csv_mod_export');", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_move('rtf', '0');", "nm_gp_move('rtf', '0');", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=es&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid,resume,chart&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&sc_ver_93=n&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=es&conf_socor=S&script_case_init=" . $this->Ini->sc_page . "&app_name=grid_appointments_adm_validar&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=AM&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid,resume,chart&password=n&origem=cons&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          $Xls_mod_export = "grid";
          if ($Tem_xls_res == "n")
          {
              $Xls_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0', '$Xls_mod_export');", "nm_gp_move('xls', '0', '$Xls_mod_export');", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          $Xml_mod_export = "grid";
          if ($Tem_xml_res == "n")
          {
              $Xml_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0', '$Xml_mod_export');", "nm_gp_move('xml', '0', '$Xml_mod_export');", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          $Csv_mod_export = "grid";
          if ($Tem_csv_res == "n")
          {
              $Csv_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '0', '$Csv_mod_export');", "nm_gp_move('csv', '0', '$Csv_mod_export');", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_move('rtf', '0');", "nm_gp_move('rtf', '0');", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=es&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid,resume,chart&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'app', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Groupby_hide']))
              {
                  $Q_count++;
                  if ($QB == "sc_free_group_by")
                  {
                      $Q_free = true;
                  }
              }
          }
          if ($Q_count > 1 || $Q_free)
          {
              $this->nm_btn_exist['groupby'][] = "sel_groupby_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnGroupByShow('" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "sel_groupby_top", "", "AGRUPAR POR", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
      }
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_cmp']))
            { }
            else {
              $this->nm_btn_exist['summary'][] = "res_top";
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'])) {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "RESUMEN", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              else { 
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "RESUMEN", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              $nm_saida->saida("           $Cod_Btn \r\n");
                  $NM_btn = true;
            }
          }
      if ($this->nmgp_botoes['group_2'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_2_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_2_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_2", "scBtnGrpShow('group_2_top')", "scBtnGrpShow('group_2_top')", "sc_btgp_btn_group_2_top", "", "Filtros", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "__sc_grp__", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 'top', 'app', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['dynsearch'] == "on" && !$this->grid_emb_form && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_dynamic_search_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['dynsearch'][] = "dynamic_search_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bdynamicsearch", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "dynamic_search_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['filter'] == "on"  && !$this->grid_emb_form && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_pesq_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
           $this->nm_btn_exist['filter'][] = "pesq_top";
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpesquisa", "", "", "pesq_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar.php?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&nmgp_opcao=busca&nmgp_orig_pesq=grid&KeepThis=true&TB_iframe=true&height=0&width=0&modal=true", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
           $NM_Gbtn = true;
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 'top', 'app', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_2_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_2_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
          if (is_file("grid_appointments_adm_validar_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_appointments_adm_validar_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_psq'])
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
         if ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='$nm_url_saida'; document.F5.submit();", "document.F5.action='$nm_url_saida'; document.F5.submit();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
         elseif (!$this->Ini->Embutida_iframe && !$this->Ini->SC_Link_View && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.F5.action='$nm_url_saida'; document.F5.submit();", "document.F5.action='$nm_url_saida'; document.F5.submit();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
      }
      elseif ($this->nmgp_botoes['exit'] == "on")
      {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_modal'])
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove()", "self.parent.tb_remove()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
        }
        else
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "window.close();", "window.close();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
        }
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_bot_mobile()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn  = false;
      $NM_Gbtn = false;
      $this->NM_calc_span();
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_bottom) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot {\r\n");
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            bottom: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 6;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 1px 0px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-bottom: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        } */\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_bot\" name=\"F0_bot\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_bot\" name=\"sc_truta_f0_bot\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_bot\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_bot\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr id=\"sc_grid_toobar_bot_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print") 
      {
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['first'][] = "first_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['back'][] = "back_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['rows'] == "on" && empty($this->nm_grid_sem_reg))
          {
              $nm_sumario = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
              $nm_sumario = str_replace("?start?", $this->nmgp_reg_inicial, $nm_sumario);
              if ($this->Ini->Apl_paginacao == "FULL")
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->count_ger."</span>", $nm_sumario);
              }
              else
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->nmgp_reg_final."</span>", $nm_sumario);
              }
              $nm_sumario = str_replace("?total?", "<span class='sm_counter_total'>".$this->count_ger."</span>", $nm_sumario);
              $nm_saida->saida("           <span class=\"summary_indicator " . $this->css_css_toolbar_obj . "\" style=\"border:0px;\"><span class='sm_counter'>" . $nm_sumario . "</span></span>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['first'][] = "first_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['back'][] = "back_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['rows'] == "on" && empty($this->nm_grid_sem_reg))
          {
              $nm_sumario = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
              $nm_sumario = str_replace("?start?", $this->nmgp_reg_inicial, $nm_sumario);
              if ($this->Ini->Apl_paginacao == "FULL")
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->count_ger."</span>", $nm_sumario);
              }
              else
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->nmgp_reg_final."</span>", $nm_sumario);
              }
              $nm_sumario = str_replace("?total?", "<span class='sm_counter_total'>".$this->count_ger."</span>", $nm_sumario);
              $nm_saida->saida("           <span class=\"summary_indicator " . $this->css_css_toolbar_obj . "\" style=\"border:0px;\"><span class='sm_counter'>" . $nm_sumario . "</span></span>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if (is_file("grid_appointments_adm_validar_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_appointments_adm_validar_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_bot', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top()
   {
       if (isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_barra_top_mobile();
           $this->nmgp_embbed_placeholder_top();
       }
       if (!isset($_SESSION['scriptcase']['proc_mobile']) || !$_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_barra_top_normal();
           $this->nmgp_embbed_placeholder_top();
       }
   }
   function nmgp_barra_bot()
   {
       if (isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_embbed_placeholder_bot();
           $this->nmgp_barra_bot_mobile();
       }
       if (!isset($_SESSION['scriptcase']['proc_mobile']) || !$_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_embbed_placeholder_bot();
           $this->nmgp_barra_bot_normal();
       }
   }
   function nmgp_embbed_placeholder_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_export_email_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function nmgp_embbed_placeholder_bot()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_export_email_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function html_dynamic_search()
   {
       global $nm_saida;
       $this->Dyn_search_seq = 0;
       $this->Dyn_search_str = "";
       $this->Dyn_search_dat = array();
       $this->NM_case_insensitive = false;
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cond_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cond_pesq']))
       {
           $tmp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['cond_pesq'];
           $pos = strrpos($tmp, "##*@@");
           if ($pos !== false)
           {
               $and_or = (substr($tmp, ($pos + 5)) == "and") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
               $tmp    = substr($tmp, 0, $pos);
               $this->Dyn_search_str = str_replace("##*@@", ", " . $and_or . " ", $tmp);
           }
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
       {
           $this->Ini->Arr_result['setValue'][] = array('field' => 'id_dyn_search_cmd_str', 'value' => NM_charset_to_utf8(trim($this->Dyn_search_str)));
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['save_grid']) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_clear']))
           {
               return;
           }
           elseif (!empty($this->Dyn_search_str))
           {
               $this->Ini->Arr_result['setDisplay'][] = array('field' => 'id_dyn_search_cmd_string', 'value' => '');
           }
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_label'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_label']['nombre'] = (isset($this->New_label['nombre'])) ? $this->New_label['nombre'] : "Nombre Actividad";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_label']['appointment_start_date'] = (isset($this->New_label['appointment_start_date'])) ? $this->New_label['appointment_start_date'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . "";
       $nm_saida->saida("   <tr id=\"NM_Dynamic_Search\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
       { 
           $_SESSION['scriptcase']['saida_html'] = "";
       } 
       $nm_saida->saida("   <td  colspan=3 valign=\"top\"> \r\n");
       $nm_saida->saida("   <div id='id_dyn_search_cmd_string' class=\"" . $this->css_scAppDivMoldura . "\" style=\"display:" . (empty($this->Dyn_search_str)?'none':'') . "\"> \r\n");
       $nm_saida->saida("     <span class=\"" . $this->css_scAppDivHeaderText . "\">\r\n");
             if (is_file($this->Ini->root . $this->Ini->path_img_global . '/' . $this->Ini->App_div_tree_img_exp))
             {
       $nm_saida->saida("                             <a href=\"#\" onclick=\"$('#id_dyn_search_cmd_string').hide();$('#div_dyn_search').show();SC_carga_evt_jquery('all');\" style=\"text-decoration:none\">\r\n");
       $nm_saida->saida("                                     <img id='id_app_div_tree_img_exp' src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->App_div_tree_img_exp . "\" border=0 align='absmiddle' style='vertical-align: middle; margin-right:4px;'>\r\n");
       $nm_saida->saida("                             </a>\r\n");
             }
       $nm_saida->saida("             " . $this->Ini->Nm_lang['lang_othr_dynamicsearch_title_outside'] . "\r\n");
       $nm_saida->saida("     </span>\r\n");
       $nm_saida->saida("     <span id='id_dyn_search_cmd_str' class=\"" . $this->css_scAppDivContentText . "\">" . trim($this->Dyn_search_str) . "</span>\r\n");
       $nm_saida->saida("   </div> \r\n");
       $nm_saida->saida("   <div id=\"div_dyn_search\" style=\"display: none\" class=\"" . $this->css_scAppDivMoldura . "\"> \r\n");
       $nm_saida->saida("    <form id= \"id_Fdyn_search\" name=\"Fdyn_search\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"nmgp_opcao\" value=\"dyn_search\"/> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"parm\" value=\"\"/> \r\n");
       $nm_saida->saida("    <table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\" cellspacing=0 cellpadding=0>\r\n");
       $nm_saida->saida("      <tr>\r\n");
       $nm_saida->saida("        <td class=\"" . $this->css_scAppDivHeader . " " . $this->css_scAppDivHeaderText . "\">\r\n");
             if (is_file($this->Ini->root . $this->Ini->path_img_global . '/' . $this->Ini->App_div_tree_img_col))
             {
       $nm_saida->saida("                             <a id=\"nm_close_dyn\" href=\"#\" onclick=\"$('#div_dyn_search').hide(); if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').show(); }else{ buttonunselectedDS(); }\" style=\"text-decoration:none\">\r\n");
       $nm_saida->saida("                                     <img id='id_app_div_tree_img_col' src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->App_div_tree_img_col . "\" border=0 align='absmiddle' style='vertical-align: middle; margin-right:4px;'>\r\n");
       $nm_saida->saida("                             </a>\r\n");
             }
       $nm_saida->saida("            " . $this->Ini->Nm_lang['lang_othr_dynamicsearch_title'] . "\r\n");
       $nm_saida->saida("        </td>\r\n");
       $nm_saida->saida("      </tr>\r\n");
       $nm_saida->saida("      <tr>\r\n");
       $nm_saida->saida("        <td class=\"" . $this->css_scAppDivContent . " " . $this->css_scAppDivContentText . "\">\r\n");
       $nm_saida->saida("            <table id=\"table_dyn_search\" cellspacing=2 cellpadding=4>\r\n");
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search']))
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search'] as $IX => $def)
           {
               $cmp = $def['cmp'];
               if ($cmp == "nombre")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "nombre";
                   $lin_obj = $this->dynamic_search_nombre($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   $nm_saida->saida("" . $lin_obj . "\r\n");
               }
               if ($cmp == "appointment_start_date")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "appointment_start_date";
                   $lin_obj = $this->dynamic_search_appointment_start_date($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   $nm_saida->saida("" . $lin_obj . "\r\n");
               }
           }
       }
       $nm_saida->saida("                </table>\r\n");
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_out_cond']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_out_cond']))
       {
           $prim_out = true;
           $nm_saida->saida("              <div id='id_dyn_search_out_inside'>\r\n");
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_out_cond'] as $cada_out)
           {
               if (!$prim_out)
               {
                   $nm_saida->saida("              &nbsp;&nbsp;&nbsp;&nbsp;\r\n");
               }
               $nm_saida->saida("               " . $cada_out . "\r\n");
               $prim_out = false;
           }
           $nm_saida->saida("              </div>\r\n");
       }
       $nm_saida->saida("            </td>\r\n");
       $nm_saida->saida("        </tr>\r\n");
       $nm_saida->saida("    <tr>\r\n");
       $nm_saida->saida("        <td nowrap  class=\"" . $this->css_scAppDivToolbar . "\">\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bapply_appdiv", "nm_show_dynamicsearch_fields(); return false;", "nm_show_dynamicsearch_fields(); return false;", "id_dyn_search_fields", "", "" . $this->Ini->Nm_lang['lang_othr_dynamicsearch_fields'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_othr_dynamicsearch_fields_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $nm_saida->saida("      <table id='id_dynamic_search_fields' class=\"SC_SubMenuApp\" style='display:none; position: absolute; border-collapse: collapse; z-index: 1000'> \r\n");
       $nm_saida->saida("        <tr>\r\n");
       $nm_saida->saida("            <td class='scBtnGrpBackground'>\r\n");
       $nm_saida->saida("                <div class='scBtnGrpText' style='cursor: pointer;' onclick=\"ajax_add_dyn_search('nombre', 'grid')\">" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_label']['nombre'] . "\r\n");
       $nm_saida->saida("                </div>\r\n");
       $nm_saida->saida("            </td>\r\n");
       $nm_saida->saida("        </tr>\r\n");
       $nm_saida->saida("        <tr>\r\n");
       $nm_saida->saida("            <td class='scBtnGrpBackground'>\r\n");
       $nm_saida->saida("                <div class='scBtnGrpText' style='cursor: pointer;' onclick=\"ajax_add_dyn_search('appointment_start_date', 'grid')\">" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_label']['appointment_start_date'] . "\r\n");
       $nm_saida->saida("                </div>\r\n");
       $nm_saida->saida("            </td>\r\n");
       $nm_saida->saida("        </tr>\r\n");
       $nm_saida->saida("      </table> \r\n");
       $nm_saida->saida("      &nbsp;&nbsp;&nbsp;\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "blimpar_appdiv", "proc_btn_dyn('dyn_search_clear', 'nm_clear_dyn_search()')", "proc_btn_dyn('dyn_search_clear', 'nm_clear_dyn_search()')", "dyn_search_clear", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $nm_saida->saida("      &nbsp;&nbsp;&nbsp;\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bapply_appdiv", "setTimeout(function() {proc_btn_dyn('dyn_search', 'nm_proc_dyn_search(\\'id_Fdyn_search\\', \\'dyn_search\\')');}, 300);", "setTimeout(function() {proc_btn_dyn('dyn_search', 'nm_proc_dyn_search(\\'id_Fdyn_search\\', \\'dyn_search\\')');}, 300);", "dyn_search", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $nm_saida->saida("      &nbsp;&nbsp;&nbsp;\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "nm_cancel_dyn_search();", "nm_cancel_dyn_search();", "dyn_cancel", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $nm_saida->saida("        </td>\r\n");
       $nm_saida->saida("    </tr>\r\n");
       $nm_saida->saida("    </table>\r\n");
       $nm_saida->saida("   </form>\r\n");
       $nm_saida->saida("   </div>\r\n");
       $nm_saida->saida("   </td>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
       { 
           $this->Ini->Arr_result['setValue'][] = array('field' => 'NM_Dynamic_Search', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
           $_SESSION['scriptcase']['saida_html'] = "";
           $this->Ini->Arr_result['setValue'][] = array('field' => 'id_dyn_search_cmd_str', 'value' => NM_charset_to_utf8(trim($this->Dyn_search_str)));
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_clear']))
           { 
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_clear']);
               return;
           } 
       } 
       $nm_saida->saida("   </tr>\r\n");
       $this->JS_dynamic_search();
   }
   function dynamic_search_nombre($ind, $ajax, $opc="", $val=array())
   {
       $lin_obj  = "";
       $lin_obj .= "     <tr id='dyn_search_nombre_" . $ind . "'>";
       $lin_obj .= "      <td style='border-style: none' nowrap>" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_label']['nombre'] . "</td>";
       $lin_obj .= "      <td style='border-style: none' >";
       if (empty($opc))
       {
           $opc = "qp";
       }
       $lin_obj .= "       <select id='dyn_search_nombre_cond_" . $ind . "' name='cond_dyn_search_nombre_" . $ind . "' class='" . $this->css_scAppDivToolbarInput . "' style='vertical-align: middle; display: none'>";
       $selected = ($opc == "qp") ? " selected" : "";
       $lin_obj .= "        <option value='qp'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </td>";
       $lin_obj .= "      <td style='border-style: none' >";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       else
       {
           $display_in_1 = "''";
       }
       $lin_obj .= "       <span id=\"dyn_nombre_" . $ind . "\" style=\"display:" . $display_in_1 . "\">";
       $val_cmp = (isset($val[0][0])) ? $val[0][0] : "";
       $nombre = $val_cmp;
       if ($nombre != "")
       {
       $nombre_look = (is_string($nombre) ? substr($this->Db->qstr($nombre), 1, -1) : $nombre); 
       $nmgp_def_dados = array(); 
       $nm_comando = "select distinct nombre from " . $this->Ini->nm_tabela . " where (appointments.id_usuario=" . $_SESSION['id_usuario'] . " and   appointments.`appointment_start_date` BETWEEN '" . $_SESSION['fecha'] . "' AND '" . $_SESSION['fecha2'] . "') and nombre = '$nombre_look' order by nombre"; 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
       { 
          while (!$rs->EOF) 
          { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
             $rs->MoveNext(); 
          } 
          $rs->Close(); 
       } 
       else  
       {  
           if  ($ajax == 'N')
           {  
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit; 
           } 
           else
           {  
              echo $this->Db->ErrorMsg(); 
           } 
       } 
       }
       if (isset($nmgp_def_dados[0][$nombre]))
       {
           $sAutocompValue = $nmgp_def_dados[0][$nombre];
       }
       else
       {
           $sAutocompValue = $val_cmp;
           $val[0][0]      = $val_cmp;
       }
       $val_cmp = (isset($val[0][0])) ? $val[0][0] : "";
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='dyn_search_nombre_val_" . $ind . "' name='val_dyn_search_nombre_" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . NM_encode_input($val_cmp) . "\" size=50 alt=\"{datatype: 'text', maxLength: 255, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" style='display: none' >";
       $lin_obj .= "     <input class='sc-js-input " . $this->css_scAppDivToolbarInput . "' type='text' id='id_ac_nombre" . $ind . "' name='val_dyn_search_nombre_autocomp" . $ind . "' size='50' value='" . NM_encode_input($sAutocompValue) . "' alt=\"{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\"  onChange=\"buttonEnable_dyn('dyn_search');\">";
       $lin_obj .= "       </span>";
       $lin_obj .= "      </td>";
       $lin_obj .= "      <td style='border-style: none; cursor:pointer'>";
       $lin_obj .= "       <img id='dyn_search_nombre_close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_nombre_" . $ind . "', " . $ind . ");buttonEnable_dyn('dyn_search');\">";
       $lin_obj .= "      </td>";
       $lin_obj .= "     </tr>";
       return $lin_obj;
   }
   function dynamic_search_appointment_start_date($ind, $ajax, $opc="", $val=array())
   {
       $lin_obj  = "";
       $lin_obj .= "     <tr id='dyn_search_appointment_start_date_" . $ind . "'>";
       $lin_obj .= "      <td style='border-style: none' nowrap>" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dyn_search_label']['appointment_start_date'] . "</td>";
       $lin_obj .= "      <td style='border-style: none' >";
       if (empty($opc))
       {
           $opc = "bw";
       }
       $lin_obj .= "       <select id='dyn_search_appointment_start_date_cond_" . $ind . "' name='cond_dyn_search_appointment_start_date_" . $ind . "' class='" . $this->css_scAppDivToolbarInput . "' style='vertical-align: middle; display: none'>";
       $selected = ($opc == "bw") ? " selected" : "";
       $lin_obj .= "        <option value='bw'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_betw'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </td>";
       $lin_obj .= "      <td style='border-style: none' >";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       else
       {
           $display_in_1 = "''";
       }
       $lin_obj .= "       <span id=\"dyn_appointment_start_date_" . $ind . "\" style=\"display:" . $display_in_1 . "\">";
       $Form_base          = "ddmmyyyy";
       $date_format_show   = "";
       $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
       $Lim   = strlen($Str_date);
       $Str   = "";
       $Ult   = "";
       $Arr_D = array();
       for ($I = 0; $I < $Lim; $I++)
       {
           $Char = substr($Str_date, $I, 1);
           if ($Char != $Ult && "" != $Str)
           {
               $Arr_D[] = $Str;
               $Str     = $Char;
           }
           else
           {
              $Str    .= $Char;
           }
           $Ult = $Char;
       }
       $Arr_D[] = $Str;
       $Prim = true;
       foreach ($Arr_D as $Cada_d)
       {
           if (strpos($Form_base, $Cada_d) !== false)
           {
               $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
               $date_format_show .= $Cada_d;
               $Prim = false;
           }
       }
       $Tmp_date = $Arr_D;
       $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
       $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
       $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
       $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
       $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
       $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
       $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
       $val_r = $this->Ini->dyn_convert_date($val[0]);
       foreach ($Tmp_date as $Ind => $Part_date)
       {
            $AutoTab = (($Ind + 1) < count($Tmp_date)) ? "autoTab: true" : "autoTab: false";
           if (substr($Part_date, 0,1) == "y")
           {
               $val_cmp = (isset($val_r['ano'])) ? $val_r['ano'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='dyn_search_appointment_start_date_ano_val_" . $ind . "' name='val_dyn_search_appointment_start_date_ano_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" onChange=\"buttonEnable_dyn('dyn_search');\" size=4 alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "m")
           {
               $val_cmp = (isset($val_r['mes'])) ? $val_r['mes'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='dyn_search_appointment_start_date_mes_val_" . $ind . "' name='val_dyn_search_appointment_start_date_mes_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" onChange=\"buttonEnable_dyn('dyn_search');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "d")
           {
               $val_cmp = (isset($val_r['dia'])) ? $val_r['dia'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='dyn_search_appointment_start_date_dia_val_" . $ind . "' name='val_dyn_search_appointment_start_date_dia_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" onChange=\"buttonEnable_dyn('dyn_search');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
       }
       $lin_obj .= "&nbsp;";
       $lin_obj .= "" . $date_format_show . "";
       $lin_obj .= "       </span>";
       if ($opc == "bw")
       {
           $display_in_2 = "''";
       }
       else
       {
           $display_in_2 = "none";
       }
       $lin_obj .= "       <span id=\"dyn_appointment_start_date_in_2_" . $ind . "\" style=\"display:" . $display_in_2 . "\">";
       $date_sep_bw = " Hasta ";
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
       {
           $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $lin_obj .= "       <br>" . $date_sep_bw . "<br>";
       $val_r = isset($val[1]) ? $this->Ini->dyn_convert_date($val[1]) : array();
       foreach ($Tmp_date as $Ind => $Part_date)
       {
            $AutoTab = (($Ind + 1) < count($Tmp_date)) ? "autoTab: true" : "autoTab: false";
           if (substr($Part_date, 0,1) == "y")
           {
               $val_cmp = (isset($val_r['ano'])) ? $val_r['ano'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='dyn_search_appointment_start_date_v2__ano_val_" . $ind . "' name='val_dyn_search_appointment_start_date_v2__ano_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" onChange=\"buttonEnable_dyn('dyn_search');\" size=4 alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "m")
           {
               $val_cmp = (isset($val_r['mes'])) ? $val_r['mes'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='dyn_search_appointment_start_date_v2__mes_val_" . $ind . "' name='val_dyn_search_appointment_start_date_v2__mes_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" onChange=\"buttonEnable_dyn('dyn_search');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "d")
           {
               $val_cmp = (isset($val_r['dia'])) ? $val_r['dia'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . "' id='dyn_search_appointment_start_date_v2__dia_val_" . $ind . "' name='val_dyn_search_appointment_start_date_v2__dia_" . $ind . "' value=\"" . NM_encode_input($val_cmp) . "\" onChange=\"buttonEnable_dyn('dyn_search');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
       }
       $lin_obj .= "&nbsp;";
       $lin_obj .= "" . $date_format_show . "";
       $lin_obj .= "       </span>";
       $lin_obj .= "      </td>";
       $lin_obj .= "      <td style='border-style: none; cursor:pointer'>";
       $lin_obj .= "       <img id='dyn_search_appointment_start_date_close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_appointment_start_date_" . $ind . "', " . $ind . ");buttonEnable_dyn('dyn_search');\">";
       $lin_obj .= "      </td>";
       $lin_obj .= "     </tr>";
       return $lin_obj;
   }
   function lookup_ajax_nombre($nombre)
   {
       $nombre = substr($this->Db->qstr($nombre), 1, -1);
       $this->NM_case_insensitive = false;
       $nombre_look = (is_string($nombre) ? substr($this->Db->qstr($nombre), 1, -1) : $nombre); 
       $nmgp_def_dados = array(); 
       $nm_comando = "select distinct nombre from " . $this->Ini->nm_tabela . " where (appointments.id_usuario=" . $_SESSION['id_usuario'] . " and   appointments.`appointment_start_date` BETWEEN '" . $_SESSION['fecha'] . "' AND '" . $_SESSION['fecha2'] . "') and  nombre like '%" . $nombre . "%' order by nombre"; 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
       { 
          while (!$rs->EOF) 
          { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $cmp1 = grid_appointments_adm_validar_pack_protect_string($cmp1);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
             $rs->MoveNext(); 
          } 
          $rs->Close(); 
          return $nmgp_def_dados; 
       } 
       else  
       {  
          echo $this->Db->ErrorMsg(); 
       } 
   }
   function JS_dynamic_search()
   {
       global $nm_saida;
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("     var Tot_obj_dyn_search = " . $this->Dyn_search_seq . ";\r\n");
       $nm_saida->saida("     Tab_obj_dyn_search = new Array();\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search = new Array();\r\n");
       foreach ($this->Dyn_search_dat as $seq => $cmp)
       {
           $nm_saida->saida("     Tab_obj_dyn_search[" . $seq . "] = '" . $cmp . "';\r\n");
       }
       $nm_saida->saida(" function sc_grid_appointments_adm_validar_valida_mes(obj)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("     if (obj.value != \"\" && (obj.value < 1 || obj.value > 12))\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if (confirm (Nm_erro['lang_jscr_ivdt'] +  \" \" + Nm_erro['lang_jscr_mnth'] +  \" \" + Nm_erro['lang_jscr_wfix']))\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("            Xfocus = setTimeout(function() { obj.focus(); }, 10);\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida(" function sc_grid_appointments_adm_validar_valida_dia(obj)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("     if (obj.value != \"\" && (obj.value < 1 || obj.value > 31))\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if (confirm (Nm_erro['lang_jscr_ivdt'] +  \" \" + Nm_erro['lang_jscr_iday'] +  \" \" + Nm_erro['lang_jscr_wfix']))\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("            Xfocus = setTimeout(function() { obj.focus(); }, 10);\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search['appointment_start_date_mes'] =  'sc_grid_appointments_adm_validar_valida_mes(this)';\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search['appointment_start_date_dia'] =  'sc_grid_appointments_adm_validar_valida_dia(this)';\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search['appointment_start_date_v2__mes'] =  'sc_grid_appointments_adm_validar_valida_mes(this)';\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search['appointment_start_date_v2__dia'] =  'sc_grid_appointments_adm_validar_valida_dia(this)';\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
       { 
           $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_obj_dyn_search', 'value' => '');
           $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_evt_dyn_search', 'value' => '');
           $this->Ini->Arr_result['setVar'][] = array('var' => 'Tot_obj_dyn_search', 'value' => $this->Dyn_search_seq);
           foreach ($this->Dyn_search_dat as $seq => $cmp)
           {
               $this->Ini->Arr_result['setVar'][] = array('var' => 'Tab_obj_dyn_search[' . $seq . ']', 'value' => $cmp);
           }
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['appointment_start_date_mes']", 'value' => 'sc_grid_appointments_adm_validar_valida_mes(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['appointment_start_date_dia']", 'value' => 'sc_grid_appointments_adm_validar_valida_dia(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['appointment_start_date_v2__mes']", 'value' => 'sc_grid_appointments_adm_validar_valida_mes(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['appointment_start_date_v2__dia']", 'value' => 'sc_grid_appointments_adm_validar_valida_dia(this)');
       } 
       $nm_saida->saida("     function SC_carga_evt_jquery(tp_carga)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null' && (tp_carga == 'all' || tp_carga == i))\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 x   = 0;\r\n");
       $nm_saida->saida("                 tmp = Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("                 cps = new Array();\r\n");
       $nm_saida->saida("                 cps[x] = tmp;\r\n");
       $nm_saida->saida("                 if (tmp == 'appointment_start_date')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     cps[x] = 'appointment_start_date_dia';\r\n");
       $nm_saida->saida("                     x++;\r\n");
       $nm_saida->saida("                     cps[x] = 'appointment_start_date_mes';\r\n");
       $nm_saida->saida("                     x++;\r\n");
       $nm_saida->saida("                     cps[x] = 'appointment_start_date_v2__dia';\r\n");
       $nm_saida->saida("                     x++;\r\n");
       $nm_saida->saida("                     cps[x] = 'appointment_start_date_v2__mes';\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 for (x = 0; x < cps.length ; x++)\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     cmp = cps[x];\r\n");
       $nm_saida->saida("                     if (Tab_evt_dyn_search[cmp])\r\n");
       $nm_saida->saida("                     {\r\n");
       $nm_saida->saida("                         eval (\"$('#dyn_search_\" + cmp + \"_val_\" + i + \"').bind('change', function() {\" + Tab_evt_dyn_search[cmp] + \"})\");\r\n");
       $nm_saida->saida("                     }\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null' && (tp_carga == 'all' || tp_carga == i))\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 tmp = Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("                 if (tmp == 'nombre')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                      var x = i;\r\n");
       $nm_saida->saida("                      $(\"#id_ac_nombre\" + i).autocomplete({\r\n");
       $nm_saida->saida("                        minLength: 1,\r\n");
       $nm_saida->saida("                        source: function (request, response) {\r\n");
       $nm_saida->saida("                        $.ajax({\r\n");
       $nm_saida->saida("                          url: \"index.php\",\r\n");
       $nm_saida->saida("                          dataType: \"json\",\r\n");
       $nm_saida->saida("                          data: {\r\n");
       $nm_saida->saida("                             q: request.term,\r\n");
       $nm_saida->saida("                             nmgp_opcao: \"ajax_aut_comp_dyn_search\",\r\n");
       $nm_saida->saida("                             origem: \"grid\",\r\n");
       $nm_saida->saida("                             field: \"nombre\",\r\n");
       $nm_saida->saida("                             max_itens: \"10\",\r\n");
       $nm_saida->saida("                             cod_desc: \"N\",\r\n");
       $nm_saida->saida("                             script_case_init: " . $this->Ini->sc_page . "\r\n");
       $nm_saida->saida("                           },\r\n");
       $nm_saida->saida("                          success: function (data) {\r\n");
       $nm_saida->saida("                            if (data == \"ss_time_out\") {\r\n");
       $nm_saida->saida("                                nm_move();\r\n");
       $nm_saida->saida("                            }\r\n");
       $nm_saida->saida("                            response(data);\r\n");
       $nm_saida->saida("                          }\r\n");
       $nm_saida->saida("                         });\r\n");
       $nm_saida->saida("                        },\r\n");
       $nm_saida->saida("                        select: function (event, ui) {\r\n");
       $nm_saida->saida("                          $(\"#dyn_search_nombre_val_\" + x).val(ui.item.value);\r\n");
       $nm_saida->saida("                          $(this).val(ui.item.label);\r\n");
       $nm_saida->saida("                          event.preventDefault();\r\n");
       $nm_saida->saida("                        },\r\n");
       $nm_saida->saida("                        focus: function (event, ui) {\r\n");
       $nm_saida->saida("                          $(\"#dyn_search_nombre_val_\" + x).val(ui.item.value);\r\n");
       $nm_saida->saida("                          $(this).val(ui.item.label);\r\n");
       $nm_saida->saida("                          event.preventDefault();\r\n");
       $nm_saida->saida("                        },\r\n");
       $nm_saida->saida("                        change: function (event, ui) {\r\n");
       $nm_saida->saida("                          if (null == ui.item) {\r\n");
       $nm_saida->saida("                             $(\"#dyn_search_nombre_val_\" + x).val( $(this).val() );\r\n");
       $nm_saida->saida("                          }\r\n");
       $nm_saida->saida("                        }\r\n");
       $nm_saida->saida("                      });\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function del_dyn_search(field, ind)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         qtd_atv = 0;\r\n");
       $nm_saida->saida("         Tab_obj_dyn_search[ind] = 'NMSC_Dyn_Null';\r\n");
       $nm_saida->saida("         $('#' + field).hide();\r\n");
       $nm_saida->saida("         for (idel = 1; idel <= Tot_obj_dyn_search; idel++) {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[idel] != 'NMSC_Dyn_Null') {\r\n");
       $nm_saida->saida("                 qtd_atv++;\r\n");
       $nm_saida->saida("                  break;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (qtd_atv == 0) {\r\n");
       $nm_saida->saida("             buttonDisable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_change_bw(field, ind)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById('dyn_search_' + field + '_cond_' + ind).selectedIndex;\r\n");
       $nm_saida->saida("        var parm  = document.getElementById('dyn_search_' + field + '_cond_' + ind).options[index].value;\r\n");
       $nm_saida->saida("        if (parm == \"bw\")\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_in_2_' + ind).css('display','');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_in_2_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            if (parm == \"nu\" || parm == \"nn\" || parm == \"ep\" || parm == \"ne\")\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#dyn_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#dyn_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_hide_input(field, ind)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById('dyn_search_' + field + '_cond_' + ind).selectedIndex;\r\n");
       $nm_saida->saida("        var parm  = document.getElementById('dyn_search_' + field + '_cond_' + ind).options[index].value;\r\n");
       $nm_saida->saida("        if (parm == \"nu\" || parm == \"nn\" || parm == \"ep\" || parm == \"ne\")\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     var dynamicsearch_status = 'out';\r\n");
       $nm_saida->saida("     function nm_show_dynamicsearch_fields()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("       if (typeof(nm_show_dynamicsearch_fields_mobile) === typeof(function(){})) { return nm_show_dynamicsearch_fields_mobile(); };\r\n");
       $nm_saida->saida("       var btn_id = 'id_dyn_search_fields';\r\n");
       $nm_saida->saida("       var obj_id = 'id_dynamic_search_fields';\r\n");
       $nm_saida->saida("       dynamicsearch_status = 'open';\r\n");
       $nm_saida->saida("       $('#' + btn_id).mouseout(function() {\r\n");
       $nm_saida->saida("         setTimeout(function() {\r\n");
       $nm_saida->saida("           nm_hide_dynamicsearch_fields(obj_id);\r\n");
       $nm_saida->saida("         }, 1000);\r\n");
       $nm_saida->saida("       });\r\n");
       $nm_saida->saida("       $('#' + obj_id + ' li').click(function() {\r\n");
       $nm_saida->saida("         dynamicsearch_status = 'out';\r\n");
       $nm_saida->saida("         nm_hide_dynamicsearch_fields(obj_id);\r\n");
       $nm_saida->saida("       });\r\n");
       $nm_saida->saida("       $('#' + obj_id).css({\r\n");
       $nm_saida->saida("         'left': $('#' + btn_id).left\r\n");
       $nm_saida->saida("       })\r\n");
       $nm_saida->saida("       .mouseover(function() {\r\n");
       $nm_saida->saida("         dynamicsearch_status = 'over';\r\n");
       $nm_saida->saida("       })\r\n");
       $nm_saida->saida("       .mouseleave(function() {\r\n");
       $nm_saida->saida("         dynamicsearch_status = 'out';\r\n");
       $nm_saida->saida("         setTimeout(function() {\r\n");
       $nm_saida->saida("           nm_hide_dynamicsearch_fields(obj_id);\r\n");
       $nm_saida->saida("         }, 1000);\r\n");
       $nm_saida->saida("       })\r\n");
       $nm_saida->saida("       .show('fast');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("   function nm_hide_dynamicsearch_fields(obj_id) {\r\n");
       $nm_saida->saida("     if ('over' != dynamicsearch_status) {\r\n");
       $nm_saida->saida("       $('#' + obj_id).hide('fast');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   function proc_btn_dyn(btn, proc) {\r\n");
       $nm_saida->saida("       if ($(\"#\" + btn).prop(\"disabled\") == true) {\r\n");
       $nm_saida->saida("           return;\r\n");
       $nm_saida->saida("       }\r\n");
       $nm_saida->saida("       eval (proc);\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   function buttonDisable_dyn(buttonId) {\r\n");
       $nm_saida->saida("      $(\"#\" + buttonId).prop(\"disabled\", true).addClass(\"disabled\");\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   function buttonEnable_dyn(buttonId) {\r\n");
       $nm_saida->saida("      $(\"#\" + buttonId).prop(\"disabled\", false).removeClass(\"disabled\");\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   $(document).ready(function() {\r\n");
       $nm_saida->saida("      Tot_obj_dyn_search_or = Tot_obj_dyn_search;\r\n");
       $nm_saida->saida("      Tab_obj_dyn_search_or = new Array();\r\n");
       $nm_saida->saida("      for (i = 1; i <= Tot_obj_dyn_search; i++) {\r\n");
       $nm_saida->saida("          Tab_obj_dyn_search_or[i] = Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("      }\r\n");
       $nm_saida->saida("      if (Tot_obj_dyn_search < 1) {\r\n");
       $nm_saida->saida("          buttonDisable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("      }\r\n");
       $nm_saida->saida("      buttonDisable_dyn(\"dyn_search\");\r\n");
       $nm_saida->saida("   });\r\n");
       $nm_saida->saida("     function buttonSelectedDS() {\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function buttonunselectedDS() {\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     Dyn_Have_Clear = false;\r\n");
       $nm_saida->saida("     function nm_clear_dyn_search()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 del_dyn_search('dyn_search_' + Tab_obj_dyn_search[i] + '_' + i, i);\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         Dyn_Have_Clear = true;\r\n");
       $nm_saida->saida("         buttonDisable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("         buttonEnable_dyn('dyn_search');\r\n");
       $nm_saida->saida("         buttonunselectedDS();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_cancel_dyn_search()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++) {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null') {\r\n");
       $nm_saida->saida("                 del_dyn_search('dyn_search_' + Tab_obj_dyn_search[i] + '_' + i, i);\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         Tot_obj_dyn_search = Tot_obj_dyn_search_or;\r\n");
       $nm_saida->saida("         Tab_obj_dyn_search = new Array(); \r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search_or; i++) {\r\n");
       $nm_saida->saida("              Tab_obj_dyn_search[i] = Tab_obj_dyn_search_or[i];\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++) {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null') {\r\n");
       $nm_saida->saida("                 $('#dyn_search_' + Tab_obj_dyn_search[i] + '_' + i).show();\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (Tot_obj_dyn_search > 0) {\r\n");
       $nm_saida->saida("             buttonEnable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("         }\r\n");
           $nm_saida->saida("         $('#nm_close_dyn').click();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_proc_dyn_search(formId, Tp_Proc)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         var out_dyn      = \"\";\r\n");
       $nm_saida->saida("         var empty_dyn    = true;\r\n");
       $nm_saida->saida("         var tem_dyn_null = false;\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] == 'NMSC_Dyn_Null')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 tem_dyn_null = true;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 out_dyn += (out_dyn != \"\") ? \"_FDYN_\" : \"\";\r\n");
       $nm_saida->saida("                 out_dyn += Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("                 obj_dyn  = 'dyn_search_' + Tab_obj_dyn_search[i] + '_cond_' + i;\r\n");
       $nm_saida->saida("                 out_cond = dyn_search_get_sel_cond(obj_dyn);\r\n");
       $nm_saida->saida("                 out_dyn += \"_DYN_\" + out_cond;\r\n");
       $nm_saida->saida("                 obj_dyn  = 'dyn_search_' + Tab_obj_dyn_search[i] + '_val_';\r\n");
       $nm_saida->saida("                 if (Tab_obj_dyn_search[i] == 'nombre')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     obj_ac  = 'id_ac_' + Tab_obj_dyn_search[i] + i;\r\n");
       $nm_saida->saida("                     result  = dyn_search_get_text(obj_dyn + i, obj_ac);\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_dyn_search[i] == 'appointment_start_date')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     obj_dyn = 'dyn_search_' + Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("                     result  = dyn_search_get_dt_h(obj_dyn, i, 'DT');\r\n");
       $nm_saida->saida("                     result += \"_VLS2_\" + dyn_search_get_dt_h(obj_dyn + \"_v2_\", i, 'DT');\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 out_dyn  += \"_DYN_\" + result;\r\n");
       $nm_saida->saida("                 if (result != '' || out_cond == 'ep' || out_cond == 'ne' || out_cond == 'nu' || out_cond == 'nn')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     empty_dyn = false;\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (empty_dyn && (Dyn_Have_Clear || tem_dyn_null))\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             Tp_Proc = \"dyn_search_clear\";\r\n");
       $nm_saida->saida("             Dyn_Have_Clear = false;\r\n");
       $nm_saida->saida("             buttonDisable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("             Tot_obj_dyn_search = 0;\r\n");
       $nm_saida->saida("             Tab_obj_dyn_searchr = new Array();\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (empty_dyn && Tp_Proc != \"dyn_search_clear\")\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             scJs_alert(\"" . $this->Ini->Nm_lang['lang_srch_req_field'] . "\");\r\n");
       $nm_saida->saida("             return false;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         Tot_obj_dyn_search_or = Tot_obj_dyn_search;\r\n");
       $nm_saida->saida("         Tab_obj_dyn_search_or = new Array();\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++) {\r\n");
       $nm_saida->saida("             Tab_obj_dyn_search_or[i] = Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         buttonDisable_dyn('dyn_search');\r\n");
       $nm_saida->saida("         ajax_navigate(Tp_Proc, out_dyn);\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_sel_cond(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById(obj_id).selectedIndex;\r\n");
       $nm_saida->saida("        return document.getElementById(obj_id).options[index].value;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_select(obj_id, str_type)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        if(str_type == '')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            var obj = document.getElementById(obj_id);\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            var obj = $('#' + obj_id).multipleSelect('getSelects');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        var val = \"\";\r\n");
       $nm_saida->saida("        for (iSelect = 0; iSelect < obj.length; iSelect++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            if ((str_type == '' && obj[iSelect].selected) || (str_type=='RADIO' || str_type=='CHECKBOX'))\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                if(str_type == '' && obj[iSelect].selected)\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    new_val = obj[iSelect].value;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                else\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    new_val = obj[iSelect];\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                val += new_val;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_Dselelect(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var obj = document.getElementById(obj_id);\r\n");
       $nm_saida->saida("        var val = \"\";\r\n");
       $nm_saida->saida("        for (iSelect = 0; iSelect < obj.length; iSelect++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("            val += obj[iSelect].value;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_radio(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var Nobj = document.getElementById(obj_id).name;\r\n");
       $nm_saida->saida("        var obj  = document.getElementsByName(Nobj);\r\n");
       $nm_saida->saida("        var val  = \"\";\r\n");
       $nm_saida->saida("        for (iRadio = 0; iRadio < obj.length; iRadio++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            if (obj[iRadio].checked)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                val += obj[iRadio].value;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_checkbox(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var Nobj = document.getElementById(obj_id).name;\r\n");
       $nm_saida->saida("        var obj  = document.getElementsByName(Nobj);\r\n");
       $nm_saida->saida("        var val  = \"\";\r\n");
       $nm_saida->saida("        if (!obj.length)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            if (obj.checked)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val = obj.value;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            return val;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            for (iCheck = 0; iCheck < obj.length; iCheck++)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                if (obj[iCheck].checked)\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                    val += obj[iCheck].value;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_text(obj_id, obj_ac)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var obj = document.getElementById(obj_id);\r\n");
       $nm_saida->saida("        var val = \"\";\r\n");
       $nm_saida->saida("        if (obj)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            val = obj.value;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        if (obj_ac != '' && val == '')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            obj = document.getElementById(obj_ac);\r\n");
       $nm_saida->saida("            if (obj)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val = obj.value;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_dt_h(obj_id, ind, TP)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var val = new Array();\r\n");
       $nm_saida->saida("        if (TP == 'DT' || TP == 'DH')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            obj_part  = document.getElementById(obj_id + '_ano_val_' + ind);\r\n");
       $nm_saida->saida("            val      += \"Y:\";\r\n");
       $nm_saida->saida("            if (obj_part && obj_part.type.substr(0, 6) == 'select')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                Tval = dyn_search_get_sel_cond(obj_id + '_ano_val_' + ind);\r\n");
       $nm_saida->saida("                val += (Tval != -1) ? Tval : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            obj_part  = document.getElementById(obj_id + '_mes_val_' + ind);\r\n");
       $nm_saida->saida("            val      += \"_VLS_M:\";\r\n");
       $nm_saida->saida("            if (obj_part && obj_part.type.substr(0, 6) == 'select')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                Tval = dyn_search_get_sel_cond(obj_id + '_mes_val_' + ind);\r\n");
       $nm_saida->saida("                val += (Tval != -1) ? Tval : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            obj_part  = document.getElementById(obj_id + '_dia_val_' + ind);\r\n");
       $nm_saida->saida("            val      += \"_VLS_D:\";\r\n");
       $nm_saida->saida("            if (obj_part && obj_part.type.substr(0, 6) == 'select')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                Tval = dyn_search_get_sel_cond(obj_id + '_dia_val_' + ind);\r\n");
       $nm_saida->saida("                val += (Tval != -1) ? Tval : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        if (TP == 'HH' || TP == 'DH')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            val            += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("            obj_part        = document.getElementById(obj_id + '_hor_val_' + ind);\r\n");
       $nm_saida->saida("            val            += \"H:\";\r\n");
       $nm_saida->saida("            val            += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            obj_part        = document.getElementById(obj_id + '_min_val_' + ind);\r\n");
       $nm_saida->saida("            val            += \"_VLS_I:\";\r\n");
       $nm_saida->saida("            val            += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            obj_part        = document.getElementById(obj_id + '_seg_val_' + ind);\r\n");
       $nm_saida->saida("            val            += \"_VLS_S:\";\r\n");
       $nm_saida->saida("            val            += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("   </script>\r\n");
   }
   function html_interativ_search()
   {
       global $nm_saida;
       $bol_refin_use_modal = false;
       if($_SESSION['scriptcase']['proc_mobile'])
       {
           $bol_refin_use_modal = false;
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label'] = array();
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_dados']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_dados'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_sql']   = array();
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['appointment_start_date'] = (isset($this->New_label['appointment_start_date'])) ? $this->New_label['appointment_start_date'] : '' . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . '';
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_sql']['appointment_start_date']   = "appointment_start_date";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['current_status_id'] = (isset($this->New_label['current_status_id'])) ? $this->New_label['current_status_id'] : '' . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . '';
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_sql']['current_status_id']   = "current_status_id";
       $tb_disp = (empty($this->nm_grid_sem_reg)) ? '' : 'none';
       $nm_saida->saida("     <script>\r\n");
       $nm_saida->saida("         var Tab_obj_int_mult = {};\r\n");
       $nm_saida->saida("     </script>\r\n");
       $nm_saida->saida(" <table id=\"TB_Interativ_Search\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%; display:" . $tb_disp . ";\" valign=\"top\" cellspacing=0 cellpadding=0>\r\n");
       $nm_saida->saida("   <tr id=\"NM_Interativ_Search\">\r\n");
       $nm_saida->saida("   <td valign=\"top\"> \r\n");
       $nm_saida->saida("    <form id= \"id_Interat_search\" name=\"FInterat_search\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"nmgp_opcao\" value=\"interativ_search\"/> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"parm\" value=\"\"/> \r\n");
       $nm_saida->saida("    <div id='id_div_interativ_search' class=''>\r\n");
       $disp_btn_collapse = 'none'; 
       if('N' == 'S') 
       { 
           $disp_btn_collapse = ''; 
       } 
       $nm_saida->saida("        <div id='app_int_search_toggle' class='scGridRefinedSearchCollapse' style='display: " . $disp_btn_collapse . "' onclick='nm_proc_int_search_toggle(false);'><i class='icon_fa " . $this->Ini->scGridRefinedSearchCollapseFAIcon . "'></i></div> \r\n");
       $nm_saida->saida("        <div id='id_div_interativ_search_content' class='scGridRefinedSearchMoldura' style='min-width:130px;'>\r\n");
       $nm_saida->saida("            <div id='id_div_interativ_search_fields'>\r\n");
       $lin_obj = $this->interativ_search_appointment_start_date($bol_refin_use_modal);
       $nm_saida->saida("" . $lin_obj . "\r\n");
       $lin_obj = $this->interativ_search_current_status_id($bol_refin_use_modal);
       $nm_saida->saida("" . $lin_obj . "\r\n");
       $nm_saida->saida("            </div>\r\n");
       $nm_saida->saida("        </div>\r\n");
       $nm_saida->saida("    </div>\r\n");
       $nm_saida->saida("    </form>\r\n");
       $nm_saida->saida("   </td>\r\n");
       $nm_saida->saida("   </tr>\r\n");
       $nm_saida->saida(" </table>\r\n");
       $this->JS_interativ_search();
       $nm_saida->saida(" <SCRIPT LANGUAGE=\"Javascript\" SRC=\"" . $this->Ini->path_js . "/nm_format_num.js\"></SCRIPT>\r\n");
   }
   function refresh_interativ_search()
   {
       $bol_refin_use_modal = false;
       if($_SESSION['scriptcase']['proc_mobile'])
       {
           $bol_refin_use_modal = false;
       }
       $array_fields = array();
       $array_fields[] = "appointment_start_date";
       $array_fields[] = "current_status_id";
       if(is_array($array_fields) && !empty($array_fields))
       {
           $str_out = "";
           foreach($array_fields as $str_field)
           {
               $method = "interativ_search_" . $str_field;
               $str_out .= $this->$method($bol_refin_use_modal);
           }
           $this->Ini->Arr_result['setValue'][] = array('field' => 'id_div_interativ_search_fields', 'value' => NM_charset_to_utf8($str_out));
       }
   }
   function interativ_search_appointment_start_date($bol_refin_use_modal)
   {
       $cle_disp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']["appointment_start_date"])) ? "" : "none";
       $exp_disp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']["appointment_start_date"])) ? "none" : "";
       $displ_open= false;
       $lin_obj  = "    <div id=\"div_int_appointment_start_date\">";
       $lin_obj .= "    <table width='100%' cellspacing=0 cellpadding=0>";
       $lin_obj .= "     <tr>";
       $lin_obj .= "      <td nowrap class='scGridRefinedSearchLabel' onclick=\"nm_toggle_int_search('appointment_start_date')\">";
       $lin_obj .= "        <table width='100%' cellspacing=0 cellpadding=0>";
       $lin_obj .= "         <tr>";
       $lin_obj .= "          <td nowrap>";
       $lin_obj .= "              <span id=\"id_expand_appointment_start_date\" style=\"display: " .  $exp_disp . ";\">&nbsp;&nbsp;<IMG align='absmiddle' style=\"cursor: pointer; padding:0px 2px 0px 0px;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_show . "\" BORDER=\"0\" />   </span>";
       $lin_obj .= "              <span id=\"id_retract_appointment_start_date\" style=\"display: none;\">&nbsp;&nbsp;<IMG align='absmiddle' style=\"cursor: pointer;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_hide . "\" BORDER=\"0\" />   </span>";
       $lin_obj .= "              <span class=\"dn-expand-button\" style=\"cursor: pointer;\">";
       $lin_obj .= $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['appointment_start_date'];
       $lin_obj .= "              </span>";
       $lin_obj .= "          </td>";
       $lin_obj .= "          <td align='right'>";
       $lin_obj .= "              <span id=\"id_clear_appointment_start_date\" style=\"display: " .  $cle_disp . ";\">&nbsp;&nbsp;<IMG align='absmiddle' style=\"cursor: pointer;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_close . "\" BORDER=\"0\" onclick=\"event.stopPropagation(); nm_proc_int_search('clear','','','appointment_start_date', '', 'appointment_start_date', '', 'S')\"/>   </span>";
       $lin_obj .= "          </td>";
       $lin_obj .= "         </tr>";
       $lin_obj .= "        </table>";
       $lin_obj .= "     </td></tr>";
       $Cmps_where = "";
       $nm_comando = "select appointment_start_date, COUNT(*) AS countTest from " . $this->Ini->nm_tabela;
       $tmp_where = "";
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq']))
       {
           $tmp_where = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'];
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'])) 
       { 
           if (empty($tmp_where)) 
           { 
               $tmp_where = "where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']; 
           } 
           else
           { 
               $tmp_where .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'] . ")"; 
           } 
       } 
       $nm_comando .= " " . $tmp_where;
       $nm_comando .= " GROUP BY appointment_start_date". $Cmps_where;
       $nm_comando .= " order by appointment_start_date DESC";
       $result = array();
       $range_max = false;
       $range_min = false;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           { 
              if($RSI->fields[0] == '')
              {
                  if(isset($result[ $RSI->fields[0] ]))
                  {
                    $result[ $RSI->fields[0] ] += $RSI->fields[1];
                  }
                  else
                  {
                    $result[ $RSI->fields[0] ] = $RSI->fields[1];
                  }
              }
              else
              {
              if (!isset($result[substr($RSI->fields[0], 0, 4) . "-" . substr($RSI->fields[0], 5, 2)])) {
                  $result[substr($RSI->fields[0], 0, 4) . "-" . substr($RSI->fields[0], 5, 2)] = $RSI->fields[1];
              } else { 
                  $result[substr($RSI->fields[0], 0, 4) . "-" . substr($RSI->fields[0], 5, 2)] += $RSI->fields[1];
              }
              }
              if($range_max === false || $RSI->fields[0] > $range_max)
              {
                  $range_max = $RSI->fields[0];
              }
              if($range_min === false || $RSI->fields[0] < $range_min)
              {
                  $range_min = $RSI->fields[0];
              }
              $RSI->MoveNext() ;
           }  
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       krsort($result);
       $lin_mult  = "";
       $disp_link = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']['appointment_start_date'])) ? "" : "none";
       $lin_obj  .= "   <tr><td><div class='scGridRefinedSearchMolduraResult' id=\"id_tab_appointment_start_date_link\" style=\"display: " . $disp_link . ";\">";
        $check_uncheck  = "
            <span id='id_check_appointment_start_date' class='multipleappointment_start_date' style='display:" . (($displ_open)?'':'none') . ";'>
                <input class='scAppDivToolbarInput' style='margin:0px' type='checkbox' checked='checked' onclick=\"refinedSearchCheckUncheckAll('appointment_start_date', true); this.checked=true;\" \>
                <input class='scAppDivToolbarInput' style='margin:0px' type='checkbox'                   onclick=\"refinedSearchCheckUncheckAll('appointment_start_date', false); this.checked=false;\" \>
            </span>";
       $qtd_see_more  = (int)10;
       $qtd_result_see_more  = 0;
       $bol_open_see_more  = false;
       if($bol_refin_use_modal)
       {
           $bol_populate_modal_values = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_dados']['appointment_start_date'])?false:true);
       }
       foreach ($result as $dados => $qtd_result)
       {
           $formatado = $dados;
           $conteudo_x =  $formatado;
           nm_conv_limpa_dado($conteudo_x, "YYYY-MM");
           if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
           { 
               $this->nm_data->SetaData($formatado, "YYYY-MM  ");
               $formatado = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "mmaaaa"));
           } 
           $formatado_exib  = $formatado;
           $dados = (string)$dados;
           if($bol_refin_use_modal && $bol_populate_modal_values)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_dados']['appointment_start_date'][$dados] = array('val'=>$formatado,'qtd'=>$qtd_result);
           }
           if($dados == '')
           {
               $formatado_exib = "" . $this->Ini->Nm_lang['lang_refine_search_empty'] . "";
           }
           $veja_mais_link  = '';
           $veja_mais_link  =sprintf($this->Ini->Nm_lang['lang_othr_refinedsearch_more_mask'], $qtd_result);
           if($qtd_see_more > 0 && $qtd_result_see_more >= $qtd_see_more && !$bol_open_see_more)
           {
               $lin_obj  .= "   <div id='id_see_more_list_appointment_start_date' style='display:none'>";
               $bol_open_see_more  = true;
           }
           $on_mouse_over= "";
           $on_mouse_out = "";
           if(empty($disp_link))
           {
               $on_mouse_over= "$(this).find('img').css('opacity', 1);";
               $on_mouse_out = "$(this).find('img').css('opacity', 0);";
           }
           $lin_obj  .= "   <div class='scGridRefinedSearchCampo' onmouseover=\"". $on_mouse_over ."\" onmouseout=\"". $on_mouse_out ."\">";
           $lin_obj  .= "  <table cellspacing=0 cellpadding=0>";
           $lin_obj  .= "   <tr>";
           $lin_obj  .= "   <td>";
           $lin_obj  .= "   <span class='simpleappointment_start_date' style='display:" . (($displ_open)?'none':'') . ";'>";
           if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']['appointment_start_date']))
           {
               $lin_obj  .= "        <IMG align='absmiddle' style=\"cursor: pointer; position:relative; opacity:0;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_campo_close_icon . "\" BORDER=\"0\" onclick=\"nm_proc_int_search('clear_opc', 'dt','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['appointment_start_date']) . "','appointment_start_date','id_int_search_appointment_start_date','appointment_start_date', '" . NM_encode_input($dados . "##@@" . $formatado) . "', 'S');\"/>";
           }
           $lin_obj  .= "        <a href=\"javascript:nm_proc_int_search('link','dt','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['appointment_start_date']) . "','appointment_start_date','" . NM_encode_input(NM_encode_input_js($dados . "##@@" . $formatado)) . "', 'appointment_start_date', '', 'N');\" class='scGridRefinedSearchCampoFont'>";
           $lin_obj  .= $formatado_exib;
           if(!empty($veja_mais_link))
           {
               $lin_obj  .= "            <span class='scGridRefinedSearchQuantidade'>" . $veja_mais_link . "</span>";
           }
           $lin_obj  .= "        </a>";
           $lin_obj  .= "    </span>";
           $lin_obj  .= "    <span class='multipleappointment_start_date' style='display:"  . (($displ_open)?'':'none') .  ";'>";
           $checked = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']['appointment_start_date']['val_sel']) && in_array($dados, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']['appointment_start_date']['val_sel'])) ? " checked" : "";
           $checked = " checked";
           $lin_obj  .= "        <INPUT class='" . $this->css_scAppDivToolbarInput . "' style='margin:0px' type=\"checkbox\"  id=\"id_int_search_appointment_start_date_" . md5($dados) . "\" name=\"int_search_appointment_start_date[]\" value=\"" . NM_encode_input($dados . "##@@" . $formatado) . "\" $checked><span class='scGridRefinedSearchCampoFont'> <label for=\"id_int_search_appointment_start_date_". md5($dados) ."\" for=\"id_int_search_appointment_start_date_". md5($dados) ."\">" . $formatado_exib . "</label></span>";
           if(!empty($veja_mais_link))
           {
               $lin_obj  .= " <span class='scGridRefinedSearchQuantidade'>" . $veja_mais_link . "</span>";
           }
           $lin_obj  .= "    </span>";
           $lin_obj  .= "   </td>";
           $lin_obj  .= "    </tr>";
           $lin_obj  .= "   </table>";
           $lin_obj  .= "   </div>";
           $qtd_result_see_more++;
       }
           $displ_see_more = false;
           if($bol_open_see_more)
           {
               $lin_obj  .= "   </div>";
               $displ_see_more = true;
           }
           if($bol_refin_use_modal)
           {
               $displ_see_more = true;
           }
           $lin_obj  .= "   <div id='id_see_more_appointment_start_date' class='scGridRefinedSearchVejaMais'>";
           $lin_obj  .= "       " . $check_uncheck;
           if($bol_refin_use_modal)
           {
               $lin_obj  .= "       <a href=\"javascript:tb_show('', 'grid_appointments_adm_validar_refin_modal.php?sc_init=" . NM_encode_input($this->Ini->sc_page) . "&cmp_modal=appointment_start_date&tp_obj=dt&TB_iframe=true&modal=true&height=440&width=630', '');\" class='scGridRefinedSearchVejaMaisFont'>". $this->Ini->Nm_lang['lang_othr_refinedsearch_see_more'] ."</a>";
           }
           else
           {
               $lin_obj  .= "       <a style='display:" . (($displ_see_more)?'':'none') . ";'  href=\"javascript:toggleSeeMore('appointment_start_date');\" class='scGridRefinedSearchVejaMaisFont'>". $this->Ini->Nm_lang['lang_othr_refinedsearch_see_more'] ."</a>";
           }
           $lin_obj  .= "   </div>";
           $lin_obj  .= "   <div id='id_see_less_appointment_start_date' class='scGridRefinedSearchVejaMais' style='display:none;'>";
           $lin_obj  .= "   " . $check_uncheck;
           $lin_obj  .= "    <a href=\"javascript:toggleSeeMore('appointment_start_date');\" class='scGridRefinedSearchVejaMaisFont'>". $this->Ini->Nm_lang['lang_othr_refinedsearch_see_less'] ."</a>";
           $lin_obj  .= "   </div>";
           $lin_obj  .= "<SCRIPT>";
           $lin_obj  .= "$( document ).ready(function() {";
           $lin_obj  .= "    nm_expand_int_search('appointment_start_date');";
           $lin_obj  .= "});";
           $lin_obj  .= "</SCRIPT>";
           $lin_obj  .= "   </div></td></tr>";
           $lin_obj .= "    <tr class='toolbarFields'>";
           $lin_obj .= "    <td style='display:'>";
           $lin_obj .= "    <div class='scGridRefinedSearchToolbar' id=\"id_toolbar_appointment_start_date\" style='display:none'>";
           $disp_show_multi_btn = '';
           if (count($result) < 2)
           {
               $disp_show_multi_btn = 'none';
           }
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bmultiselect", "nm_mult_int_search('appointment_start_date', false);", "nm_mult_int_search('appointment_start_date', false);", "mult_int_search_appointment_start_date", "", "", "display: $disp_show_multi_btn;", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "multiselect", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $lin_obj .= $Cod_Btn; 
           $disp_multi_btn = 'none';
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_apply", "nm_proc_int_search('chbx', 'dt','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['appointment_start_date']) . "','appointment_start_date','id_int_search_appointment_start_date','appointment_start_date', '', 'N');", "nm_proc_int_search('chbx', 'dt','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['appointment_start_date']) . "','appointment_start_date','id_int_search_appointment_start_date','appointment_start_date', '', 'N');", "app_int_search_appointment_start_date", "", "", "display: $disp_multi_btn ;", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $lin_obj .= $Cod_Btn; 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_cancel", "nm_single_int_search('appointment_start_date');", "nm_single_int_search('appointment_start_date');", "single_int_search_appointment_start_date", "", "", "display: none", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $lin_obj .= $Cod_Btn; 
           $lin_obj .= "    </div>";
       $lin_obj .= "    </td>";
       $lin_obj .= "    </tr>";
       $lin_obj .= "    </table>";
       $lin_obj .= "    </div>";
       return $lin_obj;
   }
   function interativ_search_current_status_id($bol_refin_use_modal)
   {
       $cle_disp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']["current_status_id"])) ? "" : "none";
       $exp_disp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']["current_status_id"])) ? "none" : "";
       $displ_open= false;
       $lin_obj  = "    <div id=\"div_int_current_status_id\">";
       $lin_obj .= "    <table width='100%' cellspacing=0 cellpadding=0>";
       $lin_obj .= "     <tr>";
       $lin_obj .= "      <td nowrap class='scGridRefinedSearchLabel' onclick=\"nm_toggle_int_search('current_status_id')\">";
       $lin_obj .= "        <table width='100%' cellspacing=0 cellpadding=0>";
       $lin_obj .= "         <tr>";
       $lin_obj .= "          <td nowrap>";
       $lin_obj .= "              <span id=\"id_expand_current_status_id\" style=\"display: " .  $exp_disp . ";\">&nbsp;&nbsp;<IMG align='absmiddle' style=\"cursor: pointer; padding:0px 2px 0px 0px;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_show . "\" BORDER=\"0\" />   </span>";
       $lin_obj .= "              <span id=\"id_retract_current_status_id\" style=\"display: none;\">&nbsp;&nbsp;<IMG align='absmiddle' style=\"cursor: pointer;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_hide . "\" BORDER=\"0\" />   </span>";
       $lin_obj .= "              <span class=\"dn-expand-button\" style=\"cursor: pointer;\">";
       $lin_obj .= $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['current_status_id'];
       $lin_obj .= "              </span>";
       $lin_obj .= "          </td>";
       $lin_obj .= "          <td align='right'>";
       $lin_obj .= "              <span id=\"id_clear_current_status_id\" style=\"display: " .  $cle_disp . ";\">&nbsp;&nbsp;<IMG align='absmiddle' style=\"cursor: pointer;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_close . "\" BORDER=\"0\" onclick=\"event.stopPropagation(); nm_proc_int_search('clear','','','current_status_id', '', 'current_status_id', '', 'S')\"/>   </span>";
       $lin_obj .= "          </td>";
       $lin_obj .= "         </tr>";
       $lin_obj .= "        </table>";
       $lin_obj .= "     </td></tr>";
       $Cmps_where = "";
       $nm_comando = "select current_status_id, COUNT(*) AS countTest from " . $this->Ini->nm_tabela;
       $tmp_where = "";
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq']))
       {
           $tmp_where = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'];
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'])) 
       { 
           if (empty($tmp_where)) 
           { 
               $tmp_where = "where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']; 
           } 
           else
           { 
               $tmp_where .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'] . ")"; 
           } 
       } 
       $nm_comando .= " " . $tmp_where;
       $nm_comando .= " GROUP BY current_status_id". $Cmps_where;
       $nm_comando .= " order by current_status_id ASC";
       $result = array();
       $range_max = false;
       $range_min = false;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           { 
              if($RSI->fields[0] == '')
              {
                  if(isset($result[ $RSI->fields[0] ]))
                  {
                    $result[ $RSI->fields[0] ] += $RSI->fields[1];
                  }
                  else
                  {
                    $result[ $RSI->fields[0] ] = $RSI->fields[1];
                  }
              }
              else
              {
              $result[$RSI->fields[0]] = $RSI->fields[1];
              }
              if($range_max === false || $RSI->fields[0] > $range_max)
              {
                  $range_max = $RSI->fields[0];
              }
              if($range_min === false || $RSI->fields[0] < $range_min)
              {
                  $range_min = $RSI->fields[0];
              }
              $RSI->MoveNext() ;
           }  
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       $lin_mult  = "";
       $disp_link = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']['current_status_id'])) ? "" : "none";
       $lin_obj  .= "   <tr><td><div class='scGridRefinedSearchMolduraResult' id=\"id_tab_current_status_id_link\" style=\"display: " . $disp_link . ";\">";
        $check_uncheck  = "
            <span id='id_check_current_status_id' class='multiplecurrent_status_id' style='display:" . (($displ_open)?'':'none') . ";'>
                <input class='scAppDivToolbarInput' style='margin:0px' type='checkbox' checked='checked' onclick=\"refinedSearchCheckUncheckAll('current_status_id', true); this.checked=true;\" \>
                <input class='scAppDivToolbarInput' style='margin:0px' type='checkbox'                   onclick=\"refinedSearchCheckUncheckAll('current_status_id', false); this.checked=false;\" \>
            </span>";
       $qtd_see_more  = 0;
       $qtd_result_see_more  = 0;
       $bol_open_see_more  = false;
       if($bol_refin_use_modal)
       {
           $bol_populate_modal_values = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_dados']['current_status_id'])?false:true);
       }
       foreach ($result as $dados => $qtd_result)
       {
           $formatado = $dados;
           $this->Lookup->lookup_current_status_id($formatado , $formatado);
           $formatado_exib  = $formatado;
           $dados = (string)$dados;
           if($bol_refin_use_modal && $bol_populate_modal_values)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_dados']['current_status_id'][$dados] = array('val'=>$formatado,'qtd'=>$qtd_result);
           }
           if($dados == '')
           {
               $formatado_exib = "" . $this->Ini->Nm_lang['lang_refine_search_empty'] . "";
           }
           $veja_mais_link  = '';
           $veja_mais_link  =sprintf($this->Ini->Nm_lang['lang_othr_refinedsearch_more_mask'], $qtd_result);
           if($qtd_see_more > 0 && $qtd_result_see_more >= $qtd_see_more && !$bol_open_see_more)
           {
               $lin_obj  .= "   <div id='id_see_more_list_current_status_id' style='display:none'>";
               $bol_open_see_more  = true;
           }
           $on_mouse_over= "";
           $on_mouse_out = "";
           if(empty($disp_link))
           {
               $on_mouse_over= "$(this).find('img').css('opacity', 1);";
               $on_mouse_out = "$(this).find('img').css('opacity', 0);";
           }
           $lin_obj  .= "   <div class='scGridRefinedSearchCampo' onmouseover=\"". $on_mouse_over ."\" onmouseout=\"". $on_mouse_out ."\">";
           $lin_obj  .= "  <table cellspacing=0 cellpadding=0>";
           $lin_obj  .= "   <tr>";
           $lin_obj  .= "   <td>";
           $lin_obj  .= "   <span class='simplecurrent_status_id' style='display:" . (($displ_open)?'none':'') . ";'>";
           if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']['current_status_id']))
           {
               $lin_obj  .= "        <IMG align='absmiddle' style=\"cursor: pointer; position:relative; opacity:0;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_campo_close_icon . "\" BORDER=\"0\" onclick=\"nm_proc_int_search('clear_opc', 'nn','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['current_status_id']) . "','current_status_id','id_int_search_current_status_id','current_status_id', '" . NM_encode_input($dados . "##@@" . $formatado) . "', 'S');\"/>";
           }
           $lin_obj  .= "        <a href=\"javascript:nm_proc_int_search('link','nn','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['current_status_id']) . "','current_status_id','" . NM_encode_input(NM_encode_input_js($dados . "##@@" . $formatado)) . "', 'current_status_id', '', 'N');\" class='scGridRefinedSearchCampoFont'>";
           $lin_obj  .= $formatado_exib;
           if(!empty($veja_mais_link))
           {
               $lin_obj  .= "            <span class='scGridRefinedSearchQuantidade'>" . $veja_mais_link . "</span>";
           }
           $lin_obj  .= "        </a>";
           $lin_obj  .= "    </span>";
           $lin_obj  .= "    <span class='multiplecurrent_status_id' style='display:"  . (($displ_open)?'':'none') .  ";'>";
           $checked = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']['current_status_id']['val_sel']) && in_array($dados, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['interativ_search']['current_status_id']['val_sel'])) ? " checked" : "";
           $checked = " checked";
           $lin_obj  .= "        <INPUT class='" . $this->css_scAppDivToolbarInput . "' style='margin:0px' type=\"checkbox\"  id=\"id_int_search_current_status_id_" . md5($dados) . "\" name=\"int_search_current_status_id[]\" value=\"" . NM_encode_input($dados . "##@@" . $formatado) . "\" $checked><span class='scGridRefinedSearchCampoFont'> <label for=\"id_int_search_current_status_id_". md5($dados) ."\" for=\"id_int_search_current_status_id_". md5($dados) ."\">" . $formatado_exib . "</label></span>";
           if(!empty($veja_mais_link))
           {
               $lin_obj  .= " <span class='scGridRefinedSearchQuantidade'>" . $veja_mais_link . "</span>";
           }
           $lin_obj  .= "    </span>";
           $lin_obj  .= "   </td>";
           $lin_obj  .= "    </tr>";
           $lin_obj  .= "   </table>";
           $lin_obj  .= "   </div>";
           $qtd_result_see_more++;
       }
           $displ_see_more = false;
           if($bol_open_see_more)
           {
               $lin_obj  .= "   </div>";
               $displ_see_more = true;
           }
           if($bol_refin_use_modal)
           {
               $displ_see_more = true;
           }
           $lin_obj  .= "   <div id='id_see_more_current_status_id' class='scGridRefinedSearchVejaMais'>";
           $lin_obj  .= "       " . $check_uncheck;
           if($bol_refin_use_modal)
           {
               $lin_obj  .= "       <a href=\"javascript:tb_show('', 'grid_appointments_adm_validar_refin_modal.php?sc_init=" . NM_encode_input($this->Ini->sc_page) . "&cmp_modal=current_status_id&tp_obj=nn&TB_iframe=true&modal=true&height=440&width=630', '');\" class='scGridRefinedSearchVejaMaisFont'>". $this->Ini->Nm_lang['lang_othr_refinedsearch_see_more'] ."</a>";
           }
           else
           {
               $lin_obj  .= "       <a style='display:" . (($displ_see_more)?'':'none') . ";'  href=\"javascript:toggleSeeMore('current_status_id');\" class='scGridRefinedSearchVejaMaisFont'>". $this->Ini->Nm_lang['lang_othr_refinedsearch_see_more'] ."</a>";
           }
           $lin_obj  .= "   </div>";
           $lin_obj  .= "   <div id='id_see_less_current_status_id' class='scGridRefinedSearchVejaMais' style='display:none;'>";
           $lin_obj  .= "   " . $check_uncheck;
           $lin_obj  .= "    <a href=\"javascript:toggleSeeMore('current_status_id');\" class='scGridRefinedSearchVejaMaisFont'>". $this->Ini->Nm_lang['lang_othr_refinedsearch_see_less'] ."</a>";
           $lin_obj  .= "   </div>";
           $lin_obj  .= "<SCRIPT>";
           $lin_obj  .= "$( document ).ready(function() {";
           $lin_obj  .= "    nm_expand_int_search('current_status_id');";
           $lin_obj  .= "});";
           $lin_obj  .= "</SCRIPT>";
           $lin_obj  .= "   </div></td></tr>";
           $lin_obj .= "    <tr class='toolbarFields'>";
           $lin_obj .= "    <td style='display:'>";
           $lin_obj .= "    <div class='scGridRefinedSearchToolbar' id=\"id_toolbar_current_status_id\" style='display:none'>";
           $disp_show_multi_btn = '';
           if (count($result) < 2)
           {
               $disp_show_multi_btn = 'none';
           }
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bmultiselect", "nm_mult_int_search('current_status_id', false);", "nm_mult_int_search('current_status_id', false);", "mult_int_search_current_status_id", "", "", "display: $disp_show_multi_btn;", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "multiselect", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $lin_obj .= $Cod_Btn; 
           $disp_multi_btn = 'none';
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_apply", "nm_proc_int_search('chbx', 'nn','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['current_status_id']) . "','current_status_id','id_int_search_current_status_id','current_status_id', '', 'N');", "nm_proc_int_search('chbx', 'nn','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['int_search_label']['current_status_id']) . "','current_status_id','id_int_search_current_status_id','current_status_id', '', 'N');", "app_int_search_current_status_id", "", "", "display: $disp_multi_btn ;", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $lin_obj .= $Cod_Btn; 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_cancel", "nm_single_int_search('current_status_id');", "nm_single_int_search('current_status_id');", "single_int_search_current_status_id", "", "", "display: none", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $lin_obj .= $Cod_Btn; 
           $lin_obj .= "    </div>";
       $lin_obj .= "    </td>";
       $lin_obj .= "    </tr>";
       $lin_obj .= "    </table>";
       $lin_obj .= "    </div>";
       return $lin_obj;
   }
   function JS_interativ_search()
   {
       global $nm_saida;
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("     function toggleSeeMore(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if($('#id_see_less_'+obj_id).css('display') == 'none')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             $('#id_see_more_list_'+obj_id).slideDown();\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         else\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             $('#id_see_more_list_'+obj_id).slideUp();\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         $('#id_see_less_'+obj_id).toggle();\r\n");
       $nm_saida->saida("         $('#id_see_more_'+obj_id).toggle();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     var int_search_load_html = 'S';\r\n");
       $nm_saida->saida("     function nm_proc_int_search_all()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         int_search_load_html = 'N';\r\n");
       $nm_saida->saida("     if($( \"#id_slider_appointment_start_date\").length > 0)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         $('#app_int_search_range_appointment_start_date').click();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     else if($( \"input[name='int_search_appointment_start_date[]']:checked\" ).length > 0)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         $('#app_int_search_appointment_start_date').click();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     else\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         nm_proc_int_search('clear','','','appointment_start_date', '', 'appointment_start_date', '', 'S');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("         int_search_load_html = 'S';\r\n");
       $nm_saida->saida("     if($( \"#id_slider_current_status_id\").length > 0)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         $('#app_int_search_range_current_status_id').click();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     else if($( \"input[name='int_search_current_status_id[]']:checked\" ).length > 0)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         $('#app_int_search_current_status_id').click();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     else\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         nm_proc_int_search('clear','','','current_status_id', '', 'current_status_id', '', 'S');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_proc_int_clear_all()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         nm_proc_int_search('clear_all','','','', '', '', '', 'S');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_proc_int_search(tp_link, tp_obj, label, nam_db, val_obj, obj_id, val_atual, refresh)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         while (label.lastIndexOf(\"__sasp__\") != -1)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("           label = label.replace(\"__sasp__\" , \"'\");\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         while (nam_db.lastIndexOf(\"__sasp__\") != -1)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("           nam_db = nam_db.replace(\"__sasp__\" , \"'\");\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         while (label.lastIndexOf(\"__dasp__\") != -1)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("           label = label.replace(\"__dasp__\" , '\"');\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         while (nam_db.lastIndexOf(\"__dasp__\") != -1)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("           nam_db = nam_db.replace(\"__dasp__\" , '\"');\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         var out_int = nam_db + '__DL__' + label + '__DL__' + tp_obj + '__DL__';\r\n");
       $nm_saida->saida("         if (tp_link == 'clear_all')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             out_int += 'clear_interativ_all';\r\n");
       $nm_saida->saida("             Tab_obj_int_mult = {};\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (tp_link == 'clear')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             out_int += 'clear_interativ';\r\n");
       $nm_saida->saida("             Tab_obj_int_mult[ obj_id ] = 'N';\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (tp_link == 'clear_opc')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             result = int_search_get_checkbox(obj_id, val_atual);\r\n");
       $nm_saida->saida("             if (result != '') {\r\n");
       $nm_saida->saida("                 out_int += result;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             else {\r\n");
       $nm_saida->saida("                 out_int += 'clear_interativ';\r\n");
       $nm_saida->saida("                 Tab_obj_int_mult[\"'\" + obj_id + \"'\"] = 'N';\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (tp_link == 'link')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             out_int += val_obj;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (tp_link == 'range')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             out_int += $('#id_slider_' + obj_id).slider('values')[0] + \"_VLS_\" + $('#id_slider_' + obj_id).slider('values')[1];\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (tp_link == 'chbx' || tp_link == 'uncheck')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if(tp_link == 'uncheck')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 int_search_unset_checkbox(nam_db, val_atual, obj_id);\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             else\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 Tab_obj_int_mult[ obj_id ] = 'N';\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             result  = int_search_get_checkbox(obj_id, '');\r\n");
       $nm_saida->saida("             if(tp_link == 'chbx' && result == '')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 int_search_unset_checkbox(nam_db, val_atual, obj_id);\r\n");
       $nm_saida->saida("                 return;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             out_int += result;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         out_int  = out_int.replace(/[+]/g, \"__NM_PLUS__\");\r\n");
       $nm_saida->saida("         out_int  = out_int.replace(/[&]/g, \"__NM_AMP__\");\r\n");
       $nm_saida->saida("         out_int  = out_int.replace(/[%]/g, \"__NM_PRC__\");\r\n");
       $nm_saida->saida("         out_int  += '__DL__' + int_search_load_html;\r\n");
       $nm_saida->saida("         out_int  += '__DL__' + refresh;\r\n");
       $nm_saida->saida("         ajax_navigate('interativ_search', out_int);\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     var submit_checkbox = 'N';\r\n");
       $nm_saida->saida("     function nm_proc_check_parent_value(bol_checked, str_cmp, value_md5)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        $('#id_int_search_'+ str_cmp +'_' + value_md5).prop('checked', bol_checked);\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_proc_int_search_toggle()\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        if ($('#id_div_interativ_search').hasClass('is-closed')) {\r\n");
       $nm_saida->saida("            $('#id_div_interativ_search_content').show();\r\n");
       $nm_saida->saida("            $('#id_div_interativ_search').css('position', 'relative');\r\n");
       $nm_saida->saida("            $('#app_int_search_open').hide();\r\n");
       $nm_saida->saida("            $('#app_int_search_close').show();\r\n");
       $nm_saida->saida("        } else {\r\n");
       $nm_saida->saida("            $('#id_div_interativ_search_content').hide();\r\n");
       $nm_saida->saida("            $('#id_div_interativ_search').css('position', 'absolute');\r\n");
       $nm_saida->saida("            $('#app_int_search_open').show();\r\n");
       $nm_saida->saida("            $('#app_int_search_close').hide();\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        $('#id_div_interativ_search').toggleClass('is-closed');\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("     function int_search_unset_checkbox(nam_db, val_atual, obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         var obj_check = eval(\"document.getElementsByName('int_search_\" + obj_id + \"[]')\");\r\n");
       $nm_saida->saida("         has_checked = false;\r\n");
       $nm_saida->saida("         for (i = 0; i < obj_check.length; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if(obj_check[i].checked && obj_check[i].value == val_atual)\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 obj_check[i].checked = false;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             if(obj_check[i].checked)\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 has_checked = true;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         //if doesnt have checked anymore, clear\r\n");
       $nm_saida->saida("         if(!has_checked)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             nm_proc_int_search('clear','','', nam_db, '', obj_id, '', 'S')\r\n");
       $nm_saida->saida("             return;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function int_search_get_checkbox(obj_id, val_out)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var val  = \"\";\r\n");
       $nm_saida->saida("        $( \"input[name='int_search_\"+ obj_id +\"[]']:checked\" ).each(function(){\r\n");
       $nm_saida->saida("            if($(this).val() != val_out)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                val += $(this).val();\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        });\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_toggle_int_search(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if($('#id_expand_' + obj_id).css('display') != 'none')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             nm_expand_int_search(obj_id);\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         else\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             nm_retracts_int_search(obj_id);\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_expand_int_search(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if(submit_checkbox != 'S')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_int_mult[ obj_id ] && Tab_obj_int_mult[ obj_id ] == 'S') {\r\n");
       $nm_saida->saida("                 $('#app_int_search_' + obj_id).css('display','');\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             else\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 $('#app_int_search_' + obj_id).css('display','none');\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         $('#id_tab_' + obj_id + '_link').css('display','');\r\n");
       $nm_saida->saida("         $('#id_toolbar_' + obj_id).show();\r\n");
       $nm_saida->saida("         $('#id_retract_' + obj_id).css('display','');\r\n");
       $nm_saida->saida("         $('#id_expand_' + obj_id).css('display','none');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_retracts_int_search(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if(submit_checkbox != 'S')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             $('#app_int_search_' + obj_id).css('display','none');\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         $('#id_tab_' + obj_id + '_link').css('display','none');\r\n");
       $nm_saida->saida("         $('#id_toolbar_' + obj_id).hide();\r\n");
       $nm_saida->saida("         $('#id_retract_' + obj_id).css('display','none');\r\n");
       $nm_saida->saida("         $('#id_expand_' + obj_id).css('display','');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_mult_int_search(obj_id, bol_first)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         $('.simple' + obj_id).hide();\r\n");
       $nm_saida->saida("         $('.multiple' + obj_id).show();\r\n");
       $nm_saida->saida("         $('#mult_int_search_' + obj_id).hide();\r\n");
       $nm_saida->saida("         $('#single_int_search_' + obj_id).show();\r\n");
       $nm_saida->saida("         if(submit_checkbox != 'S')\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("            $('#app_int_search_' + obj_id).show();\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         Tab_obj_int_mult[ obj_id ] = 'S';\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_single_int_search(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         $('.simple' + obj_id).show();\r\n");
       $nm_saida->saida("         $('.multiple' + obj_id).hide();\r\n");
       $nm_saida->saida("         $('#mult_int_search_' + obj_id).show();\r\n");
       $nm_saida->saida("         $('#single_int_search_' + obj_id).hide();\r\n");
       $nm_saida->saida("         $('#app_int_search_' + obj_id).hide();\r\n");
       $nm_saida->saida("         Tab_obj_int_mult[ obj_id ] = 'N';\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("    function refinedSearchCheckUncheckAll(field_name, bol_value)\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        $(\"input[name='int_search_\"+ field_name +\"[]']\").prop('checked', bol_value);\r\n");
       $nm_saida->saida("        if (submit_checkbox == \"S\") {\r\n");
       $nm_saida->saida("            $('#app_int_search_' + field_name).click();\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("     $( document ).ready(function() {\r\n");
       $nm_saida->saida("        adjustMobile();\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("function adjustMobile()\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("</script>\r\n");
   }
//--- 
//--- 
 function grafico_pdf()
 {
   global $nm_saida, $nm_lang;
   require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
   $this->Graf  = new grid_appointments_adm_validar_grafico();
   $this->Graf->Db     = $this->Db;
   $this->Graf->Erro   = $this->Erro;
   $this->Graf->Ini    = $this->Ini;
   $this->Graf->Lookup = $this->Lookup;
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pivot_charts']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['skip_charts']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['skip_charts']))
   {
       $this->Graf->monta_grafico('', 'pdf_lib');
       $prim_graf = true;
       $nm_saida->saida("<B><div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_btns_chrt_pdff_hint'] . "</H1></div></B>\r\n");
       $iChartCount = 1;
       $iChartTotal = sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pivot_charts']);
       $sChartLang  = isset($this->Ini->Nm_lang['lang_pdff_pcht']) ? $this->Ini->Nm_lang['lang_pdff_pcht'] : 'Generating chart';
       if (!NM_is_utf8($sChartLang))
       {
           $sChartLang = sc_convert_encoding($sChartLang, "UTF-8", $_SESSION['scriptcase']['charset']);
       }
       $bChartFP = false;
      if (!isset($this->progress_fp) || !$this->progress_fp)
      {
           $bChartFP           = true;
           $str_pbfile         = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
           $this->progress_fp  = fopen($str_pbfile, 'a');
           $this->progress_tot = 100;
           $this->progress_now = 90;
           $this->progress_res = 0;
      }
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert'])
 { 
           $nm_saida->saida(" <style>\r\n");
            $nm_saida->saida("  table td, table tr{ page-break-inside: avoid !important; }\r\n");
           $nm_saida->saida(" </style>\r\n");
 } 
       $prim_graf = ($this->Ini->SC_module_export == "chart") ? true : false;
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['pivot_charts'] as $chart_index => $chart_data)
       {
           if (!$prim_graf)
           {
                   $nm_saida->saida("<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>\r\n");
           }
           $prim_graf = false;
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['proc_pdf_vert'])
 { 
           $nm_saida->saida("<table style=\"width: 100%; page-break-inside: avoid !important;\" ><tr><td>\r\n");
 } else {
           $nm_saida->saida("<table><tr><td>\r\n");
 } 
           $tit_graf = $chart_data['title'];
           if ('' != $chart_data['subtitle'])
           {
               $tit_graf .= ' - ' . $chart_data['subtitle'];
           }
           if ('UTF-8' != $_SESSION['scriptcase']['charset'])
           {
               $tit_graf = sc_convert_encoding($tit_graf, $_SESSION['scriptcase']['charset'], 'UTF-8');
           }
           $tit_book_marks = str_replace(" ", "&nbsp;", $tit_graf);
           $random_id = 'sc-id-h2-' . md5(session_id() . microtime() . rand(1, 1000));
           $nm_saida->saida("<b><h2 id=\"$random_id\">$tit_book_marks</h2></b>\r\n");
           if ($this->progress_fp)
           {
               grid_appointments_adm_validar_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $sChartLang . " " . $iChartCount . "...\n", $this->Ini->Nm_lang, true);
               fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $sChartLang . " " . $iChartCount . "...\n");
               $iChartCount++;
               if (0 < $this->progress_res)
               {
                   $this->progress_now++;
               }
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['this_chart_label'] = '';
           $this->Graf->monta_grafico($chart_index, 'pdf');
           $nm_saida->saida("</td></tr></table>\r\n");
       }
       if ($bChartFP)
       {
           $lang_protect = $this->Ini->Nm_lang['lang_pdff_gnrt'];
           if (!NM_is_utf8($lang_protect))
           {
               $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
           }
           grid_appointments_adm_validar_pdf_progress_call(100 . "_#NM#_" . 90 . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
           fwrite($this->progress_fp, 90 . "_#NM#_" . $lang_protect . "...\n");
           fclose($this->progress_fp);
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['charts_html']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['charts_html'])
       {
            $nm_saida->saida("<script type=\"text/javascript\">\r\n");
            $nm_saida->saida("{$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['charts_html']}\r\n");
            $nm_saida->saida("</script>\r\n");
       }
   }
       $nm_saida->saida("</body>\r\n");
       $nm_saida->saida("</HTML>\r\n");
 }
//--- 
//--- 
 function grafico_pdf_flash()
 {
   global $nm_saida, $nm_lang;
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['chart_list']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['chart_list'] as $arr_chart)
       {
           $nm_saida->saida("<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>\r\n");
       $nm_saida->saida("<b><div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_btns_chrt_pdff_hint'] . "</H1></div></b>\r\n");
           $nm_saida->saida("<table><tr><td>\r\n");
           $tit_graf       = $arr_chart[1];
           if ('UTF-8' != $_SESSION['scriptcase']['charset'])
           {
               $tit_graf = sc_convert_encoding($tit_graf, $_SESSION['scriptcase']['charset'], 'UTF-8');
           }
           $tit_book_marks = str_replace(" ", "&nbsp;", $tit_graf);
           $nm_saida->saida("<b><h2>$tit_book_marks</h2></b>\r\n");
           $nm_saida->saida("<img src='" . $arr_chart[0] . ".png'/>\r\n");
           $_SESSION['scriptcase']['sc_num_img']++;
           $nm_saida->saida("</td></tr></table>\r\n");
       }
   }
   $nm_saida->saida("</body>\r\n");
   $nm_saida->saida("</HTML>\r\n");
 }
//--- 
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
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
              if ($tam_campo >= $cont2)
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
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
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
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
   function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $alt_modal=0, $larg_modal=0, $opc="")
   {
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
                  $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar'][substr($val, 1, -1)];
              }
              else
              {
                  $tmp_parms .= $val;
              }
              $tmp_parms .= "?@?";
          }
          $nm_apl_parms = $tmp_parms;
      }
      $target = (empty($nm_target)) ? "_self" : $nm_target;
      if (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../")
      {
          echo "<SCRIPT language=\"javascript\">";
          if (strtolower($target) == "_blank")
          {
              echo "window.open ('" . $nm_apl_dest . "');";
              echo "</SCRIPT>";
              return;
          }
          else
          {
              echo "window.location='" . $nm_apl_dest . "';";
              echo "</SCRIPT>";
              exit;
          }
      }
      $dir = explode("/", $nm_apl_dest);
      if (count($dir) == 1)
      {
          $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
          $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
      }
      if ($nm_target == "modal")
      {
          if (!empty($nm_apl_parms))
          {
              $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
              $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
              $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
          }
          $par_modal = "?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
           if ((isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_form_full']) || (isset($this->grid_emb_form_full) && $this->grid_emb_form_full))
           {
              $this->redir_modal = "$(function() { parent.tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') }) \r\n";
           }
           else
           {
              $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') }) \r\n";
           }
          return;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['iframe_print']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['iframe_print'] )
      {
          $target = "_parent";
      }
      if (!isset($this->SC_redir_btn) || !$this->SC_redir_btn)
      {
   ?>
     <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
      <HTML>
      <HEAD>
      <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0," />
<?php
}
?>
       <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
       <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
       <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
       <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
       <META http-equiv="Pragma" content="no-cache"/>
      </HEAD>
      <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
      <BODY>
   <?php
      }
   ?>
   <form name="Fredir" method="post" 
                     target="_self"> 
     <input type="hidden" name="nmgp_parms" value="<?php echo NM_encode_input($nm_apl_parms) ?>"/>
<?php
   if ($target == "_blank")
   {
?>
       <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
     <input type="hidden" name="nmgp_url_saida" value="<?php echo NM_encode_input($nm_apl_retorno) ?>">
     <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page) ?>"/> 
<?php
   }
?>
   </form> 
      <SCRIPT type="text/javascript">
          window.onload = function(){
             submit_Fredir();
          };
          function submit_Fredir()
          {
              document.Fredir.target = "<?php echo $target ?>"; 
              document.Fredir.action = "<?php echo $nm_apl_dest ?>";
              document.Fredir.submit();
          }
      </SCRIPT>
   <?php
      if (!isset($this->SC_redir_btn) || !$this->SC_redir_btn)
      {
   ?>
      </BODY>
      </HTML>
   <?php
      }
      if ($target != "_blank")
      {
          exit;
      }
   }
 function check_btns()
 {
 }
 function nm_fim_grid($flag_apaga_pdf_log = TRUE)
 {
   global
   $nm_saida, $nm_url_saida, $NMSC_modal;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
        return;
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" &&
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao_print'] != "print" && !$this->Print_All) 
   { 
      $nm_saida->saida("     <tr><td colspan=3  class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\"> \r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_B_grid_appointments_adm_validar\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_B_grid_appointments_adm_validar\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
      $nm_saida->saida("     </td></tr> \r\n");
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
   { 
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']))
       {
           $temp = array();
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               $temp[] = $NM_aplic;
           }
           $temp = array_unique($temp);
           foreach ($temp as $NM_aplic)
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
               { 
                   $this->Ini->Arr_result['setArr'][] = array('var' => ' NM_tab_' . $NM_aplic, 'value' => '');
               } 
               $nm_saida->saida("   NM_tab_" . $NM_aplic . " = new Array();\r\n");
           }
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               foreach ($resto as $NM_ind => $NM_quebra)
               {
                   foreach ($NM_quebra as $NM_nivel => $NM_tipo)
                   {
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
                       { 
                           $this->Ini->Arr_result['setVar'][] = array('var' => ' NM_tab_' . $NM_aplic . '[' . $NM_ind . ']', 'value' => $NM_tipo . $NM_nivel);
                       } 
                       $nm_saida->saida("   NM_tab_" . $NM_aplic . "[" . $NM_ind . "] = '" . $NM_tipo . $NM_nivel . "';\r\n");
                   }
               }
           }
       }
   }
   $nm_saida->saida("   function NM_liga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = parseInt (Obj[tbody].substr(3));\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = parseInt (Obj[ind].substr(3));\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if (Nivel == Nv && Tp == 'top')\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if (((Nivel + 1) == Nv && Tp == 'top') || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='';\r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function NM_apaga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = Obj[tbody].substr(3);\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = Obj[ind].substr(3);\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if ((Nivel == Nv && Tp == 'top') || Nv < Nivel)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if ((Nivel != Nv) || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='none';\r\n");
   $nm_saida->saida("               if (Tp == 'top')\r\n");
   $nm_saida->saida("               {\r\n");
   $nm_saida->saida("                   document.getElementById('b_open_' + Apl + '_' + ind).style.display='';\r\n");
   $nm_saida->saida("                   document.getElementById('b_close_' + Apl + '_' + ind).style.display='none';\r\n");
   $nm_saida->saida("               } \r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   NM_obj_ant = '';\r\n");
   $nm_saida->saida("   function NM_apaga_div_lig(obj_nome)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      if (NM_obj_ant != '')\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_obj_ant.style.display='none';\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      obj = document.getElementById(obj_nome);\r\n");
   $nm_saida->saida("      NM_obj_ant = obj;\r\n");
   $nm_saida->saida("      ind_time = setTimeout(\"obj.style.display='none'\", 300);\r\n");
   $nm_saida->saida("      return ind_time;\r\n");
   $nm_saida->saida("   }\r\n");
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   if (@is_file($str_pbfile) && $flag_apaga_pdf_log)
   {
      @unlink($str_pbfile);
   }
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
   } 
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "");
       }
   }
   if (isset($this->redir_modal) && !empty($this->redir_modal))
   {
       echo $this->redir_modal;
   }
   $nm_saida->saida("   Tab_lig_apls    = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_init    = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_Type    = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_lab     = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_hint    = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_img_on  = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_img_off = new Array();\r\n");
   if (!empty($this->Ini->Init_apl_lig))
   {
       $ix = 0;
       foreach ($this->Ini->Init_apl_lig as $apls_name => $apls_parm)
       {
           $nm_saida->saida("   Tab_lig_apls[" . $ix . "] = '" . $apls_name . "';\r\n");
           $nm_saida->saida("   Tab_lig_init['" . $apls_name . "'] = '" . $apls_parm['ini'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_Type['" . $apls_name . "'] = '" . $apls_parm['type'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_lab['" . $apls_name . "'] = '" . $apls_parm['lab'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_hint['" . $apls_name . "'] = '" . $apls_parm['hint'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_img_on['" . $apls_name . "'] = '" . $apls_parm['img_on'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_img_off['" . $apls_name . "'] = '" . $apls_parm['img_off'] . "';\r\n");
           $ix++;
       }
   }
   $nm_saida->saida("   </script>\r\n");
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("      window.onload = function() {\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('grid_appointments_adm_validar', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      }\r\n");
       $nm_saida->saida("   </script>\r\n");
   }
   $nm_saida->saida("   </HTML>\r\n");
 }
//--- 
//--- 
 function form_navegacao()
 {
   global
   $nm_saida, $nm_url_saida;
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   $nm_saida->saida("   <form name=\"F3\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_chave\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_ordem\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"grid_appointments_adm_validar\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parm_acum\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_quant_linhas\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_orig_pesq\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F4\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"rec\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"rec\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_call_php\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F5\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"grid_appointments_adm_validar_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fprint\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"grid_appointments_adm_validar_iframe_prt.php\" \r\n");
   $nm_saida->saida("                     target=\"jan_print\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"path_botoes\" value=\"" . $this->Ini->path_botoes . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"tp_print\" value=\"PC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"cor_print\" value=\"PB\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_print\" value=\"PC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_print\" value=\"PB\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fexport\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tp_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tot_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_line\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_col\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_dados\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_label_csv\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_tag\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_format\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("  <form name=\"Fdoc_word\" method=\"post\" \r\n");
   $nm_saida->saida("        action=\"./\" \r\n");
   $nm_saida->saida("        target=\"_self\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"doc_word\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_word\" value=\"AM\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_navegator_print\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("  <form name=\"Fpdf\" method=\"post\" target=\"_self\">\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_tp_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_create_charts\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"chart_level\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"page_break_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"use_pass_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_cab\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_label\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_label_group\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_zip\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("    document.Fdoc_word.nmgp_navegator_print.value = navigator.appName;\r\n");
   $nm_saida->saida("   function nm_gp_word_conf(cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_cor_word=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fdoc_word.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fdoc_word.submit();\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var obj_tr      = \"\";\r\n");
   $nm_saida->saida("   var css_tr      = \"\";\r\n");
   $nm_saida->saida("   var field_over  = " . $this->NM_field_over . ";\r\n");
   $nm_saida->saida("   var field_click = " . $this->NM_field_click . ";\r\n");
   $nm_saida->saida("   function over_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_over != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj.className = '" . $this->css_scGridFieldOver . "';\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function out_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_over != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj.className = class_obj;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function click_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_click != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr != \"\")\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           obj_tr.className = css_tr;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       css_tr        = class_obj;\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           obj_tr     = '';\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj_tr        = obj;\r\n");
   $nm_saida->saida("       css_tr        = class_obj;\r\n");
   $nm_saida->saida("       obj.className = '" . $this->css_scGridFieldClick . "';\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var vls_check = \"\";\r\n");
   $nm_saida->saida("   function sc_btn_APROBAR()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       var checked_records, i;\r\n");
   $nm_saida->saida("       vls_check = \"\";\r\n");
   $nm_saida->saida("       checked_records = $(\".sc-ui-check-run\").filter(\":checked\");\r\n");
   $nm_saida->saida("       for (i = 0; i <= checked_records.length; i++)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           vls_check += (vls_check != \"\") ? \";\" : \"\";\r\n");
   $nm_saida->saida("           vls_check += $(checked_records[i]).val();\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (vls_check == \"\" || vls_check == \"0\" || vls_check == \"undefined\")\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           scJs_alert (\"" . $this->Ini->Nm_lang['lang_othr_slct'] . "\");\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       document.FBtn_Run.nm_run_opt_sel.value = vls_check;\r\n");
   $nm_saida->saida("       document.FBtn_Run.target = \"_self\";\r\n");
   $nm_saida->saida("       scJs_confirm('¿ Está Seguro De Aprobar Registros Seleccionados ?', sc_btn_APROBAR_ok, sc_btn_APROBAR_cancel)\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function sc_btn_APROBAR_ok()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.FBtn_Run.nm_call_php.value = \"APROBAR\";\r\n");
   $nm_saida->saida("       document.FBtn_Run.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function sc_btn_APROBAR_cancel()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       return;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var vls_check = \"\";\r\n");
   $nm_saida->saida("   function sc_btn_RECHAZAR()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       var checked_records, i;\r\n");
   $nm_saida->saida("       vls_check = \"\";\r\n");
   $nm_saida->saida("       checked_records = $(\".sc-ui-check-run\").filter(\":checked\");\r\n");
   $nm_saida->saida("       for (i = 0; i <= checked_records.length; i++)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           vls_check += (vls_check != \"\") ? \";\" : \"\";\r\n");
   $nm_saida->saida("           vls_check += $(checked_records[i]).val();\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (vls_check == \"\" || vls_check == \"0\" || vls_check == \"undefined\")\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           scJs_alert (\"" . $this->Ini->Nm_lang['lang_othr_slct'] . "\");\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       document.FBtn_Run.nm_run_opt_sel.value = vls_check;\r\n");
   $nm_saida->saida("       document.FBtn_Run.target = \"_self\";\r\n");
   $nm_saida->saida("       scJs_confirm('¿ Está Seguro De Rechazar Los Registros Seleccionados ?', sc_btn_RECHAZAR_ok, sc_btn_RECHAZAR_cancel)\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function sc_btn_RECHAZAR_ok()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.FBtn_Run.nm_call_php.value = \"RECHAZAR\";\r\n");
   $nm_saida->saida("       document.FBtn_Run.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function sc_btn_RECHAZAR_cancel()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       return;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_marca_check_grid(obj_mark)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      $(\".sc-ui-check-run\").prop(\"checked\", $(obj_mark).prop(\"checked\"));\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var tem_hint;\r\n");
   $nm_saida->saida("   function nm_mostra_hint(nm_obj, nm_evt, nm_mens)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (nm_mens == \"\")\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       tem_hint = true;\r\n");
   $nm_saida->saida("       if (document.layers)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           theString=\"<DIV CLASS='ttip'>\" + nm_mens + \"</DIV>\";\r\n");
   $nm_saida->saida("           document.tooltip.document.write(theString);\r\n");
   $nm_saida->saida("           document.tooltip.document.close();\r\n");
   $nm_saida->saida("           document.tooltip.left = nm_evt.pageX + 14;\r\n");
   $nm_saida->saida("           document.tooltip.top = nm_evt.pageY + 2;\r\n");
   $nm_saida->saida("           document.tooltip.visibility = \"show\";\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if(document.getElementById)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("              nmdg_nav = navigator.appName;\r\n");
   $nm_saida->saida("              elm = document.getElementById(\"tooltip\");\r\n");
   $nm_saida->saida("              elml = nm_obj;\r\n");
   $nm_saida->saida("              elm.innerHTML = nm_mens;\r\n");
   $nm_saida->saida("              if (nmdg_nav == \"Netscape\")\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  elm.style.height = elml.style.height;\r\n");
   $nm_saida->saida("                  elm.style.top = nm_evt.pageY + 2 + 'px';\r\n");
   $nm_saida->saida("                  elm.style.left = nm_evt.pageX + 14 + 'px';\r\n");
   $nm_saida->saida("              }\r\n");
   $nm_saida->saida("              else\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  elm.style.top = nm_evt.y + document.body.scrollTop + 10 + 'px';\r\n");
   $nm_saida->saida("                  elm.style.left = nm_evt.x + document.body.scrollLeft + 10 + 'px';\r\n");
   $nm_saida->saida("              }\r\n");
   $nm_saida->saida("              elm.style.visibility = \"visible\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_apaga_hint()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (!tem_hint)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       tem_hint = false;\r\n");
   $nm_saida->saida("       if (document.layers)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.tooltip.visibility = \"hidden\";\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if(document.getElementById)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("              elm.style.visibility = \"hidden\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   if ($this->Rec_ini == 0)
   {
       $nm_saida->saida("   nm_gp_ini = \"ini\";\r\n");
   }
   else
   {
       $nm_saida->saida("   nm_gp_ini = \"\";\r\n");
   }
   $nm_saida->saida("   nm_gp_rec_ini = \"" . $this->Rec_ini . "\";\r\n");
   $nm_saida->saida("   nm_gp_rec_fim = \"" . $this->Rec_fim . "\";\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['ajax_nav'])
   {
       if ($this->Rec_ini == 0)
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "ini");
       }
       else
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "");
       }
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_ini', 'value' => $this->Rec_ini);
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_fim', 'value' => $this->Rec_fim);
   }
   $nm_saida->saida("   function nm_gp_submit_rec(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (nm_gp_ini == \"ini\" && (campo == \"ini\" || campo == nm_gp_rec_ini)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      if (nm_gp_fim == \"fim\" && (campo == \"fim\" || campo == nm_gp_rec_fim)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      nm_gp_submit_ajax(\"rec\", campo); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_open_qsearch_div(pos)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("        if (typeof nm_gp_open_qsearch_div_mobile == 'function') {\r\n");
   $nm_saida->saida("            return nm_gp_open_qsearch_div_mobile(pos);\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        if($('#SC_fast_search_dropdown_' + pos).hasClass('fa-caret-down'))\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            var positioningV = 'top';\r\n");
   $nm_saida->saida("            var positioningH = 'left';\r\n");
   $nm_saida->saida("            if (pos == 'bot') {\r\n");
   $nm_saida->saida("                positioningV = 'bottom';\r\n");
   $nm_saida->saida("            }\r\n");
   $nm_saida->saida("            if ($('#quicksearchph_' + pos).offset().left + $('#id_qs_div_' + pos).width() > $(document).width()) {\r\n");
   $nm_saida->saida("                positioningH = 'right';\r\n");
   $nm_saida->saida("            }\r\n");
   $nm_saida->saida("            $('#id_qs_div_' + pos).css(positioningV, $('#quicksearchph_' + pos).outerHeight());\r\n");
   $nm_saida->saida("            $('#id_qs_div_' + pos).css(positioningH, '0px');\r\n");
   $nm_saida->saida("            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-down').addClass('fa-caret-up');\r\n");
   $nm_saida->saida("            nm_gp_open_qsearch_div_store_temp(pos);\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        else\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-up').addClass('fa-caret-down');\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        $('#id_qs_div_' + pos).toggle();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var tmp_qs_arr_fields = [], tmp_qs_arr_cond = \"\";\r\n");
   $nm_saida->saida("   function nm_gp_open_qsearch_div_store_temp(pos)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("        tmp_qs_arr_fields = [], tmp_qs_str_cond = \"\";\r\n");
   $nm_saida->saida("        if($('#fast_search_f0_' + pos).prop('type') == 'select-multiple')\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            tmp_qs_arr_fields = $('#fast_search_f0_' + pos).val();\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        else\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            tmp_qs_arr_fields.push($('#fast_search_f0_' + pos).val());\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        tmp_qs_str_cond = $('#cond_fast_search_f0_' + pos).val();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_cancel_qsearch_div_store_temp(pos)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("        $('#fast_search_f0_' + pos).val('');\r\n");
   $nm_saida->saida("        $(\"#fast_search_f0_\" + pos + \" option\").prop('selected', false);\r\n");
   $nm_saida->saida("        for(it=0; it<tmp_qs_arr_fields.length; it++)\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            $(\"#fast_search_f0_\" + pos + \" option[value='\"+ tmp_qs_arr_fields[it] +\"']\").prop('selected', true);\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        $(\"#fast_search_f0_\" + pos).change();\r\n");
   $nm_saida->saida("        tmp_qs_arr_fields = [];\r\n");
   $nm_saida->saida("        $('#cond_fast_search_f0_' + pos).val(tmp_qs_str_cond);\r\n");
   $nm_saida->saida("        $('#cond_fast_search_f0_' + pos).change();\r\n");
   $nm_saida->saida("        tmp_qs_str_cond = \"\";\r\n");
   $nm_saida->saida("        nm_gp_open_qsearch_div(pos);\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_submit_qsearch(pos) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       var out_qsearch = \"\";\r\n");
   $nm_saida->saida("       var ver_ch = eval('change_fast_' + pos);\r\n");
   $nm_saida->saida("       if (document.getElementById('SC_fast_search_' + pos).value == '' && ver_ch == '')\r\n");
   $nm_saida->saida("       { \r\n");
   $nm_saida->saida("           scJs_alert(\"" . $this->Ini->Nm_lang['lang_srch_req_field'] . "\");\r\n");
   $nm_saida->saida("           document.getElementById('SC_fast_search_' + pos).focus();\r\n");
   $nm_saida->saida("           return false;\r\n");
   $nm_saida->saida("       } \r\n");
   $nm_saida->saida("       if (document.getElementById('SC_fast_search_' + pos).value == '__Clear_Fast__')\r\n");
   $nm_saida->saida("       { \r\n");
   $nm_saida->saida("           document.getElementById('SC_fast_search_' + pos).value = '';\r\n");
   $nm_saida->saida("       } \r\n");
   $nm_saida->saida("       out_qsearch = $('#fast_search_f0_' + pos).val();\r\n");
   $nm_saida->saida("       out_qsearch += \"_SCQS_\" + $('#cond_fast_search_f0_' + pos).val();\r\n");
   $nm_saida->saida("       out_qsearch += \"_SCQS_\" + document.getElementById('SC_fast_search_' + pos).value;\r\n");
   $nm_saida->saida("       out_qsearch = out_qsearch.replace(/[+]/g, \"__NM_PLUS__\");\r\n");
   $nm_saida->saida("       out_qsearch = out_qsearch.replace(/[&]/g, \"__NM_AMP__\");\r\n");
   $nm_saida->saida("       out_qsearch = out_qsearch.replace(/[%]/g, \"__NM_PRC__\");\r\n");
   $nm_saida->saida("       ajax_navigate('fast_search', out_qsearch); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit_ajax(opc, parm) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      return ajax_navigate(opc, parm); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit2(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      nm_gp_submit_ajax(\"ordem\", campo); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit3(parms, parm_acum, opc, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target               = \"_self\"; \r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parm_acum.value = parm_acum ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_opcao.value     = opc ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = \"\";\r\n");
   $nm_saida->saida("      document.F3.action               = \"./\"  ;\r\n");
   $nm_saida->saida("      if (ancor != null) {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit4(apl_lig, apl_saida, parms, target, opc, apl_name, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      var sob_iframe = '';\r\n");
   if ((isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_modal']) || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard'])) {
       $nm_saida->saida("      sob_iframe += 'parent.';\r\n");
       $nm_saida->saida("      eval (\"var func_menu_aba = \" + sob_iframe + \"parent.createIframe\"); \r\n");
       $nm_saida->saida("      if (typeof func_menu_aba !== 'function') \r\n");
       $nm_saida->saida("      { \r\n");
       $nm_saida->saida("          sob_iframe += 'parent.';\r\n");
       $nm_saida->saida("      } \r\n");
   }
   $nm_saida->saida("      eval (\"var func_menu_aba = \" + sob_iframe + \"parent.createIframe\"); \r\n");
   $nm_saida->saida("      eval (\"var aba_atual = \" + sob_iframe + \"parent.Aba_atual\"); \r\n");
   $nm_saida->saida("      if (apl_name != null && apl_name != '' && typeof func_menu_aba === 'function') \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          for (i = 0; i < Tab_lig_apls.length; i++)\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              if (Tab_lig_apls[i] == apl_name)\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  if (opc != null && opc != '') \r\n");
   $nm_saida->saida("                  {\r\n");
   $nm_saida->saida("                      opc = \"grid\";\r\n");
   $nm_saida->saida("                  }\r\n");
   $nm_saida->saida("                  else\r\n");
   $nm_saida->saida("                  {\r\n");
   $nm_saida->saida("                      opc = \"igual\";\r\n");
   $nm_saida->saida("                  }\r\n");
   $nm_saida->saida("                  parms = parms.replace(/\\?#\\?/g, \"*scin\"); \r\n");
   $nm_saida->saida("                  parms = parms.replace(/\\?@\\?/g, \"*scout\"); \r\n");
   $nm_saida->saida("                  apl_lig += '?nmgp_parms=' + parms + '&nm_run_menu=1&nmgp_opcao=' + opc + Tab_lig_init[apl_name];\r\n");
   $nm_saida->saida("                  apl_lig += '&Refresh_aba_menu=' + aba_atual;\r\n");
   $nm_saida->saida("                  func_menu_aba(apl_name, Tab_lig_lab[apl_name], Tab_lig_hint[apl_name], Tab_lig_img_on[apl_name], Tab_lig_img_off[apl_name], apl_lig, Tab_lig_Type[apl_name]);\r\n");
   $nm_saida->saida("                  return;\r\n");
   $nm_saida->saida("              }\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.target = target; \r\n");
   $nm_saida->saida("      if (\"dbifrm_widget\" == target.substr(0, 13)) {\r\n");
   $nm_saida->saida("          var targetIframe = $(parent.document).find(\"[name='\" + target + \"']\");\r\n");
   $nm_saida->saida("          apl_lig = parent.scIframeSCInit && parent.scIframeSCInit[target] ? addUrlParam(apl_lig, \"script_case_init\", parent.scIframeSCInit[target]) : apl_lig;\r\n");
   $nm_saida->saida("          targetIframe.attr(\"src\", apl_lig);\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.action = apl_lig  ;\r\n");
   $nm_saida->saida("      if (opc == 'igual' || opc == 'novo') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = opc;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      if (opc != null && opc != '') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"igual\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value   = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value       = parms ;\r\n");
   $nm_saida->saida("      if (target == '_blank') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (target == 'new_tab') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (ancor != null && target == '_self') {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      parms = parms.replace(/@percent@/g, \"%\"); \r\n");
   $nm_saida->saida("      if (m_confirm != null && m_confirm != '') \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          if (confirm(m_confirm))\r\n");
   $nm_saida->saida("          { }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("             return;\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      var sob_iframe = '';\r\n");
   if ((isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_modal']) || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['dashboard_info']['under_dashboard'])) {
       $nm_saida->saida("      sob_iframe += 'parent.';\r\n");
       $nm_saida->saida("      eval (\"var func_menu_aba = \" + sob_iframe + \"parent.createIframe\"); \r\n");
       $nm_saida->saida("      if (typeof func_menu_aba !== 'function') \r\n");
       $nm_saida->saida("      { \r\n");
       $nm_saida->saida("          sob_iframe += 'parent.';\r\n");
       $nm_saida->saida("      } \r\n");
   }
   $nm_saida->saida("      eval (\"var func_menu_aba = \" + sob_iframe + \"parent.createIframe\"); \r\n");
   $nm_saida->saida("      if (apl_name != null && apl_name != '' && typeof func_menu_aba === 'function') \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          for (i = 0; i < Tab_lig_apls.length; i++)\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              if (Tab_lig_apls[i] == apl_name)\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  parms = parms.replace(/\\?#\\?/g, \"*scin\"); \r\n");
   $nm_saida->saida("                  parms = parms.replace(/\\?@\\?/g, \"*scout\"); \r\n");
   $nm_saida->saida("                  apl_lig += '?nmgp_parms=' + parms + '&nm_run_menu=1&nmgp_opcao=' + opc + Tab_lig_init[apl_name];\r\n");
   $nm_saida->saida("                  func_menu_aba(apl_name, Tab_lig_lab[apl_name], Tab_lig_hint[apl_name], Tab_lig_img_on[apl_name], Tab_lig_img_off[apl_name], apl_lig, Tab_lig_Type[apl_name]);\r\n");
   $nm_saida->saida("                  return;\r\n");
   $nm_saida->saida("              }\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          if (target == '_blank') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.open (apl_lig);\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.location = apl_lig;\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          return;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (target == 'modal' || target == 'modal_rpdf') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          par_modal = '?&nmgp_outra_jan=true&nmgp_url_saida=modal&SC_lig_apl_orig=grid_appointments_adm_validar';\r\n");
   $nm_saida->saida("          if (opc != null && opc != '') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              par_modal += '&nmgp_opcao=grid';\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          if (parms != null && parms != '') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              par_modal += '&nmgp_parms=' + parms;\r\n");
   $nm_saida->saida("          }\r\n");
   $Sc_parent = "";
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $Sc_parent = "parent.";
   }
   $nm_saida->saida("          if (target == 'modal') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("               " . $Sc_parent . "tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("               " . $Sc_parent . "tb_show('', apl_lig + par_modal + '&TB_iframe=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          return;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.target = target; \r\n");
   $nm_saida->saida("      if (target == '_blank') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (target == 'new_tab') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (\"dbifrm_widget\" == target.substr(0, 13)) {\r\n");
   $nm_saida->saida("          var targetIframe = $(parent.document).find(\"[name='\" + target + \"']\");\r\n");
   $nm_saida->saida("          apl_lig = parent.scIframeSCInit && parent.scIframeSCInit[target] ? addUrlParam(apl_lig, \"script_case_init\", parent.scIframeSCInit[target]) : apl_lig;\r\n");
   $nm_saida->saida("          targetIframe.attr(\"src\", apl_lig);\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.action = apl_lig;\r\n");
   $nm_saida->saida("      if (opc != null && opc != '') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      if (ancor != null && target == '_self') {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      document.F3.nmgp_outra_jan.value   = \"\" ;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function addUrlParam(sUrl, sParam, sValue) {\r\n");
   $nm_saida->saida("           var baseUrl, urlParams = [], objParams = {}, tmp, i;\r\n");
   $nm_saida->saida("           tmp = sUrl.split(\"?\");\r\n");
   $nm_saida->saida("           baseUrl = tmp[0];\r\n");
   $nm_saida->saida("           if (tmp[1]) {\r\n");
   $nm_saida->saida("                   urlParams = tmp[1].split(\"&\");\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           for (i = 0; i < urlParams.length; i++) {\r\n");
   $nm_saida->saida("                   tmp = urlParams[i].split(\"=\");\r\n");
   $nm_saida->saida("                   objParams[ tmp[0] ] = tmp[1] ? tmp[1] : \"\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           objParams[sParam] = sValue;\r\n");
   $nm_saida->saida("           urlParams = [];\r\n");
   $nm_saida->saida("           for (tmp in objParams) {\r\n");
   $nm_saida->saida("                   urlParams.push(tmp + \"=\" + objParams[tmp]);\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           return baseUrl + \"?\" + urlParams.join(\"&\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_submit6(apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   if ($_SESSION['scriptcase']['proc_mobile']) {
       $nm_saida->saida("   if (alt == '' || alt == 0) {\r\n");
       $nm_saida->saida("       alt = '440';\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   if (larg == '' || larg == 0) {\r\n");
       $nm_saida->saida("       larg = '630';\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   nm_gp_submit5(apl_lig, apl_saida, parms, 'modal', opc, alt, larg, m_confirm, apl_name, ancor); \r\n");
       $nm_saida->saida("   return;\r\n");
   }
   $nm_saida->saida("      if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          if (target == '_blank') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.open (apl_lig);\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.location = apl_lig;\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          return;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (pos == \"A\") {obj = document.getElementById('nmsc_iframe_liga_A_grid_appointments_adm_validar');} \r\n");
   $nm_saida->saida("      if (pos == \"B\") {obj = document.getElementById('nmsc_iframe_liga_B_grid_appointments_adm_validar');} \r\n");
   $nm_saida->saida("      if (pos == \"E\") {obj = document.getElementById('nmsc_iframe_liga_E_grid_appointments_adm_validar');} \r\n");
   $nm_saida->saida("      if (pos == \"D\") {obj = document.getElementById('nmsc_iframe_liga_D_grid_appointments_adm_validar');} \r\n");
   $nm_saida->saida("      obj.style.height = (alt == parseInt(alt)) ? alt + 'px' : alt;\r\n");
   $nm_saida->saida("      obj.style.width  = (larg == parseInt(larg)) ? larg + 'px' : larg;\r\n");
   $nm_saida->saida("      document.F3.target = target; \r\n");
   $nm_saida->saida("      document.F3.action = apl_lig  ;\r\n");
   $nm_saida->saida("      if (opc != null && opc != '') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      if (ancor != null && target == '_self') {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_open_export(arq_export) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      window.location = arq_export;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_submit_modal(parms, t_parent) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (t_parent == 'S' && typeof parent.tb_show == 'function')\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("           parent.tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("         tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_move(tipo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F6.target = \"_self\"; \r\n");
   $nm_saida->saida("      document.F6.submit() ;\r\n");
   $nm_saida->saida("      return;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_move(x, y, z, p, g, crt, ajax, chart_level, page_break_pdf, SC_module_export, use_pass_pdf, pdf_all_cab, pdf_all_label, pdf_label_group, pdf_zip) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       document.F3.action           = \"./\"  ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_parms.value = \"SC_null\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_orig_pesq.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_url_saida.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_opcao.value = x; \r\n");
   $nm_saida->saida("       document.F3.nmgp_outra_jan.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.target = \"_self\"; \r\n");
   $nm_saida->saida("       if (y == 1) \r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.target = \"_blank\"; \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (\"busca\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.nmgp_orig_pesq.value = z; \r\n");
   $nm_saida->saida("           z = '';\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (z != null && z != '') \r\n");
   $nm_saida->saida("       { \r\n");
   $nm_saida->saida("           document.F3.nmgp_tipo_pdf.value = z; \r\n");
   $nm_saida->saida("       } \r\n");
   $nm_saida->saida("       if (\"xls\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.SC_module_export.value = z;\r\n");
   if (!extension_loaded("zip"))
   {
       $nm_saida->saida("           alert (\"" . html_entity_decode($this->Ini->Nm_lang['lang_othr_prod_xtzp'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\");\r\n");
       $nm_saida->saida("           return false;\r\n");
   } 
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (\"xml\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.SC_module_export.value = z;\r\n");
   $nm_saida->saida("       }\r\n");
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['grid_appointments_adm_validar_iframe_params'] = array(
       'str_tmp'          => $this->Ini->path_imag_temp,
       'str_prod'         => $this->Ini->path_prod,
       'str_btn'          => $this->Ini->Str_btn_css,
       'str_lang'         => $this->Ini->str_lang,
       'str_schema'       => $this->Ini->str_schema_all,
       'str_google_fonts' => $this->Ini->str_google_fonts,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_appointments_adm_validar@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
   $nm_saida->saida("       if (\"pdf\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_opcao.value = \"pdf\";\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_parms.value = \"" . $Md5_pdf . "\";\r\n");
   $nm_saida->saida("           document.Fpdf.sc_tp_pdf.value = z;\r\n");
   $nm_saida->saida("           document.Fpdf.sc_parms_pdf.value = p;\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_parms_pdf.value = p;\r\n");
   $nm_saida->saida("           document.Fpdf.sc_create_charts.value = crt;\r\n");
   $nm_saida->saida("           document.Fpdf.sc_graf_pdf.value = g;\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_graf_pdf.value = g;\r\n");
   $nm_saida->saida("           document.Fpdf.chart_level.value = chart_level;\r\n");
   $nm_saida->saida("           document.Fpdf.page_break_pdf.value = page_break_pdf;\r\n");
   $nm_saida->saida("           document.Fpdf.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fpdf.use_pass_pdf.value = use_pass_pdf;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_all_cab.value = pdf_all_cab;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_all_label.value = pdf_all_label;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_label_group.value = pdf_label_group;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_zip.value = pdf_zip;\r\n");
   $nm_saida->saida("           document.Fpdf.script_case_init.value = \"" . NM_encode_input($this->Ini->sc_page) . "\";\r\n");
   $nm_saida->saida("           document.Fpdf.script_case_session.value = \"" . session_id() . "\";\r\n");
   $nm_saida->saida("           if (\"S\" == ajax)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               $('#TB_window').remove();\r\n");
   $nm_saida->saida("               $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__page_break_pdf=\" + page_break_pdf + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fpdf.action=\"grid_appointments_adm_validar_iframe.php\";\r\n");
   $nm_saida->saida("               document.Fpdf.submit();\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if ((x == 'igual' || x == 'edit') && NM_ancor_ult_lig != \"\")\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("                ajax_save_ancor(\"F3\", NM_ancor_ult_lig);\r\n");
   $nm_saida->saida("                NM_ancor_ult_lig = \"\";\r\n");
   $nm_saida->saida("            } else {\r\n");
   $nm_saida->saida("                document.F3.submit() ;\r\n");
   $nm_saida->saida("            } \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_print_conf(tp, cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_tipo_print=\" + tp + \"__E__cor_print=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fprint.tp_print.value = tp;\r\n");
   $nm_saida->saida("           document.Fprint.cor_print.value = cor;\r\n");
   $nm_saida->saida("           document.Fprint.nmgp_tipo_print.value = tp;\r\n");
   $nm_saida->saida("           document.Fprint.nmgp_cor_print.value = cor;\r\n");
   $nm_saida->saida("           document.Fprint.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fprint.nmgp_password.value = password;\r\n");
   $nm_saida->saida("               window.open('','jan_print','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("           document.Fprint.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xls_conf(tp_xls, SC_module_export, password, tot_xls, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"xls\";\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tp_xls.value = tp_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tot_xls.value = tot_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"csv\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_delim_line.value = delim_line;\r\n");
   $nm_saida->saida("           document.Fexport.nm_delim_col.value = delim_col;\r\n");
   $nm_saida->saida("           document.Fexport.nm_delim_dados.value = delim_dados;\r\n");
   $nm_saida->saida("           document.Fexport.nm_label_csv.value = label_csv;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xml_conf(xml_tag, xml_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value   = \"xml\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_tag.value   = xml_tag;\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_label.value = xml_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_json_conf(json_format, json_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_appointments_adm_validar/grid_appointments_adm_validar_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value       = \"json\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_format.value   = json_format;\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_label.value    = json_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value    = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   nm_img = new Image();\r\n");
   $nm_saida->saida("   function nm_mostra_img(imagem, altura, largura)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       tb_show(\"\", imagem, \"\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_mostra_doc(campo1, campo2)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (campo2 + \"?nmgp_parms=\" + campo1, \"ScriptCase\", \"resizable\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_escreve_window()\r\n");
   $nm_saida->saida("   {\r\n");
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['grid_appointments_adm_validar']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form  = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Form1 = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("           var Obj_Doc   = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form  = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Form1 = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("          var Obj_Doc   = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form  = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Form1 = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret']) . ";\r\n");
          $nm_saida->saida("          var Obj_Doc   = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['campo_psq_ret'] . "\");\r\n");
          $nm_saida->saida("          }\r\n");
      }
          $nm_saida->saida("          else\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = null;\r\n");
          $nm_saida->saida("          }\r\n");
      $nm_saida->saida("          if (Obj_Form.value != document.Fpesq.nm_ret_psq.value)\r\n");
      $nm_saida->saida("          {\r\n");
      $nm_saida->saida("              Obj_Form.value = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              if (Obj_Form != Obj_Form1 && Obj_Form1)\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form1.value = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              if (null != Obj_Readonly)\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Readonly.innerHTML = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              }\r\n");
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['js_apos_busca'] . "();\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              else if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
     else
     {
      $nm_saida->saida("              if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
      $nm_saida->saida("          }\r\n");
      $nm_saida->saida("      }\r\n");
   }
   $nm_saida->saida("      document.F5.action = \"grid_appointments_adm_validar_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['reg_start']))
   {
       $nm_saida->saida("      $(document).ready(function(){\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailStatus('grid_appointments_adm_validar')\",50);\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('grid_appointments_adm_validar', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      })\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>
