<?php

namespace Soda\Provider\Dashboard;

use Silex\Application;
use Silex\ServiceProviderInterface;

use \Soda\Component\Dashboard\Theme;

class ThemeServiceProvider implements ServiceProviderInterface
{
	private $theme;

	public function __construct($name, $filename)
	{
		$this->theme = new Theme($name, $filename);
		$this->theme->setTheme($name);
	}

    public function register(Application $app)
    {
        $app['theme'] = $this->theme;
    }

    public function boot(Application $app)
    {
    }
}