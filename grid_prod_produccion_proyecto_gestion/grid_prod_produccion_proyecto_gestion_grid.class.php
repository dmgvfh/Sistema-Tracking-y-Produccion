<?php
class grid_prod_produccion_proyecto_gestion_grid
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
   var $NM_cont_body; 
   var $NM_emb_tree_no; 
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
   var $array_presupuesto = array();
   var $count_ger;
   var $sum_modificacion_contrato;
   var $sum_facturacion;
   var $sum_reajuste;
   var $sum_retencion;
   var $sum_multa;
   var $sum_avance;
   var $sum_ur_real;
   var $sum_backlog_p;
   var $sum_backlog_f;
   var $presupuesto;
   var $iva;
   var $mod_contrato_iva;
   var $id_empresa;
   var $id_proyecto;
   var $modificacion_contrato;
   var $facturacion;
   var $reajuste;
   var $retencion;
   var $multa;
   var $avance;
   var $ur_real;
   var $backlog_p;
   var $backlog_f;
   var $id;

function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

//--- 
 function monta_grid($linhas = 0)
 {
   global $nm_saida;

   clearstatcache();
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] == "sc_free_total")
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
       { 
          include_once($this->Ini->path_embutida . "grid_prod_produccion_proyecto_gestion/" . $this->Ini->Apl_resumo); 
       } 
       else 
       { 
          include_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
       } 
       $this->Res         = new grid_prod_produccion_proyecto_gestion_resumo();
       $this->Res->Db     = $this->Db;
       $this->Res->Erro   = $this->Erro;
       $this->Res->Ini    = $this->Ini;
       $this->Res->Lookup = $this->Lookup;
   } 
   $this->NM_cor_embutida();
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['grid_pesq'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['grid_pesq'] = array();
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       $this->nm_fim_grid();
   } 
   else 
   { 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['pdf_res'])
       {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf_vert'])
            {
            } 
            else
            {
                $this->cabecalho();
            } 
       } 
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf_vert'])
            {
            } 
            else
            {
       $nm_saida->saida("                  <TR>\r\n");
       $nm_saida->saida("                  <TD id='sc_grid_content' style='padding: 0px;' colspan=1>\r\n");
            } 
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       if (!$this->Proc_link_res && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print')
       { 
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("      <TD id=\"div_refin_search\" class=\"scGridRefinedSearchPadding\" valign='top'>\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $this->html_interativ_search();
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['refresh_interativ']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['refresh_interativ'] == "S") {
                   $this->Ini->Arr_result['setValue'][] = array('field' => 'div_refin_search', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               }
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['refresh_interativ']);
               $tb_disp = (!empty($this->nm_grid_sem_reg) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_int_search']) ? 'none' : '';
               $this->Ini->Arr_result['setDisplay'][] = array('field' => 'TB_Interativ_Search', 'value' => $tb_disp);
           } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_int_search'] = false;
       $nm_saida->saida("      </TD>\r\n");
       $nm_saida->saida("      <TD class=\"scGridRefinedSearchMolduraResult\" valign='top'>\r\n");
       $nm_saida->saida("       <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       } 
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_prod_produccion_proyecto_gestion'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
       } 
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['save_grid']))
       {
           $this->refresh_interativ_search();
       }
       unset ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['save_grid']);
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['pdf_res'] && (!isset($_GET['flash_graf']) || 'chart' != $_GET['flash_graf']))
       {
           $this->grid();
       }
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_bot();
       } 
       if (!$this->Proc_link_res && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf' && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print')
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
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['print_all'] && empty($this->nm_grid_sem_reg) && ($Gera_res || $Gera_graf) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] != "sc_free_total")
       { 
           $this->Res->monta_html_ini_pdf();
           $this->Res->monta_resumo();
           $this->Res->monta_html_fim_pdf();
           if ($Gera_graf)
           {
               $this->grafico_pdf();
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] != "sc_free_total")
       { 
           if (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
           {
               $this->Res->monta_resumo(true);
               require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
               $this->Graf  = new grid_prod_produccion_proyecto_gestion_grafico();
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
       $flag_apaga_pdf_log = TRUE;
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'];
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['orig_pesq'] = "grid";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Ind_lig_mult'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Ind_lig_mult'] = 0;
   }
   $this->Img_embbed      = false;
   $this->nm_data         = new nm_data("es");
   $this->pdf_label_group = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_pdf']['label_group'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_pdf']['label_group'] : "S";
   $this->pdf_all_cab     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_pdf']['all_cab']))     ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_pdf']['all_cab'] : "N";
   $this->pdf_all_label   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_pdf']['all_label']))   ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_pdf']['all_label'] : "N";
   $this->Fix_bar_top     = false;
   $this->Fix_bar_bottom  = false;
   $this->Grid_body       = 'id="sc_grid_body"';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   {
       $this->Grid_body = "";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['fix_top'])) {
       $this->Fix_bar_top = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['fix_top'] == "S") ? true : false;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['fix_bot'])) {
       $this->Fix_bar_bottom = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['fix_bot'] == "S") ? true : false;
   }
   $this->Css_Cmp = array();
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = explode(",", trim(substr($cada_css, 1, $Pos1 - 1)));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['doc_word'])
       { 
           $this->Css_Cmp[$Tag[0]] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag[0]] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] || $this->Ini->Embutida_iframe)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Lig_Md5'] = array();
   }
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['force_toolbar']);
   } 
       $this->Tem_tab_vert = false;
   $this->width_tabula_quebra  = "0px";
   $this->width_tabula_display = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit'] != '')
   {
       if ($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit'] == "on")  {$_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit'] = "S";}
       if ($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit'] == "off") {$_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit'] = "N";}
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['psq_edit'] == 'N'))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['mostra_edit'] = "N";
   }
   $this->NM_cont_body   = 0; 
   $this->NM_emb_tree_no = false; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ind_tree'] = 0;
   }
   elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['emb_tree_no']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['emb_tree_no'])
   { 
       $this->NM_emb_tree_no = true; 
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("grid_prod_produccion_proyecto_gestion", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['group_2'] = "on";
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_4'] = "on";
   $this->nmgp_botoes['group_3'] = "on";
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
   $this->nmgp_botoes['goto'] = "on";
   $this->nmgp_botoes['qtline'] = "on";
   $this->nmgp_botoes['navpage'] = "on";
   $this->nmgp_botoes['rows'] = "on";
   $this->nmgp_botoes['summary'] = "on";
   $this->nmgp_botoes['sel_col'] = "on";
   $this->nmgp_botoes['sort_col'] = "on";
   $this->nmgp_botoes['qsearch'] = "on";
   $this->nmgp_botoes['groupby'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->nmgp_botoes['SC_btn_0'] = "on";
   $this->Cmps_ord_def['id_proyecto'] = " desc";
   $this->Cmps_ord_def['modificacion_contrato'] = " desc";
   $this->Cmps_ord_def['facturacion'] = " desc";
   $this->Cmps_ord_def['reajuste'] = " desc";
   $this->Cmps_ord_def['retencion'] = " desc";
   $this->Cmps_ord_def['multa'] = " desc";
   $this->Cmps_ord_def['avance'] = " desc";
   $this->Cmps_ord_def['ur_real'] = " desc";
   $this->Cmps_ord_def['backlog_p'] = " desc";
   $this->Cmps_ord_def['backlog_f'] = " desc";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->Proc_link_res = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_resumo'])) 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['doc_word'] || $this->Ini->sc_export_ajax_img)
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->id_empresa = (isset($Busca_temp['id_empresa'])) ? $Busca_temp['id_empresa'] : ""; 
       $tmp_pos = (is_string($this->id_empresa)) ? strpos($this->id_empresa, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->id_empresa))
       {
           $this->id_empresa = substr($this->id_empresa, 0, $tmp_pos);
       }
       $this->id_proyecto = (isset($Busca_temp['id_proyecto'])) ? $Busca_temp['id_proyecto'] : ""; 
       $tmp_pos = (is_string($this->id_proyecto)) ? strpos($this->id_proyecto, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->id_proyecto))
       {
           $this->id_proyecto = substr($this->id_proyecto, 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "muda_qt_linhas";
   } 
       ob_start(); 
   $_SESSION['scriptcase']['grid_prod_produccion_proyecto_gestion']['contr_erro'] = 'on';
 if ($this->id_empresa <>"")
	{
	  if (empty($this->sc_where_atual ))
	{
	$this->nm_where_dinamico = " where id_proyecto in (SELECT id from proyectos where id_empresa=".$this->id_empresa .")";
	
	} 
	else 
	{
	$this->nm_where_dinamico = " and id_proyecto in (SELECT id from proyectos where id_empresa=".$this->id_empresa .")";
	}
	}
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio']);
}

$_SESSION['scriptcase']['grid_prod_produccion_proyecto_gestion']['contr_erro'] = 'off'; 
       $this->SC_Buf_onInit = ob_get_clean();; 

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_prod_produccion_proyecto_gestion'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_prod_produccion_proyecto_gestion'];

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
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sub_cons_iframe_btns'] as $BTN => $BTN_opc) {
           $this->nmgp_botoes[$BTN] = $BTN_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "grid_prod_produccion_proyecto_gestion_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_pdf'] != "pdf")  
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new grid_prod_produccion_proyecto_gestion_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] = 10;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['rows'];  
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_select']['id_proyecto'] = 'asc'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_select']['fecha'] = 'DESC'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_quebra'] = array(); 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       $Ordem_tem_quebra = true;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao']       = "igual" ; 
       if ($this->Ini->sc_export_ajax) 
       { 
           $this->Img_embbed = true;
       } 
   } 
// 
   $this->count_ger = 0;
   $this->sum_modificacion_contrato = 0;
   $this->sum_facturacion = 0;
   $this->sum_reajuste = 0;
   $this->sum_retencion = 0;
   $this->sum_multa = 0;
   $this->sum_avance = 0;
   $this->sum_ur_real = 0;
   $this->sum_backlog_p = 0;
   $this->sum_backlog_f = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][1] ;  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] != "sc_free_total") 
   { 
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][1];
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_total']);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] == "sc_free_total")
       { 
           $this->totaliza_php_sc_free_total() ; 
       } 
       else 
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'];
           $this->Tot->$Gb_geral();
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] != "sc_free_total") 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['contr_array_resumo']))  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['contr_array_resumo'] = "NAO";
           } 
       }
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] = 0 ; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start--; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
   {
       $this->Ini->Qtd_reg_ajax_grid = $this->count_ger;
   }
   else
   {
       $this->Ini->Qtd_reg_ajax_grid = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid'];
   }
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT id_proyecto, SUM(modificacion_contrato) as modificacion_contrato, sum(facturacion) as facturacion, SUM(reajuste) as reajuste, SUM(retencion) as retencion, SUM(multa) as multa, sum(avance) as avance, ur_real, backlog_p, backlog_f, id from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT id_proyecto, SUM(modificacion_contrato) as modificacion_contrato, sum(facturacion) as facturacion, SUM(reajuste) as reajuste, SUM(retencion) as retencion, SUM(multa) as multa, sum(avance) as avance, ur_real, backlog_p, backlog_f, id from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq']; 
   $nmgp_select .= " group by id_proyecto"; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_desc']; 
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
   if (substr(trim($nmgp_order_by), -1) == ",")
   {
       $nmgp_order_by = " " . substr(trim($nmgp_order_by), 0, -1);
   }
   if (trim($nmgp_order_by) == "order by")
   {
       $nmgp_order_by = "";
   }
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
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
       $this->modificacion_contrato = $this->rs_grid->fields[1] ;  
       $this->modificacion_contrato =  str_replace(",", ".", $this->modificacion_contrato);
       $this->modificacion_contrato = (string)$this->modificacion_contrato;
       $this->facturacion = $this->rs_grid->fields[2] ;  
       $this->facturacion =  str_replace(",", ".", $this->facturacion);
       $this->facturacion = (string)$this->facturacion;
       $this->reajuste = $this->rs_grid->fields[3] ;  
       $this->reajuste =  str_replace(",", ".", $this->reajuste);
       $this->reajuste = (string)$this->reajuste;
       $this->retencion = $this->rs_grid->fields[4] ;  
       $this->retencion =  str_replace(",", ".", $this->retencion);
       $this->retencion = (string)$this->retencion;
       $this->multa = $this->rs_grid->fields[5] ;  
       $this->multa =  str_replace(",", ".", $this->multa);
       $this->multa = (string)$this->multa;
       $this->avance = $this->rs_grid->fields[6] ;  
       $this->avance =  str_replace(",", ".", $this->avance);
       $this->avance = (string)$this->avance;
       $this->ur_real = $this->rs_grid->fields[7] ;  
       $this->ur_real =  str_replace(",", ".", $this->ur_real);
       $this->ur_real = (string)$this->ur_real;
       $this->backlog_p = $this->rs_grid->fields[8] ;  
       $this->backlog_p =  str_replace(",", ".", $this->backlog_p);
       $this->backlog_p = (string)$this->backlog_p;
       $this->backlog_f = $this->rs_grid->fields[9] ;  
       $this->backlog_f =  str_replace(",", ".", $this->backlog_f);
       $this->backlog_f = (string)$this->backlog_f;
       $this->id = $this->rs_grid->fields[10] ;  
       $this->id = (string)$this->id;
       $GLOBALS["id"] = $this->rs_grid->fields[10] ;  
       $GLOBALS["id"] = (string)$GLOBALS["id"] ;
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $this->Lookup->lookup_presupuesto($this->presupuesto, $this->id, $this->id_proyecto, $this->array_presupuesto); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->id_proyecto = $this->rs_grid->fields[0] ;  
           $this->modificacion_contrato = $this->rs_grid->fields[1] ;  
           $this->facturacion = $this->rs_grid->fields[2] ;  
           $this->reajuste = $this->rs_grid->fields[3] ;  
           $this->retencion = $this->rs_grid->fields[4] ;  
           $this->multa = $this->rs_grid->fields[5] ;  
           $this->avance = $this->rs_grid->fields[6] ;  
           $this->ur_real = $this->rs_grid->fields[7] ;  
           $this->backlog_p = $this->rs_grid->fields[8] ;  
           $this->backlog_f = $this->rs_grid->fields[9] ;  
           $this->id = $this->rs_grid->fields[10] ;  
       } 
   } 
   $this->NM_hidden_filters = ($this->Ini->Embutida_iframe && !empty($this->nm_grid_sem_reg) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['initialize']) ? true : false;
   $this->nmgp_reg_inicial  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final'] + 1;
   $this->nmgp_reg_final    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid'];
   $this->nmgp_reg_final    = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
       if (!$this->Ini->sc_export_ajax && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> Producción de Proyectos :: PDF</TITLE>
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
                    <meta name="msapplication-TileColor" content="#E7EDF1">
                    <meta name="msapplication-TileImage" content="">
                    <meta name="theme-color" content="#E7EDF1">
                    <meta name="apple-mobile-web-app-status-bar-style" content="#E7EDF1">
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
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['pivot_charts']) : 0;
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
               grid_prod_produccion_proyecto_gestion_pdf_progress_call("PDF\n", $this->Ini->Nm_lang);
               grid_prod_produccion_proyecto_gestion_pdf_progress_call($this->Ini->path_js   . "\n", $this->Ini->Nm_lang);
               grid_prod_produccion_proyecto_gestion_pdf_progress_call($this->Ini->path_prod . "/img/\n", $this->Ini->Nm_lang);
               grid_prod_produccion_proyecto_gestion_pdf_progress_call($this->progress_tot   . "\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "PDF\n");
               fwrite($this->progress_fp, $this->Ini->path_js   . "\n");
               fwrite($this->progress_fp, $this->Ini->path_prod . "/img/\n");
               fwrite($this->progress_fp, $this->progress_tot   . "\n");
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_strt'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               grid_prod_produccion_proyecto_gestion_pdf_progress_call($this->progress_tot . "_#NM#_" . "1_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "1_#NM#_" . $lang_protect . "...\n");
               flush();
           }
       }
       $nm_fundo_pagina = ""; 
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
       $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>" . $this->Ini->Nm_lang['lang_othr_grid_title'] . " Producción de Proyectos</TITLE>\r\n");
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
$nm_saida->saida("                        <meta name=\"msapplication-TileColor\" content=\"#E7EDF1\" >\r\n");
$nm_saida->saida("                        <meta name=\"msapplication-TileImage\" content=\"\">\r\n");
$nm_saida->saida("                        <meta name=\"theme-color\" content=\"#E7EDF1\">\r\n");
$nm_saida->saida("                        <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"#E7EDF1\">\r\n");
$nm_saida->saida("                        <link rel=\"shortcut icon\" href=\"\">\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate('D, d M Y H:i:s') . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $this->NM_opcao != "pdf") {
           $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'] && !$this->Ini->sc_export_ajax)
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
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var clear_reload = '';\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_prod_produccion_proyecto_gestion_jquery-3.6.0.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_prod_produccion_proyecto_gestion_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_prod_produccion_proyecto_gestion_message.js\"></script>\r\n");
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
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <style type=\"text/css\"> \r\n");
           $nm_saida->saida("     .scGridLabelFont img[src\$='" . $this->Ini->Label_sort_desc . "'], \r\n");
           $nm_saida->saida("     .scGridLabelFont img[src\$='" . $this->Ini->Label_sort_asc . "'], \r\n");
           $nm_saida->saida("     .scGridLabelFont img[src\$='" . $this->arr_buttons['bgraf']['image'] . "'], \r\n");
           $nm_saida->saida("     .scGridLabelFont img[src\$='" . $this->arr_buttons['bconf_graf']['image'] . "']{opacity:1!important;} \r\n");
           $nm_saida->saida("     .scGridLabelFont img{opacity:0;transition:all .2s;} \r\n");
           $nm_saida->saida("     .scGridLabelFont:HOVER img{opacity:1;transition:all .2s;} \r\n");
           $nm_saida->saida("   </style> \r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid']) . ";\r\n");
           }
           $nm_saida->saida("  function SC_init_jquery(isScrollNav){ \r\n");
           $nm_saida->saida("   \$(function(){ \r\n");
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
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ancor_save']);
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
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_pdf']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_pdf'])
       {
           $write_css = true;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_prod_produccion_proyecto_gestion_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
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
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_prod_produccion_proyecto_gestion_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['num_css'] . '.css');
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_grid_prod_produccion_proyecto_gestion_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf") {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       } 
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
  if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf_vert'])
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $Pos1 = strpos($cada_css, "{");
           $Pos2 = strpos($cada_css, "}");
           if ($Pos1 !== false && $Pos2 !== false) {
               $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
               $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
               $cada_css = ".grid_prod_produccion_proyecto_gestion_" . substr(trim($Tag[0]), 1);
               if (isset($Tag[1])) {
                   $cada_css .= ", .grid_prod_produccion_proyecto_gestion_" . substr(trim($Tag[1]), 1);
               }
               $cada_css .= $Css;
           }
           else {
               $cada_css = ".grid_prod_produccion_proyecto_gestion_" . substr($cada_css, 1);
           }
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   $this->css_body_embutida = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['css_body_embutida'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['css_body_embutida'] : "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
       if (!$this->Ini->Export_html_zip && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['doc_word'] && ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] == "print")) 
       {
           if ($this->Print_All) 
           {
               $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           }
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"-webkit-print-color-adjust: exact;" . $css_body . $this->css_body_embutida . "\" onload=\"javascript:setTimeout(function(){clear_reload = nm_gp_submit_ajax ('igual', 'reload');},300000);\">\r\n");
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
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"" . $remove_margin . $vertical_center . $css_body . $this->css_body_embutida . "\" onload=\"javascript:setTimeout(function(){clear_reload = nm_gp_submit_ajax ('igual', 'reload');},300000);\">\r\n");
       }
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none;\" class='scDebugWindow'><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" && !$this->Print_All)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] == "sc_free_total")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = "";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['pdf_res'])
       {
           return;
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['css_body_embutida'])) {
       $remove_border = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['css_body_embutida'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf_vert'])
   {
   }
   else
   {
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\" style=\"" . (isset($remove_border) ? $remove_border : '') . "\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
   }
   }  
 }  
 function NM_cor_embutida()
 {  
   $compl_css = "";
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   {
       $this->arr_buttons = array_merge($this->arr_buttons, $this->Ini->arr_buttons_usr);
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_prod_produccion_proyecto_gestion']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_prod_produccion_proyecto_gestion']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_prod_produccion_proyecto_gestion']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_prod_produccion_proyecto_gestion']) . "_";
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

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida']) ? "grid_prod_produccion_proyecto_gestion_" : "";
   $this->css_sep = " ";
   $this->css_id_proyecto_label = $compl_css_emb . "css_id_proyecto_label";
   $this->css_id_proyecto_grid_line = $compl_css_emb . "css_id_proyecto_grid_line";
   $this->css_presupuesto_label = $compl_css_emb . "css_presupuesto_label";
   $this->css_presupuesto_grid_line = $compl_css_emb . "css_presupuesto_grid_line";
   $this->css_modificacion_contrato_label = $compl_css_emb . "css_modificacion_contrato_label";
   $this->css_modificacion_contrato_grid_line = $compl_css_emb . "css_modificacion_contrato_grid_line";
   $this->css_facturacion_label = $compl_css_emb . "css_facturacion_label";
   $this->css_facturacion_grid_line = $compl_css_emb . "css_facturacion_grid_line";
   $this->css_reajuste_label = $compl_css_emb . "css_reajuste_label";
   $this->css_reajuste_grid_line = $compl_css_emb . "css_reajuste_grid_line";
   $this->css_retencion_label = $compl_css_emb . "css_retencion_label";
   $this->css_retencion_grid_line = $compl_css_emb . "css_retencion_grid_line";
   $this->css_multa_label = $compl_css_emb . "css_multa_label";
   $this->css_multa_grid_line = $compl_css_emb . "css_multa_grid_line";
   $this->css_avance_label = $compl_css_emb . "css_avance_label";
   $this->css_avance_grid_line = $compl_css_emb . "css_avance_grid_line";
   $this->css_ur_real_label = $compl_css_emb . "css_ur_real_label";
   $this->css_ur_real_grid_line = $compl_css_emb . "css_ur_real_grid_line";
   $this->css_backlog_p_label = $compl_css_emb . "css_backlog_p_label";
   $this->css_backlog_p_grid_line = $compl_css_emb . "css_backlog_p_grid_line";
   $this->css_backlog_f_label = $compl_css_emb . "css_backlog_f_label";
   $this->css_backlog_f_grid_line = $compl_css_emb . "css_backlog_f_grid_line";
   $this->css_iva_label = $compl_css_emb . "css_iva_label";
   $this->css_iva_grid_line = $compl_css_emb . "css_iva_grid_line";
   $this->css_mod_contrato_iva_label = $compl_css_emb . "css_mod_contrato_iva_label";
   $this->css_mod_contrato_iva_grid_line = $compl_css_emb . "css_mod_contrato_iva_grid_line";
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cond_pesq'], 0, $trab_pos);
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf_vert']) 
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
   $nm_saida->saida("    <div class=\"" . $this->css_scGridHeaderFont . "\" style=\"float: left; text-transform: uppercase;\">" . $this->Ini->Nm_lang['lang_othr_grid_title'] . " Producción de Proyectos</div>\r\n");
   $nm_saida->saida("    <div class=\"" . $this->css_scGridHeaderFont . "\" style=\"float: right;\"></div>\r\n");
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
   if (1 < $linhas)
   {
      $this->Lin_impressas++;
   }
   $nm_seq_titulos++; 
   $tmp_header_row = $nm_seq_titulos;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['exibe_titulos']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_label'])
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
      $Lab_Add_Emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida']) ? "grid_prod_produccion_proyecto_gestion_" : "";
   $nm_saida->saida("    <TR class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-grid_prod_produccion_proyecto_gestion-" . $tmp_header_row . "\" align=\"center\">\r\n");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_label'])
      { 
       $nm_saida->saida("      <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
      } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'])
   {
       $nm_saida->saida("      <TD class=\"" . $this->css_scGridLabelFont . "\">&nbsp;</TD>\r\n");
   }
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . ' ' . $Lab_Add_Emb . "css_L1C1_label\" colspan=3 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C1_label'] . "\">INFORMACIÓN PERIODO</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . ' ' . $Lab_Add_Emb . "css_L1C2_label\" colspan=4 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C2_label'] . "\">FACTURACIÓN</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . ' ' . $Lab_Add_Emb . "css_L1C3_label\" style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C3_label'] . "\">PRODUCCIÓN</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . ' ' . $Lab_Add_Emb . "css_L1C4_label\" colspan=3 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C4_label'] . "\">INDICADORES</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   $nm_saida->saida("    <TR id=\"tit_grid_prod_produccion_proyecto_gestion__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-grid_prod_produccion_proyecto_gestion-" . $tmp_header_row . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_label']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_mod_contrato_iva_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_mod_contrato_iva_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
   } 
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_label'])
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
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $Pos1 = strpos($cada_css, "{");
                 $Pos2 = strpos($cada_css, "}");
                 if ($Pos1 !== false && $Pos2 !== false) {
                     $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
                     $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
                     $cada_css = ".grid_prod_produccion_proyecto_gestion_" . substr(trim($Tag[0]), 1);
                     if (isset($Tag[1])) {
                         $cada_css .= ", .grid_prod_produccion_proyecto_gestion_" . substr(trim($Tag[1]), 1);
                     }
                     $css_emb .= $cada_css . $Css;
                 }
                 else {
                       $css_emb .= ".grid_prod_produccion_proyecto_gestion_" . substr($cada_css, 1);
                 }
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cols_emb'] = count($Nm_temp) - 1;
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
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels'] as $NM_cmp => $NM_lab)
     {
         if (empty($NM_lab) || $NM_lab == "&nbsp;")
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels'][$NM_cmp] = "No_Label" . $NM_seq_lab;
             $NM_seq_lab++;
         }
     } 
   } 
 }
 function NM_label_id_proyecto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['id_proyecto'])) ? $this->New_label['id_proyecto'] : "Código Proyecto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_id_proyecto_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_id_proyecto_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
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
 function NM_label_presupuesto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['presupuesto'])) ? $this->New_label['presupuesto'] : "Presupuesto Base<br>Proyecto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['presupuesto']) || $this->NM_cmp_hidden['presupuesto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_presupuesto_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_presupuesto_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
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
 function NM_label_modificacion_contrato()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['modificacion_contrato'])) ? $this->New_label['modificacion_contrato'] : "Modificacion Contrato";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['modificacion_contrato']) || $this->NM_cmp_hidden['modificacion_contrato'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_modificacion_contrato_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_modificacion_contrato_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "modificacion_contrato";
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_modificacion_contrato_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_modificacion_contrato_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
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
 function NM_label_facturacion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['facturacion'])) ? $this->New_label['facturacion'] : "Facturacion Total Neto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['facturacion']) || $this->NM_cmp_hidden['facturacion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_facturacion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_facturacion_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "facturacion";
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_facturacion_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_facturacion_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
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
 function NM_label_reajuste()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['reajuste'])) ? $this->New_label['reajuste'] : "Reajuste Total Neto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['reajuste']) || $this->NM_cmp_hidden['reajuste'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_reajuste_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_reajuste_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "reajuste";
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_reajuste_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_reajuste_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
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
 function NM_label_retencion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['retencion'])) ? $this->New_label['retencion'] : "Retención Total Neto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['retencion']) || $this->NM_cmp_hidden['retencion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_retencion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_retencion_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "retencion";
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_retencion_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_retencion_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
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
 function NM_label_multa()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['multa'])) ? $this->New_label['multa'] : "Multas Total Neto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['multa']) || $this->NM_cmp_hidden['multa'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_multa_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_multa_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "multa";
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_multa_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_multa_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
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
 function NM_label_avance()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['avance'])) ? $this->New_label['avance'] : "Producción Total Neto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['avance']) || $this->NM_cmp_hidden['avance'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_avance_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_avance_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "avance";
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_avance_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_avance_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
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
 function NM_label_ur_real()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ur_real'])) ? $this->New_label['ur_real'] : "UR Acumulado<br>Mes";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ur_real']) || $this->NM_cmp_hidden['ur_real'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ur_real_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ur_real_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('ur_real');
        $fieldSortIcon = $this->scGetColumnOrderIcon('ur_real', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_ur_real_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_ur_real_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('ur_real')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_backlog_p()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['backlog_p'])) ? $this->New_label['backlog_p'] : "Backlog P";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['backlog_p']) || $this->NM_cmp_hidden['backlog_p'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_backlog_p_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_backlog_p_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('backlog_p');
        $fieldSortIcon = $this->scGetColumnOrderIcon('backlog_p', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_backlog_p_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_backlog_p_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('backlog_p')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_backlog_f()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['backlog_f'])) ? $this->New_label['backlog_f'] : "Backlog F";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['backlog_f']) || $this->NM_cmp_hidden['backlog_f'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_backlog_f_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_backlog_f_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('backlog_f');
        $fieldSortIcon = $this->scGetColumnOrderIcon('backlog_f', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_backlog_f_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_backlog_f_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('backlog_f')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_iva()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['iva'])) ? $this->New_label['iva'] : "Facturación<br> Con IVA";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['iva']) || $this->NM_cmp_hidden['iva'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_iva_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_iva_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
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
 function NM_label_mod_contrato_iva()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['mod_contrato_iva'])) ? $this->New_label['mod_contrato_iva'] : "Mod. Contrato<bR> Con IVA";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['mod_contrato_iva']) || $this->NM_cmp_hidden['mod_contrato_iva'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_mod_contrato_iva_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_mod_contrato_iva_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
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
    function scGetColumnOrderRule($fieldName)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_cmp'] == $fieldName) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_label'] == 'desc') {
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
            case "modificacion_contrato":
                return true;
            case "facturacion":
                return true;
            case "reajuste":
                return true;
            case "retencion":
                return true;
            case "multa":
                return true;
            case "avance":
                return true;
            case "ur_real":
                return true;
            case "backlog_p":
                return true;
            case "backlog_f":
                return true;
            case "iva":
                return true;
            case "mod_contrato_iva":
                return true;
            case "id":
                return true;
            case "costos":
                return true;
            case "correlativo_mes":
                return true;
            case "ur_mes":
                return true;
            case "produccion_neto":
                return true;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "id_proyecto":
                return 'desc';
            case "modificacion_contrato":
                return 'desc';
            case "facturacion":
                return 'desc';
            case "reajuste":
                return 'desc';
            case "retencion":
                return 'desc';
            case "multa":
                return 'desc';
            case "avance":
                return 'desc';
            case "ur_real":
                return 'desc';
            case "backlog_p":
                return 'desc';
            case "backlog_f":
                return 'desc';
            case "id":
                return 'desc';
            case "fecha":
                return 'desc';
            case "costos":
                return 'desc';
            case "correlativo_mes":
                return 'desc';
            case "ur_mes":
                return 'desc';
            case "produccion_neto":
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ini_cor_grid']);
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
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['id_proyecto'])) ? $this->New_label['id_proyecto'] : "Código Proyecto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['id_proyecto'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['presupuesto'])) ? $this->New_label['presupuesto'] : "Presupuesto Base<br>Proyecto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['presupuesto'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['modificacion_contrato'])) ? $this->New_label['modificacion_contrato'] : "Modificacion Contrato";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['modificacion_contrato'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['facturacion'])) ? $this->New_label['facturacion'] : "Facturacion Total Neto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['facturacion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['reajuste'])) ? $this->New_label['reajuste'] : "Reajuste Total Neto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['reajuste'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['retencion'])) ? $this->New_label['retencion'] : "Retención Total Neto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['retencion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['multa'])) ? $this->New_label['multa'] : "Multas Total Neto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['multa'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['avance'])) ? $this->New_label['avance'] : "Producción Total Neto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['avance'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ur_real'])) ? $this->New_label['ur_real'] : "UR Acumulado<br>Mes";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['ur_real'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['backlog_p'])) ? $this->New_label['backlog_p'] : "Backlog P";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['backlog_p'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['backlog_f'])) ? $this->New_label['backlog_f'] : "Backlog F";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['backlog_f'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['iva'])) ? $this->New_label['iva'] : "Facturación<br> Con IVA";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['iva'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['mod_contrato_iva'])) ? $this->New_label['mod_contrato_iva'] : "Mod. Contrato<bR> Con IVA";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['labels']['mod_contrato_iva'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto_gestion']['lig_edit'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_refresh'])
   {
       $this->refresh_interativ_search();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_refresh'] = false;
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-size:12px;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_grid_prod_produccion_proyecto_gestion#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-size:12px;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cab_embutida'] != "S")
               {
                   $this->label_grid($linhas);
               }
               $this->NM_calc_span();
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridFieldOdd . "\"  style=\"padding: 0px; font-size:12px;\" colspan = \"" . $this->NM_colspan . "\" align=\"center\">\r\n");
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
           $nm_saida->saida("  <td " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;" . $this->css_body_embutida . "font-size:12px;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_grid_prod_produccion_proyecto_gestion#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'])
{
}
else
{
       $nm_saida->saida("    <TR> \r\n");
}
       $nm_id_aplicacao = " id=\"apl_grid_prod_produccion_proyecto_gestion#?#1\"";
   } 
   $TD_padding = "";
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf_vert'])
{
}
else
{
   $nm_saida->saida("  <TD " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;" . $TD_padding . $this->css_body_embutida . "\">\r\n");
}
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf']) { 
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
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf']) { 
 }else { 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-f6eb9cbd\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
 }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['cab_embutida'] != "S" )
      { 
          $this->label_grid($linhas);
      } 
   } 
   elseif (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf']) 
   { 
      $this->label_grid($linhas);
   } 
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf_vert']) { 
    $nm_saida->saida("</thead>\r\n");
 }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] && $this->pdf_all_label != "S" && $this->pdf_label_group != "S") 
   { 
      $this->label_grid($linhas);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $this->nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final'] = 0;
   } 
   $this->nmgp_prim_pag_pdf = true;
   $this->Break_pag_pdf = array();
   $this->Break_pag_prt = array();
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Config_Page_break_PDF'] = "N";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Page_break_PDF']))
   {
       if (isset($this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby']]))
       {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Gb_Free_cmp'] as $Cmp_gb => $resto)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Page_break_PDF'][$Cmp_gb] = $this->Break_pag_pdf['sc_free_group_by'][$Cmp_gb];
               }
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Page_break_PDF'] = $this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby']];
           }
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Page_break_PDF'] = array();
       }
   }
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $nm_prog_barr = 0;
   $PB_tot       = "/" . $this->count_ger;;
   $nm_houve_quebra = "N";
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          //---------- Gauge ----------
          if (!$this->Ini->sc_export_ajax && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" && -1 < $this->progress_grid)
          {
              $this->progress_now++;
              if (0 == $this->progress_lim_now)
              {
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_rows'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
                  grid_prod_produccion_proyecto_gestion_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n", $this->Ini->Nm_lang);
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
          $this->modificacion_contrato = $this->rs_grid->fields[1] ;  
          $this->modificacion_contrato =  str_replace(",", ".", $this->modificacion_contrato);
          $this->modificacion_contrato = (string)$this->modificacion_contrato;
          $this->facturacion = $this->rs_grid->fields[2] ;  
          $this->facturacion =  str_replace(",", ".", $this->facturacion);
          $this->facturacion = (string)$this->facturacion;
          $this->reajuste = $this->rs_grid->fields[3] ;  
          $this->reajuste =  str_replace(",", ".", $this->reajuste);
          $this->reajuste = (string)$this->reajuste;
          $this->retencion = $this->rs_grid->fields[4] ;  
          $this->retencion =  str_replace(",", ".", $this->retencion);
          $this->retencion = (string)$this->retencion;
          $this->multa = $this->rs_grid->fields[5] ;  
          $this->multa =  str_replace(",", ".", $this->multa);
          $this->multa = (string)$this->multa;
          $this->avance = $this->rs_grid->fields[6] ;  
          $this->avance =  str_replace(",", ".", $this->avance);
          $this->avance = (string)$this->avance;
          $this->ur_real = $this->rs_grid->fields[7] ;  
          $this->ur_real =  str_replace(",", ".", $this->ur_real);
          $this->ur_real = (string)$this->ur_real;
          $this->backlog_p = $this->rs_grid->fields[8] ;  
          $this->backlog_p =  str_replace(",", ".", $this->backlog_p);
          $this->backlog_p = (string)$this->backlog_p;
          $this->backlog_f = $this->rs_grid->fields[9] ;  
          $this->backlog_f =  str_replace(",", ".", $this->backlog_f);
          $this->backlog_f = (string)$this->backlog_f;
          $this->id = $this->rs_grid->fields[10] ;  
          $this->id = (string)$this->id;
          $GLOBALS["id"] = $this->rs_grid->fields[10] ;  
          $GLOBALS["id"] = (string)$GLOBALS["id"];
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final'] + 1; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rows_emb']++;
          $this->sc_proc_grid = true;
          $_SESSION['scriptcase']['grid_prod_produccion_proyecto_gestion']['contr_erro'] = 'on';
 $this->iva =$this->facturacion  * 1.19;
$this->mod_contrato_iva =$this->modificacion_contrato *1.19;
$check_sql = "SELECT   prod_produccion_proyecto.backlog_p,  prod_produccion_proyecto.backlog_f,ur_real FROM  prod_produccion_proyecto WHERE   prod_produccion_proyecto.id_proyecto = ".$this->id_proyecto . " ORDER BY  prod_produccion_proyecto.`fecha` DESC limit 1";
 
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
    $this->backlog_p  = $this->rs[0][0];
    $this->backlog_f  = $this->rs[0][1];
	$this->ur_real =$this->rs[0][2];
}
		else     
{
	$this->backlog_p  = 0;
    $this->backlog_f  = 0;
	$this->ur_real =0;
}
$_SESSION['scriptcase']['grid_prod_produccion_proyecto_gestion']['contr_erro'] = 'off';
          $this->Lookup->lookup_presupuesto($this->presupuesto, $this->id, $this->id_proyecto, $this->array_presupuesto); 
          $this->nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['final']; 
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
              if ($temp == "fecha")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "mmaaaa"));
                  } 
              }
          }
          $this->SC_ancora = $this->SC_seq_page;
          $nm_saida->saida("    <TR  class=\"" . $this->css_line_back . "\"" . $NM_destaque . " id=\"SC_ancor" . $this->SC_ancora . "\">\r\n");
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->Css_Cmp['css_mod_contrato_iva_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">&nbsp;</TD>\r\n");
 }
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_mod_contrato_iva_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
          } 
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
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
   if (!$this->rs_grid->EOF) 
   { 
       if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
       {
           $nm_saida->saida("    </TBODY>");
       }
   } 
   if ($this->rs_grid->EOF) 
   { 
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['exibe_total'] == "S")
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] . "_top";
           $this->$Gb_geral() ;
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] . "_bot";
           $this->$Gb_geral() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao']       = "igual" ; 
   } 
 }
 function NM_grid_id_proyecto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->id_proyecto));
              $conteudo_original = NM_encode_input(sc_strip_script($this->id_proyecto));
          }
          else {
              $conteudo = sc_strip_script($this->id_proyecto); 
              $conteudo_original = sc_strip_script($this->id_proyecto); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_id_proyecto($conteudo , $this->id_proyecto) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_id_proyecto_grid_line . "\"  style=\"" . $this->Css_Cmp['css_id_proyecto_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_id_proyecto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_presupuesto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['presupuesto']) || $this->NM_cmp_hidden['presupuesto'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->presupuesto)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->presupuesto)); 
          $conteudo = trim($this->presupuesto); 
          nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "N", "", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_presupuesto_grid_line . "\"  style=\"" . $this->Css_Cmp['css_presupuesto_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_presupuesto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_modificacion_contrato()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['modificacion_contrato']) || $this->NM_cmp_hidden['modificacion_contrato'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->modificacion_contrato)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->modificacion_contrato)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_modificacion_contrato_grid_line . "\"  style=\"" . $this->Css_Cmp['css_modificacion_contrato_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_modificacion_contrato_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_facturacion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['facturacion']) || $this->NM_cmp_hidden['facturacion'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->facturacion)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->facturacion)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_facturacion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_facturacion_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_facturacion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_reajuste()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['reajuste']) || $this->NM_cmp_hidden['reajuste'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->reajuste)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->reajuste)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_reajuste_grid_line . "\"  style=\"" . $this->Css_Cmp['css_reajuste_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_reajuste_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_retencion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['retencion']) || $this->NM_cmp_hidden['retencion'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->retencion)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->retencion)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_retencion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_retencion_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_retencion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_multa()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['multa']) || $this->NM_cmp_hidden['multa'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->multa)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->multa)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_multa_grid_line . "\"  style=\"" . $this->Css_Cmp['css_multa_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_multa_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_avance()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['avance']) || $this->NM_cmp_hidden['avance'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->avance)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->avance)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_avance_grid_line . "\"  style=\"" . $this->Css_Cmp['css_avance_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_avance_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ur_real()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ur_real']) || $this->NM_cmp_hidden['ur_real'] != "off") { 
          $nm_cor_num = ($this->ur_real < 0) ? "color:#FF0000;" : "";
          $conteudo = NM_encode_input(sc_strip_script($this->ur_real)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ur_real)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ur_real_grid_line . "\"  style=\"" . $nm_cor_num . "" . $this->Css_Cmp['css_ur_real_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ur_real_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_backlog_p()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['backlog_p']) || $this->NM_cmp_hidden['backlog_p'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->backlog_p)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->backlog_p)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_backlog_p_grid_line . "\"  style=\"" . $this->Css_Cmp['css_backlog_p_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_backlog_p_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_backlog_f()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['backlog_f']) || $this->NM_cmp_hidden['backlog_f'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->backlog_f)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->backlog_f)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_backlog_f_grid_line . "\"  style=\"" . $this->Css_Cmp['css_backlog_f_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_backlog_f_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_iva()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['iva']) || $this->NM_cmp_hidden['iva'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->iva)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->iva)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_iva_grid_line . "\"  style=\"" . $this->Css_Cmp['css_iva_grid_line'] . "\"  align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_iva_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_mod_contrato_iva()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['mod_contrato_iva']) || $this->NM_cmp_hidden['mod_contrato_iva'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->mod_contrato_iva)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->mod_contrato_iva)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_mod_contrato_iva_grid_line . "\"  style=\"" . $this->Css_Cmp['css_mod_contrato_iva_grid_line'] . "\" NOWRAP align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_mod_contrato_iva_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 14;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'])
   {
       $this->NM_colspan++;
   }
   foreach ($this->NM_cmp_hidden as $Cmp => $Hidden)
   {
       if ($Hidden == "off")
       {
           $this->NM_colspan--;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'])
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
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['print_navigator']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['print_navigator'] == "Netscape")
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
        if ($nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
        {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf']) { 
           }
           else
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf_vert']) { 
                $nm_saida->saida("     <thead>\r\n");
               }
               $this->cabecalho();
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf_vert']) { 
                $nm_saida->saida("     </thead>\r\n");
               }
           }
        }
        $nm_saida->saida(" <TR> \r\n");
        $nm_saida->saida("  <TD style=\"padding: 0px; vertical-align: top;\"> \r\n");
        $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] && ($this->pdf_all_cab == "S" || $this->pdf_all_label == "S")) { 
            $nm_saida->saida(" <thead> \r\n");
            if ($this->pdf_all_cab == "S")
            {
                $this->cabecalho();
            }
            if ($this->pdf_all_label == "S" && $nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'])
            {
                $this->label_grid();
            }
            $nm_saida->saida(" </thead> \r\n");
        }
        if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] && $nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'])
        {
            $this->label_grid();
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['proc_pdf'] && $this->pdf_label_group != "S" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid'])
        {
            $this->nm_inicio_pag = 0;
        }
    }
 }
 function quebra_geral_sc_free_total_top() 
 {
   global $nm_saida; 
   if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
   {
       $nm_saida->saida("    </TBODY>");
   }
 }
 function quebra_geral_sc_free_total_bot() 
 {
   global 
          $nm_saida, $nm_data; 
   $this->totaliza_php_sc_free_total(); 
   $NM_cmp_tot['modificacion_contrato']['S'] = 2;
   $NM_cmp_tot['facturacion']['S'] = 3;
   $NM_cmp_tot['reajuste']['S'] = 4;
   $NM_cmp_tot['retencion']['S'] = 5;
   $NM_cmp_tot['multa']['S'] = 6;
   $NM_cmp_tot['avance']['S'] = 7;
   $NM_cmp_tot['ur_real']['S'] = 8;
   $NM_cmp_tot['backlog_p']['S'] = 9;
   $NM_cmp_tot['backlog_f']['S'] = 10;
   $NM_tipos_tot = array('S' => '' . $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . '');
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" && !$this->Print_All)
   {
      $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" .  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][0] . "</H1></div>";
   }
   $tit_lin_sumariza      = $nm_nivel_book_pdf . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][0];
   $tit_lin_sumariza_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][0];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid']) {
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra  . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
  $prim_lin_tit = true;
  foreach ($NM_tipos_tot as $Tipo_Sum => $Tit_sum)
  {
   if (!$prim_lin_tit)
   {
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida_grid']) {
           $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
       }
   }
   $prim_lin_tit = false;
   $tit_lin_sumariza_atu = $tit_lin_sumariza . "&nbsp;-&nbsp;" . $Tit_sum;
   $colspan  = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'])
   {
       $colspan++;
   }
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "id_proyecto" && (!isset($this->NM_cmp_hidden['id_proyecto']) || $this->NM_cmp_hidden['id_proyecto'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "presupuesto" && (!isset($this->NM_cmp_hidden['presupuesto']) || $this->NM_cmp_hidden['presupuesto'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "modificacion_contrato" && (!isset($this->NM_cmp_hidden['modificacion_contrato']) || $this->NM_cmp_hidden['modificacion_contrato'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['modificacion_contrato'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][$NM_cmp_tot['modificacion_contrato'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_modificacion_contrato_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_modificacion_contrato_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "facturacion" && (!isset($this->NM_cmp_hidden['facturacion']) || $this->NM_cmp_hidden['facturacion'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['facturacion'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][$NM_cmp_tot['facturacion'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_facturacion_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_facturacion_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "reajuste" && (!isset($this->NM_cmp_hidden['reajuste']) || $this->NM_cmp_hidden['reajuste'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['reajuste'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][$NM_cmp_tot['reajuste'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_reajuste_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_reajuste_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "retencion" && (!isset($this->NM_cmp_hidden['retencion']) || $this->NM_cmp_hidden['retencion'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['retencion'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][$NM_cmp_tot['retencion'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_retencion_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_retencion_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "multa" && (!isset($this->NM_cmp_hidden['multa']) || $this->NM_cmp_hidden['multa'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['multa'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][$NM_cmp_tot['multa'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_multa_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_multa_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "avance" && (!isset($this->NM_cmp_hidden['avance']) || $this->NM_cmp_hidden['avance'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['avance'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][$NM_cmp_tot['avance'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_avance_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_avance_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "ur_real" && (!isset($this->NM_cmp_hidden['ur_real']) || $this->NM_cmp_hidden['ur_real'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['ur_real'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][$NM_cmp_tot['ur_real'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_ur_real_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_ur_real_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "backlog_p" && (!isset($this->NM_cmp_hidden['backlog_p']) || $this->NM_cmp_hidden['backlog_p'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['backlog_p'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][$NM_cmp_tot['backlog_p'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_backlog_p_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_backlog_p_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "backlog_f" && (!isset($this->NM_cmp_hidden['backlog_f']) || $this->NM_cmp_hidden['backlog_f'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['backlog_f'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][$NM_cmp_tot['backlog_f'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_backlog_f_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_backlog_f_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "iva" && (!isset($this->NM_cmp_hidden['iva']) || $this->NM_cmp_hidden['iva'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "mod_contrato_iva" && (!isset($this->NM_cmp_hidden['mod_contrato_iva']) || $this->NM_cmp_hidden['mod_contrato_iva'] != "off"))
    {
       $colspan++;
    }
   }
   if ($colspan > 0)
   {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\"   " . "colspan=\"" . $colspan . "\"" . ">&nbsp;</TD>\r\n");
   }
       $nm_saida->saida("    </TR>\r\n");
    $tit_lin_sumariza = "<span style='opacity: 0;'>" . $tit_lin_sumariza_orig . "</span>";
   }
 } 

   function totaliza_php_sc_free_total()
   {
      $this->sc_proc_grid = true;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_filtro'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['contr_total_geral'] == "OK")
      {
          return;
      }
      //----- 
     $nmgp_select = "SELECT id_proyecto, SUM(modificacion_contrato) as modificacion_contrato, sum(facturacion) as facturacion, SUM(reajuste) as reajuste, SUM(retencion) as retencion, SUM(multa) as multa, sum(avance) as avance, ur_real, backlog_p, backlog_f, id from " . $this->Ini->nm_tabela; 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'] ; 
      $nmgp_select .= " group by id_proyecto"; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ordem_desc']; 
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
   if (substr(trim($nmgp_order_by), -1) == ",")
   {
       $nmgp_order_by = " " . substr(trim($nmgp_order_by), 0, -1);
   }
   if (trim($nmgp_order_by) == "order by")
   {
       $nmgp_order_by = "";
   }
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['order_grid'] = $nmgp_order_by;
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
      if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
      { 
         $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][1] = 0;
         return;
      }  
      $this->Res->inicializa_arrays();
      $this->nm_grid_colunas = 0;
      while (!$this->rs_grid->EOF) 
      {
         $this->id_proyecto = $this->rs_grid->fields[0] ;  
         $this->id_proyecto = (string)$this->id_proyecto;  
         $this->rs_grid->fields[1] =  str_replace(",", ".", $this->rs_grid->fields[1]);  
         $this->modificacion_contrato = $this->rs_grid->fields[1] ;  
         $this->modificacion_contrato = (string)$this->modificacion_contrato;  
         $this->rs_grid->fields[2] =  str_replace(",", ".", $this->rs_grid->fields[2]);  
         $this->facturacion = $this->rs_grid->fields[2] ;  
         $this->facturacion = (string)$this->facturacion;  
         $this->rs_grid->fields[3] =  str_replace(",", ".", $this->rs_grid->fields[3]);  
         $this->reajuste = $this->rs_grid->fields[3] ;  
         $this->reajuste = (string)$this->reajuste;  
         $this->rs_grid->fields[4] =  str_replace(",", ".", $this->rs_grid->fields[4]);  
         $this->retencion = $this->rs_grid->fields[4] ;  
         $this->retencion = (string)$this->retencion;  
         $this->rs_grid->fields[5] =  str_replace(",", ".", $this->rs_grid->fields[5]);  
         $this->multa = $this->rs_grid->fields[5] ;  
         $this->multa = (string)$this->multa;  
         $this->rs_grid->fields[6] =  str_replace(",", ".", $this->rs_grid->fields[6]);  
         $this->avance = $this->rs_grid->fields[6] ;  
         $this->avance = (string)$this->avance;  
         $this->rs_grid->fields[7] =  str_replace(",", ".", $this->rs_grid->fields[7]);  
         $this->ur_real = $this->rs_grid->fields[7] ;  
         $this->ur_real = (string)$this->ur_real;  
         $this->rs_grid->fields[8] =  str_replace(",", ".", $this->rs_grid->fields[8]);  
         $this->backlog_p = $this->rs_grid->fields[8] ;  
         $this->backlog_p = (string)$this->backlog_p;  
         $this->rs_grid->fields[9] =  str_replace(",", ".", $this->rs_grid->fields[9]);  
         $this->backlog_f = $this->rs_grid->fields[9] ;  
         $this->backlog_f = (string)$this->backlog_f;  
         $this->id = $this->rs_grid->fields[10] ;  
         $this->id = (string)$this->id;  
         $GLOBALS["id"] = $this->rs_grid->fields[10] ;  
         $_SESSION['scriptcase']['grid_prod_produccion_proyecto_gestion']['contr_erro'] = 'on';
 $this->iva =$this->facturacion  * 1.19;
$this->mod_contrato_iva =$this->modificacion_contrato *1.19;


$check_sql = "SELECT   prod_produccion_proyecto.backlog_p,  prod_produccion_proyecto.backlog_f,ur_real FROM  prod_produccion_proyecto WHERE   prod_produccion_proyecto.id_proyecto = ".$this->id_proyecto . " ORDER BY  prod_produccion_proyecto.`fecha` DESC limit 1";

 
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
    $this->backlog_p  = $this->rs[0][0];
    $this->backlog_f  = $this->rs[0][1];
	$this->ur_real =$this->rs[0][2];
}
		else     
{
	$this->backlog_p  = 0;
    $this->backlog_f  = 0;
	$this->ur_real =0;
}
$_SESSION['scriptcase']['grid_prod_produccion_proyecto_gestion']['contr_erro'] = 'off';
         $this->Lookup->lookup_presupuesto($this->presupuesto, $this->id, $this->id_proyecto, $this->array_presupuesto); 
         $this->Lookup->lookup_id_proyecto($this->id_proyecto, $this->id_proyecto) ; 
         $this->Res->adiciona_registro(NM_encode_input(sc_strip_script($this->modificacion_contrato)), NM_encode_input(sc_strip_script($this->facturacion)), NM_encode_input(sc_strip_script($this->reajuste)), NM_encode_input(sc_strip_script($this->retencion)), NM_encode_input(sc_strip_script($this->multa)), NM_encode_input(sc_strip_script($this->avance)), NM_encode_input(sc_strip_script($this->ur_real)), NM_encode_input(sc_strip_script($this->backlog_p)), NM_encode_input(sc_strip_script($this->backlog_f)));
         $this->rs_grid->MoveNext();
      }
      $this->Res->finaliza_arrays();
      $this->rs_grid->Close();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][2] = $this->Res->array_total_geral[1];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][3] = $this->Res->array_total_geral[2];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][4] = $this->Res->array_total_geral[3];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][5] = $this->Res->array_total_geral[4];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][6] = $this->Res->array_total_geral[5];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][7] = $this->Res->array_total_geral[6];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][8] = $this->Res->array_total_geral[7];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][9] = $this->Res->array_total_geral[8];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][10] = $this->Res->array_total_geral[9];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['contr_array_resumo'] = "OK";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['tot_geral'][1] = $this->Res->array_total_geral[0];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['contr_total_geral'] = "OK";
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
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_1_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_fontawesomeicon", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'app', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=279&apapel=216&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=n&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=es&conf_socor=N&script_case_init=" . $this->Ini->sc_page . "&app_name=grid_prod_produccion_proyecto_gestion&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "document.Fdoc_word.submit();", "document.Fdoc_word.submit();", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "nm_gp_print('');", "nm_gp_print('');", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
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
      if (is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Img_sep_grid))
      {
          if ($NM_btn)
          {
              $NM_btn = false;
              $NM_ult_sep = "NM_sep_1";
              $nm_saida->saida("          <img id=\"NM_sep_1\" class=\"NM_toolbar_sep\" src=\"" . $this->Ini->path_img_global . $this->Ini->Img_sep_grid . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
          }
      }
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $this->nm_btn_exist['sel_col'][] = "selcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "selcmp_top", "", "Campos Adiconales", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['SC_btn_0'] == "on" && !$this->grid_emb_form) 
      { 
          $this->nm_btn_exist['SC_btn_0'][] = "sc_SC_btn_0_top";
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "SC_btn_0", "sc_btn_SC_btn_0();", "sc_btn_SC_btn_0();", "sc_SC_btn_0_top", "", "Recargar Datos", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("          $Cod_Btn \r\n");
          $NM_btn = true;
      } 
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] != "sc_free_total")
        {
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
              $this->nm_btn_exist['summary'][] = "res_top";
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_resumo'])) {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              else { 
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              $nm_saida->saida("           $Cod_Btn \r\n");
                  $NM_btn = true;
          }
        }
          if (is_file("grid_prod_produccion_proyecto_gestion_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_prod_produccion_proyecto_gestion_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if ($this->nmgp_botoes['exit'] == "on")
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('busca', '0', '');", "nm_gp_move('busca', '0', '');", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'];
              $this->nm_btn_exist['goto'][] = "brec_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "birpara", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav);", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav);", "brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $Page_Atu   = ($Reg_Page != 'all') ? ceil($this->nmgp_reg_inicial / $Reg_Page) : 1;
              $nm_saida->saida("          <input id=\"rec_f0_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" name=\"rec\" value=\"" . NM_encode_input($Page_Atu) . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
              $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['qtline'] == "on" && $this->Ini->Apl_paginacao != "FULL")
          {
              $nm_saida->saida("          <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
              $nm_saida->saida("          <select class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" id=\"quant_linhas_f0_bot\" name=\"nmgp_quant_linhas\" onchange=\"sc_ind = document.getElementById('quant_linhas_f0_bot').selectedIndex; nm_gp_submit_ajax('muda_qt_linhas', document.getElementById('quant_linhas_f0_bot').options[sc_ind].value);\"> \r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] == '10') ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] == '20') ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] == '50') ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'];
              $Max_link   = 5;
              $Mid_link   = ceil($Max_link / 2);
              $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
              $Qtd_Pages  = ceil($this->count_ger / $Reg_Page);
              $Page_Atu   = ceil($this->nmgp_reg_final / $Reg_Page);
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
                      $nm_saida->saida("            <span class=\"scGridToolbarNavOpen\" style=\"vertical-align: middle;\">" . $Link_ini . "</span>\r\n");
                  }
                  else
                  {
                      $nm_saida->saida("            <a class=\"scGridToolbarNav\" style=\"vertical-align: middle;\" href=\"javascript: nm_gp_submit_rec(" . $rec . ");\">" . $Link_ini . "</a>\r\n");
                  }
                  $Link_ini++;
                  if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
                  {
                      $nm_saida->saida("            <img src=\"" . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
                  }
              }
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
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
          if (is_file("grid_prod_produccion_proyecto_gestion_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_prod_produccion_proyecto_gestion_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $this->nm_btn_exist['sel_col'][] = "selcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "selcmp_top", "", "Campos Adiconales", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $UseAlias =  "S";
              $this->nm_btn_exist['sort_col'][] = "ordcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['group_3'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_3_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_3_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_3", "scBtnGrpShow('group_3_top')", "scBtnGrpShow('group_3_top')", "sc_btgp_btn_group_3_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_fontawesomeicon", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_3", 'group_3', 'top', 'app', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=279&apapel=216&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=n&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=es&conf_socor=N&script_case_init=" . $this->Ini->sc_page . "&app_name=grid_prod_produccion_proyecto_gestion&KeepThis=true&TB_iframe=true&modal=true", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $Tem_word_res = "n";
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "document.Fdoc_word.submit();", "document.Fdoc_word.submit();", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          $Xls_mod_export = "grid";
          if ($Tem_xls_res == "n")
          {
              $Xls_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0', '$Xls_mod_export');", "nm_gp_move('xls', '0', '$Xls_mod_export');", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          $Xml_mod_export = "grid";
          if ($Tem_xml_res == "n")
          {
              $Xml_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0', '$Xml_mod_export');", "nm_gp_move('xml', '0', '$Xml_mod_export');", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          $Csv_mod_export = "grid";
          if ($Tem_csv_res == "n")
          {
              $Csv_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '0', '$Csv_mod_export');", "nm_gp_move('csv', '0', '$Csv_mod_export');", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_move('rtf', '0');", "nm_gp_move('rtf', '0');", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_3_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "nm_gp_print('');", "nm_gp_print('');", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_3", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_3", 'group_3', 'top', 'app', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_3_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_3_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if (is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Img_sep_grid))
      {
          if ($NM_btn)
          {
              $NM_btn = false;
              $NM_ult_sep = "NM_sep_2";
              $nm_saida->saida("          <img id=\"NM_sep_2\" class=\"NM_toolbar_sep\" src=\"" . $this->Ini->path_img_global . $this->Ini->Img_sep_grid . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
          }
      }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['SC_Ind_Groupby'] != "sc_free_total")
        {
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
              $this->nm_btn_exist['summary'][] = "res_top";
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_resumo'])) {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              else { 
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              $nm_saida->saida("           $Cod_Btn \r\n");
                  $NM_btn = true;
          }
        }
          if (is_file("grid_prod_produccion_proyecto_gestion_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_prod_produccion_proyecto_gestion_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if ($this->nmgp_botoes['exit'] == "on")
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('busca', '0', '');", "nm_gp_move('busca', '0', '');", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'];
              $this->nm_btn_exist['goto'][] = "brec_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "birpara", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav);", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav);", "brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $Page_Atu   = ($Reg_Page != 'all') ? ceil($this->nmgp_reg_inicial / $Reg_Page) : 1;
              $nm_saida->saida("          <input id=\"rec_f0_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" name=\"rec\" value=\"" . NM_encode_input($Page_Atu) . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
              $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['qtline'] == "on" && $this->Ini->Apl_paginacao != "FULL")
          {
              $nm_saida->saida("          <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
              $nm_saida->saida("          <select class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" id=\"quant_linhas_f0_bot\" name=\"nmgp_quant_linhas\" onchange=\"sc_ind = document.getElementById('quant_linhas_f0_bot').selectedIndex; nm_gp_submit_ajax('muda_qt_linhas', document.getElementById('quant_linhas_f0_bot').options[sc_ind].value);\"> \r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] == '10') ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] == '20') ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] == '50') ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['qt_lin_grid'];
              $Max_link   = 5;
              $Mid_link   = ceil($Max_link / 2);
              $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
              $Qtd_Pages  = ceil($this->count_ger / $Reg_Page);
              $Page_Atu   = ceil($this->nmgp_reg_final / $Reg_Page);
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
                      $nm_saida->saida("            <span class=\"scGridToolbarNavOpen\" style=\"vertical-align: middle;\">" . $Link_ini . "</span>\r\n");
                  }
                  else
                  {
                      $nm_saida->saida("            <a class=\"scGridToolbarNav\" style=\"vertical-align: middle;\" href=\"javascript: nm_gp_submit_rec(" . $rec . ");\">" . $Link_ini . "</a>\r\n");
                  }
                  $Link_ini++;
                  if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
                  {
                      $nm_saida->saida("            <img src=\"" . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
                  }
              }
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
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
          if (is_file("grid_prod_produccion_proyecto_gestion_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_prod_produccion_proyecto_gestion_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_export_email_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function nmgp_embbed_placeholder_bot()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_export_email_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function html_interativ_search()
   {
       global $nm_saida;
       $bol_refin_use_modal = false;
       if($_SESSION['scriptcase']['proc_mobile'])
       {
           $bol_refin_use_modal = false;
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_label'] = array();
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_dados']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_dados'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_sql']   = array();
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_search']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_search'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_label']['id_proyecto'] = (isset($this->New_label['id_proyecto'])) ? $this->New_label['id_proyecto'] : 'Código Proyecto';
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_sql']['id_proyecto']   = "id_proyecto";
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
       $nm_saida->saida("        <div id='id_div_interativ_search_content' class='scGridRefinedSearchMoldura' style='min-width:140px;'>\r\n");
       $nm_saida->saida("            <div id='id_div_interativ_search_fields'>\r\n");
       $lin_obj = $this->interativ_search_id_proyecto($bol_refin_use_modal);
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
       $array_fields[] = "id_proyecto";
       if(is_array($array_fields) && !empty($array_fields))
       {
           $arr_new = [];
           foreach($array_fields as $key => $str_field)
           {
               if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_search'][$str_field]))
               {
                   unset($array_fields[ $key ]);
                   $arr_new[] = $str_field;
               }
           }
           $array_fields = array_merge($arr_new, $array_fields);
           $str_out = "";
           foreach($array_fields as $str_field)
           {
               $method = "interativ_search_" . $str_field;
               $str_out .= $this->$method($bol_refin_use_modal);
           }
           $this->Ini->Arr_result['setValue'][] = array('field' => 'id_div_interativ_search_fields', 'value' => NM_charset_to_utf8($str_out));
       }
   }
   function interativ_search_id_proyecto($bol_refin_use_modal)
   {
       $cle_disp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_search']["id_proyecto"])) ? "" : "none";
       $exp_disp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_search']["id_proyecto"])) ? "none" : "";
       $displ_open= false;
       $lin_obj  = "    <div id=\"div_int_id_proyecto\">";
       $lin_obj .= "    <table width='100%' cellspacing=0 cellpadding=0>";
       $lin_obj .= "     <tr>";
       $lin_obj .= "      <td nowrap class='scGridRefinedSearchLabel' onclick=\"nm_toggle_int_search('id_proyecto')\">";
       $lin_obj .= "        <table width='100%' cellspacing=0 cellpadding=0>";
       $lin_obj .= "         <tr>";
       $lin_obj .= "          <td nowrap>";
       $lin_obj .= "              <span id=\"id_expand_id_proyecto\" style=\"display: " .  $exp_disp . ";\">&nbsp;&nbsp;<IMG align='absmiddle' style=\"cursor: pointer; padding:0px 2px 0px 0px;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_show . "\" BORDER=\"0\" />   </span>";
       $lin_obj .= "              <span id=\"id_retract_id_proyecto\" style=\"display: none;\">&nbsp;&nbsp;<IMG align='absmiddle' style=\"cursor: pointer;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_hide . "\" BORDER=\"0\" />   </span>";
       $lin_obj .= "              <span class=\"dn-expand-button\" style=\"cursor: pointer;\">";
       $lin_obj .= $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_label']['id_proyecto'];
       $lin_obj .= "              </span>";
       $lin_obj .= "          </td>";
       $lin_obj .= "          <td align='right'>";
       $lin_obj .= "              <span id=\"id_clear_id_proyecto\" style=\"display: " .  $cle_disp . ";\">&nbsp;&nbsp;<IMG align='absmiddle' style=\"cursor: pointer;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_close . "\" BORDER=\"0\" onclick=\"event.stopPropagation(); nm_proc_int_search('clear','','','id_proyecto', '', 'id_proyecto', '', 'S')\"/>   </span>";
       $lin_obj .= "          </td>";
       $lin_obj .= "         </tr>";
       $lin_obj .= "        </table>";
       $lin_obj .= "     </td></tr>";
       $Cmps_where = "";
       $Cmps_apl = array('id','id_proyecto','fecha','avance','facturacion','costos','backlog_p','backlog_f','ur_real','correlativo_mes','modificacion_contrato','reajuste','retencion','multa','ur_mes','produccion_neto');
       foreach ($Cmps_apl as $cada_cmp_apl)
       { 
           if (strpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'], $cada_cmp_apl) !== false)
           {
               $tmp_pos = strpos($cada_cmp_apl, ".");
               if ($tmp_pos !== false)
               {
                   $cada_cmp_apl = substr($cada_cmp_apl, ($tmp_pos + 1));
               }
               if ($cada_cmp_apl != "id_proyecto")
               {
                   $Cmps_where .= "," . $cada_cmp_apl;
               }
           }
       }
       $nm_comando = "select id_proyecto, COUNT(*) AS countTest" . $Cmps_where . " from (SELECT id,     id_proyecto,     fecha,     sum(avance) as avance,     sum(facturacion) as facturacion,     sum(costos) as costos, backlog_p, backlog_f , ur_real, correlativo_mes, SUM(modificacion_contrato) as modificacion_contrato, SUM(reajuste) as reajuste, SUM(retencion) as retencion, SUM(multa) as multa, ur_mes, SUM(produccion_neto) as produccion_neto   FROM     prod_produccion_proyecto  GROUP BY id_proyecto   ORDER BY id_proyecto, fecha DESC) nm_sel_esp";
       $tmp_where = "";
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq']))
       {
           $tmp_where = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'];
           foreach ($Cmps_apl as $cada_cmp_apl)
           { 
               if (strpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'], $cada_cmp_apl) !== false)
               {
                   $tmp_pos = strpos($cada_cmp_apl, ".");
                   if ($tmp_pos !== false)
                   {
                       $cada_cmp_ok = substr($cada_cmp_apl, ($tmp_pos + 1));
                       $tmp_where = str_replace($cada_cmp_apl, $cada_cmp_ok, $tmp_where);
                   }
               }
           }
       }
       $tmp_where = trim(str_replace($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'], "", $tmp_where));
       if (substr($tmp_where, 0, 3) == "and") {
            $tmp_where = " where " . substr($tmp_where, 3);
       } 
       $nm_comando .= " " . $tmp_where;
       $nm_comando .= " GROUP BY id_proyecto". $Cmps_where;
       $nm_comando .= " order by id_proyecto ASC";
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
       $disp_link = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_search']['id_proyecto'])) ? "" : "none";
       $lin_obj  .= "   <tr><td><div class='scGridRefinedSearchMolduraResult' id=\"id_tab_id_proyecto_link\" style=\"display: " . $disp_link . ";\">";
        $check_uncheck  = "
            <span id='id_check_id_proyecto' class='multipleid_proyecto' style='display:" . (($displ_open)?'':'none') . ";'>
                <input class='scAppDivToolbarInput' style='margin:0px' type='checkbox' checked='checked' onclick=\"refinedSearchCheckUncheckAll('id_proyecto', true); this.checked=true;\" \>
                <input class='scAppDivToolbarInput' style='margin:0px' type='checkbox'                   onclick=\"refinedSearchCheckUncheckAll('id_proyecto', false); this.checked=false;\" \>
            </span>";
       $qtd_see_more  = (int)10;
       $qtd_result_see_more  = 0;
       $bol_open_see_more  = false;
       if($bol_refin_use_modal)
       {
           $bol_populate_modal_values = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_dados']['id_proyecto'])?false:true);
       }
       foreach ($result as $dados => $qtd_result)
       {
           $formatado = $dados;
           $this->Lookup->lookup_id_proyecto($formatado , $formatado);
           $formatado_exib  = $formatado;
           $dados = (string)$dados;
           if($bol_refin_use_modal && $bol_populate_modal_values)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_dados']['id_proyecto'][$dados] = array('val'=>$formatado,'qtd'=>$qtd_result);
           }
           if($dados == '')
           {
               $formatado_exib = "" . $this->Ini->Nm_lang['lang_refine_search_empty'] . "";
           }
           $veja_mais_link  = '';
           $veja_mais_link  =sprintf($this->Ini->Nm_lang['lang_othr_refinedsearch_more_mask'], $qtd_result);
           if($qtd_see_more > 0 && $qtd_result_see_more >= $qtd_see_more && !$bol_open_see_more)
           {
               $lin_obj  .= "   <div id='id_see_more_list_id_proyecto' style='display:none'>";
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
           $lin_obj  .= "   <span class='simpleid_proyecto' style='display:" . (($displ_open)?'none':'') . ";'>";
           if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_search']['id_proyecto']))
           {
               $lin_obj  .= "        <IMG align='absmiddle' style=\"cursor: pointer; position:relative; opacity:0;\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->refinedsearch_campo_close_icon . "\" BORDER=\"0\" onclick=\"nm_proc_int_search('clear_opc', 'nn','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_label']['id_proyecto']) . "','id_proyecto','id_int_search_id_proyecto','id_proyecto', '" . NM_encode_input($dados . "##@@" . $formatado) . "', 'S');\"/>";
           }
           $lin_obj  .= "        <a href=\"javascript:nm_proc_int_search('link','nn','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_label']['id_proyecto']) . "','id_proyecto','" . NM_encode_input(NM_encode_input_js($dados . "##@@" . $formatado)) . "', 'id_proyecto', '', 'N');\" class='scGridRefinedSearchCampoFont'>";
           $lin_obj  .= $formatado_exib;
           if(!empty($veja_mais_link))
           {
               $lin_obj  .= "            <span class='scGridRefinedSearchQuantidade'>" . $veja_mais_link . "</span>";
           }
           $lin_obj  .= "        </a>";
           $lin_obj  .= "    </span>";
           $lin_obj  .= "    <span class='multipleid_proyecto' style='display:"  . (($displ_open)?'':'none') .  ";'>";
           $checked = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_search']['id_proyecto']['val_sel']) && in_array($dados, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['interativ_search']['id_proyecto']['val_sel'])) ? " checked" : "";
           $checked = " checked";
           $lin_obj  .= "        <INPUT class='" . $this->css_scAppDivToolbarInput . "' style='margin:0px' type=\"checkbox\"  id=\"id_int_search_id_proyecto_" . md5($dados) . "\" name=\"int_search_id_proyecto[]\" value=\"" . NM_encode_input($dados . "##@@" . $formatado) . "\" $checked><span class='scGridRefinedSearchCampoFont'> <label for=\"id_int_search_id_proyecto_". md5($dados) ."\" for=\"id_int_search_id_proyecto_". md5($dados) ."\">" . $formatado_exib . "</label></span>";
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
           $lin_obj  .= "   <div id='id_see_more_id_proyecto' class='scGridRefinedSearchVejaMais'>";
           $lin_obj  .= "       " . $check_uncheck;
           if($bol_refin_use_modal)
           {
               $lin_obj  .= "       <a href=\"javascript:tb_show('', 'grid_prod_produccion_proyecto_gestion_refin_modal.php?sc_init=" . NM_encode_input($this->Ini->sc_page) . "&cmp_modal=id_proyecto&tp_obj=nn&TB_iframe=true&modal=true&height=440&width=630', '');\" class='scGridRefinedSearchVejaMaisFont'>". $this->Ini->Nm_lang['lang_othr_refinedsearch_see_more'] ."</a>";
           }
           else
           {
               $lin_obj  .= "       <a style='display:" . (($displ_see_more)?'':'none') . ";'  href=\"javascript:toggleSeeMore('id_proyecto');\" class='scGridRefinedSearchVejaMaisFont'>". $this->Ini->Nm_lang['lang_othr_refinedsearch_see_more'] ."</a>";
           }
           $lin_obj  .= "   </div>";
           $lin_obj  .= "   <div id='id_see_less_id_proyecto' class='scGridRefinedSearchVejaMais' style='display:none;'>";
           $lin_obj  .= "   " . $check_uncheck;
           $lin_obj  .= "    <a href=\"javascript:toggleSeeMore('id_proyecto');\" class='scGridRefinedSearchVejaMaisFont'>". $this->Ini->Nm_lang['lang_othr_refinedsearch_see_less'] ."</a>";
           $lin_obj  .= "   </div>";
           $lin_obj  .= "<SCRIPT>";
           $lin_obj  .= "$( document ).ready(function() {";
           $lin_obj  .= "    nm_expand_int_search('id_proyecto');";
           $lin_obj  .= "});";
           $lin_obj  .= "</SCRIPT>";
           $lin_obj  .= "   </div></td></tr>";
           $lin_obj .= "    <tr class='toolbarFields'>";
           $lin_obj .= "    <td style='display:'>";
           $lin_obj .= "    <div class='scGridRefinedSearchToolbar' id=\"id_toolbar_id_proyecto\" style='display:none'>";
           $disp_show_multi_btn = '';
           if (count($result) < 2)
           {
               $disp_show_multi_btn = 'none';
           }
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bmultiselect", "nm_mult_int_search('id_proyecto', false);", "nm_mult_int_search('id_proyecto', false);", "mult_int_search_id_proyecto", "", "", "display: $disp_show_multi_btn;", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "multiselect", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $lin_obj .= $Cod_Btn; 
           $disp_multi_btn = 'none';
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_apply", "nm_proc_int_search('chbx', 'nn','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_label']['id_proyecto']) . "','id_proyecto','id_int_search_id_proyecto','id_proyecto', '', 'N');", "nm_proc_int_search('chbx', 'nn','" . str_replace(array("'",'"'), array('__sasp__','__dasp__'), $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['int_search_label']['id_proyecto']) . "','id_proyecto','id_int_search_id_proyecto','id_proyecto', '', 'N');", "app_int_search_id_proyecto", "", "", "display: $disp_multi_btn ;", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $lin_obj .= $Cod_Btn; 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_cancel", "nm_single_int_search('id_proyecto');", "nm_single_int_search('id_proyecto');", "single_int_search_id_proyecto", "", "", "display: none", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
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
       $nm_saida->saida("         int_search_load_html = 'S';\r\n");
       $nm_saida->saida("     if($( \"#id_slider_id_proyecto\").length > 0)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         $('#app_int_search_range_id_proyecto').click();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     else if($( \"input[name='int_search_id_proyecto[]']:checked\" ).length > 0)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         $('#app_int_search_id_proyecto').click();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     else\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         nm_proc_int_search('clear','','','id_proyecto', '', 'id_proyecto', '', 'S');\r\n");
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
 function check_btns()
 {
 }
 function nm_fim_grid($flag_apaga_pdf_log = TRUE)
 {
   global
   $nm_saida, $nm_url_saida, $NMSC_modal;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
   { 
        return;
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['embutida'])
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "");
       }
   }
   if (isset($this->redir_modal) && !empty($this->redir_modal))
   {
       echo $this->redir_modal;
   }
   $nm_saida->saida("   </script>\r\n");
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("      window.onload = function() {\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('grid_prod_produccion_proyecto_gestion', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("         setTimeout(function(){clear_reload = nm_gp_submit_ajax ('igual', 'reload');},300000);\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"grid_prod_produccion_proyecto_gestion\"/>\r\n");
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
   $nm_saida->saida("                     action=\"grid_prod_produccion_proyecto_gestion_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fprint\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"grid_prod_produccion_proyecto_gestion_iframe_prt.php\" \r\n");
   $nm_saida->saida("                     target=\"jan_print\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"path_botoes\" value=\"" . $this->Ini->path_botoes . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"tp_print\" value=\"RC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"cor_print\" value=\"CO\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_print\" value=\"RC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_print\" value=\"CO\"/>\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_word\" value=\"CO\"/> \r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_cor_word=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("   var Crtl_btn_SC_btn_0 = false;\r\n");
   $nm_saida->saida("   function sc_btn_SC_btn_0()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (Crtl_btn_SC_btn_0) {return;}\r\n");
   $nm_saida->saida("       document.F4.target = \"_self\";\r\n");
   $nm_saida->saida("       Crtl_btn_SC_btn_0 = true;\r\n");
   $nm_saida->saida("       document.F4.rec.value = \"\";\r\n");
   $nm_saida->saida("       document.F4.nm_call_php.value = \"SC_btn_0\";\r\n");
   $nm_saida->saida("       document.F4.nmgp_opcao.value = \"formphp\" ;\r\n");
   $nm_saida->saida("       document.F4.submit() ;\r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['ajax_nav'])
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['grid_prod_produccion_proyecto_gestion_iframe_params'] = array(
       'str_tmp'          => $this->Ini->path_imag_temp,
       'str_prod'         => $this->Ini->path_prod,
       'str_btn'          => $this->Ini->Str_btn_css,
       'str_lang'         => $this->Ini->str_lang,
       'str_schema'       => $this->Ini->str_schema_all,
       'str_google_fonts' => $this->Ini->str_google_fonts,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_prod_produccion_proyecto_gestion@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__page_break_pdf=\" + page_break_pdf + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fpdf.action=\"grid_prod_produccion_proyecto_gestion_iframe.php\";\r\n");
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
   $nm_saida->saida("   function nm_gp_print(SC_module_export)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fprint.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("       document.Fprint.nmgp_password.value = \"n\";\r\n");
   $nm_saida->saida("       window.open('','jan_print','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("        document.Fprint.submit() ;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xls_conf(tp_xls, SC_module_export, password, tot_xls, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_prod_produccion_proyecto_gestion/grid_prod_produccion_proyecto_gestion_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['grid_prod_produccion_proyecto_gestion']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form  = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Form1 = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("           var Obj_Doc   = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form  = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Form1 = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("          var Obj_Doc   = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form  = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Form1 = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret']) . ";\r\n");
          $nm_saida->saida("          var Obj_Doc   = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['campo_psq_ret'] . "\");\r\n");
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
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['js_apos_busca'] . "();\r\n");
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
   $nm_saida->saida("      document.F5.action = \"grid_prod_produccion_proyecto_gestion_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['reg_start']))
   {
       $nm_saida->saida("      $(document).ready(function(){\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailStatus('grid_prod_produccion_proyecto_gestion')\",50);\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('grid_prod_produccion_proyecto_gestion', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      })\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>