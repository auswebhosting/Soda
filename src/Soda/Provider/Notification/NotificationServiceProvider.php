<?php

namespace Soda\Provider\Notification;

use Silex\Application;
use Silex\ServiceProviderInterface;

use \Soda\Component\Notification\Notification;

class NotificationServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['notification.factory'] = new Notification();
    }

    public function boot(Application $app)
    {
    }
}