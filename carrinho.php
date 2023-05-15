<?php
    require __DIR__.'/vendor/autoload.php';

    //importando as classes

    use App\Entity\Item_Pedido;
    use App\Entity\Pedido;
    use \App\Session\Login;
    

    //verifica sessao
    $sessao = Login::getUsuarioLogado();

    $mensagem = '';

    if($sessao == null){
        header('location: login.php');
        exit;
    }

    if(isset($_POST['finalizar'])){
        $itens = Item_Pedido::getIens_Pedido($_POST['numpedido']);
        $pedido = Pedido::getPedido($_POST['numpedido']);
        
        foreach($itens as $i){
            $i->qtde = $_POST['qtde'.$i->codprod.''];

            $i->atualizar($_POST['cod'.$i->codprod.'']);
        }

        $total = str_replace('R$ ', '', $_POST['totalfinal']);
        $total = str_replace(',', '.', $total);
        $total = (float)$total;

        MercadoPago\SDK::setAccessToken("TEST-2355122000632142-051415-01aadbdd49ef5454e7e657804b6e4242-241110798");

        // Crie um objeto de preferência
        $preference = new MercadoPago\Preference();
        // Crie um item na preferência
        $item = new MercadoPago\Item();
        $item->title = 'Total';
        $item->quantity = 1;
        $item->unit_price = $total;
        $preference->items = array($item);

        $preference->back_urls = array(
            "sucess" => "http://localhost/pet-farma/index.php",
            "failure" => "http://localhost/pet-farma/carrinho.php",
        );

        $preference->notification_url = "http://localhost/pet-farma/notification.php";
        $preference->external_reference = $_POST['numpedido'];

        $preference->save();

        $link = $preference->sandbox_init_point;

        header('location: '.$link);
    }

    include __DIR__.'/public/includes/header.php';
    include __DIR__.'/public/includes/carrinho_itens.php';
    include __DIR__.'/public/includes/footer.php';
?>