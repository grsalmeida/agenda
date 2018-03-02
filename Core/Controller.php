<?php

namespace Core;
/*
Clase de abstraçoa da controler
*/
abstract class Controller {

    protected function view($view, $params = []) {
        return new View($view, $params);
    }

}
