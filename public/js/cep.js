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
  document.getElementById("cep").addEventListener("blur", limparCampos)
  document.getElementById("cep").addEventListener("blur", pesquisarCep)
}

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
    const enderecoUF = "SP" // substitua pelo valor atual do campo UF

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
