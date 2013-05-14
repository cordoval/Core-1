<?php
namespace Opentribes\Core;

use Opentribes\Core\Config;

/**
 * 
 */
abstract class Building extends Object {

        /**
         * The City of the Building
         * @var City $city 
         */
        protected $city = NULL;

        protected $level = 0;

        protected $config = null;

        protected $consumptions = array();

        protected $costs = array();

        public function __construct(Config $config)
        {
                $this->config = $config;
                return $this;
        }

        public function assignCity(City $city)
        {
                $this->city = $city;
                return $this;
        }

        public function getConsumptions($resourceName = NULL)
        {
                $consumtions = array();
                $level = $this->level();
                if ($resourceName && isset($this->config->consumptions[$resource_name]))
                {
                        $values                      = $this->config->consumptions[$resource_name];
                        $value                       = 0;
                        if ($level > 0) $value                       = round($values['value'] * pow($values['factor'], $level - 1));
                        $consumtions[$resource_name] = $value;
                        return $consumtions;
                }
                foreach ($this->config->consumptions as $name=> $values)
                {

                        $value = 0;
                        if ($level > 0) $value = round($values['value'] * pow($values['factor'], $level - 1));

                        $consumtions [$name] = $value;
                }
                return $consumtions;
        }

        public function level($level = null)
        {


                if ($level)
                {

                        $this->level = min(max($level, $this->config->levels['minimum']), $this->config->levels['maximum']);

                        return $this;
                }

                return min(max($this->level, $this->config->levels['minimum']), $this->config->levels['maximum']);
        }

        public function costs($resourceName = NULL)
        {

                if ($resourceName && isset($this->costs[$resourceName])) return $this->costs[$resourceName];
                return $this->costs;
        }

        public function consumptions($resourceName = NULL)
        {

                if ($resourceName && isset($this->consumptions[$resourceName])) return $this->consumptions[$resourceName];
                return $this->consumptions;
        }

        public function get_build_end()
        {
                return time() + round($this->config->build['time'] * pow($this->config->build['factor'], $this->level()));
        }

        private function match_requirements()
        {
                if (count($this->config->requirements) > 0)
                {
                        foreach ($this->config->requirements as $building_name=> $level)
                        {
                                $building = $this->city->get_building($building_name);
                                if ($building->get_level() < $level) return FALSE;
                        }
                }
                return TRUE;
        }

        private function match_costs()
        {
                if (count($this->costs) > 0)
                {
                        foreach ($this->get_costs() as $resource_name=> $value)
                        {
                                $resource = $this->city->get_resource($resource_name);

                                if ($resource->get_value() < $value) return FALSE;
                        }
                }

                return TRUE;
        }

        private function match_consumptions()
        {

                $value = 0;
                foreach ($this->city->getResourceByType('Consumer') as $resource)
                {
                        foreach ($this->city->getBuildingsByType($resource->storage()) as $building)
                        {
                                $value += $building->capacity();
                        }
                }

                return TRUE;
        }

        public function can_upgrade()
        {
                if ($this->level() >= $this->config->levels['maximum']) return FALSE;

                return ($this->match_requirements() &&
                $this->match_costs() &&
                $this->match_consumptions());
        }

        public function upgrade()
        {
                $result = $this->can_upgrade();
                if ($result)
                {
                        $this->city->attach_queue($this);
                        foreach ($this->costs() as $resource_name=> $value)
                        {
                                $resource = $this->city->getResource($resource_name);
                                $type     = $resource->storage();
                                foreach ($this->city->getBuildingsByType($type) as $building)
                                {

                                        $building->setValue($resource, $value * -1);
                                }
                        }
                }
                return $result;
        }

        public function update()
        {
                $level = $this->level();
                $value = 0;
                foreach ($this->config->costs as $resource=> $values)
                {

                        if ($level > 0) $value = round($values['value'] * pow($values['factor'], $level - 1));

                        $this->costs[$resource] = $value;
                }
                  $value = 0;
                  
                  
                foreach ($this->config->consumptions as $resource=> $values)
                {
                       
                        if ($level > 0) $value = round($values['value'] * pow($values['factor'], $level -1 ));

                        $this->consumptions[$resource] = $value;
                }
                return $this;
        }

        public function configs()
        {
                return $this->config;
        }

}
