<?php

require __DIR__.'/vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

Login::requireLogout();

$alertaCadastro = "";
$camposComErro = [];

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'cadastrar':
            if (isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['cpf'], $_POST['telefone'])) {

                $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
                if ($obUsuario instanceof Usuario) {
                    $alertaCadastro = "O e-mail já está em uso.";
                    $camposComErro[] = 'email';
                    break;
                }

                if (strlen($_POST['telefone']) != 15) {
                    $alertaCadastro = "Número de telefone inválido.";
                    $camposComErro[] = 'telefone';
                    break;
                }

                $usuarioCPF = Usuario::validaCPF($_POST['cpf']);
                if (!$usuarioCPF) {
                    $alertaCadastro = "CPF inválido.";
                    $camposComErro[] = 'cpf';
                    break;
                }

                $senha = $_POST['senha'];
                if (strlen($senha) < 6 || !preg_match('/[A-Z]/', $senha)) {
                    $alertaCadastro = "A senha deve ter no mínimo 6 caracteres e pelo menos uma letra maiúscula.";
                    $camposComErro[] = 'senha';
                    break;
                }

                $token = bin2hex(random_bytes(16));

                $obUsuario = new Usuario();
                $obUsuario->nome = ucfirst(strtolower($_POST['nome']));
                $obUsuario->cpf = $_POST['cpf'];
                $obUsuario->telefone = $_POST['telefone'];
                $obUsuario->email = $_POST['email'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $obUsuario->cadastrar();
                $obUsuario->setToken($token);
                $obUsuario->setStatus($obUsuario->codus, "inativa");

                $serverPort = $_SERVER['SERVER_PORT'];
                $directoryName = basename(__DIR__);

        // Verifica se a porta é diferente da porta padrão do XAMPP (80 para HTTP, 443 para HTTPS)
        if ($serverPort != 80 && $serverPort != 443) {
          $serverPort = ':' . $serverPort;
        } else {
          $serverPort = ''; // Deixa vazio se for a porta padrão
        }

        $link = "http://localhost$serverPort/$directoryName/login.php?token=$token&acao=ativar";
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
                        <div class="center subtitle">Ativação de conta</div>
                        <div class="message">
                          <p>
                            <strong>Olá, seja bem vindo(a) a Pet Farma</strong><br />
                            Clique no botão abaixo para ativar sua conta!
                          </p>
                          <a href="' . $link . '" class="center link">
                            <button class="link">Ativar conta</button>
                          </a>
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
          $mail->Subject = 'Ativação de conta';
          $mail->Body = $mensagem;
          
          $mail->send();
          header('location: index.php?status=cadastrado');

        } catch (Exception $e) {
            $$alertaCadastro = '<div class="erro" style="margin:15px; text-align:center;">Erro ao enviar e-mail: ' . $mail->ErrorInfo.'</div>';
        }

        }
        break;
    }
}


//CARREGA OS ELEMENTOS HTML
// include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/cadastro_form.php';
// include __DIR__.'/public/includes/footer.php';