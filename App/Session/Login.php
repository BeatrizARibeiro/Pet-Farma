<?php

namespace App\Session;

class Login {

  private static function init() {
    if(session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
  }

  public static function getUsuarioLogado() {
    self::init();

    return self::isLogged() ? $_SESSION['usuario'] : null;
  }

  public static function login($obUsuario) {
    self::init();
    $_SESSION['usuario'] = [
      'codus' => $obUsuario->codus,
      'nome' => $obUsuario->nome,
      'email' => $obUsuario->email,
      'admin' => $obUsuario->admin,
    ];

    header('Location: index.php');
    exit;
  }

  public static function logout() {
    self::init();

    unset($_SESSION['usuario']);
    header('Location: index.php');
    exit;

  }
  //Verifica se o usuário está logado
  public static function isLogged() {
    self::init();
    return isset($_SESSION['usuario']['codus']);
  }

  public static function isAdmin() {
  self::init();
  return isset($_SESSION['usuario']['admin']) && $_SESSION['usuario']['admin'] == 1;
}

  //Obriga o usuário estar logado para acessar 
  //Chamar esse função onde o precise estar logado para acessar
  public static function requireLogin() {
    if(!self::isLogged()) {
      header("location:login.php");
      exit;
    }
  }
  //Obriga o usuário estar deslogado do sistema
  public static function requireLogout() {
    if(self::isLogged()) {
      header("location:index.php");
      exit;
    }
  }

  public static function requireAdmin() {
  if(!self::isLogged() || !self::isAdmin()) {
    header("location:login.php");
    exit;
  }
}

}