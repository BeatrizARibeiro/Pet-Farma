<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;
Login::requireLogout();

$alertaLogin = "";
$mensagem = "";

if(isset($_POST['acao'])) {
  switch($_POST['acao']){
    case 'logar':

      $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
      
      if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'],$obUsuario->senha)) {
        $alertaLogin = '<div class="erro">E-mail ou senha inválidos.</div>';
        break;
      }

      if($obUsuario->situacao == "inativa"){
        $alertaLogin = '<div class="erro">Ative sua conta antes de logar.</div>';
        break;
      }

      $obUsuario->setStatus($obUsuario->codus, "ativa");
      Login::login($obUsuario);
      
      break;
  }
}

if (isset($_GET['acao']) && $_GET['acao'] === 'ativar') {
    $token = $_GET['token'];
    $obUsuario = Usuario::getUsuarioPorToken($token);

    if($obUsuario->token != $token){
      header('Location: index.php?status=invalidtoken');
      exit;

    }

    $obUsuario->setStatus($obUsuario->codus, "ativa");
    $obUsuario->setToken(null);

    header("Location: login.php?conta_ativada");

}

if(isset($_GET['status'])) {
  switch($_GET['status']){
    case 'alerta':
      $mensagem = '<div class="neutro">Faça login ou cadastre-se para poder comprar os produtos do seu pet! &#128054;</div>';
      break;
  }
}



//CARREGA OS ELEMENTOS HTML
include __DIR__.'/public/includes/login_form.php';