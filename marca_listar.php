<?php
    require __DIR__.'../vendor/autoload.php';
    
    include __DIR__.'/public/includes/header.php';

    use \App\Entity\Marca;

    //variavel com array de marcas
    $marcas = Marca::getMarcas();

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
                                                        </tr>'
   
   ?>
<main>
 <?=$mensagem?><!--exibe a mensagem de erro ou sucesso na tela-->
<section>
        <a href="index.php">
            <button>Voltar</button>
        </a>
        <a href="marca_cadastrar.php">
            <button >Nova Marca</button>
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
            <?=$res_marca?><!--variavel que recebe o array de marcas la em cima-->
        </tbody>
    </table>

</section>
</main>

<?php
    
    include __DIR__.'/public/includes/footer.php';
?>