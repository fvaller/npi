<?php

  //Limpra variaveis
  $site_nome = ''; $site_link = ''; $html = ''; $article = ''; $item = ''; $articles = '';

  $site_nome = 'UOL';
  $site_link = 'http://www.uol.com.br';

  $html = file_get_html($site_link.'/');

  //Destaques
  foreach($html->find('ul[class*=carousel-inner] li') as $article2) {
      $item['title']     = utf8_decode( $article2->find('span', 0)->plaintext );
      $item['link']     = $article2->find('a', 0)->href;
      $item['image']    = $article2->find('img', 0)->src;
      $item['site']     = 'UOL Destaques';
      $articles[] = $item['title'] != '' ? $item : '';
  }


  //Mais lidas do dia
  $html = ''; $article = ''; $item = '';

  $html = file_get_html('http://noticias.uol.com.br//');

  foreach($html->find('ol[class=lst-wrapper] li') as $article2) {
      $item['title']   = utf8_decode( $article2->find('.texto', 0)->plaintext );
      $item['link']    = $article2->find('a', 0)->href;
      $item['image']   = $article2->find('img', 0)->src;
      $item['site']    = 'UOl +lidas';

      $articles[] = $item['title'] != '' ? $item : '';

      $z++; if($z == 5)break;
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