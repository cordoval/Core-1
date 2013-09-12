<?php

namespace OpenTribes\Core\Player\Roles\Mock;
use OpenTribes\Core\Player\Roles\Repository as RolesRepositoryInterface;
use OpenTribes\Core\Player\Roles as PlayerRoles;

class Repository implements RolesRepositoryInterface{
    private $data = array();
    public function findByPlayerId($id){
        $found = array();
        foreach($this->data as $i => $data){
            foreach($data[0] as $player){
                if($player->getId() === $id) $found[]=$this->data[$i];
            }
        }
        return $found;
    }
    public function add(PlayerRoles $playerRoles) {
        $this->data[]=$playerRoles;
        return $this;
    }
  
    public function save() {
        ;
    }
}