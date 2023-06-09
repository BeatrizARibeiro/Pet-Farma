<?php

    use App\Entity\Categoria;
    use App\Entity\Item_Pedido;
    use App\Entity\Pedido;
    use App\Entity\Produto;
    use App\Entity\Endereco;
    use App\Entity\Prod_Cate;


    $pedidoAberto = Pedido::getPedidoAberto($sessao['codus']);

    //se não tiver pedido em aberto
    if(!$pedidoAberto){
        $visibilidade = 'style="display: none";';
        $mensagem = '<div class="msg">Seu carrinho está vazio!</div>';
    }
    else{  
        //se tiver pedido e tiver itens -- listar itens
        $produtos = Pedido::getProdutoporPedido($pedidoAberto->numpedido);

        $end = Endereco::getEnderecoPadrao($sessao['codus']);

        $numpedido = $pedidoAberto->numpedido;

        $resultado = '';
        $soma = 0;
        $linkexcluir = "'http://localhost/pet-farma/index.php'";
        $qtdeitens = 0;
        $visibilidade = '';
        $endereco = '';
        $enabled = '';

        foreach($produtos as $prod){
            $resultado .= '<tr>
                            <td style="width:50%;">
                                <div class="product">
                                    <img style="height: 99px;" src="public/img/'.$prod->imagem.'" alt="">
                                    <div class="info">
                                        <div class="nameProduct">'.$prod->nome_prod.'</div>
                                        <div class="categoryProduct">';
                                        $categorias = Prod_Cate::getProd_Cate($prod->codprod);
                                        foreach($categorias as $categoria){
                                            $cate = Categoria::getCategoria($categoria->codcate);
                                            $resultado .= '<span>'.$cate->nome_cate . '</span>';
                                        }

                                        $resultado .= '</div>
                                        <input name="cod'.$prod->codprod.'" value="'.$prod->codprod.'" style="display:none;"></input>
                                    </div>
                                </div>
                            </td>
                            <td id="preco'.$prod->codprod.'" >R$ '.number_format($prod->preco, 2, ',', '.').'</td>
                            <td>
                                <div class="inputQtd">
                                    <button type="button" onclick="diminuir('.$prod->codprod.')"><i class="fas fa-light fa-minus"></i></button>
                                    <input type="number" id="'.$prod->codprod.'" name="qtde'.$prod->codprod.'" value="'.$prod->qtde.'">
                                    <button type="button" onclick="aumentar('.$prod->codprod.')"><i class="fas fa-light fa-plus"></i></button>
                                </div>
                            </td>
                            <td id="total'.$prod->codprod.'">R$ '.number_format($prod->preco * $prod->qtde, 2, ',', '.').'</td>
                            <td>
                                <a href="carrinho_excluir.php?codprod='.$prod->codprod.'">
                                    <button type="button" class="remove"><i class="fas fa-solid fa-trash"></i></button>
                                </a>
                                
                            </td>
                        </tr>';

            $soma += $prod->preco * $prod->qtde;
            $qtdeitens ++;
        }
        if($end){
            $endereco .= '<p>CEP: '.$end->cep.'</p>
                        <p>Rua: '.$end->rua.' , nº '.$end->numero.'</p>
                        <div class="link"> <a href="dados_listar.php?codus='.$sessao['codus'].'">Mudar Endereço</a></div>
                        <input name="codend" value="'.$end->codend.'" style="display:none;"></input>';
        }
        else{
            $endereco .= '<p>Você ainda não possui um endereço padrão!</p>
                        <p>Defina um endereço padrão para poder terminar sua compra.</p>
                        <div class="link"> <a href="dados_listar.php?codus='.$sessao['codus'].'">Endereço Padrão</a></div>';
            $enabled = 'disabled';
        }
    

        //se não tiver pedido ou não tiver itens -- apenas mostrar mensagem de carrinho vazio
        if($qtdeitens == 0){
            $visibilidade = 'style="display: none";';
            $mensagem = '<div class="msg">Seu carrinho está vazio!</div>';
        }
    }

    
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StyleCarrinho.css">
    <script src="./public/js/blocktab.js"></script>
    <title>Cesta de Compras</title>
</head>

<main>
    <div class="page-title">Carrinho de Compras</div>

    <?=$mensagem?>
    <div class="content" <?=$visibilidade?>>
    <div class="alinahmentoCar">
        <form method="post">
            <section>
            <input name="numpedido" value="<?=$numpedido?>" style="display:none;"></input>
            <table>
                <thead>
                <tr style="align-items:center; justify-content: center;">
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                    <?=$resultado?>
                </tbody>
            </table>
            </section>
</div>

            <aside>
                    <div class="box">
                        <header>Endereço de Entrega</header>
                        <div class="end">
                            <div>
                                <?=$endereco?>
                            </div>
                        </div>
                    </div>
                    
              
                    <div class="box">
                        <header >Resumo do Pedido</header>
                        <div class="info">
                            <div>
                                <span>Sub-total</span>
                                <span id="sub">R$ <?=number_format($soma, 2, ',', '.')?></span>
                            </div>
                            <div>
                                <span id="frete">Frete fixo para todo o Brasil</span>
                                <span >R$ 25,00</span>
                            </div>
                        </div>
                        <footer style="align-items:center;">
                            <span style="font-weight: 500; width:60%">Total</span>
                            <input style="width:40%" class="inputTotal" id="totalfinal" name="totalfinal" value="R$ <?=number_format($soma + 25.00, 2, ',', '.')?>"></input>
                        </footer>
                    </div>
                    <button type="submit" name="finalizar" <?=$enabled?> onkeypress="teste(event)">Finalizar Compra</button>
            </aside>
            </form>
    </div>

    <script>
    function diminuir(id) {
        var numero = document.getElementById(id);
        var totalitem = document.getElementById("total"+id);
        var preco = document.getElementById("preco"+id);
        var sub = document.getElementById("sub");
        var totalfinal = document.getElementById("totalfinal");

        if(numero.value >1){
            numero.value = parseInt(numero.value) - 1;

            var precoString = (preco.textContent).replace(',', '.').replace('R$ ', ' ');

            var precoFloat = parseFloat(precoString);

            var totalitensFloat = (precoFloat * numero.value).toFixed(2);

            var subtotalString = (sub.textContent).replace(',', '.').replace('R$ ', ' ');

            var subtotalFloat = (parseFloat(subtotalString) - precoFloat).toFixed(2);

            var totalitensString = totalitensFloat.toString();

            var subtotalString2 = subtotalFloat.toString();

            var totalfinalString = (totalfinal.value).replace(',', '.').replace('R$ ', ' ');

            var totalfinalFloat = (parseFloat(totalfinalString) - precoFloat).toFixed(2);

            var totalfinalString2 = totalfinalFloat.toString();

            totalitem.textContent = "R$ " + totalitensString.replace('.', ',');
            sub.textContent = "R$ " + subtotalString2.replace('.', ',');
            totalfinal.value = "R$ " + totalfinalString2.replace('.', ',');
        }
    }

    function aumentar(id) {
        var numero = document.getElementById(id);
        var totalitem = document.getElementById("total"+id);
        var preco = document.getElementById("preco"+id);
        var sub = document.getElementById("sub");
        var totalfinal = document.getElementById("totalfinal");

        numero.value = parseInt(numero.value) + 1;

        var precoString = (preco.textContent).replace(',', '.').replace('R$ ', ' ');

        var precoFloat = parseFloat(precoString);

        var totalitensFloat = (precoFloat * numero.value).toFixed(2);

        var subtotalString = (sub.textContent).replace(',', '.').replace('R$ ', ' ');

        var subtotalFloat = (parseFloat(subtotalString) + precoFloat).toFixed(2);

        var totalitensString = totalitensFloat.toString();

        var subtotalString2 = subtotalFloat.toString();

        var totalfinalString = (totalfinal.value).replace(',', '.').replace('R$ ', ' ');

        var totalfinalFloat = (parseFloat(totalfinalString) + precoFloat).toFixed(2);

        var totalfinalString2 = totalfinalFloat.toString();

        totalitem.textContent = "R$ " + totalitensString.replace('.', ',');
        sub.textContent = "R$ " + subtotalString2.replace('.', ',');
        totalfinal.value = "R$ " + totalfinalString2.replace('.', ',');
    }
</script>

</main>


