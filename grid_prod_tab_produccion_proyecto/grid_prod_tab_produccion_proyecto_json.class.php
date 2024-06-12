<?php

class grid_prod_tab_produccion_proyecto_json
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Arquivo;
   var $Arquivo_view;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   function __construct()
   {
      $this->nm_data = new nm_data("es");
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

   function monta_json()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Json_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $result_json = json_encode($this->Arr_result, JSON_UNESCAPED_UNICODE);
              if ($result_json == false)
              {
                  $oJson = new Services_JSON();
                  $result_json = $oJson->encode($this->Arr_result);
              }
              echo $result_json;
              exit;
          }
          else
          {
              $this->progress_bar_end();
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['opcao'] = "";
      }
   }

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
                   nm_limpa_str_grid_prod_tab_produccion_proyecto($cadapar[1]);
                   nm_protect_num_grid_prod_tab_produccion_proyecto($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_prod_tab_produccion_proyecto']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($id_proyecto)) 
      {
          $_SESSION['id_proyecto'] = $id_proyecto;
          nm_limpa_str_grid_prod_tab_produccion_proyecto($_SESSION["id_proyecto"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Json_use_label = false;
      $this->Json_format = false;
      $this->Tem_json_res = false;
      $this->Json_password = "";
      if (isset($_REQUEST['nm_json_label']) && !empty($_REQUEST['nm_json_label']))
      {
          $this->Json_use_label = ($_REQUEST['nm_json_label'] == "S") ? true : false;
      }
      if (isset($_REQUEST['nm_json_format']) && !empty($_REQUEST['nm_json_format']))
      {
          $this->Json_format = ($_REQUEST['nm_json_format'] == "S") ? true : false;
      }
      $this->Tem_json_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_json_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['SC_Gb_Free_cmp']))
      {
          $this->Tem_json_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_prod_tab_produccion_proyecto/grid_prod_tab_produccion_proyecto_res_json.class.php"))
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_label']))
      {
          $this->Json_use_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_label'];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_format']))
      {
          $this->Json_format = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_format'];
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_prod_tab_produccion_proyecto']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_return']);
          if ($this->Tem_json_res) {
              $PB_plus = intval ($this->count_ger * 0.04);
              $PB_plus = ($PB_plus < 2) ? 2 : $PB_plus;
          }
          else {
              $PB_plus = intval ($this->count_ger * 0.02);
              $PB_plus = ($PB_plus < 1) ? 1 : $PB_plus;
          }
          $PB_tot = $this->count_ger + $PB_plus;
          $this->PB_dif = $PB_tot - $this->count_ger;
          $this->pb->setTotalSteps($PB_tot);
      }
      $this->nm_data = new nm_data("es");
      $this->Arquivo      = "sc_json";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_grid_prod_tab_produccion_proyecto.zip";
      $this->Arquivo     .= "_grid_prod_tab_produccion_proyecto";
      $this->Arquivo     .= ".json";
      $this->Tit_doc      = "grid_prod_tab_produccion_proyecto.json";
      $this->Tit_zip      = "grid_prod_tab_produccion_proyecto.zip";
   }

   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   function grava_arquivo()
   {
      global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_tab_produccion_proyecto']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_tab_produccion_proyecto']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_tab_produccion_proyecto']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_prod_tab_produccion_proyecto']['contr_erro'] = 'on';
if (!isset($_SESSION['id_proyecto'])) {$_SESSION['id_proyecto'] = "";}
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
 $check_sql  = "SELECT 
  prod_monedas.tipo_moneda
FROM
  proyectos
  INNER JOIN prod_monedas ON (proyectos.tipo_moneda = prod_monedas.id)
WHERE
  proyectos.id ='".$this->sc_temp_id_proyecto."'";

 
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
	$tipo_moneda= $this->rs[0][0];

    
}
		else     
{
	 $tipo_moneda=0;	
  
}

if ($tipo_moneda<>"UF")
	{
	$this->NM_cmp_hidden["valor_uf_presupuesto"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['php_cmp_sel']["valor_uf_presupuesto"] = 'off'; }
	}
if (isset($this->sc_temp_id_proyecto)) {$_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
$_SESSION['scriptcase']['grid_prod_tab_produccion_proyecto']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['embutida'])
      { 
          $this->Json_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $json_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      }
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT fecha, correlativo_mes, valor_uf_presupuesto, modificacion_contrato, facturacion, produccion_neto, reajuste, retencion, multa, produccion_periodo, produccion1, produccion2, avance, ur_real, backlog_p, backlog_f, dias_mes_desde, dias_mes_hasta, ur_periodo, ur_mes, id, id_proyecto from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT fecha, correlativo_mes, valor_uf_presupuesto, modificacion_contrato, facturacion, produccion_neto, reajuste, retencion, multa, produccion_periodo, produccion1, produccion2, avance, ur_real, backlog_p, backlog_f, dias_mes_desde, dias_mes_hasta, ur_periodo, ur_mes, id, id_proyecto from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['order_grid'];
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
      $this->porcentaje_avance = 0;
      $this->SC_seq_register = 0;
      $this->json_registro = array();
      $this->SC_seq_json   = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->fecha = $rs->fields[0] ;  
         $this->correlativo_mes = $rs->fields[1] ;  
         $this->correlativo_mes = (string)$this->correlativo_mes;
         $this->valor_uf_presupuesto = $rs->fields[2] ;  
         $this->valor_uf_presupuesto =  str_replace(",", ".", $this->valor_uf_presupuesto);
         $this->valor_uf_presupuesto = (string)$this->valor_uf_presupuesto;
         $this->modificacion_contrato = $rs->fields[3] ;  
         $this->modificacion_contrato =  str_replace(",", ".", $this->modificacion_contrato);
         $this->modificacion_contrato = (string)$this->modificacion_contrato;
         $this->facturacion = $rs->fields[4] ;  
         $this->facturacion =  str_replace(",", ".", $this->facturacion);
         $this->facturacion = (string)$this->facturacion;
         $this->produccion_neto = $rs->fields[5] ;  
         $this->produccion_neto =  str_replace(",", ".", $this->produccion_neto);
         $this->produccion_neto = (string)$this->produccion_neto;
         $this->reajuste = $rs->fields[6] ;  
         $this->reajuste =  str_replace(",", ".", $this->reajuste);
         $this->reajuste = (string)$this->reajuste;
         $this->retencion = $rs->fields[7] ;  
         $this->retencion =  str_replace(",", ".", $this->retencion);
         $this->retencion = (string)$this->retencion;
         $this->multa = $rs->fields[8] ;  
         $this->multa =  str_replace(",", ".", $this->multa);
         $this->multa = (string)$this->multa;
         $this->produccion_periodo = $rs->fields[9] ;  
         $this->produccion_periodo =  str_replace(",", ".", $this->produccion_periodo);
         $this->produccion_periodo = (string)$this->produccion_periodo;
         $this->produccion1 = $rs->fields[10] ;  
         $this->produccion1 =  str_replace(",", ".", $this->produccion1);
         $this->produccion1 = (string)$this->produccion1;
         $this->produccion2 = $rs->fields[11] ;  
         $this->produccion2 =  str_replace(",", ".", $this->produccion2);
         $this->produccion2 = (string)$this->produccion2;
         $this->avance = $rs->fields[12] ;  
         $this->avance =  str_replace(",", ".", $this->avance);
         $this->avance = (string)$this->avance;
         $this->ur_real = $rs->fields[13] ;  
         $this->ur_real =  str_replace(",", ".", $this->ur_real);
         $this->ur_real = (string)$this->ur_real;
         $this->backlog_p = $rs->fields[14] ;  
         $this->backlog_p =  str_replace(",", ".", $this->backlog_p);
         $this->backlog_p = (string)$this->backlog_p;
         $this->backlog_f = $rs->fields[15] ;  
         $this->backlog_f =  str_replace(",", ".", $this->backlog_f);
         $this->backlog_f = (string)$this->backlog_f;
         $this->dias_mes_desde = $rs->fields[16] ;  
         $this->dias_mes_desde = (string)$this->dias_mes_desde;
         $this->dias_mes_hasta = $rs->fields[17] ;  
         $this->dias_mes_hasta = (string)$this->dias_mes_hasta;
         $this->ur_periodo = $rs->fields[18] ;  
         $this->ur_periodo =  str_replace(",", ".", $this->ur_periodo);
         $this->ur_periodo = (string)$this->ur_periodo;
         $this->ur_mes = $rs->fields[19] ;  
         $this->ur_mes =  str_replace(",", ".", $this->ur_mes);
         $this->ur_mes = (string)$this->ur_mes;
         $this->id = $rs->fields[20] ;  
         $this->id = (string)$this->id;
         $this->id_proyecto = $rs->fields[21] ;  
         $this->id_proyecto = (string)$this->id_proyecto;
         $this->Orig_fecha = $this->fecha;
         $this->Orig_correlativo_mes = $this->correlativo_mes;
         $this->Orig_valor_uf_presupuesto = $this->valor_uf_presupuesto;
         $this->Orig_modificacion_contrato = $this->modificacion_contrato;
         $this->Orig_facturacion = $this->facturacion;
         $this->Orig_produccion_neto = $this->produccion_neto;
         $this->Orig_reajuste = $this->reajuste;
         $this->Orig_retencion = $this->retencion;
         $this->Orig_multa = $this->multa;
         $this->Orig_produccion_periodo = $this->produccion_periodo;
         $this->Orig_produccion1 = $this->produccion1;
         $this->Orig_produccion2 = $this->produccion2;
         $this->Orig_avance = $this->avance;
         $this->Orig_ur_real = $this->ur_real;
         $this->Orig_backlog_p = $this->backlog_p;
         $this->Orig_backlog_f = $this->backlog_f;
         $this->Orig_dias_mes_desde = $this->dias_mes_desde;
         $this->Orig_dias_mes_hasta = $this->dias_mes_hasta;
         $this->Orig_ur_periodo = $this->ur_periodo;
         $this->Orig_ur_mes = $this->ur_mes;
         $this->Orig_id = $this->id;
         $this->Orig_id_proyecto = $this->id_proyecto;
         $this->sc_proc_grid = true; 
         //----- lookup - presupuesto
         $this->Lookup->lookup_presupuesto($this->presupuesto, $this->id, $this->id_proyecto, $this->array_presupuesto); 
         $this->presupuesto = str_replace("<br>", " ", $this->presupuesto); 
         $this->presupuesto = ($this->presupuesto == "&nbsp;") ? "" : $this->presupuesto; 
         $_SESSION['scriptcase']['grid_prod_tab_produccion_proyecto']['contr_erro'] = 'on';
if (!isset($_SESSION['id_proyecto'])) {$_SESSION['id_proyecto'] = "";}
if (!isset($this->sc_temp_id_proyecto)) {$this->sc_temp_id_proyecto = (isset($_SESSION['id_proyecto'])) ? $_SESSION['id_proyecto'] : "";}
 $this->iva =$this->facturacion  * 1.19;
$this->mod_contrato_iva =$this->modificacion_contrato *1.19;

$check_sql  = "SELECT 
  prod_monedas.tipo_moneda
FROM
  proyectos
  INNER JOIN prod_monedas ON (proyectos.tipo_moneda = prod_monedas.id)
WHERE
  proyectos.id ='".$this->sc_temp_id_proyecto."'";

 
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
	$this->tipo_moneda = $this->rs[0][0];

    
}
		else     
{
	 $this->tipo_moneda ="NO DEFINIDO";	
  
}


	$check_sql = "SELECT min(prod_produccion_proyecto.id) as min_partida, max(prod_produccion_proyecto.id) as max_partida FROM  prod_produccion_proyecto WHERE prod_produccion_proyecto.id_proyecto =".$this->sc_temp_id_proyecto;
	
		 
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


if ($this->tipo_moneda =="UF" or $this->tipo_moneda =="US DOLAR")
	{
		$this->modificacion_contrato =$this->modificacion_contrato *$this->valor_uf_presupuesto ;
		$this->presupuesto =$this->presupuesto *$this->valor_uf_presupuesto ;
		$this->facturacion =$this->facturacion *$this->valor_uf_presupuesto ;
		$this->produccion_neto =$this->produccion_neto *$this->valor_uf_presupuesto ;
		$this->reajuste =$this->reajuste *$this->valor_uf_presupuesto ;
		$this->retencion =$this->retencion *$this->valor_uf_presupuesto ;
		$this->multa =$this->multa *$this->valor_uf_presupuesto ;
		$this->produccion_periodo =$this->produccion_periodo *$this->valor_uf_presupuesto ;
		$this->produccion1 =$this->produccion1 *$this->valor_uf_presupuesto ;
		$this->produccion2 =$this->produccion2 *$this->valor_uf_presupuesto ;
		$this->avance =$this->avance *$this->valor_uf_presupuesto ;
		$this->ur_real =$this->ur_real *$this->valor_uf_presupuesto ;
		$this->backlog_p =$this->backlog_p *$this->valor_uf_presupuesto ;
		$this->backlog_f =$this->backlog_f *$this->valor_uf_presupuesto ;
	}

	
	if ($this->id ==	$min_partida)
		{
		if ($this->modificacion_contrato +$this->reajuste ==0)
			{
			  $this->porcentaje_avance2 =0;
			}
		else
			{
				$this->presupuesto_acumulado =$this->modificacion_contrato ;
				$this->porcentaje_avance2 =(100*$this->avance )/($this->modificacion_contrato +$this->reajuste );
			}
		}
	 else
		 {
		 	if ($this->presupuesto_acumulado +$this->modificacion_contrato ==0)
			{
			  $this->porcentaje_avance2 =0;
			}
		 else
			 {
		    	$this->presupuesto_acumulado =$this->presupuesto_acumulado +$this->modificacion_contrato ;
		   		$this->porcentaje_avance2 =(100*($this->porcentaje_avance +$this->avance ))/($this->presupuesto_acumulado );
			 }
		 }
if ($this->facturacion >0)
	{
	  $this->diferencia_facturacion =$this->facturacion -$this->produccion_neto ;
	}
else
	{
	  $this->diferencia_facturacion =0;
	}
if (isset($this->sc_temp_id_proyecto)) {$_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
$_SESSION['scriptcase']['grid_prod_tab_produccion_proyecto']['contr_erro'] = 'off'; 
         $this->porcentaje_avance += $this->avance;
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->SC_seq_json++;
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['embutida'])
      { 
          $_SESSION['scriptcase']['export_return'] = $this->json_registro;
      }
      else
      { 
          $result_json = json_encode($this->json_registro, JSON_UNESCAPED_UNICODE);
          if ($result_json == false)
          {
              $oJson = new Services_JSON();
              $result_json = $oJson->encode($this->json_registro);
          }
          fwrite($json_f, $result_json);
          fclose($json_f);
          if ($this->Tem_json_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "grid_prod_tab_produccion_proyecto_res_json.class.php");
              $this->Res = new grid_prod_tab_produccion_proyecto_res_json();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_res_grid'] = true;
              $this->Res->monta_json();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Json_password != "" || $this->Tem_json_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Json_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Json_f, ' ')) ? " \"" . $this->Json_f . "\"" :  $this->Json_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
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
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
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
              unlink($Arq_input);
              $this->Arquivo = $this->Arq_zip;
              $this->Json_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_json_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_res_file']['json'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_res_file']['json']);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- fecha
   function NM_export_fecha()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->fecha;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->fecha, "YYYY-MM-DD  ");
                 $this->fecha = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "mmaaaa"));
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['fecha'])) ? $this->New_label['fecha'] : "Período"; 
         }
         else
         {
             $SC_Label = "fecha"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->fecha;
   }
   //----- correlativo_mes
   function NM_export_correlativo_mes()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->correlativo_mes, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['correlativo_mes'])) ? $this->New_label['correlativo_mes'] : "N°"; 
         }
         else
         {
             $SC_Label = "correlativo_mes"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->correlativo_mes;
   }
   //----- tipo_moneda
   function NM_export_tipo_moneda()
   {
         $this->tipo_moneda = NM_charset_to_utf8($this->tipo_moneda);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tipo_moneda'])) ? $this->New_label['tipo_moneda'] : "Moneda"; 
         }
         else
         {
             $SC_Label = "tipo_moneda"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tipo_moneda;
   }
   //----- valor_uf_presupuesto
   function NM_export_valor_uf_presupuesto()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->valor_uf_presupuesto, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['valor_uf_presupuesto'])) ? $this->New_label['valor_uf_presupuesto'] : "Valor Moneda<br>Período ($)"; 
         }
         else
         {
             $SC_Label = "valor_uf_presupuesto"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->valor_uf_presupuesto;
   }
   //----- presupuesto
   function NM_export_presupuesto()
   {
         nmgp_Form_Num_Val($this->presupuesto, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "N", "", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['presupuesto'])) ? $this->New_label['presupuesto'] : "Presupuesto Base<br>Proyecto"; 
         }
         else
         {
             $SC_Label = "presupuesto"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->presupuesto;
   }
   //----- modificacion_contrato
   function NM_export_modificacion_contrato()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->modificacion_contrato, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "N", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['modificacion_contrato'])) ? $this->New_label['modificacion_contrato'] : "Modificación<br>Contrato (S)"; 
         }
         else
         {
             $SC_Label = "modificacion_contrato"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->modificacion_contrato;
   }
   //----- presupuesto_acumulado
   function NM_export_presupuesto_acumulado()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->presupuesto_acumulado, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['presupuesto_acumulado'])) ? $this->New_label['presupuesto_acumulado'] : "Presupuesto<br>Actualizado ($)"; 
         }
         else
         {
             $SC_Label = "presupuesto_acumulado"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->presupuesto_acumulado;
   }
   //----- facturacion
   function NM_export_facturacion()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->facturacion, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['facturacion'])) ? $this->New_label['facturacion'] : "Facturación<br>Mes - Neto ($)"; 
         }
         else
         {
             $SC_Label = "facturacion"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->facturacion;
   }
   //----- produccion_neto
   function NM_export_produccion_neto()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->produccion_neto, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['produccion_neto'])) ? $this->New_label['produccion_neto'] : "Producción<br>Facturar - Neto ($)"; 
         }
         else
         {
             $SC_Label = "produccion_neto"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->produccion_neto;
   }
   //----- reajuste
   function NM_export_reajuste()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->reajuste, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['reajuste'])) ? $this->New_label['reajuste'] : "Reajuste ($)"; 
         }
         else
         {
             $SC_Label = "reajuste"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->reajuste;
   }
   //----- retencion
   function NM_export_retencion()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->retencion, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['retencion'])) ? $this->New_label['retencion'] : "Retención ($)"; 
         }
         else
         {
             $SC_Label = "retencion"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->retencion;
   }
   //----- multa
   function NM_export_multa()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->multa, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['multa'])) ? $this->New_label['multa'] : "Multas EP<br>Neto ($)"; 
         }
         else
         {
             $SC_Label = "multa"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->multa;
   }
   //----- produccion_periodo
   function NM_export_produccion_periodo()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->produccion_periodo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['produccion_periodo'])) ? $this->New_label['produccion_periodo'] : "Produccion<br>Periodo ($)"; 
         }
         else
         {
             $SC_Label = "produccion_periodo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->produccion_periodo;
   }
   //----- produccion1
   function NM_export_produccion1()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->produccion1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['produccion1'])) ? $this->New_label['produccion1'] : "Producción <br>Mes<br> Anterior ($)"; 
         }
         else
         {
             $SC_Label = "produccion1"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->produccion1;
   }
   //----- produccion2
   function NM_export_produccion2()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->produccion2, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['produccion2'])) ? $this->New_label['produccion2'] : "Produccion <br>Mes<br> Actual ($)"; 
         }
         else
         {
             $SC_Label = "produccion2"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->produccion2;
   }
   //----- avance
   function NM_export_avance()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->avance, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['avance'])) ? $this->New_label['avance'] : "Producción Total<br>Período MES ($)"; 
         }
         else
         {
             $SC_Label = "avance"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->avance;
   }
   //----- porcentaje_avance
   function NM_export_porcentaje_avance()
   {
         $porcentaje_avance_save = $this->porcentaje_avance;
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->porcentaje_avance, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['porcentaje_avance'])) ? $this->New_label['porcentaje_avance'] : "Avance Acumulado"; 
         }
         else
         {
             $SC_Label = "porcentaje_avance"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->porcentaje_avance;
         $this->porcentaje_avance = $porcentaje_avance_save;
   }
   //----- porcentaje_avance2
   function NM_export_porcentaje_avance2()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->porcentaje_avance2, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['porcentaje_avance2'])) ? $this->New_label['porcentaje_avance2'] : "% Avance"; 
         }
         else
         {
             $SC_Label = "porcentaje_avance2"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->porcentaje_avance2;
   }
   //----- diferencia_facturacion
   function NM_export_diferencia_facturacion()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->diferencia_facturacion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['diferencia_facturacion'])) ? $this->New_label['diferencia_facturacion'] : "Diferencia Facturación"; 
         }
         else
         {
             $SC_Label = "diferencia_facturacion"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->diferencia_facturacion;
   }
   //----- ur_real
   function NM_export_ur_real()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ur_real, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ur_real'])) ? $this->New_label['ur_real'] : "UR Acumulado<br>Mes ($)"; 
         }
         else
         {
             $SC_Label = "ur_real"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ur_real;
   }
   //----- backlog_p
   function NM_export_backlog_p()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->backlog_p, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['backlog_p'])) ? $this->New_label['backlog_p'] : "Backlog P ($)"; 
         }
         else
         {
             $SC_Label = "backlog_p"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->backlog_p;
   }
   //----- backlog_f
   function NM_export_backlog_f()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->backlog_f, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['backlog_f'])) ? $this->New_label['backlog_f'] : "Backlog F ($)"; 
         }
         else
         {
             $SC_Label = "backlog_f"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->backlog_f;
   }
   //----- dias_mes_desde
   function NM_export_dias_mes_desde()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->dias_mes_desde, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['dias_mes_desde'])) ? $this->New_label['dias_mes_desde'] : "Dias <br>Mes Desde"; 
         }
         else
         {
             $SC_Label = "dias_mes_desde"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->dias_mes_desde;
   }
   //----- dias_mes_hasta
   function NM_export_dias_mes_hasta()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->dias_mes_hasta, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['dias_mes_hasta'])) ? $this->New_label['dias_mes_hasta'] : "Dias <br>Mes Hasta"; 
         }
         else
         {
             $SC_Label = "dias_mes_hasta"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->dias_mes_hasta;
   }
   //----- ur_periodo
   function NM_export_ur_periodo()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ur_periodo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ur_periodo'])) ? $this->New_label['ur_periodo'] : "UR Acumulado<br>Según Período<br>Facturación"; 
         }
         else
         {
             $SC_Label = "ur_periodo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ur_periodo;
   }
   //----- ur_mes
   function NM_export_ur_mes()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ur_mes, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ur_mes'])) ? $this->New_label['ur_mes'] : "UR Mes"; 
         }
         else
         {
             $SC_Label = "ur_mes"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ur_mes;
   }
   //----- iva
   function NM_export_iva()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->iva, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['iva'])) ? $this->New_label['iva'] : "Facturación<br> Con IVA"; 
         }
         else
         {
             $SC_Label = "iva"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->iva;
   }
   //----- mod_contrato_iva
   function NM_export_mod_contrato_iva()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->mod_contrato_iva, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['mod_contrato_iva'])) ? $this->New_label['mod_contrato_iva'] : "Mod. Contrato<bR> Con IVA"; 
         }
         else
         {
             $SC_Label = "mod_contrato_iva"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->mod_contrato_iva;
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
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>REGISTROS E INDICADORES DE PRODUCCIÓN DEL PROYECTO :: JSON</TITLE>
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
   <td class="scExportTitle" style="height: 25px">JSON</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_prod_tab_produccion_proyecto_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_prod_tab_produccion_proyecto"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_tab_produccion_proyecto']['json_return']); ?>"> 
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
