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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " Partida De Producción Ejecutada"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Partida De Producción"); } ?></TITLE>
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
.css_read_off_fecha_desde button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_fecha_hasta button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_fecha_desde_factura button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_fecha_hasta_factura button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_fecha button {
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_prod_presupuesto_periodo/form_prod_presupuesto_periodo_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_prod_presupuesto_periodo_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_prod_presupuesto_periodo_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $("#hidden_bloco_0,#hidden_bloco_1,#hidden_bloco_2,#hidden_bloco_3,#hidden_bloco_4,#hidden_bloco_5,#hidden_bloco_6").each(function() {
   $(this.rows[0]).bind("click", {block: this}, toggleBlock)
                  .mouseover(function() { $(this).css("cursor", "pointer"); })
                  .mouseout(function() { $(this).css("cursor", ""); });
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
    "hidden_bloco_0": true,
    "hidden_bloco_1": true,
    "hidden_bloco_2": true,
    "hidden_bloco_3": true,
    "hidden_bloco_4": true,
    "hidden_bloco_5": true,
    "hidden_bloco_6": true
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['recarga'];
}
    $remove_margin = '';
    $remove_border = '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['link_info']['remove_border']) {
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
 include_once("form_prod_presupuesto_periodo_js0.php");
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
<form  name="F1" method="post" enctype="multipart/form-data" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['insert_validation']; ?>">
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
<input type="hidden" name="factura_salva" value="<?php  echo $this->form_encode_input($this->factura) ?>">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_prod_presupuesto_periodo'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_prod_presupuesto_periodo'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="90%">
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['fast_search'][2] : "";
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
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['new'];
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
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['insert'];
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
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['bcancelar'];
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
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['update'];
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
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F5('" . $nm_url_saida. "');", "scFormClose_F5('" . $nm_url_saida. "');", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F5('" . $nm_url_saida. "');", "scFormClose_F5('" . $nm_url_saida. "');", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="20%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><input type="hidden" name="factura_ul_name" id="id_sc_field_factura_ul_name" value="<?php echo $this->form_encode_input($this->factura_ul_name);?>">
<input type="hidden" name="factura_ul_type" id="id_sc_field_factura_ul_type" value="<?php echo $this->form_encode_input($this->factura_ul_type);?>">
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id']))
           {
               $this->nmgp_cmp_readonly['id'] = 'on';
           }
?>
   <tr>


    <TD colspan="1" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf0\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?>Datos Proyecto<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_proyecto']))
           {
               $this->nmgp_cmp_readonly['id_proyecto'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['id']))
    {
        $this->nm_new_label['id'] = "ID";
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

    <TD class="scFormDataOdd css_id_line" id="hidden_field_data_id" style="<?php echo $sStyleHidden_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_id_label" style=""><span id="id_label_id"><?php echo $this->nm_new_label['id']; ?></span></span><br><span id="id_read_on_id" class="css_id_line" style="<?php echo $sStyleReadLab_id; ?>"><?php echo $this->form_format_readonly("id", $this->form_encode_input($this->id)); ?></span><span id="id_read_off_id" class="css_read_off_id" style="<?php echo $sStyleReadInp_id; ?>"><input type="hidden" name="id" value="<?php echo $this->form_encode_input($id) . "\">"?><span id="id_ajax_label_id"><?php echo nl2br($id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_text"></span></td></tr></table></td></tr></table> </TD>
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
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['monto_contrato']))
           {
               $this->nmgp_cmp_readonly['monto_contrato'] = 'on';
           }
?>


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
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_proyecto"]) &&  $this->nmgp_cmp_readonly["id_proyecto"] == "on"))
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

    <TD class="scFormDataOdd css_id_proyecto_line" id="hidden_field_data_id_proyecto" style="<?php echo $sStyleHidden_id_proyecto; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_proyecto_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_id_proyecto_label" style=""><span id="id_label_id_proyecto"><?php echo $this->nm_new_label['id_proyecto']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['id_proyecto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['id_proyecto'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["id_proyecto"]) &&  $this->nmgp_cmp_readonly["id_proyecto"] == "on")) { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT id, nombre_proyecto  FROM proyectos where id=" . $_SESSION['id_proyecto'] . "  ORDER BY nombre_proyecto";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_proyecto'][] = $rs->fields[0];
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
<input type="hidden" name="id_proyecto" value="<?php echo $this->form_encode_input($id_proyecto) . "\"><span id=\"id_ajax_label_id_proyecto\">" . $id_proyecto_look . "</span>"; ?>
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_proyecto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_proyecto_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['monto_contrato']))
    {
        $this->nm_new_label['monto_contrato'] = "Presupuesto Del Contrato - BASE";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $monto_contrato = $this->monto_contrato;
   $sStyleHidden_monto_contrato = '';
   if (isset($this->nmgp_cmp_hidden['monto_contrato']) && $this->nmgp_cmp_hidden['monto_contrato'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['monto_contrato']);
       $sStyleHidden_monto_contrato = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_monto_contrato = 'display: none;';
   $sStyleReadInp_monto_contrato = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["monto_contrato"]) &&  $this->nmgp_cmp_readonly["monto_contrato"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['monto_contrato']);
       $sStyleReadLab_monto_contrato = '';
       $sStyleReadInp_monto_contrato = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['monto_contrato']) && $this->nmgp_cmp_hidden['monto_contrato'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="monto_contrato" value="<?php echo $this->form_encode_input($monto_contrato) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_monto_contrato_line" id="hidden_field_data_monto_contrato" style="<?php echo $sStyleHidden_monto_contrato; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_monto_contrato_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_monto_contrato_label" style=""><span id="id_label_monto_contrato"><?php echo $this->nm_new_label['monto_contrato']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["monto_contrato"]) &&  $this->nmgp_cmp_readonly["monto_contrato"] == "on")) { 

 ?>
<input type="hidden" name="monto_contrato" value="<?php echo $this->form_encode_input($monto_contrato) . "\"><span id=\"id_ajax_label_monto_contrato\">" . $monto_contrato . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_monto_contrato" class="sc-ui-readonly-monto_contrato css_monto_contrato_line" style="<?php echo $sStyleReadLab_monto_contrato; ?>"><?php echo $this->form_format_readonly("monto_contrato", $this->form_encode_input($this->monto_contrato)); ?></span><span id="id_read_off_monto_contrato" class="css_read_off_monto_contrato<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_monto_contrato; ?>">
 <input class="sc-js-input scFormObjectOdd css_monto_contrato_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_monto_contrato" type=text name="monto_contrato" value="<?php echo $this->form_encode_input($monto_contrato) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['monto_contrato']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['monto_contrato']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['monto_contrato']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['monto_contrato']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_monto_contrato_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_monto_contrato_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




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

    <TD class="scFormDataOdd css_tipo_moneda_line" id="hidden_field_data_tipo_moneda" style="<?php echo $sStyleHidden_tipo_moneda; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tipo_moneda_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tipo_moneda_label" style=""><span id="id_label_tipo_moneda"><?php echo $this->nm_new_label['tipo_moneda']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['tipo_moneda']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['tipo_moneda'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tipo_moneda"]) &&  $this->nmgp_cmp_readonly["tipo_moneda"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    proyectos.tipo_moneda,   prod_monedas.tipo_moneda FROM   proyectos   INNER JOIN prod_monedas ON (proyectos.tipo_moneda = prod_monedas.id) WHERE   proyectos.id =" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_tipo_moneda'][] = $rs->fields[0];
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_moneda_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_moneda_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_partida']))
           {
               $this->nmgp_cmp_readonly['id_partida'] = 'on';
           }
?>


   <?php
   if (!isset($this->nm_new_label['empresa']))
   {
       $this->nm_new_label['empresa'] = "Empresa";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa = $this->empresa;
   $sStyleHidden_empresa = '';
   if (isset($this->nmgp_cmp_hidden['empresa']) && $this->nmgp_cmp_hidden['empresa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa']);
       $sStyleHidden_empresa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa = 'display: none;';
   $sStyleReadInp_empresa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa']) && $this->nmgp_cmp_readonly['empresa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa']);
       $sStyleReadLab_empresa = '';
       $sStyleReadInp_empresa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa']) && $this->nmgp_cmp_hidden['empresa'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="empresa" value="<?php echo $this->form_encode_input($this->empresa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_empresa_line" id="hidden_field_data_empresa" style="<?php echo $sStyleHidden_empresa; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_empresa_label" style=""><span id="id_label_empresa"><?php echo $this->nm_new_label['empresa']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['empresa']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['empresa'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa"]) &&  $this->nmgp_cmp_readonly["empresa"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    companias.razon_social,  companias.razon_social FROM   proyectos   INNER JOIN companias ON (proyectos.id_empresa = companias.id) WHERE   proyectos.id =" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_empresa'][] = $rs->fields[0];
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
   $empresa_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->empresa_1))
          {
              foreach ($this->empresa_1 as $tmp_empresa)
              {
                  if (trim($tmp_empresa) === trim($cadaselect[1])) { $empresa_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->empresa) === trim($cadaselect[1])) { $empresa_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="empresa" value="<?php echo $this->form_encode_input($empresa) . "\">" . $empresa_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_empresa();
   $x = 0 ; 
   $empresa_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->empresa_1))
          {
              foreach ($this->empresa_1 as $tmp_empresa)
              {
                  if (trim($tmp_empresa) === trim($cadaselect[1])) { $empresa_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->empresa) === trim($cadaselect[1])) { $empresa_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($empresa_look))
          {
              $empresa_look = $this->empresa;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_empresa\" class=\"css_empresa_line\" style=\"" .  $sStyleReadLab_empresa . "\">" . $this->form_format_readonly("empresa", $this->form_encode_input($empresa_look)) . "</span><span id=\"id_read_off_empresa\" class=\"css_read_off_empresa" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_empresa . "\">";
   echo " <span id=\"idAjaxSelect_empresa\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_empresa_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_empresa\" name=\"empresa\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->empresa) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->empresa)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_empresa_dumb = ('' == $sStyleHidden_empresa) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_empresa_dumb" style="<?php echo $sStyleHidden_empresa_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   <td width="20%" height="">
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf1\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?>Datos Período Producción<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_partida']))
   {
       $this->nm_new_label['id_partida'] = "Período Asociado";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_partida = $this->id_partida;
   $sStyleHidden_id_partida = '';
   if (isset($this->nmgp_cmp_hidden['id_partida']) && $this->nmgp_cmp_hidden['id_partida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_partida']);
       $sStyleHidden_id_partida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_partida = 'display: none;';
   $sStyleReadInp_id_partida = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_partida"]) &&  $this->nmgp_cmp_readonly["id_partida"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_partida']);
       $sStyleReadLab_id_partida = '';
       $sStyleReadInp_id_partida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_partida']) && $this->nmgp_cmp_hidden['id_partida'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_partida" value="<?php echo $this->form_encode_input($this->id_partida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_id_partida_line" id="hidden_field_data_id_partida" style="<?php echo $sStyleHidden_id_partida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_partida_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_id_partida_label" style=""><span id="id_label_id_partida"><?php echo $this->nm_new_label['id_partida']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['id_partida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['id_partida'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["id_partida"]) &&  $this->nmgp_cmp_readonly["id_partida"] == "on")) { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT id,concat(month(fecha),'-',year(fecha))   FROM prod_produccion_proyecto  WHERE id_proyecto=" . $_SESSION['id_proyecto'] . "  ORDER BY fecha";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'][] = $rs->fields[0];
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
   $id_partida_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_partida_1))
          {
              foreach ($this->id_partida_1 as $tmp_id_partida)
              {
                  if (trim($tmp_id_partida) === trim($cadaselect[1])) { $id_partida_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_partida) === trim($cadaselect[1])) { $id_partida_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_partida" value="<?php echo $this->form_encode_input($id_partida) . "\"><span id=\"id_ajax_label_id_partida\">" . $id_partida_look . "</span>"; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_partida();
   $x = 0 ; 
   $id_partida_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_partida_1))
          {
              foreach ($this->id_partida_1 as $tmp_id_partida)
              {
                  if (trim($tmp_id_partida) === trim($cadaselect[1])) { $id_partida_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_partida) === trim($cadaselect[1])) { $id_partida_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_partida_look))
          {
              $id_partida_look = $this->id_partida;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_partida\" class=\"css_id_partida_line\" style=\"" .  $sStyleReadLab_id_partida . "\">" . $this->form_format_readonly("id_partida", $this->form_encode_input($id_partida_look)) . "</span><span id=\"id_read_off_id_partida\" class=\"css_read_off_id_partida" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_partida . "\">";
   echo " <span id=\"idAjaxSelect_id_partida\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_partida_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_partida\" name=\"id_partida\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_id_partida'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_partida) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_partida)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_partida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_partida_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fecha_desde']))
    {
        $this->nm_new_label['fecha_desde'] = "Fecha Desde - PERÍODO";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fecha_desde = $this->fecha_desde;
   $sStyleHidden_fecha_desde = '';
   if (isset($this->nmgp_cmp_hidden['fecha_desde']) && $this->nmgp_cmp_hidden['fecha_desde'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fecha_desde']);
       $sStyleHidden_fecha_desde = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fecha_desde = 'display: none;';
   $sStyleReadInp_fecha_desde = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fecha_desde']) && $this->nmgp_cmp_readonly['fecha_desde'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fecha_desde']);
       $sStyleReadLab_fecha_desde = '';
       $sStyleReadInp_fecha_desde = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fecha_desde']) && $this->nmgp_cmp_hidden['fecha_desde'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fecha_desde" value="<?php echo $this->form_encode_input($fecha_desde) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_fecha_desde_line" id="hidden_field_data_fecha_desde" style="<?php echo $sStyleHidden_fecha_desde; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fecha_desde_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_fecha_desde_label" style=""><span id="id_label_fecha_desde"><?php echo $this->nm_new_label['fecha_desde']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['fecha_desde']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['fecha_desde'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fecha_desde"]) &&  $this->nmgp_cmp_readonly["fecha_desde"] == "on") { 

 ?>
<input type="hidden" name="fecha_desde" value="<?php echo $this->form_encode_input($fecha_desde) . "\">" . $fecha_desde . ""; ?>
<?php } else { ?>
<span id="id_read_on_fecha_desde" class="sc-ui-readonly-fecha_desde css_fecha_desde_line" style="<?php echo $sStyleReadLab_fecha_desde; ?>"><?php echo $this->form_format_readonly("fecha_desde", $this->form_encode_input($fecha_desde)); ?></span><span id="id_read_off_fecha_desde" class="css_read_off_fecha_desde<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fecha_desde; ?>"><?php
$tmp_form_data = $this->field_config['fecha_desde']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_fecha_desde_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fecha_desde" type=text name="fecha_desde" value="<?php echo $this->form_encode_input($fecha_desde) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['fecha_desde']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['fecha_desde']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fecha_desde_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fecha_desde_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['dias_desde']))
           {
               $this->nmgp_cmp_readonly['dias_desde'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['fecha_hasta']))
    {
        $this->nm_new_label['fecha_hasta'] = "Fecha Hasta - PERÍODO";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fecha_hasta = $this->fecha_hasta;
   $sStyleHidden_fecha_hasta = '';
   if (isset($this->nmgp_cmp_hidden['fecha_hasta']) && $this->nmgp_cmp_hidden['fecha_hasta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fecha_hasta']);
       $sStyleHidden_fecha_hasta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fecha_hasta = 'display: none;';
   $sStyleReadInp_fecha_hasta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fecha_hasta']) && $this->nmgp_cmp_readonly['fecha_hasta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fecha_hasta']);
       $sStyleReadLab_fecha_hasta = '';
       $sStyleReadInp_fecha_hasta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fecha_hasta']) && $this->nmgp_cmp_hidden['fecha_hasta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fecha_hasta" value="<?php echo $this->form_encode_input($fecha_hasta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_fecha_hasta_line" id="hidden_field_data_fecha_hasta" style="<?php echo $sStyleHidden_fecha_hasta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fecha_hasta_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_fecha_hasta_label" style=""><span id="id_label_fecha_hasta"><?php echo $this->nm_new_label['fecha_hasta']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['fecha_hasta']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['fecha_hasta'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fecha_hasta"]) &&  $this->nmgp_cmp_readonly["fecha_hasta"] == "on") { 

 ?>
<input type="hidden" name="fecha_hasta" value="<?php echo $this->form_encode_input($fecha_hasta) . "\">" . $fecha_hasta . ""; ?>
<?php } else { ?>
<span id="id_read_on_fecha_hasta" class="sc-ui-readonly-fecha_hasta css_fecha_hasta_line" style="<?php echo $sStyleReadLab_fecha_hasta; ?>"><?php echo $this->form_format_readonly("fecha_hasta", $this->form_encode_input($fecha_hasta)); ?></span><span id="id_read_off_fecha_hasta" class="css_read_off_fecha_hasta<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fecha_hasta; ?>"><?php
$tmp_form_data = $this->field_config['fecha_hasta']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_fecha_hasta_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fecha_hasta" type=text name="fecha_hasta" value="<?php echo $this->form_encode_input($fecha_hasta) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['fecha_hasta']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['fecha_hasta']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fecha_hasta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fecha_hasta_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['dias_hasta']))
           {
               $this->nmgp_cmp_readonly['dias_hasta'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['dias_desde']))
    {
        $this->nm_new_label['dias_desde'] = "Dias Mes Actual";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dias_desde = $this->dias_desde;
   $sStyleHidden_dias_desde = '';
   if (isset($this->nmgp_cmp_hidden['dias_desde']) && $this->nmgp_cmp_hidden['dias_desde'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dias_desde']);
       $sStyleHidden_dias_desde = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dias_desde = 'display: none;';
   $sStyleReadInp_dias_desde = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["dias_desde"]) &&  $this->nmgp_cmp_readonly["dias_desde"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dias_desde']);
       $sStyleReadLab_dias_desde = '';
       $sStyleReadInp_dias_desde = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dias_desde']) && $this->nmgp_cmp_hidden['dias_desde'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dias_desde" value="<?php echo $this->form_encode_input($dias_desde) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_dias_desde_line" id="hidden_field_data_dias_desde" style="<?php echo $sStyleHidden_dias_desde; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dias_desde_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_dias_desde_label" style=""><span id="id_label_dias_desde"><?php echo $this->nm_new_label['dias_desde']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["dias_desde"]) &&  $this->nmgp_cmp_readonly["dias_desde"] == "on")) { 

 ?>
<input type="hidden" name="dias_desde" value="<?php echo $this->form_encode_input($dias_desde) . "\"><span id=\"id_ajax_label_dias_desde\">" . $dias_desde . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_dias_desde" class="sc-ui-readonly-dias_desde css_dias_desde_line" style="<?php echo $sStyleReadLab_dias_desde; ?>"><?php echo $this->form_format_readonly("dias_desde", $this->form_encode_input($this->dias_desde)); ?></span><span id="id_read_off_dias_desde" class="css_read_off_dias_desde<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dias_desde; ?>">
 <input class="sc-js-input scFormObjectOdd css_dias_desde_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dias_desde" type=text name="dias_desde" value="<?php echo $this->form_encode_input($dias_desde) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['dias_desde']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['dias_desde']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['dias_desde']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dias_desde_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dias_desde_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['dias_periodo']))
           {
               $this->nmgp_cmp_readonly['dias_periodo'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['dias_hasta']))
    {
        $this->nm_new_label['dias_hasta'] = "Dias Mes Siguiente";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dias_hasta = $this->dias_hasta;
   $sStyleHidden_dias_hasta = '';
   if (isset($this->nmgp_cmp_hidden['dias_hasta']) && $this->nmgp_cmp_hidden['dias_hasta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dias_hasta']);
       $sStyleHidden_dias_hasta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dias_hasta = 'display: none;';
   $sStyleReadInp_dias_hasta = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["dias_hasta"]) &&  $this->nmgp_cmp_readonly["dias_hasta"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dias_hasta']);
       $sStyleReadLab_dias_hasta = '';
       $sStyleReadInp_dias_hasta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dias_hasta']) && $this->nmgp_cmp_hidden['dias_hasta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dias_hasta" value="<?php echo $this->form_encode_input($dias_hasta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_dias_hasta_line" id="hidden_field_data_dias_hasta" style="<?php echo $sStyleHidden_dias_hasta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dias_hasta_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_dias_hasta_label" style=""><span id="id_label_dias_hasta"><?php echo $this->nm_new_label['dias_hasta']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["dias_hasta"]) &&  $this->nmgp_cmp_readonly["dias_hasta"] == "on")) { 

 ?>
<input type="hidden" name="dias_hasta" value="<?php echo $this->form_encode_input($dias_hasta) . "\"><span id=\"id_ajax_label_dias_hasta\">" . $dias_hasta . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_dias_hasta" class="sc-ui-readonly-dias_hasta css_dias_hasta_line" style="<?php echo $sStyleReadLab_dias_hasta; ?>"><?php echo $this->form_format_readonly("dias_hasta", $this->form_encode_input($this->dias_hasta)); ?></span><span id="id_read_off_dias_hasta" class="css_read_off_dias_hasta<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dias_hasta; ?>">
 <input class="sc-js-input scFormObjectOdd css_dias_hasta_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dias_hasta" type=text name="dias_hasta" value="<?php echo $this->form_encode_input($dias_hasta) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['dias_hasta']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['dias_hasta']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['dias_hasta']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dias_hasta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dias_hasta_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dias_periodo']))
    {
        $this->nm_new_label['dias_periodo'] = "Dias Totales Período";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dias_periodo = $this->dias_periodo;
   $sStyleHidden_dias_periodo = '';
   if (isset($this->nmgp_cmp_hidden['dias_periodo']) && $this->nmgp_cmp_hidden['dias_periodo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dias_periodo']);
       $sStyleHidden_dias_periodo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dias_periodo = 'display: none;';
   $sStyleReadInp_dias_periodo = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["dias_periodo"]) &&  $this->nmgp_cmp_readonly["dias_periodo"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dias_periodo']);
       $sStyleReadLab_dias_periodo = '';
       $sStyleReadInp_dias_periodo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dias_periodo']) && $this->nmgp_cmp_hidden['dias_periodo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dias_periodo" value="<?php echo $this->form_encode_input($dias_periodo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_dias_periodo_line" id="hidden_field_data_dias_periodo" style="<?php echo $sStyleHidden_dias_periodo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dias_periodo_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_dias_periodo_label" style=""><span id="id_label_dias_periodo"><?php echo $this->nm_new_label['dias_periodo']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["dias_periodo"]) &&  $this->nmgp_cmp_readonly["dias_periodo"] == "on")) { 

 ?>
<input type="hidden" name="dias_periodo" value="<?php echo $this->form_encode_input($dias_periodo) . "\"><span id=\"id_ajax_label_dias_periodo\">" . $dias_periodo . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_dias_periodo" class="sc-ui-readonly-dias_periodo css_dias_periodo_line" style="<?php echo $sStyleReadLab_dias_periodo; ?>"><?php echo $this->form_format_readonly("dias_periodo", $this->form_encode_input($this->dias_periodo)); ?></span><span id="id_read_off_dias_periodo" class="css_read_off_dias_periodo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dias_periodo; ?>">
 <input class="sc-js-input scFormObjectOdd css_dias_periodo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dias_periodo" type=text name="dias_periodo" value="<?php echo $this->form_encode_input($dias_periodo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['dias_periodo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['dias_periodo']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['dias_periodo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dias_periodo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dias_periodo_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_dias_periodo_dumb = ('' == $sStyleHidden_dias_periodo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dias_periodo_dumb" style="<?php echo $sStyleHidden_dias_periodo_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   <td width="20%" height="">
   <a name="bloco_2"></a>
<div id="div_hidden_bloco_2"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf2\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?>Datos Producción Para Facturación<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['avance_informado_con_iva']))
           {
               $this->nmgp_cmp_readonly['avance_informado_con_iva'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['fecha_desde_factura']))
    {
        $this->nm_new_label['fecha_desde_factura'] = "Factura Producción Desde";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fecha_desde_factura = $this->fecha_desde_factura;
   $sStyleHidden_fecha_desde_factura = '';
   if (isset($this->nmgp_cmp_hidden['fecha_desde_factura']) && $this->nmgp_cmp_hidden['fecha_desde_factura'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fecha_desde_factura']);
       $sStyleHidden_fecha_desde_factura = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fecha_desde_factura = 'display: none;';
   $sStyleReadInp_fecha_desde_factura = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fecha_desde_factura']) && $this->nmgp_cmp_readonly['fecha_desde_factura'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fecha_desde_factura']);
       $sStyleReadLab_fecha_desde_factura = '';
       $sStyleReadInp_fecha_desde_factura = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fecha_desde_factura']) && $this->nmgp_cmp_hidden['fecha_desde_factura'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fecha_desde_factura" value="<?php echo $this->form_encode_input($fecha_desde_factura) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_fecha_desde_factura_line" id="hidden_field_data_fecha_desde_factura" style="<?php echo $sStyleHidden_fecha_desde_factura; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fecha_desde_factura_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_fecha_desde_factura_label" style=""><span id="id_label_fecha_desde_factura"><?php echo $this->nm_new_label['fecha_desde_factura']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fecha_desde_factura"]) &&  $this->nmgp_cmp_readonly["fecha_desde_factura"] == "on") { 

 ?>
<input type="hidden" name="fecha_desde_factura" value="<?php echo $this->form_encode_input($fecha_desde_factura) . "\">" . $fecha_desde_factura . ""; ?>
<?php } else { ?>
<span id="id_read_on_fecha_desde_factura" class="sc-ui-readonly-fecha_desde_factura css_fecha_desde_factura_line" style="<?php echo $sStyleReadLab_fecha_desde_factura; ?>"><?php echo $this->form_format_readonly("fecha_desde_factura", $this->form_encode_input($fecha_desde_factura)); ?></span><span id="id_read_off_fecha_desde_factura" class="css_read_off_fecha_desde_factura<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fecha_desde_factura; ?>"><?php
$tmp_form_data = $this->field_config['fecha_desde_factura']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_fecha_desde_factura_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fecha_desde_factura" type=text name="fecha_desde_factura" value="<?php echo $this->form_encode_input($fecha_desde_factura) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['fecha_desde_factura']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['fecha_desde_factura']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fecha_desde_factura_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fecha_desde_factura_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['fecha_hasta_factura']))
    {
        $this->nm_new_label['fecha_hasta_factura'] = "Factura Producción Hasta";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fecha_hasta_factura = $this->fecha_hasta_factura;
   $sStyleHidden_fecha_hasta_factura = '';
   if (isset($this->nmgp_cmp_hidden['fecha_hasta_factura']) && $this->nmgp_cmp_hidden['fecha_hasta_factura'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fecha_hasta_factura']);
       $sStyleHidden_fecha_hasta_factura = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fecha_hasta_factura = 'display: none;';
   $sStyleReadInp_fecha_hasta_factura = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fecha_hasta_factura']) && $this->nmgp_cmp_readonly['fecha_hasta_factura'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fecha_hasta_factura']);
       $sStyleReadLab_fecha_hasta_factura = '';
       $sStyleReadInp_fecha_hasta_factura = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fecha_hasta_factura']) && $this->nmgp_cmp_hidden['fecha_hasta_factura'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fecha_hasta_factura" value="<?php echo $this->form_encode_input($fecha_hasta_factura) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_fecha_hasta_factura_line" id="hidden_field_data_fecha_hasta_factura" style="<?php echo $sStyleHidden_fecha_hasta_factura; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fecha_hasta_factura_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_fecha_hasta_factura_label" style=""><span id="id_label_fecha_hasta_factura"><?php echo $this->nm_new_label['fecha_hasta_factura']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fecha_hasta_factura"]) &&  $this->nmgp_cmp_readonly["fecha_hasta_factura"] == "on") { 

 ?>
<input type="hidden" name="fecha_hasta_factura" value="<?php echo $this->form_encode_input($fecha_hasta_factura) . "\">" . $fecha_hasta_factura . ""; ?>
<?php } else { ?>
<span id="id_read_on_fecha_hasta_factura" class="sc-ui-readonly-fecha_hasta_factura css_fecha_hasta_factura_line" style="<?php echo $sStyleReadLab_fecha_hasta_factura; ?>"><?php echo $this->form_format_readonly("fecha_hasta_factura", $this->form_encode_input($fecha_hasta_factura)); ?></span><span id="id_read_off_fecha_hasta_factura" class="css_read_off_fecha_hasta_factura<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fecha_hasta_factura; ?>"><?php
$tmp_form_data = $this->field_config['fecha_hasta_factura']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_fecha_hasta_factura_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fecha_hasta_factura" type=text name="fecha_hasta_factura" value="<?php echo $this->form_encode_input($fecha_hasta_factura) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['fecha_hasta_factura']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['fecha_hasta_factura']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fecha_hasta_factura_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fecha_hasta_factura_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_fecha_desde_factura_dumb = ('' == $sStyleHidden_fecha_desde_factura) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_fecha_desde_factura_dumb" style="<?php echo $sStyleHidden_fecha_desde_factura_dumb; ?>"></TD>
<?php $sStyleHidden_fecha_hasta_factura_dumb = ('' == $sStyleHidden_fecha_hasta_factura) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_fecha_hasta_factura_dumb" style="<?php echo $sStyleHidden_fecha_hasta_factura_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['produccion_neto']))
           {
               $this->nmgp_cmp_readonly['produccion_neto'] = 'on';
           }
?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['reajuste_acumulado_neto']))
           {
               $this->nmgp_cmp_readonly['reajuste_acumulado_neto'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['avance_informado_con_iva']))
    {
        $this->nm_new_label['avance_informado_con_iva'] = "Monto Producción Con IVA";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $avance_informado_con_iva = $this->avance_informado_con_iva;
   $sStyleHidden_avance_informado_con_iva = '';
   if (isset($this->nmgp_cmp_hidden['avance_informado_con_iva']) && $this->nmgp_cmp_hidden['avance_informado_con_iva'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['avance_informado_con_iva']);
       $sStyleHidden_avance_informado_con_iva = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_avance_informado_con_iva = 'display: none;';
   $sStyleReadInp_avance_informado_con_iva = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["avance_informado_con_iva"]) &&  $this->nmgp_cmp_readonly["avance_informado_con_iva"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['avance_informado_con_iva']);
       $sStyleReadLab_avance_informado_con_iva = '';
       $sStyleReadInp_avance_informado_con_iva = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['avance_informado_con_iva']) && $this->nmgp_cmp_hidden['avance_informado_con_iva'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="avance_informado_con_iva" value="<?php echo $this->form_encode_input($avance_informado_con_iva) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_avance_informado_con_iva_line" id="hidden_field_data_avance_informado_con_iva" style="<?php echo $sStyleHidden_avance_informado_con_iva; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_avance_informado_con_iva_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_avance_informado_con_iva_label" style=""><span id="id_label_avance_informado_con_iva"><?php echo $this->nm_new_label['avance_informado_con_iva']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["avance_informado_con_iva"]) &&  $this->nmgp_cmp_readonly["avance_informado_con_iva"] == "on")) { 

 ?>
<input type="hidden" name="avance_informado_con_iva" value="<?php echo $this->form_encode_input($avance_informado_con_iva) . "\"><span id=\"id_ajax_label_avance_informado_con_iva\">" . $avance_informado_con_iva . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_avance_informado_con_iva" class="sc-ui-readonly-avance_informado_con_iva css_avance_informado_con_iva_line" style="<?php echo $sStyleReadLab_avance_informado_con_iva; ?>"><?php echo $this->form_format_readonly("avance_informado_con_iva", $this->form_encode_input($this->avance_informado_con_iva)); ?></span><span id="id_read_off_avance_informado_con_iva" class="css_read_off_avance_informado_con_iva<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_avance_informado_con_iva; ?>">
 <input class="sc-js-input scFormObjectOdd css_avance_informado_con_iva_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_avance_informado_con_iva" type=text name="avance_informado_con_iva" value="<?php echo $this->form_encode_input($avance_informado_con_iva) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['avance_informado_con_iva']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['avance_informado_con_iva']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['avance_informado_con_iva']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['avance_informado_con_iva']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_avance_informado_con_iva_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_avance_informado_con_iva_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['produccion_neto']))
    {
        $this->nm_new_label['produccion_neto'] = "Monto Producción Neto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $produccion_neto = $this->produccion_neto;
   $sStyleHidden_produccion_neto = '';
   if (isset($this->nmgp_cmp_hidden['produccion_neto']) && $this->nmgp_cmp_hidden['produccion_neto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['produccion_neto']);
       $sStyleHidden_produccion_neto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_produccion_neto = 'display: none;';
   $sStyleReadInp_produccion_neto = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["produccion_neto"]) &&  $this->nmgp_cmp_readonly["produccion_neto"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['produccion_neto']);
       $sStyleReadLab_produccion_neto = '';
       $sStyleReadInp_produccion_neto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['produccion_neto']) && $this->nmgp_cmp_hidden['produccion_neto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="produccion_neto" value="<?php echo $this->form_encode_input($produccion_neto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_produccion_neto_line" id="hidden_field_data_produccion_neto" style="<?php echo $sStyleHidden_produccion_neto; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_produccion_neto_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_produccion_neto_label" style=""><span id="id_label_produccion_neto"><?php echo $this->nm_new_label['produccion_neto']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["produccion_neto"]) &&  $this->nmgp_cmp_readonly["produccion_neto"] == "on")) { 

 ?>
<input type="hidden" name="produccion_neto" value="<?php echo $this->form_encode_input($produccion_neto) . "\"><span id=\"id_ajax_label_produccion_neto\">" . $produccion_neto . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_produccion_neto" class="sc-ui-readonly-produccion_neto css_produccion_neto_line" style="<?php echo $sStyleReadLab_produccion_neto; ?>"><?php echo $this->form_format_readonly("produccion_neto", $this->form_encode_input($this->produccion_neto)); ?></span><span id="id_read_off_produccion_neto" class="css_read_off_produccion_neto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_produccion_neto; ?>">
 <input class="sc-js-input scFormObjectOdd css_produccion_neto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_produccion_neto" type=text name="produccion_neto" value="<?php echo $this->form_encode_input($produccion_neto) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['produccion_neto']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['produccion_neto']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['produccion_neto']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['produccion_neto']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_produccion_neto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_produccion_neto_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_avance_informado_con_iva_dumb = ('' == $sStyleHidden_avance_informado_con_iva) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_avance_informado_con_iva_dumb" style="<?php echo $sStyleHidden_avance_informado_con_iva_dumb; ?>"></TD>
<?php $sStyleHidden_produccion_neto_dumb = ('' == $sStyleHidden_produccion_neto) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_produccion_neto_dumb" style="<?php echo $sStyleHidden_produccion_neto_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['reajuste_acumulado_neto']))
    {
        $this->nm_new_label['reajuste_acumulado_neto'] = "Reajuste Acumulado Neto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $sStyleHidden_reajuste_acumulado_neto = '';
   if (isset($this->nmgp_cmp_hidden['reajuste_acumulado_neto']) && $this->nmgp_cmp_hidden['reajuste_acumulado_neto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['reajuste_acumulado_neto']);
       $sStyleHidden_reajuste_acumulado_neto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_reajuste_acumulado_neto = 'display: none;';
   $sStyleReadInp_reajuste_acumulado_neto = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["reajuste_acumulado_neto"]) &&  $this->nmgp_cmp_readonly["reajuste_acumulado_neto"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['reajuste_acumulado_neto']);
       $sStyleReadLab_reajuste_acumulado_neto = '';
       $sStyleReadInp_reajuste_acumulado_neto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['reajuste_acumulado_neto']) && $this->nmgp_cmp_hidden['reajuste_acumulado_neto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="reajuste_acumulado_neto" value="<?php echo $this->form_encode_input($reajuste_acumulado_neto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_reajuste_acumulado_neto_line" id="hidden_field_data_reajuste_acumulado_neto" style="<?php echo $sStyleHidden_reajuste_acumulado_neto; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_reajuste_acumulado_neto_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_reajuste_acumulado_neto_label" style=""><span id="id_label_reajuste_acumulado_neto"><?php echo $this->nm_new_label['reajuste_acumulado_neto']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["reajuste_acumulado_neto"]) &&  $this->nmgp_cmp_readonly["reajuste_acumulado_neto"] == "on")) { 

 ?>
<input type="hidden" name="reajuste_acumulado_neto" value="<?php echo $this->form_encode_input($reajuste_acumulado_neto) . "\"><span id=\"id_ajax_label_reajuste_acumulado_neto\">" . $reajuste_acumulado_neto . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_reajuste_acumulado_neto" class="sc-ui-readonly-reajuste_acumulado_neto css_reajuste_acumulado_neto_line" style="<?php echo $sStyleReadLab_reajuste_acumulado_neto; ?>"><?php echo $this->form_format_readonly("reajuste_acumulado_neto", $this->form_encode_input($this->reajuste_acumulado_neto)); ?></span><span id="id_read_off_reajuste_acumulado_neto" class="css_read_off_reajuste_acumulado_neto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_reajuste_acumulado_neto; ?>">
 <input class="sc-js-input scFormObjectOdd css_reajuste_acumulado_neto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_reajuste_acumulado_neto" type=text name="reajuste_acumulado_neto" value="<?php echo $this->form_encode_input($reajuste_acumulado_neto) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['reajuste_acumulado_neto']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['reajuste_acumulado_neto']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['reajuste_acumulado_neto']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['reajuste_acumulado_neto']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_reajuste_acumulado_neto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_reajuste_acumulado_neto_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['multa']))
    {
        $this->nm_new_label['multa'] = "Multas EP Neto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $multa = $this->multa;
   $sStyleHidden_multa = '';
   if (isset($this->nmgp_cmp_hidden['multa']) && $this->nmgp_cmp_hidden['multa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['multa']);
       $sStyleHidden_multa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_multa = 'display: none;';
   $sStyleReadInp_multa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['multa']) && $this->nmgp_cmp_readonly['multa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['multa']);
       $sStyleReadLab_multa = '';
       $sStyleReadInp_multa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['multa']) && $this->nmgp_cmp_hidden['multa'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="multa" value="<?php echo $this->form_encode_input($multa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_multa_line" id="hidden_field_data_multa" style="<?php echo $sStyleHidden_multa; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_multa_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_multa_label" style=""><span id="id_label_multa"><?php echo $this->nm_new_label['multa']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["multa"]) &&  $this->nmgp_cmp_readonly["multa"] == "on") { 

 ?>
<input type="hidden" name="multa" value="<?php echo $this->form_encode_input($multa) . "\">" . $multa . ""; ?>
<?php } else { ?>
<span id="id_read_on_multa" class="sc-ui-readonly-multa css_multa_line" style="<?php echo $sStyleReadLab_multa; ?>"><?php echo $this->form_format_readonly("multa", $this->form_encode_input($this->multa)); ?></span><span id="id_read_off_multa" class="css_read_off_multa<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_multa; ?>">
 <input class="sc-js-input scFormObjectOdd css_multa_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_multa" type=text name="multa" value="<?php echo $this->form_encode_input($multa) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['multa']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['multa']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['multa']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['multa']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_multa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_multa_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_reajuste_acumulado_neto_dumb = ('' == $sStyleHidden_reajuste_acumulado_neto) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_reajuste_acumulado_neto_dumb" style="<?php echo $sStyleHidden_reajuste_acumulado_neto_dumb; ?>"></TD>
<?php $sStyleHidden_multa_dumb = ('' == $sStyleHidden_multa) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_multa_dumb" style="<?php echo $sStyleHidden_multa_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['retencion_con_iva']))
           {
               $this->nmgp_cmp_readonly['retencion_con_iva'] = 'on';
           }
?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['retencion_acumulada']))
           {
               $this->nmgp_cmp_readonly['retencion_acumulada'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['retencion']))
    {
        $this->nm_new_label['retencion'] = "Retención Período - Neto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $retencion = $this->retencion;
   $sStyleHidden_retencion = '';
   if (isset($this->nmgp_cmp_hidden['retencion']) && $this->nmgp_cmp_hidden['retencion'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['retencion']);
       $sStyleHidden_retencion = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_retencion = 'display: none;';
   $sStyleReadInp_retencion = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['retencion']) && $this->nmgp_cmp_readonly['retencion'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['retencion']);
       $sStyleReadLab_retencion = '';
       $sStyleReadInp_retencion = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['retencion']) && $this->nmgp_cmp_hidden['retencion'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="retencion" value="<?php echo $this->form_encode_input($retencion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_retencion_line" id="hidden_field_data_retencion" style="<?php echo $sStyleHidden_retencion; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_retencion_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_retencion_label" style=""><span id="id_label_retencion"><?php echo $this->nm_new_label['retencion']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["retencion"]) &&  $this->nmgp_cmp_readonly["retencion"] == "on") { 

 ?>
<input type="hidden" name="retencion" value="<?php echo $this->form_encode_input($retencion) . "\">" . $retencion . ""; ?>
<?php } else { ?>
<span id="id_read_on_retencion" class="sc-ui-readonly-retencion css_retencion_line" style="<?php echo $sStyleReadLab_retencion; ?>"><?php echo $this->form_format_readonly("retencion", $this->form_encode_input($this->retencion)); ?></span><span id="id_read_off_retencion" class="css_read_off_retencion<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_retencion; ?>">
 <input class="sc-js-input scFormObjectOdd css_retencion_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_retencion" type=text name="retencion" value="<?php echo $this->form_encode_input($retencion) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['retencion']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['retencion']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['retencion']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['retencion']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_retencion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_retencion_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['retencion_con_iva']))
    {
        $this->nm_new_label['retencion_con_iva'] = "Retencion Período - Con IVA";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $retencion_con_iva = $this->retencion_con_iva;
   $sStyleHidden_retencion_con_iva = '';
   if (isset($this->nmgp_cmp_hidden['retencion_con_iva']) && $this->nmgp_cmp_hidden['retencion_con_iva'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['retencion_con_iva']);
       $sStyleHidden_retencion_con_iva = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_retencion_con_iva = 'display: none;';
   $sStyleReadInp_retencion_con_iva = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["retencion_con_iva"]) &&  $this->nmgp_cmp_readonly["retencion_con_iva"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['retencion_con_iva']);
       $sStyleReadLab_retencion_con_iva = '';
       $sStyleReadInp_retencion_con_iva = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['retencion_con_iva']) && $this->nmgp_cmp_hidden['retencion_con_iva'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="retencion_con_iva" value="<?php echo $this->form_encode_input($retencion_con_iva) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_retencion_con_iva_line" id="hidden_field_data_retencion_con_iva" style="<?php echo $sStyleHidden_retencion_con_iva; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_retencion_con_iva_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_retencion_con_iva_label" style=""><span id="id_label_retencion_con_iva"><?php echo $this->nm_new_label['retencion_con_iva']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["retencion_con_iva"]) &&  $this->nmgp_cmp_readonly["retencion_con_iva"] == "on")) { 

 ?>
<input type="hidden" name="retencion_con_iva" value="<?php echo $this->form_encode_input($retencion_con_iva) . "\"><span id=\"id_ajax_label_retencion_con_iva\">" . $retencion_con_iva . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_retencion_con_iva" class="sc-ui-readonly-retencion_con_iva css_retencion_con_iva_line" style="<?php echo $sStyleReadLab_retencion_con_iva; ?>"><?php echo $this->form_format_readonly("retencion_con_iva", $this->form_encode_input($this->retencion_con_iva)); ?></span><span id="id_read_off_retencion_con_iva" class="css_read_off_retencion_con_iva<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_retencion_con_iva; ?>">
 <input class="sc-js-input scFormObjectOdd css_retencion_con_iva_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_retencion_con_iva" type=text name="retencion_con_iva" value="<?php echo $this->form_encode_input($retencion_con_iva) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['retencion_con_iva']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['retencion_con_iva']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['retencion_con_iva']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['retencion_con_iva']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_retencion_con_iva_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_retencion_con_iva_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_retencion_dumb = ('' == $sStyleHidden_retencion) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_retencion_dumb" style="<?php echo $sStyleHidden_retencion_dumb; ?>"></TD>
<?php $sStyleHidden_retencion_con_iva_dumb = ('' == $sStyleHidden_retencion_con_iva) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_retencion_con_iva_dumb" style="<?php echo $sStyleHidden_retencion_con_iva_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['total_facturado']))
           {
               $this->nmgp_cmp_readonly['total_facturado'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['retencion_acumulada']))
    {
        $this->nm_new_label['retencion_acumulada'] = "Retención Total Acumulada Neto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $retencion_acumulada = $this->retencion_acumulada;
   $sStyleHidden_retencion_acumulada = '';
   if (isset($this->nmgp_cmp_hidden['retencion_acumulada']) && $this->nmgp_cmp_hidden['retencion_acumulada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['retencion_acumulada']);
       $sStyleHidden_retencion_acumulada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_retencion_acumulada = 'display: none;';
   $sStyleReadInp_retencion_acumulada = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["retencion_acumulada"]) &&  $this->nmgp_cmp_readonly["retencion_acumulada"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['retencion_acumulada']);
       $sStyleReadLab_retencion_acumulada = '';
       $sStyleReadInp_retencion_acumulada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['retencion_acumulada']) && $this->nmgp_cmp_hidden['retencion_acumulada'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="retencion_acumulada" value="<?php echo $this->form_encode_input($retencion_acumulada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_retencion_acumulada_line" id="hidden_field_data_retencion_acumulada" style="<?php echo $sStyleHidden_retencion_acumulada; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_retencion_acumulada_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_retencion_acumulada_label" style=""><span id="id_label_retencion_acumulada"><?php echo $this->nm_new_label['retencion_acumulada']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["retencion_acumulada"]) &&  $this->nmgp_cmp_readonly["retencion_acumulada"] == "on")) { 

 ?>
<input type="hidden" name="retencion_acumulada" value="<?php echo $this->form_encode_input($retencion_acumulada) . "\"><span id=\"id_ajax_label_retencion_acumulada\">" . $retencion_acumulada . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_retencion_acumulada" class="sc-ui-readonly-retencion_acumulada css_retencion_acumulada_line" style="<?php echo $sStyleReadLab_retencion_acumulada; ?>"><?php echo $this->form_format_readonly("retencion_acumulada", $this->form_encode_input($this->retencion_acumulada)); ?></span><span id="id_read_off_retencion_acumulada" class="css_read_off_retencion_acumulada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_retencion_acumulada; ?>">
 <input class="sc-js-input scFormObjectOdd css_retencion_acumulada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_retencion_acumulada" type=text name="retencion_acumulada" value="<?php echo $this->form_encode_input($retencion_acumulada) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['retencion_acumulada']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['retencion_acumulada']['symbol_fmt']; ?>, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['retencion_acumulada']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_retencion_acumulada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_retencion_acumulada_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['total_facturado']))
    {
        $this->nm_new_label['total_facturado'] = "Total A Facturar EP - Neto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $total_facturado = $this->total_facturado;
   $sStyleHidden_total_facturado = '';
   if (isset($this->nmgp_cmp_hidden['total_facturado']) && $this->nmgp_cmp_hidden['total_facturado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['total_facturado']);
       $sStyleHidden_total_facturado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_total_facturado = 'display: none;';
   $sStyleReadInp_total_facturado = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["total_facturado"]) &&  $this->nmgp_cmp_readonly["total_facturado"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['total_facturado']);
       $sStyleReadLab_total_facturado = '';
       $sStyleReadInp_total_facturado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['total_facturado']) && $this->nmgp_cmp_hidden['total_facturado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="total_facturado" value="<?php echo $this->form_encode_input($total_facturado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_total_facturado_line" id="hidden_field_data_total_facturado" style="<?php echo $sStyleHidden_total_facturado; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_total_facturado_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_total_facturado_label" style=""><span id="id_label_total_facturado"><?php echo $this->nm_new_label['total_facturado']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["total_facturado"]) &&  $this->nmgp_cmp_readonly["total_facturado"] == "on")) { 

 ?>
<input type="hidden" name="total_facturado" value="<?php echo $this->form_encode_input($total_facturado) . "\"><span id=\"id_ajax_label_total_facturado\">" . $total_facturado . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_total_facturado" class="sc-ui-readonly-total_facturado css_total_facturado_line" style="<?php echo $sStyleReadLab_total_facturado; ?>"><?php echo $this->form_format_readonly("total_facturado", $this->form_encode_input($this->total_facturado)); ?></span><span id="id_read_off_total_facturado" class="css_read_off_total_facturado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_total_facturado; ?>">
 <input class="sc-js-input scFormObjectOdd css_total_facturado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_total_facturado" type=text name="total_facturado" value="<?php echo $this->form_encode_input($total_facturado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 0, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['total_facturado']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['total_facturado']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['total_facturado']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['total_facturado']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_total_facturado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_total_facturado_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_retencion_acumulada_dumb = ('' == $sStyleHidden_retencion_acumulada) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_retencion_acumulada_dumb" style="<?php echo $sStyleHidden_retencion_acumulada_dumb; ?>"></TD>
<?php $sStyleHidden_total_facturado_dumb = ('' == $sStyleHidden_total_facturado) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_total_facturado_dumb" style="<?php echo $sStyleHidden_total_facturado_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   <td width="20%" height="">
   <a name="bloco_3"></a>
<div id="div_hidden_bloco_3"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf3\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?>Datos Estado De Pago<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['afecta_iva']))
    {
        $this->nm_new_label['afecta_iva'] = "Afecta a IVA";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['afecta_iva']) && $this->nmgp_cmp_hidden['afecta_iva'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="afecta_iva" value="<?php echo $this->form_encode_input($afecta_iva) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_afecta_iva_line" id="hidden_field_data_afecta_iva" style="<?php echo $sStyleHidden_afecta_iva; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_afecta_iva_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_afecta_iva_label" style=""><span id="id_label_afecta_iva"><?php echo $this->nm_new_label['afecta_iva']; ?></span></span><br><span id="id_ajax_label_afecta_iva"><?php echo $afecta_iva?></span>
<input type="hidden" name="afecta_iva" value="<?php echo $this->form_encode_input($afecta_iva); ?>">
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_afecta_iva_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_afecta_iva_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['existe_retencion']))
    {
        $this->nm_new_label['existe_retencion'] = "Existe Retención ?";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['existe_retencion']) && $this->nmgp_cmp_hidden['existe_retencion'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="existe_retencion" value="<?php echo $this->form_encode_input($existe_retencion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_existe_retencion_line" id="hidden_field_data_existe_retencion" style="<?php echo $sStyleHidden_existe_retencion; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_existe_retencion_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_existe_retencion_label" style=""><span id="id_label_existe_retencion"><?php echo $this->nm_new_label['existe_retencion']; ?></span></span><br><span id="id_ajax_label_existe_retencion"><?php echo $existe_retencion?></span>
<input type="hidden" name="existe_retencion" value="<?php echo $this->form_encode_input($existe_retencion); ?>">
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_existe_retencion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_existe_retencion_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_afecta_iva_dumb = ('' == $sStyleHidden_afecta_iva) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_afecta_iva_dumb" style="<?php echo $sStyleHidden_afecta_iva_dumb; ?>"></TD>
<?php $sStyleHidden_existe_retencion_dumb = ('' == $sStyleHidden_existe_retencion) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_existe_retencion_dumb" style="<?php echo $sStyleHidden_existe_retencion_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['incluye_retencion']))
    {
        $this->nm_new_label['incluye_retencion'] = "Factura Incluye Retención ?";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['incluye_retencion']) && $this->nmgp_cmp_hidden['incluye_retencion'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="incluye_retencion" value="<?php echo $this->form_encode_input($incluye_retencion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_incluye_retencion_line" id="hidden_field_data_incluye_retencion" style="<?php echo $sStyleHidden_incluye_retencion; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_incluye_retencion_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_incluye_retencion_label" style=""><span id="id_label_incluye_retencion"><?php echo $this->nm_new_label['incluye_retencion']; ?></span></span><br><span id="id_ajax_label_incluye_retencion"><?php echo $incluye_retencion?></span>
<input type="hidden" name="incluye_retencion" value="<?php echo $this->form_encode_input($incluye_retencion); ?>">
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_incluye_retencion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_incluye_retencion_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['considera_retencion']))
   {
       $this->nm_new_label['considera_retencion'] = "Retención Pertenece Al Período Informado ?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $considera_retencion = $this->considera_retencion;
   $sStyleHidden_considera_retencion = '';
   if (isset($this->nmgp_cmp_hidden['considera_retencion']) && $this->nmgp_cmp_hidden['considera_retencion'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['considera_retencion']);
       $sStyleHidden_considera_retencion = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_considera_retencion = 'display: none;';
   $sStyleReadInp_considera_retencion = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['considera_retencion']) && $this->nmgp_cmp_readonly['considera_retencion'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['considera_retencion']);
       $sStyleReadLab_considera_retencion = '';
       $sStyleReadInp_considera_retencion = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['considera_retencion']) && $this->nmgp_cmp_hidden['considera_retencion'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="considera_retencion" value="<?php echo $this->form_encode_input($this->considera_retencion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_considera_retencion_line" id="hidden_field_data_considera_retencion" style="<?php echo $sStyleHidden_considera_retencion; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_considera_retencion_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_considera_retencion_label" style=""><span id="id_label_considera_retencion"><?php echo $this->nm_new_label['considera_retencion']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["considera_retencion"]) &&  $this->nmgp_cmp_readonly["considera_retencion"] == "on") { 

$considera_retencion_look = "";
 if ($this->considera_retencion == "0") { $considera_retencion_look .= "NO" ;} 
 if ($this->considera_retencion == "1") { $considera_retencion_look .= "SI" ;} 
 if (empty($considera_retencion_look)) { $considera_retencion_look = $this->considera_retencion; }
?>
<input type="hidden" name="considera_retencion" value="<?php echo $this->form_encode_input($considera_retencion) . "\">" . $considera_retencion_look . ""; ?>
<?php } else { ?>
<?php

$considera_retencion_look = "";
 if ($this->considera_retencion == "0") { $considera_retencion_look .= "NO" ;} 
 if ($this->considera_retencion == "1") { $considera_retencion_look .= "SI" ;} 
 if (empty($considera_retencion_look)) { $considera_retencion_look = $this->considera_retencion; }
?>
<span id="id_read_on_considera_retencion" class="css_considera_retencion_line"  style="<?php echo $sStyleReadLab_considera_retencion; ?>"><?php echo $this->form_format_readonly("considera_retencion", $this->form_encode_input($considera_retencion_look)); ?></span><span id="id_read_off_considera_retencion" class="css_read_off_considera_retencion<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_considera_retencion; ?>">
 <span id="idAjaxSelect_considera_retencion" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_considera_retencion_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_considera_retencion" name="considera_retencion" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->considera_retencion == "0") { echo " selected" ;} ?>>NO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_considera_retencion'][] = '0'; ?>
 <option  value="1" <?php  if ($this->considera_retencion == "1") { echo " selected" ;} ?>>SI</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_considera_retencion'][] = '1'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_considera_retencion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_considera_retencion_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_incluye_retencion_dumb = ('' == $sStyleHidden_incluye_retencion) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_incluye_retencion_dumb" style="<?php echo $sStyleHidden_incluye_retencion_dumb; ?>"></TD>
<?php $sStyleHidden_considera_retencion_dumb = ('' == $sStyleHidden_considera_retencion) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_considera_retencion_dumb" style="<?php echo $sStyleHidden_considera_retencion_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['facturado']))
   {
       $this->nm_new_label['facturado'] = "Estado De Facturación";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $facturado = $this->facturado;
   $sStyleHidden_facturado = '';
   if (isset($this->nmgp_cmp_hidden['facturado']) && $this->nmgp_cmp_hidden['facturado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['facturado']);
       $sStyleHidden_facturado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_facturado = 'display: none;';
   $sStyleReadInp_facturado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['facturado']) && $this->nmgp_cmp_readonly['facturado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['facturado']);
       $sStyleReadLab_facturado = '';
       $sStyleReadInp_facturado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['facturado']) && $this->nmgp_cmp_hidden['facturado'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="facturado" value="<?php echo $this->form_encode_input($this->facturado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_facturado_line" id="hidden_field_data_facturado" style="<?php echo $sStyleHidden_facturado; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_facturado_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_facturado_label" style=""><span id="id_label_facturado"><?php echo $this->nm_new_label['facturado']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["facturado"]) &&  $this->nmgp_cmp_readonly["facturado"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT    prod_estado_facturacion.valor_estado,   prod_estado_facturacion.estado FROM   prod_estado_facturacion WHERE   prod_estado_facturacion.grupo = '" . $_SESSION['group_name'] . "'";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'][] = $rs->fields[0];
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
   $facturado_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->facturado_1))
          {
              foreach ($this->facturado_1 as $tmp_facturado)
              {
                  if (trim($tmp_facturado) === trim($cadaselect[1])) { $facturado_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->facturado) === trim($cadaselect[1])) { $facturado_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="facturado" value="<?php echo $this->form_encode_input($facturado) . "\">" . $facturado_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_facturado();
   $x = 0 ; 
   $facturado_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->facturado_1))
          {
              foreach ($this->facturado_1 as $tmp_facturado)
              {
                  if (trim($tmp_facturado) === trim($cadaselect[1])) { $facturado_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->facturado) === trim($cadaselect[1])) { $facturado_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($facturado_look))
          {
              $facturado_look = $this->facturado;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_facturado\" class=\"css_facturado_line\" style=\"" .  $sStyleReadLab_facturado . "\">" . $this->form_format_readonly("facturado", $this->form_encode_input($facturado_look)) . "</span><span id=\"id_read_off_facturado\" class=\"css_read_off_facturado" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_facturado . "\">";
   echo " <span id=\"idAjaxSelect_facturado\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_facturado_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_facturado\" name=\"facturado\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_facturado'][] = '0'; 
   echo "  <option value=\"0\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->facturado) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->facturado)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_facturado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_facturado_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['observaciones_solicitud']))
    {
        $this->nm_new_label['observaciones_solicitud'] = "Observaciones Estado Facturación";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $observaciones_solicitud = $this->observaciones_solicitud;
   $sStyleHidden_observaciones_solicitud = '';
   if (isset($this->nmgp_cmp_hidden['observaciones_solicitud']) && $this->nmgp_cmp_hidden['observaciones_solicitud'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['observaciones_solicitud']);
       $sStyleHidden_observaciones_solicitud = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_observaciones_solicitud = 'display: none;';
   $sStyleReadInp_observaciones_solicitud = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['observaciones_solicitud']) && $this->nmgp_cmp_readonly['observaciones_solicitud'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['observaciones_solicitud']);
       $sStyleReadLab_observaciones_solicitud = '';
       $sStyleReadInp_observaciones_solicitud = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['observaciones_solicitud']) && $this->nmgp_cmp_hidden['observaciones_solicitud'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="observaciones_solicitud" value="<?php echo $this->form_encode_input($observaciones_solicitud) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_observaciones_solicitud_line" id="hidden_field_data_observaciones_solicitud" style="<?php echo $sStyleHidden_observaciones_solicitud; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_observaciones_solicitud_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_observaciones_solicitud_label" style=""><span id="id_label_observaciones_solicitud"><?php echo $this->nm_new_label['observaciones_solicitud']; ?></span></span><br>
<?php
$observaciones_solicitud_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($observaciones_solicitud));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["observaciones_solicitud"]) &&  $this->nmgp_cmp_readonly["observaciones_solicitud"] == "on") { 

 ?>
<input type="hidden" name="observaciones_solicitud" value="<?php echo $this->form_encode_input($observaciones_solicitud) . "\">" . $observaciones_solicitud_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_observaciones_solicitud" class="sc-ui-readonly-observaciones_solicitud css_observaciones_solicitud_line" style="<?php echo $sStyleReadLab_observaciones_solicitud; ?>"><?php echo $this->form_format_readonly("observaciones_solicitud", $this->form_encode_input($observaciones_solicitud_val)); ?></span><span id="id_read_off_observaciones_solicitud" class="css_read_off_observaciones_solicitud<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observaciones_solicitud; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_observaciones_solicitud_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="observaciones_solicitud" id="id_sc_field_observaciones_solicitud" rows="10" cols="50"
 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $observaciones_solicitud; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_observaciones_solicitud_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_observaciones_solicitud_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_facturado_dumb = ('' == $sStyleHidden_facturado) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_facturado_dumb" style="<?php echo $sStyleHidden_facturado_dumb; ?>"></TD>
<?php $sStyleHidden_observaciones_solicitud_dumb = ('' == $sStyleHidden_observaciones_solicitud) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_observaciones_solicitud_dumb" style="<?php echo $sStyleHidden_observaciones_solicitud_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_4"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="20%" height="">
<div id="div_hidden_bloco_4"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_4" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf4\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?>Propiedades De Facturación<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['cliente']))
   {
       $this->nm_new_label['cliente'] = "Cliente";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliente = $this->cliente;
   $sStyleHidden_cliente = '';
   if (isset($this->nmgp_cmp_hidden['cliente']) && $this->nmgp_cmp_hidden['cliente'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliente']);
       $sStyleHidden_cliente = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliente = 'display: none;';
   $sStyleReadInp_cliente = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliente']) && $this->nmgp_cmp_readonly['cliente'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliente']);
       $sStyleReadLab_cliente = '';
       $sStyleReadInp_cliente = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliente']) && $this->nmgp_cmp_hidden['cliente'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="cliente" value="<?php echo $this->form_encode_input($this->cliente) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_cliente_line" id="hidden_field_data_cliente" style="<?php echo $sStyleHidden_cliente; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliente_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_cliente_label" style=""><span id="id_label_cliente"><?php echo $this->nm_new_label['cliente']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['cliente']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['php_cmp_required']['cliente'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliente"]) &&  $this->nmgp_cmp_readonly["cliente"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT  prod_clientes.nombre,   prod_clientes.nombre  FROM   proyectos   INNER JOIN prod_clientes ON (proyectos.id_cliente = prod_clientes.id) WHERE   proyectos.id=" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente'][] = $rs->fields[0];
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
   $cliente_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_1))
          {
              foreach ($this->cliente_1 as $tmp_cliente)
              {
                  if (trim($tmp_cliente) === trim($cadaselect[1])) { $cliente_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente) === trim($cadaselect[1])) { $cliente_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="cliente" value="<?php echo $this->form_encode_input($cliente) . "\">" . $cliente_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_cliente();
   $x = 0 ; 
   $cliente_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_1))
          {
              foreach ($this->cliente_1 as $tmp_cliente)
              {
                  if (trim($tmp_cliente) === trim($cadaselect[1])) { $cliente_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente) === trim($cadaselect[1])) { $cliente_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($cliente_look))
          {
              $cliente_look = $this->cliente;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_cliente\" class=\"css_cliente_line\" style=\"" .  $sStyleReadLab_cliente . "\">" . $this->form_format_readonly("cliente", $this->form_encode_input($cliente_look)) . "</span><span id=\"id_read_off_cliente\" class=\"css_read_off_cliente" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_cliente . "\">";
   echo " <span id=\"idAjaxSelect_cliente\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_cliente_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_cliente\" name=\"cliente\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->cliente) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->cliente)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliente_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliente_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['cliente_rut']))
   {
       $this->nm_new_label['cliente_rut'] = "RUT ";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliente_rut = $this->cliente_rut;
   $sStyleHidden_cliente_rut = '';
   if (isset($this->nmgp_cmp_hidden['cliente_rut']) && $this->nmgp_cmp_hidden['cliente_rut'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliente_rut']);
       $sStyleHidden_cliente_rut = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliente_rut = 'display: none;';
   $sStyleReadInp_cliente_rut = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliente_rut']) && $this->nmgp_cmp_readonly['cliente_rut'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliente_rut']);
       $sStyleReadLab_cliente_rut = '';
       $sStyleReadInp_cliente_rut = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliente_rut']) && $this->nmgp_cmp_hidden['cliente_rut'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="cliente_rut" value="<?php echo $this->form_encode_input($this->cliente_rut) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_cliente_rut_line" id="hidden_field_data_cliente_rut" style="<?php echo $sStyleHidden_cliente_rut; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliente_rut_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_cliente_rut_label" style=""><span id="id_label_cliente_rut"><?php echo $this->nm_new_label['cliente_rut']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliente_rut"]) &&  $this->nmgp_cmp_readonly["cliente_rut"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_rut']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_rut'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_rut']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_rut'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_rut']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_rut'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_rut']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_rut'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT  prod_clientes.rut,   prod_clientes.rut FROM   proyectos   INNER JOIN prod_clientes ON (proyectos.id_cliente = prod_clientes.id) WHERE   proyectos.id=" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_rut'][] = $rs->fields[0];
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
   $cliente_rut_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_rut_1))
          {
              foreach ($this->cliente_rut_1 as $tmp_cliente_rut)
              {
                  if (trim($tmp_cliente_rut) === trim($cadaselect[1])) { $cliente_rut_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_rut) === trim($cadaselect[1])) { $cliente_rut_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="cliente_rut" value="<?php echo $this->form_encode_input($cliente_rut) . "\">" . $cliente_rut_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_cliente_rut();
   $x = 0 ; 
   $cliente_rut_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_rut_1))
          {
              foreach ($this->cliente_rut_1 as $tmp_cliente_rut)
              {
                  if (trim($tmp_cliente_rut) === trim($cadaselect[1])) { $cliente_rut_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_rut) === trim($cadaselect[1])) { $cliente_rut_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($cliente_rut_look))
          {
              $cliente_rut_look = $this->cliente_rut;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_cliente_rut\" class=\"css_cliente_rut_line\" style=\"" .  $sStyleReadLab_cliente_rut . "\">" . $this->form_format_readonly("cliente_rut", $this->form_encode_input($cliente_rut_look)) . "</span><span id=\"id_read_off_cliente_rut\" class=\"css_read_off_cliente_rut" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_cliente_rut . "\">";
   echo " <span id=\"idAjaxSelect_cliente_rut\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_cliente_rut_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_cliente_rut\" name=\"cliente_rut\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->cliente_rut) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->cliente_rut)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliente_rut_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliente_rut_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['cliente_giro']))
   {
       $this->nm_new_label['cliente_giro'] = "Giro";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliente_giro = $this->cliente_giro;
   $sStyleHidden_cliente_giro = '';
   if (isset($this->nmgp_cmp_hidden['cliente_giro']) && $this->nmgp_cmp_hidden['cliente_giro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliente_giro']);
       $sStyleHidden_cliente_giro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliente_giro = 'display: none;';
   $sStyleReadInp_cliente_giro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliente_giro']) && $this->nmgp_cmp_readonly['cliente_giro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliente_giro']);
       $sStyleReadLab_cliente_giro = '';
       $sStyleReadInp_cliente_giro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliente_giro']) && $this->nmgp_cmp_hidden['cliente_giro'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="cliente_giro" value="<?php echo $this->form_encode_input($this->cliente_giro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_cliente_giro_line" id="hidden_field_data_cliente_giro" style="<?php echo $sStyleHidden_cliente_giro; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliente_giro_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_cliente_giro_label" style=""><span id="id_label_cliente_giro"><?php echo $this->nm_new_label['cliente_giro']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliente_giro"]) &&  $this->nmgp_cmp_readonly["cliente_giro"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_giro']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_giro'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_giro']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_giro'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_giro']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_giro'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_giro']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_giro'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT  prod_clientes.giro,   prod_clientes.giro FROM   proyectos   INNER JOIN prod_clientes ON (proyectos.id_cliente = prod_clientes.id) WHERE   proyectos.id=" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_giro'][] = $rs->fields[0];
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
   $cliente_giro_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_giro_1))
          {
              foreach ($this->cliente_giro_1 as $tmp_cliente_giro)
              {
                  if (trim($tmp_cliente_giro) === trim($cadaselect[1])) { $cliente_giro_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_giro) === trim($cadaselect[1])) { $cliente_giro_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="cliente_giro" value="<?php echo $this->form_encode_input($cliente_giro) . "\">" . $cliente_giro_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_cliente_giro();
   $x = 0 ; 
   $cliente_giro_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_giro_1))
          {
              foreach ($this->cliente_giro_1 as $tmp_cliente_giro)
              {
                  if (trim($tmp_cliente_giro) === trim($cadaselect[1])) { $cliente_giro_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_giro) === trim($cadaselect[1])) { $cliente_giro_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($cliente_giro_look))
          {
              $cliente_giro_look = $this->cliente_giro;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_cliente_giro\" class=\"css_cliente_giro_line\" style=\"" .  $sStyleReadLab_cliente_giro . "\">" . $this->form_format_readonly("cliente_giro", $this->form_encode_input($cliente_giro_look)) . "</span><span id=\"id_read_off_cliente_giro\" class=\"css_read_off_cliente_giro" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_cliente_giro . "\">";
   echo " <span id=\"idAjaxSelect_cliente_giro\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_cliente_giro_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_cliente_giro\" name=\"cliente_giro\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->cliente_giro) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->cliente_giro)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliente_giro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliente_giro_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['cliente_direccion']))
   {
       $this->nm_new_label['cliente_direccion'] = "Dirección";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliente_direccion = $this->cliente_direccion;
   $sStyleHidden_cliente_direccion = '';
   if (isset($this->nmgp_cmp_hidden['cliente_direccion']) && $this->nmgp_cmp_hidden['cliente_direccion'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliente_direccion']);
       $sStyleHidden_cliente_direccion = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliente_direccion = 'display: none;';
   $sStyleReadInp_cliente_direccion = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliente_direccion']) && $this->nmgp_cmp_readonly['cliente_direccion'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliente_direccion']);
       $sStyleReadLab_cliente_direccion = '';
       $sStyleReadInp_cliente_direccion = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliente_direccion']) && $this->nmgp_cmp_hidden['cliente_direccion'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="cliente_direccion" value="<?php echo $this->form_encode_input($this->cliente_direccion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_cliente_direccion_line" id="hidden_field_data_cliente_direccion" style="<?php echo $sStyleHidden_cliente_direccion; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliente_direccion_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_cliente_direccion_label" style=""><span id="id_label_cliente_direccion"><?php echo $this->nm_new_label['cliente_direccion']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliente_direccion"]) &&  $this->nmgp_cmp_readonly["cliente_direccion"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_direccion']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_direccion'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_direccion']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_direccion'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_direccion']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_direccion'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_direccion']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_direccion'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT  prod_clientes.direccion,   prod_clientes.direccion FROM   proyectos   INNER JOIN prod_clientes ON (proyectos.id_cliente = prod_clientes.id) WHERE   proyectos.id=" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_direccion'][] = $rs->fields[0];
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
   $cliente_direccion_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_direccion_1))
          {
              foreach ($this->cliente_direccion_1 as $tmp_cliente_direccion)
              {
                  if (trim($tmp_cliente_direccion) === trim($cadaselect[1])) { $cliente_direccion_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_direccion) === trim($cadaselect[1])) { $cliente_direccion_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="cliente_direccion" value="<?php echo $this->form_encode_input($cliente_direccion) . "\">" . $cliente_direccion_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_cliente_direccion();
   $x = 0 ; 
   $cliente_direccion_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_direccion_1))
          {
              foreach ($this->cliente_direccion_1 as $tmp_cliente_direccion)
              {
                  if (trim($tmp_cliente_direccion) === trim($cadaselect[1])) { $cliente_direccion_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_direccion) === trim($cadaselect[1])) { $cliente_direccion_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($cliente_direccion_look))
          {
              $cliente_direccion_look = $this->cliente_direccion;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_cliente_direccion\" class=\"css_cliente_direccion_line\" style=\"" .  $sStyleReadLab_cliente_direccion . "\">" . $this->form_format_readonly("cliente_direccion", $this->form_encode_input($cliente_direccion_look)) . "</span><span id=\"id_read_off_cliente_direccion\" class=\"css_read_off_cliente_direccion" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_cliente_direccion . "\">";
   echo " <span id=\"idAjaxSelect_cliente_direccion\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_cliente_direccion_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_cliente_direccion\" name=\"cliente_direccion\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->cliente_direccion) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->cliente_direccion)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliente_direccion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliente_direccion_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['cliente_contacto']))
   {
       $this->nm_new_label['cliente_contacto'] = "Contacto";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliente_contacto = $this->cliente_contacto;
   $sStyleHidden_cliente_contacto = '';
   if (isset($this->nmgp_cmp_hidden['cliente_contacto']) && $this->nmgp_cmp_hidden['cliente_contacto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliente_contacto']);
       $sStyleHidden_cliente_contacto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliente_contacto = 'display: none;';
   $sStyleReadInp_cliente_contacto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliente_contacto']) && $this->nmgp_cmp_readonly['cliente_contacto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliente_contacto']);
       $sStyleReadLab_cliente_contacto = '';
       $sStyleReadInp_cliente_contacto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliente_contacto']) && $this->nmgp_cmp_hidden['cliente_contacto'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="cliente_contacto" value="<?php echo $this->form_encode_input($this->cliente_contacto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_cliente_contacto_line" id="hidden_field_data_cliente_contacto" style="<?php echo $sStyleHidden_cliente_contacto; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliente_contacto_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_cliente_contacto_label" style=""><span id="id_label_cliente_contacto"><?php echo $this->nm_new_label['cliente_contacto']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliente_contacto"]) &&  $this->nmgp_cmp_readonly["cliente_contacto"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_contacto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_contacto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_contacto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_contacto'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_contacto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_contacto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_contacto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_contacto'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT  prod_clientes.contacto,   prod_clientes.contacto  FROM   proyectos   INNER JOIN prod_clientes ON (proyectos.id_cliente = prod_clientes.id) WHERE   proyectos.id=" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_contacto'][] = $rs->fields[0];
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
   $cliente_contacto_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_contacto_1))
          {
              foreach ($this->cliente_contacto_1 as $tmp_cliente_contacto)
              {
                  if (trim($tmp_cliente_contacto) === trim($cadaselect[1])) { $cliente_contacto_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_contacto) === trim($cadaselect[1])) { $cliente_contacto_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="cliente_contacto" value="<?php echo $this->form_encode_input($cliente_contacto) . "\">" . $cliente_contacto_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_cliente_contacto();
   $x = 0 ; 
   $cliente_contacto_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_contacto_1))
          {
              foreach ($this->cliente_contacto_1 as $tmp_cliente_contacto)
              {
                  if (trim($tmp_cliente_contacto) === trim($cadaselect[1])) { $cliente_contacto_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_contacto) === trim($cadaselect[1])) { $cliente_contacto_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($cliente_contacto_look))
          {
              $cliente_contacto_look = $this->cliente_contacto;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_cliente_contacto\" class=\"css_cliente_contacto_line\" style=\"" .  $sStyleReadLab_cliente_contacto . "\">" . $this->form_format_readonly("cliente_contacto", $this->form_encode_input($cliente_contacto_look)) . "</span><span id=\"id_read_off_cliente_contacto\" class=\"css_read_off_cliente_contacto" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_cliente_contacto . "\">";
   echo " <span id=\"idAjaxSelect_cliente_contacto\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_cliente_contacto_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_cliente_contacto\" name=\"cliente_contacto\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->cliente_contacto) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->cliente_contacto)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliente_contacto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliente_contacto_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['monto_real_facturacion']))
           {
               $this->nmgp_cmp_readonly['monto_real_facturacion'] = 'on';
           }
?>


   <?php
   if (!isset($this->nm_new_label['cliente_email']))
   {
       $this->nm_new_label['cliente_email'] = "Email";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliente_email = $this->cliente_email;
   $sStyleHidden_cliente_email = '';
   if (isset($this->nmgp_cmp_hidden['cliente_email']) && $this->nmgp_cmp_hidden['cliente_email'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliente_email']);
       $sStyleHidden_cliente_email = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliente_email = 'display: none;';
   $sStyleReadInp_cliente_email = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliente_email']) && $this->nmgp_cmp_readonly['cliente_email'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliente_email']);
       $sStyleReadLab_cliente_email = '';
       $sStyleReadInp_cliente_email = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliente_email']) && $this->nmgp_cmp_hidden['cliente_email'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="cliente_email" value="<?php echo $this->form_encode_input($this->cliente_email) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_cliente_email_line" id="hidden_field_data_cliente_email" style="<?php echo $sStyleHidden_cliente_email; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliente_email_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_cliente_email_label" style=""><span id="id_label_cliente_email"><?php echo $this->nm_new_label['cliente_email']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliente_email"]) &&  $this->nmgp_cmp_readonly["cliente_email"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_email']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_email'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_email']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_email'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_email']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_email'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_email']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_email'] = array(); 
    }

   $old_value_id = $this->id;
   $old_value_monto_contrato = $this->monto_contrato;
   $old_value_fecha_desde = $this->fecha_desde;
   $old_value_fecha_hasta = $this->fecha_hasta;
   $old_value_dias_desde = $this->dias_desde;
   $old_value_dias_hasta = $this->dias_hasta;
   $old_value_dias_periodo = $this->dias_periodo;
   $old_value_fecha_desde_factura = $this->fecha_desde_factura;
   $old_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $old_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $old_value_produccion_neto = $this->produccion_neto;
   $old_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $old_value_multa = $this->multa;
   $old_value_retencion = $this->retencion;
   $old_value_retencion_con_iva = $this->retencion_con_iva;
   $old_value_retencion_acumulada = $this->retencion_acumulada;
   $old_value_total_facturado = $this->total_facturado;
   $old_value_monto_real_facturacion = $this->monto_real_facturacion;
   $old_value_monto_uf = $this->monto_uf;
   $old_value_iva = $this->iva;
   $old_value_fecha = $this->fecha;
   $old_value_valor_uf = $this->valor_uf;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id = $this->id;
   $unformatted_value_monto_contrato = $this->monto_contrato;
   $unformatted_value_fecha_desde = $this->fecha_desde;
   $unformatted_value_fecha_hasta = $this->fecha_hasta;
   $unformatted_value_dias_desde = $this->dias_desde;
   $unformatted_value_dias_hasta = $this->dias_hasta;
   $unformatted_value_dias_periodo = $this->dias_periodo;
   $unformatted_value_fecha_desde_factura = $this->fecha_desde_factura;
   $unformatted_value_fecha_hasta_factura = $this->fecha_hasta_factura;
   $unformatted_value_avance_informado_con_iva = $this->avance_informado_con_iva;
   $unformatted_value_produccion_neto = $this->produccion_neto;
   $unformatted_value_reajuste_acumulado_neto = $this->reajuste_acumulado_neto;
   $unformatted_value_multa = $this->multa;
   $unformatted_value_retencion = $this->retencion;
   $unformatted_value_retencion_con_iva = $this->retencion_con_iva;
   $unformatted_value_retencion_acumulada = $this->retencion_acumulada;
   $unformatted_value_total_facturado = $this->total_facturado;
   $unformatted_value_monto_real_facturacion = $this->monto_real_facturacion;
   $unformatted_value_monto_uf = $this->monto_uf;
   $unformatted_value_iva = $this->iva;
   $unformatted_value_fecha = $this->fecha;
   $unformatted_value_valor_uf = $this->valor_uf;

   $nm_comando = "SELECT  prod_clientes.email,   prod_clientes.email  FROM   proyectos   INNER JOIN prod_clientes ON (proyectos.id_cliente = prod_clientes.id) WHERE   proyectos.id=" . $_SESSION['id_proyecto'] . "";

   $this->id = $old_value_id;
   $this->monto_contrato = $old_value_monto_contrato;
   $this->fecha_desde = $old_value_fecha_desde;
   $this->fecha_hasta = $old_value_fecha_hasta;
   $this->dias_desde = $old_value_dias_desde;
   $this->dias_hasta = $old_value_dias_hasta;
   $this->dias_periodo = $old_value_dias_periodo;
   $this->fecha_desde_factura = $old_value_fecha_desde_factura;
   $this->fecha_hasta_factura = $old_value_fecha_hasta_factura;
   $this->avance_informado_con_iva = $old_value_avance_informado_con_iva;
   $this->produccion_neto = $old_value_produccion_neto;
   $this->reajuste_acumulado_neto = $old_value_reajuste_acumulado_neto;
   $this->multa = $old_value_multa;
   $this->retencion = $old_value_retencion;
   $this->retencion_con_iva = $old_value_retencion_con_iva;
   $this->retencion_acumulada = $old_value_retencion_acumulada;
   $this->total_facturado = $old_value_total_facturado;
   $this->monto_real_facturacion = $old_value_monto_real_facturacion;
   $this->monto_uf = $old_value_monto_uf;
   $this->iva = $old_value_iva;
   $this->fecha = $old_value_fecha;
   $this->valor_uf = $old_value_valor_uf;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['Lookup_cliente_email'][] = $rs->fields[0];
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
   $cliente_email_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_email_1))
          {
              foreach ($this->cliente_email_1 as $tmp_cliente_email)
              {
                  if (trim($tmp_cliente_email) === trim($cadaselect[1])) { $cliente_email_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_email) === trim($cadaselect[1])) { $cliente_email_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="cliente_email" value="<?php echo $this->form_encode_input($cliente_email) . "\">" . $cliente_email_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_cliente_email();
   $x = 0 ; 
   $cliente_email_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliente_email_1))
          {
              foreach ($this->cliente_email_1 as $tmp_cliente_email)
              {
                  if (trim($tmp_cliente_email) === trim($cadaselect[1])) { $cliente_email_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliente_email) === trim($cadaselect[1])) { $cliente_email_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($cliente_email_look))
          {
              $cliente_email_look = $this->cliente_email;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_cliente_email\" class=\"css_cliente_email_line\" style=\"" .  $sStyleReadLab_cliente_email . "\">" . $this->form_format_readonly("cliente_email", $this->form_encode_input($cliente_email_look)) . "</span><span id=\"id_read_off_cliente_email\" class=\"css_read_off_cliente_email" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_cliente_email . "\">";
   echo " <span id=\"idAjaxSelect_cliente_email\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_cliente_email_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_cliente_email\" name=\"cliente_email\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->cliente_email) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->cliente_email)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliente_email_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliente_email_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_cliente_email_dumb = ('' == $sStyleHidden_cliente_email) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_cliente_email_dumb" style="<?php echo $sStyleHidden_cliente_email_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   <td width="60%" height="">
   <a name="bloco_5"></a>
<div id="div_hidden_bloco_5"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_5" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf5\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?>Datos Facturación<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['monto_real_facturacion']))
    {
        $this->nm_new_label['monto_real_facturacion'] = "Monto Neto A Facturar";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $monto_real_facturacion = $this->monto_real_facturacion;
   $sStyleHidden_monto_real_facturacion = '';
   if (isset($this->nmgp_cmp_hidden['monto_real_facturacion']) && $this->nmgp_cmp_hidden['monto_real_facturacion'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['monto_real_facturacion']);
       $sStyleHidden_monto_real_facturacion = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_monto_real_facturacion = 'display: none;';
   $sStyleReadInp_monto_real_facturacion = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["monto_real_facturacion"]) &&  $this->nmgp_cmp_readonly["monto_real_facturacion"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['monto_real_facturacion']);
       $sStyleReadLab_monto_real_facturacion = '';
       $sStyleReadInp_monto_real_facturacion = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['monto_real_facturacion']) && $this->nmgp_cmp_hidden['monto_real_facturacion'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="monto_real_facturacion" value="<?php echo $this->form_encode_input($monto_real_facturacion) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_monto_real_facturacion_line" id="hidden_field_data_monto_real_facturacion" style="<?php echo $sStyleHidden_monto_real_facturacion; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_monto_real_facturacion_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_monto_real_facturacion_label" style=""><span id="id_label_monto_real_facturacion"><?php echo $this->nm_new_label['monto_real_facturacion']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["monto_real_facturacion"]) &&  $this->nmgp_cmp_readonly["monto_real_facturacion"] == "on")) { 

 ?>
<input type="hidden" name="monto_real_facturacion" value="<?php echo $this->form_encode_input($monto_real_facturacion) . "\"><span id=\"id_ajax_label_monto_real_facturacion\">" . $monto_real_facturacion . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_monto_real_facturacion" class="sc-ui-readonly-monto_real_facturacion css_monto_real_facturacion_line" style="<?php echo $sStyleReadLab_monto_real_facturacion; ?>"><?php echo $this->form_format_readonly("monto_real_facturacion", $this->form_encode_input($this->monto_real_facturacion)); ?></span><span id="id_read_off_monto_real_facturacion" class="css_read_off_monto_real_facturacion<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_monto_real_facturacion; ?>">
 <input class="sc-js-input scFormObjectOdd css_monto_real_facturacion_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_monto_real_facturacion" type=text name="monto_real_facturacion" value="<?php echo $this->form_encode_input($monto_real_facturacion) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['monto_real_facturacion']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['monto_real_facturacion']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['monto_real_facturacion']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['monto_real_facturacion']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_monto_real_facturacion_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_monto_real_facturacion_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['monto_uf']))
    {
        $this->nm_new_label['monto_uf'] = "Monto Neto Real A Facturar";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $monto_uf = $this->monto_uf;
   $sStyleHidden_monto_uf = '';
   if (isset($this->nmgp_cmp_hidden['monto_uf']) && $this->nmgp_cmp_hidden['monto_uf'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['monto_uf']);
       $sStyleHidden_monto_uf = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_monto_uf = 'display: none;';
   $sStyleReadInp_monto_uf = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['monto_uf']) && $this->nmgp_cmp_readonly['monto_uf'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['monto_uf']);
       $sStyleReadLab_monto_uf = '';
       $sStyleReadInp_monto_uf = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['monto_uf']) && $this->nmgp_cmp_hidden['monto_uf'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="monto_uf" value="<?php echo $this->form_encode_input($monto_uf) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_monto_uf_line" id="hidden_field_data_monto_uf" style="<?php echo $sStyleHidden_monto_uf; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_monto_uf_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_monto_uf_label" style=""><span id="id_label_monto_uf"><?php echo $this->nm_new_label['monto_uf']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["monto_uf"]) &&  $this->nmgp_cmp_readonly["monto_uf"] == "on") { 

 ?>
<input type="hidden" name="monto_uf" value="<?php echo $this->form_encode_input($monto_uf) . "\">" . $monto_uf . ""; ?>
<?php } else { ?>
<span id="id_read_on_monto_uf" class="sc-ui-readonly-monto_uf css_monto_uf_line" style="<?php echo $sStyleReadLab_monto_uf; ?>"><?php echo $this->form_format_readonly("monto_uf", $this->form_encode_input($this->monto_uf)); ?></span><span id="id_read_off_monto_uf" class="css_read_off_monto_uf<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_monto_uf; ?>">
 <input class="sc-js-input scFormObjectOdd css_monto_uf_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_monto_uf" type=text name="monto_uf" value="<?php echo $this->form_encode_input($monto_uf) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['monto_uf']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['monto_uf']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['monto_uf']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['monto_uf']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_monto_uf_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_monto_uf_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_monto_real_facturacion_dumb = ('' == $sStyleHidden_monto_real_facturacion) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_monto_real_facturacion_dumb" style="<?php echo $sStyleHidden_monto_real_facturacion_dumb; ?>"></TD>
<?php $sStyleHidden_monto_uf_dumb = ('' == $sStyleHidden_monto_uf) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_monto_uf_dumb" style="<?php echo $sStyleHidden_monto_uf_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['iva']))
    {
        $this->nm_new_label['iva'] = "Monto A Facturar Con IVA";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $iva = $this->iva;
   $sStyleHidden_iva = '';
   if (isset($this->nmgp_cmp_hidden['iva']) && $this->nmgp_cmp_hidden['iva'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['iva']);
       $sStyleHidden_iva = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_iva = 'display: none;';
   $sStyleReadInp_iva = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['iva']) && $this->nmgp_cmp_readonly['iva'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['iva']);
       $sStyleReadLab_iva = '';
       $sStyleReadInp_iva = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['iva']) && $this->nmgp_cmp_hidden['iva'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="iva" value="<?php echo $this->form_encode_input($iva) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_iva_line" id="hidden_field_data_iva" style="<?php echo $sStyleHidden_iva; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_iva_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_iva_label" style=""><span id="id_label_iva"><?php echo $this->nm_new_label['iva']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["iva"]) &&  $this->nmgp_cmp_readonly["iva"] == "on") { 

 ?>
<input type="hidden" name="iva" value="<?php echo $this->form_encode_input($iva) . "\">" . $iva . ""; ?>
<?php } else { ?>
<span id="id_read_on_iva" class="sc-ui-readonly-iva css_iva_line" style="<?php echo $sStyleReadLab_iva; ?>"><?php echo $this->form_format_readonly("iva", $this->form_encode_input($this->iva)); ?></span><span id="id_read_off_iva" class="css_read_off_iva<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_iva; ?>">
 <input class="sc-js-input scFormObjectOdd css_iva_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_iva" type=text name="iva" value="<?php echo $this->form_encode_input($iva) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 1, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['iva']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['iva']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['iva']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['iva']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_iva_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_iva_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['fecha']))
    {
        $this->nm_new_label['fecha'] = "Fecha Facturación";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fecha = $this->fecha;
   $sStyleHidden_fecha = '';
   if (isset($this->nmgp_cmp_hidden['fecha']) && $this->nmgp_cmp_hidden['fecha'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fecha']);
       $sStyleHidden_fecha = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fecha = 'display: none;';
   $sStyleReadInp_fecha = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fecha']) && $this->nmgp_cmp_readonly['fecha'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fecha']);
       $sStyleReadLab_fecha = '';
       $sStyleReadInp_fecha = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fecha']) && $this->nmgp_cmp_hidden['fecha'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fecha" value="<?php echo $this->form_encode_input($fecha) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_fecha_line" id="hidden_field_data_fecha" style="<?php echo $sStyleHidden_fecha; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fecha_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_fecha_label" style=""><span id="id_label_fecha"><?php echo $this->nm_new_label['fecha']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fecha"]) &&  $this->nmgp_cmp_readonly["fecha"] == "on") { 

 ?>
<input type="hidden" name="fecha" value="<?php echo $this->form_encode_input($fecha) . "\">" . $fecha . ""; ?>
<?php } else { ?>
<span id="id_read_on_fecha" class="sc-ui-readonly-fecha css_fecha_line" style="<?php echo $sStyleReadLab_fecha; ?>"><?php echo $this->form_format_readonly("fecha", $this->form_encode_input($fecha)); ?></span><span id="id_read_off_fecha" class="css_read_off_fecha<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fecha; ?>"><?php
$tmp_form_data = $this->field_config['fecha']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_fecha_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fecha" type=text name="fecha" value="<?php echo $this->form_encode_input($fecha) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['fecha']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['fecha']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fecha_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fecha_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_iva_dumb = ('' == $sStyleHidden_iva) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_iva_dumb" style="<?php echo $sStyleHidden_iva_dumb; ?>"></TD>
<?php $sStyleHidden_fecha_dumb = ('' == $sStyleHidden_fecha) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_fecha_dumb" style="<?php echo $sStyleHidden_fecha_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['valor_uf']))
    {
        $this->nm_new_label['valor_uf'] = "Valor Moneda Día";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $valor_uf = $this->valor_uf;
   $sStyleHidden_valor_uf = '';
   if (isset($this->nmgp_cmp_hidden['valor_uf']) && $this->nmgp_cmp_hidden['valor_uf'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['valor_uf']);
       $sStyleHidden_valor_uf = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_valor_uf = 'display: none;';
   $sStyleReadInp_valor_uf = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['valor_uf']) && $this->nmgp_cmp_readonly['valor_uf'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['valor_uf']);
       $sStyleReadLab_valor_uf = '';
       $sStyleReadInp_valor_uf = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['valor_uf']) && $this->nmgp_cmp_hidden['valor_uf'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="valor_uf" value="<?php echo $this->form_encode_input($valor_uf) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_valor_uf_line" id="hidden_field_data_valor_uf" style="<?php echo $sStyleHidden_valor_uf; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_valor_uf_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_valor_uf_label" style=""><span id="id_label_valor_uf"><?php echo $this->nm_new_label['valor_uf']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["valor_uf"]) &&  $this->nmgp_cmp_readonly["valor_uf"] == "on") { 

 ?>
<input type="hidden" name="valor_uf" value="<?php echo $this->form_encode_input($valor_uf) . "\">" . $valor_uf . ""; ?>
<?php } else { ?>
<span id="id_read_on_valor_uf" class="sc-ui-readonly-valor_uf css_valor_uf_line" style="<?php echo $sStyleReadLab_valor_uf; ?>"><?php echo $this->form_format_readonly("valor_uf", $this->form_encode_input($this->valor_uf)); ?></span><span id="id_read_off_valor_uf" class="css_read_off_valor_uf<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_valor_uf; ?>">
 <input class="sc-js-input scFormObjectOdd css_valor_uf_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_valor_uf" type=text name="valor_uf" value="<?php echo $this->form_encode_input($valor_uf) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'decimal', maxLength: 11, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['valor_uf']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['valor_uf']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['valor_uf']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['valor_uf']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_valor_uf_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_valor_uf_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

    <TD class="scFormDataOdd" colspan="1" >&nbsp;</TD>




<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } ?>
<?php $sStyleHidden_valor_uf_dumb = ('' == $sStyleHidden_valor_uf) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_valor_uf_dumb" style="<?php echo $sStyleHidden_valor_uf_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   <td width="20%" height="">
   <a name="bloco_6"></a>
<div id="div_hidden_bloco_6"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_6" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf6\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?>Documentos<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
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

    <TD class="scFormDataOdd css_observaciones_line" id="hidden_field_data_observaciones" style="<?php echo $sStyleHidden_observaciones; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_observaciones_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_observaciones_label" style=""><span id="id_label_observaciones"><?php echo $this->nm_new_label['observaciones']; ?></span></span><br>
<?php
$observaciones_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($observaciones));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["observaciones"]) &&  $this->nmgp_cmp_readonly["observaciones"] == "on") { 

 ?>
<input type="hidden" name="observaciones" value="<?php echo $this->form_encode_input($observaciones) . "\">" . $observaciones_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_observaciones" class="sc-ui-readonly-observaciones css_observaciones_line" style="<?php echo $sStyleReadLab_observaciones; ?>"><?php echo $this->form_format_readonly("observaciones", $this->form_encode_input($observaciones_val)); ?></span><span id="id_read_off_observaciones" class="css_read_off_observaciones<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observaciones; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_observaciones_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="observaciones" id="id_sc_field_observaciones" rows="6" cols="100"
 alt="{datatype: 'text', maxLength: 2000, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $observaciones; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_observaciones_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_observaciones_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['factura']))
    {
        $this->nm_new_label['factura'] = "Documento Factura";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $factura = $this->factura;
   $sStyleHidden_factura = '';
   if (isset($this->nmgp_cmp_hidden['factura']) && $this->nmgp_cmp_hidden['factura'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['factura']);
       $sStyleHidden_factura = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_factura = 'display: none;';
   $sStyleReadInp_factura = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['factura']) && $this->nmgp_cmp_readonly['factura'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['factura']);
       $sStyleReadLab_factura = '';
       $sStyleReadInp_factura = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['factura']) && $this->nmgp_cmp_hidden['factura'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="factura" value="<?php echo $this->form_encode_input($factura) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_factura_line" id="hidden_field_data_factura" style="<?php echo $sStyleHidden_factura; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_factura_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_factura_label" style=""><span id="id_label_factura"><?php echo $this->nm_new_label['factura']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["factura"]) &&  $this->nmgp_cmp_readonly["factura"] == "on") { 

 ?>
<input type="hidden" name="factura" value="<?php echo $this->form_encode_input($factura) . "\"><img id=\"factura_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><span id=\"id_ajax_doc_factura\"><a href=\"javascript:nm_mostra_doc('0', '" . str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_factura, 3)) . "', 'form_prod_presupuesto_periodo')\">" . $factura . "</a></span>"; ?>
<?php } else { ?>
<span id="id_read_on_factura" class="scFormLinkOdd sc-ui-readonly-factura css_factura_line" style="<?php echo $sStyleReadLab_factura; ?>"><?php echo $this->form_format_readonly("factura", $this->factura) ?></span><span id="id_read_off_factura" class="css_read_off_factura" style="white-space: nowrap;<?php echo $sStyleReadInp_factura; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-factura" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_factura_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="factura[]" id="id_sc_field_factura" ></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_factura"<?php if ($this->nmgp_opcao == "novo" || empty($factura)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="factura_limpa" value="<?php echo $factura_limpa . '" '; if ($factura_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="factura_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><span id="id_ajax_doc_factura"><a href="javascript:nm_mostra_doc('0', '<?php echo str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_factura, 3)); ?>', 'form_prod_presupuesto_periodo')"><?php echo $factura ?></a></span><div id="id_img_loader_factura" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_factura" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
<div id="id_sc_dragdrop_factura" class="scFormDataDragNDrop"  style="<?php echo $sStyleReadInp_factura ?>"><?php echo $this->Ini->Nm_lang['lang_errm_mu_dragfile'] ?></div>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_factura_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_factura_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['birpara'];
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['first'];
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
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['back'];
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
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['forward'];
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
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
  $nm_sc_blocos_da_pag = array(0,1,2,3,4,5,6);

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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_prod_presupuesto_periodo");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_prod_presupuesto_periodo");
 parent.scAjaxDetailHeight("form_prod_presupuesto_periodo", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_prod_presupuesto_periodo", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_prod_presupuesto_periodo", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['sc_modal'])
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
<iframe id="sc-id-download-iframe" name="sc_name_download_iframe" style="display: none"></iframe>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo']['buttonStatus'] = $this->nmgp_botoes;
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
