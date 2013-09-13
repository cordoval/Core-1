<?php

namespace OpenTribes\Core\User\ActivationMail\Send;

class Response{
    protected $result;
    public function __construct($result = null) {
        $this->setResult($result);
    }
    public function setResult($result){
        $this->result = $result;
        return $this;
    }
    public function getResult(){
        return $this->result;
    }
            
}