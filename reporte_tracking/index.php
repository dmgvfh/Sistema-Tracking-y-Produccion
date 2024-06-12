<?php
   include_once('reporte_tracking_session.php');
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 0);
   @session_start() ;
   $_SESSION['scriptcase']['reporte_tracking']['glo_nm_perfil']          = "conn_example";
   $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_conf']       = "";
   $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_cache']      = "";
   $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_doc']        = "";
    //check publication with the prod
    $NM_dir_atual = getcwd();
    if (empty($NM_dir_atual))
    {
        $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
        $str_path_sys          = str_replace("\\", '/', $str_path_sys);
    }
    else
    {
        $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
        $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
    }
    $str_path_apl_url = $_SERVER['PHP_SELF'];
    $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
    $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
    $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
    $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
    $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
    //check prod
    if(empty($_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check img
    if(empty($_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imagens']))
    {
            /*check img*/$_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //check cache
    if(empty($_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_cache']))
    {
            /*check tmp*/$_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
    }
    //check doc
    if(empty($_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_doc']))
    {
            /*check doc*/$_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
    }
    //end check publication with the prod
//
class reporte_tracking_ini
{
   var $nm_cod_apl;
   var $nm_nome_apl;
   var $nm_seguranca;
   var $nm_grupo;
   var $nm_autor;
   var $nm_versao_sc;
   var $nm_tp_lic_sc;
   var $nm_dt_criacao;
   var $nm_hr_criacao;
   var $nm_autor_alt;
   var $nm_dt_ult_alt;
   var $nm_hr_ult_alt;
   var $nm_timestamp;
   var $nm_app_version;
   var $cor_link_dados;
   var $root;
   var $server;
   var $java_protocol;
   var $server_pdf;
   var $Arr_result;
   var $sc_protocolo;
   var $path_prod;
   var $path_link;
   var $path_aplicacao;
   var $path_embutida;
   var $path_botoes;
   var $path_img_global;
   var $path_img_modelo;
   var $path_icones;
   var $path_imagens;
   var $path_imag_cab;
   var $path_imag_temp;
   var $path_libs;
   var $path_doc;
   var $str_lang;
   var $str_conf_reg;
   var $str_schema_all;
   var $Str_btn_grid;
   var $str_google_fonts;
   var $str_schema_filter;
   var $Str_btn_filter;
   var $path_cep;
   var $path_secure;
   var $path_js;
   var $path_help;
   var $path_adodb;
   var $path_grafico;
   var $path_atual;
   var $Gd_missing;
   var $sc_site_ssl;
   var $link_form_appointments;
   var $nm_cont_lin;
   var $nm_limite_lin;
   var $nm_limite_lin_prt;
   var $nm_limite_lin_res;
   var $nm_limite_lin_res_prt;
   var $Qtd_reg_ajax_grid;
   var $nm_falta_var;
   var $nm_falta_var_db;
   var $nm_tpbanco;
   var $nm_servidor;
   var $nm_usuario;
   var $nm_senha;
   var $nm_database_encoding;
   var $nm_arr_db_extra_args = array();
   var $nm_con_db2 = array();
   var $nm_con_persistente;
   var $nm_con_use_schema;
   var $nm_tabela;
   var $nm_ger_css_emb;
   var $nm_col_dinamica   = array();
   var $nm_order_dinamico = array();
   var $nm_hidden_blocos  = array();
   var $sc_tem_trans_banco;
   var $nm_bases_all;
   var $nm_bases_mysql;
   var $nm_bases_sqlite;
   var $sc_page;
   var $sc_lig_md5 = array();
   var $sc_lig_target = array();
   var $sc_export_ajax = false;
   var $sc_export_ajax_img = false;
   var $force_db_utf8 = true;
//
   function init($Tp_init = "")
   {
       global
             $nm_url_saida, $nm_apl_dependente, $script_case_init, $nmgp_opcao;

      if (!function_exists("sc_check_mobile"))
      {
          include_once("../_lib/lib/php/nm_check_mobile.php");
      }
          include_once("../_lib/lib/php/fix.php");
      $_SESSION['scriptcase']['proc_mobile'] = sc_check_mobile();
        if (isset($_GET['_sc_force_mobile'])) {
            $_SESSION['scriptcase']['force_mobile'] = 'Y' == $_GET['_sc_force_mobile'];
        }
        if (isset($_SESSION['scriptcase']['force_mobile'])) {
            $_SESSION['scriptcase']['proc_mobile'] = $_SESSION['scriptcase']['force_mobile'];
        }
      @ini_set('magic_quotes_runtime', 0);
      $this->sc_page = $script_case_init;
      $_SESSION['scriptcase']['sc_num_page'] = $script_case_init;
      $_SESSION['scriptcase']['sc_cnt_sql']  = 0;
      $this->sc_charset['UTF-8'] = 'utf-8';
      $this->sc_charset['ISO-2022-JP'] = 'iso-2022-jp';
      $this->sc_charset['ISO-2022-KR'] = 'iso-2022-kr';
      $this->sc_charset['ISO-8859-1'] = 'iso-8859-1';
      $this->sc_charset['ISO-8859-2'] = 'iso-8859-2';
      $this->sc_charset['ISO-8859-3'] = 'iso-8859-3';
      $this->sc_charset['ISO-8859-4'] = 'iso-8859-4';
      $this->sc_charset['ISO-8859-5'] = 'iso-8859-5';
      $this->sc_charset['ISO-8859-6'] = 'iso-8859-6';
      $this->sc_charset['ISO-8859-7'] = 'iso-8859-7';
      $this->sc_charset['ISO-8859-8'] = 'iso-8859-8';
      $this->sc_charset['ISO-8859-8-I'] = 'iso-8859-8-i';
      $this->sc_charset['ISO-8859-9'] = 'iso-8859-9';
      $this->sc_charset['ISO-8859-10'] = 'iso-8859-10';
      $this->sc_charset['ISO-8859-13'] = 'iso-8859-13';
      $this->sc_charset['ISO-8859-14'] = 'iso-8859-14';
      $this->sc_charset['ISO-8859-15'] = 'iso-8859-15';
      $this->sc_charset['WINDOWS-1250'] = 'windows-1250';
      $this->sc_charset['WINDOWS-1251'] = 'windows-1251';
      $this->sc_charset['WINDOWS-1252'] = 'windows-1252';
      $this->sc_charset['TIS-620'] = 'tis-620';
      $this->sc_charset['WINDOWS-1253'] = 'windows-1253';
      $this->sc_charset['WINDOWS-1254'] = 'windows-1254';
      $this->sc_charset['WINDOWS-1255'] = 'windows-1255';
      $this->sc_charset['WINDOWS-1256'] = 'windows-1256';
      $this->sc_charset['WINDOWS-1257'] = 'windows-1257';
      $this->sc_charset['KOI8-R'] = 'koi8-r';
      $this->sc_charset['BIG-5'] = 'big5';
      $this->sc_charset['EUC-CN'] = 'EUC-CN';
      $this->sc_charset['GB18030'] = 'GB18030';
      $this->sc_charset['GB2312'] = 'gb2312';
      $this->sc_charset['EUC-JP'] = 'euc-jp';
      $this->sc_charset['SJIS'] = 'shift-jis';
      $this->sc_charset['EUC-KR'] = 'euc-kr';
      $_SESSION['scriptcase']['charset_entities']['UTF-8'] = 'UTF-8';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-1'] = 'ISO-8859-1';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-5'] = 'ISO-8859-5';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-15'] = 'ISO-8859-15';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1251'] = 'cp1251';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1252'] = 'cp1252';
      $_SESSION['scriptcase']['charset_entities']['BIG-5'] = 'BIG5';
      $_SESSION['scriptcase']['charset_entities']['EUC-CN'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['GB2312'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['SJIS'] = 'Shift_JIS';
      $_SESSION['scriptcase']['charset_entities']['EUC-JP'] = 'EUC-JP';
      $_SESSION['scriptcase']['charset_entities']['KOI8-R'] = 'KOI8-R';
      $_SESSION['scriptcase']['trial_version'] = 'N';
      $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['decimal_db'] = "."; 
      $this->nm_cod_apl      = "reporte_tracking"; 
      $this->nm_nome_apl     = "Usado"; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "carga_horas"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "admin"; 
      $this->nm_script_by    = "netmake";
      $this->nm_script_type  = "PHP";
      $this->nm_versao_sc    = "v9"; 
      $this->nm_tp_lic_sc    = "pe_mysql_bronze"; 
      $this->nm_dt_criacao   = "20150909"; 
      $this->nm_hr_criacao   = "084601"; 
      $this->nm_autor_alt    = "admin"; 
      $this->nm_dt_ult_alt   = "20240606"; 
      $this->nm_hr_ult_alt   = "103104"; 
      $this->Apl_paginacao   = "PARCIAL"; 
      $temp_bug_list         = explode(" ", microtime()); 
      list($NM_usec, $NM_sec) = $temp_bug_list; 
      $this->nm_timestamp    = (float) $NM_sec; 
      $this->nm_app_version  = "1.0.0";
      $this->nm_tp_variance  = "P";
// 
// 
      $NM_dir_atual = getcwd();
      if (empty($NM_dir_atual))
      {
          $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
          $str_path_sys          = str_replace("\\", '/', $str_path_sys);
      }
      else
      {
          $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
          $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
      }
      $this->sc_site_ssl     = $this->appIsSsl();
      $this->sc_protocolo    = $this->sc_site_ssl ? 'https://' : 'http://';
      $this->sc_protocolo    = "";
      $this->path_prod       = $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_prod'];
      $this->path_conf       = $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_conf'];
      $this->path_imagens    = $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imag_temp'];
      $this->path_cache  = $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_doc'];
      if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
      {
          $_SESSION['scriptcase']['str_lang'] = "es";
      }
      if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
      {
          $_SESSION['scriptcase']['str_conf_reg'] = "es_es";
      }
      $this->str_lang        = $_SESSION['scriptcase']['str_lang'];
      $this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
      if (!isset($_SESSION['scriptcase']['reporte_tracking']['save_session']['save_grid_state_session']))
      { 
          $_SESSION['scriptcase']['reporte_tracking']['save_session']['save_grid_state_session'] = false;
          $_SESSION['scriptcase']['reporte_tracking']['save_session']['data'] = '';
      } 
      $this->str_schema_all    = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "tracking/tracking";
      $this->str_schema_filter = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "tracking/tracking";
      if (isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['sub_cons_schema_all']))
      { 
         $this->str_schema_all    = $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['sub_cons_schema_all'];
         $this->str_schema_filter = $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['sub_cons_schema_filter'];
      } 
      $_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
      $_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
      $this->server          = (!isset($_SERVER['HTTP_HOST'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
      if (!isset($_SERVER['HTTP_HOST']) && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 && !$this->sc_site_ssl )
      {
          $this->server         .= ":" . $_SERVER['SERVER_PORT'];
      }
      $this->java_protocol   = ($this->sc_site_ssl) ? 'https://' : 'http://';
      $this->server_pdf      = $this->java_protocol . $this->server;
      $this->server          = "";
      $str_path_web          = $_SERVER['PHP_SELF'];
      $str_path_web          = str_replace("\\", '/', $str_path_web);
      $str_path_web          = str_replace('//', '/', $str_path_web);
      $this->root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
      $this->path_aplicacao  = substr($str_path_sys, 0, strrpos($str_path_sys, '/'));
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/reporte_tracking';
      $this->path_embutida   = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/') + 1);
      $this->path_aplicacao .= '/';
      $this->path_link       = substr($str_path_web, 0, strrpos($str_path_web, '/'));
      $this->path_link       = substr($this->path_link, 0, strrpos($this->path_link, '/')) . '/';
      $this->path_botoes     = $this->path_link . "_lib/img";
      $this->path_img_global = $this->path_link . "_lib/img";
      $this->path_img_modelo = $this->path_link . "_lib/img";
      $this->path_icones     = $this->path_link . "_lib/img";
      $this->path_imag_cab   = $this->path_link . "_lib/img";
      $this->path_help       = $this->path_link . "_lib/webhelp/";
      $this->path_font       = $this->root . $this->path_link . "_lib/font/";
      $this->path_btn        = $this->root . $this->path_link . "_lib/buttons/";
      $this->path_css        = $this->root . $this->path_link . "_lib/css/";
      $this->path_lib_php    = $this->root . $this->path_link . "_lib/lib/php";
      $this->path_lib_js     = $this->root . $this->path_link . "_lib/lib/js";
      $pos_path = strrpos($this->path_prod, "/");
      $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['path_grid_sv'] = $this->root . substr($this->path_prod, 0, $pos_path) . "/conf/grid_sv/";
      $this->path_lang       = "../_lib/lang/";
      $this->path_lang_js    = "../_lib/js/";
      $this->path_chart_theme = $this->root . $this->path_link . "_lib/chart/";
      $this->path_cep        = $this->path_prod . "/cep";
      $this->path_cor        = $this->path_prod . "/cor";
      $this->path_js         = $this->path_prod . "/lib/js";
      $this->path_libs       = $this->root . $this->path_prod . "/lib/php";
      $this->path_third      = $this->root . $this->path_prod . "/third";
      $this->path_secure     = $this->root . $this->path_prod . "/secure";
      $this->path_adodb      = $this->root . $this->path_prod . "/third/adodb";
      $_SESSION['scriptcase']['dir_temp'] = $this->root . $this->path_imag_temp;
      $this->Cmp_Sql_Time     = array('appointment_start_time','appointment_end_time');
      if (isset($_SESSION['scriptcase']['reporte_tracking']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['reporte_tracking']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['reporte_tracking']['actual_lang']) || $_SESSION['scriptcase']['reporte_tracking']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['reporte_tracking']['actual_lang'] = $this->str_lang;
          setcookie('sc_actual_lang_carga_horas',$this->str_lang,'0','/');
      }
      if (!isset($_SESSION['scriptcase']['fusioncharts_new']))
      {
          $_SESSION['scriptcase']['fusioncharts_new'] = @is_dir($this->path_third . '/oem_fs');
      }
      if (!isset($_SESSION['scriptcase']['phantomjs_charts']))
      {
          $_SESSION['scriptcase']['phantomjs_charts'] = @is_dir($this->path_third . '/phantomjs');
      }
      if (isset($_SESSION['scriptcase']['phantomjs_charts']))
      {
          $aTmpOS = $this->getRunningOS();
          $_SESSION['scriptcase']['phantomjs_charts'] = @is_dir($this->path_third . '/phantomjs/' . $aTmpOS['os']);
      }
      if (!class_exists('Services_JSON'))
      {
          include_once("reporte_tracking_json.php");
      }
      $this->SC_Link_View = (isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_Link_View'])) ? $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_Link_View'] : false;
      if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
      {
          if ($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['embutida'])
          {
              $this->SC_Link_View = true;
              $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_Link_View'] = true;
          }
      }
      if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_save_ancor")
      {
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['ancor_save'] = $_POST['ancor_save'];
          $oJson = new Services_JSON();
          if ($_SESSION['scriptcase']['sem_session']) {
              unset($_SESSION['sc_session']);
          }
          exit;
      }
      if (isset($_SESSION['scriptcase']['user_logout']))
      {
          foreach ($_SESSION['scriptcase']['user_logout'] as $ind => $parms)
          {
              if (isset($_SESSION[$parms['V']]) && $_SESSION[$parms['V']] == $parms['U'])
              {
                  unset($_SESSION['scriptcase']['user_logout'][$ind]);
                  $nm_apl_dest = $parms['R'];
                  $dir = explode("/", $nm_apl_dest);
                  if (count($dir) == 1)
                  {
                      $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
                      $nm_apl_dest = $this->path_link . SC_dir_app_name($nm_apl_dest) . "/";
                  }
                  if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_event" || $_POST['nmgp_opcao'] == "ajax_navigate"))
                  {
                      $this->Arr_result = array();
                      $this->Arr_result['redirInfo']['action']              = $nm_apl_dest;
                      $this->Arr_result['redirInfo']['target']              = $parms['T'];
                      $this->Arr_result['redirInfo']['metodo']              = "post";
                      $this->Arr_result['redirInfo']['script_case_init']    = $this->sc_page;
                      $oJson = new Services_JSON();
                      echo $oJson->encode($this->Arr_result);
                      exit;
                  }
?>
                  <html>
                  <body>
                  <form name="FRedirect" method="POST" action="<?php echo $nm_apl_dest; ?>" target="<?php echo $parms['T']; ?>">
                  </form>
                  <script>
                   document.FRedirect.submit();
                  </script>
                  </body>
                  </html>
<?php
                  exit;
              }
          }
      }
      global $under_dashboard, $dashboard_app, $own_widget, $parent_widget, $compact_mode, $remove_margin, $remove_border;
      if (!isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['remove_border']   = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      $Tmp_apl_lig = "form_appointments";
      if (is_file($this->root . $this->path_link . "_lib/friendly_url/form_appointments_ini.txt"))
      {
          $Friendly = file($this->root . $this->path_link . "_lib/friendly_url/form_appointments_ini.txt");
          if (isset($Friendly[0]) && !empty($Friendly[0]))
          {
              $Tmp_apl_lig = trim($Friendly[0]);
          }
      }
      if (is_file($this->root . $this->path_link . $Tmp_apl_lig . "/form_appointments_ini.txt"))
      {
          $L_md5 = file($this->root . $this->path_link . $Tmp_apl_lig . "/form_appointments_ini.txt");
          if (isset($L_md5[6]) && trim($L_md5[6]) == "LigMd5")
          {
              $this->sc_lig_md5["form_appointments"] = 'S';
          }
      }
      $this->sc_lig_target["A_@scinf_"] = 'modal';
      $this->sc_lig_target["A_@scinf__@scinf_form_appointments"] = 'modal';
      if ($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["reporte_tracking"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["reporte_tracking"] as $sTmpTargetLink => $sTmpTargetWidget)
              {
                  if (isset($this->sc_lig_target[$sTmpTargetLink]))
                  {
                      $this->sc_lig_target[$sTmpTargetLink] = $sTmpTargetWidget;
                  }
              }
          }
      }
        global $link_compact_mode, $link_remove_margin, $link_remove_border;
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['link_info']['compact_mode'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['link_info']['remove_border'] = true;
        }

      $this->link_form_appointments =  $this->sc_protocolo . $this->server . $this->path_link . "" . SC_dir_app_name('form_appointments') . "/" ; 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['responsive_chart']))
      {
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['responsive_chart'] = array(
              'enabled' => false,
              'active'  => false,
          );
      }
      if ($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['responsive_chart']['enabled'])
      {
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['responsive_chart']['active'] = true;
      }
      elseif ($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['dashboard_info']['maximized'])
      {
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['responsive_chart']['active'] = true;
      }
      else
      {
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['responsive_chart']['active'] = false;
      }
      if ($Tp_init == "Path_sub")
      {
          return;
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1);
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao']);
      }
      include($this->path_lang . $this->str_lang . ".lang.php");
      include($this->path_lang . "config_region.php");
      include($this->path_lang . "lang_config_region.php");
      asort($this->Nm_lang_conf_region);
      $_SESSION['scriptcase']['charset']  = "UTF-8";
      ini_set('default_charset', $_SESSION['scriptcase']['charset']);
      $_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
      if (!function_exists("mb_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtmb'] . "</font></div>";exit;
      } 
      elseif (!function_exists("sc_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtsc'] . "</font></div>";exit;
      } 
      foreach ($this->Nm_lang_conf_region as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang_conf_region[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      foreach ($this->Nm_lang as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
         {
             $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
             $this->Nm_lang[$ind] = $dados;
         }
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      $_SESSION['sc_session']['SC_download_violation'] = $this->Nm_lang['lang_errm_fnfd'];
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir']))
      {
          unset($_SESSION['sc_session']['SC_parm_violation']);
          echo "<html>";
          echo "<body>";
          echo "<table align=\"center\" width=\"50%\" border=1 height=\"50px\">";
          echo "<tr>";
          echo "   <td align=\"center\">";
          echo "       <b><font size=4>" . $this->Nm_lang['lang_errm_ajax_data'] . "</font>";
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          echo "</body>";
          echo "</html>";
          exit;
      }
      if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
      {
          $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
      }
      $PHP_ver = str_replace(".", "", phpversion()); 
      if (substr($PHP_ver, 0, 3) < 434)
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_phpv'] . "</font></div>";exit;
      } 
      if (file_exists($this->path_libs . "/ver.dat"))
      {
          $SC_ver = file($this->path_libs . "/ver.dat"); 
          $SC_ver = str_replace(".", "", $SC_ver[0]); 
          if (substr($SC_ver, 0, 5) < 40015)
          {
              echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_incp'] . "</font></div>";exit;
          } 
      } 
      $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['path_doc'] = $this->path_doc; 
      $_SESSION['scriptcase']['nm_path_prod'] = $this->root . $this->path_prod . "/"; 
      if (empty($this->path_imag_cab))
      {
          $this->path_imag_cab = $this->path_img_global;
      }
      if (!is_dir($this->root . $this->path_prod))
      {
          echo "<style type=\"text/css\">";
          echo ".scButton_default { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; line-height:31px; height:34px; padding:0 12px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_default:hover { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:hover img, .scButton_group:hover img{filter: brightness(2);}.scButton_default:hover{; box-shadow:inset 0 -1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; line-height:31px; height:34px; padding:0 12px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_default:active { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:active img{filter: brightness(2)}.scButton_default:active{; box-shadow:inset 0 1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; line-height:31px; height:34px; padding:0 12px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_default_disabled { font-family:Tahoma, Arial, sans-serif; color:#7d7d7d; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; line-height:31px; height:34px; padding:0 12px; cursor:default; box-sizing:border-box;  }";
          echo ".scButton_default_selected { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_default_list { background-color:#ffffff; filter: alpha(opacity=100); opacity:1; padding:6px 52px 6px 15px; cursor:pointer; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858;  }";
          echo ".scButton_default_list:hover { background-color:#EFF2F7; filter: alpha(opacity=100); opacity:1; padding:6px 52px 6px 15px; cursor:pointer; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858;  }";
          echo ".scButton_default_list_disabled { background-color:#ffffff; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858; padding:6px 52px 6px 15px; filter: alpha(opacity=45); opacity:0.45; cursor:default;  }";
          echo ".scButton_default_list_selected { background-color:#ffffff; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858; padding:6px 52px 6px 15px; cursor:pointer; filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_default_list:active { background-color:#EFF2F7; filter: alpha(opacity=100); opacity:1; padding:6px 52px 6px 15px; cursor:pointer; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858;  }";
          echo ".scButton_group { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:0px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:7.8px 15px;margin:0px -5px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box; img_filter:grayscale(100%);  }";
          echo ".scButton_group:hover { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-shadow:;transition: all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden;box-sizing: border-box; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:hover img, .scButton_group:hover img{filter: brightness(2);}.scButton_group:hover{; box-shadow:inset 0 -1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; padding:7.8px 15px;margin:0px -5px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_group:active { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_group:active img{filter: brightness(2)}.scButton_group:active{; box-shadow:inset 0 1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; padding:7.8px 15px;margin:0px -5px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_group_disabled { font-family:Tahoma, Arial, sans-serif; color:#7d7d7d; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:0px; background-color:#FFFFFF; filter: alpha(opacity=40); opacity:0.4; padding:7.8px 15px;margin:0px -5px; cursor:default; box-sizing:border-box;  }";
          echo ".scButton_group_selected { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:0px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:7.8px 15px;margin:0px -5px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box; img_filter:none;  }";
          echo ".scButton_small { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_small:hover { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:hover img, .scButton_groupfirst:hover img, .scButton_group:hover img{filter: brightness(2);}.scButton_small:hover{; box-shadow:inset 0 -1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_small:active { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:active img{filter: brightness(2)}.scButton_small:active{; box-shadow:inset 0 1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_small_disabled { font-family:Tahoma, Arial, sans-serif; color:#7d7d7d; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:default; box-sizing:border-box;  }";
          echo ".scButton_small_selected { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_small_list { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_small_list:hover { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sweetalertok_list { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sweetalertok_list:hover { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sweetalertok { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#3085d6; border-style:solid; border-radius:4.25px; background-color:#3085d6; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertok:hover { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#2b77c0; border-style:solid; border-radius:4.25px; background-color:#2b77c0; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertok:active { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#266aab; border-style:solid; border-radius:4.25px; background-color:#266aab; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertok_disabled { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#3085d6; border-style:solid; border-radius:4.25px; background-color:#3085d6; box-shadow:none; filter: alpha(opacity=44); opacity:0.44; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertok_selected { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#266aab; border-style:solid; border-radius:4.25px; background-color:#266aab; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#aaa; border-style:solid; border-radius:4.25px; background-color:#aaa; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel:hover { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#999; border-style:solid; border-radius:4.25px; background-color:#999; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel:active { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#3085d6; border-style:solid; border-radius:4.25px; background-color:#3085d6; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel_disabled { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#aaa; border-style:solid; border-radius:4.25px; background-color:#aaa; box-shadow:none; filter: alpha(opacity=44); opacity:0.44; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel_selected { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#7a7a7a; border-style:solid; border-radius:4.25px; background-color:#7a7a7a; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel_list { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sweetalertcancel_list:hover { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sc_image { color:#8592a6; font-size:15px; text-decoration:none; border-style:none; filter: alpha(opacity=100); opacity:1; padding:5px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sc_image:hover { color:#8592a6; font-size:15px; text-decoration:none; border-style:none; filter: alpha(opacity=100); opacity:1; padding:5px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sc_image:active { color:#8592a6; font-size:15px; text-decoration:none; filter: alpha(opacity=100); opacity:1; padding:5px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sc_image_disabled { color:#8592a6; font-size:15px; text-decoration:none; border-style:none; filter: alpha(opacity=44); opacity:0.44; padding:5px; cursor:default; transition:all 0.2s;  }";
          echo ".scButton_sc_image_selected { color:#8592a6; font-size:15px; text-decoration:none; border-style:none; filter: alpha(opacity=100); opacity:1; padding:5px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scLink_default { text-decoration: underline; font-size: 13px; color: #1a0dab;  }";
          echo ".scLink_default:visited { text-decoration: underline; font-size: 13px; color: #660099;  }";
          echo ".scLink_default:active { text-decoration: underline; font-size: 13px; color: #1a0dab;  }";
          echo ".scLink_default:hover { text-decoration: underline; font-size: 13px; color: #1a0dab;  }";
          echo "</style>";
          echo "<table width=\"80%\" border=\"1\" height=\"117\">";
          echo "<tr>";
          echo "   <td bgcolor=\"\">";
          echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_cmlb_nfnd'] . "</font>";
          echo "  " . $this->root . $this->path_prod;
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_back'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_back_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
              else 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_exit'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_exit_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
          } 
          exit ;
      }

      $this->nm_ger_css_emb = true;
      $this->Control_Css    = "coo";
      $this->path_atual     = getcwd();
      $opsys = strtolower(php_uname());

      $this->nm_cont_lin           = 0;
      $this->nm_limite_lin         = 0;
      $this->nm_limite_lin_prt     = 0;
      $this->nm_limite_lin_res     = 0;
      $this->nm_limite_lin_res_prt = 0;
// 
      include_once($this->path_aplicacao . "reporte_tracking_erro.class.php"); 
      $this->Erro = new reporte_tracking_erro();
      include_once($this->path_adodb . "/adodb.inc.php"); 
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
// 
 if(function_exists('set_php_timezone')) set_php_timezone('reporte_tracking'); 
// 
      $this->sc_Include($this->path_lib_php . "/nm_functions.php", "", "") ; 
      $this->sc_Include($this->path_lib_php . "/nm_api.php", "", "") ; 
      $this->sc_Include($this->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      $this->sc_Include($this->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->sc_Include($this->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->nm_data = new nm_data("es");
      if (is_file("../_lib/css/" . $this->str_schema_all . "_grid.php")) {
          include("../_lib/css/" . $this->str_schema_all . "_grid.php");
      } else {
          $str_tree_col = "";
          $str_tree_exp = "";
          $str_button   = "";
      }
      $this->Color_bg_ajax = (!isset($str_ajax_bg)       || "" == trim($str_ajax_bg))       ? "#000" : $str_ajax_bg;
      $this->Border_c_ajax = (!isset($str_ajax_border_c) || "" == trim($str_ajax_border_c)) ? ""     : $str_ajax_border_c;
      $this->Border_s_ajax = (!isset($str_ajax_border_s) || "" == trim($str_ajax_border_s)) ? ""     : $str_ajax_border_s;
      $this->Border_w_ajax = (!isset($str_ajax_border_w) || "" == trim($str_ajax_border_w)) ? ""     : $str_ajax_border_w;
      $this->Tree_img_col    = trim($str_tree_col);
      $this->Tree_img_exp    = trim($str_tree_exp);
      $this->scGridRefinedSearchExpandFAIcon    = trim($scGridRefinedSearchExpandFAIcon);
      $this->scGridRefinedSearchCollapseFAIcon    = trim($scGridRefinedSearchCollapseFAIcon);
      $this->Tree_img_type   = "kie";
      $_SESSION['scriptcase']['nmamd'] = array();
      perfil_lib($this->path_libs);
      if (!isset($_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil']))
      {
          if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($this->path_libs, $this->path_prod);
          $_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil'] = true;
      }
      if (function_exists("nm_check_pdf_server")) $this->server_pdf = nm_check_pdf_server($this->path_libs, $this->server_pdf);
      if (!isset($_SESSION['scriptcase']['sc_num_img']))
      { 
          $_SESSION['scriptcase']['sc_num_img'] = 1;
      } 
      $this->str_google_fonts= '';
      $this->regionalDefault();
      $this->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      if (is_file($this->path_btn . $this->Str_btn_grid)) {
          include($this->path_btn . $this->Str_btn_grid);
      }
      $_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->sc_tem_trans_banco = false;
      if (isset($_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir'])) {
          $SS_cod_html  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">';
          $SS_cod_html .= "<HTML>\r\n";
          $SS_cod_html .= " <HEAD>\r\n";
          $SS_cod_html .= "  <TITLE></TITLE>\r\n";
          $SS_cod_html .= "   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\"/>\r\n";
          if ($_SESSION['scriptcase']['proc_mobile']) {
              $SS_cod_html .= "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\"/>\r\n";
          }
          $SS_cod_html .= "   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n";
          $SS_cod_html .= "    <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n";
          if ($_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body>\r\n";
          }
          else {
              $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_grid.css\"/>\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body class=\"scGridPage\">\r\n";
              $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div class=\"scGridBorder\">\r\n";
              $SS_cod_html .= "    <table class=\"scGridTabela\" width='100%' cellspacing=0 cellpadding=0><tr class=\"scGridFieldOdd\"><td class=\"scGridFieldOddFont\" style=\"padding: 15px 30px; text-align: center\">\r\n";
              $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
              $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
              $SS_cod_html .= "           target=\"_self\">\r\n";
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir'] . "');\r\n";
          }
          $SS_cod_html .= "      function sc_session_redir(url_redir)\r\n";
          $SS_cod_html .= "      {\r\n";
          $SS_cod_html .= "         if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "            window.parent.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "         else\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "             if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.close();\r\n";
          $SS_cod_html .= "                 window.opener.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "             else\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.location = url_redir;\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "      }\r\n";
          $SS_cod_html .= "    </script>\r\n";
          $SS_cod_html .= " </body>\r\n";
          $SS_cod_html .= "</HTML>\r\n";
          unset($_SESSION['scriptcase']['reporte_tracking']['session_timeout']);
          unset($_SESSION['sc_session']);
      }
      if (isset($SS_cod_html) && isset($_GET['nmgp_opcao']) && (substr($_GET['nmgp_opcao'], 0, 14) == "ajax_aut_comp_" || substr($_GET['nmgp_opcao'], 0, 13) == "ajax_autocomp"))
      {
          unset($_SESSION['sc_session']);
          $oJson = new Services_JSON();
          echo $oJson->encode("ss_time_out");
          exit;
      }
      elseif (isset($SS_cod_html) && ((isset($_POST['nmgp_opcao']) && substr($_POST['nmgp_opcao'], 0, 5) == "ajax_") || (isset($_GET['nmgp_opcao']) && substr($_GET['nmgp_opcao'], 0, 5) == "ajax_")))
      {
          unset($_SESSION['sc_session']);
          $this->Arr_result = array();
          $this->Arr_result['ss_time_out'] = true;
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      elseif (isset($SS_cod_html))
      {
          echo $SS_cod_html;
          exit;
      }
      $this->nm_bases_access     = array();
      $this->nm_bases_db2        = array();
      $this->nm_bases_ibase      = array();
      $this->nm_bases_informix   = array();
      $this->nm_bases_mssql      = array();
      $this->nm_bases_mysql      = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql", "azure_mysql", "azure_mysqlt", "azure_mysqli", "azure_maxsql", "azure_pdo_mysql", "googlecloud_mysql", "googlecloud_mysqlt", "googlecloud_mysqli", "googlecloud_maxsql", "googlecloud_pdo_mysql", "amazonrds_mysql", "amazonrds_mysqlt", "amazonrds_mysqli", "amazonrds_maxsql", "amazonrds_pdo_mysql");
      $this->nm_bases_postgres   = array();
      $this->nm_bases_oracle     = array();
      $this->sqlite_version      = "old";
      $this->nm_bases_sqlite     = array("sqlite", "sqlite3", "pdosqlite");
      $this->nm_bases_sybase     = array();
      $this->nm_bases_vfp        = array();
      $this->nm_bases_odbc       = array();
      $this->nm_bases_progress     = array();
      $this->nm_bases_all        = array_merge($this->nm_bases_mysql, $this->nm_bases_sqlite);
      $this->nm_font_ttf = array("ar", "ja", "pl", "ru", "sk", "thai", "zh_cn", "zh_hk", "cz", "el", "ko", "mk");
      $this->nm_ttf_arab = array("ar");
      $this->nm_ttf_jap  = array("ja");
      $this->nm_ttf_rus  = array("pl", "ru", "sk", "cz", "el", "mk");
      $this->nm_ttf_thai = array("thai");
      $this->nm_ttf_chi  = array("zh_cn", "zh_hk", "ko");
      $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['seq_dir'] = 0; 
      $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['sub_dir'] = array(); 
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1D9XsDQJsHIBeD5F7HgrwVcBUDur/VoBqDcFYZ1FGD1rwD5JwDMBYVkJqHEFqDoB/D9FYDQFaHAveD5NUHgNKDkBOV5FYHMBiHQNmZSBqHArKV5FUDMrYZSXeV5FqHIJsDcBwDQFUDSBYHuF7DMrwV9FeDWJeHIFUDcFYH9BOHArYHQJsDMvCZSJqV5FaVoFGHQXGDuFaHAveD5NUHgNKDkBOV5FYHMBiD9XOZ1F7HArYD5BiDEBOHEJGHEFqDoXGD9NwDQX7HIBeV5raHgvsVIFCDWJeVoraD9BsZSFaDSNOV5FaHgBeHEFiV5B3DoF7D9XsDuFaHANKV5JwHuzGVIBODWFYVorqD9BsH9FaHAN7ZMB/DMzGHEJqV5FaZuFaD9NwH9X7HArYV5FGHuvmDkBOHEFYDoJsDcJUVIJwZ1NOD5BqDEBeHEBUDWF/HIJsD9XsZ9JeD1BeD5F7DMvmVcXKDWF/DoNUHQJmZSB/Z1rYD5XGHgNKVkJqDWFqHMFaD9JKDQJwDSBYHuFaHuNOZSrCH5FqDoXGHQJmZ1FGZ1vOZMJwDMvCHErsHEFqHMJsHQJKH9BiHAvOD5F7HgrwVcB/DWBmVoX7HQBsVINUHINKV5X7HgBeZSJ3DWX7HIrqHQNmDuFaZ1vCD5F7HgvOVIB/HEFYHIXGHQNmH9BqHINaD5rqDEBOHEFiHEFqDoF7DcJUZSBiZ1zGVWFaHgvOVIB/DWJeHMB/DcFYZSBOHAvCV5X7DMveVkJ3DWX7HIBODcBiDQFUD1BOD5F7DMBYVIBsV5F/HMF7DcNmZ1FGD1vsV5X7HgvsHErCDWXCHIFGHQBiH9FUDSvCV5FGHuNOVcFKHEFYVoBqDcBwH9BqZ1vOZMJwHgBOZSJqHEFqHIBqHQXsDuFaD1BOD5F7DMvmVcB/H5FqHMBOHQJmH9BODSvmV5X7HgveZSJqH5F/HIBiHQNmH9BiHAvCD5F7DMNOVcBUDWF/HMBODcNmZSBOHAvsD5rqDEBOHEFiHEFqDoF7DcJUZSBiHIvsVWFaDMvsV9FeHEBmVEX7HQBiZkFGHIBOV5X7HgNKHErsDWr/HIBODcXGH9BiHINaD5F7DMvOVIB/DWFaHMJeHQNwH9BOHAzGV5X7HgrKHErCDWFGZuBOHQFYZSFUHAvmV5FGHuNOVcFKHEFYVoBqDcBwH9BqDSvOZMJwHgBOZSJqDWF/HIBiHQFYDuFaHIvsD5F7HgrwVcBUDWF/HMX7HQBsVIJsDSvOV5X7DMveHEJqDuFaHIrqHQJeDQBqD1NKD5F7DMBYVcFeV5BmVEraDcFYH9BqDSvmD5rqDEBOHEFiHEFqDoF7DcJUZSBiDSzGVWFaDMrYVcB/HEFYHMJeDcFYVINUHINKV5X7HgBeZSJqDuJeHIraHQNmDuBqD1vOD5F7DMBYVIB/Dur/HMJwHQXGZ1X7D1vsV5X7HgvsHErsH5F/HMBqHQJKDuBqD1NKV5FGHuNOVcFKHEFYVoBqDcBwH9BqDSvOZMJwDMvCZSJqDuXKZuFaHQJeDuFaD1vOD5F7HgrwVcB/DWFYHIraHQXGVIJsHAvCV5X7HgBYHErCDWX7HIraHQXOZSBiD1vOD5F7DMvODkB/H5FqHIrqHQXGZkFGZ1vmD5rqDEBOHEFiHEFqDoF7DcJUZSFGD1BeV5FGHgrYDkFCDWXCVoB/D9BiZ1F7HIveD5BiHgBeDkB/HEB3DoB/HQFYDQJwHANOV5JwHgrKDkFCDWJeVoB/D9BsZkFUHArKHQraDEBeHEXeDuFYVoB/D9NwZ9rqZ1rwHQBOHgrKVcFCH5XCHIF7DcBqZ1B/DSBeV5FaHgvCZSJGDWB3ZuXGHQXGZSFGHIrwVWXGHuBYDkFCDWJeVoraD9BsH9FaD1vsD5FaDErKZSXeH5FYDoJeD9JKDQFGHAveVWJsHgvsDkBODWFaVoFGDcJUZkFUZ1BOD5rqDEBOHEFiHEFqDoF7DcJUZSFGD1BeV5FGHgrYDkBODur/VoraD9XOH9FaD1rKD5BiHgvsHEFiDWFqVoBiD9XsZSFGHAN7V5JwDMNOZSJqH5B3VorqHQNmZ1FGHArKV5FUDMrYZSXeV5FqHIJsHQBiZ9XGHANKV5BODMrYVcBUDWB3VErqHQNmZ1BiHANOHQJwDEBODkFeH5FYVoFGHQJKDQB/DSN7HuFUHgrYDkFCDWF/HIBiHQXGZkFGHABYHQXGDEBeVkJqH5F/HIBiHQJKDQJsZ1vCV5FGHuNOV9FeDWXCHMJsDcBqZ1B/Z1NOV5JeDEBOHEFiV5XKDoNUHQNmDQX7DSBYD5XGHuNODkBOV5F/DoraHQJmZ1F7Z1vmD5rqDEBOHArCDWBmZuXGHQXGZ9XGHANKVWFU";
      $this->prep_conect();
      if (isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['initialize'])  
      { 
          $_SESSION['scriptcase']['reporte_tracking']['contr_erro'] = 'on';
 $_SESSION['scriptcase']['sc_apl_conf']['reporte_tracking']['lig_edit'] = 'N';
$_SESSION['scriptcase']['reporte_tracking']['contr_erro'] = 'off'; 
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['initialize'] = false;
      } 
      $this->conectDB();
      if (!in_array(strtolower($this->nm_tpbanco), $this->nm_bases_all))
      {
          echo "<tr>";
          echo "   <td bgcolor=\"\">";
          echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_dbcn_nspt'] . "</font>";
          echo "  " . $perfil_trab;
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
                  echo "<a href='" . $_SESSION['scriptcase']['nm_sc_retorno'] . "' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_Rhino_bvoltar.gif' title='" . $this->Nm_lang['lang_btns_rtrn_scrp_hint'] . "' align=absmiddle></a> \n" ; 
              } 
              else 
              { 
                  echo "<a href='$nm_url_saida' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_Rhino_bsair.gif' title='" . $this->Nm_lang['lang_btns_exit_appl_hint'] . "' align=absmiddle></a> \n" ; 
              } 
          } 
          exit ;
      } 
      if (empty($this->nm_tabela))
      {
          $this->nm_tabela = "appointments"; 
      }
      $this->Nm_accent_mysql     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_sqlite    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");

      $this->Nm_accent_no = array('cmp_i'=>'','cmp_f'=>'','cmp_apos'=>'','arg_i'=>'','arg_f'=>'','arg_apos'=>'');
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
          $this->Nm_accent_yes = $this->Nm_accent_mysql;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
          $this->Nm_accent_yes = $this->Nm_accent_sqlite;
      }
      else {
          $this->Nm_accent_yes = $this->Nm_accent_no;
      }
   }

   function getRunningOS()
   {
       $aOSInfo = array();

       if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
       {
           $aOSInfo['os'] = 'win';
       }
       elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
       {
           $aOSInfo['os'] = 'linux-i386';
           if(strpos(strtolower(php_uname()), 'x86_64') !== FALSE) 
            {
               $aOSInfo['os'] = 'linux-amd64';
            }
       }
       elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
       {
           $aOSInfo['os'] = 'macos';
       }

       return $aOSInfo;
   }

   function prep_conect()
   {
      if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
      {
          foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
          {
              if (isset($_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao']) && $_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['reporte_tracking']['glo_nm_perfil']) && $_SESSION['scriptcase']['reporte_tracking']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['reporte_tracking']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['reporte_tracking']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['reporte_tracking']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      $con_devel             = (isset($_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao']))
      {
          if (!isset($_GET['nmgp_opcao']) || ('pdf' != $_GET['nmgp_opcao'] && 'pdf_res' != $_GET['nmgp_opcao'])) {
              ob_start();
          } else {
              @ini_set('zlib.output_compression',0);
              $bufferSize = @ini_get('output_buffering');
              if ('' != $bufferSize) {
                  $bufferSize = min($bufferSize * 10, 65536);
                  echo str_repeat('&nbsp;', $bufferSize);
              }
              
          }
          db_conect_devel($con_devel, $this->root . $this->path_prod, 'carga_horas', 2, $this->force_db_utf8); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
          if (empty($_SESSION['scriptcase']['glo_tpbanco']) && empty($_SESSION['scriptcase']['glo_banco']))
          {
              $nm_crit_perfil = true;
          }
      }
      if (isset($_SESSION['scriptcase']['reporte_tracking']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['reporte_tracking']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['reporte_tracking']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($perfil_trab, $this->path_libs, "S", $this->path_conf);
          if (empty($_SESSION['scriptcase']['glo_senha_protect']))
          {
              $nm_crit_perfil = true;
          }
      }
      else
      {
          $perfil_trab = $con_devel;
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['embutida_init']) || !$_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['embutida_init']) 
      {
      }
// 
      if (!isset($_SESSION['scriptcase']['glo_tpbanco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_tpbanco; ";
          }
      }
      else
      {
          $this->nm_tpbanco = $_SESSION['scriptcase']['glo_tpbanco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_servidor']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_servidor; ";
          }
      }
      else
      {
          $this->nm_servidor = $_SESSION['scriptcase']['glo_servidor']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_banco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_banco; ";
          }
      }
      else
      {
          $this->nm_banco = $_SESSION['scriptcase']['glo_banco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_usuario']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_usuario; ";
          }
      }
      else
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_usuario']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_senha']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_senha; ";
          }
      }
      else
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_senha']; 
      }
      if (isset($_SESSION['scriptcase']['glo_database_encoding']))
      {
          $this->nm_database_encoding = $_SESSION['scriptcase']['glo_database_encoding']; 
      }
      $this->nm_arr_db_extra_args = array(); 
      if (isset($_SESSION['scriptcase']['glo_use_ssl']))
      {
          $this->nm_arr_db_extra_args['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_persistent']))
      {
          $this->nm_con_persistente = $_SESSION['scriptcase']['glo_use_persistent']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_schema']))
      {
          $this->nm_con_use_schema = $_SESSION['scriptcase']['glo_use_schema']; 
      }
      $this->date_delim  = "'";
      $this->date_delim1 = "'";
      if (isset($_SESSION['scriptcase']['glo_decimal_db']) && !empty($_SESSION['scriptcase']['glo_decimal_db']))
      {
          $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
           {
              $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date1'];
      }
// 
      if (!empty($this->nm_falta_var) || !empty($this->nm_falta_var_db) || $nm_crit_perfil)
      {
          echo "<style type=\"text/css\">";
          echo ".scButton_default { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; line-height:31px; height:34px; padding:0 12px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_default:hover { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:hover img, .scButton_group:hover img{filter: brightness(2);}.scButton_default:hover{; box-shadow:inset 0 -1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; line-height:31px; height:34px; padding:0 12px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_default:active { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:active img{filter: brightness(2)}.scButton_default:active{; box-shadow:inset 0 1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; line-height:31px; height:34px; padding:0 12px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_default_disabled { font-family:Tahoma, Arial, sans-serif; color:#7d7d7d; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; line-height:31px; height:34px; padding:0 12px; cursor:default; box-sizing:border-box;  }";
          echo ".scButton_default_selected { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_default_list { background-color:#ffffff; filter: alpha(opacity=100); opacity:1; padding:6px 52px 6px 15px; cursor:pointer; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858;  }";
          echo ".scButton_default_list:hover { background-color:#EFF2F7; filter: alpha(opacity=100); opacity:1; padding:6px 52px 6px 15px; cursor:pointer; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858;  }";
          echo ".scButton_default_list_disabled { background-color:#ffffff; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858; padding:6px 52px 6px 15px; filter: alpha(opacity=45); opacity:0.45; cursor:default;  }";
          echo ".scButton_default_list_selected { background-color:#ffffff; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858; padding:6px 52px 6px 15px; cursor:pointer; filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_default_list:active { background-color:#EFF2F7; filter: alpha(opacity=100); opacity:1; padding:6px 52px 6px 15px; cursor:pointer; font-family:Arial, sans-serif; font-size:13px; text-decoration:none; color:#3C4858;  }";
          echo ".scButton_group { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:0px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:7.8px 15px;margin:0px -5px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box; img_filter:grayscale(100%);  }";
          echo ".scButton_group:hover { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-shadow:;transition: all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden;box-sizing: border-box; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:hover img, .scButton_group:hover img{filter: brightness(2);}.scButton_group:hover{; box-shadow:inset 0 -1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; padding:7.8px 15px;margin:0px -5px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_group:active { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_group:active img{filter: brightness(2)}.scButton_group:active{; box-shadow:inset 0 1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; padding:7.8px 15px;margin:0px -5px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_group_disabled { font-family:Tahoma, Arial, sans-serif; color:#7d7d7d; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:0px; background-color:#FFFFFF; filter: alpha(opacity=40); opacity:0.4; padding:7.8px 15px;margin:0px -5px; cursor:default; box-sizing:border-box;  }";
          echo ".scButton_group_selected { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:0px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:7.8px 15px;margin:0px -5px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box; img_filter:none;  }";
          echo ".scButton_small { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_small:hover { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:hover img, .scButton_groupfirst:hover img, .scButton_group:hover img{filter: brightness(2);}.scButton_small:hover{; box-shadow:inset 0 -1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_small:active { font-family:Tahoma, Arial, sans-serif; color:#FFFFFF; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#1B8FC8; border-style:solid; border-radius:2px; background-color:#1B8FC8;}.scButton_default:active img{filter: brightness(2)}.scButton_small:active{; box-shadow:inset 0 1px 0 rgba(31, 45, 61, 0.15); filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_small_disabled { font-family:Tahoma, Arial, sans-serif; color:#7d7d7d; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:default; box-sizing:border-box;  }";
          echo ".scButton_small_selected { font-family:Tahoma, Arial, sans-serif; color:#3C4858; font-size:13px; font-weight:normal; text-decoration:none; border-width:1px; border-color:#E0E6ED; border-style:solid; border-radius:2px; background-color:#FFFFFF; filter: alpha(opacity=100); opacity:1; padding:3px 13px; cursor:pointer; transition:all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;-webkit-transition:all 0.2s;-moz-transition:all 0.2s;-webkit-backface-visibility: hidden; box-sizing:border-box;  }";
          echo ".scButton_small_list { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_small_list:hover { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sweetalertok_list { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sweetalertok_list:hover { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sweetalertok { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#3085d6; border-style:solid; border-radius:4.25px; background-color:#3085d6; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertok:hover { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#2b77c0; border-style:solid; border-radius:4.25px; background-color:#2b77c0; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertok:active { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#266aab; border-style:solid; border-radius:4.25px; background-color:#266aab; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertok_disabled { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#3085d6; border-style:solid; border-radius:4.25px; background-color:#3085d6; box-shadow:none; filter: alpha(opacity=44); opacity:0.44; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertok_selected { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#266aab; border-style:solid; border-radius:4.25px; background-color:#266aab; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#aaa; border-style:solid; border-radius:4.25px; background-color:#aaa; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel:hover { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#999; border-style:solid; border-radius:4.25px; background-color:#999; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel:active { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#3085d6; border-style:solid; border-radius:4.25px; background-color:#3085d6; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel_disabled { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#aaa; border-style:solid; border-radius:4.25px; background-color:#aaa; box-shadow:none; filter: alpha(opacity=44); opacity:0.44; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel_selected { font-family:Arial, sans-serif; color:#fff; font-size:17px; font-weight:normal; text-decoration:none; border-width:0px; border-color:#7a7a7a; border-style:solid; border-radius:4.25px; background-color:#7a7a7a; box-shadow:none; filter: alpha(opacity=100); opacity:1; padding:9px 12px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sweetalertcancel_list { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sweetalertcancel_list:hover { filter: alpha(opacity=100); opacity:1;  }";
          echo ".scButton_sc_image { color:#8592a6; font-size:15px; text-decoration:none; border-style:none; filter: alpha(opacity=100); opacity:1; padding:5px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sc_image:hover { color:#8592a6; font-size:15px; text-decoration:none; border-style:none; filter: alpha(opacity=100); opacity:1; padding:5px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sc_image:active { color:#8592a6; font-size:15px; text-decoration:none; filter: alpha(opacity=100); opacity:1; padding:5px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scButton_sc_image_disabled { color:#8592a6; font-size:15px; text-decoration:none; border-style:none; filter: alpha(opacity=44); opacity:0.44; padding:5px; cursor:default; transition:all 0.2s;  }";
          echo ".scButton_sc_image_selected { color:#8592a6; font-size:15px; text-decoration:none; border-style:none; filter: alpha(opacity=100); opacity:1; padding:5px; cursor:pointer; transition:all 0.2s;  }";
          echo ".scLink_default { text-decoration: underline; font-size: 13px; color: #1a0dab;  }";
          echo ".scLink_default:visited { text-decoration: underline; font-size: 13px; color: #660099;  }";
          echo ".scLink_default:active { text-decoration: underline; font-size: 13px; color: #1a0dab;  }";
          echo ".scLink_default:hover { text-decoration: underline; font-size: 13px; color: #1a0dab;  }";
          echo "</style>";
          echo "<table width=\"80%\" border=\"1\" height=\"117\">";
          if (empty($this->nm_falta_var_db))
          {
              if (!empty($this->nm_falta_var))
              {
                  echo "<tr>";
                  echo "   <td bgcolor=\"\">";
                  echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_glob'] . "</font>";
                  echo "  " . $this->nm_falta_var;
                  echo "   </b></td>";
                  echo " </tr>";
              }
              if ($nm_crit_perfil)
              {
                  echo "<tr>";
                  echo "   <td bgcolor=\"\">";
                  echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_dbcn_nfnd'] . "</font>";
                  echo "  " . $perfil_trab;
                  echo "   </b></td>";
                  echo " </tr>";
              }
          }
          else
          {
              echo "<tr>";
              echo "   <td bgcolor=\"\">";
              echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_dbcn_data'] . "</font></b>";
              echo "   </td>";
              echo " </tr>";
          }
          echo "</table>";
          if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_back'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_back_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
              else 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_exit'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_exit_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
          } 
          exit ;
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_usr']) && !empty($_SESSION['scriptcase']['glo_db_master_usr']))
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_db_master_usr']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_pass']) && !empty($_SESSION['scriptcase']['glo_db_master_pass']))
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_db_master_pass']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_cript']) && !empty($_SESSION['scriptcase']['glo_db_master_cript']))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = $_SESSION['scriptcase']['glo_db_master_cript']; 
      }
   }
   function conectDB()
   {
      global $glo_senha_protect;
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['reporte_tracking']['glo_nm_conexao'], $this->root . $this->path_prod, 'carga_horas', 1, $this->force_db_utf8); 
      } 
      else 
      { 
          ob_start();
          $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_database_encoding;
          $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $databaseEncoding, $this->nm_arr_db_extra_args); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_start();
          } 
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function regionalDefault()
   {
       $_SESSION['scriptcase']['reg_conf']['date_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_format'] : "ddmmyyyy";
       $_SESSION['scriptcase']['reg_conf']['date_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_sep'] : "/";
       $_SESSION['scriptcase']['reg_conf']['date_week_ini'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema'] : "SU";
       $_SESSION['scriptcase']['reg_conf']['time_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_format'] : "hhiiss";
       $_SESSION['scriptcase']['reg_conf']['time_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_sep'] : ":";
       $_SESSION['scriptcase']['reg_conf']['time_pos_ampm'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm'] : "right_without_space";
       $_SESSION['scriptcase']['reg_conf']['time_simb_am']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am'] : "am";
       $_SESSION['scriptcase']['reg_conf']['time_simb_pm']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm'] : "pm";
       $_SESSION['scriptcase']['reg_conf']['simb_neg']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg'] : "-";
       $_SESSION['scriptcase']['reg_conf']['grup_num']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['neg_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg'] : 2;
       $_SESSION['scriptcase']['reg_conf']['monet_simb']    = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo'] : "$";
       $_SESSION['scriptcase']['reg_conf']['monet_f_pos']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'] : 3;
       $_SESSION['scriptcase']['reg_conf']['monet_f_neg']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'] : 13;
       $_SESSION['scriptcase']['reg_conf']['grup_val']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_val']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['html_dir']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  " DIR='" . $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] . "'" : "";
       $_SESSION['scriptcase']['reg_conf']['css_dir']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "LTR";
       $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit'] : "1";
       $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'] : "1";
       eval ('set'.$this->Control_Css.$this->Tree_img_type.'("'.$this->nm_script_type.'SESSID_",base64_encode("'.$this->nm_script_by.'?".substr(md5(mt_rand()),8,16)),time()+86400);');
   }
// 
   function sc_Include($path, $tp, $name)
   {
       if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
       {
           include_once($path);
       }
   } // sc_Include
   function sc_Sql_Protect($var, $tp, $conex="")
   {
       if (empty($conex) || $conex == "conn_example")
       {
           $TP_banco = $_SESSION['scriptcase']['glo_tpbanco'];
       }
       else
       {
           eval ("\$TP_banco = \$this->nm_con_" . $conex . "['tpbanco'];");
       }
       if ($tp == "date")
       {
           $delim  = "'";
           $delim1 = "'";
           if (isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_sep_date1'];
           }
           return $delim . $var . $delim1;
       }
       else
       {
           return $var;
       }
   } // sc_Sql_Protect
   function sc_Date_Protect($val_dt)
   {
       $dd = substr($val_dt, 8, 2);
       $mm = substr($val_dt, 5, 2);
       $yy = substr($val_dt, 0, 4);
       $hh = (strlen($val_dt) > 10) ? substr($val_dt, 10) : "";
       if ($mm > 12) {
           $mm = 12;
       }
       $dd_max = 31;
       if ($mm == '04' || $mm == '06' || $mm == '09' || $mm == 11) {
           $dd_max = 30;
       }
       if ($mm == '02') {
           $dd_max = ($yy % 4 == 0) ? 29 : 28;
       }
       if ($dd > $dd_max) {
           $dd = $dd_max;
       }
       return $yy . "-" . $mm . "-" . $dd . $hh;
   }
	function appIsSsl() {
		if (isset($_SERVER['HTTPS'])) {
			if ('on' == strtolower($_SERVER['HTTPS'])) {
				return true;
			}
			if ('1' == $_SERVER['HTTPS']) {
				return true;
			}
		}

		if (isset($_SERVER['REQUEST_SCHEME'])) {
			if ('https' == $_SERVER['REQUEST_SCHEME']) {
				return true;
			}
		}

		if (isset($_SERVER['SERVER_PORT'])) {
			if ('443' == $_SERVER['SERVER_PORT']) {
				return true;
			}
		}

		return false;
	}
   function Get_Gb_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_Gb_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_Gb_date_format'][$GB][$cmp] : "";
   }

   function Get_Gb_prefix_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_Gb_prefix_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['SC_Gb_prefix_date_format'][$GB][$cmp] : "";
   }

   function GB_date_format($val, $format, $prefix, $conf_region="S", $mask="")
   {
       if (empty($val) || empty($format)) {
           return $val;
       }
       if ($format == 'HH') {
           return $prefix . substr($val, 11, 2);
       }
       if ($format == 'DD') {
           return $prefix . substr($val, 8, 2);
       }
       if ($format == 'MM' && $conf_region == "S") {
           return $prefix . substr($val, 5, 2);
       }
       if ($format == 'WEEK' || $format == 'YYYYWEEK') {
           $part = $this->Get_Sql_Week($val);
           $part = (substr($part, 0, 1)== 0) ? substr($part, 1) : $part;
       }
       if ($format == 'DAYNAME' || $format == 'YYYYDAYNAME') {
           $daynum = $this->nm_data->GetWeekDay($val);
           if ($daynum == 0) {
               $part = $this->Nm_lang['lang_days_sund'];
           }
           if ($daynum == 1) {
               $part = $this->Nm_lang['lang_days_mond'];
           }
           if ($daynum == 2) {
               $part = $this->Nm_lang['lang_days_tued'];
           }
           if ($daynum == 3) {
               $part = $this->Nm_lang['lang_days_wend'];
           }
           if ($daynum == 4) {
               $part = $this->Nm_lang['lang_days_thud'];
           }
           if ($daynum == 5) {
               $part = $this->Nm_lang['lang_days_frid'];
           }
           if ($daynum == 6) {
               $part = $this->Nm_lang['lang_days_satd'];
           }
       }
       if ($format == 'YYYYSEMIANNUAL' || $format == 'SEMIANNUAL') {
           $part = $this->nm_data->GetSem(substr($val, 5, 2));
       }
       if ($format == 'YYYYFOURMONTHS' || $format == 'FOURMONTHS') {
           $part = $this->nm_data->GetQuadr(substr($val, 5, 2));
       }
       if ($format == 'YYYYQUARTER' || $format == 'QUARTER') {
           $part = $this->nm_data->GetTrim(substr($val, 5, 2));
       }
       if ($format == 'YYYYBIMONTHLY' || $format == 'BIMONTHLY') {
           $part = $this->nm_data->GetBim(substr($val, 5, 2));
       }
       if ($format == 'SEMIANNUAL' || $format == 'FOURMONTHS'  || $format == 'QUARTER' || $format == 'BIMONTHLY' || $format == 'WEEK' || $format == 'DAYNAME') {
           return $prefix . $part;
       }
       if ($format == 'YYYYSEMIANNUAL' || $format == 'YYYYFOURMONTHS'  || $format == 'YYYYQUARTER' || $format == 'YYYYBIMONTHLY' || $format == 'YYYYWEEK' || $format == 'YYYYDAYNAME') {
           return $prefix . $part . " " . substr($val, 0, 4);
       }
       if ($format == 'HHIISS') {
           $tp     = 'HH';
           $mk     = 'hhiiss';
           $format = 'HH:II:SS';
           $val    = substr($val, 11, 8);
       }
       if ($format == 'HHII') {
           $tp     = 'HH';
           $mk     = 'hhii';
           $format = 'HH:II';
           $val    = substr($val, 11, 5);
       }
       if ($format == 'YYYYMMDDHHIISS') {
           $tp     = 'DH';
           $mk     = 'ddmmaaaa;hhiiss';
           $format = 'YYYY-MM-DD HH:II:SS';
       }
       if ($format == 'YYYYMMDDHHII') {
           $tp     = 'DH';
           $mk     = 'ddmmaaaa;hhii';
           $format = 'YYYY-MM-DD HH:II';
           $val    = substr($val, 0, 16);
       }
       if ($format == 'YYYYMMDDHH') {
           $tp     = 'DH';
           $mk     = 'ddmmaaaa;hh';
           $format = 'YYYY-MM-DD HH';
           $val    = substr($val, 0, 13);
       }
       if ($format == 'YYYYMMDD2') {
           $tp     = 'DT';
           $mk     = 'ddmmaaaa';
           $format = 'YYYY-MM-DD';
           $val    = substr($val, 0, 10);
       }
       if ($format == 'YYYYHH') {
           return $prefix . substr($val, 0, 4) . $_SESSION['scriptcase']['reg_conf']['date_sep'] . substr($val, 11, 2);
       }
       if ($format == 'YYYYDD') {
           return $prefix . substr($val, 0, 4) . $_SESSION['scriptcase']['reg_conf']['date_sep'] . substr($val, 8, 2);
       }
       if ($format == 'YYYYMM') {
           $tp     = 'DT';
           $mk     = 'mmaaaa';
           $format = 'YYYY-MM';
           $val = substr($val, 0, 7);
       }
       if ($format == 'MM') {
           $tp     = 'DT';
           $mk     = 'mm';
           $format = 'MM';
           $val = substr($val, 5, 2);
       }
       if ($format == 'YYYY') {
           $tp     = 'DT';
           $mk     = 'aaaa';
           $format = 'YYYY';
           $val = substr($val, 0, 4);
       }
       $conteudo_x = $val;
       nm_conv_limpa_dado($conteudo_x, $format);
       if (is_numeric($conteudo_x) && $conteudo_x > 0) 
       { 
           $this->nm_data->SetaData($val, $format);
           if ($conf_region != "S")
           { 
               $val = $this->nm_data->FormataSaida($mask);
           }
           else
           { 
               $val = $this->nm_data->FormataSaida($this->nm_data->FormatRegion($tp, $mk));
           }
       }
       return $prefix . $val;
   }

   function Get_date_arg_sum($val, $format, $cmp_sql, $arq_link_res=false, $res_metric=false)
   {
       $delimit  = $this->date_delim;
       $delimit1 = $this->date_delim1;
       if ($val == "")
       {
           return " is null";;
       }
       $arg_sum = "";
       if ($format == 'YYYYMMDDHHIISS' && (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle)))
       {
           $arg_sum = " like '" . substr($val, 0, 19) . "%'";
           if ($res_metric)
           {
               return "";;
           }
       }
       elseif ($format == 'YYYYMMDDHHIISS')
       {
           $arg_sum = " = " . $delimit . $val . $delimit1;
           if ($res_metric)
           {
               return "";;
           }
       }
       elseif ($format == 'YYYY' || $format == 'YYYYMMDDHHII' || $format == 'YYYYMMDDHH' || $format == 'YYYYMMDD2' || $format == 'YYYYMM')
       {
           $valx     = substr($val, 0, 4);
           $arg_sum  = $this->Get_date_arg_sum_compl($valx, 'YYYY', $cmp_sql, $res_metric);
          if ($format == 'YYYYMMDDHHII')
           {
               $valx     = substr($val, 5, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'MM', $cmp_sql, $res_metric);
               $valx     = substr($val, 8, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'DD', $cmp_sql, $res_metric);
               $valx     = substr($val, 11, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'HH', $cmp_sql, $res_metric);
               $valx     = substr($val, 14, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'II', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYMMDDHH')
           {
               $valx     = substr($val, 5, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'MM', $cmp_sql, $res_metric);
               $valx     = substr($val, 8, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'DD', $cmp_sql, $res_metric);
               $valx     = substr($val, 11, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'HH', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYMMDD2')
           {
               $valx     = substr($val, 5, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'MM', $cmp_sql, $res_metric);
               $valx     = substr($val, 8, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'DD', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYMM')
           {
               $valx     = substr($val, 5, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'MM', $cmp_sql, $res_metric);
           }
       }
       elseif ($format == 'MM')
       {
           $valx     = ($arq_link_res) ? $val : substr($val, 5, 2);
           $arg_sum = $this->Get_date_arg_sum_compl($valx, $format, $cmp_sql, $res_metric);
       }
       elseif ($format == 'DD')
       {
            $valx    = ($arq_link_res) ? $val : substr($val, 8, 2);
           $arg_sum = $this->Get_date_arg_sum_compl($valx, $format, $cmp_sql, $res_metric);
       }
       elseif ($format == 'HH')
       {
           $valx     = ($arq_link_res) ? substr($val, 0, 2) : substr($val, 11, 2);
           $arg_sum = $this->Get_date_arg_sum_compl($valx, $format, $cmp_sql, $res_metric);
       }
       elseif ($format == 'DAYNAME')
       {
            $valx    = ($arq_link_res || $res_metric) ? $val : $this->Compat_WeekDay($val);
           $arg_sum = $this->Get_date_arg_sum_compl($valx, $format, $cmp_sql, $res_metric);
       }
       elseif ($format == 'WEEK')
       {
           $valx     = ($arq_link_res || $res_metric) ? $val : $this->Get_Sql_Week($val);
           $arg_sum = $this->Get_date_arg_sum_compl($valx, $format, $cmp_sql, $res_metric);
       }
       elseif ($format == 'BIMONTHLY')
       {
           $valx     = ($arq_link_res || $res_metric) ? $val : $this->nm_data->GetBim(substr($val, 5, 2));
           $arg_sum = $this->Get_date_arg_sum_compl($valx, $format, $cmp_sql, $res_metric);
       }
       elseif ($format == 'QUARTER')
       {
           $valx     = ($arq_link_res || $res_metric) ? $val : $this->nm_data->GetTrim(substr($val, 5, 2));
           $arg_sum = $this->Get_date_arg_sum_compl($valx, $format, $cmp_sql, $res_metric);
       }
       elseif ($format == 'FOURMONTHS')
       {
           $valx     = ($arq_link_res || $res_metric) ? $val : $this->nm_data->GetQuadr(substr($val, 5, 2));
           $arg_sum = $this->Get_date_arg_sum_compl($valx, $format, $cmp_sql, $res_metric);
       }
       elseif ($format == 'SEMIANNUAL')
       {
           $valx     = ($arq_link_res || $res_metric) ? $val : $this->nm_data->GetSem(substr($val, 5, 2));
           $arg_sum = $this->Get_date_arg_sum_compl($valx, $format, $cmp_sql, $res_metric);
       }
       elseif ($format == 'YYYYHH' || $format == 'YYYYDD' || $format == 'YYYYDAYNAME' || $format == 'YYYYWEEK' || $format == 'YYYYBIMONTHLY' || $format == 'YYYYQUARTER' || $format == 'YYYYFOURMONTHS' || $format == 'YYYYSEMIANNUAL')
       {
           $valx     = substr($val, 0, 4);
           $arg_sum  = $this->Get_date_arg_sum_compl($valx, 'YYYY', $cmp_sql, $res_metric);
           if ($format == 'YYYYHH')
           {
               $valx      = ($arq_link_res) ?  substr($val, 4, 2) : substr($val, 11, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'HH', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYDD')
           {
                $valx     = ($arq_link_res) ?  substr($val, 4, 2) : substr($val, 8, 2);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'DD', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYDAYNAME')
           {
               $valx      = ($arq_link_res || $res_metric) ?  substr($val, 4, 1) : $this->Compat_WeekDay($val);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'DAYNAME', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYWEEK')
           {
               $valx      = ($arq_link_res || $res_metric) ?  substr($val, 4, 2) : $this->Get_Sql_Week($val);
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'WEEK', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYBIMONTHLY')
           {
               $valx      = ($arq_link_res || $res_metric) ? substr($val, 4, 1) : $this->nm_data->GetBim(substr($val, 5, 2));
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'BIMONTHLY', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYQUARTER')
           {
               $valx      = ($arq_link_res || $res_metric) ? substr($val, 4, 1) : $this->nm_data->GetTrim(substr($val, 5, 2));
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'QUARTER', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYFOURMONTHS')
           {
               $valx      = ($arq_link_res || $res_metric) ? substr($val, 4, 1) : $this->nm_data->GetQuadr(substr($val, 5, 2));
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'FOURMONTHS', $cmp_sql, $res_metric);
           }
           elseif ($format == 'YYYYSEMIANNUAL')
           {
               $valx      = ($arq_link_res || $res_metric) ? substr($val, 4, 1) : $this->nm_data->GetSem(substr($val, 5, 2));
               $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'SEMIANNUAL', $cmp_sql, $res_metric);
           }
       }
       elseif ($format == 'HHIISS')
       {
           $valx     = ($arq_link_res) ? substr($val, 0, 2) : substr($val, 11, 2);
           $arg_sum  = $this->Get_date_arg_sum_compl($valx, 'HH', $cmp_sql, $res_metric);
           $valx     = ($arq_link_res) ? substr($val, 3, 2) : substr($val, 14, 2);
           $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'II', $cmp_sql, $res_metric);
           $valx     = ($arq_link_res) ? substr($val, 6, 2) : substr($val, 17, 2);
           $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'SS', $cmp_sql, $res_metric);
       }
       elseif ($format == 'HHII')
       {
           $valx     = ($arq_link_res) ? substr($val, 0, 2) : substr($val, 11, 2);
           $arg_sum  = $this->Get_date_arg_sum_compl($valx, 'HH', $cmp_sql, $res_metric);
           $valx     = ($arq_link_res) ? substr($val, 3, 2) : substr($val, 14, 2);
           $arg_sum .= " and " . $this->Get_date_arg_sum_compl($valx, 'II', $cmp_sql, $res_metric);
       }
       else
       {
           $arg_sum = " = " . $this->Db->qstr($val);
       }
       return $arg_sum;
   }
   function Get_date_arg_sum_compl($val, $format, $cmp_sql, $res_metric=false)
   {
       if ($res_metric) {
           return $this->Get_date_arq_res_metric($format, $cmp_sql);
       }
       $delimit  = $this->date_delim;
       $delimit1 = $this->date_delim1;
       if ($format == 'HH') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%H'," . $cmp_sql . ")  = '" . $val . "'";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "hour(" . $cmp_sql . ") = " . $val;
           }
           else {
               return "hour(" . $cmp_sql . ") = " . $delimit . $val . $delimit1;
           }
       }
       if ($format == 'II') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%M'," . $cmp_sql . ")  = '" . $val . "'";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "minute(" . $cmp_sql . ") = " . $val;
           }
           else {
               return "minute(" . $cmp_sql . ") = " . $delimit . $val . $delimit1;
           }
       }
       if ($format == 'SS') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%S'," . $cmp_sql . ")  = '" . $val . "'";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "second(" . $cmp_sql . ") = " . $val;
           }
           else {
               return "second(" . $cmp_sql . ") = " . $delimit . $val . $delimit1;
           }
       }
       if ($format == 'DD') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%d'," . $cmp_sql . ")  = '" . $val . "'";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "day(" . $cmp_sql . ") = " . $val;
           }
           else {
               return "day(" . $cmp_sql . ") = " . $delimit . $val . $delimit1;
           }
       }
       if ($format == 'MM') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%m'," . $cmp_sql . ")  = '" . $val . "'";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "month(" . $cmp_sql . ") = " . $val;
           }
           else {
               return "month( " . $cmp_sql . ") = " . $delimit . $val . $delimit1;
           }
       }
       if ($format == 'YYYY') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%Y'," . $cmp_sql . ")  = '" . $val . "'";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "year(" . $cmp_sql . ") = " . $val;
           }
           else {
               return "year( " . $cmp_sql . ") = " . $delimit . $val . $delimit1;
           }
       }
       if ($format == 'WEEK') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%W'," . $cmp_sql . ")  = '" . $val . "'";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "WEEK(" . $cmp_sql . ") = '" . $val . "'";
           }
           else {
               return "week( " . $cmp_sql . ") = " . $delimit . $val . $delimit1;
           }
       }
       if ($format == 'DAYNAME') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%w'," . $cmp_sql . ")  = '" . $val . "'";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "WEEKDAY(" . $cmp_sql . ") = '" . $val . "'";
           }
           else {
               return "WEEKDAY( " . $cmp_sql . ") = " . $delimit . $val . $delimit1;
           }
       }
       if ($format == 'SEMIANNUAL') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $cmp_sql . ") -1 ) / 6 + 1) AS INTEGER) = " . $val;
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 6 + 1) AS NCHAR (1)) = '" . $val . "'";
           }
           else {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 6 + 1) AS NCHAR (1)) = '" . $val . "'";
           }
       }
       if ($format == 'FOURMONTHS') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $cmp_sql . ") -1 ) / 4 + 1) AS INTEGER) = " . $val;
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 4 + 1) AS NCHAR (1)) = '" . $val . "'";
           }
           else {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 4 + 1) AS NCHAR (1)) = '" . $val . "'";
           }
       }
       if ($format == 'QUARTER') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $cmp_sql . ") -1 ) / 3 + 1) AS INTEGER) = " . $val;
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "QUARTER(" . $cmp_sql . ") = " . $val;
           }
           else {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 3 + 1) AS NCHAR (1)) = '" . $val . "'";
           }
       }
       if ($format == 'BIMONTHLY') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $cmp_sql . ") -1 ) / 2 + 1) AS INTEGER) = " . $val;
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 2 + 1) AS NCHAR (1)) = '" . $val . "'";
           }
           else {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 2 + 1) AS NCHAR (1)) = '" . $val . "'";
           }
       }
   }
   function Get_date_arq_res_metric($format, $cmp_sql)
   {
       if ($format == 'HH') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%H'," . $cmp_sql . ") *sc# strftime('%H',SC." . $cmp_sql . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "hour(" . $cmp_sql . ") *sc# hour(SC." . $cmp_sql . ")";
           }
           else {
               return "hour(" . $cmp_sql . ") *sc# hour(SC." . $cmp_sql . ")";
           }
       }
       if ($format == 'II') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%M'," . $cmp_sql . ") *sc# strftime('%M',SC." . $cmp_sql . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "minute(" . $cmp_sql . ") *sc# minute(SC." . $cmp_sql . ")";
           }
           else {
               return "minute(" . $cmp_sql . ") *sc# minute(SC." . $cmp_sql . ")";
           }
       }
       if ($format == 'SS') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%S'," . $cmp_sql . ") *sc# strftime('%S',SC." . $cmp_sql . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "second(" . $cmp_sql . ") *sc# second(SC." . $cmp_sql . ")";
           }
           else {
               return "second(" . $cmp_sql . ") *sc# second(SC." . $cmp_sql . ")";
           }
       }
       if ($format == 'DD') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%d'," . $cmp_sql . ") *sc# strftime('%d',SC." . $cmp_sql . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "day(" . $cmp_sql . ") *sc# day(SC." . $cmp_sql . ")";
           }
           else {
               return "day(" . $cmp_sql . ") *sc# day(SC." . $cmp_sql . ")";
           }
       }
       if ($format == 'MM') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%m'," . $cmp_sql . ") *sc# strftime('%m',SC." . $cmp_sql . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "month(" . $cmp_sql . ") *sc# month(SC." . $cmp_sql . ")";
           }
           else {
               return "month(" . $cmp_sql . ") *sc# month(SC." . $cmp_sql . ")";
           }
       }
       if ($format == 'YYYY') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%Y'," . $cmp_sql . ") *sc# strftime('%Y',SC." . $cmp_sql . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "year( " . $cmp_sql . ") *sc# year(SC." . $cmp_sql . ")";
           }
           else {
               return "year( " . $cmp_sql . ") *sc# year(SC." . $cmp_sql . ")";
           }
       }
       if ($format == 'WEEK') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%W'," . $cmp_sql . ")  *sc# strftime('%W',SC." . $cmp_sql . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "WEEK(" . $cmp_sql . ") *sc# WEEK(SC." . $cmp_sql . ")";
           }
           else {
               return "week(" . $cmp_sql . ") *sc# week(SC." . $cmp_sql . ")";
           }
       }
       if ($format == 'DAYNAME') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "strftime('%w'," . $cmp_sql . ") *sc# strftime('%w',SC." . $cmp_sql . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "WEEKDAY(" . $cmp_sql . ") *sc# WEEKDAY(SC." . $cmp_sql . ")";
           }
           else {
               return "WEEKDAY(" . $cmp_sql . ") *sc# WEEKDAY(SC." . $cmp_sql . ")";
           }
       }
       if ($format == 'SEMIANNUAL') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $cmp_sql . ") -1 ) / 6 + 1) AS INTEGER) *sc# CAST(((strftime('%m', SC." . $cmp_sql . ") -1 ) / 6 + 1) AS INTEGER)";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 6 + 1) AS NCHAR (1)) *sc# CAST(((MONTH(SC." . $cmp_sql . ") - 1) / 6 + 1) AS NCHAR (1))";
           }
           else {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 6 + 1) AS NCHAR (1)) *sc# CAST(((MONTH(SC." . $cmp_sql . ") - 1) / 6 + 1) AS NCHAR (1))";
           }
       }
       if ($format == 'FOURMONTHS') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $cmp_sql . ") -1 ) / 4 + 1) AS INTEGER) *sc# CAST(((strftime('%m', SC." . $cmp_sql . ") -1 ) / 4 + 1) AS INTEGER)";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 4 + 1) AS NCHAR (1)) *sc# CAST(((MONTH(SC." . $cmp_sql . ") - 1) / 4 + 1) AS NCHAR (1))";
           }
           else {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 4 + 1) AS NCHAR (1)) *sc# CAST(((MONTH(SC." . $cmp_sql . ") - 1) / 4 + 1) AS NCHAR (1))";
           }
       }
       if ($format == 'QUARTER') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $cmp_sql . ") -1 ) / 3 + 1) AS INTEGER) *sc# CAST(((strftime('%m', SC." . $cmp_sql . ") -1 ) / 3 + 1) AS INTEGER)";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "QUARTER(" . $cmp_sql . ") *sc# QUARTER(SC." . $cmp_sql . ")";
           }
           else {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 3 + 1) AS NCHAR (1)) *sc# CAST(((MONTH(SC." . $cmp_sql . ") - 1) / 3 + 1) AS NCHAR (1))";
           }
       }
       if ($format == 'BIMONTHLY') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $cmp_sql . ") -1 ) / 2 + 1) AS INTEGER) *sc# CAST(((strftime('%m', SC." . $cmp_sql . ") -1 ) / 2 + 1) AS INTEGER)";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 2 + 1) AS NCHAR (1)) *sc# CAST(((MONTH(SC." . $cmp_sql . ") - 1) / 2 + 1) AS NCHAR (1))";
           }
           else {
               return "CAST(((MONTH(" . $cmp_sql . ") - 1) / 2 + 1) AS NCHAR (1)) *sc# CAST(((MONTH(SC." . $cmp_sql . ") - 1) / 2 + 1) AS NCHAR (1))";
           }
       }
   }
   function Get_sql_date_groupby($sql_def, $format)
   {
       if (empty($format))
       {
           return $sql_def;
       }
       if ($format != 'YYYYMMDDHHIISS')
       {
           return "";
       }
       $sql = $sql_def;
       return $sql;
   }
   function Get_arg_groupby($val, $format)
   {
       if ($format == 'YYYYMMDDHHIISS' && (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle)))
       {
           return substr($val, 0, 19) ; 
       }
       elseif ($format == 'YYYYMMDDHHII')
       {
           return substr($val, 0, 16) ; 
       }
       elseif ($format == 'YYYYMMDDHH')
       {
           return substr($val, 0, 13) ; 
       }
       elseif ($format == 'YYYYMMDD2')
       {
           return substr($val, 0, 10) ; 
       }
       elseif ($format == 'YYYYMM')
       {
           return substr($val, 0, 7) ; 
       }
       elseif ($format == 'YYYYHH')
       {
           returnsubstr($val, 0, 4) . substr($val, 11, 2); 
       }
       elseif ($format == 'YYYYSEMIANNUAL')
       {
           return substr($val, 0, 4) . $this->nm_data->GetSem(substr($val, 5, 2)); 
       }
       elseif ($format == 'YYYYFOURMONTHS')
       {
           return substr($val, 0, 4) . $this->nm_data->GetQuadr(substr($val, 5, 2)); 
       }
       elseif ($format == 'YYYYQUARTER')
       {
           return substr($val, 0, 4) . $this->nm_data->GetTrim(substr($val, 5, 2)); 
       }
       elseif ($format == 'YYYYBIMONTHLY')
       {
           return substr($val, 0, 4) . $this->nm_data->GetBim(substr($val, 5, 2)); 
       }
       elseif ($format == 'YYYYWEEK')
       {
           return substr($val, 0, 4) . $this->Get_Sql_Week($val); 
       }
       elseif ($format == 'YYYYDAYNAME')
       {
           return substr($val, 0, 4) . $this->Compat_WeekDay($val); 
       }
       elseif ($format == 'YYYY')
       {
           return substr($val, 0, 4) ; 
       }
       elseif ($format == 'SEMIANNUAL')
       {
           return $this->nm_data->GetSem(substr($val, 5, 2)); 
       }
       elseif ($format == 'FOURMONTHS')
       {
           return $this->nm_data->GetQuadr(substr($val, 5, 2)); 
       }
       elseif ($format == 'QUARTER')
       {
           return $this->nm_data->GetTrim(substr($val, 5, 2)); 
       }
       elseif ($format == 'BIMONTHLY')
       {
           return $this->nm_data->GetBim(substr($val, 5, 2)); 
       }
       elseif ($format == 'WEEK')
       {
           return $this->Get_Sql_Week($val); 
       }
       elseif ($format == 'DAYNAME')
       {
           return $this->Compat_WeekDay($val); 
       }
       elseif ($format == 'MM')
       {
           return substr($val, 5, 2); 
       }
       elseif ($format == 'DD')
       {
           return substr($val, 8, 2); 
       }
       elseif ($format == 'HH')
       {
           return substr($val, 11, 2); 
       }
       elseif ($format == 'HHIISS')
       {
           return substr($val, 11, 8); 
       }
       elseif ($format == 'HHII')
       {
           return substr($val, 11, 5); 
       }
       else
       {
           return $val; 
       }
   }
   function Get_format_dimension($ind_ini, $ind_qb, $campo, $rs, $conf_region="S", $mask="")
   {
       $retorno    = array();
       $format     = $this->Get_Gb_date_format($ind_qb, $campo);
       $Prefix_dat = $this->Get_Gb_prefix_date_format($ind_qb, $campo);
       if (empty($format) || $rs->fields[$ind_ini] == "")
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $rs->fields[$ind_ini];
           return $retorno;
       }
       if ($format == 'YYYYMMDDHHIISS')
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($rs->fields[$ind_ini], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDDHHII')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2,3,4");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2] . " " . $rs->fields[$ind_ini + 3] . ":" . $rs->fields[$ind_ini + 4];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDDHH')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2,3");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2] . " " . $rs->fields[$ind_ini + 3];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDD2')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMM')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYY')
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($rs->fields[$ind_ini], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'BIMONTHLY' || $format == 'QUARTER' || $format == 'FOURMONTHS' || $format == 'SEMIANNUAL' || $format == 'WEEK')
       {
           $temp            = (substr($rs->fields[$ind_ini], 0, 1) == 0) ? substr($rs->fields[$ind_ini], 1) : $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $Prefix_dat . $temp;
           return $retorno;
       }
       if ($format == 'DAYNAME'|| $format == 'YYYYDAYNAME')
       {
           if ($format == 'DAYNAME')
           {
               $retorno['orig'] = $rs->fields[$ind_ini];
               $ano             = "";
               $daynum          = $rs->fields[$ind_ini];
           }
           else
           {
               $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
               $ano             = " " . $rs->fields[$ind_ini];
               $daynum          = $rs->fields[$ind_ini + 1];
           }
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_progress))
           {
               $daynum--;
           }
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               $daynum = ($daynum == 6) ? 0 : $daynum + 1;
           }
           if ($daynum == 0) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_sund'] . $ano;
           }
           if ($daynum == 1) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_mond'] . $ano;
           }
           if ($daynum == 2) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_tued'] . $ano;
           }
           if ($daynum == 3) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_wend'] . $ano;
           }
           if ($daynum == 4) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_thud'] . $ano;
           }
           if ($daynum == 5) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_frid'] . $ano;
           }
           if ($daynum == 6) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_satd'] . $ano;
           }
           return $retorno;
       }
       if ($format == 'HH')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-00-00 " . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'DD')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-00-" . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'MM')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-" . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYY')
       {
           $temp            = $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYHH')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-00-00 " . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-00-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       elseif ($format == 'YYYYWEEK' || $format == 'YYYYBIMONTHLY' || $format == 'YYYYQUARTER' || $format == 'YYYYFOURMONTHS' || $format == 'YYYYSEMIANNUAL')
       {
           $temp            = (substr($rs->fields[$ind_ini + 1], 0, 1) == 0) ? substr($rs->fields[$ind_ini + 1], 1) : $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $Prefix_dat . $temp . " " . $rs->fields[$ind_ini];
           return $retorno;
       }
       if ($format == 'YYYYHH' || $format == 'YYYYDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $rs->fields[$ind_ini] . $_SESSION['scriptcase']['reg_conf']['date_sep'] . $rs->fields[$ind_ini + 1];
           return $retorno;
       }
       elseif ($format == 'HHIISS')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1,2");
           $retorno['orig'] = $rs->fields[$ind_ini] . ":" . $rs->fields[$ind_ini + 1] . ":" . $rs->fields[$ind_ini + 2];
           $retorno['fmt']  = $this->GB_date_format("0000-00-00 " . $retorno['orig'], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       elseif ($format == 'HHII')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1");
           $retorno['orig'] = $rs->fields[$ind_ini] . ":" . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format("0000-00-00 " . $retorno['orig'], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       else
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $rs->fields[$ind_ini];
           return $retorno;
       }
   }
   function Ajust_fields($ind_ini, &$rs, $parts)
   {
       $prep = explode(",", $parts);
       foreach ($prep as $ind)
       {
           $ind_ok = $ind_ini + $ind;
           $rs->fields[$ind_ok] = (int) $rs->fields[$ind_ok];
           if (strlen($rs->fields[$ind_ok]) == 1)
           {
               $rs->fields[$ind_ok] = "0" . $rs->fields[$ind_ok];
           }
       }
   }
   function Get_date_order_groupby($sql_def, $order, $format="", $order_old="")
   {
       $order      = " " . trim($order);
       $orderby_ok = "";
       if ($format == 'YYYYMMDDHHIISS' || $format == 'YYYYMMDDHHII' || $format == 'YYYYMMDDHH')
       {
           $orderby_ok .= $sql_def . $order;
       }
       elseif ($format == 'YYYYMMDD2')
       {
           $orderby_ok .= $this->Return_date_order_groupby('YYYY', $sql_def) . $order. "#@#";
           $orderby_ok .= $this->Return_date_order_groupby('MM', $sql_def) . $order. "#@#";
           $orderby_ok .= $this->Return_date_order_groupby('DD', $sql_def) . $order;
       }
       elseif ($format == 'YYYY' || $format == 'MM' || $format == 'DD' || $format == 'HH')
       {
           $orderby_ok .= $this->Return_date_order_groupby($format, $sql_def) . $order;
           if ($format == 'YYYY')
           {
               $orderby_ok .= "#@#" . $this->Return_date_order_groupby('MM', $sql_def) . $order;
           }
           if ($format == 'YYYY' || $format == 'MM')
           {
               $orderby_ok .= "#@#" . $this->Return_date_order_groupby('DD', $sql_def) . $order;
           }
       }
       elseif (substr($format, 0, 4) == 'YYYY')
       {
           $orderby_ok .= $this->Return_date_order_groupby('YYYY', $sql_def) . $order;
           if ($format == 'YYYYMM')
           {
               $orderby_ok .= "#@#" . $this->Return_date_order_groupby('MM', $sql_def) . $order;
           }
       }
       elseif ($format == 'SEMIANNUAL' || $format == 'FOURMONTHS' || $format == 'QUARTER' || $format == 'BIMONTHLY' || $format == 'WEEK' || $format == 'DAYNAME')
       {
           $orderby_ok .= $this->Return_date_order_groupby($format, $sql_def) . $order;
       }
       elseif ($format == 'HHIISS')
       {
           $orderby_ok .= $this->Return_date_order_groupby('HH', $sql_def) . $order. "#@#";
           $orderby_ok .= $this->Return_date_order_groupby('II', $sql_def) . $order. "#@#";
           $orderby_ok .= $this->Return_date_order_groupby('SS', $sql_def) . $order;
       }
       elseif ($format == 'HHII')
       {
           $orderby_ok .= $this->Return_date_order_groupby('HH', $sql_def) . $order. "#@#";
           $orderby_ok .= $this->Return_date_order_groupby('II', $sql_def) . $order;
       }
       else
       {
           $orderby_ok .= $sql_def . $order;
       }
       $tst_order = explode("#@#", $orderby_ok);
       foreach ($tst_order as $cada_tst)
       {
           $pos = strpos(" " . $order_old, $cada_tst);
           if ($pos === false)
           {
               $order_old .= (!empty($order_old)) ? ", " : "";
               $order_old .= $cada_tst;
           }
       }
       return $order_old;
   }
   function Return_date_order_groupby($format, $sql_def)
   {
       if ($format == 'YYYY')
       {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               return "YEAR(" . $sql_def . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite))
           {
               return "strftime('%Y'," . $sql_def . ")";
           }
           else
           {
               return "YEAR(" . $sql_def . ")";
           }
       }
       if ($format == 'MM')
       {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               return "MONTH(" . $sql_def . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite))
           {
               return "strftime('%m'," . $sql_def . ")";
           }
           else
           {
               return "MONTH(" . $sql_def . ")";
           }
       }
       if ($format == 'DD')
       {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               return "DAY(" . $sql_def . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite))
           {
               return "strftime('%d'," . $sql_def . ")";
           }
           else
           {
               return "DAY(" . $sql_def . ")";
           }
       }
       if ($format == 'HH')
       {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               return "hour(" . $sql_def . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite))
           {
               return "strftime('%H'," . $sql_def . ")";
           }
           else
           {
               return "hour(" . $sql_def . ")";
           }
       }
       if ($format == 'II')
       {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               return "minute(" . $sql_def . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite))
           {
               return "strftime('%M'," . $sql_def . ")";
           }
           else
           {
               return "minute(" . $sql_def . ")";
           }
       }
       if ($format == 'SS')
       {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               return "second(" . $sql_def . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite))
           {
               return "strftime('%S'," . $sql_def . ")";
           }
           else
           {
               return "second(" . $sql_def . ")";
           }
       }
       if ($format == 'WEEK')
       {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               return "WEEK(" . $sql_def . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite))
           {
               return "strftime('%W'," . $sql_def . ")";
           }
           else
           {
               return "week(" . $sql_def . ")";
           }
       }
       if ($format == 'DAYNAME')
       {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               return "WEEKDAY(" . $sql_def . ")";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite))
           {
               return "strftime('%w'," . $sql_def . ")";
           }
           else
           {
               return "weekday(" . $sql_def . ")";
           }
       }
       if ($format == 'SEMIANNUAL') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $sql_def . ") -1 ) / 6 + 1) AS INTEGER)";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "CAST(((MONTH(" . $sql_def . ") - 1) / 6 + 1) AS NCHAR (1))";
           }
           else {
               return "CAST(((MONTH(" . $sql_def . ") - 1) / 6 + 1) AS NCHAR (1))";
           }
       }
       if ($format == 'FOURMONTHS') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $sql_def . ") -1 ) / 4 + 1) AS INTEGER)";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "CAST(((MONTH(" . $sql_def . ") - 1) / 4 + 1) AS NCHAR (1))";
           }
           else {
               return "CAST(((MONTH(" . $sql_def . ") - 1) / 4 + 1) AS NCHAR (1))";
           }
       }
       if ($format == 'QUARTER') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $sql_def . ") -1 ) / 3 + 1) AS INTEGER)";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "QUARTER(" . $sql_def . ")";
           }
           else {
               return "CAST(((MONTH(" . $sql_def . ") - 1) / 3 + 1) AS NCHAR (1))";
           }
       }
       if ($format == 'BIMONTHLY') {
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
               return "CAST(((strftime('%m', " . $sql_def . ") -1 ) / 2 + 1) AS INTEGER)";
           }
           elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
               return "CAST(((MONTH(" . $sql_def . ") - 1) / 2 + 1) AS NCHAR (1))";
           }
           else {
               return "CAST(((MONTH(" . $sql_def . ") - 1) / 2 + 1) AS NCHAR (1))";
           }
       }
       return $order;
   }
   function Get_Sql_Week($val)
   {
       static $DT_in  = "";
       static $DT_out = "";
       if (empty($val))
       {
           return 0;
       }
       $sql_def = substr($val, 0, 10);
       if ($sql_def == $DT_in)
       {
           return $DT_out;
       }
       $DT_in  = $sql_def;
       $DT_out = 0;
       $sql_def = "'" . $sql_def . "'";
       if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
       {
           $cmd = "select WEEK(" . $sql_def . ")";
       }
       elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite))
       {
           $cmd = "select strftime('%W'," . $sql_def . ")";
       }
       else
       {
           $cmd = "select week(" . $sql_def . ")";
       }
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $cmd;
       $rweek = $this->Db->Execute($cmd);
       if (isset($rweek->fields[0]))
       { 
           $DT_out = $rweek->fields[0];
       } 
       $rweek->Close(); 
       return $DT_out;
   }
   function Compat_WeekDay($val)
   {
       $num = $this->nm_data->GetWeekDay($val);
       if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_progress))
       {
           $num++;
       }
       if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
       {
           $num = ($num == 0) ? 6 : $num - 1;
       }
       return $num;
   }
}
//===============================================================================
//
class reporte_tracking_sub_css
{
   function __construct()
   {
      global $script_case_init;
      $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "tracking/tracking";
      if ($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['SC_herda_css'] == "N")
      {
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css']['reporte_tracking']    = $str_schema_all . "_grid.css";
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css_bw']['reporte_tracking'] = $str_schema_all . "_grid_bw.css";
      }
   }
}
//
class reporte_tracking_apl
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Lookup;
   var $nm_location;
   var $NM_ajax_flag  = false;
   var $NM_ajax_opcao = '';
   var $grid;
   var $Res;
   var $Graf;
   var $pesq;
   var $pdf;
   var $xls;
   var $xml;
   var $csv;
   var $rtf;
//
//----- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini = $this->Ini;
      $this->$modulo->Db = $this->Db;
      $this->$modulo->Erro = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
      $this->$modulo->arr_buttons = $this->arr_buttons;
   }
//
//----- 
   function controle($linhas = 0)
   {
      global $nm_saida, $nm_url_saida, $script_case_init, $nmgp_parms_pdf, $nmgp_graf_pdf, $nm_apl_dependente, $nmgp_navegator_print, $nmgp_tipo_print, $nmgp_cor_print, $nmgp_cor_word, $Det_use_pass_pdf, $Det_pdf_zip, $NMSC_conf_apl, $NM_contr_var_session, $NM_run_iframe, $SC_module_export, $nmgp_password,
             $glo_senha_protect, $nmgp_opcao, $nm_call_php, $rec, $nmgp_quant_linhas, $nmgp_fast_search, $nmgp_cond_fast_search, $nmgp_arg_fast_search, $nmgp_ordem, $nmgp_parms_where;

      $Parms_form_pdf = false;
      if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['reporte_tracking']))
      { 
          $GLOBALS['nmgp_parms'] = $_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['reporte_tracking'];
          $Parms_form_pdf = true;
      } 
      if ($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'] || $Parms_form_pdf)
      { 
          if (!empty($GLOBALS['nmgp_parms'])) 
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
                       nm_limpa_str_reporte_tracking($cadapar[1]);
                       nm_protect_num_reporte_tracking($cadapar[0], $cadapar[1]);
                       if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                       $Tmp_par   = $cadapar[0];
                       $$Tmp_par = $cadapar[1];
                       if ($Tmp_par == "nmgp_opcao")
                       {
                           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] = $cadapar[1];
                       }
                   }
              }
          } 
      } 
      if ($Parms_form_pdf)
      { 
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_pdf'] = true;
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form'] = true;
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_full'] = false;
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_pai'] = "";
      } 
      $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      if (!$this->Ini) 
      { 
          $this->Ini = new reporte_tracking_ini(); 
          $this->Ini->init();
      } 
      $this->Ini->Proc_print      = false;
      $this->Ini->Export_det_zip  = false;
      $this->Ini->Export_html_zip = false;
      $this->Ini->Export_img_zip  = false;
      $this->Ini->Img_export_zip  = array();
      $this->Ini->Embutida_iframe = (strpos($this->Ini->sc_page, "-") !== false) ? true : false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['emb_lig_aba'] = array();
      $this->Change_Menu = false;
      if (!isset($nmgp_opcao)) {
         $nmgp_opcao = "";
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'])) {
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "";
      }
       if ($nmgp_opcao == "link_res")  
       { 
           $nmgp_opcao = "inicio";  
           $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "inicio";  
           $Temp_parms = "";  
           $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms_where);
           $todox = stripslashes($todox);
           $todo  = explode("?@?", $todox);
           foreach ($todo as $param)
           {
                $cadapar  = explode("?#?", $param);
                if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'] == "status")
                { 
                    $Temp_parms .= (empty($Temp_parms)) ? "" : " and ";
                    if ($cadapar[0] == "appointment_start_date")
                    {
                        $cadapar[1]  = str_replace("@aspass@", "", $cadapar[1]);
                        $Format_tst  = $this->Ini->Get_Gb_date_format('status', 'appointment_start_date');
                        $Temp_arg    = $this->Ini->Get_date_arg_sum($cadapar[1], $Format_tst, $cadapar[0], true);
                        $Temp_sql    = ($Temp_arg == " is null") ? $cadapar[0] : $this->Ini->Get_sql_date_groupby($cadapar[0], $Format_tst);
                        $Temp_parms .= $Temp_sql;
                        $Temp_parms .= $Temp_arg;
                    }
                    else
                    {
                        $Tmp_pos = strpos($cadapar[1], "@aspass@");
                        $cadapar[1] = str_replace("@aspass@", "", $cadapar[1]);
                        if ($Tmp_pos !== false)
                        {
                            $cadapar[1] = $this->Ini->Db->qstr($cadapar[1]);
                        }
                        if ($cadapar[1] == "__SCNULL__" || $cadapar[1] == "'__SCNULL__'")
                        {
                            $Temp_parms .= $cadapar[0] . " is null" ;
                        }
                        else
                        {
                            $Temp_parms .= $cadapar[0] . " = " . $cadapar[1];
                        }
                    }
                } 
                if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'] == "sc_free_group_by")
                { 
                    $Temp_parms .= (empty($Temp_parms)) ? "" : " and ";
                    if ($cadapar[0] == "appointment_start_date")
                    {
                        $cadapar[1]  = str_replace("@aspass@", "", $cadapar[1]);
                        $Format_tst  = $this->Ini->Get_Gb_date_format('sc_free_group_by', 'appointment_start_date');
                        $Temp_arg    = $this->Ini->Get_date_arg_sum($cadapar[1], $Format_tst, $cadapar[0], true);
                        $Temp_sql    = ($Temp_arg == " is null") ? $cadapar[0] : $this->Ini->Get_sql_date_groupby($cadapar[0], $Format_tst);
                        $Temp_parms .= $Temp_sql;
                        $Temp_parms .= $Temp_arg;
                    }
                    elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_orig'][$cadapar[0]]))
                    {
                        list ($Sql_orig, $Sql_order) = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_sql'][$cadapar[0]];
                        $cadapar[1]  = str_replace("@aspass@", "", $cadapar[1]);
                        $Format_tst  = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cadapar[0]);
                        $Temp_arg    = $this->Ini->Get_date_arg_sum($cadapar[1], $Format_tst, $Sql_orig, true);
                        $Temp_sql    = ($Temp_arg == " is null") ? $Sql_orig : $this->Ini->Get_sql_date_groupby($Sql_orig, $Format_tst);
                        $Temp_parms .= $Temp_sql;
                        $Temp_parms .= $Temp_arg;
                    }
                    else
                    {
                        $Tmp_pos = strpos($cadapar[1], "@aspass@");
                        $cadapar[1] = str_replace("@aspass@", "", $cadapar[1]);
                        if ($Tmp_pos !== false)
                        {
                            $cadapar[1] = $this->Ini->Db->qstr($cadapar[1]);
                        }
                        if ($cadapar[1] == "__SCNULL__" || $cadapar[1] == "'__SCNULL__'")
                        {
                            $Temp_parms .= $cadapar[0] . " is null" ;
                        }
                        else
                        {
                            $Temp_parms .= $cadapar[0] . " = " . $cadapar[1];
                        }
                    }
                } 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_resumo'] = $Temp_parms;
       } 
      if ($nmgp_opcao != "ajax_navigate" && $nmgp_opcao != "ajax_detalhe" && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sc_outra_jan'] || $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sc_modal']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['reporte_tracking']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['reporte_tracking'];
          }
          elseif (isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']]))
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']] as $init => $resto)
              {
                  if ($this->Ini->sc_page == $init)
                  {
                      $this->sc_init_menu = $init;
                      break;
                  }
              }
          }
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'] && $this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['reporte_tracking']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['reporte_tracking']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('reporte_tracking') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['reporte_tracking']['label'] = "REPORTE DE HORAS APROBADAS";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "reporte_tracking")
                  {
                      $achou = true;
                  }
                  elseif ($achou)
                  {
                      unset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu][$apl]);
                      $this->Change_Menu = true;
                  }
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
      {
          $this->Change_Menu = false;
      }
      $this->Db = $this->Ini->Db; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['nm_tpbanco'] = $this->Ini->nm_tpbanco;
      $this->nm_data = new nm_data("es");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
      { 
          include_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_erro.class.php"); 
      } 
      else 
      { 
          include_once($this->Ini->path_aplicacao . "reporte_tracking_erro.class.php"); 
      } 
      $this->Erro      = new reporte_tracking_erro();
      $this->Erro->Ini = $this->Ini;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
      { 
          require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_lookup.class.php"); 
      } 
      else 
      { 
          require_once($this->Ini->path_aplicacao . "reporte_tracking_lookup.class.php"); 
      } 
      $this->Lookup       = new reporte_tracking_lookup();
      $this->Lookup->Db   = $this->Db;
      $this->Lookup->Ini  = $this->Ini;
      $this->Lookup->Erro = $this->Erro;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
      {
          $this->Ini->sc_Include($this->Ini->path_libs . "/nm_trata_saida.php", "C", "nm_trata_saida") ; 
          $nm_saida = new nm_trata_saida();
          $ajax_opc_print = false;
          if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_export")
          {
              $this->Ini->sc_export_ajax = true;
              $this->Ini->Arr_result     = array();
              $nmgp_opcao                = $_POST['export_opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = $nmgp_opcao;
              if ($nmgp_opcao == "print" || $nmgp_opcao == "res_print" || $nmgp_opcao == "det_print")
              {
                  $ajax_opc_print   = true;
                  $nm_arquivo_print = "/sc_reporte_tracking_" . session_id();
                  $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_print . ".html");
                  $this->Ini->sc_export_ajax_img = true;
              }
              ob_start();
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
      {
          $_SESSION['scriptcase']['saida_var'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ajax_nav'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['scroll_navigate'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['scroll_navigate_reload'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['scroll_navigate_app'] = false;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['scroll_navigate_header_row']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['scroll_navigate_header_row'] = 1;
          }
          if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_navigate" || $_POST['nmgp_opcao'] == "ajax_detalhe"))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ajax_nav'] = true;
              $_SESSION['scriptcase']['saida_var']  = true;
              $_SESSION['scriptcase']['saida_html'] = "";
              $this->Ini->Arr_result = array();
              $nmgp_opcao = $_POST['opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = $nmgp_opcao;
              if (isset($_POST['parm']) && $_POST['parm'] == "save_grid")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['save_grid'] = true;
              }
              if ($nmgp_opcao == "edit" && isset($_POST['parm']) && $_POST['parm'] == "fim")
              {
                  $rec = $_POST['parm'];
              }
              if ($nmgp_opcao == "rec" || $nmgp_opcao == "muda_rec_linhas")
              {
                  $rec = $_POST['parm'];
              }
              if ($nmgp_opcao == "muda_qt_linhas")
              {
                  $nmgp_quant_linhas  = strtolower($_POST['parm']);
              }
              if (($_POST['opc'] == "igual" || $_POST['opc'] == "resumo") && isset($_POST['parm']) && ($_POST['parm'] == "reload" || $_POST['parm'] == "breload"))
              {
                  $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['contr_total_geral'] = "NAO";
                  $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['contr_array_resumo'] = "NAO";
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['tot_geral']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['arr_total']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pivot_group_by']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pivot_x_axys']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pivot_y_axys']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pivot_fill']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pivot_order']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pivot_order_col']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pivot_order_level']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pivot_order_sort']);
                  unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pivot_tabular']);
              }
              if ($nmgp_opcao == "fast_search")
              {
                  $_POST['parm'] = str_replace("__NM_PLUS__", "+", $_POST['parm']);
                  $_POST['parm'] = str_replace("__NM_AMP__", "&", $_POST['parm']);
                  $_POST['parm'] = str_replace("__NM_PRC__", "%", $_POST['parm']);
                  $temp = explode("_SCQS_", $_POST['parm']);
                  $nmgp_fast_search      = (isset($temp[0])) ? $temp[0] : "";
                  $nmgp_cond_fast_search = (isset($temp[1])) ? $temp[1] : "";
                  $nmgp_arg_fast_search  = (isset($temp[2])) ? $temp[2] : "";
              }
              if ($nmgp_opcao == "ordem")
              {
                  $nmgp_ordem = $_POST['parm'];
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_date_format'])) 
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_date_format'] = array();
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_prefix_date_format']['status']['appointment_start_date'] = "" . $this->Ini->Nm_lang['lang_othr_valueYYYYMM'] . "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_date_format']['status']['appointment_start_date'])) 
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_date_format']['status']['appointment_start_date'] = 'YYYYMM';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_def_sql']['status']['appointment_start_date'] = 'appointment_start_date';
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_prefix_date_format']['sc_free_group_by']['appointment_start_date'] = "" . $this->Ini->Nm_lang['lang_othr_valueYYYYMM'] . "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_date_format']['sc_free_group_by']['appointment_start_date'])) 
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_date_format']['sc_free_group_by']['appointment_start_date'] = 'YYYYMM';
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_All_Groupby'] = array('status' => 'all', 'sc_free_group_by' => 'all');
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Groupby_hide'])) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Groupby_hide'] = array();
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'])) 
      { 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_All_Groupby'] as $Ind => $Tp)
          {
              if ($Tp == "grid")
              {
                  continue;
              }
              if (!in_array($Ind, $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Groupby_hide'])) 
              { 
                  break;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'] = $Ind;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_cmp'])) 
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_cmp']  = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_sql']  = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_orig'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_cmp']['appointment_start_date'] = "appointment_start_date";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_sql']['appointment_start_date']["appointment_start_date"] = 'asc';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_cmp']['id_usuario'] = "id_usuario";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_sql']['id_usuario']["id_usuario"] = 'asc';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_cmp']['id_proyecto'] = "id_proyecto";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_sql']['id_proyecto']["id_proyecto"] = 'asc';
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Labels_GB'] = array();
      if  ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'] == "status")
      {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Labels_GB'][] = sprintf("" . $this->Ini->Nm_lang['lang_othr_cons_title_YYYYMM'] . "", "Fecha");
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Labels_GB'][] = "Usuario";
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Labels_GB'][] = "Proyecto";
      }
      if  ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'] == "sc_free_group_by")
      {
          $Arr_free_labels = array();
          $Arr_free_labels['appointment_start_date'] = "" . sprintf("" . $this->Ini->Nm_lang['lang_othr_cons_title_YYYYMM'] . "", "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . "") . "";
          $Arr_free_labels['id_usuario'] = "Usuario";
          $Arr_free_labels['id_actividad'] = "Tipo Actividad";
          $Arr_free_labels['id_proyecto'] = "Proyecto";
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_cmp'] as $Field => $Label)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Labels_GB'][] = $Arr_free_labels[$Field];
          }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_display']['status']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_display']['status'][2] = array('label' => "Horas", 'display' => true);
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_order']['status'][] = 2;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_control']['status']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_control']['status'] = array(
               array(
                   'cmp_res' => "intervalo",
                   'label' => "Horas",
                   'label_field' => "Intervalo (horas)",
                   'options' => array(
                       array('op' => 'S', 'index' => '2', 'label' => "" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "", 'abbrev' => "Sum"),
                   ),
                   'select' => "<select class=\"sc-ui-select-intervalo\" onChange=\"scSummChange($(this))\"><option value=\"2\" class=\"sc-ui-select-option-S\">" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "</option></select>",
               ),
           );
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_display']['sc_free_group_by']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_display']['sc_free_group_by'][2] = array('label' => "Horas", 'display' => true);
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_order']['sc_free_group_by'][] = 2;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_control']['sc_free_group_by']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_control']['sc_free_group_by'] = array(
               array(
                   'cmp_res' => "intervalo",
                   'label' => "Horas",
                   'label_field' => "Intervalo (horas)",
                   'options' => array(
                       array('op' => 'S', 'index' => '2', 'label' => "" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "", 'abbrev' => "Sum"),
                   ),
                   'select' => "<select class=\"sc-ui-select-intervalo\" onChange=\"scSummChange($(this))\"><option value=\"2\" class=\"sc-ui-select-option-S\">" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "</option></select>",
               ),
           );
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['all']['SC_Ind_Groupby'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['all']['SC_Ind_Groupby'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_cmp']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_cmp'];
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['res']['summarizing_fields_display'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['res']['summarizing_fields_order']   = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['res']['summarizing_fields_control'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['res']['pivot_x_axys']               = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_display']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['res']['summarizing_fields_display'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_display'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_order']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['res']['summarizing_fields_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_order'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_control']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['res']['summarizing_fields_control'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['summarizing_fields_control'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pivot_x_axys']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dados_orig_gb']['res']['pivot_x_axys'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pivot_x_axys'];
          }
      }
      $this->Ini->Apl_resumo  = "reporte_tracking_resumo_" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'] . ".class.php"; 
      $this->Ini->Apl_grafico = "reporte_tracking_grafico_" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'] . ".class.php"; 
      $_SESSION['sc_session']['path_third'] = $this->Ini->path_prod . "/third";
      $_SESSION['sc_session']['real_path_third'] = $this->Ini->path_third;
      $_SESSION['sc_session']['path_prod']  = $this->Ini->path_prod . "/third";
      $_SESSION['sc_session']['path_img']   = $this->Ini->path_img_global;
      $_SESSION['sc_session']['path_libs']  = $this->Ini->path_libs;
      if (is_dir($this->Ini->path_aplicacao . 'img'))
      {
          $Res_dir_img = @opendir($this->Ini->path_aplicacao . 'img');
          if ($Res_dir_img)
          {
              while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
              {
                 if (@is_file($this->Ini->path_aplicacao . 'img/' . $Str_arquivo) && '.' != $Str_arquivo && '..' != $this->Ini->path_aplicacao . 'img/' . $Str_arquivo)
                 {
                     @unlink($this->Ini->path_aplicacao . 'img/' . $Str_arquivo);
                 }
              }
          }
          @closedir($Res_dir_img);
          rmdir($this->Ini->path_aplicacao . 'img');
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['xls_return']  = ($nmgp_opcao == "xls")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['csv_return']  = ($nmgp_opcao == "csv")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['xml_return']  = ($nmgp_opcao == "xml")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['json_return'] = ($nmgp_opcao == "json") ? "volta_grid" : "resumo"; 
      $this->Ini->SC_module_export = (isset($SC_module_export) && !empty($SC_module_export)) ? $SC_module_export : "grid,resume,chart"; 
      if ($nmgp_opcao == 'pdf')
      { 
          $this->Ini->SC_module_export = "grid,resume,chart";
      }
      elseif ($nmgp_opcao == 'print')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      elseif ($nmgp_opcao == 'xls')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      elseif ($nmgp_opcao == 'pdf_res')
      { 
          $this->Ini->SC_module_export = "resume,chart";
      }
      elseif ($nmgp_opcao == 'res_print')
      { 
          $this->Ini->SC_module_export = "resume";
      }
      elseif ($nmgp_opcao == 'xls_res')
      { 
          $this->Ini->SC_module_export = "resume";
      }
      if ($nmgp_opcao == 'print' || $nmgp_opcao == 'res_print') {
          $this->Ini->Proc_print = true;
          $_SESSION['scriptcase']['proc_mobile'] = false;
          if ($nmgp_opcao == 'print') {
              $this->ret_print = "volta_grid";
          }
          else {
              $this->ret_print = "resumo";
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['print_return'] = $this->ret_print;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
      {
          if ($this->Ini->Export_html_zip)
          {
              $this->Ini->Export_img_zip = true;
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['html_name']))
              {
                  $nm_arquivo_html = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['html_name'];
              }
              elseif ($nmgp_opcao == 'print' && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
              {
                  $nm_arquivo_html = "/sc_reporte_tracking_" . session_id() . ".html";
              }
              else
              {
                  $nm_arquivo_html = "/sc_reporte_tracking_res_" . session_id() . ".html";
              }
              $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html);
          }
      }
      if ($nmgp_opcao == "doc_word") {  
          $this->ret_word = "volta_grid";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res") {  
          $this->ret_word = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "doc_word"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "doc_word"; 
      }
      elseif ($nmgp_opcao == "doc_word" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "doc_word_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "doc_word_res"; 
      }
      if ($nmgp_opcao == "xls_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xls"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "xls"; 
      }
      elseif ($nmgp_opcao == "xls" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xls_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "xls_res"; 
      }
      if ($nmgp_opcao == "csv_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "csv"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "csv"; 
      }
      elseif ($nmgp_opcao == "csv" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "csv_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "csv_res"; 
      }
      if ($nmgp_opcao == "xml_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xml"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "xml"; 
      }
      elseif ($nmgp_opcao == "xml" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xml_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "xml_res"; 
      }
      if ($nmgp_opcao == "json_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "json"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "json"; 
      }
      elseif ($nmgp_opcao == "json" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "json_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "json_res"; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_det'] = false;
      if ($nmgp_opcao == 'pdf')
      { 
          if (strpos(" " . $this->Ini->SC_module_export, "grid") === false && (strpos(" " . $this->Ini->SC_module_export, "resume") !== false || strpos(" " . $this->Ini->SC_module_export, "chart") !== false))
          { 
              $nmgp_opcao = 'pdf_res';
          } 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_res'] = false;
      if ($nmgp_opcao == 'pdf_res')
      {
          if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = 'pdf';
              $nmgp_opcao = 'pdf';
          }
          else
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_res'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = 'pdf';
              $nmgp_opcao = 'pdf';
              $rRFP = fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp', "w");
              fwrite($rRFP, "PDF\n");
              fwrite($rRFP, "\n");
              fwrite($rRFP, "\n");
              fwrite($rRFP, "100\n");
              $lang_protect = $this->Ini->Nm_lang['lang_pdff_gnrt'];
              if (!NM_is_utf8($lang_protect))
              {
                  $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              fwrite($rRFP, 90 . "_#NM#_" . $lang_protect . "...\n");
              fclose($rRFP);
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['conf_chart_level'] = "N";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['graf_disp']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['graf_disp']        = array('Bar', 'Pie');
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_tipo']        = 'Bar';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_larg']        = '800';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_alt']         = '600';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['graf_opc_atual']   = '1';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['graf_mod_allowed'] = array(1, 2);
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['graf_order']       = '';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_font'] = '';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['graf_subtitle_val'] = 'below';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['chartpallet']       = '1';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['graf_exibe_val']    = '1';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['paletteColors']     = '';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_barra_orien'] = 'Vertical';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_barra_forma'] = 'Bar';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_barra_dimen'] = '3d';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_barra_sobre'] = 'No';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_barra_empil'] = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_barra_inver'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_barra_agrup'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_barra_funil'] = 'N';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_pizza_forma'] = 'Pie';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_pizza_dimen'] = '3d';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_pizza_orden'] = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_pizza_explo'] = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_pizza_valor'] = 'Valor';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_linha_forma'] = 'Line';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_linha_inver'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_linha_agrup'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_area_forma']  = 'Area';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_area_empil']  = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_area_inver']  = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_area_agrup']  = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_marca_inver'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_marca_agrup'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_gauge_forma'] = 'Circular';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_radar_forma'] = 'Line';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_radar_empil'] = 'Off';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_polar_forma'] = 'Line';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_funil_dimen'] = '3d';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_funil_inver'] = 'Normal';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_pyram_dimen'] = '3d';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_pyram_valor'] = 'Valor';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cfg_graf']['graf_pyram_forma'] = 'S';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida']      = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_grid']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_grid'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_init']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_init'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_label']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_label'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cab_embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cab_embutida'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_pdf']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_pdf'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_treeview']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_treeview'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_opcao']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida_opcao'] = "";
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['proc_pdf']      = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['proc_pdf_vert'] = false;
      include("../_lib/css/" . $this->Ini->str_schema_all . "_grid.php");
      $this->Ini->Tree_img_col    = trim($str_tree_col);
      $this->Ini->Tree_img_exp    = trim($str_tree_exp);
      $this->Ini->scGridRefinedSearchExpandFAIcon    = trim($scGridRefinedSearchExpandFAIcon);
      $this->Ini->scGridRefinedSearchCollapseFAIcon    = trim($scGridRefinedSearchCollapseFAIcon);
      $this->Ini->str_chart_theme = (isset($str_chart_theme)?$str_chart_theme:'');
      $this->Ini->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Ini->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      $this->arr_buttons['group_group_1']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_img",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__gear.png",
          'fontawesomeicon'  => "",
          'has_fa'           => false,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_1']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_img",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__gear.png",
          'fontawesomeicon'  => "",
          'has_fa'           => false,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_2']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_settings'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_settings'] . "",
          'type'             => "button",
          'display'          => "text_img",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__gear.png",
          'fontawesomeicon'  => "",
          'has_fa'           => false,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_1']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_img",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__gear.png",
          'fontawesomeicon'  => "",
          'has_fa'           => false,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_2']= array(
          'value'            => "Filtros",
          'hint'             => "",
          'type'             => "button",
          'display'          => "only_text",
          'display_position' => "text_right",
          'image'            => "",
          'fontawesomeicon'  => "",
          'has_fa'           => false,
          'content_icons'    => false,
          'style'            => "default",
      );

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
      { 
      $this->Ini->Img_sep_grid             = "/" . trim($str_toolbar_separator);
      $this->Ini->grid_table_width         = (!isset($str_grid_table_width) || "" == trim($str_grid_table_width)) ? "" : $str_grid_table_width;
      $this->Ini->Label_sort_pos           = trim($str_label_sort_pos);
      $this->Ini->Label_sort               = trim($str_label_sort);
      $this->Ini->Label_sort_asc           = trim($str_label_sort_asc);
      $this->Ini->Label_sort_desc          = trim($str_label_sort_desc);
      $this->Ini->Label_summary_sort_pos   = trim($str_resume_label_sort_pos);
      $this->Ini->Label_summary_sort       = trim($str_resume_label_sort);
      $this->Ini->Label_summary_sort_asc   = trim($str_resume_label_sort_asc);
      $this->Ini->Label_summary_sort_desc  = trim($str_resume_label_sort_desc);
      $this->Ini->Sum_ico_line             = trim($sum_ico_line);
      $this->Ini->Sum_ico_column           = trim($sum_ico_column);
      $this->Ini->ajax_div_icon            = trim($ajax_div_icon);
      $this->Ini->Str_toolbarnav_separator = '/' . trim($str_toolbarnav_separator);
      $this->Ini->Img_qs_search            = '' != trim($img_qs_search)        ? trim($img_qs_search)        : 'scriptcase__NM__qs_lupa.png';
      $this->Ini->Img_qs_clean             = '' != trim($img_qs_clean)         ? trim($img_qs_clean)         : 'scriptcase__NM__qs_close.png';
      $this->Ini->Str_qs_image_padding     = '' != trim($str_qs_image_padding) ? trim($str_qs_image_padding) : '0';
      $this->Ini->App_div_tree_img_col     = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp     = trim($app_div_str_tree_exp);
      $this->Ini->refinedsearch_hide           = trim($refinedsearch_hide);
      $this->Ini->refinedsearch_show          = trim($refinedsearch_show);
      $this->Ini->refinedsearch_close          = trim($refinedsearch_close);
      $this->Ini->refinedsearch_values_separator          = trim($refinedsearch_values_separator);
      $this->Ini->refinedsearch_campo_close_icon          = trim($refinedsearch_campo_close_icon);
          $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_config_btn.php", "F", "nmButtonOutput") ; 
          $_SESSION['scriptcase']['css_popup']                 = $this->Ini->str_schema_all . "_grid.css";
          $_SESSION['scriptcase']['css_popup_dir']             = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['css_btn_popup']             = $this->Ini->Str_btn_css;
          $_SESSION['scriptcase']['str_google_fonts']          = $this->Ini->str_google_fonts;
          $_SESSION['scriptcase']['css_popup_tab']             = $this->Ini->str_schema_all . "_tab.css";
          $_SESSION['scriptcase']['css_popup_tab_dir']         = $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['css_popup_div']             = $this->Ini->str_schema_all . "_appdiv.css";
          $_SESSION['scriptcase']['css_popup_div_dir']         = $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['bg_btn_popup']['bok']       = nmButtonOutput($this->arr_buttons, "bok_appdiv", "processa();", "processa();", "bok", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $_SESSION['scriptcase']['bg_btn_popup']['bsair']     = nmButtonOutput($this->arr_buttons, "bsair_appdiv", "window.close()", "window.close()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $_SESSION['scriptcase']['bg_btn_popup']['btbremove'] = nmButtonOutput($this->arr_buttons, "bsair_appdiv", "self.parent.tb_remove()", "self.parent.tb_remove()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "id_proyecto";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "id_usuario";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "id_actividad";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "nombre";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "current_status_id";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "appointment_start_date";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "appointment_start_time";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "appointment_end_time";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "intervalo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'][] = "appointments_id";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'];
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['usr_cmp_sel']))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['usr_cmp_sel'] = array();
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['usr_cmp_sel']['appointments_id'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['usr_cmp_sel_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['usr_cmp_sel'];
      } 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['reporte_tracking']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['reporte_tracking']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['reporte_tracking']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }

      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      nm_gc($this->Ini->path_libs);
      if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_page_process'] = $this->Ini->sc_page;
      } 
      $_SESSION['scriptcase']['sc_idioma_pivot']['es'] = array(
          'smry_ppup_titl'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_titl'],
          'smry_ppup_fild'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_fild'],
          'smry_ppup_posi'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi'],
          'smry_ppup_sort'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort'],
          'smry_ppup_posi_labl' => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi_labl'],
          'smry_ppup_posi_data' => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi_data'],
          'smry_ppup_sort_labl' => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort_labl'],
          'smry_ppup_sort_vlue' => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort_vlue'],
          'smry_ppup_chek_tabu' => $this->Ini->Nm_lang['lang_othr_smry_ppup_chek_tabu'],
      );
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                  $this->Ini->Nm_lang['lang_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_mnth_june'],
                                  $this->Ini->Nm_lang['lang_mnth_july'],
                                  $this->Ini->Nm_lang['lang_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                  $this->Ini->Nm_lang['lang_days_sund'],
                                  $this->Ini->Nm_lang['lang_days_mond'],
                                  $this->Ini->Nm_lang['lang_days_tued'],
                                  $this->Ini->Nm_lang['lang_days_wend'],
                                  $this->Ini->Nm_lang['lang_days_thud'],
                                  $this->Ini->Nm_lang['lang_days_frid'],
                                  $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                  $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                  $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                  $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                  $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                  $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                  $this->Ini->Nm_lang['lang_shrt_days_satd']);
      if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'])
      { 
          $this->pdf_zip = (isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opc_pdf']['pdf_zip'])) ? $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opc_pdf']['pdf_zip'] : "N";
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['use_pass_pdf'] = "";
          $_SESSION['scriptcase']['sc_tp_pdf'] = "wkhtmltopdf";
          $_SESSION['scriptcase']['sc_idioma_pdf'] = array();
          $_SESSION['scriptcase']['sc_idioma_pdf']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_pdff_titl'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'tp_imp' => $this->Ini->Nm_lang['lang_pdff_type'], 'color' => $this->Ini->Nm_lang['lang_pdff_colr'], 'econm' => $this->Ini->Nm_lang['lang_pdff_bndw'], 'tp_pap' => $this->Ini->Nm_lang['lang_pdff_pper'], 'carta' => $this->Ini->Nm_lang['lang_pdff_letr'], 'oficio' => $this->Ini->Nm_lang['lang_pdff_legl'], 'customiz' => $this->Ini->Nm_lang['lang_pdff_cstm'], 'alt_papel' => $this->Ini->Nm_lang['lang_pdff_pper_hgth'], 'larg_papel' => $this->Ini->Nm_lang['lang_pdff_pper_wdth'], 'orient' => $this->Ini->Nm_lang['lang_pdff_pper_orie'], 'retrato' => $this->Ini->Nm_lang['lang_pdff_prtr'], 'paisag' => $this->Ini->Nm_lang['lang_pdff_lnds'], 'book' => $this->Ini->Nm_lang['lang_pdff_bkmk'], 'grafico' => $this->Ini->Nm_lang['lang_pdff_chrt'], 'largura' => $this->Ini->Nm_lang['lang_pdff_wdth'], 'fonte' => $this->Ini->Nm_lang['lang_pdff_font'], 'create' => $this->Ini->Nm_lang['lang_pdff_create'], 'sim' => $this->Ini->Nm_lang['lang_pdff_chrt_yess'], 'nao' => $this->Ini->Nm_lang['lang_pdff_chrt_nooo'], 'chart_level' => $this->Ini->Nm_lang['lang_chart_level_groupby'], 'chart_level' => $this->Ini->Nm_lang['lang_chart_level_groupby'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'group_chart' => $this->Ini->Nm_lang['lang_pdff_group_chart'], 'pdf_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'pdf_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd'], 'page_break' => $this->Ini->Nm_lang['lang_groupby_break_page_pdf'], 'other_options' => $this->Ini->Nm_lang['lang_app_other_options'], 'label_group' => $this->Ini->Nm_lang['lang_pdf_below_groupby'], 'page_label' => $this->Ini->Nm_lang['lang_pdf_all_pages_title'], 'page_header' => $this->Ini->Nm_lang['lang_pdf_all_pages_header'], 'format_zip' => $this->Ini->Nm_lang['lang_export_pdf_zip'], 'cancela' => $this->Ini->Nm_lang['lang_pdff_cncl']);
      } 
      $_SESSION['scriptcase']['sc_idioma_graf_flash'] = array();
      $_SESSION['scriptcase']['sc_idioma_graf_flash']['es'] = array(
          'titulo' => $this->Ini->Nm_lang['lang_chrt_titl'],
          'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'],
          'tipo_g' => $this->Ini->Nm_lang['lang_chrt_type'],
          'tp_barra' => $this->Ini->Nm_lang['lang_flsh_chrt_bars'],
          'tp_pizza' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie'],
          'tp_linha' => $this->Ini->Nm_lang['lang_flsh_chrt_line'],
          'tp_area' => $this->Ini->Nm_lang['lang_flsh_chrt_area'],
          'tp_marcador' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks'],
          'tp_gauge' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug'],
          'tp_radar' => $this->Ini->Nm_lang['lang_flsh_chrt_radr'],
          'tp_polar' => $this->Ini->Nm_lang['lang_flsh_chrt_polr'],
          'tp_funil' => $this->Ini->Nm_lang['lang_flsh_chrt_funl'],
          'tp_pyramid' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm'],
          'largura' => $this->Ini->Nm_lang['lang_chrt_wdth'],
          'altura' => $this->Ini->Nm_lang['lang_chrt_hgth'],
          'modo_gera' => $this->Ini->Nm_lang['lang_chrt_gtmd'],
          'sintetico' => $this->Ini->Nm_lang['lang_chrt_smzd'],
          'analitico' => $this->Ini->Nm_lang['lang_chrt_anlt'],
          'order' => $this->Ini->Nm_lang['lang_chrt_ordr'],
          'order_none' => $this->Ini->Nm_lang['lang_chrt_ordr_none'],
          'order_asc' => $this->Ini->Nm_lang['lang_chrt_ordr_asc'],
          'order_desc' => $this->Ini->Nm_lang['lang_chrt_ordr_desc'],
          'barra_orien' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_layo'],
          'barra_orien_horiz' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_horz'],
          'barra_orien_verti' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_vrtc'],
          'barra_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_shpe'],
          'barra_forma_barra' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_bars'],
          'barra_forma_cilin' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_cyld'],
          'barra_forma_cone' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_cone'],
          'barra_forma_piram' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_pyrm'],
          'barra_dimen' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_dmns'],
          'barra_dimen_2d' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_2ddm'],
          'barra_dimen_3d' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ddm'],
          'barra_sobre' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ovr'],
          'barra_sobre_nao' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ont'],
          'barra_sobre_sim' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3oys'],
          'barra_empil' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stck'],
          'barra_empil_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stan'],
          'barra_empil_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stay'],
          'barra_empil_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stap'],
          'barra_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invr'],
          'barra_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invn'],
          'barra_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invi'],
          'barra_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srgr'],
          'barra_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srst'],
          'barra_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srbs'],
          'barra_funil' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_funl'],
          'barra_funil_nao' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ont'],
          'barra_funil_sim' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3oys'],
          'pizza_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_shpe'],
          'pizza_forma_pizza' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fpie'],
          'pizza_forma_donut' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dnts'],
          'pizza_dimen' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dmns'],
          'pizza_dimen_2d' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_2ddm'],
          'pizza_dimen_3d' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_3ddm'],
          'pizza_orden' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_srtn'],
          'pizza_orden_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_nsrt'],
          'pizza_orden_ascen' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_asrt'],
          'pizza_orden_desce' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dsrt'],
          'pizza_explo' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_expl'],
          'pizza_explo_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dxpl'],
          'pizza_explo_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_axpl'],
          'pizza_explo_click' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_cxpl'],
          'pizza_valor' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fval'],
          'pizza_valor_valor' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fvlv'],
          'pizza_valor_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fvlp'],
          'linha_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_line_shpe'],
          'linha_forma_linha' => $this->Ini->Nm_lang['lang_flsh_chrt_line_line'],
          'linha_forma_splin' => $this->Ini->Nm_lang['lang_flsh_chrt_line_spln'],
          'linha_forma_degra' => $this->Ini->Nm_lang['lang_flsh_chrt_line_step'],
          'linha_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invr'],
          'linha_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invn'],
          'linha_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invi'],
          'linha_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srgr'],
          'linha_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srst'],
          'linha_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srbs'],
          'area_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_area_shpe'],
          'area_forma_area' => $this->Ini->Nm_lang['lang_flsh_chrt_area_area'],
          'area_forma_splin' => $this->Ini->Nm_lang['lang_flsh_chrt_area_spln'],
          'area_empil' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stak'],
          'area_empil_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stan'],
          'area_empil_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stay'],
          'area_empil_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stap'],
          'area_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invr'],
          'area_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invn'],
          'area_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invi'],
          'area_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srgr'],
          'area_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srst'],
          'area_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srbs'],
          'marca_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invr'],
          'marca_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invn'],
          'marca_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invi'],
          'marca_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srgr'],
          'marca_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srst'],
          'marca_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srbs'],
          'gauge_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_shpe'],
          'gauge_forma_circular' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_circ'],
          'gauge_forma_semi' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_semi'],
          'pyram_slice' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_slic'],
          'pyram_slice_s' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_opcs'],
          'pyram_slice_n' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_opcn'],
      );
      if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_prt'] = array();
          $_SESSION['scriptcase']['sc_idioma_prt']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_btns_prtn_titl_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modoimp' => $this->Ini->Nm_lang['lang_btns_mode_prnt_hint'], 'curr' => $this->Ini->Nm_lang['lang_othr_curr_page'], 'total' => $this->Ini->Nm_lang['lang_othr_full'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'pdf_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'pdf_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_word'] = array();
          $_SESSION['scriptcase']['sc_idioma_word']['es'] = array('titulo' => $this->Ini->Nm_lang['lang_export_title'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      $this->Ini->Gd_missing  = true;
      if (function_exists("getProdVersion"))
      {
          $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
      }
      if (function_exists("gd_info"))
      {
          $this->Ini->Gd_missing = false;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 
      $NM_orig = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
      if (strpos($NM_orig, "/reporte_tracking") === false)
      {
          $nmgp_opcao = "busca";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "busca";  
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'] == "status") 
      {
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select']))  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select'] = array(); 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select']['appointment_start_date'] = 'asc'; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select']['appointment_start_time'] = 'asc'; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select']; 
          } 
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'] == "sc_free_group_by") 
      {
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select']))  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select'] = array(); 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select']['appointment_start_date'] = 'asc'; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select']['appointment_start_time'] = 'asc'; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ordem_select']; 
          } 
      }
      if ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig'])) && !isset($_POST['reload_comb_chart']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "busca";
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opc_liga'] = array();  
          if (isset($NMSC_conf_apl) && !empty($NMSC_conf_apl))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opc_liga'] = $NMSC_conf_apl;  
          }   
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opc_liga']['inicial']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opc_liga']['inicial'];
          }
      }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opc_liga']['paginacao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opc_liga']['paginacao']))
          { 
              $this->Ini->Apl_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opc_liga']['paginacao'];
          } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "busca")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "grid" ;  
      }   
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao_print']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao_print']))  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao_print'] = "inicio" ;  
      }   
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['print_all'] = false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "print")  
      { 
          if (strpos(" " . $this->Ini->SC_module_export, "grid") === false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "res_print";
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "res_print")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao']     = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['print_all'] = true;
          if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "print";
              $nmgp_tipo_print = "RC";
          }
      } 
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'], 0, 7) == "grafico")  
      { 
          $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "pdf")
      { 
          $this->Ini->path_img_modelo = $this->Ini->path_img_modelo;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "fast_search")  
      { 
          $this->SC_fast_search($GLOBALS["nmgp_fast_search"], $GLOBALS["nmgp_cond_fast_search"], $GLOBALS["nmgp_arg_fast_search"]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'])
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = 'igual';
          } 
          else 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_array_resumo'] = "NAO";
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_total_geral']  = "NAO";
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral']);
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = 'pesq';
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['orig_pesq'] = 'grid';
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_refresh'] = true;
          } 
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "interativ_search")
      { 
          $this->SC_proc_interativ_search($_POST['parm']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_array_resumo'] = "NAO";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_total_geral']  = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = 'inicio';
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opc_int_search'] = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_refresh'] = true;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == 'pesq' && isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['orig_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['orig_pesq']))  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['orig_pesq'] == "res")  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = 'resumo';
          } 
          elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['orig_pesq'] == "grid") 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = 'inicio';
          } 
      } 
//
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['prim_cons'] = false;  
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))  
      { 
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['use_pass_pdf']);
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['prim_cons'] = true;  
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig'] = " where (appointments.current_status_id=2)";
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['cond_pesq']         = ""; 
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_grid']   = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_lookup'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['campos_busca']      = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['grid_pesq']         = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Grid_search']       = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_fast']   = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_total_geral'] = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sc_total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral']);
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_array_resumo'] = "NAO";
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_ant'];  
      $nm_flag_pdf   = true;
      $nm_vendo_pdf  = ("pdf" == $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['graf_pdf'] = "S";
      if (isset($nmgp_graf_pdf) && !empty($nmgp_graf_pdf))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['graf_pdf'] = $nmgp_graf_pdf;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
      {
         if ($nm_flag_pdf && $nm_vendo_pdf)
         {
            $nm_arquivo_htm_temp = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_reporte_tracking_html_" . session_id() . "_2.html";
            $nm_arquivo_pdf_base = "/sc_pdf_" . md5(date("Ymd") . "_" . session_id()) . "_reporte_tracking.pdf";
            $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . $nm_arquivo_pdf_base;
            $nm_arquivo_pdf_serv = $this->Ini->root . $nm_arquivo_pdf_url;
            $nm_arquivo_de_saida = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_reporte_tracking_html_" . session_id() . ".html";
            $nm_url_de_saida = $this->Ini->server_pdf . $this->Ini->path_imag_temp . "/sc_reporte_tracking_html_" . session_id() . ".html";
            if (in_array(trim($this->Ini->str_lang), $this->Ini->nm_font_ttf) && strtolower($_SESSION['scriptcase']['charset']) != "utf-8")
            { 
                $nm_saida->seta_arquivo($nm_arquivo_de_saida, $_SESSION['scriptcase']['charset']);
            }
            else
            { 
                $nm_saida->seta_arquivo($nm_arquivo_de_saida);
            }
         }
      }
//----------------------------------->
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "doc_word_res")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['print_navigator'] = "Microsoft Internet Explorer";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['print_all'] = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['doc_word']  = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao']     = "resumo";
          $_SESSION['scriptcase']['saida_word'] = true;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_name']))
          {
              $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_name'], ".");
              if ($Pos === false) {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_name'] .= ".doc";
              }
              $nm_arquivo_doc_word = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_name'];
          }
          else
          {
              $nm_arquivo_doc_word = "/sc_reporte_tracking_res_" . session_id() . ".doc";
          }
          $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $this->Ini->nm_limite_lin_res_prt = 0;
          $GLOBALS['nmgp_cor_print']        = $nmgp_cor_word;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "xls")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_xls.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_xls.class.php"); 
          } 
          $this->xls  = new reporte_tracking_xls();
          $this->prep_modulos("xls");
          $this->xls->monta_xls();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "xls_res")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_res_xls.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_res_xls.class.php"); 
          } 
          $this->xls  = new reporte_tracking_res_xls();
          $this->prep_modulos("xls");
          $this->xls->monta_xls();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "xml")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_xml.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_xml.class.php"); 
          } 
          $this->xml  = new reporte_tracking_xml();
          $this->prep_modulos("xml");
          $this->xml->monta_xml();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "xml_res")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_res_xml.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_res_xml.class.php"); 
          } 
          $this->xml  = new reporte_tracking_res_xml();
          $this->prep_modulos("xml");
          $this->xml->monta_xml();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "csv")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_csv.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_csv.class.php"); 
          } 
          $this->csv  = new reporte_tracking_csv();
          $this->prep_modulos("csv");
          $this->csv->monta_csv();
      }
      else   
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "csv_res")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_res_csv.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_res_csv.class.php"); 
          } 
          $this->csv  = new reporte_tracking_res_csv();
          $this->prep_modulos("csv");
          $this->csv->monta_csv();
      }
      else   
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "rtf")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_rtf.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_rtf.class.php"); 
          } 
          $this->rtf  = new reporte_tracking_rtf();
          $this->prep_modulos("rtf");
          $this->rtf->monta_rtf();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "rtf_res")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_res_rtf.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_res_rtf.class.php"); 
          } 
          $this->rtf  = new reporte_tracking_res_rtf();
          $this->prep_modulos("rtf");
          $this->rtf->monta_rtf();
      }
      else
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'], 0, 7) == "grafico")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . " . reporte_tracking . /" . $this->Ini->Apl_grafico); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
          } 
          $this->Graf  = new reporte_tracking_grafico();
          $this->prep_modulos("Graf");
          if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'], 7, 1) == "_")  
          { 
              $this->Graf->grafico_col(substr($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'], 8));
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "grid";
          }
          else
          { 
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dashboard_refresh_after_chart'])) {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dashboard_refresh_after_chart'];
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['dashboard_refresh_after_chart']);
              }
              else {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] = "grid";
              }
              $this->Graf->monta_grafico();
          }
      }
      else 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "busca")  
      { 
          if (!$_SESSION['scriptcase']['proc_mobile']) 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_pesq.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_mobile_pesq.class.php"); 
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'];  
          $this->pesq  = new reporte_tracking_pesq();
          $this->prep_modulos("pesq");
          $this->pesq->NM_ajax_flag    = $this->NM_ajax_flag;
          $this->pesq->NM_ajax_opcao   = $this->NM_ajax_opcao;
          $this->pesq->monta_busca();
      }
      else 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "resumo" || $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "pesq")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/" . $this->Ini->Apl_resumo); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
          } 
          $this->Res = new reporte_tracking_resumo("out");
          $this->prep_modulos("Res");
          $this->Res->monta_resumo();
      }
      else 
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "print" && $nmgp_tipo_print == "RC")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['print_navigator'] = $nmgp_navegator_print;
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['print_all'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao']     = "pdf";
              $GLOBALS['nmgp_tipo_pdf'] = strtolower($nmgp_cor_print);
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] == "doc_word")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['print_navigator'] = "Microsoft Internet Explorer";
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['print_all'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['doc_word']  = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao']     = "pdf";
              $_SESSION['scriptcase']['saida_word'] = true;
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_name']))
              {
                  $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_name'], ".");
                  if ($Pos === false) {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_name'] .= ".doc";
                  }
                  $nm_arquivo_doc_word =  "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_name'];
              }
              else
              {
                  $nm_arquivo_doc_word = "/sc_reporte_tracking_" . session_id() . ".doc";
              }
              $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word);
              $this->Ini->nm_limite_lin_prt = 0;
              $GLOBALS['nmgp_tipo_pdf'] = $nmgp_cor_word;
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "reporte_tracking/reporte_tracking_grid.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "reporte_tracking_grid.class.php"); 
          } 
          $this->grid  = new reporte_tracking_grid();
          $this->prep_modulos("grid");
          $this->grid->monta_grid($linhas);
      }   
//--- 
      if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'])
      {
           $this->Db->Close(); 
      }
      if ($this->Change_Menu)
      {
          $apl_menu  = $_SESSION['scriptcase']['menu_atual'];
          $Arr_rastro = array();
          if (isset($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) && count($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) > 1)
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu] as $menu => $apls)
              {
                 $Arr_rastro[] = "'<a href=\"" . $apls['link'] . "?script_case_init=" . $this->sc_init_menu . "\" target=\"#NMIframe#\">" . $apls['label'] . "</a>'";
              }
              $ult_apl = count($Arr_rastro) - 1;
              unset($Arr_rastro[$ult_apl]);
              $rastro = implode(",", $Arr_rastro);
?>
  <script type="text/javascript">
     link_atual = new Array (<?php echo $rastro ?>);
     parent.writeFastMenu(link_atual);
  </script>
<?php
          }
          else
          {
?>
  <script type="text/javascript">
     parent.clearFastMenu();
  </script>
<?php
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['embutida'])
      {
         $nm_saida->finaliza();
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['ajax_nav'])
         {
             $Temp = ob_get_clean();
             if ($Temp !== false && trim($Temp) != "")
             {
                 $this->Ini->Arr_result['htmOutput'] = $Temp;
             }
             if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['opcao'] != "ajax_detalhe")  
             {
                 $this->Ini->Arr_result['setVar'][] = array('var' => 'scQtReg', 'value' => $this->Ini->Qtd_reg_ajax_grid);
             }
             $_SESSION['scriptcase']['saida_var'] = false;
             $oJson = new Services_JSON();
             echo $oJson->encode($this->Ini->Arr_result);
             exit;
         }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['export_sel_columns']['field_order']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['export_sel_columns']['field_order'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['export_sel_columns']['field_order']);
            }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['export_sel_columns']['usr_cmp_sel']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['export_sel_columns']['usr_cmp_sel'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['export_sel_columns']['usr_cmp_sel']);
            }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['doc_word'])
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file'] = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
             $this->html_doc_word($nm_arquivo_doc_word, $nmgp_password);
         }
         if ($this->Ini->Export_html_zip)
         {
             $this->html_export_print($nm_arquivo_html, $nmgp_password);
         }
         if ($ajax_opc_print)
         {
             $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_print . ".html");
             $this->Arr_result['title_export'] = NM_charset_to_utf8($nm_arquivo_print);
             $Temp = ob_get_clean();
             if ($Temp !== false && trim($Temp) != "")
             {
                 $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
             }
             $oJson = new Services_JSON();
             echo $oJson->encode($this->Arr_result);
             exit;
        }
         if ($nm_flag_pdf && $nm_vendo_pdf)
         {
            if (isset($nmgp_parms_pdf) && !empty($nmgp_parms_pdf))
            {
                $str_pd4ml = " ";
                $Tps_pap   = array('Letter','Legal','Ledger','A0','A1','A2','A3','A4','A5','A6','B5','Tabloid','A7','A8','A9','B0','B1','B2','B3','B4','Executive','B6','B7','B8','B9','B10','C5E','Comm10E','DLE','Folio');
                $Tmp = explode ("__SC__", $nmgp_parms_pdf);
                foreach ($Tmp as $cada_p) {
                    if (substr($cada_p, 0, 1) == "p" && in_array(substr($cada_p, 1), $Tps_pap)) {
                        $str_pd4ml .= " --page-size " . substr($cada_p, 1);
                    }
                    if ($cada_p == "op") {
                        $str_pd4ml .= " --orientation Portrait";
                    }
                    if ($cada_p == "ol") {
                        $str_pd4ml .= " --orientation Landscape";
                    }
                    if ($cada_p == "bn") {
                        $str_pd4ml .= " --outline-depth 0";
                    }
                }
            }
            else
            {
                $str_pd4ml    = " --page-size Letter --orientation Portrait";
            }
            if (!$this->Ini->sc_export_ajax && !$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_det'])
            {
                if (-1 < $this->grid->progress_grid && $this->grid->progress_fp)
                {
                    $lang_protect = $this->Ini->Nm_lang['lang_pdff_gnrt'];
                    if (!NM_is_utf8($lang_protect))
                    {
                        $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
                    }
                    reporte_tracking_pdf_progress_call($this->grid->progress_tot . "_#NM#_" . $this->grid->progress_tot . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
                    fwrite($this->grid->progress_fp, ($this->grid->progress_tot) . "_#NM#_" . $lang_protect . "...\n");
                    fclose($this->grid->progress_fp);
                }
            }
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name']))
            {
                $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name'], ".");
                if ($Pos === false) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name'] .= ".pdf";
                }
                if ('/' == substr($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name'], 0, 1)) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name'] = substr($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name'], 1);
                }
                $nm_arquivo_pdf_serv = $this->Ini->root .  $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name'];
                $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name'];
                $nm_arquivo_pdf_base = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_name']);
            }
            $arq_pdf_out  = (FALSE !== strpos($nm_arquivo_pdf_serv, ' ')) ? " \"" . $nm_arquivo_pdf_serv . "\"" :  $nm_arquivo_pdf_serv;
            $arq_pdf_in   = (FALSE !== strpos($nm_url_de_saida, ' '))     ? " \"" . $nm_url_de_saida . "\""     :  $nm_url_de_saida;
            $Win_autentication = "";
            if (isset($_SESSION['sc_pdf_usr']) && !empty($_SESSION['sc_pdf_usr']))
            {
                $_SESSION['sc_iis_usr'] = $_SESSION['sc_pdf_usr'];
            }
            if (isset($_SESSION['sc_iis_usr']) && !empty($_SESSION['sc_iis_usr']))
            {
                $Win_autentication .= " --username " . $_SESSION['sc_iis_usr'];
            }
            if (isset($_SESSION['sc_pdf_pw']) && !empty($_SESSION['sc_pdf_pw']))
            {
                $_SESSION['sc_iis_pw'] = $_SESSION['sc_pdf_pw'];
            }
            if (isset($_SESSION['sc_iis_pw']) && !empty($_SESSION['sc_iis_pw']))
            {
                $Win_autentication .= " --password " . $_SESSION['sc_iis_pw'];
            }
            if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
            {
                chdir($this->Ini->path_third . "/wkhtmltopdf/win");
                $str_execcmd2 = 'wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
            {
                if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    if (FALSE !== strpos(php_uname(), 'Debian 4.19')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/buster");
                    }
                    elseif (FALSE !== strpos(php_uname(), 'Debian 4.9')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/stretch");
                    }
                    else
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/linux-i386");
                    }
                    $str_execcmd2 = './wkhtmltopdf-i386 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
                else
                {
                    if (FALSE !== strpos(php_uname(), 'Debian 4.19')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/buster");
                    }
                    elseif (FALSE !== strpos(php_uname(), 'Debian 4.9')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/stretch");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), '.el8.') || FALSE !== strpos(strtolower(php_uname()), '.el8_5.')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/centos8");
                    }
                    else
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/linux-amd64");
                    }
                    $str_execcmd2 = './wkhtmltopdf-amd64 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
            {
                chdir($this->Ini->path_third . "/wkhtmltopdf/osx/Contents/MacOS");
                $str_execcmd2 = './wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
            }

            if (!isset($_SESSION['scriptcase']['phantomjs_charts']) || !$_SESSION['scriptcase']['phantomjs_charts'])
            {
                $str_execcmd2 .= ' --javascript-delay ' . 2000;
            }

            $str_execcmd2 .= ' --disable-local-file-access ' . $arq_pdf_in . ' ' . $arq_pdf_out;

            $arr_execcmd = array();
            $str_execcmd = $str_execcmd2;
            exec($str_execcmd2);
            $str_cmd_qpdf = "";
            $str_zip      = "";
            $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_array_resumo'] = '';
            $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_total_geral']  = '';
            // ----- PDF log
            $fp = @fopen($this->Ini->root . $this->Ini->path_imag_temp . str_replace(array(".pdf",".zip"), array("",""), $nm_arquivo_pdf_base) . '.log', 'w');
            if ($fp)
            {
                @fwrite($fp, $str_execcmd . "\r\n\r\n");
                @fwrite($fp, implode("\r\n", $arr_execcmd));
                @fwrite($fp, $str_cmd_qpdf . "\r\n\r\n");
                @fwrite($fp, $str_zip . "\r\n\r\n");
                @fclose($fp);
            }
            if ($this->Ini->sc_export_ajax)
            {
                $this->Arr_result['file_export']  = NM_charset_to_utf8($nm_arquivo_pdf_serv);
                $this->Arr_result['title_export'] = NM_charset_to_utf8(substr($nm_arquivo_pdf_base, 1));
                $Temp = ob_get_clean();
                if ($Temp !== false && trim($Temp) != "")
                {
                    $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
                }
                $oJson = new Services_JSON();
                echo $oJson->encode($this->Arr_result);
                exit;
            }
            if (in_array(trim($this->Ini->str_lang), $this->Ini->nm_font_ttf) && strtolower($_SESSION['scriptcase']['charset']) != "utf-8")
            { 
               $_SESSION['scriptcase']['charset_html'] = (isset($this->Ini->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->Ini->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
            }
            if (!$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_det'])
            {
                if (-1 < $this->grid->progress_grid && $this->grid->progress_fp)
                {
                    $this->grid->progress_fp = fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp', 'a');
                    if ($this->grid->progress_fp)
                    {
                         $lang_protect = $this->Ini->Nm_lang['lang_pdff_fnsh'];
                         if (!NM_is_utf8($lang_protect))
                         {
                             $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
                          }
                        reporte_tracking_pdf_progress_call($this->grid->progress_tot . "_#NM#_" . ($this->grid->progress_now + 1 + $this->grid->progress_pdf) . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
                        reporte_tracking_pdf_progress_call("off\n", $this->Ini->Nm_lang);
                        fwrite($this->grid->progress_fp, ($this->grid->progress_now + 1 + $this->grid->progress_pdf) . "_#NM#_" . $lang_protect . "...\n");
                        fwrite($this->grid->progress_fp, "off\n");
                        fclose($this->grid->progress_fp);
                    }
                }
            }
unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_file']);
if (is_file($nm_arquivo_pdf_serv))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['pdf_file'] = $nm_arquivo_pdf_serv;
}
if ($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['pdf_res'])
{
  $NM_volta  = "resumo";
  $NM_target = "_self";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>REPORTE DE HORAS APROBADAS :: PDF</TITLE>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
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
</HEAD>
<BODY>
<?php echo $this->Ini->Ajax_result_set ?>
<table class="scGridTabela" valign="top"><tr class="scGridFieldOddVert"><td>
<?php
}
                    $rRFP = fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp', "w");
                    fwrite($rRFP, "PDF\n");
                    fwrite($rRFP, "\n");
                    fwrite($rRFP, "\n");
                    fwrite($rRFP, "100\n");
                    fwrite($rRFP, 1 . "_#NM#_" . $this->Ini->Nm_lang['lang_pdff_gnrt'] . "...\n");
                    fwrite($rRFP, 100 . "_#NM#_" . $this->Ini->Nm_lang['lang_pdff_fnsh'] . "...\n");
                    fwrite($rRFP, "off\n");
                    fclose($rRFP);
$downloadFileName = "reporte_tracking.pdf";
if ($this->pdf_zip == 'S') {
    $nm_arquivo_pdf_serv = str_replace('.pdf', '.zip', $nm_arquivo_pdf_serv);
    $nm_arquivo_pdf_url = str_replace('.pdf', '.zip', $nm_arquivo_pdf_url);
    $downloadFileName = str_replace('.pdf', '.zip', $downloadFileName);
}
if (!is_file($nm_arquivo_pdf_serv))
{
?>
  <br><b><?php echo $this->Ini->Nm_lang['lang_pdff_errg']; ?></b></td></tr></table>
<script type="text/javascript">
if (window.parent && typeof window.parent.displayErrorPdf === "function") {
    window.parent.displayErrorPdf("<?php echo $this->Ini->Nm_lang['lang_pdff_errg']; ?>");
}
</script>
<?php
}
else
{
?>
<?php echo $this->Ini->Nm_lang['lang_pdff_file_loct']; ?>
<BR>
<A href="<?php echo $nm_arquivo_pdf_url; ?>" target="_blank" class="scGridPageLink"><B><?php echo $nm_arquivo_pdf_url; ?></B></A>.
<BR>
<?php echo $this->Ini->Nm_lang['lang_pdff_clck_mesg']; ?>
</td></tr></table>
<script type="text/javascript">
if (window.parent && typeof window.parent.updateGeneratedPdfFile === "function") {
    window.parent.updateGeneratedPdfFile("<?php echo $nm_arquivo_pdf_url; ?>");
}
</script>
<?php
    $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking'][md5("newpdf_" . $downloadFileName)][0] = $nm_arquivo_pdf_url;
    $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking'][md5("newpdf_" . $downloadFileName)][1] = $downloadFileName;
}
   echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "sc_b_sai", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<FORM name="F0" method=post action="./" target="<?php echo $NM_target; ?>"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($NM_volta); ?>"> 
</FORM>
</td></tr></table>
</BODY>
</HTML>
<?php
         }
      }
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
  function close_emb()
  {
      if ($this->Db)
      {
          $this->Db->Close(); 
      }
  }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode("_VLS_", $in_fields);
      $this->NM_case_insensitive = false;
      if (empty($data_search)) 
      {
          $tmp_cmd = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_fast'] = "";
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig'])) 
          {
              $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig']; 
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'])) 
          {
              if (!empty($tmp_cmd)) 
              {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'] . ")"; 
              }
              else
              {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'] . ")"; 
              }
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'])) 
          {
              if (!empty($tmp_cmd)) 
              {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'] . ")"; 
              }
              else
              {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'] . ")"; 
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'] = $tmp_cmd;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['fast_search']);
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp" || $field == "appointments_id") 
          {
              $this->SC_monta_condicao($comando, "appointments_id", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "appointment_start_date") 
          {
              $this->SC_monta_condicao($comando, "appointment_start_date", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "appointment_start_time") 
          {
              $this->SC_monta_condicao($comando, "appointment_start_time", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "appointment_end_date") 
          {
              $this->SC_monta_condicao($comando, "appointment_end_date", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "appointment_end_time") 
          {
              $this->SC_monta_condicao($comando, "appointment_end_time", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "current_status_id") 
          {
              $data_lookup = $this->SC_lookup_current_status_id($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "current_status_id", $arg_search, $data_lookup, "INT", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "appointment_recurrent") 
          {
              $this->SC_monta_condicao($comando, "appointment_recurrent", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "appointment_period") 
          {
              $this->SC_monta_condicao($comando, "appointment_period", $arg_search, $data_search, "VARCHAR", false);
          }
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_fast'] = $comando;
      $tmp_cmd = "";
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig'])) 
      {
          $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig']; 
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'] . ")"; 
          }
          else
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'] . ")"; 
          }
      }
      if (!empty($tmp_cmd)) 
      {
          $comando = $tmp_cmd . " and (" . $comando . ")"; 
      }
      else
      {
          $comando = " where (" . $comando . ")"; 
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'])) 
      {
          $comando .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'] . ")";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['fast_search'][0] = $in_fields;
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['fast_search'][2] = $sv_data;
   }
   function SC_monta_condicao(&$comando, $nome, $condicao, $campo, $tp_campo="", $tp_unaccent=false)
   {
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $nm_numeric = array();
      $Nm_datas   = array();
      $campo_join = strtolower(str_replace(".", "_", $nome));
      $nm_ini_lower = "";
      $nm_fim_lower = "";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $nm_numeric[] = "appointments_id";$nm_numeric[] = "current_status_id";$nm_numeric[] = "id_proyecto";$nm_numeric[] = "id_usuario";$nm_numeric[] = "id_actividad";$nm_numeric[] = "intervalo";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['decimal_db'] == ".")
         {
             $nm_aspas  = "";
             $nm_aspas1 = "";
         }
         if (is_array($campo))
         {
             foreach ($campo as $Ind => $Cmp)
             {
                if (!is_numeric($Cmp))
                {
                    return;
                }
                if ($Cmp == "")
                {
                    $campo[$Ind] = 0;
                }
             }
         }
         else
         {
             if (!is_numeric($campo))
             {
                 return;
             }
             if ($campo == "")
             {
                $campo = 0;
             }
         }
      }
      $Nm_datas['appointment_start_date'] = "date";$Nm_datas['appointment_start_time'] = "time";$Nm_datas['appointment_end_date'] = "date";$Nm_datas['appointment_end_time'] = "time";
      if (isset($Nm_datas[$nome]))
      {
          for ($x = 0; $x < strlen($campo); $x++)
          {
              $tst = substr($campo, $x, 1);
              if (!is_numeric($tst) && ($tst != "-" && $tst != ":" && $tst != " "))
              {
                  return;
              }
          }
      }
      if (isset($Nm_datas[$campo_join]) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_sep_date']))
      {
          $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_sep_date'];
          $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_sep_date1'];
      }
      if (isset($Nm_datas[$campo_join]) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP" || strtoupper($condicao) == "DF"))
      {
          if (strtoupper($condicao) == "DF")
          {
              $condicao = "NP";
          }
      }
         $comando .= (!empty($comando) ? " or " : "");
         if (is_array($campo))
         {
             $prep = "";
             foreach ($campo as $Ind => $Cmp)
             {
                 $prep .= (!empty($prep)) ? "," : "";
                 $Cmp   = substr($this->Db->qstr($Cmp), 1, -1);
                 $prep .= $nm_ini_lower . $nm_aspas . $Cmp . $nm_aspas1 . $nm_fim_lower;
             }
             $prep .= (empty($prep)) ? $nm_aspas . $nm_aspas1 : "";
             $comando .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $prep . ")";
             return;
         }
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $cond_tst = strtoupper($condicao);
         if ($cond_tst == "II" || $cond_tst == "QP" || $cond_tst == "NP")
         {
             $op_like = " like ";
         }
         switch ($cond_tst)
         {
            case "EQ":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "II":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
            break;
            case "QP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
            break;
            case "NP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . " not" . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
            break;
            case "DF":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " > " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " >= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " < " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
         }
   }
   function SC_lookup_current_status_id($condicao, $campo)
   {
       $result     = array();
       $campo_orig = $campo;
       $campo      = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT appointment_status_descr, appointment_status_id FROM appointment_status WHERE (#cmp_iappointment_status_descr#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "LIKE '#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "NOT LIKE '%#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", ">= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "< '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           while (!$rx->EOF) 
           { 
               $chave = (isset($rx->fields[1])) ? $rx->fields[1] : $rx->fields[0];
               $label = $rx->fields[0];
               if ($condicao == "eq" && $campo == $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
               {
                   $result[] = $chave;
               }
               if ($condicao == "qp" && strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "np" && !strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "df" && $campo != $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "gt" && $label > $campo )
               {
                   $result[] = $chave;
               }
               if ($condicao == "ge" && $label >= $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "lt" && $label < $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "le" && $label <= $campo)
               {
                   $result[] = $chave;
               }
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
   function SC_proc_interativ_search($Parms)
   {
       $Parms = str_replace("__NM_PLUS__", "+", $Parms);
       $Parms = str_replace("__NM_AMP__", "&", $Parms);
       $Parms = str_replace("__NM_PRC__", "%", $Parms);
       $cmps_dt_hh = array();
       $cmps_dt_hh["appointment_start_date"] = 'YYYY-MM';
       $cmps_numeric = array();
       $cmps_numeric[] = "id_proyecto";
       $cmps_numeric[] = "id_usuario";
       $cmps_numeric[] = "current_status_id";
       $cmps_numeric[] = "id_actividad";
       $range_bw = array();
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($Parms))
       {
           $Parms = NM_conv_charset($Parms, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $tmp     = explode("__DL__", $Parms);
       $cmd_sql = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['int_search_sql'][$tmp[0]];
       $vls     = "";
       $bol_numeric = false;
       if ($tmp[3] == "clear_interativ_all") {
           $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'] = array();
       }
       else {
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'][$tmp[0]]);
           if ($tmp[3] != "clear_interativ")
           {
               $vls  = explode("_VLS_", $tmp[3]);
               if($tmp[2] == "nn" || $tmp[2] == "bw")
               {
                   $bol_numeric = true;
                   $delim  = "";
                   $delim1 = "";
               }
               else
               {
                   $delim  = "'";
                   $delim1 = "'";
               }
               if ($tmp[2] == "dt" || $tmp[2] == "dh" || $tmp[2] == "hh")
               {
                   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_sep_date']))
                   {
                       $delim  = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_sep_date'];
                       $delim1 = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_sep_date1'];
                   }
               }
           }
       }
       if (!empty($vls))
       {
           $prep = "";
           $this->Cmd_dth = "";
           $bol_has_empty = false;
           $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'][$tmp[0]]['tp_obj'] = $tmp[2];
           foreach ($vls as $cada_val)
           {
               $cada_val = NM_charset_decode($cada_val);
               $descr = $cada_val;
               if (is_string($cada_val)) {
                   $tmp_pos = strpos($cada_val, "##@@");
                   if ($tmp_pos !== false) {
                       $descr    = substr($cada_val, $tmp_pos + 4);
                       $cada_val = substr($cada_val, 0, $tmp_pos);
                   }
               }
               $cada_val = substr($this->Db->qstr($cada_val), 1, -1);
               $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'][$tmp[0]]['lab'][$tmp[1]][] = $descr;
               $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'][$tmp[0]]['val_sel'][] = $cada_val;
               if ($cada_val == "")
               {
                   $bol_has_empty = true;
               }
               if (isset($cmps_dt_hh[$tmp[0]]))
               {
                   $this->SC_prep_cmd_dth($cada_val, $cmd_sql, $cmps_dt_hh[$tmp[0]]);
               }
               elseif (in_array($tmp[0], $cmps_numeric))
               {
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['decimal_db'] == ".")
                  {
                      $cada_val  = str_replace(",", ".", $cada_val);
                  }
                  else
                  {
                      $delim  = "'";
                      $delim1 = "'";
                      $cada_val  = str_replace(".", ",", $cada_val);
                  }
                   $prep .= ($prep != "") ? "," : "";
                   $prep .= $delim . $cada_val . $delim1;
               }
               else
               {
                   $prep .= ($prep != "") ? "," : "";
                   $prep .= $delim . $cada_val . $delim1;
               }
               $range_bw[] = $cada_val;
           }
               $str_add_null    = '';
               $str_add_null_or = '';
               if($bol_has_empty)
               {
                   $str_add_null    = ' ' . $cmd_sql . ' is null ';
                   $str_add_null_or = ' OR ' . $cmd_sql . ' is null ';
               }
           if ($prep == "" && $bol_numeric)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'][$tmp[0]]['val'] = $cmd_sql . " = '' or " . $cmd_sql . " is null";
           }
           elseif ($prep == "" && $delim != "" && $this->Cmd_dth == "")
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'][$tmp[0]]['val'] = $cmd_sql . " = '' or " . $cmd_sql . " is null";
           }
           elseif (isset($cmps_dt_hh[$tmp[0]]))
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'][$tmp[0]]['val'] = $this->Cmd_dth;
           }
           elseif ( $tmp[2] == "bw")
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'][$tmp[0]]['val'] = $cmd_sql . " between " . $delim . $range_bw[0] .  $delim1 . " and " . $delim . $range_bw[1] .  $delim1 . $str_add_null_or;
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'][$tmp[0]]['val'] = $cmd_sql . " IN (" . $prep . ")" . $str_add_null_or;
           }
       }
      $tmp_cmd = "";
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig'])) 
      {
          $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_orig']; 
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'] . ")"; 
          }
          else
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_filtro'] . ")"; 
          }
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_fast'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_fast'] . ")";
          }
          else 
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_fast'] . ")";
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_resumo'])) 
      { 
          if (empty($tmp_where)) 
          { 
              $tmp_cmd = "where " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_resumo']; 
          } 
          else
          { 
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_resumo'] . ")"; 
          } 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_sem_interativ']  = $tmp_cmd;
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'])) 
      {
          $prim = true;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['interativ_search'] as $cmp => $val) 
          {
              if (!$prim)
              {
                 $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'] .= " AND ";
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'] .= "(" . $val['val'] . ")";
              $prim = false;
          }
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'] . ")"; 
          }
          else
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq_interativ'] . ")"; 
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'] = $tmp_cmd;
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['refresh_interativ'] = (isset($tmp[5])) ? $tmp[5] : "S";
      if(isset($tmp[4]) && $tmp[4] == 'N')
      {
          $this->Arr_result['interativ_search'] = array();
          $oJson = new Services_JSON();
          echo $oJson->encode( $this->Arr_result );
          exit;
      }
   }
   function SC_prep_cmd_dth($val, $def, $format)
   {
       $ano = "";
       $mes = "";
       $dia = "";
       $hor = "";
       $min = "";
       $seg = "";
       $tmp = "";
       for ($i = 0; $i < strlen($format); $i++)
       {
           if (substr($format, $i, 1) == "Y") {
               $ano .= substr($val, $i, 1);
           }
           if (substr($format, $i, 1) == "M") {
               $mes .= substr($val, $i, 1);
           }
           if (substr($format, $i, 1) == "D") {
               $dia .= substr($val, $i, 1);
           }
           if (substr($format, $i, 1) == "H") {
               $hor .= substr($val, $i, 1);
           }
           if (substr($format, $i, 1) == "I") {
               $min .= substr($val, $i, 1);
           }
           if (substr($format, $i, 1) == "S") {
               $seg .= substr($val, $i, 1);
           }
       }
       $delim  = "";
       $delim1 = "";
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
       {
           $delim  = "'";
           $delim1 = "'";
       }
       if (!empty($ano))
       {
           $tmp .= (!empty($tmp)) ? " and " : "";
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $tmp .= "strftime('%Y', " . $def . ") = " . $delim . $ano . $delim1;
           }
           elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
           {
               $tmp .= "extract(year from " . $def . ") = " . $delim . $ano . $delim1;
           }
           else
           {
               $tmp .= "year(" . $def . ") = " . $delim . $ano . $delim1;
           }
       }
       if (!empty($mes))
       {
           $tmp .= (!empty($tmp)) ? " and " : "";
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $tmp .= "strftime('%m', " . $def . ") = " . $delim . $mes . $delim1;
           }
           elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
           {
               $tmp .= "extract(month from " . $def . ") = " . $delim . $mes . $delim1;
           }
           else
           {
               $tmp .= "month(" . $def . ") = " . $delim . $mes . $delim1;
           }
       }
       if (!empty($dia))
       {
           $tmp .= (!empty($tmp)) ? " and " : "";
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $tmp .= "strftime('%d', " . $def . ") = " . $delim . $dia . $delim1;
           }
           elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
           {
               $tmp .= "extract(day from " . $def . ") = " . $delim . $dia . $delim1;
           }
           else
           {
               $tmp .= "day(" . $def . ") = " . $delim . $dia . $delim1;
           }
       }
       if (!empty($hor))
       {
           $tmp .= (!empty($tmp)) ? " and " : "";
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $tmp .= "strftime('%H', " . $def . ") = " . $delim . $hor . $delim1;
           }
           elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
           {
               $tmp .= "extract(hour from " . $def . ") = " . $delim . $hor . $delim1;
           }
           else
           {
               $tmp .= "hour(" . $def . ") = " . $delim . $hor . $delim1;
           }
       }
       if (!empty($min))
       {
           $tmp .= (!empty($tmp)) ? " and " : "";
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $tmp .= "strftime('%M', " . $def . ") = " . $delim . $min . $delim1;
           }
           elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
           {
               $tmp .= "extract(minute from " . $def . ") = " . $delim . $min . $delim1;
           }
           else
           {
               $tmp .= "minute(" . $def . ") = " . $delim . $min . $delim1;
           }
       }
       if (!empty($seg))
       {
           $tmp .= (!empty($tmp)) ? " and " : "";
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $tmp .= "strftime('%S', " . $def . ") = " . $delim . $seg . $delim1;
           }
           elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
           {
               $tmp .= "extract(second from " . $def . ") = " . $delim . $seg . $delim1;
           }
           else
           {
               $tmp .= "second(" . $def . ") = " . $delim . $seg . $delim1;
           }
       }
       if(empty($tmp))
       {
           if(empty($delim))
           {
               $tmp = $def . " is null";
           }
           else
           {
               $tmp = $def . " = " . $delim . $delim1 . " OR " . $def . " is null";
           }
       }
       $this->Cmd_dth .= (!empty($this->Cmd_dth)) ? " or " : "";
       $this->Cmd_dth .= "(" . $tmp . ")";
   }
  function html_doc_word($nm_arquivo_doc_word, $nmgp_password)
  {
      global $nm_url_saida;
      $Word_password = "";
      if ($this->Ini->Export_zip || $Word_password != "")
      { 
          $Parm_pass  = ($Word_password != "") ? " -p" : "";
          $Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file'], ".");
          if ($Pos !== false) {
              $Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file'], 0, $Pos);
          }
          $Arq_zip .= ".zip";
          $Arq_doc = $nm_arquivo_doc_word;
          $Pos = strrpos($nm_arquivo_doc_word, ".");
          if ($Pos !== false) {
              $Arq_doc = substr($nm_arquivo_doc_word, 0, $Pos);
          }
          $Arq_doc  .= ".zip";
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file'], ' ')) ? " \"" . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file'] . "\"" :  $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file'];
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Word_password . " " . $Zip_f . " " . $Arq_input;
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
               $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $Arq_input;
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
           foreach ($this->Ini->Img_export_zip as $cada_img_zip)
           {
              $str_zip      = "";
              $cada_img_zip = '"' . $cada_img_zip . '"';
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Word_password . " " . $Zip_f . " " . $cada_img_zip;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $cada_img_zip;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $cada_img_zip;
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
           }
           if (is_file($Arq_zip)) {
               unlink($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file']);
               $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file'] = $Arq_zip;
               $nm_arquivo_doc_word = $Arq_doc;
          } 
      } 
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['word_file']);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($nm_arquivo_doc_word);
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>REPORTE DE HORAS APROBADAS :: Doc</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
   <link rel="stylesheet" type="text/css" href="../_lib/lib/css/nm_export_mobile.css" /> 
<?php
}
$path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
$_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking'][$path_doc_md5][1] = substr($nm_arquivo_doc_word, 1);
?>
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
   <td class="scExportTitle" style="height: 25px">WORD</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . $nm_arquivo_doc_word ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="reporte_tracking_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="reporte_tracking"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($this->ret_word) ?>"> 
</FORM> 
</BODY>
</HTML>
<?php
  }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      global $nm_url_saida;
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Arq_zip   = $Arq_base;
          $Pos = strrpos($Arq_base, ".");
          if ($Pos !== false) {
              $Arq_zip = substr($Arq_base, 0, $Pos);
          }
          $Arq_zip .= ".zip";
          $Arq_htm  = $nm_arquivo_html;
          $Pos = strrpos($nm_arquivo_html, ".");
          if ($Pos !== false) {
              $Arq_htm = substr($nm_arquivo_html, 0, $Pos);
          }
          $Arq_htm  .= ".zip";
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($Arq_base, ' ')) ? " \"" . $Arq_base . "\"" :  $Arq_base;
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Html_password . " " . $Zip_f . " " . $Arq_input;
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
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
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
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort_desc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort_asc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_summary_sort_desc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_summary_sort_asc;
           foreach ($this->Ini->Img_export_zip as $cada_img_zip)
           {
               $str_zip      = "";
              $cada_img_zip = '"' . $cada_img_zip . '"';
               if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
               {
                   $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Html_password . " " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
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
           }
           if (is_file($Arq_zip)) {
               unlink($Arq_base);
               $nm_arquivo_html = $Arq_htm;
           } 
          $path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_html);
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_html;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking'][$path_doc_md5][1] = substr($nm_arquivo_html, 1);
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar);
          $this->pb->setDownloadLink($this->Ini->path_imag_temp . $nm_arquivo_html);
          $this->pb->setDownloadMd5($path_doc_md5);
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($this->ret_print);
          $this->pb->completed();
          return;
  }
} 
// 
//======= =========================
   if (isset($_SESSION['scriptcase']['reporte_tracking']['sc_process_barr'])) {
       return;
   }
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
   if (!function_exists("SC_dir_app_ini"))
   {
       include_once("../_lib/lib/php/nm_ctrl_app_name.php");
   }
   SC_dir_app_ini('carga_horas');
   $_SESSION['scriptcase']['reporte_tracking']['contr_erro'] = 'off';
   $sc_conv_var = array();
   $Sc_lig_md5 = false;
   $Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
   $_SESSION['scriptcase']['sem_session'] = false;
   if (!empty($_POST))
   {
       if (isset($_POST['parm']))
       {
           $_POST['parm'] = str_replace("__NM_PLUS__", "+", $_POST['parm']);
           $_POST['parm'] = str_replace("__NM_AMP__", "&", $_POST['parm']);
           $_POST['parm'] = str_replace("__NM_PRC__", "%", $_POST['parm']);
       }
       foreach ($_POST as $nmgp_var => $nmgp_val)
       {
            $nmgp_val = str_replace("__NM_PLUS__", "+", $nmgp_val);
            $nmgp_val = str_replace("__NM_AMP__", "&", $nmgp_val);
            $nmgp_val = str_replace("__NM_PRC__", "%", $nmgp_val);
            if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
            {
                $nmgp_var = substr($nmgp_var, 11);
                $nmgp_val = $_SESSION[$nmgp_val];
            }
             if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                     $Sc_lig_md5 = true;
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
             if ($nmgp_var == "nmgp_parms_where" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]];
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
            if (isset($sc_conv_var[$nmgp_var]))
            {
                $nmgp_var = $sc_conv_var[$nmgp_var];
            }
            elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
            {
                $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
            }
            nm_limpa_str_reporte_tracking($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_reporte_tracking($nmgp_var, $nmgp_val);
            $$nmgp_var = $nmgp_val;
       }
   }
   if (!empty($_GET))
   {
       if (isset($_GET['parm']))
       {
           $_GET['parm'] = str_replace("__NM_PLUS__", "+", $_GET['parm']);
           $_GET['parm'] = str_replace("__NM_AMP__", "&", $_GET['parm']);
           $_GET['parm'] = str_replace("__NM_PRC__", "%", $_GET['parm']);
       }
       foreach ($_GET as $nmgp_var => $nmgp_val)
       {
            $nmgp_val = str_replace("__NM_PLUS__", "+", $nmgp_val);
            $nmgp_val = str_replace("__NM_AMP__", "&", $nmgp_val);
            $nmgp_val = str_replace("__NM_PRC__", "%", $nmgp_val);
            if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
            {
                $nmgp_var = substr($nmgp_var, 11);
                $nmgp_val = $_SESSION[$nmgp_val];
            }
             if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                     $Sc_lig_md5 = true;
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
             if ($nmgp_var == "nmgp_parms_where" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]];
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
            if (isset($sc_conv_var[$nmgp_var]))
            {
                $nmgp_var = $sc_conv_var[$nmgp_var];
            }
            elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
            {
                $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
            }
            nm_limpa_str_reporte_tracking($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_reporte_tracking($nmgp_var, $nmgp_val);
            $$nmgp_var = $nmgp_val;
       }
   }
   if (!isset($_SERVER['HTTP_REFERER']) && !isset($nmgp_parms) && !isset($script_case_init) && !isset($nmgp_start))
   {
       $Sem_Session = false;
   }
   $NM_dir_atual = getcwd();
   if (empty($NM_dir_atual)) {
       $str_path_sys  = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
       $str_path_sys  = str_replace("\\", '/', $str_path_sys);
   }
   else {
       $sc_nm_arquivo = explode("/", $_SERVER['PHP_SELF']);
       $str_path_sys  = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
   }
   $str_path_web    = $_SERVER['PHP_SELF'];
   $str_path_web    = str_replace("\\", '/', $str_path_web);
   $str_path_web    = str_replace('//', '/', $str_path_web);
   $path_aplicacao  = substr($str_path_web, 0, strrpos($str_path_web, '/'));
   $path_aplicacao  = substr($path_aplicacao, 0, strrpos($path_aplicacao, '/'));
   $root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
   if ($Sem_Session && (!isset($nmgp_start) || $nmgp_start != "SC")) {
       if (isset($_COOKIE['sc_apl_default_carga_horas'])) {
           $apl_def = explode(",", $_COOKIE['sc_apl_default_carga_horas']);
       }
       elseif (is_file($root . $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imag_temp'] . "/sc_apl_default_carga_horas.txt")) {
           $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['reporte_tracking']['glo_nm_path_imag_temp'] . "/sc_apl_default_carga_horas.txt"));
       }
       if (isset($apl_def)) {
           if ($apl_def[0] != "reporte_tracking") {
               $_SESSION['scriptcase']['sem_session'] = true;
               if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                   $_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir'] = $apl_def[0];
               }
               else {
                   $_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
               }
               $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
               $_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir_tp'] = $Redir_tp;
           }
           if (isset($_COOKIE['sc_actual_lang_carga_horas'])) {
               $_SESSION['scriptcase']['reporte_tracking']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_carga_horas'];
           }
       }
   }
   if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
   {
       $_SESSION['sc_session']['SC_parm_violation'] = true;
   }
   if (isset($nmgp_parms) && $nmgp_parms == "SC_null")
   {
       $nmgp_parms = "";
   }
   if (!empty($glo_perfil))  
   { 
      $_SESSION['scriptcase']['glo_perfil'] = $glo_perfil;
   }   
   if (isset($glo_servidor)) 
   {
       $_SESSION['scriptcase']['glo_servidor'] = $glo_servidor;
   }
   if (isset($glo_banco)) 
   {
       $_SESSION['scriptcase']['glo_banco'] = $glo_banco;
   }
   if (isset($glo_tpbanco)) 
   {
       $_SESSION['scriptcase']['glo_tpbanco'] = $glo_tpbanco;
   }
   if (isset($glo_usuario)) 
   {
       $_SESSION['scriptcase']['glo_usuario'] = $glo_usuario;
   }
   if (isset($glo_senha)) 
   {
       $_SESSION['scriptcase']['glo_senha'] = $glo_senha;
   }
   if (isset($glo_senha_protect)) 
   {
       $_SESSION['scriptcase']['glo_senha_protect'] = $glo_senha_protect;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_pai']))
   {
       $apl_pai = $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_pai'];
       if (isset($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho']))
       {
           foreach ($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho'] as $init_filho)
           {
               if (isset($_SESSION['sc_session'][$init_filho]['reporte_tracking']['master_pai']) && $_SESSION['sc_session'][$init_filho]['reporte_tracking']['master_pai'] == $script_case_init)
               {
                   $script_case_init = $init_filho;
                   break;
               }
           }
       }
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form'] && !isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['master_pai']))
   {
       $SC_init_ant = $script_case_init;
       $script_case_init = rand(2, 10000);
       if (isset($_SESSION['sc_session'][$SC_init_ant]['reporte_tracking']['embutida_pai']))
       {
           $_SESSION['sc_session'][$SC_init_ant][$_SESSION['sc_session'][$SC_init_ant]['reporte_tracking']['embutida_pai']]['embutida_filho'][] = $script_case_init;
       }
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['master_pai'] = $SC_init_ant;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['master_pai']))
   {
       $SC_init_ant = $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['master_pai'];
       if (!isset($_SESSION['sc_session'][$SC_init_ant]['reporte_tracking']['embutida_form_parms']))
       {
           $_SESSION['sc_session'][$SC_init_ant]['reporte_tracking']['embutida_form_parms'] = "";
       }
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_parms'] = $_SESSION['sc_session'][$SC_init_ant]['reporte_tracking']['embutida_form_parms'];
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form'] = true;
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_full'] = (isset($_SESSION['sc_session'][$SC_init_ant]['reporte_tracking']['embutida_form_full'])) ? $_SESSION['sc_session'][$SC_init_ant]['reporte_tracking']['embutida_form_full'] : false;
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['reg_start'] = "";
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] = "inicio";
       unset($_SESSION['sc_session'][$SC_init_ant]['reporte_tracking']['embutida_form']);
       unset($_SESSION['sc_session'][$SC_init_ant]['reporte_tracking']['embutida_form_parms']);
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_parms'])) 
   {
       if (!empty($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_parms'])) 
       {
           $nmgp_parms = $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_parms'];
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_parms'] = "";
       }
   }
   elseif (isset($script_case_init))
   {
       unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form']);
       unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_full']);
       unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_parms']);
   }
   if (!isset($nmgp_opcao) || !isset($script_case_init) || ((!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida']) || !$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida']) && $nmgp_opcao != "formphp"))
   { 
       if (!empty($nmgp_parms)) 
       { 
           $nmgp_parms = NM_decode_input($nmgp_parms);
           $nmgp_parms = str_replace("@aspass@", "'", $nmgp_parms);
           $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
           $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
           $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
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
                    if (isset($sc_conv_var[$cadapar[0]]))
                    {
                        $cadapar[0] = $sc_conv_var[$cadapar[0]];
                    }
                    elseif (isset($sc_conv_var[strtolower($cadapar[0])]))
                    {
                        $cadapar[0] = $sc_conv_var[strtolower($cadapar[0])];
                    }
                    nm_limpa_str_reporte_tracking($cadapar[1]);
                    nm_protect_num_reporte_tracking($cadapar[0], $cadapar[1]);
                    if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                    $Tmp_par   = $cadapar[0];
                    $$Tmp_par = $cadapar[1];
                }
           }
           $NMSC_conf_apl = array();
           if (isset($NMSC_inicial))
           {
               $NMSC_conf_apl['inicial'] = $NMSC_inicial;
           }
           if (isset($NMSC_rows))
           {
               $NMSC_conf_apl['rows'] = $NMSC_rows;
           }
           if (isset($NMSC_cols))
           {
               $NMSC_conf_apl['cols'] = $NMSC_cols;
           }
           if (isset($NMSC_paginacao))
           {
               $NMSC_conf_apl['paginacao'] = $NMSC_paginacao;
           }
           if (isset($NMSC_cab))
           {
               $NMSC_conf_apl['cab'] = $NMSC_cab;
           }
           if (isset($NMSC_nav))
           {
               $NMSC_conf_apl['nav'] = $NMSC_nav;
           }
           if (isset($NMSC_fix_bar_top))
           {
               $NMSC_conf_apl['fix_top'] = $NMSC_fix_bar_top;
           }
           if (isset($NMSC_fix_bar_bot))
           {
               $NMSC_conf_apl['fix_bot'] = $NMSC_fix_bar_bot;
           }
           if (isset($NM_run_iframe) && $NM_run_iframe == 1) 
           { 
               unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']);
               $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['b_sair'] = false;
           }   
       } 
   } 
   if (!isset($nmgp_opcao)) {
      $nmgp_opcao = "";
   }
   $ini_embutida = "";
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida']) && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'])
   {
       $nmgp_outra_jan = "";
   }
   if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
   {
       $script_case_init = "";
   }
   if (isset($GLOBALS["script_case_init"]) && !empty($GLOBALS["script_case_init"]))
   {
       $ini_embutida = $GLOBALS["script_case_init"];
        if (!isset($_SESSION['sc_session'][$ini_embutida]['reporte_tracking']['embutida']))
        { 
           $_SESSION['sc_session'][$ini_embutida]['reporte_tracking']['embutida'] = false;
        }
        if (!$_SESSION['sc_session'][$ini_embutida]['reporte_tracking']['embutida'])
        { 
           $script_case_init = $ini_embutida;
        }
   }
   if (isset($_SESSION['scriptcase']['reporte_tracking']['protect_modal']) && !empty($_SESSION['scriptcase']['reporte_tracking']['protect_modal']))
   {
       $script_case_init = $_SESSION['scriptcase']['reporte_tracking']['protect_modal'];
   }
   if (!isset($script_case_init) || empty($script_case_init))
   {
       $script_case_init = rand(2, 10000);
   }
   $salva_emb    = false;
   $salva_iframe = false;
   if (isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_menu']))
   {
       $salva_iframe = $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_menu'];
       unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_menu']);
   }
   if (isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida']))
   {
       $salva_emb = $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'];
       unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida']);
   }
   if (isset($nm_run_menu) && $nm_run_menu == 1 && !$salva_emb)
   {
        if (isset($_SESSION['scriptcase']['sc_aba_iframe']) && isset($_SESSION['scriptcase']['sc_apl_menu_atual']))
        {
            foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
            {
                if ($aba == $_SESSION['scriptcase']['sc_apl_menu_atual'])
                {
                    unset($_SESSION['scriptcase']['sc_aba_iframe'][$aba]);
                    break;
                }
            }
        }
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "reporte_tracking";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'reporte_tracking' || $achou)
                {
                    unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                }
            }
            if (!$achou && isset($nm_apl_menu))
            {
                foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
                {
                    if ($nome_apl == $nm_apl_menu || $achou)
                    {
                        $achou = true;
                        if ($nome_apl != $nm_apl_menu)
                        {
                            unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                        }
                    }
                }
            }
        }
        $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_menu'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_menu'] = $salva_iframe;
   }
   $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['doc_word'] = false;
   $_SESSION['scriptcase']['saida_word'] = false;
   $_SESSION['sc_session']['reporte_tracking']['show_skip_charts_option'] = true;
   if (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['skip_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['skip_charts'] = false;
   }
   if (isset($_REQUEST['sc_create_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['skip_charts'] = 'N' == $_REQUEST['sc_create_charts'];
   }
   $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'] = $salva_emb;

   if (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['initialize']))
   {
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['initialize'] = true;
   }
   elseif (!isset($_SERVER['HTTP_REFERER']))
   {
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['initialize'] = false;
   }
   elseif (false === strpos($_SERVER['HTTP_REFERER'], '/reporte_tracking/'))
   {
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['initialize'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['initialize'] = false;
   }
   if ($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['initialize'])
   {
       unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['tot_geral']);
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['contr_total_geral'] = "NAO";
   }

   $_POST['script_case_init'] = $script_case_init;
   if (!isset($nmgp_opcao) || empty($nmgp_opcao) || $nmgp_opcao == "grid" && (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['b_sair'])))
   {
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['b_sair'] = true;
   }
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "es";
   if (isset($_SESSION['scriptcase']['reporte_tracking']['session_timeout']['lang'])) {
       $STR_lang = $_SESSION['scriptcase']['reporte_tracking']['session_timeout']['lang'];
   }
   $STR_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "tracking/tracking";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       $Lixo = file($NM_arq_lang);
       foreach ($Lixo as $Cada_lin) 
       {
           if (strpos($Cada_lin, "array()") === false && (trim($Cada_lin) != "<?php")  && (trim($Cada_lin) != "?" . ">"))
           {
               eval (str_replace("\$this->", "\$", $Cada_lin));
           }
       }
   }
   $_SESSION['scriptcase']['charset'] = "UTF-8";
   ini_set('default_charset', $_SESSION['scriptcase']['charset']);
   foreach ($Nm_lang as $ind => $dados)
   {
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
      {
          $Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
   }
   if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'reporte_tracking')
   {
       $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan'] = true;
        unset($_SESSION['scriptcase']['sc_outra_jan']);
   }
   $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['menu_desenv'] = false;   
   if (!defined("SC_ERROR_HANDLER"))
   {
       define("SC_ERROR_HANDLER", 1);
       include_once(dirname(__FILE__) . "/reporte_tracking_erro.php");
   }
   $salva_tp_saida  = (isset($_SESSION['scriptcase']['sc_tp_saida']))  ? $_SESSION['scriptcase']['sc_tp_saida'] : "";
   $salva_url_saida  = (isset($_SESSION['scriptcase']['sc_url_saida'][$script_case_init])) ? $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] : "";
   if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['reporte_tracking']))
   { 
       return;
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'] && $nmgp_opcao != "formphp")
   { 
       if (empty($nmgp_opcao) && !isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao']))
       { 
           $nmgp_opcao = "busca";
       } 
       if ($nmgp_opcao == "change_lang" || $nmgp_opcao == "change_lang_res" || $nmgp_opcao == "change_lang_fil" || $nmgp_opcao == "force_lang")  
       { 
           if ($nmgp_opcao == "change_lang_fil")  
           { 
               $nmgp_opcao  = "busca";  
           } 
           elseif ($nmgp_opcao == "change_lang_res")  
           { 
               $nmgp_opcao  = "resumo";  
           } 
           else 
           { 
               $nmgp_opcao  = "igual";  
           } 
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_change_lang'] = true;
           unset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['tot_geral']);
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['contr_total_geral'] = "NAO";
           $Temp_lang = explode(";" , $nmgp_idioma);  
           if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
           { 
               $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
           } 
           if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
           { 
               $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
           } 
       } 
       if ($nmgp_opcao == "change_schema" || $nmgp_opcao == "change_schema_fil" || $nmgp_opcao == "change_schema_res")  
       { 
           if ($nmgp_opcao == "change_schema_fil")  
           { 
               $nmgp_opcao  = "busca";  
           } 
           elseif ($nmgp_opcao == "change_schema_res")  
           { 
               $nmgp_opcao  = "resumo";  
           } 
           else 
           { 
               $nmgp_opcao  = "igual";  
           } 
           $nmgp_schema = $nmgp_schema . "/" . $nmgp_schema;  
           $_SESSION['scriptcase']['str_schema_all'] = $nmgp_schema;
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['num_css'] = rand(0, 1000);
       } 
       if ($nmgp_opcao == "volta_grid")  
       { 
           $nmgp_opcao = "igual";  
       }   
       if (!empty($nmgp_opcao))  
       { 
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] = $nmgp_opcao ;  
       }   
       if (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['mostra_edit'])) 
       {
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['mostra_edit'] = "S";
       }
       if (isset($nmgp_lig_edit_lapis)) 
       {
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['mostra_edit'] = $nmgp_lig_edit_lapis;
           unset($GLOBALS["nmgp_lig_edit_lapis"]) ;  
           if (isset($_SESSION['nmgp_lig_edit_lapis'])) 
           {
               unset($_SESSION['nmgp_lig_edit_lapis']);
           }
       }
       if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
       {
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan'] = true;
       }
       $nm_saida = "";
      if (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao']) || empty($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao']) || !isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['where_orig']))  
      { 
          $nmgp_opcao = "busca" ;  
      }   
       if (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_modal']))
       {
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_modal'] = false;
       }
       if (isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['volta_redirect_apl']) && !empty($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['volta_redirect_apl']))
       {
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['volta_redirect_apl']; 
           $nm_apl_dependente = $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['volta_redirect_tp']; 
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['volta_redirect_apl'] = "";
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['volta_redirect_tp'] = "";
           $nm_url_saida = "reporte_tracking_fim.php"; 
       
       }
       elseif (substr($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] != "pdf"  && $nmgp_opcao == "busca") 
       {
           if (isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan'])
           {
               if ($nmgp_url_saida == "modal")
               {
                   $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_modal'] = true;
               }
               $nm_url_saida = "reporte_tracking_fim.php"; 
           }
           else
           {
               $nm_url_saida = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ""; 
               $nm_url_saida = str_replace("_fim.php", ".php", $nm_url_saida);
               if (!empty($nmgp_url_saida)) 
               { 
                   $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['retorno_cons'] = $nmgp_url_saida ; 
               } 
               if (!empty($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['retorno_cons'])) 
               { 
                   $nm_url_saida = $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['retorno_cons']  . "?script_case_init=" . NM_encode_input($script_case_init);  
                   $nm_apl_dependente = 1 ; 
               } 
               if (!empty($nm_url_saida)) 
               { 
                   $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida ; 
               } 
               $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida; 
               $nm_url_saida = "reporte_tracking_fim.php"; 
               $_SESSION['scriptcase']['sc_tp_saida'] = "P"; 
               if ($nm_apl_dependente == 1) 
               { 
                   $_SESSION['scriptcase']['sc_tp_saida'] = "D"; 
               } 
           } 
       }
// 
       if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && substr($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] != "pdf"  && $nmgp_opcao == "busca") 
       { 
            $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['scriptcase']['nm_sc_retorno']; 
            $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['menu_desenv'] = true;   
       } 
       if (isset($nmgp_parms_ret)) 
       {
           $todo = explode(",", $nmgp_parms_ret);
           if (isset($sc_conv_var[$todo[2]]))
           {
               $todo[2] = $sc_conv_var[$todo[2]];
           }
           elseif (isset($sc_conv_var[strtolower($todo[2])]))
           {
               $todo[2] = $sc_conv_var[strtolower($todo[2])];
           }
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['form_psq_ret']  = $todo[0];
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['campo_psq_ret'] = $todo[1];
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['dado_psq_ret']  = $todo[2];
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['js_apos_busca'] = $nm_evt_ret_busca;
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opc_psq'] = true;   
           if (isset($nmgp_iframe_ret)) {
               $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_ret_cap'] = $nmgp_iframe_ret;
           }
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['psq_edit'] = 'N';   
           if (isset($nmgp_perm_edit)) {
               $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['psq_edit'] = $nmgp_perm_edit;
           }
       } 
       elseif (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opc_psq']))
       {
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opc_psq']  = false;   
           $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['psq_edit'] = 'N';   
       } 
       if (isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form'])
       {
           if (!isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_full']) || !$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form_full'])
           {
               $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['mostra_edit'] = "N";   
           } 
           $_SESSION['scriptcase']['sc_tp_saida']  = $salva_tp_saida;
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $salva_url_saida;
       } 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
       { 
           $_SESSION['scriptcase']['sc_apl_seg']['reporte_tracking'] = "on";
       } 
       if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
       { 
           $_SESSION['scriptcase']['sc_apl_seg']['reporte_tracking'] = "on";
       } 
       if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opc_psq'] && !isset($_SESSION['scriptcase']['reporte_tracking']['session_timeout']['redir'])) 
       { 
          if (!isset($_SESSION['scriptcase']['sc_apl_seg']['reporte_tracking']) || $_SESSION['scriptcase']['sc_apl_seg']['reporte_tracking'] != "on")
          { 
              $NM_Mens_Erro = $Nm_lang['lang_errm_unth_user'];
              $nm_botao_ok = ($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['iframe_menu']) ? false : true;
              if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
              {
                  foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
                  {
                      if (in_array("reporte_tracking", $apls_aba))
                      {
                          $nm_botao_ok = false;
                           break;
                      }
                  }
              }
              if ((isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida']) && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida']) || (isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida_form']))
              {
                   $nm_botao_ok = false;
              }
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
?>
             <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
              <HTML>
               <HEAD>
                <TITLE>=)</TITLE>
               <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
                <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>                <META http-equiv="Pragma" content="no-cache"/>
                <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
                <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $STR_schema_all ?>_grid.css" /> 
                <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $STR_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
               </HEAD>
               <body class="scGridPage">
                <table align="center"><tr><td style="padding: 0"><div class="scGridBorder">
                <table class="scGridTabela" width='100%' cellspacing=0 cellpadding=0><tr class="scGridFieldOdd"><td class="scGridFieldOddFont" style="padding: 15px 30px; text-align: center">
                 <?php echo $NM_Mens_Erro; ?>
<?php
              if ($nm_botao_ok)
              {
?>
                <br />
                <form name="Fseg" method="post" 
                                    action="<?php echo $nm_url_saida; ?>" 
                                    target="_self"> 
                 <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($script_case_init) ?>"/> 
                 <input type="submit" name="sc_sai_seg" value="OK"> 
                </form> 
<?php
              }
?>
                </td></tr></table>
                </div></td></tr></table>
<?php
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']))
              {
?>
<br /><br /><br />
<table align="center" style="width: 450px"><tr><td style="padding: 0"><div class="scGridBorder">
 <table style="width: 100%" class="scGridTabela">
  <tr class="scGridFieldOdd">
   <td class="scGridFieldOddFont" style="padding: 15px 30px">
    <?php echo $Nm_lang['lang_errm_unth_hwto']; ?>
   </td>
  </tr>
 </table>
</div></td></tr></table>
<?php
              }
?>
               </body>
              </HTML>
<?php
              exit;
          } 
       } 
       if (isset($_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['sc_outra_jan'])
       {
           $nm_apl_dependente = 0;
       }
       $contr_reporte_tracking = new reporte_tracking_apl();

      if ('ajax_autocomp' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] = "busca";
          $contr_reporte_tracking->NM_ajax_flag = true;
          $contr_reporte_tracking->NM_ajax_opcao = $NM_ajax_opcao;
      }
      if ('ajax_filter_save' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] = "busca";
          $contr_reporte_tracking->NM_ajax_flag = true;
          $contr_reporte_tracking->NM_ajax_opcao = "ajax_filter_save";
      }
      if ('ajax_filter_delete' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] = "busca";
          $contr_reporte_tracking->NM_ajax_flag = true;
          $contr_reporte_tracking->NM_ajax_opcao = "ajax_filter_delete";
      }
      if ('ajax_filter_select' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] = "busca";
          $contr_reporte_tracking->NM_ajax_flag = true;
          $contr_reporte_tracking->NM_ajax_opcao = "ajax_filter_select";
      }
       $contr_reporte_tracking->controle();
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['reporte_tracking']['embutida'] && $nmgp_opcao == "formphp")
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       $contr_reporte_tracking = new reporte_tracking_apl();
       $contr_reporte_tracking->controle();
   } 
//
   function nm_limpa_str_reporte_tracking(&$str)
   {
   }
   function nm_protect_num_reporte_tracking($name, &$val)
   {
       if (empty($val))
       {
          return;
       }
       $Nm_numeric = array();
       $Nm_numeric[] = "appointments_id";
       $Nm_numeric[] = "current_status_id";
       $Nm_numeric[] = "id_proyecto";
       $Nm_numeric[] = "id_usuario";
       $Nm_numeric[] = "id_actividad";
       $Nm_numeric[] = "intervalo";
       $simb_grp = (isset($_SESSION['scriptcase']['reg_conf']['grup_num'])) ? $_SESSION['scriptcase']['reg_conf']['grup_num'] : ".";
       $simb_dec = (isset($_SESSION['scriptcase']['reg_conf']['dec_num']))  ? $_SESSION['scriptcase']['reg_conf']['dec_num']  : ",";
       $simb_neg = (isset($_SESSION['scriptcase']['reg_conf']['simb_neg'])) ? $_SESSION['scriptcase']['reg_conf']['simb_neg'] : "-";
       if (in_array($name, $Nm_numeric))
       {
           if (is_array($val))
           {
               foreach ($val as $cada_val)
               {
                  $tmp_pos = (is_string($cada_val)) ? strpos($cada_val, "##@@") : false;
                  if ($tmp_pos !== false)
                   {
                      $cada_val = substr($cada_val, 0, $tmp_pos);
                  }
                  for ($x = 0; $x < strlen($cada_val); $x++)
                  {
                      if (($cada_val[$x] < 0 || $cada_val[$x] > 9) && $cada_val[$x] != $simb_grp && $cada_val[$x] != $simb_dec && $cada_val[$x] != $simb_neg)
                      {
                          $val = array();
                          return;
                      }
                   }
               }
               return;
           }
           $cada_val = $val;
           $tmp_pos = (is_string($cada_val)) ? strpos($cada_val, "##@@") : false;
           if ($tmp_pos !== false)
            {
               $cada_val = substr($cada_val, 0, $tmp_pos);
           }
           for ($x = 0; $x < strlen($cada_val); $x++)
           {
               if (($cada_val[$x] < 0 || $cada_val[$x] > 9) && $cada_val[$x] != $simb_grp && $cada_val[$x] != $simb_dec && $cada_val[$x] != $simb_neg)
               {
                   $val = 0;
                   return;
               }
           }
       }
   }
   function reporte_tracking_pack_protect_string($sString)
   {
      $sString = (string) $sString;
      if (!empty($sString))
      {
         if (function_exists('NM_is_utf8') && NM_is_utf8($sString))
         {
             return $sString;
         }
         else
         {
             return sc_htmlentities($sString);
         }
      }
      elseif ('0' === $sString || 0 === $sString)
      {
         return '0';
      }
      else
      {
         return '';
      }
   }

    function reporte_tracking_pdf_progress_call($message, $Nm_lang, $flushBuffer = false) {
        $message = trim($message);
        if ('off' == $message)
        {
            $bol_end = TRUE;
        }
        elseif (false !== strpos($message, 'HDOC_#NM#_'))
        {
            $bol_end    = FALSE;
            $arr_partes = explode('_#NM#_', $message);
            if (4 == sizeof($arr_partes))
            {
                $int_size = $arr_partes[0];
                $str_msg  = ('F' == $arr_partes[2]) ? $Nm_lang['lang_pdff_frmt_page']  : $Nm_lang['lang_pdff_wrtg'];
                $str_msg .= $arr_partes[2];
                $int_step = ('F' == $arr_partes[2]) ? floor($int_size * 0.9) : floor($int_size * 0.95);
            }
            else
            {
                $bol_load = FALSE;
            }
        }
        else
        {
            $bol_end    = FALSE;
            $arr_partes = explode('_#NM#_', $message);
            if (3 == sizeof($arr_partes))
            {
                $int_size = $arr_partes[0];
                $int_step = $arr_partes[1];
                $str_msg  = $arr_partes[2];
            }
            else
            {
                $bol_load = FALSE;
            }
        }
        $return_message = $int_size . '!#!' . $int_step . '!#!' . ($bol_end ? '1' : '0') . '!#!' . ($bol_end ? $Nm_lang['lang_pdff_fnsh'] : $str_msg);
?>
<script type="text/javascript">
if (window.parent && typeof window.parent.updateProgressBar === "function") {
    window.parent.updateProgressBar("<?php echo trim($return_message); ?>");
}
</script>
<?php
        global $script_case_init;
        if ($flushBuffer && $_SESSION['sc_session'][$script_case_init]['reporte_tracking']['opcao'] != 'print') {
            $bufferSize = @ini_get('output_buffering');
            if ('' != $bufferSize) {
                echo str_repeat('&nbsp;', $bufferSize * 5);
            }
        }
        flush();
    }

?>
