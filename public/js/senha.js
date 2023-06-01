function mostrarSenha(inputId, eyeIconId) {
  var senhaInput = document.getElementById(inputId)
  var eyeIcon = document.getElementById(eyeIconId)

  if (senhaInput.type === "password") {
    senhaInput.type = "text"
    eyeIcon.classList.remove("fa-eye")
    eyeIcon.classList.add("fa-eye-slash")
  } else {
    senhaInput.type = "password"
    eyeIcon.classList.remove("fa-eye-slash")
    eyeIcon.classList.add("fa-eye")
  }
}
