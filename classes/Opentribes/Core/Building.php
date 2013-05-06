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
        protected $city  = NULL;

        protected $level = 0;

        protected $config = null;

        public function __construct(Config $config)
        {
                $this->config = $config;
        }

        public function assignCity(City $city)
        {
                $this->city = $city;
        }

        public function get_consumptions($resource_name = NULL)
        {
                $consumtions = array();
                $level = $this->get_level();
                if ($resource_name && isset($this->consumptions[$resource_name]))
                {
                        $values                      = $this->consumptions[$resource_name];
                        $value                       = 0;
                        if ($level > 0) $value                       = round($values['value'] * pow($values['factor'], $level - 1));
                        $consumtions[$resource_name] = $value;
                        return $consumtions;
                }
                foreach ($this->consumptions as $name=> $values)
                {

                        $value = 0;
                        if ($level > 0) $value = round($values['value'] * pow($values['factor'], $level - 1));

                        $consumtions [$name] = $value;
                }
                return $consumtions;
        }

        public function level($value = null)
        {

                if ($value)
                {
                        $this->level = min(max($value, $this->config->level['minimum']), $this->config->level['maximum']);
                        return true;
                }
                return min(max($this->level, $this->config->levels['minimum']), $this->config->levels['maximum']);
        }

        public function get_costs($resource_name = NULL)
        {

                $costs = array();
                $level = $this->get_level();
                $value = 0;
                foreach ($this->costs as $resource=> $values)
                {
                        if ($level > 0) $value            = round($values['value'] * pow($values['factor'], $level - 1));
                        $costs[$resource] = (int) $value;
                }
                return ($resource_name && isset($costs[$resource_name])) ? $costs[$resource_name] : $costs;
        }

        public function get_build_end()
        {
                return time() + round($this->build['time'] * pow($this->build['factor'], $this->get_level()));
        }

        private function match_requirements()
        {
                if (count($this->requirements) > 0)
                {
                        foreach ($this->requirements as $building_name=> $level)
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
                foreach ($this->city->get_resource_by_type('Consumer') as $resource)
                {
                        foreach ($this->city->get_buildings_by_type($resource->get_storage()) as $building)
                        {
                                $value += $building->get_capacity();
                        }
                }

                return TRUE;
        }

        public function can_upgrade()
        {
                if ($this->get_level() >= $this->levels['maximum']) return FALSE;

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
                        foreach ($this->get_costs() as $resource_name=> $value)
                        {
                                $resource = $this->city->get_resource($resource_name);
                                $type     = $resource->get_storage();
                                foreach ($this->city->get_buildings_by_type($type) as $building)
                                {

                                        $building->set_value($resource, $value * -1);
                                }
                        }
                }
                return $result;
        }

        public function configs()
        {
                return $this->config;
        }

}
