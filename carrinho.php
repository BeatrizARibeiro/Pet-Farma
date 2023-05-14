<?php
    require __DIR__.'/vendor/autoload.php';

    //importando as classes
    use \App\Session\Login;

    //verifica sessao
    $sessao = Login::getUsuarioLogado();

    $mensagem = '';

    if($sessao == null){
        header('location: login.php');
        exit;
    }


    include __DIR__.'/public/includes/header.php';
    include __DIR__.'/public/includes/carrinho_itens.php';
    include __DIR__.'/public/includes/footer.php';
?>