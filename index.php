<?php
include 'init.php';

session_start();

$buildings = include 'settings/buildings.php';
$resources = include 'settings/resources.php';

use Opentribes\Core\Collection,
    Opentribes\Core\Player,
    Opentribes\Core\City;

//Init Objects
//Configs
$collection = new Collection();
$collection->initBuildings($buildings);
$collection->initResources($resources);
//create default city with configs;
$city       = new City();
foreach ($collection->get(Collection::BUILDINGS) as $building)
{
        $city->addBuilding(clone $building);
}
foreach ($collection->get(Collection::RESOURCES) as $resource)
{
        foreach ($city->getBuildingsByType($resource->storage()) as $building)
        {
                $building->addResource(clone $resource);
        }
}
//data from DB
$player = new Player();
$player->name('BlackScorp');

$playerCity = clone $city;
$playerCity->name('Village');

$player->addCity($playerCity);

foreach ($playerCity->buildings() as $building)
{
        //   $building->level(1);
        //  $building->update();
}
foreach ($playerCity->resources() as $resource)
{
        foreach ($playerCity->getBuildingsByType($resource->storage()) as $building)
        {
                $building->setValueForResource($resource, 200);
        }
}


$storage = $playerCity->getBuilding('Storage');
  $main = $playerCity->getBuilding('Main');
    $farm    = $playerCity->getBuilding('Farm');
    $woodBuilding = $playerCity->getBuilding('Wood');



  $wood = $playerCity->getResource('Wood');
  $stone = $playerCity->getResource('Stone');
  $iron = $playerCity->getResource('Iron');
  $population = $playerCity->getResource('Population');

  
  $storage->setValueForResource($wood, 100);
  $storage->setValueForResource($stone, 100);
  $storage->setValueForResource($iron, 100);

  $farm->setValueForResource($population,240);
  
$storage->level(1);

$main->level(2);
$woodBuilding->level(2);

 echo '<pre>'.print_r($playerCity,true).'</pre>';

?>
