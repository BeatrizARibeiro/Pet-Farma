<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Endereco;
use App\Session\Login;

  $obEndereco = Endereco::getEndereco($_GET['codend']);
  $usuarioLogado = Login::getUsuarioLogado();

if(!isset($_GET['codend']) || !is_numeric($_GET['codend']) || $usuarioLogado['codus'] != $obEndereco->codus) {
    header('Location: index.php?status=error');
    exit;
}

$obEndereco = Endereco::getEndereco($_GET['codend']);

if(!$obEndereco instanceof Endereco) {
    header ('location: index.php?status=error');
    exit;
}

if(isset($_POST['excluir'])){
    $obEndereco->excluir();
    header('Location: dados_listar.php?codus=' . $usuarioLogado['codus']);
    exit;
}


include __DIR__.'/public/includes/endereco_conf.php';