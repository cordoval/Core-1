<?php
/**
 * Base Factory class
 * 
 * @package    Opentribes
 * @category   Core
 * @author     Witali Mik
 * @copyright  (c) 2013
 * @license    http://opensource.org/licenses/MIT
 */
namespace Opentribes\Core;

use Opentribes\Core\Config;

abstract class Factory {

        /**
         * Whitelist of Objects
         * @var Array $allowedObjects 
         */
        protected $allowedObjects = array();

        /**
         * Requre a Whitelist of Objects
         * @param array $list
         */
        public function __construct(array $list)
        {
                $this->allowedObjects = $list;
        }

        /**
         * Creates an object if allowed with a Configuration
         * @param String $name Object Name
         * @param Config $config Instance of Config
         * @return Mixed $object Object
         */
        abstract function create($name, Config $config);
}
