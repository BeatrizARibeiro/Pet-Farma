<?php
  use \App\Session\Login;
  use \App\Entity\Endereco;

  $usuarioLogado = Login::getUsuarioLogado();
  // $endereco = Endereco::getEnderecosCli($usuarioLogado['codus']);
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
    <h2>Endereços</h2>
    <a href="endereco_cadastro.php">Adicionar novo endereço</a>
</main>