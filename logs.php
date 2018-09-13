<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Logs</h2></div>
    <div class="col-md-6"></div>
  </div>
</div>

<?php

  $id = $_GET['id'];
  $action = $_REQUEST['action'];

  if($action == 'del'){
    if($id){
      mysql_query("DELETE FROM log WHERE id_log = '$id' LIMIT 1");
    }
    location('/npi/logs/');
  }
?>



<div class="col-md-12">


  <table class="table table-striped">

    <thead>
      <tr>
        <th>ID</th>
        <th>Tempo</th>
        <th>IP</th>
        <th>URL</th>
        <th>Data</th>
        <th>&nbsp;</th>
      </tr>
    </thead>

    <tbody>
    <?php
      $res = mysql_query("SELECT * FROM log ORDER BY id_log DESC LIMIT 30");
      while($row = mysql_fetch_assoc($res)){
    ?>
      <tr>
        <td><?php echo $row['id_log']; ?></td>
        <?php $aux = explode(' ', $row['url']); ?>
        <td><?php echo time_sub($aux[0], $aux[1]); ?></td>
        <td><?php echo $aux[2]; ?></td>
        <td><?php echo $aux[3]; ?></td>
        <td><?php echo data_hora($row['data']); ?></td>

        <td><a href="?action=del&id=<?php echo $row['id_log']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
      </tr>
      <?php } ?>

    </tbody>

  </table>

</div>
