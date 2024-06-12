<?php

class detalle_produccion_proyecto_csv
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
                   nm_limpa_str_detalle_produccion_proyecto($cadapar[1]);
                   nm_protect_num_detalle_produccion_proyecto($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['detalle_produccion_proyecto']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($id_proyecto)) 
      {
          $_SESSION['id_proyecto'] = $id_proyecto;
          nm_limpa_str_detalle_produccion_proyecto($_SESSION["id_proyecto"]);
      }
      if (isset($fecha_corte)) 
      {
          $_SESSION['fecha_corte'] = $fecha_corte;
          nm_limpa_str_detalle_produccion_proyecto($_SESSION["fecha_corte"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Csv_password = "";
      $this->Arquivo   = "sc_csv";
      $this->Arquivo  .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip   = $this->Arquivo . "_detalle_produccion_proyecto.zip";
      $this->Arquivo  .= "_detalle_produccion_proyecto";
      $this->Arquivo  .= ".csv";
      $this->Tit_doc   = "detalle_produccion_proyecto.csv";
      $this->Tit_zip   = "detalle_produccion_proyecto.zip";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['detalle_produccion_proyecto']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['detalle_produccion_proyecto']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['detalle_produccion_proyecto']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['detalle_produccion_proyecto']['contr_erro'] = 'on';
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
	$this->NM_cmp_hidden["valor_uf_presupuesto"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['php_cmp_sel']["valor_uf_presupuesto"] = 'off'; }
	}
if (isset($this->sc_temp_id_proyecto)) {$_SESSION['id_proyecto'] = $this->sc_temp_id_proyecto;}
$_SESSION['scriptcase']['detalle_produccion_proyecto']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_name'] .= ".csv";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_name']);
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
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['field_order'] as $Cada_col)
          { 
              $SC_Label = (isset($this->New_label['fecha'])) ? $this->New_label['fecha'] : "Período"; 
              if ($Cada_col == "fecha" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['correlativo_mes'])) ? $this->New_label['correlativo_mes'] : "N°"; 
              if ($Cada_col == "correlativo_mes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tipo_moneda'])) ? $this->New_label['tipo_moneda'] : "Moneda"; 
              if ($Cada_col == "tipo_moneda" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['valor_uf_presupuesto'])) ? $this->New_label['valor_uf_presupuesto'] : "Valor Moneda<br>Período ($)"; 
              if ($Cada_col == "valor_uf_presupuesto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['presupuesto'])) ? $this->New_label['presupuesto'] : "Presupuesto Base<br>Proyecto"; 
              if ($Cada_col == "presupuesto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['modificacion_contrato'])) ? $this->New_label['modificacion_contrato'] : "Modificación<br>Contrato (S)"; 
              if ($Cada_col == "modificacion_contrato" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['presupuesto_acumulado'])) ? $this->New_label['presupuesto_acumulado'] : "Presupuesto<br>Actualizado ($)"; 
              if ($Cada_col == "presupuesto_acumulado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['facturacion'])) ? $this->New_label['facturacion'] : "Facturación<br>Mes - Neto ($)"; 
              if ($Cada_col == "facturacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['produccion_neto'])) ? $this->New_label['produccion_neto'] : "Producción<br>Facturar - Neto ($)"; 
              if ($Cada_col == "produccion_neto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['reajuste'])) ? $this->New_label['reajuste'] : "Reajuste ($)"; 
              if ($Cada_col == "reajuste" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['retencion'])) ? $this->New_label['retencion'] : "Retención ($)"; 
              if ($Cada_col == "retencion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['multa'])) ? $this->New_label['multa'] : "Multas EP<br>Neto ($)"; 
              if ($Cada_col == "multa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['produccion_periodo'])) ? $this->New_label['produccion_periodo'] : "Produccion<br>Periodo ($)"; 
              if ($Cada_col == "produccion_periodo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['produccion1'])) ? $this->New_label['produccion1'] : "Producción <br>Mes<br> Anterior ($)"; 
              if ($Cada_col == "produccion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['produccion2'])) ? $this->New_label['produccion2'] : "Produccion <br>Mes<br> Actual ($)"; 
              if ($Cada_col == "produccion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['avance'])) ? $this->New_label['avance'] : "Producción Total<br>Período MES ($)"; 
              if ($Cada_col == "avance" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['porcentaje_avance'])) ? $this->New_label['porcentaje_avance'] : "Avance Acumulado"; 
              if ($Cada_col == "porcentaje_avance" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['porcentaje_avance2'])) ? $this->New_label['porcentaje_avance2'] : "% Avance"; 
              if ($Cada_col == "porcentaje_avance2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['diferencia_facturacion'])) ? $this->New_label['diferencia_facturacion'] : "Diferencia Facturación"; 
              if ($Cada_col == "diferencia_facturacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['ur_real'])) ? $this->New_label['ur_real'] : "UR Acumulado<br>Mes ($)"; 
              if ($Cada_col == "ur_real" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['backlog_p'])) ? $this->New_label['backlog_p'] : "Backlog P ($)"; 
              if ($Cada_col == "backlog_p" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['backlog_f'])) ? $this->New_label['backlog_f'] : "Backlog F ($)"; 
              if ($Cada_col == "backlog_f" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['dias_mes_desde'])) ? $this->New_label['dias_mes_desde'] : "Dias <br>Mes Desde"; 
              if ($Cada_col == "dias_mes_desde" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['dias_mes_hasta'])) ? $this->New_label['dias_mes_hasta'] : "Dias <br>Mes Hasta"; 
              if ($Cada_col == "dias_mes_hasta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['ur_periodo'])) ? $this->New_label['ur_periodo'] : "UR Acumulado<br>Según Período<br>Facturación"; 
              if ($Cada_col == "ur_periodo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['ur_mes'])) ? $this->New_label['ur_mes'] : "UR Mes"; 
              if ($Cada_col == "ur_mes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['iva'])) ? $this->New_label['iva'] : "Facturación<br> Con IVA"; 
              if ($Cada_col == "iva" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['mod_contrato_iva'])) ? $this->New_label['mod_contrato_iva'] : "Mod. Contrato<bR> Con IVA"; 
              if ($Cada_col == "mod_contrato_iva" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT fecha, correlativo_mes, valor_uf_presupuesto, modificacion_contrato, facturacion, produccion_neto, reajuste, retencion, multa, produccion_periodo, produccion1, produccion2, avance, ur_real, backlog_p, backlog_f, dias_mes_desde, dias_mes_hasta, ur_periodo, ur_mes, id, id_proyecto from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT fecha, correlativo_mes, valor_uf_presupuesto, modificacion_contrato, facturacion, produccion_neto, reajuste, retencion, multa, produccion_periodo, produccion1, produccion2, avance, ur_real, backlog_p, backlog_f, dias_mes_desde, dias_mes_hasta, ur_periodo, ur_mes, id, id_proyecto from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['order_grid'];
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
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         $this->csv_registro = "";
         $this->NM_prim_col  = 0;
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
         $this->sc_proc_grid = true; 
         //----- lookup - presupuesto
         $this->Lookup->lookup_presupuesto($this->presupuesto, $this->id, $this->id_proyecto, $this->array_presupuesto); 
         $this->presupuesto = str_replace("<br>", " ", $this->presupuesto); 
         $this->presupuesto = ($this->presupuesto == "&nbsp;") ? "" : $this->presupuesto; 
         $_SESSION['scriptcase']['detalle_produccion_proyecto']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['detalle_produccion_proyecto']['contr_erro'] = 'off'; 
         $this->porcentaje_avance += $this->avance;
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- fecha
   function NM_export_fecha()
   {
             $conteudo_x =  $this->fecha;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->fecha, "YYYY-MM-DD  ");
                 $this->fecha = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "mmaaaa"));
             } 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->fecha);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- correlativo_mes
   function NM_export_correlativo_mes()
   {
             nmgp_Form_Num_Val($this->correlativo_mes, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->correlativo_mes);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tipo_moneda
   function NM_export_tipo_moneda()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->tipo_moneda);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- valor_uf_presupuesto
   function NM_export_valor_uf_presupuesto()
   {
             nmgp_Form_Num_Val($this->valor_uf_presupuesto, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->valor_uf_presupuesto);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- presupuesto
   function NM_export_presupuesto()
   {
         nmgp_Form_Num_Val($this->presupuesto, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "N", "", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->presupuesto);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- modificacion_contrato
   function NM_export_modificacion_contrato()
   {
             nmgp_Form_Num_Val($this->modificacion_contrato, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "N", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->modificacion_contrato);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- presupuesto_acumulado
   function NM_export_presupuesto_acumulado()
   {
             nmgp_Form_Num_Val($this->presupuesto_acumulado, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->presupuesto_acumulado);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- facturacion
   function NM_export_facturacion()
   {
             nmgp_Form_Num_Val($this->facturacion, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->facturacion);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- produccion_neto
   function NM_export_produccion_neto()
   {
             nmgp_Form_Num_Val($this->produccion_neto, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->produccion_neto);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- reajuste
   function NM_export_reajuste()
   {
             nmgp_Form_Num_Val($this->reajuste, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->reajuste);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- retencion
   function NM_export_retencion()
   {
             nmgp_Form_Num_Val($this->retencion, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->retencion);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- multa
   function NM_export_multa()
   {
             nmgp_Form_Num_Val($this->multa, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->multa);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- produccion_periodo
   function NM_export_produccion_periodo()
   {
             nmgp_Form_Num_Val($this->produccion_periodo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->produccion_periodo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- produccion1
   function NM_export_produccion1()
   {
             nmgp_Form_Num_Val($this->produccion1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->produccion1);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- produccion2
   function NM_export_produccion2()
   {
             nmgp_Form_Num_Val($this->produccion2, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->produccion2);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- avance
   function NM_export_avance()
   {
             nmgp_Form_Num_Val($this->avance, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->avance);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- porcentaje_avance
   function NM_export_porcentaje_avance()
   {
         $porcentaje_avance_save = $this->porcentaje_avance;
             nmgp_Form_Num_Val($this->porcentaje_avance, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->porcentaje_avance);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
         $this->porcentaje_avance = $porcentaje_avance_save;
   }
   //----- porcentaje_avance2
   function NM_export_porcentaje_avance2()
   {
             nmgp_Form_Num_Val($this->porcentaje_avance2, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->porcentaje_avance2);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- diferencia_facturacion
   function NM_export_diferencia_facturacion()
   {
             nmgp_Form_Num_Val($this->diferencia_facturacion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->diferencia_facturacion);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- ur_real
   function NM_export_ur_real()
   {
             nmgp_Form_Num_Val($this->ur_real, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->ur_real);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- backlog_p
   function NM_export_backlog_p()
   {
             nmgp_Form_Num_Val($this->backlog_p, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->backlog_p);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- backlog_f
   function NM_export_backlog_f()
   {
             nmgp_Form_Num_Val($this->backlog_f, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->backlog_f);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- dias_mes_desde
   function NM_export_dias_mes_desde()
   {
             nmgp_Form_Num_Val($this->dias_mes_desde, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->dias_mes_desde);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- dias_mes_hasta
   function NM_export_dias_mes_hasta()
   {
             nmgp_Form_Num_Val($this->dias_mes_hasta, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->dias_mes_hasta);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- ur_periodo
   function NM_export_ur_periodo()
   {
             nmgp_Form_Num_Val($this->ur_periodo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->ur_periodo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- ur_mes
   function NM_export_ur_mes()
   {
             nmgp_Form_Num_Val($this->ur_mes, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->ur_mes);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- iva
   function NM_export_iva()
   {
             nmgp_Form_Num_Val($this->iva, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->iva);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- mod_contrato_iva
   function NM_export_mod_contrato_iva()
   {
             nmgp_Form_Num_Val($this->mod_contrato_iva, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->mod_contrato_iva);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> Producción de Proyectos :: CSV</TITLE>
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
<form name="Fdown" method="get" action="detalle_produccion_proyecto_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="detalle_produccion_proyecto"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['detalle_produccion_proyecto']['csv_return']); ?>"> 
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
