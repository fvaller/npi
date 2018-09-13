  <nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/npi"><span class="glyphicon glyphicon-phone"></span> Notícias Piauí</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li <?php if($url[2] == '')echo 'class="active"'; ?>><a href="/npi/">Home</a></li>
          <?php
            $res = mysql_query("SELECT * FROM categorias WHERE status = '1' ORDER BY id_categoria ASC");
            while($row = mysql_fetch_assoc($res)){
          ?>
          <li <?php if($url[2] == $row['arquivo'])echo 'class="active"'; ?> ><a href="/npi/<?php echo $row['arquivo']; ?>/"><?php echo $row['categoria']; ?></a></li>
          <?php } ?>
        </ul>


        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Configurações <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="/npi/categorias/">Categorias</a></li>
              <li><a href="/npi/sites/">Sites</a></li>
              <li><a href="/npi/noticias/">Notícias</a></li>
              <li class="divider"></li>
              <li><a href="/npi/config/">Config</a></li>
              <li><a href="/npi/logs/">Logs</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>