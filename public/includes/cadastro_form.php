<?php
  $alertaCadastro = strlen($alertaCadastro) ? '<div>'.$alertaCadastro.'</div>' : '';

?>
<main>
  <a href="index.php">Voltar</a>
  <h1>Criar conta</h1>

  <?=$alertaCadastro?>

  <form  method="POST">

    <div class="inputBox">
      <label for="nome" class="inputLabel">Nome completo</label>
      <input
        type="text"
        name="nome"
        id="nome"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="email" class="inputLabel">Email</label>
      <input
        type="text"
        name="email"
        id="email"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="senha" class="inputLabel">Senha</label>
      <input
        type="password"
        name="senha"
        id="senha"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="cpf" class="inputLabel">CPF</label>
      <input
        type="text"
        name="cpf"
        id="cpf"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="telefone" class="inputLabel">Telefone</label>
      <input
        type="tel"
        pattern="\(\d{2}\) \d{4}-\d{4}" 
        placeholder="(99) 9999-9999"
        name="telefone"
        id="telefone"
        class="inputUser"
        required
      />
    </div>

    <button type="submit" name="acao" value="cadastrar">Cadastrar</button>

  </form>

  
</main>