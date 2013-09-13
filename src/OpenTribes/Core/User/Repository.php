<?php

namespace OpenTribes\Core\User;

use OpenTribes\Core\User;

interface Repository {


    public function findByName($name);
    public function findByUsername($username);
    public function findByEmail($email);
    public function findById($id);
    public function add(User $player);
    public function save();

    public function create();

    public function findAll($offset = 0, $length = 0);
}