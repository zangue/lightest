<?php

/**
 * View.php
 *
 * @author A. Zangue <armand.zangue@gmail.com>
 */

namespace Lightest;

use Exception;


class View {

	/**
	 * Location of template files
	 * @var string
	 */
	protected $templates_path;

	/**
	 * View data
	 * @var array
	 */
	protected $data;


	/**
	 * Class constructor
	 */
	public function __construct($templates_path)
	{
		$this->templates_path = $templates_path;
		$this->data = array();
	}

	/**
	 * set data for view
	 * @param [type] $data [description]
	 */
	public function set($data)
	{
		if (!is_array($data))
			throw new Exception("Error: invalid argument");

		array_merge($this->data, $data);
	}

	/**
	 * Render a view
	 * @param  string $template_name name of the template
	 * @param  array $data         array of data
	 * @return void
	 */
	public function render($template_name, $data = array())
	{
		$template_file = $this->templates_path . DIRECTORY_SEPARATOR . $template_name;

		if (!file_exists($template_file))
			throw new Exception("Error: template file doesn't exists.");

		ob_start();

		// Merge passed data with (potentially) previously set data
		$data = array_merge($this->data, $data);

		if (!empty($data))
			extract($data);

		require $template_file;

		$content =  ob_get_clean();

		echo $content;
	}

}
