<?php

namespace OpenTribes\Core\Player;

use OpenTribes\Core\Entity;
use OpenTribes\Core\Role;
use OpenTribes\Core\Player;
class Roles extends Entity{
    protected $roles = array();
    protected $player = array();
    public function setPlayer(Player $player){
        $this->player = $player;
    }

    public function addRole(Role $role){
        $this->roles[$role->getName()] = $role;
    }
    public function removeRole(Role $role){
        if(isset($this->roles[$role->getName()])) unset($this->roles[$role->getName()]);
    }
    public function getRoles(){
        return $this->roles;
    }
    public function hasRole($name){
        if(isset($this->roles[$name])) return true;
        return false;
    }
    public function hasAnyRoles(array $roles){
        return count(array_intersect($this->roles,$roles)) > 0;
    }
}