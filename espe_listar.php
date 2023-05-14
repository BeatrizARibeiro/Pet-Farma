<?php
    require __DIR__.'../vendor/autoload.php';
    
    include __DIR__.'/public/includes/header.php';

    use \App\Entity\Especie;
    use \App\Db\Pagination;
    use App\Session\Login;
    Login::requireAdmin();

    //busca
    $busca = filter_input(INPUT_GET,'busca', FILTER_SANITIZE_STRING);


    //CONDIÇÕES SQL
    $condicoes = [
        strlen($busca) ? 'nome_espe LIKE "%'.str_replace(' ', '%', $busca).'%"' : null
    ];

    //REMOVE POSICOES VAZIAS
    $condicoes = array_filter($condicoes);

    //CLAUSULA WHERE
    $where = implode(' AND ', $condicoes);

    //QUANTIDADE DE VAGAS
    $qtdeEspecies = Especie::getQtdeEspecies($where);

    //PAGINACAO
    $objPagi = new Pagination($qtdeEspecies, $_GET['pagina'] ?? 1, 10);

    //variavel com array de especies
    $especies = Especie::getEspecies($where, null, $objPagi->getLimit());

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

    //percorando o array de especies caso tenha as exibe com os botoes
    $res_espe = '';
    foreach($especies as $especie){
        $res_espe .='<tr>
                        <td>'.$especie->codespe.'</td>
                        <td>'.$especie->nome_espe.'</td>
                        <td>
                            <a href="espe_editar.php?codespe='.$especie->codespe.'">
                                <button type="button">Editar</button>
                            </a>
                            <a href="espe_excluir.php?codespe='.$especie->codespe.'">
                                <button type="button">Excluir</button>
                            </a>
                        </td>
                    </tr>';
    }

    //caso nao tenha nenhuma cadastrada no banco
    $res_espe = strlen($res_espe) ? $res_espe : '<tr>
                                                        <td colspan="6" class="text-center">
                                                            Nenhuma espécie encontrada
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
        <a href="espe_cadastrar.php">
            <button >Nova Espécie</button>
        </a>
</section>

<section>
  <form method="get">
    <div class="row my-4">
      <div class="col">
        <label>Buscar Espécie</label>
        <input type="text" name="busca" VALUE="<?=$busca?>">
        <button type="submit">Buscar</button>
      </div>
    </div>
  </form>
</section>
<?=$mensagem?><!--exibe a mensagem de erro ou sucesso na tela-->
<section>

    <table>
        <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
        </tr>
        </thead>
        <tbody>
            <?=$res_espe?><!--variavel que recebe o array de especies la em cima-->
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