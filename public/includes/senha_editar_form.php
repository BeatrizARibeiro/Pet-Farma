<?php
  $alertaAlterarSenha = strlen($alertaAlterarSenha) ? '<div>'.$alertaAlterarSenha.'</div>' : '';
?>

<main>
  <a href="dados_listar.php?codus=<?php echo $usuario['codus']; ?>">Voltar</a>
  <h1>Alterar senha</h1>

  <?=$alertaAlterarSenha?>

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
      <label for="senha-atual" class="inputLabel">Senha atual</label>
      <input 
        type="password" 
        name="senha-atual" 
        class="inputUser" 
        placeholder="Senha atual" 
        required 
      />
    </div>

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