<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar Categoria');

use \App\Entity\Categoria;

//instanciando o objeto da classe categoria
$objCate = new Categoria;

//VALIDACAO DO POST
if(isset($_POST['nome_cate'])){

  $objCate->nome_cate    = $_POST['nome_cate'];
  $objCate->cadastrar();

  header('location: cate_listar.php?status=success');//mensagem de sucesso
  exit;
}


//exibindo os elementos no html
include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/cate_form.php';
include __DIR__.'/public/includes/footer.php';