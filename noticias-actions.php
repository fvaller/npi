<?php

  //funчуo e conecao com DB
  include_once('incs/functions.php');
  include_once('incs/conexao.php');

  //Trata os campos
  $acao = anti_injection($_GET['acao']);
  $id = anti_injection($_REQUEST['id']);

  //dados
  $id_categoria = $_POST['id_categoria'];
  $id_site = $_POST['id_site'];
  $titulo = $_POST['titulo'];
  $image = $_POST['image'];
  $link = $_POST['link'];
  $fonte = $_POST['fonte'];
  $data = $_POST['data'];
  $tipo = $_POST['tipo'];
  $status = $_REQUEST['status'];
  

  switch($acao){

    case 'inserir':
    mysql_query("INSERT INTO noticias (id_categoria, id_site, titulo, image, link, fonte, data, tipo, status) VALUES ('$id_categoria', '$id_site', '$titulo', '$image', '$link', '$fonte', '$data', '$tipo', '$status')");
    header("Location: principal.php?p=noticias");
    break;

    case 'editar':
    mysql_query("UPDATE noticias SET id_categoria = '$id_categoria', id_site = '$id_site', titulo = '$titulo', image = '$image', link = '$link', fonte = '$fonte', data = '$data', tipo = '$tipo', status = '$status' WHERE id_noticia = '$id'");
    header("Location: principal.php?p=noticias");
    break;

    case 'status':
    mysql_query("UPDATE noticias SET status = '$status' WHERE id_noticia = '$id' LIMIT 1");
    if($_REQUEST['r']!='nao') header("Location: principal.php?p=noticias");
    break;

    case 'excluir':
    mysql_query("DELETE FROM noticias WHERE id_noticia = '$id'");
    if($_REQUEST['r']!='nao') header("Location: principal.php?p=noticias");
    break;

  }

?>