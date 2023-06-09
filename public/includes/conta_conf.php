<?php
  $acao = ($obUsuario->situacao == 'ativa') ? 'desativar' : 'ativar';

  $alerta = strlen($alerta) ? '<div>'.$alerta.'</div>' : '';

?>

 <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
  <link rel="stylesheet" href="./public/css/StyleExcluirEndereco.css">
  <title>Entrar</title>
</head>

<main>
 
  <form method="post">
    <div class="form-group">
    <div class="btnContainer">
  <a class="btnExcluir" href="dados_listar.php?codus=<?=$usuarioLogado['codus']?>">Voltar</a>
  </div>
  <h2><?=$acao == 'desativar' ? 'Desativar conta' : 'Ativar conta'?></h2>
  
      <p>Sentiremos sua falta... Deseja realmente desativar sua conta ?</p>
      <p><i>Não será possível realizar novos pedidos até que a ative novamente.</i></p>


    <?=$alerta?>

 <div class="btnContainer">
   <a href="dados_listar.php?codus=<?=$usuarioLogado['codus']?>">
    <button class="btnExcluir" type="button">Agora não</button>
  </a>
  <button class="btnExcluir" type="submit" name="desativar">Desativar</button>
 <!-- 😥 -->
 </div>

    </div>
  </form>
</main>
