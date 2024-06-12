<?php

class grid_prod_partida_presupuesto_periodo_csv
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;

   var $Arquivo;
   var $Tit_doc;
   var $Delim_dados;
   var $Delim_line;
   var $Delim_col;
   var $Csv_label;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("es");
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

   //---- 
   function monta_csv()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Csv_f);
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
                   nm_limpa_str_grid_prod_partida_presupuesto_periodo($cadapar[1]);
                   nm_protect_num_grid_prod_partida_presupuesto_periodo($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_prod_partida_presupuesto_periodo']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($id_presupuesto)) 
      {
          $_SESSION['id_presupuesto'] = $id_presupuesto;
          nm_limpa_str_grid_prod_partida_presupuesto_periodo($_SESSION["id_presupuesto"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Csv_password = "";
      $this->Arquivo   = "sc_csv";
      $this->Arquivo  .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip   = $this->Arquivo . "_grid_prod_partida_presupuesto_periodo.zip";
      $this->Arquivo  .= "_grid_prod_partida_presupuesto_periodo";
      $this->Arquivo  .= ".csv";
      $this->Tit_doc   = "grid_prod_partida_presupuesto_periodo.csv";
      $this->Tit_zip   = "grid_prod_partida_presupuesto_periodo.zip";
      $this->Label_CSV = "N";
      $this->Delim_dados = "\"";
      $this->Delim_col   = ";";
      $this->Delim_line  = "\r\n";
      $this->Tem_csv_res = false;
      if (isset($_REQUEST['nm_delim_line']) && !empty($_REQUEST['nm_delim_line']))
      {
          $this->Delim_line = str_replace(array(1,2,3), array("\r\n","\r","\n"), $_REQUEST['nm_delim_line']);
      }
      if (isset($_REQUEST['nm_delim_col']) && !empty($_REQUEST['nm_delim_col']))
      {
          $this->Delim_col = str_replace(array(1,2,3,4,5), array(";",",","\	","#",""), $_REQUEST['nm_delim_col']);
      }
      if (isset($_REQUEST['nm_delim_dados']) && !empty($_REQUEST['nm_delim_dados']))
      {
          $this->Delim_dados = str_replace(array(1,2,3,4), array('"',"'","","|"), $_REQUEST['nm_delim_dados']);
      }
      if (isset($_REQUEST['nm_label_csv']) && !empty($_REQUEST['nm_label_csv']))
      {
          $this->Label_CSV = $_REQUEST['nm_label_csv'];
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
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_partida_presupuesto_periodo']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_partida_presupuesto_periodo']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_partida_presupuesto_periodo']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_name'] .= ".csv";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Csv_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      $csv_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      if ($this->Label_CSV == "S")
      { 
          $this->NM_prim_col  = 0;
          $this->csv_registro = "";
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['field_order'] as $Cada_col)
          { 
              $SC_Label = (isset($this->New_label['prod_agrupa_items_nombre_agrupador'])) ? $this->New_label['prod_agrupa_items_nombre_agrupador'] : "Agrupador"; 
              if ($Cada_col == "prod_agrupa_items_nombre_agrupador" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['prod_items_base_item'])) ? $this->New_label['prod_items_base_item'] : "Item"; 
              if ($Cada_col == "prod_items_base_item" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['no_facturado'])) ? $this->New_label['no_facturado'] : "Por Facturar<bR>Unidades - Acumulado"; 
              if ($Cada_col == "no_facturado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tipo_moneda'])) ? $this->New_label['tipo_moneda'] : "Tipo Moneda"; 
              if ($Cada_col == "tipo_moneda" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['prod_partida_presupuesto_periodo_unidades_periodo'])) ? $this->New_label['prod_partida_presupuesto_periodo_unidades_periodo'] : "Unidades Producción<br>Informadas En Período"; 
              if ($Cada_col == "prod_partida_presupuesto_periodo_unidades_periodo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['valor_unitario'])) ? $this->New_label['valor_unitario'] : "Valor Unitario"; 
              if ($Cada_col == "valor_unitario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['prod_partida_presupuesto_periodo_avance'])) ? $this->New_label['prod_partida_presupuesto_periodo_avance'] : "Producción Total<br>Valorizado - Período"; 
              if ($Cada_col == "prod_partida_presupuesto_periodo_avance" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['utilizado'])) ? $this->New_label['utilizado'] : "Unidades Producción<br>Ejecutadas - Total"; 
              if ($Cada_col == "utilizado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['prod_partida_presupuesto_periodo_observaciones'])) ? $this->New_label['prod_partida_presupuesto_periodo_observaciones'] : "Observaciones"; 
              if ($Cada_col == "prod_partida_presupuesto_periodo_observaciones" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['prod_partida_presupuesto_periodo_id_periodo_factura'])) ? $this->New_label['prod_partida_presupuesto_periodo_id_periodo_factura'] : "ID Periodo<br>Facturación"; 
              if ($Cada_col == "prod_partida_presupuesto_periodo_id_periodo_factura" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
          } 
          $this->csv_registro .= $this->Delim_line;
          fwrite($csv_f, $this->csv_registro);
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT distinct prod_agrupa_items.nombre_agrupador as cmp_maior_30_1, prod_items_base.item as prod_items_base_item, prod_partida_presupuesto_periodo.unidades_periodo as cmp_maior_30_2, prod_partida_presupuesto_periodo.avance as cmp_maior_30_3, prod_partida_presupuesto_periodo.observaciones as cmp_maior_30_4, prod_partida_presupuesto_periodo.id_periodo_factura as cmp_maior_30_5, prod_partida_presupuesto_periodo.id_presupuesto_periodo as cmp_maior_30_6, prod_partida_presupuesto_periodo.id_proyecto as cmp_maior_30_7, prod_partida_presupuesto_periodo.id_item as cmp_maior_30_8 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT distinct prod_agrupa_items.nombre_agrupador as cmp_maior_30_1, prod_items_base.item as prod_items_base_item, prod_partida_presupuesto_periodo.unidades_periodo as cmp_maior_30_2, prod_partida_presupuesto_periodo.avance as cmp_maior_30_3, prod_partida_presupuesto_periodo.observaciones as cmp_maior_30_4, prod_partida_presupuesto_periodo.id_periodo_factura as cmp_maior_30_5, prod_partida_presupuesto_periodo.id_presupuesto_periodo as cmp_maior_30_6, prod_partida_presupuesto_periodo.id_proyecto as cmp_maior_30_7, prod_partida_presupuesto_periodo.id_item as cmp_maior_30_8 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_resumo']; 
              $nmgp_select_count .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_resumo'] . ")"; 
              $nmgp_select_count .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
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
         $this->csv_registro = "";
         $this->NM_prim_col  = 0;
         $this->prod_agrupa_items_nombre_agrupador = $rs->fields[0] ;  
         $this->prod_items_base_item = $rs->fields[1] ;  
         $this->prod_partida_presupuesto_periodo_unidades_periodo = $rs->fields[2] ;  
         $this->prod_partida_presupuesto_periodo_unidades_periodo = (string)$this->prod_partida_presupuesto_periodo_unidades_periodo;
         $this->prod_partida_presupuesto_periodo_avance = $rs->fields[3] ;  
         $this->prod_partida_presupuesto_periodo_avance =  str_replace(",", ".", $this->prod_partida_presupuesto_periodo_avance);
         $this->prod_partida_presupuesto_periodo_avance = (string)$this->prod_partida_presupuesto_periodo_avance;
         $this->prod_partida_presupuesto_periodo_observaciones = $rs->fields[4] ;  
         $this->prod_partida_presupuesto_periodo_id_periodo_factura = $rs->fields[5] ;  
         $this->prod_partida_presupuesto_periodo_id_periodo_factura = (string)$this->prod_partida_presupuesto_periodo_id_periodo_factura;
         $this->prod_partida_presupuesto_periodo_id_presupuesto_periodo = $rs->fields[6] ;  
         $this->prod_partida_presupuesto_periodo_id_presupuesto_periodo = (string)$this->prod_partida_presupuesto_periodo_id_presupuesto_periodo;
         $this->prod_partida_presupuesto_periodo_id_proyecto = $rs->fields[7] ;  
         $this->prod_partida_presupuesto_periodo_id_proyecto = (string)$this->prod_partida_presupuesto_periodo_id_proyecto;
         $this->prod_partida_presupuesto_periodo_id_item = $rs->fields[8] ;  
         $this->prod_partida_presupuesto_periodo_id_item = (string)$this->prod_partida_presupuesto_periodo_id_item;
         $this->sc_proc_grid = true; 
         //----- lookup - tipo_moneda
         $this->Lookup->lookup_tipo_moneda($this->tipo_moneda, $_SESSION['id_proyecto'], $this->array_tipo_moneda); 
         $this->tipo_moneda = str_replace("<br>", " ", $this->tipo_moneda); 
         $this->tipo_moneda = ($this->tipo_moneda == "&nbsp;") ? "" : $this->tipo_moneda; 
         $_SESSION['scriptcase']['grid_prod_partida_presupuesto_periodo']['contr_erro'] = 'on';
 $suma_partidas = 0;
$id_partida_prod=0;

$check_sql = " SELECT DISTINCT 
  prod_presupuesto_periodo.id_partida,
  prod_produccion_proyecto.fecha
FROM
  prod_partida_presupuesto_periodo
  INNER JOIN prod_presupuesto_periodo ON (prod_partida_presupuesto_periodo.id_presupuesto_periodo = prod_presupuesto_periodo.id)
  INNER JOIN prod_produccion_proyecto ON (prod_presupuesto_periodo.id_partida = prod_produccion_proyecto.id)
WHERE
  prod_partida_presupuesto_periodo.id_presupuesto_periodo=".$this->prod_partida_presupuesto_periodo_id_presupuesto_periodo ;
 
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
  $id_partida_prod = $this->rs[0][0];
  $fecha_partida=$this->rs[0][1];
}
		else     
{
 $id_partida_prod = 0;
 $fecha_partida='0000-00-00';
}

$this->id_partida =$id_partida_prod;

$check_sql = "SELECT 
  SUM(prod_partida_presupuesto_periodo.unidades_periodo) 
FROM
  prod_partida_presupuesto_periodo
  INNER JOIN prod_presupuesto_periodo ON (prod_partida_presupuesto_periodo.id_presupuesto_periodo = prod_presupuesto_periodo.id)
  INNER JOIN prod_produccion_proyecto ON (prod_presupuesto_periodo.id_partida = prod_produccion_proyecto.id)
WHERE
  prod_partida_presupuesto_periodo.id_proyecto = ".$this->prod_partida_presupuesto_periodo_id_proyecto ." AND 
  prod_partida_presupuesto_periodo.id_item =".$this->prod_partida_presupuesto_periodo_id_item ." AND 
  prod_produccion_proyecto.fecha <='".$fecha_partida."'";  
	
 
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
	$suma_partidas = $this->rs[0][0];
}
		else     
{
	$suma_partidas = 0;
}

$check_sql = "SELECT 
  SUM(prod_partida_presupuesto_periodo.unidades_periodo) 
FROM
  prod_partida_presupuesto_periodo
  INNER JOIN prod_presupuesto_periodo ON (prod_partida_presupuesto_periodo.id_presupuesto_periodo = prod_presupuesto_periodo.id)
  INNER JOIN prod_produccion_proyecto ON (prod_presupuesto_periodo.id_partida = prod_produccion_proyecto.id)
WHERE
  prod_partida_presupuesto_periodo.id_proyecto = ".$this->prod_partida_presupuesto_periodo_id_proyecto ." AND 
  prod_partida_presupuesto_periodo.id_item =".$this->prod_partida_presupuesto_periodo_id_item ." AND 
  prod_produccion_proyecto.fecha <='".$fecha_partida."' AND prod_partida_presupuesto_periodo.facturado = 0";  
	
 
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
	$suma_partidas_facturadas = $this->rs[0][0];
}
		else     
{
	$suma_partidas_facturadas = 0;
}

$check_sql = "SELECT   prod_presupuesto.valor_unitario FROM  prod_presupuesto WHERE  prod_presupuesto.id_proyecto = ".$this->prod_partida_presupuesto_periodo_id_proyecto ." AND prod_presupuesto.id_item = ".$this->prod_partida_presupuesto_periodo_id_item ; 
	
 
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
	$valor_item = $this->rs[0][0];
}
		else     
{
	$valor_item = 0;
}
$this->valor_unitario =$valor_item;
$this->total_valorizado =$suma_partidas * $valor_item ;
$this->utilizado =$suma_partidas;
$this->no_facturado = $suma_partidas_facturadas;
if ($this->no_facturado ==0)
	{
	$this->NM_field_style["no_facturado"] = "background-color:#56b634;";
	}
$_SESSION['scriptcase']['grid_prod_partida_presupuesto_periodo']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->csv_registro .= $this->Delim_line;
         fwrite($csv_f, $this->csv_registro);
         $rs->MoveNext();
      }
      fclose($csv_f);
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- prod_agrupa_items_nombre_agrupador
   function NM_export_prod_agrupa_items_nombre_agrupador()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->prod_agrupa_items_nombre_agrupador);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- prod_items_base_item
   function NM_export_prod_items_base_item()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->prod_items_base_item);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- no_facturado
   function NM_export_no_facturado()
   {
             nmgp_Form_Num_Val($this->no_facturado, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "3", "N", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->no_facturado);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tipo_moneda
   function NM_export_tipo_moneda()
   {
         nmgp_Form_Num_Val($this->tipo_moneda, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->tipo_moneda);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- prod_partida_presupuesto_periodo_unidades_periodo
   function NM_export_prod_partida_presupuesto_periodo_unidades_periodo()
   {
             nmgp_Form_Num_Val($this->prod_partida_presupuesto_periodo_unidades_periodo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "3", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->prod_partida_presupuesto_periodo_unidades_periodo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- valor_unitario
   function NM_export_valor_unitario()
   {
             nmgp_Form_Num_Val($this->valor_unitario, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "N", "", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->valor_unitario);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- prod_partida_presupuesto_periodo_avance
   function NM_export_prod_partida_presupuesto_periodo_avance()
   {
             nmgp_Form_Num_Val($this->prod_partida_presupuesto_periodo_avance, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->prod_partida_presupuesto_periodo_avance);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- utilizado
   function NM_export_utilizado()
   {
             nmgp_Form_Num_Val($this->utilizado, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "3", "N", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->utilizado);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- prod_partida_presupuesto_periodo_observaciones
   function NM_export_prod_partida_presupuesto_periodo_observaciones()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->prod_partida_presupuesto_periodo_observaciones);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- prod_partida_presupuesto_periodo_id_periodo_factura
   function NM_export_prod_partida_presupuesto_periodo_id_periodo_factura()
   {
             nmgp_Form_Num_Val($this->prod_partida_presupuesto_periodo_id_periodo_factura, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->prod_partida_presupuesto_periodo_id_periodo_factura);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>PARTIDAS DE AVANCE - PRODUCCIÓN :: CSV</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
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
   <td class="scExportTitle" style="height: 25px">CSV</td>
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
<form name="Fdown" method="get" action="grid_prod_partida_presupuesto_periodo_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_prod_partida_presupuesto_periodo"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_partida_presupuesto_periodo']['csv_return']); ?>"> 
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
