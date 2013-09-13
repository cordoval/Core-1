<?php

namespace OpenTribes\Core\User\Activate;
use OpenTribes\Core\User;
use OpenTribes\Core\Response as BaseResponse;
class Response extends BaseResponse{
    protected $user;
    public function setUser(User $user){
        $this->user = $user;
        return $this;
    }
    public function getUser(){
        return $this->user;
    }
    public function __construct($user = null) {
        $this->setUser($user);
    }
   
}
