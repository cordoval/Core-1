<?php

namespace OpenTribes\Core\Player\Mock;

use OpenTribes\Core\Player\Repository as PlayerRepositoryInterface;
use OpenTribes\Core\Player\Factory as PlayerFactory;
use OpenTribes\Core\Player;

class Repository implements PlayerRepositoryInterface {

    private $data = array();

    public function __construct() {
        
    
    }

    public function save(Player $player) {
        $this->data[$player->getId()] = $player;
     
    }

    public function findById($id) {
        return isset($this->data[$id]) ? $this->data[$id] : false;
    }
   public function findByUsername($username) {
    
        foreach ($this->data as $player) {
            if ($player->getUsername() == $username) {
                return $player;
            }
        }
      
    }
    public function findByEmail($email) {
        foreach ($this->data as $player) {
            if ($player->getEmail() == $email) {
                return $player;
            }
        }
    }
    public function findByName($name) {
    
        foreach ($this->data as $player) {
            if ($player->getName() == $name) {
                return $player;
            }
        }
      
    }
    public function findAll($offset = null, $length = null) {
        $data = $this->data;
    
        if($length)
        array_splice($data,$offset,$length);

        
        return $data;
    }
}

