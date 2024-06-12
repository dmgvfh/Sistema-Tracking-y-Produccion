
 <form name="form_ajax_redir_1" method="post" style="display: none">
  <input type="hidden" name="nmgp_parms">
  <input type="hidden" name="nmgp_outra_jan">
  <input type="hidden" name="script_case_session" value="<?php echo session_id() ?>">
 </form>
 <form name="form_ajax_redir_2" method="post" style="display: none">
  <input type="hidden" name="nmgp_parms">
  <input type="hidden" name="nmgp_url_saida">
  <input type="hidden" name="script_case_init">
  <input type="hidden" name="script_case_session" value="<?php echo session_id() ?>">
 </form>

 <SCRIPT>
<?php
sajax_show_javascript();
?>

  function scCenterElement(oElem)
  {
    var $oElem    = $(oElem),
        $oWindow  = $(this),
        iElemTop  = Math.round(($oWindow.height() - $oElem.height()) / 2),
        iElemLeft = Math.round(($oWindow.width()  - $oElem.width())  / 2);

    $oElem.offset({top: iElemTop, left: iElemLeft});
  } // scCenterElement

  function scAjaxHideAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId))
    {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "none";
    }
  } // scAjaxHideAutocomp

  function scAjaxShowAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId))
    {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "";
      document.getElementById("id_ac_" + sFrameId).focus();
    }
  } // scAjaxShowAutocomp

  function scAjaxHideDebug()
  {
    if (document.getElementById("id_debug_window"))
    {
      document.getElementById("id_debug_window").style.display = "none";
      document.getElementById("id_debug_text").innerHTML = "";
    }
  } // scAjaxHideDebug

  function scAjaxShowDebug(oTemp)
  {
    if (!document.getElementById("id_debug_window"))
    {
      return;
    }
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (oResp["htmOutput"] && "" != oResp["htmOutput"])
    {
      document.getElementById("id_debug_window").style.display = "";
      document.getElementById("id_debug_text").innerHTML = scAjaxFormatDebug(oResp["htmOutput"]) + document.getElementById("id_debug_text").innerHTML;
      //scCenterElement(document.getElementById("id_debug_window"));
    }
  } // scAjaxShowDebug

  function scAjaxFormatDebug(sDebugMsg)
  {
    return "<table class=\"scFormMessageTable\" style=\"margin: 1px; width: 100%\"><tr><td class=\"scFormMessageMessage\">" + scAjaxSpecCharParser(sDebugMsg) + "</td></tr></table>";
  } // scAjaxFormatDebug

  function scAjaxHideErrorDisplay_default(sErrorId, bForce)
  {
    if (document.getElementById("id_error_display_" + sErrorId + "_frame"))
    {
        document.getElementById("id_error_display_" + sErrorId + "_frame").style.display = "none";
        document.getElementById("id_error_display_" + sErrorId + "_text").innerHTML = "";
        if (null == bForce)
        {
            bForce = true;
        }
        if (bForce)
        {
            var $oField = $('#id_sc_field_' + sErrorId);
            if (0 < $oField.length)
            {
                scAjax_removeFieldErrorStyle($oField);
            }
        }
    }
    if (document.getElementById("id_error_display_fixed"))
    {
        document.getElementById("id_error_display_fixed").style.display = "none";
    }
  } // scAjaxHideErrorDisplay_default

  function scAjaxShowErrorDisplay_default(sErrorId, sErrorMsg)
  {
    if (oResp && oResp['redirExitInfo'])
    {
      sErrorMsg += "<br /><input type=\"button\" onClick=\"window.location='" + oResp['redirExitInfo']['action'] + "'\" value=\"Ok\">";
    }
    sErrorMsg = scAjaxErrorSql(sErrorMsg);
    if (document.getElementById("id_error_display_" + sErrorId + "_frame"))
    {
      document.getElementById("id_error_display_" + sErrorId + "_frame").style.display = "";
      document.getElementById("id_error_display_" + sErrorId + "_text").innerHTML = sErrorMsg;
      if ("table" == sErrorId)
      {
        scCenterElement(document.getElementById("id_error_display_" + sErrorId + "_frame"));
      }
      var $oField = $('#id_sc_field_' + sErrorId);
      if (0 < $oField.length)
      {
        scAjax_applyFieldErrorStyle($oField);
      }
    }
    if (ajax_error_list && ajax_error_list[sErrorId] && ajax_error_list[sErrorId]["timeout"] && 0 < ajax_error_list[sErrorId]["timeout"])
    {
      setTimeout("scAjaxHideErrorDisplay('" + sErrorId + "', false)", ajax_error_list[sErrorId]["timeout"] * 1000);
    }
  } // scAjaxShowErrorDisplay_default

  var iErrorSqlId = 1;

  function scAjaxErrorSql(sErrorMsg)
  {
    var iTmpPos = sErrorMsg.indexOf("{SC_DB_ERROR_INI}"),
        sTmpId;
    while (-1 < iTmpPos)
    {
      sTmpId    = "sc_id_error_sql_" + iErrorSqlId;
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "<br /><span style=\"text-decoration: underline\" onClick=\"$('#" + sTmpId + "').show(); scCenterElement(document.getElementById('" + sTmpId + "'))\">" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_MID}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "</span><table class=\"scFormErrorTable\" id=\"" + sTmpId + "\" style=\"display: none; position: absolute\"><tr><td>" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_CLS}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "<br /><br /><span onClick=\"$('#" + sTmpId + "').hide()\">" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_END}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "</span></td></tr></table>" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_INI}");
      iErrorSqlId++;
    }
    return sErrorMsg;
  } // scAjaxErrorSql

  function scAjaxHideMessage_default()
  {
    if (document.getElementById("id_message_display_frame"))
    {
      document.getElementById("id_message_display_frame").style.display = "none";
      document.getElementById("id_message_display_text").innerHTML = "";
    }
  } // scAjaxHideMessage

  function scAjaxShowMessage_default()
  {
    if (!oResp["msgDisplay"] || !oResp["msgDisplay"]["msgText"])
    {
      return;
    }
    _scAjaxShowMessage_default({title: scMsgDefTitle, message: oResp["msgDisplay"]["msgText"], isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: false, toastPos: ""});
  } // scAjaxShowMessage

  var scMsgDefClose = "";

  function _scAjaxShowMessage_default(params) {
	var sTitle = params["title"],
		sMessage = params["message"],
		bModal = params["isModal"],
		iTimeout = params["timeout"],
		bButton = params["showButton"],
		sButton = params["buttonLabel"],
		iTop = params["topPos"],
		iLeft = params["leftPos"],
		iWidth = params["width"],
		iHeight = params["height"],
		sRedir = params["redirUrl"],
		sTarget = params["redirTarget"],
		sParam = params["redirParam"],
		bClose = params["showClose"],
		bBodyIcon = params["showBodyIcon"],
		bToast = params["isToast"],
		sToastPos = params["toastPos"];
    if ("" == sMessage) {
      if (bModal) {
        scMsgDefClick = "close_modal";
      }
      else {
        scMsgDefClick = "close";
      }
      _scAjaxMessageBtnClick();
      document.getElementById("id_message_display_title").innerHTML = scMsgDefTitle;
      document.getElementById("id_message_display_text").innerHTML = "";
      document.getElementById("id_message_display_buttone").value = scMsgDefButton;
      document.getElementById("id_message_display_buttond").style.display = "none";
    }
    else {
      document.getElementById("id_message_display_title").innerHTML = scAjaxSpecCharParser(sTitle);
      document.getElementById("id_message_display_text").innerHTML = scAjaxSpecCharParser(sMessage);
      document.getElementById("id_message_display_buttone").value = sButton;
      document.getElementById("id_message_display_buttond").style.display = bButton ? "" : "none";
      document.getElementById("id_message_display_buttond").style.display = bButton ? "" : "none";
      document.getElementById("id_message_display_title_line").style.display = (bClose || "" != sTitle) ? "" : "none";
      document.getElementById("id_message_display_close_icon").style.display = bClose ? "" : "none";
      if (document.getElementById("id_message_display_body_icon")) {
        document.getElementById("id_message_display_body_icon").style.display = bBodyIcon ? "" : "none";
      }
      $("#id_message_display_content").css('width', (0 < iWidth ? iWidth + 'px' : ''));
      $("#id_message_display_content").css('height', (0 < iHeight ? iHeight + 'px' : ''));
      if (bModal) {
        iWidth = iWidth || 250;
        iHeight = iHeight || 200;
        scMsgDefClose = "close_modal";
        tb_show('', '#TB_inline?height=' + (iHeight + 6) + '&width=' + (iWidth + 4) + '&inlineId=id_message_display_frame&modal=true', '');
        if (bButton) {
          if ("" != sRedir && "" != sTarget) {
            scMsgDefClick = "redir2_modal";
            document.form_ajax_redir_2.action = sRedir;
            document.form_ajax_redir_2.target = sTarget;
            document.form_ajax_redir_2.nmgp_parms.value = sParam;
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
          }
          else if ("" != sRedir && "" == sTarget) {
            scMsgDefClick = "redir1";
            document.form_ajax_redir_1.action = sRedir;
            document.form_ajax_redir_1.nmgp_parms.value = sParam;
          }
          else {
            scMsgDefClick = "close_modal";
          }
        }
        else if (null != iTimeout && 0 < iTimeout) {
          scMsgDefClick = "close_modal";
          setTimeout("_scAjaxMessageBtnClick()", iTimeout * 1000);
        }
      }
      else
      {
        scMsgDefClose = "close";
        $("#id_message_display_frame").css('top', (0 < iTop ? iTop + 'px' : ''));
        $("#id_message_display_frame").css('left', (0 < iLeft ? iLeft + 'px' : ''));
        document.getElementById("id_message_display_frame").style.display = "";
        if (0 == iTop && 0 == iLeft) {
          scCenterElement(document.getElementById("id_message_display_frame"));
        }
        if (bButton) {
          if ("" != sRedir && "" != sTarget) {
            scMsgDefClick = "redir2";
            document.form_ajax_redir_2.action = sRedir;
            document.form_ajax_redir_2.target = sTarget;
            document.form_ajax_redir_2.nmgp_parms.value = sParam;
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
          }
          else if ("" != sRedir && "" == sTarget) {
            scMsgDefClick = "redir1";
            document.form_ajax_redir_1.action = sRedir;
            document.form_ajax_redir_1.nmgp_parms.value = sParam;
          }
          else {
            scMsgDefClick = "close";
          }
        }
        else if (null != iTimeout && 0 < iTimeout) {
          scMsgDefClick = "close";
          setTimeout("_scAjaxMessageBtnClick()", iTimeout * 1000);
        }
      }
    }
  } // _scAjaxShowMessage_default

  function _scAjaxMessageBtnClose() {
    switch (scMsgDefClose) {
      case "close":
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "close_modal":
        tb_remove();
        break;
    }
  } // _scAjaxMessageBtnClick

  function _scAjaxMessageBtnClick() {
    switch (scMsgDefClick) {
      case "close":
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "close_modal":
        tb_remove();
        break;
      case "dismiss":
        scAjaxHideMessage();
        break;
      case "redir1":
        document.form_ajax_redir_1.submit();
        break;
      case "redir2":
        document.form_ajax_redir_2.submit();
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "redir2_modal":
        document.form_ajax_redir_2.submit();
        tb_remove();
        break;
    }
  } // _scAjaxMessageBtnClick

  function scAjaxHasError()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "ERROR" == oResp["result"];
  } // scAjaxHasError

  function scAjaxIsOk()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "OK" == oResp["result"] || "SET" == oResp["result"];
  } // scAjaxIsOk

  function scAjaxIsSet()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "SET" == oResp["result"];
  } // scAjaxIsSet

  function scAjaxCalendarReload()
  {
    if (oResp["calendarReload"] && "OK" == oResp["calendarReload"] && typeof self.parent.calendar_reload == "function")
    {
<?php
if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && isset($_SESSION['scriptcase']['display_mobile']) && $_SESSION['scriptcase']['display_mobile']) {
?>
      self.parent.calendar_reload();
      self.parent.tb_remove();
<?php
} else {
?>
      self.parent.calendar_reload();
      self.parent.tb_remove();
<?php
}
?>
      return true;
    }
    return false;
  } // scCalendarReload

  function scAjaxUpdateErrors(sType)
  {
    ajax_error_geral = "";
    oFieldErrors     = {};
    if (oResp["errList"])
    {
      for (iFieldErrors = 0; iFieldErrors < oResp["errList"].length; iFieldErrors++)
      {
        sTestField = oResp["errList"][iFieldErrors]["fldName"];
        if ("geral_form_prod_presupuesto_periodo_mob" == sTestField)
        {
          if (ajax_error_geral != '') { ajax_error_geral += '<br>';}
          ajax_error_geral += scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
        }
        else
        {
          if (scFocusFirstErrorField && '' == scFocusFirstErrorName)
          {
            scFocusFirstErrorName = sTestField;
          }
          if (oResp["errList"][iFieldErrors]["numLinha"])
          {
            sTestField += oResp["errList"][iFieldErrors]["numLinha"];
          }
          if (!oFieldErrors[sTestField])
          {
            oFieldErrors[sTestField] = new Array();
          }
          oFieldErrors[sTestField][oFieldErrors[sTestField].length] = scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
        }
      }
    }
    for (iUpdateErrors = 0; iUpdateErrors < ajax_field_list.length; iUpdateErrors++)
    {
      sTestField = ajax_field_list[iUpdateErrors];
      if (oFieldErrors[sTestField])
      {
        ajax_error_list[sTestField][sType] = oFieldErrors[sTestField];
      }
    }
  } // scAjaxUpdateErrors

  function scAjaxUpdateFieldErrors(sField, sType)
  {
    aFieldErrors = new Array();
    if (oResp["errList"])
    {
      iErrorPos  = 0;
      for (iFieldErrors = 0; iFieldErrors < oResp["errList"].length; iFieldErrors++)
      {
        sTestField = oResp["errList"][iFieldErrors]["fldName"];
        if (oResp["errList"][iFieldErrors]["numLinha"])
        {
          sTestField += oResp["errList"][iFieldErrors]["numLinha"];
        }
        if (sField == sTestField)
        {
          aFieldErrors[iErrorPos] = scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
          iErrorPos++;
        }
      }
    }
        if (ajax_error_list[sField])
        {
        ajax_error_list[sField][sType] = aFieldErrors;
        }
  } // scAjaxUpdateFieldErrors

  function scAjaxListErrors(bLabel)
  {
    bFirst        = false;
    sAppErrorText = "";
    if ("" != ajax_error_geral)
    {
      bFirst         = true;
      sAppErrorText += ajax_error_geral;
    }
    for (iFieldList = 0; iFieldList < ajax_field_list.length; iFieldList++)
    {
      sFieldError = scAjaxListFieldErrors(ajax_field_list[iFieldList], bLabel);
      if ("" != sFieldError)
      {
        if (bFirst)
        {
          bFirst         = false
          sAppErrorText += "<hr size=\"1\" width=\"80%\" />";
        }
        sAppErrorText += sFieldError;
      }
    }
    return sAppErrorText;
  } // scAjaxListErrors

  function scAjaxListFieldErrors(sField, bLabel)
  {
    sErrorText = "";
    for (iErrorType = 0; iErrorType < ajax_error_type.length; iErrorType++)
    {
      if (ajax_error_list[sField])
      {
        for (iListErrors = 0; iListErrors < ajax_error_list[sField][ajax_error_type[iErrorType]].length; iListErrors++)
        {
          if (bLabel)
          {
            sErrorText += ajax_error_list[sField]["label"] + ": ";
          }
          sErrorText += ajax_error_list[sField][ajax_error_type[iErrorType]][iListErrors] + "<br />";
        }
      }
    }
    return sErrorText;
  } // scAjaxListFieldErrors

	function scAjaxClearErrors() {
		var fieldName;

		for (fieldName in ajax_error_list) {
            if (null != ajax_error_list[fieldName]) {
                ajax_error_list[fieldName]["valid"] = new Array();
                ajax_error_list[fieldName]["onblur"] = new Array();
                ajax_error_list[fieldName]["onchange"] = new Array();
                ajax_error_list[fieldName]["onclick"] = new Array();
                ajax_error_list[fieldName]["onfocus"] = new Array();
            }
		}
	} // scAjaxClearErrors

  function scAjaxSetVariables()
  {
    if (!oResp["varList"])
    {
      return true;
    }
    for (var iVarFields = 0; iVarFields < oResp["varList"].length; iVarFields++)
    {
      var sVarName  = oResp["varList"][iVarFields]["index"];
      var sVarValue = oResp["varList"][iVarFields]["value"];
	  eval(sVarName + " = \"" + sVarValue + "\";");
	}
  } // scAjaxSetVariables

  function scAjaxSetFields()
  {
    if (!oResp["fldList"])
    {
      return true;
    }
    for (iSetFields = 0; iSetFields < oResp["fldList"].length; iSetFields++)
    {
      var sFieldName = oResp["fldList"][iSetFields]["fldName"];
      var sFieldType = oResp["fldList"][iSetFields]["fldType"];

      if ("selectdd" == sFieldType)
      {
        var bSelectDD = true;
        sFieldType = "select";
      }
      else
      {
        var bSelectDD = false;
      }
      if ("select2_ac" == sFieldType)
      {
        var bSelect2AC = true;
        sFieldType = "select";
      }
      else
      {
        var bSelect2AC = false;
      }
      if (oResp["fldList"][iSetFields]["valList"])
      {
        var oFieldValues = oResp["fldList"][iSetFields]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (oResp["fldList"][iSetFields]["optList"])
      {
        var oFieldOptions = oResp["fldList"][iSetFields]["optList"];
      }
      else
      {
        var oFieldOptions = null;
      }
/*
      if ("_autocomp" == sFieldName.substr(sFieldName.length - 9) &&
          iSetFields > 0 &&
          sFieldName.substr(0, sFieldName.length - 9) == oResp["fldList"][iSetFields - 1]["fldName"] &&
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)) &&
          oFieldValues[0]['value'])
      {
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)).innerHTML = oFieldValues[0]['value'];
      }
*/

      if ("corhtml" == sFieldType)
      {
        sFieldType = 'text';

        /*sCor = (oFieldValues[0]['value']) ? oFieldValues[0]['value'] : "";
        setaCorPaleta(sFieldName, sCor);*/
      }

      if ("_autocomp" == sFieldName.substr(sFieldName.length - 9) &&
          iSetFields > 0 &&
          sFieldName.substr(0, sFieldName.length - 9) == oResp["fldList"][iSetFields - 1]["fldName"] &&
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)))
      {
          sLabel_auto_Comp = (oFieldValues[0]['value']) ? oFieldValues[0]['value'] : "";
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)).innerHTML = sLabel_auto_Comp;
      }


      if (oResp["fldList"][iSetFields]["colNum"])
      {
        var iColNum = oResp["fldList"][iSetFields]["colNum"];
      }
      else
      {
        var iColNum = 1;
      }
      if (oResp["fldList"][iSetFields]["row"])
      {
        var iRow = oResp["fldList"][iSetFields]["row"];
		var thisRow = oResp["fldList"][iSetFields]["row"];
      }
      else
      {
        var iRow = 1;
		var thisRow = "";
      }
      if (oResp["fldList"][iSetFields]["htmComp"])
      {
        var sHtmComp = oResp["fldList"][iSetFields]["htmComp"];
        sHtmComp     = sHtmComp.replace(/__AD__/gi, '"');
        sHtmComp     = sHtmComp.replace(/__AS__/gi, "'");
      }
      else
      {
        var sHtmComp = null;
      }
      if (oResp["fldList"][iSetFields]["imgFile"])
      {
        var sImgFile = oResp["fldList"][iSetFields]["imgFile"];
      }
      else
      {
        var sImgFile = "";
      }
      if (oResp["fldList"][iSetFields]["imgOrig"])
      {
        var sImgOrig = oResp["fldList"][iSetFields]["imgOrig"];
      }
      else
      {
        var sImgOrig = "";
      }
      if (oResp["fldList"][iSetFields]["keepImg"])
      {
        var sKeepImg = oResp["fldList"][iSetFields]["keepImg"];
      }
      else
      {
        var sKeepImg = "N";
      }
      if (oResp["fldList"][iSetFields]["hideName"])
      {
        var sHideName = oResp["fldList"][iSetFields]["hideName"];
      }
      else
      {
        var sHideName = "N";
      }
      if (oResp["fldList"][iSetFields]["imgLink"])
      {
        var sImgLink = oResp["fldList"][iSetFields]["imgLink"];
      }
      else
      {
        var sImgLink = null;
      }
      if (oResp["fldList"][iSetFields]["docLink"])
      {
        var sDocLink = oResp["fldList"][iSetFields]["docLink"];
      }
      else
      {
        var sDocLink = "";
      }
      if (oResp["fldList"][iSetFields]["docIcon"])
      {
        var sDocIcon = oResp["fldList"][iSetFields]["docIcon"];
      }
      else
      {
        var sDocIcon = "";
      }

      if (oResp["fldList"][iSetFields]["docReadonly"])
      {
        var sDocReadonly = oResp["fldList"][iSetFields]["docReadonly"];
      }
      else
      {
        var sDocReadonly = "";
      }

      if (oResp["fldList"][iSetFields]["optComp"])
      {
        var sOptComp = oResp["fldList"][iSetFields]["optComp"];
      }
      else
      {
        var sOptComp = "";
      }
      if (oResp["fldList"][iSetFields]["optClass"])
      {
        var sOptClass = oResp["fldList"][iSetFields]["optClass"];
      }
      else
      {
        var sOptClass = "";
      }
      if (oResp["fldList"][iSetFields]["optMulti"])
      {
        var sOptMulti = oResp["fldList"][iSetFields]["optMulti"];
      }
      else
      {
        var sOptMulti = "";
      }
      if (oResp["fldList"][iSetFields]["imgHtml"])
      {
        var sImgHtml = oResp["fldList"][iSetFields]["imgHtml"];
      }
      else
      {
        var sImgHtml = "";
      }
      if (oResp["fldList"][iSetFields]["mulHtml"])
      {
        var sMULHtml = oResp["fldList"][iSetFields]["mulHtml"];
      }
      else
      {
        var sMULHtml = "";
      }
      if (oResp["fldList"][iSetFields]["updInnerHtml"])
      {
        var sInnerHtml = scAjaxSpecCharParser(oResp["fldList"][iSetFields]["updInnerHtml"]);
      }
      else
      {
        var sInnerHtml = null;
      }
      if (oResp["fldList"][iSetFields]["lookupCons"])
      {
        var sLookupCons = scAjaxSpecCharParser(oResp["fldList"][iSetFields]["lookupCons"]);
      }
      else
      {
        var sLookupCons = "";
      }
      if (oResp["clearUpload"])
      {
        var sClearUpload = scAjaxSpecCharParser(oResp["clearUpload"]);
      }
      else
      {
        var sClearUpload = "N";
      }
      if (oResp["eventField"])
      {
        var sEventField = scAjaxSpecCharParser(oResp["eventField"]);
      }
      else
      {
        var sEventField = "__SC_NO_FIELD";
      }
      if (oResp["fldList"][iSetFields]["switch"])
      {
        var bSwitch = true == oResp["fldList"][iSetFields]["switch"];
      }
      else
      {
        var bSwitch = false;
      }
      if ("checkbox" == sFieldType)
      {
        scAjaxSetFieldCheckbox(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sInnerHtml, sOptComp, sOptClass, sOptMulti, bSwitch, sEventField);
      }
      else if ("duplosel" == sFieldType)
      {
        scAjaxSetFieldDuplosel(sFieldName, oFieldValues, oFieldOptions);
      }
      else if ("imagem" == sFieldType)
      {
        scAjaxSetFieldImage(sFieldName, oFieldValues, sImgFile, sImgOrig, sImgLink, sKeepImg, sHideName);
      }
      else if ("documento" == sFieldType)
      {
        scAjaxSetFieldDocument(sFieldName, oFieldValues, sDocLink, sDocIcon, sClearUpload, sDocReadonly);
      }
      else if ("label" == sFieldType)
      {
        scAjaxSetFieldLabel(sFieldName, oFieldValues, oFieldOptions, sLookupCons);
      }
      else if ("radio" == sFieldType)
      {
        scAjaxSetFieldRadio(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, bSwitch, sEventField);
      }
      else if ("select" == sFieldType)
      {
        scAjaxSetFieldSelect(sFieldName, oFieldValues, oFieldOptions, bSelectDD, bSelect2AC, iRow, sEventField, thisRow);
      }
      else if ("text" == sFieldType)
      {
        scAjaxSetFieldText(sFieldName, oFieldValues, sLookupCons, thisRow, sEventField);
      }
      else if ("color_palette" == sFieldType)
      {
        scAjaxSetFieldColorPalette(sFieldName, oFieldValues);
      }
      else if ("editor_html" == sFieldType)
      {
        scAjaxSetFieldEditorHtml(sFieldName, oFieldValues);
      }
      else if ("imagehtml" == sFieldType)
      {
        scAjaxSetFieldImageHtml(sFieldName, oFieldValues, sImgHtml);
      }
      else if ("innerhtml" == sFieldType)
      {
        scAjaxSetFieldInnerHtml(sFieldName, oFieldValues);
      }
      else if ("multi_upload" == sFieldType)
      {
        scAjaxSetFieldMultiUpload(sFieldName, sMULHtml);
      }
      else if ("recur_info" == sFieldType)
      {
        scAjaxSetFieldRecurInfo(sFieldName, sMULHtml);
      }
      else if ("signature" == sFieldType)
      {
        scAjaxSetFieldSignature(sFieldName, oFieldValues);
      }
      else if ("rating" == sFieldType)
      {
        scAjaxSetFieldRating(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingstar" == sFieldType)
      {
        scAjaxSetFieldRatingStar(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingsmile" == sFieldType)
      {
        scAjaxSetFieldRatingSmile(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingthumb" == sFieldType)
      {
        scAjaxSetFieldRatingThumb(sFieldName, oFieldValues, thisRow);
      }
      scAjaxUpdateHeaderFooter(sFieldName, oFieldValues);
    }
  } // scAjaxSetFields

  function scAjaxUpdateHeaderFooter(sFieldName, oFieldValues)
  {
    if (self.updateHeaderFooter)
    {
      if (null == oFieldValues)
      {
        sNewValue = '';
      }
      else if (oFieldValues[0]["label"])
      {
        sNewValue = oFieldValues[0]["label"];
      }
      else
      {
        sNewValue = oFieldValues[0]["value"];
      }
      updateHeaderFooter(sFieldName, scAjaxSpecCharParser(sNewValue));
    }
  } // scAjaxUpdateHeaderFooter

  function scAjaxSetFieldText(sFieldName, oFieldValues, sLookupCons, thisRow, sEventField)
  {
    if (document.F1.elements[sFieldName])
    {
      var jqField = $("#id_sc_field_" + sFieldName),
          Temp_text = scAjaxReturnBreakLine(scAjaxSpecCharParser(scAjaxProtectBreakLine(oFieldValues[0]['value'])));
      if (jqField.length)
      {
        jqField.val(Temp_text);
        if (sEventField != sFieldName && sEventField != "__SC_NO_FIELD" && sEventField != "")
        {
          //jqField.trigger("change");
        }
      }
      else
      {
        eval("document.F1." + sFieldName + ".value = Temp_text");
      }
      if (scEventControl_data[sFieldName]) {
        scEventControl_data[sFieldName]["calculated"] = Temp_text;
      }
    }
    if (document.getElementById("id_lookup_" + sFieldName))
    {
      document.getElementById("id_lookup_" + sFieldName).innerHTML = sLookupCons;
    }
    if (oFieldValues[0]['label'])
    {
      scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues);
    }
    else
    {
      oFieldValues[0]['value'] = scAjaxBreakLine(oFieldValues[0]['value']);
      scAjaxSetReadonlyValue(sFieldName, oFieldValues[0]['value']);
    }
	scAjaxSetSliderValue(sFieldName, thisRow);
  } // scAjaxSetFieldText

  function scAjaxSetSliderValue(fieldName, thisRow)
  {
	  var sliderObject = $("#sc-ui-slide-" + fieldName);
	  if (!sliderObject.length) {
		  return;
	  }
	  scJQSlideValue(fieldName, thisRow);
  } // scAjaxSetSliderValue

  function scAjaxSetFieldColorPalette(sFieldName, oFieldValues)
  {
    if (document.F1.elements[sFieldName])
    {
        var Temp_text = scAjaxReturnBreakLine(scAjaxSpecCharParser(scAjaxProtectBreakLine(oFieldValues[0]['value'])));
        eval ("document.F1." + sFieldName + ".value = Temp_text");
    }
    if (oFieldValues[0]['label'])
    {
      scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues);
    }
    else
    {
      oFieldValues[0]['value'] = scAjaxBreakLine(oFieldValues[0]['value']);
	  setaCorPaleta(sFieldName, oFieldValues[0]['value']);
      scAjaxSetReadonlyValue(sFieldName, oFieldValues[0]['value']);
    }
  } // scAjaxSetFieldColorPalette

  function scAjaxSetFieldSelect(sFieldName, oFieldValues, oFieldOptions, bSelectDD, bSelect2AC, iRow, sEventField, thisRow)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    if (bSelectDD)
    {
        $("#id_sc_field_" + sFieldName).dropdownchecklist("destroy");
    }
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      scAjaxSetFieldText(sFieldNameHtml, oFieldValues, "", "", sEventField);
      return;
    }

    if (null != oFieldOptions)
    {
      $("#id_sc_field_" + sFieldName).children().remove()
      if ("<select" != oFieldOptions.substr(0, 7))
      {
        var $oField = $("#id_sc_field_" + sFieldName);
        if (0 < $oField.length)
        {
          $oField.html(oFieldOptions);
        }
        else
        {
          document.getElementById("idAjaxSelect_" + sFieldName).innerHTML = oFieldOptions;
        }
      }
      else
      {
        document.getElementById("idAjaxSelect_" + sFieldName).innerHTML = oFieldOptions;
      }
    }
    var aValues = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    var oFormField = $("#id_sc_field_" + sFieldName);
    for (iFieldSelect = 0; iFieldSelect < oFormField[0].length; iFieldSelect++)
    {
      if (scAjaxInArray(oFormField[0].options[iFieldSelect].value, aValues))
      {
        oFormField[0].options[iFieldSelect].selected = true;
      }
      else
      {
        oFormField[0].options[iFieldSelect].selected = false;
      }
    }
	scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
    if (bSelectDD)
    {
        scJQDDCheckBoxAdd(thisRow, true);
    }
	if (bSelect2AC)
	{
		var newOption = new Option(oFieldValues[0]["label"], oFieldValues[0]["value"], true, true);
		$("#id_ac_" + sFieldName).append(newOption);
		$("#id_sc_field_" + sFieldName).val(oFieldValues[0]["value"]);
	}
	else if (oFormField.hasClass("select2-hidden-accessible"))
	{
        $("#id_sc_field_" + sFieldName).select2("destroy");
		var select2Field = sFieldName;
		if ("" != thisRow) {
			select2Field = select2Field.substr(0, select2Field.length - thisRow.toString().length);
		}
        scJQSelect2Add(thisRow, select2Field);
	}
  } // scAjaxSetFieldSelect

  function scAjaxSetFieldDuplosel(sFieldName, oFieldValues, oFieldOptions)
  {
    var sFieldNameOrig = sFieldName + "_orig";
    var sFieldNameDest = sFieldName + "_dest";
    var oFormFieldOrig = document.F1.elements[sFieldNameOrig];
    var oFormFieldDest = document.F1.elements[sFieldNameDest];

    if (null != oFieldOptions)
    {
      scAjaxClearSelect(sFieldNameOrig);
      for (iFieldSelect = 0; iFieldSelect < oFieldOptions.length; iFieldSelect++)
      {
        oFormFieldOrig.options[iFieldSelect] = new Option(scAjaxSpecCharParser(oFieldOptions[iFieldSelect]["label"]), scAjaxSpecCharParser(oFieldOptions[iFieldSelect]["value"]));
      }
    }
    while (oFormFieldDest.length > 0)
    {
      oFormFieldDest.options[0] = null;
    }
    var aValues = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        sNewOptionLabel = oFieldValues[iFieldSelect]["label"] ? scAjaxSpecCharParser(oFieldValues[iFieldSelect]["label"]) : scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
        sNewOptionValue = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
        if (sNewOptionValue.substr(0, 8) == "@NMorder")
        {
           sNewOptionValue                      = sNewOptionValue.substr(8);
           oFormFieldDest.options[iFieldSelect] = new Option(scAjaxSpecCharParser(sNewOptionLabel), sNewOptionValue);
           sNewOptionValue                      = sNewOptionValue.substr(1);
           aValues[iFieldSelect]                = sNewOptionValue;
        }
        else
        {
           aValues[iFieldSelect]                = sNewOptionValue;
           oFormFieldDest.options[iFieldSelect] = new Option(scAjaxSpecCharParser(sNewOptionLabel), sNewOptionValue);
        }
      }
    }
    for (iFieldSelect = 0; iFieldSelect < oFormFieldOrig.length; iFieldSelect++)
    {
      oFormFieldOrig.options[iFieldSelect].selected = false;
      if (scAjaxInArray(oFormFieldOrig.options[iFieldSelect].value, aValues))
      {
        oFormFieldOrig.options[iFieldSelect].disabled    = true;
        oFormFieldOrig.options[iFieldSelect].style.color = "#A0A0A0";
      }
      else
      {
        oFormFieldOrig.options[iFieldSelect].disabled = false;
      }
    }
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldDuplosel

  function scAjaxSetFieldCheckbox(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sInnerHtml, sOptComp, sOptClass, sOptMulti, bSwitch, sEventField)
  {
	if (null == bSwitch)
	{
	  bSwitch = false;
	}
    if (document.getElementById("idAjaxCheckbox_" + sFieldName) && null != sInnerHtml)
    {
      document.getElementById("idAjaxCheckbox_" + sFieldName).innerHTML = sInnerHtml;
      return;
    }
    if (null != oFieldOptions)
    {
        scAjaxClearCheckbox(sFieldName);
    }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      scAjaxSetFieldText(sFieldName, oFieldValues, "", "", sEventField);
      return;
    }
    if (null != oFieldOptions && "" != oFieldOptions)
    {
/*      scAjaxClearCheckbox(sFieldName); */
      scAjaxRecreateOptions("Checkbox", "checkbox", sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, sOptClass, sOptMulti, bSwitch);
    }
    else
    {
      scAjaxSetCheckboxOptions(sFieldName, oFieldValues);
    }
	scAjaxSetSwitchOptions(sFieldName, "checkbox");
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldCheckbox

  function scAjaxSetFieldRadio(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, bSwitch, sEventField)
  {
	if (null == bSwitch)
	{
	  bSwitch = false;
	}
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      scAjaxSetFieldText(sFieldName, oFieldValues, "", "", sEventField);
      return;
    }
    if (null != oFieldOptions)
    {
        scAjaxClearRadio(sFieldName);
    }
    if (null != oFieldOptions && "" != oFieldOptions)
    {
/*      scAjaxClearRadio(sFieldName); */
      scAjaxRecreateOptions("Radio", "radio", sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, "", "", bSwitch);
    }
    else
    {
      scAjaxSetRadioOptions(sFieldName, oFieldValues);
    }
	scAjaxSetSwitchOptions(sFieldName, "radio");
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldRadio

  function scAjaxSetSwitchOptions(fieldName, fieldType)
  {
	var fieldOptions = $(".sc-ui-" + fieldType + "-" + fieldName + ".lc-switch");
	if (!fieldOptions.length) {
		return;
	}
	for (var i = 0; i < fieldOptions.length; i++) {
		if ($(fieldOptions[i]).prop("checked")) {
			$(fieldOptions[i]).lcs_on();
		}
		else {
			$(fieldOptions[i]).lcs_off();
		}
	}
  }

  function scAjaxSetFieldLabel(sFieldName, oFieldValues, oFieldOptions, sLookupCons)
  {
    sFieldValue = oFieldValues[0]["value"];
    if ("undefined" == typeof oFieldValues[0]["label"]) {
      sFieldLabel = oFieldValues[0]["value"];
    } else {
      sFieldLabel = oFieldValues[0]["label"];
    }
    sFieldLabel = scAjaxBreakLine(sFieldLabel);
    if (null != oFieldOptions)
    {
      for (iRecreate = 0; iRecreate < oFieldOptions.length; iRecreate++)
      {
        sOptText  = scAjaxSpecCharParser(oFieldOptions[iRecreate]["value"]);
        sOptValue = scAjaxSpecCharParser(oFieldOptions[iRecreate]["label"]);
        if (sFieldValue == sOptText)
        {
          sFieldLabel = sOptValue;
        }
      }
    }
    if (document.getElementById("id_ajax_label_" + sFieldName))
    {
      document.getElementById("id_ajax_label_" + sFieldName).innerHTML = scAjaxSpecCharParser(sFieldLabel);
    }
    if (document.F1.elements[sFieldName])
    {
//      document.F1.elements[sFieldName].value = scAjaxSpecCharParser(sFieldValue);
        Temp_text = scAjaxProtectBreakLine(sFieldValue);
        Temp_text = scAjaxSpecCharParser(Temp_text);
        document.F1.elements[sFieldName].value = scAjaxReturnBreakLine(Temp_text);

    }
    if (document.getElementById("id_lookup_" + sFieldName))
    {
      document.getElementById("id_lookup_" + sFieldName).innerHTML = sLookupCons;
    }
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(sFieldLabel));
  } // scAjaxSetFieldLabel

  function scAjaxSetFieldImage(sFieldName, oFieldValues, sImgFile, sImgOrig, sImgLink, sKeepImg, sHideName)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    if ("N" == sKeepImg && document.getElementById("id_ajax_img_"  + sFieldName))
    {
      document.getElementById("id_ajax_img_"  + sFieldName).src           = scAjaxSpecCharParser(sImgFile);
      document.getElementById("id_ajax_img_"  + sFieldName).style.display = ("" == sImgFile) ? "none" : "";
    }
    if (document.getElementById("id_ajax_link_" + sFieldName) && null != sImgLink)
    {
      document.getElementById("id_ajax_link_" + sFieldName).innerHTML = oFieldValues[0]["value"];
      document.getElementById("id_ajax_link_" + sFieldName).href      = scAjaxSpecCharParser(sImgLink);
    }
    if (document.getElementById("chk_ajax_img_" + sFieldName))
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = ("" == oFieldValues[0]["value"]) ? "none" : "";
    }
    if ("" == oFieldValues[0]["value"] && document.F1.elements[sFieldName + "_limpa"])
    {
      document.F1.elements[sFieldName + "_limpa"].checked = false;
    }
    if ("N" == sKeepImg && document.getElementById("txt_ajax_img_" + sFieldName))
    {
      document.getElementById("txt_ajax_img_" + sFieldName).innerHTML     = oFieldValues[0]["value"];
      document.getElementById("txt_ajax_img_" + sFieldName).style.display = ("" == oFieldValues[0]["value"] || "S" == sHideName) ? "none" : "";
    }
    if ("" != sImgOrig)
    {
      eval("if (var_ajax_img_" + sFieldName + ") var_ajax_img_" + sFieldName + " = '" + sImgOrig + "';");
      if (document.F1.elements["temp_out1_" + sFieldName])
      {
        document.F1.elements["temp_out_" + sFieldName].value = sImgFile;
        document.F1.elements["temp_out1_" + sFieldName].value = sImgOrig;
      }
      else if (document.F1.elements["temp_out_" + sFieldName])
      {
        document.F1.elements["temp_out_" + sFieldName].value = sImgOrig;
      }
    }
    if ("" != oFieldValues[0]["value"])
    {
      if (document.F1.elements[sFieldName + "_salva"]) document.F1.elements[sFieldName + "_salva"].value = oFieldValues[0]["value"];
    }
    else if (oResp && oResp["ajaxRequest"] && "navigate_form" == oResp["ajaxRequest"])
    {
      if (document.F1.elements[sFieldName + "_salva"]) document.F1.elements[sFieldName + "_salva"].value = "";
    }
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldImage

  function scAjaxSetFieldDocument(sFieldName, oFieldValues, sDocLink, sDocIcon, sClearUpload, sDocReadonly)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    document.getElementById("id_ajax_doc_"  + sFieldName).innerHTML = scAjaxSpecCharParser(sDocLink);
    if (document.getElementById("id_ajax_doc_icon_"  + sFieldName))
    {
      document.getElementById("id_ajax_doc_icon_"  + sFieldName).src = scAjaxSpecCharParser(sDocIcon);
    }
    if ("" == oFieldValues[0]["value"])
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = "none";
      document.getElementById("id_ajax_doc_" + sFieldName).style.display = "none";
    }
    else
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = "";
      document.getElementById("id_ajax_doc_" + sFieldName).style.display = "";
    }
    if ("" == oFieldValues[0]["value"] && document.F1.elements[sFieldName + "_limpa"])
    {
      document.F1.elements[sFieldName + "_limpa"].checked = false;
    }
    if ("S" == sClearUpload && document.F1.elements[sFieldName + "_ul_name"])
    {
      document.F1.elements[sFieldName + "_ul_name"].value = "";
    }
    if ("" != sDocLink && sDocReadonly == "S")
    {
      scAjaxSetReadonlyValue(sFieldName, sDocLink);
    }
    else
    {
      scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
    }
  } // scAjaxSetFieldDocument

  function scAjaxSetFieldInnerHtml(sFieldName, oFieldValues)
  {
    if (document.getElementById(sFieldName))
    {
      document.getElementById(sFieldName).innerHTML = scAjaxSpecCharParser(oFieldValues[0]["value"]);
    }
  } // scAjaxSetFieldInnerHtml

  function scAjaxSetFieldMultiUpload(sFieldName, sMULHtml)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    $("#id_sc_loaded_" + sFieldName).html(scAjaxSpecCharParser(sMULHtml));
  } // scAjaxSetFieldMultiUpload

  function scAjaxExecFieldEditorHtml(strOption, bolUI, oField)
  {
	  	if(tinymce.majorVersion > 3)
		{
			if(strOption == 'mceAddControl')
			{
				tinymce.execCommand('mceAddEditor', bolUI, oField);
			}else
			if(strOption == 'mceRemoveControl')
			{
				tinymce.execCommand('mceRemoveEditor', bolUI, oField);
			}
		}
		else
		{
			tinyMCE.execCommand(strOption, bolUI, oField);
		}
  }

  function scAjaxSetFieldEditorHtml(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName])
    {
      return;
    }
	if(tinymce.majorVersion > 3)
	{
		var oFormField = tinyMCE.get(sFieldName);
	}
	else
	{
		var oFormField = tinyMCE.getInstanceById(sFieldName);
	}
    oFormField.setContent(scAjaxSpecCharParser(oFieldValues[0]["value"]));
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldEditorHtml

  function scAjaxSetFieldImageHtml(sFieldName, oFieldValues, sImgHtml)
  {
    if (document.getElementById("id_imghtml_" + sFieldName))
    {
      document.getElementById("id_imghtml_" + sFieldName).innerHTML = scAjaxSpecCharParser(sImgHtml);
    }
  } // scAjaxSetFieldEditorHtml

  function scAjaxSetFieldRecurInfo(sFieldName, oFieldValues)
  {
	  var jsonData = "" != oFieldValues[0]["value"]
	               ? JSON.parse(oFieldValues[0]["value"])
				   : { repeat: "1", endon: "E", endafter: "", endin: ""};
	  $("#id_rinf_repeat_" + sFieldName).val(jsonData.repeat);
	  $(".cl_rinf_endon_" + sFieldName).filter(function(index) {return $(this).val() == jsonData.endon}).prop("checked", true),
	  $("#id_rinf_endafter_" + sFieldName).val(jsonData.endafter);
	  $("#id_rinf_endin_" + sFieldName).val(jsonData.endin);
	  scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldRecurInfo

  function scAjaxSetFieldSignature(sFieldName, oFieldValues)
  {
	var fieldValue = scAjaxSpecCharParser(oFieldValues[0]['value']);
	if ("data:image/png;base64," != fieldValue.substr(0, 22) && "data:image/jsignature;base30," != fieldValue.substr(0, 29))
	{
		scJQSignatureClear(sFieldName);
		return;
	}
	$("#id_sc_field_" + sFieldName).val(fieldValue);
	scJQSignatureRedraw(sFieldName);
         scFormHasChanged = false; // mantis 0020638
  } // scAjaxSetFieldSignature

  function scAjaxSetFieldRating(sFieldName, oFieldValues, thisRow)
  {
	$("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
	if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
	}
	scJQRatingRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingStar(sFieldName, oFieldValues, thisRow)
  {
	$("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
	if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
	}
	scJQRatingStarRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingSmile(sFieldName, oFieldValues, thisRow)
  {
	$("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
	if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
	}
	scJQRatingSmileRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingThumb(sFieldName, oFieldValues, thisRow)
  {
	$("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
	if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
	}
	scJQRatingThumbRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetCheckboxOptions(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"] && !document.F1.elements[sFieldName + "[0]"])
    {
      return;
    }
    var aValues    = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    if (document.F1.elements[sFieldName + "[]"])
    {
      var oFormField = document.F1.elements[sFieldName + "[]"];
      if (oFormField.length)
      {
        for (iFieldCheckbox = 0; iFieldCheckbox < oFormField.length; iFieldCheckbox++)
        {
          if (scAjaxInArray(oFormField[iFieldCheckbox].value, aValues))
          {
            oFormField[iFieldCheckbox].checked = true;
          }
          else
          {
            oFormField[iFieldCheckbox].checked = false;
          }
        }
      }
      else
      {
        if (scAjaxInArray(oFormField.value, aValues))
        {
          oFormField.checked = true;
        }
        else
        {
          oFormField.checked = false;
        }
      }
    }
    else if (document.F1.elements[sFieldName + "[0]"])
    {
      for (iFieldCheckbox = 0; iFieldCheckbox < document.F1.elements.length; iFieldCheckbox++)
      {
        oFormElement = document.F1.elements[iFieldCheckbox];
        if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1) && scAjaxInArray(oFormElement.value, aValues))
        {
          oFormElement.checked = true;
        }
        else if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1))
        {
          oFormElement.checked = false;
        }
      }
    }
    else
    {
      oFormElement = document.F1.elements[sFieldName];
      if (scAjaxInArray(oFormElement.value, aValues))
      {
        oFormElement.checked = true;
      }
      else
      {
        oFormElement.checked = false;
      }
    }
  } // scAjaxSetCheckboxOptions

  function scAjaxSetRadioOptions(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName])
    {
      return;
    }
    var oFormField = document.F1.elements[sFieldName];
    var aValues    = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
    {
      oFormField[iFieldRadio].checked = false;
    }
    for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
    {
      if (scAjaxInArray(oFormField[iFieldRadio].value, aValues))
      {
        oFormField[iFieldRadio].checked = true;
      }
    }
  } // scAjaxSetRadioOptions

  function scAjaxSetReadonlyValue(sFieldName, sFieldValue)
  {
    if (document.getElementById("id_read_on_" + sFieldName))
    {
      document.getElementById("id_read_on_" + sFieldName).innerHTML = sFieldValue;
    }
  } // scAjaxSetReadonlyValue

  function scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, sDelim)
  {
    if (null == oFieldValues)
    {
      return;
    }
    if (null == sDelim)
    {
      sDelim = " ";
    }
    sReadLabel = "";
    for (iReadArray = 0; iReadArray < oFieldValues.length; iReadArray++)
    {
      if (oFieldValues[iReadArray]["label"])
      {
        if ("" != sReadLabel)
        {
          sReadLabel += sDelim;
        }
        sReadLabel += oFieldValues[iReadArray]["label"];
      }
      else if (oFieldValues[iReadArray]["value"])
      {
        if ("" != sReadLabel)
        {
          sReadLabel += sDelim;
        }
        sReadLabel += oFieldValues[iReadArray]["value"];
      }
    }
    scAjaxSetReadonlyValue(sFieldName, sReadLabel);
  } // scAjaxSetReadonlyArrayValue

  function scAjaxGetFieldValue(sFieldGet)
  {
    sValue = "";
    if (!oResp["fldList"])
    {
      return sValue;
    }
    for (iFieldValue = 0; iFieldValue < oResp["fldList"].length; iFieldValue++)
    {
      var sFieldName  = oResp["fldList"][iFieldValue]["fldName"];
      if (oResp["fldList"][iFieldValue]["valList"])
      {
        var oFieldValues = oResp["fldList"][iFieldValue]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (sFieldGet == sFieldName && null != oFieldValues)
      {
        if (1 == oFieldValues.length)
        {
          sValue = scAjaxSpecCharParser(oFieldValues[0]["value"]);
        }
        else
        {
          sValue = new Array();
          for (jFieldValue = 0; jFieldValue < oFieldValues.length; jFieldValue++)
          {
            sValue[jFieldValue] = scAjaxSpecCharParser(oFieldValues[jFieldValue]["value"]);
          }
        }
      }
    }
    return sValue;
  } // scAjaxGetFieldValue

  function scAjaxGetKeyValue(sFieldGet)
  {
    sValue = "";
    if (!oResp["fldList"])
    {
      return sValue;
    }
    for (iKeyValue = 0; iKeyValue < oResp["fldList"].length; iKeyValue++)
    {
      var sFieldName = oResp["fldList"][iKeyValue]["fldName"];
      if (sFieldGet == sFieldName)
      {
        if (oResp["fldList"][iKeyValue]["keyVal"])
        {
          return scAjaxSpecCharParser(oResp["fldList"][iKeyValue]["keyVal"]);
        }
        else
        {
          return scAjaxGetFieldValue(sFieldGet);
        }
      }
    }
    return sValue;
  } // scAjaxGetKeyValue

  function scAjaxGetLineNumber()
  {
    sLineNumber = "";
    if (oResp["errList"])
    {
      for (iLineNumber = 0; iLineNumber < oResp["errList"].length; iLineNumber++)
      {
        if (oResp["errList"][iLineNumber]["numLinha"])
        {
          sLineNumber = oResp["errList"][iLineNumber]["numLinha"];
        }
      }
      return sLineNumber;
    }
    if (oResp["fldList"])
    {
      return oResp["fldList"][0]["numLinha"];
    }
    if (oResp["msgDisplay"])
    {
      return oResp["msgDisplay"]["numLinha"];
    }
    return sLineNumber;
  } // scAjaxGetLineNumber

  function scAjaxFieldExists(sFieldGet)
  {
    bExists = false;
    if (!oResp["fldList"])
    {
      return bExists;
    }
    for (iFieldValue = 0; iFieldValue < oResp["fldList"].length; iFieldValue++)
    {
      var sFieldName  = oResp["fldList"][iFieldValue]["fldName"];
      if (oResp["fldList"][iFieldValue]["valList"])
      {
        var oFieldValues = oResp["fldList"][iFieldValue]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (sFieldGet == sFieldName && null != oFieldValues)
      {
        bExists = true;
      }
    }
    return bExists;
  } // scAjaxFieldExists

  function scAjaxGetFieldText(sFieldName)
  {
    $oHidden = $("input[name='" + sFieldName + "']");
    if (!$oHidden.length)
    {
      $oHidden = $("input[name='" + sFieldName + "_']");
    }
    if ($oHidden.length)
    {
      for (var i = 0; i < $oHidden.length; i++)
      {
        if ("hidden" == $oHidden[i].type && $oHidden[i].form && $oHidden[i].form.name && "F1" == $oHidden[i].form.name)
        {
          return scAjaxSpecCharProtect($oHidden[i].value);//.replace(/[+]/g, "__NM_PLUS__");
        }
      }
    }
    $oField = $("#id_sc_field_" + sFieldName);
    if(!$oField.length)
    {
      $oField = $("#id_sc_field_" + sFieldName + "_");
    }
    if ($oField.length && "select" != $oField[0].type.substr(0, 6))
    {
      return scAjaxSpecCharProtect($oField.val());//.replace(/[+]/g, "__NM_PLUS__");
    }
    else if (document.F1.elements[sFieldName])
    {
      return scAjaxSpecCharProtect(document.F1.elements[sFieldName].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else if (document.F1.elements[sFieldName + '_'])
    {
      return scAjaxSpecCharProtect(document.F1.elements[sFieldName + '_'].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else
    {
      return '';
    }
  } // scAjaxGetFieldText

  function scAjaxGetFieldHidden(sFieldName)
  {
    for( i= 0; i < document.F1.elements.length; i++)
    {
       if (document.F1.elements[i].name == sFieldName)
       {
          return scAjaxSpecCharProtect(document.F1.elements[i].value);//.replace(/[+]/g, "__NM_PLUS__");
       }
    }
//    return document.F1.elements[sFieldName].value.replace(/[+]/g, "__NM_PLUS__");
  } // scAjaxGetFieldHidden

  function scAjaxGetFieldSelect(sFieldName)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return "";
    }
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      return scAjaxGetFieldHidden(sFieldNameHtml);
    }
    var oFormField = document.F1.elements[sFieldNameHtml];
    var iSelected  = oFormField.selectedIndex;
    if (-1 < iSelected)
    {
      return scAjaxSpecCharProtect(oFormField.options[iSelected].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else
    {
      return "";
    }
  } // scAjaxGetFieldSelect

  function scAjaxGetFieldSelectMult(sFieldName, sFieldDelim)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      return scAjaxGetFieldHidden(sFieldNameHtml);
    }
    var oFormField = document.F1.elements[sFieldNameHtml];
    var sFieldVals = "";
    for (iFieldSelect = 0; iFieldSelect < oFormField.length; iFieldSelect++)
    {
      if (oFormField[iFieldSelect].selected)
      {
        if ("" != sFieldVals)
        {
          sFieldVals += sFieldDelim;
        }
        sFieldVals += scAjaxSpecCharProtect(oFormField[iFieldSelect].value);//.replace(/[+]/g, "__NM_PLUS__");
      }
    }
    return sFieldVals;
  } // scAjaxGetFieldSelectMult

  function scAjaxGetFieldCheckbox(sFieldName, sDelim)
  {
    var aValues = new Array();
    var sValue  = "";
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"] && !document.F1.elements[sFieldName + "[0]"])
    {
      return sValue;
    }
    if (document.F1.elements[sFieldName + "[]"] && "hidden" == document.F1.elements[sFieldName + "[]"].type)
    {
      return scAjaxGetFieldHidden(sFieldName + "[]");
    }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    if (document.F1.elements[sFieldName + "[]"])
    {
      var oFormField = document.F1.elements[sFieldName + "[]"];
      if (oFormField.length)
      {
        for (iFieldCheck = 0; iFieldCheck < oFormField.length; iFieldCheck++)
        {
          if (oFormField[iFieldCheck].checked)
          {
            aValues[aValues.length] = oFormField[iFieldCheck].value;
          }
        }
      }
      else
      {
        if (oFormField.checked)
        {
          aValues[aValues.length] = oFormField.value;
        }
      }
    }
    else
    {
      for (iFieldCheck = 0; iFieldCheck < document.F1.elements.length; iFieldCheck++)
      {
        oFormElement = document.F1.elements[iFieldCheck];
        if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1) && oFormElement.checked)
        {
          aValues[aValues.length] = oFormElement.value;
        }
        else if (sFieldName == oFormElement.name && oFormElement.checked)
        {
          aValues[aValues.length] = oFormElement.value;
        }
      }
    }
    for (iFieldCheck = 0; iFieldCheck < aValues.length; iFieldCheck++)
    {
      sValue += scAjaxSpecCharProtect(aValues[iFieldCheck]);//.replace(/[+]/g, "__NM_PLUS__");
      if (iFieldCheck + 1 != aValues.length)
      {
        sValue += sDelim;
      }
    }
    return sValue;
  } // scAjaxGetFieldCheckbox

  function scAjaxGetFieldRadio(sFieldName)
  {
    if ("hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    var sValue = "";
    if (!document.F1.elements[sFieldName])
    {
      return sValue;
    }
    var oFormField = document.F1.elements[sFieldName];
    if (!oFormField.length)
    {
        var sc_cmp_radio = eval("document.F1." + sFieldName);
        if (sc_cmp_radio.checked)
        {
           sValue = scAjaxSpecCharProtect(sc_cmp_radio.value);//.replace(/[+]/g, "__NM_PLUS__");
        }
    }
    else
    {
      for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
      {
        if (oFormField[iFieldRadio].checked)
        {
          sValue = scAjaxSpecCharProtect(oFormField[iFieldRadio].value);//.replace(/[+]/g, "__NM_PLUS__");
        }
      }
    }
    return sValue;
  } // scAjaxGetFieldRadio

  function scAjaxGetFieldEditorHtml(sFieldName)
  {
    if ("hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    var sValue = "";
    if (!document.F1.elements[sFieldName])
    {
      return sValue;
    }

	if(tinymce.majorVersion > 3)
	{
		var oFormField = tinyMCE.get(sFieldName);
	}
	else
	{
		var oFormField = tinyMCE.getInstanceById(sFieldName);
	}
    return scAjaxSpecCharParser(scAjaxSpecCharProtect(oFormField.getContent()));//.replace(/[+]/g, "__NM_PLUS__"));
  } // scAjaxGetFieldEditorHtml

  function scAjaxGetFieldSignature(sFieldName)
  {
    var signatureData = $("#sc-id-sign-" + sFieldName).jSignature("getData", "base30");
	$("#id_sc_field_" + sFieldName).val("data:" + signatureData[0] + "," + signatureData[1]);
	return $("#id_sc_field_" + sFieldName).val();
  } // scAjaxGetFieldEditorHtml

  function scAjaxGetFieldRecurInfo(sFieldName)
  {
	  var repeatInList = $(".cl_rinf_repeatin_" + sFieldName).filter(":checked"), repeatInValues = [], jsonData, i;
	  for (i = 0; i < repeatInList.length; i++) {
		  repeatInValues.push($(repeatInList[i]).val());
	  }
	  jsonData = {
		  repeat: $("#id_rinf_repeat_" + sFieldName).val(),
		  repeatin: repeatInValues.join(";"),
		  endon: $(".cl_rinf_endon_" + sFieldName).filter(":checked").val(),
		  endafter: $("#id_rinf_endafter_" + sFieldName).val(),
		  endin: $("#id_rinf_endin_" + sFieldName).val()
	  };
	  return JSON.stringify(jsonData);
  } // scAjaxGetFieldRecurInfo

  function scAjaxDoNothing(e)
  {
  } // scAjaxDoNothing

  function scAjaxInArray(mVal, aList)
  {
    for (iInArray = 0; iInArray < aList.length; iInArray++)
    {
      if (aList[iInArray] == mVal)
      {
        return true;
      }
    }
    return false;
  } // scAjaxInArray

  function scAjaxSpecCharParser(sParseString)
  {
    if (null == sParseString) {
      return "";
    }
    var ta = document.createElement("textarea");
    ta.innerHTML = sParseString.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    return ta.value;
  } // scAjaxSpecCharParser

  function scAjaxSpecCharProtect(sOriginal)
  {
        var sProtected;
        sProtected = sOriginal.replace(/[+]/g, "__NM_PLUS__");
        sProtected = sProtected.replace(/[%]/g, "__NM_PERC__");
        return sProtected;
  } // scAjaxSpecCharProtect

  function scAjaxRecreateOptions(sFieldType, sHtmlType, sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, sOptClass, sOptMulti, bSwitch)
  {
    var sSuffix  = ("checkbox" == sHtmlType) ? "[]" : "";
    var sDivName = "idAjax" + sFieldType + "_" + sFieldName;
    var sDivText = "";
    var iCntLine = 0;
    var aValues  = new Array();
    var sClass;
    var markChangedClass;
    if (null != oFieldValues)
    {
      for (iRecreate = 0; iRecreate < oFieldValues.length; iRecreate++)
      {
        aValues[iRecreate] = scAjaxSpecCharParser(oFieldValues[iRecreate]["value"]);
      }
    }
    sDivText += "<table border=0>";
    if ("checkbox" == sHtmlType)
    {
        markChangedClass = "sc-ui-checkbox-" + sFieldName;
    }
    if ("radio" == sHtmlType)
    {
        markChangedClass = "sc-ui-radio-" + sFieldName;
    }
    for (iRecreate = 0; iRecreate < oFieldOptions.length; iRecreate++)
    {
        sOptText  = scAjaxSpecCharParser(oFieldOptions[iRecreate]["label"]);
        sOptValue = scAjaxSpecCharParser(oFieldOptions[iRecreate]["value"]);
        if (0 == iCntLine)
        {
            sDivText += "<tr>";
        }
        iCntLine++;
        if ("" != sOptClass)
        {
            sClass = " class=\"" + sOptClass;
            if ("" != sOptMulti)
            {
                sClass += " " + sOptClass + sOptMulti;
            }
            if ("" != markChangedClass)
            {
                sClass += " " + markChangedClass;
            }
            sClass += "\"";
        }
        else
        {
            sClass = " class=\"";
            if ("" != markChangedClass)
            {
                sClass += " " + markChangedClass;
            }
            sClass += "\"";
        }
        if (sHtmComp == null)
        {
            sHtmComp = "";
        }
        sChecked  = (scAjaxInArray(sOptValue, aValues)) ? " checked" : "";
        sDivText += "<td class=\"scFormDataFontOdd\">";
		if (bSwitch)
		{
			sDivText += "<div class=\"sc ";
			if ("Checkbox" == sFieldType)
			{
				sDivText += "switch";
			}
			else
			{
				sDivText += "radio";
			}
			sDivText += "\">";
		}
        sDivText += "<input id=\"id-opt-" + sFieldName + "-"  + iRecreate + "\" type=\"" + sHtmlType + "\" name=\"" + sFieldName + sSuffix + "\" value=\"" + sOptValue + "\"" + sChecked + " " + sHtmComp + " " + sOptComp + sClass + ">";
		if (bSwitch)
		{
			sDivText += "<span></span>";
		}
        sDivText += "<label for=\"id-opt-" + sFieldName + "-"  + iRecreate + "\">" + sOptText + "</label>";
		if (bSwitch)
		{
			sDivText += "</div>";
		}
        sDivText += "</td>";
        if (iColNum == iCntLine)
        {
            sDivText += "</tr>";
            iCntLine  = 0;
        }
    }
    sDivText += "</table>";
    document.getElementById(sDivName).innerHTML = sDivText;
    if ("" != markChangedClass)
    {
      $("." + markChangedClass).on("click", function() { scMarkFormAsChanged(); });
    }
  } // scAjaxRecreateOptions

  function scAjaxProcOn(bForce)
  {
    if (null == bForce)
    {
      bForce = false;
    }
    if (document.getElementById("id_div_process"))
    {
      if ($ && $.blockUI && !bForce)
      {
        $.blockUI({
          message: $("#id_div_process_block"),
          overlayCSS: { backgroundColor: sc_ajaxBg },
          css: {
            borderColor: sc_ajaxBordC,
            borderStyle: sc_ajaxBordS,
            borderWidth: sc_ajaxBordW
          }
        });
      }
      else
      {
        document.getElementById("id_div_process").style.display = "";
        document.getElementById("id_fatal_error").style.display = "none";
        if (null != scCenterElement)
        {
          scCenterElement(document.getElementById("id_div_process"));
        }
      }
    }
  } // scAjaxProcOn

  function scAjaxProcOff(bForce)
  {
    if (null == bForce)
    {
      bForce = false;
    }
    if (document.getElementById("id_div_process"))
    {
      if ($ && $.unblockUI && !bForce)
      {
        $.unblockUI();
      }
      else
      {
        document.getElementById("id_div_process").style.display = "none";
      }
    }
  } // scAjaxProcOff

  function scAjaxSetMaster()
  {
    if (!oResp["masterValue"])
    {
      return;
    }
	if (scMasterDetailParentIframe && "" != scMasterDetailParentIframe)
	{
      var dbParentFrame = $(parent.document).find("[name='" + scMasterDetailParentIframe + "']");
	  if (!dbParentFrame || !dbParentFrame[0] || !dbParentFrame[0].contentWindow.scAjaxDetailValue)
	  {
		return;
	  }
      for (iMaster = 0; iMaster < oResp["masterValue"].length; iMaster++)
      {
        dbParentFrame[0].contentWindow.scAjaxDetailValue(oResp["masterValue"][iMaster]["index"], oResp["masterValue"][iMaster]["value"]);
      }
	}
    if (!parent || !parent.scAjaxDetailValue)
    {
      return;
    }
    for (iMaster = 0; iMaster < oResp["masterValue"].length; iMaster++)
    {
      parent.scAjaxDetailValue(oResp["masterValue"][iMaster]["index"], oResp["masterValue"][iMaster]["value"]);
    }
  } // scAjaxSetMaster

  function scAjaxSetFocus()
  {
    if (!oResp["setFocus"] && '' == scFocusFirstErrorName)
    {
      return;
    }
    sFieldName = oResp["setFocus"];
    if (document.F1.elements[sFieldName])
    {
        scFocusField(sFieldName);
    }
    scAjaxFocusError();
  } // scAjaxSetFocus

  function scAjaxFocusError()
  {
    if ('' != scFocusFirstErrorName)
    {
      scFocusField(scFocusFirstErrorName);
      scFocusFirstErrorName = '';
    }
  } // scAjaxFocusError

  function scAjaxSetNavStatus(sBarPos)
  {
    if (!oResp["navStatus"])
    {
      return;
    }
    sNavRet = "S";
    sNavAva = "S";
    if (oResp["navStatus"]["ret"])
    {
      sNavRet = oResp["navStatus"]["ret"];
    }
    if (oResp["navStatus"]["ava"])
    {
      sNavAva = oResp["navStatus"]["ava"];
    }
    if ("S" != sNavRet && "N" != sNavRet)
    {
      sNavRet = "S";
    }
    if ("S" != sNavAva && "N" != sNavAva)
    {
      sNavAva = "S";
    }
    Nav_permite_ret = sNavRet;
    Nav_permite_ava = sNavAva;
    nav_atualiza(Nav_permite_ret, Nav_permite_ava, sBarPos);
  } // scAjaxSetNavStatus

  function scAjaxSetSummary()
  {
    if (!oResp["navSummary"])
    {
      return;
    }
    sreg_ini = oResp["navSummary"].reg_ini;
    sreg_qtd = oResp["navSummary"].reg_qtd;
    sreg_tot = oResp["navSummary"].reg_tot;
    summary_atualiza(sreg_ini, sreg_qtd, sreg_tot);
  } // scAjaxSetSummary

  function scAjaxSetNavpage()
  {
    navpage_atualiza(oResp["navPage"]);
  } // scAjaxSetNavpage


  function scAjaxRedir(oTemp)
  {
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (!oResp["redirInfo"])
    {
      return;
    }
    sMetodo = oResp["redirInfo"]["metodo"];
    sAction = oResp["redirInfo"]["action"];
    if ("location" == sMetodo)
    {
      if ("parent.parent" == oResp["redirInfo"]["target"])
      {
        parent.parent.location = sAction;
      }
      else if ("parent" == oResp["redirInfo"]["target"])
      {
        parent.location = sAction;
      }
      else if ("_blank" == oResp["redirInfo"]["target"])
      {
        window.open(sAction, "_blank");
      }
      else
      {
        document.location = sAction;
      }
    }
    else if ("html" == sMetodo)
    {
        document.write(scAjaxSpecCharParser(oResp["redirInfo"]["action"]));
    }
    else
    {
      if (oResp["redirInfo"]["target"] == "modal")
      {
          tb_show('', sAction + '?script_case_init=' +  oResp["redirInfo"]["script_case_init"] + '&script_case_session=<?php echo session_id() ?>&nmgp_parms=' + oResp["redirInfo"]["nmgp_parms"] + '&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&TB_iframe=true&modal=true&height=' +  oResp["redirInfo"]["h_modal"] + '&width=' + oResp["redirInfo"]["w_modal"], '');
          return;
      }
      sFormRedir = (oResp["redirInfo"]["nmgp_outra_jan"]) ? "form_ajax_redir_1" : "form_ajax_redir_2";
      document.forms[sFormRedir].action           = sAction;
      document.forms[sFormRedir].target           = oResp["redirInfo"]["target"];
      document.forms[sFormRedir].nmgp_parms.value = oResp["redirInfo"]["nmgp_parms"];
      if ("form_ajax_redir_1" == sFormRedir)
      {
        document.forms[sFormRedir].nmgp_outra_jan.value = oResp["redirInfo"]["nmgp_outra_jan"];
      }
      else
      {
        document.forms[sFormRedir].nmgp_url_saida.value   = oResp["redirInfo"]["nmgp_url_saida"];
        document.forms[sFormRedir].script_case_init.value = oResp["redirInfo"]["script_case_init"];
      }
      document.forms[sFormRedir].submit();
    }
  } // scAjaxRedir

  function scAjaxSetDisplay(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    var aDispData = new Array();
    var aDispCont = {};
    var vertButton;
    if (bReset)
    {
      for (iDisplay = 0; iDisplay < ajax_block_list.length; iDisplay++)
      {
        aDispCont[ajax_block_list[iDisplay]] = aDispData.length;
        aDispData[aDispData.length] = new Array(ajax_block_id[ajax_block_list[iDisplay]], "on");
      }
      for (iDisplay = 0; iDisplay < ajax_field_list.length; iDisplay++)
      {
        if (ajax_field_id[ajax_field_list[iDisplay]])
        {
          aFieldIds = ajax_field_id[ajax_field_list[iDisplay]];
          for (iDisplay2 = 0; iDisplay2 < aFieldIds.length; iDisplay2++)
          {
            aDispCont[aFieldIds[iDisplay2]] = aDispData.length;
            aDispData[aDispData.length] = new Array(aFieldIds[iDisplay2], "on");
          }
        }
      }
    }
	var blockDisplay = {};
    if (oResp["blockDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["blockDisplay"].length; iDisplay++)
      {
        if (bReset)
        {
          aDispData[ aDispCont[ oResp["blockDisplay"][iDisplay][0] ] ][1] = oResp["blockDisplay"][iDisplay][1];
        }
        else
        {
          aDispData[aDispData.length] = new Array(ajax_block_id[ oResp["blockDisplay"][iDisplay][0] ], oResp["blockDisplay"][iDisplay][1]);
        }
		blockDisplay[ oResp["blockDisplay"][iDisplay][0] ] = oResp["blockDisplay"][iDisplay][1];
      }
	  //scCheckPagesWithoutBlock();
    }
	var fieldDisplay = {}, controlHtmlHideField = [], controlHtmlShowField = [];
    if (oResp["fieldDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["fieldDisplay"].length; iDisplay++)
      {
        if (typeof scHideUserField === "function" && "off" == oResp["fieldDisplay"][iDisplay][1]) {
          controlHtmlHideField.push(oResp["fieldDisplay"][iDisplay][0]);
        }
        if (typeof scShowUserField === "function" && "on" == oResp["fieldDisplay"][iDisplay][1]) {
          controlHtmlShowField.push(oResp["fieldDisplay"][iDisplay][0]);
        }
        for (iDisplay2 = 1; iDisplay2 < ajax_field_mult[ oResp["fieldDisplay"][iDisplay][0] ].length; iDisplay2++)
        {
          aFieldIds = ajax_field_id[ ajax_field_mult[ oResp["fieldDisplay"][iDisplay][0] ][iDisplay2] ];
          for (iDisplay3 = 0; iDisplay3 < aFieldIds.length; iDisplay3++)
          {
            if (bReset)
            {
              aDispData[ aDispCont[ aFieldIds[iDisplay3] ] ][1] = oResp["fieldDisplay"][iDisplay][1];
            }
            else
            {
              aDispData[aDispData.length] = new Array(aFieldIds[iDisplay3], oResp["fieldDisplay"][iDisplay][1]);
            }
			if ("hidden_field_data_" == aFieldIds[iDisplay3].substr(0, 18)) {
			  fieldDisplay[ aFieldIds[iDisplay3].substr(18) ] = oResp["fieldDisplay"][iDisplay][1];
			}
          }
        }
      }
    }
    if (oResp["buttonDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["buttonDisplay"].length; iDisplay++)
      {
        var sBtnName2 = "";
        var sBtnName3 = "";
        switch (oResp["buttonDisplay"][iDisplay][0])
        {
          case "first": var sBtnName = "sc_b_ini"; break;
          case "back": var sBtnName = "sc_b_ret"; break;
          case "forward": var sBtnName = "sc_b_avc"; break;
          case "last": var sBtnName = "sc_b_fim"; break;
          case "insert": var sBtnName = "sc_b_ins"; break;
          case "update": var sBtnName = "sc_b_upd"; break;
          case "delete": var sBtnName = "sc_b_del"; break;
          default: var sBtnName = "sc_b_" + oResp["buttonDisplay"][iDisplay][0]; sBtnName2 = "sc_" + oResp["buttonDisplay"][iDisplay][0]; sBtnName3 = "gbl_sc_" + oResp["buttonDisplay"][iDisplay][0]; break;
        }
        aDispData[aDispData.length] = new Array(sBtnName, oResp["buttonDisplay"][iDisplay][1]);
        aDispData[aDispData.length] = new Array(sBtnName + "_t", oResp["buttonDisplay"][iDisplay][1]);
        aDispData[aDispData.length] = new Array(sBtnName + "_b", oResp["buttonDisplay"][iDisplay][1]);
        if ("" != sBtnName2)
        {
          aDispData[aDispData.length] = new Array(sBtnName2, oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName2 + "_top", oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName2 + "_bot", oResp["buttonDisplay"][iDisplay][1]);
        }
        if ("" != sBtnName3)
        {
          aDispData[aDispData.length] = new Array(sBtnName3, oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName3 + "_top", oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName3 + "_bot", oResp["buttonDisplay"][iDisplay][1]);
        }
      }
    }
    if (oResp["buttonDisplayVert"])
    {
      for (iDisplay = 0; iDisplay < oResp["buttonDisplayVert"].length; iDisplay++)
      {
        vertButton = oResp["buttonDisplayVert"][iDisplay];
        aDispData[aDispData.length] = new Array("sc_exc_line_" + vertButton.seq, vertButton.delete);
        if (vertButton.gridView)
        {
          aDispData[aDispData.length] = new Array("sc_open_line_" + vertButton.seq, vertButton.update);
        }
        else
        {
          aDispData[aDispData.length] = new Array("sc_upd_line_" + vertButton.seq, vertButton.update);
        }
      }
    }
    for (iDisplay = 0; iDisplay < aDispData.length; iDisplay++)
    {
      scAjaxElementDisplay(aDispData[iDisplay][0], aDispData[iDisplay][1]);
    }
	for (var blockId in blockDisplay) {
		displayChange_block(blockId, blockDisplay[blockId]);
	}
	for (var fieldId in fieldDisplay) {
		displayChange_field(fieldId, "", fieldDisplay[fieldId]);
	}
	if (controlHtmlHideField.length) {
	  for (iDisplay = 0; iDisplay < controlHtmlHideField.length; iDisplay++) {
	    scHideUserField(controlHtmlHideField[iDisplay]);
	  }
	}
	if (controlHtmlShowField.length) {
	  for (iDisplay = 0; iDisplay < controlHtmlShowField.length; iDisplay++) {
	    scShowUserField(controlHtmlShowField[iDisplay]);
	  }
	}
  } // scAjaxSetDisplay

  function scAjaxNavigateButtonDisplay(sButton, sStatus)
  {
    sButton2 = sButton + "_off";

    if ("off" == sStatus)
    {
      sStatus2 = "off";
    }
    else
    {
      if ("sc_b_ini" == sButton || "sc_b_ret" == sButton)
      {
        if ("S" == Nav_permite_ret)
        {
          sStatus  = "on";
          sStatus2 = "off";
        }
        else
        {
          sStatus  = "off";
          sStatus2 = "on";
        }
      }
      else
      {
        if ("S" == Nav_permite_ava)
        {
          sStatus  = "on";
          sStatus2 = "off";
        }
        else
        {
          sStatus  = "off";
          sStatus2 = "on";
        }
      }
    }

    scAjaxElementDisplay(sButton        , sStatus);
    scAjaxElementDisplay(sButton + "_t" , sStatus);
    scAjaxElementDisplay(sButton + "_b" , sStatus);
    scAjaxElementDisplay(sButton2       , sStatus2);
    scAjaxElementDisplay(sButton2 + "_t", sStatus2);
    scAjaxElementDisplay(sButton2 + "_b", sStatus2);
  } // scAjaxNavigateButtonDisplay

  function scAjaxElementDisplay(sElement, sAction)
  {
    if (ajax_block_tab && ajax_block_tab[sElement] && "" != ajax_block_tab[sElement])
    {
      scAjaxElementDisplay(ajax_block_tab[sElement], sAction);
    }
    if (document.getElementById(sElement))
    {

      if("off" == sAction)
      {
        $('#' + sElement).hide();
      }
      else
      {
        $('#' + sElement).show();
      }
      if (document.getElementById(sElement + "_dumb"))
      {
        if("off" == sAction)
        {
          $('#' + sElement + "_dumb").show();
        }
        else
        {
          $('#' + sElement + "_dumb").hide();
        }
      }
    }
  } // scAjaxElementDisplay

  function scAjaxSetLabel(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    if (bReset)
    {
      for (iLabel = 0; iLabel < ajax_field_list.length; iLabel++)
      {
        if (ajax_field_list[iLabel] && ajax_error_list[ajax_field_list[iLabel]])
        {
          scAjaxFieldLabel(ajax_field_list[iLabel], ajax_error_list[ajax_field_list[iLabel]]["label"]);
        }
      }
    }
    if (oResp["fieldLabel"])
    {
      for (iLabel = 0; iLabel < oResp["fieldLabel"].length; iLabel++)
      {
        scAjaxFieldLabel(oResp["fieldLabel"][iLabel][0], scAjaxSpecCharParser(oResp["fieldLabel"][iLabel][1]));
      }
    }
  } // scAjaxSetLabel

  function scAjaxFieldLabel(sField, sLabel)
  {
    if (document.getElementById("id_label_" + sField))
    {
      if (document.getElementById("id_label_" + sField).innerHTML != sLabel)
      {
        document.getElementById("id_label_" + sField).innerHTML = sLabel;
      }
    }
    else if (document.getElementById("hidden_field_label_" + sField) && document.getElementById("hidden_field_label_" + sField).innerHTML != sLabel)
    {
      document.getElementById("hidden_field_label_" + sField).innerHTML = sLabel;
    }
  } // scAjaxFieldLabel

  function scAjaxSetReadonly(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    if (bReset)
    {
      for (iRead = 0; iRead < ajax_field_list.length; iRead++)
      {
        scAjaxFieldRead(ajax_field_list[iRead], ajax_read_only[ajax_field_list[iRead]]);
      }
      for (iRead = 0; iRead < ajax_field_Dt_Hr.length; iRead++)
      {
        scAjaxFieldRead(ajax_field_Dt_Hr[iRead], ajax_read_only[ajax_field_Dt_Hr[iRead]]);
      }
    }
    if (oResp["readOnly"])
    {
      for (iRead = 0; iRead < oResp["readOnly"].length; iRead++)
      {
        if (ajax_read_only[ oResp["readOnly"][iRead][0] ])
        {
          scAjaxFieldRead(oResp["readOnly"][iRead][0], oResp["readOnly"][iRead][1]);
        }
        else if (oResp["rsSize"])
        {
          for (var i = 0; i <= oResp["rsSize"]; i++)
          {
            if (ajax_read_only[ oResp["readOnly"][iRead][0] + i ])
            {
              scAjaxFieldRead(oResp["readOnly"][iRead][0] + i, oResp["readOnly"][iRead][1]);
            }
          }
        }
      }
    }
  } // scAjaxSetReadonly

  function scAjaxFieldRead(sField, sStatus)
  {
    if ("on" == sStatus)
    {
      var sDisplayOff = "none";
      var sDisplayOn  = "";
    }
    else
    {
      var sDisplayOff = "";
      var sDisplayOn  = "none";
    }
    if (document.getElementById("id_read_off_" + sField))
    {
      document.getElementById("id_read_off_" + sField).style.display = sDisplayOff;
    }
    if (document.getElementById("id_sc_dragdrop_" + sField))
    {
      document.getElementById("id_sc_dragdrop_" + sField).style.display = sDisplayOff;
    }
    if (document.getElementById("id_read_on_" + sField))
    {
      document.getElementById("id_read_on_" + sField).style.display = sDisplayOn;
    }
  } // scAjaxFieldRead

  function scAjaxSetBtnVars()
  {
    if (oResp["btnVars"])
    {
      for (iBtn = 0; iBtn < oResp["btnVars"].length; iBtn++)
      {
        eval(oResp["btnVars"][iBtn][0] + " = scAjaxSpecCharParser('" + oResp["btnVars"][iBtn][1] + "');");
      }
    }
  } // scAjaxSetBtnVars

  function scAjaxClearText(sFormField)
  {
    document.F1.elements[sFormField].value = "";
  } // scAjaxClearText

  function scAjaxClearLabel(sFormField)
  {
    document.getElementById("id_ajax_label_" + sFormField).innerHTML = "";
  } // scAjaxClearLabel

  function scAjaxClearSelect(sFormField)
  {
    document.F1.elements[sFormField].length = 0;
  } // scAjaxClearSelect

  function scAjaxClearCheckbox(sFormField)
  {
    document.getElementById("idAjaxCheckbox_" + sFormField).innerHTML = "";
  } // scAjaxClearCheckbox

  function scAjaxClearRadio(sFormField)
  {
    document.getElementById("idAjaxRadio_" + sFormField).innerHTML = "";
  } // scAjaxClearRadio

  function scAjaxClearEditorHtml(sFormField)
  {
    if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    oFormField.setContent("");
  } // scAjaxClearEditorHtml

  function scCheckPagesWithoutBlock()
  {
	var page_id, block_id, has_block_shown;
    for (page_id in ajax_page_blocks) {
	  has_block_shown = false;
      for (block_id in ajax_page_blocks[page_id]) {
		console.log(page_id + ' ' + ajax_page_blocks[page_id][block_id]);
		console.log($("#div_" + ajax_block_id[ajax_page_blocks[page_id][block_id]]).css('display'));
        //$("#div_" + ajax_block_id[block_id]);
      }
    }
  }

  function scAjaxJavascript()
  {
    if (oResp["ajaxJavascript"])
    {
      var sJsFunc = "";
      for (var i = 0; i < oResp["ajaxJavascript"].length; i++)
      {
        sJsFunc = scAjaxSpecCharParser(oResp["ajaxJavascript"][i][0]);
        if ("" != sJsFunc)
        {
          var aParam = new Array();
          if (oResp["ajaxJavascript"][i][1] && 0 < oResp["ajaxJavascript"][i][1].length)
          {
            for (var j = 0; j < oResp["ajaxJavascript"][i][1].length; j++)
            {
              aParam.push("'" + oResp["ajaxJavascript"][i][1][j] + "'");
            }
          }
          eval("if (" + sJsFunc + ") { " + sJsFunc + "(" + aParam.join(", ") + ") }");
        }
      }
    }
  } // scAjaxJavascript

  function scAjaxAlert(callbackOk)
  {
    if (oResp["ajaxAlert"] && oResp["ajaxAlert"]["message"] && "" != oResp["ajaxAlert"]["message"])
    {
      scJs_alert(oResp["ajaxAlert"]["message"], callbackOk, oResp["ajaxAlert"]["params"]);
    }
    else
    {
      callbackOk();
    }
  } // scAjaxAlert

	function scJs_alert_default(message, callbackOk) {
		alert(message);
		if (typeof callbackOk == "function") {
			callbackOk();
		}
	} // scJs_alert_default

	function scJs_confirm_default(message, callbackOk, callbackCancel) {
		if (confirm(message)) {
			callbackOk();
		}
		else {
			callbackCancel();
		}
	} // scJs_confirm_default

  function scAjaxMessage(oTemp)
  {
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (oResp["ajaxMessage"] && oResp["ajaxMessage"]["message"] && "" != oResp["ajaxMessage"]["message"])
    {
      var sTitle    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["title"])        ? oResp["ajaxMessage"]["title"]               : scMsgDefTitle,
          bModal    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["modal"])        ? ("Y" == oResp["ajaxMessage"]["modal"])      : false,
          iTimeout  = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["timeout"])      ? parseInt(oResp["ajaxMessage"]["timeout"])   : 0,
          bButton   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["button"])       ? ("Y" == oResp["ajaxMessage"]["button"])     : false,
          sButton   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["button_label"]) ? oResp["ajaxMessage"]["button_label"]        : "Ok",
          iTop      = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["top"])          ? parseInt(oResp["ajaxMessage"]["top"])       : 0,
          iLeft     = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["left"])         ? parseInt(oResp["ajaxMessage"]["left"])      : 0,
          iWidth    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["width"])        ? parseInt(oResp["ajaxMessage"]["width"])     : 0,
          iHeight   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["height"])       ? parseInt(oResp["ajaxMessage"]["height"])    : 0,
          bClose    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["show_close"])   ? ("Y" == oResp["ajaxMessage"]["show_close"]) : true,
          bBodyIcon = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["body_icon"])    ? ("Y" == oResp["ajaxMessage"]["body_icon"])  : true,
          sRedir    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir"])        ? oResp["ajaxMessage"]["redir"]               : "",
          sTarget   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir_target"]) ? oResp["ajaxMessage"]["redir_target"]        : "",
          sParam    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir_par"])    ? oResp["ajaxMessage"]["redir_par"]           : "",
          bToast    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["toast"])        ? ("Y" == oResp["ajaxMessage"]["toast"])      : false,
          sToastPos = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["toast_pos"])    ? oResp["ajaxMessage"]["toast_pos"]           : "",
          sType     = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["type"])         ? oResp["ajaxMessage"]["type"]                : "";
      if (typeof scDisplayUserMessage == "function") {
        scDisplayUserMessage(oResp["ajaxMessage"]["message"]);
      }
      else {
		  var params = {
			  title: sTitle,
			  message: oResp["ajaxMessage"]["message"],
			  isModal: bModal,
			  timeout: iTimeout,
			  showButton: bButton,
			  buttonLabel: sButton,
			  topPos: iTop,
			  leftPos: iLeft,
			  width: iWidth,
			  height: iHeight,
			  redirUrl: sRedir,
			  redirTarget: sTarget,
			  redirParam: sParam,
			  showClose: bClose,
			  showBodyIcon: bBodyIcon,
			  isToast: bToast,
			  toastPos: sToastPos,
			  type: sType
		  };
        _scAjaxShowMessage(params);
      }
    }
  } // scAjaxMessage

  function scAjaxResponse(sResp)
  {
    eval("var oResp = " + sResp);
    return oResp;
  } // scAjaxResponse

  function scAjaxBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      input += "";
      while (input.lastIndexOf(String.fromCharCode(10)) > -1)
      {
         input = input.replace(String.fromCharCode(10), '<br>');
      }
      return input;
  } // scAjaxBreakLine

  function scAjaxProtectBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      var input1 = input + "";
      while (input1.lastIndexOf(String.fromCharCode(10)) > -1)
      {
         input1 = input1.replace(String.fromCharCode(10), '#@NM#@');
      }
      return input1;
  } // scAjaxProtectBreakLine

  function scAjaxReturnBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      while (input.lastIndexOf('#@NM#@') > -1)
      {
         input = input.replace('#@NM#@', String.fromCharCode(10));
      }
      return input;
  } // scAjaxReturnBreakLine

  function scOpenMasterDetail(widget, url)
  {
	  var iframe = $(parent.document).find("[name='" +  widget+ "']");
	  iframe.attr("src", url);
  } // scOpenMasterDetail

  function scMoveMasterDetail(widget)
  {
	  var iframe = $(parent.document).find("[name='" +  widget+ "']");
	  iframe[0].contentWindow.nm_move("apl_detalhe", true);
  } // scMoveMasterDetail

	function scAjaxError_markList() {
	    if ('undefined' == typeof oResp.errList) {
	        return;
	    }
		var i, fieldName, fieldList = new Array();
		for (i = 0; i < oResp.errList.length; i++) {
			fieldName = oResp.errList[i]["fldName"];
			if (oResp.errList[i]["numLinha"]) {
				fieldName += oResp.errList[i]["numLinha"];
			}
            fieldList.push(fieldName);
		}
		scAjaxError_markFieldList(fieldList);
	} // scAjaxError_markList

	function scAjaxError_markFieldList(fieldList) {
		var i;
		for (i = 0; i < fieldList.length; i++) {
            scAjaxError_markField(fieldList[i]);
		}
	} // scAjaxError_markFieldList

	function scAjaxError_unmarkList() {
		var i;
		for (i = 0; i < ajax_field_list.length; i++) {
            scAjaxError_unmarkField(ajax_field_list[i]);
		}
	} // scAjaxError_unmarkList

	function scAjaxError_markField(fieldName) {
		var $oField = $("#id_sc_field_" + fieldName);
		if (0 < $oField.length) {
			scAjax_applyFieldErrorStyle($oField);
		}
	} // scAjaxError_markField

	function scAjaxError_unmarkField(fieldName) {
		var $oField = $("#id_sc_field_" + fieldName);
		if (0 < $oField.length) {
			scAjax_removeFieldErrorStyle($oField);
		}
	} // scAjaxError_unmarkField

	function scAjax_displayEmptyForm() {
        $("#sc-ui-empty-form").show();
        $(".sc-ui-page-tab-line").hide();
        $("#sc-id-required-row").hide();
        sc_hide_form_prod_presupuesto_periodo_mob_form();
	}

  function scAjax_applyFieldErrorStyle(fieldObj) {
    if (fieldObj.hasClass("sc-ui-pwd-toggle")) {
        fieldObj.addClass(sc_css_status_pwd_text);
        fieldObj.parent().addClass(sc_css_status_pwd_box);
      } else {
        fieldObj.addClass(sc_css_status);
      }
  }

  function scAjax_removeFieldErrorStyle(fieldObj) {
    if (fieldObj.hasClass("sc-ui-pwd-toggle")) {
        fieldObj.removeClass(sc_css_status_pwd_text);
        fieldObj.parent().removeClass(sc_css_status_pwd_box);
      } else {
        fieldObj.removeClass(sc_css_status);
      }
  }

  function scAjax_formReload() {
<?php
    if ($this->nmgp_opcao == 'novo') {
        echo "      nm_move('reload_novo');";
    } else {
        echo "      nm_move('igual');";
    }
?>
  }

  function scBtnDisabled()
  {
    var btnNameNav, hasNavButton = false;

    if (typeof oResp.btnDisabled != undefined) {
      for (var btnName in oResp.btnDisabled) {
        btnNameNav = btnName.substring(0, 9);

        if ("on" == oResp.btnDisabled[btnName]) {
          $("#" + btnName).addClass("disabled");

          if ("sc_b_ini_" == btnNameNav) {
            Nav_binicio_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_ret_" == btnNameNav) {
            Nav_bretorna_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_avc_" == btnNameNav) {
            Nav_bavanca_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_fim_" == btnNameNav) {
            Nav_bfinal_macro_disabled = "on";
            hasNavButton = true;
          }
        } else {
          $("#" + btnName).removeClass("disabled");

          if ("sc_b_ini_" == btnNameNav) {
            Nav_binicio_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_ret_" == btnNameNav) {
            Nav_bretorna_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_avc_" == btnNameNav) {
            Nav_bavanca_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_fim_" == btnNameNav) {
            Nav_bfinal_macro_disabled = "off";
            hasNavButton = true;
          }
        }
      }
    }

    if (hasNavButton) {
      nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');
      nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');
    }
  }

  function scBtnLabel()
  {
    if (typeof oResp.btnLabel != undefined) {
      for (var btnName in oResp.btnLabel) {
        $("#" + btnName).find(".btn-label").html(oResp.btnLabel[btnName]);
      }
    }
  }

  var scFormHasChanged = false;

  function scMarkFormAsChanged() {
    scFormHasChanged = true;
  }

  function scResetFormChanges() {
    scFormHasChanged = false;
  }

  var isRunning_scFormClose_F5 = false;
  function scFormClose_F5(exitUrl) {
    if (isRunning_scFormClose_F5) {
      return;
    }
    isRunning_scFormClose_F5 = true;
    setTimeout(function() { isRunning_scFormClose_F5 = false; }, 3000);

    document.F5.action = exitUrl;
    document.F5.submit();

  }

  var isRunning_scFormClose_F6 = false;
  function scFormClose_F6(exitUrl) {
    if (isRunning_scFormClose_F6) {
      return;
    }
    isRunning_scFormClose_F6 = true;
    setTimeout(function() { isRunning_scFormClose_F6 = false; }, 3000);

    document.F6.action = exitUrl;
    document.F6.submit();

  }

  // ---------- Validate id
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_id()
  {
    var nomeCampo_id = "id";
    var var_id = scAjaxGetFieldHidden(nomeCampo_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_id(var_id, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_id_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_id

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "id";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_id_cb

  // ---------- Validate id_proyecto
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_id_proyecto()
  {
    var nomeCampo_id_proyecto = "id_proyecto";
    var var_id_proyecto = scAjaxGetFieldSelect(nomeCampo_id_proyecto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_id_proyecto(var_id_proyecto, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_id_proyecto_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_id_proyecto

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_id_proyecto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "id_proyecto";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_id_proyecto_cb

  // ---------- Validate monto_contrato
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_contrato()
  {
    var nomeCampo_monto_contrato = "monto_contrato";
    var var_monto_contrato = scAjaxGetFieldText(nomeCampo_monto_contrato);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_monto_contrato(var_monto_contrato, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_contrato_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_contrato

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_contrato_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "monto_contrato";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_contrato_cb

  // ---------- Validate tipo_moneda
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_tipo_moneda()
  {
    var nomeCampo_tipo_moneda = "tipo_moneda";
    var var_tipo_moneda = scAjaxGetFieldSelect(nomeCampo_tipo_moneda);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_tipo_moneda(var_tipo_moneda, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_tipo_moneda_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_tipo_moneda

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_tipo_moneda_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "tipo_moneda";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_tipo_moneda_cb

  // ---------- Validate empresa
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_empresa()
  {
    var nomeCampo_empresa = "empresa";
    var var_empresa = scAjaxGetFieldSelect(nomeCampo_empresa);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_empresa(var_empresa, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_empresa_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_empresa

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_empresa_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "empresa";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_empresa_cb

  // ---------- Validate cliente
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_cliente()
  {
    var nomeCampo_cliente = "cliente";
    var var_cliente = scAjaxGetFieldSelect(nomeCampo_cliente);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_cliente(var_cliente, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_cliente_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_cliente

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_cliente_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "cliente";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_cliente_cb

  // ---------- Validate id_partida
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_id_partida()
  {
    var nomeCampo_id_partida = "id_partida";
    var var_id_partida = scAjaxGetFieldSelect(nomeCampo_id_partida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_id_partida(var_id_partida, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_id_partida_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_id_partida

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_id_partida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "id_partida";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_id_partida_cb

  // ---------- Validate fecha_desde
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde()
  {
    var nomeCampo_fecha_desde = "fecha_desde";
    var var_fecha_desde = scAjaxGetFieldText(nomeCampo_fecha_desde);
    var var_script_case_init = document.F1.script_case_init.value;
    setTimeout(function() {
      var var_fecha_desde = scAjaxGetFieldText(nomeCampo_fecha_desde);
      x_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde(var_fecha_desde, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_cb);
    }, 200);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "fecha_desde";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors || ($("#ui-datepicker-div").length && $("#ui-datepicker-div").filter(":visible").length))
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_cb

  // ---------- Validate fecha_hasta
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta()
  {
    var nomeCampo_fecha_hasta = "fecha_hasta";
    var var_fecha_hasta = scAjaxGetFieldText(nomeCampo_fecha_hasta);
    var var_script_case_init = document.F1.script_case_init.value;
    setTimeout(function() {
      var var_fecha_hasta = scAjaxGetFieldText(nomeCampo_fecha_hasta);
      x_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta(var_fecha_hasta, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_cb);
    }, 200);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "fecha_hasta";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors || ($("#ui-datepicker-div").length && $("#ui-datepicker-div").filter(":visible").length))
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_cb

  // ---------- Validate dias_desde
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_desde()
  {
    var nomeCampo_dias_desde = "dias_desde";
    var var_dias_desde = scAjaxGetFieldText(nomeCampo_dias_desde);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_dias_desde(var_dias_desde, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_desde_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_desde

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_desde_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "dias_desde";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_desde_cb

  // ---------- Validate dias_hasta
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_hasta()
  {
    var nomeCampo_dias_hasta = "dias_hasta";
    var var_dias_hasta = scAjaxGetFieldText(nomeCampo_dias_hasta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_dias_hasta(var_dias_hasta, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_hasta_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_hasta

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_hasta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "dias_hasta";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_hasta_cb

  // ---------- Validate dias_periodo
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_periodo()
  {
    var nomeCampo_dias_periodo = "dias_periodo";
    var var_dias_periodo = scAjaxGetFieldText(nomeCampo_dias_periodo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_dias_periodo(var_dias_periodo, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_periodo_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_periodo

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_periodo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "dias_periodo";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_periodo_cb

  // ---------- Validate fecha_desde_factura
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_factura()
  {
    var nomeCampo_fecha_desde_factura = "fecha_desde_factura";
    var var_fecha_desde_factura = scAjaxGetFieldText(nomeCampo_fecha_desde_factura);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_factura(var_fecha_desde_factura, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_factura_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_factura

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_factura_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "fecha_desde_factura";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_factura_cb

  // ---------- Validate fecha_hasta_factura
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_factura()
  {
    var nomeCampo_fecha_hasta_factura = "fecha_hasta_factura";
    var var_fecha_hasta_factura = scAjaxGetFieldText(nomeCampo_fecha_hasta_factura);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_factura(var_fecha_hasta_factura, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_factura_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_factura

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_factura_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "fecha_hasta_factura";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_factura_cb

  // ---------- Validate avance_informado_con_iva
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_avance_informado_con_iva()
  {
    var nomeCampo_avance_informado_con_iva = "avance_informado_con_iva";
    var var_avance_informado_con_iva = scAjaxGetFieldText(nomeCampo_avance_informado_con_iva);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_avance_informado_con_iva(var_avance_informado_con_iva, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_avance_informado_con_iva_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_avance_informado_con_iva

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_avance_informado_con_iva_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "avance_informado_con_iva";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_avance_informado_con_iva_cb

  // ---------- Validate produccion_neto
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_produccion_neto()
  {
    var nomeCampo_produccion_neto = "produccion_neto";
    var var_produccion_neto = scAjaxGetFieldText(nomeCampo_produccion_neto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_produccion_neto(var_produccion_neto, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_produccion_neto_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_produccion_neto

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_produccion_neto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "produccion_neto";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_produccion_neto_cb

  // ---------- Validate retencion
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion()
  {
    var nomeCampo_retencion = "retencion";
    var var_retencion = scAjaxGetFieldText(nomeCampo_retencion);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_retencion(var_retencion, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "retencion";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_cb

  // ---------- Validate retencion_con_iva
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_con_iva()
  {
    var nomeCampo_retencion_con_iva = "retencion_con_iva";
    var var_retencion_con_iva = scAjaxGetFieldText(nomeCampo_retencion_con_iva);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_con_iva(var_retencion_con_iva, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_con_iva_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_con_iva

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_con_iva_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "retencion_con_iva";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_con_iva_cb

  // ---------- Validate retencion_acumulada
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_acumulada()
  {
    var nomeCampo_retencion_acumulada = "retencion_acumulada";
    var var_retencion_acumulada = scAjaxGetFieldText(nomeCampo_retencion_acumulada);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_acumulada(var_retencion_acumulada, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_acumulada_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_acumulada

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_acumulada_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "retencion_acumulada";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_acumulada_cb

  // ---------- Validate reajuste_acumulado_con_iva
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_con_iva()
  {
    var nomeCampo_reajuste_acumulado_con_iva = "reajuste_acumulado_con_iva";
    var var_reajuste_acumulado_con_iva = scAjaxGetFieldText(nomeCampo_reajuste_acumulado_con_iva);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_con_iva(var_reajuste_acumulado_con_iva, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_con_iva_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_con_iva

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_con_iva_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "reajuste_acumulado_con_iva";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_con_iva_cb

  // ---------- Validate reajuste_acumulado_neto
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_neto()
  {
    var nomeCampo_reajuste_acumulado_neto = "reajuste_acumulado_neto";
    var var_reajuste_acumulado_neto = scAjaxGetFieldText(nomeCampo_reajuste_acumulado_neto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_neto(var_reajuste_acumulado_neto, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_neto_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_neto

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_neto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "reajuste_acumulado_neto";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_neto_cb

  // ---------- Validate multa
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_multa()
  {
    var nomeCampo_multa = "multa";
    var var_multa = scAjaxGetFieldText(nomeCampo_multa);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_multa(var_multa, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_multa_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_multa

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_multa_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "multa";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_multa_cb

  // ---------- Validate total_facturado
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_total_facturado()
  {
    var nomeCampo_total_facturado = "total_facturado";
    var var_total_facturado = scAjaxGetFieldText(nomeCampo_total_facturado);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_total_facturado(var_total_facturado, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_total_facturado_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_total_facturado

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_total_facturado_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "total_facturado";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_total_facturado_cb

  // ---------- Validate afecta_iva
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_afecta_iva()
  {
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_afecta_iva

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_afecta_iva_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "afecta_iva";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_afecta_iva_cb

  // ---------- Validate existe_retencion
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_existe_retencion()
  {
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_existe_retencion

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_existe_retencion_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "existe_retencion";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_existe_retencion_cb

  // ---------- Validate incluye_retencion
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_incluye_retencion()
  {
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_incluye_retencion

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_incluye_retencion_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "incluye_retencion";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_incluye_retencion_cb

  // ---------- Validate considera_retencion
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_considera_retencion()
  {
    var nomeCampo_considera_retencion = "considera_retencion";
    var var_considera_retencion = scAjaxGetFieldSelect(nomeCampo_considera_retencion);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_considera_retencion(var_considera_retencion, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_considera_retencion_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_considera_retencion

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_considera_retencion_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "considera_retencion";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_considera_retencion_cb

  // ---------- Validate facturado
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_facturado()
  {
    var nomeCampo_facturado = "facturado";
    var var_facturado = scAjaxGetFieldSelect(nomeCampo_facturado);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_facturado(var_facturado, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_facturado_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_facturado

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_facturado_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "facturado";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_facturado_cb

  // ---------- Validate observaciones_solicitud
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_solicitud()
  {
    var nomeCampo_observaciones_solicitud = "observaciones_solicitud";
    var var_observaciones_solicitud = scAjaxGetFieldText(nomeCampo_observaciones_solicitud);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_solicitud(var_observaciones_solicitud, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_solicitud_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_solicitud

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_solicitud_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "observaciones_solicitud";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_solicitud_cb

  // ---------- Validate iva
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_iva()
  {
    var nomeCampo_iva = "iva";
    var var_iva = scAjaxGetFieldText(nomeCampo_iva);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_iva(var_iva, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_iva_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_iva

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_iva_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "iva";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_iva_cb

  // ---------- Validate monto_uf
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_uf()
  {
    var nomeCampo_monto_uf = "monto_uf";
    var var_monto_uf = scAjaxGetFieldText(nomeCampo_monto_uf);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_monto_uf(var_monto_uf, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_uf_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_uf

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_uf_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "monto_uf";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_uf_cb

  // ---------- Validate fecha
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha()
  {
    var nomeCampo_fecha = "fecha";
    var var_fecha = scAjaxGetFieldText(nomeCampo_fecha);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_fecha(var_fecha, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "fecha";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_cb

  // ---------- Validate valor_uf
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_valor_uf()
  {
    var nomeCampo_valor_uf = "valor_uf";
    var var_valor_uf = scAjaxGetFieldText(nomeCampo_valor_uf);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_valor_uf(var_valor_uf, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_valor_uf_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_valor_uf

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_valor_uf_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "valor_uf";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_valor_uf_cb

  // ---------- Validate observaciones
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones()
  {
    var nomeCampo_observaciones = "observaciones";
    var var_observaciones = scAjaxGetFieldText(nomeCampo_observaciones);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones(var_observaciones, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "observaciones";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_cb

  // ---------- Validate factura
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_factura()
  {
    var nomeCampo_factura = "factura";
    var var_factura = scAjaxGetFieldText(nomeCampo_factura);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_factura(var_factura, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_factura_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_factura

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_factura_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "factura";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_factura_cb

  // ---------- Validate hitos_facturacion
  function do_ajax_form_prod_presupuesto_periodo_mob_validate_hitos_facturacion()
  {
    var nomeCampo_hitos_facturacion = "hitos_facturacion";
    nm_pack(nomeCampo_hitos_facturacion + '_dest', nomeCampo_hitos_facturacion);
    var var_hitos_facturacion = scAjaxGetFieldText(nomeCampo_hitos_facturacion);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_prod_presupuesto_periodo_mob_validate_hitos_facturacion(var_hitos_facturacion, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_validate_hitos_facturacion_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_hitos_facturacion

  function do_ajax_form_prod_presupuesto_periodo_mob_validate_hitos_facturacion_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "hitos_facturacion";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_prod_presupuesto_periodo_mob_validate_hitos_facturacion_cb

  // ---------- Event onchange considera_retencion
  function do_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange()
  {
    var var_considera_retencion = scAjaxGetFieldSelect("considera_retencion");
    var var_monto_uf = scAjaxGetFieldText("monto_uf");
    var var_retencion = scAjaxGetFieldText("retencion");
    var var_iva = scAjaxGetFieldText("iva");
    var var_retencion_con_iva = scAjaxGetFieldText("retencion_con_iva");
    var var_produccion_neto = scAjaxGetFieldText("produccion_neto");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange(var_considera_retencion, var_monto_uf, var_retencion, var_iva, var_retencion_con_iva, var_produccion_neto, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange

  function do_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "considera_retencion";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange_cb_after_alert

  // ---------- Event onchange fecha_desde_factura
  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange()
  {
    var var_produccion_neto = scAjaxGetFieldText("produccion_neto");
    var var_reajuste_acumulado_neto = scAjaxGetFieldText("reajuste_acumulado_neto");
    var var_retencion_acumulada = scAjaxGetFieldText("retencion_acumulada");
    var var_fecha_desde_factura = scAjaxGetFieldText("fecha_desde_factura");
    var var_fecha_hasta_factura = scAjaxGetFieldText("fecha_hasta_factura");
    var var_fecha_desde = scAjaxGetFieldText("fecha_desde");
    var var_id_proyecto = scAjaxGetFieldSelect("id_proyecto");
    var var_reajuste_acumulado_con_iva = scAjaxGetFieldText("reajuste_acumulado_con_iva");
    var var_avance_informado_con_iva = scAjaxGetFieldText("avance_informado_con_iva");
    var var_multa = scAjaxGetFieldText("multa");
    var var_retencion_con_iva = scAjaxGetFieldText("retencion_con_iva");
    var var_existe_retencion = scAjaxGetFieldHidden("existe_retencion");
    var var_retencion = scAjaxGetFieldText("retencion");
    var var_considera_retencion = scAjaxGetFieldSelect("considera_retencion");
    var var_iva = scAjaxGetFieldText("iva");
    var var_monto_uf = scAjaxGetFieldText("monto_uf");
    var var_total_facturado = scAjaxGetFieldText("total_facturado");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange(var_produccion_neto, var_reajuste_acumulado_neto, var_retencion_acumulada, var_fecha_desde_factura, var_fecha_hasta_factura, var_fecha_desde, var_id_proyecto, var_reajuste_acumulado_con_iva, var_avance_informado_con_iva, var_multa, var_retencion_con_iva, var_existe_retencion, var_retencion, var_considera_retencion, var_iva, var_monto_uf, var_total_facturado, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange

  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "fecha_desde_factura";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange_cb_after_alert

  // ---------- Event onchange fecha_desde
  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange()
  {
    var var_fecha_desde = scAjaxGetFieldText("fecha_desde");
    var var_dias_desde = scAjaxGetFieldText("dias_desde");
    var var_dias_periodo = scAjaxGetFieldText("dias_periodo");
    var var_fecha_hasta = scAjaxGetFieldText("fecha_hasta");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange(var_fecha_desde, var_dias_desde, var_dias_periodo, var_fecha_hasta, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange

  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "fecha_desde";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange_cb_after_alert

  // ---------- Event onchange fecha_hasta_factura
  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange()
  {
    var var_produccion_neto = scAjaxGetFieldText("produccion_neto");
    var var_reajuste_acumulado_neto = scAjaxGetFieldText("reajuste_acumulado_neto");
    var var_retencion_acumulada = scAjaxGetFieldText("retencion_acumulada");
    var var_fecha_desde_factura = scAjaxGetFieldText("fecha_desde_factura");
    var var_fecha_hasta_factura = scAjaxGetFieldText("fecha_hasta_factura");
    var var_fecha_desde = scAjaxGetFieldText("fecha_desde");
    var var_id_proyecto = scAjaxGetFieldSelect("id_proyecto");
    var var_reajuste_acumulado_con_iva = scAjaxGetFieldText("reajuste_acumulado_con_iva");
    var var_avance_informado_con_iva = scAjaxGetFieldText("avance_informado_con_iva");
    var var_multa = scAjaxGetFieldText("multa");
    var var_retencion_con_iva = scAjaxGetFieldText("retencion_con_iva");
    var var_existe_retencion = scAjaxGetFieldHidden("existe_retencion");
    var var_retencion = scAjaxGetFieldText("retencion");
    var var_considera_retencion = scAjaxGetFieldSelect("considera_retencion");
    var var_iva = scAjaxGetFieldText("iva");
    var var_monto_uf = scAjaxGetFieldText("monto_uf");
    var var_total_facturado = scAjaxGetFieldText("total_facturado");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange(var_produccion_neto, var_reajuste_acumulado_neto, var_retencion_acumulada, var_fecha_desde_factura, var_fecha_hasta_factura, var_fecha_desde, var_id_proyecto, var_reajuste_acumulado_con_iva, var_avance_informado_con_iva, var_multa, var_retencion_con_iva, var_existe_retencion, var_retencion, var_considera_retencion, var_iva, var_monto_uf, var_total_facturado, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange

  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "fecha_hasta_factura";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange_cb_after_alert

  // ---------- Event onchange fecha_hasta
  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange()
  {
    var var_fecha_hasta = scAjaxGetFieldText("fecha_hasta");
    var var_fecha_desde = scAjaxGetFieldText("fecha_desde");
    var var_dias_hasta = scAjaxGetFieldText("dias_hasta");
    var var_dias_desde = scAjaxGetFieldText("dias_desde");
    var var_dias_periodo = scAjaxGetFieldText("dias_periodo");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange(var_fecha_hasta, var_fecha_desde, var_dias_hasta, var_dias_desde, var_dias_periodo, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange

  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "fecha_hasta";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange_cb_after_alert

  // ---------- Event onchange id_partida
  function do_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange()
  {
    var var_id_partida = scAjaxGetFieldSelect("id_partida");
    var var_monto_contrato = scAjaxGetFieldText("monto_contrato");
    var var_monto_uf = scAjaxGetFieldText("monto_uf");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange(var_id_partida, var_monto_contrato, var_monto_uf, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange

  function do_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "id_partida";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    do_ajax_form_prod_presupuesto_periodo_mob_refresh_id_partida();
    scAjaxRedir();
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange_cb_after_alert

  // ---------- Event onchange multa
  function do_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange()
  {
    var var_produccion_neto = scAjaxGetFieldText("produccion_neto");
    var var_reajuste_acumulado_neto = scAjaxGetFieldText("reajuste_acumulado_neto");
    var var_fecha_desde_factura = scAjaxGetFieldText("fecha_desde_factura");
    var var_fecha_hasta_factura = scAjaxGetFieldText("fecha_hasta_factura");
    var var_fecha_desde = scAjaxGetFieldText("fecha_desde");
    var var_id_proyecto = scAjaxGetFieldSelect("id_proyecto");
    var var_reajuste_acumulado_con_iva = scAjaxGetFieldText("reajuste_acumulado_con_iva");
    var var_avance_informado_con_iva = scAjaxGetFieldText("avance_informado_con_iva");
    var var_multa = scAjaxGetFieldText("multa");
    var var_retencion_con_iva = scAjaxGetFieldText("retencion_con_iva");
    var var_retencion = scAjaxGetFieldText("retencion");
    var var_incluye_retencion = scAjaxGetFieldHidden("incluye_retencion");
    var var_iva = scAjaxGetFieldText("iva");
    var var_monto_uf = scAjaxGetFieldText("monto_uf");
    var var_total_facturado = scAjaxGetFieldText("total_facturado");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange(var_produccion_neto, var_reajuste_acumulado_neto, var_fecha_desde_factura, var_fecha_hasta_factura, var_fecha_desde, var_id_proyecto, var_reajuste_acumulado_con_iva, var_avance_informado_con_iva, var_multa, var_retencion_con_iva, var_retencion, var_incluye_retencion, var_iva, var_monto_uf, var_total_facturado, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange

  function do_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "multa";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange_cb_after_alert

  // ---------- Event onchange retencion
  function do_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange()
  {
    var var_monto_uf = scAjaxGetFieldText("monto_uf");
    var var_retencion = scAjaxGetFieldText("retencion");
    var var_iva = scAjaxGetFieldText("iva");
    var var_retencion_con_iva = scAjaxGetFieldText("retencion_con_iva");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange(var_monto_uf, var_retencion, var_iva, var_retencion_con_iva, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange

  function do_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "retencion";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange_cb_after_alert
function scAjaxShowErrorDisplay(sErrorId, sErrorMsg) {
	scAjaxShowErrorDisplay_default(sErrorId, sErrorMsg);
}

function scAjaxHideErrorDisplay(sErrorId, sErrorMsg) {
	scAjaxHideErrorDisplay_default(sErrorId, sErrorMsg);
}

function scAjaxShowMessage(messageType) {
	scAjaxShowMessage_default();
}

function scAjaxHideMessage() {
	scAjaxHideMessage_default();
}

function _scAjaxShowMessage(params) {
	_scAjaxShowMessage_default(params);
} // _scAjaxShowMessage

function scJs_alert(message, callbackOk, params) {
    message = message.replace(/<!--SC_NL-->/gi, "\n");
	scJs_alert_default(message, callbackOk);
} // scJs_alert

function scJs_confirm(message, callbackOk, callbackCancel) {
	scJs_confirm_default(message, callbackOk, callbackCancel);
} // scJs_confirm

  // ---------- Form
  function do_ajax_form_prod_presupuesto_periodo_mob_submit_form()
  {
    if (scEventControl_active("")) {
      setTimeout(function() { do_ajax_form_prod_presupuesto_periodo_mob_submit_form(); }, 500);
      return;
    }
    scAjaxHideMessage();
    var var_id = scAjaxGetFieldHidden("id");
    var var_id_proyecto = scAjaxGetFieldSelect("id_proyecto");
    var var_monto_contrato = scAjaxGetFieldText("monto_contrato");
    var var_tipo_moneda = scAjaxGetFieldSelect("tipo_moneda");
    var var_empresa = scAjaxGetFieldSelect("empresa");
    var var_cliente = scAjaxGetFieldSelect("cliente");
    var var_id_partida = scAjaxGetFieldSelect("id_partida");
    var var_fecha_desde = scAjaxGetFieldText("fecha_desde");
    var var_fecha_hasta = scAjaxGetFieldText("fecha_hasta");
    var var_dias_desde = scAjaxGetFieldText("dias_desde");
    var var_dias_hasta = scAjaxGetFieldText("dias_hasta");
    var var_dias_periodo = scAjaxGetFieldText("dias_periodo");
    var var_fecha_desde_factura = scAjaxGetFieldText("fecha_desde_factura");
    var var_fecha_hasta_factura = scAjaxGetFieldText("fecha_hasta_factura");
    var var_avance_informado_con_iva = scAjaxGetFieldText("avance_informado_con_iva");
    var var_produccion_neto = scAjaxGetFieldText("produccion_neto");
    var var_retencion = scAjaxGetFieldText("retencion");
    var var_retencion_con_iva = scAjaxGetFieldText("retencion_con_iva");
    var var_retencion_acumulada = scAjaxGetFieldText("retencion_acumulada");
    var var_reajuste_acumulado_con_iva = scAjaxGetFieldText("reajuste_acumulado_con_iva");
    var var_reajuste_acumulado_neto = scAjaxGetFieldText("reajuste_acumulado_neto");
    var var_multa = scAjaxGetFieldText("multa");
    var var_total_facturado = scAjaxGetFieldText("total_facturado");
    var var_afecta_iva = scAjaxGetFieldHidden("afecta_iva");
    var var_existe_retencion = scAjaxGetFieldHidden("existe_retencion");
    var var_incluye_retencion = scAjaxGetFieldHidden("incluye_retencion");
    var var_considera_retencion = scAjaxGetFieldSelect("considera_retencion");
    var var_facturado = scAjaxGetFieldSelect("facturado");
    var var_observaciones_solicitud = scAjaxGetFieldText("observaciones_solicitud");
    var var_iva = scAjaxGetFieldText("iva");
    var var_monto_uf = scAjaxGetFieldText("monto_uf");
    var var_fecha = scAjaxGetFieldText("fecha");
    var var_valor_uf = scAjaxGetFieldText("valor_uf");
    var var_observaciones = scAjaxGetFieldText("observaciones");
    var var_factura = scAjaxGetFieldText("factura");
    nm_pack("hitos_facturacion_dest", "hitos_facturacion");
    var var_hitos_facturacion = scAjaxGetFieldText("hitos_facturacion", "@?@");
    var var_factura_ul_name = scAjaxSpecCharProtect(document.F1.factura_ul_name.value);//.replace(/[+]/g, "__NM_PLUS__");
    var var_factura_ul_type = document.F1.factura_ul_type.value;
    var var_factura_salva = scAjaxSpecCharProtect(document.F1.factura_salva.value);//.replace(/[+]/g, "__NM_PLUS__");
    var var_factura_limpa = document.F1.factura_limpa.checked ? "S" : "N";
    var var_nm_form_submit = document.F1.nm_form_submit.value;
    var var_nmgp_url_saida = document.F1.nmgp_url_saida.value;
    var var_nmgp_opcao = document.F1.nmgp_opcao.value;
    var var_nmgp_ancora = document.F1.nmgp_ancora.value;
    var var_nmgp_num_form = document.F1.nmgp_num_form.value;
    var var_nmgp_parms = document.F1.nmgp_parms.value;
    var var_script_case_init = document.F1.script_case_init.value;
    var var_csrf_token = scAjaxGetFieldText("csrf_token");
    scAjaxProcOn();
    x_ajax_form_prod_presupuesto_periodo_mob_submit_form(var_id, var_id_proyecto, var_monto_contrato, var_tipo_moneda, var_empresa, var_cliente, var_id_partida, var_fecha_desde, var_fecha_hasta, var_dias_desde, var_dias_hasta, var_dias_periodo, var_fecha_desde_factura, var_fecha_hasta_factura, var_avance_informado_con_iva, var_produccion_neto, var_retencion, var_retencion_con_iva, var_retencion_acumulada, var_reajuste_acumulado_con_iva, var_reajuste_acumulado_neto, var_multa, var_total_facturado, var_afecta_iva, var_existe_retencion, var_incluye_retencion, var_considera_retencion, var_facturado, var_observaciones_solicitud, var_iva, var_monto_uf, var_fecha, var_valor_uf, var_observaciones, var_factura, var_hitos_facturacion, var_factura_ul_name, var_factura_ul_type, var_factura_salva, var_factura_limpa, var_nm_form_submit, var_nmgp_url_saida, var_nmgp_opcao, var_nmgp_ancora, var_nmgp_num_form, var_nmgp_parms, var_script_case_init, var_csrf_token, do_ajax_form_prod_presupuesto_periodo_mob_submit_form_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_submit_form

  function do_ajax_form_prod_presupuesto_periodo_mob_submit_form_cb(sResp)
  {
    scAjaxProcOff();
    oResp = scAjaxResponse(sResp);
    scAjaxUpdateErrors("valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors || "menu_link" == document.F1.nmgp_opcao.value)
    {
      $('.sc-js-ui-statusimg').css('display', 'none');
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxError_markList();
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (scAjaxIsOk())
    {
      scResetFormChanges();
      scAjaxShowMessage("success");
      scAjaxHideErrorDisplay("table");
      scAjaxHideErrorDisplay("id");
      scAjaxHideErrorDisplay("id_proyecto");
      scAjaxHideErrorDisplay("monto_contrato");
      scAjaxHideErrorDisplay("tipo_moneda");
      scAjaxHideErrorDisplay("empresa");
      scAjaxHideErrorDisplay("cliente");
      scAjaxHideErrorDisplay("id_partida");
      scAjaxHideErrorDisplay("fecha_desde");
      scAjaxHideErrorDisplay("fecha_hasta");
      scAjaxHideErrorDisplay("dias_desde");
      scAjaxHideErrorDisplay("dias_hasta");
      scAjaxHideErrorDisplay("dias_periodo");
      scAjaxHideErrorDisplay("fecha_desde_factura");
      scAjaxHideErrorDisplay("fecha_hasta_factura");
      scAjaxHideErrorDisplay("avance_informado_con_iva");
      scAjaxHideErrorDisplay("produccion_neto");
      scAjaxHideErrorDisplay("retencion");
      scAjaxHideErrorDisplay("retencion_con_iva");
      scAjaxHideErrorDisplay("retencion_acumulada");
      scAjaxHideErrorDisplay("reajuste_acumulado_con_iva");
      scAjaxHideErrorDisplay("reajuste_acumulado_neto");
      scAjaxHideErrorDisplay("multa");
      scAjaxHideErrorDisplay("total_facturado");
      scAjaxHideErrorDisplay("afecta_iva");
      scAjaxHideErrorDisplay("existe_retencion");
      scAjaxHideErrorDisplay("incluye_retencion");
      scAjaxHideErrorDisplay("considera_retencion");
      scAjaxHideErrorDisplay("facturado");
      scAjaxHideErrorDisplay("observaciones_solicitud");
      scAjaxHideErrorDisplay("iva");
      scAjaxHideErrorDisplay("monto_uf");
      scAjaxHideErrorDisplay("fecha");
      scAjaxHideErrorDisplay("valor_uf");
      scAjaxHideErrorDisplay("observaciones");
      scAjaxHideErrorDisplay("factura");
      scAjaxHideErrorDisplay("hitos_facturacion");
      scLigEditLookupCall();
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_mob']['dashboard_info']['under_dashboard']) {
?>
      var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_mob']['dashboard_info']['parent_widget']; ?>']");
      if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.nm_gp_move) {
        dbParentFrame[0].contentWindow.nm_gp_move("igual");
      }
<?php
}
?>
    }
    Nm_Proc_Atualiz = false;
    if (!scAjaxHasError())
    {
      scAjaxSetFields(false);
      scAjaxSetVariables();
      scAjaxSetMaster();
      if (scInlineFormSend())
      {
        self.parent.tb_remove();
        return;
      }
      if (document.F1.factura_limpa && document.F1.factura_limpa.checked)
      {
        var oImgTemp = {0: {"value" : ""}};
        scAjaxSetFieldDocument("factura", oImgTemp, "", "");
      }
      else if (document.getElementById("id_ajax_doc_factura") && "" != document.getElementById("id_ajax_doc_factura").innerHTML)
      {
        document.getElementById("id_ajax_doc_factura").style.display = "";
      }
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_submit_form_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_submit_form_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_submit_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_prod_presupuesto_periodo_mob_submit_form_cb_after_alert

  var scStatusDetail = {};

  function do_ajax_form_prod_presupuesto_periodo_mob_navigate_form()
  {
    perform_ajax_form_prod_presupuesto_periodo_mob_navigate_form();
  }

  function perform_ajax_form_prod_presupuesto_periodo_mob_navigate_form()
  {
    if (scRefreshTable())
    {
      return;
    }
    scAjaxHideMessage();
    scAjaxHideErrorDisplay("table");
    scAjaxHideErrorDisplay("id");
    scAjaxHideErrorDisplay("id_proyecto");
    scAjaxHideErrorDisplay("monto_contrato");
    scAjaxHideErrorDisplay("tipo_moneda");
    scAjaxHideErrorDisplay("empresa");
    scAjaxHideErrorDisplay("cliente");
    scAjaxHideErrorDisplay("id_partida");
    scAjaxHideErrorDisplay("fecha_desde");
    scAjaxHideErrorDisplay("fecha_hasta");
    scAjaxHideErrorDisplay("dias_desde");
    scAjaxHideErrorDisplay("dias_hasta");
    scAjaxHideErrorDisplay("dias_periodo");
    scAjaxHideErrorDisplay("fecha_desde_factura");
    scAjaxHideErrorDisplay("fecha_hasta_factura");
    scAjaxHideErrorDisplay("avance_informado_con_iva");
    scAjaxHideErrorDisplay("produccion_neto");
    scAjaxHideErrorDisplay("retencion");
    scAjaxHideErrorDisplay("retencion_con_iva");
    scAjaxHideErrorDisplay("retencion_acumulada");
    scAjaxHideErrorDisplay("reajuste_acumulado_con_iva");
    scAjaxHideErrorDisplay("reajuste_acumulado_neto");
    scAjaxHideErrorDisplay("multa");
    scAjaxHideErrorDisplay("total_facturado");
    scAjaxHideErrorDisplay("afecta_iva");
    scAjaxHideErrorDisplay("existe_retencion");
    scAjaxHideErrorDisplay("incluye_retencion");
    scAjaxHideErrorDisplay("considera_retencion");
    scAjaxHideErrorDisplay("facturado");
    scAjaxHideErrorDisplay("observaciones_solicitud");
    scAjaxHideErrorDisplay("iva");
    scAjaxHideErrorDisplay("monto_uf");
    scAjaxHideErrorDisplay("fecha");
    scAjaxHideErrorDisplay("valor_uf");
    scAjaxHideErrorDisplay("observaciones");
    scAjaxHideErrorDisplay("factura");
    scAjaxHideErrorDisplay("hitos_facturacion");
    var var_id = document.F2.id.value;
    var var_id_proyecto = document.F2.id_proyecto.value;
    var var_nm_form_submit = document.F2.nm_form_submit.value;
    var var_nmgp_opcao = document.F2.nmgp_opcao.value;
    var var_nmgp_ordem = document.F2.nmgp_ordem.value;
    var var_nmgp_fast_search = document.F2.nmgp_fast_search.value;
    var var_nmgp_cond_fast_search = document.F2.nmgp_cond_fast_search.value;
    var var_nmgp_arg_fast_search = document.F2.nmgp_arg_fast_search.value;
    var var_nmgp_arg_dyn_search = document.F2.nmgp_arg_dyn_search.value;
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn();
    x_ajax_form_prod_presupuesto_periodo_mob_navigate_form(var_id, var_id_proyecto, var_nm_form_submit, var_nmgp_opcao, var_nmgp_ordem, var_nmgp_fast_search,  var_nmgp_cond_fast_search,  var_nmgp_arg_fast_search, var_nmgp_arg_dyn_search, var_script_case_init, do_ajax_form_prod_presupuesto_periodo_mob_navigate_form_cb);
  } // do_ajax_form_prod_presupuesto_periodo_mob_navigate_form

  var scMasterDetailParentIframe = "<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_prod_presupuesto_periodo_mob']['dashboard_info']['parent_widget'] ?>";
  var scMasterDetailIframe = {};
<?php
foreach ($this->Ini->sc_lig_iframe as $tmp_i => $tmp_v)
{
?>
  scMasterDetailIframe["<?php echo $tmp_i; ?>"] = "<?php echo $tmp_v; ?>";
<?php
}
?>
  function do_ajax_form_prod_presupuesto_periodo_mob_navigate_form_cb(sResp)
  {
    scAjaxProcOff();
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    if (oResp['empty_filter'] && oResp['empty_filter'] == "ok")
    {
        document.F5.nmgp_opcao.value = "inicio";
        document.F5.nmgp_parms.value = "";
        document.F5.submit();
    }
    if ("ERROR" == oResp.result)
    {
        scAjaxShowErrorDisplay("table", oResp.errList[0].msgText);
        scAjaxProcOff();
        return;
    }
    else if (oResp["navSummary"].reg_tot == 0)
    {
       scAjax_displayEmptyForm();
    }
    scAjaxClearErrors()
    scResetFormChanges()
    sc_mupload_ok = true;
    scAjaxSetFields(false);
    scAjaxSetVariables();
    document.F2.id.value = scAjaxGetKeyValue("id");
    document.F2.id_proyecto.value = scAjaxGetKeyValue("id_proyecto");
    scAjaxSetSummary();
    scAjaxSetNavpage();
    scAjaxShowDebug();
    scAjaxSetLabel(true);
    scAjaxSetReadonly(true);
    scAjaxSetMaster();
    scAjaxSetNavStatus("t");
    scAjaxSetNavStatus("b");
    scAjaxSetDisplay(true);
    scAjaxSetBtnVars();
    $('.sc-js-ui-statusimg').css('display', 'none');
    scAjaxAlert(do_ajax_form_prod_presupuesto_periodo_mob_navigate_form_cb_after_alert);
  } // do_ajax_form_prod_presupuesto_periodo_mob_navigate_form_cb
  function do_ajax_form_prod_presupuesto_periodo_mob_navigate_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scQuickSearchKeyUp('t', null);
    $('#SC_fast_search_t').blur();
    scAjaxSetFocus();
<?php
if ($this->Embutida_form)
{
?>
    do_ajax_form_prod_presupuesto_periodo_mob_restore_buttons();
<?php
}
?>
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_prod_presupuesto_periodo_mob_navigate_form_cb_after_alert

  function sc_hide_form_prod_presupuesto_periodo_mob_form()
  {
    for (var block_id in ajax_block_id) {
      $("#div_" + ajax_block_id[block_id]).hide();
    }
  } // sc_hide_form_prod_presupuesto_periodo_mob_form


  function scAjaxDetailProc()
  {
    return true;
  } // scAjaxDetailProc


  var ajax_error_geral = "";

  var ajax_error_type = new Array("valid", "onblur", "onchange", "onclick", "onfocus");

  var ajax_field_list = new Array();
  var ajax_field_Dt_Hr = new Array();
  ajax_field_list[0] = "id";
  ajax_field_list[1] = "id_proyecto";
  ajax_field_list[2] = "monto_contrato";
  ajax_field_list[3] = "tipo_moneda";
  ajax_field_list[4] = "empresa";
  ajax_field_list[5] = "cliente";
  ajax_field_list[6] = "id_partida";
  ajax_field_list[7] = "fecha_desde";
  ajax_field_list[8] = "fecha_hasta";
  ajax_field_list[9] = "dias_desde";
  ajax_field_list[10] = "dias_hasta";
  ajax_field_list[11] = "dias_periodo";
  ajax_field_list[12] = "fecha_desde_factura";
  ajax_field_list[13] = "fecha_hasta_factura";
  ajax_field_list[14] = "avance_informado_con_iva";
  ajax_field_list[15] = "produccion_neto";
  ajax_field_list[16] = "retencion";
  ajax_field_list[17] = "retencion_con_iva";
  ajax_field_list[18] = "retencion_acumulada";
  ajax_field_list[19] = "reajuste_acumulado_con_iva";
  ajax_field_list[20] = "reajuste_acumulado_neto";
  ajax_field_list[21] = "multa";
  ajax_field_list[22] = "total_facturado";
  ajax_field_list[23] = "afecta_iva";
  ajax_field_list[24] = "existe_retencion";
  ajax_field_list[25] = "incluye_retencion";
  ajax_field_list[26] = "considera_retencion";
  ajax_field_list[27] = "facturado";
  ajax_field_list[28] = "observaciones_solicitud";
  ajax_field_list[29] = "iva";
  ajax_field_list[30] = "monto_uf";
  ajax_field_list[31] = "fecha";
  ajax_field_list[32] = "valor_uf";
  ajax_field_list[33] = "observaciones";
  ajax_field_list[34] = "factura";
  ajax_field_list[35] = "hitos_facturacion";

  var ajax_block_list = new Array();
  ajax_block_list[0] = "0";
  ajax_block_list[1] = "1";
  ajax_block_list[2] = "2";
  ajax_block_list[3] = "3";
  ajax_block_list[4] = "4";
  ajax_block_list[5] = "5";
  ajax_block_list[6] = "6";

  var ajax_error_list = {
    "id": {"label": "ID", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_proyecto": {"label": "Proyecto", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "monto_contrato": {"label": "Presupuesto Del Contrato - BASE", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tipo_moneda": {"label": "Tipo Moneda", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "empresa": {"label": "Empresa", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cliente": {"label": "Cliente", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_partida": {"label": "Período Asociado", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "fecha_desde": {"label": "Fecha Desde - PERÍODO", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "fecha_hasta": {"label": "Fecha Hasta - PERÍODO", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "dias_desde": {"label": "Dias Mes Actual", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "dias_hasta": {"label": "Dias Mes Siguiente", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "dias_periodo": {"label": "Dias Totales Período", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "fecha_desde_factura": {"label": "Factura Producción Desde", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "fecha_hasta_factura": {"label": "Factura Producción Hasta", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "avance_informado_con_iva": {"label": "Monto Producción Con IVA", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "produccion_neto": {"label": "Monto Producción Neto", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "retencion": {"label": "Retención Período - Neto", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "retencion_con_iva": {"label": "Retencion Período - Con IVA", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "retencion_acumulada": {"label": "Retención Total Acumulada ", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "reajuste_acumulado_con_iva": {"label": "Reajuste Acumulado Con IVA", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "reajuste_acumulado_neto": {"label": "Reajuste Acumulado Neto", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "multa": {"label": "Multas EP Neto", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "total_facturado": {"label": "Total A Facturar EP", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "afecta_iva": {"label": "Afecta a IVA", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "existe_retencion": {"label": "Existe Retención ?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "incluye_retencion": {"label": "Factura Incluye Retención ?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "considera_retencion": {"label": "Retención Pertenece Al Período Informado ?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "facturado": {"label": "Facturado", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "observaciones_solicitud": {"label": "Observaciones Estado Facturación", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "iva": {"label": "Monto A Facturar Con IVA", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "monto_uf": {"label": "Monto Neto A Facturar", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "fecha": {"label": "Fecha Facturación", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "valor_uf": {"label": "Valor Moneda Día", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "observaciones": {"label": "Observaciones", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "factura": {"label": "Documento Factura", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hitos_facturacion": {"label": "Hitos Relacionados", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0}
  };
  var ajax_error_timeout = 0;

  var ajax_block_id = {
    "0": "hidden_bloco_0",
    "1": "hidden_bloco_1",
    "2": "hidden_bloco_2",
    "3": "hidden_bloco_3",
    "4": "hidden_bloco_4",
    "5": "hidden_bloco_5",
    "6": "hidden_bloco_6"
  };

  var ajax_block_tab = {
    "hidden_bloco_0": "",
    "hidden_bloco_1": "",
    "hidden_bloco_2": "",
    "hidden_bloco_3": "",
    "hidden_bloco_4": "",
    "hidden_bloco_5": "",
    "hidden_bloco_6": ""
  };

  var ajax_field_mult = {
    "id": new Array(),
    "id_proyecto": new Array(),
    "monto_contrato": new Array(),
    "tipo_moneda": new Array(),
    "empresa": new Array(),
    "cliente": new Array(),
    "id_partida": new Array(),
    "fecha_desde": new Array(),
    "fecha_hasta": new Array(),
    "dias_desde": new Array(),
    "dias_hasta": new Array(),
    "dias_periodo": new Array(),
    "fecha_desde_factura": new Array(),
    "fecha_hasta_factura": new Array(),
    "avance_informado_con_iva": new Array(),
    "produccion_neto": new Array(),
    "retencion": new Array(),
    "retencion_con_iva": new Array(),
    "retencion_acumulada": new Array(),
    "reajuste_acumulado_con_iva": new Array(),
    "reajuste_acumulado_neto": new Array(),
    "multa": new Array(),
    "total_facturado": new Array(),
    "afecta_iva": new Array(),
    "existe_retencion": new Array(),
    "incluye_retencion": new Array(),
    "considera_retencion": new Array(),
    "facturado": new Array(),
    "observaciones_solicitud": new Array(),
    "iva": new Array(),
    "monto_uf": new Array(),
    "fecha": new Array(),
    "valor_uf": new Array(),
    "observaciones": new Array(),
    "factura": new Array(),
    "hitos_facturacion": new Array()
  };
  ajax_field_mult["id"][1] = "id";
  ajax_field_mult["id_proyecto"][1] = "id_proyecto";
  ajax_field_mult["monto_contrato"][1] = "monto_contrato";
  ajax_field_mult["tipo_moneda"][1] = "tipo_moneda";
  ajax_field_mult["empresa"][1] = "empresa";
  ajax_field_mult["cliente"][1] = "cliente";
  ajax_field_mult["id_partida"][1] = "id_partida";
  ajax_field_mult["fecha_desde"][1] = "fecha_desde";
  ajax_field_mult["fecha_hasta"][1] = "fecha_hasta";
  ajax_field_mult["dias_desde"][1] = "dias_desde";
  ajax_field_mult["dias_hasta"][1] = "dias_hasta";
  ajax_field_mult["dias_periodo"][1] = "dias_periodo";
  ajax_field_mult["fecha_desde_factura"][1] = "fecha_desde_factura";
  ajax_field_mult["fecha_hasta_factura"][1] = "fecha_hasta_factura";
  ajax_field_mult["avance_informado_con_iva"][1] = "avance_informado_con_iva";
  ajax_field_mult["produccion_neto"][1] = "produccion_neto";
  ajax_field_mult["retencion"][1] = "retencion";
  ajax_field_mult["retencion_con_iva"][1] = "retencion_con_iva";
  ajax_field_mult["retencion_acumulada"][1] = "retencion_acumulada";
  ajax_field_mult["reajuste_acumulado_con_iva"][1] = "reajuste_acumulado_con_iva";
  ajax_field_mult["reajuste_acumulado_neto"][1] = "reajuste_acumulado_neto";
  ajax_field_mult["multa"][1] = "multa";
  ajax_field_mult["total_facturado"][1] = "total_facturado";
  ajax_field_mult["afecta_iva"][1] = "afecta_iva";
  ajax_field_mult["existe_retencion"][1] = "existe_retencion";
  ajax_field_mult["incluye_retencion"][1] = "incluye_retencion";
  ajax_field_mult["considera_retencion"][1] = "considera_retencion";
  ajax_field_mult["facturado"][1] = "facturado";
  ajax_field_mult["observaciones_solicitud"][1] = "observaciones_solicitud";
  ajax_field_mult["iva"][1] = "iva";
  ajax_field_mult["monto_uf"][1] = "monto_uf";
  ajax_field_mult["fecha"][1] = "fecha";
  ajax_field_mult["valor_uf"][1] = "valor_uf";
  ajax_field_mult["observaciones"][1] = "observaciones";
  ajax_field_mult["factura"][1] = "factura";
  ajax_field_mult["hitos_facturacion"][1] = "hitos_facturacion";

  var ajax_field_id = {
    "id": new Array("hidden_field_label_id", "hidden_field_data_id"),
    "id_proyecto": new Array("hidden_field_label_id_proyecto", "hidden_field_data_id_proyecto"),
    "monto_contrato": new Array("hidden_field_label_monto_contrato", "hidden_field_data_monto_contrato"),
    "tipo_moneda": new Array("hidden_field_label_tipo_moneda", "hidden_field_data_tipo_moneda"),
    "empresa": new Array("hidden_field_label_empresa", "hidden_field_data_empresa"),
    "cliente": new Array("hidden_field_label_cliente", "hidden_field_data_cliente"),
    "id_partida": new Array("hidden_field_label_id_partida", "hidden_field_data_id_partida"),
    "fecha_desde": new Array("hidden_field_label_fecha_desde", "hidden_field_data_fecha_desde"),
    "fecha_hasta": new Array("hidden_field_label_fecha_hasta", "hidden_field_data_fecha_hasta"),
    "dias_desde": new Array("hidden_field_label_dias_desde", "hidden_field_data_dias_desde"),
    "dias_hasta": new Array("hidden_field_label_dias_hasta", "hidden_field_data_dias_hasta"),
    "dias_periodo": new Array("hidden_field_label_dias_periodo", "hidden_field_data_dias_periodo"),
    "fecha_desde_factura": new Array("hidden_field_label_fecha_desde_factura", "hidden_field_data_fecha_desde_factura"),
    "fecha_hasta_factura": new Array("hidden_field_label_fecha_hasta_factura", "hidden_field_data_fecha_hasta_factura"),
    "avance_informado_con_iva": new Array("hidden_field_label_avance_informado_con_iva", "hidden_field_data_avance_informado_con_iva"),
    "produccion_neto": new Array("hidden_field_label_produccion_neto", "hidden_field_data_produccion_neto"),
    "retencion": new Array("hidden_field_label_retencion", "hidden_field_data_retencion"),
    "retencion_con_iva": new Array("hidden_field_label_retencion_con_iva", "hidden_field_data_retencion_con_iva"),
    "retencion_acumulada": new Array("hidden_field_label_retencion_acumulada", "hidden_field_data_retencion_acumulada"),
    "reajuste_acumulado_con_iva": new Array("hidden_field_label_reajuste_acumulado_con_iva", "hidden_field_data_reajuste_acumulado_con_iva"),
    "reajuste_acumulado_neto": new Array("hidden_field_label_reajuste_acumulado_neto", "hidden_field_data_reajuste_acumulado_neto"),
    "multa": new Array("hidden_field_label_multa", "hidden_field_data_multa"),
    "total_facturado": new Array("hidden_field_label_total_facturado", "hidden_field_data_total_facturado"),
    "afecta_iva": new Array("hidden_field_label_afecta_iva", "hidden_field_data_afecta_iva"),
    "existe_retencion": new Array("hidden_field_label_existe_retencion", "hidden_field_data_existe_retencion"),
    "incluye_retencion": new Array("hidden_field_label_incluye_retencion", "hidden_field_data_incluye_retencion"),
    "considera_retencion": new Array("hidden_field_label_considera_retencion", "hidden_field_data_considera_retencion"),
    "facturado": new Array("hidden_field_label_facturado", "hidden_field_data_facturado"),
    "observaciones_solicitud": new Array("hidden_field_label_observaciones_solicitud", "hidden_field_data_observaciones_solicitud"),
    "iva": new Array("hidden_field_label_iva", "hidden_field_data_iva"),
    "monto_uf": new Array("hidden_field_label_monto_uf", "hidden_field_data_monto_uf"),
    "fecha": new Array("hidden_field_label_fecha", "hidden_field_data_fecha"),
    "valor_uf": new Array("hidden_field_label_valor_uf", "hidden_field_data_valor_uf"),
    "observaciones": new Array("hidden_field_label_observaciones", "hidden_field_data_observaciones"),
    "factura": new Array("hidden_field_label_factura", "hidden_field_data_factura"),
    "hitos_facturacion": new Array("hidden_field_label_hitos_facturacion", "hidden_field_data_hitos_facturacion")
  };

  var ajax_read_only = {
    "id": "on",
    "id_proyecto": "on",
    "monto_contrato": "on",
    "tipo_moneda": "off",
    "empresa": "off",
    "cliente": "off",
    "id_partida": "on",
    "fecha_desde": "off",
    "fecha_hasta": "off",
    "dias_desde": "on",
    "dias_hasta": "on",
    "dias_periodo": "on",
    "fecha_desde_factura": "off",
    "fecha_hasta_factura": "off",
    "avance_informado_con_iva": "on",
    "produccion_neto": "on",
    "retencion": "off",
    "retencion_con_iva": "on",
    "retencion_acumulada": "on",
    "reajuste_acumulado_con_iva": "on",
    "reajuste_acumulado_neto": "on",
    "multa": "off",
    "total_facturado": "on",
    "afecta_iva": "off",
    "existe_retencion": "off",
    "incluye_retencion": "off",
    "considera_retencion": "off",
    "facturado": "off",
    "observaciones_solicitud": "off",
    "iva": "off",
    "monto_uf": "on",
    "fecha": "off",
    "valor_uf": "off",
    "observaciones": "off",
    "factura": "off",
    "hitos_facturacion": "off"
  };
  var bRefreshTable = false;
  function scRefreshTable()
  {
    return false;
  }

  function scAjaxDetailValue(sIndex, sValue)
  {
    var aValue = new Array();
    aValue[0] = {"value" : sValue};
    if ("id" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("id_proyecto" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("monto_contrato" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("tipo_moneda" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("empresa" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("cliente" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("id_partida" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("fecha_desde" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("fecha_hasta" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dias_desde" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dias_hasta" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dias_periodo" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("fecha_desde_factura" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("fecha_hasta_factura" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("avance_informado_con_iva" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("produccion_neto" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("retencion" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("retencion_con_iva" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("retencion_acumulada" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("reajuste_acumulado_con_iva" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("reajuste_acumulado_neto" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("multa" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("total_facturado" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("afecta_iva" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("existe_retencion" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("incluye_retencion" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("considera_retencion" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("facturado" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("observaciones_solicitud" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("iva" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("monto_uf" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("fecha" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("valor_uf" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("observaciones" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("factura" == sIndex)
    {
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hitos_facturacion" == sIndex)
    {
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    scAjaxSetFieldInnerHtml(sIndex, aValue);
  }
 </SCRIPT>
