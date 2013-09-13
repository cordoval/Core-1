<?php

namespace OpenTribes\Core\Map;

use OpenTribes\Core\Entity;
use OpenTribes\Core\Map;
use OpenTribes\Core\Tile as BaseTile;

class Tile extends Entity{
    protected $x;
    protected $y;
    protected $tile;
    protected $map;
    
    public function setMap(Map $map){
        $this->map = $map;
        return $this;
    }
    public function setTile(BaseTile $tile){
        $this->tile = $tile;
        return $this;
    }
    public function setX($x){
        $this->x = $x;
        return $this;
    }
    public function setY($y){
        $this->y = $y;
        return $this;
    }
    public function getMap(){
        return $this->map;
    }
    public function getTile(){
        return $this->tile;
    }
    public function getX(){
        return $this->x;
    }
    public function getY(){
        return $this->y;
    }
}
