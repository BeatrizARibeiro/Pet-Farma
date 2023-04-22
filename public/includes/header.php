<?php
  use \App\Session\Login;

$usuarioLogado = Login::getUsuarioLogado();

if ($usuarioLogado) {
  $nomeUsuario = $usuarioLogado['nome'];
  if ($usuarioLogado['admin'] == 1) {
    $nomeUsuario .= " (Admin)";
  }
  $usuario = $nomeUsuario . '<a href="logout.php" class="">Sair</a>';
} else {
  $usuario = 'Visitante <a href="login.php" class="">Entrar</a> <a href="cadastro.php" class="">Criar conta</a> <a href="senha_editar.php" class="">Alterar senha</a>';
}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet-Farma</title>
  </head>
  <body>

  <nav>
    <a href="index.php">Logo</a>
    <div class="busca" <?php if(Login::isLogged() && $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?>><!--Essa dive nao sera exibida para o admin-->
        <input type="text" id="txtBusca" placeholder="Busco por"/>
    </div>
    
    <div class="f-admin" <?php if(!Login::isLogged() || $usuarioLogado['admin'] == 0) { echo 'style="display: none;"'; } ?>><!--funcoes do admin, apenas o admin ve codus=1 ou codus=2-->
        <a href="">Pedidos</a>
        <a href="prod_listar.php">Produtos</a>
        <a href="cate_listar.php">Categorias</a>
        <a href="marca_listar.php">Marcas</a>
        <a href="espe_listar.php">Espécies</a>
      </div>
      <p>Olá, <?=$usuario?></p>

    <div <?php if(Login::isLogged() && $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?>> <!--apenas clientes e pessoas nao logadas podem ver (adm nao ve)-->
      <a href="">Carrinho</a><!--colocar icone bonitinho no lugar-->
                            <!--colocar icone bonitinho no lugar e fazer um DROPDOWN COM
                                                                          LOGIN/LOGOUT
                                                                          MEUS PEDIDOS
                                                                          MEUS DADOS-->
                                                                          
                                                                          
    </div>
  </nav>