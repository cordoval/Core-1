<?php

namespace OpenTribes\Core\Player\Mock;

use OpenTribes\Core\Player\Repository as PlayerRepositoryInterface;
use OpenTribes\Core\Player\Factory as PlayerFactory;
use OpenTribes\Core\Player;

class Repository implements PlayerRepositoryInterface {

    private $data = array();
    private $factory;
    public function create() {
        return $this->factory->create();
    }
    public function __construct(PlayerFactory $playerFactory) {
        $this->factory = $playerFactory;
    
    }

    public function save(Player $player) {
        $this->data[$player->getId()] = $player->asArray();
       
     
    }

    public function findById($id) {
        return isset($this->data[$id]) ? $this->data[$id] : false;
    }
   public function findByUsername($username) {
        
        foreach ($this->data as $player) {
            if ($player['username'] == $username) {
                return $this->factory->createFromArray($player);
            }
        }
      
    }
    public function findByEmail($email) {
        foreach ($this->data as $player) {
            if ($player['email']== $email) {
                return $this->factory->createFromArray($player);
            }
        }
    }
    public function findByName($name) {
    
        foreach ($this->data as $player) {
            if ($player['name'] == $name) {
                return  $this->factory->createFromArray($player);
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

