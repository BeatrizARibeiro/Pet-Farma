<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;
Login::requireLogout();

$alertaCadastro = "";
$camposComErro = [];

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'cadastrar':
            if (isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['cpf'], $_POST['telefone'])) {

                $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
                if ($obUsuario instanceof Usuario) {
                    $alertaCadastro = "O e-mail já está em uso.";
                    $camposComErro[] = 'email';
                    break;
                }

                if (strlen($_POST['telefone']) != 15) {
                    $alertaCadastro = "Número de telefone inválido.";
                    $camposComErro[] = 'telefone';
                    break;
                }

                $usuarioCPF = Usuario::validaCPF($_POST['cpf']);
                if (!$usuarioCPF) {
                    $alertaCadastro = "CPF inválido.";
                    $camposComErro[] = 'cpf';
                    break;
                }

                $senha = $_POST['senha'];
                if (strlen($senha) < 6 || !preg_match('/[A-Z]/', $senha)) {
                    $alertaCadastro = "A senha deve ter no mínimo 6 caracteres e pelo menos uma letra maiúscula.";
                    $camposComErro[] = 'senha';
                    break;
                }

                $obUsuario = new Usuario();
                $obUsuario->nome = ucfirst(strtolower($_POST['nome']));
                $obUsuario->cpf = $_POST['cpf'];
                $obUsuario->telefone = $_POST['telefone'];
                $obUsuario->email = $_POST['email'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $obUsuario->cadastrar();
                $obUsuario->setStatus($obUsuario->codus, "ativa");

                Login::login($obUsuario);

            }
            break;
    }
}


//CARREGA OS ELEMENTOS HTML
// include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/cadastro_form.php';
// include __DIR__.'/public/includes/footer.php';