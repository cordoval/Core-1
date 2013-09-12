<?php

namespace OpenTribes\Core\Player;

use OpenTribes\Core\Player;

interface Repository {


    public function findByName($name);
    public function findByUsername($username);
    public function findByEmail($email);
    public function findById($id);
    public function add(Player $player);
    public function save();

    public function create();

    public function findAll($offset = 0, $length = 0);
}