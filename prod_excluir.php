<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Prod_Cate;
use \App\Entity\Produto;

// VALIDACAO DO CODIGO
if(!isset($_GET['codprod']) or !is_numeric($_GET['codprod'])){
  header('location: prod_listar.php?status=error');
  exit;
}

//CONSULTA O PRODUTO
$objProd = Produto::getProduto($_GET['codprod']);//instancia do produto

$objProd_Cate = new Prod_Cate;

//VALIDACAO DA INSTANCIA
if(!$objProd instanceof Produto){
    header('location: prod_listar.php?status=error');
    exit;
}

//VALIDACAO DO POST
if(isset($_POST['excluir'])){
    $objProd_Cate->excluir($_GET['codprod']);
    $objProd->excluir();
    unlink("./public/img/".$objProd->imagem."");
    

  header('location: prod_listar.php?status=success');
  exit;
}


include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/prod_conf.php';
include __DIR__.'/public/includes/footer.php';