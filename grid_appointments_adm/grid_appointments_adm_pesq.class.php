<?php

class grid_appointments_adm_pesq
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $cmp_formatado;
   var $nm_data;
   var $Campos_Mens_erro;

   var $comando;
   var $comando_sum;
   var $comando_filtro;
   var $comando_ini;
   var $comando_fim;
   var $NM_operador;
   var $NM_data_qp;
   var $NM_path_filter;
   var $NM_curr_fil;
   var $nm_location;
   var $NM_ajax_opcao;
   var $nmgp_botoes = array();
   var $NM_fil_ant = array();

   /**
    * @access  public
    */
   function __construct()
   {
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
   function monta_busca()
   {
      global $bprocessa;
      include("../_lib/css/" . $this->Ini->str_schema_filter . "_filter.php");
      $this->Ini->Str_btn_filter = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_filter_css  = trim($str_button) . "/" . trim($str_button) . ".css";
      $this->Ini->str_google_fonts = (isset($str_google_fonts) && !empty($str_google_fonts))?$str_google_fonts:'';
      include($this->Ini->path_btn . $this->Ini->Str_btn_filter);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['path_libs_php'] = $this->Ini->path_lib_php;
      $this->Img_sep_filter = "/" . trim($str_toolbar_separator);
      $this->Block_img_col  = trim($str_block_col);
      $this->Block_img_exp  = trim($str_block_exp);
      $this->Bubble_tail    = trim($str_bubble_tail);
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_config_btn.php", "F", "nmButtonOutput"); 
      $this->NM_case_insensitive = false;
      $this->init();
      if ($this->NM_ajax_flag)
      {
          ob_start();
          $this->Arr_result = array();
          $this->processa_ajax();
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          if ($this->Db)
          {
              $this->Db->Close(); 
          }
          exit;
      }
      if (isset($bprocessa) && "pesq" == $bprocessa)
      {
         $this->processa_busca();
      }
      else
      {
         $this->monta_formulario();
      }
   }

   /**
    * @access  public
    */
   function monta_formulario()
   {
      $this->monta_html_ini();
      $this->monta_cabecalho();
      $this->monta_form();
      $this->monta_html_fim();
   }

   /**
    * @access  public
    */
   function init()
   {
      global $bprocessa;
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                  $this->Ini->Nm_lang['lang_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_mnth_june'],
                                  $this->Ini->Nm_lang['lang_mnth_july'],
                                  $this->Ini->Nm_lang['lang_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                  $this->Ini->Nm_lang['lang_days_sund'],
                                  $this->Ini->Nm_lang['lang_days_mond'],
                                  $this->Ini->Nm_lang['lang_days_tued'],
                                  $this->Ini->Nm_lang['lang_days_wend'],
                                  $this->Ini->Nm_lang['lang_days_thud'],
                                  $this->Ini->Nm_lang['lang_days_frid'],
                                  $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                  $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                  $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                  $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                  $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                  $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                  $this->Ini->Nm_lang['lang_shrt_days_satd']);
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_functions.php", "", "") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_api.php", "", "") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->nm_data = new nm_data("es");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $this->NM_path_filter = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/filters/";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['opcao'] = "igual";
   }

   function processa_ajax()
   {
      global $NM_filters, $NM_filters_del, $nmgp_save_name, $nmgp_save_option, $NM_fields_refresh, $NM_parms_refresh, $Campo_bi, $Opc_bi, $NM_operador, $nmgp_save_origem;
//-- ajax metodos ---
      if ($this->NM_ajax_opcao == "ajax_filter_save")
      {
          ob_end_clean();
          ob_end_clean();
          $this->salva_filtro($nmgp_save_origem);
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Cada_filter = $Tipo_filter[2];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" . grid_appointments_adm_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_appointments_adm_pack_protect_string($Tipo_filter[0]) . "\">.." . grid_appointments_adm_pack_protect_string($Cada_filter) .  "</option>\r\n";
          }
      }

      if ($this->NM_ajax_opcao == "ajax_filter_delete")
      {
          ob_end_clean();
          ob_end_clean();
          $this->apaga_filtro();
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Cada_filter = $Tipo_filter[2];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter  = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" .  grid_appointments_adm_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_appointments_adm_pack_protect_string($Tipo_filter[0]) . "\">.." . grid_appointments_adm_pack_protect_string($Cada_filter) .  "</option>\r\n";
          }
      }
      if ($this->NM_ajax_opcao == "ajax_filter_select")
      {
          ob_end_clean();
          ob_end_clean();
          $this->Arr_result = $this->recupera_filtro($NM_filters);
      }

   }

   /**
    * @access  public
    */
   function processa_busca()
   {
      $this->inicializa_vars();
      $this->trata_campos();
      if (!empty($this->Campos_Mens_erro)) 
      {
          echo "<script type=\"text/javascript\">"; 
          echo "parent.NM_exibe_erro('" . $this->Campos_Mens_erro . "')";
          echo "</script>"; 
      }
      else
      {
          $this->finaliza_resultado();
      }
   }

   /**
    * @access  public
    */
   function and_or()
   {
      $posWhere = strpos(strtolower($this->comando), "where");
      if (FALSE === $posWhere)
      {
         $this->comando     .= " where (";
         $this->comando_sum .= " and (";
         $this->comando_fim  = " ) ";
      }
      if ($this->comando_ini == "ini")
      {
          if (FALSE !== $posWhere)
          {
              $this->comando     .= " and ( ";
              $this->comando_sum .= " and ( ";
              $this->comando_fim  = " ) ";
          }
         $this->comando_ini  = "";
      }
      elseif ("or" == $this->NM_operador)
      {
         $this->comando        .= " or ";
         $this->comando_sum    .= " or ";
         $this->comando_filtro .= " or ";
      }
      else
      {
         $this->comando        .= " and ";
         $this->comando_sum    .= " and ";
         $this->comando_filtro .= " and ";
      }
   }

   /**
    * @access  public
    * @param  string  $nome  
    * @param  string  $condicao  
    * @param  mixed  $campo  
    * @param  mixed  $campo2  
    * @param  string  $nome_campo  
    * @param  string  $tp_campo  
    * @global  array  $nmgp_tab_label  
    */
   function monta_condicao($nome, $condicao, $campo, $campo2 = "", $nome_campo="", $tp_campo="", $tp_unaccent=false)
   {
      global $nmgp_tab_label;
      $condicao   = strtoupper($condicao);
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $Nm_numeric = array();
      $nm_ini_lower = "";
      $nm_fim_lower = "";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $Nm_numeric[] = "appointments_appointments_id";$Nm_numeric[] = "appointments_current_status_id";$Nm_numeric[] = "appointments_id_proyecto";$Nm_numeric[] = "appointments_id_usuario";$Nm_numeric[] = "appointments_id_actividad";$Nm_numeric[] = "appointments_intervalo";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              return;
          }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
         }
      }
      $Nm_datas[] = "appointments.appointment_start_date";$Nm_datas[] = "appointments_appointment_start_date";$Nm_datas[] = "appointments.appointment_start_time";$Nm_datas[] = "appointments_appointment_start_time";$Nm_datas[] = "appointments.appointment_end_date";$Nm_datas[] = "appointments_appointment_end_date";$Nm_datas[] = "appointments.appointment_end_time";$Nm_datas[] = "appointments_appointment_end_time";
      if (in_array($campo_join, $Nm_datas))
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['SC_sep_date1'];
          }
      }
      if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
      {
         return;
      }
      else
      {
         $tmp_pos = (is_string($campo)) ? strpos($campo, "##@@") : false;
         if ($tmp_pos === false)
         {
             $res_lookup = $campo;
         }
         else
         {
             $res_lookup = substr($campo, $tmp_pos + 4);
             $campo = substr($campo, 0, $tmp_pos);
             if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
             {
                 return;
             }
         }
         $tmp_pos = (is_string($this->cmp_formatado[$nome_campo])) ? strpos($this->cmp_formatado[$nome_campo], "##@@") : false;
         if ($tmp_pos !== false)
         {
             $this->cmp_formatado[$nome_campo] = substr($this->cmp_formatado[$nome_campo], $tmp_pos + 4);
         }
         $this->and_or();
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $campo2 = substr($this->Db->qstr($campo2), 1, -1);
         $nome_sum = "$nome";
         if ($tp_campo == "TIMESTAMP")
         {
             $tp_campo = "DATETIME";
         }
         switch ($condicao)
         {
            case "EQ":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower. " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "II":     // 
               $op_all = " like ";
               $this->comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
               $this->comando_sum    .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome_sum . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
               $this->comando_filtro .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
             case "QP";     // 
             case "NP";     // 
                $concat = " " . $this->NM_operador . " ";
                if ($condicao == "QP")
                {
                    $op_all    = " #sc_like_# ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_like'];
                }
                else
                {
                    $op_all    = " not #sc_like_# ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_not_like'];
                }
               $NM_cond    = "";
               $NM_cmd     = "";
               $NM_cmd_sum = "";
               if (substr($tp_campo, 0, 4) == "DATE" && $this->Date_part)
               {
                   if ($this->NM_data_qp['ano'] != "____")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_year'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['ano'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%Y', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%Y', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(year from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(year from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "year(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "year(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['mes'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mnth'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['mes'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%m', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%m', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(month from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(month from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "month(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "month(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['dia'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_days'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['dia'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%d', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%d', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(day from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(day from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "day(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "day(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                   }
               }
               if (strpos($tp_campo, "TIME") !== false && $this->Date_part)
               {
                   if ($this->NM_data_qp['hor'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_time'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['hor'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%H', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%H', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(hour from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(hour from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "hour(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "hour(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['min'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mint'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['min'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%M', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%M', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(minute from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(minute from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "minute(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "minute(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['seg'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_scnd'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['seg'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%S', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%S', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(second from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(second from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "second(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "second(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                   }
               }
               if ($this->Date_part)
               {
                   if (!empty($NM_cmd))
                   {
                       $NM_cmd     = " (" . $NM_cmd . ")";
                       $NM_cmd_sum = " (" . $NM_cmd_sum . ")";
                       $this->comando        .= $NM_cmd;
                       $this->comando_sum    .= $NM_cmd_sum;
                       $this->comando_filtro .= $NM_cmd;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . ": " . $NM_cond . "##*@@";
                       if (in_array($nome_campo, $this->Out_dyn_search))
                       {
                           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = $NM_cmd;
                           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                       }
                   }
               }
               else
               {
                   $op_all = str_replace("#sc_like_#", "like", $op_all);
                   $this->comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
                   $this->comando_sum    .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome_sum . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
                   $this->comando_filtro .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $lang_like . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
                   if (in_array($nome_campo, $this->Out_dyn_search))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . $campo . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'];
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
                   }
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = " $nome > " . $nm_aspas . $campo . $nm_aspas1;
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = " $nome < " . $nm_aspas . $campo . $nm_aspas1;
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
               }
            break;
            case "IN":     // 
               $nm_sc_valores = explode(",", $campo);
               $cond_str  = "";
               $nm_cond   = "";
               if (!empty($nm_sc_valores))
               {
                   foreach ($nm_sc_valores as $nm_sc_valor)
                   {
                      if (in_array($campo_join, $Nm_numeric) && substr_count($nm_sc_valor, ".") > 1)
                      {
                         $nm_sc_valor = str_replace(".", "", $nm_sc_valor);
                      }
                      if ("" != $cond_str)
                      {
                         $cond_str .= ",";
                         $nm_cond  .= " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
                      }
                      $cond_str .= $nm_ini_lower . $nm_aspas . $nm_sc_valor . $nm_aspas1 . $nm_fim_lower;
                      $nm_cond  .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                   }
               }
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_like'] . " " . $nm_cond . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_like'] . " " . $nm_cond;
               }
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = " $nome IS NULL ";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_null'];
               }
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = " $nome IS NOT NULL ";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_nnul'];
               }
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = " $nome = '' ";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_empty'];
               }
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
               if (in_array($nome_campo, $this->Out_dyn_search))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = " $nome <> '' ";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_nempty'];
               }
            break;
         }
      }
   }

   function nm_prep_date(&$val, $tp, $tsql, &$cond, $format_nd, $tp_nd)
   {
       $fill_dt = false;
       if ($tsql == "TIMESTAMP")
       {
           $tsql = "DATETIME";
       }
       $cond = strtoupper($cond);
       if ($cond == "NU" || $cond == "NN" || $cond == "EP" || $cond == "NE")
       {
           $val    = array();
           $val[0] = "";
           return;
       }
       if ($cond != "II" && $cond != "QP" && $cond != "NP")
       {
           $fill_dt = true;
       }
       if ($fill_dt)
       {
           $val[0]['dia'] = (!empty($val[0]['dia']) && strlen($val[0]['dia']) == 1) ? "0" . $val[0]['dia'] : $val[0]['dia'];
           $val[0]['mes'] = (!empty($val[0]['mes']) && strlen($val[0]['mes']) == 1) ? "0" . $val[0]['mes'] : $val[0]['mes'];
           if ($tp == "DH")
           {
               $val[0]['hor'] = (!empty($val[0]['hor']) && strlen($val[0]['hor']) == 1) ? "0" . $val[0]['hor'] : $val[0]['hor'];
               $val[0]['min'] = (!empty($val[0]['min']) && strlen($val[0]['min']) == 1) ? "0" . $val[0]['min'] : $val[0]['min'];
               $val[0]['seg'] = (!empty($val[0]['seg']) && strlen($val[0]['seg']) == 1) ? "0" . $val[0]['seg'] : $val[0]['seg'];
           }
           if ($cond == "BW")
           {
               $val[1]['dia'] = (!empty($val[1]['dia']) && strlen($val[1]['dia']) == 1) ? "0" . $val[1]['dia'] : $val[1]['dia'];
               $val[1]['mes'] = (!empty($val[1]['mes']) && strlen($val[1]['mes']) == 1) ? "0" . $val[1]['mes'] : $val[1]['mes'];
               if ($tp == "DH")
               {
                   $val[1]['hor'] = (!empty($val[1]['hor']) && strlen($val[1]['hor']) == 1) ? "0" . $val[1]['hor'] : $val[1]['hor'];
                   $val[1]['min'] = (!empty($val[1]['min']) && strlen($val[1]['min']) == 1) ? "0" . $val[1]['min'] : $val[1]['min'];
                   $val[1]['seg'] = (!empty($val[1]['seg']) && strlen($val[1]['seg']) == 1) ? "0" . $val[1]['seg'] : $val[1]['seg'];
               }
           }
       }
       if ($cond == "BW")
       {
           $this->NM_data_1 = array();
           $this->NM_data_1['ano'] = (isset($val[0]['ano']) && !empty($val[0]['ano'])) ? $val[0]['ano'] : "____";
           $this->NM_data_1['mes'] = (isset($val[0]['mes']) && !empty($val[0]['mes'])) ? $val[0]['mes'] : "__";
           $this->NM_data_1['dia'] = (isset($val[0]['dia']) && !empty($val[0]['dia'])) ? $val[0]['dia'] : "__";
           $this->NM_data_1['hor'] = (isset($val[0]['hor']) && !empty($val[0]['hor'])) ? $val[0]['hor'] : "__";
           $this->NM_data_1['min'] = (isset($val[0]['min']) && !empty($val[0]['min'])) ? $val[0]['min'] : "__";
           $this->NM_data_1['seg'] = (isset($val[0]['seg']) && !empty($val[0]['seg'])) ? $val[0]['seg'] : "__";
           $this->data_menor($this->NM_data_1);
           $this->NM_data_2 = array();
           $this->NM_data_2['ano'] = (isset($val[1]['ano']) && !empty($val[1]['ano'])) ? $val[1]['ano'] : "____";
           $this->NM_data_2['mes'] = (isset($val[1]['mes']) && !empty($val[1]['mes'])) ? $val[1]['mes'] : "__";
           $this->NM_data_2['dia'] = (isset($val[1]['dia']) && !empty($val[1]['dia'])) ? $val[1]['dia'] : "__";
           $this->NM_data_2['hor'] = (isset($val[1]['hor']) && !empty($val[1]['hor'])) ? $val[1]['hor'] : "__";
           $this->NM_data_2['min'] = (isset($val[1]['min']) && !empty($val[1]['min'])) ? $val[1]['min'] : "__";
           $this->NM_data_2['seg'] = (isset($val[1]['seg']) && !empty($val[1]['seg'])) ? $val[1]['seg'] : "__";
           $this->data_maior($this->NM_data_2);
           $val = array();
           if ($tp == "ND")
           {
               $out_dt1 = $format_nd;
               $out_dt1 = str_replace("yyyy", $this->NM_data_1['ano'], $out_dt1);
               $out_dt1 = str_replace("mm",   $this->NM_data_1['mes'], $out_dt1);
               $out_dt1 = str_replace("dd",   $this->NM_data_1['dia'], $out_dt1);
               $out_dt1 = str_replace("hh",   "", $out_dt1);
               $out_dt1 = str_replace("ii",   "", $out_dt1);
               $out_dt1 = str_replace("ss",   "", $out_dt1);
               $out_dt2 = $format_nd;
               $out_dt2 = str_replace("yyyy", $this->NM_data_2['ano'], $out_dt2);
               $out_dt2 = str_replace("mm",   $this->NM_data_2['mes'], $out_dt2);
               $out_dt2 = str_replace("dd",   $this->NM_data_2['dia'], $out_dt2);
               $out_dt2 = str_replace("hh",   "", $out_dt2);
               $out_dt2 = str_replace("ii",   "", $out_dt2);
               $out_dt2 = str_replace("ss",   "", $out_dt2);
               $val[0] = $out_dt1;
               $val[1] = $out_dt2;
               return;
           }
           if ($tsql == "TIME")
           {
               $val[0] = $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
               $val[1] = $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
           }
           elseif (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] = $this->NM_data_1['ano'] . "-" . $this->NM_data_1['mes'] . "-" . $this->NM_data_1['dia'];
               $val[1] = $this->NM_data_2['ano'] . "-" . $this->NM_data_2['mes'] . "-" . $this->NM_data_2['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " " . $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
                   $val[1] .= " " . $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
               }
           }
           return;
       }
       $this->NM_data_qp = array();
       $this->NM_data_qp['ano'] = (isset($val[0]['ano']) && $val[0]['ano'] != "") ? $val[0]['ano'] : "____";
       $this->NM_data_qp['mes'] = (isset($val[0]['mes']) && $val[0]['mes'] != "") ? $val[0]['mes'] : "__";
       $this->NM_data_qp['dia'] = (isset($val[0]['dia']) && $val[0]['dia'] != "") ? $val[0]['dia'] : "__";
       $this->NM_data_qp['hor'] = (isset($val[0]['hor']) && $val[0]['hor'] != "") ? $val[0]['hor'] : "__";
       $this->NM_data_qp['min'] = (isset($val[0]['min']) && $val[0]['min'] != "") ? $val[0]['min'] : "__";
       $this->NM_data_qp['seg'] = (isset($val[0]['seg']) && $val[0]['seg'] != "") ? $val[0]['seg'] : "__";
       if ($tp != "ND" && ($cond == "LE" || $cond == "LT" || $cond == "GE" || $cond == "GT"))
       {
           $count_fill = 0;
           foreach ($this->NM_data_qp as $x => $tx)
           {
               if (substr($tx, 0, 2) != "__")
               {
                   $count_fill++;
               }
           }
           if ($count_fill > 1)
           {
               if ($cond == "LE" || $cond == "GT")
               {
                   $this->data_maior($this->NM_data_qp);
               }
               else
               {
                   $this->data_menor($this->NM_data_qp);
               }
               if ($tsql == "TIME")
               {
                   $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
               }
               elseif (substr($tsql, 0, 4) == "DATE")
               {
                   $val[0] = $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
                   if (strpos($tsql, "TIME") !== false)
                   {
                       $val[0] .= " " . $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
                   }
               }
               return;
           }
       }
       foreach ($this->NM_data_qp as $x => $tx)
       {
           if (substr($tx, 0, 2) == "__" && ($x == "dia" || $x == "mes" || $x == "ano"))
           {
               if (substr($tsql, 0, 4) == "DATE")
               {
                   $this->Date_part = true;
                   break;
               }
           }
           if (substr($tx, 0, 2) == "__" && ($x == "hor" || $x == "min" || $x == "seg"))
           {
               if (strpos($tsql, "TIME") !== false && ($tp == "DH" || ($tp == "DT" && $cond != "LE" && $cond != "LT" && $cond != "GE" && $cond != "GT")))
               {
                   $this->Date_part = true;
                   break;
               }
           }
       }
       if ($this->Date_part)
       {
           $this->Ini_date_part = "";
           $this->End_date_part = "";
           $this->Ini_date_char = "";
           $this->End_date_char = "";
           if (isset($this->Ini->nm_bases_sqlite) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $this->Ini_date_part = "'";
               $this->End_date_part = "'";
           }
           if ($tp != "ND")
           {
               if ($cond == "EQ")
               {
                   $this->Operador_date_part = " = ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
               }
               elseif ($cond == "II")
               {
                   $this->Operador_date_part = " like ";
                   $this->Ini_date_part = "'";
                   $this->End_date_part = "%'";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_strt'];
               }
               elseif ($cond == "DF")
               {
                   $this->Operador_date_part = " <> ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
               }
               elseif ($cond == "GT")
               {
                   $this->Operador_date_part = " > ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['pesq_cond_maior'];
               }
               elseif ($cond == "GE")
               {
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_grtr_equl'];
                   $this->Operador_date_part = " >= ";
               }
               elseif ($cond == "LT")
               {
                   $this->Operador_date_part = " < ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less'];
               }
               elseif ($cond == "LE")
               {
                   $this->Operador_date_part = " <= ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less_equl'];
               }
               elseif ($cond == "NP")
               {
                   $this->Operador_date_part = " not like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
               }
               else
               {
                   $this->Operador_date_part = " like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
               }
           }
           if ($cond == "DF")
           {
               $cond = "NP";
           }
           if ($cond != "NP")
           {
               $cond = "QP";
           }
       }
       $val = array();
       if ($tp != "ND" && ($cond == "QP" || $cond == "NP"))
       {
           $val[0] = "";
           if (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " ";
               }
           }
           if (strpos($tsql, "TIME") !== false)
           {
               $val[0] .= $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           }
           return;
       }
       if ($cond == "II" || $cond == "DF" || $cond == "EQ" || $cond == "LT" || $cond == "GE")
       {
           $this->data_menor($this->NM_data_qp);
       }
       else
       {
           $this->data_maior($this->NM_data_qp);
       }
       if ($tsql == "TIME")
       {
           $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           return;
       }
       $format_sql = "";
       if (substr($tsql, 0, 4) == "DATE")
       {
           $format_sql .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
           if (strpos($tsql, "TIME") !== false)
           {
               $format_sql .= " ";
           }
       }
       if (strpos($tsql, "TIME") !== false)
       {
           $format_sql .=  $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
       }
       if ($tp != "ND")
       {
           $val[0] = $format_sql;
           return;
       }
       if ($tp == "ND")
       {
           $format_nd = str_replace("yyyy", $this->NM_data_qp['ano'], $format_nd);
           $format_nd = str_replace("mm",   $this->NM_data_qp['mes'], $format_nd);
           $format_nd = str_replace("dd",   $this->NM_data_qp['dia'], $format_nd);
           $format_nd = str_replace("hh",   $this->NM_data_qp['hor'], $format_nd);
           $format_nd = str_replace("ii",   $this->NM_data_qp['min'], $format_nd);
           $format_nd = str_replace("ss",   $this->NM_data_qp['seg'], $format_nd);
           $val[0] = $format_nd;
           return;
       }
   }
   function data_menor(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "0001" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "01" : $data_arr["mes"];
       $data_arr["dia"] = ("__" == $data_arr["dia"])   ? "01" : $data_arr["dia"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "00" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "00" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "00" : $data_arr["seg"];
   }

   function data_maior(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "9999" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "12" : $data_arr["mes"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "23" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "59" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "59" : $data_arr["seg"];
       if ("__" == $data_arr["dia"])
       {
           $data_arr["dia"] = "31";
           if ($data_arr["mes"] == "04" || $data_arr["mes"] == "06" || $data_arr["mes"] == "09" || $data_arr["mes"] == "11")
           {
               $data_arr["dia"] = 30;
           }
           elseif ($data_arr["mes"] == "02")
           { 
                if  ($data_arr["ano"] % 4 == 0)
                {
                     $data_arr["dia"] = 29;
                }
                else 
                {
                     $data_arr["dia"] = 28;
                }
           }
       }
   }

   /**
    * @access  public
    * @param  string  $nm_data_hora  
    */
   function limpa_dt_hor_pesq(&$nm_data_hora)
   {
      $nm_data_hora = str_replace("Y", "", $nm_data_hora); 
      $nm_data_hora = str_replace("M", "", $nm_data_hora); 
      $nm_data_hora = str_replace("D", "", $nm_data_hora); 
      $nm_data_hora = str_replace("H", "", $nm_data_hora); 
      $nm_data_hora = str_replace("I", "", $nm_data_hora); 
      $nm_data_hora = str_replace("S", "", $nm_data_hora); 
      $tmp_pos = strpos($nm_data_hora, "--");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("--", "-", $nm_data_hora); 
      }
      $tmp_pos = strpos($nm_data_hora, "::");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("::", ":", $nm_data_hora); 
      }
   }

   /**
    * @access  public
    */
   function retorna_pesq()
   {
      global $nm_apl_dependente;
   $NM_retorno = "./";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['interativ_refresh'] = true;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML>
<HEAD>
 <TITLE>Ingrese Período - Resumen General de  Horas De Actividades</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</HEAD>
<BODY id="grid_search" class="scGridPage">
<FORM style="display:none;" name="form_ok" method="POST" action="<?php echo $NM_retorno; ?>" target="_self">
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="pesq"> 
</FORM>
<SCRIPT type="text/javascript">
 document.form_ok.submit();
</SCRIPT>
</BODY>
</HTML>
<?php
}

   /**
    * @access  public
    */
   function monta_html_ini()
   {
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Ingrese Período - Resumen General de  Horas De Actividades</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <script type="text/javascript" src="../_lib/lib/js/jquery-3.6.0.min.js"></script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput2.js"></script>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Str_btn_filter_css ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_form.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>grid_appointments_adm/grid_appointments_adm_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
</HEAD>
<?php
$vertical_center = '';
?>
<BODY id="grid_search" class="scFilterPage" style="<?php echo $vertical_center ?>">
<?php echo $this->Ini->Ajax_result_set ?>
        <script type="text/javascript">
          var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
          var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
          var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
        </script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></script>
 <script type="text/javascript" src="grid_appointments_adm_ajax_search.js"></script>
 <script type="text/javascript" src="grid_appointments_adm_ajax.js"></script>
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
   var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax ?>';
   var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax ?>';
   var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax ?>';
   var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax ?>';
 </script>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<script type="text/javascript"> 
 var nm_quant_pack;
 // Adiciona um elemento
 //----------------------
 function nm_add_sel(sOrig, sDest, Saida, Order)
 {
  // Recupera objetos
  oOrig = document.F1.elements[sOrig];
  oDest = document.F1.elements[sDest];
  if (Order == 'S')
  {
     Order = '+';
  }
  // Varre itens da origem
  for (i = 0; i < oOrig.length; i++)
  {
   // Item na origem selecionado e valido
   if (oOrig.options[i].selected && !oOrig.options[i].disabled)
   {
    // Recupera valores da origem
    sText  = Order + oOrig.options[i].text;
    sValue = Order + oOrig.options[i].value;
    // Cria item no destino
    oDest.options[oDest.length] = new Option(sText, sValue);
    // Desabilita item na origem
    oOrig.options[i].style.color = "#A0A0A0";
    oOrig.options[i].disabled    = true;
    oOrig.options[i].selected    = false;
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (Saida == "R")
  {
      nm_refresh_form();
  }
  if (Saida == "S")
  {
      nm_submit_form();
  }
 }
 // Adiciona todos os elementos
 //-----------------------------
 function nm_add_all(sOrig, sDest, Saida, Order)
 {
  // Recupera objetos
  oOrig = document.F1.elements[sOrig];
  oDest = document.F1.elements[sDest];
  if (Order == 'S')
  {
     Order = '+';
  }
  // Varre itens da origem
  for (i = 0; i < oOrig.length; i++)
  {
   // Item na origem valido
   if (!oOrig.options[i].disabled)
   {
    // Recupera valores da origem
    sText  = Order + oOrig.options[i].text;
    sValue = Order + oOrig.options[i].value;
    // Cria item no destino
    oDest.options[oDest.length] = new Option(sText, sValue);
    // Desabilita item na origem
    oOrig.options[i].style.color = "#A0A0A0";
    oOrig.options[i].disabled    = true;
    oOrig.options[i].selected    = false;
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (Saida == "R")
  {
      nm_refresh_form();
  }
  if (Saida == "S")
  {
      nm_submit_form();
  }
 }
 // Remove um elemento
 //--------------------
 function nm_del_sel(sOrig, sDest, Saida, Order)
 {
  // Recupera objetos
  oOrig = document.F1.elements[sOrig];
  oDest = document.F1.elements[sDest];
  aSel  = new Array();
  atxt  = new Array();
  solt  = new Array();
  j     = 0;
  z     = 0;
  // Remove itens selecionados na origem
  for (i = oOrig.length - 1; i >= 0; i--)
  {
   // Item na origem selecionado
   if (oOrig.options[i].selected)
   {
   if (Order == 'S')
   {
      aSel[j] = oOrig.options[i].value.substring(1);
      atxt[j] = oOrig.options[i].text.substring(1);
   }
   else
   {
      aSel[j] = oOrig.options[i].value;
      atxt[j] = oOrig.options[i].text;
   }
    j++;
    oOrig.options[i] = null;
   }
  }
  // Habilita itens no destino
  for (i = 0; i < oDest.length; i++)
  {
   if (oDest.options[i].disabled && in_array(aSel, oDest.options[i].value))
   {
    oDest.options[i].disabled    = false;
    oDest.options[i].style.color = "";
    solt[z] = oDest.options[i].value;
    z++;
   }
  }
  for (i = 0; i < aSel.length; i++)
  {
   if (!in_array(solt, aSel[i]))
   {
    oDest.options[oDest.length] = new Option(atxt[i], aSel[i]);
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (Saida == "R")
  {
      nm_refresh_form();
  }
  if (Saida == "S")
  {
      nm_submit_form();
  }
 }
 // Remove todos os elementos
 //---------------------------
 function nm_del_all(sOrig, sDest, Saida, Order)
 {
  // Recupera objetos
  oOrig = document.F1.elements[sOrig];
  oDest = document.F1.elements[sDest];
  aSel  = new Array();
  atxt  = new Array();
  solt  = new Array();
  j     = 0;
  z     = 0;
  // Remove todos os itens na origem
  while (0 < oOrig.length)
  {
   i       = oOrig.length - 1;
   if (Order == 'S')
   {
      aSel[j] = oOrig.options[i].value.substring(1);
      atxt[j] = oOrig.options[i].text.substring(1);
   }
   else
   {
      aSel[j] = oOrig.options[i].value;
      atxt[j] = oOrig.options[i].text;
   }
   j++;
   oOrig.options[i] = null;
  }
  // Habilita itens no destino
  for (i = 0; i < oDest.length; i++)
  {
   if (oDest.options[i].disabled && in_array(aSel, oDest.options[i].value))
   {
    oDest.options[i].disabled    = false;
    oDest.options[i].style.color = "";
    solt[z] = oDest.options[i].value;
    z++;
   }
  }
  for (i = 0; i < aSel.length; i++)
  {
   if (!in_array(solt, aSel[i]))
   {
    oDest.options[oDest.length] = new Option(atxt[i], aSel[i]);
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (Saida == "R")
  {
      nm_refresh_form();
  }
  if (Saida == "S")
  {
      nm_submit_form();
  }
 }
 function nm_pack(sOrig, sDest)
 {
    obj_sel = document.F1.elements[sOrig];
    str_val = "";
    nm_quant_pack = 0;
    for (i = 0; i < obj_sel.length; i++)
    {
         if ("" != str_val)
         {
             str_val += "@?@";
             nm_quant_pack++;
         }
         str_val += obj_sel.options[i].value;
    }
    document.F1.elements[sDest].value = str_val;
 }
 // Teste se elemento pertence ao array
 //-------------------------------------
 function in_array(aArray, sElem)
 {
  for (iCount = 0; iCount < aArray.length; iCount++)
  {
   if (sElem == aArray[iCount])
   {
    return true;
   }
  }
  return false;
 }
 </script>
<?php
$Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo $Cod_Btn ?>&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
<script type="text/javascript" src="grid_appointments_adm_message.js"></script>
<script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
<script type="text/javascript">
$(function() {
<?php
if ((isset($this->nm_mens_alert) && count($this->nm_mens_alert)) || (isset($this->Ini->nm_mens_alert) && count($this->Ini->nm_mens_alert))) {
   if (isset($this->Ini->nm_mens_alert) && !empty($this->Ini->nm_mens_alert))
   {
       if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
       {
           $this->nm_mens_alert   = array_merge($this->Ini->nm_mens_alert, $this->nm_mens_alert);
           $this->nm_params_alert = array_merge($this->Ini->nm_params_alert, $this->nm_params_alert);
       }
       else
       {
           $this->nm_mens_alert   = $this->Ini->nm_mens_alert;
           $this->nm_params_alert = $this->Ini->nm_params_alert;
       }
   }
   if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
   {
       foreach ($this->nm_mens_alert as $i_alert => $mensagem)
       {
           $alertParams = array();
           if (isset($this->nm_params_alert[$i_alert]))
           {
               foreach ($this->nm_params_alert[$i_alert] as $paramName => $paramValue)
               {
                   if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('background' == $paramName)
                   {
                       $image_param = $paramValue;
                       preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $paramValue, $matches, PREG_PATTERN_ORDER);
                       if (isset($matches[3])) {
                           foreach ($matches[3] as $match) {
                               if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                                   $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                               }
                           }
                       }
                       $paramValue = $image_param;
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
               }
           }
           $jsonParams = json_encode($alertParams);
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['ajax_nav'])
           { 
               $this->Ini->Arr_result['AlertJS'][] = NM_charset_to_utf8($mensagem);
               $this->Ini->Arr_result['AlertJSParam'][] = $alertParams;
           } 
           else 
           { 
?>
       scJs_alert('<?php echo $mensagem ?>', <?php echo $jsonParams ?>);
<?php
           } 
       }
   }
}
?>
});
</script>
<?php
$displayError = ' style="display: none"';
if ('' != $this->Campos_Mens_erro) {
	$displayError = '';
}
?>
<div<?php echo $displayError; ?>>
	<table class="scErrorTable" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td class="scErrorTitle" align="left"><?php echo $this->Ini->Nm_lang['lang_errm_errt']; ?></td>
		</tr>
		<tr>
			<td class="scErrorMessage" align="center"><?php echo $this->Campos_Mens_erro; ?></td>
		</tr>
	</table>
</div>
 <SCRIPT type="text/javascript">

<?php
if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
{
    $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
    foreach ($Tb_err_js as $Lines)
    {
        if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        echo $Lines;
    }
}
 $Msg_Inval = "Inv�lido";
 if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
 {
    $Msg_Inval = sc_convert_encoding($Msg_Inval, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
var SC_crit_inv = "<?php echo $Msg_Inval ?>";
var nmdg_Form = "F1";

function scJQCalendarAdd() {
  $("#sc_appointments_appointment_start_date_jq").datepicker({
    beforeShow: function(input, inst) {
          var_dt_ini  = document.getElementById('SC_appointments_appointment_start_date_dia').value + '/';
          var_dt_ini += document.getElementById('SC_appointments_appointment_start_date_mes').value + '/';
          var_dt_ini += document.getElementById('SC_appointments_appointment_start_date_ano').value;
          document.getElementById('sc_appointments_appointment_start_date_jq').value = var_dt_ini;
    },
    onClose: function(dateText, inst) {
          aParts  = dateText.split("/");
          document.getElementById('SC_appointments_appointment_start_date_dia').value = aParts[0];
          document.getElementById('SC_appointments_appointment_start_date_mes').value = aParts[1];
          document.getElementById('SC_appointments_appointment_start_date_ano').value = aParts[2];
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    dayNamesMin: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_days_sem"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("ddmmyyyy", "/"); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->Ini->path_botoes . "/" . $this->arr_buttons['bcalendario']['image']; ?>",
    buttonImageOnly: true
  });

  $("#sc_appointments_appointment_start_date_jq2").datepicker({
    beforeShow: function(input, inst) {
          var_dt_ini  = document.getElementById('SC_appointments_appointment_start_date_input_2_dia').value + '/';
          var_dt_ini += document.getElementById('SC_appointments_appointment_start_date_input_2_mes').value + '/';
          var_dt_ini += document.getElementById('SC_appointments_appointment_start_date_input_2_ano').value;
          document.getElementById('sc_appointments_appointment_start_date_jq2').value = var_dt_ini;
    },
    onClose: function(dateText, inst) {
          aParts  = dateText.split("/");
          document.getElementById('SC_appointments_appointment_start_date_input_2_dia').value = aParts[0];
          document.getElementById('SC_appointments_appointment_start_date_input_2_mes').value = aParts[1];
          document.getElementById('SC_appointments_appointment_start_date_input_2_ano').value = aParts[2];
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    dayNamesMin: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_days_sem"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("ddmmyyyy", "/"); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->Ini->path_botoes . "/" . $this->arr_buttons['bcalendario']['image']; ?>",
    buttonImageOnly: true
  });

} // scJQCalendarAdd


 $(function() {

   SC_carga_evt_jquery();
   scLoadScInput('input:text.sc-js-input');
   scJQCalendarAdd('');
 });
 function nm_campos_between(nm_campo, nm_cond, nm_nome_obj)
 {
  if (nm_cond.value == "bw")
  {
   nm_campo.style.display = "";
  }
  else
  {
    if (nm_campo)
    {
      nm_campo.style.display = "none";
    }
  }
  if (document.getElementById('id_hide_' + nm_nome_obj))
  {
      if (nm_cond.value == "nu" || nm_cond.value == "nn" || nm_cond.value == "ep" || nm_cond.value == "ne")
      {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = 'none';
      }
      else
      {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = '';
      }
  }
 }
 function nm_save_form(pos)
 {
  if (pos == 'top' && document.F1.nmgp_save_name_top.value == '')
  {
      return;
  }
  if (pos == 'bot' && document.F1.nmgp_save_name_bot.value == '')
  {
      return;
  }
  if (pos == 'fields' && document.F1.nmgp_save_name_fields.value == '')
  {
      return;
  }
  var str_out = "";
  str_out += 'SC_appointments_id_proyecto_cond#NMF#' + search_get_sel_txt('SC_appointments_id_proyecto_cond') + '@NMF@';
  str_out += 'SC_appointments_id_proyecto#NMF#' + search_get_Dselelect('SC_appointments_id_proyecto_dest') + '@NMF@';
  str_out += 'SC_appointments_current_status_id_cond#NMF#' + search_get_sel_txt('SC_appointments_current_status_id_cond') + '@NMF@';
  str_out += 'SC_appointments_current_status_id#NMF#' + search_get_select('SC_appointments_current_status_id') + '@NMF@';
  str_out += 'SC_appointments_appointment_start_date_cond#NMF#' + search_get_sel_txt('SC_appointments_appointment_start_date_cond') + '@NMF@';
  str_out += 'SC_appointments_appointment_start_date_dia#NMF#' + search_get_sel_txt('SC_appointments_appointment_start_date_dia') + '@NMF@';
  str_out += 'SC_appointments_appointment_start_date_mes#NMF#' + search_get_sel_txt('SC_appointments_appointment_start_date_mes') + '@NMF@';
  str_out += 'SC_appointments_appointment_start_date_ano#NMF#' + search_get_sel_txt('SC_appointments_appointment_start_date_ano') + '@NMF@';
  str_out += 'SC_appointments_appointment_start_date_input_2_dia#NMF#' + search_get_sel_txt('SC_appointments_appointment_start_date_input_2_dia') + '@NMF@';
  str_out += 'SC_appointments_appointment_start_date_input_2_mes#NMF#' + search_get_sel_txt('SC_appointments_appointment_start_date_input_2_mes') + '@NMF@';
  str_out += 'SC_appointments_appointment_start_date_input_2_ano#NMF#' + search_get_sel_txt('SC_appointments_appointment_start_date_input_2_ano') + '@NMF@';
  str_out += 'SC_NM_operador#NMF#' + search_get_text('SC_NM_operador');
  str_out  = str_out.replace(/[+]/g, "__NM_PLUS__");
  str_out  = str_out.replace(/[&]/g, "__NM_AMP__");
  str_out  = str_out.replace(/[%]/g, "__NM_PRC__");
  var save_name = search_get_text('SC_nmgp_save_name_' + pos);
  var save_opt  = search_get_sel_txt('SC_nmgp_save_option_' + pos);
  ajax_save_filter(save_name, save_opt, str_out, pos);
 }
 function nm_submit_filter(obj_sel, pos)
 {
  index = obj_sel.selectedIndex;
  if (index == -1 || obj_sel.options[index].value == "") 
  {
      return false;
  }
  ajax_select_filter(obj_sel.options[index].value);
 }
 function nm_submit_filter_del(pos)
 {
  obj_sel = document.F1.elements['NM_filters_del_' + pos];
  index   = obj_sel.selectedIndex;
  if (index == -1 || obj_sel.options[index].value == "") 
  {
      return false;
  }
  parm = obj_sel.options[index].value;
  ajax_delete_filter(parm);
 }
 function search_get_select(obj_id)
 {
    var index = document.getElementById(obj_id).selectedIndex;
    if (index != -1) {
        return document.getElementById(obj_id).options[index].value;
    }
    else {
        return '';
    }
 }
 function search_get_selmult(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
        if (obj[iSelect].selected)
        {
            val += "#NMARR#" + obj[iSelect].value;
        }
    }
    return val;
 }
 function search_get_Dselelect(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
         val += "#NMARR#" + obj[iSelect].value;
    }
    return val;
 }
 function search_get_radio(obj_id)
 {
    var val  = "";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       for (iRadio = 0; iRadio < obj.length; iRadio++) {
           if (obj[iRadio].checked) {
               val = obj[iRadio].value;
           }
       }
    }
    return val;
 }
 function search_get_checkbox(obj_id)
 {
    var val  = "_NM_array_";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       if (!obj.length) {
           if (obj.checked) {
               val += "#NMARR#" + obj.value;
           }
       }
       else {
           for (iCheck = 0; iCheck < obj.length; iCheck++) {
               if (obj[iCheck].checked) {
                   val += "#NMARR#" + obj[iCheck].value;
               }
           }
       }
    }
    return val;
 }
 function search_get_text(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return (obj) ? obj.value : '';
 }
 function search_get_title(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return (obj) ? obj.title : '';
 }
 function search_get_sel_txt(obj_id)
 {
    var val = "";
    obj_part  = document.getElementById(obj_id);
    if (obj_part && obj_part.type.substr(0, 6) == 'select')
    {
        val = search_get_select(obj_id);
    }
    else
    {
        val = (obj_part) ? obj_part.value : '';
    }
    return val;
 }
 function search_get_html(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return obj.innerHTML;
 }
function nm_open_popup(parms)
{
    NovaJanela = window.open (parms, '', 'resizable, scrollbars');
}
 </SCRIPT>
<script type="text/javascript">
 $(function() {
 });
</script>
 <FORM name="F1" action="./" method="post" target="_self"> 
 <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
 <INPUT type="hidden" name="nmgp_opcao" value="busca"> 
 <div id="idJSSpecChar" style="display:none;"></div>
 <div id="id_div_process" style="display: none; position: absolute"><table class="scFilterTable"><tr><td class="scFilterLabelOdd"><?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</td></tr></table></div>
 <div id="id_fatal_error" class="scFilterFieldOdd" style="display:none; position: absolute"></div>
<table width="100%" style="border-collapse: collapse"><tr><td style="padding: 0px">
 <div id="NM_mostra_erro" style="display:none;">
<TABLE class="scErrorTable" cellspacing="0" cellpadding="0" align="center">
 <TR>
  <TD class="scErrorTitle" align="left"><?php echo $this->Ini->Nm_lang["gr_erro"]; ?></TD>
 </TR>
 <TR>
  <TD class="scErrorMessage" align="center"><span id="NM_erro_crit"></span></TD>
 </TR>
</TABLE> </div>
  </td></tr><tr><td style="padding: 0px">
<script type="text/javascript">
function NM_exibe_erro(mens)
{
 document.getElementById('NM_mostra_erro').style.display='';
 document.getElementById('NM_erro_crit').innerHTML = mens;
}
function NM_apaga_erro()
{
 document.getElementById('NM_mostra_erro').style.display='none';
 document.getElementById('NM_erro_crit').innerHTML = '';
}
</script>
<table style="padding: 0px; spacing: 0px; border-width: 0px;" align="center" valign="top" width="100%" cellpadding=0 cellspacing=0><tr><td style="padding: 0px">
<TABLE align="center" valign="top"  cellpadding=0 cellspacing=0>
<tr>
<td>
<div class="scFilterBorder">
  <div id="id_div_process_block" style="display: none; margin: 10px; whitespace: nowrap"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs'] ?>...</span></div>
<table cellspacing=0 cellpadding=0 width='100%'>
<?php
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
   /**
    * @access  public
    */
   function monta_cabecalho()
   {
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dashboard_info']['compact_mode'])
      {
          return;
      }
      $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
      $Lim   = strlen($Str_date);
      $Ult   = "";
      $Arr_D = array();
      for ($I = 0; $I < $Lim; $I++)
      {
          $Char = substr($Str_date, $I, 1);
          if ($Char != $Ult)
          {
              $Arr_D[] = $Char;
          }
          $Ult = $Char;
      }
      $Prim = true;
      $Str  = "";
      foreach ($Arr_D as $Cada_d)
      {
          $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $Str .= $Cada_d;
          $Prim = false;
      }
      $Str = str_replace("a", "Y", $Str);
      $Str = str_replace("y", "Y", $Str);
      $nm_data_fixa = date($Str); 
?>
 <TR align="center">
  <TD class="scFilterTableTd scGridPage">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFilterHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFilterHeaderFont" style="float: left; text-transform: uppercase;">Ingrese Período - Resumen General de  Horas De Actividades</div>
    <div class="scFilterHeaderFont" style="float: right;"></div>
    
</div>  </TD>
 </TR>
<?php
   }

   /**
    * @access  public
    * @global  string  $nm_url_saida  $this->Ini->Nm_lang['pesq_global_nm_url_saida']
    * @global  integer  $nm_apl_dependente  $this->Ini->Nm_lang['pesq_global_nm_apl_dependente']
    * @global  string  $nmgp_parms  
    * @global  string  $bprocessa  $this->Ini->Nm_lang['pesq_global_bprocessa']
    */
   function monta_form()
   {
      global 
             $appointments_id_proyecto_cond, $appointments_id_proyecto,
             $appointments_current_status_id_cond, $appointments_current_status_id,
             $appointments_appointment_start_date_cond, $appointments_appointment_start_date, $appointments_appointment_start_date_dia, $appointments_appointment_start_date_mes, $appointments_appointment_start_date_ano, $appointments_appointment_start_date_input_2_dia, $appointments_appointment_start_date_input_2_mes, $appointments_appointment_start_date_input_2_ano,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      if (isset($bprocessa) && ($bprocessa == "recarga" || $bprocessa == "save_form" || $bprocessa == "filter_delete"))
      {
          if (!empty($appointments_id_proyecto))
          {
              $appointments_id_proyecto = explode("@?@", $appointments_id_proyecto);
          }
          else
          {
              $appointments_id_proyecto = array();
          }
      }
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_appointments_adm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("grid_appointments_adm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      {
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $appointments_id_proyecto = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_id_proyecto']; 
          $appointments_id_proyecto_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_id_proyecto_cond']; 
          $appointments_current_status_id = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_current_status_id']; 
          $appointments_current_status_id_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_current_status_id_cond']; 
          $appointments_appointment_start_date_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_dia']; 
          $appointments_appointment_start_date_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_mes']; 
          $appointments_appointment_start_date_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_ano']; 
          $appointments_appointment_start_date_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_input_2_dia']; 
          $appointments_appointment_start_date_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_input_2_mes']; 
          $appointments_appointment_start_date_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_input_2_ano']; 
          $appointments_appointment_start_date_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['NM_operador']; 
      } 
      if (!isset($appointments_current_status_id_cond) || empty($appointments_current_status_id_cond))
      {
         $appointments_current_status_id_cond = "eq";
      }
      if (!isset($appointments_appointment_start_date_cond) || empty($appointments_appointment_start_date_cond))
      {
         $appointments_appointment_start_date_cond = "bw";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_appointments_id_proyecto = (in_array($appointments_id_proyecto_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_appointments_current_status_id = (in_array($appointments_current_status_id_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_appointments_appointment_start_date = (in_array($appointments_appointment_start_date_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_appointments_id_proyecto = ('bw' == $appointments_id_proyecto_cond) ? $display_aberto : $display_fechado;
      $str_display_appointments_current_status_id = ('bw' == $appointments_current_status_id_cond) ? $display_aberto : $display_fechado;
      $str_display_appointments_appointment_start_date = ('bw' == $appointments_appointment_start_date_cond) ? $display_aberto : $display_fechado;

      // appointments_id_proyecto
      if (is_array($appointments_id_proyecto) && !empty($appointments_id_proyecto))
      {
         $tmp_array = array();
         $appointments_id_proyecto_val_str = "";
         foreach ($appointments_id_proyecto as $tmp_val_cmp)
         {
            if ("" != $appointments_id_proyecto_val_str)
            {
               $appointments_id_proyecto_val_str .= ",";
            }
            $tmp_pos = (is_string($tmp_val_cmp)) ? strpos($tmp_val_cmp, "##@@") : false;
            if ($tmp_pos === false)
            {
                $tmp_array[] = $tmp_val_cmp;
            }
            else
            {
                $tmp_val_cmp = substr($tmp_val_cmp, 0, $tmp_pos);
                $tmp_array[] = $tmp_val_cmp;
            }
            $appointments_id_proyecto_val_str .= "'$tmp_val_cmp'";
         }
         $appointments_id_proyecto = $tmp_array;
      }
      else
      {
         $appointments_id_proyecto_val_str = "";
      }
      if (!isset($appointments_id_proyecto) || $appointments_id_proyecto == "")
      {
          $appointments_id_proyecto = array();
      }
      if (!isset($appointments_current_status_id) || $appointments_current_status_id == "")
      {
          $appointments_current_status_id = "";
      }
      if (isset($appointments_current_status_id) && !empty($appointments_current_status_id))
      {
         $tmp_pos = (is_string($appointments_current_status_id)) ? strpos($appointments_current_status_id, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $appointments_current_status_id = substr($appointments_current_status_id, 0, $tmp_pos);
         }
      }
      if (!isset($appointments_appointment_start_date) || $appointments_appointment_start_date == "")
      {
          $appointments_appointment_start_date = "";
      }
      if (isset($appointments_appointment_start_date) && !empty($appointments_appointment_start_date))
      {
         $tmp_pos = (is_string($appointments_appointment_start_date)) ? strpos($appointments_appointment_start_date, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $appointments_appointment_start_date = substr($appointments_appointment_start_date, 0, $tmp_pos);
         }
      }
?>
 <?php
     if ($_SESSION['scriptcase']['proc_mobile'])
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd" id='sc_filter_toolbar_top'>
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "sc_b_pesq_top", "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form();", "limpa_form();", "limpa_frm_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (!isset($this->nmgp_botoes['save']) || $this->nmgp_botoes['save'] == "on")
   {
       $this->NM_fil_ant = $this->gera_array_filtros();
?>
     <span id="idAjaxSelect_NM_filters_top">
       <SELECT class="scFilterToolbar_obj" id="sel_recup_filters_top" name="NM_filters_top" onChange="nm_submit_filter(this, 'top');" size="1">
           <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select      = "";
              $Cada_filter = $Tipo_filter[2];
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "           <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
           <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
       </SELECT>
     </span>
<?php
   }
?>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bedit_filter", "document.getElementById('Salvar_filters_top').style.display = ''; document.F1.nmgp_save_name_top.focus();", "document.getElementById('Salvar_filters_top').style.display = ''; document.F1.nmgp_save_name_top.focus();", "Ativa_save_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("grid_appointments_adm_help.txt"))
   {
      $Arq_WebHelp = file("grid_appointments_adm_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "sc_b_help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
<?php
   if ($nm_apl_dependente == 1 || (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['opc_psq'] && !$this->aba_iframe))
   {
       if ($nm_apl_dependente == 1) 
       { 
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       } 
       elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dashboard_info']['under_dashboard'])
       { }
       elseif (!$this->Ini->Embutida_iframe) 
       { 
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       } 
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['opc_psq'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['sc_modal'])
       {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.parent.tb_remove();", "self.parent.parent.tb_remove();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       }
       else
       {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "window.close();", "window.close();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       }
   }
?>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_top" style="display:none;z-index:9999;">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "document.getElementById('Salvar_filters_top').style.display = 'none';", "document.getElementById('Salvar_filters_top').style.display = 'none';", "Cancel_frm_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_top" name="nmgp_save_name_top" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar_appdiv", "nm_save_form('top');", "nm_save_form('top');", "Save_frm_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_top" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_top">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_top" name="NM_filters_del_top" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir_appdiv", "nm_submit_filter_del('top');", "nm_submit_filter_del('top');", "Exc_filtro_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
 ?>
 <TR align="center">
  <TD class="scFilterTableTd">
   <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
   <TR valign="top" >
  <TD width="100%" height="">
   <TABLE class="scFilterTable" id="hidden_bloco_0" valign="top" width="100%" style="height: 100%;">
   <tr>





      <TD id='SC_appointments_id_proyecto_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['appointments_id_proyecto'])) ? $this->New_label['appointments_id_proyecto'] : "Proyecto"; ?></TD>
      
      <INPUT type="hidden" id="SC_appointments_id_proyecto_cond" name="appointments_id_proyecto_cond" value="eq">
 
     <TD colspan=2 class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_appointments_id_proyecto" <?php echo $str_hide_appointments_id_proyecto?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['appointments_id_proyecto'])) ? $this->New_label['appointments_id_proyecto'] : "Proyecto";
 $nmgp_tab_label .= "appointments_id_proyecto?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
      $appointments_id_proyecto_look = (is_string($appointments_id_proyecto) ? substr($this->Db->qstr($appointments_id_proyecto), 1, -1) : $appointments_id_proyecto); 
      $nmgp_def_dados = "" ; 
      $nm_comando = "SELECT id, nombre_proyecto  FROM proyectos  ORDER BY nombre_proyecto"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['psq_check_ret']['appointments_id_proyecto'] = array();
         while (!$rs->EOF) 
         { 
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['psq_check_ret']['appointments_id_proyecto'][] = trim($rs->fields[0]);
            $nmgp_def_dados .= trim($rs->fields[1]) . "?#?" ; 
            $nmgp_def_dados .= trim($rs->fields[0]) . "?#?N?@?" ; 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
?>
   <table style="padding: 0px; spacing: 0px; border-width: 0px;"><tr><td>
    <SELECT class="scFilterObjectOdd" id="SC_appointments_id_proyecto_orig" name="appointments_id_proyecto_orig" size=7 multiple onDblClick="nm_add_sel('appointments_id_proyecto_orig', 'appointments_id_proyecto_dest', 'N' , '')">
<?php
      $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
      $nm_opcoes  = explode("?@?", $nm_opcoesx);
      foreach ($nm_opcoes as $nm_opcao)
      {
         if (!empty($nm_opcao))
         {
            $temp_bug_list = explode("?#?", $nm_opcao);
            list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
            if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
            if (is_array($appointments_id_proyecto) && !empty($appointments_id_proyecto))
            {
               $appointments_id_proyecto_sel = "";
               foreach ($appointments_id_proyecto as $Dados)
               {
                   if ($Dados === $nm_opc_cod)
                   {
                       $appointments_id_proyecto_sel = " disabled =\"disabled\" style=\"color: #A0A0A0\"";
                       break;
                   }
               }
            }
            else
            {
               $appointments_id_proyecto_sel = ("S" == $nm_opc_sel) ? "selected" : "";
            }
            $nm_sc_valor = $nm_opc_val;
            $nm_opc_val = $nm_sc_valor;
?>
       <OPTION value="<?php echo NM_encode_input($nm_opc_cod . $delimitador . $nm_opc_val); ?>" <?php echo $appointments_id_proyecto_sel; ?>><?php echo $nm_opc_val; ?></OPTION>
<?php
         }
      }
?>
      </SELECT>
   </span>
   </td>
   <td align="center">
<?php
      echo "   <div class='scBtnPassField'>\r\n";
      echo nmButtonOutput($this->arr_buttons, "bpassfld_rightall", "nm_add_all('appointments_id_proyecto_orig', 'appointments_id_proyecto_dest', 'N', '');", "nm_add_all('appointments_id_proyecto_orig', 'appointments_id_proyecto_dest', 'N', '');", "Bbpassfld_rightall", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      echo "   </div>\r\n";
      echo "   <div class='scBtnPassField'>\r\n";
      echo nmButtonOutput($this->arr_buttons, "bpassfld_right", "nm_add_sel('appointments_id_proyecto_orig', 'appointments_id_proyecto_dest', 'N', '');", "nm_add_sel('appointments_id_proyecto_orig', 'appointments_id_proyecto_dest', 'N', '');", "Bbpassfld_righ", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      echo "   </div>\r\n";
      echo "   <div class='scBtnPassField'>\r\n";
      echo nmButtonOutput($this->arr_buttons, "bpassfld_left", "nm_del_sel('appointments_id_proyecto_dest', 'appointments_id_proyecto_orig', 'N', '');", "nm_del_sel('appointments_id_proyecto_dest', 'appointments_id_proyecto_orig', 'N', '');", "Bbpassfld_left", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      echo "   </div>\r\n";
      echo "   <div class='scBtnPassField'>\r\n";
      echo nmButtonOutput($this->arr_buttons, "bpassfld_leftall", "nm_del_all('appointments_id_proyecto_dest', 'appointments_id_proyecto_orig', 'N', '');", "nm_del_all('appointments_id_proyecto_dest', 'appointments_id_proyecto_orig', 'N', '');", "Bbpassfld_leftall", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      echo "   </div>\r\n";
?>
   </td>
   <td>
    <SELECT class="scFilterObjectOdd" id="SC_appointments_id_proyecto_dest" name="appointments_id_proyecto_dest" size=7 multiple  onDblClick="nm_del_sel('appointments_id_proyecto_dest', 'appointments_id_proyecto_orig', 'N' , '')">"
<?php
      $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
      $nm_opcoes  = explode("?@?", $nm_opcoesx);
      foreach ($nm_opcoes as $nm_opcao)
      {
         if (!empty($nm_opcao))
         {
            $temp_bug_list = explode("?#?", $nm_opcao);
            list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
            if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
            if (is_array($appointments_id_proyecto) && !empty($appointments_id_proyecto))
            {
               foreach ($appointments_id_proyecto as $Dados)
               {
                   if ($Dados === $nm_opc_cod)
                   {
?>
       <OPTION value="<?php echo $nm_opc_cod . $delimitador . $nm_opc_val; ?>" ><?php echo $nm_opc_val; ?></OPTION>
<?php
                   }
               }
            }
         }
      }
?>
    </select>
    <input type="hidden" id="SC_appointments_id_proyecto" name="appointments_id_proyecto" value="">
   </td></tr></table>
   <script type="text/javascript">document.F1.appointments_id_proyecto_dest.selectedIndex = -1;</script>
<?php
?>
        
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD id='SC_appointments_current_status_id_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['appointments_current_status_id'])) ? $this->New_label['appointments_current_status_id'] : "Estado"; ?></TD>
      
      <INPUT type="hidden" id="SC_appointments_current_status_id_cond" name="appointments_current_status_id_cond" value="eq">
 
     <TD colspan=2 class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_appointments_current_status_id" <?php echo $str_hide_appointments_current_status_id?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['appointments_current_status_id'])) ? $this->New_label['appointments_current_status_id'] : "Estado";
 $nmgp_tab_label .= "appointments_current_status_id?#?" . $SC_Label . "?@?";
 $date_sep_bw = " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
      $appointments_current_status_id_look = (is_string($appointments_current_status_id) ? substr($this->Db->qstr($appointments_current_status_id), 1, -1) : $appointments_current_status_id); 
      $nmgp_def_dados = "" ; 
      $nm_comando = "SELECT appointment_status_id, appointment_status_descr  FROM appointment_status  ORDER BY appointment_status_descr"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['psq_check_ret']['appointments_current_status_id'] = array();
         while (!$rs->EOF) 
         { 
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['psq_check_ret']['appointments_current_status_id'][] = trim($rs->fields[0]);
            $nmgp_def_dados .= trim($rs->fields[1]) . "?#?" ; 
            $nmgp_def_dados .= trim($rs->fields[0]) . "?#?N?@?" ; 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
?>
   <span id="idAjaxSelect_appointments_current_status_id">
      <SELECT class="scFilterObjectEven" id="SC_appointments_current_status_id" name="appointments_current_status_id"  size="1">
       <OPTION value=""></OPTION>
<?php
      $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
      $nm_opcoes  = explode("?@?", $nm_opcoesx);
      foreach ($nm_opcoes as $nm_opcao)
      {
         if (!empty($nm_opcao))
         {
            $temp_bug_list = explode("?#?", $nm_opcao);
            list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
            if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
            if ("" != $appointments_current_status_id)
            {
                    $appointments_current_status_id_sel = ($nm_opc_cod === $appointments_current_status_id) ? "selected" : "";
            }
            else
            {
               $appointments_current_status_id_sel = ("S" == $nm_opc_sel) ? "selected" : "";
            }
            $nm_sc_valor = $nm_opc_val;
            $nm_opc_val = $nm_sc_valor;
?>
       <OPTION value="<?php echo NM_encode_input($nm_opc_cod . $delimitador . $nm_opc_val); ?>" <?php echo $appointments_current_status_id_sel; ?>><?php echo $nm_opc_val; ?></OPTION>
<?php
         }
      }
?>
      </SELECT>
   </span>
<?php
?>
        
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD id='SC_appointments_appointment_start_date_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['appointments_appointment_start_date'])) ? $this->New_label['appointments_appointment_start_date'] : "Fecha Actividad"; ?></TD>
      
      <INPUT type="hidden" id="SC_appointments_appointment_start_date_cond" name="appointments_appointment_start_date_cond" value="bw">
 
     <TD colspan=2 class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_appointments_appointment_start_date" <?php echo $str_hide_appointments_appointment_start_date?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['appointments_appointment_start_date'])) ? $this->New_label['appointments_appointment_start_date'] : "Fecha Actividad";
 $nmgp_tab_label .= "appointments_appointment_start_date?#?" . $SC_Label . "?@?";
 $date_sep_bw = " hasta ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
  $Form_base = "ddmmyyyy";
  $date_format_show = "";
  $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
  $Lim   = strlen($Str_date);
  $Str   = "";
  $Ult   = "";
  $Arr_D = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_date, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_D[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_D[] = $Str;
  $Prim = true;
  foreach ($Arr_D as $Cada_d)
  {
      if (strpos($Form_base, $Cada_d) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $date_format_show .= $Cada_d;
          $Prim = false;
      }
  }
  $Arr_format = $Arr_D;
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_appointments_appointment_start_date_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_appointments_appointment_start_date_dia" name="appointments_appointment_start_date_dia" value="<?php echo NM_encode_input($appointments_appointment_start_date_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_appointments_appointment_start_date_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_appointments_appointment_start_date_mes" name="appointments_appointment_start_date_mes" value="<?php echo NM_encode_input($appointments_appointment_start_date_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_appointments_appointment_start_date_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_appointments_appointment_start_date_ano" name="appointments_appointment_start_date_ano" value="<?php echo NM_encode_input($appointments_appointment_start_date_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <INPUT type="hidden" id="sc_appointments_appointment_start_date_jq">
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_vis_appointments_appointment_start_date"  <?php echo $str_display_appointments_appointment_start_date; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?>&nbsp;
         
         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_appointments_appointment_start_date_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_appointments_appointment_start_date_input_2_dia" name="appointments_appointment_start_date_input_2_dia" value="<?php echo NM_encode_input($appointments_appointment_start_date_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_appointments_appointment_start_date_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_appointments_appointment_start_date_input_2_mes" name="appointments_appointment_start_date_input_2_mes" value="<?php echo NM_encode_input($appointments_appointment_start_date_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_appointments_appointment_start_date_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_appointments_appointment_start_date_input_2_ano" name="appointments_appointment_start_date_input_2_ano" value="<?php echo NM_encode_input($appointments_appointment_start_date_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <INPUT type="hidden" id="sc_appointments_appointment_start_date_jq2">
</span>

<?php
  }
?>

<?php

}

?>
        </SPAN>
        <SPAN id="id_css_appointments_appointment_start_date" class="scFilterFieldFontOdd">
 <?php echo $date_format_show ?>         </SPAN>
         
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr>
   </TABLE>
  </TD>
 </TR>
 </TABLE>
 </TD>
 </TR>
 <TR>
  <TD class="scFilterTableTd" align="center">
<INPUT type="hidden" id="SC_NM_operador" name="NM_operador" value="and">  </TD>
 </TR>
   <INPUT type="hidden" name="nmgp_tab_label" value="<?php echo NM_encode_input($nmgp_tab_label); ?>"> 
   <INPUT type="hidden" name="bprocessa" value="pesq"> 
 <?php
     if (!$_SESSION['scriptcase']['proc_mobile'])
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd" id='sc_filter_toolbar_bot'>
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
    </td>
    <td class="scFilterToolbarPadding" align="center" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "sc_b_pesq_bot", "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form();", "limpa_form();", "limpa_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("grid_appointments_adm_help.txt"))
   {
      $Arq_WebHelp = file("grid_appointments_adm_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "sc_b_help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
<?php
   if ($nm_apl_dependente == 1 || (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['opc_psq'] && !$this->aba_iframe))
   {
       if ($nm_apl_dependente == 1) 
       { 
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       } 
       elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dashboard_info']['under_dashboard'])
       { }
       elseif (!$this->Ini->Embutida_iframe) 
       { 
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       } 
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['opc_psq'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['sc_modal'])
       {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.parent.tb_remove();", "self.parent.parent.tb_remove();", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       }
       else
       {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "window.close();", "window.close();", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       }
   }
?>
    </td>
    <td class="scFilterToolbarPadding" align="right" width="33%" nowrap>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_bot" style="display:none;z-index:9999;">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "Cancel_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_bot" name="nmgp_save_name_bot" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar_appdiv", "nm_save_form('bot');", "nm_save_form('bot');", "Save_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_bot" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_bot">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_bot" name="NM_filters_del_bot" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir_appdiv", "nm_submit_filter_del('bot');", "nm_submit_filter_del('bot');", "Exc_filtro_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
 ?>
<?php
   }

   function monta_html_fim()
   {
       global $bprocessa, $nm_url_saida, $Script_BI;
?>

</TABLE></div></td></tr></table><tr><td>
<table align="center" valign="top" width="100%"><tr><td>
<?php
if (isset($bprocessa) && "recarga" == $bprocessa)
{
?>
<iframe id="nmsc_iframe_grid_appointments_adm" frameborder="0" marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px" align="center" height="1500px" name="nm_iframe_grid_appointments_adm" scrolling="auto" src="index.php?nmgp_opcao=pesq&script_case_init=<?php echo NM_encode_input($this->Ini->sc_page) ?>" width="100%"></iframe>
<?php
}
else
{
?>
<iframe id="nmsc_iframe_grid_appointments_adm" frameborder="0" marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px" align="center" height="1500px" name="nm_iframe_grid_appointments_adm" scrolling="auto" src="index.php?nmgp_opcao=pesq&script_case_init=<?php echo NM_encode_input($this->Ini->sc_page) ?>" width="100%"></iframe>
<?php
}
?>
<iframe id="nmsc_iframe_grid_appointments_adm_pesq"  name="nm_iframe_grid_appointments_adm_pesq" style= "display: none;" frameborder="0" marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px" src=""></iframe>
</td></tr></table></td></tr>
</TABLE>
   <INPUT type="hidden" name="form_condicao" value="3">
</FORM> 
   <FORM style="display:none;" name="form_cancel"  method="POST" action="<?php echo $nm_url_saida; ?>" target="_self"> 
   <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<?php
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['orig_pesq']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['orig_pesq'] == "grid")
   {
       $Ret_cancel_pesq = "volta_grid";
   }
   else
   {
       $Ret_cancel_pesq = "resumo";
   }
?>
   <INPUT type="hidden" name="nmgp_opcao" value="<?php echo $Ret_cancel_pesq; ?>"> 
   </FORM> 
<SCRIPT type="text/javascript">
<?php
   if (empty($this->NM_fil_ant))
   {
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
?>
      document.getElementById('Apaga_filters_top').style.display = 'none';
      document.getElementById('sel_recup_filters_top').style.display = 'none';
<?php
       }
       else
       {
?>
<?php
       }
   }
?>
 function nm_move()
 {
     document.form_cancel.target = "_self"; 
     document.form_cancel.action = "./"; 
     document.form_cancel.submit(); 
 }
 function nm_submit_form()
 {
   nm_pack('appointments_id_proyecto_dest', 'appointments_id_proyecto');
    document.F1.target = "nm_iframe_grid_appointments_adm";
    document.F1.submit();
 }
 function nm_move()
 {
     document.getElementById('nmsc_iframe_grid_appointments_adm').contentWindow.nm_move('igual');
 }
 function limpa_form()
 {
   document.F1.reset();
   NM_apaga_erro();
   if (document.F1.NM_filters)
   {
       document.F1.NM_filters.selectedIndex = -1;
   }
   nm_campos_between(document.getElementById('id_vis_appointments_id_proyecto'), document.F1.appointments_id_proyecto_cond, 'appointments_id_proyecto');
   nm_del_all('appointments_id_proyecto_dest', 'appointments_id_proyecto_orig', 'N', '');
   document.F1.appointments_current_status_id_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_appointments_current_status_id'), document.F1.appointments_current_status_id_cond, 'appointments_current_status_id');
   document.F1.appointments_current_status_id.value = "";
   document.F1.appointments_appointment_start_date_cond.value = 'bw';
   nm_campos_between(document.getElementById('id_vis_appointments_appointment_start_date'), document.F1.appointments_appointment_start_date_cond, 'appointments_appointment_start_date');
   document.F1.appointments_appointment_start_date_dia.value = "";
   document.F1.appointments_appointment_start_date_mes.value = "";
   document.F1.appointments_appointment_start_date_ano.value = "";
   document.F1.appointments_appointment_start_date_input_2_dia.value = "";
   document.F1.appointments_appointment_start_date_input_2_mes.value = "";
   document.F1.appointments_appointment_start_date_input_2_ano.value = "";
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_appointments_appointment_start_date_dia').bind('change', function() {sc_grid_appointments_adm_valida_dia(this)});
    $('#SC_appointments_appointment_start_date_input_2_dia').bind('change', function() {sc_grid_appointments_adm_valida_dia(this)});
    $('#SC_appointments_appointment_start_date_input_2_mes').bind('change', function() {sc_grid_appointments_adm_valida_mes(this)});
    $('#SC_appointments_appointment_start_date_mes').bind('change', function() {sc_grid_appointments_adm_valida_mes(this)});
 }
 function sc_grid_appointments_adm_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_appointments_adm_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
</SCRIPT>
</BODY>
</HTML>
<?php
   }

   function gera_array_filtros()
   {
       $this->NM_fil_ant = array();
       $NM_patch   = "carga_horas/grid_appointments_adm";
       if (is_dir($this->NM_path_filter . $NM_patch))
       {
           $NM_dir = @opendir($this->NM_path_filter . $NM_patch);
           while (FALSE !== ($NM_arq = @readdir($NM_dir)))
           {
             if (@is_file($this->NM_path_filter . $NM_patch . "/" . $NM_arq))
             {
                 $Sc_v6 = false;
                 $NMcmp_filter = file($this->NM_path_filter . $NM_patch . "/" . $NM_arq);
                 $NMcmp_filter = explode("@NMF@", $NMcmp_filter[0]);
                 if (substr($NMcmp_filter[0], 0, 6) == "SC_V6_" || substr($NMcmp_filter[0], 0, 6) == "SC_V8_")
                 {
                     $Name_filter = substr($NMcmp_filter[0], 6);
                     if (!empty($Name_filter))
                     {
                         $this->NM_fil_ant[$NM_arq][0] = $NM_patch . "/" . $NM_arq;
                         $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                         $Sc_v6 = true;
                     }
                 }
                 if (!$Sc_v6)
                 {
                     $this->NM_fil_ant[$NM_arq][0] = $NM_arq;
                     $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                 }
                 $this->NM_fil_ant[$NM_arq][2] = $Name_filter;
             }
           }
       }
       return $this->NM_fil_ant;
   }
   /**
    * @access  public
    * @param  string  $NM_operador  $this->Ini->Nm_lang['pesq_global_NM_operador']
    * @param  array  $nmgp_tab_label  
    */
   function inicializa_vars()
   {
      global $NM_operador, $nmgp_tab_label;

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/");  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1);  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz;
      $this->Campos_Mens_erro = ""; 
      $this->nm_data = new nm_data("es");
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] = "";
      if (!empty($nmgp_tab_label))
      {
         $nm_tab_campos = explode("?@?", $nmgp_tab_label);
         $nmgp_tab_label = array();
         foreach ($nm_tab_campos as $cada_campo)
         {
             $parte_campo = explode("?#?", $cada_campo);
             $nmgp_tab_label[$parte_campo[0]] = $parte_campo[1];
         }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_orig'] = "";
      }
      $this->comando        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_orig'];
      $this->comando_sum    = "";
      $this->comando_filtro = "";
      $this->comando_ini    = "ini";
      $this->comando_fim    = "";
      $this->NM_operador    = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
   }

   function salva_filtro($nmgp_save_origem)
   {
      global $NM_filters_save, $nmgp_save_name, $nmgp_save_option, $script_case_init;
          $NM_filters_save = str_replace("__NM_PLUS__", "+", $NM_filters_save);
          $nmgp_save_name = trim($nmgp_save_name);
          $NM_str_filter  = "SC_V8_" . $nmgp_save_name . "@NMF@";
          if (!NM_is_utf8($nmgp_save_name))
          {
              $nmgp_save_name = sc_convert_encoding($nmgp_save_name, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $NM_str_filter  .= $NM_filters_save;
          $NM_patch = $this->NM_path_filter;
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "carga_horas/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "grid_appointments_adm/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $Parms_usr  = "";
          $NM_filter = fopen ($NM_patch . md5($nmgp_save_name), 'w');
          if (!NM_is_utf8($NM_str_filter))
          {
              $NM_str_filter = sc_convert_encoding($NM_str_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          fwrite($NM_filter, $NM_str_filter);
          fclose($NM_filter);
   }
   function recupera_filtro($NM_filters)
   {
      global $NM_operador, $script_case_init;
      $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      if (!is_file($NM_patch))
      {
          $NM_filters = sc_convert_encoding($NM_filters, "UTF-8", $_SESSION['scriptcase']['charset']);
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      }
      $return_fields = array();
      $tp_fields     = array();
      $tb_fields_esp = array();
      $old_bi_opcs   = array("TP","HJ","OT","U7","SP","US","MM","UM","AM","PS","SS","P3","PM","P7","CY","LY","YY","M6","M3","M18","M24");
      $tp_fields['SC_appointments_id_proyecto_cond'] = 'cond';
      $tp_fields['SC_appointments_id_proyecto'] = 'dselect';
      $tp_fields['SC_appointments_current_status_id_cond'] = 'cond';
      $tp_fields['SC_appointments_current_status_id'] = 'select';
      $tp_fields['SC_appointments_appointment_start_date_cond'] = 'cond';
      $tp_fields['SC_appointments_appointment_start_date_dia'] = 'text';
      $tp_fields['SC_appointments_appointment_start_date_mes'] = 'text';
      $tp_fields['SC_appointments_appointment_start_date_ano'] = 'text';
      $tp_fields['SC_appointments_appointment_start_date_input_2_dia'] = 'text';
      $tp_fields['SC_appointments_appointment_start_date_input_2_mes'] = 'text';
      $tp_fields['SC_appointments_appointment_start_date_input_2_ano'] = 'text';
      $tp_fields['SC_NM_operador'] = 'text';
      if (is_file($NM_patch))
      {
          $SC_V8    = false;
          $NMfilter = file($NM_patch);
          $NMcmp_filter = explode("@NMF@", $NMfilter[0]);
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              $SC_V8 = true;
          }
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V6" || substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              unset($NMcmp_filter[0]);
          }
          foreach ($NMcmp_filter as $Cada_cmp)
          {
              $Cada_cmp = explode("#NMF#", $Cada_cmp);
              if (isset($tb_fields_esp[$Cada_cmp[0]]))
              {
                  $Cada_cmp[0] = $tb_fields_esp[$Cada_cmp[0]];
              }
              if (!$SC_V8 && substr($Cada_cmp[0], 0, 11) != "div_ac_lab_" && substr($Cada_cmp[0], 0, 6) != "id_ac_")
              {
                  $Cada_cmp[0] = "SC_" . $Cada_cmp[0];
              }
              if (!isset($tp_fields[$Cada_cmp[0]]))
              {
                  continue;
              }
              $list   = array();
              $list_a = array();
              if (substr($Cada_cmp[1], 0, 10) == "_NM_array_")
              {
                  if (substr($Cada_cmp[1], 0, 17) == "_NM_array_#NMARR#")
                  {
                      $Sc_temp = explode("#NMARR#", substr($Cada_cmp[1], 17));
                      foreach ($Sc_temp as $Cada_val)
                      {
                          $list[]   = $Cada_val;
                          $tmp_pos  = (is_string($Cada_val)) ? strpos($Cada_val, "##@@") : false;
                          $val_a    = ($tmp_pos !== false) ?  substr($Cada_val, $tmp_pos + 4) : $Cada_val;
                          $list_a[] = array('opt' => $Cada_val, 'value' => $val_a);
                      }
                  }
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'dselect')
              {
                  $list[]   = $Cada_cmp[1];
                  $tmp_pos  = (is_string($Cada_cmp[1])) ? strpos($Cada_cmp[1], "##@@") : false;
                  $val_a    = ($tmp_pos !== false) ?  substr($Cada_cmp[1], $tmp_pos + 4) : $Cada_cmp[1];
                  $list_a[] = array('opt' => $Cada_cmp[1], 'value' => $val_a);
              }
              else
              {
                  $list[0] = $Cada_cmp[1];
              }
              if ($tp_fields[$Cada_cmp[0]] == 'select2_aut')
              {
                  if (!isset($list[0]))
                  {
                      $list[0] = "";
                  }
                  $return_fields['set_select2_aut'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'dselect')
              {
                  $return_fields['set_dselect'][] = array('field' => $Cada_cmp[0], 'value' => $list_a);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'fil_order')
              {
                  $return_fields['set_fil_order'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'selmult')
              {
                  if (count($list) == 1 && $list[0] == "")
                  {
                      continue;
                  }
                  $return_fields['set_selmult'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'ddcheckbox')
              {
                  $return_fields['set_ddcheckbox'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'checkbox')
              {
                  $return_fields['set_checkbox'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              else
              {
                  if (!isset($list[0]))
                  {
                      $list[0] = "";
                  }
                  if ($tp_fields[$Cada_cmp[0]] == 'html')
                  {
                      $return_fields['set_html'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  elseif ($tp_fields[$Cada_cmp[0]] == 'radio')
                  {
                      $return_fields['set_radio'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  elseif ($tp_fields[$Cada_cmp[0]] == 'cond' && in_array($list[0], $old_bi_opcs))
                  {
                      $Cada_cmp[1] = "bi_" . $list[0];
                      $return_fields['set_val'][] = array('field' => $Cada_cmp[0], 'value' => $Cada_cmp[1]);
                  }
                  else
                  {
                      $return_fields['set_val'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
              }
          }
          $this->NM_curr_fil = $NM_filters;
      }
      return $return_fields;
   }
   function apaga_filtro()
   {
      global $NM_filters_del;
      if (isset($NM_filters_del) && !empty($NM_filters_del))
      { 
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          if (!is_file($NM_patch))
          {
              $NM_filters_del = sc_convert_encoding($NM_filters_del, "UTF-8", $_SESSION['scriptcase']['charset']);
              $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          }
          if (is_file($NM_patch))
          {
              @unlink($NM_patch);
          }
          if ($NM_filters_del == $this->NM_curr_fil)
          {
              $this->NM_curr_fil = "";
          }
      }
   }
   /**
    * @access  public
    */
   function trata_campos()
   {
      global $appointments_id_proyecto_cond, $appointments_id_proyecto,
             $appointments_current_status_id_cond, $appointments_current_status_id,
             $appointments_appointment_start_date_cond, $appointments_appointment_start_date, $appointments_appointment_start_date_dia, $appointments_appointment_start_date_mes, $appointments_appointment_start_date_ano, $appointments_appointment_start_date_input_2_dia, $appointments_appointment_start_date_input_2_mes, $appointments_appointment_start_date_input_2_ano, $nmgp_tab_label;

      $C_formatado = true;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      $this->Out_dyn_search = array();
      $this->Out_dyn_search[] = "appointments_current_status_id";
      $this->Out_dyn_search[] = "appointments_id_proyecto";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd']  = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'] = array();
      if (!empty($appointments_id_proyecto))
      {
          $appointments_id_proyecto = explode("@?@", $appointments_id_proyecto);
      }
      else
      {
          $appointments_id_proyecto = array();
      }
      $appointments_id_proyecto_cond_salva = $appointments_id_proyecto_cond; 
      if (!isset($appointments_id_proyecto_input_2) || $appointments_id_proyecto_input_2 == "")
      {
          $appointments_id_proyecto_input_2 = $appointments_id_proyecto;
      }
      $appointments_current_status_id_cond_salva = $appointments_current_status_id_cond; 
      if (!isset($appointments_current_status_id_input_2) || $appointments_current_status_id_input_2 == "")
      {
          $appointments_current_status_id_input_2 = $appointments_current_status_id;
      }
      $appointments_appointment_start_date_cond_salva = $appointments_appointment_start_date_cond; 
      if (!isset($appointments_appointment_start_date_input_2_dia) || $appointments_appointment_start_date_input_2_dia == "")
      {
          $appointments_appointment_start_date_input_2_dia = $appointments_appointment_start_date_dia;
      }
      if (!isset($appointments_appointment_start_date_input_2_mes) || $appointments_appointment_start_date_input_2_mes == "")
      {
          $appointments_appointment_start_date_input_2_mes = $appointments_appointment_start_date_mes;
      }
      if (!isset($appointments_appointment_start_date_input_2_ano) || $appointments_appointment_start_date_input_2_ano == "")
      {
          $appointments_appointment_start_date_input_2_ano = $appointments_appointment_start_date_ano;
      }
      if (is_array($appointments_id_proyecto)) {
          foreach ($appointments_id_proyecto as $I => $Val) {
              $tmp_pos = (is_string($Val)) ? strpos($Val, "##@@") : false;
              if ($tmp_pos === false) {
                  $L_lookup = $Val;
              }
              else {
                  $L_lookup = substr($Val, 0, $tmp_pos);
              }
              if ($this->NM_ajax_opcao != "ajax_grid_search_change_fil" && trim($L_lookup) != '' && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['psq_check_ret']['appointments_id_proyecto'])) {
                  if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Proyecto : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  break;
              }
          }
      }
      $tmp_pos = (is_string($appointments_current_status_id)) ? strpos($appointments_current_status_id, "##@@") : false;
      if ($tmp_pos === false) {
          $L_lookup = $appointments_current_status_id;
      }
      else {
          $L_lookup = substr($appointments_current_status_id, 0, $tmp_pos);
      }
      if ($this->NM_ajax_opcao != "ajax_grid_search_change_fil" && !empty($L_lookup) && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['psq_check_ret']['appointments_current_status_id'])) {
          if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Estado : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_refresh'] = array();
      $I_Dyn = 0;
      $Dyn_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_id_proyecto'] = $appointments_id_proyecto; 
      if (is_array($appointments_id_proyecto) && !empty($appointments_id_proyecto))
      {
          $Dyn_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][0] = $appointments_id_proyecto;
      }
      elseif ($appointments_id_proyecto_cond_salva == "nu" || $appointments_id_proyecto_cond_salva == "nn" || $appointments_id_proyecto_cond_salva == "ep" || $appointments_id_proyecto_cond_salva == "ne" || !empty($appointments_id_proyecto))
      {
          $Dyn_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][0][0] = $appointments_id_proyecto;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_id_proyecto_cond'] = $appointments_id_proyecto_cond_salva; 
      if ($Dyn_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['cmp'] = "appointments_id_proyecto"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['opc'] = $appointments_id_proyecto_cond_salva; 
          $I_Dyn++;
      }
      $Dyn_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_current_status_id'] = $appointments_current_status_id; 
      if (is_array($appointments_current_status_id) && !empty($appointments_current_status_id))
      {
          $Dyn_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][0] = $appointments_current_status_id;
      }
      elseif ($appointments_current_status_id_cond_salva == "nu" || $appointments_current_status_id_cond_salva == "nn" || $appointments_current_status_id_cond_salva == "ep" || $appointments_current_status_id_cond_salva == "ne" || !empty($appointments_current_status_id))
      {
          $Dyn_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][0][0] = $appointments_current_status_id;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_current_status_id_cond'] = $appointments_current_status_id_cond_salva; 
      if ($Dyn_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['cmp'] = "appointments_current_status_id"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['opc'] = $appointments_current_status_id_cond_salva; 
          $I_Dyn++;
      }
      $Dyn_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_dia'] = $appointments_appointment_start_date_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_mes'] = $appointments_appointment_start_date_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_ano'] = $appointments_appointment_start_date_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_input_2_dia'] = $appointments_appointment_start_date_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_input_2_mes'] = $appointments_appointment_start_date_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_input_2_ano'] = $appointments_appointment_start_date_input_2_ano; 
      if (!empty($appointments_appointment_start_date_dia) || !empty($appointments_appointment_start_date_mes) || !empty($appointments_appointment_start_date_ano) || $appointments_appointment_start_date_cond_salva == "nu" || $appointments_appointment_start_date_cond_salva == "nn" || $appointments_appointment_start_date_cond_salva == "ep" || $appointments_appointment_start_date_cond_salva == "ne")
      {
          $Dyn_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][0][] = "D:" . $appointments_appointment_start_date_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][0][] = "M:" . $appointments_appointment_start_date_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][0][] = "Y:" . $appointments_appointment_start_date_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][1][] = "D:" . $appointments_appointment_start_date_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][1][] = "M:" . $appointments_appointment_start_date_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['val'][1][] = "Y:" . $appointments_appointment_start_date_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_cond'] = $appointments_appointment_start_date_cond_salva; 
      if ($Dyn_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['cmp'] = "appointments_appointment_start_date"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search'][$I_Dyn]['opc'] = $appointments_appointment_start_date_cond_salva; 
          $I_Dyn++;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca'] = $Temp_Busca;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $this->cmp_formatado['appointments_id_proyecto'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_id_proyecto'];
      $this->cmp_formatado['appointments_id_proyecto_input_2'] = $appointments_id_proyecto_input_2;
      $Conteudo = $appointments_current_status_id;
      if (strpos($Conteudo, "##@@") !== false)
      {
          $Conteudo = substr($Conteudo, strpos($Conteudo, "##@@") + 4);
      }
      $this->cmp_formatado['appointments_current_status_id'] = $Conteudo;

      //----- $appointments_id_proyecto
      $this->Date_part = false;
      $nm_aspas = "";
      if ($appointments_id_proyecto_cond == "nu" || $appointments_id_proyecto_cond == "nn" || $appointments_id_proyecto_cond == "ep" || $appointments_id_proyecto_cond == "ne")
      {
          $appointments_id_proyecto = array();
      }
      if (is_array($appointments_id_proyecto) && count($appointments_id_proyecto) != 0)
      {
         foreach ($appointments_id_proyecto as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if (($tmp_pos === false && $dados == "") || $tmp_pos == 0)
            {
                unset($appointments_id_proyecto[$i]);
            }
         }
      }
      $Temp_cmd = "";
      if (is_array($appointments_id_proyecto) && count($appointments_id_proyecto) != 0)
      {
         $this->and_or();
         if ($appointments_id_proyecto_cond == "df" || $appointments_id_proyecto_cond == "np")
         {
             $this->comando        .= " appointments.id_proyecto not in (";
             $this->comando_sum    .= " appointments.id_proyecto not in (";
             $this->comando_filtro .= " appointments.id_proyecto not in (";
             $Temp_cmd             .= " appointments.id_proyecto not in (";
         }
         else
         {
             $this->comando        .= " appointments.id_proyecto in (";
             $this->comando_sum    .= " appointments.id_proyecto in (";
             $this->comando_filtro .= " appointments.id_proyecto in (";
             $Temp_cmd             .= " appointments.id_proyecto in (";
         }
         $x                     = count($appointments_id_proyecto);
         $xx                    = 0;
         $nm_cond               = "";
         foreach ($appointments_id_proyecto as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if ($tmp_pos === false)
            {
               $res_lookup = $dados;
            }
            else
            {
                $res_lookup = substr($dados, $tmp_pos + 4);
                $dados = substr($dados, 0, $tmp_pos);
            }
            $dados  = substr($this->Db->qstr($dados), 1, -1);
            $this->comando        .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $this->comando_sum    .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $this->comando_filtro .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $Temp_cmd             .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $nm_cond              .= $res_lookup;
            if ($xx != ($x - 1))
            {
               $this->comando        .= ",";
               $this->comando_sum    .= ",";
               $this->comando_filtro .= ",";
               $Temp_cmd             .= ",";
               $nm_cond              .= " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
            }
            $xx++;
         }
         $this->comando        .= ")";
         $this->comando_sum    .= ")";
         $this->comando_filtro .= ")";
         $Lang_descr = array();
         $Lang_descr['eq'] = $this->Ini->Nm_lang['lang_srch_equl'];
         $Lang_descr['df'] = $this->Ini->Nm_lang['lang_srch_diff'];
         $Lang_descr['np'] = $this->Ini->Nm_lang['lang_srch_not_like'];
         $Lang_descr_final = isset($Lang_descr[$appointments_id_proyecto_cond]) ? $Lang_descr[$appointments_id_proyecto_cond] : $this->Ini->Nm_lang['lang_srch_like'];
         $Temp_cmd             .= ")";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $nmgp_tab_label['appointments_id_proyecto'] . " " . $this->Ini->Nm_lang['lang_srch_like'] . " " . $nm_cond . "##*@@";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cmd'][]  = $Temp_cmd;
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['dyn_search_out_cond'][] = $nmgp_tab_label['appointments_id_proyecto'] . " " . $Lang_descr_final . " " . $nm_cond;
      }
      elseif (isset($appointments_id_proyecto) && ($appointments_id_proyecto_cond == "nu" || $appointments_id_proyecto_cond == "nn" || $appointments_id_proyecto_cond == "ep" || $appointments_id_proyecto_cond == "ne"))
      {
         $this->monta_condicao("appointments.id_proyecto", $appointments_id_proyecto_cond, "", "", "appointments_id_proyecto", "INT", false);
      }

      //----- $appointments_current_status_id
      $this->Date_part = false;
      if (isset($appointments_current_status_id))
      {
         $this->monta_condicao("appointments.current_status_id", $appointments_current_status_id_cond, $appointments_current_status_id, "", "appointments_current_status_id", "INT", false);
      }

      //----- $appointments_appointment_start_date
      $this->Date_part = false;
      if ($appointments_appointment_start_date_cond != "bi_TP")
      {
          $appointments_appointment_start_date_cond = strtoupper($appointments_appointment_start_date_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $appointments_appointment_start_date_ano;
          $Dtxt .= $appointments_appointment_start_date_mes;
          $Dtxt .= $appointments_appointment_start_date_dia;
          $val[0]['ano'] = $appointments_appointment_start_date_ano;
          $val[0]['mes'] = $appointments_appointment_start_date_mes;
          $val[0]['dia'] = $appointments_appointment_start_date_dia;
          if ($appointments_appointment_start_date_cond == "BW")
          {
              $val[1]['ano'] = $appointments_appointment_start_date_input_2_ano;
              $val[1]['mes'] = $appointments_appointment_start_date_input_2_mes;
              $val[1]['dia'] = $appointments_appointment_start_date_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "DT", "DATE", $appointments_appointment_start_date_cond, "", "data");
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $appointments_appointment_start_date = $val[0];
          $this->cmp_formatado['appointments_appointment_start_date'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['appointments_appointment_start_date'], "YYYY-MM-DD");
          $this->cmp_formatado['appointments_appointment_start_date'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          if ($appointments_appointment_start_date_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $appointments_appointment_start_date_input_2     = $val[1];
              $this->cmp_formatado['appointments_appointment_start_date_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']['appointments_appointment_start_date_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['appointments_appointment_start_date_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['appointments_appointment_start_date_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          }
          if (!empty($Dtxt) || $appointments_appointment_start_date_cond == "NU" || $appointments_appointment_start_date_cond == "NN"|| $appointments_appointment_start_date_cond == "EP"|| $appointments_appointment_start_date_cond == "NE")
          {
              $this->monta_condicao("appointments.appointment_start_date", $appointments_appointment_start_date_cond, $appointments_appointment_start_date, $appointments_appointment_start_date_input_2, 'appointments_appointment_start_date', 'DATE');
          }
      }
   }

   /**
    * @access  public
    */
   function finaliza_resultado()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq_fast'] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['fast_search']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq_interativ'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['interativ_search'] = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['int_search_dados'] = array();
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq_filtro'] = " (" . $this->comando_filtro . ")";
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq_ant'])
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['tot_geral']);
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_adm']['where_pesq'];

      echo "<script type=\"text/javascript\">"; 
      echo "parent.NM_apaga_erro()";
      echo "</script>"; 
      $this->retorna_pesq();
   }
   function jqueryCalendarDtFormat($sFormat, $sSep)
   {
       $sFormat = chunk_split(str_replace('yyyy', 'yy', $sFormat), 2, $sSep);

       if ($sSep == substr($sFormat, -1))
       {
           $sFormat = substr($sFormat, 0, -1);
       }

       return $sFormat;
   } // jqueryCalendarDtFormat

   function jqueryCalendarWeekInit($sDay)
   {
       switch ($sDay) {
           case 'MO': return 1; break;
           case 'TU': return 2; break;
           case 'WE': return 3; break;
           case 'TH': return 4; break;
           case 'FR': return 5; break;
           case 'SA': return 6; break;
           default  : return 7; break;
       }
   } // jqueryCalendarWeekInit

   
   function css_obj_select_ajax($Obj)
   {
      switch ($Obj)
      {
         case "appointments_current_status_id" : return ('class="scFilterObjectEven"'); break;
         default       : return ("");
      }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
}

?>
