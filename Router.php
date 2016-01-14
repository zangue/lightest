<?php

/**
 * Router.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

use Lightest\Route;

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
	 * Check if a route match the current request
	 * @param  Route  $route
	 * @return Route  if match was found, null otherwise
	 */
	private function routeMatch(Request $request)
	{
		//$request_method = 

		foreach ($this->routes as $route) {
			var_dump($route->getUri(), $request->getUri());
			var_dump($route->getHttpMethod(), $request->getHttpMethod());
			if ($route->getUri() === $request->getUri() &&
				$route->getHttpMethod() === $request->getMethod()) {
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
			if ($r->getUri() === $route->getUri())
				throw new Exception("Application error: route with uri: " . $r->uri . "already exists");
		}

		if ($route instanceof Route) { // Necessary?
			$this->routes[] = $route;
			return;
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

		foreach ($current_route->getActions() as $action) {
			var_dump($action);
			call_user_func($action);
		}

		return true;
	}

}