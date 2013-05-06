<?php
namespace Opentribes\Core;

class City extends Object {

        protected $buildings = array();

        protected $buildingTypes = array();

        protected $resourceTypes = array();

        protected $resources = array();

        protected $owner = NULL;

        protected $queue = array();

        public function addBuilding(Building $building)
        {
                $building->assignCity($this);
                $this->buildings[$building->name()] = $building;
                if (!isset($this->buildingTypes[$building->type()]))
                {
                        $this->buildingTypes[$building->type()] = array();
                }

                $this->buildingTypes[$building->type()][] = $building->name();
        }

        public function addResource(Resource $resource)
        {
                $this->resources[$resource->name()] = $resource;
                if (!isset($this->resourceTypes[$resource->type()]))
                {
                        $this->resourceTypes[$resource->type()] = array();
                }

                $this->resourceTypes[$resource->type()][] = $resource->name();
        }

        public function owner(Player $player = null)
        {
                if($player){
                           $this->owner = $player;
                           return $this;
                }
                return $this->player;
        }

    
        public function attach_queue(Building $building)
        {
                $this->queue[$building->get_build_end()] = $building;
        }

        public function detach_queue($time)
        {
                unset($this->queue[$time]);
        }

        public function get_queue()
        {
                return $this->queue;
        }

        public function getResource($resourceName)
        {
                return isset($this->resources[$resourceName]) ? $this->resources[$resourceName] : NULL;
        }

        public function getBuilding($buildingName)
        {
                return isset($this->buildings[$buildingName]) ? $this->buildings[$buildingName] : NULL;
        }

        public function buildings()
        {
                return $this->buildings;
        }

        public function resources()
        {
                return $this->resources;
        }

        public function get_consumptions($resource_name = null)
        {
                $total = 0;
                foreach ($this->buildings() as $building)
                {


                        foreach ($building->get_consumptions($resource_name) as $resource=> $value)
                        {
                                $total+=(int) $value;
                        }
                }

                return $total;
        }
        public function getBuildingTypes(){
                return $this->buildingTypes;
        }
        public function getBuildingsByType($type)
        {
                if(!isset($this->buildingTypes[$type])) return array();
                $buildings = array();
               
                foreach ($this->buildingTypes[$type]as $building)
                {
                        $buildings[] = $this->buildings[$building];
                }
                return $buildings;
        }

        public function getResourceByType($type)
        {
                if(!isset($this->resourceTypes[$type])) return null;
                $resources = array();
                foreach ($this->resourceTypes[$type] as $resource)
                {
                        $resources[] = $this->resources[$resource];
                }
                return $resources;
        }

        public function update_queue()
        {
                foreach ($this->queue as $time=> $building)
                {
                        if ($time < time()) continue;
                        $building->set_level($building->get_level() + 1);
                        $this->detach_queue($time);
                }
        }

}