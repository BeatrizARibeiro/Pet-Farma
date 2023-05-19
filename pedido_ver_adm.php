<?php

    use App\Entity\Pedido;

    require __DIR__.'/vendor/autoload.php';

    $pedido = Pedido::getPedido($_GET['numpedido']);


    if(isset($_POST['salvar'])){
        if($_POST['status_pedido'] == 1){
            $pedido->status_pedido = "Em preparação";
            $pedido->atuzaliarStatus();
        }

        if($_POST['status_pedido'] == 2){
            $pedido->status_pedido = "Entregue a transportadora";
            $pedido->protocolo = rand(1000000000, 4294967295);
            $pedido->atuzaliarStatus();
        }

        if($_POST['status_pedido'] == 3){
            $pedido->status_pedido = "Cancelado";
            $pedido->atuzaliarStatus();
        }
    }

    include __DIR__.'/public/includes/header.php';
    include __DIR__.'/public/includes/pedido_detalhes_adm.php';
    include __DIR__.'/public/includes/footer.php';
?>