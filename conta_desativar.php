<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Entity\Pedido;
use \App\Session\Login;
Login::requireLogin();
!Login::isAdmin();

$usuarioLogado = Login::getUsuarioLogado();
$obUsuario = Usuario::getUsuarioPorCodus($_GET['codus']);
$obPedido = Pedido::getPedidoAberto($_GET['codus']);

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
  // if ($obPedido->status_pedido == "Em aberto") {
  //   $alertaDesativar = "Você tem pedidos pendentes e não será possível desativar sua conta no momento.";
  // }

  // Altere o status da conta entre ativo e inativo
  $novoStatus = ($obUsuario->situacao == 'ativa') ? 'inativa' : 'ativa';
  $obUsuario->setStatus($obUsuario->codus, $novoStatus);

  // Redirecione para a página de listagem de dados
  header("Location: dados_listar.php?codus=" . $usuarioLogado['codus']);
  exit;
}


include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/conta_conf.php';
include __DIR__.'/public/includes/footer.php';