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
$collection->init_buildings($buildings); 
$collection->init_resources($resources);
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

foreach($playerCity->buildings() as $building){
     //   $building->level(1);
      //  $building->update();
}
foreach($playerCity->resources() as $resource){
        foreach($playerCity->getBuildingsByType($resource->storage()) as $building){
               $building->setValueForResource($resource,200); 
        }
}


$storage = $playerCity->getBuilding('Storage');
$storage->level(20)->update();
/*
$farm    = $player_city->get_building('Farm');

$wood = $player_city->get_resource('Wood');
$stone = $player_city->get_resource('Stone');
$iron = $player_city->get_resource('Iron');
$population = $player_city->get_resource('Population');

$storage->set_value($wood, 100);
$storage->set_value($stone, 100);
$storage->set_value($iron, 100);

$farm->set_value($population,0);

$main = $player_city->get_building('Main');

$main->upgrade();*/

 echo '<pre>'.print_r($storage->costs(),true).'</pre>';
  echo '<pre>'.print_r($storage->capacity(),true).'</pre>';
