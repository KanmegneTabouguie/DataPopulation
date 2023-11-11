<?php

// Require the Composer autoloader to load the Faker library.
require_once __DIR__ . '/vendor/autoload.php';

use Faker\Factory;

function getFaker() {
    return Factory::create();
}

?>