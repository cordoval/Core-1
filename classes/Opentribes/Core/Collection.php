<?php
namespace Opentribes\Core;

use Opentribes\Core\Building\Factory as Building_Factory,
    Opentribes\Core\Resource\Factory as Resource_Factory;

class Collection {

        const BUILDINGS = 'buildings';

        const RESOURCES = 'resources';

        const UNITS = 'units';

        private $_collection = array();

        public function init_buildings(array $config)
        {


                $factory = new Building_Factory(array_keys($config));
                foreach ($config as $type=> $buildings)
                {
                        foreach ($buildings as $building_name=> $values)
                        {

                                $configObj = new Config();
                                foreach ($values as $name=> $value)
                                {
                                      
                                        $configObj->$name = $value;
                                }
                                $obj = $factory->create($type, $configObj);
                                $obj->name($building_name);
                                $obj->type($type);
                                $this->set(self::BUILDINGS, $obj);
                        }
                }
        }

        public function init_resources(array $config)
        {
                $factory = new Resource_Factory(array_keys($config));

                foreach ($config as $type=> $resources)
                {
                        foreach ($resources as $resource_name=> $values)
                        {
                                $configObj = new Config();
                                foreach ($values as $name=> $value)
                                {
                                        $configObj->$name = $value;
                                }
                                $obj = $factory->create($type, $configObj);
                                $obj->name($resource_name);
                                $obj->type($type);
                                $this->set(self::RESOURCES, $obj);
                        }
                }
        }

        private function set($type, Object $object)
        {
                $this->_collection[$type][$object->name()] = $object;
        }

        public function get($type = NULL, $object = NULL)
        {


                if ($type && $object)
                {
                        $name = $object;
                        if ($object instanceof Object) $name = $object->name();

                        if (isset($this->_collection[$type][$name]))
                        {
                                return $this->_collection[$type][$name];
                        }

                        return FALSE;
                }
                if ($type && isset($this->_collection[$type])) return $this->_collection[$type];
                return $this->_collection;
        }

}
