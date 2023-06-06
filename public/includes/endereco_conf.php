<?php
  $alerta = strlen($alerta) ? '<div>'.$alerta.'</div>' : '';
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Excluir Endereço</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StyleExcluirEndereco.css">
    <link rel="stylesheet" href="./public/css/styleMensagens.css">
</head>

<body>
    <main>
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
    
      <form method="post">
        
        <div class="form-group">
          <h2>Excluir Endereço</h2>
          <p>Você deseja realmente excluir o endereço <strong><?=$obEndereco->rua.', '. $obEndereco->numero.' - '. $obEndereco->bairro ?></strong>?</p>
        <!-- </div>

        <div class="form-group"> -->
          
          <div class="btnContainer">
            <a href="dados_listar.php?codus=<?=$usuarioLogado['codus']?>">
              <button class="btnExcluir" type="button">Cancelar</button>
              <button class="btnExcluir" type="submit" name="acao" value="excluir">Excluir</button>
            </a>
            <?=$alerta?>
          </div>

        </div>

      </form>
    </main>
</body>
  