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
    <div class="busca"><!--Essa dive nao sera exibida para o admin-->
        <input type="text" id="txtBusca" placeholder="Busco por"/>
    </div>
    
    <div class="f-admin"><!--funcoes do admin, apenas o admin ve codus=1 ou codus=2-->
        <a href="">Pedidos</a>
        <a href="prod_listar.php">Produtos</a>
        <a href="cate_listar.php">Categorias</a>
        <a href="marca_listar.php">Marcas</a>
        <a href="espe_listar.php">Espécies</a>
    </div>

    <div> <!--apenas clientes e pessoas nao logadas podem ver (adm nao ve)-->
      <a href="">Carrinho</a><!--colocar icone bonitinho no lugar-->
      <a href="">Login</a><!--colocar icone bonitinho no lugar e fazer um DROPDOWN COM
                                                                          LOGIN/LOGOUT
                                                                          MEUS PEDIDOS
                                                                          MEUS DADOS-->
    </div>
  </nav>