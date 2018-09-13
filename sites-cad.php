<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Sites</h2></div>
    <div class="col-md-6"><a href="/npi/sites" class="btn btn-default pull-right">Voltar</a></div>
  </div>
</div>

<div class="col-md-12">

<form role="form" method="post" action="sites-actions.php?acao=inserir" enctype="multipart/form-data">
  <div class="form-group">
    <label>Categoria</label>
    <select class="form-control" name="id_categoria" ><?php echo select_categoria(); ?></select>
  </div>
  <div class="form-group">
    <label>Site</label>
    <input type="text" class="form-control" name="site" placeholder="Site" />
  </div>
  <div class="form-group">
    <label>Arquivo</label>
    <code><textarea class="form-control" name="arquivo" id="" cols="30" rows="10"></textarea></code>
  </div>

  <button type="submit" class="btn btn-primary">Salvar</button>
</form>

</div>