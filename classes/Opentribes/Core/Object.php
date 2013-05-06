<?php

namespace Opentribes\Core;

abstract class Object{
        /**
         * Object Name
         * @var String $name 
         */
        protected $name = '';
        /**
         * Object Type
         * @var String $type
         */
        protected $type = '';
        
        //Setters
        /**
         * Sets the type
         * @param String $type
         */
        public function type($type = null){
                if($type){
                     $this->type = $type;
                     return $this;
                }
                return $this->type;
        }
        /**
         * Sets the name
         * @param String $name
         */
        public function name($name = null){
                if($name){
                   $this->name = $name;    
                   return $this;
                }
                
                return $this->name;
        }
     
}
