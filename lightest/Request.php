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
	const HTTP_PATCH = 'PATCH';
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
		$uri = Util::stripBase($_SERVER['REQUEST_URI']);

		if ($uri !== '/')
			rtrim($uri, '/');

		return $uri;
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
		return $this->getHttpMethod() === self::HTTP_GET;
	}

	/**
	 * cheks if request method if POST
	 * @return boolean
	 */
	public function isPost()
	{
		return $this->getHttpMethod() === self::HTTP_POST;
	}

	/**
	 * cheks if request method if PUT
	 * @return boolean
	 */
	public function isPut()
	{
		return $this->getHttpMethod() === self::HTTP_PUT;
	}

	/**
	 * cheks if request method if PATCH
	 * @return boolean
	 */
	public function isPatch()
	{
		return $this->getHttpMethod() === self::HTTP_PATCH;
	}

	/**
	 * cheks if request method if DELETE
	 * @return boolean
	 */
	public function isDelete()
	{
		return $this->getHttpMethod() === self::HTTP_DELETE;
	}

}