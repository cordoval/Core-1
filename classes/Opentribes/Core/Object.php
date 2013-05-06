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
        public function set_type($type){
                $this->type = $type;
        }
        /**
         * Sets the name
         * @param String $name
         */
        public function set_name($name){
                $this->name = $name;
        }
        //###################Getters###########################
        /**
         * Gets the name
         * @return String $name
         */
        public function get_name(){
                return $this->name;
        }
        /**
         * Get the type
         * @return String $type
         */
        public function get_type(){
                return $this->type;
        }
}
