<?php
    require __DIR__.'../vendor/autoload.php';
    
    include __DIR__.'/public/includes/header.php';

    use \App\Entity\Marca;
    use \App\Db\Pagination;
    use App\Session\Login;
    Login::requireAdmin();

    //busca
    $busca = filter_input(INPUT_GET,'busca', FILTER_SANITIZE_STRING);


    //CONDIÇÕES SQL
    $condicoes = [
        strlen($busca) ? 'nome_marca LIKE "%'.str_replace(' ', '%', $busca).'%"' : null
    ];

    //REMOVE POSICOES VAZIAS
    $condicoes = array_filter($condicoes);

    //CLAUSULA WHERE
    $where = implode(' AND ', $condicoes);


    //QUANTIDADE DE VAGAS
    $qtdeMarcas = Marca::getQtdeMarcas($where);

    //PAGINACAO
    $objPagi = new Pagination($qtdeMarcas, $_GET['pagina'] ?? 1, 10);

    //variavel com array de marcas
    $marcas = Marca::getMarcas($where, null, $objPagi->getLimit());

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
            $mensagem = '<div class="erro">Essa marca já se encontra em um produto!</div>';
            break;
        }
    } 

    //percorrendo o array de marcas e as exibindo com botao de editar e excluir
    $res_marca = '';
    foreach($marcas as $marca){
        $res_marca .='<tr>
                        <td>'.$marca->codmarca.'</td>
                        <td>'.$marca->nome_marca.'</td>
                        <td>
                            <a href="marca_editar.php?codmarca='.$marca->codmarca.'">
                                <button type="button">Editar</button>
                            </a>
                            <a href="marca_excluir.php?codmarca='.$marca->codmarca.'">
                                <button type="button">Excluir</button>
                            </a>
                        </td>
                    </tr>';
    }

    //caso nao tenha nenhuma marca cadastrada no banco
    $res_marca = strlen($res_marca) ? $res_marca : '<tr>
                                                        <td colspan="6" class="text-center">
                                                            Nenhuma marca encontrada
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
        <a href="marca_cadastrar.php">
            <button >Nova Marca</button>
        </a>
</section>

<section>
  <form method="get">
    <div class="alinharProcurar">
      <!-- <div class="col"> -->
        <label>Buscar Marca</label>
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
        <thead><!--cabecalho da tabela-->
        <tr>
            <th>Código</th>
            <th>Nome</th>
        </tr>
        </thead>
        <tbody>
            <?=$res_marca?><!--variavel que recebe o array de marcas la em cima-->
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