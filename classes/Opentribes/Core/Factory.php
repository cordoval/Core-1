<?php
namespace Opentribes\Core;
use Opentribes\Core\Config;
abstract class Factory {

        protected $allowed_objects = array();

        protected $namespace = '';

        public function __construct(array $list)
        {
                $this->namespace       = __NAMESPACE__;
                $this->allowed_objects = $list;
        }

        abstract function create($name,Config $config);
}
