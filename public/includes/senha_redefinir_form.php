<?php
  $alerta = strlen($alerta) ? '<div>'.$alerta.'</div>' : '';
?>

<main>
  <a href="index.php">Voltar</a>
  <h1>Alterar senha</h1>

  <?=$alerta?>

  <form method="post">

    <div class="inputBox">
      <label for="senha" class="inputLabel">Nova senha</label>
      <input 
        type="password" 
        name="senha" 
        class="inputUser" 
        placeholder="Nova senha" 
        required 
      />
    </div>

    <div class="inputBox">
      <label for="confirmar-senha" class="inputLabel">Confirme a nova senha</label>
      <input 
        type="password" 
        name="confirmar-senha" 
        class="inputUser" 
        placeholder="Digite a senha novamente" 
        required 
      />
    </div>

    <button 
      type="submit" 
      name="acao" 
      value="alterar-senha">
      Salvar senha
    </button>

  </form>

</main>