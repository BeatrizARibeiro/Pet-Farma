$(document).ready(function () {
  $("#cpf").mask("000.000.000-00", { reverse: true })
  $("#telefone").mask("(00) 00000-0000")
  $("#cep").mask("00000-000")
  $("#cartao").mask("0000 0000 0000 0000")
})

$("#cep", "numero", "telefone", "cartao", "cpf").on("input", function () {
  this.value = this.value.replace(/[^0-9]/g, "")
})

$("#rua, #bairro").on("input", function () {
  this.value = this.value.replace(/[^a-zA-Z]/g, "")
})
