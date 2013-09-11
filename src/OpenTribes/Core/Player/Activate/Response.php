<?php

namespace OpenTribes\Core\Player\Activate;
use OpenTribes\Core\Player;
use OpenTribes\Core\Response as BaseResponse;
class Response extends BaseResponse{
    protected $player;
    public function setPlayer(Player $player){
        $this->player = $player;
        return $this;
    }
    public function getPlayer(){
        return $this->player;
    }
    public function __construct($player = null) {
        $this->setPlayer($player);
    }
   
}
