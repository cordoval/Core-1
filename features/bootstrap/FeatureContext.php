<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Opentribes\Core\Collection,
    Opentribes\Core\Player,
    Opentribes\Core\City;

//
// Require 3rd-party libraries here:
//   
require_once 'vendor/phpunit/Autoload.php';
require_once 'vendor/phpunit/Framework/Assert/Functions.php';

//
// Custom Autoloading registration
//
require_once 'init.php';
/**
 * Features context.
 */
class FeatureContext extends BehatContext {

        /**
         * Initializes context.
         * Every scenario gets it's own context object.
         *
         * @param array $parameters context parameters (set them up through behat.yml)
         */
        public function __construct(array $parameters)
        {

                // Initialize your context here
        }

        /**
         * @Given /^default configurations$/
         */
        public function defaultConfigurations1()
        {
                $buildings  = includeIfExists('settings/buildings.php');
                $resources  = includeIfExists('settings/resources.php');
                $collection = new Collection();
                $collection->init_buildings($buildings);
                $collection->init_resources($resources);
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
                $this->city = $city;
        }

        /**
         * @Given /^a Player "([^"]*)"$/
         */
        public function aPlayer($arg1)
        {
                $this->player = new Player();
                $this->player->set_name($arg1);
                assertEquals($arg1, $this->player->get_name());
        }

        /**
         * @Given /^a City "([^"]*)"$/
         */
        public function aCity($arg1)
        {
                $city              = clone $this->city;
                $city->set_name($arg1);
                $this->cloned_city = $city;
                assertEquals($arg1, $city->get_name());
        }

        /**
         * @Given /^the City belongs to Player$/
         */
        public function theCityBelongsToPlayer()
        {
                $this->player->add_city($this->cloned_city);
              
        }

        /**
         * @Given /^following Resources in the City$/
         */
        public function followingResourcesInTheCity(TableNode $table)
        {
                $city = $this->player->get_city($this->cloned_city);
                foreach ($table->getRows() as $row)
                {
                        $resource_name  = $row[0];
                        $resource_value = $row[1];

                        $resource = $city->get_resource($resource_name);
                        $type     = $resource->get_storage();

                        foreach ($city->get_buildings_by_type($type) as $building)
                        {
                                $building->add_resource($resource);
                                $building->set_value($resource, $resource_value);

                                assertEquals($resource_name, $resource->get_name());
                                assertEquals($resource_value, $resource->get_value());
                        }
                }
        }

        /**
         * @Given /^City has Consumer Resources$/
         */
        public function cityHasConsumerResources(TableNode $table)
        {
                $city = $this->player->get_city($this->cloned_city);
                foreach ($table->getRows() as $row)
                {
                        $resource_name  = $row[0];
                        $resource_value = $row[1];

                        $resource = $city->get_resource($resource_name);
                        $type     = $resource->get_storage();

                        foreach ($city->get_buildings_by_type($type) as $building)
                        {
                                $building->add_resource($resource);
                                $building->set_value($resource, $resource_value);
                                assertEquals($resource_name, $resource->get_name());
                                assertEquals($resource_value, $resource->get_value());
                        }
                }
        }

        /**
         * @When /^i start upgraid following buildings$/
         */
        public function iStartUpgraidFollowingBuildings(TableNode $table)
        {
                $city = $this->player->get_city($this->cloned_city);
                foreach ($table->getRows() as $row)
                {
                        $building_name = $row[0];
                        $building      = $city->get_building($building_name);
                        $building->upgrade();
                       // echo var_dump($building->can_upgrade());
                }
        }

        /**
         * @Given /^upgrade of building costs following Resources$/
         */
        public function upgradeOfBuildingCostsFollowingResources(TableNode $table)
        {
                $city = $this->player->get_city($this->cloned_city);
                foreach ($table->getRows() as $row)
                {
                        $building_name  = $row[0];
                        $resource_name  = $row[1];
                        $resource_value = $row[2];

                        $building = $city->get_building($building_name);
                        $costs    = $building->get_costs($resource_name);


                        assertEquals($resource_value, $costs);
                }
        }

        /**
         * @Given /^upgrade of the building require$/
         */
        public function upgradeOfTheBuildingRequire(TableNode $table)
        {
                $city = $this->player->get_city($this->cloned_city);
                foreach ($table->getRows() as $row)
                {
                        $building_name  = $row[0];
                        $resource_name  = $row[1];
                        $resource_value = $row[2];

                        $building = $city->get_building($building_name);
                        $costs    = $building->get_consumptions($resource_name);


                        assertEquals($resource_value, $costs);
                }
        }

        /**
         * @Then /^i should have following buildings in Building Queue$/
         */
        public function iShouldHaveFollowingBuildingsInBuildingQueue(TableNode $table)
        {
                $city = $this->player->get_city($this->cloned_city);
                foreach ($table->getRows() as $row)
                {
                        $building_name = $row[0];
                        foreach ($city->get_queue() as $building)
                        {
                                // if($building_name == $building->get_name()) break;
                        }
                }
        }

        /**
         * @Given /^i should have following resources$/
         */
        public function iShouldHaveFollowingResources(TableNode $table)
        {
                $city = $this->player->get_city($this->cloned_city);
                foreach ($table->getRows() as $row)
                {
                        $resource_name  = $row[0];
                        $resource_value = $row[1];
                        $resource       = $city->get_resource($resource_name);
                        assertEquals($resource_name, $resource->get_name());
                        assertEquals($resource_value, $resource->get_value());
                }
        }

        /**
         * @Given /^i should have following consumer resources$/
         */
        public function iShouldHaveFollowingConsumerResources(TableNode $table)
        {
                $city = $this->player->get_city($this->cloned_city);
                foreach ($table->getRows() as $row)
                {
                        $resource_name  = $row[0];
                        $resource_value = $row[1];
                        $resource       = $city->get_consumptions($resource_name);
                        assertEquals($resource_name, $resource->get_name());
                        assertEquals($resource_value, $resource->get_value());
                }
        }

}
