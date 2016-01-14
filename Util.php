<?php

/**
 * Util.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

/**
 * Utility class
 */
class Util {

	/**
	 * Strip the base of path. e.g /foo/bar -> /bar
	 * @param  string $path
	 * @return string       stripped path
	 */
	public static function stripBase($path)
	{
		$path = ltrim($path, DIRECTORY_SEPARATOR);

		$pos = strpos($path, DIRECTORY_SEPARATOR);

		return substr($path, $pos);
	}

}
