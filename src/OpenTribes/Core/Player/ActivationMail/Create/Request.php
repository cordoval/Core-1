<?php

namespace OpenTribes\Core\Player\ActivationMail\Create;
use OpenTribes\Core\Player;
class Request{
    protected $_player;
    public function __construct(Player $player) {
        $this->setPlayer($player);
    }
    public function setPlayer(Player $player){
        $this->_player = $player;
        return $this;
    }
    public function getPlayer(){
        return $this->_player;
    }
}
