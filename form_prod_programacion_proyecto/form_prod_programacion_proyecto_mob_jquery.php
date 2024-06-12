
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
  scEventControl_data["id_proyecto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["modificacion_contrato" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["avance" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["facturacion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["costos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["saldo_ur" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["backlog_p" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["backlog_f" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ur_real" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["correlativo_mes" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id" + iSeqRow] && scEventControl_data["id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id" + iSeqRow] && scEventControl_data["id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_proyecto" + iSeqRow] && scEventControl_data["id_proyecto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_proyecto" + iSeqRow] && scEventControl_data["id_proyecto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha" + iSeqRow] && scEventControl_data["fecha" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha" + iSeqRow] && scEventControl_data["fecha" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["modificacion_contrato" + iSeqRow] && scEventControl_data["modificacion_contrato" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["modificacion_contrato" + iSeqRow] && scEventControl_data["modificacion_contrato" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["avance" + iSeqRow] && scEventControl_data["avance" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["avance" + iSeqRow] && scEventControl_data["avance" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["facturacion" + iSeqRow] && scEventControl_data["facturacion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["facturacion" + iSeqRow] && scEventControl_data["facturacion" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["costos" + iSeqRow] && scEventControl_data["costos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["costos" + iSeqRow] && scEventControl_data["costos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["saldo_ur" + iSeqRow] && scEventControl_data["saldo_ur" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["saldo_ur" + iSeqRow] && scEventControl_data["saldo_ur" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["backlog_p" + iSeqRow] && scEventControl_data["backlog_p" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["backlog_p" + iSeqRow] && scEventControl_data["backlog_p" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["backlog_f" + iSeqRow] && scEventControl_data["backlog_f" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["backlog_f" + iSeqRow] && scEventControl_data["backlog_f" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ur_real" + iSeqRow] && scEventControl_data["ur_real" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ur_real" + iSeqRow] && scEventControl_data["ur_real" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["correlativo_mes" + iSeqRow] && scEventControl_data["correlativo_mes" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["correlativo_mes" + iSeqRow] && scEventControl_data["correlativo_mes" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("id_proyecto" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
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
  $('#id_sc_field_id' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_id_onblur(this, iSeqRow) })
                                .bind('focus', function() { sc_form_prod_programacion_proyecto_id_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_proyecto' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_id_proyecto_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prod_programacion_proyecto_id_proyecto_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_fecha_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_prod_programacion_proyecto_fecha_onfocus(this, iSeqRow) });
  $('#id_sc_field_modificacion_contrato' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_modificacion_contrato_onblur(this, iSeqRow) })
                                                   .bind('focus', function() { sc_form_prod_programacion_proyecto_modificacion_contrato_onfocus(this, iSeqRow) });
  $('#id_sc_field_avance' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_avance_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_prod_programacion_proyecto_avance_onfocus(this, iSeqRow) });
  $('#id_sc_field_facturacion' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_facturacion_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prod_programacion_proyecto_facturacion_onfocus(this, iSeqRow) });
  $('#id_sc_field_costos' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_costos_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_prod_programacion_proyecto_costos_onfocus(this, iSeqRow) });
  $('#id_sc_field_saldo_ur' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_saldo_ur_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_prod_programacion_proyecto_saldo_ur_onfocus(this, iSeqRow) });
  $('#id_sc_field_backlog_p' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_backlog_p_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_prod_programacion_proyecto_backlog_p_onfocus(this, iSeqRow) });
  $('#id_sc_field_backlog_f' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_backlog_f_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_prod_programacion_proyecto_backlog_f_onfocus(this, iSeqRow) });
  $('#id_sc_field_ur_real' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_ur_real_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_prod_programacion_proyecto_ur_real_onfocus(this, iSeqRow) });
  $('#id_sc_field_correlativo_mes' + iSeqRow).bind('blur', function() { sc_form_prod_programacion_proyecto_correlativo_mes_onblur(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_prod_programacion_proyecto_correlativo_mes_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_prod_programacion_proyecto_id_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_id();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_id_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_id_proyecto_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_id_proyecto();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_id_proyecto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_fecha_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_fecha();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_fecha_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_modificacion_contrato_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_modificacion_contrato();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_modificacion_contrato_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_avance_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_avance();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_avance_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_facturacion_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_facturacion();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_facturacion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_costos_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_costos();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_costos_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_saldo_ur_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_saldo_ur();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_saldo_ur_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_backlog_p_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_backlog_p();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_backlog_p_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_backlog_f_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_backlog_f();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_backlog_f_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_ur_real_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_ur_real();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_ur_real_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_programacion_proyecto_correlativo_mes_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_programacion_proyecto_mob_validate_correlativo_mes();
  scCssBlur(oThis);
}

function sc_form_prod_programacion_proyecto_correlativo_mes_onfocus(oThis, iSeqRow) {
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
	displayChange_field("id_proyecto", "", status);
	displayChange_field("fecha", "", status);
	displayChange_field("modificacion_contrato", "", status);
	displayChange_field("avance", "", status);
	displayChange_field("facturacion", "", status);
	displayChange_field("costos", "", status);
	displayChange_field("saldo_ur", "", status);
	displayChange_field("backlog_p", "", status);
	displayChange_field("backlog_f", "", status);
	displayChange_field("ur_real", "", status);
	displayChange_field("correlativo_mes", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_id(row, status);
	displayChange_field_id_proyecto(row, status);
	displayChange_field_fecha(row, status);
	displayChange_field_modificacion_contrato(row, status);
	displayChange_field_avance(row, status);
	displayChange_field_facturacion(row, status);
	displayChange_field_costos(row, status);
	displayChange_field_saldo_ur(row, status);
	displayChange_field_backlog_p(row, status);
	displayChange_field_backlog_f(row, status);
	displayChange_field_ur_real(row, status);
	displayChange_field_correlativo_mes(row, status);
}

function displayChange_field(field, row, status) {
	if ("id" == field) {
		displayChange_field_id(row, status);
	}
	if ("id_proyecto" == field) {
		displayChange_field_id_proyecto(row, status);
	}
	if ("fecha" == field) {
		displayChange_field_fecha(row, status);
	}
	if ("modificacion_contrato" == field) {
		displayChange_field_modificacion_contrato(row, status);
	}
	if ("avance" == field) {
		displayChange_field_avance(row, status);
	}
	if ("facturacion" == field) {
		displayChange_field_facturacion(row, status);
	}
	if ("costos" == field) {
		displayChange_field_costos(row, status);
	}
	if ("saldo_ur" == field) {
		displayChange_field_saldo_ur(row, status);
	}
	if ("backlog_p" == field) {
		displayChange_field_backlog_p(row, status);
	}
	if ("backlog_f" == field) {
		displayChange_field_backlog_f(row, status);
	}
	if ("ur_real" == field) {
		displayChange_field_ur_real(row, status);
	}
	if ("correlativo_mes" == field) {
		displayChange_field_correlativo_mes(row, status);
	}
}

function displayChange_field_id(row, status) {
    var fieldId;
}

function displayChange_field_id_proyecto(row, status) {
    var fieldId;
}

function displayChange_field_fecha(row, status) {
    var fieldId;
}

function displayChange_field_modificacion_contrato(row, status) {
    var fieldId;
}

function displayChange_field_avance(row, status) {
    var fieldId;
}

function displayChange_field_facturacion(row, status) {
    var fieldId;
}

function displayChange_field_costos(row, status) {
    var fieldId;
}

function displayChange_field_saldo_ur(row, status) {
    var fieldId;
}

function displayChange_field_backlog_p(row, status) {
    var fieldId;
}

function displayChange_field_backlog_f(row, status) {
    var fieldId;
}

function displayChange_field_ur_real(row, status) {
    var fieldId;
}

function displayChange_field_correlativo_mes(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_prod_programacion_proyecto_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(43);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_fecha" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_prod_programacion_proyecto_mob_validate_fecha(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_prod_programacion_proyecto_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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

