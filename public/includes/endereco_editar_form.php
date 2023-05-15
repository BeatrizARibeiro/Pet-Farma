<?php
  $alertaEditarDados = strlen($alertaEditarDados) ? '<div>'.$alertaEditarDados.'</div>' : '';
?>
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    
  </head>
<main>
  <body>
    <a href="index.php">Voltar</a>
    <h1>Editar Endereço</h1>
    <form  method="POST">
      <?=$alertaEditarDados?>
      <div class="inputBox">
        <label for="cep" class="inputLabel">CEP</label>
        <input
        type="text"
        name="cep"
        id="cep"
        class="inputUser"
        required
        value="<?php echo $obEndereco->cep; ?>"
        />
      </div>

      <div class="form-group">
        <label for="uf" class="inputLabel">UF</label>
        <select
          name="uf"
          id="uf"
          class="inputUser"
          required
          >
          <option value="<?php echo $obEndereco->uf; ?>" selected disabled hidden>Selecione um estado</option>
        </select>
      </div>
      
      <div class="inputBox">
        <label for="cidade" class="inputLabel">Cidade</label>
        <input
        type="text"
          name="cidade"
          id="cidade"
          class="inputUser"
          required
          value="<?php echo $obEndereco->cidade; ?>"
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
          <select name="tipo" id="tipo" class="inputUser" required>
            <option value="casa" <?php if($obEndereco->tipo === 'casa') echo 'selected'; ?>>Casa</option>
            <option value="apartamento" <?php if($obEndereco->tipo === 'apartamento') echo 'selected'; ?>>Apartamento</option>
          </select>
        </div>

        

      <button type="submit" name="acao" value="atualizar">Atualizar</button>
      
    </form>
    <script src="./public/js/masks.js"></script>
    <script src="./public/js/cep.js"></script>
  </body>
</main>