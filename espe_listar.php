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
            $mensagem = '<div class="sucesso">Ação executada com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div class="erro">Ação não executada!</div>';
            break;

        case 'errore':
            $mensagem = '<div class="erro">Essa espécie já se encontra em um produto!</div>';
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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StylePedidosAdm.css">
    
    <title>Pedidos</title>
</head>
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
    <div class="alinharProcurar">
      <!-- <div class="col"> -->
        <label>Buscar Espécie</label>
        <input class="search-txt2" type="text" name="busca" VALUE="<?=$busca?>">
        <button class="search-btn2" type="submit">Buscar</button>
      <!-- </div> -->
    </div>
  </form>
</section>

<div class="mensagem">
<?=$mensagem?><!--exibe a mensagem de erro ou sucesso na tela-->
</div>

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