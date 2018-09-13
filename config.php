<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Configurações</h2></div>
    <div class="col-md-6"></div>
  </div>
</div>

<?php

  $id = $_GET['id'];
  $action = $_REQUEST['action'];


  if($action == 'edit'){
    $word = $_POST['word'];

    if($word){
      mysql_query("UPDATE config SET word_bad = '$word' WHERE id_config = 1 LIMIT 1");
    }
    location('/npi/config/');
  }


  $res = mysql_query("SELECT * FROM config WHERE id_config = 1");
  $row = mysql_fetch_assoc($res);

?>


<div class="col-md-12">

      <form class="form-horizontal" role="form" action="?action=edit" method="post">

        <div class="form-group">
          <label class="col-sm-2 control-label">Palavras proibidas</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" name="word" value="<?php echo $row['word_bad']; ?>">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Salvar</button>
          </div>
        </div>
       </form>

</div>
