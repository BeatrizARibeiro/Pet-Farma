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
<img src="./public/img/<?=$objProd->imagem?>" alt="">
<h2><?=$objProd->nome_prod?></h2>
<h4>Informações: <?=$objProd->descricao?></h4>
<h4>Peso: <?=$objProd->peso?></h4>
<h4>R$ <?=$objProd->preco?></h4>
<form method="post">
    <button type="button" onclick="diminuir()">-</button>
    <input type="number" id="qtde" name="qtde" value="1">
    <button type="button" onclick="aumentar()">+</button>
    <button type="submit" name="btnqtde">Adicionar ao Carrinho</button>
</form>

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