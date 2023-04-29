<?php
  $alertaEditarDados = strlen($alertaEditarDados) ? '<div>'.$alertaEditarDados.'</div>' : '';
?>
<main>
  <a href="index.php">Voltar</a>
  <h1>Editar Endereço</h1>
    <form  method="POST">
      <?=$alertaEditarDados?>
    <div class="inputBox">
        <label for="nome" class="inputLabel">CEP</label>
        <input
          type="text"
          name="cep"
          id="cep"
          class="inputUser"
          required
          value="<?php echo $obEndereco->cep; ?>"
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
          value="<?php echo $obEndereco->rua; ?>"
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
          value="<?php echo $obEndereco->bairro; ?>"
        />
      </div>

      <div class="inputBox">
        <label for="numero" class="inputLabel">Número</label>
        <input
          type="tel"
          name="numero"
          id="numero"
          class="inputUser"
          required
          value="<?php echo $obEndereco->numero; ?>"
        />
      </div>

      <div class="inputBox">
        <label for="tipo" class="inputLabel">Tipo</label>
        <input
          type="text"
          name="tipo"
          id="tipo"
          class="inputUser"
          required
          value="<?php echo $obEndereco->tipo; ?>"
        />
      </div>

    <button type="submit" name="acao" value="atualizar">Atualizar</button>

  </form>
</main>