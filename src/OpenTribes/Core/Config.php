<?php
/**
 * Class to store configuration Values
 * 
 * @package    Opentribes
 * @category   Core
 * @author     Witali Mik
 * @copyright  (c) 2013
 * @license    http://opensource.org/licenses/MIT
 */
namespace OpenTribes\Core;

class Config{
        /**
         * Array of Values
         * @var array $_configs 
         */
        private $_configs = array();
        /**
         * PHP Magic method __set
         * @param String $name
         * @param Mixed $value
         */
        public function __set($name, $value)
        {
                $this->_configs[$name] = $value;
        }
        /**
         * PHP Magic method __get
         * @param String $name
         * @return Mixed $config || null
         */
        public function __get($name){
                return isset($this->_configs[$name])?$this->_configs[$name]: null;
        }
}