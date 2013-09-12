<?php
namespace OpenTribes\Core;

class Tile extends Entity{
 
    protected $isWorkable;
    
    public function setWorkable($isWorkable){
        $this->isWorkable = (bool) $isWorkable;
        return $this;
    }

    public function getWorkable(){
        return $this->isWorkable;
    }
}