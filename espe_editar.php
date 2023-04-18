<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar Espécie');

use \App\Entity\Especie;

//validacao do codigo
if(!isset($_GET['codespe']) or !is_numeric($_GET['codespe'])){
  header('location: espe_listar.php?status=error');
  exit;
}

//CONSULTA A ESPECIE
$objEspe = Especie::getEspecie($_GET['codespe']);//instancia da vaga

//VALIDCAO DA ESPECIE
if(!$objEspe instanceof Especie){
  header('location: espe_listar.php?status=error');
  exit;
}

//VALIDACAO DO POST
if(isset($_POST['nome_espe'])){
  $objEspe->nome_espe   = $_POST['nome_espe'];
  $objEspe->atualizar();

  header('location: espe_listar.php?status=success');
  exit;
}

include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/espe_form.php';
include __DIR__.'/public/includes/footer.php';