<?php

namespace OpenTribes\Core\Role\Mock;

use OpenTribes\Core\Role\Repository as RoleRepositoryInterface;
use OpenTribes\Core\Role;
class Repository implements RoleRepositoryInterface{
    private $data = array();
  
    public function findById($id) {
         if(isset($this->data[$id])) return $this->data[$id];
       return null;
    }
    public function findByName($name) {
        foreach($this->data as $role){
            if($role->getName() === $name) return $role;
        }
       return null;
    }
    public function add(Role $role) {
        $this->data[$role->getId()] = $role;
    }
}