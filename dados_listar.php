<?php

  require __DIR__.'/vendor/autoload.php';

  use App\Entity\Usuario;
  use App\Session\Login;
  Login::requireLogin();
  !Login::isAdmin();

if(!isset($_GET['codus']) or !is_numeric($_GET['codus'])) {
    header ('location: index.php?status=error');
    exit;
}

$obUsuario = Usuario::getUsuarioPorCodus($_GET['codus']);

if(!$obUsuario instanceof Usuario) {
    header ('location: index.php?status=error');
    exit;
}

include __DIR__.'/public/includes/dados_form.php';