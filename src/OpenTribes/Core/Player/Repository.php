<?php

namespace OpenTribes\Core\Player;

use OpenTribes\Core\Player;
use OpenTribes\Core\Entity\Factory as Factory;
interface Repository {
    public function __construct(Factory $playerFactory);

    public function findByName($name);
    public function findByUsername($username);
    public function findByEmail($email);
    public function findById($id);

    public function save(Player $player);
    public function create();

    public function findAll($offset = 0, $length = 0);
}