<?php
  $alertaLogin = strlen($alertaLogin) ? '<div>'.$alertaLogin.'</div>' : '';
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
      
      <!-- ENTRAR -->
      
      <div class="content first-content">
      <div class="first-column">
        <h2 class="title title-primary">Olá!</h2>
        <p class="description description-primary">Ainda não é cadastrado?</p>
        <p class="description description-primary">cadastre-se em</p>
        <a id="btnCadastrar" class="btn btn-primary" href="cadastro.php">Cadastre-se</a>
      </div>

      <div class="second-column">
        
        <h2 class="title title-second">Entrar na sua conta</h2>
        <form class="form" method="post">
          <label class="label-input" for="email">
            <i class="fas fa-regular fa-envelope icon-modify"></i>
            <input type="text" 
        name="email" 
        class="inputUser" 
        placeholder="E-mail" 
        required >
          </label>

          <label class="label-input" for="senha">
            <i class="fas fa-light fa-lock icon-modify"></i>
            <input type="password" 
        name="senha" 
        class="inputUser" 
        placeholder="Senha" 
        required >
          </label>
          <a class="password" href="senha_esqueci.php">esqueceu a sua senha?</a>
            
          <button class="btn btn-second" type="submit" 
      name="acao" 
      value="logar">Entrar</button>
        </form>
        <center><br/><?=$alertaLogin?></center>
        <center><br/><?=$mensagem?></center>
      </div>
    </div>

  </div>
  <!-- <script src="/script/scriptLogin.js"></script> -->
</body>




<!-- 
<main>
  <a href="index.php">Voltar</a>
  <h1>Login</h1>

  <?=$alertaLogin?>

  <form method="post">

    <div class="inputBox">
      <label for="email" class="inputLabel">Email</label>
      <input 
        type="text" 
        name="email" 
        class="inputUser" 
        placeholder="Email" 
        required 
      />
    </div>

    <div class="inputBox">
      <label for="senha" class="inputLabel">Senha</label>
      <input 
        type="password" 
        name="senha" 
        class="inputUser" 
        placeholder="Senha" 
        required 
      />
    </div>

    <button 
      type="submit" 
      name="acao" 
      value="logar">
      Acessar
    </button>

  </form>

    <a href="senha_esqueci.php">Esqueci minha senha</a>

  
</main> -->