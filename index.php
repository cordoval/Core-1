<?php
include 'init.php';

session_start();

$buildings = include 'settings/buildings.php';
$resources = include 'settings/resources.php';

use Opentribes\Core\Collection,
    Opentribes\Core\Player,
    Opentribes\Core\City;

//Init Objects



$player = new Player();
$player->set_name('BlackScorp');

if (!isset($_SESSION['base_city']))
{
        //hier kommt die collections und add buildings etc rein
        // $_SESSION['base_city'] = serialize($city);
}
else
{
        $city       = unserialize($_SESSION['base_city']);
}
$collection = new Collection();
$collection->init_buildings($buildings);
$collection->init_resources($resources);
//create default city with configs;
$city       = new City();
foreach ($collection->get(Collection::BUILDINGS) as $building)
{
        $city->add_building(clone $building);
}
foreach ($collection->get(Collection::RESOURCES) as $resource)
{
        foreach ($city->get_buildings_by_type($resource->get_storage()) as $building)
        {
                $building->add_resource(clone $resource);
        }
}


$player_city = clone $city;
$player_city->set_name('Village');
$player->add_city($player_city);
/*
$storage = $player_city->get_building('Storage');
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

echo '<pre>'.print_r($player_city,true).'</pre>';
