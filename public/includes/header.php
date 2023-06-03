<?php
  use \App\Session\Login;

$usuarioLogado = Login::getUsuarioLogado();
$sair = '';
if ($usuarioLogado) {
  $nomeUsuario = $usuarioLogado['nome'];
  $primeiroNome = explode(' ', $nomeUsuario)[0]. '!'; // Pega o primeiro nome do usuário
  if ($usuarioLogado['admin'] == 1) {
    $primeiroNome .= " (Admin)";
  }
  $usuario = $primeiroNome;
  $sair = '<a href="logout.php" style="color:#137373; font-weight: 600; margin-left:5px;" class="">Sair <i class="fa-solid fa-right-from-bracket fa-ls" style="color: #137373;"></i></a>';
} else {
  $usuario = 'Visitante! 
  <div>
  <ul class="navbar">
  <li><a href="login.php" class="f-cli">Entrar</a> </li>
  <li><a href="cadastro.php" class="f-cli">Criar conta</a></li>
  <a href="#" class="close"><i class="far fa-times"></i></a>
  </ul>
  </div>';
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
 
 <div class="f-admin" <?php if(!Login::isLogged() || $usuarioLogado['admin'] == 0) { echo 'style="display: none;"'; } ?>><!--funcoes do admin, apenas o admin ve codus=1 ou codus=2-->
 
 <ul class="navbar">
        <li><a href="pedidos.php">Pedidos</a></li>
      <li><a href="prod_listar.php">Produtos</a></li>
      <li><a href="cate_listar.php">Categorias</a></li>
      <li><a href="marca_listar.php">Marcas</a></li>
      <li><a href="espe_listar.php">Espécies</a></li>
      <li><?=$sair?></li> 
      <a href="#" class="close"><i class="far fa-times"></i></a>
    </ul>
  </div>
  
  
  <p class="usuario">Olá, <?=$usuario?></p>

  <div class="f-user"  <?php if(Login::isLogged() && $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?>>
    <ul class="navbar">
    <li><a class="f-cli" <?php if(!Login::isLogged() || $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?> href="dados_listar.php?codus=<?=$usuarioLogado['codus']?>">Meus dados</a></li>
    <li><a class="f-cli" <?php if(!Login::isLogged() || $usuarioLogado['admin']) { echo 'style="display: none;"'; } ?> href="pedido_listar.php?codus=<?=$usuarioLogado['codus']?>">Meus Pedidos</a></li>
    <li><a href="carrinho.php"><i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffff"></i></a></li>
    <li><?=$sair?></li> 
    <a href="#" class="close"><i class="far fa-times"></i></a>
  </ul>
</div>

<!-- <?=$sair?>    -->

<div id="mobile">
  <i id="bar" class="fas fa-solid fa-bars"></i>
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
          

          <script src="public/js/script.js"></script>
  </body>