<?php
namespace OpenTribes\Core\Role;

use OpenTribes\Core\Role;
interface Repository{
    public function save(Role $role);
    public function findByName($name);
}