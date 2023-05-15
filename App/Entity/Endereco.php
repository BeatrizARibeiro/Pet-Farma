<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Endereco{
  public $codend;

  public $cep;

  public $rua;

  public $bairro;

  public $numero;//int

  public $tipo; //string

  public $codus; //chave estrangeira de usuario

  public $padrao;

  /**
   * M�todo responsavel por cadastrar
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('endereco');
    $this->codend = $obDatabase->insert([
                                        'codend' => $this->codend,
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
    return (new Database('endereco'))->update(  'codend = '.$this->codend,[
                                                'cep'    => $this->cep,
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
    return (new Database('endereco'))->delete('codend = '.$this->codend);
  }


  /**
   * M�todo respons�vel por buscar um endereco com base em seu codigo
   * @param  integer $cep
   * @return Endereco
   */
  public static function getEndereco($codend){
    return (new Database('endereco'))->select('codend = '.$codend)
                                    ->fetchObject(self::class);//passa a classe que vc quer instanciar
  }

  /**
   * M�todo respons�vel por buscar todos os enderecos do usuario, com base no seu codigo
   * @param  integer $cep
   * @return Endereco
   */

  public static function getEnderecosCli($codus){
    return (new Database('endereco'))->select('codus = '.$codus)
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//passa a classe que vc quer instanciar
  }

  //pegar endereço padrão
  public static function getEnderecoPadrao($codus){
    return (new Database('endereco'))->select('codus = '.$codus.' and padrao = 1')
                                      ->fetchObject(self::class);//passa a classe que vc quer instanciar
  }

}