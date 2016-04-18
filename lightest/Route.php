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
	 * HTTP method for this route.
	 * @var string
	 */
	protected $http_method;

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
	public function __construct($uri, $http_method, $handlers = null)
	{
		$valid_http_methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

		if (!is_null($uri)) $this->uri = $uri;

		if (!is_null($http_method) && in_array($http_method, $valid_http_methods))
			$this->http_method = $http_method;

		foreach ($handlers as $handler) {
			if (!is_null($handler) && is_callable($handler))
				$this->handlers[] = $handler;
			else
				throw new Exception("Application error: handler must be a callable");
				
		}
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
	 * Get the http method for this route
	 * @return string http method
	 */
	public function getHttpMethod()
	{
		return $this->http_method;
	}

}