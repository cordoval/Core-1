<?php

use OpenTribes\Core\Tile\Mock\Repository as TileRepository;
use OpenTribes\Core\Entity\Factory as EntityFactory;
use OpenTribes\Core\Tile;
use OpenTribes\Core\Map\Tile\Mock\Repository as MapTileRepository;
use OpenTribes\Core\Map;
use OpenTribes\Core\Map\Tile as MapTile;
use OpenTribes\Core\Map\Mock\Repository as MapRepository;
class MapHelper {

    protected $tileRepository;
    protected $mapTileRepository;
    protected $mapRepository;

    public function __construct() {
        $this->tileRepository = new TileRepository();
        $this->mapTileRepository = new MapTileRepository();
        $this->mapRepository = new MapRepository();
    }

    public function createTiles(array $tiles) {
        $factory = new EntityFactory(new Tile());
        foreach ($tiles as $tile) {
            $this->tileRepository->add($factory->createFromArray($tile));
        }
    }

    public function createMapWithTiles($mapname, array $tiles) {
        unset($tiles['y/x']); //remove caption;
        $map = new Map();
        
        $map->setName($mapname);
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
                        ->setTile($tileEntity)
                        ->setMap($map);

                $this->mapTileRepository->add($mapTile);
            }
        }
        $this->mapRepository->add($map);
    }

}
