<?php

use OpenTribes\Core\Tile;
use OpenTribes\Core\City;
use OpenTribes\Core\Map;
use OpenTribes\Core\Map\Tile as MapTile;
use OpenTribes\Core\Tile\Mock\Repository as TileRepository;
use OpenTribes\Core\Entity\Factory as EntityFactory;
require_once 'vendor/phpunit/phpunit/PHPUnit/Framework/Assert/Functions.php';

class CityHelper {
    protected $map;
    protected $tileRepository;
  
    public function __construct(){
       
        $this->tileRepository = new TileRepository(new EntityFactory(new Tile()));
    }
    public function createTiles(array $tiles){
        $factory = new EntityFactory(new Tile());
        foreach($tiles as $tile){
            $this->tileRepository->add($factory->createFromArray($tile));
        }
     //   print_r($this->tileRepository);
    }

    public function createMapWithTiles($mapname,array $tiles) {
        unset($tiles['y/x']); //remove caption;
        $this->map = new Map();
        $this->map->setName($mapname);
        $id = 0;
        foreach ($tiles as $y => $tiles) {
            foreach ($tiles as $x => $tile) {
                $id++;
                $tileEntity = new Tile();
          
                       $tileEntity->setName($tile)
                        ->setId($id);
                 $mapTile = new MapTile();
                 $mapTile->setX($x)
                         ->setY($y)
                         ->setTile($tileEntity);
                        
                 $this->map->addTile($mapTile);
            }
        }
      
    }
    public function createCities(array $cities){
        foreach($cities as $city){
            $cityEntity = new City();
            $cityEntity->setX($city['x']);
            $cityEntity->setY($city['y']);
            
        }
    }
}