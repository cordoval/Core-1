<?php

namespace OpenTribes\Core\User\Roles\Mock;
use OpenTribes\Core\User\Roles\Repository as RolesRepositoryInterface;
use OpenTribes\Core\User\Roles as UserRoles;

class Repository implements RolesRepositoryInterface{
    private $data = array();
    public function findByUserId($id){
        $found = array();
        foreach($this->data as $i => $data){
            foreach($data[0] as $user){
                if($user->getId() === $id) $found[]=$this->data[$i];
            }
        }
        return $found;
    }
    public function add(UserRoles $userRoles) {
        $this->data[]=$userRoles;
        return $this;
    }
  
    public function save() {
        ;
    }
}