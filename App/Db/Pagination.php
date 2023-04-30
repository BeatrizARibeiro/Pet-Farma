<?php
namespace App\Db;

class Pagination{

    //numero maximo de registros por pagina
    private $limit;

    //qtde total de resultados do banco
    private $results;

    //numero de paginas
    private $pages;

    //pagina atual
    private $currentPage;

    //Construtor da classe
    public function __construct($results, $currentPage = 1, $limit = 10){
        $this->results = $results;
        $this->limit = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->calculate();
    }

    //metodo responsavel po calcular a paginacao
    private function calculate(){
        //CALCULA O TOTAL DE PAGINAS
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;
    
        //VERIFICA DE A PAGINA ATUAL NAO EXCEDE O NUMERO DE PAGINAS
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    //metodo responsavel por retornar a clausula limit da sql
    public function getLimit(){
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset.','.$this->limit;
    }

    //metodo responsavel por retornar as opcoes de paginas disponiveis
    public function getPages(){
        //não retorna
        if($this->pages == 1) return [];

        //paginas
        $paginas = [];
            for($i = 1; $i <= $this->pages; $i ++){
                $paginas[] = [
                    'pagina' => $i,
                    'atual' => $i == $this->currentPage
                ];
            }

        return $paginas;
    }

}

?>