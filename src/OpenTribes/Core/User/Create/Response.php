<?php

namespace OpenTribes\Core\User\Create;
use OpenTribes\Core\User;
class Response{
    private $user;
    public function __construct(User $user){
        $this->setUser($user);
        return $this;
    }
    public function setUser(User $user){
        $this->user = $user;
        return $this;
    }
    public function getUser(){
        return $this->user;
    }
}
