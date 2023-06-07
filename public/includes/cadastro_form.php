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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="./public/js/masks.js"></script>
  <title>Cadastrar</title>
  <style>
    .password-toggle {
      margin-left: 35px;
      cursor: pointer;
    }
  </style>
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
        <form class="form" method="POST">
        <label class="label-input" for="nome">
            <i class="fas fa-regular fa-user icon-modify"></i>
            <input 
                type="text"
                name="nome"
                id="nome"
                placeholder="Nome Completo"
                value="<?php echo (in_array('nome', $camposComErro)) ? '' : htmlspecialchars($_POST['nome'] ?? ''); ?>"
                required
            >
        </label>
        <label class="label-input" for="cpf">
            <i class="fas fa-regular fa-user icon-modify"></i>
            <input 
                type="text"
                name="cpf"
                id="cpf"
                placeholder="CPF"
                value="<?php echo (in_array('cpf', $camposComErro)) ? '' : htmlspecialchars($_POST['cpf'] ?? ''); ?>"
                required
            >
        </label>
        <label class="label-input" for="telefone">
            <i class="fas fa-light fa-phone icon-modify"></i>
            <input 
                type="tel"
                name="telefone"
                id="telefone"
                placeholder="Telefone"
                value="<?php echo (in_array('telefone', $camposComErro)) ? '' : htmlspecialchars($_POST['telefone'] ?? ''); ?>"
                required
            >
        </label>
        <label class="label-input" for="email">
            <i class="fas fa-regular fa-envelope icon-modify"></i>
            <input 
                placeholder="E-mail"
                type="email"
                name="email"
                id="email"
                value="<?php echo (in_array('email', $camposComErro)) ? '' : htmlspecialchars($_POST['email'] ?? ''); ?>"
                required
            >
        </label>
        <label class="label-input" for="senha">
            <i class="fas fa-light fa-lock icon-modify"></i>
            <input 
                type="password" 
                placeholder="Mínimo 6 caracteres e uma letra maiúscula"
                name="senha"
                id="senhaNova"
                required
            >
            <span class="password-toggle" onclick="mostrarSenha('senhaNova', 'eyeIconNova')">
                <i id="eyeIconNova" class="fas fa-solid fa-eye icon-modify"></i>
            </span>
        </label>
        <section style="text-align: center;">
            <?=$alertaCadastro?>
        </section>
        <button class="btn btn-second" type="submit" name="acao" value="cadastrar">cadastre-se</button>
    </form>

      </div>
      
    </div>

  </div>
  <script src="./public/js/senha.js"></script>
</body>
