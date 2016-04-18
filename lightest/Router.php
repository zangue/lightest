<?php

/**
 * Router.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

use Lightest\Route;
use Exception;

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
		$this->routes = array();
	}

	/**
	 * Check if a route match the current request
	 * @param  Route  $route
	 * @return Route  if match was found, null otherwise
	 */
	private function routeMatch(Request $request)
	{
		//$request_method = 

		foreach ($this->routes as $route) {
			//var_dump($route->getUri(), $request->getUri());
			//var_dump($route->getHttpMethods(), $request->getHttpMethod());
			if ($route->getUri() === $request->getUri() &&
				in_array($request->getHttpMethod(), $route->getHttpMethods())) {
				return $route;
			}
		}

		return null;
	}

	/**
	 * Add a route to the route array
	 * @param Route $route
	 */
	public function addRoute(Route $route)
	{
		foreach ($this->routes as $r) {
			if ($r->getUri() === $route->getUri() &&
				$r->getHttpMethods() == $route->getHttpMethods())
				throw new Exception("Application error: route with uri: " . $r->getUri() .
					" and specified methods already exists");
		}

		if ($route instanceof Route) { // Necessary?
			$this->routes[] = $route;
			return $route;
		}

		throw new Exception("Application error: Argument is not a Route");
	}

	/**
	 * Router dispatcher. 
	 * @param Request $request current request
	 * @return boolean
	 */
	public function dispatch(Request $request)
	{
		$current_route = $this->routeMatch($request);

		if (is_null($current_route))
			return false;

		foreach ($current_route->getHandlers() as $handler) {
			//var_dump($handler);
			call_user_func($handler);
		}

		return true;
	}

}