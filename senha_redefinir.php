<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;
Login::requireLogout();


$alerta = "";
$obUsuario = Usuario::getUsuarioPorToken($_GET['token']);


// Obtém o usuário a partir do email informado
if(!$obUsuario instanceof Usuario) {
  $alerta = "Usuário não encontrado.";
  header('Location: login.php?status=missinguser');
}

if ($obUsuario->token != $_GET['token']) {
  header('Location: senha_redefinir_form.php');
  exit;
}

if(isset($_POST['acao'])) {
  switch($_POST['acao']){
    case 'alterar-senha':
      // Verifica se o email foi informado
      if($_GET['token'] != $obUsuario->token){
        header('Location: login.php?status=incorrecttoken');
        break;
      }

      // Verifica se a nova senha foi informada
      if(empty($_POST['senha'])){
        $alerta = "Por favor, informe a nova senha.";
        break;
      }

      // Verifica se a confirmação da nova senha foi informada
      if(empty($_POST['confirmar-senha'])){
        $alerta = "Por favor, confirme a nova senha.";
        break;
      }

      // Verifica se as novas senhas são iguais
      if($_POST['senha'] != $_POST['confirmar-senha']){
        $alerta = "As novas senhas não conferem.";
        break;
      }

      // Cria o hash da nova senha e atualiza o registro do usuário
      $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
      if(!$obUsuario->atualizarSenha($novaSenha)){
          $alerta = "Erro ao atualizar a senha. Tente novamente mais tarde.";
          break;
      }

      // Redireciona o usuário para a página de sucesso
      Login::logout();
      exit;

      break;
  }
}


include __DIR__.'/public/includes/senha_redefinir_form.php';
