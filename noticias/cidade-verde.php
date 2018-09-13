<?php

  //Limpra variaveis
  $site_nome = ''; $site_link = ''; $html = ''; $article = ''; $item = ''; $articles = '';

  $site_nome = 'Cidade Verde';
  $site_link = 'http://www.cidadeverde.com';

  $html = file_get_html($site_link.'/');

  //Manchete
  foreach($html->find('#manchete') as $article) {
      $item['title']     = utf8_decode( $article->find('a h2', 0)->plaintext );
      $item['link']     = $article->find('a', 0)->href;
      $articles[] = $item['title'] != '' ? $item : '';
  }

  //Slideshow
  foreach($html->find('#fotoH3 ul li') as $article2) {
      $item['title']     = utf8_decode( $article2->find('a h3', 0)->plaintext );
      $item['link']     = $article2->find('a', 0)->href;
      $item['image']    = $article2->find('img', 0)->src;
      $articles[] = $item['title'] != '' ? $item : '';
  }

  $articles = array_filter($articles);

  foreach($articles as $noticia){
    $titulo = addslashes($noticia['title']);
    $link = $site_link.$noticia['link'];
    $image = $noticia['image'] != '' ? $site_link.$noticia['image'] : '';

    if(!verificar($link)){
      mysql_query("INSERT INTO noticias (id_categoria, id_site, titulo, image, link, fonte, data, status) VALUES ('$categoria', '$site', '$titulo', '$image', '$link', '$site_nome', NOW(), '1')");
    }
  }

?>