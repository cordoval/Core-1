<?php

namespace OpenTribes\Core\User;

use OpenTribes\Core\Entity;
use OpenTribes\Core\Role;
use OpenTribes\Core\User;
class Roles extends Entity{
    protected $roles = array();
    protected $user;
    public function setUser(User $user){
        $this->user = $user;
        return $this;
    }

    public function addRole(Role $role){
        $this->roles[$role->getId()] = $role;
        return $this;
    }
    public function removeRole(Role $role){
        if(isset($this->roles[$role->getId()])) unset($this->roles[$role->getId()]);
    }
    public function getRoles(){
        return $this->roles;
    }
    public function getUser(){
        return $this->user;
    }

    public function hasRole($name){
        foreach($this->roles as $role){
            if($role->getName() === $name) return true;
        }
        return false;
    }
    public function hasAnyRoles(array $roles){
        return count(array_intersect($this->roles,$roles)) > 0;
    }
}