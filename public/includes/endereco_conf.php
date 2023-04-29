<main>

  <h2>Excluir Endereço</h2>

  <form method="post">

    <div class="form-group">
      <p>Você deseja realmente excluir o endereço <strong><?=$obEndereco->rua.', '. $obEndereco->numero.' - '. $obEndereco->bairro ?></strong>?</p>
    </div>

    <div class="form-group">
      <a href="dados_listar.php">
        <button type="button">Cancelar</button>
      </a>

      <button type="submit" name="excluir">Excluir</button>
    </div>

  </form>

</main>