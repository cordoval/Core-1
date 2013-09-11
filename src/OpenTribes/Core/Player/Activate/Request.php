<?php

namespace OpenTribes\Core\Player\Activate;

use OpenTribes\Core\Request as BaseRequest;
use OpenTribes\Core\Role;
class Request extends BaseRequest{
    protected $username;
    protected $code;
    protected $role;
    public function __construct($username = null,$code = null,$role = null) {
       $this->setUsername($username)
               ->setCode($code)
               ->setRole($role);
    }
    public function setRole(Role $role){
        $this->role = $role;
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
    public function getRole(){
        return $this->role;
    }
            
}