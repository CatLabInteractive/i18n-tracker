<?php

// Initialize router
$router = new \Neuron\Router ();

$i18n = new i18nTracker\Module ();
$router->module ('/', $i18n);

return $router;