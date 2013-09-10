<?php

namespace OpenTribes\Core\Util\Mock;

use OpenTribes\Core\Util\CodeGenerator;
class QwertyGenerator implements CodeGenerator{
    public function create() {
        return 'qwerty';
    }
}