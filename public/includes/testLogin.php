<?php
  session_start();
  if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // print_r($email);
    // print_r($senha);

    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $result = $connection->query($sql);

    // print_r($result);
    // print_r($sql);

    if(mysqli_num_rows($result) < 1) {
      unset($_SESSION['email']);
      unset($_SESSION['senha']);
      header('Location: login.php');

    } else {
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['senha'] = $_POST['senha'];
      header('Location: sistema.php');

    }

  } else {
    header('Location: login.php');
  }
?>