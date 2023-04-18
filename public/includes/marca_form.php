<main>

  <section>
    <a href="marca_listar.php">
      <button>Voltar</button>
    </a>
  </section>

  <h2><?=TITLE?></h2>

  <form method="post">

    <div class="form-group">
      <label>Nome: </label>
      <input type="text" name="nome_marca" value="<?=$objMarca->nome_marca?>"><!--Caso ja tenha no banco ira mostrar-->
    </div>

    <div class="form-group">
      <button type="submit">Salvar</button>
    </div>

  </form>

</main>