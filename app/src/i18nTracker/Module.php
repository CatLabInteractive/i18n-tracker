<?php

namespace i18nTracker;

use Neuron\Router;

class Module
	implements \Neuron\Interfaces\Module {

	private $routepath;

	/**
	 * Set template paths, config vars, etc
	 * @param string $routepath The prefix that should be added to all route paths.
	 * @return void
	 */
	public function initialize ($routepath)
	{
		$this->routepath = $routepath;
	}

	/**
	 * Register the routes required for this module.
	 * @param Router $router
	 * @return void
	 */
	public function setRoutes (Router $router)
	{
		$rp = $this->routepath;

		$router->get ('/track', 'i18nTracker\Controllers\Tracker@track');
	}

}