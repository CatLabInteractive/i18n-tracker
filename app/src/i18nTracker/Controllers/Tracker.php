<?php

namespace i18nTracker\Controllers;

use Neuron\Interfaces\Controller;
use Neuron\Interfaces\Module;
use Neuron\Net\Request;
use Neuron\Net\Response;


class Tracker
	extends Base {

	public function track () {

		return Response::json (array ('test' => 1));

	}

}