<?php

namespace Soda\Provider\Dashboard;

use Silex\Application;
use Silex\ServiceProviderInterface;

use \Soda\Component\Dashboard\Theme;

class ThemeServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
    }

    public function boot(Application $app)
    {
        $app['theme'] = new Theme($app['theme.name'], $app['theme.css']);
        $app['theme']->setTheme($app['theme.name']);
    }
}