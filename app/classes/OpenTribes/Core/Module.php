<?php

namespace OpenTribes\Core;

use \Silex\Application;
use \Silex\ServiceProviderInterface;

class Module implements ServiceProviderInterface {

    public function boot(Application $app) {
        
    }

    public function register(Application $app) {
        //module services
        $app->register(new Silex\Provider\ServiceControllerServiceProvider());
        $app->register(new \Mustache\Silex\Provider\MustacheServiceProvider());
        $app['renderer'] = $app['mustache'];
        //Controllers

        $app['index.controller'] = $app->share(function() use($app) {
                    return new Controller\Index($app);
                });
        $app['index.view'] = $app->share(function() use($app) {
                    return new View\Index($app);
                });
        $app->get('/', 'index.controller:indexAction');
        return $app;
    }

}
