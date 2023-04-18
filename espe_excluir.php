<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Especie;

//validacao do codigo
if(!isset($_GET['codespe']) or !is_numeric($_GET['codespe'])){
    header('location: espe_listar.php?status=error');
    exit;
  }
  
//CONSULTA A ESPECIE
$objEspe = Especie::getEspecie($_GET['codespe']);//instancia da especie

//VALIDACAO DA ESPECIE
if(!$objEspe instanceof Especie){
  header('location: espe_listar.php?status=error');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){
  
    $objEspe->excluir();

  header('location: espe_listar.php?status=success');
  exit;
}

include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/espe_conf.php';
include __DIR__.'/public/includes/footer.php';