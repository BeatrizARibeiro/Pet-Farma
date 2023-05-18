<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Pedido{

  public $numpedido;

  public $dt_pedido;

  public $status_pedido;

  public $protocolo;

  public $codus;

  public $codend;

  public $codpag;
  
  public function cadastrar(){
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('pedido');
    $this->numpedido = $obDatabase->insert([
                                        'numpedido' => $this->numpedido,
                                        'status_pedido' => $this->status_pedido,
                                        'codus' => $this->codus
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * M�todo responsavel por finalizar o pedido
   * @return boolean
   */
  public function finalizar(){
    $this->dt_pedido = date('Y-m-d H:i:s');

    return (new Database('pedido'))->update('numpedido = '.$this->numpedido,[
                                                'numpedido' => $this->numpedido,
                                                'dt_pedido' => $this->dt_pedido,
                                                'status_pedido' => $this->status_pedido,
                                                'codus' => $this->codus,
                                                'codend' => $this->codend
                                            ]);
  }

  /**
   * M�todo responsavel por excluir 
   * @return boolean
   */
  public function excluir(){
    return (new Database('pedido'))->delete('numpedido = '.$this->numpedido);
  }
  
  //Método para atualizar o status do pedido
  public function atuzaliarStatus(){
    return (new Database('pedido'))->update('numpedido = '.$this->numpedido,[
                                                'status_pedido' => $this->status_pedido,
                                                'protocolo' => $this->protocolo
                                            ]);
  }

  //método para pegar o pedido através do seu código
  public static function getPedido($numpedido){
    return (new Database('pedido'))->select('numpedido = '.$numpedido)
                                    ->fetchObject(self::class);
  }
  /**
   * Método responsavel por obter todos os pedidos
   * @return array
   */
  public static function getPedidos($where = null, $order = null, $limit = null){
    return (new Database('pedido'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //funcao para pegar a quantidade de pedidos
  public static function getQtdePedidos($where = null){
    return (new Database('pedido'))->select($where, null, null, 'COUNT(*) as qtde')
                                    ->fetchObject()
                                    ->qtde;
  }

  /**
   * M�todo responsavel por buscar pedidos de um determinado cliente
   * @param  integer $codcate
   * @return Categoria
   */
  public static function getPedidosCli($codus){
    return (new Database('pedido'))->select('codus = '.$codus)
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//passa a classe que vc quer instanciar
  }

   /**
   * Método responsavel por buscar pedido em aberto de um determinado cliente
   * @return object
   */
  public static function getPedidoAberto($codus){
    return (new Database('pedido'))->selectPedidoAberto($codus)
                                    ->fetchObject();
  }

  //MÉTODO PARA PEGAR A DESCRIÇÃO DOS PRODUTOS DA LISTA DO PEDIDO
  public static function getProdutoporPedido($numpedido){
  return (new Database('pedido'))->selectProdutosPedido($numpedido)
                                 ->fetchAll(PDO::FETCH_CLASS,self::class);//passa a classe que vc quer instanciar
  }


}