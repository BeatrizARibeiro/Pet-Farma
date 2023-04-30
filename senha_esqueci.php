<?php

use App\Entity\Usuario;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

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

    $link = "http://localhost:8080/pet-farma/senha_redefinir.php?token=$token";
    $mensagem = "Olá, " . $obUsuario->nome . ". Você solicitou uma troca de senha, Clique no link abaixo para realizar a alteração: \n$link";


    try {
    // Configuração do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp-relay.sendinblue.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'adrielkasima@gmail.com';
    $mail->Password = '1pLYdtkIxC2bg3aP';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->isHTML(true);

    // Configuração do e-mail
    $mail->setFrom('petfarma.dev@gmail.com', 'Pet Farma');
    $mail->addAddress($_POST['email'], $obUsuario->nome);
    $mail->Subject = 'Solicitação para redefinição de senha.';
    $mail->Body = $mensagem;

    // Envia o e-mail
    $mail->send();
    $alerta = "Um e-mail com as instruções para redefinir a senha foi enviado para o endereço $email.";

} catch (Exception $e) {
    $alerta = "Erro ao enviar e-mail: " . $mail->ErrorInfo;
}
  }
}


include __DIR__.'/public/includes/email_conf.php';