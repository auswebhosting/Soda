<?php

namespace Soda\Provider\Notification;

use Silex\Application;
use Silex\ServiceProviderInterface;

use Omnipay\Common\CreditCard;
use Omnipay\Omnipay;

class OmnipayServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
    }

    public function boot(Application $app)
    {
    	$app['omnipay.factory'] = Omnipay::create($app['omnipay.config']['gateway']);
    	$app['omnipay.factory']->setUsername($app['omnipay.config']['username']);
    	$app['omnipay.factory']->setUsername($app['omnipay.config']['password']);
    }
}