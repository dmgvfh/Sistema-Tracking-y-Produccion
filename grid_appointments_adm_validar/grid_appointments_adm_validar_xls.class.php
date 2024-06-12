<?php

class grid_appointments_adm_validar_xls
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Xls_dados;
   var $Xls_workbook;
   var $Xls_col;
   var $Xls_row;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $NM_ctrl_style = array();
   var $Arquivo;
   var $Tit_doc;
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
   //---- 
   function __construct()
   {
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

   //---- 
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida']) {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xls_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($this->Arr_result);
              exit;
          }
          else
          {
              $this->monta_html();
          }
      }
      else { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['opcao'] = "";
      }
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      if (isset($GLOBALS['nmgp_parms']) && !empty($GLOBALS['nmgp_parms'])) 
      { 
          $GLOBALS['nmgp_parms'] = str_replace("@aspass@", "'", $GLOBALS['nmgp_parms']);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $GLOBALS["nmgp_parms"]);
          $todo  = explode("?@?", $todox);
          foreach ($todo as $param)
          {
               $cadapar = explode("?#?", $param);
               if (1 < sizeof($cadapar))
               {
                   if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                   {
                       $cadapar[0] = substr($cadapar[0], 11);
                       $cadapar[1] = $_SESSION[$cadapar[1]];
                   }
                   if (isset($GLOBALS['sc_conv_var'][$cadapar[0]]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][$cadapar[0]];
                   }
                   elseif (isset($GLOBALS['sc_conv_var'][strtolower($cadapar[0])]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][strtolower($cadapar[0])];
                   }
                   nm_limpa_str_grid_appointments_adm_validar($cadapar[1]);
                   nm_protect_num_grid_appointments_adm_validar($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_appointments_adm_validar']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($id_usuario)) 
      {
          $_SESSION['id_usuario'] = $id_usuario;
          nm_limpa_str_grid_appointments_adm_validar($_SESSION["id_usuario"]);
      }
      if (isset($fecha)) 
      {
          $_SESSION['fecha'] = $fecha;
          nm_limpa_str_grid_appointments_adm_validar($_SESSION["fecha"]);
      }
      if (isset($fecha2)) 
      {
          $_SESSION['fecha2'] = $fecha2;
          nm_limpa_str_grid_appointments_adm_validar($_SESSION["fecha2"]);
      }
      if (isset($fecha3)) 
      {
          $_SESSION['fecha3'] = $fecha3;
          nm_limpa_str_grid_appointments_adm_validar($_SESSION["fecha3"]);
      }
      if (isset($fecha4)) 
      {
          $_SESSION['fecha4'] = $fecha4;
          nm_limpa_str_grid_appointments_adm_validar($_SESSION["fecha4"]);
      }
      if (isset($total_chked)) 
      {
          $_SESSION['total_chked'] = $total_chked;
          nm_limpa_str_grid_appointments_adm_validar($_SESSION["total_chked"]);
      }
      if (isset($i)) 
      {
          $_SESSION['i'] = $i;
          nm_limpa_str_grid_appointments_adm_validar($_SESSION["i"]);
      }
      $this->Use_phpspreadsheet = (phpversion() >=  "7.3.9" && is_dir($this->Ini->path_third . '/phpspreadsheet')) ? true : false;
      $this->SC_top = array();
      $this->SC_bot = array();
      $this->SC_bot[] = "appointment_start_date";
      $this->SC_top[] = "appointment_start_date";
      $this->SC_bot[] = "id_usuario";
      $this->SC_top[] = "id_usuario";
      $this->SC_bot[] = "current_status_id";
      $this->SC_top[] = "current_status_id";
      $this->SC_bot[] = "id_proyecto";
      $this->SC_top[] = "id_proyecto";
      $this->SC_bot[] = "id_actividad";
      $this->SC_top[] = "id_actividad";
      $this->Xls_tot_col = 0;
      $this->Xls_row     = 0;
      $this->New_Xls_row = 1;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
      { 
          if ($this->Use_phpspreadsheet) {
              require_once $this->Ini->path_third . '/phpspreadsheet/vendor/autoload.php';
          } 
          else { 
              set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
              require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
              require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
              require_once $this->Ini->path_third . '/phpexcel/PHPExcel/Cell/AdvancedValueBinder.php';
          } 
      } 
      $orig_form_dt = strtoupper($_SESSION['scriptcase']['reg_conf']['date_format']);
      $this->SC_date_conf_region = "";
      for ($i = 0; $i < 8; $i++)
      {
          if ($i > 0 && substr($orig_form_dt, $i, 1) != substr($this->SC_date_conf_region, -1, 1)) {
              $this->SC_date_conf_region .= $_SESSION['scriptcase']['reg_conf']['date_sep'];
          }
          $this->SC_date_conf_region .= substr($orig_form_dt, $i, 1);
      }
      $this->Xls_tp = ".xls";
      if (isset($_REQUEST['nmgp_tp_xls']) && !empty($_REQUEST['nmgp_tp_xls']))
      {
          $this->Xls_tp = "." . $_REQUEST['nmgp_tp_xls'];
      }
      $this->Xls_col      = 0;
      $this->Tem_xls_res  = false;
      $this->Xls_password = "";
      $this->nm_data      = new nm_data("es");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
      { 
          $this->Arquivo    = "sc_xls";
          $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
          $this->Arq_zip    = $this->Arquivo . "_grid_appointments_adm_validar.zip";
          $this->Arquivo   .= "_grid_appointments_adm_validar" . $this->Xls_tp;
          $this->Tit_doc    = "grid_appointments_adm_validar" . $this->Xls_tp;
          $this->Tit_zip    = "grid_appointments_adm_validar.zip";
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          if ($this->Use_phpspreadsheet) {
              $this->Xls_dados = new PhpOffice\PhpSpreadsheet\Spreadsheet();
              \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );
          }
          else {
              PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
              $this->Xls_dados = new PHPExcel();
          }
          $this->Xls_dados->setActiveSheetIndex(0);
          $this->Nm_ActiveSheet = $this->Xls_dados->getActiveSheet();
          if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
          {
              $this->Nm_ActiveSheet->setRightToLeft(true);
          }
      }
      require_once($this->Ini->path_aplicacao . "grid_appointments_adm_validar_total.class.php"); 
      $this->Tot = new grid_appointments_adm_validar_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'];
      $this->Tot->$Gb_geral();
      $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][1];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by")
      {
          $this->sum_intervalo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][2];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status")
      {
          $this->sum_intervalo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][2];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "sc_free_group_by")
      {
          $this->sum_intervalo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][2];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Ind_Groupby'] == "status")
      {
          $this->sum_intervalo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['tot_geral'][2];
      }
   }
   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }


   //----- 
   function grava_arquivo()
   {
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->New_label['current_status_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . "";
      $this->New_label['appointment_start_date'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . "";
      $this->New_label['appointments_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointments_id'] . "";
      $this->New_label['appointment_end_date'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_end_date'] . "";
      $this->New_label['appointment_recurrent'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_recurrent'] . "";
      $this->New_label['appointment_period'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_period'] . "";
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
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_cmp)
      {
          if (!isset($this->NM_cmp_hidden[$Cada_cmp]) || $this->NM_cmp_hidden[$Cada_cmp] != "off")
          {
              $this->Xls_tot_col++;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq_filtro'];
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
          $this->appointment_start_date_2 = (isset($Busca_temp['appointment_start_date_input_2'])) ? $Busca_temp['appointment_start_date_input_2'] : ""; 
      } 
      $this->nm_where_dinamico = "";
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
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_name'] .= $this->Xls_tp;
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->NM_cmp_hidden['hisoria'] = "off";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_label']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida_label'])
      { 
          $this->count_span = 0;
          $this->Xls_row++;
          $this->proc_label();
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
          return;
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT id_proyecto, id_usuario, id_actividad, nombre, current_status_id, appointment_start_date, appointment_start_time, appointment_end_time, intervalo, appointments_id from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_proyecto, id_usuario, id_actividad, nombre, current_status_id, appointment_start_date, appointment_start_time, appointment_end_time, intervalo, appointments_id from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']; 
              $nmgp_select_count .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'] . ")"; 
              $nmgp_select_count .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      if (!empty($this->Ini->nm_col_dinamica)) 
      {
          foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
          {
              $nmgp_select = str_replace($nm_cada_col, $nm_nova_col, $nmgp_select); 
          }
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $prim_reg = true;
      $prim_gb  = true;
      $nm_houve_quebra = "N";
      $this->New_Xls_row = $this->Xls_row;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         $prim_reg = false;
         $this->Xls_col = 0;
         if ($this->New_Xls_row > $this->Xls_row) {
             $this->Xls_row = $this->New_Xls_row;
         }
         $this->Xls_row++;
         $this->id_proyecto = $rs->fields[0] ;  
         $this->id_proyecto = (string)$this->id_proyecto;
         $this->id_usuario = $rs->fields[1] ;  
         $this->id_usuario = (string)$this->id_usuario;
         $this->id_actividad = $rs->fields[2] ;  
         $this->id_actividad = (string)$this->id_actividad;
         $this->nombre = $rs->fields[3] ;  
         $this->current_status_id = $rs->fields[4] ;  
         $this->current_status_id = (string)$this->current_status_id;
         $this->appointment_start_date = $rs->fields[5] ;  
         $this->appointment_start_time = $rs->fields[6] ;  
         $this->appointment_end_time = $rs->fields[7] ;  
         $this->intervalo = $rs->fields[8] ;  
         $this->intervalo = (string)$this->intervalo;
         $this->appointments_id = $rs->fields[9] ;  
         $this->appointments_id = (string)$this->appointments_id;
         $this->Orig_id_proyecto = $this->id_proyecto;
         $this->Orig_id_usuario = $this->id_usuario;
         $this->Orig_id_actividad = $this->id_actividad;
         $this->Orig_nombre = $this->nombre;
         $this->Orig_current_status_id = $this->current_status_id;
         $this->Orig_appointment_start_date = $this->appointment_start_date;
         $this->Orig_appointment_start_time = $this->appointment_start_time;
         $this->Orig_appointment_end_time = $this->appointment_end_time;
         $this->Orig_intervalo = $this->intervalo;
         $this->Orig_appointments_id = $this->appointments_id;
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig']))
         {
             foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['SC_Gb_Free_orig'] as $Cmp_clone => $Cmp_orig)
             {
                 $this->$Cmp_clone = $this->$Cmp_orig;
             }
         }
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
                     $Format_tst  = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp_gb);
                     $TP_Time     = (in_array($cmp_gb, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
                     $this->$Str_arg_sum = $this->Ini->Get_date_arg_sum($TP_Time . $this->appointment_start_date, $Format_tst, "appointment_start_date");
                 }
             }
         }
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
                  if (in_array($cmp, $this->SC_bot) && !$prim_gb)
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
              if (isset($this->current_status_id_Old) && !$prim_gb)
              {
                 $this->quebra_current_status_id_status_bot() ; 
              }
              $this->current_status_id_Old = $this->current_status_id ; 
              $this->quebra_current_status_id_status($this->current_status_id) ; 
              if (isset($this->current_status_id_Old))
              {
                 $this->quebra_current_status_id_status_top() ; 
              }
              $nm_houve_quebra = "S";
          } 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
     { 
         if ($prim_gb)
         {
             $this->count_span = 0;
             $this->proc_label();
             $this->xls_sub_cons_copy_label($this->Xls_row);
             $this->Xls_row++;
         }
     }
     elseif ($prim_gb)
     {
         $this->count_span = 0;
         $this->proc_label();
     }
     $prim_gb = false;
     $nm_houve_quebra = "N";
         //----- lookup - id_proyecto
         $this->look_id_proyecto = $this->id_proyecto; 
         $this->Lookup->lookup_id_proyecto($this->look_id_proyecto, $this->id_proyecto) ; 
         $this->look_id_proyecto = ($this->look_id_proyecto == "&nbsp;") ? "" : $this->look_id_proyecto; 
         //----- lookup - id_usuario
         $this->look_id_usuario = $this->id_usuario; 
         $this->Lookup->lookup_id_usuario($this->look_id_usuario, $this->id_usuario) ; 
         $this->look_id_usuario = ($this->look_id_usuario == "&nbsp;") ? "" : $this->look_id_usuario; 
         //----- lookup - id_actividad
         $this->look_id_actividad = $this->id_actividad; 
         $this->Lookup->lookup_id_actividad($this->look_id_actividad, $this->id_actividad) ; 
         $this->look_id_actividad = ($this->look_id_actividad == "&nbsp;") ? "" : $this->look_id_actividad; 
         //----- lookup - current_status_id
         $this->look_current_status_id = $this->current_status_id; 
         $this->Lookup->lookup_current_status_id($this->look_current_status_id, $this->current_status_id) ; 
         $this->look_current_status_id = ($this->look_current_status_id == "&nbsp;") ? "" : $this->look_current_status_id; 
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
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
                { 
                    $NM_func_exp = "NM_sub_cons_" . $Cada_col;
                    $this->$NM_func_exp();
                } 
                else 
                { 
                    $NM_func_exp = "NM_export_" . $Cada_col;
                    $this->$NM_func_exp();
                } 
            } 
         } 
         if (isset($this->NM_Row_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
         { 
             foreach ($this->NM_Row_din as $row => $height) 
             { 
                 $this->Nm_ActiveSheet->getRowDimension($row)->setRowHeight($height);
             } 
         } 
         $rs->MoveNext();
      }
      $this->xls_set_style();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'] && $prim_reg)
      { 
          $this->proc_label();
          $this->xls_sub_cons_copy_label($this->Xls_row);
          $nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
          $nm_grid_sem_reg  = NM_charset_to_utf8($nm_grid_sem_reg);
          $this->Xls_row++;
          $this->arr_export['lines'][$this->Xls_row][1]['data']   = $nm_grid_sem_reg;
          $this->arr_export['lines'][$this->Xls_row][1]['align']  = "right";
          $this->arr_export['lines'][$this->Xls_row][1]['type']   = "char";
          $this->arr_export['lines'][$this->Xls_row][1]['format'] = "";
      }
      if (isset($this->NM_Col_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
      { 
          if ($this->Use_phpspreadsheet) {
              if ($this->Xls_tp == ".xlsx") {
                  $objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($this->Xls_dados);
              } 
              else {
                  $objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xls($this->Xls_dados);
              } 
          } 
          else {
              if ($this->Xls_tp == ".xlsx") {
                  $objWriter = new PHPExcel_Writer_Excel2007($this->Xls_dados);
              } 
              else {
                  $objWriter = new PHPExcel_Writer_Excel5($this->Xls_dados);
              } 
          } 
          $objWriter->save($this->Xls_f);
      } 
      else 
      { 
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
      } 
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   function proc_label()
   { 
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_proyecto'])) ? $this->New_label['id_proyecto'] : "Proyecto"; 
          if ($Cada_col == "id_proyecto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['id_usuario'])) ? $this->New_label['id_usuario'] : "Usuario"; 
          if ($Cada_col == "id_usuario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['id_actividad'])) ? $this->New_label['id_actividad'] : "Tipo Actividad"; 
          if ($Cada_col == "id_actividad" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['nombre'])) ? $this->New_label['nombre'] : "Nombre Actividad"; 
          if ($Cada_col == "nombre" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['current_status_id'])) ? $this->New_label['current_status_id'] : ""; 
          if ($Cada_col == "current_status_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['appointment_start_date'])) ? $this->New_label['appointment_start_date'] : ""; 
          if ($Cada_col == "appointment_start_date" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['appointment_start_time'])) ? $this->New_label['appointment_start_time'] : "Hora Inicio"; 
          if ($Cada_col == "appointment_start_time" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['appointment_end_time'])) ? $this->New_label['appointment_end_time'] : "Hora Término"; 
          if ($Cada_col == "appointment_end_time" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['intervalo'])) ? $this->New_label['intervalo'] : "Duración (horas)"; 
          if ($Cada_col == "intervalo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['accion_revertir'])) ? $this->New_label['accion_revertir'] : "Acción"; 
          if ($Cada_col == "accion_revertir" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['accion_aprobar'])) ? $this->New_label['accion_aprobar'] : "Aprobar"; 
          if ($Cada_col == "accion_aprobar" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['accion_rechazar'])) ? $this->New_label['accion_rechazar'] : "Rechazar"; 
          if ($Cada_col == "accion_rechazar" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['hisoria'])) ? $this->New_label['hisoria'] : "Historia"; 
          if ((!isset($this->NM_cmp_hidden['hisoria']) || $this->NM_cmp_hidden['hisoria'] != "off") && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->arr_span['hisoria'] = $this->count_span;
              $this->Emb_label_cols_hisoria = 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida_label'] = true;
              $GLOBALS["script_case_init"] = $this->Ini->sc_page;
              $GLOBALS["nmgp_parms"] = "nmgp_opcao?#?xls?@?";
              if (method_exists($this->grid_appointments_history, "controle"))
              {
                  $this->grid_appointments_history->controle();
                  if (isset($_SESSION['scriptcase']['export_return']))
                  {
                     foreach ($_SESSION['scriptcase']['export_return']['label'] as $col => $dados)
                     {
                         if (isset($dados['col_span_i'])) {
                             $this->Emb_label_cols_hisoria += $dados['col_span_i'];
                         }
                         elseif (isset($dados['col_span_f'])) {
                             $this->Emb_label_cols_hisoria += $dados['col_span_f'];
                         }
                         else {
                             $this->Emb_label_cols_hisoria++;
                         }
                     }
                  }
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = false;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida_label'] = false;
          }
          $SC_Label = (isset($this->New_label['appointments_id'])) ? $this->New_label['appointments_id'] : ""; 
          if ($Cada_col == "appointments_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['embutida'])
      { 
          if (!isset($this->NM_cmp_hidden[$hisoria]) || $this->NM_cmp_hidden[$hisoria] != "off")
          {
              while ($this->count_span < $this->Emb_label_cols_hisoria)
              {
                  $this->arr_export['label'][$this->Xls_col]['data']     = " ";
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->count_span++;
                  $this->Xls_col++;
              }
          }
      }
      $this->Xls_col = 0;
      $this->Xls_row++;
   } 
   //----- id_proyecto
   function NM_export_id_proyecto()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->look_id_proyecto = NM_charset_to_utf8($this->look_id_proyecto);
         if (is_numeric($this->look_id_proyecto))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->look_id_proyecto);
         $this->Xls_col++;
   }
   //----- id_usuario
   function NM_export_id_usuario()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->look_id_usuario = NM_charset_to_utf8($this->look_id_usuario);
         if (is_numeric($this->look_id_usuario))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->look_id_usuario);
         $this->Xls_col++;
   }
   //----- id_actividad
   function NM_export_id_actividad()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->look_id_actividad = NM_charset_to_utf8($this->look_id_actividad);
         if (is_numeric($this->look_id_actividad))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->look_id_actividad);
         $this->Xls_col++;
   }
   //----- nombre
   function NM_export_nombre()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->nombre = html_entity_decode($this->nombre, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nombre = strip_tags($this->nombre);
         $this->nombre = NM_charset_to_utf8($this->nombre);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->nombre, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->nombre, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- current_status_id
   function NM_export_current_status_id()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->look_current_status_id = NM_charset_to_utf8($this->look_current_status_id);
         if (is_numeric($this->look_current_status_id))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->look_current_status_id);
         $this->Xls_col++;
   }
   //----- appointment_start_date
   function NM_export_appointment_start_date()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "CENTER"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->appointment_start_date = substr($this->appointment_start_date, 0, 10);
         if (empty($this->appointment_start_date) || $this->appointment_start_date == "0000-00-00")
         {
             if ($this->Use_phpspreadsheet) {
                 $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->appointment_start_date, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
             }
             else {
                 $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->appointment_start_date, PHPExcel_Cell_DataType::TYPE_STRING);
             }
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->appointment_start_date);
             $this->NM_ctrl_style[$current_cell_ref]['format'] = $this->SC_date_conf_region;
         }
         $this->Xls_col++;
   }
   //----- appointment_start_time
   function NM_export_appointment_start_time()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "CENTER"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
      if (!empty($this->appointment_start_time))
      {
             $conteudo_x =  $this->appointment_start_time;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->appointment_start_time, "HH:II:SS  ");
                 $this->appointment_start_time = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
      }
         $this->appointment_start_time = NM_charset_to_utf8($this->appointment_start_time);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->appointment_start_time, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->appointment_start_time, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- appointment_end_time
   function NM_export_appointment_end_time()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "CENTER"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
      if (!empty($this->appointment_end_time))
      {
             $conteudo_x =  $this->appointment_end_time;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->appointment_end_time, "HH:II:SS  ");
                 $this->appointment_end_time = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
      }
         $this->appointment_end_time = NM_charset_to_utf8($this->appointment_end_time);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->appointment_end_time, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->appointment_end_time, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- intervalo
   function NM_export_intervalo()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->intervalo = NM_charset_to_utf8($this->intervalo);
         if (is_numeric($this->intervalo))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0.00';
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->intervalo);
         $this->Xls_col++;
   }
   //----- accion_revertir
   function NM_export_accion_revertir()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->accion_revertir = html_entity_decode($this->accion_revertir, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->accion_revertir = strip_tags($this->accion_revertir);
         $this->accion_revertir = NM_charset_to_utf8($this->accion_revertir);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->accion_revertir, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->accion_revertir, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- accion_aprobar
   function NM_export_accion_aprobar()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->accion_aprobar = html_entity_decode($this->accion_aprobar, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->accion_aprobar = strip_tags($this->accion_aprobar);
         $this->accion_aprobar = NM_charset_to_utf8($this->accion_aprobar);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->accion_aprobar, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->accion_aprobar, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- accion_rechazar
   function NM_export_accion_rechazar()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->accion_rechazar = html_entity_decode($this->accion_rechazar, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->accion_rechazar = strip_tags($this->accion_rechazar);
         $this->accion_rechazar = NM_charset_to_utf8($this->accion_rechazar);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->accion_rechazar, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->accion_rechazar, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- appointments_id
   function NM_export_appointments_id()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         $this->appointments_id = NM_charset_to_utf8($this->appointments_id);
         if (is_numeric($this->appointments_id))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->appointments_id);
         $this->Xls_col++;
   }
   //----- id_proyecto
   function NM_sub_cons_id_proyecto()
   {
         $this->look_id_proyecto = NM_charset_to_utf8($this->look_id_proyecto);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->look_id_proyecto;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   //----- id_usuario
   function NM_sub_cons_id_usuario()
   {
         $this->look_id_usuario = NM_charset_to_utf8($this->look_id_usuario);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->look_id_usuario;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   //----- id_actividad
   function NM_sub_cons_id_actividad()
   {
         $this->look_id_actividad = NM_charset_to_utf8($this->look_id_actividad);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->look_id_actividad;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   //----- nombre
   function NM_sub_cons_nombre()
   {
         $this->nombre = html_entity_decode($this->nombre, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nombre = strip_tags($this->nombre);
         $this->nombre = NM_charset_to_utf8($this->nombre);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->nombre;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- current_status_id
   function NM_sub_cons_current_status_id()
   {
         $this->look_current_status_id = NM_charset_to_utf8($this->look_current_status_id);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->look_current_status_id;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   //----- appointment_start_date
   function NM_sub_cons_appointment_start_date()
   {
         $this->appointment_start_date = substr($this->appointment_start_date, 0, 10);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->appointment_start_date;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "data";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "center";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = $this->SC_date_conf_region;
         $this->Xls_col++;
   }
   //----- appointment_start_time
   function NM_sub_cons_appointment_start_time()
   {
      if (!empty($this->appointment_start_time))
      {
         $conteudo_x =  $this->appointment_start_time;
         nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->appointment_start_time, "HH:II:SS  ");
             $this->appointment_start_time = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
         } 
      }
         $this->appointment_start_time = NM_charset_to_utf8($this->appointment_start_time);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->appointment_start_time;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "center";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- appointment_end_time
   function NM_sub_cons_appointment_end_time()
   {
      if (!empty($this->appointment_end_time))
      {
         $conteudo_x =  $this->appointment_end_time;
         nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->appointment_end_time, "HH:II:SS  ");
             $this->appointment_end_time = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
         } 
      }
         $this->appointment_end_time = NM_charset_to_utf8($this->appointment_end_time);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->appointment_end_time;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "center";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- intervalo
   function NM_sub_cons_intervalo()
   {
         $this->intervalo = NM_charset_to_utf8($this->intervalo);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->intervalo;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0.00";
         $this->Xls_col++;
   }
   //----- accion_revertir
   function NM_sub_cons_accion_revertir()
   {
         $this->accion_revertir = html_entity_decode($this->accion_revertir, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->accion_revertir = strip_tags($this->accion_revertir);
         $this->accion_revertir = NM_charset_to_utf8($this->accion_revertir);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->accion_revertir;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- accion_aprobar
   function NM_sub_cons_accion_aprobar()
   {
         $this->accion_aprobar = html_entity_decode($this->accion_aprobar, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->accion_aprobar = strip_tags($this->accion_aprobar);
         $this->accion_aprobar = NM_charset_to_utf8($this->accion_aprobar);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->accion_aprobar;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- accion_rechazar
   function NM_sub_cons_accion_rechazar()
   {
         $this->accion_rechazar = html_entity_decode($this->accion_rechazar, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->accion_rechazar = strip_tags($this->accion_rechazar);
         $this->accion_rechazar = NM_charset_to_utf8($this->accion_rechazar);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->accion_rechazar;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hisoria
   function NM_sub_cons_hisoria()
   {
         $this->Rows_sub_hisoria = array();
         $GLOBALS["script_case_init"] = $this->Ini->sc_page;
         $GLOBALS["nmgp_parms"] = "nmgp_opcao?#?xls?@?id_horario?#?" . str_replace("'", "@aspass@", $this->Orig_appointments_id) . "?@?";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = true;
         if (method_exists($this->grid_appointments_history, "controle"))
         {
             $this->grid_appointments_history->controle();
             if (isset($_SESSION['scriptcase']['export_return']))
             {
                 $this->row_sub = 1;
             $this->Rows_sub_hisoria = $_SESSION['scriptcase']['export_return'];
             return;
             }
         }
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_history']['embutida'] = false;
         $this->Xls_col++;
   }
   //----- appointments_id
   function NM_sub_cons_appointments_id()
   {
         $this->appointments_id = NM_charset_to_utf8($this->appointments_id);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->appointments_id;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   function xls_sub_cons_copy_label($row)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['nolabel']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['nolabel'])
       {
           foreach ($this->arr_export['label'] as $col => $dados)
           {
               $this->arr_export['lines'][$row][$col] = $dados;
           }
       }
   }
   function xls_set_style()
   {
       if (!empty($this->NM_ctrl_style))
       {
           foreach ($this->NM_ctrl_style as $col => $dados)
           {
               $cell_ref = $col . $dados['ini'] . ":" . $col . $dados['end'];
               if ($this->Use_phpspreadsheet) {
                   if ($dados['align'] == "LEFT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                   }
                   elseif ($dados['align'] == "RIGHT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                   }
               }
               else {
                   if ($dados['align'] == "LEFT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   }
                   elseif ($dados['align'] == "RIGHT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                   }
               }
               if (isset($dados['format'])) {
                   $this->Nm_ActiveSheet->getStyle($cell_ref)->getNumberFormat()->setFormatCode($dados['format']);
               }
           }
           $this->NM_ctrl_style = array();
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
   function quebra_appointment_start_date_sc_free_group_by_top() {
   }
   function quebra_appointment_start_date_sc_free_group_by_bot() {
   }
   function quebra_id_usuario_sc_free_group_by_top() {
   }
   function quebra_id_usuario_sc_free_group_by_bot() {
   }
   function quebra_current_status_id_sc_free_group_by_top() {
   }
   function quebra_current_status_id_sc_free_group_by_bot() {
   }
   function quebra_id_proyecto_sc_free_group_by_top() {
   }
   function quebra_id_proyecto_sc_free_group_by_bot() {
   }
   function quebra_id_actividad_sc_free_group_by_top() {
   }
   function quebra_id_actividad_sc_free_group_by_bot() {
   }
   function quebra_current_status_id_status_top() {
   }
   function quebra_current_status_id_status_bot() {
   }

   function calc_cell($col)
   {
       $arr_alfa = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
       $val_ret = "";
       $result = $col + 1;
       while ($result > 26)
       {
           $cel      = $result % 26;
           $result   = $result / 26;
           if ($cel == 0)
           {
               $cel    = 26;
               $result--;
           }
           $val_ret = $arr_alfa[$cel] . $val_ret;
       }
       $val_ret = $arr_alfa[$result] . $val_ret;
       return $val_ret;
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
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Validación de Horas :: Excel</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
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
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">XLS</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_appointments_adm_validar_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_appointments_adm_validar"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['xls_return']); ?>"> 
</FORM> 
</BODY>
</HTML>
<?php
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
}

?>
