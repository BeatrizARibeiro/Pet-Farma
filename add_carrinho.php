<?php
    require __DIR__.'../vendor/autoload.php';

    //importando as classes
    use App\Entity\Item_Pedido;
    use App\Entity\Pedido;
    use App\Session\Login;

    $mensagem = '';

    //verifica sessao
    $sessao = Login::getUsuarioLogado();

    if($sessao == null){
        header('location: login.php');
        exit;
    }
    else{
        $pedidoAberto = Pedido::getPedidoAberto($sessao['codus']);
        $item = new Item_Pedido();

        if(isset($_GET['codprod'])){
            $mensagem = '<div class="msg">Produto adicionado com sucesso!</div>';
        }

        //ja tem pedido
        if($pedidoAberto){
            $item->numpedido = $pedidoAberto->numpedido;

            $item->codprod = $_GET['codprod'];

            //verifica se ja tem o item
            $carrinho = Item_Pedido::getIens_Pedido($pedidoAberto->numpedido);
            foreach($carrinho as $ca){
                if($ca->codprod == $item->codprod){
                    header('location: index.php?status=item');
                    exit;
                }
            }

            //verifica se tem qtde, se não passa 1
            if(isset($_GET['qtde'])){
                $item->qtde = $_GET['qtde'];
            }
            else{
                $item->qtde = 1;
            }
            

            $item->cadastrar();
        }
        //não tem pedido
        else{
            //pedido
            $objPed = new Pedido();

            $objPed->status_pedido = "Em Aberto";

            $objPed->codus = $sessao['codus'];

            $objPed->cadastrar();

            //item pedido
            $item->numpedido = $objPed->numpedido;

            $item->codprod = $_GET['codprod'];

            //verifica se tem qtde, se não passa 1
            if(isset($_GET['qtde'])){
                $item->qtde = $_GET['qtde'];
            }
            else{
                $item->qtde = 1;
            }
            

            $item->cadastrar();
        }
    }

    include __DIR__.'/public/includes/header.php';
    include __DIR__.'/public/includes/carrinho_itens.php';
    include __DIR__.'/public/includes/footer.php';
?>