<?php

namespace OpenTribes\Core\User\Login;
use OpenTribes\Core\User;
class Response{
    protected $user;
    public function __construct(User $player){
        $this->setUser($player);
       
    }
    public function setUser(User $user){
        $this->user = $user;
        return $this;
    }
    public function getUser(){
        return $this->user;
    }
}
