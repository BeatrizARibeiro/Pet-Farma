<?php
    use App\Entity\Item_Pedido;
    use App\Entity\Pedido;
    use App\Entity\Produto;
    use App\Entity\Endereco;
    use App\Session\Login;

    $sessao = Login::getUsuarioLogado();

    $num = $_GET['numpedido'];

    $pedido = Pedido::getPedido($num);

    $itens = Pedido::getProdutoporPedido($num);

    $res = '';

    if($pedido->status_pedido == "Entregue a transportadora" ){
        $visibilidade = '';
    }
    else{
        $visibilidade = 'style="display:none;"';
    }

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
    <a href="pedido_listar.php?codus=<?=$sessao['codus']?>">Voltar</a>

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

    <a <?=$v?> href="../pet-farma/pedido_cancelar.php?numpedido=<?=$pedido->numpedido?>" >Cancelar</a>

    <section <?=$visibilidade?>>
        <h4>Protocolo: <?=$pedido->protocolo?></h4>
        <p>Seu pedido foi entregue a transportadora.</p>
        <p>Use seu número de protocolo para acompanhar seu pedido na <a href="">Transportadora Maravilha</a></p>
    </section>