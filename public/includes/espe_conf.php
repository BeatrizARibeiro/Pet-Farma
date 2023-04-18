<main>

  <h2>Excluir Espécie</h2>

  <form method="post">

    <div class="form-group">
      <p>Você deseja realmente excluir a espécie <strong><?=$objEspe->nome_espe?></strong>?</p>
    </div>

    <div class="form-group">
      <a href="espe_listar.php">
        <button type="button">Calcelar</button>
      </a>

      <button type="submit" name="excluir">Excluir</button>
    </div>

  </form>

</main>