<?php

namespace OpenTribes\Core\Player\Mock;

use OpenTribes\Core\Player\Repository as PlayerRepositoryInterface;
use OpenTribes\Core\Entity\Factory as EntityFactory;
use OpenTribes\Core\Player;

class Repository implements PlayerRepositoryInterface {

    private $data = array();
    private $factory;
    public function create() {
        return $this->factory->create();
    }
    public function __construct(EntityFactory $playerFactory) {
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
            if ($player['email'] == $email) {
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
    public function findAll($offset = 0, $length = null) {
     
    
        if($length)
        $length = count($this->data);
        $data = array_slice($this->data,$offset,$length,TRUE);

        
        return $data;
    }
}

