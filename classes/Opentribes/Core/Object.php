<?php
/**
 * Base Game Object
 * 
 * @package    Opentribes
 * @category   Core
 * @author     Witali Mik
 * @copyright  (c) 2013
 * @license    http://opensource.org/licenses/MIT
 */
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
        
        public function debug(){
                echo '<pre>'.print_r($this,true).'</pre>';
        }
}
