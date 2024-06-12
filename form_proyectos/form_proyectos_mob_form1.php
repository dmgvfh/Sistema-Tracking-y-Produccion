<div id="form_proyectos_mob_form1" style='<?php echo ($this->tabCssClass["form_proyectos_mob_form1"]['class'] == 'scTabInactive' ? 'display: none; width: 1px; height: 0px; overflow: scroll' : ''); ?>'>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_1" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['proyecto_usuarios']))
   {
       $this->nm_new_label['proyecto_usuarios'] = "Usuarios Proyecto";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $proyecto_usuarios = $this->proyecto_usuarios;
   $sStyleHidden_proyecto_usuarios = '';
   if (isset($this->nmgp_cmp_hidden['proyecto_usuarios']) && $this->nmgp_cmp_hidden['proyecto_usuarios'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['proyecto_usuarios']);
       $sStyleHidden_proyecto_usuarios = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_proyecto_usuarios = 'display: none;';
   $sStyleReadInp_proyecto_usuarios = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['proyecto_usuarios']) && $this->nmgp_cmp_readonly['proyecto_usuarios'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['proyecto_usuarios']);
       $sStyleReadLab_proyecto_usuarios = '';
       $sStyleReadInp_proyecto_usuarios = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['proyecto_usuarios']) && $this->nmgp_cmp_hidden['proyecto_usuarios'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="proyecto_usuarios" value="<?php echo $this->form_encode_input($this->proyecto_usuarios_hidden) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php  $this->proyecto_usuarios_1 = explode("@?@", $this->proyecto_usuarios) ; ?>
    <TD class="scFormDataOdd css_proyecto_usuarios_line" id="hidden_field_data_proyecto_usuarios" style="<?php echo $sStyleHidden_proyecto_usuarios; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_proyecto_usuarios_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_proyecto_usuarios_label" style=""><span id="id_label_proyecto_usuarios"><?php echo $this->nm_new_label['proyecto_usuarios']; ?></span></span><br> 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['Lookup_proyecto_usuarios']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['Lookup_proyecto_usuarios'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['Lookup_proyecto_usuarios']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['Lookup_proyecto_usuarios'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['Lookup_proyecto_usuarios']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['Lookup_proyecto_usuarios'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['Lookup_proyecto_usuarios']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['Lookup_proyecto_usuarios'] = array(); 
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

   $nm_comando = "select id, name from sec_users WHERE is_active = 'Y' order by name";

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['Lookup_proyecto_usuarios'][] = $rs->fields[0];
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
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   $x = 0 ; 
   $proyecto_usuarios_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->proyecto_usuarios_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  $proyecto_usuarios_look .= $cadaselect[0] . "<br>";
                  break;
              }
          }
          $x++; 
   }
          if (empty($proyecto_usuarios_look))
          {
              $proyecto_usuarios_look = $this->proyecto_usuarios;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_proyecto_usuarios\" class=\"css_proyecto_usuarios_line\" style=\"" .  $sStyleReadLab_proyecto_usuarios . "\">" . $this->form_format_readonly("proyecto_usuarios", $this->form_encode_input($proyecto_usuarios_look)) . "</span><span id=\"id_read_off_proyecto_usuarios\" class=\"css_read_off_proyecto_usuarios" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_proyecto_usuarios . "\">";
   echo "<table style=\"display: inline-block\"><tr><td>" ; 
   echo " <span id=\"idAjaxSelect_proyecto_usuarios\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_proyecto_usuarios_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_proyecto_usuarios\" name=\"proyecto_usuarios_orig\" size=\"14\" multiple onDblClick=\"nm_add_sel('proyecto_usuarios_orig', 'proyecto_usuarios_dest', null);  \" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          foreach ($this->proyecto_usuarios_1 as $Dados)
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
   echo "<div class='scBtnPassField' id='proyecto_usuarios_all_right'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_disabled']['bpassfld_rightall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_disabled']['bpassfld_rightall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_rightall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_rightall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_rightall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_rightall", "nm_add_all('proyecto_usuarios_orig', 'proyecto_usuarios_dest', null);    return false;", "nm_add_all('proyecto_usuarios_orig', 'proyecto_usuarios_dest', null);    return false;", "Bbpassfld_rightall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_disabled']['bpassfld_right']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_disabled']['bpassfld_right']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_right']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_right']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_right'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_right", "nm_add_sel('proyecto_usuarios_orig', 'proyecto_usuarios_dest', null);    return false;", "nm_add_sel('proyecto_usuarios_orig', 'proyecto_usuarios_dest', null);    return false;", "Bbpassfld_righ", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_disabled']['bpassfld_left']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_disabled']['bpassfld_left']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_left']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_left']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_left'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_left", "nm_del_sel('proyecto_usuarios_dest', 'proyecto_usuarios_orig', null);    return false;", "nm_del_sel('proyecto_usuarios_dest', 'proyecto_usuarios_orig', null);    return false;", "Bbpassfld_left", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField' id='proyecto_usuarios_all_left'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_disabled']['bpassfld_leftall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_disabled']['bpassfld_leftall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_leftall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_leftall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proyectos_mob']['btn_label']['bpassfld_leftall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_leftall", "nm_del_all('proyecto_usuarios_dest', 'proyecto_usuarios_orig', null);    return false;", "nm_del_all('proyecto_usuarios_dest', 'proyecto_usuarios_orig', null);    return false;", "Bbpassfld_leftall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
;
   echo "</div>";
   echo "</td>";
   echo "<td>";
   echo " <select class=\"sc-js-input scFormObjectOdd css_proyecto_usuarios_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" name=\"proyecto_usuarios_dest\"  onBlur=\"scCssBlur(this);\"  onFocus=\"scCssFocus(this);\"  size=14 multiple onDblClick=\"nm_del_sel('proyecto_usuarios_dest', 'proyecto_usuarios_orig', null);  \" alt=\"{type: 'select', enterTab: false}\">";
   $x = 0 ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->proyecto_usuarios_1 as $Dados)
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
   echo " <input type=\"hidden\" name=\"proyecto_usuarios\" value=\"\">" ; 
   echo "</td></tr></table>";
   echo " <script>document.F1.proyecto_usuarios_dest.selectedIndex = -1;</script>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_proyecto_usuarios_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_proyecto_usuarios_text"></span></td></tr></table></td></tr></table> </TD>
   




<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </tr>
</TABLE></div><!-- bloco_f -->
   </td></tr></table>
   </div>
