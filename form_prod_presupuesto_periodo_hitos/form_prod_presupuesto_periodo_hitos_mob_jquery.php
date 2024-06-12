
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if ($("#id_ac_" + sField).length > 0) {
    if ($oField.hasClass("select2-hidden-accessible")) {
      if (false == scSetFocusOnField($oField)) {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
    else {
      if (false == scSetFocusOnField($oField)) {
        if (false == scSetFocusOnField($("#id_ac_" + sField))) {
          setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
        }
      }
      else {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_presupuesto_periodo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_hito" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["estado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha_hito" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["adjunto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["link_externo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hitos_asociados" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id" + iSeqRow] && scEventControl_data["id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id" + iSeqRow] && scEventControl_data["id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_presupuesto_periodo" + iSeqRow] && scEventControl_data["id_presupuesto_periodo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_presupuesto_periodo" + iSeqRow] && scEventControl_data["id_presupuesto_periodo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_hito" + iSeqRow] && scEventControl_data["id_hito" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_hito" + iSeqRow] && scEventControl_data["id_hito" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["estado" + iSeqRow] && scEventControl_data["estado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["estado" + iSeqRow] && scEventControl_data["estado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha_hito" + iSeqRow] && scEventControl_data["fecha_hito" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha_hito" + iSeqRow] && scEventControl_data["fecha_hito" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["link_externo" + iSeqRow] && scEventControl_data["link_externo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["link_externo" + iSeqRow] && scEventControl_data["link_externo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hitos_asociados" + iSeqRow] && scEventControl_data["hitos_asociados" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hitos_asociados" + iSeqRow] && scEventControl_data["hitos_asociados" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val() || scEventControl_data[sFieldName]["calculated"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_id' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_hitos_id_onblur(this, iSeqRow) })
                                .bind('focus', function() { sc_form_prod_presupuesto_periodo_hitos_id_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_presupuesto_periodo' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_hitos_id_presupuesto_periodo_onblur(this, iSeqRow) })
                                                    .bind('focus', function() { sc_form_prod_presupuesto_periodo_hitos_id_presupuesto_periodo_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_hito' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_hitos_id_hito_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_prod_presupuesto_periodo_hitos_id_hito_onfocus(this, iSeqRow) });
  $('#id_sc_field_estado' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_hitos_estado_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_prod_presupuesto_periodo_hitos_estado_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha_hito' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_hitos_fecha_hito_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_prod_presupuesto_periodo_hitos_fecha_hito_onfocus(this, iSeqRow) });
  $('#id_sc_field_adjunto' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_hitos_adjunto_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_prod_presupuesto_periodo_hitos_adjunto_onfocus(this, iSeqRow) });
  $('#id_sc_field_link_externo' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_hitos_link_externo_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_prod_presupuesto_periodo_hitos_link_externo_onfocus(this, iSeqRow) });
  $('#id_sc_field_hitos_asociados' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_hitos_hitos_asociados_onblur(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_prod_presupuesto_periodo_hitos_hitos_asociados_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_prod_presupuesto_periodo_hitos_id_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_hitos_mob_validate_id();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_id_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_id_presupuesto_periodo_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_hitos_mob_validate_id_presupuesto_periodo();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_id_presupuesto_periodo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_id_hito_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_hitos_mob_validate_id_hito();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_id_hito_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_estado_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_hitos_mob_validate_estado();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_estado_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_fecha_hito_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_hitos_mob_validate_fecha_hito();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_fecha_hito_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_adjunto_onblur(oThis, iSeqRow) {
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_adjunto_onfocus(oThis, iSeqRow) {
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_link_externo_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_hitos_mob_validate_link_externo();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_link_externo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_hitos_asociados_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_hitos_mob_validate_hitos_asociados();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_hitos_asociados_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("id", "", status);
	displayChange_field("id_presupuesto_periodo", "", status);
	displayChange_field("id_hito", "", status);
	displayChange_field("estado", "", status);
	displayChange_field("fecha_hito", "", status);
	displayChange_field("adjunto", "", status);
	displayChange_field("link_externo", "", status);
	displayChange_field("hitos_asociados", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_id(row, status);
	displayChange_field_id_presupuesto_periodo(row, status);
	displayChange_field_id_hito(row, status);
	displayChange_field_estado(row, status);
	displayChange_field_fecha_hito(row, status);
	displayChange_field_adjunto(row, status);
	displayChange_field_link_externo(row, status);
	displayChange_field_hitos_asociados(row, status);
}

function displayChange_field(field, row, status) {
	if ("id" == field) {
		displayChange_field_id(row, status);
	}
	if ("id_presupuesto_periodo" == field) {
		displayChange_field_id_presupuesto_periodo(row, status);
	}
	if ("id_hito" == field) {
		displayChange_field_id_hito(row, status);
	}
	if ("estado" == field) {
		displayChange_field_estado(row, status);
	}
	if ("fecha_hito" == field) {
		displayChange_field_fecha_hito(row, status);
	}
	if ("adjunto" == field) {
		displayChange_field_adjunto(row, status);
	}
	if ("link_externo" == field) {
		displayChange_field_link_externo(row, status);
	}
	if ("hitos_asociados" == field) {
		displayChange_field_hitos_asociados(row, status);
	}
}

function displayChange_field_id(row, status) {
    var fieldId;
}

function displayChange_field_id_presupuesto_periodo(row, status) {
    var fieldId;
}

function displayChange_field_id_hito(row, status) {
    var fieldId;
}

function displayChange_field_estado(row, status) {
    var fieldId;
}

function displayChange_field_fecha_hito(row, status) {
    var fieldId;
}

function displayChange_field_adjunto(row, status) {
    var fieldId;
}

function displayChange_field_link_externo(row, status) {
    var fieldId;
}

function displayChange_field_hitos_asociados(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_prod_presupuesto_periodo_hitos_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(47);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_fecha_hito" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha_hito" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_prod_presupuesto_periodo_hitos_mob_validate_fecha_hito(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha_hito']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  })
<?php
if ('' != $miniCalendarFA) {
?>
    .next('button').append("<?php echo $miniCalendarFA; ?>")
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    .next('button').append("<?php echo $miniCalendarButton[0]; ?>")
<?php
}
?>
} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_adjunto" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_prod_presupuesto_periodo_hitos_mob_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'adjunto'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_adjunto" + iSeqRow);
        loaderContent = $("#id_img_loader_adjunto" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_adjunto" + iSeqRow);
        loader.show();
      }
    },
    done: function(e, data) {
      var fileData, respData, respPos, respMsg, thumbDisplay, checkDisplay, var_ajax_img_thumb, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_adjunto" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_adjunto" + iSeqRow).hide();
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : respMsg};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = "";
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("minFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      $("#id_sc_field_adjunto" + iSeqRow).val("");
      $("#id_sc_field_adjunto_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_adjunto_ul_type" + iSeqRow).val(fileData[0].type);
      $("#id_ajax_doc_adjunto" + iSeqRow).html(fileData[0].name);
      $("#id_ajax_doc_adjunto" + iSeqRow).css("display", "");
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_adjunto" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_adjunto" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
    }
  });

} // scJQUploadAdd

var api_cache_requests = [];
function ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, hasRun, img_before){
    setTimeout(function(){
        if(img_name == '') return;
        iSeqRow= iSeqRow !== undefined && iSeqRow !== null ? iSeqRow : '';
        var hasVar = p.indexOf('_@NM@_') > -1 || p_cache.indexOf('_@NM@_') > -1 ? true : false;

        p = p.split('_@NM@_');
        $.each(p, function(i,v){
            try{
                p[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p[i] = v;
            }
        });
        p = p.join('');

        p_cache = p_cache.split('_@NM@_');
        $.each(p_cache, function(i,v){
            try{
                p_cache[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p_cache[i] = v;
            }
        });
        p_cache = p_cache.join('');

        img_before = img_before !== undefined ? img_before : $(t).attr('src');
        var str_key_cache = '<?php echo $this->Ini->sc_page; ?>' + img_name+field+p+p_cache;
        if(api_cache_requests[ str_key_cache ] !== undefined && api_cache_requests[ str_key_cache ] !== null){
            if(api_cache_requests[ str_key_cache ] != false){
                do_ajax_check_file(api_cache_requests[ str_key_cache ], field  ,t, iSeqRow);
            }
            return;
        }
        //scAjaxProcOn();
        $(t).attr('src', '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif');
        api_cache_requests[ str_key_cache ] = false;
        var rs =$.ajax({
                    type: "POST",
                    url: 'index.php?script_case_init=<?php echo $this->Ini->sc_page; ?>',
                    async: true,
                    data:'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + encodeURI(img_name) +'&rsargs='+ field + '&p=' + p + '&p_cache=' + p_cache,
                    success: function (rs) {
                        if(rs.indexOf('</span>') != -1){
                            rs = rs.substr(rs.indexOf('</span>') + 7);
                        }
                        if(rs.indexOf('/') != -1 && rs.indexOf('/') != 0){
                            rs = rs.substr(rs.indexOf('/'));
                        }
                        rs = sc_trim(rs);

                        // if(rs == 0 && hasVar && hasRun === undefined){
                        //     delete window.api_cache_requests[ str_key_cache ];
                        //     ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, 1, img_before);
                        //     return;
                        // }
                        window.api_cache_requests[ str_key_cache ] = rs;
                        do_ajax_check_file(rs, field  ,t, iSeqRow)
                        if(rs == 0){
                            delete window.api_cache_requests[ str_key_cache ];

                           // $(t).attr('src',img_before);
                            do_ajax_check_file(img_before+'_@@NM@@_' + img_before, field  ,t, iSeqRow)

                        }


                    }
        });
    },100);
}

function do_ajax_check_file(rs, field  ,t, iSeqRow){
    if (rs != 0) {
        rs_split = rs.split('_@@NM@@_');
        rs_orig = rs_split[0];
        rs2 = rs_split[1];
        try{
            if(!$(t).is('img')){

                if($('#id_read_on_'+field+iSeqRow).length > 0 ){
                                    var usa_read_only = false;

                switch(field){

                }
                     if(usa_read_only && $('a',$('#id_read_on_'+field+iSeqRow)).length == 0){
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_prod_presupuesto_periodo_hitos_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href', target.join(','));
                }else{
                    var target = $(t).attr('href').split(',');
                     target[1] = "'"+rs2+"'";
                     $(t).attr('href', target.join(','));
                }
            }else{
                $(t).attr('src', rs2);
                $(t).css('display', '');
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $(t).attr('href', target.join(','));
                }else{
                     var t_link = $(t).parent('a');
                     var target = $(t_link).attr('href').split(',');
                     target[0] = "javascript:nm_mostra_img('"+rs_orig+"'";
                     $(t_link).attr('href', target.join(','));
                }

            }
            eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        } catch(err){
                        eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        }
    }
   /* hasFalseCacheRequest = false;
    $.each(api_cache_requests, function(i,v){
        if(v == false){
            hasFalseCacheRequest = true;
        }
    });
    if(hasFalseCacheRequest == false){
        scAjaxProcOff();
    }*/
}

$(document).ready(function(){
});


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

function scGetFileExtension(fileName)
{
    fileNameParts = fileName.split(".");

    if (1 === fileNameParts.length || (2 === fileNameParts.length && "" == fileNameParts[0])) {
        return "";
    }

    return fileNameParts.pop().toLowerCase();
}

function scFormatExtensionSizeErrorMsg(errorMsg)
{
    var msgInfo = errorMsg.split("||"), returnMsg = "";

    if ("err_size" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_size'] ?>. <?php echo $this->Ini->Nm_lang['lang_errm_file_size_extension'] ?>".replace("{SC_EXTENSION}", msgInfo[1]).replace("{SC_LIMIT}", msgInfo[2]);
    } else if ("err_extension" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_invl'] ?>";
    }

    return returnMsg;
}

