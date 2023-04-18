<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Marca;

///VALIDACAO DO CODIGO
if(!isset($_GET['codmarca']) or !is_numeric($_GET['codmarca'])){
    header('location: marca_listar.php?status=error');
    exit;
  }
  
  //CONSULTA A MARCA
  $objMarca = Marca::getMarca($_GET['codmarca']);//instancia da vaga
  
  //VALIDACAO DA MARCA
  if(!$objMarca instanceof Marca){
    header('location: marca_listar.php?status=error');
    exit;
  }


//VALIDACAO DO POST
if(isset($_POST['excluir'])){
  
  $objMarca->excluir();

  header('location: marca_listar.php?status=success');
  exit;
}

include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/marca_conf.php';
include __DIR__.'/public/includes/footer.php';