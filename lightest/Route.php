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
 * of actions that schould be performed on uri request.
 */
class Route {

	/**
	 * Resource uri
	 * @var string
	 */
	private $uri;

	/**
	 * HTTP method for this route.
	 * @var string
	 */
	private $http_method;

	/**
	 * A set of actions to be applied on a particular route uri
	 * @var Callable Array
	 */
	private $actions;

	/**
	 * Class constructor
	 * @param string $uri     the route uri
	 * @param Callable $actions array of callable actions
	 */
	public function __construct($uri, $http_method, $actions = null)
	{
		$valid_http_methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

		if (!is_null($uri)) $this->uri = $uri;

		if (!is_null($http_method) && in_array($http_method, $valid_http_methods))
			$this->http_method = $http_method;

		foreach ($actions as $action) {
			if (!is_null($action) && is_callable($action))
				$this->actions[] = $action;
			else
				throw new Exception("Application error: Action must be a callable");
				
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
	 * Get all actions for this route
	 * @return Array of callable
	 */
	public function getActions()
	{
		return $this->actions;
	}

	/**
	 * Adds action to route
	 * @param Callable $action action to be perform for this route
	 */
	public function addAction($action)
	{
		if (is_callable($action)) {
			$this->actions[] = $action;
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