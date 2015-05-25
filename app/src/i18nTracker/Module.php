<?php

namespace i18nTracker;

use Neuron\Auth\HttpAuth;
use Neuron\Net\Request;
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

		HttpAuth::addFilter ($router);

		$router->get ('/projects/{projectToken}/track', 'i18nTracker\Controllers\Projects@track');
		//$router->get ('/projects/{projectToken}/translate/{language}', 'i18nTracker\Controllers\Projects@translate');

		$router->get ('/', 'i18nTracker\Controllers\Translate@listProjects');

		$router->get ('/translate/{projectToken}', 'i18nTracker\Controllers\Translate@selectLanguage')->filter ('basicauth');
		$router->get ('/translate/{projectToken}/{language}', 'i18nTracker\Controllers\Translate@translate')->filter ('basicauth');

		$router->post ('/translate/{projectToken}/{language}/{id}/{variation}', 'i18nTracker\Controllers\Translate@setResource')->filter ('basicauth');

		$router->get ('/download/{projectToken}', 'i18nTracker\Controllers\Translate@showLanguages')->filter ('basicauth');
		$router->get ('/download/{projectToken}/{language}', 'i18nTracker\Controllers\Translate@download')->filter ('basicauth');
	}

}