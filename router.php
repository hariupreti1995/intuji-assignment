<?php
// availble routes
$pagesPath = __DIR__ . "/pages/";
$routes = [
    'home' => 'landing.php',
    'create' => 'createEvent.php',
    'integration' => 'integration.php'
];
if (array_key_exists($page, $routes)) {
    // Include the corresponding page here
    include $pagesPath . $routes[$page];
} else {
    echo "404 - Page Not Found";
}