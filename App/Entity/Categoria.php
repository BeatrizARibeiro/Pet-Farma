<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Categoria{

  public $codcate;

  public $nome_cate;
  
  public function cadastrar(){
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('categoria');
    $this->codcate = $obDatabase->insert([
                                      'nome_cate' => $this->nome_cate
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * M�todo responsavel por atualizar a categoria no banco
   * @return boolean
   */
  public function atualizar(){
    return (new Database('categoria'))->update('codcate = '.$this->codcate,[
                                                                'nome_cate' => $this->nome_cate
                                                              ]);
  }

  /**
   * M�todo responsavel por excluir 
   * @return boolean
   */
  public function excluir(){
    return (new Database('categoria'))->delete('codcate = '.$this->codcate);
  }

  /**
   * M�todo responsavel por obter todas as categorias do banco de dados
   * @return array
   */
  public static function getCategorias($where = null, $order = null, $limit = null){
    return (new Database('categoria'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //funcao para pegar a quantidade de categorias
  public static function getQtdeCategorias($where = null){
    return (new Database('categoria'))->select($where, null, null, 'COUNT(*) as qtde')
                                      ->fetchObject()
                                      ->qtde;
  }

  /**
   * M�todo responsavel por buscar uma categoria com base em seu C�digo
   * @param  integer $codcate
   * @return Categoria
   */
  public static function getCategoria($codcate){
    return (new Database('categoria'))->select('codcate = '.$codcate)
                                      ->fetchObject(self::class);//passa a classe que vc quer instanciar
  }

}