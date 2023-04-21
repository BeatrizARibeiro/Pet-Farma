<?php
  $alertaCadastro = strlen($alertaCadastro) ? '<div>'.$alertaCadastro.'</div>' : '';
?>
<main>
  <a href="index.php">Voltar</a>
  <h1>Criar conta</h1>

  <?=$alertaCadastro?>

  <form  method="POST">
    <div class="inputBox">
      <input
        type="text"
        name="nome"
        id="nome"
        class="inputUser"
        required
      />
      <label for="nome" class="labelInput"> Nome completo </label>
    </div>
    <br /><br />
    <div class="inputBox">
      <input
        type="text"
        name="email"
        id="email"
        class="inputUser"
        required
      />
      <label for="email" class="labelInput"> Email </label>
    </div>
    <br /><br />

    <div class="inputBox">
      <input
        type="password"
        name="senha"
        id="senha"
        class="inputUser"
        required
      />
      <label for="senha" class="labelInput"> Senha </label>
    </div>
    <br /><br />

    <div class="inputBox">
      <input
        type="text"
        name="cpf"
        id="cpf"
        class="inputUser"
        required
      />
      <label for="cpf" class="labelInput"> CPF </label>
    </div>
    <br /><br />

    <div class="inputBox">
      <input
        type="tel"
        name="telefone"
        id="telefone"
        class="inputUser"
        required
      />
      <label for="telefone" class="labelInput"> Telefone </label>
    </div>
    <br /><br />

    <!-- <p>Endereço</p>

    <div class="inputBox">
      <input
        type="text"
        name="cep"
        id="cep"
        class="inputUser"
        required
      />
      <label for="cep" class="labelInput">
        <b>CEP</b>
      </label>
    </div>
    <br /><br />

    <div class="inputBox">
      <input
        type="text"
        name="rua"
        id="rua"
        class="inputUser"
        required
      />
      <label for="rua" class="labelInput">
        <b>Rua</b>
      </label>
    </div>
    <br /><br />

    <div class="inputBox">
      <input
        type="text"
        name="bairro"
        id="bairro"
        class="inputUser"
        required
      />
      <label for="bairro" class="labelInput">
        <b>Bairro</b>
      </label>
    </div>
    <br /><br />

    <div class="inputBox">
      <input
        type="text"
        name="numero"
        id="numero"
        class="inputUser"
      />
      <label for="numero" class="labelInput">
        <b>Número</b>
      </label>
    </div>
    <br /><br />

    <div class="inputBox">
      <input
        type="text"
        name="tipo"
        id="tipo"
        class="inputUser"
      />
      <label for="tipo" class="labelInput">
        <b>Tipo</b>
      </label>
    </div>
    <br /><br /> -->

    <button type="submit" name="acao" value="cadastrar">Cadastrar</button>
  </form>
</main>