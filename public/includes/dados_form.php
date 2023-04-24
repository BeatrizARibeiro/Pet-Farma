<main>
  <form  method="POST">
    <a href="index.php">Voltar</a>
    <h1>Meus dados</h1>

    <div class="inputBox">
        <label for="nome" class="inputLabel">Nome completo</label>
        <input
          type="text"
          name="nome"
          id="nome"
          class="inputUser"
          required
          value="<?php echo $obUsuario->nome; ?>"
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
          value="<?php echo $obUsuario->email; ?>"
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
          value="<?php echo $obUsuario->cpf; ?>"
        />
      </div>

      <div class="inputBox">
        <label for="telefone" class="inputLabel">Telefone</label>
        <input
          type="tel"
          placeholder="(99) 9999-9999"
          name="telefone"
          id="telefone"
          class="inputUser"
          required
          value="<?php echo $obUsuario->telefone; ?>"
        />
      </div>

    <button type="submit" name="acao" value="atualizar">Atualizar</button>

  </form>
</main>