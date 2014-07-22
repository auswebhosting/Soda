<?php

namespace Soda\Provider\Menu;

use Silex\Application;
use Silex\ServiceProviderInterface;

use \Soda\Component\Menu\Menu;
use \Cocur\Slugify\Slugify;

class MenuServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
    }

    public function boot(Application $app)
    {
        $app['menu.factory'] = new Menu();
        $this->render($app);
    }

    private function render(Application $app)
    {
        $slugify = new Slugify();

        foreach($app['menu.config'] as $key)
        {   
            $controller = explode('::', $key['_controller']);
            $instance   = new $controller[0];
            $method     = $controller[1];
            $slug       = $slugify->slugify($key['title']);
            
            $app['menu.factory']->create([$key['title'], $key['title'], $key['capability'], $slug, array($instance, $method), $key['icon'], $key['position']]);
        }
    }
}