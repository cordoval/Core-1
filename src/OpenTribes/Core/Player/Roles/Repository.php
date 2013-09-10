<?php

namespace OpenTribes\Core\Player\Roles;

interface Repository{
 

    public function save(Player $player);
}