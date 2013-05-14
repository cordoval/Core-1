<?php
namespace Opentribes\Core\Building;

interface Repository {

        abstract public function __constrctuct(Building $building = null);

        abstract public function findById();

        abstract public function findAll();

        abstract public function findByName();

        abstract public function save(Building $building);
}