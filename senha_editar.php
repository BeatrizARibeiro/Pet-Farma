<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;


$alertaAlterarSenha = "";

if(isset($_POST['acao'])) {
  switch($_POST['acao']){
    case 'alterar-senha':
      // Verifica se o email foi informado
      if(empty($_POST['email'])){
        $alertaAlterarSenha = "Por favor, informe o email.";
        break;
      }

      // Verifica se a senha atual foi informada
      if(empty($_POST['senha-atual'])){
        $alertaAlterarSenha = "Por favor, informe a senha atual.";
        break;
      }

      // Verifica se a nova senha foi informada
      if(empty($_POST['senha'])){
        $alertaAlterarSenha = "Por favor, informe a nova senha.";
        break;
      }

      // Verifica se a confirmação da nova senha foi informada
      if(empty($_POST['confirmar-senha'])){
        $alertaAlterarSenha = "Por favor, confirme a nova senha.";
        break;
      }

      // Verifica se as novas senhas são iguais
      if($_POST['senha'] !== $_POST['confirmar-senha']){
        $alertaAlterarSenha = "As novas senhas não conferem.";
        break;
      }

      // Obtém o usuário a partir do email informado
      $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
      if(!$obUsuario instanceof Usuario) {
        $alertaAlterarSenha = "Usuário não encontrado.";
        break;
      }

      // Verifica se a senha atual é válida
      if(!password_verify($_POST['senha-atual'], $obUsuario->senha)) {
        $alertaAlterarSenha = "Senha atual inválida.";
        break;
      }

      // Cria o hash da nova senha e atualiza o registro do usuário
      $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
      if(!$obUsuario->atualizarSenha(['senha' => $novaSenha])){
        $alertaAlterarSenha = "Erro ao atualizar a senha. Tente novamente mais tarde.";
        break;
      }

      // Redireciona o usuário para a página de sucesso
      Login::logout();
      header('Location: login.php');
      exit;

      break;
  }
}

include __DIR__.'/public/includes/senha_editar_form.php';
