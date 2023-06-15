<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;


$alertaAlterarSenha = "";
$camposComErro = [];

if(isset($_POST['acao'])) {
  switch($_POST['acao']){
    case 'alterar-senha':

      $usuarioLogado = Usuario::getUsuarioPorEmail($_POST['email']);

      if ($_GET['codus'] != $usuarioLogado->codus) {
        $alertaAlterarSenha = '<div class="erro">Por favor, informe seu email.</div>';
        break;
      }
      // Verifica se o email foi informado
      if(empty($_POST['email'])){
        $alertaAlterarSenha = '<div class="erro">Por favor, informe o email.</div>';
        break;
      }

      // Verifica se a senha atual foi informada
      if(empty($_POST['senha-atual'])){
        $alertaAlterarSenha = '<div class="erro">Por favor, informe a senha atual.</div>';
        break;
      }

      // Verifica se a nova senha foi informada
      if(empty($_POST['senha'])){
        $alertaAlterarSenha = '<div class="erro">Por favor, informe a nova senha.</div>';
        break;
      }

      // Verifica se a confirmação da nova senha foi informada
      if(empty($_POST['confirmar-senha'])){
        $alertaAlterarSenha = '<div class="erro">Por favor, confirme a nova senha.</div>';
        break;
      }

      // Verifica se as novas senhas são iguais
      if($_POST['senha'] != $_POST['confirmar-senha']){
        $camposComErro[] = 'senha';
        $camposComErro[] = 'confirmar-senha';
        $alertaAlterarSenha = '<div class="erro">As novas senhas não conferem.</div>';
        break;
      }

      $senha = $_POST['senha'];
      if (strlen($senha) < 6 || !preg_match('/[A-Z]/', $senha)) {
          $camposComErro[] = 'senha';
          $camposComErro[] = 'confirmar-senha';
          $alertaAlterarSenha = '<div class="erro">A senha deve ter no mínimo 6 caracteres e pelo menos uma letra maiúscula.</div>';
          break;
      }

      // Obtém o usuário a partir do email informado
      $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
      if(!$obUsuario instanceof Usuario) {
        $camposComErro[] = 'email';
        $alertaAlterarSenha = '<div class="erro">Usuário não encontrado.</div>';
        break;
      }

      // Verifica se a senha atual é válida
      if(!password_verify($_POST['senha-atual'], $obUsuario->senha)) {
        $camposComErro[] = 'senha-atual';
        $alertaAlterarSenha = '<div class="erro">Senha atual inválida.</div>';
        break;
      }

      // Cria o hash da nova senha e atualiza o registro do usuário
      $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
      if(!$obUsuario->atualizarSenha($novaSenha)){
          $alerta = '<div class="erro">Erro ao atualizar a senha. Tente novamente mais tarde.</div>';
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
