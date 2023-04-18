<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar Categoria');

use \App\Entity\Categoria;

//validacao do id
if(!isset($_GET['codcate']) or !is_numeric($_GET['codcate'])){
  header('location: cate_listar.php?status=error');
  exit;
}

//Consulta a categoria
$objCate = Categoria::getCategoria($_GET['codcate']);//instancia da vaga

//validacao da instancia
if(!$objCate instanceof Categoria){
  header('location: cate_listar.php?status=error');
  exit;
}

//validacao do post
if(isset($_POST['nome_cate'])){
  $objCate->nome_cate    = $_POST['nome_cate'];
  $objCate->atualizar();

  header('location: cate_listar.php?status=success');
  exit;
}

include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/cate_form.php';
include __DIR__.'/public/includes/footer.php';