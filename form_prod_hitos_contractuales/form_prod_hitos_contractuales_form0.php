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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " Hitos Por Proyecto"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Hitos Por Proyecto"); } ?></TITLE>
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
 <link rel='stylesheet' href='<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/multiple-select/multiple-select.css' type='text/css'/>
 <script type='text/javascript' src='<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/multiple-select/jquery.multiple.select.js'></script>
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
.css_read_off_hito_start_date button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_hilo_end_date button {
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_prod_hitos_contractuales/form_prod_hitos_contractuales_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_prod_hitos_contractuales_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_prod_hitos_contractuales_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['recarga'];
}
    $remove_margin = '';
    $remove_border = '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['link_info']['remove_border']) {
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
 include_once("form_prod_hitos_contractuales_js0.php");
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
<form  id= "id_Fdyn_search" name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_prod_hitos_contractuales'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_prod_hitos_contractuales'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['fast_search'][2] : "";
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['dynsearch']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['dynsearch']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['dynsearch']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['dynsearch']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['dynsearch'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdynamicsearch", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); }", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); }", "dynamic_search_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['new'];
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
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['insert'];
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
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bcancelar'];
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
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['update'];
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
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F5('" . $nm_url_saida. "');", "scFormClose_F5('" . $nm_url_saida. "');", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F5('" . $nm_url_saida. "');", "scFormClose_F5('" . $nm_url_saida. "');", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "scFormClose_F6('" . $nm_url_saida. "'); return false;", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R")
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dyn_refresh'] = array();
$this->html_dynamic_search();
?>
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_proyecto_label" id="hidden_field_label_id_proyecto" style="<?php echo $sStyleHidden_id_proyecto; ?>"><span id="id_label_id_proyecto"><?php echo $this->nm_new_label['id_proyecto']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['php_cmp_required']['id_proyecto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['php_cmp_required']['id_proyecto'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_proyecto_line" id="hidden_field_data_id_proyecto" style="<?php echo $sStyleHidden_id_proyecto; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_proyecto_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_proyecto"]) &&  $this->nmgp_cmp_readonly["id_proyecto"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto'] = array(); 
    }
   $nm_comando = "SELECT    proyectos.id,   proyectos.nombre_proyecto FROM   proyectos where id=" . $_SESSION['id_proyecto'] . "  ORDER BY   nombre_proyecto";
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto'][] = $rs->fields[0];
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_proyecto'][] = ''; 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_proyecto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_proyecto_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_tipo_hito']))
   {
       $this->nm_new_label['id_tipo_hito'] = "Tipo Hito";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_tipo_hito = $this->id_tipo_hito;
   $sStyleHidden_id_tipo_hito = '';
   if (isset($this->nmgp_cmp_hidden['id_tipo_hito']) && $this->nmgp_cmp_hidden['id_tipo_hito'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_tipo_hito']);
       $sStyleHidden_id_tipo_hito = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_tipo_hito = 'display: none;';
   $sStyleReadInp_id_tipo_hito = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_tipo_hito']) && $this->nmgp_cmp_readonly['id_tipo_hito'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_tipo_hito']);
       $sStyleReadLab_id_tipo_hito = '';
       $sStyleReadInp_id_tipo_hito = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_tipo_hito']) && $this->nmgp_cmp_hidden['id_tipo_hito'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_tipo_hito" value="<?php echo $this->form_encode_input($this->id_tipo_hito) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_tipo_hito_label" id="hidden_field_label_id_tipo_hito" style="<?php echo $sStyleHidden_id_tipo_hito; ?>"><span id="id_label_id_tipo_hito"><?php echo $this->nm_new_label['id_tipo_hito']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['php_cmp_required']['id_tipo_hito']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['php_cmp_required']['id_tipo_hito'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_tipo_hito_line" id="hidden_field_data_id_tipo_hito" style="<?php echo $sStyleHidden_id_tipo_hito; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_tipo_hito_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_tipo_hito"]) &&  $this->nmgp_cmp_readonly["id_tipo_hito"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito'] = array(); 
    }
   $nm_comando = "SELECT id, tipo_hito  FROM prod_hitos_tipo  ORDER BY tipo_hito";
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito'][] = $rs->fields[0];
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
   $id_tipo_hito_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_tipo_hito_1))
          {
              foreach ($this->id_tipo_hito_1 as $tmp_id_tipo_hito)
              {
                  if (trim($tmp_id_tipo_hito) === trim($cadaselect[1])) { $id_tipo_hito_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_tipo_hito) === trim($cadaselect[1])) { $id_tipo_hito_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_tipo_hito" value="<?php echo $this->form_encode_input($id_tipo_hito) . "\">" . $id_tipo_hito_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_tipo_hito();
   $x = 0 ; 
   $id_tipo_hito_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_tipo_hito_1))
          {
              foreach ($this->id_tipo_hito_1 as $tmp_id_tipo_hito)
              {
                  if (trim($tmp_id_tipo_hito) === trim($cadaselect[1])) { $id_tipo_hito_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_tipo_hito) === trim($cadaselect[1])) { $id_tipo_hito_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_tipo_hito_look))
          {
              $id_tipo_hito_look = $this->id_tipo_hito;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_tipo_hito\" class=\"css_id_tipo_hito_line\" style=\"" .  $sStyleReadLab_id_tipo_hito . "\">" . $this->form_format_readonly("id_tipo_hito", $this->form_encode_input($id_tipo_hito_look)) . "</span><span id=\"id_read_off_id_tipo_hito\" class=\"css_read_off_id_tipo_hito" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_tipo_hito . "\">";
   echo " <span id=\"idAjaxSelect_id_tipo_hito\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_tipo_hito_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_tipo_hito\" name=\"id_tipo_hito\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_tipo_hito'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_tipo_hito) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_tipo_hito)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_tipo_hito_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_tipo_hito_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nombre']))
    {
        $this->nm_new_label['nombre'] = "Nombre Hito";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_nombre_label" id="hidden_field_label_nombre" style="<?php echo $sStyleHidden_nombre; ?>"><span id="id_label_nombre"><?php echo $this->nm_new_label['nombre']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['php_cmp_required']['nombre']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['php_cmp_required']['nombre'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_nombre_line" id="hidden_field_data_nombre" style="<?php echo $sStyleHidden_nombre; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nombre_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nombre"]) &&  $this->nmgp_cmp_readonly["nombre"] == "on") { 

 ?>
<input type="hidden" name="nombre" value="<?php echo $this->form_encode_input($nombre) . "\">" . $nombre . ""; ?>
<?php } else { ?>
<span id="id_read_on_nombre" class="sc-ui-readonly-nombre css_nombre_line" style="<?php echo $sStyleReadLab_nombre; ?>"><?php echo $this->form_format_readonly("nombre", $this->form_encode_input($this->nombre)); ?></span><span id="id_read_off_nombre" class="css_read_off_nombre<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nombre; ?>">
 <input class="sc-js-input scFormObjectOdd css_nombre_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nombre" type=text name="nombre" value="<?php echo $this->form_encode_input($nombre) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nombre_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nombre_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_usuario_asignado']))
   {
       $this->nm_new_label['id_usuario_asignado'] = "Usuario Asignado";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_usuario_asignado = $this->id_usuario_asignado;
   $sStyleHidden_id_usuario_asignado = '';
   if (isset($this->nmgp_cmp_hidden['id_usuario_asignado']) && $this->nmgp_cmp_hidden['id_usuario_asignado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_usuario_asignado']);
       $sStyleHidden_id_usuario_asignado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_usuario_asignado = 'display: none;';
   $sStyleReadInp_id_usuario_asignado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_usuario_asignado']) && $this->nmgp_cmp_readonly['id_usuario_asignado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_usuario_asignado']);
       $sStyleReadLab_id_usuario_asignado = '';
       $sStyleReadInp_id_usuario_asignado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_usuario_asignado']) && $this->nmgp_cmp_hidden['id_usuario_asignado'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_usuario_asignado" value="<?php echo $this->form_encode_input($this->id_usuario_asignado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_usuario_asignado_label" id="hidden_field_label_id_usuario_asignado" style="<?php echo $sStyleHidden_id_usuario_asignado; ?>"><span id="id_label_id_usuario_asignado"><?php echo $this->nm_new_label['id_usuario_asignado']; ?></span></TD>
    <TD class="scFormDataOdd css_id_usuario_asignado_line" id="hidden_field_data_id_usuario_asignado" style="<?php echo $sStyleHidden_id_usuario_asignado; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_usuario_asignado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_usuario_asignado"]) &&  $this->nmgp_cmp_readonly["id_usuario_asignado"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado'] = array(); 
}
if ($this->id_proyecto != "")
{ 
   $this->nm_clear_val("id_proyecto");
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado'] = array(); 
    }
   $nm_comando = "SELECT    usuarios_proyectos.id_usuario,   sec_users.name FROM   usuarios_proyectos   INNER JOIN sec_users ON (usuarios_proyectos.id_usuario = sec_users.id) WHERE   usuarios_proyectos.id_proyecto =$this->id_proyecto  order by sec_users.name";
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado'][] = $rs->fields[0];
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
} 
   $x = 0; 
   $id_usuario_asignado_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_usuario_asignado_1))
          {
              foreach ($this->id_usuario_asignado_1 as $tmp_id_usuario_asignado)
              {
                  if (trim($tmp_id_usuario_asignado) === trim($cadaselect[1])) { $id_usuario_asignado_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_usuario_asignado) === trim($cadaselect[1])) { $id_usuario_asignado_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_usuario_asignado" value="<?php echo $this->form_encode_input($id_usuario_asignado) . "\">" . $id_usuario_asignado_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_id_usuario_asignado();
   $x = 0 ; 
   $id_usuario_asignado_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_usuario_asignado_1))
          {
              foreach ($this->id_usuario_asignado_1 as $tmp_id_usuario_asignado)
              {
                  if (trim($tmp_id_usuario_asignado) === trim($cadaselect[1])) { $id_usuario_asignado_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_usuario_asignado) === trim($cadaselect[1])) { $id_usuario_asignado_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_usuario_asignado_look))
          {
              $id_usuario_asignado_look = $this->id_usuario_asignado;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_usuario_asignado\" class=\"css_id_usuario_asignado_line\" style=\"" .  $sStyleReadLab_id_usuario_asignado . "\">" . $this->form_format_readonly("id_usuario_asignado", $this->form_encode_input($id_usuario_asignado_look)) . "</span><span id=\"id_read_off_id_usuario_asignado\" class=\"css_read_off_id_usuario_asignado" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_id_usuario_asignado . "\">";
   echo " <span id=\"idAjaxSelect_id_usuario_asignado\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_id_usuario_asignado_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_id_usuario_asignado\" name=\"id_usuario_asignado\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_usuario_asignado'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_usuario_asignado) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_usuario_asignado)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_usuario_asignado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_usuario_asignado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_actividad_label" id="hidden_field_label_id_actividad" style="<?php echo $sStyleHidden_id_actividad; ?>"><span id="id_label_id_actividad"><?php echo $this->nm_new_label['id_actividad']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['php_cmp_required']['id_actividad']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['php_cmp_required']['id_actividad'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_id_actividad_line" id="hidden_field_data_id_actividad" style="<?php echo $sStyleHidden_id_actividad; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_actividad_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_actividad"]) &&  $this->nmgp_cmp_readonly["id_actividad"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad'] = array(); 
    }
   $nm_comando = "SELECT id, nombre_actividad  FROM tipo_actividades where habilitado=1  ORDER BY nombre_actividad";
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad'][] = $rs->fields[0];
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_id_actividad'][] = ''; 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_actividad_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_actividad_text"></span></td></tr></table></td></tr></table></TD>
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
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["observaciones"]) &&  $this->nmgp_cmp_readonly["observaciones"] == "on") { 

 ?>
<input type="hidden" name="observaciones" value="<?php echo $this->form_encode_input($observaciones) . "\">" . $observaciones . ""; ?>
<?php } else { ?>
<span id="id_read_on_observaciones" class="sc-ui-readonly-observaciones css_observaciones_line" style="<?php echo $sStyleReadLab_observaciones; ?>"><?php echo $this->form_format_readonly("observaciones", $this->form_encode_input($this->observaciones)); ?></span><span id="id_read_off_observaciones" class="css_read_off_observaciones<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observaciones; ?>">
 <input class="sc-js-input scFormObjectOdd css_observaciones_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_observaciones" type=text name="observaciones" value="<?php echo $this->form_encode_input($observaciones) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_observaciones_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_observaciones_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['periodos_partidas_asociados']))
   {
       $this->nm_new_label['periodos_partidas_asociados'] = "Períodos Disponibles A Asociar";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $periodos_partidas_asociados = $this->periodos_partidas_asociados;
   $sStyleHidden_periodos_partidas_asociados = '';
   if (isset($this->nmgp_cmp_hidden['periodos_partidas_asociados']) && $this->nmgp_cmp_hidden['periodos_partidas_asociados'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['periodos_partidas_asociados']);
       $sStyleHidden_periodos_partidas_asociados = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_periodos_partidas_asociados = 'display: none;';
   $sStyleReadInp_periodos_partidas_asociados = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['periodos_partidas_asociados']) && $this->nmgp_cmp_readonly['periodos_partidas_asociados'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['periodos_partidas_asociados']);
       $sStyleReadLab_periodos_partidas_asociados = '';
       $sStyleReadInp_periodos_partidas_asociados = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['periodos_partidas_asociados']) && $this->nmgp_cmp_hidden['periodos_partidas_asociados'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="periodos_partidas_asociados" value="<?php echo $this->form_encode_input($this->periodos_partidas_asociados_hidden) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php  $this->periodos_partidas_asociados_1 = explode("@?@", $this->periodos_partidas_asociados) ; ?>
    <TD class="scFormLabelOdd scUiLabelWidthFix css_periodos_partidas_asociados_label" id="hidden_field_label_periodos_partidas_asociados" style="<?php echo $sStyleHidden_periodos_partidas_asociados; ?>"><span id="id_label_periodos_partidas_asociados"><?php echo $this->nm_new_label['periodos_partidas_asociados']; ?></span></TD>
    <TD class="scFormDataOdd css_periodos_partidas_asociados_line" id="hidden_field_data_periodos_partidas_asociados" style="<?php echo $sStyleHidden_periodos_partidas_asociados; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_periodos_partidas_asociados_line" style="vertical-align: top;padding: 0px"> 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_periodos_partidas_asociados']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_periodos_partidas_asociados'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_periodos_partidas_asociados']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_periodos_partidas_asociados'] = array(); 
}
if ($this->id_proyecto != "")
{ 
   $this->nm_clear_val("id_proyecto");
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_periodos_partidas_asociados']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_periodos_partidas_asociados'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_periodos_partidas_asociados']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_periodos_partidas_asociados'] = array(); 
    }
   $nm_comando = "SELECT    prod_produccion_proyecto.id, concat(month(prod_produccion_proyecto.fecha),'-',year(prod_produccion_proyecto.fecha))  FROM   prod_produccion_proyecto WHERE   prod_produccion_proyecto.id_proyecto = $this->id_proyecto order by fecha";
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['Lookup_periodos_partidas_asociados'][] = $rs->fields[0];
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
} 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   $x = 0 ; 
   $periodos_partidas_asociados_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->periodos_partidas_asociados_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  $periodos_partidas_asociados_look .= $cadaselect[0] . "<br>";
                  break;
              }
          }
          $x++; 
   }
          if (empty($periodos_partidas_asociados_look))
          {
              $periodos_partidas_asociados_look = $this->periodos_partidas_asociados;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_periodos_partidas_asociados\" class=\"css_periodos_partidas_asociados_line\" style=\"" .  $sStyleReadLab_periodos_partidas_asociados . "\">" . $this->form_format_readonly("periodos_partidas_asociados", $this->form_encode_input($periodos_partidas_asociados_look)) . "</span><span id=\"id_read_off_periodos_partidas_asociados\" class=\"css_read_off_periodos_partidas_asociados" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_periodos_partidas_asociados . "\">";
   echo "<table style=\"display: inline-block\"><tr><td>" ; 
   echo " <span id=\"idAjaxSelect_periodos_partidas_asociados\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_periodos_partidas_asociados_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_periodos_partidas_asociados\" name=\"periodos_partidas_asociados_orig\" size=\"7\" multiple onDblClick=\"nm_add_sel('periodos_partidas_asociados_orig', 'periodos_partidas_asociados_dest', null);  \" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          foreach ($this->periodos_partidas_asociados_1 as $Dados)
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
   echo "<div class='scBtnPassField' id='periodos_partidas_asociados_all_right'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bpassfld_rightall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bpassfld_rightall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_rightall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_rightall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_rightall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_rightall", "nm_add_all('periodos_partidas_asociados_orig', 'periodos_partidas_asociados_dest', null);    return false;", "nm_add_all('periodos_partidas_asociados_orig', 'periodos_partidas_asociados_dest', null);    return false;", "Bbpassfld_rightall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bpassfld_right']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bpassfld_right']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_right']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_right']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_right'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_right", "nm_add_sel('periodos_partidas_asociados_orig', 'periodos_partidas_asociados_dest', null);    return false;", "nm_add_sel('periodos_partidas_asociados_orig', 'periodos_partidas_asociados_dest', null);    return false;", "Bbpassfld_righ", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bpassfld_left']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bpassfld_left']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_left']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_left']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_left'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_left", "nm_del_sel('periodos_partidas_asociados_dest', 'periodos_partidas_asociados_orig', null);    return false;", "nm_del_sel('periodos_partidas_asociados_dest', 'periodos_partidas_asociados_orig', null);    return false;", "Bbpassfld_left", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField' id='periodos_partidas_asociados_all_left'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bpassfld_leftall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['bpassfld_leftall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_leftall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_leftall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['bpassfld_leftall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_leftall", "nm_del_all('periodos_partidas_asociados_dest', 'periodos_partidas_asociados_orig', null);    return false;", "nm_del_all('periodos_partidas_asociados_dest', 'periodos_partidas_asociados_orig', null);    return false;", "Bbpassfld_leftall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "</td>";
   echo "<td>";
   echo " <select class=\"sc-js-input scFormObjectOdd css_periodos_partidas_asociados_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" name=\"periodos_partidas_asociados_dest\"  onBlur=\"scCssBlur(this);\"  onFocus=\"scCssFocus(this);\"  size=7 multiple onDblClick=\"nm_del_sel('periodos_partidas_asociados_dest', 'periodos_partidas_asociados_orig', null);  \" alt=\"{type: 'select', enterTab: false}\">";
   $x = 0 ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->periodos_partidas_asociados_1 as $Dados)
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
   echo " <input type=\"hidden\" name=\"periodos_partidas_asociados\" value=\"\">" ; 
   echo "</td></tr></table>";
   echo " <script>document.F1.periodos_partidas_asociados_dest.selectedIndex = -1;</script>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('periodos_partidas_asociados')", "nm_mostra_mens('periodos_partidas_asociados')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_periodos_partidas_asociados_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_periodos_partidas_asociados_text"></span></td></tr></table></td></tr></table></TD>
   
<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['birpara'];
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
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['first'];
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
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['back'];
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
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['forward'];
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
        $buttonMacroDisabled = 'sc-unique-btn-15';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_prod_hitos_contractuales");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_prod_hitos_contractuales");
 parent.scAjaxDetailHeight("form_prod_hitos_contractuales", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_prod_hitos_contractuales", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_prod_hitos_contractuales", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['sc_modal'])
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_hitos_contractuales']['buttonStatus'] = $this->nmgp_botoes;
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
