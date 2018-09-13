<?php

  //funчуo e conecao com DB
  include_once('incs/functions.php');
  include_once('incs/conexao.php');

  //Trata os campos
  $acao = anti_injection($_GET['acao']);
  $id = anti_injection($_REQUEST['id']);

  //dados
  $id_categoria = $_POST['id_categoria'];
  $site = $_POST['site'];
  $arquivo = htmlentities($_POST['arquivo'], ENT_QUOTES); 
  $status = $_POST['status'];
  $data_update = $_POST['data_update'];
  

  switch($acao){

    case 'inserir':
    mysql_query("INSERT INTO sites (id_categoria, site, arquivo, status) VALUES ('$id_categoria', '$site', '$arquivo', '1')");
    header("Location: /npi/sites");
    break;

    case 'editar':
    mysql_query("UPDATE sites SET id_categoria = '$id_categoria', site = '$site', arquivo = '$arquivo', status = '$status', data_update = '$data_update' WHERE id_site = '$id'");
    header("Location: /npi/sites");
    break;

    case 'disable':
    mysql_query("UPDATE sites SET status = '2' WHERE id_site = '$id' LIMIT 1");
    header("Location: /npi/sites");
    break;

    case 'enable':
    mysql_query("UPDATE sites SET status = '1' WHERE id_site = '$id' LIMIT 1");
    header("Location: /npi/sites");
    break;

    case 'excluir':
    mysql_query("DELETE FROM sites WHERE id_site = '$id'");
    header("Location: /npi/sites");
    break;

  }

?>