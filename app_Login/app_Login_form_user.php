<!DOCTYPE html>
<html lang = "es">
	<head>
		<title>	Sistema De Tracking De Horas</title>
		<meta descryption="<?php echo $this->Ini->Nm_lang['lang_login_message_8']; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../_lib/libraries/grp/appointments/main.css">
	    <script type="text/javascript">
		function scDisplayUserError(errorMessage) {
			alert("ERROR\r\n" + errorMessage.replace(/<br \/>/gi, "\n"));
		}
		function scDisplayUserDebug(debugMessage) {
			alert("DEBUG\r\n" + debugMessage.replace(/<br \/>/gi, "\n"));
		}
		function scDisplayUserMessage(userMessage) {
			alert("MESSAGE\r\n" + userMessage.replace(/<br \/>/gi, "\n"));
		}
        </script>
		 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
        <SCRIPT type="text/javascript" src="../_lib/lib/js/jquery-3.6.0.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("app_Login_sajax_js.php");
?>
<script type="text/javascript">
var Nm_Proc_Atualiz = false;
</script>
<script type="text/javascript">
<?php

include_once('app_Login_jquery.php');

?>
</script>
<script type="text/javascript">
 $(function() {
  scJQElementsAdd('');
  scJQGeneralAdd();
 });

</script>
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
 include_once("app_Login_js0.php");
?>
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
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_modal'])
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
$sIconTitle = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
$sErrorIcon = (isset($_SESSION['scriptcase']['error_icon']['app_Login']) && '' != $_SESSION['scriptcase']['error_icon']['app_Login']) ? $_SESSION['scriptcase']['error_icon']['app_Login']  : "";
$sCloseIcon = (isset($_SESSION['scriptcase']['error_close']['app_Login']) && '' != trim($_SESSION['scriptcase']['error_close']['app_Login'])) ? $_SESSION['scriptcase']['error_close']['app_Login'] : "<td><input class=\"scButton_default\" type=\"button\" onClick=\"document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false\" value=\"X\" /></td>";
if ('' != $sIconTitle && '' != $sErrorIcon) {
    $sErrorIcon = '';
}
?>
<script type="text/javascript">
$(function() {
    $(document.F1).on("submit", function (e) {
        e.preventDefault();
    });
});

if (typeof scDisplayUserError === "undefined") {
    function scDisplayUserError(errorMessage) {
        var divObj, displayDiv = "", displayDivHtml = "";

        displayDiv = '<div id="id_error_display_fixed">';
        displayDiv += '</div>';

        divObj = $("#id_error_display_fixed");
        if (divObj.length) {
            divObj.html("");
        } else {
            $("body").append(displayDiv);
            divObj = $("#id_error_display_fixed");
        }

        displayDivHtml  = '<TABLE class="scFormErrorTable scFormToastTable" align="center">';
        displayDivHtml +=  '<TR>';
<?php
if ('' != $sIconTitle) {
?>
        displayDivHtml +=   '<td style="padding: 0px" rowspan="2"><img src="<?php echo $sIconTitle; ?>" style="border-width: 0px" align="top"></td>';
<?php
}
?>
        displayDivHtml +=   '<TD class="scFormErrorTitle scFormToastTitle" align="left">';
        displayDivHtml +=    '<table style="border-collapse: collapse; border-width: 0px; width: 100%">';
        displayDivHtml +=     '<tr>';
        displayDivHtml +=      '<td class="scFormErrorTitleFont" style="padding: 0px; width: 100%">';
<?php
if ('' != $sErrorIcon) {
?>
        displayDivHtml +=       "<?php echo str_replace('"', '\"', $sErrorIcon); ?>";
<?php
}
?>
        displayDivHtml +=       "<?php echo $this->Ini->Nm_lang['lang_errm_errt']; ?>";
        displayDivHtml +=      '</td>';
        displayDivHtml +=      "<?php echo str_replace(array('"', "\r\n"), array('\"', ''), $sCloseIcon); ?>";
        displayDivHtml +=     '</tr>';
        displayDivHtml +=    '</table>';
        displayDivHtml +=   '</TD>';
        displayDivHtml +=  '</TR>';
        displayDivHtml +=  '<TR>';
        displayDivHtml +=   '<TD class="scFormErrorMessage scFormToastMessage" align="center"><span id="id_error_message_fixed">' + errorMessage + ' </span></TD>';
        displayDivHtml +=  '</TR>';
        displayDivHtml += '</TABLE>';

        divObj.html(displayDivHtml).show();
    }
}
if (typeof scDisplayUserDebug === "undefined") {
    function scDisplayUserDebug(debugMessage) {
        var divObj, displayDiv = "", displayDivHtml = "";

        displayDiv = '<div id="id_error_display_fixed">';
        displayDiv += '</div>';

        divObj = $("#id_error_display_fixed");
        if (divObj.length) {
            divObj.html("");
        } else {
            $("body").append(displayDiv);
            divObj = $("#id_error_display_fixed");
        }

        displayDivHtml  = '<TABLE class="scFormErrorTable scFormToastTable" align="center">';
        displayDivHtml +=  '<TR>';
<?php
if ('' != $sIconTitle) {
?>
        displayDivHtml +=   '<td style="padding: 0px" rowspan="2"><img src="<?php echo $sIconTitle; ?>" style="border-width: 0px" align="top"></td>';
<?php
}
?>
        displayDivHtml +=   '<TD class="scFormErrorTitle scFormToastTitle" align="left">';
        displayDivHtml +=    '<table style="border-collapse: collapse; border-width: 0px; width: 100%">';
        displayDivHtml +=     '<tr>';
        displayDivHtml +=      '<td class="scFormErrorTitleFont" style="padding: 0px; width: 100%">';
<?php
if ('' != $sErrorIcon) {
?>
        displayDivHtml +=       "<?php echo str_replace('"', '\"', $sErrorIcon); ?>";
<?php
}
?>
        displayDivHtml +=       "<?php echo $this->Ini->Nm_lang['lang_errm_errt']; ?>";
        displayDivHtml +=      '</td>';
        displayDivHtml +=      "<?php echo str_replace(array('"', "\r\n"), array('\"', ''), $sCloseIcon); ?>";
        displayDivHtml +=     '</tr>';
        displayDivHtml +=    '</table>';
        displayDivHtml +=   '</TD>';
        displayDivHtml +=  '</TR>';
        displayDivHtml +=  '<TR>';
        displayDivHtml +=   '<TD class="scFormErrorMessage scFormToastMessage" align="center"><span id="id_error_message_fixed">' + debugMessage + ' </span></TD>';
        displayDivHtml +=  '</TR>';
        displayDivHtml += '</TABLE>';

        divObj.html(displayDivHtml).show();
    }
}
if (typeof scDisplayUserMessage === "undefined") {
    function scDisplayUserMessage(userMessage) {
        var divObj, displayDiv = "", displayDivHtml = "";

        displayDiv = '<div id="id_error_display_fixed">';
        displayDiv += '</div>';

        divObj = $("#id_error_display_fixed");
        if (divObj.length) {
            divObj.html("");
        } else {
            $("body").append(displayDiv);
            divObj = $("#id_error_display_fixed");
        }

        displayDivHtml  = '<TABLE class="scFormErrorTable scFormToastTable" align="center">';
        displayDivHtml +=  '<TR>';
<?php
if ('' != $sIconTitle) {
?>
        displayDivHtml +=   '<td style="padding: 0px" rowspan="2"><img src="<?php echo $sIconTitle; ?>" style="border-width: 0px" align="top"></td>';
<?php
}
?>
        displayDivHtml +=   '<TD class="scFormErrorTitle scFormToastTitle" align="left">';
        displayDivHtml +=    '<table style="border-collapse: collapse; border-width: 0px; width: 100%">';
        displayDivHtml +=     '<tr>';
        displayDivHtml +=      '<td class="scFormErrorTitleFont" style="padding: 0px; width: 100%">';
<?php
if ('' != $sErrorIcon) {
?>
        displayDivHtml +=       "<?php echo str_replace('"', '\"', $sErrorIcon); ?>";
<?php
}
?>
        displayDivHtml +=       "<?php echo $this->Ini->Nm_lang['lang_errm_errt']; ?>";
        displayDivHtml +=      '</td>';
        displayDivHtml +=      "<?php echo str_replace(array('"', "\r\n"), array('\"', ''), $sCloseIcon); ?>";
        displayDivHtml +=     '</tr>';
        displayDivHtml +=    '</table>';
        displayDivHtml +=   '</TD>';
        displayDivHtml +=  '</TR>';
        displayDivHtml +=  '<TR>';
        displayDivHtml +=   '<TD class="scFormErrorMessage scFormToastMessage" align="center"><span id="id_error_message_fixed">' + userMessage + ' </span></TD>';
        displayDivHtml +=  '</TR>';
        displayDivHtml += '</TABLE>';

        divObj.html(displayDivHtml).show();
    }
}
</script>

<script>
$(function() {
<?php
if (isset($this->nmgp_cmp_hidden) && !empty($this->nmgp_cmp_hidden)) {
    foreach($this->nmgp_cmp_hidden as $fieldDisplayFieldName => $fieldDisplayFieldStatus) {
        if ('on' == $fieldDisplayFieldStatus) {
?>
if (typeof scShowUserField === "function") {
    scShowUserField("<?php echo $fieldDisplayFieldName ?>");
}
<?php
        }
        if ('off' == $fieldDisplayFieldStatus) {
?>
if (typeof scHideUserField === "function") {
    scHideUserField("<?php echo $fieldDisplayFieldName ?>");
}
<?php
        }
    }
}
?>
<?php
?>
});
</script>

		<META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
		<style>
        span.sc-ui-pwd-toggle-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
            right: 0.5rem;
            z-index: 2;
            float: right;
            bottom: 1.7rem;
        }
        </style>
	</head>

	<body class="page-background" style="background-image:url('../_lib/libraries/grp/appointments/Blue-Blur-Background1.jpg');margin: 0px;">
		<div class="page">
			<div class="container-small container-background">
				<div class="background" style="background-image:url('../_lib/libraries/grp/appointments/appointments-bg.jpg');">
					<div class="content">
						<h1>
							Sistema De Control De Producción
						</h1>

					
					</div>
				</div>

				<form class="form" action=""  name="F1" method="post" 
               action="./" 
               target="_self">
				<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nmgp_url_saida); ?>">
<input type="hidden" name="bok" value="OK">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />

					<h2>
					Iniciar Sesión
					</h2>

					<div class="control">
						<label class="label" for="name"><?php echo $this->Ini->Nm_lang['lang_login_message_2']; ?></label>
						<input class="input  sc-js-input " type="text" placeholder="<?php echo $this->Ini->Nm_lang['lang_login_message_5']; ?>"  name="login" id="id_sc_field_login" value="<?php echo $this->form_encode_input($login) ?>"  alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
					</div>
					
					<div class="control">
						<label class="label" for="pass"><?php echo $this->Ini->Nm_lang['lang_login_message_3']; ?></label>
						<!--SC_FIELD_INI_pswd-->
						<input class="input  sc-js-input " type="password" placeholder="<?php echo $this->Ini->Nm_lang['lang_login_message_6']; ?>"  name="pswd" id="id_sc_field_pswd" value="<?php echo $this->form_encode_input($pswd) ?>"  alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
					    <!--SC_FIELD_END_pswd-->
					</div>
					

					<div class="submit">
						<input class="button" type="button" value="Iniciar Sesión"  onclick="nm_atualiza('alterar');"  />
					</div>
					
					<hr style="margin: 25px 0 20px;">
					<div>
						<img src="../_lib/img/grp__NM__bg__NM__logo-color-grupo-o2.png" border="0">
					</div>
					
				</form>
				<center><b>Grupo O2 - 2024</b></center>
			</div>
		
		</div>
		
	</body>
</html>