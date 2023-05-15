<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Item_Pedido{
  public $numpedido;

  public $codprod;

  public $qtde;

  /**
   * Metodo responsavel por cadastrar
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('item_pedido');
    $this->numpedido = $obDatabase->insert([
                                          'numpedido' => $this->numpedido,
                                          'codprod' => $this->codprod,
                                          'qtde' => $this->qtde
                                        ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * Método responsável por atualizar
   * @return boolean
   */
  public function atualizar($codprod){
    return (new Database('item_pedido'))->update('codprod = '.$this->codprod,[
                                                                'qtde' => $this->qtde,
                                                              ]);
  }

  /**
   * Metodo responsavel por excluir
   * @return boolean
   */
  public function excluir($codprod){
    return (new Database('item_pedido'))->delete('codprod = '.$codprod);
  }


  //Metodo responsavel por obter todos itens pedidos de acordo com o pedido
  public static function getIens_Pedido($numpedido){
    return (new Database('item_pedido'))->select('numpedido = '.$numpedido)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Metodo responsavel por obter o item pedido
  public static function getIem_Pedido($codprod){
    return (new Database('item_pedido'))->select('codprod = '.$codprod)
                                        ->fetchObject(self::class);//passa a classe que vc quer instanciar
  }

}