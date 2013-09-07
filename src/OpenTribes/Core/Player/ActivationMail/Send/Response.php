<?php

namespace OpenTribes\Core\Player\ActivationMail\Send;

class Response{
    protected $_result;
    public function __construct($result = null) {
        $this->setResult($result);
    }
    public function setResult($result){
        $this->_result = $result;
        return $this;
    }
    public function getResult(){
        return $this->_result;
    }
            
}