<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Endereco;
use App\Entity\Pedido;
use App\Entity\Item_Pedido;
use App\Session\Login;

$alerta = "";

$obEndereco = Endereco::getEndereco($_GET['codend']);
$usuarioLogado = Login::getUsuarioLogado();
$obPedidos = Pedido::getPedidosCli($usuarioLogado['codus']);

if (!isset($_GET['codend']) || !is_numeric($_GET['codend']) || $usuarioLogado['codus'] != $obEndereco->codus) {
    header('Location: index.php?status=error');
    exit;
}

if (!$obEndereco instanceof Endereco) {
    header('Location: index.php?status=error');
    exit;
}

if (isset($_POST['acao']) && $_POST['acao'] == 'excluir') {
    $temPedidoAberto = false;

    foreach ($obPedidos as $obPedido) {
        if ($obPedido->codend == $_GET['codend'] && in_array($obPedido->status_pedido, ["Pago", "Em aberto", "Em preparação", "Entregue a transportadora"])) {
            $temPedidoAberto = true;
            break;
        }
    }

    if ($temPedidoAberto) {
        $alerta = '<div class="erro" style="margin:15px; text-align:center;">Não é possível excluir o endereço, pois existem pedidos associados a ele.</div>';
    } else {
        $obEndereco->excluir();
        header('Location: dados_listar.php?codus=' . $usuarioLogado['codus']);
        exit;
    }
}

include __DIR__.'/public/includes/endereco_conf.php';
