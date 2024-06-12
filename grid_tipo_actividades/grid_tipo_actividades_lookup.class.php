<?php
class grid_tipo_actividades_lookup
{
//  
   function lookup_id_unidad_organizativa(&$conteudo , $id_unidad_organizativa) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $id_unidad_organizativa; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($id_unidad_organizativa) === "" || trim($id_unidad_organizativa) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select nombre_unidad from unidad_organizativa where id = $id_unidad_organizativa order by nombre_unidad" ; 
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
   function lookup_habilitado(&$habilitado) 
   {
      $conteudo = "" ; 
      if ($habilitado == "1")
      { 
          $conteudo = "SI";
      } 
      if ($habilitado == "0")
      { 
          $conteudo = "NO";
      } 
      if (!empty($conteudo)) 
      { 
          $habilitado = $conteudo; 
      } 
   }  
}
?>
