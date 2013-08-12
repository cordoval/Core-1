<?php

namespace OpenTribes\Core;

use \Silex\Application;
use \Silex\ServiceProviderInterface;
use \Mustache\Silex\Provider\MustacheServiceProvider;
use \Silex\Provider\ServiceControllerServiceProvider;

class Module implements ServiceProviderInterface {

    public function boot(Application $app) {
        
    }

    public function register(Application $app) {
        //module services

        $app->register(new ServiceControllerServiceProvider());
        $app->register(new MustacheServiceProvider());
        $app['renderer'] = $app['mustache'];
        //Controllers

        $app['index.controller'] = $app->share(function() use($app) {
                    return new Controller\Index($app);
                });
        $app['index.view'] = $app->share(function() use($app) {
                    return new View\Index($app);
                });
        $app['assets.controller'] = $app->share(function() use($app) {
                    return new Controller\Asset($app);
                });
        $app->get('/', 'index.controller:indexAction');
      
        return $app;
    }

}
