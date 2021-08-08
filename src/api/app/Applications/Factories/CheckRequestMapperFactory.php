<?php

namespace src\Applications\Factories;

use src\Business\Mappers\Check\Request\CheckRequestMapper;

class CheckRequestMapperFactory
{
    public static function make(array $data): CheckRequestMapper
    {
        return new CheckRequestMapper(
            $data['value'],
            $data['userId']
        );
    }
}