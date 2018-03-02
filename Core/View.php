<?php

namespace Core;

class View {

    private $view;
    private $params;

    
    public function __construct($view, $params = null) {
        $this->view = $view;
        $this->params = $params;
    }

    function getView() {
        return $this->view;
    }

    function getParams() {
        return $this->params;
    }

    function setView($view) {
        $this->view = $view;
    }

    function setParams($params) {
        $this->params = $params;
    }

}
