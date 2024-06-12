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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_btns_mdtl_neww'] . " " . $this->Ini->Nm_lang['lang_appointment'] . ""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_appointment_info'] . ""); } ?></TITLE>
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
.css_read_off_appointment_start_date button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_appointment_end_date button {
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_pdf']))
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
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>calendar_appointments_staff/calendar_appointments_staff_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("calendar_appointments_staff_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['last'] : 'off'); ?>";
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

 function sc_calendar_all_day_click() {
  
 } // sc_calendar_all_day_click

 function sc_calendar_recurrence_change() {
  
 } // sc_calendar_recurrence_change

 function nm_field_disabled(Fields, Opt) {
  opcao = "<?php if ($GLOBALS["erro_incl"] == 1) {echo "novo";} else {echo $this->nmgp_opcao;} ?>";
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
     if (F_name == "current_status_id")
     {
        $('select[name="current_status_id"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('select[name="current_status_id"]').addClass("scFormInputDisabled");
        }
        else {
            $('select[name="current_status_id"]').removeClass("scFormInputDisabled");
        }
     }
  }
 } // nm_field_disabled
<?php

include_once('calendar_appointments_staff_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  mainForm = document.getElementById('main_table_form');
  formResize();

  sc_calendar_all_day_click();
  sc_calendar_recurrence_change();

  sc_form_onload();

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
   });
 function formResize()
 {
    var formWidth = mainForm.clientWidth,
        formHeight = mainForm.clientHeight,
        windowHeight = $(window.parent).height();
    if (0 == formWidth || 0 == formHeight)
    {
        setTimeout("formResize()", 50);
    }
    else
    {
        if (formHeight > windowHeight - 100)
        {
            formHeight = windowHeight - 100;
        }
        self.parent.tb_resize(formHeight + 50, formWidth + 50);
    }
 }

 if($(".sc-ui-block-control").length) {
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['recarga'];
}
    $remove_margin = '';
    $remove_border = '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['link_info']['remove_border']) {
        $remove_border = 'border-width: 0; ';
    }
    $vertical_center = '';
?>
<body class="scFormPage sc-app-calendar" style="<?php echo $remove_margin . $str_iframe_body . $vertical_center; ?>">
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
 include_once("calendar_appointments_staff_js0.php");
?>
<script type="text/javascript"> 
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
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['insert_validation']; ?>">
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
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['calendar_appointments_staff'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['calendar_appointments_staff'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0 >
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['current_status_id']))
           {
               $this->nmgp_cmp_readonly['current_status_id'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['current_status_id']))
   {
       $this->nm_new_label['current_status_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $current_status_id = $this->current_status_id;
   $sStyleHidden_current_status_id = '';
   if (isset($this->nmgp_cmp_hidden['current_status_id']) && $this->nmgp_cmp_hidden['current_status_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['current_status_id']);
       $sStyleHidden_current_status_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_current_status_id = 'display: none;';
   $sStyleReadInp_current_status_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["current_status_id"]) &&  $this->nmgp_cmp_readonly["current_status_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['current_status_id']);
       $sStyleReadLab_current_status_id = '';
       $sStyleReadInp_current_status_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['current_status_id']) && $this->nmgp_cmp_hidden['current_status_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="current_status_id" value="<?php echo $this->form_encode_input($this->current_status_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_current_status_id_line" id="hidden_field_data_current_status_id" style="<?php echo $sStyleHidden_current_status_id; ?>"> <span class="scFormLabelOddFormat css_current_status_id_label" style=""><span id="id_label_current_status_id"><?php echo $this->nm_new_label['current_status_id']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["current_status_id"]) &&  $this->nmgp_cmp_readonly["current_status_id"] == "on")) { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_intervalo = $this->intervalo;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_intervalo = $this->intervalo;

   $__calend_all_day___val_str = "''";
   if (!empty($this->__calend_all_day__))
   {
       if (is_array($this->__calend_all_day__))
       {
           $Tmp_array = $this->__calend_all_day__;
       }
       else
       {
           $Tmp_array = explode(";", $this->__calend_all_day__);
       }
       $__calend_all_day___val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $__calend_all_day___val_str)
          {
             $__calend_all_day___val_str .= ", ";
          }
          $__calend_all_day___val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT appointment_status_id, appointment_status_descr, color  FROM appointment_status  ORDER BY appointment_status_descr";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->intervalo = $old_value_intervalo;

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
              if (isset($rs->fields[2]))
              {
                  $nmgp_def_dados .= $rs->fields[0] . "?#?N?#?" . $rs->fields[2] . "?@?"; 
              }
              else
              {
                  $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?"; 
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'][] = $rs->fields[0];
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
   $current_status_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->current_status_id_1))
          {
              foreach ($this->current_status_id_1 as $tmp_current_status_id)
              {
                  if (trim($tmp_current_status_id) === trim($cadaselect[1])) { $current_status_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->current_status_id) === trim($cadaselect[1])) { $current_status_id_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="current_status_id" value="<?php echo $this->form_encode_input($current_status_id) . "\"><span id=\"id_ajax_label_current_status_id\">" . $current_status_id_look . "</span>"; ?>
<?php } else { ?>
<?php

$categoryLookup = array();

?> 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_intervalo = $this->intervalo;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_intervalo = $this->intervalo;

   $__calend_all_day___val_str = "''";
   if (!empty($this->__calend_all_day__))
   {
       if (is_array($this->__calend_all_day__))
       {
           $Tmp_array = $this->__calend_all_day__;
       }
       else
       {
           $Tmp_array = explode(";", $this->__calend_all_day__);
       }
       $__calend_all_day___val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $__calend_all_day___val_str)
          {
             $__calend_all_day___val_str .= ", ";
          }
          $__calend_all_day___val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT appointment_status_id, appointment_status_descr, color  FROM appointment_status  ORDER BY appointment_status_descr";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->intervalo = $old_value_intervalo;

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
              if (isset($rs->fields[2]))
              {
                  $nmgp_def_dados .= $rs->fields[0] . "?#?N?#?" . $rs->fields[2] . "?@?"; 
              }
              else
              {
                  $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?"; 
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'][] = $rs->fields[0];
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


$lookupCategories = explode('?@?', $nmgp_def_dados);

foreach ($lookupCategories as $eachLookupCategory) {
        if ('' != trim($eachLookupCategory)) {
                $thisLookupCategory = explode('?#?', $eachLookupCategory);

                $categoryLookup[] = array(
                        'label'   => isset($thisLookupCategory[0]) ? $thisLookupCategory[0]        : '',
                        'value'   => isset($thisLookupCategory[1]) ? $thisLookupCategory[1]        : '',
                        'default' => isset($thisLookupCategory[2]) ? 'S' == $thisLookupCategory[2] : false,
                        'color'   => isset($thisLookupCategory[3]) ? $thisLookupCategory[3]        : ''
                );
        }
}

?>
<script type="text/javascript">
$(function() {
        $("#id-cat-label-current_status_id").on("click", function() {
                var inputOffset = $(this).offset();
                $(this).addClass("scFormObjectFocusOdd");
                $("#id-cat-dropdown-current_status_id").css({"display": "inline-block", "left": inputOffset.left, "top": inputOffset.top + $(this).outerHeight()}).show();
        });

        $("#id-cat-label-desc-current_status_id").on("mouseenter", function() {
                $(this).css("cursor", "default");
        });

        $(".sc-cal-categ-item-current_status_id").on("click", function() {
                var oldValue = $("#id_sc_field_current_status_id").val();

                $("#id_sc_field_current_status_id").val($(this).data("value"));
                $("#id-cat-label-desc-current_status_id").html($(this).data("label"));

                if ("" == $(this).data("color")) {
                        $("#id-cat-label-color-current_status_id").hide();
                }
                else {
                        $("#id-cat-label-color-current_status_id").css("background-color", $(this).data("color")).show();
                }

                $("#id-cat-dropdown-current_status_id").hide();
                if ('' == $("#id_sc_field_current_status_id").val()) {
                        $("#id-cat-label-empty-current_status_id").show();
                        $("#id-cat-label-info-current_status_id").hide();
                }
                else {
                        $("#id-cat-label-empty-current_status_id").hide();
                        $("#id-cat-label-info-current_status_id").show();
                }

                if (oldValue != $(this).data("value")) {
                        do_ajax_calendar_appointments_staff_event_current_status_id_onchange();
                }
        }).on("mouseenter", function() {
                $(".sc-cal-categ-item-current_status_id").removeClass("sc-cal-categ-selected");
                $(this).addClass("sc-cal-categ-selected").css("cursor", "default");
        });

        $(document).on("mouseup", function(e) {
                var container = $("#id-cat-dropdown-current_status_id");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                        container.hide();
                        $("#id-cat-label-current_status_id").removeClass("scFormObjectFocusOdd");
                }
        });

        var maxWidth = Math.max($("#id-cat-label-current_status_id").outerWidth(), $("#id-cat-dropdown-current_status_id").outerWidth());
        $("#id-cat-label-current_status_id").css("width", maxWidth);
        $("#id-cat-dropdown-current_status_id").css("width", maxWidth);
});
</script>

<input type="hidden" name="current_status_id" id="id_sc_field_current_status_id" value="<?php echo $this->form_encode_input($this->current_status_id); ?>" />
<?php

$calCategoryColor  = '';
$calCategoryLabel  = '';
if ('' != $this->current_status_id) {
	$displayLabelEmpty = ' style="display: none"';
	$displayLabelDesc  = '';
	foreach ($categoryLookup as $categoryInfo) {
		if (($this->current_status_id == $categoryInfo['value'] || $categoryInfo['default'])) {
			$calCategoryColor = ' style="background-color: ' . $categoryInfo['color'] . '"';
			$calCategoryLabel = $categoryInfo['label'];
			break;
		}
	}
}
else {
	$displayLabelEmpty = '';
	$displayLabelDesc  = ' style="display: none"';
	foreach ($categoryLookup as $categoryInfo) {
		if ($categoryInfo['default']) {
			$displayLabelEmpty = ' style="display: none"';
			$displayLabelDesc  = '';
			$calCategoryColor  = ' style="background-color: ' . $categoryInfo['color'] . '"';
			$calCategoryLabel  = $categoryInfo['label'];
			break;
		}
	}
}

?>
<div class="sc-cal-categ"<?php echo $this->classes_100perc_fields['style_category'] ?>>
	<div class="sc-cal-categ-input scFormObjectOdd" id="id-cat-label-current_status_id">
		<div class="sc-cal-categ-input-content">
			<span id="id-cat-label-empty-current_status_id"<?php echo $displayLabelEmpty; ?>>&nbsp;</span>
			<span id="id-cat-label-info-current_status_id"<?php echo $displayLabelDesc; ?>>
				<div class="sc-cal-categ-colorbox" id="id-cat-label-color-current_status_id"<?php echo $calCategoryColor; ?>></div>
				<span id="id-cat-label-desc-current_status_id"><?php echo $calCategoryLabel; ?></span>
			</span>
		</div>
		<div class="sc-cal-categ-input-caret">&#x25BC;</div>
	</div>
	<div class="sc-cal-categ-dropdown" id="id-cat-dropdown-current_status_id">
<?php

$hasSelectedItem = false;
foreach ($categoryLookup as $categoryInfo) {
        $categoryClass = '';
        if (!$hasSelectedItem && ($this->current_status_id == $categoryInfo['value'] || $categoryInfo['default'])) {
                $categoryClass   = ' sc-cal-categ-selected';
                $hasSelectedItem = true;
        }
?>
                <div id="id-cat-item-current_status_id-<?php echo $categoryInfo['value']; ?>" class="sc-cal-categ-item sc-cal-categ-item-current_status_id<?php echo $categoryClass; ?>" data-value="<?php echo $categoryInfo['value']; ?>" data-label="<?php echo $categoryInfo['label']; ?>" data-color="<?php echo $categoryInfo['color']; ?>">
<?php
        if (false !== $categoryInfo['color']) {
?>
                        <div class="sc-cal-categ-colorbox" style="background-color: <?php echo $categoryInfo['color']; ?>"></div>
<?php
        }
?>
                        <?php echo $this->form_encode_input($categoryInfo['label']); ?>
                </div>
<?php
}

?>
        </div>
</div>
<?php  }?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nombre']))
    {
        $this->nm_new_label['nombre'] = "Nombre Actividad";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nombre = $this->nombre;
   $sStyleHidden_nombre = '';
   if (isset($this->nmgp_cmp_hidden['nombre']) && $this->nmgp_cmp_hidden['nombre'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nombre']);
       $sStyleHidden_nombre = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nombre = 'display: none;';
   $sStyleReadInp_nombre = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nombre']) && $this->nmgp_cmp_readonly['nombre'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nombre']);
       $sStyleReadLab_nombre = '';
       $sStyleReadInp_nombre = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nombre']) && $this->nmgp_cmp_hidden['nombre'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nombre" value="<?php echo $this->form_encode_input($nombre) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_nombre_line" id="hidden_field_data_nombre" style="<?php echo $sStyleHidden_nombre; ?>"> <span class="scFormLabelOddFormat css_nombre_label" style=""><span id="id_label_nombre"><?php echo $this->nm_new_label['nombre']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nombre"]) &&  $this->nmgp_cmp_readonly["nombre"] == "on") { 

 ?>
<input type="hidden" name="nombre" value="<?php echo $this->form_encode_input($nombre) . "\">" . $nombre . ""; ?>
<?php } else { ?>
<span id="id_read_on_nombre" class="sc-ui-readonly-nombre css_nombre_line" style="<?php echo $sStyleReadLab_nombre; ?>"><?php echo $this->form_format_readonly("nombre", $this->form_encode_input($this->nombre)); ?></span><span id="id_read_off_nombre" class="css_read_off_nombre<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nombre; ?>">
 <input class="sc-js-input scFormObjectOdd css_nombre_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nombre" type=text name="nombre" value="<?php echo $this->form_encode_input($nombre) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_nombre_dumb = ('' == $sStyleHidden_nombre) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_nombre_dumb" style="<?php echo $sStyleHidden_nombre_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_actividad']))
   {
       $this->nm_new_label['id_actividad'] = "Tipo Actividad";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_actividad = $this->id_actividad;
   $sStyleHidden_id_actividad = '';
   if (isset($this->nmgp_cmp_hidden['id_actividad']) && $this->nmgp_cmp_hidden['id_actividad'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_actividad']);
       $sStyleHidden_id_actividad = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_actividad = 'display: none;';
   $sStyleReadInp_id_actividad = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_actividad']) && $this->nmgp_cmp_readonly['id_actividad'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_actividad']);
       $sStyleReadLab_id_actividad = '';
       $sStyleReadInp_id_actividad = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_actividad']) && $this->nmgp_cmp_hidden['id_actividad'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_actividad" value="<?php echo $this->form_encode_input($this->id_actividad) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_id_actividad_line" id="hidden_field_data_id_actividad" style="<?php echo $sStyleHidden_id_actividad; ?>"> <span class="scFormLabelOddFormat css_id_actividad_label" style=""><span id="id_label_id_actividad"><?php echo $this->nm_new_label['id_actividad']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_actividad"]) &&  $this->nmgp_cmp_readonly["id_actividad"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_intervalo = $this->intervalo;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_intervalo = $this->intervalo;

   $nm_comando = "SELECT id, nombre_actividad, id  FROM tipo_actividades where habilitado=1  ORDER BY nombre_actividad";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->intervalo = $old_value_intervalo;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[2] = str_replace(',', '.', $rs->fields[2]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $rs->fields[2] = (strpos(strtolower($rs->fields[2]), "e")) ? (float)$rs->fields[2] : $rs->fields[2];
              $rs->fields[2] = (string)$rs->fields[2];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad'][] = $rs->fields[0];
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
   $id_actividad_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_actividad_1))
          {
              foreach ($this->id_actividad_1 as $tmp_id_actividad)
              {
                  if (trim($tmp_id_actividad) === trim($cadaselect[1])) { $id_actividad_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_actividad) === trim($cadaselect[1])) { $id_actividad_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_actividad" value="<?php echo $this->form_encode_input($id_actividad) . "\">" . $id_actividad_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_actividad();
   $x = 0 ; 
   $id_actividad_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_actividad_1))
          {
              foreach ($this->id_actividad_1 as $tmp_id_actividad)
              {
                  if (trim($tmp_id_actividad) === trim($cadaselect[1])) { $id_actividad_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_actividad) === trim($cadaselect[1])) { $id_actividad_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_actividad_look))
          {
              $id_actividad_look = $this->id_actividad;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_actividad\" class=\"css_id_actividad_line\" style=\"" .  $sStyleReadLab_id_actividad . "\">" . $this->form_format_readonly("id_actividad", $this->form_encode_input($id_actividad_look)) . "</span><span id=\"id_read_off_id_actividad\" class=\"css_read_off_id_actividad" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_actividad . "\">";
   echo " <span id=\"idAjaxSelect_id_actividad\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_actividad_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_actividad\" name=\"id_actividad\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_actividad'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_actividad) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_actividad)) 
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
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_id_actividad_dumb = ('' == $sStyleHidden_id_actividad) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_id_actividad_dumb" style="<?php echo $sStyleHidden_id_actividad_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_2"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_2"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['busca_proyecto']))
    {
        $this->nm_new_label['busca_proyecto'] = "Buscar Proyecto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $busca_proyecto = $this->busca_proyecto;
   $sStyleHidden_busca_proyecto = '';
   if (isset($this->nmgp_cmp_hidden['busca_proyecto']) && $this->nmgp_cmp_hidden['busca_proyecto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['busca_proyecto']);
       $sStyleHidden_busca_proyecto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_busca_proyecto = 'display: none;';
   $sStyleReadInp_busca_proyecto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['busca_proyecto']) && $this->nmgp_cmp_readonly['busca_proyecto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['busca_proyecto']);
       $sStyleReadLab_busca_proyecto = '';
       $sStyleReadInp_busca_proyecto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['busca_proyecto']) && $this->nmgp_cmp_hidden['busca_proyecto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="busca_proyecto" value="<?php echo $this->form_encode_input($busca_proyecto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_busca_proyecto_line" id="hidden_field_data_busca_proyecto" style="<?php echo $sStyleHidden_busca_proyecto; ?>"> <span class="scFormLabelOddFormat css_busca_proyecto_label" style=""><span id="id_label_busca_proyecto"><?php echo $this->nm_new_label['busca_proyecto']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["busca_proyecto"]) &&  $this->nmgp_cmp_readonly["busca_proyecto"] == "on") { 

 ?>
<input type="hidden" name="busca_proyecto" value="<?php echo $this->form_encode_input($busca_proyecto) . "\">" . $busca_proyecto . ""; ?>
<?php } else { ?>
<span id="id_read_on_busca_proyecto" class="sc-ui-readonly-busca_proyecto css_busca_proyecto_line" style="<?php echo $sStyleReadLab_busca_proyecto; ?>"><?php echo $this->form_format_readonly("busca_proyecto", $this->form_encode_input($this->busca_proyecto)); ?></span><span id="id_read_off_busca_proyecto" class="css_read_off_busca_proyecto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_busca_proyecto; ?>">
 <input class="sc-js-input scFormObjectOdd css_busca_proyecto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_busca_proyecto" type=text name="busca_proyecto" value="<?php echo $this->form_encode_input($busca_proyecto) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: 'Ayuda: Ingrese Patrón de Búsqueda', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_proyecto']))
   {
       $this->nm_new_label['id_proyecto'] = "Proyecto";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_proyecto = $this->id_proyecto;
   $sStyleHidden_id_proyecto = '';
   if (isset($this->nmgp_cmp_hidden['id_proyecto']) && $this->nmgp_cmp_hidden['id_proyecto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_proyecto']);
       $sStyleHidden_id_proyecto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_proyecto = 'display: none;';
   $sStyleReadInp_id_proyecto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_proyecto']) && $this->nmgp_cmp_readonly['id_proyecto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_proyecto']);
       $sStyleReadLab_id_proyecto = '';
       $sStyleReadInp_id_proyecto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_proyecto']) && $this->nmgp_cmp_hidden['id_proyecto'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_proyecto" value="<?php echo $this->form_encode_input($this->id_proyecto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_id_proyecto_line" id="hidden_field_data_id_proyecto" style="<?php echo $sStyleHidden_id_proyecto; ?>"> <span class="scFormLabelOddFormat css_id_proyecto_label" style=""><span id="id_label_id_proyecto"><?php echo $this->nm_new_label['id_proyecto']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_proyecto"]) &&  $this->nmgp_cmp_readonly["id_proyecto"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_intervalo = $this->intervalo;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_intervalo = $this->intervalo;

   $nm_comando = "SELECT    proyectos.id, proyectos.nombre_proyecto FROM   usuarios_proyectos   INNER JOIN proyectos ON (usuarios_proyectos.id_proyecto = proyectos.id) WHERE   usuarios_proyectos.id_usuario=" . $_SESSION['glo_staff_id'] . "  and habilitado=1 and LCASE(proyectos.nombre_proyecto) like '%$this->busca_proyecto%' order by proyectos.nombre_proyecto";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->intervalo = $old_value_intervalo;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto'][] = $rs->fields[0];
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
   $id_proyecto_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_proyecto_1))
          {
              foreach ($this->id_proyecto_1 as $tmp_id_proyecto)
              {
                  if (trim($tmp_id_proyecto) === trim($cadaselect[1])) { $id_proyecto_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_proyecto) === trim($cadaselect[1])) { $id_proyecto_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_proyecto" value="<?php echo $this->form_encode_input($id_proyecto) . "\">" . $id_proyecto_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_proyecto();
   $x = 0 ; 
   $id_proyecto_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_proyecto_1))
          {
              foreach ($this->id_proyecto_1 as $tmp_id_proyecto)
              {
                  if (trim($tmp_id_proyecto) === trim($cadaselect[1])) { $id_proyecto_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_proyecto) === trim($cadaselect[1])) { $id_proyecto_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_proyecto_look))
          {
              $id_proyecto_look = $this->id_proyecto;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_proyecto\" class=\"css_id_proyecto_line\" style=\"" .  $sStyleReadLab_id_proyecto . "\">" . $this->form_format_readonly("id_proyecto", $this->form_encode_input($id_proyecto_look)) . "</span><span id=\"id_read_off_id_proyecto\" class=\"css_read_off_id_proyecto" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_proyecto . "\">";
   echo " <span id=\"idAjaxSelect_id_proyecto\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_proyecto_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_proyecto\" name=\"id_proyecto\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_id_proyecto'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_proyecto) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_proyecto)) 
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
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_id_proyecto_dumb = ('' == $sStyleHidden_id_proyecto) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_id_proyecto_dumb" style="<?php echo $sStyleHidden_id_proyecto_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_3"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_3"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['appointment_start_date']))
    {
        $this->nm_new_label['appointment_start_date'] = "Fecha Inicio";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $appointment_start_date = $this->appointment_start_date;
   $sStyleHidden_appointment_start_date = '';
   if (isset($this->nmgp_cmp_hidden['appointment_start_date']) && $this->nmgp_cmp_hidden['appointment_start_date'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['appointment_start_date']);
       $sStyleHidden_appointment_start_date = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_appointment_start_date = 'display: none;';
   $sStyleReadInp_appointment_start_date = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['appointment_start_date']) && $this->nmgp_cmp_readonly['appointment_start_date'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['appointment_start_date']);
       $sStyleReadLab_appointment_start_date = '';
       $sStyleReadInp_appointment_start_date = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['appointment_start_date']) && $this->nmgp_cmp_hidden['appointment_start_date'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="appointment_start_date" value="<?php echo $this->form_encode_input($appointment_start_date) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_appointment_start_date_line" id="hidden_field_data_appointment_start_date" style="<?php echo $sStyleHidden_appointment_start_date; ?>"> <span class="scFormLabelOddFormat css_appointment_start_date_label" style=""><span id="id_label_appointment_start_date"><?php echo $this->nm_new_label['appointment_start_date']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['php_cmp_required']['appointment_start_date']) || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['php_cmp_required']['appointment_start_date'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["appointment_start_date"]) &&  $this->nmgp_cmp_readonly["appointment_start_date"] == "on") { 

 ?>
<input type="hidden" name="appointment_start_date" value="<?php echo $this->form_encode_input($appointment_start_date) . "\">" . $appointment_start_date . ""; ?>
<?php } else { ?>
<span id="id_read_on_appointment_start_date" class="sc-ui-readonly-appointment_start_date css_appointment_start_date_line" style="<?php echo $sStyleReadLab_appointment_start_date; ?>"><?php echo $this->form_format_readonly("appointment_start_date", $this->form_encode_input($appointment_start_date)); ?></span><span id="id_read_off_appointment_start_date" class="css_read_off_appointment_start_date<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_appointment_start_date; ?>"><?php
$tmp_form_data = $this->field_config['appointment_start_date']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_appointment_start_date_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_appointment_start_date" type=text name="appointment_start_date" value="<?php echo $this->form_encode_input($appointment_start_date) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['appointment_start_date']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['appointment_start_date']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_appointment_start_date_dumb = ('' == $sStyleHidden_appointment_start_date) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_appointment_start_date_dumb" style="<?php echo $sStyleHidden_appointment_start_date_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_4"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_4"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_4" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['intervalo']))
           {
               $this->nmgp_cmp_readonly['intervalo'] = 'on';
           }
?>


   <?php
   if (!isset($this->nm_new_label['appointment_start_time']))
   {
       $this->nm_new_label['appointment_start_time'] = "Hora Inicio";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $appointment_start_time = $this->appointment_start_time;
   $sStyleHidden_appointment_start_time = '';
   if (isset($this->nmgp_cmp_hidden['appointment_start_time']) && $this->nmgp_cmp_hidden['appointment_start_time'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['appointment_start_time']);
       $sStyleHidden_appointment_start_time = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_appointment_start_time = 'display: none;';
   $sStyleReadInp_appointment_start_time = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['appointment_start_time']) && $this->nmgp_cmp_readonly['appointment_start_time'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['appointment_start_time']);
       $sStyleReadLab_appointment_start_time = '';
       $sStyleReadInp_appointment_start_time = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['appointment_start_time']) && $this->nmgp_cmp_hidden['appointment_start_time'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="appointment_start_time" value="<?php echo $this->form_encode_input($this->appointment_start_time) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_appointment_start_time_line" id="hidden_field_data_appointment_start_time" style="<?php echo $sStyleHidden_appointment_start_time; ?>"> <span class="scFormLabelOddFormat css_appointment_start_time_label" style=""><span id="id_label_appointment_start_time"><?php echo $this->nm_new_label['appointment_start_time']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['php_cmp_required']['appointment_start_time']) || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['php_cmp_required']['appointment_start_time'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["appointment_start_time"]) &&  $this->nmgp_cmp_readonly["appointment_start_time"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_start_time']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_start_time'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_start_time']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_start_time'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_start_time']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_start_time'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_start_time']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_start_time'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_intervalo = $this->intervalo;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_intervalo = $this->intervalo;

   $__calend_all_day___val_str = "''";
   if (!empty($this->__calend_all_day__))
   {
       if (is_array($this->__calend_all_day__))
       {
           $Tmp_array = $this->__calend_all_day__;
       }
       else
       {
           $Tmp_array = explode(";", $this->__calend_all_day__);
       }
       $__calend_all_day___val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $__calend_all_day___val_str)
          {
             $__calend_all_day___val_str .= ", ";
          }
          $__calend_all_day___val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT hora_db, hora  FROM horas_activas  ORDER BY hora";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->intervalo = $old_value_intervalo;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_start_time'][] = $rs->fields[0];
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
   $appointment_start_time_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->appointment_start_time_1))
          {
              foreach ($this->appointment_start_time_1 as $tmp_appointment_start_time)
              {
                  if (trim($tmp_appointment_start_time) === trim($cadaselect[1])) { $appointment_start_time_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->appointment_start_time) === trim($cadaselect[1])) { $appointment_start_time_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="appointment_start_time" value="<?php echo $this->form_encode_input($appointment_start_time) . "\">" . $appointment_start_time_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_appointment_start_time();
   $x = 0 ; 
   $appointment_start_time_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->appointment_start_time_1))
          {
              foreach ($this->appointment_start_time_1 as $tmp_appointment_start_time)
              {
                  if (trim($tmp_appointment_start_time) === trim($cadaselect[1])) { $appointment_start_time_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->appointment_start_time) === trim($cadaselect[1])) { $appointment_start_time_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($appointment_start_time_look))
          {
              $appointment_start_time_look = $this->appointment_start_time;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_appointment_start_time\" class=\"css_appointment_start_time_line\" style=\"" .  $sStyleReadLab_appointment_start_time . "\">" . $this->form_format_readonly("appointment_start_time", $this->form_encode_input($appointment_start_time_look)) . "</span><span id=\"id_read_off_appointment_start_time\" class=\"css_read_off_appointment_start_time" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_appointment_start_time . "\">";
   echo " <span id=\"idAjaxSelect_appointment_start_time\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_appointment_start_time_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_appointment_start_time\" name=\"appointment_start_time\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->appointment_start_time) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->appointment_start_time)) 
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
 </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['appointment_end_time']))
   {
       $this->nm_new_label['appointment_end_time'] = "Hora Término";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $appointment_end_time = $this->appointment_end_time;
   $sStyleHidden_appointment_end_time = '';
   if (isset($this->nmgp_cmp_hidden['appointment_end_time']) && $this->nmgp_cmp_hidden['appointment_end_time'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['appointment_end_time']);
       $sStyleHidden_appointment_end_time = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_appointment_end_time = 'display: none;';
   $sStyleReadInp_appointment_end_time = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['appointment_end_time']) && $this->nmgp_cmp_readonly['appointment_end_time'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['appointment_end_time']);
       $sStyleReadLab_appointment_end_time = '';
       $sStyleReadInp_appointment_end_time = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['appointment_end_time']) && $this->nmgp_cmp_hidden['appointment_end_time'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="appointment_end_time" value="<?php echo $this->form_encode_input($this->appointment_end_time) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_appointment_end_time_line" id="hidden_field_data_appointment_end_time" style="<?php echo $sStyleHidden_appointment_end_time; ?>"> <span class="scFormLabelOddFormat css_appointment_end_time_label" style=""><span id="id_label_appointment_end_time"><?php echo $this->nm_new_label['appointment_end_time']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['php_cmp_required']['appointment_end_time']) || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['php_cmp_required']['appointment_end_time'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["appointment_end_time"]) &&  $this->nmgp_cmp_readonly["appointment_end_time"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_end_time']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_end_time'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_end_time']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_end_time'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_end_time']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_end_time'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_end_time']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_end_time'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_intervalo = $this->intervalo;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_intervalo = $this->intervalo;

   $__calend_all_day___val_str = "''";
   if (!empty($this->__calend_all_day__))
   {
       if (is_array($this->__calend_all_day__))
       {
           $Tmp_array = $this->__calend_all_day__;
       }
       else
       {
           $Tmp_array = explode(";", $this->__calend_all_day__);
       }
       $__calend_all_day___val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $__calend_all_day___val_str)
          {
             $__calend_all_day___val_str .= ", ";
          }
          $__calend_all_day___val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT hora_db, hora  FROM horas_activas  ORDER BY hora";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->intervalo = $old_value_intervalo;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_appointment_end_time'][] = $rs->fields[0];
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
   $appointment_end_time_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->appointment_end_time_1))
          {
              foreach ($this->appointment_end_time_1 as $tmp_appointment_end_time)
              {
                  if (trim($tmp_appointment_end_time) === trim($cadaselect[1])) { $appointment_end_time_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->appointment_end_time) === trim($cadaselect[1])) { $appointment_end_time_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="appointment_end_time" value="<?php echo $this->form_encode_input($appointment_end_time) . "\">" . $appointment_end_time_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_appointment_end_time();
   $x = 0 ; 
   $appointment_end_time_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->appointment_end_time_1))
          {
              foreach ($this->appointment_end_time_1 as $tmp_appointment_end_time)
              {
                  if (trim($tmp_appointment_end_time) === trim($cadaselect[1])) { $appointment_end_time_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->appointment_end_time) === trim($cadaselect[1])) { $appointment_end_time_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($appointment_end_time_look))
          {
              $appointment_end_time_look = $this->appointment_end_time;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_appointment_end_time\" class=\"css_appointment_end_time_line\" style=\"" .  $sStyleReadLab_appointment_end_time . "\">" . $this->form_format_readonly("appointment_end_time", $this->form_encode_input($appointment_end_time_look)) . "</span><span id=\"id_read_off_appointment_end_time\" class=\"css_read_off_appointment_end_time" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_appointment_end_time . "\">";
   echo " <span id=\"idAjaxSelect_appointment_end_time\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_appointment_end_time_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_appointment_end_time\" name=\"appointment_end_time\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->appointment_end_time) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->appointment_end_time)) 
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
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_appointment_start_time_dumb = ('' == $sStyleHidden_appointment_start_time) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_appointment_start_time_dumb" style="<?php echo $sStyleHidden_appointment_start_time_dumb; ?>"></TD>
<?php $sStyleHidden_appointment_end_time_dumb = ('' == $sStyleHidden_appointment_end_time) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_appointment_end_time_dumb" style="<?php echo $sStyleHidden_appointment_end_time_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['estado']))
           {
               $this->nmgp_cmp_readonly['estado'] = 'on';
           }
?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['observaciones']))
           {
               $this->nmgp_cmp_readonly['observaciones'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['intervalo']))
    {
        $this->nm_new_label['intervalo'] = "Intervalo (horas)";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $intervalo = $this->intervalo;
   $sStyleHidden_intervalo = '';
   if (isset($this->nmgp_cmp_hidden['intervalo']) && $this->nmgp_cmp_hidden['intervalo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['intervalo']);
       $sStyleHidden_intervalo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_intervalo = 'display: none;';
   $sStyleReadInp_intervalo = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["intervalo"]) &&  $this->nmgp_cmp_readonly["intervalo"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['intervalo']);
       $sStyleReadLab_intervalo = '';
       $sStyleReadInp_intervalo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['intervalo']) && $this->nmgp_cmp_hidden['intervalo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="intervalo" value="<?php echo $this->form_encode_input($intervalo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_intervalo_line" id="hidden_field_data_intervalo" style="<?php echo $sStyleHidden_intervalo; ?>"> <span class="scFormLabelOddFormat css_intervalo_label" style=""><span id="id_label_intervalo"><?php echo $this->nm_new_label['intervalo']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["intervalo"]) &&  $this->nmgp_cmp_readonly["intervalo"] == "on")) { 

 ?>
<input type="hidden" name="intervalo" value="<?php echo $this->form_encode_input($intervalo) . "\"><span id=\"id_ajax_label_intervalo\">" . $intervalo . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_intervalo" class="sc-ui-readonly-intervalo css_intervalo_line" style="<?php echo $sStyleReadLab_intervalo; ?>"><?php echo $this->form_format_readonly("intervalo", $this->form_encode_input($this->intervalo)); ?></span><span id="id_read_off_intervalo" class="css_read_off_intervalo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_intervalo; ?>">
 <input class="sc-js-input scFormObjectOdd css_intervalo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_intervalo" type=text name="intervalo" value="<?php echo $this->form_encode_input($intervalo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['intervalo']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['intervalo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['intervalo']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['intervalo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['estado']))
   {
       $this->nm_new_label['estado'] = "Estado";
   }
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
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["estado"]) &&  $this->nmgp_cmp_readonly["estado"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['estado']);
       $sStyleReadLab_estado = '';
       $sStyleReadInp_estado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['estado']) && $this->nmgp_cmp_hidden['estado'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="estado" value="<?php echo $this->form_encode_input($this->estado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_estado_line" id="hidden_field_data_estado" style="<?php echo $sStyleHidden_estado; ?>"> <span class="scFormLabelOddFormat css_estado_label" style=""><span id="id_label_estado"><?php echo $this->nm_new_label['estado']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["estado"]) &&  $this->nmgp_cmp_readonly["estado"] == "on")) { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_estado']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_estado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_estado']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_estado'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_estado']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_estado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_estado']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_estado'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_intervalo = $this->intervalo;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_intervalo = $this->intervalo;

   $__calend_all_day___val_str = "''";
   if (!empty($this->__calend_all_day__))
   {
       if (is_array($this->__calend_all_day__))
       {
           $Tmp_array = $this->__calend_all_day__;
       }
       else
       {
           $Tmp_array = explode(";", $this->__calend_all_day__);
       }
       $__calend_all_day___val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $__calend_all_day___val_str)
          {
             $__calend_all_day___val_str .= ", ";
          }
          $__calend_all_day___val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT appointment_status_id, appointment_status_descr  FROM appointment_status  ORDER BY appointment_status_descr";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->intervalo = $old_value_intervalo;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_estado'][] = $rs->fields[0];
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
   $estado_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->estado_1))
          {
              foreach ($this->estado_1 as $tmp_estado)
              {
                  if (trim($tmp_estado) === trim($cadaselect[1])) { $estado_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->estado) === trim($cadaselect[1])) { $estado_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="estado" value="<?php echo $this->form_encode_input($estado) . "\"><span id=\"id_ajax_label_estado\">" . $estado_look . "</span>"; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_estado();
   $x = 0 ; 
   $estado_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->estado_1))
          {
              foreach ($this->estado_1 as $tmp_estado)
              {
                  if (trim($tmp_estado) === trim($cadaselect[1])) { $estado_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->estado) === trim($cadaselect[1])) { $estado_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($estado_look))
          {
              $estado_look = $this->estado;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_estado\" class=\"css_estado_line\" style=\"" .  $sStyleReadLab_estado . "\">" . $this->form_format_readonly("estado", $this->form_encode_input($estado_look)) . "</span><span id=\"id_read_off_estado\" class=\"css_read_off_estado" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_estado . "\">";
   echo " <span id=\"idAjaxSelect_estado\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_estado_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_estado\" name=\"estado\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->estado) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->estado)) 
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
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_intervalo_dumb = ('' == $sStyleHidden_intervalo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_intervalo_dumb" style="<?php echo $sStyleHidden_intervalo_dumb; ?>"></TD>
<?php $sStyleHidden_estado_dumb = ('' == $sStyleHidden_estado) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_estado_dumb" style="<?php echo $sStyleHidden_estado_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_5"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_5"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_5" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['observaciones']))
    {
        $this->nm_new_label['observaciones'] = "Observaciones";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $observaciones = $this->observaciones;
   $sStyleHidden_observaciones = '';
   if (isset($this->nmgp_cmp_hidden['observaciones']) && $this->nmgp_cmp_hidden['observaciones'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['observaciones']);
       $sStyleHidden_observaciones = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_observaciones = 'display: none;';
   $sStyleReadInp_observaciones = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["observaciones"]) &&  $this->nmgp_cmp_readonly["observaciones"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['observaciones']);
       $sStyleReadLab_observaciones = '';
       $sStyleReadInp_observaciones = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['observaciones']) && $this->nmgp_cmp_hidden['observaciones'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="observaciones" value="<?php echo $this->form_encode_input($observaciones) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_observaciones_line" id="hidden_field_data_observaciones" style="<?php echo $sStyleHidden_observaciones; ?>"> <span class="scFormLabelOddFormat css_observaciones_label" style=""><span id="id_label_observaciones"><?php echo $this->nm_new_label['observaciones']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["observaciones"]) &&  $this->nmgp_cmp_readonly["observaciones"] == "on")) { 

 ?>
<input type="hidden" name="observaciones" value="<?php echo $this->form_encode_input($observaciones) . "\"><span id=\"id_ajax_label_observaciones\">" . $observaciones . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_observaciones" class="sc-ui-readonly-observaciones css_observaciones_line" style="<?php echo $sStyleReadLab_observaciones; ?>"><?php echo $this->form_format_readonly("observaciones", $this->form_encode_input($this->observaciones)); ?></span><span id="id_read_off_observaciones" class="css_read_off_observaciones<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observaciones; ?>">
 <input class="sc-js-input scFormObjectOdd css_observaciones_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_observaciones" type=text name="observaciones" value="<?php echo $this->form_encode_input($observaciones) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R")
{
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "nm_move ('novo');", "nm_move ('novo');", "sc_b_new_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "REGISTRAR";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "nm_atualiza ('incluir');", "nm_atualiza ('incluir');", "sc_b_ins_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "nm_atualiza ('excluir');", "nm_atualiza ('excluir');", "sc_b_del_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "sc_b_hlp_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R")
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
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1,2,3,4,5);

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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("calendar_appointments_staff");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("calendar_appointments_staff");
 parent.scAjaxDetailHeight("calendar_appointments_staff", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("calendar_appointments_staff", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("calendar_appointments_staff", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['sc_modal'])
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
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['buttonStatus'] = $this->nmgp_botoes;
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
