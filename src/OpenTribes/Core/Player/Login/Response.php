<?php

namespace OpenTribes\Core\Player\Login;
use OpenTribes\Core\Player;
class Response{
    private $player;
    public function __construct(Player $player){
        $this->setPlayer($player);
        return $this;
    }
    public function setPlayer(Player $player){
        $this->player = $player;
        return $this;
    }
    public function getPlayer(){
        return $this->player;
    }
}
