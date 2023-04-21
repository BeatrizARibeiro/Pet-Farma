<?php
    require __DIR__.'../vendor/autoload.php';
    
    include __DIR__.'/public/includes/header.php';

    use \App\Entity\Especie;

    use App\Session\Login;
    Login::requireAdmin();

    //variavel com array de especies
    $especies = Especie::getEspecies();

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
                                                        </tr>'
   
   ?>
<main>
 <?=$mensagem?><!--exibe a mensagem de erro ou sucesso na tela-->
<section>
        <a href="index.php">
            <button>Voltar</button>
        </a>
        <a href="espe_cadastrar.php">
            <button >Nova Espécie</button>
        </a>
</section>

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
</main>

<?php
    
    include __DIR__.'/public/includes/footer.php';
?>