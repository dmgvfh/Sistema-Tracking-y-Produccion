<?php
class app_grid_sec_users_lookup
{
//  
   function lookup_id_empresa(&$conteudo , $id_empresa) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $id_empresa; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($id_empresa) === "" || trim($id_empresa) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select razon_social from companias where id = $id_empresa order by razon_social" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = trim($rx->fields[0]); 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_is_active(&$is_active) 
   {
      $conteudo = "" ; 
      if ($is_active == "Y")
      { 
          $conteudo = "SI";
      } 
      if ($is_active == "N")
      { 
          $conteudo = "NO";
      } 
      if (!empty($conteudo)) 
      { 
          $is_active = $conteudo; 
      } 
   }  
//  
   function lookup_perfil(&$conteudo , $login, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      $conteudo = "";
      $nm_comando = "SELECT 
  sec_groups.description 
FROM
  sec_users_groups
  INNER JOIN sec_groups ON (sec_users_groups.group_id = sec_groups.group_id)
WHERE
  sec_users_groups.login = '" . substr($this->Db->qstr($login), 1 , -1) . "'" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          while (!$rx->EOF) 
          { 
                 if (isset($rx->fields[0]))
                 { 
                     $nm_array_retorno_lookup[$a][0] = trim($rx->fields[0]);
                     $a++; 
                     if ($y == 1)
                     { 
                          $conteudo .= "<br>";
                          $y = 0; 
                     } 
                     if ($y != 0)
                     { 
                          $conteudo .= "";
                     } 
                     $y++; 
                     $nm_tmp_form = trim($rx->fields[0]); 
                     $conteudo .= $nm_tmp_form;
                 } 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
   } 
//  
   function lookup_proyectos(&$conteudo , $id, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      if (trim($id) === "")
      { 
          $conteudo = "&nbsp;";
          return ; 
      } 
      $conteudo = "";
      $nm_comando = "SELECT 
  proyectos.nombre_proyecto
FROM
  usuarios_proyectos
  INNER JOIN proyectos ON (usuarios_proyectos.id_proyecto = proyectos.id)
WHERE
  usuarios_proyectos.id_usuario = $id AND 
  proyectos.habilitado = 1 AND 
  (proyectos.id_estado = 1 or 
  proyectos.id_estado = 2) order by  proyectos.nombre_proyecto" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          while (!$rx->EOF) 
          { 
                 if (isset($rx->fields[0]))
                 { 
                     $nm_array_retorno_lookup[$a][0] = trim($rx->fields[0]);
                     $a++; 
                     if ($y == 1)
                     { 
                          $conteudo .= "<br>";
                          $y = 0; 
                     } 
                     if ($y != 0)
                     { 
                          $conteudo .= "";
                     } 
                     $y++; 
                     $nm_tmp_form = trim($rx->fields[0]); 
                     $conteudo .= $nm_tmp_form;
                 } 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
   } 
//  
   function lookup_is_deleted(&$is_deleted) 
   {
      $conteudo = "" ; 
      if ($is_deleted == "1")
      { 
          $conteudo = "SI";
      } 
      if ($is_deleted == "0")
      { 
          $conteudo = "NO";
      } 
      if (!empty($conteudo)) 
      { 
          $is_deleted = $conteudo; 
      } 
   }  
}
?>
