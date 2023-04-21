<?php
  $alertaLogin = strlen($alertaLogin) ? '<div>'.$alertaLogin.'</div>' : '';
?>


<main>
  <a href="index.php">Voltar</a>
  <h1>Login</h1>

  <?=$alertaLogin?>

  <form method="post">
    <input type="text" name="email" placeholder="Email" required />
    <br /><br />
    <input type="password" name="senha" placeholder="Senha" required />
    <br /><br />
    <button type="submit" name="acao" value="logar">Acessar</button>
  </form>
</main>