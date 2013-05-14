<?php
namespace Opentribes\Core\Player;

interface Repository {

        abstract public function __constrctuct(Player $building = null);

        abstract public function findById();

        abstract public function findAll();

        abstract public function findByName($name);
        
        abstract public function findAllCities();
        
        abstract public function save(Player $building);
        
        abstract public function saveCity(City $city);
        
}