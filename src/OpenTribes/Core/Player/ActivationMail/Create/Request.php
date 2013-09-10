<?php

namespace OpenTribes\Core\Player\ActivationMail\Create;
use OpenTribes\Core\Player;
class Request{
    protected $player;
    public function __construct(Player $player) {
        $this->setPlayer($player);
    }
    public function setPlayer(Player $player){
        $this->player = $player;
        return $this;
    }
    public function getPlayer(){
        return $this->player;
    }
}
