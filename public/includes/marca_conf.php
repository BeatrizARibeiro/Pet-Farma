<main>

  <h2>Excluir Marca</h2>

  <form method="post">

    <div class="form-group">
      <p>Você deseja realmente excluir a marca <strong><?=$objMarca->nome_marca?></strong>?</p>
    </div>

    <div class="form-group">
      <a href="marca_listar.php">
        <button type="button">Cancelar</button>
      </a>

      <button type="submit" name="excluir">Excluir</button>
    </div>

  </form>

</main>