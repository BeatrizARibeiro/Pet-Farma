<?php
  use App\Entity\Produto;

  $produtos = Produto::getProdutosEmDestaque();

  $destaques = '';

  foreach($produtos as $prod){
    $destaques .= '<a href="./detalhes.php?codprod='.$prod->codprod.'">
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
  $destaques = strlen($destaques) ? $destaques : '<h4>Nenhum produto em destaque</h4>';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetFarma</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/style.css">
</head>

<body>
  <section id="hero">
    <div class="homeimgtexto">
      <div class="textoinicio">
          <h4>Quer o melhor para seu PET?</h4>
          <h2>Qualidade e preços que cabem no seu bolso?</h2>
          <h1>Confira as novidades</h1>
          <p>Você economiza e não precisa sair de casa!</p>
          <!--tirei o botão pq ele não faz sentido no contexto do site-->
      </div>
      <div class="animaishome">
          <img src="public/img/animaishome.png">
      </div>
    </div>
  </section>

  <section id="feature" class="section-p1">
    <a href="./aves.php">
      <div class="fe-box">
        <img src="public/img/aveshome.png" alt="">
        <h6>AVES</h6>
      </div>
    </a>
    <a href="./silvestres.php">
      <div class="fe-box">
        <img src="public/img/silvestreshome.png" alt="">
        <h6>SILVESTRES</h6>
      </div>
    </a>
    <a href="./equinos.php">
      <div class="fe-box">
        <img src="public/img/equinoshome.png" alt="">
        <h6>EQUINOS</h6>
      </div>
    </a>
    <a href="./peixes.php">
        <div class="fe-box">
        <img src="public/img/peixeshome.png" alt="">
        <h6>PEIXES</h6>
      </div>
    </a>
    <a href="./repteis.php">
      <div class="fe-box">
        <img src="public/img/repteishome.png" alt="">
        <h6>RÉPTEIS</h6>
      </div>
    </a>
    <a href="./mamiferos.php">
      <div class="fe-box">
        <img src="public/img/mamiferoshome.png" alt="">
        <h6>MAMÍFEROS</h6>
      </div>
    </a>
  </section>

  <section id="product1" class="section-p1">
    <h2>Produtos em Destaque</h2>
    <p>Produtos mais pedidos na loja!</p>
    <div class="pro-container">
      <?=$destaques?>
    </div>
  </section>
</body>
</html>