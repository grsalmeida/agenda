<?php
namespace Core;

/**
 * Classe que acessa os parametros GET e post Informados
 */
class Request {

 
    private $getParams = [];
    private $requesParams = [];
    
    
    public function __construct($getParams, $requestParams) {
        $this->getParams = is_array($getParams) ? $getParams : [];
        $this->requesParams = is_array($requestParams) ? $requestParams : [];
    }
    
 
    public function all(){
        return array_merge($this->getParams, $this->requesParams);
    }
    
   
    public function getParams(){
        return $this->getParams;
    }
    
    public function requestParams(){
        return $this->requesParams;
    }

    public function redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);

        exit();
    }


    
}
