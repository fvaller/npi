<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Categorias</h2></div>
    <div class="col-md-6"><a class="btn btn-default pull-right" href="/npi/categorias">Voltar</a></div>
  </div>
</div>

<div class="col-md-12">

<?php
   $id = anti_injection($_GET['id']);

   $res = mysql_query("SELECT * FROM categorias WHERE id_categoria = '$id'");
   $res_t = mysql_num_rows($res);

   if($res_t > 0){
     $row = mysql_fetch_assoc($res);
   }
?>

  <form role="form" method="post" action="categorias-actions.php?acao=editar" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id;  ?>" />
    <div class="form-group">
      <label>Categoria</label>
      <input type="text" class="form-control" name="categoria" value="<?php echo $row['categoria']; ?>" />
    </div>
    <div class="form-group">
      <label>Arquivo</label>
      <input type="text" class="form-control" name="arquivo" value="<?php echo $row['arquivo']; ?>" />
    </div>
    <div class="form-group">
      <label>Status</label>
      <input type="text" class="form-control" name="status" value="<?php echo $row['status']; ?>" />
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>