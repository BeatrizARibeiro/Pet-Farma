<?php
  $alerta = strlen($alerta) ? '<div>'.$alerta.'</div>' : '';
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
  />
  <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
  <link rel="stylesheet" href="./public/css/StyleLogin.css" />
  <title>Entrar</title>
</head>

<body>
  <section id="header">
    <a href="index.php"
      ><img src="./public/img/logopetfarma2.png" class="logo" alt=""
    /></a>

    <div>
      <ul id="navbar">
        <li>
          <i class="fas fa-solid fa-lock"></i>
          <h3>Ambiente seguro</h3>
        </li>
      </ul>
    </div>
  </section>

  <div class="container">
    <!-- Alterar senha -->

    <div class="content first-content">
      <div class="first-column">
        <h2 class="title title-primary">Alterar senha</h2>
        <!-- <p class="description description-primary">Bem vindo(a), ao Alterar senha</p> -->
      </div>

      <div class="second-column">
        <h2 class="title title-second">Alterar Senha</h2>

        <form class="form" method="post">
          <label for="senha" class="label-input">
            <i class="fas fa-light fa-lock icon-modify"></i>
            <input
              type="password"
              name="senha"
              id="novaSenha"
              placeholder="Nova senha"
              required
            />
            <span class="password-toggle" onclick="mostrarSenha('novaSenha', 'eyeIconNova')">
                <i id="eyeIconNova" class="fas fa-solid fa-eye icon-modify"></i>
            </span>
          </label>

          <label for="confirmar-senha" class="label-input">
            <i class="fas fa-light fa-lock icon-modify"></i>
            <input
              type="password"
              name="confirmar-senha"
              id="confirmarSenha"
              placeholder="Confirme a nova senha"
              required
            />
            <span class="password-toggle" onclick="mostrarSenha('confirmarSenha', 'eyeIconConf')">
                <i id="eyeIconConf" class="fas fa-solid fa-eye icon-modify"></i>
            </span>
          </label>

          <?=$alerta?>

          <button
            class="btn btn-second"
            type="submit"
            name="acao"
            value="alterar-senha"
          >
            Salvar senha
          </button>
        </form>
      </div>
    </div>
  </div>
  <script src="./public/js/senha.js"></script>
</body>
