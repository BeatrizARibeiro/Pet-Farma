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
      
      <!-- Alterar senha -->
      
      <div class="content first-content">
      <div class="first-column">
        <h2 class="title title-primary">Alterar senha</h2>
        <!-- <p class="description description-primary">Bem vindo(a), ao Alterar senha</p> -->
      </div>

      <div class="second-column">
        <h2 class="title title-second">Alterar Senha</h2>

  <form class="form" method="post">
          
      <label for="senha" class="label-input" >
      <i class="fas fa-light fa-lock icon-modify"></i>
      <input 
        type="password" 
        name="senha" 
        placeholder="Nova senha" 
        required 
      />
   </label>

    
      <label for="confirmar-senha" class="label-input">
      <i class="fas fa-light fa-lock icon-modify"></i>
      <input 
        type="password" 
        name="confirmar-senha" 
        placeholder="Confirme a nova senha" 
        required 
      />
    </label>
   

          <?=$alerta?>

      <button
      class="btn btn-second" 
      type="submit" 
      name="acao" 
      value="alterar-senha">
      Salvar senha
    </button>

  </form>
      </div>
    </div>

  </div>
  <!-- <script src="/script/scriptLogin.js"></script> -->
</body>








<!-- <main>
  <a href="index.php">Voltar</a>
  <h1>Alterar senha</h1>

  <?=$alerta?>

  <form method="post">

    <div class="inputBox">
      <label for="senha" class="inputLabel">Nova senha</label>
      <input 
        type="password" 
        name="senha" 
        class="inputUser" 
        placeholder="Nova senha" 
        required 
      />
    </div>

    <div class="inputBox">
      <label for="confirmar-senha" class="inputLabel">Confirme a nova senha</label>
      <input 
        type="password" 
        name="confirmar-senha" 
        class="inputUser" 
        placeholder="Digite a senha novamente" 
        required 
      />
    </div>

    <button 
      type="submit" 
      name="acao" 
      value="alterar-senha">
      Salvar senha
    </button>

  </form>

</main> -->