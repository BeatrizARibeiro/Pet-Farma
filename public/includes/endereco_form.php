<?php
$alertaCadastroEndereco = strlen($alertaCadastroEndereco) ? '<div>' . $alertaCadastroEndereco . '</div>' : '';
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PetFarma</title>
  <link
    rel="stylesheet"
    href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
  />
  <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
  <link rel="stylesheet" href="./public/css/StyleCadastroEndereco.css" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="./public/js/masks.js"></script>
</head>

<body>
  <section id="header">
    <a href="index.php"
      ><img src="./public/img/logopetfarma2.png" class="logo" alt=""
    /></a>

    <div>
      <ul id="navbar">
        <li>
          <i class="fas fa-solid fa-lock"></i>
          <h3>Ambiente seguro</h3>
        </li>
      </ul>
    </div>
  </section>

  <main>
    <div class="form-container">
      <a href="dados_listar.php?codus=<?= $usuarioLogado['codus'] ?>">Voltar</a>
      <h1>Cadastrar endereço</h1>
      <form method="POST">
        <div class="form-group">
            <label for="cep" class="inputLabel">CEP</label>
            <input
                type="text"
                name="cep"
                id="cep"
                class="inputUser"
                placeholder="00000-000"
                value="<?php echo (in_array('cep', $camposComErro)) ? '' : htmlspecialchars($_POST['cep'] ?? ''); ?>"
                required
            />
        </div>

        <div class="form-group">
            <label for="uf" class="inputLabel">UF</label>
            <select name="uf" id="uf" class="inputUser" required>
                <option value="" <?php echo (in_array('uf', $camposComErro)) ? '' : 'selected'; ?> disabled hidden>
                    Selecione um estado
                </option>
                <!-- Aqui você pode adicionar opções para os estados -->
            </select>
        </div>

        <div class="form-group">
            <label for="cidade" class="inputLabel">Cidade</label>
            <input
                type="text"
                name="cidade"
                id="cidade"
                class="inputUser"
                value="<?php echo (in_array('cidade', $camposComErro)) ? '' : htmlspecialchars($_POST['cidade'] ?? ''); ?>"
                required
            />
        </div>

        <div class="form-group">
            <label for="rua" class="inputLabel">Rua</label>
            <input
                type="text"
                name="rua"
                id="rua"
                class="inputUser"
                value="<?php echo (in_array('rua', $camposComErro)) ? '' : htmlspecialchars($_POST['rua'] ?? ''); ?>"
                required
            />
        </div>

        <div class="form-group">
            <label for="bairro" class="inputLabel">Bairro</label>
            <input
                type="text"
                name="bairro"
                id="bairro"
                class="inputUser"
                value="<?php echo (in_array('bairro', $camposComErro)) ? '' : htmlspecialchars($_POST['bairro'] ?? ''); ?>"
                required
            />
        </div>

        <div class="form-group">
            <label for="numero" class="inputLabel">Número</label>
            <input
                type="number"
                name="numero"
                id="numero"
                class="inputUser"
                value="<?php echo (in_array('numero', $camposComErro)) ? '' : htmlspecialchars($_POST['numero'] ?? ''); ?>"
                required
            />
        </div>


        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo">
                <option value="casa" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] === 'casa') ? 'selected' : ''; ?>>Casa</option>
                <option value="apartamento" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] === 'apartamento') ? 'selected' : ''; ?>>Apartamento</option>
            </select>
        </div>

        <div class="form-group">
            <label for="padrao">Definir como padrão (opcional)</label>
            <input type="checkbox" name="padrao" id="padrao" value="1" <?php echo (isset($_POST['padrao']) && $_POST['padrao'] === '1') ? 'checked' : ''; ?> />
        </div>

        <?= $alertaCadastroEndereco ?>

        <div class="btn">
          <center>
            <input
              type="submit"
              name="acao"
              value="cadastrar"
              class="form-button"
            />
          </center>
        </div>
      </form>
    </div>
  </main>

  <script src="./public/js/cep.js"></script>
</body>