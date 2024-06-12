
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

  if ($oField.length > 0) {
    switch ($oField[0].name) {
      case 'nombre_proyecto':
      case 'codigo':
      case 'descripcion':
      case 'id_empresa':
      case 'id_cliente':
      case 'fecha_inicio':
      case 'fecha_termino':
      case 'duracion':
      case 'tipo_moneda':
      case 'presupuesto':
      case 'id_estado':
      case 'id_portafolio':
      case 'id_fase':
      case 'habilitado':
      case 'id_direccion':
      case 'id_jefe_proyecto':
      case 'afecta_iva':
      case 'existe_retencion':
      case 'incluye_retencion':
      case 'observaciones':
        sc_exib_ocult_pag('form_proyectos_form0');
        break;
      case 'proyecto_usuarios':
        sc_exib_ocult_pag('form_proyectos_form1');
        break;
      case 'items_proyecto':
        sc_exib_ocult_pag('form_proyectos_form2');
        break;
    }
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
  scEventControl_data["nombre_proyecto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["codigo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["descripcion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_empresa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_cliente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha_inicio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fecha_termino" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["duracion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_moneda" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["presupuesto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_estado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_portafolio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_fase" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["habilitado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_direccion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_jefe_proyecto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["afecta_iva" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["existe_retencion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["incluye_retencion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["observaciones" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["proyecto_usuarios" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["items_proyecto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["nombre_proyecto" + iSeqRow] && scEventControl_data["nombre_proyecto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nombre_proyecto" + iSeqRow] && scEventControl_data["nombre_proyecto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["codigo" + iSeqRow] && scEventControl_data["codigo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["codigo" + iSeqRow] && scEventControl_data["codigo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["descripcion" + iSeqRow] && scEventControl_data["descripcion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["descripcion" + iSeqRow] && scEventControl_data["descripcion" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_empresa" + iSeqRow] && scEventControl_data["id_empresa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_empresa" + iSeqRow] && scEventControl_data["id_empresa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_cliente" + iSeqRow] && scEventControl_data["id_cliente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_cliente" + iSeqRow] && scEventControl_data["id_cliente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha_inicio" + iSeqRow] && scEventControl_data["fecha_inicio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha_inicio" + iSeqRow] && scEventControl_data["fecha_inicio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fecha_termino" + iSeqRow] && scEventControl_data["fecha_termino" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fecha_termino" + iSeqRow] && scEventControl_data["fecha_termino" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["duracion" + iSeqRow] && scEventControl_data["duracion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["duracion" + iSeqRow] && scEventControl_data["duracion" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_moneda" + iSeqRow] && scEventControl_data["tipo_moneda" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_moneda" + iSeqRow] && scEventControl_data["tipo_moneda" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["presupuesto" + iSeqRow] && scEventControl_data["presupuesto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["presupuesto" + iSeqRow] && scEventControl_data["presupuesto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_estado" + iSeqRow] && scEventControl_data["id_estado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_estado" + iSeqRow] && scEventControl_data["id_estado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_portafolio" + iSeqRow] && scEventControl_data["id_portafolio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_portafolio" + iSeqRow] && scEventControl_data["id_portafolio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_fase" + iSeqRow] && scEventControl_data["id_fase" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_fase" + iSeqRow] && scEventControl_data["id_fase" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["habilitado" + iSeqRow] && scEventControl_data["habilitado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["habilitado" + iSeqRow] && scEventControl_data["habilitado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_direccion" + iSeqRow] && scEventControl_data["id_direccion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_direccion" + iSeqRow] && scEventControl_data["id_direccion" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_jefe_proyecto" + iSeqRow] && scEventControl_data["id_jefe_proyecto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_jefe_proyecto" + iSeqRow] && scEventControl_data["id_jefe_proyecto" + iSeqRow]["change"]) {
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
  if (scEventControl_data["observaciones" + iSeqRow] && scEventControl_data["observaciones" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["observaciones" + iSeqRow] && scEventControl_data["observaciones" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["proyecto_usuarios" + iSeqRow] && scEventControl_data["proyecto_usuarios" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["proyecto_usuarios" + iSeqRow] && scEventControl_data["proyecto_usuarios" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["items_proyecto" + iSeqRow] && scEventControl_data["items_proyecto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["items_proyecto" + iSeqRow] && scEventControl_data["items_proyecto" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("id_empresa" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_cliente" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tipo_moneda" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_estado" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_portafolio" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_fase" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("habilitado" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_direccion" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("id_jefe_proyecto" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("afecta_iva" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("existe_retencion" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("incluye_retencion" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("is_deleted" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("fecha_inicio" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("fecha_termino" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("id_cliente" + iSeq == fieldName) {
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
  $('#id_sc_field_id' + iSeqRow).bind('change', function() { sc_form_proyectos_id_onchange(this, iSeqRow) });
  $('#id_sc_field_codigo' + iSeqRow).bind('blur', function() { sc_form_proyectos_codigo_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_proyectos_codigo_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_proyectos_codigo_onfocus(this, iSeqRow) });
  $('#id_sc_field_nombre_proyecto' + iSeqRow).bind('blur', function() { sc_form_proyectos_nombre_proyecto_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_proyectos_nombre_proyecto_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_proyectos_nombre_proyecto_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha_inicio' + iSeqRow).bind('blur', function() { sc_form_proyectos_fecha_inicio_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_proyectos_fecha_inicio_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_proyectos_fecha_inicio_onfocus(this, iSeqRow) });
  $('#id_sc_field_fecha_termino' + iSeqRow).bind('blur', function() { sc_form_proyectos_fecha_termino_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_proyectos_fecha_termino_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_proyectos_fecha_termino_onfocus(this, iSeqRow) });
  $('#id_sc_field_duracion' + iSeqRow).bind('blur', function() { sc_form_proyectos_duracion_onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_form_proyectos_duracion_onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_proyectos_duracion_onfocus(this, iSeqRow) });
  $('#id_sc_field_progreso' + iSeqRow).bind('change', function() { sc_form_proyectos_progreso_onchange(this, iSeqRow) });
  $('#id_sc_field_presupuesto' + iSeqRow).bind('blur', function() { sc_form_proyectos_presupuesto_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_proyectos_presupuesto_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_proyectos_presupuesto_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_portafolio' + iSeqRow).bind('blur', function() { sc_form_proyectos_id_portafolio_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_proyectos_id_portafolio_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_proyectos_id_portafolio_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_estado' + iSeqRow).bind('blur', function() { sc_form_proyectos_id_estado_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_proyectos_id_estado_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_proyectos_id_estado_onfocus(this, iSeqRow) });
  $('#id_sc_field_descripcion' + iSeqRow).bind('blur', function() { sc_form_proyectos_descripcion_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_proyectos_descripcion_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_proyectos_descripcion_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_fase' + iSeqRow).bind('blur', function() { sc_form_proyectos_id_fase_onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_form_proyectos_id_fase_onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_proyectos_id_fase_onfocus(this, iSeqRow) });
  $('#id_sc_field_habilitado' + iSeqRow).bind('blur', function() { sc_form_proyectos_habilitado_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_proyectos_habilitado_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_proyectos_habilitado_onfocus(this, iSeqRow) });
  $('#id_sc_field_is_deleted' + iSeqRow).bind('change', function() { sc_form_proyectos_is_deleted_onchange(this, iSeqRow) });
  $('#id_sc_field_id_direccion' + iSeqRow).bind('blur', function() { sc_form_proyectos_id_direccion_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_proyectos_id_direccion_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_proyectos_id_direccion_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_jefe_proyecto' + iSeqRow).bind('blur', function() { sc_form_proyectos_id_jefe_proyecto_onblur(this, iSeqRow) })
                                              .bind('change', function() { sc_form_proyectos_id_jefe_proyecto_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_proyectos_id_jefe_proyecto_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_cliente' + iSeqRow).bind('blur', function() { sc_form_proyectos_id_cliente_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_proyectos_id_cliente_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_proyectos_id_cliente_onfocus(this, iSeqRow) });
  $('#id_sc_field_porcentaje_gastos_generales' + iSeqRow).bind('change', function() { sc_form_proyectos_porcentaje_gastos_generales_onchange(this, iSeqRow) });
  $('#id_sc_field_porcentaje_utilidades' + iSeqRow).bind('change', function() { sc_form_proyectos_porcentaje_utilidades_onchange(this, iSeqRow) });
  $('#id_sc_field_id_empresa' + iSeqRow).bind('blur', function() { sc_form_proyectos_id_empresa_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_proyectos_id_empresa_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_proyectos_id_empresa_onfocus(this, iSeqRow) });
  $('#id_sc_field_tipo_moneda' + iSeqRow).bind('blur', function() { sc_form_proyectos_tipo_moneda_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_proyectos_tipo_moneda_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_proyectos_tipo_moneda_onfocus(this, iSeqRow) });
  $('#id_sc_field_retencion' + iSeqRow).bind('change', function() { sc_form_proyectos_retencion_onchange(this, iSeqRow) });
  $('#id_sc_field_porcentaje_retencion' + iSeqRow).bind('change', function() { sc_form_proyectos_porcentaje_retencion_onchange(this, iSeqRow) });
  $('#id_sc_field_afecta_iva' + iSeqRow).bind('blur', function() { sc_form_proyectos_afecta_iva_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_proyectos_afecta_iva_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_proyectos_afecta_iva_onfocus(this, iSeqRow) });
  $('#id_sc_field_incluye_retencion' + iSeqRow).bind('blur', function() { sc_form_proyectos_incluye_retencion_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_proyectos_incluye_retencion_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_proyectos_incluye_retencion_onfocus(this, iSeqRow) });
  $('#id_sc_field_existe_retencion' + iSeqRow).bind('blur', function() { sc_form_proyectos_existe_retencion_onblur(this, iSeqRow) })
                                              .bind('change', function() { sc_form_proyectos_existe_retencion_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_proyectos_existe_retencion_onfocus(this, iSeqRow) });
  $('#id_sc_field_observaciones' + iSeqRow).bind('blur', function() { sc_form_proyectos_observaciones_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_proyectos_observaciones_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_proyectos_observaciones_onfocus(this, iSeqRow) });
  $('#id_sc_field_items_proyecto' + iSeqRow).bind('blur', function() { sc_form_proyectos_items_proyecto_onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_proyectos_items_proyecto_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_proyectos_items_proyecto_onfocus(this, iSeqRow) });
  $('#id_sc_field_proyecto_usuarios' + iSeqRow).bind('blur', function() { sc_form_proyectos_proyecto_usuarios_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_proyectos_proyecto_usuarios_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_proyectos_proyecto_usuarios_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_proyectos_id_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_codigo_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_codigo();
  scCssBlur(oThis);
}

function sc_form_proyectos_codigo_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_codigo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_nombre_proyecto_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_nombre_proyecto();
  scCssBlur(oThis);
}

function sc_form_proyectos_nombre_proyecto_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_nombre_proyecto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_fecha_inicio_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_fecha_inicio();
  scCssBlur(oThis);
}

function sc_form_proyectos_fecha_inicio_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  do_ajax_form_proyectos_event_fecha_inicio_onchange();
}

function sc_form_proyectos_fecha_inicio_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_fecha_termino_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_fecha_termino();
  scCssBlur(oThis);
}

function sc_form_proyectos_fecha_termino_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  do_ajax_form_proyectos_event_fecha_termino_onchange();
}

function sc_form_proyectos_fecha_termino_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_duracion_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_duracion();
  scCssBlur(oThis);
}

function sc_form_proyectos_duracion_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_duracion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_progreso_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_presupuesto_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_presupuesto();
  scCssBlur(oThis);
}

function sc_form_proyectos_presupuesto_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_presupuesto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_id_portafolio_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_id_portafolio();
  scCssBlur(oThis);
}

function sc_form_proyectos_id_portafolio_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_id_portafolio_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_id_estado_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_id_estado();
  scCssBlur(oThis);
}

function sc_form_proyectos_id_estado_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_id_estado_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_descripcion_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_descripcion();
  scCssBlur(oThis);
}

function sc_form_proyectos_descripcion_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_descripcion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_id_fase_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_id_fase();
  scCssBlur(oThis);
}

function sc_form_proyectos_id_fase_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_id_fase_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_habilitado_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_habilitado();
  scCssBlur(oThis);
}

function sc_form_proyectos_habilitado_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_habilitado_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_is_deleted_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_id_direccion_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_id_direccion();
  scCssBlur(oThis);
}

function sc_form_proyectos_id_direccion_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_id_direccion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_id_jefe_proyecto_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_id_jefe_proyecto();
  scCssBlur(oThis);
}

function sc_form_proyectos_id_jefe_proyecto_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_id_jefe_proyecto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_id_cliente_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_id_cliente();
  scCssBlur(oThis);
}

function sc_form_proyectos_id_cliente_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  do_ajax_form_proyectos_event_id_cliente_onchange();
}

function sc_form_proyectos_id_cliente_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_porcentaje_gastos_generales_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_porcentaje_utilidades_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_id_empresa_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_id_empresa();
  scCssBlur(oThis);
}

function sc_form_proyectos_id_empresa_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  do_ajax_form_proyectos_refresh_id_empresa();
}

function sc_form_proyectos_id_empresa_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_tipo_moneda_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_tipo_moneda();
  scCssBlur(oThis);
}

function sc_form_proyectos_tipo_moneda_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_tipo_moneda_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_retencion_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_porcentaje_retencion_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_afecta_iva_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_afecta_iva();
  scCssBlur(oThis);
}

function sc_form_proyectos_afecta_iva_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_afecta_iva_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_incluye_retencion_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_incluye_retencion();
  scCssBlur(oThis);
}

function sc_form_proyectos_incluye_retencion_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_incluye_retencion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_existe_retencion_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_existe_retencion();
  scCssBlur(oThis);
}

function sc_form_proyectos_existe_retencion_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_existe_retencion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_observaciones_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_observaciones();
  scCssBlur(oThis);
}

function sc_form_proyectos_observaciones_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_observaciones_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_items_proyecto_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_items_proyecto();
  scCssBlur(oThis);
}

function sc_form_proyectos_items_proyecto_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_items_proyecto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_proyectos_proyecto_usuarios_onblur(oThis, iSeqRow) {
  do_ajax_form_proyectos_validate_proyecto_usuarios();
  scCssBlur(oThis);
}

function sc_form_proyectos_proyecto_usuarios_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_proyectos_proyecto_usuarios_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_page(page, status) {
	if ("0" == page) {
		displayChange_page_0(status);
	}
	if ("1" == page) {
		displayChange_page_1(status);
	}
	if ("2" == page) {
		displayChange_page_2(status);
	}
}

function displayChange_page_0(status) {
	displayChange_block("0", status);
}

function displayChange_page_1(status) {
	displayChange_block("1", status);
}

function displayChange_page_2(status) {
	displayChange_block("2", status);
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
}

function displayChange_block_0(status) {
	displayChange_field("nombre_proyecto", "", status);
	displayChange_field("codigo", "", status);
	displayChange_field("descripcion", "", status);
	displayChange_field("id_empresa", "", status);
	displayChange_field("id_cliente", "", status);
	displayChange_field("fecha_inicio", "", status);
	displayChange_field("fecha_termino", "", status);
	displayChange_field("duracion", "", status);
	displayChange_field("tipo_moneda", "", status);
	displayChange_field("presupuesto", "", status);
	displayChange_field("id_estado", "", status);
	displayChange_field("id_portafolio", "", status);
	displayChange_field("id_fase", "", status);
	displayChange_field("habilitado", "", status);
	displayChange_field("id_direccion", "", status);
	displayChange_field("id_jefe_proyecto", "", status);
	displayChange_field("afecta_iva", "", status);
	displayChange_field("existe_retencion", "", status);
	displayChange_field("incluye_retencion", "", status);
	displayChange_field("observaciones", "", status);
}

function displayChange_block_1(status) {
	displayChange_field("proyecto_usuarios", "", status);
}

function displayChange_block_2(status) {
	displayChange_field("items_proyecto", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_nombre_proyecto(row, status);
	displayChange_field_codigo(row, status);
	displayChange_field_descripcion(row, status);
	displayChange_field_id_empresa(row, status);
	displayChange_field_id_cliente(row, status);
	displayChange_field_fecha_inicio(row, status);
	displayChange_field_fecha_termino(row, status);
	displayChange_field_duracion(row, status);
	displayChange_field_tipo_moneda(row, status);
	displayChange_field_presupuesto(row, status);
	displayChange_field_id_estado(row, status);
	displayChange_field_id_portafolio(row, status);
	displayChange_field_id_fase(row, status);
	displayChange_field_habilitado(row, status);
	displayChange_field_id_direccion(row, status);
	displayChange_field_id_jefe_proyecto(row, status);
	displayChange_field_afecta_iva(row, status);
	displayChange_field_existe_retencion(row, status);
	displayChange_field_incluye_retencion(row, status);
	displayChange_field_observaciones(row, status);
	displayChange_field_proyecto_usuarios(row, status);
	displayChange_field_items_proyecto(row, status);
}

function displayChange_field(field, row, status) {
	if ("nombre_proyecto" == field) {
		displayChange_field_nombre_proyecto(row, status);
	}
	if ("codigo" == field) {
		displayChange_field_codigo(row, status);
	}
	if ("descripcion" == field) {
		displayChange_field_descripcion(row, status);
	}
	if ("id_empresa" == field) {
		displayChange_field_id_empresa(row, status);
	}
	if ("id_cliente" == field) {
		displayChange_field_id_cliente(row, status);
	}
	if ("fecha_inicio" == field) {
		displayChange_field_fecha_inicio(row, status);
	}
	if ("fecha_termino" == field) {
		displayChange_field_fecha_termino(row, status);
	}
	if ("duracion" == field) {
		displayChange_field_duracion(row, status);
	}
	if ("tipo_moneda" == field) {
		displayChange_field_tipo_moneda(row, status);
	}
	if ("presupuesto" == field) {
		displayChange_field_presupuesto(row, status);
	}
	if ("id_estado" == field) {
		displayChange_field_id_estado(row, status);
	}
	if ("id_portafolio" == field) {
		displayChange_field_id_portafolio(row, status);
	}
	if ("id_fase" == field) {
		displayChange_field_id_fase(row, status);
	}
	if ("habilitado" == field) {
		displayChange_field_habilitado(row, status);
	}
	if ("id_direccion" == field) {
		displayChange_field_id_direccion(row, status);
	}
	if ("id_jefe_proyecto" == field) {
		displayChange_field_id_jefe_proyecto(row, status);
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
	if ("observaciones" == field) {
		displayChange_field_observaciones(row, status);
	}
	if ("proyecto_usuarios" == field) {
		displayChange_field_proyecto_usuarios(row, status);
	}
	if ("items_proyecto" == field) {
		displayChange_field_items_proyecto(row, status);
	}
}

function displayChange_field_nombre_proyecto(row, status) {
    var fieldId;
}

function displayChange_field_codigo(row, status) {
    var fieldId;
}

function displayChange_field_descripcion(row, status) {
    var fieldId;
}

function displayChange_field_id_empresa(row, status) {
    var fieldId;
}

function displayChange_field_id_cliente(row, status) {
    var fieldId;
}

function displayChange_field_fecha_inicio(row, status) {
    var fieldId;
}

function displayChange_field_fecha_termino(row, status) {
    var fieldId;
}

function displayChange_field_duracion(row, status) {
    var fieldId;
}

function displayChange_field_tipo_moneda(row, status) {
    var fieldId;
}

function displayChange_field_presupuesto(row, status) {
    var fieldId;
}

function displayChange_field_id_estado(row, status) {
    var fieldId;
}

function displayChange_field_id_portafolio(row, status) {
    var fieldId;
}

function displayChange_field_id_fase(row, status) {
    var fieldId;
}

function displayChange_field_habilitado(row, status) {
    var fieldId;
}

function displayChange_field_id_direccion(row, status) {
    var fieldId;
}

function displayChange_field_id_jefe_proyecto(row, status) {
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

function displayChange_field_observaciones(row, status) {
    var fieldId;
}

function displayChange_field_proyecto_usuarios(row, status) {
    var fieldId;
}

function displayChange_field_items_proyecto(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_proyectos_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(22);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_fecha_inicio" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha_inicio" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_form_proyectos_validate_fecha_inicio(iSeqRow); }, 200);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha_inicio']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_fecha_termino" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_fecha_termino" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_form_proyectos_validate_fecha_termino(iSeqRow); }, 200);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['fecha_termino']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_proyectos')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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

