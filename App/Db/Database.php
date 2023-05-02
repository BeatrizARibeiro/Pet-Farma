<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database{

  /**
   * Host de conexão com o banco de dados
   * @var string
   */
  const HOST = 'localhost';

  /**
   * Nome do banco de dados
   * @var string
   */
  const NAME = 'pet-farma';

  /**
   * Usuário do banco
   * @var string
   */
  const USER = 'root';

  /**
   * Senha de acesso ao banco de dados
   * @var string
   */
  const PASS = '';

  /**
   * Nome da tabela a ser manipulada
   * @var string
   */
  private $table;

  /**
   * Instancia de conexão com o banco de dados
   * @var PDO
   */
  private $connection;

  /**
   * Define a tabela e instancia e conexão
   * @param string $table
   */
  public function __construct($table = null){
    $this->table = $table;
    $this->setConnection();
  }

  /**
   * Método responsável por criar uma conexão com o banco de dados
   */
  private function setConnection(){
    try{
      $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      die('ERROR: '.$e->getMessage());
    }
  }

  /**
   * Método responsável por executar queries dentro do banco de dados
   * @param  string $query
   * @param  array  $params
   * @return PDOStatement
   */
  public function execute($query,$params = []){
    try{
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;
    }catch(PDOException $e){
      die('ERROR: '.$e->getMessage());
    }
  }

  /**
   * Método responsável por inserir dados no banco
   * @param  array $values [ field => value ]
   * @return integer ID inserido
   */
  public function insert($values){
    //DADOS DA QUERY
    $fields = array_keys($values);
    $binds  = array_pad([],count($fields),'?');

    //MONTA A QUERY
    $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

    //EXECUTA O INSERT
    $this->execute($query,array_values($values));

    //RETORNA O ID INSERIDO
    return $this->connection->lastInsertId();
  }

  /**
   * Método responsável por executar uma consulta no banco
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @param  string $fields
   * @return PDOStatement
   */
  public function select($where = null, $order = null, $limit = null, $fields = '*'){
    //DADOS DA QUERY
    $where = strlen($where) ? 'WHERE '.$where : '';
    $order = strlen($order) ? 'ORDER BY '.$order : '';
    $limit = strlen($limit) ? 'LIMIT '.$limit : '';

    //MONTA A QUERY
    $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

    //EXECUTA A QUERY
    return $this->execute($query);
  }

  //QUERY PARA PEGAR DESTAQUES
  public function select2(){
    $query = "select * from produto p inner join prod_cate pc
    on p.codprod = pc.codprod
    inner join categoria c 
    on pc.codcate = c.codcate
    where c.nome_cate like '%Destaques%'";

    return $this->execute($query);
  }

  //QUERY PARA PEGAR PROD AVES 
  public function selectAves(){
    $query = "select * from produto p inner join especie e
    on p.codespe = e.codespe
    where e.nome_espe like '%Ave%' or e.nome_espe like '%Pássaro%'";

    return $this->execute($query);
  }

   
  //QUERY PARA PEGAR PROD SILVESTRES
   public function selectSilvestres(){
    $query = "select * from produto p inner join especie e
    on p.codespe = e.codespe
    where e.nome_espe like '%Coelho%' or e.nome_espe like '%Roedores%'
    or e.nome_espe like '%Rato%' or e.nome_espe like '%Hamster%'
    or e.nome_espe like '%Porquinho%da%India%'";

    return $this->execute($query);
  }

  //QUERY PARA PEGAR PROD EQUINOS
  public function selectEquinos(){
    $query = "select * from produto p inner join especie e
    on p.codespe = e.codespe
    where e.nome_espe like '%Cavalo%'";

    return $this->execute($query);
  }

  //QUERY PARA PEGAR PROD PEIXES
  public function selectPeixes(){
    $query = "select * from produto p inner join especie e
    on p.codespe = e.codespe
    where e.nome_espe like '%Peixe%'";

    return $this->execute($query);
  }

  //QUERY PARA PEGAR PROD REPTEIS
  public function selectRepteis(){
    $query = "select * from produto p inner join especie e
    on p.codespe = e.codespe
    where e.nome_espe like '%Réptil%' or e.nome_espe like '%Tartatuga%'
    or e.nome_espe like '%Cobra%' or e.nome_espe like '%Lagarto%'";

    return $this->execute($query);
  }

  //QUERY PARA PEGAR PROD MAMIFEROS
  public function selectMamiferos(){
    $query = "select * from produto p inner join especie e
    on p.codespe = e.codespe
    where e.nome_espe like '%Mamífero%' or e.nome_espe like '%Cachorro%' 
    or e.nome_espe like '%Gato%'";

    return $this->execute($query);
  }

  //QUERY PARA PEGAR MEDICAMENTOS
  public function selectMedicamentos(){
    $query = "select * from produto p inner join prod_cate pc
    on p.codprod = pc.codprod
    inner join categoria c
    on pc.codcate = c.codcate
    where c.nome_cate like '%Medicamentos%'";

    return $this->execute($query);
  }

   //QUERY PARA PEGAR TRATAMENTOS
   public function selectTratamentos(){
    $query = "select * from produto p inner join prod_cate pc
    on p.codprod = pc.codprod
    inner join categoria c
    on pc.codcate = c.codcate
    where c.nome_cate like '%Tratamentos%'";

    return $this->execute($query);
  }

   //QUERY PARA PEGAR SUPLEMENTOS E VITAMINAS
   public function selectSuplementosVitaminas(){
    $query = "select * from produto p inner join prod_cate pc
    on p.codprod = pc.codprod
    inner join categoria c
    on pc.codcate = c.codcate
    where c.nome_cate like '%Suplementos%' or c.nome_cate like '%Vitaminas%'";

    return $this->execute($query);
  }

   //QUERY PARA PEGAR ACESSORIOS
   public function selectAcessorios(){
    $query = "select * from produto p inner join prod_cate pc
    on p.codprod = pc.codprod
    inner join categoria c
    on pc.codcate = c.codcate
    where c.nome_cate like '%Acessórios%'";

    return $this->execute($query);
  }

   //QUERY PARA PEGAR BRINQUEDOS
   public function selectBrinquedos(){
    $query = "select * from produto p inner join prod_cate pc
    on p.codprod = pc.codprod
    inner join categoria c
    on pc.codcate = c.codcate
    where c.nome_cate like '%Brinquedos%'";

    return $this->execute($query);
  }

   //QUERY PARA PEGAR HIGIENE E COSMÉTICOS
   public function selectHigieneCosmetico(){
    $query = "select * from produto p inner join prod_cate pc
    on p.codprod = pc.codprod
    inner join categoria c
    on pc.codcate = c.codcate
    where c.nome_cate like '%Higiene%' or c.nome_cate like '%Cométicos%'";

    return $this->execute($query);
  }

  /**
   * Método responsável por executar atualizações no banco de dados
   * @param  string $where
   * @param  array $values [ field => value ]
   * @return boolean
   */
  public function update($where,$values){
    //DADOS DA QUERY
    $fields = array_keys($values);

    //MONTA A QUERY
    $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

    //EXECUTAR A QUERY
    $this->execute($query,array_values($values));

    //RETORNA SUCESSO
    return true;
  }

  /**
   * Método responsável por excluir dados do banco
   * @param  string $where
   * @return boolean
   */
  public function delete($where){
    //MONTA A QUERY
    $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

    //EXECUTA A QUERY
    $this->execute($query);

    //RETORNA SUCESSO
    return true;
  }

}