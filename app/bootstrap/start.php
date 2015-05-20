<?php

error_reporting (E_ALL);

$loader = require_once __DIR__ . '/../../vendor/autoload.php';

// Autoload the example app
$loader->add ('Example\\', __DIR__ . '/../app/');

// Start the app
$app = \Neuron\Application::getInstance ();

// Set config folder
\Neuron\Config::folder (__DIR__ . '/../config/');

// Optionally, set an environment
$hostname = trim (file_get_contents ('/etc/hostname'));

switch ($hostname)
{
	case 'my-computer':
	case 'thijs-home-i7':
	case 'daedeloth-N550LF':

		\Neuron\Config::environment ('development');
		break;
}

// Set the template folder
\Neuron\Core\Template::addPath (__DIR__ . '/../templates/');

// Always set a locale
$app->setLocale ('nl_BE.utf8');

// Set the local language folder
\Neuron\Tools\Text::getInstance ()->addPath ('example', __DIR__ . '/../locales/');

// Set session handler
$sessionHandler = new \Neuron\SessionHandlers\DbSessionHandler ();
$app->setSessionHandler ($sessionHandler);

// Load the router
$app->setRouter (include ('router.php'));

// Set error reporting
error_reporting (\Neuron\Config::get ('app.error_reporting'));

// Return app
return $app;