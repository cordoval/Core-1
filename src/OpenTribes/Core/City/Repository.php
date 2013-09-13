<?php

namespace OpenTribes\Core\City;
use OpenTribes\Core\User;
use OpenTribes\Core\City;
interface Repository{
public function findById($id);
public function findByName($name);
public function findByUser(User $user);
public function findByLocation($x,$y);
public function add(City $city);
}