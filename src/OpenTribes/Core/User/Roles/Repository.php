<?php

namespace OpenTribes\Core\User\Roles;

use OpenTribes\Core\User\Roles as UserRoles;
interface Repository{
  
    public function add(UserRoles $playerRoles);

    public function save();
}