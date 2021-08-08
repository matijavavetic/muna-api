<?php

namespace src\Applications\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Fruitcake\Cors\HandleCors as Cors;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use src\Applications\Http\Middleware\AttachIdentifierToRequest;

class Kernel extends HttpKernel
{
    protected $middleware = [
        Cors::class,
        AttachIdentifierToRequest::class,
        AddQueuedCookiesToResponse::class
    ];

    protected $middlewareGroups = [
        'api' => [
            Cors::class,
            AttachIdentifierToRequest::class
        ],
    ];
}