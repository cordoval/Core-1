<?php

namespace OpenTribes\Core\User\Authenticate;

use OpenTribes\Core\User;
class Response{
    protected $user;
    public function __construct($user = null){
        $this->setUser($user);
      
    }
    public function getUser(){
        return $this->user;
    }
    public function setUser(User $user){
        $this->user = $user;
        return $this;
    }
}