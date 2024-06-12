<div id="form_proyectos_form2" style='<?php echo ($this->tabCssClass["form_proyectos_form2"]['class'] == 'scTabInactive' ? 'display: none; width: 1px; height: 0px; overflow: scroll' : ''); ?>'>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_2"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_2" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['items_proyecto']))
   {
       $this->nm_new_label['items_proyecto'] = "Items Producción Asociados";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $items_proyecto = $this->items_proyecto;
   $sStyleHidden_items_proyecto = '';
   if (isset($this->nmgp_cmp_hidden['items_proyecto']) && $this->nmgp_cmp_hidden['items_proyecto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['items_proyecto']);
       $sStyleHidden_items_proyecto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_items_proyecto = 'display: none;';
   $sStyleReadInp_items_proyecto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['items_proyecto']) && $this->nmgp_cmp_readonly['items_proyecto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['items_proyecto']);
       $sStyleReadLab_items_proyecto = '';
       $sStyleReadInp_items_proyecto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['items_proyecto']) && $this->nmgp_cmp_hidden['items_proyecto'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="items_proyecto" value="<?php echo $this->form_encode_input($this->items_proyecto_hidden) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php  $this->items_proyecto_1 = explode("@?@", $this->items_proyecto) ; ?>
    <TD class="scFormLabelOdd scUiLabelWidthFix css_items_proyecto_label" id="hidden_field_label_items_proyecto" style="<?php echo $sStyleHidden_items_proyecto; ?>"><span id="id_label_items_proyecto"><?php echo $this->nm_new_label['items_proyecto']; ?></span></TD>
    <TD class="scFormDataOdd css_items_proyecto_line" id="hidden_field_data_items_proyecto" style="<?php echo $sStyleHidden_items_proyecto; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_items_proyecto_line" style="vertical-align: top;padding: 0px"> 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_items_proyecto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_items_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_items_proyecto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_items_proyecto'] = array(); 
}
if ($this->id_empresa != "")
{ 
   $this->nm_clear_val("id_empresa");
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_items_proyecto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_items_proyecto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_items_proyecto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_items_proyecto'] = array(); 
    }

   $old_value_fecha_inicio = $this->fecha_inicio;
   $old_value_fecha_termino = $this->fecha_termino;
   $old_value_duracion = $this->duracion;
   $old_value_presupuesto = $this->presupuesto;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_fecha_inicio = $this->fecha_inicio;
   $unformatted_value_fecha_termino = $this->fecha_termino;
   $unformatted_value_duracion = $this->duracion;
   $unformatted_value_presupuesto = $this->presupuesto;

   $nm_comando = "SELECT    prod_items_base.id_item,   concat(upper(prod_agrupa_items.nombre_agrupador), ' - ', item) AS FIELD_1 FROM   prod_items_base   INNER JOIN prod_agrupa_items ON (prod_items_base.agrupador1 = prod_agrupa_items.id)   INNER JOIN prod_items_base_tipo_proyectos ON (prod_items_base.id_item = prod_items_base_tipo_proyectos.id_item) WHERE   prod_items_base_tipo_proyectos.id_tipo_proyecto = $this->id_empresa  ORDER BY   prod_items_base.agrupador1,   prod_items_base.item";

   $this->fecha_inicio = $old_value_fecha_inicio;
   $this->fecha_termino = $old_value_fecha_termino;
   $this->duracion = $old_value_duracion;
   $this->presupuesto = $old_value_presupuesto;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['Lookup_items_proyecto'][] = $rs->fields[0];
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
   $items_proyecto_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->items_proyecto_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  $items_proyecto_look .= $cadaselect[0] . "<br>";
                  break;
              }
          }
          $x++; 
   }
          if (empty($items_proyecto_look))
          {
              $items_proyecto_look = $this->items_proyecto;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_items_proyecto\" class=\"css_items_proyecto_line\" style=\"" .  $sStyleReadLab_items_proyecto . "\">" . $this->form_format_readonly("items_proyecto", $this->form_encode_input($items_proyecto_look)) . "</span><span id=\"id_read_off_items_proyecto\" class=\"css_read_off_items_proyecto" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_items_proyecto . "\">";
   echo "<table style=\"display: inline-block\"><tr><td>" ; 
   echo " <span id=\"idAjaxSelect_items_proyecto\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_items_proyecto_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_items_proyecto\" name=\"items_proyecto_orig\" size=\"30\" multiple onDblClick=\"nm_add_sel('items_proyecto_orig', 'items_proyecto_dest', null);  \" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          foreach ($this->items_proyecto_1 as $Dados)
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
   echo "<div class='scBtnPassField' id='items_proyecto_all_right'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['bpassfld_rightall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['bpassfld_rightall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_rightall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_rightall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_rightall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_rightall", "nm_add_all('items_proyecto_orig', 'items_proyecto_dest', null);    return false;", "nm_add_all('items_proyecto_orig', 'items_proyecto_dest', null);    return false;", "Bbpassfld_rightall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['bpassfld_right']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['bpassfld_right']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_right']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_right']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_right'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_right", "nm_add_sel('items_proyecto_orig', 'items_proyecto_dest', null);    return false;", "nm_add_sel('items_proyecto_orig', 'items_proyecto_dest', null);    return false;", "Bbpassfld_righ", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['bpassfld_left']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['bpassfld_left']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_left']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_left']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_left'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_left", "nm_del_sel('items_proyecto_dest', 'items_proyecto_orig', null);    return false;", "nm_del_sel('items_proyecto_dest', 'items_proyecto_orig', null);    return false;", "Bbpassfld_left", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField' id='items_proyecto_all_left'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['bpassfld_leftall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['bpassfld_leftall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_leftall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_leftall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['bpassfld_leftall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_leftall", "nm_del_all('items_proyecto_dest', 'items_proyecto_orig', null);    return false;", "nm_del_all('items_proyecto_dest', 'items_proyecto_orig', null);    return false;", "Bbpassfld_leftall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "</td>";
   echo "<td>";
   echo " <select class=\"sc-js-input scFormObjectOdd css_items_proyecto_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" name=\"items_proyecto_dest\"  onBlur=\"scCssBlur(this);\"  onFocus=\"scCssFocus(this);\"  size=30 multiple onDblClick=\"nm_del_sel('items_proyecto_dest', 'items_proyecto_orig', null);  \" alt=\"{type: 'select', enterTab: false}\">";
   $x = 0 ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->items_proyecto_1 as $Dados)
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
   echo " <input type=\"hidden\" name=\"items_proyecto\" value=\"\">" ; 
   echo "</td></tr></table>";
   echo " <script>document.F1.items_proyecto_dest.selectedIndex = -1;</script>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('items_proyecto')", "nm_mostra_mens('items_proyecto')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_items_proyecto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_items_proyecto_text"></span></td></tr></table></td></tr></table></TD>
   
<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
</TABLE></div><!-- bloco_f -->
   </td></tr></table>
   </div>
</td></tr>
</td></tr>
<tr id="sc-id-required-row"><td class="scFormPageText">
<span class="scFormRequiredOddColor">* <?php echo $this->Ini->Nm_lang['lang_othr_reqr']; ?></span>
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R")
{
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "nm_move ('novo');", "nm_move ('novo');", "sc_b_new_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "nm_atualiza ('incluir');", "nm_atualiza ('incluir');", "sc_b_ins_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
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
 $NM_pag_atual = "form_proyectos_form0";
 if (isset($this->nmgp_ancora) && $this->nmgp_ancora != "")
 {
     $NM_pag_atual = "form_proyectos_form" . $this->nmgp_ancora;
 }
?>
<?php
if (!$this->nmgp_form_empty) {
?>
  document.getElementById('<?php echo $NM_pag_atual; ?>').style.width='';
  document.getElementById('<?php echo $NM_pag_atual; ?>').style.height='';
  document.getElementById('<?php echo $NM_pag_atual; ?>').style.display='';
  document.getElementById('<?php echo $NM_pag_atual; ?>').style.overflow='visible';
<?php
}
else {
?>
  $(".sc-ui-page-tab-line").hide();
  $("#sc-id-required-row").hide();
<?php
}
?>
</script> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1,2);

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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_proyectos");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_proyectos");
 parent.scAjaxDetailHeight("form_proyectos", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_proyectos", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_proyectos", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['sc_modal'])
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos']['buttonStatus'] = $this->nmgp_botoes;
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
