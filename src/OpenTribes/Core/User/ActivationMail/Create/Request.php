<?php

namespace OpenTribes\Core\User\ActivationMail\Create;
use OpenTribes\Core\User;
class Request{
    protected $player;
    public function __construct(User $player) {
        $this->setUser($player);
    }
    public function setUser(User $player){
        $this->player = $player;
        return $this;
    }
    public function getUser(){
        return $this->player;
    }
}
