<?php

namespace src\Applications\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Fruitcake\Cors\HandleCors as Cors;

class Kernel extends HttpKernel
{
    protected $middleware = [
        Cors::class
    ];

    protected $middlewareGroups = [
        'api' => [
            Cors::class,
        ],
    ];
}