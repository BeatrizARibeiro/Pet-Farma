<?php
    require __DIR__.'../vendor/autoload.php';
    
    include __DIR__.'/public/includes/header.php';

    use \App\Entity\Produto;

    //variavel com array de produtos
    $produtos = Produto::getProdutos();

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
                        <td>'.$produto->preco.'</td>
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
                                                        </tr>'
   
   ?>
<main>
 <?=$mensagem?><!--exibe a mensagem de erro ou sucesso na tela-->
<section>
        <a href="index.php">
            <button>Voltar</button>
        </a>
        <a href="prod_cadastrar.php">
            <button >Novo Produto</button>
        </a>
</section>

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
</main>

<?php
    
    include __DIR__.'/public/includes/footer.php';
?>