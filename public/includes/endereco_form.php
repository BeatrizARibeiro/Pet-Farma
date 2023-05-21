<?php
  $alertaCadastroEndereco = strlen($alertaCadastroEndereco) ? '<div>'.$alertaCadastroEndereco.'</div>' : '';
?>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetFarma</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="imagem/png" href="./public/img/logopetfarma.png" />
    <link rel="stylesheet" href="./public/css/StyleCadastroEndereco.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="./public/js/masks.js"></script>
  </head>

<body>

    <section id="header">
      <a href="index.php"><img src="./public/img/logopetfarma2.png" class="logo" alt=""></a>

      <div>
        <ul id="navbar">
          <li><i class="fas fa-solid fa-lock"></i>
            <h3>Ambiente seguro</h3>
          </li>
        </ul>
      </div>
    </section>
  
  <main>
    <div class="form-container">
      <a href="dados_listar.php?codus=<?=$usuarioLogado['codus']?>">Voltar</a>
      <h1>Cadastrar enadereço</h1>
      <form method="POST">
        <div class="form-group">
          <label for="cep" class="inputLabel">CEP</label>
          <input
          type="text"
          name="cep"
          id="cep"
          class="inputUser"
          placeholder="00000-000"
          required
          />
        </div>

        <div class="form-group">
          <label for="uf" class="inputLabel">UF</label>
          <select
            name="uf"
            id="uf"
            class="inputUser"
            required
          >
            <option value="" selected disabled hidden>Selecione um estado</option>
          </select>
        </div>

        <div class="form-group">
          <label for="cidade" class="inputLabel">Cidade</label>
          <input
          type="text"
          name="cidade"
          id="cidade"
          class="inputUser"
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
            required
          />
        </div>
      
        <div class="form-group">
          <label for="numero" class="inputLabel">Numero</label>
          <input
          type="number"
          name="numero"
          id="numero"
          class="inputUser"
          required
          />
        </div>
      
        <div class="form-group">
          <label for="tipo">Tipo</label>
          <select id="tipo" name="tipo">
            <option value="casa">Casa</option>
            <option value="apartamento">Apartamento</option>
          </select>
        </div>

        <div class="form-group">
          <label for="padrao">Definir como padrão (opcional)</label>
          <input type="checkbox" name="padrao" id="padrao" value="1">
        </div>

        <?=$alertaCadastroEndereco?>

        <div class="form-group">
          <input type="submit" name="acao" value="cadastrar" class="form-button">
        </div>
      </form>
    </div>
  </main>

    <script>
      function pesquisarCep() {
        const cep = document.getElementById("cep").value
        if (!/^\d{5}-\d{3}$/.test(cep)) {
          return
        }

        const url = `https://viacep.com.br/ws/${cep}/json/`
        fetch(url)
          .then((response) => response.json())
          .then((data) => {
            if (!data.erro) {
              document.getElementById("cidade").value = data.localidade
              document.getElementById("uf").value = data.uf
              document.getElementById("rua").value = data.logradouro
              document.getElementById("bairro").value = data.bairro
            }
          })
          .catch((error) => {
            console.error(error)
            limparCampos()
          })
        }
        document.getElementById("cep").addEventListener("blur", limparCampos)
        document.getElementById("cep").addEventListener("blur", pesquisarCep)

      function limparCampos() {
        document.getElementById("cidade").value = ""
        document.getElementById("uf").value = ""
        document.getElementById("rua").value = ""
        document.getElementById("bairro").value = ""
      }

      const selectUF = document.getElementById("uf")

      fetch("https://servicodados.ibge.gov.br/api/v1/localidades/estados")
        .then((response) => response.json())
        .then((data) => {
          const enderecoUF = data.uf ? data.uf : "SP" // substitua pelo valor atual do campo UF

          data.forEach((estado) => {
            const option = document.createElement("option")
            option.value = estado.sigla
            option.text = estado.sigla
            selectUF.appendChild(option)

            if (enderecoUF === estado.sigla) {
              selectUF.value = enderecoUF
            }
          })
        })
        .catch((error) => {
          console.log(error)
        })

    </script>
</body>