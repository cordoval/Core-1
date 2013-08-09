<?php
/**
 * Game Object collection class, converts configuration arrays into Objects 
 * 
 * @package    Opentribes
 * @category   Core
 * @author     Witali Mik
 * @copyright  (c) 2013
 * @license    http://opensource.org/licenses/MIT
 */
namespace Opentribes\Core;

use Opentribes\Core\Building\Factory as Building_Factory;
use Opentribes\Core\Resource\Factory as Resource_Factory;

class Collection {
        /**
         * Collection Type Buildings
         */
        const BUILDINGS = 'buildings';
        /**
         * Collection Type Resources
         */
        const RESOURCES = 'resources';
        /**
         * Collection Type Units
         */
        const UNITS = 'units';
        /**
         * Collection of Class Instances
         * @var Array $_collection 
         */
        private $_collection = array();

        /**
         * Create Building instaces
         * @param array $config
         * @example
         * <code><pre>
         * <?php
         * //Example array 
         * $buildings = array(
         *      'Namespace\\Type'=>array( //Type must exists in Core\\Building\\Type
         *              'BuildingName'=>array( //each Building has Configurations
         *                      'PropertyName' => array(
         *                                'ValueName'=>'Value'
         *                       )
         *               )
         *       )
         * );
         * </pre></code>
         */
        public function initBuildings(array $config)
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

        public function initResources(array $config)
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

        public function set($type, Object $object)
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
