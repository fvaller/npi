<?php
  $HOST = "localhost"; $USER = "root"; $SENHA = "root2017"; $BD = "npi";
  $conexao = mysql_connect($HOST,$USER,$SENHA) or print (mysql_error());
  mysql_select_db($BD, $conexao) or print(mysql_error());
?>
