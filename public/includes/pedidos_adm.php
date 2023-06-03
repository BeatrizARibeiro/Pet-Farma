<?php

use App\Entity\Pedido;
use \App\Entity\Item_Pedido;
use \App\Db\Pagination;
use App\Session\Login;


//QUANTIDADE DE PEDIDOS
$qtdePedido = Pedido::getQtdePedidos();

//PAGINACAO
$objPagi = new Pagination($qtdePedido, $_GET['pagina'] ?? 1, 10);

//variavel com array de pedidos
$pedidos = Pedido::getPedidosSituacoes('status_pedido <> "Em Aberto"', 'dt_pedido desc', $objPagi->getLimit());



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

    if($pedido->status_pedido == "Cancelado" || $pedido->situacao == "inativa"){//verificar ativo || $pedido->situacao == "Desativo"
        $cancelado = 'style="color:grey;"';
    }

    $res_pedido .='<tr '.$cancelado.'>
                        <td>'.$pedido->numpedido.'</td>
                        <td>'.$pedido->status_pedido.'</td>
                        <td>'.implode('/', array_reverse(explode('-', $pedido->dt_pedido))).'</td>
                        <td>R$ '.number_format($valorTotal, 2, ',', '.').'</td>
                        <td><a class="btnVer" href="pedido_ver_adm.php?numpedido='.$pedido->numpedido.'">Ver</a></td>
                </tr>';
}

//caso nao tenha nenhuma marca cadastrada no banco
$res_pedido = strlen($res_pedido) ? $res_pedido : '<tr>
                                                    <td colspan="6" class="text-center" align="center">
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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StylePedidosAdm.css">
    
    <title>Pedidos</title>
</head>

<body>
    
    <main>
    <div class="page-title"><h2>Pedidos</h2></div>
<div class="content">
        <table>
    <thead>
        <tr>
            <th>Código</th>
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
<section>
    <?=$paginacao?>
</section>
</div>
</main>

</body>