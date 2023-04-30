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
  $usuario = 'Visitante <a href="login.php" class="">Entrar</a> <a href="cadastro.php" class="">Criar conta</a>';
}

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet-Farma</title>
  </head>
  <body>

  <section id="header">
    <a href="index.php">Logo</a>
    <form method="post">
      <div class="busca" <?php if(Login::isLogged() && $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?>><!--Essa dive nao sera exibida para o admin-->
          <input type="text" name="busca"  placeholder="Busco por"/>
          <button class="search-btn" name="btnbusca" type="submit">Buscar
            <!--<img src="public/img/lupa.png" class="lupa"> tirei pq estava mto grande, dps colocava de novo ocm css-->
          </button>
      </div>
    </form>

    <?php
      $busca_url = "http://localhost/pet-farma/busca.php?busca=";
      if(isset($_POST['btnbusca'])){
        $input = $_POST['busca'];
        header("location: ".$busca_url.$input);
      }
    ?>
    
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
      <a <?php if(!Login::isLogged() || $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?> href="dados_listar.php?codus=<?php echo $usuarioLogado['codus']; ?>">Meus dados</a><!--colocar icone bonitinho no lugar-->
                            <!--colocar icone bonitinho no lugar e fazer um DROPDOWN COM
                                                                          LOGIN/LOGOUT
                                                                          MEUS PEDIDOS
                                                                          MEUS DADOS-->
                                                                          
                                                                          
    </div>
  </section>

  <nav class="categoria" <?php if(Login::isLogged() && $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?>>
    <div class="divHeader2">
      <ul>
          <li><i class="fas fa-solid fa-bars"></i>Categoria
            <ul>
              <li><a href="./medi.php">Medicamentos</a></li>
              <li><a href="./trat.php">Tratamentos</a></li>
              <li><a href="./supl_vita.php">Suplementos e Vitaminas</a></li>
              <li><a href="./aces.php">Acessórios</a></li>
              <li><a href="./brin.php">Brinquedos</a></li>
              <li><a href="./higi_cosm.php">Higiene e Cosméticos</a></li>
            </ul>
          </li>
      <ul>
    </div>
  </nav>

