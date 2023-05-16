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
        $alertaLogin = "E-mail ou senha inválidos.";
        break;
      }
      Login::login($obUsuario);
      
      break;
  }
}

if(isset($_GET['status'])) {
  switch($_GET['status']){
    case 'alerta':
      $mensagem = "Faça login ou cadastre-se para poder comprar os produtos do seu pet!";
      break;
  }
}



//CARREGA OS ELEMENTOS HTML
include __DIR__.'/public/includes/login_form.php';