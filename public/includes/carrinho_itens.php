<?php

    use App\Entity\Item_Pedido;
    use App\Entity\Pedido;
    use App\Entity\Produto;

    $pedidoAberto = Pedido::getPedidoAberto($sessao['codus']);
    //se tiver pedido e tiver itens -- listar itens

    $produtos = Pedido::getProdutoporPedido($pedidoAberto->numpedido);

    $resultado = '';
    $soma = 0;
    $linkexcluir = "'http://localhost/pet-farma/index.php'";

    foreach($produtos as $prod){
        $resultado .= '<tr>
                        <td>
                            <div class="product">
                                <img style="height: 100px;" src="public/img/'.$prod->imagem.'" alt="">
                                <div class="info">
                                    <div class="nameProduct">'.$prod->nome_prod.'</div>
                                </div>
                            </div>
                        </td>
                        <td id="preco'.$prod->codprod.'" >R$ '.number_format($prod->preco, 2, ',', '.').'</td>
                        <td>
                            <div class="qty">
                                <button type="button" onclick="diminuir('.$prod->codprod.')"><i class="fas fa-light fa-minus"></i></button>
                                <input type="number" id="'.$prod->codprod.'" name="qtde" value="'.$prod->qtde.'">
                                <button type="button" onclick="aumentar('.$prod->codprod.')"><i class="fas fa-light fa-plus"></i></button>
                            </div>
                        </td>
                        <td id="total'.$prod->codprod.'">R$ '.number_format($prod->preco * $prod->qtde, 2, ',', '.').'</td>
                        <td>
                            <a href="index.php" class="remove"><i class="fas fa-solid fa-trash"></i></a>
                        </td>
                    </tr>';

        $soma += $prod->preco * $prod->qtde;
    }
    

    //se não tiver pedido -- apenas mostrar mensagem de carrinho vazio
?>

<main>
    <div class="page-title">Carrinho de Compras</div>

    <?=$mensagem?>
    <div class="content">
        <section>
        <table>
            <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>-</th>
            </tr>
            </thead>
            <tbody>
                <form method="post">
                    <?=$resultado?>
                </form>
            </tbody>
        </table>
        </section>
        <aside>
                <div class="box">
                    <header>Endereço de Entrega</header>
                    <div class="info">
                        <div>
                            Endereço
                        </div>
                    </div>
                </div>
                
            </aside>
        <aside>
                <div class="box">
                    <header>Resumo do Pedido</header>
                    <div class="info">
                        <div>
                            <span>Sub-total</span>
                            <span id="sub">R$ <?=number_format($soma, 2, ',', '.')?></span>
                        </div>
                        <div>
                            <span>Frete fixo para todo o Brasil</span>
                            <span id="frete">R$ 25,00</span>
                        </div>
                    </div>
                    <footer>
                        <span>Total</span>
                        <span id="totalfinal">R$ <?=number_format($soma + 25.00, 2, ',', '.')?></span>
                    </footer>
                </div>
                <button>Finalizar Compra</button>
            </aside>
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

            var totalfinalString = (totalfinal.textContent).replace(',', '.').replace('R$ ', ' ');

            var totalfinalFloat = (parseFloat(totalfinalString) - precoFloat).toFixed(2);

            var totalfinalString2 = totalfinalFloat.toString();

            totalitem.textContent = "R$ " + totalitensString.replace('.', ',');
            sub.textContent = "R$ " + subtotalString2.replace('.', ',');
            totalfinal.textContent = "R$ " + totalfinalString2.replace('.', ',');
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

        var totalfinalString = (totalfinal.textContent).replace(',', '.').replace('R$ ', ' ');

        var totalfinalFloat = (parseFloat(totalfinalString) + precoFloat).toFixed(2);

        var totalfinalString2 = totalfinalFloat.toString();

        totalitem.textContent = "R$ " + totalitensString.replace('.', ',');
        sub.textContent = "R$ " + subtotalString2.replace('.', ',');
        totalfinal.textContent = "R$ " + totalfinalString2.replace('.', ',');
    }
</script>

</main>


