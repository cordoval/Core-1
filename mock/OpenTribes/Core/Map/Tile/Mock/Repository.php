<?php

namespace OpenTribes\Core\Map\Tile\Mock;
use OpenTribes\Core\Map\Tile\Repository as TileRepositoryInterface;
use OpenTribes\Core\Map\Tile as MapTile;
class Repository implements TileRepositoryInterface{
    private $data;
    public function add(MapTile $mapTile) {
        $this->data[]=$mapTile;
    }
    public function findTileByLocation($x, $y) {
        foreach($this->data as $mapTile){
            $tile = $mapTile->getTile();
            if($tile->getX() == $x && $tile->getY() == $y){
                return $tile;
            }
        }
        return null;
    }
}