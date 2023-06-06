<?php
    use App\Entity\Categoria;
    use App\Entity\Item_Pedido;
    use App\Entity\Pedido;
    use App\Entity\Produto;
    use App\Entity\Endereco;
    use App\Entity\Prod_Cate;
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
                                <div class="categoryProduct">';
                                        $categorias = Prod_Cate::getProd_Cate($item->codprod);
                                        foreach($categorias as $categoria){
                                            $cate = Categoria::getCategoria($categoria->codcate);
                                            $res .= '<span>'.$cate->nome_cate . '</span>';
                                        }

                                        $res .= '</div>
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

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedido</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
  <link rel="stylesheet" href="./public/css/StylePedidoDetalheAdm.css">
</head>

<body>
    
    
<div class="form-container">

<div class="form-group">
    <a href="pedido_listar.php?codus=<?=$sessao['codus']?>" class="form-button">Voltar</a>
    </div>
    
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
    <div class="form-group">
    <a href="../pet-farma/nfe_imprimir.php?numpedido=<?=$pedido->numpedido?>" class="form-button">Nota Fiscal</a><br>
    <a <?=$v?> href="../pet-farma/pedido_cancelar.php?numpedido=<?=$pedido->numpedido?>" class="form-button">Cancelar</a>
    </div>

    <section <?=$visibilidade?>>
        <h4>Protocolo: <?=$pedido->protocolo?></h4>
        <p>Seu pedido foi entregue a transportadora.</p>
        <p>Use seu número de protocolo para acompanhar seu pedido na <a href="">Transportadora Maravilha</a></p>
    </section>
    </div> 
</body>