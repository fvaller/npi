<?php

  //Limpra variaveis
  $site_nome = ''; $site_link = ''; $html = ''; $article = ''; $item = ''; $articles = '';

  $site_link = 'http://noticias.gospelmais.com.br';

  $html = file_get_html($site_link.'/');

  foreach($html->find('.overview li') as $article) {
      $item['title']     = trim(utf8_decode( $article->find('h2', 0)->plaintext ));
      $item['link']     = $article->find('a', 0)->href;
      $item['image']    = $article->find('img', 0)->src;
      $item['site']     = 'Gospel Mais';
      $articles[] = $item['title'] != '' ? $item : '';
      $a++;if($a==6)break;
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