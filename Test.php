<?php

require 'Lightest.php';
require 'Request.php';
require 'Route.php';
require 'Router.php';

use Lightest\Lightest;

var_dump($_SERVER);

$app = new Lightest();

$app->get('/test', function () use ($app) {
	echo 'This is a test.';
});

$app->run();