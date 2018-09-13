<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Categorias</h2></div>
    <div class="col-md-6"><a class="btn btn-primary pull-right" href="/npi/categorias-cad">Cadastrar</a></div>
  </div>
</div>


<div class="col-md-12">


  <table class="table table-striped">
    <thead>
      <tr>
       <th>ID</th>
        <th>Categoria</th>
        <th>Arquivo</th>
        <th>Status</th>

       <th>Ação</th>
      </tr>
    </thead>
    <tbody>

<?php
   $res = mysql_query("SELECT * FROM categorias ORDER BY id_categoria DESC");
   $res_t = mysql_num_rows($res);
   if($res_t > 0){
     while($row = mysql_fetch_assoc($res)){
?>
        <tr>
          <td><?php echo $row['id_categoria']; ?></td>
          <td><?php echo $row['categoria']; ?></td>
          <td><?php echo $row['arquivo']; ?></td>
          <td><?php echo $row['status']; ?></td>

          <td>
          <?php if($row['status'] == 1){ ?>
          <a class="btn" title="Desabilitar" href="/npi/categorias-actions.php?acao=disable&id=<?php echo $row['id_categoria']; ?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
          <?php }else{ ?>
          <a class="btn" title="Habilitar" href="/npi/categorias-actions.php?acao=enable&id=<?php echo $row['id_categoria']; ?>"><span class="glyphicon glyphicon-ok-circle"></span></a>
          <?php } ?>

          <a class="btn" title="Editar" href="?p=categorias-edit&id=<?php echo $row['id_categoria']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
          <a class="btn" title="Excluir" href="/npi/categorias-actions.php?acao=excluir&id=<?php echo $row['id_categoria'];?>" ><span class="glyphicon glyphicon-trash"></span></a>
          </td>
        </tr>
<?php } } ?>
      </tbody>
    </table>

</div>