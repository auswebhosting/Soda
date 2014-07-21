<?php

namespace Soda\Provider\Menu;

use Silex\Application;
use Silex\ServiceProviderInterface;

use \Soda\Component\Menu\Menu;
use \Igorw\Silex\ConfigServiceProvider;
use \Cocur\Slugify\Slugify;

class MenuServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
    }

    public function boot(Application $app)
    {
        $app['menu'] = new Menu();
        $app->register(new ConfigServiceProvider($app['menu.config']));
        $this->render($app);
    }

    private function render(Application $app)
    {
        $slugify = new Slugify();

        foreach($app['menus'] as $key)
        {   
            $controller = explode('::', $key['_controller']);
            $instance   = new $controller[0];
            $method     = $controller[1];
            $slug       = $slugify->slugify($key['title']);
            
            $app['menu']->create([$key['title'], $key['title'], $key['capability'], $slug, array($instance, $method), $key['icon'], $key['position']]);
        }
    }
}