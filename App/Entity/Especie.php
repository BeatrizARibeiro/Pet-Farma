<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Especie{

  public $codespe;

  public $nome_espe;

  /**
   * Metodo responsavel por cadastrar
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('especie');
    $this->codespe = $obDatabase->insert([
                                          'nome_espe' => $this->nome_espe,
                                        ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * Metodo responsavel por atualizar
   * @return boolean
   */
  public function atualizar(){
    return (new Database('especie'))->update('codespe = '.$this->codespe,[
                                                  'nome_espe' => $this->nome_espe,
                                                ]);
  }

  /**
   * Metodo responsavel por excluir
   * @return boolean
   */
  public function excluir(){
    return (new Database('especie'))->delete('codespe = '.$this->codespe);
  }

  /**
   * Metodo responsavel por obter as especies do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getEspecies($where = null, $order = null, $limit = null){
    return (new Database('especie'))->select($where,$order,$limit)
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //funcao para pegar a quantidade de especies
  public static function getQtdeEspecies($where = null){
    return (new Database('especie'))->select($where, null, null, 'COUNT(*) as qtde')
                                    ->fetchObject()
                                    ->qtde;
  }
  public static function getEspeciesEmProdutos($codespe){
    return (new Database('especie'))->selectEspeciesEmProdutos($codespe)
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }


  /**
   * Metodo responsavel por buscar uma especie com base em seu codigo
   * @param  integer $codespe
   * @return Especie
   */
  public static function getEspecie($codespe){
    return (new Database('especie'))->select('codespe = '.$codespe)
                                    ->fetchObject(self::class);//passa a classe que vc quer instanciar
  }

}