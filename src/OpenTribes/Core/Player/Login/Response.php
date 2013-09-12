<?php

namespace OpenTribes\Core\Player\Login;
use OpenTribes\Core\Player;
class Response{
    protected $player;
    public function __construct(Player $player){
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
