<?php

  //Limpra variaveis
  $site_nome = ''; $site_link = ''; $html = ''; $article = ''; $item = ''; $articles = '';

  $site_nome = 'Oficina da Net';
  $site_link = 'http://www.oficinadanet.com.br';

  $html = file_get_html($site_link.'/');

  //Destaques
  foreach($html->find('.lista_home_down li') as $article2) {
      $item['title']     = utf8_decode( $article2->find('h2', 0)->plaintext );
      $item['link']     = $article2->find('a', 0)->href;
      $item['image']    = $article2->find('img', 0)->src;
      $item['site']     = 'Oficina da Net';
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