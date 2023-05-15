<?php

require __DIR__.'/vendor/autoload.php';

 //importando as classes
 use App\Entity\Item_Pedido;
 use App\Entity\Produto;
 use App\Session\Login;


 //verifica sessao
 $sessao = Login::getUsuarioLogado();

 if($sessao == null){
     header('location: login.php');
     exit;
 }
 else{
    // VALIDACAO DO CODIGO
    if(!isset($_GET['codprod']) or !is_numeric($_GET['codprod'])){
        header('location: carrinho.php?status=error');
        exit;
    }

    $item = Item_Pedido::getIem_Pedido($_GET['codprod']);
    $produto = Produto::getProduto($_GET['codprod']);

    //VALIDACAO DO POST
    if(isset($_POST['excluir'])){
        $item->excluir($_GET['codprod']);
        header('location: carrinho.php');
        exit;
    }
 }




include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/carrinho_conf.php';
include __DIR__.'/public/includes/footer.php';