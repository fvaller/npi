<?php

/*
  v2.2
  Autor: Fernando Valler / fernandovaler@gmail.com / unitriade.com
  Versão: 2.1 13/06/2011
  Função: mysql_query_pages
  Retorna um array com dois itens
  ['sql'] = retorna a consulta passada com a clausula LIMIT
  ['pages'] = retorna os links das paginas

*/

function mysql_query_pages($sql, $qtd_por_pag = 10, $url = 'nao'){
  /**

    Função: mysql_query_pages
    Retorna um array com dois itens
    ['sql'] = retorna a consulta passada com a clausula LIMIT
    ['pages'] = retorna os links das paginas

    Exemplo
    $result = mysql_query_pages("SELECT * FROM noticias ORDER BY id_noticia DESC");
    $row = mysql_fetch_assoc($result['sql'])
    echo $result['pages']

  **/


  //anti_injection
  $get_pagina = $_GET['pagina'];
  $get_pagina = preg_replace(sql_regcase("/(http|www|wget|from|select|insert|delete|where|.dat|.txt|.gif|drop table|show tables| or |#|\*|--|\\\\)/"),"", $get_pagina);
  $get_pagina = trim($get_pagina);
  $get_pagina = strip_tags($get_pagina);
  $get_pagina = addslashes($get_pagina);

  // Consulta para pegar o total
  $res_total = mysql_num_rows(mysql_query("$sql"));
  $total = ceil($res_total/$qtd_por_pag);

  // Pega a pagina atual
  $pagina_sql = 0;
  $pagina = 1;
  if(isset($_GET['pagina'])){
    $pagina = (int) $get_pagina;
    if( ($pagina != 0) and ($pagina > 0) and ($pagina <= $total) ){
      $pagina_sql = ($pagina - 1) * $qtd_por_pag;
    }else{
      $pagina_sql = 0;
    }
  }

  // Consulta de retorno
  $res_consulta = mysql_query("$sql LIMIT ".$pagina_sql.",".$qtd_por_pag."");

  $enlace = 10;

   // GERA O LINK DAS PAGINAS
  if($res_total > $qtd_por_pag){

    //Determina o inicio das paginas geradas
    if($pagina + 3 < $enlace){
      $aux_pagina = 1;
    }else{
      $aux_pagina = $pagina - 4;
    }

    // Link Voltar
    if($pagina > 1){$pags .= '<li><a href="?pagina='.($pagina-1).'" >&laquo;</a></li>';}

    // Link Paginas
    for($i=$aux_pagina;$i<=$total;$i++){
      $z++;
      if($z < $enlace){
        if($pagina == $i){
          $pags .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';
        }else{
          $pags .= '<li><a href="?pagina='.$i.'" >'.$i.'</a></li>';
        }
      }
    }

    // Link Proximo
    if($pagina < $total){$pags .= '<li><a href="?pagina='.($pagina+1).'" >&raquo;</a></li>';}

    $pags = '<ul class="pagination">'.$pags.'</ul>';

  }

  return array('sql' => $res_consulta, 'pages' => $css.$pags);
}

?>