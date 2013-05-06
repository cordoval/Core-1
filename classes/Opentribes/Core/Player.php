<?php
namespace Opentribes\Core;

class Player extends Object{

        private $id     = null;

  

        private $cities = array();

     
        public function id($id = null){
                if($id){
                        $this->id = $id;
                        return $this;
                }
                return $this->id;
        }
       
     

        public function get_city(City $city)
        {
                return isset($this->cities[$city->get_name()])?$this->cities[$city->get_name()]: NULL;
        }

        public function addCity(City $city)
        {
                $city->owner($this);
                $this->cities[$city->name()] = $city;
           
        }

        public function cities()
        {
                return $this->cities;
        }

}