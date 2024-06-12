
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
  scEventControl_data["nombre" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nombre_legal" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["rut" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["direccion" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["giro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["contacto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["telefono" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["contacto2" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["email2" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["telefono2" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["nombre" + iSeqRow] && scEventControl_data["nombre" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nombre" + iSeqRow] && scEventControl_data["nombre" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nombre_legal" + iSeqRow] && scEventControl_data["nombre_legal" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nombre_legal" + iSeqRow] && scEventControl_data["nombre_legal" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["rut" + iSeqRow] && scEventControl_data["rut" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["rut" + iSeqRow] && scEventControl_data["rut" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["direccion" + iSeqRow] && scEventControl_data["direccion" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["direccion" + iSeqRow] && scEventControl_data["direccion" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["giro" + iSeqRow] && scEventControl_data["giro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["giro" + iSeqRow] && scEventControl_data["giro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["contacto" + iSeqRow] && scEventControl_data["contacto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["contacto" + iSeqRow] && scEventControl_data["contacto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["email" + iSeqRow] && scEventControl_data["email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["email" + iSeqRow] && scEventControl_data["email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["telefono" + iSeqRow] && scEventControl_data["telefono" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["telefono" + iSeqRow] && scEventControl_data["telefono" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["contacto2" + iSeqRow] && scEventControl_data["contacto2" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["contacto2" + iSeqRow] && scEventControl_data["contacto2" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["email2" + iSeqRow] && scEventControl_data["email2" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["email2" + iSeqRow] && scEventControl_data["email2" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["telefono2" + iSeqRow] && scEventControl_data["telefono2" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["telefono2" + iSeqRow] && scEventControl_data["telefono2" + iSeqRow]["change"]) {
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
  $('#id_sc_field_id' + iSeqRow).bind('change', function() { sc_form_prod_clientes_id_onchange(this, iSeqRow) });
  $('#id_sc_field_nombre' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_nombre_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_prod_clientes_nombre_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_prod_clientes_nombre_onfocus(this, iSeqRow) });
  $('#id_sc_field_direccion' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_direccion_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_prod_clientes_direccion_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_prod_clientes_direccion_onfocus(this, iSeqRow) });
  $('#id_sc_field_email' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_email_onblur(this, iSeqRow) })
                                   .bind('change', function() { sc_form_prod_clientes_email_onchange(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_prod_clientes_email_onfocus(this, iSeqRow) });
  $('#id_sc_field_telefono' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_telefono_onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_form_prod_clientes_telefono_onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_prod_clientes_telefono_onfocus(this, iSeqRow) });
  $('#id_sc_field_contacto' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_contacto_onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_form_prod_clientes_contacto_onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_prod_clientes_contacto_onfocus(this, iSeqRow) });
  $('#id_sc_field_contacto2' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_contacto2_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_prod_clientes_contacto2_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_prod_clientes_contacto2_onfocus(this, iSeqRow) });
  $('#id_sc_field_email2' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_email2_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_prod_clientes_email2_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_prod_clientes_email2_onfocus(this, iSeqRow) });
  $('#id_sc_field_nombre_legal' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_nombre_legal_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_prod_clientes_nombre_legal_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_prod_clientes_nombre_legal_onfocus(this, iSeqRow) });
  $('#id_sc_field_telefono2' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_telefono2_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_prod_clientes_telefono2_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_prod_clientes_telefono2_onfocus(this, iSeqRow) });
  $('#id_sc_field_rut' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_rut_onblur(this, iSeqRow) })
                                 .bind('change', function() { sc_form_prod_clientes_rut_onchange(this, iSeqRow) })
                                 .bind('focus', function() { sc_form_prod_clientes_rut_onfocus(this, iSeqRow) });
  $('#id_sc_field_giro' + iSeqRow).bind('blur', function() { sc_form_prod_clientes_giro_onblur(this, iSeqRow) })
                                  .bind('change', function() { sc_form_prod_clientes_giro_onchange(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_prod_clientes_giro_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_prod_clientes_id_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_nombre_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_nombre();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_nombre_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_nombre_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_direccion_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_direccion();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_direccion_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_direccion_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_email_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_email();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_email_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_email_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_telefono_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_telefono();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_telefono_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_telefono_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_contacto_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_contacto();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_contacto_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_contacto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_contacto2_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_contacto2();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_contacto2_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_contacto2_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_email2_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_email2();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_email2_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_email2_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_nombre_legal_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_nombre_legal();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_nombre_legal_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_nombre_legal_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_telefono2_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_telefono2();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_telefono2_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_telefono2_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_rut_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_rut();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_rut_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_rut_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prod_clientes_giro_onblur(oThis, iSeqRow) {
  do_ajax_form_prod_clientes_validate_giro();
  scCssBlur(oThis);
}

function sc_form_prod_clientes_giro_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_prod_clientes_giro_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("nombre", "", status);
	displayChange_field("nombre_legal", "", status);
	displayChange_field("rut", "", status);
	displayChange_field("direccion", "", status);
	displayChange_field("giro", "", status);
	displayChange_field("contacto", "", status);
	displayChange_field("email", "", status);
	displayChange_field("telefono", "", status);
	displayChange_field("contacto2", "", status);
	displayChange_field("email2", "", status);
	displayChange_field("telefono2", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_nombre(row, status);
	displayChange_field_nombre_legal(row, status);
	displayChange_field_rut(row, status);
	displayChange_field_direccion(row, status);
	displayChange_field_giro(row, status);
	displayChange_field_contacto(row, status);
	displayChange_field_email(row, status);
	displayChange_field_telefono(row, status);
	displayChange_field_contacto2(row, status);
	displayChange_field_email2(row, status);
	displayChange_field_telefono2(row, status);
}

function displayChange_field(field, row, status) {
	if ("nombre" == field) {
		displayChange_field_nombre(row, status);
	}
	if ("nombre_legal" == field) {
		displayChange_field_nombre_legal(row, status);
	}
	if ("rut" == field) {
		displayChange_field_rut(row, status);
	}
	if ("direccion" == field) {
		displayChange_field_direccion(row, status);
	}
	if ("giro" == field) {
		displayChange_field_giro(row, status);
	}
	if ("contacto" == field) {
		displayChange_field_contacto(row, status);
	}
	if ("email" == field) {
		displayChange_field_email(row, status);
	}
	if ("telefono" == field) {
		displayChange_field_telefono(row, status);
	}
	if ("contacto2" == field) {
		displayChange_field_contacto2(row, status);
	}
	if ("email2" == field) {
		displayChange_field_email2(row, status);
	}
	if ("telefono2" == field) {
		displayChange_field_telefono2(row, status);
	}
}

function displayChange_field_nombre(row, status) {
    var fieldId;
}

function displayChange_field_nombre_legal(row, status) {
    var fieldId;
}

function displayChange_field_rut(row, status) {
    var fieldId;
}

function displayChange_field_direccion(row, status) {
    var fieldId;
}

function displayChange_field_giro(row, status) {
    var fieldId;
}

function displayChange_field_contacto(row, status) {
    var fieldId;
}

function displayChange_field_email(row, status) {
    var fieldId;
}

function displayChange_field_telefono(row, status) {
    var fieldId;
}

function displayChange_field_contacto2(row, status) {
    var fieldId;
}

function displayChange_field_email2(row, status) {
    var fieldId;
}

function displayChange_field_telefono2(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_prod_clientes_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(26);
		}
	}
}
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_prod_clientes')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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

