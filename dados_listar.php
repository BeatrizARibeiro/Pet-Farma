<?php

  require __DIR__.'/vendor/autoload.php';

  use App\Entity\Usuario;
  use App\Session\Login;
  Login::requireLogin();
  !Login::isAdmin();

  $usuario = Login::getUsuarioLogado();

if(!isset($_GET['codus']) or !is_numeric($_GET['codus'])) {
    header ('location: index.php?status=error1');
    exit;
}

if(isset($_GET['codus']) && $_GET['codus'] != $usuario['codus']){ 
  header('location: index.php?status=error2');
  exit;
}

$obUsuario = Usuario::getUsuarioPorCodus($_GET['codus']);

if(!$obUsuario instanceof Usuario) {
    header ('location: index.php?status=error3');
    exit;
}


include __DIR__.'/public/includes/meus_dados.php';
