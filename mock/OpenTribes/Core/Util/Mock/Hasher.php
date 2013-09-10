<?php

namespace OpenTribes\Core\Util\Mock;

use OpenTribes\Core\Util\Hasher as HasherInterface;
class Hasher implements HasherInterface{
    public function hash($string) {
        return md5($string);
    }
}
