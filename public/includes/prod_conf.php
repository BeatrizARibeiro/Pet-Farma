<main>

  <h2>Excluir Produto</h2>

  <form method="post">

    <div class="form-group">
      <p>Você deseja realmente excluir o produto <strong><?=$objProd->nome_prod?></strong>?</p>
    </div>

    <div class="form-group">
      <a href="prod_listar.php">
        <button type="button">Cancelar</button>
      </a>

      <button type="submit" name="excluir">Excluir</button>
    </div>

  </form>

</main>