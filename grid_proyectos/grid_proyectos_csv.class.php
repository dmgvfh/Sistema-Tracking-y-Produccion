<?php

class grid_proyectos_csv
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
                   nm_limpa_str_grid_proyectos($cadapar[1]);
                   nm_protect_num_grid_proyectos($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_proyectos']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($usr_group)) 
      {
          $_SESSION['usr_group'] = $usr_group;
          nm_limpa_str_grid_proyectos($_SESSION["usr_group"]);
      }
      if (isset($nom_proyecto)) 
      {
          $_SESSION['nom_proyecto'] = $nom_proyecto;
          nm_limpa_str_grid_proyectos($_SESSION["nom_proyecto"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Csv_password = "";
      $this->Arquivo   = "sc_csv";
      $this->Arquivo  .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip   = $this->Arquivo . "_grid_proyectos.zip";
      $this->Arquivo  .= "_grid_proyectos";
      $this->Arquivo  .= ".csv";
      $this->Tit_doc   = "grid_proyectos.csv";
      $this->Tit_zip   = "grid_proyectos.zip";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_proyectos']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_proyectos']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_proyectos']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->fecha_inicio = (isset($Busca_temp['fecha_inicio'])) ? $Busca_temp['fecha_inicio'] : ""; 
          $tmp_pos = (is_string($this->fecha_inicio)) ? strpos($this->fecha_inicio, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->fecha_inicio))
          {
              $this->fecha_inicio = substr($this->fecha_inicio, 0, $tmp_pos);
          }
          $this->fecha_inicio_2 = (isset($Busca_temp['fecha_inicio_input_2'])) ? $Busca_temp['fecha_inicio_input_2'] : ""; 
          $this->id = (isset($Busca_temp['id'])) ? $Busca_temp['id'] : ""; 
          $tmp_pos = (is_string($this->id)) ? strpos($this->id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->id))
          {
              $this->id = substr($this->id, 0, $tmp_pos);
          }
          $this->codigo = (isset($Busca_temp['codigo'])) ? $Busca_temp['codigo'] : ""; 
          $tmp_pos = (is_string($this->codigo)) ? strpos($this->codigo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->codigo))
          {
              $this->codigo = substr($this->codigo, 0, $tmp_pos);
          }
          $this->nombre_proyecto = (isset($Busca_temp['nombre_proyecto'])) ? $Busca_temp['nombre_proyecto'] : ""; 
          $tmp_pos = (is_string($this->nombre_proyecto)) ? strpos($this->nombre_proyecto, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nombre_proyecto))
          {
              $this->nombre_proyecto = substr($this->nombre_proyecto, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_proyectos']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_group'])) {$_SESSION['usr_group'] = "";}
if (!isset($this->sc_temp_usr_group)) {$this->sc_temp_usr_group = (isset($_SESSION['usr_group'])) ? $_SESSION['usr_group'] : "";}
 if ($this->sc_temp_usr_group <> "1")
	{
		if (empty($this->sc_where_atual ))
		{
			$this->nm_where_dinamico = " where habilitado=1";
		} 
		else 
		{
			$this->nm_where_dinamico = " and habilitado=1";
		}
	}
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['inicio']);
}

if (isset($this->sc_temp_usr_group)) {$_SESSION['usr_group'] = $this->sc_temp_usr_group;}
$_SESSION['scriptcase']['grid_proyectos']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_name'] .= ".csv";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_name']);
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
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['field_order'] as $Cada_col)
          { 
              $SC_Label = (isset($this->New_label['codigo'])) ? $this->New_label['codigo'] : "Código"; 
              if ($Cada_col == "codigo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['nombre_proyecto'])) ? $this->New_label['nombre_proyecto'] : "Nombre<br>Proyecto"; 
              if ($Cada_col == "nombre_proyecto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['id_empresa'])) ? $this->New_label['id_empresa'] : "Empresa"; 
              if ($Cada_col == "id_empresa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['id_cliente'])) ? $this->New_label['id_cliente'] : "Cliente"; 
              if ($Cada_col == "id_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['id_jefe_proyecto'])) ? $this->New_label['id_jefe_proyecto'] : "Jefe De Proyecto"; 
              if ($Cada_col == "id_jefe_proyecto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['id_direccion'])) ? $this->New_label['id_direccion'] : "Gerente De Proyecto"; 
              if ($Cada_col == "id_direccion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['id_portafolio'])) ? $this->New_label['id_portafolio'] : "Portafolio<br>(Centro Negocio)"; 
              if ($Cada_col == "id_portafolio" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['fecha_inicio'])) ? $this->New_label['fecha_inicio'] : "Fecha Inicio"; 
              if ($Cada_col == "fecha_inicio" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['fecha_termino'])) ? $this->New_label['fecha_termino'] : "Fecha Término"; 
              if ($Cada_col == "fecha_termino" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
              $SC_Label = (isset($this->New_label['duracion'])) ? $this->New_label['duracion'] : "Duración (Meses)"; 
              if ($Cada_col == "duracion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['presupuesto'])) ? $this->New_label['presupuesto'] : "Presupuesto<br>Base"; 
              if ($Cada_col == "presupuesto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['id_fase'])) ? $this->New_label['id_fase'] : "Fase"; 
              if ($Cada_col == "id_fase" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['id_estado'])) ? $this->New_label['id_estado'] : "Estado"; 
              if ($Cada_col == "id_estado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['habilitado'])) ? $this->New_label['habilitado'] : "Habilitado"; 
              if ($Cada_col == "habilitado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['afecta_iva'])) ? $this->New_label['afecta_iva'] : "Afecta a IVA"; 
              if ($Cada_col == "afecta_iva" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['observaciones'])) ? $this->New_label['observaciones'] : "Observaciones"; 
              if ($Cada_col == "observaciones" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['usuarios'])) ? $this->New_label['usuarios'] : "Usuarios Activos Asociados"; 
              if ($Cada_col == "usuarios" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT codigo, nombre_proyecto, id_empresa, id_cliente, id_jefe_proyecto, id_direccion, id_portafolio, fecha_inicio, fecha_termino, tipo_moneda, duracion, presupuesto, id_fase, id_estado, habilitado, afecta_iva, observaciones, id from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT codigo, nombre_proyecto, id_empresa, id_cliente, id_jefe_proyecto, id_direccion, id_portafolio, fecha_inicio, fecha_termino, tipo_moneda, duracion, presupuesto, id_fase, id_estado, habilitado, afecta_iva, observaciones, id from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['order_grid'];
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
         $this->codigo = $rs->fields[0] ;  
         $this->nombre_proyecto = $rs->fields[1] ;  
         $this->id_empresa = $rs->fields[2] ;  
         $this->id_empresa = (string)$this->id_empresa;
         $this->id_cliente = $rs->fields[3] ;  
         $this->id_cliente = (string)$this->id_cliente;
         $this->id_jefe_proyecto = $rs->fields[4] ;  
         $this->id_jefe_proyecto = (string)$this->id_jefe_proyecto;
         $this->id_direccion = $rs->fields[5] ;  
         $this->id_direccion = (string)$this->id_direccion;
         $this->id_portafolio = $rs->fields[6] ;  
         $this->id_portafolio = (string)$this->id_portafolio;
         $this->fecha_inicio = $rs->fields[7] ;  
         $this->fecha_termino = $rs->fields[8] ;  
         $this->tipo_moneda = $rs->fields[9] ;  
         $this->tipo_moneda = (string)$this->tipo_moneda;
         $this->duracion = $rs->fields[10] ;  
         $this->duracion = (string)$this->duracion;
         $this->presupuesto = $rs->fields[11] ;  
         $this->presupuesto = (string)$this->presupuesto;
         $this->id_fase = $rs->fields[12] ;  
         $this->id_fase = (string)$this->id_fase;
         $this->id_estado = $rs->fields[13] ;  
         $this->id_estado = (string)$this->id_estado;
         $this->habilitado = $rs->fields[14] ;  
         $this->habilitado = (string)$this->habilitado;
         $this->afecta_iva = $rs->fields[15] ;  
         $this->afecta_iva = (string)$this->afecta_iva;
         $this->observaciones = $rs->fields[16] ;  
         $this->id = $rs->fields[17] ;  
         $this->id = (string)$this->id;
         $this->Orig_codigo = $this->codigo;
         $this->Orig_nombre_proyecto = $this->nombre_proyecto;
         $this->Orig_id_empresa = $this->id_empresa;
         $this->Orig_id_cliente = $this->id_cliente;
         $this->Orig_id_jefe_proyecto = $this->id_jefe_proyecto;
         $this->Orig_id_direccion = $this->id_direccion;
         $this->Orig_id_portafolio = $this->id_portafolio;
         $this->Orig_fecha_inicio = $this->fecha_inicio;
         $this->Orig_fecha_termino = $this->fecha_termino;
         $this->Orig_tipo_moneda = $this->tipo_moneda;
         $this->Orig_duracion = $this->duracion;
         $this->Orig_presupuesto = $this->presupuesto;
         $this->Orig_id_fase = $this->id_fase;
         $this->Orig_id_estado = $this->id_estado;
         $this->Orig_habilitado = $this->habilitado;
         $this->Orig_afecta_iva = $this->afecta_iva;
         $this->Orig_observaciones = $this->observaciones;
         $this->Orig_id = $this->id;
         //----- lookup - id_empresa
         $this->look_id_empresa = $this->id_empresa; 
         $this->Lookup->lookup_id_empresa($this->look_id_empresa, $this->id_empresa) ; 
         $this->look_id_empresa = ($this->look_id_empresa == "&nbsp;") ? "" : $this->look_id_empresa; 
         //----- lookup - id_cliente
         $this->look_id_cliente = $this->id_cliente; 
         $this->Lookup->lookup_id_cliente($this->look_id_cliente, $this->id_cliente) ; 
         $this->look_id_cliente = ($this->look_id_cliente == "&nbsp;") ? "" : $this->look_id_cliente; 
         //----- lookup - id_jefe_proyecto
         $this->look_id_jefe_proyecto = $this->id_jefe_proyecto; 
         $this->Lookup->lookup_id_jefe_proyecto($this->look_id_jefe_proyecto, $this->id_jefe_proyecto) ; 
         $this->look_id_jefe_proyecto = ($this->look_id_jefe_proyecto == "&nbsp;") ? "" : $this->look_id_jefe_proyecto; 
         //----- lookup - id_direccion
         $this->look_id_direccion = $this->id_direccion; 
         $this->Lookup->lookup_id_direccion($this->look_id_direccion, $this->id_direccion) ; 
         $this->look_id_direccion = ($this->look_id_direccion == "&nbsp;") ? "" : $this->look_id_direccion; 
         //----- lookup - id_portafolio
         $this->look_id_portafolio = $this->id_portafolio; 
         $this->Lookup->lookup_id_portafolio($this->look_id_portafolio, $this->id_portafolio) ; 
         $this->look_id_portafolio = ($this->look_id_portafolio == "&nbsp;") ? "" : $this->look_id_portafolio; 
         //----- lookup - tipo_moneda
         $this->look_tipo_moneda = $this->tipo_moneda; 
         $this->Lookup->lookup_tipo_moneda($this->look_tipo_moneda, $this->tipo_moneda) ; 
         $this->look_tipo_moneda = ($this->look_tipo_moneda == "&nbsp;") ? "" : $this->look_tipo_moneda; 
         //----- lookup - id_fase
         $this->look_id_fase = $this->id_fase; 
         $this->Lookup->lookup_id_fase($this->look_id_fase, $this->id_fase) ; 
         $this->look_id_fase = ($this->look_id_fase == "&nbsp;") ? "" : $this->look_id_fase; 
         //----- lookup - id_estado
         $this->look_id_estado = $this->id_estado; 
         $this->Lookup->lookup_id_estado($this->look_id_estado, $this->id_estado) ; 
         $this->look_id_estado = ($this->look_id_estado == "&nbsp;") ? "" : $this->look_id_estado; 
         //----- lookup - habilitado
         $this->look_habilitado = $this->habilitado; 
         $this->Lookup->lookup_habilitado($this->look_habilitado); 
         $this->look_habilitado = ($this->look_habilitado == "&nbsp;") ? "" : $this->look_habilitado; 
         //----- lookup - afecta_iva
         $this->look_afecta_iva = $this->afecta_iva; 
         $this->Lookup->lookup_afecta_iva($this->look_afecta_iva); 
         $this->look_afecta_iva = ($this->look_afecta_iva == "&nbsp;") ? "" : $this->look_afecta_iva; 
         $this->sc_proc_grid = true; 
         //----- lookup - usuarios
         $this->Lookup->lookup_usuarios($this->usuarios, $this->id, $this->array_usuarios); 
         $this->usuarios = str_replace("<br>", " ", $this->usuarios); 
         $this->usuarios = ($this->usuarios == "&nbsp;") ? "" : $this->usuarios; 
         $_SESSION['scriptcase']['grid_proyectos']['contr_erro'] = 'on';
 $check_sql  = "SELECT 
  SUM(prod_presupuesto.monto_uf) AS FIELD_1
FROM
  prod_presupuesto
WHERE
  prod_presupuesto.id_proyecto ='".$this->id ."' and  prod_presupuesto.id_partida_periodo=(SELECT min(prod_produccion_proyecto.id) FROM  prod_produccion_proyecto WHERE prod_produccion_proyecto.id_proyecto =".$this->id .")";

 
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
    $this->monto_presupuesto  = $this->rs[0][0];
    
}
		else     
{
		   $this->monto_presupuesto =0;
   
}
$_SESSION['scriptcase']['grid_proyectos']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- codigo
   function NM_export_codigo()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->codigo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- nombre_proyecto
   function NM_export_nombre_proyecto()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->nombre_proyecto);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_empresa
   function NM_export_id_empresa()
   {
         nmgp_Form_Num_Val($this->look_id_empresa, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_id_empresa);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_cliente
   function NM_export_id_cliente()
   {
         nmgp_Form_Num_Val($this->look_id_cliente, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_id_cliente);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_jefe_proyecto
   function NM_export_id_jefe_proyecto()
   {
         nmgp_Form_Num_Val($this->look_id_jefe_proyecto, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_id_jefe_proyecto);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_direccion
   function NM_export_id_direccion()
   {
         nmgp_Form_Num_Val($this->look_id_direccion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_id_direccion);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_portafolio
   function NM_export_id_portafolio()
   {
         nmgp_Form_Num_Val($this->look_id_portafolio, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_id_portafolio);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_inicio
   function NM_export_fecha_inicio()
   {
             $conteudo_x =  $this->fecha_inicio;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->fecha_inicio, "YYYY-MM-DD  ");
                 $this->fecha_inicio = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->fecha_inicio);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_termino
   function NM_export_fecha_termino()
   {
             $conteudo_x =  $this->fecha_termino;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->fecha_termino, "YYYY-MM-DD  ");
                 $this->fecha_termino = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->fecha_termino);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tipo_moneda
   function NM_export_tipo_moneda()
   {
         nmgp_Form_Num_Val($this->look_tipo_moneda, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_tipo_moneda);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- duracion
   function NM_export_duracion()
   {
             nmgp_Form_Num_Val($this->duracion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->duracion);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- presupuesto
   function NM_export_presupuesto()
   {
             nmgp_Form_Num_Val($this->presupuesto, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->presupuesto);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_fase
   function NM_export_id_fase()
   {
         nmgp_Form_Num_Val($this->look_id_fase, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_id_fase);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_estado
   function NM_export_id_estado()
   {
         nmgp_Form_Num_Val($this->look_id_estado, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_id_estado);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- habilitado
   function NM_export_habilitado()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_habilitado);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- afecta_iva
   function NM_export_afecta_iva()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_afecta_iva);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- observaciones
   function NM_export_observaciones()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->observaciones);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- usuarios
   function NM_export_usuarios()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->usuarios);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Proyectos Corporativos :: CSV</TITLE>
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
<form name="Fdown" method="get" action="grid_proyectos_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_proyectos"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_proyectos']['csv_return']); ?>"> 
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
