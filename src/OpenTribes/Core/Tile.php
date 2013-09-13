<?php
namespace OpenTribes\Core;

class Tile extends Entity{
 
    protected $accessable;
    
    public function setAccessable($accessable){
        $this->accessable = (bool) $accessable;
        return $this;
    }

    public function getAccessable(){
        return $this->accessable;
    }
}