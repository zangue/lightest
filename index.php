<?php

/**
 * Entry point
 *
 * @author Zangue <armand.zangue@gmail.com>
 */

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_DIR', dirname(__FILE__));
define('LIGHTEST_DIR', ROOT_DIR . DS . 'lightest');
define('APP_DIR', ROOT_DIR . DS . 'example');

require APP_DIR . DS . 'TestApp.php';