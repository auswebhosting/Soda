<?php

namespace Soda\Controller;

use Symfony\Component\HttpFoundation\Request;

class BaseController
{
    protected $app;
    protected $request;

    public function __construct()
    {
        $this->app = $GLOBALS['app'];
        $this->request = new Request($_POST);
    }

    public function render($template, $attributes = null)
    {
        $this->app['before_render_middleware'];

    	if($attributes) {
    		echo $this->app['twig']->render($template, $attributes);
    	} else {
    		echo $this->app['twig']->render($template);
    	}
    }

}