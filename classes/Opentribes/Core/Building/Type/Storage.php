<?php
namespace Opentribes\Core\Building\Type;

use Opentribes\Core\Building;
use Opentribes\Core\Resource;

class Storage extends Building{


        private $capacity = 0;

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
                        $capcity = $this->capacity();
                        if ( $total >= $capcity)
                        {
                                $total = $capcity;
                        }

                        $res->value($total);
                        
                        return TRUE;
                }
                return FALSE;
        }
        public function update()
        {       $level = $this->level();
                $this->capacity =  round($this->config->capacity['value'] * pow($this->config->capacity['factor'],$level-1));
                parent::update() ;
        }

      
}