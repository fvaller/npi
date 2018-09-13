<?php
  ini_set("max_execution_time", 120); //segundos

  header('Content-Type: text/html; charset=iso-8859-1');

  include 'incs/simple_html_dom.php';
  include 'incs/conexao.php';
  include 'incs/functions.php';

  $categoria = $_GET['categoria'];
  $site = $_GET['site'];

  $log = date("G:i:s");

  //Atualiza um site
  if($site){

    $pagina = site_get($site, 'arquivo');
    if($pagina) eval(html_entity_decode($pagina, ENT_QUOTES));

   //Atualiza todos os sites da categoria
  }elseif($categoria){

    $res = mysql_query("SELECT * FROM sites WHERE id_categoria = '$categoria' AND status = '1'");
    while($row = mysql_fetch_assoc($res)){
      $site = $row['id_site'];
      eval(html_entity_decode($row['arquivo'], ENT_QUOTES));
      desabilitar_noticias_filtro();
    }

   //Atualiza tudo
  }else{
    $res = mysql_query("SELECT id_categoria FROM categorias WHERE status = '1' ORDER BY id_categoria ASC");
    while($row = mysql_fetch_assoc($res)){

      $categoria = $row['id_categoria'];

      $res2 = mysql_query("SELECT * FROM sites WHERE id_categoria = '$categoria' AND status = '1'");
      while($row2 = mysql_fetch_assoc($res2)){

        $site = $row2['id_site'];
        eval(html_entity_decode($row2['arquivo'], ENT_QUOTES));
      }
    }
  }

  log_server( $log.' '.date("G:i:s").' '.$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_URI'] );
?>