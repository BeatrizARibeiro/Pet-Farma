<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar Espécie');

use \App\Entity\Especie;
$objEspe = new Especie;

//VALIDACAO DO POST
if(isset($_POST['nome_espe'])){

    $objEspe->nome_espe = $_POST['nome_espe'];
    $objEspe->cadastrar();

    header('location: espe_listar.php?status=success');
     exit;
}

include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/espe_form.php';
include __DIR__.'/public/includes/footer.php';