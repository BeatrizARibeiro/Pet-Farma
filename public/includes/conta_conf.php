<?php
$acao = ($obUsuario->situacao == 'ativa') ? 'desativar' : 'ativar';
$botaoTexto = ($acao == 'desativar') ? 'Desativar 😥' : 'Ativar 🐶';
$botaoEstilo = ($acao == 'desativar') ? 'background: red;' : 'background: green;';
$alertaTexto = ($acao == 'desativar') ? 'Sentiremos sua falta... Deseja realmente desativar sua conta ?' : 'Você está de volta :) deseja reativar sua conta agora ?';
$alertaMensagem = ($acao == 'desativar') ? 'Não será possível realizar novos pedidos até que a ative novamente.' : '';
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
      <h3><?=$alertaTexto?></h3>
      <p><?=$alertaMensagem?></p>
    </div>

    <?=$alertaDesativar?>

    <div class="form-group">
      <a href="dados_listar.php?codus=<?=$usuarioLogado['codus']?>">
        <button type="button">Agora não</button>
      </a>

      <button type="submit" name="desativar" style="<?=$botaoEstilo?>"><?=$botaoTexto?></button>
    </div>
  </form>
</main>
