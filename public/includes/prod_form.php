<?php
    use \App\Entity\Especie;
    use \App\Entity\Marca;
    use \App\Entity\Categoria;
    use \App\Entity\Produto;
    use \App\Entity\Prod_Cate;

    //criando variaveis que recebem arrays dos objetos
    $especies = Especie::getEspecies();
    $marcas = Marca::getMarcas();
    $categorias = Categoria::getCategorias();

    //instanciando um objeto
    $objProd_Cate = new Prod_Cate();

    $imagem = $objProd->imagem;
  
    //foreach que percorre todo o array de especies para exbixir no select
    $resEspecie = '';
    foreach($especies as $especie){
        $selecionado = $objProd->codespe == $especie->codespe ? 'selected' : '';//verificando se alguma especie ja esta selecionada
        $resEspecie .='<option value="'.$especie->codespe.'" '.$selecionado.'>'.$especie->nome_espe.'</option>';//exibindo um option
    }

    //tratamento de erro, caso nao tenha nenhuma especieno banco
    $resEspecie = strlen($resEspecie) ? $resEspecie : '<option>Nenhuma espécie cadastrada</option>';

      
    //foreach que percorre todo o array de marcas para exbixir no select
    $resMarca = '';
    foreach($marcas as $marca){
      $selecionado = $objProd->codmarca == $marca->codmarca ? 'selected' : '';//verificando se alguma especie ja esta selecionada
      $resMarca .='<option value="'.$marca->codmarca.'" '.$selecionado.' >'.$marca->nome_marca.'</option>';//exibindo um option
    }

    //tratamento de erro, caso nao tenha nenhuma marca no banco
    $resMarca = strlen($resMarca) ? $resMarca : '<option>Nenhuma marca cadastrada</option>';


    //FOREACH DE CATEGORIA
    $resCate = '';


    if($objProd->codprod){//Caso tenha clicado em editar
      $categoriaSelecionadas = $objProd_Cate->getProd_Cate($objProd->codprod);//array com as categorias selecionadas no banco

      foreach($categorias as $categoria){//array com todas as categorias

        foreach($categoriaSelecionadas as $categoriaSelecionada){
          $selecionado = $categoriaSelecionada->codcate == $categoria->codcate ? 'selected' : '';//verificando se a categoria foi selecionada
          if($selecionado)//se foi break;
            break;
        }

        $resCate .='<option value="'.$categoria->codcate.'" '.$selecionado.' >'.$categoria->nome_cate.'</option>';//deixar a categoria selecionada no html

      }
    }
    else{
      foreach($categorias as $categoria){//caso seja cadastro
        $resCate .='<option value="'.$categoria->codcate.'">'.$categoria->nome_cate.'</option>';//apenas mostrando a categoria sem estar selecionada
      }
    }

    
    //tratamento de erro, caso nao tenha nenhuma categoria no banco
    $resCate = strlen($resCate) ? $resCate : '<option>Nenhuma categoria cadastrada</option>';

    $enabled = '';
  

    if(TITLE == 'Cadastrar Produto'){
      $enabled = 'style="display:none"';
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
  <link rel="stylesheet" href="./public/css/StyleCadastroProduto.css">
</head>


<body>
  <!-- <main> -->
  <div class="container">
    <section>
    <div class="form-group">
      <a href="prod_listar.php">
        <button>Voltar</button>
      </a>
    </div>
    </section>
    
    <h2><?=TITLE?></h2>
    
    <form method="post" enctype="multipart/form-data" name="prod_cadastro">
      
      <div class="form-group">
        <label>Nome: </label>
        <input type="text" name="nome_prod" value="<?=$objProd->nome_prod?>">
      </div>
      
      <div class="form-group">
        <label>Descrição: </label>
        <textarea name="descricao" rows="4" cols="50"><?=$objProd->descricao?></textarea>
      </div>
      
      <div class="form-group">
        <label>Preço R$: </label>
        <input type="text" id="preco" name="preco" onkeyup="formatarMoeda()" value="<?=$objProd->preco?>">
    </div>
    
    <div class="form-group">
      <label>Apresentação: </label>
      <input type="text" name="apresentacao" value="<?=$objProd->apresentacao?>">
    </div>
    
    <div class="form-group">
      <label>Espécie:</label>
      <select class="form-select" name="codespe">
        <option>Selecione...</option>
        <?=$resEspecie?>;
      </select>
    </div>
    
    <div class="form-group">
      <label>Marca:</label>
      <select class="form-select" name="codmarca">
        <option>Selecione...</option>
        <?=$resMarca?>;
      </select>
    </div>
    
    <div class="form-group">
      <label>Categorias:</label>
      <select class="form-select" name="categorias[]" multiple>
        <?=$resCate?>;
      </select>
      <p style="color:darkcyan; font-weight:600;">Aperte CTRL ou SHIFT para selecionar as categorias de sua escolha!</p>
    </div>
    
    
    <div class="form-group">
      <label>Imagem: </label>
      <input type="file" id="upload" name="imagem" accept="image/*"/>
      <img <?=$enabled?> src="./public/img/<?=$imagem?>" alt=""/>
      
    </div>
    
    
    <div class="form-group">
      <button type="submit" id="salvar" name="salvar" >Salvar</button>
    </div>
    
  </form>
  
  <script>
    function formatarMoeda() {
      var elemento = document.getElementById('preco');
      var valor = elemento.value;
      
      valor = valor + '';
      valor = parseInt(valor.replace(/[\D]+/g, ''));
      valor = valor + '';
      valor = valor.replace(/([0-9]{2})$/g, ",$1");
      
      if (valor.length > 6) {
        valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
      }
      
      elemento.value = valor;
      if(valor == 'NaN') elemento.value = '';
    }
    
    </script>

<!-- </main> -->
  </div>
</body>