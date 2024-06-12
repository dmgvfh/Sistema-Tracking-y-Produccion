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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " prod_presupuesto_periodo_hitos"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " prod_presupuesto_periodo_hitos"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
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
 </SCRIPT>
        <SCRIPT type="text/javascript" src="../_lib/lib/js/jquery-3.6.0.min.js"></SCRIPT>
<input type="hidden" id="sc-mobile-lock" value='true' />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
<style type="text/css">
.ui-datepicker { z-index: 6 !important }
</style>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
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
.css_read_off_fecha_hito button {
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_prod_presupuesto_periodo_hitos/form_prod_presupuesto_periodo_hitos_mob_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_prod_presupuesto_periodo_hitos_mob_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['last'] : 'off'); ?>";
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
    nm_sumario = "[<?php echo substr($this->Ini->Nm_lang['lang_othr_smry_info'], strpos($this->Ini->Nm_lang['lang_othr_smry_info'], "?final?")) ?>]";
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
<?php

include_once('form_prod_presupuesto_periodo_hitos_mob_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['recarga'];
}
    $remove_margin = '';
    $remove_border = '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['link_info']['remove_border']) {
        $remove_border = 'border-width: 0; ';
    }
    $vertical_center = '';
?>
<body class="scFormPage sc-app-form" style="<?php echo $remove_margin . $str_iframe_body . $vertical_center; ?>">
<?php

if (isset($_SESSION['scriptcase']['form_prod_presupuesto_periodo_hitos']['error_buffer']) && '' != $_SESSION['scriptcase']['form_prod_presupuesto_periodo_hitos']['error_buffer'])
{
    echo $_SESSION['scriptcase']['form_prod_presupuesto_periodo_hitos']['error_buffer'];
}
elseif (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
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
 include_once("form_prod_presupuesto_periodo_hitos_mob_js0.php");
?>
<script type="text/javascript"> 
 // Adiciona um elemento
 //----------------------
 function nm_add_sel(sOrig, sDest, fCBack, sRow)
 {
  scMarkFormAsChanged();
  // Recupera objetos
  oOrig = document.F1.elements[sOrig];
  oDest = document.F1.elements[sDest];
  // Varre itens da origem
  for (i = 0; i < oOrig.length; i++)
  {
   // Item na origem selecionado e valido
   if (oOrig.options[i].selected && !oOrig.options[i].disabled)
   {
    // Recupera valores da origem
    sText  = oOrig.options[i].text;
    sValue = oOrig.options[i].value;
    // Cria item no destino
    oDest.options[oDest.length] = new Option(sText, sValue);
    // Desabilita item na origem
    oOrig.options[i].style.color = "#A0A0A0";
    oOrig.options[i].disabled    = true;
    oOrig.options[i].selected    = false;
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (fCBack)
  {
   fCBack(sRow);
  }
 }
 // Adiciona todos os elementos
 //-----------------------------
 function nm_add_all(sOrig, sDest, fCBack, sRow)
 {
  scMarkFormAsChanged();
  // Recupera objetos
  oOrig = document.F1.elements[sOrig];
  oDest = document.F1.elements[sDest];
  // Varre itens da origem
  for (i = 0; i < oOrig.length; i++)
  {
   // Item na origem valido
   if (!oOrig.options[i].disabled)
   {
    // Recupera valores da origem
    sText  = oOrig.options[i].text;
    sValue = oOrig.options[i].value;
    // Cria item no destino
    oDest.options[oDest.length] = new Option(sText, sValue);
    // Desabilita item na origem
    oOrig.options[i].style.color = "#A0A0A0";
    oOrig.options[i].disabled    = true;
    oOrig.options[i].selected    = false;
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (fCBack)
  {
   fCBack(sRow);
  }
 }
 // Remove um elemento
 //--------------------
 function nm_del_sel(sOrig, sDest, fCBack, sRow)
 {
  scMarkFormAsChanged();
  // Recupera objetos
  oOrig = document.F1.elements[sOrig];
  oDest = document.F1.elements[sDest];
  aSel  = new Array();
  atxt  = new Array();
  solt  = new Array();
  j     = 0;
  z     = 0;
  // Remove itens selecionados na origem
  for (i = oOrig.length - 1; i >= 0; i--)
  {
   // Item na origem selecionado
   if (oOrig.options[i].selected)
   {
    aSel[j] = oOrig.options[i].value;
    atxt[j] = oOrig.options[i].text;
    j++;
    oOrig.options[i] = null;
   }
  }
  // Habilita itens no destino
  for (i = 0; i < oDest.length; i++)
  {
   if (oDest.options[i].disabled && in_array(aSel, oDest.options[i].value))
   {
    oDest.options[i].disabled    = false;
    oDest.options[i].style.color = "";
    solt[z] = oDest.options[i].value;
    z++;
   }
  }
  for (i = 0; i < aSel.length; i++)
  {
   if (!in_array(solt, aSel[i]))
   {
    oDest.options[oDest.length] = new Option(atxt[i], aSel[i]);
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (fCBack)
  {
   fCBack(sRow);
  }
 }
 // Remove todos os elementos
 //---------------------------
 function nm_del_all(sOrig, sDest, fCBack, sRow)
 {
  scMarkFormAsChanged();
  // Recupera objetos
  oOrig = document.F1.elements[sOrig];
  oDest = document.F1.elements[sDest];
  aSel  = new Array();
  atxt  = new Array();
  solt  = new Array();
  j     = 0;
  z     = 0;
  // Remove todos os itens na origem
  while (0 < oOrig.length)
  {
   i       = oOrig.length - 1;
   aSel[j] = oOrig.options[i].value;
   atxt[j] = oOrig.options[i].text;
   j++;
   oOrig.options[i] = null;
  }
  // Habilita itens no destino
  for (i = 0; i < oDest.length; i++)
  {
   if (oDest.options[i].disabled && in_array(aSel, oDest.options[i].value))
   {
    oDest.options[i].disabled    = false;
    oDest.options[i].style.color = "";
    solt[z] = oDest.options[i].value;
    z++;
   }
  }
  for (i = 0; i < aSel.length; i++)
  {
   if (!in_array(solt, aSel[i]))
   {
    oDest.options[oDest.length] = new Option(atxt[i], aSel[i]);
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (fCBack)
  {
   fCBack(sRow);
  }
 }
 function nm_sincroniza(sOrig, sDest)
 {
  // Recupera objetos
  oOrig = document.F1.elements[sOrig];
  oDest = document.F1.elements[sDest];
  // Varre itens do destino
  for (i = 0; i < oDest.length; i++)
  {
     dValue = oDest.options[i].value;
     bFound = false;
     for (x = 0; x < oOrig.length && !bFound; x++)
     {
         oValue = oOrig.options[x].value;
         if (dValue == oValue)
         {
             // Desabilita item na origem
             oOrig.options[x].style.color = "#A0A0A0";
             oOrig.options[x].disabled    = true;
             oOrig.options[x].selected    = false;
             bFound = true;
         }
     }
  }
 }
 var nm_quant_pack;
 function nm_pack(sOrig, sDest)
 {
    if (!document.F1.elements[sOrig] || !document.F1.elements[sDest]) return;
    obj_sel = document.F1.elements[sOrig];
    str_val = "";
    nm_quant_pack = 0;
    for (i = 0; i < obj_sel.length; i++)
    {
         if ("" != str_val)
         {
             str_val += "@?@";
             nm_quant_pack++;
         }
         str_val += obj_sel.options[i].value;
    }
    document.F1.elements[sDest].value = str_val;
 }
 function nm_pack_sel(sOrig, sDest)
 {
    if (!document.F1.elements[sOrig] || !document.F1.elements[sDest]) return;
    obj_sel = document.F1.elements[sOrig];
    str_val = "";
    nm_quant_pack = 0;
    for (i = 0; i < obj_sel.length; i++)
    {
         if (obj_sel.options[i].selected)
         {
             if ("" != str_val)
             {
                 str_val += "@?@";
                 nm_quant_pack++;
             }
             str_val += obj_sel.options[i].value;
         }
    }
    document.F1.elements[sDest].value = str_val;
 }
 function nm_del_combo(sOcombo)
 {
  // Recupera objetos
  oOrig = document.F1.elements[sOcombo];
  aSel  = new Array();
  j     = 0;
  // Remove todos os itens na origem
  while (0 < oOrig.length)
  {
   i       = oOrig.length - 1;
   aSel[j] = oOrig.options[i].value;
   j++;
   oOrig.options[i] = null;
  }
 }
 function nm_add_item(sDest, sText, sValue, sSelected)
 {
  oDest = document.F1.elements[sDest];
  oDest.options[oDest.length] = new Option(sText, sValue);
  if (sSelected == 'selected')
  {
      oDest.options[oDest.length -1].selected = true;
  }
 }
 function in_array(aArray, sElem)
 {
  for (iCount = 0; iCount < aArray.length; iCount++)
  {
   if (sElem == aArray[iCount])
   {
    return true;
   }
  }
  return false;
 }
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
<form  name="F1" method="post" enctype="multipart/form-data" 
               action="form_prod_presupuesto_periodo_hitos_mob.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['insert_validation']; ?>">
<?php
}
?>
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
<input type="hidden" name="upload_file_flag" value="">
<input type="hidden" name="upload_file_check" value="">
<input type="hidden" name="upload_file_name" value="">
<input type="hidden" name="upload_file_temp" value="">
<input type="hidden" name="upload_file_libs" value="">
<input type="hidden" name="upload_file_height" value="">
<input type="hidden" name="upload_file_width" value="">
<input type="hidden" name="upload_file_aspect" value="">
<input type="hidden" name="upload_file_type" value="">
<input type="hidden" name="adjunto_salva" value="<?php  echo $this->form_encode_input($this->adjunto) ?>">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_prod_presupuesto_periodo_hitos_mob'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_prod_presupuesto_periodo_hitos_mob'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R")
{
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-15';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "nm_move ('novo');", "nm_move ('novo');", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-16';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['insert'];
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
        $buttonMacroDisabled = 'sc-unique-btn-17';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "" . $this->NM_cancel_insert_new . " document.F5.submit();", "" . $this->NM_cancel_insert_new . " document.F5.submit();", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-18';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-19';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "nm_atualiza ('excluir');", "nm_atualiza ('excluir');", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-20';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F5('" . $nm_url_saida. "');", "scFormClose_F5('" . $nm_url_saida. "');", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-21';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F5('" . $nm_url_saida. "');", "scFormClose_F5('" . $nm_url_saida. "');", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-22';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-23';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-24';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R")
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
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><input type="hidden" name="adjunto_ul_name" id="id_sc_field_adjunto_ul_name" value="<?php echo $this->form_encode_input($this->adjunto_ul_name);?>">
<input type="hidden" name="adjunto_ul_type" id="id_sc_field_adjunto_ul_type" value="<?php echo $this->form_encode_input($this->adjunto_ul_type);?>">
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id']))
           {
               $this->nmgp_cmp_readonly['id'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_presupuesto_periodo']))
           {
               $this->nmgp_cmp_readonly['id_presupuesto_periodo'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['id']))
    {
        $this->nm_new_label['id'] = "Id";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id = $this->id;
   $sStyleHidden_id = '';
   if (isset($this->nmgp_cmp_hidden['id']) && $this->nmgp_cmp_hidden['id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id']);
       $sStyleHidden_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id = 'display: none;';
   $sStyleReadInp_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id"]) &&  $this->nmgp_cmp_readonly["id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id']);
       $sStyleReadLab_id = '';
       $sStyleReadInp_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id']) && $this->nmgp_cmp_hidden['id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id" value="<?php echo $this->form_encode_input($id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOdd css_id_line" id="hidden_field_data_id" style="<?php echo $sStyleHidden_id; ?>"> <span class="scFormLabelOddFormat css_id_label" style=""><span id="id_label_id"><?php echo $this->nm_new_label['id']; ?></span></span><br><span id="id_read_on_id" class="css_id_line" style="<?php echo $sStyleReadLab_id; ?>"><?php echo $this->form_format_readonly("id", $this->form_encode_input($this->id)); ?></span><span id="id_read_off_id" class="css_read_off_id" style="<?php echo $sStyleReadInp_id; ?>"><input type="hidden" name="id" value="<?php echo $this->form_encode_input($id) . "\">"?><span id="id_ajax_label_id"><?php echo nl2br($id); ?></span>
</span></span> </TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_presupuesto_periodo']))
    {
        $this->nm_new_label['id_presupuesto_periodo'] = "Id Presupuesto Periodo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_presupuesto_periodo = $this->id_presupuesto_periodo;
   $sStyleHidden_id_presupuesto_periodo = '';
   if (isset($this->nmgp_cmp_hidden['id_presupuesto_periodo']) && $this->nmgp_cmp_hidden['id_presupuesto_periodo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_presupuesto_periodo']);
       $sStyleHidden_id_presupuesto_periodo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_presupuesto_periodo = 'display: none;';
   $sStyleReadInp_id_presupuesto_periodo = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_presupuesto_periodo"]) &&  $this->nmgp_cmp_readonly["id_presupuesto_periodo"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_presupuesto_periodo']);
       $sStyleReadLab_id_presupuesto_periodo = '';
       $sStyleReadInp_id_presupuesto_periodo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_presupuesto_periodo']) && $this->nmgp_cmp_hidden['id_presupuesto_periodo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_presupuesto_periodo" value="<?php echo $this->form_encode_input($id_presupuesto_periodo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_id_presupuesto_periodo_line" id="hidden_field_data_id_presupuesto_periodo" style="<?php echo $sStyleHidden_id_presupuesto_periodo; ?>"> <span class="scFormLabelOddFormat css_id_presupuesto_periodo_label" style=""><span id="id_label_id_presupuesto_periodo"><?php echo $this->nm_new_label['id_presupuesto_periodo']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['php_cmp_required']['id_presupuesto_periodo']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['php_cmp_required']['id_presupuesto_periodo'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["id_presupuesto_periodo"]) &&  $this->nmgp_cmp_readonly["id_presupuesto_periodo"] == "on")) { 

 ?>
<input type="hidden" name="id_presupuesto_periodo" value="<?php echo $this->form_encode_input($id_presupuesto_periodo) . "\"><span id=\"id_ajax_label_id_presupuesto_periodo\">" . $id_presupuesto_periodo . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_id_presupuesto_periodo" class="sc-ui-readonly-id_presupuesto_periodo css_id_presupuesto_periodo_line" style="<?php echo $sStyleReadLab_id_presupuesto_periodo; ?>"><?php echo $this->form_format_readonly("id_presupuesto_periodo", $this->form_encode_input($this->id_presupuesto_periodo)); ?></span><span id="id_read_off_id_presupuesto_periodo" class="css_read_off_id_presupuesto_periodo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_presupuesto_periodo; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_presupuesto_periodo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_presupuesto_periodo" type=text name="id_presupuesto_periodo" value="<?php echo $this->form_encode_input($id_presupuesto_periodo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['id_presupuesto_periodo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['id_presupuesto_periodo']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['id_presupuesto_periodo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_hito']))
    {
        $this->nm_new_label['id_hito'] = "Id Hito";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_hito = $this->id_hito;
   $sStyleHidden_id_hito = '';
   if (isset($this->nmgp_cmp_hidden['id_hito']) && $this->nmgp_cmp_hidden['id_hito'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_hito']);
       $sStyleHidden_id_hito = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_hito = 'display: none;';
   $sStyleReadInp_id_hito = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_hito']) && $this->nmgp_cmp_readonly['id_hito'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_hito']);
       $sStyleReadLab_id_hito = '';
       $sStyleReadInp_id_hito = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_hito']) && $this->nmgp_cmp_hidden['id_hito'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_hito" value="<?php echo $this->form_encode_input($id_hito) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_id_hito_line" id="hidden_field_data_id_hito" style="<?php echo $sStyleHidden_id_hito; ?>"> <span class="scFormLabelOddFormat css_id_hito_label" style=""><span id="id_label_id_hito"><?php echo $this->nm_new_label['id_hito']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_hito"]) &&  $this->nmgp_cmp_readonly["id_hito"] == "on") { 

 ?>
<input type="hidden" name="id_hito" value="<?php echo $this->form_encode_input($id_hito) . "\">" . $id_hito . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_hito" class="sc-ui-readonly-id_hito css_id_hito_line" style="<?php echo $sStyleReadLab_id_hito; ?>"><?php echo $this->form_format_readonly("id_hito", $this->form_encode_input($this->id_hito)); ?></span><span id="id_read_off_id_hito" class="css_read_off_id_hito<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_hito; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_hito_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_hito" type=text name="id_hito" value="<?php echo $this->form_encode_input($id_hito) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['id_hito']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['id_hito']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['id_hito']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['estado']))
    {
        $this->nm_new_label['estado'] = "Estado";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $estado = $this->estado;
   $sStyleHidden_estado = '';
   if (isset($this->nmgp_cmp_hidden['estado']) && $this->nmgp_cmp_hidden['estado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['estado']);
       $sStyleHidden_estado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_estado = 'display: none;';
   $sStyleReadInp_estado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['estado']) && $this->nmgp_cmp_readonly['estado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['estado']);
       $sStyleReadLab_estado = '';
       $sStyleReadInp_estado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['estado']) && $this->nmgp_cmp_hidden['estado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="estado" value="<?php echo $this->form_encode_input($estado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_estado_line" id="hidden_field_data_estado" style="<?php echo $sStyleHidden_estado; ?>"> <span class="scFormLabelOddFormat css_estado_label" style=""><span id="id_label_estado"><?php echo $this->nm_new_label['estado']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["estado"]) &&  $this->nmgp_cmp_readonly["estado"] == "on") { 

 ?>
<input type="hidden" name="estado" value="<?php echo $this->form_encode_input($estado) . "\">" . $estado . ""; ?>
<?php } else { ?>
<span id="id_read_on_estado" class="sc-ui-readonly-estado css_estado_line" style="<?php echo $sStyleReadLab_estado; ?>"><?php echo $this->form_format_readonly("estado", $this->form_encode_input($this->estado)); ?></span><span id="id_read_off_estado" class="css_read_off_estado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_estado; ?>">
 <input class="sc-js-input scFormObjectOdd css_estado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_estado" type=text name="estado" value="<?php echo $this->form_encode_input($estado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['estado']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['estado']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['estado']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fecha_hito']))
    {
        $this->nm_new_label['fecha_hito'] = "Fecha Hito";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fecha_hito = $this->fecha_hito;
   $sStyleHidden_fecha_hito = '';
   if (isset($this->nmgp_cmp_hidden['fecha_hito']) && $this->nmgp_cmp_hidden['fecha_hito'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fecha_hito']);
       $sStyleHidden_fecha_hito = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fecha_hito = 'display: none;';
   $sStyleReadInp_fecha_hito = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fecha_hito']) && $this->nmgp_cmp_readonly['fecha_hito'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fecha_hito']);
       $sStyleReadLab_fecha_hito = '';
       $sStyleReadInp_fecha_hito = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fecha_hito']) && $this->nmgp_cmp_hidden['fecha_hito'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fecha_hito" value="<?php echo $this->form_encode_input($fecha_hito) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_fecha_hito_line" id="hidden_field_data_fecha_hito" style="<?php echo $sStyleHidden_fecha_hito; ?>"> <span class="scFormLabelOddFormat css_fecha_hito_label" style=""><span id="id_label_fecha_hito"><?php echo $this->nm_new_label['fecha_hito']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fecha_hito"]) &&  $this->nmgp_cmp_readonly["fecha_hito"] == "on") { 

 ?>
<input type="hidden" name="fecha_hito" value="<?php echo $this->form_encode_input($fecha_hito) . "\">" . $fecha_hito . ""; ?>
<?php } else { ?>
<span id="id_read_on_fecha_hito" class="sc-ui-readonly-fecha_hito css_fecha_hito_line" style="<?php echo $sStyleReadLab_fecha_hito; ?>"><?php echo $this->form_format_readonly("fecha_hito", $this->form_encode_input($fecha_hito)); ?></span><span id="id_read_off_fecha_hito" class="css_read_off_fecha_hito<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fecha_hito; ?>"><?php
$tmp_form_data = $this->field_config['fecha_hito']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_fecha_hito_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fecha_hito" type=text name="fecha_hito" value="<?php echo $this->form_encode_input($fecha_hito) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['fecha_hito']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['fecha_hito']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['adjunto']))
    {
        $this->nm_new_label['adjunto'] = "Adjunto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $adjunto = $this->adjunto;
   $sStyleHidden_adjunto = '';
   if (isset($this->nmgp_cmp_hidden['adjunto']) && $this->nmgp_cmp_hidden['adjunto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['adjunto']);
       $sStyleHidden_adjunto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_adjunto = 'display: none;';
   $sStyleReadInp_adjunto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['adjunto']) && $this->nmgp_cmp_readonly['adjunto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['adjunto']);
       $sStyleReadLab_adjunto = '';
       $sStyleReadInp_adjunto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['adjunto']) && $this->nmgp_cmp_hidden['adjunto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="adjunto" value="<?php echo $this->form_encode_input($adjunto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_adjunto_line" id="hidden_field_data_adjunto" style="<?php echo $sStyleHidden_adjunto; ?>"> <span class="scFormLabelOddFormat css_adjunto_label" style=""><span id="id_label_adjunto"><?php echo $this->nm_new_label['adjunto']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["adjunto"]) &&  $this->nmgp_cmp_readonly["adjunto"] == "on") { 

 ?>
<input type="hidden" name="adjunto" value="<?php echo $this->form_encode_input($adjunto) . "\"><img id=\"adjunto_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><span id=\"id_ajax_doc_adjunto\"><a href=\"javascript:nm_mostra_doc('0', '" . str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_adjunto, 3)) . "', 'form_prod_presupuesto_periodo_hitos')\">" . $adjunto . "</a></span>"; ?>
<?php } else { ?>
<span id="id_read_on_adjunto" class="scFormLinkOdd sc-ui-readonly-adjunto css_adjunto_line" style="<?php echo $sStyleReadLab_adjunto; ?>"><?php echo $this->form_format_readonly("adjunto", $this->adjunto) ?></span><span id="id_read_off_adjunto" class="css_read_off_adjunto" style="white-space: nowrap;<?php echo $sStyleReadInp_adjunto; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-adjunto" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_adjunto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="adjunto[]" id="id_sc_field_adjunto" ></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_adjunto"<?php if ($this->nmgp_opcao == "novo" || empty($adjunto)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="adjunto_limpa" value="<?php echo $adjunto_limpa . '" '; if ($adjunto_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="adjunto_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><span id="id_ajax_doc_adjunto"><a href="javascript:nm_mostra_doc('0', '<?php echo str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_adjunto, 3)); ?>', 'form_prod_presupuesto_periodo_hitos')"><?php echo $adjunto ?></a></span><div id="id_img_loader_adjunto" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_adjunto" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['link_externo']))
    {
        $this->nm_new_label['link_externo'] = "Link Externo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $link_externo = $this->link_externo;
   $sStyleHidden_link_externo = '';
   if (isset($this->nmgp_cmp_hidden['link_externo']) && $this->nmgp_cmp_hidden['link_externo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['link_externo']);
       $sStyleHidden_link_externo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_link_externo = 'display: none;';
   $sStyleReadInp_link_externo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['link_externo']) && $this->nmgp_cmp_readonly['link_externo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['link_externo']);
       $sStyleReadLab_link_externo = '';
       $sStyleReadInp_link_externo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['link_externo']) && $this->nmgp_cmp_hidden['link_externo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="link_externo" value="<?php echo $this->form_encode_input($link_externo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_link_externo_line" id="hidden_field_data_link_externo" style="<?php echo $sStyleHidden_link_externo; ?>"> <span class="scFormLabelOddFormat css_link_externo_label" style=""><span id="id_label_link_externo"><?php echo $this->nm_new_label['link_externo']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["link_externo"]) &&  $this->nmgp_cmp_readonly["link_externo"] == "on") { 

 ?>
<input type="hidden" name="link_externo" value="<?php echo $this->form_encode_input($link_externo) . "\">" . $link_externo . ""; ?>
<?php } else { ?>
<span id="id_read_on_link_externo" class="sc-ui-readonly-link_externo css_link_externo_line" style="<?php echo $sStyleReadLab_link_externo; ?>"><?php echo $this->form_format_readonly("link_externo", $this->form_encode_input($this->link_externo)); ?></span><span id="id_read_off_link_externo" class="css_read_off_link_externo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_link_externo; ?>">
 <input class="sc-js-input scFormObjectOdd css_link_externo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_link_externo" type=text name="link_externo" value="<?php echo $this->form_encode_input($link_externo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hitos_asociados']))
   {
       $this->nm_new_label['hitos_asociados'] = "Hitos Asociados Al Período";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hitos_asociados = $this->hitos_asociados;
   $sStyleHidden_hitos_asociados = '';
   if (isset($this->nmgp_cmp_hidden['hitos_asociados']) && $this->nmgp_cmp_hidden['hitos_asociados'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hitos_asociados']);
       $sStyleHidden_hitos_asociados = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hitos_asociados = 'display: none;';
   $sStyleReadInp_hitos_asociados = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hitos_asociados']) && $this->nmgp_cmp_readonly['hitos_asociados'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hitos_asociados']);
       $sStyleReadLab_hitos_asociados = '';
       $sStyleReadInp_hitos_asociados = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hitos_asociados']) && $this->nmgp_cmp_hidden['hitos_asociados'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hitos_asociados" value="<?php echo $this->form_encode_input($this->hitos_asociados_hidden) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php  $this->hitos_asociados_1 = explode("@?@", $this->hitos_asociados) ; ?>
    <TD class="scFormDataOdd css_hitos_asociados_line" id="hidden_field_data_hitos_asociados" style="<?php echo $sStyleHidden_hitos_asociados; ?>"> <span class="scFormLabelOddFormat css_hitos_asociados_label" style=""><span id="id_label_hitos_asociados"><?php echo $this->nm_new_label['hitos_asociados']; ?></span></span><br> 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['Lookup_hitos_asociados']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['Lookup_hitos_asociados'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['Lookup_hitos_asociados']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['Lookup_hitos_asociados'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['Lookup_hitos_asociados']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['Lookup_hitos_asociados'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['Lookup_hitos_asociados']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['Lookup_hitos_asociados'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_id_presupuesto_periodo = $this->id_presupuesto_periodo;
   $old_value_id_hito = $this->id_hito;
   $old_value_estado = $this->estado;
   $old_value_fecha_hito = $this->fecha_hito;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_id_presupuesto_periodo = $this->id_presupuesto_periodo;
   $unformatted_value_id_hito = $this->id_hito;
   $unformatted_value_estado = $this->estado;
   $unformatted_value_fecha_hito = $this->fecha_hito;

   $nm_comando = "SELECT    prod_hitos_proyectos.id_hito, prod_hitos_contractuales.nombre  FROM   prod_hitos_proyectos   INNER JOIN prod_hitos_contractuales ON (prod_hitos_proyectos.id_hito = prod_hitos_contractuales.id)   INNER JOIN prod_hitos_tipo ON (prod_hitos_contractuales.id_tipo_hito = prod_hitos_tipo.id) WHERE   prod_hitos_proyectos.id_partida_presupuesto_periodo =" . $_SESSION['id_partida'] . "";

   $this->id = $old_value_id;
   $this->id_presupuesto_periodo = $old_value_id_presupuesto_periodo;
   $this->id_hito = $old_value_id_hito;
   $this->estado = $old_value_estado;
   $this->fecha_hito = $old_value_fecha_hito;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['Lookup_hitos_asociados'][] = $rs->fields[0];
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
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   $x = 0 ; 
   $hitos_asociados_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->hitos_asociados_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  $hitos_asociados_look .= $cadaselect[0] . "<br>";
                  break;
              }
          }
          $x++; 
   }
          if (empty($hitos_asociados_look))
          {
              $hitos_asociados_look = $this->hitos_asociados;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hitos_asociados\" class=\"css_hitos_asociados_line\" style=\"" .  $sStyleReadLab_hitos_asociados . "\">" . $this->form_format_readonly("hitos_asociados", $this->form_encode_input($hitos_asociados_look)) . "</span><span id=\"id_read_off_hitos_asociados\" class=\"css_read_off_hitos_asociados" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hitos_asociados . "\">";
   echo "<table style=\"display: inline-block\"><tr><td>" ; 
   echo " <span id=\"idAjaxSelect_hitos_asociados\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hitos_asociados_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hitos_asociados\" name=\"hitos_asociados_orig\" size=\"7\" multiple onDblClick=\"nm_add_sel('hitos_asociados_orig', 'hitos_asociados_dest', null);  \" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          foreach ($this->hitos_asociados_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  echo " disabled=\"disabled\" style=\"color: #A0A0A0\"";
                  break;
              }
          }
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "</td>";
   echo "<td align=\"center\">";
   echo "<div class='scBtnPassField' id='hitos_asociados_all_right'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bpassfld_rightall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bpassfld_rightall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_rightall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_rightall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_rightall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_rightall", "nm_add_all('hitos_asociados_orig', 'hitos_asociados_dest', null);    return false;", "nm_add_all('hitos_asociados_orig', 'hitos_asociados_dest', null);    return false;", "Bbpassfld_rightall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bpassfld_right']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bpassfld_right']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_right']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_right']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_right'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_right", "nm_add_sel('hitos_asociados_orig', 'hitos_asociados_dest', null);    return false;", "nm_add_sel('hitos_asociados_orig', 'hitos_asociados_dest', null);    return false;", "Bbpassfld_righ", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bpassfld_left']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bpassfld_left']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_left']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_left']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_left'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_left", "nm_del_sel('hitos_asociados_dest', 'hitos_asociados_orig', null);    return false;", "nm_del_sel('hitos_asociados_dest', 'hitos_asociados_orig', null);    return false;", "Bbpassfld_left", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField' id='hitos_asociados_all_left'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bpassfld_leftall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['bpassfld_leftall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_leftall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_leftall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['bpassfld_leftall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_leftall", "nm_del_all('hitos_asociados_dest', 'hitos_asociados_orig', null);    return false;", "nm_del_all('hitos_asociados_dest', 'hitos_asociados_orig', null);    return false;", "Bbpassfld_leftall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "</td>";
   echo "<td>";
   echo " <select class=\"sc-js-input scFormObjectOdd css_hitos_asociados_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" name=\"hitos_asociados_dest\"  onBlur=\"scCssBlur(this);\"  onFocus=\"scCssFocus(this);\"  size=7 multiple onDblClick=\"nm_del_sel('hitos_asociados_dest', 'hitos_asociados_orig', null);  \" alt=\"{type: 'select', enterTab: false}\">";
   $x = 0 ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->hitos_asociados_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  echo "  <option value=\"$cadaselect[1]\" selected>" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>"; 
                  break;
              }
          }
          $x++ ; 
   }  ; 
   echo " </select>" ; 
   echo " <input type=\"hidden\" name=\"hitos_asociados\" value=\"\">" ; 
   echo "</td></tr></table>";
   echo " <script>document.F1.hitos_asociados_dest.selectedIndex = -1;</script>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
 </TD>
   




<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } ?>
   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr>
<tr id="sc-id-required-row"><td class="scFormPageText">
<span class="scFormRequiredOddColor">* <?php echo $this->Ini->Nm_lang['lang_othr_reqr']; ?></span>
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", " nm_navpage(document.F1.nmgp_rec_b.value, 'P');document.F1.nmgp_rec_b.value = ''", " nm_navpage(document.F1.nmgp_rec_b.value, 'P');document.F1.nmgp_rec_b.value = ''", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['qtline'] == "on")
      {
?> 
          <span class="<?php echo $this->css_css_toolbar_obj ?>" style="border: 0px;"><?php echo $this->Ini->Nm_lang['lang_btns_rows'] ?></span>
          <select class="scFormToolbarInput" name="nmgp_quant_linhas_b" onchange="document.F7.nmgp_max_line.value = this.value; document.F7.submit();"> 
<?php 
              $obj_sel = ($this->sc_max_reg == '1') ? " selected" : "";
?> 
           <option value="1" <?php echo $obj_sel ?>>1</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '10') ? " selected" : "";
?> 
           <option value="10" <?php echo $obj_sel ?>>10</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '20') ? " selected" : "";
?> 
           <option value="20" <?php echo $obj_sel ?>>20</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '50') ? " selected" : "";
?> 
           <option value="50" <?php echo $obj_sel ?>>50</option>
          </select>
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-25';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "nm_move ('inicio');", "nm_move ('inicio');", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-26';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['back'];
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-27';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "nm_move ('avanca');", "nm_move ('avanca');", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-28';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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

</form> 
<?php
      $Tzone = ini_get('date.timezone');
      if (empty($Tzone))
      {
?>
<script> 
  _scAjaxShowMessage({title: '', message: "<?php echo $this->Ini->Nm_lang['lang_errm_tz']; ?>", isModal: false, timeout: 0, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: true, showBodyIcon: false, isToast: false, toastPos: ""});
</script> 
<?php
      }
?>
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
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_prod_presupuesto_periodo_hitos_mob");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_prod_presupuesto_periodo_hitos_mob");
 parent.scAjaxDetailHeight("form_prod_presupuesto_periodo_hitos_mob", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_prod_presupuesto_periodo_hitos_mob", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_prod_presupuesto_periodo_hitos_mob", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['sc_modal'])
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
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-out"><?php echo $this->Ini->Nm_lang['lang_version_web']; ?></span>
<?php
       }
?>
<iframe id="sc-id-download-iframe" name="sc_name_download_iframe" style="display: none"></iframe>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_hitos_mob']['buttonStatus'] = $this->nmgp_botoes;
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
