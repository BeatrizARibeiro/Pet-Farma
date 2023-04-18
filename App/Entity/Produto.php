<?php

namespace App\Entity;

use \App\Db\Database;
use App\Entity\Marca;
use App\Entity\Especie;
use \PDO;

class Produto{
  public $codprod;

  public $nome_prod;

  public $descricao;

  public $preco;

  public $peso;

  public $imagem;

  public $codespe; //chave estrangeira de especie

  public $codmarca; //chave estrangeira de marca

  /**
   * Método responsável por cadastrar uma nova vaga no banco
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('produto');
    $this->codprod = $obDatabase->insert([
                                            'nome_prod' => $this->nome_prod,
                                            'descricao' => $this->descricao,
                                            'preco'     => $this->preco,
                                            'peso'      => $this->peso,
                                            'imagem'    => $this->imagem,
                                            'codespe'   => $this->codespe,
                                            'codmarca'  => $this->codmarca
                                        ]);

    

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * Método responsável por atualizar
   * @return boolean
   */
  public function atualizar(){
    return (new Database('produto'))->update('codprod = '.$this->codprod,[
                                              'nome_prod' => $this->nome_prod,
                                              'descricao' => $this->descricao,
                                              'preco'     => $this->preco,
                                              'peso'      => $this->peso,
                                              'imagem'    => $this->imagem,
                                              'codespe'   => $this->codespe,
                                              'codmarca'  => $this->codmarca
                                            ]);
  }

  /**
   * Método responsável por excluir
   * @return boolean
   */
  public function excluir(){
    return (new Database('produto'))->delete('codprod = '.$this->codprod);
  }

  /**
   * Método responsável por obter os produtos do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getProdutos($where = null, $order = null, $limit = null){
    return (new Database('produto'))->select($where,$order,$limit)
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  /**
   * Método responsável por buscar um produto com base em seu código
   * @param  integer $codprod
   * @return Produto
   */
  public static function getProduto($codprod){
    return (new Database('produto'))->select('codprod = '.$codprod)
                                    ->fetchObject(self::class);//passa a classe que vc quer instanciar
  }

}