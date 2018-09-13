<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Categorias</h2></div>
    <div class="col-md-6"><button class="btn btn-primary pull-right" data-toggle="modal" data-target=".from-modal">Cadastrar</button></div>
  </div>
</div>

<?php

  if($_POST['categoria']){
    $categoria = anti_injection($_POST['categoria']);
    $arquivo = file_name($categoria);
    if($categoria and $arquivo){
      mysql_query("INSERT INTO categorias (categoria, arquivo, status) VALUES ('$categoria', '$arquivo', '1')");
    }
    location('/npi/categorias-config/');
  }

  if($_GET['action'] == 'del'){
    $id = $_GET['id'];
    if($id){
      mysql_query("DELETE FROM categorias WHERE id_categoria = '$id' LIMIT 1");
    }
    location('/npi/categorias-config/');
  }

  if($action == 'disable'){
    if($id){
      mysql_query("UPDATE categorias SET status = '2' WHERE id_categoria = '$id' LIMIT 1");
    }
    location('/npi/categorias-config/');
  }

  if($action == 'enable'){
    if($id){
      mysql_query("UPDATE categorias SET status = '1' WHERE id_categoria = '$id' LIMIT 1");
    }
    location('/npi/categorias-config/');
  }

?>


<div class="modal fade from-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form class="form-horizontal" role="form" action="" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Cadastrar</h4>
      </div>
      <div class="modal-body">


          <div class="form-group">
            <label class="col-sm-2 control-label">Categoria</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Categoria" name="categoria">
            </div>
          </div>

          <div class="form-group hidden">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Salvar</button>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </form>
  </div>
</div>

<div class="col-md-12">

  <table class="table table-default">

    <thead>
      <tr>
        <th>ID</th>
        <th>Categoria</th>
        <th>Status</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>

    <tbody>
    <?php
      $res = mysql_query("SELECT * FROM categorias ORDER BY id_categoria ASC");
      while($row = mysql_fetch_assoc($res)){
    ?>
      <tr>
        <td><?php echo $row['id_categoria']; ?></td>
        <td><?php echo $row['categoria']; ?></td>
        <td><?php echo $row['status']; ?></td>

        <?php if($row['status'] == 1){ ?>
        <td><a href="?action=disable&id=<?php echo $row['id_categoria']; ?>" title="Desabilitar"><span class="glyphicon glyphicon-remove-circle"></span></a></td>
        <?php }else{ ?>
        <td><a href="?action=enable&id=<?php echo $row['id_categoria']; ?>" title="Ativar"><span class="glyphicon glyphicon-ok-circle"></span></a></td>
        <?php } ?>

        <td><a href="?action=del&id=<?php echo $row['id_categoria']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
      </tr>
      <?php } ?>

    </tbody>

  </table>
</div>
