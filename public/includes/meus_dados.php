<?php

use App\Entity\Endereco;
use \App\Session\Login;

  $usuarioLogado = Login::getUsuarioLogado();
  $obEndereco = Endereco::getEnderecosCli($usuarioLogado['codus']);

?>
<main>
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
<?php } ?>


</main>