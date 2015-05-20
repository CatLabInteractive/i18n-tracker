<?php

namespace i18nTracker\Controllers;

use Neuron\Interfaces\Module;
use Neuron\Interfaces\Controller;
use Neuron\Net\Request;

class Base
	implements Controller {

	/** @var Module */
	private $module;

	/** @var Request */
	private $request;

	/**
	 * Controllers must know what module they are from.
	 * @param Module $module
	 */
	public function __construct (Module $module = null)
	{
		$this->module = $module;
	}

	/**
	 * Set (or clear) the request object.
	 * @param Request $request
	 * @return void
	 */
	public function setRequest (Request $request = null)
	{
		$this->request = $request;
	}
}