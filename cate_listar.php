<?php
    require __DIR__.'../vendor/autoload.php';
    
    include __DIR__.'/public/includes/header.php';

    use \App\Entity\Categoria;
    use \App\Db\Pagination;
    use App\Session\Login;
    Login::requireAdmin();

        
    //busca
    $busca = filter_input(INPUT_GET,'busca', FILTER_SANITIZE_STRING);


    //CONDIÇÕES SQL
    $condicoes = [
        strlen($busca) ? 'nome_cate LIKE "%'.str_replace(' ', '%', $busca).'%"' : null
    ];

    //REMOVE POSICOES VAZIAS
    $condicoes = array_filter($condicoes);

    //CLAUSULA WHERE
    $where = implode(' AND ', $condicoes);


    //QUANTIDADE DE VAGAS
    $qtdeCategorias = Categoria::getQtdeCategorias($where);

    //PAGINACAO
    $objPagi = new Pagination($qtdeCategorias, $_GET['pagina'] ?? 1, 10);

    //variavel com array de categorias
    $categorias = Categoria::getCategorias($where, null, $objPagi->getLimit());

    //variavel mensagem
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


    //percorrendo o array de categorias e as exibindo com botao de editar e excluir
    $res_cate = '';
    foreach($categorias as $categoria){
        $res_cate .='<tr>
                        <td>'.$categoria->codcate.'</td>
                        <td>'.$categoria->nome_cate.'</td>
                        <td>
                            <a href="cate_editar.php?codcate='.$categoria->codcate.'">
                                <button type="button">Editar</button>
                            </a>
                            <a href="cate_excluir.php?codcate='.$categoria->codcate.'">
                                <button type="button">Excluir</button>
                            </a>
                        </td>
                    </tr>';
    }

    //caso nao tenha nenhuma categoria cadastrada no banco
    $res_cate = strlen($res_cate) ? $res_cate : '<tr>
                                                        <td colspan="6" class="text-center">
                                                            Nenhuma categoria encontrada
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
        <a href="cate_cadastrar.php">
            <button >Nova Categoria</button>
        </a>
</section>

<section>
  <form method="get">
    <div class="row my-4">
      <div class="col">
        <label>Buscar Categoria</label>
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
            <th>Código</th>
            <th>Nome</th>
        </tr>
        </thead>
        <tbody>
            <?=$res_cate?><!--variavel que recebe o array de categorias la em cima-->
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