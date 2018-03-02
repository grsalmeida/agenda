<?php 
namespace App\Model;

use Core\Database; 

class Contato extends Database
{
	private $contato;
	
	public function __construct()
	{
			parent::__construct();
	}

	public function listContato(){
		try{
			$result = $this->conexao->query("SELECT * FROM contato");
            $result = $result->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		}catch(\PDOException $e){
 			return false;
		}
	}

	public function addContato($params){
		try {
            $this->conexao->beginTransaction();
            if(!isset($_SESSION)){ 
                session_start(); 
            }
            $result = $this->conexao->query("SELECT * FROM user WHERE password = '{$_SESSION['login']}'");
            $result = $result->fetchAll(\PDO::FETCH_ASSOC);
            $query = $this->conexao->prepare('INSERT INTO contato (str_nome, str_telefone, str_celular,str_email,id_user) VALUES(:str_nome, :str_telefone, :str_celular, :str_email,:id_user)');
            $query->execute([
                ":str_nome" => $params['str_nome'],
                ":str_telefone" => $params['str_telefone'],
                ":str_celular" => $params['str_celular'],
                ":str_email" => $params['str_email'],
                ':id_user' => $result[0]['id']
            ]);
            $lastId = $this->conexao->lastInsertId();
            $this->conexao->commit();
            return $lastId;
        } catch (\PDOException $e) {
                $this->conexao->rollback();
            return false;
        }
	}

	public function editContato($params){
        try{
		      $this->conexao->beginTransaction();
            $query = $this->conexao->prepare('UPDATE contato SET str_nome = :str_nome, str_telefone = :str_telefone, str_celular = :str_celular, str_email = :str_email WHERE id = :id');
            $query->execute([
                ":id" => $params['id'],
                ":str_nome" => $params['str_nome'],
                ":str_telefone" => $params['str_telefone'],
                ":str_celular" => $params['str_celular'],
                ":str_email" => $params['str_email'],
            ]);
            $this->conexao->commit();
            return $params['id'];
        }catch (\PDOException $e) {
            $this->conexao->rollback();
            return false;
        }
	}

	public function removeContato($params){
		try {
            $this->conexao->beginTransaction();
            $query = $this->conexao->prepare('DELETE FROM contato WHERE id = :id');
            $query->execute([
                ":id" => $params['id'],
            ]);
            $this->conexao->commit();
            return $params['id'];
        } catch (\PDOException $e) {
            $this->conexao->rollback();
            return false;
        }
	}

    public function hour(){
        try{
            $result = $this->conexao->query("
                select count(*) as quantidade,  Case (DATE_FORMAT(created_at, '%H:%i:%s')) 
                                        WHEN 1 THEN '01:00:00 as 01:59:59'
                                        WHEN 2 THEN '02:00:00 as 02:59:59'
                                        WHEN 3 THEN '03:00:00 as 03:59:59'
                                        WHEN 4 THEN '04:00:00 as 04:59:59'
                                        WHEN 5 THEN '05:00:00 as 05:59:59'                      
                                        WHEN 6 THEN '06:00:00 as 06:59:59'
                                        WHEN 7 THEN '07:00:00 as 07:59:59'
                                        WHEN 8 THEN '08:00:00 as 08:59:59'
                                        WHEN 9 THEN '09:00:00 as 09:59:59'
                                        WHEN 10 THEN '10:00:00 as 10:59:59'
                                        WHEN 11 THEN '11:00:00 as 11:59:59'
                                        WHEN 12 THEN '12:00:00 as 12:59:59'
                                        WHEN 13 THEN '13:00:00 as 13:59:59'
                                        WHEN 14 THEN '14:00:00 as 14:59:59'
                                        WHEN 15 THEN '15:00:00 as 15:59:59'
                                        WHEN 16 THEN '16:00:00 as 16:59:59'
                                        WHEN 17 THEN '17:00:00 as 17:59:59'
                                        WHEN 18 THEN '18:00:00 as 18:59:59'                     
                                        WHEN 19 THEN '19:00:00 as 19:59:59'
                                        WHEN 20 THEN '20:00:00 as 20:59:59'
                                        WHEN 21 THEN '21:00:00 as 21:59:59'
                                        WHEN 22 THEN '22:00:00 as 22:59:59'
                                        WHEN 23 THEN '23:00:00 as 23:59:59'
                                        WHEN 24 THEN '00:00:00 as 00:59:59'
                                        ELSE 'Sem registro'
                                        END as 'Intervalo'
                from contato
                group by Intervalo
                ");
            $response = $result->fetchAll(\PDO::FETCH_ASSOC);       

            if(!empty($response)){
                $i = 0;
                foreach ($response as $key => $value) {
                    if($i == 0){
                        $graph['cols'][$i]['id'] = '';
                        $graph['cols'][$i]['label'] = 'Topping';
                        $graph['cols'][$i]['pattern'] = '';
                        $graph['cols'][$i]['type'] = 'string';    
                    }else if($i == 1){
                        $graph['cols'][$i]['id'] = '';
                        $graph['cols'][$i]['label'] = 'Slices';
                        $graph['cols'][$i]['pattern'] = '';
                        $graph['cols'][$i]['type'] = 'number';
                    }
                    $graph['rows'][$i]['c'][0]['v'] = $value['Intervalo'];
                    $graph['rows'][$i]['c'][0]['f'] = null;
                    $graph['rows'][$i]['c'][1]['v'] = $value['quantidade'];
                    $graph['rows'][$i]['c'][1]['f'] = null;
                    $i++;
                }
                return $graph;
            }else{
                return false;
            }
        }catch(\Exception $e){
            return false;
        }
    }
}
