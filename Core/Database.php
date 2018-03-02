<?php
namespace Core;
/*
Baseado na documentação do PHP
classe de abstração do banco de dados
*/
abstract class Database{

    protected $conexao;
    private $config ;
    
    public function __construct(){
        $this->config = include 'Config/config.php';
        try{            
            $this->conexao = new \PDO($this->config['db'].":host=".$this->config['host'].";dbname=".$this->config['dbName'],$this->config['user'],$this->config['password']);
            $this->conexao->setAttribute(\PDO::ATTR_EMULATE_PREPARES, TRUE);
            $this->conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch (\PDOException $e){
            die("Erro: <code>" . $e->getMessage() . "</code>");
        }         
    }
}

