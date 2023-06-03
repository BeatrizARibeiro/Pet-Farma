<?php
  use App\Entity\Produto;
  use App\Session\Login;

  $usuarioLogado = Login::getUsuarioLogado();

  $enabled = '';
  
  if($usuarioLogado && $usuarioLogado['admin'] == 1){
    $enabled = 'style="display:none"';
  }

  $produtos = Produto::getProdutosHigi_Cosm();

  $cards = '';

  foreach($produtos as $prod){
    $cards .= '<a style="text-decoration: none" href="./detalhes.php?codprod='.$prod->codprod.'">
                <div class="pro">
                    <img src="public/img/'.$prod->imagem.'" alt="">
                    <div class="des">
                        <h5>'.$prod->nome_prod.'</h5>
                        <span>'.$prod->apresentacao.'</span>
                        <h4>R$'.number_format($prod->preco, 2, ',', '.').'</h4>
                    </div>
                    <a href="add_carrinho.php?codprod='.$prod->codprod.'" '.$enabled.'><i class="fa-solid fa-cart-shopping cart"></i></a>
                </div>
             </a>';
  }
  //caso nao tenha nenhum produto cadastrado no banco
  $cards = strlen($cards) ? $cards : '<h4>Nenhum produto encontrado</h4>';
?>

<main>
<section id="product1" class="section-p1">
    <h2>Higiene e Cosméticos</h2>
    <div class="pro-container">
      <?=$cards?>
    </div>
  </section>
</main>