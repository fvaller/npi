<?php

function anti_injection($sql){
  $sql = preg_replace(sql_regcase("/(http|www|wget|from|select|insert|delete|where|.dat|.txt|.gif|drop table|show tables| or |#|\*|--|\\\\)/"),"",$sql);
  $sql = trim($sql);
  $sql = strip_tags($sql);
  $sql = addslashes($sql);
  return $sql;
}

function verificar($link){
  $res = mysql_query("SELECT COUNT(id_noticia) FROM noticias WHERE link = '$link' LIMIT 1");
  $res = mysql_fetch_array($res);
  return $res[0];
}

function data_sub($date, $dia, $mes='', $ano='') {

  $aux = explode(' ', $date);
  $d = explode('-', $aux[0]);
  $t = explode(':', $aux[1]);

  $nextdate = mktime ( $t[0], $t[1], $t[2], $d[1]-$mes, $d[2]-$dia, $d[0]-$ano );

  return strftime("%Y-%m-%d %H:%M:%S", $nextdate);
}

function time_sub($time_ini, $time_out) {

  $t_ini = explode(':', $time_ini);
  $t_out = explode(':', $time_out);

  $nextdate = mktime ( $t_out[0] - $t_ini[0], $t_out[1] - $t_ini[1], $t_out[2] - $t_ini[2], 0, 0, 0 );

  return strftime("%H:%M:%S", $nextdate);
}

function data_hora($valor){
  if($valor != '0000-00-00 00:00:00'){
    $data = date("d/m/Y", strtotime($valor));
    $hora = date("G:i:s", strtotime($valor));
    return $data . ' ' .$hora;
  }else{
    return '-';
  }
}

function data_hora2($valor){
  $data_hoje = date("d/m");
  if($valor != '0000-00-00 00:00:00'){
    $data = date("d/m", strtotime($valor));
    if($data == $data_hoje){ $data = ''; }
    $hora = date("G:i", strtotime($valor));
    return $data . ' ' .$hora;
  }else{
    return '-';
  }
}

function text_limit($texto, $qtd) {
  $texto = explode(" ", $texto);
  $texto = preg_replace("/<(\/)?p>/i", "", $texto);
  for ($i=0;$i<$qtd;$i++) {
    $texto_ok = $texto_ok." ".$texto[$i];
  }
  $texto_ok = trim($texto_ok);
  $texto_ok = $texto_ok."";
  $texto_ok = trim($texto_ok);
  $texto_ok = strip_tags($texto_ok);
  return "$texto_ok";
}

function RemoveAcentos($str, $enc = 'iso-8859-1'){

  $acentos = array(
      'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
      'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
      'C' => '/&Ccedil;/',
      'c' => '/&ccedil;/',
      'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
      'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
      'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
      'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
      'N' => '/&Ntilde;/',
      'n' => '/&ntilde;/',
      'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
      'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
      'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
      'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
      'Y' => '/&Yacute;/',
      'y' => '/&yacute;|&yuml;/',
      'a.' => '/&ordf;/',
      'o.' => '/&ordm;/'
  );

    return preg_replace($acentos, array_keys($acentos), htmlentities($str,ENT_NOQUOTES, $enc));
}

function RemovePontuacao($string){
  $especiais= Array(".",",",";","!","@","#","%","¨","*","(",")","+","-","=",
  "§","$","|","\\",":","/","<",">","?","{","}","[","]","&","'",'"',"´","`","?",'“','”');
  $string = str_replace($especiais,"",trim($string));
  return $string;
}

function file_name($titulo){
  $titulo = RemoveAcentos($titulo);
  $titulo = RemovePontuacao($titulo);
  $titulo = strtolower($titulo);
  $titulo = str_replace('  ',' ', $titulo);
  $new_url = str_replace(' ', '-', $titulo);
  $new_url = $new_url;
  return $new_url;
}


function site_get($id, $campo = 'site'){
  $res = mysql_query("SELECT * FROM sites WHERE id_site = '$id'");
  $row = mysql_fetch_assoc($res);
  return $row[$campo];
}

function categoria_get($id, $campo = 'categoria'){
  $res = mysql_query("SELECT * FROM categorias WHERE id_categoria = '$id'");
  $row = mysql_fetch_assoc($res);
  return $row[$campo];
}

function categoria_get_where($where, $campo = 'id_categoria'){
  $res = mysql_query("SELECT * FROM categorias WHERE ".$where."");
  $row = mysql_fetch_assoc($res);
  return $row[$campo];
}

function get_noticia($id, $campo = 'link'){
  $res = mysql_query("SELECT * FROM noticias WHERE id_noticia = '$id'");
  $row = mysql_fetch_assoc($res);
  return $row[$campo];
}

function image_base64($imagem){
  $imagem = file_get_contents($imagem);
  $img = base64_encode($imagem);
  return 'data:image/png;base64,'.$img;
}

function image_save($imagem, $title){
  $url = ($imagem);
  preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $url, $ext);

  if($ext[1]){
    //$nome =  uniqid(time()).'.'.$ext[1];
    $nome =  file_name($title).'.'.$ext[1];
    $conteudo = file_get_contents($url);
    if(file_put_contents('uploads/'.$nome, $conteudo, FILE_APPEND)){ return $nome; }
  }else{ return $imagem; }
}

function get_imagem($url){

  $html = file_get_html($url);
  foreach($html->find('#materia-texo') as $article) {
      $item['image']    = $article->find('img', 0)->src;
  }

  return $item['image'];
}

function location($url){
  echo '<script>location.href = "'.$url.'";</script>';
  exit;
}

function site_data_update($id_site){
  mysql_query("UPDATE sites SET data_update = NOW() WHERE id_site = '$id_site' LIMIT 1");
}

function log_server($url){
  mysql_query("INSERT INTO log (url, data) VALUES ('$url', NOW())");
}

function get_config($id, $campo = 'word_bad'){
  $res = mysql_query("SELECT * FROM config WHERE id_config = '$id'");
  $row = mysql_fetch_assoc($res);
  return $row[$campo];
}

function noticia_filtro($texto){

  $r = True;
  //Remove a pontuação
  $pontuacao = Array(".",",",";","!","@","#","%","¨","*","(",")","+","=","§","$","|","\\",":","/","<",">","?","{","}","[","]","&","'",'"',"´","`","?",'“','”','"',"'");
  $texto = str_replace($pontuacao,"",trim($texto));

  //Remove os acentos
  $texto = RemoveAcentos($texto);

  //Palavras proibidas
  $badwords_str = get_config(1);
  $badwords0 = explode(',', $badwords_str);

  $text_w = str_word_count(strtolower($texto), 1);

  foreach($text_w as $word){
    if(in_array($word, $badwords0) ){
      $proibidas[] = $word;
    }
  }

  $qtd = count($proibidas);

  return $qtd;
}

function desabilitar_noticias_filtro(){
  $hoje = date("Y-m-d 00:00:00");
  $data = data_sub($hoje, 4);

  $res = mysql_query("SELECT id_noticia, titulo FROM noticias WHERE data >= '$data'");
  while($row = mysql_fetch_assoc($res)){
    $titulo = $row['titulo'];
    $id = $row['id_noticia'];

    if(noticia_filtro($titulo) > 0 )
      mysql_query("UPDATE noticias SET status = '2' WHERE id_noticia = '$id' LIMIT 1");
  }
}

function select_categoria($selected = ''){
  $res = mysql_query("SELECT * FROM categorias ORDER BY id_categoria ASC");
  while($row = mysql_fetch_assoc($res)){
    $sel = $selected == $row['id_categoria'] ? 'selected="selected"' : '';
    $op .= '<option '.$sel.' value="'.$row['id_categoria'].'">'.$row['categoria'].'</option>';
  }
  return $op;
}

function selected($v1, $v2){
  $r = $v1 == $v2 ? 'selected="selected"' : '';
  return $r;
}

?>