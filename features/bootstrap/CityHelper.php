<?php

use OpenTribes\Core\Tile;
use OpenTribes\Core\City;
use OpenTribes\Core\Map;
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
            $this->tileRepository->save($factory->createFromArray($tile));
        }
        print_r($this->tileRepository);
    }

    public function createMapWithTiles($mapname,array $tiles) {
        unset($tiles['y/x']); //remove caption;
        $this->map = new Map();
        $id = 0;
        foreach ($tiles as $y => $tiles) {
            foreach ($tiles as $x => $tile) {
                $id++;
                $tileEntity = new Tile();
                $tileEntity->setX($x)
                        ->setY($y)
                        ->setName($tile)
                        ->setId($id);
                 $this->map->addTile($tileEntity);
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