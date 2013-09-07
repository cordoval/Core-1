<?php

namespace OpenTribes\Core\Role\Mock;

use OpenTribes\Core\Role\Repository as RoleRepositoryInterface;
use OpenTribes\Core\Role;
class Repository implements RoleRepositoryInterface{
    private $data = array();
    public function findByName($name) {
       if(isset($this->data[$name])) return $this->data[$name];
       return null;
    }
    public function save(Role $role) {
        $this->data[$role->getName()] = $role;
    }
}