<?php

  if(isset($_POST['submit'])) {
    print_r($_POST['nome']);
    print_r('<br>');
    print_r($_POST['email']);
    print_r('<br>');
    print_r($_POST['telefone']);
    //     print_r('<br>');
    // print_r($_POST['genero']);
    //     print_r('<br>');
    // print_r($_POST['dataNasc']);
    //     print_r('<br>');
    // print_r($_POST['cidade']);
    //     print_r('<br>');
    // print_r($_POST['estado']);
    //     print_r('<br>');
    // print_r($_POST['endereco']);

    include_once('config.php');

    //Dados pessoais
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    //Dados de endereço
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $tipo = $_POST['tipo'];
    $codus = 4;

    // $genero = $_POST['genero'];
    // $dataNasc = $_POST['dataNasc'];
    // $cidade = $_POST['cidade'];
    // $estado = $_POST['estado'];
    // $endereco = $_POST['endereco'];

    $resultUser = mysqli_query($connection, "INSERT INTO usuario(nome, email, senha, telefone) VALUES ('$nome', '$email', '$senha', '$telefone')");

    $resultAdress = mysqli_query($connection, "INSERT INTO endereco(cep, rua, bairro, numero, tipo, codus) VALUES ('$cep', '$rua', '$bairro', '$numero', '$tipo', '$codus')");

      header('Location: login.php');
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulário | GN</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-image: linear-gradient(
          to right,
          rgb(20, 147, 220),
          rgb(17, 54, 71)
        );
      }
      .box {
        min-width: 320px;
        max-width: 800px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.6);
        padding: 15px;
        border-radius: 15px;
        width: 30%;
        color: white;
      }

      fieldset {
        border: 3px solid dodgerblue;
      }
      legend {
        border: 1px solid dodgerblue;
        padding: 10px;
        text-align: center;
        background-color: dodgerblue;
        border-radius: 8px;
      }

      .inputBox {
        position: relative;
      }
      .inputUser {
        background: none;
        border: none;
        border-bottom: 1px solid white;
        outline: none;
        color: white;
        font-size: 16px;
        width: 100%;
        letter-spacing: 2px;
      }
      .labelInput {
        position: absolute;
        top: 0px;
        left: 0px;
        pointer-events: none;
        transition: 0.5s;
      }
      .inputUser:focus ~ .labelInput,
      .inputUser:valid ~ .labelInput {
        top: -20px;
        font-size: 12px;
        color: dodgerblue;
      }
      #dataNasc {
        border: none;
        padding: 8px;
        border-radius: 10px;
        outline: none;
        font-size: 16px;
      }
      #submit {
        background-image: linear-gradient(
          to right,
          rgb(0, 92, 197),
          rgb(90, 20, 220)
        );
        width: 100%;
        border: none;
        padding: 15px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        border-radius: 10px;
      }
      #submit:hover {
        background-image: linear-gradient(
          to right,
          rgb(0, 80, 172),
          rgb(80, 19, 195)
        );
      }
    </style>
  </head>
  <body>
    <a href="home.php">Voltar</a>

    <div class="box">
      <form action="form.php" method="POST">
        <fieldset>
          <legend><b>Crie sua conta</b></legend>
          <br />
          <div class="inputBox">
            <input
              type="text"
              name="nome"
              id="nome"
              class="inputUser"
              required
            />
            <label for="nome" class="labelInput"> Nome completo </label>
          </div>
          <br /><br />
          <div class="inputBox">
            <input
              type="text"
              name="email"
              id="email"
              class="inputUser"
              required
            />
            <label for="email" class="labelInput"> Email </label>
          </div>
          <br /><br />

          <div class="inputBox">
            <input
              type="password"
              name="senha"
              id="senha"
              class="inputUser"
              required
            />
            <label for="senha" class="labelInput"> Senha </label>
          </div>
          <br /><br />

          <div class="inputBox">
            <input
              type="text"
              name="cpf"
              id="cpf"
              class="inputUser"
              required
            />
            <label for="cpf" class="labelInput"> CPF </label>
          </div>
          <br /><br />

          <div class="inputBox">
            <input
              type="tel"
              name="telefone"
              id="telefone"
              class="inputUser"
              required
            />
            <label for="telefone" class="labelInput"> Telefone </label>
          </div>
          <br /><br />

          <p>Endereço</p>

          <!-- <p>Sexo</p>
          <input type="radio" name="genero" value="feminino" required />
          <label for="feminino">Feminino</label>
          <br />
          <input type="radio" name="genero" value="masculino" required />
          <label for="masculino">Masculino</label>
          <br />
          <input type="radio" name="genero" value="outro" required />
          <label for="outro">Outro</label>
          <br /><br />

          <label for="dataNasc">
            <b>Data de nascimento</b>
          </label>
          <input type="date" name="dataNasc" id="dataNasc" required />
          <br /><br /> -->

          <div class="inputBox">
            <input
              type="text"
              name="cep"
              id="cep"
              class="inputUser"
              required
            />
            <label for="cep" class="labelInput">
              <b>CEP</b>
            </label>
          </div>
          <br /><br />

          <div class="inputBox">
            <input
              type="text"
              name="rua"
              id="rua"
              class="inputUser"
              required
            />
            <label for="rua" class="labelInput">
              <b>Rua</b>
            </label>
          </div>
          <br /><br />

          <div class="inputBox">
            <input
              type="text"
              name="bairro"
              id="bairro"
              class="inputUser"
              required
            />
            <label for="bairro" class="labelInput">
              <b>Bairro</b>
            </label>
          </div>
          <br /><br />

          <div class="inputBox">
            <input
              type="text"
              name="numero"
              id="numero"
              class="inputUser"
            />
            <label for="numero" class="labelInput">
              <b>Número</b>
            </label>
          </div>
          <br /><br />

          <div class="inputBox">
            <input
              type="text"
              name="tipo"
              id="tipo"
              class="inputUser"
            />
            <label for="tipo" class="labelInput">
              <b>Tipo</b>
            </label>
          </div>
          <br /><br />

          <input type="submit" name="submit" id="submit" />
        </fieldset>
      </form>
    </div>
  </body>
</html>
