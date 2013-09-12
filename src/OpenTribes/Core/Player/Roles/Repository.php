<?php

namespace OpenTribes\Core\Player\Roles;

use OpenTribes\Core\Player\Roles as PlayerRoles;
interface Repository{
  
    public function add(PlayerRoles $playerRoles);

    public function save();
}