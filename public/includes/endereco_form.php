  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="./public/js/masks.js"></script>
  </head>

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
        pattern="\d+"
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
        pattern="[a-zA-Z]+"
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
        pattern="[a-zA-Z]+"
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
        pattern="\d+"
        required
      />
    </div>

    <div class="inputBox">
      <label for="tipo">Tipo</label>
      <select id="tipo" name="tipo">
        <option value="casa">Casa</option>
        <option value="apartamento">Apartamento</option>
      </select>
    </div>

        <button type="submit" name="acao" value="cadastrar">Cadastrar</button>
  </form>
</main>