<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Usuario{

  //AINDA NAO COLOQUEI NENHUMA FUNCAO
  public $codus;

  public $nome;

  public $email;

  public $senha;

  public $cpf; //tipo texto por conta da mascara

  public $telefone; //tipo texto por conta da mascara

  public $token;

  public function cadastrar() {
  $obDatabase = new Database('usuario');

  $this->codus = $obDatabase->insert([
    'nome' => $this->nome,
    'email' => $this->email,
    'senha' => $this->senha,
    'cpf' => $this->cpf,
    'telefone' => $this->telefone,
  ]);

  return true;
}

public function atualizar($dados) {
  $obDatabase = new Database('usuario');

  $this->codus = $obDatabase->update('codus = '.$this->codus,[
    'nome' => $this->nome,
    'email' => $this->email,
    'cpf' => $this->cpf,
    'telefone' => $this->telefone,
    'senha' => $this->senha,
]);
}

public function atualizarSenha($novaSenha) {
    $obDatabase = new Database('usuario');

    return $obDatabase->update('codus = '.$this->codus, [
        'senha' => $novaSenha
    ]);
}

public function setToken($token) {
  $obDatabase = new Database('usuario');
  $this->token = $token;
  $obDatabase->update('codus = '.$this->codus, [
    'token' => $this->token,
  ]);
}

  public function validaToken($tokenUrl) {
    $obDatabase = new Database('usuario');
    $registro = $obDatabase->select('token = "'. $tokenUrl.'"');

    if (!empty($registro)) {
      return true; // o token da URL é igual ao token salvo no banco de dados
    } else {
      header('Location: login.php?status=missingtoken');
      return false; // o token da URL não é válido
    }
  }


  public static function getUsuarioPorEmail($email) {
    return (new Database('usuario'))
    ->select('email = "'. $email.'"')
    ->fetchObject(self::class);
  }

  public static function getUsuarioPorCodus($codus) {
  return (new Database('usuario'))
    ->select('codus = '. $codus)
    ->fetchObject(self::class);
  }

  public static function getUsuarioPorToken($token) {
    return (new Database('usuario'))
    ->select('token = "'. $token.'"')
    ->fetchObject(self::class);
  }
}