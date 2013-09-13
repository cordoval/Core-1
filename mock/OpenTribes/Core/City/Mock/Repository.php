<?php

namespace OpenTribes\Core\City\Mock;
use OpenTribes\Core\City\Repository as CityRepositoryInterface;
use OpenTribes\Core\City;
use OpenTribes\Core\User;
class Repository implements CityRepositoryInterface{
    public function add(City $city) {
        ;
    }
    public function findById($id) {
        ;
    }
    public function findByLocation($x, $y) {
        ;
    }
    public function findByName($name) {
        ;
    }
    public function findByUser(User $user) {
        ;
    }
}
