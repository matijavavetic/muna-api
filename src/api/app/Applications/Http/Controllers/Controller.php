<?php

namespace src\Applications\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Memcached;

class Controller extends BaseController
{
    protected Memcached $memcached;

    public function __construct() 
    {
        $this->memcached = new Memcached;
        $this->memcached->addServer('memcached', 11211);
    }
}