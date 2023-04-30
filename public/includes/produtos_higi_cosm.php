<?php
  use App\Entity\Produto;

  $produtos = Produto::getProdutosHigi_Cosm();

  $cards = '';

  foreach($produtos as $prod){
    $cards .= '<a href=" ">
                <div class="pro">
                    <img src="public/img/'.$prod->imagem.'" alt="">
                    <div class="des">
                        <h5>'.$prod->nome_prod.'</h5>
                        <span>'.$prod->peso.'</span>
                        <h4>R$'.$prod->preco.'</h4>
                    </div>
                    <a href="#">Comprar</a>
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