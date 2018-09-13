<?php

  //Limpra variaveis
  $site_nome = ''; $site_link = ''; $html = ''; $article = ''; $item = ''; $articles = '';

  $site_nome = 'MSN Brasil';
  $site_link = 'http://exame.abril.com.br/noticias';

  $html = file_get_html($site_link.'/');

  //Destaques
  foreach($html->find('#col-principal .all-articles .box-content') as $article2) {
      $item['title']     = trim( utf8_decode( $article2->find('.title', 0)->plaintext ) );
      $item['link']     = $article2->find('a', 0)->href;
      $item['image']    = $article2->find('img', 0)->src;
      $item['site']     = 'Exame';
      $articles[] = $item['title'] != '' ? $item : '';
  }

  $articles = array_filter($articles);

  foreach($articles as $noticia){
    $titulo = addslashes($noticia['title']);
    $link = 'http://exame.abril.com.br'.$noticia['link'];
    $image = $noticia['image'] != '' ? $noticia['image'] : '';
    $image = str_replace('_80_','_300_', $image);
    $site_nome = $noticia['site'];

    if(!verificar($link)){
      mysql_query("INSERT INTO noticias (id_categoria, id_site, titulo, image, link, fonte, data, status) VALUES ('$categoria', '$site', '$titulo', '$image', '$link', '$site_nome', NOW(), '1')");
    }
  }

?>