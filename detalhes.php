<?php

require __DIR__.'/vendor/autoload.php';

include __DIR__.'/public/includes/header.php';

use \App\Entity\Produto;
use App\Session\Login;
use Com\Tecnick\Barcode\Type\Square\Datamatrix\Steps;

$usuarioLogado = Login::getUsuarioLogado();

  $enabled = '';
  

  if($usuarioLogado && $usuarioLogado['admin'] == 1){
    $enabled = 'disabled';
  }

//validacao do id
if(!isset($_GET['codprod']) or !is_numeric($_GET['codprod'])){
    header('location: cate_listar.php?status=error');
    exit;
  }
  
  //Consulta a categoria
  $objProd = Produto::getProduto($_GET['codprod']);//instancia da vaga
  
  //validacao da instancia
  if(!$objProd instanceof Produto){
    header('location: index.php?status=error');
    exit;
  }

  $qtde_url = "http://localhost/pet-farma/add_carrinho.php?codprod=".$objProd->codprod."&qtde=";
    if(isset($_POST['btnqtde'])){
    $input = $_POST['qtde'];
        header("location: ".$qtde_url.$input);
    }


?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StyleDetalhes.css">
  </head>

  <div class="container">
    <div class="main-content">
        <img class="imgDetalhes" src="./public/img/<?=$objProd->imagem?>" alt="">
    </div>

    <aside class="sidebar">
        <h4><?=$objProd->nome_prod?></h4>
        <h3>Informações:</h3>
        <p><?=str_replace('-', '&bull;',(str_replace(' -', '<br>-', $objProd->descricao)))?></p>
        <h3>Apresentação: </h3>
        <p><?=$objProd->peso?></p>
        <hr>
        <div class="inputQtdAside"> 
            <h3 id="preco">R$ <?=number_format($objProd->preco, 2, ',', '.')?></h3>
            <form method="post" >
                <div class="inputQtd">
                    <button type="button" onclick="diminuir()"><i class="fas fa-light fa-minus"></i></button>
                    <input type="number" id="qtde" name="qtde" value="1">
                    <button type="button" onclick="aumentar()"><i class="fas fa-light fa-plus"></i></button>
                </div>
            
        </div>
        <button  type="submit" <?=$enabled?> name="btnqtde" class="btnAddCar">ADICIONAR AO CARRINHO</button>
            </form>
    </aside>
</div>

<script>
    function diminuir() {
        var numero = document.getElementById("qtde");
        if(numero.value >1){
            numero.value = parseInt(numero.value) - 1;
        }
    }

    function aumentar() {
        var numero = document.getElementById("qtde");
        numero.value = parseInt(numero.value) + 1;
    }
</script>


<?php
    include __DIR__.'/public/includes/footer.php';
?>