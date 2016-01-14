<?php

require 'Lightest.php';
require 'Request.php';
require 'Route.php';
require 'Router.php';
require 'Util.php';

use Lightest\Lightest;

//var_dump($_SERVER);

$app = new Lightest();

$app->get('/test', function () use ($app) {
	echo 'This is a test.';
	echo $app->request->getHttpMethod();
});

$app->run();