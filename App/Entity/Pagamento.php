<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Pagamento{

  //AINDA NAO COLOQUEI NENHUMA FUNCAO
  public $codpag;

  public $tipo;

  public $nome_cartao;

  public $bandeira;//string

  public $num_cartao;//int

  public $dt_validade; //date

  public $parcelas; //int

  public $pago; //boolean
}