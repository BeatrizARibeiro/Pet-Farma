<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;
Login::requireLogout();


$alerta = "";
$obUsuario = Usuario::getUsuarioPorToken($_GET['token']);


// Obtém o usuário a partir do email informado
if(!$obUsuario instanceof Usuario) {
  $alerta = '<div class="erro">Usuário não encontrado.</div>';
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
        $alerta = '<div class="erro">Por favor, informe a nova senha.</div>';
        break;
      }

      // Verifica se a confirmação da nova senha foi informada
      if(empty($_POST['confirmar-senha'])){
        $alerta = '<div class="erro">Por favor, confirme a nova senha.</div>';
        break;
      }

      // Verifica se as novas senhas são iguais
      if($_POST['senha'] != $_POST['confirmar-senha']){
        $alerta = '<div class="erro">As novas senhas não conferem.</div>';
        break;
      }

      // Verifica se a senha atende aos requisitos
      $senha = $_POST['senha'];
      if (strlen($senha) < 6 || !preg_match('/[A-Z]/', $senha)) {
          $alerta = '<div class="erro">A senha deve ter no mínimo 6 caracteres e pelo menos uma letra maiúscula.</div>';
          break;
      }

      

      // Cria o hash da nova senha e atualiza o registro do usuário
      $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
      if(!$obUsuario->atualizarSenha($novaSenha)){
          $alerta = '<div class="erro">Erro ao atualizar a senha. Tente novamente mais tarde.</div>';
          break;
      }

      // Redireciona o usuário para a página de sucesso
      $obUsuario->setToken(null);
      Login::logout();
      exit;

      break;
  }
}


include __DIR__.'/public/includes/senha_redefinir_form.php';
