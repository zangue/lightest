<?php

/**
 * Middleware.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

use Exception;

class Middleware {

	/**
	 * @var array
	 */
	protected $middlewares;

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$this->middlewares = array();
	}

	/**
	 * add a middleware
	 * @param Object $middleware middleware object
	 */
	public function add($middleware)
	{
		if (method_exists($middleware, 'before') ||
			method_exists($middleware, 'after')) {
			$this->middlewares[] = $middleware;
			return;
		}

		throw new Exception("Middleware class must contain at least one of the following methods: before() and after");
	}

	public function before()
	{
		if (empty($this->middlewares))
			return;

		foreach ($this->middlewares as $middleware) {
			$middleware->before();
		}

		return;
	}

	public function after()
	{
		if (empty($this->middlewares))
			return;

		$middlewares = array_reverse($this->middlewares);

		foreach ($middlewares as $middleware) {
			$middleware->after();
		}

		return;
	}

}