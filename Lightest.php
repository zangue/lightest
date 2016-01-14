<?php

/**
 * Lightest.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

use Lightest\Request;
use Lightest\Route;
use Lightest\Router;
use Lightest\Util;
use Exception;

class Lightest {

	/**
	 * The router
	 * @var Router
	 */
	private $router;

	/**
	 * The request object
	 * @var Request
	 */
	public $request;


	public function __construct()
	{
		// TODO
		$this->router = new Router();
		$this->request = new Request();
	}

	/**
	 * adds a GET route
	 * @param  string $uri
	 * @return void
	 */
	public function get($uri)
	{
		if (is_null($uri))
			throw new Exception("Error: Resource uri can not be NULL.");

		$uri = '/' . trim($uri, '/');

		$http_method = 'GET';

		$actions = array_slice(func_get_args(), 1);

		$route = new Route($uri, $http_method, $actions);

		$this->router->addRoute($route);
	}


	/**
	 * Run the application
	 * @return void
	 */
	public function run()
	{
		$dispatched = $this->router->dispatch($this->request);

		if (!$dispatched) {
			// TODO
			echo "Error 404: Not found";
		}
	}

}