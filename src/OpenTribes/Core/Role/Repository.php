<?php
namespace OpenTribes\Core\Role;

use OpenTribes\Core\Role;
interface Repository{
    public function add(Role $role);
    public function findByName($name);
     public function findById($id);
}