<?php

use App\Entity\Endereco;
use \App\Session\Login;

  $usuarioLogado = Login::getUsuarioLogado();
  $obEndereco = Endereco::getEnderecosCli($usuarioLogado['codus']);

?>
<main>
  <a href="dados_listar.php">Voltar</a>
  <h1>Meus dados</h1>
  <h2>Dados pessoais</h2>

  <table>
    <thead>
      <tr>
        <th>Nome completo</th>
        <th>Email</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $obUsuario->nome; ?></td>
        <td><?php echo $obUsuario->email; ?></td>
        <td><?php echo $obUsuario->cpf; ?></td>
        <td><?php echo $obUsuario->telefone; ?></td>
        <td>
          <a href="dados_editar.php?codus=<?php echo $usuarioLogado['codus']; ?>">Editar</a>
        </td>
      </tr>
    </tbody>
  </table>

  <table>
   <h2>Endereços</h2>
   <a href="obEndereco_cadastro.php">Adicionar novo endereço</a>
    <thead>
      <tr>
        <th>CEP</th>
        <th>Rua</th>
        <th>Bairro</th>
        <th>Número</th>
        <th>Tipo</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($obEndereco as $endereco) { ?>
        <tr>
          <td><?php echo $endereco->cep; ?></td>
          <td><?php echo $endereco->rua; ?></td>
          <td><?php echo $endereco->bairro; ?></td>
          <td><?php echo $endereco->numero; ?></td>
          <td><?php echo $endereco->tipo; ?></td>
          <td>
            <a href="endereco_editar.php?codend=<?php echo $endereco->codend; ?>">Editar</a>
            <a href="endereco_editar.php?codend=<?php echo $endereco->codend; ?>">Excluir</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</main>