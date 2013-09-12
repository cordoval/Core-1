<?php

namespace OpenTribes\Core\Player\Authenticate;

use OpenTribes\Core\Player;
class Request{
    protected $rolename;
    protected $player;
    
    public function __construct($player = null,$rolename=null ) {
        $this->setPlayer($player)
                ->setRoleName($rolename);
    }
    public function setPlayer(Player $player){
        $this->player = $player;
        return $this;
    }
    public function setRoleName($rolename){
        $this->rolename = $rolename;
        return $this;
    }
    public function getPlayer(){
        return $this->player;
    }
    public function getRoleName(){
        return $this->rolename;
    }
}