<?php
namespace Opentribes\Core\Resource;

use Opentribes\Core\Factory as Core_Factory,
 Opentribes\Core\Config;

class Factory extends Core_Factory {

        public function create($name,Config $config)
        {
                if (in_array($name, $this->allowed_objects))
                {
                        $class = __NAMESPACE__."\\Type\\".$name;
                        return new $class();
                }
                throw new \RuntimeException('Unknown Resource');
        }

}
