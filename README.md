##Lightest

Lightest is a tiny PHP 'micro framework'. Actually it is just a router.

###Why?
Just for fun and learning. I'm a big fan of [Slim](http://www.slimframework.com/) and I was just curious to see how
writing a similar tool can be done and how much I would need for it.

###How to use
Just like [Slim](http://www.slimframework.com/) if you are familiar with it.

```php
<?php

require 'Lightest.php';
require 'Request.php';
require 'Route.php';
require 'Router.php';
require 'Util.php';

use Lightest\Lightest;

// Create new app
$app = new Lightest();

// Add route
$app->get('/hello', function () use ($app) {
	echo 'Hello, World!';
});

// Run app
$app->run();
```

###Notes
This is still work in progress. I will add features as I get sparse time. Especially
I'm interested in adding remaining HTTP methods (POST, PUT, ...), the middleware concept
and a view handler at least.