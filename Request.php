<?php

/**
 * Request.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

use Lightest\Util;

/**
 * This class describe a request object.
 */
class Request {

	/**
	 * Valid HTTP methods
	 */
	const HTTP_GET = 'GET';
	const HTTP_POST = 'POST';
	const HTTP_PUT = 'PUT';
	const HTTP_PACTH = 'PACTH';
	const HTTP_DELETE = 'DELETE';

	/**
	 * Class constructor
	 */
	public function __construct()
	{

	}

	/**
	 * Get user agent
	 * @return string
	 */
	public function getUserAgent()
	{
		return trim($_SERVER['HTTP_USER_AGENT']);
	}

	/**
	 * Get the HTTP request status
	 * @return integer
	 */
	public function getStatus()
	{
		return intval(trim($_SERVER['REDIRECT_STATUS']));
	}

	/**
	 * Get request uri
	 * @return $string
	 */
	public function getUri()
	{
		return Util::stripBase(rtrim($_SERVER['REQUEST_URI'], '/'));
	}

	/**
	 * get HTTP method
	 * @return string
	 */
	public function getHttpMethod()
	{
		return trim($_SERVER['REQUEST_METHOD']);
	}

	/**
	 * cheks if request method if GET
	 * @return boolean
	 */
	public function isGet()
	{
		$http_method = $this->getHttpMethod();

		return $http_method === self::HTTP_GET;
	}

	/**
	 * cheks if request method if POST
	 * @return boolean
	 */
	public function isPost()
	{
		throw new Exception("Not implmented error");
	}

	/**
	 * cheks if request method if PUT
	 * @return boolean
	 */
	public function isPut()
	{
		throw new Exception("Not implmented error");
	}

	/**
	 * cheks if request method if PATCH
	 * @return boolean
	 */
	public function isPatch()
	{
		throw new Exception("Not implmented error");
	}

	/**
	 * cheks if request method if DELETE
	 * @return boolean
	 */
	public function isDelete()
	{
		throw new Exception("Not implmented error");
	}

}