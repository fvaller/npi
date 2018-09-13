<?php

  $categoria_nome = $url[2] != '' ? $url[2] : 'piaui';
  $categoria_id = categoria_get_where("arquivo = '$categoria_nome'", 'id_categoria');
  if($_GET['site']){
    $site_id = anti_injection($_GET['site']);
  }

  $site_id = $site_id != '' ? $site_id : 0;

?>

  <div class="col-md-12 comandos">

        <form class="form-inline" role="form" method="get" action="/npi/<?php echo $categoria_nome; ?>/">
          <div class="form-group">
            <select name="site" id="" class="form-control">
              <option value="0">Todos</option>
            <?php
              $res = mysql_query("SELECT * FROM sites WHERE id_categoria = '$categoria_id' ORDER BY id_site ASC");
              while($row = mysql_fetch_assoc($res)){
            ?>
              <option value="<?php echo $row['id_site']; ?>" <?php if($site_id == $row['id_site'])echo 'selected="selected"'; ?>><?php echo $row['site']; ?></option>
            <?php } ?>
            </select>
          </div>
          <button type="submit" class="btn btn-default">Ok</button>
          <button onclick="update('<?php echo $categoria_nome; ?>', <?php echo $categoria_id; ?>,this.value); return false;" class="btn btn-danger pull-right" value="<?php echo $site_id; ?>"><span id="load"></span> Atualizar</button>
        </form>

  </div>

  <div class="noticias-body">

  <?php
    if($site_id){ $where = "AND id_site = '$site_id'";}

    $res = mysql_query("SELECT * FROM noticias WHERE id_categoria = '$categoria_id' ".$where." AND status = '1' ORDER BY id_noticia DESC LIMIT 12");
    while($row = mysql_fetch_assoc($res)){
  ?>
  <div class="media col-md-4 col-sm-6" id="<?php echo $row['id_noticia']; ?>">
    <div class="pull-left">
      <div class="media-image">
        <span class="hover-container">
          <img class="media-object" src="/npi/img/noimage.jpg" alt="<?php echo $row['image'] != '' ? utf8_decode($row['image']) : '/npi/img/noimage.jpg'; ?>" width="130" height="100" >
          <span class="hover">
            <a href="<?php echo $row['link']; ?>" target="_blank"><span class="glyphicon glyphicon-link"></span></a>
            <a href="/npi/noticias/?q=<?php echo $row['id_noticia']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
            <a href="javascript:void(0);" onclick="del(<?php echo $row['id_noticia']; ?>)"><span class="glyphicon glyphicon-remove-circle"></span></a>
          </span>
        </span>
      </div>
    </div>

    <div class="media-body">
      <h4 class="media-heading"><a href="<?php echo $row['link']; ?>" target="_blank"><?php echo text_limit($row['titulo'],20); ?></a></h4>
      <small><?php echo $row['fonte']; ?>,</small>
      <small><?php echo data_hora2($row['data']); ?></small>
    </div>
  </div>
  <?php } ?>


  </div>

  <div class="col-md-12">
    <button onclick="noticia_mais(<?php echo $categoria_id; ?>,<?php echo $site_id; ?>)" value="" class="btn btn-default btn-block btn-lg"><span id="load2"></span> <span class="glyphicon glyphicon-save"></span> Mais notícias</button>
  </div>
