<?php

namespace OpenTribes\Core\Player\Activate;
use OpenTribes\Core\Player;
class Response{
    protected $_player;
    public function setPlayer(Player $player){
        $this->_player = $player;
        return $this;
    }
    public function getPlayer(){
        return $this->_player;
    }
    public function __construct($player = null) {
        $this->setPlayer($player);
    }
   
}
