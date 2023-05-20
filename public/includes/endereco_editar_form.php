<?php
  $alertaEditarDados = strlen($alertaEditarDados) ? '<div>'.$alertaEditarDados.'</div>' : ''?>
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    
  </head>
<main>
  <body>
    <a href="dados_listar.php?codus=<?=$usuarioLogado['codus']?>">Voltar</a>
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
        value="<?=$obEndereco->cep?>"
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
          <option value="<?=$obEndereco->uf?>">Selecione um estado</option>
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
          value="<?=$obEndereco->cidade?>"
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
        value="<?=$obEndereco->rua?>"
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
          value="<?=$obEndereco->bairro?>"
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
          value="<?=$obEndereco->numero?>"
          />
        </div>

        <div class="inputBox">
          <label for="tipo" class="inputLabel">Tipo</label>
          <select name="tipo" id="tipo" class="inputUser" required>
            <option value="casa" <?php if($obEndereco->tipo === 'casa') echo 'selected'?>>Casa</option>
            <option value="apartamento" <?php if($obEndereco->tipo === 'apartamento') echo 'selected'?>>Apartamento</option>
          </select>
        </div>

        <div class="form-group">
          <label for="padrao">Definir como padrão</label>
          <input type="checkbox" name="padrao" id="padrao" value="1" <?=($obEndereco->padrao == 1) ? 'checked' : '' ?>>
        </div>

      <button type="submit" name="acao" value="atualizar">Atualizar</button>
      
    </form>
    <script src="./public/js/masks.js"></script>
    <script src="./public/js/cep.js"></script>
  </body>
</main>