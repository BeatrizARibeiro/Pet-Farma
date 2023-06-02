<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar Produto');

use App\Entity\Produto;
use App\Entity\Prod_Cate;
use App\Entity\Categoria;

$objProd = new Produto;
$objProd_Cate = new Prod_Cate;

// Se o usuario clicou no botao cadastrar efetua as acoes
if (isset($_POST['salvar'])) {
    
    // Recupera os dados dos campos
    $objProd->nome_prod = $_POST['nome_prod'];
    $objProd->descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $objProd->preco = str_replace(',','.', $preco);
    $objProd->apresentacao = $_POST['apresentacao'];
    $objProd->codespe = $_POST['codespe'];
    $objProd->codmarca = $_POST['codmarca'];

    $foto = $_FILES['imagem'];

    //if(isset($_FILES['imagem'])) 

    // Se a foto tiver sido selecionada
    if (!empty($foto["name"])) {
        // Pega extensao da imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

        // Gera um nome unico para a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        // Caminho de onde ficara a imagem
        $caminho_imagem = "./public/img/" . $nome_imagem;

        // Faz o upload da imagem para seu respectivo caminho
        move_uploaded_file($foto["tmp_name"], $caminho_imagem);

        $objProd->imagem = $nome_imagem;//salva o nome da imagem no banco
    }
   
        
            $objProd->cadastrar();//cadastra o produto


            //PROD_CATE
            //pega todas as categorias selecionadas no select
            $categorias = $_POST['categorias'];

            //percorre elas preenchendo a tabela prod_cate
            foreach($categorias as $categoria){
                $objProd_Cate->codprod = $objProd->codprod;
                $objProd_Cate->codcate = $categoria;

                $objProd_Cate->cadastrar();//cadastra no banco
            }

            header('location: prod_listar.php?status=success');
            exit; 
}

include __DIR__.'/public/includes/header.php';
include __DIR__.'/public/includes/prod_form.php';
include __DIR__.'/public/includes/footer.php';