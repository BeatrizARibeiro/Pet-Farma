<?php
  $alertaEditarDados = strlen($alertaEditarDados) ? '<div>'.$alertaEditarDados.'</div>' : '';
?>
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
  <a href="dados_listar.php?codus=<?=$usuario['codus']?>">Voltar</a>
  <h1>Editar dados</h1>
    <form  method="POST">
      <?=$alertaEditarDados?>
    <div class="form-group">
        <label for="nome" class="inputLabel">Nome completo</label>
        <input
          type="text"
          name="nome"
          id="nome"
          class="inputUser"
          required
          value="<?=$obUsuario->nome?>"
        />
      </div>

      <div class="form-group">
        <label for="email" class="inputLabel">Email</label>
        <input
          type="text"
          name="email"
          id="email"
          class="inputUser"
          required
          value="<?=$obUsuario->email?>"
        />
      </div>

      <div class="form-group">
        <label for="cpf" class="inputLabel">CPF</label>
        <input
          type="text"
          name="cpf"
          id="cpf"
          class="inputUser"
          required
          value="<?=$obUsuario->cpf?>"
        />
      </div>

      <div class="form-group">
        <label for="telefone" class="inputLabel">Telefone</label>
        <input
          type="tel"
          placeholder="(99) 9999-9999"
          name="telefone"
          id="telefone"
          class="inputUser"
          required
          value="<?=$obUsuario->telefone?>"
        />
      </div>

      <div class="form-group">
        <label for="senha" class="inputLabel">Senha</label>
        <input
          type="password"
          name="senha"
          id="senha"
          class="inputUser"
          required
        />
      </div>

      <div class="btn" >
        <center><button type="submit" name="acao" value="atualizar" class="form-button">Atualizar</button></center>
      </div>

  </form>
</div>
</main>
</body>