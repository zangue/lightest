<?php

class TestMiddleware {

	public function __construct()
	{

	}

	public function before()
	{
		echo '<p>Before filter</p>';
	}

	public function after()
	{
		echo '<p>After filter</p>';
	}

}