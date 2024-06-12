<?php

class grid_prod_produccion_proyecto_gestion_rtf
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
                   nm_limpa_str_grid_prod_produccion_proyecto_gestion($cadapar[1]);
                   nm_protect_num_grid_prod_produccion_proyecto_gestion($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_prod_produccion_proyecto_gestion']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_prod_produccion_proyecto_gestion";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_prod_produccion_proyecto_gestion.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
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
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq_filtro'];
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
      $this->nm_where_dinamico = "";
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
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_proyecto'])) ? $this->New_label['id_proyecto'] : "Código Proyecto"; 
          if ($Cada_col == "id_proyecto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['presupuesto'])) ? $this->New_label['presupuesto'] : "Presupuesto Base<br>Proyecto"; 
          if ($Cada_col == "presupuesto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['modificacion_contrato'])) ? $this->New_label['modificacion_contrato'] : "Modificacion Contrato"; 
          if ($Cada_col == "modificacion_contrato" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['facturacion'])) ? $this->New_label['facturacion'] : "Facturacion Total Neto"; 
          if ($Cada_col == "facturacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['reajuste'])) ? $this->New_label['reajuste'] : "Reajuste Total Neto"; 
          if ($Cada_col == "reajuste" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['retencion'])) ? $this->New_label['retencion'] : "Retención Total Neto"; 
          if ($Cada_col == "retencion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['multa'])) ? $this->New_label['multa'] : "Multas Total Neto"; 
          if ($Cada_col == "multa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['avance'])) ? $this->New_label['avance'] : "Producción Total Neto"; 
          if ($Cada_col == "avance" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ur_real'])) ? $this->New_label['ur_real'] : "UR Acumulado<br>Mes"; 
          if ($Cada_col == "ur_real" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['backlog_p'])) ? $this->New_label['backlog_p'] : "Backlog P"; 
          if ($Cada_col == "backlog_p" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['backlog_f'])) ? $this->New_label['backlog_f'] : "Backlog F"; 
          if ($Cada_col == "backlog_f" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['iva'])) ? $this->New_label['iva'] : "Facturación<br> Con IVA"; 
          if ($Cada_col == "iva" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['mod_contrato_iva'])) ? $this->New_label['mod_contrato_iva'] : "Mod. Contrato<bR> Con IVA"; 
          if ($Cada_col == "mod_contrato_iva" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT id_proyecto, SUM(modificacion_contrato) as modificacion_contrato, sum(facturacion) as facturacion, SUM(reajuste) as reajuste, SUM(retencion) as retencion, SUM(multa) as multa, sum(avance) as avance, ur_real, backlog_p, backlog_f, id from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_proyecto, SUM(modificacion_contrato) as modificacion_contrato, sum(facturacion) as facturacion, SUM(reajuste) as reajuste, SUM(retencion) as retencion, SUM(multa) as multa, sum(avance) as avance, ur_real, backlog_p, backlog_f, id from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['where_pesq'];
      $nmgp_select .= " group by id_proyecto"; 
      $nmgp_select_count .= " group by id_proyecto"; 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['order_grid'];
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
         $this->modificacion_contrato = $rs->fields[1] ;  
         $this->modificacion_contrato =  str_replace(",", ".", $this->modificacion_contrato);
         $this->modificacion_contrato = (string)$this->modificacion_contrato;
         $this->facturacion = $rs->fields[2] ;  
         $this->facturacion =  str_replace(",", ".", $this->facturacion);
         $this->facturacion = (string)$this->facturacion;
         $this->reajuste = $rs->fields[3] ;  
         $this->reajuste =  str_replace(",", ".", $this->reajuste);
         $this->reajuste = (string)$this->reajuste;
         $this->retencion = $rs->fields[4] ;  
         $this->retencion =  str_replace(",", ".", $this->retencion);
         $this->retencion = (string)$this->retencion;
         $this->multa = $rs->fields[5] ;  
         $this->multa =  str_replace(",", ".", $this->multa);
         $this->multa = (string)$this->multa;
         $this->avance = $rs->fields[6] ;  
         $this->avance =  str_replace(",", ".", $this->avance);
         $this->avance = (string)$this->avance;
         $this->ur_real = $rs->fields[7] ;  
         $this->ur_real =  str_replace(",", ".", $this->ur_real);
         $this->ur_real = (string)$this->ur_real;
         $this->backlog_p = $rs->fields[8] ;  
         $this->backlog_p =  str_replace(",", ".", $this->backlog_p);
         $this->backlog_p = (string)$this->backlog_p;
         $this->backlog_f = $rs->fields[9] ;  
         $this->backlog_f =  str_replace(",", ".", $this->backlog_f);
         $this->backlog_f = (string)$this->backlog_f;
         $this->id = $rs->fields[10] ;  
         $this->id = (string)$this->id;
         //----- lookup - id_proyecto
         $this->look_id_proyecto = $this->id_proyecto; 
         $this->Lookup->lookup_id_proyecto($this->look_id_proyecto, $this->id_proyecto) ; 
         $this->look_id_proyecto = ($this->look_id_proyecto == "&nbsp;") ? "" : $this->look_id_proyecto; 
         $this->sc_proc_grid = true; 
         //----- lookup - presupuesto
         $this->Lookup->lookup_presupuesto($this->presupuesto, $this->id, $this->id_proyecto, $this->array_presupuesto); 
         $this->presupuesto = str_replace("<br>", " ", $this->presupuesto); 
         $this->presupuesto = ($this->presupuesto == "&nbsp;") ? "" : $this->presupuesto; 
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
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- id_proyecto
   function NM_export_id_proyecto()
   {
         $this->look_id_proyecto = html_entity_decode($this->look_id_proyecto, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_id_proyecto = strip_tags($this->look_id_proyecto);
         $this->look_id_proyecto = NM_charset_to_utf8($this->look_id_proyecto);
         $this->look_id_proyecto = str_replace('<', '&lt;', $this->look_id_proyecto);
         $this->look_id_proyecto = str_replace('>', '&gt;', $this->look_id_proyecto);
         $this->Texto_tag .= "<td>" . $this->look_id_proyecto . "</td>\r\n";
   }
   //----- presupuesto
   function NM_export_presupuesto()
   {
         nmgp_Form_Num_Val($this->presupuesto, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "N", "", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->presupuesto = NM_charset_to_utf8($this->presupuesto);
         $this->presupuesto = str_replace('<', '&lt;', $this->presupuesto);
         $this->presupuesto = str_replace('>', '&gt;', $this->presupuesto);
         $this->Texto_tag .= "<td>" . $this->presupuesto . "</td>\r\n";
   }
   //----- modificacion_contrato
   function NM_export_modificacion_contrato()
   {
             nmgp_Form_Num_Val($this->modificacion_contrato, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->modificacion_contrato = NM_charset_to_utf8($this->modificacion_contrato);
         $this->modificacion_contrato = str_replace('<', '&lt;', $this->modificacion_contrato);
         $this->modificacion_contrato = str_replace('>', '&gt;', $this->modificacion_contrato);
         $this->Texto_tag .= "<td>" . $this->modificacion_contrato . "</td>\r\n";
   }
   //----- facturacion
   function NM_export_facturacion()
   {
             nmgp_Form_Num_Val($this->facturacion, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->facturacion = NM_charset_to_utf8($this->facturacion);
         $this->facturacion = str_replace('<', '&lt;', $this->facturacion);
         $this->facturacion = str_replace('>', '&gt;', $this->facturacion);
         $this->Texto_tag .= "<td>" . $this->facturacion . "</td>\r\n";
   }
   //----- reajuste
   function NM_export_reajuste()
   {
             nmgp_Form_Num_Val($this->reajuste, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->reajuste = NM_charset_to_utf8($this->reajuste);
         $this->reajuste = str_replace('<', '&lt;', $this->reajuste);
         $this->reajuste = str_replace('>', '&gt;', $this->reajuste);
         $this->Texto_tag .= "<td>" . $this->reajuste . "</td>\r\n";
   }
   //----- retencion
   function NM_export_retencion()
   {
             nmgp_Form_Num_Val($this->retencion, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->retencion = NM_charset_to_utf8($this->retencion);
         $this->retencion = str_replace('<', '&lt;', $this->retencion);
         $this->retencion = str_replace('>', '&gt;', $this->retencion);
         $this->Texto_tag .= "<td>" . $this->retencion . "</td>\r\n";
   }
   //----- multa
   function NM_export_multa()
   {
             nmgp_Form_Num_Val($this->multa, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->multa = NM_charset_to_utf8($this->multa);
         $this->multa = str_replace('<', '&lt;', $this->multa);
         $this->multa = str_replace('>', '&gt;', $this->multa);
         $this->Texto_tag .= "<td>" . $this->multa . "</td>\r\n";
   }
   //----- avance
   function NM_export_avance()
   {
             nmgp_Form_Num_Val($this->avance, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->avance = NM_charset_to_utf8($this->avance);
         $this->avance = str_replace('<', '&lt;', $this->avance);
         $this->avance = str_replace('>', '&gt;', $this->avance);
         $this->Texto_tag .= "<td>" . $this->avance . "</td>\r\n";
   }
   //----- ur_real
   function NM_export_ur_real()
   {
             nmgp_Form_Num_Val($this->ur_real, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ur_real = NM_charset_to_utf8($this->ur_real);
         $this->ur_real = str_replace('<', '&lt;', $this->ur_real);
         $this->ur_real = str_replace('>', '&gt;', $this->ur_real);
         $this->Texto_tag .= "<td>" . $this->ur_real . "</td>\r\n";
   }
   //----- backlog_p
   function NM_export_backlog_p()
   {
             nmgp_Form_Num_Val($this->backlog_p, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->backlog_p = NM_charset_to_utf8($this->backlog_p);
         $this->backlog_p = str_replace('<', '&lt;', $this->backlog_p);
         $this->backlog_p = str_replace('>', '&gt;', $this->backlog_p);
         $this->Texto_tag .= "<td>" . $this->backlog_p . "</td>\r\n";
   }
   //----- backlog_f
   function NM_export_backlog_f()
   {
             nmgp_Form_Num_Val($this->backlog_f, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->backlog_f = NM_charset_to_utf8($this->backlog_f);
         $this->backlog_f = str_replace('<', '&lt;', $this->backlog_f);
         $this->backlog_f = str_replace('>', '&gt;', $this->backlog_f);
         $this->Texto_tag .= "<td>" . $this->backlog_f . "</td>\r\n";
   }
   //----- iva
   function NM_export_iva()
   {
             nmgp_Form_Num_Val($this->iva, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->iva = NM_charset_to_utf8($this->iva);
         $this->iva = str_replace('<', '&lt;', $this->iva);
         $this->iva = str_replace('>', '&gt;', $this->iva);
         $this->Texto_tag .= "<td>" . $this->iva . "</td>\r\n";
   }
   //----- mod_contrato_iva
   function NM_export_mod_contrato_iva()
   {
             nmgp_Form_Num_Val($this->mod_contrato_iva, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->mod_contrato_iva = NM_charset_to_utf8($this->mod_contrato_iva);
         $this->mod_contrato_iva = str_replace('<', '&lt;', $this->mod_contrato_iva);
         $this->mod_contrato_iva = str_replace('>', '&gt;', $this->mod_contrato_iva);
         $this->Texto_tag .= "<td>" . $this->mod_contrato_iva . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto_gestion'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> Producción de Proyectos :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_prod_produccion_proyecto_gestion_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_prod_produccion_proyecto_gestion"> 
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
