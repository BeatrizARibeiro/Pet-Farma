<main>
  <!--Confirmacao de exclusao de categoria-->
  <h2>Excluir Categoria</h2>

  <form method="post">

    <div class="form-group">
      <p>Você deseja realmente excluir a categoria <strong><?=$objCate->nome_cate?></strong>?</p>
    </div>

    <div class="form-group">
      <a href="cate_listar.php">
        <button type="button">Calcelar</button>
      </a>

      <button type="submit" name="excluir">Excluir</button>
    </div>

  </form>

</main>