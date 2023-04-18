<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar Marca');

use \App\Entity\Marca;
$objMarca = new Marca;

//VALIDACAO DO POST
if(isset($_POST['nome_marca'])){

    $objMarca->nome_marca = $_POST['nome_marca'];
    $objMarca->cadastrar();

    header('location: marca_listar.php?status=success');
     exit;
}

include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/marca_form.php';
include __DIR__.'/public/includes/footer.php';