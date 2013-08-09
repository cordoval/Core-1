<?php
namespace Opentribes\Core;

class Resource extends Object {

        protected $value  = 0;

        protected $config = array();

        public function __construct(Config $config)
        {
                $this->config = $config;
        }

        public function value($value = null)
        {
                if ($value)
                {
                        $this->value = $value;
                        return $this;
                }
                return $this->value;
        }

        public function storage($building_name = null)
        {
                if ($building_name)
                {
                        $this->config->storage = $building_name;
                        return $this;
                }
                return $this->config->storage;
        }

}
