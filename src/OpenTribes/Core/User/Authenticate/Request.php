<?php

namespace OpenTribes\Core\User\Authenticate;

use OpenTribes\Core\User;
class Request{
    protected $rolename;
    protected $user;
    
    public function __construct($user = null,$rolename=null ) {
        $this->setUser($user)
                ->setRoleName($rolename);
    }
    public function setUser(User $user){
        $this->user = $user;
        return $this;
    }
    public function setRoleName($rolename){
        $this->rolename = $rolename;
        return $this;
    }
    public function getUser(){
        return $this->user;
    }
    public function getRoleName(){
        return $this->rolename;
    }
}