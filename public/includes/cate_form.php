<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categoria</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
  <link rel="stylesheet" href="./public/css/StyleCateAdm.css">
</head>

<body>
  
  <div class="form-container">
<!-- <main> -->
  <section>
  <div class="form-group">
    <a href="cate_listar.php">
      <button class="form-button"><i class="fa-solid fa-arrow-left"></i>Voltar</button>
    </a>
  </div>
  </section>

  <h2 class="mensagem"><?=TITLE?></h2>

  <form method="post">

    <div class="form-group">
      <label>Nome: </label>
      <input type="text" name="nome_cate" value="<?=$objCate->nome_cate?>"><!--Caso ja tenha no banco ira mostrar-->
    </div>

    <div class="form-group">
      <button type="submit" class="form-button">Salvar</button>
    </div>

  </form>
<!-- </main> -->
  </div>
</body>