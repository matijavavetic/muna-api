<?php

namespace src\Applications\Factories;

use src\Business\Mappers\Stat\Request\StatRequestMapper;

class StatRequestMapperFactory
{
    public static function make(array $data): StatRequestMapper
    {
        return new StatRequestMapper($data['userId']);
    }
}