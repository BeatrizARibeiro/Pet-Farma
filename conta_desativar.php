<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Entity\Pedido;
use \App\Session\Login;
Login::requireLogin();
!Login::isAdmin();

$usuarioLogado = Login::getUsuarioLogado();
$obUsuario = Usuario::getUsuarioPorCodus($_GET['codus']);
$obPedidos = Pedido::getPedidosCli($_GET['codus']);
$temPedidoAberto = false;

$alertaDesativar = "";


if(!isset($_GET['codus']) or !is_numeric($_GET['codus'])) {
    header ('location: index.php?status=error1');
    exit;
}

if(isset($_GET['codus']) && $_GET['codus'] != $usuarioLogado['codus']){ 
  header('location: index.php?status=error2');
  exit;
}

if(!$obUsuario instanceof Usuario) {
    header ('location: index.php?status=error3');
    exit;
}

if (isset($_POST['desativar'])) {
  // Verifique se existem pedidos pendentes antes de desativar a conta
  foreach ($obPedidos as $obPedido) {
    if ($obPedido->status_pedido == "Em aberto") {
      $temPedidoAberto = true;
      break;
    }
  }

  if ($temPedidoAberto) {
    $alertaDesativar = "Você tem pedidos pendentes e não será possível desativar sua conta no momento.";
  } else {
    // Altere o status da conta entre ativo e inativo
    $novoStatus = ($obUsuario->situacao == 'ativa') ? 'inativa' : 'ativa';
    $obUsuario->setStatus($obUsuario->codus, $novoStatus);
    Login::logout();
    exit;
  }
}


include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/conta_conf.php';
include __DIR__.'/public/includes/footer.php';