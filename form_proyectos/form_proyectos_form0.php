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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " proyectos"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " proyectos"); } ?></TITLE>
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
.css_read_off_fecha_inicio button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_fecha_termino button {
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_proyectos/form_proyectos_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_proyectos_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['last'] : 'off'); ?>";
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
<?php

include_once('form_proyectos_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['recarga'];
}
    $remove_margin = '';
    $remove_border = '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['link_info']['remove_border']) {
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
 include_once("form_proyectos_js0.php");
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
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_proyectos'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_proyectos'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="50%">
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R")
{
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['empty_filter'] = true;
       }
  }
?>
<style>
.scTabInactive {
    cursor: pointer;
}
</style>
<script type="text/javascript">
var pag_ativa = "form_proyectos_form0";
</script>
<ul class="scTabLine sc-ui-page-tab-line">
<?php
    $this->tabCssClass = array(
        'form_proyectos_form0' => array(
            'title' => "Datos Proyecto",
            'class' => empty($nmgp_num_form) || $nmgp_num_form == "form_proyectos_form0" ? "scTabActive" : "scTabInactive",
        ),
        'form_proyectos_form1' => array(
            'title' => "Usuarios Asociados",
            'class' => $nmgp_num_form == "form_proyectos_form1" ? "scTabActive" : "scTabInactive",
        ),
        'form_proyectos_form2' => array(
            'title' => "Itemización Producción",
            'class' => $nmgp_num_form == "form_proyectos_form2" ? "scTabActive" : "scTabInactive",
        ),
    );
    if (!empty($this->Ini->nm_hidden_pages)) {
        foreach ($this->Ini->nm_hidden_pages as $pageName => $pageStatus) {
            if ('Datos Proyecto' == $pageName && 'off' == $pageStatus) {
                $this->tabCssClass['form_proyectos_form0']['class'] = 'scTabInactive';
            }
            if ('Usuarios Asociados' == $pageName && 'off' == $pageStatus) {
                $this->tabCssClass['form_proyectos_form1']['class'] = 'scTabInactive';
            }
            if ('Itemización Producción' == $pageName && 'off' == $pageStatus) {
                $this->tabCssClass['form_proyectos_form2']['class'] = 'scTabInactive';
            }
        }
        $displayingPage = false;
        foreach ($this->tabCssClass as $pageInfo) {
            if ('scTabActive' == $pageInfo['class']) {
                $displayingPage = true;
                break;
            }
        }
        if (!$displayingPage) {
            foreach ($this->tabCssClass as $pageForm => $pageInfo) {
                if (!isset($this->Ini->nm_hidden_pages[ $pageInfo['title'] ]) || 'off' != $this->Ini->nm_hidden_pages[ $pageInfo['title'] ]) {
                    $this->tabCssClass[$pageForm]['class'] = 'scTabActive';
                    break;
                }
            }
        }
    }
?>
<?php
    $css_celula = $this->tabCssClass["form_proyectos_form0"]['class'];
?>
   <li id="id_form_proyectos_form0" class="<?php echo $css_celula; ?> sc-form-page sc-tab-click" data-tab-name="form_proyectos_form0">
     Datos Proyecto
   </li>
<?php
    $css_celula = $this->tabCssClass["form_proyectos_form1"]['class'];
?>
   <li id="id_form_proyectos_form1" class="<?php echo $css_celula; ?> sc-form-page sc-tab-click" data-tab-name="form_proyectos_form1">
     Usuarios Asociados
   </li>
<?php
    $css_celula = $this->tabCssClass["form_proyectos_form2"]['class'];
?>
   <li id="id_form_proyectos_form2" class="<?php echo $css_celula; ?> sc-form-page sc-tab-click" data-tab-name="form_proyectos_form2">
     Itemización Producción
   </li>
</ul>
<div style='clear:both'></div>
</td></tr> 
<tr><td style="padding: 0px">
<div id="form_proyectos_form0" style='display: none; width: 1px; height: 0px; overflow: scroll'>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nombre_proyecto']))
    {
        $this->nm_new_label['nombre_proyecto'] = "Nombre Proyecto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nombre_proyecto = $this->nombre_proyecto;
   $sStyleHidden_nombre_proyecto = '';
   if (isset($this->nmgp_cmp_hidden['nombre_proyecto']) && $this->nmgp_cmp_hidden['nombre_proyecto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nombre_proyecto']);
       $sStyleHidden_nombre_proyecto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nombre_proyecto = 'display: none;';
   $sStyleReadInp_nombre_proyecto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nombre_proyecto']) && $this->nmgp_cmp_readonly['nombre_proyecto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nombre_proyecto']);
       $sStyleReadLab_nombre_proyecto = '';
       $sStyleReadInp_nombre_proyecto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nombre_proyecto']) && $this->nmgp_cmp_hidden['nombre_proyecto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nombre_proyecto" value="<?php echo $this->form_encode_input($nombre_proyecto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_nombre_proyecto_label" id="hidden_field_label_nombre_proyecto" style="<?php echo $sStyleHidden_nombre_proyecto; ?>"><span id="id_label_nombre_proyecto"><?php echo $this->nm_new_label['nombre_proyecto']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['nombre_proyecto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['nombre_proyecto'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_nombre_proyecto_line" id="hidden_field_data_nombre_proyecto" style="<?php echo $sStyleHidden_nombre_proyecto; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nombre_proyecto_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nombre_proyecto"]) &&  $this->nmgp_cmp_readonly["nombre_proyecto"] == "on") { 

 ?>
<input type="hidden" name="nombre_proyecto" value="<?php echo $this->form_encode_input($nombre_proyecto) . "\">" . $nombre_proyecto . ""; ?>
<?php } else { ?>
<span id="id_read_on_nombre_proyecto" class="sc-ui-readonly-nombre_proyecto css_nombre_proyecto_line" style="<?php echo $sStyleReadLab_nombre_proyecto; ?>"><?php echo $this->form_format_readonly("nombre_proyecto", $this->form_encode_input($this->nombre_proyecto)); ?></span><span id="id_read_off_nombre_proyecto" class="css_read_off_nombre_proyecto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nombre_proyecto; ?>">
 <input class="sc-js-input scFormObjectOdd css_nombre_proyecto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nombre_proyecto" type=text name="nombre_proyecto" value="<?php echo $this->form_encode_input($nombre_proyecto) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nombre_proyecto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nombre_proyecto_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['codigo']))
    {
        $this->nm_new_label['codigo'] = "Codigo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $codigo = $this->codigo;
   $sStyleHidden_codigo = '';
   if (isset($this->nmgp_cmp_hidden['codigo']) && $this->nmgp_cmp_hidden['codigo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['codigo']);
       $sStyleHidden_codigo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_codigo = 'display: none;';
   $sStyleReadInp_codigo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['codigo']) && $this->nmgp_cmp_readonly['codigo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['codigo']);
       $sStyleReadLab_codigo = '';
       $sStyleReadInp_codigo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['codigo']) && $this->nmgp_cmp_hidden['codigo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="codigo" value="<?php echo $this->form_encode_input($codigo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_codigo_label" id="hidden_field_label_codigo" style="<?php echo $sStyleHidden_codigo; ?>"><span id="id_label_codigo"><?php echo $this->nm_new_label['codigo']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['codigo']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['codigo'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_codigo_line" id="hidden_field_data_codigo" style="<?php echo $sStyleHidden_codigo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_codigo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["codigo"]) &&  $this->nmgp_cmp_readonly["codigo"] == "on") { 

 ?>
<input type="hidden" name="codigo" value="<?php echo $this->form_encode_input($codigo) . "\">" . $codigo . ""; ?>
<?php } else { ?>
<span id="id_read_on_codigo" class="sc-ui-readonly-codigo css_codigo_line" style="<?php echo $sStyleReadLab_codigo; ?>"><?php echo $this->form_format_readonly("codigo", $this->form_encode_input($this->codigo)); ?></span><span id="id_read_off_codigo" class="css_read_off_codigo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_codigo; ?>">
 <input class="sc-js-input scFormObjectOdd css_codigo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_codigo" type=text name="codigo" value="<?php echo $this->form_encode_input($codigo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codigo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codigo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['descripcion']))
    {
        $this->nm_new_label['descripcion'] = "Descripción";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $descripcion = $this->descripcion;
   $sStyleHidden_descripcion = '';
   if (isset($this->nmgp_cmp_hidden['descripcion']) && $this->nmgp_cmp_hidden['descripcion'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['descripcion']);
       $sStyleHidden_descripcion = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_descripcion = 'display: none;';
   $sStyleReadInp_descripcion = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['descripcion']) && $this->nmgp_cmp_readonly['descripcion'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['descripcion']);
       $sStyleReadLab_descripcion = '';
       $sStyleReadInp_descripcion = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['descripcion']) && $this->nmgp_cmp_hidden['descripcion'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="descripcion" value="<?php echo $this->form_encode_input($descripcion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_descripcion_label" id="hidden_field_label_descripcion" style="<?php echo $sStyleHidden_descripcion; ?>"><span id="id_label_descripcion"><?php echo $this->nm_new_label['descripcion']; ?></span></TD>
    <TD class="scFormDataOdd css_descripcion_line" id="hidden_field_data_descripcion" style="<?php echo $sStyleHidden_descripcion; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_descripcion_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["descripcion"]) &&  $this->nmgp_cmp_readonly["descripcion"] == "on") { 

 ?>
<input type="hidden" name="descripcion" value="<?php echo $this->form_encode_input($descripcion) . "\">" . $descripcion . ""; ?>
<?php } else { ?>
<span id="id_read_on_descripcion" class="sc-ui-readonly-descripcion css_descripcion_line" style="<?php echo $sStyleReadLab_descripcion; ?>"><?php echo $this->form_format_readonly("descripcion", $this->form_encode_input($this->descripcion)); ?></span><span id="id_read_off_descripcion" class="css_read_off_descripcion<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_descripcion; ?>">
 <input class="sc-js-input scFormObjectOdd css_descripcion_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_descripcion" type=text name="descripcion" value="<?php echo $this->form_encode_input($descripcion) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descripcion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descripcion_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_empresa']))
   {
       $this->nm_new_label['id_empresa'] = "Empresa";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_empresa = $this->id_empresa;
   $sStyleHidden_id_empresa = '';
   if (isset($this->nmgp_cmp_hidden['id_empresa']) && $this->nmgp_cmp_hidden['id_empresa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_empresa']);
       $sStyleHidden_id_empresa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_empresa = 'display: none;';
   $sStyleReadInp_id_empresa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_empresa']) && $this->nmgp_cmp_readonly['id_empresa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_empresa']);
       $sStyleReadLab_id_empresa = '';
       $sStyleReadInp_id_empresa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_empresa']) && $this->nmgp_cmp_hidden['id_empresa'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_empresa" value="<?php echo $this->form_encode_input($this->id_empresa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_empresa_label" id="hidden_field_label_id_empresa" style="<?php echo $sStyleHidden_id_empresa; ?>"><span id="id_label_id_empresa"><?php echo $this->nm_new_label['id_empresa']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_empresa']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_empresa'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_empresa_line" id="hidden_field_data_id_empresa" style="<?php echo $sStyleHidden_id_empresa; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_empresa_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_empresa"]) &&  $this->nmgp_cmp_readonly["id_empresa"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa'] = array(); 
    }

   $old_value_fecha_inicio = $this->fecha_inicio;
   $old_value_fecha_termino = $this->fecha_termino;
   $old_value_duracion = $this->duracion;
   $old_value_presupuesto = $this->presupuesto;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_fecha_inicio = $this->fecha_inicio;
   $unformatted_value_fecha_termino = $this->fecha_termino;
   $unformatted_value_duracion = $this->duracion;
   $unformatted_value_presupuesto = $this->presupuesto;

   $nm_comando = "SELECT id, razon_social  FROM companias  ORDER BY razon_social";

   $this->fecha_inicio = $old_value_fecha_inicio;
   $this->fecha_termino = $old_value_fecha_termino;
   $this->duracion = $old_value_duracion;
   $this->presupuesto = $old_value_presupuesto;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa'][] = $rs->fields[0];
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
   $id_empresa_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_empresa_1))
          {
              foreach ($this->id_empresa_1 as $tmp_id_empresa)
              {
                  if (trim($tmp_id_empresa) === trim($cadaselect[1])) { $id_empresa_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_empresa) === trim($cadaselect[1])) { $id_empresa_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_empresa" value="<?php echo $this->form_encode_input($id_empresa) . "\">" . $id_empresa_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_empresa();
   $x = 0 ; 
   $id_empresa_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_empresa_1))
          {
              foreach ($this->id_empresa_1 as $tmp_id_empresa)
              {
                  if (trim($tmp_id_empresa) === trim($cadaselect[1])) { $id_empresa_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_empresa) === trim($cadaselect[1])) { $id_empresa_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_empresa_look))
          {
              $id_empresa_look = $this->id_empresa;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_empresa\" class=\"css_id_empresa_line\" style=\"" .  $sStyleReadLab_id_empresa . "\">" . $this->form_format_readonly("id_empresa", $this->form_encode_input($id_empresa_look)) . "</span><span id=\"id_read_off_id_empresa\" class=\"css_read_off_id_empresa" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_empresa . "\">";
   echo " <span id=\"idAjaxSelect_id_empresa\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_empresa_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_empresa\" name=\"id_empresa\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_empresa'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_empresa) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_empresa)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_empresa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_empresa_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_cliente']))
   {
       $this->nm_new_label['id_cliente'] = "Cliente";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_cliente = $this->id_cliente;
   $sStyleHidden_id_cliente = '';
   if (isset($this->nmgp_cmp_hidden['id_cliente']) && $this->nmgp_cmp_hidden['id_cliente'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_cliente']);
       $sStyleHidden_id_cliente = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_cliente = 'display: none;';
   $sStyleReadInp_id_cliente = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_cliente']) && $this->nmgp_cmp_readonly['id_cliente'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_cliente']);
       $sStyleReadLab_id_cliente = '';
       $sStyleReadInp_id_cliente = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_cliente']) && $this->nmgp_cmp_hidden['id_cliente'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_cliente" value="<?php echo $this->form_encode_input($this->id_cliente) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_cliente_label" id="hidden_field_label_id_cliente" style="<?php echo $sStyleHidden_id_cliente; ?>"><span id="id_label_id_cliente"><?php echo $this->nm_new_label['id_cliente']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_cliente']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_cliente'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_cliente_line" id="hidden_field_data_id_cliente" style="<?php echo $sStyleHidden_id_cliente; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_cliente_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_cliente"]) &&  $this->nmgp_cmp_readonly["id_cliente"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente'] = array(); 
    }

   $old_value_fecha_inicio = $this->fecha_inicio;
   $old_value_fecha_termino = $this->fecha_termino;
   $old_value_duracion = $this->duracion;
   $old_value_presupuesto = $this->presupuesto;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_fecha_inicio = $this->fecha_inicio;
   $unformatted_value_fecha_termino = $this->fecha_termino;
   $unformatted_value_duracion = $this->duracion;
   $unformatted_value_presupuesto = $this->presupuesto;

   $nm_comando = "SELECT id, upper(nombre)  FROM prod_clientes  ORDER BY nombre";

   $this->fecha_inicio = $old_value_fecha_inicio;
   $this->fecha_termino = $old_value_fecha_termino;
   $this->duracion = $old_value_duracion;
   $this->presupuesto = $old_value_presupuesto;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente'][] = $rs->fields[0];
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
   $id_cliente_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_cliente_1))
          {
              foreach ($this->id_cliente_1 as $tmp_id_cliente)
              {
                  if (trim($tmp_id_cliente) === trim($cadaselect[1])) { $id_cliente_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_cliente) === trim($cadaselect[1])) { $id_cliente_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_cliente" value="<?php echo $this->form_encode_input($id_cliente) . "\">" . $id_cliente_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_cliente();
   $x = 0 ; 
   $id_cliente_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_cliente_1))
          {
              foreach ($this->id_cliente_1 as $tmp_id_cliente)
              {
                  if (trim($tmp_id_cliente) === trim($cadaselect[1])) { $id_cliente_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_cliente) === trim($cadaselect[1])) { $id_cliente_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_cliente_look))
          {
              $id_cliente_look = $this->id_cliente;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_cliente\" class=\"css_id_cliente_line\" style=\"" .  $sStyleReadLab_id_cliente . "\">" . $this->form_format_readonly("id_cliente", $this->form_encode_input($id_cliente_look)) . "</span><span id=\"id_read_off_id_cliente\" class=\"css_read_off_id_cliente" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_cliente . "\">";
   echo " <span id=\"idAjaxSelect_id_cliente\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_cliente_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_cliente\" name=\"id_cliente\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_cliente'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_cliente) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_cliente)) 
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
   if (isset($this->Ini->sc_lig_md5["form_prod_clientes_proyectos"]) && $this->Ini->sc_lig_md5["form_prod_clientes_proyectos"] == "S") {
       $Parms_Lig  = "SC_glo_par_id_cl*scinid_cl*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnm_evt_ret_edit*scindo_ajax_form_proyectos_lkpedt_refresh_id_cliente*scoutnmgp_url_saida*scinmodal*scoutnmgp_outra_jan*scintrue*scoutsc_redir_atualiz*scinok*scout";
       $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_proyectos@SC_par@" . md5($Parms_Lig);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
   } else {
       $Md5_Lig  = "SC_glo_par_id_cl*scinid_cl*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnm_evt_ret_edit*scindo_ajax_form_proyectos_lkpedt_refresh_id_cliente*scoutnmgp_url_saida*scinmodal*scoutnmgp_outra_jan*scintrue*scoutsc_redir_atualiz*scinok*scout";
   }
 ?><?php echo nmButtonOutput($this->arr_buttons, "bform_lookuplink", "", "", "fldedt_id_cliente", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->link_form_prod_clientes_proyectos_edit . "?script_case_init=" . $this->Ini->sc_page . "&nmgp_parms=" . $Md5_Lig . "&SC_lig_apl_orig=form_proyectos&KeepThis=true&TB_iframe=true&height=440&width=630&modal=true", "");?>
<?php    echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_cliente_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_cliente_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fecha_inicio']))
    {
        $this->nm_new_label['fecha_inicio'] = "Fecha Inicio";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fecha_inicio = $this->fecha_inicio;
   $sStyleHidden_fecha_inicio = '';
   if (isset($this->nmgp_cmp_hidden['fecha_inicio']) && $this->nmgp_cmp_hidden['fecha_inicio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fecha_inicio']);
       $sStyleHidden_fecha_inicio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fecha_inicio = 'display: none;';
   $sStyleReadInp_fecha_inicio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fecha_inicio']) && $this->nmgp_cmp_readonly['fecha_inicio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fecha_inicio']);
       $sStyleReadLab_fecha_inicio = '';
       $sStyleReadInp_fecha_inicio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fecha_inicio']) && $this->nmgp_cmp_hidden['fecha_inicio'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fecha_inicio" value="<?php echo $this->form_encode_input($fecha_inicio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_fecha_inicio_label" id="hidden_field_label_fecha_inicio" style="<?php echo $sStyleHidden_fecha_inicio; ?>"><span id="id_label_fecha_inicio"><?php echo $this->nm_new_label['fecha_inicio']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['fecha_inicio']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['fecha_inicio'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_fecha_inicio_line" id="hidden_field_data_fecha_inicio" style="<?php echo $sStyleHidden_fecha_inicio; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fecha_inicio_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fecha_inicio"]) &&  $this->nmgp_cmp_readonly["fecha_inicio"] == "on") { 

 ?>
<input type="hidden" name="fecha_inicio" value="<?php echo $this->form_encode_input($fecha_inicio) . "\">" . $fecha_inicio . ""; ?>
<?php } else { ?>
<span id="id_read_on_fecha_inicio" class="sc-ui-readonly-fecha_inicio css_fecha_inicio_line" style="<?php echo $sStyleReadLab_fecha_inicio; ?>"><?php echo $this->form_format_readonly("fecha_inicio", $this->form_encode_input($fecha_inicio)); ?></span><span id="id_read_off_fecha_inicio" class="css_read_off_fecha_inicio<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fecha_inicio; ?>"><?php
$tmp_form_data = $this->field_config['fecha_inicio']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_fecha_inicio_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fecha_inicio" type=text name="fecha_inicio" value="<?php echo $this->form_encode_input($fecha_inicio) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['fecha_inicio']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['fecha_inicio']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fecha_inicio_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fecha_inicio_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fecha_termino']))
    {
        $this->nm_new_label['fecha_termino'] = "Fecha Término";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fecha_termino = $this->fecha_termino;
   $sStyleHidden_fecha_termino = '';
   if (isset($this->nmgp_cmp_hidden['fecha_termino']) && $this->nmgp_cmp_hidden['fecha_termino'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fecha_termino']);
       $sStyleHidden_fecha_termino = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fecha_termino = 'display: none;';
   $sStyleReadInp_fecha_termino = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fecha_termino']) && $this->nmgp_cmp_readonly['fecha_termino'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fecha_termino']);
       $sStyleReadLab_fecha_termino = '';
       $sStyleReadInp_fecha_termino = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fecha_termino']) && $this->nmgp_cmp_hidden['fecha_termino'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fecha_termino" value="<?php echo $this->form_encode_input($fecha_termino) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_fecha_termino_label" id="hidden_field_label_fecha_termino" style="<?php echo $sStyleHidden_fecha_termino; ?>"><span id="id_label_fecha_termino"><?php echo $this->nm_new_label['fecha_termino']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['fecha_termino']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['fecha_termino'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_fecha_termino_line" id="hidden_field_data_fecha_termino" style="<?php echo $sStyleHidden_fecha_termino; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fecha_termino_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fecha_termino"]) &&  $this->nmgp_cmp_readonly["fecha_termino"] == "on") { 

 ?>
<input type="hidden" name="fecha_termino" value="<?php echo $this->form_encode_input($fecha_termino) . "\">" . $fecha_termino . ""; ?>
<?php } else { ?>
<span id="id_read_on_fecha_termino" class="sc-ui-readonly-fecha_termino css_fecha_termino_line" style="<?php echo $sStyleReadLab_fecha_termino; ?>"><?php echo $this->form_format_readonly("fecha_termino", $this->form_encode_input($fecha_termino)); ?></span><span id="id_read_off_fecha_termino" class="css_read_off_fecha_termino<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fecha_termino; ?>"><?php
$tmp_form_data = $this->field_config['fecha_termino']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_fecha_termino_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fecha_termino" type=text name="fecha_termino" value="<?php echo $this->form_encode_input($fecha_termino) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['fecha_termino']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['fecha_termino']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fecha_termino_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fecha_termino_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['duracion']))
    {
        $this->nm_new_label['duracion'] = "Duración (Meses)";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $duracion = $this->duracion;
   $sStyleHidden_duracion = '';
   if (isset($this->nmgp_cmp_hidden['duracion']) && $this->nmgp_cmp_hidden['duracion'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['duracion']);
       $sStyleHidden_duracion = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_duracion = 'display: none;';
   $sStyleReadInp_duracion = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['duracion']) && $this->nmgp_cmp_readonly['duracion'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['duracion']);
       $sStyleReadLab_duracion = '';
       $sStyleReadInp_duracion = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['duracion']) && $this->nmgp_cmp_hidden['duracion'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="duracion" value="<?php echo $this->form_encode_input($duracion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_duracion_label" id="hidden_field_label_duracion" style="<?php echo $sStyleHidden_duracion; ?>"><span id="id_label_duracion"><?php echo $this->nm_new_label['duracion']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['duracion']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['duracion'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_duracion_line" id="hidden_field_data_duracion" style="<?php echo $sStyleHidden_duracion; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_duracion_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["duracion"]) &&  $this->nmgp_cmp_readonly["duracion"] == "on") { 

 ?>
<input type="hidden" name="duracion" value="<?php echo $this->form_encode_input($duracion) . "\">" . $duracion . ""; ?>
<?php } else { ?>
<span id="id_read_on_duracion" class="sc-ui-readonly-duracion css_duracion_line" style="<?php echo $sStyleReadLab_duracion; ?>"><?php echo $this->form_format_readonly("duracion", $this->form_encode_input($this->duracion)); ?></span><span id="id_read_off_duracion" class="css_read_off_duracion<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_duracion; ?>">
 <input class="sc-js-input scFormObjectOdd css_duracion_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_duracion" type=text name="duracion" value="<?php echo $this->form_encode_input($duracion) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['duracion']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['duracion']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['duracion']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_duracion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_duracion_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tipo_moneda']))
   {
       $this->nm_new_label['tipo_moneda'] = "Tipo Moneda";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tipo_moneda = $this->tipo_moneda;
   $sStyleHidden_tipo_moneda = '';
   if (isset($this->nmgp_cmp_hidden['tipo_moneda']) && $this->nmgp_cmp_hidden['tipo_moneda'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tipo_moneda']);
       $sStyleHidden_tipo_moneda = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tipo_moneda = 'display: none;';
   $sStyleReadInp_tipo_moneda = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tipo_moneda']) && $this->nmgp_cmp_readonly['tipo_moneda'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tipo_moneda']);
       $sStyleReadLab_tipo_moneda = '';
       $sStyleReadInp_tipo_moneda = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tipo_moneda']) && $this->nmgp_cmp_hidden['tipo_moneda'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tipo_moneda" value="<?php echo $this->form_encode_input($this->tipo_moneda) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tipo_moneda_label" id="hidden_field_label_tipo_moneda" style="<?php echo $sStyleHidden_tipo_moneda; ?>"><span id="id_label_tipo_moneda"><?php echo $this->nm_new_label['tipo_moneda']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['tipo_moneda']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['tipo_moneda'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_tipo_moneda_line" id="hidden_field_data_tipo_moneda" style="<?php echo $sStyleHidden_tipo_moneda; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tipo_moneda_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tipo_moneda"]) &&  $this->nmgp_cmp_readonly["tipo_moneda"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda'] = array(); 
    }

   $old_value_fecha_inicio = $this->fecha_inicio;
   $old_value_fecha_termino = $this->fecha_termino;
   $old_value_duracion = $this->duracion;
   $old_value_presupuesto = $this->presupuesto;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_fecha_inicio = $this->fecha_inicio;
   $unformatted_value_fecha_termino = $this->fecha_termino;
   $unformatted_value_duracion = $this->duracion;
   $unformatted_value_presupuesto = $this->presupuesto;

   $nm_comando = "SELECT id, tipo_moneda  FROM prod_monedas  ORDER BY tipo_moneda";

   $this->fecha_inicio = $old_value_fecha_inicio;
   $this->fecha_termino = $old_value_fecha_termino;
   $this->duracion = $old_value_duracion;
   $this->presupuesto = $old_value_presupuesto;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda'][] = $rs->fields[0];
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
   $tipo_moneda_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tipo_moneda_1))
          {
              foreach ($this->tipo_moneda_1 as $tmp_tipo_moneda)
              {
                  if (trim($tmp_tipo_moneda) === trim($cadaselect[1])) { $tipo_moneda_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tipo_moneda) === trim($cadaselect[1])) { $tipo_moneda_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tipo_moneda" value="<?php echo $this->form_encode_input($tipo_moneda) . "\">" . $tipo_moneda_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tipo_moneda();
   $x = 0 ; 
   $tipo_moneda_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tipo_moneda_1))
          {
              foreach ($this->tipo_moneda_1 as $tmp_tipo_moneda)
              {
                  if (trim($tmp_tipo_moneda) === trim($cadaselect[1])) { $tipo_moneda_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tipo_moneda) === trim($cadaselect[1])) { $tipo_moneda_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tipo_moneda_look))
          {
              $tipo_moneda_look = $this->tipo_moneda;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tipo_moneda\" class=\"css_tipo_moneda_line\" style=\"" .  $sStyleReadLab_tipo_moneda . "\">" . $this->form_format_readonly("tipo_moneda", $this->form_encode_input($tipo_moneda_look)) . "</span><span id=\"id_read_off_tipo_moneda\" class=\"css_read_off_tipo_moneda" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_tipo_moneda . "\">";
   echo " <span id=\"idAjaxSelect_tipo_moneda\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_tipo_moneda_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_tipo_moneda\" name=\"tipo_moneda\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_tipo_moneda'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tipo_moneda) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tipo_moneda)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_moneda_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_moneda_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['presupuesto']))
    {
        $this->nm_new_label['presupuesto'] = "Presupuesto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $presupuesto = $this->presupuesto;
   $sStyleHidden_presupuesto = '';
   if (isset($this->nmgp_cmp_hidden['presupuesto']) && $this->nmgp_cmp_hidden['presupuesto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['presupuesto']);
       $sStyleHidden_presupuesto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_presupuesto = 'display: none;';
   $sStyleReadInp_presupuesto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['presupuesto']) && $this->nmgp_cmp_readonly['presupuesto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['presupuesto']);
       $sStyleReadLab_presupuesto = '';
       $sStyleReadInp_presupuesto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['presupuesto']) && $this->nmgp_cmp_hidden['presupuesto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="presupuesto" value="<?php echo $this->form_encode_input($presupuesto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_presupuesto_label" id="hidden_field_label_presupuesto" style="<?php echo $sStyleHidden_presupuesto; ?>"><span id="id_label_presupuesto"><?php echo $this->nm_new_label['presupuesto']; ?></span></TD>
    <TD class="scFormDataOdd css_presupuesto_line" id="hidden_field_data_presupuesto" style="<?php echo $sStyleHidden_presupuesto; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_presupuesto_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["presupuesto"]) &&  $this->nmgp_cmp_readonly["presupuesto"] == "on") { 

 ?>
<input type="hidden" name="presupuesto" value="<?php echo $this->form_encode_input($presupuesto) . "\">" . $presupuesto . ""; ?>
<?php } else { ?>
<span id="id_read_on_presupuesto" class="sc-ui-readonly-presupuesto css_presupuesto_line" style="<?php echo $sStyleReadLab_presupuesto; ?>"><?php echo $this->form_format_readonly("presupuesto", $this->form_encode_input($this->presupuesto)); ?></span><span id="id_read_off_presupuesto" class="css_read_off_presupuesto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_presupuesto; ?>">
 <input class="sc-js-input scFormObjectOdd css_presupuesto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_presupuesto" type=text name="presupuesto" value="<?php echo $this->form_encode_input($presupuesto) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['presupuesto']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['presupuesto']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['presupuesto']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_presupuesto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_presupuesto_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_estado']))
   {
       $this->nm_new_label['id_estado'] = "Estado";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_estado = $this->id_estado;
   $sStyleHidden_id_estado = '';
   if (isset($this->nmgp_cmp_hidden['id_estado']) && $this->nmgp_cmp_hidden['id_estado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_estado']);
       $sStyleHidden_id_estado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_estado = 'display: none;';
   $sStyleReadInp_id_estado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_estado']) && $this->nmgp_cmp_readonly['id_estado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_estado']);
       $sStyleReadLab_id_estado = '';
       $sStyleReadInp_id_estado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_estado']) && $this->nmgp_cmp_hidden['id_estado'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_estado" value="<?php echo $this->form_encode_input($this->id_estado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_estado_label" id="hidden_field_label_id_estado" style="<?php echo $sStyleHidden_id_estado; ?>"><span id="id_label_id_estado"><?php echo $this->nm_new_label['id_estado']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_estado']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_estado'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_estado_line" id="hidden_field_data_id_estado" style="<?php echo $sStyleHidden_id_estado; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_estado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_estado"]) &&  $this->nmgp_cmp_readonly["id_estado"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado'] = array(); 
    }

   $old_value_fecha_inicio = $this->fecha_inicio;
   $old_value_fecha_termino = $this->fecha_termino;
   $old_value_duracion = $this->duracion;
   $old_value_presupuesto = $this->presupuesto;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_fecha_inicio = $this->fecha_inicio;
   $unformatted_value_fecha_termino = $this->fecha_termino;
   $unformatted_value_duracion = $this->duracion;
   $unformatted_value_presupuesto = $this->presupuesto;

   $nm_comando = "SELECT id, nombre_estado  FROM estados_proyectos  ORDER BY nombre_estado";

   $this->fecha_inicio = $old_value_fecha_inicio;
   $this->fecha_termino = $old_value_fecha_termino;
   $this->duracion = $old_value_duracion;
   $this->presupuesto = $old_value_presupuesto;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado'][] = $rs->fields[0];
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
   $id_estado_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_estado_1))
          {
              foreach ($this->id_estado_1 as $tmp_id_estado)
              {
                  if (trim($tmp_id_estado) === trim($cadaselect[1])) { $id_estado_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_estado) === trim($cadaselect[1])) { $id_estado_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_estado" value="<?php echo $this->form_encode_input($id_estado) . "\">" . $id_estado_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_estado();
   $x = 0 ; 
   $id_estado_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_estado_1))
          {
              foreach ($this->id_estado_1 as $tmp_id_estado)
              {
                  if (trim($tmp_id_estado) === trim($cadaselect[1])) { $id_estado_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_estado) === trim($cadaselect[1])) { $id_estado_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_estado_look))
          {
              $id_estado_look = $this->id_estado;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_estado\" class=\"css_id_estado_line\" style=\"" .  $sStyleReadLab_id_estado . "\">" . $this->form_format_readonly("id_estado", $this->form_encode_input($id_estado_look)) . "</span><span id=\"id_read_off_id_estado\" class=\"css_read_off_id_estado" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_estado . "\">";
   echo " <span id=\"idAjaxSelect_id_estado\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_estado_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_estado\" name=\"id_estado\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_estado'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_estado) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_estado)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_estado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_estado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_portafolio']))
   {
       $this->nm_new_label['id_portafolio'] = "Portafolio (Centro Negocio)";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_portafolio = $this->id_portafolio;
   $sStyleHidden_id_portafolio = '';
   if (isset($this->nmgp_cmp_hidden['id_portafolio']) && $this->nmgp_cmp_hidden['id_portafolio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_portafolio']);
       $sStyleHidden_id_portafolio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_portafolio = 'display: none;';
   $sStyleReadInp_id_portafolio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_portafolio']) && $this->nmgp_cmp_readonly['id_portafolio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_portafolio']);
       $sStyleReadLab_id_portafolio = '';
       $sStyleReadInp_id_portafolio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_portafolio']) && $this->nmgp_cmp_hidden['id_portafolio'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_portafolio" value="<?php echo $this->form_encode_input($this->id_portafolio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_portafolio_label" id="hidden_field_label_id_portafolio" style="<?php echo $sStyleHidden_id_portafolio; ?>"><span id="id_label_id_portafolio"><?php echo $this->nm_new_label['id_portafolio']; ?></span></TD>
    <TD class="scFormDataOdd css_id_portafolio_line" id="hidden_field_data_id_portafolio" style="<?php echo $sStyleHidden_id_portafolio; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_portafolio_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_portafolio"]) &&  $this->nmgp_cmp_readonly["id_portafolio"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio'] = array(); 
    }

   $old_value_fecha_inicio = $this->fecha_inicio;
   $old_value_fecha_termino = $this->fecha_termino;
   $old_value_duracion = $this->duracion;
   $old_value_presupuesto = $this->presupuesto;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_fecha_inicio = $this->fecha_inicio;
   $unformatted_value_fecha_termino = $this->fecha_termino;
   $unformatted_value_duracion = $this->duracion;
   $unformatted_value_presupuesto = $this->presupuesto;

   $nm_comando = "SELECT id, nombre_portafolio  FROM portafolio  ORDER BY nombre_portafolio";

   $this->fecha_inicio = $old_value_fecha_inicio;
   $this->fecha_termino = $old_value_fecha_termino;
   $this->duracion = $old_value_duracion;
   $this->presupuesto = $old_value_presupuesto;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio'][] = $rs->fields[0];
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
   $id_portafolio_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_portafolio_1))
          {
              foreach ($this->id_portafolio_1 as $tmp_id_portafolio)
              {
                  if (trim($tmp_id_portafolio) === trim($cadaselect[1])) { $id_portafolio_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_portafolio) === trim($cadaselect[1])) { $id_portafolio_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_portafolio" value="<?php echo $this->form_encode_input($id_portafolio) . "\">" . $id_portafolio_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_portafolio();
   $x = 0 ; 
   $id_portafolio_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_portafolio_1))
          {
              foreach ($this->id_portafolio_1 as $tmp_id_portafolio)
              {
                  if (trim($tmp_id_portafolio) === trim($cadaselect[1])) { $id_portafolio_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_portafolio) === trim($cadaselect[1])) { $id_portafolio_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_portafolio_look))
          {
              $id_portafolio_look = $this->id_portafolio;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_portafolio\" class=\"css_id_portafolio_line\" style=\"" .  $sStyleReadLab_id_portafolio . "\">" . $this->form_format_readonly("id_portafolio", $this->form_encode_input($id_portafolio_look)) . "</span><span id=\"id_read_off_id_portafolio\" class=\"css_read_off_id_portafolio" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_portafolio . "\">";
   echo " <span id=\"idAjaxSelect_id_portafolio\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_portafolio_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_portafolio\" name=\"id_portafolio\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_portafolio'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_portafolio) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_portafolio)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_portafolio_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_portafolio_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_fase']))
   {
       $this->nm_new_label['id_fase'] = "Fase";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_fase = $this->id_fase;
   $sStyleHidden_id_fase = '';
   if (isset($this->nmgp_cmp_hidden['id_fase']) && $this->nmgp_cmp_hidden['id_fase'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_fase']);
       $sStyleHidden_id_fase = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_fase = 'display: none;';
   $sStyleReadInp_id_fase = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_fase']) && $this->nmgp_cmp_readonly['id_fase'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_fase']);
       $sStyleReadLab_id_fase = '';
       $sStyleReadInp_id_fase = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_fase']) && $this->nmgp_cmp_hidden['id_fase'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_fase" value="<?php echo $this->form_encode_input($this->id_fase) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_fase_label" id="hidden_field_label_id_fase" style="<?php echo $sStyleHidden_id_fase; ?>"><span id="id_label_id_fase"><?php echo $this->nm_new_label['id_fase']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_fase']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_fase'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_fase_line" id="hidden_field_data_id_fase" style="<?php echo $sStyleHidden_id_fase; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_fase_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_fase"]) &&  $this->nmgp_cmp_readonly["id_fase"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase'] = array(); 
    }

   $old_value_fecha_inicio = $this->fecha_inicio;
   $old_value_fecha_termino = $this->fecha_termino;
   $old_value_duracion = $this->duracion;
   $old_value_presupuesto = $this->presupuesto;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_fecha_inicio = $this->fecha_inicio;
   $unformatted_value_fecha_termino = $this->fecha_termino;
   $unformatted_value_duracion = $this->duracion;
   $unformatted_value_presupuesto = $this->presupuesto;

   $nm_comando = "SELECT id, nombre_fase  FROM fases_proyectos  ORDER BY nombre_fase";

   $this->fecha_inicio = $old_value_fecha_inicio;
   $this->fecha_termino = $old_value_fecha_termino;
   $this->duracion = $old_value_duracion;
   $this->presupuesto = $old_value_presupuesto;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase'][] = $rs->fields[0];
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
   $id_fase_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_fase_1))
          {
              foreach ($this->id_fase_1 as $tmp_id_fase)
              {
                  if (trim($tmp_id_fase) === trim($cadaselect[1])) { $id_fase_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_fase) === trim($cadaselect[1])) { $id_fase_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_fase" value="<?php echo $this->form_encode_input($id_fase) . "\">" . $id_fase_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_fase();
   $x = 0 ; 
   $id_fase_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_fase_1))
          {
              foreach ($this->id_fase_1 as $tmp_id_fase)
              {
                  if (trim($tmp_id_fase) === trim($cadaselect[1])) { $id_fase_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_fase) === trim($cadaselect[1])) { $id_fase_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_fase_look))
          {
              $id_fase_look = $this->id_fase;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_fase\" class=\"css_id_fase_line\" style=\"" .  $sStyleReadLab_id_fase . "\">" . $this->form_format_readonly("id_fase", $this->form_encode_input($id_fase_look)) . "</span><span id=\"id_read_off_id_fase\" class=\"css_read_off_id_fase" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_fase . "\">";
   echo " <span id=\"idAjaxSelect_id_fase\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_fase_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_fase\" name=\"id_fase\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_fase'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_fase) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_fase)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_fase_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_fase_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['habilitado']))
   {
       $this->nm_new_label['habilitado'] = "Habilitado";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $habilitado = $this->habilitado;
   $sStyleHidden_habilitado = '';
   if (isset($this->nmgp_cmp_hidden['habilitado']) && $this->nmgp_cmp_hidden['habilitado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['habilitado']);
       $sStyleHidden_habilitado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_habilitado = 'display: none;';
   $sStyleReadInp_habilitado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['habilitado']) && $this->nmgp_cmp_readonly['habilitado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['habilitado']);
       $sStyleReadLab_habilitado = '';
       $sStyleReadInp_habilitado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['habilitado']) && $this->nmgp_cmp_hidden['habilitado'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="habilitado" value="<?php echo $this->form_encode_input($this->habilitado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_habilitado_label" id="hidden_field_label_habilitado" style="<?php echo $sStyleHidden_habilitado; ?>"><span id="id_label_habilitado"><?php echo $this->nm_new_label['habilitado']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['habilitado']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['habilitado'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_habilitado_line" id="hidden_field_data_habilitado" style="<?php echo $sStyleHidden_habilitado; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_habilitado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["habilitado"]) &&  $this->nmgp_cmp_readonly["habilitado"] == "on") { 

$habilitado_look = "";
 if ($this->habilitado == "1") { $habilitado_look .= "SI" ;} 
 if ($this->habilitado == "0") { $habilitado_look .= "NO" ;} 
 if (empty($habilitado_look)) { $habilitado_look = $this->habilitado; }
?>
<input type="hidden" name="habilitado" value="<?php echo $this->form_encode_input($habilitado) . "\">" . $habilitado_look . ""; ?>
<?php } else { ?>
<?php

$habilitado_look = "";
 if ($this->habilitado == "1") { $habilitado_look .= "SI" ;} 
 if ($this->habilitado == "0") { $habilitado_look .= "NO" ;} 
 if (empty($habilitado_look)) { $habilitado_look = $this->habilitado; }
?>
<span id="id_read_on_habilitado" class="css_habilitado_line"  style="<?php echo $sStyleReadLab_habilitado; ?>"><?php echo $this->form_format_readonly("habilitado", $this->form_encode_input($habilitado_look)); ?></span><span id="id_read_off_habilitado" class="css_read_off_habilitado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_habilitado; ?>">
 <span id="idAjaxSelect_habilitado" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_habilitado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_habilitado" name="habilitado" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_habilitado'][] = ''; ?>
 <option value=""></option>
 <option  value="1" <?php  if ($this->habilitado == "1") { echo " selected" ;} ?>>SI</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_habilitado'][] = '1'; ?>
 <option  value="0" <?php  if ($this->habilitado == "0") { echo " selected" ;} ?>>NO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_habilitado'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_habilitado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_habilitado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_direccion']))
   {
       $this->nm_new_label['id_direccion'] = "Gerente De Proyecto";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_direccion = $this->id_direccion;
   $sStyleHidden_id_direccion = '';
   if (isset($this->nmgp_cmp_hidden['id_direccion']) && $this->nmgp_cmp_hidden['id_direccion'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_direccion']);
       $sStyleHidden_id_direccion = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_direccion = 'display: none;';
   $sStyleReadInp_id_direccion = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_direccion']) && $this->nmgp_cmp_readonly['id_direccion'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_direccion']);
       $sStyleReadLab_id_direccion = '';
       $sStyleReadInp_id_direccion = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_direccion']) && $this->nmgp_cmp_hidden['id_direccion'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_direccion" value="<?php echo $this->form_encode_input($this->id_direccion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_direccion_label" id="hidden_field_label_id_direccion" style="<?php echo $sStyleHidden_id_direccion; ?>"><span id="id_label_id_direccion"><?php echo $this->nm_new_label['id_direccion']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_direccion']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_direccion'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_direccion_line" id="hidden_field_data_id_direccion" style="<?php echo $sStyleHidden_id_direccion; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_direccion_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_direccion"]) &&  $this->nmgp_cmp_readonly["id_direccion"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion'] = array(); 
    }

   $old_value_fecha_inicio = $this->fecha_inicio;
   $old_value_fecha_termino = $this->fecha_termino;
   $old_value_duracion = $this->duracion;
   $old_value_presupuesto = $this->presupuesto;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_fecha_inicio = $this->fecha_inicio;
   $unformatted_value_fecha_termino = $this->fecha_termino;
   $unformatted_value_duracion = $this->duracion;
   $unformatted_value_presupuesto = $this->presupuesto;

   $nm_comando = "SELECT id, name  FROM sec_users where is_Active='Y'   ORDER BY name";

   $this->fecha_inicio = $old_value_fecha_inicio;
   $this->fecha_termino = $old_value_fecha_termino;
   $this->duracion = $old_value_duracion;
   $this->presupuesto = $old_value_presupuesto;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion'][] = $rs->fields[0];
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
   $id_direccion_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_direccion_1))
          {
              foreach ($this->id_direccion_1 as $tmp_id_direccion)
              {
                  if (trim($tmp_id_direccion) === trim($cadaselect[1])) { $id_direccion_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_direccion) === trim($cadaselect[1])) { $id_direccion_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_direccion" value="<?php echo $this->form_encode_input($id_direccion) . "\">" . $id_direccion_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_direccion();
   $x = 0 ; 
   $id_direccion_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_direccion_1))
          {
              foreach ($this->id_direccion_1 as $tmp_id_direccion)
              {
                  if (trim($tmp_id_direccion) === trim($cadaselect[1])) { $id_direccion_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_direccion) === trim($cadaselect[1])) { $id_direccion_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_direccion_look))
          {
              $id_direccion_look = $this->id_direccion;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_direccion\" class=\"css_id_direccion_line\" style=\"" .  $sStyleReadLab_id_direccion . "\">" . $this->form_format_readonly("id_direccion", $this->form_encode_input($id_direccion_look)) . "</span><span id=\"id_read_off_id_direccion\" class=\"css_read_off_id_direccion" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_direccion . "\">";
   echo " <span id=\"idAjaxSelect_id_direccion\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_direccion_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_direccion\" name=\"id_direccion\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_direccion'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_direccion) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_direccion)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_direccion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_direccion_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_jefe_proyecto']))
   {
       $this->nm_new_label['id_jefe_proyecto'] = "Jefe De Proyecto";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_jefe_proyecto = $this->id_jefe_proyecto;
   $sStyleHidden_id_jefe_proyecto = '';
   if (isset($this->nmgp_cmp_hidden['id_jefe_proyecto']) && $this->nmgp_cmp_hidden['id_jefe_proyecto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_jefe_proyecto']);
       $sStyleHidden_id_jefe_proyecto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_jefe_proyecto = 'display: none;';
   $sStyleReadInp_id_jefe_proyecto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_jefe_proyecto']) && $this->nmgp_cmp_readonly['id_jefe_proyecto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_jefe_proyecto']);
       $sStyleReadLab_id_jefe_proyecto = '';
       $sStyleReadInp_id_jefe_proyecto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_jefe_proyecto']) && $this->nmgp_cmp_hidden['id_jefe_proyecto'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_jefe_proyecto" value="<?php echo $this->form_encode_input($this->id_jefe_proyecto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_jefe_proyecto_label" id="hidden_field_label_id_jefe_proyecto" style="<?php echo $sStyleHidden_id_jefe_proyecto; ?>"><span id="id_label_id_jefe_proyecto"><?php echo $this->nm_new_label['id_jefe_proyecto']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_jefe_proyecto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['id_jefe_proyecto'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_jefe_proyecto_line" id="hidden_field_data_id_jefe_proyecto" style="<?php echo $sStyleHidden_id_jefe_proyecto; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_jefe_proyecto_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_jefe_proyecto"]) &&  $this->nmgp_cmp_readonly["id_jefe_proyecto"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto'] = array(); 
    }

   $old_value_fecha_inicio = $this->fecha_inicio;
   $old_value_fecha_termino = $this->fecha_termino;
   $old_value_duracion = $this->duracion;
   $old_value_presupuesto = $this->presupuesto;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_fecha_inicio = $this->fecha_inicio;
   $unformatted_value_fecha_termino = $this->fecha_termino;
   $unformatted_value_duracion = $this->duracion;
   $unformatted_value_presupuesto = $this->presupuesto;

   $nm_comando = "SELECT id, name  FROM sec_users  where is_Active='Y'   ORDER BY name";

   $this->fecha_inicio = $old_value_fecha_inicio;
   $this->fecha_termino = $old_value_fecha_termino;
   $this->duracion = $old_value_duracion;
   $this->presupuesto = $old_value_presupuesto;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto'][] = $rs->fields[0];
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
   $id_jefe_proyecto_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_jefe_proyecto_1))
          {
              foreach ($this->id_jefe_proyecto_1 as $tmp_id_jefe_proyecto)
              {
                  if (trim($tmp_id_jefe_proyecto) === trim($cadaselect[1])) { $id_jefe_proyecto_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_jefe_proyecto) === trim($cadaselect[1])) { $id_jefe_proyecto_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_jefe_proyecto" value="<?php echo $this->form_encode_input($id_jefe_proyecto) . "\">" . $id_jefe_proyecto_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_jefe_proyecto();
   $x = 0 ; 
   $id_jefe_proyecto_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_jefe_proyecto_1))
          {
              foreach ($this->id_jefe_proyecto_1 as $tmp_id_jefe_proyecto)
              {
                  if (trim($tmp_id_jefe_proyecto) === trim($cadaselect[1])) { $id_jefe_proyecto_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_jefe_proyecto) === trim($cadaselect[1])) { $id_jefe_proyecto_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_jefe_proyecto_look))
          {
              $id_jefe_proyecto_look = $this->id_jefe_proyecto;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_jefe_proyecto\" class=\"css_id_jefe_proyecto_line\" style=\"" .  $sStyleReadLab_id_jefe_proyecto . "\">" . $this->form_format_readonly("id_jefe_proyecto", $this->form_encode_input($id_jefe_proyecto_look)) . "</span><span id=\"id_read_off_id_jefe_proyecto\" class=\"css_read_off_id_jefe_proyecto" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_jefe_proyecto . "\">";
   echo " <span id=\"idAjaxSelect_id_jefe_proyecto\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_jefe_proyecto_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_jefe_proyecto\" name=\"id_jefe_proyecto\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_id_jefe_proyecto'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_jefe_proyecto) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_jefe_proyecto)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_jefe_proyecto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_jefe_proyecto_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['afecta_iva']))
   {
       $this->nm_new_label['afecta_iva'] = "Afecta IVA";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $afecta_iva = $this->afecta_iva;
   $sStyleHidden_afecta_iva = '';
   if (isset($this->nmgp_cmp_hidden['afecta_iva']) && $this->nmgp_cmp_hidden['afecta_iva'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['afecta_iva']);
       $sStyleHidden_afecta_iva = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_afecta_iva = 'display: none;';
   $sStyleReadInp_afecta_iva = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['afecta_iva']) && $this->nmgp_cmp_readonly['afecta_iva'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['afecta_iva']);
       $sStyleReadLab_afecta_iva = '';
       $sStyleReadInp_afecta_iva = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['afecta_iva']) && $this->nmgp_cmp_hidden['afecta_iva'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="afecta_iva" value="<?php echo $this->form_encode_input($this->afecta_iva) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_afecta_iva_label" id="hidden_field_label_afecta_iva" style="<?php echo $sStyleHidden_afecta_iva; ?>"><span id="id_label_afecta_iva"><?php echo $this->nm_new_label['afecta_iva']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['afecta_iva']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['afecta_iva'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_afecta_iva_line" id="hidden_field_data_afecta_iva" style="<?php echo $sStyleHidden_afecta_iva; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_afecta_iva_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["afecta_iva"]) &&  $this->nmgp_cmp_readonly["afecta_iva"] == "on") { 

$afecta_iva_look = "";
 if ($this->afecta_iva == "1") { $afecta_iva_look .= "SI" ;} 
 if ($this->afecta_iva == "0") { $afecta_iva_look .= "NO" ;} 
 if (empty($afecta_iva_look)) { $afecta_iva_look = $this->afecta_iva; }
?>
<input type="hidden" name="afecta_iva" value="<?php echo $this->form_encode_input($afecta_iva) . "\">" . $afecta_iva_look . ""; ?>
<?php } else { ?>
<?php

$afecta_iva_look = "";
 if ($this->afecta_iva == "1") { $afecta_iva_look .= "SI" ;} 
 if ($this->afecta_iva == "0") { $afecta_iva_look .= "NO" ;} 
 if (empty($afecta_iva_look)) { $afecta_iva_look = $this->afecta_iva; }
?>
<span id="id_read_on_afecta_iva" class="css_afecta_iva_line"  style="<?php echo $sStyleReadLab_afecta_iva; ?>"><?php echo $this->form_format_readonly("afecta_iva", $this->form_encode_input($afecta_iva_look)); ?></span><span id="id_read_off_afecta_iva" class="css_read_off_afecta_iva<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_afecta_iva; ?>">
 <span id="idAjaxSelect_afecta_iva" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_afecta_iva_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_afecta_iva" name="afecta_iva" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_afecta_iva'][] = ''; ?>
 <option value=""></option>
 <option  value="1" <?php  if ($this->afecta_iva == "1") { echo " selected" ;} ?><?php  if (empty($this->afecta_iva)) { echo " selected" ;} ?>>SI</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_afecta_iva'][] = '1'; ?>
 <option  value="0" <?php  if ($this->afecta_iva == "0") { echo " selected" ;} ?>>NO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_afecta_iva'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_afecta_iva_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_afecta_iva_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['existe_retencion']))
   {
       $this->nm_new_label['existe_retencion'] = "En Facturación, Existe Retención ?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $existe_retencion = $this->existe_retencion;
   $sStyleHidden_existe_retencion = '';
   if (isset($this->nmgp_cmp_hidden['existe_retencion']) && $this->nmgp_cmp_hidden['existe_retencion'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['existe_retencion']);
       $sStyleHidden_existe_retencion = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_existe_retencion = 'display: none;';
   $sStyleReadInp_existe_retencion = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['existe_retencion']) && $this->nmgp_cmp_readonly['existe_retencion'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['existe_retencion']);
       $sStyleReadLab_existe_retencion = '';
       $sStyleReadInp_existe_retencion = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['existe_retencion']) && $this->nmgp_cmp_hidden['existe_retencion'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="existe_retencion" value="<?php echo $this->form_encode_input($this->existe_retencion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_existe_retencion_label" id="hidden_field_label_existe_retencion" style="<?php echo $sStyleHidden_existe_retencion; ?>"><span id="id_label_existe_retencion"><?php echo $this->nm_new_label['existe_retencion']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['existe_retencion']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['existe_retencion'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_existe_retencion_line" id="hidden_field_data_existe_retencion" style="<?php echo $sStyleHidden_existe_retencion; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_existe_retencion_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["existe_retencion"]) &&  $this->nmgp_cmp_readonly["existe_retencion"] == "on") { 

$existe_retencion_look = "";
 if ($this->existe_retencion == "1") { $existe_retencion_look .= "SI" ;} 
 if ($this->existe_retencion == "0") { $existe_retencion_look .= "NO" ;} 
 if (empty($existe_retencion_look)) { $existe_retencion_look = $this->existe_retencion; }
?>
<input type="hidden" name="existe_retencion" value="<?php echo $this->form_encode_input($existe_retencion) . "\">" . $existe_retencion_look . ""; ?>
<?php } else { ?>
<?php

$existe_retencion_look = "";
 if ($this->existe_retencion == "1") { $existe_retencion_look .= "SI" ;} 
 if ($this->existe_retencion == "0") { $existe_retencion_look .= "NO" ;} 
 if (empty($existe_retencion_look)) { $existe_retencion_look = $this->existe_retencion; }
?>
<span id="id_read_on_existe_retencion" class="css_existe_retencion_line"  style="<?php echo $sStyleReadLab_existe_retencion; ?>"><?php echo $this->form_format_readonly("existe_retencion", $this->form_encode_input($existe_retencion_look)); ?></span><span id="id_read_off_existe_retencion" class="css_read_off_existe_retencion<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_existe_retencion; ?>">
 <span id="idAjaxSelect_existe_retencion" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_existe_retencion_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_existe_retencion" name="existe_retencion" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_existe_retencion'][] = ''; ?>
 <option value=""></option>
 <option  value="1" <?php  if ($this->existe_retencion == "1") { echo " selected" ;} ?>>SI</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_existe_retencion'][] = '1'; ?>
 <option  value="0" <?php  if ($this->existe_retencion == "0") { echo " selected" ;} ?>>NO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_existe_retencion'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_existe_retencion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_existe_retencion_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['incluye_retencion']))
   {
       $this->nm_new_label['incluye_retencion'] = "En Facturación, Se Incluye Retención ?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $incluye_retencion = $this->incluye_retencion;
   $sStyleHidden_incluye_retencion = '';
   if (isset($this->nmgp_cmp_hidden['incluye_retencion']) && $this->nmgp_cmp_hidden['incluye_retencion'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['incluye_retencion']);
       $sStyleHidden_incluye_retencion = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_incluye_retencion = 'display: none;';
   $sStyleReadInp_incluye_retencion = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['incluye_retencion']) && $this->nmgp_cmp_readonly['incluye_retencion'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['incluye_retencion']);
       $sStyleReadLab_incluye_retencion = '';
       $sStyleReadInp_incluye_retencion = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['incluye_retencion']) && $this->nmgp_cmp_hidden['incluye_retencion'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="incluye_retencion" value="<?php echo $this->form_encode_input($this->incluye_retencion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_incluye_retencion_label" id="hidden_field_label_incluye_retencion" style="<?php echo $sStyleHidden_incluye_retencion; ?>"><span id="id_label_incluye_retencion"><?php echo $this->nm_new_label['incluye_retencion']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['incluye_retencion']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['php_cmp_required']['incluye_retencion'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_incluye_retencion_line" id="hidden_field_data_incluye_retencion" style="<?php echo $sStyleHidden_incluye_retencion; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_incluye_retencion_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["incluye_retencion"]) &&  $this->nmgp_cmp_readonly["incluye_retencion"] == "on") { 

$incluye_retencion_look = "";
 if ($this->incluye_retencion == "1") { $incluye_retencion_look .= "SI" ;} 
 if ($this->incluye_retencion == "0") { $incluye_retencion_look .= "NO" ;} 
 if (empty($incluye_retencion_look)) { $incluye_retencion_look = $this->incluye_retencion; }
?>
<input type="hidden" name="incluye_retencion" value="<?php echo $this->form_encode_input($incluye_retencion) . "\">" . $incluye_retencion_look . ""; ?>
<?php } else { ?>
<?php

$incluye_retencion_look = "";
 if ($this->incluye_retencion == "1") { $incluye_retencion_look .= "SI" ;} 
 if ($this->incluye_retencion == "0") { $incluye_retencion_look .= "NO" ;} 
 if (empty($incluye_retencion_look)) { $incluye_retencion_look = $this->incluye_retencion; }
?>
<span id="id_read_on_incluye_retencion" class="css_incluye_retencion_line"  style="<?php echo $sStyleReadLab_incluye_retencion; ?>"><?php echo $this->form_format_readonly("incluye_retencion", $this->form_encode_input($incluye_retencion_look)); ?></span><span id="id_read_off_incluye_retencion" class="css_read_off_incluye_retencion<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_incluye_retencion; ?>">
 <span id="idAjaxSelect_incluye_retencion" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_incluye_retencion_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_incluye_retencion" name="incluye_retencion" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_incluye_retencion'][] = ''; ?>
 <option value=""></option>
 <option  value="1" <?php  if ($this->incluye_retencion == "1") { echo " selected" ;} ?>>SI</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_incluye_retencion'][] = '1'; ?>
 <option  value="0" <?php  if ($this->incluye_retencion == "0") { echo " selected" ;} ?>>NO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_incluye_retencion'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_incluye_retencion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_incluye_retencion_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
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
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['observaciones']) && $this->nmgp_cmp_readonly['observaciones'] == 'on')
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_observaciones_label" id="hidden_field_label_observaciones" style="<?php echo $sStyleHidden_observaciones; ?>"><span id="id_label_observaciones"><?php echo $this->nm_new_label['observaciones']; ?></span></TD>
    <TD class="scFormDataOdd css_observaciones_line" id="hidden_field_data_observaciones" style="<?php echo $sStyleHidden_observaciones; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_observaciones_line" style="vertical-align: top;padding: 0px">
<?php
$observaciones_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($observaciones));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["observaciones"]) &&  $this->nmgp_cmp_readonly["observaciones"] == "on") { 

 ?>
<input type="hidden" name="observaciones" value="<?php echo $this->form_encode_input($observaciones) . "\">" . $observaciones_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_observaciones" class="sc-ui-readonly-observaciones css_observaciones_line" style="<?php echo $sStyleReadLab_observaciones; ?>"><?php echo $this->form_format_readonly("observaciones", $this->form_encode_input($observaciones_val)); ?></span><span id="id_read_off_observaciones" class="css_read_off_observaciones<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observaciones; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_observaciones_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="observaciones" id="id_sc_field_observaciones" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $observaciones; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_observaciones_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_observaciones_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
</TABLE></div><!-- bloco_f -->
   </td></tr></table>
   </div>
