<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Excluir Endereço</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StyleExcluirEndereco.css">
  </head>


<main>

  <h2>Excluir Endereço</h2>

  <form method="post">

    <div class="form-group">
      <p>Você deseja realmente excluir o endereço <strong><?=$obEndereco->rua.', '. $obEndereco->numero.' - '. $obEndereco->bairro ?></strong>?</p>
    </div>

    <div class="form-group">
      
      <div class="btnContainer">
<a href="dados_listar.php?codus=<?php echo $usuarioLogado['codus']; ?>">
        <button type="button">Cancelar</button>
      </a>
  <button class="btnExcluir" type="submit" name="excluir">Excluir</button>
</div>

    </div>

  </form>

</main>


<!-- <main>

  <h2>Excluir Endereço</h2>

  <form method="post">

    <div class="form-group">
      <p>Você deseja realmente excluir o endereço <strong><?=$obEndereco->rua.', '. $obEndereco->numero.' - '. $obEndereco->bairro ?></strong>?</p>
    </div>

    <div class="form-group">
      <a href="dados_listar.php?codus=<?php echo $usuarioLogado['codus']; ?>">
      <button type="button">Cancelar</button>
    </a>


      <button type="submit" name="excluir">Excluir</button>
    </div>

  </form>

</main> -->