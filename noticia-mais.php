<?php
  header('Content-Type: text/html; charset=iso-8859-1');

  include 'incs/conexao.php';
  include 'incs/functions.php';

  $id_noticia = $_GET['id'];
  $categoria_id = $_GET['categoria'];
  $site_id = $_GET['site'];

  if($site_id){ $where = "AND id_site = '$site_id'";}

  $res = mysql_query("SELECT * FROM noticias WHERE id_categoria = '$categoria_id' ".$where." AND id_noticia < '$id_noticia' AND status = '1' ORDER BY id_noticia DESC LIMIT 12");
  $res_t = mysql_num_rows($res);
  if($res_t > 0){
  while($row = mysql_fetch_assoc($res)){
?>
<div class="media col-md-4 col-sm-6" id="<?php echo $row['id_noticia'] ?>">
  <div class="pull-left">
      <div class="media-image">
        <span class="hover-container">
          <img class="media-object" src="/npi/img/noimage.jpg" alt="<?php echo $row['image'] != '' ? ($row['image']) : '/npi/img/noimage.jpg'; ?>" width="130" height="100" >
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
<?php }}else{?>
<div class="col-md-12">
  <div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Aviso!</strong> Não existem mais noticias para essa categoria ou site.
  </div>
</div>
<?php } ?>