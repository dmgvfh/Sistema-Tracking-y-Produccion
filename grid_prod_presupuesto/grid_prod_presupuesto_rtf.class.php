<?php

class grid_prod_presupuesto_rtf
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
                   nm_limpa_str_grid_prod_presupuesto($cadapar[1]);
                   nm_protect_num_grid_prod_presupuesto($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_prod_presupuesto']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($id_proyecto)) 
      {
          $_SESSION['id_proyecto'] = $id_proyecto;
          nm_limpa_str_grid_prod_presupuesto($_SESSION["id_proyecto"]);
      }
      if (isset($usr_group)) 
      {
          $_SESSION['usr_group'] = $usr_group;
          nm_limpa_str_grid_prod_presupuesto($_SESSION["usr_group"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_prod_presupuesto";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_prod_presupuesto.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_presupuesto']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_presupuesto']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_presupuesto']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->prod_presupuesto_id = (isset($Busca_temp['prod_presupuesto_id'])) ? $Busca_temp['prod_presupuesto_id'] : ""; 
          $tmp_pos = (is_string($this->prod_presupuesto_id)) ? strpos($this->prod_presupuesto_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->prod_presupuesto_id))
          {
              $this->prod_presupuesto_id = substr($this->prod_presupuesto_id, 0, $tmp_pos);
          }
          $this->prod_presupuesto_id_proyecto = (isset($Busca_temp['prod_presupuesto_id_proyecto'])) ? $Busca_temp['prod_presupuesto_id_proyecto'] : ""; 
          $tmp_pos = (is_string($this->prod_presupuesto_id_proyecto)) ? strpos($this->prod_presupuesto_id_proyecto, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->prod_presupuesto_id_proyecto))
          {
              $this->prod_presupuesto_id_proyecto = substr($this->prod_presupuesto_id_proyecto, 0, $tmp_pos);
          }
          $this->prod_presupuesto_fecha = (isset($Busca_temp['prod_presupuesto_fecha'])) ? $Busca_temp['prod_presupuesto_fecha'] : ""; 
          $tmp_pos = (is_string($this->prod_presupuesto_fecha)) ? strpos($this->prod_presupuesto_fecha, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->prod_presupuesto_fecha))
          {
              $this->prod_presupuesto_fecha = substr($this->prod_presupuesto_fecha, 0, $tmp_pos);
          }
          $this->prod_presupuesto_fecha_2 = (isset($Busca_temp['prod_presupuesto_fecha_input_2'])) ? $Busca_temp['prod_presupuesto_fecha_input_2'] : ""; 
          $this->prod_presupuesto_monto_uf = (isset($Busca_temp['prod_presupuesto_monto_uf'])) ? $Busca_temp['prod_presupuesto_monto_uf'] : ""; 
          $tmp_pos = (is_string($this->prod_presupuesto_monto_uf)) ? strpos($this->prod_presupuesto_monto_uf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->prod_presupuesto_monto_uf))
          {
              $this->prod_presupuesto_monto_uf = substr($this->prod_presupuesto_monto_uf, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_prod_presupuesto']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_group'])) {$_SESSION['usr_group'] = "";}
if (!isset($this->sc_temp_usr_group)) {$this->sc_temp_usr_group = (isset($_SESSION['usr_group'])) ? $_SESSION['usr_group'] : "";}
 if ($this->sc_temp_usr_group <>"4" and $this->sc_temp_usr_group <>"1")
	{
	$this->nmgp_botoes["SC_btn_0"] = 'off';;
	}
if (isset($this->sc_temp_usr_group)) {$_SESSION['usr_group'] = $this->sc_temp_usr_group;}
$_SESSION['scriptcase']['grid_prod_presupuesto']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['agrupador'])) ? $this->New_label['agrupador'] : "Agrupador"; 
          if ($Cada_col == "agrupador" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_items_base_item'])) ? $this->New_label['prod_items_base_item'] : "Item"; 
          if ($Cada_col == "prod_items_base_item" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_id_partida_periodo'])) ? $this->New_label['prod_presupuesto_id_partida_periodo'] : "Partida Periodo"; 
          if ($Cada_col == "prod_presupuesto_id_partida_periodo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_fecha'])) ? $this->New_label['prod_presupuesto_fecha'] : "Fecha Presupuesto"; 
          if ($Cada_col == "prod_presupuesto_fecha" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_unidades'])) ? $this->New_label['prod_presupuesto_unidades'] : "Unidades"; 
          if ($Cada_col == "prod_presupuesto_unidades" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_tipo_moneda'])) ? $this->New_label['prod_presupuesto_tipo_moneda'] : "Tipo Moneda"; 
          if ($Cada_col == "prod_presupuesto_tipo_moneda" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_valor_unitario'])) ? $this->New_label['prod_presupuesto_valor_unitario'] : "Valor Unitario"; 
          if ($Cada_col == "prod_presupuesto_valor_unitario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_monto_uf'])) ? $this->New_label['prod_presupuesto_monto_uf'] : "Monto"; 
          if ($Cada_col == "prod_presupuesto_monto_uf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_observaciones'])) ? $this->New_label['prod_presupuesto_observaciones'] : "Observaciones"; 
          if ($Cada_col == "prod_presupuesto_observaciones" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_id'])) ? $this->New_label['prod_presupuesto_id'] : "Id"; 
          if ($Cada_col == "prod_presupuesto_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_id_proyecto'])) ? $this->New_label['prod_presupuesto_id_proyecto'] : "Proyecto"; 
          if ($Cada_col == "prod_presupuesto_id_proyecto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['prod_presupuesto_vigente'])) ? $this->New_label['prod_presupuesto_vigente'] : "Vigente"; 
          if ($Cada_col == "prod_presupuesto_vigente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT prod_agrupa_items.nombre_agrupador as agrupador, prod_items_base.item as prod_items_base_item, prod_presupuesto.id_partida_periodo as cmp_maior_30_1, prod_presupuesto.fecha as prod_presupuesto_fecha, prod_presupuesto.unidades as prod_presupuesto_unidades, prod_presupuesto.tipo_moneda as prod_presupuesto_tipo_moneda, prod_presupuesto.valor_unitario as cmp_maior_30_2, prod_presupuesto.monto_uf as prod_presupuesto_monto_uf, prod_presupuesto.observaciones as prod_presupuesto_observaciones, prod_presupuesto.id as prod_presupuesto_id, prod_presupuesto.id_proyecto as prod_presupuesto_id_proyecto, prod_presupuesto.vigente as prod_presupuesto_vigente from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT prod_agrupa_items.nombre_agrupador as agrupador, prod_items_base.item as prod_items_base_item, prod_presupuesto.id_partida_periodo as cmp_maior_30_1, prod_presupuesto.fecha as prod_presupuesto_fecha, prod_presupuesto.unidades as prod_presupuesto_unidades, prod_presupuesto.tipo_moneda as prod_presupuesto_tipo_moneda, prod_presupuesto.valor_unitario as cmp_maior_30_2, prod_presupuesto.monto_uf as prod_presupuesto_monto_uf, prod_presupuesto.observaciones as prod_presupuesto_observaciones, prod_presupuesto.id as prod_presupuesto_id, prod_presupuesto.id_proyecto as prod_presupuesto_id_proyecto, prod_presupuesto.vigente as prod_presupuesto_vigente from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_resumo']; 
              $nmgp_select_count .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_resumo'] . ")"; 
              $nmgp_select_count .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['order_grid'];
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
         $this->agrupador = $rs->fields[0] ;  
         $this->prod_items_base_item = $rs->fields[1] ;  
         $this->prod_presupuesto_id_partida_periodo = $rs->fields[2] ;  
         $this->prod_presupuesto_id_partida_periodo = (string)$this->prod_presupuesto_id_partida_periodo;
         $this->prod_presupuesto_fecha = $rs->fields[3] ;  
         $this->prod_presupuesto_unidades = $rs->fields[4] ;  
         $this->prod_presupuesto_unidades =  str_replace(",", ".", $this->prod_presupuesto_unidades);
         $this->prod_presupuesto_unidades = (string)$this->prod_presupuesto_unidades;
         $this->prod_presupuesto_tipo_moneda = $rs->fields[5] ;  
         $this->prod_presupuesto_tipo_moneda = (string)$this->prod_presupuesto_tipo_moneda;
         $this->prod_presupuesto_valor_unitario = $rs->fields[6] ;  
         $this->prod_presupuesto_valor_unitario =  str_replace(",", ".", $this->prod_presupuesto_valor_unitario);
         $this->prod_presupuesto_valor_unitario = (string)$this->prod_presupuesto_valor_unitario;
         $this->prod_presupuesto_monto_uf = $rs->fields[7] ;  
         $this->prod_presupuesto_monto_uf = (string)$this->prod_presupuesto_monto_uf;
         $this->prod_presupuesto_observaciones = $rs->fields[8] ;  
         $this->prod_presupuesto_id = $rs->fields[9] ;  
         $this->prod_presupuesto_id = (string)$this->prod_presupuesto_id;
         $this->prod_presupuesto_id_proyecto = $rs->fields[10] ;  
         $this->prod_presupuesto_id_proyecto = (string)$this->prod_presupuesto_id_proyecto;
         $this->prod_presupuesto_vigente = $rs->fields[11] ;  
         $this->prod_presupuesto_vigente = (string)$this->prod_presupuesto_vigente;
         //----- lookup - prod_presupuesto_id_partida_periodo
         $this->look_prod_presupuesto_id_partida_periodo = $this->prod_presupuesto_id_partida_periodo; 
         $this->Lookup->lookup_prod_presupuesto_id_partida_periodo($this->look_prod_presupuesto_id_partida_periodo, $this->prod_presupuesto_id_partida_periodo) ; 
         $this->look_prod_presupuesto_id_partida_periodo = ($this->look_prod_presupuesto_id_partida_periodo == "&nbsp;") ? "" : $this->look_prod_presupuesto_id_partida_periodo; 
         //----- lookup - prod_presupuesto_tipo_moneda
         $this->look_prod_presupuesto_tipo_moneda = $this->prod_presupuesto_tipo_moneda; 
         $this->Lookup->lookup_prod_presupuesto_tipo_moneda($this->look_prod_presupuesto_tipo_moneda, $_SESSION['id_proyecto']) ; 
         $this->look_prod_presupuesto_tipo_moneda = ($this->look_prod_presupuesto_tipo_moneda == "&nbsp;") ? "" : $this->look_prod_presupuesto_tipo_moneda; 
         //----- lookup - prod_presupuesto_id_proyecto
         $this->look_prod_presupuesto_id_proyecto = $this->prod_presupuesto_id_proyecto; 
         $this->Lookup->lookup_prod_presupuesto_id_proyecto($this->look_prod_presupuesto_id_proyecto, $this->prod_presupuesto_id_proyecto) ; 
         $this->look_prod_presupuesto_id_proyecto = ($this->look_prod_presupuesto_id_proyecto == "&nbsp;") ? "" : $this->look_prod_presupuesto_id_proyecto; 
         //----- lookup - prod_presupuesto_vigente
         $this->look_prod_presupuesto_vigente = $this->prod_presupuesto_vigente; 
         $this->Lookup->lookup_prod_presupuesto_vigente($this->look_prod_presupuesto_vigente); 
         $this->look_prod_presupuesto_vigente = ($this->look_prod_presupuesto_vigente == "&nbsp;") ? "" : $this->look_prod_presupuesto_vigente; 
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_prod_presupuesto']['contr_erro'] = 'on';
 

$_SESSION['scriptcase']['grid_prod_presupuesto']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- agrupador
   function NM_export_agrupador()
   {
         $this->agrupador = html_entity_decode($this->agrupador, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->agrupador = strip_tags($this->agrupador);
         $this->agrupador = NM_charset_to_utf8($this->agrupador);
         $this->agrupador = str_replace('<', '&lt;', $this->agrupador);
         $this->agrupador = str_replace('>', '&gt;', $this->agrupador);
         $this->Texto_tag .= "<td>" . $this->agrupador . "</td>\r\n";
   }
   //----- prod_items_base_item
   function NM_export_prod_items_base_item()
   {
         $this->prod_items_base_item = html_entity_decode($this->prod_items_base_item, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->prod_items_base_item = strip_tags($this->prod_items_base_item);
         $this->prod_items_base_item = NM_charset_to_utf8($this->prod_items_base_item);
         $this->prod_items_base_item = str_replace('<', '&lt;', $this->prod_items_base_item);
         $this->prod_items_base_item = str_replace('>', '&gt;', $this->prod_items_base_item);
         $this->Texto_tag .= "<td>" . $this->prod_items_base_item . "</td>\r\n";
   }
   //----- prod_presupuesto_id_partida_periodo
   function NM_export_prod_presupuesto_id_partida_periodo()
   {
         nmgp_Form_Num_Val($this->look_prod_presupuesto_id_partida_periodo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_prod_presupuesto_id_partida_periodo = NM_charset_to_utf8($this->look_prod_presupuesto_id_partida_periodo);
         $this->look_prod_presupuesto_id_partida_periodo = str_replace('<', '&lt;', $this->look_prod_presupuesto_id_partida_periodo);
         $this->look_prod_presupuesto_id_partida_periodo = str_replace('>', '&gt;', $this->look_prod_presupuesto_id_partida_periodo);
         $this->Texto_tag .= "<td>" . $this->look_prod_presupuesto_id_partida_periodo . "</td>\r\n";
   }
   //----- prod_presupuesto_fecha
   function NM_export_prod_presupuesto_fecha()
   {
             $conteudo_x =  $this->prod_presupuesto_fecha;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->prod_presupuesto_fecha, "YYYY-MM-DD  ");
                 $this->prod_presupuesto_fecha = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->prod_presupuesto_fecha = NM_charset_to_utf8($this->prod_presupuesto_fecha);
         $this->prod_presupuesto_fecha = str_replace('<', '&lt;', $this->prod_presupuesto_fecha);
         $this->prod_presupuesto_fecha = str_replace('>', '&gt;', $this->prod_presupuesto_fecha);
         $this->Texto_tag .= "<td>" . $this->prod_presupuesto_fecha . "</td>\r\n";
   }
   //----- prod_presupuesto_unidades
   function NM_export_prod_presupuesto_unidades()
   {
             nmgp_Form_Num_Val($this->prod_presupuesto_unidades, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->prod_presupuesto_unidades = NM_charset_to_utf8($this->prod_presupuesto_unidades);
         $this->prod_presupuesto_unidades = str_replace('<', '&lt;', $this->prod_presupuesto_unidades);
         $this->prod_presupuesto_unidades = str_replace('>', '&gt;', $this->prod_presupuesto_unidades);
         $this->Texto_tag .= "<td>" . $this->prod_presupuesto_unidades . "</td>\r\n";
   }
   //----- prod_presupuesto_tipo_moneda
   function NM_export_prod_presupuesto_tipo_moneda()
   {
         $this->look_prod_presupuesto_tipo_moneda = html_entity_decode($this->look_prod_presupuesto_tipo_moneda, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_prod_presupuesto_tipo_moneda = strip_tags($this->look_prod_presupuesto_tipo_moneda);
         $this->look_prod_presupuesto_tipo_moneda = NM_charset_to_utf8($this->look_prod_presupuesto_tipo_moneda);
         $this->look_prod_presupuesto_tipo_moneda = str_replace('<', '&lt;', $this->look_prod_presupuesto_tipo_moneda);
         $this->look_prod_presupuesto_tipo_moneda = str_replace('>', '&gt;', $this->look_prod_presupuesto_tipo_moneda);
         $this->Texto_tag .= "<td>" . $this->look_prod_presupuesto_tipo_moneda . "</td>\r\n";
   }
   //----- prod_presupuesto_valor_unitario
   function NM_export_prod_presupuesto_valor_unitario()
   {
             nmgp_Form_Num_Val($this->prod_presupuesto_valor_unitario, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->prod_presupuesto_valor_unitario = NM_charset_to_utf8($this->prod_presupuesto_valor_unitario);
         $this->prod_presupuesto_valor_unitario = str_replace('<', '&lt;', $this->prod_presupuesto_valor_unitario);
         $this->prod_presupuesto_valor_unitario = str_replace('>', '&gt;', $this->prod_presupuesto_valor_unitario);
         $this->Texto_tag .= "<td>" . $this->prod_presupuesto_valor_unitario . "</td>\r\n";
   }
   //----- prod_presupuesto_monto_uf
   function NM_export_prod_presupuesto_monto_uf()
   {
             nmgp_Form_Num_Val($this->prod_presupuesto_monto_uf, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "1", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->prod_presupuesto_monto_uf = NM_charset_to_utf8($this->prod_presupuesto_monto_uf);
         $this->prod_presupuesto_monto_uf = str_replace('<', '&lt;', $this->prod_presupuesto_monto_uf);
         $this->prod_presupuesto_monto_uf = str_replace('>', '&gt;', $this->prod_presupuesto_monto_uf);
         $this->Texto_tag .= "<td>" . $this->prod_presupuesto_monto_uf . "</td>\r\n";
   }
   //----- prod_presupuesto_observaciones
   function NM_export_prod_presupuesto_observaciones()
   {
         $this->prod_presupuesto_observaciones = html_entity_decode($this->prod_presupuesto_observaciones, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->prod_presupuesto_observaciones = strip_tags($this->prod_presupuesto_observaciones);
         $this->prod_presupuesto_observaciones = NM_charset_to_utf8($this->prod_presupuesto_observaciones);
         $this->prod_presupuesto_observaciones = str_replace('<', '&lt;', $this->prod_presupuesto_observaciones);
         $this->prod_presupuesto_observaciones = str_replace('>', '&gt;', $this->prod_presupuesto_observaciones);
         $this->Texto_tag .= "<td>" . $this->prod_presupuesto_observaciones . "</td>\r\n";
   }
   //----- prod_presupuesto_id
   function NM_export_prod_presupuesto_id()
   {
             nmgp_Form_Num_Val($this->prod_presupuesto_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->prod_presupuesto_id = NM_charset_to_utf8($this->prod_presupuesto_id);
         $this->prod_presupuesto_id = str_replace('<', '&lt;', $this->prod_presupuesto_id);
         $this->prod_presupuesto_id = str_replace('>', '&gt;', $this->prod_presupuesto_id);
         $this->Texto_tag .= "<td>" . $this->prod_presupuesto_id . "</td>\r\n";
   }
   //----- prod_presupuesto_id_proyecto
   function NM_export_prod_presupuesto_id_proyecto()
   {
         nmgp_Form_Num_Val($this->look_prod_presupuesto_id_proyecto, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_prod_presupuesto_id_proyecto = NM_charset_to_utf8($this->look_prod_presupuesto_id_proyecto);
         $this->look_prod_presupuesto_id_proyecto = str_replace('<', '&lt;', $this->look_prod_presupuesto_id_proyecto);
         $this->look_prod_presupuesto_id_proyecto = str_replace('>', '&gt;', $this->look_prod_presupuesto_id_proyecto);
         $this->Texto_tag .= "<td>" . $this->look_prod_presupuesto_id_proyecto . "</td>\r\n";
   }
   //----- prod_presupuesto_vigente
   function NM_export_prod_presupuesto_vigente()
   {
         $this->look_prod_presupuesto_vigente = NM_charset_to_utf8($this->look_prod_presupuesto_vigente);
         $this->look_prod_presupuesto_vigente = str_replace('<', '&lt;', $this->look_prod_presupuesto_vigente);
         $this->look_prod_presupuesto_vigente = str_replace('>', '&gt;', $this->look_prod_presupuesto_vigente);
         $this->Texto_tag .= "<td>" . $this->look_prod_presupuesto_vigente . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_presupuesto'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Presupuesto Del Proyecto :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_prod_presupuesto_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_prod_presupuesto"> 
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