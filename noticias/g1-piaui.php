<?php

  //Limpra variaveis
  $site_nome = ''; $site_link = ''; $html = ''; $article = ''; $item = ''; $articles = '';

  $site_nome = 'G1 Piau&iacute;';
  $site_link = 'http://g1.globo.com/pi/piaui/';

  $html = file_get_html($site_link.'/');

  //Manchete
  foreach($html->find('.carrossel-destaques .chamadas .item') as $article) {
      $aux              = utf8_decode( $article->find('p.titulo', 0)->plaintext );
      $aux              .=': '.utf8_decode( $article->find('p.subtitulo', 0)->plaintext );
      $item['title']    = $aux;
      $item['link']     = $article->find('a', 0)->href;
      $item['image']    = $article->find('img', 0)->src;
      $articles[] = $item['title'] != '' ? $item : '';
  }

  //Slideshow
  foreach($html->find('#destaques-regiao .chamadas') as $article2) {
      $item['title']     = utf8_decode( $article2->find('p.titulo', 0)->plaintext );
      $item['link']     = $article2->find('a', 0)->href;
      $item['image']    = $article2->find('img', 0)->src;
      $articles[] = $item['title'] != '' ? $item : '';
  }


  //BOM DIA PIAUI TV
  //**********************************

  $site_link = ''; $html = ''; $item = '';

  $site_link = 'http://g1.globo.com';
  $html = file_get_html($site_link.'/pi/piaui/bom-dia-piaui/videos/');

  foreach($html->find('#trilhos .video-container ul li') as $article2) {
      $item['title']     = utf8_decode( $article2->find('img', 0)->alt );
      $item['link']     = $site_link.$article2->find('a', 0)->href;
      $item['image']    = $article2->find('img', 0)->src;
      $articles[] = $item['title'] != '' ? $item : '';
  }


  //Piaui TV 1к Ediчуo
  //*********************************

  $site_link = ''; $html = ''; $item = '';

  $site_link = 'http://g1.globo.com';
  $html = file_get_html($site_link.'/pi/piaui/pitv-1edicao/videos/');

  foreach($html->find('#trilhos .video-container ul li') as $article2) {
      $item['title']     = utf8_decode( $article2->find('img', 0)->alt );
      $item['link']     = $site_link.$article2->find('a', 0)->href;
      $item['image']    = $article2->find('img', 0)->src;
      $articles[] = $item['title'] != '' ? $item : '';
  }



  $articles = array_filter($articles);

  foreach($articles as $noticia){
    $titulo = addslashes($noticia['title']);
    $link = $noticia['link'];
    $image = $noticia['image'] != '' ? $noticia['image'] : '';

    if(!verificar($link)){
      mysql_query("INSERT INTO noticias (id_categoria, id_site, titulo, image, link, fonte, data, status) VALUES ('$categoria', '$site', '$titulo', '$image', '$link', '$site_nome', NOW(), '1')");
    }
  }

?>