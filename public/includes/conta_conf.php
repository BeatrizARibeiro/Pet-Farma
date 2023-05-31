<?php
  $acao = ($obUsuario->situacao == 'ativa') ? 'desativar' : 'ativar';

  $alerta = strlen($alerta) ? '<div>'.$alerta.'</div>' : '';
  print_r($obPedidos);

?>

<main>
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
  <link rel="stylesheet" href="./public/css/StyleStatusConta.css">
  <title>Entrar</title>
</head>
  <a href="dados_listar.php?codus=<?=$usuarioLogado['codus']?>">Voltar</a>
  <h2><?=$acao == 'desativar' ? 'Desativar conta' : 'Ativar conta'?></h2>
  
  <form method="post">
    <div class="form-group">
      <h3>Sentiremos sua falta... Deseja realmente desativar sua conta ?</h3>
      <p>Não será possível realizar novos pedidos até que a ative novamente.</p>
    </div>

    <?=$alerta?>

    <div class="form-group">
      <a href="dados_listar.php?codus=<?=$usuarioLogado['codus']?>">
        <button type="button">Agora não</button>
      </a>

      <button type="submit" name="desativar">Desativar 😥</button>
    </div>
  </form>
</main>
