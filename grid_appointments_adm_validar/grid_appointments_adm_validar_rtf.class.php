<?php

class grid_appointments_adm_validar_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Texto_tag;
   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("es");
      $this->Texto_tag = "";
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Rtf_f);
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
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_appointments_adm_validar";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_appointments_adm_validar.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_proyecto'])) ? $this->New_label['id_proyecto'] : "Proyecto"; 
          if ($Cada_col == "id_proyecto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_usuario'])) ? $this->New_label['id_usuario'] : "Usuario"; 
          if ($Cada_col == "id_usuario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_actividad'])) ? $this->New_label['id_actividad'] : "Tipo Actividad"; 
          if ($Cada_col == "id_actividad" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nombre'])) ? $this->New_label['nombre'] : "Nombre Actividad"; 
          if ($Cada_col == "nombre" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['current_status_id'])) ? $this->New_label['current_status_id'] : ""; 
          if ($Cada_col == "current_status_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['appointment_start_date'])) ? $this->New_label['appointment_start_date'] : ""; 
          if ($Cada_col == "appointment_start_date" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['appointment_start_time'])) ? $this->New_label['appointment_start_time'] : "Hora Inicio"; 
          if ($Cada_col == "appointment_start_time" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['appointment_end_time'])) ? $this->New_label['appointment_end_time'] : "Hora Término"; 
          if ($Cada_col == "appointment_end_time" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['intervalo'])) ? $this->New_label['intervalo'] : "Duración (horas)"; 
          if ($Cada_col == "intervalo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['accion_revertir'])) ? $this->New_label['accion_revertir'] : "Acción"; 
          if ($Cada_col == "accion_revertir" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['accion_aprobar'])) ? $this->New_label['accion_aprobar'] : "Aprobar"; 
          if ($Cada_col == "accion_aprobar" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['accion_rechazar'])) ? $this->New_label['accion_rechazar'] : "Rechazar"; 
          if ($Cada_col == "accion_rechazar" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['appointments_id'])) ? $this->New_label['appointments_id'] : ""; 
          if ($Cada_col == "appointments_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->Texto_tag .= "</tr>\r\n";
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
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select_count;
      $rt = $this->Db->Execute($nmgp_select_count);
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->count_ger = $rt->fields[0];
      $rt->Close();
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         $this->Texto_tag .= "<tr>\r\n";
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
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->Texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->Texto_tag .= "</table>\r\n";
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
   //----- id_proyecto
   function NM_export_id_proyecto()
   {
         nmgp_Form_Num_Val($this->look_id_proyecto, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_id_proyecto = NM_charset_to_utf8($this->look_id_proyecto);
         $this->look_id_proyecto = str_replace('<', '&lt;', $this->look_id_proyecto);
         $this->look_id_proyecto = str_replace('>', '&gt;', $this->look_id_proyecto);
         $this->Texto_tag .= "<td>" . $this->look_id_proyecto . "</td>\r\n";
   }
   //----- id_usuario
   function NM_export_id_usuario()
   {
         nmgp_Form_Num_Val($this->look_id_usuario, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_id_usuario = NM_charset_to_utf8($this->look_id_usuario);
         $this->look_id_usuario = str_replace('<', '&lt;', $this->look_id_usuario);
         $this->look_id_usuario = str_replace('>', '&gt;', $this->look_id_usuario);
         $this->Texto_tag .= "<td>" . $this->look_id_usuario . "</td>\r\n";
   }
   //----- id_actividad
   function NM_export_id_actividad()
   {
         nmgp_Form_Num_Val($this->look_id_actividad, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_id_actividad = NM_charset_to_utf8($this->look_id_actividad);
         $this->look_id_actividad = str_replace('<', '&lt;', $this->look_id_actividad);
         $this->look_id_actividad = str_replace('>', '&gt;', $this->look_id_actividad);
         $this->Texto_tag .= "<td>" . $this->look_id_actividad . "</td>\r\n";
   }
   //----- nombre
   function NM_export_nombre()
   {
         $this->nombre = html_entity_decode($this->nombre, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nombre = strip_tags($this->nombre);
         $this->nombre = NM_charset_to_utf8($this->nombre);
         $this->nombre = str_replace('<', '&lt;', $this->nombre);
         $this->nombre = str_replace('>', '&gt;', $this->nombre);
         $this->Texto_tag .= "<td>" . $this->nombre . "</td>\r\n";
   }
   //----- current_status_id
   function NM_export_current_status_id()
   {
         nmgp_Form_Num_Val($this->look_current_status_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_current_status_id = NM_charset_to_utf8($this->look_current_status_id);
         $this->look_current_status_id = str_replace('<', '&lt;', $this->look_current_status_id);
         $this->look_current_status_id = str_replace('>', '&gt;', $this->look_current_status_id);
         $this->Texto_tag .= "<td>" . $this->look_current_status_id . "</td>\r\n";
   }
   //----- appointment_start_date
   function NM_export_appointment_start_date()
   {
             $conteudo_x =  $this->appointment_start_date;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->appointment_start_date, "YYYY-MM-DD  ");
                 $this->appointment_start_date = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->appointment_start_date = NM_charset_to_utf8($this->appointment_start_date);
         $this->appointment_start_date = str_replace('<', '&lt;', $this->appointment_start_date);
         $this->appointment_start_date = str_replace('>', '&gt;', $this->appointment_start_date);
         $this->Texto_tag .= "<td>" . $this->appointment_start_date . "</td>\r\n";
   }
   //----- appointment_start_time
   function NM_export_appointment_start_time()
   {
             $conteudo_x =  $this->appointment_start_time;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->appointment_start_time, "HH:II:SS  ");
                 $this->appointment_start_time = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         $this->appointment_start_time = NM_charset_to_utf8($this->appointment_start_time);
         $this->appointment_start_time = str_replace('<', '&lt;', $this->appointment_start_time);
         $this->appointment_start_time = str_replace('>', '&gt;', $this->appointment_start_time);
         $this->Texto_tag .= "<td>" . $this->appointment_start_time . "</td>\r\n";
   }
   //----- appointment_end_time
   function NM_export_appointment_end_time()
   {
             $conteudo_x =  $this->appointment_end_time;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->appointment_end_time, "HH:II:SS  ");
                 $this->appointment_end_time = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         $this->appointment_end_time = NM_charset_to_utf8($this->appointment_end_time);
         $this->appointment_end_time = str_replace('<', '&lt;', $this->appointment_end_time);
         $this->appointment_end_time = str_replace('>', '&gt;', $this->appointment_end_time);
         $this->Texto_tag .= "<td>" . $this->appointment_end_time . "</td>\r\n";
   }
   //----- intervalo
   function NM_export_intervalo()
   {
             nmgp_Form_Num_Val($this->intervalo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->intervalo = NM_charset_to_utf8($this->intervalo);
         $this->intervalo = str_replace('<', '&lt;', $this->intervalo);
         $this->intervalo = str_replace('>', '&gt;', $this->intervalo);
         $this->Texto_tag .= "<td>" . $this->intervalo . "</td>\r\n";
   }
   //----- accion_revertir
   function NM_export_accion_revertir()
   {
         $this->accion_revertir = html_entity_decode($this->accion_revertir, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->accion_revertir = strip_tags($this->accion_revertir);
         $this->accion_revertir = NM_charset_to_utf8($this->accion_revertir);
         $this->accion_revertir = str_replace('<', '&lt;', $this->accion_revertir);
         $this->accion_revertir = str_replace('>', '&gt;', $this->accion_revertir);
         $this->Texto_tag .= "<td>" . $this->accion_revertir . "</td>\r\n";
   }
   //----- accion_aprobar
   function NM_export_accion_aprobar()
   {
         $this->accion_aprobar = html_entity_decode($this->accion_aprobar, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->accion_aprobar = strip_tags($this->accion_aprobar);
         $this->accion_aprobar = NM_charset_to_utf8($this->accion_aprobar);
         $this->accion_aprobar = str_replace('<', '&lt;', $this->accion_aprobar);
         $this->accion_aprobar = str_replace('>', '&gt;', $this->accion_aprobar);
         $this->Texto_tag .= "<td>" . $this->accion_aprobar . "</td>\r\n";
   }
   //----- accion_rechazar
   function NM_export_accion_rechazar()
   {
         $this->accion_rechazar = html_entity_decode($this->accion_rechazar, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->accion_rechazar = strip_tags($this->accion_rechazar);
         $this->accion_rechazar = NM_charset_to_utf8($this->accion_rechazar);
         $this->accion_rechazar = str_replace('<', '&lt;', $this->accion_rechazar);
         $this->accion_rechazar = str_replace('>', '&gt;', $this->accion_rechazar);
         $this->Texto_tag .= "<td>" . $this->accion_rechazar . "</td>\r\n";
   }
   //----- appointments_id
   function NM_export_appointments_id()
   {
             nmgp_Form_Num_Val($this->appointments_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->appointments_id = NM_charset_to_utf8($this->appointments_id);
         $this->appointments_id = str_replace('<', '&lt;', $this->appointments_id);
         $this->appointments_id = str_replace('>', '&gt;', $this->appointments_id);
         $this->Texto_tag .= "<td>" . $this->appointments_id . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $this->Rtf_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $rtf_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->Texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm_validar'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Validación de Horas :: RTF</TITLE>
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
   <td class="scExportTitle" style="height: 25px">RTF</td>
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
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
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
