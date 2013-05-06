<?php
namespace Opentribes\Core;

class Resource extends Object{
   protected $value = 0;
   protected $storage = '';
   public function get_value(){
           return $this->value;
   }
   public function set_value($value){
           $this->value = $value;
   }
   public function set_storage($building_name){
           $this->storage = $building_name;
   }
   public function get_storage(){
           return $this->storage;
   }
}
