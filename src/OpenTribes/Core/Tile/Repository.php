<?php
namespace OpenTribes\Core\Tile;
use OpenTribes\Core\Entity\Factory;
use OpenTribes\Core\Tile;
interface Repository{
    public function __construct(Factory $factory);
    public function findById($id);
    public function findByName($name);
    public function save(Tile $tile);
    public function create();
}