
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
  scEventControl_data["monto_contrato" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_moneda" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_partida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha_desde" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha_hasta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dias_desde" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dias_hasta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dias_periodo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha_desde_factura" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha_hasta_factura" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["avance_informado_con_iva" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["produccion_neto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["retencion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["retencion_con_iva" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["retencion_acumulada" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["reajuste_acumulado_con_iva" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["reajuste_acumulado_neto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["multa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["total_facturado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["afecta_iva" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["existe_retencion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["incluye_retencion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["considera_retencion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["facturado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["observaciones_solicitud" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["iva" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["monto_uf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valor_uf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["observaciones" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["factura" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hitos_facturacion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
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
  if (scEventControl_data["monto_contrato" + iSeqRow] && scEventControl_data["monto_contrato" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["monto_contrato" + iSeqRow] && scEventControl_data["monto_contrato" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_moneda" + iSeqRow] && scEventControl_data["tipo_moneda" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_moneda" + iSeqRow] && scEventControl_data["tipo_moneda" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa" + iSeqRow] && scEventControl_data["empresa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa" + iSeqRow] && scEventControl_data["empresa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliente" + iSeqRow] && scEventControl_data["cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliente" + iSeqRow] && scEventControl_data["cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_partida" + iSeqRow] && scEventControl_data["id_partida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_partida" + iSeqRow] && scEventControl_data["id_partida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha_desde" + iSeqRow] && scEventControl_data["fecha_desde" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha_desde" + iSeqRow] && scEventControl_data["fecha_desde" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha_hasta" + iSeqRow] && scEventControl_data["fecha_hasta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha_hasta" + iSeqRow] && scEventControl_data["fecha_hasta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dias_desde" + iSeqRow] && scEventControl_data["dias_desde" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dias_desde" + iSeqRow] && scEventControl_data["dias_desde" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dias_hasta" + iSeqRow] && scEventControl_data["dias_hasta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dias_hasta" + iSeqRow] && scEventControl_data["dias_hasta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dias_periodo" + iSeqRow] && scEventControl_data["dias_periodo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dias_periodo" + iSeqRow] && scEventControl_data["dias_periodo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha_desde_factura" + iSeqRow] && scEventControl_data["fecha_desde_factura" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha_desde_factura" + iSeqRow] && scEventControl_data["fecha_desde_factura" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha_hasta_factura" + iSeqRow] && scEventControl_data["fecha_hasta_factura" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha_hasta_factura" + iSeqRow] && scEventControl_data["fecha_hasta_factura" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["avance_informado_con_iva" + iSeqRow] && scEventControl_data["avance_informado_con_iva" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["avance_informado_con_iva" + iSeqRow] && scEventControl_data["avance_informado_con_iva" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["produccion_neto" + iSeqRow] && scEventControl_data["produccion_neto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["produccion_neto" + iSeqRow] && scEventControl_data["produccion_neto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["retencion" + iSeqRow] && scEventControl_data["retencion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["retencion" + iSeqRow] && scEventControl_data["retencion" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["retencion_con_iva" + iSeqRow] && scEventControl_data["retencion_con_iva" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["retencion_con_iva" + iSeqRow] && scEventControl_data["retencion_con_iva" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["retencion_acumulada" + iSeqRow] && scEventControl_data["retencion_acumulada" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["retencion_acumulada" + iSeqRow] && scEventControl_data["retencion_acumulada" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["reajuste_acumulado_con_iva" + iSeqRow] && scEventControl_data["reajuste_acumulado_con_iva" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["reajuste_acumulado_con_iva" + iSeqRow] && scEventControl_data["reajuste_acumulado_con_iva" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["reajuste_acumulado_neto" + iSeqRow] && scEventControl_data["reajuste_acumulado_neto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["reajuste_acumulado_neto" + iSeqRow] && scEventControl_data["reajuste_acumulado_neto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["multa" + iSeqRow] && scEventControl_data["multa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["multa" + iSeqRow] && scEventControl_data["multa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["total_facturado" + iSeqRow] && scEventControl_data["total_facturado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["total_facturado" + iSeqRow] && scEventControl_data["total_facturado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["afecta_iva" + iSeqRow] && scEventControl_data["afecta_iva" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["afecta_iva" + iSeqRow] && scEventControl_data["afecta_iva" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["existe_retencion" + iSeqRow] && scEventControl_data["existe_retencion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["existe_retencion" + iSeqRow] && scEventControl_data["existe_retencion" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["incluye_retencion" + iSeqRow] && scEventControl_data["incluye_retencion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["incluye_retencion" + iSeqRow] && scEventControl_data["incluye_retencion" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["considera_retencion" + iSeqRow] && scEventControl_data["considera_retencion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["considera_retencion" + iSeqRow] && scEventControl_data["considera_retencion" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["facturado" + iSeqRow] && scEventControl_data["facturado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["facturado" + iSeqRow] && scEventControl_data["facturado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["observaciones_solicitud" + iSeqRow] && scEventControl_data["observaciones_solicitud" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["observaciones_solicitud" + iSeqRow] && scEventControl_data["observaciones_solicitud" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["iva" + iSeqRow] && scEventControl_data["iva" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["iva" + iSeqRow] && scEventControl_data["iva" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["monto_uf" + iSeqRow] && scEventControl_data["monto_uf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["monto_uf" + iSeqRow] && scEventControl_data["monto_uf" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha" + iSeqRow] && scEventControl_data["fecha" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha" + iSeqRow] && scEventControl_data["fecha" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["valor_uf" + iSeqRow] && scEventControl_data["valor_uf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["valor_uf" + iSeqRow] && scEventControl_data["valor_uf" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["observaciones" + iSeqRow] && scEventControl_data["observaciones" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["observaciones" + iSeqRow] && scEventControl_data["observaciones" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hitos_facturacion" + iSeqRow] && scEventControl_data["hitos_facturacion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hitos_facturacion" + iSeqRow] && scEventControl_data["hitos_facturacion" + iSeqRow]["change"]) {
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
  if ("tipo_moneda" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("empresa" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("cliente" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_partida" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("considera_retencion" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("facturado" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_item" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("considera_retencion" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("fecha_desde_factura" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("fecha_desde" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("fecha_hasta_factura" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("fecha_hasta" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("id_partida" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("multa" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("retencion" + iSeq == fieldName) {
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

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_id' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_id_onblur(this, iSeqRow) })
                                .bind('focus', function() { sc_form_prod_presupuesto_periodo_id_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_proyecto' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_id_proyecto_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prod_presupuesto_periodo_id_proyecto_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_fecha_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_prod_presupuesto_periodo_fecha_onfocus(this, iSeqRow) });
  $('#id_sc_field_monto_uf' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_monto_uf_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_prod_presupuesto_periodo_monto_uf_onfocus(this, iSeqRow) });
  $('#id_sc_field_observaciones' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_observaciones_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_prod_presupuesto_periodo_observaciones_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_partida' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_id_partida_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_prod_presupuesto_periodo_id_partida_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_prod_presupuesto_periodo_id_partida_onfocus(this, iSeqRow) });
  $('#id_sc_field_facturado' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_facturado_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_prod_presupuesto_periodo_facturado_onfocus(this, iSeqRow) });
  $('#id_sc_field_valor_uf' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_valor_uf_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_prod_presupuesto_periodo_valor_uf_onfocus(this, iSeqRow) });
  $('#id_sc_field_factura' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_factura_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_prod_presupuesto_periodo_factura_onfocus(this, iSeqRow) });
  $('#id_sc_field_tipo_moneda' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_tipo_moneda_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prod_presupuesto_periodo_tipo_moneda_onfocus(this, iSeqRow) });
  $('#id_sc_field_retencion' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_retencion_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_prod_presupuesto_periodo_retencion_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_prod_presupuesto_periodo_retencion_onfocus(this, iSeqRow) });
  $('#id_sc_field_multa' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_multa_onblur(this, iSeqRow) })
                                   .bind('change', function() { sc_form_prod_presupuesto_periodo_multa_onchange(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_prod_presupuesto_periodo_multa_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha_desde' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_fecha_desde_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_prod_presupuesto_periodo_fecha_desde_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prod_presupuesto_periodo_fecha_desde_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha_hasta' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_fecha_hasta_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_prod_presupuesto_periodo_fecha_hasta_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prod_presupuesto_periodo_fecha_hasta_onfocus(this, iSeqRow) });
  $('#id_sc_field_dias_desde' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_dias_desde_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_prod_presupuesto_periodo_dias_desde_onfocus(this, iSeqRow) });
  $('#id_sc_field_dias_hasta' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_dias_hasta_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_prod_presupuesto_periodo_dias_hasta_onfocus(this, iSeqRow) });
  $('#id_sc_field_dias_periodo' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_dias_periodo_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_prod_presupuesto_periodo_dias_periodo_onfocus(this, iSeqRow) });
  $('#id_sc_field_total_facturado' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_total_facturado_onblur(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_prod_presupuesto_periodo_total_facturado_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha_desde_factura' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_fecha_desde_factura_onblur(this, iSeqRow) })
                                                 .bind('change', function() { sc_form_prod_presupuesto_periodo_fecha_desde_factura_onchange(this, iSeqRow) })
                                                 .bind('focus', function() { sc_form_prod_presupuesto_periodo_fecha_desde_factura_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha_hasta_factura' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_fecha_hasta_factura_onblur(this, iSeqRow) })
                                                 .bind('change', function() { sc_form_prod_presupuesto_periodo_fecha_hasta_factura_onchange(this, iSeqRow) })
                                                 .bind('focus', function() { sc_form_prod_presupuesto_periodo_fecha_hasta_factura_onfocus(this, iSeqRow) });
  $('#id_sc_field_avance_informado_con_iva' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_avance_informado_con_iva_onblur(this, iSeqRow) })
                                                      .bind('focus', function() { sc_form_prod_presupuesto_periodo_avance_informado_con_iva_onfocus(this, iSeqRow) });
  $('#id_sc_field_retencion_con_iva' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_retencion_con_iva_onblur(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_prod_presupuesto_periodo_retencion_con_iva_onfocus(this, iSeqRow) });
  $('#id_sc_field_produccion_neto' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_produccion_neto_onblur(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_prod_presupuesto_periodo_produccion_neto_onfocus(this, iSeqRow) });
  $('#id_sc_field_reajuste_acumulado_neto' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_reajuste_acumulado_neto_onblur(this, iSeqRow) })
                                                     .bind('focus', function() { sc_form_prod_presupuesto_periodo_reajuste_acumulado_neto_onfocus(this, iSeqRow) });
  $('#id_sc_field_reajuste_acumulado_con_iva' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_reajuste_acumulado_con_iva_onblur(this, iSeqRow) })
                                                        .bind('focus', function() { sc_form_prod_presupuesto_periodo_reajuste_acumulado_con_iva_onfocus(this, iSeqRow) });
  $('#id_sc_field_considera_retencion' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_considera_retencion_onblur(this, iSeqRow) })
                                                 .bind('change', function() { sc_form_prod_presupuesto_periodo_considera_retencion_onchange(this, iSeqRow) })
                                                 .bind('focus', function() { sc_form_prod_presupuesto_periodo_considera_retencion_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliente' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_cliente_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_prod_presupuesto_periodo_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_empresa' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_empresa_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_prod_presupuesto_periodo_empresa_onfocus(this, iSeqRow) });
  $('#id_sc_field_hitos_facturacion' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_hitos_facturacion_onblur(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_prod_presupuesto_periodo_hitos_facturacion_onfocus(this, iSeqRow) });
  $('#id_sc_field_iva' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_iva_onblur(this, iSeqRow) })
                                 .bind('focus', function() { sc_form_prod_presupuesto_periodo_iva_onfocus(this, iSeqRow) });
  $('#id_sc_field_monto_contrato' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_monto_contrato_onblur(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_prod_presupuesto_periodo_monto_contrato_onfocus(this, iSeqRow) });
  $('#id_sc_field_retencion_acumulada' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_retencion_acumulada_onblur(this, iSeqRow) })
                                                 .bind('focus', function() { sc_form_prod_presupuesto_periodo_retencion_acumulada_onfocus(this, iSeqRow) });
  $('#id_sc_field_incluye_retencion' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_incluye_retencion_onblur(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_prod_presupuesto_periodo_incluye_retencion_onfocus(this, iSeqRow) });
  $('#id_sc_field_existe_retencion' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_existe_retencion_onblur(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_prod_presupuesto_periodo_existe_retencion_onfocus(this, iSeqRow) });
  $('#id_sc_field_observaciones_solicitud' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_observaciones_solicitud_onblur(this, iSeqRow) })
                                                     .bind('focus', function() { sc_form_prod_presupuesto_periodo_observaciones_solicitud_onfocus(this, iSeqRow) });
  $('#id_sc_field_afecta_iva' + iSeqRow).bind('blur', function() { sc_form_prod_presupuesto_periodo_afecta_iva_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_prod_presupuesto_periodo_afecta_iva_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_prod_presupuesto_periodo_id_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_id();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_id_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_id_proyecto_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_id_proyecto();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_id_proyecto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_monto_uf_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_uf();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_monto_uf_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_observaciones_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_observaciones_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_id_partida_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_id_partida();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_id_partida_onchange(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_event_id_partida_onchange();
}

function sc_form_prod_presupuesto_periodo_id_partida_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_facturado_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_facturado();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_facturado_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_valor_uf_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_valor_uf();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_valor_uf_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_factura_onblur(oThis, iSeqRow) {
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_factura_onfocus(oThis, iSeqRow) {
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_tipo_moneda_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_tipo_moneda();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_tipo_moneda_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_retencion_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_retencion_onchange(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_event_retencion_onchange();
}

function sc_form_prod_presupuesto_periodo_retencion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_multa_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_multa();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_multa_onchange(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_event_multa_onchange();
}

function sc_form_prod_presupuesto_periodo_multa_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_desde_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_desde_onchange(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_onchange();
}

function sc_form_prod_presupuesto_periodo_fecha_desde_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_hasta_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_hasta_onchange(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_onchange();
}

function sc_form_prod_presupuesto_periodo_fecha_hasta_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_dias_desde_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_desde();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_dias_desde_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_dias_hasta_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_hasta();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_dias_hasta_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_dias_periodo_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_dias_periodo();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_dias_periodo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_total_facturado_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_total_facturado();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_total_facturado_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_desde_factura_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_factura();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_desde_factura_onchange(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_desde_factura_onchange();
}

function sc_form_prod_presupuesto_periodo_fecha_desde_factura_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_hasta_factura_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_factura();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_fecha_hasta_factura_onchange(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_event_fecha_hasta_factura_onchange();
}

function sc_form_prod_presupuesto_periodo_fecha_hasta_factura_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_avance_informado_con_iva_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_avance_informado_con_iva();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_avance_informado_con_iva_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_retencion_con_iva_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_con_iva();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_retencion_con_iva_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_produccion_neto_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_produccion_neto();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_produccion_neto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_reajuste_acumulado_neto_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_neto();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_reajuste_acumulado_neto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_reajuste_acumulado_con_iva_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_reajuste_acumulado_con_iva();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_reajuste_acumulado_con_iva_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_considera_retencion_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_considera_retencion();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_considera_retencion_onchange(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_event_considera_retencion_onchange();
}

function sc_form_prod_presupuesto_periodo_considera_retencion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_cliente();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_empresa_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_empresa();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_empresa_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_facturacion_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_hitos_facturacion();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_hitos_facturacion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_iva_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_iva();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_iva_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_monto_contrato_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_monto_contrato();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_monto_contrato_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_retencion_acumulada_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_retencion_acumulada();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_retencion_acumulada_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_incluye_retencion_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_incluye_retencion();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_incluye_retencion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_existe_retencion_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_existe_retencion();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_existe_retencion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_observaciones_solicitud_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_observaciones_solicitud();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_observaciones_solicitud_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_presupuesto_periodo_afecta_iva_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_presupuesto_periodo_mob_validate_afecta_iva();
  scCssBlur(oThis);
}

function sc_form_prod_presupuesto_periodo_afecta_iva_onfocus(oThis, iSeqRow) {
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
	if ("6" == block) {
		displayChange_block_6(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("id", "", status);
	displayChange_field("id_proyecto", "", status);
	displayChange_field("monto_contrato", "", status);
	displayChange_field("tipo_moneda", "", status);
	displayChange_field("empresa", "", status);
	displayChange_field("cliente", "", status);
}

function displayChange_block_1(status) {
	displayChange_field("id_partida", "", status);
	displayChange_field("fecha_desde", "", status);
	displayChange_field("fecha_hasta", "", status);
	displayChange_field("dias_desde", "", status);
	displayChange_field("dias_hasta", "", status);
	displayChange_field("dias_periodo", "", status);
}

function displayChange_block_2(status) {
	displayChange_field("fecha_desde_factura", "", status);
	displayChange_field("fecha_hasta_factura", "", status);
	displayChange_field("avance_informado_con_iva", "", status);
	displayChange_field("produccion_neto", "", status);
	displayChange_field("retencion", "", status);
	displayChange_field("retencion_con_iva", "", status);
	displayChange_field("retencion_acumulada", "", status);
}

function displayChange_block_3(status) {
	displayChange_field("reajuste_acumulado_con_iva", "", status);
	displayChange_field("reajuste_acumulado_neto", "", status);
	displayChange_field("multa", "", status);
	displayChange_field("total_facturado", "", status);
}

function displayChange_block_4(status) {
	displayChange_field("afecta_iva", "", status);
	displayChange_field("existe_retencion", "", status);
	displayChange_field("incluye_retencion", "", status);
	displayChange_field("considera_retencion", "", status);
	displayChange_field("facturado", "", status);
	displayChange_field("observaciones_solicitud", "", status);
}

function displayChange_block_5(status) {
	displayChange_field("iva", "", status);
	displayChange_field("monto_uf", "", status);
	displayChange_field("fecha", "", status);
	displayChange_field("valor_uf", "", status);
	displayChange_field("observaciones", "", status);
	displayChange_field("factura", "", status);
}

function displayChange_block_6(status) {
	displayChange_field("hitos_facturacion", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_id(row, status);
	displayChange_field_id_proyecto(row, status);
	displayChange_field_monto_contrato(row, status);
	displayChange_field_tipo_moneda(row, status);
	displayChange_field_empresa(row, status);
	displayChange_field_cliente(row, status);
	displayChange_field_id_partida(row, status);
	displayChange_field_fecha_desde(row, status);
	displayChange_field_fecha_hasta(row, status);
	displayChange_field_dias_desde(row, status);
	displayChange_field_dias_hasta(row, status);
	displayChange_field_dias_periodo(row, status);
	displayChange_field_fecha_desde_factura(row, status);
	displayChange_field_fecha_hasta_factura(row, status);
	displayChange_field_avance_informado_con_iva(row, status);
	displayChange_field_produccion_neto(row, status);
	displayChange_field_retencion(row, status);
	displayChange_field_retencion_con_iva(row, status);
	displayChange_field_retencion_acumulada(row, status);
	displayChange_field_reajuste_acumulado_con_iva(row, status);
	displayChange_field_reajuste_acumulado_neto(row, status);
	displayChange_field_multa(row, status);
	displayChange_field_total_facturado(row, status);
	displayChange_field_afecta_iva(row, status);
	displayChange_field_existe_retencion(row, status);
	displayChange_field_incluye_retencion(row, status);
	displayChange_field_considera_retencion(row, status);
	displayChange_field_facturado(row, status);
	displayChange_field_observaciones_solicitud(row, status);
	displayChange_field_iva(row, status);
	displayChange_field_monto_uf(row, status);
	displayChange_field_fecha(row, status);
	displayChange_field_valor_uf(row, status);
	displayChange_field_observaciones(row, status);
	displayChange_field_factura(row, status);
	displayChange_field_hitos_facturacion(row, status);
}

function displayChange_field(field, row, status) {
	if ("id" == field) {
		displayChange_field_id(row, status);
	}
	if ("id_proyecto" == field) {
		displayChange_field_id_proyecto(row, status);
	}
	if ("monto_contrato" == field) {
		displayChange_field_monto_contrato(row, status);
	}
	if ("tipo_moneda" == field) {
		displayChange_field_tipo_moneda(row, status);
	}
	if ("empresa" == field) {
		displayChange_field_empresa(row, status);
	}
	if ("cliente" == field) {
		displayChange_field_cliente(row, status);
	}
	if ("id_partida" == field) {
		displayChange_field_id_partida(row, status);
	}
	if ("fecha_desde" == field) {
		displayChange_field_fecha_desde(row, status);
	}
	if ("fecha_hasta" == field) {
		displayChange_field_fecha_hasta(row, status);
	}
	if ("dias_desde" == field) {
		displayChange_field_dias_desde(row, status);
	}
	if ("dias_hasta" == field) {
		displayChange_field_dias_hasta(row, status);
	}
	if ("dias_periodo" == field) {
		displayChange_field_dias_periodo(row, status);
	}
	if ("fecha_desde_factura" == field) {
		displayChange_field_fecha_desde_factura(row, status);
	}
	if ("fecha_hasta_factura" == field) {
		displayChange_field_fecha_hasta_factura(row, status);
	}
	if ("avance_informado_con_iva" == field) {
		displayChange_field_avance_informado_con_iva(row, status);
	}
	if ("produccion_neto" == field) {
		displayChange_field_produccion_neto(row, status);
	}
	if ("retencion" == field) {
		displayChange_field_retencion(row, status);
	}
	if ("retencion_con_iva" == field) {
		displayChange_field_retencion_con_iva(row, status);
	}
	if ("retencion_acumulada" == field) {
		displayChange_field_retencion_acumulada(row, status);
	}
	if ("reajuste_acumulado_con_iva" == field) {
		displayChange_field_reajuste_acumulado_con_iva(row, status);
	}
	if ("reajuste_acumulado_neto" == field) {
		displayChange_field_reajuste_acumulado_neto(row, status);
	}
	if ("multa" == field) {
		displayChange_field_multa(row, status);
	}
	if ("total_facturado" == field) {
		displayChange_field_total_facturado(row, status);
	}
	if ("afecta_iva" == field) {
		displayChange_field_afecta_iva(row, status);
	}
	if ("existe_retencion" == field) {
		displayChange_field_existe_retencion(row, status);
	}
	if ("incluye_retencion" == field) {
		displayChange_field_incluye_retencion(row, status);
	}
	if ("considera_retencion" == field) {
		displayChange_field_considera_retencion(row, status);
	}
	if ("facturado" == field) {
		displayChange_field_facturado(row, status);
	}
	if ("observaciones_solicitud" == field) {
		displayChange_field_observaciones_solicitud(row, status);
	}
	if ("iva" == field) {
		displayChange_field_iva(row, status);
	}
	if ("monto_uf" == field) {
		displayChange_field_monto_uf(row, status);
	}
	if ("fecha" == field) {
		displayChange_field_fecha(row, status);
	}
	if ("valor_uf" == field) {
		displayChange_field_valor_uf(row, status);
	}
	if ("observaciones" == field) {
		displayChange_field_observaciones(row, status);
	}
	if ("factura" == field) {
		displayChange_field_factura(row, status);
	}
	if ("hitos_facturacion" == field) {
		displayChange_field_hitos_facturacion(row, status);
	}
}

function displayChange_field_id(row, status) {
    var fieldId;
}

function displayChange_field_id_proyecto(row, status) {
    var fieldId;
}

function displayChange_field_monto_contrato(row, status) {
    var fieldId;
}

function displayChange_field_tipo_moneda(row, status) {
    var fieldId;
}

function displayChange_field_empresa(row, status) {
    var fieldId;
}

function displayChange_field_cliente(row, status) {
    var fieldId;
}

function displayChange_field_id_partida(row, status) {
    var fieldId;
}

function displayChange_field_fecha_desde(row, status) {
    var fieldId;
}

function displayChange_field_fecha_hasta(row, status) {
    var fieldId;
}

function displayChange_field_dias_desde(row, status) {
    var fieldId;
}

function displayChange_field_dias_hasta(row, status) {
    var fieldId;
}

function displayChange_field_dias_periodo(row, status) {
    var fieldId;
}

function displayChange_field_fecha_desde_factura(row, status) {
    var fieldId;
}

function displayChange_field_fecha_hasta_factura(row, status) {
    var fieldId;
}

function displayChange_field_avance_informado_con_iva(row, status) {
    var fieldId;
}

function displayChange_field_produccion_neto(row, status) {
    var fieldId;
}

function displayChange_field_retencion(row, status) {
    var fieldId;
}

function displayChange_field_retencion_con_iva(row, status) {
    var fieldId;
}

function displayChange_field_retencion_acumulada(row, status) {
    var fieldId;
}

function displayChange_field_reajuste_acumulado_con_iva(row, status) {
    var fieldId;
}

function displayChange_field_reajuste_acumulado_neto(row, status) {
    var fieldId;
}

function displayChange_field_multa(row, status) {
    var fieldId;
}

function displayChange_field_total_facturado(row, status) {
    var fieldId;
}

function displayChange_field_afecta_iva(row, status) {
    var fieldId;
}

function displayChange_field_existe_retencion(row, status) {
    var fieldId;
}

function displayChange_field_incluye_retencion(row, status) {
    var fieldId;
}

function displayChange_field_considera_retencion(row, status) {
    var fieldId;
}

function displayChange_field_facturado(row, status) {
    var fieldId;
}

function displayChange_field_observaciones_solicitud(row, status) {
    var fieldId;
}

function displayChange_field_iva(row, status) {
    var fieldId;
}

function displayChange_field_monto_uf(row, status) {
    var fieldId;
}

function displayChange_field_fecha(row, status) {
    var fieldId;
}

function displayChange_field_valor_uf(row, status) {
    var fieldId;
}

function displayChange_field_observaciones(row, status) {
    var fieldId;
}

function displayChange_field_factura(row, status) {
    var fieldId;
}

function displayChange_field_hitos_facturacion(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_prod_presupuesto_periodo_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(41);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_fecha_desde" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha_desde" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde(iSeqRow); }, 200);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha_desde']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_fecha_hasta" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha_hasta" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta(iSeqRow); }, 200);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha_hasta']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_fecha_desde_factura" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha_desde_factura" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_desde_factura(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha_desde_factura']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_fecha_hasta_factura" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha_hasta_factura" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha_hasta_factura(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha_hasta_factura']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_fecha" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_prod_presupuesto_periodo_mob_validate_fecha(iSeqRow);
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
  $("#id_sc_field_factura" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_prod_presupuesto_periodo_mob_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'factura'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_factura" + iSeqRow);
        loaderContent = $("#id_img_loader_factura" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_factura" + iSeqRow);
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
        $("#id_img_loader_factura" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_factura" + iSeqRow).hide();
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
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
      $("#id_sc_field_factura" + iSeqRow).val("");
      $("#id_sc_field_factura_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_factura_ul_type" + iSeqRow).val(fileData[0].type);
      $("#id_ajax_doc_factura" + iSeqRow).html(fileData[0].name);
      $("#id_ajax_doc_factura" + iSeqRow).css("display", "");
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_factura" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_factura" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_prod_presupuesto_periodo_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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

