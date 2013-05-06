<?php
namespace Opentribes\Core\Building\Type;

use Opentribes\Core\Building;
use Opentribes\Core\Resource;

class Storage extends Building{

  

        private $capacity = array();


      

        public function addResource(Resource $resource)
        {
                $this->city->addResource($resource);
        }

    
        public function capacity($capacity = null){
                if($capacity){
                        $this->capacity = $capacity;
                        return $this;
                }
                return $this->capacity;
                $level = max($this->get_level() -1,0);
                $value = round($this->capacity['value'] * pow($this->capacity['factor'],$level));
                return $value;
        }

        public function setValueForResource(Resource $resource, $value)
        {
                if (($res =$this->city->getResource($resource->name())))
                {      
                        $total=$res->value()+$value;
                        if ( $total >= $this->capacity())
                        {
                                $total = $this->capacity();
                        }

                        $res->value($total);
                        
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