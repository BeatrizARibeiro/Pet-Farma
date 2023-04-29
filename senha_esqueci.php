<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;

$alerta = '';

if(isset($_POST['acao']) && $_POST['acao'] == 'trocar') {
  $email = trim($_POST['email']);
  
  // Verifica se o email inserido corresponde a um usuário cadastrado
  $obUsuario = Usuario::getUsuarioPorEmail($email);
  
  if(!$obUsuario instanceof Usuario) {
    $alerta = "Email não cadastrado.";
  } else {
    // Gera um token exclusivo para o usuário e salva no banco de dados
    $token = bin2hex(random_bytes(16));
    $obUsuario->setToken($token);
    
    // Envia um e-mail com o link para redefinir a senha
    $link = "https://exemplo.com/redefinir-senha.php?token=$token";
    $mensagem = "Olá, para redefinir sua senha, acesse o link abaixo:\n$link";
    $headers = "From: noreply@exemplo.com\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    mail($email, "Redefinir senha", $mensagem, $headers);
    
    $alerta = "Um e-mail com as instruções para redefinir a senha foi enviado para o endereço $email.";
  }
}

include __DIR__.'/public/includes/email_conf.php';
