<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Marca{

  public $codmarca;

  public $nome_marca;

  /**
   * Método responsável por cadastrar uma nova marca
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('marca');
    $this->codmarca = $obDatabase->insert([
                                      'nome_marca' => $this->nome_marca,
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * Método responsável por atualizar a marca no banco
   * @return boolean
   */
  public function atualizar(){
    return (new Database('marca'))->update('codmarca = '.$this->codmarca,[
                                                                'nome_marca' => $this->nome_marca,
                                                              ]);
  }

  /**
   * Metodo responsavel por excluir
   * @return boolean
   */
  public function excluir(){
    return (new Database('marca'))->delete('codmarca = '.$this->codmarca);
  }

  /**
   * Metodo responsavel por obter as marcas do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getMarcas($where = null, $order = null, $limit = null){
    return (new Database('marca'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //funcao para pegar a quantidade de marcas
  public static function getQtdeMarcas($where = null){
    return (new Database('marca'))->select($where, null, null, 'COUNT(*) as qtde')
                                  ->fetchObject()
                                  ->qtde;
  }


  public static function getMarcasEmProdutos($codmarca){
    return (new Database('marca'))->selectMarcasEmProdutos($codmarca)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }
  /**
   * Metodo responsavel por buscar uma marca com base em seu codigo
   * @param  integer $codmarca
   * @return Marca
   */
  public static function getMarca($codmarca){
    return (new Database('marca'))->select('codmarca = '.$codmarca)
                                  ->fetchObject(self::class);//passa a classe que vc quer instanciar
  }

}