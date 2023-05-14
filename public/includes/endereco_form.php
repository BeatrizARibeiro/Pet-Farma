  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetFarma</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StyleCadastroEndereco.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="./public/js/masks.js"></script>
  </head>




<body>
    <section id="header">
    <a href="index.php"><img src="./public/img/logopetfarma2.png" class="logo" alt=""></a>

    <div>
      <ul id="navbar">
        <li><i class="fas fa-solid fa-lock"></i>
          <h3>Ambiente seguro</h3>
        </li>
      </ul>
    </div>
  </section>
  
  <main>
    <div class="form-container">
      <form method="POST">
        <a href="dados_listar.php?codus=<?php echo $usuario['codus']; ?>">Voltar</a>
        <h1>Cadastrar endereço</h1>
        
        <div class="form-group">
          <label for="cep" class="inputLabel">CEP</label>
          <input
          type="text"
          name="cep"
          id="cep"
          class="inputUser"
          required
          />
        </div>
        
        <div class="form-group">
          <label for="rua" class="inputLabel">Rua</label>
          <input
          type="text"
          name="rua"
          id="rua"
          class="inputUser"
          required
          />
        </div>
        
        <div class="form-group">
      <label for="bairro" class="inputLabel">Bairro</label>
      <input
        type="text"
        name="bairro"
        id="bairro"
        class="inputUser"
        required
        />
      </div>
      
      <div class="form-group">
        <label for="numero" class="inputLabel">Numero</label>
        <input
        type="number"
        name="numero"
        id="numero"
        class="inputUser"
        required
        />
      </div>
      
      <div class="form-group">
        <label for="tipo">Tipo</label>
        <select id="tipo" name="tipo">
          <option value="casa">Casa</option>
          <option value="apartamento">Apartamento</option>
        </select>
      </div>
      <div class="form-group">
        <input type="submit" name="acao" value="cadastrar" class="form-button">
      </div>
    </form>
  </div>
</main>

</body>





<!-- 
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
        type="number"
        name="numero"
        id="numero"
        class="inputUser"
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
</main> -->