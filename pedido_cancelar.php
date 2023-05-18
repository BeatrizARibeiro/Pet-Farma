<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Pedido;

$pedido = Pedido::getPedido($_GET['numpedido']);


//VALIDACAO DO POST
if(isset($_POST['sim'])){

    $pedido->status_pedido = "Cancelado";
  
    $pedido->atuzaliarStatus();

    header('location: index.php?status=cancelado');
    exit;
}

include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/pedido_cancelar_conf.php';
include __DIR__.'/public/includes/footer.php';