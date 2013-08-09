<?php

namespace OpenTribes\Core\Controller;

class Index{
    public function __construct($test) {
       echo '<pre>'.print_r($test,true).'</pre>' ;
    }

    public function indexAction(){
        return 'test';
    }
}