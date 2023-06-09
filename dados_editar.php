<?php

  require __DIR__.'/vendor/autoload.php';

  use App\Entity\Usuario;
  use App\Session\Login;
  Login::requireLogin();
  !Login::isAdmin();

  $alertaEditarDados = "";

  $usuario = Login::getUsuarioLogado();
  $obUsuario = Usuario::getUsuarioPorCodus($_GET['codus']);

if(!isset($_GET['codus']) or !is_numeric($_GET['codus'])) {
    header ('location: index.php?status=error');
    exit;
}

if(isset($_GET['codus']) && $_GET['codus'] != $usuario['codus']){ 
  // header('location: index.php?status=error');
  header('location: index.php?status=error1');
  exit;
}


if(!$obUsuario instanceof Usuario) {
    header ('location: index.php?status=error');
    exit;
}

if(isset($_POST['acao'])) {
  switch($_POST['acao']){
    case 'atualizar':

      if(!isset($_POST['nome'], $_POST['email'], $_POST['cpf'], $_POST['telefone'], $_POST['senha'])){
        $alertaEditarDados = '<div class="erro">Por favor, preencha todos os campos.</div>';
      }

      if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'],$obUsuario->senha)) {
        $alertaEditarDados = '<div class="erro">Senha inválida.</div>';
        break;
      }

      $usuarioCPF = Usuario::validaCPF($_POST['cpf']);
      if (!$usuarioCPF) {
          $alertaEditarDados = '<div class="erro">CPF inválido.</div>';
          $camposComErro[] = 'cpf';
          break;
      }

      if (strlen($_POST['telefone']) != 15) {
        $alertaEditarDados = '<div class="erro">Número de telefone inválido.</div>';
        break;
      }

      $obUsuario->atualizar([
        $obUsuario->nome = $_POST['nome'],
        $obUsuario->email = $_POST['email'],
        $obUsuario->cpf = $_POST['cpf'],
        $obUsuario->telefone = $_POST['telefone'],
        $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT),
      ]);
      header('Location: dados_listar.php?codus=' . $usuario['codus']);
      exit;

      break;
  }
}

include __DIR__.'/public/includes/dados_editar_form.php';