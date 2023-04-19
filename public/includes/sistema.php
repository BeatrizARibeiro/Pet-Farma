<?php
  session_start();

  if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
  } else {
    $logado = $_SESSION['email'];
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Início</title>
  <style>
      body {
    background: linear-gradient(to right, rgb(20,147,220), rgb(17, 54, 71));
  }
  </style>
</head>
<body>
  <h1>Página inicial</h1>
  <a href="logout.php">Sair</a>
</body>
</html>