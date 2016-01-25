##Lightest

Lightest is a tiny PHP 'micro framework'. Actually it is just a router.

###Why?
Just for fun and learning. I'm a big fan of [Slim](http://www.slimframework.com/) and I was just curious to see how
writing a similar tool can be done and how much time I would need for it.

###How to use
Just like [Slim](http://www.slimframework.com/) if you are familiar with it.

```php
<?php

require 'path/to/Lightest.php';

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
I'm interested in adding the middleware concept at least.
