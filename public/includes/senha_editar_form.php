<?php
  $alertaAlterarSenha = strlen($alertaAlterarSenha) ? '<div>'.$alertaAlterarSenha.'</div>' : '';
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
        <h2 class="title title-primary">Olá!</h2>
        <p class="description description-primary">
          Para alterar a sua senha, insira sua senha anterior
        </p>
      </div>

      <div class="second-column">
        <h2 class="title title-second">Alterar Senha</h2>

        <form class="form" method="post">
          <label class="label-input" for="email">
            <i class="fas fa-regular fa-envelope icon-modify"></i>
            <input type="text" name="email" placeholder="Email" required />
          </label>

          <label class="label-input" for="senha-atual">
            <i class="fas fa-light fa-lock icon-modify"></i>
            <input
              type="password"
              name="senha-atual"
              placeholder="Senha atual"
              required
            />
          </label>

          <label class="label-input" for="senha">
            <i class="fas fa-light fa-lock icon-modify"></i>
            <input
              type="password"
              name="senha"
              placeholder="Nova senha"
              required
            />
          </label>

          <label class="label-input" for="confirmar-senha">
            <i class="fas fa-light fa-lock icon-modify"></i>
            <input
              type="password"
              name="confirmar-senha"
              placeholder="Confirma a Nova Senha"
              required
            />
          </label>
          <?=$alertaAlterarSenha?>
          <button
            class="btn btn-second"
            type="submit"
            name="acao"
            value="alterar-senha"
          >
            Salvar Senha
          </button>
        </form>
      </div>
    </div>
  </div>
  <!-- <script src="/script/scriptLogin.js"></script> -->
</body>
