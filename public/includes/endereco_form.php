<main>
  <form method="POST">
    <a href="dados_listar.php?codus=<?php echo $usuario['codus']; ?>">Voltar</a>
    <h1>Cadastrar endereço</h1>

    <div class="inputBox">
      <label for="cep" class="inputLabel">CEP</label>
      <input
        type="text"
        name="cep"
        id="cep"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="rua" class="inputLabel">Rua</label>
      <input
        type="text"
        name="rua"
        id="rua"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="bairro" class="inputLabel">Bairro</label>
      <input
        type="text"
        name="bairro"
        id="bairro"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="numero" class="inputLabel">Numero</label>
      <input
        type="text"
        name="numero"
        id="numero"
        class="inputUser"
      />
    </div>

    <div class="inputBox">
      <label for="tipo" class="inputLabel">Tipo</label>
      <input
        type="text"
        name="tipo"
        id="tipo"
        class="inputUser"
      />
    </div>

        <button type="submit" name="acao" value="cadastrar">Cadastrar</button>
  </form>
</main>