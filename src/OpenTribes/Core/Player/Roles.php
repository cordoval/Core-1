<?php

namespace OpenTribes\Core\Player;

use OpenTribes\Core\Entity;
use OpenTribes\Core\Role;
use OpenTribes\COre\Player;
class Roles extends Entity{
    protected $_roles = array();
    protected $_player = array();
    public function setPlayer(Player $player){
        $this->_player = $player;
    }

    public function addRole(Role $role){
        $this->_roles[$role->getName()] = $role;
    }
    public function removeRole(Role $role){
        if(isset($this->_roles[$role->getName()])) unset($this->_roles[$role->getName()]);
    }
    public function getRoles(){
        return $this->_roles;
    }
    public function hasRole($name){
        if(isset($this->_roles[$name])) return true;
        return false;
    }
    public function hasAnyRoles(array $roles){
        return count(array_intersect($this->_roles,$roles)) > 0;
    }
}