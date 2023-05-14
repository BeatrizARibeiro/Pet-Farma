<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Prod_Cate{

  public $codprod;

  public $codcate;

  /**
   * Metodo responsavel por cadastrar
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('prod_cate');
    $this->codprod = $obDatabase->insert([
                                          'codprod' => $this->codprod,
                                          'codcate' => $this->codcate
                                        ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * Metodo responsavel por excluir
   * @return boolean
   */
  public function excluir($codprod){
    return (new Database('prod_cate'))->delete('codprod = '.$codprod);
  }


  //Metodo responsavel por obter todos viculos com as categorias de determinado codprod
  public static function getProd_Cate($codprod){
    return (new Database('prod_cate'))->select('codprod = '.$codprod)
                                      ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

}