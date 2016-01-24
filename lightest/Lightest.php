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
use Lightest\View;
use Lightest\Util;
use Exception;

class Lightest {

	/**
	 * Version
	 */
	const VERSION = '0.1';

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

	/**
	 * The view object
	 * @var View
	 */
	public $view;

	/**
	 * (User) No route handler
	 * @var callable
	 */
	protected $noRoute;


	public function __construct(array $settings = array())
	{
		//
		$defaults = [
			'templates_path' => '.' . DIRECTORY_SEPARATOR
		];

		$settings = array_merge($defaults, $settings);

		$this->router = new Router();
		$this->request = new Request();
		$this->view = new View($settings['templates_path']);
	}

	/**
	 * Get lightest version
	 * @return {string} version
	 */
	public function version()
	{
		return self::VERSION;
	}

	/**
	 * Generic function to add a new route
	 * @param string $uri
	 * @param string $method HTTP Method
	 * @param array of callables $actions actions to be performed on route match
	 */
	protected function addRoute($uri, $http_method, $actions)
	{
		if (is_null($uri))
			throw new Exception("Error: Resource uri can not be NULL.");

		$uri = '/' . trim($uri, '/');

		$route = new Route($uri, $http_method, $actions);

		$this->router->addRoute($route);
	}

	/**
	 * adds a GET route
	 * @param  string $uri
	 * @return void
	 */
	public function get($uri)
	{
		$actions = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'GET', $actions);
	}

	/**
	 * adds a POST route
	 * @param  string $uri
	 * @return void
	 */
	public function post($uri)
	{
		$actions = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'POST', $actions);
	}

	/**
	 * adds a PUT route
	 * @param  string $uri
	 * @return void
	 */
	public function put($uri)
	{
		$actions = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'PUT', $actions);
	}

	/**
	 * adds a PATCH route
	 * @param  string $uri
	 * @return void
	 */
	public function patch($uri)
	{
		$actions = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'PATCH', $actions);
	}

	/**
	 * adds a DELETE route
	 * @param  string $uri
	 * @return void
	 */
	public function delete($uri)
	{
		$actions = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'DELETE', $actions);
	}

	/**
	 * Adds a user handler for 404 HTTP error
	 */
	public function notFound()
	{
		$handlers = func_get_args();

		foreach ($handlers as $handler) {
			if (!is_callable($handler))
				throw new Exception("Error: 404 handler muss be a handler.");
		}

		$this->noRoute = $handlers;
	}

	public function handleNotFound()
	{
		if (isset($this->noRoute)) {
			foreach ($this->noRoute as $handler) {
				call_user_func($handler);
			}
		} else {
			echo '<p>Error 404: Not found.</p>';
		}
	}

	/**
	 * Run the application
	 * @return void
	 */
	public function run()
	{
		$dispatched = $this->router->dispatch($this->request);

		if (!$dispatched) {
			$this->handleNotFound();
		}
	}

}