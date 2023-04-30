<?php
    require __DIR__.'../vendor/autoload.php';
    
    include __DIR__.'/public/includes/header.php';

    use \App\Entity\Produto;
    use \App\Db\Pagination;

    //busca
    $busca = $_GET['busca'];

    //CONDIÇÕES SQL
    $condicoes = [
        strlen($busca) ? 'nome_prod LIKE "%'.str_replace(' ', '%', $busca).'%"' : null
    ];

    //REMOVE POSICOES VAZIAS
    $condicoes = array_filter($condicoes);

    //CLAUSULA WHERE
    $where = implode(' AND ', $condicoes);


    //QUANTIDADE DE VAGAS
    $qtdeProdutos = Produto::getQtdeProdutos($where);

    //PAGINACAO
    $objPagi = new Pagination($qtdeProdutos, $_GET['pagina'] ?? 1, 10);

    //variavel com array de produtos
    $produtos = Produto::getProdutos($where, null, $objPagi->getLimit());

    //percorrendo o array de marcas e as exibindo com botao de editar e excluir
    $cards = '';

    foreach($produtos as $prod){
        $cards .= '<a href=" ">
                    <div class="pro">
                        <img src="public/img/'.$prod->imagem.'" alt="">
                        <div class="des">
                            <h5>'.$prod->nome_prod.'</h5>
                            <span>'.$prod->peso.'</span>
                            <h4>R$'.$prod->preco.'</h4>
                        </div>
                        <a href="#">Comprar</a>
                    </div>
                </a>';
    }

    //caso nao tenha nenhum produto cadastrado no banco
  $cards = strlen($cards) ? $cards : '<h4>Nenhum produto encontrado</h4>';

    //GETS
    unset($_GET['status']);
    unset($_GET['pagina']);
    $gets = http_build_query($_GET);

    //PAGINACAO
    $paginacao = '';
    $paginas = $objPagi->getPages();

    foreach($paginas as $key=>$pagina){
        $class = $pagina['atual'] ? 'btn-primary' : 'btn-light';
        $paginacao .= '<a href="?pagina='.$pagina['pagina'].'&'.$gets.'">
                        <button type="button" class="btn '.$class.'">'.$pagina['pagina'].'</button>
                    </a>';
    }
   
   ?>
<main>
<section id="product1" class="section-p1">
    <h2>Resultados para "<?=$busca?>"</h2>
    <div class="pro-container">
      <?=$cards?>
    </div>
</section>

<section>
    <?=$paginacao?>
</section>
</main>

<?php
    
    include __DIR__.'/public/includes/footer.php';
?>