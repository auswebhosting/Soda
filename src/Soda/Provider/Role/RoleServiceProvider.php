<?php

namespace Soda\Provider\Role;

use Silex\Application;
use Silex\ServiceProviderInterface;

use \Soda\Component\Role\Role;

class RoleServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
    }

    public function boot(Application $app)
    {
        $app['role.factory'] = new Role($app['role.config']);
    }
}