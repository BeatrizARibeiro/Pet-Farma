<main>

  <h2>Cancelar Pedido</h2>

  <form method="post">

    <div class="form-group">
      <p>Você deseja realmente cancelar o pedido nº <strong><?=$pedido->numpedido?></strong>? &#128542;</p>
    </div>

    <div class="form-group">
      <a href="pedido_ver.php?numpedido=<?=$pedido->numpedido?>">
        <button type="button">Não</button>
      </a>

      <button type="submit" name="sim">Sim</button>
    </div>

  </form>

</main>