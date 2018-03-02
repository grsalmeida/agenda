<?php 
namespace App\Controller;

use App\Model\Contato as ContatoModel;
use Core\Controller;
use Core\Request as Request;

class Contato  extends Controller
{
	private $contato;
	
	public function __construct(){
		$this->Contato = new ContatoModel();
	}

	public function cadastro(){
		return $this->view('add');	
	}


	public function listContato(Request $request){
		if(!count($request->all()) || empty($request->all()) ){
			if(!$contato = $this->Contato->listContato()){
				return $this->view('contato');
			}
		
			return $this->view('contato',$contato);
		}
		
		$params = $request->all();
		if(!$contato = $this->Contato->listContato($params)){
			return $this->view('contato');	
		}
		return $this->view('contato',$contato);
	}

	public function addContato(Request $request){
		if(!count($request->all()) || empty($request->all()) ){
			return $this->view('add');
		}	
		$add = $this->Contato->addContato($request->all());
		var_dump($add);
		if(!$add){
			return $this->view('contato');
		}
		if(!$contato = $this->Contato->listContato()){
			return $this->view('contato');
		}
		$request->redirect('/lista', false);
	}

	public function editContato(Request $request){
		if(!count($request->all()) || empty($request->all()) ){
			return json_encode(false);
		}	
		return json_encode($this->Contato->editContato($request->all()));
	}

	public function removeContato(Request $request){
		if(!count($request->all()) || empty($request->all()) ){
			return json_encode(false);
		}	
		return json_encode($this->Contato->removeContato($request->all()));
	}
	public function dashboard(Request $request){
		return $this->view('dashboard');
	}

	public function hour(){
		return json_encode($this->Contato->hour());
	}
}
