<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Categoria;

//validacao do id
if(!isset($_GET['codcate']) or !is_numeric($_GET['codcate'])){
  header('location: cate_listar.php?status=error');
  exit;
}

//CONSULTA A CATEGORIA
$objCate = Categoria::getCategoria($_GET['codcate']);//instancia da vaga

//VALIDACAO DA INSTANCIA
if(!$objCate instanceof Categoria){
    header('location: cate_listar.php?status=error');
    exit;
}

//VALIDACAO DO POST
if(isset($_POST['excluir'])){
  
    $objCate->excluir();

  header('location: cate_listar.php?status=success');
  exit;
}


include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/cate_conf.php';
include __DIR__.'/public/includes/footer.php';