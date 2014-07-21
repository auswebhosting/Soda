<?php

namespace Soda\Provider\Menu;

use Silex\Application;
use Silex\ServiceProviderInterface;

use \Soda\Component\Menu\Menu;
use \Igorw\Silex\ConfigServiceProvider;
use \Cocur\Slugify\Slugify;

class MenuServiceProvider implements ServiceProviderInterface
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function register(Application $app)
    {
        $app['menu.factory'] = new Menu();
        $app->register(new ConfigServiceProvider($this->filename));
        $this->render($app);
    }

    private function render(Application $app)
    {
        $slugify = new Slugify();

        foreach($app['menus'] as $key)
        {   
            $controller = explode('::', $key['_controller']);
            $instance = new $controller[0];
            $method = $controller[1];
            $slug = $slugify->slugify($key['title']);
            $app['menu.factory']->create([$key['title'], $key['title'], $key['capability'], $slug, array($instance, $method), $key['icon'], $key['position']]);
        }
    }

    public function boot(Application $app)
    {
    }
}