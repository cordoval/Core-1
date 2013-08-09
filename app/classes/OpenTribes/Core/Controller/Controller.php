<?php
namespace OpenTribes\Core\Controller;

class Controller{
    protected $renderer = null;
    protected $view = null;
    public function __construct(\Mustache_Engine $renderer) {
        $this->renderer = $renderer;
    }
}
