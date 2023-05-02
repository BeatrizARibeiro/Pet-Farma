<?php
  $alertaCadastro = strlen($alertaCadastro) ? '<div>'.$alertaCadastro.'</div>' : '';

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

    <!-- CADASTRAR -->
    <div class="content first-content">

      <div class="first-column">
        <h2 class="title title-primary">Bem-Vindo de volta!</h2>
        <p class="description description-primary">Para realizar as compras no site</p>
        <p class="description description-primary">por favor, faça login com o seu E-mail pessoal em</p>
       <a class="btn btn-primary" id="btnEntrar" href="login.php">Entrar</a>
      </div>

      <div class="second-column">
        <h2 class="title title-second">Criar Conta</h2>
        <form class="form">
          <label class="label-input" for="nome">
            <i class="fas fa-regular fa-user icon-modify"></i>
            <input 
            type="text"
            name="nome"
            id="nome"
        placeholder="Nome Completo"
        required>
      </label>
      <label class="label-input" for="cpf">
        <i class="fas fa-regular fa-user icon-modify"></i>
        <input type="text"
        name="cpf"
        id="cpf"
        placeholder="CPF"
        required>
      </label>
      <label class="label-input" for="telefone">
        <i class="fas fa-light fa-phone icon-modify"></i>
        <input type="tel" 
        type="tel"
        name="telefone"
        id="telefone"
        placeholder="Telefone"
        required>
      </label>
      <label class="label-input" for="email">
        <i class="fas fa-regular fa-envelope icon-modify"></i>
        <input placeholder="E-mail"
            type="text"
        name="email"
        id="email"
        required>
      </label>
      <label class="label-input" for="senha">
        <i class="fas fa-light fa-lock icon-modify"></i>
        <input type="password" placeholder="Senha"
        name="senha"
        id="senha"
        required>
      </label>
      <?=$alertaCadastro?>
          <button class="btn btn-second" type="submit" name="acao" value="cadastrar">cadastre-se</button>
        </form>
      </div>
      
    </div>

  </div>
  <!-- <script src="/script/scriptLogin.js"></script> -->
</body>
















<!-- 
<main>
  <a href="index.php">Voltar</a>
  <h1>Criar conta</h1>

  <?=$alertaCadastro?>

  <form  method="POST">

    <div class="inputBox">
      <label for="nome" class="inputLabel">Nome completo</label>
      <input
        type="text"
        name="nome"
        id="nome"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="email" class="inputLabel">Email</label>
      <input
        type="text"
        name="email"
        id="email"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="senha" class="inputLabel">Senha</label>
      <input
        type="password"
        name="senha"
        id="senha"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="cpf" class="inputLabel">CPF</label>
      <input
        type="text"
        name="cpf"
        id="cpf"
        class="inputUser"
        required
      />
    </div>

    <div class="inputBox">
      <label for="telefone" class="inputLabel">Telefone</label>
      <input
        type="tel"
        placeholder="(99) 9999-9999"
        name="telefone"
        id="telefone"
        class="inputUser"
        required
      />
    </div>

    <button type="submit" name="acao" value="cadastrar">Cadastrar</button>

  </form>

  
</main> -->