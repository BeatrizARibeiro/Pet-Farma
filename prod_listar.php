<?php
    require __DIR__.'../vendor/autoload.php';
    
    include __DIR__.'/public/includes/header.php';

    use \App\Entity\Produto;
    use \App\Db\Pagination;
    use App\Session\Login;
    Login::requireAdmin();

    //busca
    $busca = filter_input(INPUT_GET,'busca', FILTER_SANITIZE_STRING);


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

     $mensagem = '';

    if(isset($_GET['status'])){
        switch($_GET['status']){
        case 'success':
            $mensagem = '<div>Ação executada com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div>Ação não executada!</div>';
            break;
        }
    } 

    //percorrendo o array de marcas e as exibindo com botao de editar e excluir
    $res_prod = '';
    foreach($produtos as $produto){
        $res_prod .='<tr>
                        <td>'.$produto->codprod.'</td>
                        <td>'.$produto->nome_prod.'</td>
                        <td>'.$produto->peso.'</td>
                        <td>R$ '.number_format($produto->preco, 2, ',', '.').'</td>
                        <td>
                            <a href="prod_editar.php?codprod='.$produto->codprod.'">
                                <button type="button">Editar</button>
                            </a>
                            <a href="prod_excluir.php?codprod='.$produto->codprod.'">
                                <button type="button">Excluir</button>
                            </a>
                        </td>
                    </tr>';
    }

    //caso nao tenha nenhum produto cadastrado no banco
    $res_prod = strlen($res_prod) ? $res_prod : '<tr>
                                                        <td colspan="6" class="text-center">
                                                            Nenhum produto encontrado
                                                        </td>
                                                        </tr>';

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

<section>
        <a href="index.php">
            <button>Voltar</button>
        </a>
        <a href="prod_cadastrar.php">
            <button >Novo Produto</button>
        </a>
</section>

<section>
  <form method="get">
    <div class="row my-4">
      <div class="col">
        <label>Buscar Produto</label>
        <input type="text" name="busca" VALUE="<?=$busca?>">
        <button type="submit">Buscar</button>
      </div>
    </div>
  </form>
</section>
<?=$mensagem?><!--exibe a mensagem de erro ou sucesso na tela-->
<section>

    <table>
        <thead><!--cabecalho da tabela-->
        <tr>
            <th>Códgio</th>
            <th>Nome</th>
            <th>Peso</th>
            <th>Preco</th>
        </tr>
        </thead>
        <tbody>
            <?=$res_prod?><!--variavel que recebe o array de produtos la em cima-->
        </tbody>
    </table>

</section>
<section>
    <?=$paginacao?>
</section>
</main>

<?php
    
    include __DIR__.'/public/includes/footer.php';
?>