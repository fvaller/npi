<?php

  //funчуo e conecao com DB
  include_once('incs/functions.php');
  include_once('incs/conexao.php');

  //Trata os campos
  $acao = anti_injection($_GET['acao']);
  $id = anti_injection($_REQUEST['id']);

  //dados
  $categoria = $_POST['categoria'];
  $arquivo = file_name($categoria);
  $status = $_POST['status'];
  

  switch($acao){

    case 'inserir':
    mysql_query("INSERT INTO categorias (categoria, arquivo, status) VALUES ('$categoria', '$arquivo', '1')");
    header("Location: principal.php?p=categorias");
    break;

    case 'editar':
    mysql_query("UPDATE categorias SET categoria = '$categoria', arquivo = '$arquivo', status = '$status' WHERE id_categoria = '$id'");
    header("Location: principal.php?p=categorias");
    break;

    case 'disable':
    mysql_query("UPDATE categorias SET status = '2' WHERE id_categoria = '$id' LIMIT 1");
    header("Location: principal.php?p=categorias");
    break;

    case 'enable':
    mysql_query("UPDATE categorias SET status = '1' WHERE id_categoria = '$id' LIMIT 1");
    header("Location: principal.php?p=categorias");
    break;

    case 'excluir':
    mysql_query("DELETE FROM categorias WHERE id_categoria = '$id'");
    header("Location: principal.php?p=categorias");
    break;

  }

?>