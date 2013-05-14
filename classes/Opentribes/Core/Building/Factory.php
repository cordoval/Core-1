<?php
namespace Opentribes\Core\Building;

use Opentribes\Core\Factory as Core_Factory;
use Opentribes\Core\Config;

class Factory extends Core_Factory {

       
        public function create($name, Config $config)
        {
                if (in_array($name, $this->allowedObjects))
                {
                        $class = __NAMESPACE__."\\Type\\".$name;
                        return new $class($config);
                }
                throw new \RuntimeException('Unknown Building');
        }

}
