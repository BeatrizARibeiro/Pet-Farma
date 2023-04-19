<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tela de login</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, rgb(20,147,220), rgb(17, 54, 71));
      }
      div {
        background-color: rgba(0, 0, 0, 0.6);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 80px;
        border-radius: 15px;
        color: white;
      }

      input {
        padding: 15px;
        border: none;
        outline: none;
        font-size: 16px;
      }

      .inputSubmit {
        cursor: pointer;
        background-color: dodgerblue;
        border: none;
        padding: 15px;
        width: 100%;
        border-radius: 15px;
        color: white;
        font-size: 16px;
        transition: all 0.2s;
      }

      .inputSubmit:hover {
        background-color: deepskyblue;
      }
    </style>
  </head>
  <body>
    <a href="home.php">Voltar</a>
    <div class="login-screen">
      <h1>Login</h1>
      <form action="testLogin.php" method="post">
        <input type="text" name="email" placeholder="Email" />
        <br /><br />
        <input type="password" name="senha" placeholder="Senha" />
        <br /><br />
        <input class="inputSubmit" type="submit" name="submit" value="Enviar">
      </form>
    </div>
  </body>
</html>
