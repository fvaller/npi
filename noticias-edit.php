<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Notícias</h2></div>
    <div class="col-md-6"><a class="btn btn-default pull-right" href="/npi/noticias">Voltar</a></div>
  </div>
</div>

<div class="col-md-12">

<?php
   $id = anti_injection($_GET['id']);

   $res = mysql_query("SELECT * FROM noticias WHERE id_noticia = '$id'");
   $res_t = mysql_num_rows($res);

   if($res_t > 0){
     $row = mysql_fetch_assoc($res);
   }
?>

<form role="form" method="post" action="noticias-actions.php?acao=editar" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id;  ?>" />
<div class="form-group">
  <label>Id_categoria</label>
  <input type="text" class="form-control" name="id_categoria" value="<?php echo $row['id_categoria']; ?>" />
</div>
<div class="form-group">
  <label>Id_site</label>
  <input type="text" class="form-control" name="id_site" value="<?php echo $row['id_site']; ?>" />
</div>
<div class="form-group">
  <label>Titulo</label>
  <input type="text" class="form-control" name="titulo" value="<?php echo $row['titulo']; ?>" />
</div>
<div class="form-group">
  <label>Image</label>
  <input type="text" class="form-control" name="image" value="<?php echo $row['image']; ?>" />
</div>
<div class="form-group">
  <label>Link</label>
  <input type="text" class="form-control" name="link" value="<?php echo $row['link']; ?>" />
</div>
<div class="form-group">
  <label>Fonte</label>
  <input type="text" class="form-control" name="fonte" value="<?php echo $row['fonte']; ?>" />
</div>
<div class="form-group">
  <label>Data</label>
  <input type="text" class="form-control" name="data" value="<?php echo $row['data']; ?>" />
</div>
<div class="form-group">
  <label>Tipo</label>
  <input type="text" class="form-control" name="tipo" value="<?php echo $row['tipo']; ?>" />
</div>
<div class="form-group">
  <label>Status</label>
  <input type="text" class="form-control" name="status" value="<?php echo $row['status']; ?>" />
</div>

  <button type="submit" class="btn btn-primary">Salvar</button>
</form>

</div>