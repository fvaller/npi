<div class="col-md-12 comandos">
  <div class="row">
    <div class="col-md-6"><h2>Notícias</h2></div>
    <div class="col-md-6">
      <form class="form form-inline pull-right" method="post" action="/npi/noticias/">
        <div class="form-group">
          <input type="text" class="form-control" size="60" name="q" placeholder="Pesquisar" value="<?php echo $_POST['q'] != '' ? $_POST['q'] : ''; ?>" />
        </div>
        <button class="btn btn-default">Pesquisar</button>
      </form>
    </div>
  </div>
</div>

<div class="col-md-12">


  <table class="table table-striped">
    <thead>
      <tr>
       <th>ID</th>
      <th>Image</th>
      <th>Categoria</th>
      <th>Site</th>
      <th style="width: 400px;">Titulo</th>

      <th>Fonte</th>
      <th>Data</th>
      <th>Status</th>

       <th colspan="2">Ação</th>
      </tr>
    </thead>
    <tbody>

<?php
   include 'incs/paginations.php';

  if($_REQUEST['q']){
    $q = $_REQUEST['q'];

    $q = explode(":", $q);
    switch($q[0]){
      case 'categoria': $where = "WHERE id_categoria = '$q[1]'";  break;
      case 'site': $where = "WHERE id_site = '$q[1]'";  break;
      case 'status': $where = "WHERE status = '$q[1]'";  break;
      default :  $where = " WHERE id_noticia = '$q[0]' OR titulo LIKE '%$q[0]%'"; break;
    }

    $res = mysql_query("SELECT * FROM noticias ".$where." ORDER BY id_noticia DESC");
    $res = array('sql'=>$res);

  }else{ $res = mysql_query_pages("SELECT * FROM noticias ".$where." ORDER BY id_noticia DESC", 10, 'sim'); }


   //$res = mysql_query("SELECT * FROM noticias ORDER BY id_noticia DESC");
   $res_t = mysql_num_rows($res['sql']);
   if($res_t > 0){
     while($row = mysql_fetch_assoc($res['sql'])){
       $status = $row['status'] == 1 ? 'disable' : 'enable';
?>
        <tr class="<?php echo $row['status'] == 2 ? 'warning' : ''; ?>" id="<?php echo $row['id_noticia']; ?>">
          <td><?php echo $row['id_noticia']; ?></td>
          <td><img src="<?php echo $row['image']; ?>" width="80" alt=""></td>
          <td><?php echo categoria_get($row['id_categoria']); ?></td>
          <td><?php echo site_get($row['id_site']); ?></td>
          <td><?php echo $row['titulo']; ?></td>
          <td><?php echo $row['fonte']; ?></td>
          <td><?php echo $row['data']; ?></td>
          <td class="<?php echo $row['id_noticia']; ?>st"><?php echo $row['status']; ?></td>

          <td>
            <a class="btn" id="<?php echo $row['id_noticia']; ?>bt" rel="<?php echo $status; ?>" title="Habilitar / Desabilitar" href="javascript:void(0);" onclick="status(<?php echo $row['id_noticia']; ?>)"><span class="glyphicon glyphicon-remove-circle"></span></a>

            <a class="btn" title="Editar" href="/npi/?p=noticias-edit&id=<?php echo $row['id_noticia']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
            <a class="btn" title="Excluir" href="javascript:void(0);" onclick="del(<?php echo $row['id_noticia']; ?>)"  ><span class="glyphicon glyphicon-trash"></span></a>
          </td>
        </tr>
<?php } } ?>
      </tbody>
    </table>

  <div class="text-center"><?php echo $res['pages']; ?></div>

</div>