<?php 
namespace App\Controller;

use App\Model\Usuario as UsuarioModel;
use App\Model\Contato as ContatoModel;
use Core\Controller;
use Core\Request as Request;

class Usuario  extends Controller
{
	private $user;
	private $cont;
	
	public function __construct(){
		$this->user = new UsuarioModel();
		$this->cont = new ContatoModel();
	}

	public function login(){
		return $this->view('login');
	}

	public function logar(Request $request){
		if(!isset($_SESSION)){ 
            session_start(); 
        }
		$data = $request->all();
		if(!count($request->all()) || empty($request->all()) ){
			return $this->view('login',['code' => "400", "message" => "senha ou email não preenchidos ou incorretos!"]);
		}	
		if(isset($_SESSION['login']) && $_SESSION['login'] == sha1($data['password'])){
			$request->redirect('/lista', false);
		}
		if(!$user = $this->user->logar($request->all())){
			return $this->view('login',['code' => "400", "message" => "senha ou email não incorretos!"]);
		}
		if(isset($user['code']) && $user['code'] != 200){
			return $this->view('login',['code' => "400", "message" => "senha ou email não incorretos!"]);	
		}
		$request->redirect('/lista', false);
	}

	public function addUser(Request $request){
		if(!count($request->all()) || empty($request->all()) ){
			return $this->view('login',['code' => "400", "message" => "dados incorretos!"]);
		}	
		$user = $this->user->addUser($request->all());
		if(isset($user['code']) && $user['code'] == 400 || !$user){
			return $this->view('login',['code' => "400", "message" => "dados incorretos!"]);
		}
		$request->redirect('/lista', false);
	}

	public function loggoff(){
		$this->user->loggoff();
		return $this->view('login');
	}
}
