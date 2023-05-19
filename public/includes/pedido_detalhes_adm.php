<?php
    use App\Entity\Item_Pedido;
    use App\Entity\Pedido;
    use App\Entity\Produto;
    use App\Entity\Endereco;

    $num = $_GET['numpedido'];

    $pedido = Pedido::getPedido($num);

    $itens = Pedido::getProdutoporPedido($num);

    $res = '';

    if($pedido->status_pedido == "Entregue a transportadora" || $pedido->status_pedido == "Cancelado" ){
        $v = 'style="display:none;"';
    }
    else{
        $v = '';
    }



    foreach($itens as $item){
        $res .= '<tr>
                    <td>
                        <div class="product">
                            <img style="height: 100px;" src="public/img/'.$item->imagem.'" alt="">
                            <div class="info">
                                <div class="nameProduct">'.$item->nome_prod.'</div>
                                <div class="categoryProduct">'.$item->nome_cate.'</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="product">
                            <div class="info">
                                <div class="nameProduct">R$ '.number_format($item->preco * $item->qtde, 2, ',', '.').'</div>
                                <div class="categoryProduct"> X'.$item->qtde.'</div>
                            </div>
                        </div>
                    </td>
                </tr>';
    }
?>
<a href="pedidos.php">Voltar</a>

<h2>Pedido <?=$num?></h2>

<h4><?=$pedido->status_pedido?></h4>

<table>
    <thead>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        <?=$res?>
    </tbody>
</table>

<form method="post" <?=$v?>>
    <select name="status_pedido">
        <option value="0"><?=$pedido->status_pedido?></option>
        <option value="1">Em preparação</option>
        <option value="2">Entregue a transportadora</option>
        <option value="3">Cancelado</option>
    </select>
    <br>
    <button type="submit" name="salvar">Salvar</button>
</form>

    