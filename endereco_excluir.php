<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Endereco;

if(!isset($_GET['codend']) or !is_numeric($_GET['codend'])){
  header('location: dados_listar.php?status=error');
  exit;
}

$obEndereco = Endereco::getEndereco($_GET['codend']);

if(!$obEndereco instanceof Endereco) {
    header ('location: index.php?status=error');
    exit;
}

if(isset($_POST['excluir'])){
    $obEndereco->excluir();
    unlink("./public/img/".$objProd->imagem."");
    

  header('location: prod_listar.php?status=success');
  exit;
}


include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/endereco_conf.php';
include __DIR__.'/public/includes/footer.php';