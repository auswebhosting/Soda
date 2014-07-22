<?php

namespace Soda\Provider\Omnipay;

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
        foreach($app['omnipay.config'] as $key => $value)
        {
            $app['omnipay.factory.' . $key] = Omnipay::create($value['gateway']);

            foreach ($value as $attribute => $setting)
            {
                call_user_func(array($app['omnipay.factory.' . $key], 'set' . ucfirst($attribute)), $setting);
            }
        }
    }
}