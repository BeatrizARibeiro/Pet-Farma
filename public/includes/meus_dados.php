<?php

use App\Entity\Endereco;
use \App\Session\Login;

  $usuarioLogado = Login::getUsuarioLogado();
  $obEndereco = Endereco::getEnderecosCli($usuarioLogado['codus']);
  $status = $obUsuario->situacao;

  $nomeUsuario = $usuarioLogado['nome'];
  $primeiroNome = explode(' ', $nomeUsuario)[0];

  $botaoTexto = ($obUsuario->situacao == 'ativa') ? 'Desativar conta' : 'Ativar conta';
  $botaoEstilo = ($obUsuario->situacao == 'ativa') ? 'background: #DC143C;' : 'background: #67CB57;';
  $pEstilo = ($obUsuario->situacao == 'ativa') ? 'color: green;' : 'color: orange;';

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
  <link rel="stylesheet" href="./public/css/StyleMeusDados.css">
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
  


<div class="divOlaUsuario">
<h1>Olá, <?=$primeiroNome?>!</h1>
<p style="<?=$pEstilo?>">Conta <?=$status?></p>
  <div>
    <a href="index.php" class="">Voltar</a>
    <a href="conta_desativar.php?codus=<?=$usuarioLogado['codus']?>" class="" style="<?=$botaoEstilo?>"><?=$botaoTexto?></a>

  </div>
</div>

</div>

<div class="meusDadosPessoais">
  
  <div class="tbDadosPessoais">
    <table>
      <h1>Meus dados</h1>
  <tbody>
    <tr>
      <td class="titleTd">Nome completo:</td>
      <td><?=$obUsuario->nome?></td>
    </tr>
    <tr>
      <td class="titleTd">Email:</td>
      <td><?=$obUsuario->email?></td>
    </tr>
    <tr>
      <td class="titleTd">Senha:</td>
      <td><a href="senha_editar.php?codus=<?=$usuario['codus']?>">alterar senha</a></td>
    </tr>
    <tr>
      <td class="titleTd">CPF:</td>
      <td><?=$obUsuario->cpf?></td>
    </tr>
    <tr>
      <td class="titleTd">Telefone:</td>
      <td><?=$obUsuario->telefone?></td>
    </tr>
    <tr>
      <td class="titleTd">Ações:</td>
      <td>
        <a href="dados_editar.php?codus=<?=$usuarioLogado['codus']?>">Editar</a>
      </td>
    </tr>
  </tbody>
</table>
</div>
  
<div class="meusDadosPessoais">
  <div class="enderecos">

    <div class="divTitleEndereco">
      <h1>Endereços</h1>
      <a href="endereco_cadastro.php">Adicionar novo endereço</a>
    </div>

    <?php
    if (is_countable($obEndereco) && count($obEndereco) > 0) {
      $enderecoArray = is_array($obEndereco) ? $obEndereco : [$obEndereco];
      $enderecoArray = array_reverse($enderecoArray);
    ?>

      <table>
        <?php foreach ($enderecoArray as $endereco) { ?>
          <tbody class="tbody2">
            <tr>
              <th class="titleTd">CEP:</th>
              <td><?=$endereco->cep?></td>
            </tr>
            <tr>
              <th class="titleTd">Cidade:</th>
              <td><?=$endereco->cidade?></td>
            </tr>
            <tr>
              <th class="titleTd">UF:</th>
              <td><?=$endereco->uf?></td>
            </tr>
            <tr>
              <th class="titleTd">Rua:</th>
              <td><?=$endereco->rua?></td>
            </tr>
            <tr>
              <th class="titleTd">Bairro:</th>
              <td><?=$endereco->bairro?></td>
            </tr>
            <tr>
              <th class="titleTd">Número:</th>
              <td><?=$endereco->numero?></td>
            </tr>
            <tr>
              <th class="titleTd">Tipo:</th>
              <td><?=$endereco->tipo?></td>
            </tr>
            <tr>
              <th class="titleTd">Padrão:</th>
              <td><?=($endereco->padrao == 1) ? "sim" : "não"?></td>
            </tr>
            <tr>
              <th class="titleTd">Ações:</th>
              <td>
                <a href="endereco_editar.php?codend=<?=$endereco->codend?>">Editar</a>
                <a href="endereco_excluir.php?codend=<?=$endereco->codend?>">Excluir</a>
              </td>
            </tr>
          <?php } ?>
          </tbody>
      </table>

    <?php } else { ?>
      <p>Nenhum endereço cadastrado.</p>
    <?php } ?>

    <hr>

  </div>
</div>


</main>
