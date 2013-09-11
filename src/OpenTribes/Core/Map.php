<?php

namespace OpenTribes\Core;

use OpenTribes\Core\Tile;
use OpenTribes\Core\City;
class Map extends Entity{
    protected $tiles = array();
    protected $cities = array();
    public function addTile(Tile $tile){
        if(!isset($this->tiles[$tile->getY()][$tile->getX()]))
            $this->tiles[$tile->getY()] = array();
        
        $this->tiles[$tile->getY()][$tile->getX()] = $tile;
        
    }
    public function addCity(City $city){
            if(!isset($this->cities[$city->getY()][$city->getX()]))
            $this->cities[$city->getY()] = array();
        
        $this->cities[$city->getY()][$city->getX()] = $city;
    }
    public function getCities(){
        return $this->cities;
    }

    public function getTiles(){
        return $this->tiles;
    }
   
}