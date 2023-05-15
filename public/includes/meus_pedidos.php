<?php
    use \App\Entity\Pedido;
    use \App\Entity\Item_Pedido;
    use \App\Db\Pagination;
    use App\Session\Login;

    $sessao = Login::getUsuarioLogado();

    

    //QUANTIDADE DE PEDIDOS
    $qtdePedido = Pedido::getQtdePedidos();

    //PAGINACAO
    $objPagi = new Pagination($qtdePedido, $_GET['pagina'] ?? 1, 10);

    //variavel com array de marcas
    $pedidos = Pedido::getPedidos('codus = '.$sessao['codus'].'', null, $objPagi->getLimit());


   
    //percorrendo o array
    $res_pedido = '';
    foreach($pedidos as $pedido){
        $cancelado = '';
        $valorTotal = 0;
        $itens = Pedido::getProdutoporPedido($pedido->numpedido);
        foreach($itens as $item){
            $valorTotal += $item->preco * $item->qtde;
        }

        $valorTotal += 25.00;

        if($pedido->status_pedido == "Cancelado"){//verificar ativo
            $cancelado = 'style="color:grey;"';
        }

        $res_pedido .='<tr '.$cancelado.'>
                            <td>'.$pedido->numpedido.'</td>
                            <td>'.$pedido->status_pedido.'</td>
                            <td>'.$pedido->dt_pedido.'</td>
                            <td>R$ '.number_format($valorTotal, 2, ',', '.').'</td>
                            <td><a href="pedido_ver.php?numpedido='.$pedido->numpedido.'">Ver</a></td>
                    </tr>';
    }

    //caso nao tenha nenhuma marca cadastrada no banco
    $res_pedido = strlen($res_pedido) ? $res_pedido : '<tr>
                                                        <td colspan="6" class="text-center">
                                                            Você não possui pedidos ainda
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
    <h2>Meus Pedidos</h2>

    <table>
        <thead>
        <tr>
            <th>Códgio</th>
            <th>Status</th>
            <th>Data</th>
            <th>Valor Total</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?=$res_pedido?>
        </tbody>
    </table>
</main>