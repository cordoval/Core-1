<?php
namespace Opentribes\Core;

class Player extends Object{

        private $id     = NULL;

  

        private $cities = array();

     

        public function set_id($id)
        {
                $this->id = $id;
        }

        public function set_name($name)
        {
                $this->name = $name;
        }

        public function get_id()
        {
                return $this->id;
        }

        public function get_name()
        {
                return $this->name;
        }

        public function get_city(City $city)
        {
                return isset($this->cities[$city->get_name()])?$this->cities[$city->get_name()]: NULL;
        }

        public function add_city(City $city)
        {
                $city->set_owner($this);
                $this->cities[$city->get_name()] = $city;
           
        }

        public function cities()
        {
                return $this->cities;
        }

}