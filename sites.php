<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Sites</h2></div>
    <div class="col-md-6"><a href="/npi/sites-cad" class="btn btn-primary pull-right">Cadastrar</a></div>
  </div>
</div>

<div class="col-md-12">

  <table class="table table-striped">
    <thead>
      <tr>
       <th>ID</th>
        <th>Categoria</th>
        <th>Site</th>
        <th>Status</th>
        <th>Data_update</th>

       <th>Ação</th>
      </tr>
    </thead>
    <tbody>

<?php
   $res = mysql_query("SELECT * FROM sites ORDER BY id_site DESC");
   $res_t = mysql_num_rows($res);
   if($res_t > 0){
     while($row = mysql_fetch_assoc($res)){
?>
        <tr>
          <td><?php echo $row['id_site']; ?></td>
          <td><?php echo categoria_get($row['id_categoria']); ?></td>
          <td><?php echo $row['site']; ?></td>
          <td><?php echo $row['status']; ?></td>
          <td><?php echo $row['data_update']; ?></td>

          <td>
            <?php if($row['status'] == 1){ ?>
            <a class="btn" title="Desabilitar" href="/npi/sites-actions.php?acao=disable&id=<?php echo $row['id_site'];?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
            <?php }else{ ?>
            <a class="btn" title="Habilitar" href="/npi/sites-actions.php?acao=enable&id=<?php echo $row['id_site'];?>"><span class="glyphicon glyphicon-ok-circle"></span></a>
            <?php } ?>
            <a class="btn" title="Atualizar" href="javascript:void(0);" onclick="update2(<?php echo $row['id_categoria']; ?>, <?php echo $row['id_site']; ?>);" ><span class="glyphicon glyphicon-refresh"></span></a>
            <a class="btn" title="Editar" href="/npi/?p=sites-edit&id=<?php echo $row['id_site']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
            <a class="btn" title="Deletar" href="/npi/sites-actions.php?acao=excluir&id=<?php echo $row['id_site'];?>"><span class="glyphicon glyphicon-trash"></span></a>
          </td>
        </tr>
<?php } } ?>
      </tbody>
    </table>

</div>