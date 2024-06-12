<?php
class form_prod_presupuesto_form extends form_prod_presupuesto_apl
{
function Form_Init()
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
?>
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " Presupuesto"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Presupuesto"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
 <SCRIPT type="text/javascript">
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
  var sc_css_status_pwd_box = '<?php echo $this->Ini->Css_status_pwd_box; ?>';
  var sc_css_status_pwd_text = '<?php echo $this->Ini->Css_status_pwd_text; ?>';
<?php
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['sc_redir_atualiz'] == 'ok')
{
?>
  var sc_closeChange = true;
<?php
}
else
{
?>
  var sc_closeChange = false;
<?php
}
?>
 </SCRIPT>
        <SCRIPT type="text/javascript" src="../_lib/lib/js/jquery-3.6.0.min.js"></SCRIPT>
<input type="hidden" id="sc-mobile-lock" value='true' />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
<style type="text/css">
.ui-datepicker { z-index: 6 !important }
</style>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/calculator/jquery.calculator.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/calculator/jquery.plugin.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/calculator/jquery.calculator.js"></SCRIPT>
<?php
switch ($_SESSION['scriptcase']['str_lang']) {
        case 'ca':
        case 'da':
        case 'de':
        case 'es':
        case 'fr':
        case 'hr':
        case 'it':
        case 'nl':
        case 'no':
        case 'pl':
        case 'ru':
//        case 'sr':
        case 'sl':
        case 'uk':
                $tmpCalcLocale = $_SESSION['scriptcase']['str_lang'];
                break;
        case 'pt_br':
                $tmpCalcLocale = 'pt-BR';
                break;
        case 'tr':
                $tmpCalcLocale = 'ar';
                break;
        case 'zh_cn':
                $tmpCalcLocale = 'zh-CN';
                break;
//        case 'zh_hk':
//                $tmpCalcLocale = 'zh-TW';
//                break;
        default:
                $tmpCalcLocale = '';
                break;
}
if ('' != $tmpCalcLocale) {
        echo " <SCRIPT type=\"text/javascript\" src=\"{$this->Ini->path_prod}/third/jquery_plugin/calculator/jquery.calculator-$tmpCalcLocale.js\"></SCRIPT>\r\n";
}
?>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <link rel='stylesheet' href='<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/multiple-select/multiple-select.css' type='text/css'/>
 <script type='text/javascript' src='<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/multiple-select/jquery.multiple.select.js'></script>
 <style type="text/css">
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_desc ?>'], 
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_asc ?>']{opacity:1!important;} 
   .scFormLabelOddMult a img{opacity:0;transition:all .2s;} 
   .scFormLabelOddMult:HOVER a img{opacity:1;transition:all .2s;} 
 </style>
<style type="text/css">
.sc-button-image.disabled {
	opacity: 0.25
}
.sc-button-image.disabled img {
	cursor: default !important
}
</style>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
<?php
$miniCalendarFA = $this->jqueryFAFile('calendar');
if ('' != $miniCalendarFA) {
?>
<style type="text/css">
.css_read_off_fecha_ button {
	background-color: transparent;
	border: 0;
	padding: 0
}
</style>
<?php
}
?>
<?php
$miniCalculatorFA = $this->jqueryFAFile('calculator');
if ('' != $miniCalculatorFA) {
?>
<style type="text/css">
.css_read_off_unidades_ button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_valor_unitario_ button {
	background-color: transparent;
	border: 0;
	padding: 0
}
</style>
<?php
}
?>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_filter.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_filter<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_btngrp.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_btngrp<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_prod_presupuesto/form_prod_presupuesto_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_prod_presupuesto_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['last'] : 'off'); ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       if ("off" == Nav_binicio_macro_disabled) { $("#sc_b_ini_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       if ("off" == Nav_bretorna_macro_disabled) { $("#sc_b_ret_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       if ("off" == Nav_bfinal_macro_disabled) { $("#sc_b_fim_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       if ("off" == Nav_bavanca_macro_disabled) { $("#sc_b_avc_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
function summary_atualiza(reg_ini, reg_qtd, reg_tot)
{
    nm_sumario = "[<?php echo $this->Ini->Nm_lang['lang_othr_smry_info']?>]";
    nm_sumario = nm_sumario.replace("?start?", reg_ini);
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}

 function nm_field_disabled(Fields, Opt, Seq, Opcao) {
  if (Opcao != null) {
      opcao = Opcao;
  }
  else {
      opcao = "<?php if ($GLOBALS["erro_incl"] == 1) {echo "novo";} else {echo $this->nmgp_opcao;} ?>";
  }
  if (opcao == "novo" && Opt == "U") {
      return;
  }
  if (opcao != "novo" && Opt == "I") {
      return;
  }
  Field = Fields.split(";");
  for (i=0; i < Field.length; i++)
  {
     F_temp = Field[i].split("=");
     F_name = F_temp[0];
     F_opc  = (F_temp[1] && ("disabled" == F_temp[1] || "true" == F_temp[1])) ? true : false;
     ini = 1;
     xx = document.F1.sc_contr_vert.value;
     if (Seq != null) 
     {
         ini = parseInt(Seq);
         xx  = ini + 1;
     }
  }
 } // nm_field_disabled
 function nm_field_disabled_reset() {
  for (var i = 0; i <= iAjaxNewLine; i++) {
  }
 } // nm_field_disabled_reset
<?php

include_once('form_prod_presupuesto_jquery.php');

?>

 var Dyn_Ini  = true;
<?php
  if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
  {
      $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
      foreach ($Tb_err_js as $Lines)
      {
          if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          echo " " . $Lines;
      }
  }
  if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
  {
      $Msg_Inval = sc_convert_encoding("Invalido", $_SESSION['scriptcase']['charset'], "UTF-8");
  }
  echo " var SC_crit_inv = \"" . $Msg_Inval . "\";\r\n";
?>
 $(function() {

  $(".scBtnGrpText").mouseover(function() { $(this).addClass("scBtnGrpTextOver"); }).mouseout(function() { $(this).removeClass("scBtnGrpTextOver"); });
     $(".scBtnGrpClick").mouseup(function(){
          event.preventDefault();
          if(event.target !== event.currentTarget) return;
          if($(this).find("a").prop('href') != '')
          {
              $(this).find("a").click();
          }
          else
          {
              eval($(this).find("a").prop('onclick'));
          }
  });
  if (Dyn_Ini)
  {
      Dyn_Ini = false;
      SC_carga_evt_jquery('all');
  }

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).on('load', function() {
     if ($('#t').length>0) {
         scQuickSearchKeyUp('t', null);
     }
   });
   function SC_btn_grp_text() {
      $(".scBtnGrpText").mouseover(function() { $(this).addClass("scBtnGrpTextOver"); }).mouseout(function() { $(this).removeClass("scBtnGrpTextOver"); });
   };
   function scQuickSearchSubmit_t() {
     nm_move('fast_search', 't');
   }

   function scQuickSearchKeyUp(sPos, e) {
     if (null != e) {
       var keyPressed = e.charCode || e.keyCode || e.which;
       if (13 == keyPressed) {
         if ('t' == sPos) scQuickSearchSubmit_t();
       }
       else
       {
           $('#SC_fast_search_submit_'+sPos).show();
       }
     }
   }
   function nm_gp_submit_qsearch(pos)
   {
        nm_move('fast_search', pos);
   }
   function nm_gp_open_qsearch_div(pos)
   {
        if (typeof nm_gp_open_qsearch_div_mobile == 'function') {
            return nm_gp_open_qsearch_div_mobile(pos);
        }
        if($('#SC_fast_search_dropdown_' + pos).hasClass('fa-caret-down'))
        {
            if(($('#quicksearchph_' + pos).offset().top+$('#id_qs_div_' + pos).height()+10) >= $(document).height())
            {
                $('#id_qs_div_' + pos).offset({top:($('#quicksearchph_' + pos).offset().top-($('#quicksearchph_' + pos).height()/2)-$('#id_qs_div_' + pos).height()-4)});
            }

            nm_gp_open_qsearch_div_store_temp(pos);
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-down').addClass('fa-caret-up');
        }
        else
        {
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-up').addClass('fa-caret-down');
        }
        $('#id_qs_div_' + pos).toggle();
   }

   var tmp_qs_arr_fields = [], tmp_qs_arr_cond = "";
   function nm_gp_open_qsearch_div_store_temp(pos)
   {
        tmp_qs_arr_fields = [], tmp_qs_str_cond = "";

        if($('#fast_search_f0_' + pos).prop('type') == 'select-multiple')
        {
            tmp_qs_arr_fields = $('#fast_search_f0_' + pos).val();
        }
        else
        {
            tmp_qs_arr_fields.push($('#fast_search_f0_' + pos).val());
        }

        tmp_qs_str_cond = $('#cond_fast_search_f0_' + pos).val();
   }

   function nm_gp_cancel_qsearch_div_store_temp(pos)
   {
        $('#fast_search_f0_' + pos).val('');
        $("#fast_search_f0_" + pos + " option").prop('selected', false);
        for(it=0; it<tmp_qs_arr_fields.length; it++)
        {
            $("#fast_search_f0_" + pos + " option[value='"+ tmp_qs_arr_fields[it] +"']").prop('selected', true);
        }
        $("#fast_search_f0_" + pos).change();
        tmp_qs_arr_fields = [];

        $('#cond_fast_search_f0_' + pos).val(tmp_qs_str_cond);
        $('#cond_fast_search_f0_' + pos).change();
        tmp_qs_str_cond = "";

        nm_gp_open_qsearch_div(pos);
   } if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['recarga'];
}
if ('novo' == $opcao_botoes && $this->Embutida_form)
{
    $opcao_botoes = 'inicio';
}
    $remove_margin = '';
    $remove_border = '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['link_info']['remove_border']) {
        $remove_border = 'border-width: 0; ';
    }
    $vertical_center = '';
?>
<body class="scFormPage sc-app-form" style="<?php echo $remove_margin . $str_iframe_body . $vertical_center; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_prod_presupuesto_js0.php");
?>
<script type="text/javascript"> 
  sc_quant_excl = <?php if (!isset($sc_check_excl)) {$sc_check_excl = array();} echo count($sc_check_excl); ?>; 
  <?php if (!isset($sc_check_incl)) {$sc_check_incl = array();}?>; 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
 </script>
<form  id= "id_Fdyn_search" name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_prod_presupuesto'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_prod_presupuesto'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable scFormToastTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle scFormToastTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage scFormToastMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<?php
$msgDefClose = isset($this->arr_buttons['bmessageclose']) ? $this->arr_buttons['bmessageclose']['value'] : 'Ok';
?>
<script type="text/javascript">
var scMsgDefTitle = "<?php if (isset($this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'])) {echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'];} ?>";
var scMsgDefButton = "Ok";
var scMsgDefClose = "<?php echo $msgDefClose; ?>";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->sc_page; ?>";
</script>
<?php
if ($this->record_insert_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmi']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
if ($this->record_delete_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmd']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
?>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="60%">
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
$this->displayAppHeader();
?>
<tr><td>
<?php
$this->displayTopToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['fast_search'][2] : "";
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <input id='fast_search_f0_t' type="hidden" name="nmgp_fast_search_t" value="SC_all_Cmp">
          <select id='cond_fast_search_f0_t' class="scFormToolbarInput" style="vertical-align: middle;display:none;" name="nmgp_cond_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $OPC_sel = ("qp" == $OPC_arg) ? " selected" : "";
           echo "           <option value='qp'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
?> 
          </select>
          <span id="quicksearchph_t" class="scFormToolbarInput" style='display: inline-block; vertical-align: inherit'>
              <span>
                  <input type="text" id="SC_fast_search_t" class="scFormToolbarInputText" style="border-width: 0px;;" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>">&nbsp;
                  <img style="display: <?php echo $stateSearchIconSearch ?>; "  id="SC_fast_search_submit_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search; ?>" onclick="scQuickSearchSubmit_t();">
                  <img style="display: <?php echo $stateSearchIconClose ?>; " id="SC_fast_search_close_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean; ?>" onclick="document.getElementById('SC_fast_search_t').value = '__Clear_Fast__'; nm_move('fast_search', 't');">
              </span>
          </span>  </div>
  <?php
      }
        $sCondStyle = ($opcao_botoes != "novo" &&  $this->nmgp_botoes['dynsearch'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['dynsearch']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['dynsearch']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['dynsearch']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['dynsearch']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['dynsearch'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdynamicsearch", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); }", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); }", "dynamic_search_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "do_ajax_form_prod_presupuesto_add_new_line(); return false;", "do_ajax_form_prod_presupuesto_add_new_line(); return false;", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "nm_move ('novo');", "nm_move ('novo');", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "nm_atualiza ('incluir');", "nm_atualiza ('incluir');", "sc_b_ins_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "" . $this->NM_cancel_insert_new . " document.F5.submit();", "" . $this->NM_cancel_insert_new . " document.F5.submit();", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['sc_btn_0'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_0'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_0", "sc_btn_sc_btn_0()", "sc_btn_sc_btn_0()", "sc_sc_btn_0_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['sc_btn_0'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_0'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_0", "sc_btn_sc_btn_0()", "sc_btn_sc_btn_0()", "sc_sc_btn_0_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['sc_btn_1'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['sc_btn_1']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['sc_btn_1']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_1']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_1']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_1'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_1", "sc_btn_sc_btn_1()", "sc_btn_sc_btn_1()", "sc_sc_btn_1_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['sc_btn_1'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['sc_btn_1']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['sc_btn_1']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_1']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_1']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['sc_btn_1'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_1", "sc_btn_sc_btn_1()", "sc_btn_sc_btn_1()", "sc_sc_btn_1_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F5('" . $nm_url_saida. "');", "scFormClose_F5('" . $nm_url_saida. "');", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F5('" . $nm_url_saida. "');", "scFormClose_F5('" . $nm_url_saida. "');", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dyn_refresh'] = array();
$this->html_dynamic_search();
?>
<tr><td>
<?php
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['empty_filter'] = true;
       }
       echo "<tr><td>";
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
     <div id="SC_tab_mult_reg">
<?php
}

function Form_Table($Table_refresh = false)
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
   if ($Table_refresh) 
   { 
       ob_start();
   }
?>
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
$labelRowCount = 0;
?>
   <tr class="sc-ui-header-row" id="sc-id-fixed-headers-row-<?php echo $labelRowCount++ ?>">
<?php
$orderColName = '';
$orderColOrient = '';
$orderColRule = '';
?>
    <script type="text/javascript">
     var orderImgAsc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc ?>";
     var orderImgDesc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc ?>";
     var orderImgNone = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort ?>";
     var orderColName = "";
     function scSetOrderColumn(clickedColumn) {
      $(".sc-ui-img-order-column").attr("src", orderImgNone);
      if (clickedColumn != orderColName) {
       orderColName = clickedColumn;
       orderColOrient = orderImgAsc;
      }
      else if ("" != orderColName) {
       orderColOrient = orderColOrient == orderImgAsc ? orderImgDesc : orderImgAsc;
      }
      else {
       orderColName = "";
       orderColOrient = "";
      }
      $("#sc-id-img-order-" + orderColName).attr("src", orderColOrient);
     }
    </script>
<?php
     $Col_span = "";


       if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") { $Col_span = " colspan=2"; }
    if (!$this->Embutida_form && $this->nmgp_opcao == "novo") { $Col_span = " colspan=2"; }
 ?>

    <TD class="scFormLabelOddMult sc-col-title" style="display: none;" <?php echo $Col_span ?>> &nbsp; </TD>
   
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {?>
    <TD class="<?php echo '' ?>scFormLabelOddMult sc-col-title"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {?>
    <TD class="<?php echo '' ?>scFormLabelOddMult sc-col-title"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php if ((!isset($this->nmgp_cmp_hidden['id_']) || $this->nmgp_cmp_hidden['id_'] == 'on') && ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir"))) { 
      if (!isset($this->nm_new_label['id_'])) {
          $this->nm_new_label['id_'] = "ID"; } ?>
<?php
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;

        // label
        $label_labelContent = $this->nm_new_label['id_'];
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
?>

    <TD class="<?php echo '' ?>scFormLabelOddMult css_id__label sc-col-title" id="hidden_field_label_id_" style="<?php echo $sStyleHidden_id_; ?>" > <?php echo $label_final ?> </TD>
   <?php $this->form_fixed_column_no++;}?>

   <?php
    $sStyleHidden_id_proyecto_ = '';
    if (isset($this->nmgp_cmp_hidden['id_proyecto_']) && $this->nmgp_cmp_hidden['id_proyecto_'] == 'off') {
        $sStyleHidden_id_proyecto_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['id_proyecto_']) || $this->nmgp_cmp_hidden['id_proyecto_'] == 'on') {
        if (!isset($this->nm_new_label['id_proyecto_'])) {
            $this->nm_new_label['id_proyecto_'] = "Proyecto";
        }
        $SC_Label = "" . $this->nm_new_label['id_proyecto_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_fieldName .= "&nbsp;<span class=\"scFormRequiredOddMult\">*</span>&nbsp;";
        $fieldSortRule = $this->scGetColumnOrderRule("id_proyecto", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("id_proyecto", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'id_proyecto')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_id_proyecto__label sc-col-title" id="hidden_field_label_id_proyecto_" style="<?php echo $sStyleHidden_id_proyecto_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_id_item_ = '';
    if (isset($this->nmgp_cmp_hidden['id_item_']) && $this->nmgp_cmp_hidden['id_item_'] == 'off') {
        $sStyleHidden_id_item_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['id_item_']) || $this->nmgp_cmp_hidden['id_item_'] == 'on') {
        if (!isset($this->nm_new_label['id_item_'])) {
            $this->nm_new_label['id_item_'] = "Item";
        }
        $SC_Label = "" . $this->nm_new_label['id_item_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_fieldName .= "&nbsp;<span class=\"scFormRequiredOddMult\">*</span>&nbsp;";
        $fieldSortRule = $this->scGetColumnOrderRule("id_item", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("id_item", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'id_item')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_id_item__label sc-col-title" id="hidden_field_label_id_item_" style="<?php echo $sStyleHidden_id_item_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_orden_ = '';
    if (isset($this->nmgp_cmp_hidden['orden_']) && $this->nmgp_cmp_hidden['orden_'] == 'off') {
        $sStyleHidden_orden_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['orden_']) || $this->nmgp_cmp_hidden['orden_'] == 'on') {
        if (!isset($this->nm_new_label['orden_'])) {
            $this->nm_new_label['orden_'] = "Orden";
        }
        $SC_Label = "" . $this->nm_new_label['orden_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("orden", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("orden", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'orden')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_orden__label sc-col-title" id="hidden_field_label_orden_" style="<?php echo $sStyleHidden_orden_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_vigente_ = '';
    if (isset($this->nmgp_cmp_hidden['vigente_']) && $this->nmgp_cmp_hidden['vigente_'] == 'off') {
        $sStyleHidden_vigente_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['vigente_']) || $this->nmgp_cmp_hidden['vigente_'] == 'on') {
        if (!isset($this->nm_new_label['vigente_'])) {
            $this->nm_new_label['vigente_'] = "Vigente";
        }
        $SC_Label = "" . $this->nm_new_label['vigente_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_fieldName .= "&nbsp;<span class=\"scFormRequiredOddMult\">*</span>&nbsp;";
        $fieldSortRule = $this->scGetColumnOrderRule("vigente", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("vigente", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'vigente')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_vigente__label sc-col-title" id="hidden_field_label_vigente_" style="<?php echo $sStyleHidden_vigente_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_id_partida_periodo_ = '';
    if (isset($this->nmgp_cmp_hidden['id_partida_periodo_']) && $this->nmgp_cmp_hidden['id_partida_periodo_'] == 'off') {
        $sStyleHidden_id_partida_periodo_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['id_partida_periodo_']) || $this->nmgp_cmp_hidden['id_partida_periodo_'] == 'on') {
        if (!isset($this->nm_new_label['id_partida_periodo_'])) {
            $this->nm_new_label['id_partida_periodo_'] = "Partida Periodo";
        }
        $SC_Label = "" . $this->nm_new_label['id_partida_periodo_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_fieldName .= "&nbsp;<span class=\"scFormRequiredOddMult\">*</span>&nbsp;";
        $fieldSortRule = $this->scGetColumnOrderRule("id_partida_periodo", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("id_partida_periodo", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'id_partida_periodo')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_id_partida_periodo__label sc-col-title" id="hidden_field_label_id_partida_periodo_" style="<?php echo $sStyleHidden_id_partida_periodo_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_fecha_ = '';
    if (isset($this->nmgp_cmp_hidden['fecha_']) && $this->nmgp_cmp_hidden['fecha_'] == 'off') {
        $sStyleHidden_fecha_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['fecha_']) || $this->nmgp_cmp_hidden['fecha_'] == 'on') {
        if (!isset($this->nm_new_label['fecha_'])) {
            $this->nm_new_label['fecha_'] = "Fecha";
        }
        $SC_Label = "" . $this->nm_new_label['fecha_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_fieldName .= "&nbsp;<span class=\"scFormRequiredOddMult\">*</span>&nbsp;";
        $fieldSortRule = $this->scGetColumnOrderRule("fecha", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("fecha", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'fecha')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_fecha__label sc-col-title" id="hidden_field_label_fecha_" style="<?php echo $sStyleHidden_fecha_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_unidades_ = '';
    if (isset($this->nmgp_cmp_hidden['unidades_']) && $this->nmgp_cmp_hidden['unidades_'] == 'off') {
        $sStyleHidden_unidades_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['unidades_']) || $this->nmgp_cmp_hidden['unidades_'] == 'on') {
        if (!isset($this->nm_new_label['unidades_'])) {
            $this->nm_new_label['unidades_'] = "Unidades";
        }
        $SC_Label = "" . $this->nm_new_label['unidades_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_fieldName .= "&nbsp;<span class=\"scFormRequiredOddMult\">*</span>&nbsp;";
        $fieldSortRule = $this->scGetColumnOrderRule("unidades", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("unidades", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'unidades')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_unidades__label sc-col-title" id="hidden_field_label_unidades_" style="<?php echo $sStyleHidden_unidades_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_valor_unitario_ = '';
    if (isset($this->nmgp_cmp_hidden['valor_unitario_']) && $this->nmgp_cmp_hidden['valor_unitario_'] == 'off') {
        $sStyleHidden_valor_unitario_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['valor_unitario_']) || $this->nmgp_cmp_hidden['valor_unitario_'] == 'on') {
        if (!isset($this->nm_new_label['valor_unitario_'])) {
            $this->nm_new_label['valor_unitario_'] = "Valor Unitario";
        }
        $SC_Label = "" . $this->nm_new_label['valor_unitario_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_fieldName .= "&nbsp;<span class=\"scFormRequiredOddMult\">*</span>&nbsp;";
        $fieldSortRule = $this->scGetColumnOrderRule("valor_unitario", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("valor_unitario", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'valor_unitario')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_valor_unitario__label sc-col-title" id="hidden_field_label_valor_unitario_" style="<?php echo $sStyleHidden_valor_unitario_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_monto_uf_ = '';
    if (isset($this->nmgp_cmp_hidden['monto_uf_']) && $this->nmgp_cmp_hidden['monto_uf_'] == 'off') {
        $sStyleHidden_monto_uf_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['monto_uf_']) || $this->nmgp_cmp_hidden['monto_uf_'] == 'on') {
        if (!isset($this->nm_new_label['monto_uf_'])) {
            $this->nm_new_label['monto_uf_'] = "Monto";
        }
        $SC_Label = "" . $this->nm_new_label['monto_uf_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_fieldName .= "&nbsp;<span class=\"scFormRequiredOddMult\">*</span>&nbsp;";
        $fieldSortRule = $this->scGetColumnOrderRule("monto_uf", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("monto_uf", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'monto_uf')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_monto_uf__label sc-col-title" id="hidden_field_label_monto_uf_" style="<?php echo $sStyleHidden_monto_uf_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_tipo_moneda_ = '';
    if (isset($this->nmgp_cmp_hidden['tipo_moneda_']) && $this->nmgp_cmp_hidden['tipo_moneda_'] == 'off') {
        $sStyleHidden_tipo_moneda_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['tipo_moneda_']) || $this->nmgp_cmp_hidden['tipo_moneda_'] == 'on') {
        if (!isset($this->nm_new_label['tipo_moneda_'])) {
            $this->nm_new_label['tipo_moneda_'] = "Tipo Moneda";
        }
        $SC_Label = "" . $this->nm_new_label['tipo_moneda_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("tipo_moneda", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("tipo_moneda", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'tipo_moneda')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_tipo_moneda__label sc-col-title" id="hidden_field_label_tipo_moneda_" style="<?php echo $sStyleHidden_tipo_moneda_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_observaciones_ = '';
    if (isset($this->nmgp_cmp_hidden['observaciones_']) && $this->nmgp_cmp_hidden['observaciones_'] == 'off') {
        $sStyleHidden_observaciones_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['observaciones_']) || $this->nmgp_cmp_hidden['observaciones_'] == 'on') {
        if (!isset($this->nm_new_label['observaciones_'])) {
            $this->nm_new_label['observaciones_'] = "Observaciones";
        }
        $SC_Label = "" . $this->nm_new_label['observaciones_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("observaciones", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("observaciones", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'observaciones')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo '' ?>scFormLabelOddMult css_observaciones__label sc-col-title" id="hidden_field_label_observaciones_" style="<?php echo $sStyleHidden_observaciones_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>





    <script type="text/javascript">
     var orderColOrient = "<?php echo $orderColOrient ?>";
     orderColRule = "<?php echo $orderColRule ?>";
     scSetOrderColumn("<?php echo $orderColName ?>");
    </script>
   </tr>
<?php   
} 
function Form_Corpo($Line_Add = false, $Table_refresh = false) 
{ 
   global $sc_seq_vert, $sc_check_incl, $sc_check_excl; 
   $sc_hidden_no = 1; $sc_hidden_yes = 0;
   if ($Line_Add) 
   { 
       ob_start();
       $iStart = sizeof($this->form_vert_form_prod_presupuesto);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_prod_presupuesto = $this->form_vert_form_prod_presupuesto;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_prod_presupuesto))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_']))
           {
               $this->nmgp_cmp_readonly['id_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_proyecto_']))
           {
               $this->nmgp_cmp_readonly['id_proyecto_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['monto_uf_']))
           {
               $this->nmgp_cmp_readonly['monto_uf_'] = 'on';
           }
   foreach ($this->form_vert_form_prod_presupuesto as $sc_seq_vert => $sc_lixo)
   {
       $this->form_fixed_column_no = 0;
       $this->loadRecordState($sc_seq_vert);
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['id_'] = true;
           $this->nmgp_cmp_readonly['id_proyecto_'] = true;
           $this->nmgp_cmp_readonly['id_item_'] = true;
           $this->nmgp_cmp_readonly['orden_'] = true;
           $this->nmgp_cmp_readonly['vigente_'] = true;
           $this->nmgp_cmp_readonly['id_partida_periodo_'] = true;
           $this->nmgp_cmp_readonly['fecha_'] = true;
           $this->nmgp_cmp_readonly['unidades_'] = true;
           $this->nmgp_cmp_readonly['valor_unitario_'] = true;
           $this->nmgp_cmp_readonly['monto_uf_'] = true;
           $this->nmgp_cmp_readonly['tipo_moneda_'] = true;
           $this->nmgp_cmp_readonly['observaciones_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['id_']) || $this->nmgp_cmp_readonly['id_'] != "on") {$this->nmgp_cmp_readonly['id_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['id_proyecto_']) || $this->nmgp_cmp_readonly['id_proyecto_'] != "on") {$this->nmgp_cmp_readonly['id_proyecto_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['id_item_']) || $this->nmgp_cmp_readonly['id_item_'] != "on") {$this->nmgp_cmp_readonly['id_item_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['orden_']) || $this->nmgp_cmp_readonly['orden_'] != "on") {$this->nmgp_cmp_readonly['orden_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['vigente_']) || $this->nmgp_cmp_readonly['vigente_'] != "on") {$this->nmgp_cmp_readonly['vigente_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['id_partida_periodo_']) || $this->nmgp_cmp_readonly['id_partida_periodo_'] != "on") {$this->nmgp_cmp_readonly['id_partida_periodo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['fecha_']) || $this->nmgp_cmp_readonly['fecha_'] != "on") {$this->nmgp_cmp_readonly['fecha_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['unidades_']) || $this->nmgp_cmp_readonly['unidades_'] != "on") {$this->nmgp_cmp_readonly['unidades_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['valor_unitario_']) || $this->nmgp_cmp_readonly['valor_unitario_'] != "on") {$this->nmgp_cmp_readonly['valor_unitario_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['monto_uf_']) || $this->nmgp_cmp_readonly['monto_uf_'] != "on") {$this->nmgp_cmp_readonly['monto_uf_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tipo_moneda_']) || $this->nmgp_cmp_readonly['tipo_moneda_'] != "on") {$this->nmgp_cmp_readonly['tipo_moneda_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['observaciones_']) || $this->nmgp_cmp_readonly['observaciones_'] != "on") {$this->nmgp_cmp_readonly['observaciones_'] = false;}
       }
            if (isset($this->form_vert_form_preenchimento[$sc_seq_vert])) {
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
            }
        $this->id_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['id_']; 
       $id_ = $this->id_; 
       $sStyleHidden_id_ = '';
       if (isset($sCheckRead_id_))
       {
           unset($sCheckRead_id_);
       }
       if (isset($this->nmgp_cmp_readonly['id_']))
       {
           $sCheckRead_id_ = $this->nmgp_cmp_readonly['id_'];
       }
       if (isset($this->nmgp_cmp_hidden['id_']) && $this->nmgp_cmp_hidden['id_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['id_']);
           $sStyleHidden_id_ = 'display: none;';
       }
       $bTestReadOnly_id_ = true;
       $sStyleReadLab_id_ = 'display: none;';
       $sStyleReadInp_id_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_"]) &&  $this->nmgp_cmp_readonly["id_"] == "on"))
       {
           $bTestReadOnly_id_ = false;
           unset($this->nmgp_cmp_readonly['id_']);
           $sStyleReadLab_id_ = '';
           $sStyleReadInp_id_ = 'display: none;';
       }
       $this->id_proyecto_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['id_proyecto_']; 
       $id_proyecto_ = $this->id_proyecto_; 
       $sStyleHidden_id_proyecto_ = '';
       if (isset($sCheckRead_id_proyecto_))
       {
           unset($sCheckRead_id_proyecto_);
       }
       if (isset($this->nmgp_cmp_readonly['id_proyecto_']))
       {
           $sCheckRead_id_proyecto_ = $this->nmgp_cmp_readonly['id_proyecto_'];
       }
       if (isset($this->nmgp_cmp_hidden['id_proyecto_']) && $this->nmgp_cmp_hidden['id_proyecto_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['id_proyecto_']);
           $sStyleHidden_id_proyecto_ = 'display: none;';
       }
       $bTestReadOnly_id_proyecto_ = true;
       $sStyleReadLab_id_proyecto_ = 'display: none;';
       $sStyleReadInp_id_proyecto_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_proyecto_"]) &&  $this->nmgp_cmp_readonly["id_proyecto_"] == "on"))
       {
           $bTestReadOnly_id_proyecto_ = false;
           unset($this->nmgp_cmp_readonly['id_proyecto_']);
           $sStyleReadLab_id_proyecto_ = '';
           $sStyleReadInp_id_proyecto_ = 'display: none;';
       }
       $this->id_item_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['id_item_']; 
       $id_item_ = $this->id_item_; 
       $sStyleHidden_id_item_ = '';
       if (isset($sCheckRead_id_item_))
       {
           unset($sCheckRead_id_item_);
       }
       if (isset($this->nmgp_cmp_readonly['id_item_']))
       {
           $sCheckRead_id_item_ = $this->nmgp_cmp_readonly['id_item_'];
       }
       if (isset($this->nmgp_cmp_hidden['id_item_']) && $this->nmgp_cmp_hidden['id_item_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['id_item_']);
           $sStyleHidden_id_item_ = 'display: none;';
       }
       $bTestReadOnly_id_item_ = true;
       $sStyleReadLab_id_item_ = 'display: none;';
       $sStyleReadInp_id_item_ = '';
       if (isset($this->nmgp_cmp_readonly['id_item_']) && $this->nmgp_cmp_readonly['id_item_'] == 'on')
       {
           $bTestReadOnly_id_item_ = false;
           unset($this->nmgp_cmp_readonly['id_item_']);
           $sStyleReadLab_id_item_ = '';
           $sStyleReadInp_id_item_ = 'display: none;';
       }
       $this->orden_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['orden_']; 
       $orden_ = $this->orden_; 
       $sStyleHidden_orden_ = '';
       if (isset($sCheckRead_orden_))
       {
           unset($sCheckRead_orden_);
       }
       if (isset($this->nmgp_cmp_readonly['orden_']))
       {
           $sCheckRead_orden_ = $this->nmgp_cmp_readonly['orden_'];
       }
       if (isset($this->nmgp_cmp_hidden['orden_']) && $this->nmgp_cmp_hidden['orden_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['orden_']);
           $sStyleHidden_orden_ = 'display: none;';
       }
       $bTestReadOnly_orden_ = true;
       $sStyleReadLab_orden_ = 'display: none;';
       $sStyleReadInp_orden_ = '';
       if (isset($this->nmgp_cmp_readonly['orden_']) && $this->nmgp_cmp_readonly['orden_'] == 'on')
       {
           $bTestReadOnly_orden_ = false;
           unset($this->nmgp_cmp_readonly['orden_']);
           $sStyleReadLab_orden_ = '';
           $sStyleReadInp_orden_ = 'display: none;';
       }
       $this->vigente_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['vigente_']; 
       $vigente_ = $this->vigente_; 
       $sStyleHidden_vigente_ = '';
       if (isset($sCheckRead_vigente_))
       {
           unset($sCheckRead_vigente_);
       }
       if (isset($this->nmgp_cmp_readonly['vigente_']))
       {
           $sCheckRead_vigente_ = $this->nmgp_cmp_readonly['vigente_'];
       }
       if (isset($this->nmgp_cmp_hidden['vigente_']) && $this->nmgp_cmp_hidden['vigente_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['vigente_']);
           $sStyleHidden_vigente_ = 'display: none;';
       }
       $bTestReadOnly_vigente_ = true;
       $sStyleReadLab_vigente_ = 'display: none;';
       $sStyleReadInp_vigente_ = '';
       if (isset($this->nmgp_cmp_readonly['vigente_']) && $this->nmgp_cmp_readonly['vigente_'] == 'on')
       {
           $bTestReadOnly_vigente_ = false;
           unset($this->nmgp_cmp_readonly['vigente_']);
           $sStyleReadLab_vigente_ = '';
           $sStyleReadInp_vigente_ = 'display: none;';
       }
       $this->id_partida_periodo_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['id_partida_periodo_']; 
       $id_partida_periodo_ = $this->id_partida_periodo_; 
       $sStyleHidden_id_partida_periodo_ = '';
       if (isset($sCheckRead_id_partida_periodo_))
       {
           unset($sCheckRead_id_partida_periodo_);
       }
       if (isset($this->nmgp_cmp_readonly['id_partida_periodo_']))
       {
           $sCheckRead_id_partida_periodo_ = $this->nmgp_cmp_readonly['id_partida_periodo_'];
       }
       if (isset($this->nmgp_cmp_hidden['id_partida_periodo_']) && $this->nmgp_cmp_hidden['id_partida_periodo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['id_partida_periodo_']);
           $sStyleHidden_id_partida_periodo_ = 'display: none;';
       }
       $bTestReadOnly_id_partida_periodo_ = true;
       $sStyleReadLab_id_partida_periodo_ = 'display: none;';
       $sStyleReadInp_id_partida_periodo_ = '';
       if (isset($this->nmgp_cmp_readonly['id_partida_periodo_']) && $this->nmgp_cmp_readonly['id_partida_periodo_'] == 'on')
       {
           $bTestReadOnly_id_partida_periodo_ = false;
           unset($this->nmgp_cmp_readonly['id_partida_periodo_']);
           $sStyleReadLab_id_partida_periodo_ = '';
           $sStyleReadInp_id_partida_periodo_ = 'display: none;';
       }
       $this->fecha_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['fecha_']; 
       $fecha_ = $this->fecha_; 
       $sStyleHidden_fecha_ = '';
       if (isset($sCheckRead_fecha_))
       {
           unset($sCheckRead_fecha_);
       }
       if (isset($this->nmgp_cmp_readonly['fecha_']))
       {
           $sCheckRead_fecha_ = $this->nmgp_cmp_readonly['fecha_'];
       }
       if (isset($this->nmgp_cmp_hidden['fecha_']) && $this->nmgp_cmp_hidden['fecha_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['fecha_']);
           $sStyleHidden_fecha_ = 'display: none;';
       }
       $bTestReadOnly_fecha_ = true;
       $sStyleReadLab_fecha_ = 'display: none;';
       $sStyleReadInp_fecha_ = '';
       if (isset($this->nmgp_cmp_readonly['fecha_']) && $this->nmgp_cmp_readonly['fecha_'] == 'on')
       {
           $bTestReadOnly_fecha_ = false;
           unset($this->nmgp_cmp_readonly['fecha_']);
           $sStyleReadLab_fecha_ = '';
           $sStyleReadInp_fecha_ = 'display: none;';
       }
       $this->unidades_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['unidades_']; 
       $unidades_ = $this->unidades_; 
       $sStyleHidden_unidades_ = '';
       if (isset($sCheckRead_unidades_))
       {
           unset($sCheckRead_unidades_);
       }
       if (isset($this->nmgp_cmp_readonly['unidades_']))
       {
           $sCheckRead_unidades_ = $this->nmgp_cmp_readonly['unidades_'];
       }
       if (isset($this->nmgp_cmp_hidden['unidades_']) && $this->nmgp_cmp_hidden['unidades_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['unidades_']);
           $sStyleHidden_unidades_ = 'display: none;';
       }
       $bTestReadOnly_unidades_ = true;
       $sStyleReadLab_unidades_ = 'display: none;';
       $sStyleReadInp_unidades_ = '';
       if (isset($this->nmgp_cmp_readonly['unidades_']) && $this->nmgp_cmp_readonly['unidades_'] == 'on')
       {
           $bTestReadOnly_unidades_ = false;
           unset($this->nmgp_cmp_readonly['unidades_']);
           $sStyleReadLab_unidades_ = '';
           $sStyleReadInp_unidades_ = 'display: none;';
       }
       $this->valor_unitario_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['valor_unitario_']; 
       $valor_unitario_ = $this->valor_unitario_; 
       $sStyleHidden_valor_unitario_ = '';
       if (isset($sCheckRead_valor_unitario_))
       {
           unset($sCheckRead_valor_unitario_);
       }
       if (isset($this->nmgp_cmp_readonly['valor_unitario_']))
       {
           $sCheckRead_valor_unitario_ = $this->nmgp_cmp_readonly['valor_unitario_'];
       }
       if (isset($this->nmgp_cmp_hidden['valor_unitario_']) && $this->nmgp_cmp_hidden['valor_unitario_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['valor_unitario_']);
           $sStyleHidden_valor_unitario_ = 'display: none;';
       }
       $bTestReadOnly_valor_unitario_ = true;
       $sStyleReadLab_valor_unitario_ = 'display: none;';
       $sStyleReadInp_valor_unitario_ = '';
       if (isset($this->nmgp_cmp_readonly['valor_unitario_']) && $this->nmgp_cmp_readonly['valor_unitario_'] == 'on')
       {
           $bTestReadOnly_valor_unitario_ = false;
           unset($this->nmgp_cmp_readonly['valor_unitario_']);
           $sStyleReadLab_valor_unitario_ = '';
           $sStyleReadInp_valor_unitario_ = 'display: none;';
       }
       $this->monto_uf_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['monto_uf_']; 
       $monto_uf_ = $this->monto_uf_; 
       $sStyleHidden_monto_uf_ = '';
       if (isset($sCheckRead_monto_uf_))
       {
           unset($sCheckRead_monto_uf_);
       }
       if (isset($this->nmgp_cmp_readonly['monto_uf_']))
       {
           $sCheckRead_monto_uf_ = $this->nmgp_cmp_readonly['monto_uf_'];
       }
       if (isset($this->nmgp_cmp_hidden['monto_uf_']) && $this->nmgp_cmp_hidden['monto_uf_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['monto_uf_']);
           $sStyleHidden_monto_uf_ = 'display: none;';
       }
       $bTestReadOnly_monto_uf_ = true;
       $sStyleReadLab_monto_uf_ = 'display: none;';
       $sStyleReadInp_monto_uf_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["monto_uf_"]) &&  $this->nmgp_cmp_readonly["monto_uf_"] == "on"))
       {
           $bTestReadOnly_monto_uf_ = false;
           unset($this->nmgp_cmp_readonly['monto_uf_']);
           $sStyleReadLab_monto_uf_ = '';
           $sStyleReadInp_monto_uf_ = 'display: none;';
       }
       $this->tipo_moneda_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['tipo_moneda_']; 
       $tipo_moneda_ = $this->tipo_moneda_; 
       $sStyleHidden_tipo_moneda_ = '';
       if (isset($sCheckRead_tipo_moneda_))
       {
           unset($sCheckRead_tipo_moneda_);
       }
       if (isset($this->nmgp_cmp_readonly['tipo_moneda_']))
       {
           $sCheckRead_tipo_moneda_ = $this->nmgp_cmp_readonly['tipo_moneda_'];
       }
       if (isset($this->nmgp_cmp_hidden['tipo_moneda_']) && $this->nmgp_cmp_hidden['tipo_moneda_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tipo_moneda_']);
           $sStyleHidden_tipo_moneda_ = 'display: none;';
       }
       $bTestReadOnly_tipo_moneda_ = true;
       $sStyleReadLab_tipo_moneda_ = 'display: none;';
       $sStyleReadInp_tipo_moneda_ = '';
       if (isset($this->nmgp_cmp_readonly['tipo_moneda_']) && $this->nmgp_cmp_readonly['tipo_moneda_'] == 'on')
       {
           $bTestReadOnly_tipo_moneda_ = false;
           unset($this->nmgp_cmp_readonly['tipo_moneda_']);
           $sStyleReadLab_tipo_moneda_ = '';
           $sStyleReadInp_tipo_moneda_ = 'display: none;';
       }
       $this->observaciones_ = $this->form_vert_form_prod_presupuesto[$sc_seq_vert]['observaciones_']; 
       $observaciones_ = $this->observaciones_; 
       $sStyleHidden_observaciones_ = '';
       if (isset($sCheckRead_observaciones_))
       {
           unset($sCheckRead_observaciones_);
       }
       if (isset($this->nmgp_cmp_readonly['observaciones_']))
       {
           $sCheckRead_observaciones_ = $this->nmgp_cmp_readonly['observaciones_'];
       }
       if (isset($this->nmgp_cmp_hidden['observaciones_']) && $this->nmgp_cmp_hidden['observaciones_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['observaciones_']);
           $sStyleHidden_observaciones_ = 'display: none;';
       }
       $bTestReadOnly_observaciones_ = true;
       $sStyleReadLab_observaciones_ = 'display: none;';
       $sStyleReadInp_observaciones_ = '';
       if (isset($this->nmgp_cmp_readonly['observaciones_']) && $this->nmgp_cmp_readonly['observaciones_'] == 'on')
       {
           $bTestReadOnly_observaciones_ = false;
           unset($this->nmgp_cmp_readonly['observaciones_']);
           $sStyleReadLab_observaciones_ = '';
           $sStyleReadInp_observaciones_ = 'display: none;';
       }

       $nm_cor_fun_vert = (isset($nm_cor_fun_vert) && $nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = (isset($nm_img_fun_cel)  && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?> class="sc-row" data-sc-row-number="<?php echo $sc_seq_vert; ?>">


   
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>"  style="display: none;"> <?php echo $sc_seq_vert; ?> </TD>
   
   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\""; if (in_array($sc_seq_vert, $sc_check_excl)) { echo " checked";} ?> onclick="if (this.checked) {sc_quant_excl++; } else {sc_quant_excl--; }" class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php }?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\"" ; if (in_array($sc_seq_vert, $sc_check_incl) || !empty($this->nm_todas_criticas)) { echo " checked ";} ?> class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php }?>
   <?php if ($this->Embutida_form) {?>
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_actions<?php echo $sc_seq_vert; ?>" NOWRAP> <?php if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['delete'] == "off") {
        $sDisplayDelete = 'display: none';
    }
    else {
        $sDisplayDelete = '';
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayDelete. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php
if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['update'] == "off") {
        $sDisplayUpdate = 'display: none';
    }
    else {
        $sDisplayUpdate = '';
    }
    if ($this->Embutida_ronly) {
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayUpdate. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
        $sButDisp = 'display: none';
    }
    else
    {
        $sButDisp = $sDisplayUpdate;
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "" . $sButDisp. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
}
?>

<?php if ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_opcao == "novo") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_incluir", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "sc_ins_line_" . $sc_seq_vert . "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php if ($this->nmgp_botoes['delete'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($Line_Add && $this->Embutida_ronly) {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($this->nmgp_botoes['update'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php }?>
<?php if ($this->nmgp_botoes['insert'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_prod_presupuesto_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_prod_presupuesto_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_prod_presupuesto_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_prod_presupuesto_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_prod_presupuesto_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_prod_presupuesto_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['id_']) && $this->nmgp_cmp_hidden['id_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($id_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOddMult css_id__line" id="hidden_field_data_id_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_id_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_id__line" style="vertical-align: top;padding: 0px"><span id="id_read_on_id_<?php echo $sc_seq_vert ?>" class="css_id__line" style="<?php echo $sStyleReadLab_id_; ?>"><?php echo $this->form_format_readonly("id_", $this->form_encode_input($this->id_)); ?></span><span id="id_read_off_id_<?php echo $sc_seq_vert ?>" class="css_read_off_id_" style="<?php echo $sStyleReadInp_id_; ?>"><input type="hidden" id="id_sc_field_id_<?php echo $sc_seq_vert ?>" name="id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($id_) . "\">"?>
<span id="id_ajax_label_id_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($id_); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['id_proyecto_']) && $this->nmgp_cmp_hidden['id_proyecto_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_proyecto_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->id_proyecto_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_id_proyecto__line" id="hidden_field_data_id_proyecto_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_id_proyecto_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_id_proyecto__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_id_proyecto_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["id_proyecto_"]) &&  $this->nmgp_cmp_readonly["id_proyecto_"] == "on")) { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_proyecto_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_proyecto_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_proyecto_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_proyecto_'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_proyecto_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_proyecto_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_proyecto_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_proyecto_'] = array(); 
    }

   $old_value_id_ = $this->id_;
   $old_value_orden_ = $this->orden_;
   $old_value_fecha_ = $this->fecha_;
   $old_value_unidades_ = $this->unidades_;
   $old_value_valor_unitario_ = $this->valor_unitario_;
   $old_value_monto_uf_ = $this->monto_uf_;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_ = $this->id_;
   $unformatted_value_orden_ = $this->orden_;
   $unformatted_value_fecha_ = $this->fecha_;
   $unformatted_value_unidades_ = $this->unidades_;
   $unformatted_value_valor_unitario_ = $this->valor_unitario_;
   $unformatted_value_monto_uf_ = $this->monto_uf_;

   $nm_comando = "SELECT id, codigo FROM proyectos where id =" . $_SESSION['id_proyecto'] . " ORDER BY nombre_proyecto";

   $this->id_ = $old_value_id_;
   $this->orden_ = $old_value_orden_;
   $this->fecha_ = $old_value_fecha_;
   $this->unidades_ = $old_value_unidades_;
   $this->valor_unitario_ = $old_value_valor_unitario_;
   $this->monto_uf_ = $old_value_monto_uf_;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_proyecto_'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $id_proyecto__look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_proyecto__1))
          {
              foreach ($this->id_proyecto__1 as $tmp_id_proyecto_)
              {
                  if (trim($tmp_id_proyecto_) === trim($cadaselect[1])) { $id_proyecto__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_proyecto_) === trim($cadaselect[1])) { $id_proyecto__look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_proyecto_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($id_proyecto_) . "\"><span id=\"id_ajax_label_id_proyecto_" . $sc_seq_vert . "\">" . $id_proyecto__look . "</span>"; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_proyecto_();
   $x = 0 ; 
   $id_proyecto__look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_proyecto__1))
          {
              foreach ($this->id_proyecto__1 as $tmp_id_proyecto_)
              {
                  if (trim($tmp_id_proyecto_) === trim($cadaselect[1])) { $id_proyecto__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_proyecto_) === trim($cadaselect[1])) { $id_proyecto__look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_proyecto__look))
          {
              $id_proyecto__look = $this->id_proyecto_;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_proyecto_" . $sc_seq_vert . "\" class=\"css_id_proyecto__line\" style=\"" .  $sStyleReadLab_id_proyecto_ . "\">" . $this->form_format_readonly("id_proyecto_", $this->form_encode_input($id_proyecto__look)) . "</span><span id=\"id_read_off_id_proyecto_" . $sc_seq_vert . "\" class=\"css_read_off_id_proyecto_" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_proyecto_ . "\">";
   echo " <span id=\"idAjaxSelect_id_proyecto_" .  $sc_seq_vert . "\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOddMult css_id_proyecto__obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_proyecto_" . $sc_seq_vert . "\" name=\"id_proyecto_" . $sc_seq_vert . "\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_proyecto_) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_proyecto_)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_proyecto_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_proyecto_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['id_item_']) && $this->nmgp_cmp_hidden['id_item_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_item_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->id_item_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_id_item__line" id="hidden_field_data_id_item_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_id_item_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_id_item__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_id_item_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_item_"]) &&  $this->nmgp_cmp_readonly["id_item_"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_'] = array(); 
    }

   $old_value_id_ = $this->id_;
   $old_value_orden_ = $this->orden_;
   $old_value_fecha_ = $this->fecha_;
   $old_value_unidades_ = $this->unidades_;
   $old_value_valor_unitario_ = $this->valor_unitario_;
   $old_value_monto_uf_ = $this->monto_uf_;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_ = $this->id_;
   $unformatted_value_orden_ = $this->orden_;
   $unformatted_value_fecha_ = $this->fecha_;
   $unformatted_value_unidades_ = $this->unidades_;
   $unformatted_value_valor_unitario_ = $this->valor_unitario_;
   $unformatted_value_monto_uf_ = $this->monto_uf_;

   $nm_comando = "SELECT distinct    prod_items_base.id_item,   concat( upper(prod_agrupa_items.nombre_agrupador), ' - ', prod_items_base.item) AS FIELD_1 FROM   prod_presupuesto   INNER JOIN proyectos ON (prod_presupuesto.id_proyecto = proyectos.id)   INNER JOIN prod_items_proyecto ON (proyectos.id = prod_items_proyecto.id_proyecto)   AND (prod_items_proyecto.id_proyecto = prod_presupuesto.id_proyecto)   AND (prod_items_proyecto.id_item = prod_presupuesto.id_item)   INNER JOIN prod_items_base ON (prod_items_base.id_item = prod_items_proyecto.id_item)   INNER JOIN prod_agrupa_items ON (prod_items_base.agrupador1 = prod_agrupa_items.id) WHERE   prod_presupuesto.id_proyecto =  " . $_SESSION['id_proyecto'] . "  ORDER BY   prod_items_base.agrupador1,   prod_items_base.item";

   $this->id_ = $old_value_id_;
   $this->orden_ = $old_value_orden_;
   $this->fecha_ = $old_value_fecha_;
   $this->unidades_ = $old_value_unidades_;
   $this->valor_unitario_ = $old_value_valor_unitario_;
   $this->monto_uf_ = $old_value_monto_uf_;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $id_item__look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_item__1))
          {
              foreach ($this->id_item__1 as $tmp_id_item_)
              {
                  if (trim($tmp_id_item_) === trim($cadaselect[1])) { $id_item__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_item_) === trim($cadaselect[1])) { $id_item__look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_item_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($id_item_) . "\">" . $id_item__look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_item_();
   $x = 0 ; 
   $id_item__look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_item__1))
          {
              foreach ($this->id_item__1 as $tmp_id_item_)
              {
                  if (trim($tmp_id_item_) === trim($cadaselect[1])) { $id_item__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_item_) === trim($cadaselect[1])) { $id_item__look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_item__look))
          {
              $id_item__look = $this->id_item_;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_item_" . $sc_seq_vert . "\" class=\"css_id_item__line\" style=\"" .  $sStyleReadLab_id_item_ . "\">" . $this->form_format_readonly("id_item_", $this->form_encode_input($id_item__look)) . "</span><span id=\"id_read_off_id_item_" . $sc_seq_vert . "\" class=\"css_read_off_id_item_" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_item_ . "\">";
   echo " <span id=\"idAjaxSelect_id_item_" .  $sc_seq_vert . "\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOddMult css_id_item__obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_item_" . $sc_seq_vert . "\" name=\"id_item_" . $sc_seq_vert . "\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_item_'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_item_) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_item_)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_item_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_item_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['orden_']) && $this->nmgp_cmp_hidden['orden_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="orden_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($orden_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_orden__line" id="hidden_field_data_orden_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_orden_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_orden__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_orden_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["orden_"]) &&  $this->nmgp_cmp_readonly["orden_"] == "on") { 

 ?>
<input type="hidden" name="orden_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($orden_) . "\">" . $orden_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_orden_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-orden_<?php echo $sc_seq_vert ?> css_orden__line" style="<?php echo $sStyleReadLab_orden_; ?>"><?php echo $this->form_format_readonly("orden_", $this->form_encode_input($this->orden_)); ?></span><span id="id_read_off_orden_<?php echo $sc_seq_vert ?>" class="css_read_off_orden_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_orden_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_orden__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_orden_<?php echo $sc_seq_vert ?>" type=text name="orden_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($orden_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['orden_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['orden_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['orden_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_orden_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_orden_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['vigente_']) && $this->nmgp_cmp_hidden['vigente_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="vigente_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->vigente_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_vigente__line" id="hidden_field_data_vigente_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_vigente_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_vigente__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_vigente_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vigente_"]) &&  $this->nmgp_cmp_readonly["vigente_"] == "on") { 

$vigente__look = "";
 if ($this->vigente_ == "0") { $vigente__look .= "NO" ;} 
 if ($this->vigente_ == "1") { $vigente__look .= "SI" ;} 
 if (empty($vigente__look)) { $vigente__look = $this->vigente_; }
?>
<input type="hidden" name="vigente_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($vigente_) . "\">" . $vigente__look . ""; ?>
<?php } else { ?>
<?php

$vigente__look = "";
 if ($this->vigente_ == "0") { $vigente__look .= "NO" ;} 
 if ($this->vigente_ == "1") { $vigente__look .= "SI" ;} 
 if (empty($vigente__look)) { $vigente__look = $this->vigente_; }
?>
<span id="id_read_on_vigente_<?php echo $sc_seq_vert ; ?>" class="css_vigente__line"  style="<?php echo $sStyleReadLab_vigente_; ?>"><?php echo $this->form_format_readonly("vigente_", $this->form_encode_input($vigente__look)); ?></span><span id="id_read_off_vigente_<?php echo $sc_seq_vert ; ?>" class="css_read_off_vigente_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_vigente_; ?>">
 <span id="idAjaxSelect_vigente_<?php echo $sc_seq_vert ?>" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOddMult css_vigente__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vigente_<?php echo $sc_seq_vert ?>" name="vigente_<?php echo $sc_seq_vert ?>" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->vigente_ == "0") { echo " selected" ;} ?>>NO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_vigente_'][] = '0'; ?>
 <option  value="1" <?php  if ($this->vigente_ == "1") { echo " selected" ;} ?><?php  if (empty($this->vigente_)) { echo " selected" ;} ?>>SI</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_vigente_'][] = '1'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vigente_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vigente_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['id_partida_periodo_']) && $this->nmgp_cmp_hidden['id_partida_periodo_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_partida_periodo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->id_partida_periodo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_id_partida_periodo__line" id="hidden_field_data_id_partida_periodo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_id_partida_periodo_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_id_partida_periodo__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_id_partida_periodo_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_partida_periodo_"]) &&  $this->nmgp_cmp_readonly["id_partida_periodo_"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_'] = array(); 
    }

   $old_value_id_ = $this->id_;
   $old_value_orden_ = $this->orden_;
   $old_value_fecha_ = $this->fecha_;
   $old_value_unidades_ = $this->unidades_;
   $old_value_valor_unitario_ = $this->valor_unitario_;
   $old_value_monto_uf_ = $this->monto_uf_;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_ = $this->id_;
   $unformatted_value_orden_ = $this->orden_;
   $unformatted_value_fecha_ = $this->fecha_;
   $unformatted_value_unidades_ = $this->unidades_;
   $unformatted_value_valor_unitario_ = $this->valor_unitario_;
   $unformatted_value_monto_uf_ = $this->monto_uf_;

   $nm_comando = "SELECT id, concat(month(fecha) ,'-',year(fecha))  FROM prod_produccion_proyecto where id_proyecto=" . $_SESSION['id_proyecto'] . "";

   $this->id_ = $old_value_id_;
   $this->orden_ = $old_value_orden_;
   $this->fecha_ = $old_value_fecha_;
   $this->unidades_ = $old_value_unidades_;
   $this->valor_unitario_ = $old_value_valor_unitario_;
   $this->monto_uf_ = $old_value_monto_uf_;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $id_partida_periodo__look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_partida_periodo__1))
          {
              foreach ($this->id_partida_periodo__1 as $tmp_id_partida_periodo_)
              {
                  if (trim($tmp_id_partida_periodo_) === trim($cadaselect[1])) { $id_partida_periodo__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_partida_periodo_) === trim($cadaselect[1])) { $id_partida_periodo__look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_partida_periodo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($id_partida_periodo_) . "\">" . $id_partida_periodo__look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_partida_periodo_();
   $x = 0 ; 
   $id_partida_periodo__look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_partida_periodo__1))
          {
              foreach ($this->id_partida_periodo__1 as $tmp_id_partida_periodo_)
              {
                  if (trim($tmp_id_partida_periodo_) === trim($cadaselect[1])) { $id_partida_periodo__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_partida_periodo_) === trim($cadaselect[1])) { $id_partida_periodo__look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_partida_periodo__look))
          {
              $id_partida_periodo__look = $this->id_partida_periodo_;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_partida_periodo_" . $sc_seq_vert . "\" class=\"css_id_partida_periodo__line\" style=\"" .  $sStyleReadLab_id_partida_periodo_ . "\">" . $this->form_format_readonly("id_partida_periodo_", $this->form_encode_input($id_partida_periodo__look)) . "</span><span id=\"id_read_off_id_partida_periodo_" . $sc_seq_vert . "\" class=\"css_read_off_id_partida_periodo_" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_partida_periodo_ . "\">";
   echo " <span id=\"idAjaxSelect_id_partida_periodo_" .  $sc_seq_vert . "\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOddMult css_id_partida_periodo__obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_partida_periodo_" . $sc_seq_vert . "\" name=\"id_partida_periodo_" . $sc_seq_vert . "\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_id_partida_periodo_'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_partida_periodo_) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_partida_periodo_)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_partida_periodo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_partida_periodo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['fecha_']) && $this->nmgp_cmp_hidden['fecha_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fecha_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($fecha_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_fecha__line" id="hidden_field_data_fecha_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_fecha_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_fecha__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_fecha_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fecha_"]) &&  $this->nmgp_cmp_readonly["fecha_"] == "on") { 

 ?>
<input type="hidden" name="fecha_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($fecha_) . "\">" . $fecha_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_fecha_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-fecha_<?php echo $sc_seq_vert ?> css_fecha__line" style="<?php echo $sStyleReadLab_fecha_; ?>"><?php echo $this->form_format_readonly("fecha_", $this->form_encode_input($fecha_)); ?></span><span id="id_read_off_fecha_<?php echo $sc_seq_vert ?>" class="css_read_off_fecha_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fecha_; ?>"><?php
$tmp_form_data = $this->field_config['fecha_']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOddMult css_fecha__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fecha_<?php echo $sc_seq_vert ?>" type=text name="fecha_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($fecha_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['fecha_']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['fecha_']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fecha_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fecha_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['unidades_']) && $this->nmgp_cmp_hidden['unidades_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="unidades_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($unidades_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_unidades__line" id="hidden_field_data_unidades_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_unidades_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_unidades__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_unidades_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["unidades_"]) &&  $this->nmgp_cmp_readonly["unidades_"] == "on") { 

 ?>
<input type="hidden" name="unidades_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($unidades_) . "\">" . $unidades_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_unidades_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-unidades_<?php echo $sc_seq_vert ?> css_unidades__line" style="<?php echo $sStyleReadLab_unidades_; ?>"><?php echo $this->form_format_readonly("unidades_", $this->form_encode_input($this->unidades_)); ?></span><span id="id_read_off_unidades_<?php echo $sc_seq_vert ?>" class="css_read_off_unidades_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_unidades_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_unidades__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_unidades_<?php echo $sc_seq_vert ?>" type=text name="unidades_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($unidades_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['unidades_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['unidades_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['unidades_']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['unidades_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_unidades_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_unidades_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['valor_unitario_']) && $this->nmgp_cmp_hidden['valor_unitario_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="valor_unitario_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($valor_unitario_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_valor_unitario__line" id="hidden_field_data_valor_unitario_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_valor_unitario_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_valor_unitario__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_valor_unitario_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["valor_unitario_"]) &&  $this->nmgp_cmp_readonly["valor_unitario_"] == "on") { 

 ?>
<input type="hidden" name="valor_unitario_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($valor_unitario_) . "\">" . $valor_unitario_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_valor_unitario_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-valor_unitario_<?php echo $sc_seq_vert ?> css_valor_unitario__line" style="<?php echo $sStyleReadLab_valor_unitario_; ?>"><?php echo $this->form_format_readonly("valor_unitario_", $this->form_encode_input($this->valor_unitario_)); ?></span><span id="id_read_off_valor_unitario_<?php echo $sc_seq_vert ?>" class="css_read_off_valor_unitario_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_valor_unitario_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_valor_unitario__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_valor_unitario_<?php echo $sc_seq_vert ?>" type=text name="valor_unitario_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($valor_unitario_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['valor_unitario_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['valor_unitario_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['valor_unitario_']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['valor_unitario_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_valor_unitario_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_valor_unitario_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['monto_uf_']) && $this->nmgp_cmp_hidden['monto_uf_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="monto_uf_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($monto_uf_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_monto_uf__line" id="hidden_field_data_monto_uf_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_monto_uf_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_monto_uf__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_monto_uf_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["monto_uf_"]) &&  $this->nmgp_cmp_readonly["monto_uf_"] == "on")) { 

 ?>
<input type="hidden" name="monto_uf_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($monto_uf_) . "\"><span id=\"id_ajax_label_monto_uf_" . $sc_seq_vert . "\">" . $monto_uf_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_monto_uf_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-monto_uf_<?php echo $sc_seq_vert ?> css_monto_uf__line" style="<?php echo $sStyleReadLab_monto_uf_; ?>"><?php echo $this->form_format_readonly("monto_uf_", $this->form_encode_input($this->monto_uf_)); ?></span><span id="id_read_off_monto_uf_<?php echo $sc_seq_vert ?>" class="css_read_off_monto_uf_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_monto_uf_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_monto_uf__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_monto_uf_<?php echo $sc_seq_vert ?>" type=text name="monto_uf_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($monto_uf_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['monto_uf_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['monto_uf_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['monto_uf_']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['monto_uf_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_monto_uf_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_monto_uf_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tipo_moneda_']) && $this->nmgp_cmp_hidden['tipo_moneda_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tipo_moneda_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->tipo_moneda_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tipo_moneda__line" id="hidden_field_data_tipo_moneda_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tipo_moneda_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tipo_moneda__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tipo_moneda_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tipo_moneda_"]) &&  $this->nmgp_cmp_readonly["tipo_moneda_"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_tipo_moneda_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_tipo_moneda_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_tipo_moneda_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_tipo_moneda_'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_tipo_moneda_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_tipo_moneda_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_tipo_moneda_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_tipo_moneda_'] = array(); 
    }

   $old_value_id_ = $this->id_;
   $old_value_orden_ = $this->orden_;
   $old_value_fecha_ = $this->fecha_;
   $old_value_unidades_ = $this->unidades_;
   $old_value_valor_unitario_ = $this->valor_unitario_;
   $old_value_monto_uf_ = $this->monto_uf_;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_ = $this->id_;
   $unformatted_value_orden_ = $this->orden_;
   $unformatted_value_fecha_ = $this->fecha_;
   $unformatted_value_unidades_ = $this->unidades_;
   $unformatted_value_valor_unitario_ = $this->valor_unitario_;
   $unformatted_value_monto_uf_ = $this->monto_uf_;

   $nm_comando = "SELECT    proyectos.tipo_moneda,   prod_monedas.tipo_moneda FROM   proyectos   INNER JOIN prod_monedas ON (proyectos.tipo_moneda = prod_monedas.id) WHERE   proyectos.id =" . $_SESSION['id_proyecto'] . "";

   $this->id_ = $old_value_id_;
   $this->orden_ = $old_value_orden_;
   $this->fecha_ = $old_value_fecha_;
   $this->unidades_ = $old_value_unidades_;
   $this->valor_unitario_ = $old_value_valor_unitario_;
   $this->monto_uf_ = $old_value_monto_uf_;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['Lookup_tipo_moneda_'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $tipo_moneda__look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tipo_moneda__1))
          {
              foreach ($this->tipo_moneda__1 as $tmp_tipo_moneda_)
              {
                  if (trim($tmp_tipo_moneda_) === trim($cadaselect[1])) { $tipo_moneda__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tipo_moneda_) === trim($cadaselect[1])) { $tipo_moneda__look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tipo_moneda_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tipo_moneda_) . "\">" . $tipo_moneda__look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tipo_moneda_();
   $x = 0 ; 
   $tipo_moneda__look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tipo_moneda__1))
          {
              foreach ($this->tipo_moneda__1 as $tmp_tipo_moneda_)
              {
                  if (trim($tmp_tipo_moneda_) === trim($cadaselect[1])) { $tipo_moneda__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tipo_moneda_) === trim($cadaselect[1])) { $tipo_moneda__look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tipo_moneda__look))
          {
              $tipo_moneda__look = $this->tipo_moneda_;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tipo_moneda_" . $sc_seq_vert . "\" class=\"css_tipo_moneda__line\" style=\"" .  $sStyleReadLab_tipo_moneda_ . "\">" . $this->form_format_readonly("tipo_moneda_", $this->form_encode_input($tipo_moneda__look)) . "</span><span id=\"id_read_off_tipo_moneda_" . $sc_seq_vert . "\" class=\"css_read_off_tipo_moneda_" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_tipo_moneda_ . "\">";
   echo " <span id=\"idAjaxSelect_tipo_moneda_" .  $sc_seq_vert . "\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOddMult css_tipo_moneda__obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_tipo_moneda_" . $sc_seq_vert . "\" name=\"tipo_moneda_" . $sc_seq_vert . "\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tipo_moneda_) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tipo_moneda_)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_moneda_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_moneda_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['observaciones_']) && $this->nmgp_cmp_hidden['observaciones_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="observaciones_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($observaciones_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_observaciones__line" id="hidden_field_data_observaciones_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_observaciones_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_observaciones__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_observaciones_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["observaciones_"]) &&  $this->nmgp_cmp_readonly["observaciones_"] == "on") { 

 ?>
<input type="hidden" name="observaciones_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($observaciones_) . "\">" . $observaciones_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_observaciones_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-observaciones_<?php echo $sc_seq_vert ?> css_observaciones__line" style="<?php echo $sStyleReadLab_observaciones_; ?>"><?php echo $this->form_format_readonly("observaciones_", $this->form_encode_input($this->observaciones_)); ?></span><span id="id_read_off_observaciones_<?php echo $sc_seq_vert ?>" class="css_read_off_observaciones_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observaciones_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_observaciones__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_observaciones_<?php echo $sc_seq_vert ?>" type=text name="observaciones_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($observaciones_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_observaciones_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_observaciones_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_id_))
       {
           $this->nmgp_cmp_readonly['id_'] = $sCheckRead_id_;
       }
       if ('display: none;' == $sStyleHidden_id_)
       {
           $this->nmgp_cmp_hidden['id_'] = 'off';
       }
       if (isset($sCheckRead_id_proyecto_))
       {
           $this->nmgp_cmp_readonly['id_proyecto_'] = $sCheckRead_id_proyecto_;
       }
       if ('display: none;' == $sStyleHidden_id_proyecto_)
       {
           $this->nmgp_cmp_hidden['id_proyecto_'] = 'off';
       }
       if (isset($sCheckRead_id_item_))
       {
           $this->nmgp_cmp_readonly['id_item_'] = $sCheckRead_id_item_;
       }
       if ('display: none;' == $sStyleHidden_id_item_)
       {
           $this->nmgp_cmp_hidden['id_item_'] = 'off';
       }
       if (isset($sCheckRead_orden_))
       {
           $this->nmgp_cmp_readonly['orden_'] = $sCheckRead_orden_;
       }
       if ('display: none;' == $sStyleHidden_orden_)
       {
           $this->nmgp_cmp_hidden['orden_'] = 'off';
       }
       if (isset($sCheckRead_vigente_))
       {
           $this->nmgp_cmp_readonly['vigente_'] = $sCheckRead_vigente_;
       }
       if ('display: none;' == $sStyleHidden_vigente_)
       {
           $this->nmgp_cmp_hidden['vigente_'] = 'off';
       }
       if (isset($sCheckRead_id_partida_periodo_))
       {
           $this->nmgp_cmp_readonly['id_partida_periodo_'] = $sCheckRead_id_partida_periodo_;
       }
       if ('display: none;' == $sStyleHidden_id_partida_periodo_)
       {
           $this->nmgp_cmp_hidden['id_partida_periodo_'] = 'off';
       }
       if (isset($sCheckRead_fecha_))
       {
           $this->nmgp_cmp_readonly['fecha_'] = $sCheckRead_fecha_;
       }
       if ('display: none;' == $sStyleHidden_fecha_)
       {
           $this->nmgp_cmp_hidden['fecha_'] = 'off';
       }
       if (isset($sCheckRead_unidades_))
       {
           $this->nmgp_cmp_readonly['unidades_'] = $sCheckRead_unidades_;
       }
       if ('display: none;' == $sStyleHidden_unidades_)
       {
           $this->nmgp_cmp_hidden['unidades_'] = 'off';
       }
       if (isset($sCheckRead_valor_unitario_))
       {
           $this->nmgp_cmp_readonly['valor_unitario_'] = $sCheckRead_valor_unitario_;
       }
       if ('display: none;' == $sStyleHidden_valor_unitario_)
       {
           $this->nmgp_cmp_hidden['valor_unitario_'] = 'off';
       }
       if (isset($sCheckRead_monto_uf_))
       {
           $this->nmgp_cmp_readonly['monto_uf_'] = $sCheckRead_monto_uf_;
       }
       if ('display: none;' == $sStyleHidden_monto_uf_)
       {
           $this->nmgp_cmp_hidden['monto_uf_'] = 'off';
       }
       if (isset($sCheckRead_tipo_moneda_))
       {
           $this->nmgp_cmp_readonly['tipo_moneda_'] = $sCheckRead_tipo_moneda_;
       }
       if ('display: none;' == $sStyleHidden_tipo_moneda_)
       {
           $this->nmgp_cmp_hidden['tipo_moneda_'] = 'off';
       }
       if (isset($sCheckRead_observaciones_))
       {
           $this->nmgp_cmp_readonly['observaciones_'] = $sCheckRead_observaciones_;
       }
       if ('display: none;' == $sStyleHidden_observaciones_)
       {
           $this->nmgp_cmp_hidden['observaciones_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_prod_presupuesto = $guarda_form_vert_form_prod_presupuesto;
   } 
   if ($Table_refresh) 
   { 
       $this->Table_refresh = ob_get_contents();
       ob_end_clean();
   } 
}

function Form_Fim() 
{
   global $sc_seq_vert, $opcao_botoes, $nm_url_saida; 
?>   
</TABLE></div><!-- bloco_f -->
 </div>
<?php
$iContrVert = $this->Embutida_form ? $sc_seq_vert + 1 : $sc_seq_vert + 1;
if ($sc_seq_vert < $this->sc_max_reg)
{
    echo " <script type=\"text/javascript\">";
    echo "    bRefreshTable = true;";
    echo "</script>";
}
?>
<input type="hidden" name="sc_contr_vert" value="<?php echo $this->form_encode_input($iContrVert); ?>">
<?php
    $sEmptyStyle = 0 == $sc_seq_vert ? '' : 'display: none;';
?>
</td></tr>
<tr id="sc-ui-empty-form" style="<?php echo $sEmptyStyle; ?>"><td class="scFormPageText" style="padding: 10px; font-weight: bold">
<?php echo $this->Ini->Nm_lang['lang_errm_empt'];
?>
</td></tr>
<tr id="sc-id-required-row"><td class="scFormPageText">
<span class="scFormRequiredOddColorMult">* <?php echo $this->Ini->Nm_lang['lang_othr_reqr']; ?></span>
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", " nm_navpage(document.F1.nmgp_rec_b.value, 'P');document.F1.nmgp_rec_b.value = ''", " nm_navpage(document.F1.nmgp_rec_b.value, 'P');document.F1.nmgp_rec_b.value = ''", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "nm_move ('inicio');", "nm_move ('inicio');", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['back'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bretorna", "nm_move ('retorna');", "nm_move ('retorna');", "sc_b_ret_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_b" class="scFormToolbarPadding"></span> 
<?php 
}
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "nm_move ('avanca');", "nm_move ('avanca');", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-15';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['btn_label']['last'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bfinal", "nm_move ('final');", "nm_move ('final');", "sc_b_fim_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b" class="scFormToolbarPadding"></span> 
<?php 
}
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
<script>
 var iAjaxNewLine = <?php echo $sc_seq_vert; ?>;
<?php
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['run_modal'])
{
?>
 for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) {
  scJQElementsAdd(iLine);
 }
<?php
}
else
{
?>
 $(function() {
  setTimeout(function() { for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) { scJQElementsAdd(iLine); } }, 250);
 });
<?php
}
?>
</script>
<div id="new_line_dummy" style="display: none">
</div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
   </td></tr></table>
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['masterValue']);
?>
}
<?php
    }
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_prod_presupuesto");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_prod_presupuesto");
 parent.scAjaxDetailHeight("form_prod_presupuesto", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_prod_presupuesto", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_prod_presupuesto", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
    }
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
    $isToast   = isset($this->NM_ajax_info['displayMsgToast']) && $this->NM_ajax_info['displayMsgToast'] ? 'true' : 'false';
    $toastType = $isToast && isset($this->NM_ajax_info['displayMsgToastType']) ? $this->NM_ajax_info['displayMsgToastType'] : '';
?>
<script type="text/javascript">
_scAjaxShowMessage({title: scMsgDefTitle, message: "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: <?php echo $isToast ?>, toastPos: "", type: "<?php echo $toastType ?>"});
</script>
<?php
}
?>
<?php
if (isset($this->scFormFocusErrorName) && '' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<?php
if ($this->nmgp_form_empty) {
?>
<script type="text/javascript">
scAjax_displayEmptyForm();
</script>
<?php
}
?>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto']['buttonStatus'] = $this->nmgp_botoes;
?>
<script type="text/javascript">
   function sc_session_redir(url_redir)
   {
       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
       {
           window.parent.sc_session_redir(url_redir);
       }
       else
       {
           if (window.opener && typeof window.opener.sc_session_redir === 'function')
           {
               window.close();
               window.opener.sc_session_redir(url_redir);
           }
           else
           {
               window.location = url_redir;
           }
       }
   }
</script>
</body> 
</html> 
<?php 
 } 
} 
?> 
