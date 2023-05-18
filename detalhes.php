<?php

require __DIR__.'/vendor/autoload.php';

include __DIR__.'/public/includes/header.php';

use \App\Entity\Produto;

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
    
    <title>Detalhes</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StyleDetalhes.css">
  </head>

  <div class="container">
    <div class="main-content">
  <h2><?=$objProd->nome_prod?></h2>
  <img class="imgDetalhes" src="./public/img/<?=$objProd->imagem?>" alt="">
<h4>Detalhes</h4>
    <p><?=$objProd->descricao?></p>
</div>

<aside class="sidebar">
    <h4>Peso: <?=$objProd->peso?></h4>
    <hr>
    <div class="inputQtdAside"> 
        <h4>R$ <?=$objProd->preco?></h4>
        <form method="post" class="inputQtd">
            <button type="button" onclick="diminuir()">-</button>
            <input type="number" id="qtde" name="qtde" value="1">
            <button type="button" onclick="aumentar()">+</button>
        </form>
    </div>
    <button type="submit" name="btnqtde" class="btnAddCar">Adicionar ao Carrinho</button>
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