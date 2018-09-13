<?php

  include '../incs/simple_html_dom.php';

  //Limpra variaveis
  $site_nome = ''; $site_link = ''; $html = ''; $article = ''; $item = ''; $articles = '';

  $site_nome = 'UOL';
  $site_link = 'http://vidadeprogramador.com.br/';

  $html = file_get_html($site_link.'/');

  //Videos
  foreach($html->find('article') as $article2) {
      $item['title']     = trim(utf8_decode( $article2->find('h2', 0)->plaintext ));
      $item['link']     = $article2->find('a', 0)->href;
      $item['image']    = $article2->find('img', 0)->src;
      $articles[] = $item['title'] != '' ? $item : '';
      //$articles[] = $item;

      $z++; if($z == 5)break;
  }
  $articles = array_filter($articles);


  echo '<pre>'; print_r($articles); echo '</pre>';

  print_r(json_encode($articles));


//  foreach($articles as $noticia){
//    $titulo = addslashes($noticia['title']);
//    $link = 'http://g1.globo.com'.$noticia['link'];
//    $image = $noticia['image'] != '' ? $noticia['image'] : '';
//
//    if(!verificar($link)){
//      mysql_query("INSERT INTO noticias (titulo, image, link, fonte, data, status) VALUES ('$titulo', '$image', '$link', '$site_nome', NOW(), '1')");
//    }
//  }

?>