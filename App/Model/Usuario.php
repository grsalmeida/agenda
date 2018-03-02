<?php 
namespace App\Model;

use Core\Database; 

class Usuario extends Database
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function addUser($params){
		try {            
            if(!isset($_SESSION)){ 
                session_start(); 
            } 
            $this->conexao->beginTransaction();
            if($params['password'] == $params['confirm_password']){
                $query = $this->conexao->prepare('INSERT INTO user (name, email, password) VALUES(:name, :email, :password)');
                $query->execute([
                    ":name" => $params['nome'],
                    ":email" => $params['email'],
                    ":password" => sha1($params['password'])            
                ]);
                $lastId = $this->conexao->lastInsertId();
                $this->conexao->commit();
                $_SESSION['login'] = sha1($params['password']);
                return $lastId;
            }
            $this->conexao->rollback();
            return false;
        } catch (\PDOException $e) {
            $this->conexao->rollback();
            return false;
        }
	}

    public function logar($params){
        if(!isset($_SESSION)){ 
            session_start(); 
        }
        try{
            if(!isset($params['email']) || empty($params['email'])){
                return ['code' => 400, 'message' => 'Email invalido ou vazio'];
            }
            if(!isset($params['password']) || empty($params['password'])){
                return ['code' => 400, 'message' => 'Senha invalida ou vazia'];
            }

            if(!$pass = $this->login($params)){
                return ['code' => 400, 'message' => 'Senha ou email invalidos'];   
            }
            if(isset($pass['code'])){
                return $pass;
            }
            $_SESSION['login'] = sha1($params['password']);
            return true;

        }catch(\Exception $e){
            return ['code' => $e->getCode(), 'message' => $e->getMessage()];
        }
    }

    public function login($params){
        if(!isset($_SESSION)){ 
            session_start(); 
        }
        try{
            $pass = sha1($params['password']);
            $result = $this->conexao->query("
                SELECT * FROM user WHERE email = '{$params['email']}' AND password = '{$pass}'");
            $result = $result->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }catch(\Exception $e){
            return ['code' => $e->getCode(), 'message' => $e->getMessage()];
        }
    }

    public function loggoff(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }
        // Inicializa a sessão.
        // Se estiver sendo usado session_name("something"), não esqueça de usá-lo agora!

        // Apaga todas as variáveis da sessão
        $_SESSION = array();

        // Se é preciso matar a sessão, então os cookies de sessão também devem ser apagados.
        // Nota: Isto destruirá a sessão, e não apenas os dados!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Por último, destrói a sessão
        session_destroy();
        return true;
    }
}
