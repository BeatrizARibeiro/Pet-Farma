<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Endereco;
use App\Session\Login;

$alertaCadastroEndereco = "";
$camposComErro = [];

$usuarioLogado = Login::getUsuarioLogado();

Login::requireLogin();

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'cadastrar':
            if (isset($_POST['cep'], $_POST['cidade'], $_POST['uf'], $_POST['rua'], $_POST['bairro'], $_POST['numero'], $_POST['tipo'])) {

                $obEndereco = new Endereco();
                $obEndereco->cep = $_POST['cep'];
                $obEndereco->cidade = $_POST['cidade'];
                $obEndereco->uf = $_POST['uf'];
                $obEndereco->rua = $_POST['rua'];
                $obEndereco->bairro = $_POST['bairro'];
                $obEndereco->numero = $_POST['numero'];
                $obEndereco->tipo = $_POST['tipo'];
                $obEndereco->codus = $usuarioLogado['codus'];

                // Verifica se o endereço deve ser definido como padrão
                if (isset($_POST['padrao']) && $_POST['padrao'] == 1) {
                    // Verifica se já existe um endereço padrão cadastrado
                    $enderecoPadraoExistente = Endereco::getEnderecoPadrao($usuarioLogado['codus']);
                    if ($enderecoPadraoExistente) {
                        $alertaCadastroEndereco = "Você já possui um endereço definido como padrão.";
                        $camposComErro[] = 'padrao';
                    } else {
                        $obEndereco->padrao = $_POST['padrao'];
                    }
                }

                if (!$alertaCadastroEndereco) {
                    $obEndereco->cadastrar();
                    header('Location: dados_listar.php?codus=' . $usuarioLogado['codus']);
                }
            }
            break;
    }
}

include __DIR__.'/public/includes/endereco_form.php';
