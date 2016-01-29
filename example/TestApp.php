<?php

/**
 * A demo application
 */

require 'middleware' . DS . 'TestMiddleware.php';

require LIGHTEST_DIR . DS . 'Lightest.php';

use Lightest\Lightest;

//var_dump($SERVER);

$app = new Lightest([
		'templates_path' => APP_DIR . DS . 'templates'
	]);

//var_dump($app->request->allGet());

$app->middleware(new TestMiddleware());

$app->get('/', function () use ($app) {
	echo 'Lightest ' . $app->version();
});

$app->get('/test', function () use ($app) {
	echo 'This is a test.';
	//echo $app->request->getHttpMethod();
},
function () {
	echo 'Another test.';
});

$app->get('/post', function () use ($app) {
	//echo $app->request->get('d');
	$app->view->render('form.php');
});

$app->post('/post', function () use ($app) {
	//echo $app->request->isPost();
	echo 'Firstname: ' . $app->request->post('firstname') .
		 ' Lastname: ' . $app->request->post('lastname');
});

$app->notFound(function () {
	echo 'Route not found.';
});

$app->view->render('header.php');
$app->run();
$app->view->render('footer.php');
