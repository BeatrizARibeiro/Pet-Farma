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

  public $apresentacao;

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
                                            'apresentacao'      => $this->apresentacao,
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
                                              'apresentacao' => $this->apresentacao,
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

  //Função para pegar os produtos em destaques
  public static function getProdutosEmDestaque(){
    return (new Database('produto'))->select2()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os produtos para aves
  public static function getProdutosAves(){
    return (new Database('produto'))->selectAves()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os produtos para silvestres
  public static function getProdutosSilvestres(){
    return (new Database('produto'))->selectSilvestres()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os produtos para equinos
  public static function getProdutosEquinos(){
    return (new Database('produto'))->selectEquinos()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os produtos para peixes
  public static function getProdutosPeixes(){
    return (new Database('produto'))->selectPeixes()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os produtos para peixes
  public static function getProdutosRepteis(){
    return (new Database('produto'))->selectRepteis()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os produtos para mamiferos
  public static function getProdutosMamiferos(){
    return (new Database('produto'))->selectMamiferos()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os medicamentos
  public static function getProdutosMedicamentos(){
    return (new Database('produto'))->selectMedicamentos()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os tratamentos
  public static function getProdutosTratamentos(){
    return (new Database('produto'))->selectTratamentos()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os suplementos e vitaminas
  public static function getProdutosSupl_Vita(){
    return (new Database('produto'))->selectSuplementosVitaminas()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os acessorio
  public static function getProdutosAcessorios(){
    return (new Database('produto'))->selectAcessorios()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os brinquedos
  public static function getProdutosBrinquedos(){
    return (new Database('produto'))->selectBrinquedos()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //Função para pegar os Higiene e cosmeticos
  public static function getProdutosHigi_Cosm(){
    return (new Database('produto'))->selectHigieneCosmetico()
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

   //Função para pegar produtos que estão em pedidos
   public static function getProdutosEmPedidos($codprod){
    return (new Database('produto'))->selectProdutosEmPedidos($codprod)
                                    ->fetchAll(PDO::FETCH_CLASS,self::class);//todo retorno vai ser passado num array de classes de objetos
  }

  //funcao para pegar a quantidade de produtos
  public static function getQtdeProdutos($where = null){
    return (new Database('produto'))->select($where, null, null, 'COUNT(*) as qtde')
                                    ->fetchObject()
                                    ->qtde;
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