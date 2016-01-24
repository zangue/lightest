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

$app = new Lightest([
		'templates_path' => APP_DIR . DS . 'templates'
	]);

$app->get('/', function () use ($app) {
	echo 'This is the root path.';
	//echo $app->request->getHttpMethod();
});

$app->get('/test', function () use ($app) {
	echo 'This is a test.';
	//echo $app->request->getHttpMethod();
});

$app->view->render('header.php');
$app->run();
$app->view->render('footer.php');
