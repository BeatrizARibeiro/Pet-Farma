<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Excluir Produto</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StyleExcluirEndereco.css">
  </head>

  <body>
<main>

  
  <form method="post">
    
    <div class="form-group">
      <h2>Cancelar Pedido</h2>
      <p>Você deseja realmente cancelar o pedido nº <strong><?=$pedido->numpedido?></strong>? &#128542;</p>
    <!-- 

    <div class="form-group"> -->
    <div class="btnContainer">
      <a href="pedido_ver.php?numpedido=<?=$pedido->numpedido?>">
        <button class="btnExcluir" type="button">Não</button>
        <button class="btnExcluir" type="submit" name="sim">Sim</button>
      </a>
    </div>
</div>
  </form>

</main>

</body>