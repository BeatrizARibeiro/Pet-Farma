<?php

require __DIR__.'/vendor/autoload.php';

use App\Session\Login;
use App\Entity\Endereco;

Login::requireLogin();
!Login::isAdmin();

$alertaEditarDados = "";

$obEndereco = Endereco::getEndereco($_GET['codend']);
$usuarioLogado = Login::getUsuarioLogado();
$enderecoPadraoExistente = Endereco::getEnderecoPadrao($usuarioLogado['codus']);

if (!isset($_GET['codend']) || !is_numeric($_GET['codend']) || $usuarioLogado['codus'] != $obEndereco->codus) {
    header('Location: index.php?status=error');
    exit;
}

if (!$obEndereco instanceof Endereco) {
    header('location: index.php?status=error');
    exit;
}

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'atualizar':
            if (!isset($_POST['cep'], $_POST['uf'], $_POST['cidade'], $_POST['rua'], $_POST['bairro'], $_POST['numero'], $_POST['tipo'])) {
                $alertaEditarDados = "Por favor, preencha todos os campos.";
            } else {
                // Verifica se o endereço deve ser definido como padrão
                if ($_POST['padrao'] == 1) {
                    // Verifica se já existe um endereço padrão cadastrado
                    if ($enderecoPadraoExistente && $enderecoPadraoExistente->codend != $_GET['codend']) {
                        $alertaEditarDados = "Você já possui um endereço definido como padrão.";
                        break;
                    }
                }

                $obEndereco->cep = $_POST['cep'];
                $obEndereco->uf = $_POST['uf'];
                $obEndereco->cidade = $_POST['cidade'];
                $obEndereco->rua = $_POST['rua'];
                $obEndereco->bairro = $_POST['bairro'];
                $obEndereco->numero = $_POST['numero'];
                $obEndereco->tipo = $_POST['tipo'];
                $obEndereco->padrao = isset($_POST['padrao']) ? 1 : 0;

                $obEndereco->atualizar();
                header('Location: dados_listar.php?codus=' . $usuarioLogado['codus']);
                exit;
            }

            break;
    }
}

include __DIR__.'/public/includes/endereco_editar_form.php';
