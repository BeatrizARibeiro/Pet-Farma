<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$alerta = "";

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';


if(isset($_POST['acao'])) {
  switch($_POST['acao']) {
    case 'trocar':

      $email = trim($_POST['email']);
      $obUsuario = Usuario::getUsuarioPorEmail($email);

      if(empty($_POST['email'])){
        $alerta = '<div class="erro">Por favor, informe seu email.</div>';
        break;
      }

      if(!$obUsuario instanceof Usuario) {
        $alerta = '<div class="erro">Email não cadastrado.</div>';
        break;
      }else {

        $nomeUsuario = $obUsuario->nome;
        $primeiroNome = explode(' ', $nomeUsuario)[0];
        $token = bin2hex(random_bytes(16));
        $obUsuario->setToken($token);

        $serverPort = $_SERVER['SERVER_PORT'];
        $directoryName = basename(__DIR__);

        // Verifica se a porta é diferente da porta padrão do XAMPP (80 para HTTP, 443 para HTTPS)
        if ($serverPort != 80 && $serverPort != 443) {
          $serverPort = ':' . $serverPort;
        } else {
          $serverPort = ''; // Deixa vazio se for a porta padrão
        }

        $link = "http://localhost$serverPort/$directoryName/senha_redefinir.php?token=$token";
        $linkHome = "http://localhost$serverPort/$directoryName/index.php";
        $mensagem = '
          <html>
            <head>
              <style>
                * {
                  padding: 0;
                  margin: 0;
                  box-sizing: border-box;
                }
                /* Estilos opcionais para personalizar o e-mail */
                body {
                  font-family: Arial, sans-serif;
                  -webkit-fonts-smoothing: antialiased;
                }

                .container {
                  width: 100%;
                  text-align: center;
                  margin-left: 64px;

                }

                .background {
                  background-image: url(\'https://i.imgur.com/G39RtYV.png\');
                  background-size: cover;
                  background-position: center;
                  position: relative;

                }

                .overlay {
                  background-color: rgba(0, 0, 0, 0.8); /* Ajuste a opacidade aqui */
                  position: absolute;
                  top: 0;
                  left: 0;
                  right: 0;
                  bottom: 0;
                  padding: 64px;
                }

                .center {
                  text-align: center;
                }

                .title {
                  font-size: 64px;
                  font-weight: bold;
                  color: #137373;
                }

                .subtitle {
                  font-size: 32px;
                  font-weight: bold;
                  margin-top: 20px;
                  color: #137373;
                }

                .message {
                  color: white;
                  margin-top: 32px;
                  font-size: 18px;
                  line-height: 32px;
                }

                .image-container {
                  margin-top: 40px;
                }

                .image {
                  display: block;
                  margin: 0 auto;
                  width: 164px;
                  height: auto;
                }

                .link {
                  cursor: pointer;
                  text-decoration: none;
                }

                a,
                button {
                  cursor: pointer;
                }

                button {
                  transition: all 0.3s;
                  border: none;
                  font-weight: bold;
                  background-color: #137373;
                  color: white;
                  font-size: 16px;
                  padding: 18px 48px;
                  border-radius: 10px;
                  margin: 32px 0;
                }

                button:hover {
                  filter: brightness(1.1);
                }
              </style>
            </head>
            <body>
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="80%">
                <tr>
                  <td align="center" valign="top">
                    <div class="container background">
                      <div class="overlay">
                        <div class="center title">Pet Farma</div>
                        <div class="center image-container">
                          <a href="' . $linkHome . '">
                            <img
                              src="https://i.imgur.com/4aQEnev.png"
                              alt="Logo Pet-Farma"
                              class="image"
                            />
                          </a>
                        </div>
                        <div class="center subtitle">Redefinição de senha</div>
                        <div class="message">
                          <p>
                            Olá, <strong>' . $primeiroNome . '!</strong><br />
                            Se você solicitou uma troca de senha, basta clicar no botão abaixo e
                            criar uma nova senha, caso contrário, pode ignorar esta mensagem. 🐶
                          </p>
                          <a href="' . $link . '" class="center link">
                            <button class="link">Solicitar nova senha</button>
                          </a>
                          <p>A troca só funciona uma vez por link.</p>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </body>
          </html>
        ';

        try {
          // Configuração do servidor SMTP
          $mail->isSMTP();
          $mail->isHTML(true);
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          //Credenciais expostas podem gerar alerta no Github
          $mail->Username = 'petfarma.dev@gmail.com';
          $mail->Password = 'wrxmvjrbsvotmdnv';
          $mail->SMTPSecure = 'tls';
          $mail->Port = 587;

          $mail->setFrom('petfarma.dev@gmail.com', 'Pet Farma');
          $mail->addAddress($_POST['email'], $obUsuario->nome);
          $mail->Subject = 'Solicitação para redefinir senha';
          $mail->Body = $mensagem;
          
          $mail->send();
          $alerta = '<div class="erro" style="margin:15px; text-align:center;">E-mail enviado com sucesso!</div>';

        } catch (Exception $e) {
            $alerta = '<div class="erro" style="margin:15px; text-align:center;">Erro ao enviar e-mail: ' . $mail->ErrorInfo.'</div>';
        }
      }

      break;
  }

}


include __DIR__.'/public/includes/email_conf.php';
