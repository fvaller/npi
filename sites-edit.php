<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Sites / Editar</h2></div>
    <div class="col-md-6"><a href="/npi/sites" class="btn btn-default pull-right">Voltar</a></div>
  </div>
</div>

<div class="col-md-12">

<?php
   $id = anti_injection($_GET['id']);

   $res = mysql_query("SELECT * FROM sites WHERE id_site = '$id'");
   $res_t = mysql_num_rows($res);

   if($res_t > 0){
     $row = mysql_fetch_assoc($res);
   }
?>

<form role="form" method="post" action="sites-actions.php?acao=editar" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id;  ?>" />
  <div class="form-group">
    <label>Categoria</label>
    <select class="form-control" name="id_categoria" ><?php echo select_categoria($row['id_categoria']); ?></select>
  </div>
  <div class="form-group">
    <label>Site</label>
    <input type="text" class="form-control" name="site" value="<?php echo $row['site']; ?>" />
  </div>
  <div class="form-group">
    <label>Arquivo</label>
    <code><textarea class="form-control" name="arquivo" id="" cols="30" rows="10"><?php echo $row['arquivo']; ?></textarea></code>
  </div>
  <div class="form-group">
    <label>Status</label>
    <select class="form-control" name="status" id="">
      <option <?php echo selected($row['status'], 1); ?> value="1">Ativo</option>
      <option <?php echo selected($row['status'], 2); ?> value="2">Desativado</option>
    </select>
  </div>

  <div class="form-group">
    <label>Data_update</label>
    <input type="text" class="form-control" name="data_update" value="<?php echo $row['data_update']; ?>" />
  </div>

  <button type="submit" class="btn btn-primary">Salvar</button>
</form>

</div>