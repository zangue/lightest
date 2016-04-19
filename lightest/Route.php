<?php

/**
 * Route.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

use Exception;

/**
 * This class describe a route element, i.e, a resource uri and one or more
 * of handlers that schould be called on uri request.
 */
class Route {

	/**
	 * Resource uri
	 * @var string
	 */
	protected $uri;

	/**
	 * HTTP methods for this route.
	 * @var string
	 */
	protected $http_methods;

	/**
	 * A set of handlers to be called on a particular route uri
	 * @var Callable Array
	 */
	protected $handlers;

	/**
	 * Route parameters
	 * @var array
	 */
	protected $params;

	/**
	 * Class constructor
	 * @param string $uri     the route uri
	 * @param Callable $handlers array of callable handlers
	 */
	public function __construct($uri, $handlers = null, $http_methods = null)
	{
		if (!is_null($uri)) $this->uri = $uri;

		if (!is_null($http_methods) && $this->validateMethods($http_methods))
			$this->http_methods = $http_methods;
		else
			$this->http_methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

		foreach ($handlers as $handler) {
			if (!is_null($handler) && is_callable($handler))
				$this->handlers[] = $handler;
			else
				throw new Exception("Application error: handler must be a callable");
				
		}
	}

	/**
	 * Checks if the passed methods are valid
	 * @param  Array $methods the HTTP method names
	 * @return boolean
	 */
	private function validateMethods($methods)
	{
		$valid_http_methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

		foreach ($methods as $method) {
			if (!in_array($method, $valid_http_methods))
				return false;
		}

		return true;
	}

	/**
	 * get the route uri
	 * @return string route uri
	 */
	public function getUri()
	{
		return $this->uri;
	}

	/**
	 * set the route uri
	 * @param string $uri route uri
	 */
	public function setUri($uri)
	{
		$this->uri = $uri;
	}

	/**
	 * Get all handlers for this route
	 * @return Array of callable
	 */
	public function getHandlers()
	{
		return $this->handlers;
	}

	/**
	 * Adds handler to route
	 * @param Callable $handler handler to be perform for this route
	 */
	public function addHandler($handler)
	{
		if (is_callable($handler)) {
			$this->handlers[] = $handler;
			return;
		}

		throw new Exception("Application error: argument must be a callable!");
	}

	/**
	 * Get the http methods for this route
	 * @return Array http methods
	 */
	public function getHttpMethods()
	{
		return $this->http_methods;
	}

	/**
	 * Override route methods
	 * @return void
	 */
	public function methods()
	{

		$http_methods = func_get_args();

        if(count($http_methods) && is_array($http_methods[0])){
            $http_methods = $http_methods[0];
        }

		if ($this->validateMethods($http_methods)) {
			unset($this->http_methods);
			$this->http_methods = $http_methods;
		}

	}

	/**
	 * Alias for methods()
	 * @return void
	 */
	public function method()
	{
		$this->methods(func_get_args());
	}



}