<?php

use App\Entity\Endereco;
use \App\Session\Login;

  $usuarioLogado = Login::getUsuarioLogado();
  $obEndereco = Endereco::getEnderecosCli($usuarioLogado['codus']);

  $nomeUsuario = $usuarioLogado['nome'];

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
<h1>Olá, <?=$nomeUsuario?></h1>
<a href="index.php" class="">Voltar</a>
</div>

</div>

<div class="meusDadosPessoais">
  
  <div class="tbDadosPessoais">
    <table>
      <h1>Meus dados</h1>
  <tbody>
    <tr>
      <td class="titleTd">Nome completo:</td>
      <td><?php echo $obUsuario->nome; ?></td>
    </tr>
    <tr>
      <td class="titleTd">Email:</td>
      <td><?php echo $obUsuario->email; ?></td>
    </tr>
    <tr>
      <td class="titleTd">Senha:</td>
      <td><a href="senha_editar.php?codus=<?php echo $usuario['codus']; ?>">alterar senha</a></td>
    </tr>
    <tr>
      <td class="titleTd">CPF:</td>
      <td><?php echo $obUsuario->cpf; ?></td>
    </tr>
    <tr>
      <td class="titleTd">Telefone:</td>
      <td><?php echo $obUsuario->telefone; ?></td>
    </tr>
    <tr>
      <td class="titleTd">Ações:</td>
      <td><a href="dados_editar.php?codus=<?php echo $usuarioLogado['codus']; ?>">Editar</a></td>
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

  <?php if (is_countable($obEndereco) && count($obEndereco) > 0) { ?>
    <table>
      <?php foreach ($obEndereco as $endereco) { ?>
        <tbody>
          <tr>
            <th class="titleTd">CEP:</th>
    <td><?php echo $endereco->cep; ?></td>
  </tr>
  <tr>
    <th class="titleTd">Rua:</th>
    <td><?php echo $endereco->rua; ?></td>
  </tr>
  <tr>
    <th class="titleTd">Bairro:</th>
    <td><?php echo $endereco->bairro; ?></td>
  </tr>
  <tr>
    <th class="titleTd">Número:</th>
    <td><?php echo $endereco->numero; ?></td>
  </tr>
  <tr>
    <th class="titleTd">Tipo:</th>
    <td><?php echo $endereco->tipo; ?></td>
  </tr>
  <tr>
    <th class="titleTd">Ações:</th>
    <td>
      <a href="endereco_editar.php?codend=<?php echo $endereco->codend; ?>">Editar</a>
      <a href="endereco_excluir.php?codend=<?php echo $endereco->codend; ?>">Excluir</a>
    </td>
  </tr>
  <?php } ?>
</tbody>
</table>
<?php } else { ?>
  <p>Nenhum endereço cadastrado.</p>
  <?php } ?>
  
</div>
</div>
  

  
  
  
  
  
  
  <main>
  <!-- <h2>Dados pessoais</h2> -->


  

</main>




<!-- <main>
  <a href="index.php">Voltar</a>
  <h1>Meus dados</h1>
  <h2>Dados pessoais</h2>

<table>
  <tbody>
    <tr>
      <td>Nome completo:</td>
      <td><?php echo $obUsuario->nome; ?></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><?php echo $obUsuario->email; ?></td>
    </tr>
    <tr>
      <td>Senha:</td>
      <td><a href="senha_editar.php?codus=<?php echo $usuario['codus']; ?>">alterar senha</a></td>
    </tr>
    <tr>
      <td>CPF:</td>
      <td><?php echo $obUsuario->cpf; ?></td>
    </tr>
    <tr>
      <td>Telefone:</td>
      <td><?php echo $obUsuario->telefone; ?></td>
    </tr>
    <tr>
      <td>Ações:</td>
      <td><a href="dados_editar.php?codus=<?php echo $usuarioLogado['codus']; ?>">Editar</a></td>
    </tr>
  </tbody>
</table>


  <h2>Endereços</h2>
  <a href="endereco_cadastro.php">Adicionar novo endereço</a>
  <?php if (is_countable($obEndereco) && count($obEndereco) > 0) { ?>
  <table>
    <?php foreach ($obEndereco as $endereco) { ?>
    <tbody>
        <tr>
    <th>CEP:</th>
    <td><?php echo $endereco->cep; ?></td>
    </tr>
    <tr>
      <th>Rua:</th>
      <td><?php echo $endereco->rua; ?></td>
    </tr>
    <tr>
      <th>Bairro:</th>
      <td><?php echo $endereco->bairro; ?></td>
    </tr>
    <tr>
      <th>Número:</th>
      <td><?php echo $endereco->numero; ?></td>
    </tr>
    <tr>
      <th>Tipo:</th>
      <td><?php echo $endereco->tipo; ?></td>
    </tr>
    <tr>
      <th>Ações:</th>
      <td>
        <a href="endereco_editar.php?codend=<?php echo $endereco->codend; ?>">Editar</a>
        <a href="endereco_excluir.php?codend=<?php echo $endereco->codend; ?>">Excluir</a>
      </td>
    </tr>
        <?php } ?>
      </tbody>
  </table>
<?php } else { ?>
  <p>Nenhum endereço cadastrado.</p>
<?php } 

$cep = "18160-000";
$url = "https://viacep.com.br/ws/$cep/json/";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$endereco = json_decode($response, true);

echo "Endereço: ".$endereco['logradouro'].", ".$endereco['bairro'].", ".$endereco['localidade']." - ".$endereco['uf'];

?>

  


</main> -->