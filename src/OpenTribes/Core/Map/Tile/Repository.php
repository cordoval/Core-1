<?php
namespace OpenTribes\Core\Map\Tile;
use OpenTribes\Core\Map\Tile as MapTile;
interface Repository{
public function add(MapTile $mapTile);
public function findTileByLocation($x,$y);
}