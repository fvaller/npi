<?php
  include 'incs/conexao.php';
  include 'incs/functions.php';

  $URI = urldecode($_SERVER['REQUEST_URI']);
  $url = explode ("/", $URI);

  foreach($url as $url2){
    $url[$aux] = anti_injection($url2);
    $aux++;
  }

  $pagina = isset($_GET['p']) ? $_GET['p']: $url[2];

  include 'topo.php';

  include 'navbar.php';
?>

  <section>

    <div class="container-fluid">

      <div class="row">
      <?php
         if(!empty($pagina)){
           if(file_exists($pagina . '.php')){
             include($pagina . '.php');
           }else{ include('noticia.php');  }
         }else{ include('home.php');  }
      ?>
      </div>

    </div>

  </section>

<?php include 'rodape.php'; ?>