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

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categoria</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
  <link rel="stylesheet" href="./public/css/StylePedidoDetalheAdm.css">
</head>

<body>
  
  <div class="form-container">

  <div class="form-group">
<a href="pedidos.php">
  <button class="form-button"><i class="fa-solid fa-arrow-left"></i>Voltar</button>
</a>
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

<form method="post" <?=$v?>>
<div class="form-group">
    <select name="status_pedido">
        <option value="0"><?=$pedido->status_pedido?></option>
        <option value="1">Em preparação</option>
        <option value="2">Entregue a transportadora</option>
        <option value="3">Cancelado</option>
    </select>
    </div>
   <div class="form-group">
    <button type="submit" name="salvar" class="form-button">Salvar</button>
</div>
</form>
</div>
</body>
    