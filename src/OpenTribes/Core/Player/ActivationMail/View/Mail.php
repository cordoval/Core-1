<?php

namespace OpenTribes\Core\Player\ActivationMail\View;

use OpenTribes\Core\Player;
class Mail{

    protected $player;
    public function __construct(Player $player) {
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
