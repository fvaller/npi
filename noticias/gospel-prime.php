<?php

  //Limpra variaveis
  $site_nome = ''; $site_link = ''; $html = ''; $article = ''; $item = ''; $articles = '';

  $site_link = 'http://noticias.gospelprime.com.br';

  $html = file_get_html($site_link.'/');

  foreach($html->find('.cbox .link1') as $article) {
      $item['title']     = trim(utf8_decode( $article->find('h2', 0)->plaintext ));
      $item['link']     = $article->href;
      $item['image']    = $article->find('img', 0)->src;
      $item['site']     = 'Gospel Prime';
      $articles[] = $item['title'] != '' ? $item : '';
  }

  foreach($html->find('.cbox .link2') as $article2) {
      $item['title']     = trim(utf8_decode( $article2->find('h2', 0)->plaintext ));
      $item['link']     = $article2->href;
      $item['image']    = $article2->find('img', 0)->src;
      $item['site']     = 'Gospel Prime';
      $articles[] = $item['title'] != '' ? $item : '';
  }

  foreach($html->find('.cbox .link3') as $article3) {
      $item['title']     = trim(utf8_decode( $article3->find('h2', 0)->plaintext ));
      $item['link']     = $article3->href;
      $item['image']    = $article3->find('img', 0)->src;
      $item['site']     = 'Gospel Prime';
      $articles[] = $item['title'] != '' ? $item : '';
  }

  $articles = array_filter($articles);

  foreach($articles as $noticia){
    $titulo = addslashes($noticia['title']);
    $link = $noticia['link'];
    $image = $noticia['image'] != '' ? $noticia['image'] : '';
    $site_nome = $noticia['site'];

    if(!verificar($link)){
      mysql_query("INSERT INTO noticias (id_categoria, id_site, titulo, image, link, fonte, data, status) VALUES ('$categoria', '$site', '$titulo', '$image', '$link', '$site_nome', NOW(), '1')");
    }
  }

?>