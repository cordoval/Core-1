<?php
namespace OpenTribes\Core;

use OpenTribes\Core\User;
;class City extends Entity{
    protected $x;
    protected $y;
    protected $owner;
    public function setOwner(User $user){
        $this->owner = $user;
    }

    public function setX($x){
        $this->x = (int)$x;
        return $this;
    }
    public function setY($y){
        $this->y = (int)$y;
        return $this;
    }
    public function getX(){
        return $this->x;
    }
    public function getY(){
        return $this->y;
    }
    public function getOwner(){
        return $this->owner;
    }
}