<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Excluir Endereço</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StyleExcluirEndereco.css">
  </head>

  <body>
<main>
  <!--Confirmacao de exclusao de categoria-->
  
  <form method="post">
    
    <div class="form-group">
      <h2>Excluir Item do Carrinho</h2>
      <p>Você deseja realmente excluir o item <strong><?=$produto->nome_prod?></strong>?</p>
    

    <div class="btnContainer">
      <a href="carrinho.php">
        <button class="btnExcluir" type="button">Cancelar</button>
        <button class="btnExcluir" type="submit" name="excluir">Excluir</button>
      </a>
    </div>
</div>
  </form>

</main>
</body>