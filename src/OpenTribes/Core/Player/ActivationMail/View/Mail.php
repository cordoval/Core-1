<?php

namespace OpenTribes\Core\Player\ActivationMail\View;

use OpenTribes\Core\Player;
class Mail{

    protected $_player;
    public function __construct(Player $player) {
        $this->setPlayer($player);
    }
    public function getPlayer(){
        return $this->_player;
    }
    public function setPlayer(Player $player){
        $this->_player = $player;
        return $this;
    }
}
