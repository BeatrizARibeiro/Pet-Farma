<?php
    require __DIR__.'../vendor/autoload.php';

    //importando as classes
    use App\Entity\Item_Pedido;
    use App\Entity\Pedido;
    use App\Session\Login;

    $mensagem = '';

    //verifica sessao
    $sessao = Login::getUsuarioLogado();


    $pedido = Pedido::getPedido($_GET['numpedido']);

    

    $pedido->status_pedido = "Finalizado";

    $pedido->codend = $_GET['codend'];

    $pedido->finalizar();



    include __DIR__.'/public/includes/header.php';
    include __DIR__.'/public/includes/meus_pedidos.php';
    include __DIR__.'/public/includes/footer.php';
?>