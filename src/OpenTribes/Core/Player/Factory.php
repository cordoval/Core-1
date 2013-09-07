<?php

namespace OpenTribes\Core\Player;
use OpenTribes\Core\Entity\Factory as EntityFactory;
use OpenTribes\Core\Player;

class Factory extends EntityFactory{
    public function __construct() {
        $this->object = new Player();
    }
}
