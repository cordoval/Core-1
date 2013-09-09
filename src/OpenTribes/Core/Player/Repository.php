<?php

namespace OpenTribes\Core\Player;

use OpenTribes\Core\Player;
use OpenTribes\Core\Player\Factory as PlayerFactory;
interface Repository {
    public function __construct(PlayerFactory $playerFactory);

    public function findByName($name);
    public function findByUsername($username);
    public function findByEmail($email);
    public function findById($id);

    public function save(Player $player);
    public function create();

    public function findAll($offset = 0, $length = 0);
}