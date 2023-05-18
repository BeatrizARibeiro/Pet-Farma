<?php
  use \App\Session\Login;

$usuarioLogado = Login::getUsuarioLogado();

if ($usuarioLogado) {
  $nomeUsuario = $usuarioLogado['nome'];
  $primeiroNome = explode(' ', $nomeUsuario)[0]; // Pega o primeiro nome do usuário
  if ($usuarioLogado['admin'] == 1) {
    $primeiroNome .= " (Admin)";
  }
  $usuario = $primeiroNome . '<a href="logout.php" style="color:#137373; font-weight: 600; margin-left:5px;" class="">Sair <i class="fa-solid fa-right-from-bracket fa-ls" style="color: #137373;"></i></a>';
} else {
  $usuario = 'Visitante <a href="login.php" class="">Entrar</a> <a href="cadastro.php" class="">Criar conta</a>';
}

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>PetFarma</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="public/css/style.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="../js//masks.js"></script>
  </head>

  <body>

  <section id="header" >
    <a href="index.php"><img src="public/img/logopetfarma2.png" class="logo" alt=""></a>
    <form method="post">
      <div class="search-box" <?php if(Login::isLogged() && $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?>><!--Essa dive nao sera exibida para o admin-->
          <input type="text" class="search-txt" name="busca"  placeholder="Busco por"/>
          <button class="search-btn" name="btnbusca" type="submit">
            <img src="public/img/lupa.png" class="lupa">
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
    
    <div  class="f-admin" <?php if(!Login::isLogged() || $usuarioLogado['admin'] == 0) { echo 'style="display: none;"'; } ?>><!--funcoes do admin, apenas o admin ve codus=1 ou codus=2-->
        <a href="pedidos.php">Pedidos</a>
        <a href="prod_listar.php">Produtos</a>
        <a href="cate_listar.php">Categorias</a>
        <a href="marca_listar.php">Marcas</a>
        <a href="espe_listar.php">Espécies</a>
      </div>
      <p class="usuario">Olá, <?=$usuario?></p>

      

    <div <?php if(Login::isLogged() && $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?>> <!--apenas clientes e pessoas nao logadas podem ver (adm nao ve)-->
    <a href="carrinho.php"><i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffff"></i></a><!--colocar icone bonitinho no lugar-->
    <a <?php if(!Login::isLogged() || $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?> href="dados_listar.php?codus=<?php echo $usuarioLogado['codus']; ?>">Meus dados</a>
    <a <?php if(!Login::isLogged() || $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?> href="pedido_listar.php?codus=<?php echo $usuarioLogado['codus']; ?>">Meus Pedidos</a>
    <!--colocar icone bonitinho no lugar-->
                            <!--colocar icone bonitinho no lugar e fazer um DROPDOWN COM
                                                                          LOGIN/LOGOUT
                                                                          MEUS PEDIDOS
                                                                          MEUS DADOS-->
                                                                          
                                                                          
    </div>
  </section>

  <nav class="categoria">
    <div class="divHeader2">
      <ul>
          <li><i class="fas fa-solid fa-bars"></i><strong>Categoria</strong>
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

