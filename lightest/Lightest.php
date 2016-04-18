<?php

/**
 * Lightest.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

use Lightest\Middleware;
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


	/**
	 * PSR-0 Autoloader
	 *
	 * @see http://www.php-fig.org/psr/psr-0/
	 * @param  string $className The name of the class to load
	 * @return void
	 */
	public function autoload($className)
	{
        $className = ltrim($className, '\\');
	    $fileName  = '';
	    $namespace = '';
	    if ($lastNsPos = strrpos($className, '\\')) {
	        $namespace = substr($className, 0, $lastNsPos);
	        $className = substr($className, $lastNsPos + 1);
	        $fileName  = __DIR__ . str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	    }
	    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

	    $fileName = str_replace($namespace, '', $fileName);

	    require $fileName;
	}


	/**
	 * Installs this class loader on the SPL autoload stack.
	 */
	public function register()
	{
	    spl_autoload_register(array($this, 'autoload'));
	}

	/**
	 * Class constructor
	 * @param array $settings application settings
	 */
	public function __construct(array $settings = array())
	{
		// Install class loader
		$this->register();

		//
		$defaults = [
			'templates_path' => '.' . DIRECTORY_SEPARATOR
		];

		$settings = array_merge($defaults, $settings);

		$this->middleware = new Middleware();
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
	 * @param array of callables $handlers handlers to be performed on route match
	 */
	protected function addRoute($uri, $http_method, $handlers)
	{
		if (is_null($uri))
			throw new Exception("Error: Resource uri can not be NULL.");

		$uri = '/' . trim($uri, '/');

		$route = new Route($uri, $http_method, $handlers);

		$this->router->addRoute($route);
	}

	/**
	 * Add a middleware
	 * @param  Oject $middleware middleware object
	 * @return void
	 */
	public function middleware($middleware)
	{
		$this->middleware->add($middleware);
	}

	/**
	 * adds a GET route
	 * @param  string $uri
	 * @return void
	 */
	public function get($uri)
	{
		$handlers = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'GET', $handlers);
	}

	/**
	 * adds a POST route
	 * @param  string $uri
	 * @return void
	 */
	public function post($uri)
	{
		$handlers = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'POST', $handlers);
	}

	/**
	 * adds a PUT route
	 * @param  string $uri
	 * @return void
	 */
	public function put($uri)
	{
		$handlers = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'PUT', $handlers);
	}

	/**
	 * adds a PATCH route
	 * @param  string $uri
	 * @return void
	 */
	public function patch($uri)
	{
		$handlers = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'PATCH', $handlers);
	}

	/**
	 * adds a DELETE route
	 * @param  string $uri
	 * @return void
	 */
	public function delete($uri)
	{
		$handlers = array_slice(func_get_args(), 1);

		$this->addRoute($uri, 'DELETE', $handlers);
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

	/**
	 * Route not found handler
	 * @return void
	 */
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
		$this->middleware->before();

		$dispatched = $this->router->dispatch($this->request);

		if (!$dispatched) {
			$this->handleNotFound();
		}

		$this->middleware->after();
	}

}