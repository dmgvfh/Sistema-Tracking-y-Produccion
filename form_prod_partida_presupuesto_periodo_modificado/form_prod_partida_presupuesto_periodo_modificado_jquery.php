
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
  scEventControl_data["id_partida_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_proyecto_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_item_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_moneda_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valor_unitario_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["unidades_periodo_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["avance_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["observaciones_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["facturado_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["monto_utilizado_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["monto_por_facturar_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["monto_presupuesto_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["presupuesto_disponible_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["atencion_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_partida_" + iSeqRow] && scEventControl_data["id_partida_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_partida_" + iSeqRow] && scEventControl_data["id_partida_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_proyecto_" + iSeqRow] && scEventControl_data["id_proyecto_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_proyecto_" + iSeqRow] && scEventControl_data["id_proyecto_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_item_" + iSeqRow] && scEventControl_data["id_item_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_item_" + iSeqRow] && scEventControl_data["id_item_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_moneda_" + iSeqRow] && scEventControl_data["tipo_moneda_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_moneda_" + iSeqRow] && scEventControl_data["tipo_moneda_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["valor_unitario_" + iSeqRow] && scEventControl_data["valor_unitario_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["valor_unitario_" + iSeqRow] && scEventControl_data["valor_unitario_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["unidades_periodo_" + iSeqRow] && scEventControl_data["unidades_periodo_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["unidades_periodo_" + iSeqRow] && scEventControl_data["unidades_periodo_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["avance_" + iSeqRow] && scEventControl_data["avance_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["avance_" + iSeqRow] && scEventControl_data["avance_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["observaciones_" + iSeqRow] && scEventControl_data["observaciones_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["observaciones_" + iSeqRow] && scEventControl_data["observaciones_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["facturado_" + iSeqRow] && scEventControl_data["facturado_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["facturado_" + iSeqRow] && scEventControl_data["facturado_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["monto_utilizado_" + iSeqRow] && scEventControl_data["monto_utilizado_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["monto_utilizado_" + iSeqRow] && scEventControl_data["monto_utilizado_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["monto_por_facturar_" + iSeqRow] && scEventControl_data["monto_por_facturar_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["monto_por_facturar_" + iSeqRow] && scEventControl_data["monto_por_facturar_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["monto_presupuesto_" + iSeqRow] && scEventControl_data["monto_presupuesto_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["monto_presupuesto_" + iSeqRow] && scEventControl_data["monto_presupuesto_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["presupuesto_disponible_" + iSeqRow] && scEventControl_data["presupuesto_disponible_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["presupuesto_disponible_" + iSeqRow] && scEventControl_data["presupuesto_disponible_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["atencion_" + iSeqRow] && scEventControl_data["atencion_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["atencion_" + iSeqRow] && scEventControl_data["atencion_" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_active_all() {
  for (var i = 1; i < iAjaxNewLine; i++) {
    if (scEventControl_active(i)) {
      return true;
    }
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  if ("unidades_periodo_" + iSeq == fieldName) {
    _scCalculatorBlurOk[fieldId] = false;
  }
  scEventControl_data[fieldName]["blur"] = true;
  if ("id_proyecto_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_item_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tipo_moneda_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("facturado_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("agrupador_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_item_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("unidades_periodo_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
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

function scEventControl_onCalculator_unidades_periodo_() {
  if (!_scCalculatorControl["id_sc_field_unidades_periodo_"]) {
    _scCalculatorBlurOk["id_sc_field_unidades_periodo_"] = true;
    do_ajax_form_prod_partida_presupuesto_periodo_modificado_event_unidades_periodo__onblur();
  }
} // scEventControl_onCalculator_unidades_periodo_

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_id_' + iSeqRow).bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id__onchange(this, iSeqRow) });
  $('#id_sc_field_id_presupuesto_periodo_' + iSeqRow).bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_presupuesto_periodo__onchange(this, iSeqRow) });
  $('#id_sc_field_id_proyecto_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_proyecto__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_proyecto__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_proyecto__onfocus(this, iSeqRow) });
  $('#id_sc_field_id_item_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_item__onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_item__onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_item__onfocus(this, iSeqRow) });
  $('#id_sc_field_monto_uf_' + iSeqRow).bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_uf__onchange(this, iSeqRow) });
  $('#id_sc_field_avance_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_avance__onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_avance__onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_avance__onfocus(this, iSeqRow) });
  $('#id_sc_field_unidades_periodo_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_unidades_periodo__onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_unidades_periodo__onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_unidades_periodo__onfocus(this, iSeqRow) });
  $('#id_sc_field_facturado_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_facturado__onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_facturado__onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_facturado__onfocus(this, iSeqRow) });
  $('#id_sc_field_observaciones_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_observaciones__onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_observaciones__onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_observaciones__onfocus(this, iSeqRow) });
  $('#id_sc_field_agrupador_' + iSeqRow).bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_agrupador__onchange(this, iSeqRow) });
  $('#id_sc_field_id_partida_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_partida__onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_partida__onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_id_partida__onfocus(this, iSeqRow) });
  $('#id_sc_field_monto_por_facturar_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_por_facturar__onblur(this, iSeqRow) })
                                                 .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_por_facturar__onchange(this, iSeqRow) })
                                                 .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_por_facturar__onfocus(this, iSeqRow) });
  $('#id_sc_field_monto_presupuesto_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_presupuesto__onblur(this, iSeqRow) })
                                                .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_presupuesto__onchange(this, iSeqRow) })
                                                .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_presupuesto__onfocus(this, iSeqRow) });
  $('#id_sc_field_monto_utilizado_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_utilizado__onblur(this, iSeqRow) })
                                              .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_utilizado__onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_monto_utilizado__onfocus(this, iSeqRow) });
  $('#id_sc_field_nombre_item_' + iSeqRow).bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_nombre_item__onchange(this, iSeqRow) });
  $('#id_sc_field_presupuesto_disponible_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_presupuesto_disponible__onblur(this, iSeqRow) })
                                                     .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_presupuesto_disponible__onchange(this, iSeqRow) })
                                                     .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_presupuesto_disponible__onfocus(this, iSeqRow) });
  $('#id_sc_field_tipo_moneda_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_tipo_moneda__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_tipo_moneda__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_tipo_moneda__onfocus(this, iSeqRow) });
  $('#id_sc_field_valor_unitario_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_valor_unitario__onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_valor_unitario__onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_valor_unitario__onfocus(this, iSeqRow) });
  $('#id_sc_field_atencion_' + iSeqRow).bind('blur', function() { sc_form_prod_partida_presupuesto_periodo_modificado_atencion__onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_prod_partida_presupuesto_periodo_modificado_atencion__onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_prod_partida_presupuesto_periodo_modificado_atencion__onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_prod_partida_presupuesto_periodo_modificado_id__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_presupuesto_periodo__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_proyecto__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_id_proyecto_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_proyecto__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_refresh_id_proyecto_(iSeqRow);
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_proyecto__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_item__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_id_item_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_item__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_event_id_item__onchange(iSeqRow);
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_item__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_uf__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_partida_presupuesto_periodo_modificado_avance__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_avance_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_avance__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_avance__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_unidades_periodo__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_unidades_periodo_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_unidades_periodo__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_event_unidades_periodo__onchange(iSeqRow);
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_unidades_periodo__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_facturado__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_facturado_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_facturado__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_facturado__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_observaciones__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_observaciones_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_observaciones__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_observaciones__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_agrupador__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_partida__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_id_partida_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_partida__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_id_partida__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_por_facturar__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_monto_por_facturar_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_por_facturar__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_por_facturar__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_presupuesto__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_monto_presupuesto_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_presupuesto__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_presupuesto__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_utilizado__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_monto_utilizado_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_utilizado__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_monto_utilizado__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_nombre_item__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_partida_presupuesto_periodo_modificado_presupuesto_disponible__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_presupuesto_disponible_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_presupuesto_disponible__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_presupuesto_disponible__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_tipo_moneda__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_tipo_moneda_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_tipo_moneda__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_tipo_moneda__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_valor_unitario__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_valor_unitario_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_valor_unitario__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_valor_unitario__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_atencion__onblur(oThis, iSeqRow) {
  do_ajax_form_prod_partida_presupuesto_periodo_modificado_validate_atencion_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_atencion__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_prod_partida_presupuesto_periodo_modificado_atencion__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
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
}

function displayChange_block_0(status) {
	displayChange_field("id_partida_", "", status);
	displayChange_field("id_proyecto_", "", status);
	displayChange_field("id_item_", "", status);
	displayChange_field("tipo_moneda_", "", status);
	displayChange_field("valor_unitario_", "", status);
	displayChange_field("unidades_periodo_", "", status);
	displayChange_field("avance_", "", status);
	displayChange_field("observaciones_", "", status);
	displayChange_field("facturado_", "", status);
}

function displayChange_block_1(status) {
	displayChange_field("monto_utilizado_", "", status);
}

function displayChange_block_2(status) {
	displayChange_field("monto_por_facturar_", "", status);
	displayChange_field("monto_presupuesto_", "", status);
}

function displayChange_block_3(status) {
	displayChange_field("presupuesto_disponible_", "", status);
}

function displayChange_block_4(status) {
	displayChange_field("atencion_", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_id_partida_(row, status);
	displayChange_field_id_proyecto_(row, status);
	displayChange_field_id_item_(row, status);
	displayChange_field_tipo_moneda_(row, status);
	displayChange_field_valor_unitario_(row, status);
	displayChange_field_unidades_periodo_(row, status);
	displayChange_field_avance_(row, status);
	displayChange_field_observaciones_(row, status);
	displayChange_field_facturado_(row, status);
	displayChange_field_monto_utilizado_(row, status);
	displayChange_field_monto_por_facturar_(row, status);
	displayChange_field_monto_presupuesto_(row, status);
	displayChange_field_presupuesto_disponible_(row, status);
	displayChange_field_atencion_(row, status);
}

function displayChange_field(field, row, status) {
	if ("id_partida_" == field) {
		displayChange_field_id_partida_(row, status);
	}
	if ("id_proyecto_" == field) {
		displayChange_field_id_proyecto_(row, status);
	}
	if ("id_item_" == field) {
		displayChange_field_id_item_(row, status);
	}
	if ("tipo_moneda_" == field) {
		displayChange_field_tipo_moneda_(row, status);
	}
	if ("valor_unitario_" == field) {
		displayChange_field_valor_unitario_(row, status);
	}
	if ("unidades_periodo_" == field) {
		displayChange_field_unidades_periodo_(row, status);
	}
	if ("avance_" == field) {
		displayChange_field_avance_(row, status);
	}
	if ("observaciones_" == field) {
		displayChange_field_observaciones_(row, status);
	}
	if ("facturado_" == field) {
		displayChange_field_facturado_(row, status);
	}
	if ("monto_utilizado_" == field) {
		displayChange_field_monto_utilizado_(row, status);
	}
	if ("monto_por_facturar_" == field) {
		displayChange_field_monto_por_facturar_(row, status);
	}
	if ("monto_presupuesto_" == field) {
		displayChange_field_monto_presupuesto_(row, status);
	}
	if ("presupuesto_disponible_" == field) {
		displayChange_field_presupuesto_disponible_(row, status);
	}
	if ("atencion_" == field) {
		displayChange_field_atencion_(row, status);
	}
}

function displayChange_field_id_partida_(row, status) {
    var fieldId;
}

function displayChange_field_id_proyecto_(row, status) {
    var fieldId;
}

function displayChange_field_id_item_(row, status) {
    var fieldId;
}

function displayChange_field_tipo_moneda_(row, status) {
    var fieldId;
}

function displayChange_field_valor_unitario_(row, status) {
    var fieldId;
}

function displayChange_field_unidades_periodo_(row, status) {
    var fieldId;
}

function displayChange_field_avance_(row, status) {
    var fieldId;
}

function displayChange_field_observaciones_(row, status) {
    var fieldId;
}

function displayChange_field_facturado_(row, status) {
    var fieldId;
}

function displayChange_field_monto_utilizado_(row, status) {
    var fieldId;
}

function displayChange_field_monto_por_facturar_(row, status) {
    var fieldId;
}

function displayChange_field_monto_presupuesto_(row, status) {
    var fieldId;
}

function displayChange_field_presupuesto_disponible_(row, status) {
    var fieldId;
}

function displayChange_field_atencion_(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_prod_partida_presupuesto_periodo_modificado_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(56);
		}
	}
}
var jqCalcMonetPos = {};
var _scCalculatorBlurOk = {};

function scJQCalculatorAdd(iSeqRow) {
  _scCalculatorBlurOk["id_sc_field_atencion_" + iSeqRow] = true;
  $("#id_sc_field_unidades_periodo_" + iSeqRow).calculator({
    onOpen: function(value, inst) {
      if (typeof _scCalculatorControl !== "undefined") {
        if (!_scCalculatorControl["id_sc_field_unidades_periodo_" + iSeqRow]) {
          _scCalculatorControl["id_sc_field_unidades_periodo_" + iSeqRow] = true;
        }
      }
      value = scJQCalculatorUnformat(value, "#id_sc_field_unidades_periodo_" + iSeqRow, '<?php echo str_replace("'", "\'", $this->field_config['unidades_periodo_']['symbol_grp']); ?>', <?php echo $this->field_config['unidades_periodo_']['symbol_fmt']; ?>, '<?php echo str_replace("'", "\'", $this->field_config['unidades_periodo_']['symbol_dec']); ?>', '<?php echo str_replace("'", "\'", $this->field_config['unidades_periodo_']['symbol_mon']); ?>');
      $(this).val(value);
    },
    onClose: function(value, inst) {
      var oldValue = $(this.val);
      if (typeof _scCalculatorControl !== "undefined") {
        if (_scCalculatorControl["id_sc_field_unidades_periodo_" + iSeqRow]) {
          _scCalculatorControl["id_sc_field_unidades_periodo_" + iSeqRow] = null;
        }
      }
      value = scJQCalculatorFormat(value, "#id_sc_field_unidades_periodo_" + iSeqRow, '<?php echo str_replace("'", "\'", $this->field_config['unidades_periodo_']['symbol_grp']); ?>', <?php echo $this->field_config['unidades_periodo_']['symbol_fmt']; ?>, '<?php echo str_replace("'", "\'", $this->field_config['unidades_periodo_']['symbol_dec']); ?>', 2, '<?php echo str_replace("'", "\'", $this->field_config['unidades_periodo_']['symbol_mon']); ?>');
      $(this).val(value);
      if (oldValue != value) {
        $(this).trigger('change');
      }
    },
    precision: 2,
    showOn: "button",
<?php
$miniCalculatorIcon = $this->jqueryIconFile('calculator');
$miniCalculatorFA   = $this->jqueryFAFile('calculator');
if ('' != $miniCalculatorIcon) {
?>
    buttonImage: "<?php echo $miniCalculatorIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalculatorFA) {
?>
    buttonText: "",
<?php
}
?>
  })
<?php
if ('' != $miniCalculatorFA) {
?>
    .next('button').append("<?php echo $miniCalculatorFA; ?>")
<?php
}
?>
;

} // scJQCalculatorAdd

function scJQCalculatorUnformat(fValue, sField, sThousands, sFormat, sDecimals, sMonetary) {
  fValue = scJQCalculatorCurrency(fValue, sField, sMonetary);
  if ("" != sThousands) {
    if ("." == sThousands) {
      sThousands = "\\.";
    }
    sRegEx = eval("/" + sThousands + "/g");
    fValue = fValue.replace(sRegEx, "");
  }
  if ("." != sDecimals) {
    sRegEx = eval("/" + sDecimals + "/g");
    fValue = fValue.replace(sRegEx, ".");
  }
  if ("." == fValue.substr(0, 1) || "," == fValue.substr(0, 1)) {
    fValue = "0" + fValue;
  }
  return fValue;
} // scJQCalculatorUnformat

function scJQCalculatorFormat(fValue, sField, sThousands, sFormat, sDecimals, iPrecision, sMonetary) {
  fValue = scJQCalculatorCurrency(fValue.toString(), sField, sMonetary);
  if (-1 < fValue.indexOf('.')) {
    var parts = fValue.split('.'),
        pref = parts[0],
        suf = parts[1];
  }
  else {
    var pref = fValue,
        suf = '';
  }
  if ('' != sThousands) {
    if (3 == sFormat) {
      if (4 <= pref.length) {
        pref_rest = pref.substr(0, pref.length - 3);
        pref = sThousands + pref.substr(pref.length - 3);
        while (2 < pref_rest.length) {
          pref = sThousands + pref_rest.substr(pref_rest.length - 2) + pref;
          pref_rest = pref_rest.substr(0, pref_rest.length - 2);
        }
        if ('' != pref_rest) {
          pref = pref_rest + pref;
        }
      }
    }
    else if (2 == sFormat) {
      if (4 <= pref.length) {
        pref = pref.substr(0, pref.length - 3) + sThousands + pref.substr(pref.length - 3);
      }
    }
    else {
      pref_rest = pref;
      pref = '';
      while (3 < pref_rest.length) {
        pref = sThousands + pref_rest.substr(pref_rest.length - 3) + pref;
        pref_rest = pref_rest.substr(0, pref_rest.length - 3);
      }
      if ('' != pref_rest) {
        pref = pref_rest + pref;
      }
    }
  }
  if ('' != iPrecision) {
    if (suf.length > iPrecision) {
      suf = '1' + suf.substr(0, iPrecision) + '.' + suf.substr(iPrecision);
      suf = Math.round(parseFloat(suf)).toString().substr(1);
    }
    else {
      while (suf.length < iPrecision) {
        suf += '0';
      }
    }
  }
  if ('' != sDecimals && '' != suf) {
    fValue = pref + sDecimals + suf;
  }
  else {
    fValue = pref;
  }
  if ('' != sMonetary) {
    fValue = 'left' == jqCalcMonetPos[sField] ? sMonetary + ' ' + fValue : fValue + ' ' + sMonetary;
  }
  return fValue;
} // scJQCalculatorFormat

function scJQCalculatorCurrency(fValue, sField, sMonetary) {
  if ("" != sMonetary) {
    if (sMonetary + ' ' == fValue.substr(0, sMonetary.length + 1)) {
        fValue = fValue.substr(sMonetary.length + 1);
        jqCalcMonetPos[sField] = 'left';
    }
    else if (sMonetary == fValue.substr(0, sMonetary.length)) {
        fValue = fValue.substr(sMonetary.length + 1);
        jqCalcMonetPos[sField] = 'left';
    }
    else if (' ' + sMonetary == fValue.substr(fValue.length - sMonetary.length - 1)) {
        fValue = fValue.substr(0, fValue.length - sMonetary.length - 1);
        jqCalcMonetPos[sField] = 'right';
    }
    else if (sMonetary == fValue.substr(fValue.length - sMonetary.length)) {
        fValue = fValue.substr(0, fValue.length - sMonetary.length);
        jqCalcMonetPos[sField] = 'right';
    }
  }
  if ("" == fValue) {
    fValue = "0";
  }
  return fValue;
} // scJQCalculatorCurrency

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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_prod_partida_presupuesto_periodo_modificado')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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
  scJQCalculatorAdd(iLine);
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

