<?php

/**
 * A demo application
 */
require LIGHTEST_DIR . DS . 'Lightest.php';
require LIGHTEST_DIR . DS . 'Request.php';
require LIGHTEST_DIR . DS . 'Route.php';
require LIGHTEST_DIR . DS . 'Router.php';
require LIGHTEST_DIR . DS . 'View.php';
require LIGHTEST_DIR . DS . 'Util.php';

use Lightest\Lightest;

//var_dump($_SERVER);

$app = new Lightest();

$app->get('/test', function () use ($app) {
	echo 'This is a test.';
	//echo $app->request->getHttpMethod();
});

$app->run();