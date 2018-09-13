<?php
  //if($_GET['id']){
    header('Content-Type: image/jpeg');
    include('incs/SimpleImage.php');
    $image = new SimpleImage();

    $img = 'uploads/'.$_GET['id'].'.jpg';

    $image->load($_GET['img']);
    $image->resizeToWidth(130);
    //$image->save($img);
    $image->output();

    //if(!file_exists($img)){

    //}else{
    //  $image->load($img);
    //  $image->output();
    // }
   //}
  exit;
?>