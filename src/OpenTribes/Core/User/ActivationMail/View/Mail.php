<?php

namespace OpenTribes\Core\User\ActivationMail\View;

use OpenTribes\Core\User;
class Mail{

    protected $user;
    public function __construct(User $user) {
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
