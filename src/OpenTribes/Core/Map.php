<?php

namespace OpenTribes\Core;

use OpenTribes\Core\Map\Tile as MapTile;
use OpenTribes\Core\City;
class Map extends Entity{
    protected $tiles = array();
    protected $cities = array();
    public function addTile(MapTile $tile){ 
        $this->tiles[] = $tile;
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