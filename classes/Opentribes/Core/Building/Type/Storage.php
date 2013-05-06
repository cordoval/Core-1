<?php
namespace Opentribes\Core\Building\Type;

use Opentribes\Core\Building,
Opentribes\Core\Resource;

class Storage extends Building{

  

        private $capacity = array();


      

        public function add_resource(Resource $resource)
        {
                $this->city->add_resource($resource);
        }

        public function set_capacity($capacity){
                $this->capacity = $capacity;
        }
        public function get_capacity(){
                $level = max($this->get_level() -1,0);
                $value = round($this->capacity['value'] * pow($this->capacity['factor'],$level));
                return $value;
        }

        public function set_value(Resource $resource, $value)
        {
                if (($res =$this->city->get_resource($resource->get_name())))
                {      
                        $total=$res->get_value()+$value;
                        if ( $total >= $this->get_capacity())
                        {
                                $total = $this->get_capacity();
                        }

                        $res->set_value($total);
                        
                        return TRUE;
                }
                return FALSE;
        }
        public function get_free_capacity(){
                $total = 0;
                foreach($this->city->resources() as $resource){
                        $total+=$resource->get_value();
                }
                return $this->get_capacity()-$total;
        }

      
}