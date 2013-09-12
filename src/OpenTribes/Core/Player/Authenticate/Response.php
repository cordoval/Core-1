<?php

namespace OpenTribes\Core\Player\Authenticate;

use OpenTribes\Core\Player;
class Response{
    protected $player;
    public function __construct($player = null){
        $this->setPlayer($player);
      
    }
    public function getPlayer(){
        return $this->player;
    }
    public function setPlayer(Player $player){
        $this->player = $player;
        return $this;
    }
}