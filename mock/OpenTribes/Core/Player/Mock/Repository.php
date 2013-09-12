<?php

namespace OpenTribes\Core\Player\Mock;

use OpenTribes\Core\Player\Repository as PlayerRepositoryInterface;
use OpenTribes\Core\Player;

class Repository implements PlayerRepositoryInterface {

    private $data = array();

    public function create() {
        return new Player();
    }

    public function save() {
        
    }

    public function add(Player $player) {
        $this->data[$player->getId()] = $player;
    }

    public function findById($id) {
        return isset($this->data[$id]) ? $this->data[$id] : null;
    }

    public function findByUsername($username) {
        foreach ($this->data as $player) {
            if ($player->getUsername() === $username) {
                return $player;
            }
        }
        return null;
    }

    public function findByEmail($email) {
        foreach ($this->data as $player) {
            if ($player->getEmail() === $email) {
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
        return null;
    }

    public function findAll($offset = 0, $length = null) {
        if ($length)
            $length = count($this->data) - 1;

        $data = array_slice($this->data, $offset, $length, TRUE);
        return $data;
    }

}

