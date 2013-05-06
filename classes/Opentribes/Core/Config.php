<?php
namespace Opentribes\Core;

class Config{
        private $configs = array();
        public function __set($name, $value)
        {
                $this->configs[$name] = $value;
        }
        public function __get($name){
                return isset($this->configs[$name])?$this->configs[$name]: null;
        }
}