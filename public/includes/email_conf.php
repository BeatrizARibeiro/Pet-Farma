<?php
  $alerta = strlen($alerta) ? '<div>'.$alerta.'</div>' : '';
?>


<main>
  <a href="index.php">Voltar</a>
  <h1>Solicitar troca de senha</h1>
  <h2>Informe seu email</h2>

  <?=$alerta?>

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

    <button 
      type="submit" 
      name="acao" 
      value="trocar">
      Enviar
    </button>

  </form>
  
</main>