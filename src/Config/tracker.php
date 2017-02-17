<?php

return [
    // /* Middleware that will be applied to the view Pages */
    'middleware' => Laratracker\Links\Middleware\LinksMiddleware::class,

    /* The route prefix, will be applied to all of the routes. */
    'prefix' => 'links',
];
