<?php

namespace OpenTribes\Core\User\Mock;

use OpenTribes\Core\User\Repository as UserRepositoryInterface;
use OpenTribes\Core\User;

class Repository implements UserRepositoryInterface {

    private $data = array();

    public function create() {
        return new User();
    }

    public function save() {
        
    }

    public function add(User $user) {
        $this->data[$user->getId()] = $user;
    }

    public function findById($id) {
        return isset($this->data[$id]) ? $this->data[$id] : null;
    }

    public function findByUsername($username) {
        foreach ($this->data as $user) {
            if ($user->getUsername() === $username) {
                return $user;
            }
        }
        return null;
    }

    public function findByEmail($email) {
        foreach ($this->data as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
    }

    public function findByName($name) {

        foreach ($this->data as $user) {
            if ($user->getName() == $name) {
                return $user;
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

