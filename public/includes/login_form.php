<?php
  $alertaLogin = strlen($alertaLogin) ? '<div>'.$alertaLogin.'</div>' : '';
?>


<main>
  <a href="index.php">Voltar</a>
  <h1>Login</h1>

  <?=$alertaLogin?>

  <form method="post">

    <div class="inputBox">
      <label for="email" class="inputLabel">Email</label>
      <input 
        type="text" 
        name="email" 
        class="inputUser" 
        placeholder="Email" 
        required 
      />
    </div>

    <div class="inputBox">
      <label for="senha" class="inputLabel">Senha</label>
      <input 
        type="password" 
        name="senha" 
        class="inputUser" 
        placeholder="Senha" 
        required 
      />
    </div>

    <button 
      type="submit" 
      name="acao" 
      value="logar">
      Acessar
    </button>

  </form>
  
</main>