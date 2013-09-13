<?php

namespace OpenTribes\Core\User\Activate;

use OpenTribes\Core\Request as BaseRequest;

class Request extends BaseRequest{
    protected $username;
    protected $code;
    protected $rolename;
    public function __construct($username = null,$code = null,$rolename = null) {
       $this->setUsername($username)
               ->setCode($code)
               ->setRolename($rolename);
    }
    public function setRolename($role){
        $this->rolename = $role;
        return $this;
    }

    public function setCode($code){
        $this->code = $code;
        return $this;
    }
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }
    public function getCode(){
        return $this->code;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getRolename(){
        return $this->rolename;
    }
            
}