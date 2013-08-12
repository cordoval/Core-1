<?php
namespace OpenTribes\Core;

class Player extends Object {

        private $id     = null;

        private $cities = array();

        public function id($id = null)
        {
                if ($id)
                {
                        $this->id = $id;
                        return $this;
                }
                return $this->id;
        }

        public function getCity(City $city)
        {
                return isset($this->cities[$city->get_name()]) ? $this->cities[$city->get_name()] : NULL;
        }

        public function addCity(City $city)
        {
                $city->owner($this);
                $this->cities[$city->name()] = $city;
                return $this;
        }

        public function cities()
        {
                return $this->cities;
        }

}