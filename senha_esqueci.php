<?php

use App\Entity\Usuario;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

$alerta = '';

if(isset($_POST['acao'])) {
  switch($_POST['acao']) {
    case 'trocar':

      if(empty($_POST['email'])){
        $alerta = "Por favor, informe seu email.";
        break;
      }

      $email = trim($_POST['email']);
      $obUsuario = Usuario::getUsuarioPorEmail($email);
      $nomeUsuario = $obUsuario->nome;
      $primeiroNome = explode(' ', $nomeUsuario)[0];

      if(!$obUsuario instanceof Usuario) {
        $alerta = "Email não cadastrado.";
        break;
      }else {
        $token = bin2hex(random_bytes(16));
        $obUsuario->setToken($token);
        print_r($token);

        $serverPort = $_SERVER['SERVER_PORT'];
        $directoryName = basename(__DIR__);

        // Verifica se a porta é diferente da porta padrão do XAMPP (80 para HTTP, 443 para HTTPS)
        if ($serverPort != 80 && $serverPort != 443) {
          $serverPort = ':' . $serverPort;
        } else {
          $serverPort = ''; // Deixa vazio se for a porta padrão
        }

        $link = "http://localhost$serverPort/$directoryName/senha_redefinir.php?token=$token";
        $mensagem = 'Olá, ' . $primeiroNome . '. Se você solicitou uma troca de senha, clique <a href="' . $link . '">aqui</a> para realizar a alteração. Caso contrário, basta ignorar esta mensagem. 🐶';



        try {
        // Configuração do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.sendinblue.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'petfarma.dev@gmail.com';
        $mail->Password = 'wfINtpn6q5KUzhra';
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
        header('Location: email_enviado.php');
        exit;

      } catch (Exception $e) {
          $alerta = "Erro ao enviar e-mail: " . $mail->ErrorInfo;
      }

      }

      break;
  }

}


include __DIR__.'/public/includes/email_conf.php';
