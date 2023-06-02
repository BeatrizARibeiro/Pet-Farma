<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar Produto');

use App\Entity\Prod_Cate;
use \App\Entity\Produto;

//VALIDACAO DO CODIGO
if(!isset($_GET['codprod']) or !is_numeric($_GET['codprod'])){
  header('location: prod_listar.php?status=error');
  exit;
}

//CONSULTA O PRODUTO
$objProd = Produto::getProduto($_GET['codprod']);//instancia do produto

$objProd_Cate = new Prod_Cate;

//VALIDACAO DA INSTANCIA
if(!$objProd instanceof Produto){
    header('location: prod_listar.php?status=error');
    exit;
}

//VALIDACAO DO POST
if(isset($_POST['salvar'])){
    $objProd->nome_prod = $_POST['nome_prod'];
    $objProd->descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $objProd->preco = str_replace(',','.', $preco);
    $objProd->apresentacao = $_POST['apresentacao'];
    $objProd->codespe = $_POST['codespe'];
    $objProd->codmarca = $_POST['codmarca'];

    $foto = $_FILES['imagem'];

    //se tiver alguma imagem cadastrada no banco
    if($objProd->imagem != null){
        // Se escolheu outra foto
        if (!empty($foto["name"])){
            //exclui a antiga da pasta
            unlink("./public/img/".$objProd->imagem."");

            // Pega extensao da nova imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

            // Gera um nome unico para a nova imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

            // Caminho de onde ficara a nova imagem
            $caminho_imagem = "./public/img/" . $nome_imagem;

            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);

            $objProd->imagem = $nome_imagem;//salva no banco a nova imagem
        }

    }

    //se nao tiver imagem cadastrada no banco
    else{
        //se selecionou alguma imagem
        if (!empty($foto["name"])){
            // Pega extensao da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

            // Gera um nome unico para a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

            // Caminho de onde ficara a imagem
            $caminho_imagem = "./public/img/" . $nome_imagem;

            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);

            $objProd->imagem = $nome_imagem;//salva a imagem no banco
        }
    }


    $objProd->atualizar();  //atualiza os dados

    //PROD_CATE
    //pega todas as categorias selecionadas no select
    $categorias = $_POST['categorias']; 

    $objProd_Cate->excluir($_GET['codprod']);  //exclui do banco (vai por mim, e mais facil)


    //recadastra de novo com as novas categorias selecionadas
    //percorre elas preenchendo a tabela prod_cate
    foreach($categorias as $categoria){
        $objProd_Cate->codprod = $objProd->codprod;
        $objProd_Cate->codcate = $categoria;

        $objProd_Cate->cadastrar();
    }

    header('location: prod_listar.php?status=success');
    exit; 
}

include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/prod_form.php';
include __DIR__.'/public/includes/footer.php';