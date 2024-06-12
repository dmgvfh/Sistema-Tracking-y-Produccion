<?php

class reporte_tracking_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function __construct($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("es");
      if (isset($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['reporte_tracking']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->appointment_start_date = (isset($Busca_temp['appointment_start_date'])) ? $Busca_temp['appointment_start_date'] : ""; 
          $tmp_pos = (is_string($this->appointment_start_date)) ? strpos($this->appointment_start_date, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->appointment_start_date))
          {
              $this->appointment_start_date = substr($this->appointment_start_date, 0, $tmp_pos);
          }
          $appointment_start_date_2 = (isset($Busca_temp['appointment_start_date_input_2'])) ? $Busca_temp['appointment_start_date_input_2'] : ""; 
          $this->appointment_start_date_2 = $appointment_start_date_2; 
          $this->nombre = (isset($Busca_temp['nombre'])) ? $Busca_temp['nombre'] : ""; 
          $tmp_pos = (is_string($this->nombre)) ? strpos($this->nombre, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nombre))
          {
              $this->nombre = substr($this->nombre, 0, $tmp_pos);
          }
      } 
   }


   //----- 
   function Calc_resumo_status($destino_resumo, $res_export=false)
   {
      global $nm_lang;
      $this->nm_data = new nm_data("es");
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sql_tot_res']);
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->appointment_start_date = (isset($Busca_temp['appointment_start_date'])) ? $Busca_temp['appointment_start_date'] : ""; 
          $tmp_pos = (is_string($this->appointment_start_date)) ? strpos($this->appointment_start_date, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->appointment_start_date))
          {
              $this->appointment_start_date = substr($this->appointment_start_date, 0, $tmp_pos);
          }
          $this->appointment_start_date_2 = (isset($Busca_temp['appointment_start_date_input_2'])) ? $Busca_temp['appointment_start_date_input_2'] : ""; 
          $this->nombre = (isset($Busca_temp['nombre'])) ? $Busca_temp['nombre'] : ""; 
          $tmp_pos = (is_string($this->nombre)) ? strpos($this->nombre, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nombre))
          {
              $this->nombre = substr($this->nombre, 0, $tmp_pos);
          }
      } 
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'];
      $ind_qb                = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'];
      $cmp_sql_def   = array('appointment_start_date' => "appointment_start_date",'id_usuario' => "id_usuario",'id_proyecto' => "id_proyecto");
      $cmps_quebra_atual = array("appointment_start_date","id_usuario","id_proyecto");
      $ult_cmp_quebra_atual = $cmps_quebra_atual[(count($cmps_quebra_atual) - 1)];
      $arr_tots = "";
      $join     = "";
      $group    = "";
      $i_group  = 1;
      $cmps_gb  = "";
      $cmps_gb1 = "";
      $cmps_gb2 = "";
      $cmps_gbS = array();
      $ind_cmps = 2;
      $ind_alias = "1";
      $cmp_dim   = array();
      $all_group = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $cmp_gb);
          if (!empty($Format_tst))
          {
              $Str_arg_sum = $this->Ini->Get_date_arg_sum($cmp_gb, $Format_tst, $cmp_sql_def[$cmp_gb], false, true);
              $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$cmp_gb] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$cmp_gb], $Format_tst);
          }
          else
          {
              $Str_arg_sql = "";
              $Str_arg_sum = $cmp_sql_def[$cmp_gb] . " *sc# SC." . $cmp_sql_def[$cmp_gb];
          }
          $cmp_dim[$cmp_gb] = $ind_cmps;
          $temp = explode(" and ", $Str_arg_sum);
          foreach ($temp as $cada_parte)
          {
              $temp1 = explode("*sc#", $cada_parte);
              if (!in_array($Str_arg_sql . trim($temp1[0]), $all_group))
              {
                  $group   .= (empty($group))   ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
                  $all_group[] = $Str_arg_sql . trim($temp1[0]);
              }
              $cmps_gb1 .= (empty($cmps_gb1)) ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
              $cmps_gb1 .= " as a_cmp_" .  $ind_alias;
              $cmps_gb2 .= (empty($cmps_gb2)) ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
              $cmps_gb2 .= " as b_cmp_" .  $ind_alias;
              $join     .= empty($join) ? "" : " and ";
              $join     .= " SC_sel1.a_cmp_" .  $ind_alias . " =  SC_sel2.b_cmp_" .  $ind_alias;
              $ind_cmps++;
              $ind_alias++;
              $i_group++;
          }
      }
      $ind_cmps  = 2;
      $ind_alias = "1";
      $cmp_dim   = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $arr_tots .= "[\$" . $cmp_gb . "_orig]";
          $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $cmp_gb);
          if (!empty($Format_tst))
          {
              $Str_arg_sum = $this->Ini->Get_date_arg_sum($cmp_gb, $Format_tst, $cmp_sql_def[$cmp_gb], false, true);
              $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$cmp_gb] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$cmp_gb], $Format_tst);
          }
          else
          {
              $Str_arg_sql = "";
              $Str_arg_sum = $cmp_sql_def[$cmp_gb] . " *sc# SC." . $cmp_sql_def[$cmp_gb];
          }
          $cmp_dim[$cmp_gb] = $ind_cmps;
          $temp = explode(" and ", $Str_arg_sum);
          foreach ($temp as $cada_parte)
          {
              $temp1 = explode("*sc#", $cada_parte);
              $cmps_gb  .= (empty($cmps_gb)) ? "a_cmp_" .  $ind_alias : "," . "a_cmp_" .  $ind_alias;
              $cmps_gbS['a_cmp_' . $ind_alias] = $Str_arg_sql . trim($temp1[0]);
              $ind_cmps++;
              $ind_alias++;
          }
          $this->Res_Totaliza_status($ind_qb, $cmp_gb, $arr_tots, $group, $join, $cmps_gb, $cmps_gb1, $cmps_gb2, $cmps_gbS, $cmp_dim, $cmps_quebra_atual, $cmp_sql_def, $res_export);
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['arr_total'] = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $Arr_tot_name = "array_total_" . $cmp_gb;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['arr_total'][$cmp_gb] = $this->$Arr_tot_name;
      }
   }

   function Res_Totaliza_status($ind_qb, $cmp_tot, $arr_tots, $group, $join, $cmps_quebras, $cmps_quebras1, $cmps_quebras2, $cmps_quebrasS, $Cmp_dim, $cmps_quebra_atual, $cmp_sql_def, $res_export)
   {
      $sc_having = ((isset($parms_sub_sel['having']))) ? "  having " . $parms_sub_sel['having'] : "";
      $Tem_estat_manual = false;
      $where_ok = $this->sc_where_atual;
      $cmp_sql_tp_num = array('appointments_id' => 'N','current_status_id' => 'N','id_proyecto' => 'N','id_usuario' => 'N','id_actividad' => 'N','intervalo' => 'N');
     $cmd_simp = "select count(*), sum(intervalo)#@#cmps_quebras#@# from " . $this->Ini->nm_tabela . " " . $where_ok;
     $comando  = "select count(*), sum(SC_metric1)#@#cmps_quebras#@# from (";
     $comando .= "select intervalo as SC_metric1, " . $cmps_quebras1 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . ") SC_sel1 INNER JOIN (";
     $comando .= "select " . $cmps_quebras2 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . " group by " . $group . $sc_having . ") SC_sel2 ";
     $comando .= " ON " . $join;
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sql_tot_res']))
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sql_tot_res'] = str_replace("#@#cmps_quebras#@#", "", $comando);
      }
      $comando  = str_replace("#@#cmps_quebras#@#", "," . $cmps_quebras, $comando);
      $comando .= " group by " . $cmps_quebras . " order by " .  $cmps_quebras;
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Res_search_metric_use']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Res_search_metric_use']))
      {
          $comando = $cmd_simp;
          $cmps_S  = "";
          foreach ($cmps_quebrasS as $alias => $sql)
          {
              $cmps_S .= empty($cmps_S) ? $sql : ", " . $sql;
          }
          $comando = str_replace("#@#cmps_quebras#@#", "," . $cmps_S, $comando);
          $order_group = "";
          foreach ($cmps_quebrasS as $alias => $cada_tst)
          {
              $cada_tst = trim($cada_tst);
              $pos = strpos(" " . $order_group, " " . $cada_tst);
              if ($pos === false)
              {
                  $order_group .= (!empty($order_group)) ? ", " . $cada_tst : $cada_tst;
              }
          }
          $comando .= " group by " . $order_group . " order by " .  $order_group;
      }
      $comando  = $this->Ajust_statistic($comando);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($comando))
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit;
      }
      $format_dimensions = array();
      $format_dimensions['appointment_start_date']['reg'] = "N";
      $format_dimensions['appointment_start_date']['msk'] = "F/Y";
      $format_dimensions['id_usuario']['reg'] = "S";
      $format_dimensions['id_usuario']['msk'] = "";
      $format_dimensions['id_proyecto']['reg'] = "S";
      $format_dimensions['id_proyecto']['msk'] = "";
      while (!$rt->EOF)
      {
          $sql_where = "";
          foreach ($Cmp_dim as $Cada_dim => $Ind_sql)
          {
              $prep_look  = $Cada_dim . "_SC_look";
              $$prep_look = $rt->fields[$Ind_sql];
              $SC_prep = $this->Ini->Get_format_dimension($Ind_sql, 'status', $Cada_dim, $rt, $format_dimensions[$Cada_dim]['reg'], $format_dimensions[$Cada_dim]['msk']);
              $SC_orig = $Cada_dim . "_orig";
              $SC_graf = "val_grafico_" . $Cada_dim;
              $$Cada_dim = $SC_prep['fmt'];
              $$SC_orig = $SC_prep['orig'];
              if ($Cada_dim == "id_usuario") {
                  $this->Lookup->lookup_status_id_usuario($$Cada_dim,  $id_usuario);
              }
              if ($Cada_dim == "id_proyecto") {
                  $this->Lookup->lookup_status_id_proyecto($$Cada_dim,  $id_proyecto);
              }
              if (null === $$Cada_dim)
              {
                  $$Cada_dim = '';
              }
              if (null === $$SC_orig)
              {
                  $$SC_orig = '__SCNULL__';
              }
              $$SC_graf = $$Cada_dim;
              if ($Tem_estat_manual)
              {
                  $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $Cada_dim);
                  if (!empty($Format_tst))
                  {
                      $val_sql  = $rt->fields[$Ind_sql];
                      if ($Format_tst == 'YYYYMMDDHHII')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2] . " " . $rt->fields[$Ind_sql + 3] . ":" . $rt->fields[$Ind_sql + 4];
                      }
                      if ($Format_tst == 'YYYYMMDDHH')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2] . " " . $rt->fields[$Ind_sql + 3];
                      }
                      if ($Format_tst == 'YYYYMMDD2')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2];
                      }
                      if ($Format_tst == 'YYYYMM')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1];
                      }
                      if ($Format_tst == 'YYYYHH' || $Format_tst == 'YYYYDD' || $Format_tst == 'YYYYDAYNAME' || $Format_tst == 'YYYYWEEK' || $Format_tst == 'YYYYBIMONTHLY' || $Format_tst == 'YYYYQUARTER' || $Format_tst == 'YYYYFOURMONTHS' || $Format_tst == 'YYYYSEMIANNUAL')
                      {
                          $val_sql .= $rt->fields[$Ind_sql + 1];
                      }
                      if ($Format_tst == 'HHIISS')
                      {
                          $val_sql  = $rt->fields[$Ind_sql] . ":" . $rt->fields[$Ind_sql + 1] . ":" . $rt->fields[$Ind_sql + 2];
                      }
                      if ($Format_tst == 'HHII')
                      {
                          $val_sql  = $rt->fields[$Ind_sql] . ":" . $rt->fields[$Ind_sql + 1];
                      }
                      $Str_arg_sum = $this->Ini->Get_date_arg_sum($val_sql, $Format_tst, $cmp_sql_def[$Cada_dim], true);
                      $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$Cada_dim] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$Cada_dim], $Format_tst);
                  }
                  elseif (isset($cmp_sql_tp_num[$Cada_dim]))
                  {
                      $Str_arg_sql = $cmp_sql_def[$Cada_dim];
                      $Str_arg_sum = " = " . $rt->fields[$Ind_sql];
                  }
                  else
                  {
                      $Str_arg_sql = $cmp_sql_def[$Cada_dim];
                      $Str_arg_sum = " = " . $this->Db->qstr($rt->fields[$Ind_sql]);
                  }
                  $sql_where .= (!empty($sql_where)) ? " and " : "";
                  $sql_where .= $Str_arg_sql . $Str_arg_sum;
              }
          }
          if ($Tem_estat_manual)
          {
              $where_ok = (empty($this->sc_where_atual)) ? " where " . $sql_where : $this->sc_where_atual . " and " . $sql_where;
              $vl_statistic = $this->Calc_statist_manual_status($where_ok);
              foreach ($vl_statistic as $ind => $val)
              {
                  $rt->fields[$ind] = $val;
              }
          }
          $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
          $rt->fields[1] = (strpos(strtolower($rt->fields[1]), "e")) ? (float)$rt->fields[1] : $rt->fields[1]; 
          $rt->fields[1] = (string)$rt->fields[1];
          if ($rt->fields[1] == "") 
          {
              $rt->fields[1] = 0;
          }
          if (substr($rt->fields[1], 0, 1) == ".") 
          {
              $rt->fields[1] = "0" . $rt->fields[1];
          }
          if (substr($rt->fields[1], 0, 2) == "-.") 
          {
              $rt->fields[1] = "-0" . substr($rt->fields[1], 1);
          }
          nmgp_Trunc_Num($rt->fields[1], 2);
          $str_tot = "array_total_" . $cmp_tot;
          if (!isset($this->$str_tot))
          {
              $this->$str_tot = array();
          }
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[0]";
          eval ('$this->' . $str_tot . ' = ' . $rt->fields[0] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[1]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[1] . ';');
          $str_grf = "val_grafico_" . $cmp_tot;
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[2]";
          eval ('$this->' . $str_tot . ' = $' . $str_grf . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[3]";
          $str_org = $cmp_tot . "_orig";
          eval ('$this->' . $str_tot . ' = $' . $str_org . ';');
          eval ('ksort($this->array_total_' . $cmp_tot . $arr_tots . ');');
          $rt->MoveNext();
      }
      $rt->Close();
   }

   //----- 
   function Calc_resumo_sc_free_group_by($destino_resumo, $res_export=false)
   {
      global $nm_lang;
      $this->nm_data = new nm_data("es");
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sql_tot_res']);
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->appointment_start_date = (isset($Busca_temp['appointment_start_date'])) ? $Busca_temp['appointment_start_date'] : ""; 
          $tmp_pos = (is_string($this->appointment_start_date)) ? strpos($this->appointment_start_date, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->appointment_start_date))
          {
              $this->appointment_start_date = substr($this->appointment_start_date, 0, $tmp_pos);
          }
          $this->appointment_start_date_2 = (isset($Busca_temp['appointment_start_date_input_2'])) ? $Busca_temp['appointment_start_date_input_2'] : ""; 
          $this->nombre = (isset($Busca_temp['nombre'])) ? $Busca_temp['nombre'] : ""; 
          $tmp_pos = (is_string($this->nombre)) ? strpos($this->nombre, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nombre))
          {
              $this->nombre = substr($this->nombre, 0, $tmp_pos);
          }
      } 
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'];
      $ind_qb                = $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Ind_Groupby'];
      $cmp_sql_def   = array('appointment_start_date' => "appointment_start_date",'id_usuario' => "id_usuario",'id_actividad' => "id_actividad",'id_proyecto' => "id_proyecto");
      $cmps_quebra_atual = array();
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['SC_Gb_Free_cmp'] as $cmp => $resto)
      {
          $cmps_quebra_atual[] = $cmp;
      }
      $ult_cmp_quebra_atual = $cmps_quebra_atual[(count($cmps_quebra_atual) - 1)];
      $arr_tots = "";
      $join     = "";
      $group    = "";
      $i_group  = 1;
      $cmps_gb  = "";
      $cmps_gb1 = "";
      $cmps_gb2 = "";
      $cmps_gbS = array();
      $ind_cmps = 2;
      $ind_alias = "1";
      $cmp_dim   = array();
      $all_group = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $cmp_gb);
          if (!empty($Format_tst))
          {
              $Str_arg_sum = $this->Ini->Get_date_arg_sum($cmp_gb, $Format_tst, $cmp_sql_def[$cmp_gb], false, true);
              $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$cmp_gb] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$cmp_gb], $Format_tst);
          }
          else
          {
              $Str_arg_sql = "";
              $Str_arg_sum = $cmp_sql_def[$cmp_gb] . " *sc# SC." . $cmp_sql_def[$cmp_gb];
          }
          $cmp_dim[$cmp_gb] = $ind_cmps;
          $temp = explode(" and ", $Str_arg_sum);
          foreach ($temp as $cada_parte)
          {
              $temp1 = explode("*sc#", $cada_parte);
              if (!in_array($Str_arg_sql . trim($temp1[0]), $all_group))
              {
                  $group   .= (empty($group))   ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
                  $all_group[] = $Str_arg_sql . trim($temp1[0]);
              }
              $cmps_gb1 .= (empty($cmps_gb1)) ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
              $cmps_gb1 .= " as a_cmp_" .  $ind_alias;
              $cmps_gb2 .= (empty($cmps_gb2)) ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
              $cmps_gb2 .= " as b_cmp_" .  $ind_alias;
              $join     .= empty($join) ? "" : " and ";
              $join     .= " SC_sel1.a_cmp_" .  $ind_alias . " =  SC_sel2.b_cmp_" .  $ind_alias;
              $ind_cmps++;
              $ind_alias++;
              $i_group++;
          }
      }
      $ind_cmps  = 2;
      $ind_alias = "1";
      $cmp_dim   = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $arr_tots .= "[\$" . $cmp_gb . "_orig]";
          $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $cmp_gb);
          if (!empty($Format_tst))
          {
              $Str_arg_sum = $this->Ini->Get_date_arg_sum($cmp_gb, $Format_tst, $cmp_sql_def[$cmp_gb], false, true);
              $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$cmp_gb] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$cmp_gb], $Format_tst);
          }
          else
          {
              $Str_arg_sql = "";
              $Str_arg_sum = $cmp_sql_def[$cmp_gb] . " *sc# SC." . $cmp_sql_def[$cmp_gb];
          }
          $cmp_dim[$cmp_gb] = $ind_cmps;
          $temp = explode(" and ", $Str_arg_sum);
          foreach ($temp as $cada_parte)
          {
              $temp1 = explode("*sc#", $cada_parte);
              $cmps_gb  .= (empty($cmps_gb)) ? "a_cmp_" .  $ind_alias : "," . "a_cmp_" .  $ind_alias;
              $cmps_gbS['a_cmp_' . $ind_alias] = $Str_arg_sql . trim($temp1[0]);
              $ind_cmps++;
              $ind_alias++;
          }
          $this->Res_Totaliza_sc_free_group_by($ind_qb, $cmp_gb, $arr_tots, $group, $join, $cmps_gb, $cmps_gb1, $cmps_gb2, $cmps_gbS, $cmp_dim, $cmps_quebra_atual, $cmp_sql_def, $res_export);
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['arr_total'] = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $Arr_tot_name = "array_total_" . $cmp_gb;
          $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['arr_total'][$cmp_gb] = $this->$Arr_tot_name;
      }
   }

   function Res_Totaliza_sc_free_group_by($ind_qb, $cmp_tot, $arr_tots, $group, $join, $cmps_quebras, $cmps_quebras1, $cmps_quebras2, $cmps_quebrasS, $Cmp_dim, $cmps_quebra_atual, $cmp_sql_def, $res_export)
   {
      $sc_having = ((isset($parms_sub_sel['having']))) ? "  having " . $parms_sub_sel['having'] : "";
      $Tem_estat_manual = false;
      $where_ok = $this->sc_where_atual;
      $cmp_sql_tp_num = array('appointments_id' => 'N','current_status_id' => 'N','id_proyecto' => 'N','id_usuario' => 'N','id_actividad' => 'N','intervalo' => 'N');
     $cmd_simp = "select count(*), sum(intervalo)#@#cmps_quebras#@# from " . $this->Ini->nm_tabela . " " . $where_ok;
     $comando  = "select count(*), sum(SC_metric1)#@#cmps_quebras#@# from (";
     $comando .= "select intervalo as SC_metric1, " . $cmps_quebras1 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . ") SC_sel1 INNER JOIN (";
     $comando .= "select " . $cmps_quebras2 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . " group by " . $group . $sc_having . ") SC_sel2 ";
     $comando .= " ON " . $join;
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sql_tot_res']))
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['sql_tot_res'] = str_replace("#@#cmps_quebras#@#", "", $comando);
      }
      $comando  = str_replace("#@#cmps_quebras#@#", "," . $cmps_quebras, $comando);
      $comando .= " group by " . $cmps_quebras . " order by " .  $cmps_quebras;
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Res_search_metric_use']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['Res_search_metric_use']))
      {
          $comando = $cmd_simp;
          $cmps_S  = "";
          foreach ($cmps_quebrasS as $alias => $sql)
          {
              $cmps_S .= empty($cmps_S) ? $sql : ", " . $sql;
          }
          $comando = str_replace("#@#cmps_quebras#@#", "," . $cmps_S, $comando);
          $order_group = "";
          foreach ($cmps_quebrasS as $alias => $cada_tst)
          {
              $cada_tst = trim($cada_tst);
              $pos = strpos(" " . $order_group, " " . $cada_tst);
              if ($pos === false)
              {
                  $order_group .= (!empty($order_group)) ? ", " . $cada_tst : $cada_tst;
              }
          }
          $comando .= " group by " . $order_group . " order by " .  $order_group;
      }
      $comando  = $this->Ajust_statistic($comando);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($comando))
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit;
      }
      $format_dimensions = array();
      $format_dimensions['appointment_start_date']['reg'] = "N";
      $format_dimensions['appointment_start_date']['msk'] = "F/Y";
      $format_dimensions['id_usuario']['reg'] = "S";
      $format_dimensions['id_usuario']['msk'] = "";
      $format_dimensions['id_actividad']['reg'] = "S";
      $format_dimensions['id_actividad']['msk'] = "";
      $format_dimensions['id_proyecto']['reg'] = "S";
      $format_dimensions['id_proyecto']['msk'] = "";
      while (!$rt->EOF)
      {
          $sql_where = "";
          foreach ($Cmp_dim as $Cada_dim => $Ind_sql)
          {
              $prep_look  = $Cada_dim . "_SC_look";
              $$prep_look = $rt->fields[$Ind_sql];
              $SC_prep = $this->Ini->Get_format_dimension($Ind_sql, 'sc_free_group_by', $Cada_dim, $rt, $format_dimensions[$Cada_dim]['reg'], $format_dimensions[$Cada_dim]['msk']);
              $SC_orig = $Cada_dim . "_orig";
              $SC_graf = "val_grafico_" . $Cada_dim;
              $$Cada_dim = $SC_prep['fmt'];
              $$SC_orig = $SC_prep['orig'];
              if ($Cada_dim == "id_usuario") {
                  $this->Lookup->lookup_sc_free_group_by_id_usuario($$Cada_dim,  $id_usuario);
              }
              if ($Cada_dim == "id_actividad") {
                  $this->Lookup->lookup_sc_free_group_by_id_actividad($$Cada_dim,  $id_actividad);
              }
              if ($Cada_dim == "id_proyecto") {
                  $this->Lookup->lookup_sc_free_group_by_id_proyecto($$Cada_dim,  $id_proyecto);
              }
              if (null === $$Cada_dim)
              {
                  $$Cada_dim = '';
              }
              if (null === $$SC_orig)
              {
                  $$SC_orig = '__SCNULL__';
              }
              $$SC_graf = $$Cada_dim;
              if ($Tem_estat_manual)
              {
                  $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $Cada_dim);
                  if (!empty($Format_tst))
                  {
                      $val_sql  = $rt->fields[$Ind_sql];
                      if ($Format_tst == 'YYYYMMDDHHII')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2] . " " . $rt->fields[$Ind_sql + 3] . ":" . $rt->fields[$Ind_sql + 4];
                      }
                      if ($Format_tst == 'YYYYMMDDHH')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2] . " " . $rt->fields[$Ind_sql + 3];
                      }
                      if ($Format_tst == 'YYYYMMDD2')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2];
                      }
                      if ($Format_tst == 'YYYYMM')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1];
                      }
                      if ($Format_tst == 'YYYYHH' || $Format_tst == 'YYYYDD' || $Format_tst == 'YYYYDAYNAME' || $Format_tst == 'YYYYWEEK' || $Format_tst == 'YYYYBIMONTHLY' || $Format_tst == 'YYYYQUARTER' || $Format_tst == 'YYYYFOURMONTHS' || $Format_tst == 'YYYYSEMIANNUAL')
                      {
                          $val_sql .= $rt->fields[$Ind_sql + 1];
                      }
                      if ($Format_tst == 'HHIISS')
                      {
                          $val_sql  = $rt->fields[$Ind_sql] . ":" . $rt->fields[$Ind_sql + 1] . ":" . $rt->fields[$Ind_sql + 2];
                      }
                      if ($Format_tst == 'HHII')
                      {
                          $val_sql  = $rt->fields[$Ind_sql] . ":" . $rt->fields[$Ind_sql + 1];
                      }
                      $Str_arg_sum = $this->Ini->Get_date_arg_sum($val_sql, $Format_tst, $cmp_sql_def[$Cada_dim], true);
                      $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$Cada_dim] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$Cada_dim], $Format_tst);
                  }
                  elseif (isset($cmp_sql_tp_num[$Cada_dim]))
                  {
                      $Str_arg_sql = $cmp_sql_def[$Cada_dim];
                      $Str_arg_sum = " = " . $rt->fields[$Ind_sql];
                  }
                  else
                  {
                      $Str_arg_sql = $cmp_sql_def[$Cada_dim];
                      $Str_arg_sum = " = " . $this->Db->qstr($rt->fields[$Ind_sql]);
                  }
                  $sql_where .= (!empty($sql_where)) ? " and " : "";
                  $sql_where .= $Str_arg_sql . $Str_arg_sum;
              }
          }
          if ($Tem_estat_manual)
          {
              $where_ok = (empty($this->sc_where_atual)) ? " where " . $sql_where : $this->sc_where_atual . " and " . $sql_where;
              $vl_statistic = $this->Calc_statist_manual_sc_free_group_by($where_ok);
              foreach ($vl_statistic as $ind => $val)
              {
                  $rt->fields[$ind] = $val;
              }
          }
          $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
          $rt->fields[1] = (strpos(strtolower($rt->fields[1]), "e")) ? (float)$rt->fields[1] : $rt->fields[1]; 
          $rt->fields[1] = (string)$rt->fields[1];
          if ($rt->fields[1] == "") 
          {
              $rt->fields[1] = 0;
          }
          if (substr($rt->fields[1], 0, 1) == ".") 
          {
              $rt->fields[1] = "0" . $rt->fields[1];
          }
          if (substr($rt->fields[1], 0, 2) == "-.") 
          {
              $rt->fields[1] = "-0" . substr($rt->fields[1], 1);
          }
          nmgp_Trunc_Num($rt->fields[1], 2);
          $str_tot = "array_total_" . $cmp_tot;
          if (!isset($this->$str_tot))
          {
              $this->$str_tot = array();
          }
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[0]";
          eval ('$this->' . $str_tot . ' = ' . $rt->fields[0] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[1]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[1] . ';');
          $str_grf = "val_grafico_" . $cmp_tot;
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[2]";
          eval ('$this->' . $str_tot . ' = $' . $str_grf . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[3]";
          $str_org = $cmp_tot . "_orig";
          eval ('$this->' . $str_tot . ' = $' . $str_org . ';');
          eval ('ksort($this->array_total_' . $cmp_tot . $arr_tots . ');');
          $rt->MoveNext();
      }
      $rt->Close();
   }
   //---- 
   function quebra_geral_status($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang , $id_proyecto, $id_usuario, $id_actividad, $current_status_id;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral'] = array() ;  
      $nm_comando = "select count(*), sum(intervalo) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral'][0] = "Total Horas"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $rt->fields[1] = (string)$rt->fields[1]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral'][2] = $rt->fields[1]; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_total_geral'] = "OK";
   } 

   //---- 
   function quebra_geral_sc_free_group_by($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang , $id_proyecto, $id_usuario, $id_actividad, $current_status_id;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral'] = array() ;  
      $nm_comando = "select count(*), sum(intervalo) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral'][0] = "Total Horas"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $rt->fields[1] = (string)$rt->fields[1]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['tot_geral'][2] = $rt->fields[1]; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['contr_total_geral'] = "OK";
   } 

   //-----  appointment_start_date
   function quebra_appointment_start_date_status($appointment_start_date, $arg_sum_appointment_start_date) 
   {
      global $tot_appointment_start_date, $id_proyecto, $id_usuario, $id_actividad, $current_status_id;
      $tot_appointment_start_date = array() ;  
      $nm_comando = "select count(*), sum(intervalo) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']; 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'])) 
      { 
         $nm_comando .= " where " .  $this->Sc_groupby_appointment_start_date . $arg_sum_appointment_start_date ; 
      } 
      else 
      { 
         $nm_comando .= " and " .  $this->Sc_groupby_appointment_start_date . $arg_sum_appointment_start_date ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_appointment_start_date[0] = NM_encode_input(sc_strip_script($appointment_start_date)) ; 
      $tot_appointment_start_date[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_appointment_start_date[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
   } 

   //-----  id_usuario
   function quebra_id_usuario_status($appointment_start_date, $id_usuario, $arg_sum_appointment_start_date, $arg_sum_id_usuario) 
   {
      global $tot_id_usuario, $id_proyecto, $id_usuario, $id_actividad, $current_status_id;
      $tot_id_usuario = array() ;  
      $nm_comando = "select count(*), sum(intervalo) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']; 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'])) 
      { 
         $nm_comando .= " where " .  $this->Sc_groupby_appointment_start_date . $arg_sum_appointment_start_date . " and id_usuario" . $arg_sum_id_usuario ; 
      } 
      else 
      { 
         $nm_comando .= " and " .  $this->Sc_groupby_appointment_start_date . $arg_sum_appointment_start_date . " and id_usuario" . $arg_sum_id_usuario ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_id_usuario[0] = NM_encode_input(sc_strip_script($id_usuario)) ; 
      $tot_id_usuario[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_id_usuario[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
   } 

   //-----  id_proyecto
   function quebra_id_proyecto_status($appointment_start_date, $id_usuario, $id_proyecto, $arg_sum_appointment_start_date, $arg_sum_id_usuario, $arg_sum_id_proyecto) 
   {
      global $tot_id_proyecto, $id_proyecto, $id_usuario, $id_actividad, $current_status_id;
      $tot_id_proyecto = array() ;  
      $nm_comando = "select count(*), sum(intervalo) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']; 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'])) 
      { 
         $nm_comando .= " where " .  $this->Sc_groupby_appointment_start_date . $arg_sum_appointment_start_date . " and id_usuario" . $arg_sum_id_usuario . " and id_proyecto" . $arg_sum_id_proyecto ; 
      } 
      else 
      { 
         $nm_comando .= " and " .  $this->Sc_groupby_appointment_start_date . $arg_sum_appointment_start_date . " and id_usuario" . $arg_sum_id_usuario . " and id_proyecto" . $arg_sum_id_proyecto ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_id_proyecto[0] = NM_encode_input(sc_strip_script($id_proyecto)) ; 
      $tot_id_proyecto[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_id_proyecto[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
   } 

   //-----  appointment_start_date
   function quebra_appointment_start_date_sc_free_group_by($appointment_start_date, $Where_qb, $Cmp_Name) 
   {
      $Var_name_gb = "SC_tot_" . $Cmp_Name;
      global $$Var_name_gb, $id_proyecto, $id_usuario, $id_actividad, $current_status_id;
      $tot_appointment_start_date = array() ;  
      $nm_comando = "select count(*), sum(intervalo) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']; 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'])) 
      { 
         $nm_comando .= " where " . $Where_qb ; 
      } 
      else 
      { 
         $nm_comando .= " and " . $Where_qb ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_appointment_start_date[0] = NM_encode_input(sc_strip_script($appointment_start_date)) ; 
      $tot_appointment_start_date[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_appointment_start_date[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
      $$Var_name_gb = $tot_appointment_start_date;
   } 

   //-----  id_usuario
   function quebra_id_usuario_sc_free_group_by($id_usuario, $Where_qb, $Cmp_Name) 
   {
      $Var_name_gb = "SC_tot_" . $Cmp_Name;
      global $$Var_name_gb, $id_proyecto, $id_usuario, $id_actividad, $current_status_id;
      $tot_id_usuario = array() ;  
      $nm_comando = "select count(*), sum(intervalo) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']; 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'])) 
      { 
         $nm_comando .= " where " . $Where_qb ; 
      } 
      else 
      { 
         $nm_comando .= " and " . $Where_qb ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_id_usuario[0] = NM_encode_input(sc_strip_script($id_usuario)) ; 
      $tot_id_usuario[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_id_usuario[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
      $$Var_name_gb = $tot_id_usuario;
   } 

   //-----  id_actividad
   function quebra_id_actividad_sc_free_group_by($id_actividad, $Where_qb, $Cmp_Name) 
   {
      $Var_name_gb = "SC_tot_" . $Cmp_Name;
      global $$Var_name_gb, $id_proyecto, $id_usuario, $id_actividad, $current_status_id;
      $tot_id_actividad = array() ;  
      $nm_comando = "select count(*), sum(intervalo) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']; 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'])) 
      { 
         $nm_comando .= " where " . $Where_qb ; 
      } 
      else 
      { 
         $nm_comando .= " and " . $Where_qb ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_id_actividad[0] = NM_encode_input(sc_strip_script($id_actividad)) ; 
      $tot_id_actividad[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_id_actividad[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
      $$Var_name_gb = $tot_id_actividad;
   } 

   //-----  id_proyecto
   function quebra_id_proyecto_sc_free_group_by($id_proyecto, $Where_qb, $Cmp_Name) 
   {
      $Var_name_gb = "SC_tot_" . $Cmp_Name;
      global $$Var_name_gb, $id_proyecto, $id_usuario, $id_actividad, $current_status_id;
      $tot_id_proyecto = array() ;  
      $nm_comando = "select count(*), sum(intervalo) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq']; 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['reporte_tracking']['where_pesq'])) 
      { 
         $nm_comando .= " where " . $Where_qb ; 
      } 
      else 
      { 
         $nm_comando .= " and " . $Where_qb ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_id_proyecto[0] = NM_encode_input(sc_strip_script($id_proyecto)) ; 
      $tot_id_proyecto[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_id_proyecto[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
      $$Var_name_gb = $tot_id_proyecto;
   } 

   function Ajust_statistic($comando)
   {
      if ((isset($this->Ini->nm_bases_vfp) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp)) || (isset($this->Ini->nm_bases_odbc) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_odbc)))
      {
          $comando = str_replace(array('count(distinct ','varp(','stdevp(','variance(','stddev('), array('sum(','sum(','sum(','sum(','sum('), $comando);
      }
      if ($this->Ini->nm_tp_variance == "P")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
      }
      if ($this->Ini->nm_tp_variance == "A")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
      }
      return $comando;
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
}

?>
