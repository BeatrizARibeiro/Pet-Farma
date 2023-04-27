<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Endereco{
  public $cep;

  public $rua;

  public $bairro;

  public $numero;//int

  public $tipo; //string

  public $codus; //chave estrangeira de usuario

  /**
   * M�todo responsavel por cadastrar
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('endereco');
    $this->cep = $obDatabase->insert([
                                        'cep'    => $this->cep,
                                        'rua'    => $this->rua,
                                        'bairro' => $this->bairro,
                                        'numero' => $this->numero,
                                        'tipo'   => $this->tipo,
                                        'codus'   => $this->codus,
                                    ]);
    //RETORNAR SUCESSO
    return true;
  }

  /**
   * M�todo responsavel por atualizar
   * @return boolean
   */
  public function atualizar(){
    return (new Database('endereco'))->update(  'cep = '.$this->cep,[
                                                'rua'    => $this->rua,
                                                'bairro' => $this->bairro,
                                                'numero' => $this->numero,
                                                'tipo'   => $this->tipo
                                            ]);
  }

  /**
   * M�todo responsavel por excluir
   * @return boolean
   */
  public function excluir(){
    return (new Database('endereco'))->delete('cep = '.$this->cep);
  }


  /**
   * M�todo respons�vel por buscar um endereco com base em seu codigo
   * @param  integer $cep
   * @return Endereco
   */
  public static function getEndereco($cep){
    return (new Database('produto'))->select('cep = '.$cep)
                                    ->fetchObject(self::class);//passa a classe que vc quer instanciar
  }

  /**
   * M�todo respons�vel por buscar todos os enderecos do usuario, com base no seu codigo
   * @param  integer $cep
   * @return Endereco
   */

  public static function getEnderecosCli($codus){
    return (new Database('produto'))->select('codus = '.$codus)
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//passa a classe que vc quer instanciar
  }

}