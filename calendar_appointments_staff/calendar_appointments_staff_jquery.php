
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
  scEventControl_data["current_status_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nombre" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_actividad" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["busca_proyecto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_proyecto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["appointment_start_date" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["appointment_start_time" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["appointment_end_time" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["intervalo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["estado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["observaciones" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["current_status_id" + iSeqRow] && scEventControl_data["current_status_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["current_status_id" + iSeqRow] && scEventControl_data["current_status_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nombre" + iSeqRow] && scEventControl_data["nombre" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nombre" + iSeqRow] && scEventControl_data["nombre" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_actividad" + iSeqRow] && scEventControl_data["id_actividad" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_actividad" + iSeqRow] && scEventControl_data["id_actividad" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["busca_proyecto" + iSeqRow] && scEventControl_data["busca_proyecto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["busca_proyecto" + iSeqRow] && scEventControl_data["busca_proyecto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_proyecto" + iSeqRow] && scEventControl_data["id_proyecto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_proyecto" + iSeqRow] && scEventControl_data["id_proyecto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["appointment_start_date" + iSeqRow] && scEventControl_data["appointment_start_date" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["appointment_start_date" + iSeqRow] && scEventControl_data["appointment_start_date" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["appointment_start_time" + iSeqRow] && scEventControl_data["appointment_start_time" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["appointment_start_time" + iSeqRow] && scEventControl_data["appointment_start_time" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["appointment_end_time" + iSeqRow] && scEventControl_data["appointment_end_time" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["appointment_end_time" + iSeqRow] && scEventControl_data["appointment_end_time" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["intervalo" + iSeqRow] && scEventControl_data["intervalo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["intervalo" + iSeqRow] && scEventControl_data["intervalo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["estado" + iSeqRow] && scEventControl_data["estado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["estado" + iSeqRow] && scEventControl_data["estado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["observaciones" + iSeqRow] && scEventControl_data["observaciones" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["observaciones" + iSeqRow] && scEventControl_data["observaciones" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("current_status_id" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_actividad" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_proyecto" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("appointment_start_time" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("appointment_end_time" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("estado" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_usuario" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("appointment_recurrent" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("appointment_period" + iSeq == fieldName) {
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
  $('#id_sc_field_appointments_id' + iSeqRow).bind('change', function() { sc_calendar_appointments_staff_appointments_id_onchange(this, iSeqRow) });
  $('#id_sc_field_id_proyecto' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_id_proyecto_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_calendar_appointments_staff_id_proyecto_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_calendar_appointments_staff_id_proyecto_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_usuario' + iSeqRow).bind('change', function() { sc_calendar_appointments_staff_id_usuario_onchange(this, iSeqRow) });
  $('#id_sc_field_id_actividad' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_id_actividad_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_calendar_appointments_staff_id_actividad_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_calendar_appointments_staff_id_actividad_onfocus(this, iSeqRow) });
  $('#id_sc_field_appointment_start_date' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_appointment_start_date_onblur(this, iSeqRow) })
                                                    .bind('change', function() { sc_calendar_appointments_staff_appointment_start_date_onchange(this, iSeqRow) })
                                                    .bind('focus', function() { sc_calendar_appointments_staff_appointment_start_date_onfocus(this, iSeqRow) });
  $('#id_sc_field_appointment_start_time' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_appointment_start_time_onblur(this, iSeqRow) })
                                                    .bind('change', function() { sc_calendar_appointments_staff_appointment_start_time_onchange(this, iSeqRow) })
                                                    .bind('focus', function() { sc_calendar_appointments_staff_appointment_start_time_onfocus(this, iSeqRow) });
  $('#id_sc_field_appointment_end_date' + iSeqRow).bind('change', function() { sc_calendar_appointments_staff_appointment_end_date_onchange(this, iSeqRow) });
  $('#id_sc_field_appointment_end_time' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_appointment_end_time_onblur(this, iSeqRow) })
                                                  .bind('change', function() { sc_calendar_appointments_staff_appointment_end_time_onchange(this, iSeqRow) })
                                                  .bind('focus', function() { sc_calendar_appointments_staff_appointment_end_time_onfocus(this, iSeqRow) });
  $('#id_sc_field_current_status_id' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_current_status_id_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_calendar_appointments_staff_current_status_id_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_calendar_appointments_staff_current_status_id_onfocus(this, iSeqRow) });
  $('#id_sc_field_appointment_recurrent' + iSeqRow).bind('change', function() { sc_calendar_appointments_staff_appointment_recurrent_onchange(this, iSeqRow) });
  $('#id_sc_field_appointment_period' + iSeqRow).bind('change', function() { sc_calendar_appointments_staff_appointment_period_onchange(this, iSeqRow) });
  $('#id_sc_field_intervalo' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_intervalo_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_calendar_appointments_staff_intervalo_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_calendar_appointments_staff_intervalo_onfocus(this, iSeqRow) });
  $('#id_sc_field_observaciones' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_observaciones_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_calendar_appointments_staff_observaciones_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_calendar_appointments_staff_observaciones_onfocus(this, iSeqRow) });
  $('#id_sc_field_nombre' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_nombre_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_calendar_appointments_staff_nombre_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_calendar_appointments_staff_nombre_onfocus(this, iSeqRow) });
  $('#id_sc_field___calend_all_day__' + iSeqRow).bind('change', function() { sc_calendar_appointments_staff___calend_all_day___onchange(this, iSeqRow) });
  $('#id_sc_field_estado' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_estado_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_calendar_appointments_staff_estado_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_calendar_appointments_staff_estado_onfocus(this, iSeqRow) });
  $('#id_sc_field_busca_proyecto' + iSeqRow).bind('blur', function() { sc_calendar_appointments_staff_busca_proyecto_onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_calendar_appointments_staff_busca_proyecto_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_calendar_appointments_staff_busca_proyecto_onfocus(this, iSeqRow) });
  $('.sc-ui-checkbox-__calend_all_day__' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

function sc_calendar_appointments_staff_appointments_id_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_id_proyecto_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_id_proyecto();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_id_proyecto_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_id_proyecto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff_id_usuario_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_id_actividad_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_id_actividad();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_id_actividad_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_id_actividad_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff_appointment_start_date_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_appointment_start_date();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_appointment_start_date_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_appointment_start_date_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff_appointment_start_time_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_appointment_start_time();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_appointment_start_time_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_appointment_start_time_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff_appointment_end_date_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_appointment_end_time_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_appointment_end_time();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_appointment_end_time_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_appointment_end_time_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff_current_status_id_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_current_status_id();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_current_status_id_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_current_status_id_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff_appointment_recurrent_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_appointment_period_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_intervalo_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_intervalo();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_intervalo_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_intervalo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff_observaciones_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_observaciones();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_observaciones_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_observaciones_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff_nombre_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_nombre();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_nombre_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_nombre_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff___calend_all_day___onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_estado_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_estado();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_estado_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_calendar_appointments_staff_estado_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_calendar_appointments_staff_busca_proyecto_onblur(oThis, iSeqRow) {
  do_ajax_calendar_appointments_staff_validate_busca_proyecto();
  scCssBlur(oThis);
}

function sc_calendar_appointments_staff_busca_proyecto_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  do_ajax_calendar_appointments_staff_refresh_busca_proyecto();
}

function sc_calendar_appointments_staff_busca_proyecto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
	if ("1" == block) {
		displayChange_block_1(status);
	}
	if ("2" == block) {
		displayChange_block_2(status);
	}
	if ("3" == block) {
		displayChange_block_3(status);
	}
	if ("4" == block) {
		displayChange_block_4(status);
	}
	if ("5" == block) {
		displayChange_block_5(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("current_status_id", "", status);
	displayChange_field("nombre", "", status);
}

function displayChange_block_1(status) {
	displayChange_field("id_actividad", "", status);
}

function displayChange_block_2(status) {
	displayChange_field("busca_proyecto", "", status);
	displayChange_field("id_proyecto", "", status);
}

function displayChange_block_3(status) {
	displayChange_field("appointment_start_date", "", status);
}

function displayChange_block_4(status) {
	displayChange_field("appointment_start_time", "", status);
	displayChange_field("appointment_end_time", "", status);
	displayChange_field("intervalo", "", status);
	displayChange_field("estado", "", status);
}

function displayChange_block_5(status) {
	displayChange_field("observaciones", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_current_status_id(row, status);
	displayChange_field_nombre(row, status);
	displayChange_field_id_actividad(row, status);
	displayChange_field_busca_proyecto(row, status);
	displayChange_field_id_proyecto(row, status);
	displayChange_field_appointment_start_date(row, status);
	displayChange_field_appointment_start_time(row, status);
	displayChange_field_appointment_end_time(row, status);
	displayChange_field_intervalo(row, status);
	displayChange_field_estado(row, status);
	displayChange_field_observaciones(row, status);
}

function displayChange_field(field, row, status) {
	if ("current_status_id" == field) {
		displayChange_field_current_status_id(row, status);
	}
	if ("nombre" == field) {
		displayChange_field_nombre(row, status);
	}
	if ("id_actividad" == field) {
		displayChange_field_id_actividad(row, status);
	}
	if ("busca_proyecto" == field) {
		displayChange_field_busca_proyecto(row, status);
	}
	if ("id_proyecto" == field) {
		displayChange_field_id_proyecto(row, status);
	}
	if ("appointment_start_date" == field) {
		displayChange_field_appointment_start_date(row, status);
	}
	if ("appointment_start_time" == field) {
		displayChange_field_appointment_start_time(row, status);
	}
	if ("appointment_end_time" == field) {
		displayChange_field_appointment_end_time(row, status);
	}
	if ("intervalo" == field) {
		displayChange_field_intervalo(row, status);
	}
	if ("estado" == field) {
		displayChange_field_estado(row, status);
	}
	if ("observaciones" == field) {
		displayChange_field_observaciones(row, status);
	}
}

function displayChange_field_current_status_id(row, status) {
    var fieldId;
}

function displayChange_field_nombre(row, status) {
    var fieldId;
}

function displayChange_field_id_actividad(row, status) {
    var fieldId;
}

function displayChange_field_busca_proyecto(row, status) {
    var fieldId;
}

function displayChange_field_id_proyecto(row, status) {
    var fieldId;
}

function displayChange_field_appointment_start_date(row, status) {
    var fieldId;
}

function displayChange_field_appointment_start_time(row, status) {
    var fieldId;
}

function displayChange_field_appointment_end_time(row, status) {
    var fieldId;
}

function displayChange_field_intervalo(row, status) {
    var fieldId;
}

function displayChange_field_estado(row, status) {
    var fieldId;
}

function displayChange_field_observaciones(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_calendar_appointments_staff_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(35);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_appointment_start_date" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_appointment_start_date" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_calendar_appointments_staff_validate_appointment_start_date(iSeqRow); }, 200);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['appointment_start_date']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_appointment_end_date" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_appointment_end_date" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_calendar_appointments_staff_validate_appointment_end_date(iSeqRow); }, 200);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['appointment_end_date']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'calendar_appointments_staff')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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

