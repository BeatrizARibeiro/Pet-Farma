<?php
    require __DIR__.'../vendor/autoload.php';
    
    include __DIR__.'/public/includes/header.php';

    use \App\Entity\Categoria;

    //variavel com array de categorias
    $categorias = Categoria::getCategorias();

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
                                                        </tr>'
   
   ?>
<main>
 <?=$mensagem?><!--exibe a mensagem de erro ou sucesso na tela-->
<section>
        <a href="index.php">
            <button>Voltar</button>
        </a>
        <a href="cate_cadastrar.php">
            <button >Nova Categoria</button>
        </a>
</section>

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
</main>

<?php
    
    include __DIR__.'/public/includes/footer.php';
?>