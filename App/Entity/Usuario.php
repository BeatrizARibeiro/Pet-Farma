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

public function atualizarSenha($novosDados) {
    $this->senha = $novosDados['senha'];

    return (new Database('usuario'))
      ->update('codus = '.$this->codus,[
      'senha' => $this->senha,
    ]);
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
}