  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="./public/js/masks.js"></script>
  </head>
<?php


require __DIR__.'/vendor/autoload.php';

use App\Entity\Endereco;
use App\Session\Login;

$usuario = Login::getUsuarioLogado();

Login::requireLogin();

if(isset($_POST['acao'])) {
    switch($_POST['acao']){
    case 'cadastrar':
      if(isset($_POST['cep'], $_POST['rua'], $_POST['bairro'],$_POST['numero'], $_POST['tipo']) and is_numeric($_POST['numero'])) {

        $obEndereco = new Endereco();
        $obEndereco->cep = $_POST['cep'];
        $obEndereco->rua = $_POST['rua'];
        $obEndereco->bairro = $_POST['bairro'];
        $obEndereco->numero = $_POST['numero'];
        $obEndereco->tipo = $_POST['tipo'];
        $obEndereco->codus = $usuario['codus'];

        $obEndereco->cadastrar();

        header('Location: dados_listar.php?codus=' . $usuario['codus']);


      }
      break;
  }
}

include __DIR__.'/public/includes/endereco_form.php';

