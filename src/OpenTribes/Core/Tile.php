<?php
namespace OpenTribes\Core;

class Tile extends Entity{
    protected $x;
    protected $y;
    protected $isBuildable;
    
    public function setBuildable($isBuildable){
        $this->isBuildable = (bool) $isBuildable;
        return $this;
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
    public function getBuildable(){
        return $this->isBuildable;
    }
}