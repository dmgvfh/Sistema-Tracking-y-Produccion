<?php

class grid_prod_produccion_proyecto_rtf
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
                   nm_limpa_str_grid_prod_produccion_proyecto($cadapar[1]);
                   nm_protect_num_grid_prod_produccion_proyecto($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_prod_produccion_proyecto']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_prod_produccion_proyecto";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_prod_produccion_proyecto.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_prod_produccion_proyecto']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['campos_busca'];
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
          $this->fecha = (isset($Busca_temp['fecha'])) ? $Busca_temp['fecha'] : ""; 
          $tmp_pos = (is_string($this->fecha)) ? strpos($this->fecha, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->fecha))
          {
              $this->fecha = substr($this->fecha, 0, $tmp_pos);
          }
          $this->habilitado = (isset($Busca_temp['habilitado'])) ? $Busca_temp['habilitado'] : ""; 
          $tmp_pos = (is_string($this->habilitado)) ? strpos($this->habilitado, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->habilitado))
          {
              $this->habilitado = substr($this->habilitado, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_prod_produccion_proyecto']['contr_erro'] = 'on';
 if ($this->id_empresa <>"")
	{
	  if (empty($this->sc_where_atual ))
	{
		$this->nm_where_dinamico = " where id_proyecto in (SELECT id from proyectos where id_empresa=".$this->id_empresa .") ";
	
	} 
	else 
	{
		$this->nm_where_dinamico = " and id_proyecto in (SELECT id from proyectos where id_empresa=".$this->id_empresa .") ";
	}
	if ($this->habilitado =="1")
			{

			$this->nm_where_dinamico = $this->nm_where_dinamico ." and id_proyecto in (select id from proyectos where habilitado=1) " ;

			} 
	}


if ($this->habilitado =="1" and $this->id_empresa =="")
	{
	  
	  if (empty($this->sc_where_atual ))
		{
			$this->nm_where_dinamico = " where id_proyecto in (select id from proyectos where habilitado=1) " ;
		} 
		else 
		{
			$this->nm_where_dinamico = " and id_proyecto in (select id from proyectos where habilitado=1) ";
		}
	}
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['inicio']);
}

$_SESSION['scriptcase']['grid_prod_produccion_proyecto']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['empresa'])) ? $this->New_label['empresa'] : "Empresa"; 
          if ($Cada_col == "empresa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_proyecto'])) ? $this->New_label['id_proyecto'] : "Proyecto"; 
          if ($Cada_col == "id_proyecto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['fecha'])) ? $this->New_label['fecha'] : "Período"; 
          if ($Cada_col == "fecha" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tipo_moneda'])) ? $this->New_label['tipo_moneda'] : "Tipo Moneda"; 
          if ($Cada_col == "tipo_moneda" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valor_uf_presupuesto'])) ? $this->New_label['valor_uf_presupuesto'] : "Valor Moneda<br>Perído ($)"; 
          if ($Cada_col == "valor_uf_presupuesto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['presupuesto_acumulado'])) ? $this->New_label['presupuesto_acumulado'] : "Presupuesto<br>Actualizado"; 
          if ($Cada_col == "presupuesto_acumulado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['facturacion_acumulada'])) ? $this->New_label['facturacion_acumulada'] : "Facturación"; 
          if ($Cada_col == "facturacion_acumulada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['reajuste_acumulado'])) ? $this->New_label['reajuste_acumulado'] : "Reajuste"; 
          if ($Cada_col == "reajuste_acumulado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['retencion_acumulada'])) ? $this->New_label['retencion_acumulada'] : "Retención"; 
          if ($Cada_col == "retencion_acumulada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['multa_acumulada'])) ? $this->New_label['multa_acumulada'] : "Multas"; 
          if ($Cada_col == "multa_acumulada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['avance'])) ? $this->New_label['avance'] : "Avance Periodo"; 
          if ($Cada_col == "avance" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['porcentaje_avance'])) ? $this->New_label['porcentaje_avance'] : "Avance Acumulado"; 
          if ($Cada_col == "porcentaje_avance" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['porcentaje_avance2'])) ? $this->New_label['porcentaje_avance2'] : "% Avance"; 
          if ($Cada_col == "porcentaje_avance2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ur_real'])) ? $this->New_label['ur_real'] : "UR Acumulado"; 
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
          $nmgp_select = "SELECT id_proyecto, fecha, `valor_uf_presupuesto` as sc_def_col_1, avance, ur_real, backlog_p, backlog_f, modificacion_contrato, id from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_proyecto, fecha, `valor_uf_presupuesto` as sc_def_col_1, avance, ur_real, backlog_p, backlog_f, modificacion_contrato, id from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['where_pesq'];
      $nmgp_select .= " group by id_proyecto, id"; 
      $nmgp_select_count .= " group by id_proyecto, id"; 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['order_grid'];
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
         $this->fecha = $rs->fields[1] ;  
         $this->valor_uf_presupuesto = $rs->fields[2] ;  
         $this->valor_uf_presupuesto = (string)$this->valor_uf_presupuesto;
         $this->avance = $rs->fields[3] ;  
         $this->avance =  str_replace(",", ".", $this->avance);
         $this->avance = (string)$this->avance;
         $this->ur_real = $rs->fields[4] ;  
         $this->ur_real =  str_replace(",", ".", $this->ur_real);
         $this->ur_real = (string)$this->ur_real;
         $this->backlog_p = $rs->fields[5] ;  
         $this->backlog_p =  str_replace(",", ".", $this->backlog_p);
         $this->backlog_p = (string)$this->backlog_p;
         $this->backlog_f = $rs->fields[6] ;  
         $this->backlog_f =  str_replace(",", ".", $this->backlog_f);
         $this->backlog_f = (string)$this->backlog_f;
         $this->modificacion_contrato = $rs->fields[7] ;  
         $this->modificacion_contrato =  str_replace(",", ".", $this->modificacion_contrato);
         $this->modificacion_contrato = (string)$this->modificacion_contrato;
         $this->id = $rs->fields[8] ;  
         $this->id = (string)$this->id;
         $this->Orig_id_proyecto = $this->id_proyecto;
         $this->Orig_fecha = $this->fecha;
         $this->Orig_valor_uf_presupuesto = $this->valor_uf_presupuesto;
         $this->Orig_avance = $this->avance;
         $this->Orig_ur_real = $this->ur_real;
         $this->Orig_backlog_p = $this->backlog_p;
         $this->Orig_backlog_f = $this->backlog_f;
         $this->Orig_modificacion_contrato = $this->modificacion_contrato;
         $this->Orig_id = $this->id;
         //----- lookup - id_proyecto
         $this->look_id_proyecto = $this->id_proyecto; 
         $this->Lookup->lookup_id_proyecto($this->look_id_proyecto, $this->id_proyecto) ; 
         $this->look_id_proyecto = ($this->look_id_proyecto == "&nbsp;") ? "" : $this->look_id_proyecto; 
         $this->sc_proc_grid = true; 
         //----- lookup - empresa
         $this->Lookup->lookup_empresa($this->empresa, $this->id_proyecto, $this->array_empresa); 
         $this->empresa = str_replace("<br>", " ", $this->empresa); 
         $this->empresa = ($this->empresa == "&nbsp;") ? "" : $this->empresa; 
         $_SESSION['scriptcase']['grid_prod_produccion_proyecto']['contr_erro'] = 'on';
 $porcentaje_produccion=0;
$valor_uf=0;

$check_sql = "SELECT 
  SUM(prod_produccion_proyecto.modificacion_contrato) AS presupuesto,SUM(prod_produccion_proyecto.facturacion) AS facturacion, SUM(prod_produccion_proyecto.reajuste) AS reajuste, SUM(prod_produccion_proyecto.retencion) AS retencion, SUM(prod_produccion_proyecto.multa) AS multa,SUM(prod_produccion_proyecto.avance) AS avance 
FROM
  prod_produccion_proyecto where prod_produccion_proyecto.fecha<='".$this->fecha ."' and
prod_produccion_proyecto.id_proyecto=".$this->id_proyecto  ;
	
		 
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
			$this->presupuesto_acumulado =$this->rs[0][0];
			$this->facturacion_acumulada =$this->rs[0][1];
			$this->reajuste_acumulado =$this->rs[0][2];
			$this->retencion_acumulada =$this->rs[0][3];
			$this->multa_acumulada =$this->rs[0][4];
			$this->porcentaje_avance =$this->rs[0][5];
		}
				else     
		{
			$this->presupuesto_acumulado =0;
			$this->facturacion_acumulada =0;
			$this->reajuste_acumulado =0;
			$this->retencion_acumulada =0;
			$this->multa_acumulada =0;
			$this->porcentaje_avance =0;
			
		}
$check_sql = "SELECT 
  prod_monedas.tipo_moneda
FROM
  proyectos
  INNER JOIN prod_monedas ON (proyectos.tipo_moneda = prod_monedas.id)
WHERE
  proyectos.id =".$this->id_proyecto  ;
	
		 
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
			$this->tipo_moneda =$this->rs[0][0];
			
		}
				else     
		{
			$this->tipo_moneda =1;
			
		}

	
if ($this->tipo_moneda <>"PESOS")
	{ 
	
	$apiUrl = 'https://mindicador.cl/api';
    $json = file_get_contents($apiUrl);
 
$dailyIndicators = json_decode($json);
	if ($this->tipo_moneda =="UF")
	{
$this->valor_uf_presupuesto =$dailyIndicators->uf->valor;
		}

	if ($this->tipo_moneda =="US DOLAR")
	{
$this->valor_uf_presupuesto =$dailyIndicators->dolar->valor;
		}	
	   
		$this->modificacion_contrato =$this->modificacion_contrato *$this->valor_uf_presupuesto ;
		$this->presupuesto_acumulado =$this->presupuesto_acumulado *$this->valor_uf_presupuesto ;
		$this->facturacion_acumulada =$this->facturacion_acumulada *$this->valor_uf_presupuesto ;
		$this->reajuste_acumulado =$this->reajuste_acumulado *$this->valor_uf_presupuesto ;
		$this->retencion_acumulada =$this->retencion_acumulada *$this->valor_uf_presupuesto ;
		$this->multa_acumulada =$this->multa_acumulada *$this->valor_uf_presupuesto ;
		$this->avance =$this->avance *$this->valor_uf_presupuesto ;
	    $this->porcentaje_avance =$this->porcentaje_avance *$this->valor_uf_presupuesto ;
		$this->ur_real =$this->ur_real *$this->valor_uf_presupuesto ;
		$this->backlog_p =$this->backlog_p *$this->valor_uf_presupuesto ;
		$this->backlog_f =$this->backlog_f *$this->valor_uf_presupuesto ;
	}
 		$porcentaje_produccion=$this->porcentaje_avance ;
		$porcentaje_acumulado=$this->presupuesto_acumulado ;

		if ($porcentaje_acumulado==0)
			{
			  $porcentaje_produccion=0;
			  $porcentaje_acumulado=1;
			
			}
		else
			{
				
			  $porcentaje_produccion=((100 * $porcentaje_produccion)/ $porcentaje_acumulado);
			}
		   $this->porcentaje_avance2 =$porcentaje_produccion;
$_SESSION['scriptcase']['grid_prod_produccion_proyecto']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- empresa
   function NM_export_empresa()
   {
         $this->empresa = NM_charset_to_utf8($this->empresa);
         $this->empresa = str_replace('<', '&lt;', $this->empresa);
         $this->empresa = str_replace('>', '&gt;', $this->empresa);
         $this->Texto_tag .= "<td>" . $this->empresa . "</td>\r\n";
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
         $this->fecha = NM_charset_to_utf8($this->fecha);
         $this->fecha = str_replace('<', '&lt;', $this->fecha);
         $this->fecha = str_replace('>', '&gt;', $this->fecha);
         $this->Texto_tag .= "<td>" . $this->fecha . "</td>\r\n";
   }
   //----- tipo_moneda
   function NM_export_tipo_moneda()
   {
         $this->tipo_moneda = html_entity_decode($this->tipo_moneda, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_moneda = strip_tags($this->tipo_moneda);
         $this->tipo_moneda = NM_charset_to_utf8($this->tipo_moneda);
         $this->tipo_moneda = str_replace('<', '&lt;', $this->tipo_moneda);
         $this->tipo_moneda = str_replace('>', '&gt;', $this->tipo_moneda);
         $this->Texto_tag .= "<td>" . $this->tipo_moneda . "</td>\r\n";
   }
   //----- valor_uf_presupuesto
   function NM_export_valor_uf_presupuesto()
   {
             nmgp_Form_Num_Val($this->valor_uf_presupuesto, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->valor_uf_presupuesto = NM_charset_to_utf8($this->valor_uf_presupuesto);
         $this->valor_uf_presupuesto = str_replace('<', '&lt;', $this->valor_uf_presupuesto);
         $this->valor_uf_presupuesto = str_replace('>', '&gt;', $this->valor_uf_presupuesto);
         $this->Texto_tag .= "<td>" . $this->valor_uf_presupuesto . "</td>\r\n";
   }
   //----- presupuesto_acumulado
   function NM_export_presupuesto_acumulado()
   {
             nmgp_Form_Num_Val($this->presupuesto_acumulado, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->presupuesto_acumulado = NM_charset_to_utf8($this->presupuesto_acumulado);
         $this->presupuesto_acumulado = str_replace('<', '&lt;', $this->presupuesto_acumulado);
         $this->presupuesto_acumulado = str_replace('>', '&gt;', $this->presupuesto_acumulado);
         $this->Texto_tag .= "<td>" . $this->presupuesto_acumulado . "</td>\r\n";
   }
   //----- facturacion_acumulada
   function NM_export_facturacion_acumulada()
   {
             nmgp_Form_Num_Val($this->facturacion_acumulada, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->facturacion_acumulada = NM_charset_to_utf8($this->facturacion_acumulada);
         $this->facturacion_acumulada = str_replace('<', '&lt;', $this->facturacion_acumulada);
         $this->facturacion_acumulada = str_replace('>', '&gt;', $this->facturacion_acumulada);
         $this->Texto_tag .= "<td>" . $this->facturacion_acumulada . "</td>\r\n";
   }
   //----- reajuste_acumulado
   function NM_export_reajuste_acumulado()
   {
             nmgp_Form_Num_Val($this->reajuste_acumulado, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->reajuste_acumulado = NM_charset_to_utf8($this->reajuste_acumulado);
         $this->reajuste_acumulado = str_replace('<', '&lt;', $this->reajuste_acumulado);
         $this->reajuste_acumulado = str_replace('>', '&gt;', $this->reajuste_acumulado);
         $this->Texto_tag .= "<td>" . $this->reajuste_acumulado . "</td>\r\n";
   }
   //----- retencion_acumulada
   function NM_export_retencion_acumulada()
   {
             nmgp_Form_Num_Val($this->retencion_acumulada, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->retencion_acumulada = NM_charset_to_utf8($this->retencion_acumulada);
         $this->retencion_acumulada = str_replace('<', '&lt;', $this->retencion_acumulada);
         $this->retencion_acumulada = str_replace('>', '&gt;', $this->retencion_acumulada);
         $this->Texto_tag .= "<td>" . $this->retencion_acumulada . "</td>\r\n";
   }
   //----- multa_acumulada
   function NM_export_multa_acumulada()
   {
             nmgp_Form_Num_Val($this->multa_acumulada, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->multa_acumulada = NM_charset_to_utf8($this->multa_acumulada);
         $this->multa_acumulada = str_replace('<', '&lt;', $this->multa_acumulada);
         $this->multa_acumulada = str_replace('>', '&gt;', $this->multa_acumulada);
         $this->Texto_tag .= "<td>" . $this->multa_acumulada . "</td>\r\n";
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
   //----- porcentaje_avance
   function NM_export_porcentaje_avance()
   {
             nmgp_Form_Num_Val($this->porcentaje_avance, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->porcentaje_avance = NM_charset_to_utf8($this->porcentaje_avance);
         $this->porcentaje_avance = str_replace('<', '&lt;', $this->porcentaje_avance);
         $this->porcentaje_avance = str_replace('>', '&gt;', $this->porcentaje_avance);
         $this->Texto_tag .= "<td>" . $this->porcentaje_avance . "</td>\r\n";
   }
   //----- porcentaje_avance2
   function NM_export_porcentaje_avance2()
   {
             nmgp_Form_Num_Val($this->porcentaje_avance2, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "1", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->porcentaje_avance2 = NM_charset_to_utf8($this->porcentaje_avance2);
         $this->porcentaje_avance2 = str_replace('<', '&lt;', $this->porcentaje_avance2);
         $this->porcentaje_avance2 = str_replace('>', '&gt;', $this->porcentaje_avance2);
         $this->Texto_tag .= "<td>" . $this->porcentaje_avance2 . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_prod_produccion_proyecto'][$path_doc_md5][1] = $this->Tit_doc;
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
<form name="Fdown" method="get" action="grid_prod_produccion_proyecto_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_prod_produccion_proyecto"> 
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
