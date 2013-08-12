<?php
namespace OpenTribes\Core\Building;

use OpenTribes\Core\Factory as Core_Factory;
use OpenTribes\Core\Config;

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
