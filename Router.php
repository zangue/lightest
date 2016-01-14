<?php

/**
 * Router.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

/**
 * The router class.
 */
class Router {

	/**
	 * Routes
	 * @var Array
	 */
	private $routes;

	/**
	 * Class constructor
	 */
	public function __construct()
	{

	}

	/**
	 * Check if a route match one of the route in $routes
	 * @param  Route  $route
	 * @return boolean
	 */
	private function routeMatch(Route $route)
	{
		foreach ($routes as $r) {
			if ($r === $route)
				return true;
		}

		return false;
	}

	/**
	 * Add a route to the route array
	 * @param Route $route
	 */
	public function addRoute(Route $route)
	{
		if ($route instanceof Route) {
			$this->routes[] = $route;
			return;
		}

		throw new Exception("Application error: Argument is not a Route");
	}

	/**
	 * Router dispatcher. 
	 * @return boolean
	 */
	public function dispatch()
	{

	}

}