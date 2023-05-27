<?php
  $alerta = strlen($alerta) ? '<div>'.$alerta.'</div>' : '';
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
  <link rel="stylesheet" href="./public/css/StyleLogin.css">
  <title>Entrar</title>
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

  <div class="container">
      
      <!-- Troca de Senha -->
      
      <div class="content first-content">
      <div class="first-column">
        <h2 class="title title-primary">Olá!</h2>
        <p class="description description-primary">Caso não lembre sua senha, poderá solicitar a troca!</p>
      </div>

      <div class="second-column">
        <h2 class="title title-second">Solicitar Troca de Senha</h2>
        <p class="description description-second">Informe seu E-mail</p>
        <form class="form" method="post">
          <label class="label-input" for="email">
            <i class="fas fa-regular fa-envelope icon-modify"></i>
            <input type="text" 
        name="email" 
        placeholder="E-mail" 
        required >
          </label>
          <?=$alerta?>
          <button class="btn btn-second" type="submit" 
      name="acao" 
      value="trocar">Enviar</button>
        </form>
      </div>
    </div>

  </div>
</body>