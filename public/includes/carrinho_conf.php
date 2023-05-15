<main>
  <!--Confirmacao de exclusao de categoria-->
  <h2>Excluir Item do Carrinho</h2>

  <form method="post">

    <div class="form-group">
      <p>Você deseja realmente excluir o item <strong><?=$produto->nome_prod?></strong>?</p>
    </div>

    <div class="form-group">
      <a href="carrinho.php">
        <button type="button">Cancelar</button>
      </a>

      <button type="submit" name="excluir">Excluir</button>
    </div>

  </form>

</main>