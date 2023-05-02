<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;
Login::requireLogout();

$alertaCadastro = "";


if(isset($_POST['acao'])) {
    switch($_POST['acao']){
    case 'cadastrar':
      if(isset($_POST['nome'], $_POST['email'], $_POST['senha'],$_POST['cpf'], $_POST['telefone'])) {

      $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
      if($obUsuario instanceof Usuario){
        $alertaCadastro = "O e-mail já está em uso.";
        break;
      }


        $obUsuario = new Usuario();
        $obUsuario->nome = $_POST['nome'];
        $obUsuario->cpf = $_POST['cpf'];
        $obUsuario->telefone = $_POST['telefone'];
        $obUsuario->email = $_POST['email'];
        $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $obUsuario->cadastrar();

        Login::login($obUsuario);

      }
      break;
  }
}

//CARREGA OS ELEMENTOS HTML
include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/cadastro_form.php';
include __DIR__.'/public/includes/footer.php';