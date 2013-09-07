<?php

namespace OpenTribes\Core\Player\Activate;

use OpenTribes\Core\Role;
class Request{
    protected $_username;
    protected $_code;
    protected $_role;
    public function __construct($username = null,$code = null,$role = null) {
       $this->setUsername($username)
               ->setCode($code)
               ->setRole($role);
    }
    public function setRole(Role $role){
        $this->_role = $role;
        return $this;
    }

    public function setCode($code){
        $this->_code = $code;
        return $this;
    }
    public function setUsername($username){
        $this->_username = $username;
        return $this;
    }
    public function getCode(){
        return $this->_code;
    }
    public function getUsername(){
        return $this->_username;
    }
    public function getRole(){
        return $this->_role;
    }
            
}