<?php
namespace Opentribes\Core;

class City extends Object {

        protected $buildings = array();

        protected $building_types = array();

        protected $resource_types = array();

        protected $resources = array();

        protected $owner = NULL;

        protected $queue = array();

        public function add_building(Building $building)
        {
                $building->assign_city($this);
                $this->buildings[$building->get_name()] = $building;
                if (!isset($this->building_types[$building->get_type()]))
                {
                        $this->building_types[$building->get_type()] = array();
                }

                $this->building_types[$building->get_type()][] = $building->get_name();
        }

        public function add_resource(Resource $resource)
        {
                $this->resources[$resource->get_name()] = $resource;
                if (!isset($this->resource_types[$resource->get_type()]))
                {
                        $this->resource_types[$resource->get_type()] = array();
                }

                $this->resource_types[$resource->get_type()][] = $resource->get_name();
        }

        public function set_owner(Player $player)
        {
                $this->owner = $player;
        }

        public function get_owner()
        {
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

        public function get_resource($resource_name)
        {
                return isset($this->resources[$resource_name]) ? $this->resources[$resource_name] : NULL;
        }

        public function get_building($building_name)
        {
                return isset($this->buildings[$building_name]) ? $this->buildings[$building_name] : NULL;
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

        public function get_buildings_by_type($type)
        {
                $buildings = array();
                foreach ($this->building_types[$type]as $building)
                {
                        $buildings[] = $this->buildings[$building];
                }
                return $buildings;
        }

        public function get_resource_by_type($type)
        {

                $resources = array();
                foreach ($this->resource_types[$type] as $resource)
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