<?php
namespace OpenTribes\Core\Resource;

use OpenTribes\Core\Factory as Core_Factory;
use OpenTribes\Core\Config;

class Factory extends Core_Factory {
          /**
         * Creates an object if allowed with a Configuration
         * @param String $name
         * @param Config $config
         * @return Mixed $object
         */
        public function create($name, Config $config)
        {
                if (in_array($name, $this->allowedObjects))
                {
                        $class = __NAMESPACE__."\\Type\\".$name;
                        return new $class($config);
                }
                throw new \RuntimeException('Unknown Resource');
        }

}
